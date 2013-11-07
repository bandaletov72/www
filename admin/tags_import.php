<?php
@set_time_limit(0);
$sus=0;
$tosave2="";
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}

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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
echo "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; $codepage\"><title>$lang[1130]</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
";
$fold="..";
require ("../templates/$template/css.inc");
require ("../modules/translit.php");
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
.box{
padding : 10px 10px 10px 10px;
    width: auto;
    margin: 10px auto;
    border: 1px solid #c7c7c7;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: 0 0px 10px #b1b1b1;
    -moz-box-shadow:0 0px 20px #b1b1b1;
    box-shadow: 0 0px 10px #b1b1b1;
}
</STYLE>";
if(isset($_GET['strn'])) $strn=$_GET['strn']; elseif(isset($_POST['strn'])) $strn=$_POST['strn']; else $strn=0;
$strn=doubleval($strn);
if(isset($_GET['submitted'])) $submitted=$_GET['submitted']; elseif(isset($_POST['submitted'])) $submitted=$_POST['submitted']; else $submitted="false";
if (!preg_match("/^[0-9a-z]+$/i",$submitted)) { $submitted="false";}
if(isset($_GET['filen'])) $filen=$_GET['filen']; elseif(isset($_POST['filen'])) $filen=$_POST['filen']; else $filen="";
if(isset($_GET['ymlfile'])) $ymlfile=$_GET['ymlfile']; elseif(isset($_POST['ymlfile'])) $ymlfile=$_POST['ymlfile']; else $ymlfile="";
if ($ymlfile!="") {$filen="$ymlfile";}
if(isset($_GET['ccfile'])) $ccfile=$_GET['ccfile']; elseif(isset($_POST['ccfile'])) $ccfile=$_POST['ccfile']; else $ccfile="";
if(isset($_GET['subm'])) $subm=$_GET['subm']; elseif(isset($_POST['subm'])) $subm=$_POST['subm']; else $subm="";
if(isset($_GET['r'])) $import=$_GET['r']; elseif(isset($_POST['r'])) $r=$_POST['r']; else $r="|";
if(isset($_GET['k'])) $import=$_GET['k']; elseif(isset($_POST['k'])) $k=$_POST['k']; else $k=0;
if(isset($_GET['import'])) $import=$_GET['import']; elseif(isset($_POST['import'])) $import=$_POST['import']; else $import="";
if(isset($_GET['action'])) $action=$_GET['action']; elseif(isset($_POST['action'])) $action=$_POST['action']; else $action="";
$hopp="<input type=hidden name=\"ccfile\" value=\"$ccfile\">";
require("fileupload-class.php");


        $path = "./sklad/";


        $upload_file_name = "userfile";


        $acceptable_file_types = "text/plain|text/richtext|text/html";


        $default_extension = "";


        $mode = 1;

        if (isset($_REQUEST['submitted'])) {

                $my_uploader = new uploader($_POST['language']);


                $my_uploader->max_filesize(10000000);

                $my_uploader->max_image_size(1500, 1500);

                if ($my_uploader->upload($upload_file_name, $acceptable_file_types, $default_extension)) {
                        $my_uploader->save_file($path, $mode);
                }

                if ($my_uploader->error) {
                        echo $my_uploader->error . "<br><br>\n";

                } else {

                        if(stristr($my_uploader->file['type'], "text")) {
                        $sus=1;
                        echo "Path: /admin/sklad/". $my_uploader->file['name'] . ", type: ".$my_uploader->file['type'].", ext: ".$my_uploader->file['extention'].", size: ".$my_uploader->file['size']."b<br>";
                        print($my_uploader->file['name'] . " loaded OK!<br>");
            } else {
                        $sus=1;
                        print($my_uploader->file['name'] . " loaded OK!<br>");
                                $fp = fopen($path . $my_uploader->file['name'], "r");
                                while(!feof($fp)) {
                                        $line = fgets($fp, 255);
                                        echo $line;
                                }
                                if ($fp) { fclose($fp); }
                        }
                 }
         }
$rep="";

$k=doubleval($k);

if ($import=="true") {
if ($action=="") {
echo "<h4>$lang[1130]</h4>";
echo "Columns separator / Разделитель в строке: <b>$r</b><br>
Load conditions / Загружать только строки, содержащие <b>&gt;=$k</b> символов-разделителей<br>
Load from <b>$strn</b> stroke / Загружать с <b>$strn</b> строки<br>
File / Файл: $filen<br><br>";
echo "Please wait... Ждите <small>";
$fp = fopen($filen, "r");
$ff=0;
$tosave="";
while(!feof($fp)) {
$line = fgets($fp, 4096);
if (trim($line)!="") {
$exp=$r;
if ((substr($r, 0, 1)=="[") &&(substr($r, -1)=="]"))   {
$exp=chr(doubleval(str_replace("[","", str_replace("]","", $r))));
}
$line1=explode($exp, str_replace("\n", "", str_replace("\r", "", $line)));
if (count($line1)>=$k) {
array_unshift($line1,"");
reset($v);
while (list ($key, $st) = @each ($v)) {
$cv=@$c[$key];
if (trim($cv)!=""){$line1[$st]=trim($cv);}




$out[$key]=@$line1[$st];


}
echo "\n";
//echo $out[10];
//exit;
if (count($line1)>=$k){
if ($ff>=$strn) {
//echo $out[1]."-".implode("|",$out)."|\n";
if (trim(@$out[1])!="") {
$tagff="./searchwords/".md5($out[1]).".txt";

$filetagf=fopen($tagff,"w");
flock ($filetagf, LOCK_EX);
fputs($filetagf, @trim($out[3])."\n".trim($out[1])."\n".rawurldecode(trim(@$out[2])));
flock ($filetagf, LOCK_UN);
fclose ($filetagf);
unset ($filetagf);
}
//echo $ff.". ".strtoken(@$out[2],"<br>")." / ".strtoken(@$out[3],"<br>")." / ".@$out[4]." [".@$out[5].", ".@$out[6]."], [x". count($line1)."] - <b>OK</b><br>\n";
echo ". ";
unset($out);
}
$ff+=1;
}
}
}
}
echo " <font color=#468847><b>OK</b></font> [$ff] <h4>$lang[209]</h4><br>
<button class=btn type=button  onclick=\"javascript:location.href='".$htpath."/index.php?action=tagindex&mod=admin';\"><font color=#468847><b>V</b></font>&nbsp;&nbsp;$lang[133]</button>";
}
} else {
	if ($ymlfile!=""){$sus=1; $submitted='true';}
if (($submitted=='true')&&($sus==1)) {
if ($ymlfile!=""){
$fp = fopen($path . $ymlfile, "r");
$ffff=$path . $ymlfile;
}else{

$fp = fopen($path . $my_uploader->file['name'], "r");
$ffff=$path . $my_uploader->file['name'];
}
echo "<br><button class=btn type=button onClick=javascript:window.open('$htpath/admin/see.php?file=".rawurlencode($ffff)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>File preview / Просмотреть файл</button><br><br>";
$line1="";
$str=0;
$ff=0;
while(!feof($fp)) {
$line = fgets($fp, 4096);
if (($ff==0)&&(trim($line)!="")) {$ff=1; $line1=htmlspecialchars($line);}
$str+=1;
}
if ($fp) { fclose($fp); }
echo "Found / Найдено: $str strokes / строк<br><br>You see row #0 / Показана строка номер 0:<br><br><small>";
echo $line1;
if ($ymlfile!="") {$fff=$ymlfile;} else {
$fff=$my_uploader->file['name'];
}
echo "<br><br><form class=form-inline action='$htpath/admin/tags_import.php' method='POST'>
<input type='hidden' name='subm' value='true'>
<input type='hidden' name='speek' value=\"$speek\">
<input type='hidden' name='filen' value=\"".$path . $fff."\">
<table border=0 cellspacing=0 cellpadding=2 class=round2<tr>
<tr><td valign=top bgcolor=$nc6>Separator<br><small>Выберите разделитель полей</small></td><td valign=top bgcolor=$nc6><input size=1 name='r' type='text' value=\"|\"></td><td bgcolor=$nc6> <i>ex. / например:</i> | или [HEXASCII-code] (<i>ex. / например:</i> [09])<br><b>Note / Справка:</b> [09] - TAB - разделитель - символ табуляции</td></tr>
<tr><td valign=top>How much separators must exists<br><small>Сколько должно быть в строке символов-разделителей</small></td><td valign=top><input size=1 name='k' type='text' value=\"\"></td><td valign=top> <i>ex. / например:</i> 10, если не знаете - оставьте поле пустым</td></tr>
<tr><td valign=top bgcolor=$nc6>Load from stroke number<br><small>Загрузить с определенной строки</small></td valign=top bgcolor=$nc6><td><input size=1 name='strn' type='text' value=\"$strn\"></td><td valign=top bgcolor=$nc6> (<i>ex. / например:</i> 0])</td></tr></table>
<input type='hidden' name='language' value='ru'>
<input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"> <input type='submit' value='Next / Далее &gt;&gt;'>
</form>";
echo "<br><br><b><a href=tags_import.php?speek=$speek>Choose another file / Выбрать другой файл</a></b>";
	} else {

if (($subm=="true")&&($filen!="")) {
	if ($r!="") {
echo "<h4>Load parameters / Параметры загрузки</h4>
Separator / Разделитель в строке: <b>$r</b><br>
Load condition / Загружать только строки, содержащие <b>&gt;=$k</b> символов-разделителей<br>
File / Файл: $filen<br><br>";
$fp = fopen($filen, "r");

$line1="";
$str=0;
$ff=0;
while(!feof($fp)) {
$line = fgets($fp, 4096);
if (($ff==0)&&(trim($line)!="")) {
$exp=$r;
if ((substr($r, 0, 1)=="[") &&(substr($r, -1)=="]"))   {
$exp=chr(doubleval(str_replace("[","", str_replace("]","", $r))));
}
$line1=explode($exp, htmlspecialchars(str_replace("\n", "", str_replace("\r", "", $line))));
if (count($line1)>=$k) {
$ff=1;
array_unshift($line1,"");
}
}
$str+=1;
}
if ($fp) { fclose($fp); }
echo "Separated by / Строка разбита разделителем:<br><textarea cols=64 rows=5 style=\"width:100%\">";
while (list ($key, $st) = each ($line1)) {
	if (($key!=0)&&($st!="\n")) {echo "$key => $st\n";
$rep.= "<option value=$key>$st</option>";
}
}
$rep.= "<option value=\"\">---- Empty / Пусто -----</option>";
echo "</textarea>";
//echo "<select style=\"width:250px\">$rep</select>";



echo "<h4>Table lookup / Таблица подстановки</h4>
<form class=form-inline action='$htpath/admin/tags_import.php' method='POST'>
<input type='hidden' name='import' value='true'>
Load from stroke number / Загружать с определенной строки: <input type='text' name='strn' value='$strn'><br>
<input type='hidden' name='speek' value=\"$speek\">$hopp
<input type='hidden' name='filen' value=\"".$filen."\"><table width=100% border=0 cellpadding=4 cellspacing=0>
<tr bgcolor=\"#f2f2f2\"><td><b>DB Column / Поле БД</b></td><td width=45%><b>Data loading / Импортируемые данные</b></td><td width=40%><b>Set value / Другое значение</b></td></tr>
<tr><td>".$lang[808].":</td><td><select style=\"width:100%\" name=\"v[1]\"><option selected value=1>".@$line1[1]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[1]\" value=\"\"></td></tr>
<tr><td>".$lang[810].":</td><td><select style=\"width:100%\" name=\"v[2]\"><option selected value=2>".@$line1[2]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[2]\" value=\"\"></td></tr>
<tr><td>".$lang[287].":</td><td><select style=\"width:100%\" name=\"v[3]\"><option selected value=3>".@$line1[3]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[3]\" value=\"\"></td></tr>
\n";
echo "</table><input name='r' type='hidden' value=\"$r\"><input type='hidden' name='k' value=$k>
                <input type='hidden' name='language' value='ru'>
<input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"> <input type='submit' value='Next / Далее &gt;&gt;'>
        </form>";
} else {

echo "<h4>ERROR</h4>";
echo "<i>Not set separator / Не выбрали разделитель!</i>";
echo "<p><input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"></p>";

}
} else {

echo "<h4>$lang[1130]</h4>Data format / Поддерживаемый формат: <b>text/plain</b>, <b>text/richtext</b> separated / с разделителями<br><br><form enctype='multipart/form-data' action='$htpath/admin/tags_import.php' method='POST'>
        <b>".$lang[1131].":</b> <pre>".$lang[808]."|".$lang[810]."|".$lang[287]."</pre>
        <b>".$lang[691].":</b><pre>
autoparts|$htpath/index.php?catid=autoparts|1223
buy pc|$htpath/index.php?catid=buy_pc|743
toys||225</pre><br>
        <input type='hidden' name='submitted' value='true'>
               <input type='hidden' name='speek' value=\"$speek\">
                File name / Имя файла: <input name='" . $upload_file_name . "' type='file'>
                <input type='hidden' name='language' value='ru'>
<input type='submit' value='Upload / Загрузить'>
        </form>";
}

}
}
?>
