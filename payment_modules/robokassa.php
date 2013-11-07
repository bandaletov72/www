<?php
if ($cart->itemcount>0)  {
$IncCurrLabel=$tmptmp[5];
$Valutokr=$tmptmp[6];
$MrchLogin = $tmptmp[4];
$OutSum = ($Valutokr*round((@$currencies[$IncCurrLabel]*$totulus/$kurs)/$Valutokr));
$InvId=$nomer;
$MerchantPass1=$tmptmp[7];

$SignatureValue= md5($MrchLogin.":".$OutSum.":".$InvId.":".$MerchantPass1);

//payment mode
if (!isset($tmptmp[4])) {$tmptmp[4]="";}
if ($tmptmp[4]=="\n") {$tmptmp[4]="";}
if ($tmptmp[4]!="") {
if (isset($currencies[$IncCurrLabel])==false) {
$verifylist="<div class=\"alert alert-error\">".$lang[1573].": <b>".$IncCurrLabel."</b> (".$lang[1574].")</div>";
} else {
$valutopl=$tmptmp[5];
$valutokr=$tmptmp[6];
$checkout="<div align=left><br>
<form id=pay name=pay method=\"POST\" action=\"http://robokassa.ru/Index.aspx\">
<img src=\"$htpath/payment_results/robo_main_logo.png\" title=\"Robokassa\">
<div>".$lang[482]."</div>
<div>
<a href=\"".$tmptmp[9]."?MrchLogin=".$MrchLogin."&OutSum=".$OutSum."&InvId=".$InvId."&Desc=".rawurlencode("Order #$InvId $htpath")."&SignatureValue=".$SignatureValue."\" class=\"btn btn-primary btn-large\" target=\"_top\"><font color=$nc0>".$lang[520]." ".$OutSum." $IncCurrLabel</font></a></div>";
$verifylist.=$checkout."<h4>".$lang[484]."</h4><br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist.="".$lang[483]." Robokassa<br><br><br><b>".$lang[244]."</b><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">$basout</div>";
}
} else {
$verifylist ="<div class=\"alert alert-error\">$lang[40]</div>";
}
?>
