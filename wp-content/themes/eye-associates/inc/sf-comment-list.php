<?php
if ( ! function_exists( 'potenza_twentytwelve_comment' ) ):
function potenza_twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ){
		
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
					<?php
					break;
		
		default :
			// Proceed with normal comments.
			
			global $post;
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
					
					<div class="comment_thumb">
						<?php echo get_avatar( $comment, 109 );?>
					</div>
					<div class="comment_data">
					
						<header class="comment-meta comment-author vcard">
							<div class="comment_thumb_small">
								<?php echo get_avatar( $comment, 50 );?>
							</div>
							<?php
							$comment_author = sprintf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
								get_comment_author_link(),
								// If current post author is also comment author, make it known visually.
								( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
							);
							$comment_date = sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
							);
							?>
							<div class="comment_author_date">
								<div class="comment_author"><?php echo $comment_author;?></div>
								<div class="comment_date"><?php echo $comment_date;?></div>
							</div>
							<div class="reply">
								<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<span class="comment-reply-icn fa fa-share"></span><span class="comment-reply-title">Reply</span>', 'twentytwelve' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
							</div><!-- .reply -->
						</header><!-- .comment-meta -->

						<?php
						if ( '0' == $comment->comment_approved ){
							?>
							<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
							<?php
						} ?>

						<section class="comment-content comment">
							<?php comment_text(); ?>
							<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
						</section><!-- .comment-content -->

					</div><!-- .comment_data -->
					<div class="clearfix"></div>
					
				</article><!-- #comment-## -->
				<?php
				break;
	}
	// end comment_type check
}
endif;
?>