<?php
$sqrp="";
$spprice="";
$lastgoods_spisok = "";
if ($varlastgoods!=4) {
$minorder="";
$ddescription="";
$minupak="";
$minsht="";
$max_add=10;
$sps2=Array();
$sps3=Array();
$fi="";
$olddir="";
$oldsubdir="";
unset($sps);
$vitrin_content[0]="";
if ((!@$brand) || (@$brand=="")): $brand=""; endif;
if ((!@$buy_row) || (@$buy_row=="")): $buy_row=""; endif;

if ((!@$qty) || (@$qty=="")): $qty=0; endif;
if ((!@$sss) || (@$sss=="")): $sss=0; endif;
if ((!@$perpage) || (@$perpage=="")): $perpage=$goods_perpage; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;

if ((!@$sub) || (@$sub=="")): $sub=""; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;
if (($r!="")&&($sub!="")): $qw1="dir"; $qqw1="r"; $qw2="subdir"; $qqw2="sub"; endif;
if (($r!="")&&($sub=="")): $qw1="dir"; $qqw1="r"; $qw2="dir"; $qqw2="dir"; endif;
if (($r=="")&&($sub=="")): $qw1="dir"; $qqw1="dir"; $qw2="dir"; $qqw2="dir"; endif;



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
$tmrs=Array();
$tmrc=Array();
$tgg=0;
$clf=file("$base_loc/catid.txt");
while (list($clk, $clv)=each($clf)) {
$tmcl=explode("|", trim($clv));
if ((trim($clv)!="")&&($tmcl[2]!="")) {
@$tmrc[$tmcl[1]]+=1;
if ($tmrc[$tmcl[1]]<=$max_add) {
$tgg=1;
if (!isset($tmrs[$tmcl[1]])) {$tmrs[$tmcl[1]]="";}
if ($mod_rw_enable==0) {
$tmrs[$tmcl[1]].="[a href=index.php?catid=$tmcl[0]"."]".$tmcl[2]."[/a], ";
} else {
$tmrs[$tmcl[1]].="[a href=$tmcl[0]"."]".$tmcl[2]."[/a], "; }
}
}

}

$file="$base_loc/lastgoods.txt";
if (@file_exists($file)) {
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {


$st=fgets($f);

// теперь мы обрабатываем очередную строку $st
$out=explode("|",str_replace("\n", "", $st));
if(!isset($out[3])) {$out[3]="";}
$minmax=@explode("^",$st);
$inxcd2=$out[3]."||";
//$inxcd2=$out[3]."||";
$minl=doubleval(@$minmax[1]);
$maxl=doubleval(@$minmax[2]);
unset ($minmax);
$minmax="";
if (($minl!=0)&&($maxl!=0)) {
if ($minl==$maxl) {
if (substr($currencies_sign[$_SESSION["user_currency"]],0,1)!=" ") {
$minmax="".$currencies_sign[$_SESSION["user_currency"]]."<b>".($okr*round(($minl*$kurs)/$okr))."</b>";
}else {

$minmax="<b>".($okr*round(($minl*$kurs)/$okr))."</b> ".$currencies_sign[$_SESSION["user_currency"]]."";
}
} else {
if (substr($currencies_sign[$_SESSION["user_currency"]],0,1)!=" ") {
$minmax="".$lang[99]." ".$currencies_sign[$_SESSION["user_currency"]]."<b>".($okr*round(($minl*$kurs)/$okr))."</b> ".$lang[100]." ".$currencies_sign[$_SESSION["user_currency"]]."<b>".($okr*round(($maxl*$kurs)/$okr))."</b>";
} else {
$minmax="".$lang[99]." <b>".($okr*round(($minl*$kurs)/$okr))."</b> ".$currencies_sign[$_SESSION["user_currency"]]." ".$lang[100]." <b>".($okr*round(($maxl*$kurs)/$okr))."</b> ".$currencies_sign[$_SESSION["user_currency"]]."";
}
}
}
$minmax="<div class=small>$minmax</div>";
if ($view_goodsprice==0) {$minmax="";}
if (($onlyopt==1)||(substr($details[7],0,3)=="OPT")) {$minmax=""; }
@$file=@$out[2];
@$dir=@$out[3];
@$subdir=@$out[4];
if (($dir=="")||($subdir=="")) {continue;}
@$nazv=@$out[5];
@$price=@$out[6];
@$opt=@$out[7];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
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

$ueopt=@$opt;
@$opt=round(@$opt*$optkurs);

@$ext_id=@$out[8];
@$description=@$out[9];

$admin_functions="";
$vipold="";

$sales="";
$wh="";
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[10])==TRUE)) { $strto=strtoken(@$out[10],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[10])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\">SALE<BR><b>-$strto%</b></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $strto=doubleval(@$podstavas["$dir|$subdir|"]); $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".@$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";  @$ueprice=@$ueprice-(@$ueprice*((double)@$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)@$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")): @$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>$valut) <font color=\"#a0a0a0\">[&#36;$ueprice]</font></small>"; $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent;  endif;
}


if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>$valut) <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
if (($valid=="1")&&($details[7]=="ADMIN")): $admin_functions = "<br><br><small><input type=button class=btn value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('admin/".$scriptprefix."edit.php?speek=".$speek."&id=$ff&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button class=btn value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('admin/".$scriptprefix."clone.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button class=btn value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('admin/".$scriptprefix."del.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br><br>"; endif;
@$kwords=@$out[10];
$optionselect="";
$xz=0;
$fo=0;
@$out[8]=@$out[8]." ";

@$foto1=@$out[11];
$inxcd=$out[3]."|".$out[4]."|";

if (@$logodirsy[$inxcd]!="") {$foto1=@$logodirsy[$inxcd];}
$sps2[$inxcd2]=$out[3];
$sps3[$inxcd2]=@$logodirsy[$inxcd2];
$sps4[$inxcd]=$minmax;
//echo "$dir|$subdir|".$podstavas["$dir|$subdir|"]."<br>";
if (@$podstavas["$dir|$subdir|"]!=""){
$minmax="<br><font color=#b94a48><b>".@$podstavas["$dir|$subdir|"]."%</b> $lang[233]</font>$minmax";
}
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
@$foto2=@$out[12];
@$vitrin=@$out[13];

@$onsale=@$out[14];

if (($onsale=="0")||($price<$priceot)||($price>$pricedo)): $ff+=1; continue; endif;

@$brand_name=@$out[15];

if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[16];
@$full_descr=@$out[17];
$linkfile="";
$hear="";
unset ($awv1, $awv2);
$htpat=str_replace("http://www.", "http://", $htpath);



if (@$logodirsy[$inxcd]=="") {
//echo "1.Нет картинки подраздела $inxcd <br>";

$wh="";
@$foto1=str_replace("<img ", "<img align=left class=\"img thumbnail span23\" ",  stripslashes(@$foto1));

if ($foto1!="") {
//echo "Но есть картинка из lastgoods.txt - $foto1 давай ее обработаем<br>";

//echo "ее размеры $wh<br>";
//echo "Проверим есть вообще картинка раздела $inxcd2 ?<br>";
if (@$logodirsy[$inxcd2]=="") {
//echo "НЕТ! давайте сделаем картинкой раздела $inxcd2 - $foto1<br>";
$sps3[$inxcd2]=$foto1;
} else {
//echo "ЕСТЬ! Давайте тогда ее уменьшим правильно но потом...<br>";
//$foto1=str_replace("<img ", "<img align=left class=\"img thumbnail span23\" ",  stripslashes(@$logodirsy[$inxcd2]));
$sps3[$inxcd2]=$foto1;
}
$sps3[$inxcd]=$foto1;


} else {
//echo "5. Не найдено картинки подраздела $inxcd в Lastgoods.txt, что же, ничего не покажем.<br>";
}

} else {
//echo "Есть картинка подраздела $inxcd<br>";
@$logodirsy[$inxcd]=str_replace("<img ", "<img align=left class=\"img thumbnail span23\" ",  stripslashes(@$logodirsy[$inxcd]));
@$foto1=str_replace("<img ", "<img align=left class=\"img thumbnail span23\" ",  stripslashes(@$logodirsy[$inxcd]));

if ($foto1!="") {
$sps3[$inxcd]=$foto1;
//echo "2. Картинкой подраздела $inxcd стала $foto1<br>";
if ($logodirsy[$inxcd2]=="") {
$logodirsy[$inxcd2]="$foto1";
$sps3[$inxcd2]="$foto1";
//echo "6. Картинка раздела $inxcd2 не найдено, ей стала $foto1<br>";
}
}



if (@$logodirsy[$inxcd2]!="") {
//echo "55. Есть картинка раздела $inxcd2 $logodirsy[$inxcd2]<br>"; $wh="";
@$logodirsy[$inxcd2]=str_replace("<img ", "<img align=left class=\"img thumbnail span23\" ",  stripslashes(@$logodirsy[$inxcd2]));


} else {
if ( $sps3[$inxcd]!="") {
$sps3[$inxcd2]=$sps3[$inxcd];
}
//echo "4. $inxcd2 - $logodirsy[$inxcd2] - $foto1 - $sps3[$inxcd] - $sps3[$inxcd2]<br>";
}
}

@$kolvo=@$out[16];
$ff+=1;
if ((@$$qw1==@$$qqw1) && (@$$qw2==@$$qqw2)) {
$qty=doubleval($qty);
$shtuk=$lang['pcs'];
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;
if ($olddir!=$dir) {
$needcol=@$colordirs["$dir"];
if ($needcol!="") {$needc=$needcol; } else {$needc=$nc6;}

$sps[$s]="|<!--dir--><div class=clearfix></div><div><h4 class=\"lnk mu\"><a href=\"index.php?catid=".translit($dir)."\">".str_replace(" ","&nbsp;", "$dir")."</a></h4><hr></div>";
$s+=1;
$files_found += 1;
}
$voterate="";
$lid=md5(@$out[5]." ID:".@$out[7]);
$llid="<a href=\"index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {$man=translit(@$out[5])."-".translit(@$out[7]);
if ($mod_rw_enable==0) { $llid="<a href=\"index.php?item_id=".$man."\">"; }else {$llid="<a href=\"".$man.".htm\">";} }
}
$sortby="";
$bskalert="";
$novina="";
$inb1="";
$inbasket="";
$inb2="";
eval ($evstr);

$olddir=@$out[3];
$oldsubdir=@$out[4];
$s+=1;
$files_found += 1;
}
}


}
fclose($f);
$make_col=$cols_of_goods;
$st=0;
$ddt=0;
reset ($sps);

$ddt=0;
if (($varlastgoods==1)||($varlastgoods==2)) {
while (list ($sps_num, $sps_line2) = each ($sps)) {
	$explk=explode("|",$sps_line2);

if ($varlastgoods==1) {
if (substr($sps_line2, 1,10)=="<!--dir-->") {
$st=0;
$lastgoods_spisok.=$explk[1]."\n";

	}else {
$st+=1;
$lastgoods_spisok .= $explk[0]."\n";
}
}
if ($varlastgoods==2) {
if (substr($sps_line2, 1,10)=="<!--dir-->") {
	}else {
$st+=1;
$lastgoods_spisok .= $explk[0]."\n";
}
}
}
}


$st=0;
if ($varlastgoods==3) {
$make_col=$cols_of_goods;

$ddt=0;
reset ($sps2);
while(list ($keysp2,$stsp2) =each ($sps2)) {
$gt = 0;
$ddt += 1;
$st+=1;
$needcols=@$colordirs[$stsp2];
if ($needcols!="") {$needcd=$needcols; } else {$needcd=$nc10;}
if ($mod_rw_enable==0) {$llid="<a href=\"index.php?catid=".translit($stsp2)."\">"; } else { $llid="<a href=\"".translit($stsp2)."\">";}
if ((!isset($sps3[$keysp2]))||($sps3[$keysp2]=="")) {
$lastgoods_spisok .= "<div class=\"lgdiv\" style=\"display:inline-block;\"><b><a href=\"index.php?catid=".translit($stsp2)."\">$stsp2</a></b>$sps4[$keysp2]<br>".substr(str_replace("[","<",str_replace("]",">",@$tmrs[$stsp2])),0,-1)."</a></div>\n";
	} else {

$lastgoods_spisok .= "<div class=\"lgdiv\" style=\"display:inline-block;\"><div><a href=\"index.php?catid=".translit($stsp2)."\" title=\"".strtoken($stsp2,"*")."\">".$sps3[$keysp2]."</a></div><div align=left class=lnk><h4 style=\"font-size: ".($main_font_size+1)."pt;\">$llid<b>".strtoken($stsp2,"*")."</b></a></h4><div class=nw>".str_replace("[","<",str_replace("]",">",@$tmrs[$stsp2]))." ...</div></font></div></div>\n";
}

}
}

$total-=1;
} else {$files_found==0; $s==0; $lastgoods_spisok="";}


if ($files_found==0): $lastgoods_spisok =""; $error = ""; endif;
if ($s==0): $lastgoods_spisok=""; endif;

if ($lastgoods_spisok!="" ) { $lastgoods_spisok="<div style=\"text-align:center\" align=center>".$lastgoods_spisok."<div class=clearfix></div></div>"; }
}
if (($valid=="1")&&($details[7]=="ADMIN")){
$lastgoods_spisok="<div class=clearfix></div><div class=round align=center><a class=\"btn btn-primary\" onClick=\"javascript:window.open('admin/".$scriptprefix."new_item.php?speek=".$speek."','fr0','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#newItem\"><i class=\"icon-plus icon-white\"></i> <font color=#ffffff>".$lang[875]."</font></a>&nbsp;&nbsp;&nbsp;<a class=btn onClick=\"javascript:window.open('admin/".$scriptprefix."indexator.php?speek=".$speek."','fr2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" href=\"#Index\">".$lang['adm1']."</a><br><br>".$lang[879]."<br><b>".$lang[876]."</b></div><div class=clearfix></div>$lastgoods_spisok"; }
if ($interface==1) {if (($valid=="1")&&($details[7]=="ADMIN"))
{ $oldval="varlastgoods";$strnum=115; $oldvalue=$$oldval;
if (($varlastgoods==4)||($varlastgoods==0)) {
$lastgoods_spisok.="<div align=center><font color=#b94a48>".$lang[895].": ".$lang[894]."</font></div>";
$modonoff="<input type=button class=btn onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button class=btn onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=4"."' value=\"".$lang[889]."\">";
}
$lastgoods_spisok.="<div class=clearfix></div><div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center>
<b>$lang[887]:</b>
<input type=button class=btn onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[886]." 1\">&nbsp;
<input type=button class=btn onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=2"."' value=\"".$lang[886]." 2\">&nbsp;
<input type=button class=btn onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=3"."' value=\"".$lang[886]." 3\">&nbsp;
$modonoff<br><br>$lang[888]</div>";
}
}

?>
