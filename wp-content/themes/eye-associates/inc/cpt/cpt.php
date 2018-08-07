<?php
/******************************************************
 *  
 *  @Include CPT Core
 *  @This fle contains class to register new Custom Post Type.
 *  
 ******************************************************/
include( 'core/sd_register_post_type.1.3.php' );

/******************************************************
 *  
 *  @Include CPTs containing CPT registration & other settings
 *  @Each files contains CPT registration code using CPT Core and other settings for the CPTs.
 *  
 ******************************************************/
include( 'cpts/doctors.php' );
include( 'cpts/staff.php' );
include( 'cpts/location.php' );

// include( 'cpts/slider.php' );
// include( 'cpts/resource.php' );
// include( 'cpts/news.php' );
// include( 'cpts/results.php' );
?>