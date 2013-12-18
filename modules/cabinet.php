<?php
if(isset($_GET['sump'])) $sump=$_GET['sump']; elseif(isset($_POST['sump'])) $sump=$_POST['sump']; else $sump="";
if (!preg_match("/^[0-9\,\.]+$/",$sump)) { $sump="";}

$checkout="";
$payment_select="";
$jpm="";
$jpmload="";



if (isset($_GET['sub'])) { $sub=$_GET['sub']; } elseif(isset($_POST['sub'])) { $sub=$_POST['sub']; } else { $sub=""; }
if (!preg_match('/^[0-9a-z]+$/i',$sub)) { $sub="";}
if ($user_wallet_enable==0) {$sub="";}
if (isset($_GET['payment_mode'])) { $payment_mode=$_GET['payment_mode']; } elseif(isset($_POST['payment_mode'])) { $payment_mode=$_POST['payment_mode']; } else { $payment_mode=""; }
if (!preg_match('/^[0-9a-z]+$/i',$payment_mode)) { $payment_mode="";}
if (isset($_GET['payment_sum'])) { $payment_sum=$_GET['payment_sum']; } elseif(isset($_POST['payment_sum'])) { $payment_sum=$_POST['payment_sum']; } else { $payment_sum=""; }
if (!preg_match('/^[0-9a-z\. ,]+$/i',$payment_sum)) { $payment_sum="";}
$payment_sum=str_replace(" ", "", str_replace(",", ".",$payment_sum));
$payment_sum=doubleval($payment_sum);
if ((!isset($_GET['login'])) && (!isset($_GET['password']))) {
if ($cart->user_details[1]!="vip0020") {
$avasel="";
$cabinet="";
$errs="";
$mod="admin";
$caberror="";
$caberror2="";
$cabstat="";
$metrosel="";
$countsel="";
$e4="";
$e11="";
$e12="";
$fregid="";
reset ($reg_as);

while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);

$setregid[$srrnum]=$srmasss[1];
$setregid2[$srrnum]=$srmasss[0];
}
}
reset ($reg_as);


if (!isset($cabsend)) {$cabsend=""; }
if (!isset($cu)) {$cu=""; }
$cabsend=trim(substr($cabsend,0,4));

if (!preg_match("/^[a-z]+$/i",$cabsend)) { $cabsend="";}
$cu=trim(substr($cu,0,4));
if (!preg_match("/^[a-z]+$/i",$cu)) { $cu="";}

if (($valid!=0)&&($login!="")&&($password!="")) {

if ($cu!="") {
$regid=$details[0];
$reg_log=$details[1];
$reg_pass=$details[2];
$reg_pass2=$details[2];

require ("./modules/verify_reg.php");
if($errs=="") {
//echo "ffuscab=$ffuscab";
$strok="$regid|$reg_log|$reg_pass|$fio|$email|$tel|$details[6]|$details[7]|$metro|$street|$house|$korp|$pod|$domophone|$ofice|$flat|$other|$gorod|$country|$telcode|$ffuscab";
$error=save_user($strok,$cart->user_where,"");
$cabinet.="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";
if ($error!="") {
$cabinet.=str_replace("\"","", str_replace("'","",$error));
}


$cabinet.=str_replace("\"","", str_replace("'","","<br><font color=$nc3><h4>".$lang[456]."</h4></font><br>"));
$cabinet.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$cart->user_details[3]=$fio;
$cart->user_details[4]=$email;
$cart->user_details[5]=$tel;
$cart->user_details[8]=$metro;
$cart->user_details[9]=$street;
$cart->user_details[10]=$house;
$cart->user_details[11]=$korp;
$cart->user_details[12]=$pod;
$cart->user_details[13]=$domophone;
$cart->user_details[14]=$ofice;
$cart->user_details[15]=$flat;
$cart->user_details[16]=$other;
$cart->user_details[17]=$gorod;
$cart->user_details[18]=$country;
$cart->user_details[19]=$telcode;
$tmpdet=explode("|",$ffuscab);
$tmpindexcu=20;
while (list ($cabnum1, $cabst1) = @each ($tmpdet)){
$cart->user_details[$tmpindexcu]=$cabst1;
$tmpindexcu+=1;
}
}
}
}

if (!isset($cabzak)){$cabzak=0;}
$cabzak=trim(substr($cabzak,0,20));
if (!preg_match("/^[0-9]+$/",$cabzak)) { $cabzak=0;
if ($cabsend=="yes") {$error2="<div class=\"mr ml well\"><font color=#b94a48>
".$lang[457]."</font></div><br>"; }}
if (!isset($cabsend)){$cabsend="";}

if (!isset($cabmail)){$cabmail="";}
$cabmail=trim(substr($cabmail,0,100));
if(!preg_match("/^[a-zA-Z0-9\@\.\_\-]+$/i", $cabmail)) { $cabmail="";
if ($cabsend=="yes") {$error="<div class=\"mr ml well\"><font color=#b94a48>
".$lang[457]."</font></div><br>"; }}

$cabform="<a name=\"cabz\"></a><br><br><br><div class=well>$lang[450]
<form class=form-inline action=\"index.php\" method=\"POST\">
<input type=\"hidden\" name=\"action\" value=\"cabinet\">
<input type=\"hidden\" name=\"cabsend\" value=\"yes\">
<table border=0><tr><td><b>
".$lang[454].": </b></td><td><input type=\"text\" name=\"cabzak\" value=\"\" placeholder=\"".$lang[453]."\"> <i class=muted></i></td></tr><tr><td><b>
E-mail:</b></td><td><input type=\"text\" name=\"cabmail\" value=\"\"> <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[455]."\"></td></tr><tr><td colspan=2 align=center>
$caberror2 $caberror</td></tr></table>
</form>
</div>";



if (($cabsend=="yes")&&($cabzak!="")&&($cabmail!="")) {

$cabstat="<div class=\"well\"><b>".$lang[458].":</b><br><br>";
if (@file_exists("./admin/invoices/inv_$cabzak.html")==FALSE) {
$cabstat.="<b>".$lang[461]."</b>"."<br><br>";
} else {


$mailst="";
$tmpcab=file("./admin/baskets/list.txt");
while (list ($cabnum, $cabst) = @each ($tmpcab)){
//echo $cabst."<br>";
$tmpcabst=explode("|",$cabst);
if($cabzak==$tmpcabst[0]) {
$mailst=$tmpcabst[2];
break;
}
}
if (($mailst!="")&&($mailst==$cabmail)) {
if (@file_exists("./admin/orderstatus/$cabzak.txt")==FALSE) {
$cabstat.=$lang[244]." <b>".$lang[243]."</b><br>".$lang[371].": ".date("d.m.y в H:i", filemtime("./admin/invoices/inv_$cabzak.html"))."<br><br>";
} else {
$file = fopen ("./admin/orderstatus/$cabzak.txt", "r");
$cabstat.="<div><b>".fread ($file, filesize("./admin/orderstatus/$cabzak.txt"))."</b></div><br>";
fclose ($file);
}
} else {
$cabstat.="<b>".$lang[451]."</b>";
}
}
$cabstat.="</div>";
}

if (($valid!=0)&&($login!="")&&($password!="")) {

if (!isset($_GET['ch_avatar'])) { $_GET['ch_avatar']="";}
if (!isset($_GET['avatar_type'])) { $_GET['avatar_type']="";}
if (!preg_match("/^[0-9a-zA-Z_-]+$/i",$_GET['ch_avatar'])) { $_GET['ch_avatar']="";}
if (!preg_match("/^[pngjife]+$/i",$_GET['avatar_type'])) { $_GET['avatar_type']="";}
if (($_GET['ch_avatar']!="")&&($_GET['avatar_type']!="")) {
//change avatar

$typ=$_GET['avatar_type'];

if (($typ!="jpg")&&($typ!="jpeg")&&($typ!="gif")&&($typ!="png")&&($typ!="PNG")&&($typ!="JPG")&&($typ!="JPEG")&&($typ!="GIF")&&($typ!="Png")&&($typ!="Jpg")&&($typ!="Jpeg")&&($typ!="Gif")&&($typ!="Png")){

$errs.="<br>Avatar type not recognized! Please choose another avatar!<br>";
} else {
$ava_file="./gallery/avatars/".$_GET['ch_avatar'].".$typ";
if (file_exists($ava_file)==false) {
$errs.="<br>Avatar not found! Please choose another avatar!<br>";
} else {
if (is_dir("./admin/userstat/$login")==FALSE) { mkdir("./admin/userstat/$login",0755); }
$afp=fopen("./admin/userstat/$login/$login.ava", "w");
fputs($afp,$_GET['ch_avatar'].".$typ");
$_SESSION["avatar"]="gallery/avatars/".$_GET['ch_avatar'].".$typ";
fclose ($afp);
}
}
}
$ava_image="";
if (file_exists("./admin/userstat/$login/$login.ava")==true) {
$afp=fopen("./admin/userstat/$login/$login.ava", "r");
$ava_image=fread($afp,filesize("./admin/userstat/$login/$login.ava"));
fclose ($afp);
}
if ($ava_image!="") {$ava_image="<img src=\"gallery/avatars/$ava_image\" border=0 title=\"$login\"><br>";}
$cabinet.="<div align=center>";
$regid=$details[0];
$step=2;
require ("./modules/form.php");
$cabinet.="$errs<form class=form-inline action=\"index.php\" method=\"POST\">
<input type=\"hidden\" name=\"action\" value=\"cabinet\">
<div class=shadow><div align=center><h4 class=mu>".$lang[108].":</h4><hr></div></div>
  <table width=100% border=0 cellspacing=0 cellpdadding=0>
  <tr><td valign=top>
  <table class=table border=0 width=100% cellspacing=10 cellpadding=3>";
  $avasel="</table>
</td>
<td valign=top align=center width=240><img src=$image_path/pix.gif width=200 height=1><br>$ava_image<i class=icon-user></i><b>$details[1]</b> (".$details[7].")";
if ($user_wallet_enable==1) {$avasel.="<table border=0 cellpadding=10 width=100% class=ocat1><tr><td align=center><b><u>".$lang[1120]."</u></b><br><br>".$lang[1121].": <b>".get_walet_total(md5($details[1]).md5(strrev($details[1])))."</b>&nbsp;$init_currency<br><br><a href=\"$htpath/index.php?action=cabinet&sub=transaction\" class=btn><i class=icon-plus-sign></i> <b>".$lang[1122]."</b></a><br><br><a href=\"#MD2\" role=\"button\" class=\"btn\" data-toggle=\"modal\">".$lang[1586]."</a><div class=\"modal hide\" id=\"MD2\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD2Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD2Label\">".$lang[1586]."</h3>
</div>
<div class=\"modal-body\">$lang[1121]: <b>".get_walet_total(md5($details[1]).md5(strrev($details[1])))."</b> $init_currency<br><br>".get_walet_log(md5($details[1]).md5(strrev($details[1])))."</div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</a></div>
</div></td></tr></table>";}
$avasel.="<div><a class='btn btn-info' href='".$htpath."/index.php?action=avatar'><i class='icon-user icon-white'></i><font color=white> ".$lang[1124]."</font></a></div><br></td></tr></table>
<table border=\"0\" width=\"100%\" cellspacing=\"10\" cellpadding=\"3\">";

if (($step==2)&&($setregid[$regid]>1)) {
if ($setregid[$regid]==2) {
$cabinet.=$reg_forms4.$reg_forms6.$reg_formsb.$reg_forms2.str_replace($lang[1124],$lang[1127], $avasel).$submit_forms;
} else {
$cabinet.=$reg_forms7.$reg_forms6.$reg_formsb.$reg_forms2.$avasel.$submit_forms;
}
} else {
$cabinet.=$reg_forms5.$reg_formsb.$reg_forms2.$avasel.$reg_forms3.$submit_forms;
}

$cabinet=str_replace(" onchange=\"javascript:selectsd();\"", "", str_replace(" onchange=\"javascript:selectsd();\"", "", $cabinet));
$cabinet.="</table><input type=hidden name=\"cu\" value=\"yes\"><input class=\"btn btn-large btn-primary\" type=submit value=\"".$lang['ch']."\"></form></div><br><br>";
if ($regid==1) {$cabinet="<div style=\"background: url('images/flowers.png') left 70px no-repeat;\">".$cabinet."</div>";}
}
$cabus="";
if ($smod=="shop") {
if ($userstats!="") {
$cabus="<br>
$userstats";
} else {
$cabus="".$lang[451]."<br><br>".$lang[452]."<br><br><br>";
}
} else {
$cabform="";
}
if ($sub=="transaction") {
//$cabinet="";
$avasel="</table>
</td>
<td valign=top align=center width=240>
<img src=$image_path/pix.gif width=200 height=1>
<br>$ava_image<i class=icon-user></i><b>$details[1]</b> (".$details[7].")
<table border=0 cellpadding=10 width=100% class=ocat1>
<tr>
<td align=center>".$lang[1121].": <b>".get_walet_total(md5($details[1]).md5(strrev($details[1])))."</b>&nbsp;$init_currency<br><br><a href=\"#MD2\" role=\"button\" class=\"btn\" data-toggle=\"modal\">".$lang[1586]."</a><div class=\"modal hide\" id=\"MD2\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD2Label\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"MD2Label\">".$lang[1586]."</h3>
</div>
<div class=\"modal-body\">$lang[1121]: <b>".get_walet_total(md5($details[1]).md5(strrev($details[1])))."</b> $init_currency<br><br>".get_walet_log(md5($details[1]).md5(strrev($details[1])))."</div>
<div class=\"modal-footer\">
<a href=\"#\" class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</a></div>
</div></td></tr></table><br><br></td></tr></table>
<table border=\"0\" width=\"100%\" cellspacing=\"10\" cellpadding=\"3\">";
 //способы оплаты
$checked=" checked";
$vv=1;
if (isset($payment_metode)) {
while (list ($srrnum, $srrline) = each ($payment_metode)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if(($srmasss[1]!=0)&&(preg_match("/\.php/i", $srmasss[3])==true)) {

$payment_select.="<div id=\"pm$srrnum\" style=\"height: 25px;\"><input type=\"radio\" value=\"$srrnum\" name=\"payment_mode\""."$checked id=v$srrnum><label for=v$srrnum>".$srmasss[0]."</label></div>";
$vv++;
if ($checked!="") {$checked="";}
}
unset ($srmasss);
}
}
reset ($payment_metode);

}
$cabinet="<table border=0 width=100% cellspacing=0 cellpadding=0><td valign=top width=100%><a href=$htpath/index.php?action=cabinet><img src=$image_path/ofb.png align=absmiddle border=0 hspace=10>$lang[1118]</a>
<table border=0 width=100% cellspacing=10 cellpadding=3><tr><td valign=top>
<form class=form-inline action=index.php method=POST>

<h4>$lang[1119]</h4>
<input type=hidden name=action value=cabinet>
<input type=hidden name=sub value=payment>
$payment_select

<div><br><b>$lang[1117]</b><br><br></div>
$lang[217]: <input type=text name=payment_sum size=10 value=\"$sump\" class=input-small> $init_currency<br>
<i class=muted>$lang[1114]</i>
<br><br><br><br>
<div align=left><input class=\"btn btn-large btn-primary\" type=submit value=\"$lang[1116]\"></div>
</form>
</td></tr>
$avasel
<tr><td><br><div class=well><span class=\"label label-important\">$lang[211]</span> $lang[1123]</div></td><tr></table>";

} else {
if ($sub=="payment") {
//$cabinet="";
$avasel="</table>
</td></tr></table>
<table border=\"0\" width=\"100%\" cellspacing=\"10\" cellpadding=\"3\">";
 //способы оплаты
$checked=" checked";
$paymentexist=0;
$paymentname="";
$paymentmodule="";
$tmptmp=Array();
if (isset($payment_metode)) {
while (list ($srrnum, $srrline) = each ($payment_metode)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if(($payment_mode!=0)&&($payment_mode==$srrnum)&&($srmasss[1]!=0)&&(preg_match("/\.php/i", $srmasss[3])==true)) {
$tmptmp=$srmasss;
$paymentexist=1;
$paymentname=$srmasss[0];
$paymentmodule=$srmasss[3];
}
unset ($srmasss);
}
}
reset ($payment_metode);

}
if (($payment_sum>0)&&($paymentexist==1)&&($paymentmodule!="")&&(file_exists("./payment_modules/$paymentmodule")==true))  {

$cart->itemcount=$payment_sum;
$totulus=$payment_sum;
$nomer=date("d_m_Y/H:i", time())." $lang[1122]:". $details[1];
$basout=$nomer;
$verifylist="";

require "./payment_modules/".$paymentmodule;
$cabinet="<table border=0 width=100% cellspacing=0 cellpadding=0><td valign=top width=100%><a href=$htpath/index.php?action=cabinet&sub=transaction><img src=$image_path/ofb.png align=absmiddle border=0 hspace=10>".$lang['back']."</a>
<table border=0 width=100% cellspacing=10 cellpadding=3><tr><td valign=top>

<h4>$paymentname / $lang[217]: <b>$payment_sum</b>  $init_currency</h4>


$verifylist
</td></tr>
$avasel
<tr><td><br><div class=well><span class=\"label label-important\">$lang[211]</span> $lang[1123]</div></td><tr></table>";
$cart->itemcount=0;
} else {
$cabinet="<table border=0 width=100% cellspacing=0 cellpadding=0><td valign=top><a href=$htpath/index.php?action=cabinet&sub=transaction><img src=$image_path/ofb.png align=absmiddle border=0 hspace=10>".$lang['back']."</a>
<table border=0 width=100% cellspacing=10 cellpadding=3><tr><td valign=top>

<h4>$lang[42]</h4>
";
if ($paymentmodule!="") {} else { $cabinet.="<div class=\"alert alert-error\">Unknown payment module: <b>$payment_mode</b>!</div>";}
if (file_exists("./payment_modules/$paymentmodule")==true) {} else { $cabinet.="<div class=\"alert alert-error\">Payment module <b>./payment_modules/$paymentmodule</b> not found!</div>";}
if ($paymentexist==1) {} else { $cabinet.="<div class=\"alert alert-error\">$lang[1119]!</div>";}
if ($payment_sum>0) {} else { $cabinet.="<div class=\"alert alert-error\">$lang[1117]!</div>";}

$cabinet.="</td></tr>
$avasel
<tr><td><br><div class=well><span class=\"label label-important\">$lang[211]</span> $lang[1123]</div></td><tr></table>";
}
} else {
$cabinet=$cabstat.$cabinet.$cabus.$cabform;
}
}
} else {
$cabinet="SPECIAL USERS DONT ALLOW EDIT USER DATA!";
}
} else {
$cabinet="HACK ATTEMPT?";
}
?>
