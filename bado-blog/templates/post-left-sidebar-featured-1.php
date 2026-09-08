<?php
/* ------------------------------------------------------------------------------
* Template Name: Bado - Left sidebar (featured 1)
* Template Post Type: post
* Author: web-zone.org
* @package Bado Blog
* Description: Template for creating posts with a left sidebar
* ------------------------------------------------------------------------------ */

// Translation for comment - Template Name
esc_html__('Left sidebar', 'bado-blog');

get_header(); ?>
<div class="badoblog-css-left-sidebar badoblog-css-template">

	<div id="primary" class="badoblog-css-content-area">
		<main id="main" class="badoblog-css-site-main">
			<?php
			while (have_posts()) : the_post();
				get_template_part('template-parts/content', 'single');
				if (is_singular('post')) {
					if (esc_attr(get_theme_mod('badoblog_cus_post_next', 0)) != 1) {
						do_action('badoblog_hook_before_post_next');
						get_template_part('template-parts/content-next-post');
					}
					if (esc_attr(get_theme_mod('badoblog_cus_post_related', 1)) == 1) {
						do_action('badoblog_hook_before_post_related');
						get_template_part('template-parts/content-related');
					}
				}
				if (get_theme_mod('badoblog_cus_post_comments_posts', 0) != 1) {
					do_action('badoblog_hook_before_post_comments');
					if (comments_open() || get_comments_number()) :
						comments_template();
					endif;
				}
			endwhile;
			do_action('badoblog_hook_after_post');
			?>
		</main>
	</div>

	<?php
	if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('badoblog_elementor_sidebar')) {
		if (is_active_sidebar('sidebar-featured-1')) {
			echo '<aside id="secondary" class="badoblog-css-widget-area">';
				dynamic_sidebar('sidebar-featured-1');
			echo '</aside>';
		} else {
			get_sidebar();
		}
	}
	?>

</div>
<?php
get_footer();