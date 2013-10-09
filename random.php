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

$priceot=0; $pricedo=999999999;
$cartl=Array();
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc"); require ("./templates/$template/css.inc");
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


if (!isset($_SESSION["user_currency"])){

if ($currency==""){
reset($currencies);
//session_register ("user_currency");
while (list ($keycr, $stcr) = each ($currencies)) {
$_SESSION["user_currency"]=$keycr;
break;
}


}
if (!isset($currency)) { $currency=""; }
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$currency)) { $currency="";}

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


$top_sales_spisok = "";
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

$file="$base_loc/top_sales.txt";
$file="$base_file";
$fmasp=file($file);
$vit_qty=0;
$ff=0;
shuffle($fmasp);
while (list ($keyz, $st) = each ($fmasp)) {
// теперь мы обрабатываем очередную строку $st
$out=explode("|",str_replace("\n", "", $st));
$tst=@explode("^",@$out[0]);

@$file=@$tst[1];
unset ($tst);
$ddescription="";
@$dir=@$out[1];
@$subdir=@$out[2];
if (($dir=="")||($subdir=="")) {continue;}

@$nazv=@$out[3];
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

@$ext_id=@$out[6];
@$description=@$out[7];

$admin_functions="";
$vipold="";

$sales="";

if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
if (isset($podstavas["$dir|$subdir|"])) {
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\"><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $strto=doubleval($podstavas["$dir|$subdir|"]);  $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} }
}
@$kwords=@$out[8];
$optionselect="";
$xz=0;
$fo=0;
$optionselect="";


@$foto1=@$out[9];
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
@$foto2=@$out[10];
@$vitrin=@$out[11];
reset($cartl);

@$onsale=substr(@$out[12],0,1);
if ($view_deleted_goods==0) {if (($price==0)||($price=="0")||($price=="")){if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {$ff+=1; continue;} }}if (($onsale=="0")||($price<$priceot)||($price>$pricedo)||($dir==$lang[418])): $ff+=1; continue; endif;

@$brand_name=@$out[13];

if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
if (preg_match("/\.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"ѕрослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }
unset ($awv1, $awv2);
$wh=" width=".$style['ww']." height=".$style['hh'];
if (($style['ww']=="")||($style['hh'])=="") {
@$fi= str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$foto1))));
if (@file_exists(".$fi")){$imagesz = @getimagesize(".$fi"); $wh=" width=".ceil(($imagesz[0])/2)." height=".ceil(($imagesz[1])/2); }else{$wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$foto1=str_replace("<img ", "<img". $wh ." vspace=3 hspace=10 title=\"".str_replace("\"", "", str_replace("\'", "",$nazv))."\" ",  stripslashes(@$foto1));
$foto1=str_replace("width= height= ", "", $foto1);
@$foto1=str_replace("border=0", "style=\"border: 0px solid ".lighter($nc6,-10).";\" align=left", @$foto1)."$sales";
@$kolvo=@$out[16];
$ff+=1;
$qty=doubleval($qty);
$shtuk=$lang['pcs'];
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;
$novina=""; if ((@$out[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/",@$out[8])==TRUE) { $novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}
$sortby="";
$sps[$s]="<div style=\"float:left; overflow: hidden; width:150px\"><table border=0><tr><td valign=\"center\"><a href=\"$htpath/index.php?unifid=".md5(@$out[3]." ID:".@$out[6])."\">$foto1</a></td></tr><tr><td valign=\"center\"><a href=\"$htpath/index.php?unifid=".md5(@$out[3]." ID:".@$out[6])."\">$nazv</a><br>$vipold&nbsp;<b>$price</b>".$currencies_sign[$_SESSION["user_currency"]]."</td></tr></table></div>";
//if (($foto1!="")&&($view_vitrin!=0)&&($price!=0)): $vitrin_content[$vit_qty] = "$file|$dir|$subdir|$nazv ID:".@$out[6]."|$price|$opt|$description|$foto1|$ff|"; $vit_qty+=1; endif;
$files_found += 1;
$s+=1;
}

}





//«акрываем базу
$make_col=$cols_of_goods;
$st=0;
$ddt=0;
reset ($sps);

$start=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}

$skl1=strtoken($sps[($start+$st)],"|");
$sklname= str_replace($skl1."|", "", $sps[($start+$st)]);
$sps[($start+$st)]=$skl1;
$stoks="";
$val = $sps[($start+$st)]; //см выше
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("[sklad]","",$val);
//$val.="</td></tr>";
} else {
$fnamef="./admin/sklad/stock/$sklname.txt";
if (@file_exists($fnamef)) {
$filef = @fopen ($fnamef, "r");
if ($filef) { $stoks= "<small>".str_replace(">", "><br>", @fread($filef, @filesize ($fnamef)))."</small>";}
fclose ($filef);
}else {
$stoks= "<small><img src=$image_path/stockno.gif><br>".$lang[175]."</small>";
}
$val=str_replace("[sklad]",$stoks,$val);
}
$st += 1;
if ($st<=$top_sales_max) {
$ddt += 1;

$zz+=1;

$top_sales_spisok .= "$val\n";

}
}
$top_sales_spisok = "<table border=0 cellspacing=5 cellpadding=5><tr><td valign=top>
<a href=\"".$_SERVER['PHP_SELF']."\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[162]."\"></a>
</td>
<td>
<div style=\"align: center;\"> $top_sales_spisok</div>
</td>
<td valign=top>
<a href=\"".$_SERVER['PHP_SELF']."\"><img src=\"$image_path/next.gif\" border=0 title=\"".$lang[162]."\"></a>
</td></tr></table>
\n";

if ($files_found==0): $top_sales_spisok =""; $error = ""; endif;
if ($s==0): $top_sales_spisok=""; endif;
$s=0;
echo $top_sales_spisok;
?>
