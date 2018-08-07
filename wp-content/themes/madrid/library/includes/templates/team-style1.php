<?php
ob_start();
the_permalink();
$permalink = ob_get_contents();
ob_end_clean();

ob_start();
the_title();
$the_title = ob_get_contents();
ob_end_clean();


$the_post_thumbnail =get_the_post_thumbnail( get_the_ID() , '1-col');




ob_start();
the_excerpt_max_charlength(300);
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

$id_link = get_post_thumbnail_id();

$image_url = wp_get_attachment_image_src($id_link, "full");

$data = $data . '<div class="element portfolio_item_single ' . $cat_echo . '" data-category="' . $cat_echo . '"><div class="row-fluid"><div class="span7"><div class="image-wrap">';


    if ($the_post_thumbnail != '') {
        $data = $data . '<a href="' . $permalink . '">' . $the_post_thumbnail .  '</a><div class="alpha-div"></div>';
    }
$icons_social = unserialize($meta_values['social_icons'][0]) ;

$icons_code =  '<div class="social-mini-icons-wrap-style1"><div class="social-mini-icons" >';
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

 
 
 $data = $data . '</div></div><div class="span5"><h2 class="blogtitle"><a class="title 1-col" href="' . $permalink . '" >' . get_the_title() . '</a></h2>'.$icons_code.'<p class="content-short">'.$the_excerpt_max_charlength.'</p><div class="clearfix"></div>' . do_shortcode('[button_2 color="' . $GLOBALS['primary_color'] . '" size="button-med" float="left" icon="" text="' . __('Read About Me', 'code125') . '" link="' . $permalink . '"]') . ''.do_shortcode('[share text="'.__('Tell People about me','code125').'"]').'</div></div></div>';
?>