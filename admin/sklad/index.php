<!DOCTYPE html><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<body>
<font face="verdana" size=2><h4>Stock</h4>
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
require ("../../templates/lang.inc");
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


$df=0;
$ff=0;
$sum=0;
$file="./base.txt";
echo "<table border=0 cellpadding=1>";
$f=fopen($file,"r");

while(!feof($f)) {


$st=fgets($f);

// теперь мы обрабатываем очередную строку $st     |||||||

if ($st!=="") {

$out=explode("|",$st);
if (@$out[5]!="") {
$kkol=doubleval(str_replace("^", "", @$out[4]));
$bgk="";
if ($kkol>50){$kkols="<font size=4>$kkol</font> ".str_replace("^", "", @$out[4])." ";$bgk=" bgcolor=\"#00cc00\"";if ($kkol>100){$kkos="<font size=5>$kkol</font> ".str_replace("^", "", @$out[4])." ";$bgk=" bgcolor=\"#cccc00\"";} if ($kkol>150){$kkols="<font size=6>$kkol</font> ".str_replace("^", "", @$out[4])." "; $bgk=" bgcolor=\"#dd0000\"";}if ($kkol>200){$kkols="<font size=7>$kkol</font> ".str_replace("^", "", @$out[4])." "; $bgk=" bgcolor=\"#dd00dd\"";}} else {$kkols=str_replace("^", "", @$out[4]);}

echo "<tr$bgk><td valign=top><font face=\"verdana\" size=2> ".@$out[0].".</font></td><td valign=top><font face=\"verdana\" size=2> ".@$out[1]."</font></td><td width=250 valign=top><font face=\"verdana\" size=2> ".@$out[2]."</font></td><td width=120 valign=top><font face=\"verdana\" size=2>Арт: <a href=\"$htpath/index.php?query=".@$out[3]."\" target=\"newwindow\">".@$out[3]."</a></font></td><td valign=top><font face=\"verdana\" size=2> ".$kkols."</font></td><td width=40 valign=top><font face=\"verdana\" size=2> $".@$out[5]."</font></td></tr>\n";
$sum+= ($kkol*doubleval(@$out[5]));
$ff+=1;
$df+=1;
if ($df>=100) {$df=0; echo "</table><table border=0 cellpadding=1>";}

}
}
}
fclose($f);

echo "</table>";
echo "<b>".$lang[206]." ".($ff-1)." $lang[207]. $lang[33]: ".$sum."</b>";



?>
</body></html>

