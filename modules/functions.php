<?php

function wikify($text, $page="") {
global $wiki_content;
global $wiki_rubric;
global $base_loc;
global $full_wiki_repl;
if (($page!=$wiki_content)&&($page!=$wiki_rubric)){

if (file_exists("$base_loc/wikireplace.txt")==TRUE) {
$wikireplace=file("$base_loc/wikireplace.txt");
reset ($wikireplace);
while (list ($keywiki, $valwiki) = each ($wikireplace)) {
$tmpwiki=explode("~", strip_tags($valwiki));

$tmpwiki2=explode("|", $tmpwiki[0]);
$llink=$tmpwiki[1];
$urll="";
$urll=ExtractString($valwiki,"[url]","[/url]");
if ($urll!="") {$llink=$urll;}
while (list ($keywiki2, $valwiki2) = @each ($tmpwiki2)) {
$valwiki2=str_replace("/","", stripslashes($valwiki2));
if (strlen($valwiki2)>=3) {
if ($full_wiki_repl==1) {
$text=str_replace($valwiki2, "<a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\" target=_blank>".$valwiki2."</a>", $text);
$upwiki=strtoupper(toUpper(substr($valwiki2,0,1))).substr($valwiki2,1,(strlen($valwiki2)-1));
$text=str_replace($upwiki, "<a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\" target=_blank>".$upwiki."</a>", $text);
} else {
$text=str_replace($valwiki2." ", "<a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\" target=_blank>".$valwiki2."</a> ", $text);
$upwiki=strtoupper(toUpper(substr($valwiki2,0,1))).substr($valwiki2,1,(strlen($valwiki2)-1));
$text=str_replace($upwiki." ", "<a href=\"".$llink."\" style=\"border-bottom: #b94a48 1px dashed; text-decoration:none;\" target=_blank>".$upwiki."</a> ", $text);
}
//echo strlen($valwiki2)." ".$valwiki2."<br>";
}
}
}
return $text;
}
} else {
return $text;
}
}
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}
function jsbbb ($bscript) {
global $htpath;
global $image_path;
global $speek;
global $lang;
global $style;
global $sid;
$sw="";
$cl=" class=box4 style=\"width: 96%;\"";
if ($bscript=="jscheckout") {$sw="&sw=on";$cl=""; }
return "<div id=\"$bscript\"".$cl."><div style=\"margin: 0px 0px 10px 0px; padding: 20px;\"><br><br><table border=0 width=100%><tr><td align=center><img src=$image_path/loading.gif border=0 class='loading'></td></tr><tr><td align=center><font size=4>$lang[1568]</font></td></tr></table><br><br><div class=clearfix></div></div></div><script language=javascript>
<!--
function baskv() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&speek=$speek".$sw."';
scriptNode.type = 'text/javascript';

}
function baskon() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&sw=on&speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskoff() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&sw=off&speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskonoff() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&sw=onoff&speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskoffon() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&sw=offon&speek=$speek';
scriptNode.type = 'text/javascript';

}
function baskodel(arg) {
floading (arg);
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&del='+arg+'&speek=$speek';
scriptNode.type = 'text/javascript';
}
function bplus(arg,arg2) {
floading (arg);
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&plus='+arg+'&qt='+arg2+'&speek=$speek';
scriptNode.type = 'text/javascript';

}
function bminus(arg,arg2) {
floading (arg);
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/$bscript.php?session=$sid&minus='+arg+'&qt='+arg2+'&speek=$speek';
scriptNode.type = 'text/javascript';

}
function floading (arg) {
document.getElementById('sp'+arg).innerHTML='<img src=$image_path/loading.gif border=0>';
}
$(document).ready(function() {
baskv();
});
-->
</script>";
}


function specpr ($var1, $var2, $var3) {
global $image_path;
global $carat;
global $more_css_style;
$countp=strlen("$var1");
$ipr=0;
$prpr="";
while($ipr<$countp) {
$prpr.=substr($var1, $ipr, 1);
$ipr+=1;
}

return $prpr;
}
if (!isset($more_css_style)) {$more_css_style=0;}
function topw1 ($var04, $var00, $var01, $var02, $var03, $var05, $var06, $content, $ret=false) { //title - text - width - border - backround - rounded box - shadow - content

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

$retr= "<div class=\"box2\">";
if (trim(trim(strip_tags($var04)))!="") {
$retr.= "<div class=\"onav2\" align=left style=\"background: $var02 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($var02,20))."&e=".str_replace("#","",$var02).") repeat-x;\">
<font color=$var03 style=\"font-size:".($main_font_size+4)."pt;\">$var04</font>
</div>";
}

$retr.= "<div class=\"content\">$var00</div>
</div>
<div class=clear></div>";
if ($ret==true) {
return $retr;
} else {
$themecontent=str_replace($content, $retr.$content, $themecontent);
}
}
if ($more_css_style==1) {
function top ($var04, $var00, $var01, $var02, $var03, $var05, $var06, $content) { //title - text - width - border - backround - rounded box - shadow - content
global $gd;
global $image_path;
global $view_shadows;
global $view_round_corners;
global $pix_blocks;
global $nc6;
global $nc0;
global $nc10;
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
echo "<div";
if ($var04=="") {echo " class=box"; } else { echo " class=box2"; }
echo ">";
if (trim(trim(strip_tags($var04)))!="") {
echo "<div";
if ($var04=="") {echo " class=onav"; } else { echo " class=onav2"; }
echo " align=left style=\"background: $var02 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($var02,10))."&e=".str_replace("#","",$var02).") repeat-x;\">
<font color=$var03 style=\"font-size:".($main_font_size+4)."pt;\">$var04</font>
</div>";
}

echo "<div class=\"content\">$var00</div>
<div class=clear></div></div>
";
}
}
}
} else {
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
$cv03="$var03";

//if ($var06==0) {$bgi="";} else { $bgi=" background=\"styles/" . substr($var02, 1) . "/bgr.gif\"";}


//brightnes of background
$brightness=40;

$rrr= (hexdec ("0x" . substr($var02,1,2))) + $brightness;
$ggg= (hexdec ("0x" . substr($var02,3,2))) + $brightness;
$bbb= (hexdec ("0x" . substr($var02,5,2))) + $brightness;
if ($rrr>255): $rrr="255"; endif;
if ($ggg>255): $ggg="255"; endif;
if ($bbb>255): $bbb="255"; endif;
$cv02="#" . dechex($rrr). dechex($ggg). dechex($bbb);

$brightness=60;

$rrr= (hexdec ("0x" . substr($var03,1,2))) + $brightness;
$ggg= (hexdec ("0x" . substr($var03,3,2))) + $brightness;
$bbb= (hexdec ("0x" . substr($var03,5,2))) + $brightness;
if ($rrr>255): $rrr="255"; endif;
if ($ggg>255): $ggg="255"; endif;
if ($bbb>255): $bbb="255"; endif;
$cv03="#" . dechex($rrr). dechex($ggg). dechex($bbb);

if ((strtolower($var03)=="$nc0")){$cv03=$nc0; } else {$vvar3=$var03;$var03=$cv03; $cv03=$vvar3;}
if ($var05==0) { $cv03=$var03;}
$style="";
if ($var05!="noshadow"){  $style=" class=shadow"; }
if ($var04!=""){
echo "<div".$style."><div style=\"background: #$var02 url(grad.php?h=24&w=1&e=".str_replace("#","",$cv02)."&s=".str_replace("#","",$var02)."&d=vertical); background-repeat: repeat-x\">
<font color=\"".lighter($nc0,30)."\"><b>$carat $var04</b></font></div>";
} else {
echo "$var04";
}

echo "<div class=content>
$var00
</div></div>";
}
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
$zag = "<a class=\"btn btn-large btn-primary\" onclick=\"$link\"><i class=\"icon-shopping-cart icon-white\"></i> <font color=#ffffff>".$lang['buy']."</font></a>"; return $zag;
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
$zag = "<a class=\"btn btn-large btn-primary\" onclick=\"$onclick\"><i class=\"icon-shopping-cart icon-white\"></i> <font color=#ffffff>".$lang['buy']."</font></a>"; return $zag;
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
$zag = "<table cellpadding=0 cellspacing=0 border=0><tr><td><table background=\"grad.php?h=28&w=1&e=".str_replace("#","",$nc3)."&s=".str_replace("#","",lighter($nc3,20))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$nc3\" height=28><tr><td valign=bottom style=\"vertical-align:bottom\" style=\"white-space: nowrap;\"><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom></td>
<td align=\"center\" style=\"vertical-align:middle\"><b><font color=$nc0>$carat</font></b></td><td><img src=\"$image_path/pix.gif\" width=4 height=4 border=0></td><td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=center width=100% style=\"vertical-align:middle\"><img src=\"$image_path/pix.gif\" width=7 height=1 border=0>$link<img src=\"$image_path/pix.gif\" width=7 height=1 border=0></td></tr></table></td><td background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical\" align=right style=\"vertical-align:top\"><img src=\"$image_path/pix.gif\" width=4 height=1 border=0 style=\"background-color: $color_back\"><br><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\"><br><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\"></td></tr></table>"; return $zag;
}
}

function navbut ($var_text, $color_but,$color_light,$color_back, $no=FALSE) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $nc5;
global $nc0;
global $nc7;
global $nc8;
global $gd;
global $carat;
global $catbut_css_style;
global $bheight;
global $chevron;
$urlt=str_replace("\"", "",str_replace("'", "", str_replace(">", " ",str_replace("<", " ",$var_text))));
//echo $urlt;
$urm=explode(" href=", $urlt);
$urm1=strtoken($urm[1], " ");
$firstl=substr($urm1,0,4);
if ($catbut_css_style==0) {

if ($firstl=="http"){ $no=TRUE; }
if (($firstl=="http")||($firstl=="inde")) {$lochref=" onclick=\"javascript:document.location.href='$urm1';\" "; $widths="width:100%; "; $cursor="cursor: pointer; cursor: hand; ";} else {$lochref=" "; $cursor=""; $widths="";}
if ($no==FALSE) {  $cursor.="padding: 6px 6px 6px 3px; "; }
$zag= "<div class=\"nowrap onavi4 dropdown-submenu\""."$lochref"."style=\"$cursor"."background-image: url('grad.php?h=".($bheight+18)."&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical'); background-color: $color_but; align:center;\" align=center><span class=nowrap>";
if ($no==FALSE) {
$zag .= "$chevron&nbsp;";
}
$zag .= "$var_text";
if ($no==FALSE) {
$zag .= "<img src=images/pix.gif border=0 width=10 height=1>";
}
//if ($no==FALSE) {
//$zag .= "<span><img src=\"$image_path/pix.gif\" width=6 height=6 border=0></span>";
//}
$zag .= "</span></div>";
} else {
if ($firstl=="http"){ $no=TRUE; }
if (($firstl=="http")||($firstl=="inde")) {$lochref=" onclick=\"javascript:document.location.href='$urm1';\" "; $widths="width:100%; "; $cursor="cursor: pointer; cursor: hand; ";} else {$lochref=" "; $cursor=""; $widths="";}
if ($no==FALSE) {  $cursor.="padding: 6px 6px 6px 3px; "; }
$zag= "<div class=\"nowrap onavi4d dropdown-submenu\""."$lochref"."style=\"$cursor"."align:center;\" align=center><span class=nowrap>";
if ($no==FALSE) {
$zag .= "$chevron&nbsp;";
}  else { $zag .= "<img src=images/pix.gif border=0 width=1 height=22 align=absmiddle>";  }
$zag .= "$var_text";
if ($no==FALSE) {
$zag .= "<img src=images/pix.gif border=0 width=10 height=1>";
}
//if ($no==FALSE) {
//$zag .= "<span><img src=\"$image_path/pix.gif\" width=6 height=6 border=0></span>";
//}
$zag .= "</span></div>";

}
return $zag;

}




function but ($var_text, $color_but,$color_light,$color_back) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
global $catbut_css_style;
$zag= "<table background=\"grad.php?h=28&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,$color_light))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 height=28><tr>
<td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td align=\"center\"><span style=\"white-space: nowrap;\">$var_text</span><br><img src=\"$image_path/pix.gif\" width=50 height=1 border=0></td><td><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td><td valign=top style=\"white-space: nowrap;\"><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=top></td>
<td style=\"background-color: $color_back\"><img src=\"$image_path/pix.gif\" border=0 width=1 height=1></td></tr></table>"; return $zag;
}

function navbut2 ($var_text, $color_but,$color_light,$color_back) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
global $catbut_css_style;
global $bheight;
$urlt=str_replace("\"", "",str_replace("'", "", str_replace(">", " ",str_replace("<", " ",$var_text))));
//echo $urlt;
$urm=explode(" href=", $urlt);
$urm1=strtoken($urm[1], " ");
$firstl=substr($urm1,0,4);
if (($firstl=="http")||($firstl=="inde")) {$lochref=" onclick=\"javascript:document.location.href='$urm1';\" "; $widths="width:100%; "; $cursor="cursor: pointer; cursor: hand; ";} else {$lochref=" "; $cursor=""; $widths="";}
$zag= "<table border=0 cellpadding=0 cellspacing=0><tr><td valign=top><div class=onavi2"."$lochref"."style=\"$cursor"."$widths"."background-image: url('grad.php?h=".($bheight+18)."&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,$color_light))."&d=vertical'); background-color: $color_but;\"><table width=100% border=0 cellpadding=0 cellspacing=0><tr>";
$zag .= "<td><img src=$image_path/pix.gif height=28 width=10></td><td align=center style=\"white-space: nowrap;\">$var_text</td><td><img src=$image_path/pix.gif height=28 width=10></td>";
$zag .= "</tr></table></div></td><td><img src=$image_path/pix.gif height=35 width=4></td></tr></table>"; return $zag;
}
function navbut3 ($var_text, $color_but,$color_light,$color_back, $no=FALSE) {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $gd;
global $carat;
global $catbut_css_style;
global $bheight;
$zag = "<table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td><table background=\"grad.php?h=".($bheight+18)."&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,$color_light))."&d=vertical\" border=0 cellpadding=0 cellspacing=0 bgcolor=\"$color_but\" height=28 width=100%><tr><td valign=bottom style=\"white-space: nowrap;\"><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom></td>
<td align=\"center\" width=100% style=\"white-space: nowrap;\"><b>$var_text</b></td><td valign=bottom style=\"white-space: nowrap;\"><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $color_back\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $color_back\" align=bottom></td></tr></table></td><td><img src=\"$image_path/pix.gif\" width=1 height=1 border=0></td></tr></table>"; return $zag;
}

function navbut4 ($var_text, $color_but,$color_light,$color_back, $no=FALSE, $inside="") {
$var_text=trim(str_replace("\n","",$var_text));
global $image_path;
global $nc2;
global $nc5;
global $nc0;
global $nc7;
global $nc8;
global $nc9;
global $gd;
global $carat;
global $catbut_css_style;
global $bheight;
global $use_top_submenu;
global $chevron;
$urlt=str_replace("\"", "",str_replace("'", "", str_replace(">", " ",str_replace("<", " ",$var_text))));
//echo $urlt;
$urm=explode(" href=", $urlt);
$urm1=strtoken($urm[1], " ");
$firstl=substr($urm1,0,4);

if ($catbut_css_style==0) {

if (($firstl=="http")||($firstl=="inde")) {$lochref=" onclick=\"javascript:document.location.href='$urm1';\" "; $widths="width:100%; "; $cursor="cursor: pointer; cursor: hand; ";} else {$lochref=" "; $cursor=""; $widths="";}
if ($firstl=="#"){ $no=TRUE;} else { $cursor.="padding: 6px 6px 6px 3px; "; }
if ($inside=="") {
$zag= "<div class=\"nowrap onavi4 dropdown-submenu\""."$lochref"."style=\"$cursor"."background-image: url('grad.php?h=".($bheight+18)."&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical'); background-color: $color_but; align:center;\" align=center><span class=nowrap>";
if ($no==FALSE) {
$zag .= "$chevron&nbsp;";
}
$zag .= "$var_text";
if ($no==FALSE) {
$zag .= "<img src=images/pix.gif border=0 width=10 height=1>";
}
//if ($no==FALSE) {
//$zag .= "<span><img src=\"$image_path/pix.gif\" width=6 height=6 border=0></span>";
//}
$zag .= "</span></div>";
} else {
$zag= "<div class=\"nowrap onavi4 dropdown-submenu\""."$lochref"."style=\"$cursor"."background-image: url('grad.php?h=".($bheight+18)."&w=1&e=".str_replace("#","",$color_but)."&s=".str_replace("#","",lighter($color_but,20))."&d=vertical'); background-color: $color_but;\" role=\"menu\" aria-labelledby=\"dropdownMenu\"><span tabindex=\"-1\" class=nowrap>";
$zag .= "$chevron&nbsp;";
$zag .= "$var_text";
$zag .= "<img src=images/pix.gif border=0 width=10 height=1>";

//if ($no==FALSE) {
//$zag .= "<span><img src=\"$image_path/pix.gif\" width=6 height=6 border=0></span>";
//}
$zag .= "</span><ul class=\"dropdown-menu\" style=\"align:left; position: absolute; left: 0px; top: inherit; margin-top:6px;\" align=left>".$inside."</ul></div>";
}
} else {
if (($firstl=="http")||($firstl=="inde")) {$lochref=" onclick=\"javascript:document.location.href='$urm1';\" "; $widths="width:100%; "; $cursor="cursor: pointer; cursor: hand; ";} else {$lochref=" "; $cursor=""; $widths="";}
if ($firstl=="#"){ $no=TRUE;} else { $cursor.="padding: 6px 6px 6px 3px; "; }
if ($inside=="") {
$zag= "<div class=\"nowrap onavi4d dropdown-submenu\""."$lochref"."style=\"$cursor"."align:center;\" align=center><span class=nowrap>";
if ($no==FALSE) {
$zag .= "$chevron&nbsp;";
}
$zag .= "$var_text";
if ($no==FALSE) {
$zag .= "<img src=images/pix.gif border=0 width=10 height=1>";
}
//if ($no==FALSE) {
//$zag .= "<span><img src=\"$image_path/pix.gif\" width=6 height=6 border=0></span>";
//}
$zag .= "</span></div>";
} else {
$zag= "<div class=\"nowrap onavi4d dropdown-submenu\""."$lochref"."style=\"$cursor"."\" role=\"menu\" aria-labelledby=\"dropdownMenu\"><span tabindex=\"-1\" class=nowrap>";
$zag .= "$chevron&nbsp;";
$zag .= str_replace($nc5,$nc9, "$var_text");
$zag .= "<img src=images/pix.gif border=0 width=10 height=1>";

//if ($no==FALSE) {
//$zag .= "<span><img src=\"$image_path/pix.gif\" width=6 height=6 border=0></span>";
//}
$zag .= "</span><ul class=\"dropdown-menu\" style=\"align:left; position: absolute; left: 0px; top: inherit; margin-top:6px;\" align=left>".$inside."</ul></div>";
}
}
return $zag;
}



function trow ($var04, $var00) {
global $image_path;
global $nc6;
global $nc0;
global $gd;
global $carat;
if ($var00==""): return; endif;

echo "<tr><td><img src=\"images/x.gif\" border=\"0\" height=\"10\" width=\"10\"></td></tr>
<tr><td>
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
<td class=\"rightside-highlight-body\">$var00</td>
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
