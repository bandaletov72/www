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
$fold="../.."; require ("../../templates/lang.inc");
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

require ("../../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../../templates/$template/$speek/config.inc");
echo "<!DOCTYPE html><html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>Avatara Eva 1.0</title></head><body>";
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
if (!isset($ask)){$ask="";} if (!preg_match("/^[à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$ask)) { $ask="";}
if (!isset($add)){$add="";} if (!preg_match("/^[0-9]+$/",$add)) { $add="";}

$ask_form = "<div align=center><form class=form-inline action=\"ask.php\" id=\"f\" method=\"POST\">
".$lang[796].": <input type=\"text\" size=64 name=\"ask\" id=\"f\" value=\"\">? <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[797]."\">
</form></div>";

$tagform="<div align=center>
<script language=\"javascript\">
<!--
function mlink() {
document.otvet.answer.value+='<a href='+document.tags.linkd.value+'>'+document.tags.sec2.value+'</a>';
}
function mbold() {
document.otvet.answer.value+='<b>'+document.tags.boldd.value+'</b>';
}
function mp() {
document.otvet.answer.value+='[php]'+document.tags.phpd.value+'[/php]';
}
function mper() {
document.otvet.answer.value+='<META HTTP-EQUIV=\"Refresh\" CONTENT=\"'+document.tags.sec.value+';URL='+document.tags.refreshd.value+'\">';
}
function mi() {
document.otvet.answer.value+='<img src='+document.tags.imaged.value+'>';
}
function mu() {
document.otvet.answer.value+='<u>'+document.tags.underlined.value+'</u>';
}
-->
</script>
<b>HTML TAGS:</b>
<form name=\"tags\" id=\"tags\">
<table border=0>
<tr><td>
URL:</td><td><input size=29 type=text name=\"linkd\" value=\"http://\" id=\"linkd\">&nbsp;<input type=text name=\"sec2\" size=29 value=\"CLICK HERE\" id=\"sec2\"></td><td><input type=\"button\" value=\"".$lang[784]."\" onclick=\"mlink()\"></td></tr>
<tr><td>
BOLD:</td><td><input size=64 type=text name=\"boldd\" value=\"\" id=\"boldd\"></td><td><input type=\"button\" value=\"".$lang[784]."\" onclick=\"mbold()\"></td></tr>
<tr><td>
UNDERLINE:</td><td><input size=64 type=text name=\"underlined\" value=\"\" id=\"underlined\"></td><td><input type=\"button\" value=\"".$lang[784]."\" onclick=\"mu()\"></td></tr>
<tr><td>
IMAGE:</td><td><input size=64 type=text name=\"imaged\" value=\"http://\" id=\"imaged\"></td><td><input type=\"button\" value=\"".$lang[784]."\" onclick=\"mi()\"></td></tr>
<tr><td>
".$lang[798].":</td><td><input size=45 type=text name=\"refreshd\" value=\"http://\" id=\"refreshd\"> time: <input type=text name=\"sec\" size=2 value=\"3\" id=\"sec\"> sec</td><td><input type=\"button\" value=\"".$lang[784]."\" onclick=\"mper()\"></td></tr>
<tr><td>
PHP(Warning!):</td><td><input size=64 type=text name=\"phpd\" value=\"\$answer.=date(^F, l, d-m-Y H:i:s^, time());\" id=\"phpd\"></td><td><input type=\"button\" value=\"".$lang[784]."\" onclick=\"mp()\"></td></tr>
</table>
</form><div>";

$ask=toLower(str_replace("  ", " ", str_replace("  ", " ", trim(str_replace("!", "", str_replace("?", "", str_replace(",", " ", str_replace(".", " ", str_replace("-", " ", substr($ask, 0, 100))))))))));
$answer=substr(@$answer, 0, 10000);


function make($ask, $answer)

         { global $lang; 
$filen="./questions/".str_replace(" ", "_", $ask);
if (@file_exists("$filen")) {
unlink($filen);
}
         $ask=str_replace(" ", "_", $ask);
         $i=0;
         $len=strlen($ask);
         $path= "./base/".wordwrap($ask,1,"/",1)."/";
         $next_slash = strpos($path, '/');

         do {
            $sub_path = substr($path, 0, $next_slash);

            if(is_dir($sub_path) == false)
               mkdir($sub_path);

            $next_slash = strpos($path, '/', $next_slash + 1);
            }
         while($next_slash != false);
$fp=fopen("$path"."1.htm", "w");
fputs($fp, str_replace("\\\"","\"", str_replace("\n", "<br>", str_replace(chr(10), "<br>", $answer))));
fclose($fp);
}


function check($askme)
         {
         global $ask;
         global $lang;
         $askme=str_replace(" ", "_", $askme);
         $i=0;
         $len=strlen($askme);
         $ret="";
if (is_dir("./base/".wordwrap($askme,1,"/",1)) == false) {
$tmpm=explode("_", $askme);
$tmpm2=array_reverse($tmpm);
$askme=implode("_", $tmpm2);

if (is_dir("./base/".wordwrap($askme,1,"/",1)) == false) {


return $ret;
} else {


if (@file_exists("./base/".wordwrap($askme,1,"/",1)."/"."1.htm")==TRUE) {
$fp=fopen("./base/".wordwrap($askme,1,"/",1)."/"."1.htm", "r");
$ret=fread($fp, filesize("./base/".wordwrap($askme,1,"/",1)."/"."1.htm"));
fclose($fp);
$ask=$askme;
}
}


return $ret;




} else {

if (@file_exists("./base/".wordwrap($askme,1,"/",1)."/"."1.htm")==TRUE) {
$fp=fopen("./base/".wordwrap($askme,1,"/",1)."/"."1.htm", "r");
$ret=fread($fp, filesize("./base/".wordwrap($askme,1,"/",1)."/"."1.htm"));
fclose($fp);
}
return $ret;


}

}

function precheck($ask)
         {
         global $ask_form;
         global $lang;
         $ask=str_replace(" ", "_", $ask);
         $i=0;
         $answer="";
         $answer2="";
         $len=strlen($ask);
         $path= "./base/".wordwrap($ask,1,"/",1)."/";
         $next_slash = strpos($path, '/');
         $ret="";
if (is_dir("./base/".wordwrap($ask,1,"/",1)) == false) {
//echo "íå íàøëà $ask<br>";
$tmpm=explode("_", $ask);
$tmpm2=array_reverse($tmpm);
$askme=implode("_", $tmpm2);

if (is_dir("./base/".wordwrap($ask,1,"/",1)) == false) {
//echo "èùó $askme<br>";
         $len2=strlen($askme);
         $path2= "./base/".wordwrap($askme,1,"/",1)."/";
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
            $answer2="<div align=center><b>Eva:</b> $answer2</div>";
            }
           $next_slash2 = strpos($path2, '/', $next_slash2 + 1);

            } else {
            break;
            }

            }
            while($next_slash2 != false);




} else {


if (@file_exists("./base/".wordwrap($ask,1,"/",1)."/"."1.htm")==TRUE) {
$fp=fopen("./base/".wordwrap($ask,1,"/",1)."/"."1.htm", "r");
$ret=fread($fp, filesize("./base/".wordwrap($ask,1,"/",1)."/"."1.htm"));
fclose($fp);
$evalstr2=ExtractString($answer2,"[php]", "[/php]");
            if ($evalstr2!="") {
            $answer2=str_replace("[php]".$evalstr2."[/php]", "", $answer2);
            $evalstr2=str_replace("\\\$","\$", str_replace("\\\"","\"", $evalstr2));
            eval ("$evalstr2");
            $answer2=str_replace("\n","<br>",$answer2);
            }
            $answer2="<div align=center><b>Eva:</b> $answer2</div>";
            return $answer2;
}
}
}


         do {
         $i+=1;
         if ($i>200) {if ($answer==$answer2){$answer2="";}return $answer.str_replace("<b>Eva:</b>", "<b>".$lang[802].":</b>", $answer2); break;}
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
            eval ("$evalstr");
            $answer=str_replace("\n","<br>",$answer);
            }
            $answer="<div align=center><b>Eva:</b> $answer</div>";
            }
           $next_slash = strpos($path, '/', $next_slash + 1);

            } else {
            if ($answer==$answer2){$answer2="";}return $answer.str_replace("<b>Eva:</b>", "<b>".$lang[802].":</b>", $answer2); break;
            }

            }
         while($next_slash != false);
         if ($answer==$answer2){$answer2="";}return $answer.str_replace("<b>Eva:</b>", "<b>".$lang[802].":</b>", $answer2);
}

echo "<table width=100% height=100% border=0><tr><td align=center><img src=\"$image_path/smile.png\" border=0><br><br>";
if ($add==2) {
if ($answer!="") {
make($ask, str_replace("^","\"", $answer));
} else {
echo $lang[803];
}
}


if ($ask!="") {
$check_ask=check($ask);
if ($check_ask=="") {
if ($add==1) {
if ($answer!="") {
echo $ask."<br>".$answer."<br>";
make($ask, $answer);
} else {
echo $lang[803];
}
$otvet=precheck($ask);
echo str_replace("<META ", "<REMEDMETA ", $otvet );
echo $ask_form;
} else {
$pre_check=str_replace("<META ", " [redirect] <REMEDMETA ", precheck($ask));
if ($pre_check=="") {echo "$ask_form<br>";} else {echo $pre_check."<br>$ask_form<br>";}
echo "<div align=center><form class=form-inline action=\"ask.php\" method=\"POST\" id=\"otvet\" name=\"otvet\">
".$lang[796].": <input type=\"hidden\" name=\"add\" value=\"1\"><input type=\"hidden\" name=\"ask\" value=\"$ask\"> $ask ? ".$lang[804]."<br>
".$lang[805].": <textarea cols=80% rows=10 name=\"answer\"></textarea><br><br><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[806]."\">
</form>
$tagform</div>";


}
} else {
$otvet=precheck($ask);
echo str_replace("<META ", " [redirect] <REMEDMETA ", $otvet );
echo "<br>".$ask_form;
echo "<div align=center><form class=form-inline action=\"ask.php\" method=\"POST\" id=\"otvet\" name=\"otvet\">
".$lang[796].": <input type=\"hidden\" name=\"add\" value=\"2\"><input type=\"hidden\" name=\"ask\" value=\"$ask\"> $ask ? ".$lang[807]."<br>
".$lang[805].": <textarea cols=80% rows=10 name=\"answer\">".str_replace("<div align=center><b>Eva:</b> ", "", str_replace ("<div>", "", str_replace("</div>", "", $otvet)))."</textarea><br><br><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang['ch']."\">
</form>
$tagform</div>";
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
