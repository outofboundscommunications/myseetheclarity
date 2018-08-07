<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="home-content">
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .home-content -->
		
		<div class="home-carousel-wrapper">
			<?php get_template_part( 'content/content', 'home-carousel' ); ?>
		</div>
		<div class="home-locations-wrapper">
			<?php get_template_part( 'content/content', 'home-locations' ); ?>
		</div>
		<?php /* ?>
		<div class="home-circles-wrapper">
			<?php get_template_part( 'content/content', 'home-circles' ); ?>
		</div>
		<?php */ ?>
		
		<div class="home-reviews-wrapper">
			<?php get_template_part( 'content/content', 'home-reviews' ); ?>
		</div>
		
		<div class="home-promotions-wrapper">
			<?php get_template_part( 'content/content', 'home-promotions' ); ?>
		</div>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			var n, device_type,
				cookies = document.cookie.split(";");
				
			console.log(device_type);
			for (var i = 0; i < cookies.length; i++) {
				n = jQuery.trim(cookies[i].substr(0,cookies[i].indexOf("=")));
				v = cookies[i].substr(cookies[i].indexOf("=")+1);
				if (n === 'device_type'){
					device_type = unescape(v);
				}
			}
			// $device_type = myCoocie('device_type');
			// alert(device_type);
			if( device_type === "mobile") {
				/*
				var elem = document.getElementById("home_doctors_wrap");
				elem.parentNode.removeChild(elem);
				*/
				document.getElementById("home_doctors_wrap").remove();
			}
		});
		</script>
		<?php
		global $device;
		if( $device['device_type'] == 'desktop' || $device['device_type'] == 'tablet' ){
		}
			?>
			<div id="home_doctors_wrap" class="home-doctors-wrapper">
				<?php get_template_part( 'content/content', 'home-doctors' ); ?>
			</div>
			<?php
		?>
		
	</article><!-- #post -->
	<style type="text/css">
	@media screen and (max-device-width: 601px){
		.home-doctors-wrapper{ display: none; }
	}
	</style>