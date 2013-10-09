<?php
$wdirs=Array();
$wfiles=Array();
$wttabs="";
if(isset($_GET['sub'])) $sub=$_GET['sub']; elseif(isset($_POST['sub'])) $sub=$_POST['sub']; else $sub="";
if (!preg_match("/^[a-zA-Z0-9_\/\&\%\ -]+$/i",$sub)) { $sub="";}
$sub=stripslashes(strip_tags(trim($sub)));

if(isset($_GET['order'])) $order=$_GET['order']; elseif(isset($_POST['order'])) $order=$_POST['order']; else $order="";
if (!preg_match("/^[a-zA-Z0-9_\/\&\%\ -]+$/i",$order)) { $order="";}
$order=stripslashes(strip_tags(trim($order)));


if(isset($_GET['usernickname'])) $usernickname=$_GET['usernickname']; elseif(isset($_POST['usernickname'])) $usernickname=$_POST['usernickname']; else $usernickname="";
if (!preg_match("/^[a-zA-Z0-9_\/\&\%\ -]+$/i",$usernickname)) { $usernickname="";}
if ($usernickname!="") {$user_realnnick=$usernickname; } else { $user_realnnick=$details[1]; }

if ($portal==1) {  if ("$valid"=="1") {

//Write OUT message
$intime=time();
$t_year=date("Y",$intime);
$t_month=date("m",$intime);
$t_day=date("d",$intime);
if (is_dir("./zakazi")==FALSE) { mkdir("./zakazi",0755); }
if (is_dir("./zakazi/users")==FALSE) { mkdir("./zakazi/users",0755); }
if (is_dir("./zakazi/users/".$user_realnnick)==FALSE) { mkdir("./zakazi/users/".$user_realnnick,0755); }
if ($sub=="") {$ddir="./zakazi/users/".$user_realnnick; } else {$ddir="./zakazi/users/".$user_realnnick."/".$sub; }

$handle=opendir($ddir);
while (($f6 = readdir($handle))!==FALSE) {

if (($f6 == '.') || ($f6 == '..')) {
continue;
} else {
if (is_dir($ddir."/$f6")) {
$wdirs[]="<!-- $f6 --><a href=\"$htpath/index.php?action=stat_orders&sub=$sub/$f6\"><img src=\"$image_path/mini_folder.png\" hspace=5 align=absmiddle>$f6</a><br>\n";
} else {
$wfiles[]="<!-- $f6 --><a href=\"$htpath/index.php?action=stat_orders&sub=$sub&order=".str_replace(".txt","",$f6)."\"><img src=\"$image_path/mini_exe.png\" hspace=5 align=absmiddle>$lang[244] #".str_replace(".txt","",$f6)."</a><br>\n";
}
}
}
closedir ($handle);
natcasesort($wdirs);
natcasesort($wfiles);
reset($wdirs);
reset($wfiles);
$backlink="";
if ($sub!="") {

$tmp=explode("/",$sub);
array_pop($tmp);
$backsub=implode("/",$tmp);
unset($tmp);
$backlink="<a href=\"$htpath/index.php?action=stat_orders&sub=$backsub\"><img src=\"$image_path/ofb.png\" align=absmiddle hspace=5>".$lang['back_to_higher_level']."</a><br><br>";
}
$wttabs.="<h4>".$lang['adm4']."</h4>$backlink";
while(list($key,$val)=each($wdirs)) {
$wttabs.="$val";

}
$wttabs.="<br>";
while(list($key,$val)=each($wfiles)) {
$wttabs.="$val";

}
if ($order!="") {
if (file_exists("$ddir/$order".".txt")) {
$wttabs.="<br><h4>".$lang['adm4']."</h4>";
$tmp=file("$ddir/$order".".txt");
$wttabs.="#$tmp[2]<br>\n";
$wttabs.="$lang[371]: $tmp[0] $tmp[1]<br>\n";
$wttabs.="$lang[700]: $tmp[3]<br>\n";
$wttabs.="$lang[701]: $tmp[4] $tmp[5]<br>\n";
$wttabs.="$lang[61]: $tmp[6]<br>\n";
$wttabs.="$lang[165]: $tmp[10]<br>\n";
$wttabs.="$lang[156] $tmp[16]<hr>\n";
$zz=1;
while (list ($kk, $vv)=each($tmp)) {
$zz+=1;

if ($zz>16) {
$wttabs.="$vv<br>\n";
}

}

} else {
$wttabs.="Not exists!";
}

}

}}
?>