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
$_1_2[1]="���� ";
$_1_2[2]="��� ";

$_1_19[1]="���� ";
$_1_19[2]="��� ";
$_1_19[3]="��� ";
$_1_19[4]="������ ";
$_1_19[5]="���� ";
$_1_19[6]="����� ";
$_1_19[7]="���� ";
$_1_19[8]="������ ";
$_1_19[9]="������ ";
$_1_19[10]="������ ";

$_1_19[11]="���������� ";
$_1_19[12]="���������� ";
$_1_19[13]="���������� ";
$_1_19[14]="������������ ";
$_1_19[15]="���������� ";
$_1_19[16]="����������� ";
$_1_19[17]="���������� ";
$_1_19[18]="������������ ";
$_1_19[19]="������������ ";

$des[2]="�������� ";
$des[3]="�������� ";
$des[4]="����� ";
$des[5]="��������� ";
$des[6]="���������� ";
$des[7]="��������� ";
$des[8]="���������� ";
$des[9]="��������� ";

$hang[1]="��� ";
$hang[2]="������ ";
$hang[3]="������ ";
$hang[4]="��������� ";
$hang[5]="������� ";
$hang[6]="�������� ";
$hang[7]="������� ";
$hang[8]="��������� ";
$hang[9]="��������� ";

$namerub[1]="����� ";
$namerub[2]="����� ";
$namerub[3]="������ ";

$nametho[1]="������ ";
$nametho[2]="������ ";
$nametho[3]="����� ";

$namemil[1]="������� ";
$namemil[2]="�������� ";
$namemil[3]="��������� ";

$namemrd[1]="�������� ";
$namemrd[2]="��������� ";
$namemrd[3]="���������� ";

$kopeek[1]="������� ";
$kopeek[2]="������� ";
$kopeek[3]="������ ";


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
$s.="������ ";
}
}

if($L >= 1000){
$many=0;
semantic(intval($L / 1000),$s1,$many,1);
$s.=$s1.$nametho[$many];
$L%=1000;
if($L==0){
$s.="������ ";
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
$s.=" 00 ������";
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
//��������� ��
$kv_f="../templates/$template/$speek/ticket.inc";
if (@file_exists($kv_f)==TRUE) {
$fpk=fopen($kv_f, "r");
if (!$fpk) {echo "<br>���� $kv_f �� ������! ��������� �� ����� ������������.<br>";} else {
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
echo "<br>���� $kv_f �� ������! ��������� �� ����� ������������.<br>";
}
//END ��������� ��

?>
</body></html>
