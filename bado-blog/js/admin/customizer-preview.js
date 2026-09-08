/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Functions for Preview - Customizer
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function($) {
	
	'use strict';

	// Site name and description
	wp.customize('blogname', function(value) {
		value.bind(function(to) {
			$('.badoblog-css-site-title').text(to);
		});
	});
	wp.customize('blogdescription', function(value) {
		value.bind(function(to) {
			$('.badoblog-css-site-description').text(to);
		});
	});
	
	// Hiding and changing the color of the header and description
	wp.customize('header_textcolor', function(value) {
		value.bind(function(to) {
			if ('blank' === to) {
				$('.badoblog-css-site-title, .badoblog-css-site-description').css({
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				});
			} else {
				$('.badoblog-css-site-title, .badoblog-css-site-description').css({
					'clip': 'auto',
					'position': 'relative'
				});
				$('.clear-title-box').css({
					'margin-top': '20px',
					'margin-left': '10px'
				});
				$('.badoblog-css-site-title, .badoblog-css-site-description').css({
					'color': to
				});
			}
		});
	});

	// Remove top menu area
	wp.customize('badoblog_cus_top_menu', function(value) {
		value.bind(function(to) {
			if (to == 1) {
				$('.badoblog-css-top-menu').css({
					'display': 'none'
				});
			} else {
				$('.badoblog-css-top-menu').css({
					'display': 'flex'
				});
			}
		});
	});

	// Remove main menu area
	wp.customize('badoblog_cus_main_menu', function(control) {
	    control.bind(function(controlValue) {
		  	if (controlValue == 1) {
				$('.badoblog-css-mega-menu-box').css({
					'display': 'none'
				});
			} else {
				$('.badoblog-css-mega-menu-box').css({
					'display': 'block'
				});
			}
	    });
	});

	// Remove Mega menu (graphic) items
	wp.customize('badoblog_cus_xlmega_on', function(control) {
		control.bind(function(controlValue) {
			if (controlValue == 0) {
				$('.badoblog-css-xlmega-item').css({
					'display': 'none'
				});
			} else {
				$('.badoblog-css-xlmega-item').css({
					'display': 'list-item'
				});
			}
		});
	});

});


// -----------------  Adds an edit button to the preview area
wp.customize.selectiveRefresh.partialConstructor.badoblog_redact = (function(api, $) {
	'use strict';
	return api.selectiveRefresh.Partial.extend({
		refresh: function() {}
	});
})(wp.customize, jQuery);
