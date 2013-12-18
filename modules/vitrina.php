<?php
$kolvos=Array();
$bskalert="";
$sortby="";
$vitrin_content[0]="";
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact shveps@dpz.ru to buy license for this host."; exit;}
$varcart=-1;

if ((!@$brand) || (@$brand=="")): $brand=""; endif;
if ((!@$buy_row) || (@$buy_row=="")): $buy_row=""; endif;

if ((!@$qty) || (@$qty=="")): $qty=0; endif;
if ((!@$sss) || (@$sss=="")): $sss=0; endif;
if ((!@$perpage) || (@$perpage=="")): $perpage=$goods_perpage; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;

if ((!@$sub) || (@$sub=="")): $sub=""; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;
if (($r!="")&&($sub!="")): $nw1="dir"; $qnw1="r"; $nw2="subdir"; $qnw2="sub"; endif;
if (($r!="")&&($sub=="")): $nw1="dir"; $qnw1="r"; $nw2="dir"; $qnw2="dir"; endif;
if (($r=="")&&($sub=="")): $nw1="dir"; $qnw1="dir"; $nw2="dir"; $qnw2="dir"; endif;
$catidnov="";
if (($catid!="")&&($catid!="_")) {$catidnov=$catid; }
if ($unifid!="") {$catidnov=$catidcart; }

$vitrina = "";
unset ($sps);
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



$file="$base_loc/top_sales.txt";
if (@file_exists($file)) {
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
require ("./templates/$template/view.inc");
while(!feof($f)) {


$st=fgets($f);
$ddescription="";
$inb1="";
$inb2="";
$sqrp="";
$inbasket="";
// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
if (($dir=="")||($subdir=="")) {continue;}
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];

settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
@$curcur=substr(@$out[12],1,3);

if (($curcur=="")||($curcur==$init_currency)) {
$kurss=$kurs;
} else {
if (isset($currencies[$curcur])) {
if ($curcur==$init_currency) {
$kurss=1;
} else {
$kurss=($currencies[$valut]/$currencies[$curcur]);
}
} else {
$kurss=$kurs;
}
}
@$price=@$price*$kurss;

$ueopt=@$opt;
@$opt=round(@$opt*$optkurs);

@$ext_id=@$out[6];
@$description=@$out[7];

$admin_functions="";
$vipold="";

$sales="";
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\">SALE<BR><b>-$strto%</b></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $strto=doubleval($podstavas["$dir|$subdir|"]); $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")): @$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>$valut) <font color=\"#a0a0a0\">[&#36;$ueprice]</font></small>"; $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent;  endif;
}


if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>$valut) <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
if (($valid=="1")&&($details[7]=="ADMIN")): $admin_functions = "<br><br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=$ff&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br><br>"; endif;
@$kwords=@$out[8];
//опции
$optionselect="";
$xz=0;
$fo=0;
@$out[8]=@$out[8]." ";
while ($xz<50) {
if (preg_match("/option".$xz." /", @$out[8])==TRUE) {$fo=1; $optionselect.=@$optio[($xz-1)];}
$xz+=1;
}
if ($fo==1) {$optionselect="<br><table border=0>$optionselect</table>";}


@$foto1=@$out[9];
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
@$foto1=str_replace(">", " id=smz_".$s.">", @$foto1);
if ($hidart==1) {
$foto1=str_replace("<img ", "<img align=left class=\"img thumbnail span13\" title=\"".str_replace("\"", "", str_replace("\'", "",strtoken($out[3],"*")))."\" ",  stripslashes(@$foto1));
} else {
$foto1=str_replace("<img ", "<img align=left class=\"img thumbnail span13\" title=\"".str_replace("\"", "", str_replace("\'", "",$out[3]))."\" ",  stripslashes(@$foto1));
}
@$foto2=@$out[10];
@$vitrin=@$out[11];

@$onsale=substr(@$out[12],0,1);


if (($onsale=="0")||($price<$priceot)||($price>$pricedo)): $ff+=1; continue; endif;

@$brand_name=@$out[13];

//бренд не указан
if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
if (preg_match("/.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"Прослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }
unset ($awv1, $awv2);
@$kolvo=@$out[16];
$ff+=1;
$qty=doubleval($qty);
$shtuk=$lang['pcs'];
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;
$voterate="";
$lid=md5(@$out[3]." ID:".@$out[6]);
$kolvos[$lid]=@$out[16];
$llid="<a href=\"$htpath/index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {$man=translit(@$out[3])."-".translit(@$out[6]);
if ($mod_rw_enable==0) { $llid="<a href=\"$htpath/index.php?item_id=".$man."\">"; }else {$llid="<a href=\"$htpath/".$man.".htm\">";}}}
eval ($evstr);
//if (($foto1!="")&&($view_vitrin!=0)&&($price!=0)): $vitrin_content[$vit_qty] = "$file|$dir|$subdir|$nazv ID:".@$out[6]."|$price|$opt|$description|$foto1|$ff|"; $vit_qty+=1; endif;
$files_found += 1;
$s+=1;

}



}
//Закрываем базу
fclose($f);
$make_col=$cols_of_goods-1; //
$st=0;
$ddt=0;
reset ($sps);

$start=0;
while ($st < $noveltys_qty) {
$gt = 0;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}
$strtoma=Array();
$strtoma=explode("|",$sps[($start+$st)]);
$sklname=$strtoma[1];
/*
$strtoma[2]=str_replace("http://www.", "http://", str_replace("\"","'", $strtoma[2]));
if ($strtoma[2]!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$strtoma[2]),"src=")."src=","", stripslashes(@$strtoma[2]))),">")," "));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){
$imagesz = @getimagesize(".$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/$kkd1)." height=".ceil(($imagesz[1])/$kkd1)."";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];if ($wh==" width=\"\" height=\"\"") {$wh="";}
}
}
if ($wh==" width= height=") {$wh="";}
if ($wh==" width=0 height=0") {$wh="";}
$strtoma[2]=str_replace("<img ", "<img ". $wh ." ",stripslashes(@$strtoma[2]));

}
*/
//}
$sps[($start+$st)]=str_replace("[foto1]",$strtoma[2], $strtoma[0]);
$stoks="";
//$val = "<tr bgcolor=$back>". $sps[($start+$st)];
$val = $sps[($start+$st)]; //см выше
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("[sklad]","",$val);
//$val.="</td></tr>";
} else {
if ($stinfo=="ext") {
$fnamef="./admin/sklad/stock/$sklname.txt";
if (@file_exists($fnamef)) {
$filef = @fopen ($fnamef, "r");
if ($filef) { $stoks= "<small>".str_replace(">", "><br>", fread ($filef, filesize ($fnamef)))."</small>";}
fclose ($filef);

}else {
$stoks= "<small><img src=$image_path/stockno.gif><br>".$lang[175]."</small>";
}
$val=str_replace("[sklad]",$stoks,$val);
}
if ($stinfo=="int") {
if ($kolvos[$sklname]==1) {$stoks= "<img src=$image_path/stock1.gif title=\"".$lang[622]."\">";}
if ($kolvos[$sklname]>$stock4) {$stoks= "<img src=$image_path/stock1.gif title=\"".$lang[623]."\">";}
if ($kolvos[$sklname]>=$stock3) {$stoks= "<img src=$image_path/stock3.gif title=\"".$lang[624]."\">";}
if ($kolvos[$sklname]>=$stock2) {$stoks= "<img src=$image_path/stock3.gif title=\"".$lang[624]."\">";}
if ($kolvos[$sklname]>=$stock1) {$stoks= "<img src=$image_path/stock5.gif title=\"".$lang[625]."\">";}
if ($kolvos[$sklname]>=$stock0) {$stoks= "<img src=$image_path/stock5.gif><img src=$image_path/stock5.gif title=\"".$lang[626]."\">";}
if ($kolvos[$sklname]<=$stock5) {$stoks= "<img src=$image_path/stockno.gif title=\"".$lang[621]."\">";}


if ($kolvos[$sklname]<=$stock5) {$stoks= "<img src=$image_path/stockno.gif title=\"".$lang[621]."\">";}
//$stock= "<small><br><br><b>".$lang[174]."</b><br>".$stoks."<br></small><br>";


$val=str_replace("[sklad]",$stoks,$val);
}
}
$st += 1;
$ddt += 1;

$vitrina .= "$val\n";
if ($st>$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $vitrina.="</tr><tr>";}
}
$vitrina = "<table border=0 cellspacing=0 cellpadding=5 width=100%>
<tr>
$vitrina
</tr>
</table>";
$total-=1;
} else {$files_found=0; $s=0; $vitrina="";}
if ($files_found==0):$vitrina =""; $error = ""; endif;
if ($s==0): $vitrina=""; endif;
?>
