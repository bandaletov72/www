<?php
if ($action!="cat") {
if ($au!=1) {
$page_title="";
if ($zak=="") {
if (($valid=="1")&&($details[7]=="ADMIN")){
if ("$catid"=="0") {$scatid=""; }else {$scatid="$catid";}
if ($interface==1) {
top("", "<div width=100%><table border=0 width=100%>
<tr><td>
<button onclick=javascript:location.href='"."$htpath/admin/".$scriptprefix."indexator.php?speek=$speek"."' title=\"".$lang['adm1']."\" class=btn><small>".$lang['adm1']."</small></button>
</td><td>
<button onclick=javascript:location.href='"."$htpath/admin/index_content.php?speek=$speek"."' title=\"".$lang['adm11']."\" class=btn><small>".$lang['adm11']."</small></button>
</td><td>
<button onclick=javascript:location.href='"."$htpath/admin/index_rss.php"."' title=\"".$lang[870]."\" class=btn><small>".$lang[870]."</small></button>
</td><td>
<button onclick=javascript:location.href='"."$htpath/index.php?action=tagindex"."' title=\"".$lang[133]."\" class=btn><small>".$lang[133]."</small></button>
</td><td>
<button onclick=javascript:location.href='"."$htpath/index.php?speeks=$speek&action=vars&mod=admin"."' title=\"".$lang[135]." [$speek]\" class=btn><small>".$lang[135]." [$speek]</small></button>
</td><td>
<button onclick=javascript:location.href='"."$htpath/index.php?action=view_baskets"."' title=\"".$lang['adm4']."\" class=btn><small>".$lang['adm4']."</small></button>
</td>
<td>
<button onclick=javascript:location.href='"."$htpath/index.php?action=interface_off&start=$start&page=$page&catid=$scatid&item_id=$item_id&unifid=$unifid&query=".rawurlencode($query)."&brand=".rawurlencode($brand)."' title=\"".$lang[969]."\" class=btn><i class=icon-eye-close></i><small> </small></button>
</td></tr></table></div>
", $style ['center_width'], $nc0, $nc0, 4,0,"[x0001]");
}
}
$x0001="";
if ($register!=1) {
if ($query=="") {
if (($action=="x")&&($catid=="")&&($fid=="")){


if ($cl_on_main_page_top==1) {
$cl_list="";
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="view_classifieds";$strnum=185; $oldvalue=$$oldval;
if ($$oldval==0) {

$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}
$cl_list.="<div class=round align=center><b>$lang[941]:</b>
$modonoff  <button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[187]=cl_on_main_page_top&nk[187]=NO&evo[187]=$cl_on_main_page_top&ev[187]=0"."' class=btn title=DOWN><img src=\"$image_path/handdown.png\"></button>
<br><br>".$lang[888]."</div><div align=center><img src=\"$image_path/handdown.png\"></div>";
if ($$oldval==0) {$cl_list.="<div align=center><font color=#b94a48>".$lang[941].": ".$lang[894]."</font></div>"; }
top("", $cl_list, $style ['center_width'], $nc0, $nc0, 4,0,"[classifieds]");
endif;
}

if ($view_classifieds==1) {
if ($cl_on_main_page==1) {
$oldfold=$fold;
$fold="./classifieds";
require "$fold/classifieds.php";
top("", "<h4>$lang[941]</h4>".$cl_list, $style ['center_width'], $nc0, $nc0, 4,0,"[classifieds]");
$fold=$oldfold;
}
}
}


if ($blog_on_main_page_top==1) {
$blog_list="";
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")):
$oldval="view_blog"; $strnum=164; $oldvalue=$$oldval;
if ($$oldval==0) {

$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}

$blog_list.="<div class=round align=center><b>$lang[908]:</b>
$modonoff <button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[166]=blog_on_main_page_top&nk[166]=NO&evo[166]=$blog_on_main_page_top&ev[166]=0"."' class=btn title=DOWN><img src=\"$image_path/handdown.png\"></button>
<br><br>".$lang[888]."</div><div align=center><img src=\"$image_path/handdown.png\"></div>";

if ($$oldval==0) {$blog_list.="<div align=center><font color=#b94a48>".$lang[908].": ".$lang[894]."</font></div>"; }
top("", $blog_list, $style ['center_width'], $nc0, $nc0, 4,0,"[blog]");

endif;
}
if ($blog_on_main_page==1) {
if ($view_blog==1) { if ($action!="blog") {
$oldfold=$fold;
$fold="./blog";
require "$fold/".$bscriptprefix."blog.php";
top("", $blog_list, $style ['center_width'], $nc0, $nc0, 4,0,"[blog]");
$fold=$oldfold;
}
}
}
}
if ((@file_exists("$base_loc/content/x0001.txt")==TRUE)) {

if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")): $x0001="<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">x0001</span> <a class=\"btn\" href=#edit onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/x0001.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=\"btn\" href=#del onClick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=x0001&del=x0001','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>"; endif;}



if (@file_exists("$base_loc/content/x0001.txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/x0001.txt" , "r");
$x0001 .= @fread($pageopen, @filesize("$base_loc/content/x0001.txt"));
if (preg_match("/==(.*)==/i", $x0001, $output)) {
$page_title=$output[1];
} else {
$page_title = $lang[221];
}
fclose ($pageopen);

}
}
$carw=ExtractString($x0001,"[carw]","[/carw]");
$carb=ExtractString($x0001,"[buttons]","[/buttons]");
$carh=ExtractString($x0001,"[carh]","[/carh]");
$cara=ExtractString($x0001,"[auto]","[/auto]");
$carspeed=ExtractString($x0001,"[speed]","[/speed]");
$carc=ExtractString($x0001,"[carousel]","[/carousel]");
$x0001=str_replace("[carousel]".$carc."[/carousel]","[carousel]",$x0001);
if ($carc!="") {
$newcar=Array();
$newcar=explode("<li>",$carc);
$carc="";
while (list($cark, $carv)=each($newcar)) {

if (preg_match("/<img/i",$carv)) {
$carc.="<li>".$carv;
}
}
if ($carc!="") {

$butscr="";$butc1="";$butc2="";

if ($carb=="yes") {
$butc1="<table border=\"0\" cellpadding=0 cellspacing=0 width=100%><tr><td align=\"center\">
<a class=\"prev\">&nbsp;</a><br><br><br>
</td><td align=\"center\" width=100%>";
$butc2="</td><td align=\"center\">
<a class=\"next\">&nbsp;</a><br><br><br>
</td></tr>
</table>";
$butscr="btnNext: \".next\",
btnPrev: \".prev\",";}
$carc="<style>
#jCarouselLiteDemo .carousel .jCarouselLite {
position: relative;
visibility: hidden;
left: -5000px;
height: $carh"."px;
margin: 0;
padding: 0;
}
#jCarouselLiteDemo .carousel li{
width: $carw"."px;
margin: 5px 5px 5px 5px;
padding: 0;
}
</style>
<script type=\"text/javascript\">
$(document).ready(function(){

$(\".mouseWheel .jCarouselLite\").jCarouselLite({
mouseWheel: false,
$butscr
visible: 1,
scroll: 1,
auto: $cara,
speed: $carspeed
});

});

</script>


<center>
<div id=\"jCarouselLiteDemo\" style=\"width:98%\">
<div class=\"carousel mouseWheel\" style=\"width:100%\">
$butc1
<div class=\"jCarouselLite\" style=\"width:100%\">
    <ul>
".$carc."</ul>
  </div>
$butc2
</div>
</div>
</center>";
}
}

$x0001=str_replace("[speed]".$carspeed."[/speed]","",str_replace("[auto]".$cara."[/auto]","",str_replace("[buttons]".$carb."[/buttons]","",str_replace("[carousel]","$carc",str_replace("[carw]".$carw."[/carw]","",str_replace("[carh]".$carh."[/carh]","",$x0001))))));

$con=$x0001; $poll_exp="</div>"; require "./modules/mod_poll.php"; $x0001=$con;
$wfc="";
if ($view_wikicat==1) {
$wfi=$base_loc."/wiki/$wiki_content".".txt";
if (!file_exists($wfi)) { } else {
$wfp=fopen($wfi,"r");
$wfc=fread($wfp, filesize($wfi));
fclose($wfp);

}
}
if ($wiki_closed==1) {
$wfc=str_replace("//start", "jsallcl();
document.getElementById('viewjsall').innerHTML='".$lang[422]."';
" , $wfc);}
$x0001=str_replace("[wiki]", "$wfc" , $x0001);
unset($wfi,$wfp, $wfc);
$x0001=str_replace("==$page_title==", "" , $x0001);
if ($x0001!="") {$x0001="<div class=pcont><!--start x0001-->$x0001<!--end x0001--></div>"; }
top("", $x0001, $style ['center_width'], $nc0, $nc0, 4,0,"[x0001]");

unset ($x0001, $page_title, $pageopen);
}
}
}
}
}
}
if (($query=="")&&($unifid=="")&&($item_id=="")&&($catid=="0")&&($action=="x")&&($register!=1)&&($zak=="")){
if ($cat_on_firstpage==1) {
$fold="./cat";
$catincl=1;
require ("./cat/mod_cat.php");
topwo("", "$cat_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
}
?>
