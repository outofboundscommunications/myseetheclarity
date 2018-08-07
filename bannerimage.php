<?php
function hex2rgb($hex) {
   //$hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
$c=$_GET['c'];

if(empty($c)){
	$c="fd6d6f";
}
$colors=hex2rgb($c);

header('Content-Type: image/png');
$file='wp-content/themes/eye-associates/images/mask.png';

$targetR= $colors[0];
$targetG= $colors[1];
$targetB= $colors[2];

$im_src = imagecreatefrompng( $file );

    $width = imagesx($im_src);
    $height = imagesy($im_src);

    $im_dst = imagecreatefrompng( $file );

    // Note this:
    // Let's reduce the number of colors in the image to ONE
    $transparent = imagecolorallocatealpha($im_dst, 255,255,255, 127);
    imagefilledrectangle( $im_dst, 0, 0, $width, $height, $transparent );

    for( $x=0; $x<$width; $x++ ) {
        for( $y=0; $y<$height; $y++ ) {

            $alpha = ( imagecolorat( $im_src, $x, $y ) >> 24 & 0xFF );

            $col = imagecolorallocatealpha( $im_dst,
                $targetR - (int) ( 1.0 / 255.0  * $alpha * (double) $targetR ),
                $targetG - (int) ( 1.0 / 255.0  * $alpha * (double) $targetG ),
                $targetB - (int) ( 1.0 / 255.0  * $alpha * (double) $targetB ),
                $alpha
                );

            if ( false === $col ) {
                die( 'sorry, out of colors...' );
            }

            imagesetpixel( $im_dst, $x, $y, $col );

        }

    }
	imagealphablending( $im_dst, true );
	imagesavealpha( $im_dst, true );
    imagepng( $im_dst);
    imagedestroy($im_dst);

?>
