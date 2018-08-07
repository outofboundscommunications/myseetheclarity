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
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-top">
			<div class="container">
				<div class="row-x row">
					<div class="col-md-9-x footer-top-left">
						<div class="footer-phone">
							<a href="tel:<?php site_phone();?>">
								<?php site_phone();?>
							</a>
						</div>
						<div class="footer-top-nav">
							<?php get_template_part( 'content/footer', 'top-nav' ); ?>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="col-md-3-x footer-top-right">
						<div class="site-info">
							<div class="site-info-copy pull-right">
								<?php footer_copyright();?>
							</div>
							<div class="site-info-by pull-right">
								Site by <span>Out of Bounds</span> and <span>TriLion</span>
							</div>
						</div><!-- .site-info -->
					</div>
				</div><!-- .row -->
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row-x row">
					<div class="col-md-12-x footer-bottom-column">
						<div class="footer-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img src="<?php footer_logo_image();?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							</a>
						</div>
						<div class="footer-bottom-nav">
							<?php get_template_part( 'content/footer', 'bottom-nav' ); ?>
						</div>
						<div class="footer-bottom-gotop">
							<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button">
								<?php /*?><span class="glyphicon glyphicon-chevron-up"></span><?php */?>
								<span class="go-top"></span>
							</a>
						</div>
					</div>
				</div><!-- .row -->
			</div>
		</div>
	</footer><!-- #colophon -->
<?php wp_footer(); ?>
</body>
</html>