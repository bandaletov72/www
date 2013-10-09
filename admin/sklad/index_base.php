<!DOCTYPE html><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<!--meta http-equiv="Refresh" content="0; URL=index.php"-->
</head>
<body>

<?php
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
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
$fold="../.."; require ("../../templates/lang.inc");
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

require ("../../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../../templates/$template/$speek/config.inc");
if ($stinfo=="") { echo "Складские функции отключены"; } else {

if ($stinfo=="ext") {
$file="./ost.txt";
if (@file_exists($file)) {
if (filesize($file)!=0) {
echo "<font face=verdana><p><b>Подождите. Идет индексация БД склада из внешнего файла.</b></p></font>";

$n=1;
$f=fopen($file,"r");
$qty=0;
$vit_qty=0;
$ff=0;
$tosave="";
$find=chr(0x09).chr(0x09)."шт".chr(0x09);   //ищем эту последовательность в строке для идентификации товара
$find2="=";   //убираем минимальный остаток
$find3=chr(0x09)."шт"; //Ищем в прайсе
while(!feof($f)) {


$st=fgets($f);
// теперь мы обрабатываем очередную строку $st     |||||||
@$st=trim(htmlspecialchars(str_replace("'","",  str_replace("\n","",str_replace("\0","",str_replace(chr(0xA6),"",str_replace("  "," ",str_replace(chr(0xAC),"",str_replace(chr(0x4C),"",str_replace(chr(0x2B),"",str_replace("\n","",str_replace(chr(0x09).chr(0x20).chr(0x09).chr(0x20).chr(0x09), chr(0x09),@$st))))))))))));


//echo $st."<br>";
if (($st!=="")&&(preg_match("/$find/i", $st)!==0)) {
$qty+=1;
echo "\n";
$out=explode(chr(0x09),$st);
if (@$out[0]=="") {} else {

$ff+=1;

$art= preg_replace("([\D]+)", "", preg_replace("/\(.*\)/U", "", preg_replace('/\(([0-9]{1,4})\)/', '$1', str_replace("-","",  @strtoken(@$out[0], " ")))));  # Артикул из 1С



$artnum=str_replace(" ", "" , @strtoken(@$out[0], " ")); # Артикул из базы магазина


$naim=str_replace( ", мин. остаток ", "",  @strtoken(str_replace("$artnum ", "", @$out[0]), $find2))." $artnum";
$num=$naim;

$ost[$num]="$art|".$ff."|".$naim ."|^". (intval(@$out[4])+@intval(@$out[6])+@intval(@$out[8]))." шт. (ПП: ".intval(@$out[4])." шт, Б: ".@intval(@$out[6])." шт, К: ".@intval(@$out[8])." шт)|".((@intval(doubleval(@$out[3]*10)))/10)."|".intval(@$out[4])."|".@intval(@$out[6])."|".@intval(@$out[8])."|";
//echo $ost[$num]."<br>";

}
}

}

fclose ($f);
unset ($f);
unset ($out);
$ff=0;
$tosave="";
//echo "<table>";
/*
$file="./price.txt";
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
$tosave="";

while(!feof($f)) {


$st=fgets($f);

// теперь мы обрабатываем очередную строку $st     |||||||

@$st=trim(htmlspecialchars(str_replace("'","",  str_replace("\n","",str_replace("\0","",str_replace(chr(0xA6),"",str_replace("  "," ",str_replace(chr(0xAC),"",str_replace(chr(0x4C),"",str_replace(chr(0x2B),"",str_replace("\n","",@$st)))))))))));
if (($st!=="")&&(preg_match("/$find3/i", $st)!==0)) {

$qty+=1;
echo "-";
$out=explode(chr(0x09),$st);
if ((@$out[0]=="")||(preg_match("/Audi/i",$out[0])==1)||(preg_match("/Mascot/i",$out[0])==1)||(preg_match("/BMW/i",$out[0])==1)||(preg_match("/D&G/i",$out[0])==1)||(preg_match("/Blanc/i",$out[0])==1)||(preg_match("/ Pit /i",$out[0])==1)||(preg_match("/Fascino/i",$out[0])==1)||(preg_match("/Fresco/i",$out[0])==1)||(preg_match("/Gastone/i",$out[0])==1)||(preg_match("/Pelbo/i",$out[0])==1)||(preg_match("/Dcoll/i",$out[0])==1)||(preg_match("/ J&D /i",$out[0])==1)||(preg_match("/eonardo/i",$out[0])==1)||(preg_match("/Mattioli/i",$out[0])==1)||(preg_match("/Caster/i",$out[0])==1)||(preg_match("/Rossi/i",$out[0])==1)||(preg_match("/Cerrutti/i",$out[0])==1)||(preg_match("/Wanlima/i",$out[0])==1)||(preg_match("/Moro/i",$out[0])==1)||(preg_match("/Cartier/i",$out[0])==1)||(preg_match("/Feragamo/i",$out[0])==1)||(preg_match("/Champ/i",$out[0])==1)||(preg_match("/Capri/i",$out[0])==1)||(preg_match("/N.Tacchini/i",$out[0])==1)||(preg_match("/Eredl/i",$out[0])==1)||(preg_match("/ RB /i",$out[0])==1)||(preg_match("/Rockfeld/i",$out[0])==1)||(preg_match("/ HB /i",$out[0])==1)||(preg_match("/Bodenschatz/i",$out[0])==1)||(preg_match("/Nardini/i",$out[0])==1)||(preg_match("/Montenapoleone/i",$out[0])==1)||(preg_match("/Gabrieli/i",$out[0])==1)||(preg_match("/Cavalli/i",$out[0])==1)||(preg_match("/Vogue/i",$out[0])==1)||(preg_match("/Hechter/i",$out[0])==1)||(preg_match("/Chan/i",$out[0])==1)||(preg_match("/Dupont/i",$out[0])==1)||(preg_match("/Ferragamo/i",$out[0])==1)||(preg_match("/Prensiti/i",$out[0])==1)||(preg_match("/Peroth/i",$out[0])==1)||(preg_match("/Swar/i",$out[0])==1)||(preg_match("/Boss/i",$out[0])==1)||(preg_match("/Caramello/i",$out[0])==1)||(preg_match("/ CD /i",$out[0])==1)||(preg_match("/Kenzo/i",$out[0])==1)||(preg_match("/Balestra/i",$out[0])==1)||(preg_match("/Корона/i",$out[0])==1)||(preg_match("/Petek/i",$out[0])==1)||(preg_match("/R.Bal/i",$out[0])==1)||(preg_match("/Gucci/i",$out[0])==1)||(preg_match("/Agatha/i",$out[0])==1)||(preg_match("/ KB /i",$out[0])==1)||(preg_match("/J&D/i",$out[0])==1)||(preg_match("/Coveri/i",$out[0])==1)||(preg_match("/Valentino/i",$out[0])==1)||(preg_match("/ Val /i",$out[0])==1)||(preg_match("/Armani/i",$out[0])==1)||(preg_match("/Versace/i",$out[0])==1)||(preg_match("/Dunhill/i",$out[0])==1)||(preg_match("/Prada/i",$out[0])==1)||(preg_match("/Bally/i",$out[0])==1)||(preg_match("/ Fer /i",$out[0])==1)||(preg_match("/Intuition/i",$out[0])==1)||(preg_match("/DKNY/i",$out[0])==1)||(preg_match("/Givenchi/i",$out[0])==1)||(preg_match("/Chloe/i",$out[0])==1)||(preg_match("/Winiter/i",$out[0])==1)||(preg_match("/Egoist/i",$out[0])==1)||(preg_match("/Ancarani/i",$out[0])==1)||(preg_match("/D&G/i",$out[0])==1)||(preg_match("/J&D/i",$out[0])==1)||(preg_match("/Em.Val/i",$out[0])==1)||(preg_match("/GFF/i",$out[0])==1)||(preg_match("/Amazzonia/i",$out[0])==1)||(preg_match("/Sabatini/i",$out[0])==1)||(preg_match("/Strada/i",$out[0])==1)||(preg_match("/ DP /i",$out[0])==1)||(preg_match("/ NT /i",$out[0])==1)||(preg_match("/I.Ton/i",$out[0])==1)||(preg_match("/Rudi/i",$out[0])==1)) {} else {
$ff+=1;
$art= preg_replace("([\D]+)", "", preg_replace("/\(.*\)/U", "", str_replace("-","",  @$out[0])));  # Артикул из 1С
$artnum=str_replace(" ", "" , @strtoken(@$out[0], " ")); # Артикул из базы магазина

$price=str_replace(" УЕ", "", $out[1]);
$naim=str_replace( ", мин. остаток ", "",  @strtoken(str_replace("$artnum ", "", @$out[0]), $find2))." $artnum";
$num=$art;


if (@$ost[$num]) {
//$ost[$num].=ceil((double)$price)."|";

}
}
}
}
fclose($f);
unset ($out);

*/


@natcasesort ($ost);
@reset ($ost);
$ff=1;
$sum=0;
$base="";
//echo "<table border=0 cellpadding=5>";
while (list ($key, $val) = @each ($ost)) {
$qty+=1;
echo "\n";
$out=explode("|",$val);
$art=@$out[0];
$art2=substr($art , 0, 4);
$art3=substr($art , -4);
//echo "<tr><td>".$ff.".</td><td> ".@$out[1]."</td><td> ".@$out[2]."</td><td>Арт: <a href=\"http://www.evalux.ru/index.php?query=$art\" target=\"newwindow\">$art</a></td><td> ".@$out[3]." ".$lang['pcs']."</td><td> $".@$out[4]."</td></tr>\n";
$out[2]=str_replace("(", " (", @$out[2]);
$base.="$ff|".@$out[1]."|".@$out[2]."|$art|".@$out[3]."|".@$out[4]."|\n";
//echo "$ff|".@$out[1]."|".@$out[2]."|$art|".@$out[3]."|".@$out[4]."|\n"."<br>";
//echo "$ff|".@$out[1]."|".@$out[2]."|$art|".@$out[3]."|".@$out[4]."|<br>";
if (!@$tmpbase[$art]) {
$tmpbase[$art]=@$out[2]." ($art) - \$".@$out[4]." ".@$out[3]."|";
} else {
$tmpbase[$art].=@$out[2]." ($art) - \$".@$out[4]." ".@$out[3]."|";
}
if (!@$tmpbase2[$art2]) {
$tmpbase2[$art2]=@$out[2]." ($art) - \$".@$out[4]." ".@$out[3]."|";
} else {
$tmpbase2[$art2].=@$out[2]." ($art) - \$".@$out[4]." ".@$out[3]."|";
}
if (!@$tmpbase3[$art3]) {
$tmpbase3[$art3]=@$out[2]." ($art) - \$".@$out[4]." ".@$out[3]."|";
} else {
$tmpbase3[$art3].=@$out[2]." ($art) - \$".@$out[4]." ".@$out[3]."|";
}

$sum+=@$out[4]*(@$out[5]+@$out[6]);
$ff+=1;
}
//echo "</table>";

//echo $tosave;
$file = fopen ("./base.txt", "w");
if (!$file) {
echo "<p> Не могу открыть файл <b>./base.txt</b> для записи.</p></font>\n";
exit;
}
fputs ($file, $base);
fclose ($file);
echo "</font></span></p><br><br><font face=verdana><b>".$lang[206]." ".($ff-1)." ".$lang[207].". ".$lang[33]." ".$sum." </b><br><br>";
echo "<p><b>Индексация базы данных склада произведена.</b></p></font>\n";

} else {
echo "<br>Файл остатков - пустой<br>";
}
} else {
echo "<br>Отсутствует файл остатков<br>";
}

}
//индексация остатков
echo "<font face=verdana><p><b>Подождите. Идет индексация остатков склада.</b></p></font>";

$df=0;
$ff=0;
$sum=0;
$n=1;
$file="../.$base_file";
$f=fopen($file,"r");

while(!feof($f)) {


$st=fgets($f);

// теперь мы обрабатываем очередную строку $st     |||||||

if (($st!=="")&&($st!="\n")) {

$out=explode("|",$st);
if (isset($out[3])) {
if ($out[3]!="") {

$art=@preg_replace("([\D]+)", "", preg_replace('/\(([0-9]{1,4})\)/', '$1',  str_replace("-","", @$out[3])));

$art2=@substr($art , 0, 4);
$art3=@substr($art , -4);
unset ($tmpmass);
if (!@$tmpbase[$art]) {
$sklad= "";
} else {
$sklad= $tmpbase[$art];
}
if (@$tmpbase2[$art2]) {
$sklad .= $tmpbase2[$art2];
}
if (@$tmpbase3[$art3]) {
$sklad .=$tmpbase3[$art3];
}

if ($sklad=="") {
$sklad ="<font color=#b94a48><b>$lang[202] $lang[174]</b></font>";
} else {
unset ($tmpsklad);
$tmpsklad=explode ("|", $sklad);
unset ($sklad, $tmpsklad2);
$tmpsklad2=array_unique($tmpsklad);
$sklad=implode ("<br>", $tmpsklad2);
}
if (@$out[4]==0) { $bgcolor=" bgcolor=\"#deaaaa\"";} else {$bgcolor=" bgcolor=\"#dedede\"";}
$stock="";
$stockz="";
$sklad=str_replace($art, "<b>$art</b>", @$sklad);
$sklad=str_replace("\$".@$out[5]." ", "<font color=#468847 size=+1><b>\$".@$out[5]."</b></font>^", @$sklad);
$sklad=str_replace("\$".@$out[5].".5 ", "<font color=#468847 size=+1><b>\$".@$out[5].".5</b></font>^", @$sklad);
$sklad=str_replace("\$".(@$out[5]-1).".5 ", "<font color=#468847 size=+1><b>\$".@$out[5].".5</b></font>^", @$sklad);
$kolvosklad=0;
$foundtmp=0;
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$stock="";
} else {
if ($stinfo=="ext") {
$kolvosklad=0;
$tmptok=explode("<br>", $sklad);
$stockz ="наличие уточните у оператора, возможно";
/////////////////////////////////


if ((substr_count($sklad, "^^")==1)&&(substr_count($sklad, "(<b>$art</b>)")>0)) {
reset($tmptok);
while (list ($keytok, $valtok) = each ($tmptok)) {
if ((substr_count($valtok, "(<b>$art</b>)")==1)&&(substr_count($valtok , "^^")==1)) {
$tok2=strtoken($valtok, "^^");

$sklad=str_replace ($valtok, "<font style=\"background-color: #ffdddd\">$valtok</font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^^","",$valtok));
$stockz ="";
$foundtmp=1;
}
}
}



if ((substr_count($sklad, "^^")>=2)&&($foundtmp==0)) {
reset($tmptok);
while (list ($keytok, $valtok) = each ($tmptok)) {
if (@preg_match("/LEO/i",@$out[3].@$out[10])==1) {$tmpcol="лео";}
if (@preg_match("/_BOR/i",@$out[3].@$out[10])==1) {$tmpcol="бор";}
if (@preg_match("/_BL_/i",@$out[3].@$out[10])==1) {$tmpcol="чер";}
if (@preg_match("/_BEJ_/i",@$out[3].@$out[10])==1) {$tmpcol="беж";}
if (@preg_match("/_BR_/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/KOR/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/RED/i",@$out[3].@$out[10])==1) {$tmpcol="кра";}
if (@preg_match("/_RIJ_/i",@$out[3].@$out[10])==1) {$tmpcol="рыж";}
if (@preg_match("/BRONZ/i",@$out[3].@$out[10])==1) {$tmpcol="брон";}
if (@preg_match("/_W/i",@$out[3].@$out[10])==1) {$tmpcol="бел";}
if (@preg_match("/_Y/i",@$out[3].@$out[10])==1) {$tmpcol="жел";}
if (@preg_match("/ZEL/i",@$out[3].@$out[10])==1) {$tmpcol="зел";}
if (@preg_match("/fio/i",@$out[3].@$out[10])==1) {$tmpcol="фио";}
if (@preg_match("/FUK/i",@$out[3].@$out[10])==1) {$tmpcol="фуксия";}
if (@preg_match("/KREM/i",@$out[3].@$out[10])==1) {$tmpcol="крем";}
if (@preg_match("/ROZ/i",@$out[3].@$out[10])==1) {$tmpcol="роз";}
if (@preg_match("/SIR/i",@$out[3].@$out[10])==1) {$tmpcol="сирень";}
if (@preg_match("/SER/i",@$out[3].@$out[10])==1) {$tmpcol="сер";}
if (@preg_match("/BAK/i",@$out[3].@$out[10])==1) {$tmpcol="баклажан";}
if (@preg_match("/GOL/i",@$out[3].@$out[10])==1) {$tmpcol="гол";}
if (@preg_match("/ZOL/i",@$out[3].@$out[10])==1) {$tmpcol="зол";}
if (@preg_match("/SILV/i",@$out[3].@$out[10])==1) {$tmpcol="серебр";}
if (@preg_match("/BRON/i",@$out[3].@$out[10])==1) {$tmpcol="бронз";}
$tok2="";
if ((preg_match("/$tmpcol/i",$valtok)==1)&&(substr_count($valtok , "^^")==1)&&(substr_count($valtok, "(<b>$art</b>)")==1)) {
$tok2=strtoken($valtok, "^^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ffdddd\">$valtok</font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^^","",$valtok));
$stockz ="";
$foundtmp=1;
}

}
}

//поищем еще
if ((substr_count($sklad, "^^")>=2)&&($foundtmp==0)) {
reset($tmptok);
while (list ($keytok, $valtok) = each ($tmptok)) {
if ((substr_count($valtok, "(<b>$art</b>)")==1)&&(substr_count($valtok , "^^")==1)) {
$tok2=strtoken($valtok, "^^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ffdddd\">$valtok</font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^^","",$valtok));
$stockz ="";
$foundtmp=1;
}
}
}

if ((substr_count($sklad, "^^")>=2)&&($foundtmp==0)) {
while (list ($keytok, $valtok) = each ($tmptok)) {
if (@preg_match("/LEO/i",@$out[3].@$out[10])==1) {$tmpcol="лео";}
if (@preg_match("/_BOR/i",@$out[3].@$out[10])==1) {$tmpcol="бор";}
if (@preg_match("/_BL_/i",@$out[3].@$out[10])==1) {$tmpcol="чер";}
if (@preg_match("/_BEJ_/i",@$out[3].@$out[10])==1) {$tmpcol="беж";}
if (@preg_match("/_BR_/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/KOR/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/RED/i",@$out[3].@$out[10])==1) {$tmpcol="кра";}
if (@preg_match("/_RIJ_/i",@$out[3].@$out[10])==1) {$tmpcol="рыж";}
if (@preg_match("/BRONZ/i",@$out[3].@$out[10])==1) {$tmpcol="брон";}
if (@preg_match("/_W/i",@$out[3].@$out[10])==1) {$tmpcol="бел";}
if (@preg_match("/_Y/i",@$out[3].@$out[10])==1) {$tmpcol="жел";}
if (@preg_match("/ZEL/i",@$out[3].@$out[10])==1) {$tmpcol="зел";}
if (@preg_match("/fio/i",@$out[3].@$out[10])==1) {$tmpcol="фио";}
if (@preg_match("/FUK/i",@$out[3].@$out[10])==1) {$tmpcol="фуксия";}
if (@preg_match("/KREM/i",@$out[3].@$out[10])==1) {$tmpcol="крем";}
if (@preg_match("/ROZ/i",@$out[3].@$out[10])==1) {$tmpcol="роз";}
if (@preg_match("/SIR/i",@$out[3].@$out[10])==1) {$tmpcol="сирень";}
if (@preg_match("/SER/i",@$out[3].@$out[10])==1) {$tmpcol="сер";}
if (@preg_match("/BAK/i",@$out[3].@$out[10])==1) {$tmpcol="баклажан";}
if (@preg_match("/GOL/i",@$out[3].@$out[10])==1) {$tmpcol="гол";}
if (@preg_match("/ZOL/i",@$out[3].@$out[10])==1) {$tmpcol="зол";}
if (@preg_match("/SILV/i",@$out[3].@$out[10])==1) {$tmpcol="серебр";}
if (@preg_match("/BRON/i",@$out[3].@$out[10])==1) {$tmpcol="бронз";}
$tok2="";
if ((preg_match("/$tmpcol/i",$valtok)==1)&&(substr_count($valtok , "^^")==1)) {
$tok2=strtoken($valtok, "^^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ffdddd\">$valtok</font> <font color=#b94a48><b>Не совпадает артикул!</b></font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^^","",$valtok));
$stockz ="наличие уточните у оператора, возможно";
$foundtmp=1;
}

}
}



if ((substr_count($sklad, "^^")==1)&&($foundtmp==0)) {
while (list ($keytok, $valtok) = each ($tmptok)) {
$tok2="";
if (substr_count($valtok , "^^")==1) {
$tok2=strtoken($valtok, "^^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ffdddd\">$valtok</font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^^","",$valtok));
$stockz ="наличие уточните у оператора, возможно";
$foundtmp=1;
}
}
}
//давайте ка поишем еще на всякий случай
if ((substr_count($sklad, "(<b>$art</b>)")>0)&&($foundtmp==0)) {
while (list ($keytok, $valtok) = each ($tmptok)) {
if (@preg_match("/LEO/i",@$out[3].@$out[10])==1) {$tmpcol="лео";}
if (@preg_match("/_BOR/i",@$out[3].@$out[10])==1) {$tmpcol="бор";}
if (@preg_match("/_BL_/i",@$out[3].@$out[10])==1) {$tmpcol="чер";}
if (@preg_match("/_BEJ_/i",@$out[3].@$out[10])==1) {$tmpcol="беж";}
if (@preg_match("/_BR_/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/KOR/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/RED/i",@$out[3].@$out[10])==1) {$tmpcol="кра";}
if (@preg_match("/_RIJ_/i",@$out[3].@$out[10])==1) {$tmpcol="рыж";}
if (@preg_match("/BRONZ/i",@$out[3].@$out[10])==1) {$tmpcol="брон";}
if (@preg_match("/_W/i",@$out[3].@$out[10])==1) {$tmpcol="бел";}
if (@preg_match("/_Y/i",@$out[3].@$out[10])==1) {$tmpcol="жел";}
if (@preg_match("/ZEL/i",@$out[3].@$out[10])==1) {$tmpcol="зел";}
if (@preg_match("/fio/i",@$out[3].@$out[10])==1) {$tmpcol="фио";}
if (@preg_match("/FUK/i",@$out[3].@$out[10])==1) {$tmpcol="фуксия";}
if (@preg_match("/KREM/i",@$out[3].@$out[10])==1) {$tmpcol="крем";}
if (@preg_match("/ROZ/i",@$out[3].@$out[10])==1) {$tmpcol="роз";}
if (@preg_match("/SIR/i",@$out[3].@$out[10])==1) {$tmpcol="сирень";}
if (@preg_match("/SER/i",@$out[3].@$out[10])==1) {$tmpcol="сер";}
if (@preg_match("/BAK/i",@$out[3].@$out[10])==1) {$tmpcol="баклажан";}
if (@preg_match("/GOL/i",@$out[3].@$out[10])==1) {$tmpcol="гол";}
if (@preg_match("/ZOL/i",@$out[3].@$out[10])==1) {$tmpcol="зол";}
if (@preg_match("/SILV/i",@$out[3].@$out[10])==1) {$tmpcol="серебр";}
if (@preg_match("/BRON/i",@$out[3].@$out[10])==1) {$tmpcol="бронз";}
$tok2="";
if (preg_match("/$tmpcol/i",$valtok)==1) {
$tok2=strtoken($valtok, "^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ffd57d\">$valtok</font> <font color=#b94a48><b>Не совпадает цена!</b></font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^","",$valtok));
$stockz ="наличие уточните у оператора, возможно";
$foundtmp=1;

}
}
}

//поищем еще кажись не все еще откопали
if ((substr_count($sklad, "(<b>$art</b>)")>0)&&($foundtmp==0)) {
reset($tmptok);
while (list ($keytok, $valtok) = each ($tmptok)) {
if (substr_count($valtok, "(<b>$art</b>)")==1) {
$tok2=strtoken($valtok, "^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ffd57d\">$valtok</font> <font color=#b94a48><b>Не совпадает цена!</b></font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^","",$valtok));
$stockz ="наличие уточните у оператора, возможно";
$foundtmp=1;
}
}
}

//давайте ка поишем еще на всякий случай вдруг цена совпадает а артикул -нет
if ((substr_count($sklad, "^^")>0)&&($foundtmp==0)) {
while (list ($keytok, $valtok) = each ($tmptok)) {
if (@preg_match("/LEO/i",@$out[3].@$out[10])==1) {$tmpcol="лео";}
if (@preg_match("/_BOR/i",@$out[3].@$out[10])==1) {$tmpcol="бор";}
if (@preg_match("/_BL_/i",@$out[3].@$out[10])==1) {$tmpcol="чер";}
if (@preg_match("/_BEJ_/i",@$out[3].@$out[10])==1) {$tmpcol="беж";}
if (@preg_match("/_BR_/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/KOR/i",@$out[3].@$out[10])==1) {$tmpcol="кор";}
if (@preg_match("/RED/i",@$out[3].@$out[10])==1) {$tmpcol="кра";}
if (@preg_match("/_RIJ_/i",@$out[3].@$out[10])==1) {$tmpcol="рыж";}
if (@preg_match("/BRONZ/i",@$out[3].@$out[10])==1) {$tmpcol="брон";}
if (@preg_match("/FUK/i",@$out[3].@$out[10])==1) {$tmpcol="фуксия";}
if (@preg_match("/_W/i",@$out[3].@$out[10])==1) {$tmpcol="бел";}
if (@preg_match("/_Y/i",@$out[3].@$out[10])==1) {$tmpcol="жел";}
if (@preg_match("/ZEL/i",@$out[3].@$out[10])==1) {$tmpcol="зел";}
if (@preg_match("/fio/i",@$out[3].@$out[10])==1) {$tmpcol="фио";}
if (@preg_match("/KREM/i",@$out[3].@$out[10])==1) {$tmpcol="крем";}
if (@preg_match("/ROZ/i",@$out[3].@$out[10])==1) {$tmpcol="роз";}
if (@preg_match("/SIR/i",@$out[3].@$out[10])==1) {$tmpcol="сирень";}
if (@preg_match("/SER/i",@$out[3].@$out[10])==1) {$tmpcol="сер";}
if (@preg_match("/BAK/i",@$out[3].@$out[10])==1) {$tmpcol="баклажан";}
if (@preg_match("/GOL/i",@$out[3].@$out[10])==1) {$tmpcol="гол";}
if (@preg_match("/ZOL/i",@$out[3].@$out[10])==1) {$tmpcol="зол";}
if (@preg_match("/SILV/i",@$out[3].@$out[10])==1) {$tmpcol="серебр";}
if (@preg_match("/BRON/i",@$out[3].@$out[10])==1) {$tmpcol="бронз";}
$tok2="";
if (preg_match("/$tmpcol/i",$valtok)==1) {
$tok2=strtoken($valtok, "^^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ff5dd7\">$valtok</font> <font color=#b94a48><b>Не совпадает артикул!</b></font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^","",$valtok));
$stockz ="наличие уточните у оператора, возможно";
$foundtmp=1;

}
}
}

//поищем еще кажись не все еще откопали вдруг цена совпадает а артикул -нет
if ((substr_count($sklad, "^^")>0)&&($foundtmp==0)) {
reset($tmptok);
while (list ($keytok, $valtok) = each ($tmptok)) {
if (substr_count($valtok, "^^)")==1) {
$tok2=strtoken($valtok, "^^");
$sklad=str_replace ($valtok, "<font style=\"background-color: #ff5dd7\">$valtok</font> <font color=#b94a48><b>Не совпадает артикул!</b></font>", $sklad);
$kolvosklad=doubleval(str_replace("$tok2^","",$valtok));
$stockz ="наличие уточните у оператора, возможно";
$foundtmp=1;
}
}
}




echo "$n. " .$out[3] . " - $kolvosklad шт.<br>\n";
$n+=1;

if (@$out[4]==0) {$kolvosklad=0;}
if (@$out[16]==0) {$kolvosklad=0;}
if (@$out[4]=="") {$kolvosklad=0;}



} else {
$kolvosklad=doubleval(@$out[16]);
}



}


$kolvosklad=doubleval($kolvosklad);
$sklad=str_replace("^"," ", $sklad);
if (substr_count($sklad , "(<b>$art</b>)")==0) {$sklad="<font color=#3a87ad><b>".$lang[211]." Не найдено полное совпадение $art.</b></font><br>".$sklad; }
echo "\n\n$out[16]$kolvosklad\n\n\n\n\n\n";
if ($kolvosklad==0) {
$stock="<img src=\"$image_path/stockno.gif\" border=0> $stockz ".@$lang[621];
}
if ($kolvosklad==1) {
$stock="<img src=\"$image_path/stock1.gif\" border=0> $stockz ".@$lang[622];
}
if (($kolvosklad>=2)&&($kolvosklad<=3)) {
$stock="<img src=\"$image_path/stock1.gif\" border=0> $stockz ".@$lang[623];
}

if (($kolvosklad>=4)&&($kolvosklad<=6)) {
$stock="<img src=\"$image_path/stock3.gif\" border=0> $stockz ".@$lang[624];
}
if (($kolvosklad>=7)&&($kolvosklad<=15)) {
$stock="<img src=\"$image_path/stock5.gif\" border=0> $stockz ".@$lang[625];
}
if ($kolvosklad>=16) {
$stock="<img src=\"$image_path/stock5.gif\" border=0><img src=\"$image_path/stock5.gif\" border=0> $stockz ".@$lang[626];
}
if ($stinfo=="int") {$sklad="$kolvosklad";}


$unifid=md5(@$out[3]." ID:".@$out[6]);

$tmpstmas=explode("<br>", $sklad);
$sklad="";
while (list ($keym, $valm) = each ($tmpstmas)) {
if (@preg_match("/</",$valm)==1) {$sklad.=$valm."<br>";}
}
unset ($tmpstmas, $keym, $valm);
echo "\n";
$files = fopen ("./found/$unifid.txt", "w");
if (!$files) {
echo "<p> Не могу открыть файл <b>./found/$unifid.txt</b> для записи.</p></font>\n";
exit;
}
fputs ($files, $sklad);
fclose ($files);

$files = fopen ("./stock/$unifid.txt", "w");
if (!$files) {
echo "<p> Не могу открыть файл <b>./stock/$unifid.txt</b> для записи.</p></font>\n";
exit;
}
fputs ($files, $stock);
fclose ($files);




$ff+=1;
}
}
}
}
fclose($f);

echo "<p><b>Индексация остатков произведена.</b></p></font>\n";



}

?>
</body></html>
