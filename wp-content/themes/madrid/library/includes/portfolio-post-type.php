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
function portfolio_post_example() { 
	// creating (registering) the custom type 
	register_post_type( 'portfolio', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Portfolio', 'code125'), /* This is the Title of the Group */
			'singular_name' => __('Portfolio', 'code125'), /* This is the individual type */
			'all_items' => __('All Portfolio items', 'code125'), /* the all items menu item */
			'add_new' => __('Add New', 'code125'), /* The add new menu item */
			'add_new_item' => __('Add New Portfolio item', 'code125'), /* Add New Display Title */
			'edit' => __( 'Edit', 'code125' ), /* Edit Dialog */
			'edit_item' => __('Edit Portfolio item', 'code125'), /* Edit Display Title */
			'new_item' => __('New Portfolio item', 'code125'), /* New Display Title */
			'view_item' => __('View Portfolio item', 'code125'), /* View Display Title */
			'search_items' => __('Search Portfolio', 'code125'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'code125'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'code125'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Portfolio', 'code125' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_template_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'portfolio', 'with_front' => false ), /* you can specify it's url slug */
			'has_archive' => 'portfolio', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'  , 'sticky','post-formats')
	 	) /* end of options */
	); /* end of register post type */
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'portfolio_post_example');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'portfolio_cat', 
    	array('portfolio'), /* if you change the name of register_post_type( 'portfolio', then you have to change this */
    	array('hierarchical' => true,     /* if this is true it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Categories', 'code125' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Category', 'code125' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Categories', 'code125' ), /* search title for taxomony */
    			'all_items' => __( 'All Categories', 'code125' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Category', 'code125' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Category:', 'code125' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Category', 'code125' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Category', 'code125' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Category', 'code125' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Category Name', 'code125' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    );   
    
	// now let's add custom tags (these act like categories)
    register_taxonomy( 'portfolio_tag', 
    	array('portfolio'), /* if you change the name of register_post_type( 'portfolio', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Tags', 'code125' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Tag', 'code125' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Tags', 'code125' ), /* search title for taxomony */
    			'all_items' => __( 'All Tags', 'code125' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Tag', 'code125' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Tag:', 'code125' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Tag', 'code125' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Tag', 'code125' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Tag', 'code125' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Tag Name', 'code125' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

?>