<?php
/** Unified latest content for the child theme's home page. */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$items = oss_community_latest_items( 10 );
$feed_items = array_slice( $items, 0, 8 );
?>
<div class="oss-home-layout">
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
<aside class="oss-recent-panel" aria-labelledby="oss-recent-title">
    <h2 id="oss-recent-title">Bài đăng gần đây</h2>
    <?php if ( $items ) : ?>
        <ol class="oss-recent-list" tabindex="0" aria-label="Cuộn danh sách bài gần đây">
            <?php foreach ( array_slice( $items, 0, 10 ) as $item ) :
                $author = oss_community_feed_author( $item['author_id'] );
                ?>
                <li>
                    <div class="oss-recent-meta">
                        <?php echo get_avatar( $item['author_id'], 26, '', '', array( 'extra_attr' => 'loading="lazy"' ) ); ?>
                        <span><?php echo esc_html( $author['name'] ); ?></span>
                        <span aria-hidden="true">·</span>
                        <time datetime="<?php echo esc_attr( gmdate( 'c', $item['time'] ) ); ?>"><?php echo esc_html( wp_date( 'd/m', $item['time'] ) ); ?></time>
                    </div>
                    <a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a>
                    <span class="oss-recent-type"><?php echo esc_html( $item['label'] ); ?></span>
                </li>
            <?php endforeach; ?>
        </ol>
    <?php else : ?>
        <p>Chưa có bài đăng gần đây.</p>
    <?php endif; ?>
</aside>
</div>
