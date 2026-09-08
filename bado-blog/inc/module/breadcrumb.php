<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Breadcrumbs
* ------------------------------------------------------------------------------ */


function badoblog_fun_breadcrumbs() {
	// Text for "Home" link
	$home = get_theme_mod('badoblog_cus_bread_main_text', esc_html__('Home', 'bado-blog'));
	// Breadcrumb header for posts
	$h_post = get_theme_mod('badoblog_cus_bread_h_post', 1);
	// Breadcrumb header for categories, archives and tags
	$h_cat = get_theme_mod('badoblog_cus_bread_h_cat', 1);
	// Link to home
	$home_link = esc_url(home_url());
	global $post;

	// Separator between breadcrumbs
	$bc_sep = '';
	switch (get_theme_mod('badoblog_cus_bread_separator', 'v3')) {
		// Triangle
		case 'v1':
			$bc_sep = '&#9655;';
		break;
		// Arrowhead
		case 'v2':
			$bc_sep = '&#10148;';
		break;
		// Brace
		case 'v3':
			$bc_sep = '&#10095;';
		break;
		// Volumetric arrow
		case 'v4':
			$bc_sep = '&#10159;';
		break;
		// Linear arrow
		case 'v5':
			$bc_sep = '&#10140;';
		break;
	}
	
	// Separator between breadcrumbs (with spaces)
	$sep = "&nbsp; $bc_sep &nbsp;";
	$sep = wp_kses_post($sep);

	// Link to home
	if (get_theme_mod('badoblog_cus_bread_main', 1) == 1) {
    	echo '<a href="' . esc_url($home_link) . '">' . esc_html($home) . '</a>' . $sep;
	}

	// Categories and archives
    if (is_category()) {
		$this_cat = get_category(get_query_var('cat'), false);
		if ($this_cat->parent != 0) {
			$cats = get_category_parents($this_cat->parent, true, $sep);
			if (!is_wp_error($cats)) {
				echo wp_kses_post($cats);
			}
		}
		if ($h_cat == 1) {
			echo '<span>' . esc_html(single_cat_title('', false)) . '</span>';
		}
	} else if (is_day()) {
		echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . $sep;
		echo '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . esc_html(get_the_time('F')) . '</a> '. $sep;
		if ($h_cat == 1) {
			echo '<span>' . esc_html(get_the_time('d')) . '</span>';
		}
	} else if (is_month()) {
		echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a> ' . $sep;
		if ($h_cat == 1) {
			echo '<span>' . esc_html(get_the_time('F')) . '</span>';
		}
	} else if (is_year()) {
		if ($h_cat == 1) {
			echo '<span>' . esc_html(get_the_time('Y')) . '</span>';
		}
	}

	// Posts but not attachments
	else if (is_single() && !is_attachment()) {
		if (get_post_type() != 'post') {
			$post_typ = get_post_type_object(get_post_type());
			$slug = $post_typ->rewrite;
			echo '<a href="' . esc_url($home_link) . '/' . $slug['slug'] . '/">' . $post_typ->labels->singular_name . '</a>';
			if ($h_post == 1) {
				echo wp_kses_post($sep) . '<span>' . wp_kses_post(get_the_title()) . '</span>';
			}
		} else {
			$cat = get_the_category();
			if (!empty($cat)) {
				if (class_exists('WPSEO_Primary_Term')) {
					$primary_term = new WPSEO_Primary_Term('category', get_the_ID());
					$primary_cat = $primary_term->get_primary_term();
					if ($primary_cat) {
						$cat = get_category($primary_cat);
					} else {
						$cat = $cat[0];
					}
				} else {
					$cat = $cat[0];
				}
				$cats = get_category_parents($cat, true, $sep);
				if (!is_wp_error($cats)) {
					if ($h_post != 1) {
						$cats = preg_replace("#^(.+)\s\s$#", "$1", $cats);
					}
					echo wp_kses_post($cats);
				}
			}
			if ($h_post == 1) {
				echo '<span>' . esc_html(get_the_title()) . '</span>';
			}
		}
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
		$post_typ = get_post_type_object(get_post_type());
		echo '<span>' . $post_typ->labels->singular_name . '</span>';
	}

	// Attachments
	elseif (is_attachment()) {
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); 
		if(!empty($cat)) {
			$cat = $cat[0];
			$cats = get_category_parents($cat, true, $sep);
			if (!is_wp_error($cats)) {
				echo wp_kses_post($cats);
			}
		}
		echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>';
		if ($h_post == 1) {
			echo '<span>' . esc_html(get_the_title()) . '</span>';
		}
    }
	
	// Pages
	else if (is_page() && !$post->post_parent) {
		if ($h_post == 1) {
			echo '<span>' . esc_html(get_the_title()) . '</span>';
		}
	} else if (is_page() && $post->post_parent) {
		$p_id  = $post->post_parent;
		$bs = array();
		while ($p_id) {
			$page = get_page($p_id);
			$bs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>' . $sep;
			$p_id  = $page->post_parent;
		}
		$bs = array_reverse($bs);
		for ($i = 0; $i < count($bs); $i++) {
			echo wp_kses_post($bs[$i]);
			if ($i != count($bs)-1) {
				echo wp_kses_post($sep);
			}
		}
		if ($h_post == 1) {
			echo '<span>' . esc_html(get_the_title()) . '</span>';
		}
    }

	// Tags
	else if (is_tag()) {
		if ($h_cat == 1) {
			echo '<span>' . esc_html(single_tag_title('', false)) . '</span>';
		}
	}
	
	// Authors
	else if (is_author()) {
		global $author;
		$user_d = get_userdata($author);
		if ($h_cat == 1) {
			echo '<span>' . esc_html__('Posted by ', 'bado-blog').'' . $user_d->display_name . '</span>';
		}
	}
	
	// 404
	else if (is_404()) {
		echo '<span>' . esc_html__('Error', 'bado-blog'). '404 </span>';
    }
	
    if (get_query_var('paged')) {
		if (is_category() || is_tag() || is_search() || is_day() || is_month() || is_year() || is_author()) {
			echo ' (' . esc_html__('Page', 'bado-blog') . ' ' . esc_html(get_query_var('paged')). ')';
		}
    }

}
badoblog_fun_breadcrumbs();
?>