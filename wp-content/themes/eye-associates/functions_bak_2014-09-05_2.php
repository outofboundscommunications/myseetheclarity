<?php
/*--------------------------------------------------------------------------------
	Constants and Variables
--------------------------------------------------------------------------------*/
// Theme Path Constants
define('SF_DIR', get_stylesheet_directory());
define('SF_URL', get_stylesheet_directory_uri());
// Parent Theme Path Constants
define('SF_PARENT_DIR', get_template_directory());
define('SF_PARENT_URL', get_template_directory_uri());
/*==================================================*/
/* Setup
/*==================================================*/
add_action( 'after_setup_theme', 'scaffold_setup', 11 );
function scaffold_setup()
{
	/*==================================================*/
	/* Remove Theme Support
	/*==================================================*/
	remove_theme_support( 'custom-background' );
	remove_theme_support( 'custom-header' );
}
/*--------------------------------------------------------------------------------
	Includes
--------------------------------------------------------------------------------*/
// require_once('inc/php-array-heirarchy-display/array.class.php');
// include('inc/menu_mod.php');
include('inc/custom_menu_items.php');
include('style.php');
include('inc/title_shortcodes.php');
include('inc/shortcode_content_filter.php');
include('inc/category-filters.php');
include('inc/cpt/cpt.php');
include('inc/sort/sortable.php');
include('inc/theme-functions.php');
include('inc/scripts-styles.php');
include('inc/sf-comment-list.php');
include('inc/shortcodes.php');
include('inc/tb-testimonials/tags.php');
/*--------------------------------------------------------------------------------
	Theme Data
--------------------------------------------------------------------------------*/
global $sf_data;

// Logo
// $sf_data['logo']        = get_stylesheet_directory_uri().'/images/logo.png';
$option_header_logo        = get_field('logo', 'option');
$sf_data['logo']           = ( $option_header_logo ? $option_header_logo : SF_URL . '/images/logo.png' );

// Footer Logo
// $sf_data['footer_logo'] = get_stylesheet_directory_uri().'/images/footer_logo.png';
$option_header_footer_logo = get_field('footer_logo', 'option');
$sf_data['footer_logo']    = ( $option_header_footer_logo ? $option_header_footer_logo : SF_URL . '/images/footer_logo.png' );

// Get Help
$sf_data['get_help']  = '#';
$gh_link_source            = get_field('gh_link_source', 'option');
$gh_link_internal          = get_field('gh_link_internal', 'option');
$gh_link_external          = get_field('gh_link_external', 'option');

if( $gh_link_source && $gh_link_source == 'internal' ){
	if( $gh_link_internal ){
		$sf_data['get_help'] = $gh_link_internal;
	}
}elseif( $gh_link_source && $gh_link_source == 'external' ){
	if( $gh_link_external ){
		$sf_data['get_help'] = $gh_link_external;
	}
}

// Customer Services
$sf_data['top_tool_location']  = '#';
$ttl_link_source            = get_field('ttl_link_source', 'option');
$ttl_link_internal          = get_field('ttl_link_internal', 'option');
$ttl_link_external          = get_field('ttl_link_external', 'option');

if( $ttl_link_source && $ttl_link_source == 'internal' ){
	if( $ttl_link_internal ){
		$sf_data['top_tool_location'] = $ttl_link_internal;
	}
}elseif( $ttl_link_source && $ttl_link_source == 'external' ){
	if( $ttl_link_external ){
		$sf_data['top_tool_location'] = $ttl_link_external;
	}
}

// Contact Us
$sf_data['contact_us']  = '#';
$cu_link_source            = get_field('cu_link_source', 'option');
$cu_link_internal          = get_field('cu_link_internal', 'option');
$cu_link_external          = get_field('cu_link_external', 'option');
if( $cu_link_source && $cu_link_source == 'internal' ){
	if( $cu_link_internal ){
		$sf_data['contact_us'] = $cu_link_internal;
	}
}elseif( $cu_link_source && $cu_link_source == 'internal' ){
	if( $cu_link_external ){
		$sf_data['contact_us'] = $cu_link_external;
	}
}
$sf_data['footer_copyright'] = 'Copyright &copy; '.date('Y').', <a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>';
$option_footer_copyright = get_field('copyright', 'option');
if( $option_footer_copyright ){
	$sf_data['footer_copyright'] = $option_footer_copyright;
}

// Removed
// $sf_data['header_back'] = get_stylesheet_directory_uri().'/images/header_back.png';
/*--------------------------------------------------------------------------------
	Remove Parent Templates
--------------------------------------------------------------------------------*/
function logo_image(){
	global $sf_data;
	$logo_image = $sf_data['logo'];
	
	// Filter
	$logo_image = apply_filters( 'sf_logo_image', $logo_image  );
	
	return $logo_image;
}
function footer_logo_image(){
	global $sf_data;
	$footer_logo_image = $sf_data['footer_logo'];
	
	// Filter
	$footer_logo_image = apply_filters( 'sf_footer_logo_image', $footer_logo_image  );
	
	return $footer_logo_image;
}
function site_phone(){
	global $sf_data;
	$site_phone = $sf_data['phone'];
	
	// Filter
	$site_phone = apply_filters( 'sf_site_phone', $site_phone  );
	
	echo $site_phone;
}
function get_help(){
	global $sf_data;
	$get_help = $sf_data['get_help'];
	
	// Filter
	$get_help = apply_filters( 'sf_get_help', $get_help  );
	
	echo $get_help;
}
function top_tool_location(){
	global $sf_data;
	$top_tool_location = $sf_data['top_tool_location'];
	
	// Filter
	$top_tool_location = apply_filters( 'sf_top_tool_location', $top_tool_location  );
	
	echo $top_tool_location;
}
function contact_us(){
	global $sf_data;
	$contact_us = $sf_data['contact_us'];
	
	// Filter
	$contact_us = apply_filters( 'sf_contact_us', $contact_us  );
	
	echo $contact_us;
}
function footer_copyright(){
	global $sf_data;
	$footer_copyright = $sf_data['footer_copyright'];
	
	// Filter before tag and shortcode filtered
	$footer_copyright = apply_filters( 'sf_footer_copyright_before', $footer_copyright  );
	
	$footer_copyright = contfilt( $footer_copyright );
	$footer_copyright = do_shortcode( $footer_copyright );
	
	// Filter after tag and shortcode filtered
	$footer_copyright = apply_filters( 'sf_footer_copyright_after', $footer_copyright  );
	
	echo $footer_copyright;
}
// Removed
/*
function header_back(){
	global $sf_data;
	$header_back = $sf_data['header_back'];
	
	// Filter
	$header_back = apply_filters( 'sf_header_back', $header_back  );
	
	echo $header_back;
}
*/
/*--------------------------------------------------------------------------------
	Remove Parent Templates
--------------------------------------------------------------------------------*/
/*
class Omit_Parent_Theme_Page_Templates {
	function __construct() {
		add_action( 'submitpage_box', array( $this, '_submitpage_box' ) );
		add_action( 'edit_page_form', array( $this, '_edit_page_form' ) );
	}
	function _submitpage_box() {
		ob_start();
	}
	function _edit_page_form() {
		$html = ob_get_clean();
		$select_regex = '<select\s*name="page_template"\s*id="page_template".*?>';
		preg_match( "#^(.*{$select_regex})(.*?)(</select>.*)$#sm", $html, $outer_match );
		preg_match_all( "#(<option\s*value='([^']+)'.*?>(.*?)</option>)#sm", $outer_match[2], $inner_matches, PREG_SET_ORDER );
		$child_page_templates = $this->_get_child_page_templates();    
		foreach( $inner_matches as $index => $matches )
			if ( isset( $child_page_templates[$matches[2]] ) )
				$child_page_templates[$matches[2]] = $inner_matches[$index][0];
		$html = $outer_match[1] . implode( "\n", $child_page_templates ). $outer_match[3];
		echo $html;
	}
	private function _get_child_page_templates() {
		$child_page_templates = array( 'default' => true );
		$files = wp_get_theme()->get_files( 'php', 1 );
		foreach ( $files as $file => $full_path ) {
			if ( ! preg_match( '|[^]]Template Name-:(.*)$|mi', file_get_contents( $full_path ), $header ) )
				continue;
			$child_page_templates[ $file ] = true;
		}
		return $child_page_templates;
	}
}
new Omit_Parent_Theme_Page_Templates();
*/
/*--------------------------------------------------------------------------------
	Sidebars
--------------------------------------------------------------------------------*/
add_action( 'widgets_init', 'unregister_sidebars', 11 );
add_action( 'widgets_init', 'register_custom_sidebars', 11 );
function unregister_sidebars(){
	unregister_sidebar( 'sidebar-1' );
	unregister_sidebar( 'sidebar-2' );
	unregister_sidebar( 'sidebar-3' );
}
function register_custom_sidebars(){
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/*--------------------------------------------------------------------------------
	Custom Thumbnail Size
--------------------------------------------------------------------------------*/
add_image_size( 'admin_thumb',            60,  60,  true ); // Admin Thumbnail
add_image_size( 'header_image',           415, 270, true ); // Header Image
add_image_size( 'blog_main',              530, 303, true ); // blog_thumb
// add_image_size( 'blog_thumb',          246, 116, true ); // blog_thumb
// add_image_size( 'blog_single_main',    786, 268, true ); // blog_thumb
add_image_size( 'location_home',          440, 267, true ); //
add_image_size( 'doctor_home',            168, 168, true ); //
add_image_size( 'location_gallery_thumb', 174, 174, true ); //
add_image_size( 'home_circle_icons', 134, 134, true ); //
/*--------------------------------------------------------------------------------
	Menu
--------------------------------------------------------------------------------*/
add_action( 'init', 'deregister_menus' );
add_action( 'init', 'register_menus' );
	
function deregister_menus(){
	unregister_nav_menu( 'primary' );
}
function register_menus(){
	register_nav_menus(
		array(
			'primary'        => __( 'Primary Menu', 'twentytwelve' ),
			'footer'         => __( 'Footer Menu', 'twentytwelve' ),
		)
	);
}
/*------------------------------------------------------------------------------------------
	Enable Hidden Buttons in Editor
------------------------------------------------------------------------------------------*/
function add_more_buttons($buttons) {
	// $buttons[] = 'charmap';
	$buttons[] = 'styleselect';    // Styleselect
	return $buttons;
}
add_filter("mce_buttons_2", "add_more_buttons");   // in first row
/*------------------------------------------------------------------------------------------
	Editor Style
------------------------------------------------------------------------------------------*/
function my_theme_add_editor_styles() {
    add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );
/*------------------------------------------------------------------------------------------
	Column Width
------------------------------------------------------------------------------------------*/
function column_width( $size = null ){
	
	if( !$size ){
		$size = 'col_12';
	}
	
	$width_sizes = array(
		'col_6'   => array( 'name' => '1/2',         'width' => '6' ),
		'col_4'   => array( 'name' => '1/3',         'width' => '4' ),
		'col_3'   => array( 'name' => '1/4',         'width' => '3' ),
		'col_8'   => array( 'name' => '2/3',         'width' => '8' ),
		'col_6_2' => array( 'name' => '2/4',         'width' => '6' ),
		'col_9'   => array( 'name' => '3/4',         'width' => '9' ),
		'col_12'  => array( 'name' => 'Full Width' , 'width' => '12'),
	);
	
	$return_width = $width_sizes[$size]['width'];
	
	return $return_width;
	
}
/*--------------------------------------------------------------------------------
	Options
--------------------------------------------------------------------------------*/
function my_acf_options_page_settings( $settings )
{
	$settings['title'] = 'Options';
	$settings['pages'] = array('Header', 'General Settings', 'Footer', 'Page Settings', 'Social Profiles');
	// $settings['pages'] = array('Header', 'Footer', 'Contact Info', 'Slider');
 
	return $settings;
}
add_filter('acf/options_page/settings', 'my_acf_options_page_settings');
/*--------------------------------------------------------------------------------
	Shortcode
--------------------------------------------------------------------------------*/
function address_data_fun(){
	ob_start();
	?>
	<div class="address_info">
		<div class="row">
			<div class="col-sm-6">
				<div class="add_info_item add_info_address">
					<?php
					$address_icon = get_field('address_icon', 'option');
					if( !$address_icon ){
						$address_icon = get_stylesheet_directory_uri().'/images/icons64/world_64.png';
					}
					$address_title = get_field('address_title', 'option');
					if( !$address_title ){
						$address_title = 'Address';
					}
					$address_content = get_field('address_content', 'option');
					if( !$address_content ){
						$address_content = 'Set Financial Corporation<br>761 Crossroads Plaza<br>Fort Mill, SC. 29708';
					}
					?>
					<div class="add_icon">
						<img src="<?php echo $address_icon;?>" alt="<?php echo $address_title;?>" width="64" height="64" />
					</div>
					<div class="add_title"><h4><?php echo $address_title;?></h4></div>
					<div class="add_content"><?php echo $address_content;?></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="add_info_item add_info_phone">
					<?php
					$phone_icon = get_field('phone_icon', 'option');
					if( !$phone_icon ){
						$phone_icon = get_stylesheet_directory_uri().'/images/icons64/phone_64.png';
					}
					$phone_title = get_field('phone_title', 'option');
					if( !$phone_title ){
						$phone_title = 'Phone';
					}
					$phone_content = get_field('phone_content', 'option');
					if( !$phone_content ){
						$phone_content = "Toll Free: <b>800-803-2510</b>
Local:<b>803-335-1275</b>
Fax:<b>800-803-1540</b>";
					}
					?>
					<div class="add_icon">
						<img src="<?php echo $phone_icon;?>" alt="<?php echo $phone_title;?>" width="64" height="64" />
					</div>
					<div class="add_title"><h4><?php echo $phone_title;?></h4></div>
					<div class="add_content">
					<?php
					$phone_content_items = explode("\n", str_replace("\r", "", $phone_content));
					$phone_content_items = array_filter($phone_content_items, 'remove_empty_internal');
					$phone_content_items = array_values( $phone_content_items );
					if( count($phone_content_items) > 0 ){
						?>
						<ul>
							<?php
							foreach( $phone_content_items as $phone_content_item ){
								$phone_content_item = trim($phone_content_item, " \t\n\r\0\x0B");
								
								if( $phone_content_item != '' ){
									?>
									<li>
										<?php
										if (strpos($phone_content_item,':') !== false) {
											$phone_content_item_datas = explode(":", str_replace("\r", "", $phone_content_item));
											$phone_content_item_datas = array_filter($phone_content_item_datas, 'remove_empty_internal');
											$phone_content_item_datas = array_values( $phone_content_item_datas );
											
											if( count($phone_content_item_datas) == 2 ){
												?>
												<span class="phone_data_title"><?php echo $phone_content_item_datas[0];?>: </span>
												<span class="phone_data_content"><?php echo $phone_content_item_datas[1];?></span>
												<?php
											}else{
												?>
												<span class="phone_data_content"><?php echo $phone_content_item_datas[0];?></span>
												<?php
											}
											
										}else{
											?>
											<span class="phone_data_content"><?php echo $phone_content_item;?></span>
											<?php
										}
										?>
									</li>
									<?php
								}
							}
							?>
						</ul>
						<?php
					}
					?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="add_info_item add_info_email">
					<?php
					$email_icon = get_field('email_icon', 'option');
					if( !$email_icon ){
						$email_icon = get_stylesheet_directory_uri().'/images/icons64/email_64.png';
					}
					$email_title = get_field('email_title', 'option');
					if( !$email_title ){
						$email_title = 'Email';
					}
					$email_content = get_field('email_content', 'option');
					if( !$email_content ){
						$email_content = '<span class="setf-blue">Email Custom Support</span>';
					}
					?>
					<div class="add_icon">
						<img src="<?php echo $email_icon;?>" alt="<?php echo $email_title;?>" width="64" height="64" />
					</div>
					<div class="add_title"><h4><?php echo $email_title;?></h4></div>
					<div class="add_content"><?php echo $email_content;?></div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="add_info_item add_info_hours">
					<?php
					$hours_icon = get_field('hours_icon', 'option');
					if( !$hours_icon ){
						$hours_icon = get_stylesheet_directory_uri().'/images/icons64/email_64.png';
					}
					$hours_title = get_field('hours_title', 'option');
					if( !$hours_title ){
						$hours_title = 'Email';
					}
					$hours_content = get_field('hours_content', 'option');
					if( !$hours_content ){
						$hours_content = '<span class="setf-blue">Email Custom Support</span>';
					}
					?>
					<div class="add_icon">
						<img src="<?php echo $hours_icon;?>" alt="<?php echo $hours_title;?>" width="64" height="64" />
					</div>
					<div class="add_title"><h4><?php echo $hours_title;?></h4></div>
					<div class="add_content"><?php echo $hours_content;?></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$content = ob_get_clean();
	return $content;
}
add_shortcode('address_data', 'address_data_fun');
/*--------------------------------------------------------------------------------
	Extra Functions
--------------------------------------------------------------------------------*/
function remove_empty_internal($value) {
	return !empty($value);
}
function reindex_array($src) {
    $dest = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
           foreach ($value as $dest_val) {
               $dest[$key][] = $dest_val;
           }
        }
    }
    return $dest;
}
/*--------------------------------------------------------------------------------
	Entry Meta
--------------------------------------------------------------------------------*/
// Filter content for text in content
function contfilt( $content ){
	global $post;
	$replace2 = array(
		//'words to find'    => 'replace with this'
		'site_title'         => esc_attr( get_bloginfo( 'name', 'display' ) ),
		'site_url'           => esc_url( site_url( '/' ) ),
		'home_url'           => esc_url( home_url( '/' ) ),
		'year'               => date('Y'),
		'permalink'          => esc_url( get_permalink() ),
		'title'              => esc_attr( get_the_title() ),
		'has_thumb'          => has_post_thumbnail( $post->ID ),
		'template_url'       => esc_url( get_template_directory_uri() ),
		'stylesheet_url'     => esc_url( get_stylesheet_directory_uri() ),
	);
	
	foreach ( $replace2 as $rep_key => $rep_value ) {
		$content = str_replace('%'.$rep_key.'%', $rep_value, $content);
	}
	# check for user defined conditionals
	if( preg_match_all( '/%if (.+?)%(.+?)??(?:%else%(.+?)??)?%endif%/sim', $content, $matches ) ){
		foreach( $matches[0] as $key => $pattern ){
			$swith_key = trim( $matches[1][$key]);
			$variable = $replace2[$swith_key];
			
			# output if section
			if( isset( $variable ) && ! empty( $variable ) && false !== $variable ){
				$content = str_replace( $pattern, trim( $matches[2][$key] ), $content );
			
			# output else section if it exists
			}else{
				if( isset( $matches[3][$key] ) && ! empty( $matches[3][$key] ) ){
					$content = str_replace( $pattern, $matches[3][$key], $content );
				}else{
					$content = str_replace( $pattern, '', $content );
				}
			}
		}
	}
	return $content;
}
add_action('the_content','contfilt');
/*--------------------------------------------------------------------------------
	Entry Meta
--------------------------------------------------------------------------------*/
if ( ! function_exists( 'sf_twentytwelve_entry_meta' ) ) :
function sf_twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );
	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);
	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	/*
	if ( $tag_list ) {
		$utility_text = __( '%1$s and tagged %2$s on %3$s<span class="by-author"> %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( '%1$s on %3$s<span class="by-author"> %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( '%3$s<span class="by-author"> %4$s</span>.', 'twentytwelve' );
	}
	*/
	$utility_text = __( '%3$s<span class="by-author"> %4$s</span>.', 'twentytwelve' );
	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;
function exclude_category($query) {
	global $userdata;
	get_currentuserinfo();
	
	$hide_test = true;
	
	if( $hide_test && !is_admin() ){
		/*
		if ( $userdata->ID != 1 ) {
			if ( $query->is_home || $query->is_archive) {
				// $query->set('cat', '-192');
			}
		}else{
			if ( $query->is_home || $query->is_archive) {
				// $query->set('cat', '-192');
			}
		}
		*/
		if ( $query->is_home || $query->is_archive) {
			$query->set('cat', '-192');
		}
	}
	
	return $query;
}
add_filter('pre_get_posts', 'exclude_category');
function sf_twentytwelve_body_class( $classes ) {
	/*
	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}
	*/
	
	if ( is_page_template( 'page-templates/l2.php' ) ){
		$classes[] = 'sf-template-l2';
	}
	
	return $classes;
}
add_filter( 'body_class', 'sf_twentytwelve_body_class' );

// Page Speed Fix
// add_action('wp_enqueue_scripts', 'my_enqueue_styles2');
function my_enqueue_styles2(){
	wp_enqueue_style('dynamic-css', admin_url('admin-ajax.php').'?action=dynamic_css','','','');
}
//move wpautop filter to AFTER shortcode is processed
// remove_filter( 'the_content', 'wpautop' );
// add_filter( 'the_content', 'wpautop' , 99);
// add_filter( 'the_content', 'shortcode_unautop',100 );
// search filter
function fb_search_filter($query) {
	if ( !$query->is_admin && $query->is_search) {
		$query->set('post_type', array('post', 'page', 'doctor', 'location') ); // id of page or post
	}
	return $query;
}
add_filter( 'pre_get_posts', 'fb_search_filter' );

// ADD NEW COLUMN
function ST4_columns_head($defaults) {
	$defaults['test_id'] = 'ID';
	return $defaults;
}

// SHOW THE FEATURED IMAGE
function ST4_columns_content($column_name, $post_ID) {
	if ($column_name == 'test_id') {
		echo $post_ID;
	}
}
add_filter('manage_edit-testimonial_columns', 'ST4_columns_head');
add_action('manage_testimonial_posts_custom_column', 'ST4_columns_content', 10, 2);
add_filter('manage_edit-location_columns', 'ST4_columns_head');
add_action('manage_location_posts_custom_column', 'ST4_columns_content', 10, 2);


function dequeue_my_css() {
	wp_dequeue_style('twentytwelve-ie-css');
	wp_deregister_style('twentytwelve-ie-css'); 
}
add_action('wp_enqueue_scripts','dequeue_my_css');


// Page speed fix
function ewp_remove_script_version( $src ){
	return remove_query_arg( 'ver', $src );
}
add_filter( 'script_loader_src', 'ewp_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'ewp_remove_script_version', 15, 1 );
function ewp_remove_script_v( $src ){
	return remove_query_arg( 'v', $src );
}
add_filter( 'script_loader_src', 'ewp_remove_script_v', 15, 1 );
add_filter( 'style_loader_src', 'ewp_remove_script_v', 15, 1 );

// Page speed fix

function defer_parsing_of_js ( $url ) {
	// Return if not javascript
	if ( FALSE === strpos( $url, '.js' ) ) return $url;
	
	// Return if jQuery
	if ( strpos( $url, 'jquery.js' ) ) return $url;
	
	// Retturn
	// Must be a ', not "!
	// return "$url' defer='defer";
	return "$url' defer ";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );
?>