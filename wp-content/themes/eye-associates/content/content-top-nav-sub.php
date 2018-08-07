<?php
$current_page_id    = $post->ID;
if( is_single() ){
	$current_post_type = get_post_type( $post );
	$cpt_page = get_field('cpt_page_'.$current_post_type, 'option');
	$current_page_id = $cpt_page->ID;
}
$current_page_color = get_field('page_color', $current_page_id);
if( !$current_page_color ){
	$ancestors = get_ancestors( $current_page_id, 'page' );
	if( !empty($ancestors) ){
		$ancestors_id = $ancestors[0];
		$ancestor_page_color = get_field('page_color', $ancestors_id);
	}
	
	$page_color_default = get_field('page_header_default_color', 'option');
	if( $ancestor_page_color ){
		$current_page_color = $ancestor_page_color;
	}elseif( $page_color_default ){
		$current_page_color = $page_color_default;
	}else{
		$current_page_color = '#40a9a9';
	}
}

/*
if( !$page_color ){
	$ancestors  = get_ancestors( $current_page_id, 'page' );
	
	if( !empty($ancestors) ){
		$page_color = get_field('page_color', $ancestors[0]);
		if( !$page_color ){
			$page_color = get_field('page_header_default_color', 'option');
		}
	}else{
		$page_color = get_field('page_header_default_color', 'option');
	}
}
*/
?>
<style type="text/css">
#menu-primary-submenu .current-menu-item a {
	background: <?php echo $current_page_color;?>;
	color: #FFFFFF;
}
.header-submenu-wrapper .header-submenu li a:hover {
	background: <?php echo $current_page_color;?>;
	color: #FFFFFF;
}
.main-navigation .sub-menu {
	background: <?php echo $current_page_color;?>;
}
</style>
<?php
$menu_name       = 'primary';
$locations       = get_nav_menu_locations();
// $menu = wp_get_nav_menu_object( $locations[ $menu_name ]);

if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
	
	$menu = wp_get_nav_menu_object( $locations[ $menu_name ]);
	
	$args = array(
		'output' => ARRAY_A,
	);
	$menu_items = wp_get_nav_menu_items($menu->term_id, $args );
	
	$current_menu_data = wp_filter_object_list( $menu_items, array( 'object_id' => $current_page_id ), 'or', 'ID' );
	$current_menu_data = array_values($current_menu_data);
	$current_menu_id  = $current_menu_data[0];
	
	$max = count($menu_items);
	$tree = array();
	$flat = array();
	
	// Create a flat hierarchy array of all entries by their id
	for ($i = 0; $i < $max; $i++) {
		$n = (array) $menu_items[$i];
		$id = $n['ID'];
		$flat[$id] = $n;
	}
	
	$anc[] = $current_menu_id;
	$menu_id = $current_menu_id;
	for ($i = 0; $i < $max; $i++) {
		if( $flat[$menu_id]['menu_item_parent'] == 0){
			break;
		}else{
			$anc[] = $flat[$menu_id]['menu_item_parent'];
			$menu_id = $flat[$menu_id]['menu_item_parent'];;
		}
	}
	$anc = array_reverse($anc);
	
	// echo '<pre>';
	// print_r($anc);
	// echo '</pre>';
	
	// echo '<pre>';
	// print_r($flat[$anc[0]]['title']);
	// echo '</pre>';
	
	?>
	<div class="container">
		<?php
		$args = array(
			'menu'            => 'primary',
			'menu_class'      => 'header-submenu',
			'menu_id'         => 'menu-primary-submenu',
			'container_id'    => 'menu-primary-submenu-container',
			'submenu'         => $flat[$anc[0]]['title'],
			'depth'           => 1,
		);
		wp_nav_menu( $args );
		?>
	</div>
	<?php
	
	/*
	// Then check all those entries by reference
	foreach ($flat as $key => &$child) {
		// Add a children array if not already existing
		if (!isset($child['children']))
			$child['children'] = array();
		
		$id = $child['ID'];
		$pid = $child['menu_item_parent'];
		
		// If childs parent id is larger then zero
		if ($pid > 0) {
			// Append it by reference, which means it will reference
			// the same object across different carriers
			$flat[$pid]['children'][] = &$child;
		} else {
			// Otherwise it is zero level, which initiates the tree
			$tree[$id] = &$child;
		}
	}
	
	$tree = array_values($tree); // Indices fixed, there we go, use $tree further
	*/

}
?>

<?php /* ?>
<div class="container">
	<?php echo do_shortcode('[advMenu title="" nav_menu='.$locations[ $menu_name ].' start_depth=1 depth=2 menu_class=header-submenu filter=2]');?>
</div>
<hr>
<div class="container">
	<?php // echo do_shortcode('[custom_menu_wizard menu='.$locations[ $menu_name ].' title="BBBBBBBBBB" children_of="root" start_level=2 depth=1 depth_rel_current=1 flat_output=1]');?>
</div>
<?php */ ?>