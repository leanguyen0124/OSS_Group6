<?php
/**
 * Custom, persistent likes for bbPress topics.
 * Load this file from the custom-community plugin main file.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** Return the saved user IDs for a topic's likes. */
function oss_topic_like_user_ids( $topic_id ) {
	$user_ids = get_post_meta( absint( $topic_id ), '_oss_topic_like_user_ids', true );
	if ( ! is_array( $user_ids ) ) {
		return array();
	}
	return array_values( array_unique( array_filter( array_map( 'absint', $user_ids ) ) ) );
}

/** Render the real like button used by the discussion feed. */
function oss_topic_like_button( $topic_id ) {
	$topic_id = absint( $topic_id );
	if ( ! $topic_id || 'topic' !== get_post_type( $topic_id ) ) {
		return '';
	}

	$user_ids = oss_topic_like_user_ids( $topic_id );
	$count = count( $user_ids );
	$liked = is_user_logged_in() && in_array( get_current_user_id(), $user_ids, true );

	if ( ! is_user_logged_in() ) {
		return '<a class="oss-topic-like oss-topic-like-login" href="' . esc_url( wp_login_url( get_permalink( $topic_id ) ) ) . '" aria-label="Đăng nhập để thích chủ đề">'
			. '<span aria-hidden="true">♡</span> <span>' . esc_html( number_format_i18n( $count ) ) . '</span> lượt thích'
			. '</a>';
	}

	wp_enqueue_script(
		'oss-topic-likes',
		plugins_url( 'discussion-likes.js', __FILE__ ),
		array(),
		'1.0.0',
		true
	);
	wp_localize_script( 'oss-topic-likes', 'ossTopicLikes', array(
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'errorMessage' => 'Chưa thể cập nhật lượt thích. Vui lòng thử lại.',
	) );

	wp_register_style( 'oss-topic-likes', false, array(), '1.0.0' );
	wp_enqueue_style( 'oss-topic-likes' );
	wp_add_inline_style( 'oss-topic-likes', '
		.oss-topic-like-wrap{display:inline-flex;align-items:center;gap:6px}
		.oss-topic-like{display:inline-flex;align-items:center;gap:6px;border:0;background:transparent;color:#777483;font:inherit;font-size:13px;text-decoration:none;cursor:pointer}
		button.oss-topic-like{padding:5px 7px;border-radius:18px}
		button.oss-topic-like:hover{background:#f8eef3;color:#b34470}
		button.oss-topic-like[aria-pressed="true"]{color:#d83b68}
		.oss-topic-like-heart{font-size:18px;line-height:1}
		.oss-topic-like[disabled]{opacity:.6;cursor:wait}
		.oss-topic-like-status{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}
	' );

	return '<span class="oss-topic-like-wrap">'
		. '<button type="button" class="oss-topic-like' . ( $liked ? ' is-liked' : '' ) . '" data-oss-topic-like data-topic-id="' . esc_attr( $topic_id ) . '" data-nonce="' . esc_attr( wp_create_nonce( 'oss_topic_like_' . $topic_id ) ) . '" aria-pressed="' . ( $liked ? 'true' : 'false' ) . '" aria-label="' . esc_attr( $liked ? 'Bỏ thích chủ đề' : 'Thích chủ đề' ) . '">'
		. '<span class="oss-topic-like-heart" aria-hidden="true">' . ( $liked ? '♥' : '♡' ) . '</span>'
		. '<span data-oss-topic-like-count>' . esc_html( number_format_i18n( $count ) ) . '</span>'
		. '<span>lượt thích</span></button><span class="oss-topic-like-status" data-oss-topic-like-status aria-live="polite"></span></span>';
}

/** Change the current user's like state for a published, viewable bbPress topic. */
function oss_topic_like_ajax() {
	if ( ! is_user_logged_in() ) {
		wp_send_json_error( array( 'message' => 'Bạn cần đăng nhập để thích chủ đề.' ), 401 );
	}

	$topic_id = isset( $_POST['topic_id'] ) ? absint( wp_unslash( $_POST['topic_id'] ) ) : 0;
	$desired = isset( $_POST['liked'] ) ? ( '1' === sanitize_text_field( wp_unslash( $_POST['liked'] ) ) ) : false;

	if ( ! $topic_id || 'topic' !== get_post_type( $topic_id ) || 'publish' !== get_post_status( $topic_id ) ) {
		wp_send_json_error( array( 'message' => 'Không tìm thấy chủ đề hợp lệ.' ), 404 );
	}

	check_ajax_referer( 'oss_topic_like_' . $topic_id, 'nonce' );

	$forum_id = function_exists( 'bbp_get_topic_forum_id' ) ? absint( bbp_get_topic_forum_id( $topic_id ) ) : 0;
	if ( $forum_id && function_exists( 'bbp_user_can_view_forum' ) && ! bbp_user_can_view_forum( array( 'forum_id' => $forum_id ) ) ) {
		wp_send_json_error( array( 'message' => 'Bạn không có quyền xem chủ đề này.' ), 403 );
	}

	$user_id = get_current_user_id();
	$user_ids = oss_topic_like_user_ids( $topic_id );
	$already_liked = in_array( $user_id, $user_ids, true );

	if ( $desired && ! $already_liked ) {
		$user_ids[] = $user_id;
		update_post_meta( $topic_id, '_oss_topic_like_user_ids', array_values( array_unique( $user_ids ) ) );
	} elseif ( ! $desired && $already_liked ) {
		$user_ids = array_values( array_diff( $user_ids, array( $user_id ) ) );
		update_post_meta( $topic_id, '_oss_topic_like_user_ids', $user_ids );
	}

	wp_send_json_success( array(
		'liked' => $desired,
		'count' => count( oss_topic_like_user_ids( $topic_id ) ),
	) );
}
add_action( 'wp_ajax_oss_topic_like', 'oss_topic_like_ajax' );
