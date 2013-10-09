<?php

set_time_limit(0);
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
require ("../templates/$template/css.inc");
require ("../templates/$template/set_currency_parser.inc");
echo "<!DOCTYPE html><html>
<TITLE>Currency Parser</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body>";
echo "$css<h1>Currency Parser</h1>";
echo "<h4><a href=$parseurl>$parseurl</a></h4>";
$use_curl=0;
if (function_exists('curl_init')) {
$use_curl=1;
}
if ($use_curl==1) {
$req = $parseurl;
$ch = curl_init($req);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$fbcontent = curl_exec($ch);
if (curl_errno($ch))
exit('Parse URL failed! Curl returns errors.');
curl_close($ch);
} else {
$fbcontent=file_get_contents($parseurl);
}
if ($fbcontent=="") {
exit('Parse URL failed! No data read.');
} else {
if ( extension_loaded('mb_string') ) {
       $fbcontent = mb_convert_encoding($fbcontent, "utf-8", "windows-1251");
   } elseif ( extension_loaded('iconv') ) {
       $fbcontent = iconv("utf-8", "windows-1251", $fbcontent);
   }
$fbcontent=strip_tags($fbcontent);
$fbcontent=str_replace(strtoken($fbcontent,$from),"",$fbcontent);
$fbcontent=strtoken($fbcontent,$to);
$fbcontent=str_replace($from,"",$fbcontent);
$fbcontent=trim(str_replace(" \n","\n",str_replace("\n ","\n",str_replace("  "," ",str_replace("  "," ",str_replace("  "," ",str_replace("  "," ",$fbcontent)))))));
$fbcontent=trim(str_replace("\n\n","\n",str_replace("\n\n","\n",$fbcontent)));
$fbcontent=trim(str_replace(" (","|",str_replace(") ","|",$fbcontent)));
$fbcontent=trim(str_replace(" ","|",$fbcontent));

$currmas=explode("\n",$fbcontent);

$kursdate=trim($currmas[0]);
$to_cur_rate=1;
echo "<b>Currency rate date:</b> $kursdate</b>\n"."<br><b>Currencies to use:</b> ".implode(", ", $use_curr)."<br>";
echo "<table border=0 cellspacing=10><tr><td valign=top><b>$from_cur rate\n"."</b><br>";
echo "'$from_cur'"."=&gt;1,\n"."<br>";
unset ($currmas[0]);
while(list($key,$val)=each($currmas)) {
$cur=explode("|",trim($val));
$rated=round((doubleval($cur[2])/doubleval($cur[1])), (4+doubleval(strlen($cur[1])-1)));
echo "'".$cur[0]."'"."=&gt;".$rated.",\n"."<br>";
if ($cur[0]=="$to_cur") { $to_cur_rate=$rated; }
}
echo "</td><td valign=top><b>$to_cur rate\n"."</b><br>";
$rated=round((1/$to_cur_rate),(4+doubleval(strlen($cur[1])-1)));
echo "'$from_cur'"."=&gt;".$rated.",\n"."<br>";
$curr_use[$from_cur]=$rated;
reset ($currmas);
while(list($key,$val)=each($currmas)) {
$cur=explode("|",trim($val));
$rated=round((round((doubleval($cur[2])/doubleval($cur[1])), (4+doubleval(strlen($cur[1])-1)))/$to_cur_rate),(4+doubleval(strlen($cur[1])-1)));
$curname=$cur[0];
$curr_use[$curname]=$rated;
echo "'".$cur[0]."'"."=&gt;".$rated.",\n"."<br>";
}

echo "</td><td valign=top><b>Saving .$ftosave ...</b><br>";
$towrite="<?php\n\$currencies=Array(\n";
$towrite.="'".$to_cur."'"."=>".$curr_use[$to_cur].",\n";
//echo $towrite."<br>";
while(list($key,$val)=each($use_curr)) {

//if ($key!=$curr_use[$to_cur]) {
if ($revert==1) {
$strcur="'".$val."'"."=>".round((1/$curr_use[$val]), 8).",\n";
} else {
$strcur="'".$val."'"."=>".$curr_use[$val].",\n";
}
$towrite.=$strcur;
echo $strcur."<br>";
//}
}
$towrite.=");\n?>";
echo "</td></tr></table><h1>OK!</h1>";
$fp=fopen(".".$ftosave,"w");
fputs($fp,$towrite);
fclose($fp);
}
?>
</body>
</html>