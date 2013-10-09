<?php
$jscountr="";
$esim="&nbsp;<span class=\"label label-important\"><i class=\"icon-hand-left icon-white\"></i></span>";
$chids="<span>";
if (!isset($ekv)) { $ekv="";} else {$ekv="$esim";}
if ($action!="send_reg") {
$rand_st=rand(0, count($antispam_array));
$randoma=@$antispam_array[$rand_st];
$antispam_q=strtoken($randoma,"=");
if (trim($antispam_q=="")) {$randoma=$antispam_array[0]; $antispam_q=strtoken($randoma,"="); $rand_st=0;}

$antispam_answer=trim(str_replace("$antispam_q=", "", $randoma));
if ($antispam_answer=="".doubleval($antispam_answer)) {$antispam_type=$lang[651];} else {$antispam_type="";}
}

$fregid=0;
$choosestreet="";
function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());
    return (float) $sec + ((float) $usec * 100000);
}
mt_srand(make_seed());
$countrysels="";
$reg_title="<img src=\"$image_path/pix.gif\" width=\"10\" height=\"10\">".$lang[39];
$selectas="";

if (isset($reg_as)) {
while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if($srmasss[1]!=0) {
$firstregid=$srrnum;
break;
}
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
reset ($reg_as);

}



if ($regid=="") {if (isset($setregid[$regid])) { if ($setregid[$regid]==0) { $regid=$firstregid; }}}
if ($regid=="") {$regid=$firstregid; $step=2;}
$backlink="register=$register&step=$step&regid=$regid";
$exitform="<form method=GET action=\"$htpath/index.php\" class=\"form-inline\">
<input type=hidden name=register value=1>
<input type=hidden name=blog_out value=yes>
<input type=submit value=\"".$lang['exit']."\">
</form>";
$inname="";
require "./modules/social_auth.php";
if ((!@$country) || (@$country=="")): $country=$countrysels; endif;
if ((!@$telcode) || (@$telcode=="")){
  if ($smod=="shop") {
$telcode="";
  } else {

  if ($portal!=1) { $telcode="-"; } else { $telcode="";} }
  }
if ((!@$email) || (@$email=="")): $email=""; if ($inname!="") {$email=$_SESSION["fb_email"]; $activate_now=1;} endif;
if ((!@$fio) || (@$fio=="")): $fio=""; if ($inname!="") {$fio="$inname";} endif;
if ((!@$tel) || (@$tel=="")){   if ($smod=="shop") {
$tel="";
  } else {
  if ($portal!=1) { $tel="-"; } else { $tel="";}
  } }

if ((!@$metro) || (@$metro=="")): $metro=""; endif;
if ((!@$street) || (@$street=="")): $street="-"; endif;
if ((!@$street2) || (@$street2=="")): $street2=""; endif;
if ((!@$gorod) || (@$gorod=="")): $gorod=$lang['citys']; if ($portal==1) {$gorod="";} endif;
if ((!@$house) || (@$house=="")): $house="-"; endif;
if ($lang[65]!=$lang[1166]) {
if ((!@$ofice) || (@$ofice=="")): $ofice="-"; endif;
} else {
if ((!@$ofice) || (@$ofice=="")): $ofice=""; endif;
}
if ((!@$korp) || (@$korp=="")): $korp=""; endif;
if ((!@$pod) || (@$pod=="")): $pod=""; endif;
if ((!@$domophone) || (@$domophone=="")): $domophone=""; endif;
if ((!@$flat) || (@$flat=="")): $flat=""; endif;
if ((!@$other) || (@$other=="")): $other="";endif;
if ((!@$reg_log) || (@$reg_log=="")): $reg_log=translit($inname); if ($qener_userlogin==1) { $reg_log=$gener_prefix.date("y",time()).mt_rand($gener_start,$gener_end);} endif;
if ((!@$reg_pass) || (@$reg_pass=="")): $reg_pass=""; if ($inname!="") {$reg_pass=translit(substr($inname, 0, 6).substr(md5(time()), 0, 6));} endif;
if ((!@$reg_pass2) || (@$reg_pass2=="")): $reg_pass2=""; if ($inname!="") {$reg_pass2=$reg_pass;} endif;
$arr2=array ("step","reg_log","reg_pass","reg_pass2","fio","tel","gorod", "metro","street","street2","house","ofice","korp" ,"pod" ,"domophone","flat","other","country","telcode");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags($$a);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "", $$a);
$$a = str_replace("%" , "o/o", $$a);
$$a = str_replace("<" , "", $$a);
$$a = str_replace(">" , "", $$a);
$$a = str_replace(chr(10) , "\n", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
}
//echo $regid." ".$setregid[$regid]." ".$setregid2[$regid];
$choosesp2="";
if ($metro!="") { $choosemetro="<option value=\"".$metro."\" selected>".$metro."</option>"; } else {$choosemetro=""; $metrosel=" selected";}
if (@file_exists("./templates/$template/$speek/custom_metro.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_metro.inc");
reset ($user_arr);
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_num==0) { if ($metro=="") { if ($setregid[$regid]==1) {$metro=strtoken($user_mass[1], "(");} $metrosel="";} } else {$metrosel="";}
$choosemetro.="<option style=\"border-left: 10px solid $user_mass[0]; margin-left: 0; padding-left: 4px; padding-right: 4px; padding-top: 3px; padding-bottom: 3px\" value=\"".strtoken($user_mass[1], "(")."\"$metrosel>".$user_mass[1]."</option>";
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);
} else {$choosemetro="";}
if ($choosemetro!="") {$choosemetro="<script language=javascript>
<!--
function choosemetro() {
var newmetro=document.getElementById('metro2').value;
if (newmetro!='') {
if (newmetro=='x') {
document.getElementById('metro').value='...';
document.getElementById('metro').style.display = 'inline';
document.getElementById('metro').style.visibility = 'visible';
} else {
document.getElementById('metro').value=document.getElementById('metro2').value;
document.getElementById('metro').style.display = 'none';
document.getElementById('metro').style.visibility = 'hidden';
}
}
}
-->
</script>
<select class=input-medium id=\"metro2\" onchange=\"javascript:choosemetro()\">".$choosemetro."<option value=\"\"></option><option value=\"x\">".$lang[475]."</option></select> &nbsp; &nbsp;<i><b><a href=\"#1\" onClick=javascript:window.open('$htpath/$metrofile','metro','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=660,height=780,left=0,top=0')>".$lang[291]."</a></b></i> [".$lang['citys']."]<br>"; $choosesp2="<br>";}
$chooseme2="";

if (@file_exists("./templates/$template/$speek/custom_street.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_street.inc");
reset ($user_arr);
$choosestreet.="<select class=input-medium id=\"street2\" name=\"street2\">";
if ($street2!="") {$choosestreet.="<option value=\"$street2\">$street2</option>"; }
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_num==0) {$streetsel=" selected"; if ($street2!="") {$streetsel="";}} else {$streetsel="";}

$choosestreet.="<option value=\"".$user_mass[0]."\"$streetsel>".$user_mass[0]."</option>";
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);
$choosestreet.="<option value=\"-\"></option></select>";
} else {$street2=""; $choosestreet="";}
if ($country!="") {
if  ($portal!=1) {$choosecountry="<option value=\"\">".$lang[472]."</option><option>".strtoken($country," (")."</option>";
}
} else {$choosecountry=""; $countsel=" selected";}
if ($portal==1) { $chcf="custom_company.inc"; } else { $chcf="custom_country.inc";}
if (@file_exists("./templates/$template/$speek/$chcf")==TRUE) {
$user_arr=file ("./templates/$template/$speek/$chcf");
reset ($user_arr);
$cityes=Array();
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);

if ($user_num==0) { if ($country=="") { $country=$user_mass[0]; $countsel="";} } else {$countsel="";}
if (count($user_arr)==1) { $user_mass=explode("|", $user_arr[0]); $country=$user_mass[0];$countsel="";$jscountr="";$chids="$country<span class=hidden>";}
$choosecountr[]="<!-- ".@$user_mass[1]." --><option value=\"".@$user_mass[0]."\"$countsel>".@$user_mass[1]."</option>";
if (@file_exists("./templates/$template/$speek/".$user_mass[2].".inc")==TRUE) {
$cityind=$user_mass[0];
$citymass=file("./templates/$template/$speek/".$user_mass[2].".inc");
array_unique($citymass);
sort($citymass);
reset($citymass);
while (list ($city_num, $city_line) = each ($citymass)) {
$city_line=trim($city_line);
if ($city_line!="") {
@$cityes[$cityind].="<option value=\"$city_line\">$city_line</option>\n";
}
}
} else {
$cityind=$user_mass[0];

}
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);

$firstc=$choosecountr[0];
array_unique($choosecountr);
sort ($choosecountr);
reset($choosecountr);

$choosecountry.=$firstc."\n".str_replace($firstc, "",implode("\n", $choosecountr));

} else {$choosecountry="";}

$cities="";
unset($city_num, $city_line);
reset($cityes);
while (list ($city_num, $city_line) = each ($cityes)) {
$cities.="\n\n<select class=input-medium onchange=\"javascript:choosecity(this.value)\" style=\"display:none; visibility:hidden;\" id=\"$city_num\"><option value=\"$gorod\" selected>$gorod</option><option value=\"\">".$lang[471]."</option>$city_line<option value=\"\"></option><option value=\"x\">".$lang[474]."</option></select>";
}
if ($choosecountry!="") {$choosecountry="<script language=javascript>
<!--
function choosecountry() {
var curcountry=document.getElementById('country').value;
var newcountry=document.getElementById('country2').value;
//theobj1 = (document.nativeGetElementById)?document.getElementById(curcountry):document.all[curcountry];
//theobj2 = (document.nativeGetElementById)?document.getElementById(newcountry):document.all[newcountry];
if (newcountry!='') {
if (newcountry=='x') {
document.getElementById('country').value='...';
document.getElementById('city').style.display = 'inline';
document.getElementById('city').style.visibility = 'visible';
document.getElementById('city').value='...';
document.getElementById('country').style.display = 'inline';
document.getElementById('country').style.visibility = 'visible';
} else {
document.getElementById('country').value=document.getElementById('country2').value;
document.getElementById('country').style.display = 'none';
document.getElementById('country').style.visibility = 'hidden';
}
if (document.getElementById(curcountry)) {
document.getElementById(curcountry).style.display = 'none';
document.getElementById(curcountry).style.visibility = 'hidden';
}
if (document.getElementById(newcountry)) {
document.getElementById(newcountry).style.display = 'inline';
document.getElementById(newcountry).style.visibility = 'visible';
}else {
document.getElementById('city').style.display = 'inline';
document.getElementById('city').style.visibility = 'visible';
}

}
}
function choosecity(arg) {
if (arg!='') {
if (arg=='x') {
document.getElementById('city').style.display = 'inline';
document.getElementById('city').style.visibility = 'visible';
document.getElementById('city').value='...';
} else {
document.getElementById('city').style.display = 'none';
document.getElementById('city').style.visibility = 'hidden'
document.getElementById('city').value=arg;
}

}
}
-->
</script>
$jscountr".$chids."<select class=input-medium id=\"country2\" onchange=\"javascript:choosecountry()\"><option value=\"$country\" selected>$country</option>".$choosecountry."<option value=\"\"></option><option value=\"x\">".$lang[473]."</option></select></span>"; $chooseme2="";}









if (isset($reg_as[$regid])) {$selectas="<option value=\"".$regid."\" selected>".strtoken($reg_as[$regid],"|")."</option>\n"; $regas=strtoken($reg_as[$regid],"|").", ";} else {$selectas="<option value=\"".$regid."\" selected>".strtoken(@$reg_as[0],"|")."</option>"; $regas="";}



if (isset($reg_as)) {
$chooseregids="<form name=\"selectform\" method=GET action=\"$htpath/index.php\" class=\"form-inline\">
<input type=\"hidden\" id=\"regist\" name=\"register\" value=\"1\">
<input type=\"hidden\" name=\"step\" value=\"2\">
<select class=input-medium name=\"regid\" onchange=\"javascript:document.selectform.submit()\">$selectas";
while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if(($srmasss[1]!=0)&&($srrnum!=$regid)) {
$chooseregids.="<option value=\"".$srrnum."\">".$srmasss[0]."</option>";
}
}
}
$chooseregids.="</select></form>";
reset ($reg_as);
}




$reg_forms="";
if ($inname!="") {$passtype="text";} else {$passtype="password";}
$reg_forms1= "
<script type=\"text/javascript\">
if (/msie/i.test (navigator.userAgent)) //only override IE
{
	document.nativeGetElementById = document.getElementById;
	document.getElementById = function(id)
	{
		var elem = document.nativeGetElementById(id);
		if(elem)
		{
			//make sure that it is a valid match on id
			if(elem.attributes['id'].value == id)
			{
				return elem;
			}
			else
			{
				//otherwise find the correct element
				for(var i=1;i<document.all[id].length;i++)
				{
					if(document.all[id][i].attributes['id'].value == id)
					{
						return document.all[id][i];
					}
				}
			}
		}
		return null;
	};
}
</script>";
$reg_forms1.="
<!--h4>".$lang[108].":</h4-->
";
$tmp=explode("\n", $selectas);

if ( count($reg_as)>1) {
$reg_forms1.="<table class=table border=\"0\" width=\"100%\">
  <tr><td align=\"left\" valign=\"top\" width=30%><b>".$lang[288]."</b></td>
  <td width=70% align=left>$chooseregids</td></tr></table>";
}
$reg_forms1.="<script language=javascript>
<!--

function checkuser(val) {
if (val!='') {
var ms;
Today = new Date();
ms = Today.getTime();

$.ajax({
  type: \"POST\",
  url: \"check_user.php\",
  data: \"us=\"+val+\"&session=$sid&t=\"+ms,
  success: function(msg){
   $(document).ready(function() {
    if (msg==\"1\") {
document.getElementById('e1').style.display='none';
document.getElementById('e1').style.visibility='hidden';
document.getElementById('username_ok').innerHTML=\" <i class=icon-ok></i>\";
document.getElementById('ee1').innerHTML=\"\";
} else {
if (msg==\"0\") {
document.getElementById('username_ok').innerHTML=\" <i class=icon-remove></i>\";
document.getElementById('ee1').innerHTML=\"\";
} else {
if (msg==\"2\") {
document.getElementById('username_ok').innerHTML=\" <i class=icon-remove></i>\";
document.getElementById('ee1').innerHTML=\"<span class=text-error>$lang[1539]</span><br>\";
} else {
document.getElementById('username_ok').innerHTML=\" <i class=icon-remove></i>\";
document.getElementById('ee1').innerHTML=\"<span class=text-error>$lang[1545]</span><br>\";
}
}
}
        });


  }
});


} else {
document.getElementById('ee1').innerHTML=\"\";
}
}

function checkpass(val) {
if (val!='') {
if (document.getElementById('pass2').value!='') { checkpass2(document.getElementById('pass2').value); }
var ms;
Today = new Date();
ms = Today.getTime();

$.ajax({
  type: \"POST\",
  url: \"check_pass.php\",
  data: \"us=\"+val+\"&session=$sid&t=\"+ms,
  success: function(msg){
   $(document).ready(function() {
    if (msg==\"0\") {
    document.getElementById('userpass_ok').innerHTML=\" <i class=icon-remove></i>\";
    document.getElementById('ee2').innerHTML=\"\";
} else {
if (msg==\"4\") {
document.getElementById('userpass_ok').innerHTML=\" <i class=icon-remove></i>\";
document.getElementById('ee2').innerHTML=\"<span class=text-error>$lang[1545]</span><br>\";
} else {
document.getElementById('e2').style.display='none';
document.getElementById('e2').style.visibility='hidden';
document.getElementById('userpass_ok').innerHTML=\" <i class=icon-ok></i>\";
if (msg==\"1\") {document.getElementById('ee2').innerHTML=\"<span class='label label-important'>$lang[1542]</span><br>\";}
if (msg==\"2\") {document.getElementById('ee2').innerHTML=\"<span class='label label-warning'>$lang[1543]</span><br>\";}
if (msg==\"3\") {document.getElementById('ee2').innerHTML=\"<span class='label label-success'>$lang[1544]</span><br>\";}
}
}
        });


  }
});


} else {
document.getElementById('ee2').innerHTML=\"\";
}
}
function checkpass2(val) {
if (val!='') {
document.getElementById('e3').style.display='none';
document.getElementById('e3').style.visibility='hidden';
if (val!=document.getElementById('pass1').value) {
document.getElementById('passpass').innerHTML='".$lang[298]."';
document.getElementById('userpass2_ok').innerHTML=\" <i class=icon-remove></i>\";
} else {
document.getElementById('passpass').innerHTML='';
document.getElementById('userpass2_ok').innerHTML=\" <i class=icon-ok></i>\";
}
} else {
document.getElementById('passpass').innerHTML='';
}
}
-->
</script>
<form method=\"POST\" action=\"$htpath/index.php\" id=regform class=\"form-inline\">
<input type=\"hidden\" name=\"action\" value=\"send_reg\">
<input type=\"hidden\" name=\"regid\" value=\"$regid\">
<input type=\"hidden\" name=\"register\" value=\"1\">
<input type=\"hidden\" name=\"step\" value=\"2\">
<table class=table border=\"0\" width=\"100%\">
  <tr>
    <td align=\"right\" valign=\"middle\" width=30%><b>".$lang[107].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"middle\" style=\"white-space:nowrap;\" width=30%>
        <input type=\"text\" id=\"username\" name=\"reg_log\" value=\"$reg_log\" size=\"15\" class=input-medium onkeyup=\"javascript: checkuser(this.value);\" placeholder=\"".$lang['login']."\"><span id=e1>$e1</span><span id=\"username_ok\"></span>
    </td>
        <td valign=\"middle\" width=40%><span id=ee1></span><span class=muted>".$lang[37]."</span></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"middle\" width=30%><b>".$lang[109].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"middle\" style=\"white-space:nowrap;\" width=30%>
        <input type=\"$passtype\" name=\"reg_pass\" id=\"pass1\" value=\"$reg_pass\" size=\"15\" class=input-medium onkeyup=\"javascript: checkpass(this.value);\" placeholder=\"".$lang['pass']."\"><span id=e2>$e2</span><span id=\"userpass_ok\"></span></td>
        <td valign=\"top\" width=40%><span id=ee2></span><span class=muted>".$lang[38]."</span></td>
  </tr>
   <tr>
    <td align=\"right\" valign=\"middle\" width=30%><b>".$lang[112].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"middle\" style=\"white-space:nowrap;\" width=30%>
        <input type=\"$passtype\" name=\"reg_pass2\" id=\"pass2\" value=\"$reg_pass2\" size=\"15\" class=input-medium onkeyup=\"javascript: checkpass2(this.value);\" placeholder=\"".$lang[1538]."\"><span id=e3>$e3</span><span id=\"userpass2_ok\"></td>
        <td width=40%><span class=text-error id=passpass></span></td>
  </tr>
    <tr>
    <td valign=\"top\" align=\"right\" width=100% colspan=3><div class=\"comnts\"><i><a href=\"$htpath/index.php?action=restore\" style=\"border-bottom: 2px dotted $nc3;\">".$lang[110]."</a></i> ".$lang[111]."</div></td>
  </tr>
";
  $reg_forms2="";
  $reg_formsb="";
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);
$fuserm=0;
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_mass[6]=="") {

$reg_forms2.="
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$user_mass[0].":<font size=4 color=\"$nc3\">";
if ($user_mass[4]==1) { $reg_forms2.="*";}
$reg_forms2.="</font></b></td>
<td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\">";
if ($user_mass[2]=="select") {
$reg_forms2.="<select class=input-medium name=\"fm[$fuserm]\"><option>";
}
if ($user_mass[2]=="textarea") {
$reg_forms2.="<textarea rows=\"".$user_mass[3]."\" cols=48 style=\"width: 90%\" name=\"fm[$fuserm]\">";
}
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_forms2.="<input type=\"".$user_mass[2]."\" size=\"".$user_mass[3]."\" style=\"width: 90%\" placeholder=\"".$user_mass[1]."\" value=\"";
}
if ((isset($fm[$fuserm])==FALSE)||(!preg_match("/^[¸¨à-ÿÀ-ßa-zA-Z0-9:\@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$fm[$fuserm]))) {
$reg_forms2.="-";
} else {
if ($user_mass[2]!="radio") {
$reg_forms2.=$fm[$fuserm]; }
}
if ($user_mass[2]=="select") {
$reg_forms2.="</option>";
$tmp=explode("^", $user_mass[7]);
$sel=" selected";
while (list($kk,$vv)=each($tmp)) {
$reg_forms2.="<option value=\"".$vv."\">".$vv."</option>";
$sel="";
}
$reg_forms2.="</select>";
}
if ($user_mass[2]=="radio") {
$tmp=explode("^", $user_mass[7]);
$sel=" checked=\"checked\"";
while (list($kk,$vv)=each($tmp)) {
$reg_forms2.="<span style=\"white-space:nowrap;\"><input type=radio name=\"fm[$fuserm]\"".$sel." value=\"".$vv."\" id=radio_".translit($vv)."><label for=\"radio_".translit($vv)."\">$vv</label></span><br>\n";
$sel="";
}
}
if ($user_mass[2]=="textarea") {
$reg_forms2.="</textarea>"; }
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_forms2.="\" name=\"fm[$fuserm]\" onkeyup=\"document.getElementById('c".$fuserm."').style.visibility='hidden';\">"; }
if ($user_mass[2]=="radio") {
$reg_forms2.="<span id=c".$fuserm.">".@$ee[$fuserm]."</span><span class=muted>".$user_mass[1]."</span></td>
  </tr>";
  } else {
$reg_forms2.="<span id=c".$fuserm.">".@$ee[$fuserm]."</span></td>
  </tr>";
  }
$fuserm+=1;



} else {


$reg_formsb.="
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$user_mass[0].":<font size=4 color=\"$nc3\">";
if ($user_mass[4]==1) { $reg_formsb.="*";}
$reg_formsb.="</font></b></td>
<td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%>";
if ($user_mass[2]=="select") {
$reg_formsb.="<select class=input-medium name=\"fm[$fuserm]\"><option>";
}
if ($user_mass[2]=="textarea") {
$reg_formsb.="<textarea rows=\"".$user_mass[3]."\" cols=48 style=\"width: 90%\" name=\"fm[$fuserm]\">";
}
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_formsb.="<input type=\"".$user_mass[2]."\" size=\"".$user_mass[3]."\" style=\"width: 90%\" placeholder=\"".$user_mass[1]."\" value=\"";
}
if ((isset($fm[$fuserm])==FALSE)||(!preg_match("/^[¸¨à-ÿÀ-ßa-zA-Z0-9:\@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$fm[$fuserm]))) {
$reg_formsb.="";
} else {
if ($user_mass[2]!="radio") {
$reg_formsb.=$fm[$fuserm]; }
}
if ($user_mass[2]=="select") {
$reg_formsb.="</option>";
$tmp=explode("^", $user_mass[7]);
$sel=" selected";
while (list($kk,$vv)=each($tmp)) {
$reg_formsb.="<option value=\"".$vv."\">".$vv."</option>";
$sel="";
}
$reg_formsb.="</select>";
}
if ($user_mass[2]=="radio") {
$tmp=explode("^", $user_mass[7]);
$sel=" checked=\"checked\"";
while (list($kk,$vv)=each($tmp)) {
$reg_formsb.="<span style=\"white-space:nowrap;\"><input type=radio name=\"fm[$fuserm]\"".$sel." value=\"".$vv."\" id=radio_".translit($vv)."><label for=\"radio_".translit($vv)."\">$vv</label></span><br>\n";
$sel="";
}
}
if ($user_mass[2]=="textarea") {
$reg_formsb.="</textarea>"; }
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_formsb.="\" name=\"fm[$fuserm]\" onkeyup=\"document.getElementById('c".$fuserm."').style.visibility='hidden';\">"; }
if ($user_mass[2]=="radio") {
$reg_formsb.="<span id=c".$fuserm.">".@$ee[$fuserm]."</span><span class=muted>".$user_mass[1]."</span></td>
  </tr>";
  } else {
$reg_formsb.="<span id=c".$fuserm.">".@$ee[$fuserm]."</span></td>
  </tr>";
  }
$fuserm+=1;
}
}
}
}
$reg_forms3= "";
$reg_forms33= "
   <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[167].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>".$choosecountry."<input type=\"text\" id=\"country\" name=\"country\" value=\"$country\" size=\"25\" class=hidden><span id=e4>$e4</span>".$chooseme2."</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[72].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>$cities<input id=\"city\" type=\"text\" name=\"gorod\" value=\"$gorod\" size=\"30\" onkeyup=\"document.getElementById('e5').style.visibility='hidden';\"><span id=e5>$e5</span></td>
  </tr>
";

if ($view_metro==1) { $reg_forms3.= "<tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[61].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>".$choosemetro."<input type=\"text\" id=\"metro\" name=\"metro\"  value=\"$metro\" size=\"30\" class=hidden>".$choosesp2."</td>
  </tr>";  } else {
   $reg_forms3.= "<input type=\"hidden\" id=\"metro\" name=\"metro\" value=\"-\"><input type=\"hidden\" id=\"metro2\" name=\"metro2\" value=\"-\">";
  }

$reg_forms3.= "
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[71].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"street\" value=\"".str_replace("^", "", $street)."\" size=\"45\" style=\"width:90%\" onkeyup=\"document.getElementById('e7').style.visibility='hidden';\"><span id=e7>$e7</span>$choosestreet</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[68].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%><input type=\"text\" name=\"house\" style=\"width: 10%\" value=\"$house\" size=\"15\" style=\"width: 90%\" onkeyup=\"document.getElementById('e8').style.visibility='hidden';\"><span id=e8>$e8</span></td>
  </tr>
  ";
if (isset($lang[67])) { if ($lang[67]!="") {$reg_forms3.= "
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[67].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"korp\" style=\"width: 10%\" value=\"$korp\" size=\"15\"></td>
  </tr>
  ";}}
if (isset($lang[66])) { if ($lang[66]!="") {$reg_forms3.= "
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[66].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"pod\" style=\"width: 10%\" value=\"$pod\" size=\"15\"></td>
  </tr>
  ";}}
if (isset($lang[69])) { if ($lang[69]!="") {$reg_forms3.= "
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[69].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"domophone\" style=\"width: 10%\" value=\"$domophone\" size=\"15\"></td>
  </tr>
  ";}}
if (isset($lang[65])) { if ($lang[65]!="") {$reg_forms3.= "     <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[65].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%><input type=\"text\" name=\"ofice\" value=\"$ofice\" size=\"15\" style=\"width:10%\"></td>
  </tr>
  <tr>
";
} else {$reg_forms3.= "<input type=\"hidden\" name=\"ofice\" value=\"-\">";} } else {$reg_forms3.= "<input type=\"hidden\" name=\"ofice\" value=\"-\">"; }

if (isset($lang[64])) { if ($lang[64]!="") {$reg_forms3.= "
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[64].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"flat\" style=\"width: 10%\" value=\"$flat\" size=\"15\"></td>
  </tr>
"; }}
$choosepr="";
if (isset($property_mode)) {
if ($portal!=1) {
$choosepr="<select class=input-small name=\"house\"><option selected value=\"".$house."\">".strtoken(@$property_mode[$house],"|")."</option>";
while (list ($rrnum, $rrline) = each ($property_mode)) {
if (($rrline!="")&&($rrline!="\n")) {
$srmass=explode("|",$rrline);
if($srmass[1]!=0) {
$choosepr.="<option value=\"".$rrnum."\">".$srmass[0]."</option>";
//$fregid+=1;
}
}
}
$choosepr.="</select> ";
} else {
$choosepr="<input type=hidden value=\"-\" name=\"house\">";
}

}

$reg_forms4= "
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[158].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%>$choosepr";
 if ($portal!=1) {
 $reg_forms4.="<input type=\"text\" name=\"metro\" value=\"$metro\" size=\"30\">";
 } else {
 if ($metro=="") { $metro=$portal_company; }
  $reg_forms4.="<input type=\"text\" name=\"metro\" value=\"$metro\" size=\"30\" readonly=\"readonly\">";
 }
    $reg_forms4.="
<input type=\"hidden\" name=\"korp\" value=\"\">
<input type=\"hidden\" id=\"metro2\" name=\"metro2\" value=\"-\">
<input type=\"hidden\" name=\"pod\" value=\"\">
<input type=\"hidden\" name=\"domophone\" value=\"\">
<input type=\"hidden\" name=\"flat\" value=\"\">
<input type=\"hidden\" name=\"street2\" value=\"\">
<input type=\"hidden\" name=\"street\" value=\"-\">";
 if ($portal==1) {
$reg_forms4.="
<input type=\"hidden\" name=\"ofice\" value=\"-\">
";
}
$reg_forms4.="    </td>
  </tr>";

$reg_forms4.="<tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[167].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>".$choosecountry."<input type=\"text\" id=\"country\" name=\"country\" value=\"$country\" size=\"25\" class=hidden><span id=e4>$e4</span>".$chooseme2."</td>
  </tr>
   <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[72].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>$cities<input id=\"city\" type=\"text\" name=\"gorod\" value=\"$gorod\" size=\"30\" onkeyup=\"document.getElementById('e5').style.visibility='hidden';\"><span id=e5>$e5</span></td></tr>
   ";
   if ($portal!=1) {
$reg_forms4.="    <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[1166].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" id=\"ofice\" name=\"ofice\" value=\"$ofice\" size=\"30\" style=\"width: 90%\" onkeyup=\"document.getElementById('e9').style.visibility='hidden';\"><span id=e9>$e9</span></td>
  </tr>

";
}
$reg_forms7= "<tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[167].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%>".$choosecountry."<input type=\"text\" id=\"country\" name=\"country\" value=\"$country\" size=\"25\" class=hidden><span id=e4>$e4</span>".$chooseme2."</td>
  </tr>
   <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[72].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>$cities<input id=\"city\" type=\"text\" name=\"gorod\" value=\"$gorod\" size=\"30\" onkeyup=\"document.getElementById('e5').style.visibility='hidden';\"><span id=e5>$e5</span>
	<input type=\"hidden\" name=\"house\" value=\"-\">
<input type=\"hidden\" name=\"street\" value=\"-\">
<input type=\"hidden\" name=\"street2\" value=\"\">
<input type=\"hidden\" name=\"korp\" value=\"\">
<input type=\"hidden\" name=\"pod\" value=\"\">
<input type=\"hidden\" name=\"domophone\" value=\"\">
<input type=\"hidden\" name=\"flat\" value=\"\">
<input type=\"hidden\" id=\"metro2\" name=\"metro2\" value=\"-\"></td></tr>

  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[966].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" id=\"metro\" name=\"metro\" value=\"$metro\" size=\"30\" style=\"width:90%;\"></td>
  </tr>
<tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[1166].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" id=\"ofice\" name=\"ofice\" value=\"$ofice\" size=\"30\" style=\"width: 90%\" onkeyup=\"document.getElementById('e9').style.visibility='hidden';\"><span id=e9>$e9</span></td>
  </tr>
";

$reg_forms5="  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[74].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%>
        <input type=\"text\" name=\"fio\" value=\"$fio\" size=\"45\" style=\"width: 90%\" onkeyup=\"document.getElementById('e13').style.visibility='hidden';\"><span id=e13>$e13</span>
    </td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>E-mail:<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%><input type=\"text\" style=\"width: 90%\" value=\"$email\" name=\"email\" size=\"45\" onkeyup=\"document.getElementById('e10').style.visibility='hidden';\"><span id=e10>$e10</span></td>
  </tr>
  ";
  if ($smod=="shop") {
$reg_forms5.="<tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[73].": <font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=2 width=70%><input class=input-small type=\"text\" value=\"$telcode\" name=\"telcode\" size=\"5\" onkeyup=\"document.getElementById('e11').style.visibility='hidden';\" class=input-small placeholder=\"".$lang[157]."\"><span id=e11>$e11</span>&nbsp;&nbsp;<input type=\"text\" value=\"$tel\" name=\"tel\" size=\"30\" onkeyup=\"document.getElementById('e12').style.visibility='hidden';\" class=input-large placeholder=\"".$lang[73]."\"><span id=e12>$e12</span></td>
  </tr>";
  } else {
  $reg_forms5.="<input type=\"hidden\" value=\"-\" name=\"telcode\"><input type=\"hidden\" value=\"-\" name=\"tel\">";
  }
$reg_forms6="  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[74].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%>
        <input type=\"text\" name=\"fio\" value=\"$fio\" style=\"width: 90%\" size=\"45\" onkeyup=\"document.getElementById('e13').style.visibility='hidden';\"><span id=e13>$e13</span>
    </td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>E-mail:<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%><input type=\"text\" style=\"width: 90%\" value=\"$email\" name=\"email\" size=\"45\" onkeyup=\"document.getElementById('e10').style.visibility='hidden';\"><span id=e10>$e10</span></td>
  </tr>
  ";

//if ($setregid[$regid]>1) {$lang[63]="";}
if (translit(toLower(substr($antispam_q,0,1)))==toLower(substr($antispam_q,0,1))) { $tl="&tl=en"; } else {$tl="&tl=ru";}
$submit_forms="
  <tr>
    <td></td><td width=\"70%\" valign=\"top\" align=left colspan=\"2\"><span class=\"label label-warning\">".$lang[826]."</span> <i>$antispam_q?</i>
<!-- object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"400\" height=\"27\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"><param name=\"src\" value=\"http://www.google.com/reader/ui/3523697345-audio-player.swf?audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($antispam_q),0,100)).$tl)."\"/><param name=\"quality\" value=\"best\"/><embed type=\"application/x-shockwave-flash\" wmode=\"transparent\" src=\"http://www.google.com/reader/ui/3523697345-audio-player.swf?audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($antispam_q),0,100)).$tl)."\" height=\"27\" width=\"320\"></embed></object-->
<br><br>
<input type=\"text\" name=\"antispam_a".md5(date("d.m.Y").$secret_salt)."\" value=\"\" onkeyup=\"document.getElementById('ekv').style.visibility='hidden';\" style=\"width: 90%\" placeholder=\"$lang[805] "."$antispam_type\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y").$secret_salt)."\" value=\"".md5(date("d.m.Y").$rand_st)."\"><span id=ekv>$ekv</span>
</td></tr>
<tr>
    <td width=30%>&nbsp;</td><td colspan=\"2\" valign=\"top\" align=left width=70%><a class=\"btn btn-large btn-primary\" onclick=document.getElementById('regform').submit();><i class=\"icon-ok icon-white\"></i> ".$lang[292]."</a></td>
  </tr>
</table>
</form>
<script language=javascript>
<!--
var curcountry=document.getElementById('country').value;
if (curcountry!='') {
document.getElementById(curcountry).style.display = 'inline';
document.getElementById(curcountry).style.visibility = 'visible';

if (document.getElementById('country').value==document.getElementById('country2').value) {
document.getElementById('country').style.display = 'none';
document.getElementById('country').style.visibility = 'hidden';
}
if (document.getElementById('city').value==document.getElementById(curcountry).value) {
document.getElementById('city').style.display = 'none';
document.getElementById('city').style.visibility = 'hidden';
}
}
";

if ($view_metro==1) { $submit_forms.="if (document.getElementById('metro')) {
if (document.getElementById('metro').value==document.getElementById('metro2').value) {
document.getElementById('metro').style.display = 'none';
document.getElementById('metro').style.visibility = 'hidden';
}
}
";
}
$submit_forms.="-->
</script>
";




//$fregid=0;
$chooseregid="";
$chkr=" checked";
if (isset($reg_as)) {
while (list ($rrnum, $rrline) = each ($reg_as)) {
if (($rrline!="")&&($rrline!="\n")) {
$srmass=explode("|",$rrline);
if($srmass[1]!=0) {
$chooseregid.="<p><input type=\"radio\" value=\"".$rrnum."\"$chkr name=\"regid\">".$srmass[0]."</p>";
$chkr="";
//$fregid+=1;
}
}
}
if (($setregid[$regid]>2)&&($step==1)) {
$reg_form="<form method=\"POST\" action=\"$htpath/index.php\" class=\"form-inline\">
<input type=\"hidden\" name=\"register\" value=\"1\">
<input type=\"hidden\" name=\"step\" value=\"2\">
<div class=shadow><div class=ocat1 style=\"background: url('"."$htpath/grad.php?h=150&w=20&s=".str_replace("#","",$nc6)."&e=".str_replace("#","",$nc6)."&d=vertical') repeat-x scroll 0% 0% $nc6;\" align=center><b><font size=2 color=\"$nc5\">".$lang[288]."</font></b></div></div>
<table class=table border=\"0\" width=\"100%\">
  <tr>
    <td width=100% align=\"center\" valign=\"top\">".$chooseregid."
</td>
  </tr><tr>
    <td colspan=\"2\" valign=\"top\" align=center><input type=\"submit\" class=\"btn btn-primary\" class=btn style=\"width:200px; vertical-align:middle;\" value=\"$lang[289]\"></td>
  </tr>
</table>
</form>";
} else {
if (($step==2)&&($setregid[$regid]>1)) {
if ($setregid[$regid]==2) {
$reg_form=$reg_forms1.$reg_forms4.$reg_forms6."  <tr>
    <td align=\"right\" valign=\"top\"><b>".$lang[73].": <font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\"><input class=input-small type=\"text\" value=\"$telcode\" name=\"telcode\" size=\"10\" onkeyup=\"document.getElementById('e11').style.visibility='hidden';\" placeholder=\"".$lang[157]."\"><span id=e11>$e11</span>&nbsp;&nbsp;<input type=\"text\" value=\"$tel\" name=\"tel\" size=\"30\" onkeyup=\"document.getElementById('e12').style.visibility='hidden';\" placeholder=\"".$lang[73]."\"><span id=e12>$e12</span></td>
  </tr>".$reg_formsb.$reg_forms2.$submit_forms;
}else {
$reg_form=$reg_forms1.$reg_forms7.$reg_forms6."  <tr>
    <td align=\"right\" valign=\"top\"><b>".$lang[73].": <font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\"><input class=input-small type=\"text\" value=\"$telcode\" name=\"telcode\" size=\"10\" onkeyup=\"document.getElementById('e11').style.visibility='hidden';\" placeholder=\"".$lang[157]."\"><span id=e11>$e11</span>&nbsp;&nbsp;<input type=\"text\" value=\"$tel\" name=\"tel\" size=\"30\" onkeyup=\"document.getElementById('e12').style.visibility='hidden';\" placeholder=\"".$lang[73]."\"><span id=e12>$e12</span></div></td>
  </tr>".$reg_formsb.$reg_forms2.$submit_forms;
}
} else {
$reg_form="".$reg_forms1.$reg_forms5."</table>";


$reg_form.=" <table class=table border=0 width=100%>".$reg_formsb."</table>
<div id=\"delivery_form\">";
   $reg_form.="<div";
   if ($easyreg==1) {$reg_form.=" style=\"display:none; visibility:hidden;\"";  }
   $reg_form.="><div class=shadow><div class=ocat1 style=\"background: url('"."$htpath/grad.php?h=150&w=20&s=".str_replace("#","",$nc6)."&e=".str_replace("#","",$nc6)."&d=vertical') repeat-x scroll 0% 0% $nc6;\" align=center><b><font size=2 color=\"$nc5\">".$lang[156]."</font></b></div></div></div>
 <div";
   if ($easyreg==1) { if ($portal!=1) {$reg_form.=" style=\"display:none; visibility:hidden;\""; } }
   $reg_form.="><table class=table border=0 width=100%>".$reg_forms2."</table>
   </div>
   <div";
   if ($easyreg==1) { if ($portal!=1) {$reg_form.=" style=\"display:none; visibility:hidden;\""; } }
   $reg_form.="><table class=table border=0 width=100%>".$reg_forms33."</table>
   </div>
   <div";
   if ($easyreg==1) {$reg_form.=" style=\"display:none; visibility:hidden;\"";  }
   $reg_form.="><table class=table border=0 width=100%>".$reg_forms3."</table>
   </div>
 <div";
   if ($easyreg==1) {$reg_form.=" style=\"display:none; visibility:hidden;\"";  }
   $reg_form.="><table class=table border=0 width=100%><tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[28].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>
    <textarea rows=\"4\" name=\"other\" style=\"width: 90%\" cols=\"44\">$other</textarea><br>
    <span class=muted>".$lang[63]."</span></td>
  </tr></table></div></div>";

$reg_form.=  "  <table class=table border=0 width=100%>".$submit_forms."<br>";
$reg_form.=  "</div>";
  }
}
} else {
$reg_form=$reg_forms1.$reg_forms5.$reg_forms2."  <tr>
    <td align=\"right\" valign=\"top\"><b>".$lang[73].": <font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\"><input class=input-small type=\"text\" value=\"$telcode\" name=\"telcode\" size=\"10\" onkeyup=\"document.getElementById('e11').style.visibility='hidden';\" placeholder=\"".$lang[157]."\"><span id=e11>$e11</span>&nbsp;&nbsp;<input type=\"text\" value=\"$tel\" name=\"tel\" size=\"30\" onkeyup=\"document.getElementById('e12').style.visibility='hidden';\" placeholder=\"".$lang[73]."\"><span id=e12>$e12</span></div></td>
  </tr>".$reg_forms3.$submit_forms;
}
if ($regid==1) {$reg_form="<div style=\"background: url('images/flowers.png') left 70px no-repeat;\">".$reg_form;}
$reg_form=$social_auth.$reg_form;
if ($regid==1) {$reg_form.="</div>";}
?>
