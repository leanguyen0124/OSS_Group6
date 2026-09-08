<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Category section
* ------------------------------------------------------------------------------ */


get_header(); ?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<?php
		if (get_theme_mod('badoblog_cus_bread_activ_cat', 1) == 1) {
			do_action('badoblog_hook_before_breadcrumbs');
			echo '<nav class="badoblog-css-breadcrumbs">';
				get_template_part('/inc/module/breadcrumb');
			echo '</nav>';
		}
		do_action('badoblog_hook_before_article');
		?>

		<header class="badoblog-css-page-header-default">
			<?php
			the_archive_title('<h1 class="badoblog-css-page-title">', '</h1>');
			the_archive_description('<div class="taxonomy-description">', '</div>');
			?>
		</header>
		
		<?php
		if (have_posts()) {
			$pagi_cat_activ = get_theme_mod('badoblog_cus_pagination_cat_activ', 1);
			$loadmore = get_theme_mod('badoblog_cus_pagination_variant', 'v1');
			?>

			<div id="badoblog-id-cat-box" class="badoblog-css-cat-box">
				<?php

				// Post cards
				badoblog_fun_content_archive();

				// Additional loading of posts (show more)
				if ($pagi_cat_activ == 1) {
					if ($loadmore == 'v2') {
						if ($wp_query->max_num_pages > 1) { ?>
							<script>
								var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
								var true_posts = '<?php echo json_encode($wp_query->query_vars); ?>';
								var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
								var max_pages = '<?php echo esc_attr($wp_query->max_num_pages); ?>';
							</script>
							<div id="badoblog-id-loadmore" class="clear-both"></div>
							<?php
						}
					}
				}
				?>	
			</div>

			<?php 
			if ($pagi_cat_activ == 1) {
				if ($loadmore == 'v1') {

					// Digital pagination
					echo '<div class="clear-both"></div>';
					$prev_next = true;
					if (get_theme_mod('badoblog_cus_pagination_next', 0) == 1) {
						$prev_next = false;
					}
					$show_all = false;
					if (get_theme_mod('badoblog_cus_pagination_num_all', 0) == 1) {
						$show_all = true;
					}
					?>
					<div class="badoblog-css-number-pagination">
						<?php
						the_posts_pagination(array(
							'mid_size' => 2,
							'show_all'     => $show_all,
							'prev_next'    => $prev_next,
						));
						?>
					</div>
					<?php
				} elseif ($loadmore == 'v2') {

					// Additional loading of posts (show more)
					if ($wp_query->max_num_pages > 1) {
						?>
						<nav class="badoblog-css-loadmore">
							<button role="button" id="badoblog-id-loadmore-button" class="badoblog-css-loadmore-button"><?php esc_html_e('Show more', 'bado-blog'); ?></button>
						</nav>
						<?php
					}
				
				} else {

					// Standard WP (Back and Forward)
					?>
					<nav class="navigation posts-navigation" role="navigation">
						<div class="nav-links">
							<div class="nav-previous">
								<?php next_posts_link(esc_html__('Previous posts', 'bado-blog'), $wp_query->max_num_pages); ?>
							</div>
							<div class="nav-next">
								<?php previous_posts_link(esc_html__('Next posts', 'bado-blog')); ?>
							</div>
						</div>
					</nav>
					<?php

				}
			}
			wp_reset_postdata();

		} else {

			?>
			<section class="no-results not-found">
				<div class="none-content">
					<p><?php esc_html_e('There are no posts in this category. Perhaps a search will help.', 'bado-blog'); ?></p>
					<?php get_search_form(); ?>
				</div>
			</section>
			<?php
			
		}
		do_action('badoblog_hook_after_article'); ?>
	
	</main>
</div>
<?php
badoblog_fun_sidebar_select();
get_footer();
