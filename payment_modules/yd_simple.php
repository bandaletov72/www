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


$checkout="<br><br><div align=left>
<form style=\"margin: 0; padding: 0;\" class=form-inline action=\"https://money.yandex.ru/charity.xml\" method=\"post\">
<input type=\"hidden\" name=\"to\" value=\"".$tmptmp[4]."\"/>
<input type=\"hidden\" name=\"CompanyName\" value=\": Оплата заказа №$nomer в $shop_name\"/>
<input type=\"hidden\" name=\"CompanyLink\" value=\"$htpath\"/>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"10\" class=ocat1><tr><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr><td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr><td><input type=\"submit\" class=\"btn btn-primary\" value=\"Отправить\" style=\"margin-right: 5px;\"/></td>
<td><input type=\"text\" id=\"CompanySum\" name=\"CompanySum\" readonly=\"readonly\" value=\"".(1*round(($currencies['RUR']*$totulus/$kurs)/1))."\" size=\"4\" style=\"margin-right: 5px;\"/></td>
<td nowrap=\"nowrap\" valign=\"bottom\"><strong>рублей Яндекс.Деньгами</strong></td>
</tr></table></td><td width=\"90\" rowspan=\"3\" valign=\"bottom\"><a href=\"http://money.yandex.ru/\"><img src=\"https://img.yandex.net/i/ym-logo.gif\" width=\"90\" height=\"39\" border=\"0\" style=\"margin-left: 5px;\"/></a></td></tr>
<tr><td nowrap=\"nowrap\">на счет <span style=\"color: #006600; font-weight: bold;\">
".$tmptmp[4]."
</span>&nbsp;(<span class=lnk><a href=\"http://$htpath\">$shop_name</a></span>)</td></tr><tr>
<td><img src=\"https://img.yandex.net/i/x.gif\" width=\"1\" height=\"10\" /></td></tr></table></div></div></div></div></td></tr></table></form>
<b>Внимание!</b> После оплаты, обязательно оповестите об этом администратора, <b><a href=$htpath/index.php?action=sendmail>написав письмо</a></b>. Укажите <b>сумму</b>, <b>дату</b>, <b>время платежа</b> и Ваш номер заказа: <b>№$nomer</b>.<br><br>
";
$verifylist.=$checkout."<h4>".$lang[484]."</h4><br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist.="".$lang[483]." Yandex-Деньги<br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist =$lang[40];
}
?>
