/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Settings plans
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function($) {

    'use strict';

        if ($('.badoblog-css-set-admin-sidebar').length) {

            var token = btoa(BADOBLOG_PUB_KEY_SET.pluginKey + '|' + BADOBLOG_PUB_KEY_SET.oneKey);

			// Content
            function badoBlogRenderWarning(data) {

                if (!data.show_info) return;

                var infoBlock = `
                    <div class="badoblog-css-set-admin-warning">
                        <h2>
                            ${data.h2}
                        </h2>
                        <div class="badoblog-css-set-admin-warning-info">
                            ${data.text}
                        </div>
                    </div>
                `;
                $('.badoblog-css-set-admin-sidebar').prepend(infoBlock);
                
            }

            // JSON
            $.ajax({
                url: 'https://data.web-zone.org/info/warning.json.php',
                headers: {'X-DMCWZMULTI-Token': token},
                dataType: 'json'
            })
            .done(badoBlogRenderWarning)
            .fail(function() {
                $.ajax({
                    url: 'https://data.web-zone.org/info/warning-bado-blog.json.php',
                    headers: {'X-BADOBLOG-Token': token},
                    dataType: 'json',
                    success: badoBlogRenderWarning
                });
            });
            
        }
    
});