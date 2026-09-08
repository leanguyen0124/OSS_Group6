/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: List ol correction
* ------------------------------------------------------------------------------ */


jQuery(function($) {

	'use strict';

	$('ol[start]').each(function() {
		var val = parseFloat($(this).attr("start")) - 1;
		$(this).css('counter-increment','Count-N '+ val);
	});

	$('ol[reversed]').each(function() {
		$(this).css({
			'display':'flex',
			'flex-direction': 'column-reverse'
		});
	});

});