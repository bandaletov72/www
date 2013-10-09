<?php
$flaglinks=Array();
//$flaglinks['rus']="http://www.24ok.ru/index.php?action=forum|Techsupport";
$lngv="<table border=0 cellpadding=0 cellspacing=0><tr>";
$image_path="images";$curlan="";
if (count($langs)>1){
while (list ($keyl, $stl) = each ($langs)) {
$bor=" border=0";
if ($stl==$speek) {$bor=" border=0 style=\"border: 2px solid #d2d2d2; background:#d2d2d2;\" "; $curlan="<img src=\"$image_path/flag_".$stl.".png\" border=0 align=absmiddle>";}
$lngv.="<td><a href=\"index.php?flag=$stl\" title=\"$keyl\"><img src=\"$image_path/flag_".$stl.".png\"$bor></a></td><td>&nbsp;</td>";
//echo $stl."==".$_SESSION["user_lang"]."<br>";
if (!isset ($_SESSION["user_lang"])) {} else { if ($stl==$_SESSION["user_lang"]) {require ("./templates/$template/$language/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  $language=$_SESSION["user_lang"];}}
}
}
if (count($flaglinks)>0){
while (list ($keyl, $stl) = each ($flaglinks)) {
$massfl=explode("|", $stl);
$flagl=$massfl[0];
$flagt=@$massfl[1];
$flagi=$keyl;
$lngv.="<td><a href=\"$flagl\" title=\"$flagt\"><img src=\"$image_path/flag_".$flagi.".png\" border=0></a></td><td>&nbsp;</td>";
//echo $stl."==".$_SESSION["user_lang"]."<br>";
}
}
reset($langs);
$lngv.="</tr></table>";
if (count($langs)<=1){ $lngv=""; }
?>
