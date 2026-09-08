/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Code snippets Twenty Twenty theme
* Source: https://wordpress.org/themes/twenty1twenty/
* @package Bado Blog
* Description: Top search
* ------------------------------------------------------------------------------ */

"use strict";

/*	-----------------------------------------------------------------------------------------------
	Namespace
--------------------------------------------------------------------------------------------------- */

var badoblog = badoblog || {};

// Set a default value for scrolled.
badoblog.scrolled = 0;

// polyfill closest
// https://developer.mozilla.org/en-US/docs/Web/API/Element/closest#Polyfill
if ( ! Element.prototype.closest ) {
	Element.prototype.closest = function( s ) {
		var el = this;

		do {
			if ( el.matches( s ) ) {
				return el;
			}

			el = el.parentElement || el.parentNode;
		} while ( el !== null && el.nodeType === 1 );

		return null;
	};
}

// polyfill forEach
// https://developer.mozilla.org/en-US/docs/Web/API/NodeList/forEach#Polyfill
if ( window.NodeList && ! NodeList.prototype.forEach ) {
	NodeList.prototype.forEach = function( callback, thisArg ) {
		var i;
		var len = this.length;

		thisArg = thisArg || window;

		for ( i = 0; i < len; i++ ) {
			callback.call( thisArg, this[ i ], i, this );
		}
	};
}

// event "polyfill"
badoblog.createEvent = function( eventName ) {
	var event;
	if ( typeof window.Event === 'function' ) {
		event = new Event( eventName );
	} else {
		event = document.createEvent( 'Event' );
		event.initEvent( eventName, true, false );
	}
	return event;
};

// matches "polyfill"
// https://developer.mozilla.org/es/docs/Web/API/Element/matches
if ( ! Element.prototype.matches ) {
	Element.prototype.matches =
		Element.prototype.matchesSelector ||
		Element.prototype.mozMatchesSelector ||
		Element.prototype.msMatchesSelector ||
		Element.prototype.oMatchesSelector ||
		Element.prototype.webkitMatchesSelector ||
		function( s ) {
			var matches = ( this.document || this.ownerDocument ).querySelectorAll( s ),
				i = matches.length;
			while ( --i >= 0 && matches.item( i ) !== this ) {}
			return i > -1;
		};
}

// Add a class to the body for when touch is enabled for browsers that don't support media queries
// for interaction media features. Adapted from <https://codepen.io/Ferie/pen/vQOMmO>.
badoblog.touchEnabled = {

	init: function() {
		var matchMedia = function() {
			// Include the 'heartz' as a way to have a non-matching MQ to help terminate the join. See <https://git.io/vznFH>.
			var prefixes = [ '-webkit-', '-moz-', '-o-', '-ms-' ];
			var query = [ '(', prefixes.join( 'touch-enabled),(' ), 'heartz', ')' ].join( '' );
			return window.matchMedia && window.matchMedia( query ).matches;
		};

		if ( ( 'ontouchstart' in window ) || ( window.DocumentTouch && document instanceof window.DocumentTouch ) || matchMedia() ) {
			document.body.classList.add('touch-enabled');
		}
	}
};

/*	-----------------------------------------------------------------------------------------------
	Cover Modals
--------------------------------------------------------------------------------------------------- */

badoblog.coverModalsSearch = {

	init: function() {
		if (document.querySelector('.badoblog-css-cover-search')) {
			// Handle cover modals when they're toggled.
			this.onToggle();

			// When toggled, untoggle if visitor clicks on the wrapping element of the modal.
			this.outsideUntoggle();

			// Close on escape key press.
			this.closeOnEscape();

			// Hide and show modals before and after their animations have played out.
			this.hideAndShowModals();
		}
	},

	// Handle cover modals when they're toggled.
	onToggle: function() {
		document.querySelectorAll('.badoblog-css-cover-search').forEach( function( element ) {
			element.addEventListener( 'toggled-search', function( event ) {
				var modal = event.target,
					body = document.body;

				if ( modal.classList.contains('active-search') ) {
					body.classList.add('showing-modal-search');
				} else {
					body.classList.remove('showing-modal-search');
					body.classList.add('hiding-modal-search');

					// Remove the hiding class after a delay, when animations have been run.
					setTimeout( function() {
						body.classList.remove('hiding-modal-search');
					}, 500 );
				}
			} );
		} );
	},

	// Close modal on outside click.
	outsideUntoggle: function() {
		document.addEventListener('click', function(event) {
			var target = event.target;
			var modal = document.querySelector('.badoblog-css-cover-search.active-search');

			// if target onclick is <a> with # within the href attribute
			if ( event.target.tagName.toLowerCase() === 'a' && event.target.hash.includes('#') && modal !== null ) {
				// untoggle the modal
				this.untoggleModal( modal );
				// wait 550 and scroll to the anchor
				setTimeout( function() {
					var anchor = document.getElementById( event.target.hash.slice( 1 ) );
					anchor.scrollIntoView();
				}, 550 );
			}

			if ( target === modal ) {
				this.untoggleModal( target );
			}
		}.bind( this ) );
	},

	// Close modal on escape key press.
	closeOnEscape: function() {
		document.addEventListener('keydown', function(event) {
			if (event.keyCode === 27) {
				event.preventDefault();
				document.querySelectorAll('.badoblog-css-cover-search.active-search').forEach( function(element) {
					this.untoggleModal(element);
				}.bind(this));
			}
		}.bind(this));
	},

	// Hide and show modals before and after their animations have played out.
	hideAndShowModals: function() {
		var _doc = document,
			_win = window,
			modals = _doc.querySelectorAll('.badoblog-css-cover-search'),
			htmlStyle = _doc.documentElement.style;

		function htmlStyles() {
			var overflow = _win.innerHeight > _doc.documentElement.getBoundingClientRect().height;
			return {
				'overflow-y': overflow ? 'hidden' : 'scroll',
				position: 'fixed',
				width: '100%',
				top: 0,
				left: 0
			};
		}

		// Show the modal.
		modals.forEach( function(modal) {
			modal.addEventListener( 'toggle-target-before-inactive-search', function(event) {
				var styles = htmlStyles();

				if (event.target !== modal) {
					return;
				}

				Object.keys( styles ).forEach( function( styleKey ) {
					htmlStyle.setProperty( styleKey, styles[ styleKey ] );
				} );

				_win.badoblog.scrolled = parseInt( styles.top, 10 );

				modal.classList.add('show-search-modal');
			} );

			// Hide the modal after a delay, so animations have time to play out.
			modal.addEventListener('toggle-target-after-inactive-search', function(event) {
				if ( event.target !== modal ) {
					return;
				}

				setTimeout( function() {
					var clickedEl = badoblog.togglessearch.clickedEl;

					modal.classList.remove('show-search-modal');

					Object.keys(htmlStyles()).forEach( function(styleKey) {
						htmlStyle.removeProperty(styleKey);
					});

					if (clickedEl !== false) {
						clickedEl.focus();
						clickedEl = false;
					}

					_win.scrollTo(0, Math.abs(_win.badoblog.scrolled));

					_win.badoblog.scrolled = 0;
				}, 500 );
			} );
		} );
	},

	// Untoggle a modal.
	untoggleModal: function( modal ) {
		var modalTargetClass,
			modalToggle = false;

		// If the modal has specified the string (ID or class) used by toggles to target it, untoggle the toggles with that target string.
		// The modal-target-string must match the string toggles use to target the modal.
		if (modal.dataset.modalTargetString) {
			modalTargetClass = modal.dataset.modalTargetString;
			modalToggle = document.querySelector('*[data-toggle-target="' + modalTargetClass + '"]');
		}

		// If a modal toggle exists, trigger it so all of the toggle options are included.
		if (modalToggle) {
			modalToggle.click();

			// If one doesn't exist, just hide the modal.
		} else {
			modal.classList.remove('active-search');
		}
	}

};

/*	-----------------------------------------------------------------------------------------------
	Intrinsic Ratio Embeds
--------------------------------------------------------------------------------------------------- */

badoblog.intrinsicRatioVideos = {

	init: function() {
		this.makeFit();

		window.addEventListener( 'resize', function() {
			this.makeFit();
		}.bind( this ) );
	},

	makeFit: function() {
		document.querySelectorAll( 'iframe, object, video' ).forEach( function( video ) {
			var ratio, iTargetWidth,
				container = video.parentNode;

			// Skip videos we want to ignore.
			if ( video.classList.contains( 'intrinsic-ignore' ) || video.parentNode.classList.contains( 'intrinsic-ignore' ) ) {
				return true;
			}

			if ( ! video.dataset.origwidth ) {
				// Get the video element proportions.
				video.setAttribute( 'data-origwidth', video.width );
				video.setAttribute( 'data-origheight', video.height );
			}

			iTargetWidth = container.offsetWidth;

			// Get ratio from proportions.
			ratio = iTargetWidth / video.dataset.origwidth;

			// Scale based on ratio, thus retaining proportions.
			video.style.width = iTargetWidth + 'px';
			video.style.height = ( video.dataset.origheight * ratio ) + 'px';
		} );
	}

};

/*	-----------------------------------------------------------------------------------------------
	Modal
--------------------------------------------------------------------------------------------------- */
badoblog.modalPlus = {

	init: function() {
		this.keepFocusInModal();
	},

	keepFocusInModal: function() {
		var _doc = document;

		_doc.addEventListener('keydown', function(event) {
			var toggleTarget, modal, selectors, elements, activeEl, lastEl, firstEl, tabKey, shiftKey,
				clickedEl = badoblog.togglessearch.clickedEl;

			if ( clickedEl && _doc.body.classList.contains( 'showing-modal-search' ) ) {
				toggleTarget = clickedEl.dataset.toggleTarget;
				selectors = 'input, a, button';
				modal = _doc.querySelector( toggleTarget );

				elements = modal.querySelectorAll( selectors );
				elements = Array.prototype.slice.call( elements );

				lastEl = elements[ elements.length - 1 ];
				firstEl = elements[0];
				activeEl = _doc.activeElement;
				tabKey = event.keyCode === 9;
				shiftKey = event.shiftKey;

				if ( ! shiftKey && tabKey && lastEl === activeEl ) {
					event.preventDefault();
					firstEl.focus();
				}

				if ( shiftKey && tabKey && firstEl === activeEl ) {
					event.preventDefault();
					lastEl.focus();
				}
			}
		} );
	}
};

/*	-----------------------------------------------------------------------------------------------
Toggles
--------------------------------------------------------------------------------------------------- */

badoblog.togglessearch = {

	clickedEl: false,

	init: function() {
		// Do the toggle.
		this.toggle();

		// Check for toggle/untoggle on resize.
		this.resizeCheck();

		// Check for untoggle on escape key press.
		this.untoggleOnEscapeKeyPress();
	},

	performToggle: function(element, instantly) {
		var target, timeOutTime, classToToggle,
			self = this,
			_doc = document,
			// Get our targets.
			toggle = element,
			targetString = toggle.dataset.toggleTarget,
			activeClass = 'active-search';

		// Elements to focus after modals are closed.
		if ( ! _doc.querySelectorAll('.show-search-modal').length ) {
			self.clickedEl = _doc.activeElement;
		}

		if ( targetString === 'next' ) {
			target = toggle.nextSibling;
		} else {
			target = _doc.querySelector( targetString );
		}

		// Trigger events on the toggle targets before they are toggled.
		if ( target.classList.contains(activeClass)) {
			target.dispatchEvent(badoblog.createEvent('toggle-target-before-active-search'));
		} else {
			target.dispatchEvent(badoblog.createEvent('toggle-target-before-inactive-search'));
		}

		// Get the class to toggle, if specified.
		classToToggle = toggle.dataset.classToToggle ? toggle.dataset.classToToggle : activeClass;

		// For cover modals, set a short timeout duration so the class animations have time to play out.
		timeOutTime = 0;

		if (target.classList.contains('badoblog-css-cover-search')) {
			timeOutTime = 10;
		}

		setTimeout( function() {
			var focusElement,
				subMenued = target.classList.contains('cover-clear'),
				newTarget = subMenued ? toggle.closest('.cover-clear').querySelector('.cover-clear') : target,
				duration = toggle.dataset.toggleDuration;

			// Toggle the target of the clicked toggle.
			if (toggle.dataset.toggleType === 'slidetoggle' && ! instantly && duration !== '0') {
				badoblogMenuToggle( newTarget, duration );
			} else {
				newTarget.classList.toggle( classToToggle );
			}

			// If the toggle target is 'next', only give the clicked toggle the active class.
			if ( targetString === 'next' ) {
				toggle.classList.toggle( activeClass );
			} else if (target.classList.contains('cover-clear')) {
				toggle.classList.toggle( activeClass );
			} else {
				// If not, toggle all toggles with this toggle target.
				_doc.querySelector('*[data-toggle-target="' + targetString + '"]').classList.toggle(activeClass);
			}

			// Toggle aria-expanded on the toggle.
			badoblogToggleAttribute(toggle, 'aria-expanded', 'true', 'false');

			if (self.clickedEl && -1 !== toggle.getAttribute('class').indexOf('close-')) {
				badoblogToggleAttribute(self.clickedEl, 'aria-expanded', 'true', 'false');
			}

			// Toggle body class.
			if (toggle.dataset.toggleBodyClassSearch) {
				_doc.body.classList.toggle(toggle.dataset.toggleBodyClassSearch);
			}

			// Check whether to set focus.
			if (toggle.dataset.setFocus) {
				focusElement = _doc.querySelector(toggle.dataset.setFocus);

				if (focusElement) {
					if (target.classList.contains(activeClass)) {
						focusElement.focus();
					} else {
						focusElement.blur();
					}
				}
			}

			// Trigger the toggled event on the toggle target.
			target.dispatchEvent( badoblog.createEvent( 'toggled-search' ) );

			// Trigger events on the toggle targets after they are toggled.
			if ( target.classList.contains( activeClass ) ) {
				target.dispatchEvent( badoblog.createEvent( 'toggle-target-after-active-search' ) );
			} else {
				target.dispatchEvent( badoblog.createEvent( 'toggle-target-after-inactive-search' ) );
			}
		}, timeOutTime );
	},

	// Do the toggle.
	toggle: function() {
		var self = this;

		document.querySelectorAll( '*[data-toggle-target]' ).forEach( function( element ) {
			element.addEventListener( 'click', function( event ) {
				event.preventDefault();
				self.performToggle( element );
			});
		});
	},

	// Check for toggle/untoggle on screen resize.
	resizeCheck: function() {
		if ( document.querySelectorAll( '*[data-untoggle-above], *[data-untoggle-below], *[data-toggle-above], *[data-toggle-below]' ).length ) {
			window.addEventListener( 'resize', function() {
				var winWidth = window.innerWidth,
					togglessearch = document.querySelectorAll( '.toggle-search' );

				togglessearch.forEach( function( toggle ) {
					var unToggleAbove = toggle.dataset.untoggleAbove,
						unToggleBelow = toggle.dataset.untoggleBelow,
						toggleAbove = toggle.dataset.toggleAbove,
						toggleBelow = toggle.dataset.toggleBelow;

					// If no width comparison is set, continue.
					if ( ! unToggleAbove && ! unToggleBelow && ! toggleAbove && ! toggleBelow ) {
						return;
					}

					// If the toggle width comparison is true, toggle the toggle.
					if (
						( ( ( unToggleAbove && winWidth > unToggleAbove ) ||
							( unToggleBelow && winWidth < unToggleBelow ) ) &&
							toggle.classList.contains( 'active-search' ) ) ||
						( ( ( toggleAbove && winWidth > toggleAbove ) ||
							( toggleBelow && winWidth < toggleBelow ) ) &&
							! toggle.classList.contains( 'active-search' ) )
					) {
						toggle.click();
					}
				} );
			} );
		}
	},

	// Close toggle on escape key press.
	untoggleOnEscapeKeyPress: function() {
		document.addEventListener( 'keyup', function( event ) {
			if ( event.key === 'Escape' ) {
				document.querySelectorAll( '*[data-untoggle-on-escape].active-search' ).forEach( function( element ) {
					if ( element.classList.contains( 'active-search' ) ) {
						element.click();
					}
				} );
			}
		} );
	}

};



/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @since Twenty Twenty 1.0
 *
 * @param {Function} fn Callback function to run.
 */
function badoblogDomReady( fn ) {
	if ( typeof fn !== 'function' ) {
		return;
	}

	if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
		return fn();
	}

	document.addEventListener( 'DOMContentLoaded', fn, false );
}

badoblogDomReady( function() {
	badoblog.togglessearch.init();              // Handle toggles.
	badoblog.coverModalsSearch.init();          // Handle cover modals.
	badoblog.intrinsicRatioVideos.init(); // Retain aspect ratio of videos on window resize.
	badoblog.modalPlus.init();            // Modal Menu.
	badoblog.touchEnabled.init();         // Add class to body if device is touch-enabled.
} );

/*	-----------------------------------------------------------------------------------------------
	Helper functions
--------------------------------------------------------------------------------------------------- */

/* Toggle an attribute ----------------------- */

function badoblogToggleAttribute( el, atr, trueV, falseV ) {
	var togglessearch;

	if ( ! el.hasAttribute( atr ) ) {
		return;
	}

	if ( trueV === undefined ) {
		trueV = true;
	}
	if ( falseV === undefined ) {
		falseV = false;
	}

	/*
	 * Take into account multiple toggle elements that need their state to be
	 * synced. For example: the Search toggle buttons for desktop and mobile.
	 */
	togglessearch = document.querySelectorAll( '[data-toggle-target="' + el.dataset.toggleTarget + '"]' );

	togglessearch.forEach( function( toggle ) {
		if ( ! toggle.hasAttribute( atr ) ) {
			return;
		}

		if ( toggle.getAttribute( atr ) !== trueV ) {
			toggle.setAttribute( atr, trueV );
		} else {
			toggle.setAttribute( atr, falseV );
		}
	} );
}


/**
 * Traverses the DOM up to find elements matching the query.
 */
function badoblogFindParents( target, query ) {
	var parents = [];

	// Recursively go up the DOM adding matches to the parents array.
	function traverse( item ) {
		var parent = item.parentNode;
		if ( parent instanceof HTMLElement ) {
			if ( parent.matches( query ) ) {
				parents.push( parent );
			}
			traverse( parent );
		}
	}

	traverse( target );

	return parents;
}


