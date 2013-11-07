<?php
if (($catid!="")||($unifid!="")||($item_id!="")) { if ($view_left_menu_items==0) {$view_all_site=0; } else {$links_to_bottom=0; } }
if ($view_all_site==1) {
if ($usetheme==0) {
if ($leftmenu==0) {$links_to_bottom=1;}
if ($affix==1) { $leftmenu=1; $links_to_bottom=0;}
if ($links_to_bottom==1) {
$ll = @fopen ("$base_loc/bottomlinks.txt" , "r");
$ll_cont= (@fread ($ll, @filesize ("$base_loc/bottomlinks.txt")));
@fclose ($ll);

$ll_cont=str_replace("page=$opage'", "page=$opage' style=\"font-weight:400; background-color: ".$nc5.";\"", $ll_cont);
$ll_cont=str_replace("page=$page'", "page=$page' style=\"font-weight:400; background-color: ".$nc5.";\"", $ll_cont);
$bottom_links=$ll_cont;

} else {

$ll = fopen ("$base_loc/links.txt" , "r");
$ll_cont= (@fread ($ll, @filesize ("$base_loc/links.txt")));

fclose ($ll);
$ll_cont=str_replace(" href='index.php?page=$opage&", " style=\"font-weight:400; background-color: ".$nc5.";\" href='index.php?page=$opage&", $ll_cont);
$ll_cont=str_replace(" href='index.php?page=$page&", " style=\"font-weight:400; background-color: ".$nc5.";\" href='index.php?page=$page&", $ll_cont);
if ($bb>0) {
$ll_cont=str_replace(" style=\"display: none;\" id=\"d_".$bb."\""," id=\"d_".$bb."\"", str_replace("id=\"i_".$bb."\" class=\"icon-chevron-right icon-white\"","id=\"i_".$bb."\" class=\"icon-chevron-down icon-white\"",$ll_cont));
}
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
topwo ("", "$ll_cont", "100%", $nc0, $nc0, 0,0,"[links]");

}
}




} else {

if ($links_to_bottom==1) {
$ll = @fopen ("$base_loc/bottomlinks.txt" , "r");
$ll_cont= (@fread ($ll, @filesize ("$base_loc/bottomlinks.txt")));
@fclose ($ll);
if ($repzeme!="") {
$ll_cont=str_replace("$repzeme","themes/$repzeme",$ll_cont);
}
$ll_cont=str_replace("page=$opage'", "page=$opage' style=\"font-weight:400; background-color: ".$nc5.";\"", $ll_cont);
$ll_cont=str_replace("page=$page'", "page=$page' style=\"font-weight:400; background-color: ".$nc5.";\"", $ll_cont);
$bottom_links=$ll_cont;
} else {

$ll = fopen ("$base_loc/links.txt" , "r");
$ll_cont= (@fread ($ll, @filesize ("$base_loc/links.txt")));

fclose ($ll);
$ll_cont=str_replace(" href='index.php?page=$opage&", " style=\"font-weight:400; background-color: ".$nc5.";\" href='index.php?page=$opage&", $ll_cont);
$ll_cont=str_replace(" href='index.php?page=$page&", " style=\"font-weight:400; background-color: ".$nc5.";\" href='index.php?page=$page&", $ll_cont);
if ($bb>0) {
$ll_cont=str_replace(" style=\"display: none;\" id=\"d_".$bb."\""," id=\"d_".$bb."\"", str_replace("id=\"i_".$bb."\" class=\"icon-chevron-right icon-white\"","id=\"i_".$bb."\" class=\"icon-chevron-down icon-white\"",$ll_cont));
}
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
topwo ("", $ll_cont, "100%", $nc0, $nc0, 0,0,"[links]");

}
}
}



$ll = fopen ("$base_loc/link_index.txt" , "r");
$ll_cont= (@fread ($ll, @filesize ("$base_loc/link_index.txt")));
fclose ($ll);
if ($repzeme!="") {
$ll_cont=str_replace("$repzeme","themes/$repzeme",$ll_cont);
}



}
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")){ $admined=""; $oldval="view_all_site";$strnum=62; $oldvalue=$$oldval;
if ($$oldval==0) {
$admined.="<div align=center><font color=#b94a48>".$lang[127].": ".$lang[894]."</font></div>";
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}
$admined.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center><b>$lang[127]:</b><br><br>
<input type=button onclick=javascript:location.href='"."$htpath/admin/editor/index.php?speek=$speek"."' value=\"".$lang['adm3']."\"><br><br>
$modonoff<br><br>".$lang[888]."</div>";
if ($links_to_bottom==1) {
$bottom_links.="<div class=pull-left>".$admined."</div>";
} else {
topwo ("", $admined, "100%", $nc0, $nc0, 4,0,"[links]");
}
}
}
?>
