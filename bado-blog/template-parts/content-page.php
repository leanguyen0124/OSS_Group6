<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Pages
* ------------------------------------------------------------------------------ */


$page_header = 'page-header';
$page_content = 'page-content';
if (get_theme_mod('badoblog_cus_post_general', 'post') != 'post') {
	$page_header = 'mod-pp-header';
	$page_content = 'mod-pp-content';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if (get_theme_mod('badoblog_cus_post_img_top_page', 0) != 1) {
		if (has_post_thumbnail()) {
			do_action('badoblog_hook_before_page_thumb');
			echo '<div class="badoblog-css-page-thumbnail">';
				badoblog_fun_thumb_page();
			echo '</div>';
		}
	}

	if (class_exists('woocommerce')) {
		if (!is_cart() xor !is_checkout() xor !is_account_page()) {
			do_action('badoblog_hook_before_page_title');
		}
	} else {
		do_action('badoblog_hook_before_page_title');
	}
	
	if (!is_front_page()) {
		?>
		<header class="badoblog-css-<?php echo esc_attr($page_header); ?>">
			<?php the_title('<h1 class="badoblog-css-page-title">', '</h1>'); ?>
		</header>
		<?php
	}
		
	if (class_exists('woocommerce')) {
		if (!is_cart() xor !is_checkout() xor !is_account_page()) {
			do_action('badoblog_hook_after_page_title');
		}
	} else {
		do_action('badoblog_hook_after_page_title');
	}
	?>

	<div class="badoblog-css-<?php echo esc_attr($page_content); ?>">
		<?php
		the_content();
		wp_link_pages(array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'bado-blog'),
			'after'  => '</div>',
		));
		?>
	</div>
	<footer class="badoblog-css-page-footer">
		<?php
		$post_type = get_post_type();
		if (!empty($post_type) && post_type_exists($post_type)) {
			edit_post_link(
				sprintf(
					esc_html__('Edit %s', 'bado-blog'),
					the_title('<span>"', '"</span>', false)
				),
				'<span class="edit-link">',
				'</span>'
			);
		}
		?>
	</footer>
</article>
