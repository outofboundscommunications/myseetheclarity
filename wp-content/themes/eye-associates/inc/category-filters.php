<?php
/**
 * Identifies the "Uncategorized", "Feature" link
 * preg_replace_callback for bu_library_hide_uncategorized function
 *
 * @param array $regex_parts
 * @return string
 */
function bu_library_hide_uncategorized_callback($regex_parts) {
    if( !$regex_parts or count((array)$regex_parts) != 2)
		return $regex_parts;
	
    if ( in_array($regex_parts[1], array('Uncategorized', 'Feature')) )
		return '';
	
    return $regex_parts[0];
}

/**
 * Removes the uncategorized category from $thelist string parameter
	*
 * Ignore wp-admin requests. Unfortunately, 'the_category' filter is used in other places with 1 argument), so we must
 * make the last 2 arguments optional (or we get PHP Warnings) and quit when the 2nd argument is not supplied
 */
function bu_library_hide_uncategorized($thelist, $separator = '', $parents = '') {
	
    // short circuit for lists that do not have uncategorized category,
    // or when this function is called from wp-admin (i.e. missing separator)
    if(is_admin() or !$separator or stripos($thelist, 'Uncategorized') === false) return $thelist;
	
    $listitems = explode($separator, $thelist);
	
    $new_listitems = array();
    foreach($listitems as $item) {
        if ($new_item = preg_replace_callback('!<\s*a[^>]*>(.*?)<\s*/a[^>]*>!im', 'bu_library_hide_uncategorized_callback', $item)) {
            $new_listitems[] = $new_item;
        }
    }
	
    $thelist = implode($separator, $new_listitems);
    return $thelist;
}
add_filter('the_category', 'bu_library_hide_uncategorized', 10, 3);
?>