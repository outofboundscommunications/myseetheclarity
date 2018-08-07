<?php

//set_site_transient('update_plugins', null);
// TEMP: Show which variables are being requested when query plugin API
//add_filter('plugins_api_result', 'aaa_result', 10, 3);
function aaa_result($res, $action, $args) {
	print_r($res);
	return $res;
}

// NOTE: All variables and functions will need to be prefixed properly to allow multiple plugins to be updated

/**
 * Updater Class
 */
global $wpEmbedFbPremium;
$wpEmbedFbPremium = new WP_Embed_FB_Premium_Updater;
class WP_Embed_FB_Premium_Updater {
	protected $api_url;
	var $plugin_slug;
	function __construct() {
			$this->api_url = 'http://www.wpembedfb.com/api/';
			// Take over the update check
			add_filter('pre_set_site_transient_update_plugins', array($this,'pre_set_site_transient_update_plugins'));
			// Take over the Plugin info screen	
			add_filter('plugins_api', array($this,'plugins_api'), 10, 3);
	}
	function pre_set_site_transient_update_plugins($checked_data){
		//Comment out these two lines during testing.
		if (empty($checked_data->checked))
			return $checked_data;
		$licence = get_site_option('wpemfb_license','');
		$request = array(
			'slug' => WPEMFBPLSLUG,
			'version' => $checked_data->checked[WPEMFBPLSLUG .'/'. WPEMFBPLSLUG .'.php'],
			'license' => empty($licence) ? 'no_license' : $licence,
			'site_url' => is_multisite()?network_home_url():home_url(),
		);		
		$raw_response = $this->remote_post('basic_check', $request);
		//print_r($raw_response);
		//lo q se envia es basicamente body lo demas es confid de curl o algo asi.
		if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)  )
			$response = unserialize($raw_response['body']);//este body es parte de la respuesta de wp_remote_post y viene como siple texto, si se cambia n los headers se puede obtener como json
		
		if (is_object($response) && !empty($response)) // Feed the update data into WP updater
			$checked_data->response[WPEMFBPLSLUG .'/'. WPEMFBPLSLUG .'.php'] = $response;
		
		return $checked_data;		
	}
	function plugins_api($def, $action, $args) {
		if (!isset($args->slug) || ($args->slug != WPEMFBPLSLUG))
			return false;
		
		// Get the current version
		$plugin_info = get_site_transient('update_plugins');
		$current_version = $plugin_info->checked[WPEMFBPLSLUG .'/'. WPEMFBPLSLUG .'.php'];
		$licence = get_site_option('wpemfb_license','');
		$request = array(
			'slug' => WPEMFBPLSLUG,
			'version' => $current_version,
			'license' => empty($licence) ? 'no_license' : $licence,
			'site_url' => is_multisite()?network_home_url():home_url(),
		);
		$raw_response = $this->remote_post($action, $request);
		if (is_wp_error($raw_response) || !($raw_response['response']['code'] == 200)) {
			$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
		} else {
			$res = unserialize($raw_response['body']);
			if ($res === false)
				$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
			
		}
		return $res;
	}
	function remote_post($action,$request){
		global $wp_version;
		$args = array(
				'body' => array(
					'action' => $action, 
					'request' => urlencode(serialize($request)),
				),
				'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
			);
			//wp_remote_post($url, $args); $args['body'] = array de variables_post
		// Start checking for an update
		return wp_remote_post($this->api_url, $args);
	}
}
















?>