<?php
//Выведем новости//
$latestnews="";
if ($show_news==1) {
$allow = "<br> <b> <a> <img> <i> <div> <font> <strong> <sup> <p> <object>";
$st = 0;
$handle=opendir("$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')  || (strlen($file)==1) || ((substr($file, 0 , 1))!="c")) {
continue;
} else {
$fp = @fopen ("$base_loc/content/$file" , "r");
$out=explode(".",$file);
$c = $out[0];
$all= @fread ($fp, @filesize("$base_loc/content/$file"));
//if (filesize("$base_loc/content/$file")>=2000): $all .=" ..."; endif;
if (preg_match("/==(.*)==/i", $all, $out)) {
$title=$out[1];
$news = str_replace ("==$title==", "" , $all);
} else {
$title = "";
$news = $all;
}
@fclose ($fp);
//$news = strip_tags($news, $allow);
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || (strlen($cc)==1)) {
continue;
} else {
$name ="$title";
$adminurl="";
if (($valid=="1")&&($details[7]=="ADMIN")): $adminurl="<div align=right><a class=\"btn\" href=#edit onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/$file','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a clss=btn hrref=#del onClick=javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=".str_replace(".txt","",$file)."&del=".str_replace(".txt","",$file)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>"; endif;

$filesnn[$file] = "<tr><td><H1>$title</H1><img align=left vspace=4 border=0 src=\"$image_path/znak1.png\">$news</small>$adminurl<hr color=\"$nc6\" size=\"1\" width=100% noshade></td></tr>\n";
$noutn=explode(".",$file);
$news_numberns[$file]=$noutn[0];
$st += 1;
}
}
}
closedir ($handle);
if ($st!=0) {
//сортировка по алфавиту//
krsort ($filesnn);
reset ($filesnn);
ksort ($news_numberns);
reset ($news_numberns);
$qnews=0;
$latestnews = "<table border=0 width=100%>\n";
while (list ($key, $val) = each ($filesnn)) {
$latestnews .= "$val\n";
$qnews+=1;
if ($qnews>=$news_per_page): break; endif;
}
$latestnews .= "</table><p align=right><small>$carat <b><a href=\"$htpath/index.php?action=allnews\">".$lang[284]."</a></b> [<b>".count(@$filesnn)."</b>]</small></p>\n";

}
if ($full_wiki_repl==1) {$latestnews=wikify($latestnews,"");}
if ($news_per_page==0){$latestnews="<small>$carat <b><a href=\"$htpath/index.php?action=allnews\">".$lang[284]."</a></b> [<b>".count(@$filesnn)."</b>]</small></p>\n";}

}
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="show_news";$strnum=159; $oldvalue=$$oldval;
if ($$oldval==0) {
$latestnews.="<div align=center><font color=#b94a48>".$lang[56].": ".$lang[894]."</font></div>";
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\"><br><br>
<b>".$lang['qty'].":</b> ";
$strnum=63;
$oldvalue=$news_per_page;
$modonoff.="
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"1\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=3"."' value=\"3\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=5"."' value=\"5\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=7"."' value=\"7\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=10"."' value=\"10\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=15"."' value=\"15\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=30"."' value=\"30\">&nbsp;
<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=news_per_page&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=100"."' value=\"100\">&nbsp;";
}
$latestnews.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center><b>$lang[56]:</b>&nbsp;
<input type=button onclick=javascript:location.href='"."$htpath/admin/editor/index.php?speek=$speek"."' value=\"".$lang['adm3']."\">&nbsp;
<input type=button onclick=javascript:location.href='"."$htpath/admin/editor/edit.php?speek=$speek&c=c&klon=1"."' value=\"&gt;&gt;&nbsp;&nbsp;".$lang[901]."\">&nbsp;
$modonoff<br><br>".$lang[888]."</div>"; endif;
}
?>
