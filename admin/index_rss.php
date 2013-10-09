<!DOCTYPE html><html>
<head>
<?php

$rss_output="";
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

$rss_output="";
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
* Usage: array parse_rss ( string data ) *
**********************************************************/
function parse_rss($reg_exp, $xml_data) {
   preg_match_all($reg_exp, $xml_data, $temp);
   return array(
       'count'=>count($temp[0]),
       'title'=>$temp[1],
       'link'=>$temp[2],
       'desc'=>$temp[3],
       'pubdate'=>$temp[4]   //добавлено
   );
}

/**********************************************************
* Parse Array data into an HTML structure *
* Usage: string parse_rss ( array data ) *
**********************************************************/

function output_rss($pattern, $rss_data) {
   $temp = "";
   for($i=0; $i<$rss_data['count']; $i++) {
   if ( $rss_data['pubdate'][$i]=="") {$rss_data['pubdate'][$i]=date("d.m.Y R", time());}
       $temp .= sprintf($pattern,
           strrev($rss_data['link'][$i]),
           strftime("%d/%m/%Y %R", strtotime($rss_data['pubdate'][$i])),
           html_entity_decode($rss_data['title'][$i]),
           strip_tags(html_entity_decode($rss_data['desc'][$i]))
              //добавлено
       );
   }
   return $temp;
}

/**********************************************************
* Settings *
**********************************************************/


$pattern = "<div style=\"clear:both;\"><br><noindex><a href=\"go.php?%s\"><i>%s</i></a><br></noindex><strong>%s</strong><br>%s</div>";

/**********************************************************
* Main script *
**********************************************************/
reset ($rssurl);
while (list($key, $value)=each($rssurl)){
$tmp=explode("|",$value);
$cont= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$tmp[3]\"><title>RSS READ $tmp[3]</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>";
$cont.= $css;
$cont.= "</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
<small> ";
$reg_exp=$tmp[2];
if ( $xml_data = file_get_contents($tmp[1]) ) {
   // вот так можно -->
   if ($tmp[4]!="") {
   if ( extension_loaded('mb_string') ) { $cont.= "<br><b>mb_string</b> $tmp[3] -&gt; $tmp[4]: $tmp[1]";
       $xml_data = mb_convert_encoding($xml_data, $tmp[4], $tmp[3]);
   } elseif ( extension_loaded('iconv') ) { $cont.= "<br><b>ikonv</b> $tmp[3] -&gt; $tmp[4]: $tmp[1]";
       $xml_data = iconv($tmp[3], $tmp[4], $xml_data);
   }
   }

echo "$cont<br><textarea rows=10 style=\"width:100%\">
$xml_data;
</textarea>";
   // <--
   $rss_data = parse_rss($reg_exp, $xml_data);
   $rss_cur="";
   $rss_cur=output_rss($pattern, $rss_data);
   if ($rss_cur!="") { $rss_output.="<h4>".$tmp[0]."</h4>".str_replace("<![CDATA[", "", str_replace("]]>", "", $rss_cur)."<br><br>"); echo " - OK<br>";
   }else { echo " - RSS PARSER ".$lang[42]."<br>";}
}
}
/**********************************************************
* The END *
**********************************************************/
if ($rss_output!="") {
$rss_output=str_replace("Читать дальше &rarr; ","", str_replace("[Источник]","",str_replace("[Из песочницы]","",str_replace("[Перевод]","",$rss_output))));
if(!is_dir("./db/rss")) { mkdir("./db/rss",0755);}
$ttime=date("Y_d_m",time());
if (@file_exists( "./db/rss/last.date")==false) {
echo $ttime."<br>";
$files=fopen("./db/rss/last.date", "w");
if (!$files) {echo "-1 Write error ./db/rss/last.date"; exit;}
fputs ($files, "$ttime");
fclose ($files);
}
@unlink("./db/rss/".$ttime.".txt");

@copy ("./db/rss.txt", "./db/rss/".$ttime.".txt");


$files=@fopen("./db/rss/last.date", "r");
if (!$files) {echo "1 Read error ./db/rss/last.date"; exit;}
$last=trim(@fread($files, 1024));
@fclose ($files);

$files=fopen("./db/rss.txt", "w");
if (!$files) {echo "0 Write error ./db/rss.txt"; exit;}
flock ($files, LOCK_EX); fputs ($files, "$rss_output<br><div align=center><a href=\"index.php?action=rsspage&rssdate=$last\">[previous]</a>&nbsp;&nbsp;&nbsp;[next]</div></center>");flock ($files, LOCK_UN);
fclose ($files);




if ($last!=$ttime) {

$files=@fopen("./db/rss/".$last.".txt", "r");
if (!$files) {echo "2 Read error ./db/rss/".$last.".txt"; exit;}
$timeoutput=str_replace("[next]", "<a href=\"index.php?action=rsspage&rssdate=$ttime\">[next]</a>", @fread($files, @filesize("./db/rss/".$last.".txt")));
@fclose ($files);

$files=fopen("./db/rss/last.date", "w");
if (!$files) {echo "3 Write error ./db/rss/last.date"; exit;}
flock($files, LOCK_EX); fputs($files, "$ttime"); flock($files, LOCK_UN);
fclose ($files);

$files=@fopen("./db/rss/".$last.".txt", "w");
if (!$files) {echo "4 Read error ./db/rss/".$last.".txt"; exit;}
fputs($files, $timeoutput);
@fclose ($files);

}

echo "<br><h1>RSS: ".$lang['index_ok']."</h1><hr>".$rss_output;
} else {
echo "<br><h1>RSS FEED ".$lang[42]."</h1>";
}
echo "</small>";
?>
</body>
</html>
