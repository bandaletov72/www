<?php
$oldel="";
$xml_output="";
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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");$fold="..";
require ("../templates/$template/css.inc");
echo "<!DOCTYPE html><html>
<TITLE>ADMIN</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
";
echo $css;
echo "</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
<small> ";
$xml_output="";
function detect_utf($Str) {
 for ($i=0; $i<strlen($Str); $i++) {
  if (ord($Str[$i]) < 0x80) $n=0; # 0bbbbbbb
  elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xF0) $n=3; # 1111bbbb
  else return false; # Does not match any model
  for ($j=0; $j<$n; $j++) { # n octets that match 10bbbbbb follow ?
   if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80)) return false;
  }
 }
 return true;
}


//##


function utf8_win ($s){
$out="";
$c1="";
$byte2=false;
for ($c=0;$c<strlen($s);$c++){
$i=ord($s[$c]);
if ($i<=127) $out.=$s[$c];
if ($byte2){
$new_c2=($c1&3)*64+($i&63);
$new_c1=($c1>>2)&5;
$new_i=$new_c1*256+$new_c2;
if ($new_i==1025){
$out_i=168;
}else{
if ($new_i==1105){
$out_i=184;
}else {
$out_i=$new_i-848;
}
}
$out.=chr($out_i);
$byte2=false;
}
if (($i>>5)==6) {
$c1=$i;
$byte2=true;
}
}
return $out;
}



function startElement($parser, $name, $attrs) {
global $dd;
global $oldel;
    global $depth;
    global $xml_output;
if ($name=="ITEM") {$xml_output.= "\n";}

    $depth++; // увеличиваем глубину, чтобы браузер показал отступы

    foreach ($attrs as $attr => $value) {
        // выводим имя атрибута и его значение
       if (($value=="photo")||($value=="size")) { } else {$xml_output.= '|'; }

if ( extension_loaded('mb_string') ) {
	$value = mb_convert_encoding($value, $codepage, "utf-8");
   } elseif ( extension_loaded('iconv') ) {
   $value = iconv('utf-8', $codepage, $value);
   }
   if (($value=="photo")||($value=="size")) {
   	if ($oldel!=$value) {$xml_output.= "|";}
   	$dd=1;
   	if ($value=="photo") {
   		$xml_output.= "<img src=";} else {
   	$xml_output.= $value."=";}
   	} else {$xml_output.= $value; $dd=0;}
   	$oldel=$value;

    }
}

function endElement($parser, $name) {
    global $depth;
    global $oldel;
    global $dd;
    global $xml_output;
    $depth--; // уменьшаем глубину
}



if ((!isset($xmlurl))||($xmlurl=="")) {$xmlurl="";}
if ($xmlurl!="") {



$depth = 0;
$file  = "$xmlurl";

$xml_parser = xml_parser_create();

xml_set_element_handler($xml_parser, "startElement", "endElement");

if (!($fp = fopen($file, "r"))) {
    die("could not open XML input");
}

while ($data = fgets($fp)) {

    if (!xml_parse($xml_parser, $data, feof($fp))) {
        echo "<br>XML Error: ";
        echo xml_error_string(xml_get_error_code($xml_parser));
        echo " at line ".xml_get_current_line_number($xml_parser);
        break;
    }
    if ($dd==1) {
    	if ( extension_loaded('mb_string') ) {
	$valued = mb_convert_encoding($data, $codepage, "utf-8");
   } elseif ( extension_loaded('iconv') ) {
   $valued = iconv('utf-8', $codepage, $data);
   }
    	if (trim(strip_tags($valued))!="") { if ($oldel=="photo") {$xml_output.= "'".trim(strip_tags($valued))."' border=0><br>"; } else { $xml_output.= "".trim(strip_tags($valued))."<br>";} }}
}

xml_parser_free($xml_parser);




/**********************************************************
* The END *
**********************************************************/
//echo "<pre>$xml_output</pre>";
//exit;

if ($xml_output!="") {
$files=fopen("./sklad/xml.txt", "w");
if (!$files) {echo "Не могу записать в файл ./sklad/xml.txt"; exit;}
flock ($files, LOCK_EX); fputs ($files, "$xml_output");flock ($files, LOCK_UN);
fclose ($files);
echo "<br><h1>Успешно! Перехожу к импорту в базу через 3 сек...</h1><textarea style=\"width:100%\" rows=5 cols=64>$xml_output</textarea><meta http-equiv=\"Refresh\" content=\"3; URL=./import.php?speek=rus&ymlfile=xml.txt\">";
} else {
echo "<br><h1>Операция НЕ УДАЛАСЬ!</h1>Попробуйте задать другой xml URL.";
}

} else {
echo "<h4>Импорт из внешнего xml файла</h4>";
echo "<form class=form-inline action=\"\" method=POST>
<table border=0 cellpading=5 cellspacing=5>
<tr>
<td valign=top bgcolor=$nc6>Укажите URL-источник xml:</td><td><input type=text name=\"xmlurl\" value=\"$xmlurl\" size=64 style=\"width:100%\"><br><small><b>Например:</b> <i>$htpath/xml.php</i></small></td>
</tr>
<tr><td colspan=2 align=center><br><input type=submit value=\"Далее &gt;&gt;\"></td></tr>
</form>";

}
echo "</small>";
?>
</body>
</html>