<?php
//echo "jsphp.innerHTML+='<b>Hello world!</b>';"; exit;
$bu1="";
$bu2="";
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek']; else $speek="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$speek)) { $speek="";}
if(isset($_GET['currency'])) $currency=$_GET['currency']; elseif(isset($_POST['currency'])) $currency=$_POST['currency']; else $currency="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$currency)) { $currency="";}
$priceot=0; $pricedo=999999999;
$cartl=Array();
$fold="."; require ("./templates/lang.inc");
if(isset($_GET['token'])) $token=$_GET['token']; elseif(isset($_POST['token'])) $token=$_POST['token']; else $token="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$token)) { $token="";}
if ($token!=md5($secret_salt.$htpath)) { echo "No token!"; exit; }
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

require ("./templates/$template/$speek/config.inc"); require ("./templates/$template/css.inc"); if ($view_yml==0) {echo "Restricted area"; exit;}
//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";
if (@file_exists($c_filename)==TRUE) {
$custom_cart=file("./templates/$template/$speek/custom_cart.inc");
}
//end


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

if (!isset($_SESSION["ymlcur"])){ $_SESSION["ymlcur"]=0; $indcur="ymlcur";  }

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


echo "<?xml version=\"1.0\" encoding=\"$codepage\"?>
<!DOCTYPE yml_catalog SYSTEM \"shops.dtd\">
<yml_catalog date=\"".date("Y-m-d H:i")."\">
<shop>
<name>".str_replace("http://", "", str_replace("http://www.", "", $htpath))."</name>
<company>".$shop_name."</company>
<url>$htpath/</url>
<currencies>
<currency id=\"$valut\" rate=\"1\"/>
</currencies>\n";
//тут будут категории
echo "<categories>\n";
$catid=file("$base_loc/catid.txt");
$id=1;
//ѕолучим разделы
while (list ($key, $st) = each ($catid)) {
$str=explode("|",$st);
if ($str[2]=="") {
$idx=$str[1];
$ids[$idx]=$id;
$id+=1;
}
}
reset($catid);
//ѕолучим подразделы
while (list ($key, $st) = each ($catid)) {
$str=explode("|",$st);
if ($str[2]=="") {
} else {
$idx=$str[1]."|".$str[2];
$pids[$idx]=$id;
$id+=1;
}
}

reset($catid);

//“еперь выстраиваем список
while (list ($key, $st) = each ($catid)) {
$str=explode("|",$st);
if ($str[2]=="") {
$idx=$str[1];
echo "<category id=\"".$ids[$idx]."\">".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",$str[1]))))))))))."</category>\n";
} else {
$idx=$str[1]."|".$str[2];
$idx2=$str[1];
$id+=1;
echo "<category id=\"".$pids[$idx]."\" parentId=\"".$ids[$idx2]."\">".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",$str[2]))))))))))."</category>\n";
}
}



echo "</categories>\n";

//тут товары
echo "<offers>\n";
$file="$base_file";
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
$num=1000;
while(!feof($f)) {


$st=str_replace(chr(0x01), "", fgets($f));

// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
if (($st=="\n")||($st=="")||($out[0]=="")) { } else {
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
$pidname=$dir."|".$subdir;
$pidid=@$pids[$pidname];

if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$out[6].$artrnd), -7));
@$nazv=strtoken(@$out[3],"*")." $ext_id";
} else {
@$ext_id=@$out[6];
@$nazv=@$out[3];
}
reset($custom_cart);
$cartlisto="";
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
$ncc=17+$cc_num;
//echo trim(@$ccc[1]).": ".@$out[$ncc]." ".trim(@$ccc[2])." \n";
if (($cc_line!="")&&
(@$ccc[0]!="")&&
(@$ccc[1]!="")&&
($cc_line!="\n")&&
(@$out[$ncc]!="")&&
($ncc!=$taxcolumn)&&
($ncc!=$othertaxcolumn)&&(substr(@$ccc[0],0,2)!="g:")
&&($ncc!=$catdirrow3)&&
($ncc!=$catdirrow4)&&
($ncc!=$metatitlerow)&&
($ncc!=$metadescrow)&&
($ncc!=$metakeyrow)) {
$cartlisto .=trim(@$ccc[1]).": ".@$out[$ncc]." ".trim(@$ccc[2])." \n";
}
}
//echo $cartlisto;
@$price=@$out[4];
@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
@$curcur=substr(@$out[12],1,3);

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

$ueopt=@$opt;
@$opt=round(@$opt*$optkurs);


@$description=@$out[7];

$admin_functions="";
$vipold="";
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];
@$vitrin=@$out[11];

@$onsale=substr(@$out[12],0,1);
@$brand=@$out[13];
@$full_descr=@$out[15];

if (isset($podstavas["$dir|$subdir|"])) {
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<font color=#aaaaaa size=3><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=$image_path/sale.png align=center valign=middle><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=$image_path/sale.png valign=middle align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} }
}
if (($onsale=="1")&&($price!=0)) {
$num+=1;

if ($price>0) { $trues="true"; } else { $trues="false"; }
$foto1=str_replace(" ", "", str_replace("\"","", str_replace("<img src=", "", str_replace(">", "", str_replace("border=1", "", str_replace("border=0", "", str_replace("'", "", str_replace("<br>", "", $foto1))))))));
if ($foto1!="") { if (substr($foto1,0, 7)!="http://") {$foto1=$htpath."/".$foto1;}}
echo "<offer id=\"$num\" available=\"$trues\">
<url>$htpath/index.php?unifid=".md5(@$nazv." ID:".@$ext_id)."</url>
<price>$price</price>
<currencyId>$valut</currencyId>
<categoryId>$pidid</categoryId>
<picture>".str_replace(" ", "", str_replace("\"","", str_replace("<img src=", "", str_replace(">", "", str_replace("border=1", "", str_replace("border=0", "", str_replace("'", "", str_replace("<br>", "", $foto1))))))))."</picture>
<delivery>true</delivery>
<name>".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",str_replace("&", " and ",str_replace("&amp;", " and ",$nazv))))))))))))."</name>
<vendor>".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",str_replace("&", " and ",str_replace("&amp;", " and ",$brand))))))))))))."</vendor>
<vendorCode>".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",$ext_id))))))))))."</vendorCode>
<description>".strip_tags(str_replace(chr(0x02), " ",str_replace(chr(0x01), " ",str_replace(chr(0x03), " ",str_replace(chr(0x04), " ",str_replace(chr(0x05), " ", str_replace(chr(0x06), " ",str_replace(chr(0x07), " ", str_replace(chr(0x0C), "\n",str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",str_replace("&", " and ",str_replace("&amp;", " and ",str_replace("^", " ",str_replace("[/radio]", "",str_replace("[radio]", "",str_replace("[/option]", "",str_replace("[option]", "",$description)))))))))))))))))))))))))." \n".
str_replace(chr(0x02), " ",str_replace(chr(0x01), " ",str_replace(chr(0x03), " ",str_replace(chr(0x04), " ",str_replace(chr(0x05), " ", str_replace(chr(0x06), " ",str_replace(chr(0x07), " ", str_replace(chr(0x0C), "\n",str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",str_replace("&", " and ",str_replace("&amp;", " and ",str_replace("^", " ",str_replace("[/radio]", "",str_replace("[radio]", "",str_replace("[/option]", "",str_replace("[option]", "",$full_descr)))))))))))))))))))))))))." \n".
str_replace(chr(0x02), " ",str_replace(chr(0x01), " ",str_replace(chr(0x03), " ",str_replace(chr(0x04), " ",str_replace(chr(0x05), " ", str_replace(chr(0x06), " ",str_replace(chr(0x07), " ", str_replace(chr(0x0C), "\n",str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",str_replace("&", " and ",str_replace("&amp;", " and ","$cartlisto")))))))))))))))))))))."</description>
</offer>\n";

  }
  }
  }
echo "</offers>
</shop>
</yml_catalog>";

?>
