<?php
get_header();
$meta_values = get_post_custom($post->ID);
?>

<div id="content">
    <?php
    if (!isset($meta_values['meta_portfolio_layout'][0])) {
        $meta_values['meta_portfolio_layout'][0] = 'sidebar';
    }


    if ($meta_values['meta_portfolio_layout'][0] == 'sidebar') {

        $main_class = 'span8';
    } else {

        $main_class = 'span12';
    }
    ?>

    <div id="inner-content" class="wrap clearfix">

        <div id="inner-page-content">
            <div class="border">
                    <div id="main" class=" row-fluid clearfix" role="main">

                        <?php if (have_posts()) : the_post(); ?>
							<?php setPostViews(get_the_ID()); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-thumb single single-portfolio post-content clearfix ' . $main_class); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
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


                                ob_start();
                                the_category(' - ');
                                $cat_echo_p = ob_get_contents();
                                ob_end_clean();



                                $meta_values = get_post_custom(get_the_ID());
                                $user_ID = get_the_author_meta('ID');
                                $facebook_user = get_the_author_meta('facebook', $user_ID);
                                $twitter_user = get_the_author_meta('twitter', $user_ID);
                                $position_user = get_the_author_meta('position', $user_ID);
                                $format = get_post_format();
                                ?>



                                <?php
                                $data = '';
                                $featured_enable = ot_get_option('featured_enable_portfolio');


                                if ($featured_enable != 'no') {
                                    if (!post_password_required()) {
                                        
                                        
                                        if (!isset($meta_values['meta_portfolio_layout'][0])) {
                                            $meta_values['meta_portfolio_layout'][0] = 'sidebar';
                                        }
                                        if ($meta_values['meta_portfolio_layout'][0] == 'sidebar') { 
                                        	$GLOBALS['thumb-size'] = 'blog-post-thumb-inside';
                                        }else {
                                        	$GLOBALS['thumb-size'] = 'portfolio-post-thumb-inside';
                                        }
                                        
                                        include(TEMPLATEPATH . '/library/includes/templates/post-formats.php');
                                        
                                        
                                    }
                                    echo $data;
                                }
								if (!isset($meta_values['meta_portfolio_layout'][0])) {
								    $meta_values['meta_portfolio_layout'][0] = 'sidebar';
								}
								
								 if ($meta_values['meta_portfolio_layout'][0] != 'sidebar') { 
									
										the_content();
								} 
                                
                                ?>
                                <div class="clearfix"></div>
                                <div class="pagination">
                                    <?php wp_link_pages(); ?>
                                </div>
                                </article> <!-- end article -->
                                <?php 
                                
                                if (!isset($meta_values['meta_portfolio_layout'][0])) {
                                    $meta_values['meta_portfolio_layout'][0] = 'sidebar';
                                }
                                if ($meta_values['meta_portfolio_layout'][0] == 'sidebar') { 
                                	?>
                                	<div class=" span4 clearfix" role="complementary">
                                	
                                	 <?php
                                		the_content();
                                	 ?>
                                		  </div>
                                <?php	} ?>

						<div class="clearfix"></div>
						<footer class="article-header">
						<div class="header_divider"></div>
							<?php 
							$related_enable = ot_get_option('related_enable');
							if($related_enable!='no'){
							 ?>
							<?php echo do_shortcode( '[4col_posts type="portfolio" order="rand" orderby="rand" title="'.__('Random Projects','code125').'"]' );  ?>
							
							<?php } ?>
						
						</footer> <!-- end article footer -->
						

                            



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


            </div>
        </div>
    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>