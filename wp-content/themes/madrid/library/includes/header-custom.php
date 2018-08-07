<?php
//Adding the Open Graph in the Language Attributes
function add_opengraph_doctype( $output ) {
		 return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
add_filter('language_attributes', 'add_opengraph_doctype');

//Lets add Open Graph Meta Info

function insert_fb_in_head() {

	 global $post; 
	 
	 $seo = ot_get_option('seo');
	 if($seo != 'no'){
	 
	 ?>
	 
	 <link rel="author" href="<?php echo ot_get_option( 'google_plus' ); ?>">
	 
	 
	 <meta name="description" content="<?php if(is_home()){ echo ot_get_option('web_description') ;}elseif(is_category()){
	 ob_start();
	 single_cat_title();
	 $single_cat_title = ob_get_contents();
	 ob_end_clean();
	 $thisCat = get_term_by('name', $single_cat_title, 'category'); echo $thisCat->description; } else{ 
	 $meta_description = get_post_custom_values('meta_description', $post->ID); 
	 echo $meta_description[0];} ?>">
	 <meta name="url" content="<?php if( is_home() ) { echo home_url(); } else { the_permalink(); } ?>">
	 
	 <?php } ?>
	 
	 
	 <meta property="og:title" content="<?php if(is_home()) { bloginfo('name'); } elseif(is_category()) { echo single_cat_title();} elseif(is_author()) { $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author')); echo $curauth->display_name; } else { echo the_title(); } ?>" />
	 <meta property="og:description" content="<?php if(is_home()){ echo ot_get_option('web_description') ;}elseif(is_category()){
	 ob_start();
	 single_cat_title();
	 $single_cat_title = ob_get_contents();
	 ob_end_clean();
	 $thisCat = get_term_by('name', $single_cat_title, 'category'); echo $thisCat->description; } else{ 
	 $meta_description = get_post_custom_values('meta_description', $post->ID); 
	 echo $meta_description[0];} ?>" />
	 
	 <meta property="og:url" content="<?php if( is_home() ) { echo home_url(); } else { the_permalink(); } ?>" />
	 
	 
	 
	 
	 <?php if(is_single()){
	 	$id_link = get_post_thumbnail_id($post->ID);
	 
	 	$image_url = wp_get_attachment_image_src( $id_link, array(80,80));
	 	if(is_array($image_url)){
	 		$image_url_face = $image_url[0];
	 	}else{
	 		$image_url_face = ot_get_option( 'facebook_thumb' );
	 	}
	 	
	 	
	 }else{
	 	$image_url_face = ot_get_option( 'facebook_thumb' );
	 }
	  ?>
	 <meta property="og:image" content="<?php echo $image_url_face ?>" />
	 
	 <meta property="og:type" content="<?php if (is_single() || is_page()) { echo "article"; } else { echo "website";} ?>" />
	 <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
	 
	 <meta property="fb:app_id" content="<?php echo ot_get_option('facebook_ID'); ?>" />
	 
	 
	 
	<?php
	
	$skin= get_page_parameter('skin_default','',false);
	$skin_data = code125_get_skin($skin);
	
	 
	$primary_color=  $skin_data['primary_color'];
	
	if(isset( $_POST['primary_color']) ){
		$primary_color=$_POST['primary_color'];
	}	
	
	 
	 
	
	 
	 $secondary_color = $skin_data['secondary_color'] ;
	 $pure_dark = $skin_data['text_color'];
	 $pure_light = $skin_data['light_text_color'];
	 
	 
	 	$text_color = $skin_data['text_color'] ;
	 	$text_color2 = $skin_data['text2_color'] ;
	 	$text_color_op = $skin_data['light_text_color'] ;
	 	$text_color_op2 = $skin_data['light_text_color_hover'] ;
	 
	 
	 
	 
	 $GLOBALS['primary_color'] = $primary_color;
	 
	 $primary_color_2 = '#' . hexDarker(substr($primary_color,1), 20);
	 $primary_color__1 = '#' . hexLighter(substr($primary_color,1), 10);
	 
	 
	 
	$main_bg= format_background(  $skin_data['main_background'], '#fff'  ); 	 
	$body_bg= format_background(  $skin_data['body_background'], '#fff'  ); 
	
	
	 
	 
	 $color_1= $primary_color;
	 $color_0 = '#' . hexLighter(substr($color_1,1), 50);
	 $color_2 = '#' . hexDarker(substr($color_1,1), 5);
	 $color_3 = '#' . hexDarker(substr($color_1,1), 10);
	 $color_4 = '#' . hexDarker(substr($color_1,1), 20);
	 $primary_color__2 = '#' . hexLighter(substr($color_1,1), 15);
	 $color_rgb = hex2rgb($primary_color);
	 
	 ?>
	 
	 <style>
	 
	 body{
	 	<?php echo $main_bg ?>
	 }
	 
	 .website-wrap,
	 h3.title span.side-icon{
	 	<?php echo $body_bg ?>
	 }
	 
	 
	 
	  
	 			 
	    			      .bones_page_navi li.bpn-current,
	       
	       .shortcode_4col_posts li a.data-original:hover,
	        .element a.data-original:hover,
	        #filter li a:hover,
	           #filter li a.selected,
	             
	             .nav-buttons a.flex-active,.nav-buttons a:hover,
	             .liteAccordion .slide > h2.selected span,
	             .liteAccordion .slide > h2:hover span ,
	             ul.custom_tabs2 li.current span.a_text,
	             ul.custom_tabs2 li.current span.side-menu-icon,
	             ul.custom_tabs2 li.current a, 
	             input#preview_input,
	             h3.title span.title:after ,
	             
	             p.dark:hover,
	             
	              #topnav  li:hover,
	               #topnav li.show-menu-li,
	               #topnav li li li:hover,
	               #topnav li.current-menu-item,
	                #social_icons li.search.active,
	                #social_icons li.search:hover,
	                #social_icons li.search #top_search,
	                 .tabs li.active ,
	                  .tabs li:hover,
	                  p.shuffle-article a:hover,
	                  .top-menu-nav ul.top-menu-nav > li:hover,
	                  .top-menu-nav ul.top-menu-nav > li.current_page_item,
	                  p.thumb-cat:hover,
	                  span.list-icon:hover,
	                  p.social-share-count:hover,
	                   p.thumb-cat-3:hover,
	                    p.social-share-count-3:hover,
	                    
	                    .flexslider ol.flex-control-nav li a.flex-active,
	                    .thumb-like:hover p.post-like,
	                    .thumb-like-single:hover,
	                    .post-content ins,
	                    .review_comment,
	                    .progress-striped .bar ,
	                    #wp-calendar td#today,
	                    .gallery-item .wp-caption-text.gallery-caption,
	                    .pagination a,
	                    p.side_show,
	                    .lt-ie9 .hover_span,
	                    .lt-ie9 p.dark-mini,
	                    .lt-ie9 .hover_span_wrap a.hover_a,
	                    .flip-post .post-back-wrap ,
	                    .roll-link span:after,
	                    .like-button-wrap p,
	                    #submit,
	                    a.button span.text,.button-primary,input.button-primary,#submit,#mc_signup_submit,
	                    .wrap-icon,
	                    .tags a,
	                    .slides_4col li:hover .alpha-div ,
	                    .element:hover .alpha-div,
	                    ul#filter li:hover a,
	                    a.do-show-more-posts:hover span.hover,
	                    .service-column-wrap.style1 .color-icon,
	                    .thumb-wrap,
	                    .colored-mode,
	                    .large-icon-wrap,
	                    .navigation-shortcode.sidebar.top-menu-nav ul>li.current-menu-item,
	                    h3.title  .roll-link-html:hover span.hover,
	                    .shortcode_4col_posts ul.flex-direction-nav li:hover a,
	                    .slider_with_title.flexslider ul.flex-direction-nav li:hover a,
	                    .password-protected-form input[type=submit],
	                    .input-wrap span ,
	                    a#gotop,
	                    .full.top-menu-nav ul.menu-sc-nav>li:hover,
	                    .full.top-menu-nav ul.menu-sc-nav>li.current-menu-item,
	                    #below-logo-bar .default.top-menu-nav ul.menu-sc-nav>li.current-menu-item,
	                    #below-logo-bar .default.top-menu-nav ul.menu-sc-nav>li:hover,
	                    a.show-full-post:hover span.hover,
	                    .button_num_3_default{
	  	background-color:<?php echo $primary_color; ?>;
	  }
	  
	   ul.custom_tabs li.current a{
	  	border-top:2px solid <?php echo $primary_color; ?> ;
	  }
	  
	  #submit:hover,
	  a.button span.text:after,
	  .roll-link-html:hover span.hover{
	  	
	  	background-color:<?php echo $primary_color_2; ?>;
	  }
	  
	  .button_num_3_default:hover{
	  	
	  	background-color:<?php echo $primary_color__2; ?>;
	  }
	  
	  
	  .button_num_3_default{
	  	border: 1px solid <?php echo $primary_color_2; ?>;
	  }
	  
	  ::selection {
	  	background: <?php echo $primary_color; ?>;
	  }
	  ::-moz-selection {
	  	background: <?php echo $primary_color; ?>;
	  }
	  
	  .hover_span,
	  p.dark-mini,
	  .hover_span_wrap a.hover_a{
	  	background-color:rgba(<?php echo $color_rgb[0]; ?> , <?php echo $color_rgb[1]; ?> , <?php echo $color_rgb[2]; ?> , 0.8);
	  }
	  .footer .flickr img:hover{
	  	border-color:<?php echo $primary_color; ?> ;
	  }
	  .top-wide-nav{
	  	border-top:4px solid <?php echo $primary_color; ?> ;
	  }
	  
	  
	  
	  .blog-thumb-3:hover{
	  	border-left:5px solid <?php echo $primary_color; ?>;
	  }
	  
	  .call_an_action{
	  	border-left:10px solid <?php echo $primary_color; ?>;
	  }
	  
	  .top-menu-nav ul ul {
	  	border-top: 1px solid <?php echo $primary_color; ?>;
	  }
	  a,
	  .comment-author .time_class a,
	  .next_article a:hover,
	  ul.tweets li a,
	  ul.tweets li a:hover,
	  .custom_ul li:hover span,
	  ul.latest_news.comments a:hover,
	  .date-list p:hover,
	   .date-list a:hover,
	   p.cat-content:hover,
	   p.cat-content a:hover,
	   ul.meta-entry li p:hover,
	   ul.meta-entry li a:hover,
	   h2.blogtitle a:hover,
	   .rating_stars span,
	   .widget li a:hover,
	   .service-column-wrap.style3:hover .color-icon,
	   #below-logo-bar.light-mode .default.top-menu-nav ul.menu-sc-nav>li>a{
	  	color:<?php echo $primary_color; ?>;
	  }
	  
	  #ribbon{
	  	border-left: 20px solid <?php echo $primary_color; ?>;
	  	border-right: 20px solid <?php echo $primary_color; ?>;
	  	border-top: 20px solid <?php echo $primary_color; ?>;
	  }
	  
	  
	  <?php 
	  
	  
	  $color_0 = '#' . hexLighter(substr($primary_color,1), 10);
	  $color_2 = '#' . hexDarker(substr($primary_color,1), 5);
	  $color_3 = '#' . hexDarker(substr($primary_color,1), 10);
	  $color_4 = '#' . hexDarker(substr($primary_color,1), 20);
	  
	 /* $data ='.button_num_3_default{ background-color: '. $color_1.';
	    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, '. $color_1.'), color-stop(100%, '. $color_3.'));
	    background-image: -webkit-linear-gradient(top, '. $color_1.', '. $color_3.');
	    background-image: -moz-linear-gradient(top, '. $color_1.', '. $color_3.');
	    background-image: -ms-linear-gradient(top, '. $color_1.', '. $color_3.');
	    background-image: -o-linear-gradient(top, '. $color_1.', '. $color_3.');
	    background-image: linear-gradient(top, '. $color_1.', '. $color_3.');
	    border: 1px solid '. $color_4.';} .button_num_3_default:hover {background: '.$color_0.';}';
	    
	    echo $data;
	  */
	   ?>
	 
	  
	  a:hover{
	  	color:<?php echo $primary_color_2; ?>;
	  }
	 
	 /** Secondary Color **/
	 #social_icons,
	 .custom_tabs_wrap,
	 ul.custom_tabs li.current a,
	 h3.title span.title,
	  h3.title span.text ,
	  h3.title a.rss-icon,
	 .comment-reply-link,
	 .post-content textarea,textarea.element-block,
	 p.author_description,
	 .box-container,
	 .slides_4col li hgroup.data-title,
	 .element hgroup.data-title,
	 ul#filter li a,
	 .slider-bg-wrap,
	 .ul_2_table ul,
	  .slider_with_title,
	  #top-bar.light,
	  #below-logo-bar.light,
	  #floating-bar.light,
	  a.do-show-more-posts span.text,
	  
	  h3.title span.side-icon ,
	  h3.title .title-icon,
	  .toggle h3:hover,
	  .service-column-wrap.style5.flip-post .post-back .post-back-wrap,
	  #loginform input.element-block,
	  .gallery,
	  .ajax-post-wrap,
	  .product_meta {
	 	background-color: <?php echo $secondary_color ?>
	 }
	 
	 p.author_description span.arrow-left{
	 	border-right:10px solid <?php echo $secondary_color ?>;
	 }
	 p.author_description span.arrow-up{
	 	border-bottom:10px solid <?php echo $secondary_color ?>;
	 }
	 
	 
	 
	 /** Main text color **/
	 
	 body,
	 #social_icons a:hover,
	 .top-menu-nav ul.menu-sc-nav>li,
	 .top-menu-nav ul.menu-sc-nav>li> a,
	 #crumbs a:hover,
	 #crumbs a:hover:visited,
	 ul.meta-article-entry li:hover,
	 ul.meta-article-entry li:hover a,
	 ul.meta-article-entry li:hover a:hover,
	 ul.meta-article-entry li a:hover,
	 h3.title a,
	 ul.custom_tabs li a,
	 .comment a,
	 .comment .fn,
	 a.post-list-title,
	 ul.tweet_list li a,
	 h2.blogtitle a,
	 a.do-show-more-posts span.text,
	 .slides_4col li hgroup.data-title a,
	 .element hgroup.data-title a,
	 ul#filter li a,
	 .width_50_right a.author,
	 a.gray,
	 #top-bar.top-menu-nav.light ul.menu-sc-nav>li> a,
	 .review-content h4 a,
	 ul.custom_tabs2 li a,
	 .navigation-shortcode.sidebar.top-menu-nav ul li.current-menu-item ul li a,
	 .social-mini-icons-sh a,
	 .author_widget h3 a,
	 .author_widget h3,
	 .rev-slider-header h3, 
	 .rev-slider-content,
	 .wrap-post-list.flip-post ul.meta-article-entry li a,
	 .wrap-post-list.flip-post ul.meta-article-entry li p,
	 .wrap-post-list.flip-post ul.meta-article-entry li,
	 .wrap-post-list.flip-post  a.post-list-title,
	 .language-class,
	 .language-class a,
	 #social_icons .language-class a,
	 .toggle h3 a,
	 .toggle h3 span,
	 .toggle h3 a:hover,
	 .service-column-wrap.style5.flip-post .post-back-wrap a,
	 .mini-post .bg,
	 .top-menu-nav.sidebar ul.menu-sc-nav>li:hover a,
	 a.show-full-post span.text,
	 .tp_recent_tweets  ul li a ,
	 .colored-mode .element.account{
	 	color: <?php echo $text_color ?>;
	 }
	 
	 
	 .top-menu-nav ul li ul li a,
	 .top-menu-nav ul li ul li a:hover,
	 .top-menu-nav ul li ul li:hover,
	 .top-menu-nav ul li ul li a span{
	 	color: <?php echo $pure_dark ?> ;
	 }
	
	 
	 .service-column-wrap.style1:hover .color-icon,
	.dark-mode ,
	.social_box_count .count:hover,
	a#gotop:hover{
	 	background-color: <?php echo $text_color ?>;
	 }
	 
	#social_icons a,
	.top-menu-nav ul.menu-sc-nav>li:hover,
	.top-menu-nav ul.menu-sc-nav>li > a:hover,
	.top-menu-nav ul.menu-sc-nav>li:hover a,
	.top-menu-nav ul.menu-sc-nav>li.current-menu-item a,
	.comment a:hover,
	.comment,
	a.post-list-title:hover
	.wrap-post-list:hover a.post-list-title,
	ul.tweet_list li a:hover,
	h2.blogtitle a:hover ,
	.slides_4col li hgroup.data-title a:hover,
	.element hgroup.data-title a:hover,
	.width_50_right a.author:hover,
	a.gray:hover,
	.review-content h4 a:hover,
	.social-mini-icons-sh a:hover,
	.author_widget h3 a:hover,
	.wrap-post-list.flip-post ul.meta-article-entry li:hover a,
	.wrap-post-list.flip-post ul.meta-article-entry li:hover p,
	.wrap-post-list.flip-post ul.meta-article-entry li:hover,
	p.subline,
	.language-class:hover,
	.language-class a:hover,
	#social_icons .language-class a:hover,
	.service-column-wrap.style5.flip-post .post-back-wrap a:hover,
	.tp_recent_tweets  ul li a:hover{
		color: <?php echo $text_color2 ?>;
	}
	
	.roll-link-html span.hover,
	.flip-post a,
	.flip-post a:hover,.flip-post:hover a:hover,.flip-post:hover a,
	ul#filter li:hover a,
	ul#filter li a:hover,
	ul#filter li:hover a:hover,
	ul#filter li a.selected,
	.roll-link span:after,
	h3.title span.title:after,
	.wrap-icon,
	.slide_rest ul.meta-entry li p,.slide_rest ul.meta-entry li a,.slide_rest .post-like .like,.slide_rest .post-like .like:hover,.slide_rest ul.meta-entry li a:hover,
	.colored-mode .top-menu-nav ul.menu-sc-nav>li> a,
	
	.colored-mode,
	.full.top-menu-nav ul.menu-sc-nav>li:hover a,
	.full.top-menu-nav ul.menu-sc-nav>li.current-menu-item a{
		color: <?php echo $text_color_op ?>;
	}
	
	
	  /** Other Stylings **/
	 
	 
	 .footerbg{
	 	background-color: <?php echo  $skin_data['footer_bg_color'] ; ?>;
	 }
	 
	 .footer .flickr img{
	 	border-color: <?php echo  $skin_data['footer_bg_color'] ; ?>;
	 }
	 .top-menu-nav ul > li a{
	 	font-size:<?php echo $skin_data['top_menu_fsize'] ; ?>;
	 }
	 
	 
	 
	 body{
	 	font-size:<?php echo $skin_data['body_font_size']  ; ?>;
	 }
	 h2.blogtitle{
	 	font-size:<?php echo $skin_data['article_title_fsize']  ; ?>;
	 }
	 h3.title span,
	 h3.title{
	 	font-size:<?php echo   $skin_data['title_fsize'] ; ?>;
	 }
	 .widget h3.title span,
	 .widget h3.title{
	 	font-size:<?php echo  $skin_data['widget_title_fsize'] ; ?>;
	 }
	 #logo{
	 	font-size:<?php echo  $skin_data['logo_fsize'] ; ?>;
	 }
	 .width_50_right a.author{
	 	font-size:<?php echo  $skin_data['slider_title_fsize']; ?>;
	 }
	 
	 <?php if( $skin_data['heading_transform']=='normal'){  ?>
	 
	 .top-menu-nav ul>li a,
	 h3.title{
	 	text-transform:none;
	 }
	 
	 <?php } ?>
	 
	 <?php if( $skin_data['heading_weight']=='t300'){  ?>
	 
	 .top-menu-nav ul>li a,
	 h3.title,
	 h1, h2, h3 {
	 	font-weight:300 !important; 
	 }
	 
	 <?php }elseif ( $skin_data['heading_weight']=='t400') { ?>
	.top-menu-nav ul>li a,
	h3.title,
	h1, h2, h3 {
		font-weight:400 !important; 
	}
	
	<?php }elseif ( $skin_data['heading_weight']=='t700') { ?>
	.top-menu-nav ul>li a,
	h3.title,
	h1, h2, h3 {
		font-weight:700 !important; 
	}
	
	
	<?php } ?>
	
	<?php if( $skin_data['body_weight']=='t300'){  ?>
	 
	 body{
	 	font-weight:300 !important; 
	 }
	 
	 <?php }elseif ( $skin_data['body_weight']=='t400') { ?>
	body {
		font-weight:400 !important; 
	}
	
	<?php }elseif ( $skin_data['body_weight']=='t700') { ?>
	body{
		font-weight:700 !important; 
	}
	
	
	<?php } ?>
	
	
	 
	 
	 
	 <?php 
	 
	 $responsive = ot_get_option( 'responsive');
	 
	 	if($responsive !='no'){
	 ?>
		 @media (min-width: 1200px){
		 	.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-	bottom .container {
	 		width: 960px;
	 		}
	 		
	 	}
	 <?php }else{ ?>
	 
	 	.container, .navbar-static-top .container, .navbar-fixed-top .container, .navbar-fixed-bottom .container , .mid-page{
	 	width: 960px;
	 	}
	 	body{
	 		min-width:1020px;
	 	}
	 
	 	 
	 <?php } ?>
	 
	 <?php 
	 
	 	$categories_get = ot_get_option( 'tax_category', array() );
	 	 
	 	     if ($categories_get){
	 	         foreach ($categories_get as $category) { 
	 	         	
	 	         	if($category['category']!='' ){
	 	         	$tax_value = get_tax_by_type($category['post_type']);
	 	         	$cat_array = get_term($category['category'],$tax_value );
	 	         	
	 	         	$skin_data2 = code125_get_skin($category['skin_default']);
	 	         	
	 	         	
	 	         	update_option($tax_value .'_icon_' . $cat_array->term_id , $category['icon']);
	 	         	update_option($tax_value .'_color_' . $cat_array->term_id  , $skin_data2['primary_color']);
	 	         	update_option($tax_value .'_layout_' . $cat_array->term_id  , $category['layout']);
	 	         	
	 	         	
	 	         	$color_cat_rgb = hex2rgb($skin_data2['primary_color']);
	 	         	
	 	         	$class_name = $tax_value. '-' . $cat_array->term_id;
	 	         	?>
	 	         	.<?php echo $class_name; ?> p.dark-mini:hover,
	 	         	.lt-ie9 .<?php echo $class_name; ?> .hover_span,
	 	         	.lt-ie9 .<?php echo $class_name; ?> p.dark-mini,
	 	         	.lt-ie9 .<?php echo $class_name; ?> .hover_span_wrap a.hover_a,
	 	         	.flip-post.<?php echo $class_name; ?> .post-back-wrap,
	 	         	.<?php echo $class_name; ?>.element:hover .alpha-div,
	 	         	.slides_4col li.<?php echo $class_name; ?>:hover .alpha-div,
	 	         	.<?php echo $class_name; ?> .roll-link-html:hover span.hover,
	 	         	.<?php echo $class_name; ?> .wrap-icon,
	 	         	.<?php echo $class_name; ?>  h3.title  .roll-link-html:hover span.hover{
	 	         			background-color: <?php echo $skin_data2['primary_color'] ?>;       
	 	         	}
	 	         	
	 	         	           
	 	         	          
	 	         	          .<?php echo $class_name; ?> h2.blogtitle a:hover,
	 	         	          .<?php echo $class_name; ?> ul.meta-entry li p:hover,
	 	         	          .<?php echo $class_name; ?>  a:hover,
	 	         	          .<?php echo $class_name; ?>  .rating_stars span,
	 	         	          .<?php echo $class_name; ?> .wrap-post-list:hover a.post-list-title{
	 	         	          		color: <?php echo $skin_data2['primary_color'] ?>;       
	 	         	          }
	 	         	          
	 	         	          
	 	         	           .<?php echo $class_name; ?> .hover_span,
	 	         	           .<?php echo $class_name; ?> p.dark-mini,
	 	         	           .<?php echo $class_name; ?> .hover_span_wrap a.hover_a{
	 	         	          	background-color:rgba(<?php echo $color_cat_rgb[0]; ?> , <?php echo $color_cat_rgb[1]; ?> , <?php echo $color_cat_rgb[2]; ?> , 0.8);
	 	         	          }
	 	         	          
	 	         	          .<?php echo $class_name; ?> p.dark-mini a:hover{
	 	         	          	color: white;
	 	         	          }			
	 	         	<?php
	 	         	
	 	         	}
	 	         }
	 	      }
	 	
	 $custom_icons = ot_get_option('custom_icons', array());
	       
	    $sizes= array('16','24','32','48','64','128','256');
	        if ($custom_icons) {
	            foreach ($custom_icons as $custom_icon) {
	            	$link_id = get_attachment_id_from_src($custom_icon['icon']);
	            	foreach ($sizes as $size) {
						if(isset($custom_icon['i'.$size])){
						if($custom_icon['i'.$size][0] == 'yes'){
						$image_url =  wp_get_attachment_image_src($link_id, $size . 'x' . $size);
						?>
						.xcon-<?php echo $size ?>-<?php echo $custom_icon['title'] ?>{
							background: url('<?php echo $image_url[0] ?>') no-repeat center center;
							width: <?php echo $size ?>px;
							height: <?php echo $size ?>px;
							display: block;
							float: left;
						}
						@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) { 
						    .xcon-<?php echo $size ?>-<?php echo $custom_icon['title'] ?>{
						    	background-size: 100% 100%%;
						    }
						}
						<?php
						
						}
					}
					}
	            	
	                
	            }
	        }
	 if($skin_data['fadein_elements'] =='yes'){ ?>
	 
	 .hideme{
	  	opacity: 0;
	  }
	 
	<?php
	 }
	?>
	 
	 
	 
	 
	 #topnav li,h1,h2,h3,
	 p.dark,
	 
	 
	 .comment-author .fn a,
	 .social_box_count p,
	 
	 #top_search select#cat,
	 .next_article a,
	 ul.popular a.entrytitle,
	 h3.title,
	   	#wp-calendar,
	   	.twitter-author,
	   	ul.custom_tabs li a,
	   	p.social-share-count,
	   	 p.cat-content,
	   	  p.thumb-cat,
	   	   p.social-share-count-3,
	   	   .width_50_right a.author,
	   	   
	   	   a.post_title_thumb,
	   	   .shortcode_4col_posts li a.data-original,
	   	    .element a.data-original,
	   	    .thumb-like p.post-like a,
	   	    .thumb-like-single,
	   	    .bones_page_navi li,
	   	    .rating_table td p,
	   	    
	   	    ul.footer-nav li,
	   	    .widget .latest_news h6 a,
	   	    .top-wide-nav .today p,
	   	    .featured-post p.dark-mini,
	   	    #logo,
	   	    .flip-post a,
	   	    .compare td,
	   	    p.item-title,
	   	    .top-menu-nav ul > li a,
	   	    .share-button,
	   	    .like-button-wrap p,
	   	    a.button,
	   	    #submit,
	   	    .ul_2_table ul li ,
	   	    .service-column-wrap h4{
	 	
	 font-family: <?php echo $skin_data['heading_font'] ;?>,'Droid Arabic Kufi', Helvetica, Georgia, serif;
	 font-weight:normal;
	 }
	 
	 body,
	 .comments_list li a,
	 .top-menu-nav ul li ul li a,
	 #topnav ul li ul li a,
	 .latest_news h6 a,
	 p.thumb-cat-3,
	 ul.newsticker,
	 .tabs li a,
	 .title_wrap .border h1,
	 .slides-breaking li a,
	 .top-menu-nav ul.newsticker a,
	 .navigation-shortcode.sidebar.top-menu-nav ul > li a,
	 .rev-slider-header,
	 .wrap-post-list.flip-post ul.meta-article-entry li a,
	 .wrap-post-list.flip-post ul.meta-article-entry li p,
	 .wrap-post-list.flip-post ul.meta-article-entry li,
	 .wrap-post-list.flip-post a.post-list-title,
	 .service-column-wrap.style2 h4,
	 .service-column-wrap.style5.flip-post .post-back .post-back-wrap a ,
	 p.breaking-title{
	 	font-family: <?php echo $skin_data['body_font'] ;?>,'Droid Arabic Kufi', Helvetica, Georgia, serif;
	 }
	 
	 <?php echo ot_get_option( 'custom_css' ); ?>
	 
	 <?php echo $skin_data['custom_css'] ?>
	 </style>
	 	
	 <!-- drop Google Analytics Here -->
	 
	 <?php echo ot_get_option( 'google_analytics' );  ?>
	 <!-- end analytics -->
	 
	 
	 <?php
	 
}
add_action( 'wp_head', 'insert_fb_in_head', 229 );


function insert_script_in_footer() {

$skin= get_page_parameter('skin_default','',false);
$skin_data = code125_get_skin($skin);

if($skin_data['fadein_elements'] =='yes'){

?>
<script >
	jQuery(document).ready(function ($) {
	$('.post-content > .mid-page > div').each( function(i){
	    if(!$(this).hasClass('row-fluid')){
	    	$(this).addClass('hideme');
	    }
	    
	    
	});
	$('.post-content > div').each( function(i){
	    if(!$(this).hasClass('mid-page')){
	    	$(this).addClass('hideme');
	    }
	    
	    
	});
	/* Check the location of each desired element */
	$('.hideme').each( function(i){
	    var bottom_of_object = $(this).offset().top ;
	    var bottom_of_window = $(window).scrollTop() + $(window).height();
	    
	    /* If the object is completely visible in the window, fade it it */
	    if( bottom_of_window > bottom_of_object ){
	        
	        $(this).delay(100).animate({'opacity':'1'},500);
	            
	    }
	    
	});
	$(window).scroll( function(){
	   
	       /* Check the location of each desired element */
	       $('.hideme').each( function(i){
	           
	           var bottom_of_object = $(this).offset().top ;
	           var bottom_of_window = $(window).scrollTop() + $(window).height();
	           
	           /* If the object is completely visible in the window, fade it it */
	           if( bottom_of_window > bottom_of_object ){
	               
	               $(this).delay(500).animate({'opacity':'1'},500);
	                   
	           }
	           
	       }); 
	   
	   });
	   });
	   
	   <?php echo ot_get_option( 'custom_js' ); ?>
	   <?php echo $skin_data['custom_js'] ?>
	   </script>
	   <?php
	   
	   }
}
add_action( 'wp_footer', 'insert_script_in_footer' );

?>