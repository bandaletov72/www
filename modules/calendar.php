<?php
//EuroWebcart calender class by EuroWebcart
//usage: calender24ok(month, year); //mounth must be numbers from 1 to 12, year must be in full format, ex. calender24ok{8, 2000}
//function return calender of current month

function calender24ok($month, $year) {

//settings
$color0="#000000"; //active days font
$color1="#cccccc"; //not active days font
$color2="#e1e1e1"; //weekend days bgr
$color3="#e8e8e8"; //main day bgr
$color4="#ffffff"; //color of table border


$oldday=10; $nowt=time(); $now['day']=date("d", $nowt); $now['month']=date("m", $nowt); $now['year']=date("Y", $nowt);
if ((!isset($month))||(!preg_match("/^[0-9]+$/",$month))){ $month=$now['month']; } if (($month>12)||($month<1)) { $month=$now['month']; } //checking valid month
if ((!isset($year))||(!preg_match("/^[0-9]+$/",$year))){ $year=$now['year']; } if (($year>9999)||($year<1)) { $year=$now['year']; } //checking valid year
$showt=mktime(0,0,1,$month,1,$year); $show['day']=doubleval(date("d", $showt)); $show['month']=doubleval(date("m", $showt)); $show['year']=date("Y", $showt); $week=0; $w=date("w",$showt); $i=0-($w-1)*86400;
while ($i<6000000) {
$m=doubleval(date("m",$showt+$i)); $y=date("Y",$showt+$i); $d=doubleval(date("d",$showt+$i));
if (($i>0)&&($m!=$show['month'])) {
$next=(7-(date("w",$showt+$i)-1));
if ($next==7) { break; }
if ((date("w",$showt+$i)>5)||(date("w",$showt+$i)==0)) {$colors="$color2";
} else {
$colors="$color3";}
if (($d==$now['day'])&&($m==$now['month'])&&($y==$now['year'])) {
$style2=" style=\"background-color:$colors; border: 3px double #FF0000;\""; $style=" style=\"font-weight:400\"";
} else {
$style="";
$style2=" style=\"background-color:$colors\"";
}
$row[$week]=@$row[$week]. "<td align=center$style2><font color=\"$color1\">".$d."</font></td>";
} else {
if ($i<0) {
$color=$color1;
} else {
$color=$color0;}
if ((date("w",$showt+$i)>5)||(date("w",$showt+$i)==0)) {$colors="$color2";
} else {
$colors="$color3";}
if (($d==$now['day'])&&($m==$now['month'])&&($y==$now['year'])) {
$style2=" style=\"background-color:$colors; border: 3px double #FF0000;\" title=\"Сегодня\""; $style=" style=\"font-weight:400\"";
} else {
$style="";
$style2=" style=\"background-color:$colors\"";
}
if ($oldday!=date("d",$showt+$i)) { $row[$week]=@$row[$week]."<td align=center$style2><font$style color=\"$color\">".$d."</font></td>";}
if (date("w",$showt+$i)==0) { $week+=1;}
$oldday=date("d",$showt+$i);

}

$i+=86400;

}
$ret= "<table style=\"border-collapse: collapse; border: 0 solid $color4; padding: 0px\" border=1 cellspacing=\"2\" cellpadding=\"3\" bordercolordark=\"$color4\" bordercolorlight=\"$color4\">";
reset ($row); while (list ($key, $st) = each ($row)) {$ret.=  "<tr>".$st."</tr>";} $ret.=  "</table>"; return $ret;
}




//24Ok Calender Example:
if ((!isset($y))||(!preg_match("/^[0-9]+$/",$y))){ $y=date("Y",time()); } if (($y>9999)||($y<1)) { $y=date("Y",time()); } //checking valid year
if ((!isset($m))||(!preg_match("/^[0-9]+$/",$m))){ $m=date("m",time());} if ($m<1) { $m=12; $y-=1;} if ($m>12) { $m=1; $y+=1;}  //checking valid month

$now=mktime(0,0,1,$m,1,$y);
$nowd=date("m.Y",$now);
$today=date("d.m.Y",time());
//example:
echo "<table border=0><tr><td><b><a href=\"".$_SERVER['PHP_SELF']."?m=".($m-1)."&y=".$y."\" style=\"text-decoration: none\" title=\"Предыдущий месяц\">&lt;&lt;</b></td><td align=center>$nowd</td><td align=right><b><a href=\"".$_SERVER['PHP_SELF']."?m=".($m+1)."&y=".$y."\" style=\"text-decoration: none\" title=\"Следующий месяц\">&gt;&gt;</a></b></td></tr><tr><td colspan=3>";
echo calender24ok($m,$y);
echo "</td></tr><tr><td colspan=3 align=center>Сегодня: <a href=\"".$_SERVER['PHP_SELF']."?m=".date("m",time())."&y=".date("Y",time())."\" style=\"text-decoration: none\" title=\"Переход на текущий месяц\"><b>$today</b></a></td></tr></table>";
?>

