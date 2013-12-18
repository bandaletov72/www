<?php
//live module
$live_content="";
$live_content2="";
if (file_exists("$base_loc/last_events.txt")) {
unset($tmp,$tmp2,$k,$v);
$tmp=array_reverse(file("$base_loc/last_events.txt"));
while(list($k,$v)=each($tmp)) {
if (trim(trim($v))!="") {
$tmp2=@explode("|",$v);
if ($i_live==1) {
$live_content.="<div class=\"pull-left mr\"><a href=".$tmp2[1]." title=\"".$tmp2[3]."\">".$tmp2[4]."</a>";

} else {
$live_content.="<h4 class=lnk style=\"margin-top:20px;\"><a href=".$tmp2[1].">".$tmp2[3]."</a></h4><div class=muted><i class=icon-calendar></i> ".date($dateformat,$tmp2[0])." / ".$tmp2[2]."</div><div class=pcont>".@$tmp2[5]."</div>";
}
}
}

if ($live_content!="") {
$live_content="<div align=left style=\"margin-top:20px;\"><h4>$lang[1651]</h4><hr>$live_content<div class=clearfix></div></div>";
}
}
if ($f_live==1) {
if (file_exists("$base_loc/last_fevents.txt")) {
unset($tmp,$tmp2,$k,$v);
$tmp=array_reverse(file("$base_loc/last_fevents.txt"));
while(list($k,$v)=each($tmp)) {
if (trim(trim($v))!="") {
$tmp2=@explode("|",$v);
$live_content2.="<h4 class=lnk style=\"margin-top:20px;\"><a href=".$tmp2[1].">".$tmp2[3]."</a></h4><div class=muted><i class=icon-calendar></i> ".date($dateformat." H:i",$tmp2[0])." / ".$tmp2[2]."</div><div class=pcont>".@$tmp2[5]."</div>";

}
}

if ($live_content2!="") {
$live_content2="<div align=left style=\"margin-top:20px;\"><h4>$lang[1652]</h4><hr>$live_content2<div class=clearfix></div></div>";
}
}


}
$live_content.=$live_content2;
?>
