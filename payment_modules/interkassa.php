<?php
if ($cart->itemcount>0)  {
$valutopl=$tmptmp[5];
$valutokr=$tmptmp[6];
$ik_shop_id = $tmptmp[4];
$ik_payment_amount = ($valutokr*round((@$currencies[$valutopl]*$totulus/$kurs)/$valutokr));
$ik_payment_id = $nomer;
$ik_payment_desc = "Order #$nomer / $htpath";
$ik_paysystem_alias = '';
$ik_baggage_fields = $htpath;
$ik_sign_hash = '';
$secret_key = $tmptmp[7];
$ik_sign_hash_str = $ik_shop_id.':'.
$ik_payment_amount.':'.
$ik_payment_id.':'.
$ik_paysystem_alias.':'.
$ik_baggage_fields.':'.
$secret_key;
$hachenumer = md5($ik_sign_hash_str);

//payment mode
if (!isset($tmptmp[4])) {$tmptmp[4]="";}
if ($tmptmp[4]=="\n") {$tmptmp[4]="";}
if ($tmptmp[4]!="") {
if (isset($currencies[$valutopl])==false) {
$verifylist="<div class=\"alert alert-error\">".$lang[1573].": <b>".$valutopl."</b> (".$lang[1574].")</div>";
} else {
$valutopl=$tmptmp[5];
$valutokr=$tmptmp[6];
$checkout="<div align=left><br>
<form id=pay name=pay method=\"POST\" action=\"http://www.interkassa.com/lib/payment.php\"  target=\"_top\">
<img src=\"$htpath/payment_results/interkassa_logo.gif\" title=\"Interkassa\">
<p>".$lang[482]."</p>
<p><b>".$lang[520]."</b> ".($valutokr*round((@$currencies[$valutopl]*$totulus/$kurs)/$valutokr))." $valutopl<br>
<br>
<input type=\"hidden\" name=\"ik_shop_id\" value=\"".$tmptmp[4]."\">
<input type=\"hidden\" name=\"ik_payment_amount\" value=\"".($valutokr*round((@$currencies[$valutopl]*$totulus/$kurs)/$valutokr))."\">
<input type=\"hidden\" name=\"ik_payment_id\" value=\"$nomer\">
<input type=\"hidden\" name=\"ik_payment_desc\" value=\"Order #$nomer / $htpath\">
<input type=\"hidden\" name=\"ik_paysystem_alias\" value=\"\">
<input type=\"hidden\" name=\"ik_baggage_fields\" value=\"".$htpath."\">
<input type=\"hidden\" name=\"ik_payment_timestamp\" value=\"".time()."\">
<input type=\"hidden\" name=\"ik_sign_hash\" value=\"".$hachenumer."\">
<input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[520]." ".($valutokr*round((@$currencies[$valutopl]*$totulus/$kurs)/$valutokr))." $valutopl\" name=\"process\"></p></form>";
$verifylist.=$checkout."<h4>".$lang[484]."</h4><br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist.="".$lang[483]." Interkassa<br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist ="<div class=\"alert alert-error\">$lang[40]</div>";
}
?>
