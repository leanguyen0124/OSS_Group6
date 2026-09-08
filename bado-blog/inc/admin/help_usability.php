<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Usability
* ------------------------------------------------------------------------------ */


//----------------------------------------------------------------------------------
//region Customize help functions (in title setting)
//----------------------------------------------------------------------------------

function badoblog_fun_pr_customize_help_color() {
      return '<div><a href="//web-zone.org/themes/bado-blog/custom-color-bado-blog-premium" target="_blank" class="badoblog-css-panel-help-ico" title="Help">?</a></div>';
}

function badoblog_fun_pr_customize_help_mega() {
      return '<div><a href="//web-zone.org/documentation/customize-mega-menu" target="_blank" class="badoblog-css-panel-help-ico" title="Help">?</a></div>';
}

function badoblog_fun_pr_customize_help_speed() {
      return '<div><a href="//web-zone.org/documentation/site-speed-wordpress-theme" target="_blank" class="badoblog-css-panel-help-ico" title="Help">?</a></div>';
}


//----------------------------------------------------------------------------------
//region Customize help functions (in description setting)
//----------------------------------------------------------------------------------

function badoblog_fun_pr_customize_help_mainmenu() {
      return '<div><a href="//web-zone.org/documentation/customize-mega-menu" target="_blank" class="badoblog-css-panel-help-ico" title="Help">?</a></div>';
}

function badoblog_fun_pr_customize_help_event_calendar() {
      return '<div><a href="//web-zone.org/documentation/the-events-calendar-adaptation" target="_blank" class="badoblog-css-panel-help-ico" title="Help">?</a></div>';
}

function badoblog_fun_pr_customize_help_reset() {
      return '<div><a href="//web-zone.org/documentation/reset-theme-settings-wordpress" target="_blank" class="badoblog-css-panel-help-ico" title="Help">?</a></div>';
}


//----------------------------------------------------------------------------------
//region Customize usability functions
//----------------------------------------------------------------------------------

function badoblog_fun_pr_customize_mes_color() {
      return '<div class="badoblog-c-panel-text badoblog-css-panel-premium">'.
            esc_html__('Get more colors with the premium version', 'bado-blog') . ' - '.
            '<a href="//web-zone.org/bado-blog/colors-bado-blog-premium" target="_blank" rel="nofollow">'. 
            esc_html__('Read More', 'bado-blog').'</a></div>';
}

function badoblog_fun_pr_customize_mes_color_topmenu() {
      return '<div class="badoblog-c-panel-text badoblog-css-panel-premium">'.
            sprintf(esc_html__('Get flexible color settings for %s in the premium version', 'bado-blog'), 'top menu') . ' - '.
            '<a href="<a href="//web-zone.org/bado-blog/colors-bado-blog-premium" target="_blank" rel="nofollow">'. 
            esc_html__('Read More', 'bado-blog').'</a></div>';
}

function badoblog_fun_pr_customize_mes_color_footer() {
      return '<div class="badoblog-c-panel-text badoblog-css-panel-premium">'.
            sprintf(esc_html__('Get flexible color settings for %s in the premium version', 'bado-blog'), 'footer') . ' - '.
            '<a href="<a href="//web-zone.org/bado-blog/colors-bado-blog-premium" target="_blank" rel="nofollow">'. 
            esc_html__('Read More', 'bado-blog').'</a></div>';
}

function badoblog_fun_pr_customize_mes_color_breadcrumbs() {
      return '<div class="badoblog-c-panel-text badoblog-css-panel-premium">'.
            sprintf(esc_html__('Get flexible color settings for %s in the premium version', 'bado-blog'), 'breadcrumbs') . ' - '.
            '<a href="<a href="//web-zone.org/bado-blog/colors-bado-blog-premium" target="_blank" rel="nofollow">'. 
            esc_html__('Read More', 'bado-blog').'</a></div>';
}

function badoblog_fun_pr_customize_mes_font() {
      return '<div class="badoblog-c-panel-text badoblog-css-panel-premium">'.
            esc_html__('More fonts are available in the premium version', 'bado-blog') . ' - '.
            '<a href="<a href="//web-zone.org/bado-blog/premium" target="_blank" rel="nofollow">'. 
            esc_html__('Read More', 'bado-blog').'</a></div>';
}

function badoblog_fun_pr_customize_mes_megamenu() {
      return '<div class="badoblog-c-panel-text badoblog-css-panel-premium">'.
            esc_html__('A graphical mega menu with its own customizer is available in the premium version', 'bado-blog') . ' - '.
            '<a href="<a href="//web-zone.org/bado-blog/premium" target="_blank" rel="nofollow">'. 
            esc_html__('Read More', 'bado-blog').'</a></div>';
}

function badoblog_fun_pr_customize_mes_home() {
      return '<div class="badoblog-c-panel-text badoblog-css-panel-premium">'.
            esc_html__('In this section, there can be a flexible customizer that will allow you to quickly and easily customize a cool homepage', 'bado-blog') . ' - '.
            '<a href="<a href="//web-zone.org/bado-blog/home-page-builder-for-bado-blog-premium" target="_blank" rel="nofollow">'. 
            esc_html__('Read More', 'bado-blog').'</a></div>';
}



//----------------------------------------------------------------------------------
//region Setting page usability functions
//----------------------------------------------------------------------------------
//----------------------------------------------------------------------------------
//region General page
//----------------------------------------------------------------------------------

function badoblog_fun_pr_set_general_comparison() {
      return '<div class="badoblog-css-set-admin-premium">
            <h2>' . BADOBLOG_NAME . ' Premium</h2>
            <p><span class="icon-check-mark"></span>' . esc_html__('Home page customizer (choice of 8 blocks)', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Category menu customizer', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Megamenu (graphic) with customizer in the main menu', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Wide slider (below the main menu)', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('More fonts to choose from', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Powerful color settings', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Ready-made color schemes', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Reset theme settings and activate presets', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Full demo versions of sites (Import thematic demo versions in one click)', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Import settings from theme to theme', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Lots of hooks (windows for codes)', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Additional widgets', 'bado-blog') . '</p>
            <p><span class="icon-check-mark"></span>' . sprintf(esc_html__('Separate sidebars for %1$s and %2$s', 'bado-blog'), 'WooCommerce', 'bbPress') . '</p>
            <p><span class="icon-check-mark"></span>' . esc_html__('Expanded plugins adapting', 'bado-blog') . ' (WooCommerce, bbPress, Events Calendar)</p>
            <a href="' . admin_url('themes.php?page=dmcwzmulti_page_settings-pricing') . '">'.esc_html__('Buy', 'bado-blog').' Premium</a>
      </div>
      ';
}


//----------------------------------------------------------------------------------
//region Hooks page
//----------------------------------------------------------------------------------
function badoblog_fun_pr_set_hook_mes() {
      return '<div class="badoblog-css-set-admin-premium-block">'.
            esc_html__('Get even more windows to insert codes in the premium version', 'bado-blog') . ' - '.
            '<a href="//web-zone.org/bado-blog/premium" target="_blank" rel="nofollow">'.
            esc_html__('Read More', 'bado-blog') . '</a></div>';
}


//----------------------------------------------------------------------------------
//region Information page
//----------------------------------------------------------------------------------

function badoblog_fun_pr_set_info_comparison() {
      return '<div class="badoblog-css-set-admin-versions">

            <h2>' . BADOBLOG_NAME . ' Theme ' . esc_html__('(Comparison of Versions)', 'bado-blog') . '</h2>

            <div class="badoblog-css-set-admin-table-box">
                  <table>
                  <thead>
                        <tr>
                              <th>' . esc_html__('Available features', 'bado-blog') . '</th>
                              <th class="badoblog-css-set-admin-table-title">' . esc_html__('Free', 'bado-blog') . '</th>
                              <th class="badoblog-css-set-admin-table-title">Premium</th>
                        </tr>
                  </thead>
                  <tbody>
                        <tr>
                              <td>' . esc_html__('Powerful typography', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Modularity and flexibility', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . sprintf(esc_html__('Visual customizer support (%s)', 'bado-blog'), 'WordPress') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Flexible heading customization with logo', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Flexible sidebar orientation', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Ability to choose your own sidebar orientation for posts and pages', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Selecting the width of the site', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Three pagination options', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Four menu locations', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Mega menu (mega lists, dropdown, single) in the main menu', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Social link customizer in the site header', 'bado-blog') . '</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Plugins adapting', 'bado-blog') . ' (WooCommerce, bbPress, The Events Calendar, Elementor, WPML, Jetpack, Yoast SEO, Newsletter, Contact Form 7)</td>
                              <td><span class="icon-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Home page customizer (choice of 8 blocks)', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Category menu customizer', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Megamenu (graphic) with customizer in the main menu', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Wide slider (below the main menu)', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('More fonts to choose from', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Powerful color settings', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Ready-made color schemes', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Reset theme settings and activate presets', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Full demo versions of sites (Import thematic demo versions in one click)', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Import settings from theme to theme', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Lots of hooks (windows for codes)', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Additional widgets', 'bado-blog') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . sprintf(esc_html__('Separate sidebars for %1$s and %2$s', 'bado-blog'), 'WooCommerce', 'bbPress') . '</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                        <tr>
                              <td>' . esc_html__('Expanded plugins adapting', 'bado-blog') . ' (WooCommerce, bbPress, The Events Calendar)</td>
                              <td><span class="icon-no-check-mark"></span></td>
                              <td><span class="icon-check-mark"></span></td>
                        </tr>
                  </tbody>
                  </table>
            </div>

            <a href="' . admin_url('themes.php?page=dmcwzmulti_page_settings-pricing') . '">'.esc_html__('Buy', 'bado-blog').' Premium</a>

      </div>
      ';
}

// function Soc support links
function badoblog_fun_admin_soc_sup_links() {

      $gtduri = get_template_directory_uri();

      echo '
      <div class="badoblog-css-set-admin-info">

            <h2>' . esc_html__('Social Media Links', 'bado-blog') . '</h2>

            <p>'.esc_html__('Follow theme updates, suggest new features, participate in polls, discuss, and ask questions', 'bado-blog').'</p>

            <div class="badoblog-css-set-admin-info-soc-links">
                  <a href="' . esc_url('//facebook.com/DMCWebZone') . '" target="_blank">
                  <img src="'.$gtduri.'/img/soc/rounded-square/flat/facebook.png'.'" alt="Facebook">
                  </a>
                  <a href="' . esc_url('x.com/DMCWebZone') . '" target="_blank">
                  <img src="'.$gtduri.'/img/soc/rounded-square/flat/twitterx.png'.'" alt="X">
                  </a>
            </div>

      </div>
      ';
}


//----------------------------------------------------------------------------------
//region Hooks tab
//----------------------------------------------------------------------------------

// Adding a tab to the active theme
function badoblog_fun_settings_hooks_tab() {

      // Start page
      $tab = 'support-tab';

      // Which tab is active
      if (isset($_GET['tab'])) {
            $tab = $_GET['tab'];
      }
      ?>
      <a href="<?php echo esc_url(admin_url('themes.php?page=dmcwzmulti_page_settings&tab=hook-tab')); ?>" 
      class="nav-tab <?php echo esc_attr($tab == 'hook-tab' ? 'nav-tab-active' : ''); ?> "><?php esc_html_e('Codes (Hooks theme)', 'bado-blog'); ?>
      </a>
      <?php

}
add_action('dmcwzmulti_hook_tab_settings', 'badoblog_fun_settings_hooks_tab', 5);


//----------------------------------------------------------------------------------
//region Important notices
//----------------------------------------------------------------------------------

// Create nonce
function badoblog_fun_generate_one_key() {
      $nonce = get_option('badoblog_set_generate_nonce');
      if (!$nonce) {
            $nonce = bin2hex(random_bytes(8));
            update_option('badoblog_set_generate_nonce', $nonce);
      }
      return $nonce;
}

// Display scripts only on page (and tabs) dmcwzmulti_page_settings
// Per WordPress rules - use $hook_suffix
// info - developer.wordpress.org/reference/hooks/admin_footer-hook_suffix/
// The page is defined as - appearance_page_dmcwzmulti_page_settings
function badoblog_fun_admin_set_page_script_plans($hook_suffix) {

      $tab_page = array(
            'appearance_page_dmcwzmulti_page_settings',
            'appearance_page_dmcwzmulti_page_settings-pricing'
      );
      if (!in_array($hook_suffix, $tab_page)) {
            return;
      }

      if ($hook_suffix === 'appearance_page_dmcwzmulti_page_settings-pricing') {

            // Scripts for plans (Important notices)
            wp_enqueue_script('badoblog-script-admin-set-plans', get_template_directory_uri() . '/js/admin/usability.js', array('jquery'), BADOBLOG_VERSION, true);
            wp_localize_script('badoblog-script-admin-set-plans', 'BADOBLOG_PUB_KEY_PLAN', array(
                  'pluginKey' => 'badoblog-public-key',
                  'oneKey'     => badoblog_fun_generate_one_key()
            ));

      } else {

            // Scripts for settings (Important notices)
            wp_enqueue_script('badoblog-script-admin-set-settings', get_template_directory_uri() . '/js/admin/usability-settings.js', array('jquery'), BADOBLOG_VERSION, true);
            wp_localize_script('badoblog-script-admin-set-settings', 'BADOBLOG_PUB_KEY_SET', array(
                  'pluginKey' => 'badoblog-public-key',
                  'oneKey'     => badoblog_fun_generate_one_key()
            ));
      
      }

}
add_action('admin_enqueue_scripts', 'badoblog_fun_admin_set_page_script_plans');