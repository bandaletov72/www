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
if(isset($_GET['reload'])) $type=$_GET['reload']; elseif(isset($_POST['reload'])) $reload=$_POST['reload']; else $reload="";
if (!preg_match("/^[0-9a-z]+$/i",$reload)) { $reload="";}
if(isset($_GET['poll'])) $type=$_GET['poll']; elseif(isset($_POST['poll'])) $poll=$_POST['poll']; else $poll="";
if (!preg_match("/^[0-9a-z]+$/i",$poll)) { $poll="";}
if(isset($_GET['ssid'])) $ssid=$_GET['ssid']; elseif(isset($_POST['ssid'])) $ssid=$_POST['ssid']; else $ssid="";
if (!preg_match("/^[a-z0-9_]+$/",$ssid)) { $ssid="";}
if(isset($_GET['vote'])) $vote=$_GET['vote']; elseif(isset($_POST['vote'])) $vote=$_POST['vote']; else $vote="";
if (!preg_match("/^[a-z0-9_]+$/",$vote)) { $vote="";}
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek'];  else  $speek="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$speek)) { $speek="";}
if(isset($_GET['currency'])) $currency=$_GET['currency']; elseif(isset($_POST['currency'])) $currency=$_POST['currency']; else $currency="";
//echo "'".$user."'";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$currency)) { $currency="";}
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

require("./modules/webcart.php");

$oldanguage=$language;
session_cache_limiter ('nocache');
session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt));
if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start();
$sid=session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }
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
if (!isset($_SESSION["jscur"])){ $_SESSION["jscur"]=0; $indcur="jscur";  }

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
$user=$details[1];
if ($user=="") {$user="guest";}
$valid=@$_SESSION["user_valid"];
$valid=substr($valid,0,300); if (!isset($valid)){$valid="";} if (!preg_match("/^[0-9]+$/",$valid)) { $valid="";}
if ($valid==""): $valid="0"; endif;
if ((!@$_COOKIE["user_name"]) || (@$_COOKIE["user_name"]=="")): $_COOKIE["user_name"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["user_name"])) { @$_COOKIE["user_name"]="";}
if ((!@$_COOKIE["$user$poll"]) || (@$_COOKIE["$user$poll"]=="")): $_COOKIE["$user$poll"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["$user$poll"])) { @$_COOKIE["$user$poll"]="";}
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
header("Content-type: text/html; charset=$codepage");
if ($poll=="") { echo "<font color=#b94a48>$lang[979]</font>";} else {
if ($ssid!=session_id()) { echo "<font color=#b94a48>$lang[980]</font>";} else {
if ($ssid=="") { echo "<font color=#b94a48>$lang[980]</font>"; } else {
if ($poll=="") { echo "<font color=#b94a48>$lang[981]</font>"; } else {
$polldir="./poll/".substr($poll,0,3)."/".$poll;
$pollfile="./poll/".substr($poll,0,3)."/".$poll.".txt";
if (is_dir($polldir)!=true) { echo "<font color=#b94a48>$lang[979]</font>"; } else {
if (file_exists($polldir."/closed.txt")) {
echo "<font color=#b94a48>$lang[977]</font>";
} else {
if (file_exists($pollfile)!=true) {
 echo "<font color=#b94a48>$lang[979]</font>";
} else {
if ((@$_SESSION["$poll$user"]==1)||(@$_COOKIE["$user$poll"]==md5(substr($artrnd.$secret_salt, 0, 128)))) {
 echo "<font color=#b94a48>$lang[976]</font>";
} else {

if ($poll_ip_enable==1) {

if (file_exists($polldir."/".@$_SERVER['REMOTE_ADDR'].".txt")) {
//echo filemtime($polldir."/".@$_SERVER['REMOTE_ADDR'].".txt")." ". time()."<br>";
if (($poll_ip_hours*3600)>(time()-filemtime($polldir."/".@$_SERVER['REMOTE_ADDR'].".txt"))) {
echo "<font color=#b94a48>$lang[976] IP ".$lang['exists']."!</font>"; exit;
}
}
if ((@$_SERVER['REMOTE_ADDR']!="")&&(@$_SERVER['SERVER_ADDR']!="")&&(@$_SERVER['REMOTE_ADDR']!=@$_SERVER['SERVER_ADDR'])) {
$ipfp=fopen($polldir."/".@$_SERVER['REMOTE_ADDR'].".txt", "w");
fputs($ipfp,$inmname);
fclose ($ipfp);
}
}
$poll_m=file($pollfile);
$pollkk=0;
$polltosave="";
$polle=0;
while (list($pollk, $pollv)=each($poll_m)) {
$pollv=trim($pollv);
if (($pollv!="\n")&&($pollv!="")) {
if ($pollk==$vote) {
$polle=1;
$polltosave.=(doubleval($pollv)+1)."\n";
} else {
$polltosave.=$pollv."\n";
}
}
}
if ($polle==0) {
echo "<font color=#b94a48>$lang[981]</font>";
} else {
$fp=fopen($pollfile,"w");
fputs($fp,$polltosave);
fclose($fp);
if (!isset($_SESSION["$poll$user"])){ $_SESSION["$poll$user"]=1;  }
SetCookie("$user$poll", md5(substr($artrnd.$secret_salt, 0, 128)), time()+(3600*$poll_ip_hours),$cookiedir,$_SERVER['SERVER_NAME']);
echo "";
echo "<h4>".$lang[972]."</h4><br>";
echo "<font size=3>".$lang[973].": ".($vote+1)."</font>";

}
}

}
}
}
}
}
}
}
/*
if ($reload=="yes") {
echo "<script language=javascript>
</script>";}
*/
?>
