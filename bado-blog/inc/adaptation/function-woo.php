<?php

/* ------------------------------------------------------------------------------
* Author: web-zone.org
* @package Bado Blog
* Description: Functions for WooCommerce
* ------------------------------------------------------------------------------ */
/*--------------------------------------------------------------
Content:
----------------------------------------------------------------
# Style support WooCommerce
# Ajax support for top menu cart
# Adds a link to the cart to the main menu
# Similar posts
# Popular goods
# Add the inscription "Out of stock" to the product card in the product grid
# Rename inscription - Out of stock
# Function with breadcrumbs
--------------------------------------------------------------*/
//? ========== Style support WooCommerce
function badoblog_fun_set_css_woo() {
    //---------- General colors
    // Primary theme color
    $primary_color = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_small', '#4c65ad' ) );
    // Related elements for the main theme color
    $color_lite = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_small_lite', '#fffffc' ) );
    // Background color of large elements
    $primary_big_color = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_big', '#505062' ) );
    // Related color for large elements
    $primary_big_lite_color = esc_attr( get_theme_mod( 'badoblog_cus_colors_primary_big_lite', '#fffffb' ) );
    //---------- Common colors
    // General link color
    $color_link = '#1e73bb';
    // General link color on hover
    $link_hover = '#dd9925';
    // General text color
    $t_color = '#404040';
    // Site content background color
    $content_color = '#fdfcfc';
    // Breadcrumbs header text color
    $bread_h_color = '';
    // Breadcrumb link text color
    $bread_a_color = '';
    // Breadcrumb link text color on hover
    $bread_a_hover_color = '';
    //---------- Woo colors
    // Product price color
    $price_color = '#16ad00';
    // Sticker color - sale
    $sale_color = '#ea4545';
    // Lettering color - Out of stock
    $ofstock_color = '#a11111';
    //---------- Only used to reassign another "important" in 3rd party plugins
    $i = '!important';
    //---------- Clear
    $css = '';
    //?---------- Buttons
    $css .= '
    .woocommerce-page .woocommerce button.button.alt,
    .woocommerce div.product form.cart .button,
    .woocommerce ul.products li.product .button,
    .woocommerce #review_form #respond .form-submit input,
    .woocommerce .cart .button,
    .woocommerce-page .woocommerce a.button.alt,
    .woocommerce-page .woocommerce a.button,
    .woocommerce-page .woocommerce button.button,
    .woocommerce .woocommerce-message .button,
    .woocommerce-page .woocommerce button.button:disabled[disabled],
    .woocommerce .widget_block input.button,
    .woocommerce .widget_block input.button:hover,
    .wc-block-mini-cart__empty-cart-wrapper .wc-block-mini-cart__shopping-button a:hover,
    a.wc-block-components-button:not(.is-link).outlined:hover,
    div.wp-block-woocommerce-mini-cart-shopping-button-block a,
    div.wp-block-woocommerce-mini-cart-shopping-button-block a:hover,
    a.wc-block-components-button:not(.is-link).contained,
    a.wc-block-components-button:not(.is-link).contained:hover,
    .site button.wp-block-button__link,
    .site a.wp-block-button__link,
    .site .wc-block-components-button:not(.is-link).contained,
    .site .wc-block-components-button:not(.is-link).contained:hover,
    .site .wc-block-components-button:not(.is-link).contained:disabled {
      background: ' . $primary_color . ';
      color: ' . $color_lite . ';
      font-size: 1em;
      font-weight: 400;
      text-align: center;
      border-radius: 30px;
      transition: 0.2s;
      padding: 15px 25px;
    }
    .site a.wp-block-button__link {
      line-height: 1.5;
    }
    .widget_block a.wp-block-button__link,
    .widget_block button.wp-block-button__link {
      line-height: 1;
    }
    .woocommerce-page .woocommerce button.button.alt:hover,
    .woocommerce div.product form.cart .button:hover,
    .woocommerce ul.products li.product .button:hover,
    .woocommerce #review_form #respond .form-submit input:hover,
    .woocommerce .cart .button:hover,
    .woocommerce-page .woocommerce a.button.alt:hover,
    .woocommerce-page .woocommerce a.button:hover,
    .woocommerce-page .woocommerce button.button:hover,
    .woocommerce .woocommerce-message .button:hover,
    .woocommerce-page .woocommerce button.button:disabled[disabled]:hover {
      background: ' . $primary_color . ';
      color: ' . $color_lite . ';
      box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);
    }
    .site div.wp-block-button {
      border-radius: 30px;
      display: inline-block;
    }
    .site .wc-block-components-button:not(.is-link).contained:hover,
    .site div.wp-block-button:hover {
      box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);
    }
    .woocommerce .woocommerce-message .button {
      margin: 10px;
    }
    @media (max-width: 600px) {
      .woocommerce .woocommerce-message .button {
        width: 100%;
        text-align: center;
      }
    }
  ';
    //?---------- Links
    $css .= '
    .site .wc-block-components-checkout-return-to-cart-button {
      color: ' . $color_link . ';
    }
    .site .wc-block-components-checkout-return-to-cart-button:hover {
      color: ' . $link_hover . ';
    }
    .site .woocommerce-info a,
    .site .woocommerce-info a:hover {
      color: ' . $primary_color . ';
    }
  ';
    //?---------- Lines
    $css .= '
    .site .woocommerce-info {
      border-top-color: ' . $primary_color . ';
    }
  ';
    //?---------- Icons
    $css .= '
    .site .woocommerce-info::before {
      color: ' . $primary_color . ';
    }
  ';
    //?---------- Fields
    $css .= '
    .woocommerce input[type="text"],
    .woocommerce input[type="email"],
    .woocommerce input[type="url"],
    .woocommerce input[type="password"],
    .woocommerce input[type="search"],
    .woocommerce input[type="number"],
    .woocommerce input[type="tel"],
    .woocommerce input[type="range"],
    .woocommerce input[type="date"],
    .woocommerce input[type="month"],
    .woocommerce input[type="week"],
    .woocommerce input[type="time"],
    .woocommerce input[type="datetime"],
    .woocommerce input[type="datetime-local"],
    .woocommerce input[type="color"] {
      padding: .48em;
      font-size: 1em;
    }
    .woocommerce input[type="number"] {
      padding: .3em;
      font-size: 1em;
    }
    .comment-form-cookies-consent {
      display: flex;
      align-items: center;
    }
    .woocommerce .woocommerce-form-login label.woocommerce-form-login__rememberme,
    .woocommerce .woocommerce-shipping-fields .woocommerce-form__label,
    .woocommerce form p.form-row label.woocommerce-form__label {
      display: flex;
      align-items: center;
    }
    .woocommerce .woocommerce-form-login label.woocommerce-form-login__rememberme {
      margin-bottom: 10px;
    }
    .wc-block-components-form .wc-block-components-text-input input[type=email],
    .wc-block-components-form .wc-block-components-text-input input[type=number],
    .wc-block-components-form .wc-block-components-text-input input[type=password],
    .wc-block-components-form .wc-block-components-text-input input[type=tel],
    .wc-block-components-form .wc-block-components-text-input input[type=text],
    .wc-block-components-form .wc-block-components-text-input input[type=url],
    .wc-block-components-text-input input[type=email],
    .wc-block-components-text-input input[type=number],
    .wc-block-components-text-input input[type=password],
    .wc-block-components-text-input input[type=tel],
    .wc-block-components-text-input input[type=text],
    .wc-block-components-text-input input[type=url],
    .wc-block-components-textarea,
    .wc-blocks-components-select .wc-blocks-components-select__select,
    .wc-block-components-notice-banner,
    .wc-block-components-address-card {
      border-radius: 15px!important;
      padding-left: 15px!important;
    }
    .wc-blocks-components-select .wc-blocks-components-select__container {
      border-radius: 15px!important;
    }
  ';
    //?---------- Sticker - Sale
    if ( get_theme_mod( 'badoblog_cus_woo_sale', 0 ) != 1 ) {
        $css .= '
      .woocommerce div.product span.onsale,
      .woocommerce ul.products li.product .onsale {
        border-radius: 15px;
        min-height: 2em;
        line-height: 2;
        min-width: 2em;
        padding: 0 0.5em;
        font-weight: normal;
        background: ' . $sale_color . ';
        color: #fff;
      }
    ';
    } else {
        $css .= '
      .woocommerce div.product span.onsale,
      .woocommerce ul.products li.product .onsale {
        display: none;
      }
    ';
    }
    //?---------- Star rating
    $css .= '
    .site .wc-block-grid__product-rating  {
      color: ' . $t_color . ';
    }
  ';
    //?---------- Window - Coupon code
    $css .= '
    .woocommerce-page #content table.cart td.actions #coupon_code  {
      min-width: 180px;
      padding: .3em;
      border: 1px solid ' . $primary_color . ';
      margin-bottom: .5em;
    }
    @media (max-width: 500px) {
      .woocommerce-page #content table.cart td.actions #coupon_code  {
        width: 100%;
      }
      .woocommerce form.checkout_coupon p {
        width: 100%;
      }
    }
    .woocommerce div.coupon button.button {
      margin-left: .5em;
      margin-bottom: .5em;
    }
  ';
    //?---------- Dropdown lists
    $css .= '
    .woocommerce-page .select2-container--default .select2-selection--single {
      border: 0;
    }
    .woocommerce .select2-container .select2-selection--single .select2-selection__rendered {
      padding-top: 0.5em;
      padding-bottom: 0.5em;
    }
    .woocommerce .select2-container--default.select2-container--open.select2-container--below .select2-selection--single {
      margin-bottom: 1em;
    }
    .woocommerce .select2-container {
      vertical-align: 0;
    }
    .select2-container--default span.select2-selection--multiple,
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      background: ' . $content_color . ';
      border: 1px solid ' . $primary_color . ';
    }
  ';
    //?---------- Personal account - tab - address and login form
    $css .= '
    .woocommerce .col2-set  {
      display: flex;
      justify-content: space-between;
    }
    @media (max-width: 770px) {
      .woocommerce .col2-set  {
        flex-direction: column;
      }
    }
    .woocommerce-account .addresses .title .edit {
      width: 100%;
    }
  ';
    //?---------- Page - product
    $css .= '
    .woocommerce div.product {
      margin-top: 15px;
    }
  ';
    //?---------- Tab - reviews
    $css .= '
    .site #reviews #comments h2 {
      margin: 0.3em 0 1em;
    }
    .site .comment-reply-title {
      font-size: 1.5em;
    }
    .woocommerce div.product div.woocommerce-tabs ul.tabs li {
      border-radius: 15px 15px 0 0;
    }
  ';
    //?---------- Price
    $css .= '
    .site .price,
    .site .price bdi {
      color: ' . $price_color . ';
    }
    .site .price bdi {
      font-size: 1.5em;
    }
    .site .price del bdi {
      font-size: 1.125em;
    }
  ';
    //?---------- Inscription - Out of stock
    $css .= '
    .woocommerce div.product .summary p.stock,
    .woocommerce ul.products li.product a .badoblog-ofstock {
      color: ' . $ofstock_color . '; 
      font-size: 1em;
    }
  ';
    //?---------- Inscription - order is accepted
    $css .= '
    .woocommerce-thankyou-order-received {
      color: ' . $price_color . ';
    }
  ';
    //?---------- Meta blocks when ordering
    $css .= '
    .woocommerce ul.order_details li {
      margin-top: 15px;
    }
  ';
    //?---------- Pagination
    $css .= '
    .woocommerce nav.woocommerce-pagination ul.page-numbers li span.current,
    .woocommerce nav.woocommerce-pagination ul.page-numbers li  a {
      color: ' . $color_link . ';
    }
    .woocommerce nav.woocommerce-pagination ul.page-numbers li a:hover {
      background: ' . $primary_color . ';
      color: ' . $color_lite . ';
    }
  ';
    //?---------- Breadcrumbs woocommerce
    // Breadcrumb link text color
    $bread_a_color_woo = '#fffffb';
    if ( !empty( $bread_a_color ) ) {
        $bread_a_color_woo = $bread_a_color;
    } else {
        if ( $primary_big_lite_color != '#fffffb' ) {
            $bread_a_color_woo = $primary_big_lite_color;
        }
    }
    $css .= "\n    .woocommerce .badoblog-css-breadcrumbs .woocommerce-breadcrumb a {\n      color: {$bread_a_color_woo};\n    }\n  ";
    // Breadcrumb link text color on hover
    $bread_a_color_hover_woo = '#dd9925';
    if ( !empty( $bread_a_hover_color ) ) {
        $bread_a_color_hover_woo = $bread_a_hover_color;
    }
    $css .= "\n    .woocommerce .badoblog-css-breadcrumbs .woocommerce-breadcrumb a:hover {\n      color: {$bread_a_color_hover_woo};\n    }\n  ";
    // Breadcrumbs header text color
    $bread_h_color_woo = '#fffffb';
    if ( !empty( $bread_h_color ) ) {
        $bread_h_color_woo = $bread_h_color;
    } else {
        if ( $primary_big_lite_color != '#404040' ) {
            $primary_big_lite_color = $t_color;
        }
    }
    $css .= '
    .woocommerce .badoblog-css-breadcrumbs .woocommerce-breadcrumb {
      margin-bottom: 0;
      color: ' . $bread_h_color_woo . ';
    }
  ';
    //?---------- Miscellaneous edits to text blocks
    $css .= '
    .woocommerce .woocommerce-checkout #payment,
    .woocommerce .woocommerce-password-strength.bad,
    .site .wc-block-components-textarea {
      background: ' . $content_color . ';
      border: 1px solid rgba(0,0,0,.1);
    }
    .woocommerce div.product .summary .stock,
    .woocommerce #reviews #comments ol.commentlist li p.meta,
    .woocommerce textarea::placeholder,
    .site input[type="search"]::placeholder,
    .woocommerce input[type="text"]::placeholder,
    .woocommerce .select2-container--default .select2-selection--single .select2-selection__placeholder,
    .woocommerce .select2-container--default .select2-selection--single .select2-selection__rendered,
    .site .wc-block-components-validation-error,
    .site .wc-block-components-textarea,
    .site .wc-block-components-textarea::placeholder,
    .select2-container--default .select2-selection--multiple span.select2-selection__choice__remove,
    .select2-container--default .select2-selection--multiple span.select2-selection__choice__remove:hover {
      color: ' . $t_color . ';
    }
    .woocommerce textarea::placeholder,
    .site input[type="search"]::placeholder,
    .woocommerce input[type="text"]::placeholder,
    .woocommerce .select2-container--default .select2-selection--single .select2-selection__placeholder,
    .site .wc-block-components-textarea::placeholder {
      opacity: .5;
    }
    .select2-container--default .select2-results>.select2-results__options {
      color: #404040;
    }
    .woocommerce form .form-row textarea.input-text  {
      height: 7em;
    }
    .badoblog-css-mod-pp-content .woocommerce ul li {
      list-style-type: none;
      padding-left: 3.5em;
    }
  ';
    //?---------- Bug fixes woocommerce (grids break when there are more than 6 columns)
    $css .= '
    .woocommerce .badoblog-css-site-main ul.columns-7,
    .woocommerce .badoblog-css-site-main ul.columns-8,
    .woocommerce .badoblog-css-site-main ul.columns-9 {
      display: flex;
      flex-wrap: wrap;
    }
    @media (max-width: 999px) {
      .woocommerce ul.products.columns-7,
      .woocommerce ul.products.columns-8,
      .woocommerce ul.products.columns-9 {
        justify-content: space-between;
      }
    }
    .woocommerce ul.products.columns-7 li.product {
      margin-right: 2.5%;
      width: 11.7%;
    }
    .woocommerce ul.products.columns-8 li.product {
      margin-right: 2.5%;
      width: 10%;
    }
    .woocommerce ul.products.columns-9 li.product {
      margin-right: 2.5%;
      width: 8.6%;
    }
    @media (max-width: 999px) {
      .woocommerce ul.products.columns-7 li.product,
      .woocommerce ul.products.columns-8 li.product,
      .woocommerce ul.products.columns-9 li.product {
        width: 47%;
      }
    }
  ';
    //?---------- Styles for Mini Cart in the Top menu
    $css .= '
    .badoblog-woo-mini-cart:after {
      color: ' . $primary_color . ';
    }
  ';
    //?---------- Search strings
    $css .= '
    form.woocommerce-product-search {
      display: flex;
      margin-top: 15px;
    }
    .woocommerce-product-search input[type="search"] {
      width: 100%;
      padding: 0.54em;
      border-radius: 20px 0 0 20px;
    }
    .woocommerce-product-search button,
    .woocommerce-product-search .wp-element-button {
      border-radius: 0 20px 20px 0;
    }
    .woocommerce-product-search {
      margin-bottom: 25px;
    }
    .woocommerce-product-search button,
    .woocommerce-product-search .search-field {
      line-height: 1.5;
    }
    .woocommerce-product-search button:hover,
    .woocommerce-product-search .wp-element-button:hover {
        transition-duration: 0.2s;
        box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);
    }
  ';
    //?---------- Obsolete widgets
    $css .= "\n    .widget form.woocommerce-product-search {\n      margin: 0;\n    }\n    .widget ul.product-categories {\n      list-style: none;\n      margin: 0;\n      padding: 0;\n      margin-top: -10px;\n      line-height: 1;\n    }\n    .widget.woocommerce ul.product_list_widget li img {\n      width: 30%;\n      margin-left: 8px;\n    }\n    .woocommerce .widget_price_filter .ui-slider-horizontal div.ui-slider-range,\n    .woocommerce .widget_price_filter .ui-slider span.ui-slider-handle,\n    .widget.woocommerce a.button,\n    .widget.woocommerce a.button:hover {\n      background: {$primary_color};\n    }\n    .woocommerce .widget_price_filter .price_slider_wrapper div.ui-widget-content {\n      background: {$primary_big_color};\n    }\n    .widget.woocommerce a.button,\n    .widget.woocommerce a.button:hover {\n      color: {$color_lite};\n    }\n    .widget.woocommerce a.button:hover {\n      box-shadow: 0 0.1em 0.4em rgba(0, 0, 0, 0.5);\n    }\n  ";
    //?---------- Block widgets
    // Icons
    $css .= "\n    .wc-block-grid svg,\n    .wc-block-checkout-empty svg.wc-block-checkout-empty__image {\n      fill: {$primary_color};\n    }\n  ";
    // Lists
    $css .= "\n  .wc-block-grid ul li,\n  ul.wc-block-components-checkbox-list > li,\n  .widget_block ul.wc-block-grid__products,\n  .widget_block ul.wc-block-review-list,\n  .widget_block ul.wc-block-product-categories-list {\n    padding-left: 0;\n    list-style: none;\n  }\n  ";
    // Filter by attributes
    $css .= "\n    .wc-block-attribute-filter div.wc-blocks-components-form-token-field-wrapper:not(.is-loading) {\n      border: 1px solid {$primary_color} {$i};\n      border-radius: 0;\n    }\n    span.components-form-token-field__token,\n    button.components-form-token-field__remove-token.components-button,\n    button.components-form-token-field__remove-token.components-button:hover {\n      color: {$primary_color};\n    }\n  ";
    // Drawer basket
    $css .= "\n    .wp-block-woocommerce-mini-cart-contents {\n      background: {$content_color};\n    }\n  ";
    // Filter by price
    $css .= "\n    .wc-blocks-filter-wrapper .wc-block-components-price-slider__range-input-wrapper {\n      color: {$primary_color};\n    }\n    .wc-blocks-filter-wrapper .wc-block-components-price-slider--is-input-inline .wc-block-components-price-slider__controls .wc-block-components-price-slider__amount {\n      max-width: 120px;\n    }\n    .wc-blocks-filter-wrapper .wc-block-price-filter__controls {\n      border-color: {$primary_color};\n    }\n  ";
    // Product Reviews
    $css .= "\n    .widget_block .wc-block-components-sort-select__select {\n      border: 1px solid {$primary_color};\n      background: {$content_color};\n    }\n    .widget_block .wp-block-button__link {\n      padding: 0.6em 1em;\n    }\n  ";
    // Product grid (fix bug in stars)
    $css .= "\n    .widget_block div.wc-block-grid__product-rating {\n      display: flex;\n    }\n  ";
    //?---------- Footer widgets
    $css .= '
    .site .badoblog-css-site-footer input[type="search"]::placeholder {
      opacity: 0;
    }
  ';
    if ( !empty( $css ) ) {
        wp_add_inline_style( 'badoblog-style-woo', $css );
    }
}

add_action( 'wp_enqueue_scripts', 'badoblog_fun_set_css_woo', 1 );