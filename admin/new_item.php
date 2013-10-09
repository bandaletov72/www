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
if (isset($_GET['dval'])) { $dval=$_GET['dval']; } elseif(isset($_POST['dval'])) { $dval=$_POST['dval']; } else { $dval=$valut; }
if (!preg_match('/^[0-9a-zA-Z]+$/i',$dval)) { $dval=$valut;}

if (!isset($catid)) {$catid="";}
if (!isset($sub)) {$sub="";}
if (!isset($r)) {$r="";}
$tip1="";
$tip2="";
$tip3="$valut";
if ((!@$clone) || (@$clone=="")): $clone="no"; endif;
$fcontentsy = @file(".$base_loc/catid.txt");
@natcasesort($fcontentsy);
@reset($fcontentsy);
$st=0;
while (list ($line_numy, $liney) = @each ($fcontentsy)) {
$outs=explode("|",$liney);
$indx=$outs[0];
if (trim($outs[0])!="") { if (trim($outs[2])!="") { $ttip2[$indx]="&quot;".$outs[2]."&quot;";  } else {$ttip1[translit($outs[1])]="&quot;".$outs[1]."&quot;"; }  }
if (($catid!="")&&($catid!="_")&&($catid==$outs[0])) {  $ttip0[$indx]="&quot;".$outs[2]."&quot;"; if ($clone!="yes") { $r=$outs[1]; $sub=$outs[2]; } else { if ($r=="") {$r="All";}} }

$pods[$indx]=$outs[0];
}
if (isset($ttip1)) { natcasesort($ttip1); $tip1=implode(",", $ttip1); }
if (isset($ttip2)) { natcasesort($ttip2); $tip2=implode(",", $ttip2); }
if (count($currencies)>1) { $tip3="<select name=dval class=input-mini><option>$valut</option>";
reset($currencies);
ksort($currencies);
while(list($key,$val)=each($currencies)) {
$tip3.="<option>$key</option>";
}
$tip3.="</select>";
reset($currencies);
}
if ($clone=="yes") { if ($r=="") {$r="All";}}
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

if ($clone=="yes") {echo "window.opener.location.href='$htpath/index.php?catid=".translit(@$r." ".@$sub." ")."';";
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
if ((!@$r) || (@$r=="")): $r="All"; endif;
if ((!@$sub) || (@$sub=="")): echo "<br><div align=center>".$lang[70]." ".$lang[431]."!$back"; exit; endif;
$sub=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($sub)))));
$r=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($r)))));
if ((!@$nn) || (@$nn=="")): echo "<br><div align=center>".$lang[70]." ".$lang['name']."!$back"; exit; endif;
if ((!@$art) || (@$art=="")): echo "<br><div align=center>".$lang[70]." ".$lang[419]."!$back"; exit; endif;
if ((!@$price) || (@$price=="")): $price=0; endif;
$nn=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($nn)))));
$art=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($art)))));
$price=str_replace(",", ".", str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($price))))));
$keywords= str_replace("  ", " ", str_replace("|", " ", trim (trim (trim (@$keywords)))));
$brand= str_replace("  ", " ", str_replace("|", " ", trim (trim (trim (@$brand)))));
$description= str_replace("  ", " ", str_replace("|", " ", trim (trim (trim (@$description)))));
$foto= str_replace("  ", " ", str_replace("|", " ", trim (trim (trim (@$foto)))));
$foto2= str_replace("  ", " ", str_replace("|", " ", trim (trim (trim (@$foto2)))));
if(get_magic_quotes_gpc()) {
$r = stripslashes($r);
$sub = stripslashes($sub);
$nn = stripslashes($nn);
$art = stripslashes($art);
$price = stripslashes($price);
$keywords = stripslashes($keywords);
$brand = stripslashes($brand);
$description = stripslashes($description);
$foto = stripslashes($foto);
$foto2 = stripslashes($foto2);
}


}



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
//settype ($id, "integer");
$price=doubleval($price);
$line="00000|$r|$sub|$nn|$price|$price|$art|".str_replace("\n", "<br>", str_replace("\r", "<br>",str_replace(chr(10), "<br>",$description)))."|$keywords|$foto|$foto2||1".$dval."|$brand|||10||||\n";

$file = fopen (".$base_file", "a");
if (!$file) {
echo "<p> ".$lang[44]." <b>.$base_file</b> ".$lang[45]."\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, $line); flock ($file, LOCK_UN);
fclose ($file);
$item_id=translit(@$nn)."-".translit(@$art);
$unifw=md5(@$nn." ID:".@$art);
$ftsave=".$base_loc/items/".$item_id.".man";
$file = fopen ($ftsave, "w");
if (!$file) {
echo "<p> ".$lang[44]." <b>.$base_file</b> ".$lang[45]."\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, $unifw."\n".translit(@$r." ". @$sub." ")); flock ($file, LOCK_UN);
fclose ($file);
if ($admin_speedup==1) {
$fcontents=file(".$base_file");
$nomers=count($fcontents)-1;
unset ($fcontents);
$outc=explode("|",$line);
$outc[0]=$nomers;
$stroket=implode("|", $outc);
$catid=translit($r." ".$sub." ");
$file = fopen (".$base_loc/items/$catid.txt", "a");
if (!$file) {
echo "<p> File is write protect: <b>.$base_loc/items/$catid.txt</b>\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, $stroket);flock ($file, LOCK_UN);
fclose ($file);
}

$itemcode=0;
if (!file_exists("./itemcode.txt")) {$fic=fopen("./itemcode.txt","w"); fputs($fic,"0"); fclose ($fic); } else {
$fic=fopen("./itemcode.txt","r");
$itemcode=fread($fic,filesize("./itemcode.txt"));
fclose ($fic);
$itemcode+=1;
$fic=fopen("./itemcode.txt","w");
fputs($fic,$itemcode);
fclose ($fic);
}
$indexm=translit(@$r);
if (!isset($pods[$indexm])) {
$files=fopen(".$base_loc/catid.txt", "a");
if (!$files) {echo ".$base_loc/catid.txt"; exit;}
flock ($files, LOCK_EX);
//echo "$indexm|$r||||||<br><br>";
fputs ($files, "$indexm|$r||||||\n");
flock ($files, LOCK_UN);
fclose ($files);

}
$indexm=translit(@$r." ".@$sub." ");
if (!isset($pods[$indexm])) {
$files=fopen(".$base_loc/catid.txt", "a");
if (!$files) {echo ".$base_loc/catid.txt"; exit;}
flock ($files, LOCK_EX);
//echo "$indexm|$r|$sub|||||\n<br><br>";
fputs ($files, "$indexm|$r|$sub|||||\n");
flock ($files, LOCK_UN);
fclose ($files);

}
echo "<center><b>".$lang[209]."</b><br>
<br><hr><br>
<p><input type='button' value='".$lang[440]."' name='no' onclick='javascript:rc()'></p><br>".$lang[441];
exit;
}
$st=0;
if ($clone!="yes") {
$itemcode=1;
if (!file_exists("./itemcode.txt")) {$fic=fopen("./itemcode.txt","w"); fputs($fic,"1"); fclose ($fic); } else {
$fic=fopen("./itemcode.txt","r");
$itemcode=fread($fic,filesize("./itemcode.txt"));
fclose ($fic);
$itemcode+=1;
}
if ($sub=="NONAME") {$sub="";}
echo "<form method='POST' target='_self' action='new_item.php'>
<input type='hidden' value='".$speek."' name='speek'>
<input type='hidden' value='yes' name='clone'>
<input type='hidden' value='$catid' name='catid'>
    <table border='0' style='width:96%; margin-left:10px; margin-right:10px; margin-top:10px;'>
    <tr><td valign=top><font color=#b94a48 size=3></font>".$lang[430].":</td><td colspan=2 valign=top><input autocomplete=\"off\" type='text' size=50 style=\"width:95%; margin: 0 auto;\" data-provide=\"typeahead\" data-items=\"4\" data-source=\"[".$tip1."]\" value='$r' name='r'></td></tr>
    <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang[431].":</td><td colspan=2 valign=top><input autocomplete=\"off\" type='text' size=50 style=\"width:95%; margin: 0 auto;\" data-provide=\"typeahead\" data-items=\"4\" data-source=\"[".$tip2."]\" value='$sub' name='sub'></td></tr>
   <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang['name'].":</td><td colspan=2 valign=top><input type='text' style=\"width:95%\" size=50 value='' name='nn'></td></tr>
   <tr><td valign=top><font color=#b94a48 size=3>*</font>".$lang[419].":</td><td colspan=2 valign=top><input type='text' style=\"width:95%\" size=50 value='ID".$itemcode."' name='art'></td></tr>
   <tr><td valign=top><font color=#b94a48 size=3></font>".$lang['price'].":</td><td valign=top><input type='text' style=\"width:95%\" size=50 value='' name='price'></td><td>".$tip3."</td></tr>
   <tr><td valign=top>".$lang[667].":</td><td colspan=2 valign=top><input type='text' style=\"width:95%\" size=50 value='' name='brand'></td></tr>
   <tr><td valign=top>".$lang[665].":</td><td valign=top><input type='text' style=\"width:95%\" size=50 value='' name='foto' id=\"el_1\"></td><td><input class='btn btn-success' type=button value=\"+\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=1&dest=1','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')></td></tr>
   <tr><td valign=top>".$lang[666].":</td><td valign=top><input type='text' style=\"width:95%\" size=50 value='' name='foto2' id=\"el_2\"></td><td><input class='btn btn-success' type=button value=\"+\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=2&dest=2','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')></td></tr>
   <tr><td valign=top>".$lang['keyword'].":</td><td colspan=2 valign=top><input type='text' style=\"width:95%\" size=50 value='' name='keywords'><br><small><i>".$lang[863]."</i></td></tr>
   <tr><td valign=top>".$lang['short'].":</td><td colspan=2 valign=top><textarea style=\"width:95%\" rows=3  cols=48 name='description'></textarea></td></tr>
   </table>

  <table class=table border='0' cellpadding='3' style='width:96%'>
  <tr>
    <td width='50%'>

        <p align='right'><input class='btn btn-primary' type='submit' value='".$lang['yes']."' name='yes'></p>

    </td>
    <td width='50%'>

        <p><input type='button' class='btn' value='".$lang['no']."' name='no' onclick='javascript:self.close()'></p>

    </td>
  </tr><tr><td colspan=2><br><small>".$lang[435]."<br><b>".$lang[876]."</b></small></td></tr>
</table></div>

</form>
";


}
?>

<!--end-->
</body>
</html>

