
<?php

$permalink = get_permalink();

$the_title = get_the_title();


ob_start();
the_author_posts_link();
$the_author_posts_link = ob_get_contents();
ob_end_clean();






$comments_number = do_shortcode('[post_comments_count post_id="'.get_the_ID().'" method="text"]');


$meta_values = get_post_custom(get_the_ID());


$cat_echo_p  = do_shortcode('[post_category post_id="'.get_the_ID().'"]');

$format = get_post_format();
$type = get_post_type(get_the_ID());

$GLOBALS['thumb-size'] = 'blog-post-thumb';


	$the_post_thumbnail = get_the_post_thumbnail(get_the_ID(),'3-col-cat');
	$data = $data . '<article class="box-container margin-bottom-20 blog-thumb style_cat clearfix"><div class=" "><a href="' . $permalink . '">'.$the_post_thumbnail.'</a><h2 class="clearfix blogtitle"><a class="title" href="' . $permalink . '">' . $the_title . '</a></h2>';

	
	
	include(get_template_directory() . '/library/includes/templates/meta-data.php');
	ob_start();
	the_excerpt_max_charlength(150);
	$the_excerpt_max_charlength = ob_get_contents();
	ob_end_clean();
	
	$data = $data . '<div class="clearfix"></div><p class="content-short"> ' . $the_excerpt_max_charlength . '</p></div></article>';
	




$mutual_array['cat-counter']++;
?>