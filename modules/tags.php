<?php
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="view_tag_clouds";$strnum=65; $oldvalue=$$oldval;
if ($$oldval=="") { $$oldval="c";
$tags_cloud.="<div align=center><font color=#b94a48>".$lang[171].": ".$lang[894]."</font></div>";
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=YES&evo[$strnum]=$oldvalue&ev[$strnum]=c"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=YES&evo[$strnum]=$oldvalue&ev[$strnum]="."' value=\"".$lang[889]."\">";
if ($usetheme==0) {
$modonoff.="<br><br>
<b>$lang[897]:</b>
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=YES&evo[$strnum]=$oldvalue&ev[$strnum]=c"."' value=\"".$lang[899]."\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=YES&evo[$strnum]=$oldvalue&ev[$strnum]=l"."' value=\"".$lang[900]."\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=YES&evo[$strnum]=$oldvalue&ev[$strnum]=r"."' value=\"".$lang[898]."\">&nbsp;";
}
}
$tags_cloud.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center><b>$lang[171]:</b>&nbsp;
<input type=button onclick=javascript:location.href='"."$htpath/index.php?action=tags&mod=admin"."' value=\"".$lang[132]."\">&nbsp;
<input type=button onclick=javascript:location.href='"."$htpath/index.php?action=tagindex"."' value=\"".$lang[133]."\">&nbsp;
$modonoff<br><br>".$lang[888]."</div>"; endif;
}
?>
