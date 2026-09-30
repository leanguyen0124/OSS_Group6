<?php
/** Child header: search and navigation are separate sticky siblings. */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="screen-reader-text skip-link" href="#main">Bỏ qua để đến nội dung</a>
    <div class="oss-sticky-topbar">
        <div class="badoblog-css-top-bar badoblog-css-clear">
            <?php badoblog_fun_top_date(); ?>
            <div class="badoblog-css-top-menu">
                <?php badoblog_fun_top_soc_search(); ?>
                <?php get_template_part( 'inc/module/top-menu' ); ?>
            </div>
        </div>
        <span class="oss-brand-rounding" aria-hidden="true"></span>
    </div>
    <?php if ( is_front_page() ) : ?>
        <header id="site-header" class="badoblog-css-site-header">
            <div class="badoblog-css-site-branding">
                <div class="badoblog-css-site-brand-bottom">
                    <div class="badoblog-css-site-brand-bottom-1">
                        <div class="badoblog-css-site-brand-bottom-box">
                            <div class="badoblog-css-site-title-box">
                                <h1 class="badoblog-css-site-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></h1>
                                <?php if ( get_bloginfo( 'description' ) ) : ?>
                                    <p class="badoblog-css-site-description"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    <?php endif; ?>
    <div class="oss-sticky-nav">
        <?php get_template_part( 'inc/module/main-menu' ); ?>
    </div>
    <div id="content" class="badoblog-css-site-content">
