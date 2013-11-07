<!DOCTYPE html><html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Form data generator for linkexchznge</title>

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
echo "</head><body>";




$arr=array ("gentext","gennazv","genkewrds","gensites","genhtmlcode","genhtmlcodeimg","genbackmail","genlinkurl","genopis","genrazdel");

//Загрузка данных

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




echo "<form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\"><input type=hidden name=\"action\" value=\"gen\">
                <table border=\"0\" width=\"100%\" cellpadding=5>
                <tr>
                        <td valign=\"top\">Наши Ключевые слова:<br>
                        <textarea rows=\"20\" name=\"genkewrds\" cols=\"30\">".implode(" ", $genkewrds_arr)."</textarea><a href=\"#copy\" onClick=\"javascript:document.forms[0].genkewrds.createTextRange().execCommand('Copy')\">Copy</a><br><br>$genhtmlcode<br><br>$genhtmlcodeimg</td>
                        <td valign=\"top\" width=100%>URL Сайта:<br>
            <input type=text name=\"gensites\" size=\"60\" value=\"$gensites\"><a href=\"#copy\" onClick=\"javascript:document.forms[0].gensites.createTextRange().execCommand('Copy')\">Copy</a><br>
            Название Сайта :<br>
            <textarea rows=\"4\" name=\"gennazv\" cols=\"60\">$gennazv_arr[0]</textarea><a href=\"#copy\" onClick=\"javascript:document.forms[0].gennazv.createTextRange().execCommand('Copy')\">Copy</a><br>
            Краткое описание:<br>
                        <textarea rows=\"4\" name=\"gentext\" cols=\"60\">$gentext_arr[0]</textarea><a href=\"#copy\" onClick=\"javascript:document.forms[0].gentext.createTextRange().execCommand('Copy')\">Copy</a><br>
            Полное описание:<br>
                        <textarea rows=\"4\" name=\"genopis\" cols=\"60\">$genopis_arr[0]</textarea><a href=\"#copy\" onClick=\"javascript:document.forms[0].genopis.createTextRange().execCommand('Copy')\">Copy</a><br>
                        Код нашей ссылки:<br>
                        <textarea rows=\"5\" name=\"genhtmlcode\" cols=\"60\">$genhtmlcode</textarea><a href=\"#copy\" onClick=\"javascript:document.forms[0].genhtmlcode.createTextRange().execCommand('Copy')\">Copy</a><br>
Код нашей картинки:<br>
<textarea rows=\"5\" name=\"genhtmlcodeimg\" cols=\"60\">$genhtmlcodeimg</textarea><a href=\"#copy\" onClick=\"javascript:document.forms[0].genhtmlcodeimg.createTextRange().execCommand('Copy')\">Copy</a><br>
Cсылка где будут устанавливаться их HTML коды:<br>
<input type=\"text\" name=\"genlinkurl\" value=\"$gensites/$genlinkurl\" size=76><a href=\"#copy\" onClick=\"javascript:document.forms[0].genlinkurl.createTextRange().execCommand('Copy')\">Copy</a><br>
Наш Email для связи:<br>
<input type=\"text\" name=\"genbackmail\" value=\"$genbackmail\" size=30><a href=\"#copy\" onClick=\"javascript:document.forms[0].genbackmail.createTextRange().execCommand('Copy')\">Copy</a>
</td>
                </tr>
        </table>
        <p align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Обновить\"></form>
        </p>
 ";

?>

</body>

</html>
