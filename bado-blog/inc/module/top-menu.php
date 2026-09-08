<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Top menu
* ------------------------------------------------------------------------------ */


$top_menu_item = true;
$menu_loc = 'badoblog-loc-menu-top';
$nav_loc = get_nav_menu_locations();
$item_loc = array_key_exists($menu_loc, $nav_loc) ? $nav_loc[$menu_loc] : null;
if (!wp_get_nav_menu_items($item_loc) && has_nav_menu($menu_loc)) {
      $top_menu_item = false;
}
if ($top_menu_item) {
      if (get_theme_mod('badoblog_cus_top_menu_version', 'js') == 'js') {
            ?>
            <div class="badoblog-css-top-jsmenu-box">
                  <nav class="badoblog-css-top-jsmenu-pc">
                        <button class="badoblog-css-toggle-btn" data-toggle-target=".badoblog-css-top-jsmenu-modal" data-toggle-body-class="badoblog-css-showing-top-jsmenu-modal" 
                        aria-expanded="false" data-set-focus=".badoblog-css-close-top-jsmenu-nav-toggle">
                              <span class="badoblog-css-toggle-bar"></span>
                              <span class="badoblog-css-toggle-bar"></span>
                              <span class="badoblog-css-toggle-bar"></span>
                        </button>
                        <div class="badoblog-css-top-jsmenu-container-box">
                              <?php
                              wp_nav_menu(array(
                                    'theme_location' => $menu_loc,
                                    'menu_class'     => 'badoblog-css-nav-top-jsmenu',
                                    // fallback_cb - fills an empty menu - to disable use - '__return_empty_string'
                                    'fallback_cb' => 'badoblog_fun_top_menu_list_categories',
                                    'depth' => 4
                              ));
                              ?>
                        </div>
                  </nav>
                  <nav class="badoblog-css-top-jsmenu-mobile">
                        <div class="badoblog-css-top-jsmenu-modal badoblog-css-cover-modal" data-modal-target-string=".badoblog-css-top-jsmenu-modal">
                              <button class="badoblog-css-btn-close-menu badoblog-css-close-top-jsmenu-nav-toggle" data-toggle-target=".badoblog-css-top-jsmenu-modal" 
                              data-toggle-body-class="badoblog-css-showing-top-jsmenu-modal" aria-expanded="false" data-set-focus=".badoblog-css-top-jsmenu-modal"><span></span></button>
                              <div class="badoblog-css-mobile-top-jsmenu" aria-label="<?php esc_attr_e('Mobile', 'bado-blog'); ?>">
                                    <?php
                                    wp_nav_menu(array(
                                          'theme_location' => $menu_loc,
                                          'menu_class'     => 'badoblog-css-nav-top-jsmenu badoblog-css-top-jsmenu-modal',
                                          // fallback_cb - fills an empty menu - to disable use - '__return_empty_string'
                                          'fallback_cb' => 'badoblog_fun_top_menu_list_categories',
                                          'depth' => 4
                                    ));
                                    ?>
                              </div>
                        </div>
                  </nav>
            </div>
            <?php
      } else {
            ?>
            <nav class="badoblog-css-top-menu-pc">
                  <?php
                  wp_nav_menu(array(
                        'theme_location' => $menu_loc,
                        // fallback_cb - fills an empty menu - to disable use - '__return_empty_string'
                        'fallback_cb' => 'badoblog_fun_top_menu_list_categories',
                        'depth' => 4
                  ));
                  ?>
            </nav>
            <div class="badoblog-css-top-menu-mobile">
                  <input type="checkbox" id="badoblog-id-nav-top-mobile-toggle" hidden>
                  <label for="badoblog-id-nav-top-mobile-toggle" class="badoblog-css-nav-top-mobile-burger" onclick></label>
                  <div class="badoblog-css-nav-top-mobile">
                        <div class="badoblog-css-nav-top-mobile-title">
                              <div class="badoblog-css-nav-top-mobile-h"><?php esc_html_e('Top menu', 'bado-blog'); ?></div>
                              <label for="badoblog-id-nav-top-mobile-toggle" class="badoblog-css-nav-top-mobile-toggle" onclick></label>
                        </div>
                        <nav class="badoblog-css-nav-top-mobile-ul">
                              <?php
                              wp_nav_menu(array(
                                    'theme_location' => $menu_loc,
                                    // fallback_cb - fills an empty menu - to disable use - '__return_empty_string'
                                    'fallback_cb' => 'badoblog_fun_top_menu_list_categories',
                                    'depth' => 4
                              ));
                              ?>
                        </nav>
                  </div>
                  <label for="badoblog-id-nav-top-mobile-toggle" class="badoblog-css-mask-content" onclick=""></label>
            </div>
            <?php
      }
}
?>
