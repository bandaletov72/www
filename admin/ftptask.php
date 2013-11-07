<!DOCTYPE html><html>
<head>
<meta name="expires" content="0"><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>FTP Exchange</title>
</head>
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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
$fold="..";
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
echo "</head><body><font face=Verdana>
<table border=0><tr><td width=70% valign=top><h4>Выполнение всех заданий</h4>
";
//список заданий
$handle=@opendir("./ftpcopy");
$i=0;
while (($val=@readdir($handle))!==FALSE) {
if (($val==".")||($val=="..")) { continue;} else {

$fcon=file("./ftpcopy/$val");
echo "<li><small><b>Задание ".($i+1)."</b><br>".
str_replace("copy", "Копировать", $fcon[0]). " файл ".$fcon[1]." на сервер ".$fcon[2]." на место ".$fcon[5]."</small></li><br>\n";
echo "<small>Выполнение задания <b>".($i+1)."</b><br>";
$from=str_replace("\n", "", $fcon[1]);
$ext=strtolower(substr("$from", -4));
$host=str_replace("\n", "", $fcon[2]);
$ftp_user_name=str_replace("\n", "",$fcon[3]);
$ftp_user_pass=str_replace("\n", "",$fcon[4]);
$to=str_replace("\n", "", $fcon[5]);
$hostip = gethostbyname($host);
$conn_id = ftp_connect($hostip);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// IMPORTANT!!! turn passive mode on
ftp_pasv ( $conn_id, true );

if ((!$conn_id) || (!$login_result)) {
  echo "FTP connection has failed!";
  echo "Attempted to connect to $host for user $ftp_user_name";
  die;
} else {
if (($ext==".txt")||($ext==".htm")||($ext==".inc")||($ext==".php")||($ext=="php4")||($ext=="html")){
//upload a ASCII file
  if (ftp_put($conn_id, $to, $from, FTP_ASCII)) {
   echo "<b>Успешно загружен на $to в режиме ASCII!</b><br>";
  } else {
   echo "Проблема загрузки $to<br>";
  }
}else {
//upload a BINARY file
  if (ftp_put($conn_id, $to, $from, FTP_BINARY)) {
   echo "<b>Успешно загружен на $to в режиме BINARY!</b><br>";
  } else {
   echo "Проблема загрузки $to<br>";
  }
}
  }

  ftp_close($conn_id);
echo "</small><br>";
$i+=1;

}
}
if ($i==0) {echo "<b>- Нет заданий для копирования!</b><br><br>";}
//конец списка заданий



?>
<hr size=1><p align=center><small>PHP File Transfer<br>(c) EuroWebcart</small></p></font></body></html>
