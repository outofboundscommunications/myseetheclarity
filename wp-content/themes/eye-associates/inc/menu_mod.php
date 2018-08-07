<?php
// add hook
// add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	if ( isset( $args->sub_menu ) ) {
		$root_id = 0;
		// find the current menu item
		foreach ( $sorted_menu_items as $menu_item ) {
			if ( $menu_item->current ) {
				// set the root id based on whether the current menu item has a parent or not
				$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
				break;
			}
		}
		// find the top level parent
		if ( ! isset( $args->direct_parent ) ) {
			$prev_root_id = $root_id;
			while ( $prev_root_id != 0 ) {
				foreach ( $sorted_menu_items as $menu_item ) {
					if ( $menu_item->ID == $prev_root_id ) {
						$prev_root_id = $menu_item->menu_item_parent;
						// don't set the root_id to 0 if we've reached the top of the menu
						if ( $prev_root_id != 0 ) $root_id = $menu_item->menu_item_parent;
						break;
					}
				}
			}
		}
		
		$menu_item_parents = array();
		foreach ( $sorted_menu_items as $key => $item ) {
			// init menu_item_parents
			if ( $item->ID == $root_id ) $menu_item_parents[] = $item->ID;
			
			if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} else if ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
				// not part of sub-tree: away with it!
				unset( $sorted_menu_items[$key] );
			}
		}
		return $sorted_menu_items;
	} else {
		return $sorted_menu_items;
	}
}

function my_custom_submenu() {
	global $post;
	
	$locations = get_nav_menu_locations();
	$menu = wp_get_nav_menu_object( $locations[ 'primary' ]);
	$menu_items = wp_get_nav_menu_items($menu->term_id);
	
	$current_menu_id = 0;
	
	// get current top level menu item id
	foreach ( $menu_items as $item ) {
		if ( $item->object_id == $post->ID ) {
			// if it's a top level page, set the current id as this page. if it's a subpage, set the current id as the parent
			$current_menu_id = ( $item->menu_item_parent ) ? $item->menu_item_parent : $item->ID;
			break;
		}
	}
	// display the submenu
	echo "<ul id='supplementary_menu'>";
	foreach ( $menu_items as $item ) {
		if ( $item->menu_item_parent == $current_menu_id ) {
			$class = ( $item->object_id == $post->ID ) ? "class='current_page_item'" : "";
			echo "<li {$class}><a href='{$item->url}'>{$item->title}</a>";
			
			$sub_menu_items = [];
			
			foreach ( $menu_items as $sub_item ) {
				if ( $sub_item->menu_item_parent == $item->ID )
				$sub_menu_items[] = $sub_item;
			}
			
			/*
			if ( $sub_menu_items ) {
				echo "<ul>";
				
				foreach ( $sub_menu_items as $sub_item ) {
					$class = ( $sub_item->object_id == $post->ID ) ? "class='current_page_item'" : "";
					echo "<li {$class}><a href='{$sub_item->url}'>{$sub_item->title}</a>";
				}
				
				echo "</ul>";
			}
			*/
			
			echo "</li>";
		}
	}
	echo "</ul>";
}
?>