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
//setlocale(LC_ALL,"ru_RU.CP1251");
$viewpage_title="";
// default headers ***********
@Header("HTTP/1.0 200 OK");
@Header("HTTP/1.1 200 OK");
@Header("Content-type: text/html");
@Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
@Header("Last-Modified: ".gmdate("D, M d Y H:i:s",(time()-14400))." GMT");
@Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@Header("Pragma: no-cache"); // HTTP/1.0
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
//распакуем базу если файл с базой не найден
echo "<!DOCTYPE html><html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>Avatara Eva 1.0</title></head><body>";

if (!is_dir("./base")) {
if (!file_exists("./base.zip")) {
echo $lang[789];
echo $lang[790];
mkdir("./base", 0755);
} else {
require_once "./zip.php";
$archive = new PclZip('base.zip');
if ($archive->extract() == 0) { die("Error : ".$archive->errorInfo(true));}
else {echo('Ok!');}
}
} else {
echo $lang[791]."<br><br>
<b>".$lang[792]."</b>";

echo "<li><a href=unpack.php>".$lang[793]."</a></li>
<li><a href=unpack_with_replace.php>".$lang[794]."</a></li>";

echo "<li><a href=pack.php>".$lang[795]."</a></li>";



}

echo "<table width=100% height=100% border=0><tr><td align=center><img src=\"$image_path/eve.jpg\" border=0><br><br>";

echo "<div align=center><form class=form-inline action=\"ask.php\" method=\"POST\">
".$lang[796].": <input type=\"text\" size=64 name=\"ask\" value=\"\">? <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[797]."\">
</form></div>";

echo "</td></tr></table>";

?>
<script>
if(self.parent.frames.length!=0)self.parent.location=document.location;else{var t=document.forms[0].ask;t.focus()}
</script>
</body>
</html>