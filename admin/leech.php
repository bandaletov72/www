<?php
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ");
   return strtolower($str);
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
<TITLE>RESTORE DB FROM MINI DB</TITLE>
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

require "../modules/functions.php";
require "../templates/$template/css.inc";

//echo $css;
$ddb="";
$handle=opendir(".$base_loc/items/");
while (($file = readdir($handle))!==FALSE) {
echo "\n";
If (substr($file, -4)!=".txt") {
continue;
} else {
echo "$file<br>\n";
$ddb.=implode("",file(".$base_loc/items/$file"));


}
}

closedir ($handle);
$file=".$base_file";
$f=fopen($file,"w");
fputs($f,$ddb);
fclose ($f);
//ñîðòèðîâêà ïî àëôàâèòó//

?>
</body>
</html>
