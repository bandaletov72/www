<?php
$vacl=Array();
$vacancy_list="";
$vacancy_form="";
$custom_vac_str="";
$errorvc="";
$errorvct="";
$tsave="";
$custom_vac_arr=Array();
$edittmp=Array();

//settings
$vac_custom_file="./templates/$template/$language/custom_vacancy.inc";
$vac_file="$base_loc/vacancy.txt";

if ($view_vacancy==1) {
if(isset($_GET['vac_id'])) { $vac_id=$_GET['vac_id']; } elseif(isset($_POST['vac_id'])) { $vac_id=$_POST['vac_id'];} else {$vac_id="";}
if (!preg_match('/^[a-z0-9_]+$/i',$vac_id)) { $vac_id="";}
if ($vac_id!="") {
//show vacancy with vac_id

if (file_exists($vac_custom_file)) {
//custom fields exists, lets parese it to array
$vactmp=file($vac_custom_file);
$vacf=0;
while (list($vakey,$vaval)=each($vactmp)) {
$vaval=trim(trim($vaval));
if ($vaval!="") {
unset ($tmp);
$tmp=explode("|",$vaval);
if (trim($tmp[0])!=""){
$vacl[]=$vaval;
}
}
}
}





$vacancy_list2="<table width=100% cellspacing=0 cellpadding=10 class=shadow><tr><td valign=top style=\"background-color:".$nc10."; background-image: url(grad.php?h=46&w=1&e=".str_replace("#","", $nc10)."&s=".str_replace("#","", $nc10)."&d=vertical);\"><font size=3><b>".$lang[1023]."</b></font></td><td valign=top style=\"background-color:".$nc10."; background-image: url(grad.php?h=46&w=1&e=".str_replace("#","", $nc10)."&s=".str_replace("#","", $nc10)."&d=vertical);\" align=center><font size=3><b>".$lang[1024]."</b></font></td></tr>";
$vacf=0;
if (file_exists($vac_file)==TRUE) {
unset($tmpz,$key,$val);
$tmpz=file($vac_file);
while (list($key,$val)=each($tmpz)) {
unset ($tmp);
$val=trim(trim($val));
if ($val!=""){
$tmp=explode("|",$val);

if ((trim($tmp[6])!="")&&($tmp[6]==$vac_id)) {
if (!isset($_POST['v_edit'])) { }  else {
//edit vacancy stroke

$vac_name=stripslashes(trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($_POST['vac_name']))))))));
$vac_total=stripslashes(trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($_POST['vac_total']))))))));

if (($vac_name=="")) { $errorvc="<div class=\"alert alert-error\"><font color=#b94a48>".$lang[1023]."!</div>"; }
if (($vac_total=="")) { $errorvct="<div class=\"alert alert-error\">".$lang[1024]."!</div>";}
if (($errorvc=="")&&($errorvct=="")) {
if (!is_array($_POST['vac'])) { } else {
$tmpp2=$_POST['vac'];
$key=0;
while ($key<30) {
if (isset($tmpp2[$key])) {
$val=$tmpp2[$key];
} else {
$val="";
}
$custom_vac_arr[$key]=stripslashes(trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($val))))))));
$key++;
}
$custom_vac_str = stripslashes($vac_name."|".$vac_total."|".$details[1]."|".$details[3]."|".$details[4]."|".$details[5]."|".$tmp[6]."|".implode("|",$custom_vac_arr))."|\n";
//save vacancy
$tsave.=$custom_vac_str;
$tmp=explode("|",trim($custom_vac_str));
$vacancy_form.="<div align=center><font color=#468847 size=3>".$lang[1025]."</font></div><br><br>";
unset ($vac,$vac_name, $vac_total);
}
}
}
$edittmp=$tmp;
//var_dump($edittmp);
if (($vacf/2)==round($vacf/2)) {$bgcolor=lighter($nc0,0);} else {$bgcolor=lighter($nc0,-5); }
reset($vacl);
$cvac="";
$ffv=0;
while (list($vackey,$vacval)=each($vacl)) {
$indx=($vackey+7);
unset ($tmp3);
$tmp3=explode("|",$vacval);
if ($tmp[$indx]!="") {
if ($tmp3[2]=="checkbox") {
if (@$tmp[$indx]==1) {$tmp[$indx]=$lang[1026];} else {$tmp[$indx]=$lang[1027];}
}  else {
if (@$tmp[$indx]=="") {$tmp[$indx]="-";}
}
if (($ffv/2)==round($ffv/2)) {$bgcolor2=lighter($bgcolor,-5);} else {$bgcolor2=lighter($bgcolor,-12); }
$cvac.="<tr><td valign=top style=\"background-color:".$bgcolor2."\">".stripslashes($tmp3[0]).":</td><td valign=top style=\"background-color:".$bgcolor2."\"><i>".str_replace("\\", "", stripslashes($tmp[$indx]))."</i></td></tr>\n";
}
$ffv+=1;
}

if ($cvac!="") {$cvac="<br><br><b>$lang[1030]:</b><br><br>"."<table border=0 cellpadding=10 cellspacing=0 class=shadow>$cvac</table>";} else {$cvac="<br><br><b>$lang[1030]:</b> $lang[1036]"; }
$delvac="";
$sendbutton="";
if ($tmp[4]!="") {$sendbutton="<br><button class=btn type=button title=\"".$lang[1033]."\" onclick=\"document.location.href='"."mailto:".stripslashes($tmp[4])."?subject=".stripslashes(str_replace("_"," ", translit("$lang[1037] id".stripslashes($tmp[6])." ".stripslashes($tmp[0])." " . stripslashes($tmp[1]))))."'\";><font color=#468847>V</font> ".$lang[1033]."</button>";}
$cvac2="<table border=0 width=100%><tr>
<td valign=top><small>#<b>".($vacf+1)."</b></font></small></td>
<td valign=top><small>$lang[1031]: <b>".date("d-m-Y H:i" ,$tmp[6])."</b></small></td>";
//$cvac.="<br>$lang[76]: <b>".$tmp[2]."</b>\n";
$cvac2.="<td valign=top><small>$lang[1034]: <b>".stripslashes($tmp[3])."</b></small></td>";
//$cvac.="<br>E-mail: <b>".$tmp[4]."</b>\n";
$cvac2.="<td valign=top><small>$lang[73]: <b>".stripslashes($tmp[5])."</b></small></td>";
$cvac2.="<td align=right valign=top><small>ID:".stripslashes($tmp[6])."</small></td></tr></table>";

if ($valid=="1") { if (($details[7]=="HR")||($details[7]=="ADMIN")||($details[7]=="MODER")) {$delvac="<br><button class=btn type=button title=\"".$lang[744]."\" onclick=\"document.location.href='"."$htpath/index.php?action=vacancy&vacdel=".$tmp[6]."'\";><font color=#b94a48>X</font> ".$lang[744]."</button>";}}
$vacancy_list2.="<tr><td valign=top style=\"background-color:".$bgcolor."\"><font size=3><b>".$tmp[0]."</b></a></font>$cvac</td><td style=\"background-color:".$bgcolor."\" align=center valign=top><font size=4>".stripslashes($tmp[1])."</font>$delvac$sendbutton</td></tr>
<tr><td colspan=2 style=\"background-color:".$bgcolor."\">$cvac2</td></tr>";
$tit= "#$vac_id   ";
} else {
$tsave.="$val\n";
}

}
}
if ($valid=="1") { if (($details[7]=="HR")||($details[7]=="ADMIN")||($details[7]=="MODER")) {
if ($tsave!="") {
if (!isset($_POST['v_edit'])) { } else {
$fp=fopen($vac_file,"w");
fputs($fp, $tsave);
fclose ($fp);
}
}

}}

}

$vacancy_list2.="</table><br><br>";

$vacancy_list.="<div class=round3 align=center><table width=100%><tr><td><a href=$htpath/index.php?action=vacancy><img src=$image_path/ofb.png border=0 title=\"".$lang['back']."\" align=absmiddle hspace=5>".$lang['back']."</a></td><td align=right><font size=3><b>".$lang[1038]." #$vac_id</b></font></td></tr></table></div><br>$vacancy_list2<br><br>

";
unset ($vactmp,$vakey,$vaval,$fp,$tosave);

if ($valid=="1") { if (($details[7]=="HR")||($details[7]=="ADMIN")||($details[7]=="MODER")) {
//edit form vacancy
if (count($edittmp)>0) {
if (!isset($_POST['v_edit'])) {
$vac_name=stripslashes(trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($edittmp[0]))))))));
$vac_total=stripslashes(trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($edittmp[1]))))))));
$errorvc="";
$errorvct="";
array_shift($edittmp);
array_shift($edittmp);
array_shift($edittmp);
array_shift($edittmp);
array_shift($edittmp);
array_shift($edittmp);
array_shift($edittmp);
$vac=$edittmp;
}  else {
//edit vacancy stroke
//var_dump($_POST['vac'],$_POST['vac_name'],$_POST['vac_total']);
$vac_name=stripslashes(trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($_POST['vac_name']))))))));
$vac_total=stripslashes(trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($_POST['vac_total']))))))));

if (($vac_name=="")) { $errorvc="<div class=\"alert alert-error\">".$lang[1023]."!</div>"; }
if (($vac_total=="")) { $errorvct="<div class=\"alert alert-error\">".$lang[1024]."!</div>";}
if (($errorvc=="")&&($errorvct=="")) {
if (!is_array($_POST['vac'])) {  } else {
$vac=Array();
$tmpp=$_POST['vac'];
$key=0;
while ($key<50) {
if (!isset($tmpp[$key])) {
$vac[$key]="";
} else {
$vac[$key]=str_replace("<br>","\n", $tmpp[$key]);
}

$key++;
}

//save vacancy
$vacancy_list.="<div class=round3 align=center><font color=#468847 size=3>".$lang[704]."</font></div><br>";

}
}
}

$vacancy_list.="<h4>".$lang[385].":</h4><br><div><form class=form-inline action=index.php method=POST>
<input type=hidden name=v_edit value=1>
<input type=hidden name=action value=vacancy>
<input type=hidden name=vac_id value=$vac_id>
<table class=table width=100% cellspacing=0 cellpadding=10 border=0 style=\"background-color:".lighter($nc0,0)."\">
<tr><td valign=top style=\"background-color:".lighter($nc0,0)."\"><b>".$lang[1023]."*</b>$errorvc</td><td valign=top style=\"background-color:".lighter($nc0,0)."\"><input type=text name=vac_name size=10 value=\"".stripslashes(@$vac_name)."\" style=\"width:90%;\"></td></tr>
<tr><td valign=top style=\"background-color:".lighter($nc0,-5)."\"><b>".$lang[1024]."*</b>$errorvct</td><td valign=top style=\"background-color:".lighter($nc0,-5)."\"><input type=text name=vac_total size=10 value=\"".stripslashes(@$vac_total)."\" style=\"width:90%;\"></td></tr>
";


reset ($vacl);
$vacf=0;
while (list($vakey,$vaval)=each($vacl)) {
$vaval=trim(trim($vaval));
if ($vaval!="") {
unset ($tmp);
$tmp=explode("|",$vaval);
if (trim($tmp[0])!=""){

if (($vacf/2)==round($vacf/2)) {$bgcolor=lighter($nc0,0);} else {$bgcolor=lighter($nc0,-5); }
if (($tmp[2]=="text")||($tmp[2]=="")) {
$vacancy_list.="<tr><td valign=top style=\"background-color:$bgcolor\"><b>".stripslashes($tmp[0])."".stripslashes($tmp[1])."</b></td><td valign=top style=\"background-color:$bgcolor\"><input type=text name=vac[".$vacf."] size=".$tmp[3]." value=\"".stripslashes(@$vac[$vacf])."\" style=\"width:90%;\"></td></tr>\n";
}
if ($tmp[2]=="textarea") {
$vacancy_list.="<tr><td valign=top style=\"background-color:$bgcolor\"><b>".stripslashes($tmp[0])."".stripslashes($tmp[1])."</b></td><td valign=top style=\"background-color:$bgcolor\"><textarea cols=64 rows=".$tmp[3]." name=vac[".$vacf."] style=\"width:90%;\">".stripslashes(str_replace("<br>","\n", @$vac[$vacf]))."</textarea></td></tr>\n";
}
if ($tmp[2]=="checkbox") {
if (@$vac[$vacf]==1) {$checked=" checked";} else {$checked="";}
$vacancy_list.="<tr><td valign=top style=\"background-color:$bgcolor\"><b>".stripslashes($tmp[0])."".stripslashes($tmp[1])."</b></td><td valign=top style=\"background-color:$bgcolor\"><input type=checkbox"."$checked name=vac[".$vacf."] value=1></td></tr>\n";
}
$vacf+=1;
}
}
}
$vacancy_list.="<tr><td colspan=2>
<div align=center>
<input type=submit class=submit value=\"V&nbsp;&nbsp;".$lang['ch']."\">
</div>
</td></tr></table></form></div>";

}
}
}

unset ($vac,$vac_name, $vac_total);





} else {








if ($valid=="1") { if (($details[7]=="HR")||($details[7]=="ADMIN")||($details[7]=="MODER")) {



//delete vacancy
if(isset($_GET['vacdel'])) { $vacdel=$_GET['vacdel']; } elseif(isset($_POST['vacdel'])) { $vacdel=$_POST['vacdel'];} else {$vacdel="";}
if (!preg_match('/^[a-z0-9_]+$/i',$vacdel)) { $vacdel="";}
$vacdel=doubleval($vacdel);
if ($vacdel>0) {
$vacf=1;
$vactmp=file($vac_file);
$tosave="";
unset($tmp);
while (list($vakey,$vaval)=each($vactmp)) {
$vaval=trim(trim($vaval));
$tmp=explode("|", $vaval);
if ($vaval!=""){
if ($tmp[6]!=$vacdel){
$tosave.=$vaval."\n";
}
unset($tmp);
$vacf+=1;
}
}
$fp=fopen($vac_file,"w");
fputs($fp, $tosave);
fclose ($fp);
$vacancy_form.="<div class=round3 align=center><font color=#468847 size=3>".$lang[1029]."</font></div><br><br>";
unset ($vactmp,$vakey,$vaval,$fp,$tosave);
}


if (!isset($_POST['v_send'])) { }  else {
//add new vacancy

$vac_name=trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($_POST['vac_name'])))))));
$vac_total=trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($_POST['vac_total'])))))));

if (($vac_name=="")) { $errorvc="<small><br><font color=#b94a48>".$lang[1023]."!</font></small>"; }
if (($vac_total=="")) { $errorvct="<small><br><font color=#b94a48>".$lang[1024]."!</font></small>";}
if (($errorvc=="")&&($errorvct=="")) {
if (!is_array($_POST['vac'])) { } else {
$tmpp=$_POST['vac'];
$key=0;
while ($key<50) {
if (isset($tmpp[$key])) {
$val=$tmpp[$key];
} else {
$val="";
}
$custom_vac_arr[$key]=trim(trim(str_replace("|","",str_replace("\n","<br>", str_replace("\r","", str_replace(chr(10),"<br>", htmlspecialchars($val)))))));
$key++;
}
$custom_vac_str = $vac_name."|".$vac_total."|".$details[1]."|".$details[3]."|".$details[4]."|".$details[5]."|".time()."|".implode("|",$custom_vac_arr)."|\n";
//save vacancy
$fp=fopen($vac_file,"a");
fputs($fp, $custom_vac_str);
fclose ($fp);
$vacancy_form.="<div class=round3 align=center><font color=#468847 size=3>".$lang[1025]."</font></div><br><br>";
unset ($vac,$vac_name, $vac_total);
}
}
}
//form vacancy
$vacancy_form.="<div><form class=form-inline action=index.php method=POST>
<input type=hidden name=v_send value=1>
<input type=hidden name=action value=vacancy>";
if ($valid=="1") { if (($details[7]=="ADMIN")||($details[7]=="MODER")) {$vacancy_form.="$lang[81]: <b><a href=$htpath/index.php?action=template&nt=templates/$template/$language&t=custom_vacancy>".$lang['add']."</a></b> ($lang[184])<br><br>";}}
$vacancy_form.="<h4>$lang[1022]:</h4><br>
<table class=table width=100% cellspacing=0 cellpadding=10 border=0 style=\"background-color:".lighter($nc0,0)."; width:100%;\">
<tr><td valign=top style=\"background-color:".lighter($nc0,0)."\"><b>".$lang[1023]."*</b>$errorvc</td><td valign=top style=\"background-color:".lighter($nc0,0)."\"><input type=text name=vac_name size=10 value=\"".stripslashes(@$vac_name)."\" style=\"width:90%;\"></td></tr>
<tr><td valign=top style=\"background-color:".lighter($nc0,-5)."\"><b>".$lang[1024]."*</b>$errorvct</td><td valign=top style=\"background-color:".lighter($nc0,-5)."\"><input type=text name=vac_total size=10 value=\"".stripslashes(@$vac_total)."\" style=\"width:90%;\"></td></tr>
";



if (file_exists($vac_custom_file)) {
//custom fields exists, lets parese it to array
$vactmp=file($vac_custom_file);
$vacf=0;
while (list($vakey,$vaval)=each($vactmp)) {
$vaval=trim(trim($vaval));
if ($vaval!="") {
unset ($tmp);
$tmp=explode("|",$vaval);
if (trim($tmp[0])!=""){

if (($vacf/2)==round($vacf/2)) {$bgcolor=lighter($nc0,0);} else {$bgcolor=lighter($nc0,-5); }
if (($tmp[2]=="text")||($tmp[2]=="")) {
$vacancy_form.="<tr><td valign=top style=\"background-color:$bgcolor\"><b>".stripslashes($tmp[0])."".stripslashes($tmp[1])."</b></td><td valign=top style=\"background-color:$bgcolor\"><input type=text name=vac[".$vacf."] size=".$tmp[3]." value=\"".stripslashes(@$vac[$vacf])."\" style=\"width:90%;\"></td></tr>\n";
}
if ($tmp[2]=="textarea") {
$vacancy_form.="<tr><td valign=top style=\"background-color:$bgcolor\"><b>".stripslashes($tmp[0])."".stripslashes($tmp[1])."</b></td><td valign=top style=\"background-color:$bgcolor\"><textarea cols=64 rows=".$tmp[3]." name=vac[".$vacf."] style=\"width:90%;\">".stripslashes(@$vac[$vacf])."</textarea></td></tr>\n";
}
if ($tmp[2]=="checkbox") {
if (@$vac[$vacf]==1) {$checked=" checked";} else {$checked="";}
$vacancy_form.="<tr><td valign=top style=\"background-color:$bgcolor\"><b>".stripslashes($tmp[0])."".stripslashes($tmp[1])."</b></td><td valign=top style=\"background-color:$bgcolor\"><input type=checkbox"."$checked name=vac[".$vacf."] value=1></td></tr>\n";
}
$vacf+=1;
}
}
}

}
$vacancy_form.="<tr><td colspan=2>
<div align=center>
<input type=submit class=submit value=\"V&nbsp;&nbsp;".$lang[1022]."\">
</div>
</td></tr></table></form></div>";

}
}
//show vacancy
if (file_exists($vac_custom_file)) {
//custom fields exists, lets parese it to array
$vactmp=file($vac_custom_file);
$vacf=0;
while (list($vakey,$vaval)=each($vactmp)) {
$vaval=trim(trim($vaval));
if ($vaval!="") {
unset ($tmp);
$tmp=explode("|",$vaval);
if (trim($tmp[0])!=""){
$vacl[]=$vaval;
}
}
}
}
$vacancy_list2="<table width=100% cellspacing=0 cellpadding=10 class=shadow><tr><td valign=top style=\"background-color:".$nc10."; background-image: url(grad.php?h=46&w=1&e=".str_replace("#","", $nc10)."&s=".str_replace("#","", $nc10)."&d=vertical);\"><font size=3><b>".$lang[1023]."</b></font></td><td valign=top style=\"background-color:".$nc10."; background-image: url(grad.php?h=46&w=1&e=".str_replace("#","", $nc10)."&s=".str_replace("#","", $nc10)."&d=vertical);\" align=center><font size=3><b>".$lang[1024]."</b></font></td></tr>";
$vacf=0;
if (file_exists($vac_file)==TRUE) {
unset($tmpz,$key,$val);
$tmpz0=file($vac_file);
$tmpz=array_reverse($tmpz0);
unset($tmpz0);
while (list($key,$val)=each($tmpz)) {
unset ($tmp);
$val=trim(trim($val));
if ($val!=""){
$tmp=explode("|",$val);
if (trim($tmp[0])!="") {
if (($vacf/2)==round($vacf/2)) {$bgcolor=lighter($nc0,0);} else {$bgcolor=lighter($nc0,-5); }
reset($vacl);
$cvac="";
$ffv=0;
while (list($vackey,$vacval)=each($vacl)) {
$indx=($vackey+7);
unset ($tmp3);
$tmp3=explode("|",$vacval);
if ($tmp[$indx]!="") {
if ($tmp3[2]=="checkbox") {
if (@$tmp[$indx]==1) {$tmp[$indx]="$lang[1026]";} else {$tmp[$indx]=$lang[1027];}
}  else {
if (@$tmp[$indx]=="") {$tmp[$indx]="-";}
}
if (($ffv/2)==round($ffv/2)) {$bgcolor2=lighter($bgcolor,-5);} else {$bgcolor2=lighter($bgcolor,-12); }
$cvac.="<tr><td valign=top style=\"background-color:".$bgcolor2."\">".stripslashes($tmp3[0]).":</td><td valign=top style=\"background-color:".$bgcolor2."\"><i>".str_replace("\\", "", stripslashes($tmp[$indx]))."</i></td></tr>\n";
}
$ffv+=1;
}

if ($cvac!="") {$cvac="<br><br><b>$lang[1030]:</b><br><br>"."<table border=0 cellpadding=10 cellspacing=0 class=shadow>$cvac</table>";} else {$cvac="<br><br><b>$lang[1030]:</b> $lang[1036]"; }
$delvac="";
$sendbutton="";
if ($tmp[4]!="") {$sendbutton="<br><button class=btn type=button title=\"".$lang[1033]."\" onclick=\"document.location.href='"."mailto:".stripslashes($tmp[4])."?subject=".str_replace("_"," ", translit("$lang[1037] id".stripslashes($tmp[6])." ".stripslashes($tmp[0])." " . stripslashes($tmp[1])))."'\";><font color=#468847>V</font> ".$lang[1033]."</button>";}
$cvac2="<table border=0 width=100%><tr>
<td valign=top><small><a href=$htpath/index.php?action=vacancy&vac_id=$tmp[6]><font color=$nc3>#<b>".($vacf+1)."</b></font></a></small></td>
<td valign=top><small>$lang[1031]: <b>".date("d-m-Y H:i" ,$tmp[6])."</b></small></td>";
//$cvac.="<br>$lang[76]: <b>".$tmp[2]."</b>\n";
$cvac2.="<td valign=top><small>$lang[1034]: <b>".stripslashes($tmp[3])."</b></small></td>";
//$cvac.="<br>E-mail: <b>".$tmp[4]."</b>\n";
$cvac2.="<td valign=top><small>$lang[73]: <b>".stripslashes($tmp[5])."</b></small></td>";
$cvac2.="<td align=right valign=top><small><a href=$htpath/index.php?action=vacancy&vac_id=$tmp[6]><font color=$nc3>ID:".stripslashes($tmp[6])."</font></a></small></td></tr></table>";
if ($valid=="1") { if (($details[7]=="HR")||($details[7]=="ADMIN")||($details[7]=="MODER")) {$delvac="<br><button class=btn type=button title=\"".$lang[744]."\" onclick=\"document.location.href='"."$htpath/index.php?action=vacancy&vacdel=".stripslashes($tmp[6])."'\";><font color=#b94a48>X</font> ".$lang[744]."</button>";}}
$vacancy_list2.="<tr><td valign=top style=\"background-color:".$bgcolor."\"><font size=3><a href=$htpath/index.php?action=vacancy&vac_id=$tmp[6]><font color=$nc3><b>".stripslashes($tmp[0])."</b></font></a></font>$cvac</td><td style=\"background-color:".$bgcolor."\" align=center valign=top><font size=4>".stripslashes($tmp[1])."</font>$delvac$sendbutton</td></tr>
<tr><td colspan=2 style=\"background-color:".$bgcolor."\">$cvac2</td></tr>";
$vacf+=1;
}
}
}
}
$vacancy_list2.="</table><br><br>";

if ($vacf==0) { $vacancy_list.="<div class=well>".$lang[1028]."</div>"; } else {$vacancy_list.="$vacancy_list2";}

$vacancy_list.="$vacancy_form";
}
}
?>
