<?php

$x0007="";
if ($query=="") {
if (("$catid"=="0")||("$catid"=="_")||("$catid"=="")) {
if (($item_id=="")&&($unifid=="")) {
if (($action!="forum")&&($action!="sendmail")) {
if ($mod!="admin"){
if (@file_exists("$base_loc/content/x0007.txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/x0007.txt" , "r");
$page_content = @fread($pageopen, @filesize("$base_loc/content/x0007.txt"));
if (preg_match("/==(.*)==/i", $page_content, $output)) {$page_title=$output[1];} else {$page_title = $lang[221];}fclose ($pageopen);
if (preg_match("/[map]/i", $page_content)) {

$tmp=file($base_file);
$map1=""; $map2=""; $map3="";
$area1=""; $area2=""; $area3="";
while(list($key,$val)=each($tmp)) {
if (trim($val)!="") {
$o=explode("|", $val);
$ims = @getimagesize("./images/map.png");
$x=$ims[0]; $y=$ims[1];
$lid=md5(@$o[3]." ID:".@$o[6]);
if ($o[1]=="Свободные к продаже") {
if (trim($o[20])!="") {

$area1.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[21]*$x/360-7-5-21).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x/2+$o[21]*$x/360-7+20-21).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">";
if ($o[21]<165) { $area1.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[21]*$x/360-7-5-21).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x+$x/2+$o[21]*$x/360-7+20-21).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">";}
if ($o[21]>165) { $area1.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[21]*$x/360-7-5-21-$x).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x/2+$o[21]*$x/360-7+20-21-$x).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">"; }


$map1.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1><img src=$image_path/pin2.png border=0> <b>$o[3]</b></a><br><small>$o[7]</small></div>";
}
}
if ($o[1]=="Зарезервированные") {
if (trim($o[20])!="") {
$area2.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[21]*$x/360-7-5-21).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x/2+$o[21]*$x/360-7+20-21).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">\n";
if ($o[21]<165) { $area2.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[21]*$x/360-7-5-21).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x+$x/2+$o[21]*$x/360-7+20-21).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">";}
if ($o[21]>165) { $area2.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[21]*$x/360-7-5-21-$x).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x/2+$o[21]*$x/360-7+20-21-$x).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">"; }

$map2.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1><img src=$image_path/pin3.png border=0> <b>$o[3]</b></a><br><small>$o[7]</small></div>";
}
}
if ($o[1]=="Проданные") {
if (trim($o[20])!="") {
$area3.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[21]*$x/360-7-5-21).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x/2+$o[21]*$x/360-7+20-21).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">";
if ($o[21]<165) { $area3.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[21]*$x/360-7-5-21).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x+$x/2+$o[21]*$x/360-7+20-21).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">";}
if ($o[21]>165) { $area3.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[21]*$x/360-7-5-21-$x).", ".round($y/2-$o[20]*$y/180-$h+2-25).", ".round($x/2+$o[21]*$x/360-7+20-21-$x).", ".round($y/2-$o[20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." $defvalut\">"; }

$map3.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1><img src=$image_path/pingg.png border=0> <b>$o[3]</b></a><br><small>$o[7]</small></div>";
}
}
}
}
$page_content=str_replace("[map]", "<map name=\"mapmap\">$area1"."$area2"."$area3</map><img src=\"map.php?rnd=".md5(date("d.m.y H:i", time()))."\" width=$x height=$y border=0 class=one-edge-shadow  usemap=\"#mapmap\"><br><br>$map1"."$map2"."$map3<div class=clearfix></div>", $page_content);

}
$x0007= str_replace("==$page_title==", "" , $page_content);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$x0007="<div align=right style=\"margin-right: 60px;\"><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">x0007</span> <a class=\"btn\" href=#edit onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/x0007.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=btn href=\"index.php?page=z_$catid\">".$lang[1550]."</a>&nbsp;<a class=\"btn\" href=#del onClick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&amp;c=x0007&amp;del=x0007','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>".$x0007;
}
}
if ($x0007!="") {
$x0007="<div style=\"border: 0px;
background: ".$nc10.";
-moz-border-radius: 0px;
-webkit-border-radius: 0px;
border-radius: 0px;
padding: 5px 5px 5px 5px;
margin: 0px 0px 0px 0px;
-webkit-box-shadow: 0 0px 5px ".lighter($nc6,-20).";
-moz-box-shadow:0 0px 5px ".lighter($nc6,-20).";
box-shadow: 0 0px 5px ".lighter($nc6,-20).";
background-image: url('images/light.png'); background-repeat: no-repeat;\"><table style=\"width:$shwid\" align=center border=0><tr><td>$x0007</td></tr></table></div>";
}
unset ($page_content, $page_title, $pageopen);

}
}
}
}
} else {
if ($no_x0007==0) {
if ($catid_content!="") {
$x0007="<div style=\"border: 0px;
background: ".$nc10.";
-moz-border-radius: 0px;
-webkit-border-radius: 0px;
border-radius: 0px;
padding: 5px 5px 5px 5px;
margin: 0px 0px 0px 0px;
-webkit-box-shadow: 0 0px 5px ".lighter($nc6,-20).";
-moz-box-shadow:0 0px 5px ".lighter($nc6,-20).";
box-shadow: 0 0px 5px ".lighter($nc6,-20).";
background-image: url('images/light.png'); background-repeat: no-repeat;\"><table style=\"width:$shwid\" align=center border=0><tr><td>$catid_content</td></tr></table></div>";
}
if ($usetheme==0)  { $catid_content=""; $catid_title="";}
}
unset ($pageopen, $output);
//end



}
}

?>
