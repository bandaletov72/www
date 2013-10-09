<?php
$wtime="";
$days_before_holidays=7; //number of days
$wt_name="$lang[817]:";
//Usage example:   'sun'=>"Sun,0,Closed", 'mon'=>"Mon,1,8:00-16:00" P/S Dont use ","
$wt= array (
'mon'      =>  "$lang[771],1,10:00,18:00", #Monday
'tue'      =>  "$lang[772],1,10:00,18:00", #Tuesday
'wed'      =>  "$lang[773],1,10:00,18:00", #Wednesday
'thu'      =>  "$lang[774],1,10:00,18:00", #Thursday
'fri'      =>  "$lang[775],1,10:00,17:00", #Friday
'sat'      =>  "$lang[776]".",0,$lang[818],,", #Saturday
'sun'      =>  "$lang[777],0,$lang[818],,", #Sunday
'warning'  =>  $lang[819],
'other'    =>  $lang[820],
1          =>  $lang[821],
0          =>  $lang[822],
'closed'   => $lang[823],
'starts'   => $lang[824],
'from'     => $lang[99],
'to'       => $lang[100],

);
$tod=$lang[114];
$addtod="";
$addtod2="";
$ww="";
$cuD=strtolower(date("D", time()));
$cuM=strtolower(date("n", time()));
$tmpwt=explode(",", $wt[$cuD]);
$todd=$lang[date("D", time())].", ". date("j", time())." ". $lang[(doubleval($cuM)+114)] ." ".date("Y", time());
if (file_exists("./templates/$template/$speek/holidays.inc")==true) {

unset ($tmp,$hld,$idx,$hh,$hv);
$tmp=file("./templates/$template/$speek/holidays.inc");
while (list($hk,$hv)=each($tmp)) {
$hh=explode("=", trim($hv));
$idx=$hh[0];
$hld[$idx]=$hh;
}
unset ($hk,$hv);
reset ($hld);
for ($i=0; $i<$days_before_holidays; $i++) {
$tim=(time()+86400*$i);
$idx=date("d.m",$tim);
$todd2=$lang[date("D", $tim)].", ". date("j", $tim)." ". $lang[(doubleval($cuM)+114)] ." ".date("Y", $tim);
if (isset($hld[$idx])) {
//holiday is now
$dw=date("w", time());
if ($dw==0) $dw=7;
$dw=770+$dw;
$day_of_week=$lang[$dw];
if ( $hld[$idx][4]==1 ) {
//working day
$ww="<br><span class=\"label label-warning\">$todd2</span><br>". $hld[$idx][3]." - " . $hld[$idx][1] . "<br><span style=\"color: $nc2\">".$hld[$idx][2]."</span><br>";
if ($i==0) {
$tmpwt=Array( $day_of_week,1,$hld[$idx][5],$hld[$idx][6]);
$addtod="<span class=\"label label-warning\">$todd2</span> ". $hld[$idx][3]." - " . $hld[$idx][1]."<br><span style=\"color: $nc2\">".$hld[$idx][2]."</span>";
}
} else {
//not working day

$ww.="<br><span class=\"label label-important\">$todd2</span><br>". $hld[$idx][3]." - " . $hld[$idx][1] . "<br><span class=text-error>".$hld[$idx][2]."</span><br>";
if ($i==0) {
$tmpwt=Array($day_of_week,0,$hld[$idx][2],"");
$addtod="<span class=\"label label-important\">$todd2</span> ".$hld[$idx][3]." - " . $hld[$idx][1]."<br><span class=text-error>".$hld[$idx][2]."</span>";
}
}
}
}
}
$indxt=$tmpwt[1];

$cuT=time();
if ($addtod=="") {
if ($tmpwt[1]==0) {
$wtime=  $tod." (". $todd.") " . $wt[$indxt].".";
} else {
$starttime=strtotime(date("d M Y"). " ". $tmpwt[2]);
$endtime=strtotime(date("d M Y"). " ". $tmpwt[3]);
if (($tmpwt[1]==1)&&($cuT>$starttime)&&($cuT<$endtime)) {
$wtime=  $tod." (". $todd.") " . $wt[$indxt] ." ". $tmpwt[2] ." ". $wt['to']. " ". $tmpwt[3]." $timezone.";
}

if (($tmpwt[1]==1)&&($cuT>$endtime)) {
$wtime=  $tod." (". $todd.") " . $wt['closed'] ." ". $tmpwt[3]." $timezone.";
}
if (($tmpwt[1]==1)&&($cuT<$starttime)) {
$wtime=  $tod." (". $todd.") " . $wt['starts'] ." ". $tmpwt[2]." $timezone.";
}
}
} else {
$wtime = $addtod;
}
$aww="";
if ("$valid"=="1"){
if (($details[7]=="ADMIN")||($details[7]=="MODER")){
$aww="<br><div><a class=btn href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=holidays><i class=icon-calendar></i> ".$lang['edits']."</a></div>";
}
}
if ($ww!="") {
$ww="<div><b>$lang[1559]:</b><hr>$ww</div>";
if ($usetheme==1) {
topwo("", "$ww$aww", "100%", $nc2, $nc0, "noshadow",1,"[holidays]");

} else {
$wtime.="$ww";
}
}
?>
