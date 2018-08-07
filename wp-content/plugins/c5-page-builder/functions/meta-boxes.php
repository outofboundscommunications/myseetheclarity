<?php
/**
 * Initialize the meta boxes. 
 */

add_action( 'admin_init', '_custom_meta_boxes_page_builder' );

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
function _custom_meta_boxes_page_builder() {
  
  /**
   * Create a custom meta boxes array that we pass to 
   * the OptionTree Meta Box API Class.
   */
  
    
  $layout_builder = array(
    'id'          => 'meta_layout',
    'title'       => 'Page Options',
    'desc'        => '',
    'pages'       => array( 'page'),
    'context'     => 'normal',
    'priority'    => 'low',
    'fields'      => array(
    array(
      'label'       => 'Use Layout Builder',
      'id'          => 'meta_use_layout_builder',
      'type'        => 'select',
      'desc'        => 'Use the Layout Builder in this page ?,Default: No.',
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
      'label'       => 'Templates',
      'id'          => 'meta_template_id',
      'type'        => 'custom-post-type-select',
      'desc'        => '<p>Choose any template of the available templates or You can Create Templates <a href="'.home_url().'/wp-admin/themes.php?page=aq-page-builder&action=edit&template=0">Here</a></p>',
      'std'         => '',
      'rows'        => '',
      'post_type'   => 'template',
      'taxonomy'    => '',
      'class'       => ''
      
    )
    )
  ); 
  if(function_exists('ot_register_meta_box')){
  	ot_register_meta_box( $layout_builder ); 
  }

}

