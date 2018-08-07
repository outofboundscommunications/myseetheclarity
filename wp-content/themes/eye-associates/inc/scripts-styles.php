<?php
function my_denqueue_styles() {
	wp_dequeue_style( 'bootstrap-fa-icon' );
}
add_action( 'wp_enqueue_scripts', 'my_denqueue_styles', 100 );

// Deregister Scripts
function  deregister_scripts(){
	wp_deregister_script( 'twentytwelve-navigation' );
}
add_action('wp_enqueue_scripts','deregister_scripts', 20);

// Dequeue Scripts
function  dequeue_scripts(){
	// wp_dequeue_script( 'twentytwelve-navigation' );
}
add_action('wp_enqueue_scripts','dequeue_scripts');

// Deregister Styles
function deregister_styles()
{
	wp_deregister_style( 'twentytwelve-ie' );
	wp_deregister_style( 'twentytwelve-ie-css' );
	wp_deregister_style( 'twentytwelve-style' );
	wp_deregister_style( 'twentytwelve-fonts' );
}
add_action('wp_enqueue_scripts','deregister_styles', 20);

function dequeue_styles() {
	wp_dequeue_style('twentytwelve-ie');
	wp_dequeue_style('twentytwelve-ie-css');
	wp_dequeue_style('twentytwelve-style');
	wp_dequeue_style('twentytwelve-fonts');
}
add_action('wp_enqueue_scripts','dequeue_styles', 20);

/*--------------------------------------------------------------------------------
	Enqueue Combined Styles
--------------------------------------------------------------------------------*/
function my_enqueue_combned_styles() {
	
	if( !is_admin() ) {
		
		wp_dequeue_style( 'bxslider-css' );
		wp_dequeue_style( 'kiwi-logo-carousel-styles' );
		wp_dequeue_style( 'tbtestimonials-stylesheet' );
		wp_dequeue_style( 'font_awesome' );
		wp_dequeue_style( 'superfish');
		wp_dequeue_style( 'slicknav');
		wp_dequeue_style( 'prettyphoto');
		wp_dequeue_style( 'owlcarousel' );
		wp_dequeue_style( 'owltheme');
		
		wp_register_style('combined-css', SF_URL.'/css/combined/combined.css', array(), '', 'all' );
		wp_enqueue_style('combined-css');
	}
	
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_combned_styles', 100 );


/*
 * Theme Styles
 * */
function register_theme_styles(){
	wp_register_style( 'parent-style', get_parent_stylesheet_uri() );
	wp_register_style( 'theme-style',  get_stylesheet_uri() );
}
add_action('wp_enqueue_scripts','register_theme_styles', 21);

function enqueue_theme_styles(){
	wp_enqueue_style( 'parent-style' );
	wp_enqueue_style( 'theme-style' );
}
add_action('wp_enqueue_scripts','enqueue_theme_styles', 101);

/*******************************************************
 *  
 *  Retrieve URI of current theme's parent stylesheet.
 *  
 *  The stylesheet file name is 'style.css' which is appended to {@link
 *  get_template_directory_uri() stylesheet directory URI} path.
 *  
 *  @uses apply_filters() Calls 'stylesheet_uri' filter on stylesheet URI path and stylesheet directory URI.
 *  
 *  @return string
******************************************************/
function get_parent_stylesheet_uri(){
	$template_dir_uri = get_template_directory_uri();
	$stylesheet_parent_uri = $template_dir_uri . '/style.css';
	return apply_filters('stylesheet_parent_uri', $stylesheet_parent_uri, $template_dir_uri);
}
function custom_stylesheet_parent_uri(){
	return get_stylesheet_directory_uri().'/css/2012_bs.min.css';
}
add_filter('stylesheet_parent_uri', 'custom_stylesheet_parent_uri');

/*--------------------------------------------------------------------------------
	Register Scripts
--------------------------------------------------------------------------------*/
function my_register_scripts() {
   	//wp_register_script('jquery',                      SF_URL.'/js/jquery.min.js', array( 'jquery' ), '', true); //prettyPhoto
	wp_register_script('bootstrap-css',               SF_URL.'/js/bootstrap/bootstrap.min.js', array( 'jquery' ), '', true );// Bootstrap JS
	// wp_register_script('modernizr',                '//cdn.jsdelivr.net/modernizr/2.7.1/modernizr.min.js', '', '', true );
	wp_register_script('modernizr',                   SF_URL.'/js/modernizr/2.7.1/modernizr.min.js', '', '', true );
	// wp_register_script('mediaqueries',             '//cdn.jsdelivr.net/css3-mediaqueries/0.1/css3-mediaqueries.min.js', '', '', true );
	wp_register_script('mediaqueries',                SF_URL.'/js/css3-mediaqueries/0.1/css3-mediaqueries.min.js', '', '', true );
	// wp_register_script('respond',                  SF_URL.'/js/respond/respond.min.js', '', '', true );
	// wp_register_script('enquire',                  SF_URL.'/js/enquire/enquire.min.js', '', '', true );
	// wp_register_script('jquery-fitvids',           SF_URL.'/js/fitvids/jquery.fitvids.js', array( 'jquery' ), '', true );
	// wp_register_script('caroufredsel',             SF_URL.'/js/caroufredsel/jquery.carouFredSel-6.2.1-packed.js', array( 'jquery' ), '', true);
	// wp_register_script('prettyphoto',              SF_URL.'/js/prettyphoto/jquery.prettyPhoto-min.js', array( 'jquery' ), '', true); //prettyPhoto
	wp_register_script('prettyphoto',                 SF_URL.'/js/prettyphoto/jquery.prettyPhoto.min.js', array( 'jquery' ), '', true); //prettyPhoto
	// wp_register_script('prettify',                 SF_URL.'/js/prettify/prettify.js', array( 'jquery' ), '', true ); // Prettify
	wp_register_script('superfish',                   SF_URL.'/js/superfish/superfish.min.js', array( 'jquery' ), '', true ); // Superfish
	wp_register_script('slicknav',                    SF_URL.'/js/slicknav/jquery.slicknav.min.js', array( 'jquery' ), '', true ); // SlickNav
	// wp_register_script('fittext',                  SF_URL.'/js/fittext/jquery.fittext.js', array( 'jquery' ), '', false ); // FitText
	// wp_register_script('bxslider',                 SF_URL.'/js/bxslider/jquery.bxslider.min.js', array( 'jquery' ), '', false ); // BxSlider
	// wp_register_script('popover_extra_placements', SF_URL.'/js/bootstrap-popover-extra-placements/popover-extra-placements.js', array( 'jquery' ), '', true ); // YouThink
	wp_register_script('match_height',                SF_URL.'/js/jquery-match-height/jquery.matchHeight-min.js', array( 'jquery' ), '', true );
	wp_register_script('owlcarousel',                 SF_URL.'/js/owl-carousel/owl.carousel.min.js', array( 'jquery' ), '', true); //prettyPhoto
	// wp_register_script('uniform_js',               '//cdn.jsdelivr.net/uniformjs/1.7.5/jquery.uniform.min.js', array( 'jquery' ), '', true); //prettyPhoto
	wp_register_script('uniform_js',                  SF_URL.'/js/uniformjs/1.7.5/jquery.uniform.min.js', '', '', true );
	wp_register_script('common_js',                   SF_URL.'/js/common.min.js', array( 'jquery', 'owlcarousel', 'uniform_js' ), '', true ); // YouThink
   	wp_register_script('mega-menu',                   SF_URL.'/js/mega-menu/mega_menu.js','','', true ); // SlickNav
	wp_register_script('custom-menu',                 SF_URL.'/js/custom.js',array( 'jquery' ),'', true ); // SlickNav
}
add_action('wp_enqueue_scripts', 'my_register_scripts');


/*--------------------------------------------------------------------------------
	Enqueue Scripts
--------------------------------------------------------------------------------*/
function my_enqueue_scripts() {
	
	if (is_admin()) {
	}else{
        //wp_enqueue_script('jquery');              // jQuery
		// wp_enqueue_script('jquery-ui-core');      // jQuery-ui Core
		// wp_enqueue_script('jquery-ui-widget');    // jQuery-ui Widget
		wp_enqueue_script('bootstrap-js');           // Bootstrap
		wp_enqueue_script('modernizr');              // Modernizr
		wp_enqueue_script('mediaqueries');           // Mediaqueries
		// wp_enqueue_script('respond');             // Respond
		// wp_enqueue_script('enquire');             // Enquire
		// wp_enqueue_script('jquery-fitvids');      // Fitvids
		// wp_enqueue_script('caroufredsel');        // CarouFredsel
		wp_enqueue_script('prettyphoto');         // prettyPhoto
		wp_enqueue_script('owlcarousel');         // owlcarousel
		// wp_enqueue_script('prettify');            // Prettify
		wp_enqueue_script('superfish');           // Superfish
		wp_enqueue_script('slicknav');            // SlickNav
		// wp_enqueue_script('fittext');             // FitText
		// wp_enqueue_script('bxslider');            // BxSlider
		// wp_enqueue_script('popover_extra_placements'); // popover_extra_placements
		wp_enqueue_script('match_height');
		wp_enqueue_script('common_js');
 	    wp_enqueue_script('mega-menu'); 
        wp_enqueue_script('custom-menu');
		
		// comment reply script for threaded comments
		// if ( is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
			// wp_enqueue_script( 'comment-reply' );
		// }
	}
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');


/*--------------------------------------------------------------------------------
	Register Styles
--------------------------------------------------------------------------------*/
function my_register_styles() {
	$jqui_theme = 'smoothness'; // Available 'ui-lightness', 'smoothness'
	
	wp_register_style('bootstrap-css',           SF_URL.'/css/bootstrap/bootstrap.css', array(), '3.1.0', 'all' );                             // Bootstrap
	wp_register_style('font_awesome',            SF_URL.'/css/font-awesome/font-awesome.min.css', array(), '', 'all' );                        // FontAwesome
	// wp_register_style('prettify',             SF_URL.'/css/prettify/prettify.css', array(), '', 'all' );                                    // Prettify
	// wp_register_style('uniform_css',          '//cdn.jsdelivr.net/uniformjs/1.7.5/css/uniform.default.css', array(), '', 'all' );                                  // Uniform CSS
	wp_register_style('uniform_css',             get_stylesheet_directory_uri().'/uniform.default.min.css', array(), '', 'all' );                                  // Uniform CSS
	wp_register_style('superfish',               SF_URL.'/css/superfish/superfish.css', array(), '', 'all' );                                  // Superfish
	wp_register_style('slicknav',                SF_URL.'/css/slicknav/slicknav.css', array(), '', 'all' );                                    // SlickNav
	wp_register_style('prettyphoto',             SF_URL.'/css/prettyphoto/prettyPhoto.min.css', array(), '', 'all' );                              // SlickNav
	wp_register_style('owlcarousel',             SF_URL.'/css/owl-carousel/owl.carousel.css', array(), '', 'all' );                            // SlickNav
	// wp_register_style('owltheme',             SF_URL.'/css/owl-carousel/owl.theme.css', array(), '', 'all' );                               // SlickNav
	wp_register_style('owltheme',                SF_URL.'/css/owl-carousel/owl.theme.default.css', array(), '', 'all' );                       // SlickNav
	// wp_register_style('jqueryui_theme',       SF_URL.'/css/jquery-ui/'.$jqui_theme.'/jquery-ui-1.8.22.custom.css',array(),'1.8.22','all');  // jqueryui_theme
	// wp_register_style('monosocialiconsfont',  SF_URL.'/css/monosocialiconsfont/monosocialiconsfont-icons.css',array(),'1.10','all');        // Mono Social Icons Font
	// wp_register_style('bxslider',             SF_URL.'/css/bxslider/jquery.bxslider.css',array(),'1.10','all');                             // BxSlider
	// wp_register_style('style_php',            SF_URL.'/style.php',array(),'','all');                                                        // style.php
   	wp_register_style('mega-menu',                SF_URL.'/css/mega-menu/mega_menu.css', array(), '', 'all' );   
}
add_action('wp_enqueue_scripts', 'my_register_styles');


/*--------------------------------------------------------------------------------
	Enqueue Styles
--------------------------------------------------------------------------------*/
function my_enqueue_styles() {
	
	if( !is_admin() ) {
		// wp_enqueue_style('bootstrap-css');            // Bootstrap
		wp_enqueue_style('font_awesome' );               // FontAwesome
		// wp_enqueue_style('prettify');                 // Prettify
		wp_enqueue_style('uniform_css');                   // uniform_css
		wp_enqueue_style('superfish');                   // Superfish
		wp_enqueue_style('slicknav');                    // SlickNav
		wp_enqueue_style('prettyphoto');                 // prettyPhoto
		wp_enqueue_style('owlcarousel');                 // owlcarousel
		wp_enqueue_style('owltheme');                    // owltheme
		// wp_enqueue_style('jqueryui_theme');           // jQuery-UI themes
		// wp_enqueue_style('monosocialiconsfont');      // Mono Social Icons Font
		// wp_enqueue_style('bxslider');                 // BxSlider
		// wp_enqueue_style('style_php');                // style.php
 	    wp_enqueue_style('mega-menu');
            
	}
	
}
add_action('wp_enqueue_scripts', 'my_enqueue_styles');


/*--------------------------------------------------------------------------------
	Conditional Styles
--------------------------------------------------------------------------------*/
/**
* Enqueue a IE-specific style sheet.
*
* Add a style sheet for everyone, then mark it as conditional to IE versions.
*
* @author Gary Jones
* @link http://code.garyjones.co.uk/enqueued-style-sheet-extras/
*/
function conditional_css() {
	global $wp_styles;
	
	wp_enqueue_style( 'youthink-ie7', SF_URL . '/style-ie7.css', array(), '1.0.0' );
	$wp_styles->add_data( 'youthink-ie7', 'conditional', 'IE 7' );
	
	wp_enqueue_style( 'youthink-ie8', SF_URL . '/style-ie8.css', array(), '1.0.0' );
	$wp_styles->add_data( 'youthink-ie8', 'conditional', 'IE 8' );
	
	wp_enqueue_style( 'youthink-ie9', SF_URL . '/style-ie9.css', array(), '1.0.0' );
	$wp_styles->add_data( 'youthink-ie9', 'conditional', 'IE 9' );
	
	wp_enqueue_style( 'youthink-lt-ie9', SF_URL . '/style-lt-ie9.css', array(), '1.0.0' );
	$wp_styles->add_data( 'youthink-lt-ie9', 'conditional', 'lt IE 9' );
	
	wp_enqueue_style( 'youthink-ie9', SF_URL . '/style-ie10.css', array(), '1.0.0' );
	$wp_styles->add_data( 'youthink-ie10', 'conditional', 'IE 10' );
}
add_action( 'wp_enqueue_scripts', 'conditional_css', 200 );


/*--------------------------------------------------------------------------------
	Admin Enqueue
--------------------------------------------------------------------------------*/
function custom_admin_scripts( $hook ) {
	
	global $post;
	
	// wp_register_style('font_awesome',      SF_URL . '/css/font-awesome/font-awesome.css', array(), '', 'all' );                            // FontAwesome
	wp_register_script('custom_wp_admin_js',  SF_URL . '/js/custom_admin.js', array( 'jquery' ), '', true );// Bootstrap JS
	wp_register_style( 'custom_wp_admin_css', SF_URL . '/css/admin-style.css', false, '1.0.0' );
	
	// wp_enqueue_style('font_awesome' );      // FontAwesome
	
	// if ( 'message' === $post->post_type || 'property' === $post->post_type) {
	if ( 'page' === $post->post_type) {
		if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			wp_enqueue_script( 'custom_wp_admin_js' );
		}
		/*
		if ( $hook == 'edit.php' ) {
			wp_enqueue_style(  'custom_wp_admin_css' );
		}
		*/
	}
	
	// wp_enqueue_script( 'custom_wp_admin_js' );
	wp_enqueue_style(  'custom_wp_admin_css' );
	
}
add_action( 'admin_enqueue_scripts', 'custom_admin_scripts', 10, 1 );

/*
add_action( 'wp_enqueue_scripts', 'superfish_libs' );
function superfish_libs()
{
    // Register each script, setting appropriate dependencies
    wp_register_script('hoverintent', get_template_directory_uri() . '/superfish-js/hoverIntent.js');
    wp_register_script('bgiframe',    get_template_directory_uri() . '/superfish-js/jquery.bgiframe.min.js');
    wp_register_script('superfish',   get_template_directory_uri() . '/superfish-js/superfish.js', array( 'jquery', 'hoverintent', 'bgiframe' ));
    wp_register_script('supersubs',   get_template_directory_uri() . '/superfish-js/supersubs.js', array( 'superfish' ));
 
    // Enqueue supersubs, we don't need to enqueue any others in this case, as the dependencies take care of it for us
    wp_enqueue_script('supersubs');
 
    // Register each style, setting appropriate dependencies
    wp_register_style('superfishbase',   get_template_directory_uri() . '/superfish-css/superfish.css');
    wp_register_style('superfishvert',   get_template_directory_uri() . '/superfish-css/superfish-vertical.css', array( 'superfishbase' ));
    wp_register_style('superfishnavbar', get_template_directory_uri() . '/superfish-css/superfish-navbar.css', array( 'superfishvert' ));
 
    // Enqueue superfishnavbar, we don't need to enqueue any others in this case either, as the dependencies take care of it
    wp_enqueue_style('superfishnavbar');
}
*/
?>