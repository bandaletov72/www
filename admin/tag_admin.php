<?php
$tags_admined="";
$maxfiles=10000;

if ((isset($addtag))&&(isset($koltag))) {
$addtag=str_replace("\"","",(trim(strip_tags(@$addtag))));
$koltag=str_replace("\"","",(trim(strip_tags(@$koltag))));
$linktag=str_replace("\"","",(trim(strip_tags($linktag))));
if (($koltag!="0")&&($koltag!="")&&($addtag!="")) {
$tagff="./admin/searchwords/".md5($addtag).".txt";

$filetagf=fopen($tagff,"w");
flock ($filetagf, LOCK_EX);
fputs($filetagf, @$koltag."\n".@$addtag."\n".rawurldecode(@$linktag));
flock ($filetagf, LOCK_UN);
fclose ($filetagf);
unset ($filetagf);

}
}

if (!isset($tag_change)) {$tag_change=0;}
$tagsave="";

//function lighter ($arg1, $arg2) {$rrr= (hexdec ("0x" . substr($arg1,1,2))) + $arg2;$ggg=(hexdec ("0x" . substr($arg1,3,2))) + $arg2;$bbb=(hexdec ("0x" . substr($arg1,5,2))) + $arg2; if ($rrr>255) {$rrr=255;}if ($rrr<0) {$rrr=0;}$rrr=dechex($rrr);if (strlen($rrr)<=1) {$rrr="0".$rrr;} if ($bbb>255) {$bbb=255;}if ($bbb<0) {$bbb=0;}$bbb=dechex($bbb);if (strlen($bbb)<=1) {$bbb="0".$bbb;} if ($ggg>255) {$ggg=255;}if ($ggg<0) {$ggg=0;}$ggg=dechex($ggg);if (strlen($ggg)<=1) {$ggg="0".$ggg;} return "#$rrr$ggg$bbb";}



$maxtag=0;
$populartag="";
$kws=0;
$ftf=0;
$tot_kws=0;
unset($f6);
$ssd=0;
$handle=opendir('./admin/searchwords/');
while (($f6 = readdir($handle))!==FALSE) {
if (($f6 == '.') || ($f6 == '..')) {
continue;
} else {
$tagtime=filemtime("./admin/searchwords/$f6")+$ssd;
$filetags[$tagtime]=$f6;
$ssd+=1;
echo "\n";
if ($ssd>$maxfiles) { break;}
}
}
closedir($handle);
unset($f6);
@krsort ($filetags);
@reset($filetags);
while (list ($line_num, $f6) = @each ($filetags)) {
$f5=file("./admin/searchwords/$f6");
$ift=str_replace("\n", "", @$f5[0]);

if (!isset($f5[2])) {$f5[2]="";}
$kwr5[$kws]=str_replace("\n", "", $f5[2]);
if ($f5[2]!="") {$taglink=str_replace("\n", "", $f5[2]); } else {$taglink="index.php?query=".rawurlencode(str_replace("\n", "", $f5[1]))."&usl=OR";}
$sortags=doubleval(str_replace("\n", "", $f5[0]));
if ($ift=="NA") {$sortags=$minimum_tag+1;}

$chars= intval(strlen($sortags));
$tagword=str_replace("\n", "", $f5[1]);

if ($chars==1): $sortbytags="000000000$sortags"; endif;
if ($chars==2): $sortbytags="00000000$sortags"; endif;
if ($chars==3): $sortbytags="0000000$sortags"; endif;
if ($chars==4): $sortbytags="000000$sortags"; endif;
if ($chars==5): $sortbytags="00000$sortags"; endif;
if ($chars==6): $sortbytags="0000$sortags"; endif;
if ($chars==7): $sortbytags="000$sortags"; endif;
if ($chars==8): $sortbytags="00$sortags"; endif;
if ($chars==9): $sortbytags="0$sortags"; endif;
if ($chars==10): $sortbytags="$sortags"; endif;
$kwr[$kws]="<!-- $sortbytags -->$tagword";
$kwr2[$kws]=$sortags;
$kwr3[$kws]=$taglink;
$kwr4[$kws]=$f6;
$kwr6[$kws]=$tagword;
$kwr7[$kws]=str_replace("\n", "", $f5[0]);
if (($sortags>$maxtag)&&($tagword!="")&&($kwr7[$kws]!="NA")) {$maxtag=$sortags; $populartag="$tagword";}
$kws+=1;

}
$colortag=0;
$fontsize=20;
$fontcolortags1="$nc2";
$fontcolortags2="$nc2";
//rsort($kwr);
@reset( $kwr);
$tags_admined="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=POST name=\"formtag\"><input type=hidden name=\"action\" value=\"tags\"><input type=hidden name=\"mod\" value=\"admin\"><input type=hidden name=\"tag_change\" value=1><table border=0 width=100% cellspacing=5><tr><td width=100%><b>".$lang[808]."</b></td><td colspan=3><b>".$lang[809]."</b></td><td align=center><b>".$lang[810]."</b></td></tr>";
while (list ($line_num, $line) = @each ($kwr)) {
echo "\n";
if ($kwr2[$line_num]>$minimum_tag) {

if (($kwr2[$line_num]/2) == (floor($kwr2[$line_num]/2))) {
$fontcolortags=$fontcolortags1;
} else {
$fontcolortags=$fontcolortags2;
}
if (floor($colortag/2)==($colortag/2)) {$bgk1=lighter($nc6,10);} else {$bgk1=$nc0;}
//if ($kwr5[$line_num]!="") { $kwr5[$line_num]=str_replace(strtoken($kwr5[$line_num], "?")."?", "", $kwr5[$line_num]); parse_str(strtoken($kwr5[$line_num], "?")); }
$colst=$kwr7[$line_num];
$notav="";
if ($colst=="NA") {$bgk1="#ffdede"; $notav=" [".$lang[811]."]";}
$tags_admined.="<tr bgcolor=$bgk1><td width=100%><span style=\"font-size: ".(10+ceil($fontsize*$kwr2[$line_num]/($maxtag+1)))."px;\"><a href=\"".$kwr3[$line_num]."\" title=\"".$kwr2[$line_num]."\"><font color=\"".lighter($fontcolortags,  (0-2*(doubleval(ceil($fontsize*$kwr2[$line_num]/($maxtag+1))))))."\">".$line."</font></a></span>$notav<input name=tagm[$colortag] type=hidden value=\"".$kwr6[$line_num]."\"></td><td><input name=tagn[$colortag] type=hidden size=3 value=\"".$kwr4[$line_num]."\"><input id=\"num$line_num\" name=tagc[$colortag] type=text size=3 value=\"".$kwr7[$line_num]."\"><input name=tagc2[$colortag] type=hidden value=\"".$kwr7[$line_num]."\"></td><td><input type=button onclick=\"document.getElementById('num$line_num').value=0\" value=\"X\" title=\"".$lang['del']."\"></td>
<td><input type=button onclick=\"document.getElementById('num$line_num').value='NA'\" value=\"NA\" title=\"".$lang[812]."\"></td><td><input name=tagl2[$colortag] type=hidden value=\"".$kwr5[$line_num]."\"><input name=tagl[$colortag] type=text size=60 value=\"".$kwr5[$line_num]."\"></td></tr>";

$colortag+=1;
}
}
$tags_admined.="</table><p align=center><input type=submit value=\"V&nbsp;&nbsp;".$lang['ch']."\"></p></form><b>".$lang[211]."!</b> ".$lang[813].": <b><a href=\"index.php?action=tagindex\">".$lang[133]."</a></b><br><br>";
$tags_admined.="<small><br><br><b>".$lang[814].":</b> '$populartag' (".$lang[287].": $maxtag)</small>

<br><br><hr color=\"$nc2\" size=1><br><br><b>".$lang[815].":</b><br><br><form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=GET><input type=hidden name=\"action\" value=\"tags\"><input type=hidden name=\"mod\" value=\"admin\"><table border=0 cellspacing=10>
<tr><td valign=top><b>".$lang['keyword'].":</b></td><td valign=top><input type=\"text\" name=\"addtag\" size=40 value=\"\"></td></tr>
<tr><td valign=top><b>".$lang[287].":</b></td><td valign=top><input type=\"text\" name=\"koltag\" size=4 value=\"10\"></td></tr>
<tr><td valign=top><b>".$lang[810].":</b></td><td valign=top><input type=\"text\" name=\"linktag\" size=40 value=\"\"><br><small>".$lang[691].": index.php?catid=catalogue_</small></td></tr>
</table><input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;".$lang[816]."\"></form>";




if ($tag_change!=0) {
if (isset($tagn,$tagc,$tagl,$tagm,$tagc2,$tagl2)) {
reset($tagn);
while (list ($line_num, $line) = each ($tagn)) {

if (($tagl[$line_num]!=$tagl2[$line_num])||($tagc[$line_num]!=$tagc2[$line_num])) {
$ftagn="./admin/searchwords/$line";
if (@file_exists($ftagn)) {
$tags_admined = "<br><b>".$lang[209]."</b> <br><br>» <a href=\"index.php?action=tags&mod=admin\">".$lang['back']."</a><meta http-equiv=\"Refresh\" content=\"0; URL=index.php?action=tags&mod=admin\">";
$iftag="".$tagc[$line_num];
if ($iftag=="0") {

unlink ("$ftagn");
} else {
echo "\n";
$filetagf=fopen("$ftagn","w");
flock ($filetagf, LOCK_EX);
fputs($filetagf, $tagc[$line_num]."\n".$tagm[$line_num]."\n".$tagl[$line_num]);
flock ($filetagf, LOCK_UN);
fclose ($filetagf);
unset ($filetagf);
}
}
}
}
}
}

?>