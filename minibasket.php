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

if ((!@$fid) || (@$fid=="")){ $fid=""; }
if (!preg_match("/^[a-z0-9_]+$/",$fid)) { $fid="";}
if ((!@$unifid) || (@$unifid=="")){ $unifid=""; }
if (!preg_match("/^[a-z0-9_]+$/",$unifid)) { $unifid="";}

$fcontentsa = file("$base_loc/catid.txt");
$r="";
$sub="";
$st=0; $out[2]=""; $out[4]=""; $out[0]=""; $out[1]="";
while (list ($line_num, $line) = each ($fcontentsa)) {
$out=@explode("|",$line);
$podstava[@$out[1]."|".@$out[2]."|"]=@$out[0];
$podstavas[@$out[1]."|".@$out[2]."|"]=@$out[4];

$st+=1;
}
$podstava["||"]="_";

header("Content-type: text/html; charset=$codepage");
if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();
$admin_url="";
require ("./modules/functions.php");

$fold=".";
if (($unifid!="") && ($unifid!=md5(" ID:"))) {
$cartlist="";
$cart_title="";
$cartlist_total=0;
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$tmpmsf=explode("|",$st);

$tmpfid=md5(@$tmpmsf[3]." ID:".@$tmpmsf[6]);

$sc+=1;
if ($unifid==$tmpfid) {
$fid=$sc;
break;
} else {
$fid=-1;
}
}

fclose($f);
}

if (($fid!=-1)&&($fid!="")) {
$maxh=160;
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}

if ((!@$ctext) || (@$ctext=="")): $ctext=""; endif;
if ((!@$cact) || (@$cact=="")): $cact=""; endif;
if ((!@$del_com) || (@$del_com=="")): $del_com=0; endif;
$fid-=1;
$cartlist="";
$cart_title="";
$cartlist_total=0;
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$sc+=1;


if ($fid==$sc-1) {

// теперь мы обрабатываем очередную строку $st

$outc=explode("|",$st);
if (count($outc)<=9): continue;  endif;
@$file=@$outc[0];;
@$dir=@$outc[1];
@$subdir=@$outc[2];

if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$outc[6].$artrnd), -7));
@$nazv=strtoken(@$outc[3],"*")." $ext_id";
} else {
@$ext_id=@$outc[6];
@$nazv=@$outc[3];
}
@$price=@$outc[4];
@$opt=@$outc[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
@$curcur=substr(@$outc[12],1,3);

if (($curcur=="")||($curcur=="$init_currency")) {
$kurss=$kurs;
} else {
if (isset($currencies[$curcur])) {
if ($curcur=="$valut") {
$kurss=1;
} else {
$kurss=($currencies[$valut]/$currencies[$curcur]);
}
} else {
$kurss=$kurs;
}
}
@$price=@$price*$kurss;
@$opt=round(@$opt*$kurss);

@$description=@$outc[7];
$admin_functions="";
$vipold="";
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<small><b>".$lang['prebuy']."</b></small>";} else {$prem1="";$prem2="";$prbuy=""; }
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$outc[8])==TRUE)) {
$strto=strtoken(@$outc[8],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike><small>".$currencies_sign[$_SESSION["user_currency"]]."</small></font><br>"; if ((preg_match("/\%/", @$outc[8])==TRUE)&&(doubleval($strto)>0)) {
$ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else {
$strto=doubleval($podstavas["$dir|$subdir|"]);
@$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")): $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike><small>".$currencies_sign[$_SESSION["user_currency"]]."</small></font>"; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); endif;
}
@$kwords=@$outc[8];
@$foto1=@$outc[9];
$foto1=str_replace("<img ", "<img hspace=5 vspace=5 title=\"$nazv\"",  stripslashes(@$foto1));

@$foto2=@$outc[10];
$foto2=str_replace("<img ", "<img hspace=5 vspace=5 title=\"$nazv\"",  stripslashes(@$foto2));

@$vitrin=@$outc[11];
@$onsale=substr(@$outc[12],0,1);
@$brand_name=@$outc[13];
@$ext_lnk=@$outc[14];

$linkfile="";

@$full_descr=@$outc[15];
//statistic added 11.09.2005 by EuroWebcart
$fname=substr(md5($nazv." ID:".@$outc[6]), 0, 20);
$flood="";

if ($foto2!=""){
$fotos=str_replace("<br>", "<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\">", $foto2);
} else {
$fotos=str_replace("<br>", "<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\">", $foto1);
}

if ((!@$_SESSION["fids[". ($fid+1). "]"]) || (@$_SESSION["fids[". ($fid+1). "]"])=="") {


@$kolvo=@$outc[16];



//$fotos=str_replace("><img ", "><br><img ", $foto2);
break;
}
}
}
fclose($f);
$tit=@$nazv;
$fid+=1;
$tt=0;


$cartlist = "<p><b>$nazv</b> $lang[208]</p><p>".$lang[860]."</p>";


}
if ($zero_price_incart==0) {if (($price==0)||($price=="")){$cartlist=""; } }
if ($cartlist!=""){
echo $cartlist;
}else{
echo "<h4>".$lang[42]."!</h4>".$lang['file']." ".$lang['222']." E4";
}
?>
