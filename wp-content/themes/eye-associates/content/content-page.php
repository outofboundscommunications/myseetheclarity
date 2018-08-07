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
		
		<div class="entry-content">
			<?php
			$page_content_editor_type = get_field('page_content_editor_type');
			if( !$page_content_editor_type ){
				$page_content_editor_type = 'default';
			}
			if( $page_content_editor_type == 'block' ){
				get_template_part( 'content/page', 'blocks' );
			}else{
				$content = $post->post_content;
				if( has_shortcode( $content, 'container' ) ) {
					the_content();
				}else{
					?>
					<div style="background-color:#F9F7F7;" class="content-container">
						<div class="container ">
							<?php the_content();?>
						</div>
					</div>
					<?php
				}
				?>
				<?php // wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) );?>
				<?php
			}
			?>
		</div><!-- .entry-content -->
		
		<?php /* ?>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		<?php */ ?>
		
	</article><!-- #post -->
