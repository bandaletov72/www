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

if ((!@$name) || (@$name=="")): echo"Вы не указали Ваше имя. Вернитесь назад и укажите Ваше имя."; include "footer.inc"; exit; endif;
if ((!@$message) || (@$message=="")): echo"Вы не ввели сообщение. Вернитесь назад и напишите Ваше сообщение."; include "footer.inc"; exit; endif;
if (strlen($message)>=10000): echo"Вы ввели слишком длинное сообщение (max - 10000 символов). Вернитесь назад и уменьшите Ваше сообщение."; include "footer.inc"; exit; endif;
if (strlen($name)>=100): echo"Вы ввели слишком длинное имя (max - 100 символов). Вернитесь назад и уменьшите Ваше имя."; include "footer.inc"; exit; endif;
//Убирем вертикальные черточки (это оказалось не хухры мухры)

$name1 = explode("|" , $name);
$name = join("/" , $name1);
$message1 = explode("|" , $message);
$message = join("/" , $message1);

//Убирем HTML, кавычки, перенос каретки и прочее

$name = str_replace("<" , "&lt" , $name);
$message = str_replace("<" , "&lt" , $message);
$name = str_replace(">" , "&gt", $name);
$message = str_replace(">" , "&gt", $message);
$name = str_replace("script" , "скрипт", $name);
$message = str_replace("script" , "скрипт", $message);
$name = str_replace(chr(13) , "", $name);
$message = str_replace(chr(13) , "", $message);
$name = str_replace(chr(27) , "", $name);
$message = str_replace(chr(27) , "", $message);
$name = trim($name);
$message = trim($message);
$name= stripslashes($name);
$message = stripslashes($message);

//Защитим емайлы от сборщиков Email

$name = str_replace("@" , " 'собака' ", $name);
$message = str_replace("@" , " 'собака' ", $message);

//Защитимся от мата

$name = str_replace("хуй" , "х**", $name);
$message = str_replace("хуй" , "х**", $message);
$name = str_replace("пизд" , "п***", $name);
$message = str_replace("пизд" , "п***", $message);
$name = str_replace(" бля" , " б**", $name);
$message = str_replace(" бля" , " б**", $message);
$name = str_replace(chr(10) , "<br>", $name);
$message = str_replace(chr(10) , "<br>", $message);

$fp = fopen ("gbnumber.txt", "r");
if (!$fp) {
echo "<p> Не могу открыть файл <b>gbnumber.txt</b>.\n";
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
/* Переведем его в число, прибавим 1 и запишем обратно*/
settype ($nomer , "integer");
$nomer += 1;
$fp = fopen ("gbnumber.txt", "w");
if (!$fp) {
echo "<p>Не могу открыть <b>gbnumber.txt</b> для записи.\n";
include "footer.inc";
exit;
}
fputs ($fp, "nomer=$nomer;\n");
fclose ($fp);

$file=fopen("gb.txt", "a");
if(!$file){
echo "<p>Не могу открыть <b>базу данных</b> для записи.\n";
include "footer.inc";
}
$now = date("d.m.Y");
fputs($file, $nomer . "|" . $now . "|" . $name . "|" . $message . "\n");
fclose($file);

echo "<p>Спасибо <b>$name</b>! Ваше сообщение от <b>$now</b> помещено в нашу книгу отзывов.<br><br>
<b>Сообщение:</b> $message<br><br>
<a href='gb.php'><b>Вернуться в книгу отзывов</b></a>

 ";

include "footer.inc";
?>


</body>
</html>
