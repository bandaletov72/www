<?php
include "header.inc";
//Проверим правильность Email
if ((!@$email) || (@$email=="")): $email=""; echo "Не указан Email!"; include "footer.inc"; exit; endif;
if ((!@$pass) || (@$pass=="")): $pass=""; echo "Не указан пароль!"; include "footer.inc"; exit; endif;
$email = trim($email);
$email = str_replace(chr(13) , "", $email);
$email = str_replace(chr(27) , "", $email);
$email = stripslashes($email);
$hache_num = array (5,9,12,2,29,23,7,17); #8 чисел от 1-31
//Генерация пароля
$gen_pass="";
$hache=md5($email);
reset($hache_num);
foreach ($hache_num as $key => $value) {
$gen_pass .= substr($hache, $value, 1);
}
if ($pass!==$gen_pass){
echo "Пароль не верен! Ваш Email не был удален из базы рассылки."; include "footer.inc"; exit;
} else {
$err="Email не найден в базе рассылки, возможно его уже удалили.";
$file="./base/mail_base.txt";
$f=file($file);
while (list ($line_num, $line) = each ($f)) {
$line = str_replace(chr(10) , "", $line);
$line = str_replace(chr(13) , "", $line);
$line = str_replace(chr(27) , "", $line);
if ($line==$email): $f[$line_num]=""; echo "Email: <b>$line</b> найден в базе рассылки - <b>удален</b></br>\n"; $err=""; endif;
}
if ($err=="") {
reset($f);
$fcontents=join ("", $f);
if ($fcontents!=="") {
$f= fopen($file , "w");
fputs ($f , $fcontents);
fclose($f);
} else {
echo "В базе не осталось ни одного Email.";
}
}else {
echo $err;
}
}
include "footer.inc";
?>