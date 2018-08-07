jQuery(document).ready(function($) {

	// Apply chosen
	/*
	$('#code125-generator-select').chosen({
		no_results_text: $('#code125-generator-select').attr('data-no-results-text'),
		allow_single_deselect: true
	});

	*/
	// Select shortcode
	$('#code125-generator-select').live( "change", function() {
		var queried_shortcode = $('#code125-generator-select').find(':selected').val();
		$('#code125-generator-settings').addClass('code125-loading-animation');
		$('#code125-generator-settings').load($('#code125-generator-url').val() + '/lib/generator.php?shortcode=' + queried_shortcode, function() {
			$('#code125-generator-settings').removeClass('code125-loading-animation');

			// Init color pickers
			$('.code125-generator-select-color').each(function(index) {
				$(this).find('.code125-generator-select-color-wheel').filter(':first').farbtastic('.code125-generator-select-color-value:eq(' + index + ')');
				$(this).find('.code125-generator-select-color-value').focus(function() {
					$('.code125-generator-select-color-wheel:eq(' + index + ')').show();
				});
				$(this).find('.code125-generator-select-color-value').blur(function() {
					$('.code125-generator-select-color-wheel:eq(' + index + ')').hide();
				});
			});
		});
	});

	// Insert shortcode
	$('#code125-generator-insert').live('click', function(event) {
		var queried_shortcode = $('#code125-generator-select').find(':selected').val();
		var su_compatibility_mode_prefix = $('#code125-compatibility-mode-prefix').val();
		$('#code125-generator-result').val('[' + queried_shortcode);
		$('#code125-generator-settings .code125-generator-attr').each(function() {
			if ( $(this).val() !== '' ) {
				$('#code125-generator-result').val( $('#code125-generator-result').val() + ' ' + $(this).attr('name') + '="' + $(this).val() + '"' );
			}
		});
		$('#code125-generator-result').val($('#code125-generator-result').val() + ']');

		// wrap shortcode
		if ( $('#code125-generator-content').val() ) {
			$('#code125-generator-result').val($('#code125-generator-result').val() + $('#code125-generator-content').val() + '[/' + queried_shortcode + ']');
		}

		/*
		var shortcode = jQuery('#code125-generator-result').val();

		// Insert into widget
		if ( typeof window.su_generator_target !== 'undefined' ) {
			jQuery('textarea#' + window.su_generator_target).val( jQuery('textarea#' + window.su_generator_target).val() + shortcode);
			tb_remove();
		}

		// Insert into editor
		else {
			window.send_to_editor(shortcode);
		}
		*/
		// Prevent default action
		event.preventDefault();
		return false;
	});

	// Widget insertion button click
	jQuery('a[data-page="widget"]').live('click',function(event) {
		window.su_generator_target = jQuery(this).attr('data-target');
	});

});