/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Customizable SELECT
* ------------------------------------------------------------------------------ */


jQuery(function($) {

	'use strict';
	
	// For categories widgets
	$(".widget.widget_categories select, \
	.widget.widget_archive select, \
	.wp-block-categories-dropdown select, \
	.wp-block-archives-dropdown select").chosen({
    	width: "100%",
		disable_search_threshold: 10,
		no_results_text: badoblog_localize_chosen.nonce_default,
  	});


	// Woo

	// Sorting in the product catalog
	$(".woocommerce-ordering select.orderby").chosen({
		width: "100%",
		disable_search_threshold: 15,
		no_results_text: badoblog_localize_chosen.nonce_woo_sort,
  	});

	// Other
	$(".wc-block-sort-select .wc-block-sort-select__select").chosen({
		width: "100%",
		disable_search_threshold: 15,
		no_results_text: badoblog_localize_chosen.nonce_default,
	});

});