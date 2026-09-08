<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Sidebar
* ------------------------------------------------------------------------------ */
if ( function_exists( 'is_woocommerce' ) ) {
    wp_enqueue_script( 'badoblog-script-woo' );
}
function badoblog_fun_sidebar_1() {
    if ( is_single() && is_active_sidebar( 'sidebar-post' ) ) {
        echo '<aside id="secondary" class="badoblog-css-widget-area">';
        dynamic_sidebar( 'sidebar-post' );
        echo '</aside>';
    } else {
        if ( is_page() && is_active_sidebar( 'sidebar-page' ) ) {
            echo '<aside id="secondary" class="badoblog-css-widget-area">';
            dynamic_sidebar( 'sidebar-page' );
            echo '</aside>';
        } else {
            if ( is_front_page() && is_active_sidebar( 'sidebar-home' ) ) {
                echo '<aside id="secondary" class="badoblog-css-widget-area">';
                dynamic_sidebar( 'sidebar-home' );
                echo '</aside>';
            } else {
                if ( is_active_sidebar( 'sidebar-1' ) ) {
                    echo '<aside id="secondary" class="badoblog-css-widget-area">';
                    dynamic_sidebar( 'sidebar-1' );
                    echo '</aside>';
                } else {
                    if ( function_exists( 'badoblog_fun_sidebar_1_demo' ) ) {
                        echo '<aside id="secondary" class="badoblog-css-widget-area">';
                        badoblog_fun_sidebar_1_demo();
                        echo '</aside>';
                    }
                }
            }
        }
    }
}

badoblog_fun_sidebar_1();