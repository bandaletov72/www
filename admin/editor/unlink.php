<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><title>DELETING...</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
</head>
<BODY background='new/a1.gif' text='#000000' link='#000000' vlink="#333333" alink="#FF0000">
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

if ((!@$file) || (@$file=="")): $file=""; echo "<center><b>NO FILE NAME!</b><br>"; exit; endif;

echo "<b>DELETING $file</b><br>
<br>OK<br>";

if (!unlink  ("../.$base_loc/content/" . $file . ".del")) {
print ("FILE NOT FOUND!<br>\n");
}

echo "<p><div align='center'>
<a href=\"./index.php?speek=$speek\">BACK</a>
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=./index.php?speek=$speek\">";
?>
</p>
</body>
</html>
