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
echo "<!DOCTYPE html><html>
<TITLE>RANDOM RENAMER</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body>";
echo $css;


$st=0;
$base="";
$minibase="";
$file=".$base_file";
$f=fopen($file,"r");
$zf=0;
$rating=Array();
$curt=time();
while(!feof($f)) {
echo "\n";


$stun=fgets($f);
if (trim($stun!="")) {
$out=explode("|",$stun);

$inifid=md5(@$out[3]." ID:".@$out[6]);
@$foto1=@$out[9];
@$foto2=@$out[10];
if (trim ($foto1)!="") {
$fotomass1=explode("src='",@$foto1);
while (list ($key1, $val1) = each ($fotomass1)) {
if ($key1>0 ) {
$dest=strtoken($val1,"'");
$ren[$dest]=str_replace("$htpath/","../",$dest);
}
}
while (list ($k, $v) = each ($ren)) {
if ($k!=$v) {
$tmpdir=explode ("/", $v);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($file.$curt);
$tmptype=explode(".", $file);
$type=array_pop($tmptype);
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
echo "RENAME: $dir/$file -> $dir/$target.$type<br>REPLACE: $k -> $htpath/$realdir/$target.$type<br><br>\n";
@rename ("$dir/$file", "$dir/$target.$type");
$stun=str_replace("$k","$htpath/$realdir/$target.$type",$stun);
}
}
unset($ren, $tmpdir, $k, $v, $count, $dir, $target, $tmptype, $type, $realdir);
}
if (trim ($foto2)!="") {
$fotomass2=explode("src='",@$foto2);
while (list ($key, $val) = each ($fotomass2)) {
if ($key>0 ) {
$dest=strtoken($val,"'");
$ren[$dest]=str_replace("$htpath/","../",strtoken($val,"'"));
}
}
while (list ($k, $v) = each ($ren)) {
if ($k!=$v) {
$tmpdir=explode ("/", $v);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($file.$curt);
$tmptype=explode(".", $file);
$type=array_pop($tmptype);
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
echo "RENAME: $dir/$file -> $dir/$target.$type<br>REPLACE: $k -> $htpath/$realdir/$target.$type<br><br>\n";
@rename ("$dir/$file", "$dir/$target.$type");
$stun=str_replace("$k","$htpath/$realdir/$target.$type",$stun);
}
}
unset($ren, $tmpdir, $k, $v, $count, $dir, $target, $tmptype, $type, $realdir);
}

unset($out,$tmpft1,$tmpft2,$key,$val);
}
$base.=$stun;
}
fclose($f);
//echo "<pre>$base</pre>";
$file=".$base_file";
$f=fopen($file,"w");
fputs($f,$base);
echo "<h1>OK. $lang[658]</h1>";
?>
</body>
</html>
