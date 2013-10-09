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
if ((!@$view) || (@$view=="") || (@$view=="no")): $view=""; endif;
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
$fold="..";
require ("../templates/$template/css.inc");

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>EDITOR</title><head>";
echo $css;
echo "<script language=javascript>

function resize_textarea(to, id)
{
var orig = 40;
var step = 120;
var textarea = document.getElementById(id);
if (to == 0)
{
var t_height = textarea.style.height.replace('px', '');
if (t_height <= orig) textarea.style.height = orig + 'px';
else
{
var height = parseInt(t_height) - parseInt(step);
textarea.style.height = height + 'px';
}

}
else
{
var t_height = textarea.style.height.replace('px', '');
var height = parseInt(t_height)+parseInt(step);

textarea.style.height = height + 'px';
}
return false;
}
</script>
</head>
<BODY onload=\"javascriprt:self.focus()\" bgcolor=$nc0 link=$nc2 text=$nc5>";

if (!isset($_POST['id'])) { $id=0; } else {$id=$_POST['id'];}
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$create_file) || (@$create_file=="")): $create_file=""; endif;
if ((!@$klon) || (@$klon=="")): $klon=""; endif;
if ((!@$c) || (@$c=="")): $c=""; endif;
if (($klon == "1")&&($c!="")) {




$st=0;
$lt=0;
$listnews[0]=$c."0000";
$handle=opendir("../.$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..') || ($file == 'config.inc')) {
continue;
} else {
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || ((substr($file, 0, 1))!==$c)) {
continue;
} else {
if (strlen($cc)!==1) {
$listnews[$lt]=$cc;
$lt+=1;
}
}
}
}
closedir ($handle);
rsort ($listnews);




$nomer=substr($listnews[0], 1);
settype ($nomer, "integer");
$nomer+=1;

$chars=strlen($nomer);
if ($chars==1): $nomer="000$nomer"; endif;
if ($chars==2): $nomer="00$nomer"; endif;
if ($chars==3): $nomer="0$nomer"; endif;
if ($chars==4): echo "<p>".$lang[429]."\n";exit; endif;
$fp = fopen ("../.$base_loc/content/$c$nomer.txt", "w");
if (!$fp) {
echo "<p>".$lang[44]." <b>../.$base_loc/content/$c$nomer.txt</b> ".$lang[45]."\n";
exit;
}
flock ($fp, LOCK_EX);
if ($c=="a") {
$month=date ("d:m:Y");
fwrite ($fp, "==$month==");
} else {
if ($c=="c") {
$curd=date ("d.m.Y");

fwrite ($fp, "==$curd==");
} else {
fwrite ($fp, "==".$lang[430]." $c$nomer==");
}
}
flock ($fp, LOCK_UN);
fclose ($fp);
echo "<p>".$lang[447]." <b>../.$base_loc/content/$c$nomer.txt</b>.<br><br><br>
<a href='./index.php'>".$lang['back']."</a>\n
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL='edit/index.php?working_file=?speek=$speek&working_file=../.".$base_loc."/content/$c$nomer.txt'\">";
exit;
}







$st=0;
$fcontents = file(".$base_loc/catid.txt");

$allrazdels=$fcontents;
while (list ($line_num, $line) = each ($allrazdels)) {
$out=explode("|",$line);
if (($line!="")&&($line!="\n")) {

$tmpsubrazdels[$st]= @$out[1]. "|" . @$out[2];
$st += 1;
} else {
$tmpsubrazdels[$st]= "|";
$st += 1;
}
}
reset ($tmpsubrazdels);
$tmpsub= array_unique ($tmpsubrazdels);
while (list ($line_num, $line) = each ($tmpsub)) {
$out=explode("|",$line);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
$subr[$ra] .= "$out[1]|";
}

$razdel="";
while (list ($line_num, $line) = each ($subr)) {
$out=explode("|",$line);
while (list ($line_num2, $line2) = each ($out)) {
if ($line2!=""): $razdel .= "<option value='$line_num|$line2'>$line_num / $line2</option>\n"; endif;
}
}
$st=0;
$add_query="";
$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());

$sc=0;

//echo $mysql_query;
//echo $item_id;

$mysql_query="SELECT * FROM $file WHERE (`item_id`='".mysql_real_escape_string(@$item_id)."' AND `unifid`='".mysql_real_escape_string(@$unifid)."') LIMIT 1";

//echo $mysql_query;
$result=mysql_query("$mysql_query");

while($row = mysql_fetch_row($result)) {
$line="";
while(list($k,$v)=each($row)) {

//echo $k."=>".$v."<br>";
if ($k>9) {
$line.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}
}
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
echo "<font size=1 color=$nc2>".$lang[448]." UNIFID=$unifid ITEM_ID=$item_id</font>
<table width=100% cellspacing=0 cellpadding=1>
<tr bgcolor=$nc6>
<td align='left' valign='top'><small><b>".$lang[419]."</b></small></td>
<td align='left' valign='top'><small><b>".$lang['name']."</b></small></td>
<td align='left' valign='top'><small><b>".$lang['price']."</b></small></td>
<td align='left' valign='top'><small><b>".$lang[449]."</b></small></td>
<td align='left' valign='top'><small><b>".$lang[427]."</b></small></td>
    <td align='left' valign='top'><small><b>".$lang[355]."</b></small></td>

    <td align='left' valign='top'><small><b>&nbsp;</b></small></td>
</tr>
<form class=form-inline action='".$scriptprefix."change.php' method='POST' name='form' target='_self'><input type='hidden' name='unifid' value='$unifid'><input type='hidden' name='item_id' value='$item_id'><input type='hidden' name='speek' value='$speek'>
";






$nomer = $out[0];
@$dir=@$out[1];
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
if (($vitrin=="")|($vitrin=="0")) {$vitrin="";}
settype ($price, "double");
$full_descr = str_replace("<br>", chr(10), $full_descr);
$nazv = str_replace("<br>", chr(10), $nazv);
$kwords = str_replace("<br>", chr(10), $kwords);
$description = str_replace("<br>", chr(10), $description);
$foto=$foto1;
$unifid=md5(@$out[3]." ID:".@$out[6]);
echo "
<input type='hidden' name='nomer' value='$nomer'>
<tr bgcolor='$nc6'>
<td align='left' valign='top'><small><input type='text' name='ext_id' size='20' value='$ext_id' style=\"width:100%; font-size: 11px;\" ></small></td>
<td align='left' valign='top'><font style=\"font-size: 10px; font-face: Arial;\">$nazv</font></td>
    <td align='left' valign='top'><small>$price</small></td>
    <td align='left' valign='top'><small><input type=text size='3' name='vitrin' value=\"$vitrin\" style=\"width:100%; font-size: 11px;\" ></small></td>
    <td align='left' valign='top'><small><select size='1' name='onsale' style=\"width:100%; font-size: 11px;\"><option selected value='$onsale'>$onsale</option><option value='1'>".$lang['yes']."</option><option value='0'>".$lang['no']."</option></select></small></td>
    <td align='left' valign='top'><small><input type=\"text\" name='brand_name' value='$brand_name' size=20 style=\"width:100%; font-size: 11px;\"></small></td>


    <td align='left' valign='top'><small><button type=button class=btn title='".$lang[744]."' onclick=\"document.location.href='".$scriptprefix."del.php?speek=".$speek."&unifid=$unifid&item_id=$item_id'\" style=\"margin:0px\"><small><font color=#b94a48>X</font>&nbsp;".$lang[744]."</small></button>
    </td>
    </tr>
    </table>
    <table width=100% cellspacing=0 border=0 cellpadding=2>
<tr>
<td valign='top' width=30%><div style=\"width: auto; border:1px solid #aaaaaa; height: 110px; overflow: auto; display: block;\">";

if ($foto=="") {
echo "<img id=smallimg src=$image_path/pix.gif border=0>";
} else {
$foto=str_replace("<img ","<img id=smallimg ", str_replace("<img src='photos","<img src='$htpath/photos", $foto));
echo $foto;
}
echo "</div></td>
<td align='right' valign='top'>
<table width=100% cellspacing=0 border=0 cellpadding=2>
<tr>
<td align='right' valign='top'><small><b>".$lang['name'].":</b></small></td>
<td align='left' valign='top' colspan='5'><input type='text' name='nazv' size='60' style=\"width:100%; font-size: 11px;\"  value='$nazv'></td>
</tr>
<tr>
<td align='right' valign='top'><small><b>".$lang[430].":</b></small></td>
<td align='left' valign='top' colspan='5'><input type='text' name='dir' size='60' style=\"width:100%; font-size: 11px;\"  value='$dir'></td>
</tr>
<tr>
<td align='right' valign='top'><small><b>".$lang[431].":</b></small></td>
<td align='left' valign='top' colspan='5'><input type='text' name='subdir' size='60' style=\"width:100%; font-size: 11px;\"  value='$subdir'></td>
</tr>
";

//custom card add
$c_filename="../templates/$template/$speek/custom_cart.inc";
$cc_cart="";

$fcontentsac=file(".$base_loc/catid.txt");
while (list ($line_numfc, $linefc) = each ($fcontentsac)) {
$outfc=explode("|",$linefc);
$iindfc=$outfc[1]."|".$outfc[2]."|";
$podstava[$iindfc]=$outfc[0];
}
if (@file_exists($c_filename)==TRUE) {
$custom_cart1=file("../templates/$template/$speek/custom_cart.inc");
if (@file_exists("../templates/$template/$speek/cc_".$podstava["$dir|$subdir|"].".inc")) {
$custom_cart2=file("../templates/$template/$speek/cc_".$podstava["$dir|$subdir|"].".inc");
$custom_cart=Array_merge($custom_cart1,$custom_cart2);
} else {
$custom_cart=$custom_cart1;
}
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")){
$ncc=17+$cc_num;
echo "<tr><td align='right' valign='top'><small><b>".@$ccc[0]."</b>, ".@$ccc[2]."</small></td>
<td align='left' valign='top' colspan='5'><small><input type='text' name='cc[$cc_num]' style=\"width:100%; font-size: 11px;\" size='60' value='".@$out[$ncc]."'></small></td></tr>";
}
}
}
//end


echo "</table></td></tr></table>
<table width=100% border=0 cellpadding=2 cellspacing=0><tr>
<td align='left' valign='top' colspan=2>
<button type=\"button\" class=btn title='".$lang[444]."' onClick=javascript:window.open('newgal.php?speek=$speek&gtype=1','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')><small><font color=#468847>S</font> ".$lang[444]."</button>
</td></tr>
<tr><td align='left' valign='top' colspan=2><small><input type='text' style=\"width:100%; font-size: 11px;\" name='foto1' size='60' value=\"$foto1\"></small></td>
</tr>
<tr>
<td align='left' valign='top'>
<button  type=\"button\" class=btn title='".$lang[445]."' onClick=javascript:window.open('newgal.php?speek=$speek&gtype=2','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')><small><font color=#3a87ad><b>BB</b></font> ".$lang[445]."</small></button>
</td>
<td align='right' valign='top'><script language=\"javascript\">
<!--
function clear() {
document.forms[0].foto2.value=\"\";
}
-->
</script><a href=\"javascript:clear()\"><img align=top src=\"$image_path/forum_del.gif\" border=0 title=\"".$lang[446]."\"></a> <a href=\"#smaller\" onclick=\"resize_textarea(0, 'textarea_foto2');\"><img src=\"$image_path/smaller.png\" border=0 title=\"".$lang[788]."\"></a> <a href=\"#bigger\" onclick=\"resize_textarea(1, 'textarea_foto2');\"><img src=\"$image_path/bigger.png\" border=0 title=\"".$lang[787]."\"></a></td>
<tr><td align='left' width=100% valign='top' colspan=2><textarea id=textarea_foto2 name='foto2' rows='1' style=\"font-size: 11px; font-family: Arial; width:100%; height:40px;\" cols='60'>".str_replace("<br>", chr(10), $foto2)."</textarea>
</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr><td width=50% valign='top'>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align='left' valign='top'><small><b>".$lang['short'].":</b></small></td>
<td align='right' valign='top'><a href=\"#smaller\" onclick=\"resize_textarea(0, 'textarea_desc');\"><img src=\"$image_path/smaller.png\" border=0 title=\"".$lang[788]."\"></a> <a href=\"#bigger\" onclick=\"resize_textarea(1, 'textarea_desc');\"><img src=\"$image_path/bigger.png\" border=0 title=\"".$lang[787]."\"></a></td>
<tr><td align='left' width=100% valign='top' colspan=2><small><textarea rows='3' id=textarea_desc name='description' style=\"font-size: 11px; font-family: Arial; width:100%; height:80px;\" cols='60'>$description</textarea></small></td>
</tr>
</table></td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td width=50% valign='top'>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align='left' valign='top'><small><b>".$lang['description'].":</b></small></td>
<td align='right' valign='top'><a href=\"#smaller\" onclick=\"resize_textarea(0, 'textarea_full');\"><img src=\"$image_path/smaller.png\" border=0 title=\"".$lang[788]."\"></a> <a href=\"#bigger\" onclick=\"resize_textarea(1, 'textarea_full');\"><img src=\"$image_path/bigger.png\" border=0 title=\"".$lang[787]."\"></a></td>
<tr><td align='left' width=100% valign='top' colspan='6'><small><textarea rows='1' name='full_descr' id=textarea_full style=\"font-size: 11px; font-family: Arial; width:100%; height:80px;\" cols='60'>$full_descr</textarea></small></td>
</tr>
</table>
</td></tr></table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align='left' valign='top' colspan=2><small><b>".$lang['artlink'].":</b></small><br><small><input type='text' name='ext_lnk' style=\"width:100%; font-size: 11px;\" size=40 value='$ext_lnk'></small></td>
</tr>
<tr>
<td align='left' valign='top'><small><b>".$lang['kwrds'].":</b></small></td>
<td align='right' valign='top'><a href=\"#smaller\" onclick=\"resize_textarea(0, 'textarea_kwords');\"><img src=\"$image_path/smaller.png\" border=0 title=\"".$lang[788]."\"></a> <a href=\"#bigger\" onclick=\"resize_textarea(1, 'textarea_kwords');\"><img src=\"$image_path/bigger.png\" border=0 title=\"".$lang[787]."\"></a></td>
<tr><td align='left' width=100% valign='top' colspan='6'><small><textarea rows='1' id=textarea_kwords name='kwords' style=\"font-size: 11px; font-family: Arial; width:100%; height:30px;\" cols='60'>$kwords</textarea></small></td>
</tr></table>
<table border=0 cellpadding=0 cellspacing=0>
<tr>
<td align='right' valign='middle'><small><b>".$lang['qty'].":</b></small></td>
<td align='left' valign='bottom'><small><input type='text' name='kolvo' size='3' value='$kolvo' style=\"font-size: 11px;\">
&nbsp;<b>".$lang['148'].":</b> <input type='text' name='opt' size='3' value='$opt'>
&nbsp;<b>".$lang['price'].":</b> <input type='text' name='price' size='3' value='$price' style=\"font-size: 11px;\">
&nbsp;<input type='submit' value='V&nbsp;&nbsp;".$lang['ch']."' name='sumbit' style=\"font-size: 11px;\"></td>
</tr>
</table>
    ";
} else {
echo "<div align=center><font face=verdana>".$lang[434]."<br><br><input type='button' value='OK' name='no' onclick='javascript:self.close()'></font></div>";
}
mysql_close($mysqldb);
?>

<!--end--></form>
</body>
</html>
