<?php
$gghr=0;
$brandslist="";
if ($view_brands_inlist==1) {
if (($brandtype==1)||($brandtype==3)) {$brzag="";}
$brandslist="<div align=center class=box5><br>$brzag<div align=center>";
if (($brandtype==1)||($brandtype==3)){$brt="<br><br>";} else{$brt="  ";}
$brandnames_file="$base_loc/brands.txt";
if (@file_exists($brandnames_file)==TRUE){
$spis_brandnames=file($brandnames_file);
natcasesort($spis_brandnames);
reset($spis_brandnames);
while (list ($keybnw, $linebnw) = each ($spis_brandnames)) {
$linebnw=trim(str_replace("\n", "", $linebnw));
if (@file_exists("$base_loc/$linebnw".".chk")==TRUE) {

$uurl="index.php?query=".rawurlencode(str_replace("&", " ", str_replace("'", " ",$linebnw)))."&brand=".rawurlencode($linebnw);
$urlsi="";
if (@file_exists("$base_loc/$linebnw".".url")){
$imfile = fopen ("$base_loc/$linebnw".".url", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$linebnw".".url</b> unable to open.\n";
exit;
}

$urlsi=@fread($imfile, @filesize("$base_loc/$linebnw".".url"));

fclose ($imfile);
unset($imfile);
}
if ($urlsi!="") {$uurl=$urlsi;}
$imgi="";
if (@file_exists("$base_loc/$linebnw".".img")){
$imfile = fopen ("$base_loc/$linebnw".".img", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$linebnw".".img</b> unable to open.\n";
exit;
}

$imgi=str_replace("<img ", "<img align=\"middle\" ", @fread($imfile, @filesize("$base_loc/$linebnw".".img")));

fclose ($imfile);
unset($imfile);
$ghr="<hr color=$nc2 noshade size=1>";
$gghr+=1;
//if ($gghr==1) {$ghr="";}
if (trim($imgi)=="") {
$brandslist.="<font size=3><span class=lnk><a href=\"$htpath/index.php?action=allbrands#$linebnw\" title=\"$linebnw\">$linebnw</a></span></font>$brt\n";

 } else {
$brandslist.="<a href=\"$htpath/index.php?action=allbrands#$linebnw\" title=\"$linebnw\">".$imgi."</a>$brt\n";
}
} else {
$brandslist.="<font size=3><span class=lnk><a href=\"$htpath/index.php?action=allbrands#$linebnw\" title=\"$linebnw\">$linebnw</a></span></font>$brt\n";
}
}
}
unset ($spis_brandnames);
}

unset ($uurl, $urlsi, $imgi);
$brandslist.="<br><b class=lnk><a href=\"$htpath/index.php?action=allbrands\">".$lang[422]."</a></b></div></div><br>";
}
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="view_brands_inlist";$strnum=132; $oldvalue=$$oldval;
if ($view_brands_inlist==0) {
$brandslist.="<div align=center><font color=#b94a48>".$lang[355]." ".$lang[894]."</font></div>";
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}
$brandslist.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center><b>$lang[355]</b> <input type=button onclick=javascript:location.href='"."index.php?action=brandimg&mod=admin"."' value=\"".$lang[868]."\">&nbsp;
$modonoff
<br><br>".$lang[888]."<br><br>".$lang[880]."</div>"; endif;
}

?>
