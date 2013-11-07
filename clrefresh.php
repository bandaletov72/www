<?php

function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
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

$cl_cont=Array("","","","","","","","","","");
$t=Array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
$flood="";
$mmax=3000;
$login="";
$good="";
$html="on"; //on off html in messages
$valid=0;
unset($details);
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");
function getRealIP()
{
   if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_SERVER['HTTP_X_FORWARDED_FOR']="";}
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');

            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }

   return $client_ip;

}
$rulez="";
$rulezbutton="";
if (file_exists("./classifieds/base/rules.txt")) {

$fprulf=fopen("./classifieds/base/rules.txt","r");
$rulez=str_replace("\n","<br>", fread($fprulf,filesize("./classifieds/base/rules.txt")));
fclose ($fprulf);
unset($fprulf);
$rulezbutton="<div style=\"float: right; margin: 10px 10px 10px 10px;\"><a class=cat1 id=\"rules\" title=\"$lang[1537]\" href=\"#open_rules\"><img src=\"images/help.gif\" border=0> <b>$lang[1537]</b></a></div>
<div class=hidden>
<div style=\"width:630px; height: 380px; overflow: auto\" id=\"open_rules\">
<table border=0 width=100%>
<tr><td align=left>$rulez</td></tr>
</table></div>
</div>
<script language=javascript>
<!--
$(document).ready(function() {
$(\"#rules\").fancybox({
'onComplete' : function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'     : 'no',
        'width'     : 640,
        'height'     : 400,
      'padding' : 10
});
});
-->
</script>
";
}
if(isset($_GET['level'])) $level=$_GET['level']; elseif(isset($_POST['level'])) $level=$_POST['level']; else $level="";
if(isset($_GET['clfile'])) $clfile=$_GET['clfile']; elseif(isset($_POST['clfile'])) $clfile=$_POST['clfile']; else $clfile="";
if(isset($_POST['action']))  { $action=$_POST['action']; } else { $action="";  }
if (!preg_match("/^[a-z0-9_]+$/i",$action)) { $action="";}
$level=str_replace(";", "", strip_tags($level));
$clfile=str_replace(";", "", strip_tags($clfile));
$fold="."; require ("./templates/lang.inc");
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

require ("./templates/$template/$speek/vars.txt");
@setlocale(LC_CTYPE, $site_nls);
require ("./templates/$template/$speek/config.inc");
header("Content-type: text/html; charset=$codepage");

if ($action!="cl_add") {
//view classifieds
if ($clfile!="") {

if (!ini_get("register_globals")) {
if (version_compare(phpversion(), "4.1.0", "<") === true) {
if (isset($HTTP_SESSION_VARS)) $_SESSION &= $HTTP_SESSION_VARS;
}
if(!empty($_SESSION)) extract($_SESSION, EXTR_SKIP);
}

require ("./templates/$template/css.inc");

require ("./modules/translit.php");
function toLower($str) {
$str = strtr($str, "јЅ¬√ƒ≈®∆«» ЋћЌќѕ–—“”‘’÷„Ўў№ЏџЁёя",
"абвгдеЄжзиклмнопрстуфхцчшщьъыэю€");
   return strtolower($str);
}
function ExtractString($str, $start, $end) {
$str_low = $str;

 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}

function escaper($matches){
        $tmp = preg_replace("/\"/", "%22", $matches[1]);
        return "[a href='"."http://$tmp"."']"."$matches[2]"."[/a]";
 }
function make_url_href($url){
        return preg_replace_callback("|\\[url=http://([^\\]]+?)\\](.+?)\\[/url\\]|s", "escaper", $url);
        // комментарий к регекспу:
        //      группа 1 : ([^\]]+?) - последовательность любых символов кроме ']'
        //      группа 2 : (.+?) - последовательность  любых символов,
        //              квантификатор '+?' - мое обычное решение по уменьшению "жадности" регекспов :)
        // опци€ поиска '|s' - включать и переводы строки в шаблон (.+?)
        // prg_replace_callback - потому что надо бы пофиксить кавычки в первой группе:), поэтому вызываетс€
        //  дл€ каждого совпадени€ ф-€ escaper
 }

$cls__delc="";
$handle=opendir('./smileys/');
while (($f6 = readdir($handle))!==FALSE) {
$mtyp=toLower(substr($f6,-3));
if (($mtyp == 'png')||($mtyp == 'gif')) {
if ($mtyp == 'gif') {$smexp=":";} else {$smexp="#";}
//echo strtoken("$f6",".")."<br>";
$dir_smiles[$f6]="$smexp".strtoken("$f6",".")."$smexp";
}
}
closedir($handle);
unset($f6);
natcasesort ($dir_smiles);
function to_html($face,$im) {
global $html;
global $details;
global $valid;
global $lang;
global $dir_smiles;
global $forum_imgwidth;
global $image_path;
global $nc5;
global $nc3;
global $htpath;
$face=trim($face);
$temp="\n".str_replace("script","s c r i p t",str_replace("src","s r c",str_replace("void","v o i d",$face)));
$temp=str_replace("<br>","<br>\n", $temp);
        $temp=preg_replace( "`(( http)+(s)?:(//)|( www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", " [a href='http\\3://\\5\\6\\8\\9']\\5\\6[/a]",$temp);
        $temp=preg_replace( "`((\nhttp)+(s)?:(//)|(\nwww\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "\n[a href='http\\3://\\5\\6\\8\\9']\\5\\6[/a]",$temp);
        //$temp=preg_replace( "`((>http)+(s)?:(//)|(>www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", ">[a href='http\\3://\\5\\6\\8\\9']\\5\\6[/a]",$temp);
        $temp = str_replace("[URL","[url", $temp);
        $temp = str_replace("[/URL]","[/url]", $temp);
        $temp=make_url_href($temp);
        $temp=str_replace("<br>']", "']", $temp);
         $temp=str_replace("/a]\n", "/a]<br>\n", $temp);
        $temp = str_replace("[Q]","[q]", $temp);
        $temp = str_replace("[/Q]","[/q]", $temp);
        $temp = str_replace("[IMG]","[img]", $temp);
        $temp = str_replace("[/IMG]","[/img]", $temp);
        $temp = str_replace("<code>","[code]", $temp);
        $temp = str_replace("</code>","[/code]", $temp);
        $temp = str_replace("[br]","<br>", $temp);
        if ($html=="off") {
        return (strip_tags($face));

        }

 $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[u]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/u]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[u]", "[/u]");
        $repto="<u>".$repst."</u>";
        $temp = str_replace("["."u"."]"."$repst"."["."/u"."]","$repto", $temp);
         $codecounts-=1;
         }}
         $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[i]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/i]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[i]", "[/i]");
        $repto="<i>".$repst."</i>";
        $temp = str_replace("["."i"."]"."$repst"."["."/i"."]","$repto", $temp);
         $codecounts-=1;
         }}

         $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[b]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/b]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[b]", "[/b]");
        $repto="<b>".$repst."</b>";
        $temp = str_replace("["."b"."]"."$repst"."["."/b"."]","$repto", $temp);
         $codecounts-=1;
         }}
         $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[sup]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/sup]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[sup]", "[/sup]");
        $repto="<sup>".$repst."</sup>";
        $temp = str_replace("["."sup"."]"."$repst"."["."/sup"."]","$repto", $temp);
         $codecounts-=1;
         }}

        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[quote=", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/quote]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {

        while ($codecounts>1) {
        $url_link=ExtractString($temp, "[quote=", "]");

        $url_text=ExtractString($temp,"[quote=".$url_link."]","[/quote]");
        $url_link2=$url_link;
        $temp = str_replace("[quote=".$url_link."]".$url_text."[/quote]","<div class=round2 style=\"margin:3px\"><b>".$url_link2.":</b> <font color=\"#000099\">".$url_text."</font></div>", $temp);
        $codecounts-=1;
        }}

        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[q]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/q]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[q]", "[/q]");
        $repto="<div class=round2 style=\"margin:3px\"><font color=\"#000099\">".$repst."</font></div>";
        $temp = str_replace("["."q"."]"."$repst"."["."/q"."]","$repto", $temp);
         $codecounts-=1;
         }}
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[img]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/img]", $temp));

        if (($codecounts>1)&&($codecounts==$codecounts2)) {

        while ($codecounts>1) {
        $repst=ExtractString($temp, "[img]", "[/img]");
        $img = @getimagesize($repst);

        if (doubleval($img[0])==0) {

        if ($im==1) {
        $repto="<img src=".$repst." border=0 width=36 height=36 class=img>";

        } else {
        $repto="<a rel=forum_group href=$repst><img src=".$repst." border=0 width=250 height=250 class=img></a>";
        }
        } else {
        $iheight=round($forum_imgwidth*$img[1]/$img[0]);
        if (doubleval($img[0])<=$forum_imgwidth) {
        if ($im==1) {
        $repto="<img src=".$repst." title=\"$img[0]x$img[1]\" width=36 height=36 class=img>";
        } else {
        $repto="<img src=".$repst." title=\"$img[0]x$img[1]\" width=250 height=250 class=img hspace=10 vspace=10>";
        }

        } else {
        if ($im==1) {
        $repto="<img src=".$repst." width=36 height=36 border=0 title=\"".$lang[139]." $img[0]x$img[1]\" align=left class=img style=\"margin: 2px 10px 2px 2px;\">";
        } else {
        $k=1;

        if (doubleval($img[0])>250) {
        $k=round(doubleval($img[0])/250,6);
        }
        $repto="<a rel=forum_group href=$repst><img src=".$repst." width=".ceil($img[0]/$k)." height=".ceil($img[1]/$k)." border=0 title=\"".$lang[139]." $img[0]x$img[1]\" align=left class=img style=\"margin: 2px 10px 2px 2px;\"></a>";

        }
        }
        }
        //$repto="<img src=".$repst." class=thumb border=0>";

        $temp = str_replace("["."img"."]"."$repst"."["."/img"."]","$repto", $temp);
         $codecounts-=1;
         }}
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[a href='", $temp));

        $codecounts2=count(explode("[/a]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {

        while ($codecounts>1) {

        $url_link=ExtractString($temp, "[a href='", "']");

        //$url_text=ExtractString($temp,"[a href='".$url_link."']","[/a]");
        $url_text = strtoken(str_replace("[a href='".$url_link."']","", str_replace(strtoken ($temp, "[a href='".$url_link."']"),"",$temp)),"[/a]");
        $url_link2=$url_link;
        if (preg_match("/\(/i",$url_link)){ $url_link2=str_replace("(","{",str_replace(")","}",$url_link));} else {

        if (substr($url_link,0,7)!="mailto:") {
        if (substr($url_link,0,6)!="ftp://") {
        if (substr($url_link,0,7)!="http://") {
        $url_link2="http://".$url_link;
        }}}
        }


        $searchh=strtoken(str_replace("http://","",str_replace("www.","",str_replace("ftp://","",$htpath))),"/");
        if (!preg_match("/$searchh/i",$url_link2)) {
        $temp = str_replace("[a href='".$url_link."']".$url_text."[/a]","<a href='go.php?".strrev($url_link2)."' target=_blank><font color=$nc3>".$url_text."</font></a>", $temp);
        } else {
        $temp = str_replace("[a href='".$url_link."']".$url_text."[/a]","<a href='".$url_link2."'><font color=$nc3>".$url_text."</font></a>", $temp);

        }
        $codecounts-=1;
        }}
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[code]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/code]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[code]", "[/code]");
        $repto="<div class=round2 style=\"margin:10px\"><font color=\"#000099\">".$repst."</font></div>";
        if ((substr($repst,0,5)=="&lt;?")&&(substr($repst,-5)=="?&gt;")) {$repto="<div class=round2 style=\"margin:3px\">".highlight_string(str_replace("<br>","\n",str_replace("&lt;","<",str_replace("&gt;",">",$repst))),true)."</div>";}
         $temp = str_replace("["."code"."]"."$repst"."["."/code"."]","$repto", $temp);
         $codecounts-=1;
         }}
        reset ($dir_smiles);
        while (list($skey,$sval)=each($dir_smiles)) {
        $temp = str_replace("$sval","<img src=smileys/".$skey." border=0>", $temp);
        }
        $temp = str_replace(" :)","<img src=smileys/smile.png border=0>", $temp);
        $temp = str_replace(" ;)","<img src=smileys/wink.png border=0>", $temp);
        $temp = str_replace(" :d","<img src=smileys/laugh.png border=0>", $temp);
        $temp = str_replace(" :s","<img src=smileys/doubt.png border=0>", $temp);
        $temp = str_replace(" (h)","<img src=smileys/hot.png border=0>", $temp);
        $temp = str_replace(" :'(","<img src=smileys/tears.png border=0>", $temp);
        $temp = str_replace(" :@","<img src=smileys/angry.png border=0>", $temp);
        $temp = str_replace(" (a)","<img src=smileys/angel.png border=0>", $temp);
        $temp = str_replace(" :$","<img src=smileys/bloss.png border=0>", $temp);
        $temp = str_replace(" :p","<img src=smileys/tongue.png border=0>", $temp);
        $temp = str_replace(" (b )","<img src=smileys/beer.png border=0>", $temp);
         echo $temp;
        return $temp;
}
$clcontf="./classifieds/base$level/$clfile/last10.txt";
$clcont="";

if (file_exists($clcontf)) {
$tmp=array_reverse(file($clcontf));
$zz=0;
while (list ($t1,$t2)=each($tmp)) {
$t=explode("|",$t2);
$zz++;
echo "<div class=cat2 onclick=\"document.location.href='$htpath/index.php?action=cl&level=".rawurlencode("$level/$clfile")."&cl_post=".$t[4]."'\" style='cursor: pointer; cursor: hand;' onmouseover=this.style.backgroundColor='$nc6'; onmouseout=this.style.backgroundColor='';><font color=$nc10>".wordwrap(substr(strip_tags($t[13]),0,100), 27, "\n", true)."</font> <a href=\"$htpath/index.php?action=cl&level=".rawurlencode("$level/$clfile")."&cl_post=".$t[4]."\"><b>".wordwrap(substr(strip_tags($t[5]),0,100), 27, " \n", true)."</b></a> - ".wordwrap(substr(strip_tags($t[6]),0,60), 27, "\n", true)."<br>
<small>".to_html(wordwrap(substr(str_replace("[br]", " ", strip_tags($t[12])),0,200), 100, "\n", true),1)."
 - <font color=$nc3><noindex>".wordwrap(substr(strip_tags($t[14]),0,60), 27, "\n", true)."</noindex></font> - <font class=small><i>".date("d.m.Y H:i", $t[0])."</i></font></small><div class=clear></div></div>";
}
unset ($t, $t1, $t2);
}

}

} else {
//send to classifieds
$rip=getRealIP();

require("./modules/webcart.php");
$oldanguage=$language;
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }
$cart =& $_SESSION['cart'];

if(!is_object($cart)){
$cart = new webcart();
}
if (!ini_get("register_globals")) {
if (version_compare(phpversion(), "4.1.0", "<") === true) {
if (isset($HTTP_SESSION_VARS)) $_SESSION &= $HTTP_SESSION_VARS;
}
if(!empty($_SESSION)) extract($_SESSION, EXTR_SKIP);
}

require ("./templates/$template/css.inc");

require ("./modules/translit.php");

function to_img($temp) {
global $html;
if ($html=="off") { return false; }
global $details;
global $valid;
global $use_curl;
global $new_w;
global $new_h;
global $maximg_size;
global $new_w2;
global $new_h2;
global $htpath;
global $cl_post;
$temp=trim($temp);
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[img]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/img]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[img]", "[/img]");
        $returned[0]="";
        $returned[1]="";

$ftype="jpg";
$headers=get_headers($repst);
while (list($key,$val)=each($headers)){
if (substr($val,0,14)=="Content-Type: ") {
$sys=str_replace("Content-Type: ", "", trim($val));
if ($sys=="image/png") {$ftype="png";}
if ($sys=="image/gif") {$ftype="gif";}
if ($sys=="image/jpg") {$ftype="jpg";}
if ($sys=="image/jpeg") {$ftype="jpg";}
}
}
if ($use_curl==1) {
$req = $repst;
$ch = curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$img = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$img=file_get_contents($repst);
}
$md=md5("$repst");
//$sys=strtolower(substr($repst,-3));
//if (($sys!="gif")&&($sys!="jpg")&&($sys!="png")) {$sys="jpg";}
if (($img!="")&&(strlen($img)<$maximg_size)) {
$dir1=date("Y",time());
$dir2=substr($md,0,3);
//$cl_list.= "OK. Lets writing classifieds #$cl_file ...<br><br>";
if(is_dir("./thumb")!=true) { mkdir("./thumb",0755); }
if(is_dir("./thumb/"."$dir1")!=true) { mkdir("./thumb/"."$dir1",0755); }
if(is_dir("./thumb/"."$dir1/$dir2")!=true) { mkdir("./thumb/"."$dir1/$dir2",0755); }
$ifp=fopen("./thumb/"."$dir1/$dir2/".$md."."."$ftype","w");
fputs($ifp, $img);
fclose($ifp);

$name="./thumb/"."$dir1/$dir2/".$md."."."$ftype";
$filename="./thumb/"."$dir1/$dir2/tn_".$md."."."$ftype";
if ($ftype=="jpg"){$src_img=imagecreatefromjpeg($name);}
    if ($ftype=="gif"){$src_img=imagecreatefromgif($name);}
	if ($ftype=="png"){$src_img=imagecreatefrompng($name);}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y)
	{
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
	if ($ftype=="png")
	{
		imagepng($dst_img,$filename);
	}
    if ($ftype=="gif")
	{
		imagegif($dst_img,$filename);
        }
    if ($ftype=="jpg")
	{
		imagejpeg($dst_img,$filename);
	}
	imagedestroy($dst_img);
	imagedestroy($src_img);


$name="./thumb/"."$dir1/$dir2/".$md."."."$ftype";
$filename="./thumb/"."$dir1/$dir2/dl_".$md."."."$ftype";
if ($ftype=="jpg"){$src_img=imagecreatefromjpeg($name);}
    if ($ftype=="gif"){$src_img=imagecreatefromgif($name);}
	if ($ftype=="png"){$src_img=imagecreatefrompng($name);}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y)
	{
		$thumb_w=$new_w2;
		$thumb_h=$old_y*($new_h2/$old_x);
	}
	if ($old_x < $old_y)
	{
		$thumb_w=$old_x*($new_w2/$old_y);
		$thumb_h=$new_h2;
	}
	if ($old_x == $old_y)
	{
		$thumb_w=$new_w2;
		$thumb_h=$new_h2;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
	if ($ftype=="png")
	{
		imagepng($dst_img,$filename);
	}
    if ($ftype=="gif")
	{
		imagegif($dst_img,$filename);
        }
    if ($ftype=="jpg")
	{
		imagejpeg($dst_img,$filename);
	}
	imagedestroy($dst_img);
	imagedestroy($src_img);
unlink ($name);
$returned[0]="$htpath/thumb/"."$dir1/$dir2/dl_".$md."."."$ftype";
$returned[1]="$htpath/thumb/"."$dir1/$dir2/tn_".$md."."."$ftype";
} else {
//$returned[0]="$htpath/thumb/"."$dir1/$dir2/".$md."."."$ftype";
$returned[0]="";
$returned[1]="";
}
return $returned;
$codecounts-=1;

}
}
}


$valid=@$_SESSION["user_valid"];
$valid=substr($valid,0,300); if (!isset($valid)){$valid="";} if (!preg_match("/^[0-9]+$/",$valid)) { $valid="";}
if ($valid==""): $valid="0"; endif;

if ((!@$_COOKIE["user_name"]) || (@$_COOKIE["user_name"]=="")): $_COOKIE["user_name"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["user_name"])) { @$_COOKIE["user_name"]="";}
if ((!@$_COOKIE["user_pass"]) || (@$_COOKIE["user_pass"]=="")): $_COOKIE["user_pass"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["user_pass"])) { @$_COOKIE["user_pass"]="";}

if (($_COOKIE["user_name"]!=="")&&($_COOKIE["user_pass"]!=="")&&($valid=="0")) {

$login=$_COOKIE["user_name"];
$password="";
if (@file_exists("./admin/userstat/".$login.".txt")) {
$file="./admin/userstat/".$login.".txt";
} else {
$file="./admin/db/users.txt";
}
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);

// next stroke $st
$out=explode("|",$st);

@$login2=@$out[1];
@$password2=@$out[2];

if (($login=="$login2")&&(md5(substr($artrnd.$password2.$secret_salt, 0, 128))==$_COOKIE["user_pass"])) {
$password=$password2;
break;
}
}
fclose($f);

}

if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;

if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}
if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;

$details = $cart->get_details();
//var_dump($details);
//var_dump($_POST);


$name=substr(@$_POST['name'], 0, 300);
$cl_price=substr(@$_POST['cl_price'], 0, 100);
$cl_city=substr(@$_POST['cl_city'], 0, 100);
$cl_email=substr(@$_POST['cl_email'], 0, 100);
$cl_title=str_replace("  ", " ", str_replace(",", ", ", substr(@$_POST['cl_title'], 0, 100)));
$cl_description = str_replace("  ", " ", str_replace(",", ", ", @$_POST['cl_description']));
if(get_magic_quotes_gpc()) {
$cl_title = stripslashes(@$cl_title);
$cl_city = stripslashes(@$cl_city);
$cl_email = stripslashes(@$cl_email);
$cl_description = stripslashes($cl_description);
$cl_price = stripslashes(@$cl_price);
$name = stripslashes(@$name);
}

require ("./modules/bad_words.php");


$proceed=0;

if ("$valid"=="1") {$proceed=1;} else { $proceed=0; }
if ($cat_only_for_registered==0) { $proceed=1; }
if ((session_id()!="")&&($proceed==1)) {

$arr2=array ("cl_description","cl_price","clfile","rip","level","cl_post","cl_city","cl_email", "cl_title", "name");
while (list ($line_num, $a) = each ($arr2)) {
if (substr($codepage,0,3)=="win") { if (detect_utf(@$$a)==TRUE) { $$a=utf8_win(@$$a); } }

$$a = strip_tags(@$$a);
$$a = str_replace("|" , "", @$$a);
$$a = str_replace("<" , "&lt;", @$$a);
$$a = str_replace(">" , "&gt;", @$$a);

$$a = substr(@$$a, 0, $mmax);
//$$a = wordwrap($$a, 200, " " , 1);
$$a = str_replace(chr(92) , "", @$$a); // strip backslash
$$a = str_replace("^" , "", @$$a);
$$a = str_replace("\n" , " [br]", @$$a);
$$a = str_replace("\r" , " [br]", @$$a);
$$a = str_replace(" [br] [br]" , " [br]", @$$a);
//$$a = str_replace(chr(13) , "", $$a);
//$$a = str_replace(chr(27) , "", $$a);
$$a = trim(@$$a);
if(get_magic_quotes_gpc()) { $$a = stripslashes(@$$a);}
$$a= badwords(@$$a);
}
if (@$_SESSION["last_comm"]==md5($cl_title)) {
echo "<div align=center><br><font color=#b94a48 size=3><b>".$lang[1500]."</b></font></div>";
exit;
}
$tmp5=explode(".",$rip);
if(is_dir("./admin/bannedip")!=true) { mkdir("./admin/bannedip",0755); }
if(is_dir("./admin/bannedip/temp")!=true) { mkdir("./admin/bannedip/temp",0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()),0755); }
$ipfile="./admin/bannedip/".implode("/",$tmp5)."/banned.txt";
if (file_exists($ipfile)) {
$tmp6=file($ipfile);
$bantime=date("d.m.Y H:i:s", trim($tmp6[0]));
if (time()>=trim($tmp6[0])) {
@unlink($ipfile);
} else {
$banreason=@$lang[trim($tmp6[1])];
echo "<div align=center class=ocat1><br><font color=#b94a48>$lang[1530]</font><br><br><b>$lang[1501]:</b> $bantime <b>$lang[1514]:</b> $banreason<br></div><br><table border=0 width=580><tr><td><div style=\"height:350px;overflow:auto;\">$rulez</div></td></tr></table><br>";

exit;
}
}


//write post

if (($cl_title!="")&&($cl_description!="")&&($cl_city!="")&&($cl_email!="")&&($cl_price!="")&&($clfile!="")) {

$cl_dir="./classifieds/base$clfile";
if ((is_dir("$cl_dir"))&&(file_exists("$cl_dir/write.txt")==true)) {
$tmpfileip="./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time())."/". doubleval(@preg_replace("([\D]+)", "", $rip)).".txt";
if ($flood=="") {
if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")||(@$details[7]=="VIP")||(substr(@$details[7],0,3)=="OPT")||(substr(@$details[7],0,3)=="CAT")||(substr(@$details[7],0,2)=="HR")) { }  else {
if (!file_exists($tmpfileip)) {
$tfp=fopen($tmpfileip,"w");
fputs($tfp, 1);
fclose($tfp);
unset($tfp);
} else {
$tfp=fopen($tmpfileip,"r");
$tmpipq=doubleval(trim(fread($tfp,1024)));
fclose($tfp);
unset($tfp);
if ($tmpipq>=doubleval($lang[1536])) {
echo "<div align=center><br><font color=#b94a48>$lang[1534]</font><br><br><b>$lang[1535]:</b> $lang[1536]<br></div><br><table border=0 width=580><tr><td><div style=\"height:350px;overflow:auto;\">$rulez</div></td></tr></table><br>";

exit;
} else {
$tfp=fopen($tmpfileip,"w");
fputs($tfp,($tmpipq+1));
fclose($tfp);
unset($tfp);
}
}
}
}
$_SESSION["last_comm"]=md5($cl_title);
$cl_time=time();
$cl_file=$cl_time.substr(str_replace("0.","",str_replace("0,","", strtoken(microtime()," "))),0,3);
$dir1=date("Y",$cl_time);
$dir2=date("m",$cl_time);
$dir3=date("d",$cl_time);
//$cl_list.= "OK. Lets writing classifieds #$cl_file ...<br><br>";
if(is_dir("$cl_dir/#"."$dir1")!=true) { mkdir("$cl_dir/#"."$dir1",0755); }
if(is_dir("$cl_dir/#"."$dir1/$dir2")!=true) { mkdir("$cl_dir/#"."$dir1/$dir2",0755); }
if(is_dir("$cl_dir/#"."$dir1/$dir2/$dir3")!=true) { mkdir("$cl_dir/#"."$dir1/$dir2/$dir3",0755); }
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir2/$dir3/".$cl_file, "w");
fputs ($cl_fp, "$cl_title|$details[1]|$details[3]|$details[4]|$cl_city|$cl_email|".$rip."|\n$cl_price\n$cl_description");
fclose ($cl_fp);
$pic="";

$cl_img=Array();
if ($html=="off") {
$cl_img[0]="";
$cl_img[1]="";
} else {
$cl_img=to_img($cl_description);
if ($cl_img[0]!="") {$pic="1";}
}
$striped=strip_tags($cl_description);
if (strlen($striped)>200) {$striped.="...";}
$striped=substr($striped,0,200);
$striped=str_replace("\r", " ",str_replace("\n", " ",$striped));
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir2/$dir3/date.lst", "a");
fputs ($cl_fp, "$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|$cl_city|$cl_email|".$rip."|".$striped."||\n");
fclose ($cl_fp);
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir2/$dir3.lst", "a");
fputs ($cl_fp, "$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|$cl_city|$cl_email|".$rip."|".$striped."||\n");
fclose ($cl_fp);
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir1"."_"."$dir2"."_"."$dir3.lst", "a");
fputs ($cl_fp, "$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|$cl_city|$cl_email|".$rip."|".$striped."||\n");
fclose ($cl_fp);
$cltm="";
if (file_exists("$cl_dir/last10.txt")) {
$cl_fpt=file("$cl_dir/last10.txt");
$z=0;
reset ($cl_fpt);
while(list($tmp1key,$tmp2val)=each($cl_fpt)) {
if ($z<=($cl_perpage-1)) {
if ($z>0) {
$cltm.="$tmp2val";
} else {
if (count($cl_fpt)<$cl_perpage) {
$cltm.="$tmp2val";
}
}
}
$z++;
}
}
$cl_fp=fopen("$cl_dir/last10.txt", "w");
fputs ($cl_fp, $cltm."$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|".$striped."|$cl_city|$cl_email|".$rip."|\n");
fclose ($cl_fp);
unset($cltm,$cl_fpt,$tmp1key,$tmp2val);
@$_SESSION["last_comm"]=md5($cl_title);
echo "<div><font color=#468847>$lang[1531]</font></div>"; exit;
} else {
echo "<div><font color=#b94a48>$lang[42]. $lang[943]</font><br></div><br><table border=0 width=580><tr><td><div style=\"height:350px;overflow:auto;\">$rulez</div></td></tr></table><br>"; exit;
}

} else {
echo "<div><font color=#b94a48>$lang[42]. $lang[944]</font><br></div><br><table border=0 width=580><tr><td><div style=\"height:350px;overflow:auto;\">$rulez</div></td></tr></table><br>"; exit;
}




} else {
if (@$_SESSION["last_comm"]==md5($cl_title)) {
echo "<div align=center><br><font color=#b94a48 size=3><b>".$lang[1019]."</b></font><br><br><a class=btn href=\"$htpath/index.php?register=1\">".$lang[1081]."</a><br></div><br><table border=0 width=580><tr><td><div style=\"height:350px;overflow:auto;\">$rulez</div></td></tr></table><br>";
exit;
}

}
}

?>
