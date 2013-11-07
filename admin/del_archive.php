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
require ("../templates/$template/css.inc");
require ("../modules/translit.php");
echo "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>ARCHIVE</title>
$css
<SCRIPT language='JavaScript1.1'>
<!--

function rc() {
window.opener.location.reload();
self.close();

}
//-->
</SCRIPT>
</head>
<BODY onload=\"javascript:self.focus()\"><br><div class=\"mr ml\">

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
$line=@$fcontents[$id];
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
$catid=translit($out[1]." ".$out[2]." ");
$out[4]="0";
$out[1]=$lang[418];
$catid2=translit($out[1]);
$fcontents[$id]=implode("|",$out);

$html = implode ("", $fcontents);
$file = fopen (".$base_file", "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> Error writing to file <b>.$base_file</b>\n";
exit;
}
fputs ($file, "$html");flock ($file, LOCK_UN);
fclose ($file);

unset ($fcontents, $html, $file, $out);

if ($admin_speedup==1) {
$fcontents = file(".$base_loc/items/$catid.txt");
while(list($key,$val)=each($fcontents)) {
$out=explode("|", $val);
if ($out[0]==$id) {
unset($fcontents[$key]);
}
unset($out);
}
$html = implode ("", $fcontents);
if (trim($html)=="") {
unset( $fcontents);
unlink (".$base_loc/items/$catid.txt");
$fcontents = file(".$base_loc/catid.txt");
$foundd=0;
$founds=0;
while (list ($key,$val)=each ($fcontents)) {

$out=explode("|",$val);
if ((trim($line)!="")&&(trim($line)!="\n")&&(trim($out[0])!="")){
if (($out[0]==$catid)||($out[0]==$catid2)) {
unset($fcontents[$key]);
}
}
}
$fp = fopen (".$base_loc/catid.txt", "w");
fputs ($fp, implode("",$fcontents));
fclose($fp);
} else {
$file = fopen (".$base_loc/items/$catid.txt", "w");
if (!$file) {
echo "<p>".$lang[44]." <b>.$base_loc/items/$catid.txt</b> ".$lang[45]."\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, "$html");flock ($file, LOCK_UN);
fclose ($file);
unset ($fcontents, $html, $file);


}
}

echo "<div align=center><font face=verdana>$lang[209]<br><br><input type='button' class=\"btn btn-primary btn-large\" value='OK' name='no' onclick='javascript:rc()'></font></div>";
} else {
echo "<div align=center><font face=verdana>$lang[434]<br><br><input class=\"btn btn-primary btn-large\" type='button' value='OK' name='no' onclick='javascript:self.close()'></font></div>";

}
}

?>
<!--end-->
</div>
</body>
</html>

