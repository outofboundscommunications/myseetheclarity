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
		
		<div class="home-locations-wrapper">
			<?php get_template_part( 'content/content', 'home-locations' ); ?>
		</div>
		
		<div class="home-circles-wrapper">
			<?php get_template_part( 'content/content', 'home-circles' ); ?>
		</div>
		
		<div class="home-doctors-wrapper">
			<?php get_template_part( 'content/content', 'home-doctors' ); ?>
		</div>
		
	</article><!-- #post -->
