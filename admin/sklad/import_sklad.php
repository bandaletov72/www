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
// ���������
$separator="|";
$file="./db_index.txt";
$sync_import=3;
$sync_export=3;
$replace=Array (
4   =>  4,
5   =>  5,
16  =>  16
);

//������
$f=fopen($file,"r");
$s=0;
while(!feof($f)) {
$st=fgets($f);

// ������ �� ������������ ��������� ������ $st

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
//�������� ��������� ����� ������. ������� ���� ������ �� ��������� �� ��������.

echo "<br><b>� ������������� ����� ������� $s �������</b><br><br>";

echo "Loading export ";
// ������ ���� ���� ������ ������� � ����������
$s=0;
$ff=0;
$file="../.$base_file";
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);

// ������ �� ������������ ��������� ������ $st

if ($st!=="") {
echo ". ";
$ff+=1;
$out=explode("|",$st);
if (isset($out[$sync_export])) {
$sync=$out[$sync_export]; //��� ��������� ������������

if (isset($import[$sync])) {
$out2=explode("$separator",$import[$sync]);
//������ ���������� � ������ � ������ ����
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

echo "<br><br><b>� ���� �������� ����� $ff �������, ������� $s �����</b><br><br>";

echo "���������� ������ ������<br><br>";
//������ ��������� ���������������� ��������
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

echo "<b>� ���� �������� ��������� $s ����� �������</b><br>�� �������� ������� ����������<br>";
?>
