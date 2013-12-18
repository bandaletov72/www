<?php
$sale_content="";
$insales="";
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
$insl=0;
while (list($key,$val)=each($salearr)) {
if (trim($val)!="") {
unset($tmp);
$tmp=explode(";", $val);
$sk_name=$tmp[0];
$sk_sum=$tmp[1];
$sk_sale=$tmp[2];
$sk_start=$tmp[3];
$sk_end=$tmp[4];
$sk_user=$tmp[5];
if ($sk_user=="") {$sk_user=$lang[1639]; }
$sk_option=$tmp[6];
if ($sk_option==0) {$sk_option=""; }
if ($sk_option==1) {$sk_option=$lang[1624]; }
if ($sk_option==2) {$sk_option=$lang[1633]; }
$insl++;
$insales.="<tr><td>$sk_name</td><td>$sk_sum</td><td>$sk_sale"."%</td><td>$sk_start</td><td>$sk_end</td><td>$sk_user</td><td>$sk_option</td></tr>";
}
}
if ($insl>0) {
$insales="<table class=\"table table-striped\"><tbody>
<tr class=panel>
<td class=small>$lang[1627]</td>
<td class=small>$lang[1628]</td>
<td class=small>$lang[1629]</td>
<td class=small>$lang[1630]</td>
<td class=small>$lang[1631]</td>
<td class=small>$lang[1636]</td>
<td class=small>&nbsp;</td>
</tr>
".$insales."</tbody></table>";

} else {
$insales="$lang[1626]";
}

} else {
$insales="$lang[1626]";
}
?>
