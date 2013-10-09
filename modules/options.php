<?php
$optio=Array();
$op_mass=Array();
$op_line="";
$op_num="";
$optionreg=Array();
$optiontitle=Array();
$optfile="./templates/$template/$speek/custom_options.inc";
if (@file_exists($optfile)) {
$optionmass=file($optfile);
while (list ($op_num, $op_line) = each ($optionmass)) {
$op_mass=explode("|",$op_line);
if (isset($op_mass[0],$op_mass[1],$op_mass[2],$op_mass[3])) {
$optiontitle[$op_num]=$op_mass[2];
$vvars="";
$optio[$op_num]="<tr><td><nobr>".$op_mass[1]."</nobr></td><td>
<script language=javascript>
function docjs".$op_num."_[id](price) {
opt=new Array(10);
opt['']=[pr];
[vars]
var idx=document.getElementById('id"."_[id]').value;
if (opt[idx]!=price) {
document.getElementById('span[id]').innerHTML=opt[idx];
}
if (idx=='') {
document.getElementById('span[id]').innerHTML=opt[idx];
}
}
</script>
<select onchange=\"javascript:docjs".$op_num."_[id]([pr]);\" style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=20&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" id=\"id"."_[id]\" name=\"option"."[".$op_num."]\">\n<option value=\""."\">----</option>\n";
while (list ($ops_num, $ops_line) = each ($op_mass)) {
if (trim($ops_line)!="") {
$optionreg[$op_num."_".($ops_num-2)]=$ops_line;
$ops_plus="";
$ops_pluss="";
$opnazv=strtoken($ops_line,"^");
$oplus=str_replace("^","",str_replace($opnazv,"", $ops_line));
$optionprice[$op_num."_".($ops_num-2)]="";
//echo "0.\$optionprice[$op_num"."_".($ops_num-2)."]=\"\";<br>";
if ($oplus!="") {
if (preg_match("/\%/",$oplus)) {
$optionprice[$op_num."_".($ops_num-2)]="$oplus";
//echo "1.\$optionprice[$op_num"."_".($ops_num-2)."]=\"$oplus\";<br>";
if (preg_match("/-/",$oplus)) {
$ops_plus=" ".$oplus;
//$ops_plus="";
$ops_pluss="+(".strtoken($oplus,"%")."*(Math.round(([pr])/100)))";
} else {
$ops_plus=" +".$oplus;
//$ops_plus="";
$ops_pluss="+(".strtoken($oplus,"%")."*(Math.round(([pr])/100)))";
}
} else {
$optionprice[$op_num."_".($ops_num-2)]=$oplus;
//echo "2.\$optionprice[$op_num"."_".($ops_num-2)."]=\"$oplus\";<br>";
if (preg_match("/-/",$oplus)) {
$ops_pluss="".(0.01*(round(($oplus*$kurs)/0.01)));
$ops_plus=" ".(0.01*(round(($oplus*$kurs)/0.01))).$currencies_sign[$_SESSION["user_currency"]];
//$ops_plus="";
} else {
$ops_pluss="+".(0.01*(round(($oplus*$kurs)/0.01)));
$ops_plus=" +".(0.01*(round(($oplus*$kurs)/0.01))).$currencies_sign[$_SESSION["user_currency"]];
//$ops_plus="";
}

}
$optionreg[$op_num."_".($ops_num-2)]=$opnazv.$ops_plus;
} else {
$optionreg[$op_num."_".($ops_num-2)]=$ops_line;
}
if ($ops_num>2){
$optio[$op_num].="<option value=\"".($ops_num-2)."\">".$opnazv."$ops_plus </option>\n";
$vvars.="opt[".($ops_num-2)."]=("."[pr]"."$ops_pluss".");\n";
}
}
}
$optio[$op_num].="</select></td></tr>\n";
$optio[$op_num]=str_replace("[vars]", "$vvars", $optio[$op_num]);
}
unset($op_mass);
}
}
unset($op_num,$op_line,$optionmass);
?>