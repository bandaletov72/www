<?php
if (version_compare(phpversion(), "4.1.0", "<") === true) {
$_GET &= $HTTP_GET_VARS;
$_POST &= $HTTP_POST_VARS;
$_SERVER &= $HTTP_SERVER_VARS;
$_FILES &= $HTTP_POST_FILES;
$_ENV &= $HTTP_ENV_VARS;

if (isset($HTTP_COOKIE_VARS)) $_COOKIE &= $HTTP_COOKIE_VARS;
}

if (!ini_get("register_globals")) {
extract($_GET, EXTR_SKIP);
extract($_POST, EXTR_SKIP);
extract($_COOKIE, EXTR_SKIP);

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

echo "<!DOCTYPE html><html>

<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>Mailing</title>
</head>

<body>
<script language=\"javascript\">
<!--
function savedata () {
document.forms[0].action.value=\"save\";
document.forms[0].submit();
}
function loaddata () {
document.forms[0].action.value=\"load\";
document.forms[0].submit();
}
function cleardata () {
document.forms[0].action.value=\"clear\";
document.forms[0].submit();
}
-->
</script>";
if ((!@$action) ||(@$action=="")): $action="load"; endif;

$arr=array ("text","emails","sites","keywords","htmlcode","backmail","linkurl","tema");

//Загрузка данных
if (($action=="load")||($action=="addusers")) {
echo "<h4><b>Loading data...</b></h4>";
while (list ($line_num, $a) = each ($arr)) {
$filename="./obmen_data/$a.txt";
if (@file_exists($filename)==FALSE){
echo "<font color=#b94a48>File $filename not found!</font><br>";
}else{
$file = fopen ($filename, "r");
$$a=@fread($file, @filesize($filename));
fclose ($file);
echo "<font color=#468847>File $filename loaded OK</font><br>";
}
}
}

$tmpemails=explode("\n", $emails);

if ($action=="addusers") {

//Из пользователей
$count=count($tmpemails);
echo "<h4><b>Loading user E-mail...</b></h4>";
$filename="./db/users.txt";
$userlist1=Array();
if (@file_exists($filename)) {


$userlist1=@file($filename);
}

$filename="./db/tmp_users.txt";
$userlist2=Array();
if (@file_exists($filename)) {
$userlist2=@file($filename);
}
$userlist=array_merge($userlist1,$userlist2);

$handle=opendir("./userstat/");
unset($fillez);
while (($file = readdir($handle))!==FALSE) {

if ((is_dir($file)==TRUE) ||(substr($file,-4)!=".txt")){
continue;
} else {
$userlist[]=@file("./userstat/$file");

}
}

closedir ($handle);

echo "<font color=#468847>File $filename loaded OK</font><br>";
reset ($userlist);
while (list ($key, $st) = each ($userlist)) {
$stmass=explode("|",$st);
$count+=1;
$tmpemails[$count]=$stmass[4];
}


//Из заказов

$count=count($tmpemails);
echo "<h4><b>Loading order E-mail...</b></h4>";

$filename="./baskets/list.txt";
if (@file_exists($filename)==FALSE){
echo "<font color=#b94a48>File $filename not found!</font><br>";
}else{
$userlist=file($filename);
echo "<font color=#468847>File $filename loaded OK</font><br>";
reset ($userlist);
while (list ($key, $st) = each ($userlist)) {
$stmass=explode("|",$st);
$count+=1;
$tmpemails[$count]=$stmass[2];
}
}

$filename="./baskets/list2.txt";
if (@file_exists($filename)==FALSE){
echo "<font color=#b94a48>File $filename not found!</font><br>";
}else{
$userlist=file($filename);
echo "<font color=#468847>File $filename loade OK</font><br>";
reset ($userlist);
while (list ($key, $st) = each ($userlist)) {
$stmass=explode("|",$st);
$count+=1;
$tmpemails[$count]=$stmass[2];
}
}


}

$r=array_unique($tmpemails);
unset($tmpemails);
reset($r);
sort($r);
$emails=implode("\n",$r);

reset($arr);

while (list ($line_num, $a) = each ($arr)) {
$$a = str_replace(chr(92) , "", @$$a); // strip backslash
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = str_replace("  " , " ", $$a);
$$a = stripslashes($$a);
}

reset ($arr);

//Сохранение данных
if ($action=="save") {
echo "<h4><b>Saving data...</b></h4>";
while (list ($line_num, $a) = each ($arr)) {
$filename="./obmen_data/$a.txt";
$file = fopen ($filename, "w");
if (!$file) {
echo "<p><font color=#b94a48>Error writing to file <b>$filename</b></font><br>\n";
exit;
}
fputs ($file, $$a);
echo "<font color=#468847>File $filename writing OK.</font><br>";
fclose ($file);
}
}

//Очистка данных
if ($action=="clear"){
echo "<h4><b>Clear data...</b></h4>";
$text="";
$emails="";
$sites="";
$keywords="";
$htmlcode="";
$backmail="";
$linkurl="";
echo "<font color=#468847>Return to defaults</font><br>";
}
if ($action=="start"){
echo "<h4><b>Mailing...</b></h4>";
$emails_arr=explode("\n", $emails);
unset($line_num, $key, $regs);
while (list ($line_num, $key) = each ($emails_arr)) {
if (preg_match("/^[0-9a-zA-Z\._-\@]+$/i",$key, $regs)){
$text_mail=str_replace("[email]",str_replace("@","",$regs[1]), $text);
$sites_arr=explode("\n", $sites);
unset($line_num2, $key2, $urls);
while (list ($line_num2, $key2) = each ($sites_arr)) {

$urls[$key2]=$key2;

}
unset($line_num2, $key2);
$urlist="";
$sitelist="";
$num=1;
$htmllist="";
while (list ($line_num2, $key2) = each ($urls)) {
$urlist.="<a href=\"http://$key2\">$key2</a><br>";
$sitelist.="<a href=\"http://$key2/$linkurl\">http://$key2/$linkurl</a><br>";
$kw_arr=explode("|", $keywords);
$count_kw=count($kw_arr);
$randoms=substr_count("$htmlcode", "[random]");
if ($count_kw<$randoms) {echo "<font color=#b94a48>Please add more keywords! (<b>".($randoms-$count_kw)."</b>) </font><br>"; break;}
$randoms_arr=explode("[random]", $htmlcode);
unset($line_num3, $key3);
srand ((double)microtime()*1000000);
$i=0;
$htmllist.="<br><br>HTML code <b>#$num</b> ($key2):<br><textarea rows=5 cols=60>";
shuffle($kw_arr);
while (list ($line_num3, $key3) = each ($randoms_arr)) {
if($kw_arr[$i]==""):$kw_arr[$i]=$kw_arr[($i+1)];endif;
if ($i<(count($randoms_arr)-1)) {
$htmllist.=$key3.$kw_arr[$i];
} else {
$htmllist.=$key3;
break;
}
$i+=1;
}
$htmllist.="</textarea>";
$htmllist=str_replace("[site_url]","http://$key2", $htmllist);
$num+=1;
}
$text_mail=str_replace("[site_urls]",$urlist, str_replace("[link_urls]",$sitelist, str_replace("\n","<br>", str_replace("[b]","<b>", str_replace("[/b]","</b>", str_replace("[codes]",$htmllist,$text_mail))))))."<hr>";
echo "<b>To: </b><a href=\"mailto:$key\">".$key."</a><hr noshade size=1>".$text_mail."<br>";
$boundary = uniqid( "");
$emailbody = "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">


<title>$tema</title>
</head>
<body>
<font face=Verdana size=2>
$text_mail
".$lang[353]." $boundary </font>
</body>
</html>";
mail ("$key","$tema From: $backmail", $emailbody, "From: $backmail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
echo "<br>$key - <font color=#468847>Sent!</font><br><br><hr>";

}else {
echo "$key - <font color=#b94a48>Wrong email!</font><br>";
}
}
echo "<br><font color=#468847>All done.</font><br>";
}

/*if ((!@$text) ||(@$text=="")): $text="Уважаемый [b][email][/b]!

Если Вы содержите сайты по тематике:
[b]Игры, игровые приставки, flash-игры, компьютерные игры, и т.п.[/b]

Предлагаем Вам тематический обмен ссылками с  нашими сайтами PR(3+) , ТИЦ (750+):

[site_urls]
Для этого разместите наш код и пришлите адрес странички, где Вы его разместили, вместе со своим HTML кодом.

В течении суток Мы его установим на наших сайтах по адресу:

[link_urls]
[b]Наши HTML-коды для вставки на ваш сайт:[/b]

[codes]"; endif;
*/
//if ((!@$emails) ||(@$emails=="")): $emails="xxx@yyy.com\nnobody@nowhere.com"; endif;
//if ((!@$backmail) ||(@$backmail=="")): $backmail="mymail@nowhere.com"; endif;
//if ((!@$sites) ||(@$sites=="")): $sites="www.yyy.com\nwww.nowhere.com"; endif;
//if ((!@$keywords) ||(@$keywords=="")): $keywords="yyy|nowhere|link advertising|marketing"; endif;
//if ((!@$htmlcode) ||(@$htmlcode=="")): $htmlcode="<!-- [site_url] -->\n<b><a href=\"[site_url]\">[random]</a></b>, <b><a href=\"[site_url]\">[random]</a></b>\n<!-- end -->"; endif;
echo "<hr>";
echo "<h4><b>Mailing...</b></h4>
<form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\"><input type=hidden name=\"speek\" value=\"$speek\"><input type=hidden name=\"action\" value=\"start\">
                <table border=\"0\" width=\"100%\">
                <tr>
                        <td valign=\"top\">Enter list of emails<br>
                        (on each row):<p>
                        <textarea rows=\"25\" name=\"emails\" cols=\"30\">$emails</textarea></td>
                        <td valign=\"top\"><br>Email title:
                        <p><input type=\"text\" name=\"tema\" value=\"$tema\" size=76> </p><p>Email text:<p>
                        <textarea rows=\"15\" name=\"text\" cols=\"60\">$text</textarea></p>
                        <!--p>Code:</p>
                        <p><textarea rows=\"5\" name=\"htmlcode\" cols=\"60\">$htmlcode
</textarea></p>
                        <p>Keywords (exploded by \"|\"):</p>
                        <p><textarea rows=\"5\" name=\"keywords\" cols=\"60\">$keywords</textarea></p>
                        <p>Sites URLs(on each row without http://):</p>
                        <p><textarea rows=\"10\" name=\"sites\" cols=\"60\">$sites
</textarea>
<p>Link where you will place back URLS (without site URL): <small>(index.php?page=s0001)</small></p>
<input type=\"text\" name=\"linkurl\" value=\"$linkurl\" size=76-->
<p>Back e-mail:</p>
<input type=\"text\" name=\"backmail\" value=\"$backmail\" size=30>
</td>
                </tr>
        </table>
        <p align=\"center\"><a href=\"".$_SERVER['PHP_SELF']."?speek=$speek&action=addusers\">Load user E-mail</a>&nbsp;&nbsp;&nbsp;<input type=\"button\" value=\"Clear\" onclick=\"javascript:cleardata()\">&nbsp;&nbsp;<input type=\"button\" value=\"Load saved data\" onclick=\"javascript:loaddata()\">&nbsp;&nbsp;<input type=\"button\" value=\"Save data\" onclick=\"javascript:savedata()\">&nbsp;&nbsp;<input type=\"submit\" class=\"btn btn-primary\" value=\"START mailing\"></form>
        </p>
 ";

?>

</body>

</html>