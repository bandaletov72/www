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
echo "
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>Rename</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
</head>
<BODY background='new/a1.gif' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">

";

$left="";
$right="";
$print= "";
$print2= "Nothing to rename";
echo "<center><small>";
while (list ($key, $val) = each ($old)) {
if ($val!==$new[$key]) {
if (!rename  ("../.$base_loc/content/" . $val . "." . $type[$key] , "../.$base_loc/content/" . $val . ".tmp")) {
$print .= "$val." . $type[$key] ." -&gt; ".$val. ".tmp! - Error file name<br>\n";
}
}
}

reset($old);
reset($new);
reset($type);
while (list ($key, $val) = each ($old)) {
if ($val!==$new[$key]) {
if (!rename  ("../.$base_loc/content/" . $val . ".tmp" , "../.$base_loc/content/" . $new[$key]. "." . $type[$key])) {
$print .= "$val.tmp -&gt; ".$new[$key]. "." . $type[$key] ."! File already exists? <br>\n";
} else {
$print2= "";
$print .="$val." . $type[$key] ." -&gt; ".$new[$key]. "." . $type[$key] . "<br>\n";
}
}
}

echo "$print2<br>$print</small>";


echo "<p><div align='center'>
<a href=\"./index.php?speek=$speek\">Back</a>
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=./index.php?speek=$speek\">";
?>
</p>
</body>
</html>
