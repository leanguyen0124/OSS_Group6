<?php
/** Public topic content and last published post, with original row actions. */
defined( 'ABSPATH' ) || exit;
$topic_id = bbp_get_topic_id();
$last_id = bbp_get_topic_last_active_id( $topic_id );
if ( ! $last_id || 'publish' !== get_post_status( $last_id ) ) { $last_id = $topic_id; }
$last = get_post( $last_id );
$protected = post_password_required( $topic_id );
?>
<article id="bbp-topic-<?php echo (int) $topic_id; ?>" class="oss-topic-card">
    <?php do_action( 'bbp_theme_before_topic_title' ); ?>
    <h3><a href="<?php echo esc_url( bbp_get_topic_permalink( $topic_id ) ); ?>"><?php echo esc_html( bbp_get_topic_title( $topic_id ) ); ?></a></h3>
    <?php do_action( 'bbp_theme_after_topic_title' ); ?>
    <div class="oss-topic-card-counts"><span><?php echo esc_html( bbp_get_topic_post_count( $topic_id ) ); ?> bài đăng</span><span><?php echo esc_html( bbp_get_topic_reply_count( $topic_id ) ); ?> trả lời</span><span><?php echo esc_html( bbp_get_topic_voice_count( $topic_id ) ); ?> người tham gia</span></div>
    <?php if ( $protected ) : ?><p class="oss-topic-protected">Nhập mật khẩu trong chủ đề để xem bài đăng mới nhất.</p><?php endif; ?>
    <?php if ( $last && ! $protected && ! post_password_required( $last ) ) : ?><div class="oss-topic-last-post"><span>Bài đăng mới nhất</span><p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( strip_shortcodes( $last->post_content ) ), 30, '…' ) ); ?></p><a href="<?php echo esc_url( 'reply' === $last->post_type ? bbp_get_reply_url( $last_id ) : bbp_get_topic_permalink( $topic_id ) ); ?>"><?php echo esc_html( get_the_author_meta( 'display_name', $last->post_author ) ); ?> · <?php echo esc_html( get_the_date( 'd/m/Y · H:i', $last ) ); ?></a></div><?php endif; ?>
    <?php if ( function_exists( 'oss_content_like_button' ) ) { echo oss_content_like_button( $topic_id ); } ?>
    <?php if ( class_exists( 'Custom_Content_Report' ) ) { echo Custom_Content_Report::instance()->get_report_button( 'topic', $topic_id ); } ?>
    <?php bbp_topic_pagination(); ?>
    <?php if ( bbp_is_user_home() && bbp_is_favorites() ) { bbp_topic_favorite_link(); } elseif ( bbp_is_user_home() && bbp_is_subscriptions() ) { bbp_topic_subscription_link(); } ?>
</article>
