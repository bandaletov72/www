<?php
$widget="";
$mmo=date("m");
if (($mmo=="01")||($mmo=="02")||($mmo=="03"))  { $season="winter";   }
if (($mmo=="03")||($mmo=="04")||($mmo=="05"))  { $season="spring";   }
if (($mmo=="06")||($mmo=="07")||($mmo=="08"))  { $season="summer";   }
if (($mmo=="09")||($mmo=="10")||($mmo=="11"))  { $season="autumn";   }
$timeday="";
$zenith=90+50/60;

$sunrise = date_sunrise(time(), SUNFUNCS_RET_DOUBLE, $lat, $long, $zenith, $offset);
        $sunset = date_sunset(time(), SUNFUNCS_RET_DOUBLE, $lat, $long, $zenith, $offset);
        $now = date("H") + date("i") / 60 + date("s") / 3600;

        if ($sunrise < $sunset) {
                if (($now > $sunrise) && ($now < $sunset)) {$colorday="#00aeff"; $timeday="day";
                }else {
                $colorday="#000000"; $timeday="night"; }
        } else {
                if (($now > $sunrise) || ($now < $sunset)) {$colorday="#00aeff"; $timeday="day";
                }  else {
                $colorday="#000000"; $timeday="night";}
                }


$sun1=date_sunrise(time(), SUNFUNCS_RET_STRING, $lat, $long, $zenith, $offset);
$sun2=date_sunset(time(), SUNFUNCS_RET_STRING, $lat, $long, $zenith, $offset);

$zenith=96;
$sun3=date_sunrise(time(), SUNFUNCS_RET_STRING, $lat, $long, $zenith, $offset);
$sun4=date_sunset(time(), SUNFUNCS_RET_STRING, $lat, $long, $zenith, $offset);

$widget= "<div class=shadow align=left style=\"background-image: url('grad.php?h=40&w=1&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc6)."&d=vertical'); background-repeat: repeat-x; background-color: $nc6; position: fixed; width: 54px; height: 40px; overflow:hidden; top: ".(40+$expos*40)."px; right: -20px; z-index:".(1000-$expos)."; padding: 0px; cursor: pointer; cursor: hand;\" onmouseover=\"javascript:this.style.width='400px';\" onmouseout=\"javascript:this.style.width='54px';\"><table border=0 cellspacing=5 cellpadding=5 height=40><tr>
<td style=\"white-space:nowrap; width:26px;\" align=center valign=top>
<img src=\"$image_path/$timeday.png\" align=absmiddle width=26 height=26 style=\"background-color: $colorday\" title=\"$timeday\"></td>
<td><b>$cityname</b></td>
<td><font size=1>
<img src=\"$image_path/pix.gif\" width=8 height=8 style=\"background-color: #074d6d\" title=\"Twilight\" hspace=3> $sun3 <img src=\"$image_path/pix.gif\" width=8 height=8 style=\"background-color: #ff9c00\" title=\"Sunrise\" hspace=3> $sun1<br>
<img src=\"$image_path/pix.gif\" width=8 height=8 style=\"background-color: #074d6d\" title=\"Twilight\" hspace=3> $sun2 <img src=\"$image_path/pix.gif\" width=8 height=8 style=\"background-color: #000000\" title=\"Sunset\" hspace=3> $sun4</font></td>
<td align=center><font size=1>
<font color=#468847>|</font><br>
<font color=#3a87ad>—</font></font></td>
<td><font size=1>
$lat&deg;<br>
$long&deg;</font></td></tr></table></div>";
if ($usetheme==1) {
$themecontent=str_replace("[widgets]", "$widget"."[widgets]",$themecontent);
$themecontent=str_replace("[window]", "$season$timeday",$themecontent);
} else {

echo $widget;
}

$expos+=1;

?>
