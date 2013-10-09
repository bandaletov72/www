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
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ");
   return strtolower($str);
}
function detect_utf($Str) {
 for ($i=0; $i<strlen($Str); $i++) {
  if (ord($Str[$i]) < 0x80) $n=0; # 0bbbbbbb
  elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xF0) $n=3; # 1111bbbb
  else return false; # Does not match any model
  for ($j=0; $j<$n; $j++) { # n octets that match 10bbbbbb follow ?
   if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80)) return false;
  }
 }
 return true;
}



function utf8_win ($s){
$out="";
$c1="";
$byte2=false;
for ($c=0;$c<strlen($s);$c++){
$i=ord($s[$c]);
if ($i<=127) $out.=$s[$c];
if ($byte2){
$new_c2=($c1&3)*64+($i&63);
$new_c1=($c1>>2)&5;
$new_i=$new_c1*256+$new_c2;
if ($new_i==1025){
$out_i=168;
}else{
if ($new_i==1105){
$out_i=184;
}else {
$out_i=$new_i-848;
}
}
$out.=chr($out_i);
$byte2=false;
}
if (($i>>5)==6) {
$c1=$i;
$byte2=true;
}
}
return $out;
}
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
if(isset($_GET['sta'])) $sta=$_GET['sta']; elseif(isset($_POST['sta'])) $sta=$_POST['sta']; else $sta=0;
if (!preg_match("/^[0-9]+$/",$sta)) { $sta=0;}
if(isset($_GET['catid'])) $catid=$_GET['catid']; elseif(isset($_POST['catid'])) $catid=$_POST['catid']; else $catid="";
if (!preg_match("/^[a-z0-9_]+$/",$catid)) { $catid="";}
if(isset($_GET['unifid'])) $unifid=$_GET['unifid']; elseif(isset($_POST['unifid'])) $unifid=$_POST['unifid']; else $unifid="";
if (!preg_match("/^[a-z0-9_]+$/",$unifid)) { $unifid="";}
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek'];  else  $speek="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$speek)) { $speek="";}
if(isset($_GET['currency'])) $currency=$_GET['currency']; elseif(isset($_POST['currency'])) $currency=$_POST['currency']; else $currency="";
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
header("Content-type: text/html; charset=$codepage");
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



$okr=$currencies_round[$_SESSION["user_currency"]];
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
if (file_exists("./admin/userstat/".$login.".txt")) {
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



if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}
$divleft="<div style=\"position: absolute; z-index: 1\"><img src=\"$image_path/left.png\" style=\"filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$image_path/left.png); width:expression(1); height:expression(1);\" /></div>";
$divright="<div style=\"position: relative; right:157px; text-align:right; z-index: 2;\"><img src=\"$image_path/right.png\" style=\"filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$image_path/right.png); width:expression(1); height:expression(1);\" align=right/></div>";


$fcontentsa=file("$base_loc/catid.txt");

$r="";
$sub="";
$ffcat=0;
$st=0;
while (list ($line_num, $line) = each ($fcontentsa)) {
$out=explode("|",$line);
$podstava[$out[1]."|".$out[2]."|"]=$out[0];
$podstavas[$out[1]."|".$out[2]."|"]=$out[4];
$st+=1;
}
$zz=0;
$olddir="";
$oldsubdir="";
$vitrin_content[0]="";
unset($sps);
if ((!@$brand) || (@$brand=="")): $brand=""; endif;
if ((!@$buy_row) || (@$buy_row=="")): $buy_row=""; endif;

if ((!@$qty) || (@$qty=="")): $qty=0; endif;
if ((!@$sss) || (@$sss=="")): $sss=0; endif;
if ((!@$perpage) || (@$perpage=="")): $perpage=$goods_perpage; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;

if ((!@$sub) || (@$sub=="")): $sub=""; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;

//if(isset($_GET['w'])) $w=$_GET['w']; elseif(isset($_POST['w'])) $w=$_POST['w']; else $w="";
$w=utf8_win(@$w);
$w=substr($w,0,500);   $w=str_replace("/", "", $w);
$w = str_replace(chr(36) , "", $w);
$w = str_replace(chr(13) , "", $w);   $w = str_replace(chr(27) , "", $w);
$w = str_replace(chr(10) , "", $w);   $w=toLower ($w);
$w=trim(stripslashes($w));
$w=strip_tags($w);
$w=str_replace("  ", " ", str_replace("  ", " ", str_replace("  ", " ", str_replace("  ", " ", str_replace("(", "",str_replace(")", "",str_replace("|", "",str_replace(",", " ",str_replace("[", "", str_replace("]", "", $w))))))))));
if (!isset($w)){$w="";} $w=trim(stripslashes($w)); if (!preg_match("/^[à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\/-]+$/i",$w)) { $w="";}
if ($w!="") {
$queries=Array();
$queries=explode(" ",$w);
$count=count($queries);
$minibase="";
$ff=0;

if ($smod=="site") {$search_tips_mode="site";}

if (file_exists("./admin/search/search_index.$speek")) {
$file="./admin/search/search_index.$speek";
} else {$minibase="$lang[93]";}

$f=fopen($file,"r");
while(!feof($f)) {
$stun=fgets($f);
reset($langs);
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$stun=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $stun));
}else{
$stun=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $stun));
}
}
$out=explode(" > "," > ".$stun);
$stun=strip_tags($stun);
$ext_id=substr(md5(@$out[5].$artrnd), -7);
$unifw=md5(@$out[2]." ID:".@$out[5]);
reset($queries);
$scount=0;
if ($hidart==1) {
$newname=strtoken($out[2],"*");
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ }else{ $stun=str_replace($out[2], $newname, $stun); $stun=str_replace($out[5], "" , $stun);   }} else { $stun=str_replace($out[2], $newname, $stun); $stun=str_replace($out[5], "" , $stun);}
} else {

}
$stun=toLower($stun);
while (list ($keyq, $lineq) = each ($queries)) {
if (@preg_match("/$lineq/i",$ext_id.toLower($stun))) {
if ($smod=="site") {$search_tips_mode="site";}
if ($smod=="shop") {$search_tips_mode="shop";}
if ($search_tips_mode=="shop") {
$out[2]=str_replace("$lineq", "<b>$lineq</b>", toLower($out[2]));
}
$scount+=1; }
//echo "$scount=$count $out[2]<br>\n";

if ($scount==$count) {
$ff+=1;
if (!isset($out[8])) {$out[8]="";}
$out[8]=str_replace("<img", "<img hspace=10 width=20 height=20",$out[8]);
if ($ff<=100) {
echo "<div onclick=javascript:location.href='"."$htpath/index.php?page=".$out[1]."' onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc1';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?page=".$out[1]."\"><font color=$nc5>".strtoken(strip_tags($out[2]),"|")."</font></a></div>";


}
}
}
}
if ($ff>50) {
echo "<br><div onclick=javascript:location.href='"."$htpath/index.php?query=".rawurlencode($w)."' onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc1';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?query=".rawurlencode($w)."\"><font color=$nc5>$lang[422] $ff...</font></a></div>";
}
fclose($f);


if ($smod=="site") { } else {
$search_tips_mode="shop";

$add_query="";
$file=$dbpref."_items_".$speek;

$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Search. Error-1 ".mysql_error());
if ($view_deleted_goods==0) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {
$add_query.=" `on_offer`='1'";
}
}
//echo $mysql_query;
$add_query1="";
reset($queries);
$zap="";
while (list ($keyq, $lineq) = each ($queries)) {
$add_query1.=$zap."`index` LIKE '%".mysql_real_escape_string(strip_tags($lineq))."%'";
$zap=" AND ";
}

$mysql_query="SELECT * FROM `".$dbpref."_minibase_".$speek."` WHERE ( ".$add_query1.$add_query.") ORDER BY `price` ASC LIMIT 0,101";
//echo $mysql_query;
$result=mysql_query("$mysql_query");

while($row = @mysql_fetch_assoc($result)) {
$stun="";
reset($langs);
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$stun=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $stun));
}else{
$stun=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $stun));
}
}
$out=explode("|",$stun);
$row['name']=strip_tags($row['name']);
$ext_id=$row['unifid'];

if ($hidart==1) {
$newname=strtoken($row['name'],"*");
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ }else{ $row['name']= $newname;   }} else { $row['name']= $newname;}
} else {

}
$row['name']=toLower($row['name']);
reset($queries);
while (list ($keyq, $lineq) = each ($queries)) {
$row['name']=str_replace("$lineq", "<b>$lineq</b>", toLower($row['name']));
}


//echo "$scount=$count $out[2]<br>\n";
$ff+=1;
$row['img']=str_replace("<img", "<img hspace=10 width=20 height=20",$row['img']);
if ($ff<=100) {
if ($hidart==1) {$hidnazv=strtoken($row['name'],"*")." ".$row['hidart'];
} else {
$hidnazv=$row['name'];
}
echo "<div onclick=javascript:location.href='"."$htpath/index.php?unifid=".$row['unifid']."' onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc1';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?unifid=".$row['unifid']."\"><font color=$nc5>".$row['img']."".$hidnazv."</font></a></div>";

}


}
if ($ff>50) {
echo "<br><div onclick=javascript:location.href='"."$htpath/index.php?query=".rawurlencode($w)."' onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc1';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?query=".rawurlencode($w)."\"><font color=$nc5>$lang[422] $ff...</font></a></div>";
}
mysql_close($mysqldb);
}
}
?>
