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

echo "<!DOCTYPE html><html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>Avatara Eva 1.0</title></head><body>";
echo $lang[799].";<br><br>";
$path="./questions/";
$handle=@opendir("$path");
$i=1;
while (($val=@readdir($handle))!==false) {
if (($val==".")||($val=="..")) { continue; } else {
$val=str_replace("_"," ",$val);
echo "$i. <a href=\"#avatara\" onclick=javascript:window.open('ask.php?speek=$speek&ask=".rawurlencode($val)."','avatara_$i','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=550,left=10,top=10')>$val</a> <a href=\"#avatara\" onclick=javascript:window.open('kill.php?speek=$speek&ask=".rawurlencode($val)."','kill','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=200,height=100,left=10,top=10')><b>".$lang[744]."</b></a><br>\n";
$i+=1;
if ($i>100) { echo "MAX 100 files!!!"; exit;}
}
}
closedir($handle);
if ($i==1) {echo "<i>not found</i>";}

?>
</body>
</html>
