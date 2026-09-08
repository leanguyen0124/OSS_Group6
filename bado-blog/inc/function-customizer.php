<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Functions for customizer
* ------------------------------------------------------------------------------ */
//?-----------------------------------------------------------------------------------------------------------
//?---------- Connecting the customizer settings
//?-----------------------------------------------------------------------------------------------------------
function badoblog_fun_set_css() {
    //----------------------------------------------------------------------------------
    //region Variables
    //----------------------------------------------------------------------------------
    //---------- General colors
    // Primary theme color
    $primary_color = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_small', '#4c65ad' ) );
    // Related elements for the main theme color
    $color_lite = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_small_lite', '#fffffc' ) );
    // Background color of large elements
    $primary_big_color = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_big', '#505062' ) );
    // Related color for large elements
    $primary_big_lite_color = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_big_lite', '#fffffb' ) );
    // Site fill color
    $fill_site = esc_attr( get_theme_mod( 'badoblog_cus_colors_site_fill', '' ) );
    // Site background color
    $background_site = esc_attr( get_theme_mod( 'background_color' ) );
    //---------- Common colors
    // Heading text general color
    $h_color = '#404046';
    // General text color
    $t_color = '#404040';
    // General link color
    $color_link = '#1e73bb';
    // General link color on hover
    $link_hover = '#dd9925';
    // Site content background color
    $content_color = '#fdfcfc';
    // Header background color
    $header_color = '';
    //---------- Ticker
    // Ticker color
    $ticker_color = '';
    //---------- Breadcrumbs
    // Breadcrumbs header text color
    $bread_h_color = '';
    // Breadcrumb link text color
    $bread_a_color = '';
    // Breadcrumb link text color on hover
    $bread_a_hover_color = '';
    // Breadcrumbs background color
    $bread_back_color = '';
    //---------- Footer
    // Footer background color
    $footer_back_color = '';
    // Widgets header fill color in footer
    $widget_footer_h_back_color = '';
    // Widgets headers text color in footer
    $widget_footer_h_color = '';
    // Footer text color
    $footer_text_color = '';
    // Footer link color
    $footer_a_color = '';
    // Footer links color (on hover)
    $footer_a_hover = '';
    // Footer elements color
    $footer_primary_color = '';
    //---------- Main menu
    // Background color main menu
    $menu_back_color = '';
    // Text color main menu
    $menu_a_color = '';
    // Background color main menu (on hover)
    $menu_hover_back_color = '';
    // Text color main menu (on hover)
    $menu_hover_a_color = '';
    //---------- Main menu (lists)
    // Main menu background color (submenu)
    $submenu_back_color = '';
    // Main menu links color (submenu)
    $submenu_a_color = '';
    //---------- Top menu
    // Top menu text color
    $top_menu_text_color = '';
    // Top menu text color (on hover)
    $top_menu_text_hover = '';
    // Top drop-down menu background color
    $top_menu_back_color = '';
    // Top drop-down menu links color
    $top_menu_sub_link = '';
    // Top drop-down menu links background color (on hover)
    $top_menu_back_hover = '';
    //---------- Widgets
    // Background for widgets in columns
    $widget_back_color = '';
    // Background color for widget headers in columns
    $widget_h_back_color = '';
    // Widgets headers text color in columns
    $widget_h_text_color = '';
    // Text color of menu items of basic classic widgets
    $widget_menu_text_color = '';
    // Text color of menu items of basic classic widgets (on hover)
    $widget_menu_hover_color = '';
    // Background color of menu items of basic classic widgets
    $widget_menu_back_color = '';
    // Background color of menu items of basic classic widgets (on hover)
    $widget_menu_back_color_hover = '';
    //---------- Template orientation
    // Max width site
    $max_width_site = get_theme_mod( 'badoblog_cus_lay_max_width', '1560' );
    //---------- Top panel width proportion
    $top_width = esc_attr( get_theme_mod( 'badoblog_cus_ticker_width', '70' ) );
    //---------- Logo - banner - soc
    $banner_top = esc_attr( get_theme_mod( 'badoblog_cus_banner', 0 ) );
    $soc_anime = esc_attr( get_theme_mod( 'badoblog_cus_soc_anime', 'a5' ) );
    $soc_active = esc_attr( get_theme_mod( 'badoblog_cus_soc', 1 ) );
    $move_soc_image = esc_attr( get_theme_mod( 'badoblog_cus_header_image_soc', 0 ) );
    //---------- Categories
    // Number (size) of columns in categories
    $cat_win = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_win', 'w2' ) );
    // Background color for posts blocks in categories
    $back_cat_color = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_back_color' ) );
    // Remove "Read more" button in categories
    $more_cat = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_more', 0 ) );
    // Remove description in categories
    $des_cat_none = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_entry_none', 0 ) );
    // Remove category headings
    $h_cat_none = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_title_none', 0 ) );
    // Animation of blocks in categories
    $anime_cat = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_anime', 'a1' ) );
    // Background color of sticky posts
    $sticky_color = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_back_sticky' ) );
    // Meta tags in categories
    $cat_meta_boxs = esc_attr( get_theme_mod( 'badoblog_cus_cat_meta_boxs', 1 ) );
    // Meta tags categories in categories
    $cat_meta_cat = esc_attr( get_theme_mod( 'badoblog_cus_cat_meta_cat', 1 ) );
    // Layout Meta tags categories in categories
    $cat_meta_cat_lay = esc_attr( get_theme_mod( 'badoblog_cus_cat_meta_cat_layout', 'thumb-bottom' ) );
    // Meta tags tax tags in categories
    $cat_meta_tag = esc_attr( get_theme_mod( 'badoblog_cus_cat_meta_tag', 1 ) );
    // Variation of pagination in categories
    $pagi_cat = esc_attr( get_theme_mod( 'badoblog_cus_pagination_variant', 'v1' ) );
    // Design for numeric pagination
    $pagi_design_cat = esc_attr( get_theme_mod( 'badoblog_cus_pagination_design', 'v1' ) );
    // Location of the numeric pagination
    $pagi_layout_cat = esc_attr( get_theme_mod( 'badoblog_cus_pagination_layout', 'v2' ) );
    // Size of the numeric pagination
    $pagi_size_cat = esc_attr( get_theme_mod( 'badoblog_cus_pagination_size', 'v2' ) );
    //---------- Posts
    // Quote block display variation
    $quote_block = esc_attr( get_theme_mod( 'badoblog_cus_post_quote', 'v1' ) );
    // Quote block background color
    $quote_back_color = esc_attr( get_theme_mod( 'badoblog_cus_post_quote_back_color' ) );
    // Quote block text color
    $quote_text_color = esc_attr( get_theme_mod( 'badoblog_cus_post_quote_text_color' ) );
    // Background color of icons and lines in block quotes
    $quote_icon_back = esc_attr( get_theme_mod( 'badoblog_cus_post_quote_element_color' ) );
    // Quote block icon size
    $quote_icon_size = esc_attr( get_theme_mod( 'badoblog_cus_post_quote_icon_size', 36 ) );
    // Quote block icons color
    $quote_icon_color = esc_attr( get_theme_mod( 'badoblog_cus_post_quote_icon_color' ) );
    // Bulleted list display variation
    $mark_list = esc_attr( get_theme_mod( 'badoblog_cus_post_li_mark', 'v1' ) );
    // Numbered list display variation
    $num_list = esc_attr( get_theme_mod( 'badoblog_cus_post_li_num', 'v5' ) );
    // Bulleted list markers color
    $l_mark_color = esc_attr( get_theme_mod( 'badoblog_cus_post_li_mark_color' ) );
    // Numbered list bullet background color
    $l_num_color = esc_attr( get_theme_mod( 'badoblog_cus_post_li_num_back_color' ) );
    // Numbered list bullet text color
    $l_num_text_color = esc_attr( get_theme_mod( 'badoblog_cus_post_li_num_text_color' ) );
    // H2 heading variation selection (posts and pages)
    $h2_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h2', 'off' ) );
    // H2 heading icons text color (posts and pages)
    $h2_text_icon_color = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_icon_text_color' ) );
    // H2 header icons background color (posts and pages)
    $h2_icon_back = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_element_color' ) );
    // Variation selection H3 - H6 headings (posts and pages)
    $h36_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h36', 'off' ) );
    // Icon text color H3 - H6 headings (posts and pages)
    $h36_text_icon_color = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_icon_text_color' ) );
    // Icon background color H3 - H6 headings (posts and pages)
    $h36_icon_back = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_element_color' ) );
    // Author block separator variations
    $bio_post_border = esc_attr( get_theme_mod( 'badoblog_cus_post_bio_design', 'v1' ) );
    // Change the style of author block separators
    $bio_post_line = esc_attr( get_theme_mod( 'badoblog_cus_post_bio_design_line', 'solid' ) );
    // Changing the thickness of author block dividers
    $bio_post_size = esc_attr( get_theme_mod( 'badoblog_cus_post_bio_design_size', 1 ) );
    //---------- Main Page
    // Color of section headings on the main page
    $home_h_size = esc_attr( get_theme_mod( 'badoblog_cus_home_set_h_size', 20 ) );
    $home_h_color = esc_attr( get_theme_mod( 'badoblog_cus_home_set_h_color' ) );
    //---------- Typography
    $serif = array(
        'bitter',
        'charis-sil',
        'cormorant-infant',
        'lora',
        'merriweather',
        'spectral-sc',
        'roboto-slab'
    );
    $cursive = array(
        'bellota',
        'comfortaa',
        'amatic-sc',
        'pacifico',
        'neucha',
        'marck-script',
        'lobster',
        'caveat',
        'bad-script',
        'underdog',
        'pangolin',
        'viaoda-libre'
    );
    //---------- Clear
    $css = '';
    //----------------------------------------------------------------------------------
    //region General Colors
    //----------------------------------------------------------------------------------
    //?---------- Site fill color
    if ( !empty( $fill_site ) ) {
        $css .= '
      #page {
        background: ' . $fill_site . ';
      }
    ';
    }
    //?---------- Site background color
    if ( !empty( $background_site ) ) {
        $css .= '
      body.custom-background {
        background: #' . $background_site . ';
      }
    ';
    }
    //?---------- Elements color
    if ( $primary_color != '#4c65ad' ) {
        $css .= '
      button,input[type="button"],
      input[type="reset"],
      input[type="submit"],
      .badoblog-css-mega-menu > ul > li,
      .badoblog-css-mega-menu > ul > li > ul > li > ul > li > ul > li:before,
      a.badoblog-css-more-link,
      #comments .reply a,
      .badoblog-css-sitemap-pagi a,
      .badoblog-css-post-meta-data-tax a,
      .badoblog-css-cat-meta-tax-cat a {
        background: ' . $primary_color . ';
      }
      [id="badoblog-id-nav-top-mobile-toggle"]:checked ~ .badoblog-css-nav-top-mobile > .badoblog-css-nav-top-mobile-title > .badoblog-css-nav-top-mobile-toggle:after,
      .widget_categories li:before,
      .widget_archive li:before,
      .widget_recent_entries li:before,
      .badoblog-css-sitemap-cat li:before,
      .badoblog-css-search-top-bar .badoblog-css-top-search-button,
      .icon-autor-post-meta::before,
      .icon-calendar-post-meta::before,
      .icon-spinner-post-meta::before,
      .icon-bubble-post-meta::before,
      .icon-clock-post-meta::before,
      .icon-eye-post-meta::before,
      .icon-cat-post-meta::before,
      .icon-tag-post-meta::before {
        color: ' . $primary_color . ';
      }
      .badoblog-css-site-brand-banner,
      .badoblog-css-mega-menu > ul > li > ul,
      .search-wrap input[type="text"],
      input[type="text"],
      input[type="email"],
      input[type="url"],
      input[type="password"],
      input[type="number"],
      input[type="tel"],
      input[type="range"],
      input[type="date"],
      input[type="month"],
      input[type="week"],
      input[type="time"],
      input[type="datetime"],
      input[type="datetime-local"],
      input[type="color"],
      .site input[type="search"],
      .widget select,
      textarea,
      select,
      a:focus img,
      .badoblog-css-mod-pp-content .wp-block-post-comments-form input:not([type=submit]):not([type=checkbox]),
      .badoblog-css-mod-pp-content .wp-block-post-comments-form textarea,
      .badoblog-css-sitemap-pagi span.current,
      .badoblog-css-top-bar,
      .badoblog-css-nav-top-mobile-title,
      .badoblog-css-mega-menu > ul > li > ul > li a,
      .widget_block .wp-block-quote,
      .chosen-container div.chosen-drop,
      .chosen-container-single a.chosen-single,
      .chosen-container-active.chosen-with-drop a.chosen-single {
        border-color: ' . $primary_color . ';
      }
      a:focus {
        outline-color: ' . $primary_color . ';
      }
      @supports selector(:focus-visible) {
        a:focus {
          outline: none;
        }
        a:focus-visible {
          outline: 2px solid ' . $primary_color . ';
        }
        a:focus img {
          border: none;
        }
        a:focus-visible img {
          border: 1px solid ' . $primary_color . ';
        }
      }
    ';
    }
    //?---------- Related color for elements
    if ( $color_lite != '#fffffc' ) {
        $css .= '
      a.badoblog-css-more-link,
      a:hover.badoblog-css-more-link,
      #comments .reply a,
      #comments .reply a:hover,
      button,
      input[type="button"],
      input[type="reset"],
      input[type="submit"],
      .badoblog-css-sitemap-pagi a,
      .badoblog-css-sitemap-pagi a:hover,
      .badoblog-css-mega-menu > ul > li > a,
      .badoblog-css-mega-menu-dropdown-icon:before,
      .badoblog-css-post-meta-data-tax a,
      .badoblog-css-post-meta-data-tax a:hover,
      .badoblog-css-cat-meta-tax-cat a,
      .badoblog-css-cat-meta-tax-cat a:hover {
        color: ' . $color_lite . ';
      }
    ';
    }
    //?---------- General link color
    if ( $color_link != '#1e73bb' ) {
        $css .= '
      a,
      .badoblog-css-nav-top-mobile-burger:after,
      .site .wp-block-file__button {
        color: ' . $color_link . ';
      }
      .badoblog-css-nav-top-mobile-burger:after {
        border-color: ' . $color_link . ';
      }
      button.badoblog-css-toggle-btn .badoblog-css-toggle-bar {
        background: ' . $color_link . ';
      }
    ';
    }
    //?---------- General link color on hover
    if ( $link_hover != '#dd9925' ) {
        $css .= "\n      a:hover,\n      .badoblog-css-entry-title a:hover,\n      .badoblog-css-related-post-title a:hover,\n      .badoblog-css-related-post-box:hover .badoblog-css-related-post-title,\n      .badoblog-css-home-vertical-grid-column h2:hover,\n      .site .wp-block-file__button:hover {\n        color: {$link_hover};\n      }\n    ";
    }
    //?---------- Background color of large elements
    if ( $primary_big_color != '#505062' ) {
        $css .= '
      .badoblog-css-np-post,
      .badoblog-css-bio-post-box h2,
      .badoblog-css-site-footer,
      .badoblog-css-site-footer textarea,
      .badoblog-css-site-footer select,
      .badoblog-css-site-footer pre,
      .badoblog-css-site-footer input[type="text"],
      .badoblog-css-site-footer input[type="email"],
      .badoblog-css-site-footer input[type="url"],
      .badoblog-css-site-footer input[type="password"],
      .badoblog-css-site-footer input[type="search"],
      .badoblog-css-site-footer input[type="number"],
      .badoblog-css-site-footer input[type="tel"],
      .badoblog-css-site-footer input[type="range"],
      .badoblog-css-site-footer input[type="date"],
      .badoblog-css-site-footer input[type="month"],
      .badoblog-css-site-footer input[type="week"],
      .badoblog-css-site-footer input[type="time"],
      .badoblog-css-site-footer input[type="datetime"],
      .badoblog-css-site-footer input[type="datetime-local"],
      .badoblog-css-site-footer input[type="color"],
      .badoblog-css-site-footer .widget_search input[type="text"],
      .badoblog-css-site-footer .widget_block .wp-block-code,
      .badoblog-css-site-footer .widget_block .wp-block-verse,
      .badoblog-css-site-footer .chosen-container div.chosen-drop,
      .badoblog-css-site-footer .chosen-container-single a.chosen-single,
      .badoblog-css-home-five-grid-box,
      .badoblog-css-home-narrow-grid-column:hover {
        background: ' . $primary_big_color . ';
      }
    ';
    }
    //?---------- Related color for large elements
    if ( $primary_big_lite_color != '#fffffb' ) {
        $css .= '
      .badoblog-css-np-post,
      .badoblog-css-site-footer,
      .badoblog-css-site-footer a,
      .badoblog-css-site-footer li,
      .badoblog-css-site-footer h2,
      .badoblog-css-site-footer input[type="text"],
      .badoblog-css-site-footer input[type="email"],
      .badoblog-css-site-footer input[type="url"],
      .badoblog-css-site-footer input[type="password"],
      .badoblog-css-site-footer input[type="search"],
      .badoblog-css-site-footer input[type="number"],
      .badoblog-css-site-footer input[type="tel"],
      .badoblog-css-site-footer input[type="range"],
      .badoblog-css-site-footer input[type="date"],
      .badoblog-css-site-footer input[type="month"],
      .badoblog-css-site-footer input[type="week"],
      .badoblog-css-site-footer input[type="time"],
      .badoblog-css-site-footer input[type="datetime"],
      .badoblog-css-site-footer input[type="datetime-local"],
      .badoblog-css-site-footer input[type="color"], 
      .badoblog-css-site-footer textarea,
      .badoblog-css-site-footer figcaption.wp-element-caption,
      .badoblog-css-site-footer .wp-block-calendar table caption,
      .badoblog-css-site-footer .wp-block-calendar table tbody,
      .badoblog-css-site-footer [class^="wp-block-"] figcaption,
      .badoblog-css-site-footer .blocks-gallery-caption,
      .badoblog-css-site-footer .chosen-container-single .chosen-single span,
      .badoblog-css-site-title,
      .badoblog-css-site-title a,
      .badoblog-css-site-description,
      .badoblog-css-breadcrumbs,
      .badoblog-css-breadcrumbs a,
      .badoblog-css-home-narrow-grid-column:hover .badoblog-css-home-narrow-grid-column-h h2 {
        color: ' . $primary_big_lite_color . ';
      }
    ';
    }
    //?---------- Background color main menu
    if ( !empty( $menu_back_color ) ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li {
        background: ' . $menu_back_color . ';
      }
    ';
    }
    //?---------- Background color main menu (on hover)
    if ( !empty( $menu_hover_back_color ) ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li:hover,
      .badoblog-css-mega-menu > ul > li > a:focus {
        background: ' . $menu_hover_back_color . ';
      }
    ';
    }
    //?---------- Text color main menu
    if ( !empty( $menu_a_color ) ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li > a,
      .badoblog-css-mega-menu-dropdown-icon:before {
        color: ' . $menu_a_color . ';
      }
    ';
    }
    //?---------- Text color main menu (on hover)
    if ( !empty( $menu_hover_a_color ) ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li:hover > a,
      .badoblog-css-mega-menu-dropdown-icon:hover:before {
        color: ' . $menu_hover_a_color . ';
      }
    ';
    }
    //?---------- Main menu background color (submenu)
    if ( !empty( $submenu_back_color ) ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li > ul {
        background: ' . $submenu_back_color . ';
      }
    ';
    }
    //?---------- Main menu link color (submenu)
    if ( !empty( $submenu_a_color ) ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li > ul > li a,
      .badoblog-css-mega-menu > ul > li > ul.normal-sub > li a,
      .badoblog-css-mega-menu > ul > li > ul > li a:hover,
      .badoblog-css-mega-menu > ul > li > ul.normal-sub > li a:hover {
        color: ' . $submenu_a_color . ';
      }
    ';
    }
    //?---------- Top menu text color
    if ( !empty( $top_menu_text_color ) ) {
        $css .= "\n      .badoblog-css-top-jsmenu-pc div > ul > li > a,\n\t    .badoblog-css-top-menu-pc div > ul > li > a,\n      .badoblog-css-nav-top-mobile-burger:after {\n        color: {$top_menu_text_color};\n      }\n      .badoblog-css-nav-top-mobile-burger:after {\n        border-color: {$top_menu_text_color};\n      }\n      button.badoblog-css-toggle-btn .badoblog-css-toggle-bar {\n        background: {$top_menu_text_color};\n      }\n    ";
    }
    //?---------- Top drop-down menu links color
    if ( !empty( $top_menu_sub_link ) ) {
        $css .= "\n      .badoblog-css-top-jsmenu-pc .sub-menu li a,\n      .badoblog-css-top-jsmenu-mobile a,\n      .badoblog-css-top-jsmenu-mobile button,\n      .badoblog-css-top-menu-pc ul ul a,\n      .badoblog-css-nav-top-mobile a {\n        color: {$top_menu_sub_link};\n      }\n      .badoblog-css-top-jsmenu-box .badoblog-css-top-jsmenu-mobile .badoblog-css-close-top-jsmenu-nav-toggle:before,\n      .badoblog-css-top-jsmenu-box .badoblog-css-top-jsmenu-mobile .badoblog-css-close-top-jsmenu-nav-toggle:after {\n        background: {$top_menu_sub_link};\n      }\n    ";
    }
    //?---------- Top drop-down menu links color (on hover)
    if ( !empty( $top_menu_text_hover ) ) {
        $css .= '
      .badoblog-css-top-jsmenu-box li > a:hover,
      .badoblog-css-top-jsmenu-box li > a:focus,
      .badoblog-css-top-jsmenu-pc .sub-menu li a:hover,
      .badoblog-css-top-jsmenu-pc .sub-menu li a:focus,
      .badoblog-css-top-jsmenu-mobile li.menu-item-has-children a:hover + button,
      .badoblog-css-top-jsmenu-mobile li.menu-item-has-children a:focus + button,
      .badoblog-css-top-menu-pc li:hover > a,
      .badoblog-css-nav-top-mobile a:hover {
        color: ' . $top_menu_text_hover . ';
      }
    ';
    }
    //?---------- Top drop-down menu background color
    if ( !empty( $top_menu_back_color ) ) {
        $css .= "\n      .badoblog-css-top-jsmenu-mobile,\n      .badoblog-css-top-jsmenu-pc ul .sub-menu,\n      .badoblog-css-nav-top-mobile,\n      .badoblog-css-top-menu-pc ul ul {\n        background: {$top_menu_back_color};\n      }\n    ";
    }
    //?---------- Top drop-down menu links background color (on hover)
    if ( !empty( $top_menu_back_hover ) ) {
        $css .= '
      .badoblog-css-top-jsmenu-box li > a:hover,
      .badoblog-css-top-jsmenu-box li > a:focus,
      .badoblog-css-top-jsmenu-pc .sub-menu li a:hover,
      .badoblog-css-top-jsmenu-pc .sub-menu li a:focus,
      .badoblog-css-top-menu-pc li:hover > a,
      .badoblog-css-nav-top-mobile a:hover {
        background: ' . $top_menu_back_hover . ';
      }
    ';
    }
    //?---------- Site body background color
    if ( $content_color != '#fdfcfc' ) {
        $css .= '
      #primary,
      #secondary,
      #respond,
      #comments,
      #comments .comment-meta,
      textarea,
      select,
      pre,
      input[type="text"],
      input[type="email"],
      input[type="url"],
      input[type="password"],
      input[type="search"],
      input[type="number"],
      input[type="tel"],
      input[type="range"],
      input[type="date"],
      input[type="month"],
      input[type="week"],
      input[type="time"],
      input[type="datetime"],
      input[type="datetime-local"],
      input[type="color"],
      .widget_search input[type="text"],
      .widget_block .wp-block-code,
      .widget_block .wp-block-verse,
      .chosen-container div.chosen-drop,
      .chosen-container-single a.chosen-single,
      .badoblog-css-top-bar,
      .badoblog-css-nav-top-mobile-title,
      .badoblog-css-owl-width-slider-container,
      .badoblog-css-top-search-modal-inner,
      .badoblog-css-site-branding,
      .badoblog-css-mega-menu-container,
      .badoblog-css-menucat {
        background: ' . $content_color . ';
      }
    ';
    }
    //?---------- Site header background color
    if ( !empty( $header_color ) ) {
        $css .= '
      .badoblog-css-site-branding {
        background: ' . $header_color . ';
      }
    ';
    }
    //?---------- General text color
    if ( $t_color != '#404040' ) {
        $css .= '
      body,
      textarea,
      select,
      pre,
      input[type="text"],
      input[type="email"],
      input[type="url"],
      input[type="password"],
      input[type="search"],
      input[type="number"],
      input[type="tel"],
      input[type="range"],
      input[type="date"],
      input[type="month"],
      input[type="week"],
      input[type="time"],
      input[type="datetime"],
      input[type="datetime-local"],
      input[type="color"],
      .site figcaption.wp-element-caption,
      .site .wp-block-calendar table caption,
      .site .wp-block-calendar table tbody,
      .site [class^="wp-block-"] figcaption,
      .site .blocks-gallery-caption,
      .chosen-container-single .chosen-single span,
      .badoblog-css-search-top-bar .badoblog-css-top-search-button:hover {
        color: ' . $t_color . ';
      }
    ';
    }
    //?---------- Heading text general color
    if ( $h_color != '#404046' ) {
        $css .= '
      h1, h2, h3, h4, h5, h6,
      .badoblog-css-site-title,
      .badoblog-css-site-title a,
      .badoblog-css-nav-top-mobile-h {
        color: ' . $h_color . ';
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Typography
    //----------------------------------------------------------------------------------
    //? ---------- General text font
    $font_1 = get_theme_mod( 'badoblog_cus_typography_font', 'off' );
    if ( $font_1 !== 'off' ) {
        $famaly = '';
        if ( in_array( $font_1, $serif ) ) {
            $famaly = 'serif';
        } elseif ( in_array( $font_1, $cursive ) ) {
            $famaly = 'cursive';
        } else {
            $famaly = 'sans-serif';
        }
        $css .= '
      body {
        font-family: "' . $font_1 . '", ' . $famaly . ';
      }
    ';
    }
    //? ---------- Overall text size
    $text_size_1 = esc_attr( get_theme_mod( 'badoblog_cus_typography_text_size', 18 ) );
    if ( $text_size_1 != 18 ) {
        $css .= '
      body {
        font-size: ' . $text_size_1 . 'px;
      }
    ';
    }
    //? ---------- Total line height of text
    $text_height_1 = esc_attr( get_theme_mod( 'badoblog_cus_typography_text_height', '1.5' ) );
    if ( $text_height_1 !== '1.5' ) {
        $css .= "\n      body {\n        line-height: {$text_height_1};\n      }\n    ";
    }
    //? ---------- General heading font
    $font_h = get_theme_mod( 'badoblog_cus_typography_h_font', 'off' );
    if ( $font_h !== 'off' ) {
        $famaly = '';
        if ( in_array( $font_h, $serif ) ) {
            $famaly = 'serif';
        } elseif ( in_array( $font_h, $cursive ) ) {
            $famaly = 'cursive';
        } else {
            $famaly = 'sans-serif';
        }
        $css .= '
      h1, h2, h3, h4, h5, h6 {
        font-family: "' . $font_h . '", ' . $famaly . ';
      }
    ';
    }
    //? ---------- The total size of h1 headings
    $size_h1 = esc_attr( get_theme_mod( 'badoblog_cus_typography_h1_size', 32 ) );
    if ( $size_h1 != 32 ) {
        $css .= '
      h1 {
        font-size: ' . $size_h1 . 'px;
      }
    ';
    }
    //? ---------- The total size of h2 headings
    $size_h2 = esc_attr( get_theme_mod( 'badoblog_cus_typography_h2_size', 26 ) );
    if ( $size_h2 != 26 ) {
        $css .= '
      h2 {
        font-size: ' . $size_h2 . 'px;
      }
    ';
    }
    //? ---------- The total size of h3 headings
    $size_h3 = esc_attr( get_theme_mod( 'badoblog_cus_typography_h3_size', 24 ) );
    if ( $size_h3 != 24 ) {
        $css .= '
      h3 {
        font-size: ' . $size_h3 . 'px;
      }
    ';
    }
    //? ---------- The total size of h4 headings
    $size_h4 = esc_attr( get_theme_mod( 'badoblog_cus_typography_h4_size', 22 ) );
    if ( $size_h4 != 22 ) {
        $css .= '
      h4 {
        font-size: ' . $size_h4 . 'px;
      }
    ';
    }
    //? ---------- The total size of h5 headings
    $size_h5 = esc_attr( get_theme_mod( 'badoblog_cus_typography_h5_size', 20 ) );
    if ( $size_h5 != 20 ) {
        $css .= '
      h5 {
        font-size: ' . $size_h5 . 'px;
      }
    ';
    }
    //? ---------- The total size of h6 headings
    $size_h6 = esc_attr( get_theme_mod( 'badoblog_cus_typography_h6_size', 18 ) );
    if ( $size_h6 != 18 ) {
        $css .= '
      h6 {
        font-size: ' . $size_h6 . 'px;
      }
    ';
    }
    //? ---------- Overall titles line height
    $h_height = esc_attr( get_theme_mod( 'badoblog_cus_typography_h_height', '1.5' ) );
    if ( $h_height !== '1.5' ) {
        $css .= "\n      h1, h2, h3, h4, h5, h6 {\n        line-height: {$h_height};\n      }\n    ";
    }
    //----------------------------------------------------------------------------------
    //region Site Width
    //----------------------------------------------------------------------------------
    if ( $max_width_site != '1560' && $max_width_site != 'full' ) {
        $css .= '
      .badoblog-css-full-max-width #page {
        max-width: ' . $max_width_site . 'px;
      }
    ';
        $max_width_60 = $max_width_site - 60;
        // Take away the indents
        $css .= '
      .badoblog-css-full-max-width .badoblog-css-mega-menu,
      .badoblog-css-full-max-width .badoblog-css-mega-menu-container,
      .badoblog-css-full-max-width .badoblog-css-site-footer-container {
        max-width: ' . $max_width_60 . 'px;
      }
    ';
        // for fix menu
        $max_width_17 = $max_width_site + 17;
        // Take away the indents
        $css .= '
      @media (max-width: ' . $max_width_17 . 'px) {
        .badoblog-css-full-max-width .badoblog-css-mega-menu-container {
          max-width: none;
          left: 0;
          right: 0;
        }
      }
    ';
    } else {
        if ( $max_width_site == 'full' ) {
            // for fix menu
            $css .= '
      .badoblog-css-full-max-width .badoblog-css-mega-menu-container {
        left: 0;
        right: 0;
      }
    ';
        }
    }
    //----------------------------------------------------------------------------------
    //region Margin Site
    //----------------------------------------------------------------------------------
    //? ---------- Add margin at the top and bottom of the site
    $margin_site_top = esc_attr( get_theme_mod( 'badoblog_cus_lay_margin_top', 0 ) );
    if ( $margin_site_top != 0 ) {
        $css .= '
      @media screen and (min-width: 1400px) {
        #page {
          margin-top: ' . $margin_site_top . 'px;
        }
      }
    ';
    }
    $margin_site_bottom = esc_attr( get_theme_mod( 'badoblog_cus_lay_margin_bottom', 0 ) );
    if ( $margin_site_bottom != 0 ) {
        $css .= '
      @media screen and (min-width: 1400px) {
        #page {
          margin-bottom: ' . $margin_site_bottom . 'px;
        }
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Title and Logo
    //----------------------------------------------------------------------------------
    $logo_var = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_logo_var', 'fix' ) );
    $logo_layout = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_logo_layout', 'horizont' ) );
    $logo_true = 0;
    if ( get_theme_mod( 'custom_logo' ) && $logo_var == 'fix' || get_theme_mod( 'badoblog_cus_supple_logo' ) && $logo_var == 'free' ) {
        $logo_true = 1;
    }
    if ( display_header_text() || $logo_true == 1 ) {
        //? ---------- Fill or border color
        $color_logo = '#505062';
        if ( $primary_big_color != '#505062' ) {
            $color_logo = $primary_big_color;
        }
        $logo_back_color = get_theme_mod( 'badoblog_cus_title_tagline_design_color', '#505062' );
        if ( $logo_back_color != '#505062' ) {
            $color_logo = $logo_back_color;
        }
        $css .= "\n      .badoblog-css-site-brand-bottom-box {\n        background: linear-gradient(90deg, #000 -200%, {$color_logo} 85%,rgba(0,0,0, 0) 200%);\n      }\n    ";
        //? ---------- Title and logo design option
        $logo_design = get_theme_mod( 'badoblog_cus_title_tagline_design', 'gradient' );
        if ( $logo_design != 'gradient' ) {
            switch ( $logo_design ) {
                // Background
                case 'background':
                    $css .= "\n            .badoblog-css-site-brand-bottom-box {\n              background: {$color_logo};\n              padding: 20px 30px;\n            }\n          ";
                    break;
                // Border
                case 'border':
                    $css .= "\n            .badoblog-css-site-brand-bottom-box {\n              background: none;\n              border: 8px solid {$color_logo};\n              padding: 20px 30px;\n            }\n          ";
                    break;
                // Simple
                case 'simple':
                    $css .= "\n            .badoblog-css-site-brand-bottom-box {\n              background: none;\n              padding: 0!important;\n            }\n          ";
                    break;
                default:
                    break;
            }
        }
        //? ---------- Orientation of the logo and site name
        if ( $logo_true == 1 ) {
            if ( $logo_layout == 'vertical' ) {
                $css .= "\n          .badoblog-css-site-brand-bottom-box {\n            flex-direction: column;\n          }\n        ";
            } else {
                $css .= "\n          .badoblog-css-site-brand-bottom-box {\n            align-items: center;\n          }\n        ";
            }
            if ( !display_header_text() ) {
                $css .= "\n          .badoblog-css-site-brand-bottom-box {\n            column-gap: 0!important;\n            width: fit-content;\n          }\n        ";
            }
        }
        //? ---------- Header area width with logo
        $header_width = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_width', '70' ) );
        if ( $header_width != '70' ) {
            switch ( $header_width ) {
                case '20':
                    $width_1 = '20';
                    $width_2 = '80';
                    $css .= "\n              .badoblog-css-site-brand-bottom-box {\n                flex-direction: column;\n                align-items: normal;\n                padding: 15px 25px;\n              }\n              @media (max-width: 1500px) {\n                .badoblog-css-site-brand-bottom-box {\n                  align-items: center;\n                }\n              }\n              @media (max-width: 1100px) {\n                .badoblog-css-site-brand-bottom-box {\n                  padding: 5px 15px;\n                }\n              }\n            ";
                    break;
                case '30':
                    $width_1 = '30';
                    $width_2 = '70';
                    $css .= "\n            @media (max-width: 1200px) {\n              .badoblog-css-site-brand-bottom-box {\n                padding: 15px 25px;\n              }\n            }\n          ";
                    if ( $logo_true == 1 ) {
                        $css .= "\n              @media (max-width: 1400px) {\n                .badoblog-css-site-brand-bottom-box {\n                  flex-direction: column;\n                  align-items: normal;\n                }\n              }\n            ";
                    }
                    break;
                case '40':
                    $width_1 = '40';
                    $width_2 = '60';
                    if ( $logo_true == 1 ) {
                        $css .= "\n              @media (max-width: 1200px) {\n                .badoblog-css-site-brand-bottom-box {\n                  flex-direction: column;\n                  align-items: normal;\n                  padding: 15px 25px;\n                }\n              }\n            ";
                    }
                    break;
                case '50':
                    $width_1 = '50';
                    $width_2 = '50';
                    if ( $logo_true == 1 ) {
                        $css .= "\n              @media (max-width: 1100px) {\n                .badoblog-css-site-brand-bottom-box {\n                  padding: 15px 25px;\n                  column-gap: 20px;\n                }\n              }\n              @media (max-width: 1000px) {\n                .badoblog-css-site-brand-bottom-box {\n                  flex-direction: column;\n                  align-items: normal;\n                }\n              }\n            ";
                    }
                    break;
                case '60':
                    $width_1 = '60';
                    $width_2 = '40';
                    break;
                case '80':
                    $width_1 = '80';
                    $width_2 = '20';
                    break;
                default:
                    $width_1 = '100';
                    $width_2 = '100';
                    $css .= "\n            .badoblog-css-site-brand-bottom,\n            .badoblog-css-site-brand-bottom-2 {\n              flex-direction: column;\n            }\n            .badoblog-css-site-brand-bottom-box,\n            .badoblog-css-site-brand-bottom-1,\n            .badoblog-css-site-brand-bottom-2,\n            .badoblog-css-soc-top-box {\n              justify-content: center;\n            }\n            .badoblog-css-site-brand-banner {\n              text-align: center;\n            }\n          ";
                    if ( $logo_layout == 'vertical' ) {
                        $css .= "\n              .badoblog-css-site-brand-bottom {\n                text-align: center;\n              }\n            ";
                    }
                    break;
            }
            $css .= "\n        .badoblog-css-site-brand-bottom-1 {\n          width: " . $width_1 . "%;\n        }\n        .badoblog-css-site-brand-bottom-2 {\n          width: " . $width_2 . "%;\n        }\n      ";
        }
    } else {
        $css .= "\n      .badoblog-css-site-branding {\n        display: flex;\n        justify-content: center;\n        flex-direction: column;\n      }\n      .badoblog-css-site-brand-bottom-box {\n        margin: 0;\n        padding: 0;\n      }\n      .badoblog-css-site-brand-bottom {\n        gap: 0;\n      }\n      .badoblog-css-site-brand-bottom-1 {\n        width: 0%;\n      }\n      .badoblog-css-site-brand-bottom-2 {\n        display: flex;\n        justify-content: center;\n        width: 100%;\n      }\n      .badoblog-css-site-brand-banner {\n        text-align: center;\n      }\n    ";
        if ( $banner_top == 0 ) {
            $css .= "\n        .badoblog-css-soc-top-box {\n          justify-content: center;\n        }\n      ";
            if ( $soc_active != 1 && !get_header_image() ) {
                $css .= "\n          .badoblog-css-site-branding {\n            margin: 0;\n            padding: 0;\n          }\n        ";
            }
        }
    }
    //? ---------- Title site
    if ( !display_header_text() ) {
        // Visually hide the title and description
        $css .= "\n    \t.badoblog-css-site-title,\n    \t.badoblog-css-site-description {\n    \t\tposition: absolute;\n    \t\tclip: rect(1px, 1px, 1px, 1px);\n    \t}\n    ";
    } else {
        //? ---------- Title text color
        $site_h_color = esc_attr( get_theme_mod( 'header_textcolor' ) );
        if ( !empty( $site_h_color ) && $site_h_color !== 'blank' ) {
            $css .= '
        .badoblog-css-site-title,
        .badoblog-css-site-title a,
        .badoblog-css-site-description {
          color: #' . $site_h_color . ';
        }
      ';
        }
        //? ---------- Remove the dividing line
        if ( get_theme_mod( 'badoblog_cus_title_tagline_line', 0 ) == 1 ) {
            $css .= '
        .badoblog-css-site-description {
          border-top: 3px solid;
          padding-top: 10px;
        }
      ';
        }
        //? ---------- Site title font
        $site_h_font = get_theme_mod( 'badoblog_cus_title_tagline_h_font', 'off' );
        if ( $site_h_font !== 'off' ) {
            $famaly = '';
            if ( in_array( $site_h_font, $serif ) ) {
                $famaly = 'serif';
            } elseif ( in_array( $site_h_font, $cursive ) ) {
                $famaly = 'cursive';
            } else {
                $famaly = 'sans-serif';
            }
            $css .= '
        .badoblog-css-site-title {
          font-family: "' . $site_h_font . '", ' . $famaly . ';
        }
      ';
        }
        //? ---------- Site title size
        $site_h_size = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_h_size', 40 ) );
        if ( $site_h_size != 40 ) {
            $css .= '
        .badoblog-css-site-title {
          font-size: ' . $site_h_size . 'px;
        }
      ';
        }
        //? ---------- Site title bar height
        $site_h_height = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_h_height', '1.5' ) );
        if ( $site_h_height !== '1.5' ) {
            $css .= "\n        .badoblog-css-site-title {\n          line-height: {$site_h_height};\n        }\n      ";
        }
        //? ---------- Site description font
        $site_des_font = get_theme_mod( 'badoblog_cus_title_tagline_des_font', 'off' );
        if ( $site_des_font !== 'off' ) {
            $famaly = '';
            if ( in_array( $site_des_font, $serif ) ) {
                $famaly = 'serif';
            } elseif ( in_array( $site_des_font, $cursive ) ) {
                $famaly = 'cursive';
            } else {
                $famaly = 'sans-serif';
            }
            $css .= '
        .badoblog-css-site-description {
          font-family: "' . $site_des_font . '", ' . $famaly . ';
        }
      ';
        }
        //? ---------- Site description size
        $site_des_size = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_des_size', 16 ) );
        if ( $site_des_size != 16 ) {
            $css .= '
        .badoblog-css-site-description {
          font-size: ' . $site_des_size . 'px;
        }
      ';
        }
        //? ---------- Site description line height
        $site_des_height = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_des_height', '1.7' ) );
        if ( $site_des_height !== '1.7' ) {
            $css .= "\n        .badoblog-css-site-description {\n          line-height: {$site_des_height};\n        }\n      ";
        }
    }
    //----------------------------------------------------------------------------------
    //region Top Banner
    //----------------------------------------------------------------------------------
    if ( $banner_top == 1 ) {
        // Frame thickness for banner
        $banner_border = get_theme_mod( 'badoblog_cus_banner_border', 0 );
        if ( $banner_border != 0 ) {
            $color_brand_banner = '#4c65ad';
            if ( $primary_color != $color_brand_banner ) {
                $color_brand_banner = $primary_color;
            }
            $css .= '
        .badoblog-css-site-brand-banner {
          border: ' . $banner_border . 'px solid ' . $color_brand_banner . ';
          border-radius: 20px;
        }
      ';
            // Border color for banner
            $banner_b_color = get_theme_mod( 'badoblog_cus_banner_border_color', '' );
            if ( !empty( $banner_b_color ) ) {
                $css .= "\n          .badoblog-css-site-brand-banner {\n            border-color: {$banner_b_color};\n          }\n        ";
            }
        }
    }
    //----------------------------------------------------------------------------------
    //region Categories
    //----------------------------------------------------------------------------------
    //? ---------- ---------- Number (size) of columns in categories
    $cat_win_w = '';
    if ( $cat_win != 'w2' ) {
        switch ( $cat_win ) {
            // Classic blog
            case 'w1':
                $css .= "\n          .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 960px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-no-sidebar-full .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 1440px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-entry-title {\n            font-size: 34px;\n          }\n          @media (max-width: 500px) {\n            .badoblog-css-entry-title {\n              font-size: 20px;\n            }\n            .badoblog-css-entry-content {\n              font-size: 15px;\n            }\n          }\n        ";
                break;
            // Three columns
            case 'w3':
                $css .= '
          .badoblog-css-cat-box {
            grid-template-columns: repeat(auto-fill, minmax(0, 300px));
            grid-column-gap: 29.7px;
          }
          .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
          	grid-template-columns: repeat(auto-fill, minmax(0, 448px));
	          grid-column-gap: 38px;
          }
          .badoblog-css-entry-title {
            font-size: 20px;
          }
          .badoblog-css-entry-content {
            font-size: 15px;
          }
          .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-tax-cat {
            margin: 15px;
          }
          @media (max-width: 1580px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 384px));
            }
          }
          @media (max-width: 1360px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 360px));
            }
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 320px));
            }
          }
          @media (max-width: 1236px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 300px));
            }
          }
          @media (max-width: 1150px) {
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 300px));
            }
          }
          @media (max-width: 1088px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
          }
          @media (max-width: 915px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 350px));
            }
          }
          @media (max-width: 818px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 300px));
            }
          }
          @media (max-width: 718px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
          }
          @media (max-width: 600px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 560px));
            }
          }
        ';
                break;
            // Four columns
            case 'w4':
                $css .= '
          .badoblog-css-cat-box {
            grid-template-columns: repeat(auto-fill, minmax(0, 208px));
            grid-column-gap: 42.5px;
          }
          .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
            grid-template-columns: repeat(auto-fill, minmax(0, 320px));
            grid-column-gap: 46.6px;
          }
          .badoblog-css-entry-title {
            font-size: 16px;
          }
          .badoblog-css-entry-content {
            font-size: 14px;
          }
          .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-tax-cat {
            margin: 10px;
          }
          @media (max-width: 1528px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 272px));
            }
          }
          @media (max-width: 1360px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 220px));
            }
          }
          @media (max-width: 1315px) {
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 245px));
            }
          }
          @media (max-width: 1200px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 300px));
            }
          }
          @media (max-width: 1088px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
          }
          @media (max-width: 915px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 220px));
            }
          }
          @media (max-width: 808px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 300px));
            }
          }
          @media (max-width: 718px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
          }
          @media (max-width: 600px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 560px));
            }
          }
        ';
                break;
            // Five columns
            case 'w5':
                $css .= '
          .badoblog-css-cat-box {
            grid-template-columns: repeat(auto-fill, minmax(0, 160px));
            grid-column-gap: 39.8px;
          }
          .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
            grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            grid-column-gap: 35px;
          }
          .badoblog-css-entry-title,
          .badoblog-css-entry-more {
            font-size: 14px;
          }
          .badoblog-css-entry-content {
            font-size: 12px;
          }
          .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-tax-cat {
            margin: 10px;
          }
          .badoblog-css-cat-meta-taxonomy-cat,
          .badoblog-css-cat-meta-taxonomy-tag,
          .badoblog-css-entry-header,
          .badoblog-css-entry-meta,
          .badoblog-css-entry-content,
          .badoblog-css-entry-more {
            margin-left: 15px;
            margin-right: 15px;
          }
          div.badoblog-css-cat-meta-box {
              gap: 5px;
              padding: 4px 10px;
              border-radius: 12px;
          }
          div.badoblog-css-cat-meta-tax-cat-ul a {
            padding: 6px 10px;
          }
          a.badoblog-css-more-link {
            padding: 10px;
          }
          @media (max-width: 1560px) {
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 220px));
            }
          }
          @media (max-width: 1522px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
          }
          @media (max-width: 1360px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 160px));
            }
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 248px));
            }
          }
          @media (max-width: 1210px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 195px));
            }
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 220px));
            }
          }
          @media (max-width: 1100px) {
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
          }
          @media (max-width: 1000px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 240px));
            }
          }
          @media (max-width: 915px) {
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 220px));
            }
          }
          @media (max-width: 868px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 200px));
            }
          }
          @media (max-width: 808px) {
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 300px));
            }
          }
          @media (max-width: 748px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 180px));
            }
          }
          @media (max-width: 718px) {
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
            }
          }
          @media (max-width: 648px) {
            .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 160px));
            }
          }
          @media (max-width: 600px) {
            .badoblog-css-cat-box,
            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 560px));
            }
            .badoblog-css-entry-title {
              font-size: 20px;
            }
            .badoblog-css-entry-content {
              font-size: 15px;
            }
          }
        ';
                break;
            // Horizontal (Big)
            case 'w6':
                $css .= "\n          .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 960px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-no-sidebar-full .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 1440px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-cat-grid {\n            display: flex;\n            align-items: flex-start;\n          }\n          .badoblog-css-cat-thumbnail,\n          .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n            max-width: 384px;\n          }\n          .badoblog-css-entry-box {\n            flex: 1;\n          }\n          div.badoblog-css-cat-thumbnail-box {\n            margin: 25px 0 25px 25px;\n          }\n          .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-tax-cat {\n            margin: 15px;\n          }\n          .badoblog-css-entry-title {\n            font-size: 28px;\n          }\n          .badoblog-css-no-sidebar-full .badoblog-css-entry-title {\n            font-size: 30px;\n          }\n          .badoblog-css-entry-content {\n            font-size: 16px;\n          }\n          @media (min-width: 1500px) {\n            .badoblog-css-full-max-width .badoblog-css-cat-box {\n              grid-template-columns: repeat(auto-fill, minmax(800px, 1fr));\n            }\n          }\n          @media (max-width: 1360px) {\n            .badoblog-css-cat-thumbnail {\n              max-width: 300px;\n            }\n            .badoblog-css-entry-title {\n              font-size: 24px;\n            }\n            .badoblog-css-entry-content {\n              font-size: 15px;\n            }\n          }\n          @media (max-width: 1250px) {\n            .badoblog-css-cat-thumbnail {\n              max-width: 256px;\n            }\n            .badoblog-css-no-sidebar-full .badoblog-css-entry-title {\n              font-size: 26px;\n            }\n          }\n          @media (max-width: 1000px) {\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n              max-width: 300px;\n            }\n          }\n          @media (max-width: 900px) {\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n              max-width: 256px;\n            }\n          }\n          @media (max-width: 800px) {\n            .badoblog-css-cat-thumbnail,\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n              max-width: 160px;\n            }\n            div.badoblog-css-cat-thumbnail-box {\n              margin: 15px 0 15px 15px;\n            }\n            .badoblog-css-entry-content {\n              font-size: 14px;\n            }\n          }\n          @media (max-width: 600px) {\n            .badoblog-css-cat-grid {\n              flex-direction: column;\n              align-items: center;\n            }\n            .badoblog-css-cat-thumbnail,\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n              max-width: 560px;\n            }\n            div.badoblog-css-cat-thumbnail-box {\n              margin: 0;\n            }\n          }\n        ";
                $cat_win_w = 'horizontal';
                break;
            // Horizontal (Mid)
            case 'w7':
                $css .= "\n          .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 960px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-no-sidebar-full .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 1440px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-cat-grid {\n            display: flex;\n            align-items: flex-start;\n          }\n          .badoblog-css-cat-thumbnail,\n          .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n            max-width: 256px;\n          }\n          .badoblog-css-entry-box {\n            flex: 1;\n          }\n          div.badoblog-css-cat-thumbnail-box {\n            margin: 25px 0 25px 25px;\n          }\n          .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-tax-cat {\n            margin: 10px;\n          }\n          .badoblog-css-entry-title {\n            font-size: 26px;\n          }\n          @media (min-width: 1500px) {\n            .badoblog-css-cat-box,\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {\n              grid-template-columns: repeat(auto-fill, minmax(700px, 1fr));\n            }\n          }\n          @media (max-width: 1250px) {\n            .badoblog-css-cat-thumbnail {\n              max-width: 208px;\n            }\n            .badoblog-css-entry-title {\n              font-size: 24px;\n            }\n          }\n          @media (max-width: 800px) {\n            .badoblog-css-cat-thumbnail,\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n              max-width: 160px;\n            }\n            div.badoblog-css-cat-thumbnail-box {\n              margin: 15px 0 15px 15px;\n            }\n            .badoblog-css-entry-content {\n              font-size: 14px;\n            }\n          }\n          @media (max-width: 600px) {\n            .badoblog-css-cat-grid {\n              flex-direction: column;\n              align-items: center;\n            }\n            .badoblog-css-cat-thumbnail,\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n              max-width: 560px;\n            }\n            div.badoblog-css-cat-thumbnail-box {\n              margin: 0;\n            }\n          }\n        ";
                $cat_win_w = 'horizontal';
                break;
            // Horizontal (Small)
            case 'w8':
                $css .= "\n          .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 960px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-no-sidebar-full .badoblog-css-cat-box {\n            grid-template-columns: repeat(auto-fill, minmax(0, 1440px));\n            grid-column-gap: 30px;\n          }\n          .badoblog-css-cat-grid {\n            display: flex;\n            align-items: flex-start;\n          }\n          .badoblog-css-cat-thumbnail,\n          .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n            max-width: 160px;\n          }\n          .badoblog-css-entry-box {\n            flex: 1;\n          }\n          div.badoblog-css-cat-thumbnail-box {\n            margin: 25px 0 25px 25px;\n          }\n          .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-tax-cat {\n            margin: 10px;\n          }\n          div.badoblog-css-cat-meta-tax-cat-ul a {\n            padding: 8px 16px;\n          }\n          .badoblog-css-entry-title {\n            font-size: 22px;\n          }\n          .badoblog-css-entry-content {\n            font-size: 15px;\n          }\n          @media (min-width: 1500px) {\n            .badoblog-css-cat-box,\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-box {\n              grid-template-columns: repeat(auto-fill, minmax(700px, 1fr));\n            }\n          }\n          @media (max-width: 800px) {\n            div.badoblog-css-cat-thumbnail-box {\n              margin: 15px 0 15px 15px;\n            }\n            .badoblog-css-entry-content {\n              font-size: 14px;\n            }\n          }\n          @media (max-width: 600px) {\n            .badoblog-css-cat-grid {\n              flex-direction: column;\n              align-items: center;\n            }\n            .badoblog-css-cat-thumbnail,\n            .badoblog-css-no-sidebar-full .badoblog-css-cat-thumbnail {\n              max-width: 560px;\n            }\n            div.badoblog-css-cat-thumbnail-box {\n              margin: 0;\n            }\n          }\n        ";
                $cat_win_w = 'horizontal';
                break;
            // Default
            default:
                break;
        }
    }
    //? ---------- ---------- Post card title size
    $cat_title_size = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_h_size' ) );
    if ( !empty( $cat_title_size ) ) {
        $css .= '
      .badoblog-css-entry-title {
        font-size: ' . $cat_title_size . 'px;
      }
    ';
    }
    //? ---------- ---------- Post card description size
    $cat_text_size = esc_attr( get_theme_mod( 'badoblog_cus_cat_style_text_size' ) );
    if ( !empty( $cat_text_size ) ) {
        $css .= '
      .badoblog-css-entry-content {
        font-size: ' . $cat_text_size . 'px;
      }
    ';
    }
    //? ---------- ---------- Background color - Posts blocks in categories
    if ( !empty( $back_cat_color ) ) {
        $css .= "\n      article.badoblog-css-cat-grid {\n        background: {$back_cat_color};\n      }\n    ";
    }
    //? ---------- ---------- Checking the completeness of the card
    $meta_cat_none_outimg = 1;
    if ( $cat_meta_cat != 1 || $cat_meta_cat_lay != 'header' ) {
        $meta_cat_none_outimg = 0;
    }
    $card_comple = 1;
    if ( $des_cat_none == 1 && $more_cat == 0 && $cat_meta_boxs != 1 && $meta_cat_none_outimg == 0 && $cat_meta_tag == 0 ) {
        $card_comple = 0;
    }
    //? ---------- ---------- Remove sections in categories
    $margin_thum = '';
    if ( $h_cat_none == 1 ) {
        // If all sections are removed
        if ( $card_comple == 0 ) {
            $margin_thum = '
        .badoblog-css-cat-thumbnail-box {
          margin: 15px;
        }
      ';
        }
        // If only the title display
    } else {
        if ( $card_comple == 0 ) {
            $css .= '
      .badoblog-css-entry-header {
        margin-bottom: 20px;
      }
    ';
        }
    }
    $cat_radius = '
    .badoblog-css-cat-grid {
      border-radius: 30px;
    }
  ';
    //? ---------- ---------- Design - Posts blocks in categories
    $cat_style_design = get_theme_mod( 'badoblog_cus_cat_style_design', 'v6' );
    if ( $cat_style_design != 'v6' ) {
        switch ( $cat_style_design ) {
            // Off - Disable design
            case 'v0':
                $css .= '
          article.badoblog-css-cat-grid {
            box-shadow: none;
          }
        ';
                break;
            // Simple
            case 'v1':
                $css .= '
          article.badoblog-css-cat-grid {
            box-shadow: 0 0 0.1em rgba(0,0,0,0.15);
          }
        ';
                break;
            // Underlined
            case 'v2':
                $css .= "\n          article.badoblog-css-cat-grid {\n            border-bottom: 2px solid {$primary_color};\n          }\n        ";
                break;
            // In frame
            case 'v3':
                $css .= "\n          article.badoblog-css-cat-grid {\n            outline: 1px solid {$primary_color};\n          }\n          .badoblog-css-cat-thumbnail-box {\n            margin: 10px 10px 0 10px;\n          }\n        ";
                $css .= $margin_thum;
                $css .= $cat_radius;
                break;
            // Header background
            case 'v4':
                $css .= "\n          article.badoblog-css-cat-grid {\n            outline: 1px solid {$primary_big_color};\n          }\n          .badoblog-css-entry-header {\n            background: {$primary_big_color};\n            margin-bottom: 15px;\n            padding: 10px 15px;\n            margin: 15px;\n            border-radius: 20px;\n          }\n          h2.badoblog-css-entry-title,\n          h2.badoblog-css-entry-title a:hover {\n            color: {$primary_big_lite_color};\n          }\n        ";
                if ( $cat_win_w == 'horizontal' ) {
                    $css .= '
            .badoblog-css-entry-header {
              margin: 25px;
            }
            @media (max-width: 800px) {
              .badoblog-css-entry-header {
                margin: 15px;
              }
            }
          ';
                }
                break;
            // Deepening
            case 'v5':
                $css .= '
          article.badoblog-css-cat-grid {
            box-shadow: inset 0 0.1em 0.3em rgba(0,0,0,0.2);
          }
          .badoblog-css-cat-thumbnail-box {
            margin: 15px 15px 0 15px;
          }
        ';
                $css .= $margin_thum;
                $css .= $cat_radius;
                break;
            // Light shadow (Polaroid)
            case 'v7':
                $css .= '
          article.badoblog-css-cat-grid {
            box-shadow: 0 0.1em 0.7em rgba(0,0,0,0.1);
          }
          .badoblog-css-cat-thumbnail-box {
            margin: 15px 15px 0 15px;
          }
        ';
                $css .= $margin_thum;
                $css .= $cat_radius;
                if ( $cat_win_w == 'horizontal' ) {
                    $css .= '
            .badoblog-css-cat-grid {
              align-items: center;
            }
            div.badoblog-css-cat-thumbnail-box {
              margin: 40px 15px 40px 40px;
            }
            @media (max-width: 800px) {
              div.badoblog-css-cat-thumbnail-box {
                margin: 15px 0 15px 15px;
              }
            }
            @media (max-width: 600px) {
              div.badoblog-css-cat-thumbnail-box {
                margin: 0;
              }
            }
          ';
                }
                break;
            // Soaring
            case 'v8':
                $css .= '
          article.badoblog-css-cat-grid {
            box-shadow: 0 10px 30px rgb(0 0 0 / 25%);
          }
        ';
                break;
            default:
                break;
        }
    }
    // Changes for the "Read more" button
    if ( $more_cat == 1 ) {
        // Full width "Read more" button
        if ( get_theme_mod( 'badoblog_cus_cat_style_more_width', 1 ) == 1 ) {
            $css .= "\n        .badoblog-css-more-link {\n          width: 100%;\n        }\n      ";
        }
        // Centered "Read more" button
        $more_lay = get_theme_mod( 'badoblog_cus_cat_style_more_lay', 'center' );
        if ( $more_lay != 'center' ) {
            if ( $more_lay == 'left' ) {
                $css .= "\n          .badoblog-css-entry-more {\n            text-align: left;\n          }\n        ";
            } else {
                $css .= "\n          .badoblog-css-entry-more {\n            text-align: right;\n          }\n        ";
            }
        }
    }
    //? ---------- ---------- Animation for posts blocks in categories
    switch ( $anime_cat ) {
        // Enlargement picture
        case 'a1':
            $css .= "\n        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thumbnail img {\n          transform: scale(1.07);\n        }\n      ";
            break;
        // Reducing picture (Animation decrease images in mozilla, works correctly max at 0.2s)
        case 'a2':
            $css .= "\n        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thumbnail img {\n          transform: scale(0.95);\n        }\n        .badoblog-css-cat-thumbnail img {\n          transition: all 0.2s;\n        }\n      ";
            break;
        // Darkened image
        case 'a3':
            $css .= '
        .badoblog-css-cat-thum-anime {
          position: relative;
          }
        .badoblog-css-cat-thum-anime:before {
          content: "";
          position: absolute;
          top: 100%;
          right: 100%;
          bottom: 100%;
          left: 100%;
          background: rgba(0,0,0, 0.2);
        }
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thum-anime:before {
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          opacity: .5;
        }
      ';
            break;
        // Curtain on picture
        case 'a4':
            $css .= '
        .badoblog-css-cat-thum-anime {
          position: relative;
          }
        .badoblog-css-cat-thum-anime:before {
          content: "";
          position: absolute;
          top: 100%;
          right: 0;
          bottom: 0;
          left: 0;
          background: rgba(0,0,0, 0.5);
          }
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thum-anime:before {
          top: 0;
          opacity: .25;
          }
      ';
            break;
        // Picture frame
        case 'a5':
            $css .= '
        .badoblog-css-cat-thum-anime {
          position: relative;
        }
        .badoblog-css-cat-thum-anime:before {
          content: "";
          position: absolute;
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
        }
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thum-anime:before {
          margin: 10px;
          opacity: .7;
          border: 1px solid ' . $primary_color . ';
        }
      ';
            break;
        // Frame around
        case 'a6':
            $css .= '
        .badoblog-css-cat-thum-anime {
          position: relative;
          }
        .badoblog-css-cat-thum-anime:before {
          content: "";
          position: absolute;
          top: 100%;
          right: 100%;
          bottom: 100%;
          left: 100%;
        }
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thum-anime:before {
          top: 0;
          right: 0;
          bottom: 0;
          left: 0;
          opacity: .7;
          border: 5px solid ' . $primary_color . ';
        }
      ';
            break;
        // Backlight picture
        case 'a7':
            $css .= '
        .badoblog-css-cat-thumbnail {
          transition: 0.3s;
        }
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thumbnail {
          opacity: 0.85;
        }
      ';
            break;
        // Picture contrast
        case 'a8':
            $css .= '
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thumbnail {
          -webkit-filter: contrast(150%);
        }
      ';
            break;
        // Tint picture
        case 'a9':
            $css .= '
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thumbnail {
          -webkit-filter: hue-rotate(100deg);
        }
      ';
            break;
        // Color inversion picture
        case 'a10':
            $css .= '
        article.badoblog-css-cat-grid:hover .badoblog-css-cat-thumbnail {
          -webkit-filter: invert(100%);
        }
      ';
            break;
        // Remove color in neighboring blocks
        case 'a11':
            $css .= "\n        .badoblog-css-cat-box:hover article.badoblog-css-cat-grid:not(:hover) {\n          filter: grayscale(100%);\n        }\n        .badoblog-css-cat-box:hover article.badoblog-css-cat-grid:not(:hover):after {\n          width: 100%;\n          height: 100%;\n          background: rgba(0,0,0, 0.3);\n        }\n        article.badoblog-css-cat-grid {\n          position: relative;\n        }\n      ";
            break;
        // Toning neighboring blocks
        case 'a12':
            $css .= '
        .badoblog-css-cat-box:hover article.badoblog-css-cat-grid:not(:hover) {
          filter: grayscale(100%);
        }
        .badoblog-css-cat-box:hover article.badoblog-css-cat-grid:not(:hover):after {
          width: 100%;
          height: 100%;
          background: rgba(0,0,0, 0.3);
          transition: 1s;
          opacity: 0.8;
        }
        article.badoblog-css-cat-grid {
          position: relative;
        }
        article.badoblog-css-cat-grid:not(:hover):after {
          content: "";
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          transition: 1s;
          border-radius: 25px;
        }
      ';
            break;
        // Block slope
        case 'a13':
            $css .= '
        article.badoblog-css-cat-grid {
          backface-visibility: hidden;
        }
        article.badoblog-css-cat-grid:hover {
          transform: rotateZ(1.5deg);
        }
      ';
            break;
        default:
            break;
    }
    //? ---------- ---------- Meta tags (meta boxs)
    if ( $cat_meta_boxs == 1 ) {
        // Icon color
        $css .= "\n      .icon-autor-cat-meta::before,\n      .icon-calendar-cat-meta::before,\n      .icon-spinner-cat-meta::before,\n      .icon-bubble-cat-meta::before,\n      .icon-clock-cat-meta::before,\n      .icon-eye-cat-meta::before {\n        color: {$primary_color};\n      }\n    ";
        // Size
        $size_meta_box = '';
        if ( get_theme_mod( 'badoblog_cus_cat_meta_boxs_size', 'small' ) == 'big' ) {
            $css .= "\n        .icon-autor-cat-meta::before {\n          font-size: 34px;\n        }\n        .icon-calendar-cat-meta::before,\n        .icon-spinner-cat-meta::before,\n        .icon-bubble-cat-meta::before,\n        .icon-clock-cat-meta::before {\n          font-size: 30px;\n        }\n        .icon-eye-cat-meta::before {\n          font-size: 32px;\n        }\n        .badoblog-css-cat-meta-data,\n        .badoblog-css-cat-meta-data a {\n          font-size: 14px;\n          line-height: 1.3;\n        }\n      ";
            $size_meta_box = "\n        .badoblog-css-cat-meta-boxs {\n          gap: 10px;\n        }\n        .badoblog-css-cat-meta-box {\n          padding: 8px 14px;\n          border-radius: 15px;\n        }\n      ";
        }
        // Align center
        if ( get_theme_mod( 'badoblog_cus_cat_meta_boxs_center', 0 ) == 1 ) {
            $css .= '
        .badoblog-css-cat-meta-boxs {
          justify-content: center;
        }
      ';
        }
        // Remove icons
        if ( esc_attr( get_theme_mod( 'badoblog_cus_cat_meta_boxs_icon', 0 ) ) == 1 ) {
            $css .= "\n        .icon-autor-cat-meta,\n        .icon-calendar-cat-meta,\n        .icon-spinner-cat-meta,\n        .icon-bubble-cat-meta,\n        .icon-eye-cat-meta {\n          display: none;\n        }\n      ";
        }
        // Styles for open meta blocks
        $margin_meta_box = "\n      .badoblog-css-entry-meta {\n        margin-top: 10px;\n      }\n      .badoblog-css-cat-meta-boxs {\n        column-gap: 12px;\n        row-gap: 10px;\n      }\n    ";
        // Meta tag design
        switch ( esc_attr( get_theme_mod( 'badoblog_cus_cat_meta_boxs_design', 'v3' ) ) ) {
            // Simple
            case 'v0':
                $css .= "\n          .badoblog-css-cat-meta-box {\n            padding: 0;\n          }\n        ";
                $css .= $margin_meta_box;
                break;
            // Frame
            case 'v1':
                $css .= "\n          .badoblog-css-cat-meta-box {\n            border: 1px solid {$primary_color};\n          }\n        ";
                $css .= $size_meta_box;
                break;
            // Underlined
            case 'v2':
                $css .= "\n          .badoblog-css-cat-meta-box {\n            border-bottom: 1px solid {$primary_color};\n            border-radius: 0;\n            padding-left: 2px;\n            padding-right: 2px;\n          }\n        ";
                $css .= $margin_meta_box;
                break;
            // Underlined (circle)
            case 'v3':
                $css .= "\n          .badoblog-css-cat-meta-box {\n            border-bottom: 1px solid {$primary_color};\n          }\n        ";
                $css .= $margin_meta_box;
                break;
            // Soaring
            case 'v4':
                $css .= '
          .badoblog-css-cat-meta-box {
            box-shadow: 0 0.1em 0.5em rgba(0,0,0,0.1);
          }
        ';
                $css .= $size_meta_box;
                break;
            // Deepening
            case 'v5':
                $css .= '
          .badoblog-css-cat-meta-box {
            box-shadow: inset 0 0.1em 0.3em rgba(0,0,0,0.2);
          }
        ';
                $css .= $size_meta_box;
                break;
            // Background
            case 'v6':
                $css .= "\n          .badoblog-css-cat-meta-box {\n            background: {$primary_big_color};\n          }\n          .badoblog-css-cat-meta-box,\n          .badoblog-css-cat-meta-box a,\n          .icon-autor-cat-meta::before,\n          .icon-calendar-cat-meta::before,\n          .icon-spinner-cat-meta::before,\n          .icon-bubble-cat-meta::before,\n          .icon-eye-cat-meta::before {\n            color: {$primary_big_lite_color};\n          }\n        ";
                $css .= $size_meta_box;
                break;
            default:
                break;
        }
        // Add tooltips
        if ( esc_attr( get_theme_mod( 'badoblog_cus_cat_meta_boxs_prompt', 0 ) ) == 1 ) {
            $css .= '
        .badoblog-css-cat-meta-box {
          position: relative;
        }
        .badoblog-css-cat-meta-box::after {
          content: attr(data-info);
          display: inline;
          position: absolute;
          top: 100px;
          left: -50px;
          opacity: 0;
          width: 180px;
          font-size: 14px;
          line-height: 1.5;
          padding: 10px 12px 12px 15px;
          background: rgba(0,0,0,0.7);
          border-radius: 15px;
          color: #fff;
          pointer-events: none;
          transition: opacity 250ms, top 250ms;
          z-index: 2;
        }
        .badoblog-css-cat-meta-box::before {
          content: "";
          display: block;
          position: absolute;
          top: 0;
          left: 17px;
          opacity: 0;
          width: 0;
          height: 0;
          border: solid transparent 5px;
          border-bottom-color: rgba(0,0,0,0.7);
          transition: opacity 250ms, top 250ms;
        }
        .badoblog-css-cat-meta-box:hover::after {
          top: 35px;
          left: -50px;
          opacity: 1;
        }
        .badoblog-css-cat-meta-box:hover::before {
          top: 25px;
          opacity: 1;
        }
      ';
        }
    }
    //? ---------- ---------- Meta tags (categories)
    if ( $cat_meta_cat == 1 ) {
        // Align center
        if ( get_theme_mod( 'badoblog_cus_cat_meta_cat_center', 0 ) == 1 ) {
            $css .= '
        .badoblog-css-cat-meta-taxonomy-cat,
        .badoblog-css-cat-meta-tax-cat-ul {
          justify-content: center;
        }
        .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-taxonomy-cat {
          left: 0;
          right: 0;
        }
      ';
        }
        // Cat icons
        $cat_icon = get_theme_mod( 'badoblog_cus_cat_meta_cat_icon', 0 );
        if ( $cat_icon != 0 ) {
            $ico_cat = '';
            switch ( $cat_icon ) {
                // Folder 1
                case 1:
                    $ico_cat = '\\f115';
                    break;
                // Folder 2
                case 2:
                    $ico_cat = '\\f07c';
                    break;
                // Folder 3
                case 3:
                    $ico_cat = '\\e930';
                    break;
                // Folder 4
                case 4:
                    $ico_cat = '\\e908';
                    break;
                // Folder 5
                case 5:
                    $ico_cat = '\\e91a';
                    break;
                // Folder 6
                case 6:
                    $ico_cat = '\\e912';
                    break;
                // Folder 7
                case 7:
                    $ico_cat = '\\f07b';
                    break;
                // Card catalog
                case 8:
                    $ico_cat = '\\e916';
                    break;
                // Box
                case 9:
                    $ico_cat = '\\e905';
                    break;
                default:
                    break;
            }
            if ( !empty( $ico_cat ) ) {
                $css .= "\n          .badoblog-css-cat-meta-tax-cat-ul a:before {\n            font-family: 'icomoon';\n\t          text-rendering: auto;\n            content: '{$ico_cat}';\n            font-size: 15px;\n            line-height: 14px;\n            padding-right: 8px;\n          }\n        ";
            }
        }
        // Size
        $meta_cat_size = get_theme_mod( 'badoblog_cus_cat_meta_cat_size', 'mid' );
        if ( $meta_cat_size == 'small' ) {
            $css .= "\n        .badoblog-css-cat-meta-tax-cat-ul a {\n          font-size: 14px;\n          padding: 10px 20px;\n        }\n        .badoblog-css-cat-meta-tax-cat-ul a:before {\n          font-size: 14px;\n          line-height: 12px;\n        }\n      ";
        } else {
            if ( $meta_cat_size == 'big' ) {
                $css .= "\n        .badoblog-css-cat-meta-tax-cat-ul a {\n          font-size: 18px;\n          padding: 14px 26px;\n        }\n        .badoblog-css-cat-meta-tax-cat-ul a:before {\n          font-size: 17px;\n          line-height: 16px;\n        }\n      ";
            }
        }
        // Where to display categories meta tags
        if ( $cat_meta_cat_lay == 'thumb-top' ) {
            $css .= '
        .badoblog-css-cat-thumbnail .badoblog-css-cat-meta-taxonomy-cat {
          bottom: auto;
          top: 0;
        }
      ';
        }
    }
    //? ---------- ---------- Meta tags (tag)
    if ( $cat_meta_tag == 1 ) {
        // Align center
        if ( get_theme_mod( 'badoblog_cus_cat_meta_tag_center', 0 ) == 1 ) {
            $css .= '
        .badoblog-css-cat-meta-taxonomy-tag {
          justify-content: center;
        }
      ';
        }
        // Tag icons
        $cat_icon = get_theme_mod( 'badoblog_cus_cat_meta_tag_icon', 3 );
        switch ( $cat_icon ) {
            case 0:
                $css .= "\n          .badoblog-css-cat-meta-tax-tag-ul a:before {\n            display: none;\n          }\n        ";
                break;
            case 1:
                $css .= '
          .badoblog-css-cat-meta-tax-tag-ul a:before {
            font-family: "Open Sans", "Play", sans-serif;
            content: "#";
            padding-right: 4px;
            font-size: 16px;
          }
        ';
                break;
            // Hashtag (bold)
            case 2:
                $css .= '
          .badoblog-css-cat-meta-tax-tag-ul a:before {
            content: "\\f292";
            padding-right: 4px;
            font-size: 13px;
          }
        ';
                break;
            // Arrow
            case 4:
                $css .= '
          .badoblog-css-cat-meta-tax-tag-ul a:before {
            content: "\\e929";
            padding-right: 5px;
            font-size: 13px;
          }
        ';
                break;
            // Lightning
            case 5:
                $css .= '
          .badoblog-css-cat-meta-tax-tag-ul a:before {
            content: "\\e919";
            padding-right: 2px;
            font-size: 13px;
          }
        ';
                break;
            default:
                break;
        }
        // Size
        $meta_tag_size = get_theme_mod( 'badoblog_cus_cat_meta_tag_size', 'mid' );
        if ( $meta_tag_size == 'small' ) {
            $css .= "\n        .badoblog-css-cat-meta-tax-tag a {\n          font-size: 14px;\n        }\n      ";
        } else {
            if ( $meta_tag_size == 'big' ) {
                $css .= "\n        .badoblog-css-cat-meta-tax-tag a {\n          font-size: 18px;\n        }\n      ";
            }
        }
    }
    //? ---------- ---------- Background color of sticky posts
    if ( !empty( $sticky_color ) ) {
        $css .= '
      article.sticky {
        background: ' . $sticky_color . ';
      }
    ';
    }
    //? ---------- ---------- Pagination in categories
    //? ---------- Numeric pagination
    if ( $pagi_cat == 'v1' ) {
        // Block design - Numeric pagination
        switch ( $pagi_design_cat ) {
            // Buttons
            case 'v1':
                $css .= "\n          .nav-links a {\n            background: {$primary_color};\n            color: {$color_lite};\n          }\n          .nav-links a:hover {\n            box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);\n            color: {$color_lite};\n          }\n          .nav-links span.current {\n            border: 1px solid {$primary_color};\n          }\n        ";
                break;
            // Frames
            case 'v2':
                $css .= "\n          .nav-links a {\n            border: 1px solid {$primary_color};\n            color: {$color_link};\n          }\n          .nav-links span.current {\n            background: {$primary_color};\n            color: {$color_lite};\n          }\n          .nav-links a:hover {\n            color: {$link_hover};\n          }\n        ";
                break;
            default:
                break;
        }
        // Location of the pagination block
        switch ( $pagi_layout_cat ) {
            // Right
            case 'v1':
                $css .= "\n          .nav-links {\n            justify-content: flex-end;\n          }\n        ";
                break;
            // Center
            case 'v2':
                $css .= "\n          .nav-links {\n            justify-content: center;\n          }\n        ";
                break;
            // Full width
            case 'v3':
                $css .= "\n          .nav-links {\n            justify-content: space-evenly;\n          }\n          .nav-links a.prev {\n            margin-right: 25px;\n          }\n          .nav-links a.next {\n            margin-left: 25px;\n          }\n        ";
                break;
            // default - Left
            default:
                break;
        }
        // Pagination block size - Numeric pagination
        switch ( $pagi_size_cat ) {
            // Small
            case 'v1':
                $css .= "\n          .nav-links span,\n          .nav-links a {\n            font-size: 14px;\n            padding: 6px 14px;\n          }\n        ";
                break;
            // Big
            case 'v3':
                $css .= '
          .nav-links span,
          .nav-links a {
            padding: 15px 25px;
          }
        ';
                if ( $pagi_design_cat == 'v0' ) {
                    $css .= '
            .nav-links span,
            .nav-links a {
              font-size: 24px;
            }
          ';
                }
                break;
            // Average
            default:
                break;
        }
    }
    //? ---------- Button (Show more)
    if ( $pagi_cat == 'v2' ) {
        // Button design (Show more)
        switch ( $pagi_design_cat ) {
            // Turn off styles
            case 'v0':
                $css .= "\n          .badoblog-css-loadmore-button {\n            background: inherit;\n            color: {$color_link};\n          }\n          .badoblog-css-loadmore-button:hover {\n            box-shadow: none;\n            color: {$link_hover};\n          }\n        ";
                break;
            // Frames
            case 'v2':
                $css .= "\n          .badoblog-css-loadmore-button {\n            background: inherit;\n            border: 1px solid {$primary_color};\n            color: {$color_link};\n          }\n          .badoblog-css-loadmore-button:hover {\n            box-shadow: none;\n            color: {$link_hover};\n          }\n        ";
                break;
            default:
                break;
        }
        // Button location (Show more)
        switch ( $pagi_layout_cat ) {
            // Right
            case 'v1':
                $css .= "\n          .badoblog-css-loadmore {\n            justify-content: flex-end;\n          }\n        ";
                break;
            // Center
            case 'v2':
                $css .= "\n          .badoblog-css-loadmore {\n            justify-content: center;\n          }\n        ";
                break;
            // Full width
            case 'v3':
                $css .= "\n          .badoblog-css-loadmore-button {\n            width: 100%;\n          }\n        ";
                break;
            // default Left
            default:
                break;
        }
        // Button size (Show more)
        switch ( $pagi_size_cat ) {
            // Small
            case 'v1':
                if ( $pagi_design_cat !== 'v0' ) {
                    $css .= "\n            .badoblog-css-loadmore-button {\n              font-size: 16px;\n              padding: 10px 20px;\n            }\n          ";
                } else {
                    $css .= "\n            .badoblog-css-loadmore-button {\n              font-size: 16px;\n            }\n          ";
                }
                break;
            // Big
            case 'v3':
                if ( $pagi_design_cat !== 'v0' ) {
                    $css .= "\n            .badoblog-css-loadmore-button {\n              font-size: 20px;\n              padding: 18px 34px;\n            }\n          ";
                } else {
                    $css .= "\n            .badoblog-css-loadmore-button {\n              font-size: 24px;\n            }\n          ";
                }
                break;
            // default Average
            default:
                if ( $pagi_design_cat == 'v0' ) {
                    $css .= "\n            .badoblog-css-loadmore-button {\n              font-size: 20px;\n            }\n          ";
                }
                break;
        }
    }
    //? ---------- Buttons (Back and forward)
    if ( $pagi_cat == 'v0' ) {
        // Button design (Back and forward)
        switch ( $pagi_design_cat ) {
            // Buttons
            case 'v1':
                $css .= "\n          .nav-links a {\n            background: {$primary_color};\n            color: {$color_lite};\n          }\n          .nav-links a:hover {\n            box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);\n            color: {$color_lite};\n          }\n        ";
                break;
            // Frames
            case 'v2':
                $css .= "\n          .nav-links a {\n            border: 1px solid {$primary_color};\n            color: {$color_link};\n          }\n          .nav-links a:hover {\n            color: {$link_hover};\n          }\n        ";
                break;
            default:
                break;
        }
        // Block location - (Back and forward)
        switch ( $pagi_layout_cat ) {
            // Right
            case 'v1':
                $css .= "\n          .nav-links {\n            justify-content: flex-end;\n            grid-column-gap: 10px;\n          }\n        ";
                break;
            // Center
            case 'v2':
                $css .= "\n          .nav-links {\n            justify-content: center;\n            grid-column-gap: 10px;\n          }\n        ";
                break;
            // Full width
            case 'v3':
                $css .= "\n          .nav-links {\n            justify-content: space-between;\n          }\n        ";
                break;
            // Left
            default:
                $css .= "\n          .nav-links {\n            grid-column-gap: 10px;\n          }\n        ";
                break;
        }
        // Block size - (Back and forward)
        switch ( $pagi_size_cat ) {
            // Small
            case 'v1':
                $css .= "\n          .nav-links a {\n            font-size: 14px;\n            padding: 6px 14px;\n          }\n        ";
                break;
            // Big
            case 'v3':
                $css .= "\n          .nav-links a {\n            padding: 16px 26px;\n          }\n        ";
                if ( $pagi_design_cat == 'v0' ) {
                    $css .= '
            .nav-links a {
              font-size: 24px;
            }
          ';
                }
                break;
            // Average
            default:
                break;
        }
    }
    //----------------------------------------------------------------------------------
    //region Posts & Pages
    //----------------------------------------------------------------------------------
    //? ---------- ---------- Top img for post
    $img_post = get_theme_mod( 'badoblog_cus_post_img_top_post_size', 'max' );
    if ( $img_post != 'max' ) {
        // Top img max size
        $img_post_s = substr( $img_post, 0, 3 );
        $css .= '
      .badoblog-css-post-thumbnail {
        max-width: ' . $img_post_s . 'px;
      }
    ';
        // Tax style change if the image is small
        switch ( $img_post ) {
            case '560x315':
            case '464x261':
            case '384x216':
            case '300x169':
                $css .= '
          .badoblog-css-post-thumbnail .badoblog-css-post-meta-data-tax {
            margin: 15px;
          }
          .badoblog-css-post-thumbnail .badoblog-css-post-meta-data-tax-ul {
            gap: 5px;
          }
        ';
                break;
            default:
                break;
        }
    }
    //? ---------- ---------- Top img for page
    $img_page = get_theme_mod( 'badoblog_cus_post_img_top_page_size', 'max' );
    if ( $img_page != 'max' ) {
        // Top img max size
        $img_page_s = substr( $img_page, 0, 3 );
        $css .= '
      .badoblog-css-page-thumbnail {
        max-width: ' . $img_page_s . 'px;
      }
    ';
    }
    //? ---------- ---------- Posts & Pages - Meta tags (meta boxs)
    if ( get_theme_mod( 'badoblog_cus_post_meta_boxs', 1 ) == 1 ) {
        // Meta tags (meta boxs) size
        if ( get_theme_mod( 'badoblog_cus_post_meta_boxs_size', 'big' ) == 'small' ) {
            $css .= "\n        .badoblog-css-post-meta-box {\n          padding: 10px 14px;\n        }\n        .icon-autor-post-meta::before,\n        .icon-eye-post-meta::before {\n          font-size: 18px;\n        }\n        .icon-calendar-post-meta::before,\n        .icon-spinner-post-meta::before,\n        .icon-bubble-post-meta::before,\n        .icon-clock-post-meta::before {\n          font-size: 16px;\n        }\n        .badoblog-css-post-meta-data,\n        .badoblog-css-post-meta-data a {\n          font-size: 12px;\n        }\n        .badoblog-css-post-meta-label {\n          font-size: 11px;\n        }\n        .badoblog-css-post-footer-date-span {\n          padding: 10px 20px;\n        }\n      ";
        }
        // Align meta blocks to the center
        if ( esc_attr( get_theme_mod( 'badoblog_cus_post_meta_boxs_center', 1 ) ) == 1 ) {
            $css .= '
        .badoblog-css-post-meta-boxs {
          justify-content: center;
        }
      ';
        }
        // Meta box design
        switch ( esc_attr( get_theme_mod( 'badoblog_cus_post_meta_boxs_design', 'v4' ) ) ) {
            // Simple
            case 'v0':
                $css .= "\n          .badoblog-css-post-meta-box,\n          .badoblog-css-post-footer-date-span {\n            box-shadow: none;\n            margin: 0;\n          }\n        ";
                break;
            // Frames
            case 'v1':
                $css .= "\n          .badoblog-css-post-meta-box,\n          .badoblog-css-post-footer-date-span {\n            border: 1px solid {$primary_color};\n          }\n        ";
                break;
            // Underlined
            case 'v2':
                $css .= "\n          .badoblog-css-post-meta-box,\n          .badoblog-css-post-footer-date-span {\n            box-shadow: none;\n            border-bottom: 1px solid {$primary_color};\n            border-radius: 0;\n          }\n        ";
                break;
            // Underlined (circle)
            case 'v3':
                $css .= "\n          .badoblog-css-post-meta-box,\n          .badoblog-css-post-footer-date-span {\n            box-shadow: none;\n            border-bottom: 1px solid {$primary_color};\n          }\n        ";
                break;
            // Deepening
            case 'v5':
                $css .= '
          .badoblog-css-post-meta-box,
          .badoblog-css-post-footer-date-span {
            box-shadow: inset 0 0.1em 0.3em rgba(0,0,0,0.2);
          }
        ';
                break;
            // Background
            case 'v6':
                $css .= "\n          .badoblog-css-post-meta-box,\n          .badoblog-css-post-footer-date-span {\n            background: {$primary_big_color};\n          }\n          .badoblog-css-post-meta-box,\n          .badoblog-css-post-meta-box a,\n          .icon-autor-post-meta::before,\n          .icon-calendar-post-meta::before,\n          .icon-spinner-post-meta::before,\n          .icon-bubble-post-meta::before,\n          .icon-clock-post-meta::before,\n          .icon-eye-post-meta::before,\n          .badoblog-css-post-footer-date-span {\n            color: {$primary_big_lite_color};\n          }\n        ";
                break;
            // Soaring
            default:
                break;
        }
        // Remove icons in meta boxes
        if ( esc_attr( get_theme_mod( 'badoblog_cus_post_meta_boxs_icon', 0 ) ) == 1 ) {
            $css .= '
        .icon-autor-post-meta::before,
        .icon-calendar-post-meta::before,
        .icon-spinner-post-meta::before,
        .icon-bubble-post-meta::before,
        .icon-clock-post-meta::before,
        .icon-eye-post-meta::before {
          display: none;
        }
      ';
        }
        // Add tooltips to meta blocks in posts
        if ( esc_attr( get_theme_mod( 'badoblog_cus_post_meta_boxs_prompt', 1 ) ) == 1 ) {
            $css .= '
        .badoblog-css-post-meta-box {
          position: relative;
        }
        .badoblog-css-post-meta-box::after {
          content: attr(data-info);
          display: inline;
          position: absolute;
          top: 100px;
          left: -25px;
          opacity: 0;
          width: 180px;
          font-size: 14px;
          line-height: 1.5;
          padding: 10px 12px 12px 15px;
          background: rgba(0,0,0,0.7);
          border-radius: 15px;
          color: #fff;
          pointer-events: none;
          transition: opacity 250ms, top 250ms;
        }
        /* We are making the tooltip smaller because it moves the site frame if there is no sidebar on the right */
        .badoblog-css-left-sidebar .badoblog-css-post-meta-box::after {
          width: 120px;
        }
        .badoblog-css-post-meta-box::before {
          content: "";
          display: block;
          position: absolute;
          top: 100px;
          left: 15px;
          opacity: 0;
          width: 0; height: 0;
          border: solid transparent 5px;
          border-bottom-color: rgba(0,0,0,0.7);
          transition: opacity 250ms, top 250ms;
        }
        .badoblog-css-post-meta-box:hover {
          z-index: 2;
        }
        .badoblog-css-post-meta-box:hover::after {
          top: 37px;
          left: -25px;
          opacity: 1;
        }
        .badoblog-css-post-meta-box:hover::before {
          top: 27px;
          left: 15px;
          opacity: 1;
        }
        @media (max-width: 960px) {
          .badoblog-css-post-meta-box::after {
            width: 115px;
            font-size: 12px;
          }
        }
      ';
        }
    }
    //? ---------- ---------- Posts & Pages - Meta tags (categories)
    if ( get_theme_mod( 'badoblog_cus_post_meta_cat', 1 ) == 1 ) {
        // Meta tags (categories) size
        if ( get_theme_mod( 'badoblog_cus_post_meta_cat_size', 'big' ) == 'small' ) {
            $css .= "\n        .badoblog-css-post-tax-cat {\n          font-size: 16px;\n        }\n        .icon-cat-post-meta::before {\n          font-size: 16px;\n          line-height: 1.4;\n        }\n        .badoblog-css-post-tax-cat .badoblog-css-post-meta-data-tax a {\n          padding: 10px 20px;\n        }\n        .badoblog-css-post-thumbnail .label-taxonomy .badoblog-css-post-meta-data-tax {\n          padding: 10px 10px 10px 20px;\n        }\n      ";
        }
        // Align taxonomies (cat) to the center
        if ( esc_attr( get_theme_mod( 'badoblog_cus_post_meta_cat_center', 0 ) ) == 1 ) {
            $css .= '
        .badoblog-css-post-thumbnail {
          display: flex;
          justify-content: center;
        }
        .badoblog-css-post-tax-cat  {
          flex-direction: column;
        }
      ';
        }
        // Where to display categories meta tags
        if ( get_theme_mod( 'badoblog_cus_post_meta_cat_lay', 'thumb-bottom' ) == 'thumb-top' ) {
            $css .= '
        .badoblog-css-post-thumbnail .badoblog-css-post-meta-box-taxonomy {
          bottom: auto;
          top: 0;
        }
      ';
        }
        // Cat icons
        $post_cat_icon = get_theme_mod( 'badoblog_cus_post_meta_cat_icon', 1 );
        if ( $post_cat_icon != 1 ) {
            $ico_cat = '';
            switch ( $post_cat_icon ) {
                case 2:
                    $ico_cat = '\\f07c';
                    break;
                case 3:
                    $ico_cat = '\\e930';
                    break;
                case 4:
                    $ico_cat = '\\e908';
                    break;
                case 5:
                    $ico_cat = '\\e91a';
                    break;
                case 6:
                    $ico_cat = '\\e912';
                    break;
                case 7:
                    $ico_cat = '\\f07b';
                    break;
                case 8:
                    $ico_cat = '\\e916';
                    break;
                case 9:
                    $ico_cat = '\\e905';
                    break;
                default:
                    break;
            }
            if ( !empty( $ico_cat ) ) {
                $css .= "\n          .badoblog-css-post-tax-cat .badoblog-css-post-meta-data-tax-ul a:before {\n            content: '{$ico_cat}';\n          }\n        ";
            } else {
                $css .= "\n          .badoblog-css-post-tax-cat .badoblog-css-post-meta-data-tax-ul a:before {\n            display: none;\n          }\n        ";
            }
        }
    }
    //? ---------- ---------- Posts & Pages - Meta tags (tags)
    if ( get_theme_mod( 'badoblog_cus_post_meta_tag', 1 ) == 1 ) {
        // Meta tags (tags) size
        if ( get_theme_mod( 'badoblog_cus_post_meta_tag_size', 'big' ) == 'small' ) {
            $css .= "\n        .badoblog-css-post-tax-tag {\n          font-size: 16px;\n        }\n        .icon-tag-post-meta::before {\n          font-size: 16px;\n          line-height: 1.4;\n        }\n        .badoblog-css-post-tax-tag .badoblog-css-post-meta-data-tax a {\n          padding: 10px 20px;\n        }\n      ";
        }
        // Align taxonomies (tag) to the center
        if ( esc_attr( get_theme_mod( 'badoblog_cus_post_meta_tag_center', 0 ) ) == 1 ) {
            $css .= '
        .badoblog-css-post-tax-tag  {
          flex-direction: column;
        }
      ';
        }
        // Tag icons
        $post_tag_icon = get_theme_mod( 'badoblog_cus_post_meta_tag_icon', 1 );
        if ( $post_tag_icon != 1 ) {
            $ico_tag = '';
            $ico_size = 13;
            switch ( $post_tag_icon ) {
                // Hashtag (bold)
                case 2:
                    $ico_tag = '\\f292';
                    break;
                // Sticker
                case 3:
                    $ico_tag = '\\e935';
                    break;
                // Arrow
                case 4:
                    $ico_tag = '\\e929';
                    $ico_size = 14;
                    break;
                // Lightning
                case 5:
                    $ico_tag = '\\e919';
                    $ico_size = 14;
                    break;
                default:
                    break;
            }
            if ( !empty( $ico_tag ) ) {
                $css .= '
          .badoblog-css-post-tax-tag .badoblog-css-post-meta-data-tax-ul a:before {
            font-family: "icomoon";
            content: "' . $ico_tag . '";
            font-size: ' . $ico_size . 'px;
            padding-right: 8px;
          }
        ';
            } else {
                $css .= "\n          .badoblog-css-post-tax-tag .badoblog-css-post-meta-data-tax-ul a:before {\n            display: none;\n          }\n        ";
            }
        }
    }
    //? ---------- ---------- Bulleted and numeric lists variation
    //? ---------- Bulleted lists variation
    if ( $mark_list != 'v0' ) {
        // Marker color
        if ( empty( $l_mark_color ) ) {
            $l_mark_color = $primary_color;
        }
        $css .= '
      .badoblog-css-mod-pp-content ul > li::marker {
        color: ' . $l_mark_color . ';
      }
    ';
        // Common bulleted list styles
        $css .= '
      .badoblog-css-mod-pp-content ul li {
        padding-left: 3px;
      }
    ';
        switch ( $mark_list ) {
            // Small dot
            case 'v1':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: disc;
          }
        ';
                break;
            // Small square
            case 'v2':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: square;
          }
        ';
                break;
            // Small circle
            case 'v3':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: circle;
          }
        ';
                break;
            // Square frame
            case 'v4':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\25AB  ";
            padding-left: 5px;
            margin-left: -6px;
          }
        ';
                break;
            // Small dash
            case 'v5':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "−  ";
          }
          .badoblog-css-mod-pp-content ul > li::marker {
            font-weight: 600;
          }
        ';
                break;
            // Big dot
            case 'v6':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\2B24  ";
            padding-left: 5px;
          }
        ';
                break;
            // Big square
            case 'v7':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\25A0  ";
            padding-left: 5px;
          }
        ';
                break;
            // Big circle
            case 'v8':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\2B58  ";
            padding-left: 5px;
          }
        ';
                break;
            // Rounded square frame
            case 'v9':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\25A2  ";
            padding-left: 5px;
          }
        ';
                break;
            // Big dash
            case 'v10':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\25AC  ";
            padding-left: 7px;
            margin-left: 4px;
          }
        ';
                break;
            // Check mark
            case 'v11':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\2713  ";
            padding-left: 5px;
          }
        ';
                break;
            // Rhombus
            case 'v12':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\2B26  ";
          }
        ';
                break;
            // Triangle
            case 'v13':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: disclosure-closed;
          }
        ';
                break;
            // Star
            case 'v14':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\2736  ";
          }
        ';
                break;
            // Snowflake
            case 'v15':
                $css .= '
          .badoblog-css-mod-pp-content ul > li {
            list-style-type: "\\2731  ";
          }
        ';
                break;
            default:
                break;
        }
    }
    //? ---------- Numeric lists variation
    if ( $num_list != 'v0' ) {
        // Marker background color
        if ( empty( $l_num_color ) ) {
            $l_num_color = $primary_color;
        }
        // Bullet text color
        if ( empty( $l_num_text_color ) ) {
            $l_num_text_color = $color_lite;
        }
        // General numbered list styles
        $css .= '
      .badoblog-css-mod-pp-content ol {
        padding-left: 25px;
      }
      .badoblog-css-mod-pp-content ol > li > ul {
        padding-left: 62px;
      }
      .badoblog-css-mod-pp-content ol > li > ol {
        padding-left: 45px;
      }
    ';
        // General styles and scripts for numbereds lists
        if ( $num_list == 'v1' || $num_list == 'v2' || $num_list == 'v3' || $num_list == 'v4' ) {
            wp_enqueue_script(
                'badoblog-script-ol-design',
                get_template_directory_uri() . '/js/ol-design.js',
                array('jquery'),
                BADOBLOG_VERSION,
                true
            );
            $css .= "\n        .badoblog-css-mod-pp-content ol > li {\n          list-style: none;\n        }\n        .badoblog-css-mod-pp-content ol {\n          counter-reset: Count-N;\n        }\n        .badoblog-css-mod-pp-content ol > li:before {\n          counter-increment: Count-N;\n          content: counter(Count-N);\n          height: auto;\n          width: auto;\n          margin-right: 10px;\n        }\n      ";
        } else {
            $css .= '
        .badoblog-css-mod-pp-content ol > li:before {
          content: "";
          margin-right: 5px;
        }
        .badoblog-css-mod-pp-content ol > li::marker {
          color: ' . $l_num_color . ';
        }
      ';
        }
        // Numeric lists variation
        switch ( $num_list ) {
            // Colored square
            case 'v1':
                $css .= '
          .badoblog-css-mod-pp-content ol > li:before {
            font-family: "Play";
            color: ' . $l_num_text_color . ';
            background: ' . $l_num_color . ';
            padding: 2px 8px;
            border-radius: 2px;
          }
        ';
                break;
            // Square frame
            case 'v2':
                $css .= '
          .badoblog-css-mod-pp-content ol > li:before {
            font-family: "Play";
            color: ' . $l_num_color . ';
            border: 1px solid ' . $l_num_color . ';
            padding: 3px 8px 2px;
            border-radius: 2px;
          }
        ';
                break;
            // Colored circle
            case 'v3':
                $css .= '
          .badoblog-css-mod-pp-content ol > li:before {
            font-family: "Play";
            color: ' . $l_num_text_color . ';
            background:  ' . $l_num_color . ';
            padding: 3px 8px 3px 8px;
            border-radius: 50px;
          }
        ';
                break;
            // Round frame
            case 'v4':
                $css .= '
          .badoblog-css-mod-pp-content ol > li:before {
            font-family: "Play";
            color: ' . $l_num_color . ';
            border: 1px solid ' . $l_num_color . ';
            padding: 3px 8px 2px;
            border-radius: 50px;
          }
        ';
                break;
            // Colored numbers
            case 'v5':
                $css .= '
          .badoblog-css-mod-pp-content ol > li {
            list-style: decimal inside;
          }
      ';
                break;
            // Colored numbers (bold)
            case 'v6':
                $css .= '
          .badoblog-css-mod-pp-content ol > li {
            list-style: decimal inside;
          }
          .badoblog-css-mod-pp-content ol > li::marker {
            color: ' . $l_num_color . ';
            font-weight: 600;
          }
        ';
                break;
            // Latin numerals
            case 'v7':
                $css .= '
          .badoblog-css-mod-pp-content ol > li {
            list-style: upper-roman inside;
          }
        ';
                break;
            // Colored letters (EN)
            case 'v8':
                $css .= '
          .badoblog-css-mod-pp-content ol > li {
            list-style: upper-latin inside;
          }
        ';
                break;
            default:
                break;
        }
    }
    //? ---------- ---------- Quote blocks
    if ( $quote_block !== 'v0' ) {
        //? ---------- Editing a block editor - remove the border on the left
        $css .= '
      .badoblog-css-mod-pp-content .wp-block-quote {
        border-left: none;
      }
    ';
        //? ---------- Quote block background color
        $q_back_color = $content_color;
        if ( !empty( $quote_back_color ) ) {
            $q_back_color = $quote_back_color;
            $css .= '
        .badoblog-css-mod-pp-content > blockquote {
          background: ' . $q_back_color . ';
        }
      ';
        }
        //? ---------- Quote block text color
        if ( !empty( $quote_text_color ) ) {
            $css .= '
      .badoblog-css-mod-pp-content > blockquote p,
      .badoblog-css-mod-pp-content > blockquote cite {
        color: ' . $quote_text_color . ';
      }';
        }
        //? ---------- Background color of icons and lines for quote block
        if ( empty( $quote_icon_back ) ) {
            $quote_icon_back = $primary_color;
        }
        //? ---------- Quote block design
        switch ( $quote_block ) {
            // Gradient 1
            case 'v2':
                $css .= "\n          .badoblog-css-mod-pp-content > blockquote {\n            background: repeating-linear-gradient(135deg, rgba(0,0,0,0.3) 0px, rgba(0,0,0,0.4) 0px, {$q_back_color} 0.5px, {$q_back_color} 45px);\n          }\n        ";
                break;
            // Gradient 2
            case 'v3':
                $css .= "\n          .badoblog-css-mod-pp-content > blockquote {\n            background: repeating-linear-gradient(45deg, rgba(0,0,0,0.3) 0px, rgba(0,0,0,0.4) 0px, {$q_back_color} 0.5px, {$q_back_color} 15px);\n          }\n        ";
                break;
            // Grid
            case 'v4':
                // Convert background color to rgba
                $rgba = sscanf( $q_back_color, "#%02x%02x%02x" );
                $rgb = "rgba({$rgba[0]}, {$rgba[1]}, {$rgba[2]}, 0.2)";
                $css .= "\n          .badoblog-css-mod-pp-content > blockquote {\n            background:\n            repeating-linear-gradient(-90deg, transparent, transparent 4px,\n            {$rgb} 4px, {$rgb} 110px),\n            repeating-linear-gradient(-90deg, transparent, transparent 2px,\n            {$rgb} 2px, {$rgb} 90px),\n            repeating-linear-gradient(0deg, transparent, transparent 2px,\n            {$rgb} 2px, {$rgb} 40px),\n            repeating-linear-gradient(0deg, transparent, transparent 1px,\n            {$rgb} 1px, {$rgb} 50px);\n          }\n        ";
                break;
            // Folded corner
            case 'v5':
                $css .= '
          .badoblog-css-mod-pp-content > blockquote {
            background:
            linear-gradient(to left bottom, transparent 50%, rgba(0, 0, 0, 0.268) 0) no-repeat 100% 0 / 30px 30px,
            linear-gradient(-135deg, transparent 20px, ' . $q_back_color . ' 0);
            filter: drop-shadow(10px 15px rgba(0,0,0,0.1));
          }
          .badoblog-css-mod-pp-content > blockquote,
          .badoblog-css-mod-pp-content > .wp-block-quote {
            margin-bottom: 2em;
          }
        ';
                break;
            // Solid frame
            case 'v6':
                $css .= '
          .badoblog-css-mod-pp-content > blockquote {
            border: 1px solid ' . $quote_icon_back . ';
          }
          .badoblog-css-mod-pp-content > .wp-block-quote {
            border-left: 1px solid ' . $quote_icon_back . ';
          }
        ';
                break;
            // Dotted frame
            case 'v7':
                $css .= '
          .badoblog-css-mod-pp-content > blockquote {
            border: 2px dashed ' . $quote_icon_back . ';
          }
          .badoblog-css-mod-pp-content > .wp-block-quote {
            border-left: 2px dashed ' . $quote_icon_back . ';
          }
        ';
                break;
            // Border left
            case 'v8':
                $css .= '
          .badoblog-css-mod-pp-content > blockquote {
            box-shadow: -7px 0 0 ' . $quote_icon_back . ';
          }
        ';
                break;
            // Double border
            case 'v9':
                $css .= '
          .badoblog-css-mod-pp-content > blockquote {
            box-shadow: -7px 0 0 ' . $quote_icon_back . ', 7px 0 0 ' . $quote_icon_back . ';
          }
        ';
                break;
            default:
                break;
        }
        //? ---------- Add icon to quote block
        if ( get_theme_mod( 'badoblog_cus_post_quote_icon', 1 ) == 1 ) {
            // Define icon color if it is not specified
            $q_icon_color = 'inherit';
            if ( !empty( $quote_icon_color ) ) {
                $q_icon_color = $quote_icon_color;
            }
            // Add background for icon
            if ( get_theme_mod( 'badoblog_cus_post_quote_icon_back_activ', 0 ) == 1 ) {
                $css .= '
          .badoblog-css-mod-pp-content > blockquote::before{
            background: ' . $quote_icon_back . ';
            border-radius: 15px;
          }
        ';
                // Define icon color if none is specified and icon background is enabled
                if ( empty( $quote_icon_color ) ) {
                    $q_icon_color = $color_lite;
                }
            }
            // Selecting an icon for the quote block
            switch ( esc_attr( get_theme_mod( 'badoblog_cus_post_quote_icon_select', 'v4' ) ) ) {
                // Square quotes
                case 'v1':
                    $q_icon = '\\e90f';
                    break;
                // Straight quotes
                case 'v2':
                    $q_icon = '\\e922';
                    break;
                // Sharp quotes
                case 'v3':
                    $q_icon = '\\e911';
                    break;
                // Round quotes
                case 'v4':
                    $q_icon = '\\e977';
                    break;
                // Paper clip
                case 'v5':
                    $q_icon = '\\e9cd';
                    break;
                // Paper clip (vertical)
                case 'v6':
                    $q_icon = '\\e947';
                    break;
                // Drawing pin
                case 'v7':
                    $q_icon = '\\e93b';
                    break;
                // Drawing pin (vertical)
                case 'v8':
                    $q_icon = '\\e909';
                    break;
                // Bulb
                case 'v9':
                    $q_icon = '\\e904';
                    break;
                // Bell
                case 'v10':
                    $q_icon = '\\e940';
                    break;
                // Attention triangle
                case 'v11':
                    $q_icon = '\\e03d';
                    break;
                // Exclamation sheet
                case 'v12':
                    $q_icon = '\\e94c';
                    break;
                // Exclamation mark
                case 'v13':
                    $q_icon = '\\e952';
                    break;
                // Cloud conversation
                case 'v14':
                    $q_icon = '\\e906';
                    break;
                // Speaker
                case 'v15':
                    $q_icon = '\\e91d';
                    break;
                // Open book
                case 'v16':
                    $q_icon = '\\e913';
                    break;
                // Embossed tick
                case 'v17':
                    $q_icon = '\\ea11';
                    break;
                // Solid tick
                case 'v18':
                    $q_icon = '\\ea10';
                    break;
                // default
                default:
                    $q_icon = '\\e948';
                    break;
            }
            // General styles for icons
            $css .= '
        .badoblog-css-mod-pp-content > blockquote {
          display: flex;
          flex-wrap: wrap;
          align-items: center;
        }
        .badoblog-css-mod-pp-content > blockquote::before {
          font-family: "icomoon";
          text-rendering: auto;
          padding: 0 .5em;
          content: "' . $q_icon . '";
          color: ' . $q_icon_color . ';
          font-size: ' . $quote_icon_size . 'px;
          line-height: 1.5;
        }
      ';
            // Choosing the location of the quotes icon
            if ( get_theme_mod( 'badoblog_cus_post_quote_icon_layout', 'center' ) == 'left' ) {
                // Left
                $css .= '
          .badoblog-css-mod-pp-content > blockquote::before {
            margin: .5em 1.25em;
          }
          .badoblog-css-mod-pp-content > blockquote p {
            width: 75%;
          }
          @media (max-width: 700px) {
            .badoblog-css-mod-pp-content > blockquote p {
              width: 100%;
            }
          }
        ';
            } else {
                // Center
                $css .= '
          .badoblog-css-mod-pp-content > blockquote {
            flex-direction: column;
            text-align: center;
          }
        ';
            }
        }
        //? ---------- Automatic background color for block quotes
        if ( esc_attr( get_theme_mod( 'badoblog_cus_post_quote_auto_color', 0 ) ) == 1 ) {
            // Options strripos: 1 - search string, 2 - search value, 3 - direction and position of the start of the search)
            if ( strripos( $content_color, 'd', -5 ) === false ) {
                $c_r = 'dd';
            } else {
                $c_r = 'aa';
            }
            // after the first character #, change two color characters
            $col = substr_replace(
                $content_color,
                $c_r,
                1,
                2
            );
            switch ( $quote_block ) {
                // Gradient 1
                case 'v2':
                    $css .= "\n            .badoblog-css-mod-pp-content > blockquote {\n              background: repeating-linear-gradient(135deg, #d8d8d8 0px, #d8d8d8 0px, {$col} 0.5px, {$col} 45px);\n            }\n          ";
                    break;
                // Gradient 2
                case 'v3':
                    $css .= "\n            .badoblog-css-mod-pp-content > blockquote {\n              background: repeating-linear-gradient(45deg, #d8d8d8 0px, #d8d8d8 0px, {$col} 0.5px, {$col} 15px);\n            }\n          ";
                    break;
                // Grid
                case 'v4':
                    // Convert background color to rgba
                    $rgb_a = sscanf( $col, "#%02x%02x%02x" );
                    $rgb_b = "rgba({$rgb_a[0]}, {$rgb_a[1]}, {$rgb_a[2]}, 0.5)";
                    $css .= "\n            .badoblog-css-mod-pp-content > blockquote {\n              background:\n              repeating-linear-gradient(-90deg, transparent, transparent 4px,\n              {$rgb_b} 4px, {$rgb_b} 110px),\n              repeating-linear-gradient(-90deg, transparent, transparent 2px,\n              {$rgb_b} 2px, {$rgb_b} 90px),\n              repeating-linear-gradient(0deg, transparent, transparent 2px,\n              {$rgb_b} 2px, {$rgb_b} 40px),\n              repeating-linear-gradient(0deg, transparent, transparent 1px,\n              rgba(0, 0, 0, 0.2) 1px, rgba(0, 0, 0, 0.2) 50px);\n            }\n          ";
                    break;
                // Folded corner
                case 'v5':
                    $css .= '
            .badoblog-css-mod-pp-content > blockquote {
              background:
              linear-gradient(to left bottom, transparent 50%, rgba(0, 0, 0, 0.2) 0) no-repeat 100% 0 / 30px 30px,
              linear-gradient(-135deg, transparent 20px, ' . $col . ' 0);
            }
          ';
                    break;
                default:
                    $css .= "\n            .badoblog-css-mod-pp-content > blockquote, .badoblog-css-mod-pp-content > blockquote {\n              background: {$col};\n            }\n          ";
                    break;
            }
        }
    }
    //? ---------- ---------- H1 headings (posts and pages)
    //? ---------- Text color of H1 headings (posts and pages)
    $h1_t_color_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h1_color' ) );
    if ( !empty( $h1_t_color_post ) ) {
        $css .= '
      .badoblog-css-mod-pp-header h1,
      .badoblog-css-mod-pp-content h1 {
        color: ' . $h1_t_color_post . ';
      }
    ';
    }
    //? ---------- Header H1 Font (posts and pages)
    $h1_post_font = get_theme_mod( 'badoblog_cus_post_h1_font', 'off' );
    if ( $h1_post_font !== 'off' ) {
        $famaly = '';
        if ( in_array( $h1_post_font, $serif ) ) {
            $famaly = 'serif';
        } elseif ( in_array( $h1_post_font, $cursive ) ) {
            $famaly = 'cursive';
        } else {
            $famaly = 'sans-serif';
        }
        $css .= '
      .badoblog-css-mod-pp-header h1,
      .badoblog-css-mod-pp-content h1 {
        font-family: "' . $h1_post_font . '", ' . $famaly . ';
      }
    ';
    }
    //? ---------- Header H1 text size (posts and pages)
    $h1_t_size_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h1_size', 32 ) );
    if ( $h1_t_size_post != 32 ) {
        $css .= '
      .badoblog-css-mod-pp-header h1,
      .badoblog-css-mod-pp-content h1 {
        font-size: ' . $h1_t_size_post . 'px;
      }
    ';
    }
    //? ---------- Header H1 row height (posts and pages)
    $h1_post_height = esc_attr( get_theme_mod( 'badoblog_cus_post_h1_height', '1.5' ) );
    if ( $h1_post_height !== '1.5' ) {
        $css .= "\n      .badoblog-css-mod-pp-header h1,\n      .badoblog-css-mod-pp-content h1 {\n        line-height: {$h1_post_height};\n      }\n    ";
    }
    //? ---------- ---------- Headings H2 (posts and pages)
    if ( $h2_post !== 'off' ) {
        //? ---------- Background color of H2 headings (posts and pages)
        $h2_b_color_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_back_color' ) );
        if ( !empty( $h2_b_color_post ) ) {
            $css .= '
        .badoblog-css-mod-pp-content > h2 {
          background: ' . $h2_b_color_post . ';
          padding: 5px 15px;
        }
      ';
        }
        //? ---------- Text color of H2 headings (posts and pages)
        $h2_t_color_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_text_color' ) );
        if ( !empty( $h2_t_color_post ) ) {
            $css .= '
        .badoblog-css-mod-pp-content > h2 {
          color: ' . $h2_t_color_post . ';
        }
      ';
        }
        //? ---------- Font for H2 headings (posts and pages)
        $h2_post_font = get_theme_mod( 'badoblog_cus_post_h2_font', 'off' );
        if ( $h2_post_font !== 'off' ) {
            $famaly = '';
            if ( in_array( $h2_post_font, $serif ) ) {
                $famaly = 'serif';
            } elseif ( in_array( $h2_post_font, $cursive ) ) {
                $famaly = 'cursive';
            } else {
                $famaly = 'sans-serif';
            }
            $css .= '
        .badoblog-css-mod-pp-content > h2 {
          font-family: "' . $h2_post_font . '", ' . $famaly . ';
        }
      ';
        }
        //? ---------- Text size of H2 headings (posts and pages)
        $h2_t_size_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_size', 26 ) );
        if ( $h2_t_size_post != 26 ) {
            $css .= '
        .badoblog-css-mod-pp-content > h2 {
          font-size: ' . $h2_t_size_post . 'px;
        }
      ';
        }
        //? ---------- Row height of H2 headings (posts and pages)
        $h2_post_height = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_height', '1.5' ) );
        if ( $h2_post_height !== '1.5' ) {
            $css .= "\n        .badoblog-css-mod-pp-content > h2 {\n          line-height: {$h2_post_height};\n        }\n      ";
        }
        if ( $h2_post !== 'v0' ) {
            //? ---------- H2 heading icons text color (posts and pages)
            if ( empty( $h2_text_icon_color ) ) {
                $h2_text_icon_color = $color_lite;
            }
            //? ---------- H2 heading icons background color (posts and pages)
            if ( empty( $h2_icon_back ) ) {
                $h2_icon_back = $primary_color;
            }
        }
        //? ---------- H2 headings variation (posts and pages)
        switch ( $h2_post ) {
            // Light underlining
            case 'v1':
                $css .= "\n          .badoblog-css-mod-pp-content > h2::after {\n            content: '';\n            display: block;\n            height: 2px;\n            width: 22%;\n            margin-top: 3px;\n            margin-bottom: 10px;\n            background: {$h2_icon_back};\n          }\n        ";
                break;
            // Side border
            case 'v2':
                $css .= "\n          .badoblog-css-mod-pp-content > h2 {\n            box-shadow: -10px 0 0 {$h2_icon_back};\n            padding-left: 15px;\n            margin-left: 15px;\n            border-radius: 12px;\n          }\n        ";
                break;
            // With numbering
            case 'v3':
                $h2_count = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_count_text', 'Par.' ) );
                $css .= "\n          .badoblog-css-mod-pp-content {\n            counter-reset: ch2;\n          }\n          .badoblog-css-mod-pp-content > h2 {\n            display: flex;\n            align-items: center;\n            padding: 0 15px 0 0;\n          }\n          .badoblog-css-mod-pp-content > h2:before {\n            counter-increment: ch2;\n            content: '{$h2_count}' counter(ch2);\n            color: {$h2_text_icon_color};\n            background: {$h2_icon_back};\n            padding: 20px 15px;\n            margin-right: 15px;\n            text-align: center;\n          }\n        ";
                break;
            // With icon selection
            case 'v4':
                // H2 heading icon selection (posts and pages)
                switch ( esc_attr( get_theme_mod( 'badoblog_cus_post_h2_icon_select', 'v1' ) ) ) {
                    // Right arrow
                    case 'v1':
                        $h2_icon = '\\2771';
                        break;
                    // Arrow to down
                    case 'v2':
                        $h2_icon = '\\23F7';
                        break;
                    // Arrow right and down
                    case 'v3':
                        $h2_icon = '\\25FF';
                        break;
                    // Volumetric arrow
                    case 'v4':
                        $h2_icon = '\\27AF';
                        break;
                    // Pencil
                    case 'v5':
                        $h2_icon = '\\270E';
                        break;
                    // Check mark
                    case 'v6':
                        $h2_icon = '\\2714';
                        break;
                    // Small flag
                    case 'v7':
                        $h2_icon = '\\2690';
                        break;
                    // Blocks
                    case 'v8':
                        $h2_icon = '\\268F';
                        break;
                    // Block hierarchy
                    case 'v9':
                        $h2_icon = '\\2636';
                        break;
                    // Default
                    default:
                        $h2_icon = '';
                        break;
                }
                $css .= '
          .badoblog-css-mod-pp-content > h2 {
            display: flex;
            align-items: center;
            padding: 0 15px 0 0;
          }
          .badoblog-css-mod-pp-content > h2:before {
            content: "' . $h2_icon . '";
            color: ' . $h2_text_icon_color . ';
            background: ' . $h2_icon_back . ';
            padding: 20px 15px;
            margin-right: 15px;
          }
        ';
                break;
            // With arbitrary value
            case 'v5':
                $h2_tag = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_tag', '#' ) );
                $css .= "\n          .badoblog-css-mod-pp-content > h2 {\n            display: flex;\n            align-items: center;\n            padding: 0 15px 0 0;\n          }\n          .badoblog-css-mod-pp-content > h2:before{\n            content: '{$h2_tag}';\n            color: {$h2_text_icon_color};\n            background: {$h2_icon_back};\n            padding: 20px 15px;\n            margin-right: 15px;\n            text-align: center;\n          }\n        ";
                break;
            default:
                break;
        }
    }
    //? ---------- ---------- Headings H3 - H6 (posts and pages)
    if ( $h36_post !== 'off' ) {
        //? ---------- Background color of H3 - H6 headings (posts and pages)
        $h36_b_color_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_back_color' ) );
        if ( !empty( $h36_b_color_post ) ) {
            $css .= "\n        .badoblog-css-mod-pp-content > h3,\n        .badoblog-css-mod-pp-content > h4,\n        .badoblog-css-mod-pp-content > h5,\n        .badoblog-css-mod-pp-content > h6 {\n          background: {$h36_b_color_post};\n          padding: 5px 15px;\n        }\n      ";
        }
        //? ---------- Text color of H3 - H6 headings (posts and pages)
        $h36_t_color_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_text_color' ) );
        if ( !empty( $h36_t_color_post ) ) {
            $css .= "\n        .badoblog-css-mod-pp-content > h3,\n        .badoblog-css-mod-pp-content > h4,\n        .badoblog-css-mod-pp-content > h5,\n        .badoblog-css-mod-pp-content > h6 {\n          color: {$h36_t_color_post};\n        }\n      ";
        }
        //? ---------- Font for H3 - H6 headings (posts and pages)
        $h36_post_font = get_theme_mod( 'badoblog_cus_post_h36_font', 'off' );
        if ( $h36_post_font !== 'off' ) {
            $famaly = '';
            if ( in_array( $h36_post_font, $serif ) ) {
                $famaly = 'serif';
            } elseif ( in_array( $h36_post_font, $cursive ) ) {
                $famaly = 'cursive';
            } else {
                $famaly = 'sans-serif';
            }
            $css .= '
        .badoblog-css-mod-pp-content > h3,
        .badoblog-css-mod-pp-content > h4,
        .badoblog-css-mod-pp-content > h5,
        .badoblog-css-mod-pp-content > h6 {
          font-family: "' . $h36_post_font . '", ' . $famaly . ';
        }
      ';
        }
        //? ---------- Text size of H3 headings (posts and pages)
        $h3_t_size_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_h3_size', 24 ) );
        if ( $h3_t_size_post != 24 ) {
            $css .= '
        .badoblog-css-mod-pp-content > h3 {
          font-size: ' . $h3_t_size_post . 'px;
        }
      ';
        }
        //? ---------- Text size of H4 headings (posts and pages)
        $h4_t_size_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_h4_size', 22 ) );
        if ( $h4_t_size_post != 22 ) {
            $css .= '
        .badoblog-css-mod-pp-content > h4 {
          font-size: ' . $h4_t_size_post . 'px;
        }
      ';
        }
        //? ---------- Text size of H5 headings (posts and pages)
        $h5_t_size_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_h5_size', 20 ) );
        if ( $h5_t_size_post != 20 ) {
            $css .= '
        .badoblog-css-mod-pp-content > h5 {
          font-size: ' . $h5_t_size_post . 'px;
        }
      ';
        }
        //? ---------- Text size of H6 headings (posts and pages)
        $h6_t_size_post = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_h6_size', 18 ) );
        if ( $h6_t_size_post != 18 ) {
            $css .= '
        .badoblog-css-mod-pp-content > h6 {
          font-size: ' . $h6_t_size_post . 'px;
        }
      ';
        }
        //? ---------- Row height of H3 - H6 headings (posts and pages)
        $h36_post_height = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_height', '1.5' ) );
        if ( $h36_post_height !== '1.5' ) {
            $css .= "\n        .badoblog-css-mod-pp-content > h3,\n        .badoblog-css-mod-pp-content > h4,\n        .badoblog-css-mod-pp-content > h5,\n        .badoblog-css-mod-pp-content > h6 {\n          line-height: {$h36_post_height};\n        }\n      ";
        }
        if ( $h36_post !== 'v0' ) {
            //? ---------- H3 - H6 heading icons text color (posts and pages)
            if ( empty( $h36_text_icon_color ) ) {
                $h36_text_icon_color = $color_lite;
            }
            //? ---------- H3 - H6 heading icons background color (posts and pages)
            if ( empty( $h36_icon_back ) ) {
                $h36_icon_back = $primary_color;
            }
        }
        //? ---------- H3 - H6 headings variation (posts and pages)
        switch ( $h36_post ) {
            // Light underlining
            case 'v1':
                $css .= "\n          .badoblog-css-mod-pp-content > h3::after,\n          .badoblog-css-mod-pp-content > h4::after,\n          .badoblog-css-mod-pp-content > h5::after,\n          .badoblog-css-mod-pp-content > h6::after {\n            content: '';\n            display: block;\n            height: 1px;\n            margin-top: 3px;\n            margin-bottom: 10px;\n            background: {$h36_icon_back};\n          }\n          .badoblog-css-mod-pp-content > h3::after {\n            width: 20%;\n          }\n          .badoblog-css-mod-pp-content > h4::after {\n            width: 18%;\n          }\n          .badoblog-css-mod-pp-content > h5::after {\n            width: 16%;\n          }\n          .badoblog-css-mod-pp-content > h6::after {\n            width: 14%;\n          }\n        ";
                break;
            // Side border
            case 'v2':
                $css .= "\n          .badoblog-css-mod-pp-content > h3,\n          .badoblog-css-mod-pp-content > h4,\n          .badoblog-css-mod-pp-content > h5,\n          .badoblog-css-mod-pp-content > h6 {\n            box-shadow: -10px 0 0 {$h36_icon_back};\n            padding-left: 15px;\n            margin-left: 15px;\n            border-radius: 12px;\n          }\n        ";
                break;
            // With numbering
            case 'v3':
                $h36_count = get_theme_mod( 'badoblog_cus_post_h36_count_text', 'Par.' );
                if ( $h2_post == 'v3' ) {
                    $counter_h2 = "counter(ch2) '.' ";
                } else {
                    $counter_h2 = '';
                }
                $css .= "\n          .badoblog-css-mod-pp-content {\n            counter-reset: ch2 ch3 ch4 ch5 ch6;\n          }\n          .badoblog-css-mod-pp-content > h3 {\n            counter-reset: ch4;\n          }\n          .badoblog-css-mod-pp-content > h4 {\n            counter-reset: ch5;\n          }\n          .badoblog-css-mod-pp-content > h5 {\n            counter-reset: ch6;\n          }\n          .badoblog-css-mod-pp-content > h3,\n          .badoblog-css-mod-pp-content > h4,\n          .badoblog-css-mod-pp-content > h5,\n          .badoblog-css-mod-pp-content > h6 {\n            display: flex;\n            align-items: center;\n            padding: 0 15px 0 0;\n          }\n          .badoblog-css-mod-pp-content > h3:before,\n          .badoblog-css-mod-pp-content > h4:before,\n          .badoblog-css-mod-pp-content > h5:before,\n          .badoblog-css-mod-pp-content > h6:before {\n            color: {$h36_text_icon_color};\n            background: {$h36_icon_back};\n            padding: 18px 12px;\n            margin-right: 15px;\n            text-align: center;\n          }\n          .badoblog-css-mod-pp-content > h3:before {\n            counter-increment: ch3;\n            content: '{$h36_count}' {$counter_h2} counter(ch3) ;\n          }\n          .badoblog-css-mod-pp-content > h4:before {\n            counter-increment: ch4;\n            content: '{$h36_count}' {$counter_h2} counter(ch3) '.' counter(ch4) ;\n          }\n          .badoblog-css-mod-pp-content > h5:before {\n            counter-increment: ch5;\n            content: '{$h36_count}' {$counter_h2} counter(ch3) '.' counter(ch4) '.' counter(ch5) ;\n          }\n          .badoblog-css-mod-pp-content > h6:before {\n            counter-increment: ch6;\n            content: '{$h36_count}' {$counter_h2} counter(ch3) '.' counter(ch4) '.' counter(ch5) '.' counter(ch6) ;\n          }\n        ";
                break;
            // With icon selection
            case 'v4':
                // H3 - H6 heading icon selection (posts and pages)
                switch ( get_theme_mod( 'badoblog_cus_post_h36_icon_select', 'v1' ) ) {
                    // Right arrow
                    case 'v1':
                        $h36_icon = '\\2771';
                        break;
                    // Arrow to down
                    case 'v2':
                        $h36_icon = '\\23F7';
                        break;
                    // Arrow right and down
                    case 'v3':
                        $h36_icon = '\\25FF';
                        break;
                    // Volumetric arrow
                    case 'v4':
                        $h36_icon = '\\27AF';
                        break;
                    // Pencil
                    case 'v5':
                        $h36_icon = '\\270E';
                        break;
                    // Check mark
                    case 'v6':
                        $h36_icon = '\\2714';
                        break;
                    // Small flag
                    case 'v7':
                        $h36_icon = '\\2690';
                        break;
                    // Blocks
                    case 'v8':
                        $h36_icon = '\\268F';
                        break;
                    // Block hierarchy
                    case 'v9':
                        $h36_icon = '\\2636';
                        break;
                    // Default
                    default:
                        $h36_icon = '';
                        break;
                }
                $css .= '
          .badoblog-css-mod-pp-content > h3,
          .badoblog-css-mod-pp-content > h4,
          .badoblog-css-mod-pp-content > h5,
          .badoblog-css-mod-pp-content > h6 {
            display: flex;
            align-items: center;
            padding: 0 15px 0 0;
          }
          .badoblog-css-mod-pp-content > h3:before,
          .badoblog-css-mod-pp-content > h4:before,
          .badoblog-css-mod-pp-content > h5:before,
          .badoblog-css-mod-pp-content > h6:before {
            content: "' . $h36_icon . '";
            color: ' . $h36_text_icon_color . ';
            background: ' . $h36_icon_back . ';
            padding: 18px 12px;
            margin-right: 15px;
          }
        ';
                break;
            // With arbitrary value
            case 'v5':
                $h36_tag = get_theme_mod( 'badoblog_cus_post_h36_tag', '#' );
                $css .= "\n          .badoblog-css-mod-pp-content > h3,\n          .badoblog-css-mod-pp-content > h4,\n          .badoblog-css-mod-pp-content > h5,\n          .badoblog-css-mod-pp-content > h6 {\n            display: flex;\n            align-items: center;\n            padding: 0 15px 0 0;\n          }\n          .badoblog-css-mod-pp-content > h3:before,\n          .badoblog-css-mod-pp-content > h4:before,\n          .badoblog-css-mod-pp-content > h5:before,\n          .badoblog-css-mod-pp-content > h6:before {\n            content: '{$h36_tag}';\n            color: {$h36_text_icon_color};\n            background: {$h36_icon_back};\n            padding: 18px 12px;\n            margin-right: 15px;\n            text-align: center;\n          }\n        ";
                break;
            default:
                break;
        }
    }
    //? ---------- ---------- Text (posts and pages)
    //? ---------- Text font
    $text_post_font = get_theme_mod( 'badoblog_cus_post_text_font', 'off' );
    if ( $text_post_font !== 'off' ) {
        $famaly = '';
        if ( in_array( $text_post_font, $serif ) ) {
            $famaly = 'serif';
        } elseif ( in_array( $text_post_font, $cursive ) ) {
            $famaly = 'cursive';
        } else {
            $famaly = 'sans-serif';
        }
        $css .= '
      .badoblog-css-mod-pp-content {
        font-family: "' . $text_post_font . '", ' . $famaly . ';
      }
    ';
    }
    //? ---------- Text size (posts and pages)
    $text_post_size = esc_attr( get_theme_mod( 'badoblog_cus_post_text_size', 18 ) );
    if ( $text_post_size != 18 ) {
        $css .= '
      .badoblog-css-mod-pp-content {
        font-size: ' . $text_post_size . 'px;
      }
    ';
    }
    //? ---------- Text line height (posts and pages)
    $text_post_height = esc_attr( get_theme_mod( 'badoblog_cus_post_text_height', '1.5' ) );
    if ( $text_post_height !== '1.5' ) {
        $css .= "\n      .badoblog-css-mod-pp-content {\n        line-height: {$text_post_height};\n      }\n    ";
    }
    //? ---------- Remove link underline
    $link_underline = get_theme_mod( 'badoblog_cus_post_link_underline', 0 );
    if ( $link_underline == 1 ) {
        $css .= '
      .badoblog-css-post-content a,
      .badoblog-css-page-content a,
      .badoblog-css-mod-pp-content a,
      .comment-content a {
        text-decoration: none;
      }
    ';
    }
    //? ---------- ---------- Author block
    if ( $bio_post_border != 'v1' ) {
        // Common
        $css .= '
      .badoblog-css-bio-post-box {
        box-shadow: none;
      }
    ';
        //? ----------  Author block separator variation
        switch ( $bio_post_border ) {
            // Deepening
            case 'v2':
                $css .= '
          .badoblog-css-bio-post-box {
            box-shadow: inset 0 0 0.7em rgba(0,0,0,0.2);
          }
        ';
                break;
            // Dividers in width
            case 'v3':
                $css .= '
          .badoblog-css-bio-post-box {
            border-radius: 0;
            border-width: ' . $bio_post_size . 'px 0;
            border-style: ' . $bio_post_line . ';
            border-color: ' . $primary_color . ';
          }
        ';
                break;
            // Dividers in center
            case 'v4':
                $css .= '
          .badoblog-css-border-center-top,
          .badoblog-css-border-center-bottom {
            border-top: ' . $bio_post_size . 'px ' . $bio_post_line . ' ' . $primary_color . ';
            width: 35%;
            margin: auto;
          }
          .badoblog-css-border-center-top {
            margin-top: 25px;
            margin-bottom: -25px;
          }
          .badoblog-css-border-center-bottom {
            margin-top: -25px;
            margin-bottom: 25px;
          }
        ';
                break;
            // In frame
            case 'v5':
                $css .= '
          .badoblog-css-bio-post-box {
            border: ' . $bio_post_size . 'px ' . $bio_post_line . ' ' . $primary_color . ';
          }
        ';
                break;
            // Soaring
            default:
                break;
        }
    }
    //? ---------- ---------- Section (next entry)
    if ( get_theme_mod( 'badoblog_cus_post_next', 0 ) == 0 ) {
        //? ---------- Background color
        $next_back_color = get_theme_mod( 'badoblog_cus_post_next_back_color' );
        if ( !empty( $next_back_color ) ) {
            $css .= "\n        .badoblog-css-np-post {\n          background: {$next_back_color};\n        }\n      ";
        }
        //? ---------- Text color
        $next_text_color = get_theme_mod( 'badoblog_cus_post_next_text_color' );
        if ( !empty( $next_text_color ) ) {
            $css .= "\n        .badoblog-css-np-post {\n          color: {$next_text_color};\n        }\n      ";
        }
        //? ---------- Remove label
        $next_label = get_theme_mod( 'badoblog_cus_post_next_label', 0 );
        if ( $next_label == 1 ) {
            $css .= "\n        .badoblog-css-next-post-label,\n        .badoblog-css-previous-post-label {\n          display: none;\n        }\n        .badoblog-css-next-post-box,\n        .badoblog-css-previous-post-box,\n        .badoblog-css-np-post-img {\n          margin-top: 0;\n          padding-top: 0;\n        }\n      ";
        }
    }
    //? ---------- ---------- Related posts
    if ( esc_attr( get_theme_mod( 'badoblog_cus_post_related', 1 ) ) == 1 ) {
        //? ---------- Number of columns for related posts
        $related_win = get_theme_mod( 'badoblog_cus_post_related_grid', 'r4' );
        if ( $related_win != 'r4' ) {
            switch ( $related_win ) {
                // Three columns
                case 'r3':
                    $css .= '
            .badoblog-css-related-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 300px));
              grid-column-gap: 29.7px;
            }
            .badoblog-css-no-sidebar-full .badoblog-css-related-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 448px));
              grid-column-gap: 38px;
            }
            h2.badoblog-css-related-post-title,
            .badoblog-css-related-post-title a {
              font-size: 18px;
            }
            @media (max-width: 1580px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 256px));
              }
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 384px));
              }
            }
            @media (max-width: 1360px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 360px));
              }
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 320px));
              }
            }
            @media (max-width: 1236px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 300px));
              }
            }
            @media (max-width: 1150px) {
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 300px));
              }
            }
            @media (max-width: 1088px) {
              .badoblog-css-related-box,
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 256px));
              }
            }
            @media (max-width: 915px) {
              .badoblog-css-related-box,
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 350px));
              }
            }
            @media (max-width: 818px) {
              .badoblog-css-related-box,
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 300px));
              }
            }
            @media (max-width: 718px) {
              .badoblog-css-related-box,
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 256px));
              }
            }
            @media (max-width: 600px) {
              .badoblog-css-related-box,
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 560px));
              }
            }
            @media (max-width: 350px) {
              h2.badoblog-css-related-post-title,
              .badoblog-css-related-post-title a {
                font-size: 16px;
              }
            }
          ';
                    break;
                // Five columns
                case 'r5':
                    $css .= '
            .badoblog-css-related-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 160px));
              grid-column-gap: 39.8px;
            }
            .badoblog-css-no-sidebar-full .badoblog-css-related-box {
              grid-template-columns: repeat(auto-fill, minmax(0, 256px));
              grid-column-gap: 35px;
            }
            h2.badoblog-css-related-post-title,
            .badoblog-css-related-post-title a {
              font-size: 14px;
            }
            @media (max-width: 1560px) {
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 220px));
              }
            }
            @media (max-width: 1522px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 256px));
              }
            }
            @media (max-width: 1360px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 160px));
              }
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 248px));
              }
            }
            @media (max-width: 1210px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 195px));
              }
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 220px));
              }
            }
            @media (max-width: 1100px) {
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 256px));
              }
            }
            @media (max-width: 1000px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 240px));
              }
            }
            @media (max-width: 915px) {
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 220px));
              }
            }
            @media (max-width: 868px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 200px));
              }
            }
            @media (max-width: 808px) {
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 300px));
              }
            }
            @media (max-width: 748px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 180px));
              }
            }
            @media (max-width: 718px) {
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 256px));
              }
            }
            @media (max-width: 648px) {
              .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 160px));
              }
            }
            @media (max-width: 600px) {
              .badoblog-css-related-box,
              .badoblog-css-no-sidebar-full .badoblog-css-related-box {
                grid-template-columns: repeat(auto-fill, minmax(0, 560px));
              }
              h2.badoblog-css-related-post-title,
              .badoblog-css-related-post-title a {
                font-size: 20px;
              }
            }
            @media (max-width: 350px) {
              h2.badoblog-css-related-post-title,
              .badoblog-css-related-post-title a {
                font-size: 16px;
              }
            }
          ';
                    break;
                // Default
                default:
                    break;
            }
        }
        //? ---------- Design for related posts
        switch ( esc_attr( get_theme_mod( 'badoblog_cus_post_related_design', 'v0' ) ) ) {
            // Frames
            case 'v1':
                $css .= "\n          .badoblog-css-related-post-box {\n            outline: 1px solid {$primary_color};\n          }\n          .badoblog-css-related-thumbnail {\n            margin: 10px 10px 0 10px;\n          }\n        ";
                break;
            // Contrast blocks
            case 'v2':
                $css .= "\n          .badoblog-css-related-post-header {\n            background: {$primary_big_color};\n          }\n          .badoblog-css-related-post-title a {\n            color: {$primary_big_lite_color};\n          }\n          .badoblog-css-related-thumbnail {\n            border-radius: 20px 20px 0 0;\n          }\n          .badoblog-css-related-post-header {\n            border-radius: 0 0 20px 20px;\n          }\n          .badoblog-css-related-no-img {\n            border-radius: 20px;\n          }\n        ";
                break;
            // Soaring blocks
            case 'v3':
                $css .= '
          .badoblog-css-related-post-box {
            box-shadow: 0.1em 0.1em 0.5em rgba(0,0,0,0.3);
          }
        ';
                break;
            // Polaroid
            case 'v4':
                $css .= '
          .badoblog-css-related-post-box {
            padding: 15px 15px 0;
            box-shadow: 0.4em 0.4em 1em rgba(0,0,0,0.3);
            text-align: center;
          }
          .badoblog-css-related-post-box {
            border-radius: 20px;
          }
          .badoblog-css-related-thumbnail {
            border-radius: 15px;
          }
          .badoblog-css-related-post-header {
            padding: 15px 0;
          }
          .badoblog-css-related-no-img {
            padding-top: 0;
          }
        ';
                break;
            default:
                break;
        }
    }
    //----------------------------------------------------------------------------------
    //region Ticker
    //----------------------------------------------------------------------------------
    $ticker_true = get_theme_mod( 'badoblog_cus_ticker', 'date' );
    if ( $ticker_true == 'ticker' ) {
        //?---------- Speed ticker
        $ticker_speed = get_theme_mod( 'badoblog_cus_ticker_speed', 15 );
        if ( $ticker_speed != 15 ) {
            $css .= '
        .badoblog-css-ticker {
          animation-duration: ' . $ticker_speed . 's;
        }
      ';
        }
        //?---------- Ticker adaptation in Top panel width proportion
        $ticker_post = 500;
        $ticker_clear = 360;
        if ( $top_width != '70' ) {
            switch ( $top_width ) {
                case '30':
                    $ticker_post = 900;
                    $ticker_clear = 800;
                    break;
                case '50':
                    $ticker_post = 700;
                    $ticker_clear = 560;
                    break;
                default:
                    $ticker_post = 1250;
                    $ticker_clear = 1180;
                    break;
            }
        }
        $ticker_infinite = get_theme_mod( 'badoblog_cus_ticker_infinite', 0 );
        if ( $ticker_infinite == 1 ) {
            //?---------- Ticker infinite
            $css .= '
        .badoblog-css-ticker-clear {
          width: ' . $ticker_clear . 'px;
        }
        .badoblog-css-ticker {
          width: auto;
          animation-iteration-count: infinite;
        }
        @keyframes badoblog-ticker {
          from {
            transform: translateX(0);
          }
          to {
            transform: translateX(-100%);
          }
        }
      ';
        } else {
            //?---------- Number of posts available and not infinite
            $ticker_num = get_theme_mod( 'badoblog_cus_ticker_cat_number', 1 );
            if ( $ticker_num > 1 ) {
                $css .= '
          .badoblog-css-ticker {
            width: auto;
          }
          .badoblog-css-ticker-clear {
            width: ' . $ticker_clear . 'px;
          }
          .badoblog-css-ticker-post {
            width: ' . $ticker_post . 'px;
            overflow: hidden;
          }
          @keyframes badoblog-ticker {
            from {
              transform: translateX(0);
            }
            to {
              transform: translateX(calc(-100% + ' . $ticker_post . 'px));
            }
          }
        ';
            }
        }
    } else {
        if ( $ticker_true == 'off' ) {
            // Expansion of neighboring blocks when the ticker is turned off
            $css .= '
      .badoblog-css-top-menu {
        width: 100%;
      }
    ';
        }
    }
    //?---------- Ticker and Date color
    if ( !empty( $ticker_color ) ) {
        $css .= '
      .badoblog-css-ticker-post a,
      .badoblog-css-top-date {
        color: ' . $ticker_color . ';
      }
    ';
    }
    //? ---------- Ticker and Date text size
    $ticker_size = esc_attr( get_theme_mod( 'badoblog_cus_ticker_size', 14 ) );
    if ( $ticker_size != 14 ) {
        $css .= '
      .badoblog-css-ticker-post a,
      .badoblog-css-top-date {
        font-size: ' . $ticker_size . 'px;
      }
    ';
    }
    //? ---------- Ticker and Date Uppercase text
    $ticker_up = esc_attr( get_theme_mod( 'badoblog_cus_ticker_up', 0 ) );
    if ( $ticker_up == 1 ) {
        $css .= '
      .badoblog-css-ticker-post a,
      .badoblog-css-top-date {
        text-transform: uppercase;
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Top Search
    //----------------------------------------------------------------------------------
    //? ---------- Fixing a bug with the admin bar (When opening a search)
    $search_top = get_theme_mod( 'badoblog_cus_search', 'top-bar' );
    if ( $search_top != 'off' ) {
        $css .= '
      @media screen and (max-width: 600px) {
        #wpadminbar {
          position: fixed;
        }
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Top Menu
    //----------------------------------------------------------------------------------
    //? ---------- Checking cart display
    $top_cart = 0;
    if ( class_exists( 'woocommerce' ) ) {
        if ( get_theme_mod( 'badoblog_cus_woo_top_cart', 1 ) == 1 ) {
            $cart_total = ( is_object( WC()->cart ) ? WC()->cart->get_cart_contents_total() : 0 );
            if ( $cart_total > 0 ) {
                $top_cart = 1;
            }
        }
    }
    //? ---------- Checking Top menu item display
    $top_menu_item = 0;
    if ( get_theme_mod( 'badoblog_cus_top_menu', 0 ) != 1 ) {
        $top_menu_item = 1;
        $menu_loc = 'badoblog-loc-menu-top';
        $nav_loc = get_nav_menu_locations();
        $item_loc = ( array_key_exists( $menu_loc, $nav_loc ) ? $nav_loc[$menu_loc] : null );
        if ( !wp_get_nav_menu_items( $item_loc ) && has_nav_menu( $menu_loc ) ) {
            $top_menu_item = 0;
        }
    }
    //? ---------- Expansion of neighboring blocks when the top menu is turned off
    if ( $top_menu_item == 0 && $top_cart == 0 && $search_top != 'top-bar' ) {
        $css .= '
      .badoblog-css-top-left {
        width: 100%;
      }
    ';
    }
    //? ---------- Proportion of width occupied by top menu
    if ( $ticker_true != 'off' && ($top_menu_item == 1 || $top_cart == 1 || $search_top == 'top-bar') ) {
        if ( $top_width != '70' ) {
            switch ( $top_width ) {
                case '30':
                    $top_w_1 = '70';
                    $top_w_2 = '30';
                    break;
                case '50':
                    $top_w_1 = '50';
                    $top_w_2 = '50';
                    break;
                default:
                    $top_w_1 = '100';
                    $top_w_2 = '100';
                    $css .= "\n            .badoblog-css-top-bar {\n              flex-direction: column;\n            }\n            @media (max-width: 700px) {\n              .badoblog-css-top-menu {\n                margin-bottom: 10px;\n              }\n            }\n            @media (max-width: 400px) {\n              .badoblog-css-top-menu {\n                margin-top: 10px;\n              }\n            }\n            .badoblog-css-top-left {\n              margin-top: 10px;\n            }\n          ";
                    break;
            }
            $css .= "\n        .badoblog-css-top-left {\n          width: " . $top_w_1 . "%;\n        }\n        .badoblog-css-top-menu {\n          width: " . $top_w_2 . "%;\n        }\n      ";
        }
        // ---------- Adaptation of date on small screen
        $css .= '
      @media (max-width: 700px) {
        .badoblog-css-top-bar {
          flex-direction: row;
        }
        .badoblog-css-top-left,
        .badoblog-css-top-menu {
          width: 50%;
          margin: 0;
        }
      }
      @media (max-width: 400px) {
        .badoblog-css-top-menu {
          width: 100%;
        }
      }
    ';
        // ---------- Adaptation of cart on small screen
        if ( $top_cart == 1 ) {
            $css .= '
        @media (max-width: 700px) {
          .badoblog-css-top-left {
            padding-right: 40px;
          }
        }
      ';
        }
    }
    //? ---------- Top menu text size
    $topmenu_size = esc_attr( get_theme_mod( 'badoblog_cus_top_menu_size', 14 ) );
    if ( $topmenu_size != 14 ) {
        $css .= '
      .badoblog-css-top-jsmenu-pc a,
      .badoblog-css-top-menu-pc a {
        font-size: ' . $topmenu_size . 'px;
      }
    ';
    }
    //? ---------- Top menu text size (mobile)
    $topmenu_m_size = esc_attr( get_theme_mod( 'badoblog_cus_top_menu_mobile_a_size', 16 ) );
    if ( $topmenu_m_size != 16 ) {
        $css .= '
      .badoblog-css-top-jsmenu-mobile a,
      .badoblog-css-nav-top-mobile a {
        font-size: ' . $topmenu_m_size . 'px;
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Main Menu
    //----------------------------------------------------------------------------------
    //? ---------- ---------- Main menu item orientation
    $main_menu_lay = get_theme_mod( 'badoblog_cus_main_menu_layout', 'center' );
    if ( $main_menu_lay !== 'center' ) {
        switch ( $main_menu_lay ) {
            // Left
            case 'left':
                $css .= '
          .badoblog-css-mega-menu > ul {
            justify-content: normal;
          }
        ';
                break;
            // Right
            case 'right':
                $css .= "\n          .badoblog-css-mega-menu > ul {\n            justify-content: flex-end;\n          }\n        ";
                break;
            // Distributed
            case 'dist':
                $css .= '
          .badoblog-css-mega-menu > ul {
            justify-content: space-around;
          }
        ';
                break;
            default:
                break;
        }
    }
    //? ---------- Size of main menu items
    $menu_height = esc_attr( get_theme_mod( 'badoblog_cus_main_menu_height', 'mid' ) );
    if ( $menu_height != 'mid' ) {
        switch ( $menu_height ) {
            case 'small':
                $css .= '
          .badoblog-css-mega-menu > ul > li > a {
            padding: 3px 6px 2px 6px;
          }
        ';
                break;
            case 'big':
                $css .= '
          .badoblog-css-mega-menu > ul > li > a {
            padding: 12px 22px;
          }
        ';
                break;
            default:
                break;
        }
    }
    //? ---------- Main menu item font
    $font_menu = get_theme_mod( 'badoblog_cus_main_menu_font', 'off' );
    if ( $font_menu !== 'off' ) {
        $famaly = '';
        if ( in_array( $font_menu, $serif ) ) {
            $famaly = 'serif';
        } elseif ( in_array( $font_menu, $cursive ) ) {
            $famaly = 'cursive';
        } else {
            $famaly = 'sans-serif';
        }
        $css .= '
      .badoblog-css-mega-menu > ul > li > a {
        font-family: "' . $font_menu . '", ' . $famaly . ';
      }
    ';
    }
    //? ---------- Main menu items text size
    $menu_size = esc_attr( get_theme_mod( 'badoblog_cus_main_menu_size', 15 ) );
    if ( $menu_size != 15 ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li > a {
        font-size: ' . $menu_size . 'px;
      }
    ';
    }
    //? ---------- Main menu items titles in uppercase
    $menu_text_up = esc_attr( get_theme_mod( 'badoblog_cus_main_menu_text_up', 1 ) );
    if ( $menu_text_up != 1 ) {
        $css .= "\n      .badoblog-css-mega-menu > ul > li > a {\n        text-transform: none;\n      }\n    ";
    }
    //? ---------- Main menu (drop-down menu) items text size
    $menu_sub_size = esc_attr( get_theme_mod( 'badoblog_cus_main_menu_sub_size', 14 ) );
    if ( $menu_sub_size != 14 ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li > ul.normal-sub > li a {
        font-size: ' . $menu_sub_size . 'px;
      }
    ';
    }
    //? ---------- Main menu (mega menu) items text size
    $menu_mega_size = esc_attr( get_theme_mod( 'badoblog_cus_main_menu_mega_size', 14 ) );
    if ( $menu_mega_size != 14 ) {
        $css .= '
      .badoblog-css-mega-menu > ul > li > ul > li a {
        font-size: ' . $menu_mega_size . 'px;
      }
    ';
    }
    //? ---------- Main menu background in full screen width
    if ( esc_attr( get_theme_mod( 'badoblog_cus_main_menu_full_width', 0 ) ) == 1 && $max_width_site != 'full' ) {
        $css .= "\n      @media (min-width: 1400px) {\n        .badoblog-css-mega-menu-box {\n          width: calc(100vw - 16px);\n          margin-left: calc(-50vw + 50% + 8px);\n          box-shadow: 0.1em 0.1em 1em rgba(0, 0, 0, 0.5);\n        }\n        .badoblog-css-mega-menu-box,\n        .badoblog-css-mega-menu-container,\n        .badoblog-css-full-max-width .badoblog-css-mega-menu-container {\n          border-radius: 5px;\n        }\n      }\n      .badoblog-css-mega-menu-container,\n      .badoblog-css-full-max-width .badoblog-css-mega-menu-container {\n        width: 100%;\n        max-width: 100%;\n      }\n      .badoblog-css-site-brand-top {\n        margin-top: 0;\n      }\n    ";
    }
    //? ---------- ---------- Number of columns in mega menu
    $mega_column = get_theme_mod( 'badoblog_cus_main_menu_mega_column', 4 );
    // Common styles
    if ( $mega_column != 4 ) {
        $mega_w = 25;
        switch ( $mega_column ) {
            // One
            case '1':
                $mega_w = 100;
                break;
            // Two
            case '2':
                $mega_w = 50;
                break;
            // Three
            case '3':
                $mega_w = 33.33;
                break;
            // Five
            case '5':
                $mega_w = 20;
                break;
            // Six
            case '6':
                $mega_w = 16.66;
                break;
            default:
                break;
        }
        $css .= '
      .badoblog-css-mega-menu > ul > li > ul > li {
        width: ' . $mega_w . '%;
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Category menu
    //----------------------------------------------------------------------------------
    if ( get_theme_mod( 'badoblog_cus_menucat', 0 ) == 1 ) {
        // Items size
        $menucat_size = get_theme_mod( 'badoblog_cus_menucat_size', 3 );
        if ( $menucat_size != 3 ) {
            switch ( $menucat_size ) {
                case 1:
                    $item_max_w = 177;
                    $item_min_hi = 100;
                    $media_max_w = 425;
                    break;
                case 2:
                    $item_max_w = 211;
                    $item_min_hi = 119;
                    $media_max_w = 510;
                    break;
                case 4:
                    $item_max_w = 332;
                    $item_min_hi = 187;
                    $media_max_w = 785;
                    break;
                case 5:
                    $item_max_w = 453;
                    $item_min_hi = 255;
                    $media_max_w = 1070;
                    break;
                default:
                    $item_max_w = 260;
                    $item_min_hi = 146;
                    $media_max_w = 610;
                    break;
            }
            if ( get_theme_mod( 'badoblog_cus_menucat_center', 0 ) == 1 ) {
                $css .= '
          .badoblog-css-menucat-box {
            display: flex;
            flex-wrap: wrap;
          }
          .badoblog-css-menucat-item {
            width: ' . $item_max_w . 'px;
          }
          .badoblog-css-menucat a {
            min-height: ' . $item_min_hi . 'px;
          }
          @media (max-width: ' . $media_max_w . 'px) {
            .badoblog-css-menucat-item {
              width: 100%;
            }
          }
        ';
            } else {
                $css .= '
        .badoblog-css-menucat-box {
          grid-template-columns: repeat(auto-fill, minmax(0, ' . $item_max_w . 'px));
        }
        .badoblog-css-menucat a {
          min-height: ' . $item_min_hi . 'px;
        }
        @media (max-width: ' . $media_max_w . 'px) {
          .badoblog-css-menucat-box {
            grid-template-columns: repeat(auto-fill, minmax(0, ' . $media_max_w . 'px));
          }
        }
      ';
            }
        }
        // Text size
        $menucat_h_size = get_theme_mod( 'badoblog_cus_menucat_h_size', 20 );
        if ( $menucat_h_size != 20 ) {
            $css .= '
        .badoblog-css-menucat a {
          font-size: ' . $menucat_h_size . 'px;
        }
      ';
        }
        // Titles in uppercase
        if ( get_theme_mod( 'badoblog_cus_menucat_text_up', 0 ) == 1 ) {
            $css .= "\n        .badoblog-css-menucat {\n          text-transform: uppercase;\n        }\n      ";
        }
        // CSS via ID
        if ( !function_exists( 'badoblog_fun_menucat_style' ) ) {
            // function_exists is required for jetpack (Infinite Scroll) compatibility
            function badoblog_fun_menucat_style(
                $color_h,
                $color_h_back,
                $color_back,
                $id_block
            ) {
                $css_menucat = '';
                $castom_css = 'badoblog-css-menucat-item-' . $id_block;
                // Text color
                if ( $color_h !== '#ffffff' ) {
                    $css_menucat .= "\n            .{$castom_css} a,\n            .{$castom_css} a:hover {\n              color: {$color_h};\n            }\n          ";
                }
                // Text background color
                if ( $color_h_back !== '#f6f7f7' ) {
                    $menucat_h_size = get_theme_mod( 'badoblog_cus_menucat_h_size', 20 );
                    if ( $menucat_h_size != 0 ) {
                        $css_menucat .= "\n              .{$castom_css} .badoblog-css-menucat-title {\n                background: {$color_h_back};\n                padding: 10px 25px;\n                border-radius: 50px;\n              }\n              .{$castom_css} .badoblog-css-menucat-title:hover {\n                box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);\n              }\n              .{$castom_css} a:hover {\n                box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.2);\n              }\n            ";
                    }
                }
                // Background color
                if ( $color_back !== '#4c65ad' ) {
                    $css_menucat .= "\n            .{$castom_css} a {\n              background: {$color_back};\n            }\n          ";
                }
                //? ---------- Attaching a style and script file
                if ( !empty( $css_menucat ) ) {
                    wp_add_inline_style( 'badoblog-style-custom', $css_menucat );
                }
            }

            //? ---------- Traversing and inferring a function
            $set_menucat = json_decode( get_theme_mod( 'badoblog_cus_menucat_items' ) );
            if ( $set_menucat ) {
                foreach ( $set_menucat as $menucat ) {
                    badoblog_fun_menucat_style(
                        $menucat->color_h,
                        $menucat->color_h_back,
                        $menucat->color_back,
                        $menucat->id_block
                    );
                }
            }
        }
    }
    //----------------------------------------------------------------------------------
    //region Breadcrumbs
    //----------------------------------------------------------------------------------
    if ( get_theme_mod( 'badoblog_cus_bread_activ_post', 1 ) == 1 || get_theme_mod( 'badoblog_cus_bread_activ_cat', 1 ) == 1 ) {
        //? ---------- Breadcrumbs background color
        $bread_back = '#505062';
        if ( !empty( $primary_big_color ) ) {
            $bread_back = $primary_big_color;
        }
        if ( !empty( $bread_back_color ) ) {
            $bread_back = $bread_back_color;
        }
        // Gradient
        $css .= "\n      .badoblog-css-breadcrumbs {\n        background: linear-gradient(90deg, #000 -200%, {$bread_back} 85%,rgba(0,0,0, 0) 200%);\n      }\n    ";
        //? ---------- Variation Breadcrumbs
        $bread_design = get_theme_mod( 'badoblog_cus_bread_design', 'gradient' );
        if ( $bread_design != 'gradient' ) {
            switch ( $bread_design ) {
                // Simple
                case 'simple':
                    $css .= "\n            .badoblog-css-breadcrumbs {\n              background: none;\n            }\n          ";
                    break;
                // Background
                case 'background':
                    $css .= "\n            .badoblog-css-breadcrumbs {\n              background: {$bread_back};\n            }\n          ";
                    break;
                // Border
                case 'border':
                    $css .= "\n            .badoblog-css-breadcrumbs {\n              background: none;\n              border: 1px solid {$bread_back};\n            }\n          ";
                    break;
                default:
                    break;
            }
        }
        //? ---------- Breadcrumb links text color
        if ( !empty( $bread_a_color ) ) {
            $css .= '
        .badoblog-css-breadcrumbs a {
          color: ' . $bread_a_color . ';
        }
      ';
        }
        //? ---------- Breadcrumb links text color (on hover)
        if ( !empty( $bread_a_hover_color ) ) {
            $css .= '
        .badoblog-css-breadcrumbs a:hover {
          color: ' . $bread_a_hover_color . ';
        }
      ';
        }
        //? ---------- Breadcrumbs header text color
        if ( !empty( $bread_h_color ) ) {
            $css .= '
        .badoblog-css-breadcrumbs {
          color: ' . $bread_h_color . ';
        }
      ';
        }
        //? ---------- Breadcrumbs text size
        // Breadcrumbs text size
        $bread_size_text = esc_attr( get_theme_mod( 'badoblog_cus_bread_size_text', 18 ) );
        if ( $bread_size_text != 18 ) {
            $css .= '
        .badoblog-css-breadcrumbs, .badoblog-css-breadcrumbs a {
          font-size: ' . $bread_size_text . 'px;
        }
      ';
        }
    }
    //----------------------------------------------------------------------------------
    //region Calm Blocks
    //----------------------------------------------------------------------------------
    //? ---------- Calm blocks (fluently movement of blocks)
    if ( get_theme_mod( 'badoblog_cus_flow_block', 0 ) == 1 ) {
        $flow_range_set = get_theme_mod( 'badoblog_cus_flow_block_range', 'mid' );
        $way_set = get_theme_mod( 'badoblog_cus_flow_block_way', 'bottom' );
        $flow_range = 125;
        if ( $flow_range_set == 'small' ) {
            $flow_range = 50;
        } else {
            if ( $flow_range_set == 'big' ) {
                $flow_range = 300;
            }
        }
        $way_range = '';
        if ( $way_set == 'top' || $way_set == 'left' ) {
            $way_range = '-';
        }
        $way_xy = 'Y';
        if ( $way_set == 'left' || $way_set == 'right' ) {
            $way_xy = 'X';
        }
        $css .= '
      .badoblog-css-cat-grid,
      .badoblog-css-home-narrow-grid-column,
      .badoblog-css-home-vertical-grid-post-first,
      .badoblog-css-home-vertical-grid-post-small,
      [class^="badoblog-css-home-three-grid-main-"],
      [class^="badoblog-css-home-five-grid-main-"],
      [class^="badoblog-css-home-slide-big-main-"],
      [class^="badoblog-css-home-slide-mid-partial-main-"],
      [class^="badoblog-css-home-slide-mid-two-main-"],
      [class^="badoblog-css-home-slide-mid-three-main-"] {
        transition: all 1s;
        opacity: 0;
        transform: translate' . $way_xy . '(' . $way_range . $flow_range . 'px);
      }
      .badoblog-css-cat-grid.badoblog-css-show-block,
      .badoblog-css-home-narrow-grid-column.badoblog-css-show-block,
      .badoblog-css-home-vertical-grid-post-first.badoblog-css-show-block,
      .badoblog-css-home-vertical-grid-post-small.badoblog-css-show-block,
      [class^="badoblog-css-home-three-grid-main-"].badoblog-css-show-block,
      [class^="badoblog-css-home-five-grid-main-"].badoblog-css-show-block,
      [class^="badoblog-css-home-slide-big-main-"].badoblog-css-show-block,
      [class^="badoblog-css-home-slide-mid-partial-main-"].badoblog-css-show-block,
      [class^="badoblog-css-home-slide-mid-two-main-"].badoblog-css-show-block,
      [class^="badoblog-css-home-slide-mid-three-main-"].badoblog-css-show-block,
      .infinite-scroll .badoblog-css-cat-grid {
        opacity: 1;
        transform: translate' . $way_xy . '(0);
      }
      .badoblog-css-menucat-box,
      .badoblog-css-owl-width-slider {
        transition: all 2s;
        opacity: 0;
      }
      .badoblog-css-menucat-box.badoblog-css-show-block,
      .badoblog-css-owl-width-slider.badoblog-css-show-block {
        opacity: 1;
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Up Button
    //----------------------------------------------------------------------------------
    if ( get_theme_mod( 'badoblog_cus_top_scroll', 0 ) == 0 ) {
        // Connecting a script
        wp_enqueue_script(
            'badoblog-script-scroll',
            get_template_directory_uri() . '/js/scroll.js',
            array('jquery'),
            BADOBLOG_VERSION,
            true
        );
        // Up button size
        if ( get_theme_mod( 'badoblog_cus_top_scroll_size', 'big' ) == 'small' ) {
            $css .= '
        .badoblog-css-scrollup {
          width: 50px;
          height: 50px;
        }
      ';
        }
        // Up button location
        if ( get_theme_mod( 'badoblog_cus_top_scroll_layout', 'right' ) == 'left' ) {
            $css .= '
        .badoblog-css-scrollup {
          left: 20px;
        }
      ';
        }
        // Button opacity
        $opacity_up = get_theme_mod( 'badoblog_cus_top_scroll_opacity', 4 );
        if ( $opacity_up != 4 ) {
            if ( $opacity_up == 10 ) {
                $css .= '
          .badoblog-css-scrollup {
            opacity: 1;
          }
          .badoblog-css-scrollup:hover {
            opacity: 0.8;
          }
        ';
            } else {
                $css .= "\n          .badoblog-css-scrollup {\n            opacity: 0.{$opacity_up};\n          }\n        ";
            }
        }
        // Up button shape and design
        $form_up = get_theme_mod( 'badoblog_cus_top_scroll_form', 'circle' );
        $design_up = get_theme_mod( 'badoblog_cus_top_scroll_design', 'brace' );
        if ( $form_up != 'circle' || $design_up != 'brace' ) {
            $css .= '
        .badoblog-css-scrollup {  
          background-image: url(' . get_template_directory_uri() . '/img/scroll/' . $form_up . '/' . $design_up . '.png);
        }
      ';
        }
    }
    //----------------------------------------------------------------------------------
    //region Social Links
    //----------------------------------------------------------------------------------
    //? ---------- Activate Social Links
    if ( $soc_active == 1 ) {
        // Social link design
        $soc_form = esc_attr( get_theme_mod( 'badoblog_cus_soc_form', 'circle' ) );
        // Social links fill color
        $soc_back_color = esc_attr( get_theme_mod( 'badoblog_cus_soc_back_color' ) );
        // Social link size
        $soc_size = get_theme_mod( 'badoblog_cus_soc_size', 54 );
        //? ---------- Social links fill color
        if ( !empty( $soc_back_color ) ) {
            $soc_b_color = $soc_back_color;
        } else {
            $soc_b_color = $primary_color;
        }
        if ( $soc_form == 'without-background' ) {
            $soc_color_b = $soc_b_color;
        } else {
            $soc_color_b = 'rgba(0,0,0, 0)';
        }
        $max_soc_size = $soc_size + 10;
        $soc_r1 = $soc_r2 = $soc_r3 = $soc_r4 = 0;
        switch ( $soc_form ) {
            case 'circle':
            case 'sharp-circle':
            case 'floret':
            case 'rhombus':
                $soc_r1 = $soc_r2 = $soc_r3 = $soc_r4 = 50;
                break;
            case 'rounded-square':
                $soc_r1 = $soc_r2 = $soc_r3 = $soc_r4 = 20;
                break;
            case 'without-background':
                $soc_r1 = $soc_r2 = $soc_r3 = $soc_r4 = 20;
                $css .= "\n          .badoblog-css-soc-top-box-anime {\n            border-radius: " . $soc_r1 . "%;\n            overflow: hidden;\n          }\n        ";
                break;
            case 'leaf':
                $soc_r1 = $soc_r3 = 48;
                $soc_r2 = $soc_r4 = 12;
                break;
            case 'sticker':
                $soc_r1 = $soc_r2 = $soc_r3 = 48;
                $soc_r4 = 5;
                break;
            case 'triangle':
                $soc_r1 = $soc_r3 = 70;
                $soc_r2 = 110;
                $soc_r4 = 40;
                break;
            default:
                break;
        }
        $soc_scale = 1.2;
        if ( $soc_size != 44 ) {
            if ( $soc_size == 34 ) {
                $soc_scale = 1.3;
                $soc_min_w = 110;
            } else {
                $soc_min_w = 150;
            }
            // min-width for general block
            $css .= "\n        .badoblog-css-site-brand-soc {\n          min-width: " . $soc_min_w . "px;\n        }\n      ";
        }
        // Common social link animation styles
        $css .= "\n      .badoblog-css-soc-top-box-anime img {\n        width: " . $soc_size . "px;\n        height: " . $soc_size . "px;\n      }\n    ";
        //? ---------- Animation of social links
        switch ( $soc_anime ) {
            case 'a1':
                // Link increase
                $css .= "\n          .badoblog-css-soc-top-box-anime img {\n            background: {$soc_color_b};\n          }\n          .badoblog-css-soc-top-box-anime img:hover {\n            transform: scale(1.2);\n          }\n        ";
                break;
            // Zoom background
            case 'a2':
                $css .= "\n          .badoblog-css-soc-top-box-anime {\n            width: " . $max_soc_size . "px;\n            height: " . $max_soc_size . "px;\n            background: {$soc_b_color};\n            border-radius: " . $soc_r1 . "% " . $soc_r2 . "% " . $soc_r3 . "% " . $soc_r4 . "%;\n            overflow: hidden;\n          }\n          .badoblog-css-soc-top-box-anime img:hover {\n            transform: scale({$soc_scale});\n          }\n          .badoblog-css-soc-top-box-anime:hover {\n            background: {$soc_color_b};\n          }\n        ";
                break;
            // Link reduction
            case 'a3':
                $css .= "\n          .badoblog-css-soc-top-box-anime img {\n            background: {$soc_color_b};\n          }\n          .badoblog-css-soc-top-box-anime img:hover {\n            transform: scale(0.85);\n          }\n        ";
                break;
            // Zoom out background
            case 'a4':
                $css .= "\n          .badoblog-css-soc-top-box-anime {\n            border-radius: " . $soc_r1 . "% " . $soc_r2 . "% " . $soc_r3 . "% " . $soc_r4 . "%;\n            overflow: hidden;\n            background: {$soc_color_b};\n          }\n          .badoblog-css-soc-top-box-anime:hover {\n            background: {$soc_b_color};\n          }\n          .badoblog-css-soc-top-box-anime img:hover {\n            transform: scale(0.8);\n          }\n        ";
                break;
            // Frame around the link
            case 'a5':
                $css .= "\n          .badoblog-css-soc-top-box {\n            gap: 0;\n          }\n          .badoblog-css-soc-top-box-anime img {\n            background: {$soc_color_b};\n          }\n          .badoblog-css-soc-top-box-child {\n            border: 1px solid rgba(0,0,0, 0);\n            padding: 8px;\n          }\n          .badoblog-css-soc-top-box-child:hover {\n            border: 1px solid {$primary_color};\n            border-radius: " . $soc_r1 . "% " . $soc_r2 . "% " . $soc_r3 . "% " . $soc_r4 . "%;\n          }\n        ";
                break;
            // Increasing contrast
            case 'a6':
                $css .= '
          .badoblog-css-soc-top-box-child {
            transition: 0.3s;
          }
          .badoblog-css-soc-top-box-child:hover {
            -webkit-filter: contrast(150%);
          }
          .badoblog-css-soc-top-box-anime img {
            background: ' . $soc_color_b . ';
          }
        ';
                break;
            // Hue change
            case 'a7':
                $css .= '
          .badoblog-css-soc-top-box-child:hover {
            -webkit-filter: hue-rotate(100deg);
          }
          .badoblog-css-soc-top-box-anime img {
            background: ' . $soc_color_b . ';
          }
        ';
                break;
            // Color inversion
            case 'a8':
                $css .= '
          .badoblog-css-soc-top-box-child:hover {
            -webkit-filter: invert(100%);
          }
          .badoblog-css-soc-top-box-anime img {
            background: ' . $soc_color_b . ';
          }
        ';
                break;
            // Dimming adjacent links
            case 'a9':
                $css .= "\n          .badoblog-css-soc-top-box:hover .badoblog-css-soc-top-box-anime:not(:hover) {\n            filter: grayscale(100%);\n          }\n          .badoblog-css-soc-top-box-anime img {\n            background: {$soc_color_b};\n          }\n        ";
                break;
            // Link slope
            case 'a10':
                $css .= '
          .badoblog-css-soc-top-box-anime img {
            background: ' . $soc_color_b . ';
          }
          .badoblog-css-soc-top-box-child img:hover {
            transform: rotateZ(-4deg);
          }
        ';
                break;
            default:
                break;
        }
    }
    //? ---------- Move social links in the header over the image
    if ( $move_soc_image == 1 and get_header_image() ) {
        $css .= "\n      .badoblog-css-site-brand-top-1 {\n        display: flex;\n        justify-content: center;\n        align-items: center;\n      }\n      .badoblog-css-site-brand-top-2 {\n        position: absolute;\n        /* Deactivation - display none */\n        display: inline;\n      }\n      .badoblog-css-soc-top-box {\n        justify-content: center;\n        margin: 0 40px;\n      }\n      @media (max-width: 750px) {\n        .badoblog-css-soc-top-box-anime img {\n          width: 34px;\n          height: 34px;\n        }\n      }\n      @media (max-width: 580px) {\n        .badoblog-css-soc-top-box-anime img {\n          width: 24px;\n          height: 24px;\n        }\n      }\n      @media (max-width: 450px) {\n        .badoblog-css-site-brand-top-2 {\n          position: relative;\n        }\n        .badoblog-css-site-brand-top-1 {\n          flex-direction: column;\n        }\n        .badoblog-css-soc-top-box {\n          margin: 15px 0 0;\n        }\n      }\n    ";
        // Responsive styles for social links (over the image) with animation - increase the image with the background
        if ( $soc_anime == 'a2' ) {
            $css .= "\n        @media (max-width: 750px) {\n          .badoblog-css-soc-top-box-anime {\n            width: 42px;\n            height: 42px;\n          }\n        }\n        @media (max-width: 580px) {\n          .badoblog-css-soc-top-box-anime {\n            width: 30px;\n            height: 30px;\n          }\n        }\n      ";
        }
    }
    //? ---------- Enable effect (live picture) header image
    $header_img_live = esc_attr( get_theme_mod( 'badoblog_cus_header_image_live', 0 ) );
    if ( $header_img_live == 1 ) {
        $css .= "\n      .badoblog-css-site-brand-top-img-anime {\n        overflow: hidden;\n      }\n      .badoblog-css-site-brand-top-img-anime img {\n        width: 100%;\n        transform-origin: bottom right;\n        animation: grow 199999ms ease;\n      }\n      @keyframes grow {\n        0% {\n          transform: scale(1);\n        }\n        100% {\n          transform: scale(2);\n        }\n      }\n    ";
    }
    //----------------------------------------------------------------------------------
    //region Sidebar column
    //----------------------------------------------------------------------------------
    // Widget design selection in columns
    $widget_design = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_design', 'v0' ) );
    //? ---------- Background for widgets in columns
    $w_b_color = $content_color;
    if ( !empty( $widget_back_color ) ) {
        $css .= "\n      .badoblog-css-widget-area .widget:not(.widget_block),\n      .badoblog-css-widget-area .widget_block.widget-block-box {\n        background: {$widget_back_color};\n      }\n    ";
        $w_b_color = $widget_back_color;
    }
    //? ---------- General styles when background is enabled in widgets (columns)
    $css_widget = "\n    #secondary {\n      padding: 25px;\n    }\n    .badoblog-css-widget-area .widget:not(.widget_block),\n    .badoblog-css-widget-area .widget_block.widget-block-box {\n      padding: 15px;\n    }\n    .widget .dmcwzaf-css-widget-bulk-post-1 {\n      grid-template-columns: repeat(auto-fill, minmax(0, 82px));\n    }\n    .widget .dmcwzaf-css-widget-bulk-post-2 {\n      grid-template-columns: repeat(auto-fill, minmax(0, 129px));\n    }\n  ";
    if ( !empty( $widget_back_color ) ) {
        $css .= $css_widget;
    }
    //? ---------- Widget design selection in columns
    switch ( $widget_design ) {
        // Frame
        case 'v1':
            $css .= $css_widget;
            $css .= "\n        .badoblog-css-widget-area .widget:not(.widget_block),\n        .badoblog-css-widget-area .widget_block.widget-block-box {\n          border: 1px solid {$primary_color};\n          padding: 14px;\n        }\n      ";
            break;
        // Soaring
        case 'v2':
            $css .= $css_widget;
            $css .= '
        .badoblog-css-widget-area .widget:not(.widget_block),
        .badoblog-css-widget-area .widget_block.widget-block-box {
          box-shadow: 0 0.1em 0.7em rgba(0,0,0,0.1);
        }
      ';
            break;
        // Deepening
        case 'v3':
            $css .= $css_widget;
            $css .= '
        .badoblog-css-widget-area .widget:not(.widget_block),
        .badoblog-css-widget-area .widget_block.widget-block-box {
          box-shadow: inset 0 0.1em 0.3em rgba(0,0,0,0.2);
        }
      ';
            break;
        // Side shadow
        case 'v4':
            $css .= $css_widget;
            $css .= "\n        .badoblog-css-widget-area .widget:not(.widget_block),\n        .badoblog-css-widget-area .widget_block.widget-block-box {\n          border-left: 1px solid rgba(0,0,0,0.05);\n          box-shadow: 0.7em 0.1em 0.7em rgba(0,0,0,0.1);\n          padding: 14px;\n        }\n        .badoblog-css-left-sidebar .badoblog-css-widget-area .widget:not(.widget_block),\n        .badoblog-css-left-sidebar .badoblog-css-widget-area .widget_block.widget-block-box {\n          border-left: 0;\n          border-right: 1px solid rgba(0,0,0,0.05);\n          box-shadow: -0.7em 0.1em 0.6em rgba(0,0,0,0.1);\n        }\n      ";
            break;
        // Gradient
        case 'v5':
            $css .= "\n        .badoblog-css-widget-area .widget:not(.widget_block),\n        .badoblog-css-widget-area .widget_block.widget-block-box {\n          background: repeating-linear-gradient(135deg, rgba(0,0,0,0.1) 0px, rgba(0,0,0,0.1) 0px, {$w_b_color} 0.5px, {$w_b_color} 45px);\n        }\n      ";
            break;
        default:
            break;
    }
    //----------------------------------------------------------------------------------
    //region Widget column
    //----------------------------------------------------------------------------------
    //? ---------- Widgets headers text color in columns
    $color_widget_h_text = '#fffffb';
    if ( !empty( $widget_h_text_color ) ) {
        $color_widget_h_text = $widget_h_text_color;
    } else {
        if ( $primary_big_lite_color != '#fffffb' ) {
            $color_widget_h_text = $primary_big_lite_color;
        }
    }
    $css .= "\n    .badoblog-css-widget-area .widget .widget-title,\n    .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {\n      color: {$color_widget_h_text};\n    }\n  ";
    //? ---------- Titles font of (columns) widgets
    $font_h_sidebar = get_theme_mod( 'badoblog_cus_sidebar_h_font', 'off' );
    if ( $font_h_sidebar !== 'off' ) {
        $famaly = '';
        if ( in_array( $font_h_sidebar, $serif ) ) {
            $famaly = 'serif';
        } elseif ( in_array( $font_h_sidebar, $cursive ) ) {
            $famaly = 'cursive';
        } else {
            $famaly = 'sans-serif';
        }
        $css .= '
      .badoblog-css-widget-area .widget .widget-title,
      .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
        font-family: "' . $font_h_sidebar . '", ' . $famaly . ';
      }
    ';
    }
    //? ---------- Titles text size of (columns) widgets
    $sidebar_h_text_size = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_h_size', 18 ) );
    if ( $sidebar_h_text_size != 18 ) {
        $css .= '
      .badoblog-css-widget-area .widget .widget-title,
      .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
        font-size: ' . $sidebar_h_text_size . 'px;
      }
    ';
    }
    //? ---------- Titles of (columns) widgets in uppercase
    $sidebar_h_up = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_h_up', 1 ) );
    if ( $sidebar_h_up != 1 ) {
        $css .= "\n      .badoblog-css-widget-area .widget .widget-title,\n      .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {\n        text-transform: none;\n      }\n    ";
    }
    //? ---------- Align the titles of (columns) widgets to the center
    $sidebar_h_center = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_h_center', 0 ) );
    if ( $sidebar_h_center == 1 ) {
        $css .= "\n      .badoblog-css-widget-area .widget .widget-title,\n      .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {\n        text-align: center;\n      }\n    ";
    }
    //? ---------- Underline titles of (columns) widgets
    $sidebar_h_size_border = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_h_border_size', 4 ) );
    switch ( get_theme_mod( 'badoblog_cus_sidebar_h_border', 'v4' ) ) {
        case 'v1':
            $css .= '
        .badoblog-css-widget-area .widget .widget-title::after,
        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading::after {
          content: "";
          display: block;
          height: ' . $sidebar_h_size_border . 'px;
          width: 22%;
          margin-top: 5px;
          background: ' . $primary_color . ';
        }
      ';
            break;
        // Center and bottom
        case 'v2':
            $css .= '
        .badoblog-css-widget-area .widget .widget-title::after,
        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading::after {
          content: "";
          display: block;
          height: ' . $sidebar_h_size_border . 'px;
          width: 30%;
          margin: 0 auto;
          margin-top: 5px;
          background: ' . $primary_color . ';
          text-align: center;
        }
      ';
            break;
        // Full width
        case 'v3':
            $css .= '
        .badoblog-css-widget-area .widget .widget-title,
        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
          border-bottom: ' . $sidebar_h_size_border . 'px solid ' . $primary_color . ';
        }
        .badoblog-css-widget-area .widget .widget-title,
        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
          padding: 6px 16px;
        }
      ';
            break;
        // Border left
        case 'v4':
            $css .= '
        .badoblog-css-widget-area .widget .widget-title,
        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
          border-left: ' . $sidebar_h_size_border . 'px solid ' . $primary_color . ';
        }
        .badoblog-css-widget-area .widget .widget-title,
        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
          padding: 8px 14px;
        }
      ';
            break;
        default:
            break;
    }
    //? ---------- Background for widget headers in columns
    $widget_h_back_design = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_h_back', 'gradient' ) );
    if ( $widget_h_back_design != 'simple' ) {
        // Background color
        $color_widget_h_back = $primary_big_color;
        if ( !empty( $widget_h_back_color ) ) {
            $color_widget_h_back = $widget_h_back_color;
        }
        // Background design
        if ( $widget_h_back_design == 'gradient' ) {
            $css .= "\n        .badoblog-css-widget-area .widget .widget-title,\n        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {\n          background: linear-gradient(90deg, #000 -200%, {$color_widget_h_back} 85%,rgba(0,0,0, 0) 200%);\n        }\n      ";
        } else {
            $css .= "\n        .badoblog-css-widget-area .widget .widget-title,\n        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {\n          background: {$color_widget_h_back};\n        }\n      ";
        }
        // Background size for widget headers in columns
        $widget_h_back_size = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_h_back_size', '20' ) );
        // Common padding
        $css .= '
      .badoblog-css-widget-area .widget .widget-title,
      .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
        padding: ' . $widget_h_back_size . 'px;
      }
    ';
        // Small back heading
        if ( $widget_h_back_size == '10' ) {
            $css .= '
        .badoblog-css-widget-area .widget .widget-title,
        .badoblog-css-widget-area .ab-sup-widget-block .wp-block-heading {
          border-radius: 17px;
          padding-left: 15px;
          padding-top: 11px;
        }
      ';
            // Most fonts have uneven vertical spacing, so we use 11px
        }
    }
    //----------------------------------------------------------------------------------
    //region Widget basic
    //----------------------------------------------------------------------------------
    //? ---------- Design for lists of posts and pages in basic widgets
    // Styles for dots
    $css_for_dots = '
    .widget:not(.widget_block).widget_recent_entries ul,
    .widget:not(.widget_block).widget_pages ul,
    .ab-sup-widget-block .wp-block-page-list,
    .ab-sup-widget-block .wp-block-page-list ul,
    .ab-sup-widget-block.widget_recent_entries ul,
    .ab-sup-widget-block ul.wp-block-latest-posts {
      padding-left: 20px;
    }
    .widget:not(.widget_block).widget_recent_entries li::marker,
    .widget:not(.widget_block).widget_pages li::marker,
    .ab-sup-widget-block .wp-block-latest-posts li::marker,
    .ab-sup-widget-block .wp-block-page-list li::marker {
      color: ' . $primary_color . ';
    }
  ';
    switch ( get_theme_mod( 'badoblog_cus_widget_sidebar_design_post', 'v1' ) ) {
        // File
        case 'v1':
            $css .= '
        .widget:not(.widget_block).widget_recent_entries li:before,
        .widget:not(.widget_block).widget_pages li:before,
        .ab-sup-widget-block .wp-block-page-list li:before,
        .ab-sup-widget-block .wp-block-latest-posts li:before {
          font-family: "icomoon";
          content: "\\e926";
          text-rendering: auto;
          color: ' . $primary_color . ';
        }
        .widget:not(.widget_block).widget_recent_entries li:before {
          margin-right: 5px;
        }
        .widget:not(.widget_block).widget_pages li:before,
        .ab-sup-widget-block .wp-block-page-list li:before,
        .ab-sup-widget-block .wp-block-latest-posts li:before {
          margin-right: 10px;
        }
      ';
            break;
        // Round dots
        case 'v2':
            $css .= $css_for_dots;
            $css .= '
        .widget:not(.widget_block).widget_recent_entries li,
        .widget:not(.widget_block).widget_pages li,
        .ab-sup-widget-block .wp-block-latest-posts li,
        .ab-sup-widget-block .wp-block-page-list li {
          list-style-type: disc;
        }
      ';
            break;
        // Square dots
        case 'v3':
            $css .= $css_for_dots;
            $css .= '
        .widget:not(.widget_block).widget_recent_entries li,
        .widget:not(.widget_block).widget_pages li,
        .ab-sup-widget-block .wp-block-latest-posts li,
        .ab-sup-widget-block .wp-block-page-list li {
          list-style-type: square;
        }
      ';
            break;
        // Thin border
        case 'v4':
            $css .= '
        .widget:not(.widget_block).widget_recent_entries a,
        .widget:not(.widget_block).widget_pages a,
        .ab-sup-widget-block .wp-block-latest-posts a,
        .ab-sup-widget-block .wp-block-page-list a {
          border-left: 2px solid ' . $primary_color . ';
          padding-left: 8px;
        }
      ';
            break;
        default:
            break;
    }
    //? ---------- Design for category lists in basic widgets
    $ico_cat = '';
    switch ( get_theme_mod( 'badoblog_cus_widget_sidebar_design_cat', 1 ) ) {
        // Folder 1
        case 1:
            $ico_cat = '\\f115';
            break;
        // Folder 2
        case 2:
            $ico_cat = '\\f07c';
            break;
        // Folder 3
        case 3:
            $ico_cat = '\\e930';
            break;
        // Folder 4
        case 4:
            $ico_cat = '\\e908';
            break;
        // Folder 5
        case 5:
            $ico_cat = '\\e91a';
            break;
        // Folder 6
        case 6:
            $ico_cat = '\\e912';
            break;
        // Folder 7
        case 7:
            $ico_cat = '\\f07b';
            break;
        // Card catalog
        case 8:
            $ico_cat = '\\e916';
            break;
        // Box
        case 9:
            $ico_cat = '\\e905';
            break;
        // Thick border
        case 10:
            $css .= '
        .widget:not(.widget_block).widget_categories a,
        .ab-sup-widget-block.widget_categories a {
          border-left: 4px solid ' . $primary_color . ';
          padding-left: 8px;
        }
      ';
            break;
        default:
            break;
    }
    if ( !empty( $ico_cat ) ) {
        $css .= "\n      .widget:not(.widget_block).widget_categories li:before,\n      .ab-sup-widget-block.widget_categories li:before {\n        font-family: 'icomoon';\n        text-rendering: auto;\n        content: '{$ico_cat}';\n        margin-right: 8px;\n        color: {$primary_color};\n      }\n    ";
    }
    //? ---------- Design for archives in basic widgets
    $ico_arh = '';
    switch ( get_theme_mod( 'badoblog_cus_widget_sidebar_design_archive', 1 ) ) {
        // Archive
        case 1:
            $ico_arh = '\\e920';
            break;
        // Card catalog
        case 2:
            $ico_arh = '\\e916';
            break;
        // Box
        case 3:
            $ico_arh = '\\e905';
            break;
        // Folder
        case 4:
            $ico_arh = '\\e91c';
            break;
        // Thick border
        case 5:
            $css .= '
        .widget:not(.widget_block).widget_archive a,
        .ab-sup-widget-block.widget_archive a {
          border-left: 4px solid ' . $primary_color . ';
          padding-left: 8px;
        }
      ';
            break;
        default:
            break;
    }
    if ( !empty( $ico_arh ) ) {
        $css .= "\n      .widget:not(.widget_block).widget_archive li:before,\n      .ab-sup-widget-block.widget_archive li:before {\n        font-family: 'icomoon';\n        text-rendering: auto;\n        content: '{$ico_arh}';\n        margin-right: 8px;\n        color: {$primary_color};\n      }\n    ";
    }
    //? ---------- Text color of menu items of basic classic widgets
    if ( !empty( $widget_menu_text_color ) ) {
        $css .= "\n      .widget.widget_nav_menu a {\n        color: {$widget_menu_text_color};\n      }\n    ";
    }
    //? ---------- Text color of menu items of basic classic widgets (on hover)
    if ( !empty( $widget_menu_hover_color ) ) {
        $css .= "\n      .widget.widget_nav_menu a:hover {\n        color: {$widget_menu_hover_color};\n      }\n    ";
    }
    //? ---------- Background color of menu items of basic classic widgets
    if ( !empty( $widget_menu_back_color ) ) {
        $css .= "\n      .widget.widget_nav_menu a {\n        background: {$widget_menu_back_color};\n        margin: 10px 0;\n        padding: 5px 10px;\n        border-radius: 15px;\n      }\n    ";
    }
    //? ---------- Background color of menu items of basic classic widgets (on hover)
    if ( !empty( $widget_menu_back_color_hover ) ) {
        $css .= "\n      .widget.widget_nav_menu a {\n        margin: 10px 0;\n        padding: 5px 10px;\n        border-radius: 15px;\n      }\n      .widget.widget_nav_menu a:hover {\n        background: {$widget_menu_back_color_hover};\n      }\n    ";
    }
    //? ---------- Design for menu lists in basic classic widgets
    switch ( get_theme_mod( 'badoblog_cus_widget_sidebar_design_menu', 'v1' ) ) {
        // Arrow
        case 'v1':
            $css .= '
        .widget.widget_nav_menu a {
          display: flex;
          align-items: center;
        }
        .widget.widget_nav_menu a:before {
          content: "\\e929";
          font-family: "icomoon";
          text-rendering: auto;
          margin-right: 8px;
          color: ' . $primary_color . ';
          display: flex;
        }
      ';
            break;
        // Square
        case 'v2':
            $css .= '
        .widget.widget_nav_menu ul {
          padding-left: 20px;
        }
        .widget.widget_nav_menu li {
          list-style-type: square;
        }
        .widget.widget_nav_menu li::marker {
          color: ' . $primary_color . ';
        }
        .widget.widget_nav_menu a {
          display: flex;
          align-items: center;
        }
      ';
            break;
        // Icon (sign)
        case 'v3':
            $css .= '
        .widget.widget_nav_menu a {
          display: flex;
          align-items: center;
          padding: 0;
          margin: 5px 0;
        }
        .widget.widget_nav_menu a:before {
          font-family: "icomoon";
          content: "\\e928";
          text-rendering: auto;
          background: ' . $primary_color . ';
          color: ' . $color_lite . ';
          padding: 2px 10px;
          margin-right: 10px;
          display: flex;
          border-radius: 15px;
        }
      ';
            break;
        default:
            $css .= '
        .widget.widget_nav_menu a {
          display: flex;
          align-items: center;
        }
      ';
            break;
    }
    //----------------------------------------------------------------------------------
    //region Footer
    //----------------------------------------------------------------------------------
    //? ---------- Full-width footer background
    if ( get_theme_mod( 'badoblog_cus_footer_full', 0 ) == 1 && $max_width_site != 'full' ) {
        $css .= "\n      @media (min-width: 1400px) {\n        .badoblog-css-site-footer {\n          width: calc(100vw - 16px);\n          margin-left: calc(-50vw + 50% + 8px);\n          border-radius: 5px 5px 0 0;\n        }\n        #page {\n          padding-bottom: 0;\n        }\n      }\n    ";
    }
    //? ---------- Footer background color
    $footer_color_back = $primary_big_color;
    if ( !empty( $footer_back_color ) ) {
        $footer_color_back = $footer_back_color;
    }
    $css .= '
    .badoblog-css-site-footer,
    .badoblog-css-site-footer textarea,
    .badoblog-css-site-footer select,
    .badoblog-css-site-footer pre,
    .badoblog-css-site-footer input[type="text"],
    .badoblog-css-site-footer input[type="email"],
    .badoblog-css-site-footer input[type="url"],
    .badoblog-css-site-footer input[type="password"],
    .badoblog-css-site-footer input[type="search"],
    .badoblog-css-site-footer input[type="number"],
    .badoblog-css-site-footer input[type="tel"],
    .badoblog-css-site-footer input[type="range"],
    .badoblog-css-site-footer input[type="date"],
    .badoblog-css-site-footer input[type="month"],
    .badoblog-css-site-footer input[type="week"],
    .badoblog-css-site-footer input[type="time"],
    .badoblog-css-site-footer input[type="datetime"],
    .badoblog-css-site-footer input[type="datetime-local"],
    .badoblog-css-site-footer input[type="color"],
    .badoblog-css-site-footer .widget_search input[type="text"],
    .badoblog-css-site-footer .widget_block .wp-block-code,
    .badoblog-css-site-footer .widget_block .wp-block-verse,
    .badoblog-css-site-footer .chosen-container div.chosen-drop,
    .badoblog-css-site-footer .chosen-container-single a.chosen-single {
      background: ' . $footer_color_back . ';
    }
  ';
    //? ---------- Footer text color
    $footer_color_text = $primary_big_lite_color;
    if ( !empty( $footer_text_color ) ) {
        $footer_color_text = $footer_text_color;
    }
    $css .= '
    .badoblog-css-site-footer,
    .badoblog-css-site-footer li,
    .badoblog-css-site-footer h2,
    .badoblog-css-site-footer input[type="text"],
    .badoblog-css-site-footer input[type="email"],
    .badoblog-css-site-footer input[type="url"],
    .badoblog-css-site-footer input[type="password"],
    .badoblog-css-site-footer input[type="search"],
    .badoblog-css-site-footer input[type="number"],
    .badoblog-css-site-footer input[type="tel"],
    .badoblog-css-site-footer input[type="range"],
    .badoblog-css-site-footer input[type="date"],
    .badoblog-css-site-footer input[type="month"],
    .badoblog-css-site-footer input[type="week"],
    .badoblog-css-site-footer input[type="time"],
    .badoblog-css-site-footer input[type="datetime"],
    .badoblog-css-site-footer input[type="datetime-local"],
    .badoblog-css-site-footer input[type="color"], 
    .badoblog-css-site-footer textarea,
    .badoblog-css-site-footer figcaption.wp-element-caption,
    .badoblog-css-site-footer .wp-block-calendar table caption,
    .badoblog-css-site-footer .wp-block-calendar table tbody,
    .badoblog-css-site-footer [class^="wp-block-"] figcaption,
    .badoblog-css-site-footer .blocks-gallery-caption,
    .badoblog-css-site-footer .chosen-container-single .chosen-single span {
      color: ' . $footer_color_text . ';
    }
  ';
    //? ---------- Footer link color
    if ( !empty( $footer_a_color ) ) {
        $css .= "\n      .badoblog-css-site-footer a {\n        color: {$footer_a_color};\n      }\n    ";
    } else {
        if ( $primary_big_lite_color !== '#fffffb' ) {
            $css .= "\n      .badoblog-css-site-footer a {\n        color: {$primary_big_lite_color};\n      }\n    ";
        }
    }
    //?---------- Footer link color (on hover)
    if ( !empty( $footer_a_hover ) ) {
        $css .= "\n      .badoblog-css-site-footer a:hover {\n        color: {$footer_a_hover};\n      }\n    ";
    }
    //?---------- Footer elements color
    $footer_color_primary = $primary_color;
    if ( !empty( $footer_primary_color ) ) {
        $footer_color_primary = $footer_primary_color;
    }
    $css .= '
    .badoblog-css-site-footer button,
    .badoblog-css-site-footer input[type="button"],
    .badoblog-css-site-footer input[type="reset"],
    .badoblog-css-site-footer input[type="submit"],
    .badoblog-css-site-footer .widget-title::after,
    .badoblog-css-site-footer .ab-sup-widget-block .wp-block-heading::after {
      background: ' . $footer_color_primary . ';
    }
    .badoblog-css-site-footer .widget.widget_categories li:before,
    .badoblog-css-site-footer .widget.widget_archive li:before,
    .badoblog-css-site-footer .widget.widget_recent_entries li:before,
    .badoblog-css-site-footer .widget.widget_pages li:before,
    .badoblog-css-site-footer .widget .wp-block-page-list li:before,
    .badoblog-css-site-footer .widget.widget_recent_entries li::marker,
    .badoblog-css-site-footer .widget.widget_pages li::marker,
    .badoblog-css-site-footer .widget .wp-block-page-list li::marker,
    .badoblog-css-site-footer .widget.widget_nav_menu a:before,
    .badoblog-css-site-footer .widget.widget_nav_menu li::marker {
      color: ' . $footer_color_primary . ';
    }
    .badoblog-css-site-footer .widget_search input[type="text"],
    .badoblog-css-site-footer input[type="text"],
    .badoblog-css-site-footer input[type="email"],
    .badoblog-css-site-footer input[type="url"],
    .badoblog-css-site-footer input[type="password"],
    .badoblog-css-site-footer input[type="search"],
    .badoblog-css-site-footer input[type="number"],
    .badoblog-css-site-footer input[type="tel"],
    .badoblog-css-site-footer input[type="range"],
    .badoblog-css-site-footer input[type="date"],
    .badoblog-css-site-footer input[type="month"],
    .badoblog-css-site-footer input[type="week"],
    .badoblog-css-site-footer input[type="time"],
    .badoblog-css-site-footer input[type="datetime"],
    .badoblog-css-site-footer input[type="datetime-local"],
    .badoblog-css-site-footer input[type="color"],
    .badoblog-css-site-footer select,
    .badoblog-css-site-footer textarea,
    .badoblog-css-site-footer .widget-title,
    .badoblog-css-site-footer .ab-sup-widget-block .wp-block-heading,
    .badoblog-css-site-footer .widget_block .wp-block-quote,
    .badoblog-css-site-footer .widget.widget_recent_entries a,
    .badoblog-css-site-footer .widget.widget_pages a,
    .badoblog-css-site-footer .widget .wp-block-page-list a,
    .badoblog-css-site-footer .widget.widget_categories a,
    .badoblog-css-site-footer .widget.widget_archive a,
    .badoblog-css-site-footer .chosen-container div.chosen-drop {
      border-color: ' . $footer_color_primary . ';
    }
  ';
    //? ---------- Add dividing line
    if ( get_theme_mod( 'badoblog_cus_footer_separation', 0 ) == 1 ) {
        $css .= '
      .badoblog-css-footer-widgets {
        border-bottom: 1px solid;
        margin-bottom: 20px;
        padding-bottom: 5px;
      }
    ';
    }
    //? ---------- Bottom menu text size
    $footer_menu_size = esc_attr( get_theme_mod( 'badoblog_cus_footer_menu_size', 14 ) );
    if ( $footer_menu_size != 14 ) {
        $css .= '
    .badoblog-css-footer-menu {
        font-size: ' . $footer_menu_size . 'px;
      }
    ';
    }
    //----------------------------------------------------------------------------------
    //region Widget footer
    //----------------------------------------------------------------------------------
    //? ---------- Widgets headers text color in footer
    $color_widget_footer_h_text = $primary_big_lite_color;
    if ( !empty( $widget_footer_h_color ) ) {
        $color_widget_footer_h_text = $widget_footer_h_color;
    }
    $css .= "\n    .badoblog-css-footer-widgets .widget-title,\n    .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {\n      color: {$color_widget_footer_h_text};\n    }\n  ";
    //? ---------- Titles font of (footer) widgets
    $font_h_widget = get_theme_mod( 'badoblog_cus_footer_widget_h_font', 'off' );
    if ( $font_h_widget !== 'off' ) {
        $famaly = '';
        if ( in_array( $font_h_widget, $serif ) ) {
            $famaly = 'serif';
        } elseif ( in_array( $font_h_widget, $cursive ) ) {
            $famaly = 'cursive';
        } else {
            $famaly = 'sans-serif';
        }
        $css .= '
      .badoblog-css-footer-widgets .widget .widget-title,
      .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {
        font-family: "' . $font_h_widget . '", ' . $famaly . ';
      }
    ';
    }
    //? ---------- Titles text size of (footer) widgets
    $widget_h_text_size = esc_attr( get_theme_mod( 'badoblog_cus_footer_widget_h_size', 18 ) );
    if ( $widget_h_text_size != 18 ) {
        $css .= '
      .badoblog-css-footer-widgets .widget .widget-title,
      .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {
        font-size: ' . $widget_h_text_size . 'px;
      }
    ';
    }
    //? ---------- Titles of (footer) widgets in uppercase
    $widget_h_up = esc_attr( get_theme_mod( 'badoblog_cus_footer_widget_h_up', 1 ) );
    if ( $widget_h_up != 1 ) {
        $css .= "\n      .badoblog-css-footer-widgets .widget .widget-title,\n      .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {\n        text-transform: none;\n      }\n    ";
    }
    //? ---------- Align the titles of (footer) widgets to the center
    $widget_h_center = esc_attr( get_theme_mod( 'badoblog_cus_footer_widget_h_center', 0 ) );
    if ( $widget_h_center == 1 ) {
        $css .= "\n      .badoblog-css-footer-widgets .widget .widget-title,\n      .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {\n        text-align: center;\n      }\n    ";
    }
    //? ---------- Underline titles of (footer) widgets
    $widget_h_size_border = esc_attr( get_theme_mod( 'badoblog_cus_footer_widget_h_border_size', 4 ) );
    switch ( get_theme_mod( 'badoblog_cus_footer_widget_h_border', 'v4' ) ) {
        // Left and down
        case 'v1':
            $css .= '
        .badoblog-css-footer-widgets .widget .widget-title::after,
        .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading::after {
          content: "";
          display: block;
          height: ' . $widget_h_size_border . 'px;
          width: 22%;
          margin-top: 5px;
          background: ' . $footer_color_primary . ';
        }
      ';
            break;
        // Center and bottom
        case 'v2':
            $css .= '
        .badoblog-css-footer-widgets .widget .widget-title::after,
        .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading::after {
          content: "";
          display: block;
          height: ' . $widget_h_size_border . 'px;
          width: 30%;
          margin: 0 auto;
          margin-top: 5px;
          background: ' . $footer_color_primary . ';
          text-align: center;
        }
      ';
            break;
        // Full width
        case 'v3':
            $css .= '
        .badoblog-css-footer-widgets .widget .widget-title,
        .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {
          border-bottom: ' . $widget_h_size_border . 'px solid ' . $footer_color_primary . ';
          padding: 6px 16px;
        }
      ';
            break;
        // Border left
        case 'v4':
            $css .= '
        .badoblog-css-footer-widgets .widget .widget-title,
        .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {
          border-left: ' . $widget_h_size_border . 'px solid ' . $footer_color_primary . ';
          background: rgba(0,0,0,0.05);
          padding: 8px 14px;
        }
      ';
            break;
        default:
            break;
    }
    //? ---------- Background for widget headers in footer
    if ( !empty( $widget_footer_h_back_color ) ) {
        $css .= "\n      .badoblog-css-footer-widgets .widget .widget-title,\n      .badoblog-css-footer-widgets .ab-sup-widget-block .wp-block-heading {\n        background: {$widget_footer_h_back_color};\n        padding: 11px 15px 10px;\n      }\n    ";
    }
    //----------------------------------------------------------------------------------
    //region Connect Styles
    //----------------------------------------------------------------------------------
    //?---------- Connecting the styles file and loading new css
    if ( !empty( $css ) ) {
        wp_add_inline_style( 'badoblog-style-custom', $css );
    }
}

add_action( 'wp_enqueue_scripts', 'badoblog_fun_set_css', 1 );
//?-----------------------------------------------------------------------------------------------------------
//?---------- Features and filters (body_class)
//?-----------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
//region Filters body_class
//----------------------------------------------------------------------------------
function badoblog_fun_body_class(  $classes  ) {
    // Adds a group blog class to blogs with more than 1 published author
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }
    // Add hfeed class to pages is_singular
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }
    // Class with theme version (for flexible compatibility with older versions)
    $child = '';
    if ( is_child_theme() ) {
        $child = 'ch-';
    }
    $size = '-st';
    // Size Theme
    if ( get_option( 'badoblog_set_size_imgs_all' ) == 2 ) {
        $size = '-swp';
        // Size WP
    }
    $vin = $child . BADOBLOG_VERSION . $size;
    $classes[] = 'bbf-' . $vin;
    //?---------- Template Orientation
    // Including sidebar css class in body tag
    $ab_lay = get_theme_mod( 'badoblog_cus_lay_all', 'right' );
    $ab_lay_home = get_theme_mod( 'badoblog_cus_lay_home', 'right' );
    if ( is_page_template() ) {
        if ( is_page_template( ['templates/post-left-sidebar.php', 'templates/page-left-sidebar.php'] ) ) {
            $classes[] = 'badoblog-css-left-sidebar';
        } else {
            if ( is_page_template( ['templates/post-nosidebar-full.php', 'templates/page-nosidebar-full.php'] ) ) {
                $classes[] = 'badoblog-css-no-sidebar-full';
            } else {
                if ( is_page_template( ['templates/post-nosidebar-center.php', 'templates/page-nosidebar-center.php'] ) ) {
                    $classes[] = 'badoblog-css-no-sidebar-center';
                } else {
                    if ( $ab_lay == 'left' && !is_front_page() || $ab_lay_home == 'left' && is_front_page() ) {
                        $classes[] = 'badoblog-css-left-sidebar';
                    } else {
                        if ( $ab_lay == 'no_sidebar_full' && !is_front_page() || $ab_lay_home == 'no_sidebar_full' && is_front_page() ) {
                            $classes[] = 'badoblog-css-no-sidebar-full';
                        } else {
                            if ( $ab_lay == 'no_sidebar_center' && !is_front_page() || $ab_lay_home == 'no_sidebar_center' && is_front_page() ) {
                                $classes[] = 'badoblog-css-no-sidebar-center';
                            }
                        }
                    }
                }
            }
        }
    } else {
        if ( $ab_lay == 'left' && !is_front_page() || $ab_lay_home == 'left' && is_front_page() ) {
            $classes[] = 'badoblog-css-left-sidebar';
        } else {
            if ( $ab_lay == 'no_sidebar_full' && !is_front_page() || $ab_lay_home == 'no_sidebar_full' && is_front_page() ) {
                $classes[] = 'badoblog-css-no-sidebar-full';
            } else {
                if ( $ab_lay == 'no_sidebar_center' && !is_front_page() || $ab_lay_home == 'no_sidebar_center' && is_front_page() ) {
                    $classes[] = 'badoblog-css-no-sidebar-center';
                }
            }
        }
    }
    // Change site width (full width site)
    if ( get_theme_mod( 'badoblog_cus_lay_max_width', '1560' ) != '1560' ) {
        $classes[] = 'badoblog-css-full-max-width';
    }
    return $classes;
}

add_filter( 'body_class', 'badoblog_fun_body_class' );
//?-----------------------------------------------------------------------------------------------------------
//?---------- Other features and filters
//?-----------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
//region Layout Sidebars
//----------------------------------------------------------------------------------
if ( !function_exists( 'badoblog_fun_sidebar_select' ) ) {
    function badoblog_fun_sidebar_select() {
        $ab_lay = get_theme_mod( 'badoblog_cus_lay_all', 'right' );
        $ab_lay_home = get_theme_mod( 'badoblog_cus_lay_home', 'right' );
        if ( $ab_lay == 'right' && !is_front_page() || $ab_lay_home == 'right' && is_front_page() || $ab_lay == 'left' && !is_front_page() || $ab_lay_home == 'left' && is_front_page() ) {
            if ( !function_exists( 'elementor_theme_do_location' ) || !elementor_theme_do_location( 'badoblog_elementor_sidebar' ) ) {
                get_sidebar();
            }
        }
    }

}
//----------------------------------------------------------------------------------
//region Callback for Menu
//----------------------------------------------------------------------------------
//?---------- Callback data for the top menu (if the menu is empty)
function badoblog_fun_top_menu_list_categories() {
    $args = array(
        'echo'       => 0,
        'title_li'   => '',
        'hide_empty' => 0,
        'number'     => 4,
        'depth'      => 1,
        'orderby'    => 'count',
        'order'      => 'DESC',
    );
    $out = '<ul class="menu">' . wp_list_categories( $args ) . '</ul>';
    echo wp_kses_post( $out );
}

//?---------- Callback data for the main menu (if the menu is empty)
function badoblog_fun_main_menu_list_categories() {
    $first = '';
    $last = '';
    // Category list settings
    $args = array(
        'echo'       => 0,
        'title_li'   => '',
        'hide_empty' => 0,
        'number'     => 8,
        'depth'      => 3,
    );
    // Displaying a menu list
    $out = '<ul class="menu">' . $first . wp_list_categories( $args ) . $last . '</ul>';
    echo wp_kses_post( $out );
}

//----------------------------------------------------------------------------------
//region Description Post
//----------------------------------------------------------------------------------
//?---------- Changing the length of description text in post blocks for search pages
add_filter( 'excerpt_length', 'badoblog_fun_excerpt_length' );
function badoblog_fun_excerpt_length(  $length  ) {
    // Number of words
    return 15;
}

add_filter( 'excerpt_more', 'badoblog_fun_excerpt_more' );
function badoblog_fun_excerpt_more(  $more  ) {
    return '..';
}

//?---------- Changing the length of description text in post blocks for categories pages (compatible with "show more" pagination)
function badoblog_fun_excerpt() {
    global $post;
    // Number of characters
    $letters = 150;
    $new_let = get_theme_mod( 'badoblog_cus_cat_style_letters', 150 );
    if ( $new_let != 150 ) {
        $letters = $new_let;
    }
    // Link name after tag <!--more-->
    $tag_more_link = '';
    // Else
    $tag_more_text = '...';
    // Link at the end of the words (If there is no tag <!--more-->)
    $more_link = '';
    // Else
    $more_text = '...';
    // Clear content
    $text = ( $post->post_excerpt ?: $post->post_content );
    $text = preg_replace( '~\\[([a-z0-9_-]+)[^\\]]*\\](?!\\().*?\\[/\\1\\]~is', '', $text );
    $text = preg_replace( '~\\[/?[^\\]]*\\](?!\\()~', '', $text );
    $text = preg_replace( '~(?<=\\s)https?://.+\\s~', '', $text );
    $text = str_replace( '&nbsp;', '', $text );
    $text = trim( $text );
    // Yes tag <!--more-->
    if ( strpos( $text, '<!--more-->' ) ) {
        $mm = '';
        preg_match( '/(.*)<!--more-->/s', $text, $mm );
        $text = trim( $mm[1] );
        $text = strip_tags( $text );
        if ( $tag_more_link ) {
            $text_append = sprintf(
                ' <a href="%s#more-%d">%s</a>',
                get_permalink( $post ),
                $post->ID,
                $tag_more_link
            );
        } else {
            $text_append = $tag_more_text;
        }
    } else {
        $text = strip_tags( $text );
        $has_tags = false !== strpos( $text, '<' );
        // Collect html tags
        if ( $has_tags ) {
            $tags_collection = [];
            $nn = 0;
            $text = preg_replace_callback( '/<[^>]+>/', static function ( $match ) use(&$tags_collection, &$nn) {
                $nn++;
                $holder = "~{$nn}";
                $tags_collection[$holder] = $match[0];
                return $holder;
            }, $text );
        }
        // Cut text
        $cuted_text = mb_substr( $text, 0, $letters );
        if ( $text !== $cuted_text ) {
            if ( $more_link ) {
                $append = sprintf(
                    ' <a href="%s#more-%d">%s</a>',
                    get_permalink( $post ),
                    $post->ID,
                    $more_link
                );
            } else {
                $append = $more_text;
            }
            // Del last word
            $text = preg_replace( '/(.*)\\s\\S*$/s', '\\1' . $append, trim( $cuted_text ) );
        }
        // Bring html tags back
        if ( $has_tags ) {
            $text = strtr( $text, $tags_collection );
            $text = force_balance_tags( wp_filter_post_kses( $text ) );
        }
    }
    // Re-cleaning required
    $text = trim( $text );
    if ( !empty( $text ) ) {
        // Add spaces and wrap in container <p></p>
        $text = preg_replace( ["/\r/", "/\n{2,}/", "/\n/"], ['', ' ', ' '], "<p>{$text}</p>" );
        // Add a "more" tag
        if ( isset( $text_append ) ) {
            $text .= $text_append;
        }
    }
    return $text;
}

//----------------------------------------------------------------------------------
//region Prefix Category
//----------------------------------------------------------------------------------
//?---------- Remove prefix "Category" in category headings
if ( get_theme_mod( 'badoblog_cus_cat_style_h_prefix', 0 ) == 1 ) {
    add_filter( 'get_the_archive_title', 'artabr_remove_name_cat' );
    function artabr_remove_name_cat(  $title  ) {
        if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        }
        return $title;
    }

}
//----------------------------------------------------------------------------------
//region length Headers
//----------------------------------------------------------------------------------
//?---------- Changing the length of headers (clipping headers)
function badoblog_fun_title_small_long(  $count, $after  ) {
    $title = get_the_title();
    if ( mb_strlen( $title ) > $count ) {
        $title = mb_substr( $title, 0, $count );
    } else {
        $after = '';
    }
    echo esc_attr( $title ) . esc_attr( $after );
}

//----------------------------------------------------------------------------------
//region URL Comments
//----------------------------------------------------------------------------------
//?---------- Remove URL box in comments
if ( esc_attr( get_theme_mod( 'badoblog_cus_post_comments_url', 0 ) ) == 1 ) {
    add_filter( 'comment_form_default_fields', 'badoblog_fun_unset_comment_url' );
    function badoblog_fun_unset_comment_url(  $fields  ) {
        if ( isset( $fields['url'] ) ) {
            unset($fields['url']);
        }
        return $fields;
    }

}
//----------------------------------------------------------------------------------
//region Post & Page Views
//----------------------------------------------------------------------------------
//?---------- Number of post and page views
if ( !function_exists( 'dmcwzmulti_fun_view_singular' ) ) {
    if ( get_theme_mod( 'badoblog_cus_post_meta_boxs_view', 1 ) == 1 || get_theme_mod( 'badoblog_cus_cat_meta_boxs_view', 1 ) == 1 ) {
        function dmcwzmulti_fun_view_singular() {
            //? ---------- Counter function
            function dmcwzmulti_fun_count_views(  $postID  ) {
                $count_key = 'views_count';
                $count = get_post_meta( $postID, $count_key, true );
                if ( $count == '' ) {
                    $count = 0;
                    delete_post_meta( $postID, $count_key );
                    add_post_meta( $postID, $count_key, '0' );
                } else {
                    $count++;
                    update_post_meta( $postID, $count_key, $count );
                }
            }

            //? ---------- Counter display function
            function dmcwzmulti_fun_get_views(  $postID  ) {
                $count_key = 'views_count';
                $count = get_post_meta( $postID, $count_key, true );
                if ( $count == '' ) {
                    delete_post_meta( $postID, $count_key );
                    add_post_meta( $postID, $count_key, '0' );
                    return "0";
                }
                return $count;
            }

            //? ---------- Counter hook
            function dmcwzmulti_fun_views_hook() {
                if ( is_singular() ) {
                    dmcwzmulti_fun_count_views( get_the_ID() );
                }
            }

            add_action( 'wp_footer', 'dmcwzmulti_fun_views_hook' );
        }

        dmcwzmulti_fun_view_singular();
    }
}
//----------------------------------------------------------------------------------
//region Image Quality
//----------------------------------------------------------------------------------
//?---------- Image compression quality setting (WP is set to 90 by default)
function badoblog_fun_ima_full_quality(  $quality  ) {
    return 100;
}

add_filter( 'jpeg_quality', 'badoblog_fun_ima_full_quality' );
add_filter( 'wp_editor_set_quality', 'badoblog_fun_ima_full_quality' );
//----------------------------------------------------------------------------------
//region Bottom Sidebars
//----------------------------------------------------------------------------------
function badoblog_fun_sidebar_footer_css() {
    $bar = 0;
    if ( is_active_sidebar( 'sidebar-footer-one' ) ) {
        if ( !function_exists( 'badoblog_fun_footer_sidebar_one' ) ) {
            // check for jetpack
            $bar += 1;
            function badoblog_fun_footer_sidebar_one() {
                echo '<div class="badoblog-css-footer-widget-one">';
                dynamic_sidebar( 'sidebar-footer-one' );
                echo '</div>';
            }

            add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_one' );
        }
    } else {
        if ( function_exists( 'badoblog_fun_footer_sidebar_one_demo' ) ) {
            if ( !function_exists( 'badoblog_fun_footer_sidebar_one' ) ) {
                $bar += 1;
                function badoblog_fun_footer_sidebar_one() {
                    echo '<div class="badoblog-css-footer-widget-one">';
                    badoblog_fun_footer_sidebar_one_demo();
                    echo '</div>';
                }

                add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_one' );
            }
        }
    }
    if ( is_active_sidebar( 'sidebar-footer-two' ) ) {
        if ( !function_exists( 'badoblog_fun_footer_sidebar_two' ) ) {
            $bar += 1;
            function badoblog_fun_footer_sidebar_two() {
                echo '<div class="badoblog-css-footer-widget-two">';
                dynamic_sidebar( 'sidebar-footer-two' );
                echo '</div>';
            }

            add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_two' );
        }
    } else {
        if ( function_exists( 'badoblog_fun_footer_sidebar_two_demo' ) ) {
            if ( !function_exists( 'badoblog_fun_footer_sidebar_two' ) ) {
                $bar += 1;
                function badoblog_fun_footer_sidebar_two() {
                    echo '<div class="badoblog-css-footer-widget-two">';
                    badoblog_fun_footer_sidebar_two_demo();
                    echo '</div>';
                }

                add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_two' );
            }
        }
    }
    if ( is_active_sidebar( 'sidebar-footer-three' ) ) {
        if ( !function_exists( 'badoblog_fun_footer_sidebar_three' ) ) {
            $bar += 1;
            function badoblog_fun_footer_sidebar_three() {
                echo '<div class="badoblog-css-footer-widget-three">';
                dynamic_sidebar( 'sidebar-footer-three' );
                echo '</div>';
            }

            add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_three' );
        }
    } else {
        if ( function_exists( 'badoblog_fun_footer_sidebar_three_demo' ) ) {
            if ( !function_exists( 'badoblog_fun_footer_sidebar_three' ) ) {
                $bar += 1;
                function badoblog_fun_footer_sidebar_three() {
                    echo '<div class="badoblog-css-footer-widget-three">';
                    badoblog_fun_footer_sidebar_three_demo();
                    echo '</div>';
                }

                add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_three' );
            }
        }
    }
    if ( is_active_sidebar( 'sidebar-footer-four' ) ) {
        if ( !function_exists( 'badoblog_fun_footer_sidebar_four' ) ) {
            $bar += 1;
            function badoblog_fun_footer_sidebar_four() {
                echo '<div class="badoblog-css-footer-widget-four">';
                dynamic_sidebar( 'sidebar-footer-four' );
                echo '</div>';
            }

            add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_four' );
        }
    } else {
        if ( function_exists( 'badoblog_fun_footer_sidebar_four_demo' ) ) {
            if ( !function_exists( 'badoblog_fun_footer_sidebar_four' ) ) {
                $bar += 1;
                function badoblog_fun_footer_sidebar_four() {
                    echo '<div class="badoblog-css-footer-widget-four">';
                    badoblog_fun_footer_sidebar_four_demo();
                    echo '</div>';
                }

                add_action( 'badoblog_hook_footer_sidebar', 'badoblog_fun_footer_sidebar_four' );
            }
        }
    }
    if ( $bar == 2 ) {
        $sidebar_css = '
      [class^="badoblog-css-footer-widget-"] {
        width: 47%;
      }
      @media (max-width: 1150px) {
        .badoblog-css-footer-widgets .widget {
          margin: 0 20px 25px 20px;
        }
      }
      @media (max-width: 600px) {
        .badoblog-css-footer-widgets {
          flex-direction: column;
          align-items: center;
        }
        [class^="badoblog-css-footer-widget-"] {
          width: 100%;
        }
      }
    ';
    } else {
        if ( $bar == 3 ) {
            $sidebar_css = '
      [class^="badoblog-css-footer-widget-"] {
        width: 30%;
      }
      @media (max-width: 1150px) {
        .badoblog-css-footer-widgets {
          flex-wrap: nowrap;
        }
        .badoblog-css-footer-widgets .widget {
          margin: 0 20px 25px 20px;
        }
      }
      @media (max-width: 800px) {
        .badoblog-css-footer-widgets {
          flex-direction: column;
          align-items: center;
        }
        [class^="badoblog-css-footer-widget-"] {
          width: 100%;
        }
      }
      @media (max-width: 400px) {
        .badoblog-css-footer-widgets .widget {
          margin: 0 0 25px 0;
        }
      }
    ';
        } else {
            if ( $bar == 1 ) {
                $sidebar_css = '
      [class^="badoblog-css-footer-widget-"] {
        width: 100%;
        max-width: 100%;
      }
    ';
            } else {
                $sidebar_css = '
      [class^="badoblog-css-footer-widget-"] {
        width: 23%;
      }
      @media (max-width: 1150px) {
        .badoblog-css-footer-widgets .widget {
          margin: 0 20px 25px 20px;
        }
      }
      @media (max-width: 960px) {
        [class^="badoblog-css-footer-widget-"] {
          width: 48%;
        }
      }
      @media (max-width: 600px) {
        .badoblog-css-footer-widgets {
          flex-direction: column;
          align-items: center;
        }
        [class^="badoblog-css-footer-widget-"] {
          width: 100%;
        }
      }
      @media (max-width: 400px) {
        .badoblog-css-footer-widgets .widget {
          margin: 0 0 25px 0;
        }
      }
    ';
            }
        }
    }
    wp_add_inline_style( 'badoblog-style-custom', $sidebar_css );
}

add_action( 'wp_enqueue_scripts', 'badoblog_fun_sidebar_footer_css', 1 );
//----------------------------------------------------------------------------------
//region Category fun
//----------------------------------------------------------------------------------
function badoblog_fun_content_archive() {
    $thumb_par = badoblog_fun_post_thumb_par( 'cat' );
    $no_img = get_theme_mod( 'badoblog_cus_cat_style_nofoto_none', 0 );
    $meta_boxs = get_theme_mod( 'badoblog_cus_cat_meta_boxs', 1 );
    $meta_cat = get_theme_mod( 'badoblog_cus_cat_meta_cat', 1 );
    $title_none = get_theme_mod( 'badoblog_cus_cat_style_title_none', 0 );
    $meta_tag = get_theme_mod( 'badoblog_cus_cat_meta_tag', 1 );
    $entry_none = get_theme_mod( 'badoblog_cus_cat_style_entry_none', 0 );
    $read_more = get_theme_mod( 'badoblog_cus_cat_style_more', 0 );
    $more_text = get_theme_mod( 'badoblog_cus_cat_style_more_text', 'Read more' );
    while ( have_posts() ) {
        the_post();
        get_template_part( 'template-parts/content-archive', null, array(
            'thumb_par'  => $thumb_par,
            'no_img'     => $no_img,
            'meta_boxs'  => $meta_boxs,
            'meta_cat'   => $meta_cat,
            'title_none' => $title_none,
            'meta_tag'   => $meta_tag,
            'entry_none' => $entry_none,
            'read_more'  => $read_more,
            'more_text'  => $more_text,
        ) );
    }
}

//----------------------------------------------------------------------------------
//region Load more
//----------------------------------------------------------------------------------
//?---------- Loading posts in categories (Load more)
if ( get_theme_mod( 'badoblog_cus_pagination_variant', 'v1' ) == 'v2' ) {
    if ( get_theme_mod( 'badoblog_cus_pagination_cat_activ', 1 ) == 1 || get_theme_mod( 'badoblog_cus_pagination_home_activ', 1 ) == 1 ) {
        function badoblog_fun_loadmore_script() {
            wp_enqueue_script(
                'badoblog-script-loadmore',
                get_template_directory_uri() . '/js/loadmore.js',
                array('jquery'),
                BADOBLOG_VERSION,
                true
            );
            wp_localize_script( 'badoblog-script-loadmore', 'badoblog_localize_loadmore', array(
                'delay' => esc_html__( "Loading...", 'bado-blog' ),
                'more'  => esc_html__( "Show more", 'bado-blog' ),
            ) );
        }

        add_action( 'wp_enqueue_scripts', 'badoblog_fun_loadmore_script' );
        function badoblog_fun_loadmore_post_grid() {
            $args = json_decode( stripslashes( $_POST['query'] ), true );
            $args['paged'] = $_POST['page'] + 1;
            $args['post_status'] = 'publish';
            return new WP_Query($args);
        }

        function badoblog_fun_loadmore_post_out(  $lay  ) {
            $q = badoblog_fun_loadmore_post_grid();
            if ( $q->have_posts() ) {
                $thumb_par = badoblog_fun_post_thumb_par( 'cat', $lay );
                $no_img = get_theme_mod( 'badoblog_cus_cat_style_nofoto_none', 0 );
                $meta_boxs = get_theme_mod( 'badoblog_cus_cat_meta_boxs', 1 );
                $meta_cat = get_theme_mod( 'badoblog_cus_cat_meta_cat', 1 );
                $title_none = get_theme_mod( 'badoblog_cus_cat_style_title_none', 0 );
                $meta_tag = get_theme_mod( 'badoblog_cus_cat_meta_tag', 1 );
                $entry_none = get_theme_mod( 'badoblog_cus_cat_style_entry_none', 0 );
                $read_more = get_theme_mod( 'badoblog_cus_cat_style_more', 0 );
                $more_text = get_theme_mod( 'badoblog_cus_cat_style_more_text', 'Read more' );
                while ( $q->have_posts() ) {
                    $q->the_post();
                    get_template_part( 'template-parts/content-archive', null, array(
                        'thumb_par'  => $thumb_par,
                        'no_img'     => $no_img,
                        'meta_boxs'  => $meta_boxs,
                        'meta_cat'   => $meta_cat,
                        'title_none' => $title_none,
                        'meta_tag'   => $meta_tag,
                        'entry_none' => $entry_none,
                        'read_more'  => $read_more,
                        'more_text'  => $more_text,
                    ) );
                }
            }
            wp_reset_postdata();
            wp_die();
        }

        // Separate functions are required. There is no way to check the home page when the ajax content is already defined.
        function badoblog_fun_loadmore_post_cat() {
            $lay = ( get_theme_mod( 'badoblog_cus_lay_all', 'right' ) != 'no_sidebar_full' ? 'small' : 'big' );
            badoblog_fun_loadmore_post_out( $lay );
        }

        function badoblog_fun_loadmore_post_cat_home() {
            $lay = ( get_theme_mod( 'badoblog_cus_lay_home', 'right' ) != 'no_sidebar_full' ? 'small' : 'big' );
            badoblog_fun_loadmore_post_out( $lay );
        }

        if ( wp_doing_ajax() ) {
            add_action( 'wp_ajax_badoblog-action-loadmore-home', 'badoblog_fun_loadmore_post_cat_home' );
            add_action( 'wp_ajax_nopriv_badoblog-action-loadmore-home', 'badoblog_fun_loadmore_post_cat_home' );
            add_action( 'wp_ajax_badoblog-action-loadmore', 'badoblog_fun_loadmore_post_cat' );
            add_action( 'wp_ajax_nopriv_badoblog-action-loadmore', 'badoblog_fun_loadmore_post_cat' );
        }
    }
}
//----------------------------------------------------------------------------------
//region Thumbnails (category, related, home not slider)
//----------------------------------------------------------------------------------
// Thumbnails parameters (Work before the start of the cycle)
function badoblog_fun_post_thumb_par(  $loc, $lay = ''  ) {
    $alt = get_theme_mod( 'badoblog_cus_seo_alt_nofoto', 'No photo' );
    $no_img_off = 0;
    $size = '1440x810';
    $def = '1440';
    $ar_common = [];
    $ar_add = [];
    switch ( $loc ) {
        case 'cat':
            if ( empty( $lay ) ) {
                // Checking the external (static) layout is necessary for Loadmore
                $lay = ( !in_array( "badoblog-css-no-sidebar-full", get_body_class() ) ? 'small' : 'big' );
                // Checking body_class is necessary for different pages
            }
            $win = get_theme_mod( 'badoblog_cus_cat_style_win', 'w2' );
            $ar_common = [
                's1' => ['320', '300', '300x169'],
                's2' => ['430', '384', '384x216'],
                's3' => ['530', '464', '464x261'],
            ];
            if ( $lay == 'small' ) {
                switch ( $win ) {
                    case 'w2':
                        $size = '464x261';
                        $def = '464';
                        $ar_add = [
                            's4' => ['625', '560', '560x315'],
                            's5' => ['798', '300', '300x169'],
                            's6' => ['1000', '384', '384x216'],
                            's7' => ['1088', '464', '464x261'],
                            's8' => ['1450', '384', '384x216'],
                        ];
                        break;
                    case 'w3':
                        $size = '300x169';
                        $def = '300';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['818', '300', '300x169'],
                            's6' => ['915', '384', '384x216'],
                            's7' => ['1236', '300', '300x169'],
                            's8' => ['1360', '384', '384x216'],
                        ];
                        break;
                    case 'w4':
                        $size = '208x117';
                        $def = '208';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['808', '300', '300x169'],
                            's6' => ['1088', '256', '256x144'],
                            's7' => ['1200', '300', '300x169'],
                            's8' => ['1528', '256', '256x144'],
                        ];
                        break;
                    case 'w5':
                        $size = '160x90';
                        $def = '160';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['868', '208', '208x117'],
                            's6' => ['1000', '256', '256x144'],
                            's7' => ['1360', '208', '208x117'],
                            's8' => ['1522', '256', '256x144'],
                        ];
                        break;
                    case 'w6':
                        $size = '384x216';
                        $def = '384';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['800', '160', '160x90'],
                            's6' => ['1250', '256', '256x144'],
                            's7' => ['1360', '300', '300x169'],
                        ];
                        break;
                    case 'w7':
                        $size = '256x144';
                        $def = '256';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['800', '160', '160x90'],
                            's6' => ['1250', '208', '208x117'],
                        ];
                        break;
                    case 'w8':
                        $size = '160x90';
                        $def = '160';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                        ];
                        break;
                    case 'w1':
                        $size = '960x540';
                        $def = '960';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['770', '688', '688x387'],
                        ];
                        break;
                }
            } else {
                switch ( $win ) {
                    case 'w2':
                        $size = '688x387';
                        $def = '688';
                        $ar_add = [
                            's4' => ['625', '560', '560x315'],
                            's5' => ['798', '300', '300x169'],
                            's6' => ['1000', '384', '384x216'],
                            's7' => ['1180', '464', '464x261'],
                            's8' => ['1315', '560', '560x315'],
                        ];
                        break;
                    case 'w3':
                        $size = '464x261';
                        $def = '464';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['818', '300', '300x169'],
                            's6' => ['915', '384', '384x216'],
                            's7' => ['1150', '300', '300x169'],
                            's8' => ['1580', '384', '384x216'],
                        ];
                        break;
                    case 'w4':
                        $size = '320x180';
                        $def = '320';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['808', '300', '300x169'],
                            's6' => ['1088', '256', '256x144'],
                            's7' => ['1200', '300', '300x169'],
                            's8' => ['1528', '272', '272x153'],
                        ];
                        break;
                    case 'w5':
                        $size = '256x144';
                        $def = '256';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['718', '256', '256x144'],
                            's6' => ['808', '300', '300x169'],
                        ];
                        break;
                    case 'w6':
                        $size = '384x216';
                        $def = '384';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['800', '160', '160x90'],
                            's6' => ['900', '256', '256x144'],
                            's7' => ['1000', '300', '300x169'],
                        ];
                        break;
                    case 'w7':
                        $size = '256x144';
                        $def = '256';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['800', '160', '160x90'],
                        ];
                        break;
                    case 'w8':
                        $size = '160x90';
                        $def = '160';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                        ];
                        break;
                    case 'w1':
                        $size = '1440x810';
                        $def = '1440';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['770', '688', '688x387'],
                            's6' => ['1085', '960', '960x540'],
                        ];
                        break;
                }
            }
            break;
        case 'related':
            $lay = ( !in_array( "badoblog-css-no-sidebar-full", get_body_class() ) ? 'small' : 'big' );
            // Check body_class is necessary if post templates are used
            $grid = get_theme_mod( 'badoblog_cus_post_related_grid', 'r4' );
            $ar_common = [
                's1' => ['320', '300', '300x169'],
                's2' => ['430', '384', '384x216'],
                's3' => ['530', '464', '464x261'],
            ];
            if ( $lay == 'small' ) {
                switch ( $grid ) {
                    case 'r3':
                        $size = '300x169';
                        $def = '300';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['818', '300', '300x169'],
                            's6' => ['915', '384', '384x216'],
                            's7' => ['1236', '300', '300x169'],
                            's8' => ['1360', '384', '384x216'],
                        ];
                        break;
                    case 'r4':
                        $size = '208x117';
                        $def = '208';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['808', '300', '300x169'],
                            's6' => ['1088', '256', '256x144'],
                            's7' => ['1200', '300', '300x169'],
                            's8' => ['1528', '256', '256x144'],
                        ];
                        break;
                    case 'r5':
                        $size = '160x90';
                        $def = '160';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['868', '208', '208x117'],
                            's6' => ['1000', '256', '256x144'],
                            's7' => ['1360', '208', '208x117'],
                            's8' => ['1522', '256', '256x144'],
                        ];
                        break;
                }
            } else {
                switch ( $grid ) {
                    case 'r3':
                        $size = '464x261';
                        $def = '464';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['818', '300', '300x169'],
                            's6' => ['915', '384', '384x216'],
                            's7' => ['1150', '300', '300x169'],
                            's8' => ['1580', '384', '384x216'],
                        ];
                        break;
                    case 'r4':
                        $size = '320x180';
                        $def = '320';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['808', '300', '300x169'],
                            's6' => ['1088', '256', '256x144'],
                            's7' => ['1200', '300', '300x169'],
                            's8' => ['1528', '272', '272x153'],
                        ];
                        break;
                    case 'r5':
                        $size = '256x144';
                        $def = '256';
                        $ar_add = [
                            's4' => ['600', '560', '560x315'],
                            's5' => ['718', '256', '256x144'],
                            's6' => ['808', '300', '300x169'],
                        ];
                        break;
                }
            }
            break;
        default:
            break;
    }
    // Unification of arrays
    $ars = array_merge( $ar_common, $ar_add );
    // Sises for Img and no img
    $arr_size = '';
    foreach ( $ars as $row ) {
        $arr_size .= '(max-width:' . $row[0] . 'px) ' . $row[1] . 'px, ';
    }
    // URLs for No img
    $ar_def = [
        's0' => ['2500', $def, $size],
    ];
    $arsurl = array_merge( $ar_def, $ars );
    $src_no_img = '';
    $unique_links = [];
    $no_img_url = get_template_directory_uri() . '/img/no-photo/no-foto-';
    foreach ( $arsurl as $row ) {
        if ( !in_array( $row[1], $unique_links ) ) {
            // Check for duplicate links
            $unique_links[] = $row[1];
            $src_no_img .= $no_img_url . $row[2] . '.png' . ' ' . $row[1] . 'w, ';
        }
    }
    // Remove the space and the comma at the end
    $srcset_no_img = rtrim( rtrim( $src_no_img ), "," );
    return array(
        $size,
        $def,
        $arr_size,
        $srcset_no_img,
        $no_img_off,
        $alt,
        $no_img_url
    );
}

// Thumbnails output (Works inside the loop)
function badoblog_fun_post_thumb(  $par  ) {
    if ( has_post_thumbnail() ) {
        $ui = 'badoblog-img-';
        $name_size = $ui . $par[0];
        // If the image is not large enough
        $img_id = get_post_thumbnail_id();
        $url_img_main = wp_get_attachment_image_src( $img_id, $name_size );
        if ( $url_img_main && $url_img_main[0] == wp_get_attachment_url( $img_id ) ) {
            $sizes = [
                '1440x810',
                '960x540',
                '688x387',
                '560x315',
                '464x261',
                '384x216',
                '320x180',
                '300x169',
                '272x153',
                '256x144',
                '208x117'
            ];
            foreach ( $sizes as $size ) {
                $image = wp_get_attachment_image_src( $img_id, $ui . $size );
                if ( $image && $image[0] !== wp_get_attachment_url( $img_id ) ) {
                    $name_size = $ui . $size;
                    break;
                }
            }
        }
        // Output
        the_post_thumbnail( $name_size, [
            'sizes' => $par[2] . $par[1] . 'px',
        ] );
        // No img
    } else {
        if ( $par[4] == 0 ) {
            ?>
    <img src="<?php 
            echo esc_url( $par[6] . $par[0] . '.png' );
            ?>" 
      sizes="<?php 
            echo esc_attr( $par[2] . $par[1] . 'px' );
            ?>" 
      srcset="<?php 
            echo esc_attr( $par[3] );
            ?>" 
      alt="<?php 
            echo esc_attr( $par[5] );
            ?>">
    <?php 
        } else {
            return 'noimg';
        }
    }
}

// Thumbnails output (Works inside the loop)
function badoblog_fun_post_thumb_img(  $par  ) {
    $ui = 'badoblog-img-';
    $name_size = $ui . $par[0];
    // If the image is not large enough
    $img_id = get_post_thumbnail_id();
    $url_img_main = wp_get_attachment_image_src( $img_id, $name_size );
    if ( $url_img_main && $url_img_main[0] == wp_get_attachment_url( $img_id ) ) {
        $sizes = [
            '1440x810',
            '960x540',
            '688x387',
            '560x315',
            '464x261',
            '384x216',
            '320x180',
            '300x169',
            '272x153',
            '256x144',
            '208x117'
        ];
        foreach ( $sizes as $size ) {
            $image = wp_get_attachment_image_src( $img_id, $ui . $size );
            if ( $image && $image[0] !== wp_get_attachment_url( $img_id ) ) {
                $name_size = $ui . $size;
                break;
            }
        }
    }
    // Output
    the_post_thumbnail( $name_size, [
        'sizes' => $par[2] . $par[1] . 'px',
    ] );
}

// Thumbnails output (Works inside the loop)
function badoblog_fun_post_thumb_no_img(  $par  ) {
    ?>
  <img src="<?php 
    echo esc_url( $par[6] . $par[0] . '.png' );
    ?>" 
    sizes="<?php 
    echo esc_attr( $par[2] . $par[1] . 'px' );
    ?>" 
    srcset="<?php 
    echo esc_attr( $par[3] );
    ?>" 
    alt="<?php 
    echo esc_attr( $par[5] );
    ?>">
  <?php 
}

//----------------------------------------------------------------------------------
//region Photo Post & Page
//----------------------------------------------------------------------------------
function badoblog_fun_thumb_max() {
    if ( get_theme_mod( 'badoblog_cus_lay_max_width', '1560' ) != '1560' ) {
        $size = '1920x1080';
    } else {
        if ( !in_array( "badoblog-css-no-sidebar-full", get_body_class() ) ) {
            $size = '960x540';
        } else {
            $size = '1440x810';
        }
    }
    the_post_thumbnail( 'badoblog-img-' . $size );
}

//?---------- The function of displaying the main photo of a post
function badoblog_fun_thumb_post() {
    $var_size = get_theme_mod( 'badoblog_cus_post_img_top_post_size', 'max' );
    if ( $var_size == 'max' ) {
        badoblog_fun_thumb_max();
    } else {
        the_post_thumbnail( 'badoblog-img-' . $var_size );
    }
}

//?---------- The function of displaying the main photo of a page
function badoblog_fun_thumb_page() {
    $var_size = get_theme_mod( 'badoblog_cus_post_img_top_page_size', 'max' );
    if ( $var_size == 'max' ) {
        badoblog_fun_thumb_max();
    } else {
        the_post_thumbnail( 'badoblog-img-' . $var_size );
    }
}

//----------------------------------------------------------------------------------
//region H2 Pagination
//----------------------------------------------------------------------------------
//?---------- Removes H2 from pagination
if ( get_theme_mod( 'badoblog_cus_pagination_tag_h2', 0 ) == 1 ) {
    add_filter(
        'navigation_markup_template',
        'badoblog_fun_pagi_nav_h2',
        10,
        2
    );
    function badoblog_fun_pagi_nav_h2(  $template, $class  ) {
        return '
		<nav class="navigation %1$s" role="navigation">
			<div class="screen-reader-text">%2$s</div>
			<div class="nav-links">%3$s</div>
		</nav>
		';
    }

}
//----------------------------------------------------------------------------------
//region Header Image Link
//----------------------------------------------------------------------------------
function badoblog_fun_header_image_site() {
    ?>
  <div class="badoblog-css-site-brand-top-img-anime">
    <img src="<?php 
    header_image();
    ?>" width="<?php 
    echo absint( get_custom_header()->width );
    ?>" height="<?php 
    echo absint( get_custom_header()->height );
    ?>">
  </div>
  <?php 
}

function badoblog_fun_head_image_link() {
    $image_link = get_theme_mod( 'badoblog_cus_header_image_link' );
    if ( $image_link ) {
        echo '<a href="' . esc_url( $image_link ) . '">';
        badoblog_fun_header_image_site();
        echo '</a>';
    } else {
        badoblog_fun_header_image_site();
    }
}

//----------------------------------------------------------------------------------
//region Top Date
//----------------------------------------------------------------------------------
function badoblog_fun_top_date() {
    $date_var = esc_attr( get_theme_mod( 'badoblog_cus_date', 1 ) );
    if ( $date_var == 2 ) {
        $date_display = get_option( 'date_format' );
    } else {
        // Display weeks
        $week = esc_attr( get_theme_mod( 'badoblog_cus_date_week', 'before' ) );
        $week_before = '';
        $week_after = '';
        if ( $week == 'before' ) {
            $week_before = 'l, ';
        } else {
            if ( $week == 'after' ) {
                $week_after = ', l';
            }
        }
        // Separator between numbers
        $sup_set = esc_attr( get_theme_mod( 'badoblog_cus_date_sup', 1 ) );
        switch ( $sup_set ) {
            case 1:
                $sup = ' ';
                break;
            case 2:
                $sup = '-';
                break;
            case 3:
                $sup = '.';
                break;
            case 4:
                $sup = '/';
                break;
            default:
                $sup = ' | ';
                break;
        }
        $sup_year = $sup;
        // Display year
        $date_y = esc_attr( get_theme_mod( 'badoblog_cus_date_year', 1 ) );
        $date_year = 'Y';
        if ( $date_y != 1 ) {
            $date_year = '';
            $sup_year = '';
        }
        // Month in letters
        $date_month = esc_attr( get_theme_mod( 'badoblog_cus_date_month', 1 ) );
        $date_format = esc_attr( get_theme_mod( 'badoblog_cus_date_format', 1 ) );
        if ( $date_month != 1 ) {
            if ( $date_format == 1 ) {
                $date_display = ' j' . $sup . 'm' . $sup_year . $date_year;
            } else {
                if ( $date_format == 2 ) {
                    $date_display = 'm' . $sup . 'j' . $sup_year . $date_year;
                } else {
                    $date_display = $date_year . $sup_year . 'm' . $sup . 'j';
                }
            }
        } else {
            if ( $date_format == 1 ) {
                $date_display = 'j F ' . $date_year;
            } else {
                if ( $date_format == 2 ) {
                    $date_display = 'F  j' . $sup_year . $date_year;
                } else {
                    $date_display = $date_year . ' F  j';
                }
            }
        }
        $date_display = $week_before . $date_display . $week_after;
    }
    ?>
  <div class="badoblog-css-top-left">
    <div class="badoblog-css-top-date">
      <?php 
    echo wp_date( $date_display );
    ?>
    </div>
  </div>
  <?php 
}

//----------------------------------------------------------------------------------
//region Top Search
//----------------------------------------------------------------------------------
//?---------- Top search function
function badoblog_fun_top_soc_search() {
    $search_top = get_theme_mod( 'badoblog_cus_search', 'top-bar' );
    $search_soc = get_theme_mod( 'badoblog_cus_search_soc', 1 );
    $soc_active = get_theme_mod( 'badoblog_cus_soc', 1 );
    if ( $search_top == 'top-bar' ) {
        $css_search_box = 'badoblog-css-search-top-bar';
    } else {
        $css_search_box = 'badoblog-css-soc-top-box-child';
    }
    // Checking work - Use social icon styles
    $css_soc_box = false;
    $search_size = '';
    if ( $search_soc == 1 && $soc_active == 1 && $search_top != 'top-bar' ) {
        $css_soc_box = true;
        $css_search_box .= ' badoblog-css-search-soc-styles';
    } else {
        $search_size = get_theme_mod( 'badoblog_cus_search_size', 'search-small' ) . ' ';
        $css_search_box .= ' badoblog-css-search-soc-styles-not';
    }
    ?>

  <div class="<?php 
    echo esc_attr( $css_search_box );
    ?> badoblog-css-soc-search">
    <button class="<?php 
    echo esc_attr( $search_size );
    ?>badoblog-css-top-search-button search-icon" 
      data-toggle-target=".badoblog-css-top-search-modal" 
      data-set-focus=".badoblog-css-top-badoblog-css-top-search-modal" 
      aria-expanded="false">
      <?php 
    if ( $css_soc_box ) {
        $search_alt = esc_html__( 'Search', 'bado-blog' );
        $form = get_theme_mod( 'badoblog_cus_soc_form', 'circle' );
        $design = get_theme_mod( 'badoblog_cus_soc_design_back', 'volumetric' );
        if ( $form == 'without-background' ) {
            $design = get_theme_mod( 'badoblog_cus_soc_design_no_back', 'only-black-line' );
        }
        $dir = '';
        $dir = apply_filters( 'dmcwzmulti_filter_soc_dir', $dir, $form );
        if ( empty( $dir ) ) {
            $dir = get_template_directory_uri() . '/';
        }
        $soc_url = $dir . 'img/soc/' . $form . '/' . $design . '/search';
        ?>
        <div class="badoblog-css-soc-top-box-anime">
          <img src="<?php 
        echo esc_url( $soc_url ) . '.png';
        ?>" alt="<?php 
        echo esc_attr( $search_alt );
        ?>">
        </div>
        <?php 
    }
    ?>
    </button>
  </div>

  <div class="badoblog-css-top-search-modal badoblog-css-cover-search" data-modal-target-string=".badoblog-css-top-search-modal" 
    role="dialog" aria-modal="true" aria-label="<?php 
    esc_attr_e( 'Search', 'bado-blog' );
    ?>">
    <div class="badoblog-css-top-search-modal-inner">
      <?php 
    get_search_form();
    ?>
      <button class="badoblog-css-top-close-search-toggle search-close-icon" data-toggle-target=".badoblog-css-top-search-modal" 
        data-set-focus=".badoblog-css-top-search-modal">
        <span class="screen-reader-text">
          <?php 
    /* translators: Hidden accessibility text. */
    esc_html_e( 'Close search', 'bado-blog' );
    ?>
        </span>
      </button>
    </div>
  </div>
  <?php 
}

//?---------- Search wrapper for compatibility with social media icons
function badoblog_fun_top_soc_search_box() {
    echo '<div class="badoblog-css-soc-top-box">';
    badoblog_fun_top_soc_search();
    echo '</div>';
}

//----------------------------------------------------------------------------------
//region Header
//----------------------------------------------------------------------------------
function badoblog_fun_header() {
    if ( !function_exists( 'elementor_theme_do_location' ) || !elementor_theme_do_location( 'header' ) ) {
        ?>
    <header id="site-header" class="badoblog-css-site-header">
      <?php 
        do_action( 'badoblog_hook_before_topmenu' );
        $ticker = get_theme_mod( 'badoblog_cus_ticker', 'date' );
        $top_menu = get_theme_mod( 'badoblog_cus_top_menu', 0 );
        $header_image_soc = false;
        if ( get_theme_mod( 'badoblog_cus_header_image_soc', 0 ) == 1 and get_header_image() ) {
            $header_image_soc = true;
        }
        $search = get_theme_mod( 'badoblog_cus_search', 'top-bar' );
        $soc = get_theme_mod( 'badoblog_cus_soc', 1 );
        if ( $search == 'soc-after' || $search == 'soc-before' ) {
            if ( $soc == 1 ) {
                if ( $search == 'soc-after' ) {
                    add_action( 'badoblog_hook_top_soc_after', 'badoblog_fun_top_soc_search' );
                } else {
                    add_action( 'badoblog_hook_top_soc_before', 'badoblog_fun_top_soc_search' );
                }
            } else {
                add_action( 'badoblog_hook_brand_top_inner', 'badoblog_fun_top_soc_search_box' );
                add_action( 'badoblog_hook_brand_bottom_right', 'badoblog_fun_top_soc_search_box' );
            }
        }
        if ( $top_menu != 1 || $ticker != 'off' || $search == 'top-bar' ) {
            ?>
        <div class="badoblog-css-top-bar badoblog-css-clear">
          <?php 
            if ( $ticker == 'ticker' ) {
                get_template_part( 'inc/module/ticker' );
            } else {
                if ( $ticker == 'date' ) {
                    badoblog_fun_top_date();
                }
            }
            ?>
          <!-- Top menu -->
          <!-- Don't add spaces to the block (badoblog-css-top-menu) - css selector is used "empty" -->
          <div class="badoblog-css-top-menu"><?php 
            if ( $search == 'top-bar' ) {
                badoblog_fun_top_soc_search();
            }
            if ( $top_menu != 1 ) {
                get_template_part( 'inc/module/top-menu' );
            }
            ?></div>
        </div>
        <?php 
        }
        do_action( 'badoblog_hook_after_topmenu' );
        ?>
      <div class="badoblog-css-site-branding">
        <?php 
        if ( get_header_image() ) {
            ?>
          <div class="badoblog-css-site-brand-top">
            <div class="badoblog-css-site-brand-top-1">
              <?php 
            if ( function_exists( 'badoblog_fun_head_image_link' ) ) {
                badoblog_fun_head_image_link();
            }
            if ( $header_image_soc ) {
                ?>
                <div class="badoblog-css-site-brand-top-2">
                  <?php 
                if ( $soc == 1 ) {
                    badoblog_fun_soc_set();
                }
                do_action( 'badoblog_hook_brand_top_inner' );
                ?>
                </div>
                <?php 
            }
            ?>
            </div>
          </div>
          <?php 
        }
        ?>
        <div class="badoblog-css-site-brand-bottom">
          <div class="badoblog-css-site-brand-bottom-1">
            <div class="badoblog-css-site-brand-bottom-box">
              <?php 
        if ( get_theme_mod( 'badoblog_cus_title_tagline_logo_var', 'fix' ) == 'fix' ) {
            if ( has_custom_logo() && function_exists( 'the_custom_logo' ) ) {
                ?>
                  <div class="badoblog-css-site-logo-box badoblog-css-logo-fix">
                    <?php 
                the_custom_logo();
                ?>
                  </div>
                  <?php 
            }
        } else {
            $supple_logo = get_theme_mod( 'badoblog_cus_supple_logo' );
            if ( $supple_logo ) {
                ?>
                  <div class="badoblog-css-site-logo-box badoblog-css-logo-free">
                    <?php 
                if ( is_front_page() ) {
                    ?>
                      <img src="<?php 
                    echo esc_url( $supple_logo );
                    ?>" alt="<?php 
                    bloginfo( 'name' );
                    ?>">
                      <?php 
                } else {
                    ?>
                      <a href="<?php 
                    echo esc_url( home_url( '/' ) );
                    ?>" rel="home">
                        <img src="<?php 
                    echo esc_url( $supple_logo );
                    ?>" alt="<?php 
                    bloginfo( 'name' );
                    ?>">
                      </a>
                      <?php 
                }
                ?>
                  </div>
                  <?php 
            }
        }
        $description = get_bloginfo( 'description', 'display' );
        if ( display_header_text() && (get_bloginfo( 'name' ) || $description) ) {
            $title_box_css = 'badoblog-css-site-title-box';
        } else {
            $title_box_css = 'clear-title-box';
        }
        ?>
              <div class="<?php 
        echo esc_attr( $title_box_css );
        ?>" >
                <?php 
        if ( is_front_page() ) {
            ?>
                  <h1 class="badoblog-css-site-title"><?php 
            bloginfo( 'name' );
            ?></h1>					
                  <?php 
        } else {
            ?>
                  <p class="badoblog-css-site-title"><a href="<?php 
            echo esc_url( home_url( '/' ) );
            ?>" rel="home"><?php 
            bloginfo( 'name' );
            ?></a></p>
                  <?php 
        }
        if ( $description || is_customize_preview() ) {
            ?>
                  <p class="badoblog-css-site-description"><?php 
            echo esc_html( $description );
            ?></p>
                  <?php 
        }
        ?>
              </div>
            </div>
          </div>
          <div class="badoblog-css-site-brand-bottom-2"><?php 
        // for empty
        do_action( 'badoblog_hook_before_head_banner' );
        if ( get_theme_mod( 'badoblog_cus_banner', 0 ) == 1 ) {
            $demo_banner = get_template_directory_uri() . '/img/no-photo/demo-banner.png';
            $banner_media = get_theme_mod( 'badoblog_cus_banner_media', $demo_banner );
            $banner_link = get_theme_mod( 'badoblog_cus_banner_link', '' );
            $banner_alt = get_theme_mod( 'badoblog_cus_banner_alt', 'Banner' );
            $banner_tab = get_theme_mod( 'badoblog_cus_banner_tab', 1 );
            $banner_link = ( !empty( $banner_link ) ? $banner_link : '#' );
            $banner_tab = ( $banner_tab == 1 ? 'target=_blank' : '' );
            // Missing quotes are added automatically
            ?>
              <div class="badoblog-css-site-brand-banner">
                <a href="<?php 
            echo esc_url( $banner_link );
            ?>" <?php 
            echo esc_html( $banner_tab );
            ?> >
                  <img src="<?php 
            echo esc_url( $banner_media );
            ?>" alt="<?php 
            echo esc_attr( $banner_alt );
            ?>">
                </a>
              </div>
              <?php 
        }
        if ( !$header_image_soc ) {
            if ( $search == 'soc-after' || $search == 'soc-before' || $soc == 1 ) {
                ?>
                <div class="badoblog-css-site-brand-soc">
                  <?php 
                if ( $soc == 1 ) {
                    badoblog_fun_soc_set();
                }
                do_action( 'badoblog_hook_brand_bottom_right' );
                ?>
                </div>
                <?php 
            }
        }
        do_action( 'badoblog_hook_after_head_banner' );
        ?></div>
        </div>
      </div>
      <?php 
        do_action( 'badoblog_hook_before_mainmenu' );
        if ( get_theme_mod( 'badoblog_cus_main_menu', 0 ) != 1 ) {
            get_template_part( 'inc/module/main-menu' );
        }
        do_action( 'badoblog_hook_after_mainmenu' );
        ?>
    </header>
    <?php 
    }
}

//----------------------------------------------------------------------------------
//region Home Article
//----------------------------------------------------------------------------------
if ( get_theme_mod( 'badoblog_cus_home_article_block', 1 ) == 1 ) {
    function badoblog_fun_main_article() {
        do_action( 'badoblog_hook_before_main_article' );
        get_template_part( 'template-parts/home/home-article' );
        do_action( 'badoblog_hook_after_main_article' );
    }

    $article = 'after';
    if ( $article == 'after' ) {
        add_action( 'badoblog_hook_after_main_common', 'badoblog_fun_main_article' );
    }
}
//----------------------------------------------------------------------------------
//region SOC
//----------------------------------------------------------------------------------
// All soc forms
function badoblog_fun_soc_form() {
    $soc_form = array(
        'without-background' => esc_html__( 'Without background', 'bado-blog' ),
        'rounded-square'     => esc_html__( 'Rounded square', 'bado-blog' ),
        'circle'             => esc_html__( 'Circle', 'bado-blog' ),
    );
    $soc_form = apply_filters( 'dmcwzmulti_filter_soc_form', $soc_form );
    return $soc_form;
}

// Defining design or soc net for forms
function badoblog_fun_soc_arr_for_script(  $arg  ) {
    // All forms
    $soc_all_form = badoblog_fun_soc_form();
    // Pro forms
    $soc_only_pro = array();
    $soc_only_pro = apply_filters( 'dmcwzmulti_filter_soc_onlyp_form', $soc_only_pro );
    // Pro design
    $soc_pro_design_back = array();
    $soc_pro_design_back = apply_filters( 'dmcwzmulti_filter_soc_design_back_array', $soc_pro_design_back );
    // Free design
    $soc_def_design_back = array(
        'flat'       => esc_html__( 'Flat', 'bado-blog' ),
        'volumetric' => esc_html__( 'Volumetric', 'bado-blog' ),
    );
    // Pro soc net
    $soc_pro_soc_net = array();
    $soc_pro_soc_net = apply_filters( 'dmcwzmulti_filter_soc_net_bundle_array', $soc_pro_soc_net );
    // Free soc net
    $soc_def_soc_net = array(
        'off'       => '',
        'facebook'  => 'Facebook',
        'instagram' => 'Instagram',
        'linkedin'  => 'LinkedIn',
        'pinterest' => 'Pinterest',
        'skype'     => 'Skype',
        'telegram'  => 'Telegram',
        'tiktok'    => 'TikTok',
        'twitterx'  => 'Twitter X',
        'wechat'    => 'WeChat',
        'whatsapp'  => 'WhatsApp',
        'youtube'   => 'YouTube',
    );
    $forms_design = array();
    $forms_net = array();
    foreach ( $soc_all_form as $soc_f => $soc_v ) {
        if ( array_key_exists( $soc_f, $soc_only_pro ) ) {
            $soc_back = $soc_pro_design_back;
            $soc_net = $soc_pro_soc_net;
        } else {
            $soc_back = $soc_def_design_back;
            $soc_net = $soc_def_soc_net;
        }
        $forms_design = array_merge( $forms_design, array(
            $soc_f => $soc_back,
        ) );
        $forms_net = array_merge( $forms_net, array(
            $soc_f => $soc_net,
        ) );
    }
    if ( $arg == 'design' ) {
        return $forms_design;
    } else {
        return $forms_net;
    }
}
