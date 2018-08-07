<?php
/**
 * The template for displaying Search Results pages
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
						?>

						<header class="archive-header search-header">
							<h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
						     <div class="widget_search">
                                <?php get_search_form(); ?>
                            </div>
                        </header>
                       
						<?php
						/* Start the Loop */
							?>
						<?php
						while ( have_posts() ) {
							the_post();
							
							get_template_part( 'content/content', 'search' );
						}
						
						twentytwelve_content_nav( 'nav-below' );
						
					}else{
						?>

						<article id="post-0" class="post no-results not-found">
							<header class="entry-header">
								<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
							</header>

							<div class="entry-content">
								<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
								<?php get_search_form(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post-0 -->

						<?php
					}
					?>

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