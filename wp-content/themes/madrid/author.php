<?php get_header(); ?>
<?php

            $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
            ?>
<div id="content">

    <div id="inner-content" class="wrap  clearfix">


        <div id="inner-page-content">
        <div class="border">
        <div class="row-fluid">
        <?php 
        
        
         $result_type= ot_get_option('category_type');
        
        
        $columns_count= ot_get_option('columns_count');
        
        
        $columns_per_page  = ot_get_option('columns_per_page');
        $pagination_method= ot_get_option('pagination_method');
        
        $GLOBALS['columns_team'] = $columns_count;
        $columns_type= ot_get_option('columns_type'); 
        
        
       
        
        if ($columns_type == 'square-flexible') {
            $shape = '-square-flexible';
        }elseif ($columns_type == 'square') {
            $shape = '-square';
        }elseif ($columns_type == 'circle') {
            $shape = '-circle';
        }elseif($columns_type == 'square-metro') {
        	$shape = '-square-metro';
        }elseif($columns_type == 'octagon') {
        	$shape = '-oct';
        }
        
        if($result_type == '' ){
        	$result_type == '1';
        }
        if( $result_type == '1' || $result_type == '3'){
        	
        	$main_class= 'span8';
        	
        }else{
        
        	$main_class= 'span12';
        
        }
        ?>
        <div id="main" class="<?php echo $main_class ?>  clearfix" role="main">
        <div class="row-fluid">
        
                           <?php echo do_shortcode('[space_30]'); ?>
                              <?php
                                    $facebook_user = get_the_author_meta('facebook', $curauth->ID);
                                    $twitter_user = get_the_author_meta('twitter', $curauth->ID);
                                    $position_user = get_the_author_meta('position', $curauth->ID);
        
        
                                    $google_plus_user = get_the_author_meta('google_plus', $curauth->ID);
                                    $behance_user = get_the_author_meta('behance', $curauth->ID);
                                    $dribble_user = get_the_author_meta('dribble', $curauth->ID);
        				if($main_class == 'span8'){
                                    $data = '<div class=" box-container clearfix meta-data-single"><div class="row-fluid"><div class="span2">';
        
                                    $data = $data . get_avatar($curauth->ID, '100', '', '<span class="icon-user"></span>') . '</div><div class="span3 article_author"><a >' . $curauth->display_name . '</a><p>' . $position_user . '</p><div class="clearfix"></div>';
                                    if ($twitter_user != '') {
                                        $data = $data . '<div class=""><a href="https://twitter.com/' . $twitter_user . '" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @' . $twitter_user . '</a>
        					    		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';
                                    }
        
                                    if ($facebook_user != '') {
                                        $data = $data . '<div class="float_left_fb"><div class="fb-follow" data-href="https://www.facebook.com/' . $facebook_user . '" data-layout="button_count" data-show-faces="true" data-font="verdana" data-width="100"></div></div>';
                                    }
                              
                                    echo $data;
                                    $data = '';
                                    ?>
                                </div>
                                <div class="span7">
                                    <ul class="social-icons clearfix">
                                        <?php
                                        if ($facebook_user != '') {
                                            echo '<li><a href="http://www.facebook.com/people/@/' . $facebook_user . '" class="icon-facebook"></a></li>';
                                        }
        
                                        if ($twitter_user != '') {
                                            echo '<li><a href="http://www.twitter.com/' . $twitter_user . '" class="icon-twitter"></a></li>';
                                        }
        
                                        if ($google_plus_user != '') {
                                            echo '<li><a href="' . $google_plus_user . '" class="icon-google-plus"></a></li>';
                                        }
        
                                        if ($behance_user != '') {
                                            echo '<li><a href="' . $behance_user . '" class="code125-social-behance"></a></li>';
                                        }
        
                                        if ($dribble_user != '') {
                                            echo '<li><a href="' . $dribble_user . '" class="code125-social-dribble"></a></li>';
                                        }
        
                                        if ($curauth->user_email != '') {
                                            echo '<li><a href="mailto:' . $curauth->user_email . '" class="icon-envelope-alt"></a></li>';
                                        }
        
                                        if ($curauth->user_url != '') {
                                            echo '<li><a href="' . $curauth->user_url . '" class="icon-link"></a></li>';
                                        }
                                        ?>
                                    </ul>
                                    <?php
                                    echo '<p class="author_description arrow_left"><span class="arrow-left"></span>' . $curauth->user_description . '</p>';
                                    ?>
                                </div>
                            </div>
                            </div>
                            <?php 
                            }else {
                            	$data = '<div class=" box-container clearfix meta-data-single"><div class="row-fluid"><div class="span2">';
                            	
                            	                            $data = $data . get_avatar($curauth->ID, '150', '', '<span class="icon-user"></span>') . '</div><div class="span2 article_author"><a >' . $curauth->display_name . '</a><p>' . $position_user . '</p><div class="clearfix"></div>';
                            	                            if ($twitter_user != '') {
                            	                                $data = $data . '<div class=""><a href="https://twitter.com/' . $twitter_user . '" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @' . $twitter_user . '</a>
                            						    		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';
                            	                            }
                            	
                            	                            if ($facebook_user != '') {
                            	                                $data = $data . '<div class="float_left_fb"><div class="fb-follow" data-href="https://www.facebook.com/' . $facebook_user . '" data-layout="button_count" data-show-faces="true" data-font="verdana" data-width="100"></div></div>';
                            	                            }
                            	                      
                            	                            echo $data;
                            	                            $data = '';
                            	                            ?>
                            	                        </div>
                            	                        <div class="span8">
                            	                            <ul class="social-icons clearfix">
                            	                                <?php
                            	                                if ($facebook_user != '') {
                            	                                    echo '<li><a href="http://www.facebook.com/people/@/' . $facebook_user . '" class="icon-facebook"></a></li>';
                            	                                }
                            	
                            	                                if ($twitter_user != '') {
                            	                                    echo '<li><a href="http://www.twitter.com/' . $twitter_user . '" class="icon-twitter"></a></li>';
                            	                                }
                            	
                            	                                if ($google_plus_user != '') {
                            	                                    echo '<li><a href="' . $google_plus_user . '" class="icon-google-plus"></a></li>';
                            	                                }
                            	
                            	                                if ($behance_user != '') {
                            	                                    echo '<li><a href="' . $behance_user . '" class="code125-social-behance"></a></li>';
                            	                                }
                            	
                            	                                if ($dribble_user != '') {
                            	                                    echo '<li><a href="' . $dribble_user . '" class="code125-social-dribble"></a></li>';
                            	                                }
                            	
                            	                                if ($curauth->user_email != '') {
                            	                                    echo '<li><a href="mailto:' . $curauth->user_email . '" class="icon-envelope-alt"></a></li>';
                            	                                }
                            	
                            	                                if ($curauth->user_url != '') {
                            	                                    echo '<li><a href="' . $curauth->user_url . '" class="icon-link"></a></li>';
                            	                                }
                            	                                ?>
                            	                            </ul>
                            	                            <?php
                            	                            echo '<p class="author_description arrow_left"><span class="arrow-left"></span>' . $curauth->user_description . '</p>';
                            	                            ?>
                            	                        </div>
                            	                    </div>
                            	                    </div>
                            	                    <?php
                            }
                            
                             ?>
                            </div>
                             <?php echo do_shortcode('[space_30]'); ?>
        
        <?php
        
        if($result_type == 'columns'){
        	echo '<div id="items_container" class="posts-ajax-wrap super-list portfolio portfolio_'.$GLOBALS['columns_team'].'_cols'.$shape.'  portfolio_items variable-sizes clearfix">';
        } ?>
        					    <?php if (have_posts()) : while (have_posts()) : the_post(); 
        					    
        					    
        					    
        					     $data = '';
        					     if($result_type != 'columns'){
        					     	include(TEMPLATEPATH . '/library/includes/templates/blog-style'.$result_type.'.php');
        					     }else {
        					     	include(TEMPLATEPATH . '/library/includes/templates/portfolio-style'.$columns_count.$shape.'.php');
        					     }
        					     
        					      				      
        					       	echo $data; 
        					    
        					     endwhile; 	
        					     if($result_type == 'columns'){
        					     	echo '</div>';
        					     }
        					     ?>
        						<?php if($pagination_method == 'pagination_method'){
        						 ?>
        					        <?php if (function_exists('bones_page_navi')) { // if experimental feature is active ?>
        						
        						        <?php bones_page_navi(); // use the page navi function ?>
        
        					        <?php } else { // if it is disabled, display regular wp prev & next links ?>
        						        <nav class="wp-prev-next">
        							        <ul class="clearfix">
        								        <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', "code125")) ?></li>
        								        <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', "code125")) ?></li>
        							        </ul>
        					    	    </nav>
        					        <?php } ?>
        					    <?php }else{ 
        					    	if($result_type == 'columns'){ 
        					    			
        					    		$data = '<a href="#" class="do-show-more-posts roll-link-html btn-block"  data-order="DESC" data-orderby="date" data-cat="'.get_query_var('cat').'" data-per-click="'.$columns_per_page.'" data-post-type="post" data-current-shortcode="portfolio-style'.$columns_count.$shape.'" data-column="'.$GLOBALS['columns_team'].'" data-page="2" data-color="'.$GLOBALS['primary_color'].'" data-isotope="true" data-done="'.__('There are no more posts.','code125').'" data-loading="'.__('Loading Data','code125').'"  data-loaded="'.__('Load More','code125').'"><span class="text ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span><span class="hover ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span></a>';
        					    			
        					    			echo $data ;
        					    	
        					    	}else { 
        					    	
        					    	$data =  '<a href="#" class="do-show-more-posts roll-link-html btn-block" data-order="DESC"  data-orderby="date"   data-cat="'.get_query_var('cat').'" data-per-click="'.$columns_per_page.'" data-post-type="post" data-current-shortcode="blog-style'.$result_type.'"  data-page="2" data-color="'.$GLOBALS['primary_color'].'" data-isotope="false" data-done="'.__('There are no more posts.','code125').'" data-loading="'.__('Loading Data','code125').'"  data-loaded="'.__('Load More','code125').'"><span class="text ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span><span class="hover ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span></a>';
        					    	echo $data ;
        					    	}
        					    }
        					    ?>
        					
        					    <?php else : ?>
        					
            					    <article id="post-not-found" class="hentry clearfix">
            						    <header class="article-header">
            							    <h1><?php _e("Sorry, No Results.", "code125"); ?></h1>
            					    	</header>
            						    <section class="post-content">
            							    <p><?php _e("Try your search again.", "code125"); ?></p>
                						</section>
            	    					
            				    	</article>
        					
        					    <?php endif; ?>
        			
            				</div> <!-- end #main -->
            							   	<?php if($main_class=="span8"){ ?>
            							   	
            							   	<div id="sidebar" class="sidebar span4 clearfix" role="complementary">
            							   		<?php echo do_shortcode('[space_30]'); ?>
            							   		<?php
            							   		
            							   		    get_sidebar(); // sidebar Page 
            							   		
            							   		?>
            							   		
            							   	</div>
            							   	
            							   	<?php } ?>
            							   
                        
                        </div> <!-- end #inner-content -->
                        
        			</div> <!-- end #content -->
        			</div>
        			</div>
        			</div>
        			</div>

 <div style="height: 30px;"></div>

<?php get_footer(); ?>