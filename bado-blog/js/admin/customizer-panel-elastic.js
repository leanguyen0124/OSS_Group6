/* ------------------------------------------------------------------------------
* Author: DMCWebZone
* Author URL: https://web-zone.org
* Copyright © Bado Blog by DMCWebZone. All Rights Reserved.
* @package Bado Blog
* Description: Customizer panel
* ------------------------------------------------------------------------------ */


jQuery(document).ready(function($) {

	'use strict';

	//? ---------- Blocks with sorting (home page and social links)

	function badoblog_fun_refresh_elastic_values() {
		$(".multi-elastic-field-control-wrap").each(function() {
			var values = []; 
			var $this = $(this);
			$this.find(".multi-elastic-field-control").each(function() {
				var valueToPush = {};
				$(this).find('[data-name]').each(function() {
					var dataName = $(this).attr('data-name');
					var inputue = $(this).val();
					valueToPush[dataName] = inputue;
				});
				values.push(valueToPush);
			});
			$this.next('.multi-elastic-collector').val(JSON.stringify(values)).trigger('change');
		});
	}

	function badoblog_fun_get_soc_title_from_select($select) {
		var socValue = $select.val();
		if (!socValue || socValue === 'off') {
			return '';
		}

		var $selectedOption = $select.find('option:selected');
		return $selectedOption.length ? $.trim($selectedOption.text()) : '';
	}

	function badoblog_fun_refresh_soc_title($select) {
		var socTitle = badoblog_fun_get_soc_title_from_select($select);
		$select.closest('.multi-elastic-field-control').find('.badoblog-soc-link-title').text(socTitle);
	}

	function badoblog_fun_refresh_soc_titles($scope) {
		var $root = ($scope && $scope.length) ? $scope : $('#customize-theme-controls');
		$root.find('select.dmcwzmulti-css-soc-select[data-name="soc_net"]').each(function() {
			badoblog_fun_refresh_soc_title($(this));
		});
	}

	badoblog_fun_refresh_soc_titles($('#customize-theme-controls'));


	

    $('#customize-theme-controls').on('click','.multi-elastic-field-title', function() {
        $(this).next().slideToggle();
        $(this).closest('.multi-elastic-field-control').toggleClass('expanded');
    });

    $('#customize-theme-controls').on('click', '.multi-elastic-field-close', function() {
    	$(this).closest('.multi-elastic-fields').slideUp();
    	$(this).closest('.multi-elastic-field-control').toggleClass('expanded');
    });

    $("body").on("click",'.badoblog-add-control-field', function() {
        
		var $this = $(this).parent();
		if (typeof $this != 'undefined') {

            var field = $this.find(".multi-elastic-field-control:first").clone();
            if (typeof field != 'undefined') {
          
				field.find(".badoblog-def-checkbox").each(function() {
                	var defaultValue = $(this).next('input[data-name]').attr('data-default');
                	$(this).next('input[data-name]').val(defaultValue);
                	
                	$(this).find('input[type="checkbox"]').each(function() {
	                	if ($(this).val() == defaultValue) {
	                		$(this).prop('checked', 1);
							$(this).val(1);
	                	} else {
	                		$(this).prop('checked', 0);
							$(this).val(0);
	                	}
                	});
                });

				field.find("input[type='color'][data-name]").each(function() {
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });

				field.find("input[type='number'][data-name]").each(function() {
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });

                field.find("input[type='text'][data-name]").each(function() {
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });

				field.find("input[type='hidden'][data-name]").each(function() {
                	var defaultValue = Math.floor(Math.random() * 9999) + 99;
					$(this).val(defaultValue);
                });

                field.find("textarea[data-name]").each(function() {
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);
                });

                field.find("select[data-name]").each(function() {
                	var defaultValue = $(this).attr('data-default');
                	$(this).val(defaultValue);                    
                });

                field.find(".radio-labels input[type='radio']").each(function() {
                	var defaultValue = $(this).closest('.radio-labels').next('input[data-name]').attr('data-default');
                	$(this).closest('.radio-labels').next('input[data-name]').val(defaultValue);
                	
                	if ($(this).val() == defaultValue) {
                		$(this).prop('checked',true);
                	} else {
                		$(this).prop('checked',false);
                	}
                });

                field.find(".selector-labels label").each(function() {
                	var defaultValue = $(this).closest('.selector-labels').next('input[data-name]').attr('data-default');
                	var input = $(this).attr('data-val');
                	$(this).closest('.selector-labels').next('input[data-name]').val(defaultValue);
                	if (defaultValue == input) {
                		$(this).addClass('selector-selected');
                	} else {
                		$(this).removeClass('selector-selected');
                	}
                });

				field.find(".selector-labels-soc label").each(function() {
                	var defaultValue = $(this).closest('.selector-labels-soc').next('input[data-name]').attr('data-default');
                	var input = $(this).attr('data-val');
                	$(this).closest('.selector-labels-soc').next('input[data-name]').val(defaultValue);
					if (defaultValue == input) {
                		$(this).addClass('selector-soc-selected');
                	} else {
                		$(this).removeClass('selector-soc-selected');
                	}
                });

				field.find('.range-input').each(function() {
					var $dis = $(this);
                	$dis.removeClass('ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all').empty();
					var defaultValue = parseFloat($dis.attr('data-defaultvalue'));
					$dis.siblings(".range-input-selector").val(defaultValue);
					$dis.slider({
						range: "min",
						value: parseFloat($dis.attr('data-defaultvalue')),
						min: parseFloat($dis.attr('data-min')),
						max: parseFloat($dis.attr('data-max')),
						step: parseFloat($dis.attr('data-step')),
						slide: function( event, ui) {
							$dis.siblings(".range-input-selector").val(ui.value );
							badoblog_fun_refresh_elastic_values();
						}
					});
				});

				field.find('.onoffswitch').each(function() {
					var defaultValue = $(this).next('input[data-name]').attr('data-default');
					$(this).next('input[data-name]').val(defaultValue);
					if (defaultValue == 'on') {
						$(this).addClass('switch-on');
					} else {
						$(this).removeClass('switch-on');
					}
				});

				field.find(".attachment-media-view").each(function() {
					var defaultValue = $(this).find('input[data-name]').attr('data-default');
					$(this).find('input[data-name]').val(defaultValue);
					if (defaultValue) {
						$(this).find(".thumbnail-image").html('<img src="'+defaultValue+'"/>').prev('.placeholder').addClass('hidden');
					} else {
						$(this).find(".thumbnail-image").html('').prev('.placeholder').removeClass('hidden');	
					}
				});
                
                field.find(".badoblog-icon-list").each(function() {
					var defaultValue = $(this).next('input[data-name]').attr('data-default');
					$(this).next('input[data-name]').val(defaultValue);
					$(this).prev('.badoblog-selected-icon').children('i').attr('class','').addClass(defaultValue);
					
					$(this).find('li').each(function() {
						var icon_class = $(this).find('i').attr('class');
						if (defaultValue == icon_class) {
							$(this).addClass('icon-active');
						} else {
							$(this).removeClass('icon-active');
						}
					});
				});

				field.find(".badoblog-multi-category-list").each(function() {
                	var defaultValue = $(this).next('input[data-name]').attr('data-default');
                	$(this).next('input[data-name]').val(defaultValue);
                	
                	$(this).find('input[type="checkbox"]').each(function() {
	                	if ($(this).val() == defaultValue) {
	                		$(this).prop('checked', true);
	                	} else {
	                		$(this).prop('checked', false);
	                	}
                	});
                });

				field.find('.badoblog-fields').show();

				$this.find('.multi-elastic-field-control-wrap').append(field);
				badoblog_fun_refresh_soc_titles(field);
                
				

				field.addClass('expanded').find('.multi-elastic-fields').show();
                $('.accordion-section-content').animate({ scrollTop: $this.height() }, 1000);
                badoblog_fun_refresh_elastic_values();
            }

		}
		return false;
	});
	
	$("#customize-theme-controls").on("click", ".multi-elastic-field-remove", function() {
		if (typeof	$(this).parent() != 'undefined') {
			$(this).closest('.multi-elastic-field-control').slideUp('normal', function() {
				$(this).remove();
				badoblog_fun_refresh_elastic_values();
			});
		}
		return false;
	});

	$("#customize-theme-controls").on('keyup change', '[data-name]', function() {
		 badoblog_fun_refresh_elastic_values();
		 if ($(this).is('select.dmcwzmulti-css-soc-select[data-name="soc_net"]')) {
			badoblog_fun_refresh_soc_title($(this));
		 }
		 return false;
	});

	$("#customize-theme-controls").on('change', 'input[type="checkbox"][data-name]', function() {
		if ($(this).is(":checked")) {
			$(this).val(1);
		} else {
			$(this).val(0);
		}
		badoblog_fun_refresh_elastic_values();
		return false;
	});

	// Block sorting
	$('.multi-elastic-field-control-wrap').sortable({
		handle: ".multi-elastic-field-title",
		update: function(event, ui) {
			badoblog_fun_refresh_elastic_values();
		}
	}).disableSelection();
	// Selector .disableSelection() - this is a ban on editing the headers of sortable fields for some browsers, for example Chrome

	// Set all variables to be used in scope
	var frame;

	// ADD IMAGE LINK
	$('.customize-control-multi-elastic').on( 'click', '.badoblog-upload-button', function( event) {
		event.preventDefault();

		var imgContainer = $(this).closest('.badoblog-fields-wrap').find( '.thumbnail-image'),
		placeholder = $(this).closest('.badoblog-fields-wrap').find( '.placeholder'),
		imgIdInput = $(this).siblings('.upload-id');

		// Create a new media frame
		frame = wp.media({
			title: 'Select or Upload Image',
			button: {
			text: 'Use Image'
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected in the media frame...
		frame.on('select', function() {

			// Get media attachment details from the frame state
			var attachment = frame.state().get('selection').first().toJSON();

			// Submit the URL of the attachment to our custom image input field.
			imgContainer.html( '<img src="'+attachment.url+'">' );
			placeholder.addClass('hidden');

			// Send attachment id to our hidden input
			imgIdInput.val( attachment.url ).trigger('change');

		});

		// Finally, open the modal on click
		frame.open();
	});


	// DELETE IMAGE LINK
	$('.customize-control-multi-elastic').on('click', '.badoblog-delete-button', function(event) {

	event.preventDefault();
	var imgContainer = $(this).closest('.badoblog-fields-wrap').find('.thumbnail-image'),
	placeholder = $(this).closest('.badoblog-fields-wrap').find('.placeholder'),
	imgIdInput = $(this).siblings('.upload-id');

	// Clear out the preview image
	imgContainer.find('img').remove();
	placeholder.removeClass('hidden');

	// Delete the image id from the hidden input
	imgIdInput.val( '' ).trigger('change');

	});

	$('body').on('click','.selector-labels label', function() {
		var $this = $(this);
		var value = $this.attr('data-val');
		$this.siblings().removeClass('selector-selected');
		$this.addClass('selector-selected');
		$this.closest('.selector-labels').next('input').val(value).trigger('change');
	});

	$('body').on('click','.selector-labels-soc label', function() {
		var $this = $(this);
		var value = $this.attr('data-val');
		$this.siblings().removeClass('selector-soc-selected');
		$this.addClass('selector-soc-selected');
		$this.closest('.selector-labels-soc').next('input').val(value).trigger('change');
	});

	$('body').on('change','.badoblog-type-radio input[type="radio"]', function() {
		var $this = $(this);
		$this.parent('label').siblings('label').find('input[type="radio"]').prop('checked',false);
		var value = $this.closest('.radio-labels').find('input[type="radio"]:checked').val();
		$this.closest('.radio-labels').next('input').val(value).trigger('change');
	});

	$('body').on('click', '.onoffswitch', function() {
		var $this = $(this);
		if ($this.hasClass('switch-on')) {
			$(this).removeClass('switch-on');
			$this.next('input').val('off').trigger('change');
		} else {
			$(this).addClass('switch-on');
			$this.next('input').val('on').trigger('change');
		}
	});

	$('.range-input').each(function() {
		var $this = $(this);
		$this.slider({
			range: "min",
			value: parseFloat($this.attr('data-value')),
			min: parseFloat($this.attr('data-min')),
			max: parseFloat($this.attr('data-max')),
			step: parseFloat($this.attr('data-step')),
			slide: function( event, ui) {
				$this.siblings(".range-input-selector").val(ui.value );
				badoblog_fun_refresh_elastic_values();
			}
		});
	});

	$('body').on('click', '.badoblog-icon-list li', function() {
		var icon_class = $(this).find('i').attr('class');
		$(this).addClass('icon-active').siblings().removeClass('icon-active');
		$(this).parent('.badoblog-icon-list').prev('.badoblog-selected-icon').children('i').attr('class','').addClass(icon_class);
		$(this).parent('.badoblog-icon-list').next('input').val(icon_class).trigger('change');
		badoblog_fun_refresh_elastic_values();
	});

	$('body').on('click', '.badoblog-selected-icon', function() {
		$(this).next().slideToggle();
	});

	// MultiCheck box Control JS
    $('body').on('change', '.badoblog-type-multicategory input[type="checkbox"]', function() {

        var checkbox_values = $(this).parents('.badoblog-type-multicategory').find( 'input[type="checkbox"]:checked').map(function() {
            return $( this ).val();
        }).get().join( ',' );

        $(this).parents('.badoblog-type-multicategory').find('input[type="hidden"]').val(checkbox_values).trigger('change');
        badoblog_fun_refresh_elastic_values();
    });

    

});
