<?php get_header(); 
$meta_values = get_post_custom($post->ID);

			 
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
				    	
				    } ?>
				    
				    <div id="main" class="<?php echo $main_class ?>  clearfix" role="main">

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						    					
						    <section class="post-content  clearfix" itemprop="articleBody">
						    <div class="<?php echo $midpage2 ?>">
						     <?php 
						      if(!isset($meta_values['meta_use_layout_builder'][0])){
						      		$meta_values['meta_use_layout_builder'][0] = 'no';
						      } 
						      
						      	if($meta_values['meta_use_layout_builder'][0] == 'yes'){
						      		if(isset($meta_values['meta_template_id'][0]) && $meta_values['meta_template_id'][0]!= '' && !post_password_required() ){
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
					
					    <?php endwhile; ?>		
					
					    <?php else : ?>
					
    					    <article id="post-not-found" class="hentry clearfix">
    					    	<header class="article-header">
    					    		<h1><?php _e("Oops, Post Not Found!", "code125"); ?></h1>
    					    	</header>
    					    	<section class="post-content">
    					    		<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "code125"); ?></p>
    					    		 <?php wp_link_pages( $args ); ?>
    					    	</section>
    					    	<footer class="article-footer">
    					    	    <p><?php _e("This is the error message in the page.php template.", "code125"); ?></p>
    					    	</footer>
    					    </article>
					
					    <?php endif; ?>
			
    				</div> <!-- end #main -->
    
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
				    </div>
				</div> <!-- end #inner-content -->
				<!--<div style="height: 30px;"></div>-->
    

<?php get_footer(); ?>