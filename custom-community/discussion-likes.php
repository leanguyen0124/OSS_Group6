<?php
/** Persistent hearts for public posts/replies/comments and readable BuddyPress activities. */
defined( 'ABSPATH' ) || exit;

function oss_content_likes_table() {
    global $wpdb;
    return $wpdb->prefix . 'oss_content_likes';
}

add_action( 'init', function () {
    if ( '1' === get_option( 'oss_content_likes_version' ) ) { return; }
    global $wpdb;
    $table = oss_content_likes_table();
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( "CREATE TABLE $table (
        id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
        object_type varchar(16) NOT NULL,
        object_id bigint(20) unsigned NOT NULL,
        user_id bigint(20) unsigned NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY object_user (object_type, object_id, user_id)
    ) " . $wpdb->get_charset_collate() . ';' );
    if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $wpdb->esc_like( $table ) ) ) !== $table ) { return; }
    // Import the previous topic hearts once, preserving existing users and totals.
    $old = $wpdb->get_results( "SELECT post_id, meta_value FROM {$wpdb->postmeta} WHERE meta_key = '_oss_topic_like_user_ids'" );
    foreach ( $old as $row ) {
        foreach ( wp_parse_id_list( maybe_unserialize( $row->meta_value ) ) as $user_id ) {
            if ( false === $wpdb->query( $wpdb->prepare( "INSERT IGNORE INTO $table (object_type, object_id, user_id) VALUES ('post', %d, %d)", $row->post_id, $user_id ) ) ) { return; }
        }
    }
    update_option( 'oss_content_likes_version', '1' );
}, 20 );

/** One read-access check shared by rendering and mutations. */
function oss_content_like_can_read( $type, $id ) {
    if ( 'activity' === $type ) {
        if ( ! class_exists( 'BP_Activity_Activity' ) || ! function_exists( 'bp_activity_user_can_read' ) ) { return false; }
        $activity = new BP_Activity_Activity( $id );
        return $activity->id && ! $activity->is_spam && bp_activity_user_can_read( $activity, get_current_user_id() );
    }
    if ( 'comment' === $type ) {
        $comment = get_comment( $id );
        return $comment && '1' === $comment->comment_approved && oss_content_like_can_read( 'post', $comment->comment_post_ID );
    }
    if ( 'post' !== $type ) { return false; }
    $post = get_post( $id );
    if ( ! $post || ! in_array( $post->post_type, array( 'post', 'topic', 'reply' ), true ) || 'publish' !== $post->post_status || post_password_required( $post ) ) { return false; }
    if ( in_array( $post->post_type, array( 'topic', 'reply' ), true ) ) {
        if ( ! function_exists( 'bbp_user_can_view_forum' ) ) { return false; }
        $forum_id = 'topic' === $post->post_type ? bbp_get_topic_forum_id( $id ) : bbp_get_reply_forum_id( $id );
        $topic_id = 'topic' === $post->post_type ? $id : bbp_get_reply_topic_id( $id );
        if ( ! $forum_id || ! $topic_id || post_password_required( $topic_id ) || 'publish' !== get_post_status( $topic_id ) ) { return false; }
        return bbp_user_can_view_forum( array( 'forum_id' => $forum_id, 'user_id' => get_current_user_id(), 'check_ancestors' => true ) );
    }
    return true;
}

function oss_content_like_state( $type, $id ) {
    if ( 'activity' === $type ) {
        return array( 'count' => max( 0, (int) bp_activity_get_meta( $id, 'favorite_count' ) ), 'liked' => in_array( $id, wp_parse_id_list( bp_activity_get_user_favorites( get_current_user_id() ) ), true ) );
    }
    global $wpdb;
    $table = oss_content_likes_table();
    return array(
        'count' => (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table WHERE object_type = %s AND object_id = %d", $type, $id ) ),
        'liked' => (bool) $wpdb->get_var( $wpdb->prepare( "SELECT id FROM $table WHERE object_type = %s AND object_id = %d AND user_id = %d", $type, $id, get_current_user_id() ) ),
    );
}

/** Load once on the page so AJAX-loaded activity/feed items also work. */
function oss_content_likes_assets() {
    static $loaded = false;
    if ( $loaded ) { return; }
    $loaded = true;
    wp_enqueue_script( 'oss-topic-likes', plugins_url( 'discussion-likes.js', __FILE__ ), array(), filemtime( __DIR__ . '/discussion-likes.js' ), true );
    wp_localize_script( 'oss-topic-likes', 'ossTopicLikes', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ), 'errorMessage' => 'Chưa thể cập nhật lượt thích. Vui lòng thử lại.' ) );
    wp_enqueue_style( 'oss-content-likes', plugins_url( 'discussion-likes.css', __FILE__ ), array(), filemtime( __DIR__ . '/discussion-likes.css' ) );
}
add_action( 'wp_enqueue_scripts', 'oss_content_likes_assets', 20 );

function oss_content_like_button( $id, $type = 'post' ) {
    $id = absint( $id );
    if ( ! $id || ! oss_content_like_can_read( $type, $id ) || '1' !== get_option( 'oss_content_likes_version' ) ) { return ''; }
    $state = oss_content_like_state( $type, $id );
    $key = $type . ':' . $id;
    $url = 'activity' === $type ? bp_activity_get_permalink( $id ) : ( 'comment' === $type ? get_comment_link( $id ) : get_permalink( $id ) );
    oss_content_likes_assets();
    $icon = '<svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true" focusable="false"><path d="M20.8 4.6c-2.1-2.1-5.4-1.8-7.3.3L12 6.5l-1.5-1.6C8.6 2.8 5.3 2.5 3.2 4.6c-2.2 2.2-2.1 5.7.1 8L12 21l8.7-8.4c2.2-2.3 2.3-5.8.1-8Z"/></svg>';
    $html = '<span class="oss-content-like" data-like-key="' . esc_attr( $key ) . '">';
    if ( is_user_logged_in() ) {
        $html .= '<button type="button" class="oss-heart-button" data-oss-heart data-content-type="' . esc_attr( $type ) . '" data-content-id="' . $id . '" data-nonce="' . esc_attr( wp_create_nonce( 'oss_content_like_' . $key ) ) . '" aria-pressed="' . ( $state['liked'] ? 'true' : 'false' ) . '" aria-label="' . ( $state['liked'] ? 'Bỏ tim' : 'Thả tim' ) . '">' . $icon . '</button>';
    } else {
        $html .= '<a class="oss-heart-button" href="' . esc_url( wp_login_url( $url ) ) . '" aria-label="Đăng nhập để thả tim">' . $icon . '</a>';
    }
    return $html . '<span class="oss-like-stat" data-oss-like-count aria-live="polite">' . esc_html( number_format_i18n( $state['count'] ) ) . ' lượt thích</span><span class="oss-like-error" role="status"></span></span>';
}

// Compatibility for existing templates and existing topic hearts.
function oss_topic_like_button( $topic_id ) { return oss_content_like_button( $topic_id ); }
function oss_topic_like_user_ids( $topic_id ) {
    global $wpdb;
    return array_map( 'intval', $wpdb->get_col( $wpdb->prepare( 'SELECT user_id FROM ' . oss_content_likes_table() . " WHERE object_type = 'post' AND object_id = %d", $topic_id ) ) );
}

function oss_content_like_ajax() {
    if ( ! is_user_logged_in() ) { wp_send_json_error( array( 'message' => 'Bạn cần đăng nhập để thả tim.' ), 401 ); }
    $legacy = isset( $_POST['topic_id'] );
    $id = absint( wp_unslash( $_POST[ $legacy ? 'topic_id' : 'content_id' ] ?? 0 ) );
    $type = $legacy ? 'post' : sanitize_key( wp_unslash( $_POST['content_type'] ?? '' ) );
    $desired = '1' === ( $_POST['liked'] ?? '' );
    check_ajax_referer( $legacy ? 'oss_topic_like_' . $id : 'oss_content_like_' . $type . ':' . $id, 'nonce' );
    if ( ! oss_content_like_can_read( $type, $id ) ) { wp_send_json_error( array( 'message' => 'Nội dung không tồn tại hoặc bạn không có quyền xem.' ), 403 ); }
    if ( '1' !== get_option( 'oss_content_likes_version' ) ) { wp_send_json_error( array( 'message' => 'Chức năng tim chưa sẵn sàng.' ), 503 ); }
    $before = oss_content_like_state( $type, $id );
    if ( 'activity' === $type ) {
        if ( $before['liked'] !== $desired ) {
            $success = $desired ? bp_activity_add_user_favorite( $id, get_current_user_id() ) : bp_activity_remove_user_favorite( $id, get_current_user_id() );
            if ( ! $success ) { wp_send_json_error( array( 'message' => 'Không thể cập nhật tim. Hãy thử lại.' ), 500 ); }
        }
    } else {
        global $wpdb;
        $table = oss_content_likes_table();
        $success = $desired
            ? $wpdb->query( $wpdb->prepare( "INSERT IGNORE INTO $table (object_type, object_id, user_id) VALUES (%s, %d, %d)", $type, $id, get_current_user_id() ) )
            : $wpdb->delete( $table, array( 'object_type' => $type, 'object_id' => $id, 'user_id' => get_current_user_id() ), array( '%s', '%d', '%d' ) );
        if ( false === $success ) { wp_send_json_error( array( 'message' => 'Không thể cập nhật tim. Hãy thử lại.' ), 500 ); }
    }
    $state = oss_content_like_state( $type, $id );
    $state['formatted_count'] = number_format_i18n( $state['count'] );
    wp_send_json_success( $state );
}
add_action( 'wp_ajax_oss_content_like', 'oss_content_like_ajax' );
add_action( 'wp_ajax_oss_topic_like', 'oss_content_like_ajax' );
add_action( 'wp_ajax_nopriv_oss_content_like', 'oss_content_like_ajax' );

add_filter( 'the_content', function ( $content ) {
    return ! is_admin() && is_singular( 'post' ) && in_the_loop() && is_main_query() ? $content . oss_content_like_button( get_the_ID() ) : $content;
}, 30 );
add_action( 'bbp_theme_after_reply_content', function () { echo oss_content_like_button( bbp_get_reply_id() ); } );
add_action( 'bbp_theme_after_topic_content', function () { echo oss_content_like_button( bbp_get_topic_id() ); } );
add_action( 'bp_activity_entry_meta', function () { echo oss_content_like_button( bp_get_activity_id(), 'activity' ); } );
add_action( 'bp_activity_comment_options', function () { echo oss_content_like_button( bp_get_activity_comment_id(), 'activity' ); } );
add_filter( 'bp_nouveau_get_activity_entry_buttons', function ( $buttons ) { unset( $buttons['activity_favorite'] ); return $buttons; } );
add_filter( 'comment_text', function ( $text, $comment ) {
    return ! is_admin() && ! is_feed() && $comment instanceof WP_Comment ? $text . oss_content_like_button( $comment->comment_ID, 'comment' ) : $text;
}, 30, 2 );
