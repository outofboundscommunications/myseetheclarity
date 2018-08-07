<?php get_header(); 
$meta_values = get_post_custom($post->ID);
?>
			
			<div id="content">
			<?php
			
			 
			 if(!isset($meta_values['meta_layout'][0])){
			 	$meta_values['meta_layout'][0] = 'right';
			 }
			 
			 
			 if( $meta_values['meta_layout'][0] == 'right' || $meta_values['meta_layout'][0] == 'left'){
			 	
			 	$main_class= 'span8';
			 	
			 }else{
			 
			 	$main_class= 'span12';
			 
			 }
			 
			  ?>
			 
				<div id="inner-content" class="wrap clearfix">
					
					<div class="title_wrap row-fluid">
						<div class="border">
							<div id="title_crumb">
								<h1 class="heading1"><?php echo $post->post_title; ?></h1>
								
								</div>
								<div class="arrow_down"></div>
						
						<div class="clearfix"></div>
						</div>
					</div>
					
				    <div class="row-fluid">
				    <div id="main" class="span8  clearfix" role="main">

					    <?php if (have_posts())  : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-thumb single post-content clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
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
					    	          post_class('clearfix portfolio_item_page ');
					    	          $post_class = ob_get_contents();
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
					    	          the_post_thumbnail('blog-post-thumb');
					    	          $the_post_thumbnail = ob_get_contents();
					    	          ob_end_clean();
					    	  
					    	          ob_start();
					    	          the_excerpt_max_charlength(300);
					    	          $the_excerpt_max_charlength = ob_get_contents();
					    	          ob_end_clean();
					    	  		
					    	  		
					    	  		ob_start();
					    	  		the_content();
					    	  		$the_content = ob_get_contents();
					    	  		ob_end_clean();
					    	  
					    	  		  ob_start();
					    	          the_time('j');
					    	          $the_day = ob_get_contents();
					    	          ob_end_clean();
					    	          
					    	          ob_start();
					    	          the_time('M, Y');
					    	          $the_date = ob_get_contents();
					    	          ob_end_clean();
					    	          
					    	          ob_start();
					    	          the_date('j M, Y');
					    	          $the_date2 = ob_get_contents();
					    	          ob_end_clean();
					    	          
					    	          ob_start();
					    	          comments_number(__('0 Comment','code125'),__('1 Comment','code125'),__('% Comments','code125') );
					    	  		$comments_number = ob_get_contents();
					    	  		ob_end_clean();
					    	  		
					    	  		
					    	          ob_start();
					    	          the_category(' - ');
					    	          $cat_echo_p = ob_get_contents();
					    	          ob_end_clean();
					    	  	
					    	  
					    	  
					    	  $meta_values = get_post_custom(get_the_ID());
					    	  $user_ID =  get_the_author_meta('ID') ;
					    	  $facebook_user = get_the_author_meta( 'facebook', $user_ID);
					    	  $twitter_user = get_the_author_meta( 'twitter', $user_ID);
					    	  $position_user = get_the_author_meta( 'position', $user_ID);
					    	  $format = get_post_format();
					    	  
					    	  $data = $data . '<div class="row-fluid meta-data-single" ><div class="span2">';
					    	  
					    	  $data = $data . get_avatar( $user_ID, '100', '', '<span class="icon-user"></span>' ) . '</div><div class="span3 article_author">' . $the_author_posts_link . '<p>'.$position_user.'</p><div class="clearfix"></div>' ;
					    	  if($twitter_user != ''){
					    	  	$data = $data . '<div class=""><a href="https://twitter.com/'.$twitter_user.'" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @'.$twitter_user.'</a>
					    	  	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>';
					    	  }
					    	  
					    	  if($facebook_user != ''){
					    	  	$data = $data . '<div class="float_left_fb"><div class="fb-follow" data-href="https://www.facebook.com/'.$facebook_user.'" data-layout="button_count" data-show-faces="true" data-font="verdana" data-width="100"></div></div>';
					    	  }
					    	  $data = $data . '</div><div class="span2">';
					    	  
					    	  
					    	 
					    	  $data = $data . '<span class="list-icon  icon-picture"></span>';
					    	  		
					    	  
					    	  
					    	  
					    	  $data = $data . '</div><div class="span3 date-list"><p><span class="icon-calendar"> </span> '.get_the_time('F') .' '. get_the_time('j') .', '. get_the_time('Y').'</p></div><div class="span2"><div class="thumb-like-single">'.getPostLikeLink(get_the_ID()).'</div></div></div>';
					    	  
					    	  echo $data ;
					    	  ?>
					    	  
					    	  
					    	 	<ul class="share clearfix">
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
					    	 		
					    	 		$image_url = wp_get_attachment_image_src( $id_link, "full"); 
					    	 		 ?>
					    	 		<li class="pinit"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo $image_url[0]; ?>&description=<?php echo $the_excerpt_max_charlength; ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
					    	 		
					    	 	</ul>
					    	 	<?php
					    	 	$data = '';
					    	 	
					    	 	
					    	 	the_content();
					    	 	
					    	 	?>
					    	 	<?php wp_link_pages(); ?>
					    	 	
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
    			
				 
				  				   	
				  				   	<div id="sidebar" class="sidebar span4 clearfix" role="complementary">
				  				   		
				  				   		<?php 
				  				   		    get_sidebar('post'); // sidebar Page 
				  				   		 ?>
				  				   		
				  				   	</div>
				  				   
				  				    </div>
				  				</div> <!-- end #inner-content -->
				      
				  			</div> <!-- end #content -->
				  
				  <?php get_footer(); ?>