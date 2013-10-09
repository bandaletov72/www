<?php
if ($portal==1) {
if (isset($_SESSION["user_login"])) {
if ($_SESSION["user_login"]!="") {
if (file_exists("./admin/userstat/".$_SESSION["user_login"].".txt")) {
$fp=fopen("./admin/userstat/".$_SESSION["user_login"].".txt","r");
$_usdetc=str_replace("\n","", trim(fread($fp,filesize("./admin/userstat/".$_SESSION["user_login"].".txt"))));
$_um=explode("|", $_usdetc);
$_usdet=$_um[1]."|".$_um[3]."|".$_um[4]."|".$_um[19]."|".$_um[5]."|".$_um[8]."|".$_um[17]."|".strtoken($_um[1]," (")."|".$_um[20]."|||";
//Write OUT message
$intime=time();
$t_year=date("Y",$intime);
$t_month=date("m",$intime);
$t_day=date("d",$intime);
if (is_dir("./admin/stat_inout")==FALSE) { mkdir("./admin/stat_inout",0755); }
if (is_dir("./admin/stat_inout/users")==FALSE) { mkdir("./admin/stat_inout/users",0755); }
if (is_dir("./admin/stat_inout/users/".$_SESSION["user_login"])==FALSE) { mkdir("./admin/stat_inout/users/".$_SESSION["user_login"],0755); }
$inoutcat="./admin/stat_inout/$t_year";
$yearcat="./admin/stat_inout/$t_year";
$monthcat="./admin/stat_inout/$t_year/$t_month";
$daycat="./admin/stat_inout/$t_year/$t_month/$t_day";
if (is_dir($yearcat)==FALSE) { mkdir($yearcat,0755); }
if (is_dir($monthcat)==FALSE) { mkdir($monthcat,0755); }
if (is_dir($daycat)==FALSE) { mkdir($daycat,0755); }
$user_data=$intime."|OUT|".$user_ip."|".$_usdet."|\n";
$user_ip=@$_SESSION["user_ip"];
$fp=fopen($yearcat."/stat.txt", "a");
fputs ($fp, $user_data);
fclose ($fp);
if (filesize($yearcat."/stat.txt")>(1024*1024)) { rename($yearcat."/stat.txt", $yearcat."/".$intime."_stat.txt"); }
$fp=fopen($monthcat."/stat.txt", "a");
fputs ($fp, $user_data);
fclose ($fp);
if (filesize($monthcat."/stat.txt")>(1024*1024)) { rename($monthcat."/stat.txt", $monthcat."/".$intime."_stat.txt"); }
$fp=fopen($daycat."/stat.txt", "a");
fputs ($fp, $user_data);
fclose ($fp);
if (filesize($daycat."/stat.txt")>(1024*1024)) { rename($daycat."/stat.txt", $daycat."/".$intime."_stat.txt"); }

$fp=fopen("./admin/stat_inout/users/".$_SESSION["user_login"]."/$t_year".".txt", "a");
fputs ($fp, $intime."|OUT|".$user_ip."|\n");
fclose ($fp);
$fp=fopen("./admin/stat_inout/users/".$_SESSION["user_login"]."/".$t_year."_".$t_month.".txt", "a");
fputs ($fp, $intime."|OUT|".$user_ip."|\n");
fclose ($fp);
$fp=fopen("./admin/stat_inout/users/".$_SESSION["user_login"]."/".$t_year."_".$t_month."_".$t_day.".txt", "a");
fputs ($fp, $intime."|OUT|".$user_ip."|\n");
fclose ($fp);
}}}}
$fp=fopen("./admin/userstat/".$_SESSION["user_login"]."/lastvisit.time", "w");
fputs ($fp, (time()-($min_update*60)-10));
fclose ($fp);

$ssef=0;
$sse=Array();
$sse=file("./admin/online.txt");

while (list($ssek,$ssev)=each($sse)) {
$ssetmp=Array();
$ssetmp=explode("|",$ssev);
$indx=$ssetmp[1];
if ($indx==$_SESSION["user_login"]) {
$sse[$ssek]="";
}
}
$fp=fopen("./admin/online.txt","w");
fputs($fp,implode("",$sse));
fclose ($fp);

?>