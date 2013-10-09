<!DOCTYPE html><html>
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
require ("../modules/translit.php");
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}

function toLower($str) {
$str = strtr($str, "јЅ¬√ƒ≈®∆«» ЋћЌќѕ–—“”‘’÷„Ўў№ЏџЁёя",
"абвгдеежзиклмнопрстуфхцчшщьъыэю€");
   return strtolower($str);
}
function toUpper($str) {
$str = strtr($str, "абвгдеежзиклмнопрстуфхцчшщьъыэю€",
"јЅ¬√ƒ≈®∆«» ЋћЌќѕ–—“”‘’÷„Ўў№ЏџЁёя");
   return strtoupper($str);
}

if(isset($_GET['step'])) $step=$_GET['step']; elseif(isset($_POST['step'])) $step=$_POST['step']; else $step=0;
if (!preg_match("/^[0-9]+$/",$step)) { $step=0;}
if(isset($_GET['sp'])) $sp=$_GET['sp']; elseif(isset($_POST['sp'])) $sp=$_POST['sp']; else $sp=0;
if (!preg_match("/^[0-9]+$/",$sp)) { $sp=0;}

if(isset($_GET['imp'])) $imp=$_GET['imp']; elseif(isset($_POST['imp'])) $imp=$_POST['imp']; else $imp=Array();


require ("../templates/$template/css.inc");
echo "<TITLE>Export to MYSQL</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</head>
<body bgcolor=#ffffff>";
$totsteps=count($langs)+4;
$cursteps=($step+$sp);
if ($cursteps==$totsteps) {$proc="Done";} else {$proc="Processing ...";}
echo "<b>$proc</b><table border=0 width=100% cellspacing=0 cellpadding=3><tr><td bgcolor=$nc6><table border=0 width=".(round(100*$cursteps/$totsteps)+1)."%><tr><td bgcolor=$nc3 width=100%>&nbsp;</td><td><b>".round(100*$cursteps/$totsteps)."%</b></td></table></td></tr></table>";
# —оедин€емс€, выбираем базу данных
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
//print "MySQL Connected successfully...<br>\n";

# ¬ыбираем базу данных
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die(mysql_error());

# —оздаем базу данных если ее еще нет
$query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
//echo "$query ...<br>\n";
mysql_query("$query");
if (mysql_errno()) die(mysql_error());

# ѕодключаемс€ к базе
mysql_select_db($mysql_db_name);
if (mysql_errno()) die(mysql_error());


if ($step==0) {
echo "<h4>List of MySQL Tables</h4>";
echo "Select table to import:<br><br><form class=form-inline action=mysql_import_base.php method=GET><input type=hidden name=step value=1><input type=hidden name=speek value=$speek>";

$mass=get_database_tables();
$s=0;
while (list($key,$val)=each($mass)) {

$total=0;
$res = mysql_query("SELECT COUNT(*) FROM `$val`");
$row = mysql_fetch_row($res);
$total = $row[0]; // всего записей
if (preg_match("/$backup_dbpref/i",$val)) {
echo "<input type=\"checkbox\" checked name=\"imp[".$s."]\" value=\"$val\"> `$val` - <b>$total</b> elements<br>";
$s+=1;
}
}
echo "<div align=center><input type=submit value=\"".$lang[289]."\"></div></form>";
//echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=1\">";
}


if ($step==1) {
echo "<h4>Import USERS from MYSQL</h4>";
$nextl="";
$ok=0;
while (list($key,$val)=each($imp)) {
$nextl.="&imp[".$key."]=".$val;
if ($val==$backup_dbpref."_users") {$ok=1;}
}
if ($ok==0) { echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=2$nextl\">"; mysql_close($mysql_link); exit; }
$query="SELECT * FROM `".$backup_dbpref."_users`";
$resource = mysql_query($query);
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
$counter=0;
while ($record = mysql_fetch_assoc($resource))
{
$fp=fopen("./userstat/".$record['login'].".txt","w");
fputs ($fp, trim(implode("|",$record))."|\n");
echo "\n";
fclose ($fp);
unset($fp);
$counter+=1;
}

# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
echo "Imported: <b>$counter</b> elements</b>";

echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=2$nextl\">";

}







if ($step==2) {
$nextl="";
$ok=0;
reset ($langs);
$s=0;
while (list($lkey,$lspeek)=each($langs)) {
$list_sp[$s]=$lspeek;
$list_speek[$lspeek]=$lkey;
$s+=1;
}
while (list($key,$val)=each($imp)) {
$nextl.="&imp[".$key."]=".$val;
if (preg_match("/".$backup_dbpref."_/i",$val)) {$ok=1;}
}
if ($ok==0) { echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=3&sp=$sp$nextl\">"; mysql_close($mysql_link); exit; }



$old_speek=$speek;

if (!isset($list_sp[$sp])) {
echo "<h4>Please wait...</h4><meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$old_speek&step=3&sp=$sp$nextl\">";
} else {
$speek=$list_sp[$sp];
echo "<h4>Import `".toUpper($list_speek[$speek])."` ITEM DATABASE from MYSQL</h4>";

$query="SELECT * FROM `".$backup_dbpref."_items_".$speek."`";
$resource = mysql_query($query);
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
$counter=0;
require "../templates/$template/$speek/vars.txt";
@unlink(".$base_file.tmp");
$fp=fopen(".$base_file.tmp","a");
while ($record = mysql_fetch_assoc($resource))
{
$lid=$record['unifid'];
$fpu=fopen("../admin/sklad/stock/$lid.txt","w");
fputs($fpu, $record['ext_stock']);
fclose ($fpu);
@unlink ("../admin/comments/votes/$lid.txt");
if ("".$record['votes_count']!="0") {
$fpu=fopen("../admin/comments/votes/$lid.txt","w");
fputs($fpu, $record['votes_level']."\n".$record['votes_count']);
fclose ($fpu);
}
$fpu=fopen("../admin/stat/$lid.txt","w");
fputs($fpu, $record['counter']."|".$record['item_name']."|".$record['price']);
fclose ($fpu);
@unlink("../admin/comments/$lid.txt");
if ("".$record['comment']!="0") {
$fpu=fopen("../admin/comments/$lid.txt","w");
fputs($fpu, $record['comment']);
fclose ($fpu);
}

unset ($record['unifid'], $record['enum'], $record['date'], $record['item_id'], $record['votes_count'],$record['votes_level'],$record['comment'],$record['counter'],$record['ext_stock'],$record['hidart']);
fputs ($fp, trim(implode("|",$record))."|\n");
//echo trim(implode("|",$record))."|<br>\n";
$counter+=1;
}
fclose ($fp);
unset($fp);
@unlink (".$base_file.res");
@rename(".$base_file",".$base_file.res");
rename(".$base_file.tmp",".$base_file");
# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
echo "Imported: <b>$counter</b> elements</b>";

//$file=".$base_file";



$sp+=1;
$speek=$old_speek;
echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=2&sp=$sp$nextl\">";
}
}











if ($step==3) {
echo "<h4>Import ORDERS from MYSQL</h4>";
$nextl="";
$ok=0;
$ok1=0;
$ok2=0;
while (list($key,$val)=each($imp)) {
$nextl.="&imp[".$key."]=".$val;
if ($val==$backup_dbpref."_orders") {$ok1=1; $ok=1;}
if ($val==$backup_dbpref."_orders_closed") {$ok2=1; $ok=1;}
}
if ($ok==0) { echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=4&sp=$sp$nextl\">"; mysql_close($mysql_link); exit; }

if ($ok1==1) {
$query="SELECT * FROM `".$backup_dbpref."_orders`";
$resource = mysql_query($query);
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
$counter=0;
@unlink("./baskets/list.txt.tmp");
$fp=fopen("./baskets/list.txt.tmp","a");
while ($record = mysql_fetch_assoc($resource))
{
fputs ($fp, trim(implode("|",$record))."|\n");
$counter+=1;
}
fclose ($fp);
unset($fp);
@unlink ("./baskets/list.txt.res");
rename("./baskets/list.txt","./baskets/list.txt.res");
rename("./baskets/list.txt.tmp","./baskets/list.txt");
# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
echo "Imported: <b>$counter</b> elements</b>";
}
if ($ok2==1) {
$query="SELECT * FROM `".$backup_dbpref."_orders_closed`";
$resource = mysql_query($query);
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
$counter=0;
@unlink("./baskets/list2.txt.tmp");
$fp=fopen("./baskets/list2.txt.tmp","a");
while ($record = mysql_fetch_assoc($resource))
{
fputs ($fp, trim(implode("|",$record))."|\n");
$counter+=1;
}
fclose ($fp);
unset($fp);
@unlink ("./baskets/list2.txt.res");
rename("./baskets/list2.txt","./baskets/list2.txt.res");
rename("./baskets/list2.txt.tmp","./baskets/list2.txt");
# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
echo "Imported: <b>$counter</b> elements (from closed weeks)</b>";
}

echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=4&sp=$sp$nextl\">";
}












if ($step==4) {
echo "<h4>Import TAGS from MYSQL</h4>";
$nextl="";
$ok=0;
while (list($key,$val)=each($imp)) {
$nextl.="&imp[".$key."]=".$val;
if ($val==$backup_dbpref."_search_tags") {$ok=1;}
}
if ($ok==0) { echo "<b>OK</b>"; mysql_close($mysql_link); exit; }
$query="SELECT * FROM `".$backup_dbpref."_search_tags`";
$resource = mysql_query($query);
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
$counter=0;
while ($record = mysql_fetch_assoc($resource))
{
$fp=fopen("./searchwords/".$record['md5_cache'].".txt","w");
fputs ($fp, $record['count']."\n".$record['keyword']."\n".$record['link']);
echo "\n";
fclose ($fp);
unset($fp);
$counter+=1;
}

# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
echo "Imported: <b>$counter</b> elements</b><br>";
echo "<h4>$lang[758]</h4>";
//echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_import_base.php?speek=$speek&step=4&sp=$sp\">";
}



# «акрываем соединение
mysql_close($mysql_link);
?>
</body>
</html>
