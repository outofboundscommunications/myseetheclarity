<?php
get_header();
$meta_values = get_post_custom($post->ID);
?>
<div id="content">
    <?php
    if (!isset($meta_values['layout'][0])) {
        $meta_values['layout'][0] = 'right';
    }
    
    $layout = $meta_values['layout'][0];
    $article_layout = ot_get_option( 'article_layout' );
    
    if($article_layout!= ''){
    	$layout =$article_layout;
    }
    
    
    


    if ($layout == 'right' || $layout == 'left') {

        $main_class = 'span8';
    } else {

        $main_class = 'span12';
    }
    
    ?>

    <div id="inner-content" class="wrap clearfix" style="margin-top:200px;">

        <div id="inner-page-content">
            <div class="border">
                <div class="row-fluid">
                    <?php if ($layout == 'left') { ?>

                        <div id="sidebar" class="sidebar span4 clearfix" role="complementary">

                            <?php
                            if (!isset($meta_values['meta_sidebar'][0])) {
                                $meta_values['meta_sidebar'][0] = 'default';
                            }

                            if ($meta_values['meta_sidebar'][0] == "default") {
                                get_sidebar('post'); // sidebar Page 
                            } else {
                                dynamic_sidebar($meta_values['meta_sidebar'][0]);
                            }
                            ?>

                        </div>	
                    <?php }
                    ?>

                    <div id="main" class="<?php echo $main_class ?>  clearfix" role="main">

                        <?php if (have_posts()) : the_post(); ?>
								<?php setPostViews(get_the_ID()); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-thumb single post-content clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                            <span class="entry-title" style="display:none ;"><?php the_title(); ?></span>
                                <?php
                                $data = '';
                                ob_start();
                                the_permalink();
                                $permalink = ob_get_contents();
                                ob_end_clean();

                                ob_start();
                                the_title();
                                $the_title = ob_get_contents();
                                ob_end_clean();

                                ob_start();
                                the_author_posts_link();
                                $the_author_posts_link = ob_get_contents();
                                ob_end_clean();

                                ob_start();
                                the_title_attribute();
                                $the_title_attribute = ob_get_contents();
                                ob_end_clean();

                                
                                

                                ob_start();
                                the_excerpt_max_charlength(300);
                                $the_excerpt_max_charlength = ob_get_contents();
                                ob_end_clean();



                                ob_start();
                                comments_number(__('0 Comment', 'code125'), __('1 Comment', 'code125'), __('% Comments', 'code125'));
                                $comments_number = ob_get_contents();
                                ob_end_clean();


                                $cat_echo_p  = do_shortcode('[post_category post_id="'.get_the_ID().'"]');


                                $meta_values = get_post_custom(get_the_ID());
                                $user_ID = get_the_author_meta('ID');
                                $facebook_user = get_the_author_meta('facebook', $user_ID);
                                $twitter_user = get_the_author_meta('twitter', $user_ID);
                                $position_user = get_the_author_meta('position', $user_ID);
                                $format = get_post_format();
                                ?>



                                <?php
                                $data = '';
                                $featured_enable = ot_get_option('featured_enable');


                                if ($featured_enable != 'no') {
                                    if (!post_password_required()) {
                                    
                                        if($main_class == 'span12'){
                                        	$GLOBALS['thumb-size'] = 'portfolio-post-thumb-inside';
                                        }else {
                                        	$GLOBALS['thumb-size'] = 'blog-post-thumb-inside';
                                        }
                                        include(TEMPLATEPATH . '/library/includes/templates/post-formats.php');
                                    }
                                    echo $data;
                                    echo '<div style="height:20px"></div>';
                                }


                                
                                the_content();
                                
                                ?>
                                <div class="clearfix"></div>
                                <div class="pagination">
                                    <?php wp_link_pages(); ?>
                                </div>



                                <?php
                                if (!post_password_required()) {
                                    ?>
                                    <div class="clear30 clearfix">
                                        <ul class="meta-article-entry">
                                            <?php
                                            $author_enable = ot_get_option('author_enable');

                                            if ($author_enable != 'no') {
                                                ?><?php echo do_shortcode('[author_name icon="icon-user" wrap_li="true"] ' ); ?>
                                            <?php } ?>
                                            <?php
                                            $date_enable = ot_get_option('date_enable');

                                            if ($date_enable != 'no') {
                                                $time_date = ot_get_option('time_date');
                                                if ($time_date != 'clock') {
                                                    ?>
                                                    <li class="icon-pencil updated"> <?php echo get_the_time('F') . ' ' . get_the_time('j') . ', ' . get_the_time('Y') ?></li>
                                                <?php } else {
                                                    ?>
                                                    <li class="icon-pencil updated"> <?php echo get_the_time('j') . ' ' . get_the_time('M') . '\'' . get_the_time('y') . ', ' . get_the_time('h:i A'); ?></li>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            <?php
                                            $comments_count_enable = ot_get_option('comments_count_enable');

                                            if ($comments_count_enable != 'no') {
                                                ?>
                                                <li class="icon-comment"><?php echo get_total_number_of_comments($post->ID, 'text'); ?></li>
                                            <?php } ?>
                                            <?php
                                            $cat_enable = ot_get_option('cat_enable');

                                            if ($cat_enable != 'no') {
                                                ?>
                                                <li class="icon-archive"> <?php echo $cat_echo_p; ?></li>
                                            <?php } ?>
                                            <?php
                                            $tags_enable = ot_get_option('tags_enable');

                                            if (has_tag() && $tags_enable != 'no') {
                                                ?>
                                                <li class="icon-tag"> <?php the_tags('', ',  ', ''); ?></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="clear30 clearfix">
                                        <?php
                                        $like_enable = ot_get_option('like_enable');

                                        if ($like_enable != 'no') {
                                            ?>
                                            <div class="like-button-wrap">
                                                <?php echo getPostLikeLink($post->ID); ?>
                                            </div>
                                        <?php } ?>

                                        <?php if (has_review($post->ID)) { ?>
                                            <div class="rate-button-wrap">
                                                <?php echo get_stars_review(get_rating_average($post->ID)); ?>
                                                
                                                ​<div class="hreview" style="display: none;">
                                                   <span class="item">
                                                      <span class="fn"><?php the_title(); ?></span>
                                                   </span>
                                                   Reviewed by <span class="reviewer"><?php the_author() ?></span> on
                                                   <span class="dtreviewed">
                                                      <?php echo get_the_time('F') . ' ' . get_the_time('j') . ', ' . get_the_time('Y') ?><span class="value-title" title="<?php echo get_the_time('Y-m-d') ?>"></span>
                                                   </span>.
                                                   Rating: 
                                                   <span class="rating"><?php echo get_rating_average($post->ID) ?></span>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <?php
                                        $share_enable = ot_get_option('share_enable');

                                        if ($share_enable != 'no') {
                                            ?>
                                            <div class="dropdown share-button-wrap">
                                                <a href="#" class="share-button icon-share dropdown-toggle" data-toggle="dropdown"><?php _e('Share this post', 'code125') ?></a>
                                                <ul class="share dropdown-menu clearfix">
                                                    <li class="fb"><div class="fb-like" data-href="<?php the_permalink() ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div></li>
                                                    <li class="tw"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                                                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></li>
                                                    <li class="gp"><!-- Place this tag where you want the +1 button to render. -->
                                                        <div class="g-plusone" data-size="medium" data-href="<?php the_permalink() ?>"></div>

                                                        <!-- Place this tag after the last +1 button tag. -->
                                                        <script type="text/javascript">
                                                            (function() {
                                                                var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                                                                po.src = 'https://apis.google.com/js/plusone.js';
                                                                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                                                            })();
                                                        </script></li>
                                                    <?php
                                                    $id_link = get_post_thumbnail_id();

                                                    $image_url = wp_get_attachment_image_src($id_link, "full");
                                                    ?>
                                                    <li class="pinit"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo $image_url[0]; ?>&description=<?php echo $the_excerpt_max_charlength; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>

                                                </ul>
                                            </div>
                                        <?php } ?>
                                        <div class="clearfix"></div>

                                    </div>  


                                    <?php
                                    
                                    $post_type = get_post_type(get_the_ID());
                                    $tax = get_post_tax(get_the_ID());
                                    if($tax){
                                    $terms = wp_get_post_terms(get_the_ID(), $tax);
                                    
                                    $related_enable = ot_get_option('related_enable');
                                    if ($related_enable != 'no') {

                                        $related_type = ot_get_option('related_type');


                                        if ($related_type == 'tags' && $post_type =='post' ) {
                                            $tags = wp_get_post_tags($post->ID);
                                            if ($tags) {
                                                $tag_ids = array();
                                                foreach ($tags as $individual_tag)
                                                    $tag_ids[] = $individual_tag->term_id;

                                                $args = array(
                                                    'tag__in' => $tag_ids,
                                                    'post__not_in' => array($post->ID),
                                                    'posts_per_page' => -1, // Number of related posts that will be shown.  
                                                    'ignore_sticky_posts' => 1
                                                );
                                                $counter = 0;
												
                                            }
                                          } elseif ($related_type == 'category') {
                                            $post_categories = array();
                                            
                                            $terms = wp_get_post_terms(get_the_ID(), $tax);
                                            
                                            foreach ($terms as $term ) {
                                            	$post_categories[] = $term->term_id;
                                            }
                                            
                                            $args = array(
                                            	'tax_query' => array(
                                                		array(
                                                			'taxonomy' => $tax,
                                                			'field' => 'id',
                                                			'terms' => $post_categories
                                                		)
                                                	),
                                                'post__not_in' => array($post->ID),
                                                'posts_per_page' => 3, // Number of related posts that will be shown.  
                                                'ignore_sticky_posts' => 1
                                            );
                                            $counter = 0;

                                           
                                           } else {
                                                $args = array(
                                                    'post__not_in' => array($post->ID),
                                                    'posts_per_page' => 3, 
                                                    'orderby' => 'rand',
                                                    'ignore_sticky_posts' => 1
                                                );
                                                $counter = 0;

                                                
                                            }
?>
                                                <div style="height: 60px;"></div>
                                                <?php echo do_shortcode('[title title="'.__('Related', 'code125').'" icon="icon-tag"]'); ?>
                                                <div class="row-fluid">
                                                        <?php
                                                        
                                                        query_posts($args);
                                                        $data = '';
                                                          
                                                          while (have_posts()) : the_post();
                                                          			$data = $data . '<div class="span4">';
                                                        			include(TEMPLATEPATH . '/library/includes/templates/blog-style6.php');
                                                        			$data = $data . '</div>';
                                                        			
                                                        	
                                                        endwhile;
                                                        
                                                        echo $data;
                                                        wp_reset_query();
                                                        ?>
                                                        
                                                </div>
                                                <?php                                            
                                        }
                                        }
                                        ?>  
                                        <?php
                                        $comments_enable = ot_get_option('comments_enable');

                                        if ($comments_enable != 'no' && $post_type =='post') {
                                            ?>
                                            <footer class="article-footer clearfix">
                                                <?php
                                                $facebook_comments = ot_get_option('facebook_comments');
                                                if ($facebook_comments != 'no') {
                                                    ?>
                                                    <?php
                                                    $comments_order = ot_get_option('comments_order');
                                                    if ($comments_order != 'comments_facebook') {
                                                        ?>
                                                        <ul class="custom_tabs">
                                                            <li class="first_li current"><a class=" icon-facebook-1" href="#"><?php _e('Facebook Comments', 'code125'); ?></a></li>
                                                            <li><a class="icon-comment" href="#"><?php _e('Website Comments', 'code125'); ?></a></li></ul>
                                                    <?php } else { ?>
                                                        <ul class="custom_tabs">
                                                            <li class="first_li current"><a class=" icon-comment" href="#"><?php _e('Website Comments', 'code125'); ?></a></li>
                                                            <li><a class="icon-facebook-1" href="#"><?php _e('Facebook Comments', 'code125'); ?></a></li></ul>
                                                    <?php } ?>

                                                    <div class="custom_tabs_wrap">
                                                        <?php if ($comments_order != 'comments_facebook') { ?>
                                                            <div class="custom_tabs_content" style="display: block;">
                                                                <div class="fb-comments" data-href="<?php echo $permalink ?>" data-width="564" data-num-posts="5" data-colorscheme="<?php echo ot_get_option('facebook_color') ?>"></div>
                                                            </div>

                                                            <div class="custom_tabs_content" style="display: none;">
                                                            <?php } else { ?>

                                                                <div class="custom_tabs_content" style="display: block;">

                                                                    <?php
                                                                }
                                                            } comments_template();


                                                            $commenter = wp_get_current_commenter();
                                                            $req = get_option('require_name_email');
                                                            $aria_req = ( $req ? " aria-required='true'" : '' );
                                                            $fields = array(
                                                                'author' => '<div class="span4"><p class="label-input">' . __('Name ', 'code125') . '<span class="req">' . __('(Required)', 'code125') . '</span></p><div class="input-wrap"><input id="author" name="author" class="element-block " type="text" value="' .
                                                                esc_attr($commenter['comment_author']) . '" size="30" tabindex="1" ' . $aria_req . ' placeholder=""  /><span class="icon-user"></span></div></div>',
                                                                'email' => '<div class="span4"><p class="label-input">' . __('Email ', 'code125') . '<span class="req">' . __('(Required)', 'code125') . '</span></p><div class="input-wrap"><input id="email" name="email" class="element-block" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" tabindex="2" ' . $aria_req . ' placeholder="" /><span class="icon-mail"></span></div></div>' .
                                                                '</label>',
                                                                'url' => '<div class="span4"><p class="label-input">' . __('Website ', 'code125') . '</span></p><div class="input-wrap"><input id="url" name="url" type="text" class="element-block " value="' . esc_attr($commenter['comment_author_url']) . '" size="30" tabindex="3"  placeholder="" /><span class="icon-globe"></span></div></div>' .
                                                                '</label >'
                                                            );



                                                            $defaults = array(
                                                                'fields' => apply_filters('comment_form_default_fields', $fields),
                                                                'id_form' => 'commentform',
                                                                'id_submit' => 'submit',
                                                                'title_reply' => '<h3 class="title"><span class="title" data-title="' . __('LEAVE A COMMENT TO THIS POST', 'code125') . '">' . __('LEAVE A COMMENT TO THIS POST', 'code125') . '</span></h3><div class="row-fluid">',
                                                                'comment_notes_after' => '',
                                                                'title_reply_to' => __('Leave a Reply to %s', 'code125'),
                                                                'cancel_reply_link' => __('Cancel reply', 'code125'),
                                                                'label_submit' => __('Send comment.', 'code125'),
                                                                'comment_field' => '</div><p class="label-input">' . __('Your Comment ', 'code125') . '<span class="req">' . __('(Required)', 'code125') . '</span></p><textarea id="comment"  name="comment"  class="element-block  " tabindex="4" aria-required="true"></textarea>',
                                                                'comment_notes_before' => ''
                                                            );

                                                            comment_form($defaults);
                                                            if ($facebook_comments != 'no') {
                                                                ?>
                                                            </div>
                                                            <?php if ($comments_order == 'comments_facebook') { ?>
                                                                <div class="custom_tabs_content" style="display: none;">
                                                                    <div class="fb-comments" data-href="<?php echo $permalink ?>" data-width="564" data-num-posts="5" data-colorscheme="<?php echo ot_get_option('facebook_color') ?>"></div>
                                                                </div>
                                                            <?php } ?>       
                                                        </div>
                                                    <?php } ?>
                                            </footer>
                                        <?php } ?>
                                    <?php } ?>


                            </article> <!-- end article -->



                        <?php else : ?>

                            <article id="post-not-found" class="hentry clearfix">
                                <header class="article-header">
                                    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
                                </header>
                                <section class="post-content">
                                    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
                                </section>
                                <footer class="article-footer">
                                    <p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
                                </footer>
                            </article>

                        <?php endif; ?>

                    </div> <!-- end #main -->


                    <?php
                    if (!isset($layout)) {
                        $layout = 'right';
                    }

                    if ($layout == 'right') {
                        ?>

                        <div id="sidebar" class="sidebar span4 clearfix" role="complementary">

                            <?php
                            if (!isset($meta_values['meta_sidebar'][0])) {
                                $meta_values['meta_sidebar'][0] = 'default';
                            }

                            if ($meta_values['meta_sidebar'][0] == "default") {
                                get_sidebar('post'); // sidebar Page 
                            } else {
                                dynamic_sidebar($meta_values['meta_sidebar'][0]);
                            }
                            ?>

                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>