<?php
// global $gp_api_key, $gpr_error, $gpr_review_limit, $review_filter, $gpr_cache;
global $gp_api_key, $gpr_error, $gpr_review_limit, $review_filter;

if( function_exists('get_field') ){
	$home_location_reviews = get_field('home_location_reviews');
}

$google_places_urls = array();

if( $home_location_reviews ){
	foreach( $home_location_reviews as $home_location_review ){
		
		$google_place_id = get_field('google_place_id', $home_location_review->ID);
		$placeid = '';
		if( $google_place_id ){
			$placeid = $google_place_id;
	
			$google_places_url = add_query_arg(
				array(
					'key'     => $gp_api_key,
					'placeid' => $placeid,
				),
				'https://maps.googleapis.com/maps/api/place/details/json'
			);
			
			$google_places_urls[] = $google_places_url;
		}
	}
}
//serialize($instance) sets the transient cache from the $instance variable which can easily bust the cache once options are changed
$transient_unique_id = 'home_reviews'.'temppp1';
$gpr_reviews         = get_transient( 'gpr_widget_api_' . $transient_unique_id );
$widget_options      = get_transient( 'gpr_widget_options_' . $transient_unique_id );
$serialized_instance = serialize( $instance );
if( isset($_GET) && isset($_GET['delete_cache']) && $_GET['delete_cache'] == 1 ){
	delete_transient_cache( $transient_unique_id );
}

// Cache: cache option is enabled

if ( $gpr_cache !== 'None' ) {
	
	// echo 'bbbbbbbbbb';
	
	// Check for an existing copy of our cached/transient data
	// also check to see if widget options have updated; this will bust the cache
	if ( $gpr_reviews === false || $serialized_instance !== $widget_options ) {
		
		// It wasn't there, so regenerate the data and save the transient
		//Get Time to Cache Data
		$expiration = $gpr_cache;

		//Assign Time to appropriate Math
		switch ( $expiration ) {
			case "1 Hour":
				$expiration = 3600;
				break;
			case "3 Hours":
				$expiration = 3600 * 3;
				break;
			case "6 Hours":
				$expiration = 3600 * 6;
				break;
			case "12 Hours":
				$expiration = 60 * 60 * 12;
				break;
			case "1 Day":
				$expiration = 60 * 60 * 24;
				break;
			case "2 Days":
				$expiration = 60 * 60 * 48;
				break;
			case "1 Week":
				$expiration = 60 * 60 * 168;
				break;
		}

		// Cache data wasn't there, so regenerate the data and save the transient
		$gpr_reviews = grp_plugin_curl_multi( $google_places_urls );	
		set_transient( 'gpr_widget_api_' . $transient_unique_id, $gpr_reviews, $expiration );
		set_transient( 'gpr_widget_options_' . $transient_unique_id, $serialized_instance, $expiration );

	} //end response

} else {
	//No Cache option enabled;
	$gpr_reviews = grp_plugin_curl_multi( $google_places_urls );
}
/* echo '<pre>';
 print_r(count($gpr_reviews));
 echo '</pre>';*/
 /*echo '<pre>';
 print_r($gpr_reviews);
 echo '</pre>';
die;*/
/*----------------------------------------------------------------------------*/
$reviews            = $gpr_reviews;
if( count($reviews) < 3 && !empty($reviews) ){
	$reviews_count_temp2 = 3-$reviews_count_temp;
	
	if( $reviews_count_temp2 <= 2 ){
		for( $i = 1; $i <= $reviews_count_temp2; $i++ ){
			$reviews[] = $reviews[0];
		}
	}
}

// global $filter_count;
// $filter_count       = 4;
// $filter_count       = $review_filter;
$home_reviews_limit = 6;
$reviews_count      = count($reviews);

if( $home_reviews_limit <= 1 ){
	$home_reviews_limit = 2;
}
if( $home_reviews_limit >= $reviews_count ){
	$home_reviews_limit = ($reviews_count-1);
}

// echo '<h1>Section > Original</h1><br><pre>';print_r($reviews);echo '</pre>';

function reviews_filter($var){
	// global $filter_count;
	global $review_filter;
	
	// returns whether the input integer is odd
	return($var['rating'] >= $review_filter);
}

$reviews_original = $reviews;
$reviews_filtered = array_filter($reviews, "reviews_filter");

// Shuffle
$reviews_shuffle = $reviews_filtered;
shuffle($reviews_shuffle);

$reviews_random = array_rand ( $reviews_shuffle, $home_reviews_limit );
if( !is_array($reviews_random) ){
	$reviews_random = array();
}

$gpr_reviews = array();

foreach ($reviews_random as $review_random) {
	$home_review_temp = $reviews_shuffle[$review_random];
	$gpr_reviews[] = $home_review_temp;
}
/*----------------------------------------------------------------------------*/

?>
<div class="content-container location-reviews-wrapper location-gpr-reviews-wrapper" style="background-color:#01c3ff; ">
	<div class="container">
		<h1 class="inline-heading white">Recent Reviews</h1>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
				<div class="row">
					<?php
					//Google Places Reviews
					if ( ! empty( $gpr_reviews ) ) {
						?>
						<div class="gpr-reviews-wrap">
							<div id="gpr_carousel">
								<?php
								$counter = 0;
								$gpr_review_limit = isset( $gpr_review_limit ) ? $gpr_review_limit : 3;

								//Loop Google Places reviews
								foreach ( $gpr_reviews as $review ) {

									//Set review vars
									$author_name    = $review['author_name'];
									$author_url     = isset( $review['author_url'] ) ? $review['author_url'] : '';
									$overall_rating = $review['rating'];
									$review_text    = $review['text'];
									$time           = $review['time'];
									$avatar         = isset( $review['avatar'] ) ? $review['avatar'] : get_stylesheet_directory_uri() . '/images/mystery-man.png';
									if( isset( $review['avatar'] ) ){
										$avatar =  $review['avatar'];
										if (getimagesize($avatar) !== false) {
											$avatar = get_stylesheet_directory_uri() . '/images/mystery-man.png';
										}
									}else{
										$avatar = get_stylesheet_directory_uri() . '/images/mystery-man.png';
									}
									
									$review_filter  = isset( $review_filter ) ? $review_filter : '';
									$counter ++;
									
									//Review filter set OR count limit reached?
									if ( $overall_rating >= $review_filter && $counter <= $gpr_review_limit ) {
										?>
										<div class="gpr-review gpr-review-<?php echo $counter; ?>">
											<div class="col-xs-12 col-sm-3 col-md-3  col-lg-3">
												<div class="gpr-review-header gpr-clearfix">
													<div class="gpr-review-avatar">
														<img src="<?php echo $avatar; ?>" alt="<?php echo $author_name; ?>" title="<?php echo $author_name; ?>" width="74" height="74"/>
													</div>
													
													<div class="gpr-review-info gpr-clearfix">
														<span class="grp-reviewer-name">
															<?php
															if ( ! empty( $author_url ) ) {
																?>
																<a href="<?php echo $author_url; ?>" title="<?php _e( 'View this profile.', 'gpr' ); ?>" <?php echo $target_blank . $no_follow; ?>>
																	<span><?php echo $author_name; ?></span>
																</a>
																<?php
															} else {
																echo $author_name; ?>
															<?php } ?>
														</span>
														<?php echo get_star_rating( $overall_rating, $time, $hide_out_of_rating, false ); ?>
													</div>
												</div>
											</div>
											<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 ">
												<div class="gpr-review-content">
													<?php echo wpautop( $review_text ); ?>
												</div>
											</div>
										</div><!--/.gpr-review -->
										<?php
									}
								}?>
							</div><!--/#gpr-carousel -->
						</div><!--/.gpr-reviews -->
						<script type="text/javascript">
						jQuery(document).ready(function($) {
							
							var wind_width = $( window ).width();
							$.browser.device = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
							if( $.browser.device ) {
								// alert('Yes! It\'s Mobile. And, it\'s width is '+wind_width+'.');
								$('.location-gpr-reviews-wrapper .container').css("width",(wind_width-20)).css("margin", '0 auto');
							}
							/*
							$(window).on('resize', function () {
								if( $.browser.device ) {
									alert('window changed');
									$('.location-gpr-reviews-wrapper .container').css("width",(wind_width-20)).css("margin", '0 auto');
									gpr_carousel.trigger('refresh.gpr_carousel.carousel');
								}
							});
							*/
							$('.location-gpr-reviews-wrapper .container').css("width",(wind_width-20)).css("margin", '0 auto');
							
							var gpr_carousel = $('#gpr_carousel');
							gpr_carousel.owlCarousel({
								items: 1,
								loop: true,
								margin: 15,
								nav: true,
								dots: false,
								singleItem: true,
								
								// center: true,
								autoWidth: false,
								autoHeight: true
							});
							
							$(window).on('load', function() {
								$('.location-gpr-reviews-wrapper .container').css("width",(wind_width-20)).css("margin", '0 auto');
								gpr_carousel.trigger('refresh.gpr_carousel.carousel');
								// gpr_carousel.trigger('update.gpr_carousel.carousel');
								// $('.owl-carousel').owlCarousel('invalidate', 'width').owlCarousel('update');
							});
							
							window.addEventListener("orientationchange", function() {
								// alert(window.orientation);
								//do whatever you want on orientation change here
								$('.location-gpr-reviews-wrapper .container').css("width",(wind_width-20)).css("margin", '0 auto');
								gpr_carousel.trigger('refresh.gpr_carousel.carousel');
							}, false);
						});
						</script>
						<?php
					}else{
						//No Reviews for this location
						?>
						<div class="gpr-no-reviews-wrap">
							<div class="col-xs-12 col-sm-12 col-md-12  col-lg-12">
								<p class="no-reviews">
									<?php echo 'There are no reviews yet for this location.';?>
								</p>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .content-container -->
<script type="text/javascript">
jQuery(document).ready(function($) {
});
</script>
<style type="text/css">
.gpr-review-avatar > img {
	border: 5px solid #36b7e6;
	border-radius: 50%;
	margin: 0 auto;
	width: inherit !important;
}
div.rating-wrap {
	line-height: 18px;
	vertical-align: middle;
}

.star-rating-wrap {
	background: url('<?php echo get_stylesheet_directory_uri();?>/images/review_stars.png') no-repeat 0 0 transparent;
	height: 13px;
	width: 67px;
	margin: 0 auto;
}
	
.star-rating-size {
	background: url('<?php echo get_stylesheet_directory_uri();?>/images/review_stars.png') no-repeat 0 -13px transparent;
	height: 13px;
}
	
span.gpr-rating-time {
	margin: 0;
	padding: 0;
	vertical-align: top;
	color: #ffffff;
	font-size: 14px;
	line-height: 13px;
	float: left;
	width: 100%;
}
	
	div.gpr-business-header div.gpr-rating-value {
	min-width: 200px;
}
	
div.gpr-review {
	margin: 0 0 20px;
	padding: 0;
}
	
.gpr-review-avatar > img {
	max-width: 100%;
}
	
span.grp-reviewer-name {
	display: block;
	margin: 0;
	font-family:oxygenbold;
	font-size: 20px;
}
.gpr-review-info {
	text-align: center;
}
span.grp-reviewer-name > a {
	text-decoration: none;
	color: #fff;
}
	
div.gpr-review-content {
	clear: both;
	margin: 0px;
}
	
div.gpr-review-content > p {
	font-size: 17px;
	font-family: "Open Sans", Helvetica, Arial, sans-serif;
	margin: 0 0 10px;
	line-height: 26px;
}
	
	div.gpr-review-content > p:last-of-type, div.gpr-review:last-of-type {
	margin-bottom: 0;
}
	.gpr-rating-value {
	font-size: 16px;
	}
	
</style>