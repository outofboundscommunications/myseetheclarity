<?php
/*
Plugin Name: WP Embed Facebook Premium
Plugin URI: http://www.wpembedfb.com
Description: Extends the free plugin with extra features ask any question on support <a href="http://www.wpembedfb.com/support">Support</a>
Author: Miguel Sirvent
Version: 1.3.5
Copyright: Miguel Sirvent Gámez - miguel@sigami.net
License: http://www.wpembedfb.com/wp-embed-facebook-premium-license/
*/

define("WPEMFBPLVER",'1.3.5');
define("WPEMFBPLDIR",plugin_dir_path( __FILE__ ));
define("WPEMFBPLURL",plugin_dir_url( __FILE__ ));
define("WPEMFBPLSLUG",dirname(plugin_basename(__FILE__)));

include(WPEMFBPLDIR.'lib/updater.php');
include(WPEMFBPLDIR.'lib/core.php');

register_activation_hook(__FILE__, array('WP_Embed_FB_Premium', 'install') );
register_uninstall_hook(__FILE__, array('WP_Embed_FB_Premium', 'uninstall') );
register_deactivation_hook(__FILE__, array('WP_Embed_FB_Premium', 'deactivate'));
$lic = get_option('wpemfb_license','');
if(!empty($lic)){
    add_filter('wpemfb_embed_type',array('WP_Embed_FB_Premium','wpemfb_embed_type'),10,2);
    add_action('wp_enqueue_scripts', array('WP_Embed_FB_Premium', 'wp_enqueue_scripts') );
    add_filter('wpemfb_admin',array('WP_Embed_FB_Premium','wpemfb_admin'));
    add_filter('wpemfb_api_string',array('WP_Embed_FB_Premium','wpemfb_api_string'),10,2);
    add_action('wpemfb_options',array('WP_Embed_FB_Premium','wpemfb_options'));
    add_action('plugins_loaded',array('WP_Embed_FB_Premium','plugins_loaded'),20);
}
add_action('admin_notices',array('WP_Embed_FB_Premium', 'admin_notices'));
?>