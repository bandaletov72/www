<?php

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

function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
//setlocale(LC_ALL,"ru_RU.CP1251");
$cartlist="";
// default headers ***********
@Header("HTTP/1.0 200 OK");
@Header("HTTP/1.1 200 OK");
@Header("Content-type: text/html");
@Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
@Header("Last-Modified: ".gmdate("D, M d Y H:i:s",(time()-14400))." GMT");
@Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@Header("Pragma: no-cache"); // HTTP/1.0
$fold="."; require ("./templates/lang.inc");
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
 require ("./templates/$template/css.inc");
require("./modules/webcart.php");
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }
$_SESSION["interest"]=""; 

?>
