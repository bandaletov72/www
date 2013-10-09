<?php
if (!isset($addpartner)) { $addpartner=""; }
if (!preg_match("/^[a-zA-Z0-9\._-]+$/i",$addpartner)) { $addpartner="";}
if (!isset($mailpartner)) { $mailpartner=""; }
if (!preg_match("/^[a-zA-Z0-9\@\._-]+$/i",$mailpartner)) { $mailpartner="";}

$partners_admined="";
$maxfiles=10000;

if ($addpartner!="") {
$addpartner=str_replace("\"","",(trim(@$addpartner)));
$mailpartner=str_replace("\"","",(trim($mailpartner)));
if ($addpartner!="") {
$partnerff="./admin/partners/".md5($addpartner).".txt";

$filepartnerf=fopen($partnerff,"w");
flock ($filepartnerf, LOCK_EX);
fputs($filepartnerf, trim(rawurldecode(@$addpartner))."\n".trim(rawurldecode(@$mailpartner))."\n".trim(str_replace("\n","^", rawurldecode(@$htmlpartner))));
flock ($filepartnerf, LOCK_UN);
fclose ($filepartnerf);
unset ($filepartnerf);

}
} else {
$partners_admined="<h4>".$lang[689]."</h4>";
}

if (!isset($partner_change)) {$partner_change=0;}
$partnersave="";

//function lighter ($arg1, $arg2) {$rrr= (hexdec ("0x" . substr($arg1,1,2))) + $arg2;$ggg=(hexdec ("0x" . substr($arg1,3,2))) + $arg2;$bbb=(hexdec ("0x" . substr($arg1,5,2))) + $arg2; if ($rrr>255) {$rrr=255;}if ($rrr<0) {$rrr=0;}$rrr=dechex($rrr);if (strlen($rrr)<=1) {$rrr="0".$rrr;} if ($bbb>255) {$bbb=255;}if ($bbb<0) {$bbb=0;}$bbb=dechex($bbb);if (strlen($bbb)<=1) {$bbb="0".$bbb;} if ($ggg>255) {$ggg=255;}if ($ggg<0) {$ggg=0;}$ggg=dechex($ggg);if (strlen($ggg)<=1) {$ggg="0".$ggg;} return "#$rrr$ggg$bbb";}



$maxpartner=0;
$kws=0;
$ftf=0;
$tot_kws=0;
unset($f6);
$ssd=0;
$handle=opendir('./admin/partners/');
while (($f6 = readdir($handle))!==FALSE) {
if (($f6 == '.') || ($f6 == '..')) {
continue;
} else {
$partnertime=filemtime("./admin/partners/$f6")+$ssd;
$filepartners[$partnertime]=$f6;
$ssd+=1;
echo "\n";
if ($ssd>$maxfiles) { break;}
}
}
closedir($handle);
unset($f6);
@krsort ($filepartners);
@reset($filepartners);
while (list ($line_num, $f6) = @each ($filepartners)) {
$f5=file("./admin/partners/$f6");
$ift=htmlspecialchars(str_replace("\n", "", @$f5[0]));

if (!isset($f5[2])) {$f5[2]="";}
$sorpartners=htmlspecialchars(str_replace("\n", "", $f5[0]));
if ($f5[0]!="") {
$kwr[$kws]="<!-- $sorpartners --><tr><td valign=top><input name=partnerm[$kws] type=hidden value=\"".htmlspecialchars(str_replace("\n", "", @$f5[1]))."\"><input name=partnerh[$kws] type=hidden value=\"".htmlspecialchars(str_replace("\n", "", @$f5[2]))."\"><input id=\"num$kws\" name=partnern[$kws] type=text size=20 value=\"".htmlspecialchars(str_replace("\n", "", @$f5[0]))."\"><input name=partnern2[$kws] type=hidden value=\"".htmlspecialchars(str_replace("\n", "", @$f5[0]))."\"></td><td valign=top><input name=partnerm2[$kws] type=text value=\"".htmlspecialchars(str_replace("\n", "", @$f5[1]))."\" size=20><input name=partnerf[$kws] type=hidden value=\"".$f6."\"></td>
<td width=100% rowspan=2><textarea name=partnerh[$kws] cols=40 rows=10 style=\"width:100%\">".str_replace("^", chr(10) ,htmlspecialchars(str_replace("\n", "", @$f5[2])))."</textarea></td><td valign=top rowspan=2><input type=button onclick=\"document.getElementById('num$kws').value=0\" value=\"X\" title=\"".$lang['del']."\"></td></tr><tr><td colspan=2><b>Partner URL:</b><br><br>$htpath/index.php?pid=$sorpartners<br><br><small><font color=$nc4><i>".$lang[688]."</i></font></small></td></tr><tr><td colspan=4><hr size=1 color=$nc4></td></tr>";


$kws+=1;
}
}

@sort($kwr);
@reset( $kwr);
$ff_k=0;
$partners_admined="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=POST name=\"formpartner\"><input type=hidden name=\"action\" value=\"partners\"><input type=hidden name=\"mod\" value=\"admin\"><input type=hidden name=\"partner_change\" value=1><table border=0 width=100% cellspacing=5><tr><td><b>Partner ID</b></td><td><b>E-Mail</b></td><td align=center colspan=2><b>Postorder tracking code (HTML)</b></td></tr>";
while (list ($line_num, $line) = @each ($kwr)) {
echo "\n";


$partners_admined.=$line;
$ff_k+=1;
}
$partners_admined.="</table>";
if ($ff_k==0) {$partners_admined.="</form><font color=#b94a48>No partners!</font>"; } else {
$partners_admined.="<p align=center><input type=submit value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p></form><br><br>";
}
$partners_admined.="<br><hr color=\"$nc2\" size=1><br><br><b>".$lang[690].":</b><br><br><form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=GET><input type=hidden name=\"action\" value=\"partners\"><input type=hidden name=\"mod\" value=\"admin\"><table border=0 cellspacing=10>
<tr><td valign=top><b>* Patner ID:</b></td><td valign=top><input type=\"text\" style=\"width:100%\" name=\"addpartner\" size=40 value=\"\"><br><small>".$lang[691].": <b>google.com</b> ".$lang[692]."</small></td></tr>
<tr><td valign=top><b>Post order HTML:</b></td><td valign=top><textarea name=\"htmlpartner\" cols=40 rows=10 style=\"width:100%\"></textarea><br><small>".$lang[693]."<br><br><b>".$lang[694].":</b><br>[mysite] - ".$lang[695]."<br>[orderid] - ".$lang[696]."<br>[total] - ".$lang[697]."<br>[currency] - ".$lang[698]."<br>[e-mail] - ".$lang[699]."<br>[name] - ".$lang[700]."<br>[tel] - ".$lang[701]."<br><br><b>".$lang[691].":</b> &lt;img width=1 height=1 src=\"http://PARTNER_SITE/notice.php?pid=[mysite]&orderid=[orderid]&total=[total]&currency=[cur]&mail=[e-mail]&name=[name]\" border=0&gt;&lt;/small&gt;</td></tr>
<tr><td valign=top><b>Partner E-mail:</b></td><td valign=top><input style=\"width:100%\" type=\"text\" name=\"mailpartner\" size=40 value=\"\"><br><small>".$lang[702]."</small></td></tr>
</table><br><div align=center><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[703]."\"></div></form><br><br><br>";




if ($partner_change!=0) {
if (isset($partnern,$partnerm,$partnerm2,$partnern2,$partnerf)) {
reset($partnern);
while (list ($line_num, $line) = each ($partnerf)) {

if (($partnern[$line_num]!=$partnern2[$line_num])||($partnerm[$line_num]!=$partnerm2[$line_num])||(@$partnerh[$line_num]!=@$partnerh2[$line_num])) {
$fpartnern="./admin/partners/$line";
if (@file_exists($fpartnern)) {
$partners_admined = "<br><b>".$lang[704]."</b> <br><br>» <a href=\"index.php?action=partners&mod=admin\">".$lang['back']."</a><meta http-equiv=\"Refresh\" content=\"0; URL=index.php?action=partners&mod=admin\">";
$ifpartner="".$partnern[$line_num];
if ($ifpartner=="0") {

unlink ("$fpartnern");
} else {
echo "\n";
$filepartnerf=fopen("$fpartnern","w");
flock ($filepartnerf, LOCK_EX);
fputs($filepartnerf, trim(str_replace("\n","", $partnern[$line_num]))."\n".trim(str_replace("\n","", $partnerm[$line_num]))."\n".trim(str_replace("\n","^", $partnerh[$line_num])));
flock ($filepartnerf, LOCK_UN);
fclose ($filepartnerf);
unset ($filepartnerf);
}
}
}
}
}
}

?>
