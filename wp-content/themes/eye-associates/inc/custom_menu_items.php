<?php
function wps_nav_authors($items, $args){
    if( $args->theme_location == 'primary' ){
		return $items . '<li>';
			return $items . '<a href="#">Authors</a>';
			return $items . '<ul class="sub-menu">';
				return $items . '<li>' . wp_list_authors('show_fullname=1&optioncount=0&orderby=post_count&order=DESC&number=8&echo=0') . '</li>';
			return $items . '</ul>';
		return $items . '</li>';
	}
}
// add_filter('wp_nav_menu_items','wps_nav_authors', 10, 2);

function add_bookmarks($items, $args) {
	$cat = '1'; // define category
	$bookmarks = array();
	$bookmarks = get_bookmarks("category=$cat");
	if ($bookmarks[0] != '') {
		$items .= '<li><a href="#">Bookmarks</a><ul class="sub-menu">';
		foreach ( $bookmarks as $bookmark ) {
			$items .= '<li><a href="'.clean_url($bookmark->link_url).'">'.$bookmark->link_name.'</a></li>';
		}
		$items .= '</ul>';
	}
	return $items;
}
// add_filter('wp_nav_menu_items', 'add_bookmarks', 10, 2);

function add_login_logout_link($items, $args) {
	$loginoutlink = wp_loginout('index.php', false);
	$items .= '<li>'. $loginoutlink .'</li>';
    return $items;
}
// add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);

function your_custom_menu_item ( $items, $args ) {
    if (is_single() && $args->theme_location == 'primary') {
        $items .= '<li>Show whatever</li>';
    }
    return $items;
}
// add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );

function add_loginout_link( $items, $args ) {
	if (is_user_logged_in() && $args->theme_location == 'primary') {
		$items .= '<li><a href="'. wp_logout_url() .'">Log Out</a></li>';
	}elseif (!is_user_logged_in() && $args->theme_location == 'primary') {
		$items .= '<li><a href="'. site_url('wp-login.php') .'">Log In</a></li>';
	}
	return $items;
}
// add_filter( 'wp_nav_menu_items', 'add_loginout_link', 10, 2 );

function add_search_box_to_menu( $items, $args ) {
    if( $args->theme_location == 'primary' )
	return $items."<li class='menu-header-search'><form action='http://example.com/' id='searchform' method='get'><input type='text' name='s' id='s' placeholder='Search'></form></li>";
	
    return $items;
}
// add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);

// add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2);
function current_type_nav_class($classes, $item) {
    
	// Get post_type for this post
    $post_type = get_query_var('post_type');
	
    // Go to Menus and add a menu class named: {custom-post-type}-menu-item
    // This adds a 'current_page_parent' class to the parent menu item
    if( in_array( $post_type.'-menu-item', $classes ) )
	array_push($classes, 'current_page_parent');
	
    return $classes;
}
?>