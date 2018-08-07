<?php
function title_shortcodes( $title ) {
	//HTML tag opening/closing brackets
	$title = str_replace( '[', '<', $title );
	$title = str_replace( '[/', '</', $title );
	
	// bold -- changed from 's' to 'strong' because of strikethrough code
	$title = str_replace( 'strong]', 'strong>', $title );
	$title = str_replace( 'b]', 'b>', $title );
	
	// br
	$title = str_replace( 'br]', 'br>', $title );
	
	// span
	$title = str_replace( 'span]', 'span>', $title );
	
	// italic
	$title = str_replace( 'em]', 'em>', $title );
	$title = str_replace( 'i]', 'i>', $title );
	
	// underline
	// $title = str_replace( 'u]', 'u>', $title ); // could use this, but it is deprecated so use the following instead
	$title = str_replace( '<u]', '<span style="text-decoration:underline;">', $title );
	$title = str_replace( '</u]', '</span>', $title );
	
	// superscript
	$title = str_replace( 'sup]', 'sup>', $title );
	
	// subscript
	$title = str_replace( 'sub]', 'sub>', $title );
	
	// del
	$title = str_replace( 'del]', 'del>', $title ); // del is like strike except it is not deprecated, but strike has wider browser support -- you might want to replace the following 'strike' section to replace all with 'del' instead
	
	// strikethrough or <s></s>
	$title = str_replace( 'strike]', 'strike>', $title );
	$title = str_replace( 's]', 'strike>', $title ); // <s></s> was deprecated earlier than so we will convert it
	$title = str_replace( 'strikethrough]', 'strike>', $title ); // just in case you forget that it is 'strike', not 'strikethrough'
	
	// tt
	$title = str_replace( 'tt]', 'tt>', $title ); // Will not look different in some themes, like Twenty Eleven -- FYI: http://reference.sitepoint.com/html/tt
	
	// marquee
	$title = str_replace( 'marquee]', 'marquee>', $title );
	
	// blink
	$title = str_replace( 'blink]', 'blink>', $title ); // only Firefox and Opera support this tag
	
	// wtitle1 (to be styled in style.css using .wtitle1 class)
	$title = str_replace( '<wtitle1]', '<span class="wtitle1">', $title );
	$title = str_replace( '</wtitle1]', '</span>', $title );
	
	// wtitle2 (to be styled in style.css using .wtitle2 class)
	$title = str_replace( '<wtitle2]', '<span class="wtitle2">', $title );
	$title = str_replace( '</wtitle2]', '</span>', $title );
	 
	return $title;
}
add_filter( 'widget_title', 'title_shortcodes' );
add_filter('the_title', 'title_shortcodes');
?>