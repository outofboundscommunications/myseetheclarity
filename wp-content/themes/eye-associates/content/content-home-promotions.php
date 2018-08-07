<?php
if( function_exists('get_field') ){
	$home_promo_title   = get_field('home_promo_title');
	$home_promo_content = get_field('home_promo_content');
	$home_promo_icon    = get_field('home_promo_icon');
}
?>
<div class="home-promo">
	<div class="container">
		<div class="row">
			<?php
			if( $home_promo_icon && ( $home_promo_title || $home_promo_content) ){
				$promo_icon_class = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
				$promo_content_class = 'col-lg-8 col-md-8 col-sm-8 col-xs-12';
			}
			if( !$home_promo_icon && ( $home_promo_title || $home_promo_content) ){
				$promo_content_class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12';
			}
			?>
			<div class="<?php echo $promo_icon_class;?>">
				<?php
				if( $home_promo_icon ){
					?>
					<div class="promo-icon">
						<img width="<?php echo $home_promo_icon['width'];?>" height="<?php echo $home_promo_icon['height'];?>" alt="goggle_img" src="<?php echo $home_promo_icon['url'];?>" class="img-responsive">
					</div>
					<div class="clearfix"></div>
					<?php
				}
				?>
			</div>
			<div class="<?php echo $promo_content_class;?>">
				<div class="promo-details">
					<?php
					if( $home_promo_title ){
						?>
						<h3 class="home-promo-title"><?php echo $home_promo_title;?></h3>
						<?php
					}
					if( $home_promo_content ){
						echo $home_promo_content;
					}
					?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>