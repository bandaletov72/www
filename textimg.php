<?php

if(isset($_GET['textwww']))
{
    $textwww = $_GET['textwww'];
     if (!isset($textwww)){$textwww=1;} if (!preg_match("/^[0-9]+$/",$textwww)) { exit;}
        //параметры выводимого изображения;
        $textwww = substr(intval($textwww*23-4),0,4);
        $gd=0; if (function_exists('imagecreatetruecolor')) {$gd=1;} elseif (function_exists('imagecreate')) {$gd=2;} else {$gd=0;}
        if ($gd==0) {echo "$textwww";}
        $img_w = 18*strlen($textwww);
        $img_h = 24;
        $img_quality = 60;
        $bgcolor = 0xFFFFFF;
        $img = @imageCreate($img_w,$img_h);
        $black = @imageColorAllocate($img,0,0,0);
        $white = @ImageColorAllocate($img,255,255,255);
        imagefill($img, 0, 0, $white);

        $stat = @imageline($img,0,0,$img_w,0,$black);
        $stat = @imageline($img,0,round($img_h/2),$img_w,round($img_h/2),$black);
        $stat = @imageline($img,0,$img_h-1,$img_w,$img_h-1,$black);
        $stat = @imageline($img,0,0,0,$img_h,$black);
        $stat = @imageline($img,$img_w-1,0,$img_w-1,$img_h,$black);
        $stat = @imageline($img,0,0,round($img_w/2)+1,$img_h,$black);
        $stat = @imageline($img,round(($img_w-1)/2),0,$img_w-1,$img_h,$black);
        $pos=@imagettftext($img,$img_h-5,0,0+2,($img_h-5),$black,'./serif.ttf',$textwww);
        header("Content-type: image/jpeg");
        @imagejpeg($img,'',$img_quality);
        @imagedestroy($source);
        @imagedestroy($img);

}
?>
