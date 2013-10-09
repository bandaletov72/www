<?php
//Выведем статьи//
$topics="";
$allow = "<br> <b> <a> <i>";
$st = 0;
$handle=opendir("$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')  || (strlen($file)==1) || ((substr($file, 0 , 1))=="b")|| ((substr($file, 0 , 1))=="d")|| ((substr($file, 0 , 1))=="c")|| ((substr($file, 0 , 1))=="x")|| ((substr($file, 0 , 1))=="s")) {
continue;
} else {
$fp = fopen ("$base_loc/content/$file" , "r");
$out=explode(".",$file);
$c = $out[0];
$all= fread ($fp, filesize("$base_loc/content/$file"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$title=$out[1];
$news = str_replace ("==$title==", "<!--Вырезал заголовок-->" , $all);
} else {
$title = "";
$news = $all;
}
$news = strip_tags($news, $allow);
$news=substr($news, 0, 250);
if (filesize("$base_loc/content/$file")>=250): $news .=" ..."; endif;
fclose ($fp);
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || (strlen($cc)==1)) {
continue;
} else {
$name ="$title";
//$news=str_replace("<img ", "<img width=\"50\" height=\"50\" ", $news);
//$news=str_replace("<IMG ", "<img width=\"50\" height=\"50\" ", $news);
$filesnt[$st] = "<tr><td><!--$file--><small><b>$title</b><small>$news</small></small></td></tr><tr><td align=\"right\"><small>$carat <A href=\"$htpath/index.php?page=$c\"><b>".$lang['addition']."</b></a></small><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"></td></tr>\n";
$noutv=explode(".",$file);
$news_numbersv[$st]=$noutv[0];
$st += 1;
}
}
}
closedir ($handle);
if ($st!=0) {
//сортировка по алфавиту//
sort ($filesnt);
reset ($filesnt);
sort ($news_numbersv);
reset ($news_numbersv);
$qnews=0;
$topics = "<table border=\"0\" width=\"100%\">\n";
while (list ($key, $val) = each ($filesnt)) {
$topics .= "$val\n";
$qnews+=1;
if ($qnews>=$statii_per_page): break; endif;
}
$topics .= "</table>\n";
}
?>
