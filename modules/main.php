<?php
if (($action!="zakaz")&&
($action!="tospec")&&
($action!="addtospec")&&
($action!="replacer")&&
($action!="folderimg")&&
(@$register=="")&&
($action!="clear")&&
($action!="ext_search")&&
($action!="viewfile")&&
($action!="sendmail")&&
($action!="sendok")&&
($action!="allnews")&&
($action!="forum")&&
($action!="forum_admin")&&
($action!="view_users")&&
($action!="view_links")&&
($action!="view_cmenu")&&
($action!="links")&&
($action!="view_baskets")&&
($action!="template")&&
($action!="htaccess")&&
($action!="userip")&&
($mod!="admin")&&
($action!="basket")&&
($action!="send")&&
($query=="")) {

if (($catid!="")&&($catid!="_")) {
if ($query=="") {

require ("./templates/$template/view.inc");
if ($items_db_type=="mysql") {
require ("./modules/mysql_view.php");
}else{
require ("./modules/view.php");
}
}
}

if (($catid!="")&&($catid!="_")) {
if (($usetheme==0)&&(substr($catid,-1)=="_")) { echo "<table border=0 cellpadding=0 cellspacing=0 width=100%><tr><td valign=top>"; }
$catm="";
$ssub="";
$sr="";
sort($fcontentsa);
reset ($fcontentsa);
if ($r!==""){
$sr=" / <a href=\"$htpath/index.php?catid=" .@$podstava["$r||"]. "\">$r</a>";
if (@$mod_rw_enable==1): $sr=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$sr"));  endif;
while (list ($cnum, $cline) = each ($fcontentsa)) {
$ctemp=explode("|", $cline);
if (($ctemp[2]=="")&&($ctemp[0]==@$podstava["$r||"])){
$catm.="<table cellspacing=0 cellpadding=7 border=0><tr><td valign=top>".@$ctemp[3]."</td><td valign=top><b><a href=\"$htpath/index.php?catid=" .@$podstava["$r||"]. "\"><FONT  color=\"".$style['nav_col1']."\">".str_replace(" ", "&nbsp;" , $r)."</font></a></b><br>";
}
if (@$mod_rw_enable==1): $catm=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$catm"));  endif;

}
}
reset($fcontentsa);
natsort ($fcontentsa);
$cg=0;
while (list ($cnum, $cline) = each ($fcontentsa)) {
$ctemp=explode("|", $cline);
if (($ctemp[0]==$podstava["$r|$sub|"])&&($ctemp[1]=="$r")&&($sub!="")): $cg+=1; $catmm[$cg]="<!-- ".str_replace(" ", "&nbsp;" , $sub)." --><small>$carat&nbsp;<b><a href=\"$htpath/index.php?catid=" .$podstava["$r|$sub|"]. "\">".str_replace(" ", "&nbsp;" , $sub)."</a></b></small><br>\n"; endif;
if (($ctemp[0]!=$podstava["$r|$sub|"])&&($ctemp[1]=="$r")&&($ctemp[2]!="")): $cg+=1; $catmm[$cg]="<!-- ".str_replace(" ", "&nbsp;" , $ctemp[2])." --><small>$carat&nbsp;<a href=\"$htpath/index.php?catid=" .$ctemp[0]. "\">".str_replace(" ", "&nbsp;" , $ctemp[2])."</a></small><br>\n"; endif;
}
@sort($catmm);
@reset($catmm);
$kolvostr= ceil(count($catmm)/$style['vitrin_columns']);
$cg=0;
$fcm=0;
while (list ($cnumm, $clinem) = @each ($catmm)) {

if ($cg==$kolvostr):$cg=0; $catm.="</td>\n<td valign=top><br>"; endif;
$catm.=$clinem;
$cg+=1;
$fcm+=1;
}
if (@$mod_rw_enable==1): $catm=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$catm"));  endif;

if ($sub!==""){
$ssub=" / <b><a href=\"$htpath/index.php?catid=" .$podstava["$r|$sub|"]. "\">$sub</a></b>";
if (@$mod_rw_enable==1): $ssub=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$ssub"));  endif;
}
$catm.="</td></tr></table>";

if ($catid=="_"):$catm=""; endif;
if ($brand==""){$br="";$bbr="";} else {$bbr="<b><font color=\"".$style['nav_col1']."\">$brand</font></b>"; $br=" / $bbr";}
$allsp="<table width=100% border=0 cellpadding=0 cellspacing=0><tr><td valign=top align=left><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top></td><td align=left valign=top>$catm</td><td align=right valign=bottom><font size=3>$bbr &nbsp;&nbsp</font></td><td valign=top align=right><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top></td></tr><tr><td colspan=4><img src=\"$image_path/pix.gif\" border=0 width=1 height=5></td></tr></table><br>";
if ($fcm<=1) { $allsp="";}
if ($view_catm==0) {$allsp="";}

if (@$mod_rw_enable==1): $allsp=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "$allsp"));  endif;
if ($usetheme==0) {
echo $warn;
} else {
top("", "$warn", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[warn]");
}
if ($view_goodsprice==1){ if ($view_sort!=0) { } else {$sortecho="";}}else {$sortecho="";}
if ($usetheme==0) {
echo "<div align=center>";
echo "$allsp";

echo "$spisok</div>";
} else {
if ($view_goodsprice==1){ if ($view_sort!=0) { $themecontent=str_replace("[sortmenu]","$sortecho",$themecontent);}}
top("", "$allsp", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]");
top("", "$spisok", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content1]");

}
/* right jsbasket
if (($usetheme==0)&&(substr($catid,-1)=="_")) {echo "</td>";}

if (($action!="zakaz")&&($action!="basket")&&($action!="send")&&($view_bask!=0)&&(substr($catid,-1)=="_")) {
if ($usetheme==0) { echo "<td valign=top>"; }

topwo("", jsbbb("jsbask"), $style ['right_width'], $nc0, $nc0, 5,0,"[main_basket]");
if (($usetheme==0)&&(substr($catid,-1)=="_")) { echo "</td>"; }
}
*/


if (($usetheme==0)&&(substr($catid,-1)=="_")) {echo "</tr></table>";}

}

}
if ($u_mes!="") {
if ($usetheme==0) {
echo "$u_mes";
} else {
top("", "$u_mes" , $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_content']) , 0,0,"[content]");
}
}
//if (($action!="zakaz")&&($action!="basket")&&($action!="send")) {
//topwo("", jsbbb("jsbask"), $style ['right_width'], $nc0, $nc0, 5,0,"[main_basket]");
//}
?>
