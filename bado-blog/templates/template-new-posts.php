<?php
/* ------------------------------------------------------------------------------
* Template Name: Bado - New Posts
* Author: web-zone.org
* @package Bado Blog
* Description: Recent Posts Page Template
* ------------------------------------------------------------------------------ */

// Translation for comment - Template Name
esc_html__('New Posts', 'bado-blog');

get_header();
?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<?php
		if (get_query_var('paged')) {
			$paged = get_query_var('paged');
		}
		elseif (get_query_var('page')) {
			$paged = get_query_var('page');
		}
		else {
			$paged = 1;
		}
		$the_query = new WP_Query('post_type=post&paged=' . $paged);
		if ($the_query->have_posts()) {

			if (!is_home() && !is_front_page()) : ?>
				<header>
					<h1 class="badoblog-css-page-title"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
			
			<div id="badoblog-id-cat-box" class="badoblog-css-cat-box">
				<?php
				$thumb_par = badoblog_fun_post_thumb_par('cat');
				$no_img = get_theme_mod('badoblog_cus_cat_style_nofoto_none', 0);
				$meta_boxs = get_theme_mod('badoblog_cus_cat_meta_boxs', 1);
				$meta_cat = get_theme_mod('badoblog_cus_cat_meta_cat', 1);
				$title_none = get_theme_mod('badoblog_cus_cat_style_title_none', 0);
				$meta_tag = get_theme_mod('badoblog_cus_cat_meta_tag', 1);
				$entry_none = get_theme_mod('badoblog_cus_cat_style_entry_none', 0);
				$read_more = get_theme_mod('badoblog_cus_cat_style_more', 0);
				$more_text = get_theme_mod('badoblog_cus_cat_style_more_text', 'Read more');
				while ($the_query->have_posts()) : $the_query->the_post();
					get_template_part('template-parts/content-archive', null, array(
						'thumb_par' => $thumb_par,
						'no_img' => $no_img,
						'meta_boxs' => $meta_boxs,
						'meta_cat' => $meta_cat,
						'title_none' => $title_none,
						'meta_tag' => $meta_tag,
						'entry_none' => $entry_none,
						'read_more' => $read_more,
						'more_text' => $more_text
					));
				endwhile;
				?>
			</div>

			<nav class="navigation posts-navigation" role="navigation">
				<div class="nav-links">
					<div class="nav-previous"><?php next_posts_link(esc_html__('Previous posts', 'bado-blog'), $the_query->max_num_pages); ?></div>
					<div class="nav-next"><?php previous_posts_link(esc_html__('Next posts', 'bado-blog')); ?></div>
				</div>
			</nav>
			
			<?php
			wp_reset_postdata();
		} else {
			get_template_part('template-parts/content', 'none');
		} ?>
	</main>
</div>
<?php
badoblog_fun_sidebar_select();
get_footer();
