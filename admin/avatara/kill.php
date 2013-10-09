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
echo "<!DOCTYPE html><html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">
<title>Avatara Eva 1.0</title></head><body>";
$filen="./questions/".str_replace(" ", "_", $ask);
if (@file_exists("$filen")) {
unlink($filen);
echo "DELETED";
} else { echo "Not exists!"; }
?>
</body>
</html>
