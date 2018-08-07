<?php
$post_id   = $post->ID;
$ancestors = get_ancestors( $post_id, 'page' );

$page_image                = get_field('page_image');
$page_header_default_image = get_field('page_header_default_image','option');
$image_size                = 'header_image';

if($page_image){
	$header_image_src    = $page_image['sizes'][$image_size];
	$header_image_width  = $page_image['sizes'][$image_size.'-width'];
	$header_image_height = $page_image['sizes'][$image_size.'-height'];
}elseif( ( is_single() && get_post_type( $post ) == 'location' ) && has_post_thumbnail() ){
	$header_image_data   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_size );
	$header_image_src    = $header_image_data[0];
	$header_image_width  = $header_image_data[1];
	$header_image_height = $header_image_data[2];
}elseif($page_header_default_image){
	$header_image_src    = $page_header_default_image['sizes'][$image_size];
	$header_image_width  = $page_header_default_image['sizes'][$image_size.'-width'];
	$header_image_height = $page_header_default_image['sizes'][$image_size.'-height'];
}else{
	$header_image_src    = get_stylesheet_directory_uri().'/images/default/header_415x270.png';
	$header_image_width  = '415';
	$header_image_height = '270';
}
?>
<div class="page-header-image">
	<div class="mask_group">
		<div class="round_sep">&nbsp;</div>
		<img id="mug" class="mug" src="<?php echo get_stylesheet_directory_uri();?>/images/mask.png" onload="getPixels(this)" alt="" />
		<div class="banner_image">
			<img src="<?php echo $header_image_src;?>" width="415" height="270" alt="" />
		</div>
	</div>
</div>
<div id="mask_color" class="mask_color"></div>
<div class="page_title_wrapper">
	<div class="container">
		<h1 class="page-title">
			<?php
			$page_alternate_title = get_field('page_alternate_title');
			$my_types = array(
				'doctor',
				'location',
				'staff'
			);
			if( is_page() || ( is_single() && in_array(get_post_type( $post ),$my_types) )){
				$current_post_type = get_post_type( $post );
				$page_alternate_title = get_field($current_post_type.'_alternate_title');
			}elseif( is_home() || is_archive() || is_404() || is_search() || is_single() ){
				$page_alternate_title = 'get the clarity'.'<br>'.'<span class="blog_sub">A blog about healthy lifestyles, family life and eye care</span>';
			}
			if( $page_alternate_title ){
				$page_alternate_title = title_shortcodes($page_alternate_title);
				echo $page_alternate_title;
			}else{
				the_title();
			}
			?>
		</h1>
	</div>
</div>
<script type="text/javascript">
var urlParams;
(window.onpopstate = function () {
	var match,
	pl     = /\+/g,  // Regex for replacing addition symbol with a space
	search = /([^&=]+)=?([^&]*)/g,
	decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
	query  = window.location.search.substring(1);
	
	urlParams = {};
	while (match = search.exec(query))
	urlParams[decode(match[1])] = decode(match[2]);
})();

jQuery(document).ready(function($) {
	var pageColor = $('#page_color').data('page_color');
	
	$('#mask_color').css('background-color',  '#'+pageColor);
	function codeAddress() {
		// $( ".color a" ).click(function() {
		changeColor(pageColor);
	}
	window.onload = codeAddress;
});
var mug = document.getElementById("mug");
var canvas = document.createElement("canvas");
var ctx = canvas.getContext("2d");
var originalPixels = null;
var currentPixels = null;

function HexToRGB(Hex)
{
	var Long = parseInt(Hex.replace(/^#/, ""), 16);
	return {
		R: (Long >>> 16) & 0xff,
		G: (Long >>> 8) & 0xff,
		B: Long & 0xff
	};
}

function changeColor(c)
{
	if(!originalPixels) return; // Check if image has loaded
	var newColor = HexToRGB(c);
	
	for(var I = 0, L = originalPixels.data.length; I < L; I += 4)
	{
		if(currentPixels.data[I + 3] > 0)
		{
			currentPixels.data[I] = originalPixels.data[I] / 255 * newColor.R;
			currentPixels.data[I + 1] = originalPixels.data[I + 1] / 255 * newColor.G;
			currentPixels.data[I + 2] = originalPixels.data[I + 2] / 255 * newColor.B;
		}
	}
	
	ctx.putImageData(currentPixels, 0, 0);
	mug.src = canvas.toDataURL("image/png");
}

function getPixels(img)
{
	canvas.width = img.width;
	canvas.height = img.height;
	
	ctx.drawImage(img, 0, 0, img.naturalWidth, img.naturalHeight, 0, 0, img.width, img.height);
	originalPixels = ctx.getImageData(0, 0, img.width, img.height);
	currentPixels = ctx.getImageData(0, 0, img.width, img.height);
	
	img.onload = null;
}
</script>