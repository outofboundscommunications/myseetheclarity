<?php

	/**
	 * List of available shortcodes
	 */
	function register_c5_shortcodes(  ) {
		
		
		
		
		/* build category */
		$slides =  array();
		
		$query = new WP_Query( array( 'post_type' => 'slides', 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC', 'post_status' => 'publish' ) );
		
		/* has posts */
		if ( $query->have_posts() ) {
		  while ( $query->have_posts() ) {
		    $query->the_post();
		    $slides[get_the_ID()] = get_the_title();
		  
		} 
		}
		wp_reset_postdata();
		
		
		$post_types = array('post' => 'Post',
		'portfolio' => 'Portfolio',
		'team' => 'Team');
		
		$all_post_types = array('post' => 'Post',
		'portfolio' => 'Portfolio',
		'team' => 'Team',
		'faq' => 'Faq',
		'testimonial' => 'Testimonial');
		
		
		$taxonomies = array('category','portfolio_cat','hierarchy');
		$custom_posts = ot_get_option('custom_posts', array());
		
		if ($custom_posts) {
		    foreach ($custom_posts as $custom_post) {
		    	$post_types[$custom_post['slug']] = $custom_post['title'];
		    	$all_post_types[$custom_post['slug']] = $custom_post['title'];
		    	if( $custom_post['category']!='' ){
		    		$taxonomies[] = $custom_post['category'];
		    	}
		    	
		    }
		 }
		 
		 
		
		$cat_array = array();
		$cat_array_only = array();
		
		/*
		$terms2 = get_terms($taxonomies);
		
		foreach ($terms2 as $term) {
			
			$cat_array[$term->term_id] = $term->name;
			$cat_array_only[ $term->term_id] =  $term->name;
		}
		*/
		$users_all = get_users();
		
		$users = array();
		
		foreach ($users_all as $user) {
			$users[$user->ID]=$user->display_name;
		}
		
		
		include(TEMPLATEPATH . '/library/includes/admin/icons.php'); 
		$icons =  get_all_icons();
		
		$new_icons= array();
		foreach ($icons as $icon ) {
			$new_icons[$icon] = substr($icon, 5);
		}
		
		$img_size =array();
		
		
		$_code125_image_sizes = get_option('_code125_image_sizes');
		if(is_array($_code125_image_sizes)){
		foreach ($_code125_image_sizes as $array) {
			$img_size['slug'] = $array['width'] . 'x' . $array['height'];
		
		}
		}
		
		
		
		$menus_new = ot_get_option( 'menus', array() );
		$menu_new = array();
		
		$menu_new['main-nav']='Main Menu';
		$menu_new['footer-links']='Footer Menu';
		foreach($menus_new as  $value) { 
		  $menu_new[ $value['location'] ] =  $value['title'];
		} 
		
		
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC'
		  );
		$categories=get_categories($args);
		$cats=array();
		$cats_slug = array();
		$cats['']= 'All Categories';
		$cats_only = array();
		  foreach($categories as $category) { 
		    $cats[  $category->term_id  ] =   $category->name;
		    $cats_only[ $category->term_id ] = $category->name;
		    $cats_slug[ $category->slug] =  $category->name;
		  } 
		  
		$terms=get_terms('portfolio_cat',$args);
		$portfolio_cats=array();
		$portfolio_cats['']= 'All Categories';
		  foreach($terms as $category) { 
		    $portfolio_cats[  $category->term_id  ] =   $category->name;
		   } 
		   
		$team_cats_all=get_terms('hierarchy',$args);
		$team_cats=array();
		$team_cats['']= 'All Categories';
		  foreach($team_cats_all as $category) { 
		    $team_cats[  $category->term_id  ] =   $category->name;
		   } 
		
		
		$sidebars_new = ot_get_option( 'sidebars', array() );
		 
		$sidebars= array(
			'default' => 'Default',
			'primary' => 'Primary Sidebar',
			'post' => 'Post Sidebar',
			'page' => 'Page Sidebar'
		);
		
		foreach ($sidebars_new as $sidebar_new) {
		
			$sidebars[ $sidebar_new['slug'] ] = $sidebar_new['title'];
			
		}
		
		$shortcodes = array(
			# basic shortcodes - start
			'basic-shortcodes-open' => array(
				'name' => __( 'Basic shortcodes', 'code125-admin' ),
				'type' => 'opengroup'
			),
			
			# row
			'row' => array(
				'name' => 'row',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# row_fluid
			'row_fluid' => array(
				'name' => 'row_fluid',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 1_12
			'1_12' => array(
				'name' => '1_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 2_12
			'2_12' => array(
				'name' => '2_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 3_12
			'3_12' => array(
				'name' => '3_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			# 4_12
			'4_12' => array(
				'name' => '4_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 5_12
			'5_12' => array(
				'name' => '5_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 6_12
			'6_12' => array(
				'name' => '6_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 7_12
			'7_12' => array(
				'name' => '7_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 8_12
			'8_12' => array(
				'name' => '8_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 9_12
			'9_12' => array(
				'name' => '9_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 10_12
			'10_12' => array(
				'name' => '10_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 11_12
			'11_12' => array(
				'name' => '11_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# 12_12
			'12_12' => array(
				'name' => '12_12',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# text
			'text' => array(
				'name' => 'text',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# is_mobile
			'is_mobile' => array(
				'name' => 'is_mobile',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# is_tablet
			'is_tablet' => array(
				'name' => 'is_tablet',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# is_handheld
			'is_handheld' => array(
				'name' => 'is_handheld',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			# is_desktop
			'is_desktop' => array(
				'name' => 'is_desktop',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			# is_desktop
			'is_desktop' => array(
				'name' => 'is_desktop',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			
			
			# sidebar
			'sidebar' => array(
				'name' => 'sidebar',
				'type' => 'wrap',
				'atts' => array(
					'slug' => array(
						'values' => $sidebars ,
						'default' => 'left',
						'desc' => __( 'Sidebar', 'code125-admin' )
					)
				)
			),
			
			# menu
			'menu' => array(
				'name' => 'menu',
				'type' => 'wrap',
				'atts' => array(
					'location' => array(
						'values' => $menu_new ,
						'default' => 'main-nav',
						'desc' => __( 'Menu Location', 'code125-admin' )
					),
					'bg_mode' => array(
						'values' => array(
							'light-mode'=>'Light',
							'dark-mode'=>'Dark',
							'colored-mode'=>'Colored'
						) ,
						'default' => 'light-mode',
						'desc' => __( 'Background Color Mode', 'code125-admin' )
					),
					'style' => array(
						'values' => array(
							'mini'=>'Mini Menu',
							'default'=>'Default',
							'full'=>'Full Width',
							'centered'=>'Centered',
							'sidebar'=>'Sidebar'
						) ,
						'default' => 'default',
						'desc' => __( 'Menu Style', 'code125-admin' )
					),
					'responsive' => array(
						'values' => array(
							'responsive'=>'Responsive',
							'no_responsive'=>'Not Responsive'
						) ,
						'default' => 'responsive',
						'desc' => __( 'Responsive', 'code125-admin' )
					)
				)
			),
			
			# title
			'title' => array(
				'name' => 'title',
				'type' => 'wrap',
				'atts' => array(
					'title' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Title', 'code125-admin' )
					),'icon' => array(
						'values' => $new_icons,
						'default' => 'icon-arrow',
						'desc' => __( 'Title icon', 'code125-admin' )
					),'id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Title ID', 'code125-admin' )
					),
					'animated' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'						),
						'default' => 'yes',
						'desc' => __( 'Animated ', 'code125-admin' )
					)
					
				),
				'usage' => '[title title="Title"] ',
				'desc' => __( 'Title Shortcode', 'code125-admin' ),
				'content_off' => 'off'
			),
		

			
						
			# dropcap
			'dropcap' => array(
				'name' => 'dropcap',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[dropcap] Tab Letter [/dropcap]',
				'content' => __( 'L', 'code125-admin' ),
				'desc' => ''
			),
			# dropcap2
			'dropcap2' => array(
				'name' => 'dropcap2',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[dropcap2] Tab Letter [/dropcap2]',
				'content' => __( 'L', 'code125-admin' ),
				'desc' => ''
			),
			# percentage
			'percentage' => array(
				'name' => 'percentage',
				'type' => 'wrap',
				'atts' => array(
					'percentage' => array(
						'values' => array( ),
						'default' => '80%',
						'desc' => __( 'percentage in %', 'code125-admin' )
					),
					'title' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Title', 'code125-admin' )
					),
				),
				
				'usage' => '[percentage percentage="70%"]',
				'desc' => ''
			),
			
			# image
			'image' => array(
				'name' => 'image',
				'type' => 'wrap',
				'atts' => array(
					'width' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Width, in px, just write the number', 'code125-admin' )
					),
					'height' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Height, in px, just write the number', 'code125-admin' )
					),
					'src' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Image Source', 'code125-admin' )
					),
					'caption' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Image Caption', 'code125-admin' )
					),
					'float' => array(
						'values' => array(
								'left' => 'Left',
								'right' => 'Right',
								'none' => 'None'
						),
						'default' => 'none',
						'desc' => __( 'Float', 'code125-admin' )
					)
			
				),
				'desc' =>''
			),
			# fancybox
			'fancybox' => array(
				'name' => 'fancybox',
				'type' => 'wrap',
				'atts' => array(
						'w' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Width, in px, just write the number', 'code125-admin' )
						),
						'h' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Height, in px, just write the number', 'code125-admin' )
						),
						'src' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Image Source', 'code125-admin' )
						),
						'caption' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Image Caption', 'code125-admin' )
						)),
				'desc' => ''
			),
			
			# ul
			'ul' => array(
				'name' => 'ul',
				'type' => 'wrap',
				'atts' => array(
					'float' => array(
						'values' => array(
								'left' => 'Left',
								'right' => 'Right',
								'none' => 'None'
						),
						'default' => 'none',
						'desc' => __( 'Li Float', 'code125-admin' )
					),
					'color' => array(
						'values' => array(),
						'default' => 'none',
						'desc' => __( 'Icon Color', 'code125-admin' )
					)
				),
				'usage' => '[ul] [li icon="phone"] li content [/li] [/ul]',
				'desc' => '',
				'content' => '',
				'child' => 'li'
			),
			# li
			'li' => array(
				'name' => 'li',
				'type' => 'wrap',
				'atts' => array(
					'icon' => array(
						'values' => $new_icons,
						'default' => 'icon-ok',
						'desc' => __( 'Icon', 'code125-admin' )
					),
					'color' => array(
						'values' => array(),
						'default' => 'none',
						'desc' => __( 'Icon Color', 'code125-admin' )
					)
						
					
				),
				'usage' => '[li title="icon"] li content [/li]',
				'content' => __( 'li content', 'code125-admin' )
			),
			# ul_2_table
			'ul_2_table' => array(
				'name' => 'ul_2_table',
				'type' => 'wrap',
				'atts' => array(
					'align' => array(
						'values' => array(
								'left' => 'Left',
								'right' => 'Right',
								'center' => 'Center'
						),
						'default' => 'left',
						'desc' => __( 'Align', 'code125-admin' )
					)
				),
				'usage' => '[li title="icon"] li content [/li]',
				'content' => __( 'ul content', 'code125-admin' )
			),
			# service_column
			'service_column' => array(
				'name' => 'service_column',
				'type' => 'wrap',
				'atts' => array(
					'icon' => array(
						'values' => $new_icons,
						'default' => 'icon-ok',
						'desc' => __( 'Icon', 'code125-admin' )
					),
					'color' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Icon Color', 'code125-admin' )
					),
					'style' => array(
						'values' => array(
								'1' => 'Style 1',
								'2' => 'Style 2',
								'3' => 'Style 3',
								'4' => 'Style 4',
								'5' => 'Style 5'
						),
						'default' => '1',
						'desc' => __( 'Column Style', 'code125-admin' )
					),
						
					
				),
				'usage' => '[li title="icon"] li content [/li]',
				'content' => __( 'li content', 'code125-admin' )
			),
			
			
			# input
			'input' => array(
				'name' => 'input',
				'type' => 'wrap',
				'atts' => array(
					'placeholder' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Placeholder text', 'code125-admin' )
					),
					'id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'ID for input', 'code125-admin' )
					),
					'icon' => array(
						'values' =>$new_icons,
						'default' => 'none',
						'desc' => __( 'Icon', 'code125-admin' )
					)
				)
			),
			
			# textarea
			'textarea' => array(
				'name' => 'textarea',
				'type' => 'wrap',
				'atts' => array(
					'placeholder' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Placeholder text', 'code125-admin' )
					),
					'id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'ID for texarea', 'code125-admin' )
					)
				)
			),
			
			
			
			
			# button
			'button' => array(
				'name' => 'button',
				'type' => 'wrap',
				'atts' => array(
						'color' => array(
							'values' => array(
									'default-color' => 'Default',
									'btn-primary' => 'Primary',
									'btn-info' => 'Info',
									'btn-success' => 'Success',
									'btn-warning' => 'Warning',
									'btn-danger' => 'Danger',
									'btn-inverse' => 'Inverse'
							),
							'default' => 'blue',
							'desc' => __( 'Button Color', 'code125-admin' )
						),
						'size' => array(
							'values' => array(
									'btn-mini' => 'Mini',
									'btn-small' => 'Small',
									'default-size' => 'Default',
									'btn-large' => 'Large',
									'btn-block' => 'Default - float',
									'btn-large btn-block' => 'Large - Float'
							),
							'default' => 'default-size',
							'desc' => __( 'Button Size', 'code125-admin' )
						),
						'float' => array(
							'values' => array(
									'left' => 'Left',
									'right' => 'Right',
									'center'=> 'Center',
									'none' => 'None'
							),
							'default' => 'left',
							'desc' => __( 'Float', 'code125-admin' )
						),
						'text' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button Text', 'code125-admin' )
						),
						'link' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button Link', 'code125-admin' )
						)
				)
			),
			
			# button_2
			'button_2' => array(
				'name' => 'button_2',
				'type' => 'wrap',
				'atts' => array(
						'color' => array(
							'values' => array(),
							'default' => ot_get_option( 'primary_color' ),
							'desc' => __( 'Button Color', 'code125-admin' )
						),
						'text_color' => array(
							'values' => array(),
							'default' => '#fff',
							'desc' => __( 'Button text Color', 'code125-admin' )
						),
						'icon' => array(
							'values' => $new_icons,
							'default' => 'icon arrow',
							'desc' => __( 'Button icon', 'code125-admin' )
						),
						'float' => array(
							'values' => array(
									'left' => 'Left',
									'right' => 'Right',
									'center'=> 'Center',
									'none'=> 'None'
							),
							'default' => 'left',
							'desc' => __( 'Float', 'code125-admin' )
						),
						'text' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button Text', 'code125-admin' )
						),
						'link' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button Link', 'code125-admin' )
						),
						'id' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button id', 'code125-admin' )
						)
				)
			),
			# button_3
			'button_3' => array(
				'name' => 'button_3',
				'type' => 'wrap',
				'atts' => array(
						'color' => array(
							'values' => array(),
							'default' => ot_get_option( 'primary_color' ),
							'desc' => __( 'Button Color', 'code125-admin' )
						),
						'text_color' => array(
							'values' => array(),
							'default' => '#fff',
							'desc' => __( 'Button text Color', 'code125-admin' )
						),
						'icon' => array(
							'values' => $new_icons,
							'default' => 'icon arrow',
							'desc' => __( 'Button icon', 'code125-admin' )
						),
						'float' => array(
							'values' => array(
									'left' => 'Left',
									'right' => 'Right',
									'center'=> 'Center',
									'none'=> 'None'
							),
							'default' => 'left',
							'desc' => __( 'Float', 'code125-admin' )
						),
						'text' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button Text', 'code125-admin' )
						),
						'link' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button Link', 'code125-admin' )
						),
						'id' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Button id', 'code125-admin' )
						)
				)
			),
						
			#box_with_button
			
			'box_with_button' => array(
				'name' => 'box_with_button',
				'type' => 'wrap',
				'atts' => array(
					'color' => array(
						'values' => array(),
						'default' => ot_get_option( 'primary_color' ),
						'desc' => __( 'Button Color', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'icon arrow',
						'desc' => __( 'Button icon', 'code125-admin' )
					),
					'text_color' => array(
						'values' => array(),
						'default' => '#fff',
						'desc' => __( 'Button text Color', 'code125-admin' )
					),
					'text' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Button Text', 'code125-admin' )
					),
					'link' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Button Link', 'code125-admin' )
					),
				),
				'content' => __( 'content', 'code125-admin' )
			),
			# container
			'container' => array(
				'name' => 'container',
				'type' => 'wrap',
				'atts' => array(),
				'content' => __( 'content', 'code125-admin' )
			),
			# float_left
			'float_left' => array(
				'name' => 'float_left',
				'type' => 'wrap',
				'atts' => array(),
				'content' => __( 'content', 'code125-admin' )
			),
			# float_right
			'float_right' => array(
				'name' => 'float_right',
				'type' => 'wrap',
				'atts' => array(),
				'content' => __( 'content', 'code125-admin' )
			),
			# section_open
			'section_open' => array(
				'name' => 'section_open',
				'type' => 'wrap',
				'atts' => array(
					'style' => array(
						'values' => array(
								'light-mode' => 'Light',
								'dark-mode' => 'Dark'
						),
						'default' => '',
						'desc' => __( 'Style', 'code125-admin' )
					),
					'center' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'no',
						'desc' => __( 'Center Content', 'code125-admin' )
					),
					'image' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Background Image', 'code125-admin' )
					),
					'repeat' => array(
						'values' => array(
								'' => 'Default',
								'no-repeat' => 'No Repeat',
								'repeat' => 'Repeat',
								'repeat-x' => 'Repeat Horizontally',
								'repeat-y' => 'Repeat Vertically',
								'inherit' => 'Inherit'
						),
						'default' => '',
						'desc' => __( 'Background Repeat', 'code125-admin' )
					),
					'attachment' => array(
						'values' => array(
								'' => 'Default',
								'fixed' => 'Fixed',
								'scroll' => 'Scroll',
								'inherit' => 'Inherit',
								'parallax' => 'Parallax'
						),
						'default' => '',
						'desc' => __( 'Background Attachment', 'code125-admin' )
					),
					'position' => array(
						'values' => array(
								'' => 'Default',
								'left top' => 'Left Top',
								'left center' => 'Left Center',
								'left bottom' => 'Left Bottom',
								'center top' => 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' => 'Right Top',
								'right center' => 'right center',
								'right bottom' => 'Right Bottom'
						),
						'default' => '',
						'desc' => __( 'Background Position', 'code125-admin' )
					),
					'color' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Background Color', 'code125-admin' )
					)
				)
			),
			# section_close
			'section_close' => array(
				'name' => 'section_close',
				'type' => 'wrap',
				'atts' => array()
			),
			# wide_section_open
			'wide_section_open' => array(
				'name' => 'wide_section_open',
				'type' => 'wrap',
				'atts' => array(
					'style' => array(
						'values' => array(
								'light-mode' => 'Light',
								'dark-mode' => 'Dark'
						),
						'default' => '',
						'desc' => __( 'Style', 'code125-admin' )
					),
					'image' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Background Image', 'code125-admin' )
					),
					'repeat' => array(
						'values' => array(
								'' => 'Default',
								'no-repeat' => 'No Repeat',
								'repeat' => 'Repeat',
								'repeat-x' => 'Repeat Horizontally',
								'repeat-y' => 'Repeat Vertically',
								'inherit' => 'Inherit'
						),
						'default' => '',
						'desc' => __( 'Background Repeat', 'code125-admin' )
					),
					'attachment' => array(
						'values' => array(
								'' => 'Default',
								'fixed' => 'Fixed',
								'scroll' => 'Scroll',
								'inherit' => 'Inherit',
								'parallax' => 'Parallax'
						),
						'default' => '',
						'desc' => __( 'Background Attachment', 'code125-admin' )
					),
					'position' => array(
						'values' => array(
								'' => 'Default',
								'left top' => 'Left Top',
								'left center' => 'Left Center',
								'left bottom' => 'Left Bottom',
								'center top' => 'Center Top',
								'center center' => 'Center Center',
								'center bottom' => 'Center Bottom',
								'right top' => 'Right Top',
								'right center' => 'right center',
								'right bottom' => 'Right Bottom'
						),
						'default' => '',
						'desc' => __( 'Background Position', 'code125-admin' )
					),
					'color' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Background Color', 'code125-admin' )
					)
				)
			),
			# wide_section_close
			'wide_section_close' => array(
				'name' => 'wide_section_close',
				'type' => 'wrap',
				'atts' => array()
			),
			
			# full_width_open
			'full_width_open' => array(
				'name' => 'full_width_open',
				'type' => 'wrap',
				'atts' => array()
			),
			# full_width_close
			'full_width_close' => array(
				'name' => 'full_width_close',
				'type' => 'wrap',
				'atts' => array()
			),
			# today
			'today' => array(
				'name' => 'today',
				'type' => 'wrap',
				'atts' => array()
			),
			# center
			'center' => array(
				'name' => 'center',
				'type' => 'wrap',
				'atts' => array(),
				'content' => __( 'content', 'code125-admin' )
			),
			# box
			'box' => array(
				'name' => 'box',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => array(
									'notice' => 'Notice',
									'info' => 'Info',
									'warning' => 'Warning',
									'success' => 'Success'
							),
							'default' => 'info',
							'desc' => __( 'Box Type', 'code125-admin' )
						),
						'title' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Box Title', 'code125-admin' )
						),
						'message' => array(
							'values' => array( ),
							'default' => '',
							'desc' => __( 'Box Message', 'code125-admin' )
						)
				)
			),
			
			# space
			'space' => array(
				'name' => 'space',
				'type' => 'wrap',
				'atts' => array()
			),
			
			# space_30
			'space_30' => array(
				'name' => 'space_30',
				'type' => 'wrap',
				'atts' => array()
			),
			# shadow
			'shadow' => array(
				'name' => 'shadow',
				'type' => 'wrap',
				'atts' => array()
			),
			
			# divider
			'divider' => array(
				'name' => 'divider',
				'type' => 'wrap',
				'atts' => array()
			),
			# is_logged_in
			'is_logged_in' => array(
				'name' => 'is_logged_in',
				'type' => 'wrap',
				'atts' => array(),
				'content' => __( 'is_logged_in content', 'code125-admin' ),
				'desc' => ''
			),
			# is_logged_out
			'is_logged_out' => array(
				'name' => 'is_logged_out',
				'type' => 'wrap',
				'atts' => array(),
				'content' => __( 'is_logged_out content', 'code125-admin' ),
				'desc' => ''
			),
			
			# basic shortcodes - end
			'basic-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
			
			
			'tabs-shortcodes-open' => array(
				'name' => __( 'Tabs shortcodes', 'code125-admin' ),
				'type' => 'opengroup'
			),
			
			# tabgroup
			'tabgroup' => array(
				'name' => 'tabgroup',
				'type' => 'wrap',
				'atts' => array(
					
				),
				'usage' => '[tabgroup] [tab title="Tab name"] Tab content [/tab] [/tabgroup]',
				'desc' =>'',
				'child' => 'tab'
			),
			# tab
			'tab' => array(
				'name' => 'tab',
				'type' => 'wrap',
				'atts' => array(
				'title' => array(
					'values' => array( ),
					'default' => __( 'Title', 'code125-admin' ),
					'desc' => __( 'Tab title', 'code125-admin' )
				),
				'icon' => array(
					'values' => $new_icons,
					'default' => 'none',
					'desc' => __( 'Icon', 'code125-admin' )
				)
				),
				'usage' => '[tab title="Tab name"] Tab content [/tab]',
				'content' => __( 'Tab content', 'code125-admin' ),
				'desc' =>''
			),
			# fancy_tabgroup
			'fancy_tabgroup' => array(
				'name' => 'fancy_tabgroup',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[fancy_tabgroup] [fancy_tab title="Tab name"] Tab content [/fancy_tab] [/fancy_tabgroup]',
				'desc' =>'',
				'child' => 'fancy_tab'
			),
			# fancy_tab
			'fancy_tab' => array(
				'name' => 'fancy_tab',
				'type' => 'wrap',
				'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => __( 'Title', 'code125-admin' ),
						'desc' => __( 'Tab title', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'none',
						'desc' => __( 'Icon', 'code125-admin' )
					) ),
				'usage' => '[fancy_tab title="Tab name"] Tab content [/fancy_tab]',
				'content' => __( 'Tab content', 'code125-admin' ),
				'desc' =>''
			),
			# fancy_tabgroup_posts
			'fancy_tabgroup_posts' => array(
				'name' => 'fancy_tabgroup_posts',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[fancy_tabgroup] [fancy_tab title="Tab name"] Tab content [/fancy_tab] [/fancy_tabgroup]',
				'desc' =>'',
				'child' => 'fancy_tab_post'
			),
			# fancy_tab_post
			'fancy_tab_post' => array(
				'name' => 'fancy_tab_post',
				'type' => 'wrap',
				'atts' => array(
					'id' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'none',
						'desc' => __( 'Icon', 'code125-admin' )
					) ),
				'usage' => '',
				'desc' =>''
			),
						
			# accordiongroup
			'accordiongroup' => array(
				'name' => 'accordiongroup',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[accordiongroup] [accordion title="Tab name"] Tab content [/accordion] [/accordiongroup]',
				'desc' => '',
				'child' => 'accordion'
			),
			# accordion
			'accordion' => array(
				'name' => 'accordion',
				'type' => 'wrap',
				'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => __( 'Title', 'code125-admin' ),
						'desc' => __( 'Tab title', 'code125-admin' )
					)
					),
				'usage' => '[accordion title="Tab name"] Tab content [/accordion]',
				'content' => __( 'Tab content', 'code125-admin' ),
				'desc' => ''
			),
			# toggle
			'toggle' => array(
				'name' => 'toggle',
				'type' => 'wrap',
				'atts' => array(
					'title' => array(
						'values' => array( ),
						'default' => __( 'Title', 'code125-admin' ),
						'desc' => __( 'Tab title', 'code125-admin' )
					)),
				'usage' => '[toggle title="Tab name"] Tab content [/toggle]',
				'content' => __( 'Toggle content', 'code125-admin' ),
				'desc' => ''
			),
			
		
			
			# basic shortcodes - end
			'tabs-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
			
			
			
			'slider-shortcodes-open' => array(
				'name' => __( 'Sliders shortcodes', 'code125-admin' ),
				'type' => 'opengroup'
			),
			
			# slider
			'slider' => array(
				'name' => 'slider',
				'type' => 'wrap',
				'atts' => array(
					
				),
				'usage' => '[slider] [slide id=""]  [/slider]',
				'desc' =>'',
				'child' => 'slide'
			),
			# slide
			'slide' => array(
				'name' => 'slide',
				'type' => 'wrap',
				'atts' => array(
					'id' => array(
						'values' => $slides,
						'desc' => __( 'Slide', 'code125-admin' ),
						'default' => ''
					)
				),
				'usage' => '[slide id=""]',
				'desc' =>''
			),
			
			# slider_with_title
			'slider_with_title' => array(
				'name' => 'slider_with_title',
				'type' => 'wrap',
				'atts' => array(
					'title' => array(
						'values' => array(),
						'desc' => __( 'Title', 'code125-admin' ),
						'default' => ''
					)
				),
				'usage' => '[slider] [slide id=""]  [/slider]',
				'desc' =>'',
				'child' => 'slide_with_title'
			),
			# slide_with_title
			'slide_with_title' => array(
				'name' => 'slide_with_title',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '',
				'desc' =>'',
				'content' => 'Content '
			),
						
			
			# flexslider
			'flexslider' => array(
				'name' => 'flexslider',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[flexslider] [flexslider_slide title="Tab name"] Tab content [/flexslider_slide] [/flexslider]',
				'desc' => '',
				'child' => 'flexslider_slide'
				
			),
			# flexslider_slide
			'flexslider_slide' => array(
				'name' => 'flexslider_slide',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[flexslider_slide title="Tab name"] Tab content [/flexslider_slide]',
				'content' => __( 'Tab content', 'code125-admin' ),
				'desc' => ''
			),			
			
			# posts_slider
			'posts_slider' => array(
				'name' => 'posts_slider',
				'type' => 'wrap',
				'atts' => array(
					'width_type' => array(
						'values' => array(
							'span12' => 'Full Width',
							'span8' => 'In a page that have a sidebar "Span8 size"'
						),
						'desc' => __( 'Slider Width', 'code125-admin' ),
						'default' => 'span8'
					),
					'author_enable' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'yes',
						'desc' => __( 'Show Author in  meta settings', 'code125-admin' )
					),
					'time_date' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'yes',
						'desc' => __( 'Show Time in  meta settings', 'code125-admin' )
					),
					'comments_count_enable' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'yes',
						'desc' => __( 'Show  Comments Count in  meta settings', 'code125-admin' )
					),
					'cat_enable' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'yes',
						'desc' => __( 'Show Category in  meta settings', 'code125-admin' )
					),
					'like_enable' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'yes',
						'desc' => __( 'Show Like Count in  meta settings', 'code125-admin' )
					),
					'view_count_enable' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'yes',
						'desc' => __( 'Show View Count in  meta settings', 'code125-admin' )
					),
					'review_enable' => array(
						'values' => array(
								'yes' => 'Yes',
								'no' => 'No'
						),
						'default' => 'yes',
						'desc' => __( 'Show Review Starts in  meta settings', 'code125-admin' )
					)
				),
				'usage' => '[posts_2 number_of_posts="3"]',
				'desc' => __( 'posts_2.', 'code125-admin' ),
				'child' => 'posts_slide'
			),
			# posts_slide
			'posts_slide' => array(
				'name' => 'posts_slide',
				'type' => 'wrap',
				'atts' => array(
					'id' => array(
						'values' => array(),
						'desc' => __( 'Post ID', 'code125-admin' ),
						'default' => ''
					),
					'type' => array(
						'values' => array(
							'post' => 'Post',
							'portfolio' => 'Portfolio',
							'team' => 'Team',
						),
						'desc' => __( 'Post Type', 'code125-admin' ),
						'default' => 'post'
					)
				),
				'usage' => '[posts_slide id=""]',
				'desc' =>''
			),
			# posts_slider_auto
			'posts_slider_auto' => array(
				'name' => 'posts_slider_auto',
				'type' => 'wrap',
				'atts' => array(
						'width_type' => array(
							'values' => array(
								'span12' => 'Full Width',
								'span8' => 'In a page that have a sidebar "Span8 size"'
							),
							'desc' => __( 'Slider Width', 'code125-admin' ),
							'default' => 'span8'
						),
						'type' => array(
							'values' => $post_types,
							'default' => 'post',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' =>$cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '5',
							'desc' => __( 'Number of Posts Per page', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						),
						'author_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Author in  meta settings', 'code125-admin' )
						),
						'time_date' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Time in  meta settings', 'code125-admin' )
						),
						'comments_count_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show  Comments Count in  meta settings', 'code125-admin' )
						),
						'cat_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Category in  meta settings', 'code125-admin' )
						),
						'like_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Like Count in  meta settings', 'code125-admin' )
						),
						'view_count_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show View Count in  meta settings', 'code125-admin' )
						),
						'review_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Review Starts in  meta settings', 'code125-admin' )
						)
				)
			),
			
			
			# contact_form
			'contact_form' => array(
				'name' => 'contact_form',
				'type' => 'wrap',
				'atts' => array(
					'name' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Placeholder for name', 'code125-admin' )
					),
					'email' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Placeholder for email', 'code125-admin' )
					),
					'message' => array(
						'values' => array( ),
						'default' => '',
						'desc' => __( 'Placeholder for message', 'code125-admin' )
					),
					'send' => array(
						'values' => array( ),
						'default' => 'Send',
						'desc' => __( 'Text for send', 'code125-admin' )
					)
					),
				'usage' => '[contact_form]',
				'desc' => __( 'contact_form.', 'code125-admin' ),
				
			),
			
			# basic shortcodes - end
			'slider-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
			
			# article shortcodes - start
			'article-open' => array(
				'name' => __( 'Article shortcodes', 'code125-admin' ),
				'type' => 'opengroup'
			),
			# blockquote
			'blockquote' => array(
				'name' => 'blockquote',
				'type' => 'wrap',
				'atts' => array(),
				'content' => 'Content'
			),
			#featured_image
			'featured_image' => array(
				'name' => 'featured_image',
				'type' => 'wrap',
				'atts' => array(
					'size' => array(
						'values' => $img_size,
						'default' => 'blog-post-thumb',
						'desc' => __( 'Size', 'code125-admin' )
					),
					'style' => array(
						'values' => array(
							'none' => 'None',
							'borderd' => 'Bordered'
							),
						'default' => 'none',
						'desc' => __( 'Style', 'code125-admin' )
					),
				)
			),
			#post_title
			'post_title' => array(
				'name' => 'post_title',
				'type' => 'wrap',
				'atts' => array(
					'post_id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'none',
						'desc' => __( 'Add icon', 'code125-admin' )
					),
					'post_link' => array(
						'values' => array(
							'true' => 'True',
							'false' => 'False'
							),
						'default' => 'true',
						'desc' => __( 'Link it to the post', 'code125-admin' )
					),
					'wrapper' => array(
						'values' => array(
							'a' => 'a tag',
							'p' => 'p tag',
							'h1' => 'h1 tag',
							'h2' => 'h2 tag',
							'h3' => 'h3 tag',
							'h4' => 'h4 tag',
							'h5' => 'h5 tag',
							'h6' => 'h6 tag',
							),
						'default' => 'a',
						'desc' => __( 'Wrap it in', 'code125-admin' )
					),
					
					
					'class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Link Class', 'code125-admin' )
					),
					'wrap_li' => array(
						'values' => array(
							'true' => 'True',
							'false' => 'False'
							),
						'default' => 'false',
						'desc' => __( 'Wrap it with li', 'code125-admin' )
					),
					'wrap_li_class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'li Class', 'code125-admin' )
					),
				)
			),
			#post_category
			'post_category' => array(
				'name' => 'post_category',
				'type' => 'wrap',
				'atts' => array(
					'post_id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'none',
						'desc' => __( 'Add icon', 'code125-admin' )
					),
					'class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Link Class', 'code125-admin' )
					),
					'wrap_li' => array(
						'values' => array(
							'true' => 'True',
							'false' => 'False'
							),
						'default' => 'false',
						'desc' => __( 'Wrap it with li', 'code125-admin' )
					),
					'wrap_li_class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'li Class', 'code125-admin' )
					),
				)
			),
			#post_date
			'post_date' => array(
				'name' => 'post_date',
				'type' => 'wrap',
				'atts' => array(
					'post_id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'none',
						'desc' => __( 'Add icon', 'code125-admin' )
					),
					'class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Link Class', 'code125-admin' )
					),
					'wrap_li' => array(
						'values' => array(
							'true' => 'True',
							'false' => 'False'
							),
						'default' => 'false',
						'desc' => __( 'Wrap it with li', 'code125-admin' )
					),
					'wrap_li_class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'li Class', 'code125-admin' )
					),
				)
			),
			#author_name
			'author_name' => array(
				'name' => 'author_name',
				'type' => 'wrap',
				'atts' => array(
					'post_id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'none',
						'desc' => __( 'Add icon', 'code125-admin' )
					),
					'class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Link Class', 'code125-admin' )
					),
					'wrap_li' => array(
						'values' => array(
							'true' => 'True',
							'false' => 'False'
							),
						'default' => 'false',
						'desc' => __( 'Wrap it with li', 'code125-admin' )
					),
					'wrap_li_class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'li Class', 'code125-admin' )
					),
				)
			),
			#post_comments_count
			'post_comments_count' => array(
				'name' => 'post_comments_count',
				'type' => 'wrap',
				'atts' => array(
					'post_id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'icon' => array(
						'values' => $new_icons,
						'default' => 'none',
						'desc' => __( 'Add icon', 'code125-admin' )
					),
					'class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Link Class', 'code125-admin' )
					),
					'method' => array(
						'values' => array(
							'text' => 'Text',
							'number' => 'Number'
							),
						'default' => 'text',
						'desc' => __( 'Rendering text Method', 'code125-admin' )
					),
					'wrap_li' => array(
						'values' => array(
							'true' => 'True',
							'false' => 'False'
							),
						'default' => 'false',
						'desc' => __( 'Wrap it with li', 'code125-admin' )
					),
					'wrap_li_class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'li Class', 'code125-admin' )
					),
				)
			),
			#post_like_button
			'post_like_button' => array(
				'name' => 'post_like_button',
				'type' => 'wrap',
				'atts' => array(
					'post_id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'wrap_li' => array(
						'values' => array(
							'true' => 'True',
							'false' => 'False'
							),
						'default' => 'false',
						'desc' => __( 'Wrap it with li', 'code125-admin' )
					),
					'wrap_li_class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'li Class', 'code125-admin' )
					),
				)
			),
			# share
			'share' => array(
				'name' => 'share',
				'type' => 'wrap',
				'atts' => array(
				
					'test' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Button Text', 'code125-admin' )
					)
				)
			),
			#team_member_social
			'team_member_social' => array(
				'name' => 'team_member_social',
				'type' => 'wrap',
				'atts' => array(
					'post_id' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Post ID', 'code125-admin' )
					),
					'class' => array(
						'values' => array(),
						'default' => '',
						'desc' => __( 'Link Class', 'code125-admin' )
					)
				)
			),
			
			# review_box
			'review_box' => array(
				'name' => 'review_box',
				'type' => 'wrap',
				'atts' => array(),
				'usage' => '[review_box]',
				'desc' =>  'review_box.' ,
				
			),
			
			# article shortcodes - close
			'article-close' => array(
				'type' => 'closegroup'
			),
			
			
			
			
			
			
			
			
			
			
			'posts-shortcodes-open' => array(
				'name' => __( 'Posts shortcodes', 'code125-admin' ),
				'type' => 'opengroup'
			),
			
			
				
			# posts
			'posts' => array(
				'name' => 'posts',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => $post_types,
							'default' => 'post',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'blog_style' => array(
							'values' => array(
									'1' => 'Blog Style 1',
									'2' => 'Blog Style 2',
									'3' => 'Blog Style 3',
									'4' => 'Blog Style 4',
									'5' => 'Blog Style 5',
									'6' => 'Blog Style 6',
									'7' => 'Blog Style 7'
							),
							'default' => '1',
							'desc' => __( 'Blog Style', 'code125-admin' )
						),
						'thumb_view' => array(
							'values' => array(
									'image' => 'Featured Image',
									'type' => 'Post Format Icon',
									'cat' => 'Category Icon',
									'comment' => 'Comment Count',
									'date' => 'Date',
									'like' => 'Like Count',
									'rate' => 'Rating',
									'view' => 'Views Count',
									
							),
							'default' => 'type',
							'desc' => __( 'Thumb View "Incase of Style 7"', 'code125-admin' )
						),
						'thumb_size' => array(
							'values' => array(
									'large' => 'Large',
									'small' => 'Small'
									
							),
							'default' => 'large',
							'desc' => __( 'Thumb View Size "Incase of Style 7"', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '8',
							'desc' => __( 'Number of Posts Per page', 'code125-admin' )
						)
						,
						'paging' => array(
							'values' => array(
									'false' => 'False',
									'load' => 'Ajax Load',
									'true' => 'Numerical'
							),
							'default' => 'false',
							'desc' => __( 'Paging Method', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						),
						'author_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Author in  meta settings', 'code125-admin' )
						),
						'date_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Time in  meta settings', 'code125-admin' )
						),
						'comments_count_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show  Comments Count in  meta settings', 'code125-admin' )
						),
						'cat_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Category in  meta settings', 'code125-admin' )
						),
						'like_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Like Count in  meta settings', 'code125-admin' )
						),
						'view_count_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show View Count in  meta settings', 'code125-admin' )
						),
						'review_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Review Starts in  meta settings', 'code125-admin' )
						)
				)
			),
			# columns_grid
			'columns_grid' => array(
				'name' => 'columns_grid',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => $post_types,
							'default' => 'portfolio',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'height' => array(
							'values' => array(
									'fixed' => 'Fixed',
									'flexible' => 'Flexible'
							),
							'default' => 'fixed',
							'desc' => __( 'Item Height', 'code125-admin' )
						),
						'shape' => array(
							'values' => array(
									'square' => 'Square',
									'circle' => 'Circle',
									'square-metro' => 'Square (Metro)',
									'oct' => 'Octagon'
							),
							'default' => 'fixed',
							'desc' => __( 'Item Shape', 'code125-admin' )
						),
						'col_count' => array(
							'values' => array(
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'mixed' => 'Mixed Columns'
							),
							'default' => '4',
							'desc' => __( 'Column Count', 'code125-admin' )
						),
						'link_type' => array(
							'values' => array(
									'link' => 'Link to Post',
									'ajax' => 'Ajax Load into a lightbox'
							),
							'default' => 'link',
							'desc' => __( 'Post Link Type', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '12',
							'desc' => __( 'Number of Posts Per page', 'code125-admin' )
						)
						,
						'paging' => array(
							'values' => array(
									'false' => 'False',
									'load' => 'Ajax Load',
									'true' => 'Numerical'
							),
							'default' => 'load',
							'desc' => __( 'Paging Method', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						'child_cats' => array(
							'values' => array(
									'true' => 'True',
									'false' => 'False'
							),
							'default' => 'true',
							'desc' => __( 'Show Child Categories', 'code125-admin' )
						),
						'animated' => array(
							'values' => array(
									'true' => 'True',
									'false' => 'False'
							),
							'default' => 'true',
							'desc' => __( 'Make the Grid Filterable', 'code125-admin' )
						),
						'show_count' => array(
							'values' => array(
									'true' => 'True',
									'false' => 'False'
							),
							'default' => 'true',
							'desc' => __( 'Show Posts Count beside every Category', 'code125-admin' )
						),
						'filter' => array(
							'values' => array(
									'true' => 'True',
									'false' => 'False'
							),
							'default' => 'true',
							'desc' => __( 'Show the filter bar "Upper Bar"', 'code125-admin' )
						),
						
						
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						)
				)
			),
			# thumbnails_in_line
			'thumbnails_in_line' => array(
				'name' => 'thumbnails_in_line',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => $post_types,
							'default' => 'portfolio',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '12',
							'desc' => __( 'Number of Posts Per page', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						)
				)
			),
			# accordion_thumbs
			'accordion_thumbs' => array(
				'name' => 'accordion_thumbs',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => $post_types,
							'default' => 'post',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '12',
							'desc' => __( 'Number of Posts Per page', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						)
				)
			),
			
			# breaking_news
			'breaking_news' => array(
				'name' => 'breaking_news',
				'type' => 'wrap',
				'atts' => array(
						'source_type' => array(
							'values' => array(
									'category' => 'Category',
									'posts' => 'Posts',
									'custom' => 'Custom Text'
							),
							'default' => 'posts',
							'desc' => __( 'Source Type', 'code125-admin' )
						),
						'posts' => array(
							'values' => array(),
							'default' => '',
							'desc' => __( 'Add Posts Ids seperated by ,', 'code125-admin' )
						),
						'title' => array(
							'values' => array(),
							'default' => '',
							'desc' => __( 'Title', 'code125-admin' )
						),
						'type' => array(
							'values' => $all_post_types,
							'default' => 'post',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '12',
							'desc' => __( 'Number of Posts Per page', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						)
				)
			),
			
			# category
			'category' => array(
				'name' => 'category',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => $post_types,
							'default' => 'post',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array_only ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'blog_style' => array(
							'values' => array(
									'1' => 'Category Style 1',
									'2' => 'Category Style 2',
									'3' => 'Category Style 3',
									'4' => 'Category Style 4',
									'5' => 'Category Style 5',
									'6' => 'Category Style 6',
									'7' => 'Category Style 7'
							),
							'default' => '1',
							'desc' => __( 'Category Style', 'code125-admin' )
						),
						'thumb_view' => array(
							'values' => array(
									'image' => 'Featured Image',
									'type' => 'Post Format Icon',
									'cat' => 'Category Icon',
									'comment' => 'Comment Count',
									'date' => 'Date',
									'like' => 'Like Count',
									'rate' => 'Rating',
									'view' => 'Views Count',
									
							),
							'default' => 'image',
							'desc' => __( 'Thumb View', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '5',
							'desc' => __( 'Number of Posts To Show', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						),
						'author_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'no',
							'desc' => __( 'Show Author in  meta settings', 'code125-admin' )
						),
						'date_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'no',
							'desc' => __( 'Show Time in  meta settings', 'code125-admin' )
						),
						'comments_count_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show  Comments Count in  meta settings', 'code125-admin' )
						),
						'cat_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'no',
							'desc' => __( 'Show Category in  meta settings', 'code125-admin' )
						),
						'like_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show Like Count in  meta settings', 'code125-admin' )
						),
						'view_count_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'yes',
							'desc' => __( 'Show View Count in  meta settings', 'code125-admin' )
						),
						'review_enable' => array(
							'values' => array(
									'yes' => 'Yes',
									'no' => 'No'
							),
							'default' => 'no',
							'desc' => __( 'Show Review Starts in  meta settings', 'code125-admin' )
						)
				)
			),
			
			
									
			# news_in_photos
			'news_in_photos' => array(
				'name' => 'news_in_photos',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => $post_types,
							'default' => 'post',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'numberposts' => array(
							'values' => array(
									'3' => '3',
									'4' => '4',
									'5' => '5',
									'6' => '6',
									'7' => '7',
									'8' => '8',
									'9' => '9',
									'10' => '10',
									'11' => '11',
									'12' => '12',
									'13' => '13',
									'14' => '14',
									'15' => '15',
									'16' => '16',
									'17' => '17',
									'18' => '18'
							),
							'default' => '12',
							'desc' => __( 'Number of Posts Per page', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						)
				)
			),
			
			
			# 4col_posts
			'4col_posts' => array(
				'name' => '4col_posts',
				'type' => 'wrap',
				'atts' => array(
						'type' => array(
							'values' => $post_types,
							'default' => 'post',
							'desc' => __( 'Post Type', 'code125-admin' )
						),
						'category' => array(
							'values' => $cat_array ,
							'default' => '',
							'desc' => __( 'Category ID', 'code125-admin' )
						),
						'title' => array(
							'values' => array(),
							'default' => 'Latest Projects',
							'desc' => __( 'Title', 'code125-admin' )
						),
						'order' => array(
							'values' => array(
									'ASC' => 'Ascending',
									'DESC' => 'Descending'
							),
							'default' => 'DESC',
							'desc' => __( 'Order Direction', 'code125-admin' )
						),
						'orderby' => array(
							'values' => array(
									'none' => 'None',
									'id' => 'Post ID',
									'author' => 'Author',
									'title' => 'Title',
									'date' => 'Date Created',
									'modified' => 'Date Modified',
									'parent' => 'Post/Page Parent ID',
									'rand' => 'Random',
									'comment_count' => 'Number of Comments',
									'menu_order' => 'Page Order',
									'meta_value_num' => 'Meta Value Based'
							),
							'default' => 'date',
							'desc' => __( 'Order By', 'code125-admin' )
						),
						'meta_key' => array(
							'values' => array(
									'post_views_count' => 'Views Count',
									'votes_count' => 'Likes Count',
									'rating_average'=> 'Rating Average'
							),
							'default' => 'post_views_count',
							'desc' => __( 'Meta Value', 'code125-admin' )
						)
				)
			),
			# testimonials
			'testimonials' => array(
				'name' => 'testimonials',
				'type' => 'wrap',
				'atts' => array(
						'title' => array(
							'values' => array(),
							'default' => 'Testimonials',
							'desc' => __( 'Title', 'code125-admin' )
						),
						'posts_per_page' => array(
							'values' => array(),
							'default' => '8',
							'desc' => __( 'Number of  testimonials', 'code125-admin' )
						)
				)
			),
	
			'posts-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
			'social-shortcodes-open' => array(
				'name' => __( 'Social', 'code125-admin' ),
				'type' => 'opengroup'
			),
			
			
			
			# social_bar
			'social_bar' => array(
				'name' => 'social_bar',
				'type' => 'wrap',
				'atts' => array()
			),
			# social_box
			'social_box' => array(
				'name' => 'social_box',
				'type' => 'wrap',
				'atts' => array()
			),
			# twitter
			'twitter' => array(
				'name' => 'twitter',
				'type' => 'wrap',
				'atts' => array(
					'consumerkey' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Consumer key', 'code125-admin' )
					),
					'consumersecret' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Consumer Secret Key', 'code125-admin' )
					),
					'accesstoken' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Accesstoken', 'code125-admin' )
					),
					'accesstokensecret' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Accesstoken Secret', 'code125-admin' )
					),
					'cachetime' => array(
						'values' => array(),
						'default' => '1',
						'desc' => __( 'Cache time in Hours', 'code125-admin' )
					),
					'username' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Username', 'code125-admin' )
					),
					'count' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Number of Tweets "Max 10"', 'code125-admin' )
					)
				)
			),
			
			
			
			
			# flickr
			'flickr' => array(
				'name' => 'flickr',
				'type' => 'wrap',
				'atts' => array(
					'id' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'The ID of the Photostream', 'code125-admin' )
					),
					'count' => array(
						'values' => array() ,
						'default' => '9',
						'desc' => __( 'Number of Images', 'code125-admin' )
					)
				)
			),
			
			
			
			# googlemap
			'googlemap' => array(
				'name' => 'googlemap',
				'type' => 'wrap',
				'atts' => array(
						'lat' => array(
							'values' => array() ,
							'default' => '',
							'desc' => __( 'Latitude', 'code125-admin' )
						),
						'lon' => array(
							'values' => array() ,
							'default' => '',
							'desc' => __( 'Longtitude', 'code125-admin' )
						),
						'z' => array(
							'values' => array() ,
							'default' => '',
							'desc' => __( 'Zoom "number from 1 with step 1"', 'code125-admin' )
						),
						'h' => array(
							'values' => array() ,
							'default' => '',
							'desc' => __( 'Height', 'code125-admin' )
						),
						'w' => array(
							'values' => array() ,
							'default' => '',
							'desc' => __( 'Width', 'code125-admin' )
						)
						
						
				)
			),
			
			# youtube
			'youtube' => array(
				'name' => 'youtube',
				'type' => 'wrap',
				'atts' => array(
				
					'id' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'The ID of the Video', 'code125-admin' )
					),
					'width' => array(
						'values' => array() ,
						'default' => '100%',
						'desc' => __( 'Width', 'code125-admin' )
					),
					'height' => array(
						'values' => array() ,
						'default' => '300px',
						'desc' => __( 'Height', 'code125-admin' )
					)
				)
			),
			
			# vimeo
			'vimeo' => array(
				'name' => 'vimeo',
				'type' => 'wrap',
				'atts' => array(
					'clip_id' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'The ID of the Video', 'code125-admin' )
					),
					'width' => array(
						'values' => array() ,
						'default' => '100%',
						'desc' => __( 'Width', 'code125-admin' )
					),
					'height' => array(
						'values' => array() ,
						'default' => '300px',
						'desc' => __( 'Height', 'code125-admin' )
					)
				
				)
			),
			
			# dailymotion
			'dailymotion' => array(
				'name' => 'dailymotion',
				'type' => 'wrap',
				'atts' => array(
					'id' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'The ID of the Video', 'code125-admin' )
					),
					'width' => array(
						'values' => array() ,
						'default' => '100%',
						'desc' => __( 'Width', 'code125-admin' )
					),
					'height' => array(
						'values' => array() ,
						'default' => '300px',
						'desc' => __( 'Height', 'code125-admin' )
					)
				)
			),
			
			# video
			'video' => array(
				'name' => 'video',
				'type' => 'wrap',
				'atts' => array(
					'src' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'The Source of the Video', 'code125-admin' )
					),
					'width' => array(
						'values' => array() ,
						'default' => '100%',
						'desc' => __( 'Width', 'code125-admin' )
					),
					'height' => array(
						'values' => array() ,
						'default' => '300px',
						'desc' => __( 'Height', 'code125-admin' )
					)
				)
			),
			
			# video5
			'video5' => array(
				'name' => 'video5',
				'type' => 'wrap',
				'atts' => array(
					'src' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'The Source of the Video', 'code125-admin' )
					),
					'width' => array(
						'values' => array() ,
						'default' => '100%',
						'desc' => __( 'Width', 'code125-admin' )
					),
					'height' => array(
						'values' => array() ,
						'default' => '300px',
						'desc' => __( 'Height', 'code125-admin' )
					)
				)
			),
			
			# audio
			'audio' => array(
				'name' => 'audio',
				'type' => 'wrap',
				'atts' => array(
					'src' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'The Source of the audio', 'code125-admin' )
					)
				
				
				)
			),
			# soundcloud
			'soundcloud' => array(
				'name' => 'soundcloud',
				'type' => 'wrap',
				'atts' => array(
					'id' => array(
						'values' => array() ,
						'default' => '',
						'desc' => __( 'Track ID', 'code125-admin' )
					)
				
				
				)
			),
			
			# basic shortcodes - end
			'social-shortcodes-close' => array(
				'type' => 'closegroup'
			),
			
			
			
			'ads-shortcodes-open' => array(
				'name' => __( 'Ads', 'code125-admin' ),
				'type' => 'opengroup'
			),
			
			# ad_728x90
			'ad_728x90' => array(
				'name' => 'ad_728x90',
				'type' => 'wrap',
				'atts' => array(),
				'content' => ' '
				
			),
			
			
			# ad_468x60
			'ad_468x60' => array(
				'name' => 'ad_468x60',
				'type' => 'wrap',
				'atts' => array(),
				'content' => ' '
				
			),
			
			# ad_300x250
			'ad_300x250' => array(
				'name' => 'ad_300x250',
				'type' => 'wrap',
				'atts' => array(),
				'content' => ' '
				
			),
			# ad_300x250
			'ad_300x250' => array(
				'name' => 'ad_300x250',
				'type' => 'wrap',
				'atts' => array(),
				'content' => ' '
				
			),
			# ad_300x50
			'ad_300x50' => array(
				'name' => 'ad_300x50',
				'type' => 'wrap',
				'atts' => array(),
				'content' => ' '
				
			),
			
			
			# basic shortcodes - end
			'ads-shortcodes-close' => array(
				'type' => 'closegroup'
			)
			
	);
		$skin= get_page_parameter('skin_default','',false);
		$skin_data = code125_get_skin($skin);
		$primary_color=  $skin_data['primary_color'];
		
		if(isset( $_POST['primary_color']) ){
			$primary_color=$_POST['primary_color'];
		}
		$GLOBALS['primary_color'] = $primary_color;
		
	

		
		update_option('_code125_shortcodes' , $shortcodes);
		
		
	}
	
	add_action('init' , 'register_c5_shortcodes' , 999);

?>