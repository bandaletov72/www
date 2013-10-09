<?php

if ((!@$delgd) || (@$delgd=="")){ $delgd=0;}
if (!preg_match("/^[0-9_]+$/",$delgd)) { $delgd=0;}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
if ($delgd==1) { if (file_exists("$base_loc/good_of_day.txt")==TRUE) {unlink("$base_loc/good_of_day.txt");}}
}}
$foto1="";
$wodth=100;
$foto2="";
$fotos="";
$men1="";
$men2="";
$men3="";
$vcount=0;
$phqty=20;
$accss="";
$acqty=$js_max;
$aacqty=0;
$outc=Array();
$acs=""; //accessories
$taggs="";
$aauto=450;
$ffa=0;
$sqr="";
$sklad="";
$voting="";
$pr_ods_qty=1;
$sortby="";
$vitrin_content[0]="";
$catidnov="";
if (($catid!="")&&($catid!="_")) {$catidnov=$catid; }
if ($unifid!="") {$catidnov=$catidcart; }
$pr_ods_spisok = "";

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



$file="$base_loc/good_of_day.txt";
//if (@file_exists("$base_loc/items/$catidnov.txt")) {$file="$base_loc/items/$catidnov.txt";
//if ($catidnov!="") {$lang[259]= $lang[410]." \"".$sub."\":";}
//}

if (@file_exists($file)) {
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {


$st=fgets($f);
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
//OPT
$didx=@$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$out[$ddidx])*$kurss/$okr)); $price=@$out[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT

if(substr($details[7],0,3)!="OPT") {


if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {
$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=@$strtoma[0];
unset($strtoma);

$vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>";
if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) {
$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\"><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>";
$ueprice=@$ueprice-@$ueprice*(doubleval($strto))/100;
$price=$okr*(round((@$price-@$price*(doubleval($strto))/100)/$okr));

} else {
$strto=doubleval($podstavas["$dir|$subdir|"]);
$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";
@$ueprice=@$ueprice-@$ueprice*((double)$podstavas["$dir|$subdir|"])/100;
$price=$okr*(round((@$price-@$price*((double)$podstavas["$dir|$subdir|"])/100)/$okr));
}
} else {
if (($valid=="1")&&($details[7]=="VIP")){
$vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>";
@$price=$okr*round((@$price-@$price*$vipprocent)/$okr);
@$ueprice=@$ueprice-@$ueprice*$vipprocent;
}
}

//eof opt
}


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
@$foto2=@$out[10];
@$vitrin=@$out[11];

@$onsale=substr(@$out[12],0,1);


if (($onsale=="0")||($price<$priceot)||($price>$pricedo)): $ff+=1; continue; endif;
$dopos="";
$fotos=$foto1;
if ($foto2!=""){
	$foto2=str_replace("<br>","",$foto2);
if (substr_count($foto2 , "<img ")>1) {
$tmpf2=explode("'", $foto2);
$tmpfs[0]="";
$kk=0;
$mm=0;
while (list ($linef2, $keyf2) = each ($tmpf2)) {
if (substr_count($keyf2, "http://")==1) {
$tmpfs[$kk]="$keyf2";
$imagesz = @getimagesize(str_replace("$htpath", "" , ".$keyf2"));
if (@$imagesz[1]<=200){$imagesz[1]=500;}
if (@$imagesz[0]<=200){$imagesz[0]=500;}
if($imagesz[1]>500){$hiz=540;}else{$hiz=($imagesz[1]+10);}
$tmpiz[$kk]=", width=".($imagesz[0]+40).",height=$hiz"; $tmpiz1[$kk]=$imagesz[0]; $tmpiz2[$kk]=$imagesz[1]; $kk+=1;
}
}
unset($linef2, $keyf2, $tmpf2, $kk);
$fotos="<img src='".$tmpfs[0]. "' border=0>";

$dopos="<small><b>".$lang[138].":</b><br><br></small>
<div style=\"overflow: auto; width: 100%; height: [auto];\">
<a href=\"#open\" onclick=\"javascript:window.open('open.php?i=".$tmpfs[1]."', 'fr".$fid."1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no".@$tmpiz[1]."')\"><IMG title=\"".$lang[139]."\" style=\"border: 0 solid ".$style['nav_col1']."\" src='";
while (list ($linef2, $keyf2) = each ($tmpfs)) {
if ($linef2!=0) {
$mm+=1;
if (isset($tmpfs[($linef2+1)])){
$mmlink="";
//if ($mm==3) {$mmlink="<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">"; $mm=0; } else {$mmlink="";}

$izlink="$mmlink <a href=\"#open\" onclick=\"javascript:window.open('open.php?i=".$tmpfs[($linef2+1)]."','fr".$fid.($linef2+1)."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no".@$tmpiz[($linef2+1)]."')\"><IMG title=\"".$lang[139]."\" style=\"border: 0 solid ".$style['nav_col1']."\" src='";}else{$izlink="";}
$widt=round($tmpiz2[$linef2]*$maxh/($tmpiz1[$linef2]+1),0);
if ($widt==0){$widt=$maxh;}
$dopos.="$keyf2'align=top border=0 height=\"".$widt."\" width=\"".$maxh."\" vspace=4></a> $izlink";
}
}
//echo $mm." ".$dopos;
$dopos.="</div><br><img src=\"$image_path/zoom.gif\" border=0 align=left><small>".$lang[140]."</small><br><br>";

if ($mm<=4) {$dopos=str_replace("[auto]", "auto", $dopos); }
} else {
$fotos=$foto2;
}
} else {
$fotos="";
}
if (($foto1=="")&&($foto2=="")): $fotos="<img src=\"".$image_path."/no_photo.gif\" border=0 title=\"".$lang[188]."\" align=left>"; endif;
$fotos=stripslashes($fotos);
@$aw113=explode("$htpath", $fotos);
@$aw113[1]=str_replace("'", "", @$aw113[1]);
@$aw113[1]=str_replace("\"", "", @$aw113[1]);
@$aw114=explode(" ", @$aw113[1]);
$cpath=@$aw114[0];
$fil="$cpath";
if (($cpath!="")&&(@file_exists(".$cpath")==TRUE)) {
$imagesz = @getimagesize(".$cpath");
$fwidth  = $imagesz[0];
$fheight = $imagesz[1];
if (($fheight!="")&&($fwidth!="")): $fotos=str_replace("<img ", "<img border=0 width=$fwidth height=$fheight title=\"$fwidth x $fheight\" ", $fotos); endif;

if ($ffa==0) {$aauto=$fheight; $ffa=1; $dopos=str_replace("[auto]", ($aauto-80)."px", $dopos);}
}

unset($aw222,$aw111,$aw113, $cpath, $aw114);

@$brand_name=@$out[13];

//бренд не указан
if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
if (preg_match("/.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"Прослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }
unset ($awv1, $awv2);
$wh=" width=".$style['ww']." height=".$style['hh'];
if (($style['ww']=="")||($style['hh'])=="") {
@$fi= str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$foto1))));
if (@file_exists(".$fi")){$imagesz = @getimagesize(".$fi"); $wh=" width=".ceil(($imagesz[0])/2)." height=".ceil(($imagesz[1])/2); }else{$wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$foto1=str_replace("<img ", "<img". $wh ." vspace=3 hspace=10 title=\"".str_replace("\"", "", str_replace("\'", "",$nazv))."\" ",  stripslashes(@$foto1));

@$foto1=str_replace("border=0", "style=\"border: 1px solid ".lighter($nc6,-10).";\" align=left", @$foto1);
$foto1=str_replace("width= height= ", "", $foto1);
@$kolvo=@$out[16];
$ff+=1;
$qty=doubleval($qty);
$shtuk=$lang['pcs'];
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;
$voterate="";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$description.="<br><br><input type=button value=\"&nbsp;&nbsp;X&nbsp;&nbsp;".$lang['del']." ".$lang[735]."\"  onclick=\"location.href='".$htpath."/index.php?speek=$speek&delgd=1"."';\">";
}}
$description.="<br><br>".$full_descr;
$lid=md5(@$out[3]." ID:".@$out[6]);
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
while ($st < $pr_ods_qty) {
$gt = 0;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}

$skl1=strtoken($sps[($start+$st)],"|");
$sklname= str_replace($skl1."|", "", $sps[($start+$st)]);
$sps[($start+$st)]=$skl1;
$stoks="";
//$val = "<tr bgcolor=$back>". $sps[($start+$st)];
$val = $sps[($start+$st)]; //см выше
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("[sklad]","",$val);
//$val.="</td></tr>";
} else {
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
$st += 1;
$ddt += 1;
$pr_ods_spisok .= "$val\n";
if ($st>$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $pr_ods_spisok.="</tr><tr>";}
}
$pr_ods_spisok = "<br><br><table border=0 cellspacing=0 cellpadding=5 width=100%>
<tr>
$pr_ods_spisok
</tr>
</table>";
$total-=1;
} else {
$files_found==0; $s==0; $pr_ods_spisok="";
	}

if ($files_found==0): $pr_ods_spisok =""; $error = ""; endif;
if ($s==0): $pr_ods_spisok=""; endif;
?>
