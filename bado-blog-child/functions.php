<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 1 );

// END ENQUEUE PARENT ACTION

// Load child overrides after the parent's generated Customizer styles.
add_action( 'wp_enqueue_scripts', function () {
    $path = get_stylesheet_directory() . '/assets/css/community-theme.css';
    wp_enqueue_style(
        'oss-community-theme',
        get_stylesheet_directory_uri() . '/assets/css/community-theme.css',
        array( 'badoblog-style-custom' ),
        filemtime( $path )
    );
    wp_dequeue_script( 'badoblog-script-fixmenu' );
    $motion_path = get_stylesheet_directory() . '/assets/js/community-header.js';
    wp_enqueue_script(
        'oss-community-header',
        get_stylesheet_directory_uri() . '/assets/js/community-header.js',
        array(),
        filemtime( $motion_path ),
        true
    );
    if ( is_front_page() ) {
        $feed_path = get_stylesheet_directory() . '/assets/js/community-feed.js';
        wp_enqueue_script(
            'oss-community-feed',
            get_stylesheet_directory_uri() . '/assets/js/community-feed.js',
            array(),
            filemtime( $feed_path ),
            true
        );
        wp_localize_script( 'oss-community-feed', 'ossFeed', array(
            'url'   => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'oss_community_load_more' ),
        ) );
    }
}, 20 );

// The public header supplies notification and account links in place of the
// WordPress toolbar. Keep the toolbar available inside wp-admin.
add_filter( 'show_admin_bar', function ( $show ) {
    return is_admin() ? $show : false;
} );

require_once get_stylesheet_directory() . '/inc/community-feed.php';

function oss_community_nav_items() {
    $forum_page   = get_page_by_path( 'dien-dan' );
    $ranking_page = get_page_by_path( 'bang-xep-hang' );
    $points_page  = get_page_by_path( 'diem-cua-toi' );
    $profile_url  = is_user_logged_in()
        ? ( function_exists( 'bp_loggedin_user_domain' ) ? bp_loggedin_user_domain() : get_edit_profile_url( get_current_user_id() ) )
        : wp_login_url( home_url( '/' ) );

    return array(
        array( 'label' => 'Trang chủ', 'url' => home_url( '/' ), 'active' => is_front_page() ),
        array( 'label' => 'Diễn đàn', 'url' => $forum_page ? get_permalink( $forum_page ) : ( function_exists( 'bbp_get_forums_url' ) ? bbp_get_forums_url() : home_url( '/' ) ), 'active' => is_page( 'dien-dan' ) || ( function_exists( 'bbp_is_forum_archive' ) && bbp_is_forum_archive() ) ),
        array( 'label' => 'Bảng xếp hạng', 'url' => $ranking_page ? get_permalink( $ranking_page ) : home_url( '/' ), 'active' => is_page( 'bang-xep-hang' ) ),
        array( 'label' => 'Trang cá nhân', 'url' => $profile_url, 'active' => function_exists( 'bp_is_user' ) && bp_is_user() ),
        array( 'label' => 'Điểm của tôi', 'url' => $points_page ? get_permalink( $points_page ) : home_url( '/' ), 'active' => is_page( 'diem-cua-toi' ) ),
    );
}

// Use the parent's full-width layout and skip rendering its sidebar widgets.
add_filter( 'theme_mod_badoblog_cus_lay_all', function () {
    return 'no_sidebar_full';
} );
add_filter( 'theme_mod_badoblog_cus_lay_home', function () {
    return 'no_sidebar_full';
} );

// Keep saved social settings editable, but remove the icons from the header.
add_filter( 'theme_mod_badoblog_cus_soc', function () {
    return 0;
} );

add_filter( 'body_class', function ( $classes ) {
    $classes[] = is_front_page() ? 'oss-front-page' : 'oss-inner-page';
    if ( is_page( array( 'dien-dan', 'bang-xep-hang', 'diem-cua-toi' ) ) || ( function_exists( 'bp_is_user' ) && bp_is_user() ) ) {
        $classes[] = 'oss-panel-page';
    }
    return $classes;
} );
