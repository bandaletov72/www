<?php
$nn=0;
$perpage=20;
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ");
   return strtolower($str);
}
function toUpper($str) {
$str = strtr($str, "àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ",
"ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß");
   return strtoupper($str);
}
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
$fold="..";
$rrating="";

$sortas=0;
$fold=".."; require ("../templates/lang.inc");

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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("../templates/$template/$speek/config.inc");

require ("../modules/translit.php");
require "../templates/$template/css.inc";
echo "<!DOCTYPE html><html>
<TITLE>ACESSORIES</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
$css
<body bgcolor=#ffffff>
";
$wh="";
$spisok="";
$pricetax="";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
$site="";
$text="";
$brandimg="";
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
if (!preg_match("/^[0-9_]+$/",$perpage)) { $perpage=$goods_perpage;}
if ($perpage>100) {$perpage=$goods_perpage;}
if ((!@$start) || (@$start=="")): $start=0; endif;
if (!preg_match("/^[0-9_]+$/",$start)) { $start=0;}
if ($start>99999) {$start=0;}


if ((!@$sub) || (@$sub=="")): $sub=""; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;
if (($r!="")&&($sub!="")): $qw1="dir"; $qqw1="r"; $qw2="subdir"; $qqw2="sub"; endif;
if (($r!="")&&($sub=="")): $qw1="dir"; $qqw1="r"; $qw2="dir"; $qqw2="dir"; endif;
if (($r=="")&&($sub=="")): $qw1="dir"; $qqw1="dir"; $qw2="dir"; $qqw2="dir"; endif;

$okr=$currencies_round[$_SESSION["user_currency"]];
if ($okr==0) {$okr=0.01;}

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

$file=$dbpref."_items_".$speek;
//echo $file;

$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());
$h=explode("|", @$podst[$catid]);
//if (doubleval($priceot)!=0) { $add_query.= "AND `price`>".doubleval($priceot)." ";}
//if (doubleval($pricedo)!=999999999) {$add_query= "AND `price`<".doubleval($pricedo);}
if ($filter!="") {$add_query.=" AND `item_name` LIKE '".mysql_real_escape_string(@$filter)."' OR `code` LIKE '".mysql_real_escape_string(@$filter)."' OR `description` LIKE '".mysql_real_escape_string(@$filter)."'"; }
if ($view_deleted_goods==0) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {
$add_query.=" AND `on_offer`='1'";
}
}
$dirsubs="";
if (($h[0])&&($h[1])) {$dirsubs="`dir`='".mysql_real_escape_string(@$h[0])."' AND `subdir`='".mysql_real_escape_string(@$h[1])."' ";}
if (($dirsubs=="")&&($add_query=="")){
$mysql_query="SELECT * FROM $file";
} else {
if ($dirsubs=="") {
$mysql_query="SELECT * FROM $file WHERE (`price`>0"."$add_query)";
} else {
$mysql_query="SELECT * FROM $file WHERE ($dirsubs"."$add_query)";
}
}


$result=mysql_query("$mysql_query");
if (mysql_errno()) die("Error-1 $mysql_query; ".mysql_error());
$total=@mysql_num_rows($result);
//echo " total=".$total."<br>";
$orderby="";
$orderway="";
$ff=0;
if ($sorting=="") {$sorting="$def_sort"; }
if ($sorting=="date") {$orderby=""; $orderway=""; } else {
if ($sorting=="price") {$orderby=" ORDER BY price"; }
if ($sorting=="rate") {$orderby=" ORDER BY votes_level"; }
if ($sorting=="name") {$orderby=" ORDER BY item_name"; }
if ($way=="up") {$orderway=" ASC";} else {$orderway=" DESC";}
}
$dirsubs="";
if (($h[0])&&($h[1])) {$dirsubs="`dir`='".mysql_real_escape_string(@$h[0])."' AND `subdir`='".mysql_real_escape_string(@$h[1])."' ";}
if (($dirsubs=="")&&($add_query=="")){
$mysql_query="SELECT * FROM $file";
} else {
if ($dirsubs=="") {
$mysql_query="SELECT * FROM $file WHERE (`price`>0"."$add_query)";
} else {
$mysql_query="SELECT * FROM $file WHERE ($dirsubs"."$add_query)";
}
}
$mysql_query.="$orderby"."$orderway LIMIT ".mysql_real_escape_string($start).",".mysql_real_escape_string($perpage);
//echo $mysql_query;
$result=mysql_query("$mysql_query");
if (mysql_errno()) die("Error-1 $mysql_query; ".mysql_error());
while($row = @mysql_fetch_row($result)) {
$st="";
while(list($k,$v)=each($row)) {

//echo $k."=>".$v."<br>";
if ($k>9) {

$st.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}
//echo $st;
// òåïåðü ìû îáðàáàòûâàåì î÷åðåäíóþ ñòðîêó $st
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
$didx=@$details[7]; $ddidx=@$whsalerprice[$didx];
$ppp=($okr*round(doubleval(@$out[$ddidx])*$kurss/$okr));
$price=@$out[$ddidx]*$kurss;
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

$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) {
$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\"><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>";
$ueprice=@$ueprice-@$ueprice*(doubleval($strto))/100;
$price=$okr*(round((@$price-@$price*(doubleval($strto))/100)/$okr));

} else {

$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";
@$ueprice=@$ueprice-@$ueprice*((double)$podstavas["$dir|$subdir|"])/100;
$price=$okr*(round((@$price-@$price*((double)$podstavas["$dir|$subdir|"])/100)/$okr));
}
} else {
if (($valid=="1")&&($details[7]=="VIP")){
@$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueprice]</font></small>";
$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
@$price=$okr*round((@$price-@$price*$vipprocent)/$okr);
@$ueprice=@$ueprice-@$ueprice*$vipprocent;
}
}

//eof opt
}
if (($valid=="1")&&($details[7]=="ADMIN")){
@$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueopt]</font></small>";
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$admin_functions = "<br><div align=center><small><button type=\"button\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['ch']."\"><font color=#468847>V</font>&nbsp;<small>".$lang['ch']."</small></button> <button type=\"button\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang[137]."\"><font color=#f89406>Cc</font>&nbsp;<small>".$lang[137]."</small></button> <button type=\"button\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang['del']."\"><font color=#b94a48>X</font>&nbsp;<small>".$lang['del']."</small></button><br>".$lang[983]."</small></div>";
}
}

if(@$podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}

@$kwords=@$out[8];
//îïöèè
$optionselect="";
$xz=0;
$fo=0;
@$out[8]=@$out[8]." ";


@$foto1=@$out[9];
//if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
@$foto2=@$out[10];
@$vitrin=@$out[11];
$sqrp="/$vitrin";
if (("$vitrin"=="0")||($vitrin=="")) {$vitrin=$lang['pcs']; $sq=0; $sqrp="";} else {$sq=1;}
$buy_button_action2=$buy_button_action;
@$onsale=substr(@$out[12],0,1);


$ff+=1;

@$brand_name=@$out[13];

//áðåíä íå óêàçàí
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
if (preg_match("/\.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"MP3\" border=0></a>&nbsp;&nbsp;"; }
unset ($awv1, $awv2);
$wh="";
$foto1=str_replace("http://www.", "http://", str_replace("\"","'", $foto1));
if ($foto1!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$foto1),"src=")."src=","", stripslashes(@$foto1))),">")," "));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists("..$fi")){

$imagesz = @getimagesize("..$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/4)." height=".ceil(($imagesz[1])/4)."";
if ($wh==" width=\"\" height=\"\"") {$wh="";}
if ($wh==" width=\"0\" height=\"0\"") {$wh="";}
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];if ($wh==" width=\"\" height=\"\"") {$wh="";}
if ($wh==" width=\"0\" height=\"0\"") {$wh="";}}
}
$foto1=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img". $wh ." ",stripslashes(@$foto1))));


}
if ($hidart==1) {
$foto1=str_replace("<img ", "<img vspace=3 hspace=10 title=\"".str_replace("\"", "", str_replace("\'", "",strtoken($out[3],"*")))."\" ",  stripslashes(@$foto1));
} else {
$foto1=str_replace("<img ", "<img vspace=3 hspace=10 title=\"".str_replace("\"", "", str_replace("\'", "",$out[3]))."\" ",  stripslashes(@$foto1));
}
@$foto1=str_replace("border=0", "border=0 align=left", @$foto1);
$foto1=str_replace("width= height= ", "", $foto1);
$lid=md5(@$out[3]." ID:".@$out[6]);
$kolvos[$lid]=@$out[16];
$ff+=1;

if ((@$$qw1==@$$qqw1) && (@$$qw2==@$$qqw2)) {
$rat=0;

//echo $ff." ".$out[3]." ".$rat." ".$rating[($ff-1)]."<br>\n";

$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
$sortby="";
$voterate="";
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;
$inbasket="";$inb1="";$inb2="";
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
$foto1=str_replace( " src=photos", " src=$htpath/photos",$foto1);
$sps[$s]="<td>". $foto1."</td>";
$files_found += 1;
$s+=1;
}
}





}
//Çàêðûâàåì áàçó
mysql_close($mysqldb);
$cols_of_goods=6;
$make_col=$cols_of_goods; //
$sst=0;
$ddt=0;
reset ($sps);
//echo "on this page=".count($sps)."<br>";
//echo "s=$s total=$total<br>";
if ($start>$total){$start=(floor($total/$perpage))*$perpage; }
while ($sst < $perpage) {
$gt = 0;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}

//$skl1=strtoken($sps[($start+$sst)],"|");

$sstrtoma=Array();
$sstrtoma=explode("|",$sps[$sst]);
$skl1=@$sstrtoma[0];
unset($sstrtoma);

$sklname= str_replace($skl1."|", "", $sps[$sst]);
$sps[$sst]=$skl1;
$sstoks="";
//$val = "<tr bgcolor=$back>". $sps[($start+$sst)];
$val = $sps[$sst]; //ñì âûøå
if (!isset($sstinfo)) { $sstinfo=""; }
$sst += 1;
$ddt += 1;
$spisok .= "$val\n";
if ($sst==$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $spisok.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=5 width=100%><tr>";}
}
$numberpages = (ceil ($total/($perpage+0.000001)));

$startnew=$start+1;

$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;
if ($query!="") {$queryed="&query=".rawurlencode($query);} else {$queryed="";}


$sstat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($start+$perpage) . "&amp;perpage=$perpage&filter=".rawurlencode($filter)."\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=0&amp;perpage=&filter=".rawurlencode($filter)."\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($start-$perpage) . "&amp;perpage=$perpage&filter=".rawurlencode($filter)."\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
if ($start<=0) { $prevpage="<img src=\"$image_path/noprev.gif\" border=0 title=\"".$lang[163]."\">";}
if (($start+$perpage)>$s){ $nextpage="<img src=\"$image_path/nonext.gif\" border=0 title=\"".$lang[163]."\">";}


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
$pp.= "<a href = \"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&filter=".rawurlencode($filter)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&filter=".rawurlencode($filter)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=0&amp;perpage=$perpage&filter=".rawurlencode($filter)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=0&amp;perpage=$perpage&filter=".rawurlencode($filter)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"".$PHP_SELF."?catid=".$podstava["$r|$sub|"]."$queryed&amp;start=" . ($perpage*($numberpages-1)) . "&amp;perpage=$perpage&filter=".rawurlencode($filter)."\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
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
$spisok="<table border=0 width=98% cellpadding=0>
<tr><td valign=top>$brbr$sortecho$ppages<br>$brandimg";

if ($varcart>=100) {$spisok.="<form class=form-inline action=\"".$PHP_SELF."\" method=\"POST\">";

$spisok.="<input type=\"hidden\" name=\"catid\" value=\"$catid\"><input type=\"hidden\" name=\"query\" value=\"$query\">Filter: <input type=\"text\" name=\"filter\" value=\"".@$filter."\"><input type=\"hidden\" name=\"sorting\" value=\"$sorting\"><input type=\"hidden\" name=\"way\" value=\"$way\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"view\" value=\"$view\">";

$spisok.="<input type=\"hidden\" name=\"mnogo\" value=\"2\">
<input type=\"hidden\" name=\"action\" value=\"basket\">";}

$spisok.="<table border=0 cellspacing=5 cellpadding=0 width=100%>
<tr>
$spisok_g
</tr>
</table>";
if ($varcart>=100) {$spisok.="<div align=right><input id=\"totals\" type=\"hidden\" value=\"".$cart->total."\">".$lang[35].": <b><font color=".lighter($nc3,-80)." size=3 id=\"sosk\">".$cart->total."</font></b>".$currencies_sign[$_SESSION["user_currency"]]."<img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"50\" height=\"1\"><input type=submit value=\"".$lang['buy']."\"><img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"60\" height=\"1\"></div></form>";}
$spisok.="</td></tr>
</table>
<center><br>$ppages<br><br><br></center>\n";
$total-=1;
unset($spisok_g);

if ($files_found==0): $spisok =""; $error = "<br><br><font color=$nc2><b>".$lang[94]."</b></font><br><br>"; endif;
if ($s==0):$vitrin_content[0]=""; $spisok="$sortecho<br><br><center><b>".$lang[94]."</b> (<b>$priceot</b>".$currencies_sign[$_SESSION["user_currency"]]." - <b>$pricedo</b>".$currencies_sign[$_SESSION["user_currency"]].")</center><br><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"><br>"; endif;

$spisok=$spisoks.@$spisok;
echo $spisok;
?>
