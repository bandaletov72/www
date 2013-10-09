<?php
if ((!@$chok) || (@$chok=="")): $chok=""; endif;
if ($chok=="ok") {
$fcontents = file("$base_loc/catid.txt");
reset($fcontents);
sort($fcontents);
$st=0;
$catidt="";
while (list ($line_num, $line) = each ($fcontents)) {
$st+=1;
$out=explode("|",$line);
if (($ucat[$st] == $out[0])&&($out[0]!=$foto[$st])){
$catidt.=$out[0]."|".$out[1]."|".$out[2]."|".$out[3]."|".$out[4]."|".$out[5]."|".$foto[$st]."|\n";
} else {
$catidt.=$out[0]."|".$out[1]."|".$out[2]."|".$out[3]."|".$out[4]."|".$out[5]."|".$out[6]."|\n";
}
}
$file = fopen ("$base_loc/catid.txt", "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> File <b>.$base_loc/catid.txt</b> not found or read only.\n";
exit;
}
fputs ($file, $catidt);flock ($file, LOCK_UN);
fclose ($file);
}
$op=0;
$site_colors="<script language=javascript>
function selectcolor(arg) {
document.getElementById('color2').style.backgroundColor=arg;
document.getElementById('curcolor').value=arg;
}
</script>".$lang[677].": <input type=text id=\"curcolor\" value=\"\"><br><br><table border=0><tr><td valign=top align=center>WEB Color<br>";
// function PHP colorizer v.1.0 EuroWebcart
$xstep=16;
$ystep=51;
$zstep=51;
$width=10;
$height=10;
function hexa ($arg) {
if ($arg>255) {$arg=255;}
$arg=dechex($arg);

if (strlen($arg)<=1) {$arg="0".$arg;}
return $arg;
}

//starting WEB 216 color
$xx=0;
$yy=0;
$zz=0;
while ($zz<=255) {
while ($yy<=255) {
while ($xx<=255) {
$site_colors .= "<a href=\"#".hexa(255-$xx). hexa(255-$yy). hexa(255-$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx). hexa(255-$yy). hexa(255-$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx). hexa(255-$yy). hexa(255-$zz)."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$xx=0;
$yy+=$ystep;
}
$yy=0;
$zz+=$zstep;
}
$site_colors .= "</td>\n\n\n\n<td valign=top align=center>RGB Color<br>";

//starting red
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}


//starting green
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx). hexa(255-$xx+$zz).hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx). hexa(255-$xx+$zz).hexa(255-$xx)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx). hexa(255-$xx+$zz).hexa(255-$xx) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}

//starting blue
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx). hexa(255-$xx). hexa(255-$xx+$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx). hexa(255-$xx). hexa(255-$xx+$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx). hexa(255-$xx). hexa(255-$xx+$zz)."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}
$site_colors .= "Greyscale Color<br>";
//starting grey
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx+$zz)."')><img title=\"#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx+$zz) ."\" border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx+$zz) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}


$site_colors .= "<br><br>Zoom:</td>\n\n\n\n<td valign=top align=center>CMY Color<br>";


//starting Cyan
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx).hexa(255-$xx+$zz) .hexa(255-$xx+$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx).hexa(255-$xx+$zz) .hexa(255-$xx+$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx).hexa(255-$xx+$zz) .hexa(255-$xx+$zz) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}

//starting Magenta
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx) . hexa(255-$xx+$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx) . hexa(255-$xx+$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx) . hexa(255-$xx+$zz)."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}

//starting Yellow
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}



$site_colors .= "Random Color<br>";

//random color
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$hexa=hexa(255-rand(0,255)).hexa(255-rand(0,255)) .hexa(255-rand(0,255));
$site_colors .= "<a href=\"#".$hexa."\" onclick=javascript:selectcolor('#".$hexa."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".$hexa ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}
$site_colors .= "<br><img border=\"1\" src=\"$image_path/pix.gif\" width=\"160\" height=\"50\" align=bottom style=\"background-color: #ffffff\" id=\"color2\"></td></tr></table></center></form></p>";
$dircolors_list="<b>".$lang[675].":</b><br><br>
<form class=form-inline action=\"index.php\" name=form_dest method=\"POST\">
<input type=hidden name=\"action\" value=\"dircolors\">

<table width=100% border=1 cellpadding=4 cellspacing=0  bordercolordark=#ffffff>
<tr>
<td bordercolordark=#ffffff align=center><small><b>#</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[678]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[430]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[431]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[679]."</b></small></td>
</tr>";

$fcontents = file("$base_loc/catid.txt");
reset($fcontents);
sort($fcontents);
$st=0;
while (list ($line_num, $line) = each ($fcontents)) {
$st+=1;
$out=explode("|",$line);
if ($out[2]=="") {
if ($out[6]=="") {$colb=$nc10; } else {$colb=$out[6];}
if ($out[1]=="All") {
$dircolors_list.="<input type=hidden name=\"ucat[$st]\" value=\"".$out[0]."\"><input type=\"hidden\" name=\"foto[$st]\" value=\"".$out[6]."\">";

} else {
$dircolors_list.="<tr>
<td valign=center bordercolordark=#ffffff align=center><small>$st.</small></td>
<td valign=center bordercolordark=#ffffff align=center><small><br>".navbut4("<a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$nc5\"><b>".str_replace(" ", "&nbsp;", strtoken($out[1],"("))."</b></font></a><br>", $colb, 60, $nc0)."</td>
<td valign=center bordercolordark=#ffffff align=center> <input type=hidden name=\"ucat[$st]\" value=\"".$out[0]."\"><small>".$out[1]."</small></td>
<td valign=center bordercolordark=#ffffff align=center><small>".$out[2]."&nbsp;</small></td>
<td valign=center bordercolordark=#ffffff align=center><small><input type=\"text\" size=20 name=\"foto[$st]\" value=\"".$out[6]."\"></small>&nbsp;<a href=\"#".$lang['del']."\" onClick=javascript:document.form_dest.elements[".($st*2)."].value=''><img src=\"$image_path/forum_del.gif\" border=0 title=\"".$lang['del']."\"></a></td>

</tr>";
}
}else {
if ($out[1]=="All") {
if ($out[6]=="") {$colb=$nc10; } else {$colb=$out[6];}
$dircolors_list.="<tr>
<td valign=center bordercolordark=#ffffff align=center><small>$st.</small></td>
<td valign=center bordercolordark=#ffffff align=center><small><br>".navbut4("<a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$nc5\"><b>".str_replace(" ", "&nbsp;", strtoken($out[2],"("))."</b></font></a><br>", $colb, 60, $nc0)."</td>
<td valign=center bordercolordark=#ffffff align=center> <input type=hidden name=\"ucat[$st]\" value=\"".$out[0]."\"><small>".$out[1]."</small></td>
<td valign=center bordercolordark=#ffffff align=center><small>".$out[2]."&nbsp;</small></td>
<td valign=center bordercolordark=#ffffff align=center><small><input type=\"text\" size=20 name=\"foto[$st]\" value=\"".$out[6]."\"></small>&nbsp;<a href=\"#".$lang['del']."\" onClick=javascript:document.form_dest.elements[".($st*2)."].value=''><img src=\"$image_path/forum_del.gif\" border=0 title=\"".$lang['del']."\"></a></td>

</tr>";
} else {
$dircolors_list.="<input type=hidden name=\"ucat[$st]\" value=\"".$out[0]."\"><input type=\"hidden\" name=\"foto[$st]\" value=\"".$out[6]."\">";
}
}
}
$dircolors_list.="</table><p align=center><input type=hidden name=\"chok\" value=\"ok\"><input type=submit value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p></form><div align=center>$site_colors</div>";
?>