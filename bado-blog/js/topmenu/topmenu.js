/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* @package Bado Blog
* Description: Pin top menu
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function ($) {

  "use strict";
  
  // Common
  $(".badoblog-css-top-jsmenu-box ul li a").on("focus", function() {
    $(this).parents("li").addClass("focused");
  }).on("blur", function() {
    $(this).parents("li").removeClass("focused");
  });

  // Mobile
  if ($(window).width() < 684) {

    $(".badoblog-css-top-jsmenu-mobile .menu-item-has-children").find("> a").after('<button class="submenu-toggle"></button>');
    $(".badoblog-css-toggle-btn").on("click", function() {
      $(".badoblog-css-top-jsmenu-mobile").animate({
          width: "toggle"
      });
    });
    $(".badoblog-css-top-jsmenu-mobile .badoblog-css-btn-close-menu").on("click", function() {
      $(".badoblog-css-top-jsmenu-mobile").animate({
          width: "toggle"
      });
    });
    $(".badoblog-css-top-jsmenu-mobile .submenu-toggle").on("click", function() {
      $(this).toggleClass("active");
      $(this).siblings(".sub-menu").stop(!0, !1, !0).slideToggle();
    });

    // PC
  } else {

    // Orientation of drop-down menus if there is not enough space on the screen
    $('.badoblog-css-nav-top-jsmenu > .menu-item-has-children').on('mouseenter', function() {
      const $dropMenu1 = $(this).find('.sub-menu');
      const $rectMenu1 = $dropMenu1[0].getBoundingClientRect();
      if ($rectMenu1.left < 0) {
        $dropMenu1.css('left', '0');
      }
    });
    $('.badoblog-css-nav-top-jsmenu > .menu-item-has-children > .sub-menu > .menu-item-has-children').on('mouseenter', function() {
      const $dropMenu2 = $(this).find('.sub-menu');
      const $rectMenu2 = $dropMenu2[0].getBoundingClientRect();
      const $parentMenu = $(this).closest('.sub-menu');
      const $rectParentMenu = $parentMenu[0].getBoundingClientRect();
      const $widthParentMenu = $parentMenu.innerWidth();
      if ($rectMenu2.left < $widthParentMenu && $rectParentMenu.left < $widthParentMenu) {
        $dropMenu2.css('left', '100%');
      }
    });

  }

});


