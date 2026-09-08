<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Meta tags for categories and posts
* ------------------------------------------------------------------------------ */


/*---------------------------------------------------------------------------------------------------------------------------
//region Category
---------------------------------------------------------------------------------------------------------------------------*/
	
// Meta tags (meta boxs)
function badoblog_fun_cat_meta_boxs() {
	$cat_label_on = esc_attr(get_theme_mod('badoblog_cus_cat_meta_boxs_label', 0));
	?>
	<div class="badoblog-css-entry-meta">
		<div class="badoblog-css-cat-meta-boxs">

			<?php
			// Post Author
			if (esc_attr(get_theme_mod('badoblog_cus_cat_meta_boxs_author', 1)) == 1) {
				?>
				<div class="badoblog-css-cat-meta-box" data-info="<?php esc_attr_e('Post author', 'bado-blog'); ?>">
					<div class="icon-autor-cat-meta"></div>
					<div class="badoblog-css-cat-meta-label-data">
						<?php if ($cat_label_on == 1) { ?>
							<div class="badoblog-css-cat-meta-label">
								<?php esc_html_e('Author', 'bado-blog'); ?>
							</div>
						<?php } ?>
						<div class="badoblog-css-cat-meta-data">
							<?php
							echo sprintf(
								esc_html_x('%s', 'post author', 'bado-blog'),
								'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
							);
							?>
						</div>
					</div>
				</div>
				<?php
			}

			// Number of comments on a post
			if (esc_attr(get_theme_mod('badoblog_cus_cat_meta_boxs_comment', 1)) == 1) {
				if (! post_password_required() && (comments_open() || get_comments_number())) {
					?>
					<div class="badoblog-css-cat-meta-box" data-info="<?php esc_attr_e('Number of comments on a post', 'bado-blog'); ?>">
						<div class="icon-bubble-cat-meta"></div>
						<div class="badoblog-css-cat-meta-label-data">
							<?php 
							if ($cat_label_on == 1) {
								?>
								<div class="badoblog-css-cat-meta-label">
									<?php esc_html_e('Comments', 'bado-blog'); ?>
								</div>
								<?php
							}
							?>
							<div class="badoblog-css-cat-meta-data">
								<?php comments_popup_link('0', '1', '%'); ?>
							</div>
						</div>
					</div>
					<?php
				}
			}

			// Number of post views
			if (esc_attr(get_theme_mod('badoblog_cus_cat_meta_boxs_view', 1)) == 1) {
				?>
				<div class="badoblog-css-cat-meta-box" data-info="<?php esc_attr_e('Number of post views', 'bado-blog'); ?>">
					<div class="icon-eye-cat-meta"></div>
					<div class="badoblog-css-cat-meta-label-data">
						<?php if ($cat_label_on == 1) { ?>
							<div class="badoblog-css-cat-meta-label">
								<?php esc_html_e('Views', 'bado-blog'); ?>
							</div>
						<?php } ?>
						<div class="badoblog-css-cat-meta-data">
							<?php echo dmcwzmulti_fun_get_views(get_the_ID()); ?>
						</div>
					</div>
				</div>
				<?php
			}

			// Post creation date
			if (esc_attr(get_theme_mod('badoblog_cus_cat_meta_boxs_date', 1)) == 1) {
				?>
				<div class="badoblog-css-cat-meta-box" data-info="<?php esc_attr_e('Post creation date', 'bado-blog'); ?>">
					<div class="icon-calendar-cat-meta"></div>
					<div class="badoblog-css-cat-meta-label-data">
						<?php
						if ($cat_label_on == 1) {
							?>
							<div class="badoblog-css-cat-meta-label">
								<?php esc_html_e('Created', 'bado-blog'); ?>
							</div>
							<?php 
						}
						?>	
						<div class="badoblog-css-cat-meta-data">
							<?php
							// Functional - Post creation date
							$cat_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
							if (get_the_time('U') !== get_the_modified_time('U')) {
								$cat_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
							}
							$cat_time_string = sprintf($cat_time_string,
								esc_attr(get_the_date('c')),
								esc_html(get_the_date()),
								esc_attr(get_the_modified_date('c')),
								esc_html(get_the_modified_date())
							);
							// Display - Post creation date
							echo sprintf(
								esc_html_x('%s', 'post date', 'bado-blog'),
								$cat_time_string
							);
							?>
						</div>
					</div>
				</div>
				<?php
			}

			// Record update date
			if (esc_attr(get_theme_mod('badoblog_cus_cat_meta_boxs_update', 0)) == 1) {
				?>
				<div class="badoblog-css-cat-meta-box" data-info="<?php esc_attr_e('Post update date', 'bado-blog'); ?>">
					<div class="icon-spinner-cat-meta"></div>
					<div class="badoblog-css-cat-meta-label-data">
						<?php if ($cat_label_on == 1) { ?>
							<div class="badoblog-css-cat-meta-label">
								<?php esc_html_e('Updated', 'bado-blog'); ?>
							</div>
						<?php } ?>
						<div class="badoblog-css-cat-meta-data">
							<?php
							// Functional - Record update date
							$time_cat_up = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
							if (get_the_modified_time('U') !== get_the_time('U')) {
								$time_cat_up = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
							}
							$time_cat_up = sprintf($time_cat_up,
								esc_attr(get_the_modified_date('c')),
								esc_html(get_the_modified_date()),
								esc_attr(get_the_date('c')),
								esc_html(get_the_date())
							);
							// Display - Record update date
							echo sprintf(
								esc_html_x('%s', 'post date', 'bado-blog'),
								$time_cat_up
							);
							?>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}


// Meta tags categories (in cat)
function badoblog_fun_cat_meta_tax_cat($arg) {

	$cat_list_cat = get_the_category();

	if ($cat_list_cat && badoblog_fun_categorized_blog()) {

		// Check Yoast SEO and change the order of links (only if main category is selected)
		if (class_exists('WPSEO_Primary_Term')) {
			$primary_term = new WPSEO_Primary_Term('category', get_the_ID());
			$primary_cat_id = !is_wp_error($primary_term->get_primary_term()) ? $primary_term->get_primary_term() : false;
			if ($primary_cat_id) {
				foreach ($cat_list_cat as $key => $category) {
					if ($category->term_id == $primary_cat_id ) {
						$primary_cat = $category;
						unset($cat_list_cat[$key] );
						array_unshift($cat_list_cat, $primary_cat );
						break;
					}
				}
			}
		}

		// Limit the quantity
		$limit_cat = 1;
		if ($arg == 'all') {
			$limit_cat = get_theme_mod('badoblog_cus_cat_meta_cat_item', 2);
		}
		$cat_list_cat = array_slice($cat_list_cat, 0, $limit_cat );

		// Create links
		$limit_cat_array = array_map(function($category) {
			return sprintf(
				'<a href="%s" rel="category tag">%s</a>',
				esc_url(get_category_link($category->term_id)),
				esc_html($category->name)
			);
		}, $cat_list_cat);

		// Output
		echo '<div class="badoblog-css-cat-meta-taxonomy-cat">'.
			'<div class="badoblog-css-cat-meta-tax-cat">' . 
				'<div class="badoblog-css-cat-meta-tax-cat-ul">'.
					implode($limit_cat_array).
				'</div>'.
			'</div>'.
		'</div>';

	}

}

// Meta tags categories (in cat) - output
function badoblog_fun_cat_meta_tax_cat_box($lay) {
	$lay_tax = get_theme_mod('badoblog_cus_cat_meta_cat_layout', 'thumb-bottom');
	if ($lay_tax != 'header') {
		$lay_tax = 'thumb';
	}
	if ($lay == $lay_tax) {
		if ($lay_tax == 'thumb') {
			badoblog_fun_cat_meta_tax_cat('one');
			wp_enqueue_script('badoblog-script-meta-tax-cat');
		} else {
			badoblog_fun_cat_meta_tax_cat('all');
		}
	}
}



// Meta tags - Tags (in cat)
function badoblog_fun_cat_meta_tax_tag() {
	$cat_list_tag = get_the_tag_list('','d1y2w3');
	if (!empty($cat_list_tag)) {
		$limit_tag = get_theme_mod('badoblog_cus_cat_meta_tag_item', 3);
		$tag_array = explode('d1y2w3', $cat_list_tag);
		$limit_tag_array = array_slice($tag_array, 0, $limit_tag);
		echo '<div class="badoblog-css-cat-meta-taxonomy-tag">'.
			'<div class="badoblog-css-cat-meta-tax-tag">'. 
				'<div class="badoblog-css-cat-meta-tax-tag-ul">'.
					implode($limit_tag_array).
				'</div>'.
			'</div>'.
		'</div>';
	}
}


/*---------------------------------------------------------------------------------------------------------------------------
//region Posts
---------------------------------------------------------------------------------------------------------------------------*/
	
// Meta tags (in post)
function badoblog_fun_post_meta_boxs() {

	$post_label_none = esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_label', 0));

	// Functional - post reading time
	if (!function_exists('badoblog_fun_post_time_words')) {
		function badoblog_fun_post_time_words() {
			$words_per_minutes = 300;
			$content_text = is_single() ? get_the_content() : get_post(get_the_ID())->post_content;
			$minutes = round(count(preg_split('/\s/', $content_text)) /  $words_per_minutes);
			if ($minutes == 0) {
				return esc_html_e('Less 1 min', 'bado-blog');
			} else {
				return $minutes . ' ' . esc_html__('min', 'bado-blog');
			}
		}
	}
	?>

	<div class="badoblog-css-post-meta-boxs">

		<?php
		// Post Author
		if (esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_autor', 1)) == 1) {
			?>
			<div class="badoblog-css-post-meta-box" data-info="<?php esc_attr_e('Post author', 'bado-blog'); ?>">
				<div class="icon-autor-post-meta"></div>
				<div class="badoblog-css-post-meta-label-data">
					<?php
					if ($post_label_none != 1) {
						?>
						<div class="badoblog-css-post-meta-label">
							<?php esc_html_e('Author', 'bado-blog'); ?>
						</div>
						<?php
					}
					?>
					<div class="badoblog-css-post-meta-data">
						<?php
						echo sprintf(
							esc_html_x('%s', 'post author', 'bado-blog'),
							'<a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a>'
						);
						?>
					</div>
				</div>
			</div>
			<?php 
		}

		// Record creation date
		if (esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_date', 1)) == 1) {
			?>
			<div class="badoblog-css-post-meta-box" data-info="<?php esc_attr_e('Post creation date', 'bado-blog'); ?>">
				<div class="icon-calendar-post-meta"></div>
				<div class="badoblog-css-post-meta-label-data">
					<?php
					if ($post_label_none != 1) {
						?>
						<div class="badoblog-css-post-meta-label">
							<?php esc_html_e('Created', 'bado-blog'); ?>
						</div>
						<?php
					}
					?>
					<div class="badoblog-css-post-meta-data">
						<?php
						// Functional - Record creation date
						$post_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
						if (get_the_time('U') !== get_the_modified_time('U')) {
							$post_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
						}
						$post_time_string = sprintf($post_time_string,
							esc_attr(get_the_date('c')),
							esc_html(get_the_date()),
							esc_attr(get_the_modified_date('c')),
							esc_html(get_the_modified_date())
						);
						// Display - Creation date
						echo sprintf(
							esc_html_x('%s', 'post date', 'bado-blog'),
							$post_time_string
						);
						?>
					</div>
				</div>
			</div>
			<?php
		}

		// Record update date
		if (esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_update', 0)) == 1) {
			?>
			<div class="badoblog-css-post-meta-box" data-info="<?php esc_attr_e('Post update date', 'bado-blog'); ?>">
				<div class="icon-spinner-post-meta"></div>
				<div class="badoblog-css-post-meta-label-data">
					<?php
					if ($post_label_none != 1) {
						?>
						<div class="badoblog-css-post-meta-label">
							<?php esc_html_e('Updated', 'bado-blog'); ?>
						</div>
						<?php
					}
					?>
					<div class="badoblog-css-post-meta-data">
						<?php
						// Functional - Record update date
						$time_post_up = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
						if (get_the_modified_time('U') !== get_the_time('U')) {
							$time_post_up = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
						}
						$time_post_up = sprintf($time_post_up,
							esc_attr(get_the_modified_date('c')),
							esc_html(get_the_modified_date()),
							esc_attr(get_the_date('c')),
							esc_html(get_the_date())
						);
						// Display - Record update date
						echo sprintf(
							esc_html_x('%s', 'post date', 'bado-blog'),
							$time_post_up
						);
						?>
					</div>
				</div>
			</div>
			<?php
		}

		// Number of comments on a post
		if (esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_comment', 1)) == 1) {
			if (! post_password_required() && (comments_open() || get_comments_number())) {
				?>
				<div class="badoblog-css-post-meta-box" data-info="<?php esc_attr_e('Number of comments on a post', 'bado-blog'); ?>">
					<div class="icon-bubble-post-meta"></div>
					<div class="badoblog-css-post-meta-label-data">
						<?php 
						if ($post_label_none != 1) {
							?>
							<div class="badoblog-css-post-meta-label">
								<?php esc_html_e('Comments', 'bado-blog'); ?>
							</div>
							<?php 
						}
						?>
						<div class="badoblog-css-post-meta-data">
							<?php comments_popup_link('0', '1', '%'); ?>
						</div>
					</div>
				</div>
				<?php 
			}
		}

		// Record reading time
		if (esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_time', 1)) == 1) {
			?>
			<div class="badoblog-css-post-meta-box" data-info="<?php esc_attr_e('Post reading time', 'bado-blog'); ?>">
				<div class="icon-clock-post-meta"></div>
				<div class="badoblog-css-post-meta-label-data">
					<?php
					if ($post_label_none != 1) {
						?>
						<div class="badoblog-css-post-meta-label">
							<?php esc_html_e('Reading time', 'bado-blog'); ?>
						</div>
						<?php
					}
					?>
					<div class="badoblog-css-post-meta-data">
						<?php echo badoblog_fun_post_time_words(); ?>
					</div>
				</div>
			</div>
			<?php 
		}

		// Number of post views
		if (esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_view', 1)) == 1) {
			?>
			<div class="badoblog-css-post-meta-box" data-info="<?php esc_attr_e('Number of post views', 'bado-blog'); ?>">
				<div class="icon-eye-post-meta"></div>
				<div class="badoblog-css-post-meta-label-data">
					<?php
					if ($post_label_none != 1) {
						?>
						<div class="badoblog-css-post-meta-label">
							<?php esc_html_e('Views', 'bado-blog'); ?>
						</div>
						<?php
					}
					?>
					<div class="badoblog-css-post-meta-data">
						<?php echo dmcwzmulti_fun_get_views(get_the_ID()); ?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}

// Date post for footer
function badoblog_fun_post_meta_footer_date() {
	$post_label_none = esc_attr(get_theme_mod('badoblog_cus_post_meta_boxs_label', 0));
	?>
	<div class="badoblog-css-post-footer-date-conteiner">
		<span class="badoblog-css-post-footer-date-span">
			<div class="badoblog-css-post-footer-date-box">
				<?php
				if ($post_label_none != 1) {
					?>
					<span class="badoblog-css-post-footer-date-label">
						<?php esc_html_e('Publication date', 'bado-blog'); ?>
					</span>
					<?php 
				}
				?>
				<span class="badoblog-css-post-footer-date-out">
					<?php 
					printf('<time class="entry-date published" datetime="%s">%s</time>', get_the_date('c'), get_the_time(get_option('date_format')));
					?>
				</span>
			</div>
		</span>
	</div>
	<?php
}
// end Meta boxs


// Categories (in post)
function badoblog_fun_post_meta_tax_cat() {

	$post_list_cat = get_the_category();

	if ($post_list_cat && badoblog_fun_categorized_blog()) {

		// Check Yoast SEO and change the order of links (only if main category is selected)
		if (class_exists('WPSEO_Primary_Term')) {
			$primary_term = new WPSEO_Primary_Term('category', get_the_ID());
			$primary_cat_id = !is_wp_error($primary_term->get_primary_term()) ? $primary_term->get_primary_term() : false;
			if ($primary_cat_id) {
				foreach ($post_list_cat as $key => $category) {
					if ($category->term_id == $primary_cat_id ) {
						$primary_cat = $category;
						unset($post_list_cat[$key] );
						array_unshift($post_list_cat, $primary_cat );
						break;
					}
				}
			}
		}

		// Limit the quantity
		$limit_cat = get_theme_mod('badoblog_cus_post_meta_cat_item', 3);
		$post_list_cat = array_slice($post_list_cat, 0, $limit_cat );

		// Label
		$post_label_cat = '';
		$post_label_css = '';
		if (get_theme_mod('badoblog_cus_post_meta_cat_label', 1) != 1) {
			$post_label_cat = '<div class="badoblog-css-post-meta-tax-label">' . esc_html__('Categories', 'bado-blog') . '</div>';
			$post_label_css = ' label-taxonomy';
		}

		// Create links
		$limit_cat_array = array_map(function($category) {
			return sprintf(
				'<a href="%s" rel="category tag">%s</a>',
				esc_url(get_category_link($category->term_id)),
				esc_html($category->name)
			);
		}, $post_list_cat);

		// Output
		echo '<div class="badoblog-css-post-meta-box-taxonomy badoblog-css-post-tax-cat'.esc_attr($post_label_css).'">'.
			'<div class="badoblog-css-post-meta-data-tax">' . 
				$post_label_cat . ' '.
				'<div class="badoblog-css-post-meta-data-tax-ul">'.
					implode($limit_cat_array).
				'</div>'.
			'</div>'.
		'</div>';

	}

}

// Tags (in post)
function badoblog_fun_post_meta_tax_tag() {
	$post_list_tag = get_the_tag_list('','d1y2w3');
	if (!empty($post_list_tag)) {
		$limit_tag = get_theme_mod('badoblog_cus_post_meta_tag_item', 5);
		$tag_array = explode('d1y2w3', $post_list_tag);
		$limit_tag_array = array_slice($tag_array, 0, $limit_tag);
		$post_label_tag = '';
		$post_label_css = '';
		if (get_theme_mod('badoblog_cus_post_meta_tag_label', 1) != 1) {
			$post_label_tag = '<div class="badoblog-css-post-meta-tax-label">' . esc_html__('Tags', 'bado-blog') . '</div>';
			$post_label_css = ' label-taxonomy';
		}
		echo '<div class="badoblog-css-post-meta-box-taxonomy badoblog-css-post-tax-tag'.esc_attr($post_label_css).'">'.
			'<div class="badoblog-css-post-meta-data-tax">'. 
				$post_label_tag . ' ' .
				'<div class="badoblog-css-post-meta-data-tax-ul">'.
					implode($limit_tag_array).
				'</div>'.
			'</div>'.
		'</div>';
	}
}

// Tags and Categories - output
function badoblog_fun_post_meta_tax($lay) {
	if (get_theme_mod('badoblog_cus_post_meta_cat', 1) == 1) {
		$lay_cat = get_theme_mod('badoblog_cus_post_meta_cat_lay', 'thumb-bottom');
		if ($lay_cat == 'thumb-bottom' || $lay_cat == 'thumb-top') {
			$lay_cat = 'thumb';
		}
		if ($lay == $lay_cat) {
			badoblog_fun_post_meta_tax_cat();
			if ($lay_cat == 'thumb') {
				wp_enqueue_script('badoblog-script-meta-tax-post');
			}
		}
	}
	if (get_theme_mod('badoblog_cus_post_meta_tag', 1) == 1) {
		$lay_tag = get_theme_mod('badoblog_cus_post_meta_tag_lay', 'bottom');
		if ($lay == $lay_tag) {
			badoblog_fun_post_meta_tax_tag();
		}
	}
}



/*---------------------------------------------------------------------------------------------------------------------------
//region Data processing
---------------------------------------------------------------------------------------------------------------------------*/
	
// Data processing
function badoblog_fun_categorized_blog() {
	if (false === ($trans_cat = get_transient('badoblog_transient_categories'))) {
		$trans_cat = get_categories(array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			'number'     => 2,
		));
		$trans_cat = count($trans_cat);
		set_transient('badoblog_transient_categories', $trans_cat);
	}
	if ($trans_cat > 1) {
		return true;
	} else {
		return false;
	}
}

function badoblog_fun_tag_cat_transient() {
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	delete_transient('badoblog_transient_categories');
}
add_action('edit_category', 'badoblog_fun_tag_cat_transient');
add_action('save_post', 'badoblog_fun_tag_cat_transient');