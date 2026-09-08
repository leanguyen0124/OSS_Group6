<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Theme settings
* ------------------------------------------------------------------------------ */
if ( !function_exists( 'badoblog_fun_general_settings' ) ) {
    function badoblog_fun_general_settings() {
        // Add item menu
        function badoblog_fun_add_theme_settings() {
            add_theme_page(
                // 'main_theme_settings', // Mother page address
                'Pro ' . BADOBLOG_NAME,
                // Page Title
                'Page ' . BADOBLOG_NAME,
                // Menu item name
                'manage_options',
                // Access rights
                'dmcwzmulti_page_settings',
                // Page address
                'badoblog_fun_settings_function',
                // Function name
                20
            );
        }

        add_action( 'admin_menu', 'badoblog_fun_add_theme_settings' );
        // Message about save
        function badoblog_fun_options_notice() {
            if ( isset( $_GET['page'] ) && 'dmcwzmulti_page_settings' == $_GET['page'] && isset( $_GET['settings-updated'] ) && true == $_GET['settings-updated'] ) {
                echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'All settings saved!', 'bado-blog' ) . '</p></div>';
            }
        }

        add_action( 'admin_notices', 'badoblog_fun_options_notice' );
        // Display the options page
        function badoblog_fun_settings_function() {
            ?>
            <div class="wrap">
                <?php 
            // Start page
            $tab = 'support-tab';
            // Which tab is active
            if ( isset( $_GET['tab'] ) ) {
                $tab = $_GET['tab'];
            }
            ?>
                <h1><?php 
            echo esc_html__( 'Pro page', 'bado-blog' ) . ' ' . BADOBLOG_NAME;
            ?></h1>
                
                <!-- Output the tabs -->
                <h2 class="nav-tab-wrapper">
                    <a href="<?php 
            echo esc_url( admin_url( 'themes.php?page=dmcwzmulti_page_settings&tab=general-tab' ) );
            ?>" 
                        class="nav-tab <?php 
            echo esc_attr( ( $tab == 'general-tab' ? 'nav-tab-active' : '' ) );
            ?> "><?php 
            esc_html_e( 'General', 'bado-blog' );
            ?>
                    </a>
                    <?php 
            // Hook for adding new tabs via plugin
            do_action( 'dmcwzmulti_hook_tab_settings' );
            ?>
                    <a href="<?php 
            echo esc_url( admin_url( 'themes.php?page=dmcwzmulti_page_settings&tab=support-tab' ) );
            ?>" 
                        class="nav-tab <?php 
            echo esc_attr( ( $tab == 'support-tab' ? 'nav-tab-active' : '' ) );
            ?> "><?php 
            esc_html_e( 'Information', 'bado-blog' );
            ?>
                    </a>
                    <?php 
            // Hook for adding new tabs after all tabs
            do_action( 'badoblog_hook_tab_settings_after' );
            ?>
                </h2>

                <!-- Output functions -->

                <?php 
            do_action( 'dmcwzmulti_hook_liberty_functions' );
            ?>

                <form action="options.php" method="post">
                    <?php 
            if ( $tab == 'support-tab' ) {
                badoblog_fun_support_tab();
            } else {
                if ( $tab == 'general-tab' ) {
                    badoblog_fun_general_tab();
                } else {
                    settings_fields( $tab );
                    do_settings_sections( $tab );
                    submit_button();
                }
            }
            ?>
                </form>
            </div>
            <?php 
        }

        // function Useful links
        function badoblog_fun_admin_useful_links() {
            echo '
            <div class="badoblog-css-set-admin-info">
                <h2>' . esc_html__( 'Useful links', 'bado-blog' ) . '</h2>
                <p><a href="' . esc_url( '//web-zone.org/documentation/instruction-bado-blog' ) . '" target="_blank">' . sprintf( esc_html__( 'Management and configuration instructions for the %s', 'bado-blog' ), BADOBLOG_NAME ) . '</a></p>
                <p><a href="' . esc_url( '//web-zone.org/category/themes/bado-blog' ) . '" target="_blank">' . sprintf( esc_html__( 'Information materials for the %s', 'bado-blog' ), BADOBLOG_NAME ) . '</a></p>
                <p><a href="' . esc_url( '//badoblog.web-zone.org/demo-0' ) . '" target="_blank">' . esc_html__( 'Watch live sites demos', 'bado-blog' ) . '</a></p>
                <p><a href="' . esc_url( '//web-zone.org/updates/bado-blog-theme-updates' ) . '" target="_blank">' . sprintf( esc_html__( 'List of updates for the %s', 'bado-blog' ), BADOBLOG_NAME ) . '</a></p>
                <p><a href="' . esc_url( '//wordpress.org/support/theme/bado-blog/reviews/' ) . '" target="_blank">' . esc_html__( 'Rate this theme', 'bado-blog' ) . '</a></p>
            </div>
            ';
        }

        // support-tab content
        function badoblog_fun_support_tab() {
            echo '<div class="badoblog-css-set-admin-content-box">';
            echo '<div class="badoblog-css-set-admin-primary">';
            // Comparison of Versions
            if ( function_exists( 'badoblog_fun_pr_set_info_comparison' ) ) {
                echo badoblog_fun_pr_set_info_comparison();
            }
            echo '</div>';
            echo '<div class="badoblog-css-set-admin-sidebar">';
            // Support
            echo '<div class="badoblog-css-set-admin-info">';
            settings_fields( 'support-tab' );
            do_settings_sections( 'support-tab' );
            echo '</div>';
            // Soc support
            if ( function_exists( 'badoblog_fun_admin_soc_sup_links' ) ) {
                badoblog_fun_admin_soc_sup_links();
            }
            // Info
            badoblog_fun_admin_useful_links();
            echo '</div>';
            echo '</div>';
        }

        // general-tab content
        function badoblog_fun_general_tab() {
            $customize_url = admin_url( 'customize.php?return=%2Fwp-admin%2Fthemes.php%3Fpage%3Ddmcwzmulti_page_settings' );
            echo '<div class="badoblog-css-set-admin-content-box">';
            echo '<div class="badoblog-css-set-admin-primary">';
            // Quick links to settings
            echo '<div class="badoblog-css-set-admin-customize">';
            echo '<div class="badoblog-css-set-admin-customize-mes">';
            echo esc_html__( 'All settings of the front part of the theme are located in the visual editor', 'bado-blog' );
            echo ' &raquo; <a href="' . esc_url( $customize_url ) . '">' . esc_html__( 'Open', 'bado-blog' ) . '</a>';
            echo '</div>';
            echo '<h2>' . esc_html__( 'Visual Customizer Quick Links', 'bado-blog' ) . '</h2>';
            echo '<div class="badoblog-css-set-admin-customize-grid">';
            $url_lay = admin_url( 'customize.php?autofocus[control]=badoblog_cus_lay_all' );
            echo '<a href="' . esc_url( $url_lay ) . '">' . esc_html__( 'Template orientation', 'bado-blog' ) . '</a>';
            $url_color = admin_url( 'customize.php?autofocus[control]=badoblog_cus_colors_primary_small' );
            echo '<a href="' . esc_url( $url_color ) . '">' . esc_html__( 'Common colors', 'bado-blog' ) . '</a>';
            $url_font = admin_url( 'customize.php?autofocus[control]=badoblog_cus_typography_font' );
            echo '<a href="' . esc_url( $url_font ) . '">' . esc_html__( 'General typography', 'bado-blog' ) . '</a>';
            $url_logo = admin_url( 'customize.php?autofocus[control]=display_header_text' );
            echo '<a href="' . esc_url( $url_logo ) . '">' . esc_html__( 'Title and logo', 'bado-blog' ) . '</a>';
            $url_top_menu = admin_url( 'customize.php?autofocus[control]=badoblog_cus_top_menu_size' );
            echo '<a href="' . esc_url( $url_top_menu ) . '">' . esc_html__( 'Top menu', 'bado-blog' ) . '</a>';
            $url_main_menu = admin_url( 'customize.php?autofocus[control]=badoblog_cus_main_menu_full_width' );
            echo '<a href="' . esc_url( $url_main_menu ) . '">' . esc_html__( 'Main menu', 'bado-blog' ) . '</a>';
            $url_soc = admin_url( 'customize.php?autofocus[control]=badoblog_cus_soc' );
            echo '<a href="' . esc_url( $url_soc ) . '">' . esc_html__( 'Social links', 'bado-blog' ) . '</a>';
            $url_widget = admin_url( 'customize.php?autofocus[control]=badoblog_cus_sidebar_design' );
            echo '<a href="' . esc_url( $url_widget ) . '">' . esc_html__( 'Sidebar settings', 'bado-blog' ) . '</a>';
            $url_cat = admin_url( 'customize.php?autofocus[panel]=badoblog_cus_panel_cat' );
            echo '<a href="' . esc_url( $url_cat ) . '">' . esc_html__( 'Categories', 'bado-blog' ) . '</a>';
            $url_post = admin_url( 'customize.php?autofocus[panel]=badoblog_cus_panel_post' );
            echo '<a href="' . esc_url( $url_post ) . '">' . esc_html__( 'Posts and pages', 'bado-blog' ) . '</a>';
            $url_main = admin_url( 'customize.php?autofocus[panel]=badoblog_cus_panel_top' );
            echo '<a href="' . esc_url( $url_main ) . '">' . esc_html__( 'Top part', 'bado-blog' ) . '</a>';
            $url_footer = admin_url( 'customize.php?autofocus[control]=badoblog_cus_footer_full' );
            echo '<a href="' . esc_url( $url_footer ) . '">' . esc_html__( 'Bottom part', 'bado-blog' ) . '</a>';
            echo '</div>';
            echo '</div>';
            // Expert settings
            echo '<div class="badoblog-css-set-admin-expert">';
            echo '<h2>' . esc_html__( 'Expert settings of the administrative part of the theme', 'bado-blog' ) . '</h2>';
            settings_fields( 'general-tab' );
            do_settings_sections( 'general-tab' );
            submit_button();
            echo '</div>';
            echo '</div>';
            echo '<div class="badoblog-css-set-admin-sidebar">';
            // Comparison of Versions
            if ( function_exists( 'badoblog_fun_pr_set_general_comparison' ) ) {
                echo badoblog_fun_pr_set_general_comparison();
            }
            // Info
            badoblog_fun_admin_useful_links();
            echo '</div>';
            echo '</div>';
        }

        // Display scripts only on page (and tabs) dmcwzmulti_page_settings
        // Per WordPress rules - use $hook_suffix
        // info - developer.wordpress.org/reference/hooks/admin_footer-hook_suffix/
        // The page is defined as - appearance_page_dmcwzmulti_page_settings
        function badoblog_fun_admin_set_page_scripts(  $hook_suffix  ) {
            $tab_page = array(
                'appearance_page_dmcwzmulti_page_settings',
                'appearance_page_dmcwzmulti_page_settings-affiliation',
                'appearance_page_dmcwzmulti_page_settings-account',
                'appearance_page_dmcwzmulti_page_settings-contact',
                'appearance_page_dmcwzmulti_page_settings-addons',
                'appearance_page_dmcwzmulti_page_settings-pricing'
            );
            if ( !in_array( $hook_suffix, $tab_page ) ) {
                return;
            }
            // Style file for admin set page
            wp_enqueue_style(
                'badoblog-style-admin-set',
                get_template_directory_uri() . '/css/admin/admin-set-style.css',
                array(),
                BADOBLOG_VERSION
            );
        }

        add_action( 'admin_enqueue_scripts', 'badoblog_fun_admin_set_page_scripts' );
    }

    badoblog_fun_general_settings();
}
// Registration, adding settings and sections
function badoblog_fun_theme_settings() {
    // Section - Support
    if ( !defined( 'DMCWZAF_VERSION' ) ) {
        add_settings_section(
            'badoblog_set_section_support_contact',
            esc_html__( 'Technical support', 'bado-blog' ),
            'badoblog_fun_callback_support_contact',
            'support-tab'
        );
    }
    // ------------------------------------------------------------
    // Images format
    // ------------------------------------------------------------
    // Section
    add_settings_section(
        'badoblog_set_section_img_all',
        '<hr><h3>' . esc_html__( 'Images format', 'bado-blog' ) . '</h3>',
        '',
        'general-tab'
    );
    // Setting the size of the main image of posts and pages (width)
    add_settings_field(
        'badoblog_set_size_imgs_all',
        esc_html__( 'Choose which images to use for the entire site', 'bado-blog' ),
        'badoblog_fun_callback_size_img_all',
        'general-tab',
        'badoblog_set_section_img_all'
    );
    register_setting( 'general-tab', 'badoblog_set_size_imgs_all' );
}

add_action( 'admin_init', 'badoblog_fun_theme_settings' );
// ------------------------------------------------------------
// CALLBACK - Support links
// ------------------------------------------------------------
// Support
if ( !defined( 'DMCWZAF_VERSION' ) ) {
    function badoblog_fun_callback_support_contact() {
        echo '<p>Site: <a target="_blank" href="' . esc_url( 'https://support.web-zone.org' ) . '" >support.web-zone.org</a></p>';
        echo '<p>Email: support@web-zone.org</p>';
    }

}
// ------------------------------------------------------------
// CALLBACK - Images format
// ------------------------------------------------------------
function badoblog_fun_callback_size_img_all() {
    $opt = get_option( 'badoblog_set_size_imgs_all' );
    echo '<p>' . esc_html__( 'The theme creates multiple thumbnail sizes in a single 16x9 format and uses optimal sizes in the right places. This has a good effect on loading speed and proper display in a unified style.', 'bado-blog' ) . '</p><p>' . esc_html__( 'You can change this setting to control the size of the images yourself.', 'bado-blog' ) . '</p><br><input type="radio" id="badoblog_set_size_imgs_all_1" name="badoblog_set_size_imgs_all" value="1"' . checked( 1, $opt, false ) . ' checked/>
        <label for="badoblog_set_size_imgs_all_1">' . sprintf( esc_html__( '%s sizes', 'bado-blog' ), BADOBLOG_NAME ) . '</label><br><br>
        <input type="radio" id="badoblog_set_size_imgs_all_2" name="badoblog_set_size_imgs_all" value="2"' . checked( 2, $opt, false ) . '/>
        <label for="badoblog_set_size_imgs_all_2">' . sprintf( esc_html__( '%s sizes', 'bado-blog' ), 'WordPress' ) . '</label><br><br><p>' . sprintf( esc_html__( 'It is important to know! These settings cannot delete or modify existing image files. Slicing of images occurs at the time of uploading a new image to the %s media library.', 'bado-blog' ), 'WordPress' ) . '</p><p>' . esc_html__( 'To change old pictures, use the thumbnail regeneration plugin.', 'bado-blog' ) . '</p>
    ';
}
