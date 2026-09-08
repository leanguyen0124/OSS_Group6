<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Support for bbPress 
* ------------------------------------------------------------------------------ */
get_header();
?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<?php 
while ( have_posts() ) {
    the_post();
    ?>
			<article id="post-<?php 
    the_ID();
    ?>" <?php 
    post_class();
    ?>>

				<?php 
    do_action( 'badoblog_hook_before_bbpress_title' );
    ?>

				<header class="badoblog-css-page-header-default">
					<?php 
    if ( !is_front_page() ) {
        the_title( '<h1 class="badoblog-css-page-title">', '</h1>' );
    }
    ?>
				</header>
			
				<?php 
    do_action( 'badoblog_hook_after_bbpress_title' );
    ?>
			
				<div class="badoblog-css-page-content">
					<?php 
    the_content();
    ?>
				</div>

			</article>
		<?php 
}
do_action( 'badoblog_hook_after_bbpress' );
?>
	</main>
</div>
<?php 
if ( get_theme_mod( 'badoblog_cus_bbpress_sidebar', 0 ) != 1 ) {
    badoblog_fun_sidebar_select();
}
get_footer();