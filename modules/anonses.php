<?php
//Выведем анонсы//
$anonses = "";
$st = 0;
$handle=opendir("$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..') || (strlen($file)==1) || ((substr($file, 0 , 1))!="b")) {
continue;
} else {
$fp = fopen ("$base_loc/content/$file" , "r");
$out=explode(".",$file);
$c = $out[0];
$all= fread ($fp, filesize("$base_loc/content/$file"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$title=$out[1];
$news = str_replace ("==$title==", "" , $all);

} else {
$title = "";
$news = $all;
}
$allow = "<img>";
$news .= "... <br><small>» <a href=\"$htpath/index.php?page=$c\"><b>".$lang[289]."</b></a></small><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">";
fclose ($fp);
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || (strlen($cc)==1)) {
continue;
} else {
$name ="$title";
//$news=str_replace("<img ", "<img width=50 height=50 ", $news);
//$news=str_replace("<IMG ", "<img width=50 height=50 ", $news);
if (($valid=="1")&&($details[7]=="ADMIN")): $news.="<div class=pull-right><a href=\"#edit\" class=btn onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/$file','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=btn href=\"#del\" onClick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&amp;c=".str_replace(".txt","",$file)."&amp;del=".str_replace(".txt","",$file)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>"; endif;
$filesan[$file] = "<tr><td><small><b>$title</b><br>$news</small></td></tr><tr><td align=\"right\"><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"></td></tr>\n";
$nouta=explode(".",$file);
$newas_numbers[$st]=$nouta[0];
$st += 1;
}
}
}
closedir ($handle);
if ($st!=0) {
//сортировка по алфавиту//
krsort ($filesan);
reset ($filesan);
krsort ($newas_numbers);
reset ($newas_numbers);
$qnews=0;
$anonses = "<table border=\"0\" width=\"100%\">\n";
while (list ($key, $val) = each ($filesan)) {
$anonses .= "$val\n";
$qnews+=1;
if ($qnews>=$an_per_page): break; endif;

}
$anonses .= "</table>\n";
}
if ($an_per_page==0){$anonses="";}
?>
