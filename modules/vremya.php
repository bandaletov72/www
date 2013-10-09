<?php
$time_to_work="";
$bottom_worktime="";
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $admined=""; $oldval="view_worktime"; $strnum=51; $oldvalue=$$oldval;
if ($$oldval==0) {

$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}

$admined.="<div class=round align=center>
<b>".$lang[817].": </b><br><br><input type=button onclick=javascript:location.href='"."$htpath/index.php?action=template&nt=templates/$template&speek=$speek&t=work_time"."' value=\"".$lang['ch']."\"><br><br>
$modonoff
<br><br>".$lang[888]."</div>";
$admined.="<div align=center><img src=\"$image_path/handdown.png\"></div>";
if ($$oldval==0) { $admined.="<div align=center><font color=#b94a48>".$lang[817].": ".$lang[894]."</font></div>";} endif;
if ($links_to_bottom==1) {
$bottom_worktime="<div class=pull-right>".$admined."</div>";
} else {
topwo("", "$admined", "100%",  $nc0, $nc0, 5,0,"[worktime]");
}
}
if ($view_worktime==1) {

$dd1="";
$dd2="";
$dd3="";
$dd4="";
$dd5="";
$dd6="";
$dd7="";
$d1=explode(",",$wt['mon']);
$d2=explode(",",$wt['tue']);
$d3=explode(",",$wt['wed']);
$d4=explode(",",$wt['thu']);
$d5=explode(",",$wt['fri']);
$d6=explode(",",$wt['sat']);
$d7=explode(",",$wt['sun']);
if ($d1[1]==0) {$dd1=$d1[2];} else {$dd1=$d1[2]." - ".$d1[3];}
if ($d2[1]==0) {$dd2=$d2[2];} else {$dd2=$d2[2]." - ".$d2[3];}
if ($d3[1]==0) {$dd3=$d3[2];} else {$dd3=$d3[2]." - ".$d3[3];}
if ($d4[1]==0) {$dd4=$d4[2];} else {$dd4=$d4[2]." - ".$d4[3];}
if ($d5[1]==0) {$dd5=$d5[2];} else {$dd5=$d5[2]." - ".$d5[3];}
if ($d6[1]==0) {$dd6=$d6[2];} else {$dd6=$d6[2]." - ".$d6[3];}
if ($d7[1]==0) {$dd7=$d7[2];} else {$dd7=$d7[2]." - ".$d7[3];}

$vremya="<table border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
<tr>
<td><small>".$d1[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd1."</b></small></td>
<td align=\"right\"><img src=\"".$image_path."/work".$d1[1].".png\" align=\"absmiddle\" border=\"0\"></td>
</tr>
<tr><td><small>".$d2[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd2."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d2[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d3[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd3."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d3[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d4[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd4."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d4[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d5[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd5."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d5[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d6[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd6."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d6[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d7[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd7."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d7[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td colspan=\"2\">
<small> ".$wt['warning']."<br><br> ".$wt['other']."</small>
</td>
</tr>
</table>";
if ($links_to_bottom==1) {if (($worktime_to_bottom==0)&&($leftmenu==0)) { $worktime_to_bottom=1; } }
if ($worktime_to_bottom==0) {
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {

top("<font color=$nc0>$wt_name</font>", "$vremya", "100%", $nc10, $nc0, 4,0,"[worktime]");

}
} else {
$time_to_work="<div class='pull-left mr hvr'><small><br>".$lang['819']."<br>".$lang['820']."</small></div>";
$bottom_worktime="<div class='pull-right' style=\"margin-right:20px;\"><table style=\"width: 200px;\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
<tr>
<td><small>".$d1[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd1."</b></small></td>
<td align=\"right\"><img src=\"".$image_path."/work".$d1[1].".png\" align=\"absmiddle\" border=\"0\"></td>
</tr>
<tr><td><small>".$d2[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd2."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d2[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d3[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd3."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d3[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d4[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd4."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d4[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d5[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd5."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d5[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d6[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd6."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d6[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
<tr><td><small>".$d7[0]."</small></td><td width=\"100%\" align=\"center\"><small><b>".$dd7."</b></small></td><td align=\"right\"><img src=\"".$image_path."/work".$d7[1].".png\" align=\"absmiddle\" border=\"0\"></td></tr>
</table></div>".$bottom_worktime;
}
unset($d1, $d2, $d3, $d4, $d5, $d6, $d7, $wt);
}

?>
