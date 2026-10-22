<?php
/** Latest public bbPress topics and BuddyPress status updates. */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function oss_community_feed_excerpt( $content ) {
    return wp_trim_words( wp_strip_all_tags( strip_shortcodes( (string) $content ) ), 32, '…' );
}

function oss_community_feed_author( $user_id ) {
    $user = $user_id ? get_userdata( $user_id ) : false;
    return array(
        'name' => $user ? $user->display_name : 'Thành viên',
        'url'  => $user && function_exists( 'bp_members_get_user_url' )
            ? bp_members_get_user_url( $user_id )
            : ( $user ? get_author_posts_url( $user_id ) : '' ),
    );
}

function oss_community_latest_items( $limit = 12, $offset = 0 ) {
    $limit = max( 1, min( 20, (int) $limit ) );
    $offset = max( 0, (int) $offset );
    $fetch_size = $limit + $offset;
    $items = array();

    if ( function_exists( 'bbp_get_topic_permalink' ) ) {
        $topics = get_posts( array(
            'post_type'      => 'topic',
            'post__not_in'   => class_exists( 'Custom_Content_Report' ) ? Custom_Content_Report::instance()->get_reported_content_ids( 'topic' ) : array(),
            'post_status'    => 'publish',
            'posts_per_page' => max( 30, $fetch_size ),
            'no_found_rows'  => true,
        ) );
        foreach ( $topics as $topic ) {
            $forum_id = function_exists( 'bbp_get_topic_forum_id' ) ? bbp_get_topic_forum_id( $topic->ID ) : 0;
            if ( ! $forum_id || ! bbp_is_topic_public( $topic->ID ) || ! bbp_user_can_view_forum( array(
                'forum_id'        => $forum_id,
                'user_id'         => get_current_user_id(),
                'check_ancestors' => true,
            ) ) ) {
                continue;
            }
            $items[] = array(
                'type'       => 'topic',
                'id'         => (int) $topic->ID,
                'label'      => 'Chủ đề diễn đàn',
                'title'      => bbp_get_topic_title( $topic->ID ),
                'excerpt'    => oss_community_feed_excerpt( $topic->post_content ),
                'url'        => bbp_get_topic_permalink( $topic->ID ),
                'author_id'  => (int) $topic->post_author,
                'time'       => (int) get_post_time( 'U', true, $topic ),
            );
        }
    }

    if ( function_exists( 'bp_activity_get' ) && function_exists( 'bp_activity_get_permalink' ) ) {
        $result = bp_activity_get( array(
            'per_page'         => max( 30, $fetch_size ),
            'display_comments' => 'threaded',
            'show_hidden'      => false,
            'filter'           => array( 'object' => 'activity', 'action' => 'activity_update' ),
        ) );
        foreach ( (array) ( $result['activities'] ?? array() ) as $activity ) {
            $status_text = wp_strip_all_tags( strip_shortcodes( (string) $activity->content ) );
            $image_ids = function_exists( 'bp_activity_get_meta' )
                ? wp_parse_id_list( bp_activity_get_meta( $activity->id, '_cpi_image_ids' ) )
                : array();
            $items[] = array(
                'type'       => 'status',
                'id'         => (int) $activity->id,
                'comment_count' => (int) bp_activity_recurse_comment_count( $activity ),
                'favorite_count' => (int) bp_activity_get_meta( $activity->id, 'favorite_count', true ),
                'label'      => 'Trạng thái',
                'title'      => $status_text ? wp_trim_words( $status_text, 14, '…' ) : 'Bài đăng của thành viên',
                'excerpt'    => '',
                'image_ids'  => $image_ids,
                'url'        => bp_activity_get_permalink( $activity->id, $activity ),
                'author_id'  => (int) $activity->user_id,
                'time'       => (int) strtotime( $activity->date_recorded . ' UTC' ),
            );
        }
    }

    usort( $items, function ( $a, $b ) {
        return $b['time'] <=> $a['time'];
    } );

    return array_slice( $items, $offset, $limit );
}

function oss_community_load_more() {
    check_ajax_referer( 'oss_community_load_more', 'nonce' );
    $offset = isset( $_POST['offset'] ) ? max( 0, (int) $_POST['offset'] ) : 0;
    $limit = 8;
    $items = oss_community_latest_items( $limit + 1, $offset );
    $has_more = count( $items ) > $limit;
    $items = array_slice( $items, 0, $limit );

    ob_start();
    foreach ( $items as $item ) {
        get_template_part( 'template-parts/home/feed-item', null, array( 'item' => $item ) );
    }

    wp_send_json_success( array(
        'html'     => ob_get_clean(),
        'count'    => count( $items ),
        'has_more' => $has_more,
    ) );
}
add_action( 'wp_ajax_oss_community_load_more', 'oss_community_load_more' );
add_action( 'wp_ajax_nopriv_oss_community_load_more', 'oss_community_load_more' );
