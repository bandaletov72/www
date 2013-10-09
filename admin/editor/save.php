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
// Document save script//
// $NMH - document body
   $NMH = trim($NMH);
   $NMH= stripslashes($NMH);
   # Также удалить <ТЕГ ..... >
$udali= array ("<SPAN", " class");

for ($i=0; $i<count($udali); $i++) {

while (strpos( $NMH , $udali[$i])) {
$r=strpos( $NMH , $udali[$i]);

$line_b=substr($NMH,0,$r);
$line_is=substr($NMH,$r);
$ry=strpos( $line_is , ">");

$line_e=substr($line_is,++$ry);
$NMH=$line_b.$line_e;   }

}

   $s_file = fopen ("../.$base_loc/content/$c.txt", "w");
   fwrite ($s_file, "$NMH\n");
   fclose ($s_file);
   if (!$s_file) {
   echo "<div align='center'><font face='tahoma' size='2' color='#b94a48'>Файл $c.txt - не сохранен!</font></div>
   <br>";
   }
   else {
   echo "<div align='center'><font face='tahoma' size='2' color='#0000ff'>Файл $c.txt - успешно сохранен!<br>
   <br>

   <a href='./index.php'>Подождите!</a>
   </font></div>
   <meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=./index.php?speek=".$speek."\">";
    }

?>


