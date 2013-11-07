<?php

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

set_time_limit(0);
$refr="";
if(isset($_GET['pix'])) $pix=$_GET['pix']; elseif(isset($_POST['pix'])) $pix=$_POST['pix']; else $pix="";
if(isset($_GET['start'])) $start=$_GET['start']; elseif(isset($_POST['start'])) $start=$_POST['start']; else $start=0;
if(isset($_GET['end'])) $end=$_GET['end']; elseif(isset($_POST['end'])) $end=$_POST['end']; else $end=100000;
$max=$start+200;

$pix=doubleval($pix);
function createthumb($name,$filename,$new_w,$new_h)
{
	$system=explode(".",substr($name,-5));
	if (preg_match("/jpg|jpeg/i",$system[1])){$src_img=@imagecreatefromjpeg($name);}
    if (preg_match("/gif/i",$system[1])){$src_img=@imagecreatefromgif($name);}
	if (preg_match("/png/i",$system[1])){$src_img=@imagecreatefrompng($name);}

    //if (!src_img) {return;}
    $old_x=@imageSX($src_img);
	$old_y=@imageSY($src_img);
	if ($old_x > $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y)
	{
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
    $fill = imagecolorallocate( $dst_img, 255, 255, 255 );
    imagefilledrectangle($dst_img, 0, 0, $thumb_w, $thumb_h, $fill);
	@imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);


$sharpenMatrix = array(-1,-1,-1,-1,16,-1,-1,-1,-1);
$divisor = 8;
$offset = 0;

//@imageconvolution($dst_img, $sharpenMatrix, $divisor, $offset);

	if (preg_match("/png/i",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagepng($dst_img,$filename);
	}
    if (preg_match("/gif/i",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagegif($dst_img,$filename);
        }
    if (preg_match("/jpg/i",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagejpeg($dst_img,$filename, 100);
	}
    if (preg_match("/jpeg/i",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagejpeg($dst_img,$filename, 100);
	}
	imagedestroy($dst_img);
	@imagedestroy($src_img);
}
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚÛİŞß",
"àáâãäååæçèêëìíîïğñòóôõö÷øùüúûışÿ");
   return strtolower($str);
}
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
$fold="..";
$rrating="";

$sortas=0;
$fold=".."; require ("../templates/lang.inc");

if (!isset($speek)) {
$speek=$language;
} else {
$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($speek==$stl){
$found_lang=1;
}
}
if ($found_lang==0){
$speek=$language;
}
}

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("../templates/$template/$speek/config.inc");
require ("../modules/translit.php");
echo "<!DOCTYPE html><html>
<TITLE>THUMB</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body>";
echo "<h1>PHOTO THUMBNAILS $start - $max</h1>";
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}


$fold="..";
require "../modules/functions.php";
require "../templates/$template/css.inc";

echo $css;

if ($pix!="") {
$st=0;
$base="";
$minibase="";
$file=".$base_file";
$f=fopen($file,"r");
$zf=0;
$rating=Array();
$curt=time();

while(!feof($f)) {

echo " ";
$stun=fgets($f);
if ($start<=$end) {
if (($start<=$max)&&($zf==$start)) {
if (trim($stun!="")) {
$out=explode("|",$stun);

$inifid=md5(@$out[3]." ID:".@$out[6]);
@$foto1=@$out[9];
@$foto2=@$out[10];
if (trim($foto2)!="") {
//if (trim($foto1)!="") {
$fotomass2=explode("src=",str_replace("'","",str_replace("\"","", @$foto2)));
while (list ($key, $val) = each ($fotomass2)) {
if ($key==1 ) {
$dest=strtoken(strtoken($val,">")," ");
if (preg_match("/http:\/\//i", $dest)==TRUE) {
$dest=str_replace("$htpath/","../",str_replace(str_replace("http://www.","http://", "$htpath/"),"../",$dest));
$tmpdir=explode ("/", $dest);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($dest.$secret_salt.$htpath);
$tmptype=explode(".", $file);
$type=array_pop($tmptype);
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
if (substr($dest,0,3)=="../") {
echo ".";
//echo "$start. THUMB: $dest -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb($dest,"../$fotobasesmall/tn_$target.$type",$pix,$pix);
} else {
echo ".";
//echo "$start. COPY: $dest -> ../$fotobasesmall/tn_$target.$type<br>\n";
@copy ("$dest", "../$fotobasesmall/$target.$type");
echo ".";
//echo "$start. THUMB: ../$fotobasesmall/$target.$type -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$fotobasesmall/$target.$type","../$fotobasesmall/tn_$target.$type",$pix,$pix);
echo ".";
//echo "$start. DEL: ../$fotobasesmall/$target.$type<br>\n";
unlink("../$fotobasesmall/$target.$type");
}

$out[9]="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>";
$stun=implode("|",$out);
} else {
$tmpdir=explode ("/", $dest);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($dest.$secret_salt.$htpath);
$tmptype=explode(".", $file);
$type=array_pop($tmptype);
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
echo ".";
//echo "$start. THUMB: ../$dest -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$dest","../$fotobasesmall/tn_$target.$type",$pix,$pix);
$out[9]="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>";
$stun=implode("|",$out);
}
echo ".";
//echo "<br>";
}
}
unset($ren, $tmpdir, $k, $v, $count, $dir, $target, $tmptype, $type, $realdir);
//}
}

unset($out,$tmpft1,$tmpft2,$key,$val);
$start+=1;
}
} else {
$refr="<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=$htpath/admin/photo_thumb.php?pix=$pix&amp;start=$max&end=$zf\">";
}
}
$base.=$stun;
$zf+=1;
}

fclose($f);

$file=".$base_file";
$f=fopen($file,"w");
fputs($f,$base);
if ($refr!="") {echo $refr."<h1>PLEASE WAIT ...</h1>";} else {
echo "<h1>OK. $lang[658]</h1>";
}
} else {
echo "<form class=form-inline action=\"photo_thumb.php\" method=POST>
<input type=hidden name=\"speek\" value=\"$speek\">
<br><br><div align=center><b>".$lang[866].":</b> <input type=text size=4 name=pix value=150> ".$lang[867]."
<br><br>
<input type=submit value=\"".$lang[865]."\">
</div>
</form>";
}
?>
</body>
</html>