/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Woo
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function($) {

    'use strict';

    // Add a class to everything except empty fields
    $('.badoblog-css-widget-area .widget_block').each(function() {
        if ($(this).text().trim() != '') {
            $(this).addClass('widget-block-box');
        }
    });

    // Adding a class for filters
    $('.wc-blocks-filter-wrapper:not([hidden])').closest('.badoblog-css-widget-area .widget_block').addClass('widget-block-box');

    // Del a class for filters
    $('.wc-blocks-filter-wrapper[hidden]').closest('.badoblog-css-widget-area .widget_block').removeClass('widget-block-box');

    // Add a class for the rest
    let n1 = document.querySelectorAll('.badoblog-css-widget-area .widget_block figure, \
    .badoblog-css-widget-area .widget_block img');
    $(n1).closest('.badoblog-css-widget-area .widget_block').addClass('widget-block-box');


    // Repeat for filters
    const filtersInterval = setInterval(badoblog_fun_js_woo_filters, 2000);
    setTimeout(filtersStopFunction, 15000);
    function filtersStopFunction() {
        clearInterval(filtersInterval);
    }
    function badoblog_fun_js_woo_filters() {

        $('.wc-blocks-filter-wrapper[hidden]').closest('.badoblog-css-widget-area .widget_block').removeClass('widget-block-box');

        let n2 = document.querySelectorAll('.badoblog-css-widget-area .widget_block .wc-block-review-list');
        $(n2).closest('.badoblog-css-widget-area .widget_block').addClass('widget-block-box');
        
    }

});