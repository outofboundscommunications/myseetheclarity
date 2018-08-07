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

					  	<?php if ( have_posts() ) : 
					
					  	 woocommerce_content();  
					  	  endif; ?>    
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
				<div style="height: 30px;"></div>
    

<?php get_footer(); ?>