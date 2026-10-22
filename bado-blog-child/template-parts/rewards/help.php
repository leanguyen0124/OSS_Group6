<?php
/** Illustrated three-step tutorial, with live point rules and native dialog controls. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$rules = oss_rewards_rules();
$id = wp_unique_id( 'oss-reward-help-' );
$milestones = array();
foreach ( (array) ( $rules['badges'] ?? array() ) as $badge ) {
    if ( ! empty( $badge['enabled'] ) ) { $milestones[] = $badge['name'] . ' ' . number_format_i18n( $badge['threshold'] ); }
}
?>
<button type="button" class="oss-help-button" data-dialog-open="<?php echo esc_attr( $id ); ?>" aria-haspopup="dialog" aria-controls="<?php echo esc_attr( $id ); ?>"><span aria-hidden="true">?</span> Cách tích lũy điểm</button>
<dialog id="<?php echo esc_attr( $id ); ?>" class="oss-help-dialog oss-help-tutorial" aria-labelledby="<?php echo esc_attr( $id ); ?>-title">
    <form method="dialog"><button class="oss-dialog-close" aria-label="Đóng hướng dẫn">×</button></form>
    <h2 id="<?php echo esc_attr( $id ); ?>-title">Cách tích lũy điểm</h2>
    <div class="oss-tutorial-path">
        <ol class="oss-tutorial-steps">
            <li class="oss-tutorial-step oss-tutorial-post">
                <svg class="oss-tutorial-art" viewBox="0 0 180 125" aria-hidden="true" focusable="false">
                    <g stroke="#fffbdc" stroke-width="5" stroke-linejoin="round">
                        <path d="M39 26h105a13 13 0 0 1 13 13v50a13 13 0 0 1-13 13h-30l-18 15-2-15H39a13 13 0 0 1-13-13V39a13 13 0 0 1 13-13" fill="#276b7e" transform="rotate(7 90 65)"/>
                        <path d="M23 8h96a12 12 0 0 1 12 12v48a12 12 0 0 1-12 12H62L43 95V80H23a12 12 0 0 1-12-12V20A12 12 0 0 1 23 8" fill="#b9dfeb" transform="rotate(-10 70 50)"/>
                    </g>
                    <g stroke="#337f99" stroke-width="7" stroke-linecap="round" transform="rotate(-10 70 50)"><path d="M32 32h76M32 49h55"/></g>
                    <path d="m116 66 29-37q5-6 11-1l5 4q5 5 1 10l-29 37-20 8Z" fill="#ffc97d" stroke="#fffbdc" stroke-width="4" stroke-linejoin="round"/>
                    <path d="m116 66 17 13-20 8Z" fill="#234d5d"/>
                    <path d="m20 103 3 8 9 2-9 3-3 8-3-8-8-3 8-2Z" fill="#f2d684"/>
                </svg>
                <h3>Chia sẻ câu chuyện,<br>trả lời thảo luận</h3>
                <p>Đăng chủ đề hoặc góp một câu trả lời.</p>
            </li>
            <li class="oss-tutorial-step oss-tutorial-points">
                <svg class="oss-tutorial-art" viewBox="0 0 180 125" aria-hidden="true" focusable="false">
                    <path d="m92 2 8 22 20-15-4 25 25-1-18 17 22 12-25 7 10 23-24-8-3 25-15-20-17 19-1-25-24 5 12-22-24-9 23-10-16-19 25 3-2-25 19 17Z" fill="#84bfd1" opacity=".4"/>
                    <g stroke="#fffbdc" stroke-width="4" stroke-linejoin="round"><path d="M19 89v13c0 18 67 18 67 0V89" fill="#b58a35"/><ellipse cx="52.5" cy="89" rx="33.5" ry="12" fill="#f4db88"/><path d="M25 74v13c0 18 67 18 67 0V74" fill="#c69d48"/><ellipse cx="58.5" cy="74" rx="33.5" ry="12" fill="#fff0b7"/>
                    <circle cx="112" cy="57" r="43" fill="#dfb953"/><circle cx="112" cy="57" r="33" fill="#fff0b7" stroke="#fffbdc" stroke-width="3"/></g>
                    <path d="m112 32 7 16 18 2-14 12 4 18-15-9-16 9 4-18-13-12 18-2Z" fill="#a77a2b"/>
                    <path d="m163 90 3 9 10 3-10 3-3 10-3-10-9-3 9-3Z" fill="#fff0b7"/>
                </svg>
                <h3>Gom điểm đóng góp</h3>
                <p class="oss-tutorial-point-values"><span>Chủ đề <b>+<?php echo esc_html( (string) ( $rules['topic'] ?? 0 ) ); ?></b></span><span>Trả lời <b>+<?php echo esc_html( (string) ( $rules['reply'] ?? 0 ) ); ?></b></span></p>
            </li>
            <li class="oss-tutorial-step oss-tutorial-badges">
                <div class="oss-tutorial-art oss-tutorial-prizes" aria-hidden="true">
                    <?php echo oss_community_badge_art( 'gold' ); ?>
                    <svg viewBox="0 0 140 125" focusable="false"><g stroke="#fffbdc" stroke-width="4" stroke-linejoin="round"><path d="M22 48h96v65H22Z" fill="#337f99"/><path d="M14 35h112v25H14Z" fill="#84bfd1"/><path d="M61 35h19v78H61Z" fill="#fff0b7"/><path d="M70 34C27 36 22 4 42 5c16 1 28 29 28 29Zm0 0C113 36 118 4 98 5 82 6 70 34 70 34Z" fill="#b9dfeb"/></g></svg>
                </div>
                <h3>Mở khóa huy hiệu!</h3>
                <p><?php echo esc_html( $milestones ? implode( ' · ', $milestones ) . ' điểm' : 'Cột mốc do cộng đồng thiết lập.' ); ?></p>
            </li>
        </ol>
        <svg class="oss-tutorial-arrow oss-tutorial-arrow-one" viewBox="0 0 100 100" aria-hidden="true" focusable="false"><path d="M19 14c34-1 43 20 43 43l15-7-17 34-29-24 16 1C49 37 44 23 19 14Z" fill="#84bfd1" stroke="#fffbdc" stroke-width="4" stroke-linejoin="round"/></svg>
        <svg class="oss-tutorial-arrow oss-tutorial-arrow-two" viewBox="0 0 100 100" aria-hidden="true" focusable="false"><path d="M19 14c34-1 43 20 43 43l15-7-17 34-29-24 16 1C49 37 44 23 19 14Z" fill="#84bfd1" stroke="#fffbdc" stroke-width="4" stroke-linejoin="round"/></svg>
    </div>
    <form method="dialog" class="oss-tutorial-continue"><button>Đã hiểu, bắt đầu thôi!</button></form>
    <details class="oss-tutorial-fineprint"><summary>Lưu ý về điểm</summary><p>Điểm được ghi nhận khi đăng nội dung. Chỉnh sửa không cộng thêm điểm. Nội dung bị xóa hoặc đưa vào thùng rác sẽ bị thu hồi điểm tương ứng. Huy hiệu được xét khi cộng điểm.</p></details>
</dialog>
