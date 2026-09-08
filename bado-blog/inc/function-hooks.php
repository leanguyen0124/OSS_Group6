<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Hooks
* ------------------------------------------------------------------------------ */
$options = get_option( 'theme_options_hooks' );
if ( $options ) {
    $hooks_map = [
        'hook_before_head' => ['wp_head', 10, null],
        'hook_before_body' => ['wp_footer', 10, null],
    ];
    // Checking Plugins
    $plugin_check = [
        'woo'        => function () {
            return function_exists( 'WC' );
        },
        'bbpress'    => function () {
            return function_exists( 'bbp_get_forum' );
        },
        'buddypress' => function () {
            return function_exists( 'buddypress' );
        },
    ];
    // Registering hooks
    foreach ( $hooks_map as $option_key => $hook_data ) {
        $wp_hook = $hook_data[0];
        $priority = $hook_data[1];
        $plugin_dependency = ( isset( $hook_data[2] ) ? $hook_data[2] : null );
        // Checking the enabled option
        if ( empty( $options[$option_key] ?? '' ) ) {
            continue;
        }
        // Checking plugin dependency
        if ( $plugin_dependency && (!isset( $plugin_check[$plugin_dependency] ) || !$plugin_check[$plugin_dependency]()) ) {
            continue;
        }
        add_action( $wp_hook, function () use($option_key) {
            $opts = get_option( 'theme_options_hooks' );
            echo do_shortcode( $opts[$option_key] ?? '' );
        }, $priority );
    }
}