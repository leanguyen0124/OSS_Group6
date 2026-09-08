<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Main function file
* ------------------------------------------------------------------------------ */
/* ------------------------------------------------------------------------------
* Independent:
* bado-blog - Translations and slug
* BADOBLOG_VERSION - Versions
*
* Prefixes:
* badoblog_ - General
* badoblog_fun_ - Functions
* badoblog_set_ - Setting ID
* badoblog_cus_ - Customizer ID
* badoblog_hook_ - Hooks
* badoblog-css- - CSS theme classes
* badoblog-style- - Style files id
* badoblog-script- - Script files id
*
* Common Prefixes for DMCWebZone plugins compatibility:
* dmcwzmulti_ - General
* dmcwzmulti_fun_ - Functions
* dmcwzmulti-style- - Style files id
* dmcwzmulti-script- - Script files id
* ------------------------------------------------------------------------------ */
// Theme version
if ( !defined( 'BADOBLOG_VERSION' ) ) {
    define( 'BADOBLOG_VERSION', '1.5.2' );
}
// Debugging (switching styles to uncompressed versions)
$debug = 0;
if ( $debug == 0 ) {
    define( 'BADOBLOG_MIN', 'min.' );
} else {
    define( 'BADOBLOG_MIN', '' );
}
// Theme name
if ( !defined( 'BADOBLOG_NAME' ) ) {
    define( 'BADOBLOG_NAME', 'Bado Blog' );
}
// Theme support
if ( !defined( 'DMCWZ_THEME' ) ) {
    define( 'DMCWZ_THEME', '1' );
}
//----------------------------------------------------------------------------------
//region after_setup_theme
//----------------------------------------------------------------------------------
// Connecting various features and theme settings
if ( !function_exists( 'badoblog_fun_setup_theme' ) ) {
    function badoblog_fun_setup_theme() {
        // Include RSS feed of posts and comments in header
        add_theme_support( 'automatic-feed-links' );
        // Enable header driven
        add_theme_support( 'title-tag' );
        // Enable thumbnails for pages and posts
        add_theme_support( 'post-thumbnails' );
        // Enable style output for block editor
        add_theme_support( 'editor-styles' );
        add_editor_style( 'css/editor-style.css' );
        // Enabling Full and Wide Block Alignment Support in the Block Editor
        add_theme_support( 'align-wide' );
        // Responsive block editor content
        add_theme_support( 'responsive-embeds' );
        // Enable block editor styles
        $style_block = get_theme_mod( 'badoblog_cus_speed_block_style_none', 0 );
        if ( $style_block == 0 ) {
            add_theme_support( 'wp-block-styles' );
        }
        // Enable Support Woocommerce
        add_theme_support( 'woocommerce' );
        // Support html5
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets'
        ) );
        // Registering the menu
        register_nav_menus( array(
            'badoblog-loc-menu-main'   => esc_html__( 'Main Menu', 'bado-blog' ),
            'badoblog-loc-menu-top'    => esc_html__( 'Top Menu', 'bado-blog' ),
            'badoblog-loc-menu-footer' => esc_html__( 'Footer Menu', 'bado-blog' ),
            'badoblog-loc-menu-widget' => esc_html__( 'Widget Menu', 'bado-blog' ),
        ) );
        // Connecting the background function
        add_theme_support( 'custom-background', apply_filters( 'badoblog_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );
        // Connecting the logo function
        add_theme_support( 'custom-logo', array(
            'width'       => 200,
            'height'      => 150,
            'flex-width'  => false,
            'flex-height' => false,
        ) );
        // Connecting the title feature
        $header_width = 1440;
        if ( get_theme_mod( 'badoblog_cus_lay_max_width', '1560' ) != '1560' ) {
            $header_width = 2500;
        }
        add_theme_support( 'custom-header', apply_filters( 'badoblog_custom_header_args', array(
            'default-text-color' => '',
            'width'              => $header_width,
            'height'             => 250,
            'flex-height'        => true,
            'flex-width'         => true,
        ) ) );
        // Set to 1 to disable width 1920 x 1080
        $width_full_off = 0;
        // Setting the maximum width of images
        global $content_width;
        if ( !isset( $content_width ) ) {
            if ( $width_full_off == 0 ) {
                $content_width = 1920;
            } else {
                $content_width = 1440;
            }
        }
        // Slicing images to different sizes
        $add = 'add_image_size';
        $img = 'badoblog-img-';
        if ( get_option( 'badoblog_set_size_imgs_all' ) != 2 ) {
            $add(
                $img . '112x63',
                112,
                63,
                true
            );
            $add(
                $img . '160x90',
                160,
                90,
                true
            );
            $add(
                $img . '208x117',
                208,
                117,
                true
            );
            $add(
                $img . '256x144',
                256,
                144,
                true
            );
            $add(
                $img . '272x153',
                272,
                153,
                true
            );
            $add(
                $img . '300x169',
                300,
                169,
                true
            );
            $add(
                $img . '320x180',
                320,
                180,
                true
            );
            $add(
                $img . '384x216',
                384,
                216,
                true
            );
            $add(
                $img . '464x261',
                464,
                261,
                true
            );
            $add(
                $img . '560x315',
                560,
                315,
                true
            );
            $add(
                $img . '688x387',
                688,
                387,
                true
            );
            $add(
                $img . '960x540',
                960,
                540,
                true
            );
            $add(
                $img . '1440x810',
                1440,
                810,
                true
            );
            if ( $width_full_off == 0 ) {
                $add(
                    $img . '1920x1080',
                    1920,
                    1080,
                    true
                );
            }
        }
    }

    add_action( 'after_setup_theme', 'badoblog_fun_setup_theme' );
}
//----------------------------------------------------------------------------------
//region Image Sizes
//----------------------------------------------------------------------------------
// Removing extra image sizes (at the user's request)
if ( get_option( 'badoblog_set_width_2560_del' ) == 1 ) {
    add_filter( 'big_image_size_threshold', '__return_zero' );
}
if ( get_option( 'badoblog_set_width_2048_del' ) == 1 ) {
    add_filter( 'intermediate_image_sizes_advanced', 'badoblog_fun_del_2048_img' );
    function badoblog_fun_del_2048_img(  $sizes  ) {
        unset($sizes['2048x2048']);
        return $sizes;
    }

}
if ( get_option( 'badoblog_set_width_1536_del' ) == 1 ) {
    add_filter( 'intermediate_image_sizes_advanced', 'badoblog_fun_del_1536_img' );
    function badoblog_fun_del_1536_img(  $sizes  ) {
        unset($sizes['1536x1536']);
        return $sizes;
    }

}
if ( get_option( 'badoblog_set_width_768_del' ) == 1 ) {
    add_filter( 'intermediate_image_sizes_advanced', 'badoblog_fun_del_768_img' );
    function badoblog_fun_del_768_img(  $sizes  ) {
        unset($sizes['medium_large']);
        return $sizes;
    }

}
// Adding image sizes to the library
add_filter( 'image_size_names_choose', 'badoblog_fun_new_img_sizes' );
function badoblog_fun_new_img_sizes(  $sizes  ) {
    $addsizes = array(
        'badoblog-img-688x387'  => esc_html__( 'Theme', 'bado-blog' ),
        'badoblog-img-960x540'  => esc_html__( 'Theme', 'bado-blog' ),
        'badoblog-img-1440x810' => esc_html__( 'Theme', 'bado-blog' ),
    );
    return array_merge( $sizes, $addsizes );
}

//----------------------------------------------------------------------------------
//region Register Sidebars
//----------------------------------------------------------------------------------
// Registering widget areas
function badoblog_fun_widgets_init() {
    $sup = '';
    $h_block = get_theme_mod( 'badoblog_cus_widget_h_block', 1 );
    if ( $h_block == 1 ) {
        $sup = 'ab-sup-widget-block';
    }
    $box = 'widget-block-box';
    if ( function_exists( 'is_woocommerce' ) ) {
        $box = '';
    }
    $mes_sb = esc_html__( 'Side column', 'bado-blog' );
    $mes_pp = esc_html__( 'These widgets are displayed when the corresponding template is selected in the record or page properties', 'bado-blog' );
    register_sidebar( array(
        'name'          => $mes_sb . ' (' . esc_html__( 'default', 'bado-blog' ) . ')',
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'These widgets are displayed in the right or left column, depending on the site settings', 'bado-blog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $box . ' ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => $mes_sb . ' (' . esc_html__( 'posts', 'bado-blog' ) . ')',
        'id'            => 'sidebar-post',
        'description'   => sprintf( esc_html__( 'Widgets added to this sidebar will appear only on %1$s %2$s. If this sidebar is empty, the default sidebar widgets will be displayed on %1$s %2$s.', 'bado-blog' ), 'post', 'pages' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $box . ' ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => $mes_sb . ' (' . esc_html__( 'pages', 'bado-blog' ) . ')',
        'id'            => 'sidebar-page',
        'description'   => sprintf( esc_html__( 'Widgets added to this sidebar will appear only on %1$s %2$s. If this sidebar is empty, the default sidebar widgets will be displayed on %1$s %2$s.', 'bado-blog' ), 'static', 'pages' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $box . ' ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => $mes_sb . ' (' . esc_html__( 'home', 'bado-blog' ) . ')',
        'id'            => 'sidebar-home',
        'description'   => sprintf( esc_html__( 'Widgets added to this sidebar will appear only on %1$s %2$s. If this sidebar is empty, the default sidebar widgets will be displayed on %1$s %2$s.', 'bado-blog' ), 'home', 'page' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $box . ' ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => $mes_sb . ' (' . esc_html__( 'featured', 'bado-blog' ) . ' 1)',
        'id'            => 'sidebar-featured-1',
        'description'   => $mes_pp,
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $box . ' ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => $mes_sb . ' (' . esc_html__( 'featured', 'bado-blog' ) . ' 2)',
        'id'            => 'sidebar-featured-2',
        'description'   => $mes_pp,
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $box . ' ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer', 'bado-blog' ) . ' 1',
        'id'            => 'sidebar-footer-one',
        'description'   => sprintf( esc_html__( 'These widgets are displayed in the %s column of the footer', 'bado-blog' ), '1' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer', 'bado-blog' ) . ' 2',
        'id'            => 'sidebar-footer-two',
        'description'   => sprintf( esc_html__( 'These widgets are displayed in the %s column of the footer', 'bado-blog' ), '2' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer', 'bado-blog' ) . ' 3',
        'id'            => 'sidebar-footer-three',
        'description'   => sprintf( esc_html__( 'These widgets are displayed in the %s column of the footer', 'bado-blog' ), '3' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer', 'bado-blog' ) . ' 4',
        'id'            => 'sidebar-footer-four',
        'description'   => sprintf( esc_html__( 'These widgets are displayed in the %s column of the footer', 'bado-blog' ), '4' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s ' . $sup . '">',
        'after_widget'  => '</section>',
        'before_title'  => '<div class="widget-title">',
        'after_title'   => '</div>',
    ) );
}

add_action( 'widgets_init', 'badoblog_fun_widgets_init' );
//----------------------------------------------------------------------------------
//region Filling
//----------------------------------------------------------------------------------
// Filling in social links
function badoblog_fun_add_theme_soc() {
    set_theme_mod( 'badoblog_cus_soc_block', '[
			{"soc_net":"facebook","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"instagram","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"linkedin","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"youtube","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"skype","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"telegram","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"tiktok","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"wechat","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"twitterx","soc_link":"/","soc_new_link":"0"},
			{"soc_net":"whatsapp","soc_link":"/","soc_new_link":"0"}
	]' );
}

$fr = get_option( 'badoblog_set_update_theme_set_fr' );
if ( $fr != 2 ) {
    // Adding settings when the theme is activated
    function badoblog_fun_update_theme_settings_fr() {
        badoblog_fun_add_theme_soc();
        update_option( 'badoblog_set_update_theme_set_fr', 2 );
    }

    add_action( 'after_switch_theme', 'badoblog_fun_update_theme_settings_fr' );
}
//----------------------------------------------------------------------------------
//region Scripts & styles
//----------------------------------------------------------------------------------
// Connecting scripts and styles
function badoblog_fun_scripts() {
    // Basic style file
    wp_enqueue_style(
        'badoblog-style-general',
        get_stylesheet_uri(),
        array(),
        BADOBLOG_VERSION
    );
    // Customizer styles
    wp_enqueue_style(
        'badoblog-style-custom',
        get_template_directory_uri() . '/css/custom-style.css',
        array(),
        BADOBLOG_VERSION
    );
    // Styles for WooCommerce
    if ( class_exists( 'woocommerce' ) ) {
        wp_enqueue_style(
            'badoblog-style-woo',
            get_template_directory_uri() . '/css/adaptation/woo-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Styles for WPML
    if ( class_exists( 'SitePress' ) ) {
        wp_enqueue_style(
            'badoblog-style-wpml',
            get_template_directory_uri() . '/css/adaptation/wpml-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Styles for Jetpack
    if ( class_exists( 'Jetpack' ) ) {
        wp_enqueue_style(
            'badoblog-style-jetpack',
            get_template_directory_uri() . '/css/adaptation/jetpack-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Styles for bbPress
    if ( class_exists( 'bbpress' ) ) {
        wp_enqueue_style(
            'badoblog-style-bbpress',
            get_template_directory_uri() . '/css/adaptation/bbpress-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Styles for BuddyPress
    if ( class_exists( 'BuddyPress' ) ) {
        wp_enqueue_style(
            'badoblog-style-buddypress',
            get_template_directory_uri() . '/css/adaptation/buddypress-style.css',
            array(),
            BADOBLOG_VERSION
        );
        if ( get_theme_mod( 'badoblog_cus_buddypress_css_off', 0 ) == 0 ) {
            wp_enqueue_style(
                'badoblog-style-buddypress-fix',
                get_template_directory_uri() . '/css/adaptation/buddypress-fix-style.css',
                array(),
                BADOBLOG_VERSION
            );
        }
    }
    // Styles for Events Calendar
    if ( class_exists( 'Tribe__Events__Main' ) || class_exists( 'Tribe__Events__Pro__Main' ) ) {
        wp_enqueue_style(
            'badoblog-style-events-calendar',
            get_template_directory_uri() . '/css/adaptation/events-calendar-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Styles for Contact Form 7
    if ( class_exists( 'wpcf7' ) ) {
        wp_enqueue_style(
            'badoblog-style-contact-form-7',
            get_template_directory_uri() . '/css/adaptation/contact-form-7-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Styles for for Elementor
    if ( class_exists( 'Elementor\\Plugin' ) ) {
        wp_enqueue_style(
            'badoblog-style-elementor',
            get_template_directory_uri() . '/css/adaptation/elementor-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Styles for for Newsletter
    if ( class_exists( 'Newsletter' ) ) {
        wp_enqueue_style(
            'badoblog-style-newsletter',
            get_template_directory_uri() . '/css/adaptation/newsletter.css',
            array(),
            BADOBLOG_VERSION
        );
    }
    // Woo
    if ( class_exists( 'woocommerce' ) ) {
        wp_register_script(
            'badoblog-script-woo',
            get_template_directory_uri() . '/js/woo.js',
            array('jquery'),
            BADOBLOG_VERSION,
            true
        );
    }
    // Customizable SELECT
    if ( get_theme_mod( 'badoblog_cus_speed_chosen_none', 0 ) != 1 ) {
        wp_enqueue_style(
            'badoblog-style-chosen-mod',
            get_template_directory_uri() . '/css/chosen/chosen-mod.css',
            array(),
            BADOBLOG_VERSION
        );
        wp_enqueue_script(
            'chosen-js',
            get_template_directory_uri() . '/js/chosen/chosen.jquery.' . BADOBLOG_MIN . 'js',
            array('jquery'),
            '1.8.7',
            true
        );
        wp_enqueue_script(
            'badoblog-script-setting-chosen',
            get_template_directory_uri() . '/js/chosen/setting-chosen.js',
            array('jquery'),
            BADOBLOG_VERSION,
            true
        );
        wp_localize_script( 'badoblog-script-setting-chosen', 'badoblog_localize_chosen', array(
            'nonce_default'  => esc_html__( "Nothing found:", 'bado-blog' ),
            'nonce_woo_sort' => esc_html__( "No sorting", 'bado-blog' ),
        ) );
    }
    // Calm blocks (Fluently movement of blocks)
    if ( get_theme_mod( 'badoblog_cus_flow_block', 0 ) == 1 ) {
        wp_enqueue_script(
            'badoblog-script-flow-block',
            get_template_directory_uri() . '/js/flow-block.js',
            array(),
            BADOBLOG_VERSION,
            true
        );
    }
    // Search
    if ( get_theme_mod( 'badoblog_cus_search', 'top-bar' ) != 'off' ) {
        wp_enqueue_script(
            'badoblog-script-top-search',
            get_template_directory_uri() . '/js/search/search.' . BADOBLOG_MIN . 'js',
            array(),
            BADOBLOG_VERSION,
            true
        );
    }
    // Top menu
    if ( get_theme_mod( 'badoblog_cus_top_menu', 0 ) != 1 ) {
        if ( get_theme_mod( 'badoblog_cus_top_menu_version', 'js' ) == 'js' ) {
            wp_enqueue_script(
                'badoblog-script-topmenu',
                get_template_directory_uri() . '/js/topmenu/topmenu.' . BADOBLOG_MIN . 'js',
                array('jquery'),
                BADOBLOG_VERSION,
                true
            );
            wp_enqueue_script(
                'badoblog-script-modal',
                get_template_directory_uri() . '/js/topmenu/modal.' . BADOBLOG_MIN . 'js',
                array(),
                BADOBLOG_VERSION,
                true
            );
        }
    }
    // Mega menu
    if ( get_theme_mod( 'badoblog_cus_main_menu', 0 ) != 1 ) {
        wp_enqueue_script(
            'badoblog-script-megamenu',
            get_template_directory_uri() . '/js/megamenu/megamenu.' . BADOBLOG_MIN . 'js',
            array('jquery'),
            BADOBLOG_VERSION,
            true
        );
        wp_localize_script( 'badoblog-script-megamenu', 'badoblog_localize_megamenu', array(
            'title_mobile' => esc_html__( "MENU", 'bado-blog' ),
        ) );
        // Fixed menu
        if ( get_theme_mod( 'badoblog_cus_main_menu_fix', 0 ) == 1 ) {
            wp_enqueue_script(
                'badoblog-script-fixmenu',
                get_template_directory_uri() . '/js/fixmenu.js',
                array('jquery'),
                BADOBLOG_VERSION,
                true
            );
        }
    }
    // Meta tax (post)
    wp_register_script(
        'badoblog-script-meta-tax-post',
        get_template_directory_uri() . '/js/meta-tax-post.js',
        array('jquery'),
        BADOBLOG_VERSION,
        true
    );
    // Connects comment-reply.js (moves the form for adding a comment under the comment, in which we clicked on the link - answer)
    if ( get_theme_mod( 'badoblog_cus_speed_comment_reply_none', 0 ) != 1 ) {
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }
    // Fonts
    $font_1 = esc_attr( get_theme_mod( 'badoblog_cus_typography_font', 'off' ) );
    if ( $font_1 !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-general', get_template_directory_uri() . '/fonts/' . $font_1 . '/font.css' );
    }
    $font_h = esc_attr( get_theme_mod( 'badoblog_cus_typography_h_font', 'off' ) );
    if ( $font_h !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-h', get_template_directory_uri() . '/fonts/' . $font_h . '/font.css' );
    }
    $site_h_font = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_h_font', 'off' ) );
    if ( $site_h_font !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-site-h', get_template_directory_uri() . '/fonts/' . $site_h_font . '/font.css' );
    }
    $site_des_font = esc_attr( get_theme_mod( 'badoblog_cus_title_tagline_des_font', 'off' ) );
    if ( $site_des_font !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-site-des', get_template_directory_uri() . '/fonts/' . $site_des_font . '/font.css' );
    }
    $h1_post_font = esc_attr( get_theme_mod( 'badoblog_cus_post_h1_font', 'off' ) );
    if ( $h1_post_font !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-h1-post', get_template_directory_uri() . '/fonts/' . $h1_post_font . '/font.css' );
    }
    $h2_post_font = esc_attr( get_theme_mod( 'badoblog_cus_post_h2_font', 'off' ) );
    if ( $h2_post_font !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-h2-post', get_template_directory_uri() . '/fonts/' . $h2_post_font . '/font.css' );
    }
    $h36_post_font = esc_attr( get_theme_mod( 'badoblog_cus_post_h36_font', 'off' ) );
    if ( $h36_post_font !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-h36-post', get_template_directory_uri() . '/fonts/' . $h36_post_font . '/font.css' );
    }
    $font_menu = esc_attr( get_theme_mod( 'badoblog_cus_main_menu_font', 'off' ) );
    if ( $font_menu !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-menu', get_template_directory_uri() . '/fonts/' . $font_menu . '/font.css' );
    }
    $font_h_sidebar = esc_attr( get_theme_mod( 'badoblog_cus_sidebar_h_font', 'off' ) );
    if ( $font_h_sidebar !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-h-sidebar', get_template_directory_uri() . '/fonts/' . $font_h_sidebar . '/font.css' );
    }
    $font_h_widget = esc_attr( get_theme_mod( 'badoblog_cus_footer_widget_h_font', 'off' ) );
    if ( $font_h_widget !== 'off' ) {
        wp_enqueue_style( 'badoblog-style-font-h-widget', get_template_directory_uri() . '/fonts/' . $font_h_widget . '/font.css' );
    }
}

add_action( 'wp_enqueue_scripts', 'badoblog_fun_scripts', 1 );
//----------------------------------------------------------------------------------
//region Admin panel
//----------------------------------------------------------------------------------
if ( is_admin() ) {
    // Connecting styles for the admin panel
    function badoblog_fun_admin_scripts() {
        // Connection JQuery
        wp_enqueue_script( 'jquery' );
        // Style file for admin panel
        wp_enqueue_style(
            'badoblog-style-admin',
            get_template_directory_uri() . '/css/admin/admin-style.css',
            array(),
            BADOBLOG_VERSION
        );
    }

    add_action( 'admin_enqueue_scripts', 'badoblog_fun_admin_scripts' );
    // Connecting theme settings pages
    require get_template_directory() . '/inc/option/set.php';
    // Connecting theme settings hooks
    require get_template_directory() . '/inc/option/hook.php';
    // Connecting Usability
    if ( file_exists( get_template_directory() . '/inc/admin/help_usability.php' ) ) {
        require get_template_directory() . '/inc/admin/help_usability.php';
    }
    // Connecting TGM plugin
    if ( file_exists( get_template_directory() . '/vendor/tgm/tgm.php' ) ) {
        require get_template_directory() . '/vendor/tgm/tgm.php';
    }
    // Admin notices (WPTRT)
    function badoblog_fun_admin_notices() {
        // Connecting classes
        if ( !class_exists( 'WPTRT\\AdminNotices\\Notices' ) ) {
            require_once get_template_directory() . '/inc/wptrt/src/Dismiss.php';
            require_once get_template_directory() . '/inc/wptrt/src/Notice.php';
            require_once get_template_directory() . '/inc/wptrt/src/Notices.php';
        }
        if ( class_exists( 'WPTRT\\AdminNotices\\Notices' ) ) {
            $theme_notice = new \WPTRT\AdminNotices\Notices();
            // Time delayed message (2 day)
            $mes2day = false;
            $moment = wp_date( 'U' );
            $time_set = get_option( 'badoblog_set_admin_start' );
            if ( !$time_set ) {
                update_option( 'badoblog_set_admin_start', $moment );
            } else {
                $delay_time = $time_set + 172800;
                if ( $moment > $delay_time ) {
                    $mes2day = true;
                }
            }
            // Text free 1
            $admin_text_free_1 = sprintf( esc_html__( 'Congratulations! You have activated the theme %s', 'bado-blog' ), BADOBLOG_NAME ) . '<br>' . esc_html__( 'This is the most customizable theme out of the customizable themes', 'bado-blog' ) . '<br>' . '<a href="' . admin_url( 'themes.php?page=dmcwzmulti_page_settings&tab=general-tab' ) . '" target="_blank">' . esc_html__( 'Open settings', 'bado-blog' ) . '</a>';
            $theme_notice->add( 'badoblog_notice_free_1', '', $admin_text_free_1 );
            // Text free 2
            if ( $mes2day ) {
                $admin_title_free_2 = esc_html__( 'Hello!', 'bado-blog' );
                $admin_text_free_2 = sprintf( esc_html__( 'This is theme developer %s. I improving and maintaining the theme on my own.', 'bado-blog' ), BADOBLOG_NAME ) . '<br>' . esc_html__( 'I would be very grateful if you would report any errors or poor quality translations.', 'bado-blog' ) . '<br>' . esc_html__( 'Contacts can be found in the section - Appearance', 'bado-blog' ) . ' - ' . BADOBLOG_NAME . ' - <a href="' . admin_url( 'themes.php?page=dmcwzmulti_page_settings&tab=support-tab' ) . '" target="_blank">' . esc_html__( 'Information', 'bado-blog' ) . '</a><br><br>' . esc_html__( 'I also remind you that I have a premium version, which contains even more functionality', 'bado-blog' ) . ' - <a href="' . esc_url( '//web-zone.org/bado-blog/premium' ) . '" target="_blank">' . esc_html__( 'Presentation page', 'bado-blog' ) . '</a>' . ' <a href="' . admin_url( 'themes.php?page=dmcwzmulti_page_settings-pricing' ) . '">' . esc_html__( 'View price', 'bado-blog' ) . '</a>';
                $theme_notice->add( 'badoblog_notice_free_2', $admin_title_free_2, $admin_text_free_2 );
            }
            // We start processing (WPTRT)
            $theme_notice->boot();
        }
    }

    add_action( 'admin_init', 'badoblog_fun_admin_notices' );
}
//----------------------------------------------------------------------------------
//region Customizer
//----------------------------------------------------------------------------------
if ( is_customize_preview() ) {
    // Customizer panel scripts
    function badoblog_fun_customize_scripts() {
        // Scripts for panel
        wp_enqueue_script(
            'badoblog-script-customizer-panel-set',
            get_template_directory_uri() . '/js/admin/customizer-panel-set.js',
            array('jquery'),
            BADOBLOG_VERSION,
            true
        );
        wp_enqueue_script(
            'badoblog-script-customizer-panel-elastic',
            get_template_directory_uri() . '/js/admin/customizer-panel-elastic.js',
            array('jquery'),
            BADOBLOG_VERSION,
            true
        );
        // Scripts for soc
        if ( has_filter( 'dmcwzmulti_filter_soc_onlyp_form' ) ) {
            if ( function_exists( 'badoblog_fun_soc_arr_for_script' ) ) {
                $form_design = badoblog_fun_soc_arr_for_script( 'design' );
                $form_net = badoblog_fun_soc_arr_for_script( 'net' );
                wp_enqueue_script(
                    'badoblog-script-customizer-soc',
                    get_template_directory_uri() . '/js/admin/customizer-soc.js',
                    array('jquery'),
                    BADOBLOG_VERSION,
                    true
                );
                wp_add_inline_script( 'badoblog-script-customizer-soc', 'const dChoices = ' . wp_json_encode( $form_design ) . '; const fChoices = ' . wp_json_encode( $form_net ) . ';', 'before' );
            }
        }
        // Styles for panel
        wp_enqueue_style(
            'badoblog-style-customizer-panel',
            get_template_directory_uri() . '/css/admin/customizer-panel.css',
            array(),
            BADOBLOG_VERSION
        );
    }

    add_action( 'customize_controls_enqueue_scripts', 'badoblog_fun_customize_scripts' );
    // Customizer preview scripts
    function badoblog_fun_customize_preview_js() {
        wp_enqueue_script(
            'badoblog-script-customizer-preview',
            get_template_directory_uri() . '/js/admin/customizer-preview.js',
            array('customize-preview', 'customize-selective-refresh'),
            BADOBLOG_VERSION,
            true
        );
        wp_enqueue_style(
            'badoblog-style-customizer-preview',
            get_template_directory_uri() . '/css/admin/customizer-preview.css',
            array(),
            BADOBLOG_VERSION
        );
    }

    add_action( 'customize_preview_init', 'badoblog_fun_customize_preview_js' );
    // Functions for customizer panel (general)
    require get_template_directory() . '/inc/admin/function-panel.php';
    // Functions for the customizer panel (social network)
    require get_template_directory() . '/inc/admin/function-panel-soc.php';
    // Customizer settings
    require get_template_directory() . '/inc/admin/customizer.php';
}
//----------------------------------------------------------------------------------
//region Connect Files
//----------------------------------------------------------------------------------
// Theme front customizer functions
require get_template_directory() . '/inc/function-customizer.php';
// Social links
require get_template_directory() . '/inc/module/soc-top.php';
// Posts meta tags
require get_template_directory() . '/inc/module/meta-tags.php';
// Connecting hooks
require get_template_directory() . '/inc/function-hooks.php';
// Connecting Usability
if ( file_exists( get_template_directory() . '/inc/usability.php' ) ) {
    require get_template_directory() . '/inc/usability.php';
}
// Connecting Debug
add_action( 'after_setup_theme', function () {
    $file = get_template_directory() . '/debug.php';
    // File existence
    if ( !file_exists( $file ) || !is_file( $file ) ) {
        return;
    }
    // Limit by size (800 KB)
    $max_size = 800 * 1024;
    if ( filesize( $file ) > $max_size ) {
        return;
    }
    // Checking file validity
    $marker = '<?php // debug';
    $size = strlen( $marker );
    $start = file_get_contents(
        $file,
        false,
        null,
        0,
        $size
    );
    $start = ltrim( $start, "﻿ \t\n\r" );
    if ( strpos( $start, $marker ) !== 0 ) {
        return;
    }
    include_once $file;
}, 5 );
//----------------------------------------------------------------------------------
//region Compatibility plugins
//----------------------------------------------------------------------------------
// Connecting a file with functions for WooCommerce
if ( class_exists( 'woocommerce' ) ) {
    require get_template_directory() . '/inc/adaptation/function-woo.php';
}
// Connecting a file with functions for bbPress
if ( class_exists( 'bbpress' ) ) {
    require get_template_directory() . '/inc/adaptation/function-bbpress.php';
}
// Connecting a file with functions for BuddyPress
if ( class_exists( 'BuddyPress' ) ) {
    require get_template_directory() . '/inc/adaptation/function-buddypress.php';
}
// Connecting a file with functions for Elementor
if ( class_exists( 'Elementor\\Plugin' ) ) {
    require get_template_directory() . '/inc/adaptation/function-elementor.php';
}
// Connecting a file with functions for The Events Calendar
if ( class_exists( 'Tribe__Events__Main' ) || class_exists( 'Tribe__Events__Pro__Main' ) ) {
    require get_template_directory() . '/inc/adaptation/function-events-calendar.php';
}
// Connecting a file with functions for Contact Form 7
if ( class_exists( 'wpcf7' ) ) {
    require get_template_directory() . '/inc/adaptation/function-contact-form-7.php';
}
// Downloading the Jetpack Compatibility File
if ( class_exists( 'Jetpack' ) ) {
    require get_template_directory() . '/inc/adaptation/function-jetpack.php';
}
// Connecting a file with functions for Newsletter
if ( class_exists( 'Newsletter' ) ) {
    require get_template_directory() . '/inc/adaptation/newsletter.php';
}
//----------------------------------------------------------------------------------
//region DMCWebZone plugins compatibility
//----------------------------------------------------------------------------------
// Compatibility widgets dmc
if ( !function_exists( 'dmcwzmulti_fun_widgets_af' ) ) {
    function dmcwzmulti_fun_widgets_af() {
        // Sizes img post bulk
        function dmcwzmulti_fun_widget_post_bulk_img_size() {
            return $ar = [
                's1' => ['112', '63'],
                's2' => ['208', '117'],
                's3' => ['384', '216'],
            ];
        }

        // Sizes img post list
        function dmcwzmulti_fun_widget_post_list_img_size() {
            return $ar = [
                's1' => ['112', '63'],
                's2' => ['112', '63'],
                's3' => ['160', '90'],
            ];
        }

        // Sizes img post list
        function dmcwzmulti_fun_widget_full_img_size() {
            return $ar = [
                's1' => ['384', '216'],
            ];
        }

        // Banner image
        function dmcwzmulti_fun_widget_banner_img() {
            return $banner_url = get_template_directory_uri() . '/img/no-photo/widget-banner.png';
        }

        // Avatar
        function dmcwzmulti_fun_widget_avatar_img() {
            return $avatar_url = get_template_directory_uri() . '/img/avatar/avatar.png';
        }

        // ALT no img
        function dmcwzmulti_fun_widget_alt_noimg() {
            return $alt = get_theme_mod( 'badoblog_cus_seo_alt_nofoto', 'No photo' );
        }

        // Color primary
        function dmcwzmulti_fun_widget_color_primary() {
            return $primary = get_theme_mod( 'badoblog_cus_colors_primary_small', '#4c65ad' );
        }

        // Color text
        function dmcwzmulti_fun_widget_color_text() {
            return $text = get_theme_mod( 'badoblog_cus_colors_text_content', '#404040' );
        }

    }

    dmcwzmulti_fun_widgets_af();
}
//----------------------------------------------------------------------------------
//region Compatibility general
//----------------------------------------------------------------------------------
// Backward compatibility for older versions of WordPress
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }

}
// Fixing issues with remaining post types after disabling the plugins
// Dashboard Activity widget (recent comments) guard for WP versions without comments query filter
function badoblog_fun_dashboard_pre_get_comments_guard(  $query  ) {
    if ( !$query instanceof WP_Comment_Query ) {
        return;
    }
    if ( !isset( $GLOBALS['pagenow'] ) || 'index.php' !== $GLOBALS['pagenow'] ) {
        return;
    }
    $post_types = get_post_types_by_support( 'comments' );
    if ( empty( $post_types ) ) {
        $post_types = array('post');
    }
    $query->query_vars['post_type'] = array_values( $post_types );
}

if ( is_admin() ) {
    add_action( 'pre_get_comments', 'badoblog_fun_dashboard_pre_get_comments_guard', 10 );
}