<!DOCTYPE html><html>

<head>
  <title>Result</title>
</head>

<body>
<img src=interkassa_logo.gif border=0>
<?php

$form_action_url="";

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


while (list ($key, $val) = each ($payment_metode)) {
$tmptmp=explode("|", $val);
if ($tmptmp[3]=="interkassa.php") {
break;
}

}

  if (!$_POST["ik_trans_id"]) { echo "<h1>You can not be there!</h1>"; } else {


  $cart_id = intval($_POST['item_number']);

  $order_date = date("Y-m-d H:i:s",strtotime ($_POST["payment_date"]));
$result=$_POST["ik_payment_state"];

  mail($adminemail, strtoupper($_POST["ik_payment_state"])." payment ". $_POST["ik_payment_id"], "New payment ".strtoupper($_POST["ik_payment_state"])."\r\nOrder ID: ". $_POST["ik_payment_id"]."\r\nTransaction ID: "
    .$_POST["ik_trans_id"]."\r\nTransaction time: "
    .@date ("d/m/Y H:i:s", $_POST["ik_payment_timestamp"])."\r\n".$_POST["ik_trans_id"]);
echo "<h1>".strtoupper($_POST["ik_payment_state"])."!</h1> Order #".$_POST["ik_payment_id"]." / Ref: ".$_POST["ik_trans_id"]."<br>Time: ".@date ("d/m/Y H:i:s", $_POST["ik_payment_timestamp"])."<br><br>";
}

echo "".$lang['back'].": <a href=\"$htpath\"><b>$htpath</b></a>";
?>

</body>

</html>
