<nav id="footer-navigation" class="footer-navigation" role="navigation">
	<?php
	$footer_nav_args = array(
		'theme_location' => 'footer',
		'menu_class'     => 'footer-nav-menu',
		'depth'          => 1,
	);
	wp_nav_menu( $footer_nav_args );
	?>
</nav><!-- #site-navigation -->