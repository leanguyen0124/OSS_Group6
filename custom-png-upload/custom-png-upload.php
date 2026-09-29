<?php
/**
 * Plugin Name:       Custom PNG Upload
 * Description:       Adds secure PNG uploads to BuddyPress activities and bbPress topics and replies.
 * Version:           1.0.0
 * Requires at least: 6.4
 * Requires PHP:      7.0
 * Author:            Site Custom
 * Text Domain:       custom-png-upload
 */

defined( 'ABSPATH' ) || exit;

define( 'CPI_VERSION', '1.0.0' );
define( 'CPI_FILE', __FILE__ );
define( 'CPI_DIR', plugin_dir_path( __FILE__ ) );
define( 'CPI_URL', plugin_dir_url( __FILE__ ) );

require_once CPI_DIR . 'includes/class-custom-png-upload.php';

Custom_PNG_Upload::instance();
