<?php
$mysql_output="";
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
require ("../modules/translit.php");
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}

function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ");
   return strtolower($str);
}
function toUpper($str) {
$str = strtr($str, "àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ",
"ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß");
   return strtoupper($str);
}

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
$mysql_output="";
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


if(isset($_GET['mysqlurl'])) $mysqlurl=$_GET['mysqlurl']; elseif(isset($_POST['mysqlurl'])) $mysqlurl=$_POST['mysqlurl']; else $mysqlurl="";
if(isset($_GET['mysqlserver'])) $mysqlserver=$_GET['mysqlserver']; elseif(isset($_POST['mysqlserver'])) $mysqlserver=$_POST['mysqlserver']; else $mysqlserver=$mysql_server;
if(isset($_GET['mysqluser'])) $mysqluser=$_GET['mysqluser']; elseif(isset($_POST['mysqluser'])) $mysqluser=$_POST['mysqluser']; else $mysqluser=$mysql_user;
if(isset($_GET['mysqlpass'])) $mysqlpass=$_GET['mysqlpass']; elseif(isset($_POST['mysqlpass'])) $mysqlpass=$_POST['mysqlpass']; else $mysqlpass=$mysql_pass;
if(isset($_GET['mysqldbname'])) $mysqldbname=$_GET['mysqldbname']; elseif(isset($_POST['mysqldbname'])) $mysqldbname=$_POST['mysqldbname']; else $mysqldbname=$mysql_db_name;
if(isset($_GET['mysqldbtable'])) $mysqldbtable=$_GET['mysqldbtable']; elseif(isset($_POST['mysqldbtable'])) $mysqldbtable=$_POST['mysqldbtable']; else $mysqldbtable="";

if(isset($_GET['step'])) $step=$_GET['step']; elseif(isset($_POST['step'])) $step=$_POST['step']; else $step=0;
if (!preg_match("/^[0-9]+$/",$step)) { $step=0;}
$step=doubleval($step);

if ($mysqlurl!="") {


if ($mysql_output!="") {
$files=fopen("./sklad/mysql.txt", "w");
if (!$files) {echo "Error writing file./sklad/mysql.txt"; exit;}
flock ($files, LOCK_EX); fputs ($files, "$mysql_output");flock ($files, LOCK_UN);
fclose ($files);
echo "<br><h1>Success! Wait 3 sec...</h1><textarea style=\"width:100%\" rows=5 cols=64>$mysql_output</textarea><meta http-equiv=\"Refresh\" content=\"3; URL=./import.php?speek=rus&mysqlfile=mysql.txt\">";
} else {
echo "<br><h1>ERROR!</h1>Try another MYSQL URL.";
}

} else {
echo "<h4>Import MYSQL tables</h4>";
if ($step==0) {

echo "<h4>STEP 1</h4>Checking MySQL connection
<form class=form-inline action=mysql_import.php method=GET>
<input type=hidden name=step value=1>
<input type=hidden name=speek value=$speek>

<table border=0>
<tr><td>MySQL server:</td><td><input type=text name=mysqlserver value=\"".$mysql_server."\" size=40></td></tr>
<tr><td>MySQL user:</td><td><input type=text name=mysqluser value=\"".$mysql_user."\" size=40></td></tr>
<tr><td>MySQL password:</td><td><input type=text name=mysqlpass value=\"".$mysql_pass."\" size=40></td></tr>
</table>
<div align=left><input type=submit value=\"Connect\"></div></form>";
} else {
if ($step==1) {
# Ñîåäèíÿåìñÿ, âûáèðàåì áàçó äàííûõ
$mysql_link = mysql_connect($mysqlserver, $mysqluser, $mysqlpass) or die("<h4>Error MySQL connection</h4>" . mysql_error()."<br>Please try again...<meta http-equiv=\"Refresh\" content=\"3; URL=./mysql_import.php?speek=rus&step=0\">");
//print "MySQL Connected successfully...<br>\n";
$mass=get_databases();
$dbases="<option value=\"$mysql_db_name\" selected>$mysql_db_name</option>";
while (list($key,$val)=each($mass)) {
$dbases.="<option value=\"$val\">$val</option>";
}
echo "<h4>STEP 2</h4>Select DESTINATION MySQL base
<form class=form-inline action=mysql_import.php method=GET>
<input type=hidden name=step value=2>
<input type=hidden name=speek value=$speek>
<table border=0>
<tr><td>MySQL DB NAME:</td><td><select name=mysqldbname>$dbases</select></td></tr>
<input type=hidden name=mysqlserver value=\"".$mysqlserver."\" size=40>
<input type=hidden name=mysqluser value=\"".$mysqluser."\" size=40>
<input type=hidden name=mysqlpass value=\"".$mysqlpass."\" size=40>
</table>
<div align=left><input type=submit value=\"Select\"></div></form>";

mysql_close($mysql_link);
}else {
if ($step==2) {
$mysql_link = mysql_connect($mysqlserver, $mysqluser, $mysqlpass) or die("<h4>Error MySQL connection</h4>" . mysql_error()."<br>Please try again...<meta http-equiv=\"Refresh\" content=\"3; URL=./mysql_import.php?speek=rus&step=0\">");
//print "MySQL Connected successfully...<br>\n";
# Âûáèðàåì áàçó äàííûõ
mysql_select_db("$mysqldbname");
if (mysql_errno()) die("<h4>Error MySQL select base `".$mysqldbname."`</h4>" . mysql_error()."<br>Please try again...<meta http-equiv=\"Refresh\" content=\"3; URL=./mysql_import.php?speek=rus&step=1\">");
$mass=get_database_tables();
$dbtables="";
while (list($key,$val)=each($mass)) {
$dbtables.="<option value=\"$val\">$val</option>";
}
echo "<h4>STEP 2</h4>Select MySQL table to IMPORT
<form class=form-inline action=mysql_import.php method=GET>
<input type=hidden name=step value=3>
<input type=hidden name=speek value=$speek>
<table border=0>
<tr><td>MySQL DB TABLE:</td><td><select name=mysqldbtable>$dbtables</select></td></tr>
<input type=hidden name=mysqldbname value=\"".$mysqldbname."\" size=40>
<input type=hidden name=mysqlserver value=\"".$mysqlserver."\" size=40>
<input type=hidden name=mysqluser value=\"".$mysqluser."\" size=40>
<input type=hidden name=mysqlpass value=\"".$mysqlpass."\" size=40>
</table>
<div align=left><input type=submit value=\"IMPORT\"></div></form>";
}else {
if ($step==3) {
$mysql_link = mysql_connect($mysqlserver, $mysqluser, $mysqlpass) or die("<h4>Error MySQL connection</h4>" . mysql_error()."<br>Please try again...<meta http-equiv=\"Refresh\" content=\"3; URL=./mysql_import.php?speek=rus&step=0\">");
mysql_select_db("$mysqldbname");
if (mysql_errno()) die("<h4>Error MySQL select base `".$mysqldbname."`</h4>" . mysql_error()."<br>Please try again...<meta http-equiv=\"Refresh\" content=\"3; URL=./mysql_import.php?speek=rus&step=1\">");
$query="SELECT * FROM `".$mysqldbtable."`";
$result=mysql_query("$query");
if (mysql_errno()) die("<h4>Error access to MySQL table `".$mysqldbtable."`</h4>" . mysql_error()."<br>Please try again...<meta http-equiv=\"Refresh\" content=\"3; URL=./mysql_import.php?speek=rus&step=2\">");
$strk=Array();
$strks="";
@unlink("./sklad/mysql.txt");
$fp=fopen("./sklad/mysql.txt", "a");
while($row = mysql_fetch_row($result))
  {
  echo "\n";
  $strks="";
  while(list($k,$v)=each($row)) {
  $strks.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";
  }
  fputs($fp,$strks."\n");
  }
  fclose($fp);

echo "<br><h1>Preparing success! Proceed to IMPORT. Wait 3 sec ...</h1><meta http-equiv=\"Refresh\" content=\"3; URL=./import.php?speek=rus&ymlfile=mysql.txt\">";

}
}
}
}
//here

}
echo "</small>";
?>
</body>
</html>
