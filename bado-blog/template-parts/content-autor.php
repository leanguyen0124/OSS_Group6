<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Section author
* ------------------------------------------------------------------------------ */


$autor_id = get_the_author_meta('ID');
$avatar_none = get_theme_mod('badoblog_cus_post_bio_avatar', 0);
$soc_none = 1;
$soc_none = apply_filters('dmcwzmulti_filter_soc_none', $soc_none);

?>
<div class="badoblog-css-border-center-top"></div>
<div class="badoblog-css-bio-post-box">

    <address class="badoblog-css-bio-post-user">

        <?php
        // Avatar
        if ($avatar_none != 1) {
            ?>
            <div class="badoblog-css-bio-post-box-left">
                <div class="badoblog-css-bio-post-box-left-img">
                    <?php
                    $autor_alt = esc_html__('Author photo', 'bado-blog');
                    echo wp_kses_post(get_avatar($autor_id, 120, '', $autor_alt));
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="badoblog-css-bio-post-box-right">

            <div class="badoblog-css-bio-post-author-header">
                
                <div class="badoblog-css-bio-post-author-namebox">
                    <div class="badoblog-css-bio-post-author-label">
                        <?php esc_html_e('Author', 'bado-blog'); ?>
                    </div>
                    <div class="badoblog-css-bio-post-author-name">
                        <?php the_author(); ?>
                    </div>
                </div>

                <?php
                // Soc
                if ($soc_none == 0) {
                    do_action('dmcwzmulti_hook_author_soc');
                }
                ?>

            </div>

            <?php
            // Author description
            if (get_theme_mod('badoblog_cus_post_bio_description', 0) != 1) {
                ?>
                <div class="badoblog-css-bio-post-author-des">
                    <?php echo esc_html(get_the_author_meta('description', $autor_id)); ?>
                </div>
                <?php
            }
            ?>
            
        </div>
    </address>
    
    <?php
    // Author latest posts
    if (get_theme_mod('badoblog_cus_post_bio_related', 0) == 1) {

        $bio_h = '';
        $bio_h = esc_attr(get_theme_mod('badoblog_cus_post_bio_related_h', esc_html__('Latest posts (Author)', 'bado-blog')));
        if (!empty($bio_h)) { ?>
            <h2><?php echo esc_html($bio_h); ?></h2>
        <?php }

        $amount_autor_post = get_theme_mod('badoblog_cus_post_bio_related_amount', 12);
        $q = new WP_Query("posts_per_page=$amount_autor_post&author=$autor_id");
        if ($q->have_posts()) {
            ?>
            <div class="badoblog-css-bio-post-autor-posts">
                <?php
                $alt = get_theme_mod('badoblog_cus_seo_alt_nofoto', 'No photo');
                while($q->have_posts()): $q->the_post(); ?>
                    <div class="badoblog-css-bio-post-autor-posts-child">
                        <?php if (has_post_thumbnail()) { ?>
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('badoblog-img-112x63');?></a>
                        <?php } else { ?>
                            <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/img/no-photo/no-foto-112x63.png'); ?>"
                                alt="<?php echo esc_attr($alt); ?>"></a>
                        <?php } ?>
                    </div>
                    <?php
                endwhile; ?>
            </div>
            <?php
        }
        wp_reset_postdata();

    }
    ?>
    
</div>
<div class="badoblog-css-border-center-bottom"></div>

