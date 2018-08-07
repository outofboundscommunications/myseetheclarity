<?php get_header(); 
$meta_values = get_post_custom($post->ID);
?>
			
			<div id="content">
			
			 
				<div id="inner-content" class="wrap clearfix">
					<div id="inner-page-content">
					<div class="border">
					<div class="row-fluid">
				   
				    
				    <div id="main" class="span12  clearfix" role="main">

					    <?php if (have_posts())  : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-thumb single post-content clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
					    
					    <div class="clearfix"></div>
					    	<?php 
					    	 	
					    	 	
					    	 	the_content();
					    	 	
					    	 	
					    	 	?>
					    	 	<div class="clearfix"></div>
					    	 	<div class="pagination">
					    	 	<?php wp_link_pages(); ?>
					    	 	</div>
					    	 	<div class="header_divider"></div>
					    	 		<?php echo do_shortcode( '[4col_posts type="team" order="rand" orderby="rand" title="'.__('Other Team Members','code125').'"]' );  ?>
					    	 	
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
    				
    			
				  
				  				    
				  				    </div>
				  				    </div>
				  				    </div>
				  				</div> <!-- end #inner-content -->
				      
				  			</div> <!-- end #content -->
				  
				  <?php get_footer(); ?>