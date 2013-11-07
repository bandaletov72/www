<?php

$tm=getdate(time()+9*3600);
$date="$tm[year]-$tm[mon]-$tm[mday] $tm[hours]:$tm[minutes]:$tm[seconds]";

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

require ("../templates/$template/$speek/vars.txt"); require ("../templates/$template/$speek/config.inc");
$foud=0;
while (list ($key, $val) = each ($payment_metode)) {
$tmptmp=explode("|", $val);
if ($tmptmp[3]=="robokassa.php") {
$foud=1;
break;
}

}
if ($foud==0) { echo "payment methode not found"; exit;}
$out_summ = $_REQUEST["OutSum"];
$inv_id = $_REQUEST["InvId"];
$shp_item = $_REQUEST["Shp_item"];
$crc = $_REQUEST["SignatureValue"];
$crc = strtoupper($crc);

$my_crc = strtoupper(md5("$out_summ:$inv_id:".@$tmptmp[8]));

//def
if (!$_REQUEST["SignatureValue"]) { echo "Error 1"; exit;}
if (!$_REQUEST["OutSum"]) { echo "Error 2";  exit;}
  if (!$_REQUEST["InvId"]) { echo "Error 3";  exit; } else {
  if ($crc==$my_crc) {


  $cart_id = intval($_REQUEST['InvId']);

  $order_date = date("Y-m-d H:i:s",time());
$result="Success";

echo "OK".$cart_id."\n";
mail($sms_mail, "OPLATA $cart_id, SUM: ".doubleval($_REQUEST["OutSum"]), "OK".$cart_id."\r\nTransaction time: ".date("d/m/Y H:i:s", time()));

} else {
 echo "bad sign\n";
  exit();
}
}
?>
