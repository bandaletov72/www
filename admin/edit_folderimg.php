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
$catidt.=$out[0]."|".$out[1]."|".$out[2]."|".$foto[$st]."|".$out[4]."|".$out[5]."|".$out[6]."|\n";
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
$folderimg_list="<b>".$lang[675].":</b><br><br>
<form class=form-inline action=\"index.php\" name=form_dest method=\"POST\">
<input type=hidden name=\"action\" value=\"folderimg\">

<table width=100% border=1 cellpadding=4 cellspacing=0  bordercolordark=#ffffff>
<tr>
<td bordercolordark=#ffffff align=center><small><b>#</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[421]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[430]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>".$lang[431]."</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>HTML</b></small></td>
</tr>";

$fcontents = file("$base_loc/catid.txt");
reset($fcontents);
sort($fcontents);
$st=0;
$ffst=0;
while (list ($line_num, $line) = each ($fcontents)) {
$st+=1;
$out=explode("|",$line);
$ffst+=1;
$folderimg_list.="<tr>
<td valign=center bordercolordark=#ffffff align=center><small>$ffst.</small></td>
<td valign=center bordercolordark=#ffffff align=center><small>".$out[3]."<img src=\"$image_path/pix.gif\" id=\"img_$st\"><br><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=$st','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')></small></td>
<td valign=center bordercolordark=#ffffff align=center> <input type=hidden name=\"ucat[$st]\" value=\"".$out[0]."\"><small>".$out[1]."</small></td>
<td valign=center bordercolordark=#ffffff align=center><small>".$out[2]."&nbsp;</small></td>
<td valign=center bordercolordark=#ffffff align=center><small><input type=\"text\" style=\"width:80%\" size=20 name=\"foto[$st]\" id=\"el_$st\" value=\"".$out[3]."\"></small>&nbsp;<a href=\"#".$lang['del']."\" onClick=\"
document.getElementById('el_$st').value='';
\"><img src=\"$image_path/forum_del.gif\" border=0 title=\"".$lang['del']."\"></a></td>

</tr>";

}
$folderimg_list.="</table><p align=center><input type=hidden name=\"chok\" value=\"ok\"><input type=submit value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p></form><br><br><br>";
?>