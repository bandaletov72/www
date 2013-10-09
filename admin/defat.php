<?php
$nn=0;
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
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
$rrating="";

$sortas=0;
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

require ("../modules/translit.php");

echo "
<!DOCTYPE html><html>
<TITLE>INDEX</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body bgcolor=#ffffff>
";


$fold="..";
require "../modules/functions.php";
require "../templates/$template/css.inc";

//echo $css;


$st=0;
$defated="";
$file=".$base_file";
$f=fopen($file,"r");
$zf=0;
$rating=Array();
while(!feof($f)) {
echo "\n";

$stun=fgets($f);
if (($stun!="\n")&&($stun!="")) {
$out=explode("|",$stun);
$unifw=md5(@$out[3]." ID:".@$out[6]);
$defa="";
echo "<font color=#b94a48>". strlen($out[7])."</font> ";
if ((strlen($out[15])>250)||(strlen($out[7])>250)) {
if (strlen($out[15])>250) {$defa=$out[15]; $out[15]="";}

if (strlen($out[7])>250) {$defa=$out[7]."<br>".$defa; $out[7]="";}

$fman=@fopen(".$base_loc/content/z_".$unifw.".txt","w");
echo "writing <b>"."$base_loc/content/z_".$unifw.".txt"."</b><br>\n";
@fputs($fman,"==".$out[3]."==".$defa);
@fclose($fman);

if ((trim($out[14])=="")||(trim($out[14])==" ")) {
$out[14]="z_".$unifw;
} else {
$tosave=Array();
$tosave[]="z_".$unifw;
$tmp=explode(" ", $out[14]);

while (list($key,$val)=each($tmp)) {
if (trim($val)!="z_".$unifw) {

$tosave[]="$val";

}
}

$out[14]=implode(" ", $tosave);

}
}
$strl=implode("|", $out);
$defated.=$strl;
echo strip_tags($strl)."<br>";
unset($out,$tmp);
}





$st+=1;

}
fclose($f);

$bkupf=".$base_loc/db_index.backup";
copy (".$base_file", $bkupf);
$bkupf=".$base_loc/db_index.defat";
$mb=fopen($bkupf,"w");
fputs($mb,$defated);
fclose($mb);
unlink (".$base_file");
copy ($bkupf, ".$base_file");

echo "<h4>OK</h4>";

?>
</body>
</html>
