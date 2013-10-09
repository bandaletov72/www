<?php
if ($cart->itemcount>0)  {
$hachenumer=md5($shop_license);
//PP payment mode
if (!isset($tmptmp[4])) {$tmptmp[4]="";}
if ($tmptmp[4]=="\n") {$tmptmp[4]="";}
if ($tmptmp[4]!="") {
reset ($currencies);
$keyc="";
while (list ($keyct, $stc) = each ($currencies_sign)) {

if ($keyct==$valut) {

	$keyc=$keyct;

	}
}

$checkout="<div align=left>
<p><table border=0 width=100%><tr><td valign=middle><img src=\"$image_path/paypal_logo.gif\"></td><td align=center valign=middle><h4>".$lang[244]." #$nomer</h4></td><td valign=middle align=right><a target=\"_blank\" href=\"https://www.paypal.com/ru/cgi-bin/webscr?cmd=xpt/Merchant/popup/WaxAboutPaypal-outside&amp;justSecure=true\"><small>".$lang[481]." <img src=\"$image_path/secure.gif\" border=0></small></a></td></tr></table></p>
<p>".$lang[476]." <img src=\"$htpath/images/visa.gif\" title=\"".$lang[477]."\"> <img src=\"$image_path/mc.gif\" title=\"".$lang[478]."\"> <img src=\"$image_path/amex.gif\" title=\"".$lang[479]."\"> <img src=\"$image_path/bank.gif\" title=\"".$lang[480]."\"></p>
<p>".$lang[482]."</p>
<p>
<form class=form-inline action=\"$pp_form_action_url\" method=\"post\">
  <input type=\"hidden\" name=\"cmd\" value=\"_cart\">
  <input type=\"hidden\" name=\"upload\" value=\"1\">
  <input type=\"hidden\" name=\"currency_code\" value=\"$keyc\">
  <input type=\"hidden\" name=\"business\" value=\"".$tmptmp[4]."\">
  <input type=\"hidden\" name=\"item_name_1\" value=\"Order $nomer / $htpath\">
  <input type=\"hidden\" name=\"amount_1\" value=\"".($currencies_round[$keyc]*round((($totulus/
  $kurs)*$currencies[$keyc])/
  $currencies_round[$keyc]))."\">
  <input type=\"hidden\" name=\"return\" value=\"$htpath/payment_results/pp_success.php\">
  <input type=\"submit\" class=\"btn btn-primary\" value=\"".$tmptmp[7]." #$nomer [".($currencies_round[$keyc]*round((($totulus/
  $kurs)*$currencies[$keyc])/
  $currencies_round[$keyc]))." $keyc]\">
</form>
<br><h4>".$lang[519]."</h4>
<table border=0 cellspacing=10><tr>";
reset ($currencies);
$tr=0;
while (list ($keyc, $stc) = each ($currencies)) {
if ($keyc=="RUR") {
//not paypal payment available
} else{
$checkout.="<td align=center><form class=form-inline action=\"$pp_form_action_url\" method=\"post\">
  <input type=\"hidden\" name=\"cmd\" value=\"_cart\">
  <input type=\"hidden\" name=\"upload\" value=\"1\">
  <input type=\"hidden\" name=\"currency_code\" value=\"$keyc\">
  <input type=\"hidden\" name=\"business\" value=\"".$tmptmp[4]."\">
  <input type=\"hidden\" name=\"item_name_1\" value=\"Order $nomer / $htpath\">
  <input type=\"hidden\" name=\"amount_1\" value=\"".($currencies_round[$keyc]*round((($totulus/$kurs)*$currencies[$keyc])/$currencies_round[$keyc]))."\">
  <input type=\"hidden\" name=\"return\" value=\"$htpath/payment_results/pp_success.php\">
  <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[520]." ".($currencies_round[$keyc]*round((($totulus/$kurs)*$currencies[$keyc])/$currencies_round[$keyc]))." $keyc\">
</form></td>";
$tr+=1;
if ($tr>=4) {$tr=0; $checkout.="</tr><tr>";}
}
}
$checkout.="</tr></table>";
$verifylist.=$checkout."<h4>".$lang[484]."</h4><br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";

} else {
$verifylist.="".$lang[483]." PayPal<br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist =$lang[40];
}
?>
