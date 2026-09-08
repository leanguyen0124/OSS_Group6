/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Customizer panel
* ------------------------------------------------------------------------------ */

jQuery(document).ready(function($) {

	'use strict';

	wp.customize('badoblog_cus_soc_form', function(value) {

		value.bind(function(newValue) {

			// Change form
			if (dChoices.hasOwnProperty(newValue)) {
				var newChoices = dChoices[newValue];
				var controlB = wp.customize.control('badoblog_cus_soc_design_back');
				var selectElement = controlB.container.find('select');
				selectElement.empty();
				for (var key in newChoices) {
					if (newChoices.hasOwnProperty(key)) {
						selectElement.append(
							new Option(newChoices[key], key)
						);
					}
				}
				var currentValue = wp.customize('badoblog_cus_soc_design_back').get();
				var newValueToSet = newChoices.hasOwnProperty(currentValue) ? currentValue : Object.keys(newChoices)[0];
				wp.customize('badoblog_cus_soc_design_back').set('');
				wp.customize('badoblog_cus_soc_design_back').set(newValueToSet);
			}

			// Change soc net
			if (fChoices.hasOwnProperty(newValue)) {
				var newChoices = fChoices[newValue];
				var customContainer = wp.customize.control('badoblog_cus_soc_block').container;
				customContainer.find('select.badoblog-custom-select').each(function() {
					var selectElement = $(this);
					selectElement.attr('data-current-value', selectElement.val());
					var currentValue = selectElement.attr('data-current-value') || selectElement.val();
					selectElement.empty();
					for (var key in newChoices) {
						if (newChoices.hasOwnProperty(key)) {
							selectElement.append(
								new Option(newChoices[key], key)
							);
						}
					}
					var valueToSet = newChoices.hasOwnProperty(currentValue) ? currentValue : Object.keys(newChoices)[0];
					selectElement.val(valueToSet).data('current-value', valueToSet).attr('data-current-value', valueToSet).trigger('change');
				});
			}

		});

	});

});