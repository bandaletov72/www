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


 @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");

require ("../templates/$template/$speek/vars.txt");
require ("../templates/$template/css.inc");
require ("../modules/translit.php");
echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>".$lang[439]."</title>


<head>";
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
if ((!@$id) || (@$id==0)): $id=="0"; endif;
if ((!@$id) || (@$id=="")): $id==0; endif;
if ((!@$del) || (@$del=="")): $del="no"; endif;
if ((!@$nazv) || (@$nazv=="")): $nazv=""; endif;



if ($del=="yes") {
$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());

if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());

mysql_select_db("$mysql_db_name");

$st=0;


$mysql_query="DELETE FROM $file WHERE `item_id`='".mysql_real_escape_string(@$item_id)."' AND `unifid`='".mysql_real_escape_string(@$unifid)."' LIMIT 1";
echo $mysql_query;

$result=mysql_query("$mysql_query");
if (mysql_errno()) die( mysql_error());
mysql_close($mysqldb);




echo "<hr><font face=verdana><center><br><br><b>".$lang[438]."</b><br><br>
<p><input type='button' value='".$lang[428]."' name='no' onclick='javascript:rc()'></p></font>";
exit;

}
//echo "<small><b>UNIFID:</b> $unifid<br><b>ITEM_ID:</b> $item_id<br>";
echo "<table width=100% cellpadding=4 cellspacing=0 border=0>
";

$sc=0;
$st=0;
$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());

if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());

mysql_select_db("$mysql_db_name");


$st=0;


$mysql_query="SELECT * FROM $file WHERE (`item_id`='".mysql_real_escape_string(@$item_id)."' AND `unifid`='".mysql_real_escape_string(@$unifid)."') LIMIT 1";
//echo $mysql_query;

$result=mysql_query("$mysql_query");
if (mysql_errno()) die( mysql_error());
while($row = mysql_fetch_row($result)) {
$line="";
while(list($k,$v)=each($row)) {

//echo $k."=>".$v."<br>";
if ($k>9) {
$line.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}
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
$sc=1;
}
if ($sc>0)  {

echo "<tr bgcolor='".lighter($nc6,10)."'>
<td align='left' valign='top'><div style=\"width: 150px; height: 180px; overflow: auto; display: block;\">".str_replace("<img src='ph","<img src='$htpath/ph", $foto1)."</div></td>
    <td align='left' valign='top'><font face=verdana><center><small>".$lang[439]."</small>
    <table border='0' width='100%' cellpadding='3'>
  <tr>
    <td width='50%' align=right valign=top><form method='POST' target='_self' action='".$scriptprefix."del.php?speek=".$speek."&unifid=$unifid&item_id=$item_id&del=yes&nazv=".rawurlencode($nazv)."'><input type='hidden' value=\"$speek\" name=\"speek\"> <input type='submit' value='".$lang['yes']."' name='yes'></td>
    <td width='50%' valign=top><input type='button' value='".$lang['no']."' name='no' onclick='javascript:self.close()'></form></td></tr><tr><td colspan=2 align=center><form method='POST' target='_self' action='".$scriptprefix."del_archive.php?unifid=$unifid&item_id=$item_id&del=yes'><input type='hidden' value=\"$speek\" name=\"speek\"> <input type='submit' value='".$lang[418]."' name='yes'></small></form></td></tr>
</table>
<small><div align=left><b>$nazv</b><br><div style=\"width: 100%; border:1px solid #aaaaaa; height: 80px; overflow: auto; display: block;\">$description</div>/div></small></font></td>
    </tr>
    </table>";

} else {
echo "<div align=center><font face=verdana>".$lang[434]."<br><br><input type='button' value='OK' name='no' onclick='javascript:rc()'></font></div>";
}
mysql_close($mysqldb);

?>
<!--end-->
</body>
</html>

