<?php
//Выведем новости//
$latestnews="";
$allow = "<br> <b> <a> <i> <strong>";
$st = 0;
$news_per_page=1000;
$handle=opendir("$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')  || (strlen($file)==1) || ((substr($file, 0 , 1))!="c")) {
continue;
} else {
$fp = fopen ("$base_loc/content/$file" , "r");
$out=explode(".",$file);
$c = $out[0];
$all= fread ($fp, filesize("$base_loc/content/$file"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$title=$out[1];
$news = str_replace ("==$title==", "<!--Вырезал заголовок-->" , $all);
$sub=$title;
} else {
$title = "";
$news = $all;
}
fclose ($fp);
//$news = strip_tags($news, $allow);
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || (strlen($cc)==1)) {
continue;
} else {
$name ="$title";

$admined="";
if (($valid=="1")&&($details[7]=="ADMIN")){ $admined="<div class=round><b><font size=3>$title: </font></b><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$file','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>&nbsp;<input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('admin/editor/edit.php?speek=".$speek."&amp;c=".str_replace(".txt","",$file)."&amp;del=".str_replace(".txt","",$file)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')></div><div align=center><img src=\"$image_path/handdown.png\"></div>"; $title="";
} else {
$title="<h4>$title</h4>";
}
$filesnn[$file] = "$admined$title$news<br><br><br>\n\n";
$noutn=explode(".",$file);
$news_numberns[$st]=$noutn[0];
$st += 1;
}
}
}
closedir ($handle);
if ($st!=0) {
//сортировка по алфавиту//
krsort ($filesnn);
reset ($filesnn);
krsort ($news_numberns);
reset ($news_numberns);
$qnews=0;
$latestnews = "\n";
while (list ($key, $val) = each ($filesnn)) {
$latestnews .= "$val\n";
$qnews+=1;
if ($qnews>=$news_per_page): break; endif;
}
}
?>
