
<?php

$permalink = get_permalink();

$the_title = get_the_title();


ob_start();
the_author_posts_link();
$the_author_posts_link = ob_get_contents();
ob_end_clean();


$the_post_thumbnail = get_the_post_thumbnail(get_the_ID(),'4-col-s');


ob_start();
the_excerpt_max_charlength(200);
$the_excerpt_max_charlength = ob_get_contents();
ob_end_clean();


$comments_number = do_shortcode('[post_comments_count post_id="'.get_the_ID().'" method="text"]');


$meta_values = get_post_custom(get_the_ID());


$cat_echo_p  = do_shortcode('[post_category post_id="'.get_the_ID().'"]');


$type = get_post_type(get_the_ID());



$format = get_post_format();


$data = $data . '<article class="blog-thumb hideme  style_3 clearfix"><div class="row-fluid">';






$data = $data . '<div class="span3">';


    if ($the_post_thumbnail != '') {
        $data = $data . '<a href="' . $permalink . '">' . $the_post_thumbnail . '</a>';
    }else {
    	$data = $data . '<div class="large-icon-wrap"><span class="large-icon '.get_post_format_icon(get_the_ID()).'"></span></div>';
    }







$data = $data . '</div><div class="span9"><h2 class="clearfix blogtitle"><a class="title" href="' . $permalink . '">' . $the_title . '</a></h2>';


include(get_template_directory() . '/library/includes/templates/meta-data.php');

$data = $data . '<div class="clearfix"></div><p class="content-short"> ' . $the_excerpt_max_charlength . '</p>';

//$data = $data . '<div class="clearfix"></div>' . do_shortcode('[button_2 color="' . $GLOBALS['primary_color'] . '" size="button-med" float="left" icon="icon-right-open" text="' . __('Read More', 'code125') . '" link="' . $permalink . '"]') . '';

$data = $data . '<div class="clearfix"></div>' . do_shortcode('[button_2 color="' . $GLOBALS['primary_color'] . '" size="button-med" float="left" icon="" text="' . __('Read More', 'code125') . '" link="' . $permalink . '"]') . '';

$data = $data . '</div></div></article>';

?>