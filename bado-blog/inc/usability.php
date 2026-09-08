<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Usability
* ------------------------------------------------------------------------------ */
//----------------------------------------------------------------------------------
//region Static Widgets
//----------------------------------------------------------------------------------
if ( get_theme_mod( 'badoblog_cus_widget_sidebar_demo', 0 ) == 0 ) {
    // Add static widgets
    $url_theme = get_template_directory_uri();
    $wite_theme = strstr( $url_theme, 'wp-themes' );
    if ( $wite_theme ) {
        function badoblog_fun_sidebar_1_demo() {
            ?>
                        <section id="pages" class="widget widget_pages">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget example', 'bado-blog' ) . ' (' . esc_html__( 'Pages', 'bado-blog' ) . ')';
            ?></div>
                              <nav>
                              <ul>
                              <?php 
            wp_list_pages( array(
                'title_li' => '',
                'number'   => 5,
            ) );
            ?>
                              </ul>
                              </nav>
                        </section>
                        <section id="categories" class="widget widget_categories">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget example', 'bado-blog' ) . ' (' . esc_html__( 'Categories', 'bado-blog' ) . ')';
            ?></div>
                              <nav>
                              <ul>
                              <?php 
            wp_list_categories( array(
                'title_li' => '',
                'number'   => 5,
            ) );
            ?>
                              </ul>
                              </nav>
                        </section>
                        <section id="archives" class="widget widget_archive">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget example', 'bado-blog' ) . ' (' . esc_html__( 'Archives', 'bado-blog' ) . ')';
            ?></div>
                              <nav>
                              <ul>
                              <?php 
            wp_get_archives( array(
                'limit' => 5,
            ) );
            ?>
                              </ul>
                              </nav>
                        </section>
                        <section id="tag_cloud" class="widget widget_tag_cloud">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget example', 'bado-blog' ) . ' (' . esc_html__( 'Tag cloud', 'bado-blog' ) . ')';
            ?></div>
                              <nav>
                              <div class="tagcloud">
                              <?php 
            wp_tag_cloud( array(
                'number' => 15,
            ) );
            ?>
                              </div>
                              </nav>
                        </section>
                        <?php 
        }

        function badoblog_fun_footer_sidebar_one_demo() {
            ?>
                        <section id="categories" class="widget widget_categories">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget', 'bado-blog' ) . ' (' . esc_html__( 'Categories', 'bado-blog' ) . ')';
            ?></div>
                              <nav>
                              <ul>
                              <?php 
            wp_list_categories( array(
                'title_li' => '',
                'number'   => 5,
            ) );
            ?>
                              </ul>
                              </nav>
                        </section>
                        <?php 
        }

        function badoblog_fun_footer_sidebar_two_demo() {
            ?>
                        <section id="archives" class="widget widget_archive">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget example', 'bado-blog' ) . ' (' . esc_html__( 'Archives', 'bado-blog' ) . ')';
            ?></div>
                              <nav>
                              <ul>
                              <?php 
            wp_get_archives( array(
                'limit' => 4,
            ) );
            ?>
                              </ul>
                              </nav>
                        </section>
                        <?php 
        }

        function badoblog_fun_footer_sidebar_three_demo() {
            ?>
                        <section id="categories" class="widget widget_categories">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget', 'bado-blog' ) . ' (' . esc_html__( 'Categories', 'bado-blog' ) . ')';
            ?></div>
                              <nav>
                              <ul>
                              <?php 
            wp_list_categories( array(
                'title_li' => '',
                'number'   => 2,
                'orderby'  => 'count',
                'order'    => 'DESC',
            ) );
            ?>
                              </ul>
                              </nav>
                        </section>
                        <?php 
        }

        function badoblog_fun_footer_sidebar_four_demo() {
            ?>
                        <section id="calendar" class="widget widget_calendar">
                              <div class="widget-title"><?php 
            echo esc_html__( 'Widget', 'bado-blog' ) . ' (' . esc_html__( 'Calendar', 'bado-blog' ) . ')';
            ?></div>
                              <div id="calendar_wrap" class="calendar_wrap">
                              <?php 
            get_calendar();
            ?>
                              </div>
                        </section>
                        <?php 
        }

    }
}