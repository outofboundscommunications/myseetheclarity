<?php
/**
 * function: code125_get_size_array
 *
 * @param none
 * @return array of the image sizes you register to use
 */
function register_c5_images_theme() {
	$images_size_array=array(
		
		array(
		   'slug' => 'large',
		   'width' => 640,
		   'height' => 640,
		   'crop' => true,
		),
		array(
		   'slug' => 'medium',
		   'width' => 300,
		   'height' => 300,
		   'crop' => true,
		),
		array(
		   'slug' => 'thumbnail',
		   'width' => 150,
		   'height' => 150,
		   'crop' => true,
		),
		array(
		   'slug' => 'blog-post-thumb',
		   'width' => 640,
		   'height' => 300,
		   'crop' => true,
		),
		array(
		   'slug' => 'blog-post-ajax',
		   'width' => 400,
		   'height' => 9999,
		   'crop' => false,
		),
		array(
		   'slug' => 'blog-post-thumb-inside',
		   'width' => 640,
		   'height' => 9999,
		   'crop' => false,
		),
		array(
		   'slug' => 'blog-post-thumb-680',
		   'width' => 690,
		   'height' => 9999,
		   'crop' => false,
		),
		array(
		   'slug' => 'portfolio-post-thumb-inside',
		   'width' => 960,
		   'height' => 9999,
		   'crop' => false,
		)
		
		
		
		,
		array(
		   'slug' => 'slide',
		   'width' => 960,
		   'height' => 400,
		   'crop' => true,
		),
		array(
		   'slug' => 'slide-half',
		   'width' => 480,
		   'height' => 400,
		   'crop' => true,
		)
		
		
		,
		array(
		   'slug' => 'mixed-size-1',
		   'width' => 480,
		   'height' => 480,
		   'crop' => true,
		),
		array(
		   'slug' => 'mixed-size-2',
		   'width' => 480,
		   'height' => 240,
		   'crop' => true,
		),
		array(
		   'slug' => 'mixed-size-3',
		   'width' => 240,
		   'height' => 480,
		   'crop' => true,
		),
		array(
		   'slug' => 'mixed-size-4',
		   'width' => 240,
		   'height' => 240,
		   'crop' => true,
		),
		
		
		array(
		   'slug' => '85_85',
		   'width' => 85,
		   'height' => 85,
		   'crop' => true,
		),
		array(
		   'slug' => '60_60',
		   'width' => 60,
		   'height' => 60,
		   'crop' => true,
		)
		
		
		,
		array(
		   'slug' => '58x58',
		   'width' => 58,
		   'height' => 58,
		   'crop' => true,
		),
		array(
		   'slug' => '72x72',
		   'width' => 72,
		   'height' => 72,
		   'crop' => true,
		),
		array(
		   'slug' => '114x114',
		   'width' => 114,
		   'height' => 114,
		   'crop' => true,
		),
		array(
		   'slug' => '16x16',
		   'width' => 16,
		   'height' => 16,
		   'crop' => true,
		),
		array(
		   'slug' => '32x32',
		   'width' => 32,
		   'height' => 32,
		   'crop' => true,
		),
		array(
		   'slug' => '24x24',
		   'width' => 24,
		   'height' => 24,
		   'crop' => true,
		),
		array(
		   'slug' => '48x48',
		   'width' => 48,
		   'height' => 48,
		   'crop' => true,
		),
		array(
		   'slug' => '64x64',
		   'width' => 64,
		   'height' => 64,
		   'crop' => true,
		),
		array(
		   'slug' => '128x128',
		   'width' => 128,
		   'height' => 128,
		   'crop' => true,
		),
		array(
		   'slug' => '256x256',
		   'width' => 256,
		   'height' => 256,
		   'crop' => true,
		),
		array(
		   'slug' => '512x512',
		   'width' => 512,
		   'height' => 512,
		   'crop' => true,
		),
		array(
		   'slug' => '100x100',
		   'width' => 100,
		   'height' => 100,
		   'crop' => true,
		)
		
		
		
		,
		array(
		   'slug' => 'height_20',
		   'width' => 9999,
		   'height' => 18,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_30',
		   'width' => 9999,
		   'height' => 30,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_40',
		   'width' => 9999,
		   'height' => 40,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_50',
		   'width' => 9999,
		   'height' => 50,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_60',
		   'width' => 9999,
		   'height' => 60,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_70',
		   'width' => 9999,
		   'height' => 70,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_80',
		   'width' => 9999,
		   'height' => 80,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_90',
		   'width' => 9999,
		   'height' => 90,
		   'crop' => false,
		),
		array(
		   'slug' => 'height_100',
		   'width' => 9999,
		   'height' => 100,
		   'crop' => false,
		)
		
		,
		array(
		   'slug' => '1-col',
		   'width' => 550,
		   'height' => 250,
		   'crop' => true,
		),
		array(
		   'slug' => '4-col',
		   'width' => 225,
		   'height' => 170,
		   'crop' => true,
		),
		array(
		   'slug' => '4-col-s',
		   'width' => 225,
		   'height' => 225,
		   'crop' => true,
		),
		array(
		   'slug' => '4-col-o',
		   'width' => 238,
		   'height' => 238,
		   'crop' => true,
		),
		array(
		   'slug' => '4-col-flexible',
		   'width' => 225,
		   'height' => 9999,
		   'crop' => false,
		)
		
		,
		array(
		   'slug' => '3-col',
		   'width' => 300,
		   'height' => 225,
		   'crop' => true,
		),
		array(
		   'slug' => '3-col-s',
		   'width' => 300,
		   'height' => 300,
		   'crop' => true,
		),
		array(
		   'slug' => '3-col-o',
		   'width' => 318,
		   'height' => 318,
		   'crop' => true,
		),
		array(
		   'slug' => '3-col-flexible',
		   'width' => 300,
		   'height' => 9999,
		   'crop' => false,
		),
		array(
		   'slug' => '3-col-cat',
		   'width' => 310,
		   'height' => 150,
		   'crop' => true,
		)
		
		
		,
		array(
		   'slug' => '5-col',
		   'width' => 172,
		   'height' => 130,
		   'crop' => true,
		),
		array(
		   'slug' => '5-col-s',
		   'width' => 172,
		   'height' => 172,
		   'crop' => true,
		),
		array(
		   'slug' => '5-col-o',
		   'width' => 190,
		   'height' => 190,
		   'crop' => true,
		),
		array(
		   'slug' => '5-col-flexible',
		   'width' => 172,
		   'height' => 9999,
		   'crop' => false,
		),
		array(
		   'slug' => '5-col-metro-1',
		   'width' => 382,
		   'height' => 382,
		   'crop' => true,
		),
		array(
		   'slug' => '5-col-metro-2',
		   'width' => 382,
		   'height' => 190,
		   'crop' => true,
		),
		array(
		   'slug' => '5-col-metro-3',
		   'width' => 190,
		   'height' => 382,
		   'crop' => true,
		)
		
		
		,
		array(
		   'slug' => '6-col',
		   'width' => 140,
		   'height' => 105,
		   'crop' => true,
		),
		array(
		   'slug' => '6-col-s',
		   'width' => 140,
		   'height' => 140,
		   'crop' => true,
		),
		array(
		   'slug' => '6-col-o',
		   'width' => 158,
		   'height' => 158,
		   'crop' => true,
		),
		array(
		   'slug' => '6-col-flexible',
		   'width' => 140,
		   'height' => 9999,
		   'crop' => false,
		)
	);
	
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
	if(  is_plugin_active('c5-image/wp-image.php') ){ 
	
		foreach ($images_size_array as $image ) {
			code125_add_image_size($image['slug'] , $image['width'] , $image['height'], $image['crop']);
		}
	
	}else {
		foreach ($images_size_array as $image ) {
			add_image_size($image['slug'] , $image['width'] , $image['height'], $image['crop']);
		}
	}
	
}

add_action('init' , 'register_c5_images_theme');

?>