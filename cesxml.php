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
$priceot=0; $pricedo=999999;
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
require("./modules/webcart.php");
$oldanguage=$language;
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id();
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
<SHOP>
\n";
//тут будут категории

/*
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

*/
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

if (isset($podstavas["$dir|$subdir|"])) {
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<font color=#aaaaaa size=3><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=$image_path/sale.png align=center valign=middle><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=$image_path/sale.png valign=middle align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} }
}
if (($onsale=="1")&&($price!=0)) {
$num+=1;

if ($price>0) { $trues="true"; } else { $trues="false"; }
$foto1=str_replace(" ", "", str_replace("\"","", str_replace("<img src=", "", str_replace(">", "", str_replace("border=1", "", str_replace("border=0", "", str_replace("'", "", str_replace("<br>", "", $foto1))))))));
if ($foto1!="") { if (substr($foto1,0, 7)!="http://") {$foto1=$htpath."/".$foto1;}}
echo "<SHOPITEM>
<PRODUCT>".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",$nazv))))))))))."</PRODUCT>
<DESCRIPTION>".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",str_replace("^", " ",str_replace("[/radio]", "",str_replace("[radio]", "",str_replace("[/option]", "",str_replace("[option]", "",$description)))))))))))))))."</DESCRIPTION>
<URL>$htpath/index.php?unifid=".md5(@$nazv." ID:".@$ext_id)."</URL>
<ITEM_TYPE>new</ITEM_TYPE>
<DELIVERY_DATE>1</DELIVERY_DATE>
<IMGURL>$foto1</IMGURL>
<PRICE>$price</PRICE>
<PRICE_VAT>$price</PRICE_VAT>
<CATEGORYTEXT>".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;",$dir)))))." | ".str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;",$subdir)))))."</CATEGORYTEXT>
</SHOPITEM>\n";

  }
  }
  }
echo "</SHOP>";

?>
