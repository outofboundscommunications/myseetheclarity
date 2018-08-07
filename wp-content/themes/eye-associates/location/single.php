<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	
	<div class="main_header">
		<header class="page-header">
				
			<div class="page-header-wrapper">
				<?php get_template_part( 'content/content', 'page-header' );?>
			</div>
			
			<div class="header-submenu-wrapper">
				<?php get_template_part( 'content/content', 'top-nav-sub' );?>
			</div>
			
		</header><!-- .page-header -->
	</div><!-- .main_header -->
	
	<div class="main_content">
		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content/content', 'location_single' ); ?>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .main_content -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>