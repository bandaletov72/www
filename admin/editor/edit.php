<!DOCTYPE html><html>
<head>

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

if ((!@$create_file) || (@$create_file=="")): $create_file=""; endif;
if (@file_exists("../.$base_loc/content/$create_file.txt")==FALSE) {
if ($create_file != "") {
$fp = fopen ("../.$base_loc/content/$create_file.txt", "w");
if (!$fp) {
echo "<p>".$lang[44]." <b>../.$base_loc/content/$create_file.txt</b> ".$lang[45]."\n";
exit;
}
flock ($fp, LOCK_EX);

fwrite ($fp, "==$create_file==");
flock ($fp, LOCK_UN);
fclose ($fp);
echo "<p>".$lang[447]." <b>../.$base_loc/content/$create_file.txt</b>.<br><br><br>
<a href='./index.php'>".$lang['back']."</a>\n
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL='../edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/$create_file.txt'\">";
exit;
}
} else {
echo "<p>File  <b>../.$base_loc/content/$create_file.txt</b> already exists.<br><br><br>
<a href='./index.php'>".$lang['back']."</a>\n
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL='../edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/$create_file.txt'\">";
exit;
}

if ((!@$c) || (@$c=="")): echo "Empty var c=???"; $exit; endif;
if ((!@$klon) || (@$klon=="")): $klon=""; endif;
if ((!@$del) || (@$del=="")): $del=""; endif;
if ((!@$rest) || (@$rest=="")): $rest=""; endif;

if ($klon == "1") {




$st=0;
$lt=0;
$listnews[0]=$c."0000";
$handle=opendir("../.$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..') || ($file == 'config.inc')) {
continue;
} else {
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || ((substr($file, 0, 1))!==$c)) {
continue;
} else {
if (strlen($cc)!==1) {
$listnews[$lt]=$cc;
$lt+=1;
}
}
}
}
closedir ($handle);

rsort ($listnews);





$nomer=substr($listnews[0], 1);
settype ($nomer, "integer");
$nomer+=1;


$chars=strlen($nomer);
if ($chars==1): $nomer="000$nomer"; endif;
if ($chars==2): $nomer="00$nomer"; endif;
if ($chars==3): $nomer="0$nomer"; endif;
if ($chars==4): echo "<p>Max subcategories is: <b>9999</b>. Call script authors.\n";exit; endif;

$fp = fopen ("../.$base_loc/content/$c$nomer.txt", "w");
if (!$fp) {
echo "<p>Error opening for write <b>../.$base_loc/content/$c$nomer.txt</b>.\n";
exit;
}
if ($c=="a") {
$month=date ("d.m.Y");
fwrite ($fp, "==$month==");
} else {
if ($c=="c") {
$curd=date ("d.m.Y");

fwrite ($fp, "==$curd==");
} else {
fwrite ($fp, "==$c$nomer==");
}
}
fclose ($fp);
echo "<p>Success create <b>../.$base_loc/content/$c$nomer.txt</b>.<br><br><br>
<a href='./index.php?speek=".$speek."'>".$lang['back']."</a>\n
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL='../edit/index.php?speek=".$speek."&working_file=../.".$base_loc."/content/$c$nomer.txt'\">";
exit;
}


if ($del != "") {
@unlink ("../.$base_loc/content/$del.del");
if (!file_exists("../.$base_loc/content/$del.txt")) {



echo  "Error deleting file \"../.$base_loc/content/$del.txt\"! File not exist!";

} else {
@rename ("../.$base_loc/content/$del.txt", "../.$base_loc/content/$del.del");
echo "<p>Delete file: <b>../.$base_loc/content/$del.txt'</b>.<br>You may restore it<br><meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=./index.php?speek=".$speek."\">";
}
echo "<br><a href=\"./index.php?speek=".$speek."\">".$lang['back']."</a>\n";
exit;
}


if ($rest != "") {
rename ("../.$base_loc/content/$rest.del", "../.$base_loc/content/$rest.txt");
echo "<p>File restore: <b>../.$base_loc/content/$rest.txt'</b>.<br>You may edit it<br><br><a href=\"./index.php?speek=".$speek."\">".$lang['back']."</a>\n
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL='../edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/$rest.txt'\">";
exit;
}
echo "<p><div align='center'>
<a href=\"./index.php?speek=$speek\">".$lang['back']."</a>
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=./index.php?speek=$speek\">";
?>
</p>
</body>
</html>

























