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
$custom_cart="";
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
require ("../templates/$template/css.inc");
require ("../modules/translit.php");
echo "
<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>EDIT</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
<SCRIPT language=\"JavaScript1.1\">
<!--

function rc() {
  window.opener.location.reload();
  self.close();

}
//-->
</SCRIPT>
$css
</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
";

$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());

if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());
if (!isset($_POST['id'])) { $id=0; } else {$id=$_POST['id'];}
$fields=mysql_list_fields("$mysql_db_name", $dbpref."_items_".$speek, $mysqldb);
$columns=mysql_num_fields($fields);
$jj=0;
$ee=Array();
for ($i=0; $i<$columns; $i++) {
if ($i>26){
$ee[$jj]=mysql_field_name($fields, $i);
$jj+=1;
}
}

mysql_select_db("$mysql_db_name");


$set1="";
$zap="";
$rs=11;
$arr=array ("dir", "subdir", "nazv", "price", "opt", "ext_id", "description", "kwords", "foto1", "foto2" , "vitrin" , "onsale", "brand_name", "ext_lnk","full_descr", "kolvo");
$item_fields2=array_keys($item_fields);
while (list ($line_num, $a) = each ($arr)) {
$$a = str_replace(chr(10) , "<br>", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a=str_replace("  ", " ", str_replace("|", " ", trim (trim (trim ($$a)))));
if(get_magic_quotes_gpc()) {
$$a = stripslashes($$a);
}
$set1.=$zap."`".$item_fields2[$rs]."`='".mysql_real_escape_string($$a)."'";
$zap=",";
$rs+=1;
}

if (isset ($cc)) {
while (list ($line_numcc, $acc) = each ($cc)) {
$cc[$line_numcc]=str_replace(chr(10) , "<br>", $cc[$line_numcc]);
$cc[$line_numcc] = str_replace(chr(13) , "", $cc[$line_numcc]);
$cc[$line_numcc] = str_replace(chr(27) , "", $cc[$line_numcc]);
$cc[$line_numcc] = trim($cc[$line_numcc]);
$cc[$line_numcc] = stripslashes($cc[$line_numcc]);
$set1.=$zap."`".$ee[$line_numcc]."`='".mysql_real_escape_string($cc[$line_numcc])."'";
$zap=",";
}
reset ($cc);
}


echo "<small><b>UNIFID:</b> $unifid<br>
<b>ITEM_ID:</b> $item_id<br>
<br>$nazv<br><br><hr><br>
";
$st=0;


$mysql_query="UPDATE $file SET $set1".", `item_id`='".mysql_real_escape_string(translit("$nazv")."-".translit("$ext_id"))."', `unifid`='".mysql_real_escape_string(md5("$nazv ID:$ext_id"))."', `hidart`='".mysql_real_escape_string(strtoupper(substr(md5(@$ext_id.$artrnd), -7)))."' WHERE `item_id`='".mysql_real_escape_string(@$item_id)."' AND `unifid`='".mysql_real_escape_string(@$unifid)."' LIMIT 1";
echo $mysql_query;

$result=mysql_query("$mysql_query");

mysql_close($mysqldb);
echo "<center>OK<br>";

echo "<p><input type=\"button\" value=\"".$lang[428]."\" name=\"no\" onclick=\"javascript:rc()\"></p>";
?><!--end-->
</body>
</html>
