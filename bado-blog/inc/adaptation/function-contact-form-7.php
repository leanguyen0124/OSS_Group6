<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Functions for Contact Form 7
* ------------------------------------------------------------------------------ */


//? ========== Support for Contact Form 7 Styles
function badoblog_fun_set_css_form7() {

  // General text color
  $t_color = esc_attr(get_theme_mod('badoblog_cus_colors_text_content', '#404040'));

	//---------- Clear
	$css = '';

  //?---------- Change placeholder color
  if ($t_color != '#404040') {
    $css .= '
      .wpcf7-form input::placeholder,
      .wpcf7-form textarea::placeholder {
        color: '.$t_color.';
        opacity: 0.5;
      }
    ';
  }

	if (!empty($css)) {
		wp_add_inline_style('badoblog-style-contact-form-7', $css);
	}

}

add_action('wp_enqueue_scripts', 'badoblog_fun_set_css_form7', 1);

