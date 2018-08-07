<?php
$post_id   = $post->ID;
$ancestors = get_ancestors( $post_id, 'page' );

$page_image                = get_field('page_image');
$page_header_default_image = get_field('page_header_default_image','option');
$blog_header_image         = get_field('blog_header_image','option');
$image_size                = 'location_banner';

$header_image_src = '';
if( ( is_single() && get_post_type( $post ) == 'location' ) && has_post_thumbnail() ){
	$header_image_data   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_size );

	$header_image_src    = $header_image_data[0];
	$header_image_width  = $header_image_data[1];
	$header_image_height = $header_image_data[2];
	/*
	$header_image_src    = get_stylesheet_directory_uri().'/images/dummy/1280x415.png';
	$header_image_width  = '1280px';
	$header_image_height = '415px';
	*/
}
//$page_color = get_field('page_color', $post_id);
//$page_color = str_replace("#","",$page_color);

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
	$blog_header_color         = get_field('blog_header_color', 'option');
	if( ( is_home() || ( is_single() && get_post_type( $post ) == 'post' ) ) && $blog_header_color ){
		$header_page_color = $blog_header_color;
	}else{
		if( $header_ancestor_page_color ){
			$header_page_color = $header_ancestor_page_color;
		}elseif( $header_page_color_default ){
			$header_page_color = $header_page_color_default;
		}else{
			$header_page_color = '#40a9a9';
		}
	}
}

if( strlen($header_page_color) == 7 && substr($header_page_color, 0, 1) == '#' ){
	$header_page_color = substr($header_page_color, -6);
}

$page_color = $header_page_color;
?>
<div class="page-header-image<?php echo ( empty($header_image_src) ? ' page-header-image-no-banner' : '' );?>">
	<?php
	if( !empty($header_image_src) ){
		?>
		<div class="mask_group">
			<div class="banner_image">
				<img src="<?php echo $header_image_src;?>" width="<?php echo $header_image_width;?>" height="<?php echo $header_image_height;?>" alt="" />
			</div>
		</div>
		<?php
	}
	?>
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
				$blog_page_title = get_field('blog_page_title', 'option');
				if( !$blog_page_title ){
					$blog_page_title = 'get the clarity';
				}
				$blog_page_subtitle = get_field('blog_page_subtitle', 'option');
				if( !$blog_page_subtitle ){
					$blog_page_subtitle = '<span class="blog_sub">A blog about healthy lifestyles, family life and eye care</span>';
				}
				$page_alternate_title = $blog_page_title.'<br>'.$blog_page_subtitle;
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
	/*function codeAddress() {
		// $( ".color a" ).click(function() {
		changeColor(pageColor);
	}
	window.onload = codeAddress;*/
});
/*
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
}*/
</script>
