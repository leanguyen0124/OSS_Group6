/* 
- Name: megamenu.js
- Version: 1.0
- Latest update: 29.01.2016.
- Author: Mario Loncarek
- Author web site: http://marioloncarek.com
- Author github: https://github.com/marioloncarek/megamenu-js
- Licensed under: SEE LICENSE IN https://github.com/marioloncarek/megamenu-js/blob/master/licence.md
- Modification by DMCWebZone, https://web-zone.org
*/


/* global $ */
jQuery(document).ready(function ($) {

    "use strict";

    // Checks if li has sub (ul) and adds class for toggle icon - just an UI
    $('.badoblog-css-mega-menu > ul > li:has( > ul)').addClass('badoblog-css-mega-menu-dropdown-icon');
    
    // Checks if drodown badoblog-css-mega-menu's li elements have anothere level (ul), 
    // if not the dropdown is shown as regular dropdown, not a mega badoblog-css-mega-menu (thanks Luka Kladaric)
    $('.badoblog-css-mega-menu > ul > li > ul:not(:has(ul))').addClass('normal-sub');

    // Checks if drodown badoblog-css-mega-menu's for icon
    $('.badoblog-css-mega-menu > ul > li > a:not(:has(ul))').addClass('normal-sub-for-icon');
    
    // Only Mobile
    if ($(window).width() < 843) { // This is 860

        const titleMobile = badoblog_localize_megamenu.title_mobile;
        $(".badoblog-css-mega-menu > ul").before('<a href=\"#\" class=\"badoblog-css-mega-menu-mobile\">' + titleMobile + '</a>');

        // when clicked on mobile-badoblog-css-mega-menu, normal badoblog-css-mega-menu is shown as a list
        $(".badoblog-css-mega-menu-mobile").click(function (e) {
            $(".badoblog-css-mega-menu > ul").toggleClass('show-on-mobile');
            e.preventDefault();
        });

        $(".badoblog-css-mega-menu > ul > li").click(function() {
            const thismegamenu = $(this).children("ul");
            const prevState = thismegamenu.css('display');
            if (prevState !== 'block') {
                thismegamenu.fadeIn(150);
                // Mobile drop icon
                $(this).addClass("active");
            } else {
                thismegamenu.fadeOut(100);
                $(this).removeClass("active");
            }
        });

    } else { // Only PC

        // Orientation of drop-down menus if there is not enough space on the screen
        $('.badoblog-css-mega-menu > ul > .menu-item-has-children').on('mouseenter', function() {
            const $dropMenu = $(this).find('.normal-sub');
            const $rectItemMenu = $(this)[0].getBoundingClientRect();
            const $widthMenu = $dropMenu.innerWidth();
            const $maxMenu = $rectItemMenu.left + $widthMenu;
            if ($maxMenu > $(window).width()) {
                $dropMenu.css('right', '0');
            }
        });

    }

    // Adds badoblog-css-mega-menu-mobile class (for mobile toggle badoblog-css-mega-menu) before the normal badoblog-css-mega-menu
    // Mobile badoblog-css-mega-menu is hidden if width is more then 959px, but normal badoblog-css-mega-menu is displayed
    // Normal badoblog-css-mega-menu is hidden if width is below 959px, and jquery adds mobile badoblog-css-mega-menu
    // Done this way so it can be used with WordPress without any trouble

    // Only PC
    let MenuShowTimer;
    $(".badoblog-css-mega-menu > ul > li").hover(
        function (e) {
            if ($(window).width() > 843) {
                MenuShowTimer = setTimeout(
                    (function (Obj) {
                        return function () {
                            $(Obj).addClass("menuhover");
                            $(Obj).children("ul").css("display", "flex").hide().fadeIn(100);
                            e.preventDefault();
                        };
                    })(this), 200
                );
            }
        }, function (e) {
            if ($(window).width() > 843) {
                clearTimeout(MenuShowTimer);
                $(this).removeClass("menuhover");
                $(this).children("ul").fadeOut(100, "swing");
                e.preventDefault();
            }
        }
    );

    // Support focus
    $(".badoblog-css-mega-menu > ul > li > a").on("focus", function() {
        $(".badoblog-css-mega-menu li").removeClass("focused");
        $(this).parents("li").addClass("focused");
    });
    $(".badoblog-css-mega-menu > ul > li:last-child > ul:not(:has(ul)) > li:last-child > a, " +
        ".badoblog-css-mega-menu > ul > li:last-child > ul > li:last-child > ul:not(:has(ul)) > li:last-child > a, " +
        ".badoblog-css-mega-menu > ul > li:last-child > ul > li:last-child > ul > li:last-child > ul:not(:has(ul)) > li:last-child > a").on("blur", function() {
        $(".badoblog-css-mega-menu li").removeClass("focused");
    });

});
