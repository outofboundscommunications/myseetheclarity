<?php
/* 
Plugin Name: Custom Post Type Lockdown WordPress
Plugin URI: 
Author URI: http://www.social-ink.net
Version: 1.11
Author: Yonatan Reinberg of Social Ink
Description: Prevents access to single Custom Post Type views and Redirects Search Results - unlock the power of CPTs!
 
Copyright 2013  Yonatan Reinberg (email : yoni [a t ] s o cia l-ink DOT net) - http://social-ink.net
*/

add_post_type_support( 'page', 'excerpt' );

add_action('admin_menu', 'sink_cpt_lockdown_menu');			//options page addition
		
	function sink_cpt_lockdown_menu() {  
		add_submenu_page( "tools.php", "CPT Lockdown", "CPT Lockdown", "manage_options", "CPTLockdown", "cptLockdownAdmin" );	
	}  		

	//links in plugins page
		if ( $GLOBALS['pagenow'] == 'plugins.php' ) {
			add_filter( 'plugin_row_meta', 'CPTLockdownPluginLinks', 10,2);
		}			

		function CPTLockdownPluginLinks($links, $file) {
			if ( strpos($file, basename( __FILE__)) === false ) {
				return $links;
			}
		  
			$plugin = plugin_basename(__FILE__);

			$links[] = '<a href="tools.php?page=CPTLockdown" title="cptImages Settings">Settings</a>';
			$links[] = '<a href="http://social-ink.net" title="Visit Social Ink">Visit Social Ink</a>';
			
			return $links;
		}	
	
	
//prevent single for certain types	
	add_filter( 'parse_query', 'cptLockdownPreventSingle' );
	function cptLockdownPreventSingle() {
		global $wp_query;	
		$existing_prevent =  get_option('cptLockdown_prevent');	
		$this_type=isset($wp_query->queried_object) && isset($wp_query->queried_object->post_type) ? $wp_query->queried_object->post_type : false;
		if(is_singular()&&$this_type&&is_array($existing_prevent))
			if(array_key_exists($this_type,$existing_prevent)) {
				$cptLockdown_redirect = get_option('cptLockdown_redirect');
				$cptLockdown_redirect_custom = get_option('cptLockdown_redirect_custom');				
				if($cptLockdown_redirect&&is_array($cptLockdown_redirect)&&$cptLockdown_redirect_custom&&is_array($cptLockdown_redirect_custom)) {
					if($cptLockdown_redirect_custom[$this_type]!="") {	//first check custom URL
						$redirect_link = $cptLockdown_redirect_custom[$this_type];
					} elseif($cptLockdown_redirect[$this_type]!="") {	//then the page
						$redirect_link = get_permalink($cptLockdown_redirect[$this_type]);
					} else {
						$redirect_link = get_bloginfo('url');
					}
					wp_redirect($redirect_link);						
					exit;			
				}
			}
	}
	
	//rewrite query	
	add_filter( 'get_the_excerpt', 'cptLockdownRewriteSearchExcerpt');
	function cptLockdownRewriteSearchExcerpt($excerpt, $excerpt_type='excerpt') {

		if(is_search()) {
			$cptLockdown_rewrite =  get_option('cptLockdown_rewrite');
			if($cptLockdown_rewrite&&is_array($cptLockdown_rewrite)) {	
				global $post;
				$postid=$post->ID;
				$post_type = get_post_type($postid);
				if(array_key_exists($post_type, $cptLockdown_rewrite)) {
					$postid = $cptLockdown_rewrite[$post_type];
					if($postid) {
						$temp_post = get_post($postid);
						$excerpt = $temp_post->post_excerpt;
					}
				}
			}
		}	
		return $excerpt;
	}	
	
	//rewrite query	
	add_filter( 'the_permalink', 'cptLockdownRewriteSearchPermalink');
	function cptLockdownRewriteSearchPermalink($permalink) {

		if(is_search()) {
			$cptLockdown_rewrite = get_option('cptLockdown_rewrite');
			if($cptLockdown_rewrite&&is_array($cptLockdown_rewrite)) {	
				global $post;
				$postid=$post->ID;
				$post_type = get_post_type($postid);
				if(array_key_exists($post_type, $cptLockdown_rewrite)) {
					$postid = $cptLockdown_rewrite[$post_type];
					if($postid) {
						$permalink = get_permalink($postid);
					}
				}
			}
		} 
		return $permalink;
	}
	
	
	function cptLockdownAdmin() {  
		if(!empty($_POST)) {
			foreach($_POST as $key => $value) {
				if($key!="submit")
					update_option($key, $value);
			}		
			echo '<div class="updated"><p>CPTLockdown has updated the options. Thanks!</p></div>';
		}

		$existing_prevent =  get_option('cptLockdown_prevent');	
		if(!$existing_prevent)
			$existing_prevent=array();
			
		$existing_rewrite =  get_option('cptLockdown_rewrite');	
		if(!$existing_rewrite)
			$existing_rewrite=array();		
			
		$cptLockdown_redirect =  get_option('cptLockdown_redirect');	
		if(!$cptLockdown_redirect)
			$cptLockdown_redirect=array();		
			
		$cptLockdown_redirect_custom =  get_option('cptLockdown_redirect_custom');	
		if(!$cptLockdown_redirect_custom)
			$cptLockdown_redirect_custom=array();
			
		ob_start();?>
		
			<div class="wrap">				
				<div  id="qwiz_config" class="metabox-holder">
					<div class="icon32" id="icon-options-general"><br></div>	
					<h2>Custom Post Type Lockdown</h2>
						
						<div id="post-body">
							<div id="post-body-content" class="has-sidebar-content">
								<div class="section introsection">	
									<div style="background: none repeat scroll 0 0 #EEEEEE; border: 1px solid #F8F8F8; border-radius: 11px 11px 11px 11px; margin-bottom: 15px; margin-top: 15px; padding: 5px 5px 5px 15px; width: 800px;">
										<p>Copyright 2013 Yonatan Reinberg for Social Ink.  We do custom WordPress plugins, themes and sites big and small.</p>
										<p>To learn more about Social Ink, our people &amp; our projects, please visit our main site at <a style="color:#29ABE2" href="http://www.social-ink.net">social-ink.net</a>.</p>
									</div>
									<h3>Directions</h3>	
									<ol>
										<li>Checking "Prevent" next to a custom post type will not allow any single views of that type, and will redirect viewers to another page of your site.</li>
										<li>Selecting the redirect page will redirect viewers of that single to this page - by default they will be redirected home.</li>
										<li>Selecting a search overwrite page will replace that custom post type's results on the search page with your desired page; it will overwrite the permalink and the excerpt. This is useful if you have Staff as your custom post type, for example, but don't want anyone visiting the single of that staff and instead want them going to a staff overview page.</li>
									</ol>
									<i>Tips: If you don't see a post type here, are you sure you registered it completely?</i>
								</div>
		
								<div class="section">						
									<form method="post" enctype="multipart/form-data" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
										<p class="submit">
											<input type="submit" class="button-primary" name="submit" value="Update Options" />
										</p>											
										<table class="widefat imagetable">
											<thead>
												<tr>
													<th>Post type name</th>
													<th>Post type slug</th>
													<th>Prevent single?</th>
													<th>Redirect to...</th>
													<th>Rewrite search results to...</th>
												</tr>
											</thead>
											<tbody>
											
										<?						
										$allCPTs = get_post_types();
										$skipTypes = array('page','attachment','revision','nav_menu_item','wpcf7_contact_form','acf');
										
										foreach($allCPTs as $CPT) {
											if(in_array($CPT,$skipTypes))
												continue;

											$metainfo = get_post_type_object($CPT);
											$mylabel = $metainfo->label;
											 
											?>
											
											<tr>
												<td class="labelSection"><?php echo $metainfo->label ?></td>
												<td><?php echo $CPT ?></td>
												<td><input type="checkbox" value="yes" <?php if(array_key_exists($CPT, $existing_prevent)) echo 'checked' ?> name="cptLockdown_prevent[<?php echo $CPT ?>]" />Prevent</td>
												<td>
													<?php 
													$args = array(
														'show_option_none' => 	'Select page',
														'selected' 		   => $cptLockdown_redirect[$CPT],
														'name'             => 	'cptLockdown_redirect[' . $CPT . ']'); 	
														
													wp_dropdown_pages($args); 
													
													?>
													<br />
													<strong>Or enter custom URL (will overwrite):</strong><br/>
													<input value="<?php echo $cptLockdown_redirect_custom[$CPT] ?>" title="Enter custom URL"  style="padding: 5px; width: 197px;" name="cptLockdown_redirect_custom[<?php echo $CPT ?>]" class=""  />
												</td>												
												<td>
													<?php 
													$args = array(
														'show_option_none' => 	'Select page',
														'selected' 		   => $existing_rewrite[$CPT],
														'name'             => 	'cptLockdown_rewrite[' . $CPT . ']'); 	
														
													wp_dropdown_pages($args); 
													
													?>
												</td>
											</tr>
										<?	}	?>		
											</tbody>
											<tfoot>
												<tr>
													<th>Post type name</th>
													<th>Post type slug</th>
													<th>Prevent single?</th>
													<th>Redirect to...</th>
													<th>Rewrite search results to...</th>									
												</tr>
											</tfoot>									
										</table>				
										<p class="submit">
											<input type="submit" class="button-primary" name="submit" value="Update Options" />
										</p>												
									</form>
								</div>
							</div>
						</div>
				</div>
			 </div>

	<?php 
		echo ob_get_clean();	
	 }  	
?>