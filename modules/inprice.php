<?php
$inprice="";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
$cartlist="";
$cart_title="";
$cartlist_total=0;
$file="$base_file";
$sc=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);

$outc=explode("|",$st);
if (count($outc)<=9): continue;  endif;
@$file=@$outc[0];;
@$dir=@$outc[1];
@$subdir=@$outc[2];
if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$outc[6].$artrnd), -7));
@$nazv=strtoken(@$outc[3],"*")." $ext_id";
} else {
@$ext_id=@$outc[6];
@$nazv=@$outc[3];
}
@$price=@$outc[4];
@$opt=@$outc[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
@$curcur=substr(@$outc[12],1,3);

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

@$opt=round(@$opt*$kurss);

@$description=@$outc[7];
$admin_functions="";
$vipold="";
//OPT
$didx=$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$outc[$ddidx])*$kurss/$okr)); $price=@$outc[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
$skid="";
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<small><b>".$lang['prebuy']."</b></small>";} else {$prem1="";$prem2="";$prbuy=""; }
if(substr($details[7],0,3)!="OPT") {
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$outc[8])==TRUE)) { $strto=strtoken(@$outc[8],"%"); $skid=$lang[233]." $strto%"; $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font> "; if ((preg_match("/\%/", @$outc[8])==TRUE)&&(doubleval($strto)>0)) {$ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr)); $skid=$lang[233]." $strto%";} else { $strto=doubleval($podstavas["$dir|$subdir|"]); @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $skid=$lang[233]." ".$podstavas["$dir|$subdir|"]."%"; $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")): $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike><small>".$currencies_sign[$_SESSION["user_currency"]]."</small></font> / <b>".$lang[176]."</b> "; $skid="VIP ".$lang[233]." $vipprocent"."%"; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); endif;
} }
if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
//if (($valid=="1")&&($details[7]=="ADMIN")): $admin_functions = "<br><br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=$fid&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=$fid','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=$fid','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br><br>"; endif;

@$kwords=@$outc[8];
@$foto1=@$outc[9];
@$foto2=@$outc[10];
@$vitrin=@$outc[11];
@$onsale=substr(@$outc[12],0,1);
@$brand_name=@$outc[13];
@$ext_lnk=@$outc[14];

$linkfile="";

@$full_descr=@$outc[15];
$pricetax="";
$tax="";
$tax=@$outc[$taxcolumn];
if ($tax=="") {$tax=$deftax;}
if ($tax_function==1) {$pricetax=($okr*round($price/(1+($tax/100))/$okr)); }

$unifid=md5(@$outc[3]." ID:".@$outc[6]);
if ($dir!="") {
$tmp_dirsub["$dir|$subdir"]="$dir|$subdir";
if ($dir==$lang[418]) {unset($tmp_dirsub["$dir|$subdir"]);}
@$tmp_massive["$dir|$subdir"].=($okr*round(@$price/$okr))."|$nazv|$unifid|$vipold|$skid|$pricetax|$tax|$ext_id\n";
if ($dir==$lang[418]) {unset($tmp_massive["$dir|$subdir"]);}
$sc+=1;
 }
}

fclose($f);
//sort($tmp_massive);
//reset($tmp_massive);
$inprice.= "<div class=pull-left>1 $valut = ".(1/$kurs)." $init_currency</div><div class=\"pull-right\"><a href=price.php?speek=$speek><i class=icon-print></i> </a><span class=lnk><a href=price.php?speek=$speek>$lang[106]</a></span></div>\n";
$inprice.=  "<table class=table border=0>";
natsort($tmp_dirsub);
reset($tmp_dirsub);
$ktov=1;

if ($tax_function==1) { $colsp=7; } else {$colsp=5;}
while (list ($keyds, $stds) = each ($tmp_dirsub)) {
$inprice.= "</table><table class=table border=0 width=100% cellspacing=0 cellpadding=5><tr><td colspan=$colsp><b>» ".str_replace("|", " / ", $stds)."</b></td></tr>\n
<tr><td align=\"center\" width=20px><b>#</b></td><td><b>".$lang['name']."</b></td><td align=\"center\" width=15%><b>$lang[419]</b></td><td align=\"center\" width=15%><b>%</b></td>";
if ($tax_function==1) {$inprice.=  "<td align=\"center\" width=15%><b>".$lang[780].",%</b></td><td align=\"center\" width=15%><b>".$lang[781].",".$currencies_sign[$_SESSION["user_currency"]]."</b></td>"; }
$inprice.=  "<td align=\"center\" width=15%><b>".$lang['price'].",".$currencies_sign[$_SESSION["user_currency"]]."</b></td></tr>\n\n";
$tmp_tmp=explode ("\n", $tmp_massive["$stds"]);
natcasesort($tmp_tmp);
reset($tmp_tmp);
while (list ($keytm, $sttm) = each ($tmp_tmp)) {

if ($sttm!=""){
$stnew=explode("|",$sttm);
if (@$stnew[0]==0){$stnew[0]=$lang['prebuy'];}
$inprice.=  "<tr><td align=\"center\">$ktov.&nbsp;</td><td><a href=\"$htpath/index.php?unifid=".@$stnew[2]."\">".@$stnew[1]."</td><td align=\"center\">".@$stnew[7]."&nbsp;</td><td align=\"center\">".@$stnew[4]."&nbsp;</td>";
if ($tax_function==1) { if (@$stnew[5]==0) {@$stnew[5]="";}$inprice.=  "<td align=\"center\">".@$stnew[6]."&nbsp;</td><td align=\"center\">".@$stnew[5]."&nbsp;</td>"; }
$inprice.= "<td align=\"center\">".@$stnew[3]."<b>".@$stnew[0]."</b>&nbsp;</td></tr>\n";
$ktov+=1;
}
}
unset($tmp_tmp, $tmpst);
}
$inprice.= "</table>";


$inprice.=  "» <small>Copyright (c)".date("Y",time()).", <a href=\"$htpath\"><b>$shop_name</b></a>, <a href=\"$htpath/price.php?speek=$speek\">$htpath/price.php?speek=$speek</a></small>";
?>
