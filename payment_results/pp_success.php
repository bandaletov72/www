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
$fold="."; require ("../templates/lang.inc");
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

//def
  $paypalemail = "bandaletov@9566366.ru";     // e-mail продавца
  $adminemail  = "bandaletov@9566366.ru";  // e-mail  администратора
  $currency    = "EUR";              // валюта

while (list ($key, $val) = each ($payment_metode)) {
$tmptmp=explode("|", $val);
if ($tmptmp[6]=="paypal") {
$paypalemail=$tmptmp[4];
$adminemail=$shop_mail;
$currency=$tmptmp[5];
}

}
//echo "$paypalemail $adminemail  $currency";

  /********
  запрашиваем подтверждение транзакции
  ********/
  $postdata="";
  foreach ($_POST as $key=>$value) $postdata.=$key."=".urlencode($value)."&";
  $postdata .= "cmd=_notify-validate";
  $curl = curl_init($pp_form_action_url);
  curl_setopt ($curl, CURLOPT_HEADER, 0);
  curl_setopt ($curl, CURLOPT_POST, 1);
  curl_setopt ($curl, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt ($curl, CURLOPT_SSL_VERIFYHOST, 1);
  $response = curl_exec ($curl);
  curl_close ($curl);
  echo $response;
if ($response != "VERIFIED") die("You should not do that ...");

  /********
  проверяем получателя платежа и тип транзакции, и выходим, если не наш аккаунт
  в $paypalemail - наш  primary e-mail, поэтому проверяем receiver_email
  ********/
  if ($_POST['receiver_email'] != $paypalemail
    || $_POST["txn_type"] != "web_accept")
      die("You should not be here ...");


  $cart_id = intval($_POST['item_number']);

  $order_date = date("Y-m-d H:i:s",strtotime ($_POST["payment_date"]));
$mail= "
    txn_id      = ".$_POST["txn_id"]."',<br>
    order_date  = $order_date',<br>
    cart_id=$cart_id,<br>
    order_total = ".$_POST["mc_gross"]." ".$_POST["mc_currency"].",<br>
    email       = ".$_POST["payer_email"].",<br>
    first_name  = ".$_POST["first_name"].",<br>
    last_name   = ".$_POST["last_name"].",<br>
    street      = ".$_POST["address_street"].",<br>
    city        = ".$_POST["address_city"].",<br>
    state       = ".$_POST["address_state"].",<br>
    zip         = ".$_POST["address_zip"].",<br>
    country     = ".$_POST["address_country"]."<br>
    STATUS: ".$_POST["payment_status"]."";

  mail($adminemail, "New order", "New order\r\nOrder ID: ". $order_id."\r\nTransaction ID: "
    .$_POST["txn_id"]."\n$mail");
    echo $mail;

echo "<br><br>".$lang['back'].": <a href=\"$htpath\"><b>$htpath</b></a>";
?>

</body>

</html>
