<?php
$yml_output="";
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
echo "</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
<small> ";
$yml_output="";
if ((!isset($reg_exp2))||($reg_exp2=="")) {
$reg_exp2  = '#<offer id="(.*?)".*?available="(.*?)">.*?<url>(.*?)</url>.*?<price>(.*?)</price>.*?<currencyId>(.*?)</currencyId>.*?<categoryId>(.*?)</categoryId>.*?<picture>(.*?)</picture>.*?<delivery>(.*?)</delivery>.*?<name>(.*?)</name>.*?<vendor>(.*?)</vendor>.*?<vendorCode>(.*?)</vendorCode>.*?<description>(.*?)</description>.*?</offer>#si'; //исправлено
}
if(get_magic_quotes_gpc()) {$reg_exp2 = stripslashes($reg_exp2);}

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
/**********************************************************
* Parse XML data into an array structure *
* Usage: array parse_YML ( string data ) *
**********************************************************/
function parse_YML2($reg_exp, $xml_data) {

   preg_match_all($reg_exp, $xml_data, $temp);
   return array(
       'count'=>count(@$temp[0]),
       'id'=>@$temp[1],
       'available'=>@$temp[2],
       'url'=>@$temp[3],
       'price'=>@$temp[4],
       'currencyId'=>@$temp[5],
       'categoryId'=>@$temp[6],
       'picture'=>@$temp[7],
       'delivery'=>@$temp[8],
       'name'=>@$temp[9],
       'vendor'=>@$temp[10],
       'vendorCode'=>@$temp[11],
       'description'=>@$temp[12]
   );
}

function parse_YML1($reg_exp, $xml_data) {
   preg_match_all($reg_exp, $xml_data, $temp);
   return array(
       'count'=>count(@$temp[0]),
       'categoryId'=>@$temp[1],
       'parentId'=>@$temp[2],
       'name'=>@$temp[3]
   );
}

/**********************************************************
* Parse Array data into an HTML structure *
* Usage: string parse_YML ( array data ) *
**********************************************************/

function output_YML2($pattern, $yml_data, $cats) {
   $temp = "";
   for($i=0; $i<$yml_data['count']; $i++) {
   $ndx=html_entity_decode($yml_data['categoryId'][$i]);
   $catid=$cats[$ndx];
       $temp .= sprintf($pattern,
           html_entity_decode($yml_data['id'][$i]),
           $catid,
           html_entity_decode(str_replace("\n","<br>", str_replace("\r","<br>",$yml_data['name'][$i]))),
           html_entity_decode($yml_data['price'][$i]),
           html_entity_decode($yml_data['vendorCode'][$i]),
           html_entity_decode(str_replace("\n","<br>", str_replace("\r","<br>",$yml_data['description'][$i]))),
           html_entity_decode(str_replace("\n","<br>", str_replace("\r","<br>","<img src='".$yml_data['picture'][$i]."' border=0>"))),
           str_replace("false",0, str_replace("true",1,html_entity_decode($yml_data['available'][$i]))),
           html_entity_decode($yml_data['vendor'][$i]),

           html_entity_decode($yml_data['url'][$i]),
           html_entity_decode($yml_data['currencyId'][$i]),
           str_replace("false",0, str_replace("true",1,html_entity_decode($yml_data['delivery'][$i])))

       );
   }
   return $temp;
}

function output_YML1($pattern, $yml_data) {
   $temp = "";
   for($i=0; $i<$yml_data['count']; $i++) {
       $temp .= sprintf($pattern,
           html_entity_decode($yml_data['categoryId'][$i]),
           str_replace(" parentId=","",str_replace("\"","",html_entity_decode($yml_data['parentId'][$i]))),
           html_entity_decode(str_replace("\n","<br>", str_replace("\r","<br>",$yml_data['name'][$i])))

       );
   }
   return $temp;
}

if ((!isset($ymlurl))||($ymlurl=="")) {$ymlurl="";}
if ($ymlurl!="") {



//1-й прогон выясняю category ID
$reg_exp1 = '#<category id=\"(.*?)\"(.*?)>(.*?)</category>#si';

$pattern1 = "%s|%s|%s|\n";


//2-й прогон парсю YML

/**********************************************************
* Settings *
**********************************************************/


$pattern2 = "%s|%s|%s|%s||%s|%s||%s|||%s|%s|%s|%s|%s|\n";
//строка форматирования вывода, можно переставить местами поля и добавить теги

/**********************************************************
* Main script *
**********************************************************/
if ( $xml_data = file_get_contents($ymlurl) ) {

   if ( extension_loaded('mb_string') ) { echo "<br><b>mb_string</b> $from -&gt; $to<br>";
       $xml_data = mb_convert_encoding($xml_data, $to, $from);
   } elseif ( extension_loaded('iconv') ) { echo "<br><b>ikonv</b> $from -&gt; $to<br>";
       $xml_data = iconv($from, $to, $xml_data);
   }
   $xml_data=str_replace("|","/",str_replace("\n","<br>",str_replace("\r","<br>",  $xml_data)));
   $yml_data1 =  parse_YML1($reg_exp1, $xml_data);


   $yml_cur1="";
   $yml_cur1=output_YML1($pattern1, $yml_data1);
   if ($yml_cur1!="") { $yml_output.=""; echo "Stage-1 OK<br>";
   $tmps=explode("\n",$yml_cur1);
   echo "<br><b>Listing1:</b><br>";
   while(list($key,$val)=each($tmps)){
   $tms=explode("|",$val);
   if (@$tms[2]!="") {
   if (@$tms[1]=="") {
   $ndx=$tms[0];
   $catidname[$ndx]=$tms[2];
   $cat[$ndx]=$tms[2]."|";
   echo $cat[$ndx]."<br>";
   }
   }
   }
   reset ($tmps);
   echo "<br><b>Listing2:</b><br>";
   while(list($key,$val)=each($tmps)){
   $tms=explode("|",$val);
   if (@$tms[1]!="") {
   $ndx=$tms[1];
   $tms[1]=$catidname[$ndx];
   $ndx=$tms[0];
   $cat[$ndx]="$tms[1]|$tms[2]";
   echo $cat[$ndx]."<br>";
   }
   }

   }else { echo " - YML data not recognized<br>";}

   echo $reg_exp2;
   $yml_data2 = parse_YML2($reg_exp2, $xml_data);
   $yml_cur2="";
   $yml_cur2=output_YML2($pattern2, $yml_data2, $cat);
   if ($yml_cur2!="") { $yml_output.="$yml_cur2"; echo "<br>Stage-2 OK<br>";
   }else { echo " - YML data not recognized<br>";}
}

/**********************************************************
* The END *
**********************************************************/
if ($yml_output!="") {
$files=fopen("./sklad/yml.txt", "w");
if (!$files) {echo "Error writing file./sklad/yml.txt"; exit;}
flock ($files, LOCK_EX); fputs ($files, "$yml_output");flock ($files, LOCK_UN);
fclose ($files);
echo "<br><h1>Success! Wait 3 sec...</h1><textarea style=\"width:100%\" rows=5 cols=64>$yml_output</textarea><meta http-equiv=\"Refresh\" content=\"3; URL=./import.php?speek=rus&ymlfile=yml.txt\">";
} else {
echo "<br><h1>ERROR!</h1>Try another YML URL.";
}

} else {
echo "<h4>Import YML from URL</h4>";
echo "<form class=form-inline action=\"\" method=POST>
<table border=0 cellpading=5 cellspacing=5>
<tr>
<td valign=top bgcolor=$nc6>Specify URL of YML data:</td><td><input type=text name=\"ymlurl\" value=\"$ymlurl\" size=64 style=\"width:100%\"><br><small><b>Example:</b> <i>$htpath/yml.php</i></small></td>
</tr>
<tr>
<td valign=top bgcolor=$nc6>From Encoding:</td><td><input type=text name=\"from\" value=\"".@$from."\" size=64 style=\"width:100%\"><br><small><b>Example:</b> <i>utf-8</i></small></td>
</tr>
<tr>
<td valign=top bgcolor=$nc6>To Encoding:</td><td><input type=text name=\"to\" value=\"$codepage\" size=64 style=\"width:100%\"><br><small><b>Example:</b> <i>windows-1251</i></small></td>
</tr>
<tr>
<td valign=top bgcolor=$nc6>Regexp:</td><td><textarea name=\"reg_exp2\" rows=10 style=\"width:100%\">$reg_exp2</textarea><br><small><b>Example:</b> <i>#&lt;offer id=\"(.*?)\".*?available=\"(.*?)\">.*?&lt;url>(.*?)&lt;/url>.*?&lt;price>(.*?)&lt;/price>.*?&lt;currencyId>(.*?)&lt;/currencyId>.*?&lt;categoryId>(.*?)&lt;/categoryId>.*?&lt;picture>(.*?)&lt;/picture>.*?&lt;delivery>(.*?)&lt;/delivery>.*?&lt;name>(.*?)&lt;/name>.*?&lt;vendor>(.*?)&lt;/vendor>.*?&lt;vendorCode>(.*?)&lt;/vendorCode>.*?&lt;description>(.*?)&lt;/description>.*?&lt;/offer&gt;#si</i></small></td>
</tr>
<tr><td colspan=2 align=center><br><input type=submit value=\"NEXT &gt;&gt;\"></td></tr>
</form>";

}
echo "</small>";
?>
</body>
</html>
