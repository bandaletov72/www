<!DOCTYPE html><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Avatara Eva - PACK BASE</title></head><body>
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
echo "PACK ZIP...<br>\n";
require_once "./zip.php";
$archive = new PclZip('base.zip');
if ($archive->create('base/') == 0) { die("Error : ".$archive->errorInfo(true));}
else {echo('Ok!');}
?>
</body></html>
