<?php
/** Community navigation shared by the home, forum and member panels. */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$items = oss_community_nav_items();
?>
<div id="mega-menu-box" class="badoblog-css-mega-menu-box">
    <div id="site-navigation" class="badoblog-css-mega-menu-container">
        <nav class="badoblog-css-mega-menu" aria-label="Điều hướng chính">
            <ul class="menu">
                <?php foreach ( $items as $item ) : ?>
                    <li class="menu-item<?php echo $item['active'] ? ' current-menu-item' : ''; ?>">
                        <a href="<?php echo esc_url( $item['url'] ); ?>"<?php echo $item['active'] ? ' aria-current="page"' : ''; ?>><?php echo esc_html( $item['label'] ); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</div>
