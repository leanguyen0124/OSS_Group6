<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Main menu
* ------------------------------------------------------------------------------ */

?>
<div id="mega-menu-box" class="badoblog-css-mega-menu-box">
      <div id="site-navigation" class="badoblog-css-mega-menu-container">
            <nav class="badoblog-css-mega-menu">
                  <?php
                  do_action('badoblog_hook_inner_mainmenu');
                  wp_nav_menu(array(
                        'theme_location' => 'badoblog-loc-menu-main',
                        'container' => false,
                        // fallback_cb - fills an empty menu - to disable use - '__return_empty_string'
                        'fallback_cb' => 'badoblog_fun_main_menu_list_categories',
                        'depth' => 4
                  ));
                  ?>
            </nav>
      </div>
</div>