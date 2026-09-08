<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Functions for bbPress
* ------------------------------------------------------------------------------ */
/*--------------------------------------------------------------
Content:
----------------------------------------------------------------
# Support for bbPress Styles
# Disable bbPress breadcrumbs
# Changing user role names
--------------------------------------------------------------*/
//? ========== Support for bbPress Styles
function badoblog_fun_set_css_bbpress() {
    //---------- Clear
    $css = '';
    //?---------- Disable sidebar on bbPress pages
    if ( get_theme_mod( 'badoblog_cus_bbpress_sidebar', 0 ) == 1 && is_bbpress() ) {
        $css .= "\n      .bbpress #primary,\n      .bbpress.badoblog-css-left-sidebar #primary {\n        width: 100%;\n        float: none;\n      }\n      .bbpress.badoblog-css-no-sidebar-center .badoblog-css-site-main {\n        width: 69.3%;\n      }\n      @media (max-width: 1100px) {\n        .bbpress.badoblog-css-no-sidebar-center .badoblog-css-site-main {\n          width: 100%;\n        }\n      }\n    ";
    }
    //?---------- Styles bbPress
    if ( get_theme_mod( 'badoblog_cus_bbpress_css_off', 0 ) == 0 ) {
        //?---------- Styles on pages bbPress
        if ( is_bbpress() ) {
            //---------- General colors
            // Primary theme color
            $primary_color = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_small', '#4c65ad' ) );
            //---------- Common colors
            // Site content background color
            $content_color = '#fdfcfc';
            // General text color
            $t_color = '#404040';
            // General link color
            $color_link = '#1e73bb';
            // General link color on hover
            $link_hover = '#dd9925';
            //---------- Only used to reassign another "important" in 3rd party plugins
            $i = '!important';
            // Field and form backgrounds
            $css .= "\n        .bbpress #bbpress-forums div.odd,\n        .bbpress #bbpress-forums ul.odd,\n        .bbpress #bbpress-forums div.even,\n        .bbpress #bbpress-forums ul.even,\n        .bbpress #bbpress-forums #bbp-your-profile fieldset input,\n        .bbpress #bbpress-forums #bbp-your-profile fieldset textarea,\n        .bbpress #bbpress-forums #bbp-your-profile fieldset p.description,\n        .bbpress #bbpress-forums #bbp-your-profile fieldset select {\n          background: {$content_color};\n        }\n        .bbpress .bbp-forum-content ul.sticky,\n        .bbpress .bbp-topics ul.sticky,\n        .bbpress .bbp-topics ul.super-sticky,\n        .bbpress .bbp-topics-front ul.super-sticky {\n          background: {$content_color} {$i};\n          border-left: 5px solid {$primary_color};\n        }\n        .bbpress #bbpress-forums div.bbp-forum-header,\n        .bbpress #bbpress-forums div.bbp-reply-header,\n        .bbpress #bbpress-forums div.bbp-topic-header {\n          background: rgba(0,0,0,0.05);\n        }\n        .bbpress #bbpress-forums li.bbp-footer,\n        .bbpress #bbpress-forums li.bbp-header,\n        .bbpress #bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a {\n          background: rgba(0,0,0,0.1);\n          opacity: 1;\n        }\n        .bbpress .bbpress-wrapper > ul,\n        .bbpress .bbp-user-section > ul {\n          border-radius: 15px;\n        }\n      ";
            // Text and links
            $css .= "\n        .bbpress span.bbp-author-ip,\n        .bbpress #bbpress-forums ul.status-closed,\n        .bbpress #bbpress-forums ul.status-closed a,\n        .bbpress #bbpress-forums .bbp-reply-content ul.bbp-reply-revision-log {\n          color: {$t_color};\n        }\n        .bbpress .bbp-forum-header a.bbp-forum-permalink,\n        .bbpress .bbp-reply-header a.bbp-reply-permalink,\n        .bbpress .bbp-topic-header a.bbp-topic-permalink,\n        .bbpress span.bbp-admin-links a,\n        .bbpress #bbpress-forums ul.status-closed a {\n          color: {$color_link};\n        }\n        .bbpress .bbp-forum-header a.bbp-forum-permalink:hover,\n        .bbpress .bbp-reply-header a.bbp-reply-permalink:hover,\n        .bbpress .bbp-topic-header a.bbp-topic-permalink:hover,\n        .bbpress span.bbp-admin-links a:hover,\n        .bbpress #bbpress-forums ul.status-closed a:hover         {\n          color: {$link_hover};\n        }\n        .bbpress select.bbp_dropdown option:disabled {\n          color: {$primary_color};\n        }\n      ";
            // Forms
            $css .= '
        .bbpress .wp-editor-container {
          border: 1px solid ' . $primary_color . ';
        }
      ';
            // Button (search)
            $css .= '
        .bbpress input[type="submit"] {
          font-size: 16px;
        }
        .bbpress #bbpress-forums #bbp-user-wrapper h2.entry-title {
          padding-top: 10px;
        }
        @media (max-width: 480px) {
          .bbpress div.bbp-search-form input.button {
            font-size: 12px;
            padding: .3em 1em;
          }
        }
        @media (max-width: 700px) {
          .bbpress .bbp-search-form,
          .bbpress .entry-title {
            width: 100%;
          }
        }
      ';
            // Pagination
            $css .= "\n        .bbpress #bbpress-forums .bbp-pagination-links span.current,\n        .bbpress #bbpress-forums .bbp-pagination-links a:hover {\n          color: #404040;\n        }\n      ";
        }
        // end is_bbpress
        //?---------- Styles outside of pages bbPress (for widgets)
        $css .= '
      .bbp-remember-me {
        display: flex;
        align-items: center;
      }
      .bbp-search-form input {
        margin-bottom: 15px;
        width: auto;
      }
      .bbp-author-name {
        margin-left: 5px;
      }
      .widget .bbp-search-form input[type="text"] {
        width: 100%;
      }
    ';
        //?---------- Common styles (fix and adaptation)
        $css .= '
      /* Editing the category name in the list of forums (sticks to neighboring elements) */
      li.bbp-forum.css-sep a {
        padding-left: 5px;
      }

      /* Edit post date (sticks to neighboring elements) */
      .bbp-reply-post-date {
        margin-right: 10px;
      }

      /* Removing unnecessary columns in the list of forums on small screens */
      @media (max-width: 480px) {
        .bbp-topic-voice-count,
        .bbp-topic-reply-count,
        .bbp-topic-freshness,
        .bbp-forum-topic-count,
        .bbp-forum-reply-count,
        .bbp-forum-freshness {
          display: none;
        }
        .bbpress li.bbp-topic-title,
        .bbpress li.bbp-topic-info,
        .bbpress li.bbp-forum-title,
        .bbpress li.bbp-forum-info {
          width: 100%;
        }
      }

      /* Button common */
      .bbpress .button:hover {
        box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);
        transition: 0.2s;
      }

      /* Search */
      .bbpress .bbp-search-form input.button {
        border-radius: 0 15px 15px 0;
      }
      .bbpress .bbp-search-form input[type="text"] {
        border-radius: 15px 0 0 15px;
      }

      /* Login form */
      .bbpress #bbpress-forums fieldset.bbp-form input[type=text],
      .bbpress #bbpress-forums fieldset.bbp-form input[type=password] {
        height: 50px;
        padding-left: 15px;
      }

      /* notice */
      .bbpress .bbp-template-notice {
        border-radius: 12px;
      }

      .bbpress .bbp-search-form div {
        display: flex;
      }


      /* 
      Avatar 
      */

      /* fix padding avatar */
      .bbpress .fn {
        padding: 0;
      }

      #bbpress-forums div.bbp-forum-author img.avatar,
      #bbpress-forums div.bbp-reply-author img.avatar,
      #bbpress-forums div.bbp-topic-author img.avatar,
      #bbpress-forums #bbp-single-user-details #bbp-user-avatar img.avatar {
        border-radius: 100px;
      }


      /* 
      Widgets 
      */

      /* Login */
      .bbp-login-form .bbp-form {
        border-radius: 20px;
      }
      .bbp-login-form label {
        font-size: 14px;
        width: auto;
      }

      .bbp-login-form .bbp-form input[type="text"],
      .bbp-login-form .bbp-form input[type="password"] {
        padding-left: 15px;
      }

      /* Statistic */
      .widget_display_stats .bbp-stats dd {
        border: 2px solid rgba(0, 0, 0, 0.4);
        margin: 5px 10px 1.5em;
        padding: 5px 5px 5px 20px;
        border-radius: 15px;
      }


      /* 
      Forms 
      */
      .bbpress #bbpress-forums fieldset.bbp-form input[type="checkbox"] {
        margin-right: 7px;
      }
      .bbpress #bbpress-forums fieldset.bbp-form label {
        margin-bottom: 3px;
      }
      #bbpress-forums div.wp-editor-container {
        border-radius: 18px;
        overflow: hidden;
      }
      #bbpress-forums fieldset.bbp-form select.bbp_dropdown {
        height: 40px;
        border-radius: 12px;
        padding-left: 10px;
      }
    ';
    }
    if ( !empty( $css ) ) {
        wp_add_inline_style( 'badoblog-style-bbpress', $css );
    }
}

add_action( 'wp_enqueue_scripts', 'badoblog_fun_set_css_bbpress', 1 );