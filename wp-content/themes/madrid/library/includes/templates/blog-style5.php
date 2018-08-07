
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


$type = get_post_type(get_the_ID());


$user_ID =  get_the_author_meta('ID') ;
$format = get_post_format();

$data = $data . '<article class="blog-thumb hideme  box-container style_4 clearfix">';


$GLOBALS['thumb-size'] = 'blog-post-thumb-680';





$data = $data . '<div class="row-fluid"><div class="span3">';


$data = $data . '<div class="style_4_wrap"><a class="author-photo clearfix" href="'.get_author_posts_url($user_ID).'">'.get_avatar( $user_ID, '100', '', '<span class="icon-user"></span>' ).'</a>';


include(get_template_directory() . '/library/includes/templates/meta-data.php');

$data = $data . '</div></div><div class="span9"><h2 class="clearfix blogtitle"><a class="title" href="' . $permalink . '">'.$the_title.'</a></h2>';

include(get_template_directory() . '/library/includes/templates/post-formats.php');

$data = $data . '<div class="clearfix"></div><p class="content-short"></p>';

$data = $data . '<a href="#" class="show-full-post roll-link-html btn-block" data-id="'.get_the_ID().'" data-type="'.$type.'" data-loading="'.__('Loading Article','code125').'" data-close="'.__('Close Article','code125').'" data-done="'.__('Load Article','code125').'" ><span class="text ">'.__('Load Article','code125').'<span class="more-right icon-down-dir-1"></span></span><span class="hover ">'.__('Load Article','code125').'<span class="more-right icon-down-dir-1"></span></span></a>';


$data = $data . '</div></div></article>';
?>