<?php 
$images = get_field('gallery_images');
if( $images ){
	?>
	<div class="home-carousel">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="home_carousel" class="owl-carousel">
						<?php
						foreach( $images as $image ){
							// $image['url'];
							// $image['sizes']['thumbnail'];
							// $image['alt'];
							// $image['caption']
							$location_image_title       = $image['title'];
							$location_image_image_thumb = $image['sizes']['location_gallery_thumb'];
							$location_image_image_full  = $image['url'];
							?>
							<div class="item">
								<?php /* ?><a href="<?php echo $location_image_image_full;?>" rel="prettyPhoto[local_gal]"><?php */?>
								<a href="<?php echo $location_image_image_full;?>" rel="prettyPhoto[home_carousel]" title="<?php echo $location_image_title;?>">
									<img src="<?php echo $location_image_image_thumb;?>" alt="<?php //echo $location_image_title;?>" width="174" height="174">
									<?php /* ?>
									<img src="<?php echo $location_image_image_thumb;?>" alt="<?php echo $location_image_title;?>" width="174" height="174" />
									<img src="<?php echo $location_image_image_thumb;?>" alt="<?php echo $location_image_title;?>" width="174" />
									<?php */ ?>
								</a>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<style type="text/css">
	div.pp_default .pp_nav {display: none !important;}
	div.pp_default .pp_description {font-size: 15px;}
	</style>
	<?php
}
?>