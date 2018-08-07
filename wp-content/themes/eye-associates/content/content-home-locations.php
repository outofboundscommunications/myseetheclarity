<?php
$allposts=query_posts( array(
	'post_type'=> 'location',
	'orderby'  => 'date',
	'order'    => 'ASC',
    'post_status'=>'publish',
));
if ( have_posts() ){
    $allcount = count($allposts);
    $current=1;
	?>
	<div class="home-lcoations">
		<?php
		while ( have_posts() ) {
			the_post();
			
			$post_id = $post->ID;
			
			if( has_post_thumbnail( $post_id ) ){
				$block_image_size   = 'location_home';
				$block_image_data   = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $block_image_size );
				$block_image_src    = $block_image_data[0];
				$block_image_width  = $block_image_data[1];
				$block_image_height = $block_image_data[2];
			}else{
				$block_image_src    = get_stylesheet_directory_uri().'/images/default/location_home_440x267.png';
				$block_image_width  = $block_image_data[1];
				$block_image_height = $block_image_data[2];
			}
			$location_email = get_field('location_email');
			$block_image_src_data = getimagesize($block_image_src);
           /* if((($allcount-$current)%3)==0)
                    $sizeclass="col-md-4";*/
            
            //if(empty($sizeclass)){
                if(($allcount-$current) >= 3)
                    $sizeclass="col-md-3";
                else{
                    $sizeclass="col-md-4 ";                     
                }
            //}           
            if(($allcount%4)==0)
                $sizeclass="col-md-3";
            if(($allcount%3)==0)
                $sizeclass="col-md-4"; 
			?>
			<div class="pic home-lcoation <?php echo $sizeclass; ?> no-margin location-<?php echo $current; ?>">
				<img alt="<?php echo get_the_title();?>" class="pic-image" src="<?php echo $block_image_src;?>" <?php echo $block_image_src_data[3];?>>
				<div class="loc-title" style="background-color: <?php echo get_field('location_box_color');?>;">
					<span><?php echo get_field('location_box_title');?></span>
				</div>
				<div class="pic-caption left-to-right" style="background-color: <?php echo get_field('location_box_color');?>;">
					<div class="desc">
						<p><?php echo get_field('location_address');?></p>
						<h2><a href="tel:<?php echo get_field('location_phone_number');?>"><?php echo get_field('location_phone_number');?></a></h2>
						<?php
						if( $location_email ){
							?>
							<p class="location-email">
								<a href="mailto:<?php echo get_field('location_email');?>">
									Email Us
								</a>
							</p>							
							<?php
						}
						?>
						<a class="btn-detail btn btn-circle" href="<?php echo get_permalink();?>">more details</a>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php
            $current++;
		}
		?>
		<!--div class="clearfix"></div-->
	</div>
    <div class="clearfix"></div>
	<?php
}
// Reset Query
wp_reset_query();
?>
<?php /* ?>
<div class="home-lcoations">
	<?php
	for( $i = 1; $i <= 6; $i++ ){
		?>
		<div class="pic home-lcoation col-md-4 no-margin">
			<img alt="Pic" class="pic-image" src="http://1-to-n.com/clients/eye-associates/wp-content/uploads/2014/03/p1.png">
			<div class="loc-title">
				<span>aaaaaaaaaaaaaaaaaa</span>
			</div>
			<div class="pic-caption left-to-right" style="background-color:#F00;">
				<div class="desc">
					<p>7632 State Line Road Prairie Village, Kansas 66208.</p>
					<h2>(913) 642-5000</h2>
					<p class="span">Email Us</p>
					<input type="button" class="btn-detail" value="more details"/>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<?php
	}
	?>
	<div class="clearfix"></div>
</div>
<?php */ ?>