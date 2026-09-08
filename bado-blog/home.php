<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Main page with latest posts and favorites
* ------------------------------------------------------------------------------ */
get_header();
?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<?php 
if ( !is_front_page() ) {
    ?>
			<header>
				<h1 class="badoblog-css-page-title"><?php 
    single_post_title();
    ?></h1>
			</header>
			<?php 
}
do_action( 'badoblog_hook_after_main_common' );
?>
	</main>
</div>
<?php 
badoblog_fun_sidebar_select();
get_footer();