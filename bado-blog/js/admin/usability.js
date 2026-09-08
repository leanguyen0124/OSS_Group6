/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Settings plans
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function($) {

    'use strict';

    var attempts = 0;
    var maxAttempts = 100;

    var bbCheckPlans = setInterval(function() {
        attempts++;
        if ($('.fs-app-header').length) {

            var token = btoa(BADOBLOG_PUB_KEY_PLAN.pluginKey + '|' + BADOBLOG_PUB_KEY_PLAN.oneKey);

			// Content
            function badoBlogRenderInfo(data) {
                if (!data.show_info) return;

                var now = new Date();
                var expires = new Date(data.expires);

                if (now <= expires) {
                    var infoBar = `
                        <div class="badoblog-css-set-admin-plans">
                            <div class="badoblog-css-set-admin-plans-info">
                                ${data.text}
                            </div>
                        </div>
                    `;
                    $('.fs-app-header').append(infoBar);
                }
            }

            // JSON
            $.ajax({
                url: 'https://data.web-zone.org/info/plan.json.php',
                headers: {'X-DMCWZMULTI-Token': token},
                dataType: 'json'
            })
            .done(badoBlogRenderInfo)
            .fail(function() {
                $.ajax({
                    url: 'https://data.web-zone.org/info/plan-bado-blog.json.php',
                    headers: {'X-BADOBLOG-Token': token},
                    dataType: 'json',
                    success: badoBlogRenderInfo
                });
            });

            clearInterval(bbCheckPlans);
        }

        if (attempts >= maxAttempts) {
            clearInterval(bbCheckPlans);
        }

    }, 100);
    
});
