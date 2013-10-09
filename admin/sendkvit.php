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
//setlocale(LC_ALL,"ru_RU.CP1251");
$_1_2[1]="одна ";
$_1_2[2]="две ";

$_1_19[1]="один ";
$_1_19[2]="два ";
$_1_19[3]="три ";
$_1_19[4]="четыре ";
$_1_19[5]="пять ";
$_1_19[6]="шесть ";
$_1_19[7]="семь ";
$_1_19[8]="восемь ";
$_1_19[9]="девять ";
$_1_19[10]="десять ";

$_1_19[11]="одиннацать ";
$_1_19[12]="двенадцать ";
$_1_19[13]="тринадцать ";
$_1_19[14]="четырнадцать ";
$_1_19[15]="пятнадцать ";
$_1_19[16]="шестнадцать ";
$_1_19[17]="семнадцать ";
$_1_19[18]="восемнадцать ";
$_1_19[19]="девятнадцать ";

$des[2]="двадцать ";
$des[3]="тридцать ";
$des[4]="сорок ";
$des[5]="пятьдесят ";
$des[6]="шестьдесят ";
$des[7]="семьдесят ";
$des[8]="восемдесят ";
$des[9]="девяносто ";

$hang[1]="сто ";
$hang[2]="двести ";
$hang[3]="триста ";
$hang[4]="четыреста ";
$hang[5]="пятьсот ";
$hang[6]="шестьсот ";
$hang[7]="семьсот ";
$hang[8]="восемьсот ";
$hang[9]="девятьсот ";

$namerub[1]="рубль ";
$namerub[2]="рубля ";
$namerub[3]="рублей ";

$nametho[1]="тысяча ";
$nametho[2]="тысячи ";
$nametho[3]="тысяч ";

$namemil[1]="миллион ";
$namemil[2]="миллиона ";
$namemil[3]="миллионов ";

$namemrd[1]="миллиард ";
$namemrd[2]="миллиарда ";
$namemrd[3]="миллиардов ";

$kopeek[1]="копейка ";
$kopeek[2]="копейки ";
$kopeek[3]="копеек ";


function semantic($i,&$words,&$fem,$f){
global $_1_2, $_1_19, $des, $hang, $namerub, $nametho, $namemil, $namemrd;
$words="";
$fl=0;
if($i >= 100){
$jkl = intval($i / 100);
$words.=$hang[$jkl];
$i%=100;
}
if($i >= 20){
$jkl = intval($i / 10);
$words.=$des[$jkl];
$i%=10;
$fl=1;
}
switch($i){
case 1: $fem=1; break;
case 2:
case 3:
case 4: $fem=2; break;
default: $fem=3; break;
}
if( $i ){
if( $i < 3 && $f > 0 ){
if ( $f >= 2 ) {
$words.=$_1_19[$i];
}
else {
$words.=$_1_2[$i];
}
}
else {
$words.=$_1_19[$i];
}
}
}


function num2str($L){
global $_1_2, $_1_19, $des, $hang, $namerub, $nametho, $namemil, $namemrd, $kopeek;

$s=" ";
$s1=" ";
$s2=" ";
$kop=intval( ( $L*100 - intval( $L )*100 ));
$L=intval($L);
if($L>=1000000000){
$many=0;
semantic(intval($L / 1000000000),$s1,$many,3);
$s.=$s1.$namemrd[$many];
$L%=1000000000;
}

if($L >= 1000000){
$many=0;
semantic(intval($L / 1000000),$s1,$many,2);
$s.=$s1.$namemil[$many];
$L%=1000000;
if($L==0){
$s.="рублей ";
}
}

if($L >= 1000){
$many=0;
semantic(intval($L / 1000),$s1,$many,1);
$s.=$s1.$nametho[$many];
$L%=1000;
if($L==0){
$s.="рублей ";
}
}

if($L != 0){
$many=0;
semantic($L,$s1,$many,0);
$s.=$s1.$namerub[$many];
}

if($kop > 0){
$many=0;
semantic($kop,$s1,$many,1);
$s.=$s1.$kopeek[$many];
}
else {
$s.=" 00 копеек";
}

return $s;
}
/*
echo @$kvit;
echo "<br>";
echo @rawurldecode(@$name);
echo "<br>";
echo @rawurldecode(@$adr);
echo "<br>";
echo @$mail;
echo "<br>";
echo @$sum;
echo "<br>";
*/
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

echo "<!DOCTYPE html><html>
<TITLE>SEND</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body>";

function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
//Квитанция СБ
$kv_f="../templates/$template/$speek/ticket.inc";
if (@file_exists($kv_f)==TRUE) {
$fpk=fopen($kv_f, "r");
if (!$fpk) {echo "<br>Файл $kv_f не найден! Квитанция не будет сформирована.<br>";} else {
$kvit_c = fread($fpk, filesize($kv_f));
fclose ($fpk);
$stroketab = ExtractString($kvit_c, "<!--[tr]-->", "<!--[/tr]-->");
$kvit_c=str_replace("[date]" , date("d.m.y", time()), $kvit_c);
$kvit_c=str_replace("[summa]" , "$sum", $kvit_c);
$kvit_c=str_replace("[shopadress]" , "$oficial_adress", $kvit_c);
$kvit_c=str_replace("[sumpropis]" , num2str(doubleval($sum)), $kvit_c);
$kvit_c=str_replace("[shop_tel]" , $telef, $kvit_c);
$kvit_c=str_replace("[shopname]" , $shop_name, $kvit_c);
$kvit_c=str_replace("[kg]" , $kg, $kvit_c);
$kvit_c=str_replace("[poluchatel]" , $lang['poluchatel'], $kvit_c);
$kvit_c=str_replace("[rs]" , $lang['rs'], $kvit_c);
$kvit_c=str_replace("[bank]" , $lang['bank'], $kvit_c);
$kvit_c=str_replace("[bik]" , $lang['bik'], $kvit_c);
$kvit_c=str_replace("[ks]" , $lang['ks'], $kvit_c);
$kvit_c=str_replace("[fio]" , $name, $kvit_c);
$kvit_c=str_replace("[adres]" , $adr, $kvit_c);
$kvit_c=str_replace("[nums]" , "#$kvit", $kvit_c);

$bdf="./baskets/db/$kvit.txt";
if (@file_exists($bdf)==FALSE) {
} else {
require $bdf;
$kvit_c=@str_replace("$stroketab",@$userbd['stroketab'], $kvit_c);
while (list ($re_num, $re_line) = each ($userbd)) {
$kvit_c=str_replace("[".$re_num."]" , $re_line, $kvit_c);
}

}
$kvit_c=str_replace("[valut]" , "$valut", $kvit_c);
unset ($fpk);
$kv_f="../admin/kvit/$kvit.html";
$fpk=fopen($kv_f, "w");
fputs ($fpk, $kvit_c);
fclose ($fpk);
$boundary = uniqid( "");
$emailbody = "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>".$lang[244]." #$kvit)</title>
</head>
<body>
$kvit_c
</body>
</html>";

echo $emailbody;
if ($mail_ticket==1) {
mail ("$mail","Ticket #$kvit From: ". str_replace("http://","",$htpath). " To: $mail", $emailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
}
}
} else {
echo "<br>Файл $kv_f не найден! Квитанция не будет сформирована.<br>";
}
//END квитанция СБ

?>
</body></html>
