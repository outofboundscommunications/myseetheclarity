<?php get_header(); 


if(function_exists('icl_object_id')){
	$home = icl_object_id(ot_get_option( 'homepage' ), 'page', true);
	
}else {
	$home = ot_get_option( 'homepage' );	
}



if( $home != ''){
$meta_values = get_post_custom($home);
if(!isset($meta_values['layout'][0])){
	$meta_values['layout'][0] = 'full';
}


if( $meta_values['layout'][0] == 'right' || $meta_values['layout'][0] == 'left'){
	
	$main_class= 'span8';
	$midpage1= 'mid-page';
	$midpage2= '';
	
}else{

	$main_class= 'span12';
	$midpage2= 'mid-page';
	$midpage1= '';

}


?>
			
			<div id="inner-content" class="wrap clearfix">
				
				<div id="inner-page-content" class="<?php echo $midpage1 ?>">
				<div class="row-fluid">
			<?php if ($meta_values['layout'][0] == 'left') { ?>
			
			<div id="sidebar" class="sidebar span4 clearfix" role="complementary">
				
				<?php
				if(!isset($meta_values['sidebar'][0])){
					$meta_values['sidebar'][0] = 'default';
				}
				
				if ($meta_values['sidebar'][0] == "default") {
				    get_sidebar('page'); // sidebar Page 
				} else {
				    if($meta_values['sidebar'][0] == 'primary'){
				    	get_sidebar();
				    }else{
				    	dynamic_sidebar($meta_values['sidebar'][0]);
				    }
				}
				?>
				
			</div>	
			<?php 	
				
			} 
			?>
			
				    <div id="main" class="<?php echo $main_class ?>  clearfix" role="main">
				    						
				    					    <?php
				    					    wp_reset_postdata();
				    					     $custom_query = new WP_Query('p=' . $home . '&post_type=page&posts_per_page=1');
				    					    
				    					     if ($custom_query->have_posts()) :  $custom_query->the_post(); ?>
				    					
				    					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				    						
				    						    					
				    						    <section class="post-content clearfix" itemprop="articleBody">
				    						     <div class="<?php echo $midpage2 ?>">
				    						    <?php 
				    						    query_posts('p=1');
				    						    while (have_posts()) : the_post();
				    						    endwhile;
				    						    wp_reset_postdata();
				    						     ?>
				    							 <?php 
				    							  if(!isset($meta_values['meta_use_layout_builder'][0])){
				    							  		$meta_values['meta_use_layout_builder'][0] = 'no';
				    							  } 
				    							  
				    							  if($meta_values['meta_use_layout_builder'][0] == 'yes'){
				    							  if(isset($meta_values['meta_template_id'][0]) && $meta_values['meta_template_id'][0]!= ''){
				    							  	echo do_shortcode('[template id="'.$meta_values['meta_template_id'][0].'"]');
				    							  }else{
				    							  the_content();
				    							  
				    							  }
				    							    
				    							   }else{
				    							 	     the_content();
				    							   }?>
				    							   </div>							
				    							   </section> <!-- end article section -->
				    												  
				    					
				    					    </article> <!-- end article -->
				    						
				    					
				    					    <?php endif ; ?>
				    					
				        					   
				    			
				        				</div> <!-- end #main --><!-- end #main -->
    
				    <?php if ( $meta_values['layout'][0] == 'right'  ) { ?>
				    	
				    	<div id="sidebar" class="sidebar span4 clearfix" role="complementary">
				    		
				    		<?php
				    		if(!isset($meta_values['sidebar'][0])){
				    			$meta_values['sidebar'][0] = 'default';
				    		}
				    		
				    		if ($meta_values['sidebar'][0] == "default") {
				    		    get_sidebar('page'); // sidebar Page 
				    		} else {
				    		    if($meta_values['sidebar'][0] == 'primary'){
				    		    	get_sidebar();
				    		    }else{
				    		    	dynamic_sidebar($meta_values['sidebar'][0]);
				    		    }
				    		}
				    		?>
				    		
				    	</div>
				    
				    <?php } ?>
				    </div>
				    </div> <!-- end #inner-content -->
				    
				    <?php
				    }else{ ?>
				    <div class="mid-page">
				    <div class="row-fluid">
				    	<div id="main" class="span8  clearfix" role="main">
				    	
				    						    					
				    						    <article id="post-6232" class="post-6232 page type-page status-publish hentry clearfix" role="article" itemscope="" itemtype="http://schema.org/BlogPosting">
				    							
				    							    					
				    							    <section class="post-content  clearfix" itemprop="articleBody">
				    							    <div class="">
				    							     
				    								<?php echo do_shortcode('[posts_slider_auto width_type="span8" type="post" posts_per_page="5" order="DESC" orderby="date" meta_key="post_views_count" author_enable="yes" time_date="yes" comments_count_enable="yes" cat_enable="yes" like_enable="yes" view_count_enable="yes" review_enable="yes"]'); ?>
				    								
				    								<?php echo do_shortcode('[posts type="post" blog_style="1" thumb_view="type" thumb_size="large" posts_per_page="10" paging="load" order="DESC" orderby="date" meta_key="post_views_count" author_enable="yes" date_enable="yes" comments_count_enable="yes" cat_enable="yes" like_enable="yes" view_count_enable="yes" review_enable="yes"]'); ?>
				    	
				    							       
				    							       
				    							       </div></section> <!-- end article section -->
				    													  
				    						
				    						    </article> <!-- end article -->
				    						
				    						    		
				    						
				    						    			
				    	    				</div>
				    	    				<div id="sidebar" class="sidebar span4 clearfix" role="complementary">
				    	    					
				    	    					<?php  get_sidebar(); ?>
				    	    					
				    	    				</div>
				    </div>
				    </div>
				    <?php }  ?>
				   
			
    <div style="height: 30px;"></div>

<?php get_footer(); ?>
