<?php
/** Recent content shared by community pages. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
$items = $args['items'] ?? oss_community_latest_items( 10 );
?>
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
