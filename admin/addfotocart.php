<?php
set_time_limit(0);
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");$fold="..";
require ("../templates/$template/css.inc");
echo "<!DOCTYPE html><html>
<TITLE>ADMIN</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>";
echo $css;
echo "</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
<small> ";
require("../templates/$template/for_replace.inc");

if ((!@$pbrand) || (@$pbrand=="")): $pbrand=""; endif;
if ((!@$part) || (@$part=="")): $part=""; endif;
if ((!@$pcvet) || (@$pcvet=="")): $pcvet=""; endif;
if ((!@$popt) || (@$popt=="")): $popt=""; endif;
if ((!@$prozn) || (@$prozn=="")): $prozn=""; endif;
if ((!@$psklad) || (@$psklad=="")): $psklad="10"; endif;
if ((!@$pstati) || (@$pstati=="")): $pstati=""; endif;
if ((!@$razz) || (@$razz=="")): $razz="Новинки"; endif;
if ((!@$prazm) || (@$prazm=="")): $prazm=""; endif;
if ((!@$pdop) || (@$pdop=="")): $pdop=""; endif;
if ((!@$kws) || (@$kws=="")): $kws=""; endif;
if ((!@$kw1) || (@$kw1=="")): $kw1=""; endif;
if ((!@$kw2) || (@$kw2=="")): $kw2=""; endif;
if ((!@$podrazz) || (@$podrazz=="")): $podrazz=date("d-m-Y"); endif;
if ($prazm!==""): if (preg_match("/\ /i", $prazm)) {$prazm="<br><b>Размеры:</b> $prazm<br>";} else {$prazm="<br><b>Размер:</b> $prazm см (ДxВxШ)<br>";} endif;
if ($pdop!==""){
$rdop="<br><b>".$lang[28].":</b><br>";
while (list ($keyr, $str) = each ($razarr)) {
$pdop=str_replace("$keyr", "$str", $pdop);
}
$pdop=$rdop.$pdop;
}
//Формат базы:
//00170|Майки|Длинные|Женская сумка Akvorioli 3071 BL|120|78|3071|Цвет: Черный<br>Материал: Натуральная кожа (Италия)||<img src='http://192.168.19.46/$fotobasesmall/3071.jpg' border=0>|<img src='http://192.168.19.46/$fotobasebig/3071.jpg' border=0>|0|1|Akvorioli|||10|

if($hidart==1) {$delete_stock_price=1;}

$tf1=explode (".",substr($file, -6));
$ftype=@$tf1[1];
$tf=explode ("_",$file);
$tovt=strtoken(@$tf[6],".");
//echo "../$fotobasesmall/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$roznica."_".@$tf[4]."_".@$tf[5]."_".$tovt."."."$ftype";

$malfoto="<img src='$htpath/".$fotobasesmall."/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt."."."$ftype' border=0>";
$file=@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt."."."$ftype";
if ($delete_stock_price==1) {
if (file_exists("../$fotobasesmall/$file")==TRUE) {
@rename ("../$fotobasesmall/$file", "../$fotobasesmall/".md5(@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".@$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt)."."."$ftype");
$file=md5(@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt)."."."$ftype";
}

if (file_exists("../$fotobasesmall/$file")) {
} else {
echo "Этот товар уже был создан, либо фотография удалена."; exit;
}
$malfoto="<img src='$htpath/".$fotobasesmall."/".md5(@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt)."."."$ftype' border=0>";
}


$bigfoto="";
$file=@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt."."."$ftype";
if (file_exists("../$fotobasebig/$file")==TRUE) {
$bigfoto="<img src='$htpath/".$fotobasebig."/$file' border=0>";
}

if ($delete_stock_price==1) {
@rename ("../$fotobasebig/$file", "../$fotobasebig/".md5(@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt)."."."$ftype");
$file=md5(@$tf[0]."_".@$tf[1]."_".@$tf[2]."_".$tf[3]."_".@$tf[4]."_".@$tf[5]."_".$tovt)."."."$ftype";
$bigfoto="<img src='$htpath/".$fotobasebig."/$file' border=0>";
}


if ($delete_stock_price==1) {
$mdd=md5(@$tf[0]."_".@$tf[1]."_".@$tf[2]);
}else {
$mdd=@$tf[0]."_".@$tf[1]."_".@$tf[2];
}
if ($ftype!="") {
 echo "../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."."."$ftype";
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."."."$ftype", "../$fotobasebig/".$mdd."."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd.".$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."1."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."1."."$ftype", "../$fotobasebig/".$mdd."1."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."1.$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."2."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."2."."$ftype", "../$fotobasebig/".$mdd."2."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."2.$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."3."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."3."."$ftype", "../$fotobasebig/".$mdd."3."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."3.$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."4."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."4."."$ftype", "../$fotobasebig/".$mdd."4."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."4.$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."5."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."5."."$ftype", "../$fotobasebig/".$mdd."5."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."5.$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."6."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."6."."$ftype", "../$fotobasebig/".$mdd."6."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."6.$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."7."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."7."."$ftype", "../$fotobasebig/".$mdd."7."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."7.$ftype' border=0>";
}
if (file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."8."."$ftype")==TRUE) {
if ($delete_stock_price==1) {
@rename ("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."8."."$ftype", "../$fotobasebig/".$mdd."8."."$ftype");
}
$bigfoto.="<br><img src='$htpath/".$fotobasebig."/".$mdd."8.$ftype' border=0>";
}
}

if ($delete_stock_price==1) { $tov=$tov."* ";}
$str="00000|$razz|$podrazz|".$tov."$part|$prozn|$popt|$part|".$kw1."$pcvet".$kw2."$prazm$pdop|$kws|$malfoto|$bigfoto|0|1|$pbrand|$pstati||$psklad|\n";
$files=fopen(".$base_file", "a");
if (!$files) {echo "Немогу записать в файл .$base_file"; exit;}
flock ($files, LOCK_EX); fputs ($files, "$str");flock ($files, LOCK_UN);
fclose ($files);

echo "Малая фотография:<br>
$malfoto<br>
Раздел: <b>$razz</b><br>
Подраздел: <b>$podrazz</b><br>
".$lang['file'].": <b>$tov$part</b><br>
Брэнд: <b>".$pbrand."</b><br>
Арт.: <b>".$part."</b><br>
Цвет: <b>".$pcvet."</b><br>
$pdop<br>$prazm<br>
Опт: <b>".$popt."</b><br>
Розн.: <b>".$prozn."</b><br>
$bigfoto<br>
<br>
Товар добавлен в <b>$razz/$podrazz</b>!";

echo "</small>";
?>
</body>
</html>
