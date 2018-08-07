<?php

	// Start WordPress
	require( '../../../../wp-load.php' );

	// Capability check
	if ( !current_user_can( 'edit_posts' ))
		die( 'Access denied' );

	// Param check
	if ( empty( $_GET['shortcode'] ) )
		die( 'Shortcode not specified' );

	$shortcode = code125_shortcodes( $_GET['shortcode'] );
	$return = '';
	// Shortcode has atts
	if ( count( $shortcode['atts'] ) && $shortcode['atts'] ) {
		
		foreach ( $shortcode['atts'] as $attr_name => $attr_info ) {
			$return .= '<p class="clearfix">';
			$return .= '<label for="code125-generator-attr-' . $attr_name . '">' . $attr_info['desc'] . '</label>';

			// Select
			if ( count( $attr_info['values'] ) && $attr_info['values'] ) {
				$return .= '<select name="' . $attr_name . '" id="code125-generator-attr-' . $attr_name . '" class="code125-generator-attr">';
				foreach ( $attr_info['values'] as $key => $attr_value ) {
					$attr_value_selected = ( $attr_info['default'] == $key ) ? ' selected="selected"' : '';
					$return .= '<option' . $attr_value_selected . ' value="'.$key.'">' . $attr_value . '</option>';
				}
				$return .= '</select>';
			}

			// Text & color input
			else {

				if( !isset( $attr_info['type'] )){
					$attr_info['type']='';
				}
				// Color picker
				if ( $attr_info['type'] == 'color' ) {
					$return .= '<span class="code125-generator-select-color"><span class="code125-generator-select-color-wheel"></span><input type="text" name="' . $attr_name . '" value="' . $attr_info['default'] . '" id="code125-generator-attr-' . $attr_name . '" class="code125-generator-attr code125-generator-select-color-value" /></span>';
				}

				// Text input
				else {
					$return .= '<input type="text" name="' . $attr_name . '" value="' . $attr_info['default'] . '" id="code125-generator-attr-' . $attr_name . '" class="code125-generator-attr" />';
				}
				
			}
			$return .= '</p>';
		}
	}

	// Single shortcode (not closed)
	if ( $shortcode['type'] == 'single' ) {
		$return .= '<input type="hidden" name="code125-generator-content" id="code125-generator-content" value="false" />';
	}

	// Wrapping shortcode
	if( !isset($shortcode['content']) ){
		$shortcode['content'] ='';
	}
	else {
		$return .= '<p class="clearfix"><label>' . __( 'Content', 'shortcodes-ultimate' ) . '</label><textarea cols="15" rows="15" name="code125-generator-content" id="code125-generator-content"  >' . $shortcode['content'] . '</textarea></p>';
	}

	$return .= '<p class="clearfix"><a href="#" class="option-tree-ui-button blue light" id="code125-generator-insert">' . __( 'Generate', 'shortcodes-ultimate' ) . '</a></p>';
	
	

	$return .= '<p>Your code should appear here:</p><p><textarea cols="15" row="15" name="code125-generator-result" id="code125-generator-result" style="width:100%;height:150px;" ></textarea></p>';

	echo $return;
?>