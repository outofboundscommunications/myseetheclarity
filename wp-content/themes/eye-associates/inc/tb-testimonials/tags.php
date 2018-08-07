<?php 
/*----------------------------------------------------------------------------------
	Add Testimonial Tags
----------------------------------------------------------------------------------*/
class MyTbTestimonialTags
{
    /*-----------------------------------------------------------------------------
		init tb-testimonial template function
    -----------------------------------------------------------------------------*/
    public function __construct(){
        add_action( 'tbt_template_functions', array( $this, 'add_tags_to_tbtestimonials' ) );
    }

    /*-----------------------------------------------------------------------------
		add variables
		@param mixed $twig
    -----------------------------------------------------------------------------*/
    public function add_tags_to_tbtestimonials( $twig ){
        // $twig->addGlobal( 'foobar',      call_user_func( 'MyTbTestimonialTags::foobar_func' ) );
        // $twig->addGlobal( 'author_location',  call_user_func( 'MyTbTestimonialTags::author_location_func' ) );
        // $twig->addGlobal( 'author_image',     call_user_func( 'MyTbTestimonialTags::author_image_func' ) );
        // $twig->addGlobal( 'testimonial_date', call_user_func( 'MyTbTestimonialTags::date_func' ) );
		// $twig->addGlobal( 'ea_content', call_user_func( 'MyTbTestimonialTags::ea_content_func' ) );
    }

    /*-----------------------------------------------------------------------------
		static callback function
    -----------------------------------------------------------------------------*/
    public static function foobar_func(){
		return 'Testimonial ID: ' . get_the_ID();
        // return spritnf( 'Testimonial[%d]', get_the_ID() );
    }
	public static function author_location_func(){
		$author_location = get_field('author_location');
		if( $author_location ){
			return $author_location;
		}
		return false;
	}
	public static function author_image_func(){
		$author_img = get_field('author_image');
		
		if( $author_img ){
			$author_img_src    = $author_img['sizes']['testimonial_small'];
			$author_img_width  = $author_img['sizes']['testimonial_small-width'];
			$author_img_height = $author_img['sizes']['testimonial_small-height'];
		}else{
			$author_img_src    = THESIS_USER_SKINS_URL . '/isg/images/no_image-87x75.jpg';
			$author_img_width  = 87;
			$author_img_height = 75;
		}
		$image_return = '<img width="'.$author_img_width.'" height="'.$author_img_height.'" class="avatar photo" src="'.$author_img_src.'" alt="">';
		return $image_return;
	}
	public static function date_func(){
		$testimonial_date = get_the_date( 'j.n.Y' );
		return $testimonial_date;
	}
	public static function ea_content_func(){
		$testimonial_content = get_the_content();
		return $testimonial_content;
	}
}

$instance = new MyTbTestimonialTags();
?>