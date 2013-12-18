<?php
$agreem="";
$aagreem="";
$x0004="";
if (!isset($view_agreement)) {} else {if ($view_agreement==1) {
if (@file_exists("$base_loc/content/x0004.txt")==TRUE) {
$agreement = fopen ("$base_loc/content/x0004.txt" , "r");
$agree_content = fread($agreement, filesize("$base_loc/content/x0004.txt"));
if (preg_match("/==(.*)==/i", $agree_content, $outputdd)) {
$agree_title=$outputdd[1];
} else {
$agree_title = $lang[347];
}
fclose ($agreement);

$x0004= str_replace("==$agree_title==", "" , $agree_content);
if (($valid=="1")&&($details[7]=="ADMIN")): $aagreem= "<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">x0004</span><br><input class=btn type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/x0004.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')></div>"; endif;


$agreem="<a name=\"agreement\"></a><div class=round3 style=\"width:100%; height: 200px; overflow: auto;\"><table border=0 class=table2><tr><td valign=top><h4>$agree_title</h4>";
$agreem.="$aagreem$x0004</td><td>&nbsp;</td><td valign=top><img src=\"$image_path/prevcv.png\" border=0><br><br><br><br><br><br><br><br><br><br><br><br><img src=\"$image_path/nextcv.png\" border=0></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td><img src=\"$image_path/prevcv.png\" border=0></td></tr></table></div>";  unset ($agree_content, $agree_title, $agreement);
}
}
}
$jscountr="";
$chids="<span>";
$formlist="";
$details = $cart->get_details();
$totalweight=$cart->totalweight;
$totalvolume=$cart->totalvolume;
$formout="";
$choosestreet="";
$vcab=0;
if (!isset($_SESSION["user_noregs"])){$_SESSION["user_noregs"]="";}
if (($_SESSION["user_noregs"]=="no")||($_SESSION["user_noregs"]=="")) {$vcab=1;}
if ($action=="cabinet") { $vcab=0;}
//var_dump($details);
if ($valid==1) {$vcab=0;}

if ($vcab==1) {
$formlist="";
$backlink="action=zakaz&step=$step&regid=$regid&prop=$prop";
$exitform="<form method=GET action=$htpath/index.php>
<input type=hidden name=action value=zakaz>
<input type=hidden name=step value=1>
<input type=hidden name=prop value=$prop>
<input type=hidden name=regid value=$regid>
<input type=hidden name=blog_out value=yes>
<input class=btn type=submit value=\"".$lang['exit']."\">
</form>";
$inname="";
require "./modules/social_auth.php";
$formlist.="$social_auth<div class=clearfix>
<div class=\"panel pull-right\" style=\"width:40%; padding:20px;\">
<b>".$lang[467]."</b><br><br>
<small>".$lang['regtext']."</small>
<form name=\"ok2\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
<input type=hidden name=\"register\" value=1><div align=center>
<br><input class=\"btn btn-success btn-large\" type=submit value=\"".str_replace(" ", "&nbsp;", $lang[39])."\">
</div>
</form>
</div>

<div class=\"pull-left\" style=\"width:40%; padding: 20px;\">
<b>".$lang[464]."</b><br><br>
<script type=\"text/javascript\">
function submit_auth(e)
{
	if (e.keyCode == 13)
	{
		document.ok1.submit();
		return false;
	}
}

</script>
<form name=\"ok1\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
<table class=table2 border=0 style=\"margin:0; padding:0;\">
<tr>
<td><small>".$lang['login']."<font color=$nc3>*</font></small></td>
<td>
<input type=hidden name=\"action\" value=\"zakaz\"><input type=hidden name=\"noregs\" value=\"yes\"><input type=hidden name=\"logout\" value=\"1\">
<input type=text name=\"login\" value=\"$login\" style=\"width:100px;\" onkeyup=\"submit_auth(event);\">
</td>
<td><input class=\"btn btn-primary\" type=submit id=\"subm\" value=\"".$lang[940]."\"></td>
</tr>
<tr>
<td><small>".$lang['pass']."<font color=$nc3>*</font></small></td>
<td><input type=password name=\"password\" value=\"$password\" style=\"width:100px;\" onkeyup=\"submit_auth(event);\"></td>
<td><small><a href=\"$htpath/index.php?action=restore\" style=\"border-bottom: 2px dotted $nc3;\">".str_replace(" ", "&nbsp;", $lang[86])."</a></small></td>
</tr>
</table>
</form>
</div>
<div class=clearfix></div>
</div>
<div style=\"padding:10px;\"><small>".$lang[468]." <a href=\"index.php?action=zakaz&noregs=yes\" style=\"border-bottom: 2px dotted $nc3;\">".$lang[469]."</a></small>
</div>
";
} else {
$step=2;
$choosesd="";
$choosepm="";
$jsd="";
$jpm="";
$jsdload="";
$jpmload="";
if ($smod=="shop") {
$carttotal=$cart->total;
$ccarttotal=ssale($carttotal , $currencies_sign[$_SESSION["user_currency"]]);
} else {
$carttotal=0;
$ccarttotal=0;

}
$oldcarttotal=$carttotal;
$carttotal=$ccarttotal;
if (isset($reg_as)) {
while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if($srmasss[1]!=0) {
$firstregid=$srrnum;
break;
}
unset ($srmasss);
}
}
reset ($reg_as);

while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);

$setregid[$srrnum]=$srmasss[1];
$setregid2[$srrnum]=$srmasss[0];
unset ($srmasss);
}
}
reset ($reg_as);

}

if ($regid=="") {$regid=$details[0]; if (isset($setregid[$regid])) { if ($setregid[$regid]==0) { $regid=$firstregid; }} $prop=$regid;}
if ($regid=="") {$regid=$firstregid; $prop=$regid;}


$backlink="action=zakaz&step=$step&regid=$regid&prop=$prop";
$exitform="<form method=GET action=$htpath/index.php>
<input type=hidden name=action value=zakaz>
<input type=hidden name=step value=1>
<input type=hidden name=prop value=$prop>
<input type=hidden name=regid value=$regid>
<input type=hidden name=blog_out value=yes>
<input class=btn type=submit value=\"".$lang['exit']."\">
</form>";
$inname="";
require "./modules/social_auth.php";

//способы оплаты

if (isset($payment_metode)) {
while (list ($srrnum, $srrline) = each ($payment_metode)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if($srmasss[1]!=0) {
$firstpm=$srrnum;
break;
}
unset ($srmasss);
}
}
reset ($payment_metode);




if (isset($setpm[$pm])) { if ($setpm[$pm]==0) { $pm=$firstpm; }}
if ($pm=="") {$pm=0; if (isset($setpm[$pm])) { if ($setpm[$pm]==0) { $pm=$firstpm; }}}
if ($pm=="") {$pm=$firstpm;}


//Способы доставки

if (isset($delivery_metode)) {
while (list ($srrnum, $srrline) = each ($delivery_metode)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if($srmasss[1]!=0) {
$firstsd=$srrnum;
break;
}
unset ($srmasss);
}
}
reset ($delivery_metode);





if (isset($setsd[$sd])) { if ($setsd[$sd]==0) { $sd=$firstsd; }}
if ($sd=="") {$sd=0; if (isset($setsd[$sd])) { if ($setsd[$sd]==0) { $sd=$firstsd; }}}
if ($sd=="") {$sd=$firstsd;}


while (list ($srrnum, $srrline) = each ($payment_metode)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if($srmasss[1]!=0) {
if (preg_match("/\%/", $srmasss[2])) {

if (preg_match("/\-/", $srmasss[2])) {
$addpm=doubleval(str_replace("-","", str_replace("\%","",$srmasss[2])));
//$addpm=$okr*round($addpm/$okr);
//echo "1.".$addpm." ".($okr*(round((0-($carttotal*$addpm/100))/$okr)));
//if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addpm=0;}}
$jpm.="pm[$srrnum]=".($okr*(round((0-($carttotal*$addpm/100))/$okr))).";\n";
if ($jpmload=="") {$discontf1=($okr*(round((0-($carttotal*$addpm/100))/$okr))); $jpmload="1";}

} else {
$addpm=doubleval(str_replace("+","", str_replace("\%","",$srmasss[2])));
//$addpm=$okr*round($addpm/$okr);
//echo "2.".$addpm." ".($okr*(round((0+($carttotal*$addpm/100))/$okr)));
//if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addpm=0;}}
$jpm.="pm[$srrnum]=".($okr*(round((0+($carttotal*$addpm/100))/$okr))).";\n";
if ($jpmload=="") {$discontf1=($okr*(round((0+($carttotal*$addpm/100))/$okr))); $jpmload="1";}
}

} else {
if ($srmasss[2]!=""){
if (preg_match("/\-/", $srmasss[2])) {
$addpm=doubleval(str_replace("-","", str_replace(" ","",$srmasss[2])));
$addpm=$okr*round($addpm/$okr);
//echo "3.".$addpm;
//if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addpm-=$currencies_zakaz_dostav[$valut];}}
$jpm.="pm[$srrnum]=".($okr*(round((0-$addpm)/$okr))).";\n";
if ($jpmload=="") {$discontf1=($okr*(round((0-$addpm)/$okr))); $jpmload="1";}
$srmasss[2]=($okr*(round((0-$addpm)/$okr)))." ".$currencies_sign[$_SESSION["user_currency"]]."";
} else {
$addpm=doubleval(str_replace("+","", str_replace(" ","",$srmasss[2])));
$addpm=$okr*round($addpm/$okr);
//echo "4.".$addpm;
//if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addpm-=$currencies_zakaz_dostav[$valut];}}
$jpm.="pm[$srrnum]=".($okr*(round((0+$addpm)/$okr))).";\n";
if ($jpmload=="") {$discontf1=($okr*(round((0+$addpm)/$okr))); $jpmload="1";}
$srmasss[2]="+".($okr*(round((0+$addpm)/$okr)))." ".$currencies_sign[$_SESSION["user_currency"]]."";
}

} else {
$jpm.="pm[$srrnum]=0;\n";
if ($jpmload=="") {$discontf1=0; $jpmload="1";}
}
}

if ($pm!=$srrnum) { $choosepm.="<input type=radio value=\"".$srrnum."\" id=\"pm_".$srrnum."\" onclick=selectpm('".$srrnum."') name=\"pm\"><label for=\"pm_".$srrnum."\">".$srmasss[0]." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {}else {$choosepm.=$srmasss[2];}} else {$choosepm.=$srmasss[2];}  $choosepm.="</label>\n"; }
$setpm[$srrnum]=$srmasss[1];
unset ($srmasss);
}
}
}
reset ($payment_metode);

}

while (list ($srrnum, $srrline) = each ($delivery_metode)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if($srmasss[1]!=0) {
if (preg_match("/\%/", $srmasss[2])) {

if (preg_match("/\-/", $srmasss[2])) {
$addsd=doubleval(str_replace("-","", str_replace("\%","",$srmasss[2])));
//$addsd=$okr*round($addsd/$okr);
//echo "1.".$addsd;
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd=0;}}
$jsd.="sd[$srrnum]=".($okr*(round((0-(round(($carttotal*$addsd/100)/$okr))+(ceil($totalweight)*$srmasss[6]))/$okr))).";\n";
if ($jsdload=="") {$discontf2=(0-$okr*(round(($carttotal*$addsd/100)/$okr))+($okr*(round((ceil($totalweight)*$srmasss[6])/$okr))));  $jsdload="1";}
} else {
$addsd=doubleval(str_replace("+","", str_replace("\%","",$srmasss[2])));
//$addsd=$okr*round($addsd/$okr);
//echo "2.".$addsd;
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd=0;}}

$jsd.="sd[$srrnum]=".(0+$okr*(round(($carttotal*$addsd/100)/$okr))+($okr*(round((ceil($totalweight)*$srmasss[6])/$okr)))).";\n";
if ($jsdload=="") {$discontf2=(0+$okr*(round(($carttotal*$addsd/100)/$okr))+($okr*(round((ceil($totalweight)*$srmasss[6])/$okr)))); $jsdload="1";}

}

} else {
if ($srmasss[2]!=""){
if (preg_match("/\-/", $srmasss[2])) {
$addsd=doubleval(str_replace("-","", str_replace(" ","",$srmasss[2])));
$addsd=$okr*round($addsd/$okr);
//echo "3.".$addsd;
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd-=$currencies_zakaz_dostav[$valut];}}

$jsd.="sd[$srrnum]=".($okr*(round((0+(ceil($totalweight)*$srmasss[6]))/$okr))-$addsd).";\n";
if ($jsdload=="") {$discontf2=($okr*(round((0+(ceil($totalweight)*$srmasss[6]))/$okr))-$addsd);  $jsdload="1";}
$srmasss[2]=($okr*(round((0-$addsd)/$okr)))." ".$currencies_sign[$_SESSION["user_currency"]]."";
} else {
$addsd=doubleval(str_replace("+","", str_replace(" ","",$srmasss[2])));
$addsd=$okr*round($addsd/$okr);
//if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) { $addsd-=$currencies_zakaz_dostav[$valut];}}
//echo "4. $carttotal -> ".$currencies_zakaz_menee[$valut]." : ".$okr*round($addsd/$okr)."; $okr; $srmasss[6]<br> ";
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd=0;}}
$jsd.="sd[$srrnum]=".(($okr*round(ceil($totalweight)*$srmasss[6]/$okr))+$addsd).";\n";
if ($jsdload=="") {$discontf2=(($okr*round(ceil($totalweight)*$srmasss[6]/$okr))+$addsd); $jsdload="1";}
$srmasss[2]="+ ".$addsd." ".$currencies_sign[$_SESSION["user_currency"]]."";
}
} else {
$jsd.="sd[$srrnum]=0;\n";
if ($jsdload=="") {$discontf2=0; $jsdload="1";}
}
}
if ($sd!=$srrnum) { $choosesd.="<input type=radio value=\"".$srrnum."\" id=\"sd_".$srrnum."\" onclick=selectsd('".$srrnum."') name=\"sd\"><label for=\"sd_".$srrnum."\">".$srmasss[0]." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$choosesd.=$lang[166];} else {$choosesd.=$srmasss[2];}} else {$choosesd.=$srmasss[2];}  if ($srmasss[6]!=0) {$choosesd.=" +".$okr*round($srmasss[6]/$okr)." ".$currencies_sign[$_SESSION["user_currency"]]."/$kg (".ceil($totalweight)." $kg = ".$okr*round((ceil($totalweight)*$srmasss[6])/$okr)."".$currencies_sign[$_SESSION["user_currency"]].")"; } $choosesd.="</label>\n"; }
$setsd[$srrnum]=$srmasss[1];
unset ($srmasss);
}
}
}
reset ($delivery_metode);

}
//echo $currencies_zakaz_menee[$valut]." >= $carttotal<br>$pm - $firstpm - $discontf1 / $sd - $firstsd - $discontf2";
if ($discont1=="na") {$discont1=$discontf1;}
if ($discont2=="na") {$discont2=$discontf2;}

$srmasss=explode("|",$payment_metode[$pm]);
if (preg_match("/\%/", $srmasss[2])) { } else { if ($srmasss[2]!="") {
if (preg_match("/\-/", $srmasss[2])) {
$addsd=doubleval(str_replace("-","", str_replace(" ","",$srmasss[2])));
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd-=$currencies_zakaz_dostav[$valut];}}
$srmasss[2]=(0-$addsd)." ".$currencies_sign[$_SESSION["user_currency"]]."";
} else {
$addsd=doubleval(str_replace("+","", str_replace(" ","",$srmasss[2])));
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd-=$currencies_zakaz_dostav[$valut];}}
$srmasss[2]="+".$addsd." ".$currencies_sign[$_SESSION["user_currency"]]."";
}
}}
$selectpm="<input type=radio value=\"".$pm."\" checked=\"checked\" id=\"pm_".$pm."\" onclick=selectpm('".$pm."') name=\"pm\"><label for=\"pm_".$pm."\">".strtoken($payment_metode[$pm],"|")." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {}else {$selectpm.=$srmasss[2];}} else {$selectpm.=$srmasss[2];}  $selectpm.="</label>\n";
unset ($srmasss);
$srmasss=explode("|",$delivery_metode[$sd]);
if (preg_match("/\%/", $srmasss[2])) { } else { if ($srmasss[2]!="") {
if (preg_match("/\-/", $srmasss[2])) {
$addsd=doubleval(str_replace("-","", str_replace(" ","",$srmasss[2])));
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd-=$currencies_zakaz_dostav[$valut];}}
$srmasss[2]=(0-$addsd)." ".$currencies_sign[$_SESSION["user_currency"]]."";
} else {
$addsd=doubleval(str_replace("+","", str_replace(" ","",$srmasss[2])));
if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$addsd-=$currencies_zakaz_dostav[$valut];}}
$srmasss[2]="+".$addsd." ".$currencies_sign[$_SESSION["user_currency"]]."";
}
}}
$selectsd="<input type=radio value=\"".$sd."\" checked=\"checked\" id=\"sd_".$sd."\" onclick=selectsd('".$sd."') name=\"sd\"><label for=\"sd_".$sd."\">".strtoken($delivery_metode[$sd],"|")." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$selectsd.=$lang[166];} else {$selectsd.=$srmasss[2];}} else {$selectsd.=$srmasss[2];}  if ($srmasss[6]!=0) {$selectsd.=" +".$srmasss[6].$currencies_sign[$_SESSION["user_currency"]]."/$kg (".ceil($totalweight)." $kg = ".(ceil($totalweight)*$srmasss[6]).$currencies_sign[$_SESSION["user_currency"]].")"; } $selectsd.="</label>\n";
unset ($srmasss);
//Форма выбора способов оплаты
if (count($payment_metode)>1) {
$formpayment="

<script language=\"javascript\">
<!--
function selectpm(id) {
var pm = new Array();
$jpm
var sel = 0+parseFloat(document.getElementById('pm_'+id).value);
var jbaskvalue = parseFloat(document.getElementById('jscheck').innerHTML);
if (jbaskvalue==0) { jbaskvalue=".$carttotal."; }
document.getElementById('discont1').value=pm[sel];
document.getElementById('totals').value=jbaskvalue+parseFloat(document.getElementById('discont1').value)+parseFloat(document.getElementById('discont2').value)
document.getElementById('sosk').innerHTML=document.getElementById('totals').value;  }
-->
</script>



<tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[160].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><div>".$selectpm."\n".$choosepm."</div><input type=hidden id=\"totcart\" value=\"$carttotal\"><input name=\"discont1\" type=\"hidden\" id=\"discont1\" value=\"$discont1\"></td>
  </tr>";
} else {
$formpayment="<input type=hidden name=\"pm\" value=\"0\"><input type=hidden id=\"totcart\" value=\"$carttotal\"><input name=\"discont1\" type=\"hidden\" id=\"discont1\" value=\"$discont1\">";


}
if (count($delivery_metode)>1) {
$formdelivery="
<script language=\"javascript\">
<!--
function selectsd(id) {
var sd = new Array();
$jsd
var jbaskvalue = parseFloat(document.getElementById('jscheck').innerHTML);
if (jbaskvalue==0) { jbaskvalue=".$carttotal."; }
var sel = 0+parseFloat(document.getElementById('sd_'+id).value);
document.getElementById('discont2').value=sd[sel];
document.getElementById('totals').value=jbaskvalue+parseFloat(document.getElementById('discont1').value)+parseFloat(document.getElementById('discont2').value)
document.getElementById('sosk').innerHTML=document.getElementById('totals').value;


}
-->
</script>

<tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[161].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><div>".$selectsd."\n".$choosesd."</div><input name=\"discont2\" type=\"hidden\" id=\"discont2\" value=\"$discont2\"><input type=\"hidden\" id=\"totals\" value=\"$carttotal\"></td>
  </tr>";

  $form_totals=" <tr>
    <td width=\"100%\" align=\"center\" valign=\"top\" colspan=\"3\"><br><div align=center style=\"border-top: $nc3 solid 4px;\"><br><font size=4>".$lang[165].": <b><span id=\"sosk\">$carttotal+$discont1+$discont2=".($carttotal+($okr*round($discont1/$okr))+($okr*round($discont2/$okr)))."</span></b> ".$currencies_sign[$_SESSION["user_currency"]]."</font></div>
      </td>
  </tr>";
} else {
$formdelivery = "<input type=hidden name=sd value=\"0\"><input name=\"discont2\" type=\"hidden\" id=\"discont2\" value=\"$discont2\"><input type=\"hidden\" id=\"totals\" value=\"$carttotal\">";


//if ($prop=="") {$prop=$details[0];}
//if ($prop=="") {$prop=$regid;}

$form_totals=" <tr>
    <td width=\"100%\" align=\"right\" valign=\"top\" colspan=\"3\"><div align=center>".$lang[165].": <b><font size=3 id=\"sosk\">".($carttotal+($okr*round($discont1/$okr))+($okr*round($discont2/$okr)))."</font></b> ".$currencies_sign[$_SESSION["user_currency"]]."</div>
      </td>
  </tr>";

}


if (!isset($fio)){$fio="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$fio)) { $fio="";}
if (!isset($agree)){$agree="";} if (!preg_match("/^[a-zA-Z-]+$/i",$agree)) { $agree="";}
if ($agree!="") {$agree=="ON"; }
if (!isset($wishlist)){$wishlist="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$wishlist)) { $wishlist="";}
if ((!@$country) || (@$country=="")): $country=""; endif;
if ((!@$telcode) || (@$telcode=="")): $telcode=""; endif;
if ((!@$email) || (@$email=="")): $email=""; if ($inname!="") {$email=$_SESSION["fb_email"];} endif;
if ((!@$fio) || (@$fio=="")): $fio=""; if ($inname!="") {$fio="$inname";} endif;
if ((!@$tel) || (@$tel=="")): $tel=""; endif;
if ((!@$metro) || (@$metro=="")): $metro=""; endif;
if ((!@$street2) || (@$street2=="")): $street2=""; endif;
if ((!@$street) || (@$street=="")): $street=""; endif;
if ((!@$house) || (@$house=="")): $house=""; endif;
if ((!@$gorod) || (@$gorod=="")): $gorod=""; endif;
if ((!@$ofice) || (@$ofice=="")): $ofice=""; endif;
if ((!@$korp) || (@$korp=="")): $korp=""; endif;
if ((!@$pod) || (@$pod=="")): $pod=""; endif;
if ((!@$domophone) || (@$domophone=="")): $domophone=""; endif;
if ((!@$flat) || (@$flat=="")): $flat=""; endif;
if ((!@$other) || (@$other=="")): $other="";endif;

$arr2=array ("fio","tel","gorod", "metro","street","street2","house","ofice","korp" ,"pod" ,"domophone","flat","other","country","telcode");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags($$a);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "", $$a);
$$a = str_replace("%" , "o/o", $$a);
$$a = str_replace("<" , "", $$a);
$$a = str_replace(">" , "", $$a);
$$a = str_replace(chr(10) , "\n", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
}
$ffregid=@$details[0];
//echo $ffregid;
$nikn=@$details[1];

if ($fio==""):$fio=@$details[3];endif;
if ($email==""):$email=@$details[4];endif;
if ($tel==""):$tel=@$details[5];endif;
if ($metro==""):$metro=@$details[8];endif;
if ($street2==""):$street2=str_replace("^", "", strtoken(@$details[9],"^")); endif;

if ($street==""):$street=str_replace($street2."^", "", @$details[9]);endif;

if ($house==""):$house=@$details[10];endif;
if ($korp==""):$korp=@$details[11];endif;
if ($pod==""):$pod=@$details[12];endif;
if ($domophone==""):$domophone=@$details[13];endif;
if ($ofice==""):$ofice=@$details[14];endif;
if ($flat==""):$flat=@$details[15];endif;
if ($other==""):$other=@$details[16];endif;
if ($gorod==""):$gorod=@$details[17];endif;
if ($country==""): $country=strtoken(@$details[18]," ("); endif;
if ($telcode==""):$telcode=@$details[19];endif;





$choosesp2="";
if ($metro!="") { $choosemetro="<option value=\"".$metro."\" selected>".$metro."</option>"; } else {$choosemetro=""; $metrosel=" selected";}
if (@file_exists("./templates/$template/$speek/custom_metro.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_metro.inc");
reset ($user_arr);
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_num==0) { if ($metro=="") { if ($setregid[$regid]==1) {$metro=strtoken($user_mass[1], "(");} $metrosel="";} } else {$metrosel="";}
$choosemetro.="<option style=\"border-left: 10px solid $user_mass[0]; margin-left: 0; padding-left: 4px; padding-right: 4px; padding-top: 3px; padding-bottom: 3px\" value=\"".strtoken($user_mass[1], "(")."\"$metrosel>".$user_mass[1]."</option>";
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);
} else {$choosemetro="";}

if (@file_exists("./templates/$template/$speek/custom_street.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_street.inc");
reset ($user_arr);
$choosestreet.="<select class=input-medium id=\"street2\" name=\"street2\">";
if ($street2!="") {$choosestreet.="<option value=\"$street2\">$street2</option>"; }
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_num==0) {$streetsel=" selected"; if ($street2!="") {$streetsel="";}} else {$streetsel="";}

$choosestreet.="<option value=\"".$user_mass[0]."\"$streetsel>".$user_mass[0]."</option>";
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);
$choosestreet.="<option value=\"-\"></option></select>";
} else {$street2=""; $choosestreet="";}


if ($choosemetro!="") {$choosemetro="<script language=javascript><!--
function choosemetro() {
var newmetro=document.getElementById('metro2').value;
if (newmetro!='') {
if (newmetro=='x') {
document.getElementById('metro').value='...';
document.getElementById('metro').style.display = 'block';
document.getElementById('metro').style.visibility = 'visible';
} else {
document.getElementById('metro').value=document.getElementById('metro2').value;
document.getElementById('metro').style.display = 'none';
document.getElementById('metro').style.visibility = 'hidden';
}
}
}
-->
</script><select class=input-medium id=\"metro2\" onchange=\"javascript:choosemetro()\">".$choosemetro."<option value=\"\"></option><option value=\"x\">".$lang[475]."</option></select><i><b><a href=\"#1\" onClick=javascript:window.open('$htpath/$metrofile','metro','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=660,height=780,left=0,top=0')>".$lang[291]."</a></b></i> [".$lang['citys']."]"; $choosesp2="";}
$chooseme2="";
if ($country!="") {
if  ($portal!=1) {$choosecountry="<option value=\"\">".$lang[472]."</option><option>".$country."</option>"; } else {$choosecountry=""; $countsel=" selected";}
} else {$choosecountry=""; $countsel=" selected";}
if ($portal==1) { $chcf="custom_company.inc"; } else { $chcf="custom_country.inc";}
if (@file_exists("./templates/$template/$speek/$chcf")==TRUE) {
$user_arr=file ("./templates/$template/$speek/$chcf");
reset ($user_arr);
$cityes=Array();

while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);

if ($user_num==0) { if ($country=="") { $country=$user_mass[0];

$countsel="";} } else {$countsel="";}
if (count($user_arr)==1) { $user_mass=explode("|", $user_arr[0]); $country=$user_mass[0];$countsel="";$jscountr=""; $chids="$country<span class=hidden>"; }
if (isset($user_mass[1])) {
$choosecountr[]="<!-- ".$user_mass[1]." --><option value=\"".$user_mass[0]."\"$countsel>".$user_mass[1]."</option>";
if (@file_exists("./templates/$template/$speek/".@$user_mass[2].".inc")==TRUE) {
$cityind=$user_mass[0];
$citymass=file("./templates/$template/$speek/".$user_mass[2].".inc");
array_unique($citymass);
sort($citymass);
reset($citymass);
while (list ($city_num, $city_line) = each ($citymass)) {
$city_line=trim($city_line);
if ($city_line!="") {
if (isset($cityes[$cityind])) {$cityes[$cityind].="<option value=\"$city_line\">$city_line</option>\n";} else {$cityes[$cityind]="<option value=\"$city_line\">$city_line</option>\n";}
}
}
} else {
$cityind=$user_mass[0];

}
}
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);

$firstc=$choosecountr[0];
array_unique($choosecountr);
sort ($choosecountr);
reset($choosecountr);

$choosecountry.=$firstc."\n".str_replace($firstc, "", implode("\n", $choosecountr));

} else {$choosecountry="";}

$cities="";
unset($city_num, $city_line);
//array_unique($cityes);
//sort($cityes);
reset($cityes);
while (list ($city_num, $city_line) = each ($cityes)) {
$cities.="<select class=input-medium onchange=\"javascript:choosecity(this.value)\" style=\"display:none; visibility:hidden;\" id=\"$city_num\"><option value=\"$gorod\" selected>$gorod</option><option value=\"\">".$lang[471]."</option>$city_line<option value=\"\"></option><option value=\"x\">".$lang[474]."</option></select>";
}
if ($choosecountry!="") {$choosecountry="<script language=javascript>
<!--
function choosecountry() {
var curcountry=document.getElementById('country').value;
var newcountry=document.getElementById('country2').value;
//theobj1 = (document.nativeGetElementById)?document.getElementById(curcountry):document.all[curcountry];
//theobj2 = (document.nativeGetElementById)?document.getElementById(newcountry):document.all[newcountry];
if (newcountry!='') {
if (newcountry=='x') {
document.getElementById('country').value='...';
document.getElementById('city').style.display = 'inline';
document.getElementById('city').style.visibility = 'visible';
document.getElementById('city').value='...';
document.getElementById('country').style.display = 'inline';
document.getElementById('country').style.visibility = 'visible';
} else {
document.getElementById('country').value=document.getElementById('country2').value;
document.getElementById('country').style.display = 'none';
document.getElementById('country').style.visibility = 'hidden';
}
if (document.getElementById(''+curcountry)) {
document.getElementById(''+curcountry).style.display = 'none';
document.getElementById(''+curcountry).style.visibility = 'hidden';
}
if (document.getElementById(newcountry)) {
document.getElementById(newcountry).style.display = 'inline';
document.getElementById(newcountry).style.visibility = 'visible';
}else {
document.getElementById('city').style.display = 'inline';
document.getElementById('city').style.visibility = 'visible';
}

}
}
function choosecity(arg) {
if (arg!='') {
if (arg=='x') {
document.getElementById('city').style.display = 'inline';
document.getElementById('city').style.visibility = 'visible';
document.getElementById('city').value='...';
} else {
document.getElementById('city').style.display = 'none';
document.getElementById('city').style.visibility = 'hidden'
document.getElementById('city').value=arg;
}

}
}
-->
</script>$jscountr".$chids."<select class=input-medium id=\"country2\" onchange=\"javascript:choosecountry()\"><option value=\"$country\" selected>$country</option>".$choosecountry."<option value=\"\"></option><option value=\"x\">".$lang[473]."</option></select></span>"; $chooseme2="";}






$now = date("d.m.Y.D.H.i.s");
$mesac = array (
"01"        =>      $lang[115],
"02"        =>      $lang[116],
"03"        =>      $lang[117],
"04"        =>      $lang[118],
"05"        =>      $lang[119],
"06"        =>      $lang[120],
"07"        =>      $lang[121],
"08"        =>      $lang[122],
"09"        =>      $lang[123],
"10"        =>      $lang[124],
"11"        =>      $lang[125],
"12"        =>      $lang[126],
);
$nedel = array (
"Sun"        =>      $lang['Sun'],
"Mon"        =>      $lang['Mon'],
"Tue"        =>      $lang['Tue'],
"Wed"        =>      $lang['Wed'],
"Thu"        =>      $lang['Thu'],
"Fri"        =>      $lang['Fri'],
"Sat"        =>      $lang['Sat'],
);
$mass_now=explode ("." , $now);
$now = $mass_now[0] . " " . $mesac[$mass_now[1]] . " " . $mass_now[2] . " (" . $nedel[$mass_now[3]] . ") ".$lang[143].": " .  $mass_now[4] .":" . $mass_now[5] .":". $mass_now[6];
//wishlist










if (($wishlist!="") &&($details[1]!="")) {
if (($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/flag.txt")==FALSE)) {

$form_title=$lang[144];
$formout= "<br><div align=center><form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\">
<input type=\"hidden\" name=\"action\" value=\"send\"><input type=\"hidden\" name=\"nikn\" value=\"$nikn\">
<input type=\"hidden\" name=\"wishlist\" value=\"1\">
<input type=\"hidden\" name=\"old_action\" value=\"send\"><br><br>
<table border=0 style=\"border: 1px solid $nc4\" width=100%>
<tr><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"5\" width=100%>
  <tr>
    <td align=\"center\" bgcolor=\"".lighter($nc3,50)."\" colspan=\"2\" valign=\"top\"><b><font color=\"#000000\">Данные для совместного заказа:</font></b></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[74].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" width=70%><input type=\"text\" name=\"fio\" value=\"$fio\" size=\"45\" style=\"width:90%\">
    </td>
  <tr>
        <td valign=\"top\" align=\"center\" colspan=2><br><input class=btn type=\"submit\" class=\"btn btn-primary\" value=\"Добавить в совместный заказ\"><br><i>При нажатии этой кнопки содержимое Вашей корзины будет добавлено в совместный заказ. Обязательно Введите Ваше имя/НИК,e-mail и т.п., чтобы органзизатор (ОРГ) закупки мог понять, что этот заказ - Ваш.</i></td>
  </tr>
</table></td></tr></table>
</form></div><br>
";
} else {
$form_title="Оформление совместного заказа пока невозможно";
$formout= "<br><br><form method=\"POST\" action=\"".$_SERVER['PHP_SELF']."\">
<input type=\"hidden\" name=\"action\" value=\"zakaz\"><input type=\"hidden\" name=\"fio\" value=\"$fio\"><input type=\"hidden\" name=\"wishlist\" value=\"$wishlist\">
<font color=\"$nc3\"><b>".$lang[242]."</b></font>
<br><br><p align=center>
<input class=btn type=submit value=\"Попробовать снова\"></p></form>";
}

//if (@$details[1]!=""){
//require ("./modules/wishlist.php");
//}




} else {




if ((!@$gorod) || (@$gorod=="")): $gorod=$lang['citys']; endif;
if (isset($reg_as[$regid])) {$regas=strtoken($reg_as[$regid],"|").", ";} else {$regas="";}

//wishlist
if (($valid=="1")) {
if (!isset($wishzak)){$wishzak="";} if (!preg_match("/^[0-9]+$/",$wishzak)) { $wishzak="";}
if ($wishzak==1) { $formout=""; } else {
$formout="<br><br><table border=0 style=\"border: 1px solid $nc4\" cellpadding=5 cellspacing=5>
<tr><td>
<b>".$lang[211]."</b> У Вас есть возможность добавить выбранные позиции в совместный заказ.<br><br>
<div align=center><b>Для совместного заказа нажмите сюда:</b><br><br><form method=GET action=\"index.php\"><input type=hidden name=action value=zakaz><input type=hidden name=wishlist value=1><input type=hidden name=flag value=".$cart->basket_speek."><input class=btn type=submit value=\"Перейти к совместному заказу &gt;&gt;\"></form></div><br>
<i>Заказ будет проведен, когда лицо, ответственное за все Ваши заказы (ОРГ) примет решение его окончательно оформить.<br>
<br>Мы примем Вашу заявку и будем по возможности предупреждать Вашего организатора (ОРГа) совместных заказов о необходимости его окончательно оформить.</i>
</td></tr></table><br>";

if (($allow_one==1)&&($allow_complex==0)) {$formout="";}
if (($allow_one==0)&&($allow_complex==0)) {$formout="";}


}
} else {
$formout="<br><br>
<b>".$lang[211]."</b> У Вас есть возможность добавить выбранные позиции в совместный заказ, организованный ОРГом.<br>
Для этого Вы должны были получить необходимый логин и пароль и авторизироваться. <br>";
if (($allow_one==1)&&($allow_complex==0)) {$formout="";}
if (($allow_one==0)&&($allow_complex==0)) {$formout="";}
}
//wishlist

include ("antispam.php");
if ($agree=="ON") {$agchecked=" checked";} else {$agchecked="";}
$form_title=$lang[142];

if (isset($reg_as)) { if($setregid[$regid]>1) {$lang[61]=$lang[158];}}
if (isset($reg_as)) { if($setregid[$regid]>1) {$lang[71]=$lang[159];}}

$selectas="";
if (isset($reg_as[$regid])) {$selectas="<option value=\"".$regid."\" selected>".strtoken($reg_as[$regid],"|")."</option>\n"; $regas=strtoken($reg_as[$regid],"|").", ";} else {$selectas="<option value=\"".$regid."\" selected>".strtoken(@$reg_as[0],"|")."</option>\n"; $regas="";}





if (isset($reg_as)) {
$chooseregids="<form name=\"selectform\"><input type=\"hidden\" name=\"action\" value=\"zakaz\">
<input type=\"hidden\" name=\"wishzak\" value=\"$wishzak\">
<input type=\"hidden\" name=\"nikn\" value=\"$nikn\">
<input type=\"hidden\" name=\"prop\" value=\"$prop\">
<input type=\"hidden\" name=\"step\" value=\"2\">
<select class=input-medium name=\"regid\" onchange=\"javascript:document.selectform.submit()\">$selectas";
while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if(($srmasss[1]!=0)&&($srrnum!=$regid)) {
$chooseregids.="<option value=\"".$srrnum."\">".$srmasss[0]."</option>";
}
unset ($srmasss);
}
}
$chooseregids.="</select></form>";
reset ($reg_as);
}

$reg_forms="";
$reg_forms1= "<script type=\"text/javascript\">
if (/msie/i.test (navigator.userAgent)) //only override IE
{
	document.nativeGetElementById = document.getElementById;
	document.getElementById = function(id)
	{
		var elem = document.nativeGetElementById(id);
		if(elem)
		{
			//make sure that it is a valid match on id
			if(elem.attributes['id'].value == id)
			{
				return elem;
			}
			else
			{
				//otherwise find the correct element
				for(var i=1;i<document.all[id].length;i++)
				{
					if(document.all[id][i].attributes['id'].value == id)
					{
						return document.all[id][i];
					}
				}
			}
		}
		return null;
	};
}
</script>
<div class=round3 align=left><font size=3 color=\"$nc5\"><i class=icon-user></i> ".$lang[108]."</font></div>

";
$tmp=explode("\n", $selectas);
if ( count($reg_as)>1) {
$reg_forms1.="<table class=table border=\"0\" width=\"100%\" style=\"margin-bottom:0px;\">
<tr><td align=\"right\" width=30%><b>".$lang[288]."</b></td><td colspan=\"2\" width=70%>
$chooseregids
</td></tr></table>";
}
$reg_forms1.="<form method=\"POST\" action=\"$htpath/index.php\">
<input type=\"hidden\" name=\"action\" value=\"send\">
<input type=\"hidden\" name=\"wishzak\" value=\"$wishzak\">
<input type=\"hidden\" name=\"nikn\" value=\"$nikn\">
<input type=\"hidden\" name=\"old_action\" value=\"send\">
<input type=\"hidden\" name=\"regid\" value=\"$regid\">
<input type=\"hidden\" name=\"prop\" value=\"$regid\">
<input type=\"hidden\" name=\"step\" value=\"2\">
";
if ("$valid"!="1") {
$reg_forms1.="<table class=table border=\"0\" width=\"100%\"><tr><td colspan=2><i><a href=$htpath/index.php?action=restore style=\"border-bottom: 2px dotted $nc3;\">".$lang[110]."</a></i> ".$lang[111]."</td></tr>";
}
$reg_forms1.="<table class=table border=\"0\" width=\"100%\">
";

$reg_forms2="";
$reg_formsb="";
if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);
$fuserm=0;
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if ($user_mass[6]=="") {
$cl="";
if ($action=="cabinet") {  if (($user_mass[7]=="week")||($user_mass[7]=="day")||($user_mass[7]=="month")||($user_mass[7]=="year")) {$cl=" class=hidden";  } else { $cl=""; } }
$reg_forms2.="
  <tr".$cl.">
    <td align=\"right\" valign=\"top\" width=30%><b>".$user_mass[0].":<font size=4 color=\"$nc3\">";
if ($user_mass[4]==1) { $reg_forms2.="*";}
$reg_forms2.="</font></b></td>
<td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\">";
if ($user_mass[2]=="select") {
$reg_forms2.="<select class=input-medium name=\"fm[$fuserm]\"><option>";
}
if ($user_mass[2]=="textarea") {
$reg_forms2.="<textarea rows=\"".$user_mass[3]."\" cols=48 style=\"width:90%\" name=\"fm[$fuserm]\">";
}
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_forms2.="<input type=\"".$user_mass[2]."\" size=\"".$user_mass[3]."\" style=\"width:90%\" value=\"";
}

if ((!isset($fm[$fuserm]))&&(!preg_match("/^[ёЁа-яА-Яa-zA-Z0-9:\@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",@$fm[$fuserm]))) { } else {
@$details[(20+$fuserm)]=$fm[$fuserm];
}
if ((isset($details[(20+$fuserm)])==FALSE)||(!preg_match("/^[ёЁа-яА-Яa-zA-Z0-9:\@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",@$details[(20+$fuserm)]))) {
@$details[(20+$fuserm)]="-";
}
if ($user_mass[2]!="radio") {
$reg_forms2.=@$details[(20+$fuserm)]; }
if ($user_mass[2]=="select") {
$reg_forms2.="</option>";
if (($user_mass[7]=="week")||($user_mass[7]=="day")||($user_mass[7]=="month")||($user_mass[7]=="year")) {
$cl="";
$iter=7;  $hours=24; $stamp="d.m.Y"; $curt=time(); $dob=""; //week
if ($user_mass[7]=="day") { $iter=24;  $hours=1; $stamp="H"; $curt=time(); $dob=":00";}
if ($user_mass[7]=="month") { $iter=31;  $hours=24; $stamp="d.m.Y"; $curt=time(); $dob=""; }
if ($user_mass[7]=="year") { $iter=365;  $hours=24; $stamp="d.m.Y"; $curt=time(); $dob=""; }
$sel=" selected";
$it=0;
while ($it<=$iter) {
$dw=date("w",($curt+$it*60*60*$hours));
if (($dw==0) || ($dw==6)) {$cl=" style=\"color:red;\"";} else { $cl=""; }
$reg_forms2.="<option".$cl.">".date($stamp,($curt+$it*60*60*$hours))."$dob</option>";
$sel="";
$it++;
}
} else {
$tmp=explode("^", $user_mass[7]);
$sel=" selected";
while (list($kk,$vv)=each($tmp)) {
$reg_forms2.="<option value=\"".$vv."\">".$vv."</option>";
$sel="";
}
}
$reg_forms2.="</select>";
}
if ($user_mass[2]=="radio") {
$tmp=explode("^", $user_mass[7]);
$sel=" checked=\"checked\"";
while (list($kk,$vv)=each($tmp)) {
$reg_forms2.="<span style=\"white-space:nowrap;\"><input type=radio name=\"fm[$fuserm]\"".$sel." value=\"".$vv."\" id=radio_".translit($vv)."><label for=\"radio_".translit($vv)."\">$vv</label></span>\n";
$sel="";
}
}
if ($user_mass[2]=="textarea") {
$reg_forms2.="</textarea>"; }
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_forms2.="\" name=\"fm[$fuserm]\" onkeyup=\"document.getElementById('c".$fuserm."').style.visibility='hidden';\">"; }
$reg_forms2.="<span id=c".$fuserm.">".@$ee[$fuserm]."</span><br><small><i><font style=\"color:".lighter($nc6,-40).";\">".$user_mass[1]."</font></i></small></td>
  </tr>";
$fuserm+=1;



} else {

$cl=" class=hidden";
if ($action=="cabinet") {  if (($user_mass[7]=="week")||($user_mass[7]=="day")||($user_mass[7]=="month")||($user_mass[7]=="year")) {$cl=" class=hidden";  } else { $cl=""; } }
if ((isset($details[(20+$fuserm)])==FALSE)||(!preg_match("/^[ёЁа-яА-Яa-zA-Z0-9:\@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",@$details[(20+$fuserm)]))) { $cl=""; }
if (@$ee[$fuserm]!="") { $cl=""; }

$reg_formsb.="
  <tr".$cl.">
    <td align=\"right\" valign=\"top\" width=30%><b>".$user_mass[0].":<font size=4 color=\"$nc3\">";
if ($user_mass[4]==1) { $reg_formsb.="*";}
$reg_formsb.="</font></b></td>
<td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\">";
if ($user_mass[2]=="select") {
$reg_formsb.="<select class=input-medium name=\"fm[$fuserm]\"><option selected>";
}
if ($user_mass[2]=="textarea") {
$reg_formsb.="<textarea rows=\"".$user_mass[3]."\" cols=48 style=\"width:90%\" name=\"fm[$fuserm]\">";
}
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_formsb.="<input type=\"".$user_mass[2]."\" size=\"".$user_mass[3]."\" style=\"width:90%\" value=\"";
}
if ((!isset($fm[$fuserm]))&&(!preg_match("/^[ёЁа-яА-Яa-zA-Z0-9:\@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",@$fm[$fuserm]))) { } else {
@$details[(20+$fuserm)]=$fm[$fuserm];
}
if ((isset($details[(20+$fuserm)])==FALSE)||(!preg_match("/^[ёЁа-яА-Яa-zA-Z0-9:\@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",@$details[(20+$fuserm)]))) {
@$details[(20+$fuserm)]="-";
}
if ($user_mass[2]!="radio") {
$reg_formsb.=@$details[(20+$fuserm)]; }
if ($user_mass[2]=="select") {
$reg_formsb.="</option>";
if (($user_mass[7]=="week")||($user_mass[7]=="day")||($user_mass[7]=="month")||($user_mass[7]=="year")) {
$cl="";
$iter=7;  $hours=24; $stamp="d.m.Y"; $curt=time(); $dob=""; //week
if ($user_mass[7]=="day") { $iter=24;  $hours=1; $stamp="H"; $curt=time(); $dob=":00";}
if ($user_mass[7]=="month") { $iter=31;  $hours=24; $stamp="d.m.Y"; $curt=time(); $dob=""; }
if ($user_mass[7]=="year") { $iter=365;  $hours=24; $stamp="d.m.Y"; $curt=time(); $dob=""; }
$sel=" selected";
$it=0;
while ($it<=$iter) {
$dw=date("w",($curt+$it*60*60*$hours));
if (($dw==0) || ($dw==6)) {$cl=" style=\"color:red;\"";} else { $cl=""; }
$reg_formsb.="<option".$cl.">".date($stamp,($curt+$it*60*60*$hours))."$dob</option>";
$sel="";
$it++;
}
} else {
$tmp=explode("^", $user_mass[7]);
$sel=" selected";
while (list($kk,$vv)=each($tmp)) {
$reg_formsb.="<option value=\"".$vv."\">".$vv."</option>";
$sel="";
}
}
$reg_formsb.="</select>";
}
if ($user_mass[2]=="radio") {
$tmp=explode("^", $user_mass[7]);
$sel=" checked=\"checked\"";
while (list($kk,$vv)=each($tmp)) {
$reg_formsb.="<span style=\"white-space:nowrap;\"><input type=radio name=\"fm[$fuserm]\"".$sel." value=\"".$vv."\" id=radio_".translit($vv)."><label for=\"radio_".translit($vv)."\">$vv</label></span>\n";
$sel="";
}
}
if ($user_mass[2]=="textarea") {
$reg_formsb.="</textarea>"; }
if (($user_mass[2]=="")||($user_mass[2]=="text")) {
$reg_formsb.="\" name=\"fm[$fuserm]\" onkeyup=\"document.getElementById('c".$fuserm."').style.visibility='hidden';\">"; }
$reg_formsb.="<span id=c".$fuserm.">".@$ee[$fuserm]."</span><br><small><i><font style=\"color:".lighter($nc6,-40).";\">".$user_mass[1]."</font></i></small></td>
  </tr>";
$fuserm+=1;
}
}
}
}

if ($action!="cabinet") {
$oldhouse=$house;
$oldmetro=$metro;
$oldstreet=$street;
}

//if ($action!="cabinet") { if ($regid!=$prop) { $metro=""; $house=""; $street="";} }
if ($smod=="site") { $reg_forms3= "
<input type=\"hidden\" id=\"country\" name=\"country\" value=\"$country\">
<input id=\"city\" type=\"hidden\" name=\"gorod\" value=\"$gorod\">
<input type=\"hidden\" id=\"metro\" name=\"metro\" value=\"-\">
<input type=\"hidden\" id=\"metro2\" name=\"metro2\" value=\"-\">
<input type=\"hidden\" name=\"house\" value=\"-\">
<input type=\"hidden\" name=\"korp\" value=\"\">
<input type=\"hidden\" name=\"pod\" value=\"\">
<input type=\"hidden\" name=\"domophone\" value=\"\">
<input type=\"hidden\" name=\"ofice\" value=\"-\">
<input type=\"hidden\" name=\"flat\" value=\"\">
<input type=\"hidden\" name=\"street\" value=\"-\">
"; } else {
$reg_forms3= "<div><div class=round3><font size=3 color=\"$nc5\"><i class=icon-map-marker></i> ".$lang[156]."</font></div>
<table class=table border=\"0\" width=\"100%\">
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[167].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70% style=\"white-space:nowrap;\">".$choosecountry."<input type=\"text\" id=\"country\" name=\"country\" value=\"$country\" size=\"30\" class=hidden><span id=e4>$e4</span>".$chooseme2."</td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[72].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70% style=\"white-space:nowrap;\">$cities<input id=\"city\" type=\"text\" name=\"gorod\" value=\"$gorod\" size=\"30\" onkeyup=\"document.getElementById('e5').style.visibility='hidden';\"><span id=e5>$e5</span></td>
  </tr>";

if ($view_metro==1) { $reg_forms3.= "<tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[61].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>".$choosemetro."<input type=\"text\" id=\"metro\" name=\"metro\" value=\"$metro\" size=\"30\" class=hidden><span id=e6>$e6</span>".$choosesp2."</td>
  </tr>";  } else {
   $reg_forms3.= "<input type=\"hidden\" id=\"metro\" name=\"metro\"  value=\"-\"><input type=\"hidden\" id=\"metro2\" name=\"metro2\" value=\"-\">";
  }

$reg_forms3.= "<tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[71].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>$choosestreet<input type=\"text\" name=\"street\" value=\"".str_replace("^", "", $street)."\" size=\"45\" style=\"width:90%\" onkeyup=\"document.getElementById('e7').style.visibility='hidden';\"><span id=e7>$e7</span></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[68].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"house\" value=\"$house\" size=\"20\" style=\"width:10%\" onkeyup=\"document.getElementById('e8').style.visibility='hidden';\"><span id=e8>$e8</span></td>
  </tr>";
if (isset($lang[67]))  {if ($lang[67]!="") {$reg_forms3.= "  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[67].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"korp\" value=\"$korp\" size=\"20\" style=\"width:10%\"></td>
  </tr>
";}}
if (isset($lang[66])) { if ($lang[66]!="") {$reg_forms3.= "  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[66].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"pod\" value=\"$pod\" size=\"20\" style=\"width:10%\"></td>
  </tr>";
  }}
if (isset($lang[69])) { if ($lang[69]!="") {$reg_forms3.= "   <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[69].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"domophone\" value=\"$domophone\" size=\"20\" style=\"width:10%\"></td>
  </tr>
";
}}
if (isset($lang[65])) { if ($lang[65]!="") {$reg_forms3.= "     <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[65].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"ofice\" value=\"$ofice\" size=\"20\" style=\"width:10%\" onkeyup=\"document.getElementById('e9').style.visibility='hidden';\"><span id=e9>$e9</span></td>
  </tr>
  <tr>
";
} else {$reg_forms3.= "<input type=\"hidden\" name=\"ofice\" value=\"-\">";} } else {$reg_forms3.= "<input type=\"hidden\" name=\"ofice\" value=\"-\">"; }
if (isset($lang[64])) { if ($lang[64]!="") {$reg_forms3.= "  <td align=\"right\" valign=\"top\" width=30%><b>".$lang[64].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" name=\"flat\" value=\"$flat\" size=\"20\" style=\"width:10%\"></td>
  </tr>
";
}}}
if ($action!="cabinet") {
$house=$oldhouse;
$metro=$oldmetro;
$street=$oldstreet;
}


$choosepr="";
if (isset($property_mode)) {
if ($portal!=1) {
$choosepr="<select class=input-small name=\"house\">";
if (isset($property_mode[$house])) {$choosepr.="<option selected value=\"".$house."\">".strtoken($property_mode[$house],"|")."</option>";}

while (list ($rrnum, $rrline) = each ($property_mode)) {
if ((trim($rrline)!="")&&(trim($rrline)!="\n")) {
$srmass=explode("|",$rrline);
if($srmass[1]!=0) {
$choosepr.="<option value=\"".$rrnum."\">".$srmass[0]."</option>";
$fregid+=1;
}
}
}
$choosepr.="</select>";
} else {
$choosepr="<input type=hidden value=\"-\" name=\"house\">";
}
}
if ($action!="cabinet") {
$oldhouse=$house;
$oldmetro=$metro;
$oldstreet=$street;
}

if ($action!="cabinet") { if ($regid!=$prop) { $metro=""; $house=""; $street="";}}

$reg_forms4= "
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[158].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" style=\"white-space:nowrap;\" width=70%>$choosepr";
 if ($portal!=1) {
 $reg_forms4.="<input type=\"text\" name=\"metro\" value=\"$metro\" size=\"40\" placeholder=\"".$lang[158]."\">";
 } else {
 if ($metro=="") { $metro=$portal_company; }
  $reg_forms4.="<input type=\"text\" name=\"metro\" style=\"width: 90%\" value=\"$metro\" size=\"40\" readonly=\"readonly\">";
 }
    $reg_forms4.="<span id=e6>$e6</span>
<input type=\"hidden\" name=\"korp\" value=\"\">
<input type=\"hidden\" name=\"pod\" value=\"\">
<input type=\"hidden\" name=\"domophone\" value=\"\">
<input type=\"hidden\" name=\"flat\" value=\"\">
<input type=\"hidden\" name=\"street\" value=\"-\">
<input type=\"hidden\" id=\"metro2\" name=\"metro2\" value=\"-\">
";
 if ($portal==1) {
$reg_forms4.="
<input type=\"hidden\" name=\"ofice\" value=\"-\">
";
}
$reg_forms4.="
</td>
  </tr>";
   if ($portal!=1) {
$reg_forms4.="    <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[1166].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" id=\"ofice\" name=\"ofice\" value=\"$ofice\" size=\"30\" style=\"width:90%\" onkeyup=\"document.getElementById('e9').style.visibility='hidden';\"><span id=e9>$e9</span></td>
  </tr>

";
}
$reg_forms4.="<tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[167].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70% style=\"white-space:nowrap;\">".$choosecountry."<input type=\"text\" id=\"country\" name=\"country\" value=\"$country\" size=\"30\" class=hidden><span id=e4>$e4</span>".$chooseme2."</td>
  </tr>
   <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[72].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70% style=\"white-space:nowrap;\">$cities<input id=\"city\" type=\"text\" name=\"gorod\" value=\"$gorod\" size=\"30\" onkeyup=\"document.getElementById('e5').style.visibility='hidden';\"><span id=e5>$e5</span></td></tr>


";
if ($action!="cabinet") {
$house=$oldhouse;
$metro=$oldmetro;
$street=$oldstreet;
}


$reg_forms7= "<tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[167].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70% style=\"white-space:nowrap;\">".$choosecountry."<input type=\"text\" id=\"country\" name=\"country\" value=\"$country\" size=\"30\" class=hidden><span id=e4>$e4</span>".$chooseme2."</td>
  </tr>
   <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[72].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70% style=\"white-space:nowrap;\">$cities<input id=\"city\" type=\"text\" name=\"gorod\" value=\"$gorod\" size=\"30\" onkeyup=\"document.getElementById('e5').style.visibility='hidden';\"><span id=e5>$e5</span>
<input type=\"hidden\" name=\"house\" value=\"-\">
<input type=\"hidden\" name=\"korp\" value=\"\">
<input type=\"hidden\" name=\"pod\" value=\"\">
<input type=\"hidden\" name=\"domophone\" value=\"\">
<input type=\"hidden\" name=\"street\" value=\"-\">
<input type=\"hidden\" name=\"flat\" value=\"\">
<input type=\"hidden\" id=\"metro2\" name=\"metro2\" value=\"-\"></td></tr>
<tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[966].":<font size=4 color=\"$nc3\">*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" id=\"metro\" name=\"metro\" value=\"$metro\" size=\"30\" style=\"width: 90%\"></td>
  </tr>
    <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[1166].":<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" id=\"ofice\" name=\"ofice\" value=\"$ofice\" size=\"30\" style=\"width:90%\" onkeyup=\"document.getElementById('e9').style.visibility='hidden';\"><span id=e9>$e9</span></td>
  </tr>
";

$reg_forms5="  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[74].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>
        <input type=\"text\" name=\"fio\" value=\"$fio\" size=\"45\" style=\"width:90%\" onkeyup=\"document.getElementById('e13').style.visibility='hidden';\"><span id=e13>$e13</span>
    </td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>E-mail:<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\" value=\"$email\" name=\"email\" size=\"45\" style=\"width:90%\" onkeyup=\"document.getElementById('e10').style.visibility='hidden';\"><span id=e10>$e10</span></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[73].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input class=\"input-mini\" type=\"text\" value=\"$telcode\" name=\"telcode\" size=\"10\" onkeyup=\"document.getElementById('e11').style.visibility='hidden';\" placeholder=\"".$lang[157]."\"><span id=e11>$e11</span>&nbsp;&nbsp;<input type=text value=\"$tel\" name=\"tel\" size=\"45\" onkeyup=\"document.getElementById('e12').style.visibility='hidden';\" placeholder=\"".$lang[73]."\"><span id=e12>$e12</span></td>
  </tr>
  ";
$reg_forms6="  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[74].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>
        <input type=\"text\" name=\"fio\" value=\"$fio\" size=\"45\" style=\"width:90%\" onkeyup=\"document.getElementById('e13').style.visibility='hidden';\"><span id=e13>$e13</span>
    </td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>E-mail:<font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input type=\"text\"  value=\"$email\" name=\"email\" size=\"45\" style=\"width:90%\" onkeyup=\"document.getElementById('e10').style.visibility='hidden';\"><span id=e10>$e10</span></td>
  </tr>
  <tr>
    <td align=\"right\" valign=\"top\" style=\"white-space:nowrap;\" width=30%><b>".$lang[73].": <font color=\"$nc3\" size=4>*</font></b></td>
    <td valign=\"top\" colspan=\"2\" width=70%><input class=input-mini type=\"text\" value=\"$telcode\" name=\"telcode\" size=\"10\" onkeyup=\"document.getElementById('e11').style.visibility='hidden';\" placeholder=\"".$lang[157]."\"><span id=e11>$e11</span>&nbsp;&nbsp;<input type=\"text\" value=\"$tel\" name=\"tel\" size=\"45\" onkeyup=\"document.getElementById('e12').style.visibility='hidden';\" placeholder=\"".$lang[73]."\"><span id=e12>$e12</span></td>
  </tr>
  ";








$reg_forms8="<tr>
    <td width=\"100%\" align=\"center\" valign=\"top\" colspan=\"3\">$agreem
      <p align=\"center\"><br><input type=\"checkbox\" name=\"agree\" value=\"ON\"$agchecked> ".$lang[80]."<br><br>";
$reg_forms81="<tr>
    <td width=\"100%\" align=\"center\" valign=\"top\" colspan=\"3\">$agreem
      <p align=\"center\"><br><input type=\"hidden\" name=\"agree\" value=\"ON\">";

if (!isset($view_agreement)) {} else {if ($view_agreement==0) {$reg_forms8=$reg_forms81;}}

$reg_forms82= "<table border=0 cellspacing=5><tr><td><b>".$lang[83].":<font color=\"$nc3\" size=4>*</font></b></td>";


if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")) {$reg_forms82.="<br>".substr(intval($rand_num*23-4),0,4);  } else {$reg_forms82.="<img src=\"textimg.php?textwww=$rand_num\" border=0>"; }

$reg_forms82.="<td> &gt;&gt; </td><td><input type=\"text\" name=\"antispam\" size=4></td><td>(".$lang[84].")<input name=\"md5num\" type=\"hidden\" value=\"$md5_num\"></td></tr></table>";
$reg_forms83="<input type=\"hidden\" name=\"antispam\" size=4 value=\"".substr(intval($rand_num*23-4),0,4)."\"><input name=\"md5num\" type=\"hidden\" value=\"$md5_num\">";

if (!isset($view_checkout_antispam)) {$reg_forms8.=$reg_forms83; } else {if ($view_checkout_antispam==0) {$reg_forms8.=$reg_forms83;} else {$reg_forms8.=$reg_forms82;}}

if (($minimal_order_not_available==1)&&($summa<$currencies_minimal_order[$_SESSION["user_currency"]])) { $reg_forms8.= "<div class=round3>$lang[1009] <b>".$currencies_minimal_order[$_SESSION["user_currency"]]."</b> ".$currencies_sign[$_SESSION["user_currency"]]."</div>";} else { $reg_forms8.="<div align=center><input type=\"submit\" class=\"btn btn-primary btn-large\" value=\"".$lang[145]."\"></div><br>".$lang[82]."</form><br>"; }
if (($allow_complex==1)&&($details[$user_pass_complex]!="")) {
$reg_forms8.="<br><br><form class=form-inline action=index.php method=GET><input type=hidden name=\"zak\" value=\"wishlist\"><input class=btn type=\"submit\" class=\"btn btn-primary\" value=\"Вернуть заказ на стадию редактирования\"></form><br><br>";
}
$reg_forms8.="</td>
  </tr>
</table>
<script language=javascript>
<!--
var curcountry=document.getElementById('country').value;
if (document.getElementById(''+curcountry)) {
document.getElementById(''+curcountry).style.display = 'inline';
document.getElementById(''+curcountry).style.visibility = 'visible';
}
if (document.getElementById('country').value==document.getElementById('country2').value) {
//document.getElementById('country').style.display = 'none';
document.getElementById('country').style.visibility = 'hidden';
}
if ((document.getElementById(''+curcountry))&&(document.getElementById('city'))) {
if (document.getElementById('city').value==document.getElementById(''+curcountry).value) {
document.getElementById('city').style.display = 'none';
document.getElementById('city').style.visibility = 'hidden';
}
}

";

if ($view_metro==1) { $reg_forms8.="if (document.getElementById('metro')) {
if (document.getElementById('metro').value==document.getElementById('metro2').value) {
document.getElementById('metro').style.display = 'none';
document.getElementById('metro').style.visibility = 'hidden';
}
}
";
}
$reg_forms8.="-->
</script>
";
//if ($setregid[$regid]>1) {$lang[63]="";}
if ($smod=="site") { $submit_forms="<input type=hidden name=\"other\" value=\"\">"; } else {
$submit_forms="  <tr>
    <td align=\"right\" valign=\"top\" width=30%><b>".$lang[28].":</b></td>
    <td valign=\"top\" colspan=\"2\" width=70%>
           <textarea rows=\"4\" name=\"other\" cols=\"44\" style=\"width:90%\">$other</textarea>
           <br><small><i><font style=\"color:".lighter($nc6,-40).";\">".$lang[63]."</font></i></small></td>
  </tr>
";
}



$fregid=0;
$chooseregid="";
$chkr=" checked";
if (isset($reg_as[$ffregid])) { if ($ffregid=="") { $chkr=" checked";} else {$chkr="";} } else {$chkr="";}
if ($details[1]=="") {$chkr=" checked";}
if (isset($reg_as)) {
while (list ($rrnum, $rrline) = each ($reg_as)) {
if (($rrline!="")&&($rrline!="\n")) {
$srmass=explode("|",$rrline);
if($srmass[1]!=0) {
if (isset($reg_as[$ffregid])) { if ($ffregid==$regid) {$chkr =" checked";}}
$chooseregid.="<p><input type=\"radio\" value=\"".$rrnum."\"$chkr name=\"regid\">".$srmass[0]."</p>";
$chkr="";
$fregid+=1;
}
}
}
if (($setregid[$regid]>2)&&($step==1)) {
$reg_form="
<script language=\"javascript\">
<!--
function registerform() {
document.forms['regform'].register.value=1;
document.forms['regform'].action.value='';
document.forms['regform'].submit();
}
-->
</script>
<form id=\"regform\" name=\"regform\" method=\"POST\" action=\"$htpath/index.php\">
<input type=\"hidden\" id=\"actions\" name=\"action\" value=\"zakaz\">
<input type=\"hidden\" name=\"step\" value=\"2\"><input type=\"hidden\" id=\"regist\" name=\"register\" value=\"\">
<div class=round3 align=center><b><font size=2 color=\"$nc5\">".$lang[462]."</font></b></div>
<table class=table border=\"0\" width=\"100%\">
  <tr>
    <td valign=\"top\" align=center width=100%><table class=table border=0><tr><td>".$chooseregid."</td></tr></table>
</td>
  </tr><tr>
    <td colspan=\"2\" valign=\"top\" align=center>";
if ($details[1]=="") {$reg_form.="<class=button type=\"button\" value=\"".$lang[39]."\" onclick='javascript:registerform();'> &nbsp; "; }
    $reg_form.="<input class=btn type=\"submit\" class=\"btn btn-primary\" value=\"";
if ($details[1]=="") {$reg_form.=$lang[290]; } else {$reg_form.=$lang[289];}

$reg_form.=" &gt;&gt; \"></form>";
if ($details[1]=="") {$reg_form.="<br><br>".$lang['regtext'];}
$reg_form.="</td>
  </tr>
</table>
";
} else {
if (($step==2)&&($setregid[$regid]>1)) {
if ($setregid[$regid]==2) {
$reg_form=$reg_forms1.$reg_forms4.$reg_forms6.$reg_formsb.$reg_forms2.$formpayment.$formdelivery.$submit_forms.$form_totals.$reg_forms8;
} else {
$reg_form=$reg_forms1.$reg_forms7.$reg_forms6.$reg_formsb.$reg_forms2.$formpayment.$formdelivery.$submit_forms.$form_totals.$reg_forms8;
}
} else {
$reg_form="<script>
function Gostep(id) {
document.getElementById('steps'+id).className='active';
document.getElementById('step'+id).className='pull-left stepsa mr';
if (id!=1) {document.getElementById('steps'+1).className='hidden'; document.getElementById('step'+1).className='pull-left steps mr'; }
if (id!=2) {document.getElementById('steps'+2).className='hidden'; document.getElementById('step'+2).className='pull-left steps mr'; }
if (id!=3) {document.getElementById('steps'+3).className='hidden'; document.getElementById('step'+3).className='pull-left steps mr'; }
if (id!=4) {document.getElementById('steps'+4).className='hidden'; document.getElementById('step'+4).className='pull-left steps mr'; }
if (id!=5) {document.getElementById('steps'+5).className='hidden'; document.getElementById('step'+5).className='pull-left steps mr'; }
}
</script>
<div style=\"border-bottom: $nc3 solid 4px; margin-bottom: 20px; margin-top:20px;\">
<div id=step1 class=\"pull-left stepsa mr\" onclick=Gostep(1);>".$lang[1644]."1<br><small>".$lang[1645]."</small></div>
<div id=step2 class=\"pull-left steps mr\" onclick=Gostep(2);>".$lang[1644]."2<br><small>".$lang[1646]."</small></div>
<div id=step3 class=\"pull-left steps mr\" onclick=Gostep(3);>".$lang[1644]."3<br><small>".$lang[1647]."</small></div>
<div id=step4 class=\"pull-left steps mr\" onclick=Gostep(4);>".$lang[1644]."4<br><small>".$lang[1648]."</small></div>
<div id=step5 class=\"pull-left steps mr\" onclick=Gostep(5);>".$lang[1644]."5<br><small>".$lang[1650]."</small></div>
<div class=clearfix></div></div>
<div class=\"\" id=steps1>".$reg_forms1.$reg_forms5.$reg_forms2.$reg_formsb."</table>
<div align=center><a href=#top class=btn onclick=Gostep(2);>$lang[1646] <i class=icon-chevron-right></i></a></div>
</div>
<div class=\"hidden\" id=steps2><table class=table2 width=100%>".$reg_forms3."</table>
<div align=center><a href=#top class=btn onclick=Gostep(1);><i class=icon-chevron-left></i> $lang[1645]</a> &nbsp; <a href=#top class=btn onclick=Gostep(3);>$lang[1647] <i class=icon-chevron-right></i></a></div>
</div>
<div class=\"hidden\" id=steps3><table class=table width=100%>".$formpayment."</table>
<div align=center><a href=#top class=btn onclick=Gostep(2);><i class=icon-chevron-left></i> $lang[1646]</a> &nbsp; <a href=#top class=btn onclick=Gostep(4);>$lang[1648] <i class=icon-chevron-right></i></a></div>
</div>
<div class=\"hidden\" id=steps4><table class=table width=100%>".$formdelivery."</table>
<div align=center><a href=#top class=btn onclick=Gostep(3);><i class=icon-chevron-left></i> $lang[1647]</a> &nbsp; <a href=#top class=btn onclick=Gostep(5);>$lang[1650] <i class=icon-chevron-right></i></a></div>
</div>
<div class=\"hidden\" id=steps5><table class=table width=100%>".$submit_forms.$reg_forms8."
<div align=center><a href=#top class=btn onclick=Gostep(4);><i class=icon-chevron-left></i> $lang[1648]</a></div>
</div>
<table class=table2 width=100%>".$form_totals."</table>
";
}
}
} else {


$reg_form=$reg_forms1.$reg_forms5.$reg_formsb.$reg_forms2.$reg_forms3.$formpayment.$formdelivery.$submit_forms.$form_totals.$reg_forms8;
}



//wishlist
}


if ($regid==1) {$formlist="<div style=\"background: url('images/flowers.png') left 50px no-repeat;\">".$formlist;} else {$formlis="";}
$formlist.=$social_auth.$formout.$reg_form;
if ($regid==1) {$formlist.="</div>";}

}
//wishlist
?>
