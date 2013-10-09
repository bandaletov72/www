<?php
//Begin Mod_rewrite php//

$rw_mass=explode("_", $rw."_");

while (list ($lnrw, $lrw) = each ($rw_mass)) {
if (doubleval($lrw)>0){
$rw_mass[$lnrw]=str_replace(doubleval($lrw),"",$lrw);
$strw= $rw_mass[$lnrw];
$strw = str_replace("eee","э",$strw);
$strw = str_replace("sch","щ",$strw);
$strw = str_replace("sh","ш",$strw);
$strw = str_replace("ch","ч",$strw);
$strw = str_replace("qq","ъ",$strw);
$strw = str_replace("ya","я",$strw);
$strw = str_replace("a","а",$strw);
$strw = str_replace("b","б",$strw);
$strw = str_replace("v","в",$strw);
$strw = str_replace("g","г",$strw);
$strw = str_replace("d","д",$strw);
$strw = str_replace("e","е",$strw);
$strw = str_replace("j","ж",$strw);
$strw = str_replace("z","з",$strw);
$strw = str_replace("i","и",$strw);
$strw = str_replace("y","й",$strw);
$strw = str_replace("k","к",$strw);
$strw = str_replace("l","л",$strw);
$strw = str_replace("m","м",$strw);
$strw = str_replace("n","н",$strw);
$strw = str_replace("o","о",$strw);
$strw = str_replace("p","п",$strw);
$strw = str_replace("r","р",$strw);
$strw = str_replace("s","с",$strw);
$strw = str_replace("t","т",$strw);
$strw = str_replace("u","у",$strw);
$strw = str_replace("f","ф",$strw);
$strw = str_replace("h","х",$strw);
$strw = str_replace("c","ц",$strw);
$strw = str_replace("w","ы",$strw);
$strw = str_replace("q","ь",$strw);
$strw = str_replace("u","ю",$strw);
$strw = str_replace("EEE","Э",$strw);
$strw = str_replace("SCH","Ш",$strw);
$strw = str_replace("SH","Щ",$strw);
$strw = str_replace("CH","Ч",$strw);
$strw = str_replace("QQ","Ъ",$strw);
$strw = str_replace("YA","Я",$strw);
$strw = str_replace("A","А",$strw);
$strw = str_replace("B","Ь",$strw);
$strw = str_replace("V","В",$strw);
$strw = str_replace("G","Г",$strw);
$strw = str_replace("D","Д",$strw);
$strw = str_replace("E","Е",$strw);
$strw = str_replace("J","Ж",$strw);
$strw = str_replace("Z","З",$strw);
$strw = str_replace("I","И",$strw);
$strw = str_replace("Y","Й",$strw);
$strw = str_replace("K","К",$strw);
$strw = str_replace("L","Л",$strw);
$strw = str_replace("M","М",$strw);
$strw = str_replace("N","Н",$strw);
$strw = str_replace("O","О",$strw);
$strw = str_replace("P","П",$strw);
$strw = str_replace("R","Р",$strw);
$strw = str_replace("S","С",$strw);
$strw = str_replace("T","Т",$strw);
$strw = str_replace("U","У",$strw);
$strw = str_replace("F","Ф",$strw);
$strw = str_replace("H","Х",$strw);
$strw = str_replace("C","Ц",$strw);
$strw = str_replace("W","Ы",$strw);
$strw = str_replace("Q","Ь",$strw);
$strw = str_replace("U","Ю",$strw);
$rw_mass[$lnrw]=$strw;
}
}
array_pop($rw_mass);
$rw1=implode(" ", $rw_mass);
require "./templates/$template/mod_rw_templ.inc";
$rw1.=" ";
srand ((double) microtime ()*10000000);
$rw2=str_replace ("xxx", "<a href=\"$htpath/index.php?query=".rawurlencode($rw)."\"><b>$rw1</b></a>", $modr[array_rand ($modr)]);
$rw0="Немного рекламы:";

$query=str_replace ("_", " ", $rw1);
unset ($rw_mass, $lnrw, $lrw)

?>
