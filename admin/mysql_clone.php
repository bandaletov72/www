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

require ("../templates/$template/$speek/vars.txt");

@setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
require ("../templates/$template/css.inc");
require ("../modules/translit.php");
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


if ((!@$clone) || (@$clone=="")): $clone="no"; endif;
if ($clone=="yes") {
//echo "-$dir-$subdir-$ext_id-$price-$nazv";
if ((!@$dir) || (@$dir=="")): echo $lang[70]." ".$lang[430]."!"; exit; endif;
if ((!@$subdir) || (@$subdir=="")): echo $lang[70]." ".$lang[431]."!"; exit; endif;
$subdir=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($subdir)))));
$dir=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($dir)))));
if ((!@$nazv) || (@$nazv=="")): echo $lang[70]." ".$lang['name']."!"; exit; endif;
if ((!@$ext_id) || (@$ext_id=="")): echo $lang[70]." ".$lang[419]."!"; exit; endif;
if ((!@$price) || (@$price=="")): $price=0; endif;
$nazv=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($nazv)))));
$ext_id=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($ext_id)))));
$price=str_replace(",", ".", str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($price))))));


}

echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>".$lang[433]."</title><head>";
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

if (!isset($id)) {$id="";}
$st=0;

if ($clone=="yes") {

$price=doubleval($price);
$st=0;
$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());

if (mysql_errno()) die( "Error-1 ".mysql_error());
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

mysql_select_db("$mysql_db_name");

$set1="";
$zap="";
$rs=11;
$arr=array ("dir", "subdir", "nazv", "price", "", "ext_id", "", "", "", "" , "" , "", "", "","", "");
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

$mysql_query="SELECT * FROM $file WHERE (`unifid`='".mysql_real_escape_string($unifid)."' AND `item_id`='".mysql_real_escape_string($item_id)."') LIMIT 1";

//echo $mysql_query;

$result=mysql_query("$mysql_query");

$row = mysql_fetch_assoc($result);
$set3="";
if ($row) {
while(list($kr,$vr)=each($row)) {
if (($kr!="item_name")&&($kr!="ext_stock")&&($kr!="counter")&&($kr!="comment")&&($kr!="votes_level")&&($kr!="votes_count")&&($kr!="code")&&($kr!="item_name")&&($kr!="price")&&($kr!="dir")&&($kr!="subdir")&&($kr!="hidart")&&($kr!="item_id")&&($kr!="unifid")&&($kr!="id")&&($kr!="date")) {
$set3.=", `".$kr."`='".mysql_real_escape_string($vr)."'";
}
}
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
$mysql_query="SELECT * FROM $file WHERE (`item_id`='".mysql_real_escape_string(translit($nazv)."-".translit($ext_id))."' AND `unifid`='".mysql_real_escape_string(md5($nazv." ID:".$ext_id))."') LIMIT 1";
$result=mysql_query("$mysql_query");
if (mysql_errno()) die( "Error-1 ".mysql_error());
$numrows=mysql_num_rows($result);
if ($numrows==0) {

$mysql_query="INSERT INTO $file SET $set1".", `id`='".mysql_real_escape_string($nomer)."', `item_id`='".mysql_real_escape_string(translit($nazv)."-".translit($ext_id))."', `unifid`='".mysql_real_escape_string(md5($nazv." ID:".$ext_id))."', `hidart`='".mysql_real_escape_string(strtoupper(substr(md5($ext_id.$artrnd), -7)))."', `date`='".mysql_real_escape_string(time())."', `votes_count`='0', `votes_level`='0', `comment`='0', `counter`='0', `ext_stock`=''"."$set3";
//echo $mysql_query; exit;

$result=mysql_query("$mysql_query");
if (mysql_errno()) die( "Error-1 ".mysql_error());
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
$fp=fopen($numfile,"w");
fputs($fp,$nomer);
fclose($fp);


echo "<center><h4><font color=#468847>OK</font></h4><br>";

echo "<center>$nazv ($ext_id): <b>".$lang[432]."</b><br>
<br><br>
<p><input type='button' value='".$lang[440]."' name='no' onclick='javascript:rc()'></p><br>".$lang[441];
} else {
echo "<center><h4><font color=#b94a48>".$lang[42]."</font></h4><br>";

echo "<center>$nazv ($ext_id): <b>".$lang['file']." - ".$lang['exists']."!</b><br>
<br><hr><br>
<p><input type='button' value='".$lang['back']."' name='no' onclick='javascript:history.go(-1)'></p>";
}
}
mysql_close($mysqldb);
exit;
}
$st=0;
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

$numfile=".$base_loc/mysqlnum.txt";
if (!file_exists($numfile)) {
$nomer=1000;


} else {
$numm=file($numfile);
$nomer=doubleval($numm[0]);
$nomer+=1;

}
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
@$foto1=@$out[9];
echo "<table width=100%>
<tr>
<td align='left' valign='top'><small><b>".$lang[419]."</b></small></td>
<td align='left' valign='top'><small><b>".$lang['name']."</b></small></td>
<td align='left' valign='top'><small><b>".$lang['price']."</b></small></td>
<td align='left' valign='top'><small><b>".$lang[427]."</b></small></td>
<td align='left' valign='top'><small><b>".$lang[355]."</b></small></td>
</tr>
";

//$nomer = $out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];

@$foto2=@$out[10];
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1); 
@$brand_name=@$out[13];
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
@$kolvo=@$out[16];

echo "<form method='POST' target='_self' action='".$scriptprefix."clone.php'>
<input type='hidden' value='".$speek."' name='speek'>
<input type='hidden' value='$unifid' name='unifid'>
<input type='hidden' value='$item_id' name='item_id'>
<input type='hidden' value='yes' name='clone'>
<input type='hidden' value='$nomer' name='nomer'>
<tr bgcolor='$nc6'>
<td align='left' valign='top'><small>$ext_id</small></td>
<td align='left' valign='top'><small>$nazv</small></td>
    <td align='left' valign='top'><small>$price</small></td>
    <td align='left' valign='top'><small>$onsale</small></td>
    <td align='left' valign='top'><small>$brand_name</small></td>
</tr>
    </table>
    <table width=100% cellspacing=0 border=0 cellpadding=2>
<tr>
<td valign='top' width=30%><div style=\"width: auto; height: 200px; overflow: auto; display: block;\">".str_replace("<img src='ph","<img src='$htpath/ph", $foto1)."</div></td>
<td align='right' valign='top'>
    <div align=center><br><b>".$lang[433]."</b><br><br>
    <table border='0' width='100%'>
    <tr><td>".$lang[430].":</td><td><input type='text' size=50 style=\"width:100%\" value='$dir' name='dir'></td></tr>
    <tr><td>".$lang[431].":</td><td><input type='text' size=50 style=\"width:100%\" value='$subdir' name='subdir'></td></tr>
   <tr><td><font color=#b94a48>".$lang['name'].":</font></td><td><input type='text' style=\"width:100%\" size=50 value='".$nazv."' name='nazv'></td></tr>
   <tr><td><font color=#b94a48>".$lang[419].":</font></td><td><input type='text' style=\"width:100%\" size=50 value='".$ext_id."' name='ext_id'></td></tr>
   <tr><td>".$lang['price'].":</td><td><input type='text' style=\"width:100%\" size=50 value='".$price."' name='price'></td></tr>
   </tr></table>
   </td></tr></table>

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
<br><small>".$lang[435]."</small>
</form>
";
} else {
echo "<div align=center><font face=verdana>".$lang[434]."<br><br><input type='button' value='OK' name='no' onclick='javascript:self.close()'></font></div>";
}
?>

<!--end-->
</body>
</html>

