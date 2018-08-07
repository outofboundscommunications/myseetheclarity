<?php
ob_start();
 		 the_permalink();
 		 $permalink = ob_get_contents();
 		 ob_end_clean();
  
 		 ob_start();
 		 the_title();
 		 $the_title = ob_get_contents();
 		 ob_end_clean();
 
  
 		 $id_link = get_post_thumbnail_id(get_the_ID());
 		 
 		 $image_url = wp_get_attachment_image_src( $id_link, $GLOBALS['columns_team'] . '-col-o');
 		 
 		 $meta_values = get_post_custom(get_the_ID());
  if(is_array($image_url)){ 
   $type = get_post_type(get_the_ID());
   
   $tax = 'hierarchy';
   
   $terms = wp_get_post_terms(get_the_ID(), $tax);
   $cats = '';
   $cat_echo = '';
   foreach ($terms as $term) {
       $cats = $cats . '<a class="cats-float" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a> ';
       $cat_echo = $cat_echo . $term->slug . ' ';
   }
   
    $cat_id = get_category_to_follow(get_the_ID());
    
    	
  	$data = $data . '<div  class="element portfolio_item_single '.$tax.'-'. $cat_id.' ' . $cat_echo . ' flip-post clearfix" data-category="' . $cat_echo . '" ><div class="flip-wrap">';
  	if(!isset($meta_values['meta_metro'][0])){
   		$meta_values['meta_metro'][0] = 'photo';
   	}
   	
   	$icons_social = unserialize($meta_values['social_icons'][0]) ;
   	
   	$width = count($icons_social) * 30;
   	$icons_code =  '<div class="social-mini-icons-wrap"><div class="social-mini-icons" style="width:'.$width.'px">';
   	if(is_array($icons_social)){
   	foreach ($icons_social as $icon ) {
   		if($icon['type'] == 'email'){
   			$icons_code = $icons_code . '<a href="mailto:'.$icon['link'].'" title="'.$icon['title'].'"><span class="'.$icon['icon'].'"></span></a>';
   		}else {
   			$icons_code = $icons_code . '<a href="'.$icon['link'].'" title="'.$icon['title'].'"><span class="'.$icon['icon'].'"></span></a>';
   		}
   	}
   	}
   	$icons_code = $icons_code . '</div></div>';
   		
   	
   	if($meta_values['meta_metro'][0] == 'photo'){
   		$data = $data . '<div class="post-front">';
   		$data = $data . '<img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" />';
   		$data = $data . '</div><div class="post-back post-data-bg">';
   		$data = $data . '<div class="post-back-wrap">';
   		
   		$data = $data . $cats;
   		
   		$data = $data . '<a class="title-link" href="'. $permalink.'">'. $the_title .'</a>' . $icons_code;
   		
   		
   		
   		$data = $data . '</div></div>';
   	
   	}else {
		$data = $data . '<div class="post-front post-data-bg">';
		$data = $data . '<div class="post-back-wrap">';
		
		$data = $data . $cats;
		
		$data = $data . '<a class="title-link" href="'. $permalink.'">'. $the_title .'</a>' . $icons_code;
		$data = $data . '</div></div><div class="post-back">';
		$data = $data . '<a  href="'. $permalink.'"><img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" /></a>';
		
		$data = $data . '</div>';
	}
   	
   	$data = $data . '</div></div>';
   	 	
   }


?>