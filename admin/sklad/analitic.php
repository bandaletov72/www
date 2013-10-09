<!DOCTYPE html><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<!--meta http-equiv="Refresh" content="0; URL=index.php"-->
</head>
<body>

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

echo "<font face=verdana><p><b>Аналитика витрины интернет-магазина.</b></p></font>";


//остатки

$df=0;
$ff=0;
$sum=0;
$file="../.$base_file";
echo "<font face=verdana><p><b>Аналитика интернет-магазина.</b></p></font>";


//остатки
echo "<table border=0 cellpadding=1 cellspacing=0 width=100%>";
echo "<tr bgcolor=\"#dedede\"><td valign=top align=center><font face=\"verdana\" size=2><b>Товар в магазине</b></font></td><td width=100 valign=top align=center><font face=\"verdana\" size=2> <small><b>назв. / арт </b></small></font></td><td width=100 valign=top align=center><font face=\"verdana\" size=2> <small><b>опт / розн</b></small></font></td><td valign=top align=center><font face=\"verdana\" size=2><b>найдено на центральном складе:</b></font></td></tr>\n";

$f=fopen($file,"r");

while(!feof($f)) {


$st=fgets($f);

// теперь мы обрабатываем очередную строку $st     |||||||

if ($st!=="") {

$out=explode("|",$st);
$art=@preg_replace("([\D]+)", "", preg_replace('/\(([0-9]{1,4})\)/', '$1',  str_replace("-","", @$out[3])));

$unifid=md5(@$out[3]." ID:".@$out[6]);
$fname="./found/$unifid.txt";
$files = fopen ($fname, "r");
if (!$files) {
$sklad="<font color=#b94a48 size=+1>Не могу открыть файл <b>./found/$unifid.txt</b> !</font><br>\n";
} else {
$sklad= fread ($files, filesize ($fname));
}
fclose ($files);

$fname="./stock/$unifid.txt";
$files = fopen ($fname, "r");
if (!$files) {
$stock="<font color=#b94a48 size=+1>Не могу открыть файл <b>./stock/$unifid.txt</b> !</font><br>\n";
} else {
$stock= fread ($files, filesize ($fname));
}
fclose ($files);


if ((@$out[4]==0)||(@$out[16]==0)||(@$out[4]=="")) {} else {
$bgcolor=" bgcolor=#ffffff";
$sort=8;
if (@preg_match("/един/i",@$stock)==1){$sort=5; }
if (@preg_match("/очень мало/i",@$stock)==1){$sort=6; }
if (@preg_match("/огран/i",@$stock)==1){$sort=7; }
if (@preg_match("/возможно/i",@$stock)==1){$sort=4; }
if (substr_count(@$stock, "img")>1) {$sort=9; }
if (@preg_match("/Внимание!/i",@$sklad)==1){$bgcolor=" bgcolor=#ffdd99"; $sort=3; }
if (@preg_match("/цена!/i",@$sklad)==1){$bgcolor=" bgcolor=#ff9999"; $sort=2; }
if (@preg_match("/нет в наличии/i",@$stock)==1){$bgcolor=" bgcolor=#999999"; $sort=1; }

$mass[$ff]= "<!-- $sort --><tr$bgcolor><td valign=top><font face=\"verdana\" size=2> <a href=\"$htpath/index.php?unifid=$unifid\" target=\"_blank\">".@$out[3].".</a></font></td><td width=100 valign=top><font face=\"verdana\" size=2> <small><b>назв: </b>".$art."<br><b>арт: </b>".@$out[6]."</small></font></td><td width=100 valign=top><font face=\"verdana\" size=2> <small><b>опт: </b>".@$out[5]."<br><b>розн: </b>".@$out[4]."</small></font></td><td valign=top><font face=\"verdana\" size=2><small>$stock<br>".$sklad."</small></font></td></tr><tr><td colspan=4><hr></td></tr>\n";
}





$ff+=1;



}
}
fclose($f);
sort($mass);
$df=1;
while (list ($keytok, $valtok) = each ($mass)) {
echo  $valtok;
$df+=1;
if ($df>=100) {$df=0; echo "</table><table border=0 cellpadding=1 cellspacing=0 width=100%>";}
}
echo "</table>";





?>
</body></html>

