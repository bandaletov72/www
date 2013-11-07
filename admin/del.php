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
require ("../templates/$template/css.inc");
require ("../modules/translit.php");
echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>".$lang[439]."</title>
";
echo $css;
echo "

<SCRIPT language='JavaScript1.1'>
<!--

function rc() {
window.opener.location.reload();
self.close();

}
//-->
</SCRIPT></head>
<BODY onload=\"javascript:self.focus()\">";
if ((!@$id) || (@$id==0)): $id=="0"; endif;
if ((!@$id) || (@$id=="")): $id==0; endif;
if ((!@$del) || (@$del=="")): $del="no"; endif;
if ((!@$nazv) || (@$nazv=="")): $nazv=""; endif;



if ($del=="yes") {
settype ($id, "integer");
$fcontents = file(".$base_file");
$out=explode("|",$fcontents [$id]);
$catid=translit(@$out[1]." ".@$out[2]." ");
$catid2=translit(@$out[1]);
if (trim($fcontents[$id])=="") { echo "<div class=\"mr ml\" align=center><br><h1>$lang[202]</h1><br><br><div align=center><input type='button' class=\"btn btn-large btn-primary\" value='".$lang[428]."' name='no' onclick='javascript:rc()'></div></div>"; exit; }
$fcontents [$id] = "\n";

$html = implode ("", $fcontents);
$file = fopen (".$base_file", "w");
if (!$file) {
echo "<p>".$lang[44]." <b>.$base_file</b> ".$lang[45]."\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, "$html");flock ($file, LOCK_UN);
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
if ((trim($val)!="")&&(trim($out[0])!="")){
if ((@$out[0]==$catid)||(@$out[0]==$catid2)) {
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
echo "<div class=\"mr ml\"><br><b>".$lang[437]." ID=$id</b><br>
<br>$nazv
<br><br><b>".$lang[438]."</b><br><br>
<div align=center><input type='button' class=\"btn btn-large btn-primary\" value='".$lang[428]."' name='no' onclick='javascript:rc()'></div></div>";
exit;
}

echo "<table border=0 class=table2 style='width:96%' cellpadding=4>
";

$sc=0;
$st=0;
$fcontents = file(".$base_file");

$line = @$fcontents[$id];
$out=explode("|",$line);
$nomer = $out[0];
@$dir=@$out[1];
if ($dir!="") {$sc=1;}
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);
@$brand_name=@$out[13];
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
@$kolvo=@$out[16];


if ($sc>0)  {
$foto1=str_replace("<img ","<img id=smallimg ", str_replace("src='photos","src='$htpath/photos", $foto1));

echo "<tr>
<td align='left' valign='top'>$foto1</td>
    <td align='left' valign='top'><font face=verdana><center><div class=\"alert alert-error\">".$lang[439]."</div>
    <table border=0 cellpadding='3'>
  <tr>
    <td width='50%' align=center valign=top><form method='POST' target='_self' action='del.php?speek=".$speek."&id=$id&amp;del=yes&nazv=$nazv'><input type='hidden' value=\"$speek\" name=\"speek\"> <input class='btn btn-primary btn-large' type='submit' value='".$lang['yes']."' name='yes'></td>
    <td width='50%' valign=top align=center><input class=\"btn btn-large\" type='button' value='".$lang['no']."' name='no' onclick='javascript:self.close()'></form></td></tr>

  <tr><td colspan=2 align=center><div align=center><form method='POST' target='_self' action='del_archive.php?id=$id&amp;del=yes'><input type='hidden' value=\"$speek\" name=\"speek\"> <input class='btn btn-warning btn-large' type='submit' value='".$lang[418]."' name='yes'></small></form></div></td></tr>
</table>
<div align=center><b>$nazv</b><br></div></font></td>
    </tr>
    </table>";

} else {
echo "<div align=center><font face=verdana>".$lang[434]."<br><br><input class='btn btn-primary btn-large' type='button' value='OK' name='no' onclick='javascript:self.close()'></font></div>";
}


?>
<!--end-->
</body>
</html>

