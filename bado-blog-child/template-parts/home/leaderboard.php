<?php
/** Full-width leaders strip above a ranking table and personal rank panel. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$entries = $args['entries'];
$ranks = array(); $previous = null; $rank = 0;
foreach ( $entries as $index => $entry ) {
    if ( (int) $entry->score !== $previous ) { $rank = $index + 1; }
    $ranks[ $entry->id ] = $rank; $previous = (int) $entry->score;
}
$current = wp_get_current_user();
$personal = $current->exists() ? oss_community_reward_summary( $current->ID ) : null;
?>
<section class="oss-rewards oss-dashboard" aria-labelledby="oss-ranking-title">
    <header class="oss-board-hero">
        <h2 id="oss-ranking-title">Bảng xếp hạng</h2>
        <?php if ( $entries ) : ?>
        <div class="oss-leader-strip" aria-label="Các thành viên dẫn đầu">
            <?php foreach ( array_slice( $entries, 0, 5 ) as $index => $entry ) : ?>
            <a class="oss-leader-person oss-leader-rank-<?php echo min( 4, (int) $ranks[ $entry->id ] ); ?>" href="<?php echo esc_url( oss_rewards_member_url( $entry->id ) ); ?>">
                <?php if ( 1 === $ranks[ $entry->id ] ) : ?><svg class="oss-leader-crown" viewBox="0 0 60 40" aria-hidden="true"><path d="m5 8 14 12L30 3l11 17L55 8l-6 27H11Z" fill="#f5d780" stroke="#fff7d5" stroke-width="3" stroke-linejoin="round"/><path d="M13 29h34" stroke="#b88b39" stroke-width="3"/></svg><?php endif; ?>
                <span class="oss-leader-avatar"><?php echo get_avatar( $entry->id, 56 ); ?><span><?php echo (int) $ranks[ $entry->id ]; ?></span></span>
                <strong><?php echo esc_html( $entry->name ); ?></strong><span><?php echo esc_html( number_format_i18n( $entry->score ) ); ?> điểm</span>
            </a>
            <?php endforeach; ?>
        </div>
        <?php else : ?><p class="oss-board-empty">Bảng vinh danh đang chờ những đóng góp đầu tiên.</p><?php endif; ?>
    </header>
    <div class="oss-board-grid">
        <div class="oss-scoreboard"><div class="oss-game-section-title"><h3>Thứ hạng thành viên</h3><span><?php echo count( $entries ); ?> thành viên</span></div>
            <div class="oss-scoreboard-scroll"><table class="oss-score-table"><caption class="screen-reader-text">Bảng xếp hạng thành viên theo điểm đóng góp</caption><thead><tr><th scope="col">Hạng</th><th scope="col">Thành viên</th><th scope="col">Huy hiệu</th><th scope="col">Điểm</th></tr></thead><tbody>
            <?php foreach ( $entries as $entry ) : $names = oss_rewards_badge_names( $entry->id ); ?>
                <tr<?php echo (int) $entry->id === get_current_user_id() ? ' class="is-self"' : ''; ?>><td><span class="oss-table-rank"><?php echo (int) $ranks[ $entry->id ]; ?></span></td><th scope="row"><a class="oss-table-member" href="<?php echo esc_url( oss_rewards_member_url( $entry->id ) ); ?>"><?php echo get_avatar( $entry->id, 36 ); ?><span><?php echo esc_html( $entry->name ); ?><?php if ( (int) $entry->id === get_current_user_id() ) : ?><small>Bạn</small><?php endif; ?></span></a></th><td><?php echo esc_html( $names ? implode( ' · ', $names ) : '—' ); ?></td><td><strong><?php echo esc_html( number_format_i18n( $entry->score ) ); ?></strong></td></tr>
            <?php endforeach; ?>
            <?php if ( ! $entries ) : ?><tr><td colspan="4">Chưa có thành viên nào có điểm.</td></tr><?php endif; ?>
            </tbody></table></div><p class="oss-game-note">Các thành viên bằng điểm được xếp cùng hạng.</p>
        </div>
        <aside class="oss-my-rank" aria-label="Thứ hạng của bạn"><div class="oss-game-section-title"><h3>Hạng của bạn</h3><span>Toàn thời gian</span></div>
        <?php if ( $personal ) : ?>
            <div class="oss-my-rank-main"><?php echo get_avatar( $current->ID, 52 ); ?><div><b><?php echo esc_html( $current->display_name ); ?></b><span><?php echo esc_html( number_format_i18n( $personal['score'] ) ); ?> điểm</span></div><strong><?php echo $personal['rank'] ? '#' . (int) $personal['rank'] : '—'; ?></strong></div>
            <p class="oss-game-note"><?php echo $personal['rank'] ? 'Tiếp tục chia sẻ để giữ vững vị trí của bạn.' : 'Bạn chưa có thứ hạng. Đăng chủ đề hoặc trả lời để bắt đầu tích lũy điểm.'; ?></p>
            <a class="oss-game-button oss-game-button-light" href="<?php echo esc_url( oss_community_nav_items()[4]['url'] ); ?>">Xem thành tích của tôi</a>
        <?php else : ?><p class="oss-game-note">Đăng nhập để xem điểm và thứ hạng của bạn.</p><a class="oss-game-button" href="<?php echo esc_url( wp_login_url( get_permalink() ) ); ?>">Đăng nhập</a><?php endif; ?>
        <div class="oss-rank-next"><h4>Cột mốc huy hiệu</h4>
            <?php $rules = oss_rewards_rules(); foreach ( (array) ( $rules['badges'] ?? array() ) as $key => $badge ) : if ( empty( $badge['enabled'] ) ) { continue; } ?>
            <div><?php echo oss_community_badge_art( $key ); ?><span><b><?php echo esc_html( $badge['name'] ); ?></b><small><?php echo esc_html( number_format_i18n( $badge['threshold'] ) ); ?> điểm</small></span><?php if ( $personal && in_array( $key, $personal['earned'], true ) ) : ?><span class="oss-earned-label">Đã nhận</span><?php endif; ?></div>
            <?php endforeach; ?>
        </div></aside>
    </div>
</section>
