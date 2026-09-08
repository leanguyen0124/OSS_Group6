<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Related posts
* ------------------------------------------------------------------------------ */


if (!function_exists('badoblog_fun_related_post')) {
    function badoblog_fun_related_post() {
        global $post;
        $related_tax = esc_attr(get_theme_mod('badoblog_cus_post_related_taxonomy', 'cat'));
        $amount = esc_attr(get_theme_mod('badoblog_cus_post_related_amount', 8));
        $h = esc_attr(get_theme_mod('badoblog_cus_post_related_h', esc_html__('Related posts', 'bado-blog')));

        $no_img_off = get_theme_mod('badoblog_cus_post_related_nofoto', 0);
        $thumb_par = badoblog_fun_post_thumb_par('related');

        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => $amount,
            'ignore_sticky_posts'   => true,
            'post__not_in'          => array($post->ID),
            'orderby'               => 'rand'
        );

        if ($related_tax == 'cat') {
            $cats = get_the_category($post->ID);
            if ($cats) {
                $c = array();
                foreach ($cats as $cat) {
                    $c[] = $cat->term_id;
                }
                $args['category__in'] = $c;
            }
        } else if ($related_tax == 'tag') {
            $tags = get_the_tags($post->ID);
            if ($tags) {
                $t = array();
                foreach ($tags as $tag) {
                    $t[] = $tag->term_id;
                }
                $args['tag__in'] = $t;
            }
        }

        $q = new WP_Query($args);
        if ($q->have_posts()) {
            ?>
            <section class="badoblog-css-related-section">
                <h2>
                    <?php echo esc_html($h); ?>
                </h2>
                <div class="badoblog-css-related-box">
                    <?php
                    while ($q->have_posts()) {
                        $q->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('badoblog-css-related-post-box'); ?>>

                            <?php
                            $noimg = ''; // pre-cycle cleaning
                            if (has_post_thumbnail()) {
                                ?>
                                <div class="badoblog-css-related-thumbnail">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                                        <?php badoblog_fun_post_thumb_img($thumb_par); ?>
                                    </a>
                                </div>
                                <?php
                            } else if ($no_img_off == 0) {
                                ?>
                                <div class="badoblog-css-related-thumbnail">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
                                        <?php badoblog_fun_post_thumb_no_img($thumb_par); ?>
                                    </a>
                                </div>
                                <?php
                            } else {
                                $noimg = ' badoblog-css-related-no-img';
                            }
                            ?>

                            <header class="badoblog-css-related-post-header<?php echo esc_attr($noimg); ?>">
                                <?php
                                the_title('<h2 class="badoblog-css-related-post-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                ?>
                            </header>

                        </article>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
            <?php
        }
    }
    badoblog_fun_related_post();
}
?>