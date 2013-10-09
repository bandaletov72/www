<!DOCTYPE html><html>
<TITLE>DB Cleaning</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<head>
</HEAD>
<body><font size=2 face=Verdana>
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
if (!isset($del1)) {$del1=0;}
if (!isset($del2)) {$del2=0;}
if (!isset($del3)) {$del3=0;}
if (!isset($del4)) {$del4=0;}
if (!isset($del5)) {$del5=0;}
$fsize=0;
$match="»";
$match2="::";

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
require ("../modules/translit.php"); 
$s=0;

if($del1==1) {
$handle=opendir("../$fotobasesmall/");
$fsize=0;
echo "Составляю список фотографий в папке /$fotobasesmall ... ";
while (($filef = readdir($handle))!==FALSE) {

If (($filef == '.') || ($filef == '..')) {
continue;
} else {
echo "\n";
$ind="/$fotobasesmall/$filef";
$fsize+=(filesize("..$ind")/1024)/1024;
$e[$ind]="/$fotobasesmall/$filef";
$s+=1;
}
}
closedir ($handle);
}

if($del2==1) {
$handle=opendir("../$fotobasebig/");
echo "<b>OK</b><br><br>Составляю список фотографий в папке /$fotobasebig ... ";
while (($filef = readdir($handle))!==FALSE) {

If (($filef == '.') || ($filef == '..')) {
continue;
} else {
echo "\n";
$ind="/$fotobasebig/$filef";
$fsize+=(filesize("..$ind")/1024)/1024;
$e[$ind]="/$fotobasebig/$filef";
$s+=1;
}
}
closedir ($handle);
echo "<b>OK</b><br><br>Найдено <b>$s</b> фотографий.<br>Всего занимают: <b>".((floor($fsize*100))/100)."</b> МБайт<br><br>";
}
$fsize=0;
$s=0;
if($del4==1) {
$handle=opendir('./stat/');
echo "Составляю список файлов статистики в папке /admin/stat ... ";
while (($filef = readdir($handle))!==FALSE) {

If (($filef == '.') || ($filef == '..')) {
continue;
} else {
echo "\n";
$ind=str_replace(".txt", "", "$filef");
$fsize+=(filesize("./stat/$filef")/1024)/1024;
$g[$ind]="./stat/$filef";
$s+=1;
}
}
closedir ($handle);
echo "<b>OK</b><br><br>Найдено <b>$s</b> файлов статистики.<br>Всего занимают: <b>".((floor($fsize*100))/100)."</b> МБайт<br><br>";
}


if($del5==1) {
$fsize=0;
$handle=opendir('./sklad/found/');
echo "Составляю список файлов статистики в папке /admin/sklad/found ... ";
while (($filef = readdir($handle))!==FALSE) {

If (($filef == '.') || ($filef == '..')) {
continue;
} else {
echo "\n";
$ind=str_replace(".txt", "", "$filef");
$fsize+=(filesize("./sklad/found/$filef")/1024)/1024;
$h[$ind]="./sklad/found/$filef";
$s+=1;
}
}
closedir ($handle);
echo "<b>OK</b><br><br>Найдено <b>$s</b> файлов складcкой информации.<br>Всего занимают: <b>".((floor($fsize*100))/100)."</b> МБайт<br><br>";
}



if(($del1==1)||($del2==1)||($del4==1)||($del5==1)) {
if ($del4==0) { if (($del1==1)||($del2==1)) {echo "Составляю список фотографий используемых в БД ... ";}}
$dbindex="";
$fold="..";
$st=0;
$zz=0;
$f=fopen(".$base_file","r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {


$st=fgets($f);
if (($st!="")&&($st!="\n")) {
$outc=explode("|",$st);
$unif=md5(@$outc[3]." ID:".@$outc[6]);
//echo "\n<br>Обрабатываю <b>".$outc[1]," / ".$outc[3]."</b> ... <br>";
if (($del5==1)&&(isset($h[$unif]))) { if (filesize("./sklad/found/$unif.txt")>10000) {$fzz=fopen("./sklad/found/$unif.txt", "w"); fputs($fzz,"Избыточная информация"); fclose($fzz); $zz+=1;}}
$aw113=explode("$htpath", stripslashes(@$outc[10]));
if (($del4==1)||($del5==1)) {    @$price=@$outc[4]; @$onsale=substr(@$outc[12],0,1); if (($onsale=="0")||($onsale=="")||($price==0)||($price=="")||(@$outc[1]==$lang[418])){ } else{  if (isset($g[$unif])) { unset($g[$unif]); if (isset($h[$unif])) {unset($h[$unif]);}}}}
//echo htmlspecialchars("$outc[9] / $outc[10]")."<br>";
$fd=0;
while (list ($nn, $ll) = each ($aw113)) {

$ll=str_replace("'", "", $ll);
$ll=str_replace("\"", "", $ll);
//echo htmlspecialchars($ll);
$aw114=explode(" ", $ll);
$cpath=$aw114[0];
$fil="$cpath";
$fil=str_replace("<img","",$fil);
$fil=str_replace(" src='","",$fil);
$fil=str_replace(" src=\"","",$fil);
$fil=str_replace(" src=","",$fil);
if ($fil!="") {
unset($e[$fil]);
$ff+=1;

echo "\n";
}
}
unset($fil, $aw114, $nn, $ll);
unset($aw113);

$aw113=explode("$htpath", stripslashes(@$outc[9]));
while (list ($nn, $ll) = each ($aw113)) {

$ll=str_replace("'", "", $ll);
$ll=str_replace("\"", "", $ll);
//echo htmlspecialchars($ll);
$aw114=explode(" ", $ll);
$cpath=$aw114[0];
$fil="$cpath";
$fil=str_replace("<img","",$fil);
$fil=str_replace(" src='","",$fil);
$fil=str_replace(" src=\"","",$fil);
$fil=str_replace(" src=","",$fil);
if ($fil!="") {
unset($e[$fil]);
$ff+=1;

echo "\n";
}
}

unset($fil, $aw114, $nn, $ll);
unset($aw113);

}
}
fclose($f);
if ($del4==1) { echo "Найдено <b>".count(@$g)."</b> файлов, не используемых в БД<br>";}
if ($del5==1) { echo "Найдено <b>".count(@$h)."</b> складских файлов, не используемых в БД и $zz избыточных файлов размером более 10К (удалены) <br>";}
if (($del1==1)||($del2==1)) {echo "Найдено <b>".count(@$e)."</b> фотографий, не используемых в БД<br>";}
echo "<br>Удаление <b>".(count(@$g)+count(@$e))."</b> файлов ... ";
$s=1;
$fsize=0;
while (list ($nn, $ll) = @each ($e)) {
$fsize+=(filesize("..$ll")/1024)/1024;
unlink("..$ll");
$s+=1;
}
if ($del4==1) {
while (list ($nn, $ll) = @each ($g)) {
$fsize+=(filesize("$ll")/1024)/1024;
unlink("$ll");
$s+=1;
}
}

echo "<b>OK</b><br><br>";
}


if($del3==1) {
echo "Очистка больших фотографий у товаров, находящихся в '".$lang[418]."' ... ";
//Архивные фото
$dbindex="";
$fold="..";
$st=0;
$f=fopen(".$base_file","r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {


$st=fgets($f);
if (($st!="")&&($st!="\n")) {
$outc=explode("|",$st);

echo "\n";
if (@$outc[1]==$lang[418]) {
$aw113=explode("$htpath", stripslashes(@$outc[10]));

while (list ($nn, $ll) = each ($aw113)) {
//echo htmlspecialchars($ll);
$ll=str_replace("'", "", $ll);
$ll=str_replace("\"", "", $ll);
$aw114=explode(" ", $ll);
$cpath=$aw114[0];
$fil="$cpath";
$fil=str_replace("<img","",$fil);
$fil=str_replace(" src='","",$fil);
$fil=str_replace(" src=\"","",$fil);
$fil=str_replace(" src=","",$fil);
if ($fil!="") {


echo "\n";
if (@file_exists("..$cpath")==TRUE) {
$fsize+=(filesize("..$cpath")/1024)/1024;
@unlink ("..$cpath");
}
}
$outc[10]="";

}

unset($cpath, $aw114);


unset($aw113);
}
$dbindex.=implode("|", $outc);
}
}
fclose($f);

$fp=fopen(".$base_file","w"); flock ($fp, LOCK_EX);
fputs($fp, "$dbindex"); flock ($fp, LOCK_UN);
fclose ($fp);

//echo "$noveltys_tosave";
echo "<b>OK</b><br><br>";
}
//echo "$noveltys_tosave";
if (($del1==1)||($del2==1)||($del3==1)||($del4==1)||($del5==1)) {echo "Очистка от неиспользуемых файлов завершена! Освобождено: <b>".((floor($fsize*100))/100)."</b> МБайт<br><br><pre></pre>";} else {
echo "<p><font face=\"Verdana\"><b><span lang=\"ru\"><font size=\"2\">Освобождение свободного места</font></b></span></font></p>
<form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\">
	<p><font face=\"Verdana\"><input type=\"checkbox\" name=\"del1\" value=\"1\"><span lang=\"ru\"><font size=\"2\">
	Удаление неиспользуемых в БД маленьких фотографий (папка </font></span>
	<font size=\"2\"><b>/$fotobasesmall</b>)</font></font></p>
	<p><font face=\"Verdana\"><input type=\"checkbox\" name=\"del2\" value=\"1\"></font><font size=\"2\" face=\"Verdana\"> <span lang=\"ru\">
	Удаление неиспользуемых в БД больших фотографий (</span>папка <b>/$fotobasebig</b>)</font></p>
	<p><font face=\"Verdana\"><input type=\"checkbox\" name=\"del3\" value=\"1\"></font><span lang=\"ru\"><font size=\"2\" face=\"Verdana\">
	Удаление больших фотографий товаров находящихся в БД в разделе <b>".$lang[418]."</b>
	с изменением соотв. полей БД</font></span></p>
    <p><font face=\"Verdana\"><input type=\"checkbox\" name=\"del4\" value=\"1\"></font><span lang=\"ru\"><font size=\"2\" face=\"Verdana\">
	Удаление статистики удаленных товаров и товаров, находящихся в '".$lang[418]."', папка <b>/admin/stat</b>
	с изменением соотв. полей БД</font></span></p>
    <p><font face=\"Verdana\"><input type=\"checkbox\" name=\"del5\" value=\"1\"></font><span lang=\"ru\"><font size=\"2\" face=\"Verdana\">
	Удаление избыточной складской информации удаленных товаров и товаров, находящихся в '".$lang[418]."', папка <b>/admin/sklad/found</b>
	с изменением соотв. полей БД</font></span></p>
	<p><font face=\"Verdana\"><span lang=\"ru\"><b><font size=\"2\">".$lang[211]."</font></b><font size=\"2\">
	Процедура необратима! Если Вы уверены в Ваших действиях нажмите кнопку OK</font></b></span></font></p>
	<p align=\"center\"><font face=\"Verdana\"><input type=\"submit\" class=\"btn btn-primary\" value=\"   OK   \"></font></p>
</form>";

}

?>
</font></body>
</html>
