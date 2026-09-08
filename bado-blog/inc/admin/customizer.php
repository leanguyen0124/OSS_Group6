<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Customizer
* ------------------------------------------------------------------------------ */
function badoblog_fun_customize_register(  $wp_customize  ) {
    // Variables for translations of static words
    $bw = 'Block Widgets';
    // Duplicate translations
    $mes_adv = sprintf( esc_html__( 'Advanced settings (%s)', 'bado-blog' ), BADOBLOG_NAME );
    $mes_def_1 = esc_html__( 'default', 'bado-blog' );
    $mes_def_2 = ' (' . esc_html__( 'Default', 'bado-blog' ) . ')';
    $mes_hover = ' (' . esc_html__( 'on hover', 'bado-blog' ) . ')';
    // -----------------  Font array
    $badoblog_font = array(
        'off'        => $mes_def_1,
        'bad-script' => 'Bad Script (italic)',
        'bitter'     => 'Bitter',
        'charis-sil' => 'Charis SIL',
        'cuprum'     => 'Cuprum',
        'exo-2'      => 'Exo 2',
        'jost'       => 'Jost',
        'open-sans'  => 'Open Sans (default)',
        'oswald'     => 'Oswald',
        'play'       => 'Play',
        'roboto'     => 'Roboto',
        'ubuntu'     => 'Ubuntu',
    );
    // Dividing lines
    if ( !function_exists( 'badoblog_fun_panel_line' ) ) {
        function badoblog_fun_panel_line() {
            echo '<hr>';
        }

    }
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Template orientation
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - Template orientation
    $wp_customize->add_section( 'badoblog_cus_section_lay', array(
        'priority' => 2,
        'title'    => esc_html__( 'Template orientation', 'bado-blog' ),
    ) );
    // -----------------  Sidebar orientation on the entire site
    $wp_customize->add_setting( 'badoblog_cus_lay_all', array(
        'default'           => 'right',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_lay_all', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Sidebar orientation on the entire site', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_lay',
        'settings' => 'badoblog_cus_lay_all',
        'choices'  => array(
            'right'             => esc_html__( 'Right sidebar', 'bado-blog' ),
            'left'              => esc_html__( 'Left sidebar', 'bado-blog' ),
            'no_sidebar_full'   => esc_html__( 'No sidebar (full width)', 'bado-blog' ),
            'no_sidebar_center' => esc_html__( 'No sidebar (center)', 'bado-blog' ),
        ),
    ) );
    // -----------------  Sidebar orientation on main page
    $wp_customize->add_setting( 'badoblog_cus_lay_home', array(
        'default'           => 'right',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_lay_home', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Sidebar orientation on main page', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_lay',
        'settings' => 'badoblog_cus_lay_home',
        'choices'  => array(
            'right'             => esc_html__( 'Right sidebar', 'bado-blog' ),
            'left'              => esc_html__( 'Left sidebar', 'bado-blog' ),
            'no_sidebar_full'   => esc_html__( 'No sidebar (full width)', 'bado-blog' ),
            'no_sidebar_center' => esc_html__( 'No sidebar (center)', 'bado-blog' ),
        ),
    ) );
    // -----------------  Dividing line - Template orientation
    class badoblog_cus_lay_panel_border extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_lay_panel_border', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_lay_panel_border($wp_customize, 'badoblog_cus_lay_set_panel_border', array(
        'section'  => 'badoblog_cus_section_lay',
        'settings' => 'badoblog_cus_lay_panel_border',
    )) );
    // ----------------- Site width
    $wp_customize->add_setting( 'badoblog_cus_lay_max_width', array(
        'default'           => '1560',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_lay_max_width', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Site width', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_lay',
        'settings' => 'badoblog_cus_lay_max_width',
        'choices'  => array(
            '1560' => '1560' . $mes_def_2,
            '1700' => '1700',
            '1850' => '1850',
            'full' => esc_html__( 'Full width', 'bado-blog' ),
        ),
    ) );
    // -----------------  Add margin at the top and bottom of the site
    class badoblog_cus_lay_panel_h_1 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
            ?><br><div class="badoblog-c-panel-text">
		<?php 
            echo esc_html__( 'Add margin at the top and bottom of the site (PC version only)', 'bado-blog' );
            ?></div><?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_lay_panel_h_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_lay_panel_h_1($wp_customize, 'badoblog_cus_lay_set_panel_h_1', array(
        'section'  => 'badoblog_cus_section_lay',
        'settings' => 'badoblog_cus_lay_panel_h_1',
    )) );
    // -----------------  Add margin at the top of the site
    $wp_customize->add_setting( 'badoblog_cus_lay_margin_top', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_lay_margin_top', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Top margin', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_lay',
        'settings' => 'badoblog_cus_lay_margin_top',
        'choices'  => array(
            '0'   => esc_html__( 'Off', 'bado-blog' ),
            '25'  => '25 px',
            '50'  => '50 px',
            '75'  => '75 px',
            '100' => '100 px',
            '125' => '125 px',
            '150' => '150 px',
            '200' => '200 px',
        ),
    ) );
    // -----------------  Add margin at the bottom of the site
    $wp_customize->add_setting( 'badoblog_cus_lay_margin_bottom', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_lay_margin_bottom', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Bottom margin', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_lay',
        'settings' => 'badoblog_cus_lay_margin_bottom',
        'choices'  => array(
            '0'   => esc_html__( 'Off', 'bado-blog' ),
            '25'  => '25 px',
            '50'  => '50 px',
            '75'  => '75 px',
            '100' => '100 px',
            '125' => '125 px',
            '150' => '150 px',
            '200' => '200 px',
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region General colors
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Changing the section name
    $wp_customize->get_section( 'colors' )->title = esc_html__( 'General colors', 'bado-blog' );
    // -----------------  Change partition priority (General colors)
    $wp_customize->get_section( 'colors' )->priority = 4;
    // -----------------  Changing the title of a setting (Background color of the entire area)
    $wp_customize->get_control( 'background_color' )->label = esc_html__( 'Background color of the entire area', 'bado-blog' );
    // -----------------  Changing the setting priority (Background color of the entire area)
    $wp_customize->get_control( 'background_color' )->priority = 50;
    // -----------------  Title 1 - Colors
    class badoblog_cus_colors_panel_text_1 extends WP_Customize_Control {
        function render_content() {
            ?>
			<div class="badoblog-css-panel-help-box">
				<div>
				<?php 
            echo esc_html__( 'This section contains general colors that affect the whole site. After that, you can make additional settings in other sections to specify individual colors for each module.', 'bado-blog' );
            ?>
				</div>
				<?php 
            if ( function_exists( 'badoblog_fun_pr_customize_help_color' ) ) {
                echo badoblog_fun_pr_customize_help_color();
            }
            ?>
			</div>
			<?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_colors_panel_text_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_colors_panel_text_1($wp_customize, 'badoblog_cus_colors_set_panel_text_1', array(
        'section'  => 'colors',
        'settings' => 'badoblog_cus_colors_panel_text_1',
    )) );
    // -----------------  Background color of large elements
    $wp_customize->add_setting( 'badoblog_cus_colors_primary_big', array(
        'default'              => '#505062',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_colors_primary_big', array(
        'label'       => esc_html__( 'Background color of large elements', 'bado-blog' ),
        'description' => esc_html__( '(Titles, breadcrumbs, footer and widget titles)', 'bado-blog' ),
        'section'     => 'colors',
        'settings'    => 'badoblog_cus_colors_primary_big',
    )) );
    // -----------------  Secondary color for large elements
    $wp_customize->add_setting( 'badoblog_cus_colors_primary_big_lite', array(
        'default'              => '#fffffb',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_colors_primary_big_lite', array(
        'label'    => esc_html__( 'Secondary color for large elements', 'bado-blog' ),
        'section'  => 'colors',
        'settings' => 'badoblog_cus_colors_primary_big_lite',
    )) );
    // -----------------  Color of small elements
    $wp_customize->add_setting( 'badoblog_cus_colors_primary_small', array(
        'default'              => '#4c65ad',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_colors_primary_small', array(
        'label'       => esc_html__( 'Color of small elements', 'bado-blog' ),
        'description' => esc_html__( '(Buttons, icons, lines and other design elements)', 'bado-blog' ),
        'section'     => 'colors',
        'settings'    => 'badoblog_cus_colors_primary_small',
    )) );
    // -----------------  Secondary color for small elements
    $wp_customize->add_setting( 'badoblog_cus_colors_primary_small_lite', array(
        'default'              => '#fffffc',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_colors_primary_small_lite', array(
        'label'    => esc_html__( 'Secondary color for small elements', 'bado-blog' ),
        'section'  => 'colors',
        'settings' => 'badoblog_cus_colors_primary_small_lite',
    )) );
    // -----------------  Title - Add colors
    class badoblog_cus_colors_setting_panel_text_add_colors extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_color' ) ) {
                echo badoblog_fun_pr_customize_mes_color();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_colors_setting_panel_text_add_colors', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_colors_setting_panel_text_add_colors($wp_customize, 'badoblog_cus_colors_setting_set_panel_text_add_colors', array(
        'priority' => 200,
        'section'  => 'colors',
        'settings' => 'badoblog_cus_colors_setting_panel_text_add_colors',
    )) );
    // ----------------- Site fill color
    $wp_customize->add_setting( 'badoblog_cus_colors_site_fill', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_colors_site_fill', array(
        'label'    => esc_html__( 'Site fill color', 'bado-blog' ),
        'section'  => 'colors',
        'settings' => 'badoblog_cus_colors_site_fill',
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region General typography
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - General typography
    $wp_customize->add_section( 'badoblog_cus_section_typography', array(
        'priority' => 5,
        'title'    => esc_html__( 'General typography', 'bado-blog' ),
    ) );
    // -----------------  General text font
    $wp_customize->add_setting( 'badoblog_cus_typography_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'General text font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_font',
        'choices'  => $badoblog_font,
    ) );
    // -----------------  Overall text size
    $wp_customize->add_setting( 'badoblog_cus_typography_text_size', array(
        'default'           => 18,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_text_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Overall text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 18 px)',
        'section'     => 'badoblog_cus_section_typography',
        'settings'    => 'badoblog_cus_typography_text_size',
    ) );
    // -----------------  Total line height of text
    $wp_customize->add_setting( 'badoblog_cus_typography_text_height', array(
        'default'           => '1.5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_text_height', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Total line height of text', 'bado-blog' ),
        'description' => '0.8 - 5 (' . $mes_def_1 . ' 1.5)',
        'section'     => 'badoblog_cus_section_typography',
        'settings'    => 'badoblog_cus_typography_text_height',
    ) );
    // -----------------  Dividing line - Template orientation
    class badoblog_cus_typography_panel_border extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_typography_panel_border', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_typography_panel_border($wp_customize, 'badoblog_cus_typography_set_panel_border', array(
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_panel_border',
    )) );
    // -----------------  General heading font
    $wp_customize->add_setting( 'badoblog_cus_typography_h_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'General heading font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h_font',
        'choices'  => $badoblog_font,
    ) );
    // -----------------  Total heading size h1
    $wp_customize->add_setting( 'badoblog_cus_typography_h1_size', array(
        'default'           => 32,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h1_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Total heading size', 'bado-blog' ) . ' H1 (5 - 100 px, ' . $mes_def_1 . ' 32 px)',
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h1_size',
    ) );
    // -----------------  Total heading size h2
    $wp_customize->add_setting( 'badoblog_cus_typography_h2_size', array(
        'default'           => 26,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h2_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Total heading size', 'bado-blog' ) . ' H2 (5 - 100 px, ' . $mes_def_1 . ' 26 px)',
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h2_size',
    ) );
    // -----------------  Total heading size h3
    $wp_customize->add_setting( 'badoblog_cus_typography_h3_size', array(
        'default'           => 24,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h3_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Total heading size', 'bado-blog' ) . ' H3 (5 - 100 px, ' . $mes_def_1 . ' 24 px)',
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h3_size',
    ) );
    // -----------------  Total heading size h4
    $wp_customize->add_setting( 'badoblog_cus_typography_h4_size', array(
        'default'           => 22,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h4_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Total heading size', 'bado-blog' ) . ' H4 (5 - 100 px, ' . $mes_def_1 . ' 22 px)',
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h4_size',
    ) );
    // -----------------  Total heading size h5
    $wp_customize->add_setting( 'badoblog_cus_typography_h5_size', array(
        'default'           => 20,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h5_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Total heading size', 'bado-blog' ) . ' H5 (5 - 100 px, ' . $mes_def_1 . ' 20 px)',
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h5_size',
    ) );
    // -----------------  Total heading size h6
    $wp_customize->add_setting( 'badoblog_cus_typography_h6_size', array(
        'default'           => 18,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h6_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Total heading size', 'bado-blog' ) . ' H6 (5 - 100 px, ' . $mes_def_1 . ' 18 px)',
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h6_size',
    ) );
    // ----------------- Overall titles line height
    $wp_customize->add_setting( 'badoblog_cus_typography_h_height', array(
        'default'           => '1.5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_typography_h_height', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Overall titles line height', 'bado-blog' ) . ' (0.8 - 5, ' . $mes_def_1 . ' 1.5)',
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_typography_h_height',
    ) );
    // -----------------  Title - Add colors for Fonts
    class badoblog_cus_font_setting_panel_text_add_colors extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_font' ) ) {
                echo badoblog_fun_pr_customize_mes_font();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_font_setting_panel_text_add_colors', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_font_setting_panel_text_add_colors($wp_customize, 'badoblog_cus_font_setting_set_panel_text_add_colors', array(
        'priority' => 200,
        'section'  => 'badoblog_cus_section_typography',
        'settings' => 'badoblog_cus_font_setting_panel_text_add_colors',
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part
    	---------------------------------------------------------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'badoblog_cus_panel_top', array(
        'capabitity' => 'edit_theme_options',
        'priority'   => 6,
        'title'      => esc_html__( 'Top part', 'bado-blog' ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Top bar
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Top bar
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_ticker', array(
        'selector' => '.badoblog-css-top-left',
    ) );
    // -----------------  Section - Top bar
    $wp_customize->add_section( 'badoblog_cus_section_top_bar', array(
        'title'    => esc_html__( 'Top bar', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_top',
        'priority' => 10,
    ) );
    // -----------------  Display option - Ticker or date
    $wp_customize->add_setting( 'badoblog_cus_ticker', array(
        'default'           => 'date',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Display option (Ticker or Date)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker',
        'choices'  => array(
            'off'    => esc_html__( 'Off', 'bado-blog' ),
            'ticker' => esc_html__( 'Ticker', 'bado-blog' ),
            'date'   => esc_html__( 'Date', 'bado-blog' ),
        ),
    ) );
    // -----------------  Proportion of width occupied by top menu
    $wp_customize->add_setting( 'badoblog_cus_ticker_width', array(
        'default'           => '70',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_width', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Proportion of width occupied by top menu', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker_width',
        'choices'  => array(
            '30'  => '30%',
            '50'  => '50%',
            '70'  => '70%',
            '100' => '100%',
        ),
    ) );
    // ----------------- Ticker display variations
    $wp_customize->add_setting( 'badoblog_cus_ticker_var', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_var', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Ticker display variations', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker_var',
        'choices'  => array(
            '1' => esc_html__( 'Category', 'bado-blog' ),
            '2' => esc_html__( 'Custom', 'bado-blog' ),
        ),
    ) );
    // ----------------- Ticker name
    $wp_customize->add_setting( 'badoblog_cus_ticker_custom_name', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_custom_name', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Ticker name', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker_custom_name',
    ) );
    // ----------------- Ticker link
    $wp_customize->add_setting( 'badoblog_cus_ticker_custom_link', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_custom_link', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Ticker link', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker_custom_link',
    ) );
    // -----------------  Ticker category
    $categories = get_categories();
    $cats = array(
        'default__all__categories' => esc_html__( 'All categories', 'bado-blog' ),
    );
    foreach ( $categories as $category ) {
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting( 'badoblog_cus_ticker_cat', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_cat_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_cat', array(
        'label'       => esc_html__( 'Category where the ticker comes from', 'bado-blog' ),
        'description' => esc_html__( 'Ticker is taken from the title of the last entry in the selected category', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_top_bar',
        'type'        => 'select',
        'choices'     => $cats,
    ) );
    // ----------------- Post sorting
    $wp_customize->add_setting( 'badoblog_cus_ticker_cat_sort', array(
        'default'           => 'date',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_cat_sort', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Post sorting', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker_cat_sort',
        'choices'  => array(
            'date'          => esc_html__( 'By publication date', 'bado-blog' ),
            'modified'      => esc_html__( 'By date modified', 'bado-blog' ),
            'title'         => esc_html__( 'By title', 'bado-blog' ),
            'comment_count' => esc_html__( 'By number of comments', 'bado-blog' ),
            'rand'          => esc_html__( 'In random order', 'bado-blog' ),
        ),
    ) );
    // -----------------  Number of posts available
    $wp_customize->add_setting( 'badoblog_cus_ticker_cat_number', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_cat_number', array(
        'label'   => esc_html__( 'Number of posts available', 'bado-blog' ) . ' (max 50)',
        'section' => 'badoblog_cus_section_top_bar',
        'type'    => 'number',
    ) );
    // ----------------- Ticker speed
    $wp_customize->add_setting( 'badoblog_cus_ticker_speed', array(
        'default'           => 15,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_10k',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_speed', array(
        'label'       => esc_html__( 'Ticker speed', 'bado-blog' ),
        'description' => esc_html__( 'Total time to scroll through all messages in seconds', 'bado-blog' ) . ' (max 10 000)',
        'section'     => 'badoblog_cus_section_top_bar',
        'type'        => 'number',
    ) );
    // ----------------- Scroll ticker endlessly
    $wp_customize->add_setting( 'badoblog_cus_ticker_infinite', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_infinite', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Scroll ticker endlessly', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker_infinite',
    ) );
    // -----------------  Text size
    $wp_customize->add_setting( 'badoblog_cus_ticker_size', array(
        'default'           => 14,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_size', array(
        'label'       => esc_html__( 'Text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 14 px)',
        'section'     => 'badoblog_cus_section_top_bar',
        'type'        => 'number',
    ) );
    // -----------------  Uppercase text
    $wp_customize->add_setting( 'badoblog_cus_ticker_up', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_ticker_up', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Uppercase text', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_ticker_up',
    ) );
    // -----------------  Where to get the date
    $wp_customize->add_setting( 'badoblog_cus_date', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_date', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Where to get the date', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_date',
        'choices'  => array(
            '1' => esc_html__( 'Set settings here', 'bado-blog' ),
            '2' => sprintf( esc_html__( 'From %s settings', 'bado-blog' ), 'WordPress' ),
        ),
    ) );
    // -----------------  Date format
    $f_d = esc_html__( 'Date', 'bado-blog' );
    $f_m = esc_html__( 'Month', 'bado-blog' );
    $f_y = esc_html__( 'Year', 'bado-blog' );
    $wp_customize->add_setting( 'badoblog_cus_date_format', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_date_format', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Date format', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_date_format',
        'choices'  => array(
            '1' => $f_d . ' + ' . $f_m . ' + ' . $f_y,
            '2' => $f_m . ' + ' . $f_d . ' + ' . $f_y,
            '3' => $f_y . ' + ' . $f_m . ' + ' . $f_d,
        ),
    ) );
    // -----------------  Separator between numbers
    $wp_customize->add_setting( 'badoblog_cus_date_sup', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_date_sup', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Separator between numbers', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_date_sup',
        'choices'  => array(
            '1' => esc_html__( 'Spaces', 'bado-blog' ),
            '2' => esc_html__( 'Dash', 'bado-blog' ) . ' ( - )',
            '3' => esc_html__( 'Dot', 'bado-blog' ) . ' ( . )',
            '4' => esc_html__( 'Slash', 'bado-blog' ) . ' ( / )',
            '5' => esc_html__( 'Vertical line', 'bado-blog' ) . ' ( | )',
        ),
    ) );
    // -----------------  Display weeks
    $wp_customize->add_setting( 'badoblog_cus_date_week', array(
        'default'           => 'before',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_date_week', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Display weeks', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_date_week',
        'choices'  => array(
            'off'    => esc_html__( 'Off', 'bado-blog' ),
            'before' => esc_html__( 'Before', 'bado-blog' ),
            'after'  => esc_html__( 'After', 'bado-blog' ),
        ),
    ) );
    // -----------------  Month in letters
    $wp_customize->add_setting( 'badoblog_cus_date_month', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_date_month', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Month in letters', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_date_month',
    ) );
    // -----------------  Display year
    $wp_customize->add_setting( 'badoblog_cus_date_year', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_date_year', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Display year', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_bar',
        'settings' => 'badoblog_cus_date_year',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Top menu
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Top menu
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_top_menu', array(
        'type'                => 'badoblog_redact',
        'selector'            => '.badoblog-css-top-menu',
        'container_inclusive' => true,
        'render_callback'     => '',
        'transport'           => 'postMessage',
    ) );
    // -----------------  Section - Top menu
    $wp_customize->add_section( 'badoblog_cus_section_top_menu', array(
        'title'    => esc_html__( 'Top menu', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_top',
        'priority' => 11,
    ) );
    // -----------------  Disable top menu
    $wp_customize->add_setting( 'badoblog_cus_top_menu', array(
        'default'           => 0,
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_menu', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Disable top menu', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_menu',
        'settings' => 'badoblog_cus_top_menu',
    ) );
    // -----------------  Title - Add colors for top menu
    class badoblog_cus_top_menu_setting_panel_text_add_colors extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_color_topmenu' ) ) {
                echo badoblog_fun_pr_customize_mes_color_topmenu();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_top_menu_setting_panel_text_add_colors', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_top_menu_setting_panel_text_add_colors($wp_customize, 'badoblog_cus_top_menu_setting_set_panel_text_add_colors', array(
        'priority' => 200,
        'section'  => 'badoblog_cus_section_top_menu',
        'settings' => 'badoblog_cus_top_menu_setting_panel_text_add_colors',
    )) );
    // -----------------  Top menu text size
    $wp_customize->add_setting( 'badoblog_cus_top_menu_size', array(
        'default'           => 14,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_menu_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 14 px)',
        'section'     => 'badoblog_cus_section_top_menu',
        'settings'    => 'badoblog_cus_top_menu_size',
    ) );
    // -----------------  Top menu text size (mobile)
    $wp_customize->add_setting( 'badoblog_cus_top_menu_mobile_a_size', array(
        'default'           => 16,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_menu_mobile_a_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ) . ' (' . esc_html__( 'small screens', 'bado-blog' ) . ')',
        'description' => '5 - 50 px (' . $mes_def_1 . ' 16 px)',
        'section'     => 'badoblog_cus_section_top_menu',
        'settings'    => 'badoblog_cus_top_menu_mobile_a_size',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Head image
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Header image
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_header_image_soc', array(
        'selector' => '.badoblog-css-site-brand-top',
    ) );
    // -----------------  Changing a parameter priority
    $wp_customize->get_section( 'header_image' )->priority = 15;
    // -----------------  Moving sections to a panel (Top part)
    $wp_customize->get_section( 'header_image' )->panel = 'badoblog_cus_panel_top';
    // -----------------  Move social links in the header over the image
    $wp_customize->add_setting( 'badoblog_cus_header_image_soc', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_header_image_soc', array(
        'priority'    => 1,
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Move social links in the header over the image', 'bado-blog' ),
        'description' => esc_html__( '(For this to work, you need to activate social links in the "Social Links" section)', 'bado-blog' ),
        'section'     => 'header_image',
        'settings'    => 'badoblog_cus_header_image_soc',
    ) );
    // -----------------  Enable effect (live picture)
    $wp_customize->add_setting( 'badoblog_cus_header_image_live', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_header_image_live', array(
        'priority' => 2,
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Enable effect (live picture)', 'bado-blog' ),
        'section'  => 'header_image',
        'settings' => 'badoblog_cus_header_image_live',
    ) );
    // -----------------  Header image link
    $wp_customize->add_setting( 'badoblog_cus_header_image_link', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_header_image_link', array(
        'type'        => 'text',
        'label'       => esc_html__( 'Header image link', 'bado-blog' ),
        'description' => esc_html__( 'This works when you click on the image', 'bado-blog' ),
        'section'     => 'header_image',
        'settings'    => 'badoblog_cus_header_image_link',
        'priority'    => 5,
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Title & logo
    	// (Base Section - Site properties)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Title and logo
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_title_tagline_h_font', array(
        'selector' => '.badoblog-css-site-brand-bottom-1',
    ) );
    // -----------------  Changing the header color setting section
    $wp_customize->get_control( 'header_textcolor' )->section = 'title_tagline';
    // -----------------  Changing a parameter transport
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    // Page reload via js
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    // -----------------  Changing the title of a setting (site header text color)
    $wp_customize->get_control( 'custom_logo' )->label = esc_html__( 'Fixed size logo', 'bado-blog' );
    $wp_customize->get_control( 'header_textcolor' )->label = esc_html__( 'Site title and description text color', 'bado-blog' );
    // -----------------  Adding a Setting Description (Display title and description)
    $wp_customize->get_control( 'custom_logo' )->description = sprintf( esc_html__( 'The selected image will be compressed to the optimal size %s', 'bado-blog' ), '(200 x 150 px)' );
    $wp_customize->get_control( 'display_header_text' )->description = esc_html__( '(If disabled, the title is hidden only visually. The entered text will continue to be present for the main page in h1 tags)', 'bado-blog' );
    // -----------------  Changing a parameter priority
    $wp_customize->get_control( 'display_header_text' )->priority = 2;
    $wp_customize->get_control( 'custom_logo' )->priority = 50;
    // -----------------  Changing the section name
    $wp_customize->get_section( 'title_tagline' )->title = esc_html__( 'Title and logo', 'bado-blog' );
    // -----------------  Moving sections to a panel (top part)
    $wp_customize->get_section( 'title_tagline' )->panel = 'badoblog_cus_panel_top';
    // ----------------- Title and logo design option
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_design', array(
        'default'           => 'gradient',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_design', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Title and logo design option', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_design',
        'choices'  => array(
            'simple'     => 'Simple',
            'background' => 'Background',
            'gradient'   => 'Gradient',
            'border'     => 'Border',
        ),
    ) );
    // ----------------- Fill or border color
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_design_color', array(
        'default'              => '#505062',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_title_tagline_design_color', array(
        'label'    => esc_html__( 'Fill or border color', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_design_color',
    )) );
    // -----------------  Add the dividing line
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_line', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_line', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add a dividing line between the title and description', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_line',
    ) );
    // ----------------- Title area width with logo
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_width', array(
        'default'           => '70',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_width', array(
        'type'        => 'select',
        'label'       => esc_html__( 'Title area width with logo', 'bado-blog' ),
        'description' => esc_html__( 'Specify 100% for center the title', 'bado-blog' ),
        'section'     => 'title_tagline',
        'settings'    => 'badoblog_cus_title_tagline_width',
        'choices'     => array(
            '20'  => '20%',
            '30'  => '30%',
            '40'  => '40%',
            '50'  => '50%',
            '60'  => '60%',
            '70'  => '70%',
            '80'  => '80%',
            '100' => '100%',
        ),
    ) );
    // -----------------  Dividing line
    class badoblog_cus_title_tagline_panel_border_1 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_title_tagline_panel_border_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_title_tagline_panel_border_1($wp_customize, 'badoblog_cus_title_tagline_set_panel_border_1', array(
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_panel_border_1',
    )) );
    // -----------------  Site title font
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_h_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_h_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Site title font', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_h_font',
        'choices'  => $badoblog_font,
    ) );
    // -----------------  Site title size
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_h_size', array(
        'default'           => 40,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_h_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Site title size', 'bado-blog' ) . ' (5 - 100 px, ' . $mes_def_1 . ' 40 px)',
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_h_size',
    ) );
    // -----------------  Site title line height
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_h_height', array(
        'default'           => '1.5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_h_height', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Site title line height', 'bado-blog' ) . ' (0.8 - 5, ' . $mes_def_1 . ' 1.5)',
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_h_height',
    ) );
    // -----------------  Dividing line
    class badoblog_cus_title_tagline_panel_border_2 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_title_tagline_panel_border_2', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_title_tagline_panel_border_2($wp_customize, 'badoblog_cus_title_tagline_set_panel_border_2', array(
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_panel_border_2',
    )) );
    // -----------------  Site description font
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_des_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_des_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Site description font', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_des_font',
        'choices'  => $badoblog_font,
    ) );
    // ----------------- Site description text size
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_des_size', array(
        'default'           => 16,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_des_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Site description text size', 'bado-blog' ) . ' (5 - 50 px, ' . $mes_def_1 . ' 16 px)',
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_des_size',
    ) );
    // ----------------- Line height of the site description text
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_des_height', array(
        'default'           => '1.7',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_des_height', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Line height of the site description text', 'bado-blog' ) . ' (0.8 - 5, ' . $mes_def_1 . ' 1.7)',
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_des_height',
    ) );
    // -----------------  Dividing line
    class badoblog_cus_title_tagline_panel_border_3 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_title_tagline_panel_border_3', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_title_tagline_panel_border_3($wp_customize, 'badoblog_cus_title_tagline_set_panel_border_3', array(
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_panel_border_3',
    )) );
    // -----------------  Orientation of the logo and site name
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_logo_layout', array(
        'default'           => 'horizont',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_logo_layout', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Orientation of the logo and site name', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_logo_layout',
        'choices'  => array(
            'horizont' => esc_html__( 'Horizontally', 'bado-blog' ),
            'vertical' => esc_html__( 'Vertical', 'bado-blog' ),
        ),
    ) );
    // -----------------  Logo variation
    $wp_customize->add_setting( 'badoblog_cus_title_tagline_logo_var', array(
        'default'           => 'fix',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_title_tagline_logo_var', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Logo variation', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_title_tagline_logo_var',
        'choices'  => array(
            'fix'  => esc_html__( 'Size fixed', 'bado-blog' ),
            'free' => esc_html__( 'No limits', 'bado-blog' ),
        ),
    ) );
    // -----------------  Logo without limits
    $wp_customize->add_setting( 'badoblog_cus_supple_logo', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_img_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'badoblog_cus_supple_logo', array(
        'label'    => esc_html__( 'Logo without limits', 'bado-blog' ),
        'section'  => 'title_tagline',
        'settings' => 'badoblog_cus_supple_logo',
        'priority' => 50,
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Top Banner
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Top Banner
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_banner', array(
        'selector' => '.badoblog-css-site-brand-banner',
    ) );
    // -----------------  Section - Top Banner
    $wp_customize->add_section( 'badoblog_cus_section_banner', array(
        'title'    => esc_html__( 'Top banner', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_top',
        'priority' => 40,
    ) );
    // -----------------  Activate Top Banner
    $wp_customize->add_setting( 'badoblog_cus_banner', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_banner', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate top banner', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_banner',
        'settings' => 'badoblog_cus_banner',
    ) );
    // ----------------- Banner link
    $wp_customize->add_setting( 'badoblog_cus_banner_link', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_banner_link', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Link to advertising source', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_banner',
        'settings' => 'badoblog_cus_banner_link',
    ) );
    // ----------------- Open link in new tab
    $wp_customize->add_setting( 'badoblog_cus_banner_tab', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_banner_tab', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Open link in new tab', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_banner',
        'settings' => 'badoblog_cus_banner_tab',
    ) );
    // -----------------  Select image
    $demo_banner = get_template_directory_uri() . '/img/no-photo/demo-banner.png';
    $wp_customize->add_setting( 'badoblog_cus_banner_media', array(
        'default'           => $demo_banner,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_img_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'badoblog_cus_banner_media', array(
        'label'    => esc_html__( 'Select image', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_banner',
        'settings' => 'badoblog_cus_banner_media',
    )) );
    // ----------------- ALT value for the image
    $wp_customize->add_setting( 'badoblog_cus_banner_alt', array(
        'default'           => 'Banner',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_banner_alt', array(
        'type'     => 'text',
        'label'    => esc_html__( 'ALT value for the image', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_banner',
        'settings' => 'badoblog_cus_banner_alt',
    ) );
    // ----------------- Frame thickness
    $wp_customize->add_setting( 'badoblog_cus_banner_border', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_0_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_banner_border', array(
        'type'        => 'range',
        'section'     => 'badoblog_cus_section_banner',
        'label'       => esc_html__( 'Frame thickness', 'bado-blog' ) . ' ( 0 - 30 px )',
        'input_attrs' => array(
            'min'  => 0,
            'max'  => 30,
            'step' => 1,
        ),
    ) );
    // ----------------- Frame color
    $wp_customize->add_setting( 'badoblog_cus_banner_border_color', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_banner_border_color', array(
        'label'       => esc_html__( 'Frame color', 'bado-blog' ),
        'description' => esc_html__( 'Default - main theme color', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_banner',
        'settings'    => 'badoblog_cus_banner_border_color',
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Social links
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Social links
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_soc', array(
        'selector' => '.badoblog-css-soc-top-box',
    ) );
    // -----------------  Section - Social links
    $wp_customize->add_section( 'badoblog_cus_section_soc', array(
        'title'    => esc_html__( 'Social links', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_top',
        'priority' => 40,
    ) );
    // -----------------  Activate social links
    $wp_customize->add_setting( 'badoblog_cus_soc', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_soc', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate social links', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_soc',
        'settings' => 'badoblog_cus_soc',
    ) );
    // -----------------  Social link size
    $wp_customize->add_setting( 'badoblog_cus_soc_size', array(
        'default'           => 54,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_soc_size', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Social link size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_soc',
        'settings' => 'badoblog_cus_soc_size',
        'choices'  => array(
            34 => esc_html__( 'Small', 'bado-blog' ),
            44 => esc_html__( 'Average', 'bado-blog' ),
            54 => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // -----------------  Social link form
    $wp_customize->add_setting( 'badoblog_cus_soc_form', array(
        'default'           => 'circle',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_soc_form', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Social link form', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_soc',
        'settings' => 'badoblog_cus_soc_form',
        'choices'  => badoblog_fun_soc_form(),
    ) );
    // -----------------  Social link design (for icons with background) array
    $soc_form_set = get_theme_mod( 'badoblog_cus_soc_form', 'circle' );
    $soc_design_back = '';
    $soc_design_back = apply_filters( 'dmcwzmulti_filter_soc_design_back', $soc_design_back, $soc_form_set );
    if ( empty( $soc_design_back ) ) {
        $soc_design_back = array(
            'flat'       => esc_html__( 'Flat', 'bado-blog' ),
            'volumetric' => esc_html__( 'Volumetric', 'bado-blog' ),
        );
    }
    // -----------------  Social link design (for icons with background)
    $wp_customize->add_setting( 'badoblog_cus_soc_design_back', array(
        'default'           => 'volumetric',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize_soc',
    ) );
    $wp_customize->add_control( 'badoblog_cus_soc_design_back', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Social link design (for icons with background)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_soc',
        'settings' => 'badoblog_cus_soc_design_back',
        'choices'  => $soc_design_back,
    ) );
    // -----------------  Social link design (for icons no background) array
    $soc_design_no_back = '';
    $soc_design_no_back = apply_filters( 'dmcwzmulti_filter_soc_design_no_back', $soc_design_no_back, $soc_form_set );
    if ( empty( $soc_design_no_back ) ) {
        $soc_design_no_back = array(
            'only-black-line' => esc_html__( 'Black', 'bado-blog' ),
            'only-white-line' => esc_html__( 'White', 'bado-blog' ),
        );
    }
    // -----------------  Social link design (for icons no background)
    $wp_customize->add_setting( 'badoblog_cus_soc_design_no_back', array(
        'default'           => 'only-black-line',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_soc_design_no_back', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Social link design (for icons no background)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_soc',
        'settings' => 'badoblog_cus_soc_design_no_back',
        'choices'  => $soc_design_no_back,
    ) );
    // -----------------  Animation of social links
    $wp_customize->add_setting( 'badoblog_cus_soc_anime', array(
        'default'           => 'a5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_soc_anime', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Animation of social links', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_soc',
        'settings' => 'badoblog_cus_soc_anime',
        'choices'  => array(
            'a0'  => esc_html__( 'Without animation', 'bado-blog' ),
            'a1'  => esc_html__( 'Increase', 'bado-blog' ),
            'a2'  => esc_html__( 'Zoom (with background)', 'bado-blog' ),
            'a3'  => esc_html__( 'Reduction', 'bado-blog' ),
            'a4'  => esc_html__( 'Zoom out (with background)', 'bado-blog' ),
            'a5'  => esc_html__( 'Frame around the link', 'bado-blog' ),
            'a6'  => esc_html__( 'Increasing contrast', 'bado-blog' ),
            'a7'  => esc_html__( 'Hue change', 'bado-blog' ),
            'a8'  => esc_html__( 'Color inversion', 'bado-blog' ),
            'a9'  => esc_html__( 'Dimming adjacent links', 'bado-blog' ),
            'a10' => esc_html__( 'Slight slope', 'bado-blog' ),
        ),
    ) );
    // -----------------  Social links fill color
    $wp_customize->add_setting( 'badoblog_cus_soc_back_color', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_soc_back_color', array(
        'label'       => esc_html__( 'Social links fill color', 'bado-blog' ),
        'description' => esc_html__( 'Default - color of small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_soc',
        'settings'    => 'badoblog_cus_soc_back_color',
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Top search
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Top search
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_search', array(
        'selector' => '.badoblog-css-soc-search',
    ) );
    // -----------------  Section - Top search
    $wp_customize->add_section( 'badoblog_cus_section_search', array(
        'title'    => esc_html__( 'Top search', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_top',
        'priority' => 40,
    ) );
    // -----------------  Activate top Search
    $wp_customize->add_setting( 'badoblog_cus_search', array(
        'default'           => 'top-bar',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_search', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Activate top Search', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_search',
        'settings' => 'badoblog_cus_search',
        'choices'  => array(
            'off'        => esc_html__( 'Off', 'bado-blog' ),
            'top-bar'    => esc_html__( 'In a top bar', 'bado-blog' ),
            'soc-before' => esc_html__( 'In area of soc links (before)', 'bado-blog' ),
            'soc-after'  => esc_html__( 'In area of soc links (after)', 'bado-blog' ),
        ),
    ) );
    // -----------------  Use social icon styles
    $wp_customize->add_setting( 'badoblog_cus_search_soc', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_search_soc', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Use social icon styles', 'bado-blog' ),
        'description' => esc_html__( '(For this to work, you need to activate social links in the "Social Links" section)', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_search',
        'settings'    => 'badoblog_cus_search_soc',
    ) );
    // -----------------  Search button size
    $wp_customize->add_setting( 'badoblog_cus_search_size', array(
        'default'           => 'search-small',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_search_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Search button size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_search',
        'settings' => 'badoblog_cus_search_size',
        'choices'  => array(
            'search-very-small' => esc_html__( 'Very small', 'bado-blog' ),
            'search-small'      => esc_html__( 'Small', 'bado-blog' ),
            'search-mid'        => esc_html__( 'Average', 'bado-blog' ),
            'search-big'        => esc_html__( 'Big', 'bado-blog' ),
            'search-very-big'   => esc_html__( 'Very big', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Main menu
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Main menu
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_main_menu', array(
        'type'                => 'badoblog_redact',
        'selector'            => '.badoblog-css-mega-menu',
        'container_inclusive' => true,
        'render_callback'     => '',
        'transport'           => 'postMessage',
    ) );
    // -----------------  Section - Main menu
    $wp_customize->add_section( 'badoblog_cus_section_main_menu', array(
        'title'    => esc_html__( 'Main menu', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_top',
        'priority' => 50,
    ) );
    // -----------------  Disable main menu
    $wp_customize->add_setting( 'badoblog_cus_main_menu', array(
        'default'           => 0,
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $help_mainmenu = '';
    if ( function_exists( 'badoblog_fun_pr_customize_help_mainmenu' ) ) {
        $help_mainmenu = badoblog_fun_pr_customize_help_mainmenu();
    }
    $wp_customize->add_control( 'badoblog_cus_main_menu', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Disable main menu', 'bado-blog' ),
        'description' => '<div class="badoblog-css-panel-help-box"><div>' . sprintf( esc_html__( 'This setting will completely disable the main menu, including the %s', 'bado-blog' ), 'Mega menu' ) . '</div>' . $help_mainmenu . '</div>',
        'section'     => 'badoblog_cus_section_main_menu',
        'settings'    => 'badoblog_cus_main_menu',
    ) );
    // ----------------- Full-width main menu background
    $wp_customize->add_setting( 'badoblog_cus_main_menu_full_width', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_full_width', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Full-width background', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_main_menu',
        'settings' => 'badoblog_cus_main_menu_full_width',
    ) );
    // -----------------  Main menu item orientation
    $wp_customize->add_setting( 'badoblog_cus_main_menu_layout', array(
        'default'           => 'center',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_layout', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Buttons orientation', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_main_menu',
        'settings' => 'badoblog_cus_main_menu_layout',
        'choices'  => array(
            'left'   => esc_html__( 'Left', 'bado-blog' ),
            'right'  => esc_html__( 'Right', 'bado-blog' ),
            'center' => esc_html__( 'Center', 'bado-blog' ),
            'dist'   => esc_html__( 'Distributed', 'bado-blog' ),
        ),
    ) );
    // -----------------  Size of main menu items
    $wp_customize->add_setting( 'badoblog_cus_main_menu_height', array(
        'default'           => 'mid',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_height', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Button size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_main_menu',
        'settings' => 'badoblog_cus_main_menu_height',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'mid'   => esc_html__( 'Average', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // -----------------  Title - Add colors for main menu
    class badoblog_cus_main_menu_setting_panel_text_add_colors extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_color' ) ) {
                echo badoblog_fun_pr_customize_mes_color();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_main_menu_setting_panel_text_add_colors', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_main_menu_setting_panel_text_add_colors($wp_customize, 'badoblog_cus_main_menu_setting_set_panel_text_add_colors', array(
        'priority' => 10,
        'section'  => 'badoblog_cus_section_main_menu',
        'settings' => 'badoblog_cus_main_menu_setting_panel_text_add_colors',
    )) );
    // -----------------  Main menu item font
    $wp_customize->add_setting( 'badoblog_cus_main_menu_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_main_menu',
        'settings' => 'badoblog_cus_main_menu_font',
        'choices'  => $badoblog_font,
    ) );
    // -----------------  Main menu items text size
    $wp_customize->add_setting( 'badoblog_cus_main_menu_size', array(
        'default'           => 15,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_size', array(
        'label'       => esc_html__( 'Text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 15 px)',
        'section'     => 'badoblog_cus_section_main_menu',
        'type'        => 'number',
    ) );
    // -----------------  Main menu items titles in uppercase
    $wp_customize->add_setting( 'badoblog_cus_main_menu_text_up', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_text_up', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Uppercase text', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_main_menu',
        'settings' => 'badoblog_cus_main_menu_text_up',
    ) );
    // -----------------  Make main menu sticky when scrolling
    $wp_customize->add_setting( 'badoblog_cus_main_menu_fix', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_fix', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Make main menu sticky when scrolling (only for desktop versions of pc)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_main_menu',
        'settings' => 'badoblog_cus_main_menu_fix',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Top part - Mega menu (lists)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Top part - Mega menu (lists)
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_main_menu_mega_column', array(
        'selector' => '.badoblog-css-mega-menu-box',
    ) );
    // -----------------  Section - Mega menu (Lists)
    $wp_customize->add_section( 'badoblog_cus_section_mega', array(
        'title'    => 'Mega menu (' . esc_html__( 'lists', 'bado-blog' ) . ')',
        'panel'    => 'badoblog_cus_panel_top',
        'priority' => 50,
    ) );
    // -----------------  Title 1 - Mega menu (lists)
    class badoblog_cus_mega_panel_text_1 extends WP_Customize_Control {
        function render_content() {
            ?>
			<div class="badoblog-css-panel-help-box">
				<div>
				<?php 
            echo esc_html__( 'Warning', 'bado-blog' ) . '! ' . sprintf( esc_html__( 'The main menu must be enabled for the %s to be displayed', 'bado-blog' ), 'Mega menu' );
            ?>
				</div>
				<?php 
            if ( function_exists( 'badoblog_fun_pr_customize_help_mega' ) ) {
                echo badoblog_fun_pr_customize_help_mega();
            }
            ?>
			</div>
			<?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_mega_panel_text_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_mega_panel_text_1($wp_customize, 'badoblog_cus_mega_set_panel_text_1', array(
        'section'  => 'badoblog_cus_section_mega',
        'settings' => 'badoblog_cus_mega_panel_text_1',
    )) );
    // -----------------  Title 2 - Mega menu (lists)
    class badoblog_cus_main_menu_panel_text_2 extends WP_Customize_Control {
        function render_content() {
            echo '<p>' . esc_html__( 'Information', 'bado-blog' ) . ': ' . sprintf( esc_html__( 'Items of this menu are customized in the - "Panel %s" - "Appearance" - "Menus" section.', 'bado-blog' ), 'WordPress' ) . '</p>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_main_menu_panel_text_2', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_main_menu_panel_text_2($wp_customize, 'badoblog_cus_main_menu_set_panel_text_2', array(
        'section'  => 'badoblog_cus_section_mega',
        'settings' => 'badoblog_cus_main_menu_panel_text_2',
    )) );
    // ----------------- Mega menu (drop-down menu) items text size
    $wp_customize->add_setting( 'badoblog_cus_main_menu_sub_size', array(
        'default'           => 14,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_sub_size', array(
        'label'       => esc_html__( 'Links size (drop-down menu)', 'bado-blog' ),
        'description' => '5 - 30 px (' . $mes_def_1 . ' 14 px)',
        'section'     => 'badoblog_cus_section_mega',
        'type'        => 'number',
    ) );
    // ----------------- Mega menu (mega menu) items text size
    $wp_customize->add_setting( 'badoblog_cus_main_menu_mega_size', array(
        'default'           => 14,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_mega_size', array(
        'label'       => esc_html__( 'Links size', 'bado-blog' ) . ' (Mega menu)',
        'description' => '5 - 30 px (' . $mes_def_1 . ' 14 px)',
        'section'     => 'badoblog_cus_section_mega',
        'type'        => 'number',
    ) );
    // -----------------  Title - Add colors
    class badoblog_cus_main_menu_setting_panel_text_add_xlmega extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_megamenu' ) ) {
                echo badoblog_fun_pr_customize_mes_megamenu();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_main_menu_setting_panel_text_add_xlmega', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_main_menu_setting_panel_text_add_xlmega($wp_customize, 'badoblog_cus_main_menu_setting_set_panel_text_add_xlmega', array(
        'priority' => 200,
        'section'  => 'badoblog_cus_section_mega',
        'settings' => 'badoblog_cus_main_menu_setting_panel_text_add_xlmega',
    )) );
    // -----------------  Number of columns in mega menu
    $wp_customize->add_setting( 'badoblog_cus_main_menu_mega_column', array(
        'default'           => 4,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_main_menu_mega_column', array(
        'type'     => 'select',
        'label'    => sprintf( esc_html__( 'Number of columns in %s', 'bado-blog' ), 'Mega menu' ),
        'section'  => 'badoblog_cus_section_mega',
        'settings' => 'badoblog_cus_main_menu_mega_column',
        'choices'  => array(
            '1' => esc_html__( 'One', 'bado-blog' ),
            '2' => esc_html__( 'Two', 'bado-blog' ),
            '3' => esc_html__( 'Three', 'bado-blog' ),
            '4' => esc_html__( 'Four', 'bado-blog' ),
            '5' => esc_html__( 'Five', 'bado-blog' ),
            '6' => esc_html__( 'Six', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Categories
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Panel - Categories
    $wp_customize->add_panel( 'badoblog_cus_panel_cat', array(
        'capabitity'  => 'edit_theme_options',
        'description' => esc_html__( 'Categories settings', 'bado-blog' ),
        'priority'    => 10,
        'title'       => esc_html__( 'Categories', 'bado-blog' ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Categories - Cat style
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Categories - Category style
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_cat_style_win', array(
        'selector' => '.badoblog-css-cat-box',
    ) );
    // -----------------  Section - Category style
    $wp_customize->add_section( 'badoblog_cus_section_cat_style', array(
        'priority' => 10,
        'title'    => esc_html__( 'Category style', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_cat',
    ) );
    // -----------------  Number (size) of columns in categories
    $wp_customize->add_setting( 'badoblog_cus_cat_style_win', array(
        'default'           => 'w2',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_win', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Number (size) of columns', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_win',
        'choices'  => array(
            'w1' => esc_html__( 'Classic blog', 'bado-blog' ),
            'w2' => esc_html__( 'Two columns', 'bado-blog' ),
            'w3' => esc_html__( 'Three columns', 'bado-blog' ),
            'w4' => esc_html__( 'Four columns', 'bado-blog' ),
            'w5' => esc_html__( 'Five columns', 'bado-blog' ),
            'w6' => esc_html__( 'Horizontal', 'bado-blog' ) . ' (' . esc_html__( 'Big', 'bado-blog' ) . ')',
            'w7' => esc_html__( 'Horizontal', 'bado-blog' ) . ' (' . esc_html__( 'Medium', 'bado-blog' ) . ')',
            'w8' => esc_html__( 'Horizontal', 'bado-blog' ) . ' (' . esc_html__( 'Small', 'bado-blog' ) . ')',
        ),
    ) );
    // ----------------- Design - Posts blocks in categories
    $wp_customize->add_setting( 'badoblog_cus_cat_style_design', array(
        'default'           => 'v6',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_design', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Posts design', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_design',
        'choices'  => array(
            'v0' => esc_html__( 'Disable design', 'bado-blog' ),
            'v1' => esc_html__( 'Simple', 'bado-blog' ),
            'v2' => esc_html__( 'Underlined', 'bado-blog' ),
            'v3' => esc_html__( 'In frame', 'bado-blog' ),
            'v4' => esc_html__( 'Header background', 'bado-blog' ),
            'v5' => esc_html__( 'Deepening', 'bado-blog' ),
            'v6' => esc_html__( 'Light shadow', 'bado-blog' ),
            'v7' => esc_html__( 'Light shadow', 'bado-blog' ) . ' (' . esc_html__( 'Polaroid', 'bado-blog' ) . ')',
            'v8' => esc_html__( 'Soaring', 'bado-blog' ),
        ),
    ) );
    // -----------------  Animation for posts blocks in categories
    $wp_customize->add_setting( 'badoblog_cus_cat_style_anime', array(
        'default'           => 'a1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_anime', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Animation of posts', 'bado-blog' ) . $mes_hover,
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_anime',
        'choices'  => array(
            'a0'  => esc_html__( 'Without animation', 'bado-blog' ),
            'a1'  => esc_html__( 'Enlargement picture', 'bado-blog' ),
            'a2'  => esc_html__( 'Reducing picture', 'bado-blog' ),
            'a3'  => esc_html__( 'Darkened image', 'bado-blog' ),
            'a4'  => esc_html__( 'Curtain on picture', 'bado-blog' ),
            'a5'  => esc_html__( 'Picture frame', 'bado-blog' ),
            'a6'  => esc_html__( 'Frame around', 'bado-blog' ),
            'a7'  => esc_html__( 'Backlight picture', 'bado-blog' ),
            'a8'  => esc_html__( 'Picture contrast', 'bado-blog' ),
            'a9'  => esc_html__( 'Tint picture', 'bado-blog' ),
            'a10' => esc_html__( 'Color inversion picture', 'bado-blog' ),
            'a11' => esc_html__( 'Remove color in neighboring blocks', 'bado-blog' ),
            'a12' => esc_html__( 'Toning neighboring blocks', 'bado-blog' ),
            'a13' => esc_html__( 'Block slope', 'bado-blog' ),
        ),
    ) );
    // -----------------  Background color for posts blocks in categories
    $wp_customize->add_setting( 'badoblog_cus_cat_style_back_color', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_cat_style_back_color', array(
        'label'    => esc_html__( 'Posts background color', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_back_color',
    )) );
    // -----------------  Background color of sticky posts
    $wp_customize->add_setting( 'badoblog_cus_cat_style_back_sticky', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_cat_style_back_sticky', array(
        'label'    => esc_html__( 'Background color of sticky posts', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_back_sticky',
    )) );
    // -----------------  Post card title size
    $wp_customize->add_setting( 'badoblog_cus_cat_style_h_size', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_h_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Post card title size', 'bado-blog' ) . ' (5 - 50 px)',
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_h_size',
    ) );
    // -----------------  Post card description size
    $wp_customize->add_setting( 'badoblog_cus_cat_style_text_size', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_text_size', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Post card description size', 'bado-blog' ) . ' (5 - 30 px)',
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_text_size',
    ) );
    // -----------------  Number of symbols in description
    $wp_customize->add_setting( 'badoblog_cus_cat_style_letters', array(
        'default'           => 150,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_50_1000',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_letters', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Number of symbols in description', 'bado-blog' ),
        'description' => '50 - 1000 (' . $mes_def_1 . ' ' . esc_html__( '150 symbols', 'bado-blog' ) . ')',
        'section'     => 'badoblog_cus_section_cat_style',
        'settings'    => 'badoblog_cus_cat_style_letters',
    ) );
    // -----------------  Dividing line - Category style
    class badoblog_cus_cat_style_panel_border_1 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_cat_style_panel_border_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_cat_style_panel_border_1($wp_customize, 'badoblog_cus_cat_style_set_panel_border_1', array(
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_panel_border_1',
    )) );
    // -----------------  Add a "Read more" button
    $wp_customize->add_setting( 'badoblog_cus_cat_style_more', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_more', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add button', 'bado-blog' ) . ' (' . esc_html__( 'Read more', 'bado-blog' ) . ')',
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_more',
    ) );
    // -----------------  Full width "Read more" button
    $wp_customize->add_setting( 'badoblog_cus_cat_style_more_width', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_more_width', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Full width "Read more" button', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_more_width',
    ) );
    // ----------------- Button orientation
    $wp_customize->add_setting( 'badoblog_cus_cat_style_more_lay', array(
        'default'           => 'center',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_more_lay', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Button orientation', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_more_lay',
        'choices'  => array(
            'left'   => esc_html__( 'Left', 'bado-blog' ),
            'center' => esc_html__( 'Center', 'bado-blog' ),
            'right'  => esc_html__( 'Right', 'bado-blog' ),
        ),
    ) );
    // ----------------- Button text
    $wp_customize->add_setting( 'badoblog_cus_cat_style_more_text', array(
        'default'           => esc_html__( 'Read more', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_more_text', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Button text', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_more_text',
    ) );
    // -----------------  Dividing line 2 - Category style
    class badoblog_cus_cat_style_panel_border_2 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_cat_style_panel_border_2', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_cat_style_panel_border_2($wp_customize, 'badoblog_cus_cat_style_set_panel_border_2', array(
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_panel_border_2',
    )) );
    // -----------------  Remove the prefix "Category" on category pages
    $wp_customize->add_setting( 'badoblog_cus_cat_style_h_prefix', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_h_prefix', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove the prefix "Category" on category pages', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_h_prefix',
    ) );
    // -----------------  Remove description from posts blocks in categories
    $wp_customize->add_setting( 'badoblog_cus_cat_style_entry_none', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_entry_none', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove description from post cards', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_entry_none',
    ) );
    // -----------------  Remove title from posts blocks in categories
    $wp_customize->add_setting( 'badoblog_cus_cat_style_title_none', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_title_none', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove title from post cards', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_title_none',
    ) );
    // -----------------  Remove the stub "No photo" from posts blocks in categories
    $wp_customize->add_setting( 'badoblog_cus_cat_style_nofoto_none', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_style_nofoto_none', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove the plug', 'bado-blog' ) . ' (' . esc_html__( 'No photo', 'bado-blog' ) . ')',
        'section'  => 'badoblog_cus_section_cat_style',
        'settings' => 'badoblog_cus_cat_style_nofoto_none',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Categories - Meta tags (meta boxs)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Categories - Meta tags in categories
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_cat_meta_boxs', array(
        'selector' => '.badoblog-css-cat-meta-boxs',
    ) );
    // -----------------  Section - Meta tags in categories
    $wp_customize->add_section( 'badoblog_cus_section_cat_meta_boxs', array(
        'priority' => 10,
        'title'    => esc_html__( 'Meta tags (meta boxs)', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_cat',
    ) );
    // -----------------  Activate meta boxs
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate meta boxs', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs',
    ) );
    // -----------------  Title 1 - What meta boxs to display
    class badoblog_cus_cat_meta_boxs_panel_text_1 extends WP_Customize_Control {
        function render_content() {
            ?><div class="badoblog-c-panel-text"><?php 
            echo esc_html__( 'What meta boxs to display', 'bado-blog' );
            ?></div><?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_panel_text_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_cat_meta_boxs_panel_text_1($wp_customize, 'badoblog_cus_cat_meta_boxs_set_panel_text_1', array(
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_panel_text_1',
    )) );
    // -----------------  Post author
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_author', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_author', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Post author', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_author',
    ) );
    // -----------------  Post creation date
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_date', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_date', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Post creation date', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_date',
    ) );
    // -----------------  Post update date
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_update', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_update', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Post update date', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_update',
    ) );
    // -----------------  Number of comments
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_comment', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_comment', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Number of comments', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_comment',
    ) );
    // -----------------  Number of post views
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_view', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_view', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Number of post views', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_view',
    ) );
    // ----------------- Design
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_design', array(
        'default'           => 'v3',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_design', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Design', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_design',
        'choices'  => array(
            'v0' => esc_html__( 'Simple', 'bado-blog' ),
            'v1' => esc_html__( 'Frame', 'bado-blog' ),
            'v2' => esc_html__( 'Underlined', 'bado-blog' ),
            'v3' => esc_html__( 'Underlined', 'bado-blog' ) . ' (' . esc_html__( 'circle', 'bado-blog' ) . ')',
            'v4' => esc_html__( 'Soaring', 'bado-blog' ),
            'v5' => esc_html__( 'Deepening', 'bado-blog' ),
            'v6' => esc_html__( 'Background', 'bado-blog' ),
        ),
    ) );
    // ----------------- Size
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_size', array(
        'default'           => 'small',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_size',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // ----------------- Align to center
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_center', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Align to center', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_center',
    ) );
    // ----------------- Add dynamic tooltips
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_prompt', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_prompt', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add dynamic tooltips', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_prompt',
    ) );
    // ----------------- Add decryption
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_label', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_label', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add decryption', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_label',
    ) );
    // ----------------- Remove icons
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_boxs_icon', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_boxs_icon', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove icons', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_boxs',
        'settings' => 'badoblog_cus_cat_meta_boxs_icon',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Categories - Meta tags (categories)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Categories - Meta tags in categories
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_cat_meta_cat', array(
        'selector' => '.badoblog-css-cat-meta-tax-cat-ul',
    ) );
    // -----------------  Section - Meta tags in categories
    $wp_customize->add_section( 'badoblog_cus_section_cat_meta_cat', array(
        'priority' => 10,
        'title'    => esc_html__( 'Meta tags (categories)', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_cat',
    ) );
    // ----------------- Activate meta tags categories
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_cat', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_cat', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate meta tags categories', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_cat',
        'settings' => 'badoblog_cus_cat_meta_cat',
    ) );
    // ----------------- Where to display
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_cat_layout', array(
        'default'           => 'thumb-bottom',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_cat_layout', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Where to display', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_cat',
        'settings' => 'badoblog_cus_cat_meta_cat_layout',
        'choices'  => array(
            'thumb-top'    => esc_html__( 'In the image (top)', 'bado-blog' ),
            'thumb-bottom' => esc_html__( 'In the image (bottom)', 'bado-blog' ),
            'header'       => esc_html__( 'Outside the image', 'bado-blog' ),
        ),
    ) );
    // ----------------- Maximum number of category elements
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_cat_item', array(
        'default'           => 2,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_20',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_cat_item', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Maximum number of category elements', 'bado-blog' ),
        'description' => '1 - 20 (' . $mes_def_1 . ' 2)',
        'section'     => 'badoblog_cus_section_cat_meta_cat',
        'settings'    => 'badoblog_cus_cat_meta_cat_item',
    ) );
    // ----------------- Size
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_cat_size', array(
        'default'           => 'mid',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_cat_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_cat',
        'settings' => 'badoblog_cus_cat_meta_cat_size',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'mid'   => esc_html__( 'Average', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // ----------------- Align to center
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_cat_center', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_cat_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Align to center', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_cat',
        'settings' => 'badoblog_cus_cat_meta_cat_center',
    ) );
    // ----------------- Cat icons
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_cat_icon', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_cat_icon', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Icons', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_cat',
        'settings' => 'badoblog_cus_cat_meta_cat_icon',
        'choices'  => array(
            0 => esc_html__( 'Off', 'bado-blog' ),
            1 => esc_html__( 'Folder', 'bado-blog' ) . ' 1',
            2 => esc_html__( 'Folder', 'bado-blog' ) . ' 2',
            3 => esc_html__( 'Folder', 'bado-blog' ) . ' 3',
            4 => esc_html__( 'Folder', 'bado-blog' ) . ' 4',
            5 => esc_html__( 'Folder', 'bado-blog' ) . ' 5',
            6 => esc_html__( 'Folder', 'bado-blog' ) . ' 6',
            7 => esc_html__( 'Folder', 'bado-blog' ) . ' 7',
            8 => esc_html__( 'Card catalog', 'bado-blog' ),
            9 => esc_html__( 'Box', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Categories - Meta tags (tags)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Categories - Meta tags (tags) in categories
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_cat_meta_tag', array(
        'selector' => '.badoblog-css-cat-meta-tax-tag-ul',
    ) );
    // -----------------  Section - Meta tags (tags) in categories
    $wp_customize->add_section( 'badoblog_cus_section_cat_meta_tag', array(
        'priority' => 10,
        'title'    => esc_html__( 'Meta tags (tags)', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_cat',
    ) );
    // ----------------- Activate meta tags (taxonomy tags)
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_tag', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_tag', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate meta tags (taxonomy tags)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_tag',
        'settings' => 'badoblog_cus_cat_meta_tag',
    ) );
    // ----------------- Maximum number of tag elements
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_tag_item', array(
        'default'           => 3,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_tag_item', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Maximum number of tag elements', 'bado-blog' ),
        'description' => '1 - 30 (' . $mes_def_1 . ' 3)',
        'section'     => 'badoblog_cus_section_cat_meta_tag',
        'settings'    => 'badoblog_cus_cat_meta_tag_item',
    ) );
    // ----------------- Size
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_tag_size', array(
        'default'           => 'mid',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_tag_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_tag',
        'settings' => 'badoblog_cus_cat_meta_tag_size',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'mid'   => esc_html__( 'Average', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // ----------------- Align to center
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_tag_center', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_tag_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Align to center', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_tag',
        'settings' => 'badoblog_cus_cat_meta_tag_center',
    ) );
    // ----------------- Tag icons
    $wp_customize->add_setting( 'badoblog_cus_cat_meta_tag_icon', array(
        'default'           => 3,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_cat_meta_tag_icon', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Icons', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_cat_meta_tag',
        'settings' => 'badoblog_cus_cat_meta_tag_icon',
        'choices'  => array(
            0 => esc_html__( 'Off', 'bado-blog' ),
            1 => esc_html__( 'Hashtag', 'bado-blog' ),
            2 => esc_html__( 'Hashtag', 'bado-blog' ) . ' (' . esc_html__( 'bold', 'bado-blog' ) . ')',
            3 => esc_html__( 'Sticker', 'bado-blog' ) . $mes_def_2,
            4 => esc_html__( 'Arrow', 'bado-blog' ),
            5 => esc_html__( 'Lightning', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Categories - Pagination
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Categories - Pagination
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_pagination_variant', array(
        'selector' => '.nav-links, .badoblog-css-loadmore',
    ) );
    // -----------------  Section - Pagination
    $wp_customize->add_section( 'badoblog_cus_section_pagination', array(
        'priority' => 20,
        'title'    => esc_html__( 'Pagination', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_cat',
    ) );
    // ----------------- Activate pagination in categories
    $wp_customize->add_setting( 'badoblog_cus_pagination_cat_activ', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_cat_activ', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate pagination in categories', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_cat_activ',
    ) );
    // ----------------- Activate pagination on the homepage
    $wp_customize->add_setting( 'badoblog_cus_pagination_home_activ', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_home_activ', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate pagination on the homepage', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_home_activ',
    ) );
    // -----------------  Pagination variation
    $wp_customize->add_setting( 'badoblog_cus_pagination_variant', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_variant', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Pagination variation', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_variant',
        'choices'  => array(
            'v0' => esc_html__( 'Classic (Back and forward)', 'bado-blog' ),
            'v1' => esc_html__( 'Numeric pagination', 'bado-blog' ),
            'v2' => esc_html__( 'Button', 'bado-blog' ) . ' (' . esc_html__( 'Show more', 'bado-blog' ) . ')',
        ),
    ) );
    // -----------------  Pagination section design
    $wp_customize->add_setting( 'badoblog_cus_pagination_design', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_design', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Design', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_design',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v1' => esc_html__( 'Buttons', 'bado-blog' ),
            'v2' => esc_html__( 'Frames', 'bado-blog' ),
        ),
    ) );
    // -----------------  Location of the pagination section
    $wp_customize->add_setting( 'badoblog_cus_pagination_layout', array(
        'default'           => 'v2',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_layout', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Location', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_layout',
        'choices'  => array(
            'v0' => esc_html__( 'Left', 'bado-blog' ),
            'v1' => esc_html__( 'Right', 'bado-blog' ),
            'v2' => esc_html__( 'Center', 'bado-blog' ),
            'v3' => esc_html__( 'Full width', 'bado-blog' ),
        ),
    ) );
    // -----------------  Pagination section size
    $wp_customize->add_setting( 'badoblog_cus_pagination_size', array(
        'default'           => 'v2',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_size',
        'choices'  => array(
            'v1' => esc_html__( 'Small', 'bado-blog' ),
            'v2' => esc_html__( 'Average', 'bado-blog' ),
            'v3' => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // ----------------- Remove buttons (back and next) from numeric pagination
    $wp_customize->add_setting( 'badoblog_cus_pagination_next', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_next', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove buttons (back and next) from numeric pagination', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_next',
    ) );
    // ----------------- Show all pagination items (for numeric)
    $wp_customize->add_setting( 'badoblog_cus_pagination_num_all', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_num_all', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Show all pagination items (for numeric)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_pagination',
        'settings' => 'badoblog_cus_pagination_num_all',
    ) );
    // ----------------- Remove hidden H2 tag from pagination
    $wp_customize->add_setting( 'badoblog_cus_pagination_tag_h2', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_pagination_tag_h2', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Remove hidden H2 tag from pagination', 'bado-blog' ),
        'description' => esc_html__( 'Removing H2 tag from pagination is good for SEO, but worse for special programs (for the visually impaired)', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_pagination',
        'settings'    => 'badoblog_cus_pagination_tag_h2',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Panel - Posts and pages
    $wp_customize->add_panel( 'badoblog_cus_panel_post', array(
        'title'    => esc_html__( 'Posts and pages', 'bado-blog' ),
        'priority' => 20,
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & pages - Basic
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Basic settings
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_general', array(
        'selector' => '.badoblog-css-mod-pp-content, .badoblog-css-post-content, .badoblog-css-page-content',
    ) );
    // -----------------  Section - Basic settings
    $wp_customize->add_section( 'badoblog_cus_section_post_general', array(
        'title' => esc_html__( 'Basic settings', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Where to display typography
    $wp_customize->add_setting( 'badoblog_cus_post_general', array(
        'default'           => 'post',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_general', array(
        'type'        => 'radio',
        'label'       => esc_html__( 'Where to display typography', 'bado-blog' ),
        'description' => esc_html__( 'Lists, Quotes, Headings', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_general',
        'settings'    => 'badoblog_cus_post_general',
        'choices'     => array(
            'post' => esc_html__( 'Only posts', 'bado-blog' ),
            'page' => esc_html__( 'Only pages', 'bado-blog' ),
            'pp'   => esc_html__( 'Posts and pages', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Top image
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Top image
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_img_top_post', array(
        'selector' => '.badoblog-css-post-thumbnail',
    ) );
    // -----------------  Section - Top image
    $wp_customize->add_section( 'badoblog_cus_section_post_img', array(
        'title' => esc_html__( 'Top image', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // ----------------- Remove the main (top) image in posts
    $wp_customize->add_setting( 'badoblog_cus_post_img_top_post', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_img_top_post', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove the main (top) image in posts', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_img',
        'settings' => 'badoblog_cus_post_img_top_post',
    ) );
    // ----------------- Remove the main (top) image in pages
    $wp_customize->add_setting( 'badoblog_cus_post_img_top_page', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_img_top_page', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove the main (top) image in pages', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_img',
        'settings' => 'badoblog_cus_post_img_top_page',
    ) );
    $w_img = esc_html__( 'width', 'bado-blog' );
    // ----------------- Image size post
    $wp_customize->add_setting( 'badoblog_cus_post_img_top_post_size', array(
        'default'           => 'max',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_img_top_post_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Limit the size of the top image in posts', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_img',
        'settings' => 'badoblog_cus_post_img_top_post_size',
        'choices'  => array(
            'max'     => esc_html__( 'Maximum', 'bado-blog' ),
            '960x540' => '960 ' . $w_img,
            '688x387' => '688 ' . $w_img,
            '560x315' => '560 ' . $w_img,
            '464x261' => '464 ' . $w_img,
            '384x216' => '384 ' . $w_img,
            '300x169' => '300 ' . $w_img,
        ),
    ) );
    // ----------------- Image size page
    $wp_customize->add_setting( 'badoblog_cus_post_img_top_page_size', array(
        'default'           => 'max',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_img_top_page_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Limit the size of the top image in pages', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_img',
        'settings' => 'badoblog_cus_post_img_top_page_size',
        'choices'  => array(
            'max'     => esc_html__( 'Maximum', 'bado-blog' ),
            '960x540' => '960 ' . $w_img,
            '688x387' => '688 ' . $w_img,
            '560x315' => '560 ' . $w_img,
            '464x261' => '464 ' . $w_img,
            '384x216' => '384 ' . $w_img,
            '300x169' => '300 ' . $w_img,
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Meta tags (meta boxs)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Meta tags (meta boxs)
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_meta_boxs', array(
        'selector' => '.badoblog-css-post-meta-boxs',
    ) );
    // -----------------  Section - Meta tags (meta boxs)
    $wp_customize->add_section( 'badoblog_cus_section_post_meta_boxs', array(
        'title' => esc_html__( 'Meta tags (meta boxs)', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Activate meta boxs
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate meta boxs', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs',
    ) );
    // -----------------  Title 1 - What meta tags to display
    class badoblog_cus_post_meta_boxs_panel_text_1 extends WP_Customize_Control {
        function render_content() {
            ?><div class="badoblog-c-panel-text"><?php 
            echo esc_html__( 'What meta boxs to display', 'bado-blog' );
            ?></div><?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_panel_text_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_post_meta_boxs_panel_text_1($wp_customize, 'badoblog_cus_post_meta_boxs_set_panel_text_1', array(
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_panel_text_1',
    )) );
    // -----------------  Post author
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_autor', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_autor', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Post author', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_autor',
    ) );
    // -----------------  Post creation date
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_date', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_date', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Post creation date', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_date',
    ) );
    // -----------------  Post update date
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_update', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_update', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Post update date', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_update',
    ) );
    // -----------------  Number of comments
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_comment', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_comment', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Number of comments', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_comment',
    ) );
    // -----------------  Post reading time
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_time', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_time', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Post reading time', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_time',
    ) );
    // -----------------  Number of post views
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_view', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_view', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Number of post views', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_view',
    ) );
    // -----------------  Size of meta boxs
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_size', array(
        'default'           => 'big',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_size',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // -----------------  Align meta boxs to the center
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_center', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Align meta boxs to the center', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_center',
    ) );
    // -----------------  Remove decryption in meta boxs
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_label', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_label', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove decryption in meta boxs', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_label',
    ) );
    // -----------------  Meta box design
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_design', array(
        'default'           => 'v4',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_design', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Meta box design', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_design',
        'choices'  => array(
            'v0' => esc_html__( 'Simple', 'bado-blog' ),
            'v1' => esc_html__( 'Frames', 'bado-blog' ),
            'v2' => esc_html__( 'Underlined', 'bado-blog' ),
            'v3' => esc_html__( 'Underlined', 'bado-blog' ) . ' (' . esc_html__( 'circle', 'bado-blog' ) . ')',
            'v4' => esc_html__( 'Soaring', 'bado-blog' ),
            'v5' => esc_html__( 'Deepening', 'bado-blog' ),
            'v6' => esc_html__( 'Background', 'bado-blog' ),
        ),
    ) );
    // -----------------  Remove icons in meta boxes
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_icon', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_icon', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove icons', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_icon',
    ) );
    // -----------------  Add tooltips to meta boxs
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_prompt', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_prompt', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add tooltips to meta boxs', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_prompt',
    ) );
    // ----------------- Add the date to the bottom of the post
    $wp_customize->add_setting( 'badoblog_cus_post_meta_boxs_footer_date', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_boxs_footer_date', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add the date to the bottom of the post', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_boxs',
        'settings' => 'badoblog_cus_post_meta_boxs_footer_date',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Meta tags (categories)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Meta tags (categories)
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_meta_cat', array(
        'selector' => '.badoblog-css-post-tax-cat',
    ) );
    // -----------------  Section - Meta tags (categories)
    $wp_customize->add_section( 'badoblog_cus_section_post_meta_cat', array(
        'title' => esc_html__( 'Meta tags (categories)', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Activate meta tags categories
    $wp_customize->add_setting( 'badoblog_cus_post_meta_cat', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_cat', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate meta tags categories', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_cat',
        'settings' => 'badoblog_cus_post_meta_cat',
    ) );
    // ----------------- Maximum number of category elements
    $wp_customize->add_setting( 'badoblog_cus_post_meta_cat_item', array(
        'default'           => 3,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_20',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_cat_item', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Maximum number of category elements', 'bado-blog' ),
        'description' => '1 - 20 (' . $mes_def_1 . ' 3)',
        'section'     => 'badoblog_cus_section_post_meta_cat',
        'settings'    => 'badoblog_cus_post_meta_cat_item',
    ) );
    // -----------------  Where to display meta tags for categories
    $wp_customize->add_setting( 'badoblog_cus_post_meta_cat_lay', array(
        'default'           => 'thumb-bottom',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_cat_lay', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Where to display meta tags', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_cat',
        'settings' => 'badoblog_cus_post_meta_cat_lay',
        'choices'  => array(
            'thumb-top'    => esc_html__( 'In the image (top)', 'bado-blog' ),
            'thumb-bottom' => esc_html__( 'In the image (bottom)', 'bado-blog' ),
            'top'          => esc_html__( 'Top of content', 'bado-blog' ),
            'bottom'       => esc_html__( 'Bottom of content', 'bado-blog' ),
        ),
    ) );
    // -----------------  Size
    $wp_customize->add_setting( 'badoblog_cus_post_meta_cat_size', array(
        'default'           => 'big',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_cat_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_cat',
        'settings' => 'badoblog_cus_post_meta_cat_size',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // -----------------  Align meta boxs to the center
    $wp_customize->add_setting( 'badoblog_cus_post_meta_cat_center', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_cat_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Align center', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_cat',
        'settings' => 'badoblog_cus_post_meta_cat_center',
    ) );
    // -----------------  Remove decryption
    $wp_customize->add_setting( 'badoblog_cus_post_meta_cat_label', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_cat_label', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove decryption', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_cat',
        'settings' => 'badoblog_cus_post_meta_cat_label',
    ) );
    // ----------------- Cat icons
    $wp_customize->add_setting( 'badoblog_cus_post_meta_cat_icon', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_cat_icon', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Icons', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_cat',
        'settings' => 'badoblog_cus_post_meta_cat_icon',
        'choices'  => array(
            0 => esc_html__( 'Off', 'bado-blog' ),
            1 => esc_html__( 'Folder', 'bado-blog' ) . ' 1' . $mes_def_2,
            2 => esc_html__( 'Folder', 'bado-blog' ) . ' 2',
            3 => esc_html__( 'Folder', 'bado-blog' ) . ' 3',
            4 => esc_html__( 'Folder', 'bado-blog' ) . ' 4',
            5 => esc_html__( 'Folder', 'bado-blog' ) . ' 5',
            6 => esc_html__( 'Folder', 'bado-blog' ) . ' 6',
            7 => esc_html__( 'Folder', 'bado-blog' ) . ' 7',
            8 => esc_html__( 'Card catalog', 'bado-blog' ),
            9 => esc_html__( 'Box', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Meta tags (tags)
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Meta tags (tags)
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_meta_tag', array(
        'selector' => '.badoblog-css-post-tax-tag',
    ) );
    // -----------------  Section - Meta tags (tags)
    $wp_customize->add_section( 'badoblog_cus_section_post_meta_tag', array(
        'title' => esc_html__( 'Meta tags (tags)', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Activate meta tags (taxonomy tags)
    $wp_customize->add_setting( 'badoblog_cus_post_meta_tag', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_tag', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate meta tags (taxonomy tags)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_tag',
        'settings' => 'badoblog_cus_post_meta_tag',
    ) );
    // ----------------- Maximum number of tag elements
    $wp_customize->add_setting( 'badoblog_cus_post_meta_tag_item', array(
        'default'           => 5,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_tag_item', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Maximum number of tag elements', 'bado-blog' ),
        'description' => '1 - 30 (' . $mes_def_1 . ' 5)',
        'section'     => 'badoblog_cus_section_post_meta_tag',
        'settings'    => 'badoblog_cus_post_meta_tag_item',
    ) );
    // -----------------  Where to display meta tags for tags
    $wp_customize->add_setting( 'badoblog_cus_post_meta_tag_lay', array(
        'default'           => 'bottom',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_tag_lay', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Where to display meta tags', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_tag',
        'settings' => 'badoblog_cus_post_meta_tag_lay',
        'choices'  => array(
            'top'    => esc_html__( 'Top of content', 'bado-blog' ),
            'bottom' => esc_html__( 'Bottom of content', 'bado-blog' ),
        ),
    ) );
    // -----------------  Size of meta boxs and taxonomies
    $wp_customize->add_setting( 'badoblog_cus_post_meta_tag_size', array(
        'default'           => 'big',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_tag_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_tag',
        'settings' => 'badoblog_cus_post_meta_tag_size',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // -----------------  Align meta boxs to the center
    $wp_customize->add_setting( 'badoblog_cus_post_meta_tag_center', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_tag_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Align center', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_tag',
        'settings' => 'badoblog_cus_post_meta_tag_center',
    ) );
    // -----------------  Remove decryption
    $wp_customize->add_setting( 'badoblog_cus_post_meta_tag_label', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_tag_label', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove decryption', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_tag',
        'settings' => 'badoblog_cus_post_meta_tag_label',
    ) );
    // ----------------- Tag icons
    $wp_customize->add_setting( 'badoblog_cus_post_meta_tag_icon', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_meta_tag_icon', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Icons', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_meta_tag',
        'settings' => 'badoblog_cus_post_meta_tag_icon',
        'choices'  => array(
            0 => esc_html__( 'Off', 'bado-blog' ),
            1 => esc_html__( 'Hashtag', 'bado-blog' ) . $mes_def_2,
            2 => esc_html__( 'Hashtag', 'bado-blog' ) . ' (' . esc_html__( 'bold', 'bado-blog' ) . ')',
            3 => esc_html__( 'Sticker', 'bado-blog' ),
            4 => esc_html__( 'Arrow', 'bado-blog' ),
            5 => esc_html__( 'Lightning', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Lists
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Lists (bulleted lists)
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_li_mark', array(
        'selector' => '.badoblog-css-mod-pp-content > ul, .badoblog-css-post-content > ul, .badoblog-css-page-content > ul',
    ) );
    // -----------------  Marker - Posts and pages - Lists (numeric lists)
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_li_num', array(
        'selector' => '.badoblog-css-mod-pp-content > ol, .badoblog-css-post-content > ol, .badoblog-css-page-content > ol',
    ) );
    // -----------------  Section - Lists
    $wp_customize->add_section( 'badoblog_cus_section_post_li', array(
        'title' => esc_html__( 'Lists', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Bulleted lists variation
    $wp_customize->add_setting( 'badoblog_cus_post_li_mark', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_li_mark', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Bulleted lists variation', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_li',
        'settings' => 'badoblog_cus_post_li_mark',
        'choices'  => array(
            'v0'  => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v1'  => esc_html__( 'Small dot', 'bado-blog' ),
            'v2'  => esc_html__( 'Small square', 'bado-blog' ),
            'v3'  => esc_html__( 'Small circle', 'bado-blog' ),
            'v4'  => esc_html__( 'Square frame', 'bado-blog' ),
            'v5'  => esc_html__( 'Small dash', 'bado-blog' ),
            'v6'  => esc_html__( 'Big dot', 'bado-blog' ),
            'v7'  => esc_html__( 'Big square', 'bado-blog' ),
            'v8'  => esc_html__( 'Big circle', 'bado-blog' ),
            'v9'  => esc_html__( 'Rounded square frame', 'bado-blog' ),
            'v10' => esc_html__( 'Big dash', 'bado-blog' ),
            'v11' => esc_html__( 'Check mark', 'bado-blog' ),
            'v12' => esc_html__( 'Rhombus', 'bado-blog' ),
            'v13' => esc_html__( 'Triangle', 'bado-blog' ),
            'v14' => esc_html__( 'Star', 'bado-blog' ),
            'v15' => esc_html__( 'Snowflake', 'bado-blog' ),
        ),
    ) );
    // -----------------  Numeric lists variation
    $wp_customize->add_setting( 'badoblog_cus_post_li_num', array(
        'default'           => 'v5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_li_num', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Numeric lists variation', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_li',
        'settings' => 'badoblog_cus_post_li_num',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v1' => esc_html__( 'Colored square', 'bado-blog' ),
            'v2' => esc_html__( 'Square frame', 'bado-blog' ),
            'v3' => esc_html__( 'Colored circle', 'bado-blog' ),
            'v4' => esc_html__( 'Round frame', 'bado-blog' ),
            'v5' => esc_html__( 'Colored numbers', 'bado-blog' ),
            'v6' => esc_html__( 'Colored numbers (bold)', 'bado-blog' ),
            'v7' => esc_html__( 'Latin numerals', 'bado-blog' ),
            'v8' => esc_html__( 'Colored letters (EN)', 'bado-blog' ),
        ),
    ) );
    // -----------------  Dividing line - Numbered lists
    class badoblog_cus_post_li_panel_border extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_post_li_panel_border', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_post_li_panel_border($wp_customize, 'badoblog_cus_post_li_set_panel_border', array(
        'section'  => 'badoblog_cus_section_post_li',
        'settings' => 'badoblog_cus_post_li_panel_border',
    )) );
    // -----------------  Marker color - bulleted lists
    $wp_customize->add_setting( 'badoblog_cus_post_li_mark_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_li_mark_color', array(
        'label'       => esc_html__( 'Marker color', 'bado-blog' ) . ' (' . esc_html__( 'bulleted lists', 'bado-blog' ) . ')',
        'description' => esc_html__( 'Default - color of small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_li',
        'settings'    => 'badoblog_cus_post_li_mark_color',
    )) );
    // -----------------  Marker color - numbered lists
    $wp_customize->add_setting( 'badoblog_cus_post_li_num_back_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_li_num_back_color', array(
        'label'       => esc_html__( 'Marker color', 'bado-blog' ) . ' (' . esc_html__( 'numbered lists', 'bado-blog' ) . ')',
        'description' => esc_html__( 'Default - color of small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_li',
        'settings'    => 'badoblog_cus_post_li_num_back_color',
    )) );
    // -----------------  Inner color for marker - numbered lists
    $wp_customize->add_setting( 'badoblog_cus_post_li_num_text_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_li_num_text_color', array(
        'label'       => esc_html__( 'Inner color for marker', 'bado-blog' ) . ' (' . esc_html__( 'numbered lists', 'bado-blog' ) . ')',
        'description' => esc_html__( 'Default - secondary color for small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_li',
        'settings'    => 'badoblog_cus_post_li_num_text_color',
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Quotes
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Quote blocks
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_quote_icon', array(
        'selector' => '.badoblog-css-mod-pp-content > blockquote, .badoblog-css-post-content > blockquote, .badoblog-css-page-content > blockquote',
    ) );
    // -----------------  Section - Quote blocks
    $wp_customize->add_section( 'badoblog_cus_section_post_quote', array(
        'title' => esc_html__( 'Quote blocks', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Quote block design
    $wp_customize->add_setting( 'badoblog_cus_post_quote', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_quote', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Design', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_quote',
        'settings' => 'badoblog_cus_post_quote',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v1' => esc_html__( 'Just a block', 'bado-blog' ),
            'v2' => esc_html__( 'Gradient 1 (fill)', 'bado-blog' ),
            'v3' => esc_html__( 'Gradient 2 (fill)', 'bado-blog' ),
            'v4' => esc_html__( 'Grid (fill)', 'bado-blog' ),
            'v5' => esc_html__( 'Folded corner', 'bado-blog' ),
            'v6' => esc_html__( 'Solid frame', 'bado-blog' ),
            'v7' => esc_html__( 'Dotted frame', 'bado-blog' ),
            'v8' => esc_html__( 'Border left', 'bado-blog' ),
            'v9' => esc_html__( 'Double border', 'bado-blog' ),
        ),
    ) );
    // -----------------  Quote block background color
    $wp_customize->add_setting( 'badoblog_cus_post_quote_back_color', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_quote_back_color', array(
        'label'       => esc_html__( 'Background color', 'bado-blog' ),
        'description' => esc_html__( 'Some styles work well with the background', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_quote',
        'settings'    => 'badoblog_cus_post_quote_back_color',
    )) );
    // -----------------  Automatic background color for block quotes
    $wp_customize->add_setting( 'badoblog_cus_post_quote_auto_color', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_quote_auto_color', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Activate automatic background color selection', 'bado-blog' ),
        'description' => esc_html__( '(The color is selected based on the background of the content part)', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_quote',
        'settings'    => 'badoblog_cus_post_quote_auto_color',
    ) );
    // -----------------  Quote block text color
    $wp_customize->add_setting( 'badoblog_cus_post_quote_text_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_quote_text_color', array(
        'label'       => esc_html__( 'Text color', 'bado-blog' ),
        'description' => esc_html__( 'Default - general text color', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_quote',
        'settings'    => 'badoblog_cus_post_quote_text_color',
    )) );
    // -----------------  Dividing line - Quote block
    class badoblog_cus_post_quote_panel_border extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_post_quote_panel_border', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_post_quote_panel_border($wp_customize, 'badoblog_cus_post_quote_set_panel_border', array(
        'section'  => 'badoblog_cus_section_post_quote',
        'settings' => 'badoblog_cus_post_quote_panel_border',
    )) );
    // -----------------  Add icon to quote block
    $wp_customize->add_setting( 'badoblog_cus_post_quote_icon', array(
        'default'           => 1,
        'transport'         => 'postMessage',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_quote_icon', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add icon', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_quote',
        'settings' => 'badoblog_cus_post_quote_icon',
    ) );
    // -----------------  Choosing the location of the icon in the quote block
    $wp_customize->add_setting( 'badoblog_cus_post_quote_icon_layout', array(
        'default'           => 'center',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_quote_icon_layout', array(
        'type'        => 'select',
        'label'       => esc_html__( 'Icon location', 'bado-blog' ),
        'description' => esc_html__( 'Together with the icon, the text is also aligned', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_quote',
        'settings'    => 'badoblog_cus_post_quote_icon_layout',
        'choices'     => array(
            'left'   => esc_html__( 'Left', 'bado-blog' ),
            'center' => esc_html__( 'Centered', 'bado-blog' ),
        ),
    ) );
    // -----------------  Selecting an icon for the quote block
    $wp_customize->add_setting( 'badoblog_cus_post_quote_icon_select', array(
        'default'           => 'v4',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_quote_icon_select', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Icon selection', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_quote',
        'settings' => 'badoblog_cus_post_quote_icon_select',
        'choices'  => array(
            'v1'  => esc_html__( 'Square quotes', 'bado-blog' ),
            'v2'  => esc_html__( 'Rectangular quotes', 'bado-blog' ),
            'v3'  => esc_html__( 'Sharp quotes', 'bado-blog' ),
            'v4'  => esc_html__( 'Round quotes', 'bado-blog' ),
            'v5'  => esc_html__( 'Paper clip', 'bado-blog' ),
            'v6'  => esc_html__( 'Paper clip (vertical)', 'bado-blog' ),
            'v7'  => esc_html__( 'Drawing pin', 'bado-blog' ),
            'v8'  => esc_html__( 'Drawing pin (vertical)', 'bado-blog' ),
            'v9'  => esc_html__( 'Bulb', 'bado-blog' ),
            'v10' => esc_html__( 'Bell', 'bado-blog' ),
            'v11' => esc_html__( 'Attention triangle', 'bado-blog' ),
            'v12' => esc_html__( 'Exclamation sheet', 'bado-blog' ),
            'v13' => esc_html__( 'Exclamation mark', 'bado-blog' ),
            'v14' => esc_html__( 'Cloud conversation', 'bado-blog' ),
            'v15' => esc_html__( 'Speaker', 'bado-blog' ),
            'v16' => esc_html__( 'Open book', 'bado-blog' ),
            'v17' => esc_html__( 'Embossed tick', 'bado-blog' ),
            'v18' => esc_html__( 'Solid tick', 'bado-blog' ),
        ),
    ) );
    // -----------------  Quote block icons color
    $wp_customize->add_setting( 'badoblog_cus_post_quote_icon_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_quote_icon_color', array(
        'label'       => esc_html__( 'Icon color', 'bado-blog' ),
        'description' => esc_html__( 'Default - secondary color for small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_quote',
        'settings'    => 'badoblog_cus_post_quote_icon_color',
    )) );
    // -----------------  Quote block icon size
    $wp_customize->add_setting( 'badoblog_cus_post_quote_icon_size', array(
        'default'           => 36,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_quote_icon_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Icon size', 'bado-blog' ),
        'description' => '5 - 100 px (' . $mes_def_1 . ' 36 px)',
        'section'     => 'badoblog_cus_section_post_quote',
        'settings'    => 'badoblog_cus_post_quote_icon_size',
    ) );
    // -----------------  Add background for icon
    $wp_customize->add_setting( 'badoblog_cus_post_quote_icon_back_activ', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_quote_icon_back_activ', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add background for icon', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_quote',
        'settings' => 'badoblog_cus_post_quote_icon_back_activ',
    ) );
    // -----------------  Background color of icons and lines for block quotes
    $wp_customize->add_setting( 'badoblog_cus_post_quote_element_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_quote_element_color', array(
        'label'       => esc_html__( 'Background color of icons and lines', 'bado-blog' ),
        'description' => esc_html__( 'Default - color of small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_quote',
        'settings'    => 'badoblog_cus_post_quote_element_color',
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - H1
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - H1 headings
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_h1_color', array(
        'selector' => '.badoblog-css-mod-pp-content > h1, .badoblog-css-post-content > h1, .badoblog-css-page-content > h1, .badoblog-css-mod-pp-header h1, .badoblog-css-post-header h1, .badoblog-css-page-header h1',
    ) );
    // -----------------  Section - H1 headings
    $wp_customize->add_section( 'badoblog_cus_section_post_h1', array(
        'title' => esc_html__( 'H1 headings', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Text color of H1 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h1_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h1_color', array(
        'label'       => esc_html__( 'Text color', 'bado-blog' ),
        'description' => esc_html__( 'Default - titles text general color', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h1',
        'settings'    => 'badoblog_cus_post_h1_color',
    )) );
    // -----------------  Header H1 Font
    $wp_customize->add_setting( 'badoblog_cus_post_h1_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h1_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h1',
        'settings' => 'badoblog_cus_post_h1_font',
        'choices'  => $badoblog_font,
    ) );
    // -----------------  Header H1 text size
    $wp_customize->add_setting( 'badoblog_cus_post_h1_size', array(
        'default'           => 32,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h1_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ),
        'description' => '5 - 100 px (' . $mes_def_1 . ' 32 px)',
        'section'     => 'badoblog_cus_section_post_h1',
        'settings'    => 'badoblog_cus_post_h1_size',
    ) );
    // ----------------- Line height for H1 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h1_height', array(
        'default'           => '1.5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h1_height', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Line height', 'bado-blog' ),
        'description' => '0.8 - 5 (' . $mes_def_1 . ' 1.5)',
        'section'     => 'badoblog_cus_section_post_h1',
        'settings'    => 'badoblog_cus_post_h1_height',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - H2
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Headings H2
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_h2', array(
        'selector' => '.badoblog-css-mod-pp-content > h2, .badoblog-css-post-content > h2, .badoblog-css-page-content > h2',
    ) );
    // -----------------  Section - Headings H2
    $wp_customize->add_section( 'badoblog_cus_section_post_h2', array(
        'title' => esc_html__( 'Headings H2', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  H2 headings variation
    $wp_customize->add_setting( 'badoblog_cus_post_h2', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h2', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Heading options', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h2',
        'settings' => 'badoblog_cus_post_h2',
        'choices'  => array(
            'off' => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v0'  => esc_html__( 'Simple headers', 'bado-blog' ),
            'v1'  => esc_html__( 'Light underlining', 'bado-blog' ),
            'v2'  => esc_html__( 'Side border', 'bado-blog' ),
            'v3'  => esc_html__( 'With numbering', 'bado-blog' ),
            'v4'  => esc_html__( 'With icon selection', 'bado-blog' ),
            'v5'  => esc_html__( 'With arbitrary value', 'bado-blog' ),
        ),
    ) );
    // -----------------  H2 heading icon selection
    $wp_customize->add_setting( 'badoblog_cus_post_h2_icon_select', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h2_icon_select', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Icon selection', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h2',
        'settings' => 'badoblog_cus_post_h2_icon_select',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off icons', 'bado-blog' ),
            'v1' => esc_html__( 'Right arrow', 'bado-blog' ),
            'v2' => esc_html__( 'Arrow to down', 'bado-blog' ),
            'v3' => esc_html__( 'Arrow right and down', 'bado-blog' ),
            'v4' => esc_html__( 'Volumetric arrow', 'bado-blog' ),
            'v5' => esc_html__( 'Pencil', 'bado-blog' ),
            'v6' => esc_html__( 'Check mark', 'bado-blog' ),
            'v7' => esc_html__( 'Small flag', 'bado-blog' ),
            'v8' => esc_html__( 'Blocks', 'bado-blog' ),
            'v9' => esc_html__( 'Block hierarchy', 'bado-blog' ),
        ),
    ) );
    // -----------------  Add label to header H2 counter
    $wp_customize->add_setting( 'badoblog_cus_post_h2_count_text', array(
        'default'           => esc_html__( 'Par.', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h2_count_text', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Add label', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h2',
        'settings' => 'badoblog_cus_post_h2_count_text',
    ) );
    // -----------------  Add custom value for H2 header
    $wp_customize->add_setting( 'badoblog_cus_post_h2_tag', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h2_tag', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Add label', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h2',
        'settings' => 'badoblog_cus_post_h2_tag',
    ) );
    // -----------------  H2 heading icons text color
    $wp_customize->add_setting( 'badoblog_cus_post_h2_icon_text_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h2_icon_text_color', array(
        'label'       => esc_html__( 'Heading icons text color', 'bado-blog' ),
        'description' => esc_html__( 'Default - secondary color for small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h2',
        'settings'    => 'badoblog_cus_post_h2_icon_text_color',
    )) );
    // -----------------  Background color of icons and lines of H2 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h2_element_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h2_element_color', array(
        'label'       => esc_html__( 'Background color of icons and lines for heading', 'bado-blog' ),
        'description' => esc_html__( 'Default - color of small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h2',
        'settings'    => 'badoblog_cus_post_h2_element_color',
    )) );
    // -----------------  Dividing line - H2 post headings
    class badoblog_cus_post_h2_panel_border extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_post_h2_panel_border', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_post_h2_panel_border($wp_customize, 'badoblog_cus_post_h2_set_panel_border', array(
        'section'  => 'badoblog_cus_section_post_h2',
        'settings' => 'badoblog_cus_post_h2_panel_border',
    )) );
    // -----------------  Background color of H2 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h2_back_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h2_back_color', array(
        'label'       => esc_html__( 'Headings background color', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h2',
        'description' => esc_html__( 'Default - site body background color', 'bado-blog' ),
        'settings'    => 'badoblog_cus_post_h2_back_color',
    )) );
    // -----------------  Text color of H2 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h2_text_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h2_text_color', array(
        'label'       => esc_html__( 'Headings text color', 'bado-blog' ),
        'description' => esc_html__( 'Default - titles text general color', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h2',
        'settings'    => 'badoblog_cus_post_h2_text_color',
    )) );
    // -----------------  Font for H2 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h2_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h2_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h2',
        'settings' => 'badoblog_cus_post_h2_font',
        'choices'  => $badoblog_font,
    ) );
    // -----------------  Text size of H2 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h2_size', array(
        'default'           => 26,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h2_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ),
        'description' => '5 - 100 px (' . $mes_def_1 . ' 26 px)',
        'section'     => 'badoblog_cus_section_post_h2',
        'settings'    => 'badoblog_cus_post_h2_size',
    ) );
    // ----------------- Line height for H2 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h2_height', array(
        'default'           => '1.5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h2_height', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Line height', 'bado-blog' ),
        'description' => '0.8 - 5 (' . $mes_def_1 . ' 1.5)',
        'section'     => 'badoblog_cus_section_post_h2',
        'settings'    => 'badoblog_cus_post_h2_height',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - H3 - H6
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Headings H3 - H6
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_h36', array(
        'selector' => '.badoblog-css-mod-pp-content > h3, .badoblog-css-post-content > h3, .badoblog-css-page-content > h3',
    ) );
    // -----------------  Section - Headings H3 - H6
    $wp_customize->add_section( 'badoblog_cus_section_post_h36', array(
        'title' => esc_html__( 'Headings H3 - H6', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  H3 - H6 headings variation
    $wp_customize->add_setting( 'badoblog_cus_post_h36', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Heading options', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h36',
        'settings' => 'badoblog_cus_post_h36',
        'choices'  => array(
            'off' => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v0'  => esc_html__( 'Simple headers', 'bado-blog' ),
            'v1'  => esc_html__( 'Light underlining', 'bado-blog' ),
            'v2'  => esc_html__( 'Side border', 'bado-blog' ),
            'v3'  => esc_html__( 'With numbering', 'bado-blog' ),
            'v4'  => esc_html__( 'With icon selection', 'bado-blog' ),
            'v5'  => esc_html__( 'With arbitrary value', 'bado-blog' ),
        ),
    ) );
    // -----------------  H3 - H6 heading icon selection
    $wp_customize->add_setting( 'badoblog_cus_post_h36_icon_select', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_icon_select', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Icon selection', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h36',
        'settings' => 'badoblog_cus_post_h36_icon_select',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off icons', 'bado-blog' ),
            'v1' => esc_html__( 'Right arrow', 'bado-blog' ),
            'v2' => esc_html__( 'Arrow to down', 'bado-blog' ),
            'v3' => esc_html__( 'Arrow right and down', 'bado-blog' ),
            'v4' => esc_html__( 'Volumetric arrow', 'bado-blog' ),
            'v5' => esc_html__( 'Pencil', 'bado-blog' ),
            'v6' => esc_html__( 'Check mark', 'bado-blog' ),
            'v7' => esc_html__( 'Small flag', 'bado-blog' ),
            'v8' => esc_html__( 'Blocks', 'bado-blog' ),
            'v9' => esc_html__( 'Block hierarchy', 'bado-blog' ),
        ),
    ) );
    // -----------------  Add label to header H3 - H6 counter
    $wp_customize->add_setting( 'badoblog_cus_post_h36_count_text', array(
        'default'           => esc_html__( 'Par.', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_count_text', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Add label', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h36',
        'settings' => 'badoblog_cus_post_h36_count_text',
    ) );
    // -----------------  Add custom value for H3 - H6 header
    $wp_customize->add_setting( 'badoblog_cus_post_h36_tag', array(
        'default'           => '#',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_tag', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Add label', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h36',
        'settings' => 'badoblog_cus_post_h36_tag',
    ) );
    // -----------------  H3 - H6 heading icons text color
    $wp_customize->add_setting( 'badoblog_cus_post_h36_icon_text_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h36_icon_text_color', array(
        'label'       => esc_html__( 'Heading icons text color', 'bado-blog' ),
        'description' => esc_html__( 'Default - secondary color for small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_icon_text_color',
    )) );
    // -----------------  Background color of icons and lines of H3 - H6 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_element_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h36_element_color', array(
        'label'       => esc_html__( 'Background color of icons and lines for heading', 'bado-blog' ),
        'description' => esc_html__( 'Default - color of small elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_element_color',
    )) );
    // -----------------  Dividing line - H3 - H6 post headings
    class badoblog_cus_post_h36_panel_border extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_post_h36_panel_border', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_post_h36_panel_border($wp_customize, 'badoblog_cus_post_h36_set_panel_border', array(
        'section'  => 'badoblog_cus_section_post_h36',
        'settings' => 'badoblog_cus_post_h36_panel_border',
    )) );
    // -----------------  Background color of H3 - H6 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_back_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h36_back_color', array(
        'label'       => esc_html__( 'Headings background color', 'bado-blog' ),
        'description' => esc_html__( 'Default - site body background color', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_back_color',
    )) );
    // -----------------  Text color of H3 - H6 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_text_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_h36_text_color', array(
        'label'       => esc_html__( 'Headings text color', 'bado-blog' ),
        'description' => esc_html__( 'Default - titles text general color', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_text_color',
    )) );
    // ----------------- Font for H3 - H6 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_h36',
        'settings' => 'badoblog_cus_post_h36_font',
        'choices'  => $badoblog_font,
    ) );
    // ----------------- Text size of H3 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_h3_size', array(
        'default'           => 24,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_h3_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ) . ' (H3)',
        'description' => '5 - 100 px (' . $mes_def_1 . ' 24 px)',
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_h3_size',
    ) );
    // -----------------  Text size of H4 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_h4_size', array(
        'default'           => 22,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_h4_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ) . ' (H4)',
        'description' => '5 - 100 px (' . $mes_def_1 . ' 22 px)',
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_h4_size',
    ) );
    // -----------------  Text size of H5 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_h5_size', array(
        'default'           => 20,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_h5_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ) . ' (H5)',
        'description' => '5 - 100 px (' . $mes_def_1 . ' 20 px)',
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_h5_size',
    ) );
    // -----------------  Text size of H6 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_h6_size', array(
        'default'           => 18,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_100',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_h6_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ) . ' (H6)',
        'description' => '5 - 100 px (' . $mes_def_1 . ' 18 px)',
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_h6_size',
    ) );
    // ----------------- Line height for H3 - H6 headings
    $wp_customize->add_setting( 'badoblog_cus_post_h36_height', array(
        'default'           => '1.5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_h36_height', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Line height', 'bado-blog' ) . ' (H3 - H6)',
        'description' => '0.8 - 5 (' . $mes_def_1 . ' 1.5)',
        'section'     => 'badoblog_cus_section_post_h36',
        'settings'    => 'badoblog_cus_post_h36_height',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Text
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - Text
    $wp_customize->add_section( 'badoblog_cus_section_post_text', array(
        'title' => esc_html__( 'Text', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // ----------------- Text font
    $wp_customize->add_setting( 'badoblog_cus_post_text_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_text_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Text font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_text',
        'settings' => 'badoblog_cus_post_text_font',
        'choices'  => $badoblog_font,
    ) );
    // ----------------- Text size
    $wp_customize->add_setting( 'badoblog_cus_post_text_size', array(
        'default'           => 18,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_text_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 18 px)',
        'section'     => 'badoblog_cus_section_post_text',
        'settings'    => 'badoblog_cus_post_text_size',
    ) );
    // ----------------- Text line height
    $wp_customize->add_setting( 'badoblog_cus_post_text_height', array(
        'default'           => '1.5',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_08_5',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_text_height', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text line height', 'bado-blog' ),
        'description' => '0.8 - 5 (' . $mes_def_1 . ' 1.5)',
        'section'     => 'badoblog_cus_section_post_text',
        'settings'    => 'badoblog_cus_post_text_height',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Links
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - Links in content
    $wp_customize->add_section( 'badoblog_cus_section_post_link', array(
        'title' => esc_html__( 'Links in content', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Remove link underline
    $wp_customize->add_setting( 'badoblog_cus_post_link_underline', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_link_underline', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Remove link underline', 'bado-blog' ),
        'description' => esc_html__( 'This removes the underlining of links in the content text', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_link',
        'settings'    => 'badoblog_cus_post_link_underline',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Author
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Author section
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_bio', array(
        'selector' => '.badoblog-css-bio-post-box',
    ) );
    // -----------------  Section - Author section
    $wp_customize->add_section( 'badoblog_cus_section_post_bio', array(
        'title' => esc_html__( 'Author section', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Activate author section
    $wp_customize->add_setting( 'badoblog_cus_post_bio', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate author section', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio',
    ) );
    // -----------------  Author section separator variation
    $wp_customize->add_setting( 'badoblog_cus_post_bio_design', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_design', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Separator variation', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio_design',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off separators', 'bado-blog' ),
            'v1' => esc_html__( 'Soaring', 'bado-blog' ),
            'v2' => esc_html__( 'Deepening', 'bado-blog' ),
            'v3' => esc_html__( 'Dividers in width', 'bado-blog' ),
            'v4' => esc_html__( 'Dividers in center', 'bado-blog' ),
            'v5' => esc_html__( 'In frame', 'bado-blog' ),
        ),
    ) );
    // -----------------  Change the style of author section separators
    $wp_customize->add_setting( 'badoblog_cus_post_bio_design_line', array(
        'default'           => 'solid',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_design_line', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Separator style', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio_design_line',
        'choices'  => array(
            'solid'  => esc_html__( 'Solid line', 'bado-blog' ),
            'dashed' => esc_html__( 'Dashed line', 'bado-blog' ),
            'dotted' => esc_html__( 'Dotted line', 'bado-blog' ),
            'double' => esc_html__( 'Double line', 'bado-blog' ),
        ),
    ) );
    // -----------------  Changing the thickness of author section dividers
    $wp_customize->add_setting( 'badoblog_cus_post_bio_design_size', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_0_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_design_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Separator thickness', 'bado-blog' ),
        'description' => '0 - 30 px (' . $mes_def_1 . ' 1 px)',
        'section'     => 'badoblog_cus_section_post_bio',
        'settings'    => 'badoblog_cus_post_bio_design_size',
    ) );
    // -----------------  Hide avatar in author section
    $wp_customize->add_setting( 'badoblog_cus_post_bio_avatar', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_avatar', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Hide avatar', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio_avatar',
    ) );
    // -----------------  Hide description in author section
    $wp_customize->add_setting( 'badoblog_cus_post_bio_description', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_description', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Hide description', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio_description',
    ) );
    // -----------------  Add author latest posts to author section
    $wp_customize->add_setting( 'badoblog_cus_post_bio_related', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_related', array(
        'type'     => 'checkbox',
        'priority' => 40,
        'label'    => esc_html__( 'Add author latest posts to author section', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio_related',
    ) );
    // -----------------  Author posts title
    $wp_customize->add_setting( 'badoblog_cus_post_bio_related_h', array(
        'default'           => esc_html__( 'Latest entries of author', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_related_h', array(
        'type'     => 'text',
        'priority' => 40,
        'label'    => esc_html__( 'Author posts title', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio_related_h',
    ) );
    // -----------------  Number of author posts in the author section
    $wp_customize->add_setting( 'badoblog_cus_post_bio_related_amount', array(
        'default'           => 12,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_bio_related_amount', array(
        'type'     => 'number',
        'priority' => 40,
        'label'    => esc_html__( 'Number of posts', 'bado-blog' ) . ' (max 50)',
        'section'  => 'badoblog_cus_section_post_bio',
        'settings' => 'badoblog_cus_post_bio_related_amount',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Next
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - section (next entry)
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_next', array(
        'selector' => '.badoblog-css-np-box',
    ) );
    // -----------------  Section - section (next entry)
    $wp_customize->add_section( 'badoblog_cus_section_post_next', array(
        'title' => esc_html__( 'Section (next entry)', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // ----------------- Remove section (next entry)
    $wp_customize->add_setting( 'badoblog_cus_post_next', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_next', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Disable section (next entry)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_next',
        'settings' => 'badoblog_cus_post_next',
    ) );
    // ----------------- Background color
    $wp_customize->add_setting( 'badoblog_cus_post_next_back_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_next_back_color', array(
        'label'       => esc_html__( 'Background color', 'bado-blog' ),
        'description' => esc_html__( 'Default - color of large elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_next',
        'settings'    => 'badoblog_cus_post_next_back_color',
    )) );
    // ----------------- Text color
    $wp_customize->add_setting( 'badoblog_cus_post_next_text_color', array(
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_post_next_text_color', array(
        'label'       => esc_html__( 'Text color', 'bado-blog' ),
        'description' => esc_html__( 'Default - secondary color for large elements', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_next',
        'settings'    => 'badoblog_cus_post_next_text_color',
    )) );
    // ----------------- Remove label
    $wp_customize->add_setting( 'badoblog_cus_post_next_label', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_next_label', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove label', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_next',
        'settings' => 'badoblog_cus_post_next_label',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Related
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Related posts
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_related', array(
        'selector' => '.badoblog-css-related-section',
    ) );
    // -----------------  Section - Related posts
    $wp_customize->add_section( 'badoblog_cus_section_post_related', array(
        'title' => esc_html__( 'Related posts', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Activate related posts
    $wp_customize->add_setting( 'badoblog_cus_post_related', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_related', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate related posts', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_related',
        'settings' => 'badoblog_cus_post_related',
    ) );
    // -----------------  Title for section (Related posts)
    $wp_customize->add_setting( 'badoblog_cus_post_related_h', array(
        'default'           => esc_html__( 'Related posts', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_related_h', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Section title', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_related',
        'settings' => 'badoblog_cus_post_related_h',
    ) );
    // -----------------  Number of columns for related posts
    $wp_customize->add_setting( 'badoblog_cus_post_related_grid', array(
        'default'           => 'r4',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_related_grid', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Number of columns', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_related',
        'settings' => 'badoblog_cus_post_related_grid',
        'choices'  => array(
            'r3' => esc_html__( 'Three columns', 'bado-blog' ),
            'r4' => esc_html__( 'Four columns', 'bado-blog' ),
            'r5' => esc_html__( 'Five columns', 'bado-blog' ),
        ),
    ) );
    // -----------------  Number of related posts
    $wp_customize->add_setting( 'badoblog_cus_post_related_amount', array(
        'default'           => 8,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_1_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_related_amount', array(
        'type'     => 'number',
        'label'    => esc_html__( 'Number of related posts', 'bado-blog' ) . ' (max 50)',
        'section'  => 'badoblog_cus_section_post_related',
        'settings' => 'badoblog_cus_post_related_amount',
    ) );
    // -----------------  Taxonomy for related posts
    $wp_customize->add_setting( 'badoblog_cus_post_related_taxonomy', array(
        'default'           => 'cat',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_related_taxonomy', array(
        'type'        => 'radio',
        'label'       => esc_html__( 'Taxonomy for related posts', 'bado-blog' ),
        'description' => esc_html__( 'The criteria by which posts are selected', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_post_related',
        'settings'    => 'badoblog_cus_post_related_taxonomy',
        'choices'     => array(
            'cat' => esc_html__( 'Categories', 'bado-blog' ),
            'tag' => esc_html__( 'Tags', 'bado-blog' ),
        ),
    ) );
    // -----------------  Design for related posts
    $wp_customize->add_setting( 'badoblog_cus_post_related_design', array(
        'default'           => 'v0',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_related_design', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Design', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_related',
        'settings' => 'badoblog_cus_post_related_design',
        'choices'  => array(
            'v0' => esc_html__( 'Simple design', 'bado-blog' ),
            'v1' => esc_html__( 'Frames', 'bado-blog' ),
            'v2' => esc_html__( 'Contrast blocks', 'bado-blog' ),
            'v3' => esc_html__( 'Soaring blocks', 'bado-blog' ),
            'v4' => esc_html__( 'Polaroid', 'bado-blog' ),
        ),
    ) );
    // -----------------  Remove stub (No photo) in related posts
    $wp_customize->add_setting( 'badoblog_cus_post_related_nofoto', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_related_nofoto', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove stub (No photo) in related posts', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_related',
        'settings' => 'badoblog_cus_post_related_nofoto',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Posts & Pages - Comments
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Posts and pages - Comment section
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_post_comments_url', array(
        'selector' => '.comment-respond',
    ) );
    // -----------------  Section - Comment section
    $wp_customize->add_section( 'badoblog_cus_section_post_comments', array(
        'title' => esc_html__( 'Comment section', 'bado-blog' ),
        'panel' => 'badoblog_cus_panel_post',
    ) );
    // -----------------  Remove comment section (for posts)
    $wp_customize->add_setting( 'badoblog_cus_post_comments_posts', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_comments_posts', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove comment section (for posts)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_comments',
        'settings' => 'badoblog_cus_post_comments_posts',
    ) );
    // -----------------  Remove comment section (for pages)
    $wp_customize->add_setting( 'badoblog_cus_post_comments_pages', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_comments_pages', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove comment section (for pages)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_comments',
        'settings' => 'badoblog_cus_post_comments_pages',
    ) );
    // -----------------  Remove URL field in comments (for posts and pages)
    $wp_customize->add_setting( 'badoblog_cus_post_comments_url', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_post_comments_url', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Remove URL field in comments (for posts and pages)', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_post_comments',
        'settings' => 'badoblog_cus_post_comments_url',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Main page
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - Main page
    $wp_customize->add_section( 'badoblog_cus_section_home', array(
        'title'    => esc_html__( 'Main page', 'bado-blog' ),
        'priority' => 30,
    ) );
    // ----------------- Enable the section with the latest posts on the main page
    $wp_customize->add_setting( 'badoblog_cus_home_article_block', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_home_article_block', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Enable the section with the latest posts on the main page', 'bado-blog' ),
        'description' => esc_html__( '(Post blocks, as well as pagination, are configured in the "Categories" section)', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_home',
        'settings'    => 'badoblog_cus_home_article_block',
    ) );
    // ----------------- Title for the latest posts section
    $wp_customize->add_setting( 'badoblog_cus_home_article_block_h', array(
        'default'           => esc_html__( 'Latest posts', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_home_article_block_h', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Title for the latest posts section', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_home',
        'settings' => 'badoblog_cus_home_article_block_h',
    ) );
    // -----------------  Title - Home page builder
    class badoblog_cus_home_setting_panel_text_builder extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_home' ) ) {
                echo badoblog_fun_pr_customize_mes_home();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_home_setting_panel_text_builder', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_home_setting_panel_text_builder($wp_customize, 'badoblog_cus_home_setting_set_panel_text_builder', array(
        'section'  => 'badoblog_cus_section_home',
        'settings' => 'badoblog_cus_home_setting_panel_text_builder',
    )) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Sidebar
    	---------------------------------------------------------------------------------------------------------------------------*/
    // ----------------- Marker - Sidebar
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_sidebar_design', array(
        'selector' => '.badoblog-css-widget-area',
    ) );
    // ----------------- Section - Sidebar
    $wp_customize->add_section( 'badoblog_cus_section_sidebar', array(
        'title'    => esc_html__( 'Sidebar', 'bado-blog' ),
        'priority' => 40,
    ) );
    // ----------------- Selecting the design of widget sections
    $wp_customize->add_setting( 'badoblog_cus_sidebar_design', array(
        'default'           => 'v0',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_design', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Design of sections for widgets', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_design',
        'choices'  => array(
            'v0' => esc_html__( 'Switch off', 'bado-blog' ),
            'v1' => esc_html__( 'Frame', 'bado-blog' ),
            'v2' => esc_html__( 'Soaring', 'bado-blog' ),
            'v3' => esc_html__( 'Deepening', 'bado-blog' ),
            'v4' => esc_html__( 'Side shadow', 'bado-blog' ),
            'v5' => esc_html__( 'Gradient', 'bado-blog' ),
        ),
    ) );
    // -----------------  Dividing line - Sidebars
    class badoblog_cus_sidebar_panel_border_1 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_sidebar_panel_border_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_sidebar_panel_border_1($wp_customize, 'badoblog_cus_sidebar_set_panel_border_1', array(
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_panel_border_1',
    )) );
    // -----------------  Title 1 - Widgets
    class badoblog_cus_sidebar_panel_text_1 extends WP_Customize_Control {
        function render_content() {
            ?><div class="badoblog-c-panel-title"><?php 
            echo esc_html__( 'Widget headers', 'bado-blog' );
            ?></div><?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_sidebar_panel_text_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_sidebar_panel_text_1($wp_customize, 'badoblog_cus_sidebar_set_panel_text_1', array(
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_panel_text_1',
    )) );
    // ----------------- Widget header option
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_back', array(
        'default'           => 'gradient',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_back', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Widget header option', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_h_back',
        'choices'  => array(
            'simple'     => 'Simple',
            'background' => 'Background',
            'gradient'   => 'Gradient',
        ),
    ) );
    // ----------------- Widget titles background size
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_back_size', array(
        'default'           => '20',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_back_size', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Widget headers background size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_h_back_size',
        'choices'  => array(
            '10' => esc_html__( 'Small', 'bado-blog' ),
            '20' => esc_html__( 'Average', 'bado-blog' ),
            '30' => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // ----------------- Widget header font
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Widget title font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_h_font',
        'choices'  => $badoblog_font,
    ) );
    // ----------------- Widget title text size
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_size', array(
        'default'           => 18,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_size', array(
        'label'       => esc_html__( 'Widget title text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 18 px)',
        'section'     => 'badoblog_cus_section_sidebar',
        'type'        => 'number',
    ) );
    // ----------------- Widget names in uppercase
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_up', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_up', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Widget title in uppercase', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_h_up',
    ) );
    // ----------------- Center align widget titles
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_center', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Center align widget titles', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_h_center',
    ) );
    // ----------------- Underline widget titles
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_border', array(
        'default'           => 'v4',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_border', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Underline widget titles', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sidebar',
        'settings' => 'badoblog_cus_sidebar_h_border',
        'choices'  => array(
            'v0' => esc_html__( 'Switch off', 'bado-blog' ),
            'v1' => esc_html__( 'Left and down', 'bado-blog' ),
            'v2' => esc_html__( 'Center and bottom', 'bado-blog' ),
            'v3' => esc_html__( 'Full width', 'bado-blog' ),
            'v4' => esc_html__( 'Border left', 'bado-blog' ),
        ),
    ) );
    // -----------------  Line thickness
    $wp_customize->add_setting( 'badoblog_cus_sidebar_h_border_size', array(
        'default'           => 4,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_0_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sidebar_h_border_size', array(
        'label'       => esc_html__( 'Line thickness', 'bado-blog' ),
        'description' => '0 - 30 px (' . $mes_def_1 . ' 4 px)',
        'section'     => 'badoblog_cus_section_sidebar',
        'type'        => 'number',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Bottom part
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Bottom part
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_footer', array(
        'selector' => '.badoblog-css-site-footer',
    ) );
    // -----------------  Section - Bottom part
    $wp_customize->add_section( 'badoblog_cus_section_footer', array(
        'title'    => esc_html__( 'Bottom part', 'bado-blog' ),
        'priority' => 50,
    ) );
    // -----------------  Activate footer
    $wp_customize->add_setting( 'badoblog_cus_footer', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Activate footer', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer',
    ) );
    // ----------------- Full-width footer background
    $wp_customize->add_setting( 'badoblog_cus_footer_full', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_full', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Full-width background', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_full',
    ) );
    // -----------------  Title - Add colors for Footer
    class badoblog_cus_footer_setting_panel_text_add_colors extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_color_footer' ) ) {
                echo badoblog_fun_pr_customize_mes_color_footer();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_footer_setting_panel_text_add_colors', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_footer_setting_panel_text_add_colors($wp_customize, 'badoblog_cus_footer_setting_set_panel_text_add_colors', array(
        'priority' => 10,
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_setting_panel_text_add_colors',
    )) );
    // -----------------  Dividing line - Widgets
    class badoblog_cus_footer_panel_border_1 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_footer_panel_border_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_footer_panel_border_1($wp_customize, 'badoblog_cus_footer_set_panel_border_1', array(
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_panel_border_1',
    )) );
    // -----------------  Title 1 - Widgets
    class badoblog_cus_footer_panel_text_1 extends WP_Customize_Control {
        function render_content() {
            ?><div class="badoblog-c-panel-title"><?php 
            echo esc_html__( 'Widgets', 'bado-blog' );
            ?></div><?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_footer_panel_text_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_footer_panel_text_1($wp_customize, 'badoblog_cus_footer_set_panel_text_1', array(
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_panel_text_1',
    )) );
    // ----------------- Widget header font (footer)
    $wp_customize->add_setting( 'badoblog_cus_footer_widget_h_font', array(
        'default'           => 'off',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_widget_h_font', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Widget title font', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_widget_h_font',
        'choices'  => $badoblog_font,
    ) );
    // ----------------- Widget title text size (footer)
    $wp_customize->add_setting( 'badoblog_cus_footer_widget_h_size', array(
        'default'           => 18,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_widget_h_size', array(
        'label'       => esc_html__( 'Widget title text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 18 px)',
        'section'     => 'badoblog_cus_section_footer',
        'type'        => 'number',
    ) );
    // ----------------- Widget names in uppercase (footer)
    $wp_customize->add_setting( 'badoblog_cus_footer_widget_h_up', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_widget_h_up', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Widget title in uppercase', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_widget_h_up',
    ) );
    // ----------------- Center align widget titles (footer)
    $wp_customize->add_setting( 'badoblog_cus_footer_widget_h_center', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_widget_h_center', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Center align widget titles', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_widget_h_center',
    ) );
    // ----------------- Underline widget titles (footer)
    $wp_customize->add_setting( 'badoblog_cus_footer_widget_h_border', array(
        'default'           => 'v4',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_widget_h_border', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Underline widget titles', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_widget_h_border',
        'choices'  => array(
            'v0' => esc_html__( 'Switch off', 'bado-blog' ),
            'v1' => esc_html__( 'Left and down', 'bado-blog' ),
            'v2' => esc_html__( 'Center and bottom', 'bado-blog' ),
            'v3' => esc_html__( 'Full width', 'bado-blog' ),
            'v4' => esc_html__( 'Border left', 'bado-blog' ),
        ),
    ) );
    // -----------------  Line thickness
    $wp_customize->add_setting( 'badoblog_cus_footer_widget_h_border_size', array(
        'default'           => 4,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_0_30',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_widget_h_border_size', array(
        'label'       => esc_html__( 'Line thickness', 'bado-blog' ),
        'description' => '0 - 30 px (' . $mes_def_1 . ' 4 px)',
        'section'     => 'badoblog_cus_section_footer',
        'type'        => 'number',
    ) );
    // -----------------  Dividing line - Widgets
    class badoblog_cus_footer_panel_border_2 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_footer_panel_border_2', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_footer_panel_border_2($wp_customize, 'badoblog_cus_footer_set_panel_border_2', array(
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_panel_border_2',
    )) );
    // -----------------  Activate bottom menu
    $wp_customize->add_setting( 'badoblog_cus_footer_menu', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_menu', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Activate bottom menu', 'bado-blog' ),
        'description' => sprintf( esc_html__( 'Items of this menu are customized in the - "Panel %s" - "Appearance" - "Menus" section.', 'bado-blog' ), 'WordPress' ),
        'section'     => 'badoblog_cus_section_footer',
        'settings'    => 'badoblog_cus_footer_menu',
    ) );
    // -----------------  Bottom menu text size
    $wp_customize->add_setting( 'badoblog_cus_footer_menu_size', array(
        'default'           => 14,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_menu_size', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Bottom menu text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 14 px)',
        'section'     => 'badoblog_cus_section_footer',
        'settings'    => 'badoblog_cus_footer_menu_size',
    ) );
    // -----------------  Dividing line - Text bottom
    class badoblog_cus_footer_panel_border_3 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_footer_panel_border_3', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_footer_panel_border_3($wp_customize, 'badoblog_cus_footer_set_panel_border_3', array(
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_panel_border_3',
    )) );
    // -----------------  Add dividing line
    $wp_customize->add_setting( 'badoblog_cus_footer_separation', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_separation', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Add dividing line', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_separation',
    ) );
    // -----------------  Text at the bottom of the footer
    $wp_customize->add_setting( 'badoblog_cus_footer_brand', array(
        'default'           => 'Created with the <a href="//wordpress.org/themes/bado-blog/" target="_blank" rel="nofollow">WordPress theme Bado Blog</a>',
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_footer_brand', array(
        'type'     => 'textarea',
        'label'    => esc_html__( 'Text at the bottom of the footer', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_footer',
        'settings' => 'badoblog_cus_footer_brand',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others
    	---------------------------------------------------------------------------------------------------------------------------*/
    $wp_customize->add_panel( 'badoblog_cus_panel_mod', array(
        'capabitity' => 'edit_theme_options',
        'priority'   => 60,
        'title'      => esc_html__( 'Different settings', 'bado-blog' ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others - Back image
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Changing the header color setting section
    $wp_customize->get_section( 'background_image' )->panel = 'badoblog_cus_panel_mod';
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others - Breadcrumbs
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Different settings - Breadcrumbs
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_bread_activ_post', array(
        'selector' => '.badoblog-css-breadcrumbs',
    ) );
    // -----------------  Section - Breadcrumbs
    $wp_customize->add_section( 'badoblog_cus_section_bread', array(
        'title'    => esc_html__( 'Breadcrumbs', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_mod',
        'priority' => 90,
    ) );
    // -----------------  Enable breadcrumbs in posts
    $wp_customize->add_setting( 'badoblog_cus_bread_activ_post', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_activ_post', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Enable breadcrumbs in posts', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_activ_post',
    ) );
    // -----------------  Enable breadcrumbs in categories
    $wp_customize->add_setting( 'badoblog_cus_bread_activ_cat', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_activ_cat', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Enable breadcrumbs in categories', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_activ_cat',
    ) );
    // -----------------  Show link to home page
    $wp_customize->add_setting( 'badoblog_cus_bread_main', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_main', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Show link to home page', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_main',
    ) );
    // -----------------  Specify your text for the link (Default - Home)
    $wp_customize->add_setting( 'badoblog_cus_bread_main_text', array(
        'default'           => esc_html__( 'Home', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_main_text', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Specify the text for the first link', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_main_text',
    ) );
    // -----------------  Show title in breadcrumb for posts
    $wp_customize->add_setting( 'badoblog_cus_bread_h_post', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_h_post', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Show title in breadcrumb for posts', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_h_post',
    ) );
    // -----------------  Show title for categories, archives and tags
    $wp_customize->add_setting( 'badoblog_cus_bread_h_cat', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_h_cat', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Show title for categories, archives and tags', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_h_cat',
    ) );
    // ----------------- Breadcrumbs design
    $wp_customize->add_setting( 'badoblog_cus_bread_design', array(
        'default'           => 'gradient',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_design', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Breadcrumbs design option', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_design',
        'choices'  => array(
            'simple'     => 'Simple',
            'background' => 'Background',
            'gradient'   => 'Gradient',
            'border'     => 'Border',
        ),
    ) );
    // -----------------  Title - Add colors for Breadcrumbs
    class badoblog_cus_bread_setting_panel_text_add_colors extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            if ( function_exists( 'badoblog_fun_pr_customize_mes_color_breadcrumbs' ) ) {
                echo badoblog_fun_pr_customize_mes_color_breadcrumbs();
            }
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_bread_setting_panel_text_add_colors', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_bread_setting_panel_text_add_colors($wp_customize, 'badoblog_cus_bread_setting_set_panel_text_add_colors', array(
        'priority' => 200,
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_setting_panel_text_add_colors',
    )) );
    // -----------------  Breadcrumbs text size
    $wp_customize->add_setting( 'badoblog_cus_bread_size_text', array(
        'default'           => 18,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_5_50',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_size_text', array(
        'type'        => 'number',
        'label'       => esc_html__( 'Text size', 'bado-blog' ),
        'description' => '5 - 50 px (' . $mes_def_1 . ' 18 px)',
        'section'     => 'badoblog_cus_section_bread',
        'settings'    => 'badoblog_cus_bread_size_text',
    ) );
    // -----------------  Separator between breadcrumbs
    $wp_customize->add_setting( 'badoblog_cus_bread_separator', array(
        'default'           => 'v3',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_bread_separator', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Separator', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_bread',
        'settings' => 'badoblog_cus_bread_separator',
        'choices'  => array(
            'v1' => esc_html__( 'Triangle', 'bado-blog' ),
            'v2' => esc_html__( 'Arrowhead', 'bado-blog' ),
            'v3' => esc_html__( 'Brace', 'bado-blog' ),
            'v4' => esc_html__( 'Volumetric arrow', 'bado-blog' ),
            'v5' => esc_html__( 'Linear arrow', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others - Calm blocks
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - Calm blocks
    $wp_customize->add_section( 'badoblog_cus_section_flow_block', array(
        'title'    => esc_html__( 'Calm blocks', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_mod',
        'priority' => 250,
    ) );
    // -----------------  Activate fluently movement of blocks
    $wp_customize->add_setting( 'badoblog_cus_flow_block', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_flow_block', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Activate fluently movement for blocks', 'bado-blog' ),
        'description' => esc_html__( 'Applies for sections on the main page and category pages', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_flow_block',
        'settings'    => 'badoblog_cus_flow_block',
    ) );
    // -----------------  Warning
    class badoblog_cus_flow_panel_text extends WP_Customize_Control {
        function render_content() {
            echo '<div>';
            esc_html_e( 'Warning! After enabling this module, check that the post cards are displayed correctly.', 'bado-blog' );
            echo '<p></p>';
            esc_html_e( 'This module often conflicts with various plugins that are responsible for "Delayed post loading", "Infinite post loading" and "Caching".', 'bado-blog' );
            echo '</div>';
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_flow_panel_text', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_flow_panel_text($wp_customize, 'badoblog_cus_flow_set_panel_text', array(
        'section'  => 'badoblog_cus_section_flow_block',
        'settings' => 'badoblog_cus_flow_panel_text',
    )) );
    // ----------------- Range fluently movement
    $wp_customize->add_setting( 'badoblog_cus_flow_block_range', array(
        'default'           => 'mid',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_flow_block_range', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Range for fluently movement', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_flow_block',
        'settings' => 'badoblog_cus_flow_block_range',
        'choices'  => array(
            'small' => esc_html__( 'Small', 'bado-blog' ),
            'mid'   => esc_html__( 'Average', 'bado-blog' ),
            'big'   => esc_html__( 'Big', 'bado-blog' ),
        ),
    ) );
    // ----------------- Direction movement
    $wp_customize->add_setting( 'badoblog_cus_flow_block_way', array(
        'default'           => 'bottom',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_flow_block_way', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Direction movement', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_flow_block',
        'settings' => 'badoblog_cus_flow_block_way',
        'choices'  => array(
            'top'    => esc_html__( 'Top', 'bado-blog' ),
            'bottom' => esc_html__( 'Bottom', 'bado-blog' ),
            'left'   => esc_html__( 'Left', 'bado-blog' ),
            'right'  => esc_html__( 'Right', 'bado-blog' ),
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others - Site map
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - Site map
    $wp_customize->add_section( 'badoblog_cus_section_sitemap', array(
        'title'    => esc_html__( 'Site map', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_mod',
        'priority' => 250,
    ) );
    // -----------------  Instruction - Site map
    class badoblog_cus_sitemap_panel_text extends WP_Customize_Control {
        function render_content() {
            ?><div><?php 
            esc_html_e( 'To display the sitemap, create a new page through the standard WordPress menu,
			go to page edit mode and select the "Site Map" template on the right side, save the page.', 'bado-blog' );
            ?></div><?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_sitemap_panel_text', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_sitemap_panel_text($wp_customize, 'badoblog_cus_sitemap_set_panel_text', array(
        'section'  => 'badoblog_cus_section_sitemap',
        'settings' => 'badoblog_cus_sitemap_panel_text',
    )) );
    // -----------------  Display categories on the sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_cat', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_cat', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Display categories on the sitemap', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sitemap',
        'settings' => 'badoblog_cus_sitemap_cat',
    ) );
    // -----------------  Category section header on the sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_cat_h', array(
        'default'           => esc_html__( 'Category', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_cat_h', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Section title', 'bado-blog' ) . ' (' . esc_html__( 'Category', 'bado-blog' ) . ')',
        'section'  => 'badoblog_cus_section_sitemap',
        'settings' => 'badoblog_cus_sitemap_cat_h',
    ) );
    // -----------------  The maximum number of categories on the sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_cat_num', array(
        'default'           => 50,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_cat_num', array(
        'label'   => esc_html__( 'Maximum number of categories', 'bado-blog' ),
        'section' => 'badoblog_cus_section_sitemap',
        'type'    => 'number',
    ) );
    // -----------------  Show posts on sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_post', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_post', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Show posts on sitemap', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sitemap',
        'settings' => 'badoblog_cus_sitemap_post',
    ) );
    // -----------------  Posts section header on the sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_post_h', array(
        'default'           => esc_html__( 'Posts', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_post_h', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Section title', 'bado-blog' ) . ' (' . esc_html__( 'Posts', 'bado-blog' ) . ')',
        'section'  => 'badoblog_cus_section_sitemap',
        'settings' => 'badoblog_cus_sitemap_post_h',
    ) );
    // -----------------  The maximum number of posts on the sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_post_num', array(
        'default'           => 50,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_post_num', array(
        'label'   => esc_html__( 'Maximum number of posts', 'bado-blog' ),
        'section' => 'badoblog_cus_section_sitemap',
        'type'    => 'number',
    ) );
    // -----------------  Show pages on sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_page', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_page', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Show pages on sitemap', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_sitemap',
        'settings' => 'badoblog_cus_sitemap_page',
    ) );
    // -----------------  Pages section header on the sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_page_h', array(
        'default'           => esc_html__( 'Pages', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_page_h', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Section title', 'bado-blog' ) . ' (' . esc_html__( 'Pages', 'bado-blog' ) . ')',
        'section'  => 'badoblog_cus_section_sitemap',
        'settings' => 'badoblog_cus_sitemap_page_h',
    ) );
    // -----------------  The maximum number of pages on the sitemap
    $wp_customize->add_setting( 'badoblog_cus_sitemap_page_num', array(
        'default'           => 50,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_sitemap_page_num', array(
        'label'   => esc_html__( 'Maximum number of pages', 'bado-blog' ),
        'section' => 'badoblog_cus_section_sitemap',
        'type'    => 'number',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others - Up button
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Marker - Others - Up button
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_top_scroll', array(
        'selector' => '.badoblog-css-scrollup',
    ) );
    // -----------------  Section - Up button
    $wp_customize->add_section( 'badoblog_cus_section_top_scroll', array(
        'title'    => esc_html__( 'Up button', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_mod',
        'priority' => 250,
    ) );
    // -----------------  Remove Up button
    $wp_customize->add_setting( 'badoblog_cus_top_scroll', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_scroll', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Disable button', 'bado-blog' ) . ' (' . esc_html__( 'Up', 'bado-blog' ) . ')',
        'section'  => 'badoblog_cus_section_top_scroll',
        'settings' => 'badoblog_cus_top_scroll',
    ) );
    // -----------------  Button location
    $wp_customize->add_setting( 'badoblog_cus_top_scroll_layout', array(
        'default'           => 'right',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_scroll_layout', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Button location', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_scroll',
        'settings' => 'badoblog_cus_top_scroll_layout',
        'choices'  => array(
            'right' => esc_html__( 'Right', 'bado-blog' ),
            'left'  => esc_html__( 'Left', 'bado-blog' ),
        ),
    ) );
    // -----------------  Button size
    $wp_customize->add_setting( 'badoblog_cus_top_scroll_size', array(
        'default'           => 'big',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_scroll_size', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Button size', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_scroll',
        'settings' => 'badoblog_cus_top_scroll_size',
        'choices'  => array(
            'big'   => esc_html__( 'Big', 'bado-blog' ),
            'small' => esc_html__( 'Small', 'bado-blog' ),
        ),
    ) );
    // -----------------  Button shape
    $wp_customize->add_setting( 'badoblog_cus_top_scroll_form', array(
        'default'           => 'circle',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_scroll_form', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Button shape', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_scroll',
        'settings' => 'badoblog_cus_top_scroll_form',
        'choices'  => array(
            'circle' => esc_html__( 'Circle', 'bado-blog' ),
            'square' => esc_html__( 'Square', 'bado-blog' ),
        ),
    ) );
    // -----------------  Button variation
    $wp_customize->add_setting( 'badoblog_cus_top_scroll_design', array(
        'default'           => 'brace',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_scroll_design', array(
        'type'     => 'radio',
        'label'    => esc_html__( 'Button variation', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_top_scroll',
        'settings' => 'badoblog_cus_top_scroll_design',
        'choices'  => array(
            'arrow'    => esc_html__( 'Arrow', 'bado-blog' ),
            'brace'    => esc_html__( 'Brace', 'bado-blog' ),
            'triangle' => esc_html__( 'Triangle', 'bado-blog' ),
        ),
    ) );
    // ----------------- Button opacity
    $wp_customize->add_setting( 'badoblog_cus_top_scroll_opacity', array(
        'default'           => 4,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_num_sanitize_10',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_scroll_opacity', array(
        'type'        => 'range',
        'section'     => 'badoblog_cus_section_top_scroll',
        'label'       => esc_html__( 'Button opacity', 'bado-blog' ),
        'input_attrs' => array(
            'min'  => 2,
            'max'  => 10,
            'step' => 2,
        ),
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others - SEO
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - SEO settings
    $wp_customize->add_section( 'badoblog_cus_section_seo', array(
        'title'    => esc_html__( 'SEO settings', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_mod',
        'priority' => 250,
    ) );
    // -----------------  Set ALT value for stub No photo
    $wp_customize->add_setting( 'badoblog_cus_seo_alt_nofoto', array(
        'default'           => esc_html__( 'No photo', 'bado-blog' ),
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_text_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_seo_alt_nofoto', array(
        'type'     => 'text',
        'label'    => esc_html__( 'Set ALT value for stub No photo', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_seo',
        'settings' => 'badoblog_cus_seo_alt_nofoto',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Others - Speed
    	---------------------------------------------------------------------------------------------------------------------------*/
    // -----------------  Section - Speed Settings
    $wp_customize->add_section( 'badoblog_cus_section_speed', array(
        'title'    => esc_html__( 'Speed Settings', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_mod',
        'priority' => 250,
    ) );
    // -----------------  Title 1 - Speed Settings
    class badoblog_cus_speed_panel_text_1 extends WP_Customize_Control {
        function render_content() {
            ?>
			<div class="badoblog-css-panel-help-box">
				<div>
				<?php 
            echo esc_html__( 'This section has been created for your convenience. All settings are safe and cannot disrupt the site. To further increase the speed of the site, go to the help page.', 'bado-blog' );
            ?>
				</div>
				<?php 
            if ( function_exists( 'badoblog_fun_pr_customize_help_speed' ) ) {
                echo badoblog_fun_pr_customize_help_speed();
            }
            ?>
			</div>
			<?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_speed_panel_text_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_speed_panel_text_1($wp_customize, 'badoblog_cus_speed_set_panel_text_1', array(
        'section'  => 'badoblog_cus_section_speed',
        'settings' => 'badoblog_cus_speed_panel_text_1',
    )) );
    // ----------------- Relieve the Top menu (replace with lightweight)
    $wp_customize->add_setting( 'badoblog_cus_top_menu_version', array(
        'default'           => 'js',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_top_menu_version', array(
        'type'        => 'radio',
        'label'       => esc_html__( 'Relieve the Top menu (replace with lightweight)', 'bado-blog' ),
        'description' => esc_html__( '
			This will disable the heavy menu and enable the pure CSS menu.
			Pros: Disables JS scripts, which can be important for speed since the menu is at the top of the site.
			Cons: Support for keyboard control will be disabled. The arrows (icons) of the menu control are disabled.', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_speed',
        'settings'    => 'badoblog_cus_top_menu_version',
        'choices'     => array(
            'js'    => esc_html__( 'JS Menu', 'bado-blog' ),
            'light' => esc_html__( 'Lightweight menu', 'bado-blog' ),
        ),
    ) );
    // ----------------- Disable improved dropdowns (select list)
    $wp_customize->add_setting( 'badoblog_cus_speed_chosen_none', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_speed_chosen_none', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Disable improved dropdowns (select list)', 'bado-blog' ),
        'description' => esc_html__( '
			This will disable the script that improves the appearance and usability of drop-down lists.
			For example, in the widget (Categories) it adds a live search filter if the list is long.
			This will not affect the menu.
			Disable it if site loading speed is important to you and you do not use drop-down lists.', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_speed',
        'settings'    => 'badoblog_cus_speed_chosen_none',
    ) );
    // ----------------- Disable enhanced usability in comments
    $wp_customize->add_setting( 'badoblog_cus_speed_comment_reply_none', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_speed_comment_reply_none', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Disable enhanced usability in comments', 'bado-blog' ),
        'description' => esc_html__( '
			This will disable the script that moves the form for adding a comment under the comment, in which we clicked on the link (answer).
			This happens without reloading the page and improves interaction with the comment form.
			Disable it if this is not important to you.', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_speed',
        'settings'    => 'badoblog_cus_speed_comment_reply_none',
    ) );
    // ----------------- Disable enhanced block styles (Gutenberg)
    $wp_customize->add_setting( 'badoblog_cus_speed_block_style_none', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_speed_block_style_none', array(
        'type'        => 'checkbox',
        'label'       => esc_html__( 'Disable enhanced block styles (Gutenberg)', 'bado-blog' ),
        'description' => esc_html__( 'The size of these styles is quite large, but the benefit is negligible. 
			Disable if you do not see any difference in the design of block widgets or in the page editor using blocks (Gutenberg)', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_speed',
        'settings'    => 'badoblog_cus_speed_block_style_none',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Widgets adaptation
    	---------------------------------------------------------------------------------------------------------------------------*/
    // ----------------- Marker - Widgets adaptation
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_widget_sidebar_design', array(
        'selector' => '.badoblog-css-widget-area',
    ) );
    // ----------------- Section - Widgets adaptation
    $wp_customize->add_section( 'badoblog_cus_section_widget', array(
        'title'    => esc_html__( 'Widgets adaptation', 'bado-blog' ),
        'panel'    => 'badoblog_cus_panel_mod',
        'priority' => 260,
    ) );
    // ----------------- Apply styles to Block Widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_h_block', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_widget_h_block', array(
        'type'        => 'checkbox',
        'label'       => sprintf( esc_html__( 'Apply styles to %s', 'bado-blog' ), $bw ),
        'description' => sprintf( esc_html__( '%1$s have their own flexible settings. Disabling this setting can be useful if you want to control the design of %1$s yourself', 'bado-blog' ), $bw ),
        'section'     => 'badoblog_cus_section_widget',
        'settings'    => 'badoblog_cus_widget_h_block',
    ) );
    // -----------------  Dividing line - Block Widgets
    class badoblog_cus_widget_panel_border_1 extends WP_Customize_Control {
        function render_content() {
            badoblog_fun_panel_line();
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_widget_panel_border_1', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_widget_panel_border_1($wp_customize, 'badoblog_cus_widget_set_panel_border_1', array(
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_panel_border_1',
    )) );
    // -----------------  Title 2 - Widgets
    class badoblog_cus_widget_sidebar_panel_text_2 extends WP_Customize_Control {
        function render_content() {
            ?><div class="badoblog-c-panel-title"><?php 
            echo esc_html__( 'Settings basic widgets (post, page, category, menu)', 'bado-blog' );
            ?></div><?php 
        }

    }

    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_panel_text_2', array(
        'sanitize_callback' => 'badoblog_fun_html_sanitize',
    ) );
    $wp_customize->add_control( new badoblog_cus_widget_sidebar_panel_text_2($wp_customize, 'badoblog_cus_widget_sidebar_set_panel_text_2', array(
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_sidebar_panel_text_2',
    )) );
    // -----------------  Marker - basic widgets - Posts
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_widget_sidebar_design_post', array(
        'selector' => '.widget.widget_recent_entries',
    ) );
    // ----------------- Design for lists of posts and pages in basic widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_design_post', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_widget_sidebar_design_post', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Design for lists of posts and pages in basic widgets', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_sidebar_design_post',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v1' => esc_html__( 'File', 'bado-blog' ),
            'v2' => esc_html__( 'Round dots', 'bado-blog' ),
            'v3' => esc_html__( 'Square dots', 'bado-blog' ),
            'v4' => esc_html__( 'Thin border', 'bado-blog' ),
        ),
    ) );
    // -----------------  Marker - basic widgets - category
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_widget_sidebar_design_cat', array(
        'selector' => '.widget.widget_categories',
    ) );
    // ----------------- Design for category lists in basic widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_design_cat', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_widget_sidebar_design_cat', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Design for category lists in basic widgets', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_sidebar_design_cat',
        'choices'  => array(
            0  => esc_html__( 'Turn off styles', 'bado-blog' ),
            1  => esc_html__( 'Folder', 'bado-blog' ) . ' 1' . $mes_def_2,
            2  => esc_html__( 'Folder', 'bado-blog' ) . ' 2',
            3  => esc_html__( 'Folder', 'bado-blog' ) . ' 3',
            4  => esc_html__( 'Folder', 'bado-blog' ) . ' 4',
            5  => esc_html__( 'Folder', 'bado-blog' ) . ' 5',
            6  => esc_html__( 'Folder', 'bado-blog' ) . ' 6',
            7  => esc_html__( 'Folder', 'bado-blog' ) . ' 7',
            8  => esc_html__( 'Card catalog', 'bado-blog' ),
            9  => esc_html__( 'Box', 'bado-blog' ),
            10 => esc_html__( 'Thick border', 'bado-blog' ),
        ),
    ) );
    // -----------------  Marker - basic widgets - archives
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_widget_sidebar_design_archive', array(
        'selector' => '.widget.widget_archive',
    ) );
    // ----------------- Design for archives in basic widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_design_archive', array(
        'default'           => 1,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_widget_sidebar_design_archive', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Design for archives in basic widgets', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_sidebar_design_archive',
        'choices'  => array(
            0 => esc_html__( 'Turn off styles', 'bado-blog' ),
            1 => esc_html__( 'Archive', 'bado-blog' ) . $mes_def_2,
            2 => esc_html__( 'Card catalog', 'bado-blog' ),
            3 => esc_html__( 'Box', 'bado-blog' ),
            4 => esc_html__( 'Folder', 'bado-blog' ),
            5 => esc_html__( 'Thick border', 'bado-blog' ),
        ),
    ) );
    // -----------------  Marker - basic widgets - Menu
    $wp_customize->selective_refresh->add_partial( 'badoblog_cus_widget_sidebar_design_menu', array(
        'selector' => '.widget.widget_nav_menu',
    ) );
    // -----------------  Design for menu lists in basic widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_design_menu', array(
        'default'           => 'v1',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_radio_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_widget_sidebar_design_menu', array(
        'type'     => 'select',
        'label'    => esc_html__( 'Design for menu lists in basic widgets', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_sidebar_design_menu',
        'choices'  => array(
            'v0' => esc_html__( 'Turn off styles', 'bado-blog' ),
            'v1' => esc_html__( 'Arrow', 'bado-blog' ),
            'v2' => esc_html__( 'Square', 'bado-blog' ),
            'v3' => esc_html__( 'Icon (sign)', 'bado-blog' ),
        ),
    ) );
    // -----------------  Text color of menu items of basic widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_menu_text_color', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_widget_sidebar_menu_text_color', array(
        'label'       => esc_html__( 'Text color of menu items of basic widgets', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_widget',
        'description' => esc_html__( 'default - sets the overall color of the links', 'bado-blog' ),
        'settings'    => 'badoblog_cus_widget_sidebar_menu_text_color',
    )) );
    // -----------------  Text color of menu items of basic widgets (on hover)
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_menu_text_color_hover', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_widget_sidebar_menu_text_color_hover', array(
        'label'       => esc_html__( 'Text color of menu items of basic widgets', 'bado-blog' ) . $mes_hover,
        'section'     => 'badoblog_cus_section_widget',
        'description' => esc_html__( 'default - sets the overall color of the links', 'bado-blog' ),
        'settings'    => 'badoblog_cus_widget_sidebar_menu_text_color_hover',
    )) );
    // -----------------  Background color of menu items of basic widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_menu_back_color', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_widget_sidebar_menu_back_color', array(
        'label'       => esc_html__( 'Background color of menu items of basic widgets', 'bado-blog' ),
        'section'     => 'badoblog_cus_section_widget',
        'description' => esc_html__( 'Default - background not set', 'bado-blog' ),
        'settings'    => 'badoblog_cus_widget_sidebar_menu_back_color',
    )) );
    // -----------------  Background color of menu items of basic widgets (on hover)
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_menu_back_color_hover', array(
        'default'              => '',
        'capability'           => 'edit_theme_options',
        'sanitize_callback'    => 'badoblog_fun_color_hex_sanitize',
        'sanitize_js_callback' => 'badoblog_fun_color_sanitize',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'badoblog_cus_widget_sidebar_menu_back_color_hover', array(
        'label'    => esc_html__( 'Background color of menu items of basic widgets', 'bado-blog' ) . $mes_hover,
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_sidebar_menu_back_color_hover',
    )) );
    // -----------------  Disable demo widgets
    $wp_customize->add_setting( 'badoblog_cus_widget_sidebar_demo', array(
        'default'           => 0,
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
    ) );
    $wp_customize->add_control( 'badoblog_cus_widget_sidebar_demo', array(
        'type'     => 'checkbox',
        'label'    => esc_html__( 'Disable demo widgets', 'bado-blog' ),
        'section'  => 'badoblog_cus_section_widget',
        'settings' => 'badoblog_cus_widget_sidebar_demo',
    ) );
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Events Calendar
    	---------------------------------------------------------------------------------------------------------------------------*/
    if ( class_exists( 'Tribe__Events__Main' ) || class_exists( 'Tribe__Events__Pro__Main' ) ) {
        // -----------------  Section - Advanced settings (for The Events Calendar)
        $wp_customize->add_section( 'badoblog_cus_section_events_calendar', array(
            'title'    => $mes_adv,
            'panel'    => 'tribe_customizer',
            'priority' => 199,
        ) );
        // -----------------  Enable styling support for The Events Calendar
        $wp_customize->add_setting( 'badoblog_cus_events_calendar_css', array(
            'default'           => 1,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
        ) );
        $help_event = '';
        if ( function_exists( 'badoblog_fun_pr_customize_help_event_calendar' ) ) {
            $help_event = badoblog_fun_pr_customize_help_event_calendar();
        }
        $wp_customize->add_control( 'badoblog_cus_events_calendar_css', array(
            'type'        => 'checkbox',
            'label'       => sprintf( esc_html__( 'Enable styling support for %s', 'bado-blog' ), 'The Events Calendar' ),
            'description' => '<div class="badoblog-css-panel-help-box"><div>' . esc_html__( 'Customizes the Skeleton Styles stylesheet according to the template design. Turning it off can be useful if you want to control the stylesheet yourself (Skeleton Styles)', 'bado-blog' ) . '</div>' . $help_event . '</div>',
            'section'     => 'badoblog_cus_section_events_calendar',
            'settings'    => 'badoblog_cus_events_calendar_css',
        ) );
    }
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Newsletter
    	---------------------------------------------------------------------------------------------------------------------------*/
    if ( class_exists( 'Newsletter' ) ) {
        // -----------------  Section - Advanced settings (Newsletter)
        $wp_customize->add_section( 'badoblog_cus_section_newsletter', array(
            'title'    => 'Newsletter',
            'priority' => 199,
        ) );
        // -----------------  Enable styling support for Newsletter
        $wp_customize->add_setting( 'badoblog_cus_newsletter_css', array(
            'default'           => 1,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
        ) );
        $wp_customize->add_control( 'badoblog_cus_newsletter_css', array(
            'type'     => 'checkbox',
            'label'    => sprintf( esc_html__( 'Enable styling support for %s', 'bado-blog' ), 'Newsletter' ),
            'section'  => 'badoblog_cus_section_newsletter',
            'settings' => 'badoblog_cus_newsletter_css',
        ) );
    }
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region bbPress
    	---------------------------------------------------------------------------------------------------------------------------*/
    if ( function_exists( 'bbpress' ) ) {
        // -----------------  Section - bbPress
        $wp_customize->add_section( 'badoblog_cus_section_bbpress', array(
            'title'    => 'bbPress',
            'priority' => 199,
        ) );
        // -----------------  Disable sidebar on bbPress pages
        $wp_customize->add_setting( 'badoblog_cus_bbpress_sidebar', array(
            'default'           => 0,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
        ) );
        $wp_customize->add_control( 'badoblog_cus_bbpress_sidebar', array(
            'type'     => 'checkbox',
            'label'    => esc_html__( 'Disable sidebar on bbPress pages', 'bado-blog' ),
            'section'  => 'badoblog_cus_section_bbpress',
            'settings' => 'badoblog_cus_bbpress_sidebar',
        ) );
        // -----------------  Disable style support for bbPress
        $wp_customize->add_setting( 'badoblog_cus_bbpress_css_off', array(
            'default'           => 0,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
        ) );
        $wp_customize->add_control( 'badoblog_cus_bbpress_css_off', array(
            'type'        => 'checkbox',
            'label'       => esc_html__( 'Disable style support for bbPress', 'bado-blog' ),
            'description' => esc_html__( 'Can be useful if you want to control the styles of the bbPress plugin yourself', 'bado-blog' ),
            'section'     => 'badoblog_cus_section_bbpress',
            'settings'    => 'badoblog_cus_bbpress_css_off',
        ) );
    }
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region BuddyPress
    	---------------------------------------------------------------------------------------------------------------------------*/
    if ( class_exists( 'BuddyPress' ) ) {
        // -----------------  Section - BuddyPress
        $wp_customize->add_section( 'badoblog_cus_section_buddypress', array(
            'title'    => 'BuddyPress (' . BADOBLOG_NAME . ')',
            'priority' => 199,
        ) );
        // -----------------  Disable sidebar on BuddyPress pages
        $wp_customize->add_setting( 'badoblog_cus_buddypress_sidebar', array(
            'default'           => 0,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
        ) );
        $wp_customize->add_control( 'badoblog_cus_buddypress_sidebar', array(
            'type'     => 'checkbox',
            'label'    => esc_html__( 'Disable sidebar on BuddyPress pages', 'bado-blog' ),
            'section'  => 'badoblog_cus_section_buddypress',
            'settings' => 'badoblog_cus_buddypress_sidebar',
        ) );
        // -----------------  Disable style support for BuddyPress
        $wp_customize->add_setting( 'badoblog_cus_buddypress_css_off', array(
            'default'           => 0,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
        ) );
        $wp_customize->add_control( 'badoblog_cus_buddypress_css_off', array(
            'type'        => 'checkbox',
            'label'       => esc_html__( 'Disable style support for BuddyPress', 'bado-blog' ),
            'description' => esc_html__( 'Can be useful if you want to control the styles of the BuddyPress plugin yourself', 'bado-blog' ),
            'section'     => 'badoblog_cus_section_buddypress',
            'settings'    => 'badoblog_cus_buddypress_css_off',
        ) );
    }
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region WooCommerce
    	---------------------------------------------------------------------------------------------------------------------------*/
    if ( function_exists( 'is_woocommerce' ) ) {
        // -----------------  Section - WooCommerce - Advanced settings
        $wp_customize->add_section( 'badoblog_cus_section_woo', array(
            'title'    => $mes_adv,
            'panel'    => 'woocommerce',
            'priority' => 999,
        ) );
        // -----------------  Marker - WooCommerce - Breadcrumbs
        $wp_customize->selective_refresh->add_partial( 'badoblog_cus_woo_bread_cat', array(
            'selector' => '.woocommerce-breadcrumb',
        ) );
        // -----------------  Disable sticker - Sale
        $wp_customize->add_setting( 'badoblog_cus_woo_sale', array(
            'default'           => 0,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'badoblog_fun_checkbox_sanitize',
        ) );
        $wp_customize->add_control( 'badoblog_cus_woo_sale', array(
            'type'     => 'checkbox',
            'label'    => esc_html__( 'Disable sticker - Sale', 'bado-blog' ),
            'section'  => 'badoblog_cus_section_woo',
            'settings' => 'badoblog_cus_woo_sale',
        ) );
    }
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region System settings of WordPress
    	---------------------------------------------------------------------------------------------------------------------------*/
    // ----------------- Change Section (Widgets)
    $widget_section = (object) $wp_customize->get_panel( 'widgets' );
    $widget_section->title = esc_html__( 'Widget Locations', 'bado-blog' );
    $widget_section->priority = 1500;
    // ----------------- Change Section (Menu)
    $menu_section = (object) $wp_customize->get_panel( 'nav_menus' );
    $menu_section->title = esc_html__( 'Menu Locations', 'bado-blog' );
    $menu_section->priority = 1500;
    // ----------------- Change Section (Home page settings)
    $home_section = (object) $wp_customize->get_section( 'static_front_page' );
    $home_section->title = esc_html__( 'Define home page', 'bado-blog' );
    $home_section->priority = 1500;
    /*---------------------------------------------------------------------------------------------------------------------------
    	//region Sanitize
    	---------------------------------------------------------------------------------------------------------------------------*/
    // Check radio or select
    function badoblog_fun_radio_sanitize(  $input, $setting  ) {
        $input = sanitize_key( $input );
        $choices = $setting->manager->get_control( $setting->id )->choices;
        return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }

    // Check radio or select (soc)
    function badoblog_fun_radio_sanitize_soc(  $input  ) {
        return sanitize_key( $input );
    }

    // Check checkbox (options are only 1 or 0)
    function badoblog_fun_checkbox_sanitize(  $input  ) {
        if ( $input == 1 ) {
            return 1;
        } else {
            return 0;
        }
    }

    // Checks and adding "#" to the color code (sanitize_callback)
    function badoblog_fun_color_hex_sanitize(  $color  ) {
        if ( $unhashed = sanitize_hex_color_no_hash( $color ) ) {
            return '#' . $unhashed;
        }
        return $color;
    }

    // Cleaning for color selection (sanitize_js_callback)
    function badoblog_fun_color_sanitize(  $input, $setting  ) {
        $input = sanitize_hex_color( $input );
        return ( !is_null( $input ) ? $input : $setting->default );
        return $input;
    }

    function badoblog_fun_img_sanitize(  $image, $setting  ) {
        // Array of valid image file types.
        // The array includes image mime types that are included in wp_get_mime_types()
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png',
            'bmp'          => 'image/bmp',
            'tif|tiff'     => 'image/tiff',
            'ico'          => 'image/x-icon',
        );
        // Return an array with file extension and mime_type
        $file = wp_check_filetype( $image, $mimes );
        // If $image has a valid mime_type, return it; otherwise, return the default
        return ( $file['ext'] ? $image : $setting->default );
    }

    // Full text cleanup
    function badoblog_fun_text_sanitize(  $text  ) {
        return sanitize_text_field( $text );
    }

    // Cleaning textarea
    function badoblog_fun_textarea_sanitize(  $textarea  ) {
        return sanitize_textarea_field( $textarea );
    }

    // Cleanup for use with html tags
    function badoblog_fun_html_sanitize(  $html_sanitize  ) {
        return wp_filter_post_kses( $html_sanitize );
    }

    // All numbers (absolute integer)
    function badoblog_fun_num_sanitize(  $number, $setting  ) {
        // Ensure $number is an absolute integer (whole number, zero or greater).
        $number = absint( $number );
        // If the input is an absolute integer, return it; otherwise, return the default
        return ( $number ? $number : $setting->default );
    }

    // Numbers 1 - 6 (check for - absolute integer, more 0 and less 7)
    function badoblog_fun_num_sanitize_6(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 7 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 1 - 10 (check for - absolute integer, more 0 and less 11)
    function badoblog_fun_num_sanitize_10(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 11 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 1 - 12 (check for - absolute integer, more 0 and less 13)
    function badoblog_fun_num_sanitize_12(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 13 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 1 - 20 (check for - absolute integer, more 0 and less 21)
    function badoblog_fun_num_sanitize_1_20(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 21 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 5 - 100 (check for - absolute integer, more 4 and less 101)
    function badoblog_fun_num_sanitize_5_100(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 4 && $number < 101 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 5 - 50 (check for - absolute integer, more 4 and less 51)
    function badoblog_fun_num_sanitize_5_50(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 4 && $number < 51 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 1 - 50 (check for - absolute integer, more 0 and less 51)
    function badoblog_fun_num_sanitize_1_50(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 51 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 0 - 50 (check for - absolute integer, more or equals 0 and less 51)
    function badoblog_fun_num_sanitize_0_50(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number >= 0 && $number < 51 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 5 - 30 (check for - absolute integer, more 4 and less 31)
    function badoblog_fun_num_sanitize_5_30(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 4 && $number < 31 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 1 - 30 (check for - absolute integer, more 0 and less 31)
    function badoblog_fun_num_sanitize_1_30(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 31 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 0 - 30 (check for - absolute integer, more or equals 0 and less 31)
    function badoblog_fun_num_sanitize_0_30(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number >= 0 && $number < 31 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 1 - 10 000 (check for - absolute integer, more 0 and less 10001)
    function badoblog_fun_num_sanitize_1_10k(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 10001 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 1 - 50 000 (check for - absolute integer, more 0 and less 50001)
    function badoblog_fun_num_sanitize_1_50k(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 0 && $number < 50001 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 0.8 - 5 (check for - numbers, more 0.7 and less 5.1)
    function badoblog_fun_num_sanitize_08_5(  $number, $setting  ) {
        if ( is_numeric( $number ) && $number > 0.7 && $number < 5.1 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Numbers 50 - 1000 (check for - absolute integer, more 49 and less 1001)
    function badoblog_fun_num_sanitize_50_1000(  $number, $setting  ) {
        $number = absint( $number );
        if ( $number > 49 && $number < 1001 ) {
            return $number;
        } else {
            return $setting->default;
        }
    }

    // Check - Category selection
    function badoblog_fun_cat_sanitize(  $input, $setting  ) {
        $valid_keys = array(
            'default__all__categories' => '',
        );
        $categories = get_categories();
        foreach ( $categories as $category ) {
            $valid_keys[$category->slug] = $category->name;
        }
        if ( array_key_exists( $input, $valid_keys ) ) {
            return $input;
        } else {
            return $setting->default;
        }
    }

}

add_action( 'customize_register', 'badoblog_fun_customize_register', 12 );