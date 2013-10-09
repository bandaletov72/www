<!DOCTYPE html><html>

<head>
  <title>SUCCESS</title>
</head>

<body>

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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");


$hashnum=md5($secret_salt.$hache_salt);
if (!isset($_POST['HASH_CODE'])) { echo "HASH_CODE failed!"; }
if (!isset($_POST['HASH_CODE'])){$_POST['HASH_CODE']="";} if (!preg_match("/^[a-fA-F0-9]+$/i",$_POST['HASH_CODE'])) { $_POST['HASH_CODE']="";}
if (!isset($_POST['LMI_PAYMENT_NO'])) {echo  "LMI_PAYMENT_NO failed!"; }
if (!isset($_POST['LMI_PAYMENT_NO'])){$_POST['LMI_PAYMENT_NO']="";} if (!preg_match("/^[a-fA-F0-9]+$/i",$_POST['LMI_PAYMENT_NO'])) { $_POST['LMI_PAYMENT_NO']="";}


if (($_POST['HASH_CODE']!="")&&($_POST['LMI_PAYMENT_NO']!="")) {
echo "<h4>Спасибо за своевременную оплату!</h4>Платеж успешно проведен! Оператор уведомлен об успешном проведении платежа по E-mail.<br>";
$mailbody="Поступила оплата заказа #". @$_POST['LMI_PAYMENT_NO']."<br>";
$mailbody.="LMI_PAYMENT_NO=". @$_POST['LMI_PAYMENT_NO'];
$mailbody.="<br>";
$mailbody.="LMI_SYS_INVS_NO=".@$_POST['LMI_SYS_INVS_NO'];
$mailbody.="<br>";
$mailbody.="LMI_SYS_TRANS_NO=".@$_POST['LMI_SYS_TRANS_NO'];
$mailbody.="<br>";
$mailbody.="LMI_SYS_TRANS_DATE=".@$_POST['LMI_SYS_TRANS_DATE'];
$mailbody.="<br>";
$mailbody.="HASH_CODE=".@$_POST['HASH_CODE'];
if ($hashnum!=$_POST['HASH_CODE']) {$mailbody.="<br><b>Цифровая подпись платежа не совпадает с цифровой подписью на сайте!</b>";}

mail ("$shop_mail","Оплата заказа ".$_POST['LMI_PAYMENT_NO'], $mailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");

} else {
echo "Платеж успешно завершен.<br>Внимание! Неправильно настроены параметры в Webmoney Merchant!";
}
echo "<br><br><a href=\"$htpath\">Вернуться на главную страницу сайта <b>$htpath</b></a>";
?>

</body>

</html>
