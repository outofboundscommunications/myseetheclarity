<?php
ob_start();
the_permalink();
$permalink = ob_get_contents();
ob_end_clean();

ob_start();
the_title();
$the_title = ob_get_contents();
ob_end_clean();

if($GLOBALS['link_type'] == 'ajax'){
	$data_add = ' post-id="'.get_the_ID().'"';
	$class_add = 'ajax-post';
}else {
	$data_add = '';
	$class_add = '';
}

$id_link = get_post_thumbnail_id(get_the_ID());
$size_name = $GLOBALS['columns_team'].'-col-flexible';
$image_url = wp_get_attachment_image_src($id_link,$size_name );
$the_post_thumbnail = '<img src="'.$image_url[0].'" width="'.$image_url[1].'" height="'.$image_url[2].'"  alt="" class="thumb-'.$size_name .'" />';
$image_url2 = wp_get_attachment_image_src($id_link,'full' );



ob_start();
the_excerpt_max_charlength(50);
$the_excerpt_max_charlength = ob_get_contents();
ob_end_clean();

 $meta_values = get_post_custom(get_the_ID());

$type = get_post_type(get_the_ID());

$tax = get_post_tax(get_the_ID());

$terms = wp_get_post_terms(get_the_ID(), $tax);
$cats = '';
$cat_echo = '';
foreach ($terms as $term) {
    $cats = $cats . '<a class="cats-float" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a> ';
    $cat_echo = $cat_echo . $term->slug . ' ';
}





$heightpx = $image_url['2'] +60;
$data = $data . '<div class="element portfolio_item_single ' . $cat_echo . ' '.$tax.'-'.get_category_to_follow(get_the_ID()).'" style="height:' . $heightpx . 'px" data-category="' . $cat_echo . '"><div class="image-wrap">' . $the_post_thumbnail . '<div class="more-wrap-wrap"><div class="more-wrap clearfix"><a '.$data_add.' class=" more '.$class_add.'" href="' . $permalink . '"><span class="icon-link"></span></a></div><div class="more-wrap  clearfix"><a  class="fancybox more more2" href="'.$image_url2[0].'"><span class="icon-search-1"></span></a></div></div></div><hgroup class="data-title"><div class="alpha-div"></div><a class="title '.$class_add.'" '.$data_add.' href="' . $permalink . '" >' . get_the_title() . '</a><p class="portfolio-cats">' . $cats . '</p></hgroup></div>';
?>