<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="wrap  clearfix">


        <div id="inner-page-content">
        <div class="border">
        <div class="row-fluid">
        <?php 
        
        
         $result_type= ot_get_option('search_category_type');
        
        
        $columns_count= ot_get_option('search_columns_count');
        
        
        
        $GLOBALS['columns_team'] = $columns_count;
        $columns_type= ot_get_option('search_columns_type'); 
        
        
       
        
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

 <div style="height: 30px;"></div>

<?php get_footer(); ?>