<?php
$esim="&nbsp;<span class=\"label label-important\"><i class=\"icon-hand-left icon-white\"></i></span>";
$jscountr="";
$chids="<div>";
$errs="";
$verify_title="";
$verifylist="";
$sqrpf=0;
$ppps=0;
$checkout="";
$kv_f="./templates/$template/$speek/ticket.inc";
if ($cart->itemcount>0)  {
if (@file_exists($kv_f)==TRUE) {
$fpk=fopen($kv_f, "r");
if (!$fpk) {echo "<br>File $kv_f not found! Ticket saving error.<br>";} else {
$kvit_c = fread($fpk, filesize($kv_f));
fclose ($fpk);
@chmod ($kv_f, 0666);
$stroketab = ExtractString($kvit_c, "<!--[tr]-->", "<!--[/tr]-->");

$pm_link="";
$_1_2[1]="одна ";
$_1_2[2]="две ";

$_1_19[1]="один ";
$_1_19[2]="два ";
$_1_19[3]="три ";
$_1_19[4]="четыре ";
$_1_19[5]="пять ";
$_1_19[6]="шесть ";
$_1_19[7]="семь ";
$_1_19[8]="восемь ";
$_1_19[9]="девять ";
$_1_19[10]="десять ";

$_1_19[11]="одиннацать ";
$_1_19[12]="двенадцать ";
$_1_19[13]="тринадцать ";
$_1_19[14]="четырнадцать ";
$_1_19[15]="пятнадцать ";
$_1_19[16]="шестнадцать ";
$_1_19[17]="семнадцать ";
$_1_19[18]="восемнадцать ";
$_1_19[19]="девятнадцать ";

$des[2]="двадцать ";
$des[3]="тридцать ";
$des[4]="сорок ";
$des[5]="пятьдесят ";
$des[6]="шестьдесят ";
$des[7]="семьдесят ";
$des[8]="восемдесят ";
$des[9]="девяносто ";

$hang[1]="сто ";
$hang[2]="двести ";
$hang[3]="триста ";
$hang[4]="четыреста ";
$hang[5]="пятьсот ";
$hang[6]="шестьсот ";
$hang[7]="семьсот ";
$hang[8]="восемьсот ";
$hang[9]="девятьсот ";

$namerub[1]="рубль ";
$namerub[2]="рубля ";
$namerub[3]="рублей ";

$nametho[1]="тысяча ";
$nametho[2]="тысячи ";
$nametho[3]="тысяч ";

$namemil[1]="миллион ";
$namemil[2]="миллиона ";
$namemil[3]="миллионов ";

$namemrd[1]="миллиард ";
$namemrd[2]="миллиарда ";
$namemrd[3]="миллиардов ";

$kopeek[1]="копейка ";
$kopeek[2]="копейки ";
$kopeek[3]="копеек ";


function semantic($i,&$words,&$fem,$f){
global $_1_2, $_1_19, $des, $hang, $namerub, $nametho, $namemil, $namemrd;
$words="";
$fl=0;
if($i >= 100){
$jkl = intval($i / 100);
$words.=$hang[$jkl];
$i%=100;
}
if($i >= 20){
$jkl = intval($i / 10);
$words.=$des[$jkl];
$i%=10;
$fl=1;
}
switch($i){
case 1: $fem=1; break;
case 2:
case 3:
case 4: $fem=2; break;
default: $fem=3; break;
}
if( $i ){
if( $i < 3 && $f > 0 ){
if ( $f >= 2 ) {
$words.=$_1_19[$i];
}
else {
$words.=$_1_2[$i];
}
}
else {
$words.=$_1_19[$i];
}
}
}


function num2str($L){
global $_1_2, $_1_19, $des, $hang, $namerub, $nametho, $namemil, $namemrd, $kopeek;

$s=" ";
$s1=" ";
$s2=" ";
$kop=intval( ( $L*100 - intval( $L )*100 ));
$L=intval($L);
if($L>=1000000000){
$many=0;
semantic(intval($L / 1000000000),$s1,$many,3);
$s.=$s1.$namemrd[$many];
$L%=1000000000;
}

if($L >= 1000000){
$many=0;
semantic(intval($L / 1000000),$s1,$many,2);
$s.=$s1.$namemil[$many];
$L%=1000000;
if($L==0){
$s.="рублей ";
}
}

if($L >= 1000){
$many=0;
semantic(intval($L / 1000),$s1,$many,1);
$s.=$s1.$nametho[$many];
$L%=1000;
if($L==0){
$s.="рублей ";
}
}

if($L != 0){
$many=0;
semantic($L,$s1,$many,0);
$s.=$s1.$namerub[$many];
}

if($kop > 0){
$many=0;
semantic($kop,$s1,$many,1);
$s.=$s1.$kopeek[$many];
}
else {
$s.=" 00 копеек";
}

return $s;
}
$pm_content="";
$zaksum=0;
$postpost=Array();
$posturl=Array();
$postname=Array();
$totalweight=$cart->totalweight;
$totalvolume=$cart->totalvolume;



$choosesd="";
$choosepm="";
$jsd="";
$jpm="";
$jsdload="";
$jpmload="";
$carttotal=$cart->total;
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
if (isset($reg_as)) { if($setregid[$regid]>1) {$lang[61]=$lang[158]; $lang[68]=$lang[169];}}
if ($regid=="") {$regid=$details[0]; if (isset($setregid[$regid])) { if ($setregid[$regid]==0) { $regid=$firstregid; }} $prop=$regid;}
if ($regid=="") {$regid=$firstregid; $prop=$regid;}


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

if ($pm!=$srrnum) { $choosepm.="<option value=\"".$srrnum."\">".$srmasss[0]." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {}else {$choosepm.=$srmasss[2];}} else {$choosepm.=$srmasss[2];}  $choosepm.="</option>"; }
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
if ($sd!=$srrnum) { $choosesd.="<option value=\"".$srrnum."\">".$srmasss[0]." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$choosesd.=$lang[166];} else {$choosesd.=$srmasss[2];}} else {$choosesd.=$srmasss[2];}  if ($srmasss[6]!=0) {$choosesd.=" +".$okr*round($srmasss[6]/$okr)." ".$currencies_sign[$_SESSION["user_currency"]]."/$kg (".ceil($totalweight)." $kg = ".$okr*round((ceil($totalweight)*$srmasss[6])/$okr)."".$currencies_sign[$_SESSION["user_currency"]].")"; } $choosesd.="</option>"; }
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
$selectpm=strtoken($payment_metode[$pm],"|")." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {}else {$selectpm.=$srmasss[2];}} else {$selectpm.=$srmasss[2];}
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
$srmasss[2]="+".(0+$addsd)." ".$currencies_sign[$_SESSION["user_currency"]]."";
}
}}
$selectsd=strtoken($delivery_metode[$sd],"|")." "; if ($srmasss[3]==1) { if ($carttotal>=$currencies_zakaz_menee[$valut]) {$selectsd.=$lang[166];} else {$selectsd.=$srmasss[2];}} else {$selectsd.=$srmasss[2];}  if ($srmasss[6]!=0) {$selectsd.=" +".$srmasss[6]." ".$currencies_sign[$_SESSION["user_currency"]]."/$kg (".ceil($totalweight)." $kg = ".$okr*round((ceil($totalweight)*$srmasss[6])/$okr)."".$currencies_sign[$_SESSION["user_currency"]].")"; }
unset ($srmasss);
//Форма выбора способов оплаты

if (isset($reg_as[$regid])) {$regas=strtoken($reg_as[$regid],"|");} else {$regas="";}

$totulus=($carttotal+$discont1+$discont2);
$zdost=str_replace("\n", "", "<br><b>".$lang[160]."</b>: $selectpm<br><br><b>".$lang[161]."</b>: $selectsd<br><br><font size=3><b>".$lang[165].": ".$totulus."</b></font> ".$currencies_sign[$_SESSION["user_currency"]]."");

$basket_ttl=0;
$basket_poz=0;
if (!isset($antispam)){$antispam=0;} if (!preg_match("/^[0-9]+$/",$antispam)) { $antispam=0;}
if (!isset($md5num)){$md5num="a0a0a0a0a0a0";} if (!preg_match("/^[0-9a-f]+$/i",$md5num)) { $md5num="a0a0a0a0a0a0";}
$warn="";

$errs="";


//wishlist
if (!isset($wishlist)){$wishlist="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$wishlist)) { $wishlist="";}



if ($wishlist!="") {





if (!isset($fio)){$fio="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$fio)) { $fio="";}
if ($fio!="") {
$items=$cart->get_all();
$towish="";
$datewish=time();
$microtime=0;
foreach($items as $item) {
$microtime+=1;
$out_c=explode("|", $item['base']);
//wishlist
if ($item['base']!="") {
 $towish.=($datewish+$microtime)."<br>".@$_SERVER['REMOTE_ADDR']."|".$fio. "|". $item['qty']."|".$item['base']."\n";
 } else {
 $errs = "<b>Товар не был заказан. Время сосуществования сессии - превышено.</b><br>";
 }
//wishlist
  }

if ($towish=="") {
$errs= "Ваша корзина очищена! Вы должны набрать товар для размещения совместного заказа!";
$verifylist="<font color=#b94a48>$errs</font>";
$verify_title="<font color=#b94a48>".$lang[42]."1!</font>";

} else {
if (@$details[1]!=""){
if (($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/flag.txt")==FALSE)) {

if (is_dir ("./admin/userstat/".@$details[1])==FALSE) {
mkdir ("./admin/userstat/".@$details[1]);
}
$nazv="./admin/userstat/".@$details[1]."/wishlist.txt";







$file = fopen ($nazv, "a");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> ".$lang[44]." <b>$nazv</b> ".$lang[45].".\n";
exit;
}
fputs ($file, "$towish");flock ($file, LOCK_UN);
fclose ($file);
unset ($file);

$cart->empty_cart();

$verifylist="Ваши персональные пожелания будут учтены при оформлении совместного заказа.<br>Теперь Вы можете договариваться с организатором закупки о дате и времени получения заказа, а также о его оплате.<br><br>Через 20 сек. - Ваш броузер должен переправить Вас на страницу совместного заказа, чтобы Вы проконтролировали, что Ваша заявка попала в совместный заказ.<p align=center>Если этого не произошло или Вы не хотите ждать, нажмите <a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist\"><b>здесь</b></a></p><META HTTP-EQUIV=\"Refresh\" CONTENT=\"20;URL=".$_SERVER['PHP_SELF']. "?zak=wishlist\"><br><br>";
$verify_title="".$lang[323]." $fio! ";

} else {


$errs= "<font color=#b94a48>".$lang[42]."2!</font>";
$verifylist="<font color=#b94a48>$errs</font>";
$verify_title="";
$action="zakaz";
$old_action="zakaz";

}

//if (@$details[1]!=""){
//require ("./modules/wishlist.php");
//}


} else {
$errs= "Вы должны быть зарегистрированы для того, чтобы делать совместные заказы!<br>
Зарегистрированные пользователи получают логин и пароль для доступа. Если Вы не имеете этих данных, то получите их у Вашего администратора совместных заказов!";
$verifylist="<font color=#b94a48>$errs</font>";
$verify_title="<font color=#b94a48>".$lang[42]."3!</font>";
}


}
} else {
$errs="".$lang[70]." ".$lang[75].$lang[304];
$verifylist="<font color=#b94a48>$errs</font>";
$verify_title="<font color=#b94a48>".$lang[42]."4!</font>";
}


} else {
//wishlist




$arr=array ("email", "fio", "gorod", "tel", "metro", "street","street2", "house", "ofice", "korp" , "pod" , "domophone", "flat", "other", "agree","country","telcode");
$arr2=array ("email", "fio", "gorod", "tel", "metro", "street","street2", "house", "ofice", "korp" , "pod" , "domophone", "flat", "other", "agree","country","telcode");
while (list ($line_num, $a) = each ($arr2)) {
if (isset($$a)) {
$$a = strip_tags($$a);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "", $$a);
$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);
$$a = str_replace(chr(10) , "\n", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
if(preg_match("/http:\/\//i",$$a)){ echo $lang[305]; exit;}
if(preg_match("/link=/i",$$a)){ echo $lang[305]; exit;}
if(preg_match("/url=/i",$$a)){ echo $lang[305]; exit;}
} else {$$a="";}
}
//Проверим правильность Email
// Антиспам


if(md5(intval($_POST['antispam'])*0.56231)!=$_POST['md5num']):
$errs.= "<br><font color=#b94a48><b>".$lang[146]."</b></font><br><br>"; endif;


// Антиспам
if ((!@$agree) || (@$agree=="")): $agree=""; $errs.= "<Font color=#b94a48><b>".$lang[147]."</b></font><br>"; endif;
if ((!@$email) || (@$email=="")): $e10="$esim"; $email=""; $errs.= "<Font color=#b94a48><b>".$lang[70]." \"Email\"!</b></font><br>"; endif;
if ((!@$fio) || (@$fio=="")): $e13="$esim";$fio=""; $errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[75]."\"!</b></font><br>"; endif;
if ((!@$tel) || (@$tel=="")): $e12="$esim";$tel=""; $errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[73]."\"!</b></font><br>"; endif;





if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);
$fuserm=0;
$ffus="";
$ffus2="";
$ffus3="";
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if (!isset($fm[$fuserm])) { $fm[$fuserm]=""; if ($user_mass[4]==1){
$errs.= "<Font color=#b94a48>E600: <b>".$lang[70]." ".$user_mass[0]."!</b></font><br>";}}
if (($fm[$fuserm]!="")&&(!preg_match("/^[а-яА-Яa-zA-Z0-9:@_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$fm[$fuserm]))) {
$errs.= "<Font color=#b94a48>E700: <b>".$lang[168]." '".$user_mass[0]."'!</b></font><br>";
$fm[$fuserm]="";
} else {
if ($user_mass[4]==1) {
if ($fm[$fuserm]=="") {
$errs.= "<Font color=#b94a48>E800: <b>".$lang[70]." ".$lang[81].": '".$user_mass[0]."'!</b></font><br>";
$ee[$fuserm]="$esim";
$fm[$fuserm]="";
}
}

if ($user_mass[5]!="") {
$strin="^[".$user_mass[5]."]+$";
if (($fm[$fuserm]!="")&&(!preg_match("/".$strin."/i",$fm[$fuserm]))) {
$errs.= "<Font color=#b94a48>E850: <b>".$lang[168]." '".$user_mass[0]."'! ".$lang[220]." ".$user_mass[5]."</b></font><br>";
$ee[$fuserm]="$esim";
$fm[$fuserm]="";
}
}
if (($fm[$fuserm]!="")&&($fm[$fuserm]!="-")) {
$ffus.="<b>".$user_mass[0].":</b> ".$fm[$fuserm]."<br>";
$indrefus=$user_mass[0];
$refus[$indrefus]=$fm[$fuserm];
$ffus2.=$user_mass[0].":  ".$fm[$fuserm]."<br>\n";
}
$fuserm+=1;
}
}
}
}





if ((!@$country) || (@$country=="")): $country=""; $e4="$esim"; $errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[167]."\"!</b></font><br>"; endif;
if ((!@$telcode) || (@$telcode=="")): $e11="$esim"; $errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[157]."\"!</b></font><br>"; $telcode="";  endif;
if ((!@$gorod) || (@$gorod=="")): $gorod=""; $e5="$esim"; $errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[72]."\"!</b></font><br>"; endif;
if ((!@$metro) || (@$metro=="")): $metro=""; $e6="$esim";$errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[61]."\"!</b></font><br>"; endif;
if ((!@$street) || (@$street=="")): $street=""; $e7="$esim";$errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[71]."\"!</b></font><br>"; endif;
if ((!@$house) || (@$house=="")): $house=""; $e8="$esim";$errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[68]."\"!</b></font><br>"; endif;
if ((!@$ofice) || (@$ofice=="")): $ofice=""; $e9="$esim";$errs .= "<Font color=#b94a48><b>".$lang[70]." \"".$lang[65]."\"!</b></font><br>"; endif;
$bad_symbols= array("\\" . chr(36),"<",">", "\%", "\^", "\*", "\+", "\=", "\ " ,"\|" ,"\," ,"\/" ,"\;" ,"\:" ,"\[" ,"\]" ,"\{" ,"\}" ,"\(" ,"\"" ,"'" ,"\)");
$hache_num = array (5,9,12,2,29,23,7,17); #8 чисел от 1-31
reset ($bad_symbols);
$error="";
$error2="";
$err=$lang[150];
$err2=$lang[646];
foreach ($bad_symbols as $key => $value) {
if (preg_match("/".$value."/i", $email) == TRUE): $value = str_replace("<" , "&lt;", $value); $value = str_replace(">" , "&gt;", $value); $error .= ",\"<b>" . substr($value, 1) . "</b>\""; endif;
}
if ($email!="") {
$matches = explode("@", $email);
if (count($matches) == 1): $error2.=$lang[151]."<br>\n"; endif;
if (((count($matches)-1) >= 2) && (count($matches) != 1)): $e10="$esim";$error2.=$lang[303]. " \"<b>@</b>\" - ".$lang[302].".<br>\n"; endif;
if ($matches[0] == ""): $error2.=$lang[152]."<br>\n"; endif;
if (substr($matches[0],0,1)=="."): $e10="$esim";$error2.="".$lang[338]."<br>\n"; endif;
if (end ($matches) == ""): $error2.=$lang[153]."<br>\n"; endif;
if (preg_match("/(.*)\@(.*)\.(.*)/i", $email) == FALSE): $e10="$esim";$error2.="".$lang[42]." Email.<br>\n"; endif;
if($error!=""): $e10="$esim";$error2.=$lang[300]." " . substr ($error, 1) . " - ".$lang[153]."<br>\n"; endif;

}

$email_html = str_replace("<" , "&lt;", $email);
$email_html = str_replace(">" , "&gt;", $email_html);
if($error2!=""):  $action="zakaz"; $e10="$esim";$errs .= "<p align=left><Font color=#b94a48><b>$err $email_html</b></font><br><small>$error2</small></p>"; endif;

$countrycode="";
if (@file_exists("./templates/$template/$speek/custom_country.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_country.inc");
reset ($user_arr);
while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if (($country==$user_mass[0])&&($country!="")) {$countrycode=$user_mass[2];}
if (count($user_arr)==1) { $user_mass=explode("|", $user_arr[0]); $country=$user_mass[0];$countsel="";$jscountr=""; $chids="<div class=hidden>";}
unset ($user_mass);
}
unset ($user_line,$user_num);
}
unset ($user_arr);
} else {$choosecountry="";}

$tovout = $cart->itemcount;
$stuks = $cart->itemstuks;
$summaout = $cart->total;
if (($minimal_order_not_available==1)&&($summaout<$currencies_minimal_order[$_SESSION["user_currency"]])) { $errs.= "<div>$lang[1009] <b>".$currencies_minimal_order[$_SESSION["user_currency"]]."</b> ".$currencies_sign[$_SESSION["user_currency"]]."</div>";}

if ($errs!="") {
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","$errs"));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$errs="$erview";
}
$verifylist="$errs";
$verify_title="<font color=#b94a48>".$lang[42]."</font>";

if($errs!=""):  $action="zakaz"; endif;

if ($tovout==0): $verify_title="<font color=#b94a48>".$lang[42]."6!</font>"; $verifylist="<b>".$lang[40]."!</b>"; endif;




if (($errs=="") && ($tovout!=0)) {
$basout = "";
$smsout="";

$towish="";
$basket_opt=0;
$basket_dost=0;

if (($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/wishlist.txt")==TRUE)) {

$nazv="./admin/userstat/".@$details[1]."/wishlist.txt";
$wish_arr=file ("$nazv");
while (list ($wish_num, $wish_line) = each ($wish_arr)) {
$w_c=explode("|", $wish_line);
//echo date("d.m.Y G:i:s",(double)strtoken($w_c[0], "<br>")). " - " . $w_c[1] . " - " .$w_c[6] . " ID:" .$w_c[9]. " x ".$w_c[2] . " ".$lang[229]." "."<br>";
$wishn=$w_c[6] . " ID:" .$w_c[9];
$wishn2=$w_c[1];
@$wishm[$wishn].= " ". $w_c[1] . " (" .$w_c[2] . " ".$lang['pcs'].") ; ";
@$wishm2[$wishn2]+=($w_c[7]*$w_c[2]);
}
}
if (($valid=="1")&&($login!="")&&($password!="")&&($wishzak!="")&&(@file_exists("./admin/userstat/".@$details[1]."/flag.txt")==TRUE)&&(isset($_SESSION["wishpass"]))&&(@$_SESSION["wishpass"]==@$details[$user_pass_complex])) {
unlink("./admin/userstat/".@$details[1]."/flag.txt");
unlink("./admin/userstat/".@$details[1]."/wishlist.txt");
}
$stroket="";
$nnum=1;


foreach($items as $item) {

$out_c=explode("|", $item['base']);
  $wh="width=".$style['ww']." height=".$style['hh']." ";
if (($style['ww']=="")||($style['hh'])=="") {$wh="";}

//wishlist features
if (preg_match("/^[0-9]+$/",$item['fid'])) {} else {$out_c[9]=$item['fid'];}
//wishlist end

$wh="";
if ($out_c[9]!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"", str_replace($htpath,"", strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$out_c[9]),"src=")."src=","", stripslashes(@$out_c[9]))),">")," ")));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){

$imagesz = @getimagesize(".$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/$kkd1)." height=".ceil(($imagesz[1])/$kkd1)." ";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$out_c[9]=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img". $wh ." ",stripslashes(@$out_c[9]))));


$out_c[9]=str_replace("<img ", "<img vspace=3 hspace=10 ",  stripslashes(@$out_c[9]));

@$out_c[9]=str_replace("border=0", "border=0 align=left", @$out_c[9]);

} else {
$out_c[9]="<img src=\"".$image_path."/no_photo.gif\" border=0 width=".$style['ww']." height=".$style['hh'].">";

}
    //@$out_c[9]=str_replace("border=0", "border=1 style=\"border: 1 solid ".$style['nav_col4']."\"", @$out_c[9]);
$out_c[9]=str_replace("width= height= ", "", $out_c[9]);

  $prski="";
  if (($valid=="1")&&($details[7]=="VIP")&&($vipprocent!=0)){ $prski="<br><font color=#b94a48>".$lang[219]." VIP ".($vipprocent*100)."%</font>"; }
  if (($podstavas[$out_c[1]."|".$out_c[2]. "|"]!="")||(preg_match("/\%/", @$out_c[8])==TRUE)) {
  $strto=strtoken(@$out_c[8],"%");
  if ((preg_match("/\%/", @$out_c[8])==TRUE)&&(doubleval($strto)>0)) {
  $prski="<br><font color=#b94a48>".$lang[219]." ".doubleval($strto)."%</font>";
  } else {
  $strto=doubleval($podstavas[$out_c[1]."|".$out_c[2]. "|"]);
  $prski="<br><font color=#b94a48>".$lang[219]." ".$podstavas[$out_c[1]."|".$out_c[2]."|"]."%</font>";
  }
  }


$strokets=str_replace("[num]" , "$nnum", $stroketab);
$strokets=str_replace("[art]" , $out_c[6], $strokets);
$strokets=str_replace("[desc]" , $out_c[3], $strokets);
$strokets=str_replace("[qty]" , $item['qty'], $strokets);
$strokets=str_replace("[price]" , ($okr*(round($kurs*$item['price']/$okr))), $strokets);
$strokets=str_replace("[total]" , (($okr*round($item['price']*$kurs/$okr))*$item['qty']), $strokets);
$strokets=str_replace("[weight]" , $item['weight'].$kg, $strokets);
$strokets=str_replace("[volume]" , $item['volume'].$vol, $strokets);
$strokets=str_replace("[subtotalweight]" , $item['subtotalweight'].$kg, $strokets);
$strokets=str_replace("[subtotalvolume]" , $item['subtotalvolume'].$vol, $strokets);
$strokets=str_replace("[nds]" , ($okr*(round($taxes[$_SESSION["user_currency"]]*(($okr*round($item['price']*$kurs/$okr))*$item['qty'])/$okr)))."[valut] (". (100*$taxes[$_SESSION["user_currency"]])."%)", $strokets);
$strokets=str_replace("[valut]" , $currencies_sign[$_SESSION["user_currency"]], $strokets);

$stroket.=$strokets;
 $nnum+=1;
 $sqrp="/$out_c[11]";

if (("$out_c[11]"=="0")||($out_c[11]=="")) {$out_c[11]=$lang['pcs'];$sqrp="";}else {$sqrpf=1;}
$strokets=str_replace("[pcs]" , $out_c[11], $strokets);
$wh="";
if ($out_c[9]!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"", str_replace($htpath,"", strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$out_c[9]),"src=")."src=","", stripslashes(@$out_c[9]))),">")," ")));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){

$imagesz = @getimagesize(".$fi");
if (($imagesz[1]/2)>doubleval($style['hh'])) {
$kkd1= (($imagesz[1]/2)/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/($kkd1*2))." height=".ceil(($imagesz[1])/($kkd1*2))." ";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$out_c[9]=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img". $wh ." ",stripslashes(@$out_c[9]))));


$out_c[9]=str_replace("<img ", "<img vspace=3 hspace=10 ",  stripslashes(@$out_c[9]));

@$out_c[9]=str_replace("border=0", "border=0 align=left", @$out_c[9]);

} else {
$out_c[9]="<img src=\"".$image_path."/no_photo.gif\" border=0 width=".$style['ww']." height=".$style['hh'].">";

}
$out_c[9]=str_replace("width= height= ", "", $out_c[9]);

    $basout .="<table border=\"0\" cellspacing=\"0\" cellpadding=\"4\"><tr><td valign=top align=center><a href=\"$htpath/index.php?unifid=".md5($item['info'])."&flag=".$item['flag']."\">".@$out_c[9]."</a></td><td valign=top align=left width=100%>";
    //$basout .= "<small><b>".$lang['id'].":</b> ".$item['id']."<br>";
    if ($hidart==0) {
    $basout .= "<b>".$lang['info'].":</b> <a href=\"$htpath/index.php?unifid=".md5($item['info'])."&flag=".$item['flag']."\">".$item['info']."</a> ".$item['options']."<br>";
    $wishn=$item['info'];

    } else {
    $itid=strtoupper(substr(md5( str_replace(" ID:", "", str_replace(strtoken ($item['info'], " ID:") , "" , $item['info'])).$artrnd), -7));
    $basout .= "<a href=\"$htpath/index.php?unifid=".md5($item['info'])."&flag=".$item['flag']."\">".strtoken($item['info'],"*")." ".$itid."</a> ".$item['options']."<br>";
    $wishn=strtoken($item['info'],"*");
     }
    if (!isset($wishm[$wishn])){$wishm[$wishn]="";}
    if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i",$wishm[$wishn])) { $wishm[$wishn]="";}
    if ($wishm[$wishn]!="") {
    $basout .= "<b>".$lang[77].":</b> ". $wishm[$wishn];
    }
    $basout .= "<br><b>".$lang['qty'].":</b> ";
    $basout .=$item['qty'];
    $basout .= " ".$out_c[11]." <br>";
    if ($use_weight==1) {
    $basout .= "<b>".$lang['weight'].":</b> ".$item['weight']."$kg<br>"; }
    if ($use_volume==1) {
    $basout .= "<b>".$lang['volume'].":</b> ".$item['volume']."$vol<br>"; }
    if ($item['price']>0) {
    $basout .= "<b>".$lang['price'].":</b> ".($okr*(round($kurs*$item['price']/$okr)))." ".$currencies_sign[$_SESSION["user_currency"]]."$sqrp $prski<br>";
    }
    $zaksum+=$item['price'];
    if($item['qty']!=1) {
    if ($item['price']>0) {$basout .= "<b>".$lang['subtotal'].":</b> ".(($okr*round($item['price']*$kurs/$okr))*$item['qty'])." ".$currencies_sign[$_SESSION["user_currency"]]."<br>";
    }
    if ($use_weight==1) {$basout .= "<b>".$lang['subtotalweight'].":</b> ".$item['subtotalweight']."$kg<br>";}
    if ($use_volume==1) {$basout .= "<b>".$lang['subtotalvolume'].":</b> ".$item['subtotalvolume']."$vol<br>";}
    }

    $basout .= "</small></td></tr><tr><td colspan=2><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"></td></tr></table>";

    //for sms
    $basket_opt+=($item['qty']*(0.01*(round($optkurs*$out_c[5]/(0.01*$kurs)))));
    $basket_ttl+=(($okr*round($item['price']*$kurs/$okr))*$item['qty']);
    $basket_poz+=$item['qty'];
    $smsout .= substr($item['info'],0, 10)." ".str_replace("ID:", "", stristr($item['info'], "ID:"));
    $smsout .= "-".($okr*(round($kurs*$item['price']/$okr)))."".$currencies_sign[$_SESSION["user_currency"]];
    $smsout .= "-".$item['qty'].";";

  }

if($summaout<$currencies_zakaz_menee[$valut]){$basket_ttl+=$zakaz_do_stavka;}

$boundary = uniqid( "");



srand ((double) microtime() * 1000000);
$randval = rand();
$datnow = date("Y_F_d___H_i_s");
$now = date("d.m.Y H:i:s ");

$file = fopen ("./admin/baskets/number.txt", "r");
if (!$file) {
echo "<p> Error reading file <b>./admin/baskets/number.txt</b>.\n";
exit;
}
while (!feof ($file)) {
$line = fgets ($file, 1024);
if (preg_match("/&nomer=(.*)/i", $line, $out)) {
$nomer = $out[1];
break;
}
}
fclose ($file);
// Переведем его в число, прибавим 1 и запишем обратно
settype ($nomer , "integer");
$nomer += 1;
$file = fopen ("./admin/baskets/number.txt", "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> Error opening file <b>./admin/baskets/number.txt</b> to save.\n";
exit;
}
fputs ($file, "&nomer=$nomer\n");flock ($file, LOCK_UN);
fclose ($file);
$prenaz = $datnow . "__" . $randval . "__" .$nomer .".html";
$nazv = "./admin/baskets/" . $prenaz;

if ($wishlist==1) { $ddost="";}   else {
if($summaout<$currencies_zakaz_menee[$valut]){$ditogo=$summaout+$zakaz_do_stavka; $smsdost=""; $ddost="";}else{ if ($dost_naim2!="") { $ddost="$dost_naim2".$currencies_zakaz_menee[$valut]." ".$currencies_sign[$_SESSION["user_currency"]]."</small>";} else {$ddost="";} $smsdost=" ".$summaout." ".$currencies_sign[$_SESSION["user_currency"]]."";}
if ($view_freedeliveryicon==0) {$ddost="";}
}
if (count($wishm2)>0) {
	$ddost.="<br><br><table border=0 style=\"border: 1px solid $nc4\" cellpadding=5 cellspacing=5>";
while (list($kwkey,$kwval)=each($wishm2)) {
  $kwval=($okr*(round($kurs*$kwval/$okr)));
  $ddost.= "<tr><td><b>$kwkey</b></td><td>$kwval ".$currencies_sign[$_SESSION["user_currency"]]."</td></tr>\n";
  	}
  	$ddost.="</table><br>";
    }
$smsbody=translit("$nomer $gorod $smsout $fio ".str_replace("-", "", str_replace("-", " ",$tel))." $metro $street $house"." "."$korp"." "."$ofice"."/"."$flat"."/"."$domophone $other");
$x0004="";
if ((@file_exists("$base_loc/content/x0004.txt")==TRUE)&&($view_agreement==1)) {
$agreement = fopen ("$base_loc/content/x0004.txt" , "r");
$agree_content = fread($agreement, filesize("$base_loc/content/x0004.txt"));
if (preg_match("/==(.*)==/i", $agree_content, $outputdd)) {
$agree_title=$outputdd[1];
} else {
$agree_title = $lang[347];
}
fclose ($agreement);

$x0004= str_replace("==$agree_title==", "" , "<h4>$agree_title</h4><br>$agree_content");
unset ($agree_content, $agree_title, $agreement);
}




if (isset($reg_as)) { if($setregid[$regid]>1) {
$house=doubleval($house);
if (isset($property_mode[$house])) {$prop=@strtoken(@$property_mode[$house],"|")." "; $house="";}
}
$x0006="";

if (@file_exists("$base_loc/content/x0006.txt")==TRUE) {
$agreement = fopen ("$base_loc/content/x0006.txt" , "r");
$agree_content = fread($agreement, filesize("$base_loc/content/x0006.txt"));
if (preg_match("/==(.*)==/i", $agree_content, $outputdds)) {
$agree_title=$outputdds[1];
} else {
$agree_title = $lang[347];
}
fclose ($agreement);

$x0006= str_replace("==$agree_title==", "" , "$agree_content");
unset ($agree_content, $agree_title, $agreement);
}

if (@$details[1]!="") {$x0006="";}
$zakbody="$x0006<font face=Verdana size=2><h4>".$lang[244]." $nomer (". date("d.m.Y (D) H:i:s ") . ")</h4>
<b>".$lang[76].":</b> \"".@$details[1]."\"<br>
<b>".$lang[77].":</b> $fio /
<b>".$lang[73].":</b>  $country"." +".$countrycode."<font size=3>(".$telcode.")"."$tel</font><br>
<b>Email:</b> $email<br>
<b>".$lang[72].":</b>  $gorod<br>";
$pprop="$prop";


if ($pprop=="0") {$prop="";}
if (($metro!="")&&($metro!="-")) { $zakbody .="<b>".$lang[61].":</b> "."$metro<br>"; }
if (($street!="")&&($street!="-")) { $zakbody .=" <b>".$lang[71].":</b> $street"." $street2 /"; }
if (($house!="")&&($house!="-")) { $zakbody .="<b>".$lang[68].":</b> $house /"; }
if (($korp!="")&&($korp!="-")) { $zakbody .="<b>".$lang[67].":</b> $korp /"; }
if (($ofice!="")&&($ofice!="-")) { $zakbody .="<b>".$lang[65].":</b> $ofice /"; }
if (($pod!="")&&($pod!="-")) { $zakbody .="<b>".$lang[66].":</b> $pod /"; }
if (($flat!="")&&($flat!="-")) { $zakbody .="<b>".$lang[64].":</b> $flat /"; }
if (($domophone!="")&&($domophone!="-")) { $zakbody .="<b>".$lang[69].":</b> $domophone<br>"; }
if (($other!="")&&($other!="-")) { $zakbody .="<b>".$lang[28].":</b>$other<br>"; }
$zakbody .="$ffus
<div class=\"noprint\"> <h4>".$lang[348]."</h4></div>
$basout<br>";
if ($tovout>0) {
$zakbody .=$lang[350].": <b>$stuks</b><br>".$lang[32].": <b>$tovout</b> <br><br>";
}


if ($use_weight==1) {$zakbody.="<b>".$lang['totalweight'].":</b> ".$totalweight."$kg<br>";}
if ($use_volume==1) {$zakbody.="<b>".$lang['totalvolume'].":</b> ".$totalvolume."$vol<br>";}

if ($summaout>0) {
$zakbody.="<b>".$lang[33].":</b> ".$summaout." ".$currencies_sign[$_SESSION["user_currency"]]."$ddost<br>$zdost";
}
$zakbody.="<div class=\"noprint\"><br>$x0004<br></div>
<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\"><br>
</font>";
$emailbody = "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>".$lang[244]." $nomer (". date("d.m.Y (D) H:i:s ") . ")</title>
<style>
@media print {

.noprint {
display: none;
}

}
</style>
</head>
<body>
$zakbody
";


$verifylist="<b>".$lang[323]."!</b><br><br><font color=#468847><b>".$lang[326]." <font size=4>$nomer</font>  [". date("d.m.Y") . "]</b></font><br><br>".$lang[327]."<br><br>
$x0006<h4>".$lang[244]." $nomer ". date("d.m.Y / H:i") . "</h4>

<h4>".$lang[28]."</h4>
$basout
<br>";
if ($tovout>0) {
$verifylist.=$lang[350].": <b>$stuks</b><br>".$lang[32].": <b>$tovout</b> <br><br>";
} else {
$verifylist.="<br>";
}
$zakbody .="<br><br>";
if ($use_weight==1) {$verifylist.="<b>".$lang['totalweight'].":</b> ".$totalweight."$kg<br>"; }
if ($use_volume==1) {$verifylist.="<b>".$lang['totalvolume'].":</b> ".$totalvolume."$vol<br>"; }
if ($summaout>0) {$verifylist.="<b>".$lang[33].":</b> ".$summaout." ".$currencies_sign[$_SESSION["user_currency"]]." $ddost<br>$zdost"; }
$verifylist.="<br><br><small>".$lang[352]."</small>";
$verify_title=$lang[43];

//added 6.02.2006







$kv_i="./templates/$template/$speek/invoice.inc";
if (@file_exists($kv_i)==TRUE) {
$fpk2=fopen($kv_i, "r");
if (!$fpk2) {echo "<br>File $kv_i not found! Invoice saving error.<br>";} else {
$kvit_i = fread($fpk2, filesize($kv_i));
fclose ($fpk2);
@chmod ($kv_i, 0666);
$stroketab2 = ExtractString($kvit_i, "<!--[tr]-->", "<!--[/tr]-->");

$stroket2="";
//module invoice
$nn=1;
$items=$cart->get_all();
foreach($items as $item) {
$out_c=explode("|", $item['base']);
$strokets2=str_replace("[num]" , "$nn", $stroketab2);
$strokets2=str_replace("[art]" , $out_c[6], $strokets2);

if ($hidart==1) {
$itid=strtoupper(substr(md5($out_c[6].$artrnd), -7));
$strokets2=str_replace("[desc]" , strtoken($out_c[3],"*")." $itid", $strokets2);
} else {
$strokets2=str_replace("[desc]" , $out_c[3], $strokets2);
}
@reset($refus);
while (list ($re_num, $re_line) = @each ($refus)) {
$strokets2=str_replace("[".$re_num."]" , $re_line, $strokets2);
}
$strokets2=str_replace("[qty]" , $item['qty'], $strokets2);
$strokets2=str_replace("[prop]" , $prop, $strokets2);
$strokets2=str_replace("[metro]" , $metro, $strokets2);
$strokets2=str_replace("[price]" , ($okr*(round($kurs*$item['price']/$okr))), $strokets2);
$strokets2=str_replace("[total]" , (($okr*round($item['price']*$kurs/$okr))*$item['qty']), $strokets2);
$strokets2=str_replace("[weight]" , $item['weight'].$kg, $strokets2);
$strokets2=str_replace("[subtotalweight]" , $item['subtotalweight'].$kg, $strokets2);
$strokets2=str_replace("[volume]" , $item['volume'].$vol, $strokets2);
$strokets2=str_replace("[subtotalvolume]" , $item['subtotalvolume'].$vol, $strokets2);
$strokets2=str_replace("[nds]" , ($okr*(round($taxes[$_SESSION["user_currency"]]*(($okr*round($item['price']*$kurs/$okr))*$item['qty'])/$okr)))."[valut] (". (100*$taxes[$_SESSION["user_currency"]])."%)", $strokets2);
$strokets2=str_replace("[valut]" , $currencies_sign[$_SESSION["user_currency"]], $strokets2);
if (("$out_c[11]"=="0")||($out_c[11]=="")) {$out_c[11]=$lang['pcs'];$sqrp="";}
$strokets2=str_replace("[pcs]" , $out_c[11], $strokets2);
$stroket2.=$strokets2;
  $nn+=1;
  }
/* Запись инвойса в HTML - файл */

$prenaz_i =  "inv_".$nomer .".html";
$nazv_i = "./admin/invoices/" . $prenaz_i;
/* Теперь запишем заказ в файл в папке zakazi */

/* Конец записи в файл, отправка на почту и вывод файла на экран*/

$kvit_i=str_replace("$stroketab2",$stroket2, $kvit_i);
$kvit_i=str_replace("[shop_tel]" , $telef, $kvit_i);
$kvit_i=str_replace("[delivery_type]" , $selectsd, $kvit_i);
$kvit_i=str_replace("[prop]" , $prop, $kvit_i);
$kvit_i=str_replace("[metro]" , $metro, $kvit_i);
$kvit_i=str_replace("[payment_type]" , $selectpm, $kvit_i);
$kvit_i=str_replace("[delivery_cost]" , ($totulus-$summaout), $kvit_i);
$kvit_i=str_replace("[tax]" ,($okr*(round($taxes[$_SESSION["user_currency"]]*$summaout/$okr))), $kvit_i);
$kvit_i=str_replace("[taxrate]" ,($taxes[$_SESSION["user_currency"]]*100)."%", $kvit_i);
$kvit_i=str_replace("[kg]" , $kg, $kvit_i);
$kvit_i=str_replace("[date]" , date("d.m.y", time()), $kvit_i);
$kvit_i=str_replace("[shopname]" , $shop_name, $kvit_i);
$kvit_i=str_replace("[shopadress]" , $oficial_adress, $kvit_i);
$kvit_i=str_replace("[poluchatel]" , $lang['poluchatel'], $kvit_i);
$kvit_i=str_replace("[rs]" , $lang['rs'], $kvit_i);
$kvit_i=str_replace("[bank]" , $lang['bank'], $kvit_i);
$kvit_i=str_replace("[bik]" , $lang['bik'], $kvit_i);
$kvit_i=str_replace("[ks]" , $lang['ks'], $kvit_i);
$kvit_i=str_replace("[fio]" , $fio, $kvit_i);
$kvit_i=str_replace("[adres]" , "$gorod $street"." $street2, $house"." "."$korp"." "."$ofice", $kvit_i);
$kvit_i=str_replace("[nums]" , "$nomer", $kvit_i);
$kvit_i=str_replace("[summa]" , "$totulus", $kvit_i);
$kvit_i=str_replace("[valut]" , "".$currencies_sign[$_SESSION["user_currency"]]."", $kvit_i);
$kvit_i=str_replace("[gorod]" , "$gorod", $kvit_i);
$kvit_i=str_replace("[street]" , "$street"." $street2", $kvit_i);
$kvit_i=str_replace("[house]" , "$house", $kvit_i);
$kvit_i=str_replace("[korp]" , "$korp", $kvit_i);
$kvit_i=str_replace("[ofice]" , "$ofice", $kvit_i);
$kvit_i=str_replace("[country]" , "$country", $kvit_i);
$kvit_i=str_replace("[countrycode]" , "$countrycode", $kvit_i);
$kvit_i=str_replace("[telcode]" , "$telcode", $kvit_i);
$kvit_i=str_replace("[tel]" , "$tel", $kvit_i);
$kvit_i=str_replace("[other]" , "$other", $kvit_i);
$kvit_i=str_replace("[totalweight]" , "$totalweight", $kvit_i);
$kvit_i=str_replace("[totalvolume]" , "$totalvolume", $kvit_i);
$kvit_i=str_replace("[email]" , "$email", $kvit_i);
$kvit_i=str_replace("[lang]" , "$speek", $kvit_i);
@reset($refus);
while (list ($re_num, $re_line) = @each ($refus)) {
$kvit_i=str_replace("[".$re_num."]" , $re_line, $kvit_i);
}
//echo $kvit_i;
$verifylist.="<br><br>".$lang[354]." (#$nomer ". date("d.m.Y (D) H:i") . ")<br><br>";


$file_i = fopen ($nazv_i, "w");
if (!$file_i) {
echo "<p> Error opening <b>$nazv_i</b> for writing.\n";
exit;
}
fputs ($file_i, "<!DOCTYPE html><html><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><body>$kvit_i</body></html>\n");
fclose ($file_i);
}
}








$print_basket=$lang[40]."!";
//end

$file = fopen ($nazv, "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> ".$lang[44]." <b>$nazv</b> ".$lang[45].".\n";
exit;
}
fputs ($file, "$emailbody</body></html>\n");flock ($file, LOCK_UN);
fclose ($file);
chmod ($nazv, 0666);
reset($arr2);
while (list ($line_num, $a) = each ($arr2)) {
if (isset($$a)) {
	$$a = strip_tags($$a);
$$a = substr($$a, 0, 200);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "", $$a);
$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);
$$a = str_replace(chr(10) , "", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
} else {$$a="";}
}
$basket_dost=$discont1+$discont2;
//Теперь внесем в list.txt строчку таблички
$zay="504";
if (!isset($postpost[$sd])) {$postpost[$sd]="";}
if ($postpost[$sd]=="post") {$zay="505";}
$ssttaaggss=str_replace("|","", @$_SESSION["sfrom"]." / ".@$_SESSION["stag"]);
$ssttaaggss="<b><a href=$htpath/index.php?action=view_users&filter=".$details[1].">".$details[1]."</a></b> ".$details[6]." -&gt; $ssttaaggss";
$stroke ="$nomer|/admin/baskets/$prenaz|$email|$fio|<b>".
@$_SESSION["partner_id"]."</b> $country <font size=1>$gorod</font> +$countrycode($telcode)$tel<br><font size=1>$street"." $street2, $house"." "."$korp"." "."$ofice</font>| "."$metro|$now<br>".str_replace("|", " ",
@$_SERVER['REMOTE_ADDR'])."<br>".@$_SERVER['REMOTE_ADDR']."<br>".$ssttaaggss." / ".$mpz['time'].": " .gmdate("H:i:s", (time()-$_SESSION["stime"]))."|".str_replace(",",".", (0.01*round(($totulus/$kurs)/0.01)))."|".str_replace(",",".", $basket_opt)."|".str_replace(",",".", (0.01*round(($basket_dost/$kurs)/0.01)))."|$zay|".
@$details[1]."|||".
@$posturl[$sd]."|".
@$postname[$sd]."|\n";
$listname = ("./admin/baskets/list.txt");
$file = fopen ("./admin/baskets/list.txt", "r");
if (!$file) {
echo "<p> Error reading file <b>./admin/baskets/list.txt</b>.\n";
exit;
}
$html= fread ($file, @filesize ($listname));
fclose($file);
$file = fopen ("./admin/baskets/list.txt", "w");
if (!$file) {
echo "<p> Error openning file <b>./admin/baskets/list.txt</b> to save\n";
exit;
}
fputs ($file, "$stroke$html");
fclose ($file);

if (@$details[1]!=""){
if (is_dir ("./admin/userstat/".@$details[1])==FALSE) {
//первый заказ
mkdir ("./admin/userstat/".@$details[1]);
}

$nazv="./admin/userstat/".@$details[1]."/$nomer.txt";
$file = fopen ($nazv, "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> ".$lang[44]." <b>$nazv</b> ".$lang[45].".\n";
exit;
}
fputs ($file, "$zakbody\n");flock ($file, LOCK_UN);
fclose ($file);

} else {
if (is_dir ("./admin/userstat/_")==FALSE) {
//первый заказ
mkdir ("./admin/userstat/_");
}

$nazv="./admin/userstat/_/$nomer.txt";
$file = fopen ($nazv, "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> ".$lang[44]." <b>$nazv</b> ".$lang[45].".\n";
exit;
}
fputs ($file, "$zakbody\n");flock ($file, LOCK_UN);
fclose ($file);
}


echo "<!-- sending to shop mail -->";
//main partner actions
$partfile="./admin/partners/".md5($_SESSION["partner_id"]).".txt";
if (@file_exists("$partfile")==TRUE) {
$partmass=file($partfile);
$partner_mail=str_replace("\n", "", $partmass[1]);
echo str_replace("\&amp;", "\&", str_replace("^", "\n" ,str_replace("\n", "", $partmass[2])));
}
//eof main actions

//custom partner actions
require "./templates/$template/partner.inc";
// eof custom actions
if (($_SESSION["partner_id"]!="")&&($partner_mail!="")) {
@mail ("$partner_mail","Your Partner Order $nomer From: ". str_replace("http://","",$htpath). " To: $partner_mail", $emailbody."</body></html>\n", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
}
//Вносим в БД все реквизиты юзера
$bdtosave="<?php
\$userbd=Array (
'poluchatel'=>\"".$lang['poluchatel']."\",
'rs'=>\"".$lang['rs']."\",
'bank'=>\"".$lang['bank']."\",
'bik'=>\"".$lang['bik']."\",
'ks'=>\"".$lang['ks']."\",
'fio'=>\"".$fio."\",
'adres'=>\""."$gorod $street"." $street2, $house"." "."$korp"." "."$ofice"."\",
'nums'=>\""."$nomer"."\",
'summa'=>\""."$totulus"."\",
'valut'=>\""."".$currencies_sign[$_SESSION["user_currency"]].""."\",
'gorod'=>\""."$gorod"."\",
'street'=>\""."$street"." $street2"."\",
'house'=>\""."$house"."\",
'korp'=>\""."$korp"."\",
'ofice'=>\""."$ofice"."\",
'country'=>\""."$country"."\",
'countrycode'=>\""."$countrycode"."\",
'telcode'=>\""."$telcode"."\",
'tel'=>\""."$tel"."\",
'totalweight'=>\""."$totalweight"."\",
'totalvolume'=>\""."$totalvolume"."\",
'email'=>\""."$email"."\",
'shopname'=>\"".$shop_name."\",
'shopadress'=>\"".$oficial_adress."\",
'delivery_type'=>\"".$selectsd."\",
'payment_type'=>\"".$selectpm."\",
'prop'=>\"".$prop."\",
'metro'=>\"".$metro."\",
'delivery_cost'=>\"".($totulus-$summaout)."\",
'tax'=>\"".($okr*(round($taxes[$_SESSION["user_currency"]]*$summaout/$okr)))."\",
'taxrate'=>\"".($taxes[$_SESSION["user_currency"]]*100)."%"."\",
'kg'=>\"". $kg."\",
'other'=>\"". str_replace("\"","\\\"", str_replace("\n", "<br>",str_replace("\r", "<br>",$other)))."\",
'stroketab'=>\"".str_replace("\"","\\\"", $stroket)."\",
";
@reset($refus);
while (list ($re_num, $re_line) = @each ($refus)) {
$bdtosave.="'".$re_num."'=>"."\"".$re_line."\",
";
}
$bdtosave.=");
?>";
if (is_dir ("./admin/baskets/db")==FALSE) {
mkdir ("./admin/baskets/db");
}
$nazv="./admin/baskets/db/$nomer.txt";
$file = fopen ($nazv, "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> ".$lang[44]." <b>$nazv</b> ".$lang[45].".\n";
exit;
}
fputs ($file, "$bdtosave");flock ($file, LOCK_UN);
fclose ($file);

//Квитанция СБ
$kvit_c=str_replace("[shop_tel]" , $telef, $kvit_c);
$kvit_c=str_replace("[prop]" , $prop, $kvit_c);
$kvit_c=str_replace("[metro]" , $metro, $kvit_c);
$kvit_c=str_replace("[delivery_type]" , $selectsd, $kvit_c);
$kvit_c=str_replace("[payment_type]" , $selectpm, $kvit_c);
$kvit_c=str_replace("[delivery_cost]" , ($totulus-$summaout), $kvit_c);
$kvit_c=str_replace("[tax]" ,($okr*(round($taxes[$_SESSION["user_currency"]]*$summaout/$okr))), $kvit_c);
$kvit_c=str_replace("[taxrate]" ,($taxes[$_SESSION["user_currency"]]*100)."%", $kvit_c);
$kvit_c=str_replace("[kg]" , $kg, $kvit_c);
$kvit_c=str_replace("[date]" , date("d.m.y", time()), $kvit_c);
$kvit_c=str_replace("$stroketab",$stroket, $kvit_c);
$kvit_c=str_replace("[shopname]" , $shop_name, $kvit_c);
$kvit_c=str_replace("[shopadress]" , $oficial_adress, $kvit_c);
$kvit_c=str_replace("[poluchatel]" , $lang['poluchatel'], $kvit_c);
$kvit_c=str_replace("[rs]" , $lang['rs'], $kvit_c);
$kvit_c=str_replace("[bank]" , $lang['bank'], $kvit_c);
$kvit_c=str_replace("[bik]" , $lang['bik'], $kvit_c);
$kvit_c=str_replace("[ks]" , $lang['ks'], $kvit_c);
$kvit_c=str_replace("[fio]" , $fio, $kvit_c);
$kvit_c=str_replace("[adres]" , "$gorod $street"." $street2, $house"." "."$korp"." "."$ofice", $kvit_c);
$kvit_c=str_replace("[nums]" , "$nomer", $kvit_c);
$kvit_c=str_replace("[summa]" , "$totulus", $kvit_c);
$kvit_c=str_replace("[valut]" , "".$currencies_sign[$_SESSION["user_currency"]]."", $kvit_c);
$kvit_c=str_replace("[gorod]" , "$gorod", $kvit_c);
$kvit_c=str_replace("[street]" , "$street"." $street2", $kvit_c);
$kvit_c=str_replace("[house]" , "$house", $kvit_c);
$kvit_c=str_replace("[korp]" , "$korp", $kvit_c);
$kvit_c=str_replace("[ofice]" , "$ofice", $kvit_c);
$kvit_c=str_replace("[country]" , "$country", $kvit_c);
$kvit_c=str_replace("[countrycode]" , "$countrycode", $kvit_c);
$kvit_c=str_replace("[telcode]" , "$telcode", $kvit_c);
$kvit_c=str_replace("[tel]" , "$tel", $kvit_c);
$kvit_c=str_replace("[other]" , "$other", $kvit_c);
$kvit_c=str_replace("[totalweight]" , "$totalweight", $kvit_c);
$kvit_c=str_replace("[totalvolume]" , "$totalvolume", $kvit_c);
$kvit_c=str_replace("[email]" , "$email", $kvit_c);
$kvit_c=str_replace("[lang]" , "$speek", $kvit_c);
@reset($refus);
while (list ($re_num, $re_line) = @each ($refus)) {
$kvit_c=str_replace("[".$re_num."]" , $re_line, $kvit_c);
}
//$kvit_c=str_replace("[index]" , "$ofice", $kvit_c);
//echo $kvit_c;
unset ($fpk);
$kv_f="./admin/kvit/$nomer.htm";
$fpk=fopen($kv_f, "w");
fputs ($fpk, $kvit_c);
fclose ($fpk);
}

//END квитанция СБ
echo "<!-- sending to client -->";

$tmp_sms=explode(",",$sms_mail);
reset ($tmp_sms);
while (list ($key_sms, $val_sms) = each ($tmp_sms)) {
if ($val_sms!=""){
echo "<!-- sending $key_sms sms message to sms number -->";

$bound_sms="From: \"E$key_sms\" <$nomer@".str_replace("/","", str_replace("http://", "", str_replace($shopdir, "", $htpath))).">
Date: ". date("D, d M Y (D) H:i:s ") . " +0400
MIME-Version: 1.0
Content-Type: text/plain;
        charset=\"koi8-r\"\nContent-Transfer-Encoding: 8bit
Boundary: " . uniqid( "");

@mail ("$val_sms","", "$smsbody", "$bound_sms");
$_SESSION["user_noregs"]=="no";
}
}

//Оплата
$tmptmp=explode("|", $payment_metode[$pm]);
if (($tmptmp[3]!="")&&($tmptmp[3]!="\n")) {
//указан файл обработки оплаты
if (substr($tmptmp[3],-4)!=".php") {
//указан текстовый файл

if (@file_exists("$base_loc/content/".$tmptmp[3].".txt")==TRUE) {
$pmm = fopen ("$base_loc/content/".$tmptmp[3].".txt" , "r");
$pm_content = fread($pmm, filesize("$base_loc/content/".$tmptmp[3].".txt"));
if (preg_match("/==(.*)==/i", $pm_content, $outputdd)) {
$pm_title=$outputdd[1];
} else {
$pm_title = $lang[347];
}
fclose ($pmm);

$pm_content= str_replace("==$pm_title==", "" , "<h4>$pm_title</h4><br>$pm_content");

}
$pm_content=str_replace("[shop_tel]" , $telef, $pm_content);
$pm_content=str_replace("[delivery_type]" , $selectsd, $pm_content);
$pm_content=str_replace("[prop]" , $prop, $pm_content);
$pm_content=str_replace("[payment_type]" , $selectpm, $pm_content);
$pm_content=str_replace("[delivery_cost]" , ($totulus-$summaout), $pm_content);
$pm_content=str_replace("[tax]" ,($okr*(round($taxes[$_SESSION["user_currency"]]*$summaout/$okr))), $pm_content);
$pm_content=str_replace("[taxrate]" ,($taxes[$_SESSION["user_currency"]]*100)."%", $pm_content);
$pm_content=str_replace("[kg]" , $kg, $pm_content);
$pm_content=str_replace("[date]" , date("d.m.y", time()), $pm_content);
$pm_content=str_replace("[poluchatel]" , $lang['poluchatel'], $pm_content);
$pm_content=str_replace("$stroketab",$stroket, $pm_content);
$pm_content=str_replace("[shopname]" , $shop_name, $pm_content);
$pm_content=str_replace("[shopadress]" , $oficial_adress, $pm_content);
$pm_content=str_replace("[rs]" , $lang['rs'], $pm_content);
$pm_content=str_replace("[bank]" , $lang['bank'], $pm_content);
$pm_content=str_replace("[bik]" , $lang['bik'], $pm_content);
$pm_content=str_replace("[ks]" , $lang['ks'], $pm_content);
$pm_content=str_replace("[fio]" , $fio, $pm_content);
$pm_content=str_replace("[adres]" , "$gorod $street"." $street2, $house"." "."$korp"." "."$ofice", $pm_content);
$pm_content=str_replace("[nums]" , "$nomer", $pm_content);
$pm_content=str_replace("[summa]" , "$totulus", $pm_content);
$pm_content=str_replace("[valut]" , "".$currencies_sign[$_SESSION["user_currency"]]."", $pm_content);
$pm_content=str_replace("[gorod]" , "$gorod", $pm_content);
$pm_content=str_replace("[street]" , "$street"." $street2", $pm_content);
$pm_content=str_replace("[house]" , "$house", $pm_content);
$pm_content=str_replace("[korp]" , "$korp", $pm_content);
$pm_content=str_replace("[ofice]" , "$ofice", $pm_content);
$pm_content=str_replace("[country]" , "$country", $pm_content);
$pm_content=str_replace("[countrycode]" , "$countrycode", $pm_content);
$pm_content=str_replace("[telcode]" , "$telcode", $pm_content);
$pm_content=str_replace("[tel]" , "$tel", $pm_content);
$pm_content=str_replace("[other]" , "$other", $pm_content);
$pm_content=str_replace("[totalweight]" , "$totalweight", $pm_content);
$pm_content=str_replace("[totalvolume]" , "$totalvolume", $pm_content);
$pm_content=str_replace("[email]" , "$email", $pm_content);
$pm_content=str_replace("[lang]" , "$speek", $pm_content);
$pm_content=str_replace("[sumpropis]" , num2str(doubleval($summaout)), $pm_content);
reset($refus);
while (list ($re_num, $re_line) = each ($refus)) {
$pm_content=str_replace("[".$re_num."]" , $re_line, $pm_content);
}





$f2savename= $nomer."_".$boundary."_".md5($nomer);
$checkfile="./userdir/$f2savename".".htm";
$fp=fopen($checkfile,"w");
fputs($fp,$pm_content);
fclose ($fp);
$pm_link="<br><br><b><font size=3>".$lang[106].": <a href=\"$htpath/userdir/$f2savename".".htm\">$pm_title $nomer</a></font></b><br><br>";
$verifylist.="$pm_link";
$ppps=1;
} else {
//указана PHP-обработка
if (@file_exists("./payment_modules/".$tmptmp[3])==TRUE) {
$verify_title=$tmptmp[0];
$verifylist="<h4>".$lang[244]." $nomer ". date("d.m.Y (D) H:i") . "</h4>
";
if ($use_weight==1) {$verifylist.="<b>".$lang['totalweight'].":</b> ".$totalweight."$kg<br>";}
if ($use_volume==1) {$verifylist.="<b>".$lang['totalvolume'].":</b> ".$totalvolume."$vol<br>";}
if ($summaout>0) {
$verifylist.="<b>".$lang[33].":</b> ".$summaout." ".$currencies_sign[$_SESSION["user_currency"]]."$ddost<br>$zdost<br>";
}

require "./payment_modules/".$tmptmp[3];

$pm_link=$checkout;
$ppps=2;

}
}


}

$checkfile="./admin/orderstatus/$nomer.htm";
$fp=fopen($checkfile,"w");
fputs($fp,$pm_link);
fclose ($fp);

if ($ppps==2) {$pm_link="<h1><a href=\"$htpath/index.php?action=cabinet\">".$lang[520]." $totulus $valut</a> (".$lang[380].")</h1><br><br>";}

$cart->empty_cart();
mail ("$email","Order $nomer From: $shop_mail To: $email", $emailbody.$pm_link."</body></html>\n", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
mail ("$shop_mail","Order $nomer From: $shop_mail To: $email", $emailbody.$pm_link."</body></html>\n", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");

}

}




//wishlist
}
}
}
if($errs!=""):  $action="zakaz"; endif;
//wishlist

?>
