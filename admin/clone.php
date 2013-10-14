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
if ((!@$r) || (@$r=="")): echo $lang[70]." ".$lang[430]."!"; exit; endif;
if ((!@$sub) || (@$sub=="")): echo $lang[70]." ".$lang[431]."!"; exit; endif;
$sub=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($sub)))));
$r=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($r)))));
if ((!@$nn) || (@$nn=="")): echo $lang[70]." ".$lang['name']."!"; exit; endif;
if ((!@$art) || (@$art=="")): echo $lang[70]." ".$lang[419]."!"; exit; endif;
if ((!@$price) || (@$price=="")):$price=0; endif;
$nn=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($nn)))));
$brand=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($brand)))));
$art=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($art)))));
$price=str_replace(",", ".", str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($price))))));
$indexm=translit(@$r." ".@$sub." ");
$mesg="";
if (!isset($pods[$indexm])) {
$files=fopen(".$base_loc/catid.txt", "a");
if (!$files) {echo ".$base_loc/catid.txt"; exit;}
flock ($files, LOCK_EX);
fputs ($files, "$indexm|$r|$sub|||||\n");
flock ($files, LOCK_UN);
fclose ($files);
$mesg= "<b><font color=blue>$lang[658]</font></b><br><br><br>";
}

}

echo "<meta http-equiv='Content-Type' content='text/html; charset=$codepage'><title>".$lang[433]."</title>";
echo $css;
echo "
<SCRIPT language='JavaScript1.1'>
<!--

function rc() {
  ";

if ($clone=="no") {
  echo "window.opener.location.reload();";
  }

if ($clone=="yes") {echo "window.opener.location.href='$htpath/index.php?catid=".translit(@$r." ".@$sub." ")."';";
}
  echo "
  self.close();

}
//-->
</SCRIPT></head>
<BODY bgcolor=$nc0 link=$nc2 text=$nc5>";

if ((!@$id) || (@$id==0)): $id=="0"; endif;
if ((!@$id) || (@$id=="")): $id==0; endif;
$st=0;
/*$fcontents = file(".$base_file");
//“еперь получиv список разделов и подразделов
$allrazdels=$fcontents;
while (list ($line_num, $line) = each ($allrazdels)) {
$out=explode("|",$line);
$tmpmaxnomer[$st] = $out[0];
$st += 1;
}
reset ($tmpmaxnomer);
rsort ($tmpmaxnomer);
$nomer= $tmpmaxnomer[0];
//settype ($maxnomer, "integer");
*/
$nomer="00000";
//echo "—ледующий товар будет по номером <b>$nomer</b><br>";



if ((!@$nomer) || (@$nomer=="")): echo $lang[70]." nomer!"; exit; endif;
/* ƒл€ сортировки правильной давай переведем номер из представлени€ 1 в представление 0000000001 (Max 9999 документов в каждом разделе)*/
$chars=strlen($nomer);
if ($chars==1): $nomer="0000$nomer"; endif;
if ($chars==2): $nomer="000$nomer"; endif;
if ($chars==3): $nomer="00$nomer"; endif;
if ($chars==4): $nomer="0$nomer"; endif;
if ($chars==5): $nomer="$nomer"; endif;
if ($chars>=6): echo "<p>".$lang[429]."\n";exit; endif;
$newnomer=$nomer;

if ($clone=="yes") {
settype ($id, "integer");
$price=doubleval($price);
$st=0;
$fcontents = file(".$base_file");
$line=@$fcontents[$id];
$outc=explode("|",$line);
@$outc[1]=$r;
@$outc[2]=$sub;
@$outc[3]=$nn;
@$outc[6]=$art;
@$outc[4]=$price;
@$outc[13]=$brand;
$line=implode("|", $outc);

$file = fopen (".$base_file", "a");
if (!$file) {
echo "<p> ".$lang[44]." <b>.$base_file</b> ".$lang[45]."\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, $line); flock ($file, LOCK_UN);
fclose ($file);
$item_id=translit(@$outc[3])."-".translit(@$outc[6]);
$unifw=md5(@$outc[3]." ID:".@$outc[6]);
$ftsave=".$base_loc/items/".$item_id.".man";
$file = fopen ($ftsave, "w");
if (!$file) {
echo "<p> ".$lang[44]." <b>.$base_file</b> ".$lang[45]."\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, $unifw."\n".translit(@$outc[1]." ". @$outc[2]." ")); flock ($file, LOCK_UN);
fclose ($file);

if ($admin_speedup==1) {
echo "<div class=\"mr ml\">Admin speedup - <font color=green>".$lang['yes']."</font></div>";
$nomer=count($fcontents);
unset ($fcontents);
$outc[0]=$nomer;
$line=implode("|", $outc);
$catid=translit(@$r." ".$sub." ");
$file = fopen (".$base_loc/items/$catid.txt", "a");
if (!$file) {
echo "<p> File is write protect: <b>.$base_loc/items/$catid.txt</b>\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, $line);flock ($file, LOCK_UN);
fclose ($file);
}
echo "<div class=\"mr ml\"><b>".$lang[432]." id=$id</b><br>
<br>$mesg
<div align=center><input type='button' class=\"btn btn-primary btn-large\" value='".$lang[440]."' name='no' onclick='javascript:rc()'></div><br>".$lang[441]."</div>";
exit;
}
$st=0;
$fcontents = file(".$base_file");

$line=@$fcontents[$id];
if (($line!="")&&($line!="\n")) {




$out=explode("|",$line);
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

echo "ID=$id<br><form method='POST' target='_self' action='clone.php'>
<input type='hidden' value='".$speek."' name='speek'>
<input type='hidden' value='$id' name='id'>
<input type='hidden' value='yes' name='clone'>
<input type='hidden' value='$newnomer' name='nomer'>
<table border=0 class=table style='width:96%'>
<tr>
<td align='left' valign='top'><small><b>".$lang[419]."</b></small></td>
<td align='left' valign='top'><small><b>".$lang['name']."</b></small></td>
<td align='left' valign='top'><small><b>".$lang['price']."</b></small></td>
<td align='left' valign='top'><small><b>".$lang[427]."</b></small></td>
<td align='left' valign='top'><small><b>".$lang[355]."</b></small></td>


</tr>
";

echo "<tr bgcolor='$nc6'>
<td align='left' valign='top'><small>$ext_id</small></td>
<td align='left' valign='top'><small>$nazv</small></td>
    <td align='left' valign='top'><small>$price</small></td>
    <td align='left' valign='top'><small>$onsale</small></td>
    <td align='left' valign='top'><small>$brand_name</small></td>
</tr>
    </table>
    <div align=center><br><strong>".$lang[433]."</strong><br><br>
    <table border=0 style='width:96%'>
    <tr><td>".$lang[430].":</td><td><input type='text' size=50 style=\"width:96%\" value='$dir' name='r'></td></tr>
    <tr><td>".$lang[431].":</td><td><input type='text' size=50 style=\"width:96%\" value='$subdir' name='sub'></td></tr>
    <tr><td>".$lang[355]."</td><td><input type='text' size=50 style=\"width:96%\" value='$brand_name' name='brand'></td></tr>
   <tr><td>".$lang['name'].":</td><td><input type='text' style=\"width:96%\" size=50 value='".$nazv."' name='nn'></td></tr>
   <tr><td>".$lang[419].":</td><td><input type='text' style=\"width:96%\" size=50 value='".$ext_id."' name='art'></td></tr>
   <tr><td>".$lang['price'].":</td><td><input type='text' style=\"width:50%\" size=50 value='".$price."' name='price'> ".substr(@$out[12],1,3)."</td></tr>
   </tr></table>

  <table border=0 class=table style='width:96%' cellpadding='3'>
  <tr>
    <td width='50%'>

        <p align='right'><input class='btn btn-primary' type='submit' value='".$lang['yes']."' name='yes'></p>

    </td>
    <td width='50%'>
<input type='button' class=btn value='".$lang['no']."' name='no' onclick='javascript:self.close()'>
    </td>
  </tr><tr><td colspan=2><br><small>".$lang[435]."</small></td></tr>
</table></div>

</form>
";


} else {
echo "<div align=center><font face=verdana>".$lang[434]."<br><br><input type='button' class=\"btn btn-primary btn-large\" value='OK' name='no' onclick='javascript:self.close()'></font></div>";
}
?>

<!--end-->
</body>
</html>
