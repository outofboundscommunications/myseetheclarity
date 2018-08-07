<div class="container">
	<div class="row">
		<div class="col-sm-12">
			
			<!-----------------------------------------------------------------------
				Home Doctors Section Title
			------------------------------------------------------------------------>
			<div class="home-doctors-section-title">
				<?php
				$home_doctors_section_title = get_field('home_doctors_section_title');
				if( !$home_doctors_section_title ){
					$home_doctors_section_title = 'meet our doctors';
				}
				?>
				<h1 class="box-title"><?php echo $home_doctors_section_title;?></h1>
			</div>
			
			<!-----------------------------------------------------------------------
				Home Doctors Top Content
			------------------------------------------------------------------------>
			<?php
			$home_doctors_content_top = get_field('home_doctors_content_top');
			if( $home_doctors_content_top ){
				?>
				<div class="home-doctors-content-top">
					<div class="custom-content">
						<?php echo $home_doctors_content_top;?>
					</div>
				</div>
				<?php
			}
			?>
			
			<!-----------------------------------------------------------------------
				Home Doctors : Doctors Loop
			------------------------------------------------------------------------>
			<?php
			query_posts( array(
				'post_type'=> 'doctor',
				'orderby'  => 'date',
				'order'    => 'ASC',
				'posts_per_page' => -1,
			));
			if ( have_posts() ){
				?>
				<div class="home-doctors">
					<?php
					while ( have_posts() ) {
						the_post();
						
						$post_id = $post->ID;
						
						if( has_post_thumbnail( $post_id ) ){
							$block_image_size   = 'doctor_home';
							$block_image_data   = wp_get_attachment_image_src( get_post_thumbnail_id( $child_id ), $block_image_size );
							$block_image_src    = $block_image_data[0];
							$block_image_width  = $block_image_data[1];
							$block_image_height = $block_image_data[2];
						}else{
							$block_image_src    = get_stylesheet_directory_uri().'/images/default/doctor_home_174x174.png';
							$block_image_width  = '174';
							$block_image_height = '174';
						}
						$location_email = get_field('location_email');
						$block_image_src_data = getimagesize($block_image_src);
						?>
						<div class="home-doctor">
								<div class="home-doctor-image">
									<a href="<?php echo get_permalink();?>">
										<img alt="<?php echo get_the_title();?>" class="doctor-image" src="<?php echo $block_image_src;?>" <?php echo $block_image_src_data[3];?>>
									</a>
								</div>
								<div class="home-doctor-link">
									<a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a>
								</div>
							<div class="clearfix"></div>
						</div>
						<?php
					}
					?>
					<div class="clearfix"></div>
				</div>
				<?php
			}
			// Reset Query
			wp_reset_query();
			?>
			
			<!-----------------------------------------------------------------------
				Home Doctors Top Content
			------------------------------------------------------------------------>
			<?php
			$home_doctors_content_bottom = get_field('home_doctors_content_bottom');
			if( $home_doctors_content_bottom ){
				?>
				<div class="home-doctors-content-bottom">
					<div class="custom-content">
						<?php echo $home_doctors_content_bottom;?>
					</div>
				</div>
				<?php
			}
			?>
			
			<!-----------------------------------------------------------------------
				Home Doctors Section Title
			------------------------------------------------------------------------>
			<div class="home-doctors-page-link pull-right">
				<?php
				$home_doctors_page            = get_field('home_doctors_page');
				$home_doctors_page_link_title = get_field('home_doctors_page_link_title');
				if( !$home_doctors_page_link_title ){
					$home_doctors_page_link_title = 'learn more';
				}
				
				if( $home_doctors_page ){
					?>
					<a class="ea-btn-smallwide" href="<?php echo $home_doctors_page;?>" style="background-color:#A5C73C;">
						<?php echo $home_doctors_page_link_title;?>
					</a>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>