<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" class="site-footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-md-4 footer-top-left">
						<div class="footer-social">
							<?php get_template_part( 'content/footer', 'social' ); ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-8 footer-top-right pull-right">
						<div class="footer-top-nav">
							<?php get_template_part( 'content/footer', 'nav' ); ?>
						</div>
					</div>
				</div><!-- .row -->
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-5">
					</div>
					<div class="col-md-2 footer-bottom-column">
						<div class="footer-logo">
							<?php
							$footer_logo_image_data = getimagesize(footer_logo_image());
							?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php echo footer_logo_image();?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" <?php echo $footer_logo_image_data[3];?>/>
							</a>
						</div>
					</div>
					<div class="col-md-5 site-info">
						<div class="site-info-copy pull-right">
							<?php footer_copyright();?>
						</div>
						<div class="site-info-by pull-right">
							Site by <a href="http://www.trilionstudios.com/" target="_blank">TriLion</a> & <a href="http://www.outofboundscommunications.com/" target="_blank">out of bounds comm.</a>
						</div>
					</div><!-- .site-info -->
				</div><!-- .row -->
			</div>
		</div>
	</footer><!-- #colophon -->
	<div class="gototop-wrap" style="display: block;">
		<a id="gotop" href="#" class="gotop">
			<span class="fa fa-chevron-up"></span>
		</a>
	</div>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>