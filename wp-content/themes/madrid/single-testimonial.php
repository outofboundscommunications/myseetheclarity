<?php
get_header();
$meta_values = get_post_custom($post->ID);
?>

<div id="content">
    <?php
    if (!isset($meta_values['layout'][0])) {
        $meta_values['layout'][0] = 'right';
    }


    if ($meta_values['layout'][0] == 'right' || $meta_values['layout'][0] == 'left') {

        $main_class = 'span8';
    } else {

        $main_class = 'span12';
    }
    ?>

    <div id="inner-content" class="wrap clearfix">

        <div id="inner-page-content">
            <div class="border">
                <div class="row-fluid">
                    <?php if ($meta_values['layout'][0] == 'left') { ?>

                        <div id="sidebar" class="sidebar span4 clearfix" role="complementary">

                            <?php
                            if (!isset($meta_values['sidebar'][0])) {
                                $meta_values['sidebar'][0] = 'default';
                            }

                            if ($meta_values['sidebar'][0] == "default") {
                                get_sidebar('post'); // sidebar Page 
                            } else {
                                dynamic_sidebar($meta_values['sidebar'][0]);
                            }
                            ?>

                        </div>	
                    <?php }
                    ?>

                    <div id="main" class="<?php echo $main_class ?>  clearfix" role="main">

                        <?php if (have_posts()) : the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-thumb single post-content clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                                
                                <div class="row-fluid">
                                	<div class="span3"><?php the_post_thumbnail('6-col-o');  ?></div>
                                	<div class="span9">
                                		<div class="review-content"><div class="review-content-arrow"></div>
                                	<?php if($meta_values['author_name'][0]!=''){
                                		if($meta_values['author_link'][0]==''){
                                			echo '<h4>'.$meta_values['author_name'][0].'</h4>';
                                		}else {
                                			echo '<h4><a href="'.$meta_values['author_link'][0].'">'.$meta_values['author_name'][0].'</a></h4>';
                                		}
                                		
                                	
                                	} ?>
                                	
                                	<?php the_content();	?>
                                	
                                	</div></div>
                                </div>
                                
                                <div class="clearfix"></div>
                                <div class="pagination">
                                    <?php wp_link_pages(); ?>
                                </div>


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
                    if (!isset($meta_values['layout'][0])) {
                        $meta_values['layout'][0] = 'right';
                    }

                    if ($meta_values['layout'][0] == 'right') {
                        ?>

                        <div id="sidebar" class="sidebar span4 clearfix" role="complementary">

                            <?php
                            if (!isset($meta_values['sidebar'][0])) {
                                $meta_values['sidebar'][0] = 'default';
                            }

                            if ($meta_values['sidebar'][0] == "default") {
                                get_sidebar('post'); // sidebar Page 
                            } else {
                                dynamic_sidebar($meta_values['sidebar'][0]);
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