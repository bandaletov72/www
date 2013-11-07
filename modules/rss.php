<?php
$rss="";
if (($view_rss==1)&&($tfind==0)) {
if (@file_exists("./admin/db/rss.txt")){
$rssf = fopen ("./admin/db/rss.txt" , "r");
$rss= @fread($rssf, @filesize("./admin/db/rss.txt"));
fclose ($rssf);
}
}
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="view_rss";$strnum=133; $oldvalue=$$oldval; if ($view_rss==0) { };
if ($view_rss==0) {
$rss.="<div align=center><font color=#b94a48>".$lang[891].": ".$lang[894]."</font></div>";
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}

$rss.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center>
<b>".$lang[891].": </b><input type=button onclick=javascript:location.href='"."$htpath/admin/index_rss.php"."' value=\"".$lang[870]."\">&nbsp;
$modonoff
<br><br>".$lang[888]."<br><b>".$lang[892].": </b>
<input type=button onclick=javascript:location.href='"."$htpath/index.php?action=template&nt=templates/$template&t=css&amp;speek=$speek"."' value=\"".$lang[893]."\">&nbsp;</div>"; endif;
}
?>
