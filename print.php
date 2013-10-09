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
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
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
if(isset($_GET['fid'])) $fid=$_GET['fid']; elseif(isset($_POST['fid'])) $fid=$_POST['fid']; else $fid="";
if (!preg_match("/^[a-z0-9_]+$/",$fid)) { $fid="";}
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
$nc0="#ffffff";
$nc1="#000000";
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
if (($valid=="0")&&(@$login!="")&&(@$password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}
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

if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();
$admin_url="";

require ("./modules/functions.php");
include ("./templates/$template/meta.inc");
require ("./templates/$template/title.inc");
$bad=$htpath;
if (@$_SESSION["user_banned"]=="1"){
/*echo "<title>502 Page Error</title><h1>502 Bad Gateway</h1><p>The server encountered an internal error or misconfiguration and was unable to complete your request.<br><br>
Please contact the server administrator, postmaster@apache.org and inform them of the time the error occurred, and anything you might have done that may have caused the error.
<br><br>More information about this error may be available in the server error log.
<hr><i>Apache/1.3.26 Server at ".str_replace("http://", "", $htpath)." Port 8080</i>
</i></p>";

exit;
*/
include ("./templates/$template/banned.inc");
exit;

}
$fold=".";

//echo $css;
echo "<body bgcolor=$nc0>";
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
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact shveps@dpz.ru to buy license for this host."; exit;}

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

//
reset($langs);
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$st=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $st));
}else{
$st=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $st));
}
}
$outc=explode("|",$st);
if (count($outc)<=9): continue;  endif;
@$file=@$outc[0];;
@$dir=@$outc[1];
@$subdir=@$outc[2];
if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$outc[6].$artrnd), -7));
@$nazv=strtoken(@$outc[3],"*")."</b> [".$lang[419].": "."$ext_id]<b>";
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
//additonal item options
$aofound=0;
$aocount=0;
while ($aocount>=0) {
$ao[$aocount] = ExtractString($description, "[option]", "[/option]");
if ($ao[$aocount]=="") {break; } else {
$subao=explode("#", $ao[$aocount]);
$subaocont="";
$subaoname="";
$aoptions="";
while (list($subaokey,$subaoval)=each($subao)) {
if ($subaokey==0) {$subaoname=$subaoval;} else {
$tmpaoval=explode("^","$subaoval");

if (substr($tmpaoval[1],-1)=="%") {} else {$add_valut=$currencies_sign[$_SESSION["user_currency"]];
if (substr($tmpaoval[1],0,1)=="-") {$add_znak="";} else {$add_znak="+";}
$subaocont.="".$tmpaoval[0]." $add_znak".($okr*(round(($tmpaoval[1]*$kurss)/$okr)))."$add_valut<br>\n";
$aoptions.="";
}
}
}

$description=str_replace("[option]".$ao[$aocount]."[/option]", "<b>".str_replace ("<br>" , "", trim($subaoname)).":</span></b><br>$subaocont\n", $description);
}
$aocount+=1;
}


$radio_found=0;
$radio_count=$aocount;
while ($radio_count>=0) {
$radio_[$radio_count] = ExtractString($description, "[radio]", "[/radio]");
if ($radio_[$radio_count]=="") {break; } else {
$subradio_=explode("#", $radio_[$radio_count]);
$subradio_cont="";
$subradio_name="";
while (list($subradio_key,$subradio_val)=each($subradio_)) {
if ($subradio_key==0) {$subradio_name=$subradio_val;} else {
$tmpradio_val=explode("^","$subradio_val");

if (substr($tmpradio_val[1],-1)=="%") {} else {$add_valut=$currencies_sign[$_SESSION["user_currency"]];
if (substr($tmpradio_val[1],0,1)=="-") {$add_znak="";} else {$add_znak="+";}

$subradio_cont.=str_replace ("<img " , "<img ", str_replace ("<br>" , "", trim($tmpradio_val[2])))." ".$tmpradio_val[0]." $add_znak".($okr*(round(($tmpradio_val[1]*$kurss)/$okr)))."$add_valut<br>\n";

}
}
}
$description=str_replace("[radio]".$radio_[$radio_count]."[/radio]", "<b>".str_replace ("<br>" , "", trim($subradio_name)).":</span></b><br>$subradio_cont", $description);
}
$radio_count+=1;
}

$description=str_replace("[input1]", "", $description);
$radio_count+=1;
$description=str_replace("[input2]", "", $description);
$radio_count+=1;
$description=str_replace("[input3]", "", $description);
$radio_count+=1;
$description=str_replace("[inputarea]", "", $description);

$description=str_replace("[upload]", "", $description);
$admin_functions="";
$vipold="";
//OPT
$didx=$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$outc[$ddidx])*$kurss/$okr)); $price=@$outc[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT

if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<small><b>".$lang['prebuy']."</b></small>";} else {$prem1="";$prem2="";$prbuy=""; }
if(substr($details[7],0,3)!="OPT") {
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$outc[8])==TRUE)) { $strto=strtoken(@$outc[8],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike><small>".$currencies_sign[$_SESSION["user_currency"]]."</small></font><br>"; if ((preg_match("/\%/", @$outc[8])==TRUE)&&(doubleval($strto)>0)) {$ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/@$okr));} else {$strto=doubleval($podstavas["$dir|$subdir|"]);  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/@$okr));  } } else {
if (($valid=="1")&&($details[7]=="VIP")): $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike><small>".$currencies_sign[$_SESSION["user_currency"]]."</small></font> / <b>$lang[176]</b> "; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); endif;
}
}
if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>".$currencies_sign[$_SESSION["user_currency"]]." <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
if (($valid=="1")&&($details[7]=="ADMIN")): $admin_functions = "<br><br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=$fid&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=$fid','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=$fid','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br><br>"; endif;
if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
@$kwords=@$outc[8];
@$foto1=@$outc[9];
$foto1=str_replace("<img ", "<img". @$wh ." hspace=5 vspace=5 title=\"$nazv\"",  stripslashes(@$foto1));

@$foto2=@$outc[10];
$foto2=str_replace("<img ", "<img". @$wh ." hspace=5 vspace=5 title=\"$nazv\"",  stripslashes(@$foto2));
$foto2=$foto1;
@$vitrin=@$outc[11];
@$onsale=substr(@$outc[12],0,1);
@$brand_name=@$outc[13];
@$ext_lnk=@$outc[14];

$linkfile="";

@$full_descr=@$outc[15];
//statistic added 11.09.2005 by Pavel A. Bandaletov
$fname=substr(md5($nazv." ID:".@$outc[6]), 0, 20);
$flood="";

if ($foto2!=""){
$fotos=str_replace("<br>", "<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">", $foto2);
} else {
$fotos=str_replace("<br>", "<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">", $foto1);
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
$f_con="";
if (@$ext_lnk!="") {



$tmpex=explode(" ", $ext_lnk);



while (list ($keyex, $stex) = each ($tmpex)) {
if (@$stex!="") {


if (@file_exists("$base_loc/content/".$stex.".txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/".$stex.".txt" , "r");
$page_content1=Array();
$page_content = fread($pageopen, filesize("$base_loc/content/".$stex.".txt"));

$out1[1]="";
$out1=explode("==",$page_content);
if ($out1[1]!="") {
$page_title=str_replace("\s", "",str_replace("\t", "",str_replace("\r", "",str_replace("\n", "", trim(strtoken(strtoken(strip_tags(trim($out1[1])),"["),"|"))))));


} else {
$page_title = "";
}
fclose ($pageopen);

$page_content=str_replace("==".$out1[1]."==", "" , $page_content);
unset($out1);
$f_con.="<a name=\"$stex\"></a><br><br><b>".$page_title."</b><br>";
$f_con.="<br>$page_content";
if ($stex=="s") {

$handle=opendir('./admin/content/');

while (($file = readdir($handle))!==FALSE) {
if (substr($file,0,1)=="s") {
$fp = fopen ("./admin/content/$file" , "r");

$all= fread ($fp, 2048);
$out1=Array();
$out1[1]="";
$out1=explode("==",$all);
if ($out1[1]!="") {
$line=tr_replace("\s", "",str_replace("\t", "",str_replace("\r", "",str_replace("\n", "", trim(strtoken(strtoken(strip_tags(trim($out1[1])),"["),"|"))))));
} else {
$line = $lang[221];
}
$line=substr($line, 0 , 82);
fclose ($fp);
$out=explode(".",$file);
$c = $out[0];
if (strlen($c)==1) {
$name="<!--00000--><a name=\"$c\"></a><b><a href='$htpath/index.php?page=$c'><font color=$nc2>$line :</font></a></b><br>";
} else {
if ($page==$c) {
$name = "<!--$c--><a name=\"$c\"></a><b><font color=$nc3>»</b>&nbsp;<b>$line</b></font>";
} else {
$name = "<!--$c--><a name=\"$c\"></a><b><font color=$nc4>»</font></b>&nbsp;<a href='$htpath/index.php?page=$c'>$line</a>";
}
}
$f_con.="$name<br>\n";
//echo $name;
} else {
continue;
}
}

closedir ($handle);
}
unset ($output, $page_content, $pageopen);
}

}
}

}

$cartlist = "<!-- $nazv -->$fotos<br><br><b>$nazv</b><br>".str_replace("$lang[196]:" , "<b>$lang[196]:</b>", str_replace("$lang[197]:" , "<b>$lang[197]:</b>",$description))."<br>$full_descr";
if ($view_date_of_goods!=0) {$cartlist.="<br><small>\n<b>".$lang[198]."</b> ". @date("d-m-Y", @filemtime(".$fi"))."</small>";}
if ($view_goodsprice==1){ $cartlist.=" $prbuy$prem1<br><b>".$lang['price'].":</b> $vipold <b>".($okr*round(@$price/$okr))."</b><small>".$currencies_sign[$_SESSION["user_currency"]]."</small>"; }
$cartlist.="$prem2";
//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";

$cc_cart="";
if (@file_exists($c_filename)==TRUE) {
$cartlist .= "<br><br><div align=left><table border=0 cellspacing=0 cellpadding=5>";
$custom_cart1=file("./templates/$template/$speek/custom_cart.inc");
if (@file_exists("./templates/$template/$speek/cc_".$podstava["$dir|$subdir|"].".inc")) {
$custom_cart2=file("./templates/$template/$speek/cc_".$podstava["$dir|$subdir|"].".inc");
$custom_cart=Array_merge($custom_cart1,$custom_cart2);
} else {
$custom_cart=$custom_cart1;
}

$ddd=0;
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);

if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")&&(substr(@$ccc[0],0,2)!="g:")){
$ncc=17+$cc_num;
$fw=0;
reset ($whsalerprice);
while(list($kk,$vv)=each($whsalerprice)) {
if ($vv==$ncc){$fw=1;}
}
if ($fw==0) {
if ((trim(@$outc[$ncc])!="")
&&($ncc!=$taxcolumn)
&&($ncc!=$othertaxcolumn)
&&($ncc!=$catdirrow3)
&&($ncc!=$catdirrow4)
&&($ncc!=$metatitlerow)
&&($ncc!=$metadescrow)&&($ncc!=$metakeyrow)&&($ncc!=$minorderrow)) {
if (($ddd/2)==round($ddd/2)) {
$cartlist .="<tr bgcolor=$nc6><td valign=\"top\" width=50%><b>".trim(@$ccc[1]).":</b></td><td width=50% valign=\"top\" align=\"justify\">".@$outc[$ncc]."</td></tr>";
} else {
$cartlist .="<tr><td width=50%><b>".trim(@$ccc[1]).":</b></td><td width=50% valign=\"top\" align=\"justify\">".@$outc[$ncc]."</td></tr>";
}
$ddd+=1;
}
}
}
}
$cartlist .= "</table>$f_con</div><br><br>";
}
//end

$cart_title="<small>".$lang[201]."</small> / <small>$dir</small> / <small>$subdir</small>";

echo  @$cart_title."<br><br>". @$cartlist."<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">";
echo "
<script language=javascript>
window.print()
</script>";
}

echo "» <small>Copyright (c)".date("Y",time()).", <a href=\"$htpath\"><b>$shop_name</b></a>, <a href=\"$htpath/index.php?unifid=$unifid\">$htpath/index.php?unifid=$unifid</a></small>";
echo "</body>
</html>";
?>
