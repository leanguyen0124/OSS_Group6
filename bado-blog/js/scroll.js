/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Up button
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function($) {

    'use strict';
 
    $(window).scroll(function() {
        if ($(this).scrollTop() > 800) {
        $('.badoblog-css-scrollup').fadeIn();
        } else {
        $('.badoblog-css-scrollup').fadeOut();
        }
    });
    
    $('.badoblog-css-scrollup').click(function() {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });

});