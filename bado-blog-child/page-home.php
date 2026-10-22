<?php
/** Community home, separate from the welcome route. */
get_header();
?>
<div id="primary" class="badoblog-css-content-area"><main id="main" class="badoblog-css-site-main">
<?php get_template_part( 'template-parts/home/home-article' ); ?>
</main></div>
<?php get_footer(); ?>
