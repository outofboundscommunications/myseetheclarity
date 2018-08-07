<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', '_custom_meta_boxes' );

/**
 * Meta Boxes demo code.
 *
 * You can find all the available option types
 * in demo-theme-options.php.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_meta_boxes() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
   
   $sidebars_new = ot_get_option( 'sidebars', array() );
   
  $sidebars= array(
  	array(
  		'label' => 'Default',
  		'value' => 'default'
  	),
  	array(
  		'label' => 'Primary Sidebar',
  		'value' => 'primary'
  	),
  	array(
  		'label' => 'Post Sidebar',
  		'value' => 'post'
  	),
  	array(
  		'label' => 'Page Sidebar',
  		'value' => 'page'
  	)
  );

  $all_post_types = array('post', 'page','portfolio','team','faq','testimonial' );  
  $post_types = array('post', 'page','team','faq','testimonial' );
  $post_like_types = array('post', 'portfolio');
  $post_like_types2 = array('post', 'portfolio','team');
  
  
  
  $skins = array(
          array(
              'label' => 'Default',
              'value' => ''
          )
      );
  
     $query = new WP_Query( array( 'post_type' => 'skin', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'publish' ) );
     
     /* has posts */
     if ( $query->have_posts() ) {
       while ( $query->have_posts() ) {
         $query->the_post();
         $array =  array(
                 'label' => get_the_title(),
                 'value' => get_the_ID()
             );
         array_push($skins, $array);
         
       
     } 
     }
     wp_reset_postdata();
  
  
  $custom_posts = ot_get_option('custom_posts', array());
  
  if ($custom_posts) {
      foreach ($custom_posts as $custom_post) {
      	$post_types[] = $custom_post['slug'];
      	$post_like_types[] = $custom_post['slug'];
      	$all_post_types[] = $custom_post['slug'];
      	$all_post_types2[] = $custom_post['slug'];
      }
   }
  
   include(TEMPLATEPATH . '/library/includes/admin/fonts.php');
   
       $google_fonts = get_google_fonts();
   
       foreach ($google_fonts as $font ) {
           $font = array(
               'label' => $font ,
               'value' => $font 
           );
   
   
           array_push($google_fonts, $font);
       }
   		
   		$headers = array(
   		    );
   		
   		    $headers2 = array(
   		        array(
   		            'label' => 'Default',
   		            'value' => ''
   		        )
   		    );
   
   		$query = new WP_Query( array( 'post_type' => 'header', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'publish' ) );
   		
   		/* has posts */
   		if ( $query->have_posts() ) {
   		  while ( $query->have_posts() ) {
   		    $query->the_post();
   		    $array =  array(
   		            'label' => get_the_title(),
   		            'value' => get_the_ID()
   		        );
   		    array_push($headers, $array);
   		    array_push($headers2, $array);
   		    
   		  
   		} 
   		}
   		wp_reset_postdata();
   		
       
   
       
   
   
   $footers_templates = ot_get_option( 'footer_templates', array() );
   
    $footers= array(
    	
    );
    
    if ($footers_templates){
    foreach ($footers_templates as $header ) {
    	$icon = array(
    		'label' => $header['title'],
    	    'value' => $header['slug']
    	);
    	array_push($footers, $icon);
    }
    }
   
   
   
  
  foreach ($sidebars_new as $sidebar_new) {
  	$array=array(
  		'label' => $sidebar_new['title'],
  		'value' => $sidebar_new['slug']
  	);
  	array_push($sidebars, $array);
  	
  }
  
  include(TEMPLATEPATH . '/library/includes/admin/icons.php'); 
  $icons =  get_all_icons();
  
  asort($icons);
  $new_icons= array();
  foreach ($icons as $icon ) {
  	$icon = array(
  		'label' => substr($icon, 5),
  	    'value' => $icon
  	);
  	array_push($new_icons, $icon);
  }
  
  $article_meta_array = array();
  $counter = 1;
  
  
  
  
  
  
  
   
   
  $general = array(
    'id'          => 'general',
    'title'       => 'General Settings',
    'desc'        => '',
    'pages'       => $post_types, 
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Layout Style',
        'id'          => 'layout',
        'type'        => 'select',
        'desc'        => 'Choose Your Category Page Layout.',
        'choices'     => array(
          array (
            'label'       => 'Left Sidebar',
            'value'       => 'left'
          ),
          array (
            'label'       => 'Right Sidebar',
            'value'       => 'right'
          ),
          array (
            'label'       => 'Full Width',
            'value'       => 'full'
          )
        ),
        'std'         => 'right',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
      ),
      
      array(
        'label'       => 'Sidebar',
        'id'          => 'sidebar',
        'type'        => 'select',
        'desc'        => 'Select the Page sidebar.',
        'choices'     => $sidebars,
        'std'         => 'default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	)
  );
  $portfolio = array(
    'id'          => 'portfolio',
    'title'       => 'General Settings',
    'desc'        => '',
    'pages'       => array( 'portfolio'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Layout',
        'id'          => 'meta_portfolio_layout',
        'type'        => 'select',
        'desc'        => 'Choose your Layout, Default: Image as main, Text as sidebar.',
        'choices'     => array(
          array(
            'label'       => 'Image as main, content as sidebar',
            'value'       => 'sidebar'
          ),
          array(
            'label'       => 'Image Then content',
            'value'       => 'default'
          )
        ),
        'std'         => 'sidebar',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	)
  );
  
  
  
  
  $stylings = array(
    'id'          => 'meta_styling',
    'title'       => 'Styling Settings',
    'desc'        => '',
    'pages'       => $all_post_types,
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
          'label' => 'Choose The default Skin',
          'id' => 'skin_default',
          'type' => 'select',
          'desc' => 'Choose The Skin.',
          'choices' => $skins,
          'std' => '',
          'rows' => '',
          'post_type' => '',
          'taxonomy' => '',
          'class' => ''
      ),
      array(
          'label' => 'RTL',
          'id' => 'rtl',
          'type' => 'select',
          'desc' => 'Choose Yes to enable RTL in your website.',
          'choices' => array(
              array(
                  'label' => 'Default',
                  'value' => ''
              ),
              array(
                  'label' => 'Yes',
                  'value' => 'yes'
              ),
              array(
                  'label' => 'No',
                  'value' => 'no'
              )
          ),
          'std' => '',
          'rows' => '',
          'post_type' => '',
          'taxonomy' => '',
          'class' => '',
      )
      
      
  	)
  );
  
  
  $testimonial = array(
    'id'          => 'testimonial',
    'title'       => 'Settings',
    'desc'        => '',
    'pages'       => array( 'testimonial'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Author Name',
        'id'          => 'author_name',
        'type'        => 'text',
        'desc'        => 'Add the author name.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Author Link',
        'id'          => 'author_link',
        'type'        => 'text',
        'desc'        => 'Add the author link.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
   	)
  );
  
  
  $meta_gallery_slider = array(
    'id'          => 'meta_gallery_slider',
    'title'       => 'Post Format Settings',
    'desc'        => '',
    'pages'       => $post_like_types,
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Post Format Slides => Gallery',
        'id'          => 'meta_slides_post_type',
        'type'        => 'list-item',
        'desc'        => 'Add Slides to your page.',
        'settings'    => array(
          array(
            'label'       => 'Upload',
            'id'          => 'image',
            'type'        => 'upload',
            'desc'        => 'The Main image for the slide "At least to have width 760px".',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
        ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Video ID',
        'id'          => 'meta_attachment',
        'type'        => 'text',
        'desc'        => 'Add ID related the the Video Format.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Video Type',
        'id'          => 'meta_video_type',
        'type'        => 'select',
        'desc'        => 'Choose the video type in case of video posts, then enter the video id for youtube,dailymotion and vimeo',
        'choices'     => array(
          array(
            'label'       => 'Youtube',
            'value'       => 'youtube'
          ),
          array(
            'label'       => 'Dailymotion',
            'value'       => 'dailymotion'
          ),
          array(
            'label'       => 'Vimeo',
            'value'       => 'vimeo'
          )
        ),
        'std'         => 'vimeo',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Audio Link or Soundcloud id',
        'id'          => 'meta_audio_attachment',
        'type'        => 'text',
        'desc'        => 'Add Audio Link or Soundcloud id.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Audio Type',
        'id'          => 'meta_audio_type',
        'type'        => 'select',
        'desc'        => 'Choose the video type in case of video posts, then enter the video id for youtube,dailymotion and vimeo',
        'choices'     => array(
          array(
            'label'       => 'Audio file',
            'value'       => 'audio'
          ),
          array(
            'label'       => 'Sound Cloud',
            'value'       => 'soundcloud'
          )
        ),
        'std'         => 'soundcloud',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	
  	)
  );
  
  $meta_metro = array(
    'id'          => 'meta_metro',
    'title'       => 'Metro & Category Color Settings',
    'desc'        => '',
    'pages'       =>  $post_like_types2,
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
    array(
      'label'       => 'Main Category to follow',
      'id'          => 'cat_id',
      'type'        => 'select',
      'desc'        => 'Add the category ID to follow in Portfolio Posts.',
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    ),  
  	array(
  	  'label'       => 'Metro View',
  	  'id'          => 'meta_metro',
  	  'type'        => 'select',
  	  'desc'        => 'Choose the Metro View of the Flip Card If you choosed Metro Elements.',
  	  'choices'     => array(
  	    array(
  	      'label'       => 'Photo',
  	      'value'       => 'photo'
  	    ),
  	    array(
  	      'label'       => 'Details',
  	      'value'       => 'details'
  	    )
  	  ),
  	  'std'         => 'photo',
  	  'rows'        => '',
  	  'post_type'   => '',
  	  'taxonomy'    => '',
  	  'class'       => ''
  	),
  	array(
  	  'label'       => 'Metro View Size',
  	  'id'          => 'meta_metro_size',
  	  'type'        => 'select',
  	  'desc'        => 'Choose the Metro size of the element View.',
  	  'choices'     => array(
  	    array(
  	      'label'       => 'Large',
  	      'value'       => 'large'
  	    ),
  	    array(
  	      'label'       => 'Medium',
  	      'value'       => 'medium'
  	    ),
  	    array(
  	      'label'       => 'Wide',
  	      'value'       => 'wide'
  	    ),
  	    array(
  	      'label'       => 'Tall',
  	      'value'       => 'tall'
  	    )
  	  ),
  	  'std'         => 'medium',
  	  'rows'        => '',
  	  'post_type'   => '',
  	  'taxonomy'    => '',
  	  'class'       => ''
  	)
  	)
  );


$team = array(
  'id'          => 'meta_team',
  'title'       => 'Team Member Social Settings',
  'desc'        => '',
  'pages'       => array( 'team'),
  'context'     => 'normal',
  'priority'    => 'high',
  'fields'      => array(
    array(
      'label'       => 'Social Icons',
      'id'          => 'social_icons',
      'type'        => 'list-item',
      'desc'        => 'Add Social Icons',
      'settings'    => array(
        array(
          'label'       => 'Link',
          'id'          => 'link',
          'type'        => 'text',
          'desc'        => 'Your Social Link',
          'choices'     => '',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => ''
        ),
        array(
          'label'       => 'Icon',
          'id'          => 'icon',
          'type'        => 'select',
          'desc'        => 'Select Link Icon, Default facebook',
          'choices'     => $new_icons,
          'std'         => 'link',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => ''
        ),
        array(
          'label'       => 'Type',
          'id'          => 'type',
          'type'        => 'select',
          'desc'        => 'Select Link Type, Default Link',
          'choices'     => array(
            array(
              'label'       => 'Link',
              'value'       => 'link'
            ),
            array(
              'label'       => 'Email',
              'value'       => 'email'
            )
          ),
          'std'         => 'link',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => ''
        ) 
        
      ),
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    )
		)
);
  
    
  
  
  $slides_type = array(
    'id'          => 'slider',
    'title'       => 'Slider Settings',
    'desc'        => '',
    'pages'       => array( 'slides'),
    'context'     => 'side',
    'priority'    => 'low',
    'fields'      => array(
          array(
            'label'       => 'Button Text',
            'id'          => 'slides_button_text',
            'type'        => 'text',
            'desc'        => 'Add the text for the button.',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'label'       => 'Button link',
            'id'          => 'slides_button_link',
            'type'        => 'text',
            'desc'        => 'Add the link for the button, leave blank to remove the button.',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          ),
          array(
            'label'       => 'Icon link',
            'id'          => 'slides_icon',
            'type'        => 'select',
            'desc'        => 'Select Link Icon, Default none',
            'choices'     => $new_icons,
            'std'         => 'none',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
          )
  	)
  );
  
  
  $layout_builder2 = array(
    'id'          => 'meta_layout_bread',
    'title'       => 'Breadcrumbs Option',
    'desc'        => '',
    'pages'       => array( 'page'),
    'context'     => 'normal',
    'priority'    => 'low',
    'fields'      => array(
    
    array(
      'label'       => 'Show Title/breadcrumbs',
      'id'          => 'meta_breadcrumbs',
      'type'        => 'select',
      'desc'        => 'Choose Yes/No to to Show Title and breadcrumbs, Default: Yes.',
      'choices'     => array(
        array (
          'label'       => 'Yes',
          'value'       => 'yes'
        ),
        	array (
        	  'label'       => 'No',
        	  'value'       => 'no'
        	)
      ),
      'std'         => 'yes',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    )
    )
  );
  
  
   $slider_video = array(
    'id'          => 'meta_slider_video',
    'title'       => 'Slide Settings',
    'desc'        => '',
    'pages'       => array( 'slides'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Slide Type',
        'id'          => 'meta_slide_type',
        'type'        => 'select',
        'desc'        => 'Choose the slide type',
        'choices'     => array(
          array(
            'label'       => '1- Use Featured Image as a background and the title and content as the box',
            'value'       => 'type_1'
          ),
          array(
            'label'       => '2- Use video fields as the source for the slide',
            'value'       => 'type_2'
          ),
          array(
            'label'       => '3- Get the slide content from a post, Choose it from the dropdown below',
            'value'       => 'type_3'
          ),
          array(
            'label'       => '4- Get the slide content from a portfolio item, Choose it from the dropdown below',
            'value'       => 'type_4'
          ),
          array(
            'label'       => '5- Get the slide content from a team member, Choose it from the dropdown below',
            'value'       => 'type_4'
          )
        ),
        'std'         => 'type_1',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Choose the post',
        'id'          => 'meta_slide_post',
        'type'        => 'post-select',
        'desc'        => 'Choose the Post to display its content as the slide.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Choose the portfolio item',
        'id'          => 'meta_portfolio_post',
        'type'        => 'custom-post-type-select',
        'desc'        => 'Choose the Portfolio item to display its content as the slide.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => 'portfolio',
        'taxonomy'    => '',
        'class'       => ''
      ),
     array(
       'label'       => 'Choose the team member',
       'id'          => 'meta_team_post',
       'type'        => 'custom-post-type-select',
       'desc'        => 'Choose the team member to display its content as the slide.',
       'std'         => '',
       'rows'        => '',
       'post_type'   => 'team',
       'taxonomy'    => '',
       'class'       => ''
     ), 
      array(
        'label'       => 'Video ID',
        'id'          => 'meta_slide_video_link',
        'type'        => 'text',
        'desc'        => 'Add the ID of the video.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'label'       => 'Video Type',
        'id'          => 'meta_video_type',
        'type'        => 'select',
        'desc'        => 'Choose the video type in case of video posts, then enter the video id for youtube,dailymotion and vimeo',
        'choices'     => array(
          array(
            'label'       => 'Youtube',
            'value'       => 'youtube'
          ),
          array(
            'label'       => 'Dailymotion',
            'value'       => 'dailymotion'
          ),
          array(
            'label'       => 'Vimeo',
            'value'       => 'vimeo'
          )
        ),
        'std'         => 'youtube',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	)
  );
  
  
  
  $meta_description = array(
    'id'          => 'meta_description_id',
    'title'       => 'Page Description',
    'desc'        => '',
    'pages'       => array(  'page' , 'post','portfolio','team','faq','testimonial'),
    'context'     => 'normal',
    'priority'    => 'high',
    'fields'      => array(
      array(
        'label'       => 'Description',
        'id'          => 'meta_description',
        'type'        => 'textarea-simple',
        'desc'        => 'This Description will be used in facebook share and google search results.',
        'std'         => '',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      )
  	)
  );
  
  
  $review = array(
    'id'          => 'meta_review',
    'title'       => 'Review Options',
    'desc'        => '',
    'pages'       => $post_like_types,
    'context'     => 'normal',
    'priority'    => 'low',
    'fields'      => array(
    array(
      'label'       => 'Enable Review Box',
      'id'          => 'meta_use_review',
      'type'        => 'select',
      'desc'        => 'Use the Review Box in this page ?,Default: No.',
      'choices'     => array(
        array (
          'label'       => 'Yes',
          'value'       => 'yes'
        ),
       	array (
       	  'label'       => 'No',
       	  'value'       => 'no'
       	)
      ),
      'std'         => 'no',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    ),
   
    array(
      'label'       => 'Reviews',
      'id'          => 'meta_reviews',
      'type'        => 'list-item',
      'desc'        => 'Add Reviews to your post.',
      'settings'    => array(
        array(
          'label'       => 'Rating Value',
          'id'          => 'rating',
          'type'        => 'text',
          'desc'        => 'Add the rating Value From 0 to 100.',
          'std'         => '100',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => ''
        )
        
      ),
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    ),
    array(
      'label'       => 'Rating Comment',
      'id'          => 'meta_review_comment',
      'type'        => 'textarea-simple',
      'desc'        => 'Comment about the Product you are reviewing.',
      'std'         => '',
      'rows'        => '5',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    ),
    array(
      'label'       => 'Review Type',
      'id'          => 'meta_review_type',
      'type'        => 'select',
      'desc'        => 'Select to Type of the review in this article?, Default: Stars.',
      'choices'     => array(
        array (
          'label'       => 'Stars',
          'value'       => 'stars'
        ),
       	array (
       	  'label'       => 'Percentage',
       	  'value'       => 'percentage'
       	),
       	array (
       	   'label'       => 'Points',
       	   'value'       => 'points'
        )
      ),
      'std'         => 'stars',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    ),
    array(
      'label'       => 'Show Default Review Box',
      'id'          => 'meta_show_review',
      'type'        => 'select',
      'desc'        => 'Select to Show the default Review Box in this article?, Turn this off to add the Review Widget Default: No.',
      'choices'     => array(
        array (
          'label'       => 'Yes',
          'value'       => 'yes'
        ),
       	array (
       	  'label'       => 'No',
       	  'value'       => 'no'
       	)
      ),
      'std'         => 'no',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => ''
    ))
    ,
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
	
  
);



$meta_header = array(
    'id'          => 'meta_header',
    'title'       => 'Header Options',
    'desc'        => '',
    'pages'       => array('header'),
    'context'     => 'normal',
    'priority'    => 'low',
    'fields'      => array(
    array(
        'label' => 'Header Style, Default: Full Width',
        'id' => 'header-style',
        'type' => 'select',
        'desc' => 'Select Header Style.',
        'choices' => array(
            array(
                'label' => 'Full Width',
                'value' => 'full'
            ),
            array(
                'label' => 'Contained',
                'value' => 'contained'
            )
        ),
        'std' => 'full',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Use Custom Background for header, Default: No',
        'id' => 'use_background',
        'type' => 'select',
        'desc' => 'Use Custom Background for header.',
        'choices' => array(
            array(
                'label' => 'Yes',
                'value' => 'yes'
            ),
            array(
                'label' => 'No',
                'value' => 'no'
            )
        ),
        'std' => 'no',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
   
    array(
        'label' => 'Header Background',
        'id' => 'background',
        'type' => 'background',
        'desc' => 'Upload the background pattern you want for the header',
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => ''
    ),
    array(
        'label' => 'Header Background Alpha , Default: No Alpha',
        'id' => 'background_alpha',
        'type' => 'select',
        'desc' => 'Background Alpha for header.',
        'choices' => array(
            array(
                'label' => 'No Alpha',
                'value' => 'no'
            ),
            array(
                'label' => 'Alpha 90',
                'value' => '90'
            ),
            array(
                'label' => 'Alpha 80',
                'value' => '80'
            ),
            array(
                'label' => 'Alpha 70',
                'value' => '70'
            ),
            array(
                'label' => 'Alpha 60',
                'value' => '60'
            ),
            array(
                'label' => 'Alpha 50',
                'value' => '50'
            ),
            array(
                'label' => 'Alpha 40',
                'value' => '40'
            ),
            array(
                'label' => 'Alpha 30',
                'value' => '30'
            ),
            array(
                'label' => 'Alpha 20',
                'value' => '20'
            ),
            array(
                'label' => 'Alpha 10',
                'value' => '10'
            )
        ),
        'std' => 'light',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Background Style for header, Default: Light',
        'id' => 'background_style',
        'type' => 'select',
        'desc' => 'Background Style for header.',
        'choices' => array(
            array(
                'label' => 'Light',
                'value' => 'light-mode'
            ),
            array(
                'label' => 'Dark',
                'value' => 'dark-mode'
            )
        ),
        'std' => 'light',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Use Default Logo Settings',
        'id' => 'use_logo',
        'type' => 'select',
        'desc' => 'Use Default Logo Settings, Default: Yes, If no Upload the new data below',
        'choices' => array(
            array(
                'label' => 'Yes',
                'value' => 'yes'
            ),
            array(
                'label' => 'No',
                'value' => 'no'
            )
        ),
        'std' => 'yes',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Main Logo',
        'id' => 'logo',
        'type' => 'upload',
        'desc' => 'Upload the main logo for your website.',
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => ''
    ),
    array(
        'label' => 'Logo center',
        'id' => 'logo_center',
        'type' => 'select',
        'desc' => 'Make the logo centered in the area it contained. "This will disable the right content", Default No',
        'choices' => array(
            array(
                'label' => 'Yes',
                'value' => 'yes'
            ),
            array(
                'label' => 'No',
                'value' => 'no'
            )
        ),
        'std' => 'no',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Logo Size',
        'id' => 'logo_size',
        'type' => 'select',
        'desc' => 'Choose the logo size, Default Height 30',
        'choices' => array(
            array(
                'label' => 'Height 20',
                'value' => 'height_20'
            ),
            array(
                'label' => 'Height 30',
                'value' => 'height_30'
            ),
            array(
                'label' => 'Height 40',
                'value' => 'height_40'
            ),
            array(
                'label' => 'Height 50',
                'value' => 'height_50'
            ),
            array(
                'label' => 'Height 60',
                'value' => 'height_60'
            ),
            array(
                'label' => 'Height 70',
                'value' => 'height_70'
            ),
            array(
                'label' => 'Height 80',
                'value' => 'height_80'
            ),
            array(
                'label' => 'Height 90',
                'value' => 'height_90'
            ),
            array(
                'label' => 'Height 100',
                'value' => 'height_100'
            ),
            array(
                'label' => 'Full Size',
                'value' => 'full'
            )
        ),
        'std' => 'height_30',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Logo Subline',
        'id' => 'logo_subline',
        'type' => 'text',
        'desc' => 'Add logo subline text or leave it and it wont show.',
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => ''
    ),
    array(
        'label' => 'Main Logo Top Margin',
        'id' => 'logo_margin',
        'type' => 'text',
        'desc' => 'Top Margin for the logo for your website, Default:0px.',
        'std' => '0px',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => ''
    ),
    array(
        'label' => 'Content Beside Main Logo',
        'id' => 'logo_right',
        'type' => 'textarea',
        'desc' => 'Add the content, you can use shortcodes.',
        'std' => '[social_bar][menu location="main-nav" style="default"]',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
            'label' => '-- Announcment Bar Enable',
            'id' => 'announcment_enable',
            'type' => 'select',
            'desc' => 'Enable the Announcment Bar, Default No',
            'choices' => array(
                array(
                    'label' => 'Yes',
                    'value' => 'yes'
                ),
                array(
                    'label' => 'No',
                    'value' => 'no'
                )
            ),
            'std' => 'no',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
        ),
        array(
            'label' => 'Announcment Bar style',
            'id' => 'announcment_style',
            'type' => 'select',
            'desc' => 'Choose the top Bar style, Default light',
            'choices' => array(
                array(
                    'label' => 'Light',
                    'value' => 'light-mode'
                ),
                array(
                    'label' => 'Dark',
                    'value' => 'dark-mode'
                ),
                array(
                    'label' => 'Colored "default page color"',
                    'value' => 'colored-mode'
                ),
                array(
        'label' => 'Custom  "You can use the shortcodes wide_section,section for background"',
        'value' => 'custom'
    ),
            ),
            'std' => 'colored-mode',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
        ),
        array(
            'label' => 'Announcment Bar content',
            'id' => 'announcment_content',
            'type' => 'textarea',
            'desc' => 'Add the content, you can use shortcodes. and [float_left]Content[/float_left] and [float_right]Content[/float_right]',
            'std' => '',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'class' => '',
        ),
    array(
        'label' => '-- Top Bar Enable',
        'id' => 'top_enable',
        'type' => 'select',
        'desc' => 'Enable the top Bar, Default No',
        'choices' => array(
            array(
                'label' => 'Yes',
                'value' => 'yes'
            ),
            array(
                'label' => 'No',
                'value' => 'no'
            )
        ),
        'std' => 'no',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Top Bar style',
        'id' => 'top_style',
        'type' => 'select',
        'desc' => 'Choose the top Bar style, Default light',
        'choices' => array(
            array(
                'label' => 'Light',
                'value' => 'light-mode'
            ),
            array(
                'label' => 'Dark',
                'value' => 'dark-mode'
            ),
            array(
                'label' => 'Colored "default page color"',
                'value' => 'colored-mode'
            ),
            array(
    'label' => 'Custom  "You can use the shortcodes wide_section,section for background"',
    'value' => 'custom'
),
        ),
        'std' => 'light',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Top Bar content',
        'id' => 'top_content',
        'type' => 'textarea',
        'desc' => 'Add the content, you can use shortcodes. and [float_left]Content[/float_left] and [float_right]Content[/float_right]',
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => '-- Bar Below the logo Enable',
        'id' => 'below_enable',
        'type' => 'select',
        'desc' => 'Enable bar Below the logo , Default No',
        'choices' => array(
            array(
                'label' => 'Yes',
                'value' => 'yes'
            ),
            array(
                'label' => 'No',
                'value' => 'no'
            )
        ),
        'std' => 'no',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Below Logo style',
        'id' => 'below_style',
        'type' => 'select',
        'desc' => 'Choose the below logo style, Default Colored',
        'choices' => array(
            array(
                'label' => 'Light',
                'value' => 'light-mode'
            ),
            array(
                'label' => 'Dark',
                'value' => 'dark-mode'
            ),
            array(
                'label' => 'Colored "default page color"',
                'value' => 'colored-mode'
            ),
            array(
    'label' => 'Custom  "You can use the shortcodes wide_section,section for background"',
    'value' => 'custom'
),
        ),
        'std' => 'colored-mode',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Bar Below the logo content',
        'id' => 'below_content',
        'type' => 'textarea',
        'desc' => 'Add the content, you can use shortcodes.',
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => '-- Floating Bar Enable',
        'id' => 'float_enable',
        'type' => 'select',
        'desc' => 'Enable the Floating Bar, Default No',
        'choices' => array(
            array(
                'label' => 'Yes',
                'value' => 'yes'
            ),
            array(
                'label' => 'No',
                'value' => 'no'
            )
        ),
        'std' => 'no',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => ' Floating Bar Logo',
        'id' => 'float_logo',
        'type' => 'upload',
        'desc' => 'Upload the Floating Bar logo for your website.',
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => ''
    ),
    array(
        'label' => 'Floating Bar style',
        'id' => 'float_style',
        'type' => 'select',
        'desc' => 'Choose the Floating Bar style, Default light',
        'choices' => array(
            array(
                'label' => 'Light',
                'value' => 'light-mode'
            ),
            array(
                'label' => 'Dark',
                'value' => 'dark-mode'
            ),
            array(
                'label' => 'Colored "default page color"',
                'value' => 'colored-mode'
            ),
            array(
    'label' => 'Custom  "You can use the shortcodes wide_section,section for background"',
    'value' => 'custom'
),
        ),
        'std' => 'light',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    ),
    array(
        'label' => 'Floating Bar content',
        'id' => 'float_content',
        'type' => 'textarea',
        'desc' => 'Add the content, you can use shortcodes.',
        'std' => '',
        'rows' => '',
        'post_type' => '',
        'taxonomy' => '',
        'class' => '',
    )
    )
    ,
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
	
  
);



$meta_skins = array(
    'id'          => 'meta_skins',
    'title'       => 'Skins Options',
    'desc'        => '',
    'pages'       => array('skin'),
    'context'     => 'normal',
    'priority'    => 'low',
    'fields'      => array(
    
    	array(
    	    'label' => 'Choose The default Header',
    	    'id' => 'header_default',
    	    'type' => 'select',
    	    'desc' => 'Choose The  Header.',
    	    'choices' => $headers,
    	    'std' => '',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Choose The default Footer',
    	    'id' => 'footer_default',
    	    'type' => 'select',
    	    'desc' => 'Choose The Footer.',
    	    'choices' => $footers,
    	    'std' => '',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Page Layout',
    	    'id' => 'page_layout',
    	    'type' => 'select',
    	    'desc' => 'Choose Website Layout Boxed/Full Width, Default: Full.',
    	    'choices' => array(
    	        array(
    	            'label' => 'Boxed',
    	            'value' => 'boxed-layout'
    	        ),
    	        array(
    	            'label' => 'Full Width',
    	            'value' => 'full-layout'
    	        )
    	    ),
    	    'std' => 'full-layout',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Fade In  Elements',
    	    'id' => 'fadein_elements',
    	    'type' => 'select',
    	    'desc' => 'Fade In Elements when scroll Default: No.',
    	    'choices' => array(
    	        array(
    	            'label' => 'Yes',
    	            'value' => 'yes'
    	        ),
    	        array(
    	            'label' => 'No',
    	            'value' => 'no'
    	        )
    	    ),
    	    'std' => 'no',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Primary Color',
    	    'id' => 'primary_color',
    	    'type' => 'colorpicker',
    	    'desc' => 'Pick a the main color for the theme (default: #a4c63b ).',
    	    'std' => '#a4c63b',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Secondary Color',
    	    'id' => 'secondary_color',
    	    'type' => 'colorpicker',
    	    'desc' => 'Pick the secondary color for the theme (default: #fbfbfb ).',
    	    'std' => '#fbfbfb',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Dark Text Color',
    	    'id' => 'text_color',
    	    'type' => 'colorpicker',
    	    'desc' => 'Pick the Dark text color for the theme (default: #505050 ).',
    	    'std' => '#505050',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	
    	array(
    	    'label' => 'Seconary/Hover Text Color',
    	    'id' => 'text2_color',
    	    'type' => 'colorpicker',
    	    'desc' => 'Pick the Seconary/Hover text color for the theme (default: #8f8f8f ).',
    	    'std' => '#8f8f8f',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Light Text Color',
    	    'id' => 'light_text_color',
    	    'type' => 'colorpicker',
    	    'desc' => 'Pick the Light text color for the theme (default: #ffffff ).',
    	    'std' => '#ffffff',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Light/hover Text Color',
    	    'id' => 'light_text_color_hover',
    	    'type' => 'colorpicker',
    	    'desc' => 'Pick the Light text color for the theme (default: #ffffff ).',
    	    'std' => '#ffffff',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Footer Background Color',
    	    'id' => 'footer_bg_color',
    	    'type' => 'colorpicker',
    	    'desc' => 'Pick the Footer Background Color for the theme (default: #fafafa ).',
    	    'std' => '#fafafa',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Body Background',
    	    'id' => 'body_background',
    	    'type' => 'background',
    	    'desc' => 'Upload the main Body background pattern you want, Default: white.',
    	    'std' => '',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Main Background',
    	    'id' => 'main_background',
    	    'type' => 'background',
    	    'desc' => 'Upload the background pattern you want, Default: The wood pattern.',
    	    'std' => '',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	
    	//Fonts
    	array(
    	    'label' => 'Heading Font',
    	    'id' => 'heading_font',
    	    'type' => 'select',
    	    'desc' => 'Select your Header font from the available fonts, Fonts are provided via Google Fonts API',
    	    'choices' => $google_fonts,
    	    'std' => 'Oswald',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Heading Font Transform',
    	    'id' => 'heading_transform',
    	    'type' => 'select',
    	    'desc' => 'Choose if the text of the menu and titles is uppercase or normal, Default: Uppercase.',
    	    'choices' => array(
    	        array(
    	            'label' => 'Uppercase',
    	            'value' => 'uppercase'
    	        ),
    	        array(
    	            'label' => 'Normal',
    	            'value' => 'normal'
    	        )
    	    ),
    	    'std' => 'uppercase',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Heading Font Wright',
    	    'id' => 'heading_weight',
    	    'type' => 'select',
    	    'desc' => 'Choose if the text of the menu and titles font weight is as default or 300, Default: Uppercase.',
    	    'choices' => array(
    	        array(
    	            'label' => 'Default',
    	            'value' => 'default'
    	        ),
    	        array(
    	            'label' => '300',
    	            'value' => 't300'
    	        ),
    	        array(
    	            'label' => '400',
    	            'value' => 't400'
    	        ),
    	        array(
    	            'label' => '700',
    	            'value' => 't700'
    	        )
    	    ),
    	    'std' => 'default',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Body Font',
    	    'id' => 'body_font',
    	    'type' => 'select',
    	    'desc' => 'Select your body "Default" font from the available fonts, Fonts are provided via Google Fonts API',
    	    'choices' => $google_fonts,
    	    'std' => 'Arial',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	
    	array(
    	    'label' => 'Body font size',
    	    'id' => 'body_font_size',
    	    'type' => 'text',
    	    'desc' => 'Add Top Menu font size, Default:13px .',
    	    'std' => '13px',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Body Font Weight',
    	    'id' => 'body_weight',
    	    'type' => 'select',
    	    'desc' => 'Choose if the text of the menu and titles font weight is as default or 300, Default: Uppercase.',
    	    'choices' => array(
    	        array(
    	            'label' => 'Default',
    	            'value' => 'default'
    	        ),
    	        array(
    	            'label' => '300',
    	            'value' => 't300'
    	        ),
    	        array(
    	            'label' => '400',
    	            'value' => 't400'
    	        ),
    	        array(
    	            'label' => '700',
    	            'value' => 't700'
    	        )
    	    ),
    	    'std' => 'default',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => ''
    	),
    	array(
    	    'label' => 'Main Menu font size',
    	    'id' => 'top_menu_fsize',
    	    'type' => 'text',
    	    'desc' => 'Add Top Menu font size, Default:14px .',
    	    'std' => '14px',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Article Thumb Title font size',
    	    'id' => 'article_title_fsize',
    	    'type' => 'text',
    	    'desc' => 'Add Article Thumb Title font size, Default:22px .',
    	    'std' => '20px',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Title font size',
    	    'id' => 'title_fsize',
    	    'type' => 'text',
    	    'desc' => 'Add Title font size, Default:16px .',
    	    'std' => '16px',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Widget Title font size',
    	    'id' => 'widget_title_fsize',
    	    'type' => 'text',
    	    'desc' => 'Add Widget Title font size, Default:16px .',
    	    'std' => '16px',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Logo font size',
    	    'id' => 'logo_fsize',
    	    'type' => 'text',
    	    'desc' => 'Add Logo font size, Default:80px .',
    	    'std' => '50px',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Slider Title font size',
    	    'id' => 'slider_title_fsize',
    	    'type' => 'text',
    	    'desc' => 'Add Slider Title font size, Default:25px .',
    	    'std' => '25px',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	)
    	,
    	array(
    	    'label' => 'Custom CSS for this skin',
    	    'id' => 'custom_css',
    	    'type' => 'textarea',
    	    'desc' => 'Add Custom CSS for this skin.',
    	    'std' => '',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	),
    	array(
    	    'label' => 'Custom js for this skin',
    	    'id' => 'custom_js',
    	    'type' => 'textarea',
    	    'desc' => 'Add Custom js for this skin.',
    	    'std' => '',
    	    'rows' => '',
    	    'post_type' => '',
    	    'taxonomy' => '',
    	    'class' => '',
    	)
    
    )
    ,
    'std'         => '',
    'rows'        => '',
    'post_type'   => '',
    'taxonomy'    => '',
    'class'       => ''
	
  
);





  
    
  /**
   * Register our meta boxes using the 
   * ot_register_meta_box() function.
   */
   
  ot_register_meta_box( $testimonial );
  ot_register_meta_box( $general );
  ot_register_meta_box( $portfolio );
  ot_register_meta_box( $meta_metro );
  ot_register_meta_box( $team );
  ot_register_meta_box( $meta_description );
  ot_register_meta_box( $stylings );
  ot_register_meta_box( $review );
  ot_register_meta_box( $meta_gallery_slider );
  ot_register_meta_box( $slides_type );
  ot_register_meta_box( $slider_video );
  ot_register_meta_box( $layout_builder2 );  
  ot_register_meta_box( $meta_header );
   ot_register_meta_box( $meta_skins );
  
  
   	
   
   
   
     
  
  
  
  

  

}