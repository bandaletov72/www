<?php
$tel_sps=Array();
$email_sps=Array();
if (isset($_GET['payment_sum'])) { $payment_sum=$_GET['payment_sum']; } elseif(isset($_POST['payment_sum'])) { $payment_sum=$_POST['payment_sum']; } else { $payment_sum=""; }
if (!preg_match('/^[0-9a-z\. ,]+$/i',$payment_sum)) { $payment_sum="";}
if (isset($_GET['transaction_id'])) { $transaction_id=$_GET['transaction_id']; } elseif(isset($_POST['transaction_id'])) { $transaction_id=$_POST['transaction_id']; } else { $transaction_id=""; }
if (!preg_match('/^[0-9a-z]+$/i',$transaction_id)) { $transaction_id="";}
$payment_sum=str_replace(" ", "", str_replace(",", ".",$payment_sum));
$payment_sum=doubleval($payment_sum);
if (isset($_GET['sub'])) { $sub=$_GET['sub']; } elseif(isset($_POST['sub'])) { $sub=$_POST['sub']; } else { $sub=""; }
if (!preg_match('/^[0-9a-z]+$/i',$sub)) { $sub="";}
//if ($user_wallet_enable==0) {$sub="";}
if (file_exists("./admin/userstat/.txt")) {
unlink("./admin/userstat/.txt");
}
$userf2="";
if ((!isset($_GET['login'])) && (!isset($_GET['password']))&& (!isset($_GET['password']))&&(!isset($_POST['password'])) ) {

$user_sps=Array();
$error="";
$user_list="";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if ($valid=="1") {
if (!isset($usertype)){$usertype="";} if (!preg_match("/^[0-9a-z]+$/i",$usertype)) { $usertype="";}
reset ($whsalerprice);
$oopt="";
while (list ($c_optk, $c_optl) = each ($whsalerprice)) {
if (($c_optk!="ADMIN")&&($c_optk!="MODER")&&($c_optk!="USER")&&($c_optk!="VIP")) {
$oopt.="<option>$c_optk</option>\n";
}
}

reset ($reg_as);

while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);

$setregid[$srrnum]=$srmasss[1];
$setregid2[$srrnum]=$srmasss[0];
}
}
if (!isset($userfile)){$userfile=0;} if (!preg_match("/^[0-9]+$/",$userfile)) { $userfile=0;}
if (!isset($usersort)){$usersort="no";} if (!preg_match("/^[a-z]+$/i",$usersort)) { $usersort="no";}
if (!isset($newuser)){$newuser=0;} if (!preg_match("/^[0-9]+$/",$newuser)) { $newuser=0;}
if ((!@$perpage) || (@$perpage=="")): $perpage=40; endif;
if ((!@$usernik) || (@$usernik=="")): $usernik=""; endif;
if ((!@$filter) || (@$filter=="")): $filter=""; endif;
$filter=toLower($filter);
if ((!@$change_nik) || (@$change_nik=="")): $change_nik=""; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$change_user) || (@$change_user=="")): $change_user=""; endif;
if ((!@$change_pass) || (@$change_pass=="")): $change_pass=""; endif;
if ((!@$change_status) || (@$change_status=="")): $change_status=""; endif;
$user_list="";
$ffus6="";
$fuserm=0;



if ($usertype=="mysql") {

//mysql
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) { } else {
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) {} else {
mysql_select_db($mysql_db_name);
if (mysql_errno()) {} else {

$error="";

if ($usernik!="") {

if ($change_nik!="") {

if ($user_log2==""){

$mysql_query="SELECT * FROM `".$users_table_name."` WHERE (`login`='".mysql_real_escape_string(@$usernik)."')";
$result=mysql_query("$mysql_query");
if (mysql_errno()) { $error.= "<center><div class=round align=center>$lang[391] `<b>$usernik</b>` - <font color=#b94a48>$lang[381] $lang[42]-1 ".mysql_error()."</font></div></center>"; } else {
$rows=mysql_num_rows($result);
if ($rows>0) {
$mysql_query="DELETE FROM `".$users_table_name."` WHERE `login`='".mysql_real_escape_string(@$usernik)."'";
mysql_query("$mysql_query");
if (mysql_errno()) { $error.="<center><div class=round align=center>$lang[391] `<b>$usernik</b>` - <font color=#b94a48>$lang[42]-2 ".mysql_error()."</font></div></center>"; } else { $error.="<center><div class=round align=center>$lang[391] `<b>$usernik</b>` - <b>$lang[209]</b></div></center>"; }
} else {
$error.= "<center><div class=round align=center>$lang[391] `<b>$usernik</b>` - <font color=#b94a48>$lang[381] $lang[42]-3 ".mysql_error()."</font></div></center>";
}
}
} else {
$arr2=array ("user_id2","user_log2","user_pass2","user_fio2","user_email2","user_tel2","user_gorod2","user_firm2" ,"user_status2" ,"user_metro2","user_street2","user_house2", "user_korp2", "user_pod2" ,"user_domophone2", "user_ofice2", "user_flat2", "user_dop2", "user_telcode2", "user_country2");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags($$a);
$$a = substr($$a, 0, 200);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "/", $$a);
$$a = str_replace("&lt;","<" ,  $$a);
$$a = str_replace("&gt;",">" ,  $$a);
$$a = str_replace("<br>", chr(10), $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = str_replace("\"" , "&#34;", $$a);
if(get_magic_quotes_gpc()) {$$a = stripslashes($$a);}
}

$q1="`user_type`='".mysql_real_escape_string($user_id2)."',".
"`login`='".mysql_real_escape_string($user_log2)."',".
"`password`='".mysql_real_escape_string($user_pass2)."',".
"`username`='".mysql_real_escape_string($user_fio2)."',".
"`email`='".mysql_real_escape_string($user_email2)."',".
"`tel`='".mysql_real_escape_string($user_tel2)."',".
"`date`='".mysql_real_escape_string($user_firm2)."',".
//"`status`='".mysql_real_escape_string($user_status2)."',".
"`metro`='".mysql_real_escape_string($user_metro2)."',".
"`street`='".mysql_real_escape_string($user_street2)."',".
"`house`='".mysql_real_escape_string($user_house2)."',".
"`building`='".mysql_real_escape_string($user_korp2)."',".
"`entrance`='".mysql_real_escape_string($user_pod2)."',".
"`doorcode`='".mysql_real_escape_string($user_domophone2)."',".
"`office_num`='".mysql_real_escape_string($user_ofice2)."',".
"`flat_num`='".mysql_real_escape_string($user_flat2)."',".
"`other_info`='".mysql_real_escape_string($user_dop2)."',".
"`city`='".mysql_real_escape_string($user_gorod2)."',".
"`country`='".mysql_real_escape_string($user_country2)."',".
"`telcode`='".mysql_real_escape_string($user_telcode2)."'";

$fuserm=0;
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);

while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_fm[$fuserm]) {
if(get_magic_quotes_gpc()) {@$user_fm[$fuserm] = stripslashes(@$user_fm[$fuserm]);}
$q1.=",`". mysql_real_escape_string(translit($user_mass[0]))."_".(20+$fuserm)."`='".@$user_fm[$fuserm]."'";
}
$fuserm+=1;
}
}
}


$mysql_query="UPDATE `".$users_table_name."` SET $q1 WHERE `login`='".mysql_real_escape_string(@$usernik)."' LIMIT 1";
//echo $mysql_query;
$result=mysql_query("$mysql_query");
if (mysql_errno()) {
$error.= "<center><div class=round align=center>$lang[42] MySQL-".mysql_errno()."</div></center>";
}  else {
$error.= "<center><div class=round align=center>$lang[209]</div></center>";
$change_nik="";
$user_nik=$user_log2;
}
}
}
}
$valids=0;
if (($change_status!="")&& ($change_user!="")&&($change_pass!="")) {
if ($details[7]=="MODER"){
if (toLower($change_status)=="admin") { $valids=0;} else {$valids=1;}
}
if ($details[7]=="ADMIN"){ $valids=1;}
if ($valids==1) {
$mysql_query="UPDATE `".$users_table_name."` SET `status`='".mysql_real_escape_string(@$change_status)."' WHERE `login`='".mysql_real_escape_string(@$change_user)."' AND `password`='".mysql_real_escape_string(@$change_pass)."' LIMIT 1";

$result=mysql_query("$mysql_query");
if (mysql_errno()) {
$error.= "<center><div class=round align=center>$lang[42] MySQL-".mysql_errno()."</div></center>";
}  else {
$error.= "<center><div class=round align=center>$lang[209]</div></center>";
$change_nik="";
}
}

}



if ($change_nik=="") {
$mysql_query="SELECT * FROM `".$users_table_name."` WHERE (`login`='".mysql_real_escape_string(@$usernik)."')";
$result=mysql_query("$mysql_query");

$s=0;
$userinfo="";
while($out1 = mysql_fetch_row($result))
  {
@$user_id1=@$out1[0];
@$user_log1=@$out1[1];
@$user_pass1=@$out1[2];
@$user_fio1=@$out1[3];
@$user_email1=@$out1[4];
@$user_tel1=@$out1[5];
@$user_firm1=@$out1[6];
@$user_status1=@$out1[7];
@$user_metro1=@$out1[8];
@$user_street1=@$out1[9];
@$user_house1=@$out1[10];
@$user_korp1=@$out1[11];
@$user_pod1=@$out1[12];
@$user_domophone1=@$out1[13];
@$user_ofice1=@$out1[14];
@$user_flat1=@$out1[15];
@$user_dop1=@$out1[16];
@$user_gorod1=@$out1[17];
@$user_country1=@$out1[18];
@$user_telcode1=@$out1[19];

$user_dop1 = str_replace("<br>" ,chr(10) , $user_dop1);

$userbutton="<p align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p>";  $us1=""; $us2="";
if (($details[7]=="MODER")||($details[7]=="DEMO")){
if ((@$user_status1=="ADMIN")||(@$user_status1=="MODER")) {$userbutton=""; $us1="<!-- "; $us2=" -->";}
}

$arr2=array ("user_id1","user_log1","user_pass1","user_fio1","user_email1","user_tel1","user_gorod1","user_firm1" ,"user_status1" ,"user_metro1","user_street1","user_house1", "user_korp1", "user_pod1" ,"user_domophone1", "user_ofice1", "user_flat1", "user_dop1", "user_telcode1", "user_country1");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags($$a);
$$a = substr($$a, 0, 200);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "/", $$a);
$$a = str_replace("&lt;","<" ,  $$a);
$$a = str_replace("&gt;",">" ,  $$a);
$$a = str_replace("<br>", chr(10), $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = str_replace("\"" , "&#34;", $$a);
if(get_magic_quotes_gpc()) {$$a = stripslashes($$a);}
}

$ffus6="";
$fuserm=0;
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);

while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
@$user_fm[$fuserm]=str_replace("\n","", trim (@$out1[(20+$fuserm)]));
if(get_magic_quotes_gpc()) {@$user_fm[$fuserm] = stripslashes(@$user_fm[$fuserm]);}
$ffus6.="<tr><td valign=top><b>".$user_mass[0].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" class=input-small size=\"12\" name=\"user_fm[$fuserm]\" value=\"".$user_fm[$fuserm]."\">$us2 ".$user_fm[$fuserm]."</td></tr>";
$fuserm+=1;
}
}
}

$delthis="<a href=\"#MD3\" role=\"button\" class=\"btn\" data-toggle=\"modal\"><i class=icon-remove></i> ".$lang[744]."</a><div class=\"modal hide\" id=\"MD3\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD3Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD3Label\">".$lang[744]."</h3>
</div>
<div class=\"modal-body\"><span class=\"label label-important\">".$lang[211]."</span> ".$lang[394]."<br><br><a class=\"btn\" href=\"".$_SERVER['PHP_SELF']."?user_log2=&usernik=$user_log1&action=view_users&change_nik=1$userf2&usersort=$usersort&usertype=$usertype\"><font color=red>&times;</font> ".$lang[391]." '$user_log1'</a></div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang['undo']."</a>
</div>
</div>";
$enterthis="<br><a href=\"#MD2\" role=\"button\" class=\"btn\" data-toggle=\"modal\">".$lang[1586]."</a><div class=\"modal hide\" id=\"MD2\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD2Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD2Label\">".$lang[1586]."</h3>
</div>
<div class=\"modal-body\">$lang[1121]: <b>".get_walet_total(md5($user_log1).md5(strrev($user_log1)))."</b> $init_currency<br><br>".get_walet_log(md5($user_log1).md5(strrev($user_log1)))."</div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</a>
<a class=\"btn btn-primary\" href=\"index.php?action=view_users&userfile=$userfile&usernik=$usernik&usersort=$usersort&filter=$filter&usertype=$usertype&sub=dellog\"><font color=white>".$lang[1597]."</font></a>
</div>
</div> &nbsp; <a class=btn href=\"#enter_user\" onclick=\"document.getElementById('userf').submit();\">".$lang[392]."</a>";
if ($details[7]=="DEMO"){$user_pass1=$lang[393]; $enterthis=""; $delthis="";}
if ($details[7]=="MODER"){if (($user_status1=="ADMIN")||($user_status1=="MODER")) {
 echo "$user_status1"; $enterthis=""; $user_pass1=$lang[393]; $delthis="";}}

$prop=""; if ($setregid[$user_id1]>1) { if((double)$user_house1>=1) {$lang[65]=$lang[1166];  $lang[61]=$lang[158]; $lang[68]=$lang[169]; $user_house1=doubleval($user_house1); $prop="(".@strtoken(@$property_mode[$user_house1],"|").") ";}}





$userinliststats="<a class=\"btn disabled\" title=\"".$lang[409]."\">".$lang[1591]."</a>";
if ((is_dir ("./admin/userstat/".$user_log1)==TRUE)) {
$handle=opendir("./admin/userstat/".$user_log1);
$userinliststats="<a href=\"#MD1\" role=\"button\" class=\"btn\" data-toggle=\"modal\">".$lang[1591]."</a>
<div class=\"modal hide\" id=\"MD1\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD1Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD1Label\">".$lang[1591]."</h3>
</div>
<div class=\"modal-body\">";

$userinliststatr=Array();
while (($files = readdir($handle))!==FALSE) {
if (($files == '.') || ($files == '..')|| ($files == 'wishlist.txt')|| ($files == 'flag.txt')|| ($files == 'userinlist.basket')|| ($files == 'lastvisit.time')|| ($files == 'lastvisit.url')) {
//wishlist
if ($files == 'wishlist.txt') {
$complexz.= "<br><br><a href='index.php?zak=wishlist'><b>".$lang[240]."</b> ".date("d.m.y H:i", filemtime("./admin/userstat/".@$details[1]."/$files"))."</a>\n";
}
continue;
} else {
if (@file_exists("./admin/orderstatus/$files")==FALSE) {
$zakstatus="<b>".$lang[243]."</b>";
} else {
$file = fopen ("./admin/orderstatus/$files", "r");
$zakstatus="<b>".fread ($file, filesize("./admin/orderstatus/$files"))."</b> ";
fclose ($file);
}
$userinliststatr[str_replace(".txt", "", $files)]= "<div class=round3><h4><a href='index.php?zak=".str_replace(".txt", "", $files)."'><b>".$lang[244]." #".str_replace(".txt", "", $files)."</b></a></h4><b>".$lang[371].":</b> <i>".date("d-m-Y H:i", @filemtime("./admin/userstat/".@$details[1]."/$files"))."</i><br><br>$zakstatus</div><br>\n";

}
}
closedir ($handle);

@krsort($userinliststatr);
@reset($userinliststatr);
$fu=0;
while ((list ($wn, $wl) = @each ($userinliststatr))&&($fu<50)) {
$userinliststats.=$wl;
$fu+=1;
}

$userinliststats.="</div>
<div class=\"modal-footer\">
<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</button>
</div>
</div>";
}





$userinfo="<form class=form-inline action=\"index.php\" method=\"POST\" id=userf>
<input type=hidden name=\"logout\" value=1>
<input type=hidden name=\"login\" value=\"$user_log1\">
<input type=hidden name=\"password\" value=\"$user_pass1\">
<input type=hidden name=\"usertype\" value=\"$usertype\">
</form>
<form class=form-inline action=\"index.php\" method=\"POST\">
<input type=hidden name=\"action\" value=\"view_users\">
<input type=hidden name=\"usersort\" value=\"$usersort\">
<input type=hidden name=\"usertype\" value=\"$usertype\">
<input type=hidden name=\"user_id2\" value=\"$user_id1\">
<input type=hidden name=\"userfile\" value=\"$userfile\">
<input type=hidden name=\"user_status2\" value=\"$user_status1\">
<input type=hidden name=\"change_nik\" value=\"1\">
<input type=hidden name=\"usernik\" value=\"$user_log1\">
<br><h4>".$lang[395]." `$user_log1`</h4>\n
<div class=round3>
<table width=100% cellpadding=5 cellspacing=0 border=0>
<tr><td valign=top><b>".$lang['login'].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" class=input-small size=\"12\" name=\"user_log2\" value=\"$user_log1\"><font color=#999999>$us2 $user_log1 &nbsp;&nbsp;</td></tr>
<tr><td valign=top><b>".$lang['pass'].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" class=input-small size=\"12\" name=\"user_pass2\" value=\"$user_pass1\"><font color=#999999>$us2 $user_pass1<br>$enterthis</td></tr>
</table>
</div>$userinliststats  &nbsp; $delthis
<div class=round3>
<table width=100% cellpadding=5 cellspacing=0 border=0>
<tr><td valign=top><b>".$lang[396].":</b></td><td valign=top width=100%><font color=#999999>$user_id1</font></td></tr>
<tr><td valign=top><b>".$lang[75].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"60\" name=\"user_fio2\" value=\"$user_fio1\"><font color=#999999><br>$us2$user_fio1</font></td></tr>
<tr><td valign=top><b>Email:</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"22\" name=\"user_email2\" value=\"$user_email1\"><font color=#999999>$us2 $user_email1</font></td></tr>
$ffus6
<tr><td valign=top><b>".$lang[167].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"32\" name=\"user_country2\" value=\"$user_country1\"><font color=#999999>$us2 $user_country1</font></td></tr>
<tr><td valign=top><b>".$lang[73].":</b></td><td valign=top width=100%>$us1 ( <input type=\"text\" class=input-small size=\"5\" name=\"user_telcode2\" value=\"$user_telcode1\"> ) <input type=\"text\" style=\"width:50%\" size=\"22\" name=\"user_tel2\" value=\"$user_tel1\"><font color=#999999>$us2 ($user_telcode1)$user_tel1</font></td></tr>
<tr><td valign=top><b>".$lang[337].":</b></td><td valign=top width=100%>$user_firm1$us1<input type=\"hidden\" size=\"32\" name=\"user_firm2\" value=\"$user_firm1\"><font color=#999999>$us2</font></td></tr>
<tr><td valign=top><b>".$lang[397].":</b></td><td valign=top width=100%>$user_status1</td></tr>
<tr><td valign=top><b>".$lang[72].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"32\" name=\"user_gorod2\" value=\"$user_gorod1\"><font color=#999999>$us2 $user_gorod1</font></td></tr>
<tr><td valign=top><b>".$lang[61].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"32\" name=\"user_metro2\" value=\"$user_metro1\"><font color=#999999>$us2 $prop"."$user_metro1</font></td></tr>
<tr><td valign=top><b>".$lang[71].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"60\" name=\"user_street2\" value=\"$user_street1\"><font color=#999999><br>$us2$user_street1</font></td></tr>
<tr><td valign=top><b>".$lang[68].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_house2\" value=\"$user_house1\"><font color=#999999>$us2 $user_house1 $prop</font></td></tr>
<tr><td valign=top><b>".$lang[67].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_korp2\" value=\"$user_korp1\"><font color=#999999>$us2 $user_korp1</font></td></tr>
<tr><td valign=top><b>".$lang[66].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_pod2\" value=\"$user_pod1\"><font color=#999999>$us2 $user_pod1</font></td></tr>
<tr><td valign=top><b>".$lang[69].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_domophone2\" value=\"$user_domophone1\"><font color=#999999>$us2 $user_domophone1</font></td></tr>
<tr><td valign=top><b>".$lang[65].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_ofice2\" value=\"$user_ofice1\"><font color=#999999>$us2 $user_ofice1</font></td></tr>
<tr><td valign=top><b>".$lang[64].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_flat2\" value=\"$user_flat1\"><font color=#999999>$us2 $user_flat1</font></td></tr>
<tr><td valign=top><b>".$lang[28].":</b></td><td valign=top width=100%>$us1<textarea style=\"width:96%\" rows=\"5\" cols=45 name=\"user_dop2\">$us2".$user_dop1."$us1</textarea><font color=#999999>$us2</font></td></tr>
</table>
</div>
";

if ($sub=="dellog") { $userinfo=del_walet_log(md5($user_log1).md5(strrev($user_log1))). $userinfo; }

$userinfo.="$userbutton</form><hr noshade size=1 color=#dadada>";
}

}










if ($usersort=="yes") {$orderby=" ORDER BY `login`";} else {$orderby=" ORDER BY `date`";}


$endlimit=($start+$perpage);
$mysql_query="SELECT * FROM `".$users_table_name."`";
if ($filter!="") {$mysql_query.=" WHERE `login` LIKE '%".$filter."%' OR `username` LIKE '%".$filter."%' OR `city` LIKE '%".$filter."%' OR `date` LIKE '%".$filter."%' OR `email` LIKE '%".$filter."%' OR `tel` LIKE '%".$filter."%' OR `metro` LIKE '%".$filter."%' OR `street` LIKE '%".$filter."%' OR `other_info` LIKE '%".$filter."%'";}
$mysql_query.=$orderby." LIMIT ".$start.",".$endlimit."";
//echo $mysql_query;
$result=mysql_query("$mysql_query");
$s=0;
$user_sps=Array();
$total=mysql_num_rows($result);

while($out = mysql_fetch_row($result))
  {
@$user_id=@$out[0];
@$user_log=@$out[1];
@$user_pass=@$out[2];
@$user_fio=@$out[3];
@$user_email=@$out[4];
@$user_tel=@$out[5];
@$user_firm=@$out[6];
@$user_status=@$out[7];
@$user_metro=@$out[8];
@$user_street=@$out[9];
@$user_house=@$out[10];
@$user_korp=@$out[11];
@$user_pod=@$out[12];
@$user_domophone=@$out[13];
@$user_ofice=@$out[14];
@$user_flat=@$out[15];
@$user_dop=@$out[16];
@$user_gorod=@$out[17];
@$user_country=@$out[18];
@$user_telcode=@$out[19];
$regorg=@$setregid2[$user_id];
if(($details[7]=="ADMIN")){$usersta="<option>ADMIN</option><option>MODER</option><option>DEMO</option><option>VIP</option><option>USER</option>$oopt"; }
if(($details[7]=="MODER")||($details[7]=="DEMO")){
$usersta="<option>DEMO</option><option>VIP</option><option>USER</option>$oopt";
if ((@$user_status=="ADMIN")||(@$user_status=="MODER")) { $usersta=""; }
}
if(($details[7]=="ADMIN")){$usersta="<option>ADMIN</option><option>MODER</option><option>DEMO</option><option>VIP</option><option>USER</option>$oopt"; }
if(($details[7]=="MODER")||($details[7]=="DEMO")){
$usersta="<option>DEMO</option><option>VIP</option><option>USER</option>$oopt";
if ((@$user_status=="ADMIN")||(@$user_status=="MODER")) { $usersta=""; }
}
if ($user_id==2) {$firm_sob=" ".strtoken($property_mode[doubleval($user_house)],"|")." "; }else {$firm_sob=" ";}
if (($regorg=="")&&($firm_sob==" ")&&($user_metro=="-"))  { $rega=""; } else {
$rega="$regorg<b>".$firm_sob."$user_metro</b><br>";}
$balans=""; if ($user_wallet_enable==1) {$balans="<td valign=top align=center>b_".md5($user_log).md5(strrev($user_log))."<a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=addmoney\"><img src=\"$image_path/money_add.png\" title=\"$lang[1122]\" border=0></a>&nbsp;&nbsp;<!--a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=remmoney\"><img src=\"$image_path/money_rem.png\" title=\"$lang[1161]\" border=0></a --></td><td><a class=btn href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=moneylog\" title=\"".$lang[1586]."\">i</a></td>";}
$user_sps[$s]= "<td valign=top><img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: ".lighter($nc3,100)."\"> <a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype\"><b>$user_log</b></a></td><td valign=top>$lang[75]:<br><b>$user_fio</b></td><td valign=top>".strtoken($user_firm," ")." $user_gorod<br>$rega</td><td valign=top><img src=$image_path/phone.png align=absmiddle>$user_telcode $user_tel</td><td valign=top align=right><form name=\"forma$s\" action=\"index.php\" method=\"GET\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=hidden name=\"usertype\" value=\"$usertype\"><input type=hidden name=\"usersort\" value=\"$usersort\"><input type=\"hidden\" name=\"userfile\" value=3><input type=\"hidden\" name=\"change_user\" value=\"$user_log\">
<input type=\"hidden\" name=\"filter\" value=\"".rawurldecode($filter)."\"><input type=\"hidden\" name=\"change_pass\" value=\"$user_pass\"><select name=\"change_status\" class=input-small onchange=\"javascript:document.forma$s.submit()\"><option selected>$user_status</option>$usersta</select></form></td>$balans\n\n|".md5($user_log).md5(strrev($user_log))."";
$s+=1;
  }
}
}
}
mysql_close($mysql_link);



$st=0;
while (list($kk,$vv)=each($user_sps)) {
if (is_long(($st/2)) == "TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
$val = "<tr bgcolor=$back>". $vv."</tr>";
$st += 1;
$user_list .= strtoken("$val","|");
}







$numberpages = (ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage-1;
if ($end > $total): $end=$total; endif;

$stat= "<center>".$lang[203]." <b>$numberpages</b> | ".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></center><br>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?action=view_users&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype\">" . ($s+1) . "</a> | ";
}
$s+=1;
}



$files_found=$total;





} else {
//files



if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")&&($change_nik!="")) {
if (($userfile==3)&&(@file_exists("./admin/userstat/$usernik.txt"))) {$file="./admin/userstat/$usernik.txt";
if ($user_log2=="") { unlink($file); }
}
}
}

$user_sps[0]="";
$s=0;
$files_found=0;

$handle=opendir("./admin/userstat/");
unset($fillez);
$ffl=0;
while (($file = readdir($handle))!==FALSE) {

if ((is_dir($file)==TRUE) ||(substr($file,-4)!=".txt")){
continue;
} else {
$fillez[$ffl]="./admin/userstat/$file";

$ffl+=1;

}
}

closedir ($handle);



if(($details[7]=="ADMIN")||($details[7]=="MODER")){
$file="./admin/db/tmp_users.txt";

if (($valid=="1")&&($newuser!=0)&&(@file_exists($file))) {
$file2="./admin/db/users.txt";
$f3=fopen($file,"r");
$newbies=fread($f3, filesize($file));
fclose($f3);
$f3=fopen($file2,"a");
fputs($f3, $newbies);
fclose($f3);
unlink ($file);
}
}


if(($details[7]=="ADMIN")||($details[7]=="MODER")){


if (($valid=="1")&&($change_nik!="")) {

$arr2=array ("user_id2","user_log2","user_pass2","user_fio2","user_email2","user_gorod2","user_tel2","user_firm2" ,"user_status2" ,"user_metro2","user_street2","user_house2", "user_korp2", "user_pod2" ,"user_domophone2", "user_ofice2", "user_flat2", "user_dop2", "user_telcode2","user_country2" ,);
while (list ($line_num, $a) = each ($arr2)) {
@$$a = strip_tags(@$$a);
$$a = substr($$a, 0, 200);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "/", $$a);
$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);
$$a = str_replace(chr(10) , "<br>", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = str_replace("\"" , "&#34;", $$a);
$$a = trim($$a);
if(get_magic_quotes_gpc()) {$$a = stripslashes($$a);}
}
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);

while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ((isset($user_fm[$fuserm])==FALSE)||(!preg_match("/^[à-ÿÀ-ßa-zA-Z0-9_\.\,\;\:\"\'\$\¹\#\@\!\+\=\?\&\ \%\(\)\/-]+$/i",$user_fm[$fuserm]))) {
$user_fm[$fuserm]="";
}

if(get_magic_quotes_gpc()) {$user_fm[$fuserm] = stripslashes($user_fm[$fuserm]);}
$ffus4.=$user_fm[$fuserm]."|";
$fuserm+=1;
}
}
}



$file="./admin/db/users.txt";
if (($userfile==2)&&(@file_exists($file))) {$file="./admin/db/tmp_users.txt"; }
if (($userfile==3)&&(@file_exists("./admin/userstat/$usernik.txt"))) {$file="./admin/userstat/$usernik.txt"; $userf2="&userfile=3";  }

$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=fgets($f3);


$out1=explode("|",$st3);
@$user_id1=@$out1[0];
if ($user_id1==""): continue; endif;
@$user_log1=@$out1[1];


if (($user_log1==$usernik)&&($user_log2!="")&&($user_pass2!="")){

$f_savea=$user_id2."|".$user_log2."|".$user_pass2."|".$user_fio2."|".$user_email2."|".$user_tel2."|".$user_firm2."|".$user_status2."|".$user_metro2."|".$user_street2."|".$user_house2."|".$user_korp2."|".$user_pod2."|".$user_domophone2."|".$user_ofice2."|".$user_flat2."|".$user_dop2."|".$user_gorod2."|".$user_country2."|".$user_telcode2."|$ffus4\n";
if ($details[7]=="MODER"){
if ((@$out1[7]=="ADMIN")||(@$out1[7]=="MODER")) {$f_savea=$st3;}
}
$f_save .=$f_savea;
} else {
if (($user_log2=="")&&($usernik==$user_log1)){

} else {
$f_save .=$st3;
}
}
}

fclose($f3);
$f3=fopen($file,"w");flock ($f3, LOCK_EX);
fputs ($f3, $f_save);flock ($f3, LOCK_UN);
fclose($f3);

}
}

if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")&&($usernik!="")) {

$file="./admin/db/users.txt"; $userf2="";
if (($userfile==2)&&(@file_exists($file))) {$file="./admin/db/tmp_users.txt"; $userf2="&userfile=2";  }
if (($userfile==3)&&(@file_exists("./admin/userstat/$usernik.txt"))) {$file="./admin/userstat/$usernik.txt"; $userf2="&userfile=3";  }
$f1=fopen($file,"r");
while(!feof($f1)) {
$st1=fgets($f1);


$out1=explode("|",$st1);
@$user_id1=@$out1[0];
if ($user_id1==""): continue; endif;
@$user_log1=@$out1[1];
@$user_pass1=@$out1[2];
@$user_fio1=@$out1[3];
@$user_email1=@$out1[4];
@$user_tel1=@$out1[5];
@$user_firm1=@$out1[6];
@$user_status1=@$out1[7];
@$user_metro1=@$out1[8];
@$user_street1=@$out1[9];
@$user_house1=@$out1[10];
@$user_korp1=@$out1[11];
@$user_pod1=@$out1[12];
@$user_domophone1=@$out1[13];
@$user_ofice1=@$out1[14];
@$user_flat1=@$out1[15];
@$user_dop1=@$out1[16];
@$user_gorod1=@$out1[17];
@$user_country1=@$out1[18];
@$user_telcode1=@$out1[19];

$user_dop1 = str_replace("<br>" ,chr(10) , $user_dop1);

$userbutton="<p align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p>";  $us1=""; $us2="";
if (($details[7]=="MODER")||($details[7]=="DEMO")){
if ((@$user_status1=="ADMIN")||(@$user_status1=="MODER")) {$userbutton=""; $us1="<!-- "; $us2=" -->";}
}
if ($user_log1==$usernik){

$arr2=array ("user_id1","user_log1","user_pass1","user_fio1","user_email1","user_tel1","user_gorod1","user_firm1" ,"user_status1" ,"user_metro1","user_street1","user_house1", "user_korp1", "user_pod1" ,"user_domophone1", "user_ofice1", "user_flat1", "user_dop1", "user_telcode1", "user_country1");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags($$a);
$$a = substr($$a, 0, 200);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "/", $$a);
$$a = str_replace("&lt;","<" ,  $$a);
$$a = str_replace("&gt;",">" ,  $$a);
$$a = str_replace("<br>", chr(10), $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = str_replace("\"" , "&#34;", $$a);
if(get_magic_quotes_gpc()) {$$a = stripslashes($$a);}
}

$ffus6="";
$fuserm=0;
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);

while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
@$user_fm[$fuserm]=str_replace("\n","", trim (@$out1[(20+$fuserm)]));
if(get_magic_quotes_gpc()) {@$user_fm[$fuserm] = stripslashes(@$user_fm[$fuserm]);}
$ffus6.="<tr><td valign=top><b>".$user_mass[0].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_fm[$fuserm]\" value=\"".$user_fm[$fuserm]."\">$us2 ".$user_fm[$fuserm]."</td></tr>";
$fuserm+=1;
}
}
}
$delthis="<a href=\"#MD3\" role=\"button\" class=\"btn\" data-toggle=\"modal\"><i class=icon-remove></i> ".$lang[744]."</a><div class=\"modal hide\" id=\"MD3\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD3Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD3Label\">".$lang[744]."</h3>
</div>
<div class=\"modal-body\"><span class=\"label label-important\">".$lang[211]."</span> ".$lang[394]."<br><br><a class=\"btn\" href=\"".$_SERVER['PHP_SELF']."?user_log2=&usernik=$user_log1&action=view_users&change_nik=1$userf2&usersort=$usersort&usertype=$usertype\"><font color=red>&times;</font> ".$lang[391]." '$user_log1'</a></div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang['undo']."</a>
</div>
</div>";

$enterthis="<br><a href=\"#MD2\" role=\"button\" class=\"btn\" data-toggle=\"modal\">".$lang[1586]."</a><div class=\"modal hide\" id=\"MD2\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD2Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD2Label\">".$lang[1586]."</h3>
</div>
<div class=\"modal-body\">$lang[1121]: <b>".get_walet_total(md5($user_log1).md5(strrev($user_log1)))."</b> $init_currency<br><br>".get_walet_log(md5($user_log1).md5(strrev($user_log1)))."</div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</a>
<a class=\"btn btn-primary\" href=\"index.php?action=view_users&userfile=$userfile&usernik=$usernik&usersort=$usersort&filter=$filter&usertype=$usertype&sub=dellog\"><font color=white>".$lang[1597]."</font></a>
</div>
</div> &nbsp; <a class=btn href=\"#enter_user\" onclick=\"document.getElementById('userf').submit();\">".$lang[392]."</a>";
if ($details[7]=="DEMO"){$user_pass1=$lang[393]; $enterthis=""; $delthis="";}
if ($details[7]=="MODER"){if (($user_status1=="ADMIN")||($user_status1=="MODER")) { echo "$user_status1"; $enterthis=""; $user_pass1=$lang[393]; $delthis="";}}

$prop=""; if (@$setregid[$user_id1]>1) { if((double)$user_house1>=1) {$lang[65]=$lang[1166];  $lang[61]=$lang[158]; $lang[68]=$lang[169]; $user_house1=doubleval($user_house1); $prop="(".@strtoken(@$property_mode[$user_house1],"|").") ";}}






$userinliststats="<a class=\"btn disabled\" title=\"".$lang[409]."\">".$lang[1591]."</a>";
if ((is_dir ("./admin/userstat/".$user_log1)==TRUE)) {
$handle=opendir("./admin/userstat/".$user_log1);
$userinliststats="<a href=\"#MD1\" role=\"button\" class=\"btn\" data-toggle=\"modal\">".$lang[1591]."</a><div class=\"modal hide\" id=\"MD1\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD1Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD1Label\">".$lang[1591]."</h3>
</div>
<div class=\"modal-body\">";


$userinliststatr=Array();
while (($files = readdir($handle))!==FALSE) {
if (($files == '.') || ($files == '..')|| ($files == 'wishlist.txt')|| ($files == 'flag.txt')|| ($files == 'userinlist.basket')|| ($files == 'lastvisit.time')|| ($files == 'lastvisit.url')) {
//wishlist
if ($files == 'wishlist.txt') {
$complexz.= "<br><br><a href='index.php?zak=wishlist'><b>".$lang[240]."</b> ".date("d.m.y H:i", filemtime("./admin/userstat/".@$details[1]."/$files"))."</a>\n";
}
continue;
} else {
if (@file_exists("./admin/orderstatus/$files")==FALSE) {
$zakstatus="<b>".$lang[243]."</b>";
} else {
$file = fopen ("./admin/orderstatus/$files", "r");
$zakstatus="<b>".fread ($file, filesize("./admin/orderstatus/$files"))."</b> ";
fclose ($file);
}
$userinliststatr[str_replace(".txt", "", $files)]= "<div class=round3><h4><a href='index.php?zak=".str_replace(".txt", "", $files)."'><b>".$lang[244]." #".str_replace(".txt", "", $files)."</b></a></h4><b>".$lang[371].":</b> <i>".date("d-m-Y H:i", @filemtime("./admin/userstat/".@$details[1]."/$files"))."</i><br><br>$zakstatus</div><br>\n";

}
}
closedir ($handle);

@krsort($userinliststatr);
@reset($userinliststatr);
$fu=0;
while ((list ($wn, $wl) = @each ($userinliststatr))&&($fu<50)) {
$userinliststats.=$wl;
$fu+=1;
}
$userinliststats.="</div>
<div class=\"modal-footer\">
<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</button>
</div>
</div>";
}






$userinfo="<form class=form-inline action=\"index.php\" method=\"POST\" id=userf>
<input type=hidden name=\"logout\" value=1>
<input type=hidden name=\"login\" value=\"$user_log1\">
<input type=hidden name=\"password\" value=\"$user_pass1\">
<input type=hidden name=\"usertype\" value=\"$usertype\">
</form>
<form class=form-inline action=\"index.php\" method=\"POST\">
<input type=hidden name=\"action\" value=\"view_users\">
<input type=hidden name=\"usersort\" value=\"$usersort\">
<input type=hidden name=\"user_id2\" value=\"$user_id1\">
<input type=hidden name=\"userfile\" value=\"$userfile\">
<input type=hidden name=\"user_status2\" value=\"$user_status1\">
<input type=hidden name=\"change_nik\" value=\"1\">
<input type=hidden name=\"usernik\" value=\"$user_log1\">
<div class=well><h4>".$lang[395]." \"$user_log1\":</h4></div>
<table width=100% cellpadding=5 cellspacing=0 border=0 class=table>
<tr><td valign=top><b>".$lang['login'].":</b></td><td valign=top width=100%>$us1<input type=\"hidden\" size=\"12\" name=\"user_log2\" value=\"$user_log1\">$us2 $user_log1 &nbsp;&nbsp;</td></tr>
<tr><td valign=top><b>".$lang['pass'].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_pass2\" value=\"$user_pass1\">$us2 $user_pass1<br>$enterthis &nbsp; $userinliststats &nbsp; $delthis &nbsp;
</td></tr>
<tr><td valign=top><b>".$lang[396].":</b></td><td valign=top width=100%>$user_id1</td></tr>
<tr><td valign=top><b>".$lang[75].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"60\" name=\"user_fio2\" value=\"$user_fio1\"><br>$us2$user_fio1</td></tr>
<tr><td valign=top><b>Email:</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"22\" name=\"user_email2\" value=\"$user_email1\">$us2 $user_email1</td></tr>
$ffus6
<tr><td valign=top><b>".$lang[167].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"32\" name=\"user_country2\" value=\"$user_country1\">$us2 $user_country1</td></tr>
<tr><td valign=top><b>".$lang[73].":</b></td><td valign=top width=100%>$us1 ( <input type=\"text\" class=input-small size=\"5\" name=\"user_telcode2\" value=\"$user_telcode1\"> ) <input type=\"text\" style=\"width:50%\" size=\"22\" name=\"user_tel2\" value=\"$user_tel1\">$us2 ($user_telcode1)$user_tel1</td></tr>
<tr><td valign=top><b>".$lang[337].":</b></td><td valign=top width=100%>$user_firm1$us1<input type=\"hidden\" size=\"32\" name=\"user_firm2\" value=\"$user_firm1\">$us2</td></tr>
<tr><td valign=top><b>".$lang[397].":</b></td><td valign=top width=100%>$user_status1</td></tr>
<tr><td valign=top><b>".$lang[72].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"32\" name=\"user_gorod2\" value=\"$user_gorod1\">$us2 $user_gorod1</td></tr>
<tr><td valign=top><b>".$lang[61].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"32\" name=\"user_metro2\" value=\"$user_metro1\">$us2 $prop"."$user_metro1</td></tr>
<tr><td valign=top><b>".$lang[71].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"60\" name=\"user_street2\" value=\"$user_street1\"><br>$us2$user_street1</td></tr>
<tr><td valign=top><b>".$lang[68].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_house2\" value=\"$user_house1\">$us2 $user_house1 $prop</td></tr>
<tr><td valign=top><b>".$lang[67].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_korp2\" value=\"$user_korp1\">$us2 $user_korp1</td></tr>
<tr><td valign=top><b>".$lang[66].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_pod2\" value=\"$user_pod1\">$us2 $user_pod1</td></tr>
<tr><td valign=top><b>".$lang[69].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_domophone2\" value=\"$user_domophone1\">$us2 $user_domophone1</td></tr>
<tr><td valign=top><b>".$lang[65].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_ofice2\" value=\"$user_ofice1\">$us2 $user_ofice1</td></tr>
<tr><td valign=top><b>".$lang[64].":</b></td><td valign=top width=100%>$us1<input type=\"text\" style=\"width:96%\" size=\"12\" name=\"user_flat2\" value=\"$user_flat1\">$us2 $user_flat1</td></tr>
<tr><td valign=top><b>".$lang[28].":</b></td><td valign=top width=100%>$us1<textarea style=\"width:96%\" rows=\"5\" cols=45 name=\"user_dop2\">$us2".$user_dop1."$us1</textarea>$us2</td></tr>
</table>";

if ($sub=="dellog") { $userinfo=del_walet_log(md5($user_log1).md5(strrev($user_log1))). $userinfo; }

$userinfo.="$userbutton</form><hr noshade size=1 color=#dadada>";
if ($sub=="addmoney") { $addmoneyform="<br><div class=well><table border=0 width=100%><tr><td><b><i class=icon-user></i>$user_log1</b></td><td>$user_fio1</td><td><img src=\"$image_path/phone.png\" border=0 align=absmiddle>($user_telcode1) $user_tel1</td><td align=right>$lang[1121]: <b>".get_walet_total(md5($user_log1).md5(strrev($user_log1)))."</b> $init_currency</td></tr></table>
<form class=form-inline action=index.php method=POST>
<input type=hidden name=action value=\"view_users\">
<input type=hidden name=userfile value=\"$userfile\">
<input type=hidden name=usernik value=\"$user_log1\">
<input type=hidden name=usersort value=\"$usersort\">
<input type=hidden name=filter value=\"$filter\">
<input type=hidden name=transaction_id value=\"".md5($secret_salt.$user_log1).md5($secret_salt.time())."\">
<input type=hidden name=sub value=\"$sub\"><hr noshade color=$nc10 size=1>
<table border=0><tr><td style=\"white-space:nowrap;\">$lang[1117]:</td><td><input type=text name=\"payment_sum\" value=\"\" size=20></td><td style=\"white-space:nowrap;\"><b>$init_currency</b></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type=submit class=\"btn btn-primary\" value=\"$lang[1122]\"></td></tr></table><br><i class=muted>$lang[1114]</i></form></div>";
if ($payment_sum>0) {
//popolneniye scheta
$ret="";
if (!isset($_SESSION[$transaction_id])) {
$ret=add_walet(md5($user_log1).md5(strrev($user_log1)), $payment_sum,  "$init_currency");
if ($ret=="OK") {
//uspeshno
$addmoneyform="<br><div class=well><table border=0 width=100%><tr><td><b><i class=icon-user></i>$user_log1</b></td><td>$user_fio1</td><td><img src=\"$image_path/phone.png\" border=0 align=absmiddle>($user_telcode1) $user_tel1</td><td align=right>$lang[1121]: <b>".get_walet_total(md5($user_log1).md5(strrev($user_log1)))."</b> $init_currency</td></tr></table>
<form class=form-inline action=index.php method=POST>
<input type=hidden name=action value=\"view_users\">
<input type=hidden name=userfile value=\"$userfile\">
<input type=hidden name=usernik value=\"$user_log1\">
<input type=hidden name=usersort value=\"$usersort\">
<input type=hidden name=filter value=\"$filter\">
<input type=hidden name=transaction_id value=\"".md5($secret_salt.$user_log1).md5($secret_salt.time())."\">
<input type=hidden name=sub value=\"$sub\"><hr noshade color=$nc10 size=1>
<table border=0><tr><td style=\"white-space:nowrap;\">$lang[1117]:</td><td><input type=text name=\"payment_sum\" value=\"\" size=20></td><td style=\"white-space:nowrap;\"><b>$init_currency</b></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type=submit class=\"btn btn-primary\" value=\"$lang[1122]\"></td></tr></table><br><i class=muted>$lang[1114]</i></form></div>";

$userinfo="<br><div class=well><h4><font color=#468847>$lang[1147]: <b>$payment_sum</b> $init_currency</font></h4></div>$addmoneyform";
@$_SESSION[$transaction_id]=1;
} else {
//neudachnaya tranzakciya
$userinfo="<br><div class=well><h4><font color=#b94a48>$lang[1149]</font></h4></div>$ret$addmoneyform";

}
} else {
//tranzaciya sushestvuuet
$userinfo="<br><div class=well><h4><font color=#b94a48>$lang[1148]</font></h4></div>$ret$addmoneyform";

}
} else {
//popolnenie sheta forma menee 0
$userinfo="$addmoneyform</div>";
}
}


if ($sub=="moneylog") {
$waltotal=get_walet_total(md5($user_log1).md5(strrev($user_log1)));

$userinfo="<br><div class=well><h4><font color=#b94a48>$lang[1586] '".$user_log1."'</font></h4></div>";
$userinfo.=get_walet_log(md5($user_log1).md5(strrev($user_log1)));

continue;
}



if ($sub=="remmoney") {
$waltotal=get_walet_total(md5($user_log1).md5(strrev($user_log1)));
if ($waltotal>0) {
$addmoneyform="<br><div class=well><table border=0 width=100%><tr><td><b><i class=icon-user></i>$user_log1</b></td><td>$user_fio1</td><td><img src=\"$image_path/phone.png\" border=0 align=absmiddle>($user_telcode1) $user_tel1</td><td align=right>$lang[1121]: <b>$waltotal</b> $init_currency</td></tr></table>
<form class=form-inline action=index.php method=POST>
<input type=hidden name=action value=\"view_users\">
<input type=hidden name=userfile value=\"$userfile\">
<input type=hidden name=usernik value=\"$user_log1\">
<input type=hidden name=usersort value=\"$usersort\">
<input type=hidden name=filter value=\"$filter\">
<input type=hidden name=transaction_id value=\"".md5($secret_salt.$user_log1).md5($secret_salt.time())."\">
<input type=hidden name=sub value=\"$sub\"><hr noshade color=$nc10 size=1>
<table border=0><tr><td style=\"white-space:nowrap;\">$lang[1162]:</td><td><input type=text name=\"payment_sum\" value=\"$waltotal\" size=20></td><td style=\"white-space:nowrap;\"><b>$init_currency</b></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type=submit class=\"btn btn-primary\" value=\"$lang[1161]\"></td></tr></table><br><i class=muted>$lang[1114]</i></form></div>";
if ($payment_sum>0) {
//popolneniye scheta
$ret="";
if (!isset($_SESSION["rem".$transaction_id])) {
$ret=rem_walet(md5($user_log1).md5(strrev($user_log1)), $payment_sum,  "$init_currency");
if ($ret=="OK") {
//uspeshno
$waltotal=get_walet_total(md5($user_log1).md5(strrev($user_log1)));
$addmoneyform="<br><div class=well><table border=0 width=100%><tr><td><b><i class=icon-user></i>$user_log1</b></td><td>$user_fio1</td><td><img src=\"$image_path/phone.png\" border=0 align=absmiddle>($user_telcode1) $user_tel1</td><td align=right>$lang[1121]: <b>$waltotal</b> $init_currency</td></tr></table>
<form class=form-inline action=index.php method=POST>
<input type=hidden name=action value=\"view_users\">
<input type=hidden name=userfile value=\"$userfile\">
<input type=hidden name=usernik value=\"$user_log1\">
<input type=hidden name=usersort value=\"$usersort\">
<input type=hidden name=filter value=\"$filter\">
<input type=hidden name=transaction_id value=\"".md5($secret_salt.$user_log1).md5($secret_salt.time())."\">
<input type=hidden name=sub value=\"$sub\"><hr noshade color=$nc10 size=1>
<table border=0><tr><td style=\"white-space:nowrap;\">$lang[1162]:</td><td><input type=text name=\"payment_sum\" value=\"$waltotal\" size=20></td><td style=\"white-space:nowrap;\"><b>$init_currency</b></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type=submit class=\"btn btn-primary\" value=\"$lang[1161]\"></td></tr></table><br><i class=muted>$lang[1114]</i></form></div>";

$userinfo="<br><div class=well><h4><font color=#468847>$lang[1163]: <b>$payment_sum</b> $init_currency</font></h4></div>";
if ($waltotal>0) {$userinfo="$addmoneyform";}
@$_SESSION["rem".$transaction_id]=1;
} else {
//neudachnaya tranzakciya
$userinfo="<br><div class=well><h4><font color=#b94a48>$lang[1149]</font></h4></div>$ret$addmoneyform";

}
} else {
//tranzaciya sushestvuuet
$userinfo="<br><div class=well><h4><font color=#b94a48>$lang[1164]</font></h4></div>$addmoneyform";

}
} else {
//menee 0
$userinfo="$addmoneyform";
}
}
continue;
}
}
}

fclose($f1);
}
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")&&($change_user!="")&&($change_pass!="")&&($change_status!="1")) {


$file="./admin/db/users.txt";
if (($userfile==2)&&(@file_exists($file))) {$file="./admin/db/tmp_users.txt"; }
if (($userfile==3)&&(@file_exists("./admin/userstat/$change_user.txt"))) {$file="./admin/userstat/$change_user.txt"; $userf2="&userfile=3";  }

$f=fopen($file,"r");
$users_sps="";
while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);
@$user_id=@$out[0];
if ($user_id==""): continue; endif;
@$user_log=@$out[1];
@$user_pass=@$out[2];
@$user_fio=@$out[3];
@$user_email=@$out[4];
@$user_tel=@$out[5];
@$user_firm=@$out[6];
@$user_status=@$out[7];
@$user_metro=@$out[8];
@$user_street=@$out[9];
@$user_house=@$out[10];
@$user_korp=@$out[11];
@$user_pod=@$out[12];
@$user_domophone=@$out[13];
@$user_ofice=@$out[14];
@$user_flat=@$out[15];
@$user_dop=@$out[16];
@$user_gorod=@$out[17];
@$user_country=@$out[18];
@$user_telcode=@$out[19];
$ffus8="";
$fuserm=0;
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);

while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
@$user_fm[$fuserm]=str_replace("\n","", trim (@$out[(20+$fuserm)]));
if(get_magic_quotes_gpc()) {@$user_fm[$fuserm] = stripslashes(@$user_fm[$fuserm]);}
$ffus8.=$user_fm[$fuserm]."|";
$fuserm+=1;
}
}
}

if (($change_user=="$user_log")&&($change_pass=="$user_pass")) {
if($details[7]=="MODER"){
if (($change_status!="ADMIN")&&($change_status!="MODER")&&($user_status!="ADMIN")&&($user_status!="MODER")){
$users_spsa= "$user_id|$user_log|$user_pass|$user_fio|$user_email|$user_tel|$user_firm|$change_status|$user_metro|$user_street|$user_house|$user_korp|$user_pod|$user_domophone|$user_ofice|$user_flat|$user_dop|$user_gorod|$user_country|$user_telcode|$ffus8\n";
} else {
$users_spsa= "$user_id|$user_log|$user_pass|$user_fio|$user_email|$user_tel|$user_firm|$user_status|$user_metro|$user_street|$user_house|$user_korp|$user_pod|$user_domophone|$user_ofice|$user_flat|$user_dop|$user_gorod|$user_country|$user_telcode|$ffus8\n";
}
} else {
$users_spsa= "$user_id|$user_log|$user_pass|$user_fio|$user_email|$user_tel|$user_firm|$change_status|$user_metro|$user_street|$user_house|$user_korp|$user_pod|$user_domophone|$user_ofice|$user_flat|$user_dop|$user_gorod|$user_country|$user_telcode|$ffus8\n";
}
} else {
$users_spsa= "$user_id|$user_log|$user_pass|$user_fio|$user_email|$user_tel|$user_firm|$user_status|$user_metro|$user_street|$user_house|$user_korp|$user_pod|$user_domophone|$user_ofice|$user_flat|$user_dop|$user_gorod|$user_country|$user_telcode|$ffus8\n";
}
$users_sps.=$users_spsa;
}


fclose($f);
$f=fopen($file,"w");
fputs ($f, $users_sps);
fclose($f);
}
}




$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;

$st="";

$file="./admin/db/users.txt";
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);

$out=explode("|",$st);
@$user_id=@$out[0];
if (($user_id=="")||($user_id=="\n")): continue; endif;
@$user_log=@$out[1];
@$user_pass=@$out[2];
@$user_fio=@$out[3];
@$user_email=@$out[4];
@$user_tel=@$out[5];
@$user_firm=@$out[6];
@$user_status=@$out[7];
@$user_metro=@$out[8];
@$user_street=@$out[9];
@$user_house=@$out[10];
@$user_korp=@$out[11];
@$user_pod=@$out[12];
@$user_domophone=@$out[13];
@$user_ofice=@$out[14];
@$user_flat=@$out[15];
@$user_dop=@$out[16];
@$user_gorod=@$out[17];
@$user_country=@$out[18];
@$user_telcode=@$out[19];

if(($details[7]=="ADMIN")){$usersta="<option>ADMIN</option><option>MODER</option><option>DEMO</option><option>VIP</option><option>USER</option>$oopt"; }
if(($details[7]=="MODER")||($details[7]=="DEMO")){
$usersta="<option>DEMO</option><option>VIP</option><option>USER</option>$oopt";
if ((@$user_status=="ADMIN")||(@$user_status=="MODER")) { $usersta=""; }
}
if ($user_id==2) {$firm_sob=" ".strtoken($property_mode[doubleval($user_house)],"|")." "; }else {$firm_sob=" ";}
if ($usersort=="no"){$datem=@explode(".", @strtoken(@$out[6]," "));$ddatum=240*(doubleval($datem[0])+doubleval($datem[1])*31+365*(2000+doubleval($datem[2])))+$s;  $sortuserby=$ddatum; if((@$user_status=="ADMIN")||(@$user_status=="MODER")){$sortuserby=999999999-$s;} } else { $sortuserby="999999999$user_log"; if((@$user_status=="ADMIN")||(@$user_status=="MODER")){$sortuserby=999999999-$s;}}
if (($regorg=="")&&($firm_sob==" ")&&($user_metro=="-"))  { $rega=""; } else {
$rega="$regorg<b>".$firm_sob."$user_metro</b><br>";}
$balans=""; if ($user_wallet_enable==1) {$balans="<td valign=top align=center>b_".md5($user_log).md5(strrev($user_log))."<a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=addmoney\"><img src=\"$image_path/money_add.png\" title=\"$lang[1122]\" border=0></a>&nbsp;&nbsp;<!--a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=remmoney\"><img src=\"$image_path/money_rem.png\" title=\"$lang[1161]\" border=0></a--></td><td><a class=btn href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=moneylog\" title=\"".$lang[1586]."\">i</a></td>";}

$user_sps[$s]= "<!-- $sortuserby --><td valign=top><img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: #9999FF\"> <a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype\"><b>$user_log</b></a></td><td valign=top>$lang[75]:<br><b>$user_fio</b></td><td valign=top>".strtoken($user_firm," ")." $user_gorod<br>$rega</td><td valign=top><img src=$image_path/phone.png align=absmiddle>$user_telcode $user_tel</td><td valign=top align=right><form name=\"forma$s\" action=\"index.php\" method=\"GET\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=hidden name=\"usersort\" value=\"$usersort\"><input type=\"hidden\" name=\"userfile\" value=3><input type=\"hidden\" name=\"change_user\" value=\"$user_log\">
<input type=\"hidden\" name=\"filter\" value=\"".rawurldecode($filter)."\"><input type=\"hidden\" name=\"change_pass\" value=\"$user_pass\"><select class=input-small name=\"change_status\" onchange=\"javascript:document.forma$s.submit()\"><option selected>$user_status</option>$usersta</select></form></td>$balans\n\n|".md5($user_log).md5(strrev($user_log))."";
if ($filter!="") {
if (preg_match("/$filter/i", toLower($st))!=TRUE) {
unset($user_sps[$s]); } else {
$files_found += 1;
$s+=1;
}
} else {
$files_found += 1;
$s+=1;
}
}

fclose($f);

$file="./admin/db/tmp_users.txt";
if (@file_exists($file)) {
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);

$out=explode("|",$st);
@$user_id=@$out[0];
if (($user_id=="")||($user_id=="\n")): continue; endif;
@$user_log=@$out[1];
@$user_pass=@$out[2];
@$user_fio=@$out[3];
@$user_email=@$out[4];
@$user_tel=@$out[5];
@$user_firm=@$out[6];
@$user_status=@$out[7];
@$user_metro=@$out[8];
@$user_street=@$out[9];
@$user_house=@$out[10];
@$user_korp=@$out[11];
@$user_pod=@$out[12];
@$user_domophone=@$out[13];
@$user_ofice=@$out[14];
@$user_flat=@$out[15];
@$user_dop=@$out[16];
@$user_gorod=@$out[17];
@$user_country=@$out[18];
@$user_telcode=@$out[19];

if(($details[7]=="ADMIN")){$usersta="<option>ADMIN</option><option>MODER</option><option>DEMO</option><option>VIP</option><option>USER</option>$oopt"; }
if(($details[7]=="MODER")||($details[7]=="DEMO")){
$usersta="<option>DEMO</option><option>VIP</option><option>USER</option>$oopt";
if ((@$user_status=="ADMIN")||(@$user_status=="MODER")) { $usersta=""; }
}
if ($usersort=="no"){$datem=@explode(".", @strtoken(@$out[6]," "));$ddatum=240*(doubleval($datem[0])+doubleval($datem[1])*31+365*(2000+doubleval($datem[2])))+$s;  $sortuserby=$ddatum; if((@$user_status=="ADMIN")||(@$user_status=="MODER")){$sortuserby=999999999-$s;} } else { $sortuserby="$user_log"; if((@$user_status=="ADMIN")||(@$user_status=="MODER")){$sortuserby="";}}
$balans=""; if ($user_wallet_enable==1) {$balans="<td valign=top align=center>b_".md5($user_log).md5(strrev($user_log))."<a href=\"" . $htpath . "/index.php?action=view_users&userfile=2&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=addmoney\"><img src=\"$image_path/money_add.png\" title=\"$lang[1122]\" border=0></a>&nbsp;&nbsp;<!--a href=\"" . $htpath . "/index.php?action=view_users&userfile=2&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=remmoney\"><img src=\"$image_path/money_rem.png\" title=\"$lang[1161]\" border=0></a--></td><td><a class=btn href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=moneylog\" title=\"".$lang[1586]."\">i</a></td>";}

$user_sps[$s]= "<!-- $sortuserby --><td valign=top><img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: #99FF99\"> <a href=\"" . $htpath . "/index.php?action=view_users&userfile=2&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype\"><b>$user_log</b></a></td><td valign=top>$user_fio</td><td valign=top>$user_firm </b>$user_gorod $user_metro</b></td><td valign=top align=right><form name=\"forma$s\" action=\"index.php\" method=\"GET\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"filter\" value=\"".rawurldecode($filter)."\"><input type=hidden name=\"usersort\" value=\"$usersort\"><input type=\"hidden\" name=\"userfile\" value=2><input type=\"hidden\" name=\"change_user\" value=\"$user_log\"><input type=\"hidden\" name=\"change_pass\" value=\"$user_pass\"><select class=input-small name=\"change_status\" onchange=\"javascript:document.forma$s.submit()\"><option selected>$user_status</option>$usersta</select></form></td>$balans\n\n|".md5($user_log).md5(strrev($user_log))."";
if ($filter!="") {
if (preg_match("/$filter/i", toLower($st))!=TRUE) {
unset($user_sps[$s]); } else {
$files_found += 1;
$s+=1;
}
} else {
$files_found += 1;
$s+=1;
}
}


fclose($f);
}

if (isset($fillez)) {
while (list ($keyflz, $stflz) = each ($fillez)) {
$f=@fopen("$stflz","r");
while(!feof($f)) {
$st=fgets($f);
$out=explode("|",$st);
@$user_id=@$out[0];
if (($user_id=="")||($user_id=="\n")): continue; endif;
@$user_log=@$out[1];
@$user_pass=@$out[2];
@$user_fio=@$out[3];
@$user_email=@$out[4];
@$user_tel=@$out[5];
@$user_firm=@$out[6];
@$user_status=@$out[7];
@$user_metro=@$out[8];
@$user_street=@$out[9];
@$user_house=@$out[10];
@$user_korp=@$out[11];
@$user_pod=@$out[12];
@$user_domophone=@$out[13];
@$user_ofice=@$out[14];
@$user_flat=@$out[15];
@$user_dop=@$out[16];
@$user_gorod=@$out[17];
@$user_country=@$out[18];
@$user_telcode=@$out[19];
$regorg=@$setregid2[$user_id];
if(($details[7]=="ADMIN")){$usersta="<option>ADMIN</option><option>MODER</option><option>DEMO</option><option>VIP</option><option>USER</option>$oopt"; }
if(($details[7]=="MODER")||($details[7]=="DEMO")){
$usersta="<option>DEMO</option><option>VIP</option><option>USER</option>$oopt";
if ((@$user_status=="ADMIN")||(@$user_status=="MODER")) { $usersta=""; }
}
//echo $user_id."-".$property_mode[doubleval($user_house)]."<br>";
if ($user_id==2) {$firm_sob=" ".strtoken($property_mode[doubleval($user_house)],"|")." "; }else {$firm_sob=" ";}
if ($usersort=="no"){$datem=@explode(".", @strtoken(@$out[6]," "));
$ddatum=240*(doubleval(@$datem[0])+doubleval(@$datem[1])*31+365*(2000+doubleval(@$datem[2])))+$s;  $sortuserby=$ddatum;
if((@$user_status=="ADMIN")||(@$user_status=="MODER")){$sortuserby=999999999-$s;} } else { $sortuserby="999999999$user_log"; if((@$user_status=="ADMIN")||(@$user_status=="MODER")){$sortuserby=999999999-$s;}}
if (($regorg=="")&&($firm_sob==" ")&&($user_metro=="-"))  { $rega=""; } else {
$rega="$regorg<br><b>".$firm_sob."$user_metro</b><br>";}
$balans=""; if ($user_wallet_enable==1) {$balans="<td valign=top align=center>b_".md5($user_log).md5(strrev($user_log))."<a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=addmoney\"><img src=\"$image_path/money_add.png\" title=\"$lang[1122]\" border=0></a>&nbsp;&nbsp;<!--a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=remmoney\"><img src=\"$image_path/money_rem.png\" title=\"$lang[1161]\" border=0></a--></td><td><a class=btn href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=moneylog\" title=\"".$lang[1586]."\">i</a></td>";}

$user_sps[$s]= "<!-- $sortuserby --><td valign=top><img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: #9999FF\"> <a href=\"" . $htpath . "/index.php?action=view_users&userfile=3&usernik=".rawurlencode($user_log)."&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype\"><b>$user_log</b></a></td><td valign=top>$lang[75]:<br><b>$user_fio</b></td><td valign=top>".strtoken($user_firm," ")." $user_gorod<br>$rega</td><td valign=top><img src=$image_path/phone.png align=absmiddle>$user_telcode $user_tel</td><td valign=top align=right><form name=\"forma$s\" action=\"index.php\" method=\"GET\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=hidden name=\"usersort\" value=\"$usersort\"><input type=\"hidden\" name=\"userfile\" value=3><input type=\"hidden\" name=\"change_user\" value=\"$user_log\">
<input type=\"hidden\" name=\"filter\" value=\"".rawurldecode($filter)."\"><input type=\"hidden\" name=\"change_pass\" value=\"$user_pass\"><select class=input-small name=\"change_status\" onchange=\"javascript:document.forma$s.submit()\"><option selected>$user_status</option>$usersta</select></form></td>$balans\n\n|".md5($user_log).md5(strrev($user_log))."";
$user_logz=trim(str_replace(" ", "",str_replace("-", "", $user_log)));
//echo $user_logz." ". preg_replace("/\D/","", $user_log)." ".$user_tel."<br>";
if ($user_tel=="-") { if (preg_replace("/\D/","", $user_log)==$user_logz) { $user_tel=$user_logz; } }
if (($user_tel!="")&&($user_tel!=" ")) { $tel_sps[$s]=preg_replace("/\D/","", trim($user_telcode).trim($user_tel)); }
if (preg_match("/\@/i",$user_email)) { $email_sps[$s]=trim($user_email); }
if ($filter!="") {
if (preg_match("/$filter/i", toLower($st))!=TRUE) {
unset($user_sps[$s]);
unset($tel_sps[$s]);
unset($email_sps[$s]); } else {
$files_found += 1;
$s+=1;
}
} else {
$files_found += 1;
$s+=1;
}

}

}
}




if ($usersort=="no") {
rsort($user_sps);
} else {
sort($user_sps);
}








$st=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$user_sps[($start+$st)]) || (@$user_sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$user_sps[($start+$st)]) || (@$user_sps[($start+$st)]=="")): $user_sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($st/2)) == "TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
$val = $user_sps[($start+$st)];
$st += 1;
$tmp=explode("|","$val");
//echo "[b_".trim($tmp[1])."]".get_walet_total(md5(trim($tmp[1])))." $init_currency"."<br>";
$waltotal=get_walet_total(trim($tmp[1]));
$walcont=str_replace("b_".trim($tmp[1]),"<b>".  $waltotal."</b> $init_currency<br>", $tmp[0]);
if (doubleval($waltotal)>0) {$walcont=str_replace("<!--a", "<a",str_replace("</a-->", "</a>",$walcont)); }
$user_list .= "<tr>". $walcont."</tr>\n";
unset($tmp);
}
$total = count ($user_sps)-$gt;







$numberpages = (ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

$stat= "<center>".$lang[203]." <b>$numberpages</b> | ".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></center><br>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?action=view_users&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
}
$subz="";
if ($filter=="") { $lang[1611]=""; } else { $lang[1611]="<div class=alert>".$lang[1611]."</div>";}
if ($sub==1) {
$subz="<script language=javascript>
$(document).ready(function() {
$('#MD4').modal('show');
});

</script>
<div class=\"modal hide\" id=\"MD4\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD4Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD4Label\">".$lang[1607]."</h3>
</div>
<div class=\"modal-body\">$lang[1611]".implode("<br>", $email_sps)."</div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</a>
</div>
</div>";
}
if ($sub==2) {
$subz="<script language=javascript>
$(document).ready(function() {
$('#MD4').modal('show');
});

</script>
<div class=\"modal hide\" id=\"MD4\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD4Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD4Label\">".$lang[1608]."</h3>
</div>
<div class=\"modal-body\">$lang[1611]".implode("<br>", $tel_sps)."</div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</a>
</div>
</div>";
}
$user_list = @$userinfo."$stat<center>$pp ".$mpz['sort_by']." <b><a href=\"".$_SERVER['PHP_SELF']."?action=view_users&usersort=no&filter=".rawurlencode($filter)."&usertype=$usertype\">".$mpz['by_date']."</a></b> | <b><a href = \"".$_SERVER['PHP_SELF']."?action=view_users&usersort=yes&filter=".rawurlencode($filter)."&usertype=$usertype\">".$mpz['by_name']."</a></b></center><br>
<table border=0 width=100% class=\"table table-striped\"><tbody><tr><td valign=top colspan=\"7\"><table width=100% border=0 cellspacing=3 cellpadding=0 class=table2><tr><td valign=top width=20% align=left>".$lang[76]." / ".$lang[75]."</td><td align=right valign=top width=80%>".$lang[371]." / ".$lang[397]."</td></tr></table></td></tr>$user_list</tbody></table><center>
$pp</center><br>
<br>$stat\n</b><br>
<div class=well align=center>
<form class=form-inline action=\"index.php\" method=\"POST\"><b>".$lang[1593].":</b><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"text\" name=\"filter\" value=\"".rawurldecode($filter)."\" size=20 class=\"input-medium search-query\"><input type=hidden name=\"usersort\" value=\"$usersort\"><input type=hidden name=usertype value=\"$usertype\"> <input class=\"btn btn-primary\" type=submit value=\"".$lang[1595]."\"></form><br><br>
<!--form name=\"forma$s\" action=\"index.php\" method=\"GET\"><input type=\"hidden\" name=\"action\" value=\"view_users\"><input type=hidden name=\"usersort\" value=\"$usersort\"><input type=\"hidden\" name=\"newuser\" value=1><input type=\"hidden\" name=\"filter\" value=\"".rawurldecode($filter)."\"> <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[399]."\"></form-->
<div class=muted>".$lang[1594]."</div></div>

<div class=well>
$subz
<a class=\"btn mr pull-left\" href=\"".$_SERVER['PHP_SELF']."?action=view_users&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=1\"><i class=icon-envelope></i> ".$lang[1607]."</a>
<a class=\"btn mr pull-right\" href=\"".$_SERVER['PHP_SELF']."?action=view_users&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=2\"><i class=icon-signal></i> ".$lang[1608]."</a><div class=clearfix></div><br><br>
<!--a class=\"btn mr pull-left\" href=\"".$_SERVER['PHP_SELF']."?action=view_users&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=3\"><i class=icon-share-alt></i> ".$lang[1609]."</a>
<a class=\"btn mr pull-right\" href=\"".$_SERVER['PHP_SELF']."?action=view_users&usersort=$usersort&filter=".rawurlencode($filter)."&usertype=$usertype&sub=4\"><i class=icon-print></i> ".$lang[1610]."</a><div class=clearfix></div-->

</div>

<br><br><b>".$lang[400].":</b><br><br>
<!--img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: #99FF99\"> - ".$lang[401]."<br-->
<img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: ".lighter($nc3,100)."\"> - MySQL<br>
<img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: #9999FF\"> - ".$lang[402]."<br>
<b>ADMIN</b> - ".$lang[403]."<br>\n
<b>MODER</b> - ".$lang[404]."<br>\n
<b>DEMO</b> - ".$lang[405]."<br>\n
<b>VIP</b> - ".$lang[406]."<br>\n
<b>USER</b> - ".$lang[407]."<br>\n
<b>OPT</b> - ".$lang[737]."<br>\n
<br>
".$lang[408]."<br>\n";
$total-=1;

if ($files_found==0): $user_list = "<br><font color=$nc2><b>".$lang[398]."</b></font><br><br>".$user_list; endif;
if ($s==0): $user_list="<br><b>".$lang[42]."!</b> ".$lang[398]."<br>".$user_list; endif;

$bgu1="";
$bgu2="";
if ($usertype=="mysql") {$bgu2=" bgcolor=".lighter($nc3,100)."";} else {$bgu1=" bgcolor=#9999FF";}
if ($users_db_type=="mysql") {
$user_list="<br><table border=0 width=100% cellpadding=1><td align=left".$bgu1."><a href=\"$htpath/index.php?action=view_users&usertype=files\"><img border=0 src=$image_path/files.png align=absmiddle><b>".$lang[985]."</b></a></td><td align=right".$bgu2."><a href=\"$htpath/index.php?action=view_users&usertype=mysql\"><img border=0 src=$image_path/mysql.png align=absmiddle><b>MySQL</b></a></td></tr><tr><td colspan=2 bgcolor=$nc3><img src=$image_path/pix.gif width=1 height=1></td></tr></table>$error<br>".$user_list;
}
}
}
} else {
$user_list="HACK ATTEMPT?";
}
?>
