<?php
$vd=1;
$dir_cont="";
if (isset($_GET['b'])) { $b=$_GET['b']; } elseif(isset($_POST['b'])) { $b=$_POST['b']; } else { $b=0; }
if ($view_itemsmenu_page==0) {if ($page!="") { $vd=0; } }
if ($vd==1) {
if (!preg_match('/^[0-9]+$/i',$b)) { $b=0;}
if (($style['dirs_v']==1)){
$dirs = fopen ("$base_loc/dirs.txt" , "r");
if ($dirvar==1) {
if ($repcatid!="") {
$dir_cont= str_replace("$repcatid\" style=\"color:".$nc4."\"", "$repcatid\" style=\"color:".$nc0."; font-weight: bold; text-decoration:underline; background-color: $nc4;\"", str_replace( $onc9, $nc9, (@fread ($dirs, @filesize ("$base_loc/dirs.txt")))));
} else {
$dir_cont= @fread ($dirs, @filesize ("$base_loc/dirs.txt"));
}
if ($repzeme!="") {$dir_cont=str_replace("$repzeme","themes/$repzeme",$dir_cont);}
fclose ($dirs);
$dir_cont=$dir_cont;
}

//variant1
if ($dirvar==2) {

@natcasesort ($mysql_dirs);
@reset ($mysql_dirs);
@natcasesort ($mysql_subdirs);
@reset ($mysql_subdirs);
while(list($mk,$mv)=@each($mysql_dirs)) {
//echo "$mk,$mv<br>";
$curcatid=translit("$mk");
if ($colordirs["$mk"]=="") {$fillc=$nc4;} else {$fillc=$colordirs["$mk"];}
if ($curcatid!="all") {
if (($catid==$curcatid)&&($catid!="_")&&($catid!="")) {
$dir_cont.="<br><div class=round2><h4 style=\"font-size: ".($main_font_size+0)."pt; line-height: 1.1em; margin: 0pt;\"><img src=\"$image_path/pix.gif\" style=\"background-color: ".$fillc.";\" height=\"8\" border=\"0\" width=\"8\">&nbsp;<a href=\"index.php?catid=".$curcatid."\"><font color=".$fillc.">$mk</font></a></h4></div>";
} else {
$dir_cont.="<br><h4 onclick=\"location.href='index.php?catid=".$curcatid."';\" class=lcat1 style=\"margin: 0pt;\"><img src=\"$image_path/pix.gif\" style=\"background-color: ".$fillc.";\" height=\"8\" border=\"0\" width=\"8\">&nbsp;<a href=\"index.php?catid=".$curcatid."\">$mk</a></h4>";
}
}
@reset ($mysql_subdirs[$mk]);
@natcasesort ($mysql_subdirs[$mk]);
while(list($msubk,$msubv)=@each($mysql_subdirs[$mk])) {
$curcatid=translit("$mk $msubk ");
if ($mk!="All") {
if (($catid==$curcatid)&&($catid!="_")&&($catid!="")) {
$dir_cont.="<div class=round2><font color=".$fillc."><b>$carat</b></font>&nbsp;<a href=\"index.php?catid=".$curcatid."\">$msubk</a></div>";
} else {
$dir_cont.="<div style=\"cursor:pointer; cursor:hand; font-style:normal;\" onclick=\"location.href='index.php?catid=".$curcatid."';\" class=lcat1><font color=".$fillc."><b>$carat</b></font>&nbsp;<a href=\"index.php?catid=".$curcatid."\">$msubk</a></div>";
}
} else {
if ($colordirs["$mk $msubk "]=="") {$fillc=$nc4;} else {$fillc=$colordirs["$mk $msubk "];}
//echo "\"$mk $msubk \"=".$colordirs["$mk $msubk "]."<br>";
if (($catid==$curcatid)&&($catid!="_")&&($catid!="")) {
$dir_cont.="<br><div class=round2><h4 style=\"font-size: ".($main_font_size+0)."pt; line-height: 1.1em; margin: 0pt;\"><img src=\"$image_path/pix.gif\" style=\"background-color: ".$fillc.";\" height=\"8\" border=\"0\" width=\"8\">&nbsp;<a href=\"index.php?catid=".$curcatid."\"><font color=".$fillc.">$msubk</font></a></h4></div>";
} else {
$dir_cont.="<br><div style=\"cursor:pointer; cursor:hand; font-style:normal;\" onclick=\"location.href='index.php?catid=".$curcatid."';\" onMouseOver=\"this.style.backgroundColor='$nc6';\" onMouseOut=\"this.style.backgroundColor='';\"><h4 style=\"font-size: ".($main_font_size+0)."pt; line-height: 1.1em; margin: 0pt;\"><img src=\"$image_path/pix.gif\" style=\"background-color: ".$fillc.";\" height=\"8\" border=\"0\" width=\"8\">&nbsp;<a href=\"index.php?catid=".$curcatid."\"><font color=".$fillc.">$msubk</font></a></h4></div>";
}
}
}
}
$dir_cont=substr($dir_cont,4,strlen($dir_cont));
}
/*
reset($colordirs);
while(list($msubk,$msubv)=@each($colordirs)) {
echo "$msubk,$msubv<br>";
}
*/


if ($dirvar==3) {
$dir_conts=Array();
$dir_cont="";
$to_disable=Array();
$mysql_dirs2=$mysql_dirs;
$mysql_subdirs2=$mysql_subdirs;
@natcasesort ($mysql_dirs);
@reset ($mysql_dirs);
@natcasesort ($mysql_subdirs);
@reset ($mysql_subdirs);
while(list($mk,$mv)=@each($mysql_dirs)) {
$curcatid=translit("$mk");
if (!isset($dir_conts["$mk"])) {$dir_conts["$mk"]="";}
if ($colordirs["$mk"]=="") {$fillc=$nc4;} else {$fillc=$colordirs["$mk"];}
if (($catid==$curcatid)&&($catid!="_")&&($catid!="")) {
$dir_conts["$mk"].="<br><div class=round2><h4 style=\"font-size: ".($main_font_size+0)."pt; line-height: 1.1em; margin: 0pt;\"><img src=\"$image_path/pix.gif\" style=\"background-color: ".$fillc.";\" height=\"8\" border=\"0\" width=\"8\">&nbsp;<a href=\"index.php?catid=".$curcatid."\"><font color=".$fillc.">$mk</font></a></h4></div>";
} else {
$dir_conts["$mk"].="<br><div style=\"cursor:pointer; cursor:hand; font-style:normal;\" onclick=\"location.href='index.php?catid=".$curcatid."';\" class=lcat1><h4 style=\"font-size: ".($main_font_size+0)."pt; line-height: 1.1em; margin: 0pt;\"><img src=\"$image_path/pix.gif\" style=\"background-color: ".$fillc.";\" height=\"8\" border=\"0\" width=\"8\">&nbsp;<a href=\"index.php?catid=".$curcatid."\"><font color=".$fillc.">$mk</font></a></h4></div>";
}
reset ($mysql_subdirs[$mk]);
natcasesort ($mysql_subdirs[$mk]);
while(list($msubk,$msubv)=each($mysql_subdirs[$mk])) {
$curcatid=translit("$mk $msubk ");
if (($catid==$curcatid)&&($catid!="_")&&($catid!="")) {
$dir_conts["$mk"].="<div class=round2><font color=".$fillc."><b>$carat</b></font>&nbsp;<a href=\"index.php?catid=".$curcatid."\">$msubk</a></div>";
} else {
$dir_conts["$mk"].="<div style=\"cursor:pointer; cursor:hand; font-style:normal;\" onclick=\"location.href='index.php?catid=".$curcatid."';\" class=lcat1><font color=".$fillc."><b>$carat</b></font>&nbsp;<a href=\"index.php?catid=".$curcatid."\">$msubk</a></div>";
}
if (isset($mysql_subdirs2[$msubk])) {
//echo $mysql_subdirs2[$msubk];
natcasesort ($mysql_subdirs2[$msubk]);
reset($mysql_subdirs2[$msubk]);
while(list($msubk2,$msubv2)=each($mysql_subdirs2[$msubk])) {
$curcatid=translit("$msubk $msubk2 ");
if (($catid==$curcatid)&&($catid!="_")&&($catid!="")) {
$dir_conts["$mk"].="<div class=round2 style=\"margin-left: 10px;\"<font color=".$fillc."><b>$carat</b></font>&nbsp;<a href=\"index.php?catid=".$curcatid."\">$msubk2</a></div>";
} else {
$dir_conts["$mk"].="<div style=\"cursor:pointer; cursor:hand; font-style:normal; margin-left: 10px;\" onclick=\"location.href='index.php?catid=".$curcatid."';\" class=lcat1><font color=".$fillc."><b>$carat</b></font>&nbsp;<a href=\"index.php?catid=".$curcatid."\">$msubk2</a></div>";
}
$to_disable[$msubk]=1;
}
}


}
}
while(list($mk,$mv)=each($dir_conts)) {
if (!isset($to_disable[$mk])) {
$dir_cont.=$mv;
}
}
$dir_cont=substr($dir_cont,4,strlen($dir_cont));
}


//twitter bootstrap menu  left
if ($dirvar==4) {
$dir_conts=Array();
$dir_cont="";
$to_disable=Array();
$mysql_dirs2=$mysql_dirs;
$mysql_subdirs2=$mysql_subdirs;
@natcasesort ($mysql_dirs);
@reset ($mysql_dirs);
@natcasesort ($mysql_subdirs);
@reset ($mysql_subdirs);
$z=0;
$trr=translit($r);
$trs=translit($sub);
while(list($mk,$mv)=@each($mysql_dirs)) {
$curcatid=translit("$mk");

$curr=$curcatid;
if (!isset($dir_conts["$mk"])) {$dir_conts["$mk"]="";}
if ($colordirs["$mk"]=="") {$fillc=$nc4;} else {$fillc=$colordirs["$mk"];}
$z++;
if ($trr=="$curcatid") {
$dir_conts["$mk"].="<div style=\"width:100%\"><div class=\"lcat1 underlined\" style=\" style=\"border-bottom: 1px $nc6 dotted; padding-top:8px; padding-bottom: 8px;\" align=left><i class=\"icon-chevron-down pull-right\"></i><a href=\"index.php?catid=".$curcatid."\"><b>$mk</b></a></div>
<div class=\"submenu\">";
} else {
$dir_conts["$mk"].="<div class=\"dropdown-submenu\" role=\"menu\" aria-labelledby=\"dropdownMenu\" style=\"width:100%\"><div tabindex=\"-1\" href=\"#\" class=lcat1 style=\"border-bottom: 1px $nc6 dotted; padding-top:8px; padding-bottom:8px;\" align=left><i class=\"icon-chevron-right icon-white pull-right\"></i><a href=\"index.php?catid=".$curcatid."\"><b>$mk</b></a></div>
<div class=\"dropdown-menu\" style=\"white-space:normal; margin-top:-1px;\">";
}
reset ($mysql_subdirs[$mk]);
natcasesort ($mysql_subdirs[$mk]);
while(list($msubk,$msubv)=each($mysql_subdirs[$mk])) {
$curcatid=translit("$mk $msubk ");
$trsub=translit("$msubk");
if ($trr==$curr) {
if ($trs==$trsub) {
$dir_conts["$mk"].="
<div class=\"lcat1\" onclick=\"document.location.href='index.php?catid=".$curcatid."';\"><a href=\"index.php?catid=".$curcatid."\"><b>$msubk</b></a></div>";

} else {
$dir_conts["$mk"].="
<div class=lcat1 onclick=\"document.location.href='index.php?catid=".$curcatid."';\"><a href=\"index.php?catid=".$curcatid."\">$msubk</a></div>";
}
} else {
$dir_conts["$mk"].="
<li><a tabindex=\"-1\" href=\"index.php?catid=".$curcatid."\">".wordwrap($msubk,30,"<br>")."</a></li>";
}
if (isset($mysql_subdirs2[$msubk])) {
//echo $mysql_subdirs2[$msubk];
natcasesort ($mysql_subdirs2[$msubk]);
reset($mysql_subdirs2[$msubk]);
while(list($msubk2,$msubv2)=each($mysql_subdirs2[$msubk])) {
$curcatid=translit("$msubk $msubk2 ");
if ($trr==$curr) {
$dir_conts["$mk"].="
<div class=lcat1 onclick=\"document.location.href='index.php?catid=".$curcatid."';\"><a href=\"index.php?catid=".$curcatid."\">$msubk2</a></div>";
} else {
$dir_conts["$mk"].="
<li><a tabindex=\"-1\" href=\"index.php?catid=".$curcatid."\">".wordwrap($msubk2,30,"<br>")."</a></li>";
}
$to_disable[$msubk]=1;
}
}


}
}
while(list($mk,$mv)=each($dir_conts)) {
if (!isset($to_disable[$mk])) {
$dir_cont.="$mv"."
</div>
</div>
";
}
}
$dir_cont="
<div class=\"dropdown clearfix\">

$dir_cont

</div>
<div class=clear></div>
";
}

//Right menu
if ($dirvar==5) {
$dir_conts=Array();
$dir_cont="";
$to_disable=Array();
$mysql_dirs2=$mysql_dirs;
$mysql_subdirs2=$mysql_subdirs;
@natcasesort ($mysql_dirs);
@reset ($mysql_dirs);
@natcasesort ($mysql_subdirs);
@reset ($mysql_subdirs);
$z=0;
$trr=translit($r);
$trs=translit($sub);
while(list($mk,$mv)=@each($mysql_dirs)) {
$curcatid=translit("$mk");

$curr=$curcatid;
if (!isset($dir_conts["$mk"])) {$dir_conts["$mk"]="";}
if ($colordirs["$mk"]=="") {$fillc=$nc4;} else {$fillc=$colordirs["$mk"];}
$z++;
if ($trr=="$curcatid") {
$dir_conts["$mk"].="<div style=\"width:100%\"><div class=\"lcat1 underlined\" style=\"border-bottom: 1px $nc6 dotted; padding-top:8px; padding-bottom: 8px;\" align=right><i class=\"icon-chevron-down pull-left\"></i><span class=pull-right><a href=\"index.php?catid=".$curcatid."\"><b>$mk</b></a></span><span class=clearfix></span></div>
<div class=\"submenu\">";
} else {
$dir_conts["$mk"].="<div class=\"dropdown-submenu pull-left\" role=\"menu\" aria-labelledby=\"dropdownMenu\" style=\"width:100%\"><div tabindex=\"-1\" href=\"#\" class=lcat1 style=\"border-bottom: 1px $nc6 dotted; padding-top:8px; padding-bottom: 8px;\" align=right><i class=\"icon-chevron-left icon-white pull-left\"></i><span class=pull-right><a href=\"index.php?catid=".$curcatid."\"><b>$mk</b></a></span><span class=clearfix></span></div>
<div class=\"dropdown-menu pull-right clearfix\" style=\"white-space:normal; margin-right: ".$style['right_width']."px; margin-top:-1px;\">";
}
reset ($mysql_subdirs[$mk]);
natcasesort ($mysql_subdirs[$mk]);
while(list($msubk,$msubv)=each($mysql_subdirs[$mk])) {
$curcatid=translit("$mk $msubk ");
$trsub=translit("$msubk");
if ($trr==$curr) {
if ($trs==$trsub) {
$dir_conts["$mk"].="
<div class=\"lcat1\" onclick=\"document.location.href='index.php?catid=".$curcatid."';\" align=right><span class=pull-right><a href=\"index.php?catid=".$curcatid."\"><b>$msubk</b></a></span><span class=clearfix></span></div>";

} else {
$dir_conts["$mk"].="
<div class=lcat1 onclick=\"document.location.href='index.php?catid=".$curcatid."';\" align=right><span class=pull-right><a href=\"index.php?catid=".$curcatid."\">$msubk</a></span><span class=clearfix></span></div>";
}
} else {
$dir_conts["$mk"].="
<li><a tabindex=\"-1\" href=\"index.php?catid=".$curcatid."\">".wordwrap($msubk,30,"<br>")."</a></li>";
}
if (isset($mysql_subdirs2[$msubk])) {
//echo $mysql_subdirs2[$msubk];
natcasesort ($mysql_subdirs2[$msubk]);
reset($mysql_subdirs2[$msubk]);
while(list($msubk2,$msubv2)=each($mysql_subdirs2[$msubk])) {
$curcatid=translit("$msubk $msubk2 ");
if ($trr==$curr) {
$dir_conts["$mk"].="
<div class=lcat1 onclick=\"document.location.href='index.php?catid=".$curcatid."';\"><a href=\"index.php?catid=".$curcatid."\">$msubk2</a></div>";
} else {
$dir_conts["$mk"].="
<li><a tabindex=\"-1\" href=\"index.php?catid=".$curcatid."\">".wordwrap($msubk2,15,"<br>")."</a></li>";
}
$to_disable[$msubk]=1;
}
}


}
}
while(list($mk,$mv)=each($dir_conts)) {
if (!isset($to_disable[$mk])) {
$dir_cont.="$mv"."
</div>
</div>
";
}
}
$dir_cont="
<div class=\"dropdown clearfix\">

$dir_cont

</div>
<div class=clear></div>
";
}

//No submenu
if ($dirvar==6) {
$dir_conts=Array();
$dir_cont="";
$to_disable=Array();
$mysql_dirs2=$mysql_dirs;
$mysql_subdirs2=$mysql_subdirs;
@natcasesort ($mysql_dirs);
@reset ($mysql_dirs);
@natcasesort ($mysql_subdirs);
@reset ($mysql_subdirs);
$z=0;
$trr=translit($r);
$trs=translit($sub);
while(list($mk,$mv)=@each($mysql_dirs)) {
$curcatid=translit("$mk");

$curr=$curcatid;
if (!isset($dir_conts["$mk"])) {$dir_conts["$mk"]="";}
if ($colordirs["$mk"]=="") {$fillc=$nc4;} else {$fillc=$colordirs["$mk"];}
$z++;
if ($trr=="$curcatid") {
$dir_conts["$mk"].="<div style=\"width:100%\"><div class=\"lcat1 underlined\" style=\"border-bottom: 1px $nc6 dotted; padding-top:8px; padding-bottom: 8px;\" align=left><i class=\"icon-chevron-down pull-right\"></i><a href=\"index.php?catid=".$curcatid."\"><b>$mk</b></a></div>
<div class=\"submenu\">";
} else {
$dir_conts["$mk"].="<div style=\"width:100%\"><div onclick=\"document.location.href='index.php?catid=".$curcatid."';\" class=lcat1 style=\"border-bottom: 1px $nc6 dotted; padding-top:8px; padding-bottom:8px;\" align=left><i class=\"icon-chevron-right icon-white pull-right\"></i><a href=\"index.php?catid=".$curcatid."\"><b>$mk</b></a></div>
<div class=\"dropdown-menu\">";
}
reset ($mysql_subdirs[$mk]);
natcasesort ($mysql_subdirs[$mk]);
while(list($msubk,$msubv)=each($mysql_subdirs[$mk])) {
$curcatid=translit("$mk $msubk ");
$trsub=translit("$msubk");
if ($trr==$curr) {
if ($trs==$trsub) {
$dir_conts["$mk"].="
<div class=\"lcat1\" onclick=\"document.location.href='index.php?catid=".$curcatid."';\"><a href=\"index.php?catid=".$curcatid."\"><b>$msubk</b></a></div>";

} else {
$dir_conts["$mk"].="
<div class=lcat1 onclick=\"document.location.href='index.php?catid=".$curcatid."';\"><a href=\"index.php?catid=".$curcatid."\">$msubk</a></div>";
}
} else {
$dir_conts["$mk"].="
<li><a tabindex=\"-1\" href=\"index.php?catid=".$curcatid."\">$msubk</a></li>";
}
if (isset($mysql_subdirs2[$msubk])) {
//echo $mysql_subdirs2[$msubk];
natcasesort ($mysql_subdirs2[$msubk]);
reset($mysql_subdirs2[$msubk]);
while(list($msubk2,$msubv2)=each($mysql_subdirs2[$msubk])) {
$curcatid=translit("$msubk $msubk2 ");
if ($trr==$curr) {
$dir_conts["$mk"].="
<div class=lcat1 onclick=\"document.location.href='index.php?catid=".$curcatid."';\"><a href=\"index.php?catid=".$curcatid."\">$msubk2</a></div>";
} else {
$dir_conts["$mk"].="
<li><a tabindex=\"-1\" href=\"index.php?catid=".$curcatid."\">$msubk2</a></li>";
}
$to_disable[$msubk]=1;
}
}


}
}
while(list($mk,$mv)=each($dir_conts)) {
if (!isset($to_disable[$mk])) {
$dir_cont.="$mv"."
</div>
</div>
";
}
}
$dir_cont="
<div class=\"dropdown clearfix\">

$dir_cont

</div>
<div class=clear></div>
";
}

$cmenu_cont="";
if  ($allow_search==1) {$cmenu = fopen ("$base_loc/cmenu_index.txt" , "r");$cmenu_cont= (@fread ($cmenu, @filesize ("$base_loc/cmenu_index.txt")));fclose ($cmenu);if ($repzeme!="") {$cmenu_cont=str_replace("$repzeme","themes/$repzeme",$cmenu_cont);}}
$cmenu_cont=str_replace("<br><br>","", $cmenu_cont);
if ($b>0) {
$cmenu_cont=str_replace(" style=\"display: none;\" id=\"hdiv_".$b."\""," id=\"hdiv_".$b."\"", str_replace("id=\"himg_".$b."\" class=\"icon-chevron-right icon-white\"","id=\"himg_".$b."\" class=\"icon-chevron-down icon-white\"",$cmenu_cont));
$cmenu_cont=str_replace(" href=\"index.php?b=$b&query=$query", " style=\"font-weight:bold; background-color: ".$nc5.";\" href=\"index.php?b=$b&query=$query", $cmenu_cont);

}
if ($dirvar!=0) {
if ($view_dirs_j==0) {
if ($view_ndir==0) {
topwo ("", "<div align=left style=\"width: 96%; padding:5px;\" class=box3>".$dir_cont.$cmenu_cont."</div><br>", "100%", $nc10, $nc0, 2,0,"[categories]");
} else {
top ($lang['all_items'], "<div align=left style=\"width: 96%; padding:5px;\" class=box3>".$dir_cont.$cmenu_cont."</div><br>", "100%", $nc10, $nc0, 2,0,"[categories]");
}
}
}
}

if (($view_dirs_j==1)){
$dirs = fopen ("$base_loc/dirs_j.txt" , "r"); if ($repcatid!="") {$dir_cont=str_replace(" id=\"".@$podstava["$r||"]."\"><img src=\"$image_path/cat2.png\"", " id=\"".@$podstava["$r||"]."\"><img src=\"$image_path/cat2.png\"", str_replace( " style=\"display:None;\"><!-- ".@$podstava["$r||"]." -->", " style=\"display:inline;\"><!-- ".@$podstava["$r||"]." -->", str_replace("$repcatid\" style=\"color:".$nc4."\"", "$repcatid\" style=\"color:".$nc0."; font-weight: bold; text-decoration:underline; background-color: $nc4;\"",  str_replace( $onc9, $nc9,(@fread ($dirs, @filesize ("$base_loc/dirs_j.txt")))))));} else {$dir_cont= @fread ($dirs, @filesize ("$base_loc/dirs_j.txt"));}
fclose ($dirs);$cmenu_cont=""; if ($java_brands==1) { if ((substr($catid,-1)=="_")&&($catid!="_")) {$dir_cont.="<script language=javascript>
var d=document.getElementById('d_".$catid."');
if (d) {
d.style.display='inline';
d.style.visibility='visible';
}
var ids=document.getElementById('id_".$catid."');
if (ids) {
ids.className='icon-minus';
}
var s=document.getElementById('img".@$podstava["$r||"]."');
if (s) {
document.getElementById('img".@$podstava["$r||"]."').className='icon-chevron-down icon-white';
}
</script>";
if ($brand!="") {
$dir_cont=str_replace("<!--$brand-->&nbsp;&nbsp;","<span style=\"background-color: $nc6;\">&nbsp;",str_replace("$brand</font></a>", "$brand</font></a>&nbsp;&nbsp;</span>", $dir_cont));
}
}
}
if  ($allow_search==1) {
$cmenu = fopen ("$base_loc/cmenu_index.txt" , "r");
$cmenu_cont= (@fread ($cmenu, @filesize ("$base_loc/cmenu_index.txt")));
fclose ($cmenu);
if ($repzeme!="") {
$cmenu_cont=str_replace("$repzeme","themes/$repzeme",$cmenu_cont);
}
}
$cmenu_cont=str_replace("<br><br>","", $cmenu_cont);
if ($b>0) {
$cmenu_cont=str_replace(" style=\"display: none;\" id=\"hdiv_".$b."\""," id=\"hdiv_".$b."\"", str_replace("id=\"himg_".$b."\" class=\"icon-chevron-right icon-white\"","id=\"himg_".$b."\" class=\"icon-chevron-down icon-white\"",$cmenu_cont));
$cmenu_cont=str_replace(" href=\"index.php?b=$b&query=$query", " style=\"font-weight:bold; background-color: ".$nc5.";\" href=\"index.php?b=$b&query=$query", $cmenu_cont);
}
if ((trim($cmenu_cont)=="")||(trim($cmenu_cont)=="<br>")){ } else { $cmenu_cont= $cmenu_cont; }
if ($dirvar!=0) {
$ndir="<div class=onav2 style=\"margin: 10px 0px 0px 0px; background: url('"."$htpath/grad.php?h=150&w=20&s=".str_replace("#","",$nc10)."&e=".str_replace("#","",$nc10)."&d=vertical') repeat-x scroll 0% 0% $nc10; \" align=left><font size=3 color=$nc0><b>".$lang['all_items']."</b></font></div><div class=clear></div>";
if ($view_ndir==0) {$ndir="";}
if ($usetheme==1) {
topwo ("", "<div style=\"width: 96%;\" class=box3>$ndir<div align=left>".$dir_cont.$cmenu_cont."<img src=$image_path/pix.gif border=0 style=\"width:96%\" height=2></div></div>", "100%", $nc3, strtolower($style ['left_menu']), 2,0, "[categories]");
} else {
topwo ($lang['all_items'], "<div class=box3 style=\"width: 96%;\">$ndir<div align=left style=\"padding:5px;\">".$dir_cont.$cmenu_cont."<img src=$image_path/pix.gif border=0 style=\"width:96%\" height=2></div></div>", "100%", $nc3, strtolower($style ['left_menu']), 2,0, "[categories]");
}
}
}

if ($interface==1) {if (($valid=="1")&&($details[7]=="ADMIN")){ $oldval="dirvar";$strnum=199; $oldvalue=$$oldval; $admined="";
if ($$oldval==0) {

$modonoff="<input type=button onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."'\" value=\"".$lang[890]."\">";
$admined="<div align=center><font color=#b94a48>".$lang['all_items']." ".$lang[894]."</font></div><div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center>
<b>".$lang['all_items']."</b>
$modonoff<br><br>$lang[888]"."<br><br><a class=\"btn btn-primary\" onClick=\"javascript:window.open('admin/".$scriptprefix."new_item.php?speek=".$speek."&catid=".$catid."','fr0','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#newItem\"><i class=\"icon-plus icon-white\"></i> <font color=#ffffff>".$lang[875]."</font></a><br>
<br><br><a class=\"btn btn-success\" onClick=\"javascript:window.open('admin/currency_parser.php?speek=".$speek."','fr2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#CurrParser\"><i class=\"icon-globe icon-white\"></i> <font color=#ffffff>".$lang[1144]."</font></a>
<br><br><a class=\"btn btn-info\" onClick=\"javascript:window.open('admin/obmen.php?speek=".$speek."','fr3','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=820,height=560,left=10,top=10');\" href=\"#rassilka\"><i class=\"icon-envelope icon-white\"></i> <font color=#ffffff>".$lang[20]."</font></a>
</div>";
} else {
$modonoff="<input type=button onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."'\" value=\"".$lang[889]."\">";

$admined="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center><font color=$nc5>
<b>".$lang['all_items']."</b><br><br><div align=left>
$carat <a href=#varJa onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=3&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=1&en[131]=view_brands&nk[131]=NO&evo[131]=".$view_brands."&ev[131]=0"."'\">".$lang[886]."-1a</a> 'Java'<br><small>$lang[355] <b>".$mpz['off']."</b></small><br><br>
$carat <a href=#varJb onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=3&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=1&en[131]=view_brands&nk[131]=NO&evo[131]=".$view_brands."&ev[131]=1"."'\">".$lang[886]."-1b</a> 'Java'<br><small>$lang[355] <b>".$mpz['on']."</b></small><br><br>
$carat <a href=#var1a onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=0&en[131]=view_brands&nk[131]=NO&evo[131]=".$view_brands."&ev[131]=0'\">".$lang[886]."-2a</a> 'Old'<br><small>$lang[355] <b>".$mpz['off']."</b></small><br><br>
$carat <a href=#var1b onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=0&en[131]=view_brands&nk[131]=NO&evo[131]=".$view_brands."&ev[131]=1"."'\">".$lang[886]."-2b</a> 'Old'<br><small>$lang[355] <b>".$mpz['on']."</b></small><br><br>
$carat <a href=#var2 onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=2&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=0"."'\">".$lang[886]."-3</a> 'New'<br><small>$lang[355] <b>".$mpz['off']."</b></small><br><br>
$carat <a href=#var3 onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=3&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=0"."'\">".$lang[886]."-4</a> '3-level'<br><small>$lang[355] <b>".$mpz['off']."</b></small><br><br>
$carat <a href=#var4 onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=4&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=0&en[131]=view_brands&nk[131]=NO&evo[131]=".$view_brands."&ev[131]=0"."'\">".$lang[886]."-TB</a> 'Twitter Bootstrap LEFT MENU'<br><small>$lang[355] <b>".$mpz['off']."</b></small><br><br>
$carat <a href=#var4 onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=5&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=0&en[131]=view_brands&nk[131]=NO&evo[131]=".$view_brands."&ev[131]=0"."'\">".$lang[886]."-TB</a> 'Twitter Bootstrap RIGHT MENU'<br><small>$lang[355] <b>".$mpz['off']."</b></small><br><br>
$carat <a href=#var5 onclick=\"javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=6&en[130]=view_dirs_j&nk[130]=NO&evo[130]=".$view_dirs_j."&ev[130]=0&en[131]=view_brands&nk[131]=NO&evo[131]=".$view_brands."&ev[131]=0"."'\">".$lang[886]."-NS v.2</a> 'No sub. Main Categories only'<br><small>$lang[355] <b>".$mpz['off']."</b></small><br><br>
<br><b><font color=#b94a48>!</font></b> $lang[880]<br><br></small></div><br>$modonoff<br><br>$lang[888]</font>"."<br><br><a class=\"btn btn-primary\" onClick=\"javascript:window.open('admin/".$scriptprefix."new_item.php?speek=".$speek."&catid=".$catid."','fr0','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#newItem\"><i class=\"icon-plus icon-white\"></i> <font color=#ffffff>".$lang[875]."</font></a>"."
<br><br><a class=\"btn btn-success\" onClick=\"javascript:window.open('admin/currency_parser.php?speek=".$speek."','fr0','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#CurrParser\"><i class=\"icon-globe icon-white\"></i> <font color=#ffffff>".$lang[1144]."</font></a>
<br><br><a class=\"btn btn-info\" onClick=\"javascript:window.open('admin/obmen.php?speek=".$speek."','fr3','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=820,height=560,left=10,top=10');\" href=\"#rassilka\"><i class=\"icon-envelope icon-white\"></i> <font color=#ffffff>".$lang[20]."</font></a>
</div>";
}

topwo ("", $admined, "100%", $nc0, $nc0, 4,0,"[categories]");
}
} else {

if (($valid=="1")&&($details[7]=="ADMIN")){ topwo ("", "<div align=center><br><a class=\"btn btn-primary\" onClick=\"javascript:window.open('admin/".$scriptprefix."new_item.php?speek=".$speek."&catid=".$catid."','fr0','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#newItem\"><i class=\"icon-plus icon-white\"></i> <font color=#ffffff>".$lang[875]."</font></a>
<br><br><a class=\"btn btn-success\" onClick=\"javascript:window.open('admin/currency_parser.php?speek=".$speek."','fr0','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#CurrParser\"><i class=\"icon-globe icon-white\"></i> <font color=#ffffff>".$lang[1144]."</font></a>
<br><br><a class=\"btn btn-info\" onClick=\"javascript:window.open('admin/obmen.php?speek=".$speek."','fr3','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=820,height=560,left=10,top=10');\" href=\"#rassilka\"><i class=\"icon-envelope icon-white\"></i> <font color=#ffffff>".$lang[20]."</font></a>
</div>", "100%", $nc0, $nc0, 4,0,"[categories]");  }
}
}
?>
