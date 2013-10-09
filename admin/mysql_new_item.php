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
//echo $codepage;
require ("../modules/translit.php");
if (!isset($catid)) {$catid="";}
if ((!@$clone) || (@$clone=="")): $clone="no"; endif;
$fcontentsy = @file(".$base_loc/catid.txt");
@natcasesort($fcontentsy);
@reset($fcontentsy);
$st=0;
$catid="";
while (list ($line_numy, $liney) = @each ($fcontentsy)) {
$outs=explode("|",$liney);
$indx=$outs[0];
$pods[$indx]=$outs[0];
}
echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>".$lang[875]."</title><head>";
require ("../templates/$template/css.inc");
echo $css;
echo "</head>
<SCRIPT language='JavaScript1.1'>
<!--

function rc() {
  ";

if ($clone=="no") {
  echo "window.opener.location.reload();";
  }

if ($clone=="yes") {echo "window.opener.location.href='$htpath/index.php?catid=".translit(@$dir." ".@$subdir." ")."';";
}
  echo "
  self.close();

}
//-->
</SCRIPT>
<BODY bgcolor=$nc0 link=$nc2 text=$nc5>";
$back="<br><br><input type=button value=\"".$lang['back']."\" onclick=\"javascript:history.back()
\"></div>";


if ($clone=="yes") {
if ((!@$dir) || (@$dir=="")): echo "<br><div align=center>".$lang[70]." ".$lang[430]."!$back"; exit; endif;
if ((!@$subdir) || (@$subdir=="")): echo "<br><div align=center>".$lang[70]." ".$lang[431]."!$back"; exit; endif;
if ((!@$nazv) || (@$nazv=="")): echo "<br><div align=center>".$lang[70]." ".$lang['name']."!$back"; exit; endif;
if ((!@$ext_id) || (@$ext_id=="")): echo "<br><div align=center>".$lang[70]." ".$lang[419]."!$back"; exit; endif;
if ((!@$price) || (@$price=="")): $price=0; endif;
$arr=array ("dir", "subdir", "nazv", "price", "opt", "ext_id", "description", "kwords", "foto1", "foto2" , "vitrin" , "onsale", "brand_name", "ext_lnk","full_descr", "kolvo");
$nn=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim (@$nn)))));
if(get_magic_quotes_gpc()) {
$r = stripslashes(@$r);
}

}



$st=0;
if ($clone=="yes") {

$price=doubleval($price);
$st=0;
$qwfile=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());

if (mysql_errno()) die( "Error-0 ".mysql_error());



$query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
//echo "$query ...<br>\n";
mysql_query("$query");
if (mysql_errno()) die(mysql_error());



mysql_select_db("$mysql_db_name");
if (mysql_errno()) die(mysql_error());




$query="CREATE TABLE IF NOT EXISTS $qwfile (";


reset ($item_fields);
$zap="";
while (list($key,$val)=each($item_fields)) {
$query.=$zap."`".mysql_real_escape_string($key)."` $val";
$zap=", ";
}
unset ($key,$val);

$customfile="../templates/$template/$speek/custom_cart.inc";
if (!file_exists($customfile)) {$customfile="";}
if (@file_exists(".$base_loc/catid.txt")) {
$file=file(".$base_loc/catid.txt");

reset ($file);
$maxc=0;
while (list($key,$val)=each($file)){
$tmp=explode("|",$val);
$indx=$tmp[0];
if (@file_exists("../templates/$template/$speek/cc_".$indx.".inc")) {
$count=count(file("../templates/$template/$speek/cc_".$indx.".inc"));
if ($count>$maxc) {
$maxc=$count;
}
}
}
unset ($file, $key, $val, $tmp, $tmpm, $count);

}
if (($customfile!="")||($maxc>0)) {
$custom_fields_arr=file($customfile);
$s=17;
$field=Array();
$types=Array();
$zap =", ";
while (list($key,$val)=each($custom_fields_arr)){
if (trim($val)!="") {
$tmpm=explode("|",$val);
if (trim($tmpm[0])!="") {
$type="TEXT";
$query.=$zap. "`". mysql_real_escape_string(translit($tmpm[0]))."_"."$s"."`"." $type";
$zap=", ";
$indx=translit($tmpm[0])."_".$s;
$item_fields[$indx]=$type;
$s+=1;
}
}
}
while ($maxc>0) {
$type="TEXT";
$query.=$zap. "`"."col_"."$s"."`"." $type";
$zap=", ";
$indx="col_".$s;
$item_fields[$indx]=$type;
$s+=1;
$maxc-=1;
}
unset ($key, $val, $tmpm, $indx, $custom_fields_arr);
}
$query.=")";
# Создаем таблицу если ее еще нет
//echo $query; exit;
mysql_query("$query");
if (mysql_errno()) die(mysql_error());



$fields=mysql_list_fields("$mysql_db_name", $dbpref."_items_".$speek, $mysqldb);
$columns=mysql_num_fields($fields);
$jj=0;
$ee=Array();
for ($i=0; $i<$columns; $i++) {
if ($i>26){
$ee[$jj]=mysql_field_name($fields, $i);
$jj+=1;
}
}


$set1="";
$zap="";
$rs=11;
$arr=array ("dir", "subdir", "nazv", "price", "", "ext_id", "description", "kwords", "foto1", "foto2" , "" , "", "brand_name", "","", "");
$item_fields2=array_keys($item_fields);
while (list ($line_num, $a) = each ($arr)) {
if ($a!="") {
$$a = str_replace(chr(10) , "<br>", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($$a)))));
if(get_magic_quotes_gpc()) {
$$a = stripslashes($$a);
}
$set1.=$zap."`".$item_fields2[$rs]."`='".mysql_real_escape_string($$a)."'";
$zap=",";
}
$rs+=1;
}

$st=0;
$set3="";

$numfile=".$base_loc/mysqlnum.txt";
if (!file_exists($numfile)) {
$nomer=1000;


} else {
$numm=file($numfile);
$nomer=doubleval($numm[0]);
$nomer+=1;

}

$chars=strlen($nomer);
if ($chars==1): $nomer="0000000$nomer"; endif;
if ($chars==2): $nomer="000000$nomer"; endif;
if ($chars==3): $nomer="00000$nomer"; endif;
if ($chars==4): $nomer="0000$nomer"; endif;
if ($chars==5): $nomer="000$nomer"; endif;
if ($chars==6): $nomer="00$nomer"; endif;
if ($chars==7): $nomer="0$nomer"; endif;
if ($chars==8): $nomer="$nomer"; endif;
if ($chars>=9): echo "<p>".$lang[429]."\n";exit; endif;
$newnomer=$nomer;
if ((!@$nomer) || (@$nomer=="")): echo $lang[70]." nomer!"; exit; endif;
//if item exist
$mysql_query="SELECT * FROM $qwfile WHERE (`item_id`='".mysql_real_escape_string(translit($nazv)."-".translit($ext_id))."' AND `unifid`='".mysql_real_escape_string(md5($nazv." ID:".$ext_id))."') LIMIT 1";
$result=mysql_query("$mysql_query");
if (mysql_errno()) die( "Error-1 $mysql_query. ".mysql_error());
$numrows=mysql_num_rows($result);
$indexm=translit(@$dir);
if (!isset($pods[$indexm])) {
$files=fopen(".$base_loc/catid.txt", "a");
if (!$files) {echo ".$base_loc/catid.txt"; exit;}
flock ($files, LOCK_EX);
fputs ($files, "$indexm|$dir||||||\n");
flock ($files, LOCK_UN);
fclose ($files);

}
$indexm=translit(@$dir." ".@$subdir." ");
if (!isset($pods[$indexm])) {
$files=fopen(".$base_loc/catid.txt", "a");
if (!$files) {echo ".$base_loc/catid.txt"; exit;}
flock ($files, LOCK_EX);
fputs ($files, "$indexm|$dir|$subdir|||||\n");
flock ($files, LOCK_UN);
fclose ($files);

}
if ($numrows==0) {

$mysql_query="INSERT INTO $qwfile SET $set1".", `id`='".mysql_real_escape_string($nomer)."', `item_id`='".mysql_real_escape_string(translit($nazv)."-".translit($ext_id))."', `unifid`='".mysql_real_escape_string(md5($nazv." ID:".$ext_id))."', `hidart`='".mysql_real_escape_string(strtoupper(substr(md5($ext_id.$artrnd), -7)))."', `date`='".mysql_real_escape_string(time())."', `votes_count`='0', `on_offer`='1',  `stock`=10, `votes_level`='0', `comment`='0', `counter`='0', `ext_stock`=''"."$set3";
//echo $mysql_query; exit;

$result=mysql_query("$mysql_query");
if (mysql_errno()) die( "Error-2 ".mysql_error());

$fp=fopen($numfile,"w");
fputs($fp,$nomer);
fclose($fp);


echo "<center><h4><font color=#468847>OK</font></h4><br>";

echo "<center>$nazv ($ext_id): <b>".$lang[209]."</b><br>
<br><br>
<p><input type='button' value='".$lang[440]."' name='no' onclick='javascript:rc()'></p><br>".$lang[441];
} else {
echo "<center><h4><font color=#b94a48>".$lang[42]."</font></h4><br>";

echo "<center>$nazv ($ext_id): <b>".$lang['file']." - ".$lang['exists']."!</b><br>
<br><hr><br>
<p><input type='button' value='".$lang['back']."' name='no' onclick='javascript:history.go(-1)'></p>";
}

mysql_close($mysqldb);
exit;
}
$st=0;
if ($clone!="yes") {
if (!isset($r)) {$r="";}
if (!isset($sub)) {$sub="";}
echo "<form method='POST' target='_self' action='".$scriptprefix."new_item.php'>
<input type='hidden' value='".$speek."' name='speek'>
<input type='hidden' value='yes' name='clone'>
<input type='hidden' value='$catid' name='catid'>
    <table border='0' width='100%'>
    <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang[430].":</td>
    <td colspan=2 valign=top><input type='text' size=50 style=\"width:100%\" value='$r' name='dir'></td></tr>
    <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang[431].":</td>
    <td colspan=2 valign=top><input type='text' size=50 style=\"width:100%\" value='$sub' name='subdir'></td></tr>
   <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang['name'].":</td>
   <td colspan=2 valign=top><input type='text' style=\"width:100%\" size=50 value='' name='nazv'></td></tr>
   <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang[419].":</td>
   <td colspan=2 valign=top><input type='text' style=\"width:100%\" size=50 value='' name='ext_id'></td></tr>
   <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang['price'].":</td>
   <td valign=top><input type='text' style=\"width:100%\" size=50 value='' name='price'></td><td valign=top>$valut</td></tr>
   <tr><td valign=top>".$lang[667].":</td>
   <td colspan=2 valign=top><input type='text' style=\"width:100%\" size=50 value='' name='brand_name'></td></tr>
   <tr><td valign=top>".$lang[665].":</td>
   <td valign=top><input type='text' style=\"width:100%\" size=50 value='' name='foto1' id=\"el_1\"></td><td valign=top><input type=button value=\"...\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=1&dest=1','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')></td></tr>
   <tr><td valign=top>".$lang[666].":</td>
   <td valign=top><input type='text' style=\"width:100%\" size=50 value='' name='foto2' id=\"el_2\"></td><td valign=top><input type=button value=\"...\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=2&dest=2','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')></td></tr>
   <tr><td valign=top>".$lang['keyword'].":</td>
   <td colspan=2 valign=top><input type='text' style=\"width:100%\" size=50 value='' name='kwords'><br><small><i>".$lang[863]."</i></td></tr>
   <tr><td valign=top>".$lang['short'].":</td><td colspan=2 valign=top><textarea style=\"width:100%\" rows=5  cols=48 name='description'></textarea></td></tr>
   </table>

  <table border='0' width='100%' cellpadding='3'>
  <tr>
    <td width='50%'>

        <p align='right'><input type='submit' value='".$lang['yes']."' name='yes'></p>

    </td>
    <td width='50%'>

        <p><input type='button' value='".$lang['no']."' name='no' onclick='javascript:self.close()'></p>

    </td>
  </tr>
</table></div>
<br><small>".$lang[435]."<br><b>".$lang[876]."</b></small>
</form>
";


}
?>

<!--end-->
</body>
</html>

