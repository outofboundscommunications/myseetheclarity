<?php if ( ! defined( 'OT_VERSION') ) exit( 'No direct script access allowed' );
/**
 * Builds the Setting & Documentation UI.
 *
 * @uses      ot_register_settings()
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2012, Derek Herman
 */
if ( function_exists( 'ot_register_settings' ) ) {

  ot_register_settings( array(
      array(
        'id'                  => 'option_tree_export',
        'pages'               => array( 
          array(
            'id'              => 'option_tree_export',
            'parent_slug'     => apply_filters( 'ot_theme_options_parent_slug', 'themes.php' ),
            'page_title'      => apply_filters( 'ot_theme_options_page_title', 'Import/Export Options' ),
            'menu_title'      => apply_filters( 'ot_theme_options_menu_title', 'Import/Export Options' ),
            'capability'      => apply_filters( 'ot_theme_options_capability', 'edit_theme_options' ),
            'menu_slug'       => 'ot-settings',
            'icon_url'        => apply_filters( 'ot_theme_options_icon_url', null ),
            'position'        => apply_filters( 'ot_theme_options_position', null ),
            'updated_message' => apply_filters( 'ot_theme_options_updated_message', __( 'Theme Options updated.', 'option-tree' ) ),
            'reset_message'   => apply_filters( 'ot_theme_options_reset_message', __( 'Theme Options reset.', 'option-tree' ) ),
            'button_text'     => apply_filters( 'ot_theme_options_button_text', __( 'Save Changes', 'option-tree' ) ),
            'screen_icon'     => 'themes',
            'contextual_help' => '',
            'sections'        => array(
              array(
                'id'          => 'import',
                'title'       => __( 'Import', 'option-tree' )
              ),
              array(
                'id'          => 'export',
                'title'       => __( 'Export', 'option-tree' )
              )
            ),
            'settings'        => array(
              array(
                'id'          => 'import_data_text',
                'label'       => __( 'Theme Options', 'option-tree' ),
                'type'        => 'import-data',
                'section'     => 'import'
              ),
              array(
                'id'          => 'export_data_text',
                'label'       => __( 'Theme Options', 'option-tree' ),
                'type'        => 'export-data',
                'section'     => 'export'
              )
            )
          )
        )
      )
    ) 
  );
  
    
 
}

/* End of file ot-ui-admin.php */
/* Location: ./option-tree/ot-ui-admin.php */