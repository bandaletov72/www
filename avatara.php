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
$autop="?autoPlay=1&";
$qq=0;

//setlocale(LC_ALL,"ru_RU.CP1251");
$viewpage_title="";
// default headers ***********
@Header("HTTP/1.0 200 OK");
@Header("HTTP/1.1 200 OK");
@Header("Content-type: text/html");
@Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
@Header("Last-Modified: ".gmdate("D, M d Y H:i:s",(time()-14400))." GMT");
@Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@Header("Pragma: no-cache"); // HTTP/1.0
$fold="./"; require ("./templates/lang.inc");
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require ("./modules/translit.php");

echo "<!DOCTYPE html><html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>Avatara Eva 1.0</title></head><body>";
function ExtractString($str, $start, $end) {
$str_low = $str;
// $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}

function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚÛİŞß",
"àáâãäååæçèêëìíîïğñòóôõö÷øùüúûışÿ");
   return strtolower($str);
}
if (!isset($ask)){$ask="";} if (!preg_match("/^[à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$ask)) { $ask="hi";}
$ask=str_replace("\\", "", $ask);

$ask_form = "<div align=center><form class=form-inline action=\"avatara.php\" id=\"f\" method=\"POST\">
".$lang[796].": <input type=\"text\" size=64 name=\"ask\" id=\"f\" value=\"\">? <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[797]."\">
</form></div>";

$ask=toLower(str_replace("  ", " ", str_replace("  ", " ", trim(str_replace("!", "", str_replace("?", "", str_replace(",", " ", str_replace(".", " ", str_replace("-", " ", substr($ask, 0, 100))))))))));







function check($askme)
         {
         global $ask;
         global $qq;
         $askme=str_replace(" ", "_", $askme);
         $i=0;
         $len=strlen($askme);
         $ret="";
if (is_dir("./admin/avatara/base/".wordwrap($askme,1,"/",1)) == false) {
$tmpm=explode("_", $askme);
$tmpm2=array_reverse($tmpm);
$askme=implode("_", $tmpm2);

if (is_dir("./admin/avatara/base/".wordwrap($askme,1,"/",1)) == false) {


return $ret;
} else {


if (@file_exists("./admin/avatara/base/".wordwrap($askme,1,"/",1)."/"."1.htm")==TRUE) {
$fp=fopen("./admin/avatara/base/".wordwrap($askme,1,"/",1)."/"."1.htm", "r");
$ret=fread($fp, filesize("./admin/avatara/base/".wordwrap($askme,1,"/",1)."/"."1.htm"));
fclose($fp);
$ask=$askme;
}
}


return $ret;




} else {

if (@file_exists("./admin/avatara/base/".wordwrap($askme,1,"/",1)."/"."1.htm")==TRUE) {
$fp=fopen("./admin/avatara/base/".wordwrap($askme,1,"/",1)."/"."1.htm", "r");
$ret=fread($fp, filesize("./admin/avatara/base/".wordwrap($askme,1,"/",1)."/"."1.htm"));
fclose($fp);
}
return $ret;


}

}

function precheck($ask)
         {
         global $ask_form;
         global $qq;
         $ask=str_replace(" ", "_", $ask);
         $i=0;
         $answer="";
         $answer2="";
         $len=strlen($ask);
         $path= "./admin/avatara/base/".wordwrap($ask,1,"/",1)."/";
         $next_slash = strpos($path, '/');
         $ret="";
if (is_dir("./admin/avatara/base/".wordwrap($ask,1,"/",1)) == false) {
//echo "íå íàøëà $ask<br>";
$tmpm=explode("_", $ask);
$tmpm2=array_reverse($tmpm);
$askme=implode("_", $tmpm2);

if (is_dir("./admin/avatara/base/".wordwrap($ask,1,"/",1)) == false) {
//echo "èùó $askme<br>";
         $len2=strlen($askme);
         $path2= "./admin/avatara/base/".wordwrap($askme,1,"/",1)."/";
         $next_slash2 = strpos($path2, '/');
         $ret="";
         do {
         $i+=1;
         if ($i>200) {break;}
            $sub_path2 = substr($path2, 0, $next_slash2);

            if(is_dir($sub_path2) == true) {
            //echo $sub_path."<br>";
            if (@file_exists($sub_path2."/"."1.htm")==true) {
            //echo $sub_path."/"."1.htm"."<br>";
            $ret2=$sub_path2."/"."1.htm";
            $fp2=fopen($ret2, "r");
            $answer2=fread($fp2, filesize($ret2));
            fclose($fp2);
            $evalstr2=ExtractString($answer2,"[php]", "[/php]");
            if ($evalstr2!="") {
            $answer2=str_replace("[php]".$evalstr2."[/php]", "", $answer2);
            $evalstr2=str_replace("\\\$","\$", str_replace("\\\"","\"", $evalstr2));
            eval ("$evalstr2");
            $answer2=str_replace("\n","<br>",$answer2);
            }
            if (translit(toLower(substr($answer2,0,1)))==toLower(substr($answer2,0,1))) { $tl="&tl=en"; } else {$tl="&tl=ru";}
            $answer2="<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"400\" height=\"27\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"><param name=\"src\" value=\"http://www.google.com/reader/ui/3523697345-audio-player.swf[autop]audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($answer2),0,100)).$tl)."\"/><param name=\"quality\" value=\"best\"/><embed type=\"application/x-shockwave-flash\" wmode=\"transparent\" src=\"http://www.google.com/reader/ui/3523697345-audio-player.swf[autop]audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($answer2),0,100)).$tl)."\" height=\"27\" width=\"320\"></embed></object>
<div align=center><b>Eva:</b>
 $answer2</div>";

            }
           $next_slash2 = strpos($path2, '/', $next_slash2 + 1);

            } else {
            break;
            }

            }
            while($next_slash2 != false);




} else {


if (@file_exists("./admin/avatara/base/".wordwrap($ask,1,"/",1)."/"."1.htm")==TRUE) {
$fp=fopen("./admin/avatara/base/".wordwrap($ask,1,"/",1)."/"."1.htm", "r");
$ret=fread($fp, filesize("./admin/avatara/base/".wordwrap($ask,1,"/",1)."/"."1.htm"));
fclose($fp);
$evalstr2=ExtractString($answer2,"[php]", "[/php]");
            if ($evalstr2!="") {
            $answer2=str_replace("[php]".$evalstr2."[/php]", "", $answer2);
            $evalstr2=str_replace("\\\$","\$", str_replace("\\\"","\"", $evalstr2));
            eval ("$evalstr2");
            $answer2=str_replace("\n","<br>",$answer2);
            }
            $answer2="<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"400\" height=\"27\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"><param name=\"src\" value=\"http://www.google.com/reader/ui/3523697345-audio-player.swf[autop]audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($answer2),0,100)).$tl)."\"/><param name=\"quality\" value=\"best\"/><embed type=\"application/x-shockwave-flash\" wmode=\"transparent\" src=\"http://www.google.com/reader/ui/3523697345-audio-player.swf[autop]audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($answer2),0,100)).$tl)."\" height=\"27\" width=\"320\"></embed></object><div align=center><b>Eva:</b> $answer2</div>";
            return $answer2;
}
}
}


         do {
         $i+=1;
         if ($i>200) { if ($answer==$answer2){$answer2="";} return $answer.$answer2; break;}
            $sub_path = substr($path, 0, $next_slash);

            if(is_dir($sub_path) == true) {
            //echo $sub_path."<br>";
            if (@file_exists($sub_path."/"."1.htm")==true) {
            //echo $sub_path."/"."1.htm"."<br>";
            $ret=$sub_path."/"."1.htm";
            $fp=fopen($ret, "r");
            $answer=fread($fp, filesize($ret));
            fclose($fp);
            $evalstr=ExtractString($answer,"[php]", "[/php]");
            if ($evalstr!="") {
            $answer=str_replace("[php]".$evalstr."[/php]", "", $answer);
            $evalstr=str_replace("\\\$","\$", str_replace("\\\"","\"", $evalstr));
            @eval ("$evalstr");
            $answer=str_replace("\n","<br>",$answer);
            }

          //  if ( extension_loaded('mb_string') ) {
       //$answeri = mb_convert_encoding($answer, "UTF-8","windows-1251");
   //} elseif ( extension_loaded('iconv') ) {
    //   $answeri = iconv("windows-1251", "UTF-8", $answer);
   //}
            if (translit(toLower(substr($answer,0,1)))==toLower(substr($answer,0,1))) { $tl="&tl=en"; } else {$tl="&tl=ru";}
            $answer="<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" width=\"400\" height=\"27\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0\"><param name=\"src\" value=\"http://www.google.com/reader/ui/3523697345-audio-player.swf[autop]audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($answer),0,100)).$tl)."\"/><param name=\"quality\" value=\"best\"/><embed type=\"application/x-shockwave-flash\" wmode=\"transparent\" src=\"http://www.google.com/reader/ui/3523697345-audio-player.swf[autop]audioUrl=".rawurlencode("http://translate.google.com/translate_tts?q=". iconv("windows-1251","utf-8",substr(toLower($answer),0,100)).$tl)."\" height=\"27\" width=\"320\"></embed></object><div align=center><b>Eva:</b> $answer</div>";

            }
           $next_slash = strpos($path, '/', $next_slash + 1);

            } else {
            if ($answer==$answer2){$answer2="";}
            return $answer.str_replace("[autop]","?",$answer2); break;
            }

            }
         while($next_slash != false);
         if ($answer==$answer2){$answer2="";}

         return $answer.str_replace("[autop]","?",$answer2);
}
echo "<table width=100% height=100% border=0><tr><td align=center><img src=\"$image_path/eve.jpg\" border=0><br><br>";
if ($ask!="") {
$check_ask=check($ask);
if ($check_ask=="") {

$pre_check=precheck($ask);
if ($pre_check=="") {echo "$ask_form<br>";} else { if ($qq==0) {$autop1=$autop;} else {$autop1="?";} if (preg_match("/\[autop\]/i", $pre_check)) {$qq=1;} echo str_replace("[autop]", $autop1, $pre_check)."<br>$ask_form<br>";}
//$ask Îòâåòà ïîêà íåò. Ïîïğîáóéòå ñàìè îòâåòèòü.
$filen="./admin/avatara/questions/".str_replace(" ", "_", $ask);
if (@file_exists("$filen")) {
echo $lang[800];
} else {
$fpo=fopen($filen,"w");
fclose($fpo);
echo $lang[801];
}
} else {
$prch=precheck($ask);
//echo $qq;
if ($qq==0) {$autop1=$autop;} else {$autop1="?";} if (preg_match("/\[autop\]/i", $prch)) {$qq=1;}
echo str_replace("[autop]", $autop1, $prch);
echo "<br>".$ask_form;

}


} else {

echo $ask_form;

}

echo "</td></tr></table>";

?>
<script>
if(self.parent.frames.length!=0)self.parent.location=document.location;else{var t=document.forms[0].ask;t.focus()}
</script>
</body>
</html>
