<?php
/** Unified latest content for the child theme's home page. */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$items = oss_community_latest_items( 10 );
$feed_items = array_slice( $items, 0, 8 );
ob_start();
?>
<section class="oss-community-feed" aria-labelledby="oss-community-feed-title">
    <h2 id="oss-community-feed-title" class="badoblog-css-home-section-label">Bài đăng mới nhất</h2>
    <?php if ( ! $feed_items ) : ?>
        <p>Chưa có bài đăng hoặc chủ đề nào.</p>
    <?php else : ?>
        <div class="oss-feed-list" aria-label="Danh sách bài đăng">
            <?php foreach ( $feed_items as $item ) : ?>
                <?php get_template_part( 'template-parts/home/feed-item', null, array( 'item' => $item ) ); ?>
            <?php endforeach; ?>
        </div>
        <div class="oss-feed-loader" data-has-more="<?php echo count( $items ) > count( $feed_items ) ? '1' : '0'; ?>">
            <p class="oss-feed-load-status" role="status" aria-live="polite"></p>
            <button class="oss-feed-more" type="button">Xem thêm bài đăng</button>
        </div>
    <?php endif; ?>
</section>
<?php
get_template_part( 'template-parts/home/layout', null, array( 'content' => ob_get_clean(), 'items' => $items ) );
