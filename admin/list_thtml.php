<?php

if (!isset($thteme)){$thteme="";} if (!preg_match("/^[a-zA-Z0-9_%\.-]+$/i",$thteme)) { $thteme="";}
if ($thteme!="") {
$fcontentt = file("./templates/$template/$language/vars.txt");
if ((@file_exists("./themes/$thteme"))||($thteme=="0000")) {
if ($thteme=="0000") {$thteme=""; $repl="";} else {$repl="themes/$thteme";}
while (list ($thtt, $lineth) = each ($fcontentt)) {
$fcontentt[$thtt]=str_replace("\$theme_file=\"$theme_file\";", "\$theme_file=\"$repl\";",$lineth);
}
}
top($lang[209], "$theme_file =&gt; change themes/$thteme\n<meta http-equiv=\"refresh\" content=\"0;URL=$htpath/index.php?action=thtml&mod=admin\">", "100%", strtolower($style ['sale']), strtolower($style ['bg_content']),0, 0, "[content]");
$theme_file="$thteme";
if (@file_exists("./themes/$thteme")==TRUE){
$ftt=fopen("./templates/$template/$language/vars.txt","w"); flock ($ftt, LOCK_EX);
fputs($ftt, implode("",$fcontentt)); flock ($ftt, LOCK_UN);
fclose ($ftt);

}

}

$thtemeave="";
$thtml_admined="";
//function lighter ($arg1, $arg2) {$rrr= (hexdec ("0x" . substr($arg1,1,2))) + $arg2;$ggg=(hexdec ("0x" . substr($arg1,3,2))) + $arg2;$bbb=(hexdec ("0x" . substr($arg1,5,2))) + $arg2; if ($rrr>255) {$rrr=255;}if ($rrr<0) {$rrr=0;}$rrr=dechex($rrr);if (strlen($rrr)<=1) {$rrr="0".$rrr;} if ($bbb>255) {$bbb=255;}if ($bbb<0) {$bbb=0;}$bbb=dechex($bbb);if (strlen($bbb)<=1) {$bbb="0".$bbb;} if ($ggg>255) {$ggg=255;}if ($ggg<0) {$ggg=0;}$ggg=dechex($ggg);if (strlen($ggg)<=1) {$ggg="0".$ggg;} return "#$rrr$ggg$bbb";}

$ftf=0;
unset($f6);
$ssd=0;
$handle=opendir('./themes/');
while (($f6 = readdir($handle))!==FALSE) {
if (($f6 == '.') || ($f6 == '..') || (substr($f6,-5) != 'thtml')) {
continue;
} else {
$filethtml[$f6]=$f6;
$filedate[$f6]=filemtime("./themes/$f6")+$ftf;
$filesize[$f6]=filesize("./themes/$f6");
$ftf+=1;

}
}
closedir($handle);
unset($f6);
$filethtml[0]="0000";
$filedate[0]=filemtime("./index.php");
$filesize[0]=0;
@sort ($filethtml);
@reset($filethtml);
$thtml_admined="<table cellpadding=5 cellspacing=0 width=100%><tr>";
while (list ($line_num, $line) = @each ($filethtml)) {

$ssd+=1;

if (floor($ssd/2)==($ssd/2)) {$bgk1=lighter($nc6,10);} else {$bgk1=$nc0;}
//if ($kwr5[$line_num]!="") { $kwr5[$line_num]=str_replace(strtoken($kwr5[$line_num], "?")."?", "", $kwr5[$line_num]); parse_str(strtoken($kwr5[$line_num], "?")); }
$ust_thtml="<form class=form-inline action=\"$htpath/index.php\" method=\"GET\"><input type=\"hidden\" name=\"thteme\" value=\"$line\"><input type=\"hidden\" name=\"action\" value=\"thtml\"><input type=\"hidden\" name=\"mod\" value=\"admin\"><input type=submit value=\"V&nbsp;&nbsp;&nbsp;".$lang[719]."\"></form>";
if ($oldthtml=="themes/$line") {$ust_thtml="<b><font color=$nc2>".$lang[717]."</font></b>";}
if (($line=="0000")&&($oldthtml=="")) {$ust_thtml="<b><font color=$nc2>".$lang[717]."</font></b>";}
$pro_thtml="<form class=form-inline action=\"$htpath/thtmlview.php\" method=\"GET\" target=\"_blank\"><input type=hidden name=\"thteme\" value=\"".str_replace(".thtml", "", $line)."\"><input type=submit value=\"".$lang[426]."\"></form>";
if ($allow_edit_thtml==1) { $edit_thtml="<form class=form-inline action=\"$htpath/admin/edit/index.php\" method=\"GET\"><input type=hidden name=\"speek\" value=\"".$speek."\"><input type=hidden name=\"working_file\" value=\"../../themes/$line\"><input type=submit value=\"!&nbsp;&nbsp;&nbsp;".$lang['edits']."\"></form>"; } else { $edit_thtml=""; }

$name_thtml=str_replace(".thtml", "", $line);
if ($line=="0000") {$pro_thtml=""; $edit_thtml=""; $name_thtml="No theme";}

$thtml_admined.="<tr bgcolor=$bgk1><td>$ssd.</td><td><b>".$name_thtml."</b></td><td><small>";
if ($line!="0000") {$thtml_admined.=date("d.m.Y H:i:s", @$filedate[$line]); } else {$thtml_admined.="-";}
$thtml_admined.="</small></td><td align=center><b>";
if ($line!="0000") {$thtml_admined.=((100*floor(@$filesize[$line]/100))/1000)."</b> Kb"; } else {$thtml_admined.="</b>-";}

$thtml_admined.="</td><td align=center>$pro_thtml</td><td align=center>$edit_thtml</td><td align=center>$ust_thtml</td></tr>";


}

$thtml_admined.="</tr></table><small><br><br><b>".$lang['total']."</b> $ssd</small><br><br>";



?>
