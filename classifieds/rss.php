<?php
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
$fold=".."; require ("../templates/lang.inc");

if (!isset($speek)) {
$speek=$language;
} else {
$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($speek==$stl){
$found_lang=1;
}
}
if ($found_lang==0){
$speek=$language;
}
}

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("../templates/$template/$speek/config.inc");
require ("../modules/translit.php");


require "../modules/functions.php";
require "../templates/$template/css.inc";
$fold=".";
$timestamp=filemtime("$fold/list.txt");
$pubdate = date('D, d M Y H:i:s O', $timestamp);
echo "<?xml version=\"1.0\" encoding=\"$codepage\"?>
<rss version=\"2.0\" xmlns:content=\"http://purl.org/rss/1.0/modules/content/\" xmlns:wfw=\"http://wellformedweb.org/CommentAPI/\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">
<channel>
<title>$shop_name: $lang[908]</title>
<link>$htpath</link>
<description>$lang[909]</description>
<pubDate>$pubdate</pubDate>
<generator>http:/"."/www.eurowebcart.com</generator>
<language>".substr($speek,0,2)."</language>
";


if (function_exists('curl_init')) {
$use_curl=1;
}
$social_user="<i class=icon-user></i>";
$social_link1="";
$social_link2="";
$social_gender="male";
$social_net="";
$social_ava="";
$social_other="";
$social_account="";
$blog_list="";


$yok=0;
$mok=0;
if ((!isset($year))||(!preg_match("/^[0-9]+$/",$year))){ $yok=1; $year=date("Y",time()); }  $year=doubleval($year); if (($year>=9999)||($year<=1)) { $year=date("Y",time()); } //checking valid year
if ((!isset($month))||(!preg_match("/^[0-9]+$/",$month))){$mok=1; $month=date("m",time());} $month=doubleval($month); if ($month<=1) { $month=1; } if ($month>=12) { $month=12; }  //checking valid month
if ($start<0) {$start==0;}
$current_blogdate="";
if (($yok==0)&($mok==0)){ $current_blogdate=" <font size=4> / ".str_replace("1","".$lang[537]." ", str_replace("2","".$lang[538]." ",str_replace("3","".$lang[539]." ",str_replace("4","".$lang[540]." ",str_replace("5","".$lang[541]." ",str_replace("6","".$lang[542]." ",str_replace("7","".$lang[543]." ",str_replace("8","".$lang[544]." ",str_replace("9","".$lang[545]." ",str_replace("10","".$lang[546]." ",str_replace("11","".$lang[547]." ",str_replace("12","".$lang[548]." ",$month))))))))))))." $year</font>";}

$now=mktime(0,0,1,$month,1,$year);
$nowd=date("m.Y",$now);
$today=date("d.m.Y",time());












if(isset($_GET['message_date'])) $message_date=$_GET['message_date']; elseif(isset($_POST['message_date'])) $message_date=$_POST['message_date']; else $message_date="";
$message_date=str_replace("%2f","/",str_replace("%2F","/",$message_date));
if (!preg_match("/^[a-z0-9_\/]+$/i",$message_date)) { $message_date="";}
if(get_magic_quotes_gpc()) {
$message_date = stripslashes($message_date);

}
if ($message_date!="") {
$mes0=explode("/",$message_date);
if (is_dir("$fold/$message_date")==TRUE) {
$month=doubleval($mes0[1]);
$year=$mes0[0];
}
}

if(isset($_GET['topic_del'])) $topic_del=$_GET['topic_del']; elseif(isset($_POST['topic_del'])) $topic_del=$_POST['topic_del']; else $topic_del="";
$topic_del=str_replace("%2f","/",str_replace("%2F","/",$topic_del));
if (!preg_match("/^[a-z0-9_\/]+$/i",$topic_del)) { $topic_del="";}
$flood="";
$comments_found=0;
$blog_delc="";

if(isset($_GET['hidecomm'])) $hidecomm=$_GET['hidecomm']; elseif(isset($_POST['hidecomm'])) $hidecomm=$_POST['hidecomm']; else $hidecomm="";
if (!preg_match("/^[no]+$/i",$hidecomm)) { $hidecomm="";}
$hidecomm=substr($hidecomm, 0, 10);
if(isset($_GET['oauth_provider'])) { $oauth_provider=$_GET['oauth_provider']; }
if (!preg_match("/^[a-z]+$/i",$oauth_provider)) { $oauth_provider="";}
$oauth_provider=substr($oauth_provider, 0, 10);
if(isset($_GET['message'])) $message=$_GET['message']; elseif(isset($_POST['message'])) $message=$_POST['message']; else $message="";
$message=str_replace("%2f","/",str_replace("%2F","/",$message));
if (!preg_match("/^[a-z0-9_\/]+$/i",$message)) { $message="";}
if(isset($_GET['editmessage'])) $editmessage=$_GET['editmessage']; elseif(isset($_POST['editmessage'])) $editmessage=$_POST['editmessage']; else $editmessage="";
$editmessage=str_replace("%2f","/",str_replace("%2F","/",$editmessage));
if (!preg_match("/^[a-z0-9_\/]+$/i",$editmessage)) { $editmessage="";}




if(isset($_GET['tread'])) $tread=$_GET['tread']; elseif(isset($_POST['tread'])) $tread=$_POST['tread']; else $tread="";
if (!preg_match("/^[a-z0-9\.]+$/i",$tread)) { $tread="";}

if(isset($_GET['social_net'])) $social_net=$_GET['social_net']; elseif(isset($_POST['social_net'])) $social_net=$_POST['social_net']; else $social_net="";
if (!preg_match("/^[a-z0-9]+$/i",$social_net)) { $social_net="";}
if(isset($_GET['social_account'])) $social_account=$_GET['social_account']; elseif(isset($_POST['social_account'])) $social_account=$_POST['social_account']; else $social_account="";
if (!preg_match("/^[a-z0-9]+$/i",$social_account)) { $social_account="";}
if(isset($_GET['social_other'])) $social_other=$_GET['social_other']; elseif(isset($_POST['social_other'])) $social_other=$_POST['social_other']; else $social_other="";
if (!preg_match("/^[а-€ј-яa-zA-Z0-9_-]+$/i",$social_other)) { $social_other="";}
if(isset($_GET['social_gender'])) $social_gender=$_GET['social_gender']; elseif(isset($_POST['social_gender'])) $social_gender=$_POST['social_gender']; else $social_gender="";
if (!preg_match("/^[femal]+$/i",$social_gender)) { $social_gender="";}
if(isset($_GET['social_ava'])) $social_ava=$_GET['social_ava']; elseif(isset($_POST['social_ava'])) $social_ava=$_POST['social_ava']; else $social_ava="";
if (!preg_match("/^[a-zAZ0-9\._-]+$/i",$social_ava)) { $social_ava="";}

if(isset($_GET['blog_checkbox'])) $blog_checkbox=$_GET['blog_checkbox']; elseif(isset($_POST['blog_checkbox'])) $blog_checkbox=$_POST['blog_checkbox']; else $blog_checkbox="";
if (!preg_match("/^[a-z0-9\.]+$/i",$blog_checkbox)) { $blog_checkbox="";}
if(isset($_GET['blog_delcom'])) $blog_delcom=$_GET['blog_delcom']; elseif(isset($_POST['blog_delcom'])) $blog_delcom=$_POST['blog_delcom']; else $blog_delcom="";
if (!preg_match("/^[a-z0-9\.]+$/i",$blog_delcom)) { $blog_delcom="";}
if(isset($_GET['exp'])) $exp=$_GET['exp']; elseif(isset($_POST['exp'])) $exp=$_POST['exp']; else $exp="";
if (!preg_match("/^[a-z0-9]+$/i",$exp)) { $exp="";}
$exp=substr($exp, 0, 10);
if(isset($_GET['name'])) $name=$_GET['name']; elseif(isset($_POST['name'])) $name=$_POST['name']; else $name="";
if (!isset($name)){$name="";} $name=trim($name);
$name = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $name); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $name);  $name = str_replace(chr(27), "", $name); $name = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$name))); $name = str_replace(chr(10), "", $name);
$name=substr($name, 0, 80);
if (($name=="")&&($details[1]!="")) {$name=$details[1];}
if(isset($_GET['topic'])) $topic=$_GET['topic']; elseif(isset($_POST['topic'])) $topic=$_POST['topic']; else $topic="";
if (!isset($topic)){$topic="";} $topic=trim($topic);
$topic=substr($topic, 0, 80);
$topic = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $topic); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $topic);  $topic = str_replace(chr(27), "", $topic); $topic = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$topic))); $topic = str_replace(chr(10), "", $topic);

if(isset($_GET['cmntsent'])) $cmntsent=$_GET['cmntsent']; elseif(isset($_POST['cmntsent'])) $cmntsent=$_POST['cmntsent']; else $cmntsent="";

if (!isset($cmntsent)){$cmntsent="";} $cmntsent=trim($cmntsent);
$cmntsent=substr($cmntsent, 0, 2000);$cmntsent = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $cmntsent); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $cmntsent);  $cmntsent = str_replace(chr(27), "", $cmntsent); $cmntsent = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$cmntsent))); $cmntsent = str_replace(chr(10), "[br]", $cmntsent);
if(isset($_GET['blogtags'])) $blogtags=$_GET['blogtags']; elseif(isset($_POST['blogtags'])) $blogtags=$_POST['blogtags']; else $blogtags="";
if (!isset($blogtags)){$blogtags="";}


if(isset($_GET['blogicon'])) $blogicon=$_GET['blogicon']; elseif(isset($_POST['blogicon'])) $blogicon=$_POST['blogicon']; else $blogicon="";
if (!isset($blogicon)){$blogicon="";}
if(isset($_GET['topicdesc'])) $topicdesc=$_GET['topicdesc']; elseif(isset($_POST['topicdesc'])) $topicdesc=$_POST['topicdesc']; else $topicdesc="";
if (!isset($topicdesc)){$topicdesc="";}
if(isset($_GET['newtopic'])) $newtopic=$_GET['newtopic']; elseif(isset($_POST['newtopic'])) $newtopic=$_POST['newtopic']; else $newtopic="";
if (!isset($newtopic)){$newtopic="";}
$newtopic = str_replace(chr(27), "", $newtopic); $newtopic = str_replace(chr(13), "", $newtopic); $newtopic = str_replace(chr(10), "<br>", $newtopic);
if(isset($_GET['tag'])) $tag=$_GET['tag']; elseif(isset($_POST['tag'])) $tag=$_POST['tag']; else $tag="";
if (!isset($tag)){$tag="";} $tag=trim($tag);
$tag=substr($tag, 0, 2000);$tag = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $tag); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $tag);  $tag = str_replace(chr(27), "", $tag); $tag = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$tag))); $tag = str_replace(chr(10), "", $tag);
$tag=substr($tag, 0, 300);
$tread=substr($tread, 0, 300);
$tmp0=Array();
$tmp0=explode("/",$message);
if(get_magic_quotes_gpc()) {
$blogtags = stripslashes($blogtags);
$tag = stripslashes($tag);
$newtopic = stripslashes($newtopic);
$topicdesc = stripslashes($topicdesc);
$blogicon = stripslashes($blogicon);
$cmntsent = stripslashes($cmntsent);
$topic = stripslashes($topic);
$name = stripslashes($name);
$tread = stripslashes($tread);
$message = stripslashes($message);
$topic_del = stripslashes($topic_del);
$social_ava = stripslashes($social_ava);
$social_other = stripslashes($social_other);
$social_gender = stripslashes($social_gender);
$social_net = stripslashes($social_net);
}

$calendar="";
if ($message==""){
$bloglistfile="$fold/list.txt";
$mesex=0;
if ($message_date!="") {
$mes0=explode("/",$message_date);
if (is_dir("$fold/$message_date")==TRUE) {
$bloglistfile="$fold/$mes0[0]/$mes0[1]/$mes0[2]/list.txt";
$mesex=1;
}
}
if ($mesex==0) {
if ($month<10){$cmonth="0".$month;} else { $cmonth="$month"; }
if (($month!="")&&($year!="")&&(file_exists("$fold/$year/$cmonth/list.txt")==TRUE)) {$bloglistfile="$fold/$year/$cmonth/list.txt";}
}
if (file_exists($bloglistfile)==TRUE) {
$list=array_reverse(file($bloglistfile));
$ff=0;
$fff=0;
while(list($key,$val)=each($list)) {
//echo ($start+$blog_perpage). ">$ff>=$start $val<br>";
//if (($start+$blog_perpage)<=$ff) {continue;}
if ((($start+$blog_perpage)>$ff)&&($ff>=$start)) {

$tmp=explode("|",$val);
//echo $val."<br>";
$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3].txt";
//echo "$start $ff $tmp[3].txt<br>";
$con=$lang[921];
$com=$lang[920];
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$con=@fread($blogfilep,@filesize($cf));
fclose ($blogfilep);
}
$all=$con;
$con=strtoken($con,"[cut]");

if ($all!=$con) {$con.="<br><br>ї <a href=\"index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]#cut\">$lang[919]</a>";}
unset ($all);
$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3].cnt";
$cmnts=$lang[920];
$com[0]=0;
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$com=explode("|",@fread($blogfilep,@filesize($cf)));
fclose ($blogfilep);
$social_ico=""; $social_link1="";$social_link2="";
if (($com[6]=="facebook")&&($com[7]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($com[7])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($com[6]=="twitter")&&($com[7]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($com[7])."\">";$social_link2="</a>";}
if (($com[6]=="vkontakte")&&($com[7]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($com[7])."\">";$social_link2="</a>";}
if ((trim($com[8])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($com[8])."\" border=0>$social_link2";} else {$social_ava="";}
if (($com[6]=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

$cmnts="<div><b>".$lang[910].":</b> $com[4] $social_ico$social_user".$social_link1."$com[5]".$social_link2."</div> ";
if ($com[4]=="") {$cmnts="";}
}
$tags="";
$show=0;
$editblog="";
$social_ico=""; $social_link1="";$social_link2="";
if (($tmp[10]=="facebook")&&($tmp[11]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($tmp[11])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($tmp[10]=="twitter")&&($tmp[11]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($tmp[11])."\">";$social_link2="</a>";}
if (($tmp[10]=="vkontakte")&&($tmp[11]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($tmp[11])."\">";$social_link2="</a>";}

if ((trim($tmp[13])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($tmp[13])."\" border=0>$social_link2";} else {$social_ava="";}
if ((trim($tmp[10])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}
$ttime=explode(":",trim($tmp[4]));
$pubdate = date('D, d M Y H:i:s O', mktime(doubleval($ttime[0]), doubleval($ttime[1]), doubleval($ttime[2]), doubleval($tmp[1]), doubleval($tmp[2]), doubleval($tmp[0])));
if ($tag!="") {

if ($tmp[7]!=""){
$t=explode(",",$tmp[7]);
while(list($key1,$val1)=each($t)) {
$val1=trim(trim($val1));
//echo $val1;
$tags.="<category><![CDATA[".$val1."]]></category>\n";
if ($tag!="") {if ($tag==$val1) { $show=1;$ff+=1;}
}
}
if ($tag=="") {$show=1;}
if ($show==1) {
//поиск по тегам
if ($tmp[6]!="") {$ddd="<i>".$tmp[6]."</i><br><br>";} else {$ddd="";}
$s1000=substr($con,0,5000);
if ($s1000!=$con) {$s1000.=" [...]";}
$blog_list.="<item>
<title>$tmp[5]</title>
<link>$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</link>
<comments>$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]#view_comments</comments>
<pubDate>$pubdate</pubDate>
<dc:creator>$tmp[12]</dc:creator>
$tags
<guid isPermaLink=\"false\">$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</guid>
<description><![CDATA[$ddd".$s1000."]]></description>
<wfw:commentRss>$htpath/blog/rss.php&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</wfw:commentRss>
</item>
";
$fff+=1;
}
}
} else {
$ff+=1;
//без поиска по тегам
if ($tmp[7]!=""){
$t=explode(",",$tmp[7]);
while(list($key1,$val1)=each($t)) {
$val1=trim(trim($val1));
$tags.="<category><![CDATA[".$val1."]]></category>\n";
}
}
if ($tmp[6]!="") {$ddd="<i>".$tmp[6]."</i><br><br>";} else {$ddd="";}
$s1000=substr($con,0,5000);
if ($s1000!=$con) {$s1000.=" [...]";}
$blog_list.="<item>
<title>$tmp[5]</title>
<link>$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</link>
<comments>$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]#view_comments</comments>
<pubDate>$pubdate</pubDate>
<dc:creator>$tmp[12]</dc:creator>
$tags
<guid isPermaLink=\"false\">$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</guid>
<description><![CDATA[$ddd".$s1000."]]></description>
<wfw:commentRss>$htpath/blog/rss.php&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</wfw:commentRss>
</item>
";
$fff+=1;
}
unset($tmp,$cf,$blogfilep,$con,$com,$cmnts,$t,$tags,$key1,$val1,$show);
} else {
$ff+=1;
}

}
//echo $ff." $blog_perpage>".$fff."? ".count($list);

//$blog_list.="<iframe src=\"http://www.facebook.com/plugins/like.php?href=$htpath/index.php?action=blog\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; width:450px; height:80px\"></iframe>";

unset ($key,$val,$list);
}



} else {

if (file_exists("$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/list.txt")==TRUE) {
if (!isset($listbl[$message])){$listbl[$message]=file("$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/list.txt"); } else {reset($listbl[$message]);}
while(list($key,$val)=each($listbl[$message])) {
$tmp=explode("|",$val);
if (($tmp[0]==$tmp0[0])&&($tmp[1]==$tmp0[1])&&($tmp[2]==$tmp0[2])&&($tmp[3]==$tmp0[3])) {
$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3].txt";
$con=$lang[921];
$com=$lang[920];
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$con=@fread($blogfilep,@filesize($cf));
fclose ($blogfilep);
}
$con=str_replace("[cut]","<a name=\"cut\"></a>",$con);
$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3].cnt";
$cmnts=$lang[920];
$com[0]=0;
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$com=explode("|",@fread($blogfilep,@filesize($cf)));
fclose ($blogfilep);
$social_ico=""; $social_link1="";$social_link2="";
if (($com[6]=="facebook")&&($com[7]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($com[7])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($com[6]=="twitter")&&($com[7]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($com[7])."\">";$social_link2="</a>";}
if (($com[6]=="vkontakte")&&($com[7]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($com[7])."\">";$social_link2="</a>";}

if ((trim($com[8])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($com[8])."\" border=0>$social_link2";} else {$social_ava="";}
if ((trim($com[6])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

$cmnts="<div><b>".$lang[910].":</b> $com[4] $social_ico$social_user".$social_link1."$com[5]".$social_link2."</div> ";
if ($com[4]=="") {$cmnts="";}
}
$tags="";
if ($tmp[7]!=""){
$t=explode(",",$tmp[7]);
while(list($key1,$val1)=each($t)) {
$val1=trim(trim($val1));
$tags.="<category><![CDATA[".$val1."]]></category>\n";
}
}
$social_ico=""; $social_link1="";$social_link2="";
if (($tmp[10]=="facebook")&&($tmp[11]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($tmp[11])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($tmp[10]=="twitter")&&($tmp[11]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($tmp[11])."\">";$social_link2="</a>";}
if (($tmp[10]=="vkontakte")&&($tmp[11]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($tmp[11])."\">";$social_link2="</a>";}

if ((trim($tmp[13])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($tmp[13])."\" border=0>$social_link2";} else {$social_ava="";}
if ((trim($tmp[10])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}
if ($tmp[6]!="") {$ddd="<i>".$tmp[6]."</i><br><br>";} else {$ddd="";}
$s1000=substr($con,0,5000);
if ($s1000!=$con) {$s1000.=" [...]";}
$blog_list.="<item>
<title>$tmp[5]</title>
<link>$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</link>
<comments>$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]#view_comments</comments>
<pubDate>$pubdate</pubDate>
<dc:creator>$tmp[12]</dc:creator>
$tags
<guid isPermaLink=\"false\">$htpath/index.php?action=blog&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</guid>
<description><![CDATA[$ddd".$s1000."]]></description>
<wfw:commentRss>$htpath/blog/rss.php&amp;message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]</wfw:commentRss>
</item>
";
//show comments
$cmnts="";
if (($enable_blog_comments==1)&&($tmp[9]=="YES")) {
if ($com[0]>0) {

$cmntsents=Array();
$handle=opendir("$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3]");
while (($blogfile = @readdir($handle))!==FALSE) {
if (($blogfile == '.') || ($blogfile == '..')) {
continue;
} else {
$cmntsents[$blogfile]=file("$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3]/".$blogfile);
$dates[$blogfile]=filemtime("$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3]/".$blogfile);
}
}
@closedir($handle);
ksort($cmntsents);
reset($cmntsents);

while(list($key,$val)=each($cmntsents)) {
$q=explode(".",$key);
$quotes=(10*(count($q)-1))+1;
$color=lighter("#".substr(md5("$htpath.$quotes"),0,6),80);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$blog_delc="  &nbsp;  &nbsp;  <a href=\"index.php?action=blog&exp=$exp&message=$message&blog_delcom=$key#comment_$message/$key\"><font color=#b94a48>X</font> ".$lang[744]."</a>";
}}
if ((trim($val[0])=="")&&(trim($val[1])=="")&&(trim($val[2])=="")) {$cmnts.="<a name=\"comment_$message/$key\"></a>";} else {
$blogreply="<a href=\"#reply\" onclick=\"javascript:document.getElementById('s_$key').style.display='none';document.getElementById('s_$key').style.visibility='hidden';document.getElementById('dd_$key').style.display='';document.getElementById('dd_$key').style.visibility='visible';\">";
$blogreply2="</a>";
$blreply="<a href=\"#reply\" onclick=\"javascript:document.getElementById('s_$key').style.display='';document.getElementById('s_$key').style.visibility='visible';document.getElementById('dd_$key').style.display='none';document.getElementById('dd_$key').style.visibility='hidden';\">";
$blreply2="</a> [+]";
if (trim($val[0])=="") {if (strlen(trim($val[2])<40)) { $val[0]=str_replace("<br>", " ", $val[2]); $blogreply2.=" "; $blreply2="</a>";  $val[2]="";} else {$val[0]=substr(str_replace("<br>", " ",$val[2]),0,40)."... [+]"; }} else {
$val[2]="<br>".$val[2]."<br>"; }
$comments_found+=1;
$tmp=explode("|",$val[1]);
$val[1]=$tmp[0];
$social_ico=""; $social_link1="";$social_link2="";
if (($tmp[1]=="facebook")&&($tmp[2]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($tmp[2])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($tmp[1]=="twitter")&&($tmp[2]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($tmp[2])."\">";$social_link2="</a>";}
if (($tmp[1]=="vkontakte")&&($tmp[2]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($tmp[2])."\">";$social_link2="</a>";}

if ((trim($tmp[3])!="")){$social_ava="<div style=\"float:left; margin-right:10px; margin-bottom:5px;\">$social_link1<img src=\"gallery/avatars/".trim($tmp[3])."\" border=0 width=25 height=25>$social_link2</div>";} else {$social_ava="";}
if ((trim($tmp[1])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

if (($exp=="")&&($quotes>1)) {
$cmnts.="<a name=\"comment_$message/$key\"></a><div style=\"overflow: hidden; width:100%\"><table border=0 width=100%><tr><td><img src=$image_path/pix.gif height=10 width=$quotes></td><td width=100%>
<div id=\"dd_$key\">$social_ava"."$blreply".trim(trim($val[0]))."$blreply2 &nbsp; $social_ico$social_user<b>".$social_link1."$val[1]".$social_link2."</b>$blog_delc</div>
<div id=\"s_$key\" style=\"display:none; vilibility:hidden\">
<div class=round2 style=\"float:left; overflow: hidden; width:97%; border: 1px solid $color; background: ".lighter($color,100).";\">"."$social_ava".""."<div class=comm style=\"float:right; width:160px;background: $color; border: 1px solid ".lighter($color,-50).";\" align=center>".date("Y/m/d H:i:s" , $dates[$key])."</div><div>$blogreply<b><font size=3>".trim(trim($val[0]))."</font></b>$blogreply2 &nbsp; $social_ico$social_user <b>".$social_link1."$val[1]".$social_link2."</b><br>$val[2]
<br><div id=\"d_$key\"><a href=\"#reply\" onclick=\"javascript:document.getElementById('$key').style.display='';document.getElementById('$key').style.visibility='visible';document.getElementById('d_$key').style.display='none';document.getElementById('d_$key').style.visibility='hidden';\">$lang[806]</a>$blog_delc<div style=\"float:right; width:180px;\" align=center><font size=1><a href=\"#comment_$message/$key\">URL</a></font></div></div>
<div id=\"$key\" style=\"display:none; vilibility:hidden\">
<br><form method=POST action=index.php>
<input type=hidden name=tread value=\"$key\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=message value=\"$message\">
<input type=hidden name=social_net value=\"$psocial_net\">
<input type=hidden name=social_other value=\"$psocial_other\">
<input type=hidden name=social_gender value=\"$psocial_gender\">
<input type=hidden name=social_ava value=\"$psocial_ava\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"40\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"40\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:100%\" maxlength=\"1000\"></textarea>
<input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('$key').style.display='none';document.getElementById('$key').style.visibility='hidden';document.getElementById('d_$key').style.display='';document.getElementById('d_$key').style.visibility='visible';\"> &nbsp; <input type=submit value=\"$lang[806]\"></form></div>
</div></div></div>
</td></tr></table></div>";
} else {
$cmnts.="<a name=\"comment_$message/$key\"></a><div style=\"overflow: hidden; width:100%\"><table border=0 width=100%><tr><td><img src=$image_path/pix.gif height=10 width=$quotes></td><td width=100%><div class=round2 style=\"float:left; overflow: hidden; width:97%; border: 1px solid $color; background: ".lighter($color,100).";\">
"."$social_ava"."<div class=comm style=\"float:right; width:160px;background: $color; border: 1px solid ".lighter($color,-50).";\" align=center>".date("Y/m/d H:i:s" , $dates[$key])."</div><div><font size=3><b>$val[0]</b></font> &nbsp; $social_ico$social_user<b>".$social_link1."$val[1]".$social_link2."</b><br>$val[2]
<br><div id=\"d_$key\"><a href=\"#reply\" onclick=\"javascript:document.getElementById('$key').style.display='';document.getElementById('$key').style.visibility='visible';document.getElementById('d_$key').style.display='none';document.getElementById('d_$key').style.visibility='hidden';\">$lang[806]</a>$blog_delc<div style=\"float:right; width:180px;\" align=center><font size=1><a href=\"#comment_$message/$key\">URL</a></font></div></div>
<div id=\"$key\" style=\"display:none; vilibility:hidden\">
<br><form method=POST action=index.php>
<input type=hidden name=tread value=\"$key\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=message value=\"$message\">
<input type=hidden name=social_net value=\"$psocial_net\">
<input type=hidden name=social_other value=\"$psocial_other\">
<input type=hidden name=social_gender value=\"$psocial_gender\">
<input type=hidden name=social_ava value=\"$psocial_ava\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"40\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"40\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:100%\" maxlength=\"1000\"></textarea>
<input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('$key').style.display='none';document.getElementById('$key').style.visibility='hidden';document.getElementById('d_$key').style.display='';document.getElementById('d_$key').style.visibility='visible';\"> &nbsp; <input type=submit value=\"$lang[806]\"></form></div>
</div></div>
</td></tr></table></div>";
}
}
}
}
if ($cmnts=="") {$cmnts="<div>$lang[180]</div>";}
if ($hidecomm=="") {
$blog_list.="<div id=sendcomment style=\"clear:both;\"><div align=center><input type=button value=\"$lang[912]\" onclick=\"javascript:document.getElementById('commentblock').style.display='';document.getElementById('commentblock').style.visibility='visible';document.getElementById('sendcomment').style.display='none';document.getElementById('sendcomment').style.visibility='hidden';\"></div></div>
<div id=commentblock style=\"display: none; visibility: hidden;\">";}
$blog_list.="<a name=\"hidecomm\"></a><div class=round2 style=\"clear:both;\">
<div><b>$lang[912]:</b></div>
<br><form method=POST action=index.php>
<input type=hidden name=social_net value=\"$psocial_net\">
<input type=hidden name=social_other value=\"$psocial_other\">
<input type=hidden name=social_gender value=\"$psocial_gender\">
<input type=hidden name=social_ava value=\"$psocial_ava\">
<input type=hidden name=tread value=\"\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=message value=\"$message\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"40\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"40\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:97%\" maxlength=\"1000\"></textarea>";
if ($hidecomm=="") {
$blog_list.="<input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('commentblock').style.display='none';document.getElementById('commentblock').style.visibility='hidden';document.getElementById('sendcomment').style.display='';document.getElementById('sendcomment').style.visibility='visible';\"> &nbsp; ";}
$blog_list.="<input type=submit value=\"$lang[806]\"></form>";
if ($hidecomm=="") {$blog_list.="</div>";}

$blog_list.="</div><a name=\"view_comments\"></a> <br>
<div class=comm style=\"overflow: hidden;\">
<table border=0 width=100%><tr><td valign=top>
<font size=3><b>".$lang[8].":</b></font></td><td valign=top align=right><a href=\"index.php?action=blog&message=$message&exp=#view_comments\">";
if ($exp=="") { $blog_list.="<b>"; }
$blog_list.=$lang[913];
if ($exp=="") { $blog_list.="</b>"; }
$blog_list.="</a> | <a href=\"index.php?action=blog&message=$message&exp=yes#view_comments\">";
if ($exp=="yes") { $blog_list.="<b>"; }
$blog_list.=$lang[914];
if ($exp=="yes") { $blog_list.="</b>"; }
$blog_list.="</a></td></tr></table></div>$flood<br>
$cmnts
</div>
</div>";
}
unset($tmp,$cf,$blogfilep,$con,$com,$cmnts,$t,$tags,$key1,$val1,$tmp0,$blogfile,$handle,$cmnts,$q,$listbl);
break;
}
}

unset($key,$val,$list);
}
}
echo "$blog_list
	</channel>
</rss>";
?>
