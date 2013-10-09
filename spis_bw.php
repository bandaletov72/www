<!DOCTYPE html><html><head></head><body>
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
$fold="."; require ("./templates/lang.inc");
$badwords_file="./templates/$template/bad_words.inc";
if (@file_exists($badwords_file)==TRUE){
$spis_badwords=file($badwords_file);
while (list ($keybw, $linebw) = each ($spis_badwords)) {
echo $linebw. "\n<br>";
}
}

?>
</body></html>
