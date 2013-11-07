<?php
$header_height=90;
$activeh="";
if (($query=="")&&($unifid=="")&&($item_id=="")&&($catid=="0")&&($action=="x")&&($register!=1)&&($zak=="")&&($cat=="")&&($sign_in!=1)){$activeh=" active"; }
$catbuttons_under_logo=0; //0 or 1
$colspa=3;
if ($nav_pos==0) {$nwc7=$nc0;} else { $nwc7=$nc7;}

if ($header_type==1) {
echo "<table style=\"background: ".$nc10."; background-image: url('".$image_path."/heavenbg.png'); background-position: left top\" align=\"center\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
<tr><td align=center><table border=0 cellpadding=0 cellspacing=0 style=\"background-image: url('".$image_path."/dream.png'); background-position: right bottom; background-repeat: no-repeat;\" width=100%>
  <tr>
    <td><img src=\"".$image_path."/pix.gif\" border=0 width=20 height=$header_height></td>
    <td width=100% valign=bottom align=center>
    <table width=100% border=0 cellpadding=0 cellspacing=0 height=$header_height style=\"width:$shwid;\">
    <tr><td valign=\"bottom\" align=left>$logo_shop</td>";
if ($catbuttons_under_logo==1) { echo  "</tr><tr>"; }
    echo "
<td valign=\"bottom\" align=\"center\"";
if ($catbuttons_under_logo==1) { echo  " height=40"; }
echo">";
if ($authtype==2) {
echo"<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td align=\"right\" valign=top>$loginout</td></tr><tr><td valign=bottom>";
}
if ($view_catbut==1) {
if ($nav_pos==1) { if ($replace_navbut==0) { echo $catbut;}}}
if ($authtype==2) {  echo"</td></tr></table>";}
echo"</td>
    </tr></table></td>";
    if ($authtype==1) {
    $colspa=5;
echo"<td><img src=\"$image_path/pix.gif\" width=10 height=1></td><td align=\"right\" valign=bottom>$loginout<br></td>";
}
    echo "<td><img src=\"".$image_path."/pix.gif\" border=0 width=20 height=5></td>
</tr><tr><td colspan=$colspa>". @$navigator."</td></tr>
</table></td></tr></table>";

}
if ($header_type==0) {
echo "<table style=\"background: ".$nc10.";\" align=\"center\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
<tr><td align=center><table border=0 cellpadding=0 cellspacing=0 style=\"width:$shwid;\">
  <tr>
    <td><img src=\"".$image_path."/pix.gif\" border=0 width=1 height=$header_height></td>
    <td width=100% valign=bottom>
    <table width=100% border=0 cellpadding=0 cellspacing=0 height=$header_height>
    <tr><td valign=\"bottom\" align=left>$logo_shop</td>";
if ($catbuttons_under_logo==1) { echo  "</tr><tr>"; }
    echo "
<td valign=\"bottom\" align=\"center\"";
if ($catbuttons_under_logo==1) { echo  " height=40"; }
echo">";
if ($authtype==2) {
echo"<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td align=\"right\" valign=top>$loginout</td></tr><tr><td valign=bottom>";
}
if ($view_catbut==1) {
if ($nav_pos==1) { if ($replace_navbut==0) { echo $catbut;}}}
if ($authtype==2) {  echo"</td></tr></table>";}
echo"</td>
    </tr></table></td>";
    if ($authtype==1) {
    $colspa=5;
echo"<td><img src=\"$image_path/pix.gif\" width=10 height=1></td><td align=\"right\" valign=bottom>$loginout<br></td>";
}
    echo "<td><img src=\"".$image_path."/pix.gif\" border=0 width=20 height=5></td>
</tr></table>
<table cellpadding=0 cellspacing=0 border=0 width=100%>
<tr><td align=center>". @$navigator."</td></tr>
</table></td></tr></table>";

}
//minimalism
if ($header_type==2) {
$tmp=file("$base_loc/navigate.txt");
$contbuttons="";
while (list($key,$val)=each($tmp)) {
if ((trim($val)!="")&&(!preg_match("/icon-home/i", $val))) {

if (substr($page,0,1)==substr($val,4,1)&&($page!="")) {$active=" style=\"background: ".lighter($nc5,20).";\"";} else {$active="";}
$contbuttons.="<li class=\"f1\"".$active.">".str_replace("<b><font color=\"$nc9\" class=f1>","<font color=\"$nc9\">",str_replace("</font></b>","</font>", $val))."</li><li class=divider-vertical2></li>";
//$contbuttons.="<li>".str_replace("<b><font color=\"$nc9\" class=f1>","",str_replace("</font></b>","", $val))."</li>";
}
}
if ($action=="basket") { $active=" active"; }
if ($action=="clear") { $active=" active"; }
echo "<div class=\"navbar navbar-inverse navbar-fixed-top\">
<div class=\"navbar-inner\">
<div class=\"container\" style=\"width:$shwid;\">
<button type=\"button\" class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
<span class=\"icon-bar\"></span>
<span class=\"icon-bar\"></span>
<span class=\"icon-bar\"></span>
</button>
";
if ($affix==0) { echo "<a class=pull-left href=\"./\" title=\"".$lang['mainsite']."\" style=\"margin-top:4px;\"><img src=\"logo_mini.png\" border=0></a>"; }
echo "
<div class=\"nav-collapse collapse\">
<ul class=\"nav\">";
if ($affix==1) { echo "<li class=\"f1$activeh\"><a class=pull-left href=\"./\" title=\"".$lang['mainsite']."\" style=\"margin-top:4px;\"><i class=\"icon-home icon-white\"></i></a></li>"; }
echo "$contbuttons
$enter
<li class=\"f1 pull-right$active\">$korz</li>
<li style=\"width:55px; text-align:right;\">$searchmenu</li>
</ul>
</div>
</div>
</div>
</div><img src=\"".$image_path."/pix.gif\" border=0 width=1000 height=41><br>";

}

//minimalism with subs
if ($header_type==3) {
if (!file_exists("$base_loc/navigate2.txt")) { $contbuttons = " Please Reindex base! "; } else {
$tmp=file("$base_loc/navigate2.txt");
$contbuttons="";

while (list($key,$val)=each($tmp)) {
if (trim($val)!="") {

$rep="/--".substr($page,0,1)."--/i";
if (preg_match($rep,$val)) {  $val=str_replace("noactive\"" , "active\"", $val); }
$contbuttons.="$val";
}
}
$contbuttons=str_replace("VIDEO - ","<i class=icon-facetime-video></i> ", $contbuttons);
}
if ($action=="basket") { $active=" active"; }
if ($action=="clear") { $active=" active"; }
echo "<div class=\"navbar navbar-inverse navbar-fixed-top\">
<div class=\"navbar-inner\" style=\"white-space:nowrap;\">
<div class=\"container\" style=\"width:$shwid;\">
";
if ($affix==0){echo "<a class=pull-left href=\"./\" title=\"".$lang['mainsite']."\" style=\"margin-top:4px;\"><img src=\"logo_mini.png\" border=0></a>"; }
echo "
<div class=\"nav-collapse collapse navbar-responsive-collapse nowrap\">
<ul class=\"nav nowrap\">
";
if ($affix==1) { echo "<li class=\"f1$activeh\"><a class=pull-left href=\"./\" title=\"".$lang['mainsite']."\" style=\"margin-top:4px;\"><i class=\"icon-home icon-white\"></i></a></li>"; }
echo "$contbuttons
$enter
<li class=\"f1 pull-right$active\">$korz</li>
<li style=\"width:55px; text-align:right;\">$searchmenu</li>
</ul>
</div>
</div>
</div>
</div><img src=\"".$image_path."/pix.gif\" border=0 width=1000 height=41><br>";
//echo $page." $opage";
}
?>
