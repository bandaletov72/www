<?php
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
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
Error_Reporting(E_ALL & ~E_NOTICE);


if ((!@$podrazz) || (@$podrazz=="")): $podrazz=date("d-m-Y"); endif;
if ((!@$per) || (@$per=="")): $per=date("d.m.y"); endif;

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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
$fold="..";
require ("../templates/$template/css.inc");
require ("../modules/translit.php");

echo "<!DOCTYPE html><html>
<TITLE>THUMB</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body>
<h1>THUMB</h1>";
require("fileupload-class.php");


$path = "../$fotobasesmall/";
$acceptable_file_types = "image/gif|image/jpeg|image/pjpeg";
$default_extension = "jpg";
$watermark="(c)2011";
$qlty=75;
//Выведем все картинки


$st=0;
$val="<table width='100%'><tr>";
$handle=opendir("../$fotobasebig/");
while (($fileopen = readdir($handle))!==FALSE) {
If (($fileopen == '.') || ($fileopen == '..')) {
continue;
} else {

$tf=explode (".",substr($fileopen, -6));
$ftype=strtolower(@$tf[1]);
if (($ftype=="jpg")||($ftype=="jpeg")||($ftype=="gif")||($ftype=="png")) {
$size = intval((filesize ("../$fotobasebig/$fileopen"))/1024);
$imagesz = getimagesize("../$fotobasebig/$fileopen");
$fwidth  = floor($imagesz[0]);
$fheight = floor($imagesz[1]);
$maxw=$style['ww_v'];
$maxh=$style['hh_v'];
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
//if ($widt>$maxw){$widt=$maxw;}
if (($fwidth<=$maxw)&&($fheight<=$maxw)){$maxw=$fwidth;$widt=$fheight;}

$wh="width=".$maxw." height=".$widt;
$fileopens[$st] = "<td align='center' valign='top'><small><a href=\"#click\" onclick=\"window.open('$htpath/".$fotobasebig."/$fileopen','".str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",str_replace("-", "",$fileopen)))))."','statusbar=no,menubar=no,toolbar=no,scrollbars=yes,resizable=yes,width=".@floor($fwidth+20).",height=".@floor($fheight+20)."'); return false;\"><img src='image.php?src=../$fotobasebig/$fileopen&nh=$widt&nw=$maxw&h=$fheight&w=$fwidth&type=$ftype' $wh border=1 alt='".str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",$fileopen))))."'></a><br><small>$fileopen</small>
";
$st += 1;
}
}
}
closedir ($handle);
if (count(@$fileopens)==0): echo "Not found!<br><br><hr><center><b><b>Powered by:</b> <a href='http://www.eurowebcart.com'>Eurowebcart CMS</a> (c) Eurowebcart</small>"; exit; endif;
//сортировка по алфавиту//
rsort ($fileopens);
reset ($fileopens);
$total = count ($fileopens);
$st=0;
while ($st < $total) {
$val .= @$fileopens[($st)];
$st += 1;
}
$val.="</tr></table>";
echo "$val";
?>
<!--end-->
</body>
</html>
