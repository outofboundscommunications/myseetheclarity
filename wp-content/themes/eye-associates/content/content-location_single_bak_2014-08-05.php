<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="entry-content">
			
			<div class="content-container" style="background-color:#F9F7F7; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
							
							<div class="location_title">
								<h1 class="location-title">
									<?php
									$location_title = get_field('location_title');
									if( !$location_title ){
										$location_title = get_the_title();
									}
									echo $location_title;
									?>
								</h1>
							</div>
							<div class="location-address">
								<p>
								<?php
								$location_address = get_field('location_address');
								echo $location_address;
								?>
								</p>
							</div>							
							<div class="location_detail">
								<div class="location-details">
									<?php
									$location_phone_number = get_field('location_phone_number');
									if( $location_phone_number ){
										?>
										<span class="location-phone">
											<span class="location_label">Phone:</span>
											<span class="location_data">
                                            <?php if($location_phone_number != 'no phone number yet.'){?>
                                            <a href="tel:<?php echo str_replace(array( '(', ')',' ','-' ), '', $location_phone_number);?>"><?php echo $location_phone_number;?></a>
                                            <?php } else {?>
                                            <?php echo $location_phone_number;?>
                                            <?php }?>
                                            </span>
										</span>
										<?php
									}
									$location_fax_number = get_field('location_fax_number');
									if( $location_fax_number ){
										?>
										<span class="location-fax">
											<span class="location_label">Fax:</span>
											<span class="location_data"><?php echo $location_fax_number;?></span>
										</span>
										<?php
									}
									$location_email = get_field('location_email');
									if( $location_email ){
										?>
										<span class="location-email">
											<span class="location_data">
												<a class="green" href="mailto:<?php echo $location_email;?>">Email Us</a>
											</span>
										</span>
										<?php
									}
									?>
								</div>
							</div>
							<div class="location-socials">
								<ul>
									<?php
									$location_facebook = get_field('location_facebook');
									if( $location_facebook ){
										?>
										<li class="facebook"><a href="<?php echo $location_facebook;?>">Facebook</a></li>
										<?php
									}
									$location_twitter = get_field('location_twitter');
									if( $location_twitter ){
										?>
										<li class="twitter"><a href="<?php echo $location_twitter;?>">Twitter</a></li>
										<?php
									}
									$location_foursquare = get_field('location_foursquare');
									if( $location_foursquare ){
										?>
										<li class="foursquare"><a href="<?php echo $location_foursquare;?>">Foursquare</a></li>
										<?php
									}
									$location_googleplus = get_field('location_googleplus');
									if( $location_googleplus ){
										?>
										<li class="googleplus"><a href="<?php echo $location_googleplus;?>">Google+</a></li>
										<?php
									}
									/*
									$location_youtube = get_field('location_youtube');
									if( $location_youtube ){
										?>
										<li class="youtube"><a href="<?php echo $location_youtube;?>">YouTube</a></li>
										<?php
									}
									*/
									?>
								</ul>
							</div>
							<div class="location-map">
								<?php
								$location_map_url = get_field('location_map_url');
								if( $location_map_url ){
									?>
									<a class="location-map-link" href="<?php echo $location_map_url;?>">View on Map</a>
									<?php
								}
								?>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 ">
							<div class="location-content">
								<?php
								the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );
								wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) );
								?>
							</div>
							<?php
							$location_appointment_url = get_field('location_appointment_url');
							if( $location_appointment_url ){
								?>
								<a href="<?php echo $location_appointment_url;?>" class="ea-btn-large" style="background-color:#A5C73C;" target="_blank">book appointment</a>
								<?php
							}
							?>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .content-container -->
			
			<div class="content-container location-reviews-wrapper" style="background-color:#01c3ff; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
							<?php
							$location_reviews_content = get_field('location_reviews_content');
							if( $location_reviews_content ){
								echo $location_reviews_content;
							}
							?>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .content-container -->
			
			<div class="content-container location-doctors-wrapper nopadding_bottom" style="background-color:#FFFFFF; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
							<div class="location-doctors-section-title">
								<?php
								$location_doctors_section_title = get_the_title();
								$location_doctors_section_title = strtolower($location_doctors_section_title)
								?>
								<h1 class="box-title"><?php echo $location_doctors_section_title;?> doctors</h1>
							</div>
							<?php
							$location_doctors_content = get_field('location_doctors_content');
							if( $location_doctors_content ){
								?>
								<div class="location-doctors-content">
									<div class="custom-content">
										<?php echo $location_doctors_content;?>
									</div>
								</div>
								<?php
							}
							?>
							<?php
							$location_doctors = get_field('location_doctors');
							if( $location_doctors ){
								?>
								<div class="location-doctors">
									<?php
									foreach( $location_doctors as $post){ // variable must be called $post (IMPORTANT)
									setup_postdata($post);
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
											$block_image_height = '74';
										}
										$location_email = get_field('location_email');
										?>
										<div class="location-doctor">
											<div class="location-doctor-image">
												<a href="<?php echo get_permalink();?>">
													<img alt="<?php echo get_the_title();?>" class="doctor-image" src="<?php echo $block_image_src;?>">
												</a>
											</div>
											<div class="location-doctor-link">
												<a href="<?php echo get_permalink();?>">
													<?php echo get_the_title();?>
												</a>
											</div>
											<div class="clearfix"></div>
										</div>
										<?php
									}
									?>
								</div>
								<?php
								wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
							}
							?>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .content-container -->
			
			<div class="content-container location-staffs-wrapper" style="background-color:#FFFFFF; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
							<div class="location-staffs-section-title">
								<?php
								$location_staffs_section_title = get_the_title();
								$location_staffs_section_title = strtolower($location_staffs_section_title)
								?>
								<h1 class="box-title"><?php echo $location_staffs_section_title;?> staff</h1>
							</div>
							<?php
							$location_staffs_content = get_field('location_staffs_content');
							if( $location_staffs_content ){
								?>
								<div class="location-staffs-content">
									<div class="custom-content">
										<?php echo $location_staffs_content;?>
									</div>
								</div>
								<?php
							}
							?>
							<?php
							$location_staffs = get_field('location_staffs');
							if( $location_staffs ){
								?>
								<div class="location-staffs">
									<?php
									foreach( $location_staffs as $post){ // variable must be called $post (IMPORTANT)
									setup_postdata($post);
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
											$block_image_height = '74';
										}
										$location_email = get_field('location_email');
										?>
										<div class="location-doctor">
											<div class="location-doctor-image">
												<img alt="<?php echo get_the_title();?>" class="doctor-image" src="<?php echo $block_image_src;?>">
											</div>
											<div class="location-doctor-link">
												<?php echo get_the_title();?>
											</div>
											<div class="clearfix"></div>
										</div>
										<?php
									}
									?>
								</div>
								<?php
								wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly
							}
							?>
							<div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .content-container -->
			
			
			
			
			
			
		</div><!-- .entry-content -->
		
	</article><!-- #post -->
