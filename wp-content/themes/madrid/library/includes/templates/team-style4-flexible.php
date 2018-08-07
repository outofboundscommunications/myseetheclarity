<?php
ob_start();
the_permalink();
$permalink = ob_get_contents();
ob_end_clean();

ob_start();
the_title();
$the_title = ob_get_contents();
ob_end_clean();


$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , $GLOBALS['columns_team'].'-col-flexible');




ob_start();
the_excerpt_max_charlength(50);
$the_excerpt_max_charlength = ob_get_contents();
ob_end_clean();


$type = get_post_type(get_the_ID());

$tax = 'hierarchy';

$meta_values = get_post_custom(get_the_ID());

$terms = wp_get_post_terms(get_the_ID(), $tax);
$cats = '';
$cat_echo = '';
foreach ($terms as $term) {
    $cats = $cats . '<a class="cats-float" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a> ';
    $cat_echo = $cat_echo . $term->slug . ' ';
}

 $cat_id = get_category_to_follow(get_the_ID());

$icons_social = unserialize($meta_values['social_icons'][0]) ;

$width = count($icons_social) * 30;
$icons_code =  '<div class="social-mini-icons-wrap-style"><div class="social-mini-icons" style="width:'.$width.'px">';
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


$id_link = get_post_thumbnail_id();

$image_url = wp_get_attachment_image_src($id_link, $GLOBALS['columns_team'].'-col-flexible');

$heightpx = $image_url['2'] +60;

$data = $data . '<div class="element portfolio_item_single '.$tax.'-'. $cat_id.' ' . $cat_echo . '" data-category="' . $cat_echo . '"><div class="image-wrap" style="height:' . $heightpx . 'px"><a href="' . $permalink . '">' . $the_post_thumbnail . '</a></div><hgroup class="data-title"><div class="alpha-div"></div><a class="title" href="' . $permalink . '" >' . get_the_title() . '</a><p class="portfolio-cats">' . $cats . '</p>'.$icons_code.'</hgroup></div>';
?>