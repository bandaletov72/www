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

echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>".$lang[735]."</title>


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
<BODY>";
if ((!@$id) || (@$id==0)): $id=="0"; endif;
if ((!@$id) || (@$id=="")): $id==0; endif;
if ((!@$item) || (@$item=="")): $item="no"; endif;
if ((!@$nazv) || (@$nazv=="")): $nazv=""; endif;



if ($item=="yes") {
settype ($id, "integer");
$st=0;
$fcontents = file(".$base_file");
$tot_gd=count($fcontents);
if ($tot_gd<=1) {echo $lang[436]; exit;}
$good_of_day=$fcontents [$id];
$file = fopen (".$base_loc/good_of_day.txt", "w");
if (!$file) {
echo "<p>".$lang[44]." <b>.$base_loc/good_of_day.txt</b> ".$lang[45]."\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, "$good_of_day");flock ($file, LOCK_UN);
fclose ($file);
echo "<font face=verdana><center><small><b>".$lang[735].": ID=$id</b><br>
<br>$nazv
</small><br><br>
<p><input type='button' value='".$lang[428]."' name='no' onclick='javascript:rc()'></p></font>";
exit;
}

echo "<table width=100% cellpadding=4>
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

echo "<tr bgcolor='#f8f8f8'>
<td align='left' valign='top'><small>$foto1</small></td>
    <td align='left' valign='top'><font face=verdana><center><small>".$lang[735]."</small>
    <table border='0' width='100%' cellpadding='3'>
  <tr>
    <td width='50%' align=right valign=top><form method='POST' target='_self' action='good_of_day.php?speek=".$speek."&id=$id&item=yes&nazv=$nazv'><input type='hidden' value=\"$speek\" name=\"speek\"> <input type='submit' value='".$lang['yes']."' name='yes'></td>
    <td width='50%' valign=top><input type='button' value='".$lang['no']."' name='no' onclick='javascript:self.close()'></form></td></tr>
</table>
<small><div align=left><b>$nazv</b><br>$description</div></small></font></td>
    </tr>
    </table>";

} else {
echo "<div align=center><font face=verdana>".$lang[434]."<br><br><input type='button' value='OK' name='no' onclick='javascript:self.close()'></font></div>";
}


?>
<!--end-->
</body>
</html>

