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
echo "<html>\n<head>\n";
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

echo $css;
require("./header.inc");
$st=0;
echo "<form class=form-inline action='rename.php' method='POST'><input type=hidden name=\"speek\" value=\"$speek\"><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='$nc5'><b>".$lang[382]."</b></font><br>";
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
$klon ="<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='$nc5'>&nbsp;&nbsp;<a href='../edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$c.txt'><img src='./edit.gif' border='0' title=\"".$lang[385]."\"></a></font>";
$name="<!--$c--><input type='hidden' name='type[$st]' value='txt'><img src='./folder.gif' border='0' title=\"Раздел\" align=\"absbottom\">&nbsp;<input type='hidden' name='old[$st]' value='$c'><input type='text' name='new[$st]' size='40' value='$c'>&nbsp;$klon&nbsp;&nbsp;<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='$nc5'><a href='../../index.php?page=$c'><b>".strip_tags($line)."</b></a></font>";
} else {
$klon ="<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='$nc5'>&nbsp;&nbsp;<a href='../edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$c.txt'><img src='./edit.gif' border='0' title=\"".$lang[385]."\"></a>&nbsp;&nbsp;<a href='edit.php?speek=".$speek."&amp;c=$c&klon=1'><img src='./new.gif' border='0' title=\"".$lang[384]."\"></a>&nbsp;&nbsp;<a href='unlinkr.php?speek=$speek&file=$c'><img src='./kill.gif' border='0' title=\"".$lang[383]."\"></a></font>";
$name="<!--$c--><input type='hidden' name='type[$st]' value='txt'><img src='./folder.gif' border='0' title=\"Раздел\" align=\"absbottom\">&nbsp;<input type='hidden' name='old[$st]' value='$c'><input type='text' name='new[$st]' size='40' value='$c'>&nbsp;$klon&nbsp;&nbsp;<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='$nc5'><a href='../../index.php?page=$c'><b>$line</b></a></font>";
}
} else {
$klon ="<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='$nc5'>&nbsp;&nbsp;<a href='../edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$c.txt'><img src='./edit.gif' border='0' title=\"".$lang[385]."\"></a>&nbsp;&nbsp;<a href='edit.php?speek=".$speek."&amp;c=$c&amp;del=$c'><img src='./del.gif' border='0' title=\"".$lang[386]."\"></a></font>";
$name = "<!--$c--><a href=#copy onclick=copy('~~$c.txt~~')><img src='./file.gif' border='0' title=\"".$lang[389]." ~~$c.txt~~\" align=\"absbottom\"></a>&nbsp;<input type='hidden' name='type[$st]' value='txt'><input type='hidden' name='old[$st]' value='$c'><input type='text' name='new[$st]' size='40' value='$c'>&nbsp;$klon&nbsp;&nbsp<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='$nc5'><a href='../../index.php?page=$c'><b>$line</b></a></font>";
if (substr($file, -4)==".del"): $klon ="<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='$nc5'>&nbsp;<a href='edit.php?speek=".$speek."&amp;c=$c&rest=$c'><img src='./undel.gif' border='0' title=\"".$lang[387]."\"></a>&nbsp;&nbsp;<a href='unlink.php?speek=$speek&file=$c'><img src='./kill.gif' border='0' title=\"".$lang[383]."\"></a></font>"; $name = "<!--$c--><img src='./deleted.gif' border='0' title=\"".$lang[388]."\" align=\"absbottom\">&nbsp;<input type='hidden' name='type[$st]' value='del'><input type='hidden' name='old[$st]' value='$c'><input type='text' name='new[$st]' size='40' value='$c'>&nbsp;&nbsp;$klon&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<font face='Verdana, Arial, Helvetica, sans-serif' size='1' color='$nc5'>$line <font color='red'>".$lang[388]."!</font></font>"; endif;
}


$files[$st] = "$name\n";
$st += 1;
}
}
closedir ($handle);
//сортировка по алфавиту//
sort ($files);
reset ($files);

while (list ($key, $val) = each ($files)) {
echo "$val<br>\n";
}
echo "<br><br><input type=hidden name=\"speek\" value=\"$speek\"><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[390]."\"><br><br></form>";
require("./footer.inc");
echo "</body>
</html>";
?>
