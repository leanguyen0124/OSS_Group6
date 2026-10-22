<?php
/** Theme-owned presentation for community rewards. */
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_filter( 'option_blogname', function ( $value ) {
    return is_admin() ? $value : 'Góp Chuyện';
} );
add_filter( 'option_blogdescription', function ( $value ) {
    return is_admin() ? $value : 'Một câu chuyện, thêm một kết nối.';
} );

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'oss-rewards-dashboard', get_stylesheet_directory_uri() . '/assets/css/rewards-dashboard.css', array( 'oss-community-refresh' ), filemtime( get_stylesheet_directory() . '/assets/css/rewards-dashboard.css' ) );
    foreach ( array( 'css' => 'style', 'js' => 'script' ) as $extension => $kind ) {
        $file = '/assets/' . $extension . '/community-refresh.' . $extension;
        if ( 'style' === $kind ) {
            wp_enqueue_style( 'oss-community-refresh', get_stylesheet_directory_uri() . $file, array( 'oss-community-theme' ), filemtime( get_stylesheet_directory() . $file ) );
        } else {
            wp_enqueue_script( 'oss-community-refresh', get_stylesheet_directory_uri() . $file, array(), filemtime( get_stylesheet_directory() . $file ), true );
        }
    }
}, 30 );

/** Badge artwork uses fixed SVG geometry; labels and thresholds stay in plugin rules. */
function oss_community_badge_art( $key ) {
    $palette = array( 'bronze' => array( '#b9774d', '#f8e5d3' ), 'silver' => array( '#6b7896', '#e7edf5' ), 'gold' => array( '#b88c25', '#fff1bf' ) );
    $colors = $palette[ $key ] ?? array( '#8063be', '#eee6fa' );
    return '<svg class="oss-badge-art" viewBox="0 0 96 110" aria-hidden="true" focusable="false"><path d="M27 65 21 105 48 91 75 105 69 65" fill="' . $colors[0] . '"/><path d="m48 3 13 8 15 1 5 14 11 11-5 15 1 15-14 7-10 12-16-2-16 2-10-12-14-7 1-15-5-15L15 26l5-14 15-1Z" fill="' . $colors[0] . '"/><circle cx="48" cy="44" r="30" fill="' . $colors[1] . '"/><circle cx="48" cy="44" r="24" fill="none" stroke="' . $colors[0] . '" stroke-width="1.5"/><path d="m48 25 6 12 14 2-10 10 2 14-12-7-12 7 2-14-10-10 14-2Z" fill="' . $colors[0] . '"/></svg>';
}

function oss_community_reward_summary( $user_id ) {
    global $wpdb;
    list( $transactions, $badges ) = oss_rewards_tables();
    $score = oss_rewards_score( $user_id );
    return array(
        'score' => $score,
        'earned' => $wpdb->get_col( $wpdb->prepare( "SELECT badge_key FROM $badges WHERE user_id = %d", $user_id ) ),
        'rank' => 1 + (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM (SELECT u.ID FROM {$wpdb->users} u LEFT JOIN $transactions t ON t.user_id = u.ID GROUP BY u.ID HAVING COALESCE(SUM(t.points), 0) > %d) ranked", $score ) ),
    );
}

add_action( 'init', function () {
    if ( ! function_exists( 'oss_rewards_score' ) ) { return; }
    add_shortcode( 'oss_reward_profile', function ( $atts ) {
        $atts = shortcode_atts( array( 'user_id' => get_current_user_id() ), $atts );
        $user_id = absint( $atts['user_id'] );
        ob_start();
        get_template_part( 'template-parts/rewards/profile', null, array( 'user_id' => $user_id, 'user' => get_userdata( $user_id ) ) );
        return ob_get_clean();
    } );
}, 20 );

// Forum covers are maintained in the standard featured-image field.
add_action( 'init', function () {
    if ( post_type_exists( 'forum' ) ) { add_post_type_support( 'forum', 'thumbnail' ); }
}, 30 );

// The topic form remains bbPress-owned; this shortcut also works for empty forums.
add_action( 'bbp_template_before_single_forum', function () {
    if ( post_password_required() || ! bbp_current_user_can_access_create_topic_form() ) { return; }
    echo '<div class="oss-forum-topic-toolbar"><a class="oss-forum-action" href="#new-post">+ Tạo chủ đề</a></div>';
} );

// BuddyPress keeps uploaded member covers; this image is only the fallback.
add_filter( 'bp_before_members_cover_image_settings_parse_args', function ( $settings ) {
    $settings['default_cover'] = get_stylesheet_directory_uri() . '/assets/images/member-cover-default.png';
    return $settings;
} );
