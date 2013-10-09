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

echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>LANGUAGE TEMPLATE</title>


<head>";
require ("../templates/$template/css.inc");
echo $css;
echo "</head>
<BODY><table border=1>";
while (list ($key, $val) = each ($lang)) {
echo "<tr><td>$key =&gt;</td><!-- td>\"".str_replace("<","&lt;", str_replace(">", "&gt;", $val))."\",</td --></tr>";
}
echo "</table>";
?>
</body>
</html>

