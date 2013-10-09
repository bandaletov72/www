<?php
if ($cart->itemcount>0)  {
$hachenumer=md5($shop_license);
//Webmoney payment mode
if (!isset($tmptmp[4])) {$tmptmp[4]="";}
if ($tmptmp[4]=="\n") {$tmptmp[4]="";}
if ($tmptmp[4]!="") {
if (!isset($currencies['RUR'])) {
$verifylist.="<br>Не указан курс рубля!<br>";

} else {
$checkout="<div align=left><br>
<form id=pay name=pay method=\"POST\" action=\"https://merchant.webmoney.ru/lmi/payment.asp\">
<img src=\"$htpath/images/wm_logo.jpg\" title=\"Webmoney\">
<p>".$lang[482]."</p>
<p><b>".$lang[520]."</b> ".(1*round(($currencies['RUR']*$totulus/$kurs)/1))." WMR<br>
<br><input type=\"hidden\" name=\"LMI_PAYMENT_AMOUNT\" value=\"".(1*round(($currencies['RUR']*$totulus/$kurs)/1))."\">
<input type=\"hidden\" name=\"LMI_PAYMENT_DESC\" value=\"Order #$nomer / $htpath\">
<input type=\"hidden\" name=\"LMI_PAYMENT_NO\" value=\"$nomer\">
<input type=\"hidden\" name=\"LMI_PAYEE_PURSE\" value=\"".$tmptmp[4]."\">
<input type=\"hidden\" name=\"HASH_CODE\" value=\"".$hachenumer."\">
<input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[520]." ".(1*round(($currencies['RUR']*$totulus/$kurs)/1))." WMR\"></p></form>";
$verifylist.=$checkout."<h4>".$lang[484]."</h4><br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist.="".$lang[483]." Webmoney Transfer<br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist =$lang[40];
}
?>
