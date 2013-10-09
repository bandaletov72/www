<?php
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
//exit; //do not allow standalone mode
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");
$valid=0;
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
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚÛİŞß",
"àáâãäååæçèêëìíîïğñòóôõö÷øùüúûışÿ");
   return strtolower($str);
}
function toUpper($str) {
$str = strtr($str, "àáâãäååæçèêëìíîïğñòóôõö÷øùüúûışÿ",
"ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚÛİŞß");
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


require "../modules/functions.php";
require "../templates/$template/css.inc";

if ($level=="") {$level="";}
$fold=".";
if (is_dir("$fold/base$level")) {
$handle=opendir("$fold/base$level");
$max=0;
$cldirs="";
$choose_txt=$lang[957];
$fdirs=0;
while (($clfile = @readdir($handle))!==FALSE) {

if (($clfile == '.') || ($clfile == '..') || (is_dir("$fold/base$level/$clfile")!=true)|| (substr($clfile,0,1) == '#') ) {
if ($clfile=="description.$speek") { $textes = file("$fold/base$level/$clfile"); $choose_txt=trim($textes[0]); $descr_txt=trim($textes[1]); $button_txt=trim($textes[2]);}
continue;
} else {
$cldirs.="<div onclick=choosen('".rawurlencode("$level/".$clfile)."') class=round2 style='cursor: pointer; cursor: hand;' onmouseover=this.style.backgroundColor='#eeeeee'; onmouseout=this.style.backgroundColor='';>$clfile</div>";
$fdirs+=1;
}
}
$tmplev=explode("/",$level);
$tmpcount=(count($tmplev)-1);
unset ($tmplev[$tmpcount]);
$levelup=implode("/",$tmplev);
$uplevel="";
if ($tmpcount>0) {$uplevel="<div onclick=choosen('".rawurlencode("$levelup")."') class=round2 style='cursor: pointer; cursor: hand;' onmouseover=this.style.backgroundColor='#eeeeee'; onmouseout=this.style.backgroundColor='';><font color=#aa2222>..<img src=$image_path/ofb.png border=0 title='".$lang['back_to_higher_level']."'></font></div>";}

if ($fdirs>0) {

$js_spisok ="
var jsclist=document.getElementById('jscl');
";
$js_spisok .="jsclist.innerHTML=\"<h1><font color=#aa2222>$level</font></h1><font size=2>$choose_txt</font><br><br>$uplevel$cldirs\";";
} else {
$js_spisok ="
var jsclist=document.getElementById('jscl');
";
if (file_exists("$fold/base$level/form.txt")) {
//âäğóã åñòü ôîğìà äîáàâëåíèÿ
$form=file("$fold/base$level/form.txt");
} else {
$form="<b>$lang[956]:</b><br><br><form class=form-inline action=index.php method=POST name=\"form\" id=\"cl_form\"><input type=hidden name=action value=cl_add><input type=hidden name=cl_send value=1><input type=hidden name=cl_level value='$level'><table border=0 width=100%>".
"<tr><td align=right><b><nobr>$lang[949]:</nobr></b></td><td width=80%><input type=text name=cl_title value='' size=20 style='width:100%'></td></tr>".
"<tr><td valign=top align=right><b><nobr>$lang[950]:</nobr></b></td><td><textarea name=cl_description cols=20 rows=10 style='width:100%'></textarea></td></tr>".
"<tr><td align=right><b><nobr>$lang[951],$valut:</nobr></b></td><td><input type=text name=cl_price value='' size=20>&nbsp;&nbsp;<input type=submit value='".$lang['sendform']."'></td></tr>".
"</table>";
}
if (file_exists("$fold/base$level/write.txt")) {
$js_spisok .="jsclist.innerHTML=\"<h1><font color=#aa2222>$level</font></h1><br><br>$uplevel<br><br>$form\";";
} else {
$js_spisok .="jsclist.innerHTML=\"<h1><font color=#aa2222>$level</font></h1><br><br>$uplevel<br><b><font color=#aa2222>$lang[953]</font></b><br>$lang[943]\";";
}
}
} else {
$js_spisok ="
var jsclist=document.getElementById('jscl');
";
$js_spisok .="jsclist.innerHTML=\"<h1>$lang[42]</h1>$lang[952]\";";

}
echo "$js_spisok";
?>

