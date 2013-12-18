<?php
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
echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
";
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
$fold="../..";
require ("../../templates/$template/css.inc");
require ("../../templates/$template/title.inc");
if (file_exists("../.$base_loc/raz.inc")){
require ("../.$base_loc/raz.inc");
}
echo $css;
echo "<div class=pcont>";
require("./header.inc");
$st=0;
echo "<form class=form-inline action='rename.php' method='POST'><input type=hidden name=\"speek\" value=\"$speek\"><h3 class=ml>".$lang[382]."</h3>";
$handle=opendir("../.$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..') || ($file == 'config.inc')|| (substr($file,0,2) == 'z_')) {
continue;
} else {
$fp = fopen ("../.$base_loc/content/$file" , "r");

$all= fread ($fp, filesize("../.$base_loc/content/$file"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$line=$out[1];
} else {
$line = $lang[221];
}
$line=substr(strtoken(strip_tags($line),"|"), 0 , 100);
fclose ($fp);
$out=explode(".",$file);
$c = $out[0];
if (strlen($c)==1) {
if ($c=="z") {
$klon ="<a class=btn href='../edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$c.txt'><b class=icon-edit title=\"".$lang[385]."\"></b></a><td>&nbsp;</td><td>&nbsp;</td>";
$name="<!--$c--><tr class=\"info panel\"><td><input type='hidden' name='type[$st]' value='txt'><img src='./folder.gif' border='0' title=\"Раздел\" align=\"absbottom\"></td><td><input type='text' class=input-mini name=\"raz['".$c."']\" size='5' value='".@$raz[$c]."'></td><td><input type='hidden' name='old[$st]' value='$c'><input class=input-mini type='text' name='new[$st]' size='40' value='$c'></td><td>$klon</td><td width=100%><a href='../../index.php?page=$c'><b>".strtoken(strip_tags($line),"[")."</b></a></td></tr>";
} else {
$klon ="<a class=btn href='../edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$c.txt'><b class=icon-edit title=\"".$lang[385]."\"></b></a></td><td><a href='edit.php?speek=".$speek."&amp;c=$c&klon=1' class=btn><b class=icon-chevron-down title=\"".$lang[384]."\"></b></a></td><td><a class=btn href='edit.php?speek=".$speek."&amp;c=$c&amp;del=$c'><b class=icon-remove title=\"".$lang[386]."\"></b></a>";
$name="<!--$c--><tr class=\"info panel\"><td><input type='hidden' name='type[$st]' value='txt'><img src='./folder.gif' border='0' title=\"Раздел\" align=\"absbottom\"></td><td><input type='text' class=input-mini name=\"raz['".$c."']\" size='5' value='".@$raz[$c]."'></td><td><input type='hidden' name='old[$st]' value='$c'><input class=input-mini type='text' name='new[$st]' size='40' value='$c'></td><td>$klon</td><td width=100%><a href='../../index.php?page=$c'><b>".strtoken(strip_tags($line),"[")."</b></a></td></tr>";
if (substr($file, -4)==".del") {
$klon ="<a class=\"btn btn-danger\" href='edit.php?speek=".$speek."&amp;c=$c&rest=$c'><b class=\"icon-share-alt icon-white\" title=\"".$lang[387]."\"></b></a></td><td>&nbsp;</td><td><a class=btn href='unlink.php?speek=$speek&file=$c'><b class=icon-remove title=\"".$lang[383]."\"></b></a>";
$name = "<!--$c--><tr class=error><td><img src='./deleted.gif' border='0' title=\"".$lang[388]."\" align=\"absbottom\"></td><td><input type='text' class=input-mini name=\"raz['".$c."']\" size='5' value='".@$raz[$c]."'></td><td class=error><input type='hidden' name='type[$st]' value='del'><input type='hidden' name='old[$st]' value='$c'><input class=input-mini type='text' name='new[$st]' size='40' value='$c'></td><td>$klon</td><td width=100%>$line <b class=\"label label-important\">".$lang[388]."</b></td></tr>";
}

}
} else {
$klon ="<a class=btn href='../edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$c.txt'><b class=icon-edit title=\"".$lang[385]."\"></b></a></td><td>&nbsp;</td><td><a class=btn href='edit.php?speek=".$speek."&amp;c=$c&amp;del=$c'><b class=icon-remove title=\"".$lang[386]."\"></b></a>";
$name = "<!--$c--><tr><td><a href=#copy onclick=copy('~~$c.txt~~')><img src='./file.gif' border='0' title=\"".$lang[389]." ~~$c.txt~~\" align=\"absbottom\"></a></td><td><input type='text' class=input-mini name=\"raz['".$c."']\" size='5' value='".@$raz[$c]."'></td><td><input type='hidden' name='type[$st]' value='txt'><input type='hidden' name='old[$st]' value='$c'><input type='text' class=input-mini name='new[$st]' size='40' value='$c'></td><td>$klon</td><td><a href='../../index.php?page=$c'><b>".strtoken(strip_tags($line),"[")."</b></a></td></tr>";
if (substr($file, -4)==".del") {
$klon ="<a class=\"btn btn-danger\" href='edit.php?speek=".$speek."&amp;c=$c&rest=$c'><b class=\"icon-share-alt icon-white\" title=\"".$lang[387]."\"></b></a></td><td>&nbsp;</td><td><a class=btn href='unlink.php?speek=$speek&file=$c'><b class=icon-remove title=\"".$lang[383]."\"></b></a>";
$name = "<!--$c--><tr class=error><td><img src='./deleted.gif' border='0' title=\"".$lang[388]."\" align=\"absbottom\"></td><td><input type='text' class=input-mini name=\"raz['".$c."']\" size='5' value='".@$raz[$c]."'></td><td class=error><input type='hidden' name='type[$st]' value='del'><input type='hidden' name='old[$st]' value='$c'><input class=input-mini type='text' name='new[$st]' size='40' value='$c'></td><td>$klon</td><td width=100%>".strtoken(strip_tags($line),"[")." <b class=\"label label-important\">".$lang[388]."</b></td></tr>";
}
}


$files[$st] = "$name\n";
$st += 1;
}
}
closedir ($handle);
//сортировка по алфавиту//
sort ($files);
reset ($files);
echo "<small class=ml>".$lang[686]."</small>
<table class=\"table table-striped mr ml\" style=\"width:96%;\"><tbody>
<tr><td>&nbsp;</td><td><small>".$lang[687]."</small></td><td><small>".$lang[430]."</small></td><td><small>".$lang['edits']."</small></td><td><small>".$lang['add']."</small></td><td><small>".$lang[386]."</small></td><td>&nbsp;</td></tr>
";
while (list ($key, $val) = each ($files)) {
echo "$val\n";
}
echo "</tbody></table>";
echo "<div class=\"mr ml\" align=center><input type=hidden name=\"speek\" value=\"$speek\"><input type=\"submit\" class=\"btn btn-large btn-primary\" value=\"".$lang[527]."\"></div></form>";
require("./footer.inc");
echo "</div></body>
</html>";
?>
