<?php
$sended=0;
$user_realname="";
$userinfo="";
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
}

$usrfile="./admin/userstat/".$usernik.".txt";
if (file_exists($usrfile)) {
$user_file=file($usrfile);
$nic=$usernik;
$ava_image="";
if (file_exists("./admin/userstat/".$nic."/".$nic.".ava")) {
$ava_image=implode("", file("./admin/userstat/".$nic."/".$nic.".ava"));
}
if ($ava_image!="") {$ava_image="<img src=\"gallery/avatars/$ava_image\" border=0 title=\"$nic\" align=left style=\"margin:3px;\">";}
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
if ($dd<10) {$dd="0".$dd;}
if ($mm<10) {$mm="0".$mm;}
if ($yy<100) { $yy=$yy+1900;}
$br="<b>".$user_mass[0].":</b> ". $dd.".".$mm.".".$yy;
} else {
$value=str_replace("\n","", trim (@$tmp[(20+$user_num)]));
if ($value!="") {
$customs.="<b>".$user_mass[0].":</b> ".$value."<br>";
}
}
}
}
$userinfo="<table width=100% border=0><tr><td valign=top>$ava_image</td><td valign=top>"."<b>$lang[76]:</b> $nic <br><b>$lang[397]:</b> ". $tmp[7]."<br>";
if($portal==1) { $userinfo.="<br><b>$lang[75]:</b> <a href=\"index.php?action=stat_worktime&usernickname=".$tmp[1] ."\">".$tmp[3]."</a>"; }
$userinfo.="<br><i>". $tmp[17]."</i><br><br>
<b>$lang[337]:</b> ". strtoken($tmp[6]," ");

if ($valid=="1") {
$userinfo.="<br><br><a href=\"#Send Private Message\" onClick=\"javascript:window.open('chat.php?ch=main&privat=".rawurlencode($usernik)."&amp;speek=$speek','".md5($usernik."chat")."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10')\"><img src=\"$image_path/sm.png\" title=\"$lang[1075]\" border=0 align=absmiddle></a> &nbsp; <a href=\"$htpath/index.php?query=forum&f_user=".rawurlencode($usernik)."&onlyforum=1\"><img src=\"$image_path/sf.png\" border=0 title=\"$lang[1089]\" align=absmiddle></a>";
}

$userinfo.="</td><td valign=top>";
if($portal==1) {$userinfo.="<img src=\"$image_path/phone.png\" border=0 hspace=5 align=absmiddle>";
if (($tmp[19]!="")&&($tmp[19]!="-")) { $userinfo.="<small>(". $tmp[19].")</small> ";}
$userinfo.=$tmp[5]."<br><br><i>". $tmp[8]."</i><br>";
}
$userinfo.="<small>". strtoken($tmp[18]," (")."</small>";
if($portal==1) { $userinfo.="<br><br><b>E-mail:</b> <a href=\"mailto:$tmp[4]\">$tmp[4]</a>";

$userinfo.="</td><td valign=top>$br<br>$customs</td>";}
$userinfo.="</tr></table>";


}
} else {
$error="<font color=#b94a48>User Not exists!</font>";
}




?>
