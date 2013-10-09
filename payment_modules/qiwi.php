<?php
if ($cart->itemcount>0)  {
$hachenumer=md5($shop_license);
//QIWI payment mode
if (!isset($tmptmp[4])) {$tmptmp[4]="";}
if ($tmptmp[4]=="\n") {$tmptmp[4]="";}
if ($tmptmp[4]!="") {
if (!isset($currencies['RUR'])) {
$verifylist.="<br>Не указан курс рубля!<br>";

} else {
// Выписываем qiwi счёт для покупателя

$checkout="<div class=round2>Если у Вас еще нет QIWI кошелька - заведите его здесь: <a href=https://w.qiwi.ru/>https://w.qiwi.ru/</a><br><br><form id=pay name=pay method=\"GET\" action=\"$htpath/payment_results/qiwi.php\">
<img src=\"$htpath/payment_results/qiwi_logo.png\" title=\"QIWI\">
<p>".$lang[482]."</p>
<p><br>
<input type=\"hidden\" name=\"total\" value=\"".(1*round(($currencies['RUR']*$totulus/$kurs)/1))."\">
<input type=\"hidden\" name=\"comment\" value=\"#$nomer / ".str_replace("http://", "", str_replace("http://www.", "",$htpath))."\">
<input type=\"hidden\" name=\"txn\" value=\"$nomer\">
<table border=0><tr><td valign=top>Номер вашего моб.телефона (10 цифр без восьмерки):</td><td valign=top><input type=\"text\" size=10 name=\"qiwi_telephone\" value=\"\"></td></tr><tr><td valign=top><small><b>Мобильный телефон должен быть зарегистрирован в системе QIWI!</small></b> </td><td valign=top><small>например: <i>926XXXXXXX</i></small></td></tr></table>

<br><br><input type=\"submit\" class=\"btn btn-primary\" value=\"Сформировать счет\"><br>
</p></form></div><br>";
$verifylist.=$checkout."<h4>".$lang[484]."</h4><br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist.=$lang[483]." QIWI<br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist =$lang[40];
}


?>
