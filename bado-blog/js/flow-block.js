/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Calm blocks (Fluently movement of blocks)
* ------------------------------------------------------------------------------ */

'use strict';

function onFlow(flow) {

	flow.forEach(change => {
	  if (change.isIntersecting) {
		change.target.classList.add('badoblog-css-show-block');
	  }
	});
}

let opt = {threshold: [0.1]};
let obs = new IntersectionObserver(onFlow, opt);
let el = document.querySelectorAll(' \
	.badoblog-css-owl-width-slider, \
	.badoblog-css-menucat-box, \
	.badoblog-css-cat-grid, \
	.badoblog-css-home-narrow-grid-column, \
	.badoblog-css-home-vertical-grid-post-first, \
	.badoblog-css-home-vertical-grid-post-small, \
	[class^="badoblog-css-home-three-grid-main-"], \
	[class^="badoblog-css-home-five-grid-main-"], \
	[class^="badoblog-css-home-slide-big-main-"], \
	[class^="badoblog-css-home-slide-mid-partial-main-"], \
	[class^="badoblog-css-home-slide-mid-two-main-"], \
	[class^="badoblog-css-home-slide-mid-three-main-"]'
);
for (let e of el) {
	obs.observe(e);
}
