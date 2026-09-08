<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Search
* ------------------------------------------------------------------------------ */


get_header();
?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<?php
		if (have_posts()) {
			?>
			<header class="badoblog-css-page-header-default">
				<h1 class="badoblog-css-page-title">
					<?php
					printf(
						esc_html__('Search results for: %s', 'bado-blog'),
						'<span>' . get_search_query() . '</span>'
					);
					?>
				</h1>
			</header>
			<div id="badoblog-id-cat-box" class="badoblog-css-cat-box">
				<?php
				// Post cards
				badoblog_fun_content_archive();
				?>
			</div>
			<?php
			the_posts_navigation();
		} else {
			get_template_part('template-parts/content', 'none');
		}
		?>
	</main>
</div>
<?php
badoblog_fun_sidebar_select();
get_footer();
