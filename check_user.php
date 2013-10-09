<?php
if(isset($_POST['us']))  { $us=$_POST['us'];} else { echo "0"; exit; }
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",$us)) { echo "3"; exit;}

if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek']; else $speek="";
if (!preg_match("/^[a-z0-9_]+$/",$speek)) { $speek="";}

$us = trim($us);
/* Usage :
 *
 * require_once('/path/to/gd-gradient-fill.php');
 * $image = new gd_gradient_fill($width,$height,$direction,$startcolor,$endcolor,$step);
 */
$fold="."; require ("./templates/lang.inc");

if ($speek=="") {
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("./templates/$template/$speek/config.inc");

require ("./templates/$template/css.inc");
require ("./modules/functions.php");

require("./modules/webcart.php");
$oldanguage=$language;
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }
$cart =& $_SESSION['cart'];

if(!is_object($cart)){
$cart = new webcart();
}
if (!ini_get("register_globals")) {
if (version_compare(phpversion(), "4.1.0", "<") === true) {
if (isset($HTTP_SESSION_VARS)) $_SESSION &= $HTTP_SESSION_VARS;
}
if(!empty($_SESSION)) extract($_SESSION, EXTR_SKIP);
}

if ((strlen($us)<3)||(strlen($us)>30))  {echo "0"; } else {
$ver_nickname=$cart->ver_login($us);
if ($ver_nickname==TRUE) { echo "2"; } else { echo "1"; }

}


?>
