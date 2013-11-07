<?php

//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}
function jsbbb ($bscript) {
global $htpath;
global $image_path;
global $speek;
return "<div id=\"$bscript\"></div><script language=javascript>
<!--

function baskv() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskon() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?sw=on&amp;speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskoff() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?sw=off&amp;speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskonoff() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?sw=onoff&amp;speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskoffon() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?sw=offon&amp;speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskodel(arg) {
floading (arg);
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?del='+arg+'&amp;speek=$speek';
scriptNode.type = 'text/javascript';

}
function bplus(arg,arg2) {
floading (arg);
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?plus='+arg+'&qt='+arg2+'&amp;speek=$speek';
scriptNode.type = 'text/javascript';

}
function bminus(arg,arg2) {
floading (arg);
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?minus='+arg+'&qt='+arg2+'&amp;speek=$speek';
scriptNode.type = 'text/javascript';

}
function floading (arg) {
document.getElementById('sp'+arg).innerHTML='<img src=$image_path/loading.gif border=0>';
}
baskv();
-->
</script>";
}


function specpr ($var1, $var2, $var3) {
global $image_path;
global $carat;
$countp=strlen("$var1");
$ipr=0;
$prpr="";
while($ipr<$countp) {
$prpr.=substr($var1, $ipr, 1);
$ipr+=1;
}

return $prpr;
}

function top ($var04, $var00, $var01, $var02, $var03, $var05, $var06, $content) { //title - text - width - border - backround - rounded box - shadow - content
global $gd;
global $image_path;
global $view_shadows;
global $view_round_corners;
global $pix_blocks;
global $nc6;
global $nc0;
global $theme_file;
global $themecontent;
global $carat;
global $main_font_size;
if ($var00==""): return; endif;

if ((isset($theme_file)) && ($theme_file!="")) {
if (isset($content, $var00)) {
//$themecontent=str_replace($content, "<hr>".str_replace("[","",str_replace("]","",$content)).$var00."<br>", $themecontent);
if (($content=="[titul]")) {
if ($var04!="") {
$var00="<br><font color=$var02>$carat <b>$var04</b></font><br><br>".$var00. "<br>";
}
}

$themecontent=str_replace($content, $var00."$content", $themecontent);
} else {
return;
}
} else {

if (($content=="[titul]")) {
echo "$var00"; return;
}  else {
echo "
<div class=\"box\">";
if (trim(trim(strip_tags($var04)))!="") {
echo "<div class=\"onav\" align=left style=\"background: $var02 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($var02,20))."&e=".str_replace("#","",$var02).") repeat-x;\">



                          <font color=$var03 style=\"font-size:".($main_font_size+4)."pt;\">$var04</font>

                    </div>";
                    }

echo "<div class=\"content\" align=left style=\"background: $var03;\">$var00</div>

</div>
<div class=clear></div>";
}
}
}




function topwo ($var04, $var00, $var01, $var02, $var03, $var05, $var06, $content) { //title - text - width - border - backround - rounded box - shadow - content
global $gd;
global $image_path;
global $view_shadows;
global $view_round_corners;
global $pix_blocks;
global $nc6;
global $nc0;
global $theme_file;
global $themecontent;
global $carat;
if ($var00==""): return; endif;
if ((isset($theme_file)) && ($theme_file!="")) {
if (isset($content, $var00)) {
//$themecontent=str_replace($content, "<hr>".str_replace("[","",str_replace("]","",$content)).$var00."<br>", $themecontent);
if (($var04!="")&&($content=="[content]")) { $var00="<br><font color=$var02>$carat <b>$var04</b></font><br><br>".$var00. "<br>";}
$themecontent=str_replace($content, $var00."$content", $themecontent);
} else {
return;
}
} else {
echo "$var00";
}
}




function get_info ($fids) { //fids must be array
global $base_loc;
global $base_file;
global $carat;

$returned_dirs[0]="";
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$sc+=1;
while (list ($key, $line) = @each ($fids)) {
if ($line==($sc)) {
$returned_dirs[$line]=$st;
}
}//end while
@reset ($fids);
}

fclose($f);
return $returned_dirs;
}  //end of function get_info


function get_price($fids) { //fids must be array
global $base_loc;
global $base_file;
global $carat;
$returned_dirs[0]="";
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$sc+=1;
while (list ($key, $line) = @each ($fids)) {
if ($line==($sc)) {
$returned_dirs[$line]=$st;
}
}//end while
@reset ($fids);
}

fclose($f);
$rr=explode("|", $returned_dirs);
return $rr[4];
}  //end of function get_info

function get_weight ($fids) { //fids must be array
global $base_loc;
global $base_file;
global $carat;
global $netweight;
$returned_dirs[0]="";
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$sc+=1;
while (list ($key, $line) = @each ($fids)) {
if ($line==($sc)) {
$returned_dirs[$line]=$st;
}
}//end while
@reset ($fids);
}

fclose($f);
$rr=explode("|", $returned_dirs);
return $rr[$netweight];
}  //end of function get_info

function get_volume ($fids) { //fids must be array
global $base_loc;
global $base_file;
global $carat;
global $box_volume;
$returned_dirs[0]="";
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$sc+=1;
while (list ($key, $line) = @each ($fids)) {
if ($line==($sc)) {
$returned_dirs[$line]=$st;
}
}//end while
@reset ($fids);
}

fclose($f);
$rr=explode("|", $returned_dirs);
return $rr[$box_volume];
}  //end of function get_info

function buybutton ($var_text, $color_but,$color_light,$color_back) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc0;
global $nc2;
global $nc3;
global $gd;
global $lang;
global $buy_button_type;
global $carat;
$link=ExtractString($var_text, "href=\"","\">");
if ($buy_button_type==5) {
$zag = "<input type=button class=\"btn btn-large btn-primary\" onclick=\"$link\" value=\"".$lang['buy']."\">"; return $zag;
}
if ($buy_button_type==4) {
$zag = "<a href=\"$link\"><img src=\"$image_path/buy_small.gif\" border=0 hspace=3 vspace=3></a>"; return $zag;
}
if ($buy_button_type==3) {
$zag = "<a href=\"$link\"><img src=\"$image_path/add.png\" border=0 hspace=3 vspace=3 title=\"".$lang['buy']."\"></a>"; return $zag;
}
if ($buy_button_type==2) {

$zag = "<table border=0 cellpadding=2 cellspacing=0 bgcolor=\"$nc3\" height=28><tr>
<td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=center width=100% style=\"vertical-align:middle\"><img src=\"$image_path/pix.gif\" width=7 height=1 border=0><a href=\"$link\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a><img src=\"$image_path/pix.gif\" width=7 height=1 border=0></td></tr></table>"; return $zag;
}
if ($buy_button_type==1) {
$zag = "<table cellpadding=0 cellspacing=0 border=0><tr><td><table background=\"grad.php?h=28&w=1&e=".str_replace("#","",$nc3)."&s=".str_replace("#","",lighter($nc3,20))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$nc3\" height=28><tr><td valign=bottom style=\"vertical-align:bottom\"><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom></td>
<td align=\"center\" style=\"vertical-align:middle\"><b><font color=$nc0>$carat</font></b></td><td><img src=\"$image_path/pix.gif\" width=4 height=4 border=0></td><td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=center width=100% style=\"vertical-align:middle\"><img src=\"$image_path/pix.gif\" width=7 height=1 border=0><a href=\"$link\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a><img src=\"$image_path/pix.gif\" width=7 height=1 border=0></td></tr></table></td><td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=right style=\"vertical-align:top\"><img src=\"$image_path/pix.gif\" width=4 height=1 border=0 style=\"background-color: $color_back\"><br><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\"><br><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\"></td></tr></table>"; return $zag;
}
}


function jbuybutton ($var_text, $color_but,$color_light,$color_back) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc0;
global $nc2;
global $nc3;
global $gd;
global $lang;
global $carat;
global $buy_button_type;
$link=$var_text;
if ($buy_button_type==5) {
$onclick=ExtractString($var_text, "onclick=\"","\">");
$zag = "<input type=button class=\"btn btn-large btn-primary\" onclick=\"$onclick\" value=\"".$lang['buy']."\">"; return $zag;
}
if ($buy_button_type==4) {
$onclick=ExtractString($var_text, "onclick=\"","\">");
$zag = "<a href=\"#".$lang['buy']."\" onclick=\"$onclick\"><img src=\"$image_path/buy_small.gif\" border=0 hspace=3 vspace=3 title=\"".$lang['buy']."\"></a>"; return $zag;
}
if ($buy_button_type==3) {
$onclick=ExtractString($var_text, "onclick=\"","\">");
$zag = "<a href=\"#".$lang['buy']."\" onclick=\"$onclick\"><img src=\"$image_path/add.png\" border=0 hspace=3 vspace=3 title=\"".$lang['buy']."\"></a>"; return $zag;
}
if ($buy_button_type==2) {

$zag = "<table border=0 cellpadding=2 cellspacing=0 bgcolor=\"$nc3\" height=28><tr>
<td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=center width=100% style=\"vertical-align:middle\"><img src=\"$image_path/pix.gif\" width=7 height=1 border=0><font color=#ffffff>$link</font><img src=\"$image_path/pix.gif\" width=7 height=1 border=0></td></tr></table>"; return $zag;
}
if ($buy_button_type==1) {
$zag = "<table cellpadding=0 cellspacing=0 border=0><tr><td><table background=\"grad.php?h=28&w=1&e=".str_replace("#","",$nc3)."&s=".str_replace("#","",lighter($nc3,20))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$nc3\" height=28><tr><td valign=bottom style=\"vertical-align:bottom\"><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom></td>
<td align=\"center\" style=\"vertical-align:middle\"><b><font color=$nc0>$carat</font></b></td><td><img src=\"$image_path/pix.gif\" width=4 height=4 border=0></td><td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=center width=100% style=\"vertical-align:middle\"><img src=\"$image_path/pix.gif\" width=7 height=1 border=0>$link<img src=\"$image_path/pix.gif\" width=7 height=1 border=0></td></tr></table></td><td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=right style=\"vertical-align:top\"><img src=\"$image_path/pix.gif\" width=4 height=1 border=0 style=\"background-color: $color_back\"><br><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\"><br><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\"></td></tr></table>"; return $zag;
}
}

function navbut ($var_text, $color_but,$color_light,$color_back) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
$zag= "<table background=\"grad.php?h=38&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,$color_light))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$color_but\" height=28><tr><td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=top></td>
<td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td align=\"center\"><nobr>$var_text</nobr><br><img src=\"$image_path/pix.gif\" width=60 height=1 border=0></td><td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td valign=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=top></td>
<td style=\"background-color: $color_back\"><img src=\"$image_path/pix.gif\" border=0 width=1 height=1></td></tr></table>"; return $zag;
}




function but ($var_text, $color_but,$color_light,$color_back) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
$zag= "<table background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,$color_light))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 height=28><tr>
<td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td align=\"center\"><nobr>$var_text</nobr><br><img src=\"$image_path/pix.gif\" width=50 height=1 border=0></td><td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td valign=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=top></td>
<td style=\"background-color: $color_back\"><img src=\"$image_path/pix.gif\" border=0 width=1 height=1></td></tr></table>"; return $zag;
}

function navbut2 ($var_text, $color_but,$color_light,$color_back) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
$zag = "<table cellpadding=0 cellspacing=0 border=0><tr><td><table background=\"grad.php?h=38&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,$color_light))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$color_but\" height=28><tr><td valign=bottom><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom></td>
<td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td align=\"center\"><nobr>$var_text</nobr><br><img src=\"$image_path/pix.gif\" width=60 height=1 border=0></td><td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td valign=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom></td></tr></table></td><td><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=top></td></tr></table>"; return $zag;
}
function navbut3 ($var_text, $color_but,$color_light,$color_back, $no=FALSE) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
$zag = "<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td><table background=\"grad.php?h=36&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,$color_light))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$color_but\" height=28 width=100%><tr><td valign=bottom><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom></td>
<td align=\"center\" width=100%><nobr><b>$var_text</b></nobr></td><td valign=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom></td></tr></table></td><td><img src=\"$image_path/pix.gif\" width=1 height=1 border=0></td></tr></table>"; return $zag;
}

function navbut4 ($var_text, $color_but,$color_light,$color_back, $no=FALSE) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
$zag= "<table background=\"grad.php?h=36&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$color_but\" height=28 width=100%><tr><td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=top></td>
<td width=100% align=center><table border=0 cellpadding=2 cellspacing=0><tr>";
if ($no==FALSE) {$zag .= "<td><img src=\"$image_path/pix.gif\" width=6 height=6 border=0 style=\"background-color: ".lighter($color_but,80)."\" align=bottom></td>";}
$zag .= "<td><nobr>$var_text</nobr></td>";
if ($no==FALSE) {$zag .= "<td><img src=\"$image_path/pix.gif\" width=6 height=6 border=0></td>";}
$zag .= "</tr></table></td><td valign=top align=right><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=top></td>
<td style=\"background-color: $color_back\"><img src=\"$image_path/pix.gif\" border=0 width=1 height=1></td></tr></table>"; return $zag;
}



function trow ($var04, $var00) {
global $image_path;
global $nc6;
global $nc0;
global $gd;
global $carat;
if ($var00==""): return; endif;

echo "                   <tr>
                  <td>

                  <img src=\"images/x.gif\" border=\"0\" height=\"10\" width=\"10\"></td>
                    </tr>

                   <tr>
                  <td>
                  <table style=\"border-collapse: collapse;\" id=\"table107\" border=\"0\" cellpadding=\"0\" width=\"193\">
                    <tbody>
                    <tr>
                  <td>
                  <table style=\"border-collapse: collapse;\" id=\"table108\" border=\"0\" cellpadding=\"0\" width=\"193\">
                    <tbody>
                    <tr>

                      <td>
                      <img src=\"images/top.gif\" border=\"0\" height=\"6\" width=\"193\"></td>
                    </tr>
                    <tr>

                      <td background=\"images/bg.gif\">



                      <table style=\"border-collapse: collapse;\" id=\"table109\" border=\"0\" cellpadding=\"0\" width=\"193\">
                        <tbody>

                        <tr>
                          <td class=\"rightside-highlight-title\">$var04</td>

                        </tr>

                        <tr>
                          <td background=\"images/dots-blue-horizontal.gif\">
                          <img src=\"images/x.gif\" border=\"0\" height=\"1\" width=\"1\"></td>
                        </tr>

                        <tr>
                          <td class=\"rightside-highlight-body\">




                        $var00




                     </td>
                        </tr>
                        </tbody></table>

                      </td>
                    </tr>
                    <tr>
                      <td>
                      <img src=\"images/bottom.gif\" border=\"0\" height=\"7\" width=\"193\"></td>
                    </tr>

                  </tbody>
                  </table>
                  </td>
                    </tr>
                  </tbody>
                  </table>
                  </td>
                    </tr> ";
}


function banner ($var00) {
global $image_path;
global $nc6;
global $nc0;
global $gd;
global $carat;
if ($var00==""): return; endif;

return "<div align=center><table border=0 cellpadding=0 cellspacing=0 width=80%><tr>
<td height=100%>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 height=100%>
<tr>
<TD background=\"images/cl.gif\"><img src=\"images/tl.gif\"></TD>
</tr>
<tr><TD background=\"images/cl.gif\" height=100%></td></tr>
<tr>
<TD background=\"images/cl.gif\"><img src=\"images/bl.gif\"></td>
</tr>
</TABLE>
</td>
<td height=100%>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 height=100%>
<tr>
<TD background=\"images/tc.gif\"><img src=\"images/tc.gif\"></TD>
</tr>
<tr><TD height=100%>

$var00

</td></tr>
<tr>
<TD background=\"images/bc.gif\"><img src=\"images/bc.gif\"></td>
</tr>
</TABLE>
</td>
<td height=100%>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 height=100%>
<tr>
<TD background=\"images/cr.gif\"><img src=\"images/tr.gif\"></TD>
</tr>
<tr><TD background=\"images/cr.gif\" height=100%></td></tr>
<tr>
<TD background=\"images/cr.gif\"><img src=\"images/br.gif\"></td>
</tr>
</TABLE>
</td>

</tr></table></div>";
}


?>
