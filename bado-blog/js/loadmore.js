/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Post loading in categories (Button - Show more)
* ------------------------------------------------------------------------------ */

jQuery(function($) {

    'use strict';

    function badoblogFunAjaxLoadMore($lay) {
        // Caption while loading
        $('#badoblog-id-loadmore-button'+$lay).text(badoblog_localize_loadmore.delay);
        var data = {
            'action': 'badoblog-action-loadmore'+$lay,
            'query': true_posts,
            'page': current_page
        };
        $.ajax({
            url: ajaxurl,
            data: data,
            type: 'POST',
            success: function (data) {
                if (data) {
                    
                    $('#badoblog-id-loadmore').before(data);
                    
                    // Return inscription, after loading
					$('#badoblog-id-loadmore-button'+$lay).text(badoblog_localize_loadmore.more);
                    current_page++;
                    
                    if (current_page == max_pages) $(".badoblog-css-loadmore").remove();

                    // Support for fluently blocks
                    $('.badoblog-css-cat-grid').each(function() {
                        $(this).css({
                            'opacity':'1',
                            'transform':'translateY(0)'
                        });
                    });

                } else {
                    $('.badoblog-css-loadmore').remove();
                }
            }
        });
    }

    $('#badoblog-id-loadmore-button').click(function() {
        badoblogFunAjaxLoadMore('');
    });

    // A separate script for the HOME-PAGE is required. There is no way to check the home page when the ajax content is already defined.
    $('#badoblog-id-loadmore-button-home').click(function() {
        badoblogFunAjaxLoadMore('-home');
    });

});