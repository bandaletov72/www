<?php

if ($usetheme==0) {
if ($css_style==1) {
if ($affix==1) {
if ($_SESSION["mclosed"]=="1") { $stwi="93%"; } else { $stwi=(doubleval($style['center_width'])-doubleval($style['affix_width']))."%"; }
echo "</div></div><div id=\"main\" class=\"pr\" style=\"width:".$stwi."; left:0px;\">";
} else {
echo "</td><td valign=top>";
}
} else {
echo "</td><td valign=top align=left background=\"grad.php?h=1&w=10&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc0)."&d=horizontal\">
<img src=\"$image_path/pix.gif\" width=10 height=16 border=0 style=\"background-color: $nc0\"><br>
<img src=\"$image_path/pix.gif\" width=5 height=1 border=0 style=\"background-color: $nc0\"><br>
<img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\"></td><td valign=\"top\" align=\"left\" width=\"" . $style ['center_width'] . "\"><img src=\"$image_path/pix.gif\" width=5 height=6 border=0><br>";
}
$firstp=0;
if (("$catid"=="0")||("$catid"=="_")||("$catid"=="")) {
if (($unifid=="")&&($item_id=="")) {
if ($usetheme==0) { if (($action=="x")&&("$catid"=="0")) {$firstp=1;  }}
if ($tit=="") {$tit=$shop_name." - "; }
if ($action!="cat") {
if ($css_style==1) {
if ($firstp==0) {
echo "<div class=\"titlediv\" align=left><h1>".substr($tit,0,-2)."</h1></div><div class=clearfix></div>";
}
} else {
echo "<table border=0 cellspacing=0 cellpadding=0 width=100% style=\"background-color: $nc6; background-image: url('grad.php?h=1&w=1280&e=".str_replace("#","",$nc0)."&s=".str_replace("#","",$nc6)."&d=horizontal'); background-repeat: repeat-y\"><tr>
<td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top></td>
<td><img src=\"$image_path/pix.gif\" width=10 height=30 border=0></td><td align=left valign=middle width=100%><h1 style=\"font-size:".($main_font_size+4)."pt; line-height: 1em; margin: 0;\">$carat ".substr($tit,0,-2)."</h1></td>
<td>&nbsp;&nbsp;&nbsp;</td></tr></table>";
}
}
}
}

}
if ($r!=""){
$indrr=$r."||";
$ruu="$r";
if ($sub!="") {$ruu.=" / $sub";  if ($logodirsy[$r."|$sub|"]=="") {$indrr=$r."||";} else {$indrr=$r."|$sub|";}}
if ($title_type_table==1) {
//var 1
//echo "r=$r<br>";
//echo "sub=$sub<br>";
//echo "catid=$catid<br>";
//echo "metat=$metat<br>";

if (($r!="")&&($sub!="")) {
$metat="$brand$metat";
$tit="<div style=\"display:inline; font-size: $title_font_size"."px;\">"; if ($r!="All") { $tit.="<b class=lnk><a href=\"$htpath/index.php?catid=".translit($r)."\"><a href=\"index.php\">".$lang['mainsite']."</a></b> <img src=$image_path/cat1.png hspace=5 border=0> <b class=lnk><a href=\"$htpath/index.php?catid=".translit($r)."\">".$r."</a></b> <img src=$image_path/cat1.png hspace=5 border=0 title=\"".htmlspecialchars($r)."\" align=absmiddle> "; } $tit.="<b class=lnk><a href=\"$htpath/index.php?catid=".translit($r."_".$sub."_")."\">$sub</a></b> <img src=$image_path/cat1.png hspace=5 border=0 title=\"".htmlspecialchars($sub)."\" align=absmiddle> <b class=lnk><h1 style=\"display:inline; font-size: $title_font_size"."px;\">$metat</h1></b></div>  ";
if (($title_use_item_name==0)&&($brand=="")) {
$tit="<div style=\"display:inline; font-size: $title_font_size"."px;\">"; if ($r!="All") { $tit.="<b class=lnk><a href=\"$htpath/index.php?catid=".translit($r)."\"><a href=\"index.php\">".$lang['mainsite']."</a></b> <img src=$image_path/cat1.png hspace=5 border=0> <b class=lnk><a href=\"$htpath/index.php?catid=".translit($r)."\">".$r."</a></b> <img src=$image_path/cat1.png hspace=5 border=0 title=\"".htmlspecialchars($r)."\" align=absmiddle> "; } $tit.="<b class=lnk><a href=\"$htpath/index.php?catid=".translit($r."_".$sub."_")."\">$sub</a></b> <img src=$image_path/cat1.png hspace=5 border=0 title=\"".htmlspecialchars($sub)."\" align=absmiddle></div>  ";

}
}

if (($r!="")&&($sub=="")) {
$metat="";
$tit="<div style=\"display:inline; font-size: $title_font_size"."px;\"><b class=lnk><a href=\"$htpath/index.php?catid=".translit($r)."\"><a href=\"index.php\">".$lang['mainsite']."</a></b> <img src=$image_path/cat1.png hspace=5 border=0> <b class=lnk><a href=\"$htpath/index.php?catid=".translit($r)."\"><h1 style=\"display:inline; font-size: $title_font_size"."px;\">$r</h1></a></b> <img src=$image_path/cat1.png hspace=5 border=0 title=\"".htmlspecialchars($r)."\" align=absmiddle></div>  ";

}

if ($css_style==1) {
$ddir="<div class=\"titlediv\" align=left><h1>".substr($tit,0,-2)."</h1></div><div class=clearfix></div>";

} else {
$ddir="<table width=100% border=0 cellpadding=0 cellspacing=0><tr><td align=left width=100% valign=top><table border=0 cellspacing=0 cellpadding=0 width=100% style=\"background-color: $nc10; background-image: url('grad.php?h=1&w=1280&e=".str_replace("#","",$nc0)."&s=".str_replace("#","",$nc10)."&d=horizontal'); background-repeat: repeat-y\"><tr>
<td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top></td>
<td><img src=\"$image_path/pix.gif\" width=10 height=30 border=0></td><td valign=middle align=left width=100%><b><font style=\"font-size: $title_font_size"."px;\"> ".substr($tit,0,-2)."</font></b></td>
</tr></table></td><!-- td valign=right width=50%><div align=right>".str_replace(" border=0", " style=\"border: $nc6 solid 2px\" border", @$logodirsy[$indrr])."</div></td--></tr></table>";
}

} else {

//var 0
if ($css_style==1) {
$ddir="<div class=\"titlediv\" align=left><h1>".substr($tit,0,-2)."</h1></div><div class=clearfix></div>";

} else {
$ddir="<table width=100% border=0 cellpadding=0 cellspacing=0><tr><td align=left width=100% valign=top><table border=0 cellspacing=0 cellpadding=0 width=100% style=\"background-color: $nc10; background-image: url('grad.php?h=1&w=1280&e=".str_replace("#","",$nc0)."&s=".str_replace("#","",$nc10)."&d=horizontal'); background-repeat: repeat-y\"><tr>
<td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top></td>
<td><img src=\"$image_path/pix.gif\" width=10 height=30 border=0></td><td valign=middle align=left width=100%><b><font style=\"font-size: $title_font_size"."px;\"> ".substr($tit,0,-2)."</font></b></td>
</tr></table></td><!-- td valign=right width=50%><div align=right>".str_replace(" border=0", " style=\"border: $nc6 solid 2px\" border", @$logodirsy[$indrr])."</div></td--></tr></table>";
}
}
topwo("", $ddir, $style ['center_width'], $nc0, $nc0, 4,0,"[titul]");
}
?>
