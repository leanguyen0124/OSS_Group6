<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Footer
* ------------------------------------------------------------------------------ */

?>
</div>
<?php
if (get_theme_mod('badoblog_cus_footer', 1) == 1) {
	if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('footer')) { ?>
		<footer id="colophon" class="badoblog-css-site-footer">
			<div class="badoblog-css-site-footer-container">
				<?php
				do_action('badoblog_hook_before_footer');
				get_sidebar('footer');
				if (get_theme_mod('badoblog_cus_footer_menu', 1) == 1) {
					echo '<div class="badoblog-css-footer-menu">';
						do_action('badoblog_hook_before_menu_footer');
						wp_nav_menu(array('theme_location' => 'badoblog-loc-menu-footer', 'depth' => 1));
					echo '</div>';
				}
				$brand = get_theme_mod('badoblog_cus_footer_brand', 'Created with the <a href="//web-zone.org/bado-blog" target="_blank" rel="nofollow">WP Theme Bado Blog</a>');
				if (!empty($brand)) {
					echo '<div class="badoblog-css-footer-info">';
						echo wp_kses_post($brand);
					echo '</div>';
				}
				do_action('badoblog_hook_after_footer');
				?>
			</div>
		</footer>
		<?php 
	}
}
?>
</div>
<a href="#" class="badoblog-css-scrollup"></a>
<?php wp_footer(); ?>
</body>
</html>