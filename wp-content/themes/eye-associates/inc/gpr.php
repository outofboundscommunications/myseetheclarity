<?php
// global $gp_api_key, $gpr_error, $gpr_review_limit, $review_filter, $gpr_cache;
global $gp_api_key, $gpr_error, $gpr_review_limit, $review_filter;

if( function_exists('get_field') ){
	$acf_review_filter = get_field( 'review_filter', 'option' );
	$acf_gp_api_key    = get_field( 'gp_api_key', 'option' );
}

$gp_api_key       = ( $acf_gp_api_key ? $acf_gp_api_key : 'AIzaSyATwss6Y77z4ZZZZOcM3VXhErjl6aeFL1Q' ) ;
$gpr_error        = '';
$gpr_review_limit = 5;
$review_filter    = ( $acf_review_filter ? $acf_review_filter : 3 );
$gpr_cache        = '1 Day'; // Available Params '1 Hour', '3 Hours', '6 Hours', '12 Hours', '1 Day', '2 Days', '1 Week'

function grp_plugin_curl( $url ) {
	
	global $gp_api_key, $gpr_error, $gpr_review_limit;

	// Send API Call using WP's HTTP API
	$data = wp_remote_get( $url );

	if ( is_wp_error( $data ) ) {
		$gpr_error_message = $data->get_error_message();
		$gpr_error = "Something went wrong: $gpr_error_message";
	}
	
	//Use curl only if necessary
	if ( empty( $data['body'] ) ) {

		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_HEADER, 0 );
		$data = curl_exec( $ch ); // Google response
		curl_close( $ch );
		$response = json_decode( $data, true );

	} else {
		$response = json_decode( $data['body'], true );
	}

	//GPR Reviews Array
	$gpr_reviews = array();

	//includes Avatar image from user
	//@see: https://gist.github.com/jcsrb/1081548
	if ( isset( $response['result']['reviews'] ) && ! empty( $response['result']['reviews'] ) ) {
		//Loop Google Places reviews
		foreach ( $response['result']['reviews'] as $review ) {

			$user_id = isset( $review['author_url'] ) ? str_replace( 'https://plus.google.com/', '', $review['author_url'] ) : '';

			//Add args to
			$request_url = add_query_arg(
				array(
					'alt' => 'json',
				),
				'http://picasaweb.google.com/data/entry/api/user/' . $user_id
			);
			
			$avatar_get      = wp_remote_get( $request_url );
			$avatar_get_body = json_decode( wp_remote_retrieve_body( $avatar_get ), true );
			$avatar_img      = $avatar_get_body['entry']['gphoto$thumbnail']['$t'];
			//add array image to review array
			$review = array_merge( $review, array( 'avatar' => $avatar_img ) );
			//add full review to $gpr_views
			array_push( $gpr_reviews, $review );
			
		}
		
		//merge custom reviews array with response
		$response = array_merge( $response, array( 'gpr_reviews' => $gpr_reviews ) );
		
		
	}
	//Business Avatar
	if ( isset( $response['result']['photos'] ) ) {
		
		$request_url = add_query_arg(
			array(
				'photoreference' => $response['result']['photos'][0]['photo_reference'],
				'key'            => $gp_api_key,
				'maxwidth'       => '300',
				'maxheight'      => '300',
			),
		'https://maps.googleapis.com/maps/api/place/photo'
		);
		
		$response = array_merge( $response, array( 'place_avatar' => $request_url ) );
		
	}
	
	//Google response data in JSON format
	return $response;
	
}

function grp_plugin_curl_multi( $urls ) {
	global $gp_api_key, $gpr_error, $gpr_review_limit;
	
	// $url = $urls[0];
	
	$response_reviews = array();
	
	foreach( $urls as $url ){
	
		// Send API Call using WP's HTTP API
		$data = wp_remote_get( $url );
		if ( is_wp_error( $data ) ) {
			$gpr_error_message = $data->get_error_message();
			$gpr_error = "Something went wrong: $gpr_error_message";
		}
		
		//Use curl only if necessary
		if ( empty( $data['body'] ) ) {
			
			$ch = curl_init( $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_HEADER, 0 );
			$data = curl_exec( $ch ); // Google response
			curl_close( $ch );
			$response = json_decode( $data, true );
			
		} else {
			$response = json_decode( $data['body'], true );
		}
		
		if ( isset( $response['result']['reviews'] ) && ! empty( $response['result']['reviews'] ) ) {
			$response_reviews = array_merge($response_reviews, $response['result']['reviews']);
		}
	}
	
	//GPR Reviews Array
	$gpr_reviews = array();
	
	//includes Avatar image from user
	//@see: https://gist.github.com/jcsrb/1081548
	if ( ! empty( $response_reviews ) ) {
		
		//Loop Google Places reviews
		foreach ( $response_reviews as $review ) {
			
			$user_id = isset( $review['author_url'] ) ? str_replace( 'https://plus.google.com/', '', $review['author_url'] ) : '';
			
			//Add args to
			$request_url = add_query_arg(
				array(
					'alt' => 'json',
				),
				'http://picasaweb.google.com/data/entry/api/user/' . $user_id
			);
			
			$avatar_get      = wp_remote_get( $request_url );
			$avatar_get_body = json_decode( wp_remote_retrieve_body( $avatar_get ), true );
			$avatar_img      = $avatar_get_body['entry']['gphoto$thumbnail']['$t'];
			
			//add array image to review array
			$review = array_merge( $review, array( 'avatar' => $avatar_img ) );
			
			//add full review to $gpr_views
			array_push( $gpr_reviews, $review );
			
		}
		
		//merge custom reviews array with response
		$response = array_merge( $response, array( 'gpr_reviews' => $gpr_reviews ) );
		
	}
	
	//Google response data in JSON format
	// return $response;
	return $gpr_reviews;
	
}

/**
 * Get Star Rating
 *
 * Returns the necessary output for Google Star Ratings
 *
 * @param $rating
 * @param $unix_timestamp
 * @param $hide_out_of_rating
 * @param $hide_google_image
 *
 * @return string
 */
function get_star_rating( $rating, $unix_timestamp, $hide_out_of_rating, $hide_google_image ) {

	$output        = '';
	$rating_value  = '<p class="gpr-rating-value" ' . ( ( $hide_out_of_rating === '1' ) ? ' style="display:none;"' : '' ) . '><span>' . $rating . '</span>' . __( ' out of 5 stars', 'gpr' ) . '</p>';
	$is_gpr_header = true;

	//AVATAR
	$google_img = '<div class="gpr-google-logo-wrap"><img src="' . GPR_PLUGIN_URL . '/assets/images/google-small-logo.png' . '" class="gpr-google-logo-header" title=" ' . __( 'Reviewed from Google', 'gpr' ) . '" alt="' . __( 'Reviewed from Google', 'gpr' ) . '" /></div>';


	//Header doesn't have a timestamp
	if ( $unix_timestamp ) {
		$is_gpr_header = false;
	}

	//continue with output

	$output .= '<div class="star-rating-wrap">';
	$output .= '<div class="star-rating-size" style="width:' . ( 65 * $rating / 5 ) . 'px;"></div>';
	$output .= '</div>';

	//Output rating next to stars for individual reviews
	if ( $is_gpr_header === false ) {
		$output .= $rating_value;
	}

	//Show timestamp for reviews
	if ( $unix_timestamp ) {
		$output .= '<span class="gpr-rating-time">' . get_time_since( $unix_timestamp ) . '</span>';
	}

	//Show overall rating value of review
	if ( $is_gpr_header === true ) {

		//Google logo
		if ( isset( $hide_google_image ) && $hide_google_image !== 1 ) {

			$output .= $google_img;

		}
		$output .= $rating_value;
	}


	return $output;

}

/**
 * Time Since
 * Works out the time since the entry post, takes a an argument in unix time (seconds)
 */
function get_time_since( $date, $granularity = 1 ) {
	$difference = time() - $date;
	$retval     = '';
	$periods    = array(
		'decade' => 315360000,
		'year'   => 31536000,
		'month'  => 2628000,
		'week'   => 604800,
		'day'    => 86400,
		'hour'   => 3600,
		'minute' => 60,
		'second' => 1
	);

	foreach ( $periods as $key => $value ) {
		if ( $difference >= $value ) {
			$time = floor( $difference / $value );
			$difference %= $value;
			$retval .= ( $retval ? ' ' : '' ) . $time . ' ';
			$retval .= ( ( $time > 1 ) ? $key . 's' : $key );
			$granularity --;
		}
		if ( $granularity == '0' ) {
			break;
		}
	}

	return ' posted ' . $retval . ' ago';
}

/**
 * Delete Transient Cache
 *
 * Removes the transient cache when an error is displayed as to not cache error results
 */

function delete_transient_cache( $transient_unique_id ) {
	delete_transient( 'gpr_widget_api_' . $transient_unique_id );
	delete_transient( 'gpr_widget_options_' . $transient_unique_id );
}
?>