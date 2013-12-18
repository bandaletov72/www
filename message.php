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
$details=Array();
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}

//setlocale(LC_ALL,"ru_RU.CP1251");
$cartlist="";
// default headers ***********
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);
require ("./templates/$template/$speek/config.inc");
require ("./templates/$template/css.inc");
//require ("./templates/$template/css.inc");
require ("./modules/webcart.php");
if(isset($_GET['read'])) { $read=$_GET['read']; } elseif(isset($_POST['read'])) { $read=$_POST['read']; } else { $read=0; }
if (!preg_match('/^[a-z0-9_]+$/i',$read)) { $read=0;}
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt));
if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}
session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

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

if ((!@$qty) || (@$qty=="")): $qty=1; endif;
if (!preg_match("/^[0-9]+$/",$qty)) { $qty=1;}

if ((!@$password) || (@$password=="")): $password=""; endif;
$valid=@$_SESSION["user_valid"];
if ((!@$valid) || (@$valid=="")): $valid="0"; endif;

if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")){$valid=$cart->authorize("$login","$password");}
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;


function save_sess($sessf,$sessid,$usersesname,$curutime,$minupdate,$telf,$realnameu,$r181){
if ($usersesname!="") {
$sesf=0;
$ses=Array();
$onlineusers=Array();
$ses=file($sessf);
while (list($sesk,$sesv)=each($ses)) {
$sestmp=Array();
$sestmp=explode("|",$sesv);
//echo $sestmp[1]." [$minupdate] : ". date("H:i:s d/m/Y", $sestmp[0]). "&lt;" . date("H:i:s d/m/Y", ($curutime-($minupdate*59)))."<br>";
if (doubleval($sestmp[0])<($curutime-($minupdate*59))){
//drop user from online users
$ses[$sesk]="";
} else {
//set online status
$onlineusers[$sestmp[1]]=$sestmp[0];
}
if ($sestmp[1]==$usersesname) {
//Yes its me!
$ses[$sesk]=time()."|$usersesname|$sessid|$telf|$realnameu|$r181|\n";
$sesf=1;
}
}
if ($sesf==0) {
$ses[]=time()."|$usersesname|$sessid|$telf|$realnameu|$r181|\n";
}
$onlineusers[$usersesname]=time();
//echo "Запись списка онлайновых юзеров.";
$fp=fopen($sessf,"w");
fputs($fp,implode("",$ses));
fclose ($fp);
//echo "Запись времени посещения $usersesname.";
$fp=fopen("./admin/userstat/".$usersesname."/lastvisit.time","w");
fputs($fp,time());
fclose ($fp);
}
}
if (!isset($_SESSION["user_realnameu"])) {
if (@$_SESSION["user_login"]!="") {
$details = $cart->get_details();
$_SESSION["user_telf"]="(".$details[19].")".$details[5];
$_SESSION["user_realnameu"]=$details[3];
$_SESSION["user_r181"]=$details[18]." - ".$details[17];
}
}

$admin_url="";
require ("./modules/functions.php");
$u_mes="";
if (isset($_SESSION["user_realnameu"])) {

save_sess("./admin/online.txt",session_id(),$_SESSION["user_login"],time(),$min_update,$_SESSION["user_realnameu"],$_SESSION["user_telf"],$_SESSION["user_r181"]);


$u_mesf="./admin/userstat/".$_SESSION["user_login"]."/inbox.txt";
if (file_exists($u_mesf)) {
$fp=fopen($u_mesf,"r");
$u_mes=fread($fp,filesize($u_mesf));
fclose($fp);
}
if ($u_mes!="") {
header("Content-type: text/html; charset=$codepage");
echo "<table border=0 width=500><tr><td>".str_replace("<!-- goto -->", "<br><br><a href=$htpath/index.php?action=inbox&speek=$speek>".$lang[1482]."</a>" , trim(trim( str_replace("'","", str_replace("\"","",$u_mes)))))."<br><OBJECT classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 codebase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0 WIDTH=1 HEIGHT=1><PARAM NAME=movie VALUE=sms.swf> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=$nc0> <EMBED src=sms.swf quality=high bgcolor=$nc0 WIDTH=1 HEIGHT=1 TYPE=application/x-shockwave-flash PLUGINSPAGE=http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash></EMBED></OBJECT></td></tr></table>";
if ($read==1) {
} else {
@unlink($u_mesf);
}

}
}
?>
