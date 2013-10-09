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
$pricetax="";
$valid=0;
$login="";
unset($details);
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");


function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}

//echo "jsphp.innerHTML+='<b>Hello world!</b>';"; exit;
$bu1="";
$bu2="";
if(isset($_GET['till'])) $till=$_GET['till']; elseif(isset($_POST['till'])) $till=$_POST['till']; else $till="";
if (!preg_match("/^[0-9a-z]+$/i",$till)) { $till="";}  $till=doubleval($till);
if(isset($_GET['op'])) $op=$_GET['op']; elseif(isset($_POST['op'])) $op=$_POST['op']; else $op="";
if (!preg_match("/^[0-9a-z]+$/i",$op)) { $op="";}
if(isset($_GET['user'])) $user=$_GET['user']; elseif(isset($_POST['user'])) $user=$_POST['user']; else $user=0;
if (!preg_match("/^[0-9a-zA-Z_\.-]+$/",$user)) { $user=0;}
if(isset($_GET['file'])) $file=$_GET['file']; elseif(isset($_POST['file'])) $file=$_POST['file']; else $file="";
if (!preg_match("/^[¸¨a-zA-Zà-ÿÀ-ß0-9\&\;\%_\.]+$/",$file)) { $file="";}
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek'];  else  $speek="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$speek)) { $speek="";}

if(isset($_GET['sum'])) $sum=$_GET['sum']; elseif(isset($_POST['sum'])) $sum=$_POST['sum']; else $sum=0;
if (!preg_match("/^[0-9\,\.]+$/",$sum)) { $sum=0;}
$sum=doubleval($_GET["sum"]);

$priceot=0; $pricedo=999999999;

$cartl=Array();
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require ("./modules/translit.php");
require("./modules/webcart.php");
function buyit($op, $user, $sum, $init_currency,$file,$basename) {
if ($op=="electron1") {
if(is_dir("./admin/attach/sell")!=true) { mkdir("./admin/attach/sell",0755); }
if(is_dir("./admin/attach/sell/".rawurldecode($user))!=true) { mkdir("./admin/attach/sell/".rawurldecode($user),0755); }
@unlink("./admin/attach/sell/".rawurldecode($user)."/$file");
rename($basename, "./admin/attach/sell/".rawurldecode($user)."/$file");
$basename="./admin/attach/sell/".rawurldecode($user)."/$file";
rem_walet(md5($user).md5(strrev($user)),$sum,$init_currency);
}
if ($op=="electron1000") {
rem_walet(md5($user).md5(strrev($user)),$sum,$init_currency);
}
}

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

require ("./templates/$template/css.inc");

if (!isset($_SESSION["user_currency"])){
if (!isset($currency)) {$currency="";}
if ($currency==""){
reset($currencies);
//session_register ("user_currency");
while (list ($keycr, $stcr) = each ($currencies)) {
$_SESSION["user_currency"]=$keycr;
break;
}


}

if ($currency!=""){
$found_currency=0;
while (list ($keycr, $stcr) = each ($currencies)) {
if ($currency==$keycr){
//session_register ("user_currency");
$_SESSION["user_currency"]="$keycr";
$found_currency=1;
}
}
if ($found_currency==0){
reset($currencies);
//session_register ("user_currency");
while (list ($keycr, $stcr) = each ($currencies)) {
$_SESSION["user_currency"]=$keycr;
break;
}
}
}

} else {

if (isset($currency)){
reset($currencies);
while (list ($keycr, $stcr) = each ($currencies)) {
if ($currency==$keycr){

//session_register ("user_currency");
$_SESSION["user_currency"]="$keycr";
}
}
}
}

$okr=0;

$okr=$currencies_round[$_SESSION["user_currency"]];
if ($okr==0) {$okr=0.01;}
reset ($currencies);
while (list ($keycr, $stcr) = each ($currencies)) {
if (($keycr==$_SESSION["user_currency"])&&($keycr!="")) {
$kurs=$stcr;
$valut=$_SESSION["user_currency"];
}
}
$details = $cart->get_details();
$valid=@$_SESSION["user_valid"];
$valid=substr($valid,0,300); if (!isset($valid)){$valid="";} if (!preg_match("/^[0-9]+$/",$valid)) { $valid="";}
if ($valid==""): $valid="0"; endif;
if ((!@$_COOKIE["user_name"]) || (@$_COOKIE["user_name"]=="")): $_COOKIE["user_name"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["user_name"])) { @$_COOKIE["user_name"]="";}
if ((!@$_COOKIE["user_pass"]) || (@$_COOKIE["user_pass"]=="")): $_COOKIE["user_pass"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["user_pass"])) { @$_COOKIE["user_pass"]="";}


if (($_COOKIE["user_name"]!=="")&&($_COOKIE["user_pass"]!=="")&&($valid=="0")) {


$login=$_COOKIE["user_name"];
$password="";
if (@file_exists("./admin/userstat/".$login.".txt")) {
$file="./admin/userstat/".$login.".txt";
} else {
$file="./admin/db/users.txt";
}
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);

// next stroke $st
$out=explode("|",$st);

@$login2=@$out[1];
@$password2=@$out[2];

if (($login=="$login2")&&(md5(substr($artrnd.$password2.$secret_salt, 0, 128))==$_COOKIE["user_pass"])) {
$password=$password2;
break;
}
}
fclose($f);

}


$servername=str_replace("http://", "", str_replace("www.", "", str_replace($_SERVER['SERVER_NAME'], "", $htpath)))."/";
$cookiedir=$servername;
if ($cookiedir=="/") {$cookiedir="";}
if ($cookiedir=="//") {$cookiedir="";}

if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
if (file_exists("./images/".$valut.".png")==TRUE) { $vsygn="<img align=absbottom src=$htpath/images/".$valut.".png>"; } else {$vsygn=$currencies_sign[$valut]; }
$md=md5(rawurldecode($file).$user.$secret_salt.toHache($op).$till.$sum)."-".toHache(rawurldecode($file).$user.$secret_salt.toHache($op).$till.$sum);
if(isset($_GET['token'])) $token=$_GET['token']; elseif(isset($_POST['token'])) $token=$_POST['token']; else $token="";
if (!preg_match("/^[0-9a-zA-Z-]+$/i",$token)) { $token="";}
if ($md==$token) {
if (time()<=$till) {
$proceed=0;
if ($op==1) {
//spisat dengi
$proceed=1;
} else {
$proceed=1;
}
$file=str_replace("$3F", "", str_replace("$3f", "", str_replace("%20", " ",$file)));
$file= str_replace("/", "",  str_replace("../", "", str_replace("\\", "", $file)));
if (file_exists("./admin/attach/$file")) {
$type=str_replace(".", "", strtolower(substr($file,-3)));
$basename="./admin/attach/$file";

if ($type=="txt") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: text/plain");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}

if ($type=="zip") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: application/zip");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}

if ($type=="pdf") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}

if ($type=="rar") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: application/rar");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}

if ($type=="mp3") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: audio/mp3");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}
if ($type=="jpg") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: image/jpeg");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}
if ($type=="gif") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: image/gif");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}
if ($type=="png") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: image/png");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}
if ($type=="doc") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: application/msword");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}
if ($type=="xls") {
buyit($op, $user, $sum, $init_currency,$file,$basename);
    $file_name = basename($basename);

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=$file");
    header("Content-Length: " . filesize($basename));

    readfile($basename);
    exit;
}
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
echo "<br><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"OOPS!\"><b>".$lang[1563]."<br><br></b><a href=$htpath/index.php>". $shop_name."</a>";

} else {
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
echo "<br><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"OOPS!\"><b>".$lang[1562]."<br><br></b><a href=$htpath/index.php>". $shop_name."</a>";
}
} else {
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
echo "<br><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"OOPS!\"><b>".$lang[1575].":".date("d.m.Y H:i:s")."<br><br></b><a href=$htpath/index.php>". $shop_name."</a>";
}
} else {
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
echo "<br><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"OOPS!\"><b>".$lang[1579]."<br><br></b><a href=$htpath/index.php>". $shop_name."</a>";
}
?>
