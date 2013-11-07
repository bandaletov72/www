<?php
$bredit="";
$minorderblock="";
$spisoks="";
$rating=Array();

$wh="";
$spisok="";
$pricetax="";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
$site="";
$text="";
$brandimg="";
$kolvos=Array();
$rating=Array();
if ($sub=="") {
require "./modules/lastgoods.php";
//echo $lastgoods_spisok;
$make_col=$lastgoods_cols;
$st=0;
reset($podstava);
while (list ($c_num, $c_line) = each ($podstava)) {
//echo $c_num." ".$c_line."<br>";
$expl=explode("|",$c_num);
if (($expl[0]==$r)&&($expl[1]!="")) {
$ssubs[$c_num]= $c_line."|".$expl[1];
$st+=1;
$needcols=@$colordirs[$expl[0]];
if ($needcols!="") {$needcd=$needcols; } else {$needcd=$nc10;}
if ($podstavas["$r|".$expl[1]."|"]!=""){
$sps4[$c_num].="<br><font color=$nc3><b>".$podstavas["$r|".$expl[1]."|"]."%</b> $lang[233]</font>";
}
if ((!isset($logodirsy[$c_num]))||($logodirsy[$c_num]=="")) {
if (@$sps3[$c_num]=="") {
if ($mod_rw_enable==0) {
$spisoks.="<div style=\"width: ".$el_width."px; height: ".$el_height."px; float: left; display: block; margin-left: 5;\"><img src=\"".$image_path."/pix.gif\" width=14 height=14 border=\"0\" style=\"background-color: $needcd\">&nbsp;&nbsp;<b><a href=\"$htpath/index.php?catid=".$c_line."\">".@$expl[1]."</a></b>".@$sps4[$c_num]."</div>\n";
} else {
$spisoks.="<div style=\"width: ".$el_width."px; height: ".$el_height."px; float: left; display: block; margin-left: 5;\"><img src=\"".$image_path."/pix.gif\" width=14 height=14 border=\"0\" style=\"background-color: $needcd\">&nbsp;&nbsp;<b><a href=\"$htpath/".$c_line."\">".@$expl[1]."</a></b>".@$sps4[$c_num]."</div>\n";
}
} else {
if ($mod_rw_enable==0) {
$spisoks.="<div style=\"width: ".$el_width."px; height: ".$el_height."px; float: left; display: block; margin-left: 5;\"><table border=0 cellpadding=0 cellspacing=0><tr><td align=center><a href=\"$htpath/index.php?catid=$c_line\" title=\"".$expl[1]."\">".$sps3[$c_num]."</a><br><img src=\"".$image_path."/pix.gif\" width=8 height=8 border=\"0\" style=\"background-color: $needcd\">&nbsp;<b><a href=\"$htpath/index.php?catid=".$c_line."\">".$expl[1]."</a></b>$sps4[$c_num]</td></tr></table></div>\n";
} else {
$spisoks.="<div style=\"width: ".$el_width."px; height: ".$el_height."px; float: left; display: block; margin-left: 5;\"><table border=0 cellpadding=0 cellspacing=0><tr><td align=center><a href=\"$htpath/$c_line\" title=\"".$expl[1]."\">".$sps3[$c_num]."</a><br><img src=\"".$image_path."/pix.gif\" width=8 height=8 border=\"0\" style=\"background-color: $needcd\">&nbsp;<b><a href=\"$htpath/".$c_line."\">".$expl[1]."</a></b>$sps4[$c_num]</td></tr></table></div\n";
}
}	} else {

$wh="";
$htpat=str_replace("http://www.", "http://",$htpath);
$logodirsy[$c_num]=str_replace("http://www.", "http://", str_replace("\"","'", $logodirsy[$c_num]));
@$fi=str_replace($htpat,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$logodirsy[$c_num]),"src=")."src=","", stripslashes(@$logodirsy[$c_num]))),">")," "));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){

$imagesz = @getimagesize(".$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/$kkd1)." height=".ceil(($imagesz[1])/$kkd1)."";
if ($wh==" width=\"\" height=\"\"") {$wh="";}
if ($wh==" width=\"0\" height=\"0\"") {$wh="";}
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];if ($wh==" width=\"\" height=\"\"") {$wh="";}
if ($wh==" width=\"0\" height=\"0\"") {$wh="";}}
}

//$logodirsy[$cnum]=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img class=img". $wh ." ",stripslashes(@$logodirsy[$c_num]))));









if ($mod_rw_enable==0) {
$spisoks.="<div style=\"width: ".$el_width."px; height: ".$el_height."px; float: left; display: block; margin-left: 5;\"><table border=0 cellpadding=0 cellspacing=0><tr><td align=center><a href=\"$htpath/index.php?catid=$c_line\" title=\"".$expl[1]."\">".$logodirsy[$c_num]."</a><br><img src=\"".$image_path."/pix.gif\" width=8 height=8 border=\"0\" style=\"background-color: $needcd\">&nbsp;<b><a href=\"$htpath/index.php?catid=".$c_line."\">".$expl[1]."</a></b>$sps4[$c_num]</td></tr></table></div>\n";
} else {
$spisoks.="<div style=\"width: ".$el_width."px; height: ".$el_height."px; float: left; display: block; margin-left: 5;\"><table border=0 cellpadding=0 cellspacing=0><tr><td align=center><a href=\"$htpath/$c_line\" title=\"".$expl[1]."\">".$logodirsy[$c_num]."</a><br><img src=\"".$image_path."/pix.gif\" width=8 height=8 border=\"0\" style=\"background-color: $needcd\">&nbsp;<b><a href=\"$htpath/".$c_line."\">".$expl[1]."</a></b>$sps4[$c_num]</td></tr></table></div\n";
}
}
//if ($st==$make_col) { $st=0; $spisoks.="</tr></table><table border=0 cellspacing=5 cellpadding=5 width=100%><tr>";}
}
unset($expl);
}

$spisoks = "<center><div width=100% align=center class=box>
  <table border=0 cellpadding=5 cellspacing=10>
    <tr>
      <td align=center><div style=\"overflow: hidden;\" align=center><center>
$spisoks
</center></div>
</td>
</tr>
</table></div>
</center>\n";





} else {
reset($podstava);
//Бренды
$brnimg="";
$brtab=Array();
$brtab2=Array();
if (@file_exists("$base_loc/items/$catid".".br")){
$brnimg=file("$base_loc/items/$catid".".br");
while (list ($br_num, $br_line) = each ($brnimg)) {
$img="";
$site="";
$text="";
$br_line=trim($br_line);

if ($br_line!=$lang[417]) {
if (@file_exists("$base_loc/$br_line".".text")){
$imfile = fopen ("$base_loc/$br_line".".text", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$br_line".".text</b> unable to open.\n";
exit;
}
$text=@fread($imfile, @filesize("$base_loc/$br_line".".text"));
fclose ($imfile);
unset($imfile);
} else {
$text="";
}
if (@file_exists("$base_loc/$br_line".".site")){
$imfile = fopen ("$base_loc/$br_line".".site", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$br_line".".site</b> unable to open.\n";
exit;
}
$site=@fread($imfile, @filesize("$base_loc/$br_line".".site"));
fclose ($imfile);
unset($imfile);
} else {
$site="";
}
if (@file_exists("$base_loc/$br_line".".img")){
$imfile = fopen ("$base_loc/$br_line".".img", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$br_line".".img</b> unable to open.\n";
exit;
}

$img=@fread($imfile, @filesize("$base_loc/$br_line".".img"));
fclose ($imfile);
unset($imfile);
if (trim($img)=="") {
$brtab[$br_num]="<!-- ".translit($br_line)." ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=".rawurlencode($br_line)."\">$br_line</a></td>";

} else {
$brtab[$br_num]="<!-- ".translit($br_line)." ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=".rawurlencode($br_line)."\" title=\"$br_line\">$img</a><br><small><a href=\"$htpath/index.php?catid=$catid&brand=".rawurlencode($br_line)."\">$br_line</a></small></td>";
}

if ($brand==$br_line) {
$brtab2[$br_num]="<!-- ".translit($br_line)." ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><b style=\"border-bottom: 1px dotted; font-weight:400;\">$br_line</b></td>";
} else {
$brtab2[$br_num]="<!-- ".translit($br_line)." ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=".rawurlencode($br_line)."\">$br_line</a></td>";
}
} else {
$img="";
$brtab[$br_num]="<!-- ".translit($br_line)." ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=".rawurlencode($br_line)."\">$br_line</a></td>";
if ($brand==$br_line) {
$brtab2[$br_num]="<!-- ".translit($br_line)." ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><b style=\"border-bottom: 1px dotted; font-weight:400;\">$br_line</b></td>";
} else {
$brtab2[$br_num]="<!-- ".translit($br_line)." ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=".rawurlencode($br_line)."\">$br_line</a></td>";
}
}
} else {
//Тут будет обработка разных
$brtab[$br_num]="<!-- zzz ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=nobrand\"><h4>".$lang[417]."</h4></a></td>";
if ($brand=="nobrand") {
$brtab2[$br_num]="<!-- zzz ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><b style=\"border-bottom: 1px dotted; font-weight:400;\">".$lang[417]."</b></td>";
}else {
$brtab2[$br_num]="<!-- zzz ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=nobrand\">".$lang[417]."</a></td>";
}
}
}
}
$brtab2[]="<!-- zzzz ---><td valign=center align=middle width=\"".round(100/$brands_cols)."%\"><a href=\"$htpath/index.php?catid=$catid&brand=\">".$lang[422]."</a></td>";

sort($brtab);
reset($brtab);
sort($brtab2);
reset($brtab2);
$brc=0;
$brbr2="<!-- brands2 --><div class=ocat1><table width=100% border=0><tr>";
$brbr= "<!-- brands --><div class=ocat1><table width=100% border=0><tr>";
while (list ($br_num, $br_line) = each ($brtab)) {
$brbr.= $br_line;
$brc+=1;
if ($brc>=$brands_cols) { $brbr.= "</tr><tr>"; $brc=0;}
}
$brc=0;
while (list ($br_num, $br_line) = each ($brtab2)) {
$brbr2.= $br_line;
$brc+=1;
if ($brc>=$brands_cols) { $brbr2.= "</tr><tr>"; $brc=0;}
}
$brbr2.="</tr></table></div>";
$brbr.= "</tr></table></div>";

if (count($brtab2)<=1) {$brbr2="";}
if (count($brtab)<1) {$brbr="";}
if (($brand!="")||(substr($catid,-1)!="_")) {$brbr=$brbr2;}
//




if ($brand!="") {
if ($brand=="nobrand") {
$brandimg="<div align=left style=\"white-space: nowrap;\"><b><font size=4 color=$nc5>".$lang[417]."</font></b></div>";
} else {
$brandimg="<div align=left style=\"white-space: nowrap;\"><b><font size=4 color=$nc5>$brand</font></b></div>";
}
$img="";
if (($valid=="1")){
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
$bredit="<div align=left><a href=\"#a\" onclick=\"javascript:window.open('".$htpath."/admin/edit/index.php?speek=$speek&amp;working_file=../."."$base_loc/".rawurlencode($brand)."".".img','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" class=btn>i&nbsp;&nbsp;&nbsp;".$lang[861]."</a></div>";
}}
if ($brand!="nobrand") {
if (@file_exists("$base_loc/$brand".".img")){
$imfile = fopen ("$base_loc/$brand".".img", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$brand".".img</b> unable to open.\n";
exit;
}
$img=@fread($imfile, @filesize("$base_loc/$brand".".img")).$bredit;
fclose ($imfile);
unset($imfile);
} else { $img="$bredit";}
$bredit="";
if (($valid=="1")){
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
$bredit="<div align=left><a href=\"#a\" onclick=\"javascript:window.open('".$htpath."/admin/edit/index.php?speek=$speek&amp;working_file=../."."$base_loc/".rawurlencode($brand)."".".text','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" class=btn>V&nbsp;&nbsp;&nbsp;".$lang['short']."</a></div>";
}}
if (@file_exists("$base_loc/$brand".".text")){
$imfile = fopen ("$base_loc/$brand".".text", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$brand".".text</b> unable to open.\n";
exit;
}
$text=@fread($imfile, @filesize("$base_loc/$brand".".text")).$bredit;
fclose ($imfile);
unset($imfile);
}else { $text="$bredit";}
$bredit="";
if (($valid=="1")){
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
$bredit="<div align=left><a href=\"#a\" onclick=\"javascript:window.open('".$htpath."/admin/edit/index.php?speek=$speek&amp;working_file=../."."$base_loc/".rawurlencode($brand)."".".site','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" class=btn>L&nbsp;&nbsp;&nbsp;".$lang[810]."</a></div>";
}}
if (@file_exists("$base_loc/$brand".".site")){
$imfile = fopen ("$base_loc/$brand".".site", "r");
if (!$imfile) {
echo "<p> File <b>.$base_loc/$brand".".site</b> unable to open.\n";
exit;
}
$site=@fread($imfile, @filesize("$base_loc/$brand".".site"));
fclose ($imfile);
unset($imfile);
}else { $site="";}



}

if (($site=="")&&($bredit=="")) { } else { $site="<a href=\"$site\">$site</a>$bredit<br><br>";}
$bredit="";
if ($text!="") {$text="$text<br><br>";}
$brandimg="<div class=round3><table border=0 cellspacing=5 cellpadding=5 width=100%><tr>
<td valign=top>".$img."</td><td align=left valign=top width=100%><b><font size=3>$brandimg</font></b>$text$site</td></tr></table></div>";
}


$curp=1;
$nit=1;
$wim="";
$wup="";
unset($sps);
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact shveps@dpz.ru to buy license for this host."; exit;}
if ((!@$buy_row) || (@$buy_row=="")): $buy_row=""; endif;
if ((!@$novinka) || (@$novinka=="")): $novinka=""; endif;
if ((!@$qty) || (@$qty=="")): $qty=0; endif;
if ((!@$sss) || (@$sss=="")): $sss=0; endif;
if ((!@$perpage) || (@$perpage=="")): $perpage=$goods_perpage; endif;
if (!preg_match('/^[0-9_]+$/',$perpage)) { $perpage=$goods_perpage;}
if ($perpage>100) {$perpage=$goods_perpage;}
if ((!@$start) || (@$start=="")): $start=0; endif;
if (!preg_match('/^[0-9_]+$/',$start)) { $start=0;}
if ($start>99999) {$start=0;}


if ((!@$sub) || (@$sub=="")): $sub=""; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;
if (($r!="")&&($sub!="")): $qw1="dir"; $qqw1="r"; $qw2="subdir"; $qqw2="sub"; endif;
if (($r!="")&&($sub=="")): $qw1="dir"; $qqw1="r"; $qw2="dir"; $qqw2="dir"; endif;
if (($r=="")&&($sub=="")): $qw1="dir"; $qqw1="dir"; $qw2="dir"; $qqw2="dir"; endif;


//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";
$cc_cart="";
$cartl[0]="";
if (@file_exists($c_filename)==TRUE) {
$custom_cart1=file("./templates/$template/$speek/custom_cart.inc");
if (@file_exists("./templates/$template/$speek/cc_".$catid.".inc")) {
$custom_cart2=file("./templates/$template/$speek/cc_".$catid.".inc");
$custom_cart=Array_merge($custom_cart1,$custom_cart2);
} else {
$custom_cart=$custom_cart1;
}



while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&($cc_line!="\n")&&(@$ccc[0]!="")&&(@$ccc[0]!="\n")&&(@$ccc[1]!="")&&(substr(@$ccc[0],0,2)!="g:")){

$ncc=17+$cc_num;
$fw=0;
reset ($whsalerprice);
while(list($kk,$vv)=each($whsalerprice)) {
if ($vv==$ncc){$fw=1;}
}

if ($fw==0) {
$cartl[$ncc]=trim(@$ccc[1]);
$cartl2[$ncc]=trim(@$ccc[2]);
$cartl3[$ncc]=trim(@$ccc[3]);
$cartl4[$ncc]=trim(@$ccc[4]);

}
}
}
}



$spisok = "";
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


if (("$catid"!="0")&&($catid!="")&&($catid!="_")) {

if (!file_exists("$base_loc/items/$catid.txt")) {
$file="$base_file";

} else {
$file="$base_loc/items/$catid.txt";
}
} else {
$file="$base_file";
}

if(($details[7]=="ADMIN")||($details[7]=="MODER")){


if (("$valid"=="1")){
if ($admin_speedup==1) {
	$file="$base_loc/items/$catid.txt";
    $rating=@file("./admin/comments/$catid.rate");
	} else {
	$file="$base_file";
    $rating=@file("./admin/comments/rate.txt");
	}
	$rating=@file("./admin/comments/rate.txt");
	} else {
	$rating=@file("./admin/comments/$catid.rate");
	$file="$base_loc/items/$catid.txt";
	}
} else {

$rating=@file("./admin/comments/$catid.rate");
//while (list ($r_num, $r_line) = each ($rating)) {
//	echo "$r_num $r_line<br>";
//	}
}
if (file_exists($file)) {
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {


$st=fgets($f);
reset($langs);
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$st=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $st));
}else{
$st=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $st));
}
}
// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
$inbasket=0;
$inb1="";
$inb2="";
$ddescription="";
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];

$view_callbacks=$view_callback;
if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$out[6].$artrnd), -7));
@$nazv=strtoken(@$out[3],"*")." ". $out[13];
} else {
@$ext_id=@$out[6];
@$nazv=@$out[3];
}


@$price=@$out[4];

$fix=strlen(ExtractString("[zz]".str_replace(",", ".", $okr)."/", ".", "/"));
$tax="";
$tax=@$out[$taxcolumn];
if ($tax=="") {$tax=$deftax;}
@$opt=@$out[5];
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


@$description=@$out[7];

$admin_functions="";
$vipold="";
//OPT
$didx=@$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$out[$ddidx])*$kurss/$okr)); $price=@$out[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
$sales="";
if ($zero_price_incart==0){

if (($price==0)||($price=="")){ $prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
} else {
if (($price==0)||($price=="")){$prem1=""; $prem2=""; $prbuy=" ";} else {$prem1="";$prem2="";$prbuy=""; }

}

//opt
$strto=0;
if(substr($details[7],0,3)!="OPT") {


if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {
$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=@$strtoma[0];
unset($strtoma);

$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) {
$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle; align: center; white-space:nowrap\"><font color=white style=\"font-size:7pt;line-height: 8pt;\">&nbsp;SALE<br><b>&nbsp;-".round($strto)."%</b></font></td></tr></table>";
$ueprice=@$ueprice-@$ueprice*(doubleval($strto))/100;
$price=$okr*(round((@$price-@$price*(doubleval($strto))/100)/$okr));

} else {
$strto=doubleval($podstavas["$dir|$subdir|"]);
$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle; align: center; white-space:nowrap\"><font color=white style=\"font-size:7pt;line-height: 8pt;\">&nbsp;SALE<br><b>&nbsp;-".$podstavas["$dir|$subdir|"]."%</b></font></td></tr></table>";
@$ueprice=@$ueprice-@$ueprice*((double)$podstavas["$dir|$subdir|"])/100;
$price=$okr*(round((@$price-@$price*((double)$podstavas["$dir|$subdir|"])/100)/$okr));
}
} else {
if (($valid=="1")&&($details[7]=="VIP")){
//@$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueprice]</font></small>";
$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
@$price=$okr*round((@$price-@$price*$vipprocent)/$okr);
@$ueprice=@$ueprice-@$ueprice*$vipprocent;
}
}

//eof opt
}
if (doubleval($strto)==0) {$sales=""; $vipold="";}
if (($valid=="1")&&($details[7]=="ADMIN")){
@$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>) <font color=\"#a0a0a0\">[ $ueopt ]</font> ART: ".$out[6]."</small>";
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
if ($admin_speedup==1) {
$admin_functions = "<br><div align=center><small><button type=\"button\" class=btn onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=".$out[0]."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10') title=\"".$lang['ch']."\"><font color=#468847>V</font>&nbsp;<small>".$lang['ch']."</small></button> <button type=\"button\" class=btn onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=".$out[0]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang[137]."\"><font color=#f89406>Cc</font>&nbsp;<small>".$lang[137]."</small></button> <button type=\"button\" class=btn onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=".$out[0]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang['del']."\"><font color=$nc3>X</font>&nbsp;<small>".$lang['del']."</small></button><br>".$lang[983]."</small></div>";
} else {
$admin_functions = "<br><div align=center><small><button type=\"button\" class=btn onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=$ff&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10') title=\"".$lang['ch']."\"><font color=#468847>V</font>&nbsp;<small>".$lang['ch']."</small></button> <button type=\"button\" class=btn onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang[137]."\"><font color=#f89406>Cc</font>&nbsp;<small>".$lang[137]."</small></button> <button type=\"button\" class=btn onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=$ff','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang['del']."\"><font color=$nc3>X</font>&nbsp;<small>".$lang['del']."</small></button><br>".$lang[982]."</small></div>";
}
}
}

if(@$podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}

@$kwords=@$out[8];

//опции
$optionselect="";
$xz=0;
$fo=0;
@$out[8]=@$out[8]." ";
while ($xz<50) {
if (preg_match("/option".$xz." /", @$out[8])==TRUE) {$fo=1; $view_callbacks=0; $optionselect.=@$optio[($xz-1)];}
$xz+=1;
}
if ($fo==1) {$optionselect="<br><table border=0>$optionselect</table>";}


@$foto1=@$out[9];

@$foto2=@$out[10];
@$vitrin=@$out[11];
$sqrp="/$vitrin";
if (("$vitrin"=="0")||($vitrin=="")||($vitrin==$lang['pcs'])) {$vitrin=$lang['pcs']; $sq=0; $sqrp="";} else {$sq=1;}
if (doubleval(@$out[$minorderrow])>=1) {$minorder=doubleval(@$out[$minorderrow]); $minorder2=(doubleval(@$out[$minorderrow])*2); $minorderblock=" readonly=readonly"; $minsht="<br><font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1005]))."</font><br>"; $minupak="<font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1006]))."</font>";} else {$minorder=1; $minorder2=2; $minorderblock=""; $minsht=""; $minupak="";}

$buy_button_action2=$buy_button_action;
if (preg_match('/\[/', $description)==TRUE) {
$aofound=0;
$aocount=0;

while ($aocount>=0) {
$ao[$aocount] = ExtractString($description, "[option]", "[/option]");
if ($ao[$aocount]=="") {break; } else {
$subao=explode("#", $ao[$aocount]);
$subaocont="";
$subaoname="";
$aoptions="";
while (list($subaokey,$subaoval)=each($subao)) {
if ($subaokey==0) {$subaoname=$subaoval;} else {
$tmpaoval=explode("^","$subaoval");

if (substr($tmpaoval[1],-1)=="%") {} else {$add_valut=$currencies_sign[$_SESSION["user_currency"]];
if (substr($tmpaoval[1],0,1)=="-") {$add_znak="";} else {$add_znak="+";}
$aapr=($okr*(round(($tmpaoval[1]*$kurss)/$okr)));
$aad="";
if ($aapr>0) {
$aad=" $add_znak".$aapr."$add_valut"; }

$subaocont.="<option value=\"".str_replace ("<br>" , "", $subaoname.": ".$subaoval)."\">".$tmpaoval[0]."$aad</option>\n";
$aoptions.="opt['".str_replace ("<br>" , "", $subaoname.": ".$subaoval)."']=(0$add_znak".($okr*(round(($tmpaoval[1]*$kurss)/$okr))).");\n";
$fo=1;
$view_callbacks=0;
}
}
}

$description=str_replace("[option]".$ao[$aocount]."[/option]", "<script language=javascript>
function ao_".$s."_".$aocount."() {
var oll=document.getElementById('aopr_".$s."_".$aocount."').value;
var oldpr=(0+($okr*Math.round(document.getElementById('aopr_".$s."_".$aocount."').value/$okr)));
var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);
idx=document.getElementById('aoid_".$s."_".$aocount."').value;
opt=new Array();
opt['']=0;
$aoptions
var newpr=(Math.round((0+fixed+opt[idx])/$okr)*$okr);
newpr=newpr.toFixed($fix);
document.getElementById('span".$s."').innerHTML=newpr.toString();
document.getElementById('aopr_".$s."_".$aocount."').value=opt[idx];
}
</script>$radiooi<input type=hidden id=\"aopr_".$s."_".$aocount."\" value=0><span class=pull-left id=\"aotext_".$aocount."\"><b>".str_replace ("<br>" , "", trim($subaoname)).":</b></span><span class=pull-right><select class=input-medium name=\"ao[".$aocount."]\" id=\"aoid_".$s."_".$aocount."\" onchange=\"javascript:ao_".$s."_".$aocount."()\"><option value=\"\"></option>$subaocont</select></span><div class=clear></div></div>\n", $description);
}
$aocount+=1;
}


if (preg_match("/[radio]/i", $description)) {

$xxx=0;
$radio_found=0;
$radio_count=$aocount;
while ($radio_count>=0) {
$radio_[$radio_count] = ExtractString($description, "[radio]", "[/radio]");
if ($radio_[$radio_count]=="") {break; } else {
$subradio_=explode("#", $radio_[$radio_count]);
$subradio_cont="";
$subradio_name="";
while (list($subradio_key,$subradio_val)=each($subradio_)) {
if ($subradio_key==0) {$subradio_name=$subradio_val;} else {
$tmpradio_val=explode("^","$subradio_val");

if (substr($tmpradio_val[1],-1)=="%") {} else {$add_valut=$currencies_sign[$_SESSION["user_currency"]];
if (substr($tmpradio_val[1],0,1)=="-") {$add_znak="";} else {$add_znak="+";}
$aaad="\"".str_replace ("<br>" , "", trim($subradio_name)).": ".str_replace ("<br>" , "", trim($tmpradio_val[0]))."^".str_replace ("<br>" , "", trim($tmpradio_val[1]))."\"";
$aapr=($okr*(round(($tmpradio_val[1]*$kurss)/$okr)));
$aad="";
if ($aapr>0) {
$aad=" $add_znak".$aapr."$add_valut";}
$subradio_cont.=$radiodiv.str_replace ("<img " , "<img align=absmiddle style=\"margin: 0px 0px 0px 0px;\" ", str_replace ("<br>" , "", trim($tmpradio_val[2])))."<input type=radio value=$aaad id=\"ao_". $radio_count."_".$xxx."_$s\" name=ao[". $radio_count."] onclick=\"javascript:var oldpr=(0+($okr*Math.round(document.getElementById('radio_pr_".$s."_".$radio_count."').value/$okr)));var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);var idx=(0$add_znak".($okr*(round(($tmpradio_val[1]*$kurss)/$okr))).");opt=new Array();var newpr=(Math.round((0+fixed+idx)/$okr)*$okr);newpr=newpr.toFixed($fix);document.getElementById('span".$s."').innerHTML=newpr.toString();document.getElementById('radio_pr_".$s."_".$radio_count."').value=idx;\"><label for=\"ao_".$radio_count."_".$xxx."_$s\">".$tmpradio_val[0]."$aad</label>$radioo\n";
$fo=1;
$view_callbacks=0;
$xxx++;
}
}
}
$description=str_replace("[radio]".$radio_[$radio_count]."[/radio]", "$radioos<b><input type=hidden id=\"radio_pr_".$s."_".$radio_count."\" value=0><span id=\"radio_text_".$radio_count."\">".str_replace ("<br>" , "", trim($subradio_name)).":</span></b></div>$subradio_cont$radiooe", $description);
}
$radio_count+=1;
}

} else {
$buy_button_action=0;
}
if (preg_match('/\[input/', $description)==TRUE) {
$description=str_replace("[input1]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input2]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input3]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[inputarea]", "<textarea name=ao[". $radio_count."] value=\"\" cols=42 rows=5 style=\"width:100%\"></textarea>", $description);
$fo=1;
}
if (preg_match('/\[upload/', $description)==TRUE) {
require "./templates/$template/upload.inc";
$description=str_replace("[upload]", $upload, $description);
$fo=1;
}
}
$description.="<input type=hidden name=\"aosign\" value=\"$curcur\">";
@$onsale=substr(@$out[12],0,1);

reset($cartl);
if ($view_custom_cart_inlist==1) {
while (list ($cac_num, $cac_line) = each ($cartl)) {

if (($cac_line!="")&&($cac_line!="\n")&&(trim(@$out[$cac_num])!="")&&($cac_num!=$taxcolumn)&&($cac_num!=$othertaxcolumn)&&($cac_num!=$catdirrow3)&&($cac_num!=$catdirrow4)&&($cac_num!=$metatitlerow)&&($cac_num!=$metadescrow)&&($cac_num!=$metakeyrow)) {
if (($cartl3[$cac_num]=="kit")||($cartl3[$cac_num]=="kit2")) {
$tw=0;
$ts=0;
unset ($hc);
$kit_content="<table class=\"table table-striped\">\n<tr><td><b>#</b></td><td><b>".implode("</b></td><td><b>", explode(";", str_replace("[curr]", substr(@$out[12],1),@$cartl4[$cac_num])))."</b></td></tr>\n";
unset($hc);
$hc=explode("<br>", trim(@$out[$cac_num]));
while (list ($hk, $hv) = each ($hc)) {
if (trim($hv)!="") {
$str=substr($hv,0,(strlen($hv)-1));
if ($cartl3[$cac_num]=="kit2") {$tmp=explode(";",$str); $ts+=doubleval(str_replace(",",".",$tmp[1]))*doubleval(str_replace(",",".",$tmp[2])); $tw+=$tmp[1];}
$kit_content.="<tr><td>".($hk+1).".</td><td>".str_replace(";", "</td><td>",$str)."</tr>\n";
}
}
if ($cartl3[$cac_num]=="kit2") {$kit_content.="<tr><td colspan=4><hr><div class=pull-left><b>".$lang[217].":</b></div><div class=pull-right>".$ts." <b>".substr(@$out[12],1)."</b></div><div class=clearfix></div></td>";}

$kit_content.="\n</table>";
$ddescription.="<div class=customdiv><div><b>$cac_line: </b></div><div>". $kit_content ."</div></div>\n";

unset ($kit_content);


} else {
if(($cartl3[$cac_num]=="location")||($cartl3[$cac_num]=="hidden")) { } else {
$ddescription.="<div class=customdiv><div class=pull-left><b>$cac_line: </b></div><div class=pull-right>". @$out[$cac_num] ." ". $cartl2[$cac_num]."</div><div class=clear></div></div>\n";
}
}
}
}
}
if ($full_wiki_repl==1) {$ddescription=wikify($ddescription,"");$description=wikify($description,"");}

if ($view_deleted_goods==0) {if (($price==0)||($price=="0")||($price=="")){if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {$ff+=1; continue;} }}
if ((doubleval($onsale)==0)||($price<$priceot)||($price>$pricedo)): $ff+=1; continue; endif;

@$brand_name=@$out[13];

if ($brand=="") {
//бренд не указан
if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
if (preg_match("/\.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"MP3\" border=0></a>&nbsp;&nbsp;"; }
unset ($awv1, $awv2);
$wh="";

if (!isset($out[3])) {$out[3]=""; }
if (($varcart>=100)||($varcart==15)) {
$foto1=str_replace("<img ", "<img vspace=3 hspace=10 ",  stripslashes(@$foto1));
} else {
if ($hidart==1) {
$foto1=str_replace("<img ", "<img vspace=3 title=\"".str_replace("\"", "", str_replace("\'", "",strtoken($out[3],"*")))."\" ",  stripslashes(@$foto1));
} else {
$foto1=str_replace("<img ", "<img vspace=3 title=\"".str_replace("\"", "", str_replace("\'", "",$out[3]))."\" ",  stripslashes(@$foto1));
}
}
@$foto1=str_replace("border=0", " class=img border=0 align=left style=\"margin-bottom: 5px;\"", @$foto1);
$lid=md5(@$out[3]." ID:".@$out[6]);
$kolvos[$lid]=@$out[16];
$ff+=1;

if ((@$$qw1==@$$qqw1) && (@$$qw2==@$$qqw2)) {
$rat=doubleval(trim($rating[($ff-1)]));
//echo $ff." ".$out[3]." ".$rat." ".$rating[($ff-1)]."<br>\n";

$qty=doubleval($qty);
if($qty!=0){ $shtuk=$vitrin;
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>"; if ($view_basketalert==1) { $kupil.="<a id=minibasket_"."$unifid href=$htpath/minibasket.php?unifid=$lid&amp;qty=$qty&amp;speek=$speek></a><script type=\"text/javascript\">
        $(document).ready(function() {
           $(\"#minibasket_$lid\").fancybox({
                   'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                           'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false
           }).trigger('click');

        });
    </script>";} } else { $kupil=""; }}
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
$sortby="";
if ($sorting=="price") {
if ($prbuy!="") {if ($way=="down") {$sf=0;} else {$sf=$maximumprice;}} else {$sf=$price;}
if ($stinfo=="int") { if (@$out[16]==0) {if ($way=="down") {if ($prbuy!="") {$sf=0;}else {$sf=1;}} else {$sf=($maximumprice-$price);}} }

//echo "1-$price $nazv $sf<br>";
$sf=round($sf*100);
$chars= intval(strlen($sf));
//echo $chars."<br>";
if ($chars==1): $sortby="00000000000$sf"; endif;
if ($chars==2): $sortby="0000000000$sf"; endif;
if ($chars==3): $sortby="000000000$sf"; endif;
if ($chars==4): $sortby="00000000$sf"; endif;
if ($chars==5): $sortby="0000000$sf"; endif;
if ($chars==6): $sortby="000000$sf"; endif;
if ($chars==7): $sortby="00000$sf"; endif;
if ($chars==8): $sortby="0000$sf"; endif;
if ($chars==9): $sortby="000$sf"; endif;
if ($chars==10):$sortby="00$sf"; endif;
if ($chars==11):$sortby="0$sf"; endif;
}

if ($sorting=="name") {
$sortby=str_replace("<!--", "", str_replace("-->", "","$nazv"));
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

if ($sorting=="rate") {
$chars=intval(strlen($rating[($ff-1)]));
if ($rat==0) { if ($way=="up") {$rat=999999-$ff;} }
if ($chars==1): $sortby="00000".$rat; endif;
if ($chars==2): $sortby="0000".$rat; endif;
if ($chars==3): $sortby="000".$rat; endif;
if ($chars==4): $sortby="00".$rat; endif;
if ($chars==5): $sortby="0".$rat; endif;
if ($chars==6): $sortby="".$rat; endif;

}

$voterate="";
if ($view_comments==1) {if (($rat>=1)&&($rat<=5)) {$voterate="<br><img src=\"$image_path/vote".$rat.".png\" border=0>"; }}
if ($nazv!="") {
$big="";
$novina=""; if ((@$out[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/i",@$out[8])==TRUE) { $novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}
if (($valid=="1")&&($details[7]=="VIP")): $fo=1; endif;
$inbasket=doubleval($cart->get_item(md5(@$out[3]." ID:".@$out[6])."|"));
if ($inbasket==0) {$inbasket="";$inb1="";$inb2="";} else {$inb1=$inb0; $inb2=" $vitrin";}
$price=str_replace(",",".",$price);
$ppp=str_replace(",",".",$ppp);
if ($vipold!="") {$spprice="newprice";} else {$spprice="price";}
$llid="<a href=\"$htpath/index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {
$man=translit(@$out[3])."-".translit(@$out[6]);
if ($mod_rw_enable==0) { $llid="<a href=\"$htpath/index.php?item_id=".$man."\">"; }else {$llid="<a href=\"$htpath/".$man.".htm\">";}
}
}
$bskalert="";
if ($view_basketalert==1) {
$bskalert="<script language=javascript>
function inb_$lid() {
jQuery(document).ready(function() {
	\$.fancybox (
		'<p><b>$nazv</b> $lang[208]</p><p>".$lang[860]."</p>',
		{
        	'autoDimensions'	: false,
			'width'         	: 450,
			'height'        	: 'auto',
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false
		}
	);
});
}
</script>";}
if (($price==0)||(doubleval($onsale)!=1)) {$description=strtoken($description,"<input");}
if ($sq==1) {

eval ($evstr2);
	}else {
if ($fo==1) {
eval ($evstr2);
} else {
eval ($evstr);}
}
if (($foto1!="")&&($view_vitrin!=0)&&($price!=0)): $vitrin_content[$vit_qty] = "$file|$dir|$subdir|$nazv ID:".@$out[6]."|$price|$opt|$description|$foto1|$ff|"; $vit_qty+=1; endif;
$files_found += 1;
$s+=1;
}
}

} else {
if ($brand=="nobrand") {
//нет бренда
if ($brand_name!=""): $ff+=1; continue; endif;
if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
//if (@$ext_lnk!=""):$linkfile=" <a href=\"$htpath/index.php?page=$ext_lnk\"><img src=\"".$image_path."/link.gif\" title=\"Доп.информация\" border=0></a>";endif;
unset ($awv1, $awv2);
$wh="";

if (($varcart>=100)||($varcart==15)) {
$foto1=str_replace("<img ", "<img vspace=3 ",  stripslashes(@$foto1));
} else {
if ($hidart==1) {
$foto1=str_replace("<img ", "<img vspace=3 title=\"".str_replace("\"", "", str_replace("\'", "",strtoken($nazv,"*")))."\" ",  stripslashes(@$foto1));
} else {
$foto1=str_replace("<img ", "<img vspace=3 title=\"".str_replace("\"", "", str_replace("\'", "",$nazv))."\" ",  stripslashes(@$foto1));
}
}
@$foto1=str_replace("border=0", "border=0 align=left", @$foto1);
$lid=md5(@$out[3]." ID:".@$out[6]);
$kolvos[$lid]=@$out[16];
$ff+=1;
if ((@$$qw1==@$$qqw1) && (@$$qw2==@$$qqw2)) {
$qty=doubleval($qty);
if($qty!=0){ $shtuk=$vitrin;
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>"; if ($view_basketalert==1) { $kupil.="<script language=\"javascript\">window.open('$htpath/minibasket.php?unifid=$unifid&amp;qty=$qty&amp;speek=$speek','buy','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=540,height=180,left=220,top=200')</script>"; } } else { $kupil=""; }}
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
$sortby="";
if ($sorting=="price") {
if ($prbuy!="") {if ($way=="down") {$sf=0;} else {$sf=$maximumprice;}} else {$sf=$price;}
if ($stinfo=="int") { if (@$out[16]==0) {if ($way=="down") {if ($prbuy!="") {$sf=0;}else {$sf=1;}} else {$sf=($maximumprice-$price);}} }

$sf=round($sf*100);
$chars= intval(strlen($sf));
if ($chars==1): $sortby="00000000000$sf"; endif;
if ($chars==2): $sortby="0000000000$sf"; endif;
if ($chars==3): $sortby="000000000$sf"; endif;
if ($chars==4): $sortby="00000000$sf"; endif;
if ($chars==5): $sortby="0000000$sf"; endif;
if ($chars==6): $sortby="000000$sf"; endif;
if ($chars==7): $sortby="00000$sf"; endif;
if ($chars==8): $sortby="0000$sf"; endif;
if ($chars==9): $sortby="000$sf"; endif;
if ($chars==10):$sortby="00$sf"; endif;
if ($chars==11):$sortby="0$sf"; endif;
}
if ($sorting=="name") {
$sortby=str_replace("<!--", "", str_replace("-->", "","$nazv"));
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
$rat=doubleval(trim($rating[($ff-1)]));
if ($sorting=="rate") {
$chars=intval(strlen($rating[($ff-1)]));
if ($rat==0) { if ($way=="up") {$rat=999999-$ff;} }
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
$inbasket=doubleval($cart->get_item(md5(@$out[3]." ID:".@$out[6])."|"));
if ($inbasket==0) {$inbasket="";$inb1="";$inb2="";} else {$inb1=$inb0; $inb2=" $vitrin";}
$price=str_replace(",",".",$price);
$ppp=str_replace(",",".",$ppp);
if ($vipold!="") {$spprice="newprice";} else {$spprice="price";}
$llid="<a href=\"$htpath/index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {$man=translit(@$out[3])."-".translit(@$out[6]);
if ($mod_rw_enable==0) { $llid="<a href=\"$htpath/index.php?item_id=".$man."\">"; }else {$llid="<a href=\"$htpath/".$man.".htm\">";}}}
$bskalert="";
if ($view_basketalert==1) {
$bskalert="<script language=javascript>
function inb_$lid() {
jQuery(document).ready(function() {
	\$.fancybox (
		'<p><b>$nazv</b> $lang[208]</p><p>".$lang[860]."</p>',
		{
        	'autoDimensions'	: false,
			'width'         	: 450,
			'height'        	: 'auto',
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false
		}
	);
});
}
</script>";}
if (($price==0)||(doubleval($onsale)!=1)) {$description=strtoken($description,"<input");}
if ($sq==1) {
eval ($evstr2);
	}else {
if ($fo==1) {
eval ($evstr2);
} else {
eval ($evstr);}
}
if (($foto1!="")&&($view_vitrin!=0)&&($price!=0)): $vitrin_content[$vit_qty] = "$file|$dir|$subdir|$nazv ID:".@$out[6]."|$price|$opt|$description|$foto1|$ff|"; $vit_qty+=1; endif;
$files_found += 1;
$s+=1;
}
}

} else {
//есть бренд
if ($brand_name!=$brand): $ff+=1; continue; endif;
if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
//if (@$ext_lnk!=""):$linkfile=" <a href=\"$htpath/index.php?page=$ext_lnk\"><img src=\"".$image_path."/link.gif\" title=\"Доп.информация\" border=0></a>";endif;
unset ($awv1, $awv2);
$wh="";
if (($varcart>=100)||($varcart==15)) {
$foto1=str_replace("<img ", "<img vspace=3 ",  stripslashes(@$foto1));
} else {
if ($hidart==1) {
$foto1=str_replace("<img ", "<img vspace=3 title=\"".str_replace("\"", "", str_replace("\'", "",strtoken($nazv,"*")))."\" ",  stripslashes(@$foto1));
} else {
$foto1=str_replace("<img ", "<img vspace=3 title=\"".str_replace("\"", "", str_replace("\'", "",$nazv))."\" ",  stripslashes(@$foto1));
}
}
@$foto1=str_replace("border=0", "border=0 align=left", @$foto1);

$lid=md5(@$out[3]." ID:".@$out[6]);
$kolvos[$lid]=@$out[16];
$ff+=1;
if ((@$$qw1==@$$qqw1) && (@$$qw2==@$$qqw2)) {
$qty=doubleval($qty);
if($qty!=0){ $shtuk=$vitrin;
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>"; if ($view_basketalert==1) { $kupil.="<script language=\"javascript\">window.open('$htpath/minibasket.php?unifid=$unifid&amp;qty=$qty&amp;speek=$speek','buy','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=540,height=180,left=220,top=200')</script>"; } } else { $kupil=""; }}
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
$sortby="";

if ($sorting=="price") {
if ($prbuy!="") {  if ($way=="down") {$sf=0;} else {$sf=$maximumprice;}} else {$sf=$price;}

if ($stinfo=="int") { if (@$out[16]==0) {if ($way=="down") {if ($prbuy!="") {$sf=0;}else {$sf=1;}} else {$sf=($maximumprice-$price);}} }
$sf=round($sf*100);
$chars= intval(strlen($sf));
if ($chars==1): $sortby="00000000000$sf"; endif;
if ($chars==2): $sortby="0000000000$sf"; endif;
if ($chars==3): $sortby="000000000$sf"; endif;
if ($chars==4): $sortby="00000000$sf"; endif;
if ($chars==5): $sortby="0000000$sf"; endif;
if ($chars==6): $sortby="000000$sf"; endif;
if ($chars==7): $sortby="00000$sf"; endif;
if ($chars==8): $sortby="0000$sf"; endif;
if ($chars==9): $sortby="000$sf"; endif;
if ($chars==10):$sortby="00$sf"; endif;
if ($chars==11):$sortby="0$sf"; endif;
}
if ($sorting=="name") {
$sortby=str_replace("<!--", "", str_replace("-->", "","$nazv"));
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
$rat=doubleval(trim($rating[($ff-1)]));
if ($sorting=="rate") {
$chars=intval(strlen($rating[($ff-1)]));
if ($rat==0) { if ($way=="up") {$rat=999999-$ff;} }
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
$inbasket=doubleval($cart->get_item(md5(@$out[3]." ID:".@$out[6])."|"));
if ($inbasket==0) {$inbasket="";$inb1="";$inb2="";} else {$inb1=$inb0; $inb2=" $vitrin";}
$price=str_replace(",",".",$price);
$ppp=str_replace(",",".",$ppp);
if ($vipold!="") {$spprice="newprice";} else {$spprice="price";}
$llid="<a href=\"$htpath/index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {$man=translit(@$out[3])."-".translit(@$out[6]);
if ($mod_rw_enable==0) { $llid="<a href=\"$htpath/index.php?item_id=".$man."\">"; }else {$llid="<a href=\"$htpath/".$man.".htm\">";}}}
$bskalert="";
if ($view_basketalert==1) {
$bskalert="<script language=javascript>
function inb_$lid() {
jQuery(document).ready(function() {
	\$.fancybox (
		'<p><b>$nazv</b> $lang[208]</p><p>".$lang[860]."</p>',
		{
        	'autoDimensions'	: false,
			'width'         	: 450,
			'height'        	: 'auto',
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false
		}
	);
});
}
</script>";}
if (($price==0)||(doubleval($onsale)!=1)) {$description=strtoken($description,"<input");}
if ($sq==1) {
eval ($evstr2);
	}else {
if ($fo==1) {
eval ($evstr2);
} else {
eval ($evstr);}
}
if (($foto1!="")&&($view_vitrin!=0)&&($price!=0)): $vitrin_content[$vit_qty] = "$file|$dir|$subdir|$nazv ID:".@$out[6]."|$price|$opt|$description|$foto1|$ff|"; $vit_qty+=1; endif;
$files_found += 1;
$s+=1;
}
}
}

}


}
//Закрываем базу
fclose($f);
}
$make_col=$cols_of_goods; //
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
$gt = 0;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}

//$skl1=strtoken($sps[($start+$st)],"|");

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
$spisok .= "$val\n";
if ($st==$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $spisok.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=5 cellspacing=10 width=100%><tr>";}
}
$total = count ($sps)-$gt;
$numberpages = (ceil ($total/($perpage+0.000001)));

$startnew=$start+1;

$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;
if ($query!="") {$queryed="&query=".rawurlencode($query);} else {$queryed="";}


$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($start+$perpage) . "&amp;perpage=$perpage&brand=".rawurlencode($brand)."\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=0&amp;perpage=&brand=".rawurlencode($brand)."\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($start-$perpage) . "&amp;perpage=$perpage&brand=".rawurlencode($brand)."\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
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
$pp.= "<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&brand=".rawurlencode($brand)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&brand=".rawurlencode($brand)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=0&amp;perpage=$perpage&brand=".rawurlencode($brand)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=0&amp;perpage=$perpage&brand=".rawurlencode($brand)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($perpage*($numberpages-1)) . "&amp;perpage=$perpage&brand=".rawurlencode($brand)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }


if (!isset($view_compact)){} else { if($view_compact==1) { $poisks="";} else {$poisks="$ppages";}}
if ($usetheme==0) {
if ($view_goodsprice==1){ if ($view_sort==0) { $sortecho=""; }} else {$sortecho="";}
} else {
if ($view_goodsprice==1){ if ($view_sort!=0) { $themecontent=str_replace("[sortmenu]","$sortecho",$themecontent); $sortecho="";}else {$sortecho="";}} else {$sortecho="";}
}

if ($way=="up") {$wup="down"; $wim="<img border=0 title=\"".$lang['up']."\" src=\"".$image_path."/sort_up.png\" align=absmiddle align=absmiddle>";} else { $wup="up"; $wim="<img border=0 title=\"".$lang['down']."\" src=\"".$image_path."/sort_down.png\" align=absmiddle align=absmiddle>";}
$spisok_g=$spisok;
if ($view_brands_inlist==0) {$brbr="";}
$spisok="<table class=table2 border=0 width=100% cellpadding=0>
<tr><td valign=top>$brbr$brandimg$sortecho$ppages";

if ($varcart>=100) {$spisok.="<form class=form-inline action=\"index.php\" method=\"POST\">";

$spisok.="<input type=\"hidden\" name=\"catid\" value=\"$catid\"><input type=\"hidden\" name=\"query\" value=\"$query\"><input type=\"hidden\" name=\"brand\" value=\"".@$brand."\"><input type=\"hidden\" name=\"sorting\" value=\"$sorting\"><input type=\"hidden\" name=\"way\" value=\"$way\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"view\" value=\"$view\">";

$spisok.="<input type=\"hidden\" name=\"mnogo\" value=\"2\">";}

$spisok.="<table class=table2 border=0 cellspacing=10 cellpadding=5 width=100%>
<tr>
$spisok_g
</tr>
</table>";
if ($varcart>=100) {$spisok.="<div align=right><input id=\"totals\" type=\"hidden\" value=\"".$cart->total."\"><img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"50\" height=\"10\"><br><input type=submit value=\"".$lang[255]."\" class=\"regbut\"></div></form>";}
$spisok.="</td></tr>
</table>
<center><br>$ppages<br><br><br>
<script language=javascript>
function smf (imgsrc) {
document.getElementById('ItemModalLabel').innerHTML='".$lang[138]."';
document.getElementById('ItemModalBody').innerHTML=document.getElementById(imgsrc).innerHTML;
\$('#ItemModal').modal('show');
}
</script>
<!-- Modal -->
<div class=\"modal hide\" style=\"display: none; top:10px; bottom:10px; width:90%; left:10px; right:10px; margin-left:20px;\" id=\"ItemModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"ItemModalLabel\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h5 id=\"ItemModalLabel\"></h5>
</div>
<div class=\"modal-body\" id=\"ItemModalBody\">
</div>
<div class=\"modal-footer\">
<button class=\"btn\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</button>
</div>
</div>
</center>\n";
$total-=1;
unset($spisok_g);

if ($files_found==0): $spisok =""; $error = "<br><br><font color=$nc2><b>".$lang[94]."</b></font><br><br>"; endif;
if ($s==0):$vitrin_content[0]=""; $spisok="$sortecho<br><div class=alert><center><br><br><b>".$lang[94]."</b><br><br><br></center></div><br>"; endif;

}
$spisok=$spisoks.@$spisok;
?>
