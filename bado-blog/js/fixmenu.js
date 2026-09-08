/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* @package Bado Blog
* Description: Pin main menu
* ------------------------------------------------------------------------------ */


jQuery(function($) {

	'use strict';

	if ($(window).width() > 843) { // This is 860

		let menuHeight = $('#mega-menu-box').height();

		// Scroll function
		$(window).scroll(function() {

			let topScroll = $(document).scrollTop();
			let headerHeight = $('#site-header').height();
			let topMenu = headerHeight + 200; // Take away the indents

			// Fix menu
			if (topScroll > topMenu) {

				// Maintain the height of the landing site to prevent the layout from jerking
				$("#mega-menu-box").css({height: menuHeight});

				// Add class for enable fixed menu
				$("#site-navigation").addClass("badoblog-css-fix-main-menu");

				// Check admin bar
				let adminMenu = $('#wpadminbar').length;
				if (adminMenu == true) {
					// Add height admin bar for fix menu
					let adminHeight = $('#wpadminbar').height();
					$("#site-navigation").css({top: adminHeight});
				}

			// Return to default
			} else {
				
				// Del class for del fixed menu
				$("#site-navigation").removeClass("badoblog-css-fix-main-menu");

			}

		});


		// Overflow protection
		function sizeOverflow() {
			let menuArea = $('.badoblog-css-mega-menu > ul > li.menuhover > .sub-menu, .badoblog-css-mega-menu > ul > li.focused .sub-menu');
			let menuAreaTrue = $(menuArea).length;
			if (menuAreaTrue == true) {
				var hSite = $(window).height();
				let hMenuArea = $(menuArea).height();
				var hMenuAreaNew = hMenuArea + menuHeight;
				if (hMenuAreaNew > hSite) {
					var hSiteArea = hSite - menuHeight - 100;
					$(menuArea).css({height: hSiteArea, "overflow-y": 'auto'});
				}
				$('#site-navigation').addClass("badoblog-css-scroll-main-menu");
			} else {
				$("#site-navigation").removeClass("badoblog-css-scroll-main-menu");
			}
		}

		// hover
		$(".badoblog-css-mega-menu > ul > li").hover(
			function () {
				setTimeout(sizeOverflow, 200);
			}
		);

		// touchstart + click
		$(".badoblog-css-mega-menu > ul > li").on("touchstart click", function (e) {
			e.stopPropagation();
			setTimeout(sizeOverflow, 200);
		});

	}

});