<?php
/** بسم الله الرحمن الرحيم **
 *
 * Plugin Name: Code125 Page Builder
 * Plugin URI: http://code125.com/page-builder
 * Description: Easily create custom page templates with drag-and-drop interface.
 * Version: 1.0
 * Author: Code125
 * Author URI: http://themeforest.net/user/Code125
 * License: GPLV3
 *
 */

//definitions
define( 'AQPB_VERSION', '1.0' );
define( 'AQPB_PATH',  plugin_dir_path( __FILE__ )  );
define( 'AQPB_DIR', plugin_dir_url( __FILE__ ));


//required functions & classes
require_once(AQPB_PATH . 'functions/meta-boxes.php');
require_once(AQPB_PATH . 'functions/aqpb_config.php');
require_once(AQPB_PATH . 'functions/aqpb_blocks.php');
require_once(AQPB_PATH . 'classes/class-aq-page-builder.php');
require_once(AQPB_PATH . 'classes/class-aq-block.php');
require_once(AQPB_PATH . 'classes/class-aq-plugin-updater.php');
require_once(AQPB_PATH . 'functions/aqpb_functions.php');



require_once(AQPB_PATH . 'blocks/aq-shortcodes-block.php');
require_once(AQPB_PATH . 'blocks/aq-layout-block.php');

$shortcodes_builder = get_option('_code125_shortcodes');
if(!is_array($shortcodes_builder)){
	die('This Plugin is not compatible with the current theme or plugins there is no elements to show');

}

function code125_page_builder_hook($content) {
  
  $meta_use_layout_builder = get_post_meta( $GLOBALS['post']->ID , 'meta_use_layout_builder',true  );
  $meta_template_id = get_post_meta( $GLOBALS['post']->ID , 'meta_template_id',true  );
  if($meta_use_layout_builder == 'yes' && $meta_template_id != ''){
  	$content = $content . do_shortcode('[template id="'.$meta_template_id.'"]');
  } 
  
  return $content;
}

add_filter( 'the_content', 'code125_page_builder_hook' );



$layout = array(
	'2_12' => array(
		'name' => '2_12',
		'desc' => '1/6 Column',
		'size' => 'span2'
	),
	'3_12' => array(
		'name' => '3_12',
		'desc' => '1/4 Column',
		'size' => 'span3'
	),
	'4_12' => array(
		'name' => '4_12',
		'desc' => '1/3 Column',
		'size' => 'span4'
	),
	'5_12' => array(
		'name' => '5_12',
		'desc' => '5/12 Column',
		'size' => 'span5'
	),
	'6_12' => array(
		'name' => '6_12',
		'desc' => '1/2 Column',
		'size' => 'span6'
	),
	'7_12' => array(
		'name' => '7_12',
		'desc' => '7/12 Column',
		'size' => 'span7'
	),
	'8_12' => array(
		'name' => '8_12',
		'desc' => '2/3 Column',
		'size' => 'span8'
	),
	'9_12' => array(
		'name' => '9_12',
		'desc' => '3/4 Column',
		'size' => 'span9'
	),
	'10_12' => array(
		'name' => '10_12',
		'desc' => '5/6 Column',
		'size' => 'span10'
	),
	'12_12' => array(
		'name' => '12_12',
		'desc' => 'Full Column',
		'size' => 'span12'
	)
);

$dont_include = array('row' , 'row_fluid' , '1_12' , '2_12' , '3_12' , '4_12' , '5_12' , '6_12' , '7_12' , '8_12' , '9_12' , '10_12' , '11_12' , '12_12','review_box' );

foreach ($shortcodes_builder as $key => $value) {
	if(isset( $value['child'])){
		$dont_include[]= $value['child']; 
	}
}

$dont_include_type = array('opengroup' , 'closegroup');

foreach ($layout as $key => $value) {
	if(isset($value['type'])){
		$type = $value['type'];
	}else {
		$type = '';
	}
	$aq_registered_blocks[strtolower('code125_' . $key)] = new AQ_Layout(array(
	'name' => $value['name'],
	'size' => $value['size'],
	'desc' => $value['desc'],
	'group_type' => $type ));
	

}
foreach ($shortcodes_builder as $key => $value) {
	$include = 1;
	foreach ($dont_include as  $dont_include_name) {
		if($dont_include_name == $key){
			$include = 0; 
		}
		
	}
	/*
	foreach ($dont_include_type as  $dont_include_name) {
		if($dont_include_name == $value['type']){
			$include = 0; 
		}
		
	}
	*/
	
	if(isset($value['child'])){
		$child = $value['child'];
	}else{
		$child = '';
	}
	if(isset($value['atts'])){
		$atts = $value['atts'];
	}else{
		$atts = '';
	}
	if(isset($value['content'])){
		$content = $value['content'];
	}else{
		$content = '';
	}
	
	if(isset($value['type'])){
		$type = $value['type'];
	}else{
		$type = '';
	}
	if(isset($value['name'])){
		$name = $value['name'];
	}else{
		$name = '';
	}
	
	if($include == 1){
		$aq_registered_blocks[strtolower('code125_' . $key)] = new AQ_Shortcode(array(
		'name' => $name,
		'size' => 'span12',
		'atts' => $atts,
		'child'=> $child,
		'content' => $content,
		'group_type' => $type ));	
		
	}
}



//fire up page builder
$aqpb_config = aq_page_builder_config();
$aq_page_builder =& new AQ_Page_Builder($aqpb_config);
if(!is_network_admin()) $aq_page_builder->init();
