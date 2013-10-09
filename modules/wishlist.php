<?php
$oldnc2=$nc2;
$nc2="#b94a48";
$zakerr="";
$necel="";
$fname=time();
$jscript= "\n";
$jscript.= "<script type=\"text/javascript\">
<!--
function CheckAll(obj)
{
aInputs = document.getElementsByTagName(\"input\");
for (var i=0; i<aInputs.length; i++)
{
oInput = aInputs[i];
if((oInput.type == \"checkbox\")&&(oInput.id!=\"checkall_all\"))
{
oInput.checked = obj.checked;
}
}
}

function SubmForm()
{
document.wishlist$fname".".wishzak.value=1;
document.wishlist$fname".".submit();
}
--></script>\n";
if ($usetheme==0) {
echo $jscript;
} else {
top("", "$jscript", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}

if (!isset($passok)){$passok="";} if (!preg_match("/^[0-9]+$/",$passok)) { $passok="";}
if (!isset($wishpass)){$wishpass="";} if (!preg_match("/^[0-9a-zA-z_]+$/i",$wishpass)) { $wishpass="";}
if (!isset($wishpassmd)){$wishpassmd="";} if (!preg_match("/^[0-9a-zA-z_]+$/i",$wishpassmd)) { $wishpassmd="";}
if ($wishpassmd==md5($details[$user_pass_complex])) {$wishpass=$details[$user_pass_complex];}


if (($wishpass==$details[$user_pass_complex])&&($details[$user_pass_complex]!="")) {
if (!isset($_SESSION["wishpass"])) {
//session_register ("wishpass");
$_SESSION["wishpass"]=@$details[$user_pass_complex];
}
if ($details[$user_pass_complex]==$_SESSION["wishpass"]) {
$wishpass=$details[$user_pass_complex];
}
}
if (($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/flag.txt")==TRUE)&&(isset($_SESSION["wishpass"]))&&(@$_SESSION["wishpass"]==@$details[$user_pass_complex])) {
unlink("./admin/userstat/".@$details[1]."/flag.txt");
}


if ($wishzak==1) {$cart->empty_cart(); }
 //очистим корзину
$korobok=0;
$minikorob=0;
$nedobor=0;
$nedoborkorob=0;
$total_vol=0;
$nedobor_vol=0;
//wishlist
if (($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/wishlist.txt")==TRUE)) {
if (($zak=="wishlist") || ($wishlist==1)) {
if (!isset($wsort)){$wsort="";} if (!preg_match("/^[0-9]+$/",$wsort)) { $wsort="";}
if ($wsort=="") {$wsort=0;}
$formout.="<p align=center><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">
<b>Список заявок, находящихся уже в совместном заказе:</b><br><br><input type=hidden name=\"zak\" value=\"wishlist\"><table border=0 cellspacing=0 cellpadding=4 width=100%><tr bgcolor=\"$nc6\"";
if ($gd==0) {$formout.=" style=\"filter:progid:DXImageTransform.Microsoft.Gradient (endColorstr='$nc0', startColorstr='$nc6', gradientType='0');\"";} else {$formout.=" background=\"grad.php?h=40&w=1&e=".str_replace("#","",$nc0)."&s=".str_replace("#","",$nc6)."&d=vertical\"";}
$formout.="><td align=center valign=top>";
if ($wsort==0) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist\">Дата</a></b></td><td align=center valign=top>";
if ($wsort==4) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=4\">".$lang['name']."</a></b></td><td align=center valign=top>";
if ($wsort==2) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=2\">".$lang['price']."</a></b></td><td align=center valign=top></td><td align=center colspan=3 valign=top><b>".$lang['qty']."<br><small>".$lang[218]."</small></b></td><td align=center valign=top>";
if ($wsort==3) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=3\">".$lang[217]."</a></b></td><td align=center valign=top><b>".$lang['qty']."<br><small>".$lang[215]."</small></b></td><td align=center valign=top>";
if ($wsort==1) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=1\">".$lang[77]."</a></b></td><td align=center valign=top><b>X</b></td></tr>";


if (@$details[1]!=""){
$totalwc=0;
if (is_dir ("./admin/userstat/".@$details[1])==FALSE) {
$formout.= "Вы еще ни разу не заказывали.<br>";
}
$nazv="./admin/userstat/".@$details[1]."/wishlist.txt";
if (@file_exists($nazv)==FALSE) {
$formout.= "Нет ни одной заявки для совместного заказа!<br>Ваша заявка будет первой.";
} else {
$wish_arr=file ("$nazv");
$wishdel=0;
$wishname="";
$numwish=1;
//paranoia check input


reset ($wish_arr);
while (list ($wish_num, $wish_line) = each ($wish_arr)) {
$w_c=explode("|", $wish_line);
$md_wish=md5(@$w_c[6]." ID:".@$w_c[9]);
$qty_wish[$md_wish]=(double)@$qty_wish[$md_wish]+$w_c[2];
$cod2del=md5($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]);
$wedit="wish_edit_".$cod2del;
//$wbox="wish_box_".$cod2del;
if ((isset($$wedit))&&(isset($details[$user_pass_complex]))&&($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!="")){
if (preg_match("/^[0-9]+$/",$$wedit)) {
if ($$wedit==0) {
$qty_wish[$md_wish]-=$w_c[2];
unset($wish_arr[$wish_num]);
} else {
$wish_arr[$wish_num]=str_replace($w_c[0]."|".$w_c[1]."|". $w_c[2]. "|", $w_c[0]."|".$w_c[1]."|". $$wedit. "|" ,$wish_arr[$wish_num]);
$md_wish=md5(@$w_c[6]." ID:".@$w_c[9]);
$qty_wish[$md_wish]-=$w_c[2];
$qty_wish[$md_wish]+=$$wedit;
$w_c[2]=$$wedit;
}
$wishdel=1;
$wishname="Изменения приняты";
if ($wishzak==1) {$wishname="";}  //очистим корзину

} else {
unset ($$wedit);
}
} else {
unset ($$wedit);
}


/*
if (isset($$wbox)){
if (preg_match("/^[a-z]+$/i",$$wbox)) {
if ($$wbox=="ok") {
$checked_wish[$cod2del]="checked";
}else {$checked_wish[$cod2del]="";
}} else {unset ($$wbox);}} else {$checked_wish[$cod2del]="checked"; unset ($$wbox);}
*/


if (($cod!="") && ($cod2del==$cod)&&(isset($details[$user_pass_complex]))&&($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!="")){
$wishdel=1;
$wishname="Удалена заявка пользователя " .$w_c[1]. " от " .date("d.m.Y", ((double)$w_c[0])). " - ". $w_c[6] . " (".$w_c[2]." ".$lang[156].")";
unset($wish_arr[$wish_num]);
$qty_wish[$md_wish]-=$w_c[2];
}
}

//saving wishlist file

if (($wishdel==1)&&(isset($details[$user_pass_complex]))&&($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!="")) {
reset ($wish_arr);
$nazv="./admin/userstat/".@$details[1]."/wishlist.txt";
$wish2save=implode("", $wish_arr);
if ($wish2save=="") {
unlink ($nazv);

$jscript= "<p align=center><b><font color=$nc2>$wishname</font></b><br>
<small>Это была последняя заявка совместного заказа!<br>СОВМЕСТНЫЙ ЗАКАЗ УДАЛЕН!</small></p><br><br>";
if ($usetheme==0) {
echo $jscript;
} else {
top("", "$jscript", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
} else {
if (@file_exists($nazv)==TRUE) {

$filewish = fopen ($nazv, "w");flock ($filewish, LOCK_EX);
if (!$filewish) {
$jscript= "<p> ".$lang[44]." <b>$nazv</b> ".$lang[45].".\n";
if ($usetheme==0) {
echo $jscript;
} else {
top("", "$jscript", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
exit;
}
fputs ($filewish, $wish2save);flock ($filewish, LOCK_UN);
fclose ($filewish);
if ($wishzak==1) { }else {
$js= "<p align=center><b><font color=$nc2>$wishname</font></b></p>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
}
}
}

}
unset ($w_c);
//Checking for base changes

if (implode("", $wish_arr)!="") {
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);

$outc=explode("|",$st);
if (count($outc)<=9): continue;  endif;
@$nazv=@$outc[3];
@$price=@$outc[4];
@$opt=@$outc[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
@$price=$okr*(round((@$price*$kurs)/$okr));
@$opt=round(@$opt*$kurs);
@$ext_id=@$outc[6];
@$onsale=substr(@$outc[12],0,1);
@$in_box=(double)@$outc[$inbox];
@$vol_box=(double)@$outc[$box_volume];
if (($in_box==0)||($in_box=="")) {$in_box="любое кол-во";}
if (($vol_box==0)||($vol_box=="")) {$vol_box=0;}
$unifid=md5(@$outc[3]." ID:".@$outc[6]);

reset ($wish_arr);
$okrug=0;
while (list ($wish_num, $wish_line) = each ($wish_arr)) {

$w_c=explode("|", $wish_line);
if (($w_c!="") &&($wish_arr[$wish_num]!="")) {
$wishfid=md5(@$w_c[6]." ID:".@$w_c[9]);
$nazvwish=$w_c[6];
if ($wishfid==$unifid) {
$numwish+=1;
$wishfinded[$wishfid]=$wish_line;
@settype (@$w_c[7], "double");

@$w_cp=$okr*(round((@$w_c[7]*$kurs)/$okr));
if ($podstavas[$w_c[4]."|".$w_c[5]."|"]!="") {
if ($okrug==0) {
$okrug=1;
@$price=$okr*(round((@$price-(@$price*((double)$podstavas[$w_c[4]."|".$w_c[5]."|"])/100))/$okr));
}
} else {
if (($valid=="1")&&($details[7]=="VIP")&&($okrug==0)){
$okrug=1;
@$price=$okr*round((@$price-@$price*$vipprocent)/$okr);
}

}
if (@$onsale=="1") {
if (($w_cp==$price)&&($price!=0)) {
$colwish=($w_cp*$w_c[2])."&nbsp;$valut";
$newish="$w_cp&nbsp;$valut";
//$chk="<input type=\"checkbox\"" .@$checked_wish[md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9])] ." name=\"wish_box_". md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]) ."\" value=\"ok\" class='toCheck'>";
$prtobuy=$w_cp;
} else {
if ($price!="0") {
if (($w_cp*$w_c[2])!=0) {
$colwish="<font color=$nc3><strike>".($w_cp*$w_c[2])."&nbsp;$valut</strike></font><br><b>".($price*$w_c[2])."</b>&nbsp;$valut";
$newish="<font color=$nc3><strike>$w_cp&nbsp;$valut</strike></font><br><b>$price</b>&nbsp;$valut";
} else {
$colwish=($price*$w_c[2])."&nbsp;$valut";
$newish="$price&nbsp;$valut";
}
$prtobuy=$price;
} else {

$colwish="<font color=$nc2>".$lang['prebuy']."</font>";
$zakerr.="<font color=$nc2>$w_c[6] - $colwish. Удалите позицию из списка<br></font><br>";
$newish="<font color=$nc2><strike>$w_cp</strike>&nbsp;$valut</font>";
$nazvwish="<strike><font color=$nc2>$nazvwish</font></strike>";
$prtobuy=0;
}
}
} else {
$colwish="<font color=$nc2>Нет в продаже</font>";
$zakerr.="<font color=$nc2>$w_c[6] - $colwish. Удалите позицию из списка</font><br>";
$newish="<font color=$nc2><strike>$price</strike>&nbsp;$valut</font>";
$nazvwish="<strike><font color=$nc2>$nazvwish</font></strike>";
$prtobuy=0;
}
if ($wsort==0) { $wishsort=((double)$w_c[0]); // Date
}
if ($wsort==1) { $wishsort=$w_c[1]; //User Name
}
if ($wsort==2) { $wishsort=$price; //Price
}
if ($wsort==3) { $wishsort=($w_cp*$w_c[2]); //Sum
}
if ($wsort==4) { $wishsort=$w_c[6]; //Name of Goods
}
$mink="";
$red="";
$pohoje=md5($w_c[6]." ID:".$w_c[9]);
if ($w_c[12]!="") {$wishfoto=" onmouseover=\"return overlib('".str_replace("'","",str_replace("\"","",$w_c[12]))."',  FGCOLOR, '$nc0', BGCOLOR, '$nc7', WIDTH, 100,  HEIGHT, 100, OFFSETY, 20, CAPTION,'')\" onmouseout=\"return nd();\"";} else {$wishfoto="";}
if (preg_match("/^[0-9]+$/",$in_box)) {
$maxk=ceil($qty_wish[$wishfid]/$in_box);
$mink=(floor(10*$qty_wish[$wishfid]/$in_box))/10;


if ((((($maxk*$in_box)-$qty_wish[$wishfid])!=0))&&($prtobuy!=0)) {$nedobor+=(double)($prtobuy*$w_c[2]);  $colwish="<font color=$nc2>$colwish</font>";
$dobor="<br><font color=$nc2><b>!!!</b> ".$lang[230]." ".(($maxk*$in_box)-$qty_wish[$wishfid])." ".$lang[229]."</font>";
$necel="<font color=$nc2><b>".$lang[42].".</b><br>".$lang[42]."</font><br><br>";
//$chk="";
if ($mink>1) {
$dobor.="<font color=$nc2> ".$lang[231]." " .($in_box-(($maxk*$in_box)-$qty_wish[$wishfid])) ." ".$lang[229]."</font>";} else {
$dobor.="<font color=$nc2> ".$lang[232]."</font>";
}

$plus=""; $minus=""; $red="";
if ($mink=="") {$mink="1";}
if (!isset($pohojost[$pohoje])) {$red="<small><font color=$nc2>$mink<br>[".((floor(100*$vol_box*$qty_wish[$wishfid]/$in_box))/100)." $vol]</font></small>"; $nedoborkorob+=$mink; $nedobor_vol+=(floor(100*$vol_box*$qty_wish[$wishfid]/$in_box))/100;$pohojost[$pohoje]="1"; $plus="<input type=button value=\"+\" onclick=\"javascript:document.wishlist$fname".".wish_edit_". md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]) .".value=".($w_c[2]+(($maxk*$in_box)-$qty_wish[$wishfid])).";document.wishlist$fname".".submit();\" title=\"".$lang[225]."\">"; $minus="<input type=button value=\"-\" onclick=\"javascript:document.wishlist$fname".".wish_edit_". md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]) .".value=" .($w_c[2]-($in_box-(($maxk*$in_box)-$qty_wish[$wishfid]))) .";document.wishlist$fname".".submit();\" title=\"".$lang[226]."\">"; if (($w_c[2]-($in_box-(($maxk*$in_box)-$qty_wish[$wishfid])))<=0){$minus="";} if($mink<1){$minus="";}} else {  $red=""; $dobor=""; $plus=""; $minus="";}
$pohojost[$pohoje]="1";

} else {
$dobor=" <font color=$nc4><b>OK</b></font>";
if ($mink=="") {$mink="1";}
if (!isset($pohojost[$pohoje])) { if($prtobuy!=0) {$red="<small>$mink<br>[".((floor(100*$vol_box*$qty_wish[$wishfid]/$in_box))/100)." $vol]</small>";$korobok+=$maxk; $total_vol+=(floor(100*$vol_box*$qty_wish[$wishfid]/$in_box))/100;} else {$dobor="";} } else {$red="";}
$pohojost[$pohoje]="1";
   $totalwc+=(double)($price*$w_c[2]);}

} else {

if($prtobuy!=0) {
$dobor="<font color=$nc4><b>OK</b></font>"; $minikorob+=$w_c[2]; $totalwc+=(double)($price*$w_c[2]);
if ($in_box==0) {$in_box=1;}
if (!isset($pohojost[$pohoje])) {
if ($mink=="") {$mink="1";}
$red="<small>$mink<br>[".((floor(100*$vol_box*$qty_wish[$wishfid]/$in_box))/100)." $vol]</small>";$korobok+=$maxk; $total_vol+=(floor(100*$vol_box*$qty_wish[$wishfid]/$in_box))/100;
} else {
$red="";
}

} else {

$dobor="";
$red="";
}

}




if ($wishzak==1) {
$zaktobuy[$numwish]=md5($w_c[6]." ID:".$w_c[9]);
$kolbuy[$numwish]=$w_c[2];
$volbuy[$numwish]=$w_c[(3+$box_volume)];
$pricebuy[$numwish]=$prtobuy;
$naimbuy[$numwish]=$w_c[6]." ID:".$w_c[9];
$imgbuy[$numwish]=$w_c[12];
$zaki[$numwish]=$w_c[1];
$wishstm=$w_c;
array_shift($wishstm);
array_shift($wishstm);
array_shift($wishstm);
$wishst[$numwish]=implode("|",$wishstm);
}
if (($details[$user_pass_complex]!=$wishpass)||($details[$user_pass_complex]=="")) {$minus=""; $plus="";}
$formouts[$numwish]="<!-- $wishsort --><td valign=top align=center><small>" .date("d.m.Y", ((double)$w_c[0]))."<br><font color=".lighter($nc6,-40).">".date("G:i:s", ((double)$w_c[0])). "</font></small></td><td valign=top><a href=\"".$_SERVER['PHP_SELF']."?unifid=".md5($w_c[6]." ID:".$w_c[9])."\"$wishfoto><!-- ". str_replace("border=0","border=1",$w_c[12]). "<br--><small>";
if ($hidart==1) {
$itid=strtoupper(substr(md5($w_c[9].$artrnd),-7));
$formouts[$numwish].=strtoken($nazvwish,"*")." $itid";
} else {
$formouts[$numwish].=$nazvwish;
}
$formouts[$numwish].="</a><br>$lang[224] <b>".@$in_box."</b> ".$lang[229]." $dobor</small></td><td valign=top align=center><small>" .$newish. "</small></td><td valign=top align=center><small>x".$w_c[2]. "</small></td><td align=center valign=top>".$minus."</td><td align=center valign=top><small>";
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!="")) {$formouts[$numwish].="<input type=text name=\"wish_edit_". md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]) ."\" size=4 value=\"".$w_c[2]. "\">";} else {$formouts[$numwish].=$w_c[2];}
$formouts[$numwish].="</small></td><td align=center valign=top>".$plus."</td><td valign=top align=center><small>" .$colwish. "</small></td><td valign=top align=center>".$red."</td><td valign=top align=center><small>".$w_c[1];
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!="")) {$formouts[$numwish].="<font color=".lighter($nc6,-40).">".str_replace(((double)$w_c[0]),"", $w_c[0])."</font>"; }
$formouts[$numwish].="</small></td><td align=center valign=top>";
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!=""))  {$formouts[$numwish].="<a href=\"$htpath/index.php?zak=wishlist&wishpassmd=".md5($wishpass)."&cod=". md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]) ."\"><img src=\"".$image_path."/forum_del.gif\" border=0 title=\"".$lang['del']."\"></a>"; }
$formouts[$numwish].="</td>\n";
$plus=""; $minus=""; $red="";
}
}
}
}
fclose($f);
}
//searching deleted positions
reset ($wish_arr);

while (list ($wish_num, $wish_line) = each ($wish_arr)) {
$w_c=explode("|", $wish_line);
if (($w_c!="") &&($wish_arr[$wish_num]!="")) {
$wishfid=md5(@$w_c[6]." ID:".@$w_c[9]);
if (!isset($wishfinded[$wishfid])){
$numwish+=1;
@settype (@$w_c[7], "double");

@$w_cp=$okr*(round((@$w_c[7]*$kurs)/$okr));
if ($podstavas[$w_c[4]."|".$w_c[5]."|"]!="") {
@$price=$okr*(round((@$price-(@$price*((double)$podstavas[$w_c[4]."|".$w_c[5]."|"])/100))/$okr));
} else {
if (($valid=="1")&&($details[7]=="VIP")): @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); endif;
}
if ($wsort==0) { $dmy=((double)$w_c[0]); // Date
}
if ($wsort==1) { $wishsort=$w_c[1]; //User Name
}
if ($wsort==2) { $wishsort=$w_cp; //Price
}
if ($wsort==3) { $wishsort=($w_cp*$w_c[2]); //Sum
}
if ($wsort==4) { $wishsort=$w_c[6]; //Name of Goods
}
if ($w_c[12]!="") {$wishfoto=" onmouseover=\"return overlib('".str_replace("'","",str_replace("\"","",$w_c[12]))."',  FGCOLOR, '$nc2', BGCOLOR, '$nc7', WIDTH, 100,  HEIGHT, 100, OFFSETY, 0, CAPTION,'')\" onmouseout=\"return nd();\"";} else {$wishfoto="";}
$dobor="";
$zakerr.="<font color=$nc2>$w_c[6] - позиция не найдена. Удалите позицию из списка</font><br>";
$formouts[$numwish]="<!-- $wishsort --><td valign=top align=center><small> " .date("d.m.Y", ((double)$w_c[0]))."<br><font color=".lighter($nc6,-40).">".date("G:H:s", ((double)$w_c[0])). "</font></small></td><td valign=top><strike><small><font color=$nc2$wishfoto>".$w_c[6]."</font></small></strike><br><small>$lang[224] <b>".@$in_box."</b> ".$lang[229]." $dobor</small><small><br>$carat <a href=\"".$_SERVER['PHP_SELF']."?query=".rawurlencode($w_c[6])."%20".rawurlencode($w_c[9])."&usl=OR\" title=\"Поискать товар\"><b>Поискать по названию</b></a><br>$carat <a href=\"".$_SERVER['PHP_SELF']."?query=".rawurlencode($w_c[9])."&usl=OR\"><b>Поискать по коду</b></a></small></td><td valign=top align=center><small><font color=$nc2><strike>" .$w_cp. "</strike>&nbsp;$valut</font></small></td><td valign=top align=center><small>x".$w_c[2]. "</small></td><td align=center valign=top></td><td align=center valign=top><small>".$w_c[2]. "</small></td><td align=center valign=top></td><td valign=top align=center><small><b>$lang[202]</b><br>$lang[223]</small></td><td valign=top align=center></td><td valign=top align=center><small>".$w_c[1];
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!=""))  {$formouts[$numwish].="<font color=".lighter($nc6,-40).">".str_replace(((double)$w_c[0]),"", $w_c[0])."</font>"; }
$formouts[$numwish].="</small></td><td valign=top align=center>";
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!=""))  {$formouts[$numwish].="<a href=\"$htpath/index.php?zak=wishlist&wishpassmd=".md5($wishpass)."&cod=". md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]) ."\"><img src=\"".$image_path."/forum_del.gif\" border=0 title=\"".$lang['del']."\"></a>"; }
$formouts[$numwish].="</td>\n";

}
}
}


if ($numwish>1) {
reset ($formouts);
natcasesort($formouts);
$numwish=0;
while (list ($wish_num, $wish_line) = each ($formouts)) {
if (($numwish/2)==floor($numwish/2)) {$bgwish="";} else {$bgwish=" bgcolor=".lighter($nc0, -10);}
$numwish+=1;
$formout.="<tr$bgwish>".$wish_line."</tr>\n";
}
}
}

if ($minikorob!=0) {$korobok="$korobok + $minikorob ".$lang[229]." отдельно";}
if ((($totalwc+$nedobor)<$currencies_zakaz_menee[$valut])){ if (($totalwc+$nedobor)!=0) {$ditogo=($totalwc+$nedobor)+$zakaz_do_stavka;  $ddost="<small>$dost_naim1".$currencies_zakaz_menee[$valut]." $valut - <b> ".$currencies_zakaz_dostav[$valut]."</b>  $valut</small><br></small><br>".$lang[34].": <b>$ditogo</b> $valut<br>";} else {$ditogo=0; $ddost=""; } }else{$ddost="$dost_naim2".$currencies_zakaz_menee[$valut]." $valut</small>";}
$formout.="<tr><td colspan=11><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"></td></tr>
<tr><td colspan=7 valign=top align=right>Всего на сумму: </td><td align=center valign=top><b>".($totalwc+$nedobor)."&nbsp;$valut</b></td><td align=center valign=top><b>".($korobok+$nedoborkorob)."&nbsp;кор.</b></td><td align=left colspan=2 valign=top><b>".($total_vol+$nedobor_vol)."&nbsp;$vol</b></td></tr>
<tr><td colspan=11 align=right>$ddost<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"></td></tr>
</tr></table>
<div align=right><table border=0 cellpadding=5 cellspacing=5><tr><td>";


$formout.="<input type=hidden name=\"wsort\" value=$wsort><input type=hidden name=\"wishzak\" id=\"wishzak\" value=\"\">";
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!=""))  {$formout.="<input type=submit value=\"Обновить\">";}
$formout.="</form></td>";

if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!="")) {
$formout .="<td><form class=form-inline action=index.php method=GET><input type=hidden name=\"zak\" value=\"wishlist\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Вернуть заказ на стадию редактирования\"></form></td><td>";

$formout.="<input type=button value=\"Оформить заказ\" id=\"zakbutton\" onclick=\"javascript:SubmForm();\">";
}
$formout.="</td></tr></table></div>

<p align=right><small>
$carat <b><a href=\"printcomplex.php\"target=\"_blank\">Распечатать списком</a></b> | <b><a href=\"printcomplex.php?foto=1\"target=\"_blank\">Распечатать c ФОТО</a></b>
<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">";


}
$fuflo="";
$zakerr.=$necel;
if ($zakerr=="") {
if ($wishzak==1) {
if ((isset($zaktobuy))&&(isset($kolbuy))&&(isset($pricebuy))&&(isset($naimbuy))&&(isset($imgbuy))) {
while (list ($zak_num, $zak_line) = each ($zaktobuy)) {
$cart->add_item($zaktobuy[$zak_num], $kolbuy[$zak_num] , ($pricebuy[$zak_num]/$kurs) , $naimbuy[$zak_num] , $imgbuy[$zak_num],"","","",0,"" , $def_weight , trim($wishst[$zak_num]) ,$speek,$volbuy[$zak_num]); //добавим товар в корзину
$action="zakaz";

$nazv="./admin/userstat/".@$details[1]."/flag.txt";
$filewish = fopen ($nazv, "w");flock ($filewish, LOCK_EX);
if (!$filewish) {
$js= "<p> ".$lang[44]." <b>$nazv</b> ".$lang[45].".\n";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
exit;
}
fputs ($filewish, "1");flock ($filewish, LOCK_UN);
fclose ($filewish);
}
}
}
} else {
if (($wishzak==1)&&($zakerr=="")) {
$fuflo= "<font color=$nc2>".$lang[42]."!<br>".$lang[228]."</font><br><br>";
}
}

if ($action!="zakaz"){
if (((double)$details[$user_volume])=="") {
$zakerr.="<font color=$nc2><b>ПРЕДУПРЕЖДЕНИЕ! При регистрации Вы не указали масимальный объем!</b></font><br>Отправьте нам на <a href=\"index.php?action=sendmail\">E-mail</a> максимальный объем Вашего заказа.<br>Если хотите, Вы можете заказать НА СВОЙ СТРАХ И РИСК.<br>";
}else {
if (($total_vol+$nedobor_vol)>((double)$details[$user_volume])) {
$zakerr.="<font color=$nc2><b>ПРЕДУПРЕЖДЕНИЕ! Ваш заказ (объемом ".($total_vol+$nedobor_vol)." $vol) больше указанного Вами макимального объема ".((double)$details[$user_volume])." л!</b></font><br>Если хотите, Вы можете заказать НА СВОЙ СТРАХ И РИСК, иначе Вам необходимо уменьшить свой заказ.<br>Отправьте нам на <a href=\"index.php?action=sendmail\">E-mail</a> максимальный объем Вашего заказа, если он изменился.";
} else {
if ((($total_vol+$nedobor_vol)<((double)$details[$user_volume])&&(($total_vol+$nedobor_vol)>($k1*((double)$details[$user_volume]))))) {
$zakerr.="<font color=$nc2><b>ПРЕДУПРЕЖДЕНИЕ! Ваш заказ (объемом ".($total_vol+$nedobor_vol)." $vol) больше указанного Вами макимального объема ".((double)$details[$user_volume])." л!</b></font><br>Если хотите, Вы можете заказать НА СВОЙ СТРАХ И РИСК, иначе Вам необходимо уменьшить свой заказ.<br>Отправьте нам на <a href=\"index.php?action=sendmail\">E-mail</a> максимальный объем Вашего заказа, если он изменился.";
} else {
if (($total_vol+$nedobor_vol)!=0) {
$zakerr.="<b>Ваш заказ (объемом ".($total_vol+$nedobor_vol)." $vol) меньше указанного Вами максимального объема (".((double)$details[$user_volume])." $vol).</b><br>Отправьте нам на <a href=\"index.php?action=sendmail\">E-mail</a> максимальный объем Вашего заказа, если он изменился.";
}
}
}
}
$passf="<form name=\"wishlist$fname"."\" id=\"form$fname"."\" method=POST action=\"".$_SERVER['PHP_SELF']."\">";
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!="")) {$passf.="<input type=\"hidden\" id=\"pass$fname"."\" size=6 name=\"wishpass\" value=\"".$wishpass."\">";} else {
$passf.="<small>Пароль для редактирования: <input type=\"password\" id=\"pass$fname"."\" size=6 name=\"wishpass\" value=\"".$wishpass."\"><input type=\"submit\" class=\"btn btn-primary\" value=\"OK\">";
}
if ($wishpass=="") {

if ($passok=="") {
$passform="Подтвердите свои права на редактирование совместного заказа, введя пароль:<br><br>$passf<br>";
} else {
$passform="<font color=\"$nc2\">".$lang[42]."!<br>Вы не указали пароль. Укажите пароль или свяжитесь с координатором нашей компании для получения пароля $telef .</font><br><br> $passf<br>";
}
} else{
if (($details[$user_pass_complex]==$wishpass)&&($details[$user_pass_complex]!=""))  {$passform="$passf <font color=\"$nc4\">Пароль принят</font><br>";} else {$passform="<font color=\"$nc2\">".$lang[42]."!<br>Вы указали неверный пароль. Повторите попытку или свяжитесь с координатором нашей компании для получения пароля $telef .</font><br><br> $passf<br>";}
}
top("", "<h4><font color=\"$nc3\">Совместный заказ</font></h4>$passform<br><input type=hidden name=\"passok\" value=1>$fuflo$zakerr$formout<br>" , $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_content']) , 0,0, "[content]");
$formout="";
}
}
}
//wishlist
$nc2=$oldnc2;
?>