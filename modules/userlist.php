<?php
$sended=0;
$user_realname="";
$user_list="";
$chx_arr=Array();
$chx_arr1=Array();
$chx_arr2=Array();
$chx_arr3=Array();
$chx_arr4=Array();
$ffus6="";
$fuserm=0;
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
}

$user_realnnick="";
if (isset($_GET['sub'])) { $sub=$_GET['sub']; } elseif(isset($_POST['sub'])) { $sub=$_POST['sub']; } else { $sub=""; }
if (!preg_match('/^[0-9a-z]+$/i',$sub)) { $sub="";}
if(isset($_GET['usernickname'])) $usernickname=$_GET['usernickname']; elseif(isset($_POST['usernickname'])) $usernickname=$_POST['usernickname']; else $usernickname="";
if (!preg_match("/^[a-zA-Z0-9_\/\&\%\ -]+$/i",$usernickname)) { $usernickname="";}
if ($usernickname!="") {$user_realnnick=$usernickname; }
if ($usernickname=="") {


if ($portal==1) {
if ($sub=="send") {
if (is_array($_POST['chx'])) {
if (count($_POST['chx'])>0) {
//send to users
$chx_arr=array_flip($_POST['chx']);
}}
if (isset ($_POST['chx1'])) {
if (is_array($_POST['chx1'])) {
if (count($_POST['chx1'])>0) {
//send to firms
$chx_arr1=array_flip($_POST['chx1']);
}}}
if (is_array(@$_POST['chx2'])) {
if (count(@$_POST['chx2'])>0) {
//send to offices
$chx_arr2=array_flip($_POST['chx2']);
}}
if (is_array(@$_POST['chx3'])) {
if (count($_POST['chx3'])>0) {
//send to employees
$chx_arr3=array_flip($_POST['chx3']);
}}
if (is_array(@$_POST['chx4'])) {
if (count($_POST['chx4'])>0) {
//send to userstatus
$chx_arr4=array_flip($_POST['chx4']);
}}
if (isset($_POST['maild'])) {
if ($_POST['maild']=="YES") {
//send to email

}}
/*
var_dump ($chx_arr);
echo "<br>";
var_dump ($chx_arr1);
echo "<br>";
var_dump ($chx_arr2);
echo "<br>";
var_dump ($chx_arr3);
echo "<br>";
var_dump ($chx_arr4);
echo "<br>";
*/
if (isset($_POST['usubj'])) {
if ($_POST['usubj']=="YES") {
//send to email
$_POST['usubj']=stripslashes(trim(str_replace("\n","",$_POST['usubj'])));

}}
if (isset($_POST['umsg'])) {
if ($_POST['umsg']=="YES") {
//send to email
$_POST['umsg']=stripslashes(trim(str_replace("\n","<br>",$_POST['umsg'])));
}}
if (($_POST['umsg']!="") &&($_POST['usubj']!="")) {


$avafile="./admin/userstat/".$details[1]."/".$details[1].".ava";
if (!file_exists("./admin/userstat/".$details[1]."/".$details[1].".ava")) { $adava="$image_path/user.png"; } else {
$fp=fopen($avafile, "r");
$adava=trim(fread($fp,filesize($avafile)));
if ($adava=="") { $adava="$image_path/user.png"; } else { $adava="$htpath/gallery/avatars/$adava";}
}
$adava="<img src=$adava border=0>";

$user_list.=str_replace("\"","", str_replace("'","","<br><font color=$nc10><h4>".$lang[209]."</h4></font><br>"));

$handle=opendir('./admin/userstat/');
while (($f6 = readdir($handle))!==FALSE) {
if (($f6 == '.') || ($f6 == '..') || (substr($f6,-4) != '.txt')) {
continue;
} else {

$usrfile="./admin/userstat/$f6";
if (file_exists($usrfile)) {
$user_file=file($usrfile);

while (list($key,$val)=each ($user_file)) {
$tmp=explode("|", trim($val));
if ($user_realname=="") {$user_realname=trim($tmp[3]); }
$sendmes=0;

$idx=$tmp[1]; //nick
if (isset($chx_arr[$idx])) {$sendmes=1;}
$idx=$tmp[8]; //firm
if (isset($chx_arr1[$idx])) {$sendmes=1;}
$idx=strtoken($tmp[18]," (");  //office
if (isset($chx_arr2[$idx])) {$sendmes=1;}
$idx=$tmp[17]; //emloyee
if (isset($chx_arr3[$idx])) {$sendmes=1;}
$idx=$tmp[7]; //status
if (isset($chx_arr4[$idx])) {$sendmes=1;}
if ($sendmes==1) {
//$user_list.="$f6<br>\n";
$f6=str_replace(".txt","", $f6);
if (is_dir("./admin/userstat/$f6")==FALSE) { mkdir("./admin/userstat/$f6",0755); }
if (is_dir("./admin/userstat/$f6/messages")==FALSE) { mkdir("./admin/userstat/$f6/messages",0755); }
$mesfile="./admin/userstat/$f6/messages/mes.txt";
$fp=fopen($mesfile,"a");

fputs($fp,time()."|".str_replace("\n","<br>",strip_tags($_POST['usubj']))."|".str_replace("\n","<br>",strip_tags($_POST['umsg']))."||||".$details[1]."|".$details[3]."|".$details[7]."|".$details[8]."|".$details[17]."|".$details[18]."|$adava|\n");
fclose($fp);
$u_mesff="./admin/userstat/".$f6."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp, "<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br>".date("d-m-Y H:i", time())."<br><b>".$details[3]."</b><br>".$details[17]."<br><h4>".$_POST['usubj']."</h4>".$_POST['umsg']."<!-- goto --></td></tr></table>");
fclose ($fp);
}
}
}
}
}
closedir($handle);

$_POST['usubj']="";
$_POST['umsg']="";
} else {

//error
if ($_POST['usubj']=="") { $user_list.=str_replace("\"","", str_replace("'","","<font color=#b94a48><h4>".$lang[360]."</h4></font>")); }
if ($_POST['umsg']=="") { $user_list.=str_replace("\"","", str_replace("'","","<font color=#b94a48><h4>".$lang[362]."</h4></font>")); }



}

}
if ($sended==0) {
if ("$valid"=="1") {
$jsonload=""; $chx1=1;
$handle=opendir('./admin/userstat/');  $zzz=0;
while (($f6 = readdir($handle))!==FALSE) {
if (($f6 == '.') || ($f6 == '..') || (substr($f6,-4) != '.txt')) {
continue;
} else {

$usrfile="./admin/userstat/$f6";
if (file_exists($usrfile)) {
$user_file=file($usrfile);
$nic=substr($f6,0,(strlen($f6)-4));
$ava_image="";
if (file_exists("./admin/userstat/".$nic."/".$nic.".ava")) {
$ava_image=implode("", file("./admin/userstat/".$nic."/".$nic.".ava"));
}
if ($ava_image!="") {$ava_image="<img src=\"gallery/avatars/$ava_image\" border=0 title=\"$nic\" width=50 height=50 align=left style=\"margin:3px;\">";}
while (list($key,$val)=each ($user_file)) {
$tmp=explode("|", $val);
if ($user_realname=="") {$user_realname=trim($tmp[3]); }
$sortby=$tmp[3];
if ($sorting=="rate") { $sortby=$tmp[17]; }
if ($sorting=="date") { $sortby=strtoken($tmp[18]," ("); }

reset ($user_arr);
$customs="";
$birth="";
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_mass[6]=="birth") {
$birth=@preg_replace("([\D]+)", "", preg_replace('/\(([0-9]{1,6})\)/', '$1',  str_replace("-","", str_replace(".","",str_replace("\n","", trim (@$tmp[(20+$user_num)]))))));
$dd=doubleval(substr($birth,0,2));
$mm=doubleval(substr($birth,2,2));
$yy=doubleval(substr($birth,4,4));
if ($yy<100) { $yy=$yy+1900;}
$next_birth=mktime(0,0,0,$mm,$dd, date("y",time()));
$nextbyear=date("Y",time());
$nowtime=time();
$ddb=ceil((((($next_birth-$nowtime)/60)/60)/24)); //days before birthday
if ($ddb<0) {$next_birth=mktime(0,0,0,$mm,$dd, (1+date("Y",time())));  //next year
$nextbyear=(1+date("Y",time()));
$ddb=ceil((((($next_birth-$nowtime)/60)/60)/24)); //days before birthday

}
$stlb="";
$bir=0;
if ($ddb==0) {
$years=($nextbyear - $yy); $stlb=" class=round2 "; $bir=1; $ddb="<br><img src=\"$image_path/birthday.png\" border=0 title=\"$ddb\" align=absmiddle><font color=#b94a48 size=3><b>$lang[114]!</b></font>"; 
} else {
if (($ddb<=7)&&($ddb>0)) { $years=($nextbyear - $yy); $stlb=" class=round2"; $bir=1; $ddb="<br><img src=\"$image_path/birthday.png\" border=0 title=\"$ddb\" align=absmiddle>"; }  else { $years=($nextbyear - $yy - 1); if ($years>100) {$ddb="<br><font color=#b94a48><b>".$years."</b> ?!</font></font>"; } else {$ddb="</font>"; }  } //7 days before birthday
}
if ($dd<10) {$dd="0".$dd;}
if ($mm<10) {$mm="0".$mm;}

$br=$dd.".".$mm;
} else {
$value=str_replace("\n","", trim (@$tmp[(20+$user_num)]));
if ($value!="") {
$customs.="<b>".$user_mass[0].":</b> ".$value."<br>";
}
}
}
}
$proceed=1;
if ($sub=="birthday") { if ($bir==0) {$proceed=0;} else {$proceed=1;} }

if ($proceed==1) {
$user_listm[$zzz]="<!-- ".$sortby ." --><tr".$stlb."><td valign=top><input type=checkbox name=chx[$chx1] value=\"".$tmp[1] ."\" id=ch_$chx1></td><td valign=top><a href=\"index.php?action=userinfo&usernik=".$tmp[1] ."\">$ava_image".$tmp[3] ."</a><br><small><i>". $tmp[17]."</i><br>$customs</small></td>
<td style=\"white-space:nowrap;\" valign=top><small>$br"."$ddb</small></td><td style=\"white-space:nowrap;\" valign=top><img src=\"$image_path/phone.png\" border=0 hspace=5 align=absmiddle>";
if (($tmp[19]!="")&&($tmp[19]!="-")) { $user_listm[$zzz].="<small>(". $tmp[19].")</small> ";}
$user_listm[$zzz].=$tmp[5]."</td><td valign=top><small>". $tmp[8]."</small></td><td valign=top><small>". strtoken($tmp[18]," (")."</small></td><td valign=top><small><a href=\"mailto:$tmp[4]\">$tmp[4]</a></small></td></tr>\n";
$user_listm[$zzz]=str_replace("<td valign=top><small>ADMIN</small></td>", "<td valign=top><small><b>ADMIN</b></small></td>",$user_listm[$zzz]);
$jsonload.="document.getElementById('ch_".$chx1."').checked=ch;\n";
$idx=$tmp[8];
$uoption1[$idx]="$idx";
$idx=strtoken($tmp[18]," (");
$uoption2[$idx]="$idx";
$idx=$tmp[17];
$uoption3[$idx]="$idx";
$idx=$tmp[7];
$uoption4[$idx]="$idx";
$chx1++;
}
}
$zzz++;
}
}
}
closedir($handle);
reset($user_listm);
natcasesort($user_listm);
if ($way=="down") {$user_listm=array_reverse($user_listm); }
$uoption11="";
$uoption22="";
$uoption33="";
$uoption44="";
$chd=1;
reset($uoption1);
while (list($key,$val)=each ($uoption1)) {
$uoption11.="<input type=checkbox name=chx1[$chd] value=\"$val\" id=ch1_$chd>$val<br>\n";
$chd++;

}
$chd=1;
reset($uoption2);
while (list($key,$val)=each ($uoption2)) {
$uoption22.="<input type=checkbox name=chx2[$chd] value=\"$val\" id=ch2_$chd>$val<br>\n";
$chd++;

}
$chd=1;
reset($uoption3);
while (list($key,$val)=each ($uoption3)) {
$uoption33.="<input type=checkbox name=chx3[$chd] value=\"$val\" id=ch3_$chd>$val<br>\n";
$chd++;

}
$chd=1;
reset($uoption4);
while (list($key,$val)=each ($uoption4)) {
$uoption44.="<input type=checkbox name=chx4[$chd] value=\"$val\"ch4_$chd>$val<br>\n";
$chd++;

}
$uoption="<table border=0 cellpadding=5 width=100%>
<tr><td valign=top><b>$lang[158]</b></td><td valign=top><b>$lang[1468]</b></td><td valign=top><b>$lang[1467]</b></td><td valign=top><b>$lang[397]</b></td></tr>
<tr><td valign=top>$uoption11</td><td valign=top>$uoption22</td><td valign=top>$uoption33</td><td valign=top>$uoption44</td></tr></table>";
$b1="<img src=$image_path/sort_".$way.".png border=0";
$b2=$b1;
$b3=$b1;
if (($sorting=="")||($sorting=="name")) { $b2=""; $b3="";}
if ($sorting=="date") { $b1=""; $b3="";}
if ($sorting=="rate") { $b1=""; $b2="";}

if ($way=="down") {$away="up";} else {$away="down";}

$bname="<a href=\"index.php?action=$action&sorting=name&way=$way\"><b>$lang[75]</b></a> <a href=\"index.php?action=$action&sorting=name&way=$away\">$b1</a>";
$bdate="<a href=\"index.php?action=$action&sorting=date&way=$way\"><b>$lang[1472]</b></a> <a href=\"index.php?action=$action&sorting=date&way=$away\">$b2</a>";
$brate="<a href=\"index.php?action=$action&sorting=rate&way=$way\"><b>$lang[1023]</b></a> <a href=\"index.php?action=$action&sorting=rate&way=$away\">$b3</a>";
$user_list.="<h4>".$lang['adm5']."</h4>
<script language=\"javascript\">
<!--
function checkcheckbox() {
var ch=document.getElementById('chch').checked;
$jsonload
}
-->
</script>
<form method=POST action=index.php>
<input type=hidden name=action value=\"userlist\">
<input type=hidden name=sub value=\"send\">
<table border=0 cellpadding=5 class=round2 style=\"width:100%\">
<tr><td colspan=9>
$lang[1474]<br><br>
$lang[1475]<br><br>
</td>
</tr>
<tr>
<td colspan=2>$bname / $brate</td><td></td><td><b>$lang[497]</b></td><td></td><td>$bdate</td><td><b>$lang[645]</b></td></tr>".implode("\n", $user_listm)."
<tr><td valign=top><input type=\"checkbox\" name=\"to_all\" value=\"YES\" id=\"chch\" onclick=\"javascript:checkcheckbox();\"></td><td colspan=8 valign=top>
<b>".$lang[1479]."</b></td></tr>
<tr><td colspan=9 valign=top>
<br>$lang[1476]: <br><br>
$uoption

<h4>".$lang[1075].": </h4>
<table border=0 cellpadding=5 width=100%>
<tr><td valign=top style=\"white-space:nowrap;\">".$lang[1481]."</td><td width=100% valign=top><input type=text name=\"usubj\" size=20  style=\"width:100%\" value=\"".str_replace("<br>", "\n", str_replace("<", "&lt;",str_replace(">", "&gt;",@$_POST['usubj'])))."\"></td><td valign=top><font size=4 color=$nc10><b>*</b></font></td></tr>
<tr><td valign=top style=\"white-space:nowrap;\">".$lang[85]."</td><td width=100% valign=top><textarea name=\"umsg\" cols=40 rows=10 style=\"width:100%\">".str_replace("<br>", "\n", str_replace("<", "&lt;",str_replace(">", "&gt;",@$_POST['umsg'])))."</textarea></td><td valign=top><font size=4 color=$nc10><b>*</b></font></td></tr>
<tr><td>&nbsp;</td><td colspan=2>
<input type=checkbox name=maild value=\"YES\"> $lang[1477]<br>
<small>$lang[1478]</small><br><br>
<input type=submit name=submit value=\"".$lang[1480]."\">
</td>
</tr>
</table>

</td></tr></table>
</form>";


unset($user_file);

}
}
}
}


?>
