<?php
/**
 * Plugin Name: OSS Community Rewards
 * Description: Điểm thưởng, huy hiệu và bảng xếp hạng cho bbPress/BuddyPress.
 * Version: 1.2.0
 * Author: OSS Group 6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function oss_rewards_tables() {
	global $wpdb;
	return array( $wpdb->prefix . 'oss_reward_transactions', $wpdb->prefix . 'oss_user_badges' );
}

function oss_rewards_install() {
	global $wpdb;
	list( $transactions, $badges ) = oss_rewards_tables();
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	$charset = $wpdb->get_charset_collate();
	dbDelta( "CREATE TABLE $transactions (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		user_id bigint(20) unsigned NOT NULL,
		event_key varchar(191) NOT NULL,
		event_type varchar(40) NOT NULL,
		object_id bigint(20) unsigned NOT NULL,
		points int(11) NOT NULL,
		created_at datetime NOT NULL,
		PRIMARY KEY  (id),
		UNIQUE KEY event_key (event_key),
		KEY user_id (user_id)
	) $charset;" );
	dbDelta( "CREATE TABLE $badges (
		id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		user_id bigint(20) unsigned NOT NULL,
		badge_key varchar(100) NOT NULL,
		awarded_at datetime NOT NULL,
		PRIMARY KEY  (id),
		UNIQUE KEY user_badge (user_id,badge_key),
		KEY user_id (user_id)
	) $charset;" );
	if ( false === get_option( 'oss_reward_rules', false ) ) {
		add_option( 'oss_reward_rules', array(
			'topic' => 10,
			'reply' => 5,
			'badges' => array(
				'bronze' => array( 'name' => 'Đồng', 'threshold' => 20, 'enabled' => 1 ),
				'silver' => array( 'name' => 'Bạc', 'threshold' => 50, 'enabled' => 1 ),
				'gold' => array( 'name' => 'Vàng', 'threshold' => 100, 'enabled' => 1 ),
			),
		) );
	}
	update_option( 'oss_rewards_db_version', '1' );
}
register_activation_hook( __FILE__, 'oss_rewards_install' );
add_action( 'init', function () {
	if ( '1' !== get_option( 'oss_rewards_db_version' ) ) {
		oss_rewards_install();
	}
} );

function oss_rewards_rules() {
	return (array) get_option( 'oss_reward_rules', array() );
}

function oss_rewards_score( $user_id ) {
	global $wpdb;
	list( $transactions ) = oss_rewards_tables();
	return (int) $wpdb->get_var( $wpdb->prepare( "SELECT COALESCE(SUM(points), 0) FROM $transactions WHERE user_id = %d", $user_id ) );
}

/** Return a transaction ID on success, or 0 when the event was already processed. */
function oss_rewards_record( $user_id, $event_key, $event_type, $object_id, $points ) {
	global $wpdb;
	$user_id = (int) $user_id;
	if ( $user_id <= 0 || ! get_userdata( $user_id ) || 0 === (int) $points ) {
		return 0;
	}
	list( $transactions ) = oss_rewards_tables();
	$inserted = $wpdb->insert( $transactions, array(
		'user_id' => $user_id, 'event_key' => $event_key,
		'event_type' => $event_type, 'object_id' => (int) $object_id,
		'points' => (int) $points, 'created_at' => current_time( 'mysql', true ),
	), array( '%d', '%s', '%s', '%d', '%d', '%s' ) );
	if ( ! $inserted ) {
		return 0;
	}
	$transaction_id = (int) $wpdb->insert_id;
	$score = oss_rewards_score( $user_id );
	update_user_meta( $user_id, '_oss_reward_points', $score );
	delete_transient( 'oss_rewards_leaderboard' );
	if ( $points > 0 ) {
		oss_rewards_evaluate_badges( $user_id, $score );
	}
	return $transaction_id;
}

function oss_rewards_evaluate_badges( $user_id, $score ) {
	global $wpdb;
	list( , $badges ) = oss_rewards_tables();
	$rules = oss_rewards_rules();
	foreach ( (array) ( $rules['badges'] ?? array() ) as $key => $badge ) {
		if ( empty( $badge['enabled'] ) || $score < (int) $badge['threshold'] ) {
			continue;
		}
		$existing = $wpdb->get_var( $wpdb->prepare( "SELECT id FROM $badges WHERE user_id = %d AND badge_key = %s", $user_id, $key ) );
		if ( $existing ) {
			continue;
		}
		$inserted = $wpdb->insert( $badges, array(
			'user_id' => $user_id, 'badge_key' => $key,
			'awarded_at' => current_time( 'mysql', true ),
		), array( '%d', '%s', '%s' ) );
		if ( $inserted && function_exists( 'bp_notifications_add_notification' ) ) {
			bp_notifications_add_notification( array(
				'user_id' => $user_id, 'item_id' => (int) $wpdb->insert_id,
				'component_name' => 'oss_rewards', 'component_action' => 'badge_awarded',
				'date_notified' => current_time( 'mysql', true ), 'is_new' => 1,
			) );
		}
	}
}

add_filter( 'bp_notifications_get_registered_components', function ( $components ) {
	$components[] = 'oss_rewards';
	return array_unique( $components );
} );
add_filter( 'bp_notifications_get_notifications_for_user', function ( $content, $item_id, $secondary_id, $count, $format, $action, $component ) {
	if ( 'oss_rewards' !== $component || 'badge_awarded' !== $action ) {
		return $content;
	}
	global $wpdb;
	list( , $badges ) = oss_rewards_tables();
	$key = $wpdb->get_var( $wpdb->prepare( "SELECT badge_key FROM $badges WHERE id = %d", $item_id ) );
	$rules = oss_rewards_rules();
	$name = $rules['badges'][ $key ]['name'] ?? $key;
	$label = sprintf( 'Bạn đã nhận huy hiệu %s!', $name );
	$link = function_exists( 'bp_loggedin_user_domain' ) ? bp_loggedin_user_domain() : home_url( '/' );
	return 'object' === $format ? array( 'text' => $label, 'link' => $link ) : '<a href="' . esc_url( $link ) . '">' . esc_html( $label ) . '</a>';
}, 10, 7 );

/** A topic/reply earns points only when it first becomes published. */
add_action( 'transition_post_status', function ( $new, $old, $post ) {
	if ( ! in_array( $post->post_type, array( 'topic', 'reply' ), true ) ) {
		return;
	}
	$type = $post->post_type;
	$active = (bool) get_post_meta( $post->ID, '_oss_reward_active', true );
	$cycle = (int) get_post_meta( $post->ID, '_oss_reward_cycle', true );
	if ( 'publish' === $new && 'publish' !== $old && ! $active ) {
		$rules = oss_rewards_rules();
		$points = max( 0, (int) ( $rules[ $type ] ?? 0 ) );
		if ( $points ) {
			$next = $cycle + 1;
			$id = oss_rewards_record( $post->post_author, "$type:{$post->ID}:award:$next", $type, $post->ID, $points );
			if ( $id ) {
				update_post_meta( $post->ID, '_oss_reward_cycle', $next );
				update_post_meta( $post->ID, '_oss_reward_amount', $points );
				update_post_meta( $post->ID, '_oss_reward_active', 1 );
			}
		}
	} elseif ( 'publish' !== $new && $active ) {
		$points = (int) get_post_meta( $post->ID, '_oss_reward_amount', true );
		$id = oss_rewards_record( $post->post_author, "$type:{$post->ID}:revoke:$cycle", 'revoke_' . $type, $post->ID, -$points );
		if ( $id ) {
			delete_post_meta( $post->ID, '_oss_reward_active' );
		}
	}
}, 10, 3 );

add_action( 'before_delete_post', function ( $post_id ) {
	$post = get_post( $post_id );
	if ( ! $post || ! in_array( $post->post_type, array( 'topic', 'reply' ), true ) || ! get_post_meta( $post_id, '_oss_reward_active', true ) ) {
		return;
	}
	$cycle = (int) get_post_meta( $post_id, '_oss_reward_cycle', true );
	$points = (int) get_post_meta( $post_id, '_oss_reward_amount', true );
	oss_rewards_record( $post->post_author, "{$post->post_type}:$post_id:revoke:$cycle", 'revoke_' . $post->post_type, $post_id, -$points );
} );

function oss_rewards_badge_names( $user_id ) {
	global $wpdb;
	list( , $badges ) = oss_rewards_tables();
	$keys = $wpdb->get_col( $wpdb->prepare( "SELECT badge_key FROM $badges WHERE user_id = %d", $user_id ) );
	$rules = oss_rewards_rules();
	$names = array();
	foreach ( $keys as $key ) {
		$names[] = $rules['badges'][ $key ]['name'] ?? $key;
	}
	return $names;
}

add_action( 'bp_profile_header_meta', function () {
	if ( ! function_exists( 'bp_displayed_user_id' ) ) {
		return;
	}
	$user_id = bp_displayed_user_id();
	if ( $user_id ) {
		echo '<p>Điểm: ' . esc_html( (string) oss_rewards_score( $user_id ) ) . ' · Huy hiệu: ' . esc_html( implode( ', ', oss_rewards_badge_names( $user_id ) ) ?: 'Chưa có' ) . '</p>';
	}
} );

/** Scoped styles: apply only to the rewards components. */
function oss_rewards_ui_styles() {
	static $printed = false;
	if ( $printed ) { return ''; }
	$printed = true;
	return '<style>
.oss-ui{--oss-ink:#20243a;--oss-muted:#626b81;--oss-line:#e6e9f2;--oss-purple:#5546c7;color:var(--oss-ink);font:400 15px/1.6 system-ui,-apple-system,"Segoe UI",sans-serif;max-width:1100px;margin:20px auto;text-align:left}
.oss-ui,.oss-ui *{box-sizing:border-box}.oss-ui h2,.oss-ui h3,.oss-ui p{margin:0;padding:0;color:inherit;font-family:inherit}.oss-ui h2{font-size:clamp(24px,4vw,36px);line-height:1.2;font-weight:750;letter-spacing:-.8px}.oss-ui h3{font-size:18px;line-height:1.4;font-weight:700}.oss-ui a{color:var(--oss-purple);text-decoration:none}.oss-ui a:hover{text-decoration:underline}.oss-ui a:focus-visible,.oss-ui summary:focus-visible{outline:3px solid #aa9cff;outline-offset:4px}.oss-ui .oss-muted{color:var(--oss-muted);font-size:13px}.oss-ui .oss-eyebrow{font-size:11px;font-weight:750;letter-spacing:1.8px;text-transform:uppercase;margin-bottom:10px}
.oss-ui .oss-hero{background:linear-gradient(120deg,#302568,#5143aa 75%,#6960bd);color:#fff;border-radius:22px;padding:30px;position:relative;overflow:hidden}.oss-ui .oss-hero:after{content:"";position:absolute;width:180px;height:180px;border:28px solid #ffffff0b;border-radius:50%;right:-60px;top:-75px;pointer-events:none}.oss-ui .oss-hero p:last-child{color:#e6e2ff;margin-top:12px;max-width:520px}.oss-ui .oss-hero .oss-eyebrow{color:#d1caff}.oss-ui .oss-topline{display:flex;gap:14px;align-items:center}.oss-ui .oss-topline img{width:56px;height:56px;border-radius:50%;border:3px solid #ffffff55;flex-shrink:0}
.oss-ui .oss-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:12px;margin:16px 0}.oss-ui .oss-stat{border:1px solid var(--oss-line);background:#fff;border-radius:16px;padding:18px 16px;min-width:0}.oss-ui .oss-stat strong{display:block;font-size:28px;font-weight:750;line-height:1.25;color:var(--oss-ink);margin-top:7px;overflow-wrap:anywhere}.oss-ui .oss-stat span{color:var(--oss-muted);font-size:12px}.oss-ui .oss-stat:first-child{background:#f2f0ff;border-color:#e4ddff}.oss-ui .oss-stat:first-child strong{color:var(--oss-purple)}
.oss-ui .oss-panel{background:#fff;border:1px solid var(--oss-line);border-radius:18px;padding:22px;margin-top:16px}.oss-ui .oss-panel-head{display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:18px}.oss-ui .oss-tag{display:inline-flex;align-items:center;border-radius:50px;background:#f2f0ff;color:#5142af;padding:5px 10px;font-size:11px;font-weight:650}.oss-ui .oss-empty{text-align:center;padding:30px 12px}.oss-ui .oss-empty-icon{display:grid;place-items:center;width:64px;height:64px;margin:0 auto 16px;border-radius:20px;background:#f2f0ff;color:var(--oss-purple);font-size:28px}.oss-ui .oss-empty p{color:var(--oss-muted);margin:10px auto 20px;max-width:360px}.oss-ui .oss-button{display:inline-block;background:#5546c7;color:#fff!important;border:1px solid #5546c7;border-radius:10px;padding:10px 17px;font-weight:650;font-size:13px;line-height:1.5}.oss-ui .oss-button:hover{background:#41339e;text-decoration:none}
.oss-ui .oss-rules{margin-top:16px;background:#f7f8fc;border-radius:14px;padding:16px 18px;font-size:13px}.oss-ui summary{cursor:pointer;font-weight:650}.oss-ui .oss-rule-items{display:flex;gap:10px;flex-wrap:wrap;margin-top:12px}.oss-ui .oss-rule-items span{padding:8px 12px;border:1px solid var(--oss-line);border-radius:9px;background:#fff}.oss-ui .oss-rule-items b{color:var(--oss-purple)}
.oss-ui .oss-row{display:flex;align-items:center;gap:12px;padding:16px 0;border-top:1px solid #eef0f6;min-width:0}.oss-ui .oss-row:first-child{border-top:0}.oss-ui .oss-row.oss-self{background:#f6f4ff;border-radius:12px;padding:16px 10px}.oss-ui .oss-position{width:30px;flex-shrink:0;text-align:center;color:var(--oss-muted);font-weight:700;font-size:14px}.oss-ui .oss-position.oss-medal{background:#fff4d4;color:#936600;border-radius:9px;line-height:32px}.oss-ui .oss-row img{width:42px;height:42px;flex-shrink:0;border-radius:50%;margin:0}.oss-ui .oss-person{flex:1;min-width:0}.oss-ui .oss-person>a{display:block;font-size:14px;font-weight:700;color:var(--oss-ink);overflow-wrap:anywhere}.oss-ui .oss-person small{font-size:11px;color:var(--oss-muted)}.oss-ui .oss-score{flex-shrink:0;text-align:right;font-size:19px;font-weight:750;color:var(--oss-purple)}.oss-ui .oss-score small{display:block;font-size:10px;font-weight:400;color:var(--oss-muted)}.oss-ui .oss-footnote{margin-top:14px;font-size:11px;color:var(--oss-muted)}
.oss-ui .oss-progress{width:100%;height:10px;display:block;border:0;border-radius:10px;overflow:hidden;accent-color:var(--oss-purple);margin:14px 0;background:#eceaf7}.oss-ui .oss-progress::-webkit-progress-bar{background:#eceaf7;border-radius:10px}.oss-ui .oss-progress::-webkit-progress-value{background:linear-gradient(90deg,#5546c7,#9b85ec);border-radius:10px}.oss-ui .oss-progress::-moz-progress-bar{background:#5546c7}.oss-ui .oss-badges{display:grid;grid-template-columns:repeat(auto-fit,minmax(115px,1fr));gap:12px}.oss-ui .oss-badge{text-align:center;background:#fbfaff;border:1px solid #e2ddf7;border-radius:14px;padding:16px 10px}.oss-ui .oss-badge.oss-locked{background:#f8f9fb;border-color:#eceef3;color:#737b8d}.oss-ui .oss-badge-icon{font-size:26px;display:block;line-height:1.4;color:#ab7c1e}.oss-ui .oss-locked .oss-badge-icon{color:#98a0b1}.oss-ui .oss-badge b{display:block;font-size:13px;margin:5px 0}.oss-ui .oss-badge small{display:block;font-size:11px;color:var(--oss-muted)}.oss-ui .oss-history{list-style:none!important;padding:0!important;margin:0!important}.oss-ui .oss-history li{display:flex;align-items:center;gap:14px;border-top:1px solid var(--oss-line);padding:14px 0;margin:0;list-style:none}.oss-ui .oss-history li:first-child{border:0}.oss-ui .oss-history .oss-detail{flex:1;min-width:0}.oss-ui .oss-detail b{display:block;font-size:13px}.oss-ui .oss-detail small{display:block;font-size:11px;color:var(--oss-muted)}.oss-ui .oss-positive{color:#187852;font-weight:750}.oss-ui .oss-negative{color:#b74343;font-weight:750}
@media(max-width:600px){.oss-ui .oss-hero{padding:23px 20px}.oss-ui .oss-panel{padding:18px 14px}.oss-ui .oss-stats{gap:8px}.oss-ui .oss-stat{padding:14px 10px}.oss-ui .oss-stat strong{font-size:23px}.oss-ui .oss-stat span{font-size:11px}.oss-ui .oss-row{gap:8px}.oss-ui .oss-row img{width:34px;height:34px}.oss-ui .oss-badges{grid-template-columns:repeat(2,minmax(0,1fr))}}
@media(prefers-reduced-motion:no-preference){.oss-ui .oss-button{transition:background .15s ease}}
</style>';
}

function oss_rewards_forum_url() {
	return function_exists( 'bbp_get_forums_url' ) ? bbp_get_forums_url() : ( get_post_type_archive_link( 'forum' ) ?: home_url( '/' ) );
}

function oss_rewards_member_url( $user_id ) {
	return function_exists( 'bp_members_get_user_url' ) ? bp_members_get_user_url( $user_id ) : get_author_posts_url( $user_id );
}

function oss_rewards_rules_ui() {
	$rules = oss_rewards_rules();
	return '<details class="oss-rules"><summary>Cách tích lũy điểm</summary><div class="oss-rule-items"><span>Tạo chủ đề <b>+' . esc_html( (string) ( $rules['topic'] ?? 0 ) ) . '</b></span><span>Trả lời <b>+' . esc_html( (string) ( $rules['reply'] ?? 0 ) ) . '</b></span></div><p class="oss-footnote">Điểm được ghi nhận khi nội dung được đăng. Chỉnh sửa nội dung không cộng thêm điểm.</p></details>';
}

add_shortcode( 'oss_reward_profile', function ( $atts ) {
	global $wpdb;
	$atts = shortcode_atts( array( 'user_id' => get_current_user_id() ), $atts );
	$user_id = absint( $atts['user_id'] );
	$user = get_userdata( $user_id );
	$html = oss_rewards_ui_styles() . '<section class="oss-ui" aria-label="Điểm và thành tích">';
	if ( ! $user ) {
		return $html . '<div class="oss-panel oss-empty"><span class="oss-empty-icon" aria-hidden="true">☆</span><h3>Hành trình của bạn bắt đầu tại đây</h3><p>Đăng nhập để theo dõi điểm, nhận huy hiệu và lưu lại những đóng góp của bạn.</p><a class="oss-button" href="' . esc_url( wp_login_url( get_permalink() ) ) . '">Đăng nhập</a></div></section>';
	}
	list( $transactions, $badges_table ) = oss_rewards_tables();
	$score = oss_rewards_score( $user_id );
	$earned = $wpdb->get_col( $wpdb->prepare( "SELECT badge_key FROM $badges_table WHERE user_id = %d", $user_id ) );
	$rank = $score > 0 ? 1 + (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM (SELECT t.user_id FROM $transactions t INNER JOIN {$wpdb->users} u ON u.ID = t.user_id GROUP BY t.user_id HAVING SUM(t.points) > %d) ranked", $score ) ) : 0;
	$rules = oss_rewards_rules();
	$badge_rules = (array) ( $rules['badges'] ?? array() );
	uasort( $badge_rules, function ( $a, $b ) { return (int) $a['threshold'] <=> (int) $b['threshold']; } );
	$next = null;
	foreach ( $badge_rules as $key => $badge ) {
		if ( ! empty( $badge['enabled'] ) && ! in_array( $key, $earned, true ) ) { $next = $badge; break; }
	}
	$html .= '<header class="oss-hero"><p class="oss-eyebrow">Hành trình đóng góp</p><div class="oss-topline">' . get_avatar( $user_id, 56, '', '', array( 'extra_attr' => 'loading="lazy"' ) ) . '<h2>' . esc_html( $user->display_name ) . '</h2></div><p>Mỗi chia sẻ hữu ích là một bước tiến mới.</p></header><div class="oss-stats"><div class="oss-stat"><span>Tổng điểm</span><strong>' . esc_html( number_format_i18n( $score ) ) . '</strong></div><div class="oss-stat"><span>Huy hiệu đã nhận</span><strong>' . count( $earned ) . '</strong></div><div class="oss-stat"><span>Hạng hiện tại</span><strong>' . ( $rank ? '#' . $rank : '—' ) . '</strong></div></div>';
	if ( $next ) {
		$threshold = max( 1, (int) $next['threshold'] );
		$progress = min( 100, max( 0, (int) floor( $score * 100 / $threshold ) ) );
		$html .= '<div class="oss-panel"><div class="oss-panel-head"><h3>Chinh phục huy hiệu ' . esc_html( $next['name'] ) . '</h3><span class="oss-tag">' . $progress . '%</span></div><progress class="oss-progress" value="' . $progress . '" max="100" aria-label="Tiến độ tới huy hiệu tiếp theo">' . $progress . '%</progress><p class="oss-muted">' . ( $score < $threshold ? 'Còn ' . esc_html( number_format_i18n( $threshold - $score ) ) . ' điểm để đạt mốc ' . esc_html( number_format_i18n( $threshold ) ) . ' điểm.' : 'Bạn đã đủ điểm. Huy hiệu sẽ được xét ở lần cộng điểm tiếp theo.' ) . '</p></div>';
	}
	$html .= '<div class="oss-panel"><div class="oss-panel-head"><h3>Bộ sưu tập huy hiệu</h3><span class="oss-muted">Ghi dấu mỗi cột mốc</span></div><div class="oss-badges">';
	$visible = 0;
	foreach ( $badge_rules as $key => $badge ) {
		$unlocked = in_array( $key, $earned, true );
		if ( empty( $badge['enabled'] ) && ! $unlocked ) { continue; }
		$visible++;
		$html .= '<div class="oss-badge' . ( $unlocked ? '' : ' oss-locked' ) . '"><span class="oss-badge-icon" aria-hidden="true">' . ( $unlocked ? '★' : '☆' ) . '</span><b>' . esc_html( $badge['name'] ) . '</b><small>' . esc_html( number_format_i18n( $badge['threshold'] ) ) . ' điểm</small><small>' . ( $unlocked ? 'Đã nhận' : 'Chưa đạt' ) . '</small></div>';
	}
	$html .= '</div>' . ( $visible ? '' : '<p class="oss-muted">Chưa có huy hiệu được thiết lập.</p>' ) . '</div>';
	$rows = $wpdb->get_results( $wpdb->prepare( "SELECT id, event_type, points, created_at FROM $transactions WHERE user_id = %d ORDER BY id DESC LIMIT 30", $user_id ) );
	$labels = array( 'topic' => 'Đăng chủ đề mới', 'reply' => 'Đóng góp câu trả lời', 'revoke_topic' => 'Thu hồi điểm chủ đề', 'revoke_reply' => 'Thu hồi điểm câu trả lời' );
	$html .= '<div class="oss-panel"><div class="oss-panel-head"><h3>Lịch sử điểm</h3><span class="oss-muted">30 giao dịch gần nhất</span></div>';
	if ( ! $rows ) {
		$html .= '<div class="oss-empty"><span class="oss-empty-icon" aria-hidden="true">↗</span><h3>Chưa có đóng góp nào được ghi nhận</h3><p>Tham gia một cuộc thảo luận để nhận những điểm đầu tiên.</p><a class="oss-button" href="' . esc_url( oss_rewards_forum_url() ) . '">Khám phá diễn đàn</a></div>';
	} else {
		$html .= '<ul class="oss-history">';
		foreach ( $rows as $row ) {
			$positive = (int) $row->points > 0;
			$date = get_date_from_gmt( $row->created_at, 'd/m/Y · H:i' );
			$html .= '<li><div class="oss-detail"><b>' . esc_html( $labels[ $row->event_type ] ?? 'Giao dịch điểm' ) . '</b><small>' . esc_html( $date ) . ' · Mã #' . (int) $row->id . '</small></div><span class="' . ( $positive ? 'oss-positive' : 'oss-negative' ) . '">' . ( $positive ? '+' : '' ) . esc_html( number_format_i18n( (int) $row->points ) ) . '</span></li>';
		}
		$html .= '</ul>';
	}
	return $html . '</div>' . oss_rewards_rules_ui() . '</section>';
} );

add_shortcode( 'oss_leaderboard', function () {
	global $wpdb;
	list( $transactions ) = oss_rewards_tables();
	// Read the ledger directly so sorting and displayed scores use the same source.
	$entries = $wpdb->get_results( "SELECT t.user_id AS id, u.display_name AS name, SUM(t.points) AS score FROM $transactions t INNER JOIN {$wpdb->users} u ON u.ID = t.user_id GROUP BY t.user_id, u.display_name HAVING SUM(t.points) > 0 ORDER BY score DESC, t.user_id ASC LIMIT 20" );
	$total = (int) $wpdb->get_var( "SELECT COUNT(*) FROM (SELECT t.user_id FROM $transactions t INNER JOIN {$wpdb->users} u ON u.ID = t.user_id GROUP BY t.user_id HAVING SUM(t.points) > 0) ranked" );
	$sum = (int) $wpdb->get_var( "SELECT COALESCE(SUM(t.points),0) FROM $transactions t INNER JOIN {$wpdb->users} u ON u.ID = t.user_id" );
	$top = $entries ? (int) $entries[0]->score : 0;
	$html = oss_rewards_ui_styles() . '<section class="oss-ui" aria-label="Bảng xếp hạng cộng đồng"><header class="oss-hero"><p class="oss-eyebrow">Cộng đồng · Thành tích</p><h2>Cùng chia sẻ.<br>Cùng vươn lên.</h2><p>Tôn vinh những thành viên góp phần xây dựng cộng đồng mỗi ngày.</p></header><div class="oss-stats"><div class="oss-stat"><span>Thành viên có điểm</span><strong>' . esc_html( number_format_i18n( $total ) ) . '</strong></div><div class="oss-stat"><span>Điểm cộng đồng</span><strong>' . esc_html( number_format_i18n( $sum ) ) . '</strong></div><div class="oss-stat"><span>Điểm dẫn đầu</span><strong>' . esc_html( number_format_i18n( $top ) ) . '</strong></div></div><div class="oss-panel"><div class="oss-panel-head"><h3>Thành viên nổi bật</h3><span class="oss-tag">Xếp hạng toàn thời gian</span></div>';
	if ( ! $entries ) {
		$html .= '<div class="oss-empty"><span class="oss-empty-icon" aria-hidden="true">🏆</span><h3>Vị trí đầu tiên đang chờ bạn</h3><p>Đăng chủ đề hoặc chia sẻ câu trả lời hữu ích để ghi tên mình trên bảng xếp hạng.</p><a class="oss-button" href="' . esc_url( oss_rewards_forum_url() ) . '">Tham gia thảo luận</a></div>';
	} else {
		$html .= '<div role="list">';
		$previous = null;
		$rank = 0;
		foreach ( $entries as $index => $entry ) {
			if ( (int) $entry->score !== $previous ) { $rank = $index + 1; }
			$previous = (int) $entry->score;
			$self = (int) $entry->id === get_current_user_id();
			$names = oss_rewards_badge_names( $entry->id );
			$html .= '<div role="listitem" class="oss-row' . ( $self ? ' oss-self' : '' ) . '"><span class="oss-position' . ( $rank <= 3 ? ' oss-medal' : '' ) . '" aria-label="Hạng ' . $rank . '">' . $rank . '</span>' . get_avatar( $entry->id, 42, '', '', array( 'extra_attr' => 'loading="lazy"' ) ) . '<div class="oss-person"><a href="' . esc_url( oss_rewards_member_url( $entry->id ) ) . '">' . esc_html( $entry->name ) . ( $self ? ' · Bạn' : '' ) . '</a><small>' . esc_html( $names ? implode( ' · ', $names ) : 'Đang tích lũy huy hiệu' ) . '</small></div><span class="oss-score">' . esc_html( number_format_i18n( $entry->score ) ) . '<small>điểm</small></span></div>';
		}
		$html .= '</div><p class="oss-footnote">Hiển thị tối đa 20 thành viên. Các thành viên bằng điểm được xếp cùng hạng.</p>';
	}
	return $html . '</div>' . oss_rewards_rules_ui() . '</section>';
} );

add_action( 'admin_menu', function () {
	add_options_page( 'OSS Rewards', 'OSS Rewards', 'manage_options', 'oss-rewards', 'oss_rewards_settings_page' );
} );

function oss_rewards_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	$rules = oss_rewards_rules();
	echo '<div class="wrap"><h1>Quy tắc điểm và huy hiệu</h1><p>Quy tắc mới áp dụng khi sự kiện tiếp theo xảy ra; giao dịch và huy hiệu đã cấp được giữ lại.</p>';
	if ( isset( $_GET['saved'] ) ) {
		echo '<div class="notice notice-success"><p>Đã lưu.</p></div>';
	}
	echo '<form method="post" action="' . esc_url( admin_url( 'admin-post.php' ) ) . '"><input type="hidden" name="action" value="oss_rewards_save">';
	wp_nonce_field( 'oss_rewards_save' );
	foreach ( array( 'topic' => 'Tạo chủ đề', 'reply' => 'Trả lời' ) as $key => $label ) {
		echo '<p><label>' . esc_html( $label ) . ' (điểm) <input type="number" min="0" max="10000" name="points[' . esc_attr( $key ) . ']" value="' . esc_attr( (string) ( $rules[ $key ] ?? 0 ) ) . '"></label></p>';
	}
	echo '<h2>Huy hiệu</h2><p>Sửa tên, ngưỡng, bật/tắt. Có thể thêm huy hiệu mới ở hàng cuối.</p><table class="widefat"><thead><tr><th>Mã</th><th>Tên</th><th>Điểm tối thiểu</th><th>Bật</th></tr></thead><tbody>';
	foreach ( (array) ( $rules['badges'] ?? array() ) as $key => $badge ) {
		echo '<tr><td>' . esc_html( $key ) . '</td><td><input name="badges[' . esc_attr( $key ) . '][name]" value="' . esc_attr( $badge['name'] ) . '"></td><td><input type="number" min="1" max="1000000" name="badges[' . esc_attr( $key ) . '][threshold]" value="' . esc_attr( (string) $badge['threshold'] ) . '"></td><td><input type="checkbox" name="badges[' . esc_attr( $key ) . '][enabled]" value="1" ' . checked( ! empty( $badge['enabled'] ), true, false ) . '></td></tr>';
	}
	echo '<tr><td>Mới</td><td><input name="new_badge_name" placeholder="Tên huy hiệu"></td><td><input type="number" min="1" name="new_badge_threshold" placeholder="Điểm"></td><td>Tự động bật</td></tr></tbody></table>';
	submit_button( 'Lưu quy tắc' );
	echo '</form><p>Tạo trang với shortcode <code>[oss_leaderboard]</code> hoặc <code>[oss_reward_profile]</code>.</p></div>';
}

add_action( 'admin_post_oss_rewards_save', function () {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( 'Không có quyền.' );
	}
	check_admin_referer( 'oss_rewards_save' );
	$old = oss_rewards_rules();
	$points = isset( $_POST['points'] ) && is_array( $_POST['points'] ) ? wp_unslash( $_POST['points'] ) : array();
	$submitted = isset( $_POST['badges'] ) && is_array( $_POST['badges'] ) ? wp_unslash( $_POST['badges'] ) : array();
	$badges = array();
	foreach ( (array) ( $old['badges'] ?? array() ) as $key => $badge ) {
		$row = isset( $submitted[ $key ] ) && is_array( $submitted[ $key ] ) ? $submitted[ $key ] : array();
		$badges[ $key ] = array(
			'name' => sanitize_text_field( $row['name'] ?? $badge['name'] ),
			'threshold' => max( 1, min( 1000000, absint( $row['threshold'] ?? $badge['threshold'] ) ) ),
			'enabled' => empty( $row['enabled'] ) ? 0 : 1,
		);
	}
	$name = sanitize_text_field( wp_unslash( $_POST['new_badge_name'] ?? '' ) );
	$threshold = absint( $_POST['new_badge_threshold'] ?? 0 );
	$key = sanitize_key( remove_accents( $name ) );
	if ( $name && $threshold && $key && ! isset( $badges[ $key ] ) ) {
		$badges[ $key ] = array( 'name' => $name, 'threshold' => min( 1000000, $threshold ), 'enabled' => 1 );
	}
	update_option( 'oss_reward_rules', array(
		'topic' => max( 0, min( 10000, absint( $points['topic'] ?? 0 ) ) ),
		'reply' => max( 0, min( 10000, absint( $points['reply'] ?? 0 ) ) ),
		'badges' => $badges,
	) );
	wp_safe_redirect( admin_url( 'options-general.php?page=oss-rewards&saved=1' ) );
	exit;
} );
