<?php
$wttabs0="";
$wttabs1="";
$wttabs2="";
$wttabs3="";
$wttabs="";

if(isset($_GET['usernickname'])) $usernickname=$_GET['usernickname']; elseif(isset($_POST['usernickname'])) $usernickname=$_POST['usernickname']; else $usernickname="";
if (!preg_match("/^[a-zA-Z0-9_\/\&\%\ -]+$/i",$usernickname)) { $usernickname="";}
if ($usernickname!="") {$user_realnnick=$usernickname; } else { $user_realnnick=$details[1]; }
if (($usernickname=="")||($usernickname==$details[1])) {
$todaystart=0;
$todayend=time();
$todaylast1=time();
$todaylast2="OUT";
} else {
$todaystart=0;
$todayend=0;
$todaylast1=0;
$todaylast2="";
}
$user_realname="";
if ($portal==1) {  if ("$valid"=="1") {

//Write OUT message
$intime=time();
$t_year=date("Y",$intime);
$t_month=date("m",$intime);
$t_day=date("d",$intime);
if (is_dir("./admin/stat_inout")==FALSE) { mkdir("./admin/stat_inout",0755); }
if (is_dir("./admin/stat_inout/users")==FALSE) { mkdir("./admin/stat_inout/users",0755); }
if (is_dir("./admin/stat_inout/users/".$user_realnnick)==FALSE) { mkdir("./admin/stat_inout/users/".$user_realnnick,0755); }
$inoutcat="./admin/stat_inout/$t_year";
$yearcat="./admin/stat_inout/$t_year";
$monthcat="./admin/stat_inout/$t_year/$t_month";
$daycat="./admin/stat_inout/$t_year/$t_month/$t_day";
if (is_dir($yearcat)==FALSE) { mkdir($yearcat,0755); }
if (is_dir($monthcat)==FALSE) { mkdir($monthcat,0755); }
if (is_dir($daycat)==FALSE) { mkdir($daycat,0755); }

$swt="./admin/stat_inout/users/".$user_realnnick."/".$t_year.".txt";
if (!file_exists($swt)) { 
$fpw=fopen($swt, "w");
fclose($fpw);
}
$stat_worktime=file($swt);

while (list($key,$val)=each ($stat_worktime)) {
$tmp=explode("|", $val);
if ($user_realname=="") {$user_realname=trim($tmp[3]); }
$wttabs.="<tr><td>".date("d-m-Y H:i", $tmp[0]) ."</td><td>". $tmp[1] . "</td><td>". $tmp[2]."</td></tr>\n";
if (date("d-m-Y", $tmp[0])==date("d-m-Y", time())) {
if ( $tmp[1]=="IN") {if ($todaystart==0) { $todaystart=$tmp[0]; }}
if ( $tmp[1]=="OUT") {$todayend=$tmp[0];}
$todaylast1=$tmp[0];
$todaylast2=$tmp[1];
$wttabs0.="<tr><td>".date("d-m-Y H:i", $tmp[0]) ."</td><td>". $tmp[1] . "</td><td>". $tmp[2]."</td></tr>\n"; }
}
$wttabs="<h4>$lang[13]</h4><h4>$lang[1079]: $user_realname</h4>
<div align=right><a href=\"$htpath/admin/stat_inout/users/$user_realnnick/".$t_year.".txt\" target=\"_blank\"><i class=icon-print></i> $lang[106]</a></div>
<table border=0 cellpadding=5 class=round2 style=\"width:100%\"><tr><td><b>".$lang[371]."</b></td><td><b>IN/OUT</b></td><td><b>IP</b></td></tr>".$wttabs."</table>";


$wttabs0="<h4>$lang[114] ".$t_day."-". $t_month ."-".$t_year."</h4>
<table border=0 cellpadding=5 class=round2 style=\"width:100%\"><tr><td><b>".$lang[371]."</b></td><td><b>IN/OUT</b></td><td><b>IP</b></td></tr>".$wttabs0."</table>
";
if ( $todaystart!=0) {
$wttabs0.="<div><small>START: ".date("d-m-Y H:i:s", $todaystart)." | END: ".date("d-m-Y H:i:s", $todayend)." | LAST EVENT TIME: ".date("d-m-Y H:i:s", $todaylast1)." | LAST EVENT : ".$todaylast2."</small></div>";
$wttabs0.="<div align=right><b>$lang[817]:</b> ". round((($todayend-$todaystart)/60/60),2)." </div>";
}
unset($stat_worktime);
$stat_worktime=file("./admin/stat_inout/".$t_year."/".$t_month."/".$t_day."/stat.txt");
$wttabs2="";
while (list($key,$val)=each ($stat_worktime)) {
$tmp=explode("|", $val);
$wttabs2.="<tr><td>".date("d-m-Y H:i", $tmp[0]) ."</td><td>". $tmp[1] . "</td><td>". $tmp[2]."</td><td><a href=\"index.php?action=stat_worktime&usernickname=".$tmp[3]."\">". $tmp[4]."</a> <small><img src=$image_path/phone.png align=absmiddle hspace=5>(". $tmp[6].") ". $tmp[7]." <br><b>". $tmp[8]."</b> - ". $tmp[10]." - <i>". $tmp[9]."</i></small></td></tr>\n";
}
$wttabs2="<h4>$lang[114] ".$t_day."-". $t_month ."-".$t_year."</h4>
<div align=right><a href=\"$htpath/admin/stat_inout/$t_year/$t_month/$t_day/stat.txt\" target=\"_blank\"><i class=icon-print></i> $lang[106]</a></div>
<table border=0 cellpadding=5 class=round2 style=\"width:100%\"><tr><td><b>".$lang[371]."</b></td><td><b>IN/OUT</b></td><td><b>IP</b></td><td><b>".$lang[75]."</b></td></tr>".$wttabs2."</table>";

unset($stat_worktime);
$stat_worktime=file("./admin/stat_inout/".$t_year."/".$t_month."/stat.txt");
$wttabs3="";
while (list($key,$val)=each ($stat_worktime)) {
$tmp=explode("|", $val);
$wttabs3.="<tr><td>".date("d-m-Y H:i", $tmp[0]) ."</td><td>". $tmp[1] . "</td><td>". $tmp[2]."</td><td><a href=\"index.php?action=stat_worktime&usernickname=".$tmp[3]."\">". $tmp[4]."</a> <small><img src=$image_path/phone.png align=absmiddle hspace=5>(". $tmp[6].") ". $tmp[7]." <br><b>". $tmp[8]."</b> - ". $tmp[10]." - <i>". $tmp[9]."</i></small></td></tr>\n";
}
$wttabs3="<h4>$lang[551] ". $t_month ."-".$t_year."</h4>
<div align=right><a href=\"$htpath/admin/stat_inout/$t_year/$t_month/stat.txt\" target=\"_blank\"><i class=icon-print></i> $lang[106]</a></div>
<table border=0 cellpadding=5 class=round2 style=\"width:100%\"><tr><td><b>".$lang[371]."</b></td><td><b>IN/OUT</b></td><td><b>IP</b></td><td><b>".$lang[75]."</b></td></tr>".$wttabs3."</table>";


unset($stat_worktime);
$stat_worktime=file("./admin/stat_inout/".$t_year."/stat.txt");
$wttabs4="";
while (list($key,$val)=each ($stat_worktime)) {
$tmp=explode("|", $val);
$wttabs4.="<tr><td>".date("d-m-Y H:i", $tmp[0]) ."</td><td>". $tmp[1] . "</td><td>". $tmp[2]."</td><td><a href=\"index.php?action=stat_worktime&usernickname=".$tmp[3]."\">". $tmp[4]."</a> <small><img src=$image_path/phone.png align=absmiddle hspace=5>(". $tmp[6].") ". $tmp[7]." <br><b>". $tmp[8]."</b> - ". $tmp[10]." - <i>". $tmp[9]."</i></small></td></tr>\n";
}
$wttabs4="<h4>".$t_year."</h4>
<div align=right><a href=\"$htpath/admin/stat_inout/$t_year/stat.txt\" target=\"_blank\"><i class=icon-print></i> $lang[106]</a></div>
<table border=0 cellpadding=5 class=round2 style=\"width:100%\"><tr><td><b>".$lang[371]."</b></td><td><b>IN/OUT</b></td><td><b>IP</b></td><td><b>".$lang[75]."</b></td></tr>".$wttabs4."</table>";
$wttabs.=$wttabs0."<br><br><hr noshade size=1><h4>$lang[1106]</h4>".$wttabs2. $wttabs3.$wttabs4;
$wttabs=str_replace("<td>IN</td>","<td><img src=\"$image_path/enter.png\" border=0 title=\"IN\"></td>",str_replace("<td>OUT</td>","<td>&nbsp;<img src=\"$image_path/exit.png\" border=0 title=\"OUT\"></td>", $wttabs));
}}
?>
