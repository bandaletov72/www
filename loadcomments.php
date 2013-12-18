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
$comm_book="";
$pricetax="";
$valid=0;
$login="";
unset($details);
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");




if (!ini_get("register_globals")) {
extract($_GET, EXTR_SKIP);
extract($_POST, EXTR_SKIP);
extract($_COOKIE, EXTR_SKIP);
}
//echo "jsphp.innerHTML+='<b>Hello world!</b>';"; exit;
$bu1="";
$bu2="";
if(isset($_GET['unifmd'])) $type=$_GET['unifmd']; elseif(isset($_POST['unifmd'])) $unifmd=$_POST['unifmd']; else $unifmd="";
if (!preg_match("/^[0-9a-z]+$/i",$unifmd)) { $unifmd="";}
if(isset($_GET['speek'])) $type=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek']; else $speek="";
if (!preg_match("/^[0-9a-z]+$/i",$speek)) { $speek="";}

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


$js_spisok = "";
unset ($sps);
$sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;
$vitrina="";
$error="";
$kupil="";

$files_found=0;
$st=0;
$s=0;

//$file="$base_loc/$js.txt";
$titjs="";
$admin_book="";
if (@file_exists("./admin/comments/$unifmd.txt")==TRUE) {
$ef=fopen("./admin/comments/$unifmd.txt" , "r");
$commread=str_replace("<br><br>", "<br>",str_replace("<br><br>", "<br>",str_replace("<br><br>", "<br>",str_replace("'", "", str_replace("\"", "", str_replace("\n","<br>",str_replace("\r","<br>",str_replace(chr(10),"<br>", fread($ef, filesize("./admin/comments/$unifmd.txt"))))))))));
fclose($ef);
$comm_book=str_replace("\n", "", str_replace ("\"", "", str_replace ("'", "&quot;", str_replace("[adm]","<font color=$nc2>",str_replace("[/adm]","</font>", str_replace("[vote]","<img src=\"$image_path/vote",str_replace("[/vote]",".png\">",str_replace("[hr]", "<div class=clear><br></div>", str_replace("[i]", "<i class=muted>", str_replace("[/i]", "</i>", str_replace("[b]", "<b>", str_replace ("[/b]", "</b>", str_replace ("[br]", "<br>", str_replace("[amp]", "&", $commread))))))))))))));
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){$comm_book= str_replace("[ip]", "<a href=$htpath/index.php?action=userip&ban=ip_", str_replace("[/ip]", "&start=0&perpage=10&ipsort=>".$lang[186]."</a>", $comm_book));} else {$comm_book=str_replace("[ip]", " <a href=#", str_replace("[/ip]", "></a>", $comm_book));} } else {$comm_book=str_replace("[ip]", " <a href=#", str_replace("[/ip]", "></a>", $comm_book));}
}
//end comments editor



$js_spisok ="
var jscomms=document.getElementById('jscomm');
var jsphps=document.getElementById('jsphpcomm');
if (jsphps.innerHTML=='loading...') {
jscomm.innerHTML='$comm_book';
jsphps.innerHTML='';
}
";
/*
if ($files_found==0): $js_spisok =""; $error = ""; endif;
if ($s==0): $js_spisok=""; endif;

if (($unifid=="")&&($item_id=="")) {

if ($str<$js_max) {$js_spisok = "var jsp".$catid."=document.getElementById('jsphp".$catid."');
//var jsps".$catid."=document.getElementById('jsp".$catid."');
jsphp".$catid.".innerHTML='';
//jsps".$catid.".innerHTML='';";}

}
if (($str==1) &&($files_found==1)) {

$js_spisok = "var jsp".$catid."=document.getElementById('jsphp".$catid."');
//var jsps".$catid."=document.getElementById('jsp".$catid."');
jsphp".$catid.".innerHTML='';
//jsps".$catid.".innerHTML='';";
}
*/
$s=0;
echo "$js_spisok";
?>
