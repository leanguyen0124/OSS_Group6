<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Blocks of posts
* ------------------------------------------------------------------------------ */


$thumb_par = $args['thumb_par'];
$no_img = $args['no_img'];
$meta_boxs = $args['meta_boxs'];
$meta_cat = $args['meta_cat'];
$title_none = $args['title_none'];
$meta_tag = $args['meta_tag'];
$entry_none = $args['entry_none'];
$read_more = $args['read_more'];
$more_text = $args['more_text'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('badoblog-css-cat-grid'); ?>>
	<?php

	// Thumbnail
	$noimg = ''; // pre-cycle cleaning
	if (has_post_thumbnail()) {
		?>
		<div class="badoblog-css-cat-thumbnail-box">
			<div class="badoblog-css-cat-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
					<div class="badoblog-css-cat-thum-anime">
						<?php
						badoblog_fun_post_thumb_img($thumb_par);
						?>
					</div>
				</a>
				<?php 
				if ($meta_cat == 1) {
					badoblog_fun_cat_meta_tax_cat_box('thumb'); 
				}
				?>
			</div>
		</div>
		<?php
	} else if ($no_img == 0) {
		?>
		<div class="badoblog-css-cat-thumbnail-box">
			<div class="badoblog-css-cat-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">
					<div class="badoblog-css-cat-thum-anime">
						<?php
						badoblog_fun_post_thumb_no_img($thumb_par);
						?>
					</div>
				</a>
				<?php 
				if ($meta_cat == 1) {
					badoblog_fun_cat_meta_tax_cat_box('thumb'); 
				}
				?>
			</div>
		</div>
		<?php
	} else {
		$noimg = ' badoblog-css-cat-no-img';
	}
	// Thumb end
	?>


	<div class="badoblog-css-entry-box">
		<?php

		// Meta tags (Category)
		if ($meta_cat == 1) {
			badoblog_fun_cat_meta_tax_cat_box('header');
		}

		// Title
		if ($title_none != 1) {
			?>
			<div class="badoblog-css-entry-header">
				<?php
				the_title('<h2 class="badoblog-css-entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
				?>
			</div>
			<?php
		}

		// Meta boxs
		if ('post' === get_post_type()) {
			if ($meta_boxs == 1) {
				badoblog_fun_cat_meta_boxs();
			}
		}

		// Meta tags (tags)
		if ($meta_tag == 1) {
			badoblog_fun_cat_meta_tax_tag();
		}

		// Content
		if ($entry_none != 1) {
			?>
			<div class="badoblog-css-entry-content"><?php // css empty
				if (!is_search()) {
					echo badoblog_fun_excerpt();
				} else {
					the_excerpt();
				}
			?></div>
			<?php
		}
	
		// Read more
		if ($read_more == 1) {
			if (!empty($more_text)) { 
				?>
				<div class="badoblog-css-entry-more">
					<a href="<?php the_permalink(); ?>" class="badoblog-css-more-link" ><?php echo esc_html($more_text); ?></a>
				</div>
				<?php
			}
		}
		?></div>
</article>
