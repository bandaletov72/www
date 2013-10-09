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




if ((!@$file) || (@$file=="")): $file=""; echo "File Not found!"; endif;
if ($file!="") {
if (file_exists(".".$file.".txt")==TRUE){
$fp = fopen (".$file.txt" , "r");
$content = @fread($fp, @filesize(".$file.txt"));
fclose($fp);
echo "<!DOCTYPE html><html><body>".$content."</body></html>";
} else {
echo "File Not found!";
}
}
?>

