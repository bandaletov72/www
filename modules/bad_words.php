<?php
$minquery=3; //min query size
function badwords($var1) {
global $template;
$badwords_file="./templates/$template/bad_words.inc";
if (@file_exists($badwords_file)==TRUE){
$spis_badwords=file($badwords_file);
while (list ($keybw, $linebw) = each ($spis_badwords)) {
if (preg_match ("/=/i", $linebw)) {
unset ($bwmass);
$bwmass=explode("=", str_replace("\n", "", trim($linebw)));
$var1=str_replace($bwmass[0], $bwmass[1],$var1);
}
}
} else {echo "<br><b>Не найден $badwords_file</b><br>";}
return $var1;
}

function deny_badwords($var1) {
$soobs=$var1;
global $template;
$badwords_file="./templates/$template/bad_words.inc";
if (@file_exists($badwords_file)==TRUE){
$spis_badwords=file($badwords_file);
while (list ($keybw, $linebw) = each ($spis_badwords)) {
if (preg_match ("/=/i", $linebw)) {
unset ($bwmass);
$bwmass=explode("=", str_replace("\n", "", trim($linebw)));
$searchbw=$bwmass[0];
if (preg_match ("/$searchbw/i", $var1)) {
//$soobs=str_replace($searchbw, "<font color=#b94a48><b>$searchbw</b></font>", $soobs);
// echo "<br><br><font color=#b94a48>Вы использовали запрещенное слово или слова</font><br>";
$var1="";
}
}
}
} else {echo "<br><b>Не найден $badwords_file</b><br>";}
return $var1;
}

?>