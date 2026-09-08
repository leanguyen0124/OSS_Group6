<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Jetpack Compatibility File
* ------------------------------------------------------------------------------ */


function badoblog_fun_jetpack_setup() {

	// Add theme support for Infinite Scroll
	add_theme_support('infinite-scroll', array(
		'container' => 'badoblog-id-cat-box',
		'render'    => 'badoblog_fun_infinite_scroll',
		'footer'    => 'page',
		'wrapper' => false
	));

	// Add theme support for Responsive Videos
	add_theme_support('jetpack-responsive-videos');

}
add_action('after_setup_theme', 'badoblog_fun_jetpack_setup');

// Custom render function for Infinite Scroll
function badoblog_fun_infinite_scroll() {
	// Post cards
	badoblog_fun_content_archive();
}

// Support Infinite Scroll
// https://jetpack.com/support/infinite-scroll/
