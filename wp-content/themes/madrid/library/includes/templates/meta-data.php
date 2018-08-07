<?php

$data = $data . '<ul class="meta-article-entry">';

$author_enable = ot_get_option('author_enable');

if(!isset($GLOBALS['author_enable'])){
	$GLOBALS['author_enable'] = 'yes';
}
if(!isset($GLOBALS['date_enable'])){
	$GLOBALS['date_enable'] = 'yes';
}
if(!isset($GLOBALS['comments_count_enable'])){
	$GLOBALS['comments_count_enable'] = 'yes';
}
if(!isset($GLOBALS['cat_enable'])){
	$GLOBALS['cat_enable'] = 'yes';
}
if(!isset($GLOBALS['like_enable'])){
	$GLOBALS['like_enable'] = 'yes';
}
if(!isset($GLOBALS['review_enable'])){
	$GLOBALS['review_enable'] = 'yes';
}
if(!isset($GLOBALS['view_count_enable'])){
	$GLOBALS['view_count_enable'] = 'yes';
}


if ($author_enable != 'no') {
	if($GLOBALS['author_enable']!='no'){

    $data = $data . '<li class="icon-users"> ' . $the_author_posts_link . '</li>';
    
    }
}
$date_enable = ot_get_option('date_enable');

if ($date_enable != 'no') {
	if($GLOBALS['date_enable']!='no'){
    $time_date = ot_get_option('time_date');
    if ($time_date != 'clock') {

        $data = $data . '<li class="icon-pencil"> ' . get_the_time('F') . ' ' . get_the_time('j') . ', ' . get_the_time('Y') . '</li>';
    } else {
		 $data = $data . '<li class="icon-pencil"> ' . get_the_time('j') . ' ' . get_the_time('M') . ' ' . get_the_time('y') . ', ' . get_the_time('h:i A') . '</li>';
    }
    }
}



 $type = get_post_type(get_the_ID());
if($type == 'post'){
$comments_count_enable = ot_get_option('comments_count_enable');

if ($comments_count_enable != 'no') {
	if($GLOBALS['comments_count_enable']!='no'){
	

    $data = $data . '<li class="icon-comment">' . get_total_number_of_comments(get_the_ID(), 'text') . '</li>';
    }
}
}



$cat_enable = ot_get_option('cat_enable');

if ($cat_enable != 'no') {
	if($GLOBALS['cat_enable']!='no'){
    	$data = $data . '<li class="icon-archive"> ' . $cat_echo_p . '</li>';
    }
}

$like_enable = ot_get_option('like_enable');

if ($like_enable != 'no') {
	if($GLOBALS['like_enable']!='no'){
    	$data = $data . '<li>'. getPostLikeLink(get_the_ID()) .'</li>';
    }
}




$review_enable = ot_get_option('review_enable');

if ($review_enable != 'no') {
	if($GLOBALS['review_enable']!='no'){
		if(has_review(get_the_ID())){
    		$data = $data . '<li class="clearfix">'. get_stars_review(get_rating_average_num(get_the_ID())) .'</li>';
    	}
    }
}



$view_count_enable = ot_get_option('view_count_enable');

if ($view_count_enable != 'no') {
	if($GLOBALS['view_count_enable']!='no'){
    	$data = $data . '<li class="icon-eye"> '. custom_number_format(getPostViews(get_the_ID())) .'</li>';
    }
}

$data = $data . '</ul>';

?>