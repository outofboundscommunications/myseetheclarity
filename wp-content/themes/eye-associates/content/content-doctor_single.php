<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="entry-content">
			<div class="content-container" style="background-color:#F9F7F7; ">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
							<?php
							$default_attr = array(
								'class'	=> "alignleft single-doctor-image img-round",
							);
							the_post_thumbnail('doctor_home', $default_attr);
							?>
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
						</div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .content-container -->
		</div><!-- .entry-content -->
		
	</article><!-- #post -->
