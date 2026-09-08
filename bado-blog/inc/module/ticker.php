<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Ticker
* ------------------------------------------------------------------------------ */

?>
<div class="badoblog-css-top-left">
      <div class="badoblog-css-ticker-box">
            <div class="badoblog-css-ticker">
                  <?php
                  $ticker_var = esc_attr(get_theme_mod('badoblog_cus_ticker_var', 1));
                  if ($ticker_var == 1) {
                        $ticker_cat = esc_attr(get_theme_mod('badoblog_cus_ticker_cat'));
                        $ticker_sort = esc_attr(get_theme_mod('badoblog_cus_ticker_cat_sort', 'date'));
                        $ticker_num = esc_attr(get_theme_mod('badoblog_cus_ticker_cat_number', 1));

                        if ($ticker_cat == 'default__all__categories') {
                              $ticker_cat = '';
                        }

                        $args = array(
                              'posts_per_page'		=> $ticker_num,
                              'category_name'		=> $ticker_cat,
                              'ignore_sticky_posts'   => true,
                              'orderby'               => $ticker_sort,
                              'no_found_rows'         => true
                        );
                        
                        if ($ticker_sort == 'title') {
                              $args['order'] = 'ASC';
                        }
                        
                        $ticker_posts = new WP_Query($args);

                        if ($ticker_posts->have_posts()) {
                              while ($ticker_posts->have_posts()):
                                    $ticker_posts->the_post();
                                    ?>
                                    <span class="badoblog-css-ticker-clear"></span>
                                    <span class="badoblog-css-ticker-post">
                                          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </span>
                                    <?php 
                              endwhile;
                        }
                        wp_reset_postdata();
                  } else {
                        $ticker_name = get_theme_mod('badoblog_cus_ticker_custom_name');
                        $ticker_link = get_theme_mod('badoblog_cus_ticker_custom_link');
                        if (!empty($ticker_name)) {
                              if (empty($ticker_link)) {
                                    $ticker_link = '#';
                              }
                              ?>
                              <span class="badoblog-css-ticker-clear"></span>
                              <span class="badoblog-css-ticker-post">
                                    <a href="<?php echo esc_url($ticker_link); ?>" title="<?php echo esc_attr($ticker_name); ?>"><?php echo esc_html($ticker_name); ?></a>
                              </span>
                              <?php
                        }
                  }
                  ?>
            </div>
      </div>
</div>