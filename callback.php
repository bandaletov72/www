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
$tel2="";
$fio2="";
$goodnazv="";
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

$good="";


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
if ($view_callback!=1) {echo "Not available!"; exit;}
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
$tel2=@$details[5];
$fio2=@$details[3];
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

$fo="";

if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}

if(isset($_GET['unifid'])) $unifid=$_GET['unifid']; elseif(isset($_POST['unifid'])) $unifid=$_POST['unifid']; else $unifid="";
if (!preg_match("/^[a-z0-9]+$/i",$unifid)) { $unifid="";}
if(isset($_GET['tel'])) $tel=$_GET['tel']; elseif(isset($_POST['tel'])) $tel=$_POST['tel']; else $tel="";
if (!preg_match("/^[à-ÿÀ-ß¸¨a-zA-Z0-9_\.\,\?\&\#\"\*\¹\+\!\;\:\ \%\(\)\/-]+$/i",$tel)) { $tel="";}
if(isset($_GET['fio'])) $fio=$_GET['fio']; elseif(isset($_POST['fio'])) $fio=$_POST['fio']; else $fio="";
if (!preg_match("/^[à-ÿÀ-ß¸¨a-zA-Z0-9_\.\,\?\&\#\"\*\¹\+\!\;\:\ \%\(\)\/-]+$/i",$fio)) { $fio="";}
if(isset($_GET['call'])) $call=$_GET['call']; elseif(isset($_POST['call'])) $call=$_POST['call']; else $call="";
if (!preg_match("/^[à-ÿÀ-ß¸¨a-zA-Z0-9_\.\,\?\&\#\"\*\¹\+\!\;\:\ \%\(\)\/-]+$/i",$call)) { $call="";}
if(isset($_GET['adr'])) $adr=$_GET['adr']; elseif(isset($_POST['adr'])) $adr=$_POST['adr']; else $adr="";
$adr=str_replace("\r",", ",str_replace("\n",", ",$adr));
if (!preg_match("/^[à-ÿÀ-ß¸¨a-zA-Z0-9_\.\,\?\&\#\"\*\¹\+\!\;\:\ \%\(\)\/-]+$/i",$adr)) { $adr="";}

if(isset($_GET['send'])) $send=$_GET['send']; elseif(isset($_POST['send'])) $send=$_POST['send']; else $send="";
if (!preg_match("/^[ok]+$/i",$send)) { $send="";}
if (($fio=="")&&($fio2!="")){$fio=$fio2;}
if (($tel=="")&&($tel2!="")){$tel=$tel2;}
$fio=substr($fio,0,100);
$tel=str_replace("+","", substr($tel,0,100));
$call=substr($call,0,100);
$adr=substr($adr,0,500);

require "./templates/$template/work_time.inc";
$minibase=""; $ff=0;
if ($unifid!="") {

if (@file_exists("$base_loc/minibase.txt")) {
$file="$base_loc/minibase.txt";
} else {$minibase="$lang[93]";}
$f=fopen($file,"r");
while(!feof($f)) {
$stun=fgets($f);
$out=explode("|",$stun);
$stun=strip_tags($stun);
$unifw=md5(@$out[2]." ID:".@$out[5]);
if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$out[5].$artrnd), -7));
$goodnazv=strtoken(@$out[2],"*")." $ext_id";
} else {
@$ext_id=@$out[5];
$goodnazv=@$out[2];
}

if ($unifw==$unifid) {
$out[8]=str_replace("<img", "<img width=20 height=20",$out[8]);
$good= "<div><a href=\"$htpath/index.php?unifid=$unifw\">".$out[8]."&nbsp;&nbsp;".$goodnazv."</a></div>";
$ff+=1;
}
}
}
$options="";

if ((date("H",time())<10)&&(date("D",time())!="Sun")&&(date("D",time())!="Sat")) {$options="<option value=\"".$lang[114]." ".date("d/m/Y",time())." ".$lang[766]."\">".$lang[114]." ".date("d/m/Y",time())." ".$lang[766]."</option>
<option value=\"".$lang[114]." ".date("d/m/Y",time())." ".$lang[767]."\">".$lang[114]." ".date("d/m/Y",time())." ".$lang[767]."</option>";}
if (date("H",time())>10) {
if ((date("D",time())!="Sun")&&(date("D",time())!="Sat")&&(date("D",time())!="Fri")) {$options.="<option value=\"".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[766]."\">".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[766]."</option>
<option value=\"".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[767]."\">".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[767]."</option>";} else {
$xx=1;
if (date("D",time())=="Sat") { $xx=2;}
if (date("D",time())=="Fri") { $xx=3;}
$options.="<option value=\"".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[766]."\">".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[766]."</option>
<option value=\"".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[767]."\">".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[767]."</option>";
}
} else {
if ((date("D",time())!="Sun")&&(date("D",time())!="Sat")&&(date("D",time())!="Fri")) {$options.="<option value=\"".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[766]."\">".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[766]."</option>
<option value=\"".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[767]."\">".$lang[765]." ".date("d/m/Y",(time()+86400))." ".$lang[767]."</option>";} else {
$xx=1;
if (date("D",time())=="Sat") { $xx=2;}
if (date("D",time())=="Fri") { $xx=3;}
$options.="<option value=\"".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[766]."\">".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[766]."</option>
<option value=\"".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[767]."\">".$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[767]."</option>";
}
}
$fo_title="";
if (@file_exists("$base_loc/content/x0006.txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/x0006.txt" , "r");
$fo = @fread($pageopen, @filesize("$base_loc/content/x0006.txt"));
if (preg_match("/==(.*)==/i", $fo, $output)) {
$fo_title=$output[1];
}
fclose ($pageopen);
$fo= str_replace("==$fo_title==", "" , $fo);
}
$adr=str_replace("[br]","\n",$adr);
$options.="<option value=\"".$lang[757]."\">".$lang[757]."</option>";
$contactform="<form action=\"$htpath/callback.php\" method=post><input type=hidden name=\"speek\" value=\"$speek\"><input type=hidden name=\"send\" value=\"ok\">
<input type=hidden name=\"unifid\" value=\"$unifid\">
<table class=table cellspacing=0 cellpadding=3 border=0>
<tbody>
<tr>
<td valign=top align=right bgcolor=$nc6><small><font style=\"text-transform: uppercase\"><b><font color=#b94a48 size=3>*</font>".$lang[74].":</b></font></small></td>
<td colspan=2 valign=top><input class=input-large type=text size=60 name=\"fio\" value=\"$fio\" style=\"width:100%\"></td></tr>
<tr>
<td valign=top align=right bgcolor=$nc6><small><font style=\"text-transform: uppercase\"><b><font color=#b94a48 size=3>*</font>".$lang[754].":</b></font></td>
<td colspan=2 valign=top><input type=text class=input-large size=60 name=\"tel\" value=\"$tel\" style=\"width:100%\"><br><small><i><font color=#468847><b>".$lang[756]."</b></font> ".$lang[769]."</i></small></td></tr>
<tr>
<td valign=top align=right bgcolor=$nc6><small><font style=\"text-transform: uppercase\"><b><font color=#b94a48 size=3>*</font>".$lang[755].":</b></font></td>
<td colspan=2 valign=top><select name=\"call\" style=\"width:100%\">$options</select>
<br><small><i>$wtime</i></small></td></tr>
<tr>
<td valign=top align=right bgcolor=$nc6><small><font style=\"text-transform: uppercase\"><b>".$lang[156]."</b></font></font><br><br><br><br><small><font color=#b94a48 size=3>*</font>".$lang[81]."!</small></td>
<td colspan=2 valign=top><textarea cols=60 rows=3 name=\"adr\" style=\"width:100%\">$adr</textarea>
<br><small><i>".$lang[61].", ".$lang[71].", ".$lang[68].", ".$lang[67].", ".$lang[65].", ".$lang[66].", ".$lang[64].", ".$lang[69].", ".$lang[63]."</i></small></td></tr>
<tr>
<td colspan=3>
".$fo."<br><div align=center><input type=submit class=\"btn btn-large btn-primary\" value=\"".$lang[145]."\"></div></td>
</tr>
</tbody></table></form><br>";
$zvon="<div class=\"comnts\"><i class=icon-envelope></i> ".$lang[752]."</div>".$lang[753]."<br>";
$errd="";
if ($send=="ok") {
if (($fio=="")||($tel=="")||($call=="")||($unifid=="")||($ff==0)) {
$errd="<b><font color=#b94a48 size=3>".$lang[759]."</font></b><br><br>";
if ($unifid=="") {$errd="<b><font color=#b94a48 size=3>".$lang[760]."</font></b><br>". $errd;}
echo  "<!DOCTYPE html><html><head><title>Call me!</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
</head><body>".$css."<div style=\"margin: 20px 20px 20px 20px;\">$zvon<br><b>".$lang[348]." </b>$good<br>$errd".
$contactform."</div></body></html>";
} else {
$mdses=md5($fio.$tel.$call.$adr.$unifid);
if (@!$_SESSION["$mdses"]) {
echo "<!DOCTYPE html><html><head><title>Call me!</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
</head><body>".$css."<div align=center><br><br><h4><img src=$image_path/smile.png>".$lang[323]."!</h4><br>".$lang[327]."<br><br><b>".$lang[348]." </b>$good<br><br><b>".$lang[758]."</b><div></body></html>";
@$_SESSION["$mdses"]=1;
//mail
$emailbody = "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>".$lang[244]." $nomer (". date("d.m.Y (D) H:i:s ") . ")</title>
<style>
@media print {

.noprint {
display: none;
}

}
</style>
</head>
<body>
$fio<br>
$tel<br>
$call<br>
$good<br>
$adr<br>
</body>
</html>
";
@mail ("$shop_mail","ZAKAZ", $emailbody."\n", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
//@mail ("$sms_mail","ZAKAZ ZVONKA", strip_tags($fio."\n".$tel."\n".$call."\n".$good), "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
$ssttaaggss=str_replace("|","", @$_SESSION["sfrom"]." / ".@$_SESSION["stag"]);
$stroke="$mdses|||$fio|||".date("d.m.Y  H:i:s",time())." <br>".str_replace("|", " ", @$_SERVER['REMOTE_ADDR'])."<br>".@$_SERVER['REMOTE_ADDR']."<br>".$ssttaaggss."||Orderdate: ".date("d.m.Y  H:i:s",time())."[br]".$fio."[br]".$tel."[br]".$call."[br]".strip_tags($good)."[br]".str_replace("\n","[br]", str_replace("\r","[br]",$adr))."[br]".$ssttaaggss."|0|8||||||\n";
$listname = ("./admin/baskets/list.txt");
$file = fopen ("./admin/baskets/list.txt", "r");
if (!$file) {
echo "<p> Error reading file <b>./admin/baskets/list.txt</b>.\n";
exit;
}
$html= fread($file, @filesize($listname));
fclose($file);
$file = fopen ("./admin/baskets/list.txt", "w");
if (!$file) {
echo "<p> Error openning file <b>./admin/baskets/list.txt</b> to save\n";
exit;
}
fputs ($file, "$stroke$html");
fclose ($file);


} else {
@$_SESSION["$mdses"]+=1;
echo "<!DOCTYPE html><html><head><title>Call me!</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
</head><body bgcolor=$nc0>".$css."<div align=center><br><br><h4><img src=$image_path/smile.png>".$lang[323]."!</h4><br>".$lang[763]." (".@$_SESSION["$mdses"]."). ".$lang[764]."<br><br><b>".$lang[348]." </b>$good<br><br><b>".$lang[758]."</b><div></body></html>";

}
}

} else {
if ($unifid=="") {
$errd="<b><font color=#b94a48 size=3>".$lang[761]."</font></b><br><br>";
}
if ($ff==0) {
$errd="<b><font color=#b94a48 size=3>".$lang[762]."</font></b><br><br>";
}
if ($errd=="") {
echo  "<!DOCTYPE html><html><head><title>Call me!</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
</head><body bgcolor=$nc0>".$css.
"<div style=\"margin: 20px 20px 20px 20px;\">$zvon<br><b>".$lang[348]." </b>$good<br>$errd</div>".
$contactform."</body></html>";
} else {
echo  "<!DOCTYPE html><html><head><title>Call me!</title><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
</head><body bgcolor=$nc0>".$css.
"<div style=\"margin: 20px 20px 20px 20px;\">$zvon<div align=center><br><br><img src=$image_path/question.png>$errd"."<br><br><br><b>".$lang[758]."</b></div></body></html>";
}

}
?>
