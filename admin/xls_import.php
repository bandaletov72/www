<?php
@set_time_limit(0);
$sus=0;
$tosave2="";
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
echo "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; $codepage\"><title>EXCEL 97-2003 XLS IMPORT</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
";
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
.ALERT  { font-size: 12; color: red; font-weight: bold; }
.ROW {  padding: 4px; color:black; font-weight:bold; background-color: #ffffff; }

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
</STYLE><body>
";
$opp="<select name=\"ccfile\"><option></option>";
$handle=@opendir("../templates/$template/$speek/");
$i=0;
while (($val=@readdir($handle))!==FALSE) {
if (substr($val,0,3)!="cc_") { continue;} else {
$opp.= "<option>".str_replace(".inc", "", $val)."</option>";
}
}
$opp.= "</select>";
if(isset($_GET['k1'])) $k1=$_GET['k1']; elseif(isset($_POST['k1'])) $k1=$_POST['k1']; else $k1=1;
if (!preg_match("/^[0-9\.,]+$/i",$k1)) { $k1=1;}
if(isset($_GET['k2'])) $k2=$_GET['k2']; elseif(isset($_POST['k2'])) $k2=$_POST['k2']; else $k2=1;
if (!preg_match("/^[0-9\.,]+$/i",$k2)) { $k2=1;}
if(isset($_GET['k3'])) $k3=$_GET['k3']; elseif(isset($_POST['k3'])) $k3=$_POST['k3']; else $k3="NO";
if (!preg_match("/^[0-9YESNOyesno\.,]+$/i",$k3)) { $k3="NO";}
if(isset($_GET['k4'])) $k4=$_GET['k4']; elseif(isset($_POST['k4'])) $k4=$_POST['k4']; else $k4="NO";
if (!preg_match("/^[0-9YESNOyesno\.,]+$/i",$k4)) { $k4="NO";}
if(isset($_GET['k5'])) $k5=$_GET['k5']; elseif(isset($_POST['k5'])) $k4=$_POST['k5']; else $k5="NO";
if (!preg_match("/^[0-9YESNOyesno\.,]+$/i",$k5)) { $k5="NO";}
if(isset($_GET['strn'])) $strn=$_GET['strn']; elseif(isset($_POST['strn'])) $strn=$_POST['strn']; else $strn=0;
$strn=doubleval($strn);
if(isset($_GET['strn2'])) $strn2=$_GET['strn2']; elseif(isset($_POST['strn2'])) $strn2=$_POST['strn2']; else $strn2=999999;
$strn2=doubleval($strn2);
if(isset($_GET['submitted'])) $submitted=$_GET['submitted']; elseif(isset($_POST['submitted'])) $submitted=$_POST['submitted']; else $submitted="false";
if (!preg_match("/^[0-9a-z]+$/i",$submitted)) { $submitted="false";}
if(isset($_GET['filen'])) $filen=$_GET['filen']; elseif(isset($_POST['filen'])) $filen=$_POST['filen']; else $filen="";
if(isset($_GET['select'])) $select=$_GET['select']; elseif(isset($_POST['select'])) $select=$_POST['select']; else $select="";
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


        $acceptable_file_types = "text/plain|text/html|application/vnd.ms-excel";


        $default_extension = "";


        $mode = 1;

        if (isset($_REQUEST['submitted'])) {

                $my_uploader = new uploader($_POST['language']);


                $my_uploader->max_filesize(20000000);

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
                        print("".$my_uploader->file['name'] . " loaded OK!<br>PLEASE WAIT / Пожалуйста подождите, обрабатываю файл.<br>");
            } else {
                        $sus=1;
                        print("".$my_uploader->file['name'] . " loaded OK!<br>PLEASE WAIT / Пожалуйста подождите, обрабатываю файл.<br>");
	include('./sklad/xlsparser.php');
	$filexl = $path . $my_uploader->file['name'];
    echo "<span style=\"font-size:1px;\">";
	$sheets = parse_excel($filexl);

	$is=0;
    $xlfile="";
    //var_dump($sheets);
    if ($sheets) {
	foreach($sheets as $sheet){
$xlfile.="sheet #$is\n";
		foreach($sheet as $row){
			foreach($row as $col){
				if(is_array($col)){
					foreach($col as $c) $xlfile.= str_replace("\n","<br>",str_replace("\r","<br>", str_replace("\t","",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ", "\"$c\" "))))))));
					$xlfile.= "|";
				}
				else
				$xlfile.= str_replace("\n","<br>",str_replace("\r","<br>", str_replace("\t","",  str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ","$col|"))))))));
			}
            echo "|\n";
			$xlfile.="\n";
		}
		$is++;
	}
echo "</span>";

}
    else {
    print "Error parsing or unknown .xls file format";
    echo "<br><br><b><a href=xls_import.php?speek=$speek>Choose another file / Выбрать другой файл</a></b>";
    exit;
    }
    $fp = fopen($path . $my_uploader->file['name'].".txt", "w");
    fputs($fp,$xlfile);
    fclose($fp);

                                $fp = fopen($path . $my_uploader->file['name'].".txt", "r");
                                while(!feof($fp)) {
                                        $line = fgets($fp, 4096);
                                        //echo $line;
                                }
                                if ($fp) { fclose($fp); }
                        }
                 }
         } else {
if (isset($_GET['select'])) {

 $sus=1;
    print($_GET['select'] . " loaded OK!<br>PLEASE WAIT / Пожалуйста подождите, обрабатываю файл.<br>");
	include('./sklad/xlsparser.php');
	$filexl = "../import/".$_GET['select'];
    echo "<span style=\"font-size:1px;\">";
	$sheets = parse_excel($filexl);
	$is=0;
    $xlfile="";
    //var_dump($sheets);
    if ($sheets) {
	foreach($sheets as $sheet){
$xlfile.="sheet #$is\n";
		foreach($sheet as $row){
			foreach($row as $col){
				if(is_array($col)){
					foreach($col as $c) $xlfile.= str_replace("\n","<br>",str_replace("\r","<br>", str_replace("\t","", str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ", "\"$c\" "))))))));
					$xlfile.= "|";
				}
				else
				$xlfile.= str_replace("\n","<br>",str_replace("\r","<br>", str_replace("\t","", str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ","$col|"))))))));
			}
			$xlfile.="\n";
		}
		$is++;
	}
    echo "</span>";
}
    else {
    print "Error parsing or unknown .xls file format";
    echo "<br><br><b><a href=xls_import.php?speek=$speek>Choose another file / Выбрать другой файл</a></b>";
    exit;
    }
    $fp = fopen($path . $_GET['select'].".txt", "w");
    fputs($fp,$xlfile);
    fclose($fp);

                                $fp = fopen($path . $_GET['select'].".txt", "r");
                                while(!feof($fp)) {
                                        $line = fgets($fp, 4096);
                                        //echo $line;
                                }
                                if ($fp) { $submitted='true'; fclose($fp); }
                        }

}
$rep="";

$k=doubleval($k);

if ($import=="true") {
if ($action=="") {
echo "<h4>Test import</h4>";
echo "Columns separator / Разделитель в строке: <b>$r</b><br>
Import conditions / Импортировать только строки, содержащие <b>&gt;=$k</b> символов-разделителей<br>
Import from <b>$strn</b> stroke / Импортировать с <b>$strn</b> строки<br>
Import to <b>$strn2</b> stroke / Импортировать до <b>$strn2</b> строки<br>
File / Файл: $filen<br><br>";
echo "Please wait... Ждите ... <small>";
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
$out[2]=strtoken(@$out[2],"<br>");
if ($out[2]=="") {$out[2]="NONAME DIR";}
$out[3]=strtoken(@$out[3],"<br>");
if ($out[3]=="") {$out[3]="NONAME SUBDIR";}
echo "\n";
$out[5]=str_replace(",",".",$k1*doubleval(str_replace(",",".",$out[5])));
$out[6]=str_replace(",",".",$k2*doubleval(str_replace(",",".",$out[6])));

$tmpk=explode("<br>", $out[10]);
$out[10]= $tmpk[0];
if ($k3=="YES") {
//echo $out[10];
if (trim($out[10])!="") {
$out[10]="<img src='".$fotobasesmall."/". $out[10] . "' border=0>";
}
}
unset($tmpk);
$out[11]=str_replace("," , "<br>",$out[11]);
if ($k4=="YES") {
$tmpk=explode("<br>", $out[11]);
$sdf=0;
while (list ($tk,$tv)=each($tmpk)) {
//echo $tv;
if (trim($tv)!="") {
$tmpk[$tk]="<img src='".$fotobasebig."/". $tv . "' border=0>";
}
$sdf+=1;
}
if ($sdf>=1) {$out[11]=implode("<br>", $tmpk); }
}
if ($k5=="YES") { $out[16]=str_replace(chr(10), "",str_replace(chr(13), "", str_replace(chr(27), "", str_replace("  ", " ",str_replace("  ", " ", str_replace("  ", " ", str_replace("<br><br>", "<br>",str_replace("<br><br>", "<br>", str_replace("<br><br>", "<br>",str_replace("<br><br>", "<br>",str_replace("[br]", "<br>", strip_tags(str_replace("</tr>", "[br]", str_replace("</td>", chr(9), str_replace("</div>", "[br]", str_replace("<br>", "[br]", str_replace("<\/br>", "[br]", str_replace("</br>", "[br]", str_replace("\r", "[br]", str_replace("\n", "[br]", $out[16])))))))))))))))))))); }
//echo $out[10];
//exit;
if (count($line1)>=$k){
if (($ff>=$strn)&&($ff<=$strn2)) {
$tosave.=implode("|",$out)."|\n";
$out[2]="";
$out[3]="";
$out[8]="";
$out[16]="";
@$out[21]="";
@$out[22]="";
@$out[23]="";
@$out[24]="";
@$out[25]="";
$tosave2.=implode("|",$out)."|\n";
//echo $ff.". ".strtoken(@$out[2],"<br>")." / ".strtoken(@$out[3],"<br>")." / ".@$out[4]." [".@$out[5].", ".@$out[6]."], [x". count($line1)."] - <b>OK</b><br>\n";
//echo $ff.". ".strip_tags(implode("|",$out))."</br>\n";
echo "\n";
unset($out);
}
$ff+=1;
}
}
}
}
if ($fp) { fclose($fp); }
echo "</small>\n";
$fp = fopen($filen.".tmp", "w");
fputs ($fp,$tosave);
$fp = fopen($filen.".tmp2", "w");
fputs ($fp,$tosave2);
if ($fp) { fclose($fp); }
echo "<font color=#468847><b>OK</b></font><br><br>Total: $ff items / Всего: $ff позиций
<form class=form-inline action='$htpath/admin/xls_import.php' method='POST' name=submitform>
<input type='hidden' name='import' value='true'>$hopp
<input type='hidden' name='k' value=$k>
<input type='hidden' name='strn' value=$strn>
<input type='hidden' name='strn2' value=$strn2>
<input type='hidden' name='speek' value=\"$speek\">
<input type='hidden' name='filen' value=\"".$filen."\">
<h4>Choose action / Выберите действие:</h4>
<div class=box>
<table border=0 width=100%><tr><td>
<input type=\"radio\" value=\"v1\" name=\"action\" checked id=v1><label for=v1><b>Delete Database and create this articles</b><br>Заменить базу на
	новую полностью. Все старые товары будут уничтожены!</label>
    </td><td valign=top align=right><!--input type='submit' value='Next / Далее &gt;&gt;' onclick=\"javascript:\"--></td></tr></table>
    </div>

    <div class=box><table border=0 width=100%><tr><td><input type=\"radio\" value=\"v2\" name=\"action\" id=v2><label for=v2><b>Add this articles to existing database</b><br>Дополнить базу этими
	позициями. Старые позиции сохранить полностью.</label></td><td valign=top align=right><!--input type='submit' value='Next / Далее &gt;&gt;'--></td></tr></table></div>


    <!--div class=box><table border=0 width=100%><tr><td><input type=\"radio\" value=\"v3\" name=\"action\" id=v3><label for=v3>Дополнить базу только
	позициями, которых нет в ней (сравнение по артикулу)</label></td><td valign=top align=right><input type='submit' value='Next / Далее &gt;&gt;'></td></tr></table></div>


    <div class=box><table border=0 width=100%><tr><td><input type=\"radio\" value=\"v4\" name=\"action\" id=v4><label for=v4>Дополнить базу только
	позициями, которых нет в ней (сравнение по названию)</label></td><td valign=top align=right><input type='submit' value='Next / Далее &gt;&gt;'></td></tr></table></div-->


    <div class=box><input type=\"radio\" value=\"v5\" name=\"action\" id=v5><label for=v5><b>Synchronize</b><br>Обновить цены, склад и т.п.</label>
    <b>Choose key field</b> Выберите ключевое поле для синхронизации данных:<br><br>
    <select name=keyfield>
    <option value=3 selected>Item code+name / Код+Наименование товара</option>
    <option value=1>Item code / Код товара</option>
    <option value=2>Item name / Наименование</option>
    </select><br><br>
    <b>Select fields to refresh</b> Производить обновление следующих полей:<br><br>
    <table width=100% border=0 cellspacing=0 cellpadding=5>
<tr><td bgcolor=#dedede>4. ".$lang['price']."</td><td bgcolor=#dedede><input type=checkbox value=\"YES\" name=\"vv[4]\" checked></td></tr>
<tr><td>5. ".$lang[148]."</td><td><input type=checkbox value=\"YES\" name=\"vv[5]\" checked></td></tr>
<tr><td bgcolor=#dedede>9. ".$lang[665]."</td><td bgcolor=#dedede><input type=checkbox value=\"YES\" name=\"vv[9]\" checked></td></tr>
<tr><td>10. ".$lang[666]."</td><td><input type=checkbox value=\"YES\" name=\"vv[10]\" checked></td></tr>
<tr><td bgcolor=#dedede>12. ".$lang[427]."</td><td bgcolor=#dedede><input type=checkbox value=\"YES\" name=\"vv[12]\"></td></tr>
<tr><td>13. ".$lang[355]."</td><td><input type=checkbox value=\"YES\" name=\"vv[13]\"></td></tr>
<tr><td bgcolor=#dedede>14. ".$lang[668]."</td><td bgcolor=#dedede><input type=checkbox value=\"YES\" name=\"vv[14]\"></td></tr>
<tr><td>16. ".$lang[670]."</td><td><input type=checkbox value=\"YES\" name=\"vv[16]\" checked></td></tr>

";
$c_filename="../templates/$template/$speek/custom_cart.inc";
$cc_cart="";
$cc_num=0;
$nccc=0;
if (@file_exists($c_filename)==TRUE) {
$custom_cart1=file($c_filename);
$custom_cart=$custom_cart1;
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")){
$ncc=18+$cc_num;
if (($nccc/2)==floor($nccc/2)) { $bg=" bgcolor=#dedede"; } else { $bg="";}
if (($ncc!=21)&&($ncc!=22)&&($ncc!=23)&&($ncc!=24)&&($ncc!=25)) {
$nccc+=1;
echo "<tr><td".$bg.">".($ncc-1).". ".@$ccc[0]."</td><td".$bg."><input type=checkbox value=\"YES\" name=\"vv[".($ncc-1)."]\"></td></tr>  \n";
}
}
}
}
echo "</table><br>
    </div>
	<!--div class=box><input type=\"radio\" value=\"v6\" name=\"action\" id=v6><label for=v6>Дополнить базу новыми
	позициями (сравнение по названию) и обновить цены старых позиций, если не
	совпадает цена</label></div-->

<input type='hidden' name='language' value='ru'>
<input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"> <input type='submit' value='Next / Далее &gt;&gt;'>
</form>";
} else {
if ($action=="v1") {
echo "<h4>Full replace</h4>";
echo ".$base_file";
if (!copy($filen.".tmp",".$base_file")) {echo "Error copying $filen.tmp => .$base_file";}
echo "<h4>OK</h4>";
echo "<br><br><b><a href=xls_import.php?speek=$speek>Choose another file / Выбрать другой файл</a></b>";
}
if ($action=="v2") {
echo "<h4>Add all</h4>";
echo ".$base_file";
$fp = fopen($filen.".tmp", "r");
$tosave=fread($fp,filesize($filen.".tmp"));
if ($fp) { fclose($fp); }
unset($fp);
$fp = fopen(".$base_file", "a");
fputs ($fp,$tosave);
if ($fp) { fclose($fp); }
unset($fp);
echo "<h4>OK</h4>";
echo "<br><br><b><a href=xls_import.php?speek=$speek>Choose another file / Выбрать другой файл</a></b>";
}
if ($action=="v3") {
echo "<h4>Add new (by art.)</h4>";
echo "<i>module under construction</i>";
echo "<p><input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"></p>";
}
if ($action=="v4") {
echo "<h4>Add new (by name)</h4>";
echo "<i>module under construction</i>";
echo "<p><input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"></p>";
}
if ($action=="v5") {
echo "<h4>Synchronize</h4>";
echo "Sync mode = $keyfield<br>";
while (list ($num, $line) = each ($vv)) {
echo "Field $num =&gt; $line<br>";
}
echo "<br>Reading sync database ... ";
$file="$filen".".tmp2";
$f=fopen($file,"r");
while(!feof($f)) {
echo "\n";

$stun=fgets($f);
$outun=explode("|",str_replace("\n", "", str_replace("\r", "",trim($stun))));
if ($keyfield==1) {$indx=$outun[6];}
if ($keyfield==2) {$indx=$outun[3];}
if ($keyfield==3) {$indx=@$outun[3]."|".@$outun[6];}
//echo "indx=$indx<br>";
if (trim(trim($indx!="|"))){
$tmp_arr[$indx]=$stun;
}
}
fclose($f);
unlink("$filen".".tmp3");
$file2="$filen".".tmp3";
$f2=fopen($file2,"a");

$file=".$base_file";
$f=fopen($file,"r");
echo "<font color=#468847><b>OK</b></font><br>";
echo "Reading item database ... ";
while(!feof($f)) {
echo "\n";
$stun=fgets($f);
$outun=explode("|",str_replace("\n", "", str_replace("\r", "", trim($stun))));
if (@$outun[3]!="") {
if ($keyfield==1) {$indx=$outun[6];}
if ($keyfield==2) {$indx=$outun[3];}
if ($keyfield==3) {$indx=$outun[3]."|".$outun[6];}
if (isset($tmp_arr[$indx])) {

$outun2=explode("|",$tmp_arr[$indx]);
//echo $outun2[3].$indx;
reset ($vv);
while (list($kk,$vval)=each($vv)) {
$outun[$kk]=$outun2[$kk];
}
//echo " - OK <br>";
echo "\n";

} else {
//товар не существует?
echo "<br><b>Notice:</b> $outun[3] / Item code: $outun[6] <b>not exist</b> in importing database\n";
}
fputs ($f2, str_replace("\n", "", str_replace("\r", "", trim(implode("|",$outun))))."\n");
unset($outun);
$tmp_arr[$indx]="";
}
}

fclose($f);
fclose($f2);
echo " <font color=#468847><b>OK</b></font><br><br>";
echo "Writing .$base_file";
if (!copy($filen.".tmp3",".$base_file")) {echo "Error copying $filen.tmp3 => .$base_file";}

echo "<h4>DONE!</h4>";
while (list($kkk,$vvval)=each($tmp_arr)) {
if ($vvval!="") {
$outs=explode("|",$vvval);
echo "<b>NEW ITEM!</b> $outs[3] / Item code: $outs[6] <b>not exist</b> in item database<br>\n";
}
}

echo "<br><br><b><a href=xls_import.php?speek=$speek>Choose another file / Выбрать другой файл</a></b>";
}
if ($action=="v6") {
echo "<h4>Add new (by name), change price</h4>";
echo "<i>module under construction</i>";
echo "<p><input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"></p>";
}
}
} else {
	if ($ymlfile!=""){$sus=1; $submitted='true';}
if (($submitted=='true')&&($sus==1)) {
if (isset($_GET['select'])) {
$ffff=$path .$_GET['select'].".txt";
    } else {
$ffff=$my_uploader->file['name'].".txt";
}
echo "<br><button class=btn type=button onClick=javascript:window.open('$htpath/admin/see.php?file=".rawurlencode($ffff)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>File import preview / Просмотреть файл</button><br>";
if ($ymlfile!=""){
$fp = fopen($path . $ymlfile, "r");

}else{
if (isset($_GET['select'])) {
$fp = fopen($path .$_GET['select'].".txt", "r");
    } else {
$fp = fopen($path . $my_uploader->file['name'].".txt", "r");

}
}
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
if (isset($_GET['select'])) {
$fff=$_GET['select'].".txt";
    } else {
$fff=$my_uploader->file['name'].".txt";
}
}
echo "<br><br><form class=form-inline action='$htpath/admin/xls_import.php' method='POST'>
<input type='hidden' name='subm' value='true'>
<input type='hidden' name='speek' value=\"$speek\">
<input type='hidden' name='filen' value=\"".$path . $fff."\">
<table border=0 cellspacing=0 cellpadding=2><tr>
<tr bgcolor=$nc6><td valign=top>Adittion columns file<br><small>Файл дополнительных полей</small></td><td colspan=2 valign=top>$opp<small><br><i>Adding to defaults columns / Добавляется к собственным (custom_cart.inc)</i></small></td></tr>
<tr><td valign=top>Separator<br><small>Выберите разделитель полей</small></td><td valign=top><input size=1 name='r' type='text' value=\"|\"></td><td> <i>ex. / например:</i> | или [HEXASCII-code] (<i>ex. / например:</i> [09])<br><b>Note / Справка:</b> [09] - TAB - разделитель - символ табуляции</td></tr>
<tr bgcolor=$nc6><td valign=top>How much separators must exists<br><small>Сколько должно быть в строке символов-разделителей</small></td><td valign=top><input size=1 name='k' type='text' value=\"\"></td><td valign=top> <i>ex. / например:</i> 10, если не знаете - оставьте поле пустым</td></tr>
<tr><td valign=top>Import from stroke number<br><small>Импортировать с определенной строки вкл.</small></td valign=top><td><input size=6 name='strn' type='text' value=\"$strn\"></td><td valign=top> (<i>ex. / например:</i> 0])</td></tr>
<tr><td valign=top>Import to stroke number<br><small>Импортировать до определенной строки вкл.</small></td valign=top><td><input size=6 name='strn2' type='text' value=\"$strn2\"></td><td valign=top> (<i>ex. / например:</i> 999999])</td></tr></table>
<input type='hidden' name='language' value='ru'>
<input type='button' value=\"&lt;&lt; ".$lang['back']." / Back\" onclick=\"javascript:history.go(-1)\"> <input type='submit' value='Next / Далее &gt;&gt;'>
</form>";
echo "<br><br><b><a href=xls_import.php?speek=$speek>Choose another file / Выбрать другой файл</a></b>";
	} else {

if (($subm=="true")&&($filen!="")) {
	if ($r!="") {
echo "<h4>Import parameters / Параметры импорта</h4>
Separator / Разделитель в строке: <b>$r</b><br>
Import condition / Импортировать только строки, содержащие <b>&gt;=$k</b> символов-разделителей<br>
File / Файл: $filen<br><br>";
$fp = fopen($filen, "r");

$line1="";
$str=0;
$ff=0;
while(!feof($fp)) {
$line = fgets($fp, 4096);
if (($str==doubleval($strn))&&(trim($line)!="")) {
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
echo "Stroke <b>$strn</b>/ Строка <b>$strn</b><br><textarea cols=64 rows=5 style=\"width:100%\">";
while (list ($key, $st) = each ($line1)) {
	if (($key!=0)&&($st!="\n")) {echo "$key => $st\n";
$rep.= "<option value=$key>$st</option>";
}
}
$rep.= "<option value=\"\">---- Empty / Пусто -----</option>";
echo "</textarea>";
//echo "<select style=\"width:250px\">$rep</select>";



echo "<h4>Table lookup / Таблица подстановки</h4>
<form class=form-inline action='$htpath/admin/xls_import.php' method='POST'>
<input type='hidden' name='import' value='true'>
Import from stroke number / Импортировать с определенной строки вкл: <input type='text' name='strn' value='$strn'><br>
Import to stroke number / Импортировать до определенной строки вкл: <input type='text' name='strn2' value='$strn2'><br>
<input type='hidden' name='speek' value=\"$speek\">$hopp
<input type='hidden' name='filen' value=\"".$filen."\"><table width=100% border=0 cellpadding=4 cellspacing=0>
<tr bgcolor=\"#f2f2f2\"><td><b>DB Column / Поле БД</b></td><td width=45%><b>Data to import / Импортируемые данные</b></td><td width=40%><b>Set value / Другое значение</b></td></tr>
<tr><td>ID:</td><td><select style=\"width:100%\" name=\"v[1]\"><option selected value=1>".@$line1[1]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[1]\" value=\"\"></td></tr>
<tr><td>".$lang[430].":</td><td><select style=\"width:100%\" name=\"v[2]\"><option selected value=2>".@$line1[2]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[2]\" value=\"\"></td></tr>
<tr><td>".$lang[431].":</td><td><select style=\"width:100%\" name=\"v[3]\"><option selected value=3>".@$line1[3]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[3]\" value=\"\"></td></tr>
<tr><td>".$lang['name'].":</td><td><select style=\"width:100%\" name=\"v[4]\"><option selected value=4>".@$line1[4]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[4]\" value=\"\"></td></tr>
<tr><td>".$lang['price'].":</td><td><select style=\"width:100%\" name=\"v[5]\"><option selected value=5>".@$line1[5]."</option>$rep</select></td><td>x<input type=text size=2 value=1 name=k1>,<input style=\"width:50%\" size=15 name=\"c[5]\" value=\"\"></td></tr>
<tr><td>".$lang[148].":</td><td><select style=\"width:100%\" name=\"v[6]\"><option selected value=6>".@$line1[6]."</option>$rep</select></td><td>x<input type=text size=2 value=1 name=k2>,<input style=\"width:50%\" size=15 name=\"c[6]\" value=\"\"></td></tr>
<tr><td>".$lang[419].":</td><td><select style=\"width:100%\" name=\"v[7]\"><option selected value=7>".@$line1[7]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[7]\" value=\"\"></td></tr>
<tr><td>".$lang['short'].":</td><td><select style=\"width:100%\" name=\"v[8]\"><option selected value=8>".@$line1[8]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[8]\" value=\"\"></td></tr>
<tr><td>".$lang[653].":</td><td><select style=\"width:100%\" name=\"v[9]\"><option selected value=9>".@$line1[9]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[9]\" value=\"\"></td></tr>
<tr><td>".$lang[665].":</td><td><select style=\"width:100%\" name=\"v[10]\"><option selected value=10>".@$line1[10]."</option>$rep</select></td><td><input style=\"width:20%\" size=15 name=\"c[10]\" value=\"\"> <input type=checkbox value=YES name=k3><small>Add / Добавить &lt;img src=$fotobasesmall/XXXX.JPG&gt;</small></td></tr>
<tr><td>".$lang[666].":</td><td><select style=\"width:100%\" name=\"v[11]\"><option selected value=11>".@$line1[11]."</option>$rep</select></td><td><input style=\"width:20%\" size=15 name=\"c[11]\" value=\"\"> <input type=checkbox value=YES name=k4><small>Add / Добавить &lt;img src=$fotobasebig/XXXX.JPG&gt;</small></td></tr>
<tr><td>".$lang[449].":</td><td><select style=\"width:100%\" name=\"v[12]\"><option selected value=12>".@$line1[12]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[12]\" value=\"\"></td></tr>
<tr><td>".$lang[427].":</td><td><select style=\"width:100%\" name=\"v[13]\"><option selected value=13>".@$line1[13]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[13]\" value=\"\"></td></tr>
<tr><td>".$lang[667].":</td><td><select style=\"width:100%\" name=\"v[14]\"><option selected value=14>".@$line1[14]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[14]\" value=\"\"></td></tr>
<tr><td>".$lang[668].":</td><td><select style=\"width:100%\" name=\"v[15]\"><option selected value=15>".@$line1[15]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[15]\" value=\"\"></td></tr>
<tr><td>".$lang[669].":</td><td><select style=\"width:100%\" name=\"v[16]\"><option selected value=16>".@$line1[16]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[16]\" value=\"\"> <input type=checkbox value=YES name=k5><small>Strip HTML tags / Очистить HTML теги</small></td></tr>
<tr><td>".$lang[670].":</td><td><select style=\"width:100%\" name=\"v[17]\"><option selected value=17>".@$line1[17]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[17]\" value=\"\"></td></tr>\n";
$c_filename="../templates/$template/$speek/custom_cart.inc";
$cc_cart="";
$cc_num=0;
if (@file_exists($c_filename)==TRUE) {
$custom_cart1=file("../templates/$template/$speek/custom_cart.inc");
if (@file_exists("../templates/$template/$speek/$ccfile.inc")) {
$custom_cart2=file("../templates/$template/$speek/$ccfile.inc");
$custom_cart=Array_merge($custom_cart1,$custom_cart2);
} else {
$custom_cart=$custom_cart1;
}
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")){
$ncc=18+$cc_num;
echo "<tr><td>".@$ccc[0].":</td><td><select style=\"width:100%\" name=\"v[".($ncc)."]\"><option selected value=".($ncc).">".@$line1[$ncc]."</option>$rep</select></td><td><input style=\"width:100%\" size=15 name=\"c[".($ncc)."]\" value=\"\"></td></tr>\n";
}
}
}
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

echo "<h4>XLS 97-2003 Import</h4>Data format / Поддерживаемый формат: <b>application/vnd.ms-excel</b> <br><br><form enctype='multipart/form-data' action='$htpath/admin/xls_import.php' method='POST'>
        <input type='hidden' name='submitted' value='true'>
               <input type='hidden' name='speek' value=\"$speek\">
                File name / Имя файла: <input name='" . $upload_file_name . "' type='file'>
                <input type='hidden' name='language' value='ru'>
<input type='submit' value='Upload / Загрузить'>
        </form>";
echo "<br><br>You can put big files directly in <b>$htpath/import/</b> directory<br>
Вы можете положить большие файлы прямо в в папку <b>$htpath/import/</b>, они будут отображены здесь.<br><br>";
$ff=0;
if (!is_dir("../import")) { mkdir("../import",0755); } else {
$handle=opendir("../import");

while (($ffile = @readdir($handle))!==FALSE) {

if (($ffile == '.') || ($ffile == '..')||(substr($ffile,-4)!=".xls")) {
continue;
} else {

$ff+=1;
echo "$ff. <b>$ffile</b>". " ". filesize("../import/$ffile")." bytes <button class=btn type=button onclick=\"javascript:location.href="."'"."$htpath/admin/xls_import.php?select=".rawurlencode($ffile).""."'".";\">Choose / Выбрать</button><br>\n";
}
}
@closedir($handle);

}
if ($ff==0) { echo "<b>$htpath/import/</b> - XLS files found / не найдены XLS файлы"; }
}

}
}
/*
$errr="";
$towrite="";
if ((!@$rep_dir) || (@$rep_dir=="")): $rep_dir=""; endif;
if ((!@$rep_dirsubdir) || (@$rep_dirsubdir=="")): $rep_dirsubdir=""; endif;
if ((!@$rep_dirsubdir2) || (@$rep_dirsubdir2=="")): $rep_dirsubdir2=""; endif;
if ((!@$koeff) || (@$koeff=="")): $koeff=1; endif;
if ((!@$rep_where) || (@$rep_where=="")): $rep_where=""; endif;

if (!preg_match("/^[0-9_]+$/",$rep_where)) { $rep_where=""; }
if (!preg_match("/^[0-9,.]+$/i",$koeff)) { $koeff=1; $errr="<p><p align=center><font color=#b94a48>".$lang[42]."</font></p>";}
$rep_dirsubdir2 = str_replace("/ " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace(" / " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("/ " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace(" / " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("  " , " ", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("  " , " ", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("  " , " ", $rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$koeff=str_replace(",",".",$koeff);

$rep_arr=array ("koeff", "rep_where", "rep_dir", "rep_dirsubdir", "rep_dirsubdir2");
while (list ($line_num, $a) = each ($rep_arr)) {
$$a = substr($$a, 0, 200);
$$a = str_replace("|" , " ", $$a);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace(chr(36) , "", $$a);
$$a = str_replace(chr(10) , " ", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
if(get_magic_quotes_gpc()) {$$a = stripslashes($$a);}
}
$koeff=doubleval($koeff);
$replace_list = "";
$s=0;
if (($valid=="1")&&($details[7]=="ADMIN")) {





if ($koeff==0){$koeff=1; echo "No need to recalc with koef 1";}


if (($koeff!=0)&&($koeff!=1)&&($rep_where!="")&&($rep_dirsubdir2!="")) {

$replace_list.="<p align=\"center\"><br><br><br>Multiplicate X <b>$koeff</b><br><br>";
$replace_list.="<table border=0>";




$s_filename="./templates/$template/$speek/custom_cart.inc";
if (@file_exists($s_filename)==TRUE) {
$custom_carts=file("./templates/$template/$speek/custom_cart.inc");
}


$file="$base_file";
$tmpfile="$base_loc/db_index.tmp";
@unlink($tmpfile);
$f=fopen($file,"r");

$tf=0;
$ff=0;
while(!feof($f)) {
$st=str_replace("\n", "", fgets($f));

$st= trim($st);
$out=explode("|",$st);


if (@$out[0]!="") {

if (isset($custom_carts)) {
reset($custom_carts);
while (list ($ss_num, $ss_line) = each ($custom_carts)) {
$sss=explode("|", $ss_line);
if (($ss_line!="")&&(@$sss[0]!="")&&(@$sss[1]!="")){
$nss=17+$ss_num;
if (!isset($out[$nss])) {
$out[$nss]="";
}
$nsm=18+$ss_num;
if (!isset($out[$nsm])) {
$out[$nsm]="";
}
}
}

}

reset ($out);
while (list ($o_num, $o_line) = each ($out)) {
$out[$o_num]=str_replace("\n","",$out[$o_num]);
}
reset($out);

$tf+=1;
$oldprrep=$out[$rep_where];
if ($rep_dirsubdir2=="_") {
$found=0;
if ($out[$rep_where]!=doubleval($out[$rep_where])) { $found=1;
	$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <font color=#b94a48><b>Unable to recalc \"".$out[$rep_where]."\" x $koeff</b></font></small></td></tr>\n";
	}

if ($found==0){
$out[$rep_where]=str_replace(",",".","".round((doubleval($out[$rep_where])*$koeff),2));
$ff+=1;
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <b>$oldprrep</b> => <b>".$out[$rep_where]."</b></small></td></tr>\n";
}
$st=implode("|", $out)."\n";



} else {
$rep_dirsubdir2=str_replace("/", "|",$rep_dirsubdir2);
$tmpds2=$out[1]."|".$out[2];
if ($tmpds2==$rep_dirsubdir2) {


$found=0;
if ($out[$rep_where]!=doubleval($out[$rep_where])) { $found=1;
	$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <font color=#b94a48><b>Unable to recalc \"".$out[$rep_where]."\" x $koeff</b></font></small></td></tr>\n";
	}

if ($found==0){
$out[$rep_where]=str_replace(",",".","".round((doubleval($out[$rep_where])*$koeff),2));
$ff+=1;
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <b>$oldprrep</b> => <b>".$out[$rep_where]."</b></small></td></tr>\n";
}
$st=implode("|", $out)."\n";




}
}

$towrite.=$st."\n";
}

}
$f2=fopen($tmpfile,"w");
fputs ($f2, str_replace("\n\n", "\n", str_replace("\n\n", "\n",$towrite)));
fclose($f2);
fclose($f);
unlink($file);
rename ($tmpfile,$file);


$replace_list.="<tr><td><hr>".$lang[32].": <b>$tf</b><br>".$lang[657].": <b>$ff</b></td></tr></table>";
if ($ff>0):$replace_list.= "<br><br><a href=\"$htpath/admin/indexator.php?speek=$speek\">".$lang[658]."</a>"; endif;
$replace_list.= "</p>";

} else {
$replace_list.= "$errr";
}















$fcontents = file("$base_file");

$allrazdels=$fcontents;
while (list ($line_num, $line) = each ($allrazdels)) {
$out=explode("|",$line);
$tmpsubrazdels[$st] = $out[1]. "|" . $out[2];
$st += 1;
}
reset ($tmpsubrazdels);
$tmpsub= array_unique ($tmpsubrazdels);
while (list ($line_num, $line) = each ($tmpsub)) {
$out=explode("|",$line);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
$subr[$ra] .= "$out[1]|";
}

$razdel="";
while (list ($line_num, $line) = each ($subr)) {
$out=explode("|",$line);
while (list ($line_num2, $line2) = each ($out)) {
if ($line2!=""): $razdel .= "<option value=\"$line_num/$line2\">$line_num / $line2</option>\n"; endif;
}
}


//тут форма ввода
//int_code0|dir1|subdir2|name3|price4|opt5|ext_code6|descr7|keywords8|icon9|photo10|vitrina11|onsale12|brand13|attachment14|fulldescr15|stock16|
$replace_list.="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\"><input type=hidden name=\"action\" value=\"recalc\"><input type=hidden name=\"rep_dir\" value=\"\"><input type=hidden name=\"rep_dirsubdir\" value=\"\">
<p align=\"center\"><br><br><b>".$lang[659]."</b><br><small><b>".$lang[211]."</b> ".$lang[660]."<br>".$lang[661]." <a href=\"admin/backup.php\" target=\"_blank\"><b>BACKUP</b></a></small><br><br>
<table border=0 cellspacing=0 cellpadding=5>
<tr>
<td align=right>Koef. X</td><td><input type=text size=30 name=\"koeff\" value=\"1\"> <i>ex.</i> 1.05</td>
</tr>
<tr>
<td align=right>".$lang[663].":<br><br>".$lang[664].":</td><td>
<select name=\"rep_where\">
<option value=\"\">-------".$lang['choose']."-------</option>
<option value=1>".$lang[430]."</option>
<option value=2>".$lang[431]."</option>
<option value=3>".$lang['name']."</option>
<option value=4>".$lang['price']."</option>
<option value=5>".$lang[148]."</option>
<option value=6>".$lang[419]."</option>
<option value=7>".$lang['short']."</option>
<option value=8>".$lang[653]."</option>
<option value=9>".$lang[665]."</option>
<option value=10>".$lang[666]."</option>
<option value=13>".$lang[667]."</option>
<option value=14>".$lang[668]."</option>
<option value=15>".$lang[669]."</option>
<option value=16>".$lang[670]."</option>
";
//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";
$cc_cart="";
if (@file_exists($c_filename)==TRUE) {
$custom_cart=file("./templates/$template/$speek/custom_cart.inc");
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")){
$ncc=17+$cc_num;
$replace_list.="<option value=$ncc>".@$ccc[0]."</option>\n";
}
}
}
//end

$replace_list.="</select><br><br>
<select name=\"rep_dirsubdir2\"\">
<option value=\"\">-------".$lang['choose']."-------</option>
$razdel
<option value=\"\">----------------------</option>
<option value=\"_\">".$lang[671]."</option>
</select></td>
</tr>
</table>
<br><input type=\"submit\" class=\"btn btn-primary\" value=\"OK\"></form>";





$replace_list.="</p>";
}
*/
?>
</body>
</html>
