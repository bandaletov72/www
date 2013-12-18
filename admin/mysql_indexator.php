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
<!DOCTYPE html><html>
<TITLE>INDEX</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body bgcolor=#ffffff>
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
$fp = fopen ("../style_".$speek.".css" , "w"); flock ($fp, LOCK_EX);
fputs($fp, str_replace("{nc10}", "[nc10]", str_replace("{lnc10}", "[lnc10]", $cssflush)));flock ($fp, LOCK_UN);
fclose($fp);
//echo $css;


$st=0;
$minibase="";
$zf=0;
$rating=Array();

$add_query="";
$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die("Could not select db : " .mysql_error());

$query="DROP TABLE IF EXISTS `".$dbpref."_minibase_".$speek."`";
echo "$query ...<br>\n";
mysql_query("$query");
$query="CREATE TABLE IF NOT EXISTS `".$dbpref."_minibase_".$speek."` ( `unifid` TEXT, `name` TEXT, `on_offer` TEXT, `enum` TEXT, `date` TEXT, `img` TEXT, `hidart` TEXT, `manurl` TEXT, `price` TEXT, `index` TEXT, `brand` TEXT)";
mysql_query("$query");
if (mysql_errno()) die("Query Error: $query <br>" . mysql_error());

if ($view_deleted_goods==0) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {
$add_query.=" WHERE (`on_offer`='1')";
}
}
//echo $mysql_query;
$mysql_query="SELECT * FROM $file".$add_query;
echo "<br>".$mysql_query."<br>";
$result=mysql_query("$mysql_query");

while($row = @mysql_fetch_row($result)) {
$stun="";
while(list($k,$v)=each($row)) {
//echo $k."=>".$v."<br>";
if ($k>9) {
$stun.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}

$outun=explode("|",$stun);
$outun[0]=$st;
$stun=implode("|",$outun);
$fcontents[$zf]=$stun;
//echo htmlspecialchars($fcontents[$zf])."<br>";
if ((@$outun[3]!="")&&(substr(@$outun[12],0,1)=="1")) {
if ($view_deleted_goods==1) {
$minibase.=@$outun[1]."|".@$outun[2]."|".@$outun[3]."|".@$outun[4]."|".@$outun[5]."|".@$outun[6]."|".toLower(strip_tags(@$outun[7]))."|".@$outun[8]."|".@$outun[9]."|".@$outun[13]."|\n";

} else {
if (@$outun[4]!=0) {
$minibase.=@$outun[1]."|".@$outun[2]."|".@$outun[3]."|".@$outun[4]."|".@$outun[5]."|".@$outun[6]."|".toLower(strip_tags(@$outun[7]))."|".@$outun[8]."|".@$outun[9]."|".@$outun[13]."|\n";
}
}
}
$query="INSERT INTO `".$dbpref."_minibase_".$speek."` SET `index`='".mysql_real_escape_string(strip_tags($minibase))."',`on_offer`='".mysql_real_escape_string(@$outun[12])."',`price`='".mysql_real_escape_string(@$outun[5])."',`unifid`='".mysql_real_escape_string(md5(@$outun[3]." ID:".@$outun[6]))."', `img`='".mysql_real_escape_string(@$outun[9])."',`name`='".mysql_real_escape_string(@$outun[3])."'";
mysql_query("$query");
//echo "<br>".$query;
if (mysql_errno()) die("Query Error: $query <br>" .mysql_error());

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

while (list ($keyunr, $lineunr) = each ($rating)) {
//	echo "$keyunr - $lineunr<br>";
$df=fopen("./comments/$keyunr.rate", "w");
fputs($df, $lineunr);
fclose ($df);
}
unset ($rating);
$df=fopen("./comments/rate.txt", "w");
fputs($df, $rrating);
fclose ($df);
unset ($rrating);
$st=0;
while (list ($keyun, $lineun) = @each ($unif)) {
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

/* Mysql no needed
$fpun_file=".$base_loc/items/$keyun.txt";
$fpun=fopen($fpun_file,"w");
fputs($fpun,$strokeun);
fclose($fpun);
*/

}



$novelmass=@array_reverse($fcontents);
@reset ($novelmass);

$noveltys_tosave2=Array();
$noveltys_qty=50;
while (list ($line_num, $line) = @each ($novelmass)) {
echo "\n";

if (($line!="")&&($line!="\n")) {
$outs=explode("|",$line);
if ((@$outs[4]!=0)&&(@$outs[12]!=0)) {
$noveltys_tosave2[]="$line";
$noveltys_qty-=1;
if ($noveltys_qty<=0) {break;}
}
}
}
unset ($novelmass);
$noveltys_tosave=implode("",array_reverse($noveltys_tosave2));
//Теперь получиv список разделов и подразделов
$allrazdels=@$fcontents;
$tot_tov=@count($fcontents);
$mst=0;
$fid=0;
while (list ($line_num, $line) = @each ($allrazdels)) {
echo "\n";

if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
if  ((@$out[12]!="0")&&(@$out[12]!=0)&&(@$out[12]!="")) {



if ($view_deleted_goods==1) {
$st=@$podstavasa[$out[1]."|".$out[2]."|"]."-".$mst;
$tmpmaxnomer[$st] = $out[0];
$tmpsubrazdels[$st] = $out[1]. "|" . $out[2] ."|";
$indexlc=(100000*(doubleval(@$podstavasa[$out[1]."|"."|"]))+doubleval(@$podstavasa[$out[1]."|".$out[2]."|"]));
if (($out[1]!=$lang[418])&&(@$podstavasa[$out[1]."|".$out[2]."|"]!="000000")) {@$last_goods[$indexlc]=$line;}

@$price=doubleval($out[4]);
//$price=0.01*(round((@$price*$kurs)/0.01));
$pricek=doubleval($out[4]);
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
} else { $price=0.01*(round((@$price-(@$price*((double)$podstavas[$out[1]."|".$out[2]."|"])/100))/0.01));
$pricek=@$pricek-(@$pricek*(doubleval($podstavas[$out[1]."|".$out[2]."|"])/100));
$strto2=doubleval($podstavas[$out[1]."|".$out[2]."|"]);
} } else {$price=0.01*(round(@$price/0.01));}

if ($strto2>0) {
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
@reset ($allrazdels);
while (list ($line_num, $line) = @each ($allrazdels)) {
echo "\n";
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);

if  ((@$out[12]!="0")&&(@$out[12]!=0)&&(@$out[12]!="")) {
$indexbr=translit0(trim(@$out[13]));
if (!isset($brandname[$indexbr])) {$brandname[$indexbr]=trim($out[13]);}
//if ($view_brands==1){

if ($out[13]!=""){
@$tmpbrands[$st] = $out[2]."|<!--".$out[13]."-->&nbsp;&nbsp;<font class=small face=\"Verdana\" color=\"".$nc4."\">$sym</font>&nbsp;<b><a href = \"index.php?catid=".$tablenum[$out[1]."|".$out[2]. "|"]."&brand=".rawurlencode($out[13])."\"><font class=small color=\"".$nc9."\">".$out[13]."</font></a></b><br>|".$out[1]."|".$out[13]."|";
} else {
$tmpbrands[$st] = $out[2]."|<!--zzzzz-->&nbsp;&nbsp;<font class=small face=\"Verdana\" color=\"".$nc4 ."\">$sym</font>&nbsp;<b><a href = \"index.php?catid=".$tablenum[$out[1]."|".$out[2]. "|"]."&brand=nobrand\"><font class=small color=\"".$nc9."\">".$lang[417]."</font></a></b><br>|".$out[1]."|".$lang[417]."|";

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
if ($linevv==1) {
$subbr[$bra."|".$subra] = @$subbr[$bra."|".$subra] . @$outdd[1] . " <!-- br -->";

} else {
$subbr[$bra."|".$subra] = @$subbr[$bra."|".$subra] . @$outdd[1] . " <font color=\"".lighter($nc5,0)."\"><sup>$line</sup></font><!-- br -->";
}
}
$subbrcount[$bra."|".$subra] = @$subbrcount[$bra."|".$subra]+$linevv;

}
@reset ($tmpsub);
@reset ($sbr);
while (list ($sbr_num, $sbrline) = @each ($sbr)) {
//echo translit($sbr_num."_")." = ".$sbrline."<br>";
$filegg = fopen (".$base_loc/items/".translit($sbr_num."_").".br", "w");
if (!$file) {
echo "<p> Unable to write <b>\".$base_loc/items/".translit($sbr_num."_").".br\"</b>.\n";
exit;
}
fputs ($filegg, $sbrline);

fclose ($filegg);
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
if ($count_sub==1){ $subbr[$ra."|".$out[1]]=""; }
//if ((@$subbrcount[$ra."|".$out[1]]!="")&&($subrcount[$ra]!=@$subbrcount[$ra."|".$out[1]])): $subbr[$ra."|".$out[1]]=@$subbr[$ra."|".$out[1]]."<br>&nbsp;&nbsp;<font class=small face=\"Verdana\">$sym</font>&nbsp;<a href = \"index.php?catid=".$tablenum[$ra."|".$out[1]. "|"]."&brand=nobrand\"><font color=\"".lighter($nc5,0)."\">".$lang[417]."</font></a> <font color=\"".lighter($nc5,0)."\"><sup>".(@$subbrcount[$ra."|".$out[1]]-$subrcount[$ra])."</sup></font>"; endif;
$tmy=$tablenum[$ra."|".$out[1]. "|"];
$sk="";
if (@$catidys[$tmy]!="") {
//$sk="&nbsp;<sup><b><font color=white style=\"background-color: #b94a48\">-".$catidys[$tmy]."%</font></b></sup>";
$sk="";
}
if (@$catidyc["".translit($ra).""]=="") {$catidyc["".translit($ra).""]=lighter($nc10,-40);}

if ($line==1) {
$subr[$ra] = @$subr[$ra] . "<font color=".$catidyc["".translit($ra).""]."><b>$carat</b></font> <a href = \"index.php?catid=".$tablenum[$ra."|".$out[1]. "|"]."\" style=\"color:".$nc4."\">".str_replace (" NEW" , "</a> <a><font color=\"".$nc2."\"><sup><b>NEW</b></sup></font>", $out[1])."</a> ".$sk."<br>\n" . @$subbr[$ra."|".$out[1]];
} else {
$subr[$ra] = @$subr[$ra] . "<font color=".$catidyc["".translit($ra).""]."><b>$carat</b></font> <a href = \"index.php?catid=".$tablenum[$ra."|".$out[1]. "|"]."\" style=\"color:".$nc4."\">".str_replace (" NEW" , "</a> <a><font color=\"".$nc2."\"><sup><b>NEW</b></sup></font>", $out[1])."</a> <font color=\"".$nc4."\"><sup>$line</sup></font>".$sk."<br>\n" . @$subbr[$ra."|".$out[1]];
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
$razdel .= "<h4 style=\"font-size: ".($main_font_size+0)."pt; line-height: 1.1em; margin: 0;\">$llgo&nbsp;<a href = \"index.php?catid=".$tablenumr[$line_num]."\" style=\"color:".$catidyc["".$tablenumr[$line_num].""]."\">".str_replace (" NEW" , "</a> <a><font color=\"".$nc2."\"><sup><b>NEW</b></sup></font>", $line_num)."</a></h4>$line<br>\n";
$st += 1;
}
$razdel.="";
$file = fopen (".$base_loc/dirs.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/dirs.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&brand=", "/", "$razdel"));  endif;
fputs ($file, str_replace("</sup></font><!-- br --><br>", "</sup></font><br><img src=\"$htpath/pix.gif\" width=1 height=25>","$razdel"));

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
$razdel .= "<td width=25% valign=top><a href = \"index.php?catid=".$tablenumr[$line_num]."\">".str_replace("border=0","border=0 hspace=\"".$style['cat_hsp']."\" vspace=\"".$style['cat_vsp']."\"", @$catidy[$tmi])."<br><b><FONT  color=\"".$nc9."\">$line_num</FONT></b></a> $line</td>\n";
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
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&brand=", "/", "$razdel"));  endif;

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
$razdel .= "<br><h4 style=\"font-size: ".($main_font_size+0)."pt; line-height: 1.1em; margin: 0pt;\"><span class=Outline style=\"cursor: hand;\" id=\"".$tablenumr[$line_num]."\"><img src=\"$image_path/closed.gif\" id=\"img$st\" border=0 align=\"absmiddle\" onclick=\"checker('$st');\"> </span><FONT color=\"".lighter($nc5,0)."\"><b><span onclick=\"checker('$st');\" id=Out".$st." class=Outline style=\"cursor: hand; \"><a href=\"#".str_replace("\"", "", str_replace("\'", "", $line_num))."\"><span style=\"color:".$catidyc["".$tablenumr[$line_num].""]."\">$line_num</span></a></span></b></font></h4>\n
<div id=Out".$st."details style=\"display:None;\"><!-- ".$tablenumr[$line_num]." -->$line</div></div>\n";
$st += 1;
}
$razdel.="<script language=\"javascript\">
function checker(arg) {
if (document.getElementById('Out'+arg+'details').style.display == 'none') {
document.getElementById('Out'+arg+'details').style.display='inline';
document.getElementById('img'+arg).src='$image_path/open.gif';
} else {
document.getElementById('Out'+arg+'details').style.display='none';
document.getElementById('img'+arg).src='$image_path/closed.gif';
}
}

</script>


";
$file = fopen (".$base_loc/dirs_j.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/dirs_j.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&brand=", "/", "$razdel"));  endif;

fputs ($file, str_replace("</sup></font><!-- br --><br>", "</sup></font><br><img src=\"$htpath/pix.gif\" width=1 height=25>","$razdel"));
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
$subr[$ra] .= "<br><font color=\"".lighter($nc5,0)."\">$carat</font> <a href = \"index.php?action=links&linksub=".($ll+1)."\ style=\"color:".lighter($nc2,-40)."\">".str_replace (" NEW" , "</a> <a><font color=\"".$nc2."\"><sup><b>NEW</b></sup></font>", $out[1])."</a> (<b>$line</b>)";
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
$razdel="<b><font color=\"".lighter($nc5,0)."\">$carat</font> <a href='index.php?action=links&linksub=index'>Все ссылки</a></b> (<b>$tot_tov</b>)<br>";
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
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&brand=", "/", "$razdel"));  endif;

fputs ($file, "$razdel");
fclose ($file);

$file = fopen (".$base_loc/link_razdels.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/link_razdels.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&brand=", "/", "$razdel"));  endif;

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
$tmpsub=@array_count_values($tmpsubrazdels);

while (list ($line_num, $line) = @each ($tmpsub)) {
echo "\n";
$out=explode("|",$line_num);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
if (trim($out[3])=="") {
$subr[$ra] .= "<br><font color=\"".lighter($nc5,0)."\">$carat</font> <a style=\"color:".lighter($nc2,-40)."\" href=\"index.php?query=".rawurlencode($out[2])."\">".str_replace (" NEW" , "<font color=\"".$nc2."\"><sup> <b>NEW</b></sup></font>", $out[1])."</a>";
} else {
$subr[$ra] .= "<br><font color=\"".lighter($nc5,0)."\">$carat</font> <a style=\"color:".lighter($nc2,-40)."\" href=\"".$out[3]."\">".str_replace (" NEW" , "<font color=\"".$nc2."\"><sup> <b>NEW</b></sup></font>", $out[1])."</a>";
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
$razdel="<br>";
while (list ($line_num, $line) = @each ($subr)) {
echo "\n";
$razdel .= "<br><font color=\"".lighter($nc5,0)."\"><b>$carat2 $line_num</b></font> $line<br>\n";
$st += 1;
}
$razdel.="";
$file = fopen (".$base_loc/cmenu_index.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/cmenu_index.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
if (@$mod_rw_enable==1): $razdel=str_replace("index.php?catid=", "", str_replace("&brand=", "/", "$razdel"));  endif;

fputs ($file, "$razdel");
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
$navi[0]="<!--0--><a href='$htpath' title=".$lang['mainsite']."><i class='icon-home icon-white'></i></a>";

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
if (($file == '.') || ($file == '..') || ($file == 'config.inc')||(substr($file, -4)==".del")||(preg_match("/".str_replace("/","\\/", substr($file, 0,1))."/i",$hidden_cats))) {
continue;
} else {
echo "\n";
$fp = fopen (".$base_loc/content/$file" , "r");

$all= @fread($fp, @filesize(".$base_loc/content/$file"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$line=strip_tags($out[1]);
$linet=$out[1];

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
$wikireplace.="$line~$c~\n";
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
$comm="";
$comm=ExtractString($line,"[comm]","[/comm]");
$line=str_replace("[comm]".$comm."[/comm]", "", $line);
$purl="";
$purl=ExtractString($line,"[url]","[/url]");
$line=str_replace("[url]".$comm."[/url]", "", $line);
if ($friendly_url==1) { $flafsy=""; $manc=translit(strtoken($line,"|")); } else { $flagsy="&flag=".$speek; $manc=$c; }
if (@$mod_rw_enable==1){ $llink="$manc.html"; $llinks="$manc.html";}  else {$llink="index.php?page=$manc&z=".rawurlencode($subline)."[jstart]"; $llinks="index.php?page=$manc";}
if ($purl!="") {$llink="$purl";}
if (preg_match("/<img/i", $linet)) {

@$tmprazdelo[$tmprindex].="<!-- $line --><div onMouseOver=\"this.style.backgroundColor='$nc1';\" onMouseOut=\"this.style.backgroundColor='$nc0';\" style=\"-moz-border-radius: 10px; background: $nc0; border: 1px solid $nc6; width:100%; padding: 10px 0px; cursor:pointer; cursor:hand; text-decoration:none;\" onclick=\"location.href='".$llink."';\"><a href=$llink>". strtoken(str_replace("<img ","<img border=0 hspace=10 align=left ", strtoken(strip_tags($linet,"<img>"),"|")),">")."></a>$carat<a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\">".strtoken(strip_tags($line),"|")."</a>$voting<br>$wikisearch<br><i>$comm</i><div style=\"clear: both\"></div></div><br><!--end-->\n^";
} else {
@$tmprazdelo[$tmprindex].="<!-- $line --><div onMouseOver=\"this.style.backgroundColor='$nc1';\" onMouseOut=\"this.style.backgroundColor='$nc0';\" style=\"-moz-border-radius: 10px; background: $nc0; border: 1px solid $nc6; width:100%; padding: 10px 0px; cursor:pointer; cursor:hand; text-decoration:none;\" onclick=\"location.href='".$llink."';\"><a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\">".strtoken(strip_tags($line),"|")."</a>$wikisearch$voting<br><i>$comm</i></div><br><!--end-->\n^";

}

}
if (substr($c,0,1)!=$wiki_rubric) {
if (strlen($c)==1) {
$flagsy="";
if ($friendly_url==1) { $flagsy=""; $manc=translit(strtoken($line,"|")); } else { $flagsy="&flag=".$speek; $manc=$c; }
if (@$mod_rw_enable==1){ $llink="$manc.html";}  else {$llink="index.php?page=$manc".$flagsy."";}
if (substr($c,0,1)==$wiki_content) {
if ($view_wikicat==1) {

$navi[$razdc]="<!--$c--><a href='$llink'><b><font color=\"$nc0\">".strtoken($line,"|")."</font></b></a>";
$name="<!--$c--><br><font color=\"".lighter($nc5,0)."\">$carat2&nbsp;<b><a href='$llink'><font color=\"".lighter($nc5,0)."\">".strtoken($line,"|")."</font></a></b></font>";
$files[$st] = "$name\n";
$st += 1;
}
} else {
$navi[$razdc]="<!--$c--><a href='$llink'><b><font color=\"$nc0\">".strtoken($line,"|")."</font></b></a>";
$name="<!--$c--><br><font color=\"".lighter($nc5,0)."\">$carat2&nbsp;<b><a href='$llink'><font color=\"".lighter($nc5,0)."\">".strtoken($line,"|")."</font></a></b></font>";
$files[$st] = "$name\n";
$st += 1;
}
$razdc+=1;
} else {
if (substr($c,0,1)!=$wiki_content) {
$name = "<!--$c-->$carat&nbsp;<a href='$llinks'><font color=\"".lighter($nc2,0)."\">".strtoken($line,"|")."</font></a>";
$files[$st] = "$name\n";
$st += 1;
}
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
//document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '$nc2';

</script>"; }

@$jsall[$tmpsindex].="document.getElementById('div_".md5($tmpkey[1])."').style.visibility = 'visible';
document.getElementById('div_".md5($tmpkey[1])."').style.display = 'inline';
//document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '$nc2';
";
@$jsallcl[$tmpsindex].="document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '".lighter($nc6,-10)."';
document.getElementById('div_".md5($tmpkey[1])."').style.display = 'none';
document.getElementById('div_".md5($tmpkey[1])."').style.visibility = 'hidden';
";
@$tmpsygn[$tmpsindex].="<script language=javascript>
function js_".md5($tmpkey[1])."() {
jsallcl()
document.getElementById('divd_".md5($tmpkey[1])."').style.backgroundColor = '$nc2';
document.getElementById('div_".md5($tmpkey[1])."').style.visibility = 'visible';
document.getElementById('div_".md5($tmpkey[1])."').style.display = 'inline';

document.getElementById('viewjsall').innerHTML='".$lang[422]."';
}
</script>
<div id=\"div_".md5($tmpkey[1])."\"><a name=\"".toUpper($tmpkey[1])."\"></a><h4>".toUpper($tmpkey[1])."</h4>$val<br></div>\n";
@$tmpallwiki[$tmpsindex].="$val";
$nn+=1;
@$tmp_slide[$tmpsindex].=str_replace("width:100%; padding: 10px 0px;", "width:169px; height:".($jh-28)."px; padding: 10px 10px; overflow:hidden;",$val);
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

fputs ($file, str_replace("[jstart]", "", str_replace("<td align=center width=$wikilen"."%><font color=".lighter($nc2,0)."><td ","<td width=$wikilen"."% ","<table width=100% border=0 cellpadding=0 cellspacing=0 style=\"-moz-border-radius: 10px; background: $nc6; border: 1px solid $nc6; width:100%; padding: 5px 5px;\"><tr><td align=center><a href=\"$htpath/index.php?page=$wiki_rubric\">INDEX</a></td><td align=center width=$wikilen"."% ><font color=".lighter($nc2,0).">".str_replace("|","</font></td><td align=center width=$wikilen"."%><font color=".lighter($nc2,0).">",str_replace("-", "</td></tr><tr><td>", @$tmpsygnfound[$key]))."</font><td align=center><img src=images/pix.gif width=90 height=1><br><small><a href=#all_articles onclick=\"javascript:jsall()\"><nobr><span id=viewjsall>".$lang[386]."</span></nobr></a></small></td></tr></table>")."
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
<br><br>$val".$first[$key]));
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
$file = fopen (".$base_loc/links.txt", "w");
if (!$file) {
echo "<p> Error opening file <b>.$base_loc/links.txt</b>, or file write protected. Please check CHMOD.\n";
exit;
}
fputs ($file, "$links");
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
$last_goods_tosave.="^".@$min[$line_num]."^".@$max[$line_num]."^||".$line."\n";
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
</body>
</html>