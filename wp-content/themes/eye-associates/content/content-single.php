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
		<?php
		/*
		if ( is_sticky() && is_home() && ! is_paged() ) {
			?>
			<div class="featured-post">
				<?php _e( 'Featured post', 'twentytwelve' ); ?>
			</div>
			<?php
		}
		*/
		?>
		
		<div class="meta-image">
			<a title="<?php echo esc_attr(get_the_title());?>" href="<?php the_permalink(); ?>" rel="bookmark">
				<?php
				if ( ! post_password_required() && ! is_attachment() ) {
					the_post_thumbnail('full',array('class'=>'img-responsive'));
				}
				?>
			</a>
		</div>
		<div class="columns entry-meta">
			<div class="meta-wrapper meta-square">
				<!----------------------------------------------------------------
					Meta Date
				----------------------------------------------------------------->
				<div class="meta-date">
					<div class="meta-outer">
						<div class="meta-inner">
							<span class="date-meta">
								<time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) );?>">
									<span class="date-meta-d"><?php echo esc_attr( get_the_date( 'd' ) );?></span>
									<span class="date-meta-m"><?php echo esc_attr( get_the_date( 'M' ) );?></span>
								</time>
							</span>
						</div>
					</div>
				</div>
				
				<!----------------------------------------------------------------
					Meta Author
				----------------------------------------------------------------->
				<div class="meta-author">
					<div class="meta-outer">
						<div class="meta-inner">
						<?php
							$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
								esc_attr( get_the_author() ),
								esc_attr( get_the_author() )
							);
							echo $author;
							?>
						</div>
					</div>
				</div>
				
				<!----------------------------------------------------------------
					Meta Comments
				----------------------------------------------------------------->
				<div class="meta-comments">
					<div class="meta-outer">
						<div class="meta-inner">
							<a href="<?php comments_link(); ?>">comments</a>
							<?php
							$num_comments = get_comments_number();
							?>
							<span class="ico-comment colored-text"><?php echo $num_comments;?>
								<?php
								if( $num_comments > 999 ){
									?>
									<span class="commentsplus">+</span>
									<?php
								}
								?>
							</span>
						</div>
					</div>
				</div>
				
				<!----------------------------------------------------------------
					Meta Categories/Tags
				----------------------------------------------------------------->
				<div class="meta-cats">
					<div class="meta-outer">
						<div class="meta-inner">
							posted
						</div>
					</div>
					<div class="meta-tooltip">
						<?php
						$cat_tag = 0;
						$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );
						if( $categories_list ){
							$cat_tag++;
							?>
							<span class="meta-title">Posted in</span>
							<p><?php echo $categories_list;?></p>
							<?php
						}
						$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );
						if( $tag_list ){
							$cat_tag++;
							?>
							<span class="meta-title">Tagged with</span>
							<?php
							echo $tag_list;
						}
						if( $cat_tag == 0 ){
							echo '<span>No Categories/Tags</span>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<header class="entry-header">
			<?php
			if ( is_single() ) {
				?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php
			}else{
				?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h1>
				<?php
			}
			// is_single()
			?>
			
		</header><!-- .entry-header -->
		<div class="entry-content-wrapper">
			<?php
			// Only display Excerpts for Search
			if ( is_search() ){
			}else{
			}
			?>
			<div class="entry-content">
				<?php
				// the_excerpt();
				the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) );
				?>
			</div><!-- .entry-content -->
			<div class="clearfix"></div>
		</div>
		
		<footer class="entry-metax">
			<div class="share-buttons">
				<span class='st_facebook_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
				<span st_via='setfinancial' st_username='setfinancial' class='st_twitter_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
				<span class='st_email_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
				<span class='st_sharethis_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
				<span class='st_fblike_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
				<span class='st_plusone_hcount' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>
			</div>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
