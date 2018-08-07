<?php
ob_start();
the_permalink();
$permalink = ob_get_contents();
ob_end_clean();

ob_start();
the_title();
$the_title = ob_get_contents();
ob_end_clean();


$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() ,  $GLOBALS['columns_team'].'-col');


if($GLOBALS['link_type'] == 'ajax'){
	$data_add = ' post-id="'.get_the_ID().'"';
	$class_add = 'ajax-post';
}else {
	$data_add = '';
	$class_add = '';
}
 

ob_start();
the_excerpt_max_charlength(50);
$the_excerpt_max_charlength = ob_get_contents();
ob_end_clean();


$type = get_post_type(get_the_ID());

$tax = get_post_tax(get_the_ID());

$terms = wp_get_post_terms(get_the_ID(), $tax);
$cats = '';
$cat_echo = '';
foreach ($terms as $term) {
    $cats = $cats . '<a class="cats-float" href="' . get_term_link(intval($term->term_id), $tax) . '">' . $term->name . '</a> ';
    $cat_echo = $cat_echo . $term->slug . ' ';
}

$id_link = get_post_thumbnail_id();

$image_url = wp_get_attachment_image_src($id_link, "full");

$data = $data . '<div class="element portfolio_item_single ' . $cat_echo . ' '.$tax.'-'.$terms[0]->term_id.'" data-category="' . $cat_echo . '"><div class="image-wrap">' . $the_post_thumbnail . '<div class="more-wrap-wrap"><div class="more-wrap clearfix"><a '.$data_add.' class=" more '.$class_add.'" href="' . $permalink . '"><span class="icon-link"></span></a></div><div class="more-wrap  clearfix"><a  class="fancybox more more2" href="'.$image_url[0].'"><span class="icon-search-1"></span></a></div></div></div><hgroup class="data-title"><div class="alpha-div"></div><a '.$data_add.' class="'.$class_add.' title" href="' . $permalink . '" >' . get_the_title() . '</a><p class="portfolio-cats">' . $cats . '</p></hgroup></div>';
?>