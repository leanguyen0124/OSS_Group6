<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Posts
* ------------------------------------------------------------------------------ */


$post_header = 'post-header';
$post_content = 'post-content';
if (get_theme_mod('badoblog_cus_post_general', 'post') != 'page') {
	$post_header = 'mod-pp-header';
	$post_content = 'mod-pp-content';
}
$meta_boxs = get_theme_mod('badoblog_cus_post_meta_boxs', 1);

if (is_singular('post')) {
	if (get_theme_mod('badoblog_cus_bread_activ_post', 1) == 1) {

		// hook - conclusion before breadcrumbs
		do_action('badoblog_hook_before_breadcrumbs');

		// breadcrumbs
		echo '<nav class="badoblog-css-breadcrumbs">';
			get_template_part('/inc/module/breadcrumb');
		echo '</nav>';
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if (get_theme_mod('badoblog_cus_post_img_top_post', 0) != 1) {
		if (has_post_thumbnail()) {

			// hook - conclusion before post image
			do_action('badoblog_hook_before_post_thumb');

			// Top post image
			echo '<div class="badoblog-css-post-thumbnail">';
				badoblog_fun_thumb_post();
				if (function_exists('badoblog_fun_post_meta_tax')) {
					badoblog_fun_post_meta_tax('thumb');
				}
			echo '</div>';
		}
	}

	// hook - conclusion before post title
	do_action('badoblog_hook_before_post_title');
	?>

	<header class="badoblog-css-<?php echo esc_attr($post_header); ?>">
		<?php
		// Post title
		the_title('<h1 class="badoblog-css-post-title">', '</h1>');

		// Meta tags at the top of posts
		do_action('badoblog_hook_before_post_meta');
		if (get_post_type() === 'post') {
			if ($meta_boxs == 1) {
				badoblog_fun_post_meta_boxs();
			}
			if (function_exists('badoblog_fun_post_meta_tax')) {
				badoblog_fun_post_meta_tax('top');
			}
		}
		?>
	</header>
	
	<?php
	// hook - conclusion before post content
	do_action('badoblog_hook_before_post_content');
	?>

	<div class="badoblog-css-<?php echo esc_attr($post_content); ?>">
		<?php
		// Content block
		the_content();
		// Splitting Posts into Multiple Pages
		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Posts:', 'bado-blog'),
			'after'  => '</div>'
		));
		?>
	</div>
	<footer class="badoblog-css-post-footer">

		<?php
		// Meta tags at the bottom of the post
		if (function_exists('badoblog_fun_post_meta_tax')) {
			badoblog_fun_post_meta_tax('bottom');
		}

		// Date post for footer
		if ($meta_boxs == 1) {
			if (get_theme_mod('badoblog_cus_post_meta_boxs_footer_date', 0) == 1) {
				badoblog_fun_post_meta_footer_date();
			}
		}

		// Record editing function
		$post_type = get_post_type();
		if (!empty($post_type) && post_type_exists($post_type)) {
			edit_post_link(
				sprintf(
					esc_html__('Edit %s', 'bado-blog'),
					the_title('<span>"', '"</span>', false)
				),
				'<div class="badoblog-css-post-edit-link"><span class="edit-link"> ',
				'</span></div>'
			);
		}

		// hook - conclusion before author block
		do_action('badoblog_hook_before_post_bio');

		// Author block
		if (is_single()) {
			if (get_theme_mod('badoblog_cus_post_bio', 1) == 1) {
				get_template_part('template-parts/content-autor');
			}
		}
		?>

	</footer>
</article>
