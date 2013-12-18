<?php
//if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $show_bigger_map=1;} }
$shirota=Array();
$h=0;
$h2=0;
if ($au!=1) {
$page_content="";
if ((@file_exists("$base_loc/content/x0002.txt")==TRUE)) {
$pageopen = fopen ("$base_loc/content/x0002.txt" , "r");
$page_content = @fread($pageopen, @filesize("$base_loc/content/x0002.txt"));
if (preg_match("/==(.*)==/i", $page_content, $output)) {
$page_title=$output[1];
} else {
$page_title = $lang[221];
}
fclose ($pageopen);
$page_content=str_replace("==".$page_title."==", "",$page_content);
if ($auto_mark_wiki==1){
$page_content=wikify($page_content);
}
$con=$page_content; $poll_exp="</div>"; require "./modules/mod_poll.php"; $page_content=$con;
$fmap=0;
if (preg_match("/\[map\]/i", $page_content)) { $fmap=1; } else {
if ($usetheme==1) {
if (preg_match("/\[map\]/i", $themecontent)) { $fmap=2; }
}
}

if (preg_match("/\[citymap\]/i", $page_content)) { $fmap=3; } else {
if ($usetheme==1) {
if (preg_match("/\[citymap\]/i", $themecontent)) { $fmap=4; }
}

}
if (($fmap==1)||($fmap==2)) {
require("./modules/worldmap.php");
if ($fmap==1) {
$page_content=str_replace("[citymap]", "$lemap", $page_content);
} else {
$themecontent=str_replace("[citymap]", "$lemap", $themecontent);


}
}
if (($fmap==3)||($fmap==4)) {
require("./modules/citymap.php");
if ($fmap==3) {
$page_content=str_replace("[citymap]", "$lemap", $page_content);
} else {
$themecontent=str_replace("[citymap]", "$lemap", $themecontent);


}
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")):$page_content = "<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">x0002</span> <a class=\"btn\" href=#edit onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/x0002.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=\"btn\" href=#del onClick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=x0002&del=x0002','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>$page_content"; endif;}
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
$page_content=str_replace("[wiki]", "$wfc" , $page_content);
unset($wfi,$wfp, $wfc);
if ($page_content!="") {$page_content="<div class=pcont><!--start x0002-->$page_content<!--end x0002--></div>"; }
top("", $page_content, $style ['center_width'], $nc0, $nc0, 4,0,"[x0002]");
unset ($page_content, $page_title, $pageopen);
}
if ($cl_on_main_page_top==0) {
$cl_list="";
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="view_classifieds";$strnum=185; $oldvalue=$$oldval;
if ($$oldval==0) {

$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}
$cl_list.="<div class=round align=center><b>$lang[941]:</b>
$modonoff  <button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[187]=cl_on_main_page_top&nk[187]=NO&evo[187]=$cl_on_main_page_top&ev[187]=1"."' class=btn title=UP><img src=\"$image_path/handup.png\"></button>
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

if ($blog_on_main_page_top==0) {
$blog_list="";
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="view_blog";$strnum=164; $oldvalue=$$oldval;
if ($$oldval==0) {

$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}
$blog_list.="<div class=round align=center><b>$lang[908]:</b>
$modonoff  <button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[166]=blog_on_main_page_top&nk[166]=NO&evo[166]=$blog_on_main_page_top&ev[166]=1"."' class=btn title=UP><img src=\"$image_path/handup.png\"></button>
<br><br>".$lang[888]."</div><div align=center><img src=\"$image_path/handdown.png\"></div>";
if ($$oldval==0) {$blog_list.="<div align=center><font color=#b94a48>".$lang[908].": ".$lang[894]."</font></div>"; }
top("", $blog_list, $style ['center_width'], $nc0, $nc0, 4,0,"[blog]");
endif;
}

if ($view_blog==1) {
if ($blog_on_main_page==1) {
$oldfold=$fold;
$fold="./blog";
require "$fold/".$bscriptprefix."blog.php";
top("", $blog_list, $style ['center_width'], $nc0, $nc0, 4,0,"[blog]");
$fold=$oldfold;
}
}
}
}


?>
