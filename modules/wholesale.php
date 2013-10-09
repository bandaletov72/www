<?php

if ($mnogo==2) {
$added=3;
$totalsum=0;
$totalpoz=0;



//проверяем переданные массивы

if(is_array($_POST) ) {
while( list($k, $v) = each($_POST) ) {
if( is_array($_POST[$k]) ) {
while( list($k2, $v2) = each($_POST[$k]) ) {
if ($_POST[$k][$k2]!="") {
//if ($k!="mqty") {die ("Попытка хакерства !=mqty ...");}
if (!preg_match("/^[0-9]+$/",$_POST[$k][$k2])) { die ("<b>Ошибка в вводе количества ...</b><br>Пожалуйста вернитесь и поправьте введенные данные!"); }
if($_POST[$k][$k2]>0) {
//echo "$k $k2 ".$_POST[$k][$k2]."<br>";
}

}
}
}
}
}





$file="$base_file";
$sc=0;
$fofid=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$tmpmsf=explode("|",$st);

$tmpfid=md5(@$tmpmsf[3]." ID:".@$tmpmsf[6]);
$sc+=1;
reset ($mqty);
while (list ($key_unifids, $st_unifids) = each ($mqty)) {
if ($key_unifids==$sc) {
//echo $mqty[$key_unifids]."<br>";

$fid=$sc;
$r=@$tmpmsf[1];
$sub=@$tmpmsf[2];
$repcatid=@$podstava["$r|$sub|"];
//$tmpmsf[4]=$okr*(round(($tmpmsf[4]*$kurs)/$okr));
if (($podstavas["$r|$sub|"]!="")||(preg_match("/\%/", @$tmpmsf[8])==TRUE)) {  $strto=strtoken(@$tmpmsf[8],"%"); if ((preg_match("/\%/", @$tmpmsf[8])==TRUE)&&(doubleval($strto)>0)) {$tmpmsf[4]=$tmpmsf[4]-($tmpmsf[4]*(doubleval($strto))/100);} else {$strto=doubleval($podstavas["$r|$sub|"]); $tmpmsf[4]=$tmpmsf[4]-($tmpmsf[4]*((double)$podstavas["$r|$sub|"])/100);}} else {
if (($valid=="1")&&($details[7]=="VIP")): $tmpmsf[4]=$tmpmsf[4]-$tmpmsf[4]*$vipprocent; endif;
}

$fi="";
$fi= @str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$tmpmsf[9]))));
if (@file_exists(".$fi")){
$maxw=$style['spec_w'];
$imagesz = @getimagesize(".$fi");
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
$wh="width=".$maxw." height=".$widt;

} else{
$wh="width=".$style['spec_w']." height=".$style['spec_h'];
}
unset($fi);
@$tmpmsf[9]=str_replace("<img ", "<img align=\"left\" title=\"".$tmpmsf[3]."\" $wh ", @$tmpmsf[9]);
@$tmpmsf[9]=str_replace("border=0", "border=1 hspace=3 style=\"border: 1 solid ".$style['nav_col1']."\"", @$tmpmsf[9]);
$tmpmsf[9]=str_replace("width= height= ", "", $tmpmsf[9]);


$error="";
if ($tmpmsf[4]==0){ if ($zero_price_incart==0){ $error=$lang['file']." <b>".$tmpmsf[3]."</b> ".$lang[222]." E13<br>";} }
if (substr($tmpmsf[12],0,1)=="0") { $error=$lang['file']." <b>".$tmpmsf[3]."</b> ".$lang[222]." E13<br>"; }
if ($error=="") {
$_SESSION["user_basket"]="ok";
if (!isset($tmpmsf[$netweight])) {$tmpmsf[$netweight]=$def_weight;}
if (($tmpmsf[$netweight])=="") {$tmpmsf[$netweight]=$def_weight;}
if (!isset($tmpmsf[$box_volume])) {$tmpmsf[$box_volume]=0;}
if (($tmpmsf[$box_volume])=="") {$tmpmsf[$box_volume]=0;}
if ($st_unifids>0) {$cart->add_item($tmpfid."|",$st_unifids,$tmpmsf[4],@$tmpmsf[3]." ID:".@$tmpmsf[6], $sc, "","", @$tmpmsf[9], @$tmpmsf[5], substr(@$tmpmsf[12],1,3) , $tmpmsf[$netweight], trim($st), $speek, $tmpmsf[$box_volume]);
$totalsum+=$st_unifids*$tmpmsf[4];
$totalpoz+=1;
$added=2;
}
}
}

}
unset($tmpmsf,$tmpmsfart,$add_it);
}
fclose($f);

}
?>
