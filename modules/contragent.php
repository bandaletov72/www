<?php
$user_realname="";
$kontrag_list="";
$user_realnnick="";

if(isset($_GET['usernickname'])) $usernickname=$_GET['usernickname']; elseif(isset($_POST['usernickname'])) $usernickname=$_POST['usernickname']; else $usernickname="";
if (!preg_match("/^[a-zA-Z0-9_\/\&\%\ -]+$/i",$usernickname)) { $usernickname="";}
if ($usernickname!="") {$user_realnnick=$usernickname; }
if ($usernickname=="") {


if ($portal==1) {  if ("$valid"=="1") {


$contrfile="../../dpz.ru/docs/kontr_ag.txt";
if (file_exists($contrfile)) {
$kontrag_file=file($contrfile);

while (list($key,$val)=each ($kontrag_file)) {
$tmp=explode("|", $val);
if ($user_realname=="") {$user_realname=trim($tmp[3]); }
$kontrag_list.="<tr><td>".$tmp[0] ."</td><td>". $tmp[1] . "</td><td>". $tmp[2]."</td><td>". $tmp[3]."</td><td>";
if (preg_match("/\@/i",$tmp[4])) {
$kontrag_list.="<a href=\"mailto:".$tmp[4]."\">".$tmp[4]."</a>";
} else {
$kontrag_list.=$tmp[4];

}
$kontrag_list.="</td></tr>\n";
}
$kontrag_list="<h4>$lang[1473]</h4>
<table border=0 cellpadding=5 class=round2 style=\"width:100%\"><tr><td><b>#</b></td><td><b>$lang[75]</b></td><td><b>$lang[73]</b></td><td><b>$lang[497]</b></td><td><b>$lang[645]</b></td></tr>".$kontrag_list."</table>";


unset($kontrag_file);
}  else {
$kontrag_list="Not found";
}
}
}
}


?>