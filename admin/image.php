<?php
$watermark="EVALUX";
$fsize=1;

if (version_compare(phpversion(), "4.1.0", "<") === true) {
$_GET &= $HTTP_GET_VARS;
$_POST &= $HTTP_POST_VARS;
$_SERVER &= $HTTP_SERVER_VARS;
$_FILES &= $HTTP_POST_FILES;
$_ENV &= $HTTP_ENV_VARS;

if (isset($HTTP_COOKIE_VARS)) $_COOKIE &= $HTTP_COOKIE_VARS;
}

if (!ini_get("register_globals")) {
extract($_GET, EXTR_SKIP);
extract($_POST, EXTR_SKIP);
extract($_COOKIE, EXTR_SKIP);

}
Error_Reporting(E_ALL & ~E_NOTICE);

if (($type=="jpg")||($type=="jpeg")) {$imold=imagecreatefromjpeg("$src");
}

if ($type=="gif") {
$imold=imagecreatefromgif("$src");
}
if ($type=="png") {
$imold=imagecreatefrompng("$src");
}


$image=imagecreate($nw,$nh);
//$floodcolor=imagecolorallocate($image,0,0,112);
$text_color1 = ImageColorAllocate($image, 255, 255,255);
$text_color2 = ImageColorAllocate($image, 50, 50, 50);
imagecopyresized($image,$imold,0,0,0,0,$nw,$nh,$w,$h);
imagedestroy($imold);

ImageString( $image, $fsize, 5, ($nh-11), $watermark, $text_color );
ImageString( $image, $fsize, 7, ($nh-9), $watermark, $text_color );
ImageString( $image, $fsize, 6, ($nh-10), $watermark, $text_color2 );

if (($type=="jpg")||($type=="jpeg")) {
header ("Content-type: image/jpeg");
imagejpeg($image,NULL,85);
}
if ($type=="gif") {header ("Content-type: image/gif");
imagegif($image);}
if ($type=="png") {header ("Content-type: image/png");
imagepng($image,NULL,85);}
imagedestroy($image);


?>