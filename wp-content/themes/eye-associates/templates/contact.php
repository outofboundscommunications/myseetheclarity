<?php
global $device;
/**
 * Template Name: Contact
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>
	
	<div class="main_header">
        <header class="page-header">        
        		<?php get_template_part( 'content/content', 'page-header' );?>
        </header>
    </div>
	<div class="main_content">
	
		<div id="primary" class="site-content">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content/content', 'contact' ); ?>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .main_content -->
	
<?php get_footer(); ?>