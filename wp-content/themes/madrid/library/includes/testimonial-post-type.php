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
function testimonial_post_example() { 
	// creating (registering) the custom type 
	
	register_post_type( 'testimonial', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Testimonials', 'code125'), /* This is the Title of the Group */
			'singular_name' => __('Testimonial', 'code125'), /* This is the individual type */
			'all_items' => __('All Testimonials', 'code125'), /* the all items menu item */
			'add_new' => __('Add New Testimonial', 'code125'), /* The add new menu item */
			'add_new_item' => __('Add New Testimonial', 'code125'), /* Add New Display Title */
			'edit' => __( 'Edit', 'code125' ), /* Edit Dialog */
			'edit_item' => __('Edit Testimonial ', 'code125'), /* Edit Display Title */
			'new_item' => __('New Testimonial ', 'code125'), /* New Display Title */
			'view_item' => __('View Testimonial ', 'code125'), /* View Display Title */
			'search_items' => __('Search Testimonials', 'code125'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'code125'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'code125'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is the example Testimonial', 'code125' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_template_directory_uri() . '/library/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'testimonial', 'with_front' => false ), /* you can specify it's url slug */
			'has_archive' => 'testimonial', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'thumbnail')
	 	) /* end of options */
	); /* end of register post type */
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'testimonial_post_example');
	
	

?>