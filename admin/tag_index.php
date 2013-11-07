<?php
set_time_limit(0);
$tages="";
$zz=256;
while ($zz>=0) {
@unlink("$base_loc/".$zz.".txt");
$zz-=1;
}
if (!isset($tag_change)) {$tag_change=0;}
$tagsave="";
$tags_admined="";
//function lighter ($arg1, $arg2) {$rrr= (hexdec ("0x" . substr($arg1,1,2))) + $arg2;$ggg=(hexdec ("0x" . substr($arg1,3,2))) + $arg2;$bbb=(hexdec ("0x" . substr($arg1,5,2))) + $arg2; if ($rrr>255) {$rrr=255;}if ($rrr<0) {$rrr=0;}$rrr=dechex($rrr);if (strlen($rrr)<=1) {$rrr="0".$rrr;} if ($bbb>255) {$bbb=255;}if ($bbb<0) {$bbb=0;}$bbb=dechex($bbb);if (strlen($bbb)<=1) {$bbb="0".$bbb;} if ($ggg>255) {$ggg=255;}if ($ggg<0) {$ggg=0;}$ggg=dechex($ggg);if (strlen($ggg)<=1) {$ggg="0".$ggg;} return "#$rrr$ggg$bbb";}



$maxtag=1;
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
}
}
closedir($handle);
unset($f6);
@krsort ($filetags);
@reset($filetags);
while (list ($line_num, $f6) = @each ($filetags)) {
$f5=file("./admin/searchwords/$f6");
$ift=str_replace("\n", "", @$f5[0]);
if ($ift=="NA") {continue;}
if (!isset($f5[2])) {$f5[2]="";}
$kwr5[$kws]=str_replace("\n", "", $f5[2]);
if ($f5[2]!="") {$taglink=str_replace("\n", "", $f5[2]); } else {$taglink="index.php?query=".rawurlencode(strtoken(str_replace("\n", "", $f5[1]),"&"))."&usl=OR";}
$sortags=doubleval(str_replace("\n", "", $f5[0]));
$tagword=str_replace("\n", "", $f5[1]);  if ($tagword=="") {continue;}

$kwr[$kws]="$tagword";
$kwr2[$kws]=$sortags;
$kwr3[$kws]=$taglink;
$kwr4[$kws]=$f6;
$kwr6[$kws]=$tagword;
if (($sortags>$maxtag)&&($tagword!="")) {
$maxtag=$sortags; $populartag="$tagword";}
$kws+=1;
if ($tagword!="") {$tot_kws+=doubleval($f5[0]);}
}
$colortag=0;
$fontsize=20;
/*
$fontcolortags1="$nc3";
$fontcolortags2=lighter($nc6, -40);
//sort($kwr);
@reset( $kwr);
while (list ($line_num, $line) = @each ($kwr)) {
if ($kwr2[$line_num]>$minimum_tag) {

if (($kwr2[$line_num]/2) == (floor($kwr2[$line_num]/2))) {
$fontcolortags=$fontcolortags1;
} else {
$fontcolortags=$fontcolortags2;
}
if (floor($colortag/2)==($colortag/2)) {$bgk1=lighter($nc6,10);} else {$bgk1=$nc0;}
//if ($kwr5[$line_num]!="") { $kwr5[$line_num]=str_replace(strtoken($kwr5[$line_num], "?")."?", "", $kwr5[$line_num]); parse_str(strtoken($kwr5[$line_num], "?")); }

$sorta=$kwr2[$line_num];
$chars= intval(strlen($sorta));
$tagword=str_replace("\n", "", $f5[1]);
if ($chars==1): $sortbytags="000000000$sorta"; endif;
if ($chars==2): $sortbytags="00000000$sorta"; endif;
if ($chars==3): $sortbytags="0000000$sorta"; endif;
if ($chars==4): $sortbytags="000000$sorta"; endif;
if ($chars==5): $sortbytags="00000$sorta"; endif;
if ($chars==6): $sortbytags="0000$sorta"; endif;
if ($chars==7): $sortbytags="000$sorta"; endif;
if ($chars==8): $sortbytags="00$sorta"; endif;
if ($chars==9): $sortbytags="0$sorta"; endif;
if ($chars==10): $sortbytags="$sorta"; endif;
$tags_ad[]="<!-- $sortbytags --><span style=\"font-size: ".(10+ceil($fontsize*$kwr2[$line_num]/$maxtag))."px;\"><a href=\"".$kwr3[$line_num]."\" title=\"".$kwr2[$line_num]."\"><font color=\"".lighter($fontcolortags,  (0-5*(doubleval(ceil($fontsize*$kwr2[$line_num]/$maxtag)))))."\">".$line."</font></a></span>&nbsp;&nbsp;&nbsp; ";
$colortag+=1;
}
}


@rsort($tags_ad);
@reset ($tags_ad);
$cdd=0;
while (list ($numa, $linea) = @each ($tags_ad)) {
$cdd+=1;
$tags_admined.="$linea";
if ($cdd>=$maximum_indexed_tags) { break; }
}

$filetagf=fopen("$base_loc/tag_index.txt","w");
flock ($filetagf, LOCK_EX);
fputs($filetagf, $tags_admined. "<small><br><br><b>".$lang[286].":</b> '$populartag' (".$lang[287].": $maxtag)</small>");
flock ($filetagf, LOCK_UN);
fclose ($filetagf);
$tags_admined = "<h1>OK</h1> $tags_admined";
*/

$fontcolortags1="$nc3";
$fontcolortags2="$nc4";
//sort($kwr);
@reset( $kwr);
$colortag=0;
while (list ($line_num, $line) = @each ($kwr)) {

if ($kwr2[$line_num]>$minimum_tag) {

if (($kwr2[$line_num]/2) == (floor($kwr2[$line_num]/2))) {
$fontcolortags=$fontcolortags1;
} else {
$fontcolortags=$fontcolortags2;
}
if (floor($colortag/2)==($colortag/2)) {$bgk1=" style=\"font-weight:400;\"";} else {$bgk1="";}
//if ($kwr5[$line_num]!="") { $kwr5[$line_num]=str_replace(strtoken($kwr5[$line_num], "?")."?", "", $kwr5[$line_num]); parse_str(strtoken($kwr5[$line_num], "?")); }
$sorta=$kwr2[$line_num];
$chars= intval(strlen($sorta));
$tagword=str_replace("\n", "", $f5[1]);
if ($chars==1): $sortbytags="000000000$sorta"; endif;
if ($chars==2): $sortbytags="00000000$sorta"; endif;
if ($chars==3): $sortbytags="0000000$sorta"; endif;
if ($chars==4): $sortbytags="000000$sorta"; endif;
if ($chars==5): $sortbytags="00000$sorta"; endif;
if ($chars==6): $sortbytags="0000$sorta"; endif;
if ($chars==7): $sortbytags="000$sorta"; endif;
if ($chars==8): $sortbytags="00$sorta"; endif;
if ($chars==9): $sortbytags="0$sorta"; endif;
if ($chars==10): $sortbytags="$sorta"; endif;
$tags_ad[$line_num]="<!-- $sortbytags --><div class=\"lnk pull-left mr\"".$bgk1."><span style=\"font-size: ".($tagsize+ceil($fontsize*$kwr2[$line_num]/$maxtag))."px;\"><a href=\"".$kwr3[$line_num]."\" title=\"".$kwr2[$line_num]."\"><font color=\"".$fontcolortags."\">".wordwrap(strtoken(strip_tags(rawurldecode($line)),"&"),22," ",1)."</font></a></span></div>\n";
$colortag+=1;
}
}


@rsort($tags_ad);
@reset ($tags_ad);
$cdd=0;
$cde=0;
$cmas=count($tags_ad);
$tags_admind=Array();
while (list ($numa, $linea) = @each ($tags_ad)) {
@$tags_admind["$cdd"].="$linea";

//echo $linea;
$cde+=1;
//echo "$cdd"." ".$linea."<br>\n";
if ($cde>=$maximum_indexed_tags) {
//echo dechex(intval($cdd))." ";
$filetg=fopen("$base_loc/".$cdd.".txt","w");
$tages.= $tags_admind["$cdd"]."<br><br>";
flock ($filetg, LOCK_EX);
fputs($filetg, $tags_admind["$cdd"]);
flock ($filetg, LOCK_UN);
fclose ($filetg);
$cmas-=$cde;
$cde=0;
$cdd+=1;

}

}
if ($cmas>0) {
$tages.= "<div>".$tags_admind["$cdd"]."<div class=clearfix></div></div>";
$filetg=fopen("$base_loc/".$cdd.".txt","w");
flock ($filetg, LOCK_EX);
fputs($filetg, $tags_admind["$cdd"]);
flock ($filetg, LOCK_UN);
fclose ($filetg);
}
//@reset ($tags_admind);
//while (list ($numa, $linea) = @each ($tags_admind)) {
//$tags_admined.="$linea";
//}



$filetagf=fopen("$base_loc/tag_index.txt","w");
flock ($filetagf, LOCK_EX);
fputs($filetagf, @$tags_admind["0"]. "<br><br><b>".$lang[286].":</b> '$populartag' (".$lang[287].": $maxtag)");
flock ($filetagf, LOCK_UN);
fclose ($filetagf);
$filetagp=fopen("./admin/db/tags_pages.txt","w");
flock ($filetagp, LOCK_EX);
fputs($filetagp, $cdd);
flock ($filetagp, LOCK_UN);
fclose ($filetagp);
$tags_admined = "<h4>$lang[105]: ".($cdd+1)."</h4> ".$tages;


?>
