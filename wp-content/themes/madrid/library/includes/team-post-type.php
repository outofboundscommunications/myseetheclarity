<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function team_post_example() { 
	
	
	
	register_post_type( 'team', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Team Members', 'code125'), /* This is the Title of the Group */
			'singular_name' => __('Team Member', 'code125'), /* This is the individual type */
			'all_items' => __('All Team Members', 'code125'), /* the all items menu item */
			'add_new' => __('Add New Member', 'code125'), /* The add new menu item */
			'add_new_item' => __('Add New Team Member', 'code125'), /* Add New Display Title */
			'edit' => __( 'Edit', 'code125' ), /* Edit Dialog */
			'edit_item' => __('Edit Team Member', 'code125'), /* Edit Display Title */
			'new_item' => __('New Team Member', 'code125'), /* New Display Title */
			'view_item' => __('View Team Member', 'code125'), /* View Display Title */
			'search_items' => __('Search Team Members', 'code125'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'code125'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'code125'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Team', 'code125' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_template_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'team', 'with_front' => false ), /* you can specify it's url slug */
			'has_archive' => 'team', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'  , 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	
	register_post_type( 'header', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Header Templates', 'code125'), /* This is the Title of the Group */
			'singular_name' => __('Header Template', 'code125'), /* This is the individual type */
			'all_items' => __('All  Templates', 'code125'), /* the all items menu item */
			'add_new' => __('Add New Template', 'code125'), /* The add new menu item */
			'add_new_item' => __('Add New Header Template', 'code125'), /* Add New Display Title */
			'edit' => __( 'Edit', 'code125' ), /* Edit Dialog */
			'edit_item' => __('Edit Header Template', 'code125'), /* Edit Display Title */
			'new_item' => __('New Header Template', 'code125'), /* New Display Title */
			'view_item' => __('View Header Template', 'code125'), /* View Display Title */
			'search_items' => __('Search Header Templates', 'code125'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'code125'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'code125'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Team', 'code125' ), /* Custom Type Description */
			'public' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 30, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_template_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'header', 'with_front' => false ), /* you can specify it's url slug */
			'has_archive' => 'header', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title')
	 	) /* end of options */
	); /* end of register post type */
	
	register_post_type( 'skin', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Skins Templates', 'code125'), /* This is the Title of the Group */
			'singular_name' => __('Skins Template', 'code125'), /* This is the individual type */
			'all_items' => __('All  Skins', 'code125'), /* the all items menu item */
			'add_new' => __('Add New Skin', 'code125'), /* The add new menu item */
			'add_new_item' => __('Add New Skins Template', 'code125'), /* Add New Display Title */
			'edit' => __( 'Edit', 'code125' ), /* Edit Dialog */
			'edit_item' => __('Edit Skin Template', 'code125'), /* Edit Display Title */
			'new_item' => __('New Skin Template', 'code125'), /* New Display Title */
			'view_item' => __('View Skin Template', 'code125'), /* View Display Title */
			'search_items' => __('Search Skins Templates', 'code125'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'code125'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'code125'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Team', 'code125' ), /* Custom Type Description */
			'public' => false,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 40, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_template_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'skin', 'with_front' => false ), /* you can specify it's url slug */
			'has_archive' => 'skin', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title')
	 	) /* end of options */
	); /* end of register post type */
	
	
	$custom_posts = ot_get_option('custom_posts', array());
	
	    if ($custom_posts) {
	        foreach ($custom_posts as $custom_post) {
	           
	            register_post_type( $custom_post['slug'], /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	             	// let's now add all the options for this post type
	            	array('labels' => array(
	            		'name' => $custom_post['title'], /* This is the Title of the Group */
	            		'singular_name' => __( $custom_post['title'] .' Item', 'code125'), /* This is the individual type */
	            		'all_items' => __('All '.$custom_post['title'] .' Items', 'code125'), /* the all items menu item */
	            		'add_new' => __('Add New Item', 'code125'), /* The add new menu item */
	            		'add_new_item' => __('Add New '.$custom_post['title'] .' Item', 'code125'), /* Add New Display Title */
	            		'edit' => __( 'Edit', 'code125' ), /* Edit Dialog */
	            		'edit_item' => __('Edit '.$custom_post['title'] .' Item', 'code125'), /* Edit Display Title */
	            		'new_item' => __('New '.$custom_post['title'] .' Item', 'code125'), /* New Display Title */
	            		'view_item' => __('View '.$custom_post['title'] .' Item', 'code125'), /* View Display Title */
	            		'search_items' => __('Search '.$custom_post['title'] .' Items', 'code125'), /* Search Custom Type Title */ 
	            		'not_found' =>  __('Nothing found in the Database.', 'code125'), /* This displays if there are no entries yet */ 
	            		'not_found_in_trash' => __('Nothing found in Trash', 'code125'), /* This displays if there is nothing in the trash */
	            		'parent_item_colon' => ''
	            		), /* end of arrays */
	            		'description' => __( 'This is the example '.$custom_post['title'] , 'code125' ), /* Custom Type Description */
	            		'public' => true,
	            		'publicly_queryable' => true,
	            		'exclude_from_search' => false,
	            		'show_ui' => true,
	            		'query_var' => true,
	            		'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
	            		'menu_icon' => get_template_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
	            		'rewrite'	=> array( 'slug' => $custom_post['slug'], 'with_front' => false ), /* you can specify it's url slug */
	            		'has_archive' => 'team', /* you can rename the slug here */
	            		'capability_type' => 'post',
	            		'hierarchical' => false,
	            		/* the next one is important, it tells what's enabled in the post editor */
	            		'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'  , 'sticky')
	             	) /* end of options */
	            ); /* end of register post type */
	            if($custom_post['category']!= ''){
	            register_taxonomy( $custom_post['category'], 
	            	array($custom_post['slug']), /* if you change the name of register_post_type( 'team', then you have to change this */
	            	array('hierarchical' => true,     /* if this is true it acts like categories */             
	            		'labels' => array(
	            			'name' => $custom_post['category_name'], /* name of the custom taxonomy */
	            			'singular_name' =>$custom_post['category_name'], /* single taxonomy name */
	            			'search_items' =>  __( 'Search '.$custom_post['category_name'], 'code125' ), /* search title for taxomony */
	            			'all_items' => __( 'All '.$custom_post['category_name'], 'code125' ), /* all title for taxonomies */
	            			'parent_item' => __( 'Parent '.$custom_post['category_name'], 'code125' ), /* parent title for taxonomy */
	            			'parent_item_colon' => __( 'Parent '.$custom_post['category_name'].':', 'code125' ), /* parent taxonomy title */
	            			'edit_item' => __( 'Edit '.$custom_post['category_name'], 'code125' ), /* edit custom taxonomy title */
	            			'update_item' => __( 'Update '.$custom_post['category_name'], 'code125' ), /* update title for taxonomy */
	            			'add_new_item' => __( 'Add New '.$custom_post['category_name'], 'code125' ), /* add new title for taxonomy */
	            			'new_item_name' => __( 'New '.$custom_post['category_name'].' Name', 'code125' ) /* name title for taxonomy */
	            		),
	            		'show_ui' => true,
	            		'query_var' => true,
	            	)
	            ); 
	            }
	            
	            
	        }
	    }
	
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'team_post_example');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'hierarchy', 
    	array('team'), /* if you change the name of register_post_type( 'team', then you have to change this */
    	array('hierarchical' => true,     /* if this is true it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Hierarchy', 'code125' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Hierarchy', 'code125' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Hierarchy', 'code125' ), /* search title for taxomony */
    			'all_items' => __( 'All Hierarchies', 'code125' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Hierarchy', 'code125' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Hierarchy:', 'code125' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Hierarchy', 'code125' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Hierarchy', 'code125' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Hierarchy', 'code125' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Hierarchy Name', 'code125' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
    
    
      
    
	
	

?>