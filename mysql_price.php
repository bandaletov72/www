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
$login="";
$password="";
$fid=0;
$valid=0;
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);
if ($view_price==0) {echo "Restricted area"; exit;}
require ("./templates/$template/$speek/config.inc");

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



if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}
if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();
$admin_url="";
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

require ("./modules/functions.php");
include ("./templates/$template/meta.inc");
require ("./templates/$template/title.inc");
$fold=".";
echo "</head>
<body>";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
$cartlist="";
$cart_title="";
$cartlist_total=0;

$add_query="";
$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());
$sc=0;
if ($view_deleted_goods==0) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {
$add_query.=" WHERE (`on_offer`='1')";
}
}
//echo $mysql_query;
$mysql_query="SELECT * FROM $file"."$add_query LIMIT 0,20000";
//echo $mysql_query;
$result=mysql_query("$mysql_query");

while($row = @mysql_fetch_row($result)) {
$st="";
while(list($k,$v)=each($row)) {
//echo $k."=>".$v."<br>";
if ($k>9) {
$st.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}

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
//OPT
$didx=$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$outc[$ddidx])*$kurss/$okr)); $price=@$outc[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
$skid="";
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<small><b>".$lang['prebuy']."</b></small>";} else {$prem1="";$prem2="";$prbuy=""; }
if(substr($details[7],0,3)!="OPT") {
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$outc[8])==TRUE)) { $strto=strtoken(@$outc[8],"%"); $skid=$lang[233]." $strto%"; $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font> "; if ((preg_match("/\%/", @$outc[8])==TRUE)&&(doubleval($strto)>0)) {$ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr)); $skid=$lang[233]." $strto%";} else { @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $skid=$lang[233]." ".$podstavas["$dir|$subdir|"]."%"; $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")): $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike><small>".$currencies_sign[$_SESSION["user_currency"]]."</small></font> / <b>".$lang[176]."</b> "; $skid="VIP ".$lang[233]." $vipprocent"."%"; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); endif;
} }
if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
//if (($valid=="1")&&($details[7]=="ADMIN")): $admin_functions = "<br><br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=$fid&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=$fid','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=$fid','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br><br>"; endif;

@$kwords=@$outc[8];
@$foto1=@$outc[9];
@$foto2=@$outc[10];
@$vitrin=@$outc[11];
@$onsale=substr(@$outc[12],0,1);
@$brand_name=@$outc[13];
@$ext_lnk=@$outc[14];

$linkfile="";

@$full_descr=@$outc[15];
$pricetax="";
$tax="";
$tax=@$outc[$taxcolumn];
if ($tax=="") {$tax=$deftax;}
if ($tax_function==1) {$pricetax=($okr*round($price/(1+($tax/100))/$okr)); }

$unifid=md5(@$outc[3]." ID:".@$outc[6]);
if ($dir!="") {
$tmp_dirsub["$dir|$subdir"]="$dir|$subdir";
if ($dir==$lang[418]) {unset($tmp_dirsub["$dir|$subdir"]);}
@$tmp_massive["$dir|$subdir"].=($okr*round(@$price/$okr))."|$nazv|$unifid|$vipold|$skid|$pricetax|$tax\n";
if ($dir==$lang[418]) {unset($tmp_massive["$dir|$subdir"]);}
$sc+=1;
 }
}

mysql_close($mysqldb);
//sort($tmp_massive);
//reset($tmp_massive);
echo "1 $valut = ".(1/$kurs)." $init_currency<br>\n";
echo "<h1>".$lang[47]." - ".date("d M Y / H:i", time())."</h1>";
echo "<table border=0>";
@natsort($tmp_dirsub);
@reset($tmp_dirsub);
$ktov=1;

if ($tax_function==1) { $colsp=6; } else {$colsp=4;}
while (list ($keyds, $stds) = @each ($tmp_dirsub)) {
echo "</table><table border=1 width=100% cellspacing=0 cellpadding=5 bordercolordark=\"#FFFFFF\" bordercolorlight=\"#000000\"><tr><td colspan=$colsp bgcolor=\"#d4d4d4\"><b>» ".str_replace("|", " / ", $stds)."</b></td></tr>\n
<tr><td bgcolor=\"#f2f2f2\" align=\"center\" width=20px><b>#</b></td><td bgcolor=\"#f2f2f2\"><b>".$lang['name']."</b></td><td bgcolor=\"#f2f2f2\" align=\"center\" width=120><b>%</b></td>";
if ($tax_function==1) {echo "<td bgcolor=\"#f2f2f2\" align=\"center\" width=120><b>".$lang[780].",%</b></td><td bgcolor=\"#f2f2f2\" align=\"center\" width=120><b>".$lang[781].",".$currencies_sign[$_SESSION["user_currency"]]."</b></td>"; }
echo "<td bgcolor=\"#f2f2f2\" align=\"center\" width=120><b>".$lang['price'].",".$currencies_sign[$_SESSION["user_currency"]]."</b></td></tr>\n\n";
$tmp_tmp=explode ("\n", $tmp_massive["$stds"]);
natcasesort($tmp_tmp);
reset($tmp_tmp);
while (list ($keytm, $sttm) = each ($tmp_tmp)) {
//echo $sttm."<br>";
if ($sttm!=""){
$stnew=explode("|",$sttm);
if (@$stnew[0]==0){$stnew[0]=$lang['prebuy'];}
echo "<tr><td align=\"center\">$ktov.&nbsp;</td><td><a href=\"$htpath/index.php?unifid=".@$stnew[2]."\">".@$stnew[1]."</td><td align=\"center\">".@$stnew[4]."&nbsp;</td>";
if ($tax_function==1) { if (@$stnew[5]==0) {@$stnew[5]="";} echo "<td align=\"center\">".@$stnew[6]."&nbsp;</td><td align=\"center\">".@$stnew[5]."&nbsp;</td>"; }
echo "<td align=\"center\">".@$stnew[3]."<b>".@$stnew[0]."</b>&nbsp;</td></tr>\n";
$ktov+=1;
}
}
unset($tmp_tmp, $tmpst);
}
echo "</table>";


echo "» <small>Copyright (c)".date("Y",time()).", <a href=\"$htpath\"><b>$shop_name</b></a>, <a href=\"$htpath/price.php?speek=$speek\">$htpath/price.php?speek=$speek</a></small>";
echo "</body>
</html>";
?>
