<?php
if ((!@$chok) || (@$chok=="")): $chok=""; endif;
if ($chok=="ok") {
$fcontents = file("$base_loc/brands.txt");
natcasesort($fcontents);
reset($fcontents);
$st=0;
$catidt="";
while (list ($line_num, $line) = each ($fcontents)) {
$st+=1;
$out=trim($line);
if (isset($foto[$out])&&($line!="")){
$file = fopen ("$base_loc/$out".".img", "w");
flock ($file, LOCK_EX);
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".img</b> not found or read only.\n";
exit;
}
fputs ($file, $foto[$out]);
flock ($file, LOCK_UN);
fclose ($file);
unset($file);
}
if (isset($chk[$out])&&($line!="")){
$file = fopen ("$base_loc/$out".".chk", "w");
flock ($file, LOCK_EX);
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".chk</b> not found or read only.\n";
exit;
}
fputs ($file, $chk[$out]);
flock ($file, LOCK_UN);
fclose ($file);
unset($file);
}
if (isset($url[$out])&&($line!="")){
$file = fopen ("$base_loc/$out".".url", "w");
flock ($file, LOCK_EX);
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".url</b> not found or read only.\n";
exit;
}
fputs ($file, $url[$out]);
flock ($file, LOCK_UN);
fclose ($file);
unset($file);
}
if (isset($site[$out])&&($line!="")){
$file = fopen ("$base_loc/$out".".site", "w");
flock ($file, LOCK_EX);
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".site</b> not found or read only.\n";
exit;
}
fputs ($file, $site[$out]);
flock ($file, LOCK_UN);
fclose ($file);
unset($file);
}

if (isset($text[$out])&&($line!="")){
$file = fopen ("$base_loc/$out".".text", "w");
flock ($file, LOCK_EX);
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".text</b> not found or read only.\n";
exit;
}
fputs ($file, $text[$out]);
flock ($file, LOCK_UN);
fclose ($file);
unset($file);
}

if (($url[$out]=="")&&($line!="")){
@unlink("$base_loc/$out".".url");
}
if (($chk[$out]=="")&&($line!="")){
@unlink("$base_loc/$out".".chk");
}
if (($foto[$out]=="")&&($line!="")){
@unlink("$base_loc/$out".".img");
}
if (($site[$out]=="")&&($line!="")){
@unlink("$base_loc/$out".".site");
}
if (($text[$out]=="")&&($line!="")){
@unlink("$base_loc/$out".".text");
}
}
}

$brandimg_list="<b>".$lang[868].":</b><br><br>
<form class=form-inline action=\"index.php\" name=form_dest method=\"POST\">
<input type=hidden name=\"action\" value=\"brandimg\">

<table width=100% border=0 cellpadding=4 cellspacing=0  bordercolordark=#ffffff>
<tr bgcolor=$nc2>
<td bordercolordark=#ffffff align=center><small><b>#</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>Brand</b></small></td>
<td bordercolordark=#ffffff align=center><small><b>Other</b></small></td>
</tr>";

$fcontents = file("$base_loc/brands.txt");
reset($fcontents);
sort($fcontents);
$st=0;
$ffst=0;
while (list ($line_num, $line) = each ($fcontents)) {
$st+=1;
$out=trim($line);
$ffst+=1;
$img="";
$urls="";
$texts="";
$sites="";
$chks="";
if (@file_exists("$base_loc/$out".".img")&&($line!="")){
$file = fopen ("$base_loc/$out".".img", "r");
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".img</b> unable to open.\n";
exit;
}
$img=@fread($file, @filesize("$base_loc/$out".".img"));
fclose ($file);
unset($file);
}
if (@file_exists("$base_loc/$out".".url")&&($line!="")){
$file = fopen ("$base_loc/$out".".url", "r");
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".url</b> unable to open.\n";
exit;
}
$urls=@fread($file, @filesize("$base_loc/$out".".url"));
fclose ($file);
unset($file);
}
if (@file_exists("$base_loc/$out".".text")&&($line!="")){
$file = fopen ("$base_loc/$out".".text", "r");
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".text</b> unable to open.\n";
exit;
}
$texts=@fread($file, @filesize("$base_loc/$out".".text"));
fclose ($file);
unset($file);
}
if (@file_exists("$base_loc/$out".".site")&&($line!="")){
$file = fopen ("$base_loc/$out".".site", "r");
if (!$file) {
echo "<p> File <b>.$base_loc/$out".".site</b> unable to open.\n";
exit;
}
$sites=@fread($file, @filesize("$base_loc/$out".".site"));
fclose ($file);
unset($file);
}
$bgch=" bgcolor=$nc2";
if (@file_exists("$base_loc/$out".".chk")&&($line!="")){
$chks="checked";
$bgch="";
}
if ($img=="") {$img=" ";}
$brandimg_list.="<tr$bgch>
<td bordercolordark=#ffffff align=center valign=top><small>$ffst.</small></td>
<td bordercolordark=#ffffff align=left valign=top width=30%><input type=\"checkbox\" name=\"chk[".$out."]\"$chks title=\"VIEW or NO\" value=\"YES\"><b>".$out."</b><small><br><br>".$img."<img src=\"$image_path/pix.gif\" id=\"img_$st\"></small></td>
<td valign=top bordercolordark=#ffffff align=left width=70%><table border=0 width=100%>
<tr><td align=right valign=top><b>$lang[861]:</b></td><td>
<input type=\"text\" style=\"width:100%\" size=20 name=\"foto[".$out."]\" id=\"el_$st\" value=\"".str_replace("\\","",$img)."\"></td><td><input type=button value=\"...\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=$st','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')></td></tr>
<tr><td align=right valign=top><b>".$lang[882].":</b></td><td>
<input type=\"text\" style=\"width:100%\" size=20 name=\"site[".$out."]\" id=\"site_$st\" value=\"".str_replace("\\","",$sites)."\"><br><small>$lang[691]: <i><font color=$nc2>http://site.url/</font></i></small></td><td valign=top>
<input type=button value=\"X\" title=\"".$lang['del']."\" onClick=\"
document.getElementById('site_$st').value='';
\"></td></tr>
<tr><td align=right valign=top><b>".$lang[883].":</b></td><td>
<input type=\"text\" style=\"width:100%\" size=20 name=\"url[".$out."]\" id=\"url_$st\" value=\"".str_replace("\\","",$urls)."\"><br><small>$lang[691]: <i><font color=$nc2>$htpath/index.php&query=".rawurlencode($out)."</font></i></small></td><td valign=top>
<input type=button class=\"del\" value=\"X\" title=\"".$lang['del']."\" onClick=\"
document.getElementById('url_$st').value='';
\"></td></tr>
<tr><td valign=top align=right valign=top><b>".$lang['description'].":</b></td><td>
<textarea style=\"width:100%\" cols=48 rows=5 name=\"text[".$out."]\" id=\"text_$st\">".str_replace("\\","",$texts)."</textarea></td><td valign=top>
<input type=button value=\"X\" title=\"".$lang['del']."\" onClick=\"
document.getElementById('text_$st').value='';
\"></td></tr></table>
</td>

</tr><tr><td colspan=4><hr noshade size=1 color=$nc2></td></tr>";

}
$brandimg_list.="</table><p align=center><small><b>".$lang[881]."</b></small><br><br><input type=hidden name=\"chok\" value=\"ok\"><input type=submit value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p></form><br><br><br>";
unset ($urls, $texts, $sites, $img);
?>