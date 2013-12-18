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

echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
";

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
$fold="../..";
require ("../../templates/$template/css.inc");
require ("../../templates/$template/title.inc");

echo $css;
echo "<div class=pcont>";

$left="";
$right="";
$print= "";
$print2= $lang[209];
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
$tosave="<?php\n";
while (list ($key, $val) = each ($raz)) {
$tosave.= "\$raz[".stripslashes($key)."]='".$val."';\n";
}
$tosave.="\n?>";
$file="../.$base_loc/raz.inc";
$fp=fopen($file, "w");
fputs($fp, $tosave);
fclose ($fp);
echo "<h3>$print2</h3>$print</small>";


echo "<p><div align='center'>
<a href=\"./index.php?speek=$speek\">".$lang['back']."</a>
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=./index.php?speek=$speek\">";
?>
</p>
</body>
</html>
