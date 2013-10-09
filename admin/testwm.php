<?php

function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ");
   return strtolower($str);
}
if(!function_exists('imageconvolution')){
function imageconvolution($src, $filter, $filter_div, $offset){
    if ($src==NULL) {
        return 0;
    }

    $sx = imagesx($src);
    $sy = imagesy($src);
    $srcback = ImageCreateTrueColor ($sx, $sy);
    ImageCopy($srcback, $src,0,0,0,0,$sx,$sy);

    if($srcback==NULL){
        return 0;
    }

    for ($y=0; $y<$sy; ++$y){
        for($x=0; $x<$sx; ++$x){
            $new_r = $new_g = $new_b = 0;
            $alpha = imagecolorat($srcback, $pxl[0], $pxl[1]);
            $new_a = $alpha >> 24;

            for ($j=0; $j<3; ++$j) {
                $yv = min(max($y - 1 + $j, 0), $sy - 1);
                for ($i=0; $i<3; ++$i) {
                        $pxl = array(min(max($x - 1 + $i, 0), $sx - 1), $yv);
                    $rgb = imagecolorat($srcback, $pxl[0], $pxl[1]);
                    $new_r += (($rgb >> 16) & 0xFF) * $filter[$j][$i];
                    $new_g += (($rgb >> 8) & 0xFF) * $filter[$j][$i];
                    $new_b += ($rgb & 0xFF) * $filter[$j][$i];
                }
            }

            $new_r = ($new_r/$filter_div)+$offset;
            $new_g = ($new_g/$filter_div)+$offset;
            $new_b = ($new_b/$filter_div)+$offset;

            $new_r = ($new_r > 255)? 255 : (($new_r < 0)? 0:$new_r);
            $new_g = ($new_g > 255)? 255 : (($new_g < 0)? 0:$new_g);
            $new_b = ($new_b > 255)? 255 : (($new_b < 0)? 0:$new_b);

            $new_pxl = ImageColorAllocateAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
            if ($new_pxl == -1) {
                $new_pxl = ImageColorClosestAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
            }
            if (($y >= 0) && ($y < $sy)) {
                imagesetpixel($src, $x, $y, $new_pxl);
            }
        }
    }
    imagedestroy($srcback);
    return 1;
}
}
if ((!@$_GET['watermark']) || (@$_GET['watermark']=="")){ $_GET['watermark']=""; }
if ((!@$_GET['fontcolor']) || (@$_GET['fontcolor']=="")){ $_GET['fontcolor']="#ffffff"; }
if ((!@$_GET['bgcolor']) || (@$_GET['bgcolor']=="")){ $_GET['bgcolor']="#000000"; }
if ((!@$_GET['ypos']) || (@$_GET['ypos']=="")){ $_GET['ypos']="bottom"; }
if ((!@$_GET['xpos']) || (@$_GET['xpos']=="")){ $_GET['xpos']="right"; }
if ((!@$_GET['fsize']) || (@$_GET['fsize']=="")){ $_GET['fsize']=2; }
if ((!@$_GET['fill']) || (@$_GET['fill']=="")){ $_GET['fill']="no"; }
if ((!@$_GET['sharp']) || (@$_GET['sharp']=="")){ $_GET['sharp']="no"; }
if (!preg_match("/^[a-zA-Z0-9#]+$/i",$_GET['fontcolor'])) { $_GET['fontcolor']="#ffffff";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_GET['bgcolor'])) { $_GET['bgcolor']="#000000";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_GET['ypos'])) { $_GET['ypos']="bottom";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_GET['xpos'])) { $_GET['xpos']="right";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_GET['fill'])) { $_GET['fill']="no";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_GET['sharp'])) { $_GET['sharp']="no";}
if (!preg_match("/^[0-9\.,]+$/i",$_GET['fsize'])) { $_GET['fsize']=2;}
$colofont=trim(trim(str_replace("#","",$_GET['fontcolor'])));
$rrr= (hexdec ("0x" . substr($colofont,0,2)));
$ggg=(hexdec ("0x" . substr($colofont,2,2)));
$bbb=(hexdec ("0x" . substr($colofont,4,2)));
$colofont2=trim(trim(str_replace("#","",$_GET['bgcolor'])));
$rrr2= (hexdec ("0x" . substr($colofont2,0,2)));
$ggg2=(hexdec ("0x" . substr($colofont2,2,2)));
$bbb2=(hexdec ("0x" . substr($colofont2,4,2)));
$name="./test_image.jpg";
if (file_exists($name)==true) {
$im=imagecreatefromjpeg($name);
$w=imageSX($im);
$h=imageSY($im);
} else {


if (function_exists('imagecreatetruecolor')) {
$im = imagecreatetruecolor(150,150);
} elseif (function_exists('imagecreate')) {
$im = imagecreate(150,150);
} else {
die('Unable to create an image');
}


$bg = ImageColorAllocate($im, 200, 200,200);
ImageFilledRectangle ($im,0,0,150,150,$bg);
$h=150;
$w=150;
}
//echo "$filename<br>\n";



$fontclr=imagecolorallocate($im, $rrr, $ggg, $bbb);
    $fontclr2=imagecolorallocate($im, $rrr2, $ggg2, $bbb2);

    $razm=round(doubleval(strlen($_GET['watermark'])*doubleval($_GET['fsize'])*1.5+doubleval($_GET['fsize'])*10+10));
     if ($_GET['sharp']=="yes") {
$divisor = 8;
$offset = 0;
if(!function_exists('imageconvolution')){
    $sharpenMatrix = array(-1,-1,-1,-1,16,-1,-1,-1,-1);
    } else {
    $sharpenMatrix = array(array( -1, -1, -1 ),
                        array( -1, 16, -1 ),
                        array( -1, -1, -1 ) );
    }
imageconvolution($im, $sharpenMatrix, $divisor, $offset);
}

    if (file_exists("./arial.ttf")==true) {
    //ttf font exists
    $fontsize=(6+$_GET['fsize']);
    if (extension_loaded('iconv')) {$mark=iconv($codepage, "UTF-8", $_GET['watermark']);} else {
    if (extension_loaded('mb_string')) {
    $mark=mb_convert_encoding($_GET['watermark'], $codepage, "UTF-8");
    } else {
    $mark=$_GET['watermark'];
    }
    }
    $coord = imagettfbbox($fontsize, 0,"arial.ttf",$mark );
    $text_width = $coord[2] - $coord[0];
    $text_height = $coord[1]- $coord[7];

    if ($_GET['ypos']=="top") {$h=(12+round(doubleval($_GET['fsize'])));} else { if ($_GET['ypos']=="bottom") {$h=($h-round(doubleval($_GET['fsize']/4))); } else {$h=round(doubleval(12+($h/2)+doubleval($_GET['fsize']/4))); }}
    if ($_GET['xpos']=="left") {$w=(12+$text_width);} else { if ($_GET['xpos']=="right") { } else {$w=round((12+$w+$text_width)/2); }}
    if ($_GET['fill']=="yes") {
    ImageFilledRectangle ($im,($w-12-$text_width),($h-$text_height-round($text_height/10)-6),($w-8+12),($h+round($text_height/10)),$fontclr2);
    }

    //$mark=$text_width."x".$text_height;
    //echo $mark;
    imageTtfText($im, $fontsize, 0, ($w-4-$text_width), ($h-4), $fontclr2, "arial.ttf", $mark);
    imageTtfText($im, $fontsize, 0, ($w-6-$text_width), ($h-4), $fontclr2, "arial.ttf", $mark);
    imageTtfText($im, $fontsize, 0, ($w-5-$text_width), ($h-3), $fontclr2, "arial.ttf", $mark);
    imageTtfText($im, $fontsize, 0, ($w-5-$text_width), ($h-5), $fontclr2, "arial.ttf", $mark);
    imageTtfText($im, $fontsize, 0, ($w-5-$text_width), ($h-4), $fontclr,  "arial.ttf", $mark);
    } else {
    //no ttf font
    $fontsize=$_GET['fsize'];
    $mark=$_GET['watermark'];
    ImageString($im, $_GET['fsize'], ($w-4-$razm), ($h-14-doubleval($_GET['fsize'])), $mark, $fontclr2);
    ImageString($im, $_GET['fsize'], ($w-6-$razm), ($h-14-doubleval($_GET['fsize'])), $mark, $fontclr2);
    ImageString($im, $_GET['fsize'], ($w-5-$razm), ($h-13-doubleval($_GET['fsize'])), $mark, $fontclr2);
    ImageString($im, $_GET['fsize'], ($w-5-$razm), ($h-15-doubleval($_GET['fsize'])), $mark, $fontclr2);
	ImageString($im, $_GET['fsize'], ($w-5-$razm), ($h-14-doubleval($_GET['fsize'])), $mark, $fontclr);
    }



        if (function_exists("imagepng")) {
            header("Content-type: image/png");
            imagepng($im);

        }
        elseif (function_exists("imagegif")) {
        header("Content-type: image/gif");
            imagegif($im);
        }
        elseif (function_exists("imagejpeg")) {
        header("Content-type: image/jpeg");
            imagejpeg($im);
        }

        elseif (function_exists("imagewbmp")) {
            header("Content-type: image/vnd.wap.wbmp");
            imagewbmp($im);
        } else {
            die("Doh ! No graphical functions on this server ?");
        }
?>
