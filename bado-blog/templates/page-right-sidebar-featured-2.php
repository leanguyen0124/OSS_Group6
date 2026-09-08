<?php
/* ------------------------------------------------------------------------------
* Template Name: Bado - Right sidebar (featured 2)
* Template Post Type: page, product
* Author: web-zone.org
* @package Bado Blog
* Description: Template for creating pages with a Right sidebar
* ------------------------------------------------------------------------------ */

// Translation for comment - Template Name
esc_html__('Right sidebar', 'bado-blog');

get_header(); ?>

<div class="badoblog-css-right-sidebar badoblog-css-template">

	<div id="primary" class="badoblog-css-content-area">
		<main id="main" class="badoblog-css-site-main">
			<?php

			while (have_posts()) : the_post();
				get_template_part('template-parts/content', 'page');
				if (get_theme_mod('badoblog_cus_post_comments_pages', 0) != 1) {
					if (comments_open() || get_comments_number()) {
						comments_template();
					}
				}
			endwhile;

			if (class_exists('woocommerce')) {
				if (!is_cart() xor !is_checkout() xor !is_account_page()) {
					do_action('badoblog_hook_after_page');
				}
			} else {
				do_action('badoblog_hook_after_page');
			}

			?>
		</main>
	</div>

	<?php
	if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('badoblog_elementor_sidebar')) {
		if (is_active_sidebar('sidebar-featured-2')) {
			echo '<aside id="secondary" class="badoblog-css-widget-area">';
				dynamic_sidebar('sidebar-featured-2');
			echo '</aside>';
		} else {
			get_sidebar();
		}
	}
	?>

</div>

<?php
get_footer();