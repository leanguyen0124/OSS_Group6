<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: 404
* ------------------------------------------------------------------------------ */


get_header(); ?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<header class="badoblog-css-page-header-default">
			<h1 class="badoblog-css-page-title">
				<?php esc_html_e('Unfortunately! This page cannot be found.', 'bado-blog'); ?>
			</h1>
		</header>
		<div class="none-content">
			<p>
				<?php
				esc_html_e(
					'Nothing was found at this location. Try one of the links below or use the search.',
					'bado-blog'
				);
				?>
			</p>
			
			<div class="search_404">
				<?php get_search_form(); ?>
			</div>
			
			<div class="widget_404_box">

				<div class="widget_404_chield">
					<?php the_widget('WP_Widget_Recent_Posts'); ?>
				</div>
				
				<div class="widget_404_chield">
					<?php 
					if (badoblog_fun_categorized_blog()) { ?>
						<div class="widget widget_categories">
							<h2><?php esc_html_e('Most popular categories', 'bado-blog'); ?></h2>
							<ul>
								<?php
								wp_list_categories(array(
									'orderby'    => 'count',
									'order'      => 'DESC',
									'show_count' => 1,
									'title_li'   => '',
									'number'     => 10,
								));
								?>
							</ul>
						</div>
						<?php 
					} ?>
				</div>
				
				<div class="widget_404_chield">
					<?php
					$archive_content = '<p>' . 
					sprintf(
						esc_html__('Try searching the monthly archives. %1$s', 'bado-blog'),
						convert_smilies(':)')
					)
					. '</p>';
					the_widget('WP_Widget_Archives', 'dropdown=0', "after_title=</h2>$archive_content");
					?>
				</div>

				<div class="widget_404_chield">
					<?php the_widget('WP_Widget_Tag_Cloud'); ?>
				</div>

			</div>
		</div>
	</main>
</div>
<?php
badoblog_fun_sidebar_select();
get_footer();
