<!DOCTYPE html><html>
<head>
<meta name="expires" content="0"><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>Choose local file</title>
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
echo "</head><body>

<h4>Межсерверный обмен файлами</h4>
Выберите файл нужный файл из локального списка и нажмите [<b>+</b>] рядом с ним.<br><br>
";
if ((!@$file) || (@$file=="")){ $file=""; }
if (!preg_match("/^[a-zA-Z0-9_\.-]+$/i",$file)) { $file=""; }
if ((!@$ftp_dir) || (@$ftp_dir=="")){ $ftp_dir=""; }
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$ftp_dir)) { $ftp_dir=""; }
if ((!@$action) || (@$action=="")){ $action=""; }
if (!preg_match("/^[a-z0-9_\/-]+$/i",$action)) { $action=""; }

  if ($ftp_dir==""){
  echo "Листинг <b>корневого</b> каталога<br>";
  $root="";
  $rooty="";
  if (!isset($_SERVER['DOCUMENT_ROOT'])) {$ftp_dir="";} else {
  $ftp_dir=$_SERVER['DOCUMENT_ROOT'];
  }
  } else {
  echo "Листинг каталога <b>$ftp_dir</b><br>";
  $root_mass=explode ("/", $ftp_dir);
  array_pop($root_mass);
  $rooty=implode ("/", $root_mass);
  $root="<a href=\"".$_SERVER['PHP_SELF']."?ftp_dir=". $rooty ."&action=enter\">..</a> <small>[ возврат ]</small><br>";
  }
  echo $root;
  $i=0;
echo @$_SERVER['DOCUMENT_ROOT'];
$handle=@opendir("/$ftp_dir");
$i=0;
while (($val=@readdir($handle))!==FALSE) {
if (($val==".")||($val=="..")) { continue;} else {
$path="/$ftp_dir/";
if ($path=="//"){$path="/";}
if (is_dir("$path$val")==TRUE) {
$tmp_mass[$i]= "<!-- 0 $val --><tr><td><a href=\"".$_SERVER['PHP_SELF']."?ftp_dir=".substr("$path$val", 1)."&action=enter\">".str_replace ("$ftp_dir/", "", $val)."</a></td><td><small>[ <b>DIR</b> ]</small></td><td> </td></tr>\n";
} else {
$fsize=filesize("$path$val");
$tmp_mass[$i]=  "<!-- 1 $val --><tr><td>".str_replace ("$ftp_dir/", "", $val)."</td><td><small><b>". $fsize. "</b> bytes</small></td><td><small>". date ("d-m-Y H:i:s", filemtime("$path$val"))."</small> [<a title=\"Добавить файл в задание на копирование\" href=\"ftpcopy.php?local_file=".str_replace ("$ftp_dir/", "", $val)."&local_dir=/$ftp_dir\"><b>+</b></a>]</td></tr>\n";
}
$i+=1;
}
}
  /* upload a file
  if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
   echo "successfully uploaded $file<br>";
  } else {
   echo "There was a problem while uploading $file<br>";
  }

  */
  // close the connection
@closedir($handle);

@sort($tmp_mass);
@reset($tmp_mass);
echo "<table border=0>";
while (list ($key, $val) = @each ($tmp_mass)) {
echo $val;
}
echo "</table>";



?>
<hr size=1><p align=center><small>PHP File Transfer<br>(c) EuroWebcart</small></p></body></html>
