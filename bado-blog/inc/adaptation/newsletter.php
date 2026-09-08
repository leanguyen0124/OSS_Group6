<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Functions for Newsletter
* ------------------------------------------------------------------------------ */
function badoblog_fun_set_css_newsletter() {
    //---------- Common colors
    // General link color
    $color_link = '#1e73bb';
    // General link color on hover
    $link_hover = '#dd9925';
    // Site content background color
    $content_color = '#fdfcfc';
    //---------- Clear
    $css = '';
    //? ========== Style support
    if ( get_theme_mod( 'badoblog_cus_newsletter_css', 1 ) == 1 ) {
        //?---------- Scheme - Common
        // Common
        $css .= "\n      .tnp-subscription .tnp-field,\n      .tnp-widget-minimal .tnp-email {\n        margin-bottom: .7em;\n      }\n    ";
        // Checkbox
        $css .= "\n      .tnp-subscription .tnp-privacy-field label {\n        display: flex;\n      }\n    ";
        // Select
        $css .= "\n      .tnp-subscription .tnp-field-gender select {\n        border-radius: 12px;\n      }\n    ";
        // Popup
        $css .= "\n      div#tnp-modal-content {\n        border-radius: 20px;\n        background-color: {$content_color};\n      }\n      div#tnp-modal-close {\n        color: {$color_link};\n      }\n      div#tnp-modal-close:hover {\n        color: {$link_hover};\n      }\n    ";
        // Post
        $css .= "\n      .tnp-subscription-posts {\n        margin: 50px 15px;\n        padding: 30px;\n        border-radius: 20px;\n        box-shadow: 0 0.1em 0.5em rgba(0, 0, 0, 0.5);\n      }\n      .tnp-subscription-posts .tnp-subscription .tnp-submit {\n        padding: 16px 30px;\n      }\n    ";
        //?---------- Scheme - Standart style
        // Common button
        $css .= "\n      .tnp .tnp-submit:hover {\n        box-shadow: 0.01em 0.01em 0.3em rgba(0, 0, 0, 0.5);\n        transition: 0.2s;\n      }\n    ";
        // Widget
        $css .= "\n      .tnp-widget-minimal .tnp-form input.tnp-submit {\n        border-radius: 30px;\n      }\n    ";
    }
    if ( !empty( $css ) ) {
        wp_add_inline_style( 'badoblog-style-newsletter', $css );
    }
}

add_action( 'wp_enqueue_scripts', 'badoblog_fun_set_css_newsletter', 1 );