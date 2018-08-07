<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php
	if ( have_comments() ){
		/*---------------------------------------------------------------------------
			Comment Title
		---------------------------------------------------------------------------*/
		?>
		<h2 class="comments-title">
			<?php
			printf(
				_n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'twentytwelve' ),
				number_format_i18n( get_comments_number() ),
				'<span>' . get_the_title() . '</span>'
			);
			?>
		</h2>
		
		<?php
		/*---------------------------------------------------------------------------
			Comment List
		---------------------------------------------------------------------------*/
		?>
		<ol class="commentlist">
			<?php
			$comment_list_args = array(
				'callback' => 'potenza_twentytwelve_comment',
				'style'    => 'ol'
			);
			wp_list_comments( $comment_list_args );
			?>
		</ol><!-- .commentlist -->

		<?php
		/*---------------------------------------------------------------------------
			Comment Navigation
		---------------------------------------------------------------------------*/
		// are there comments to navigate through
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ){
			?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'twentytwelve' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentytwelve' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentytwelve' ) ); ?></div>
			</nav>
			<?php
		}
		// check for comment navigation
		
		/*---------------------------------------------------------------------------
			Comments Closed Notice
		---------------------------------------------------------------------------*/
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ){
			?>
			<p class="nocomments"><?php _e( 'Comments are closed.' , 'twentytwelve' ); ?></p>
			<?php
		}
		?>

		<?php
	}
	// have_comments()
	
	/*---------------------------------------------------------------------------
		Comments Closed Notice
	---------------------------------------------------------------------------*/
	$comment_form_args = array(
		'title_reply' => 'Leave A Comment',
	);
	comment_form( $comment_form_args );
	?>

</div><!-- #comments .comments-area -->