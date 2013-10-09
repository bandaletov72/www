<?php

if ((is_dir ("./admin/userstat/".@$details[1])==TRUE)&&(substr(@$details[1],0,3)!="vip")) {

$handle=opendir("./admin/userstat/".@$details[1]);
$userstats="";

$userstatr=Array();
while (($files = readdir($handle))!==FALSE) {
if (($files == '.') || ($files == '..')||(substr($files,-4) == '.res')||(substr($files,-4) == '.htm')||($files == 'lastvisit.url')||($files == 'lastvisit.time')||(substr($files,-4) == '.ava')||($files == 'wishlist.txt')|| ($files == 'flag.txt')|| ($files == 'user.basket')) {

if ($files == 'wishlist.txt') {
$complexz.= "<br><br><small><a href='index.php?zak=wishlist'><b>".$lang[240]."</b> ".date("d.m.y H:i", filemtime("./admin/userstat/".@$details[1]."/$files"))."</a></small>\n";
}
if ($files == 'flag.txt') {
if (($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/flag.txt")==TRUE)&&(isset($_SESSION["wishpass"]))&&(@$_SESSION["wishpass"]==@$details[$user_pass_complex])&&(substr(@$details[1],0,3)!="vip")) { } else {
$complexz.= "<br><br><small><font color=$nc2><b>".$lang[241]."</b><br>".$lang[242]."</font></small>\n";
}
}
continue;
} else {

if (@file_exists("./admin/orderstatus/$files")==FALSE) {
$zakstatus="<b>".$lang[243]."</b>";
} else {
$file = fopen ("./admin/orderstatus/$files", "r");
$zakstatus="<b>".@fread ($file, @filesize("./admin/orderstatus/$files"))."</b> ";
fclose ($file);
}

$checkoutf="./admin/orderstatus/".str_replace(".txt", "", $files).".htm";
$oplat="";
if (@file_exists("$checkoutf")==TRUE) {
$fileoplat = fopen ("$checkoutf", "r");
$oplat="<br>".@fread($fileoplat, @filesize("$checkoutf"));
}
$userstatr[str_replace(".txt", "", $files)]= "<div class=round3><h4><a href='index.php?zak=".str_replace(".txt", "", $files)."'><b>".$lang[244]." #".str_replace(".txt", "", $files)."</b></a></h4><b>".$lang[371].":</b> <i>".date("d-m-Y H:i", filemtime("./admin/userstat/".@$details[1]."/$files"))."</i><br><br>$zakstatus$oplat</div><br>\n";

}
}
closedir ($handle);
}
@krsort($userstatr);
@reset($userstatr);
$fu=0;
while ((list ($wn, $wl) = @each ($userstatr))&&($fu<5)) {
$userstats.=$wl;
$fu+=1;
}
if ($fu>0) {
$userstats="<h4><font color=$nc2>".$lang[239]."</font></h4><br>$userstats";
}
?>