<?php
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
	if (preg_match("/jpg|jpeg/",$system[1])){$src_img=@imagecreatefromjpeg($name);}
    if (preg_match("/gif/",$system[1])){$src_img=@imagecreatefromgif($name);}
	if (preg_match("/png/",$system[1])){$src_img=@imagecreatefrompng($name);}

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
	if (preg_match("/png/",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagepng($dst_img,$filename);
	}
    if (preg_match("/gif/",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagegif($dst_img,$filename);
        }
    if (preg_match("/jpg/",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagejpeg($dst_img,$filename);
	}
    if (preg_match("/jpeg/",$system[1]))
	{
    echo ".";
    //echo $filename." - OK<br>";
		imagejpeg($dst_img,$filename);
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
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ");
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
<TITLE>COPY&THUMB</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body>";
echo "<h1>PHOTO COPY&THUMBNAILS $start - $max</h1>";
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


$stun=fgets($f);
//echo "$stun";
if ($start<=$end) {
if (($start<=$max)&&($zf==$start)) {
if (trim($stun!="")) {
$out=explode("|",$stun);

$inifid=md5(@$out[3]." ID:".@$out[6]);
@$foto1=@$out[9];
if (trim($foto1)!="") {
//if (trim($foto1)!="") {
$fotomass2=explode("src=",str_replace("'","",str_replace("\"","", @$foto1)));
$foto1="";
while (list ($key, $val) = each ($fotomass2)) {
$dest=strtoken(strtoken($val,">")," ");
//echo "<textarea>dest=\"$dest\" val=\"$val\"</textarea>";
if (preg_match("/http:\/\//i", $dest)==TRUE) {
$dest=str_replace("$htpath/","../",str_replace(str_replace("http://www.","http://", "$htpath/"),"../",$dest));
$tmpdir=explode ("/", $dest);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($dest.$secret_salt.$htpath);
$tmptype=explode(".", $file);
$type=strtolower(array_pop($tmptype));
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
if (($type=="jpg")||($type=="png")||($type=="gif")) {
if (substr($dest,0,3)=="../") {
echo ".";
echo "<br>[1] $start. THUMB: $dest -> ../$fotobasesmall/$target.$type<br>\n";
if (!copy("$dest","../$fotobasesmall/$target.$type")) { echo "<br>ERROR<br>"; } else {
echo "THUMB: ../$fotobasesmall/$target.$type -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$fotobasesmall/$target.$type","../$fotobasesmall/tn_$target.$type",$pix,$pix);
unlink("../$fotobasesmall/$target.$type");
$foto1="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>";
 }
} else {
echo ".";
echo "<br>[2] $start. COPY: $dest -> ../$fotobasesmall/$target.$type<br>\n";
if (!copy("$dest","../$fotobasesmall/$target.$type")) {  echo "<br>ERROR<br>"; } else {
echo "THUMB: ../$fotobasesmall/$target.$type -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$fotobasesmall/$target.$type","../$fotobasesmall/tn_$target.$type",$pix,$pix);
unlink("../$fotobasesmall/$target.$type");
$foto1="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>";

}
}

}
} else {
//if ($dest!="<img") {
$tmpdir=explode ("/", $dest);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($dest.$secret_salt.$htpath);
$tmptype=explode(".", $file);
$type=strtolower(array_pop($tmptype));
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
if (($type=="jpg")||($type=="png")||($type=="gif")) {
if (file_exists("../$dest")) {
//echo ".\"<textarea>$dest</textarea>\"";
echo "<br>[3] $start. COPY: ../$dest -> ../$fotobasesmall/$target.$type<br>\n";
if (!copy("../$dest","../$fotobasesmall/$target.$type")) { echo "<br>ERROR<br>";  } else {
echo "THUMB: ../$fotobasesmall/$target.$type -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$fotobasesmall/$target.$type","../$fotobasesmall/tn_$target.$type",$pix,$pix);
unlink("../$fotobasesmall/$target.$type");
$foto1="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>"; }

}
}
//}
}
echo ".";
//echo "<br>";
}
$out[9]="$foto1";
}
@$foto2=@$out[10];
if (trim($foto2)!="") {
//if (trim($foto1)!="") {
$fotomass2=explode("src=",str_replace("'","",str_replace("\"","", @$foto2)));
$foto2="";
while (list ($key, $val) = each ($fotomass2)) {
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
$type=strtolower(array_pop($tmptype));
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
if (($type=="jpg")||($type=="png")||($type=="gif")) {
if (substr($dest,0,3)=="../") {
echo ".";
echo "<br>[1] $start. THUMB: $dest -> ../$fotobasebig/$target.$type<br>\n";
if (!copy("$dest","../$fotobasebig/$target.$type")) { echo "<br>ERROR<br>"; } else {
if ($foto1=="") {
echo "THUMB: ../$fotobasebig/$target.$type -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$fotobasebig/$target.$type","../$fotobasesmall/tn_$target.$type",$pix,$pix);
$foto1="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>";
}
$foto2.="<img src='"."$fotobasebig/$target.$type"."' border=0><br>"; }
} else {
echo ".";
echo "<br>[2] $start. COPY: $dest -> ../$fotobasebig/$target.$type<br>\n";
if (!copy("$dest","../$fotobasebig/$target.$type")) {  echo "<br>ERROR<br>"; } else {
if ($foto1=="") {
echo "THUMB: ../$fotobasebig/$target.$type -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$fotobasebig/$target.$type","../$fotobasesmall/tn_$target.$type",$pix,$pix);
$foto1="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>";
}
$foto2.="<img src='"."$fotobasebig/$target.$type"."' border=0><br>"; }
}
}
} else {
$tmpdir=explode ("/", $dest);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($dest.$secret_salt.$htpath);
$tmptype=explode(".", $file);
$type=strtolower(array_pop($tmptype));
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
if (($type=="jpg")||($type=="png")||($type=="gif")) {
if (file_exists("../$dest")) {
//echo ".\"<textarea>$dest</textarea>\"";
echo "<br>[3] $start. COPY: ../$dest -> ../$fotobasebig/$target.$type<br>\n";
if (!copy("../$dest","../$fotobasebig/$target.$type")) { echo "<br>ERROR<br>";  } else {
if ($foto1=="") {
echo "THUMB: ../$fotobasebig/$target.$type -> ../$fotobasesmall/tn_$target.$type<br>\n";
createthumb("../$fotobasebig/$target.$type","../$fotobasesmall/tn_$target.$type",$pix,$pix);
$foto1="<img src='"."$fotobasesmall/tn_$target.$type"."' border=0>";
}
$foto2.="<img src='"."$fotobasebig/$target.$type"."' border=0><br>"; }
}
}
}
echo ".";
//echo "<br>";
}
$out[9]="$foto1";
$out[10]="$foto2";

unset($ren, $tmpdir, $k, $v, $count, $dir, $target, $tmptype, $type, $realdir);
//}

}
$stun=implode("|",$out);
unset($out,$tmpft1,$tmpft2,$key,$val);
$start+=1;
}
} else {
$refr="<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=$htpath/admin/photo_copy.php?pix=$pix&start=$max&end=$zf\">";
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
echo "<form class=form-inline action=\"photo_copy.php\" method=POST>
<input type=hidden name=\"speek\" value=\"$speek\">
<br><br><div align=center><b>".$lang[866].":</b> <input type=text size=4 name=pix value=150> ".$lang[867]."
<br><br>
<input type=submit value=\"Copy&Thumb\">
</div>
</form>";
}
?>
</body>
</html>
