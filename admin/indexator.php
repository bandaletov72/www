<?php
$nn=0;

function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
function toLower($str) {
$str = strtr($str, "АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЪЫЭЮЯ",
"абвгдеежзиклмнопрстуфхцчшщьъыэюя");
   return strtolower($str);
}
function toUpper($str) {
$str = strtr($str, "абвгдеежзиклмнопрстуфхцчшщьъыэюя",
"АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЪЫЭЮЯ");
   return strtoupper($str);
}
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
$fold="..";
$rrating="";

$sortas=0;
$fold=".."; require ("../templates/lang.inc");

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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("../templates/$template/$speek/config.inc");

require ("../modules/translit.php");

echo "
<html>
<TITLE>INDEX</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body bgcolor=#ffffff><div class=\"box ml mr\">
";

if (!file_exists(".$base_loc/catid.txt")) {

$reindex="<h1>STEP 2. WAIT...</h1><meta http-equiv=\"Refresh\" content=\"2; URL=".$scriptprefix."indexator.php?speek=$speek\">";
} else {
$reindex="<h1>OK</h1><meta http-equiv=\"Refresh\" content=\"2; URL=../index.php?speek=$speek\">";
}
$fcontentsy = @file(".$base_loc/catid.txt");
@reset($fcontentsy);
@natcasesort($fcontentsy);
$tmparrs=@array_reverse($fcontentsy);
unset($fcontentsy);
$fcontentsy=$tmparrs;
unset($tmarrs);
$st=0;
$catid="";
$rating=Array();
while (list ($line_numy, $liney) = @each ($fcontentsy)) {
$st+=1;
if (trim($liney)!="") {
$out=explode("|",trim(str_replace("\n", "",$liney)));

$tmy=$out[0];
$catidy[$tmy]=trim(str_replace("\n", "", @$out[3]));
$catidys[$tmy]=trim(str_replace("\n", "", @$out[4]));
$catidyt[$tmy]=trim(str_replace("\n", "", @$out[5]));
$catidyc[$tmy]=trim(str_replace("\n", "", @$out[6]));
$podstavasa[@$out[1]."|".@$out[2]."|"]=trim(str_replace("\n", "", @$out[5]));
if ($podstavasa[@$out[1]."|".@$out[2]."|"]=="") {$podstavasa[@$out[1]."|".@$out[2]."|"]=(1000-$st); }  else { $sortas=1; }
$sf=$podstavasa[@$out[1]."|".@$out[2]."|"];
$chars=intval(strlen($sf));
if ($chars==1): $sortby="00000$sf"; endif;
if ($chars==2): $sortby="0000$sf"; endif;
if ($chars==3): $sortby="000$sf"; endif;
if ($chars==4): $sortby="00$sf"; endif;
if ($chars==5): $sortby="0$sf"; endif;
if ($chars==6): $sortby="$sf"; endif;
$podstavasa[$out[1]."|".$out[2]."|"]=$sortby;
//echo $out[1]."|".$out[2]."|"."=".$podstavasa[$out[1]."|".$out[2]."|"]."<br>";
$podstavas[$out[1]."|".$out[2]."|"]=$catidys[$tmy];
}
}

unset ($rating);
$sym="•";




if ((isset ($theme_file))&& ($theme_file!="") && (@file_exists("../$theme_file"))) {
$usetheme=1;
$themeopen = fopen ("../$theme_file" , "r");
$themecontent = @fread($themeopen, @filesize("../$theme_file"));
fclose ($themeopen);
$carat = ExtractString($themecontent, "[cat]", "[/cat]");
if ($carat=="") { $carat="›"; }
}

$fold="..";
require "../modules/functions.php";
require "../templates/$template/css.inc";
$fp = fopen ("../style.css" , "w"); flock ($fp, LOCK_EX);
fputs($fp, str_replace("{nc10}", "[nc10]", str_replace("{lnc10}", "[lnc10]", $cssflush)));flock ($fp, LOCK_UN);
fclose($fp);
echo $css;


$st=0;
$minibase="";
$file=".$base_file";
$f=fopen($file,"r");
$zf=0;
$rating=Array();
while(!feof($f)) {
echo "\n";

$stun=fgets($f);
$outun=explode("|",$stun);
$outun[0]=$st;
$stun=implode("|",$outun);
$fcontents[$zf]=$stun;
//echo htmlspecialchars($fcontents[$zf])."<br>";
if ($friendly_url==1) {
if ($hidart!=1) {
$unifw=md5(@$outun[3]." ID:".@$outun[6]);
$man=translit(@$outun[3])."-".translit(@$outun[6]);
$fman=@fopen(".$base_loc/items/".$man.".man","w");
@fputs($fman,$unifw."\n".translit(@$outun[1]." ". @$outun[2]." "));
@fclose($fman);
}
}

if ((@$outun[3]!="")&&(substr(@$outun[12],0,1)=="1")) {
if ($view_deleted_goods==1) {
$minibase.=@$outun[1]."|".@$outun[2]."|".@$outun[3]."|".@$outun[4]."|".@$outun[5]."|".@$outun[6]."|".toLower(strip_tags(str_replace("<br>", " ", @$outun[7])))."|".@$outun[8]."|".@$outun[9]."|".@$outun[13]."|\n";

} else {
if (@$outun[4]!=0) {
$minibase.=@$outun[1]."|".@$outun[2]."|".@$outun[3]."|".@$outun[4]."|".@$outun[5]."|".@$outun[6]."|".toLower(strip_tags(str_replace("<br>", " ", @$outun[7])))."|".@$outun[8]."|".@$outun[9]."|".@$outun[13]."|\n";
}
}
}
if (@file_exists("./comments/votes/$unifw.txt")==TRUE) {
$tmpvotef=file("./comments/votes/$unifw.txt");
$vlevel=round(doubleval(trim($tmpvotef[0])));
unset($tmpvotef);
} else {
$vlevel=0;
}

//echo "$unifindex<br>";

$st+=1;
if (($stun!="\n")&&($stun!="")) {
$unifindex=translit(@$outun[1]." ".@$outun[2]." ");
$rating[$unifindex]=@$rating[$unifindex]."$vlevel\n";
$rrating.="$vlevel\n";
if ($unifindex!="__") {
$unif[$unifindex]=@$unif[$unifindex].$stun;
}
//echo "$unifindex<br>\n";
} else {
$rrating.="\n";
}
$zf+=1;

}
fclose($f);

$mb_file=".$base_loc/minibase.txt";
$mb=fopen($mb_file,"w");
fputs($mb,$minibase);
fclose($mb);

while (list ($keyunr, $lineunr) = each ($rating)) {
//	echo "$keyunr - $lineunr<br>";
$df=@fopen("./comments/$keyunr.rate", "w");
@fputs($df, $lineunr);
@fclose ($df);
}
unset ($rating);
$df=fopen("./comments/rate.txt", "w");
fputs($df, $rrating);
fclose ($df);
unset ($rrating);
$st=0;
while (list ($keyun, $lineun) = each ($unif)) {
//echo "<small>".htmlspecialchars($lineun)."</small><br>";
$tmpun2=explode("\n",$lineun);

//$tmpun=array_reverse($tmpun2);
$tmpun=$tmpun2;

$strokeun="";
$un=0;

while (list ($keyun2, $lineun2) = each ($tmpun)) {
//if ($un<$noveltys_qty) {
$outs=explode("|",$lineun2);
//if ((@$outs[9]!="")&&(@$outs[4]!=0)&&(@$outs[12]!=0)) {
if (($lineun2!="\n")&&($lineun2!="")) {
$strokeun=$strokeun.$lineun2."\n";
$un+=1;
}
//}
//}
}
$fpun_file=".$base_loc/items/$keyun.txt";
$fpun=@fopen($fpun_file,"w");
@fputs($fpun,$strokeun);
@fclose($fpun);


}



$novelmass=array_reverse($fcontents);
reset ($novelmass);

$noveltys_tosave2=Array();
$noveltys_qty=50;
while (list ($line_num, $line) = each ($novelmass)) {
echo "\n";

if (($line!="")&&($line!="\n")) {
$outs=explode("|",$line);
if (substr(@$outs[12],0,1)!="0") {
$noveltys_tosave2[]="$line";
$noveltys_qty-=1;
if ($noveltys_qty<=0) {break;}
}
}
}
unset ($novelmass);
$noveltys_tosave=implode("",$noveltys_tosave2);
//Теперь получиv список разделов и подразделов
$allrazdels=$fcontents;
$tot_tov=count($fcontents);
$mst=0;
$fid=0;
while (list ($line_num, $line) = each ($allrazdels)) {
echo "\n";

if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
if  ((substr(@$out[12],0,1)!="0")&&(@$out[12]!="")) {



if ($view_deleted_goods==1) {
$st=@$podstavasa[$out[1]."|".$out[2]."|"]."-".$mst;
$tmpmaxnomer[$st] = $out[0];
$tmpsubrazdels[$st] = $out[1]. "|" . $out[2] ."|";
$indexlc=(100000*(doubleval(@$podstavasa[$out[1]."|"."|"]))+doubleval(@$podstavasa[$out[1]."|".$out[2]."|"]));
if (($out[1]!=$lang[418])&&(@$podstavasa[$out[1]."|".$out[2]."|"]!="000000")) {@$last_goods[$indexlc]=$line;}

@$curcur=substr(@$out[12],1,3);

if (($curcur=="")||($curcur==$init_currency)) {
$kurss=$kurs;
} else {
if (isset($currencies[$curcur])) {
if ($curcur==$init_currency) {
$kurss=1;
} else {
$kurss=($currencies[$valut]/$currencies[$curcur]);
}
} else {
$kurss=$kurs;
}
}
//$price=0.01*(round((@$price*$kurs)/0.01));
$pricek=doubleval($out[4])*$kurss;
@$price=doubleval($out[4])*$kurss;
$strto2=0;

if ((@$podstavas[$out[1]."|".$out[2]."|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {

$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=doubleval(@$strtoma[0]);
unset($strtoma);

if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) {
	$strto2=$strto;
	$price=0.01*(round((@$price-(@$price*doubleval($strto)/100))/0.01));
$pricek=@$pricek-(@$pricek*(doubleval($strto))/100);
} else {
$strto=doubleval(@$podstavas[$out[1]."|".$out[2]."|"]); $price=0.01*(round((@$price-(@$price*((double)$podstavas[$out[1]."|".$out[2]."|"])/100))/0.01));
$pricek=@$pricek-(@$pricek*(doubleval($podstavas[$out[1]."|".$out[2]."|"])/100));
$strto2=doubleval($podstavas[$out[1]."|".$out[2]."|"]);
} } else {$price=0.01*(round(@$price/0.01));}

if ($strto2>0) {
if (!isset ($podstavasa[$out[1]."|".$out[2]."|"])) {$reindex="<h1>STEP 2. WAIT...</h1><meta http-equiv=\"Refresh\" content=\"2; URL=".$scriptprefix."indexator.php?speek=$speek\">";}
if (($out[1]!=$lang[418])&&(@$podstavasa[$out[1]."|".$out[2]."|"]!="000000")) {
$top_sales[$indexlc]=$strto2."^".$line;
//$top_sales[$indexlc]=$strto2."^".$line;
}
}
if ($pricek>0) {
if (!isset($min[$indexlc])) {$min[$indexlc]=$pricek;}
if (!isset($max[$indexlc])) {$max[$indexlc]=$pricek;}
if ($pricek<@$min[$indexlc]) {$min[$indexlc]=$pricek;}
if ($pricek>@$max[$indexlc]) {$max[$indexlc]=$pricek;}
}

$mst += 1;
} else {
if ((@$out[4]!="0")&&(@$out[4]!=0)) {
if (!isset($podstavasa[$out[1]."|".$out[2]."|"])) {$reindex="<h1>STEP 2. WAIT...</h1><meta http-equiv=\"Refresh\" content=\"2; URL=".$scriptprefix."indexator.php?speek=$speek\">";}
$st=@$podstavasa[$out[1]."|".$out[2]."|"]."-".$mst;
$tmpmaxnomer[$st] = $out[0];
$tmpsubrazdels[$st] = $out[1]. "|" . $out[2] ."|";
$indexlc=(100000*(doubleval(@$podstavasa[$out[1]."|"."|"]))+doubleval(@$podstavasa[$out[1]."|".$out[2]."|"]));
if (($out[1]!=$lang[418]) &&(@$podstavasa[$out[1]."|".$out[2]."|"]!="000000")) {@$last_goods[$indexlc]=$line;}

@$price=$out[4];
//echo "$out[3] <b>".$price."</b><br>";
//$price=0.01*(round((@$price*$kurs)/0.01));
$strto2=0;


if ((@$podstavas[$out[1]."|".$out[2]."|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {

$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=@$strtoma[0];
unset($strtoma);

if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $strto2=$strto; $price=0.01*(round((@$price-(@$price*(doubleval($strto))/100))/0.01));} else { $price=0.01*(round((@$price-(@$price*((double)$podstavas[$out[1]."|".$out[2]."|"])/100))/0.01)); $strto2=doubleval($podstavas[$out[1]."|".$out[2]."|"]); } } else {$price=0.01*(round(@$price/0.01));}
if ($strto2>0) {
if (($out[1]!=$lang[418])&&(@$podstavasa[$out[1]."|".$out[2]."|"]!="000000")) {
$top_sales[$indexlc].=$strto2."^".$line;
}
}
if (!isset($min[$indexlc])) {$min[$indexlc]=$price;}
if (!isset($max[$indexlc])) {$max[$indexlc]=$price;}
if ($price<@$min[$indexlc]) {$min[$indexlc]=$price;}
if ($price>@$max[$indexlc]) {$max[$indexlc]=$price;}
$mst += 1;
//echo $price."<br>";
}
}
}
}
}
$st=0;
@reset ($tmpsubrazdels);
@ksort($tmpsubrazdels);  //сортируем по индексу как указано в catid.txt

$tmpsub=@array_count_values($tmpsubrazdels); //убрали повторения
########### Генерируем таблицу подстановок
$tablesub=$tmpsub; //создали таблицу подстановок
$t=1;
$catid="";
while (list ($line_num, $line) = @each ($tablesub)) {
echo "\n";
if (($line_num!="")&&($line_num!="\n")) {
$out=explode("|",$line_num);
$tablenumr[$out[0]]=translit($out[0]);
$tmi=translit($out[0]);
$cati[$t]=translit(str_replace("\n", "",$out[0]))."|".str_replace("\n", "",$out[0]) . "||".str_replace("\n", "",@$catidy[$tmi])."|". str_replace("\n", "",@$catidys[$tmi])."|".str_replace("\n", "",@$catidyt[$tmi])."|".str_replace("\n", "",@$catidyc[$tmi])."|\n";
$t+=1;
$tablenum[$line_num]=translit($line_num);
$tmi=translit($line_num);
$cati[$t]=translit(str_replace("\n", "",$line_num))."|".str_replace("\n", "",$line_num)."".str_replace("\n", "",@$catidy[$tmi])."|".str_replace("\n", "",@$catidys[$tmi])."|".str_replace("\n", "",@$catidyt[$tmi])."|".str_replace("\n", "",@$catidyc[$tmi])."|\n";
$t+=1;
}
}
@reset($cati);
$tmpcat=@array_count_values($cati);
$catid="";
$ii=999999;
while (list ($line_num, $line) = @each ($tmpcat)) {
$tmpl=explode("|",$line_num);
$indtp=$tmpl[5];
if ((isset($catt[$indtp]))||($indtp=="")) { $indtp=$ii; $ii-=1; }
$catt[$indtp]=$line_num;
}
@reset ($catt);
@ksort($catt);
while (list ($line_num, $line) = @each ($catt)) {
echo "\n";
}
$file = fopen (".$base_loc/catid.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/catid.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
@fputs ($file, @implode("",$catt));
fclose ($file);


###########
reset ($allrazdels);
while (list ($line_num, $line) = each ($allrazdels)) {
echo "\n";
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);

if  ((substr(@$out[12],0,1)!="0")&&(@$out[12]!="")) {
$indexbr=translit0(trim(@$out[13]));
if (!isset($brandname[$indexbr])) {$brandname[$indexbr]=trim($out[13]);}
//if ($view_brands==1){

if ($out[13]!=""){
@$tmpbrands[$st] = $out[2]."|<div style=\"margin-left:10px;\" class=brand onclick=\"location.href='index.php?catid=".$tablenum[$out[1]."|".$out[2]. "|"]."&amp;brand=".rawurlencode($out[13])."';\"><!--".$out[13]." $sym --><a href=\"index.php?catid=".$tablenum[$out[1]."|".$out[2]. "|"]."&amp;brand=".rawurlencode($out[13])."\">".str_replace(chr(0xA0), " " , $out[13])."</a></div>|".$out[1]."|".$out[13]."|";
} else {
$tmpbrands[$st] = $out[2]."|<div style=\"margin-left:10px;\" class=brand onclick=\"location.href='index.php?catid=".$tablenum[$out[1]."|".$out[2]. "|"]."&amp;brand=nobrand';\"><!--zzzzz $sym --><a href=\"index.php?catid=".$tablenum[$out[1]."|".$out[2]. "|"]."&amp;brand=nobrand\">".$lang[417]."</a></div>|".$out[1]."|".$lang[417]."|";

}
//}
$st += 1;
}
}
}
$s=0;
$brandnamestosave="";
@reset($brandname);
@sort($brandname);

while (list ($line_num, $linesvr) = @each ($brandname)) {
//бренды менее 2-х символов - не бренды
if (strlen($linesvr)>1) {
$brandnamestosave.= "$linesvr\n";
}
}
$file = fopen (".$base_loc/brands.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/brands.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, $brandnamestosave);

fclose ($file);
//echo $brandnamestosave;
unset ($brandnamestosave);


$s=0;
@reset ($tmpbrands);
@natcasesort ($tmpbrands);
$tmpbr=@array_count_values($tmpbrands);  //убрали повторения

while (list ($line_numvv, $linevv) = @each ($tmpbr)) {

$outdd=explode("|",$line_numvv);
$subra=$outdd[0];
$bra=$outdd[2];
if ((!@$subbr[$subra]) || (@$subbr[$subra]=="")): $subbr[$subra]=""; endif;
//if ((!@$sbr[$subra]) || (@$sbr[$subra]=="")): $sbr[$subra]=""; endif;
//echo $bra."|".$subra."<br>";

$sbr[$bra."|".$subra]=@$sbr[$bra."|".$subra]. @$outdd[3] . "\n";
if ($view_brands==1) {
//if ($java_brands==1){
//if (!isset($subbro[$bra."|".$subra])) {$subbr[$bra."|".$subra] = @$subbr[$bra."|".$subra] . ""; $subbro[$bra."|".$subra]=1;}
//}
if (($linevv==1)&&($java_brands==0)) {
$subbr[$bra."|".$subra] = @$subbr[$bra."|".$subra] . @$outdd[1] . " <!-- br -->";

} else {
$sup="<sup>$line</sup>";
if (doubleval($line)==1) {$sup="";}
$subbr[$bra."|".$subra] = @$subbr[$bra."|".$subra] . @$outdd[1] . " $sup<!-- br -->";
}
}
$subbrcount[$bra."|".$subra] = @$subbrcount[$bra."|".$subra]+$linevv;
}
if ($java_brands==1){
@reset ($subbr);
while (list ($knm, $lnm) = @each ($subbr)) {
$subbr[$knm]="<div id=\"d_".translit($knm)."_\" style=\"display:none; visibility:hidden;\">".$subbr[$knm]."</div>";
}
}
@reset ($subbr);
@reset ($tmpsub);
@reset ($sbr);
while (list ($sbr_num, $sbrline) = @each ($sbr)) {
//echo translit($sbr_num."_")." = ".$sbrline."<br>";
$filegg = @fopen (".$base_loc/items/".translit($sbr_num."_").".br", "w");
if (!$file) {
echo "<p> Unable to write <b>\".$base_loc/items/".translit($sbr_num."_").".br\"</b>.\n";
exit;
}
@fputs ($filegg, $sbrline);

@fclose ($filegg);
}
//$tmparrs=array_reverse($tmpsub);
//ksort($tmpsub);
//$tmpsub=$tmparrs;
//unset($tmarrs);
while (list ($line_num, $line) = @each ($tmpsub)) {
echo "\n";
$out=explode("|",$line_num);
$ra=$out[0];
if (isset ($podstavasa[$line_num])) {
if (($podstavasa[$line_num]!="000000")&&($ra!=$lang[418])) {

if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
$subrcount[$ra] = $line;
//количество подразделов в разделе
$count_sub=@substr_count($subbr[$ra."|".$out[1]], "$sym");
//echo $subbr[$ra."|".$out[1]]. " $count_sub " . $subrcount[$ra]. " " .@$subbrcount[$ra."|".$out[1]]."<br>";
if (($count_sub==1)&&($java_brands==0)){ $subbr[$ra."|".$out[1]]=""; }
//if ((@$subbrcount[$ra."|".$out[1]]!="")&&($subrcount[$ra]!=@$subbrcount[$ra."|".$out[1]])): $subbr[$ra."|".$out[1]]=@$subbr[$ra."|".$out[1]]."<br>&nbsp;&nbsp;<font size=\"1\" face=\"Verdana\">$sym</font>&nbsp;<a href = \"index.php?catid=".$tablenum[$ra."|".$out[1]. "|"]."&amp;brand=nobrand\"><font color=\"".lighter($nc5,0)."\">".$lang[417]."</font></a> <font color=\"".lighter($nc5,0)."\"><sup>".(@$subbrcount[$ra."|".$out[1]]-$subrcount[$ra])."</sup></font>"; endif;
$tmy=$tablenum[$ra."|".$out[1]. "|"];
$sk="";
if (@$catidys[$tmy]!="") {
//$sk="&nbsp;<sup><b><font color=white style=\"background-color: #b94a48\">-".$catidys[$tmy]."%</font></b></sup>";
$sk="";
}
if (@$catidyc["".translit($ra).""]=="") {$catidyc["".translit($ra).""]=lighter($nc10,-40);}

if (($line==1)&&($java_brands==0)) {
$jb="";
if ($java_brands==1) {
$jb="<i class=icon-minus id=\"id_".translit($ra."|".$out[1])."_\"></i>";

}
$subr[$ra] = @$subr[$ra] . "$jb<div class=lcat1><font color=".$catidyc["".translit($ra).""]."><b>$carat</b></font> <a href=\"index.php?catid=".$tablenum[$ra."|".$out[1]. "|"]."\">".str_replace(chr(0xA0), " " ,str_replace (" NEW" , "</a> <a><b>NEW</b></sup>", $out[1]))."</a> ".$sk."</div>\n" . @$subbr[$ra."|".$out[1]];
} else {
$jb="";
$jbb="";
if ($java_brands==1) {
if ($view_brands==1) {
$jbb=" onclick=\"javascript:expl('".translit($ra."|".$out[1])."_')\"";
$jb="<span id=\"dd_".translit($ra."|".$out[1])."_\"><i class=\"icon-plus\" id=\"id_".translit($ra."|".$out[1])."_\"></i></span>";
} else {
$jbb="";
$jb="<span id=\"dd_".translit($ra."|".$out[1])."_\"></span>";
}
}
$sup="<sup>".str_replace(chr(0xA0), " " , $line)."</sup>";
if (doubleval($line)==1) {$sup="";}
$subr[$ra] = @$subr[$ra] . "<div class=lcat1".$jbb."><div style=\"float:right;\">$jb"."</div>&nbsp;<a href=\"index.php?catid=".$tablenum[$ra."|".$out[1]. "|"]."\">".str_replace(chr(0xA0), " " , str_replace (" NEW" , "</a> <a><sup><b>NEW</b></sup>", $out[1]))."</a>$sup".$sk."</div>\n" . @$subbr[$ra."|".$out[1]]."";
}
}
}
}
//Выведем названия разделов:
$st = 1;
@reset ($subr);
//natcasesort ($subr);
//$tmparrs=array_reverse($subr);
//unset($subr);
//$subr=$tmparrs;
//unset($tmarrs);
//$razdel="<b>$carat2 <a href='index.php?catid=_'>".$lang[201]."</a></b> <font color=\"".lighter($nc5,0)."\">(<b>$tot_tov</b>)</font><br>";
$razdel="";
while (list ($line_num, $line) = @each ($subr)) {
if (isset ($podstavasa[$line_num."||"])) {
if (($podstavasa[$line_num."||"]!="000000")&&($line_num!=$lang[418])) {
$subr[$line_num]="<!-- ".$podstavasa[$line_num."||"]." -->\n".$line;
}}
}
@natcasesort($subr);
@reset ($subr);

while (list ($line_num, $line) =@each ($subr)) {
//echo "$st $line_num<br>\n";
echo "\n";
if ($catidyc["".$tablenumr[$line_num].""]=="") {$catidyc["".$tablenumr[$line_num].""]=lighter($nc10,-40);}
$llgo="<img src=\"images/pix.gif\" border=0 width=8 height=8 style=\"background-color: ".$catidyc["".$tablenumr[$line_num].""]."\">";
if (@$style['dirs_l']==1) { if ($catidy["".$tablenumr[$line_num].""]!="") {$llgo=$catidy["".$tablenumr[$line_num].""];}}
$razdel .= "<h4 style=\"font-size: ".($main_font_size+1)."pt; margin: 0;\" class=lcat1 onclick=\"location.href='index.php?catid=".$tablenumr[$line_num]."';\">$llgo&nbsp;<a href=\"index.php?catid=".$tablenumr[$line_num]."\" style=\"color:".$catidyc["".$tablenumr[$line_num].""]."\">".str_replace (" NEW" , "</a> <a><sup><b>NEW</b></sup>", str_replace(chr(0xA0), " " , $line_num))."</a></h4>".str_replace(chr(0xA0), " " , $line)."<br>\n";
$st += 1;
}
$razdel.="";
$file = fopen (".$base_loc/dirs.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/dirs.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$razdel"));  endif;
if ($view_brands==1) { $jbran="<script language=javascript>
<!--
function expl(arg) {
if (document.getElementById('d_'+arg).style.display == 'none') {
document.getElementById('d_'+arg).style.display='block';
document.getElementById('d_'+arg).style.visibility='visible';
document.getElementById('id_'+arg).className='icon-minus';
} else {
document.getElementById('d_'+arg).style.display='none';
document.getElementById('d_'+arg).style.visibility='hidden';
document.getElementById('id_'+arg).className='icon-plus';
}


}
-->
</script>"; } else { $jbran="<script language=javascript>
function expl(arg) {}
</script>";}
fputs ($file, str_replace("</sup></font><!-- br --><br>", "</sup></font><br><img src=\"$htpath/pix.gif\" width=1 height=25>","$razdel
$jbran"));
fclose ($file);
echo "\n";
echo ". . .";


//теперь выведем разделы с картинками для горизонтального расположения разделов
$hr="<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">";
//Выведем названия разделов:
$st = 1;
@reset ($subr);
//natcasesort ($subr);
//$tmparrs=array_reverse($subr);
//unset($subr);
//$subr=$tmparrs;
//unset($tmarrs);
//$razdel="<table width=100% border=0 cellspacing=0 cellpadding=3><tr><td><b>$carat2 <a href='index.php?catid=_'>".$lang[201]."</a></b> (<b>$tot_tov</b>)</td></tr></table>";
$razdel="";

$maxcols=2;
$cols=0;
$razdel.="<table width=100% border=0 cellspacing=0 cellpadding=3><tr>";

while (list ($line_num, $line) = @each ($subr)) {
echo "\n";
$tmi=$tablenumr[$line_num];
$razdel .= "<td width=25% valign=top><a href = \"index.php?catid=".$tablenumr[$line_num]."\">".str_replace("border=0","border=0 hspace=\"".$style['cat_hsp']."\" vspace=\"".$style['cat_vsp']."\"", @$catidy[$tmi])."<br><b><FONT><span class=brand>".str_replace(chr(0xA0), " " , $line_num)."</span></FONT></b></a> ".str_replace(chr(0xA0), " " , $line)."</td>\n";
$st += 1;
$cols+=1;
if ($cols>=$maxcols): $cols=0; $razdel.="</tr><tr>"; endif;
}
$razdel.="</tr></table>";

$file = fopen (".$base_loc/dirs_h.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/dirs_h.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$razdel"));  endif;

fputs ($file, "$razdel");
fclose ($file);
echo "\n";
echo ". . .";




//Теперь проиндексируем со вложенными меню

//Выведем названия разделов:
$st = 0;
@reset ($subr);
//natcasesort ($subr);
//$tmparrs=array_reverse($subr);
//unset($subr);
//$subr=$tmparrs;
//unset($tmarrs);
$razdel="<style>
    div.Offscreen     { display:none }
    span.Offscreen    { display:none }
</style>";
while (list ($line_num, $line) = @each ($subr)) {
echo "\n";
$razdel .= "<div id=Out".$st.">";
$st += 1;
if (substr($line, 0, 4)=="<br>"){$line=substr($line, 4)."<br>";}
$razdel .= "<h4 onclick=\"checker('".$tablenumr[$line_num]."');\" id=c_".$tablenumr[$line_num]." class=lcat1 style=\"border-bottom: 1px ".$catidyc["".$tablenumr[$line_num].""]." dotted;\"><span style=\"float: right;\" id=\"".$tablenumr[$line_num]."\"><i id=\"img".$tablenumr[$line_num]."\" class=\"icon-chevron-right icon-white\"></i></span><a href=\"index.php?catid=".translit(str_replace(chr(0xA0), " " , $line_num))."\">".str_replace(chr(0xA0), " " , $line_num)."</a></h4>\n
<div id=Out".$tablenumr[$line_num]."details style=\"display:None;\"><!-- ".$tablenumr[$line_num]." -->".str_replace(chr(0xA0), " " , $line)."</div></div>\n";
$st += 1;
}
$razdel.="<script language=\"javascript\">
function checker(arg) {
if (document.getElementById('Out'+arg+'details').style.display == 'none') {
document.getElementById('Out'+arg+'details').style.display='inline';
document.getElementById('img'+arg).className='icon-chevron-down icon-white';
} else {
document.getElementById('Out'+arg+'details').style.display='none';
document.getElementById('img'+arg).className='icon-chevron-right icon-white';
}
}

</script>


";
$file = fopen (".$base_loc/dirs_j.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/dirs_j.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$razdel"));  endif;
if ($view_brands==1) { $jbran="<script language=javascript>
<!--
function expl(arg) {
if (document.getElementById('d_'+arg).style.display == 'none') {
document.getElementById('d_'+arg).style.display='block';
document.getElementById('d_'+arg).style.visibility='visible';
document.getElementById('id_'+arg).className='icon-minus';
} else {
document.getElementById('d_'+arg).style.display='none';
document.getElementById('d_'+arg).style.visibility='hidden';
document.getElementById('id_'+arg).className='icon-plus';
}


}
-->
</script>"; } else { $jbran="<script language=javascript>
function expl(arg) {}
</script>";}
fputs ($file, str_replace("</sup></font><!-- br --><br>", "</sup></font><br><img src=\"$htpath/pix.gif\" width=1 height=25>","
$jbran
$razdel"));
fclose ($file);
echo "\n";
echo ". . .";


unset($allrazdels,$tmpmaxnomer,$tmpsubrazdels,$tmpsub,$out,$line,$ra,$subr,$tot_tov, $catid);





//Для менеджера ссылок

$st=0;
$fcontents = file(".$base_loc/db_links.txt");
//Теперь получиv список разделов и подразделов
$allrazdels=$fcontents;
$tot_tov=count($fcontents);
while (list ($line_num, $line) = each ($allrazdels)) {
echo "\n";
$out=explode("|",$line);
$tmpmaxnomer[$st] = $out[0];
$tmpsubrazdels[$st] = "links|".@$out[1];
$st += 1;
}
$s=0;
reset ($tmpsubrazdels);
$tmpsub=array_count_values($tmpsubrazdels);
$ll=0;
$razdeli="";
while (list ($line_num, $line) = each ($tmpsub)) {
echo "\n";
$out=explode("|",$line_num);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
$subr[$ra] .= "<br><font color=\"".lighter($nc5,0)."\">$carat</font> <a href = \"index.php?action=links&amp;linksub=".($ll+1)."\ style=\"color:".$nc3."\" onmouseover=\"this.style.background='$nc3';this.style.color='$nc0';\" onmouseout=\"this.style.background='';this.style.color='$nc3';\">".str_replace (" NEW" , "</a> <a><font color=\"".$nc2."\"><sup><b>NEW</b></sup></font>", $out[1])."</a> (<b>$line</b>)";
$razdeli.=($ll+1)."|".$out[1]."|\n";
$ll+=1;
}
//Выведем названия разделов:
$st = 1;
reset ($subr);
//natcasesort ($subr);
//$tmparrs=array_reverse($subr);
//unset($subr);
//$subr=$tmparrs;
//unset($tmarrs);
$razdel="<b><font color=\"".lighter($nc5,0)."\">$carat</font> <a href='index.php?action=links&amp;linksub=index'>Все ссылки</a></b> (<b>$tot_tov</b>)<br>";
while (list ($line_num, $line) = each ($subr)) {
echo "\n";
$razdel .= "$line<br>\n";
$st += 1;
}
$razdel.="";
$file = fopen (".$base_loc/link_index.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/link_index.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$razdel"));  endif;

fputs ($file, "$razdel");
fclose ($file);

$file = fopen (".$base_loc/link_razdels.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/link_razdels.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$razdel"));  endif;

fputs ($file, "$razdeli");
fclose ($file);
echo "\n";
echo ". . .";

unset($allrazdels,$tmpmaxnomer,$tmpsubrazdels,$tmpsub,$out,$line,$ra,$subr,$tot_tov);
//Для своего меню

$st=0;
$fcontents = file(".$base_loc/db_cmenu.txt");
//Теперь получиv список разделов и подразделов
$allrazdels=$fcontents;
$tot_tov=count($fcontents);
while (list ($line_num, $line) = each ($allrazdels)) {
echo "\n";
$out=explode("|",$line);
if ((trim($out[0])!="")&&(trim($out[0])!="\n")&&(trim($out[0])!="\r")) {
$tmpmaxnomer[$st] = $out[0];
$tmpsubrazdels[$st] = $out[1]. "|" . $out[2] . "|" . $out[3]. "|" . $out[4];
$st += 1;
}
}
$s=0;
@reset ($tmpsubrazdels);
natcasesort ($tmpsubrazdels);
$tmpsub=@array_count_values($tmpsubrazdels);

while (list ($line_num, $line) = @each ($tmpsub)) {
echo "\n";
$out=explode("|",$line_num);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
if (trim($out[3])=="") {
$subr[$ra] .= "<div class=brand onclick=\"location.href='index.php?query=".rawurlencode($out[2])."';\"><a href=\"index.php?query=".rawurlencode($out[2])."\">".str_replace (" NEW" , "<font color=\"".$nc2."\"><sup> <b>NEW</b></sup></font>", $out[1])."</a></div>";
} else {
$subr[$ra] .= "<div class=brand onclick=\"location.href='".$out[3]."';\"><a href=\"".$out[3]."\">".str_replace (" NEW" , "<font color=\"".$nc2."\"><sup> <b>NEW</b></sup></font>", $out[1])."</a></div>";
}
}
//Выведем названия разделов:
$st = 1;
@reset ($subr);
//natcasesort ($subr);
//$tmparrs=array_reverse($subr);
//unset($subr);
//$subr=$tmparrs;
//unset($tmarrs);
$razdel="";
while (list ($line_num, $line) = @each ($subr)) {
echo "\n";

$razdel .= "<div class=lcat1 style=\"border-bottom: 1px $nc6 dotted; padding-top:10px; padding-bottom:10px;\" onclick=\"dv('".$st."');\"><div class=pull-left><b>$line_num</b></div><div class=pull-right><i id=\"himg_".$st."\" class=\"icon-chevron-right icon-white\"></i></div><div class=clearfix></div></div><div style=\"display: none;\" id=\"hdiv_".$st."\">".str_replace(".php?query", ".php?b=$st&query", $line)."</div>";
$st += 1;
}
$razdel.="";
$file = fopen (".$base_loc/cmenu_index.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/cmenu_index.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$razdel"));  endif;

fputs ($file, "<script language=javascript>
function dv(arg) {
if (document.getElementById('hdiv_'+arg).style.display=='none') {
document.getElementById('hdiv_'+arg).style.display='inline';
document.getElementById('himg_'+arg).className='icon-chevron-down icon-white';
} else {
document.getElementById('hdiv_'+arg).style.display='none';
document.getElementById('himg_'+arg).className='icon-chevron-right icon-white';
}
}
</script>"."$razdel");
fclose ($file);
echo "\n";
echo ". . .";
/*reset ($fcontents);
$vitlist="";
while (list ($line_num, $line) = each ($fcontents)) {
$out=explode("|",$line);
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);
if ($onsale=="1") {
$nomer = $out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];

@$brand_name=@$out[13];
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
@$kolvo=@$out[16];
$vitlist.= "$nomer|$dir|$subdir|$nazv|$price|$opt|$ext_id|$description|$kwords|$foto1|$foto2|$vitrin|$onsale|$brand_name|$ext_lnk|$full_descr|$kolvo|\n";
}
}
$file = fopen (".$base_loc/vitrin.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/vitrin.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$vitlist");
fclose ($file);
echo "<br>Индексация витрины выполнена!";
reset ($fcontents);
$vitlist="";
while (list ($line_num, $line) = each ($fcontents)) {
$out=explode("|",$line);
@$onsale=substr(@$out[12],0,1);
@$ext_lnk=@$out[14];
if (($ext_lnk=="1") && ($onsale=="1")) {
$nomer = $out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];

@$brand_name=@$out[13];
@$vitrin=@$out[11];
@$full_descr=@$out[15];
@$kolvo=@$out[16];
$vitlist.= "$nomer|$dir|$subdir|$nazv|$price|$opt|$ext_id|$description|$kwords|$foto1|$foto2|$vitrin|$onsale|$brand_name|$ext_lnk|$full_descr|$kolvo|\n";
}
}
$file = fopen (".$base_loc/ext_lnk.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/ext_lnk.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$vitlist");
fclose ($file);
echo "<br>Индексация новинок выполнена!";
reset ($fcontents);
$vitlist="";
while (list ($line_num, $line) = each ($fcontents)) {
$out=explode("|",$line);
@$brand_name=@$out[13];
@$onsale=substr(@$out[12],0,1);
if (($brand_name=="1") && ($onsale=="1")) {
$nomer = $out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];

@$ext_lnk=@$out[14];
@$vitrin=@$out[11];
@$full_descr=@$out[15];
@$kolvo=@$out[16];
$vitlist.= "$nomer|$dir|$subdir|$nazv|$price|$opt|$ext_id|$description|$kwords|$foto1|$foto2|$vitrin|$onsale|$brand_name|$ext_lnk|$full_descr|$kolvo|\n";
}
}
$file = fopen (".$base_loc/brand_name.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/brand_name.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$vitlist");
fclose ($file);
echo "<br>Индексация ТОП10 выполнена!";
*/
$navi[0]="<!--0--><a href='$htpath'><i class='icon-home icon-white' title=\"".$lang['mainsite']."\"></i></a>";

$razdc=2;
if (is_dir(".$base_loc/wiki")==TRUE) {

$handle=opendir(".$base_loc/wiki/");
while (($file = readdir($handle))!==FALSE) {
echo "\n";
If (($file == '.') || ($file == '..')) {
continue;
} else {
unlink (".$base_loc/wiki/$file");
}
}

closedir ($handle);


}
$wikireplace="";
$handle=opendir(".$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
echo "\n";
$preg="/".substr($file, 0,1)."/i";
//echo $preg. " $hidden_cats ".preg_match($preg,$hidden_cats)."<br>";
if (($file == '.') || ($file == '..') || ($file == 'config.inc')||(substr($file, -4)==".del")||(preg_match($preg,$hidden_cats)==true)) {
continue;
} else {
$fp = fopen (".$base_loc/content/$file" , "r");

$all= @fread($fp, @filesize(".$base_loc/content/$file"));
$out1=Array();
$out1[1]="";
$out1=explode("==",$all);
if ($out1[1]!="") {
$comm="";
$comm=ExtractString($out1[1],"[comm]","[/comm]");
$out1[1]=str_replace("[comm]".$comm."[/comm]", "", $out1[1]);
$purl="";
$ppimg="";
$pimg="";

$line=str_replace("\s", "",str_replace("\t", "",str_replace("\r", "",str_replace("\n", "", trim(strtoken(strip_tags(trim($out1[1])),"["))))));

$ppimg=ExtractString($out1[1],"<img ",">");
if ($ppimg!="") {
$plinks[translit($line)]="<div align=pull-left><img ". ExtractString($out1[1],"<img ",">")."></div>";
}
$purl=ExtractString($out1[1],"[url]","[/url]");
$out1[1]=str_replace("[url]".$purl."[/url]", "", $out1[1]);
$linet=str_replace("\s", "",str_replace("\t", "",str_replace("\r", "",str_replace("\n", "",$out1[1]))));
$out[1]=$out1[1];
unset ($out1);

} else {
$line = strip_tags($lang[221]);
$linet=strip_tags($lang[221]);
}
if ($friendly_url==1) {
$man=translit(strtoken($linet,"|"));
$mfile=str_replace(".txt","",$file);
if ($man!=strip_tags($lang[221])) {
$fman=fopen(".$base_loc/wiki/".$man.".man","w");
//echo "$man => $mfile<br>";
} else {
$fman=fopen(".$base_loc/wiki/".$mfile.".man","w");
//echo "$mfile => $mfile<br>";
}

fputs($fman,$mfile);
fclose($fman);
}
$line=strip_tags(str_replace("\n","", $line));
fclose ($fp);
$out=explode(".",$file);
$c=strip_tags($out[0]);
#####
if (strlen($c)!=1) {
$subline=toLower(strip_tags(substr($line,0,1)));
$razdelo=substr($file,0,1);
$tmprindex=strip_tags("$razdelo~$subline");
if ($razdelo==$wiki_rubric) {
$tmpz=explode("|",$line);
if ($purl!="") {$ppurl=$purl;} else {$ppurl="$htpath/index.php?page=".$c; }
while (list($lk,$lv)=each($tmpz)) {
if (trim($lv)!="") {
$wikireplace.=$lv."~".$ppurl."~\n";
}
}
unset ($tmpz);
$wikisearch=" &nbsp;&nbsp;&nbsp;<small><i><a href=\"index.php?query=".rawurlencode(str_replace("|"," ", strtoken($line,"[")))."&usl=OR\"><font color=$nc5>".$lang['search']."...</font></a></i></small>";


} else {$wikisearch="";}
$voting="";
if ($view_comments_site==1) {
$unifmd=md5($c);
if (@file_exists("./comments/votes/$unifmd.txt")==TRUE) {
$tmpvotef=file("./comments/votes/$unifmd.txt");
$vcount=doubleval(trim($tmpvotef[1]));
$vlevel=round(doubleval(trim($tmpvotef[0])));
$voting="<img src=images/pix.gif height=1 width=10 border=0><img src=\"$image_path/vote".$vlevel.".png\" title=\"".$lang[681]."\" border=0><img src=images/pix.gif height=1 width=10 border=0><b>$vlevel/5</b><img src=images/pix.gif height=1 width=10 border=0><span title=\"votes\">[$vcount]</span>";
unset($tmpvotef);
}
}
if ($friendly_url==1) { $flafsy=""; $manc=translit(strtoken($line,"|")); } else { $flagsy="&flag=".$speek; $manc=$c; }
if (@$mod_rw_enable==1){ $llink="$manc.html"; $llinks="$manc.html";}  else {$llink="index.php?page=$manc&z=".rawurlencode($subline)."[jstart]"; $llinks="index.php?page=$manc";}
if ($purl!="") {$llink="$purl"; $llinks="$purl";}
if (preg_match("/<img/i", $linet)) {

@$tmprazdelo[$tmprindex].="<!-- $line --><div onMouseOver=\"this.style.backgroundColor='$nc6';\" onMouseOut=\"this.style.backgroundColor='$nc0';\" style=\"-moz-border-radius: 10px; background: $nc0; border: 1px solid $nc6; width:86%; padding: 10px 10px 10px 10px; cursor:pointer; cursor:hand; text-decoration:none;-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;\" onclick=\"location.href='".$llink."';\"><a href=$llink>". strtoken(str_replace("<img ","<img border=0 hspace=10 align=left ", strtoken(strip_tags($linet,"<img>"),"|")),">")."></a>$carat<a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\">".strtoken(strip_tags($line),"|")."</a>$voting<br>$wikisearch<br><i>$comm</i><div style=\"clear: both\"></div></div><br><!--end-->\n^";
} else {
@$tmprazdelo[$tmprindex].="<!-- $line --><div onMouseOver=\"this.style.backgroundColor='$nc6';\" onMouseOut=\"this.style.backgroundColor='$nc0';\" style=\"-moz-border-radius: 10px; background: $nc0; border: 1px solid $nc6; width:86%; padding: 10px 10px 10px 10px; cursor:pointer; cursor:hand; text-decoration:none;moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;\" onclick=\"location.href='".$llink."';\"><a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\">".strtoken(strip_tags($line),"|")."</a>$wikisearch$voting<br><i>$comm</i></div><br><!--end-->\n^";

}

}

if (substr($c,0,1)!=$wiki_rubric) {
echo ".";
if (strlen($c)==1) {
$flagsy="";
if ($friendly_url==1) { $flagsy=""; $manc=translit(strtoken($line,"|")); } else { $flagsy="&flag=".$speek; $manc=$c; }
if (@$mod_rw_enable==1){ $llink="$manc.html";}  else {$llink="index.php?page=$manc".$flagsy."";}
if ($purl!="") {$llink="$purl";}
if (substr($c,0,1)==$wiki_content){
if ($view_wikicat==1) {

$navi[$razdc]="<!--$c--><a href='$llink'><b><font color=\"$nc9\" class=f1>".strtoken($line,"|")."</font></b></a>";
$name="<!--$c--><br><font style=\"font-size: ".($main_font_size+1)."pt;\">$carat2<!--$c--><b><a href='$llink'>".strtoken($line,"|")."</a></b></font>";
$files[$st] = "$name";
$bfiles[$st] = "<!--$c--><br><font style=\"font-size: ".($main_font_size+1)."pt;\">$carat2<b><a href='$llink'>".strtoken($line,"|")."</a></b></font>";
$st += 1;
} else {
$bfiles[$st] = "<!--$c--><br>$carat2<b><a href='$llink'>".strtoken($line,"|")."</a></b>";
$st += 1;

}
} else {
$navi[$razdc]="<!--$c--><a href='$llink'><b><font color=\"$nc9\" class=f1>".strtoken($line,"|")."</font></b></a>";
$name="<!--$c--><br><font style=\"font-size: ".($main_font_size+1)."pt;\">$carat2<!--$c--><b><a href='$llink'>".strtoken($line,"|")."</a></b></font>";
$files[$st] = "$name";
$bfiles[$st] = "<!--$c--><br>$carat2<b><a href='$llink'>".strtoken($line,"|")."</a></b>";
$st += 1;
}
$razdc+=1;
} else {
if (substr($c,0,1)!=$wiki_content) {
$name = "<!--$c-->$carat&nbsp;<a href='$llinks'>".strtoken($line,"|")."</a>";
$files[$st] = "$name";
$bfiles[$st] = "<!--$c-->$carat&nbsp;<b><a href='$llinks'>".strtoken($line,"|")."</a></b>";
$st += 1;
} else {
$bfiles[$st] = "<!--$c-->$carat&nbsp;<b><a href='$llinks'>".strtoken($line,"|")."</a></b>";
$st += 1;
}
}

} else {
//bfiles
echo ".";
if (strlen($c)==1) {
$flagsy="";
if ($friendly_url==1) { $flagsy=""; $manc=translit(strtoken($line,"|")); } else { $flagsy="&flag=".$speek; $manc=$c; }
if (@$mod_rw_enable==1){ $llink="$manc.html";}  else {$llink="index.php?page=$manc".$flagsy."";}
if ($purl!="") {$llink="$purl";}

$wrfiles[$st] = "<!--$c--><br>$carat2<b><a href='$llink'>".strtoken($line,"|")."</a></b>";
$st += 1;
$razdc+=1;
} else {
$wrfiles[$st] = "<!--$c-->$carat&nbsp;<b><a href='$llinks'>".strtoken($line,"|")."</a></b>";
$st += 1;
}

}
}
}

closedir ($handle);










if (is_dir(".$base_loc/wiki")==FALSE) { mkdir(".$base_loc/wiki",0755); }
while (list ($key, $val) = each ($tmprazdelo)) {
$tmptmpras=explode("^",$val);
natcasesort($tmptmpras);
$tmprazdelos[$key]=implode("",$tmptmpras);
unset($tmptmpras);
}



unset($key,$val,$tmprazdelo);
ksort($tmprazdelos);
reset($tmprazdelos);
while (list ($key, $val) = each ($tmprazdelos)) {
$tmpkey=explode("~",$key);
$tmpsindex=$tmpkey[0];
if (!isset($tmpsygnfound[$tmpsindex])) {$tmpsygnfound[$tmpsindex]=$wiki_articles;}
$wikilen=floor(100/(strlen(str_replace("|","",strtoken($wiki_articles,"-")))));
@$tmpsygnfound[$tmpsindex]=str_replace("".toUpper($tmpkey[1])."|", "<td style=\"background: ".lighter($nc6,-10)."; border: 1px solid $nc6; padding: 3px 3px; cursor: pointer; cursor: hand;\" align=center id=\"divd_".md5($tmpkey[1])."\" onclick=\"javascript:js_".md5($tmpkey[1])."()\" width=$wikilen"."%><b><font color=$nc5>".toUpper($tmpkey[1])."</font></b></td>|", @$tmpsygnfound[$tmpsindex]);
if (!isset($first[$tmpsindex])) { $first[$tmpsindex]="<script language=javascript>
//start
//document.getElementById('div_".md5($tmpkey[1])."').style.visibility = 'visible';
//document.getElementById('div_".md5($tmpkey[1])."').style.display = 'inline';
//document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '$nc3';

</script>"; }

@$jsall[$tmpsindex].="document.getElementById('div_".md5($tmpkey[1])."').style.visibility = 'visible';
document.getElementById('div_".md5($tmpkey[1])."').style.display = 'inline';
//document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '$nc3';
";
@$jsallcl[$tmpsindex].="document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '".lighter($nc6,-10)."';
document.getElementById('div_".md5($tmpkey[1])."').style.display = 'none';
document.getElementById('div_".md5($tmpkey[1])."').style.visibility = 'hidden';
";
@$tmpsygn[$tmpsindex].="<script language=javascript>
function js_".md5($tmpkey[1])."() {
jsallcl()
document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '$nc3';
document.getElementById('div_".md5($tmpkey[1])."').style.visibility = 'visible';
document.getElementById('div_".md5($tmpkey[1])."').style.display = 'inline';

document.getElementById('viewjsall').innerHTML='".$lang[422]."';
}
</script>
<div id=\"div_".md5($tmpkey[1])."\"><a name=\"".md5(toUpper($tmpkey[1]))."\"></a><br><font size=3>".toUpper($tmpkey[1])."</font><br><br>$val<br></div>\n";
@$tmpallwiki[$tmpsindex].="$val";
$nn+=1;
@$tmp_slide[$tmpsindex].=str_replace("padding: 10px 10px 10px 10px;", "width:86%; height:".($jh-28)."px; padding: 10px 10px 10px 10px; overflow:hidden;",$val);
unset($tmpkey);
}
unset ($key,$val,$file);
ksort($tmpsygn);
reset($tmpsygn);

while (list ($key, $val) = each ($tmpsygn)) {
$tmpsl=@explode("<!--end-->",@$tmp_slide[$key]);
$wikisl="";
natcasesort($tmpsl);
reset($tmpsl);
$ksl=1;
while (list ($keysl, $valsl) = @each ($tmpsl)) {
if (trim($valsl)!="") {
$wikisl.="<li>".str_replace("</a><img border=\"0\"","</a><br><img border=\"0\"" , str_replace("hspace=10 align=left","", str_replace("<br><br><i>", "<i><small><br><br>", str_replace("</i>", "</small></i>",  str_replace("[jstart]", "&jstart=$ksl",$valsl)))))."</li>\n";
$ksl+=1;
}
}

$file2 = fopen (".$base_loc/wiki/$key.all", "w");
if (!$file2) {
echo "<p> Error writing file <b>.$base_loc/wiki/$key.all</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs($file2,str_replace("[jstart]", "&jstart=$keysl",@$tmpallwiki[$key]));
fclose ($file2);

$file3 = fopen (".$base_loc/wiki/$key.car", "w");
if (!$file3) {
echo "<p> Error writing file <b>.$base_loc/wiki/$key.all</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs($file3,"<script type=\"text/javascript\">
$(document).ready(function(){

$(\".mouseWheel .jCarouselLite\").jCarouselLite({
mouseWheel: true,
    btnNext: \".next\",
    btnPrev: \".prev\",
    visible: $gallery_cols,
    scroll: 1,
    start: 0,
//    vertical: true,
    circular: true
});

});

</script>


<center>
<div id=\"jCarouselLiteDemo\" style=\"width:".$jg."\">
<div class=\"carousel mouseWheel\" style=\"width:".$jg."\">
<table border=\"0\" cellpadding=0 cellspacing=0 width=100%><tr><td align=\"center\">

<a class=\"prev\">&nbsp;</a><br><br><br>
</td><td align=\"center\" width=100%>
<div class=\"jCarouselLite\" style=\"width:".$jg."\">
    <ul>
    ".$wikisl."
    </ul>
  </div>
</td><td align=\"center\">
<a class=\"next\">&nbsp;</a><br><br><br>

</td></tr>
</table>
</div>
</div>
</center>");
fclose($file3);


$file = fopen (".$base_loc/wiki/$key.txt", "w");


if (!$file) {
echo "<p> Error writing file <b>.$base_loc/wiki/$key.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if ((@$tmpsygnfound[$key]!="$wiki_articles")&&(@$tmpsygnfound[$key]!="")) {

$wikilen=floor(100/(strlen(str_replace("|","",strtoken($wiki_articles,"-")))));
$tosav=str_replace("[jstart]", "", str_replace("<td align=center width=$wikilen"."%><font color=".$nc3."><td ","<td width=$wikilen"."% ","<table width=100% border=0 cellpadding=0 cellspacing=0 style=\"-moz-border-radius: 10px; background: $nc6; border: 1px solid $nc6; width:100%; padding: 5px 5px;\"><tr><td align=center width=$wikilen"."% ><font color=$nc3>".str_replace("|","</font></td><td align=center width=$wikilen"."%><font color=$nc3>",str_replace("-", "</td></tr><tr><td>", @$tmpsygnfound[$key]))."</font></td></tr></table><table width=100% border=0><tr><td align=left><a href=\"$htpath/index.php?page=$wiki_rubric\">".$lang[1040]."</a></td><td align=right><small><a href=#all_articles onclick=\"javascript:jsall()\"><nobr><span id=viewjsall>".$lang[386]."</span></nobr></a></small></td></tr></table>")."
<script language=javascript>
function jsall () {
if (document.getElementById('viewjsall').innerHTML=='".$lang[422]."'){
".$jsall[$key]."
document.getElementById('viewjsall').innerHTML='".$lang[386]."';
} else {
".$jsallcl[$key]."
document.getElementById('viewjsall').innerHTML='".$lang[422]."';
}
}
function jsallcl() {
".$jsallcl[$key]."
}
</script>
<br><br>$val".$first[$key]);
fputs ($file, $tosav);
}
//echo "<h1>$key</h1>$val";
fclose ($file);
unset($tmpkey);
}
unset ($key,$val,$file);



//сортировка по алфавиту//
sort ($files);
$files[0]=str_replace("<br>$carat2","$carat2", $files[0]);
reset ($files);
$links="";
while (list ($key, $val) = each ($files)) {
echo "\n";
$links .= "$val<br>\n";
}
$blinks="";
sort ($bfiles);
reset ($bfiles);
while (list ($key, $val) = each ($bfiles)) {
echo "\n";
$blinks .= "$val<br>\n";
}
@sort ($wrfiles);
@reset ($wrfiles);
$wrlinks="";
while (list ($key, $val) = @each ($wrfiles)) {
echo "\n";
$wrlinks .= "$val<br>\n";
}
/*
$file = fopen (".$base_loc/links.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/links.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$links");
fclose ($file);
*/






//формируем левое меню сайта





$mmax_subs=100;
$goodlinks_subs_qty=100;
$goodlinks="";
$normalinks="";
$blinkcontent1="";
//echo $links; exit;
$tmplink=explode($carat2,$links);
if (count($tmplink)>0) {

while (list($linkey,$linval)=each($tmplink)) {


$titlink=strtoken($linval,"</a></b></font><br>")."</a></b>";

if (strip_tags($titlink)!="") {
//echo $linkey." ".$linval."<br>";
$linkcontent=str_replace($titlink."</font><br>","",$linval);
$tmp=explode("\n", $linkcontent);
$raz=substr($titlink,4,1);
$linkcontent="";
$nlinkcontent="";
$linkcontent3="";
natcasesort ($tmp);
$tmp2=Array();
while (list($key,$val)=each($tmp)) {
if (trim(strip_tags($val))!="") {
if ($sort_sub=="name") {
$indx=ExtractString ($val,"'>", "</a>");
$tmp2[$key]="<!--$indx-->".$val;
}
if ($sort_sub=="order") {
$tmp2[$key]=$val;
}
if ($sort_sub=="date") {
$indx=@filemtime("$base_loc/content/".ExtractString ($val,"<!--", "-->").".txt");
$tmp2[$key]="<!--$indx-->".$val;
}
}
}
natcasesort ($tmp2);
if ($sort_reverse==1) { $tmp2=array_reverse($tmp2);  }
unset ($key,$val);
$kkk=0;
unset ($mlinkcontent);
while (list($key,$val)=each($tmp2)) {
if (trim($val)!="") {

$mlinkcontent[$kkk]=str_replace("&nbsp;<b>", "<b>",
str_replace("$carat","<i class='icon-chevron-right'></i>",
str_replace("--><br>","-->",$val)));

$kkk++;
}
}
$linkcontent1="";
unset ($key,$val);
@reset ($mlinkcontent);
$zz=1;
while (list($key,$val)=@each($mlinkcontent)) {
if ($zz<=$mmax_subs) {
$t=explode("a href=", $val);

$link=strtoken(str_replace("'","", str_replace("\"","",$t[1])), ">");
$linkcontent.="$val";
if (preg_match("/\?/i",$link)) {
$nlinkcontent.="<div class=brand onclick=\"location.href='".$link."&speek=$speek&bb=".$linkey."';\">".str_replace("$link","$link&speek=$speek&bb=".$linkey,$val)."</div>";
} else {
$nlinkcontent.="<div class=brand onclick=\"location.href='".$link."';\">".$val."</div>";

}
}
$linkcontent3.="$val";
$zz++;
}
if (count($tmp)>($mmax_subs+1)) {
$linkcontent1="<div class=pull-right><br><span class=lnk><a href=index.php?page=".$raz.">".$lang[1546]." ".(count($tmp)-$mmax_subs-2)."</a></span><i class='icon-chevron-right'></i></div><div class=clearfix></div>\n";
 }
unset ($tmp,$tmp2);
$rtit=ExtractString ($titlink,"'>", "</a>");
if (strlen($rtit)>25) { $titsiz=(intval($title_font_size)-2); } else { $titsiz=intval($title_font_size); }
if ($linkey<$goodlinks_subs_qty) {
$goodlinks.=topw1 (str_replace("<br>","","<font style=\"font-size: ".$titsiz."px\">".str_replace("</font><br>","", $titlink)."</font>"), str_replace("<a ", "<span class=lnk><a ", str_replace("</a>", "</a></span>",$linkcontent.$linkcontent1)),"100%", $nc3, strtolower($style ['bg_material']), 4,0,"",true);
$t=explode("a href=", $titlink);
$link=strtoken(str_replace("'","", str_replace("\"","",$t[1])), ">");

if ($nlinkcontent!="") {
//titul
if (preg_match("/\?/i",$link)) {
$titlink=str_replace("$link","$link&speek=$speek&bb=".$linkey, $titlink);
}
$normalinks.="<div class=\"lcat1\" style=\"border-bottom: 1px $nc6 dotted; padding-top:10px; padding-bottom:10px;\" onclick=\"nl('".$linkey."');\" id=bb_".$linkey."><div class=pull-left>".str_replace("<br>","","".str_replace("</font><br>","", $titlink)."")."</div><div class=\"pull-right\"><i id=\"i_".$linkey."\" class=\"icon-chevron-right icon-white\"></i></div><div class=clearfix></div></div>";
//content
$normalinks.="<div style=\"display: none;\" id=\"d_".$linkey."\">".$nlinkcontent."</div>";
} else {
//titul

$normalinks.="<div class=\"lcat1\" style=\"border-bottom: 1px $nc6 dotted; padding-top:10px; padding-bottom:10px;\" onclick=\"location.href='".$link."';\"><div class=pull-left>".str_replace("<br>","","".str_replace("</font><br>","", $titlink)."")."</div><div class=\"pull-right\"><i id=\"i_".$linkey."\" class=\"icon-chevron-right icon-white\"></i></div><div class=clearfix></div></div>";

}
}
}
}
} else {
$goodlinks.="<div style=\"margin-bottom:20px;\">".$links."</div>";
$normalinks.="<div style=\"margin-bottom:20px;\">".$links."</div>";
}

//exit;
unset ($tmp,$tmp2,$tmplink);

//$goodlinks.=topw1 ($lang[127].":", $links, "100%", $nc3, strtolower($style ['bg_material']), 4,0,"[goodlinks]",true);

$file = fopen (".$base_loc/goodlinks.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/goodlinks.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$goodlinks");
fclose ($file);


$file = fopen (".$base_loc/links.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/links.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "<script language=\"javascript\">
function nl(arg) {
if (document.getElementById('d_'+arg).style.display=='none') {
document.getElementById('d_'+arg).style.display='block';
document.getElementById('i_'+arg).className='icon-chevron-down icon-white';
} else {
document.getElementById('d_'+arg).style.display='none';
document.getElementById('i_'+arg).className='icon-chevron-right icon-white';
}
}
</script><div class=box3>".str_replace("<font style=\"font-size: ".($main_font_size+1)."pt;\">","", str_replace("</font>","",$normalinks))."</div>");
fclose ($file);




//Формируем карту сайта без Вики Индекса и подразделы меню

$bottom_links="";
$blinkcontent1="";
//echo $links; exit;
$tmplink=explode($carat2,$links);
if (count($tmplink)>0) {

while (list($linkey,$linval)=each($tmplink)) {


$titlink=strtoken($linval,"</a></b></font><br>")."</a></b>";

if (strip_tags($titlink)!="") {
//echo $linkey." ".$linval."<br>";
$linkcontent=str_replace($titlink."</font><br>","",$linval);
$tmp=explode("\n", $linkcontent);
$raz=substr($titlink,4,1);
$linkcontent="";
$linkcontent3="";
natcasesort ($tmp);
$tmp2=Array();
while (list($key,$val)=each($tmp)) {
if (trim(strip_tags($val))!="") {
if ($sort_sub=="name") {
$indx=ExtractString ($val,"'>", "</a>");
$tmp2[$key]="<!--$indx-->".$val;
}
if ($sort_sub=="order") {
$tmp2[$key]=$val;
}
if ($sort_sub=="date") {
$indx=@filemtime("$base_loc/content/".ExtractString ($val,"<!--", "-->").".txt");
$tmp2[$key]="<!--$indx-->".$val;
}
}
}
natcasesort ($tmp2);
if ($sort_reverse==1) { $tmp2=array_reverse($tmp2);  }
unset ($key,$val);
$kkk=0;
unset ($mlinkcontent);
while (list($key,$val)=each($tmp2)) {
if (trim($val)!="") {

$mlinkcontent[$kkk]=str_replace("&nbsp;<b>", "<b>",
str_replace("$carat","<i class='icon-chevron-right'></i>",
str_replace("--><br>","-->",$val)));

$kkk++;
}
}
$linkcontent1="";
unset ($key,$val);
@reset ($mlinkcontent);
$zz=1;
while (list($key,$val)=@each($mlinkcontent)) {
if ($zz<=$max_subs) {
$linkcontent.="$val";
}
$linkcontent3.="$val";
$zz++;
}
if (count($tmp)>($max_subs+1)) {
$linkcontent1="<a class=pull-right href=index.php?page=".$raz.">".$lang[1546]." ".(count($tmp)-$max_subs-2)." <i class='icon-chevron-right'></i></a>\n";
 }
unset ($tmp,$tmp2);
$rtit=ExtractString ($titlink,"'>", "</a>");
if (strlen($rtit)>25) { $titsiz=(intval($title_font_size)-2); } else { $titsiz=intval($title_font_size); }
if (trim(strip_tags($linkcontent))!=""){

$rlinks[translit($rtit)]= str_replace("<i class='icon-chevron-right'></i>&nbsp;", "<li tabindex=\"-1\" class=\"nowrap\">", str_replace("</a><br>", "</a></li>\n", $linkcontent));
if ($linkcontent1!="") { $rlinks[translit($rtit)].= "<li tabindex=\"-1\" class=\"nowrap\">$linkcontent1</li>"; }
//titul item
if ($zz>$max_subs) {
$rlinks[translit($rtit)]= "<!--$raz-->\n<ul class=\"dropdown-menu\" style=\"text-align:left;\">
    <li class=\"nowrap lnk\">".str_replace("'>","'><i class=\"icon-chevron-down icon-white pull-right\"></i>",str_replace("<b>","",str_replace("</b>","",str_replace("<br>","",str_replace("</font>","",  $titlink)))))."</li>\n"."<li>
         	<ul class=\"dropdown-menu scroll-menu\" style=\"text-align:left;\">".str_replace("<i class='icon-chevron-right'></i>&nbsp;", "<li tabindex=\"-1\" class=\"nowrap\">", str_replace("</a><br>", "</a></li>\n", $linkcontent3))."</ul>
        </li>
        <li class=\"disabled\" style=\"text-align:center;\"><a href=\"#\"><i class=\"icon-chevron-down\"></i></a></li>
   </ul>";
   } else {
$rlinks[translit($rtit)]= "<!--$raz-->\n<ul class=\"dropdown-menu\" style=\"text-align:left;\">
    <li class=\"nowrap lnk\">".str_replace("'>","'><i class=\"icon-chevron-down icon-white pull-right\"></i>",str_replace("<b>","",str_replace("</b>","",str_replace("<br>","",str_replace("</font>","",  $titlink)))))."</li>\n"."
     ".$rlinks[translit($rtit)]."
   </ul>";
   }
//end titul item

} else {
$rlinks[translit($rtit)]= "<!--$raz-->";
}
if ($linkey<$bottom_links_subs_qty) {
$bottom_links.="<div class='pull-left mr hvr' align=left style=\"text-align: left; margin-bottom:20px; width:".$bottom_links_subs_size.";\">".str_replace("<br>","","<font style=\"font-size: ".$titsiz."px\">".str_replace("</font><br>","", $titlink)."</font>")." $linkcontent1<div class=hr2></div>". $linkcontent."</div>";
}
}
}
} else {
$bottom_links.="<div class='pull-left mr' style=\"margin-bottom:20px; width:".$bottom_links_subs_size.";\">"."</div>";
}

$bottom_links.="<div class='pull-left mr hvr' align=left style=\"text-align: left; margin-bottom:20px; width:".$bottom_links_subs_size.";\"><font style=\"font-size: ".($main_font_size+1)."pt;\"><b><a href=\"index.php?action=sendmail\">$lang[54]</a></b></font><div class=hr2></div></div><div class=\"pull-left mr\"><font size=5 color=$nc9>$telef</font><br><font color=$nc9>$zak_po</font><br><br><div class=nohvr><a href=\"index.php?action=sendmail\" class='btn btn-warning'><i class=icon-envelope></i> $lang[1567]</a></div></div>";
//echo "$linkcontent<br><br>$linkcontent3"; exit;

//exit;
unset ($tmp,$tmp2,$tmplink);



//echo $bottom_links;
/*
while (list($key,$val)=each($rlinks)) {

$file = fopen (".$base_loc/$key.menu", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/$key.menu</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$val");
fclose ($file);

}
*/
$file = fopen (".$base_loc/bottomlinks.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/blinks.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$bottom_links");
fclose ($file);



//Формируем карту сайта добавляя индекс Вики
unset ($tmplink, $tmp, $tmp2);
$tmplink=explode($carat2,$wrlinks);
if (count($tmplink)>0) {

while (list($linkey,$linval)=each($tmplink)) {



$titlink=strtoken($linval,"<!--");
if ($titlink!="") {
//echo $linkey." ".$linval."<br>";
$linkcontent=str_replace($titlink,"",$linval);
$tmp=explode("\n", $linkcontent);
$raz=substr($linkcontent,4,1);
$blinkcontent="";
//natcasesort ($tmp);
$tmp2=Array();
while (list($key,$val)=each($tmp)) {
//echo "$titlink $key $val<br>";
if (trim(strip_tags($val))!="") {
if ($sort_sub=="name") {
$indx=ExtractString ($val,"'>", "</a>");
$tmp2[$key]="<!--$indx-->".$val;
}
if ($sort_sub=="order") {
$tmp2[$key]=$val;
}
if ($sort_sub=="date") {
$indx=@filemtime("$base_loc/content/".ExtractString ($val,"<!--", "-->").".txt");
$tmp2[$key]="<!--$indx-->".$val;
}
}
}
natcasesort ($tmp2);
if ($sort_reverse==1) { $tmp2=array_reverse($tmp2);  }
unset ($key,$val);
while (list($key,$val)=each($tmp2)) {

$blinkcontent.=str_replace("&nbsp;<b>", "<b>",
str_replace("$carat","<i class='icon-chevron-right'></i>",
str_replace("--><br>","-->",$val)));

}

$blinkcontent1="";

unset ($tmp,$tmp2);
$rtit=ExtractString ($titlink,"'>", "</a>");
if (strlen($rtit)>25) { $titsiz=(intval($title_font_size)-2); } else { $titsiz=intval($title_font_size); }
$blinks.="<br><br><div class='basketfont' align=left style=\"text-align: left; margin-bottom:20px;\">".str_replace("<br>","","<font style=\"font-size: ".$titsiz."px\"><b>".str_replace("</font><br>","", str_replace("<a ", "<a style=\"margin-top:20px;\" ", $titlink))."</b></font>")." $blinkcontent1<hr>". $blinkcontent."</div>";

}
}

} else {
$blinks.="<br><br><div class='basketfont' style=\"margin-bottom:20px; width:".$bottom_links_subs_size.";\">"."</div>";
}

//Формируем навигацию верхнего меню
unset ($tmplink, $tmp, $tmp2);
$tmplink=explode($carat2,$blinks);
$blinks="";
$navigate2="";
if (count($tmplink)>0) {

while (list($linkey,$linval)=each($tmplink)) {



$titlink=strtoken($linval,"<!--");
if ($titlink!="") {
//echo $linkey." ".$linval."<br>";
$linkcontent=str_replace($titlink,"",$linval);
$tmp=explode("\n", $linkcontent);
$raz=substr($linkcontent,4,1);
$blinkcontent="";
//natcasesort ($tmp);
$tmp2=Array();
while (list($key,$val)=each($tmp)) {
//echo "$titlink $key $val<br>";
if (trim(strip_tags($val))!="") {
if ($sort_sub=="name") {
$indx=ExtractString ($val,"'>", "</a>");
$tmp2[$key]="<!--$indx-->".$val;
}
if ($sort_sub=="order") {
$tmp2[$key]=$val;
}
if ($sort_sub=="date") {
$indx=@filemtime("$base_loc/content/".ExtractString ($val,"<!--", "-->").".txt");
$tmp2[$key]="<!--$indx-->".$val;
}
}
}
natcasesort ($tmp2);
if ($sort_reverse==1) { $tmp2=array_reverse($tmp2);  }
unset ($key,$val);
while (list($key,$val)=each($tmp2)) {

$blinkcontent.=str_replace("&nbsp;<b>", "<b>",
str_replace("$carat","<i class='icon-chevron-right'></i>",
str_replace("--><br>","-->",$val)));

}

$blinkcontent1="";

unset ($tmp,$tmp2);
$rtit=ExtractString ($titlink,"'>", "</a>");
if (strlen($rtit)>25) { $titsiz=(intval($title_font_size)-2); } else { $titsiz=intval($title_font_size); }
$blinks.="<div class='basketfont' align=left style=\"text-align: left; margin-bottom:20px;\">".str_replace("<br>","","<font style=\"font-size: ".$titsiz."px\"><b>".str_replace("</font><br>","", str_replace("<a ", "<a style=\"margin-top:20px;\" ", $titlink))."</b></font>")." $blinkcontent1<hr>". $blinkcontent."</div>";
$idx=@$rlinks[translit($rtit)];
$pimg=@$plinks[translit($rtit)];
if (strlen($idx)==8) {
$navigate2.="<li class=\"noactive\">".str_replace("</font>", "",str_replace("\n", "", str_replace("<font color=\"$nc9\" class=f1>","<font color=\"$nc9\">", str_replace("<b><a ","<a ", str_replace("</a></b>","</a>", str_replace("<br>", "", $titlink))))))."</li>$idx\n\n";
} else {
$navigate2.="<li class=\"dropdown noactive\">".str_replace("\n", "", str_replace("<font color=\"$nc9\" class=f1>","<font color=\"$nc9\">", str_replace("<b><a ", "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" ", str_replace("</font></b>","</font>", str_replace("</a></b>", "<b class=\"caret\"></b></a>", str_replace("<br>", "", $titlink)))))).$idx."</li>\n\n";
}

}
}

} else {
$blinks.="<div class='basketfont' style=\"margin-bottom:20px; width:".$bottom_links_subs_size.";\">"."</div>";
}

$file = fopen (".$base_loc/navigate2.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/navigate2.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$navigate2");
fclose ($file);


$file = fopen (".$base_loc/blinks.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/blinks.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$blinks");
fclose ($file);




$file = fopen (".$base_loc/navigate.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/navigate.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
$navigate=implode("\n", $navi);
fputs ($file, "$navigate");
fclose ($file);
if ($wikireplace!="") {
$file = fopen (".$base_loc/wikireplace.txt", "w");
if (!$file) {
echo "<p> Error writing file <b>.$base_loc/wikireplace.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, strip_tags(@$wikireplace));
fclose ($file);
}
echo ". . .";


//last goods последние поступления
$last_goods_tosave="";
@ksort($last_goods);
@reset ($last_goods);
while (list ($line_num, $line) = @each ($last_goods)) {
echo "\n";
$last_goods_tosave.="^".@$min[$line_num]."^".@$max[$line_num]."^||".$line;
}
$file = fopen (".$base_loc/lastgoods.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/lastgoods.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$last_goods_tosave");
fclose ($file);
//echo "$last_goods_tosave";
echo ". . .";

//last goods последние поступления
$top_sales_tosave="";
@natsort($top_sales);
@reset ($top_sales);
$tmparrs=@array_reverse($top_sales);
unset ($top_sales);

$ts=0;
while (list ($line_num, $line) = @each ($tmparrs)) {
echo "\n";

//if($ts<10) {
$top_sales_tosave.=$line;
//}
$ts+=1;
}
$file = fopen (".$base_loc/top_sales.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/top_sales.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$top_sales_tosave");
fclose ($file);
//echo "$last_goods_tosave";
echo ". . .";


//новинки

$file = fopen (".$base_loc/novelty.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/novelty.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$noveltys_tosave");
fclose ($file);
//echo "$noveltys_tosave";
echo " . . .";



//Индексация опций поиска

$optfile="../templates/$template/$speek/custom_search.inc";
if (@file_exists($optfile)) {
$optionmass=file($optfile);
while (list ($op_num, $op_line) = each ($optionmass)) {
echo "\n";
$op_mass=explode("|",$op_line);
if (isset($op_mass[0],$op_mass[1],$op_mass[2],$op_mass[3])) {
echo "\n";
$namez["".$op_mass[0]]="".$op_mass[1]."";
while (list ($op_num2, $op_line2) = each ($op_mass)) {
echo "\n";
$opre=explode("^", $op_line2);
if (isset($opre[0],$opre[1])) {
$options[$op_mass[0]]=@$options[$op_mass[0]]."<option value=\"".$opre[1]."\">".$opre[0]."</option>";
}
}
}
}
}
while (list ($numo, $lineo) = each ($options)) {
echo "\n";
$file = fopen ("./search/$numo.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>./search/$numo.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, " <form name=\"sopto\" action=\"index.php\" method=\"GET\"><small>".$namez["".$numo]."</small> <input type=\"hidden\" name=\"catid\" value=\"$numo\"> <select name=\"query\" onchange=\"document.forms['sopto'].submit()\"> <option value=\"\"> </option>$lineo</select>&nbsp;&nbsp;</form> ");
fclose ($file);
}

echo "$reindex";
?>
</div></body>
</html>
