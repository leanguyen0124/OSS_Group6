<?php
/** Compact statistics, member strip and achievement rows inspired by the supplied layout. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$user = $args['user']; $user_id = $args['user_id'];
?>
<section class="oss-rewards oss-dashboard oss-achievements" aria-labelledby="oss-profile-title">
<?php if ( ! $user ) : ?>
    <div class="oss-game-section-title"><h2 id="oss-profile-title">Thành tích của tôi</h2><?php get_template_part( 'template-parts/rewards/help' ); ?></div>
    <p class="oss-game-note">Đăng nhập để theo dõi điểm đóng góp và bộ sưu tập huy hiệu.</p>
    <a class="oss-game-button" href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>">Đăng nhập</a>
<?php else :
    global $wpdb;
    $summary = oss_community_reward_summary( $user_id );
    $rules = oss_rewards_rules(); $badges = (array) ( $rules['badges'] ?? array() );
    uasort( $badges, function ( $a, $b ) { return (int) $a['threshold'] <=> (int) $b['threshold']; } );
    $next = null;
    foreach ( $badges as $key => $badge ) {
        if ( ! empty( $badge['enabled'] ) && ! in_array( $key, $summary['earned'], true ) ) { $next = $badge; break; }
    }
    list( $transactions ) = oss_rewards_tables();
    $rows = $wpdb->get_results( $wpdb->prepare( "SELECT id, event_type, points, created_at FROM $transactions WHERE user_id = %d ORDER BY id DESC LIMIT 30", $user_id ) );
    $labels = array( 'topic' => 'Đăng chủ đề mới', 'reply' => 'Đóng góp câu trả lời', 'revoke_topic' => 'Thu hồi điểm chủ đề', 'revoke_reply' => 'Thu hồi điểm câu trả lời' );
    $contributions = (int) $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $transactions WHERE user_id = %d AND points > 0 AND event_type IN ('topic', 'reply')", $user_id ) );
?>
    <header class="oss-profile-bar"><div class="oss-profile-identity"><?php echo get_avatar( $user_id, 56 ); ?><div><h2 id="oss-profile-title"><?php echo esc_html( 'Hành trình đóng góp của ' . $user->display_name ); ?></h2></div></div><?php get_template_part( 'template-parts/rewards/help' ); ?></header>
    <div class="oss-profile-dashboard-grid"><div>
        <section aria-labelledby="oss-stats-title"><div class="oss-game-section-title"><h3 id="oss-stats-title">Thống kê</h3><span>Toàn thời gian</span></div>
        <dl class="oss-stat-tiles"><div><dt>Tổng điểm</dt><dd><?php echo esc_html( number_format_i18n( $summary['score'] ) ); ?></dd></div><div><dt>Hạng hiện tại</dt><dd><?php echo $summary['rank'] ? '#' . (int) $summary['rank'] : '—'; ?></dd></div><div><dt>Huy hiệu đã nhận</dt><dd><?php echo count( $summary['earned'] ); ?></dd></div><div><dt>Đóng góp ghi nhận</dt><dd><?php echo esc_html( number_format_i18n( $contributions ) ); ?></dd></div></dl></section>
        <section aria-labelledby="oss-badges-title"><div class="oss-game-section-title"><h3 id="oss-badges-title">Huy hiệu &amp; cột mốc</h3><span><?php echo count( $summary['earned'] ); ?> đã nhận</span></div>
        <div class="oss-achievement-list">
        <?php $visible = 0; foreach ( $badges as $key => $badge ) :
            $earned = in_array( $key, $summary['earned'], true );
            if ( empty( $badge['enabled'] ) && ! $earned ) { continue; }
            $visible++;
            $progress = min( 100, max( 0, (int) floor( $summary['score'] * 100 / max( 1, (int) $badge['threshold'] ) ) ) );
        ?>
        <div class="oss-achievement-row<?php echo $earned ? ' is-earned' : ''; ?>"><div class="oss-achievement-icon"><?php echo oss_community_badge_art( $key ); ?></div><div class="oss-achievement-detail"><h4><?php echo esc_html( $badge['name'] ); ?></h4><p>Đạt <?php echo esc_html( number_format_i18n( $badge['threshold'] ) ); ?> điểm đóng góp</p><progress value="<?php echo $earned ? 100 : (int) $progress; ?>" max="100" aria-label="Tiến độ huy hiệu <?php echo esc_attr( $badge['name'] ); ?>"><?php echo (int) $progress; ?>%</progress></div><span class="oss-achievement-state"><?php echo $earned ? 'Đã nhận' : ( $progress >= 100 ? 'Chờ xét' : esc_html( $progress . '%' ) ); ?></span></div>
        <?php endforeach; ?>
        <?php if ( ! $visible ) : ?><p class="oss-game-note">Chưa có huy hiệu được thiết lập.</p><?php endif; ?>
        </div></section>
    </div><aside class="oss-point-history" aria-label="Lịch sử điểm"><div class="oss-game-section-title"><h3>Nhật ký đóng góp</h3></div>
        <?php if ( ! $rows ) : ?><p class="oss-game-note">Chưa có đóng góp được ghi nhận.</p><?php endif; ?>
        <ul><?php foreach ( $rows as $row ) : ?><li><div><b><?php echo esc_html( $labels[ $row->event_type ] ?? 'Giao dịch điểm' ); ?></b><time><?php echo esc_html( get_date_from_gmt( $row->created_at, 'd/m/Y · H:i' ) ); ?></time></div><strong class="<?php echo $row->points > 0 ? 'is-positive' : 'is-negative'; ?>"><?php echo $row->points > 0 ? '+' : ''; ?><?php echo esc_html( number_format_i18n( $row->points ) ); ?></strong></li><?php endforeach; ?></ul>
        <p class="oss-game-note">30 giao dịch gần nhất</p><a class="oss-game-button oss-game-button-light" href="<?php echo esc_url( oss_community_nav_items()[1]['url'] ); ?>">Tiếp tục đóng góp</a>
    </aside></div>
<?php endif; ?>
</section>
