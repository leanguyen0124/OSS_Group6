<?php
/**
 * Plugin Name:       Custom Content Report
 * Description:       Adds private BuddyPress activity reporting and a moderation queue.
 * Version:           1.1.0
 * Requires at least: 6.4
 * Requires PHP:      7.0
 * Author:            Site Custom
 * Text Domain:       custom-content-report
 */

defined( 'ABSPATH' ) || exit;

define( 'CCR_VERSION', '1.1.0' );
define( 'CCR_FILE', __FILE__ );
define( 'CCR_DIR', plugin_dir_path( __FILE__ ) );
define( 'CCR_URL', plugin_dir_url( __FILE__ ) );

require_once CCR_DIR . 'includes/class-custom-content-report.php';

register_activation_hook( __FILE__, array( 'Custom_Content_Report', 'activate' ) );

Custom_Content_Report::instance();
