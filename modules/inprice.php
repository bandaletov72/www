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
$unif=md5(@$outc[3]." ID:".@$outc[6]);
$curstatus="";
$curstats="";
$sty="";
$prprpr="";
$statuses=Array();
$statusfile="./templates/$template/$speek/status.inc";
if (file_exists($statusfile)) {
$statuses=file($statusfile);
} else { $usestatus=0; }
if ($usestatus==1) {
$statusfile="$base_loc/status/".substr($unif,0,2)."/".$unif."/status.txt";
if (file_exists($statusfile)) {
$sp=file($statusfile);
$curstatus=trim($sp[0]);
}


if ($curstatus==trim($statuses[0])) { $sty=" style=\"color:green;\""; } else {

$view_buybut=0; $price=0;
if ($curstatus==trim($statuses[1])){ $sty=" style=\"color:orange;\"";} else {
if ($curstatus==trim($statuses[2])){ $sty=" style=\"color:red;\"";} else {
if (($curstatus==trim($statuses[3]))&&(trim(@$statuses[3]!=""))){ $sty=" style=\"color:blue;\"";} else {
if (($curstatus==trim(@$statuses[4]))&&(trim(@$statuses[4]!=""))){ $sty=" style=\"color:grey;\"";}
}
}
}
}

if (($curstatus=="")||($curstatus==trim($statuses[0]))) {if ($price!=0) { $prprpr="<br>"."<span class='label label-success'>".number_format($price, 0, ',', ' ')." ".substr($outc[12],1)."</span>"; } }

$curstats="<b class=pull-right"."$sty>$curstatus</b>";
}
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<span class=muted>".$lang['prebuy']."</span>";} else {$prem1="";$prem2="";$prbuy=""; }
if(substr($details[7],0,3)!="OPT") {
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$outc[8])==TRUE)) { $strto=strtoken(@$outc[8],"%"); $skid=$lang[233]." $strto%"; $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font> "; if ((preg_match("/\%/", @$outc[8])==TRUE)&&(doubleval($strto)>0)) {$ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr)); $skid=$lang[233]." $strto%";} else { $strto=doubleval($podstavas["$dir|$subdir|"]);  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $skid=$lang[233]." ".$podstavas["$dir|$subdir|"]."%"; $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
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
$llink="unifid=$unifid";
if ($friendly_url==1) { $llink="item_id=".translit(@$outc[3])."-".translit(@$outc[6]);}
if ($dir!="") {
$tmp_dirsub["$dir|$subdir"]="$dir|$subdir";
if ($dir==$lang[418]) {unset($tmp_dirsub["$dir|$subdir"]);}
@$tmp_massive["$dir|$subdir"].=number_format(($okr*round(@$price/$okr)), 0, ',', ' ')."|$nazv|$unifid|$vipold|$skid|".number_format($pricetax, 0, ',', ' ')."|$tax|$ext_id|$curstats|$llink|\n";
if ($dir==$lang[418]) {unset($tmp_massive["$dir|$subdir"]);}
$sc+=1;
 }
}

fclose($f);
//sort($tmp_massive);
//reset($tmp_massive);

$inprice.="<br><div class=\"mr ml mb pcont\"><div class=\"pull-left mr\"><a href=index.php><img src=logo_mini.png border=0></a></div><div class=pull-left>$shop_name<br>$telef, <a href=$htpath>$htpath</a></div>";
$inprice.="<div class=\"pull-right\" align=right><div class=\"label ml mb\">1 $valut = ".(1/$kurs)." $init_currency</div><div><a href=\"$htpath/price.php?speek=$speek\"><i class=icon-print></i> $lang[106]</a></div></div><div class=clearfix></div><br>\n";
$inprice.="<table class=table2 border=0><tbody>";
natsort($tmp_dirsub);
reset($tmp_dirsub);
$ktov=1;

if ($tax_function==1) { $colsp=7; } else {$colsp=5;}
while (list ($keyds, $stds) = each ($tmp_dirsub)) {
$inprice.="</tbody></table><table border=0 width=100% cellspacing=0 cellpadding=5 class=\"table table-bordered table-striped\"><tr><td colspan=$colsp class=\"panel\"><b>".str_replace("|", " / ", $stds)."</b></td></tr>\n
<tr><td bgcolor=\"#f2f2f2\" align=\"center\" width=20px><b>#</b></td><td bgcolor=\"#f2f2f2\"><b>".$lang['name']."</b></td><td bgcolor=\"#f2f2f2\" align=\"center\" width=15%><b>$lang[419]</b></td><td bgcolor=\"#f2f2f2\" align=\"center\" width=15%><b>%</b></td>";
if ($tax_function==1) {$inprice.="<td bgcolor=\"#f2f2f2\" align=\"center\" width=15%><b>".$lang[780].",%</b></td><td bgcolor=\"#f2f2f2\" align=\"center\" width=15%><b>".$lang[781].",".$currencies_sign[$_SESSION["user_currency"]]."</b></td>"; }
$inprice.="<td bgcolor=\"#f2f2f2\" align=\"center\" width=15%><b>".$lang['price'].",".$currencies_sign[$_SESSION["user_currency"]]."</b></td></tr>\n\n";
$tmp_tmp=explode ("\n", $tmp_massive["$stds"]);
natcasesort($tmp_tmp);
reset($tmp_tmp);
while (list ($keytm, $sttm) = each ($tmp_tmp)) {
//$inprice.=$sttm."<br>";
if ($sttm!=""){
$stnew=explode("|",$sttm);
if (@$stnew[0]==0){$stnew[0]="<span class=muted>".$lang['prebuy']."</span>";}
$inprice.="<tr><td align=\"center\">$ktov.&nbsp;</td><td><a href=\"$htpath/index.php?".@$stnew[9]."\">".@$stnew[1]."</a> ".@$stnew[8]."</td><td align=\"center\">".@$stnew[7]."&nbsp;</td><td align=\"center\">".@$stnew[4]."&nbsp;</td>";
if ($tax_function==1) { if (@$stnew[5]==0) {@$stnew[5]="";} $inprice.="<td align=\"center\">".@$stnew[6]."&nbsp;</td><td align=\"center\">".@$stnew[5]."&nbsp;</td>"; }
$inprice.="<td align=\"center\">".@$stnew[3]."<b>".@$stnew[0]."</b>&nbsp;</td></tr>\n";
$ktov+=1;
}
}
unset($tmp_tmp, $tmpst);
}
$inprice.="</tbody></table>";


$inprice.="<div class=pull-left>Copyright (c)".date("Y",time()).", <b>$shop_name</b></div><div class=pull-right><a href=\"$htpath/price.php?speek=$speek\"><i class=icon-print></i> $lang[106]</a></div><div class=clearfix></div>";
?>
