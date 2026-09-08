<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Support WooCommerce - Pages: Shop, product categories, product page
* ------------------------------------------------------------------------------ */
get_header();
?>
<div id="primary" class="badoblog-css-content-area">
	<main id="main" class="badoblog-css-site-main">
		<?php 
// Content WooCommerce
woocommerce_content();
?>
	</main>
</div>
<?php 
badoblog_fun_sidebar_select();
get_footer();