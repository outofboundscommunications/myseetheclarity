jQuery(document).ready(function($) {
	
	// alert($('#acf_acf_message-details #acf-field-msg_property_id').attr('class'));
	
	// $('#acf_acf_property-application-data #acf-field-app_property_id').on('change', function() {
	
	if( $('#acf-page_content_editor_type input[type="radio"]:checked').val() == 'block' ){
		$('#postdivrich').css( "display", "none" );
	}
		
	$('#acf-page_content_editor_type input').on('change', function() {
		
		if( $(this).val() == 'block' ){
			$('#postdivrich').css( "display", "none" );
		}else{
			$('#postdivrich').css( "display", "inherit" );
		}
		
		
		
		/*
		timestamp         = new Date().getTime();
		
		var ajax_data = {
			action: 'MyAjaxFunction',
			method: 'get_post',
			security: shr_ajax.ajaxnonce,
			post_id: this.value,
			timestamp: timestamp,
			dataType: 'json',
		};
		
		$.post(
			ajaxurl,
			ajax_data,
			function( response ) {
				// if(response.success){
					// var res = wpAjax.parseAjaxResponse( response );
					// console.log( res );
					// // console.log(response.data);
				// }
				
				if( response.success == true ){
				
					var post_author = response.data.post_author;
					// $('#acf_acf_property-application-data #acf-field-app_landlord').val(post_author);
					$('#acf_acf_message-details #acf-field-msg_landlord').val(post_author);
					
					var response_script = response.script;
					if( response_script != '' ){
						eval(response_script);
					}
					// if ( response.id == timestamp ) {
					// }
					
				}else{
				}
			}
		);
		*/
		
	});
	
	// $('#acf_acf_property-application-data #acf-field-app_property_id').change(function () {
		// $( "#acf_acf_property-application-data #acf-field-app_property_id:selected" ).each(function() {
			// alert($( this ).val());
		// });
	// }).change();
});