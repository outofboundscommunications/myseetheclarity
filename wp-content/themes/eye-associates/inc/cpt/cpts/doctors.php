<?php
$doctors_cpt_args = array(
	'description'        => 'This Post type contains contain list of doctors.',
	'public'             => true,
	'show_ui'            => true,
	'show_in_menu'       => true,
	'capability_type'    => 'post',
	'hierarchical'       => false,
	'rewrite'            => array(
		'slug'=> 'doctor'
	),
	'query_var'          => true,
	'exclude_from_search'=> true,
	'supports'           => array(
		'title',
		'thumbnail',
		'editor',
		// 'custom-fields',
		// 'page-attributes',
	),
	'exclude_from_search' => true,
	'label'              => 'Doctors',
	'labels'              => array(
		'name'              => _x( 'Doctors', 'twentytwelve' ),
		'singular_name'     => _x( 'Doctor', 'twentytwelve' ),
		'add_new'           => _x( 'Add New', 'twentytwelve' ),
		'add_new_item'      => _x( 'Add New Doctor', 'twentytwelve' ),
		'edit_item'         => _x( 'Edit Doctor', 'twentytwelve' ),
		'new_item'          => _x( 'New Doctor', 'twentytwelve' ),
		'view_item'         => _x( 'View Doctor', 'twentytwelve' ),
		'search_items'      => _x( 'Search Doctor', 'twentytwelve' ),
		'not_found'         => _x( 'No doctor found', 'twentytwelve' ),
		'not_found_in_trash'=> _x( 'No doctor in Trash', 'twentytwelve' ),
		'parent_item_colon' => _x( 'Parent Doctor:', 'twentytwelve' ),
		'menu_name'         => _x( 'Doctors', 'twentytwelve' ),
	),
);
sd_register_post_type( 'doctor', $doctors_cpt_args, 'doctors' );


/******************************************************
 *  
 *  Register Columns for Custom Post Type.
 *  
 ******************************************************/
function doctors_add_column($columns) {
	
	$new_columns = array(
		'cb'                      => '<input type="checkbox" />',
		'doctors_thumbnail'      => __(''),
		'title'                   => __('Title'),
		'date'                    => __('Date'),
	);
	
	return $new_columns;
	
}
add_filter( 'manage_edit-doctor_columns' , 'doctors_add_column');

/******************************************************
 *  
 *  Render data for registered columns.
 *  
 ******************************************************/
function doctors_column( $column_name, $post_id ){
	global $wpdb, $post;
	
	switch ($column_name) {
		
		case 'doctors_thumbnail' :
			if( has_post_thumbnail( $post_id ) ){
				$header_image_size = 'admin_thumb';
				$header_image_data = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $header_image_size );
				$header_image_src = $header_image_data[0];
				$header_image_width = $header_image_data[1];
				$header_image_height = $header_image_data[2];
			}else{
				// $header_image_src = get_stylesheet_directory_uri() . '/assets/images/no-image/no_image_60x60.png';
				// $header_image_width = 60;
				// $header_image_height = 60;
			}
			if( !empty($header_image_src) ){
				?>
				<img src="<?php echo $header_image_src;?>" alt="<?php the_title(); ?>" width="<?php echo $header_image_width;?>" height="<?php echo $header_image_height;?>" />
				<?php
			}
			break;
		
		default:
			break;
		
	} // end switch

}
add_action( 'manage_doctor_posts_custom_column' , 'doctors_column', 10, 2 );
?>