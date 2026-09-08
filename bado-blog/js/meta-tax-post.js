/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Meta tax for post
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function ($) {

    'use strict';

    let post_img = $('.badoblog-css-post-thumbnail img');
    let post_tax = $('.badoblog-css-post-thumbnail .badoblog-css-post-meta-box-taxonomy');
    let post_head = $('.badoblog-css-mod-pp-header');

    if (post_img.length && post_tax.length && post_head.length) {

        let h_img = post_img.outerHeight(true) * 0.9; // We limit it to 90%
        let w_img = post_img.outerWidth(true);

        let post_h_tax = post_tax.outerHeight(true);
        let post_w_tax = post_tax.outerWidth(true);

        // Check block overflow
        if (post_h_tax > h_img || post_w_tax > w_img) {

            // Canseled position-absolute and Move block in post header
            // post_tax.css({ position: 'static' });
            // post_head.append(post_tax);
            post_tax.css('position', 'static').appendTo(post_head);

        }

    }

});