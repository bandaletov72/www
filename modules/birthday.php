<?php
$birthday="";
if ((@file_exists("./admin/birthday.txt")==FALSE)||(date("d.m.Y", filemtime("./admin/birthday.txt"))!=date("d.m.Y", time())))  {
$today_b=Array();
$future_b=Array();
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
$birth_enable=0;
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_mass[6]=="birth") { $birth_enable=0; $users_num=$user_num;}
}
}
if ($birth_enable=1) {

$handle=opendir('./admin/userstat/');
$zzz=0;
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
$customs="";
$birth="";
$ddb=-1;
$birth=@preg_replace("([\D]+)", "", preg_replace('/\(([0-9]{1,6})\)/', '$1',  str_replace("-","", str_replace(".","",str_replace("\n","", trim (@$tmp[(20+$users_num)]))))));
$dd=doubleval(substr($birth,0,2));
$mm=doubleval(substr($birth,2,2));
$yy=doubleval(substr($birth,4,4));
if ($yy<100) { $yy=$yy+1900;}
$next_birth=mktime(0,0,0,$mm,$dd, date("y",time()));
$nextbyear=date("Y",time());
$nowtime=time();
$ddb=ceil((((($next_birth-$nowtime)/60)/60)/24)); //days before birthday
if ($ddb<0) {
$next_birth=mktime(0,0,0,$mm,$dd, (1+date("Y",time())));  //next year
$nextbyear=(1+date("Y",time()));
$ddb=ceil((((($next_birth-$nowtime)/60)/60)/24)); //days before birthday
}

$stlb="";
if ($dd<10) {$dd="0".$dd;}
if ($mm<10) {$mm="0".$mm;}

$br=$dd.".".$mm;



}
if (($ddb<=7)&&($ddb>0)) {
$future_b[$zzz]=$tmp[1]."|".$tmp[3]."|".$ddb."||||\n";
}
if ($ddb==0) {
$future_b[$zzz]=$tmp[1]."|".$tmp[3]."|".$ddb."||||\n";
}
$zzz++;
}
}
}
closedir($handle);
natcasesort($future_b);
$fp=fopen("./admin/birthday.txt", "w");
fputs ($fp, implode("",$future_b));
fclose ($fp);
unset($user_file);

} else {
$fp=fopen("./admin/birthday.txt", "w");
fputs ($fp, "");
fclose ($fp);
}
}
}

?>
