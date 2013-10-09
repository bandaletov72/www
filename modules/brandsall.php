<?php
$gghr=0;
$brandslist="";
$brandslist.="<table border=0 width=100% cellpading=10 cellspacing=10>";
$brandnames_file="$base_loc/brands.txt";
if (@file_exists($brandnames_file)==TRUE){
$spis_brandnames=file($brandnames_file);
natcasesort($spis_brandnames);
reset($spis_brandnames);
while (list ($keybnw, $linebnw) = each ($spis_brandnames)) {
$linebnw=trim(str_replace("\n", "", $linebnw));
$url="";
$uurl="index.php?query=".rawurlencode(str_replace("&", " ", str_replace("'", " ",$linebnw)))."&brand=".rawurlencode($linebnw);
if (@file_exists("$base_loc/$linebnw".".url")){
$imfile = fopen ("$base_loc/$linebnw".".url", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$linebnw".".url</b> unable to open.\n";
exit;
}

$url=@fread($imfile, @filesize("$base_loc/$linebnw".".url"));

fclose ($imfile);
unset($imfile);
}
if ($url!="") {$uurl=$url;}
$text="";
if (@file_exists("$base_loc/$linebnw".".text")){
$imfile = fopen ("$base_loc/$linebnw".".text", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$linebnw".".text</b> unable to open.\n";
exit;
}

$text=@fread($imfile, @filesize("$base_loc/$linebnw".".text"));

fclose ($imfile);
unset($imfile);
}
$site="";
if (@file_exists("$base_loc/$linebnw".".site")){
$imfile = fopen ("$base_loc/$linebnw".".site", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$linebnw".".site</b> unable to open.\n";
exit;
}

$site=@fread($imfile, @filesize("$base_loc/$linebnw".".site"));

fclose ($imfile);
unset($imfile);
}

$urla="";
if ($url!="") {$urla="<br><br><b>".$lang[580].":</b> <a href=\"$url\">".$lang['click']."</a>";}
if ($site!="") {$site="<br><br><a href=\"$site\">$site</a>";}
if ($text=="") {$text=$lang[580].": ".$lang[94]."";}

$img="";
if (@file_exists("$base_loc/$linebnw".".img")){
$imfile = fopen ("$base_loc/$linebnw".".img", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$linebnw".".img</b> unable to open.\n";
exit;
}

$img=@fread($imfile, @filesize("$base_loc/$linebnw".".img"));

fclose ($imfile);
unset($imfile);


$ghr="<hr color=$nc2 noshade style=\"border:1px $nc2 dotted\">";
$gghr+=1;
//if ($gghr==1) {$ghr="";}

if (trim($img)=="") {
$brandslist.="<tr><td colspan=2>$ghr</td></tr><tr><td valign=top><div align=center><a href=\"$uurl\" name=\"$linebnw\" title=\"$linebnw\"><h4>$linebnw</h4></a></div></td><td valign=top width=100%><h4>$linebnw</h4>$text$site$urla<br><br><div align=left><b>".$lang['search'].": </b><a href=\"$uurl\" title=\"$linebnw\">$linebnw</a></div></td></tr>\n";

 } else {
$brandslist.="<tr><td colspan=2>$ghr</td></tr><tr><td valign=top><div align=center><a href=\"$uurl\" name=\"$linebnw\" title=\"$linebnw\">$img</a></div></td><td valign=top width=100%><h4>$linebnw</h4>$text$site<br><br><b>".$lang['search'].": </b><a href=\"$uurl\" title=\"$linebnw\">$linebnw</a>$urla</td></tr>\n";
}
} else {

//$brandslist.="<tr><td colspan=2>$ghr</td></tr><tr><td valign=top>&nbsp;<a name=\"$linebnw\"></a></td valign=top width=100%><td><h4>$linebnw</h4>$text$site<br><br><b>".$lang['search'].": </b><a href=\"$uurl\" title=\"$linebnw\">$linebnw</a>$urla</td></tr>\n";
}
}
unset ($spis_brandnames);
}

unset ($url, $text, $site, $img);
$brandslist.="</table>";

?>