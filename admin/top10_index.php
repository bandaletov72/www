<?php
$kws=0;
$maximum_indexed_items=10;
if (!isset($item_change)) {$item_change=0;}
$itemsave="";
$items_admined="";
//function lighter ($arg1, $arg2) {$rrr= (hexdec ("0x" . substr($arg1,1,2))) + $arg2;$ggg=(hexdec ("0x" . substr($arg1,3,2))) + $arg2;$bbb=(hexdec ("0x" . substr($arg1,5,2))) + $arg2; if ($rrr>255) {$rrr=255;}if ($rrr<0) {$rrr=0;}$rrr=dechex($rrr);if (strlen($rrr)<=1) {$rrr="0".$rrr;} if ($bbb>255) {$bbb=255;}if ($bbb<0) {$bbb=0;}$bbb=dechex($bbb);if (strlen($bbb)<=1) {$bbb="0".$bbb;} if ($ggg>255) {$ggg=255;}if ($ggg<0) {$ggg=0;}$ggg=dechex($ggg);if (strlen($ggg)<=1) {$ggg="0".$ggg;} return "#$rrr$ggg$bbb";}
//читаем базу в массив блин
$file="$base_file";
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {


$st=fgets($f);


$pic="";
$vipold="";

if (($st!="")&&($st!="\n")) {
$out=explode("|",$st);


@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);
if ($onsale=="0") { continue;}
if (($price==0)||($price=="")) { continue; }
$unif=md5(@$out[3]." ID:".@$out[6]);
if (@file_exists("./admin/stat/$unif.txt")==FALSE) { continue;} else {
$fmasf=file("./admin/stat/$unif.txt");
$ift=explode("|",$fmasf[0]);

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

@$ext_id=@$out[6];
@$description=@$out[7];

$admin_functions="";
$vipold="";
$sales="";

if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {  $strto=strtoken(@$out[8],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\">SALE<BR><b>-$strto%</b></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")): @$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>$valut) <font color=\"#a0a0a0\">[&#36;$ueprice]</font></small>"; $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent;  endif;
}


if (($valid=="1")&&($details[7]=="ADMIN")): @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>$valut) <font color=\"#a0a0a0\">[&#36;$ueopt]</font></small>"; endif;
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")): $admin_functions = "<small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=$ff&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br><br>"; endif;}


if (($style['ww']=="")||($style['hh'])=="") {$style['ww']=50; $style['hh']="";}
@$fi= str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$foto1))));
if (@file_exists(".$fi")){
$maxw=$style['spec_w'];
$imagesz = @getimagesize(".$fi");
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
$wh="width=".$maxw." height=".$widt;
} else{
$wh="width=".$style['spec_w']." height=".$style['spec_h'];
}

$foto1=str_replace("<img ", "<img ". $wh ."  vspace=3 hspace=10 title=\"".str_replace("\"", "", str_replace("\'", "",$nazv))."\" ",  stripslashes(@$foto1));

@$foto1=str_replace("border=0", "border=0", @$foto1);


$pic="<table border=0><td><a href=\"index.php?unifid=".$unif."\">$foto1</a></td><td>$sales</td></table>";

$chars=intval(strlen($ift[0]));
$soritems=@$ift[0];


if ($chars==1): $sortbyitems="000000000$soritems"; endif;
if ($chars==2): $sortbyitems="00000000$soritems"; endif;
if ($chars==3): $sortbyitems="0000000$soritems"; endif;
if ($chars==4): $sortbyitems="000000$soritems"; endif;
if ($chars==5): $sortbyitems="00000$soritems"; endif;
if ($chars==6): $sortbyitems="0000$soritems"; endif;
if ($chars==7): $sortbyitems="000$soritems"; endif;
if ($chars==8): $sortbyitems="00$soritems"; endif;
if ($chars==9): $sortbyitems="0$soritems"; endif;
if ($chars==10): $sortbyitems="$soritems"; endif;
if ($price!=0) {
$kwr[$kws]="<!-- $sortbyitems -->$pic"."^<a href=\"index.php?unifid=".$unif."\">".$ift[1]."</a><!-- $soritems --><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\">";
$kws+=1;
}
}
}


}
fclose($f);


$ds=1;
@rsort($kwr);
@reset( $kwr);
$items_admined="";
while (list ($line_num, $line) = @each ($kwr)) {
$items_admined.=str_replace("^","<b><font color=$nc4 size=4>$ds.</font> </b> ", $line);
if ($ds>=$maximum_indexed_items) {break;}
$ds+=1;
}




$fileitemf=fopen("$base_loc/top10_index.txt","w");
flock ($fileitemf, LOCK_EX);
fputs($fileitemf, $items_admined);
flock ($fileitemf, LOCK_UN);
fclose ($fileitemf);
$items_admined = "<h4>".$lang['index_ok']."</h4> $items_admined";

?>
