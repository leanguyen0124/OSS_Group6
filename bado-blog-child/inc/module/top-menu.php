<?php
/**
 * Account controls beside the parent theme's top-bar search button.
 * This child template replaces the parent's category fallback.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( has_nav_menu( 'badoblog-loc-menu-top' ) ) {
    wp_nav_menu( array(
        'theme_location' => 'badoblog-loc-menu-top',
        'container'      => 'nav',
        'container_class' => 'oss-top-navigation',
        'fallback_cb'    => false,
        'depth'          => 1,
    ) );
}

?>
<a class="oss-sticky-cat" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' – Trang chủ' ); ?>" tabindex="-1" aria-hidden="true">
    <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/cat-outline.svg' ); ?>" alt="" width="34" height="34">
</a>
<?php

if ( is_user_logged_in() ) :
    $user             = wp_get_current_user();
    $user_id          = (int) $user->ID;
    $profile_url      = function_exists( 'bp_loggedin_user_domain' ) ? bp_loggedin_user_domain() : get_edit_profile_url( $user_id );
    $notifications_url = function_exists( 'bp_get_notifications_unread_permalink' )
        ? bp_get_notifications_unread_permalink( $user_id )
        : $profile_url;
    $unread_count     = function_exists( 'bp_notifications_get_unread_notification_count' )
        ? (int) bp_notifications_get_unread_notification_count( $user_id )
        : 0;
    ?>
    <nav class="oss-top-account" aria-label="Tài khoản">
        <a class="oss-top-notifications" href="<?php echo esc_url( $notifications_url ); ?>" aria-label="<?php echo esc_attr( sprintf( 'Thông báo: %d chưa đọc', $unread_count ) ); ?>">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9ZM10 21h4"/></svg>
            <span class="oss-top-notification-count"><?php echo esc_html( (string) $unread_count ); ?></span>
        </a>
        <details class="oss-top-user">
            <summary>
                <span><?php echo esc_html( 'Chào, ' . $user->display_name ); ?></span>
                <?php echo get_avatar( $user_id, 30, '', '', array( 'extra_attr' => 'loading="lazy"' ) ); ?>
            </summary>
            <div class="oss-top-user-menu">
                <a href="<?php echo esc_url( $profile_url ); ?>">Trang cá nhân</a>
                <?php if ( current_user_can( 'read' ) ) : ?>
                    <a href="<?php echo esc_url( admin_url() ); ?>">Bảng quản trị</a>
                <?php endif; ?>
                <a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>">Đăng xuất</a>
            </div>
        </details>
    </nav>
<?php else : ?>
    <nav class="oss-top-account" aria-label="Tài khoản">
        <a class="oss-top-login" href="<?php echo esc_url( wp_login_url( home_url( '/' ) ) ); ?>">Đăng nhập</a>
        <?php if ( get_option( 'users_can_register' ) ) : ?>
            <a class="oss-top-login" href="<?php echo esc_url( wp_registration_url() ); ?>">Đăng ký</a>
        <?php endif; ?>
    </nav>
<?php endif; ?>
