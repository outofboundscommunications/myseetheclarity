<?php
if(!isset($GLOBALS['thumb-size'])){

	$GLOBALS['thumb-size'] = 'blog-post-thumb';

}
$the_post_thumbnail = get_the_post_thumbnail(get_the_ID(),$GLOBALS['thumb-size']);

$dimensions = code125_check_image_size($GLOBALS['thumb-size']);


	$height_video=round($dimensions[0]*9/16);


$format = get_post_format();
if ($format == 'video') {

    if (isset($meta_values['meta_video_type'][0])) {


        if ($meta_values['meta_video_type'][0] == 'vimeo') {
            $data = $data . do_shortcode(' [vimeo clip_id="' . $meta_values['meta_attachment'][0] . '" width="100%" height="'.$height_video.'"] ');
        } elseif ($meta_values['meta_video_type'][0] == 'youtube') {
            $data = $data . do_shortcode(' [youtube id="' . $meta_values['meta_attachment'][0] . '" width="100%" height="'.$height_video.'"] ');
        } elseif ($meta_values['meta_video_type'][0] == 'dailymotion') {
            $data = $data . do_shortcode(' [dailymotion id="' . $meta_values['meta_attachment'][0] . '" width="100%" height="'.$height_video.'"] ');
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


			$id_link = get_attachment_id_from_src($slide['image']);
			if($id_link !=''){
				$image_url = wp_get_attachment_image_src( $id_link, $GLOBALS['thumb-size']);
				$url = $image_url[0];
				$width = $image_url[1];
				$height = $image_url[2];
			}else {
				$url = $slide['image'];
				$width = '';
				$height = '';
			}
			
            $code = $code . '[flexslider_slide ] <img src="'.$url.'" width="'.$width.'" height="'.$height.'"  alt="" /> [/flexslider_slide]';
        }

        $code = $code . '[/flexslider]';


        $data = $data . do_shortcode($code);
    }
} else {
    if ($the_post_thumbnail != '') {
        $data = $data . '<a href="' . $permalink . '">' . $the_post_thumbnail . '</a>';
    }
}

?>