<?php
$pricetax="";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
if ($view_spec=="c") {$cols_of_goods=$js_max;}

$stspec=0;
$priceot=0; $pricedo=999999999;
$zz=0;
$olddir="";
$oldsubdir="";
$vitrin_content[0]="";
unset($sps);
if ((!@$brand) || (@$brand=="")): $brand=""; endif;
if ((!@$buy_row) || (@$buy_row=="")): $buy_row=""; endif;

if ((!@$qty) || (@$qty=="")): $qty=0; endif;
if ((!@$sss) || (@$sss=="")): $sss=0; endif;
if ((!@$perpage) || (@$perpage=="")): $perpage=$goods_perpage; endif;
if ((!@$stspec) || (@$stspec=="")): $stspec=0; endif;

if ((!@$sub) || (@$sub=="")): $sub=""; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;


$spec_spisok = "";
unset ($sps);
$sps[0]="";
$next=$stspec+$perpage;
$prev=$stspec-$perpage;
if ($prev <= 0) : $prev=0; endif;
$vitrina="";
$error="";
$kupil="";

$files_found=0;
$st=0;
$s=0;


$file="$base_loc/db_spec_$catidy.txt";
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {


$st=fgets($f);

// теперь мы обрабатываем очередную строку $st
$out=explode("|",str_replace("\n", "", $st));
$tst=@explode("^",@$out[0]);
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
$oldpr=$okr*(round((doubleval(@$tst[0])*$kurss)/$okr));
@$file=@$tst[1];
unset ($tst);

@$dir=@$out[1];
@$subdir=@$out[2];
if (($dir=="")||($subdir=="")) {continue;}

@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;

@$price=@$price*$kurss;

$ueopt=@$opt;
@$opt=round(@$opt*$optkurs);

@$ext_id=@$out[6];
@$description=@$out[7];

$admin_functions="";
$vipold="";

$sales="";

//if ($oldpr!=0) {$out[8]=(100-(0.01*round((($price*100)/$oldpr)/0.01)))."% ".str_replace("\%", "", $out[8]); }
//$price=$oldpr;
//OPT
$didx=@$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$out[$ddidx])*$kurss/$okr)); $price=@$out[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
$sales="";
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }


//opt
if(substr($details[7],0,3)!="OPT") {


if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {
$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=@$strtoma[0];
unset($strtoma);

if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) {
$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\"><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>";
$ueprice=@$ueprice-@$ueprice*(doubleval($strto))/100;
$price=$okr*(round((@$price-@$price*(doubleval($strto))/100)/$okr));

} else {
$strto=doubleval($podstavas["$dir|$subdir|"]);
@$ueprice=@$ueprice-@$ueprice*((double)$podstavas["$dir|$subdir|"])/100;
$price=$okr*(round((@$price-@$price*((double)$podstavas["$dir|$subdir|"])/100)/$okr));
}
} else {
if (($valid=="1")&&($details[7]=="VIP")){
@$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueprice]</font></small>";
$vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>";
@$price=$okr*round((@$price-@$price*$vipprocent)/$okr);
@$ueprice=@$ueprice-@$ueprice*$vipprocent;
}
}

//eof opt
}
if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>$valut) <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
if (($valid=="1")&&($details[7]=="ADMIN")): $admin_functions = "<br><br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=$ff&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br><br>"; endif;
$vipold="<font color=#b94a48 size=4 face=Georgia><strike>$oldpr</strike></font>";
$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<br>&nbsp;<font face=georgia size=3 color=#b94a48><b>".round((100-($price*100)/$oldpr))."</b></font><font color=#b94a48 size=1>%</font></td></tr></table>";

@$kwords=@$out[8];
$optionselect="";
$ddescription="";
$xz=0;
$fo=0;
$optionselect="";


@$foto1=@$out[9];
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
@$foto2=@$out[10];
@$vitrin=@$out[11];
@reset($cartl);

@$onsale=substr(@$out[12],0,1);

if (($onsale=="0")||($price<$priceot)||($price>$pricedo)): $ff+=1; continue; endif;

@$brand_name=@$out[13];

if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
if (preg_match("/.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"ѕрослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }
unset ($awv1, $awv2);
@$kolvo=@$out[16];
$ff+=1;
$qty=doubleval($qty);
$shtuk=$lang['pcs'];
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;
$novina=""; if ((@$out[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/",@$out[8])==TRUE) { $novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}
$sortby="";


$tax="";
$tax=@$out[$taxcolumn];
if ($tax=="") {$tax=$deftax;}
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





//«акрываем базу
fclose($f);
$make_col=$cols_of_goods;
$st=0;
$ddt=0;
reset ($sps);

$stspec=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$sps[($stspec+$st)]) || (@$sps[($stspec+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($stspec+$st)]) || (@$sps[($stspec+$st)]=="")): $sps[($stspec+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}

$strtoma=Array();
$strtoma=explode("|",$sps[($start+$st)]);
$sklname=$strtoma[1];
//if(($details[7]!="ADMIN")&&($details[7]!="MODER")){
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
//}
$sps[($start+$st)]=str_replace("[foto1]",$strtoma[2], $strtoma[0]);
$stoks="";
$val = $sps[($stspec+$st)]; //см выше
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("[sklad]","",$val);
//$val.="</td></tr>";
} else {
$fnamef="./admin/sklad/stock/$sklname.txt";
if (@file_exists($fnamef)) {
$filef = @fopen ($fnamef, "r");
if ($filef) { $stoks= "<small>".str_replace(">", "><br>", @fread($filef, @filesize ($fnamef)))."</small>";}
fclose ($filef);
}else {
$stoks= "<small><img src=$image_path/stockno.gif><br>".$lang[175]."</small>";
}
$val=str_replace("[sklad]",$stoks,$val);
}
$st += 1;
$ddt += 1;
if (substr($val, 0,10)=="<!--dir-->") { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $zz=1; $spec_spisok.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=1 width=100%><tr>$val</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=1 width=100%><tr>";}else {

$zz+=1; $spec_spisok .= "$val\n";
if (($st==$make_col)||($zz>$cols_of_goods)) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $zz=1; $spec_spisok.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=1 width=100%><tr>";}
}
}

$spec_spisok = "<table border=0 width=100% cellpadding=0 cellspacing=1>
<tr><td valign=top>
<table border=0 cellspacing=1 cellpadding=0 width=100%>
<tr>
$spec_spisok
</tr>
</table>
</td></tr>

</table>\n";
$total-=1;

if ($files_found==0): $spec_spisok =""; $error = ""; endif;
if ($s==0): $spec_spisok=""; $spectit=""; endif;
$s=0;
if (($page=="")&&($action=="x")&&($catid=="0")&&($unifid=="")&&($item_id=="")) { }else { if($view_spec=="c"){ $spec_spisok=""; $spectit=""; }}
?>
