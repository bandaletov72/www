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

require ("../../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../../templates/$template/$speek/config.inc");echo "Loading import ";
// настройки
$separator="|";
$file="./db_index.txt";
$sync_import=3;
$sync_export=3;
$replace=Array (
4   =>  4,
5   =>  5,
16  =>  16
);

//начнем
$f=fopen($file,"r");
$s=0;
while(!feof($f)) {
$st=fgets($f);

// теперь мы обрабатываем очередную строку $st

if ($st!=="") {

$out=explode("$separator",$st);
if (isset($out[$sync_import])) {
$sync=$out[$sync_import];
$import[$sync]=$st;
$s+=1;
echo ". ";
}
}
}

fclose($f);
//получили громадный такой массив. √лавное чтоб сервак не грохнулс€ от нагрузки.

echo "<br><b>¬ импортируемом файле найдено $s товаров</b><br><br>";

echo "Loading export ";
// теперь базу нашу начнем парсить и сравнивать
$s=0;
$ff=0;
$file="../.$base_file";
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);

// теперь мы обрабатываем очередную строку $st

if ($st!=="") {
echo ". ";
$ff+=1;
$out=explode("|",$st);
if (isset($out[$sync_export])) {
$sync=$out[$sync_export]; //это наприрмер наименование

if (isset($import[$sync])) {
$out2=explode("$separator",$import[$sync]);
//теперь сравниваем и мен€ем в случай чего
reset ($replace);
while (list ($key, $line) = each ($replace)) {

if ($out[$line]!=$out2[$key]) {
$s+=1;
$out[$line]=$out2[$key];
}
}
unset($import[$sync]);
}
}
$export[$sync]=implode("|",$out);
}
}

fclose($f);

echo "<br><br><b>¬ базе магазина всего $ff товаров, сделано $s замен</b><br><br>";

echo "ƒобавление нового товара<br><br>";
//теперь возвратим неиспользованные элементы
$s=0;
reset($import);
$toadd=implode("",@$export);
while (list ($key, $line) = each ($import)) {
$s+=1;
$toadd.=$line;
}

$f=fopen($file, "w");
flock ($f, LOCK_EX);
fputs($f,$toadd);
flock ($f, LOCK_UN);
fclose($f);

echo "<b>¬ базу магазина добавлено $s новых товаров</b><br>Ќе забудьте сделать индексацию<br>";
?>
