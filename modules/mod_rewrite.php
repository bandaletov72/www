<?php
//Begin Mod_rewrite php//

$rw_mass=explode("_", $rw."_");

while (list ($lnrw, $lrw) = each ($rw_mass)) {
if (doubleval($lrw)>0){
$rw_mass[$lnrw]=str_replace(doubleval($lrw),"",$lrw);
$strw= $rw_mass[$lnrw];
$strw = str_replace("eee","�",$strw);
$strw = str_replace("sch","�",$strw);
$strw = str_replace("sh","�",$strw);
$strw = str_replace("ch","�",$strw);
$strw = str_replace("qq","�",$strw);
$strw = str_replace("ya","�",$strw);
$strw = str_replace("a","�",$strw);
$strw = str_replace("b","�",$strw);
$strw = str_replace("v","�",$strw);
$strw = str_replace("g","�",$strw);
$strw = str_replace("d","�",$strw);
$strw = str_replace("e","�",$strw);
$strw = str_replace("j","�",$strw);
$strw = str_replace("z","�",$strw);
$strw = str_replace("i","�",$strw);
$strw = str_replace("y","�",$strw);
$strw = str_replace("k","�",$strw);
$strw = str_replace("l","�",$strw);
$strw = str_replace("m","�",$strw);
$strw = str_replace("n","�",$strw);
$strw = str_replace("o","�",$strw);
$strw = str_replace("p","�",$strw);
$strw = str_replace("r","�",$strw);
$strw = str_replace("s","�",$strw);
$strw = str_replace("t","�",$strw);
$strw = str_replace("u","�",$strw);
$strw = str_replace("f","�",$strw);
$strw = str_replace("h","�",$strw);
$strw = str_replace("c","�",$strw);
$strw = str_replace("w","�",$strw);
$strw = str_replace("q","�",$strw);
$strw = str_replace("u","�",$strw);
$strw = str_replace("EEE","�",$strw);
$strw = str_replace("SCH","�",$strw);
$strw = str_replace("SH","�",$strw);
$strw = str_replace("CH","�",$strw);
$strw = str_replace("QQ","�",$strw);
$strw = str_replace("YA","�",$strw);
$strw = str_replace("A","�",$strw);
$strw = str_replace("B","�",$strw);
$strw = str_replace("V","�",$strw);
$strw = str_replace("G","�",$strw);
$strw = str_replace("D","�",$strw);
$strw = str_replace("E","�",$strw);
$strw = str_replace("J","�",$strw);
$strw = str_replace("Z","�",$strw);
$strw = str_replace("I","�",$strw);
$strw = str_replace("Y","�",$strw);
$strw = str_replace("K","�",$strw);
$strw = str_replace("L","�",$strw);
$strw = str_replace("M","�",$strw);
$strw = str_replace("N","�",$strw);
$strw = str_replace("O","�",$strw);
$strw = str_replace("P","�",$strw);
$strw = str_replace("R","�",$strw);
$strw = str_replace("S","�",$strw);
$strw = str_replace("T","�",$strw);
$strw = str_replace("U","�",$strw);
$strw = str_replace("F","�",$strw);
$strw = str_replace("H","�",$strw);
$strw = str_replace("C","�",$strw);
$strw = str_replace("W","�",$strw);
$strw = str_replace("Q","�",$strw);
$strw = str_replace("U","�",$strw);
$rw_mass[$lnrw]=$strw;
}
}
array_pop($rw_mass);
$rw1=implode(" ", $rw_mass);
require "./templates/$template/mod_rw_templ.inc";
$rw1.=" ";
srand ((double) microtime ()*10000000);
$rw2=str_replace ("xxx", "<a href=\"$htpath/index.php?query=".rawurlencode($rw)."\"><b>$rw1</b></a>", $modr[array_rand ($modr)]);
$rw0="������� �������:";

$query=str_replace ("_", " ", $rw1);
unset ($rw_mass, $lnrw, $lrw)

?>
