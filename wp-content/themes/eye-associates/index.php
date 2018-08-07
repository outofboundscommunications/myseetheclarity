<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
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
			
		</header>
	</div><!-- .main_header -->
	
	<div class="main_content">
		<div class="container">
			<div class="row">
				
				<div id="primary" class="site-content col-sm-12">
					<div id="content" role="main">
						
						<?php
						if ( have_posts() ) {
							
							while ( have_posts() ){
								the_post();
								
								get_template_part( 'content/content', 'blog' );
								
							}
							
							twentytwelve_content_nav( 'nav-below' );
							
						}else{
							
							get_template_part( 'content/content', 'no_posts' );							
						} // end have_posts() check ?>

					</div><!-- #content -->
					<div class="categories">
						<div class="row">
							<div class="col-sm-12">
								<?php
								$args = array(
								  'taxonomy'     => 'category',
								   'title_li' => '<h3>' . __( 'Categories', 'textdomain' ) . '</h3>'
								);
								$tax_terms = wp_list_categories( $args );
								?>

								<br>
								<?php
								$args = array(
									'numberposts' => 5,
									'offset' => 0,
									'category' => 0,
									'orderby' => 'post_date',
									'order' => 'DESC',
									'include' => '',
									'exclude' => '',
									'meta_key' => '',
									'meta_value' =>'',
									'post_type' => 'post',
									'post_status' => 'publish',
									'suppress_filters' => true
								);

								$recent_posts = wp_get_recent_posts( $args, ARRAY_A );
								?>
								<h3>Recent Posts</h3>
								<ul>
									<?php
									foreach ($recent_posts as $recent_post)
									{
									?>
										<li> <a href="<?php echo get_permalink($recent_post["ID"]); ?>"><?php echo $recent_post['post_title']; ?></a></li>
									<?php
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div><!-- #primary -->

				<?php //get_sidebar(); ?>
				
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .main_content -->
<?php get_footer(); ?>