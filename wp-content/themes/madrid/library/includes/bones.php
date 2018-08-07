<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have 
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

/*********************
LAUNCH BONES
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/

// we're firing all out initial functions at the start
add_action('after_setup_theme','bones_ahoy', 15);

function bones_ahoy() {
    
    
    
    
    // wp thumbnails (sizes handled in functions.php)
    add_theme_support('post-thumbnails');   
    
    add_theme_support('editor_style');
    
    add_editor_style('library/includes/bootstrap/css/bootstrap.min.css');
    add_editor_style('library/css/editor.css');
    
    // default thumb size   
    set_post_thumbnail_size(125, 125, true);   
     
    add_theme_support( 'woocommerce' );
    // rss thingy           
    add_theme_support('automatic-feed-links'); 
    
    // to add header image support go here: http://themble.com/support/adding-header-background-image-support/
    
    // adding post format support
    add_theme_support( 'post-formats',  
    	array( 
    		'default',
    		'gallery',         
    		'video' ,
    		'audio'          
    	)
    );	
    
    // wp menus
    add_theme_support( 'menus' ); 
    
    
    $menus = ot_get_option( 'menus', array() );
    
        if ($menus){
            foreach ($menus as $menu) {
                
                register_nav_menus(
                	array(
                		$menu["location"] =>$menu["title"]
                	)
                );
            }
        }
       
    
    register_nav_menus(
    	array(
    		'main-nav' =>'Main Menu',
    		'footer-links' => 'Footer Menu'
    	)
    );
    
    // launching operation cleanup
    add_action('init', 'bones_head_cleanup');
    // remove WP version from RSS
    add_filter('the_generator', 'bones_rss_version');
    // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
    add_action('wp_head', 'bones_remove_recent_comments_style', 1);
    // clean up gallery output in wp
    add_filter('gallery_style', 'bones_gallery_style');

    // enqueue base scripts and styles
    add_action('wp_enqueue_scripts', 'bones_scripts_and_styles');
    // ie conditional wrapper
    add_filter( 'style_loader_tag', 'bones_ie_conditional', 10, 2 );
    
    // launching this stuff after theme setup
    add_action('after_setup_theme','my_after_setup_theme_function');	
    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'bones_register_sidebars' );
    // adding the bones search form (created in functions.php)
    add_filter( 'get_search_form', 'bones_wpsearch' );
    
    // cleaning up random code around images
    add_filter('the_content', 'bones_filter_ptags_on_images');
    // cleaning up excerpt
    add_filter('excerpt_more', 'bones_excerpt_more');
    
} /* end bones ahoy */

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by 
removing all the junk we don't
need. 
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );                    
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );                          
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );                               
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );                       
	// index link
	remove_action( 'wp_head', 'index_rel_link' );                         
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
	// WP version
	remove_action( 'wp_head', 'wp_generator' );                           

} /* end bones head cleanup */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}
	
// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


/*********************
SCRIPTS & ENQEUEING
*********************/

// loading modernizr and jquery, and reply script 
function bones_scripts_and_styles() {
  if (!is_admin()) {
  
  	$google_fonts= array( 
  					'Times New Roman',
  					'Georgia',
  					'HelveticaNeue',
  					'Andale Mono',
  					'Arial',
  					'Century Gothic',
  					'Helvetica',
  					'Impact',
  					'Trebuchet MS',
  					'Verdana');
  	
  	
  	$skin= get_page_parameter('skin_default','',false);
  	$skin_data = code125_get_skin($skin);
  	$heading_font = $skin_data[ 'heading_font' ];
  	$body_font = $skin_data[ 'body_font' ];
  	
    // modernizr (without media query polyfill)
    wp_register_script( 'bones-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );
 
    
    
    // register base stylesheet
    wp_register_style( 'bones-base', get_template_directory_uri() . '/library/css/base.css'  );

	
	
	// register rtl stylesheet
	wp_register_style( 'bones-rtl', get_template_directory_uri() . '/library/css/rtl.css' );
	
    // ie-only style sheet
    wp_register_style( 'bones-ie-only', get_template_directory_uri() . '/library/css/ie.css' );
    
    wp_register_style( 'bones-bootstrap', get_template_directory_uri() . '/library/includes/bootstrap/css/bootstrap.min.css' );
    
    wp_register_style( 'bones-bootstrap-responsive', get_template_directory_uri() . '/library/includes/bootstrap/css/bootstrap-responsive.min.css');
    
    wp_register_style( 'bones-responsive', get_template_directory_uri() . '/library/css/responsive.css' );
    wp_register_style( 'bones-responsive-mob', get_template_directory_uri() . '/library/css/responsive-mobile.css' );
    wp_register_style( 'bones-print', get_template_directory_uri() . '/library/css/print.css' , array() , '1.0' ,'print' );
   
   
   
   
    
    if( !in_array($heading_font, $google_fonts)){
    wp_register_style( 'heading_font', 'http://fonts.googleapis.com/css?family='. $skin_data[ 'heading_font' ]);
    }
    
    if( !in_array($body_font, $google_fonts)){
    wp_register_style( 'body_font', 'http://fonts.googleapis.com/css?family='. $skin_data[ 'body_font' ] );
    }
    
    wp_register_style( 'arabic_font', 'http://fonts.googleapis.com/earlyaccess/droidarabickufi.css' );
    

    
    
    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }
    
    
    wp_register_script( 'jquery_tools', get_template_directory_uri() . '/library/js/libs/jquery.tools.min.js',array() , '1.0', true);
    wp_register_script( 'jquery_easing', get_template_directory_uri() . '/library/js/libs/jquery.easing.1.3.js',array() , '1.0', true);
     wp_register_script( 'jquery_fancybox', get_template_directory_uri() . '/library/js/libs/jquery.fancybox.pack.js',array() , '1.0', true);
     wp_register_script( 'jquery_isotope', get_template_directory_uri() . '/library/js/libs/jquery.isotope.min.js',array() , '1.0', true);
     wp_register_script( 'jquery_flexslider', get_template_directory_uri() . '/library/js/libs/jquery.flexslider-min.js',array() , '1.0', true);
	wp_register_script( 'jquery_tooltip', get_template_directory_uri() . '/library/js/libs/jquery.tipTip.minified.js',array() , '1.0', true);
	wp_register_script( 'jquery_flowplayer', get_template_directory_uri() . '/library/includes/shortcodes/player/flowplayer-3.2.10.min.js',array() , '1.0', true);
	wp_register_script( 'jquery_bootstrap', get_template_directory_uri() . '/library/includes/bootstrap/js/bootstrap.min.js',array() , '1.0', true);
	
	wp_register_script( 'jquery_bootstrap', get_template_directory_uri() . '/library/includes/bootstrap/js/bootstrap-hover-dropdown.js',array() , '1.0', true);
	  
 

	
	//wp_register_script( 'jquery_twitter', get_template_directory_uri() . '/library/js/libs/jquery.tweet.js',array() , '1.0', true);
	
	
	
	
	
	wp_register_script( 'jquery_colorpicker', get_template_directory_uri() . '/library/js/libs/colorpicker.js',array() , '1.0', true);
	
	
	wp_register_script( 'jquery_ticker', get_template_directory_uri() . '/library/js/libs/jquery.webticker.js',array() , '1.0', true);
	
	wp_register_script( 'jquery_googlemaps', get_template_directory_uri() . '/library/js/libs/googlemaps.js',array() , '1.0', false);
	
    
    //adding scripts file in the footer
    wp_register_script( 'bones-js', get_template_directory_uri() . '/library/js/scripts.js',array() , '1.0', true);
 
    wp_register_script( 'bones-code125', get_template_directory_uri() . '/library/js/libs/code125-scripts.js',array() , '1.0', true);
    
    wp_register_script( 'bones-pinit', '//assets.pinterest.com/js/pinit.js' ,array() , '1.0', true);
    // enqueue styles and scripts
    wp_enqueue_script( 'bones-modernizr' );
    
    
    
   
    if( !in_array($heading_font, $google_fonts)){
    	wp_enqueue_style( 'heading_font' );
    }
    if( !in_array($body_font, $google_fonts)){
    	wp_enqueue_style( 'body_font' );
    }
    $responsive = ot_get_option( 'responsive' );
    
    wp_enqueue_style( 'bones-bootstrap' );
    if($responsive!='no'){
    	wp_enqueue_style( 'bones-bootstrap-responsive' );
    }
    wp_enqueue_style( 'bones-icons' );
    wp_enqueue_style( 'bones-social' );
    
   // wp_enqueue_style( 'shortcodes' );
    //wp_enqueue_style( 'bones-animate' );
    
    wp_enqueue_style( 'bones-base' );
    
    if($responsive!='no'){
    	
    	wp_enqueue_style( 'bones-responsive' );
    }
    
    
    
   
    
   wp_enqueue_style('bones-ie-only');
   
   if(code125_is_rtl()){
   		wp_enqueue_style( 'arabic_font' );   
    	wp_enqueue_style( 'bones-rtl' );
    }
    
  
    
    wp_enqueue_style( 'bones-print' );
   
    
    
    /*
    I reccomend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    global $is_IE;
    
    if($is_IE){
    	wp_deregister_script('jquery');
    	   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
    	   wp_enqueue_script('jquery');
    
    }else {
    	wp_enqueue_script( 'jquery' );  
    }
    
    wp_enqueue_script( 'jquery_tools' );
     wp_enqueue_script( 'bones-code125' );
    
    wp_enqueue_script( 'jquery_bootstrap' );
    //wp_enqueue_script('jquery_googlemaps');
    wp_enqueue_script( 'bones-pinit' );
    
    /*
   
    wp_enqueue_script( 'jquery_easing' );
    wp_enqueue_script( 'jquery_fancybox' );
    
    wp_enqueue_script( 'jquery_flexslider' );
    wp_enqueue_script( 'jquery_tooltip' );
	wp_enqueue_script( 'jquery_ticker' );
    wp_enqueue_script( 'jquery_isotope' );
    
    
    
    */
   wp_enqueue_script('like_post', get_template_directory_uri() . '/library/js/libs/post-like.js' ,  true);
   wp_localize_script('like_post', 'ajax_var', array(
   	'url' => admin_url('admin-ajax.php'),
   	'nonce' => wp_create_nonce('ajax-nonce')
   ));
   
   wp_enqueue_script( 'bones-js' );
   
   
    
    
    
  }
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function bones_ie_conditional( $tag, $handle ) {
	if ( 'bones-ie-only' == $handle )
		$tag = '<!--[if lte IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}

/*********************
THEME SUPPORT
*********************/
	
// Adding WP 3+ Functions & Theme Support
function my_after_setup_theme_function() {
	
	
	
	
	 
	
} /* end bones theme support */


add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	/*
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'code125' ),
			'footer-links' => __( 'The Footer Menu', 'code125' )
		)
	);
	
	// wp thumbnails (sizes handled in functions.php)
	add_theme_support('post-thumbnails');   
	
	// default thumb size   
	set_post_thumbnail_size(125, 125, true);   
	 
	
	// rss thingy           
	add_theme_support('automatic-feed-links'); 
	
	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/
	
	// adding post format support
	add_theme_support( 'post-formats',  
		array( 
			'default',
			'gallery',         
			'video',            
		)
	);	
	
	// wp menus
	add_theme_support( 'menus' );
	*/
}


/*********************
MENUS & NAVIGATION
*********************/	


// the main menu 
function bones_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array( 
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container (should you choose to use it)
    	'menu' => 'The Main Menu',                           // nav name
    	'menu_class' => ' top-nav  clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 3,
        'echo' => true,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_main_nav_fallback',
    	'walker' => new description_walker() 	));
} /* end bones main nav */

// the footer menu (should you choose to use one)
function bones_footer_links() { 
	// display the wp3 menu if available
	
    wp_nav_menu(array( 
    	'container' => '',                              // remove nav container
    	'container_class' => 'footer-links clearfix',   // class of container (should you choose to use it)
    	'menu' => 'Footer Links',                       // nav name
    	'menu_class' => ' footer-nav clearfix',      // adding custom nav class
    	'theme_location' => 'footer-links',             // where it's located in the theme
    	'before' => '',                                 // before the menu
        'after' => '',                                  // after the menu
        'link_before' => '',                            // before each link
        'link_after' => '',                             // after each link
        'depth' => 0,                                   // limit the depth of the nav
    	'fallback_cb' => 'bones_footer_links_fallback',  // fallback function,
    	'walker' => new description_walker() 
    	
	));
	
} /* end bones footer link */
 
// this is the fallback for header menu
function bones_main_nav_fallback() { 
	wp_page_menu( 'show_home=Home' ); 
}

// this is the fallback for footer menu
function bones_footer_links_fallback() { 
	/* you can put a default here if you like */ 
}

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<span>';
           $append = '</span>';
           $description  = '';

            $item_output = $args->before;
            
            $item_output .= '<a'. $attributes .' class="'.esc_attr( $item->subtitle ).'" >';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}

function my_special_nav_class( $classes, $item )
{
    
    	$thisCat = get_term_by('name', $item->title, 'category');
    	if( is_object($thisCat) ){
    	$category_icon = get_option( 'category_icon_' . $thisCat->term_id  );
        $classes[] = $category_icon;
    	}
    return $classes;
}
add_filter( 'nav_menu_css_class', 'my_special_nav_class', 10, 2 );



/*********************
RELATED POSTS FUNCTION
*********************/	
	
// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if($tags) {
		foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
        $args = array(
        	'tag' => $tag_arr,
        	'numberposts' => 5, /* you can change this to show more */
        	'post__not_in' => array($post->ID)
     	);
        $related_posts = get_posts($args);
        if($related_posts) {
        	foreach ($related_posts as $post) : setup_postdata($post); ?>
	           	<li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
	        <?php endforeach; } 
	    else { ?>
            <?php echo '<li class="no_related_post">No Related Posts Yet!</li>'; ?>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
} /* end bones related posts function */

/*********************
PAGE NAVI
*********************/	

// Numeric Page Navi (built into the theme by default)
function bones_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<nav class="page-navigation"><ol class="bones_page_navi clearfix">'."";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = "First";
		echo '<li class="bpn-first-page-link"><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
	}
	echo '<li class="bpn-prev-link">';
	previous_posts_link('<');
	echo '</li>';
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="bpn-current">'.$i.'</li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="bpn-next-link">';
	next_posts_link('>');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = "Last";
		echo '<li class="bpn-last-page-link"><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
	}
	echo '</ol></nav>'.$after."";
} /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/	

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read more &raquo;</a>';
}

                  	

?>