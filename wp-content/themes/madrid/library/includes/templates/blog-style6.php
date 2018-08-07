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
 		 
 		 $image_url = wp_get_attachment_image_src( $id_link, 'mixed-size-4');
 		 
 	 
   $type = get_post_type(get_the_ID());
   $tax = get_post_tax(get_the_ID());
   
   $terms = wp_get_post_terms(get_the_ID(), $tax);
   
   if(is_array($image_url)){
   
   	$data = $data . '<div class="mini-post  hideme "><div class="dark-mini-wrap  '.$tax.'-'.$terms[0]->term_id.'"><a  href="'.$permalink.'"><img src="'. $image_url[0] .'" width="'. $image_url[1] .'" height="'. $image_url[2] .'" alt="" /></a><p class="dark-mini"><a  href="'.$permalink.'">'.$the_title.'</a></p></div></div>';
   }else {
   
   		$data = $data . '<div class="mini-post  hideme  "><div class="dark-mini-wrap   '.$tax.'-'.$terms[0]->term_id.'"><a  href="'.$permalink.'"><div class="bg" style="height:200px; width:200px; display:block"><span class="'.get_post_format_icon(get_the_ID()).'"></span></div></a><p class="dark-mini"><a  href="'.$permalink.'">'.$the_title.'</a></p></div></div>';
   }
   
   


?>