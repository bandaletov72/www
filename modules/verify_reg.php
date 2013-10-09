<?php
$esim="&nbsp;<span class=\"label label-important\"><i class=\"icon-hand-left icon-white\"></i></span>";
$reglink="";
$message="";
$jscountr="";
$chids="<div>";
$ffuscab="";
$e1="";
$e2="";
$e3="";
$e4="";
$e5="";
$e6="";
$e7="";
$e8="";
$e9="";
$e10="";
$e10="";
$e12="";
$e13="";
$e14="";
$e15="";
$e16="";
$e17="";
$e18="";
$e19="";
$e20="";
reset ($reg_as);

while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);

$setregid[$srrnum]=$srmasss[1];
$setregid2[$srrnum]=$srmasss[0];
}
}
reset ($reg_as);


if (isset($reg_as)) { if($setregid[$regid]>1) {$lang[61]=$lang[158]; $lang[68]=$lang[169];}}

$warn="";
/*
srand ((double)microtime()*1000000);
$um1=rand(6,9);
srand ((double)microtime()*1000000);
$um2=rand(1,3);
srand ((double)microtime()*1000000);
$um3=rand(1,3);
srand ((double)microtime()*1000000);
$zn1=rand(0,1);
if ($zn1==1){$zn1="+";}else{$zn1="-";}
srand ((double)microtime()*1000000);
$zn2=rand(0,1);
if ($zn2==1){$zn2="+";}else{$zn2="-";}
$expr="$um1$zn1$um2$zn2$um3";
echo "<table border=0 width=100%><tr>
    <td width=\"\" align=\"right\" valign=\"top\"><b>Защита:<font color=\"".$style['nav_col1']."\">*</font></b></td>
    <td width=\"\" valign=\"top\" colspan=\"2\">
            <p>&nbsp;&nbsp;&nbsp;<font color=\"".$style['nav_col1']."\" size=2><b>$expr=</b></font> <input type=\"text\" name=\"zash\" value=\"\" size=\"4\">
            <br><small>Пожалуйста сделайте вычисление и введите результат!</small></td>
  </tr></table>";
*/
$errs="";
$bad_symbols= array("\\" . chr(36),"<",">", "\!", "\%", "\^", "\*", "\+", "\=", "\ " ,"\|" ,"\," ,"\/" ,"\;" ,"\:" ,"\[" ,"\]" ,"\{" ,"\}" ,"\(" ,"\"" ,"'" ,"\)");
$arr=array ($lang['login']=>"reg_log", $lang['pass']=>"reg_pass", $lang[112]=>"reg_pass2", $lang[157]=>"telcode");
while (list ($line_num, $a) = each ($arr)) {
foreach ($bad_symbols as $key => $value) {
if (preg_match("/".$value."/i", $$a) == TRUE): $$a=str_replace($value , "", $$a); $value = str_replace("<" , "&lt;", $value); $value = str_replace(">" , "&gt;", $value); $errs .= "<font color=#b94a48>".$lang[300]." \"<b>" . substr($value, 1) . "</b>\" ".$lang[301]." '<b>$line_num</b>' - ".$lang[302]."<br>\n"; endif;
}
$$a = strip_tags($$a);
$$a = substr($$a, 0, 200);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace(chr(36) , "", $$a);
$$a = str_replace(chr(10) , " ", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
}
if ((strlen($reg_log)<3)||(strlen($reg_log)>30)): $e1="$esim"; $errs.= "<font color=#b94a48><b>".$lang[37]."</b></font><br>"; endif;
if ((strlen($reg_pass)<3)||(strlen($reg_pass)>30)): $e2="$esim"; $errs.= "<font color=#b94a48><b>".$lang[38]."</b></font><br>"; endif;
$arr2=array ("step","fio","tel","gorod", "metro","street","house","ofice","korp" ,"pod" ,"domophone","flat","other","country","telcode");
while (list ($line_num, $a) = each ($arr2)) {
if(!isset($$a)) {$$a="";}
$$a = strip_tags($$a);
$$a = substr($$a, 0, 200);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "", $$a);
$$a = str_replace("'" , "", $$a);
$$a = str_replace("`" , "", $$a);
$$a = str_replace("\"" , "", $$a);
$$a = str_replace("%" , "o/o", $$a);
$$a = str_replace("<" , "", $$a);
$$a = str_replace(">" , "", $$a);
$$a = str_replace(chr(10) , " ", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
}

if ((!@$reg_log) || (@$reg_log=="")){
$reg_log=""; $e1="$esim";
$errs.= "<font color=#b94a48><b>".$lang[70]." ".$lang['login']."!</b></font><br>";
} else {
$ver_nickname = $cart->ver_login($reg_log);
if ($action=="send_reg") { if ($ver_nickname==TRUE): $e1="$esim"; $errs.="<font color=#b94a48><b>".$lang[113]."</b></font><br>"; endif;
} else {
if ($action=="cabinet") { if ($ver_nickname==FALSE): $e1="$esim"; $errs.="<font color=#b94a48><b>".$lang[381]."</b></font><br>"; endif;
}
}
}

//Проверим правильность Email
if ((!@$reg_pass) || (@$reg_pass=="")): $e2="$esim"; $reg_pass=""; $errs.= "<font color=#b94a48>E2: <b>".$lang[70]." \"".$lang['pass']."\"!</b></font><br>";endif;
if ((!@$reg_pass2) || (@$reg_pass2=="")): $e3="$esim"; $reg_pass2=""; $errs.= "<font color=#b94a48>E3: <b>".$lang[70]." \"".$lang[112]."\"!</b></font><br>";endif;
if (!preg_match("/^[a-zA-Z0-9_-]+$/i",$reg_log)) { $e1="$esim"; $errs.="<font color=#b94a48>E1: <b>".$lang[37]."</b></font><br>";}
if (!preg_match("/^[a-zA-Z0-9_-]+$/i",$reg_pass)) { $e2="$esim"; $errs.="<font color=#b94a48>E2: <b>".$lang[38]."!</b></font><br>";}
if ($reg_pass!=$reg_pass2): $e2="$esim";$e3="$esim";$errs.= "<font color=#b94a48>E3: <b>".$lang[298]."!</b></font><br>";endif;
if ((!@$email) || (@$email=="")): $e10="$esim"; $email=""; $errs.= "<font color=#b94a48>E10: <b>".$lang[70]." \"Email\"!</b></font><br>"; endif;
if ((!@$fio) || (@$fio=="")): $e13="$esim"; $fio=""; if ($regid>1) {$errs .= "<font color=#b94a48>E13: <b>".$lang[70]." \"".$lang[74]."\"!</b></font><br>"; } else { $errs .= "<font color=#b94a48><b>".$lang[70]." \"".$lang[75]."\"!</b></font><br>";} endif;
if ((!@$tel) || (@$tel=="")): if ($_SESSION["fb_email"]=="") {$e12="$esim";$tel=""; $errs .= "<font color=#b94a48>E12: <b>".$lang[70]." \"".$lang[73]."\"!</b></font><br>";} endif;
$ekv="";
$answer_ok=0;
if (array_key_exists("antispam_a".md5(date("d.m.Y").$secret_salt), $_POST)) { $antispam_a=$_POST["antispam_a".md5(date("d.m.Y").$secret_salt)]; } else {$antispam_a="";}
if (!isset($antispam_a)){$antispam_a="";} $antispam_a=toLower(trim(stripslashes($antispam_a))); if (!preg_match("/^[а-яА-ЯёЁa-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$antispam_a)) { $antispam_a="";}
if (array_key_exists("antispam_row".md5(date("d.m.Y").$secret_salt), $_POST)) { $antispam_row=$_POST["antispam_row".md5(date("d.m.Y").$secret_salt)]; } else {$antispam_row="";}
if (!isset($antispam_row)){$antispam_row="";} $antispam_row=trim(stripslashes($antispam_row)); if (!preg_match("/^[a-z0-9_]+$/",$antispam_row)) { $antispam_row="";}
reset ($antispam_array);
while (list ($as_key, $as_st) = each ($antispam_array)) {
//echo $as_st."<br>";
$antispam_que=strtoken($as_st,"=");
$antispam_ans=trim(str_replace("$antispam_que=", "", $as_st));
$antispam_index=md5(date("d.m.Y").$as_key);
//echo $antispam_index." ".$antispam_row."<br>";
if ($antispam_index==$antispam_row) {

if ($antispam_a==$antispam_ans) {
//echo "exist $antispam_index<br>$antispam_a = $antispam_ans = $as_key = $as_st<br>";
$answer_ok=1;
}
}
}

if ($action=="send_reg") {
$rand_st=rand(0, count($antispam_array));
$randoma=@$antispam_array[$rand_st];
$antispam_q=strtoken($randoma,"=");
if (trim($antispam_q=="")) {$randoma=$antispam_array[0]; $antispam_q=strtoken($randoma,"="); $rand_st=0;}

$antispam_answer=trim(str_replace("$antispam_q=", "", $randoma));
if ($antispam_answer=="".doubleval($antispam_answer)) {$antispam_type=$lang[651];} else {$antispam_type="";}


 if($answer_ok==0){ $errs.="<font color=#b94a48>E100: <b>".$lang[825]."</b></font><br>"; $ekv="$esim";} }
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);
$fuserm=0;
$ffus="";
$ffus2="";
$ffus3="";
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);

if (!isset($fm[$fuserm])) { $fm[$fuserm]=""; if ($user_mass[4]==1){$errs.= "E1000: <font color=#b94a48><b>".$lang[70]." ".$user_mass[0]."!</b></font><br>";}}
if (($fm[$fuserm]!="")&&(!preg_match("/^[ёЁа-яА-Яa-zA-Z0-9_\@\,\:\"\'\*\!\#\№\+\=\$\.\?\&\#\;\ \%\(\)\/-]+$/i",$fm[$fuserm]))) {
$errs.= "<font color=#b94a48>E2000: <b>".$lang[168]." '".$user_mass[0]."'!</b></font><br>";
$fm[$fuserm]="";
} else {
if ($user_mass[4]==1) {
//if ($_SESSION["fb_email"]=="") {
if ($fm[$fuserm]=="") {
$errs.= "<font color=#b94a48>E1000 ".$fuserm.": <b>".$lang[70]." ".$lang[81].": '".$user_mass[0]."'!</b></font><br>";
$ee[$fuserm]="$esim";
$fm[$fuserm]="";
}
//}
}
//echo $fm[$fuserm]."<br>";
if ($user_mass[5]!="") {
$strin="^[".$user_mass[5]."]+\$";
if (($fm[$fuserm]!="")&&(!preg_match("/".$strin."/i",$fm[$fuserm]))) {
$errs.= "<font color=#b94a48>E3000".$fuserm.": <b>".$lang[168]." '".$user_mass[0]."'! ".$lang[220]." ".$user_mass[5]."</b></font><br>";
$fm[$fuserm]="";
}
}

$ffus.="<b>".$user_mass[0].":</b> ".$fm[$fuserm]."<br>";
$ffus2.=$user_mass[0].":  ".$fm[$fuserm]."<br>\n";
$ffuscab.=$fm[$fuserm]."|";
$ffus3.="&regfm[".$fuserm."]=".rawurlencode($fm[$fuserm]);
$fuserm+=1;
}
}
}
}

if ((!@$country) || (@$country=="")): $country=""; if ($_SESSION["fb_email"]=="") { $e4="$esim"; $errs .= "<font color=#b94a48>E4: <b>".$lang[70]." \"".$lang[167]."\"!</b></font><br>"; } endif;
if ((!@$telcode) || (@$telcode=="")): if ($_SESSION["fb_email"]=="") {$e11="$esim"; $telcode=""; $errs .= "<font color=#b94a48>E11: <b>".$lang[70]." \"".$lang[157]."\"!</b></font><br>";} endif;
if ((!@$gorod) || (@$gorod=="")): $gorod=""; if ($_SESSION["fb_email"]=="") {$e5="$esim"; $errs .= "<font color=#b94a48>E5: <b>".$lang[70]." \"".$lang[72]."\"!</b></font><br>";} endif;
if ((!@$metro) || (@$metro=="")): $metro=""; if ($_SESSION["fb_email"]=="") {$e6="$esim";$errs .= "<font color=#b94a48>E6: <b>".$lang[70]." \"".$lang[61]."\"!</b></font><br>";} endif;
if ((!@$street) || (@$street=="")): $street=""; if ($_SESSION["fb_email"]=="") {$e7="$esim";$errs .= "<font color=#b94a48>E7: <b>".$lang[70]." \"".$lang[71]."\"!</b></font><br>";} endif;
if ((!@$house) || (@$house=="")): $house=""; if ($_SESSION["fb_email"]=="") {$e8="$esim";$errs .= "<font color=#b94a48>E8: <b>".$lang[70]." \"".$lang[68]."\"!</b></font><br>"; }endif;
if ((!@$ofice) || (@$ofice=="")): $ofice=""; if ($_SESSION["fb_email"]=="") {$e9="$esim";$errs .= "<font color=#b94a48>E9: <b>".$lang[70]." \"".$lang[65]."\"!</b></font><br>";} endif;
$hache_num = array (5,9,12,2,29,23,7,17); #8 чисел от 1-31
reset ($bad_symbols);
$error="";
$error2="";
$err=$lang[150];
$err2=$lang[646];
foreach ($bad_symbols as $key => $value) {
if (preg_match("/".$value."/i", $email) == TRUE): $value = str_replace("<" , "&lt;", $value); $value = str_replace(">" , "&gt;", $value); $error .= ",\"<b>" . substr($value, 1) . "</b>\""; endif;
}
if ($email!="") {
$matches = explode("@", $email);
if (count($matches) == 1): $error2.=$lang[151]."<br>\n"; endif;
if (((count($matches)-1) >= 2) && (count($matches) !== 1)): $e10="$esim";$error2.=$lang[303]. " \"<b>@</b>\" - ".$lang[302].".<br>\n"; endif;
if ($matches[0] == ""): $error2.=$lang[152]."<br>\n"; endif;
if (substr($matches[0],0,1)=="."): $e10="$esim";$error2.="".$lang[338]."<br>\n"; endif;
if (end ($matches) == ""): $error2.=$lang[153]."<br>\n"; endif;

if (preg_match("/(.*)\@(.*)\.(.*)/i", $email) == FALSE): $e10="$esim";$error2.="".$lang[42]." Email.<br>\n"; endif;
if($error !==""): $e10="$esim";$error2.=$lang[300]." " . substr ($error, 1) . " - ".$lang[302].".<br>\n"; endif;



}
//Конец проверки доменов

$email_html = str_replace("<" , "&lt;", $email);
$email_html = str_replace(">" , "&gt;", $email_html);
if($error2 !==""):  if ($action=="send_reg") {  $register="1"; } $e10="$esim";$errs .= "<font color=#b94a48>E10: <b>$err</b></font><br><small>$error2</small>";  $email=""; endif;

$countrycode="";
if (@file_exists("./templates/$template/$speek/custom_country.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_country.inc");
reset ($user_arr);
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if (($country==$user_mass[0])&&($country!="")) {$countrycode=$user_mass[2];}
if (count($user_arr)==1) { $user_mass=explode("|", $user_arr[0]); $country=$user_mass[0];$countsel="";$jscountr=""; $chids="<div class=hidden>";}
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);
} else {$choosecountry="";}



if ($errs!="") {
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","$errs"));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$errs="$erview";
}
$verifyreg="$errs";
$verifyreg_title="";
if ($action=="send_reg") {
if($errs!=""):  $register="1"; endif;
if($errs=="") {
$regco=substr(md5("$reg_log$reg_pass$email"),0,15) ."_".substr(md5("$artrnd".rand(0,10000)),0,15)."_". substr(md5(time()),0,10);
$stroket="$regid|$reg_log|$reg_pass|$fio|$email|$tel|".date("d.m.y")." ".trim(str_replace("|", "", str_replace("\n", "", @$_SERVER['REMOTE_ADDR'])))." ".str_replace("|","", strtoupper(@$_SESSION["sfrom"])." / ".$_SESSION["stag"])."|USER|$metro|$street|$house|$korp|$pod|$domophone|$ofice|$flat|$other|$gorod|$country (+".$countrycode."-".$telcode.")|$telcode|$ffuscab\n";
if ($activate_now==0) {
add_tmp_user($reg_log,$regco,$stroket,"");


$reglink="$htpath/index.php?flag=$speek&logout=1&action=vreg&regcod=$regco";

$emailbody="$shop_name<br>\n
---------------------------------------------------------<br>\n
".$lang[323]."! <br>\n
".$lang[328]."<br>\n\n
".$lang[329].":<br><br>\n\n
<a href=\"$reglink\"><h4>".$lang[330]."</h4></a>
Link: <a href=$reglink>".str_replace("&","&amp;",$reglink)."</a><br>\n\n
".$lang[331]."<br><br>\n\n
".$lang['login'].":              $reg_log  <br>\n
".$lang['pass'].":             $reg_pass <br><br>\n\n
---------------------------------------------------------<br>\n
".$lang[337].": ". date("d.m.Y (D) H:i") . "<br>\n
---------------------------------------------------------<br>\n
".$lang[342]."<br>\n
---------------------------------------------------------<br>\n
$shop_name<br>";

}

$emailbody2="$shop_name<br>\n
---------------------------------------------------------<br>\n
".$lang[343]."! <br>\n
".$lang[344]."<br><br>\n\n
".$lang['login'].":              $reg_log  <br>\n
".$lang['pass'].":             $reg_pass <br><br>\n\n
---------------------------------------------------------<br>\n
".$lang[337].": ". date("d.m.Y (D) H:i") . "<br>\n
---------------------------------------------------------<br>\n
".$lang[342]."<br>\n
---------------------------------------------------------<br>\n
$shop_name<br>";
if (($activate_now==1)||($_SESSION["fb_email"]!="")) {$verifyreg="<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=$reglink\"><div class=round2 align=center><br><br>$lang[984]<br><b><a href=\"$reglink\">".$lang[330]."</a></b><br><br></div>";

if (!is_dir("./admin/userstat/$reg_log")) { mkdir("./admin/userstat/$reg_log",0755);
$fpurd=fopen("./admin/userstat/$reg_log.txt", "w");
fputs ($fpurd,$stroket);
fclose ($fpurd);
$verifyreg="<div align=center><center><div><font size=2 color=$nc3><b>$message</b></font><br><br><form id=\"verify_ok\" action=\"$htpath/index.php\" method=\"POST\">
<input type=hidden name=logout value=1>
<table border=0><tr>
<td><b>".$lang['login'].":</b></td><td><input type=text size=15 name=login value=\"".$reg_log."\"></td>
</tr><tr>
<td><b>".$lang['pass'].":</b></td><td><input type=password size=15 name=password value=\"".$reg_pass."\"></td>
</tr>
</table>
<br><input type=submit  class=regbut value=\"".$lang[940]."\"></form><br><br><font color=$nc3>".$lang[263]."</font></div></center></div><br>";

} else {
$verifyreg="<b><font color=#b94a48>".$lang[264]."</font></b><br><br>".$lang[111]."<br><br>";
}
} else {
$verifyreg="<b>".$lang[323]."!</b><br><br><font color=#468847><b>".$lang[328]."</b>!</font><br><br>".$lang[345]."<br><br>";
}
$verifyreg_title="";
$register="";
if ($activate_now==0) {
mail ("$email","REGISTRATION From: ". str_replace("http://","",$htpath). " To: $email", $emailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
} else {
mail ("$email","REGISTRATION DATA From: ". str_replace("http://","",$htpath). " To: $email", $emailbody2, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
mail ("$shop_mail","NEW REG USER From: $email", $emailbody2, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");

}
}
}
?>
