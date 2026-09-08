<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Main page with latest posts
* ------------------------------------------------------------------------------ */


get_header();
?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<?php
		do_action('badoblog_hook_before_main_article');
		if (get_theme_mod('badoblog_cus_home_article_block', 1) == 1) {
			get_template_part('template-parts/home/home-article');
		}
		do_action('badoblog_hook_after_main_article');
		?>
	</main>
</div>
<?php
badoblog_fun_sidebar_select();
get_footer();
