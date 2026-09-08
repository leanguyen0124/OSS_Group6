<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Functions for BuddyPress
* ------------------------------------------------------------------------------ */
//? ========== Support for BuddyPress Styles
function badoblog_fun_set_css_buddypress() {
    //---------- Clear
    $css = '';
    //?---------- Disable sidebar on BuddyPress pages
    if ( get_theme_mod( 'badoblog_cus_buddypress_sidebar', 0 ) == 1 && is_buddypress() ) {
        $css .= "\n      .buddypress #primary,\n      .buddypress.badoblog-css-left-sidebar #primary {\n        width: 100%;\n        float: none;\n      }\n      .buddypress.badoblog-css-no-sidebar-center .badoblog-css-site-main {\n        width: 69.3%;\n      }\n      @media (max-width: 1100px) {\n        .buddypress.badoblog-css-no-sidebar-center .badoblog-css-site-main {\n          width: 100%;\n        }\n      }\n    ";
    }
    //?---------- Styles BuddyPress
    if ( get_theme_mod( 'badoblog_cus_buddypress_css_off', 0 ) == 0 ) {
        //?---------- Styles on pages BuddyPress
        if ( is_buddypress() ) {
            //---------- Common colors
            // Site content background color
            $content_color = '#fdfcfc';
            // Forms
            $css .= '
        .buddypress-wrap .select-wrap select option {
          background-color: ' . $content_color . ';
        }
      ';
        }
        // end is_buddypress
        // Here we add styles for widgets (beyond the influence of is_buddypress)
    }
    if ( !empty( $css ) ) {
        wp_add_inline_style( 'badoblog-style-buddypress', $css );
    }
}

add_action( 'wp_enqueue_scripts', 'badoblog_fun_set_css_buddypress', 1 );