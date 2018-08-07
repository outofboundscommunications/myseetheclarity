<?php


     		ob_start();
     		the_permalink();
     		$permalink = ob_get_contents();
     		ob_end_clean();
     		
     		ob_start();
     		the_title();
     		$the_title = ob_get_contents();
     		ob_end_clean();
     		
     	$thumb_view = $GLOBALS['thumb_view'];	
     	if(!isset($GLOBALS['thumb_size'])){
     		$GLOBALS['thumb_size'] = 'large';
     	}
     	$thumb_size = $GLOBALS['thumb_size'];	
  
  
  
  
  ob_start();
  the_author_posts_link();
  $the_author_posts_link = ob_get_contents();
  ob_end_clean();
  
  
  
  
  
  
  
  $cat_echo_p  = do_shortcode('[post_category post_id="'.get_the_ID().'"]');   	
     		
if($thumb_view  =='type'){

	$icon = get_post_format_icon(get_the_ID());
	$thumb = '<span class="'.$icon.'"></span>';
} elseif ($thumb_view  =='image') {
	
	$the_post_thumbnail2 = get_the_post_thumbnail( get_the_ID(), '100x100' );
	
	if($the_post_thumbnail2!=''){
		$thumb = $the_post_thumbnail2;
	}else {
		$thumb = '<span class="'.get_post_format_icon(get_the_ID()).'"></span>';
	}

} elseif ($thumb_view  =='comment') {
	
	$thumb = '<span class="top-part">'.custom_number_format(get_total_number_of_comments(get_the_ID(),'number')).'</span><span class="bottom-part icon-comment-1"></span>';
	
	
} elseif ($thumb_view  =='date') {
	$thumb = '<span class="top-part">'. get_the_time('j') .'</span><span class="bottom-part">'.get_the_time('M') . '</span>';
	
}elseif ($thumb_view  =='like') {
	$vote_count = get_post_meta(get_the_ID(), "votes_count", true);
	if($vote_count==''){
		$vote_count= 0;
	}
	$thumb = '<span class="top-part">'. custom_number_format($vote_count) .'</span><span class="bottom-part icon-heart"></span>';
}elseif ($thumb_view  =='rate') {
	if(has_review( get_the_ID())){
		$rating = get_rating_average(get_the_ID() );
		$thumb = '<span class="top-part">'. $rating .'</span><span class="bottom-part icon-star"></span>';
	
	}else {
		$thumb = '<span class="'.get_post_format_icon(get_the_ID()).'"></span>';
	}
}elseif ($thumb_view  =='view') {
	$views = getPostViews(get_the_ID());
	
	$thumb = '<span class="top-part">'. custom_number_format($views) .'</span><span class="bottom-part icon-eye"></span>';
}elseif ($thumb_view  =='cat') {
	$tax = get_post_tax(get_the_ID());
	
	$terms = wp_get_post_terms(get_the_ID(), $tax);
	
	$icon = get_option( $tax .'_icon_' . $terms[0]->term_id );
	if ($icon =='') {
		$icon = get_post_format_icon(get_the_ID());
	}
	$thumb = '<span class="'.$icon.'"></span>';
}

	
		$data = $data .'<div class=" hideme  wrap-post-list '.$thumb_size.' flip-post clearfix"><div class="flip-post-wrap"><div class="flip-wrap"><div class="post-front"><div class="wrap-icon">'.$thumb.'</div></div><div class="post-back"><div class="wrap-icon"><span class="'. get_post_format_icon(get_the_ID()).'"></span></div></div></div></div><div class="wrap-post-content"><a class="post-list-title" href="'. get_permalink(get_the_ID()).'"> '. $the_title.'</a><div class="clearfix"></div>';
	
	
	include(get_template_directory() . '/library/includes/templates/meta-data.php');
	
	$data = $data .'</div></div>';

?>