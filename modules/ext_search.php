<?php
$hiddens2="";
if ($query=="") {
/*
//example of ext_search.inc
$allow_ext_search=1;
$extsearch_name="Подбор шин:";
$extsearch_but="Подобрать";
$maxquery_num=5; //Number of merged queryes
$qlue_symbol="_"; //Glue symbol


$q_option0[0] = ("Производитель|1"); //Name|#field in database row
$q_option0[1] = ("Высота|2");
$q_option0[2] = ("Ширина|3");
$q_option0[3] = ("Радиус|4");
$q_option0[4] = ("Сезонность|5");

$q_option1[0] = ("Bridgestone|Bridgestone");
$q_option1[1] = ("Continental|Continental");

$q_option2[0] = ("195|195");
$q_option2[1] = ("185|185");

$q_option3[0] = ("65|65");
$q_option3[1] = ("55|55");

$q_option4[0] = ("R13|13");
$q_option4[1] = ("R14|14");
$q_option4[2] = ("R15|15");
$q_option4[3] = ("R17|17");

$q_option5[0] = ("Зимние|w");
$q_option5[1] = ("Летние|s");
$q_option5[2] = ("Всесезонка|a");

*/

/*
$oo=1;
while($oo<=10) {
$q_option="ext".$oo;
if (!isset($$q_option)) {
if (is_array($$q_option)) {
while (list ($oo_num, $oo_line) = each ($$q_option)) {
echo $$q_option[$oo_num]."_";
//if (!preg_match("/^[а-яА-Яa-zA-Z0-9\.\*\,|-]+$/i",$option[$oo_num])) { $$q_option[$oo_num]="*";}

}
}
}
$oo+=1;
}
*/
$qs=1;
$hiddens="<input type=\"hidden\" name=\"action\" value=\"ext_search\">";
$hiddens2="<input type=\"hidden\" name=\"old_action\" value=\"ext_search\">";
$hidaction="&action=ext_search";
$params="";
$extsearch_text="";
$extsearch_menu="<form method=\"GET\" action=\"index.php\"><input type=hidden name=\"action\" value=\"ext_search\"><table border=0 cellspacing=5 cellpadding=5 width=100% bgcolor=$nc2><tr>";

while ($qs<=10) {
$eext="ext$qs";
$ds="q_option$qs";
$ed=0;
if (isset ($$ds)) {
$dds=$$ds;
if (!isset($$eext)) {$$eext="*"; $ed=0;}
if (!preg_match("/^[1-9\*]+$/i",$$eext)) { $$eext="*"; $ed=0;}
if ($$eext!="*") {$ed=$$eext;}
$tmpfield=explode("|",$q_option0[$qs]);

$hiddens.="<input type=hidden name=\"ext$qs\" value=\"".$$eext."\">";
$hiddens2.="<input type=hidden name=\"ext$qs\" value=\"".$$eext."\">";
$params.="&ext"."$qs=".rawurlencode($$eext);
$tmpvald=explode("|",$dds[$ed]);
$extsearch_menu.="<td align=center><small>".$tmpfield[0].":<small><br><select name=\"ext$qs"."\" size=\"1\"><option value=\"".$$eext."\" selected>".str_replace("|","", @$tmpvald[0])."</option><option value=\"*\">*</option>";
if (($$eext==0) ||($$eext=="0")||($$eext=="")) {
$tmpsmass[]="*";
}else {
$tmpsmass[]=str_replace("|","", @$tmpvald[0]);
}
unset($exploded);
while (list ($skey, $sval) = each ($$ds)) {
$tmpval=explode ("|",$sval);
$extsearch_menu.="<option value=\"".$skey."\">".str_replace("|","", @$tmpval[0])."</option>";
}
$extsearch_menu.="</select></td>";
unset ($skey, $sval,$tmpval,$tmpfield);

}
$qs+=1;
}
$extsearch_menu.="</tr></table><p align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"$extsearch_but\"></p></form>";
if (($action=="ext_search")&&($_SESSION["user_module"]=="shop")&&($catid=="")) {
//require ("./templates/$template/view.inc");
$rating=file("./admin/comments/rate.txt");

$nit=1;
$tfind=0;
unset($sps);














//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}
if ((!@$novinka) || (@$novinka=="")): $novinka=""; endif;
if ((!@$sss) || (@$sss=="")): $sss=0; endif;
if ((!@$buy_row) || (@$buy_row=="")): $buy_row=""; endif;
if ((!@$qty) || (@$qty=="")): $qty=0; endif;
if ((!@$perpage) || (@$perpage=="")): $perpage=$goods_perpage; endif;
if (!preg_match("/^[0-9_]+$/",$perpage)) { $perpage=$goods_perpage;}
if ($perpage>100) {$perpage=$goods_perpage;}
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$starts) || (@$starts=="")): $starts=0; endif;
if (!preg_match("/^[0-9_]+$/",$start)) { $start=0;}
if (!preg_match("/^[0-9_]+$/",$starts)) { $starts=0;}
if ($start>99999) {$start=0;}
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$sub) || (@$sub=="")): $sub=""; endif;
//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";
$cc_cart="";
$cartl[0]="";
if (@file_exists($c_filename)==TRUE) {
$custom_cart=file("./templates/$template/$speek/custom_cart.inc");
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&($cc_line!="\n")&&(@$ccc[0]!="")&&(@$ccc[0]!="\n")&&(@$ccc[1]!="")&&(substr(@$ccc[0],0,2)!="g:")){
$ncc=17+$cc_num;

$cartl[$ncc]=trim(@$ccc[1]);
$cartl2[$ncc]=trim(@$ccc[2]);
}
}
}
$gb="";
$mff=0;
$sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <=0) : $prev=0; endif;

$nexts=$starts+$perpage;
$prevs=$starts-$perpage;
if ($prevs <=0) : $prevs=0; endif;

$vitrina="";
$kupil="";

$files_found=0;
$st=0;
$s=0;
$make_col=$cols_of_goods;



//query template

$query_template = implode($qlue_symbol,$tmpsmass);

$query_template="/". str_replace("*", "(.*)", $query_template). "/i";
unset ($tmpsmass);

$gb = "";
$sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;
$vitrina="";
$error="";
$kupil="";

$files_found=0;
$st=0;
$s=0;

//start search
//read database
$file="$base_file";

$f=fopen($file,"r");
$ff=0;

while(!feof($f)) {
$mff+=1;
$st=fgets($f);
$ff+=1;

// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
$ddescription="";
@$onsale=substr(@$out[12],0,1);
@$price=@$out[4];
@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
//if (($onsale=="0")||($price==0)||($price<$priceot)||($price>$pricedo)): $ff+=1; continue; endif;
$extfound=0;
@$skwords=explode(" ", @$out[8]." ");
while (list ($qfkey, $qfst) = each ($skwords)) {
$test_data=explode($qlue_symbol, $qfst.$qlue_symbol);
if (count($test_data)==count($q_option0)){$extfound=1; $query_match=$qfst; }
}
@$sbrand_name=@$out[13];
if ($extfound==1){
//search
//echo $query_match."<br>";
if (preg_match ($query_template, $query_match)) {
//Find results!
if (is_long(($st/2)) == "TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
$ddescription="";
$out=explode("|",$st);
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];






@$nazv=@$out[3];
@$price=@$out[4];

@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
@$curcur=substr(@$out[12],1,3);

if (($curcur=="")||($curcur=="$init_currency")) {
$kurss=$kurs;
} else {
if (isset($currencies[$curcur])) {
if ($curcur=="$valut") {
$kurss=1;
} else {
$kurss=($currencies[$valut]/$currencies[$curcur]);
}
} else {
$kurss=$kurs;
}
}
@$price=@$price*$kurss;

@$opt=round(@$opt*$optkurs);
@$ext_id=@$out[6];
@$description=@$out[7];
$admin_functions="";
$vipold="";
$sales="";
reset($cartl);
if ($view_custom_cart_inlist==1) {
$ddescription.="<div align=center><table border=0>";
while (list ($cac_num, $cac_line) = each ($cartl)) {

if (($cac_line!="")&&($cac_line!="\n")&&(trim(@$out[$cac_num])!="")) {
$ddescription.="<tr><td><b>$cac_line: </b></td><td>". @$out[$cac_num] ." ". $cartl2[$cac_num]."</td></tr>\n";
}
}
$ddescription.="</table></div>";
}
if (($price==0)||($price=="0")||($price=="")){if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {continue;}  $prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>"; if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";} @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")): @$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[&#36;$ueprice]</font></small>"; $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent;  endif;
}
$ppp=($okr*round($price/$okr));
if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")): $admin_functions="<br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=".($ff-1)."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')> <input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br>"; endif;}
if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
@$kwords=@$out[8];
@$foto1=@$out[9];
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
@$foto2=@$out[10];
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);
if ($view_deleted_goods==0) {if (($price==0)||($price=="0")||($price=="")){if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {continue;}} }
if (($onsale=="0")||($price<$priceot)||($price>$pricedo)): continue; endif;

$linkfile="";
//Опции
$optionselect="";
$xz=0;
$fo=0;
@$out[8]=@$out[8]." ";
while ($xz<50) {
if (preg_match("/option".$xz." /", @$out[8])==TRUE) {$fo=1; $optionselect.=@$optio[($xz-1)];}
$xz+=1;
}
if ($fo==1) {$optionselect="<br><table border=0>$optionselect</table>";}

//end Опции
@$brand_name=@$out[13];
@$ext_lnk=@$out[14];
$linkfile="";
$hear="";
if (preg_match("/\.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"Прослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }

@$full_descr=@$out[15];
//@$awv1=explode("http://", @$foto1);
//@$awv2=explode("/", @$awv1[1]);
//@$foto1=str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto1);
//@$awv1=explode("http://", @$foto2);
//@$awv2=explode("/", @$awv1[1]);
//@$foto2=str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto2);
//unset ($awv1, $awv2);
$wh=" width=".$style['ww']." height=".$style['hh'];
if (($style['ww']=="")||($style['hh'])=="") {
$wh="";
$htpat=str_replace("www.", "", $htpath);
if (preg_match("/".$htpat."/i", @$foto1)) {
@$fi=str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$foto1))));
if (@file_exists(".$fi")){$imagesz=@getimagesize(".$fi"); $wh=" width=".$imagesz[0]." height=".$imagesz[1]; }
}
}
if ($wh!="") {$foto1=str_replace("<img ", "<img". $wh ." vspace=3 hspace=10 title=\"$nazv\"",  stripslashes(@$foto1));}

@$foto1=str_replace("border=0", "border=0 align=left", @$foto1);
@$kolvo=@$out[16];

$qty=doubleval($qty);
if($qty!=0){ $shtuk=$lang['pcs'];
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>"; if ($view_basketalert==1) { $kupil.="<script language=\"javascript\">window.open('$htpath/minibasket.php?unifid=$unifid&qty=$qty&speek=$speek','buy','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=540,height=180,left=220,top=200')</script>"; }} else { $kupil=""; }}
$link="<a href=\"" . $htpath . "/index.php?view=$file\">" . $nazv . "</a>";/* Для сортировки правильной давай переведем номер из представления 1 в представление 000001*/
$sortby="";
if ($sorting=="price") {
if ($prbuy!="") {if ($way=="down") {$sf=0;} else {$sf=$maximumprice;}} else {$sf=$price;}
if ($stinfo=="int") { if (@$out[16]==0) {if ($way=="down") {if ($prbuy!="") {$sf=0;}else {$sf=1;}} else {$sf=($maximumprice-$price);}} }
$sf=round($sf*100);
$chars= intval(strlen($sf));
//echo $chars."<br>";
if ($chars==1): $sortby="0000000000$sf"; endif;
if ($chars==2): $sortby="000000000$sf"; endif;
if ($chars==3): $sortby="00000000$sf"; endif;
if ($chars==4): $sortby="0000000$sf"; endif;
if ($chars==5): $sortby="000000$sf"; endif;
if ($chars==6): $sortby="00000$sf"; endif;
if ($chars==7): $sortby="0000$sf"; endif;
if ($chars==8): $sortby="000$sf"; endif;
if ($chars==9): $sortby="00$sf"; endif;
if ($chars==10): $sortby="0$sf"; endif;
if ($chars==11): $sortby="$sf"; endif;
}
if ($sorting=="name") {
$sortby="$nazv";
}
if ($sorting=="date") {
$chars=intval(strlen($ff));
if ($chars==1): $sortby="00000$ff"; endif;
if ($chars==2): $sortby="0000$ff"; endif;
if ($chars==3): $sortby="000$ff"; endif;
if ($chars==4): $sortby="00$ff"; endif;
if ($chars==5): $sortby="0$ff"; endif;
if ($chars==6): $sortby="$ff"; endif;
}
if ($sorting=="date") {
$chars=intval(strlen($ff));

if ($chars==1): $sortby="00000$ff"; endif;
if ($chars==2): $sortby="0000$ff"; endif;
if ($chars==3): $sortby="000$ff"; endif;
if ($chars==4): $sortby="00$ff"; endif;
if ($chars==5): $sortby="0$ff"; endif;
if ($chars==6): $sortby="$ff"; endif;

}
$rat=doubleval(trim(@$rating[($mff-1)]));
if ($sorting=="rate") {
$chars=intval(strlen($rating[($mff-1)]));
if ($rat==0) { if ($way=="up") {$rat=999999-$mff;} }
if ($chars==1): $sortby="00000".$rat; endif;
if ($chars==2): $sortby="0000".$rat; endif;
if ($chars==3): $sortby="000".$rat; endif;
if ($chars==4): $sortby="00".$rat; endif;
if ($chars==5): $sortby="0".$rat; endif;
if ($chars==6): $sortby="".$rat; endif;

}

$voterate="";
if ($view_comments==1) {if (($rat>=1)&&($rat<=5)) {$voterate="<br><img src=\"$image_path/vote".$rat.".png\" border=0>";}}
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;

$novina=""; if ((@$out[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/",@$out[8])==TRUE) { $novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}
if (($valid=="1")&&($details[7]=="VIP")): $fo=1; endif;
if ($fo==1) {
eval ($evstr2);
$sps[$s]=str_replace("[hiddens]", " -->$hiddens2<!-- ", $sps[$s]);
} else {
eval ($evstr);}
//$sps[$s]= "<!-- $sortby  --><form name=\"list$s\" action=\"".$_SERVER['PHP_SELF'] . "\" method=\"POST\"><td valign=top><b>" .                                                                         ($s+1) . ". </b></td><td valign=top width=30%><a name=\"list$s\"></a><small><b><a href=\"" . $htpath . "/?action=viewcart&cart_id=$file\">$nazv</a></b><br><b>$full_descr</b>$kupil</small></td><td valign=top width=50%><small>$description</small></td><td valign=top width=10%><small><b>$price</b>$valut</small></td><td valign=top width=10%><small>                                                                                                                                                             <input type=\"hidden\" name=\"buy_row\" value=\"$s\"><input type=\"hidden\" name=\"r\" value=\"$r\"><input type=\"hidden\" name=\"sub\" value=\"$sub\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"query\" value=\"$query\"><input type=\"hidden\" name=\"action\" value=\"add\"><input type=\"hidden\" name=\"cod\" value=\"$file\"><input type=\"hidden\" name=\"naim\" value=\"$nazv\"><input type=\"hidden\" name=\"price\" value=\"$price\"><b>".$lang['qty'].":</b></small><br><input name=\"qty\" type=\"text\" value=\"1\" size=5></td><td valign=top><a href=\"javascript:list$s.submit()\"><img src=\"".$image_path."/buy.gif\" border=\"0\"></a></td></form>\n\n";
$files_found += 1;
$s+=1;
}





}
}
}

fclose($f);


$st=0;
$ddt=0;

reset ($sps);
if ($way=="up") {
sort($sps);
} else {
sort($sps);
$res_tmp=array_reverse($sps);
unset($sps);
$sps=$res_tmp;
unset($res_tmp);
}
reset($sps);

if ($start>$s){$start=(floor($s/$perpage))*$perpage; }
while ($st < $perpage) {
$gt=0;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $sps[($start+$st)]=""; $gt=1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2))=="TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}
$skl1=strtoken($sps[($start+$st)],"|");
$sklname=str_replace($skl1."|", "", $sps[($start+$st)]);
$sps[($start+$st)]=$skl1;
$stoks="";
$val=$sps[($start+$st)];
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("[sklad]","",$val);
//$val.="</td></tr>";
} else {
if ($stinfo=="ext") {
$fnamef="./admin/sklad/stock/$sklname.txt";
if (@file_exists($fnamef)) {
$filef=@fopen ($fnamef, "r");
if ($filef) { $stoks="<small>".str_replace(">", "><br>", fread ($filef, filesize ($fnamef)))."</small>";}
fclose ($filef);
}else {
$stoks="<small><img src=$image_path/stockno.gif><br>".$lang[175]."</small>";
}
$val=str_replace("[sklad]",$stoks,$val);
}
if ($stinfo=="int") {
if ($kolvo>=$stock4) {$stoks= "<small><img src=$image_path/stock1.gif> ".$lang[622]."</small>";}
if ($kolvo>=$stock3) {$stoks= "<small><img src=$image_path/stock3.gif> ".$lang[623]."</small>";}
if ($kolvo>=$stock2) {$stoks= "<small><img src=$image_path/stock3.gif> ".$lang[624]."</small>";}
if ($kolvo>=$stock1) {$stoks= "<small><img src=$image_path/stock5.gif> ".$lang[625]."</small>";}
if ($kolvo>=$stock0) {$stoks= "<small><img src=$image_path/stock5.gif><img src=$image_path/stock5.gif> ".$lang[626]."</small>";}

if ($kolvo<=$stock5) {$stoks= "<small><img src=$image_path/stockno.gif><br>".$lang[621]."</small>";}

$val=str_replace("[sklad]",$stoks,$val);
}


}
$st +=1;
$ddt +=1;
$gb .="$val\n";
if ($st==$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $gb.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=5 width=100%><tr>";}

}
$total=count ($sps)-$gt;

$numberpages=(ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

if (($catid!="")&&($catid!="_")) {$queryed="&catid=".rawurlencode($catid);} else {$queryed="";}
$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"$htpath/index.php?action=ext_search&start=" . ($start+$perpage) . "&perpage=$perpage$params$queryed\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"$htpath/index.php?action=ext_search&start=0&perpage=$params$queryed\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"$htpath/index.php?action=ext_search&start=" . ($start-$perpage) . "&perpage=$perpage$params$queryed\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
if ($start<=0) { $prevpage="<img src=\"$image_path/noprev.gif\" border=0 title=\"".$lang[163]."\">";}
if (($start+$perpage)>=$s){ $nextpage="<img src=\"$image_path/nonext.gif\" border=0 title=\"".$lang[163]."\">";}

$s=0;
$pp="";
$tt=0;
$ts=0;
$td=0;
if (($start<=0) &&(($start+$perpage)>=$s)){ $lang[104]="";}
while ($s < $numberpages) {
$tt+=1;
if (($tt>(11+round($start/$perpage)))||($tt<(round($start/$perpage)-10))) {if ($tt<(round($start/$perpage)-10)) {$td+=1;} else {$ts+=1;}}  else {
if (($start/$perpage)==$s) {
$curp=($s+1);
if (($s+1)==$numberpages) {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b>";
} else {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b> <img src=\"$image_path/a.gif\"> ";
}
} else {
if (($s+1)==$numberpages) {
$pp.= "<a href = \"$htpath/index.php?action=ext_search&start=" . ($s*$perpage) . "&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"$htpath/index.php?action=ext_search&start=" . ($s*$perpage) . "&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"$htpath/index.php?action=ext_search&start=0&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"$htpath/index.php?action=ext_search&start=0&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"$htpath/index.php?action=ext_search&start=" . ($perpage*($numberpages-1)) . "&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }
if (!isset($view_compact)){} else { if($view_compact==1) { $poisks="";} else {$poisks="$ppages";}}

if ($way=="up") {$wup="down"; $wim="<img border=0 title=\"".$lang['up']."\" src=\"".$image_path."/sort_up.png\" align=absmiddle align=absmiddle>";} else { $wup="up"; $wim="<img border=0 title=\"".$lang['down']."\" src=\"".$image_path."/sort_down.png\" align=absmiddle align=absmiddle>";}

$gb_g=$gb;
$gb="<table border=0 width=100% cellpadding=0>
<tr><td valign=top>$ppages";

if ($varcart>=100) {$gb.="<form class=form-inline action=\"index.php\" method=\"POST\">";

$gb.="<input type=\"hidden\" name=\"catid\" value=\"$catid\"><input type=\"hidden\" name=\"query\" value=\"$query\"><input type=\"hidden\" name=\"brand\" value=\"".@$brand."\"><input type=\"hidden\" name=\"sorting\" value=\"$sorting\"><input type=\"hidden\" name=\"way\" value=\"$way\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"view\" value=\"$view\">";

$gb.="<input type=\"hidden\" name=\"mnogo\" value=\"2\">
<input type=\"hidden\" name=\"action\" value=\"basket\">";}

$gb.="<table border=0 cellspacing=5 cellpadding=0 width=100%>
<tr>
$gb_g
</tr>
</table>";
if ($varcart>=100) {$gb.="<div align=right><input id=\"totals\" type=\"hidden\" value=\"".$cart->total."\">".$lang[35].": <b><font size=3 color=".lighter($nc3,-80)." id=\"sosk\">".$cart->total."</font></b>".$currencies_sign[$_SESSION["user_currency"]]."<img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"50\" height=\"1\"><input type=submit value=\"".$lang['buy']."\"><img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"60\" height=\"1\"></div></form>";}
$gb.="</td></tr>

</table>

<center><br>$ppages<br><br><br></center>\n";
//$gb="$stat<center><small>$pp</small></center><table border=0 width=100%>$gb</table><center><small>$pp</small></center><br>$stat\n";
$total-=1;
$tfind=1;
if ($files_found==0): $tfind=0; $gb=""; $error="<noindex><font color=$nc2 size=3><br><img src=\"$image_path/hit.gif\"><b>".$lang[93]."</b></font><br><br></noindex>";  $tit=""; endif;
}


if (($_SESSION["user_module"]=="shop")||($_SESSION["user_module"]=="site")){


if ($query!="") {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {

}
}

@rsort($search_results);
@reset($search_results);


//Выдача результатов

$st=0;
$search_results_list="";
while ($st < $perpage) {
$gt=0;
if ((!@$search_results[($starts+$st)]) || (@$search_results[($starts+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$search_results[($starts+$st)]) || (@$search_results[($starts+$st)]=="")): $search_results[($starts+$st)]=""; $gt=1; $rem1="<!--"; $rem2="-->"; break; break; endif;

if (@$search_results[($starts+$st)]==""): break; endif;

$search_results_list .="<li value=".($starts+$st+1).">". $search_results[($starts+$st)] . "</li>\n\n\n\n";
$st +=1;
}
$total=count ($search_results)-$gt;

$numberpages=(ceil ($total/$perpage));
$startnew=$starts+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

$stat="<h4><font color=\"".$style['nav_col1']."\">".$lang[309]."</font></h4><small>".$lang[310].": \"<b>$query</b>\" ".$lang[311]." ".$lang[203]." <b>".($total)."</b> | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($starts/$perpage)==$s) {
$pp.="<b>" . ($s+1) . "</b> | ";
} else {
$pp.="<a href=\"".$_SERVER['PHP_SELF']."?action=ext_search&starts=" . ($s*$perpage) . "$queryed&sort=$sort&forum=$forum\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
$pp="<br><br>&nbsp;&nbsp;<small>".$lang[105].":&nbsp;$pp</small><br><br>";






$total-=1;
if ($s==0): if ($tfind!=0) {$pp=""; $stat=""; $search_results_list="";} else {$pp=""; $stat=""; $search_results_list="";} endif;
if ($numberpages==1): $pp="<br><br>"; endif;
$gb.="$stat$pp<ol class=results>$search_results_list</ol>$pp";

}
}

if ($total>=0) {$error="";}
if ($error!="") {$gb="<p align=\"center\"><font color=$nc2><b>".$lang[93]."</b></font></p><br>";}
if (($smod!="shop") && ($total<0)) {$gb="<p align=\"center\"><font color=$nc2><b>".$lang[93]."</b></font></p><br>";}
$extsearch_text.=$gb;





}

?>
