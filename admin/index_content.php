<?php
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
$cury=date("Y", time());
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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
echo "
<!DOCTYPE html><html>
<TITLE>Content Index</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>";
//echo "<meta http-equiv=\"Refresh\" content=\"5; URL=../index.php\">";
echo"
</HEAD>
<body>
";
$fold="..";
require "../modules/functions.php";
require "../templates/$template/css.inc";
echo $css;

function toLower($str) {
$str = strtr($str, "АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЪЫЭЮЯ",
"абвгдеёжзиклмнопрстуфхцчшщьъыэюя");
   return strtolower($str);
}
if (is_dir("./search/tags")==FALSE) { mkdir("./search/tags",0755); }
if (is_dir("./search/kwords")==FALSE) { mkdir("./search/kwords",0755); }
if (is_dir("./search/tags/$speek")==FALSE) { mkdir("./search/tags/$speek",0755); }
if (is_dir("./search/kwords/$speek")==FALSE) { mkdir("./search/kwords/$speek",0755); }
echo "<h4>Search 2.0 (Programming: EuroWebcart)</h4>";
$st=1;
echo "<br><b>Starting indexing content directory for allow search and calculate tags (page summary)</b><br><br><ol class=results>";
$search_db="";
$handle=opendir(".$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..') || ($file == 'config.inc')||(substr($file, -4)==".del")||(substr($file, 0,1)=="s")||(substr($file, 0,1)=="z")||(substr($file, 0,1)=="x")||(substr($file, 0,1)=="y")) {
continue;
} else {
$fp = fopen (".$base_loc/content/$file" , "r");

$all= fread ($fp, filesize(".$base_loc/content/$file"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$line=$out[1];
$all=str_replace("==$line==", "", $all);
} else {
$line = $lang[221];
}
fclose ($fp);
$comm="";
$comm=ExtractString($line,"[comm]","[/comm]");
$line=str_replace("[comm]".$comm."[/comm]", "", $line);
$date_file=date("Y.m.d", filemtime(".$base_loc/content/$file"));
//Минимальная длина слова для индексирования
$min_word_length=3;
//Убираем HTML , переносы и ненужные символы
$all=toLower(strip_tags($all));
$all=trim(str_replace("&nbsp;"," ", $all));
$line2=strip_tags($line);
$line2=trim(str_replace("&nbsp;"," ", $line2));


$not_allowed= Array ("\n" , "\r" , "\t" , "\0" , "\x0B" , "\"", "?", "°", "/", "&", ".", ";", "|", "#", "`", "'" , "^" , "0x36", ",", "<" , ">" , "(", ")", "&nbsp;", "!", ":", ";", "-", "«" , "»", "[", "]");
while (list ($key, $val) = each ($not_allowed)) {
$all=str_replace($val, " " , $all);
$line2=str_replace($val, " " , $line2);
}
unset ($not_allowed);

if (file_exists("../templates/$template/$speek/tag_ignore.inc")==true) {
$not_allowed=file("../templates/$template/$speek/tag_ignore.inc");
while (list ($key, $val) = each ($not_allowed)) {
$all=str_replace(" ".trim($val)." ", " " , $all);
$line2=str_replace(" ".trim($val)." ", " " , $line2);
}
}
unset($key, $val);
$all=toLower($all. " " . $line2);
// считаем теги
//Начинаем индексирование1 - получаем список слов и их кол-во в тексте
$temp_mass=explode(" ", trim(str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ", str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",strip_tags($all)))))))));
$temp2_mass=array_count_values($temp_mass);
natcasesort($temp2_mass);
$temp2_mass=array_reverse($temp2_mass);
unset($temp_mass);  //для экономии памяти
$index_stroke="";
$zz=1;
//var_dump($temp2_mass);
$tag[$file]="";
$tsave[$file]="";
while (list ($key, $val) = each ($temp2_mass)) {

if (strlen($key)>=3){
if ($val>=1){
if (!isset($maxt)) {$maxt=$val;}
$taggy="<font style=\"font-size: ".(8+round(($val+16)/($maxt*$zz)))."pt\"><a href=\"$htpath/index.php?flag=$speek&query=".rawurlencode($key)."\">". $key."</a></font>";
@$tsave[$file].=$taggy." &nbsp; ";
@$ksave[$file].=$key.", ";
$taggy.="<sup>$val</sup> &nbsp; ";
$tag[$file].= $taggy;
}
$zz+=1;
}

if ($zz>=(($maximum_indexed_tags*2)+1)) { break; }

}
unset($temp2_mass, $maxt);
$ftsav="./search/tags/$speek/$file";
$gp=fopen($ftsav, "w");
fputs ($gp,$tsave[$file]);
fclose ($gp);
$ftsav="./search/kwords/$speek/$file";
$gp=fopen($ftsav, "w");
fputs ($gp,$ksave[$file]);
fclose ($gp);

 //для экономии памяти

// Конец экономичной процедуры
/*
// считаем теги
//Начинаем индексирование1 - получаем список слов и их кол-во в тексте
$temp_mass=explode(" ", $all);
$temp2_mass=array_count_values ($temp_mass);
sort($temp2_mass);
unset($temp_mass);  //для экономии памяти
$index_stroke="";
while (list ($key, $val) = each ($temp2_mass)) {
if (strlen($key)>=$min_word_length){
if ($val>1){
$index_stroke.="$key^$val ";
}else {
$index_stroke.="$key ";
}
}
}
unset($temp2_mass);  //для экономии памяти

// Конец экономичной процедуры

*/


// Неэкономичная процедура  (индексная база больше)
//Начинаем индексирование1 - получаем список слов и их кол-во в тексте
$temp2_mass=array_unique(explode(" ", $all));
$index_stroke="";
while (list ($key, $val) = each ($temp2_mass)) {
if (strlen($val)>=$min_word_length){
$index_stroke.="$val ";
}
}
unset($temp2_mass);  //для экономии памяти
// Конец неэкономичной процедуры




//Вычисляем размер файла
$fs=filesize(".$base_loc/content/$file");
if ($fs>=1024): $fsize=round($fs/1024, 2) ." Kb"; endif;
if ($fs<1024): $fsize=$fs ." bytes"; endif;
if ($fs>=1048576): $fsize=round($fs/1048576, 2) ." Mb"; endif;

$raz_mass=explode("." , $file);
$raz=$raz_mass[0];
unset($raz_mass);  //для экономии памяти
echo "<li value=$st>
<div class=\"title\">
<a href=\"$htpath/index.php?flag=$speek&page=".str_replace(".txt","", $file)."\" target=_blank>".strtoken(strtoken(strip_tags($line),"|"),"[")."</a>
</div>
<div class=\"text\">
".substr($index_stroke,0,60)."...</div>
<div class=\"info\">
<span style=\"color: #006600;\"> $file ($fsize) $date_file </span> &#151; <font color=\"#bb0000\">OK</font>
</div>
<div class=\"info\"><nobr><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.$base_loc/content/$raz.txt','$raz','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')></nobr></div>
$tag[$file]
</li>";
$search_db.="$raz > $line > $date_file > $fsize > $index_stroke > \n";
$st+=1;
}
}

closedir ($handle);

$file = fopen ("./search/search_index.$speek", "w");
if (!$file) {
echo "<p> File  <b>./search/search_index.$speek</b> write protect!\n";
exit;
}
fputs ($file, "$search_db");
fclose ($file);

unset ($raz_mass);


echo "</ol>";


//индексация заказов

$st=1;
echo "<br><b>Starting indexing baskets directory for allow search.</b><br><br><ol class=results>";
$search_db="";
$handle=opendir('./baskets/');
while (($file = readdir($handle))!==FALSE) {
If ((substr($file, -5)==".html")&&(substr($file, 0,4)=="$cury")){

$fp = fopen ("./baskets/$file" , "r");

$all= fread ($fp, filesize("./baskets/$file"));
if (preg_match("/<title>(.*)<\/title>/i", $all, $out)) {
$line=$out[1];
} else {
$line = $lang[221];
}
fclose ($fp);
$date_file=date("Y.m.d", filemtime("./baskets/$file"));
//Минимальная длина слова для индексирования
$min_word_length=3;
//Убираем HTML , переносы и ненужные символы
$all=strip_tags($all);
$all=trim($all);
$not_allowed= Array ("\n" , "\r" , "\t" , "\0" , "\x0B" , "\"", "|", "`", "\'" , "^" , "0x36", ",", "<" , ">" , "(", ")", "&nbsp;", "!", ":", ";", "«" , "»");
while (list ($key, $val) = each ($not_allowed)) {
$all=str_replace($val, " " , $all);
}
unset($key, $val);
$all=toLower($all. " " . $line);
/* Экономичная процедура  (индексная база меньше)
//Начинаем индексирование1 - получаем список слов и их кол-во в тексте
$temp_mass=explode(" ", $all);
$temp2_mass=array_count_values ($temp_mass);
unset($temp_mass);  //для экономии памяти
$index_stroke="";
while (list ($key, $val) = each ($temp2_mass)) {
if (strlen($key)>=$min_word_length){
if ($val>1){
$index_stroke.="$key^$val ";
}else {
$index_stroke.="$key ";
}
}
}
unset($temp2_mass);  //для экономии памяти
*/
// Конец экономичной процедуры


// Неэкономичная процедура  (индексная база больше)
//Начинаем индексирование1 - получаем список слов и их кол-во в тексте
$temp2_mass=array_unique(explode(" ", $all));
$index_stroke="";
while (list ($key, $val) = each ($temp2_mass)) {
if (strlen($val)>=$min_word_length){
$index_stroke.="$val ";
}
}
unset($temp2_mass);  //для экономии памяти
// Конец неэкономичной процедуры




//Вычисляем размер файла
$fs=filesize("./baskets/$file");
if ($fs>=1024): $fsize=round($fs/1024, 2) ." Kb"; endif;
if ($fs<1024): $fsize=$fs ." bytes"; endif;
if ($fs>=1048576): $fsize=round($fs/1048576, 2) ." Mb"; endif;

$raz_mass=explode("." , $file);
$raz=$raz_mass[0];
unset($raz_mass);  //для экономии памяти
echo "<li value=$st>
<div class=\"title\">
<A href=\"baskets/$file\" target=_blank>$line</A>
</div>
<div class=\"text\">
".substr($index_stroke,0,60)."...</div>
<div class=\"info\">
<span style=\"color: #006600;\"> $file ($fsize) $date_file </span> &#151; <font color=\"#bb0000\">OK</font>
</div>
</li>";
$search_db.="$raz > $line > $date_file > $fsize > $index_stroke > \n";
$st+=1;
}
}

closedir ($handle);
$file = fopen ("./search/baskets_index.txt", "w");
if (!$file) {
echo "<p> Error writing to <b>./search/baskets_index.txt</b>\n";
exit;
}
fputs ($file, "$search_db");
fclose ($file);







echo "</ol><p><b>Success!</b>";

?>
</body>
</html>
