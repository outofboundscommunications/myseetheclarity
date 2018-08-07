<?php
ob_start();
 		 the_permalink();
 		 $permalink = ob_get_contents();
 		 ob_end_clean();
  
 		 ob_start();
 		 the_title();
 		 $the_title = ob_get_contents();
 		 ob_end_clean();
         $meta_values = get_post_custom(get_the_ID());	
        
         if(!isset($meta_values['meta_metro_size'][0])){
         		$meta_values['meta_metro_size'][0] = 'medium';
         	}
         	
         $metro_size = $meta_values['meta_metro_size'][0];
  		 
  		 if($metro_size == 'large'){
  		 	$image_size = '5-col-metro-1';
  		 
  		 }elseif ($metro_size == 'wide') {
  		 	$image_size = '5-col-metro-2';
  		 }elseif ($metro_size == 'tall') {
  		 	$image_size = '5-col-metro-3';
  		 }else{
  		 	$image_size = '5-col-o';
  		 }
  		 
  		 if(is_mobile()){
  		 	$image_size = '6-col-o';
  			 $meta_values['meta_metro_size'][0] = 'medium';
  			 $small = 'photo-small';
  		 }else {
  		 	$small = '';
  		 }
  		 
 		 $id_link = get_post_thumbnail_id(get_the_ID());
 		 
 		 $image_url = wp_get_attachment_image_src( $id_link, $image_size);
 
  if($GLOBALS['link_type'] == 'ajax'){
  	$data_add = ' post-id="'.get_the_ID().'"';
  	$class_add = 'ajax-post';
  }else {
  	$data_add = '';
  	$class_add = '';
  }
 		 
 	 
  if(is_array($image_url)){ 
   $type = get_post_type(get_the_ID());
   $tax = get_post_tax(get_the_ID());
   
   $terms = wp_get_post_terms(get_the_ID(), $tax);
   $cats = '';
   $cat_echo = '';
   foreach ($terms as $term) {
       $cats = $cats . '<a class="cats-float" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a> ';
       $cat_echo = $cat_echo . $term->slug . ' ';
   }
   
    $cat_id = get_category_to_follow(get_the_ID());
    
    	
  	$data = $data . '<div  class="element '.$small.' portfolio_item_single img-'.$image_size.' '.$tax.'-'. $cat_id.' ' . $cat_echo . ' flip-post clearfix" data-category="' . $cat_echo . '" ><div class="flip-wrap">';
  	if(!isset($meta_values['meta_metro'][0])){
   		$meta_values['meta_metro'][0] = 'photo';
   	}
   	
   	if($meta_values['meta_metro'][0] == 'photo'){
   		$data = $data . '<div class="post-front">';
   		$data = $data . '<img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" />';
   		$data = $data . '</div><div class="post-back post-data-bg">';
   		$data = $data . '<div class="post-back-wrap">';
   		
   		$data = $data . '<a class="cat-link" href="'.get_term_link(intval( $cat_id), $tax).'"><span class="'.get_option( $tax .'_icon_' .  $cat_id ).'"></span></a>';
   		
   		
   		
   		$data = $data . '<a class="title-link '.$class_add .'" '.$data_add.' href="'. $permalink.'">'. $the_title .'</a>';
   		
   		
   		$data = $data . '</div></div>';
   	
   	}else {
		$data = $data . '<div class="post-front post-data-bg">';
		$data = $data . '<div class="post-back-wrap">';
		
		$data = $data . '<a class="cat-link" href="'.get_term_link(intval( $cat_id), $tax).'"><span class="'.get_option( $tax .'_icon_' .  $cat_id).'"></span></a>';
		
		
		
		$data = $data . '<a class="title-link" href="'. $permalink.'">'. $the_title .'</a>';
		$data = $data . '</div></div><div class="post-back">';
		$data = $data . '<a class="'.$class_add .'" '.$data_add.'   href="'. $permalink.'"><img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" /></a>';
		
		$data = $data . '</div>';
	}
   	
   	$data = $data . '</div></div>';
   	 	
   }


?>