<style type="text/css">
.flip-post1 .post-back-wrap {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0) !important;
}
.flip-post1 .post-front img {
    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
	 filter: gray; /* IE6-9 */
-webkit-filter: grayscale(100%); /* Chrome 19+, Safari 6+, Safari 6+ iOS */
}
.flip-post1 .post-front img:hover {
    cursor: pointer;
    filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
	 
-webkit-filter: grayscale(0%);
}
.flip-post1 .post-front, .flip-post1 .post-back {
    -moz-box-sizing: border-box;
    backface-visibility: hidden;
    display: inline-block;
    height: 100%;
    width: 100%;
}
.flip-post1 .post-back {
    overflow: hidden;
}
.flip-post1 .post-front img {}
.post-front a.title-link {
    color: #000000;
    font-size: 15px;
    padding-left: 0%;
    text-align: center;
	float:left;
	width:80%;
}
.post-front .teamem {
    height: auto;
}
.post-front a.title-link:hover {
    color: #A5C73C;
}
</style>

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
   
    
    	
  	$data = $data . '<div  class="element portfolio_item_single '.$tax.'-'. $cat_id.' ' . $cat_echo . ' flip-post1 clearfix" data-category="' . $cat_echo . '" ><div class="flip-wrap">';
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
   		$data = $data . '<img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" class="teamem" /> <br/>';
		$data = $data . '<a class="title-link" href="'. $permalink.'">'. $the_title .'</a>';
   		$data = $data . '</div><div class="post-back post-data-bg">';
   		$data = $data . '<div class="post-back-wrap" style="display:none;">';
   		
   		$data = $data . $cats;
   		
   		//$data = $data . '<a class="title-link" href="'. $permalink.'">'. $the_title .'</a>' . $icons_code;
   		
   		
   		
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