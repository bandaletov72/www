<?php
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
//function parser
$fz=1;
set_time_limit(600);
function detect_utf($Str) {
 for ($i=0; $i<strlen($Str); $i++) {
  if (ord($Str[$i]) < 0x80) $n=0; # 0bbbbbbb
  elseif ((ord($Str[$i]) & 0xE0) == 0xC0) $n=1; # 110bbbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xE0) $n=2; # 1110bbbb
  elseif ((ord($Str[$i]) & 0xF0) == 0xF0) $n=3; # 1111bbbb
  else return false; # Does not match any model
  for ($j=0; $j<$n; $j++) { # n octets that match 10bbbbbb follow ?
   if ((++$i == strlen($Str)) || ((ord($Str[$i]) & 0xC0) != 0x80)) return false;
  }
 }
 return true;
}



$d=$_GET['d'];
function utf8_win ($s){
$out="";
$c1="";
$byte2=false;
for ($c=0;$c<strlen($s);$c++){
$i=ord($s[$c]);
if ($i<=127) $out.=$s[$c];
if ($byte2){
$new_c2=($c1&3)*64+($i&63);
$new_c1=($c1>>2)&5;
$new_i=$new_c1*256+$new_c2;
if ($new_i==1025){
$out_i=168;
}else{
if ($new_i==1105){
$out_i=184;
}else {
$out_i=$new_i-848;
}
}
$out.=chr($out_i);
$byte2=false;
}
if (($i>>5)==6) {
$c1=$i;
$byte2=true;
}
}
return $out;
}
$fold="."; require ("./templates/lang.inc");
if (!isset($speek)) {
$speek=$language;
} else {
$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($speek==$stl){
$found_lang=1;
}
}
if ($found_lang==0){
$speek=$language;
}
}
$s=$d;
require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
$rep=Array (
"<dl class=\"itemNewProductsDefault\">",
"<dt class=\"itemImage\">",
"<a href=\"http://www.stariymaster.com/product_info.php?products_id=",
"\"><img src=\"images/product_images/thumbnail_images/",
"<dd class=\"itemDescription\">",
"\" /></a><br /><a href=\"http://www.stariymaster.com/index.php?action=buy_now&BUYproducts_id=",
"<a href=\"http://www.stariymaster.com/popup_content.php?coID=1\" target=\"_blank\" onclick=\"window.open(",
"\"><img src=\"templates/vamshop/buttons/russian/button_buy_now.gif\" alt=\"Купить ",
"доставка",
"return false;",
"http://www.stariymaster.com/popup_content.php?coID=1",
"\" title=\" Купить ",
"\" title=\"",
"\" alt=\"",
"width=395,",
"height=320",
"popUp",
"toolbar=0",
"scrollbars=1",
"location=0",
"statusbar=0",
"menubar=0",
"resizable=1",
",",
"); ",
"\" width=\"90\" height=\"70\" /></a>",
"&cat=",
"<dd class=\"itemDescriptionPrice\">",
"</dd>",
"</dt>",
"</dl>",

);
while($s<($d+1000)) {
$s+=1;
$file="http://www.kr-presnya.ru/prod.php?prod=$s";
$n=1;
$f=fopen($file,"r");
if (!$file) {
echo "$file не могу открыть"; } else {
$qty=0;
$vit_qty=0;
$ff=0;
$tosave="";
$find=chr(0x09).chr(0x09)."шт".chr(0x09);   //ищем эту последовательность в строке для идентификации товара
$find2="=";   //убираем минимальный остаток
$find3=chr(0x09)."шт"; //Ищем в прайсе
$ff=0;
$zt="";
while(!feof($f)) {


$st=fgets($f);

// теперь мы обрабатываем очередную строку $st     |||||||
reset ($rep);
/*while (list ($key, $val) = each ($rep)) {
$st=str_replace($val, "|", $st);
}
*/

if (preg_match("/images/i",$st)) { $img=strip_tags(trim(trim(str_replace("<img src='","'>",str_replace("'>","", $st)))));
$type=substr($img,-3);
if ($type!="ba") {
@copy("http://www.kr-presnya.ru/$img","./photos2/".md5($img).".$type");
}
$zt="[img src=\"photos2/".md5($img).".$type\" border=0]|".$zt;}
$st=trim(strip_tags(str_replace("№","#",str_replace("<td valign=top align=left>","\n",
@$st
))));

if ($st!="") {
if (detect_utf($st)==TRUE) { $st=utf8_win($st);}

if (preg_match("/\|/", $st)) {
$st=str_replace(" | ","|", str_replace(" || ","|", $st));
$tmpm=explode("|", $st);
if (count($tmpm)==0) {$zt=""; }
if (count($tmpm)==4) {$st=$st."|";}
if (count($tmpm)==3) {$st=$st."||"; }
if (count($tmpm)==2) {$st=$st."|||"; }
$zt.=$st;
}
if (preg_match("/#/", $st)) {
$zt.=str_replace("&nbsp;"," ", str_replace(" |","|",str_replace("\n","|",str_replace("&nbsp;&nbsp;",": ", str_replace("Заказ","",str_replace("#","|№",$st))))))."|\n";
}


}
}
if (preg_match("/Артикул/i", $zt)) {
echo $zt;

//$zz[$ff]=$zt;
}
$ff+=1;
}
fclose ($f);
unset ($f);
unset ($out);
unset ($zz);
}

$tosave="";
?>
