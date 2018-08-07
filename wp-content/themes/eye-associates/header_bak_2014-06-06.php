<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1, user-scalable=no" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->


<?php wp_head(); ?>
<!-- Dynamic CSS -->
<?php dynaminc_css($wp_query->post->ID);?>

<!-- Open Graph Tags -->
<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>" />
<meta property="og:url" content="<?php echo esc_url( home_url( '/' ) ); ?>" />
<meta property="og:image" content="" />

<!-- Fav and touch icons -->
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri(); ?>/img/ico/apple-touch-icon-57-precomposed.png">

<?php
$sharethis_publisher_id = get_field('sharethis_publisher_id', 'option');
if( $sharethis_publisher_id ){
	global $wp_version;
	?>
	<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
	<script charset="utf-8" type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
	<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"<?php echo $sharethis_publisher_id;?>"});var st_type="wordpress<?php echo $wp_version;?>";</script>
	<?php
}
/*
$sharethis_script = 'livetest'; // local, dev, live, livetest
if($sharethis_script == 'local' ) {
	?>
	<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
	<script charset="utf-8" type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
	<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"wp.cb8acfc0-cd0f-4b50-90be-8cc880bdbaea"});var st_type="wordpress3.8.3";</script>
	<?php
}
if($sharethis_script == 'dev' ) {
	?>
	<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
	<script charset="utf-8" type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
	<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"wp.9c152403-2888-4603-a091-5e9f08a955c7"});var st_type="wordpress3.8.3";</script>
	<?php
}
if($sharethis_script == 'livetest' ) {
	?>
	<script charset="utf-8" type="text/javascript">var switchTo5x=true;</script>
	<script charset="utf-8" type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
	<script charset="utf-8" type="text/javascript">stLight.options({"publisher":"03e98462-5137-4df1-818c-6e7f2e1dbe92"});var st_type="wordpress3.8.3";</script>
	<?php
}
*/
?>
	
<?php
/*
if ( is_admin_bar_showing() ) {
	?>
	<style>
		#page { top: 28px !important; }
	</style>
	<?php
}
*/
?>
</head>

<body <?php body_class(); ?>>
<?php
/*
$post_id                   = $post->ID;
$page_color                = get_field('page_color', $post_id);
$page_header_default_color = get_field('page_header_default_color', 'option');
if( !$page_color ){
	if( $page_header_default_color ){
		$page_color = $page_header_default_color;
	}else{
		$page_color = 'A5C73C';
	}
}
*/
$header_current_page_id    = $post->ID;
if( is_single() ){
	$current_post_type = get_post_type( $post );
	$cpt_page = get_field('cpt_page_'.$current_post_type, 'option');
	$header_current_page_id = $cpt_page->ID;
}
$header_page_color = get_field('page_color', $header_current_page_id);
if( !$header_page_color ){
	$ancestors = get_ancestors( $header_current_page_id, 'page' );
	if( !empty($ancestors) ){
		$ancestors_id = $ancestors[0];
		$header_ancestor_page_color = get_field('page_color', $ancestors_id);
	}
	$header_page_color_default = get_field('page_header_default_color', 'option');
	
	if( $header_ancestor_page_color ){
		$header_page_color = $header_ancestor_page_color;
	}elseif( $header_page_color_default ){
		$header_page_color = $header_page_color_default;
	}else{
		$header_page_color = '#40a9a9';
	}
}

if( strlen($header_page_color) == 7 && substr($header_page_color, 0, 1) == '#' ){
	$header_page_color = substr($header_page_color, -6);
}
?>
<div id="page_color" style="display:none;" data-page_color="<?php echo $header_page_color;?>"></div>
<div id="page" class="hfeed site">
	<div class="header">
		
		<div class="top-tools">
			<?php get_template_part( 'content/header', 'top-tools' ); ?>
		</div>
		
		<header id="masthead" class="site-header" role="banner">
			<div class="container">
				<div class="row">
					<hgroup class="col-lg-3 col-md-3 col-sm-3 col-xs-9">
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<img class="img-responsive" src="<?php logo_image();?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
							</a>
						</h1>
					</hgroup>
					<div class="header-right col-lg-9 col-md-9 col-sm-9 col-xs-12">
						<div class="primary-nav">
							<?php get_template_part( 'content/header', 'top-nav' ); ?>
						</div>
					</div>

					<?php
					/*
					if ( get_header_image() ) {
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
						<?php
					}
					*/
					?>
				</div>
			</div>
		</header><!-- #masthead -->
	</div>

	<div id="main" class="wrapper">