/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Customizer panel
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function($) {

	'use strict';

	//? ---------- Hiding minor settings when deactivating the main setting (fluently)

	// Ticker in top bar
	wp.customize('badoblog_cus_ticker', function(control) {
	    control.bind(function(set) {
		  	if (set == 'off') {
				$('[id^="customize-control-badoblog_cus_ticker_"], \
				[id^="customize-control-badoblog_cus_date"]').hide(200);
			} else if (set == 'date') {
				$('[id^="customize-control-badoblog_cus_date"], \
				#customize-control-badoblog_cus_ticker_width, \
				#customize-control-badoblog_cus_ticker_color, \
				#customize-control-badoblog_cus_ticker_size, \
				#customize-control-badoblog_cus_ticker_up').show(150);
				$('[id^="customize-control-badoblog_cus_ticker_cat"], \
				[id^="customize-control-badoblog_cus_ticker_custom_"], \
				#customize-control-badoblog_cus_ticker_var, \
				#customize-control-badoblog_cus_ticker_speed, \
				#customize-control-badoblog_cus_ticker_infinite').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_ticker_"]').show(150);
				$('[id^="customize-control-badoblog_cus_date"]').hide(200);
				wp.customize('badoblog_cus_ticker_var', function(setting) {
					var set_chield = setting.get();
					if (set_chield == 1) {
						$('[id^="customize-control-badoblog_cus_ticker_custom_"]').hide(200);
					} else {
						$('[id^="customize-control-badoblog_cus_ticker_cat"]').hide(200);
					}
				});
			}
	    });
	});

	// Where to get the date
	wp.customize('badoblog_cus_date', function(control) {
		control.bind(function(set) {
			if (set == 2) {
				$('[id^="customize-control-badoblog_cus_date_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_date_"]').show(150);
			}
		});
	});

	// Ticker display option
	wp.customize('badoblog_cus_ticker_var', function(control) {
		control.bind(function(set) {
			if (set == 1) {
				$('[id^="customize-control-badoblog_cus_ticker_cat"]').show(150);
				$('[id^="customize-control-badoblog_cus_ticker_custom_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_ticker_custom_"]').show(150);
				$('[id^="customize-control-badoblog_cus_ticker_cat"]').hide(200);
			}
		});
	});

	// Top menu settings
	wp.customize('badoblog_cus_top_menu', function(control) {
	    control.bind(function(set) {
		  	if (set == 1) {
				$('[id^="customize-control-badoblog_cus_top_menu_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_top_menu_"]').show(150);
			}
	    });
	});

	// Logo option settings
	wp.customize('badoblog_cus_title_tagline_logo_var', function(control) {
	    control.bind(function(set) {
		  	if (set == 'fix') {
				$('#customize-control-custom_logo').show(150);
				$('#customize-control-badoblog_cus_supple_logo').hide(200);
			} else {
				$('#customize-control-badoblog_cus_supple_logo').show(150);
				$('#customize-control-custom_logo').hide(200);
			}
	    });
	});

	// Top banner
	wp.customize('badoblog_cus_banner', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_banner_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_banner_"]').show(150);
			}
	    });
	});

	// Social Links
	wp.customize('badoblog_cus_soc', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_soc_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_soc_"]').show(150);
			}
	    });
	});

	// Social link form
	wp.customize('badoblog_cus_soc_form', function(control) {
	    control.bind(function(set) {
		  	if (set == 'without-background') {
				$('#customize-control-badoblog_cus_soc_design_no_back').show(150);
				$('#customize-control-badoblog_cus_soc_design_back').hide(200);
			} else {
				$('#customize-control-badoblog_cus_soc_design_back').show(150);
				$('#customize-control-badoblog_cus_soc_design_no_back').hide(200);
			}
	    });
	});

	// Search
	wp.customize('badoblog_cus_search', function(control) {
	    control.bind(function(set) {
		  	if (set == 'off') {
				$('[id^="customize-control-badoblog_cus_search_"]').hide(200);
			} else if (set == 'top-bar') {
				$('#customize-control-badoblog_cus_search_size').show(150);
				$('#customize-control-badoblog_cus_search_soc').hide(200);
			} else {
				$('#customize-control-badoblog_cus_search_soc').show(150);
				wp.customize('badoblog_cus_search_soc', function(setting) {
					var set_chield = setting.get();
					var soc = wp.customize('badoblog_cus_soc').get();
					if (set_chield == 1 && soc == 1) {
						$('#customize-control-badoblog_cus_search_size').hide(200);
					} else {
						$('#customize-control-badoblog_cus_search_size').show(150);
					}
				});
			}
	    });
	});
	wp.customize('badoblog_cus_search_soc', function(control) {
		control.bind(function(set) {
			var soc = wp.customize('badoblog_cus_soc').get();
			if (set == 1 && soc == 1) {
				$('#customize-control-badoblog_cus_search_size').hide(200);
			} else {
				$('#customize-control-badoblog_cus_search_size').show(150);
			}
		});
	});

	// Main menu settings
	wp.customize('badoblog_cus_main_menu', function(control) {
	    control.bind(function(set) {
		  	if (set == 1) {
				$('[id^="customize-control-badoblog_cus_main_menu_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_main_menu_"]').show(150);
			}
	    });
	});

	// XL Mega menu settings
	wp.customize('badoblog_cus_xlmega_on', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_xlmega_set"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_xlmega_set"]').show(150);
			}
	    });
	});

	// Category menu
	wp.customize('badoblog_cus_menucat', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_menucat_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_menucat_"]').show(150);
			}
	    });
	});

	// "Read more" button in categories
	wp.customize('badoblog_cus_cat_style_more', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_cat_style_more_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_cat_style_more_"]').show(150);
			}
	    });
	});

	// Meta tags (meta boxs)
	wp.customize('badoblog_cus_cat_meta_boxs', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_cat_meta_boxs_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_cat_meta_boxs_"]').show(150);
			}
	    });
	});

	// Meta tags (categories)
	wp.customize('badoblog_cus_cat_meta_cat', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_cat_meta_cat_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_cat_meta_cat_"]').show(150);
				wp.customize('badoblog_cus_cat_meta_cat_layout', function(setting) {
					var set_chield = setting.get();
					if (set_chield != 'header') {
						$('[id^="customize-control-badoblog_cus_cat_meta_cat_item"]').hide(200);
					} else {
						$('[id^="customize-control-badoblog_cus_cat_meta_cat_item"]').show(150);
					}
				});
			}
	    });
	});
	wp.customize('badoblog_cus_cat_meta_cat_layout', function(control) {
		control.bind(function(set) {
			if (set != 'header') {
				$('[id^="customize-control-badoblog_cus_cat_meta_cat_item"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_cat_meta_cat_item"]').show(150);
			}
		});
	});

	// Meta tags (tag)
	wp.customize('badoblog_cus_cat_meta_tag', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_cat_meta_tag_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_cat_meta_tag_"]').show(150);
			}
	    });
	});

	// Remove the main (top) image in posts
	wp.customize('badoblog_cus_post_img_top_post', function(control) {
		control.bind(function(set) {
			if (set == 1) {
				$('#customize-control-badoblog_cus_post_img_top_post_size').hide(200);
			} else {
				$('#customize-control-badoblog_cus_post_img_top_post_size').show(150);
			}
		});
	});
	
	// Remove the main (top) image in pages
	wp.customize('badoblog_cus_post_img_top_page', function(control) {
		control.bind(function(set) {
			if (set == 1) {
				$('#customize-control-badoblog_cus_post_img_top_page_size').hide(200);
			} else {
				$('#customize-control-badoblog_cus_post_img_top_page_size').show(150);
			}
		});
	});

	// Meta tags in posts (meta boxs)
	wp.customize('badoblog_cus_post_meta_boxs', function(control) {
	    control.bind(function(conVal) {
		  	if (conVal == 0) {
				$('[id^="customize-control-badoblog_cus_post_meta_boxs_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_meta_boxs_"]').show(150);
			}
	    });
	});

	// Meta tags in posts (cat)
	wp.customize('badoblog_cus_post_meta_cat', function(control) {
	    control.bind(function(conVal) {
		  	if (conVal == 0) {
				$('[id^="customize-control-badoblog_cus_post_meta_cat_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_meta_cat_"]').show(150);
			}
	    });
	});

	// Meta tags in posts (tag)
	wp.customize('badoblog_cus_post_meta_tag', function(control) {
	    control.bind(function(conVal) {
		  	if (conVal == 0) {
				$('[id^="customize-control-badoblog_cus_post_meta_tag_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_meta_tag_"]').show(150);
			}
	    });
	});

	// Bulleted Lists
	wp.customize('badoblog_cus_post_li_mark', function(control) {
		control.bind(function(set) {
			if (set == 'v0') {
				$('#customize-control-badoblog_cus_post_li_mark_color').hide(200);
			} else {
				$('#customize-control-badoblog_cus_post_li_mark_color').show(150);
			}
		});
	});

	// Numbered Lists
	wp.customize('badoblog_cus_post_li_num', function(control) {
		control.bind(function(set) {
			if (set == 'v0') {
				$('[id^="customize-control-badoblog_cus_post_li_num_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_li_num_"]').show(150);
			}
		});
	});

	// Quote Blocks
	wp.customize('badoblog_cus_post_quote', function(control) {
	    control.bind(function(set) {
		  	if (set == 'v0') {
				$('[id^="customize-control-badoblog_cus_post_quote_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_quote_"]').show(150);
			}
	    });
	});

	// Icon for block quotes
	wp.customize('badoblog_cus_post_quote_icon', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_post_quote_icon_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_quote_icon_"]').show(150);
			}
	    });
	});

	// Titles H2
	wp.customize('badoblog_cus_post_h2', function(control) {
	    control.bind(function(set) {
		  	if (set == 'off') {
				$('[id^="customize-control-badoblog_cus_post_h2_"]').hide(200);
			} else if (set == 'v1' || set == 'v2') {
				$('[id^="customize-control-badoblog_cus_post_h2_"]').show(150);
				$('#customize-control-badoblog_cus_post_h2_icon_select, \
				#customize-control-badoblog_cus_post_h2_count_text, \
				#customize-control-badoblog_cus_post_h2_tag, \
				#customize-control-badoblog_cus_post_h2_icon_text_color').hide();
			} else if (set == 'v3') {
				$('[id^="customize-control-badoblog_cus_post_h2_"]').show(150);
				$('#customize-control-badoblog_cus_post_h2_icon_select, \
				#customize-control-badoblog_cus_post_h2_tag').hide();
			} else if (set == 'v4') {
				$('[id^="customize-control-badoblog_cus_post_h2_"]').show(150);
				$('#customize-control-badoblog_cus_post_h2_count_text, \
				#customize-control-badoblog_cus_post_h2_tag').hide();
			} else if (set == 'v5') {
				$('[id^="customize-control-badoblog_cus_post_h2_"]').show(150);
				$('#customize-control-badoblog_cus_post_h2_icon_select, \
				#customize-control-badoblog_cus_post_h2_count_text').hide();
			} else {
				$('[id^="customize-control-badoblog_cus_post_h2_"]').show(150);
				$('#customize-control-badoblog_cus_post_h2_icon_select, \
				#customize-control-badoblog_cus_post_h2_count_text, \
				#customize-control-badoblog_cus_post_h2_tag, \
				#customize-control-badoblog_cus_post_h2_icon_text_color, \
				#customize-control-badoblog_cus_post_h2_element_color').hide();
			}
	    });
	});

	// Titles H3 - H6
	wp.customize('badoblog_cus_post_h36', function(control) {
	    control.bind(function(set) {
		  	if (set == 'off') {
				$('[id^="customize-control-badoblog_cus_post_h36_"]').hide(200);
			} else if (set == 'v1' || set == 'v2') {
				$('[id^="customize-control-badoblog_cus_post_h36_"]').show(150);
				$('#customize-control-badoblog_cus_post_h36_icon_select, \
				#customize-control-badoblog_cus_post_h36_count_text, \
				#customize-control-badoblog_cus_post_h36_tag, \
				#customize-control-badoblog_cus_post_h36_icon_text_color').hide();
			} else if (set == 'v3') {
				$('[id^="customize-control-badoblog_cus_post_h36_"]').show(150);
				$('#customize-control-badoblog_cus_post_h36_icon_select, \
				#customize-control-badoblog_cus_post_h36_tag').hide();
			} else if (set == 'v4') {
				$('[id^="customize-control-badoblog_cus_post_h36_"]').show(150);
				$('#customize-control-badoblog_cus_post_h36_count_text, \
				#customize-control-badoblog_cus_post_h36_tag').hide();
			} else if (set == 'v5') {
				$('[id^="customize-control-badoblog_cus_post_h36_"]').show(150);
				$('#customize-control-badoblog_cus_post_h36_icon_select, \
				#customize-control-badoblog_cus_post_h36_count_text').hide();
			} else {
				$('[id^="customize-control-badoblog_cus_post_h36_"]').show(150);
				$('#customize-control-badoblog_cus_post_h36_icon_select, \
				#customize-control-badoblog_cus_post_h36_count_text, \
				#customize-control-badoblog_cus_post_h36_tag, \
				#customize-control-badoblog_cus_post_h36_icon_text_color, \
				#customize-control-badoblog_cus_post_h36_element_color').hide();
			}
	    });
	});

	// Author block
	wp.customize('badoblog_cus_post_bio', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id*="_cus_post_bio_"]').hide(200);
			} else {
				$('[id*="_cus_post_bio_"]').show(150);
			}
	    });
	});

	// Author block separator variation
	wp.customize('badoblog_cus_post_bio_design', function(control) {
	    control.bind(function(set) {
		  	if (set == 'v0' || set == 'v1' || set == 'v2') {
				$('[id^="customize-control-badoblog_cus_post_bio_design_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_bio_design_"]').show(150);
			}
	    });
	});

	// Author's latest posts in the author's block
	wp.customize('badoblog_cus_post_bio_related', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_post_bio_related_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_bio_related_"]').show(150);
			}
	    });
	});

	// Next post
	wp.customize('badoblog_cus_post_next', function(control) {
	    control.bind(function(set) {
		  	if (set == 1) {
				$('[id^="customize-control-badoblog_cus_post_next_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_next_"]').show(150);
			}
	    });
	});

	// Similar posts
	wp.customize('badoblog_cus_post_related', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_post_related_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_post_related_"]').show(150);
			}
	    });
	});

	

	// Enable Recent Posts Section on Homepage
	wp.customize('badoblog_cus_home_article_block', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_home_article_block_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_home_article_block_"]').show(150);
			}
	    });
	});

	

	// Activate Link "Home" in bread crumbs
	wp.customize('badoblog_cus_bread_main', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('#customize-control-badoblog_cus_bread_main_text').hide(200);
			} else {
				$('#customize-control-badoblog_cus_bread_main_text').show(150);
			}
	    });
	});

	// Fluently movement of blocks
	wp.customize('badoblog_cus_flow_block', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_flow_block_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_flow_block_"]').show(150);
			}
	    });
	});

	// Categories on the site map
	wp.customize('badoblog_cus_sitemap_cat', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_sitemap_cat_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_sitemap_cat_"]').show(150);
			}
	    });
	});

	// Posts on the site map
	wp.customize('badoblog_cus_sitemap_post', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_sitemap_post_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_sitemap_post_"]').show(150);
			}
	    });
	});

	// Pages on the site map
	wp.customize('badoblog_cus_sitemap_page', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_sitemap_page_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_sitemap_page_"]').show(150);
			}
	    });
	});

	// Up button
	wp.customize('badoblog_cus_top_scroll', function(control) {
	    control.bind(function(set) {
		  	if (set == 1) {
				$('[id^="customize-control-badoblog_cus_top_scroll_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_top_scroll_"]').show(150);
			}
	    });
	});

	

	// Underline titles of all classic widgets (column)
	wp.customize('badoblog_cus_sidebar_h_border', function(control) {
	    control.bind(function(set) {
		  	if (set == 'v0') {
				$('#customize-control-badoblog_cus_sidebar_h_border_size').hide(200);
			} else {
				$('#customize-control-badoblog_cus_sidebar_h_border_size').show(150);
			}
	    });
	});

	// Underline titles of all classic widgets (footer)
	wp.customize('badoblog_cus_footer_widget_h_border', function(control) {
	    control.bind(function(set) {
		  	if (set == 'v0') {
				$('#customize-control-badoblog_cus_footer_widget_h_border_size').hide(200);
			} else {
				$('#customize-control-badoblog_cus_footer_widget_h_border_size').show(150);
			}
	    });
	});

	

	// Bottom part
	wp.customize('badoblog_cus_footer', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_footer_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_footer_"]').show(150);
			}
	    });
	});

	// Lower menu
	wp.customize('badoblog_cus_footer_menu', function(control) {
	    control.bind(function(set) {
		  	if (set == 0) {
				$('[id^="customize-control-badoblog_cus_footer_menu_"]').hide(200);
			} else {
				$('[id^="customize-control-badoblog_cus_footer_menu_"]').show(150);
			}
	    });
	});

	

});
