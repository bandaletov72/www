<?php
//echo "item_id=$item_id page=$page catid=$catid unifid=$unifid query=$query<br>";
if(isset($_GET['blog_out'])) $blog_out=$_GET['blog_out']; elseif(isset($_POST['blog_out'])) $blog_out=$_POST['blog_out']; else $blog_out="";
if (!preg_match("/^[yesno]+$/i",$blog_out)) { $blog_out="";}
$blog_out=substr($blog_out, 0, 10);
if ($blog_out=="yes") {

unset($_SESSION["fb_id"]);
unset($_SESSION["token"]);
unset($_SESSION["fbcontent"]);
unset($_SESSION["fb_gender"]);
unset($_SESSION["fb_prov"]);
unset($_SESSION["fb_ava"]);
unset($_SESSION["fb_other"]);
unset($fbcookie);
unset($_SESSION['a_token']);
unset($_SESSION['o_token']);
unset($_SESSION['o_token_secret']);
unset($_COOKIE['fbs_' . $fb_app_id]);
setcookie("fbs_" . $fb_app_id, '', time()-3600, "/", ".".$_SERVER['SERVER_NAME']);

}

$fts="";
$tags_cloud="";
$refferer1="";
//function lighter ($arg1, $arg2) {$rrr= (hexdec ("0x" . substr($arg1,1,2))) + $arg2;$ggg=(hexdec ("0x" . substr($arg1,3,2))) + $arg2;$bbb=(hexdec ("0x" . substr($arg1,5,2))) + $arg2; if ($rrr>255) {$rrr=255;}if ($rrr<0) {$rrr=0;}$rrr=dechex($rrr);if (strlen($rrr)<=1) {$rrr="0".$rrr;} if ($bbb>255) {$bbb=255;}if ($bbb<0) {$bbb=0;}$bbb=dechex($bbb);if (strlen($bbb)<=1) {$bbb="0".$bbb;} if ($ggg>255) {$ggg=255;}if ($ggg<0) {$ggg=0;}$ggg=dechex($ggg);if (strlen($ggg)<=1) {$ggg="0".$ggg;} return "#$rrr$ggg$bbb";}
$stuk=0;
//counter
if ($view_counter==1) {
if ((!@$_SESSION["scount"]) || (@$_SESSION["scount"]=="")){
if ((@file_exists("./admin/counter/count.txt"))==TRUE) {
$f5=file("./admin/counter/count.txt");
$counter=$f5[0];
$counter=doubleval($counter)+1;
} else {$counter=0;}
$filetagname=fopen("./admin/counter/count.txt","w");flock ($filetagname, LOCK_EX);
fputs($filetagname, "$counter");flock ($filetagname, LOCK_UN);
fclose ($filetagname);
unset($f5, $filetagname);

$cof="./admin/counter/".date("Y_m_d",time()).".txt";
if (@file_exists("$cof")==TRUE) {
$f5=file("$cof");
$tcounter=$f5[0];
$tcounter=doubleval($tcounter)+1;
} else {
$tcounter=1;
}
$filetagname=@fopen("$cof","w");
flock ($filetagname, LOCK_EX);
fputs($filetagname, "$tcounter");
flock ($filetagname, LOCK_UN);
fclose ($filetagname);
unset($f5, $filetagname);
$_SESSION["scount"]="$counter";
$_SESSION["tcount"]="$tcounter";
}
$counter_total="<br><small>Всего посещений: <b>".@$_SESSION["scount"]."</b><br>Сегодня: <b>".@$_SESSION["tcount"]."</b></small> ";
} else {
$counter_total="";
}



function detect_utf($Str) {
 for ($i=0; $i<strlen($Str); $i++) {
  if (ord($Str[$i]) < 0x80) $n=0; # 0bbbbbbb
  elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xF0) $n=3; # 1111bbbb
  else return false; # Does not match any model
  for ($j=0; $j<$n; $j++) { # n octets that match 10bbbbbb follow ?
   if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80)) return false;
  }
 }
 return true;
}


//##
//## перекодировка unicode UTF-8 -> win1251
//##

function utf8_win ($s){
$out="";
$c1="";
$byte2=false;
for ($c=0;$c<strlen($s);$c++){
$i=ord($s[$c]);
if ($i<=127) $out.=$s[$c];
if ($byte2){
$new_c2=($c1&3)*64+($i&63);
$new_c1=($c1>>2)&5;
$new_i=$new_c1*256+$new_c2;
if ($new_i==1025){
$out_i=168;
}else{
if ($new_i==1105){
$out_i=184;
}else {
$out_i=$new_i-848;
}
}
$out.=chr($out_i);
$byte2=false;
}
if (($i>>5)==6) {
$c1=$i;
$byte2=true;
}
}
return $out;
}
if ((!@$_SESSION["stime"]) || (@$_SESSION["stime"]=="")){$_SESSION["stime"]=time();}
if ($show_searchengines_results==1) {

//echo "!!!".$refferer."-".$stag."-".$catid."-".$unifid;
if ((!@$_SESSION["sfrom"]) || (@$_SESSION["sfrom"]=="")){$banc=0;
$stag="";
$refferer="";
$reffound="";
$servref=str_replace("http://", "", rawurldecode(str_replace("%0A","",@$_SERVER['HTTP_REFERER'])));

if (detect_utf($servref)==TRUE) { $servref=utf8_win($servref);}
if (preg_match ("/google/i", $servref ))    { $stag="&q=";    $fts="google"; }
if (preg_match ("/crawler/i", $servref ))   { $stag="&q=";    $fts="crawler";}
if (preg_match ("/altavista/i", $servref )) { $stag="&q=";    $fts="altavista";}
if (preg_match ("/icq/i", $servref ))      { $stag="&q=";    $fts="icq";}
if (preg_match ("/yandex/i", $servref ))   { $stag="text=";  $fts="yandex"; }
if (preg_match ("/rambler/i", $servref ))  { $stag="words="; $fts="rambler";}
if (preg_match ("/mail/i", $servref ))     { $stag="q=";     $fts="mail";}
if (preg_match ("/gogo/i", $servref ))     { $stag="q=";     $fts="gogo";}
if (preg_match ("/live/i", $servref ))     { $stag="q=";     $fts="live";}
if (preg_match ("/yahoo/i", $servref ))    { $stag="p=";     $fts="yahoo";}
if (preg_match ("/aport/i", $servref ))    { $stag="&r=";    $fts="aport"; }
if ($fts=="") {$fts=htmlspecialchars(trim(stripslashes($servref)));}
if ($fts!="") {@$_SESSION["sfrom"]=str_replace("|", "", htmlspecialchars(trim(stripslashes($fts)))); } else {@$_SESSION["sfrom"]=$lang[734];}
$reffererm1=@explode("$stag", $servref);
$refferer1=@strtoken(@$reffererm1[1], "&");
//echo "ref=".$refferer1;
$refferer1=str_replace("|", "",strtolower(trim(str_replace("+" , " ", stripslashes(str_replace("\n", "", str_replace(chr(0x0A), "", $refferer1)))))));
$_SESSION["stag"]=htmlspecialchars($refferer1);
//echo "00query=$query-$stag-$catid-$reffound";
if (($stag!="")&&($catid=="_")&&($unifid=="")&&($item_id=="")&&($page=="")) {

$refferer=$refferer1;
//пишем
$cof="./admin/searchwords/".md5($refferer).".txt";
if (@file_exists("$cof")==TRUE) {
$f5=file("$cof");
$scounter=$f5[0];

if (doubleval($scounter)==0) {$banc=1;}
$scounter=1+doubleval($scounter);
if (!isset($f5[2])) {$f5[2]="";}
$f5[2]=str_replace("\n","", $f5[2]);
if (($f5[2]!="")&&($banc==0)) {

$reffound=str_replace(strtoken($f5[2], "?")."?", "", $f5[2]);

//nado budet proverit uslovie
if (!preg_match("/query/i",$reffound)) {
$page="";
parse_str(strtoken($reffound, "?"));
if ($item_id!="") {
if ($items_db_type!="mysql") { if (file_exists("$base_loc/items/".$item_id.".man")==TRUE) {$tmplid=file("$base_loc/items/".$item_id.".man"); $unifid=trim($tmplid[0]); $mancatid=trim(@$tmplid[1]);}} else {
$mancatid=$item_id; $scriptprefix="mysql_";
}
}
//echo "item_id=$item_id page=$page catid=$catid unifid=$unifid query=$query<br>";

if ($page!="") {$stuk=1;}
}



}

} else {
$scounter=1;
}
if ($banc==0) {
$filetagname=@fopen("$cof","w");
flock ($filetagname, LOCK_EX);
fputs($filetagname, "$scounter\n$refferer\n".@$f5[2]);
flock ($filetagname, LOCK_UN);
fclose ($filetagname);
unset($f5, $filetagname);
}

}
//echo "0query=$query-$stag-$catid-$reffound";
if (!preg_match("/^[-А-Яа-яa-zA-Z0-9_\w\ \x21-\x40]+$/i",$refferer)) { $refferer="";}
//echo "1query=$query-$stag-$catid";
if ($reffound=="") {
if ($query!="") {
//echo "2query=$query-$stag-$catid";
$query=$refferer;
$refferer="";
} else {
if ($show_searchengines_results==1) {
if (($catid=="_")&&($unifid=="")&&($item_id=="")&&($page=="")) {
$query=$refferer;
//echo "3query=$query-$stag-$catid";
}
}
}
}
} else {
$refferer="";
}
} else {
$refferer="";
}

$tgc=doubleval(hexdec(substr(md5("".@$page.@$catid.@$unifid.@$brand.@$start.@$nr.@$action.@$i.@$item_id.@$fr.@$level.@$cl_post.@$message.@$tag.@$month.@$year.$htpath),0,2)));
$mmdtgc="".@$page.@$catid.@$unifid.@$brand.@$start.@$nr.@$action.@$i.@$item_id.@$fr.@$level.@$cl_post.@$message.@$tag.@$month.@$year.$htpath;
$tagpages=0;
if (file_exists("./admin/db/tags_pages.txt")==TRUE) {
$tagp = fopen ("./admin/db/tags_pages.txt" , "r");
$tagpages = doubleval(trim(trim(fread($tagp, filesize("./admin/db/tags_pages.txt")))));
fclose ($tagp);
if ($tagpages>1) {
if ($tgc>$tagpages) {
while ($tgc>$tagpages) {
$tgc=floor($tgc/$tagpages);
}
}
} else {
$tgc=0;
}

if (($mmdtgc=="0")||($mmdtgc=="")||($mmdtgc=="00x$htpath")) {$tgc="0";}
if ($view_tag_clouds!="")  {
if (@file_exists("$base_loc/$tgc.txt")==FALSE) {  $tgc="0"; }
if (@file_exists("$base_loc/$tgc.txt")==TRUE) {
$tagfpen = fopen ("$base_loc/$tgc.txt" , "r");
$tags_cloud = "<b>".$lang[171].":</b><hr color=$nc6 noshade size=1><!-- ".$tgc." -->".fread($tagfpen, filesize("$base_loc/$tgc.txt"));
fclose ($tagfpen);
}
}
} else {
$tags_cloud="";
}
?>
