<!DOCTYPE html><html>
<head>
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

echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>".$lang[442]."</title>
<head>";
require ("../templates/$template/css.inc");
echo $css;
echo "</head>
<SCRIPT language='JavaScript1.1'>
<!--

function rc() {
window.opener.location.reload();
self.close();

}
//-->
</SCRIPT>
<BODY bgcolor=$nc0 link=$nc2 text=$nc5>";

if ((!@$del) || (@$del=="")): $del="no"; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$sub) || (@$sub=="")): $sub=""; endif;


if ($del=="yes") {
echo "<font face=verdana><center><small>".$lang[442]." <b>$r/$sub</b> ...</small><br>";
$file=".$base_file";
$now = $speek."_".date("Y_m_d__H_i_s");
if(!copy(".$base_file", "./backup/" . $now . ".bak")) {
print ("Ошибка копирования файла $now.bak !<br>\n");
}

$f=fopen($file,"r");

$tf=0;
$ff=0;
$base="";
while(!feof($f)) {
$st=str_replace("\n", "", fgets($f));
//int_code0|dir1|subdir2|name3|price4|opt5|ext_code6|descr7|keywords8|icon9|photo10|vitrina11|onsale12|brand13|attachment14|fulldescr15|stock16|
// теперь мы обрабатываем очередную строку $st
$st=trim($st);
$out=explode("|",$st);
if (@$out[0]!="") {
if (($out[1]==$r)&&($out[2]==$sub)) {
echo "\n";

} else {
$base.=$st."\n";
}
}
}
fclose ($f);
$f=fopen($file,"w");
flock ($f, LOCK_EX); fputs ($f, "$base"); flock ($f, LOCK_UN);

echo "<br><b>".$lang[209]."</b>
<br><br>
<p><input type='button' value='".$lang[428]."' name='no' onclick='javascript:rc()'></p></font>";
exit;
} else {

echo "<font face=verdana><small><center>".$lang[442]." <b>$r/$sub</b></small><br><br><font color=#b94a48><b>".$lang[443]."</b></font><br><br>
<table border='0' width='100%' cellpadding='3'>
  <tr>
    <td width='50%' align=right valign=top><form method='POST' target='_self' action='del_subdir.php?speek=".$speek."&amp;del=yes&r=".rawurlencode($r)."&sub=".rawurlencode($sub)."'><input type='hidden' value=\"$speek\" name=\"speek\"> <input type='submit' value='".$lang['yes']."' name='yes'></td>
    <td width='50%' valign=top><input type='button' value='".$lang['no']."' name='no' onclick='javascript:self.close()'></form></td></tr>
</table>
</font>";

}


?>
<!--end-->
</body>
</html>

