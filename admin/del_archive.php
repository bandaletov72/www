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
echo "
<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>DEL</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
<SCRIPT language=\"JavaScript1.1\">
<!--

function rc() {
  window.opener.location.reload();
  self.close();

}
//-->
</SCRIPT>
</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">

";
if ((!@$id) || (@$id==0)): $id=="0"; endif;
if ((!@$id) || (@$id=="")): $id==0; endif;
if ((!@$del) || (@$del=="")): $del="no"; endif;
if ((!@$nazv) || (@$nazv=="")): $nazv="no name"; endif;



if ($del=="yes") {
settype ($id, "integer");
$st=0;
$fcontents = file(".$base_file");
$tot_gd=count($fcontents);
if ($tot_gd<=1) {echo "Последний товар не буду удалять!!!"; exit;}
$line=@$fcontents[$id];
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
$out[4]="0";
$out[1]=$lang[418];

$fcontents[$id]=implode("|",$out);

$html = implode ("", $fcontents);
$file = fopen (".$base_file", "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> Не могу открыть файл <b>.$base_file</b> для записи.\n";
exit;
}
fputs ($file, "$html");flock ($file, LOCK_UN);
fclose ($file);
echo "<div align=center><font face=verdana>Товар перенесен в ".$lang[418].".<br><br><input type='button' value='OK' name='no' onclick='javascript:self.close()'></font></div>";
} else {
echo "<div align=center><font face=verdana>Товар с данным id не найден.<br><br><input type='button' value='OK' name='no' onclick='javascript:self.close()'></font></div>";

}
}

?>
<!--end-->
</body>
</html>

