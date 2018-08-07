<?php

/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_true' );



require_once('library/includes/bones.php'); 


require_once('library/includes/wp-image.php'); 

require_once('library/includes/slides-post-type.php'); 

require_once('library/includes/portfolio-post-type.php');

require_once('library/includes/team-post-type.php'); 

require_once('library/includes/faq-post-type.php');

require_once('library/includes/testimonial-post-type.php');

require_once('library/includes/custom-menu-fields/sweet-custom-menu.php');

require_once('library/includes/mobble/mobble.php');

require_once('library/includes/admin/ot-loader.php');

require_once('library/includes/admin/theme-options.php'); 

require_once('library/includes/admin/meta-boxes.php'); 

require_once('library/includes/header-custom.php');

require_once('library/includes/shortcodes/shortcodes.php');

require_once('library/includes/widgets.php');

require_once('library/includes/widget-settings-importexport/widget-data.php');

require_once('library/includes/update_notifier.php'); 

require_once('library/translation/translation.php');

require_once('library/includes/tgm-plugin-activation/revslider.php');
require_once('library/includes/tgm-plugin-activation/layerslider.php');
require_once('library/includes/tgm-plugin-activation/page-builder.php');
require_once('library/includes/tgm-plugin-activation/shortcodes-generator.php');
require_once('library/includes/tgm-plugin-activation/wp-image.php');


/************* THUMBNAIL SIZE OPTIONS *************/



/*
// Thumbnail sizes
add_image_size( 'blog-post-thumb', 640, 300, true );
add_image_size( 'blog-post-thumb-inside', 640, 9999 );

add_image_size( 'blog-post-thumb-680', 690, 9999 );
add_image_size( 'portfolio-post-thumb-inside', 960, 9999 );


add_image_size( 'slide', 960, 400, true );
add_image_size( 'slide-half', 480, 400, true );


add_image_size( 'mixed-size-1', 480, 480, true );
add_image_size( 'mixed-size-2', 480, 240, true );
add_image_size( 'mixed-size-3', 240, 480, true );
add_image_size( 'mixed-size-4', 240, 240, true );

add_image_size( '85_85', 85, 85, true );
add_image_size( '60_60', 60, 60, true );

add_image_size( '58x58', 58, 58, true );
add_image_size( '72x72', 72, 72, true );
add_image_size( '114x114', 114, 114, true );
add_image_size( '32x32', 32, 32, true );
add_image_size( '48x48', 48, 48, true );
add_image_size( '64x64', 64, 64, true );
add_image_size( '512x512', 512, 512, true );

add_image_size( 'height_20', 9999, 18 );
add_image_size( 'height_30', 9999, 30 );
add_image_size( 'height_50', 9999, 50 );
add_image_size( 'height_100', 9999, 100 );


add_image_size( '1-col', 550, 250, true );
add_image_size( '4-col', 225, 170, true );
add_image_size( '4-col-s', 225, 225, true );
add_image_size( '4-col-o', 238, 238, true );
add_image_size( '4-col-flexible', 225, 9999 );
add_image_size( '3-col', 300, 225, true );
add_image_size( '3-col-s', 300, 300, true );
add_image_size( '3-col-o', 318, 318, true );
add_image_size( '3-col-flexible', 300, 9999 );
add_image_size( '5-col', 172, 130, true );
add_image_size( '5-col-s', 172, 172, true );
add_image_size( '5-col-o', 190, 190, true );
add_image_size( '5-col-flexible', 172, 9999 );
add_image_size( '6-col', 140, 105, true );
add_image_size( '6-col-s', 140, 140, true );
add_image_size( '6-col-o', 158, 158, true );
add_image_size( '6-col-flexible', 140, 9999 );

*/

/* 
to add more sizes, simply copy a line from above 
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image, 
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/**
* function: get_attachment_id_from_src
*
* @param attachment_src srting
* @return id of the image attachment, if dont' exist it will return the given url
*/
function get_attachment_id_from_src ($attachment_src) {
	global $wpdb;
	
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$attachment_src'";
	$id = $wpdb->get_var($query);
		
	return $id;
}



if ( ! isset( $content_width ) ) $content_width = 960;
/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar',
    	'name' => 'Default Sidebar',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h3 class="title widgettitle"><span class="title">',
    	'after_title' => '</span><span class="side-icon icon-circle-arrow-right"></span></h3>',
    ));

	register_sidebar(array(
	    'id' => 'post',
	    'name' => 'Sidebar Post',
	    'description' => 'The Posts sidebar.',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="title widgettitle"><span class="title">',
	    'after_title' => '</span><span class="side-icon icon-circle-arrow-right"></span></span></h3>',
	));
	register_sidebar(array(
	    'id' => 'page',
	    'name' => 'Sidebar Page',
	    'description' => 'The Pages sidebar.',
	    'before_widget' => '<div id="%1$s" class="widget %2$s">',
	    'after_widget' => '</div>',
	    'before_title' => '<h3 class="title widgettitle"><span class="title">',
	    'after_title' => '</span><span class="side-icon icon-circle-arrow-right"></span></h3>',
	)); 
	    
} 


/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<div class="row-fluid">
			<div class="span2">
			<header class="comment-author vcard clearfix">
			    <?php /*
			        this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
			        echo get_avatar($comment,$size='32',$default='<path_to_url>' );
			    */ ?>
			    <!-- custom gravatar call -->
			    
			    	<?php echo get_avatar($comment,$size='64',$default= ot_get_option('avatar') ); ?>
			    
			   
			</header>
			</div>
			<div class="span10">
			<div class="comment-wrap">
			<!-- end custom gravatar call -->
			<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?><time class="time_class" datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time('F jS, Y'); ?> </a></time>
			<?php edit_comment_link(__('(Edit)', 'code125'),'  ','') ?>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'code125') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			</div>
			</div>
			</div>
			
			
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
    $form = '<div id="widget_search" class="clearfix">
    	<form role="search" method="get" id="searchform" action="'. home_url( '/' ).'" >
    	<input type="text" value="'. get_search_query() .'" name="s" id="s" placeholder="'.__('Search our Website','code125').'" />
    	</form>
    </div><div class="clearfix"></div>';
    return $form;
} // don't remove this bracket!


function get_image_path($post_id = null) {
    if ($post_id == null) {
        global $post;
        $post_id = $post->ID;
    }
    $theImageSrc = get_post_meta($post_id, 'Image', true);
    global $blog_id;
    if (isset($blog_id) && $blog_id > 0) {
        $imageParts = explode('/files/', $theImageSrc);
        if (isset($imageParts[1])) {
            $theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
        }
    }
    return $theImageSrc;
}


function code125_breadcrumbs() {
 
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&#8226; &#8226; &#8226;'; // delimiter between crumbs
  $home = __('Home','code125'); // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  global $post;
  $homeLink = home_url();
 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
 
  } else {
 
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . __('Archive by category "','code125') . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_search() ) {
      echo $before . __('Search results for "','code125') . get_search_query() . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . __('Posts tagged "','code125') . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __('Articles posted by ','code125') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . __('Error 404','code125' ) . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','code125') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end code125_breadcrumbs()


$sidebars_new = ot_get_option( 'sidebars', array() );

    if ($sidebars_new){
        foreach ($sidebars_new as $sidebar_new) {


            register_sidebar(array(
                'name' => $sidebar_new["title"],
                'id' => $sidebar_new["slug"],
                'description' => 'The Custom sidebars.',
                'class' => 'sidebar fourcol last clearfix',
                'before_widget' => '<div class="widget column  %2$s" id="%1$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="title widgettitle"><span class="title">',
                'after_title' => '</span><span class="side-icon icon-circle-arrow-right"></span></h3>',
            ));
        }
    }
    


function new_excerpt($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;
    if (strlen($excerpt) > $charlength) {
        $subex = substr($excerpt, 0, $charlength - 5);
        $exwords = explode(" ", $subex);
        $excut = -(strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '... <a href="' . get_permalink() . '">' . __('Read More','code125') .'</a>';
    } else {
        echo $excerpt;
    }
}

function new_excerpt_widget($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;
    if (strlen($excerpt) > $charlength) {
        $subex = substr($excerpt, 0, $charlength - 5);
        $exwords = explode(" ", $subex);
        $excut = -(strlen($exwords[count($exwords) - 1]));
        if ($excut < 0) {
            echo substr($subex, 0, $excut);
        } else {
            echo $subex;
        }
        echo '...';
    } else {
        echo $excerpt;
    }
}
if(!function_exists('the_excerpt_max_charlength')){
function the_excerpt_max_charlength($charlength) {
        $excerpt = get_the_excerpt();
        $meta_excerpt = get_post_meta(get_the_ID(), "meta_description",true);
        
        if($meta_excerpt != ''){
         echo $meta_excerpt;
        }else{
        
        $charlength++;

        if (mb_strlen($excerpt) > $charlength) {
            $subex = mb_substr($excerpt, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
            if ($excut < 0) {
                echo mb_substr($subex, 0, $excut);
            } else {
                echo $subex;
            }
            echo '...';
        } else {
            echo $excerpt;
        }
        }
    }
}
function code125_trim($string,$charlength) {
        $excerpt = $string;
        $charlength++;

        if (mb_strlen($excerpt) > $charlength) {
            $subex = mb_substr($excerpt, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
            if ($excut < 0) {
                $data =  mb_substr($subex, 0, $excut);
            } else {
                $data = $subex;
            }
            $data = $data . '...';
        } else {
            $data = $excerpt;
        }
    
    	return $data;
    }


function custom_excerpt_length($length) {
    return $length;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);


add_filter('widget_text', 'do_shortcode');

function hexDarker($hex,$factor = 30)
        {
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = $v / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v - $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
        }
     
  
  function hexLighter($hex,$factor = 30) 
      { 
      $new_hex = ''; 
       
      $base['R'] = hexdec($hex{0}.$hex{1}); 
      $base['G'] = hexdec($hex{2}.$hex{3}); 
      $base['B'] = hexdec($hex{4}.$hex{5}); 
       
      foreach ($base as $k => $v) 
          { 
          $amount = 255 - $v; 
          $amount = $amount / 100; 
          $amount = round($amount * $factor); 
          $new_decimal = $v + $amount; 
       
          $new_hex_component = dechex($new_decimal); 
          if(strlen($new_hex_component) < 2) 
              { $new_hex_component = "0".$new_hex_component; } 
          $new_hex .= $new_hex_component; 
          } 
           
      return $new_hex;     
      } 
  
 function hex2rgb($hex) {
    $hex = str_replace("#", "", $hex);
 
    if(strlen($hex) == 3) {
       $r = hexdec(substr($hex,0,1).substr($hex,0,1));
       $g = hexdec(substr($hex,1,1).substr($hex,1,1));
       $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
       $r = hexdec(substr($hex,0,2));
       $g = hexdec(substr($hex,2,2));
       $b = hexdec(substr($hex,4,2));
    }
    $rgb = array($r, $g, $b);
    //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
 }



 function contact_send() {

        add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

        ob_start();
        bloginfo('name');
        $name = ob_get_contents();
        ob_end_clean();


		$email = ot_get_option( 'contact_page' );
		
		$message = '<p>' . __('Name: ','code125') . $_POST['name'] . '</p>';
        $message = $message . '<p>' . __('Email: ','code125') . $_POST['email'] . '</p>';
        $message = $message . '<p>' . __('Message: ','code125') . $_POST['message'] . '</p>';
        $headers = 'From: ' . $name . ' ' . "\r\n";
        wp_mail( $email , $name . ' Contact Page', $message, $headers, '');

        echo 'done';
        die();
    }

    add_action('wp_ajax_nopriv_contact_send', 'contact_send');
	add_action('wp_ajax_contact_send', 'contact_send');
	
	
	
	
		
		function custom_number_format($n) {
		    
		    $precision = 1;
		    
		    if ($n < 1000) {
		        $n_format = round($n);
		    } else if ($n < 1000000) {
		        $n_format = round($n / 1000, $precision) . 'K';
		    } else {
		        $n_format = round($n / 1000000, $precision) . 'M';
		    }
		
		    return $n_format;
		}
		
		function get_shares_number($url) {
			
			
			return 0;
		}        
	
	
	add_action( 'show_user_profile', 'extra_user_profile_fields' );
	add_action( 'edit_user_profile', 'extra_user_profile_fields' );
	
	function extra_user_profile_fields( $user ) { ?>
	<h3>Extra profile information</h3>
	
	<table class="form-table">
	<tr>
	<th><label for="position">Position</label></th>
	<td>
	<input type="text" name="position" id="position" value="<?php echo esc_attr( get_the_author_meta( 'position', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description">Please enter your position for example. News Editor</span>
	</td>
	</tr>
	<tr>
	<th><label for="facebook">Facebook username</label></th>
	<td>
	<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description">Please enter your facebook username.</span>
	</td>
	</tr>
	<tr>
	<th><label for="twitter">Twitter username</label></th>
	<td>
	<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description">Please enter your twitter username.</span>
	</td>
	</tr>
	<tr>
	<th><label for="google_plus">Google Plus Link</label></th>
	<td>
	<input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr( get_the_author_meta( 'google_plus', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description">Please enter your google plus link.</span>
	</td>
	</tr>
	<tr>
	<th><label for="behance">Behance Link</label></th>
	<td>
	<input type="text" name="behance" id="behance" value="<?php echo esc_attr( get_the_author_meta( 'behance', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description">Please enter your behance link.</span>
	</td>
	</tr>
	<tr>
	<th><label for="dribble">Dribble Link</label></th>
	<td>
	<input type="text" name="dribble" id="dribble" value="<?php echo esc_attr( get_the_author_meta( 'dribble', $user->ID ) ); ?>" class="regular-text" /><br />
	<span class="description">Please enter your dribble link.</span>
	</td>
	</tr>
	</table>
	<?php }
	
	add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
	add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
	
	function save_extra_user_profile_fields( $user_id ) {
	
	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
	
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'google_plus', $_POST['google_plus'] );
	update_user_meta( $user_id, 'behance', $_POST['behance'] );
	update_user_meta( $user_id, 'dribble', $_POST['dribble'] );
	update_user_meta( $user_id, 'position', $_POST['position'] );
	
	}
	
	function wp_theme_options() {
	    global $wp_admin_bar, $wpdb;
	    if ( !is_super_admin() || !is_admin_bar_showing() )
	        return;
	     global $post;
	     $id  = '';
	     if( is_home() ){
	     	$home  = ot_get_option( 'homepage' );
	     	if( isset( $home )){
	     		if( $home != '' ){
	     			$wp_admin_bar->add_menu( array( 'id' => 'edit_home', 'title' => __( 'Edit Homepage', 'code125-admin' ), 'href' => home_url() . '/wp-admin/post.php?post='.$home.'&action=edit' ) );
	     		}
	     		
	     	}
	     
	     }
	     
	     if(is_single() || is_page() ){
	     	$id = $post->ID;
	     }elseif( is_home()) {
	     	if( $home != '' ){
	     	 $id = $home;
	     	}
	     }
	     if($id !=''){
	     	$skin= get_page_parameter('skin_default','',false);
	     	$skin_data = code125_get_skin($skin);
	     	if($skin !=''){
	     		$wp_admin_bar->add_menu( array( 'id' => 'skin_edit', 'title' => __( 'Edit Header', 'code125-admin' ), 'href' => home_url() . '/wp-admin/post.php?post=' . $skin_data['header_default'].'&action=edit' ) );
	     		$wp_admin_bar->add_menu( array( 'id' => 'header_edit', 'title' => __( 'Edit Skin', 'code125-admin' ), 'href' => home_url() . '/wp-admin/post.php?post=' . $skin .'&action=edit' ) );
	     	}
	     	$template = get_post_meta($id,'meta_template_id',true);
	     	if($template!=''){
	     		$wp_admin_bar->add_menu( array( 'id' => 'template_edit', 'title' => __( 'Edit Page Template', 'code125-admin' ), 'href' => home_url() . '/wp-admin/themes.php?page=aq-page-builder&action=edit&template=' . $template  ) );
	     	}
	     
	     }
	        
	    /* Add the main siteadmin menu item */
	    $wp_admin_bar->add_menu( array( 'id' => 'madrid_options', 'title' => __( 'Madrid Theme Options', 'code125-admin' ), 'href' => home_url() . '/wp-admin/themes.php?page=ot-theme-options' ) );
	    
	    $maintaince = ot_get_option('maintaince');
	    if($maintaince =='yes'){
	    	/* Add the main siteadmin menu item */
	    	$wp_admin_bar->add_menu( array( 'id' => 'maintaince_active', 'title' => __( 'Maintaince Mode is Active', 'code125-admin' ), 'href' => home_url() . '/wp-admin/themes.php?page=ot-theme-options' ) );
	    
	    }
	    
	    /* Add the main siteadmin menu item */
	    $wp_admin_bar->add_menu( array('parent' => 'new-content', 'id' => 'add_new_builder', 'title' => __( 'Add New Page Builder Template', 'code125-admin' ), 'href' => home_url() . '/wp-admin/themes.php?page=aq-page-builder&action=edit&template=0' ) );
	    
	    
	    
	    
	}
	add_action( 'admin_bar_menu', 'wp_theme_options', 1000 );
	
	add_filter( 'wp_default_editor', create_function('', 'return "tinymce";') );
	
	
	
	
	$timebeforerevote = 120;
	
	add_action('wp_ajax_nopriv_post-like', 'post_like');
	add_action('wp_ajax_post-like', 'post_like');
	
	
	function post_like()
	{
		$nonce = $_POST['nonce'];
	 
	    if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) )
	        die ( 'Busted!');
			
		if(isset($_POST['post_like']))
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];
			
			$meta_IP = get_post_meta($post_id, "voted_IP");
	
			if(isset($meta_IP[0])){
				$voted_IP = $meta_IP[0];
				if(!is_array($voted_IP))
					$voted_IP = array();
			}else {
				$voted_IP = array();
				
			}
			$meta_count = get_post_meta($post_id, "votes_count", true);
	
			if(!hasAlreadyVoted($post_id))
			{
				$voted_IP[$ip] = time();
	
				update_post_meta($post_id, "voted_IP", $voted_IP);
				update_post_meta($post_id, "votes_count", ++$meta_count);
				
				echo $meta_count;
			}
			else
				echo "already";
		}
		exit;
	}
	
	function hasAlreadyVoted($post_id)
	{
		global $timebeforerevote;
	
		$meta_IP = get_post_meta($post_id, "voted_IP");
		if(isset($meta_IP[0])){
			$voted_IP = $meta_IP[0];
			if(!is_array($voted_IP))
				$voted_IP = array();
		}else {
			$voted_IP = array();
		}
		$ip = $_SERVER['REMOTE_ADDR'];
		
		if(in_array($ip, array_keys($voted_IP)))
		{
			$time = $voted_IP[$ip];
			$now = time();
			
			if(round(($now - $time) / 60) > $timebeforerevote)
				return false;
				
			return true;
		}
		
		return false;
	}
	
	function getPostLikeLink($post_id)
	{
		$like_enable = ot_get_option('like_enable');
		if($like_enable !='no'){
		$vote_count = get_post_meta($post_id, "votes_count", true);
		if($vote_count == ''){
			$vote_count = 0;
		}
	
		$output = '<p class="post-like clearfix">';
		if(hasAlreadyVoted($post_id))
			$output .= ' <span title="'.__('like', 'code125').'" class="qtip like alreadyvoted icon-heart"></span><span class="count">'.$vote_count.'</span>';
		else
			$output .= '<a href="#" data-post_id="'.$post_id.'">
						<span  title="'.__('like', 'code125').'" class="qtip like icon-heart"></span><span class="count">'.$vote_count.'</span></a>';
		$output .= '</p>';
		}else {
			$output ='';
		}
		return $output;
	}
	
	function get_rating_average_num($post_id) {
		$meta_values = get_post_custom($post_id);
		
		if(!isset($meta_values['meta_use_review'][0])){
			$meta_values['meta_use_review'][0] = 'no';
		}
		$data = 0;
		$counter = 0;
		if($meta_values['meta_use_review'][0] == 'yes'){
		
			if(isset($meta_values['meta_reviews'][0])){
				 $reviews = unserialize($meta_values['meta_reviews'][0]); 
				 foreach ($reviews as $review) {
					$data = $data + $review['rating'];
					$counter++;
				}
				$rating= $data/$counter;
			
			}else {
				$rating = 0;
			}
		}else {
			$rating = 0;
		}
		
		if(!isset($meta_values['meta_review_type'][0])){
			$meta_values['meta_review_type'][0] = 'stars';
		}
		
		$rating =  round($rating/20, 2);
		
		
		
		return $rating;
	}
	
	function get_rating_average($post_id) {
		$meta_values = get_post_custom($post_id);
		
		if(!isset($meta_values['meta_use_review'][0])){
			$meta_values['meta_use_review'][0] = 'no';
		}
		$data = 0;
		$counter = 0;
		if($meta_values['meta_use_review'][0] == 'yes'){
		
			if(isset($meta_values['meta_reviews'][0])){
				 $reviews = unserialize($meta_values['meta_reviews'][0]); 
				 foreach ($reviews as $review) {
					$data = $data + $review['rating'];
					$counter++;
				}
				$rating= $data/$counter;
			
			}else {
				$rating = 0;
			}
		}else {
			$rating = 0;
		}
		
		if(!isset($meta_values['meta_review_type'][0])){
			$meta_values['meta_review_type'][0] = 'stars';
		}
		
		if($meta_values['meta_review_type'][0] == 'percentage'){
			$rating =  round($rating, 2) . '%';
		}elseif ($meta_values['meta_review_type'][0] == 'points') {
			$rating =  round($rating/10, 2);
		}else {
			$rating =  round($rating/20, 2);
		}
		
		
		return $rating;
	}
	
	function get_rating_average_star($post_id) {
		$meta_values = get_post_custom($post_id);
		
		if(!isset($meta_values['meta_use_review'][0])){
			$meta_values['meta_use_review'][0] = 'no';
		}
		$data = 0;
		$counter = 0;
		if($meta_values['meta_use_review'][0] == 'yes'){
		
			if(isset($meta_values['meta_reviews'][0])){
				 $reviews = unserialize($meta_values['meta_reviews'][0]); 
				 foreach ($reviews as $review) {
					$data = $data + $review['rating'];
					$counter++;
				}
				$rating= $data/$counter;
			
			}
		}
		
		$rating =  round($rating/10);
		
		
		$rating =  round($rating/2, 2);
		
		
		return $rating;
	}
	
	function get_review_number($review , $post_id){
		$meta_values = get_post_custom($post_id);
	
		if(!isset($meta_values['meta_review_type'][0])){
			$meta_values['meta_review_type'][0] = 'stars';
		}
		
		if($meta_values['meta_review_type'][0] == 'percentage'){
			$data =  get_percentage_review($review);
		}elseif ($meta_values['meta_review_type'][0] == 'points') {
			$data =  get_points_review($review/10);
		}else {
			$data =  get_stars_review(round($review/10)/2);
		}
		
		return $data;
		
	}
	
	
	
	function get_percentage_review($rating){
		$data = '<p class="percent_p">'.$rating.'%</p><div class="progress progress-striped"><div class="bar" style="width: '.$rating.'%;"></div></div>';
		
		return $data;
	}
	function get_points_review($rating){
		$rating_2 = $rating*10;
		$data = '<p class="percent_p">'.$rating.'</p><div class="progress progress-striped"><div class="bar" style="width: '.$rating_2.'%;"></div></div>';
		
		return $data;
	}
	
	function get_stars_review($rating){
		
		$rating_double = $rating*2;
		$data = '<p class="rating_stars clearfix">';
		
		if ($rating_double % 2 == 0) {
			for ($i = 1; $i < 6; $i++) {
				if($i<=$rating){
					$data = $data . '<span class="icon-star"></span>';
				}else {
					$data = $data . '<span class="icon-star empty"></span>';
				}
			}
		
		}else {
			$rating = round( $rating*2)/2;
			for ($i = 1; $i < 6; $i++) {
				if($i<$rating){
					$data = $data . '<span class="icon-star"></span>';
				}elseif ($i == ($rating + 0.5 )) {
					$data = $data . '<span class="icon-star-half"><span class="icon-star"></span></span>';
				}else {
					$data = $data . '<span class="icon-star empty"></span>';
				}
			}
		}
		$data = $data .'</p>';
		
		return $data;
	}
	
	function has_review($post_id) {
		$meta_values = get_post_custom($post_id);
		if(!isset($meta_values['meta_use_review'][0])){
			$meta_values['meta_use_review'][0] = 'no';
		}	
		
		if($meta_values['meta_use_review'][0] == 'yes'){
			if(isset($meta_values['meta_reviews'][0])){
				return  true;
			}else {
				return  false;
			}
		}else {
			return false;
		}
	}
	
	function get_reviewbox($post_id) {
		$meta_values = get_post_custom($post_id);
		
		if(!isset($meta_values['meta_use_review'][0])){
			$meta_values['meta_use_review'][0] = 'no';
		}
		$data = '';
		if($meta_values['meta_use_review'][0] == 'yes'){
		
			if(isset($meta_values['meta_reviews'][0])){
				 $reviews = unserialize($meta_values['meta_reviews'][0]); 
				 $data = $data . '<table class="rating_table">';
				 $data = $data . '<tr><td><p class="rating_overall">'.__('Overall Score').'<p></td><td><p class="rating_overall">'.get_rating_average($post_id).'</p></td></tr>';
				foreach ($reviews as $review) {
					$data = $data .'<tr><td><p>'.$review['title'].'</p></td><td class="rating_cell">'.get_review_number($review['rating'],$post_id).'</td></tr>';
				}
				if(isset($meta_values['meta_use_review'][0])){
					$data = $data . '<tr><td class="review_comment" colspan="2">'.$meta_values['meta_review_comment'][0].'</td></tr>';
				}
				$data = $data . '</table>';
			
			}
		}
		
		return $data;
		
	}
	
	function get_stars_average($post_id) {
		$data = '';
		if(has_review($post_id)){
			$data = get_stars_review(get_rating_average_star($post_id));
		}
		return $data;
		
	}
	
	function get_total_number_of_facebook_comments($post_id) {
		
		$url = get_permalink($post_id);
		$json = json_decode(file_get_contents('https://graph.facebook.com/?ids=' . $url ));
		return (isset($json->$url->comments)) ? $json->$url->comments : 0;
		
	}
	
	add_action('my_hourly_event', 'do_this_hourly');
	
	function my_activation() {
		if ( !wp_next_scheduled( 'my_hourly_event' ) ) {
			wp_schedule_event( time(), 'hourly', 'my_hourly_event');
		}
	}
	add_action('wp', 'my_activation');
	
	function do_this_hourly() {
		$total_count= 0;
		query_posts('posts_per_page=-1&post_type=post');
		 if (have_posts()) : while (have_posts()) : the_post();
		 	
		 	$fb_count = get_total_number_of_facebook_comments(get_the_ID());
		 	$total_count= $total_count + $fb_count;
		 	update_post_meta(get_the_ID(), 'facebook_comment_count', $fb_count);
		
		endwhile;
		endif;
		update_option('total_fb_comment_count',$total_count);
		 wp_reset_query();
		
		
		
	}
	
	
	function get_total_number_of_comments($post_id,$show_method) {
		
		$count = get_comments_number($post_id);
		
		$fb_count = get_post_meta($post_id,'facebook_comment_count',true);
		if($fb_count==''){
			$fb_count=0;
		}
		
		$count = $count + $fb_count;
		
		if($show_method == 'text'){
			if($count == 0){
				$count = __('No Comments','code125');
			}elseif ($count == 1) {
				$count = __('1 Comment','code125');
			}else {
				$count = $count .' '. __('Comments','code125');
			}
		
		
		}
		
		return $count;
		
	}
	
	function my_excerpt_protected( $excerpt ) {
	    if ( post_password_required() )
	        $excerpt = '<em>[This is password-protected.]</em>';
	    return $excerpt;
	}
	add_filter( 'the_excerpt', 'my_excerpt_protected' );
	
	add_filter( 'the_password_form', 'custom_password_form' );
	function custom_password_form($content) {
	
		$o = '<div class="password-protected-form box-container clearfix">'.$content.'</div>';
		return $o;
	}
	
	
	function code125_all_authors() {
		global $wpdb;
		$order = 'user_nicename';
		$user_ids = $wpdb->get_col("SELECT ID FROM $wpdb->users ORDER BY $order");
	
		
		return $user_ids;
	}
	
	
	
	function get_thumb_hover($post_id,$thumb_size,$option) {
	
		$id_link = get_post_thumbnail_id($post_id);
		
		$image_url = wp_get_attachment_image_src( $id_link, "full"); 
		
		$image_url2 = wp_get_attachment_image_src( $id_link, $thumb_size); 
		if($option == 'link'){
			$data = '<div class="hover_span_wrap '.$thumb_size.' clearfix" style="max-width:'.$image_url2[1].'px"><a href="'.get_permalink($post_id).'" class="hover_a"  title="'.get_the_title($post_id).'"><span class="icon-link"></span></a><a href="'.get_permalink($post_id).'"><img src="'.$image_url2[0].'" alt="" /></a></div>';
		}elseif ($option == 'none') {
			$data = '<div class="hover_span_wrap clearfix" style="max-width:'.$image_url2[1].'px"><a href="'.get_permalink($post_id).'" ><img src="'.$image_url2[0].'" alt="" /></a></div>';
		}else{
			$data = '<div class="hover_span_wrap '.$thumb_size.' clearfix" style="max-width:'.$image_url2[1].'px"><a href="'.$image_url[0].'" class="hover_a fancybox" ><span class="icon-search"></span></a><a href="'.get_permalink($post_id).'"><img src="'.$image_url2[0].'" alt="" /></a></div>';
		}
		return $data;
		
	}
	
	function load_more_posts() {
	
	//...
		if(( $_POST['post_type']=='portfolio' || $_POST['post_type']=='team') && $_POST['cat']!=''){
			$args = array(
			    'posts_per_page' => $_POST['posts_per_page'],
			    'offset' => 0,
			    'paged' => $_POST['page'],
			    'tax_query' => array(
			    		array(
			    			'taxonomy' => 'portfolio_cat',
			    			'field' => 'id',
			    			'terms' => $_POST['cat']
			    		)
			    	), 
			    'orderby' => $_POST['orderby'],
			    'order' => $_POST['order'],
			    'post_type' => $_POST['post_type'],
			    'post_status' => 'publish');
		
		}else {
			
		$args = array(
		    'posts_per_page' => $_POST['posts_per_page'],
		    'offset' => 0,
		    'paged' => $_POST['page'],
		    'cat' => $_POST['cat'],
		    'orderby' => $_POST['orderby'],
		    'order' => $_POST['order'],
		    'post_type' => $_POST['post_type'],
		    'post_status' => 'publish');
		
		}
		
		if($_POST['orderby'] == 'meta_value_num'){
			$args['meta_key'] = $_POST['meta_key'];
		}
		
		if($_POST['thumb_view']){
			$GLOBALS['thumb_view'] = $_POST['thumb_view'];
		}
		
		
		if ($_POST['passing_string']) {
		
		$mutual_array = serialize($_POST['passing_string']);
		
		
		$GLOBALS['author_enable'] = $mutual_array['author_enable'];
		$GLOBALS['date_enable'] = $mutual_array['date_enable'];
		$GLOBALS['comments_count_enable'] = $mutual_array['comments_count_enable'];
		$GLOBALS['cat_enable'] = $mutual_array['cat_enable'];
		$GLOBALS['like_enable'] = $mutual_array['like_enable'];
		$GLOBALS['view_count_enable'] = $mutual_array['view_count_enable'];
		$GLOBALS['review_enable'] = $mutual_array['review_enable'];
		
		}
		if($_POST['data-link']){
			$GLOBALS['link_type'] = $_POST['data-link'];
		}
		
	  query_posts($args);
	   
	     $GLOBALS['primary_color'] = $_POST['primary_color'];
	     $GLOBALS['columns_team'] =  $_POST['column'];
	     $data = '';
	     
	     while (have_posts()) : the_post();
	     
	   			include(get_template_directory() . '/library/includes/templates/'.$_POST['current_shortcode'].'.php');
	   	
	   endwhile;
	   
	   wp_reset_postdata();
	   echo $data;
		die();
	}
	add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
	add_action('wp_ajax_load_more_posts', 'load_more_posts');
	



function show_full_post() {

//...
	
		
	$args = array(
	    'p' => $_POST['id'],
	    'post_status' => 'publish',
	    'post_type' => $_POST['type']);
	
	
  query_posts($args);
   
     
     while (have_posts()) : the_post();
     
   			ob_start();
   			the_content();
   			$data  ='<div class="post-content">' . ob_get_contents() . '</div>';
   			ob_end_clean();
   	
   endwhile;
   
   wp_reset_postdata();
   echo $data;
	die();
}
add_action('wp_ajax_nopriv_show_full_post', 'show_full_post');
add_action('wp_ajax_show_full_post', 'show_full_post');


	

function get_full_post() {

//...
	
		$type = get_post_type($_POST['post_id']);
	$args = array(
	    'p' => $_POST['post_id'],
	    'post_status' => 'publish',
	    'post_type' => $type );
	
	
  query_posts($args);
   
     $data  = '<div class="row-fluid"><div class="span4">';
     while (have_posts()) : the_post();
     		
     		ob_start();
     		the_author_posts_link();
     		$the_author_posts_link = ob_get_contents();
     		ob_end_clean();
     		
     		
     		ob_start();
     		the_excerpt_max_charlength(300);
     		$the_excerpt_max_charlength = ob_get_contents();
     		ob_end_clean();
     		
     		$permalink = get_permalink();
     		
     		$comments_number = do_shortcode('[post_comments_count post_id="'.get_the_ID().'" method="text"]');
     		
     		
     		$meta_values = get_post_custom(get_the_ID());
     		
     		
     		$cat_echo_p  = do_shortcode('[post_category post_id="'.get_the_ID().'"]');
     		
     		$format = get_post_format();
     		$meta_values = get_post_custom(get_the_ID());
     		$GLOBALS['thumb-size'] = 'blog-post-ajax';
     		$data  = $data . '<div class="ajax-post-wrap">';
     		$featured_enable = ot_get_option('featured_enable');
     		
     		$data  = $data . '<h3 >' . get_the_title() . '</h3>';
     		if ($featured_enable != 'no') {
     		   if (!post_password_required()) {
     				include(get_template_directory() . '/library/includes/templates/post-formats.php');
     			}
     		}
     		$data  = $data . '</div>';
     		
     		include(get_template_directory() . '/library/includes/templates/meta-data.php');
     		
     		 $data  = $data . '<div class="clearfix"></div><div style="height:30px;"></div>';
   			ob_start();
   			the_content();
   			$data  = $data . '</div><div class="span8"><div class="post-content">' . ob_get_contents() . '</div></div></div>';
   			ob_end_clean();
   	
   endwhile;
   
   wp_reset_postdata();
   echo $data;
	die();
}
add_action('wp_ajax_nopriv_get_full_post', 'get_full_post');
add_action('wp_ajax_get_full_post', 'get_full_post');


		
	
	
	
	function get_logo($logo='',$margin=0,$size='height_30',$logo_subline='') { ?>
		<div id="logo-wrap">
		                                        <?php
		                                       
		                                       
		                                        ?>
		                                        <a style="margin-top: <?php echo $margin ?>;" id="logo" href="<?php echo home_url(); ?>" rel="nofollow"><?php if ($logo !=''){
		                                         	$base_url = wp_upload_dir();
		                                         	$url = str_replace($base_url['baseurl'],$base_url['basedir'],$logo);
		                                         	if( file_exists($url)) {
		                                            
		                                            $link_id = get_attachment_id_from_src($logo);
		                                            
		                                            
		                                            $image_url = wp_get_attachment_image_src($link_id, $size);
		                                            ?>
		                                                <img src="<?php echo $image_url[0]; ?>" width="<?php echo $image_url[1]; ?>" height="<?php echo $image_url[2]; ?>" alt="" />
		                                                <?php
		                                                }
		                                            } else {
		                                                bloginfo('name');
		                                            }
		                                            ?></a>
		                                        <?php
		                                        if ($logo_subline != '') {
		                                            echo '<div class="clearfix"></div><p class="subline">' . $logo_subline . '</p>';
		                                        }
		                                        ?>
		
		                                    </div>
	<?php  }
	
	
	
	function format_background($value=array(),$default='') {
			$bg = "";
			if ( $value['background-color']!='' ){
				$bg = $bg .$value['background-color'] . ' ';
			}
			
			if ( $value['background-image']!='' ){
				$main_bg_url = "url('". $value['background-image'] . "')" . ' ';
			}else{
				$main_bg_url = "" ;
			}
			$bg = $bg .$main_bg_url;
			
			if ( $value['background-attachment']!=''){
				$bg = $bg .$value['background-attachment'] . ' ';
			}
			
			if ($value['background-position']!='' ){
				$bg = $bg . $value['background-position'] . ' ';
			}
			
			if ($value['background-repeat']!=''){
				$bg = $bg . $value['background-repeat'] . ' ';
			}
			if($bg !=''){
				$bg = 'background: ' . $bg . ';' ;
			}
			
			if(count($value) == 0 ){
				if($default !=''){
			
				$bg = 'background: ' . $default . ';' ;
				}else {
					$bg='';
				}
			}			
			return $bg;
	}
	
	
	function get_page_parameter($parameter,$default ='',$is_background=false) {
		
		if(isset($_POST[$parameter])){
			$value = $_POST[$parameter];
		
		}else{
				
				
				if (is_home()) {
					if(function_exists('icl_object_id')){
						$home = icl_object_id(ot_get_option( 'homepage' ), 'page', true);
					}else {
						$home = ot_get_option( 'homepage' );	
					}
					
		        	if($home != ''){
		        		$value = get_post_meta($home,$parameter,true);
		        	}else {
		        		$value = ot_get_option( $parameter );
		        	}
		            
		        }elseif(is_category()){
		        	 $categories_get = ot_get_option( 'tax_category', array() );
		        	 
		        	     if ($categories_get){
		        	         foreach ($categories_get as $category) { 
		        	         	if(is_category($category['category']) && $category['category']!='' ){
		        	         		$value = $category[$parameter];
		        	         	}
		        	         }
		        	      }
		        	     
		        }elseif(is_tax()){
		        	$tax_array = get_tax_array();
		        	$tax_value='';
		        	foreach ($tax_array as $value2) {
		        		if(is_tax( $value2 )){
		        			$tax_value= $value2;
		        		}
		        		
		        	}
		        	$categories_get = ot_get_option( 'tax_category', array() );
		        	     if ($categories_get){
		        	         
		        	         foreach ($categories_get as $category) { 
		        	         	
		        	         	if(is_tax( $tax_value, $category['category'] ) && $category['category']!='' ){
		        	         		$value = $category[$parameter];
		        	         	}
		        	         }
		        	      }
		        	        
		        } elseif(is_page()  ) {
		        	global $post;
					$value = get_post_meta($post->ID,$parameter,true);		                
		            
		        }elseif(is_single()){
		        	$use_parent = ot_get_option('article_styling');
		        	global $post;
		        	$type = get_post_type($post->ID);
		        	if($use_parent == 'yes' && ( $type!='faq'  &&  $type!='testimonial' )){
		        		$type = get_post_type($post->ID);
		        		
		        		$tax = get_post_tax($post->ID);
		        		
		        		$terms = wp_get_post_terms($post->ID, $tax);
		        		
		        		if(count($terms)!= 0){
		        		$categories_get = ot_get_option( 'tax_category', array() );
		        		if(!$is_background){
		        			$value='';	
		        		
		        		}else {
		        			$value=array();
		        		}
		        		
		        		if( $type != 'post' && $type != 'portfolio' && $type != 'team' && $type != 'faq' && $type != 'testimonial'  ){
		        			
		        			$custom_posts = ot_get_option('custom_posts', array());
		        			
		        			if ($custom_posts) {
		        			    foreach ($custom_posts as $custom_post) {
		        			    	if($custom_post['slug'] == $type){
		        			    		$value = $custom_post[$parameter];
		        			    	}
		        			    }
		        			 }
		        		
		        		
		        		}
		        		
		        		
		        		
		        		    if ($categories_get){
		        		        foreach ($categories_get as $category) { 
		        		        	
		        		        	if($category['category'] == $terms[0]->term_id){
		        		        		if(isset($category[$parameter])){
		        		        			$value = $category[$parameter];
		        		        		}
		        		        	}
		        		        }
		        		     }
		        		}
		        		
		        		if(!$is_background){
		        			if(!isset($value)){
		        				$value = get_post_meta($post->ID,$parameter,true);	
		        			}	
		        		
		        		}else {
		        			if(is_array($value)){
		        				$value = get_post_meta($post->ID,$parameter,true);	
		        			}
		        		}
		        		
		        		
		        	}else {
		        		$value = get_post_meta($post->ID,$parameter,true);
		        	}
		        	
		        	
		        }else {
		        	$value = ot_get_option($parameter);
		        }
		        
		        
		        if(!$is_background){
		        	if(isset($value)){
		        	if ($value == '') {
		        		$value = ot_get_option($parameter);
		        	
		       		 	if($value == ''){
		        			$value = $default;
		        		}
		        	}	
		        	}else {
		        		$value = ot_get_option($parameter);
		        		if($value == ''){
		        			$value = $default;
		        		}
		        	}
		        }else{
		        	if (isset($value)) {
		        		$value = ot_get_option($parameter);
		        	}else {
		        		if(isset($value)){
		        		if(is_array($value)){
		        			if($value['background-image'] == '' && $value['background-color'] == ''){
		        				$value = ot_get_option($parameter);
		        			}else {
		        				$value = unserialize($value);
		        			}
		        			
		        		}else {
		        			$value= array();
		        		}
		        		}else {
		        			$value = ot_get_option($parameter);
		        			
		        		}
		        		
		        	}
		        	$bg = format_background($value,$default);
		        	
		        	
		        	return $bg;
		        }
		        }
		        
		        return $value;
		
	}
	
	function get_post_format_icon($id) {
		$format = get_post_format($id);
		$the_post_thumbnail = get_the_post_thumbnail($id,array(50,50));
		
		if (is_sticky($id)) {
		    $icon= 'icon-doc-text-inv';
		} elseif ($format == 'video') {
		   $icon= 'icon-video';
		} elseif ($format == 'gallery') {
		    $icon= 'icon-picture';
		} elseif ($format == 'audio') {
		    $icon= 'icon-volume-up';
		} else {
		    if ($the_post_thumbnail == '') {
		        $icon= 'icon-doc-text-inv';
		    } else {
		        $icon= 'icon-picture-1';
		    }
		}
		
		return $icon;
	}	
	
	
	
	
	function alter_posts_per_page( $query ) {
	    if ( $query->is_category() && $query->is_main_query() ) {
	    	$columns_per_page= get_page_parameter('columns_per_page','10',false);
	        $query->set( 'posts_per_page', $columns_per_page );
	    }elseif ( !is_admin() && $query->is_main_query() ) {
	      if ($query->is_search) {
	      	$post_type = ot_get_option('search_post');
	        $query->set('post_type', $post_type);
	        $search_columns_per_page = ot_get_option('search_columns_per_page');
	        $query->set( 'posts_per_page', $search_columns_per_page );
	        
	        
	      }
	    }elseif ($query->is_archive() && !$query->is_category() && $query->is_main_query()) {
	    	$columns_per_page= ot_get_option( 'columns_per_page' );
	    	$query->set( 'posts_per_page', $columns_per_page );
	    }
	    
	    if ($query->is_author()  && $query->is_main_query()) {
	    	$columns_per_page= ot_get_option( 'columns_per_page' );
	    	$query->set( 'posts_per_page', $columns_per_page );
	    }
	}
	add_action( 'pre_get_posts', 'alter_posts_per_page' );
	
	function getPostViews($postID){
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	        return "0";
	    }
	    return $count ;
	}
	
	// function to count views.
	function setPostViews($postID) {
	    $count_key = 'post_views_count';
	    $count = get_post_meta($postID, $count_key, true);
	    if($count==''){
	        $count = 0;
	        delete_post_meta($postID, $count_key);
	        add_post_meta($postID, $count_key, '0');
	    }else{
	        $count++;
	        update_post_meta($postID, $count_key, $count);
	    }
	}
	
	
	// Add it to a column in WP-Admin
	add_filter('manage_posts_columns', 'posts_column_views');
	add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
	function posts_column_views($defaults){
	    $defaults['post_views'] = __('Views');
	    return $defaults;
	}
	function posts_custom_column_views($column_name, $id){
		if($column_name === 'post_views'){
	        echo getPostViews(get_the_ID());
	    }
	}
	
	
	add_action( 'save_post', 'rating_meta_update' );
	
	function rating_meta_update( $post_id ) {
	
		//verify post is not a revision
		if ( !wp_is_post_revision( $post_id ) ) {
			if(has_review($post_id)){
				update_post_meta($post_id, 'rating_average', get_rating_average($post_id));
			}
		}
	
	}
	
	
	
	
	
	function get_post_tax($post_id) {
		$type = get_post_type($post_id);
		if($type == 'post'){
			$tax = 'category';
		}elseif ($type == 'portfolio') {
			$tax = 'portfolio_cat';
		}elseif ($type == 'team') {
			$tax = 'hierarchy';
		}else {
			$custom_posts = ot_get_option('custom_posts', array());
			
			if ($custom_posts) {
			    foreach ($custom_posts as $custom_post) {
			    	if($type = $custom_post['slug']){
			    		$tax =  $custom_post['category'];
			    	}
			    }
			 }    
			        
			        
		}
		if(isset($tax)){
			return $tax;
		}else {
			return false;
		}
		
		
	}
	function get_tax_by_type($type) {
	
		if($type == 'post'){
			$tax = 'category';
		}elseif ($type == 'portfolio') {
			$tax = 'portfolio_cat';
		}elseif ($type == 'team') {
			$tax = 'hierarchy';
		}else {
			$custom_posts = ot_get_option('custom_posts', array());
			
			if ($custom_posts) {
			    foreach ($custom_posts as $custom_post) {
			    	if($type = $custom_post['slug']){
			    		$tax =  $custom_post['category'];
			    	}
			    }
			 }    
			        
			        
		}
		if(isset($tax)){
			return $tax;
		}else {
			return false;
		}
		
		
	}
	
	function get_tax_array() {
		$tax = array();
		
		$tax[] = 'category';
		$tax[] = 'portfolio_cat';
		$tax[] = 'hierarchy';
		$custom_posts = ot_get_option('custom_posts', array());
		if ($custom_posts) {
		    foreach ($custom_posts as $custom_post) {
		    	if($type = $custom_post['slug']){
		    		$tax[] = $custom_post['category'];
		    	}
		    }
		 } 	
			   
	    return $tax;
		
		
	}
	
	function get_post_type_by_cat($tax) {
		
		if($tax == 'category'){
			$type =  'post';
		}elseif ($tax == 'portfolio_cat') {
			$type =  'portfolio';
		}elseif ($tax ==' hierarchy') {
			$type =  'team' ;
		}else {
			$custom_posts = ot_get_option('custom_posts', array());
			
			if ($custom_posts) {
			    foreach ($custom_posts as $custom_post) {
			    	if($tax == $custom_post['category']){
			    		$type =  $custom_post['slug'];
			    	}
			    }
			 }    
			        
			        
		} 	
			   
	    return $type;
		
		
	}
	
	
	function code125_is_rtl() {
	
		$rtl= get_page_parameter('rtl','',false);
		$main_rtl = ot_get_option('rtl');
		if(is_rtl()){
			if($rtl == 'no' && $main_rtl=='yes'){
				$rtl_bool = false;
			}else {
				$rtl_bool = true;
			}
		}else {
			if($rtl == 'yes'){
				$rtl_bool = true;
			}else {
				$rtl_bool = false;
			}
		}
		
		return $rtl_bool;
		
	}
	
	
	function get_login_form($class = '') {
		
		if( !is_user_logged_in() ){
	
		$data  = '<form name="loginform" id="loginform" action="'. home_url() .'/wp-login.php" method="post" class="'.$class.' clearfix"><div class="input-wrap"><input type="text" name="log" class="element-block" id="user_login" class="input" placeholder="'. __('username','code125') .'" size="20" /><span class="icon-user"></span></div><div class="clearfix"></div><div class="input-wrap"><input type="password" name="pwd" class="element-block" id="user_pass" class="input" placeholder="'. __('******','code125') .'" size="20" /><span class="icon-lock"></span></div><div class="row-fluid"><div class="span6"><p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever">'. __( 'Remember Me','code125') .'</label></p></div><div class="span6"><a class="forget_password" href="'. wp_lostpassword_url( home_url() ).'">'. __('Forget Password ?','code125').'</a></div></div><p class="login-submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary " value="'. __( 'Login','code125') .'"><a class="button-primary" href="'. home_url() .'/wp-login.php?action=register">'. __('Register','code125').'</a><input type="hidden" name="redirect_to" value="'. home_url() .'"></p></form>';
		
		}else {
		
			$user_id = get_current_user_id();
			
			
		
			$user = get_userdata($user_id);
			
			$facebook_user = get_the_author_meta( 'facebook',$user_id);
			$twitter_user = get_the_author_meta( 'twitter', $user_id);
			$position_user = get_the_author_meta( 'position', $user_id);
			
			$google_plus_user = get_the_author_meta( 'google_plus', $user_id);
			$behance_user = get_the_author_meta( 'behance', $user_id);
			$dribble_user = get_the_author_meta( 'dribble', $user_id);
			
			$avatar = get_avatar( $user_id, '64', '', '<span class="icon-user"></span>' );
			
			$data =  '<div class="'.$class.' clearfix"><div class="box-container "><div class="row-fluid"><div class="span4">'. $avatar.'</div><div class="span8"><p>'.__('Hello, ','code125').' '.$user->display_name.'</p><a class="button-primary" href="'.wp_logout_url(home_url()).'">'.__('Logout','code125').'</a></div></div></div></div>';
			
		}
		
		return $data;
	}
	
	
	function code125_get_skin($id) {
		
		$default_1 = array( 
			'header_default' => '',
			'footer_default' => '',
			'page_layout' => 'full-layout',
			'fadein_elements' => 'no',
			'primary_color' => '#86c900',
			'secondary_color' => '#fbfbfb',
			'text_color' => '#505050',
			'text2_color' => '#8f8f8f',
			'light_text_color' => '#ffffff',
			'light_text_color_hover' => '#ffffff',
			'footer_bg_color' => '#fafafa',
			'body_background' => array(
					'background-color' => '#ffffff',
					'background-repeat' => '',
					'background-attachment' => '',
					'background-position' => '',
					'background-image' =>'' ),
			'main_background' => array(
					'background-color' => '#fbfbfb',
					'background-repeat' => '',
					'background-attachment' => '',
					'background-position' => '',
					'background-image' =>'' ),
		   'heading_font' => 'Oswald',
		   'heading_transform' => 'uppercase',
		   'heading_weight' => 'default',
		   'body_font' => 'PT Sans',
		   'body_font_size' => '13px',
		   'body_weight' => 'default',
		   'top_menu_fsize' => '14px',
		   'article_title_fsize' => '18px',
		   'title_fsize' => '15px',
		   'widget_title_fsize' => '15px',
		   'logo_fsize' => '50px',
		   'slider_title_fsize' => '25px',
		   'custom_css' => '',
		   'custom_js' => ''  );
		if($id == 'pre-skin1'){
			return $default_1;
		}
		if($id!=''){
		$meta_values = get_post_custom($id);
		$return = array();
		
		foreach ($default_1 as $key => $value) {
			if($key == 'body_background' || $key == 'main_background' ){
				 $new_array = unserialize($meta_values[$key ][0]);
				 $new_array2 = array();
				 foreach ($new_array as $key2 => $value2) {
				 		 $new_array2[$key2] = $new_array[$key2];
				 }
				 $return[$key] =  $new_array2;
			}else{
				if(isset($meta_values[$key][0])){
					$return[$key] =  $meta_values[$key][0];
				}else {
					$return[$key] = '';
				}
			}
		}
		
		
		
		 return $return;
		 
		 }else {
		 	return $default_1;
		 }
	}
	function code125_get_header($id) {
	
		$default_1 = array( 
			'show_shadow' => 'no',
			'header-style' => 'full',
			'use_background' => 'no',
			'background' => array(
			        'background-color' => '',
			        'background-repeat' => '',
			        'background-attachment' => '',
			        'background-position' => '',
			        'background-image' => '',
			    ),
			'background_style' => '',
			'background_alpha' => '',
			'use_logo' => 'yes',
			'logo' => '',
			'logo_center' => '',
			'logo_size' => '',
			'logo_subline' => '',
			'logo_margin' => '',
			'logo_right' => '[social_bar][menu location="main-nav" style="default"]',
			'announcment_enable' => '',
			'announcment_style' => '',
			'announcment_content' => '',
			'top_enable' => '',
			'top_style' => '',
			'top_content' => '',
			'below_enable' => '',
			'below_style' => '',
			'below_content' => '',
			'float_enable' => 'yes',
			'float_logo' => '',
			'float_style' => 'dark-mode',
			'float_content' => '[menu location="main-nav" style="mini"]' );
		if ($id != '') {
			
		
		
		$meta_values = get_post_custom($id);
		$return = array();
		
		foreach ($default_1 as $key => $value) {
			if($key == 'background' ){
				 if(isset($meta_values[$key ][0])){
				 $new_array = unserialize($meta_values[$key ][0]);
				 $new_array2 = array();
				 foreach ($new_array as $key2 => $value2) {
				 		 $new_array2[$key2] = $new_array[$key2];
				 }
				 $return[$key] =  $new_array2;
				 }else {
				 	$return[$key] = array();	
				 }
			}else{
				if(isset($meta_values[$key][0])){
					$return[$key] =  $meta_values[$key][0];
				}else {
					$return[$key] = '';
				}
			}
		}
		
		
		 return $return;
		 
		 }else {
		 	return $default_1;
		 }
	}
	
	function get_category_to_follow($post_id){
	
		$meta_values = get_post_custom( $post_id );
	
		$tax = get_post_tax( $post_id  );
	
		$terms = wp_get_post_terms( $post_id , $tax);
	
		if(!isset($meta_values['cat_id'][0])){
			$cat_id = $terms[0]->term_id;
		}else {
			if($meta_values['cat_id'][0] != ''){
				$cat_id = $meta_values['cat_id'][0];
			}else {
				$cat_id = $terms[0]->term_id;
			}
		}
		return $cat_id;
	}
	
	
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	
	//convert links to clickable format
							function convert_links($status,$targetBlank=true,$linkMaxLen=250){
							 
								// the target
									$target=$targetBlank ? " target=\"_blank\" " : "";
								 
								// convert link to url
									$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
	]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',0,$linkMaxLen).'...':'$1')).'</a>'", $status);
								 
								// convert @ to follow
									$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);
								 
								// convert # to search
									$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);
								 
								// return the status
									return $status;
							}
						
						
						//convert dates to readable format	
							function relative_time($a) {
								//get current timestampt
								$b = strtotime("now"); 
								//get timestamp when tweet created
								$c = strtotime($a);
								//get difference
								$d = $b - $c;
								//calculate different time values
								$minute = 60;
								$hour = $minute * 60;
								$day = $hour * 24;
								$week = $day * 7;
									
								if(is_numeric($d) && $d > 0) {
									//if less then 3 seconds
									if($d < 3) return "right now";
									//if less then minute
									if($d < $minute) return floor($d) . " seconds ago";
									//if less then 2 minutes
									if($d < $minute * 2) return "about 1 minute ago";
									//if less then hour
									if($d < $hour) return floor($d / $minute) . " minutes ago";
									//if less then 2 hours
									if($d < $hour * 2) return "about 1 hour ago";
									//if less then day
									if($d < $day) return floor($d / $hour) . " hours ago";
									//if more then day, but less then 2 days
									if($d > $day && $d < $day * 2) return "yesterday";
									//if less then year
									if($d < $day * 365) return floor($d / $day) . " days ago";
									//else return more than a year
									return "over a year ago";
								}
							}
							
							
	 include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
	if(!is_plugin_active('c5-page-builder/page-builder.php')){
			function c5_template($atts, $content) {
				$atts = shortcode_atts(array(
				    'id' => '' ), $atts);
				    
				 $code = get_option('c5_template_'.$atts['id']);
				 return do_shortcode($code);
			}
			add_shortcode('template','c5_template');
	
	}
							
							
?>