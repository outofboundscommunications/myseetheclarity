<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="wrap  clearfix">


        <div id="inner-page-content">
        <div class="border">
        <div class="row-fluid">
        <?php 
        
        
         $result_type= get_page_parameter('category_type','',false);
        
        $columns_count= get_page_parameter('columns_count','',false);
        
        
        $columns_per_page  = get_page_parameter('columns_per_page','',false);
        $pagination_method= get_page_parameter('pagination_method','numerical',false);
        
        $GLOBALS['columns_team'] = $columns_count;
        $columns_type= get_page_parameter('columns_type','',false); 
        
        
       
        
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
        
        
        
        
        
        $category_slider  = get_page_parameter('category_slider','',false);
        
        $tax_array = get_tax_array();
        foreach ($tax_array as $value) {
        	$tax_id_temp = get_query_var($value);
        	if($tax_id_temp !=''){
        		$tax_id = $tax_id_temp;
        		$tax_value= $value;
        		$post_type = get_post_type_by_cat($tax_value);
        	}	
        }
        
        if(!is_int($tax_id)){
        	$cat = get_term_by( 'slug', $tax_id, $tax_value);
        	$tax_id = $cat->term_id;
        }
       
        if($category_slider == 'latest' || $category_slider == 'popular'){
        $args2 = array(
        	'posts_per_page' => 5, /* you can change this to show more */
        	'post_type' => array( $post_type),
        	'tax_query' => array(
        		array(
        				'taxonomy' => $tax_value,
        				'field' => 'id',
        				'terms' => $tax_id
        			)
        		), 
        	'order'=>'DESC',
        	'orderby' => 'date'
        	);
        	
        }elseif($category_slider == 'likes'){
        $args2 = array(
        	'posts_per_page' => 5, /* you can change this to show more */
        	'post_type' => array(  $post_type ),
        	
        	'tax_query' => array(
        			array(
        				'taxonomy' => $tax_value,
        				'field' => 'id',
        				'terms' => $tax_id
        			)
        		),
        	'order'=>'DESC',
        	'orderby' => 'meta_value_num',
        	'meta_key' => 'votes_count'
        	);
        }elseif($category_slider == 'views'){
        $args2 = array(
        	'posts_per_page' => 5, /* you can change this to show more */
        	'post_type' => array(  $post_type),
        	
        	'tax_query' => array(
        			array(
        				'taxonomy' =>$tax_value,
        				'field' => 'id',
        				'terms' => $tax_id
        			)
        		),
        	'order'=>'DESC',
        	'orderby' => 'meta_value_num',
        	'meta_key' => 'post_views_count'
        	);
        }elseif($category_slider == 'rated'){
        $args2 = array(
        	'posts_per_page' => 5, /* you can change this to show more */
        	'post_type' => array(  $post_type ),
        	
        	'tax_query' => array(
        			array(
        				'taxonomy' => $tax_value,
        				'field' => 'id',
        				'terms' => $tax_id
        			)
        		),
        	'order'=>'DESC',
        	'orderby' => 'meta_value_num',
        	'meta_key' => 'rating_average'
        	);
        }
        
        
        if($category_slider!='none'){
        query_posts($args2);
          
          
          $data = '[posts_slider width_type="'.$main_class.'" ]';
          
          while (have_posts()) : the_post();
          
        			$data = $data . '[posts_slide id="'.get_the_ID().'" type="'.$post_type.'"]';
        			   	
        endwhile;
        
        
        	$data = $data . '[/posts_slider]';					    		
        
         wp_reset_query();
         echo do_shortcode($data);
        }
        
        if($post_type == 'team'){
        	$file_print = 'team';
        }else {
        	$file_print = 'portfolio';
        }
        
        
        if($result_type == 'columns'){
        	echo '<div id="items_container" class="posts-ajax-wrap super-list '.$file_print.' portfolio_'.$GLOBALS['columns_team'].'_cols'.$shape.'  portfolio_items variable-sizes clearfix">';
        } ?>
        					    <?php if (have_posts()) : while (have_posts()) : the_post(); 
        					    
        					    
        					    
        					     $data = '';
        					     if($result_type != 'columns'){
        					     	include(TEMPLATEPATH . '/library/includes/templates/blog-style'.$result_type.'.php');
        					     }else {
        					     	include(TEMPLATEPATH . '/library/includes/templates/'.$file_print.'-style'.$columns_count.$shape.'.php');
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
        					    			
        					    		$data = '<a href="#" class="do-show-more-posts roll-link-html btn-block"  data-order="DESC" data-orderby="date" data-cat="'.$tax_id.'" data-per-click="'.$columns_per_page.'" data-post-type="'.$post_type.'" data-current-shortcode="'.$file_print.'-style'.$columns_count.$shape.'" data-column="'.$GLOBALS['columns_team'].'" data-page="2" data-color="'.$GLOBALS['primary_color'].'" data-isotope="true" data-done="'.__('There are no more posts.','code125').'" data-loading="'.__('Loading Data','code125').'"  data-loaded="'.__('Load More','code125').'"><span class="text ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span><span class="hover ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span></a>';
        					    			
        					    			echo $data ;
        					    	
        					    	}else { 
        					    	
        					    	$data =  '<a href="#" class="do-show-more-posts roll-link-html btn-block" data-order="DESC"  data-orderby="date"   data-cat="'.$tax_id.'" data-per-click="'.$columns_per_page.'" data-post-type="'.$post_type.'" data-current-shortcode="blog-style'.$result_type.'"  data-page="2" data-color="'.$GLOBALS['primary_color'].'" data-isotope="false" data-done="'.__('There are no more posts.','code125').'" data-loading="'.__('Loading Data','code125').'"  data-loaded="'.__('Load More','code125').'"><span class="text ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span><span class="hover ">'.__('Load More','code125').'<span class="more-right icon-down-dir-1"></span></span></a>';
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