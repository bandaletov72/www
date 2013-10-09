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
echo "<h4>Export USERS to MYSQL</h4>";



# ”дал€ем таблицу если она есть
$query="DROP TABLE IF EXISTS `".$backup_dbpref."_users`";
//echo "$query ...<br>\n";
mysql_query("$query");

$query="CREATE TABLE IF NOT EXISTS `".$backup_dbpref."_users` (";

reset ($user_fields);
$zap="";
while (list($key,$val)=each($user_fields)) {
$query.=$zap."`".mysql_real_escape_string($key)."` $val";
$zap=", ";
}
unset ($key,$val);
$userfile="./db/users.txt";
if (!file_exists($userfile)) die ( "ERROR $userfile not exists...");
$customfile="../templates/$template/$speek/custom_user.inc";
if (!file_exists($customfile)) die ( "ERROR $customfile not exists...");
$custom_fields_arr=file($customfile);
$s=20;
$field=Array();
$types=Array();
$zap =", ";
while (list($key,$val)=each($custom_fields_arr)){
if (trim($val)!="") {
$tmpm=explode("|",$val);
if ((trim($tmpm[0])!="")&&(trim($tmpm[5])!="")) {
$type="TEXT";
$query.=$zap. "`". mysql_real_escape_string(translit($tmpm[0]))."_"."$s"."`"." $type";
$zap=", ";
$indx=translit($tmpm[0])."_".$s;
$user_fields[$indx]=$type;
$s+=1;
}
}
}
unset ($key, $val, $tmpm, $indx, $custom_fields_arr);
$query.=")";
# —оздаем таблицу если ее еще нет
//echo "$query ...<br>\n";
mysql_query("$query");
if (mysql_errno()) die(mysql_error());
$file=Array();
if (@file_exists("./db/tmp_users.txt")) {
$file=file("./db/tmp_users.txt");
}
$file=array_merge($file, file("./db/users.txt"));

reset ($file);
while (list($key,$val)=each($file)){
$tmp=explode("|",$val);
$indx=$tmp[1];
$users[$indx]=$val;
echo "\n";
}
unset ($file, $key, $val);


$handle=opendir("./userstat/");
unset($fillez);
while (($file = readdir($handle))!==FALSE) {
if ((is_dir($file)==TRUE) ||(substr($file,-4)!=".txt")){
continue;
} else {
$indx=substr($file,0,(strlen($file)-4));
$fillez[$indx]="./userstat/$file";
echo "\n";
}
}
closedir ($handle);

if (isset($fillez)) {
while (list ($key, $st) = each ($fillez)) {
$str=file($st);
$users[$key]=$str[0];
echo "\n";
}
}

while (list($key,$val)=each($users)){
if (trim($val)!="") {
$tmpm=explode("|",$val);
if ((trim($tmpm[0])!="")&&(trim($tmpm[1])!="")&&(trim($tmpm[2])!="")&&(trim($tmpm[3])!="")&&(trim($tmpm[7])!="")) {
reset ($user_fields);
$s=0;
$zap="";
$query="INSERT INTO `".$backup_dbpref."_users` SET ";
while (list($key,$val)=each($user_fields)) {
$query.="$zap"."`".mysql_real_escape_string($key)."`". "='". mysql_real_escape_string($tmpm[$s])."'";

$zap=",";
$s+=1;
}
//echo $query."<br>";
mysql_query($query);
if (mysql_errno()) die(mysql_error());
echo "\n";
}
}
}
unset ($key,$val,$tmpm,$file);
echo "<br><b>OK</b><br><br>";


/*# ¬ыбираем из таблицы сортиру€ по полю 'login'
$resource = mysql_query('SELECT * FROM `users` ORDER BY `login`');
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
while ($record = mysql_fetch_assoc($resource))
{
echo $record['login']. " ". $record['password'] . "<br>";
}

# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
*/


echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_create_base.php?speek=$speek&step=1\">";

}







if ($step==1) {
$old_speek=$speek;
reset ($langs);
$s=0;
while (list($lkey,$lspeek)=each($langs)) {
$list_sp[$s]=$lspeek;
$list_speek[$lspeek]=$lkey;
$s+=1;
}
if (!isset($list_sp[$sp])) {
reset ($langs);
while (list($lkey,$lspeek)=each($langs)) {
echo "$lkey - <b>OK</b><br>\n";
}
echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_create_base.php?speek=$old_speek&step=2&sp=$sp\">";


} else {
$speek=$list_sp[$sp];
echo "<h4>Export `".toUpper($list_speek[$speek])."` ITEM DATABASE to MYSQL</h4>";



# ”дал€ем таблицу если она есть
$query="DROP TABLE IF EXISTS `".$backup_dbpref."_items_".$speek."`";
//echo "$query ...<br>\n";
mysql_query("$query");

$query="CREATE TABLE IF NOT EXISTS `".$backup_dbpref."_items_".$speek."` (";


reset ($item_fields);
$zap="";
while (list($key,$val)=each($item_fields)) {
$query.=$zap."`".mysql_real_escape_string($key)."` $val";
$zap=", ";
}
unset ($key,$val);

$userfile=".$base_file";
if (!file_exists($userfile)) die ( "ERROR $userfile not exists...");
$customfile="../templates/$template/$speek/custom_cart.inc";
if (!file_exists($customfile)) {$customfile="";}
if (@file_exists(".$base_loc/catid.txt")) {
$file=file(".$base_loc/catid.txt");

reset ($file);
$maxc=0;
while (list($key,$val)=each($file)){
$tmp=explode("|",$val);
$indx=$tmp[0];
if (@file_exists("../templates/$template/$speek/cc_".$indx.".inc")) {
$count=count(file("../templates/$template/$speek/cc_".$indx.".inc"));
if ($count>$maxc) {
$maxc=$count;
}
}
}
unset ($file, $key, $val, $tmp, $tmpm, $count);

}
if (($customfile!="")||($maxc>0)) {
$custom_fields_arr=file($customfile);
$s=17;
$field=Array();
$types=Array();
$zap =", ";
while (list($key,$val)=each($custom_fields_arr)){
if (trim($val)!="") {
$tmpm=explode("|",$val);
if (trim($tmpm[0])!="") {
$type="TEXT";
$query.=$zap. "`". mysql_real_escape_string(translit($tmpm[0]))."_"."$s"."`"." $type";
$zap=", ";
$indx=translit($tmpm[0])."_".$s;
$item_fields[$indx]=$type;
$s+=1;
}
}
}
while ($maxc>0) {
$type="TEXT";
$query.=$zap. "`"."col_"."$s"."`"." $type";
$zap=", ";
$indx="col_".$s;
$item_fields[$indx]=$type;
$s+=1;
$maxc-=1;
}
unset ($key, $val, $tmpm, $indx, $custom_fields_arr);
}
$query.=")";
# —оздаем таблицу если ее еще нет

mysql_query("$query");
if (mysql_errno()) die(mysql_error());
require "../templates/$template/$speek/vars.txt";
$file=".$base_file";
$f=fopen($file,"r");
$enum=0;
while(!feof($f)) {
$val=fgets($f);
if (trim($val)!="") {
$tmpm=explode("|",$val);
if ((trim($tmpm[1])!="")&&(trim($tmpm[2])!="")&&(trim($tmpm[3])!="")) {
$zap="";
$query="INSERT INTO `".$backup_dbpref."_items_".$speek."` SET ";
$lid=md5(@$tmpm[3]." ID:".@$tmpm[6]);
$stoks="";
$fnamef="../admin/sklad/stock/$lid.txt";
if (@file_exists($fnamef)) {
$filef = @fopen ($fnamef, "r");
if ($filef) { $stoks= fread ($filef, filesize ($fnamef));}
fclose ($filef);

}else {
$stoks= "<img src=$image_path/stockno.gif>".$lang[175];
}

$vcount=0;
$vlevel=0;
if (@file_exists("../admin/comments/votes/$lid.txt")==TRUE) {
$tmpvotef=file("../admin/comments/votes/$lid.txt");
$vcount=doubleval(trim($tmpvotef[1]));
$vlevel=round(doubleval(trim($tmpvotef[0])));
unset($tmpvotef);
}
$comm="";
$fnamef="../admin/comments/$lid.txt";
if (@file_exists($fnamef)) {
$filec = @fopen ($fnamef, "r");
if ($filec) { $comm= fread ($filec, filesize ($fnamef));}
fclose ($filec);

}else {
$comm="0";
}
$vounter=0;
if (@file_exists("../admin/stat/$lid.txt")==TRUE) {
//file exist
$tmpviews = file("../admin/stat/$lid.txt");
$vounters=explode("|", $tmpviews[0]);
$vounter=doubleval(trim($vounters[0]));
unset ($tmpviews,$vounters);
}


$query.="`unifid`='". mysql_real_escape_string($lid)."',`item_id`='". mysql_real_escape_string(translit(@$tmpm[3])."-".translit(@$tmpm[6]))."',`enum`='".$enum."',`date`='". mysql_real_escape_string(time())."',`votes_count`='". mysql_real_escape_string($vcount)."',`votes_level`='". mysql_real_escape_string($vlevel)."',`comment`='". mysql_real_escape_string($comm)."',`counter`='". mysql_real_escape_string($vounter)."',`ext_stock`='". mysql_real_escape_string($stoks)."',`hidart`='".mysql_real_escape_string(strtoupper(substr(md5(@$tmpm[6].$artrnd), -7)))."'";
$enum+=1;
//echo $query."<br><br>";
unset($item_fields['unifid'],$item_fields['item_id'], $item_fields['enum'], $item_fields['date'], $item_fields['votes_count'],$item_fields['votes_level'],$item_fields['comment'],$item_fields['counter'],$item_fields['ext_stock'],$item_fields['hidart']);
reset ($item_fields);
$s=0;
$zap=",";
while (list($key,$val)=each($item_fields)) {
if ($val=="TEXT") {
$query.="$zap"."`".mysql_real_escape_string($key)."`". "='". mysql_real_escape_string(trim($tmpm[$s]))."'";
} else {
$query.="$zap"."`".mysql_real_escape_string($key)."`". "=". doubleval(trim($tmpm[$s]))."";
}
$zap=",";
$s+=1;
}
//echo $query."<br>";
mysql_query($query);
if (mysql_errno()) die(mysql_error());
echo "\n";
}
}
}
fclose ($f);
unset ($key,$val,$tmpm,$file,$zap, $f);
echo "<br><b>OK</b><br><br>";


/*# ¬ыбираем из таблицы сортиру€ по полю 'login'
$resource = mysql_query('SELECT * FROM `users` ORDER BY `login`');
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
while ($record = mysql_fetch_assoc($resource))
{
echo $record['login']. " ". $record['password'] . "<br>";
}

# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
*/


$sp+=1;
$speek=$old_speek;
echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_create_base.php?speek=$speek&step=1&sp=$sp\">";
}
}











if ($step==2) {
echo "<h4>Export ORDERS to MYSQL</h4>";

# ”дал€ем таблицу если она есть
$query="DROP TABLE IF EXISTS `".$backup_dbpref."_orders`";
//echo "$query ...<br>\n";
mysql_query("$query");

$query="CREATE TABLE IF NOT EXISTS `".$backup_dbpref."_orders` (";

reset ($order_fields);
$zap="";
while (list($key,$val)=each($order_fields)) {
$query.=$zap."`".mysql_real_escape_string($key)."` $val";
$zap=", ";
}
unset ($key,$val);

$query.=")";
$userfile="./baskets/list.txt";
if (!file_exists($userfile)) die ( "ERROR $userfile not exists...");
# —оздаем таблицу если ее еще нет
//echo "$query ...<br>\n";
mysql_query("$query");
if (mysql_errno()) die(mysql_error());
$file="./baskets/list.txt";
$f=fopen($file,"r");
while(!feof($f)) {
$val=fgets($f);
if (trim($val)!="") {
$tmpm=explode("|",$val);
if ((trim($tmpm[0])!="")&&(trim($tmpm[1])!="")&&(trim($tmpm[2])!="")&&(trim($tmpm[3])!="")) {
reset ($order_fields);
$s=0;
$zap="";
$query="INSERT INTO `".$backup_dbpref."_orders` SET ";
while (list($key,$val)=each($order_fields)) {
$query.="$zap"."`".mysql_real_escape_string($key)."`". "='". mysql_real_escape_string($tmpm[$s])."'";
echo "\n";
$zap=",";
$s+=1;
}

//echo $query."<br>";

mysql_query($query);
if (mysql_errno()) die(mysql_error());
echo "\n";
}
}
}
fclose ($f);
unset ($key,$val,$tmpm,$file);
//echo "<br><b>OK</b><br><br>";



//Closed orders
if (file_exists("./baskets/list2.txt")) {
$file="./baskets/list2.txt";
$f=fopen($file,"r");

while(!feof($f)) {
$val=fgets($f);
if (trim($val)!="") {
$tmpm=explode("|",$val);
if ((trim($tmpm[0])!="")&&(trim($tmpm[1])!="")&&(trim($tmpm[2])!="")&&(trim($tmpm[3])!="")) {
reset ($order_fields);
$s=0;
$zap="";
$query="INSERT INTO `".$backup_dbpref."_orders_closed` SET ";
while (list($key,$val)=each($order_fields)) {
$query.="$zap"."`".mysql_real_escape_string($key)."`". "='". mysql_real_escape_string($tmpm[$s])."'";
echo "\n";
$zap=",";
$s+=1;
}
//echo $query."<br>";
mysql_query($query);
if (mysql_errno()) die(mysql_error());
echo "\n";
}
}
}
fclose ($f);
unset ($key,$val,$tmpm,$file);
echo "<br><b>OK</b><br><br>";

}



/*# ¬ыбираем из таблицы сортиру€ по полю 'login'
$resource = mysql_query('SELECT * FROM `users` ORDER BY `login`');
if (mysql_errno()) die(mysql_error());

# ѕечатаем по очереди все записи
while ($record = mysql_fetch_assoc($resource))
{
echo $record['login']. " ". $record['password'] . "<br>";
}

# ќсвобождаем пам€ть от результата
mysql_free_result($resource);
*/

echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_create_base.php?speek=$speek&step=3&sp=$sp\">";
}












if ($step==3) {
echo "<h4>Export TAGS to MYSQL</h4>";

# ”дал€ем таблицу если она есть
$query="DROP TABLE IF EXISTS `".$backup_dbpref."_search_tags`";
//echo "$query ...<br>\n";
mysql_query("$query");

$query="CREATE TABLE IF NOT EXISTS `".$backup_dbpref."_search_tags` (`md5_cache` TEXT";


reset ($tags_fields);
$s=0;
$zap=", ";
while (list($key,$val)=each($tags_fields)) {
$query.="$zap"."`".mysql_real_escape_string($key)."`". " $val";
echo "\n";
$zap=", ";
$s+=1;
}
$query.=")";
//echo $query;
mysql_query("$query");
if (mysql_errno()) die(mysql_error());
$handle=opendir("./searchwords/");
unset($fillez);
while (($file = readdir($handle))!==FALSE) {
if (($file==".")||($file=="..")){
continue;
} else {
$indx=substr($file,0,(strlen($file)-4));
$tmpm=@file("./searchwords/$file");
$s=0;
$zap=",";
$query="INSERT INTO `".$backup_dbpref."_search_tags` SET `md5_cache`='".mysql_real_escape_string($indx)."'";
reset ($tags_fields);
while (list($key,$val)=each($tags_fields)) {
$query.="$zap"."`".mysql_real_escape_string($key)."`". "='". mysql_real_escape_string(trim(@$tmpm[$s]))."'";
echo "\n";
$zap=",";
$s+=1;
}
unset ($tmpm,$key,$val);
//echo $query."<br>";

mysql_query($query);
if (mysql_errno()) die(mysql_error());
echo "\n";
}
}
closedir ($handle);
unset ($file,$query);
echo "<br><b>OK</b><br><br>";

echo "<meta http-equiv=\"Refresh\" content=\"2; URL=mysql_create_base.php?speek=$speek&step=4&sp=$sp\">";
}

if ($step==4) {
echo "<h4>List of MySQL Tables</h4>";

$mass=get_database_tables();
while (list($key,$val)=each($mass)) {
$total=0;
$res = mysql_query("SELECT COUNT(*) FROM `$val`");
$row = mysql_fetch_row($res);
$total = $row[0]; // всего записей
echo "`$val` - <b>$total</b> elements<br>";
}
echo "<h4>$lang[758]</h4>";
}


# «акрываем соединение
mysql_close($mysql_link);
?>
</body>
</html>
