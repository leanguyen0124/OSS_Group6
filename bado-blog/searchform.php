<?php
/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Search form
* ------------------------------------------------------------------------------ */

?>
<form class="search-form" action="<?php echo esc_url(home_url('/')); ?>" method="get">
	<div class="search-wrap">
		<input type="text" name="s">
	</div>
	<button class="search-icon" type="submit"></button>
</form>