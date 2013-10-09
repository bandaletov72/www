<?php
//exit; //do not allow standalone mode
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");
$valid=0;
$nn=0;
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
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
function toUpper($str) {
$str = strtr($str, "àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ",
"ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß");
   return strtoupper($str);
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


require "../modules/functions.php";
require "../templates/$template/css.inc";
echo "<!DOCTYPE html><html>
<TITLE>Add to Classifies</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
$css
</HEAD>
<body>
";
$fold=".";
if ($cl_send!=1) {
echo "<h1>Add to classifieds</h1>";
echo "<div id=\"jscl\"></div><script language=javascript>
<!--

function choosecl() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/classifieds/cl_ajax.php?speek=$speek';
scriptNode.type = 'text/javascript';

}
function choosen(value) {
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/classifieds/cl_ajax.php?speek=$speek'+ '&level=' + value +'&uniq='+ new Date().getTime();
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
choosecl();
-->
</script>";
} else {
echo "OK. Lets writing classifieds...<br><br>";
echo "$cl_title<br>";
echo "$cl_description<br>";
echo "$cl_price<br>";
echo "$cl_level<br>";
echo "Sid=".session_id()."<br>";
}
?>
</body>
</html>

