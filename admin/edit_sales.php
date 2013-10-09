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
$catidt.=$out[0]."|".$out[1]."|".$out[2]."|".$out[3]."|".$foto[$st]."|".$out[5]."|".$out[6]."|\n";
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
$sales_list="<b>".$lang[675].":</b><br><br>
<form class=form-inline action=\"index.php\" name=form_dest method=\"POST\">
<input type=hidden name=\"action\" value=\"sales\">

<table width=100% border=1 cellpadding=4 cellspacing=0  bordercolordark=#ffffff>
<tr>
<td bordercolordark=#ffffff align=center><small><b>#</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[430]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[431]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>SALE %</b></small></td>
</tr>";

$fcontents = file("$base_loc/catid.txt");
reset($fcontents);
sort($fcontents);
$st=0;
while (list ($line_num, $line) = each ($fcontents)) {
$st+=1;
$out=explode("|",$line);
if ($out[2]!="") {
$sales_list.="<tr>
<td valign=center bordercolordark=#ffffff align=center><small>$st.</small></td>
<td valign=center bordercolordark=#ffffff align=center><input type=hidden name=\"ucat[$st]\" value=\"".$out[0]."\"><small>".$out[1]."</small>&nbsp;</td>
<td valign=center bordercolordark=#ffffff align=center><small>".$out[2]."&nbsp;</small></td>
<td valign=center bordercolordark=#ffffff align=center><small><input type=\"text\" size=20 name=\"foto[$st]\" value=\"".$out[4]."\"></small>&nbsp;<a href=\"#".$lang['del']."\" onClick=javascript:document.form_dest.elements[".($st*2)."].value=''><img src=\"$image_path/forum_del.gif\" border=0 title=\"".$lang['del']."\"></a></td>

</tr>";
} else {
$sales_list.="<input type=hidden name=\"ucat[$st]\" value=\"".$out[0]."\"><input type=\"hidden\" size=20 name=\"foto[$st]\" value=\"".$out[4]."\">";
}
}
$sales_list.="</table><p align=center>".$lang[676]."<br><br><input type=hidden name=\"mod\" value=\"admin\"><input type=hidden name=\"chok\" value=\"ok\"><input type=submit value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p></form><br><br><br>";
?>