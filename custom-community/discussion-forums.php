<?php
/** Member-created, public forums without granting moderation capabilities. */
defined( 'ABSPATH' ) || exit;

function oss_member_can_create_forum() {
    return is_user_logged_in() && function_exists( 'bbp_insert_forum' ) && ( current_user_can( 'publish_topics' ) || current_user_can( 'publish_forums' ) );
}

function oss_forum_directory_url() {
    $page = get_page_by_path( 'dien-dan' );
    return $page ? get_permalink( $page ) : bbp_get_forums_url();
}

/** Validate the cover before creating any forum or attachment. */
function oss_forum_cover_error( $file ) {
    if ( ! isset( $file['error'] ) || UPLOAD_ERR_NO_FILE === (int) $file['error'] ) { return ''; }
    if ( UPLOAD_ERR_OK !== (int) $file['error'] || empty( $file['tmp_name'] ) || ! is_uploaded_file( $file['tmp_name'] ) ) { return 'cover_upload'; }
    if ( filesize( $file['tmp_name'] ) > 5 * MB_IN_BYTES ) { return 'cover_size'; }
    $checked = wp_check_filetype_and_ext( $file['tmp_name'], $file['name'], array( 'png' => 'image/png' ) );
    if ( empty( $checked['type'] ) || 'image/png' !== $checked['type'] || 'image/png' !== wp_get_image_mime( $file['tmp_name'] ) ) { return 'cover_type'; }
    return '';
}

function oss_member_create_forum() {
    if ( ! is_user_logged_in() ) { wp_safe_redirect( wp_login_url( oss_forum_directory_url() . '#oss-create-forum' ) ); exit; }
    if ( ! oss_member_can_create_forum() ) { wp_die( 'Bạn không có quyền tạo diễn đàn.', '', array( 'response' => 403 ) ); }
    check_admin_referer( 'oss-create-forum', 'oss_forum_nonce' );
    $title = sanitize_text_field( wp_unslash( $_POST['oss_forum_title'] ?? '' ) );
    $content = wp_kses_post( wp_unslash( $_POST['oss_forum_content'] ?? '' ) );
    $error = '';
    if ( ! $title || bbp_is_title_too_long( $title ) ) { $error = 'title'; }
    elseif ( ! bbp_check_for_flood( array(), get_current_user_id() ) ) { $error = 'flood'; }
    elseif ( get_posts( array( 'post_type' => bbp_get_forum_post_type(), 'title' => $title, 'post_status' => 'any', 'posts_per_page' => 1, 'fields' => 'ids' ) ) ) { $error = 'duplicate'; }
    if ( ! $error ) { $error = oss_forum_cover_error( $_FILES['oss_forum_cover'] ?? array() ); }
    if ( $error ) { wp_safe_redirect( add_query_arg( 'oss_forum_error', $error, oss_forum_directory_url() ) . '#oss-create-forum' ); exit; }
    $forum_id = bbp_insert_forum( array(
        'post_title' => $title,
        'post_content' => $content,
        'post_author' => get_current_user_id(),
        'post_parent' => 0,
        'post_status' => bbp_get_public_status_id(),
    ), array( 'forum_type' => 'forum', 'status' => 'open' ) );
    if ( ! $forum_id || is_wp_error( $forum_id ) ) { wp_safe_redirect( add_query_arg( 'oss_forum_error', 'save', oss_forum_directory_url() ) . '#oss-create-forum' ); exit; }
    if ( isset( $_FILES['oss_forum_cover']['error'] ) && UPLOAD_ERR_OK === (int) $_FILES['oss_forum_cover']['error'] ) {
        require_once ABSPATH . 'wp-admin/includes/file.php';
        require_once ABSPATH . 'wp-admin/includes/image.php';
        require_once ABSPATH . 'wp-admin/includes/media.php';
        $cover_id = media_handle_upload( 'oss_forum_cover', $forum_id, array(), array( 'test_form' => false, 'mimes' => array( 'png' => 'image/png' ) ) );
        if ( is_wp_error( $cover_id ) || ! set_post_thumbnail( $forum_id, $cover_id ) ) {
            if ( ! is_wp_error( $cover_id ) ) { wp_delete_attachment( $cover_id, true ); }
            wp_trash_post( $forum_id );
            wp_safe_redirect( add_query_arg( 'oss_forum_error', 'cover_upload', oss_forum_directory_url() ) . '#oss-create-forum' );
            exit;
        }
    }
    bbp_update_user_last_posted( get_current_user_id() );
    wp_safe_redirect( bbp_get_forum_permalink( $forum_id ) );
    exit;
}
add_action( 'admin_post_oss_create_forum', 'oss_member_create_forum' );
add_action( 'admin_post_nopriv_oss_create_forum', 'oss_member_create_forum' );
