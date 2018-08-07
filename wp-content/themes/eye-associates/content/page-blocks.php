<?php
/*
12_0		Full Width
6_6			1_2 - 1_2
4_8			1_3 - 2_3
8_4			2_3 - 1_3
3_9			1_4 - 3_4
9_3			3_4 - 1_4
4_4_4		1_3 - 1_3 - 1_3
3_6_3		1_4 - 2_4 - 1_4
3_3_6		1_4 - 1_4 - 2_4
6_3_3		2_4 - 1_4 - 1_4
3_3_3_3		1_4 - 1_4 - 1_4 - 1_4 

12	Full Width
6	1_2
4	1_3
8	2_3
3	1_4
9	3_4
6	2_4
*/

// $content_block = get_field('content_block');
// $wrap_count    = count( $content_block );
// global $div_stat;
// $div_stat      = '';
// $current_count = 0;

// echo '<pre>';
// print_r($content_block);
// echo '</pre>';

// check if the flexible content field has rows of data
if( have_rows('content_block') ){
	
	// loop through the rows of data
	while ( have_rows('content_block') ) {
		the_row();
		
		// $current_count++;
		
		// if( $div_stat == 'open' ){
			// $div_stat = 'already_open';
		// }else{
			// $div_stat = 'open';
		// }
		
		if( get_row_layout() == 'wrapper_start' ){
			/*-----------------------------------------------------------------------------
				Wrapper Start
			-----------------------------------------------------------------------------*/
			$wrapper_style = '';
			
			$wrapper_color = get_sub_field('wrapper_color');
			if( $wrapper_color ){
				$wrapper_style .= 'background-color:' . $wrapper_color .'; ';
			}else{
				$wrapper_style .= 'background-color:' . '#F9F7F7' .'; ';
			}
			
			$wrapper_text_color = get_sub_field('wrapper_text_color');
			if( $wrapper_text_color ){
				$wrapper_style .= 'color:' . $wrapper_text_color .'; ';
			}
			
			// Margin Padding Class
			$wrapper_margins = get_sub_field('wrapper_margins');
			$wrapper_margins_class = '';
			if( $wrapper_margins ){
				$wrapper_margins_class = ' ' . implode(' ', $wrapper_margins);
			}
			
			// Wrapper Class
			$wrapper_class_data = get_sub_field('wrapper_class');
			$wrapper_class = '';
			if( $wrapper_class_data ){
				$wrapper_class = ' ' . $wrapper_class_data;
			}
			$wrapper_unique_class = 'c-'.uniqid();
			
			// Wrapper Custom Style
			$wrapper_custom_style = '<style type="text/css">';
			$wrapper_link_color = get_sub_field('wrapper_link_color');
			if( $wrapper_link_color ){
				$wrapper_custom_style .= ".$wrapper_unique_class a {color: $wrapper_link_color;}";
			}
			$wrapper_custom_style .= '</style>';
			
			// Wrapper ID
			$wrapper_id_data = get_sub_field('wrapper_id');
			$wrapper_id = '';
			if( $wrapper_id_data ){
				$wrapper_id = 'id="' . $wrapper_id_data .'"';
			}
			
			/*
			if( $div_stat == 'open' ){
				?>
				<div <?php echo $wrapper_id;?> class="content-container<?php echo $wrapper_margins_class.$wrapper_class;?>" style="<?php echo $wrapper_style;?>">
					<div class="container">
						<div class="row">
							<?php
			}elseif( $div_stat == 'already_open' ){
				?>
				<div <?php echo $wrapper_id;?> class="content-container<?php echo $wrapper_margins_class.$wrapper_class;?>" style="<?php echo $wrapper_style;?>">
					<div class="container">
						<div class="row">
				<?php
			}
			*/
			?>
			<div <?php echo $wrapper_id;?> class="content-container<?php echo $wrapper_margins_class.$wrapper_class.' '.$wrapper_unique_class;?>" style="<?php echo $wrapper_style;?>">
				<?php echo $wrapper_custom_style;?>
				<div class="container">
					<div class="row">
			<?php
		}elseif( get_row_layout() == 'wrapper_end' ){
			?>
						<div class="clearfix"></div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .content-container -->
			<?php
			
		}elseif( get_row_layout() == 'content_block_plain' ){
			
			/*-----------------------------------------------------------------------------
			Content Block
			-----------------------------------------------------------------------------*/	
			
			$block_content            = get_sub_field('block_content');
			
			$column_width = '';
			
			// Large Screen
			$block_width_large = get_sub_field('block_width_large');
			if( !$block_width_large ){
				$block_width_large = '12';
			}
			$column_width .= 'col-lg-'.column_width($block_width_large).' ';
			
			// Medium Screen
			$block_width_medium = get_sub_field('block_width_medium');
			if( !$block_width_medium ){
				$block_width_medium = '12';
			}
			$column_width .= 'col-md-'.column_width($block_width_medium).' ';
			
			// Small Screen
			$block_width_small = get_sub_field('block_width_small');
			if( !$block_width_small ){
				$block_width_small = '12';
			}
			$column_width .= 'col-sm-'.column_width($block_width_small).' ';
			
			// X-Small Screen
			$block_width_extra_small = get_sub_field('block_width_extra_small');
			if( !$block_width_extra_small ){
				$block_width_extra_small = '12';
			}
			$column_width .= 'col-xs-'.column_width($block_width_extra_small).' ';
			?>
			<div class="<?php echo $column_width;?>">
				<?php
				if( $block_content ){
					?>
					<?php echo $block_content;?>
					<div class="clearfix"></div>
					<?php
				}
				?>
			</div>
			<?php
		}
		/*
		if( $current_count == $wrap_count && ( $div_stat == 'open' || $div_stat == 'already_open' ) ){
			?>
						<div class="clearfix"></div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .content-container -->
			<?php
		}
		*/
 
	}

}else{
	// no layouts found
}

/*
function guid(){
	/ *
    if (function_exists('com_create_guid')){
        return com_create_guid();
	}else{
    }
	* /
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = '';// ""
        // $uuid = chr(123)// "{"
		// $uuid .= substr($charid, 0, 8).$hyphen;
		// $uuid .= substr($charid, 8, 4).$hyphen;
		$uuid .= substr($charid,12, 4).$hyphen;
		// $uuid .= substr($charid,16, 4).$hyphen;
		// $uuid .= substr($charid,20,12);
		// $uuid .= chr(125);// "}"
        return $uuid;
}
*/
?>