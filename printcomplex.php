<?php

if (version_compare(phpversion(), "4.1.0", "<") === true) {
$_GET &= $HTTP_GET_VARS;
$_POST &= $HTTP_POST_VARS;
$_SERVER &= $HTTP_SERVER_VARS;
$_FILES &= $HTTP_POST_FILES;
$_ENV &= $HTTP_ENV_VARS;

if (isset($HTTP_COOKIE_VARS)) $_COOKIE &= $HTTP_COOKIE_VARS;
}

if (!ini_get("register_globals")) {
extract($_GET, EXTR_SKIP);
extract($_POST, EXTR_SKIP);
extract($_COOKIE, EXTR_SKIP);

}
$metat="";
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}


//setlocale(LC_ALL,"ru_RU.CP1251");
if (!isset($foto)){$foto=0;} if (!preg_match("/^[0-9]+$/",$foto)) { $foto=0;}
$viewpage_title="";
// default headers ***********
@Header("HTTP/1.0 200 OK");
@Header("HTTP/1.1 200 OK");
@Header("Content-type: text/html");
@Header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
@Header("Last-Modified: ".gmdate("D, M d Y H:i:s",(time()-14400))." GMT");
@Header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
@Header("Pragma: no-cache"); // HTTP/1.0
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require("./modules/webcart.php");
$fcontentsa = file("$base_loc/catid.txt");
$r="";
$sub="";
$st=0;
while (list ($line_num, $line) = each ($fcontentsa)) {
$out=explode("|",$line);
$podstava[$out[1]."|".$out[2]."|"]=$out[0];
$podstavas[$out[1]."|".$out[2]."|"]=$out[4];
$st+=1;
}
$podstava["||"]="_";

session_cache_limiter ('nocache');
session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt));
if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

if ((!@$logout) || (@$logout=="")): $logout=""; endif;
if ($logout==1): $_SESSION["user_login"]="";  $_SESSION["user_password"]=""; $_SESSION["user_valid"]="0"; $valid="0"; session_destroy(); endif;

$cart =& $_SESSION['cart'];
if(!is_object($cart)){
$cart = new webcart();
if ((!@$_SESSION["user_valid"]) || (@$_SESSION["user_valid"]=="")):  @$_SESSION["user_login"]; @$_SESSION["user_password"]; $_SESSION["user_valid"]=""; endif;
if ($_SESSION["user_valid"]="") {
$_SESSION["user_login"]="";
$_SESSION["user_password"]="";
$_SESSION["user_valid"]="0";
}
}
if (!isset($login)){$login="";}
if (!isset($password)){$password="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$login)) { $login="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$password)) { $password="";}
if ((!@$login) || (@$login=="")): $login=""; endif;
if ((!@$password) || (@$password=="")): $password=""; endif;
$valid=@$_SESSION["user_valid"];
if ((!@$valid) || (@$valid=="")): $valid="0"; endif;

if ((!@$fid) || (@$fid=="")){ $fid=""; }
if (!preg_match("/^[a-z0-9_]+$/",$fid)) { $fid="";}
if ((!@$unifid) || (@$unifid=="")){ $unifid=""; }
if (!preg_match("/^[a-z0-9_]+$/",$unifid)) { $unifid="";}



if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();
$admin_url="";
require ("./modules/functions.php");
include ("./templates/$template/meta.inc");
require ("./templates/$template/title.inc");
$bad=$htpath;
if (@$_SESSION["user_banned"]=="1"){
/*echo "<title>502 Page Error</title><h1>502 Bad Gateway</h1><p>The server encountered an internal error or misconfiguration and was unable to complete your request.<br><br>
Please contact the server administrator, postmaster@apache.org and inform them of the time the error occurred, and anything you might have done that may have caused the error.
<br><br>More information about this error may be available in the server error log.
<hr><i>Apache/1.3.26 Server at ".str_replace("http://", "", $htpath)." Port 8080</i>
</i></p>";

exit;
*/
include ("./templates/$template/banned.inc");
exit;

}
$fold=".";
echo "<STYLE type=\"text/css\">

@media print {

.noprint {
display: none;
}
}
</style>
";
require ("./templates/$template/css.inc");
echo $css;


$korobok=0;
$nedobor=0;
//wishlist
if (($valid=="1")&&($login!="")&&($password!="")&&(file_exists("./admin/userstat/".@$details[1]."/wishlist.txt")==TRUE)) {
if ((!@$wsort) || (@$wsort=="")): $wsort=0; endif;
if (!isset($wsort)){$wsort=0;} if (!preg_match("/^[0-9]+$/",$wsort)) { $wsort=0;}

$formout="<p align=center><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">
<b>Список заявок в комплексном заказе:</b><br><br><table border=1 cellspacing=0 cellpadding=4 width=100%><tr><td align=center>";
if ($wsort==0) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&foto=$foto\">Дата</a></b></td><td align=center><b>Фото</b></td><td width=70% align=center>";
if ($wsort==4) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=4&foto=$foto\">".$lang['name']."</a></b></td><td align=center>";
if ($wsort==2) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=2&foto=$foto\">".$lang['price']."</a></b></td><td align=center><b>".$lang['qty']."</b></td><td align=center>";
if ($wsort==3) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=3&foto=$foto\">".$lang[217]."</a></b>".$currencies_sign[$_SESSION["user_currency"]]."</td><td align=center width=30%>";
if ($wsort==1) { $formout.="<img src=\"".$image_path."/sort_up.png\" align=absmiddle border=0>"; }
$formout.="<b><a href=\"".$_SERVER['PHP_SELF']."?zak=wishlist&wsort=1&foto=$foto\">".$lang[77]."</a></b></td></tr>";


if (@$details[1]!=""){
$totalwc=0;
if (is_dir ("./admin/userstat/".@$details[1])==FALSE) {
$formout.= "Вы еще ни разу не заказывали.<br>";
}
$nazv="./admin/userstat/".@$details[1]."/wishlist.txt";
if (file_exists($nazv)==FALSE) {
$formout.= "Нет ни одной заявки для комплексного заказа!<br>Ваша заявка будет первой.";
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
$cod2del=md5 ($w_c[0].$w_c[1].$w_c[2].$w_c[6].$w_c[9]);
}

//saving wishlist file
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
$price=$okr*(round(@$outc[4]*$kurs/$okr));
//echo @$nazv." ".$price;
@$opt=@$outc[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
//@$price=@$price*$kurs;
@$opt=round(@$opt*$kurs);
@$ext_id=@$outc[6];
@$onsale=substr(@$outc[12],0,1); 
@$in_box=(double)@$outc[$inbox];
if (($in_box==0)||($in_box=="")) {$in_box="любое кол-во";}
$unifid=md5(@$outc[3]." ID:".@$outc[6]);

reset ($wish_arr);

while (list ($wish_num, $wish_line) = each ($wish_arr)) {
$w_c=explode("|", $wish_line);
if (($w_c!="") &&($wish_arr[$wish_num]!="")) {
$wishfid=md5(@$w_c[6]." ID:".@$w_c[9]);
if ($hidart==1) {
$nazvwish=strtoken($w_c[6],"*")." ".strtoupper(substr(md5(@$w_c[9].$artrnd),-7));
} else {
$nazvwish=$w_c[6];
}
if ($wishfid==$unifid) {
$numwish+=1;
$wishfinded[$wishfid]=$wish_line;
@settype (@$w_c[7], "double");

@$w_cp=$okr*(round((@$w_c[7]*$kurs)/$okr));
if ($podstavas[$w_c[4]."|".$w_c[5]."|"]!="") { @$w_cp=$okr*(round((@$w_cp-(@$w_cp*((double)$podstavas[$w_c[4]."|".$w_c[5]."|"])/100))/$okr));
@$price=$okr*(round((@$price-(@$price*((double)$podstavas[$w_c[1]."|".$w_c[2]."|"])/100))/$okr));
} else {
if (($valid=="1")&&($details[7]=="VIP")):@$w_cp=$okr*round((@$w_cp-@$w_cp*$vipprocent)/$okr); @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); endif;
}
if (@$onsale=="1") {
if ($w_cp==$price) {
$colwish=($w_cp*$w_c[2]);
$newish="$w_cp";
$prtobuy=$w_cp;
} else {
if ($price!="0") {
$colwish="<font color=$nc2><strike>".($w_cp*$w_c[2])."</strike></font><br><b>".($price*$w_c[2])."</b>";
$newish="<font color=$nc2><strike>$w_cp</strike></font><br><b>$price</b>";
$prtobuy=$price;
} else {
$colwish="<font color=$nc2>".$lang['prebuy']."</font>";
$newish="<font color=$nc2><strike>$w_cp</strike></font>";
$nazvwish="<strike><font color=$nc2>$nazvwish</font></strike>";
$prtobuy=0;
}
}
//$totalwc+=(double)($price*$w_c[2]);
} else {
$colwish="<font color=$nc2>Нет в продаже</font>";
$newish="<font color=$nc2><strike>$price</strike></font>";
$nazvwish="<strike><font color=$nc2>$nazvwish</font></strike>";
$chk="";
$prtobuy=0;
}
if ($wsort==0) { $dmy=((double)$w_c[0]); // Date
}
if ($wsort==1) { $wishsort=$w_c[1]; //User Name
}
if ($wsort==2) { $wishsort=$price; //Price
}
if ($wsort==3) { $wishsort=($w_cp*$w_c[2]); //Sum
}
if ($wsort==4) { $wishsort=$w_c[6]; //Name of Goods
}
if ($foto==0) {$wishfoto="";}else {
if ($w_c[12]!="") {$wishfoto=$w_c[12];} else {$wishfoto="";}}

if (preg_match("/^[0-9]+$/",$in_box)) {
$maxk=ceil($qty_wish[$wishfid]/$in_box);
$mink=(floor($qty_wish[$wishfid]/$in_box));
if ((($maxk*$in_box)-$qty_wish[$wishfid])!=0) {$totalwc+=(double)($prtobuy*$in_box*$mink);$nedobor+=(double)($prtobuy*($w_c[2]-$in_box*$mink));$colwish="<font color=".lighter($nc5,140).">$colwish</font>";
$dobor="[ ".$qty_wish[$wishfid]." / $in_box = ". $mink."к ]<br><font color=$nc2><b>!!!</b> </font>".$lang[230]." ".(($maxk*$in_box)-$qty_wish[$wishfid])." ".$lang['pcs'];$chk="";
if ($mink>0) {$dobor.=" ".$lang[231]." " .($in_box-(($maxk*$in_box)-$qty_wish[$wishfid])) ." ".$lang['pcs'];}
$korobok+=floor($qty_wish[$wishfid]/$in_box);} else {$dobor="[ ".$qty_wish[$wishfid]." / $in_box = ". $maxk.$lang[215]." ] <font color=$nc4><b>OK</b></font>"; $totalwc+=(double)($price*$w_c[2]); $korobok+=$maxk;} } else {$dobor="";}



$formouts[$numwish]="<!-- ". @$wishsort. " --><td valign=top align=center>" .date("d.m.Y", ((double)$w_c[0]))."<br><font color=".lighter($nc6,-40).">".date("G:H:s", ((double)$w_c[0])). "</font></td><td valign=top><a href=\"$htpath/index.php?unifid=".md5($w_c[6]." ID:".$w_c[9])."\">". str_replace("border=0","border=1",$wishfoto). "</a> &nbsp;</td><td valign=top><a href=\"$htpath/index.php?unifid=".md5($w_c[6]." ID:".$w_c[9])."\">".$nazvwish."</a></td><td valign=top align=center>" .$newish. "</td><td align=center valign=top>".$w_c[2]. " ".$lang['pcs']."</td><td valign=top align=center>" .$colwish. "</td><td valign=top align=center>".$w_c[1]."</td>\n";

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
if (@$podstavas[$w_c[4]."|".$w_c[5]."|"]!="") { @$w_cp=$okr*(round((@$w_cp-(@$w_cp*((double)$podstavas[$w_c[4]."|".$w_c[5]."|"])/100))/$okr));
@$price=$okr*(round((@$price-(@$price*((double)$podstavas[$w_c[1]."|".$w_c[2]."|"])/100))/$okr));
} else {
if (($valid=="1")&&($details[7]=="VIP")):@$w_cp=$okr*round((@$w_cp-@$w_cp*$vipprocent)/$okr); @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); endif;
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
if ($foto==0) {$wishfoto="";}else {
if ($w_c[12]!="") {$wishfoto=$w_c[12];} else {$wishfoto="";}}
if (preg_match("/^[0-9]+$/",$in_box)) {if (((ceil($qty_wish[$wishfid]/$in_box)*$in_box)-$qty_wish[$wishfid])!=0) {
$dobor="[ ".$qty_wish[$wishfid]." / $in_box = ". ceil($qty_wish[$wishfid]/$in_box)."к ]<br><font color=$nc2><b>!!!</b> </font>Доберите ".((ceil($qty_wish[$wishfid]/$in_box)*$in_box)-$qty_wish[$wishfid])." ".$lang['pcs']." до ".(ceil($qty_wish[$wishfid]/$in_box)*$in_box);
} else {$dobor="[ ".$qty_wish[$wishfid]." / $in_box = ". ceil($qty_wish[$wishfid]/$in_box)."к ] <font color=$nc4><b>OK</b></font>";$korobok+=ceil($qty_wish[$wishfid]/$in_box);} } else {$dobor="";}
@$formouts[$numwish]="<!-- $wishsort --><td valign=top align=center>" .date("d.m.Y", ((double)$w_c[0]))."<br><font color=".lighter($nc6,-40).">".date("G:H:s", ((double)$w_c[0])). "</font></td><td valign=top>$wishfoto &nbsp;</td><td valign=top><strike><font color=$nc2>".$w_c[6]."</font></strike><br>$lang[224] <b>".@$in_box."</b> ".$lang['pcs']." $dobor</td><td valign=top align=center><font color=$nc2><strike>" .$w_cp. "</strike></font></td><td align=center valign=top>".$w_c[2]. " ".$lang['pcs']."</td><td valign=top align=center><b>$lang[202]</b><br>$lang[223]</td><td valign=top align=center>".$w_c[1]."</td>\n";

}
}
}


if ($numwish>1) {
reset ($formouts);
natcasesort($formouts);
$numwish=0;
while (list ($wish_num, $wish_line) = each ($formouts)) {
if (($numwish/2)==floor($numwish/2)) {$bgwish="";} else {$bgwish=" bgcolor=$nc6";}
$numwish+=1;
$formout.="<tr>".$wish_line."</tr>\n";
}
}
}
$formout.="</tr></table>
<p align=right> $lang[206] <b>$korobok</b>  $lang[215] .$lang[33]: <b>$totalwc</b><br>
$lang[216] <b>$nedobor</b><br>
$lang[206] <b>".($totalwc+$nedobor)."</b></p>
<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">";


}
echo "<h4>$shop_name</h4><h4>Комплексный заказ '$login' от ". date ("d.m.Y (H:i:s)")."</h4>$formout<br>";



echo "<div class=\"noprint\" align=center><input type=button value=\"Печать\" onclick=\"window.print()\"></div><br><br>";

}



echo "</body>
</html>";
?>
