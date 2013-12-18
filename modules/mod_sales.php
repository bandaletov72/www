<?php
$sale_content="";
$salearr=Array();
$ssfile="$base_loc/set_sales.txt";
if (file_exists($ssfile)) {
$fp=fopen($ssfile,"r");
$fsz=filesize($ssfile);
$sale_content=fread($fp,$fsz);
fclose($fp);
$salearr=explode("<br>",$sale_content);
}
if ($sale_content!="") {
function ssale($sum,$valut) {
global $init_currency;
global $currencies;
global $salearr;
global $details;
global $okr;
$insl=0;
reset($salearr);
while (list($key,$val)=each($salearr)) {
if (trim($val)!="") {
$tmp=explode(";", $val);
$sk_name=$tmp[0];
$sk_sum=$tmp[1];
$sk_sale=$tmp[2];
$sk_start=$tmp[3];
$sk_end=$tmp[4];
$sk_user=$tmp[5];
$sk_option=$tmp[6];
$insl++;
if ($sum>=doubleval($sk_sum)) {  return ($okr*(round(($sum-$sum*doubleval($sk_sale)/100)/$okr)));  }
}
}
return $sum;
}

} else {
function ssale($sum,$valut) {
return $sum;

}
}
?>
