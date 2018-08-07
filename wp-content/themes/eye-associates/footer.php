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
							Web site design by <a href="http://www.trilionstudios.com/" target="_blank">TriLion Studios</a> 
& <a href="http://www.outofboundscommunications.com/" target="_blank">e-commerce marketing</a> by <a href="http://www.outofboundscommunications.com/" target="_blank">Out of Bounds Communications</a>.
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
<?php
$nogtm = false;
if( isset($_GET) && isset($_GET['nogtm']) ){
	$nogtm = true;
}
if( !$nogtm ){
?>
<!-- Google Tag Manager -->
<script>
dataLayer = [];
</script>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-J8HH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-J8HH');</script>
<!-- End Google Tag Manager -->
<?php
}
?>
<script>
jQuery(document).ready(function(){
    jQuery(".mobile-search-btn").click(function(){
        jQuery('.mobile-search-btn').hide();
        jQuery('.mobile-search-submit').show();
    });
	jQuery(document).ready(function($){        
		$('.searchbox').submit(function(e) { // run the submit function, pin an event to it
			var s = $( this ).find(".search-txt").val($.trim($( this ).find(".search-txt").val())); // find the #s, which is the search input id and trim any spaces from the start and end
			if (!s.val()) { // if s has no value, proceed
				e.preventDefault(); // prevent the default submission				
			}
		});
	});
});
</script>
</body>
</html>