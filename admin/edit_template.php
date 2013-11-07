<?php
if(isset($_GET['t'])) $t=$_GET['t']; elseif(isset($_POST['t'])) $t=$_POST['t']; else $t="";
if (!preg_match("/^[a-z0-9\/\.-_]+$/i",$t)) { $t="";}
if(isset($_GET['temp'])) $temp=$_GET['temp']; elseif(isset($_POST['temp'])) $temp=$_POST['temp']; else $temp="";

if(isset($_GET['nt'])) $nt=$_GET['nt']; elseif(isset($_POST['nt'])) $nt=$_POST['nt']; else $nt="templates";
if (!preg_match("/^[a-z0-9\/\.-_]+$/i",$nt)) { $nt="templates";}

if(isset($_GET['save'])) $save=$_GET['save']; elseif(isset($_POST['save'])) $save=$_POST['save']; else $save="";
if(isset($_GET['delt'])) $delt=$_GET['delt']; elseif(isset($_POST['delt'])) $delt=$_POST['delt']; else $delt="";
$template_list2="<br><br>\n";
$template_list = "<b>".$lang['list_templates']."</b><br><br>\n";
$s=0;


if (($nt!="robots")&&($nt!="htaccess")&&($nt!="forums")&&($nt!="chats")&&($nt!="widgetlist")&&(substr($nt,0,5)!="poll/")&&(substr($nt,0,6)!="forum/")&&($t!="custom_vacancy")) {
$template_tmp=Array();
if (($valid=="1")&&($details[7]=="ADMIN")&&($t=="")&&($nt!="")) {

$handle=opendir("./$nt/");
while (($file = readdir($handle))!==FALSE) {
if (($file == '.') || ($file == '..') || (substr($file,-3) != 'inc')) {
continue;
} else {
$s=str_replace(".inc", "", $file);
$template_tmp[]= "<!-- $file --><li><a href=\"index.php?action=template&nt=$nt&t=$s\">$file</a></li>\n";
}
}
closedir($handle);
}
natcasesort($template_tmp);
$template_list=implode("",$template_tmp);
unset ($template_tmp);
if (($valid=="1")&&($details[7]=="ADMIN")&&($t!="")&&($nt!="")) {
$template_tmp=Array();
$template_tmp2=Array();
if ($delt!="") {
unlink("./$nt/$t".".inc");
$t="config";
}
$s=0;
$handle=opendir("./$nt/");
while (($file = readdir($handle))!==FALSE) {
if ((substr($file,-3) == 'inc')||($file=="banlist.inc")) {

$s=str_replace(".inc", "", $file);
if ($t!=$s) {
if (substr($file,0,3)=="cc_") {
$template_tmp2[]= "<!-- $file --><li><a href=\"index.php?action=template&nt=$nt&t=".str_replace(".inc", "", $file)."\">$file</a>&nbsp;&nbsp;&nbsp;&nbsp;&lt;--&nbsp;<b><a href=\"index.php?action=template&nt=$nt&t=".str_replace(".inc", "", $file)."&delt=yes\">".$lang[383]."</a></b></li>\n";
} else {
$template_tmp[]= "<!-- $file --><li><a href=\"index.php?action=template&nt=$nt&t=".str_replace(".inc", "", $file)."\">$file</a></li>\n";
	}
} else {
if ($save=="") {
if (substr($file,0,3)=="cc_") {
$template_tmp2[]= "<!-- $file --><li><b>$file</b>&nbsp;&nbsp;&nbsp;&nbsp;&lt;--&nbsp;<b><a href=\"index.php?action=template&nt=$nt&t=".str_replace(".inc", "", $file)."&delt=yes\">".$lang[383]."</a></b></li>\n";
} else {
$template_tmp[]= "<!-- $file --><li><b>$file</b></li>\n";
	}

$fp = fopen ("./$nt/$file" , "r");
$template_content= @fread ($fp, @filesize("./$nt/$file"));
$filet=$file;
fclose($fp);
} else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$filet=$file;
if (substr($file,0,3)=="cc_") {
$template_tmp2[]= "<!-- $file --><li><b>$file</b> - <b>".$lang[317]."</b>&nbsp;&nbsp;&nbsp;&nbsp;&lt;--&nbsp;<b><a href=\"index.php?action=template&nt=$nt&t=".str_replace(".inc", "", $file)."&delt=yes\">".$lang[383]."</a></b></li>\n";
} else {
$template_tmp[]= "<!-- $file --><li><b>$file</b> - <b>".$lang[317]."</b></li>\n";
}
$timest=time();
copy("./$nt/$file" , "./admin/undo/backups/$file.".$timest);
$fp = fopen ("./admin/undo/backups/$file.".$timest.".undo" , "w"); flock ($fp, LOCK_EX);
fputs($fp, "./$nt/$file");
flock ($fp, LOCK_UN);
fclose($fp);
if ($file=="css.inc") {
$fp = fopen ("./style.css" , "w"); flock ($fp, LOCK_EX);
fputs($fp, str_replace("{nc10}", "[nc10]", str_replace("{lnc10}", "[lnc10]", $cssflush)));flock ($fp, LOCK_UN);
fclose($fp);

}
$fp = fopen ("./$nt/$file" , "w"); flock ($fp, LOCK_EX);
fputs($fp, str_replace("{nc10}", "[nc10]", str_replace("{lnc10}", "[lnc10]", $temp)));flock ($fp, LOCK_UN);
fclose($fp);
$template_content=str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", $temp));
}
}
}
}
closedir($handle);

natcasesort($template_tmp);
$template_list=implode("",$template_tmp);
unset ($template_tmp);
natcasesort($template_tmp2);
$template_list2=implode("",$template_tmp2);
unset ($template_tmp2);
$hhelp="";
if ($t=="lang") {
if (@file_exists("./help/$speek/lang.html")) {$hhelp="<div align=right><img src=\"$image_path/help.gif\" border=0 title=\"".$lang['46']."\"> <a href=\"#hhelp\" onClick=javascript:window.open('$htpath/help/$speek/lang.html','hhelp','status=no,scrollbars=yes,menubar=yes,resizable=yes,location=no,width=800,height=580,left=10,top=10')>".$lang['46']." [lang.inc]</a></div><br>";}
}

$template_list .= "$template_list2<br>$hhelp";

if (($t=="custom_cart")||(substr($t,0,3)=="cc_")) {
if (substr($t,0,3)=="cc_") {
if (@!file_exists("./templates/$template/$speek/".$t.".inc")) {
$ffp=fopen("./templates/$template/$speek/".$t.".inc","w");
fclose ($ffp);
}
}
$template_list .= "<b>$lang[691]:</b><br>
<pre><small>Default text input|Input power|A||
Hidden Input|Qty of inputs|pcs|hidden||
Select item|Input voltage|V|select|220;110;12;|
Date col|Inspection date||date||
Any qty of cols lot|Specify item content||kit|name;qty;weight;voltage;power;|
Auto score lot - only 3 cols required|Specify item content||kit2|name;qty;price|
Country select input|Country||countries||
Tips input|City|||New York;Moscow;Paris;Berlin;Tokyo;Pekin;|</small></pre><br>\n";
}


if ($t=="antispam") {

$template_list .= "<b>$lang[691]:</b><br>
<pre><small>2 plus 2=4
The capital of Russia=moscow
3*2=6
7*2*2=28</small></pre><br>\n";
}

if ($t=="custom_user") {

$template_list .= "<b>$lang[691]:</b><br>
<pre><small>PO Box|Please enter your Post code|text|10|1|¸¨à-ÿÀ-ßa-zA-Z0-9_-|||
Birthday|Please enter your birth date using format DD-MM-YYYY|text|10|1|0-9._-|birth||
Sex|Please specify your sex|radio|10|1|¸¨à-ÿÀ-ßa-zA-Z0-9.\ _-|sex|Not set^Male^Female|
Delivery date|Please specidy wishing date of delivery|select|10|1|0-9._-||month|day,week,month or year|</small></pre><br>\n";
}


$template_list .= "<p align=\"center\">
<center>
<b>".$lang[320]." ".@$filet.":</b>
<br><br>
<small>
<b>".$lang[211]."</b> ".$lang[318]." \"&lt;?\" \"?&gt;\"<br>
".$lang[319]."</small><br><br>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"$nt\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"$t\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
</p>
<center>
\n";
$template_list="<br>
<div class=comm><table border=0><tr><td><img src=$image_path/panic.png></td><td><font size=3><b>$lang[992]</b>: <A href=\"$htpath/admin/undo/index.php\">$htpath/admin/undo</a></font><br> $lang[993]</td></tr></table>
</div><br>".$template_list;

}
}
if (($valid=="1")&&($details[7]=="ADMIN")&&($t!="")&&(substr($nt,0,5)=="poll/")){

if ($save=="") {
if (file_exists("./$nt/$t.txt")==true) {
$fp = fopen ("./$nt/$t.txt" , "r");
$template_content= @fread ($fp, @filesize("./$nt/$t.txt"));
fclose($fp);
}
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./$nt/$t.txt" , "w");flock ($fp, LOCK_EX);
fputs($fp, str_replace("{nc10}", "[nc10]", str_replace("{lnc10}", "[lnc10]", $temp)));flock ($fp, LOCK_UN);
fclose($fp);
$template_content=str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", $temp));
}
$template_list .= "
<div><h4><font color=#b94a48>$lang[980]</font></h4></div>
<b>".$lang['edits']." $nt/$t.txt</b><br>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"$nt\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"$t\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
\n";
}
if (($valid=="1")&&($details[7]=="ADMIN")&&($t!="")&&(substr($nt,0,6)=="forum/")){

if ($save=="") {
if (file_exists("./$nt/$t.txt")==true) {
$fp = fopen ("./$nt/$t.txt" , "r");
$template_content= @fread ($fp, @filesize("./$nt/$t.txt"));
fclose($fp);
}
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./$nt/$t.txt" , "w");flock ($fp, LOCK_EX);
fputs($fp, str_replace("{nc10}", "[nc10]", str_replace("{lnc10}", "[lnc10]", $temp)));flock ($fp, LOCK_UN);
fclose($fp);
$template_content=str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", $temp));
}
$template_list .= "
<div><h4><font color=#b94a48>$lang[1001]</font></h4></div>
<b>".$lang['edits']." $nt/$t.txt</b><br>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"$nt\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"$t\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
\n";
}

if (($valid=="1")&&($details[7]=="ADMIN")&&($t=="")&&($nt=="robots")) {
if ($save=="") {

$fp = fopen ("./robots.txt" , "r");
$template_content= @fread ($fp, @filesize("./robots.txt"));
fclose($fp);
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./robots.txt" , "w");flock ($fp, LOCK_EX);
fputs($fp, $temp);flock ($fp, LOCK_UN);
fclose($fp);
$template_content=$temp;
}
$template_list .= "
<b>$htpath/robots.txt</b>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"robots\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
\n";
}

if (($valid=="1")&&($details[7]=="ADMIN")&&($t=="")&&($nt=="widgetlist")) {

if ($save=="") {
if (file_exists("./widgets/list.php")==TRUE) {
$fp = fopen ("./widgets/list.php" , "r");
$template_content= @fread ($fp, @filesize("./widgets/list.php"));
fclose($fp);
} else {
$template_content="";
}
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./widgets/list.php" , "w");flock ($fp, LOCK_EX);
fputs($fp, $temp);flock ($fp, LOCK_UN);
fclose($fp);
$template_content=$temp;
}
$wfiles ="";
$handle=opendir("./widgets/");
while (($wgfile = readdir($handle))!==FALSE) {

if (substr($wgfile,-3) == 'inc') {

$wfiles .= "<li><a href=\"index.php?action=template&nt=widgets&t=".str_replace(".inc", "", $wgfile)."\">$wgfile</a></li>\n";
}
}
closedir($handle);

$template_list .= "<h4>Widget List</h4><br>If You want to switch OFF some widgets please type 2 slashes \"//\" before widget stroke.<br>
<br><b>Example:</b><br><br>This will switch OFF this widget:
<div class=round4>//require (\"./widgets/weather.inc\"); </div>
This will switch ON this widget:
<div class=round4>require (\"./widgets/weather.inc\"); </div>
<br>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"widgetlist\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
<br><div class=round2><b>Widgets installed:</b><br><br>$wfiles</div>
\n";



}
if (($valid=="1")&&($details[7]=="ADMIN")&&($t=="")&&($nt=="htaccess")) {

if ($save=="") {
if (file_exists("./.htaccess")==TRUE) {
$fp = fopen ("./.htaccess" , "r");
$template_content= @fread ($fp, @filesize("./.htaccess"));
fclose($fp);
} else {
$template_content="";
}
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./.htaccess" , "w");flock ($fp, LOCK_EX);
fputs($fp, $temp);flock ($fp, LOCK_UN);
fclose($fp);
$template_content=$temp;
}
$template_list .= "
<b>$htpath/.htaccess</b>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"htaccess\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
\n";
}

if (($valid=="1")&&($details[7]=="ADMIN")&&($t=="")&&($nt=="forums")) {

if ($save=="") {
if (file_exists("./forum/data/forums.txt")==TRUE) {
$fp = fopen ("./forum/data/forums.txt" , "r");
$template_content= @fread ($fp, @filesize("./forum/data/forums.txt"));
fclose($fp);
} else {
$template_content="";
}
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./forum/data/forums.txt" , "w");flock ($fp, LOCK_EX);
fputs($fp, $temp);flock ($fp, LOCK_UN);
fclose($fp);
$template_content=$temp;
}
$template_list .= "
<b>$htpath/forum/data/forums.txt</b>
<br><br>
<i>".$lang[694].":</i><br>
<pre><small>SORTING_NUM_ROW|DIRECTORY_FORUM_ID|NAME|DESCRIPTION|MODERATOR1,MODERATOR2|RULES_NAME|RULES_URL|ANTISPAM_ENABLE|NEW_TREAD_ENABLE|ICON|ONLY_REG_USER_MAY_POST|</small></pre>
<br>
<i>".$lang[691].":</i><br>
<pre><small>2|2|FAQs|Frequently Asked Questions|admin,toby77,lexa,johny_83|Forum Rules|http://www.yoursite.com/rules.htm|1|1|images/mini_folder.png|1|
1|1|Anouncement|News and anouncement from administrators|admin,toby77|Forum Rules|http://www.yoursite.com/rules.htm|1|0|images/znak1.png|1|
3|3|Support|Technical Support for all users|admin,sasha|Forum Rules|http://www.yoursite.com/rules.htm|1|1|images/mini_folder.png|0|
</small></pre><br><b>".$lang[1004]."</b>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"forums\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
\n";
}

if (($valid=="1")&&($details[7]=="ADMIN")&&($t=="custom_vacancy")) {

if ($save=="") {
if (file_exists("./$nt/$t".".inc")==TRUE) {
$fp = fopen ("./$nt/$t".".inc" , "r");
$template_content= @fread ($fp, @filesize("./$nt/$t".".inc"));
fclose($fp);
} else {
$template_content="";
}
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./$nt/$t".".inc" , "w");flock ($fp, LOCK_EX);
fputs($fp, $temp);flock ($fp, LOCK_UN);
fclose($fp);
$template_content=$temp;
}
$template_list .= "
<b>./$nt/$t".".inc</b>
<br><br>
<i>".$lang[694].":</i><br>
<pre>FORM FIELD NAME|REQUIRE OR NOT|text OR textarea OR checkbox|SIZE OR NUMBER OF ROWS||</pre>
<br>
<i>".$lang[691].":</i><br>
<pre>Date of birth|*|text|20||
DOC Sertificate|*|checkbox|20||
Other requirements|*|textarea|10||
</pre>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"$nt\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"$t\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
\n";

}
if (($valid=="1")&&($details[7]=="ADMIN")&&($t=="")&&($nt=="chats")) {

if ($save=="") {
if (file_exists("./chat/chats.txt")==TRUE) {
$fp = fopen ("./chat/chats.txt" , "r");
$template_content= @fread ($fp, @filesize("./chat/chats.txt"));
fclose($fp);
} else {
$template_content="";
}
}else {
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
$fp = fopen ("./chat/chats.txt" , "w");flock ($fp, LOCK_EX);
fputs($fp, $temp);flock ($fp, LOCK_UN);
fclose($fp);
$template_content=$temp;
}
$template_list .= "
<b>$htpath/chat/chats.txt</b>
<br><br>
<i>".$lang[694].":</i><br>
<pre>DIRECTORY(USE a-z0-9 symbols)|NAME OF CHAT ROOM|ROOM DESCRIPTION|ONLY REG USERS (0-1)|||||| </pre>
<br>
<i>".$lang[691].":</i><br>
<pre>main|Main chat|We solve any problems online|1||||||
guest|Guest chat|Welcome aboard!|0||||||
</pre><br><b>".str_replace(toLower($lang[9]),$lang[1011], $lang[1004])."</b>
<form class=form-inline action=\"index.php\" method=\"post\">
<a name=\"textarea\"></a><textarea rows=\"22\" name=\"temp\" cols=\"60\" style=\"width:100%\">".str_replace("[nc10]", "{nc10}", str_replace("[lnc10]", "{lnc10}", @$template_content))."</textarea>
<br><br>
<input type=\"hidden\" name=\"save\" value=\"1\">
<input type=\"hidden\" name=\"nt\" value=\"chats\">
<input type=\"hidden\" name=\"action\" value=\"template\">
<input type=\"hidden\" name=\"t\" value=\"\">
<input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\">
</form>
\n";
}

?>
