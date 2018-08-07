<?php
/**

 * Main Class for Premium Features
 */
class WP_Embed_FB_Premium {
    static function install(){
        $defaults = self::getdefaults();
        foreach ($defaults as $option => $value) {
            if ( !is_multisite() ) {
                $opt = get_option($option);
                if($opt === false)
                    update_option($option, $value);
            }
            else {
                $opt = get_site_option($option);
                if($opt === false)
                    update_site_option($option, $value);
            }
        }
    }
    /**
     * Delete all plugin options on uninstall
     */
    static function uninstall(){
        $defaults = self::getdefaults();
        foreach ($defaults as $option ) {
            if ( !is_multisite() ) {
                delete_option($option);
            }
            else {
                delete_site_option($option);
            }
        }
        return;
    }
    static function deactivate(){
        return;
    }
    /**
     * Default options
     */
    static function getdefaults(){
        return array(
            'wpemfb_license' 		=> '',
            'wpemfb_max_posts_premium' => '5'
        );
    }
    /**
     * load translations and facebook sdk
     */
    static function admin_notices(){
        global $pagenow;

        if($pagenow == 'plugins.php'){
            $license_id = get_option('wpemfb_license','');
            $notice = '';
            if(empty($license_id)){
                $notice = 'missing';
                add_action('admin_notice',array('WP_Embed_FB_Premium', 'admin_notice'));
            }
            if(isset($_POST['wpemfb-license'])){
                global $wpEmbedFbPremium;
                $home = is_multisite()?network_home_url():home_url();
                $raw_license = $wpEmbedFbPremium->remote_post('validate_license',array('license'=>$_POST['wpemfb-license'],'site_url'=>$home));
                if($raw_license['response']['code'] == 200){
                    $license = unserialize($raw_license['body']);
                    if(is_wp_error($license)){
                        $array = $license->errors;
                        $first = array_shift($array);
                        $error_msg = $first[0];
                        $notice = 'error';
                    } else {
                        $notice = 'ok';
                        update_option('wpemfb_license',$_POST['wpemfb-license']);
                    }
                }
            }
            switch($notice){
                case 'missing':
                    ?>
                    <div class="error">
                        <h4>WP Embed Facebook License Missing</h4>
                        <p>Enter license to receive updates</p>
                        <form action="<?php echo admin_url('plugins.php') ?>" method="post" >
                            <label for="wpemfb-license">License Key:</label>
                            <input type="text" name="wpemfb-license">
                            <input type="submit" class="button button-primary" value="<?php _e('Save') ?>">
                        </form>
                    </div>
                    <?php
                    break;
                case 'ok':
                    ?>
                    <div class="updated">
                        <h4>WP Embed Facebook License is ok</h4>
                        <p>Thank you! You are Awesome!</p>
                    </div>
                    <?php
                    break;
                case 'error':
                    ?>
                    <div class="error">
                        <h4>WP Embed Facebook License ERROR</h4>
                        <p>
                            <?php echo $error_msg; ?>
                            <br>
                            Try again please.
                        </p>
                        <form action="<?php echo admin_url('plugins.php') ?>" method="post" >
                            <label for="wpemfb-license">License Key:</label>
                            <input type="text" name="wpemfb-license">
                            <input type="submit" class="button button-primary" value="<?php _e('Save') ?>">
                        </form>
                    </div>
                    <?php
                    break;
                default:
                    return;
                    break;
            }
        }
    }
    static function wpemfb_embed_type($type,$clean){
        if( array_search('events',$clean) !== false  ){
            return 'event';
        } else {
            return $type;
        }
    }
    static function fb_api_get($fb_id, $url, $type="") {
        $wp_emb_fbsdk = FaceInit::$fbsdk;
        try {
            $api_string = apply_filters('wpemfb_api_string', $fb_id, $type);
            $fb_data = $wp_emb_fbsdk->api('/' . $api_string);
            //$res = '<pre>'.print_r($fb_data,true).'</pre>'; //to inspect what elements are queried by default
            if ($type == 'fullpage')
                $fb_data = $fb_data + $wp_emb_fbsdk->api('/' . $fb_data['id'] . '?fields=posts.limit(' . get_option("wpemfb_max_posts_premium") . '){message,shares,link,picture,object_id,likes.limit(1).summary(true),comments.limit(1).summary(true)}');
            elseif(isset($fb_data['category']) && get_option("wpemfb_show_posts") == "true")
                $fb_data = $fb_data + $wp_emb_fbsdk->api('/'.$fb_data['id'].'?fields=posts.limit('.get_option("wpemfb_max_posts").'){message,shares,link,picture,object_id,likes.limit(1).summary(true),comments.limit(1).summary(true)}');
            elseif(isset($fb_data['embed_html']))
                $fb_data = array_merge($fb_data,array('is_video' => '1'));
            $res = WP_Embed_FB::print_fb_data($fb_data);
        } catch(FacebookApiException $e) {
            $res = '<p><a href="https://www.facebook.com/'.$url.'" target="_blank" rel="nofollow">https://wwww.facebook.com/'.$url.'</a>';
            //uncoment this lines to debug
            ///*
            if(is_super_admin()){
                $error = $e->getResult();
                $res .= '<br><span style="color: #4a0e13">' .__('This facebook link has a problem only visible to admins', 'wp-embed-facebook').'</span>';
                $res .= '<br>';
                $res .= $error['error']['message'];
            }
            //*/
            $res .= '</p>';
        }
        return $res;
    }

    static function full_page_shortcode($atts){
        $license = get_option('wpemfb_license','');
        if(!empty($license))
        if(!empty($atts) && isset($atts[0])){
            add_filter('wpemfb_embed_type',array('WP_Embed_FB_Premium','wpemfb_embed_type_fullpage'));
            add_filter('wpemfb_template',array('WP_Embed_FB_Premium','wpemfb_template_fullpage'));
            //wp_enqueue_style('wpemfb-pre');
            $url = '<p>'.trim($atts[0],'=').'</p>';
            $embed = WP_Embed_FB::the_content($url);
            return $embed;
        }
    }
    static function wpemfb_embed_type_fullpage($type){
        return 'fullpage';
    }
    static function wpemfb_template_fullpage($template){
        return WPEMFBPLDIR."templates/full-page.php";
    }
    static function wp_enqueue_scripts(){
        wp_register_style('wpemfb-pre', WPEMFBPLURL."lib/css/wpemfb-prem.css" );
    }
    static function wpemfb_admin($data){
        $license = get_option('wpemfb_license','');
        if(empty($license)){
            return $data;
        } else {
            ob_start();
            ?>
                <h1>You have a License</h1>
                <p>Share what you want to see on this plugin</p>
                <p><strong><a href="http://www.wpembedfb.com/support/ask">Support Forum</a></strong></p>
                <p style="text-align: center;">You are awesome ! Remember that.</p>
            <?php
        }
    }
    static function wpemfb_options(){
        ob_start();
        if(isset($_POST['wpemfb-license'])){
            global $wpEmbedFbPremium;
            $clean = trim($_POST['wpemfb-license']);
            if(!empty($clean)){
                $home = is_multisite()?network_home_url():home_url();
                $raw_license = $wpEmbedFbPremium->remote_post('validate_license',array('license'=>$_POST['wpemfb-license'],'site_url'=>$home));
                if($raw_license['response']['code'] == 200){
                    $license = unserialize($raw_license['body']);
                    if(is_wp_error($license)){
                        $array = $license->errors;
                        $first = array_shift($array);
                        $error_msg = $first[0];
                    } else {
                        update_option('wpemfb_license',$_POST['wpemfb-license']);
                    }
                }
            } else {
                update_option('wpemfb_license','');
            }
        }
        if(isset($_POST['wpemfb_max_posts_premium'])){
            update_option('wpemfb_max_posts_premium', $_POST['wpemfb_max_posts_premium']);
        }
        ?>
        <h5><?php _e('Premium Options', 'wp-embed-facebook') ?></h5>
        <div>
            <table>
                <tbody>
                <tr valign="middle">
                    <th>License</th>
                    <td>
                        <?php echo isset($error_msg)?'<p>'.$error_msg.'</p>':'' ?>
                        <input type="text" name="wpemfb-license" value="<?php echo get_option('wpemfb_license') ?>" size="38"  />
                    </td>
                </tr>
                <tr valign="middle">
                    <th><?php _e('Number of posts on full page','wp-embed-facebook') ?></th>
                    <td>
                        <input type="number" name="wpemfb_max_posts_premium" value="<?php echo get_option('wpemfb_max_posts_premium') ?>"  style="width: 60px;"/>
                    </td>
                </tr>
            </table>
        </div>
        <?php
        ob_end_flush();
    }
    static function wpemfb_api_string($fb_id, $type){
        if( empty($type) || $type == 'fullpage' )
            $api_string = $fb_id;
        elseif($type == 'album')
            $api_string = $fb_id.'?fields=name,id,from,photos.fields(name,picture,source).limit('.get_option("wpemfb_max_photos").')';
        elseif($type == 'event')
            $api_string = $fb_id.'?fields=start_time,end_time,name,owner,venue,location,is_date_only,timezone,cover,description';
        return $api_string;
    }
    static function plugins_loaded(){
        add_shortcode('fbfullpage', array('WP_Embed_FB_Premium','full_page_shortcode') );
    }
}


?>
