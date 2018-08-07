<?php
$maintaince = ot_get_option('maintaince');
if($maintaince == 'yes' && !is_home()){
if ( ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() )  && !is_home()) { ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    
    <head>
    <meta http-equiv="Refresh" content="0; url=<?php echo  home_url();  ?>"> 
    <script src="<?php echo home_url(); ?>/wp-content/themes/madrid/library/js/modernizr.js" type="text/javascript"></script>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=2.0" />
    <meta name="viewport" content="user-scalable=0, initial-scale=1.0">

 
  <script>
    // very simple to use!
    $(document).ready(function() {
      $('.js-activated').dropdownHover().dropdown();
    });
  </script>

    </head>
    
    <body>
    </body>
    </html>
    
    <?php exit(); ?> 
<?php }
}

$GLOBALS['start_time'] = microtime(true);

$gzip = ot_get_option('gzip');
if ($gzip == 'yes') {
    ob_start("ob_gzhandler");
    
}
?>

<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->


    <head>


        <meta charset="utf-8" />

        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<?php  $responsive = ot_get_option('responsive');
		
		if($responsive != 'no'){ ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<?php }else { ?>
		<meta name="viewport" content="width=1024"/>
		<?php } ?>
        <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>

        <!-- Google Chrome Frame for IE -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta HTTP-EQUIV="Content-language" CONTENT="en">


        <?php
        $seo = ot_get_option('seo');
        if ($seo != 'no') {
            ?>
            <!-- SEO meta tags -->
            <meta name="googlebot" content="index,follow" />    
            <meta name="robots" content="index,follow" />    
            <meta name="msnbot" content="index,follow" />
        <?php } ?>



        <!-- mobile meta (hooray!) -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">







        <!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
        
        <?php $fav_id = get_attachment_id_from_src(ot_get_option('favicon')); ?>
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '32x32'); ?>
        <link rel="shortcut icon" href="<?php echo $image_url[0] ?>">
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '58x58'); ?>
        <link rel="apple-touch-icon" href="<?php echo $image_url[0] ?>" />   
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '72x72'); ?>
        <link rel="apple-touch-icon" sizes="72×72" href="<?php echo $image_url[0] ?>" />
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '114x114'); ?>
        <link rel="apple-touch-icon" sizes="114×114" href="<?php echo $image_url[0] ?>" />
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '512x512'); ?>
        <link rel="apple-touch-icon" sizes="512×512" href="<?php echo $image_url[0] ?>" />
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '32x32'); ?>
        <link rel="icon" href="<?php echo $image_url[0] ?>" sizes="32×32" />
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '48x48'); ?>
        <link rel="icon" href="<?php echo $image_url[0] ?>" sizes="48×48" />
        
        <?php $image_url = wp_get_attachment_image_src( $fav_id, '64x64'); ?>
        <link rel="icon" href="<?php echo $image_url[0] ?>" sizes="64×64" />

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php $theme = wp_get_theme(); ?>
         <!--You Are using <?php echo $theme->get('Name') ?> <?php echo $theme->get('Version') ?> & WordPress Version <?php echo get_bloginfo('version') ?> & PHP Version <?php echo phpversion(); ?> -->
		
        <!-- wordpress head functions -->
        <?php wp_head(); ?>
        <!-- end of wordpress head -->
    </head>

    <?php
    if (code125_is_rtl()) {
        $rtl = 'rtl';
    } else {
        $rtl = '';
    }
    
    $skin= get_page_parameter('skin_default','',false);
    $skin_data = code125_get_skin($skin);
    ?>

    <body <?php body_class($rtl ); ?>>
		
		
        <?php
        $facebook_app_id = ot_get_option('facebook_ID');

        $GLOBALS['show_review_box'] = true;
        ?>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $facebook_app_id; ?>";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <input type="hidden" value="<?php echo home_url(); ?>" id="website_dir" name="website_dir" />
        <?php
        if (!wp_is_mobile()) {

            $preview = ot_get_option('preview');
            if ($preview == 'yes') {
                wp_enqueue_script('jquery_colorpicker');
                ?>
                <div id="preview" class="hide2"><form method="post" action=""><input id="preview_input" type="text" name="primary_color" value="<?php echo $GLOBALS['primary_color'] ?>" />
                
                        <select name="skin_default">
                             <option value="<?php echo ot_get_option('skin_default') ?>">Choose Skin</option>
                            <?php
                            if (isset($_POST['skin_default'])) {
                                $skin_select = $_POST['skin_default'];
                            } else {
                                $skin_select  = '';
                            }
                            $query = new WP_Query( array( 'post_type' => 'skin', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'publish' ) );
                            
                            /* has posts */
                            if ( $query->have_posts() ) {
                              while ( $query->have_posts() ) {
                                $query->the_post();
                                if($skin_select == get_the_ID() ){
                                    $selected = 'selected="selected"';
                                } else {
                                    $selected = '';
                                }
                                ?>
                                
                                <option value="<?php echo get_the_ID();?>" <?php echo $selected ?>><?php echo get_the_title() ;?></option>
                                <?php
                                }
                            } 
                            wp_reset_postdata(); ?>
                        </select>
                        <select name="page_layout">
                            <option value="full-layout">Choose Layout</option>
                            <option value="boxed-layout">Boxed</option>
                            <option value="full-layout">Full Width</option>
                        </select>
                        
                        
                        
                        <input id="submit" type="submit" name="submit_colors" class=""  value="Do Changes" /></form><div id="preview_show" class=" icon-cog"></div></div>

                <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $("#preview_input").ColorPicker({onSubmit:function(hsb, hex, rgb, el) {
                            $(el).val("#" + hex);
                            $(el).ColorPickerHide();
                        }, onBeforeShow:function() {
                            $(this).ColorPickerSetColor(this.value);
                        }}).bind("keyup", function() {
                        $(this).ColorPickerSetColor("#" + this.value);
                    });
                });
                </script>

                <?php
            }
        }
        ?>

        <?php
       if( is_home() ){
       
       		if(function_exists('icl_object_id')){
       			$home = icl_object_id(ot_get_option( 'homepage' ), 'page', true);
       		}else {
       			$home = ot_get_option( 'homepage' );	
       		}
       		if($home !=''){
       			$template = get_post_meta( $home, '_wp_page_template', true );
       			if($template == 'template-blank.php'){
       				$template_bool = false;
       				$GLOBALS['template-file'] = 'template-blank.php';
       			}else {
       				$template_bool = true;
       			}
       		}else {
       			$template_bool = true;
       		}
       }else {
       	$template_bool = true;
       }
       
       	if(!is_page_template('template-blank.php') && $template_bool){
        if(!is_archive() && !is_search() && !is_404() && !is_home()){
        $meta_values = get_post_custom($post->ID);
        }
       
       
        
        $header_data= code125_get_header($skin_data['header_default']);
        
            


        $header_style_class = '';
        
                if ($header_data['use_background'] == 'yes') {

                    $bg_img = $header_data['background']['background-image'];
                    if (isset($bg_img)) {
                        $bg_url = "url('" . $bg_img . "')";
                    } else {
                        $bg_url = '';
                    }
                    $bg_color = $header_data['background']['background-color'];
                    
                    $background_alpha = $header_data['background_alpha'];
                    if($background_alpha!='' && $background_alpha!='no' && $bg_color!=''){
                    	$color_rgb = hex2rgb($bg_color);
                    	$alpha = $background_alpha/100;
                    	$bg_color = 'rgba('.$color_rgb[0].','.$color_rgb[1].','.$color_rgb[2].','.$alpha.')';
                    }
                    $bg_repeat = $header_data['background']['background-repeat'];
                    $bg_position = $header_data['background']['background-position'];
                    $bg_attachment = $header_data['background']['background-attachment'];

                    if ($bg_color != '' || $bg_img != '') {
                        $header_style_background = 'style="background:' . $bg_color . " " . $bg_url . " " . $bg_repeat . " " . $bg_position . " " . $bg_attachment . ';"';
                        $header_style_class = 'header-custom-background ' . $header_data['background_style'];
                    }
                } else {
                    $header_style_background = '';
                }
           
        
        ?>
		<?php $page_layout=  $skin_data['page_layout'] ; ?>
		
		<?php 
		
		if(isset( $_POST['page_layout']) ){
			$page_layout=$_POST['page_layout'];
		}	
		
		 ?>
        <div class="website-wrap <?php echo $page_layout; ?>">
             <?php
            	                 if ($header_data['float_enable'] == 'yes') { ?>
                                        <div id="floating-bar" class="clearfix <?php echo $header_data['float_style'] ?> ">
            
            
                                            <div class="mid-page">
                                                <?php
                                                if ($header_data['float_logo'] != '') {
                                                    get_logo($header_data['float_logo'], '10px', 'height_20');
                                                }
                                                ?>
                                                <?php echo do_shortcode($header_data['float_content']); ?>
                                            </div>
                                        </div>
            
                                    <?php } ?>
            <header  class="header clearfix  <?php echo $header_data['header-style']  ?> <?php echo $header_style_class ?>" >
				<?php
					$bg_echo = $header_style_background;
				
				?>
				
				<div  class="<?php echo $header_data['header-style']  ?>" <?php echo $bg_echo; ?>>
			
                <?php if ($header_data['announcment_enable'] == 'yes') { ?>
                                           <div id="announcment-bar" class="clearfix <?php echo $header_data['announcment_style'] ?> ">
                                               <div class="mid-page">
                                                  <div class="announcment-content">
                                                  <?php echo do_shortcode($header_data['announcment_content']); ?>
                                                  </div>
                                                  <div class="close-button"><span class="icon-cancel-1"></span></div>
                                               </div>
                                                             
                                           </div>
               
                                       <?php } ?>

                        <?php if ($header_data['top_enable'] == 'yes') { ?>
                            <div id="top-bar" class="clearfix <?php echo $header_data['top_style'] ?> ">
                                <div class="mid-page">
                                   <?php echo do_shortcode($header_data['top_content']); ?>
                                </div>
                                <?php if ($header_data['top_style'] == 'light-mode') { ?>
                                    <div class="shadow"></div>
                                <?php } else { ?>
                                    <div class="semi-transparent-bar"></div>
                                <?php } ?>

                            </div>

                        <?php } ?>
                        <div class="">
                            <div class="container" >
                                <div class="row-fluid logo-area-header">
                                    <div class="span12">
                                        <div class="float_left <?php echo $header_data['logo_center'] ?>">
                                            <?php
                                            if ($header_data['use_logo'] == 'yes') {
                                                get_logo(ot_get_option('logo'), ot_get_option('logo_margin'), ot_get_option('logo_size'), ot_get_option('logo_subline'));
                                            } else {
                                                get_logo($header_data['logo'], $header_data['logo_margin'], $header_data['logo_size'], $header_data['logo_subline']);
                                            }
                                            ?>

                                        </div>
                                        <?php if ($header_data['logo_center'] != 'yes') { ?>
                                            <div class="float_right ">

                                                <?php echo do_shortcode($header_data['logo_right']); ?>


                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ($header_data['below_enable'] == 'yes') { ?>
                                <div id="below-logo-bar" class="clearfix <?php echo $header_data['below_style'] ?> ">
                                    <div class="mid-page">
                                        <?php echo do_shortcode($header_data['below_content']); ?>
                                    </div>

                                </div>

                            <?php } ?>




                        <?php
                        if (!is_home() && !is_author()) {
                            if (!isset($meta_values['meta_breadcrumbs'][0])) {
                                $meta_values['meta_breadcrumbs'][0] = 'yes';
                            }
                            if ($meta_values['meta_breadcrumbs'][0] == 'yes') {
                                ?>
                                <div class="title_wrap-wrap">
                                    <div class="title_wrap row-fluid">
										<div class="shadow2">
										</div>
                                        <div class="shadow">
                                        </div>
                                        <div class="vert-shadow">
                                            <div class="vert-shadow-left"></div>
                                            <div class="vert-shadow-mid"></div>
                                            <div class="vert-shadow-right"></div>
                                        </div>
                                        <div class="mid-page">
                                            <div class="border">
                                                <div id="title_crumb">
                                                    <h1 class="heading1 entry-title">
                                                        <?php
                                                        if (is_tax() || is_category()) {
                                                            single_cat_title();
                                                        } elseif (is_tag()) {
                                                            single_tag_title();
                                                        } elseif (is_day()) {
                                                            the_time('l, F j, Y');
                                                        } elseif (is_month()) {
                                                            the_time('F Y');
                                                        } elseif (is_year()) {
                                                            the_time('Y');
                                                        }elseif (is_404()) {
                                                            _e('404 Error','code125');
                                                        }elseif(is_search()){ ?>
                                                        	<?php _e("Search Results for:", "code125"); ?> <?php echo esc_attr(get_search_query()); ?>
                                                      <?php  } else {
                                                            echo $post->post_title;
                                                        }
                                                        ?></h1>
                                                        
                                                    <?php
                                                    if(!is_single()){
                                                     if (function_exists('code125_breadcrumbs')) code125_breadcrumbs();
                                                    }else {
                                                    	?>
                                                    	<div class="next-navigation">
                                                    		
                                                    		
                                                    		<?php 
                                                    		$next_post = get_next_post();
                                                    		if (!empty( $next_post )): ?>
                                                    		<div class="next-post">
                                                    		  <a href="<?php echo get_permalink( $next_post->ID ); ?>"><span class="icon-right-open"></span></a>
                                                    		  </div>
                                                    		<?php endif; ?>
                                                    		 
                                                    		
                                                    		
                                                    		<?php 
                                                    		$next_post = get_previous_post();
                                                    		if (!empty( $next_post )): ?>
                                                    		<div class="prev-post"> 
                                                    		  <a href="<?php echo get_permalink( $next_post->ID ); ?>"><span class="icon-left-open"></span></a>
                                                    		  </div>
                                                    		<?php endif; ?>
                                                    	
                                                    	</div>
                                                    	<?php
                                                    } ?>

                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
            	</div>
            </header>
            
            <div id="floating-trigger"></div>
            <div class="gototop-wtap"><a id="gotop" href="#"><span class="icon-up-open"></span></a></div>
            
            <?php if (!is_page() && !is_home() ) { ?>
                <div id="container" class="container">

                <?php } ?>
                
                <?php } ?>
