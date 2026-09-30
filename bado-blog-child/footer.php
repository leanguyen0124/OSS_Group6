<?php
/** Community footer. */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description' );
?>
    </div><!-- #content -->
    <?php if ( function_exists( 'bp_is_user' ) && bp_is_user() ) : ?>
    <footer id="colophon" class="oss-footer" aria-label="Chân trang">
        <div class="oss-footer-grid">
            <div class="oss-footer-brand">
                <a class="oss-footer-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/cat-outline.svg' ); ?>" width="72" height="72" alt="">
                    <span><?php echo esc_html( $site_name ); ?></span>
                </a>
                <?php if ( $tagline ) : ?><p class="oss-footer-tagline"><?php echo esc_html( $tagline ); ?></p><?php endif; ?>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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
                <h2>Cập nhật cộng đồng</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="oss-footer-placeholder" aria-label="Nội dung nhận tin đang chờ cập nhật">
                    <span>Lorem ipsum</span>
                    <span aria-hidden="true">↗</span>
                </div>
            </div>
        </div>
        <div class="oss-footer-bottom">
            <span>© <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( $site_name ); ?></span>
            <span>Theme Bado Blog</span>
        </div>
    </footer>
    <?php endif; ?>
</div><!-- #page -->
<a href="#" class="badoblog-css-scrollup"><span class="screen-reader-text">Lên đầu trang</span></a>
<?php wp_footer(); ?>
</body>
</html>
