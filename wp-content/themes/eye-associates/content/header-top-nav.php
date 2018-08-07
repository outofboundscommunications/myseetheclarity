<nav id="site-navigation" class="main-navigation hidden-xs hidden-sm hidden-md hidden-lg" role="navigation">
     
		<?php
		$primary_nav_args = array(
			'theme_location'  => 'primary',
			'menu_class'      => 'nav-menu',
			'menu_id'         => 'menu-primary-menu',
			'container_id'    => 'menu-primary-menu-container',
			'container_class' => 'collapse navbar-collapse',
		);
		wp_nav_menu( $primary_nav_args );
		?>
  
</nav><!-- #site-navigation -->
<!--11-08-17-->
<!--div id="slicknav_menu" class="visible-xs visible-sm"></div-->
<div id="slicknav_menu" class="hidden-xs hidden-sm"></div>