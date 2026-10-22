<?php
/** Runs through WP-CLI; write a deterministic content/points summary to a file. */
if ( ! defined( 'WP_CLI' ) ) { exit; }
global $wpdb;
$counts = array();
foreach ( array( 'forum', 'topic', 'reply', 'post', 'page' ) as $type ) {
    $counts[ $type ] = (array) wp_count_posts( $type );
}
$ledger = $wpdb->prefix . 'oss_reward_transactions';
$users = array();
foreach ( get_users( array( 'orderby' => 'ID' ) ) as $user ) {
    $users[] = array( 'id' => (int) $user->ID, 'login' => $user->user_login, 'score' => oss_rewards_score( $user->ID ) );
}
require_once ABSPATH . 'wp-admin/includes/plugin.php';
$plugins = array();
foreach ( (array) get_option( 'active_plugins' ) as $file ) {
    $info = get_plugin_data( WP_PLUGIN_DIR . '/' . $file, false, false );
    $plugins[] = array( 'file' => $file, 'version' => $info['Version'] );
}
$data = array(
    'format' => 1,
    'site_url' => home_url(),
    'wordpress' => get_bloginfo( 'version' ),
    'theme' => get_stylesheet(),
    'plugins' => $plugins,
    'counts' => $counts,
    'users' => $users,
    'ledger' => $wpdb->get_row( "SELECT COUNT(*) AS transactions, COUNT(DISTINCT event_key) AS distinct_events, COALESCE(SUM(points),0) AS total FROM $ledger", ARRAY_A ),
    'activity' => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}bp_activity" ),
    'likes' => (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}oss_content_likes" ),
);
file_put_contents( $args[0], wp_json_encode( $data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE ) );
