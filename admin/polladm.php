<?php
set_time_limit(0);
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
require ("../templates/$template/css.inc");
if ((!@$action) || (@$action=="")){ $action=""; }
if ((!@$dir) || (@$dir=="")){ $dir=""; }
if ((!@$poll) || (@$poll=="")){ $poll=""; }
if (($poll!="")&&($dir!="")) {
$pollf="../poll/".$dir."/".$poll."/closed.txt";
if ($action=="close") {
if (file_exists($pollf)) {
echo "<h4>Poll already closed!</h4>";
} else {
$fp=fopen($pollf,"w");
fputs($fp,time());
fclose($fp);
echo "<h4>OK!</h4>";
}

} else {
if (file_exists($pollf)) {
unlink($pollf);
echo "<h4>OK!</h4>";
} else {
echo "<h4>Poll already opened!</h4>";
}

}
}
?>
