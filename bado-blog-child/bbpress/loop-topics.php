<?php
/** Topic groups use feed-style cards, not the default table. */
defined( 'ABSPATH' ) || exit;
do_action( 'bbp_template_before_topics_loop' );
$forum_id = bbp_get_forum_id();
?>
<section class="oss-topic-directory" aria-label="Danh sách chủ đề">
    <header class="oss-topic-directory-heading"><h2>Chủ đề thảo luận</h2>
    <?php if ( bbp_is_single_forum() ) : ?><p><?php echo esc_html( bbp_get_forum_topic_count( $forum_id ) ); ?> chủ đề · <?php echo esc_html( bbp_get_forum_post_count( $forum_id ) ); ?> bài đăng</p><?php endif; ?>
    </header>
    <div class="oss-topic-cards">
    <?php while ( bbp_topics() ) : bbp_the_topic(); bbp_get_template_part( 'loop', 'single-topic' ); endwhile; ?>
    </div>
</section>
<?php do_action( 'bbp_template_after_topics_loop' ); ?>
