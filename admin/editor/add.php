<!DOCTYPE html><html>

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
include "header.inc";
include "middle.inc";

if ((!@$name) || (@$name=="")): echo"�� �� ������� ���� ���. ��������� ����� � ������� ���� ���."; include "footer.inc"; exit; endif;
if ((!@$message) || (@$message=="")): echo"�� �� ����� ���������. ��������� ����� � �������� ���� ���������."; include "footer.inc"; exit; endif;
if (strlen($message)>=10000): echo"�� ����� ������� ������� ��������� (max - 10000 ��������). ��������� ����� � ��������� ���� ���������."; include "footer.inc"; exit; endif;
if (strlen($name)>=100): echo"�� ����� ������� ������� ��� (max - 100 ��������). ��������� ����� � ��������� ���� ���."; include "footer.inc"; exit; endif;
//������ ������������ �������� (��� ��������� �� ����� �����)

$name1 = explode("|" , $name);
$name = join("/" , $name1);
$message1 = explode("|" , $message);
$message = join("/" , $message1);

//������ HTML, �������, ������� ������� � ������

$name = str_replace("<" , "&lt" , $name);
$message = str_replace("<" , "&lt" , $message);
$name = str_replace(">" , "&gt", $name);
$message = str_replace(">" , "&gt", $message);
$name = str_replace("script" , "������", $name);
$message = str_replace("script" , "������", $message);
$name = str_replace(chr(13) , "", $name);
$message = str_replace(chr(13) , "", $message);
$name = str_replace(chr(27) , "", $name);
$message = str_replace(chr(27) , "", $message);
$name = trim($name);
$message = trim($message);
$name= stripslashes($name);
$message = stripslashes($message);

//������� ������ �� ��������� Email

$name = str_replace("@" , " '������' ", $name);
$message = str_replace("@" , " '������' ", $message);

//��������� �� ����

$name = str_replace("���" , "�**", $name);
$message = str_replace("���" , "�**", $message);
$name = str_replace("����" , "�***", $name);
$message = str_replace("����" , "�***", $message);
$name = str_replace(" ���" , " �**", $name);
$message = str_replace(" ���" , " �**", $message);
$name = str_replace(chr(10) , "<br>", $name);
$message = str_replace(chr(10) , "<br>", $message);

$fp = fopen ("gbnumber.txt", "r");
if (!$fp) {
echo "<p> �� ���� ������� ���� <b>gbnumber.txt</b>.\n";
include "footer.inc";
exit;
}
while (!feof ($fp)) {
$line = fgets ($fp, 1024);
if (preg_match("/nomer=(.*);/", $line, $out)) {
$nomer = $out[1];
break;
}
}
fclose ($fp);
/* ��������� ��� � �����, �������� 1 � ������� �������*/
settype ($nomer , "integer");
$nomer += 1;
$fp = fopen ("gbnumber.txt", "w");
if (!$fp) {
echo "<p>�� ���� ������� <b>gbnumber.txt</b> ��� ������.\n";
include "footer.inc";
exit;
}
fputs ($fp, "nomer=$nomer;\n");
fclose ($fp);

$file=fopen("gb.txt", "a");
if(!$file){
echo "<p>�� ���� ������� <b>���� ������</b> ��� ������.\n";
include "footer.inc";
}
$now = date("d.m.Y");
fputs($file, $nomer . "|" . $now . "|" . $name . "|" . $message . "\n");
fclose($file);

echo "<p>������� <b>$name</b>! ���� ��������� �� <b>$now</b> �������� � ���� ����� �������.<br><br>
<b>���������:</b> $message<br><br>
<a href='gb.php'><b>��������� � ����� �������</b></a>

 ";

include "footer.inc";
?>


</body>
</html>
