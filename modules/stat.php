<?php
if ($portal==1) {  if ("$valid"=="1") {
$viewsite=0;
if (file_exists("./themes/pi.thtml")) {
if ($theme_file=="") {
if ($au==1) {
//Login pass authorization
//Write IN message
$intime=time();
$t_year=date("Y",$intime);
$t_month=date("m",$intime);
$t_day=date("d",$intime);
if (is_dir("./admin/stat_inout")==FALSE) { mkdir("./admin/stat_inout",0755); }
if (is_dir("./admin/stat_inout/users")==FALSE) { mkdir("./admin/stat_inout/users",0755); }
if (is_dir("./admin/stat_inout/users/".$details[1])==FALSE) { mkdir("./admin/stat_inout/users/".$details[1],0755); }
$inoutcat="./admin/stat_inout/$t_year";
$yearcat="./admin/stat_inout/$t_year";
$monthcat="./admin/stat_inout/$t_year/$t_month";
$daycat="./admin/stat_inout/$t_year/$t_month/$t_day";
if (is_dir($yearcat)==FALSE) { mkdir($yearcat,0755); }
if (is_dir($monthcat)==FALSE) { mkdir($monthcat,0755); }
if (is_dir($daycat)==FALSE) { mkdir($daycat,0755); }

$user_data=$intime."|IN|".$user_ip."|".$details[1]."|".$details[3]."|".$details[4]."|".$details[19]."|".$details[5]."|".$details[8]."|".$details[17]."|".strtoken($details[18]," (")."|".$details[20]."|||\n";

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
$fp=fopen("./admin/stat_inout/users/".$details[1]."/$t_year".".txt", "a");
fputs ($fp, $intime."|IN|".$user_ip."|".$details[3]."|\n");
fclose ($fp);
$fp=fopen("./admin/stat_inout/users/".$details[1]."/".$t_year."_".$t_month.".txt", "a");
fputs ($fp, $intime."|IN|".$user_ip."|".$details[3]."|\n");
fclose ($fp);
$fp=fopen("./admin/stat_inout/users/".$details[1]."/".$t_year."_".$t_month."_".$t_day.".txt", "a");
fputs ($fp, $intime."|IN|".$user_ip."|".$details[3]."|\n");
fclose ($fp);
} else {
//Coockie autorization
//do something

}
if ($register!=1) {
echo "<table width=100% height=100%><tr><td align=center valign=middle><a href=index.php><font face=Verdana><image src=$image_path/loading.gif border=0 title=Loading></font></a></td></tr></table><META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=$htpath/index.php\">";
exit;
 } else {

 }
}}}}
?>