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
$themecontent="";
//setlocale(LC_ALL,"ru_RU.CP1251");
$viewpage_title="";
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
require("./modules/webcart.php");
session_cache_limiter ('nocache');
session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt));
if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

if ((!@$logout) || (@$logout=="")): $logout=""; endif;
if ($logout==1): $_SESSION["user_login"]="";  $_SESSION["user_password"]=""; $_SESSION["user_valid"]="0"; $valid="0"; session_destroy(); endif;

$cart =& $_SESSION['cart'];
if(!is_object($cart)){
$cart = new webcart();
if ((!@$_SESSION["user_valid"]) || (@$_SESSION["user_valid"]=="")):  @$_SESSION["user_login"]; @$_SESSION["user_password"]; $_SESSION["user_valid"]=""; endif;
if ($_SESSION["user_valid"]="") {
$_SESSION["user_login"]="";
$_SESSION["user_password"]="";
$_SESSION["user_valid"]="0";
}
}
if (!isset($login)){$login="";}
if (!isset($password)){$password="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$login)) { $login="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$password)) { $password="";}
if ((!@$login) || (@$login=="")): $login=""; endif;
if ((!@$password) || (@$password=="")): $password=""; endif;
$valid=@$_SESSION["user_valid"];
if ((!@$valid) || (@$valid=="")): $valid="0"; endif;

if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();

if (($valid=="1")&&($details[7]=="ADMIN")){

if (!isset($thteme)){$thteme="";} if (!preg_match("/^[a-zA-Z0-9_\.-]+$/i",$thteme)) { $thteme="";}
if ((@file_exists("./themes/$thteme.thtml"))&&($thteme!="")) {
$usetheme=0;
if (@file_exists("./themes/$thteme.thtml")) {
$usetheme=1;
$themeopen = fopen ("./themes/$thteme.thtml" , "r");
$themecontent = fread($themeopen, filesize("./themes/$thteme.thtml"));
fclose ($themeopen);

}
echo "<!DOCTYPE html><html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>Template $thteme</title>
</head><body>";

$themecontent=str_replace(str_replace("themes/","", $thteme)."_files", "themes/".$thteme."_files",$themecontent); //list of installed themes (languege themes)

echo $themecontent;
}

} else {
echo "Restricted";
}
echo "</body>
</html>";
?>

