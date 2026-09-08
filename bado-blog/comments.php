<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Comments
* ------------------------------------------------------------------------------ */


if (post_password_required()) {
	return;
}

if (have_comments()) { ?>

	<h2 class="comments-title">
		<?php
		$comment_count = get_comments_number();
		if ('1' === $comment_count) {
			printf(
				esc_html__('One thought on &ldquo;%1$s&rdquo;', 'bado-blog'),
				'<span>' . wp_kses_post(get_the_title()) . '</span>'
			);
		} else {
			printf( 
				esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'bado-blog')),
				number_format_i18n($comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				'<span>' . wp_kses_post(get_the_title()) . '</span>'
			);
		}
		?>
	</h2>

	<div id="comments" class="comments-area">

		<?php 
		if (get_comment_pages_count() > 1 && get_option('page_comments')) { ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<div class="nav-links">
					<div class="nav-previous"><?php previous_comments_link(esc_html__('Old comments', 'bado-blog')); ?></div>
					<div class="nav-next"><?php next_comments_link(esc_html__('Latest comments', 'bado-blog')); ?></div>
				</div>
			</nav>
			<?php
		} ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(array(
				'style'      => 'ol',
				'short_ping' => true
			));
			?>
		</ol>

		<?php
		if (get_comment_pages_count() > 1 && get_option('page_comments')) { ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<div class="nav-links">
					<div class="nav-previous"><?php previous_comments_link(esc_html__('Old comments', 'bado-blog')); ?></div>
					<div class="nav-next"><?php next_comments_link(esc_html__('Latest comments', 'bado-blog')); ?></div>
				</div>
			</nav>
			<?php 
		}
		?>

	</div>
	<?php
}

if (! comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
	<p class="no-comments"><?php esc_html_e('Comments closed', 'bado-blog'); ?></p>
	<?php 
}
comment_form();
?>