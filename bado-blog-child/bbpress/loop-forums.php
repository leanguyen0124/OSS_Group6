<?php
/** Forum directory cards. Preserve bbPress's visibility-filtered loop. */
defined( 'ABSPATH' ) || exit;
do_action( 'bbp_template_before_forums_loop' );
?>
<section class="oss-forum-directory" aria-label="Các diễn đàn">
    <div class="oss-forum-directory-toolbar"><h2>Khám phá diễn đàn</h2>
    <?php if ( function_exists( 'oss_member_can_create_forum' ) && oss_member_can_create_forum() && ! bbp_is_single_forum() ) : ?><a class="oss-forum-action" href="#oss-create-forum">+ Tạo diễn đàn</a><?php elseif ( ! is_user_logged_in() ) : ?><a class="oss-forum-action" href="<?php echo esc_url( wp_login_url( get_permalink() . '#oss-create-forum' ) ); ?>">+ Tạo diễn đàn</a><?php endif; ?></div>
    <div class="oss-forum-grid">
    <?php while ( bbp_forums() ) : bbp_the_forum();
        $forum_id = bbp_get_forum_id();
        $cover = get_the_post_thumbnail( $forum_id, 'medium_large', array( 'loading' => 'lazy' ) );
    ?>
        <article class="oss-forum-card">
            <a href="<?php echo esc_url( bbp_get_forum_permalink( $forum_id ) ); ?>">
                <div class="oss-forum-cover"><?php if ( $cover ) { echo $cover; } else { ?><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/forum-cover.svg' ); ?>" alt="" loading="lazy"><?php } ?></div>
                <h3><?php echo esc_html( bbp_get_forum_title( $forum_id ) ); ?></h3>
            </a>
            <p><?php echo esc_html( wp_trim_words( wp_strip_all_tags( get_post_field( 'post_content', $forum_id ) ), 20 ) ); ?></p>
            <div class="oss-forum-counts"><span><?php echo esc_html( bbp_get_forum_topic_count( $forum_id ) ); ?> chủ đề</span><span><?php echo esc_html( bbp_get_forum_post_count( $forum_id ) ); ?> bài đăng</span></div>
        </article>
    <?php endwhile; ?>
    </div>
</section>
<?php if ( ! bbp_is_single_forum() && function_exists( 'oss_member_can_create_forum' ) && oss_member_can_create_forum() ) { get_template_part( 'template-parts/forums/create-forum' ); } ?>
<?php do_action( 'bbp_template_after_forums_loop' ); ?>
