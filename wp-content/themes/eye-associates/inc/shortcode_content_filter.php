<?php
// add_filter ('the_content', 'cleangridshortcodes');
function cleangridshortcodes($content) {
	if(has_shortcode($content,'row') || has_shortcode($content,'column')) {
		$patterns = array("/(\[row\])/","/(\[column(.*)\])/","/(\[\/column\])/");
		$replacements = array('$1','$1','$1');
		$content = preg_replace($patterns, $replacements, $content);
	}
	return $content;
}

/**
 * Don't auto-p wrap shortcodes that stand alone
	*
 * Ensures that shortcodes are not wrapped in <<p>>...<</p>>.
	*
 * @since 2.9.0
	*
 * @param string $content The content.
 * @return string The filtered content.
 */
function shortcode_unautop2( $content ) {
	global $shortcode_tags;
	
	if ( empty( $shortcode_tags ) || !is_array( $shortcode_tags ) ) {
		return $content;
	}
	
	$tagregexp = join( '|', array_map( 'preg_quote', array_keys( $shortcode_tags ) ) );
	
	$pattern =
	'/'
	. '<p>'                              // Opening paragraph
	. '\\s*+'                            // Optional leading whitespace
	. '('                                // 1: The shortcode
	.     '\\['                          // Opening bracket
	.     "($tagregexp)"                 // 2: Shortcode name
	.     '(?![\\w-])'                   // Not followed by word character or hyphen
	
	// Unroll the loop: Inside the opening shortcode tag
	.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
	.     '(?:'
	.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
	.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
	.     ')*?'
	.     '(?:'
	.         '\\/\\]'                   // Self closing tag and closing bracket
	.     '|'
	.         '\\]'                      // Closing bracket
	.         '(?:'                      // Unroll the loop: Optionally, anything between the opening and closing shortcode tags
	.             '[^\\[]*+'             // Not an opening bracket
	.             '(?:'
	.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
	.                 '[^\\[]*+'         // Not an opening bracket
	.             ')*+'
	.             '\\[\\/\\2\\]'         // Closing shortcode tag
	.         ')?'
	.     ')'
	. ')'
	. '\\s*+'                            // optional trailing whitespace
	. '<\\/p>'                           // closing paragraph
	. '/s';
	
	return preg_replace( $pattern, '$1', $content );

}

// Unwrap Shortcodes from Paragraph Tags Start
function wpex_clean_shortcodes($content){  
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
// add_filter('the_content', 'wpex_clean_shortcodes');
// Unwrap Shortcodes from Paragraph Tags End


// remove_filter( 'the_content', 'wpautop' );
// add_filter( 'the_content', 'wpautop' , 99);
// add_filter( 'the_content', 'shortcode_unautop',100 );
?>