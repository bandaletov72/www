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
session_cache_limiter ('nocache');
session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt));
session_start();

$sid=session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

echo "<!DOCTYPE html><html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=q.php?speek=$speek\">
<title>Avatara Eva 1.0</title></head><body>";
$questionl= $lang[796];

function toLower($str) {
$str = strtr($str, "АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЪЫЭЮЯ",
"абвгдеежзиклмнопрстуфхцчшщьъыэюя");
   return strtolower($str);
}
if (!isset($ask)){$ask="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$ask)) { $ask="";}
if (!isset($q)){$q="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$q)) { $q="";}
if (!isset($answer)){$answer="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-\n]+$/i",$answer)) { $answer="";}
if (!isset($add)){$add="";} if (!preg_match("/^[0-9]+$/",$add)) { $add="";}

$ask_form = "";
/*
$ask_form = "<div align=center><form class=form-inline action=\"q.php\" id=\"f\" method=\"POST\">
Ответ: <input type=\"text\" size=80% name=\"q\" id==\"f\" value=\"\"> <input type=\"submit\" class=\"btn btn-primary\" value=\"Ответить\">
</form></div>";
*/

$ask=toLower(str_replace("  ", " ", str_replace("  ", " ", trim(str_replace("!", "", str_replace("?", "", str_replace(",", " ", str_replace(".", " ", str_replace("-", " ", substr($ask, 0, 100))))))))));
$answer=trim(substr($answer, 0, 3000));

function que($path)
         {
         global $q;
         $que="";
$handle=@opendir("$path");
$i=0;
while (($val=@readdir($handle))!==false) {
if (($val==".")||($val=="..")) { continue; } else {
if (is_dir($path.$val."/")==true) {
$tmp[$i]=$path.$val."/";
$i+=1;
}
}
}
closedir($handle);
if (isset($tmp)) {
srand ((double)microtime()*1000000);
shuffle($tmp);
reset($tmp);
$st=$tmp[0];

$j=0;
$handle=@opendir($st.$val."/");
while (($vals=@readdir($handle))!==false) {
if (($vals==".")||($val=="..")) { continue; } else {
if (is_dir($st.$vals."/")==true) {
$j+=1;
}
}
}
closedir($handle);

if ($j>0) {
$q=str_replace("/", "", str_replace("./base/", "", str_replace("_", " ", $st.$val)));
}
unset ($val);
unset ($vals);
unset ($tmp);
que($st);

}

}




que("./base/");
$ask=$q;

if (!@$_SESSION["ask"]): $_SESSION["ask"]=""; endif;
$_SESSION["ask"]="$ask";




function make($ask, $answer)
         {

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
fputs($fp, $answer);
fclose($fp);
}




function check($ask)
         {
         $ask=str_replace(" ", "_", $ask);
         $i=0;
         $len=strlen($ask);
         $ret="";
if (is_dir("./base/".wordwrap($ask,1,"/",1)) == false) {
return "";
} else {

if (@file_exists("./base/".wordwrap($ask,1,"/",1)."/"."1.htm")==TRUE) {
$fp=fopen("./base/".wordwrap($ask,1,"/",1)."/"."1.htm", "r");
$ret=fread($fp, filesize("./base/".wordwrap($ask,1,"/",1)."/"."1.htm"));
fclose($fp);
}
return $ret;


}

}

function precheck($ask)
         {
         global $ask_form;
         $ask=str_replace(" ", "_", $ask);
         $i=0;
         $answer="";
         $len=strlen($ask);
         $path= "./base/".wordwrap($ask,1,"/",1)."/";
         $next_slash = strpos($path, '/');
         $ret="";


         do {
         $i+=1;
         if ($i>200) {return $answer; break;}
            $sub_path = substr($path, 0, $next_slash);

            if(is_dir($sub_path) == true) {
            //echo $sub_path."<br>";
            if (@file_exists($sub_path."/"."1.htm")==true) {
            //echo $sub_path."/"."1.htm"."<br>";
            $ret=$sub_path."/"."1.htm";
            $fp=fopen($ret, "r");
            $answer=fread($fp, filesize($ret));
            fclose($fp);
            $answer="<div align=center><b>Paul:</b> ".str_replace("/", "", str_replace("./base/", "", str_replace("_", " ", $sub_path)))."</div><br><div align=center><b>Eva:</b> $answer</div>";
            }
           $next_slash = strpos($path, '/', $next_slash + 1);

            } else {
            return $answer; break;
            }

            }
         while($next_slash != false);
         return $answer;
}
echo "<table width=100% height=100% border=0><tr><td align=center><img src=\"$image_path/eve.jpg\" border=0><br><br>";
if ($ask!="") {
$check_ask=check($ask);
if ($check_ask=="") {
if ($add==1) {
if ($answer!="") {
echo $ask."<br>".$answer."<br>";
make($ask, $answer);
} else {
echo "Вы не дали ответа!";
}
echo precheck($ask);
echo $ask_form;
} else {
$pre_check=precheck($ask);
if ($pre_check=="") {echo "$ask_form<br>";} else {echo $pre_check."<br>$ask_form<br>";}
/*echo "<div align=center><form class=form-inline action=\"ask.php\" method=\"POST\">
На вопрос: <input type=\"hidden\" name=\"add\" value=\"1\"><input type=\"hidden\" name=\"ask\" value=\"$ask\"> $ask ? Ответа пока нет. Попробуйте сами ответить.<br>
Ответ: <textarea cols=80% height=10 name=\"answer\"></textarea><br><br><input type=\"submit\" class=\"btn btn-primary\" value=\"OK\">
</form></div>";
*/

}
} else {
echo precheck($ask);
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
