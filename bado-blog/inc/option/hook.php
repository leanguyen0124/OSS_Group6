<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Hook windows
* ------------------------------------------------------------------------------ */
/*--------------------------------------------------------------
Content:
----------------------------------------------------------------
# Placing the settings
    # Main
    # Top menu
    # Main menu
    # Wide slider
    # Category menu
    # Footer
    # Home
    # Breadcrumbs
    # Categories
    # Posts
    # Pages
    # WooCommerce
    # bbPress
    # BuddyPress
# Display input fields
# Input validation
--------------------------------------------------------------*/
//? ========== Placing the settings
function badoblog_fun_theme_option_settings_hooks() {
    $section = 'badoblog_set_section_hook';
    $slug = 'hook-tab';
    $add = 'add_settings_field';
    $typ = 'textarea';
    $display = 'badoblog_fun_theme_display_settings_hooks';
    // Adding a settings section
    add_settings_section(
        $section,
        // ID
        esc_html__( 'Page for adding codes', 'bado-blog' ),
        // Title
        'badoblog_fun_callback_dis_hooks',
        // Additional function
        $slug
    );
    // Registering settings (settings are stored in the database - theme_options_hooks)
    register_setting( $slug, 'theme_options_hooks', 'badoblog_fun_theme_validate_settings_hooks' );
    //? ========== Main
    $set = array(
        'type' => $typ,
        'id'   => 'hook_before_head',
        'desc' => '',
    );
    $add(
        'badoblog_set_hook_before_head',
        sprintf( esc_html__( 'Before the closing %s tag', 'bado-blog' ), 'HEAD' ),
        $display,
        $slug,
        $section,
        $set
    );
    $set = array(
        'type' => $typ,
        'id'   => 'hook_before_body',
        'desc' => '',
    );
    $add(
        'badoblog_set_hook_before_body',
        sprintf( esc_html__( 'Before the closing %s tag', 'bado-blog' ), 'BODY' ),
        $display,
        $slug,
        $section,
        $set
    );
    // Display text usability
    $add(
        'badoblog_set_hook_text_premium',
        '',
        'badoblog_fun_callback_hook_usability',
        $slug,
        $section
    );
}

add_action( 'admin_init', 'badoblog_fun_theme_option_settings_hooks' );
//? ========== Display text dis hooks
function badoblog_fun_callback_dis_hooks() {
    echo esc_html__( 'On this page you can insert counters, banners, or any other content that will be displayed on the front of the site', 'bado-blog' );
}

//? ========== Display text usability
function badoblog_fun_callback_hook_usability() {
    if ( function_exists( 'badoblog_fun_pr_set_hook_mes' ) ) {
        echo badoblog_fun_pr_set_hook_mes();
    }
}

//? ========== Display input fields
function badoblog_fun_theme_display_settings_hooks(  $args  ) {
    $desc = '';
    extract( $args );
    $opt_name = 'theme_options_hooks';
    $o = get_option( $opt_name );
    $text = ( isset( $o[$id] ) ? $o[$id] : '' );
    if ( $desc != '' ) {
        $d = "<br><span class='description'>{$desc}</span>";
    } else {
        $d = "";
    }
    switch ( $type ) {
        case 'textarea':
            echo "<textarea class='code large-text' cols='50' rows='10' type='text' id='" . esc_attr( $id ) . "' name='" . esc_attr( $opt_name ) . "[{$id}]'>" . trim( $text ) . "</textarea>";
            echo wp_kses_post( $d );
            break;
    }
}

//? ========== Input validation
function badoblog_fun_theme_validate_settings_hooks(  $input  ) {
    foreach ( $input as $k => $v ) {
        $valid_input[$k] = trim( $v );
    }
    return $valid_input;
}
