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
header("Content-type: text/html; charset=utf-8");
require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);

require ("./templates/$template/$speek/config.inc"); require ("./templates/$template/css.inc"); if ($view_yml==0) {echo "Restricted area"; exit;}
require("./modules/webcart.php");
$custom_cart=file("./templates/$template/$speek/custom_cart.inc");
$goo=Array();
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (substr(@$ccc[0],0,2)=="g:"){
$indx=$ccc[0];
$goo[$indx]=(17+$cc_num);
}
}
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
$out=explode("|",str_replace(chr(0x01), "", $line));
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
function c2u($str) {
global $codepage;

if ( extension_loaded('mb_string') ) {
       return mb_convert_encoding($str, "utf-8", $codepage);
   } elseif ( extension_loaded('iconv') ) {
       return iconv($codepage, "utf-8", $str);
   }

}

echo "<?xml version=\"1.0\"?>
<rss xmlns:g=\"http://base.google.com/ns/1.0\" version=\"2.0\">
<channel>
<title>".str_replace("http://", "", str_replace("http://www.", "", $htpath))." - ".c2u($shop_name)."</title>
  <link>$htpath</link>
  <description>Actual date: ".date("Y-m-d H:i")."</description>
\n";
//��� ����� ���������

/*
echo "<categories>\n";
$catid=file("$base_loc/catid.txt");
$id=1;
//������� �������
while (list ($key, $st) = each ($catid)) {
$str=explode("|",$st);
if ($str[2]=="") {
$idx=$str[1];
$ids[$idx]=$id;
$id+=1;
}
}
reset($catid);
//������� ����������
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

//������ ����������� ������
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

//��� ������
echo "<offers>\n";

*/
$file="$base_file";
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
$num=1000;
while(!feof($f)) {


$st=str_replace(chr(0x01), "", fgets($f));

// ������ �� ������������ ��������� ������ $st
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
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<font color=#aaaaaa size=3><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else {   @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} }
}
if (($onsale=="1")&&($price!=0)) {
$num+=1;

if ($price>0) { $trues="true"; } else { $trues="false"; }
$foto1=str_replace(" ", "", str_replace("\"","", str_replace("<img src=", "", str_replace(">", "", str_replace("border=1", "", str_replace("border=0", "", str_replace("'", "", str_replace("<br>", "", $foto1))))))));
if ($foto1!="") { if (substr($foto1,0, 7)!="http://") {$foto1=$htpath."/".$foto1;}}
echo "<item>
<title>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",$nazv)))))))))))."</title>
<link>$htpath/index.php?unifid=".md5(@$nazv." ID:".@$ext_id)."</link>
<description>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",str_replace("^", " ",str_replace("[/radio]", "",str_replace("[radio]", "",str_replace("[/option]", "",str_replace("[option]", "",$description))))))))))))))))."</description>
<g:image_link>$foto1</g:image_link> <g:price>$price $valut</g:price> <g:condition>new</g:condition> <g:id>".c2u($ext_id)."</g:id><g:brand>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$brand)))))))))))."</g:brand> <g:shipping>\n";
$indx=$goo['g:country'];
echo "    <g:country>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$out[$indx])))))))))))."</g:country>\n";
$indx=$goo['g:service'];
echo "    <g:service>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$out[$indx])))))))))))."</g:service>\n";
$indx=$goo['g:price'];
echo "    <g:price>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$out[$indx])))))))))))."</g:price>\n";
echo "     </g:shipping>\n";
$indx=$goo['g:google_product_category'];
echo "<g:google_product_category>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$out[$indx])))))))))))."</g:google_product_category>\n";
echo "<g:product_type>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$out[$indx])))))))))));
$indx=$goo['g:product_type'];
echo " &gt; ".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$out[$indx])))))))))))."</g:product_type>\n";
$indx=$goo['g:gtin'];
echo "<g:gtin>".c2u(str_replace("\"", "&quot;", str_replace("\'", "&apos;", str_replace("&", "&amp;", str_replace("<", "&lt;", str_replace(">", "&gt;", strip_tags(str_replace("<br>", "\n", str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",  str_replace("<br><br>", "<br>",@$out[$indx])))))))))))."</g:gtin>\n";

echo "</item>\n";

  }
  }
  }
echo "</channel>
</rss>";

?>
