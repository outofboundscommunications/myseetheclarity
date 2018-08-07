<?php
if( function_exists('get_field') ){
	$storefront = get_field('storefront');
}
if( $storefront ) {
	?>
	<div class="content-container location-storefront nopadding_bottom" style="background-color:#FFFFFF;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
					<?php
					$location_doctors_section_title = get_the_title();
					$location_doctors_section_title = strtolower($location_doctors_section_title);
					
					$img_src        = $storefront['url'];
					$img_width      = $storefront['width'];
					$img_height     = $storefront['height'];
					?>
					<div class="location-storefront-section-title">
						<h1 class="box-title"><?php echo $location_doctors_section_title;?> office</h1>
					</div>
					<div class="image-wrapper">
						<img height='<?php echo $img_height;?>' width='<?php echo $img_width;?>' title='' alt='' class='img-responsive attachment-learnmore_list wp-post-image' src='<?php echo $img_src;?>'>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>