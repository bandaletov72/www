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

$rmon = array ($lang[115],$lang[116],$lang[117],$lang[118],$lang[119],$lang[120],$lang[121],$lang[122],$lang[123],$lang[124],$lang[125],$lang[126]);
$ts=time();

if(isset($_GET['read'])) { $read=$_GET['read']; } elseif(isset($_POST['read'])) { $read=$_POST['read']; } else { $read=0; }
if(isset($_GET['data'])) { $data=$_GET['data']; } elseif(isset($_POST['data'])) { $data=$_POST['data']; } else { $data=""; }

$data=preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a href=\"http\\3://\\5\\6\\8\\9\" title=\"\\0\">\\5\\6</a>",substr(str_replace(">","&gt;",str_replace("<","&lt;",htmlspecialchars(strip_tags(trim(trim(str_replace("|","",str_replace("\n","<br>",str_replace("\r","<br>",str_replace("\t"," ",$data)))))))))),0,3000));
  if ( extension_loaded('mb_string') ) {
       $data = mb_convert_encoding($data, $codepage, "UTF-8");
   } elseif ( extension_loaded('iconv') ) {
       $data = iconv("UTF-8", $codepage, $data);
   }

if (!preg_match('/^[a-z0-9_]+$/i',$read)) { $read=0;}
require("./modules/webcart.php");
session_cache_limiter ('nocache');
session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt));
if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

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
$admin_url="";

if(isset($_GET['privat'])) { $privat=$_GET['privat']; } elseif(isset($_POST['privat'])) { $privat=$_POST['privat']; } else { $privat=""; }
$u_mes="";
$u_mesf="./admin/userstat/".$details[1]."/chat.txt";
if ($privat!="") {
if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
$u_mesf="./admin/userstat/".$privat."/chat.txt";
}
}
if (($details[7]=="ADMIN")||($details[7]=="MODER")) {

$avafile="./admin/userstat/".$details[1]."/".$details[1].".ava";
if (!file_exists("./admin/userstat/".$details[1]."/".$details[1].".ava")) { $adava="$image_path/user.png"; } else {
$fp=fopen($avafile, "r");
$adava=trim(fread($fp,filesize($avafile)));
if ($adava=="") { $adava="$image_path/user.png"; } else { $adava="$htpath/gallery/avatars/$adava";}
}
$adava="<img src=$adava border=0>";

if ($privat!="") {

if (!isset($_SESSION["chat_$privat"])) {
$data="<font color=#468847>".$lang[1013]."</font>";
if (($privat!=$details[1])&&(is_dir("./admin/userstat/".$privat))) {
$u_mesff="./admin/userstat/".$privat."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp,"<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br><b>".$details[1]."</b>: ".$data."<br><br><a href=op_chat.php?privat=".rawurlencode($details[1])."&speek=$speek target=_blank>".$lang[1017]."</a></td></tr></table>");
fclose($fp);
}
$data=$details[1]."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);
$_SESSION["chat_$privat"]=1;
$read=0;
$data="";
}
}
} else {
$privat="";
}
if (($data=="clear")&&($privat!="")){

if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
$data="<font color=cyan>".$lang[254]."</font>";
if (($privat!=$details[1])&&(is_dir("./admin/userstat/".$privat))) {
$u_mesff="./admin/userstat/".$privat."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp,"<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br><b>".$details[1]."</b>: ".$data."<br><br><a href=op_chat.php?privat=".rawurlencode($details[1])."&speek=$speek target=_blank>".$lang[1017]."</a></td></tr></table>");
fclose ($fp);
}
$privat="";
$data=$details[1]."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "w");
fputs($fp,$data);
fclose ($fp);
$data="";
$read=1;
}
}
if (($data=="clear")&&($privat=="")){

if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
$data="<font color=cyan>".$lang[254]."</font>";
$data=$details[1]."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "w");
fputs($fp,$data);
fclose ($fp);
$data="";
$read=1;
}
}
if (($data=="exit")&&($privat!="")) { unset ($_SESSION["chat_$privat"]);
$data="<font color=#b94a48>".$lang[1014]."</font>";
if (($privat!=$details[1])&&(is_dir("./admin/userstat/".$privat))) {
$u_mesff="./admin/userstat/".$privat."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp,"<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br><b>".$details[1]."</b>: ".$data."<br><br><a href=op_chat.php?privat=".rawurlencode($details[1])."&speek=$speek target=_blank>".$lang[1017]."</a></td></tr></table>");
fclose ($fp);
}
$privat="";
$data=$details[1]."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);
echo "exit";
exit; }
if (($data=="exit")&&($privat=="")) { unset ($_SESSION["chat_$privat"]);
$data="<font color=#b94a48>".$lang[1014]."</font>";
$privat="";
$data=$details[1]."|||".time()."|$speek|||||$data|\n";
$fp=fopen($u_mesf, "a");
fputs($fp,$data);
fclose ($fp);
echo "exit";
exit; }
require ("./modules/functions.php");

if (($details[1]!="")&&($details[1]!="guest")) {
if ($data!="") {
if ($privat!="") {
if (($privat!=$details[1])&&(is_dir("./admin/userstat/".$privat))) {
$u_mesff="./admin/userstat/".$privat."/inbox.txt";
$fp=fopen($u_mesff, "a");
fputs($fp,"<table border=0><tr><td valign=top>$adava</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br><b>".$details[1]."</b>: ".$data."<br><br><a href=op_chat.php?privat=".rawurlencode($details[1])."&speek=$speek target=_blank>".$lang[1017]."</a></td></tr></table>");
fclose ($fp);
}
}
$data=$details[1]."|||".time()."|$speek|||||$data|\n";
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
if ($i<20) {
$tosave[$i]="$val";
}
$val=str_replace("'","", str_replace("\"","", trim($val)));
if ($val!="") {
$tmp=Array();
$tmp=explode("|", $val);
if ($tmp[0]!="") {
if ($tmp[0]==$details[1]) { $font="$nc10"; } else { $font="$nc5"; }
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
if ($tmp[1]==$details[1]) { $font="$nc10"; } else { $font="$nc5"; }
$avafile="./admin/userstat/".$tmp[1]."/".$tmp[1].".ava";
if (!file_exists("./admin/userstat/".$tmp[1]."/".$tmp[1].".ava")) { $ava="$image_path/user.png"; } else {
$fp=fopen($avafile, "r");
$ava=trim(fread($fp,filesize($avafile)));
if ($ava=="") { $ava="$image_path/user.png"; } else { $ava="$htpath/gallery/avatars/$ava";}
}


if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
$u_lurl="./admin/userstat/".$tmp[1]."/lastvisit.url";
$u_time="";
$u_url="index.php";
if (file_exists($u_lurl)) {
$fp=fopen($u_lurl,"r");
$u_url=fread($fp,filesize($u_lurl));
fclose($fp);
$u_time=date("H:i:s",filemtime($u_lurl));
}
$online.="<a href=$u_url target=_blank><img border=0 src=$image_path/link.png align=absmiddle></a><a href=op_chat.php?privat=".rawurlencode($tmp[1])."&speek=$speek><img src=$ava align=absmiddle width=16 height=16 border=0><font color=$font><b>$tmp[1]</b></a> <small>$u_time</small><br>";
} else {
$online.="<img src=$ava align=absmiddle width=16 height=16><font color=$font><b>$tmp[1]</b><br>";
}
}
}
}
unset ($u_mesa,$key,$val,$tmp);
}
if ($read==1) {
echo $chat;
} else {
if ($read==2) {
echo $online;
} else {
echo "<center><br><div align=center><div class=round3 style=\"width:90%\";>
<table border=0 width=100% cellpadding=0 cellspacing=5>
<tr>
<td colspan>
<div id=\"clock\" style=\"white-space: nowrap; font-family: courier; margin-left:10px;\">&nbsp;&nbsp;<span>". date("d",$ts)." ".$rmon[date("m",$ts)-1]." ".date("Y",$ts)."</span><a id=message_box href=\"$htpath/message.php?session=$sid\"></a><input type=hidden id=viewmessage value=\"\"></div><script language=javascript><!--

var timerId;
function showmessage() {

$.ajax({
  type: \"POST\",
  url: \"op_chat.php\",
  data: \"privat=$privat&speek=$speek&read=1&session=$sid\",
  success: function(msg){
   $(document).ready(function() {
    document.getElementById('chatwindow').innerHTML=msg;
        });


  }
});
$.ajax({
  type: \"POST\",
  url: \"op_chat.php\",
  data: \"privat=$privat&speek=$speek&read=2&session=$sid\",
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

function exit()
{
       $.ajax({
                type: \"POST\",
                url: \"op_chat.php\",
                data: \"speek=$speek&privat=$privat&data=exit&session=$sid\",
                success: function(html) {
                document.getElementById('mydata').value='';
                        $(\"#chatwindow\").empty();
                        $(\"#chatwindow\").append(html);
                        if (html=='exit') {document.location.href='chat.php?speek=$speek';}
                }
        });


}
";

if (($details[7]=="ADMIN")||($details[7]=="MODER")) { echo "
function clearchat()
{
       $.ajax({
                type: \"POST\",
                url: \"op_chat.php\",
                data: \"speek=$speek&privat=$privat&data=clear&session=$sid\",
                success: function(html) {
                document.getElementById('mydata').value='';
                        $(\"#chatwindow\").empty();
                        $(\"#chatwindow\").append(html);
                }
        });


}
";
}
echo "

function send()
{
var data = $('#mydata').val();
if (data!='') {
       $.ajax({
                type: \"POST\",
                url: \"op_chat.php\",
                data: \"privat=$privat&speek=$speek&session=$sid&data=\"+data,
                success: function(html) {
                document.getElementById('mydata').value='';
                        $(\"#chatwindow\").empty();
                        $(\"#chatwindow\").append(html);
                        if (html=='exit') {document.location.href='op_chat.php?speek=$speek&session=$sid';}
                }
        });

}
}

function sendtext(e)
{
    if (e.keyCode == 13)
    {
        send();
        return false;
    }
}
--></script></td><td align=left colspan=3><font color=$nc10 size=3>&nbsp;&nbsp;<b>$privat</b></font></td></tr><tr><td width=80% valign=top>
<div id=chatwindow style=\"padding:10px; width:auto; height:300px; overflow-y:auto; overflow-x:hidden; text-align:left;\">$chat</div></td>
<td valign=top width=20% colspan=3><div id=onlinewindow style=\"padding:10px; width:auto; height:300px; overflow:auto; text-align:left;\">$online</div></td></tr>

<tr><td valign=top><input type=text style=\"width:96%; height:38px; margin-top:10px; font-size: 15pt;\" id=mydata value=\"\" onkeyup=\"sendtext(event);\"></td><td><button type=button style=\"margin-top:0px;\" class=\"btn btn-primary btn-large\" onclick=send();><img src=$image_path/send_icon.png></button></td><td align=right valign=top>";

if (($details[7]=="ADMIN")||($details[7]=="MODER")) { echo "<button type=button onclick=clearchat(); class=\"btn btn-large\" style=\"margin-top:10px;\">".$lang['clear']."</button>";

}

echo "</td><td valign=top><button type=button onclick=exit(); class=\"btn btn-large\" style=\"margin-top:10px;\">".$lang['exit']."</button></td></tr>
</table>
</div>
</div></center>";
echo "</body></html>";
}
}
}
?>

