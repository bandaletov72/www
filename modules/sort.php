<?php
$sortecho=="";
if (($okr=="")||($okr==0)) {$okr=0.01;}
if ($action!="ext_search") {$hidaction=""; $params="";}
if (@file_exists("./admin/search/".$podstava["$r|$sub|"].".txt")) {
$cse=fopen("./admin/search/".$podstava["$r|$sub|"].".txt", "r");
$customsearch=fgets($cse, filesize("./admin/search/".$podstava["$r|$sub|"].".txt"));

fclose($cse);  } else { $customsearch="";  }
$fromarray1="";
while (list ($keymar, $valmar) = each ($fromarray)) {
$fromarray1.="<option value=\"".($okr*round(($valmar*$kurs)/$okr))."\">".$lang[99]." ".($okr*round(($valmar*$kurs)/$okr))."".$currencies_sign[$_SESSION["user_currency"]]."</option>";
}
$toarray1="";
while (list ($keymar, $valmar) = each ($toarray)) {
$toarray1.="<option value=\"".($okr*round(($valmar*$kurs)/$okr))."\">".$lang[100]." ".($okr*round(($valmar*$kurs)/$okr))."".$currencies_sign[$_SESSION["user_currency"]]."</option>";
}

if ($pricedo=="$maximumprice") {$dopricedo="-";} else {$dopricedo="".$lang[100]." $pricedo".$currencies_sign[$_SESSION["user_currency"]]."";}
if (doubleval($priceot)==0) {$dopriceot="-";} else {$dopriceot="".$lang[99]." $priceot".$currencies_sign[$_SESSION["user_currency"]]."";}
$sortecho = "<div style=\"margin-bottom: 10px;\"><div class=pull-left>
<font face=Arial style=\"font-size: 9pt;\"><i class=icon-signal></i>&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?sorting=price&way=$way&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\"$op1>".str_replace(" ", "&nbsp;", $lang['by_price'])."</a>&nbsp;<img src=\"$image_path/hr.gif\"> <a href=\"".$_SERVER['PHP_SELF']."?sorting=name&way=$way&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\"$op2>".str_replace(" ", "&nbsp;", $lang['by_name'])."</a>&nbsp;<img src=\"$image_path/hr.gif\"> <a href=\"".$_SERVER['PHP_SELF']."?sorting=date&way=$way&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\"$op3>".str_replace(" ", "&nbsp;", $lang['by_date'])."</a>";
if ($view_comments==1) {$sortecho.="&nbsp;<img src=\"$image_path/hr.gif\"> <a href=\"".$_SERVER['PHP_SELF']."?sorting=rate&way=$way&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\"$op6>".str_replace(" ", "&nbsp;", $lang[685])."</a>";}
//if ($stinfo=="int") {$sortecho.="<option value=\"pcs\">".$lang['by_pcs']."</option>";}
$sortecho.="</font></div>";
if ($view_listing_variants==1) { $sortecho.="<div class=pull-right style=\"white-space: nowrap; margin-left: 20px;\"><a href=\"index.php?ltype=1&sorting=$sorting&way=$way&start=$start&perpage=$perpage&brand=".rawurlencode($brand)."&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\" title=\"".$lang[424]."\"><i class=icon-th-list$styl1></i></a> <a href=\"index.php?ltype=2&start=$start&perpage=$perpage&brand=".rawurlencode($brand)."&sorting=$sorting&way=$way&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\" title=\"".$lang[423]."\"><i class=icon-th-large$styl2></i></a> <a href=\"index.php?ltype=3&sorting=$sorting&way=$way&start=$start&perpage=$perpage&brand=".rawurlencode($brand)."&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\" title=\"".$lang[425]."\"><i class=icon-align-justify$styl3></i></a></div>"; }

$sortecho.="<div class=pull-right style=\"white-space: nowrap; margin-left: 20px;\"><font face=Arial style=\"font-size: 9pt;\"><i class=icon-chevron-up></i>&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?way=up&sorting=$sorting&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\"$op4>".str_replace(" ", "&nbsp;", $lang['down'])."</a> <i class=icon-chevron-down></i>&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?way=down&sorting=$sorting&catid=$catid&brand=$brand$hidaction$params&query=".rawurlencode($query)."\"$op5>".str_replace(" ", "&nbsp;", $lang['up'])."</a></font></div>";
 $sortecho.="<div class=clear></div></div>";
if ($view_price_search==1) {  $sortecho.="<form method=\"GET\" action=\"".$_SERVER['PHP_SELF']."\" name=\"prform\">$hiddens
<table width=100% border=0 cellpadding=2 cellspacing=0><tr><td>
<td align=\"right\">
<b>".str_replace(" ", "&nbsp;", $lang[102]).":</b></td>
<td><select onchange=\"document.prform.submit()\" style=\"color: $nc4; border: 1px solid ".lighter($nc0,-10)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=10&w=1&e=".str_replace("#","",lighter($nc0,-10))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" name=\"priceot\"><option selected value=\"$priceot\">$dopriceot</option><option value=\"-\">".$lang[99]." 0</option>$fromarray1</select></td>
<td>
<input type=hidden name=\"query\" value=$query><input type=hidden name=\"brand\" value=$brand><input type=hidden name=\"sorting\" value=$sorting><input type=hidden name=\"way\" value=$way><input type=hidden name=\"catid\" value=$catid><input type=hidden name=\"start\" value=$start><input type=hidden name=\"perpage\" value=$perpage><select onchange=\"document.prform.submit()\" style=\"color: $nc4; border: 1px solid ".lighter($nc0,-10)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=10&w=1&e=".str_replace("#","",lighter($nc0,-10))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" name=\"pricedo\"><option selected value=\"$pricedo\">$dopricedo</option>$toarray1
<option value=\"$maximumprice\">".$lang[101]."</option></select></td>
<td align=right width=100%>$customsearch</td></tr></table></form>";
}

if (("$catid"=="0")) { if ($query=="") { $sortecho=""; }}
if ("$catid"!="0"){ if (substr($catid,-1) !="_") {  $sortecho="";}}
?>
