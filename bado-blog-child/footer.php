<?php
/** Community footer. */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description' );
?>
    </div><!-- #content -->
    <footer id="colophon" class="oss-footer" aria-label="Chân trang">
        <div class="oss-footer-grid">
            <div class="oss-footer-brand">
                <a class="oss-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/cat-outline.svg' ); ?>" width="72" height="72" alt="">
                    <span><?php echo esc_html( $site_name ); ?></span>
                </a>
                <?php if ( $tagline ) : ?><p class="oss-footer-tagline"><?php echo esc_html( $tagline ); ?></p><?php endif; ?>
                <p>Nơi những câu hỏi tìm được lời đáp, những trải nghiệm tìm được người lắng nghe.</p>
            </div>
            <nav class="oss-footer-navigation" aria-label="Điều hướng chân trang">
                <h2>Điều hướng</h2>
                <ul>
                    <?php foreach ( oss_community_nav_items() as $item ) : ?>
                        <li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo esc_html( $item['label'] ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="oss-footer-updates">
                <h2>Cùng góp một câu chuyện</h2>
                <p>Một câu hỏi nhỏ cũng có thể mở ra một cuộc trò chuyện hay.</p>
                <a class="oss-text-link" href="<?php echo esc_url( oss_community_nav_items()[1]['url'] ); ?>">Khám phá diễn đàn ↗</a>
            </div>
        </div>
        <div class="oss-footer-bottom">
            <span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( $site_name ); ?></span>
            <span>Chia sẻ điều bạn biết. Kết nối điều bạn cần.</span>
        </div>
    </footer>
</div><!-- #page -->
<a href="#" class="badoblog-css-scrollup"><span class="screen-reader-text">Lên đầu trang</span></a>
<?php wp_footer(); ?>
</body>
</html>
