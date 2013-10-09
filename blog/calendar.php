<?php

//24Ok Calender Example:
//if ((!isset($year))||(!preg_match("/^[0-9]+$/",$year))){ $year=date("Y",time()); } if (($year>9999)||($year<1)) { $year=date("Y",time()); } //checking valid year
//if ((!isset($month))||(!preg_match("/^[0-9]+$/",$month))){ $month=date("m",time());} if ($month<1) { $month=12; $year-=1;} if ($month>12) { $month=1; $year+=1;}  //checking valid month
//$month=doubleval($month);
//$now=mktime(0,0,1,$month,1,$year);
//$nowd=date("m.Y",$now);
//$today=date("d.m.Y",time());

$oldday=10;

$nowt=time();
$nowc['day']=date("d", $nowt);
$nowc['month']=date("m", $nowt);
$nowc['year']=date("Y", $nowt);
$showt=mktime(0,0,1,$month,1,$year);
$show['day']=doubleval(date("d", $showt));
$show['month']=doubleval(date("m", $showt));
$show['year']=date("Y", $showt); $week=0;
$w=date("w",$showt);
$i=0-($w-1)*86400;

while ($i<6000000) {
$nextmonth=doubleval(date("m",$showt+$i)); $nextyear=date("Y",$showt+$i); $day=doubleval(date("d",$showt+$i));

if (($i>0)&&($nextmonth!=$show['month'])) {
$color=$nc5;
//echo "$i - $day ".$nextmonth." ".$show['month']."<br>";
$next=(7-(date("w",$showt+$i)-1));
if ($next==7) { break; }
$color=$nc6;

$styler="";
$style2=" bgcolor=$nc0";

$row[$week]=@$row[$week]. "<td align=center$style2><font color=$color>".$day."</font></td>";
} else {
//echo "$i - $day ".$nextmonth." ".$show['month']."<br>";
if ($i<0) {
$color=$nc6;
} else {
$color=$nc5;}
if ((date("w",$showt+$i)>5)||(date("w",$showt+$i)==0)) {$colors="$nc3";
} else {
$colors="$nc3";}
if (($day==$nowc['day'])&&($nextmonth==$nowc['month'])&&($nextyear==$nowc['year'])) {
$style2=" bgcolor=$nc3"; $styler="";
} else {
$styler="";
$style2=" bgcolor=$nc0";
}
if ($oldday!=date("d",$showt+$i)) {
if ($month<10){$cmonth="0".$month;} else { $cmonth="$month"; }
if ($day<10){$cday="0".$day;} else { $cday="$day"; }
if ((file_exists("$fold/$nextyear/$cmonth/$cday/list.txt")==TRUE) &&($i>=0)){ $daytopic="<a href=index.php?action=blog&message_date=".$nextyear."/".$cmonth."/".$cday."><b><font color=$nc5><u>".$day."</u></font></b></a>";} else {$daytopic=$day;}
if( "$nextyear/$cmonth/$cday"==$message_date) {$style2=" bgcolor=".lighter($nc3,40); }
$row[$week]=@$row[$week]."<td align=center$style2><font$styler color=\"$color\">".$daytopic."</font></td>";

}
if (date("w",$showt+$i)==0) { $week+=1;}
$oldday=date("d",$showt+$i);

}

$i+=86400;

}
$ret= "<table border=0 cellspacing=1 cellpadding=5><tr bgcolor=$nc6>
<td align=center><small>$lang[771]</small></td>
<td align=center><small>$lang[772]</small></td>
<td align=center><small>$lang[773]</small></td>
<td align=center><small>$lang[774]</small></td>
<td align=center><small>$lang[775]</small></td>
<td align=center><small><b>$lang[776]</b></small></td>
<td align=center><small><b>$lang[777]</b></small></td></tr>";
reset ($row); while (list ($key, $st) = each ($row)) {$ret.=  "<tr>".$st."</tr>";} $ret.=  "</table>";
//example:
$nextus;
$prevmonth=($month-1);
$nextmonth=($month+1);
$prevyear=$year;
$nextyear=$year;
if ($prevmonth<=0) {$prevmonth=12; $prevyear-=1;}
if ($nextmonth>12) {$nextmonth=1; $nextyear+=1;}
$nextus="<b><font color=".lighter($nc6,-20)." size=3>&gt;&gt;</font></b>";
if (mktime(0,0,1,$nextmonth,1,$nextyear)<=mktime(0,0,1,$nowc['month'],1,$nowc['year'])) {
$nextus="<b><a href=index.php?action=blog&month=".$nextmonth."&year=".$nextyear."><font color=$nc3 size=3>&gt;&gt;</font></a></b>";
}
$calendar="<table border=0 class=round2 cellpading=0 cellspacing=0>
<tr>
<td><b><a href=index.php?action=blog&month=".$prevmonth."&year=".$prevyear."><font color=$nc3 size=3>&lt;&lt;</font></b></td>
<td align=center><b>".str_replace("1","".$lang[537]." ", str_replace("2","".$lang[538]." ",str_replace("3","".$lang[539]." ",str_replace("4","".$lang[540]." ",str_replace("5","".$lang[541]." ",str_replace("6","".$lang[542]." ",str_replace("7","".$lang[543]." ",str_replace("8","".$lang[544]." ",str_replace("9","".$lang[545]." ",str_replace("10","".$lang[546]." ",str_replace("11","".$lang[547]." ",str_replace("12","".$lang[548]." ",$month))))))))))))." $year</b></td>
<td align=right>$nextus</td>
</tr>
<tr><td colspan=3>";
$calendar.=$ret;
$calendar.="</td></tr>
<tr>
<td colspan=3 align=center bgcolor=$nc0><small><b>$lang[114]:</b> <a href=index.php?action=blog&month=".doubleval(date("m",time()))."&year=".date("Y",time())."><font color=$nc3>$today</font></a></small></td>
</tr>
</table>";
?>

