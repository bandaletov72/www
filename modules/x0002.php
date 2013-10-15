<?php
$h=0;
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
if ($fmap>0) {
$i20=20;
$i21=21;
$ncc=0;
$cc=file("./templates/$template/$speek/custom_cart.inc");

$dateformat=str_replace("y", "Y", str_replace("dd", "d",str_replace("mm", "m",str_replace("yy", "y", str_replace("yy", "y", $ewc_dateformat)))));

while(list($kc,$kv)=each($cc)) {
$out=explode("|", $kv);
if ($out[3]=="location") {
$ncc=17+$kc;

}

}

$tmp=file($base_file);
$map1=""; $map2=""; $map3="";
$area1=""; $area2=""; $area3="";
unset($kc,$kv,$out,$out2);
while(list($key,$val)=each($tmp)) {
if (trim($val)!="") {
$o=explode("|", $val);
unset($shirota,$dolgota,$dp,$day,$month,$year);
if ($ncc!=0) {
$tt=explode("<br>", $o[$ncc]);
while(list($kc,$kv)=each($tt)) {
if (trim ($kv)!="") {
$out2=explode(";",$kv);
list($day,$month,$year) = explode(substr($dateformat,1,1),$out2[0]);
$unixtime=mktime(0, 0, 1, (int)$month, (int)$day, (int)$year);
$shirota[$unixtime]=(int)trim($out2[1]);
$dolgota[$unixtime]=(int)trim($out2[2]);
}
}
ksort ($shirota);
$sh=-1000;
$do=-1000;
$ls=-1000;
$ld=-1000;
$dp="";
unset($kc,$kv,$tt);
$ttime=time();
//echo $o[3]."<br>";
while(list($kc,$kv)=each($shirota)) {
//echo "$ttime>$kc ? $shirota[$kc] $dolgota[$kc]<br>";
if ($ttime>$kc) {
$o[$i20]=$kv;
$o[$i21]=$dolgota[$kc];
}
$ls=$kv;
$ld=$dolgota[$kc];
$dp=date($dateformat,$kc);
$ut=$kc;
}
}
if ($dp!="") {
$uut="";
if ($ttime>$ut) {$uut="<b><font color=green>Груз прибыл в порт прибытия (".@$o[39].")</font></b>";} else { $uut="<b>Груз в пути (порт прибытия: ".@$o[39].")</b><br>";}
$dp="Ориентировочная дата прибытия: $dp"."<br>$uut<br>";
}
$ims = @getimagesize("./images/map.png");
$x=$ims[0]; $y=$ims[1];
$lid=md5(@$o[3]." ID:".@$o[6]);


if ($o[1]=="Проданные") {
if (trim($o[$i20])!="") {
$area3.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\" onmouseover=\"ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"RestorePath();\">";
if ($o[$i21]<165) { $area3.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x+$x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\">";}
if ($o[$i21]>165) { $area3.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x/2+$o[$i21]*$x/360-7+20-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\">"; }

$map3.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1><img src=$image_path/pin.png border=0> <b>$o[3]</b></a><br><small>$o[7]<br>$dp<br></small></div>";
}
}

if ($o[1]=="В резерве") {
if (trim($o[$i20])!="") {
$area2.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\" onmouseover=\"ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"RestorePath();\">\n";
if ($o[$i21]<165) { $area2.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x+$x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\">";}
if ($o[$i21]>165) { $area2.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x/2+$o[$i21]*$x/360-7+20-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\">"; }

$map2.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1><img src=$image_path/pin3.png border=0> <b>$o[3]</b></a><br><small>$o[7]<br>$dp<br></small></div>";
}
}

if ($o[1]=="Свободные к продаже") {
if (trim($o[$i20])!="") {

$area1.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\" onmouseover=\"ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"RestorePath();\">";
if ($o[$i21]<165) { $area1.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x+$x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\">";}
if ($o[$i21]>165) { $area1.="<area href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h+2-25).", ".round($x/2+$o[$i21]*$x/360-7+20-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h)."\" title=\"$o[1]\n\n$o[3]\n".str_replace("\"", "'",str_replace("<br>", "\n", $o[7]))."\n\n".$o[4]." ".substr($o[12],1)."\">"; }


$map1.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1><img src=$image_path/pin2.png border=0> <b>$o[3]</b></a><br><small>$o[7]<br>$dp<br></small></div>";
}
}


}
}
if ($fmap==1) {
$page_content=str_replace("[map]", "<script language=javascript>
function RestorePath() {
document.getElementById('mapp').src='map.php?rnd=".md5(date("d.m.y H:i", time()))."';
}
function ShowPath(id) {
document.getElementById('mapp').src='map.php?rnd=".md5(date("d.m.y H:i", time()))."&id='+id;
}
</script><map name=\"mapmap\">$area1"."$area2"."$area3</map><img id=mapp src=\"map.php?rnd=".md5(date("d.m.y H:i", time()))."\" width=$x height=$y border=0 class=one-edge-shadow usemap=\"#mapmap\"><br><br>$map1"."$map2"."$map3<div class=clearfix></div>", $page_content);
} else {
$themecontent=str_replace("[map]", "<script language=javascript>
function RestorePath() {
document.getElementById('mapp').src='map.php?rnd=".md5(date("d.m.y H:i", time()))."';
}
function ShowPath(id) {
document.getElementById('mapp').src='map.php?rnd=".md5(date("d.m.y H:i", time()))."&id='+id;
}
</script><map name=\"mapmap\">$area1"."$area2"."$area3</map><img id=mapp src=\"map.php?rnd=".md5(date("d.m.y H:i", time()))."\" width=$x height=$y border=0 class=one-edge-shadow usemap=\"#mapmap\"><br><br>$map1"."$map2"."$map3<div class=clearfix></div>", $themecontent);


}
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")):$page_content = "<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">x0002</span> <a class=\"btn\" href=#edit onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/x0002.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=\"btn\" href=#del onClick=javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=x0002&del=x0002','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>$page_content"; endif;}
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
