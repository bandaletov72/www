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
$chatmessages=50;
$adava="";
$chat="Empty";
$u_mesa=Array();
$online="";
$u_mes=Array();

function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}

//setlocale(LC_ALL,"ru_RU.CP1251");
$cartlist="";
// default headers ***********
@Header("HTTP/1.0 200 OK");
@Header("HTTP/1.1 200 OK");
@Header("Content-type: text/html");
@Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
@Header("Last-Modified: ".gmdate("D, M d Y H:i:s",(time()-14400))." GMT");
@Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@Header("Pragma: no-cache"); // HTTP/1.0
$fold="."; require ("./templates/lang.inc");
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
//var_dump($details);
require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require ("./templates/$template/css.inc");
if ($chat_enable==1) {
$bir=Array();
if (file_exists("./admin/birthday.txt")==TRUE) {
$birthday_m= file ("./admin/birthday.txt");
while (list($key,$val)=each ($birthday_m)) {
if (trim($val)!="") {
$tmp=explode("|", $val);
if (intval($tmp[2])==0) {
$idx=$tmp[0];
$bir[$idx]=1;
}
}
}
}
$rmon = array ($lang[115],$lang[116],$lang[117],$lang[118],$lang[119],$lang[120],$lang[121],$lang[122],$lang[123],$lang[124],$lang[125],$lang[126]);
$ts=time();

if(isset($_GET['read'])) { $read=$_GET['read']; } elseif(isset($_POST['read'])) { $read=$_POST['read']; } else { $read=0; }
if(isset($_GET['data'])) { $data=$_GET['data']; } elseif(isset($_POST['data'])) { $data=$_POST['data']; } else { $data=""; }


$data=substr(str_replace(">","&gt;",str_replace("<","&lt;",htmlspecialchars(strip_tags(trim(trim(str_replace("|","",str_replace("\n","<br>",str_replace("\r","<br>",str_replace("\t"," ",$data)))))))))),0,3000);
  if ( extension_loaded('mb_string') ) {
       $data = mb_convert_encoding($data, $codepage, "UTF-8");
   } elseif ( extension_loaded('iconv') ) {
       $data = iconv("UTF-8", $codepage, $data);
   }
$data=preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>",$data);
if (!preg_match('/^[a-z0-9_]+$/i',$read)) { $read=0;}

require("./modules/webcart.php");
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

if ((!@$logout) || (@$logout=="")): $logout=""; endif;
if ($logout==1): $_SESSION["user_login"]="";  $_SESSION["user_password"]=""; $_SESSION["user_valid"]="0"; $valid="0"; session_destroy(); endif;

$cart =& $_SESSION['cart'];
if(!is_object($cart)){
$cart = new webcart();
if ((!@$_SESSION["user_valid"]) || (@$_SESSION["user_valid"]=="")):  @$_SESSION["user_login"]; @$_SESSION["user_password"]; $_SESSION["user_valid"]=""; endif;
if ($_SESSION["user_valid"]="") {
$_SESSION["user_login"]="";
$_SESSION["user_password"]="";
$_SESSION["user_valid"]="0";
}
}
if (!isset($login)){$login="";}
if (!isset($password)){$password="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$login)) { $login="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$password)) { $password="";}
if ((!@$login) || (@$login=="")): $login=""; endif;

if ((!@$qty) || (@$qty=="")): $qty=1; endif;
if (!preg_match("/^[0-9]+$/",$qty)) { $qty=1;}

if ((!@$password) || (@$password=="")): $password=""; endif;
$valid=@$_SESSION["user_valid"];
if ((!@$valid) || (@$valid=="")): $valid="0"; endif;

if ((!@$fid) || (@$fid=="")){ $fid=""; }
if (!preg_match("/^[a-z0-9_]+$/",$fid)) { $fid="";}
if ((!@$unifid) || (@$unifid=="")){ $unifid=""; }
if (!preg_match("/^[a-z0-9_]+$/",$unifid)) { $unifid="";}

$fcontentsa = file("$base_loc/catid.txt");
$r="";
$sub="";
$st=0; $out[2]=""; $out[4]=""; $out[0]=""; $out[1]="";
while (list ($line_num, $line) = each ($fcontentsa)) {
$out=@explode("|",$line);
$podstava[@$out[1]."|".@$out[2]."|"]=@$out[0];
$podstavas[@$out[1]."|".@$out[2]."|"]=@$out[4];

$st+=1;
}
$podstava["||"]="_";

header("Content-type: text/html; charset=$codepage");
if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();
if (($details[1]=="")||($details[1]=="guest")) { $data=strip_tags($data); }
$admin_url="";
if(isset($_GET['ch'])) { $ch=$_GET['ch']; } elseif(isset($_POST['ch'])) { $ch=$_POST['ch']; } else { $ch=""; }
if ( $ch=="") {
$fch=0;
echo "<!DOCTYPE html><html>
<head>
<title>Chat</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
$css
</head>
<body bgcolor=$nc0 topmargin=10 leftmargin=10 rightmargin=10 bottommargin=10 marginwidth=10 marginheight=10>";
echo "<div align=center class=round><b>".$lang[1018].":</b></div>";
$chm=file("./chat/chats.txt");
if (count($chm)>0) {

while(list($key,$val)=each($chm)) {
$val=trim(trim($val));
if ($val!="") {
$tmpch=explode("|", $val);
if (trim($tmpch[0])!="") {
if ($tmpch[3]==1) {$uregs=$lang[1019]; } else {$uregs=$lang[1020];}
echo "<div align=center class=round2 style=\"cursor:pointer; cursor:hand;\" onmouseover=\"this.style.backgroundColor='".lighter($nc2,0)."';\" onmouseout=\"this.style.backgroundColor='';\" onclick=\"document.location.href='chat.php?ch=".$tmpch[0]."&amp;speek=$speek';\"><font size=4><a href=chat.php?ch=".$tmpch[0]."&amp;speek=$speek>".$tmpch[1]."</a></font><br><font color=$nc10>".$tmpch[2]."</font><br><small>$uregs</small></div>";
$fch+=1;
}

}
}
}
if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
echo "<div align=center class=round2 style=\"cursor:pointer; cursor:hand;\" onmouseover=\"this.style.backgroundColor='".lighter($nc2,0)."';\" onmouseout=\"this.style.backgroundColor='';\" onclick=\"document.location.href='op_chat.php?speek=$speek';\"><font size=4><a href=op_chat.php?speek=$speek>OPERATOR-".$lang[1011]."</a></font></div>";
}
if ($fch==0) { echo "Not found!"; exit;}
echo "</body></html>";
} else {
$u_dir="./chat/$ch";
$u_mesf="./chat/$ch/chat.txt";
$u_onlf="./chat/$ch/online.txt";
if (is_dir("./chat/$ch")==FALSE) {
if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
mkdir($u_dir,0755);
} else{
echo "Denied [ER1]";
}
}

if(file_exists($u_mesf)==FALSE) {
if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
$fp=fopen ($u_mesf, "w");
fclose ($fp);
$fp=fopen ($u_onlf, "w");
fclose ($fp);
} else {
echo "Denied [ER2]";
}
}

if(isset($_GET['privat'])) { $privat=$_GET['privat']; } elseif(isset($_POST['privat'])) { $privat=$_POST['privat']; } else { $privat=""; }
$u_mes="";



$avafile="./admin/userstat/".$details[1]."/".$details[1].".ava";
if (!file_exists("./admin/userstat/".$details[1]."/".$details[1].".ava")) { $adava="$image_path/user.png"; } else {
$fp=fopen($avafile, "r");
$adava=trim(fread($fp,filesize($avafile)));
if ($adava=="") { $adava="$image_path/user.png"; } else { $adava="$htpath/gallery/avatars/$adava";}
}
$adava="<img src=$adava border=0>";
if (($details[1]!="")&&($details[1]!="guest")) { $chatname=$details[1]; } else {  $chatname="guest_".substr(session_id(),0,5); }

if ($data=="clear"){

if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
if ($privat!="") {$clfile="$u_dir/".md5(doubleval(@preg_replace("([\D]+)", "",md5($chatname)))+doubleval(@preg_replace("([\D]+)", "",md5($privat))))."_chat.txt";} else {$clfile="./chat/$ch/chat.txt";}
$data="<font color=cyan>".$lang[254]."</font>";
$data=$chatname."|||".time()."|$speek|||||$data|\n";
$fp=fopen($clfile, "w");
fputs($fp,$data);
fclose ($fp);
$data="";
$read=1;
}
}
if ($privat!="") {
$u_mesf="$u_dir/".md5(doubleval(@preg_replace("([\D]+)", "",md5($chatname)))+doubleval(@preg_replace("([\D]+)", "",md5($privat))))."_chat.txt";
if (!isset($_SESSION["$ch"."_chat_$privat"])) {
$data="<font color=#468847>".$lang[1013]."</font>";
if (($privat!=$details[1])&&(is_dir("./admin/userstat/".$privat))) {
$u_mesff="./admin/userstat/".$privat."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp,"<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br>".date("d-m-Y H:i",time())."<br><b>".$chatname."</b>: ".$data."<br><br><a href=chat.php?ch=$ch&privat=".rawurlencode($chatname)."&amp;speek=$speek target=".md5($chatname."chat").">".$lang[1017]."</a></td></tr></table>");
fclose($fp);
}
$data=$chatname."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);
$_SESSION["$ch"."_chat_$privat"]=1;
$read=0;
$data="";
}
} else {
if (!isset($_SESSION["$ch"."_chat"])) {
$data="<font color=#468847>".$lang[1013]."</font>";
$data=$chatname."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);
$_SESSION["$ch"."_chat"]=1;
if ($read!=22) {
$read=0;
}
$data="";
}
}


if (($data=="exit")&&($privat=="")) { unset ($_SESSION["$ch"."_chat"]);
$data="<font color=#b94a48>".$lang[1014]."</font>";
$data=$chatname."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);
echo "exit";
exit; }


if (($data=="exit")&&($privat!="")) { unset ($_SESSION["$ch"."_chat_$privat"]);
$data="<font color=#b94a48>".$lang[1014]."</font>";
if (($privat!=$details[1])&&(is_dir("./admin/userstat/".$privat))) {
$u_mesff="./admin/userstat/".$privat."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp,"<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br>".date("d-m-Y H:i",time())."<br><b>".$chatname."</b>: ".$data."<br><br><a href=chat.php?ch=main&privat=".rawurlencode($chatname)."&amp;speek=$speek target=".md5($chatname."chat").">".$lang[1017]."</a></td></tr></table>");
fclose ($fp);
}
$privat="";
$data=$chatname."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);
echo "exit";
exit; }
require ("./modules/functions.php");


if ($chatname) {
if ($data!="") {
if ($privat!="") {
if (($privat!=$details[1])&&(is_dir("./admin/userstat/".$privat))) {
$u_mesff="./admin/userstat/".$privat."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp,"<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br>".date("d-m-Y H:i",time())."<br><b>".$chatname."</b>: ".$data."<br><br><a href=chat.php?ch=main&privat=".rawurlencode($chatname)."&amp;speek=$speek target=".md5($chatname."chat").">".$lang[1017]."</a></td></tr></table>");
fclose ($fp);
}
}
$data=$chatname."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);

$read=1; }
if ($read==0) {
echo "<!DOCTYPE html><html>
<head>
<title>Chat</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
$css
</head>
<body bgcolor=$nc0 topmargin=10 leftmargin=10 rightmargin=10 bottommargin=10 marginwidth=10 marginheight=10>";
}


if (file_exists($u_mesf)) {
$u_mesa=@file($u_mesf);
}
if (count($u_mesa)>0) {
$u_mesa=array_reverse($u_mesa);
$chat="";
$i=0;
$tosave=Array();
while (list($key, $val)=each($u_mesa)) {
if ($i<$chatmessages) {
$tosave[$i]="$val";
}
$val=str_replace("'","", str_replace("\"","", trim($val)));
if ($val!="") {
$tmp=Array();
$tmp=explode("|", $val);
if ($tmp[0]!="") {
if ($tmp[0]==$chatname) { $font="$nc10"; } else { $font="$nc5"; }
$avafile="./admin/userstat/".$tmp[0]."/".$tmp[0].".ava";
if (!file_exists("./admin/userstat/".$tmp[0]."/".$tmp[0].".ava")) { $ava="$image_path/user.png"; } else {
$fp=fopen($avafile, "r");
$ava=trim(fread($fp,filesize($avafile)));
if ($ava=="") { $ava="$image_path/user.png"; } else { $ava="$htpath/gallery/avatars/$ava";}
}
$chat.="<img src=$ava align=absmiddle width=16 height=16 title=$tmp[4]><font color=$font><b>$tmp[0]</b>: ".wordwrap($tmp[9], 80, " ", 1)."</font><br><small><font color=#999999>(".date("d.m.Y H:i:s", $tmp[3]).")</font></small><br><br>";
}
$i+=1;
}

}
if ($i>20) {
$fp=fopen($u_mesf, "w");
fputs($fp,implode("",array_reverse($tosave)));
fclose ($fp);
}
unset ($u_mesa,$key,$val,$tmp,$ava);
}
$u_mesf="./admin/online.txt";
$u_mesa=Array();
if (file_exists($u_mesf)) {
$u_mesa=file($u_mesf);
}
if (count($u_mesa)>0) {
natcasesort($u_mesa);
$online="";
while (list($key, $val)=each($u_mesa)) {
$val=str_replace("'","", str_replace("\"","", trim($val)));
if ($val!="") {
$tmp=Array();
$tmp=explode("|", $val);
if ($tmp[0]!="") {
if ($tmp[1]==$chatname) { $font="$nc10"; } else { $font="$nc5"; }
$avafile="./admin/userstat/".$tmp[1]."/".$tmp[1].".ava";
if (!file_exists("./admin/userstat/".$tmp[1]."/".$tmp[1].".ava")) { $ava="$image_path/user.png"; } else {
$fp=fopen($avafile, "r");
$ava=trim(fread($fp,filesize($avafile)));
if ($ava=="") { $ava="$image_path/user.png"; } else { $ava="$htpath/gallery/avatars/$ava";}
}
if (($details[1]!="guest")&&($details[1]!="")) {
$idx=$tmp[1];
if (!isset($bir[$idx])) { $birtc=""; $birti="";} else { $birtc=" class=round2"; $birti="<br><img src=$image_path/birthday.png border=0 align=absmiddle><font color=#b94a48 size=3><b>$lang[114]!</b></font>";}

if ($read==22) {
if ($portal==1) {
$online.="<tr><td".$birtc."><a href=chat.php?ch=$ch&privat=".rawurlencode($tmp[1])."&amp;speek=$speek target=_blank><img class=shadow src=$ava align=left width=26 height=26 border=0 style=\"border: 2px solid $nc0; width: 26px; height: 26px; -webkit-border-radius: 3px; border-radius: 3px;\"><font color=$font size=1><b>$tmp[3]</b></a></font>$birti<br><font class=small>".$tmp[5]."</font><br><font class=small>".$tmp[4]." <b>".date("H:i:s", $tmp[0])."</b></font></td></tr>\n";
} else {
$online.="<tr><td".$birtc."><a href=chat.php?ch=$ch&privat=".rawurlencode($tmp[1])."&amp;speek=$speek><img src=$ava align=absmiddle width=20 height=20 hspace=5 vspace=2 border=0><font color=$font>$tmp[1]</a></font>$birti</td></tr>";
}
} else {
if ($portal==1) {
$online.="<a href=chat.php?ch=$ch&privat=".rawurlencode($tmp[1])."&amp;speek=$speek><img class=shadow src=$ava align=left width=26 height=26 border=0 class=shadow hspace=10><font color=$font size=1><b>$tmp[3]</b></a></font>$birti<br><font class=small>".$tmp[5]."</font><br><font class=small>".$tmp[4]." <b>".date("H:i:s", $tmp[0])."</b></font><br><br>";

} else {
$online.="<a href=chat.php?ch=$ch&privat=".rawurlencode($tmp[1])."&amp;speek=$speek><img src=$ava align=absmiddle width=20 height=20 hspace=5 vspace=2 border=0><font color=$font>$tmp[1]</a></font>$birti<br>";
}
}

} else {
$online.="<img src=$ava align=absmiddle width=20 height=20 hspace=5 vspace=2><font color=$font>$tmp[1]</font><br>";
}
}
}
}
unset ($u_mesa,$key,$val,$tmp);
}
if ($read==1) {
echo $chat;
} else {
if (($read==2)||($read==22)) {
if ($read==22) {
echo "<!DOCTYPE html><html><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"10;URL=chat.php?ch=main&amp;speek=$speek&privat=&read=22\">
<title>Online users</title><style type=\"text/css\">
body{
	font: 8pt/140% $main_fontface,Arial, Helvetica, Geneva, sans-serif;
	color: $nc5;
    font-weight: lighter;
}
BODY A:link {COLOR: $nc4; TEXT-DECORATION: none}
BODY A:visited {COLOR: $nc4; TEXT-DECORATION: none}
BODY A:hover {COLOR: $nc4; TEXT-DECORATION: underline}
BODY A:active {COLOR: $nc4; TEXT-DECORATION: underline}
.shadow {
-webkit-box-shadow: 0 4px 5px rgba(0,0,0,0.3);
-moz-box-shadow: 0 4px 5px rgba(0,0,0,0.3);
box-shadow: 0 4px 5px rgba(0,0,0,0.3);
margin-bottom : 10px;
}
</style><body><table width=100% border=0 cellspacing=5 cellpadding=0>";
echo $online;
echo "</table></body></html>";
}else {
echo $online;
}
} else {
echo "<center><br><div align=center><div class=round3 style=\"width:90%;\">
<table border=0 width=100% cellpadding=0 cellspacing=5>
<tr>
<td colspan>
<div id=\"clock\" style=\"white-space: nowrap; font-family: courier; margin-left:10px;\">&nbsp;&nbsp;<span>". date("d",$ts)." ".$rmon[date("m",$ts)-1]." ".date("Y",$ts)."</span><a id=message_box href=\"$htpath/message.php?session=$sid\"></a><input type=hidden id=viewmessage value=\"\"></div><script language=javascript><!--

var timerId;
function showmessage() {

$.ajax({
  type: \"POST\",
  url: \"chat.php\",
  data: \"ch=$ch&amp;speek=$speek&privat=$privat&read=1&session=$sid\",
  success: function(msg){
   $(document).ready(function() {
    document.getElementById('chatwindow').innerHTML=msg;
        });


  }
});
$.ajax({
  type: \"POST\",
  url: \"chat.php\",
  data: \"ch=$ch&amp;speek=$speek&privat=$privat&read=2&session=$sid\",
  success: function(msg){
    $(document).ready(function() {
    document.getElementById('onlinewindow').innerHTML=msg;
        });


  }
});
}

function update() {
  var date = new Date();
  var seconds = date.getSeconds();
  if ((seconds/5)==Math.floor(seconds/5)) {showmessage(); }
}

function clockStart() {
  if (timerId) return;
  timerId=self.setInterval(function(){update()},500);
}

function clockStop() {
  clearInterval(timerId);
  timerId = null;
}


clockStart();

function send()
{
var data = $('#mydata').val();
if (data!='') {
       $.ajax({
                type: \"POST\",
                url: \"chat.php\",
                data: \"ch=$ch&session=$sid&amp;speek=$speek&privat=$privat&data=\"+data,
                success: function(html) {
                document.getElementById('mydata').value='';
                        $(\"#chatwindow\").empty();
                        $(\"#chatwindow\").append(html);
                        if (html=='exit') {document.location.href='chat.php?speek=$speek&session=$sid';}
                }
        });

}
}
";

if (($details[7]=="ADMIN")||($details[7]=="MODER")) { echo "
function clearchat()
{
       $.ajax({
                type: \"POST\",
                url: \"chat.php\",
                data: \"ch=$ch&amp;speek=$speek&privat=$privat&data=clear&session=$sid\",
                success: function(html) {
                document.getElementById('mydata').value='';
                        $(\"#chatwindow\").empty();
                        $(\"#chatwindow\").append(html);
                }
        });


}

"; }
$priva="";
$privc="";
if ($valid=="1") {
if ($privat!="") { $priva="<font color=$nc10 size=3><b>".$privat." <img border=0 align=absmiddle src=$image_path/chat.gif hspace=10> $details[1]</b></font>"; $privc="<div align=center><font class=small>$lang[1012]</font></div>";}
}
echo "
function exit()
{
       $.ajax({
                type: \"POST\",
                url: \"chat.php\",
                data: \"ch=$ch&amp;speek=$speek&privat=$privat&data=exit&session=$sid\",
                success: function(html) {
                document.getElementById('mydata').value='';
                        $(\"#chatwindow\").empty();
                        $(\"#chatwindow\").append(html);
                        if (html=='exit') {document.location.href='chat.php?speek=$speek&session=$sid';}
                }
        });

}

function sendtext(e)
{
    if (e.keyCode == 13)
    {
        send();
        return false;
    }
}
--></script></td><td align=center colspan=3>$priva</td></tr><tr><td width=80% valign=top>
<div id=chatwindow style=\"padding:10px; width:auto; height:300px; overflow-y:auto; overflow-x:hidden;\">$chat</div></td>
<td valign=top width=20% colspan=3>$privc<div id=onlinewindow style=\"padding:10px; width:auto; height:280px; overflow:auto;\">$online</div></td></tr>

<tr><td><input type=text style=\"width:96%; height:38px; font-size: 15pt;\" id=mydata value=\"\" onkeyup=\"sendtext(event);\"></td><td valign=top><button type=button class=\"btn btn-primary btn-large\" onclick=send();><img src=$image_path/send_icon.png></button></td><td align=right>";

if (($details[7]=="ADMIN")||($details[7]=="MODER")) { echo "<button type=button onclick=clearchat(); class=submit style=\"height:35px;\">".$lang['clear']."</button>";
}
echo "</td><td><button type=button onclick=exit(); class=submit style=\"height:35px;\">".$lang['exit']."</button></td></tr>
</table>
</div>
</div></center>";
echo "</body></html>";
}
}
}
}
} else {
echo "Sorry! Chat disabled.";
}
?>
