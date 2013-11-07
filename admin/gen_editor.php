<!DOCTYPE html><html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Form editor</title>
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
$fold="..";
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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
require ("../templates/$template/css.inc");
echo "<STYLE type=\"text/css\">BODY {
        COLOR: #000000; FONT: 9pt Verdana; MARGIN: 5px 5px 10px
}
BODY A:link {
        COLOR: #555555; TEXT-DECORATION: none
}
BODY A:visited {
        COLOR: #555555; TEXT-DECORATION: none
}
BODY A:hover {COLOR: #555555; TEXT-DECORATION: underline
}
BODY A:active {
        COLOR: #555555; TEXT-DECORATION: underline
}

.file a:link {
        COLOR: #555555; TEXT-DECORATION: none
}
.file a:visited {
        COLOR: #555555; TEXT-DECORATION: none
}
.file a:hover { COLOR: #ff4444; TEXT-DECORATION: underline
}
.file a:active {
        COLOR: #ff4444; TEXT-DECORATION: underline
}

.lk {
        COLOR: #ffffff; TEXT-DECORATION: none
}
.in {
float: left;
align: center;
margin: 10;
padding: 10;
}
.out {
overflow: scroll;
align: center;
margin: 10;
padding: 10;
width: 100%;
}

small {
        FONT: 8pt Verdana
}
TD {
        FONT: 9pt Verdana
}
TH {
        FONT: 9pt Verdana
}
P {
        FONT: 9pt Verdana
}
LI {
        FONT: 9pt Verdana
}

SELECT {
        FONT: 9pt Verdana
}

FORM {
        DISPLAY: inline;
}
LABEL {
        CURSOR: default;
}
.normal {
        FONT-WEIGHT: normal;
}
.load {
background-image: url('images/ind.gif'); background-repeat: none; background-position: center
}
a.menu { color: black; }
.ALERT  { font-size: 12; color: red; font-weight:400; }
.ROW {  padding: 4px; color:black; font-weight:400; background-color: #ffffff; }

/*ol.results {margin:0 40px 1.7em 40px; padding:0 0 0 40px}*/
ol.results {margin:0 40px 0 40px; padding:0 0 0 40px}

ol.results li {margin-bottom:1em; padding:0;}
ol.results div.text {font-size:80%; padding-bottom:0.1em;}
ol.results div.info {font-size:80%; color:#333333; margin-top:0.3em;}
ol.results div.info a {color:#000000;}
ol.results div.info a:visited {color:#800080;}
H1 {
        padding : 5px 10px 5px 0px;
        margin : 0px 0px 0px 0px;
        font-size : 14px;
        font-weight : bolder;
}

</STYLE>";
echo "</head><body>

<script language=\"javascript\">
<!--
function savedata () {
document.forms[0].act.value=\"save\";
document.forms[0].submit();
}
function loaddata () {
document.forms[0].act.value=\"load\";
document.forms[0].submit();
}
function cleardata () {
document.forms[0].act.value=\"clear\";
document.forms[0].submit();
}
-->
</script>
";
//echo "action=$act";
if ((!@$act) ||(@$act=="")): $act="load"; endif;

$arr=array ("gentext","gennazv","genkewrds","gensites","genhtmlcode","genhtmlcodeimg","genbackmail","genlinkurl","genopis","genrazdel");

//Загрузка данных
if ($act=="load") {
echo "<h4><b>Загрузка данных</b></h4>";
while (list ($line_num, $a) = each ($arr)) {
$filename="./obmen_data/$a.txt";
if (@file_exists($filename)==FALSE){
echo "<font color=#b94a48>Файл $filename не найден!</font><br>";
}else{
$file = fopen ($filename, "r");
$$a=@fread($file, @filesize($filename));
fclose ($file);
//echo "<font color=#468847>Файл $filename загружен</font><br>";
}
}
}

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
if ($act=="save") {
echo "<h4><b>Сохранение данных</b></h4>";
while (list ($line_num, $a) = each ($arr)) {
$filename="./obmen_data/$a.txt";
$file = fopen ($filename, "w");
if (!$file) {
echo "<p><font color=#b94a48>Не могу открыть файл <b>$filename</b> для записи.</font><br>\n";
exit;
}
fputs ($file, $$a);
//echo "<font color=#468847>Файл $filename записан.</font><br>";
fclose ($file);
}
}

//Очистка данных
if ($act=="clear"){
echo "<h4><b>Очистка данных</b></h4>";
$gentext="";
$genkewrds="";
$gensites="";
$genkeywords="";
$genhtmlcode="";
$genbackmail="";
$genlinkurl="";
echo "<font color=#468847>Вернул значения данных по умолчанию</font><br>";
}
if ($act=="gen"){
echo "<h4><b>Генерация уникальности</b></h4>";
$genkewrds_arr=explode("\n", $genkewrds);
$gennazv_arr=explode("\n", $gennazv);
$gentext_arr=explode("\n", $gentext);
$genopis_arr=explode("\n", $genopis);
srand ((double)microtime()*1000000);
shuffle($gennazv_arr);
srand ((double)microtime()*1000000);
shuffle($gentext_arr);
srand ((double)microtime()*1000000);
shuffle($genopis_arr);
$genhtmlcode=str_replace("[site_url]", $gensites, $genhtmlcode);
$genhtmlcodeimg=str_replace("[site_url]", $gensites, $genhtmlcodeimg);

$tmparr=Array("[r1]", "[r2]","[r3]","[r4]","[r5]","[r6]","[r7]","[r8]","[r9]","[r10]","[r11]","[r12]", "[r13]","[r14]","[r15]","[r15]");
reset($tmparr);
srand ((double)microtime()*1000000);
shuffle($tmparr);
unset($line_num, $key, $regs);

while (list ($line_num, $key) = each ($tmparr)) {

$gennazv_arr[0]=str_replace($key, $genkewrds_arr[$line_num], $gennazv_arr[0]);

$gentext_arr[0]=str_replace($key, $genkewrds_arr[$line_num], $gentext_arr[0]);

$genopis_arr[0]=str_replace($key, $genkewrds_arr[$line_num], $genopis_arr[0]);

$genhtmlcode=str_replace($key, $genkewrds_arr[$line_num], $genhtmlcode);

$genhtmlcodeimg=str_replace($key, $genkewrds_arr[$line_num], $genhtmlcodeimg);

}

echo "$gennazv_arr[0]<br><br>\n\n$gentext_arr[0]<br><br>\n\n$genopis_arr[0]<br><br>\n\n$genhtmlcode<br><br>\n\n$genhtmlcodeimg";

}

if ((!@$text) ||(@$text=="")): $text="Уважаемый [b][email][/b]!

Если Вы содержите сайты по тематике:
[b]Игры, игровые приставки, flash-игры, компьютерные игры, и т.п.[/b]

Предлагаем Вам тематический обмен ссылками с  нашими сайтами PR(3+) , ТИЦ (750+):

[site_urls]
Для этого разместите наш код и пришлите адрес странички, где Вы его разместили, вместе со своим HTML кодом.

В течении суток Мы его установим на наших сайтах по адресу:

[link_urls]
[b]Наши HTML-коды для вставки на ваш сайт:[/b]"; endif;
if ((!@$kewrds) ||(@$kewrds=="")): $kewrds=""; endif;
if ((!@$backmail) ||(@$backmail=="")): $backmail=""; endif;
if ((!@$sites) ||(@$sites=="")): $sites=""; endif;
if ((!@$keywords) ||(@$keywords=="")): $keywords=""; endif;
if ((!@$htmlcode) ||(@$htmlcode=="")): $htmlcode="<!-- [site_url] -->\n<b><a href=\"[site_url]\">[random]</a></b>, <b><a href=\"[site_url]\">[random]</a></b>\n<!-- end -->"; endif;
echo "<hr>";
echo "<h4><b>Обмен ссылками</b></h4>
<form method=\"POST\" action=\"gen_editor.php?speek=$speek\"><input type=hidden name=\"act\" value=\"save\">
                <table border=\"0\" width=\"100%\">
                <tr>
                        <td valign=\"top\">Введите список ключевых слов<br>
                        (каждый на новой строке):<p>
                        <textarea rows=\"56\" name=\"genkewrds\" cols=\"30\">$genkewrds</textarea></td>
                        <td valign=\"top\"><p>URL Сайта:</p>
            <p><input type=text name=\"gensites\" size=\"60\" value=\"$gensites\">
            <p>Названия Сайта (каждое на новой строке):</p>
            <p><textarea rows=\"19\" name=\"gennazv\" cols=\"60\">$gennazv</textarea></p>
            <p>Краткое описание (каждое на новой строке):</p><p>
                        <textarea rows=\"19\" name=\"gentext\" cols=\"60\">$gentext</textarea></p>
            Полное описание(каждое на новой строке):<p>
                        <textarea rows=\"19\" name=\"genopis\" cols=\"60\">$genopis</textarea></p>
                        <p>Код ссылки:</p>
                        <p><textarea rows=\"5\" name=\"genhtmlcode\" cols=\"60\">$genhtmlcode
</textarea></p>
<p>Код картинки:</p>
                        <p><textarea rows=\"5\" name=\"genhtmlcodeimg\" cols=\"60\">$genhtmlcodeimg
</textarea></p>

<p>Относительная ссылка где будут устанавливаться HTML коды: <small>(index.php?page=s0001)</small></p>
<input type=\"text\" name=\"genlinkurl\" value=\"$genlinkurl\" size=76>
<p>Обратный адрес:</p>
<input type=\"text\" name=\"genbackmail\" value=\"$genbackmail\" size=30>
</td>
                </tr>
        </table>
        <div align=\"center\"><input type=\"button\" value=\"Очистить\" onclick=\"javascript:cleardata()\">&nbsp;&nbsp;<input type=\"button\" value=\"Загрузить данные\" onclick=\"javascript:loaddata()\">&nbsp;&nbsp;<input type=\"button\" value=\"Сохранить данные\" onclick=\"javascript:savedata()\"></form><br><br><form method=\"POST\" action=\"generator.php?speek=$speek\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Начать генерацию\"></form>
        </div>
 ";

?>

</body>

</html>
