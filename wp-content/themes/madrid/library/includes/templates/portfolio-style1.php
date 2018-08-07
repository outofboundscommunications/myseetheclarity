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

$data = $data . '<div class="element portfolio_item_single ' . $cat_echo . '" data-category="' . $cat_echo . '"><div class="row-fluid"><div class="span7"><div class="image-wrap">';

$format = get_post_format();

if ($format == 'video') {

    if (isset($meta_values['meta_video_type'][0])) {


        if ($meta_values['meta_video_type'][0] == 'vimeo') {
            $data = $data . do_shortcode(' [vimeo clip_id="' . $meta_values['meta_attachment'][0] . '" width="100%" height="340"] ');
        } elseif ($meta_values['meta_video_type'][0] == 'youtube') {
            $data = $data . do_shortcode(' [youtube id="' . $meta_values['meta_attachment'][0] . '" width="100%" height="340"] ');
        } elseif ($meta_values['meta_video_type'][0] == 'dailymotion') {
            $data = $data . do_shortcode(' [dailymotion id="' . $meta_values['meta_attachment'][0] . '" width="100%" height="340"] ');
        } else {
            $data = $data . $the_post_thumbnail;
        }
    }
} elseif ($format == 'audio') {


    if (isset($meta_values['meta_audio_type'][0])) {

        if ($meta_values['meta_audio_type'][0] == 'audio') {
            $data = $data . do_shortcode(' [audio src="' . $meta_values['meta_audio_attachment'][0] . '" ] ');
        } else {
            $data = $data . do_shortcode(' [soundcloud id="' . $meta_values['meta_audio_attachment'][0] . '" ] ');
        }
    }
} elseif ($format == 'gallery') {



    if (isset($meta_values['meta_slides_post_type'][0])) {

        $code = '[flexslider]';
        $gallery = unserialize($meta_values['meta_slides_post_type'][0]);
        foreach ($gallery as $slide) {

            $code = $code . '[flexslider_slide ] <img src="' . $slide['image'] . '" alt="" /> [/flexslider_slide]';
        }

        $code = $code . '[/flexslider]';


        $data = $data . do_shortcode($code) .'<div class="alpha-div"></div>';
    }
} else {
    if ($the_post_thumbnail != '') {
        $data = $data . '<a href="' . $permalink . '">' . $the_post_thumbnail .  '</a><div class="alpha-div"></div>';
    }
}

 
 
 $data = $data . '</div></div><div class="span5"><h2 class="blogtitle"><a class="title 1-col" href="' . $permalink . '" >' . get_the_title() . '</a></h2><p class="content-short">'.$the_excerpt_max_charlength.'</p><div class="clearfix"></div>' . do_shortcode('[button_2 color="' . $GLOBALS['primary_color'] . '" size="button-med" float="left" icon="" text="' . __('Learn More', 'code125') . '" link="' . $permalink . '"]') . ''.do_shortcode('[share text="'.__('Share this project','code125').'"]').'</div></div></div>';
?>