<?php
$kolvos=Array();
$spprice="price";
$numberpages=0;
if ($valid=="1"){ if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
unset($sps);
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact shveps@dpz.ru to buy license for this host."; exit;}

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


//ищем дубли
$file="$base_file";
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
$zmass=Array();
$xmass=Array();
while(!feof($f)) {
$st=fgets($f);
// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
//$art="".@preg_replace("([\D]+)", "", preg_replace('/\(([0-9]{1,4})\)/', '$1',  str_replace("-","", @$out[3])));
$art=str_replace("-","", @$out[3]);
if ($art!="") {
if (!isset($zmass[$art])) {
$zmass[$art]=$ff."^".$st;
} else {
$zmass[$art].=$ff."^".$st;
$xmass[$art]=$zmass[$art];
}
}
$ff+=1;

}
//Закрываем базу
fclose($f);


$tmpstr=implode("",$xmass);
$razarr=explode("\n",$tmpstr);
unset ($xmass, $zmass, $tmpstr, $out, $ff);

$vit_qty=0;
$ff=0;
while (list ($keyz, $st) = each ($razarr)) {
// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
$rzx=Array();
@$file=@$out[0];
$rzx=explode("^", $file);
$ff=@$rzx[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
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

@$ext_id=@$out[6];
@$description=@$out[7];
$buy_button_action2=$buy_button_action;
$saofound=0;
$saocount=0;

while ($saocount>=0) {
$sao[$saocount] = ExtractString($description, "[option]", "[/option]");
if ($sao[$saocount]=="") {break; } else {
$subao=explode("#", $sao[$saocount]);
$subaocont="";
$subaoname="";
$saoptions="";
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
$saoptions.="opt['".str_replace ("<br>" , "", $subaoname.": ".$subaoval)."']=(0$add_znak".($okr*(round(($tmpaoval[1]*$kurss)/$okr))).");\n";
$fo=1;
$view_callback=0;
}
}
}
$description=str_replace("[option]".$sao[$saocount]."[/option]", "<script language=javascript>
function ao_".$s."_".$saocount."() {
var oll=document.getElementById('aopr_".$s."_".$saocount."').value;
var oldpr=(0+($okr*Math.round(document.getElementById('aopr_".$s."_".$saocount."').value/$okr)));
var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);
idx=document.getElementById('aoid_".$s."_".$saocount."').value;
opt=new Array();
opt['']=0;
$saoptions
var newpr=(Math.round((0+fixed+opt[idx])/$okr)*$okr);
newpr=newpr.toFixed($fix);
document.getElementById('span".$s."').innerHTML=newpr.toString();
document.getElementById('aopr_".$s."_".$saocount."').value=opt[idx];
}
</script><br><b><input type=hidden id=\"aopr_".$s."_".$saocount."\" value=0><span id=\"aotext_".$saocount."\">".str_replace ("<br>" , "", trim($subaoname)).":</span></b><br><select name=\"ao[".$saocount."]\" id=\"aoid_".$s."_".$saocount."\" onchange=\"javascript:ao_".$s."_".$saocount."()\"><option value=\"\"></option></option>$subaocont</select>\n", $description);
}
$saocount+=1;
}

if (preg_match("/[radio]/i", $description)) {


$radio_found=0;
$radio_count=$saocount;
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
$subradio_cont.=str_replace ("<img " , "<img ", str_replace ("<br>" , "", trim($tmpradio_val[2])))."<input type=radio value=$aaad name=ao[". $radio_count."] onclick=\"javascript:var oldpr=(0+($okr*Math.round(document.getElementById('radio_pr_".$s."_".$radio_count."').value/$okr)));var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);var idx=(0$add_znak".($okr*(round(($tmpradio_val[1]*$kurss)/$okr))).");opt=new Array();var newpr=(Math.round((0+fixed+idx)/$okr)*$okr);newpr=newpr.toFixed($fix);document.getElementById('span".$s."').innerHTML=newpr.toString();document.getElementById('radio_pr_".$s."_".$radio_count."').value=idx;\"> ".$tmpradio_val[0]."$aad<br>\n";
$fo=1;
$view_callback=0;
$saocount+=1;
}
}
}
$description=str_replace("[radio]".$radio_[$radio_count]."[/radio]", "<br><b><input type=hidden id=\"radio_pr_".$s."_".$radio_count."\" value=0><span id=\"radio_text_".$radio_count."\">".str_replace ("<br>" , "", trim($subradio_name)).":</span></b><br>$subradio_cont", $description);
}
$radio_count+=1;
}

} else {
$buy_button_action=0;
}
if (preg_match("/\[input/i", $description)==TRUE) {
$description=str_replace("[input1]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input2]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input3]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[inputarea]", "<textarea name=ao[". $radio_count."] value=\"\" cols=42 rows=5 style=\"width:100%\"></textarea>", $description);
$fo=1;
}
if (preg_match("/\[upload/", $description)==TRUE) {
require "./templates/$template/upload.inc";
$description=str_replace("[upload]", $upload, $description);
$fo=1;
}
$admin_functions="";
$vipold="";
//OPT
$didx=@$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$out[$ddidx])*$kurss/$okr)); $price=@$out[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
$sales="";
reset($cartl);
if ($view_custom_cart_inlist==1) {
$ddescription.="<div align=center><table border=0 width=100%>";
while (list ($cac_num, $cac_line) = each ($cartl)) {

if (($cac_line!="")&&($cac_line!="\n")&&(trim(@$out[$cac_num])!="")) {
$ddescription.="<tr><td><b>$cac_line: </b></td><td>". @$out[$cac_num] ." ". $cartl2[$cac_num]."</td></tr>\n";
}
}
$ddescription.="</table></div>";
}
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
//opt
if(substr($details[7],0,3)!="OPT") {
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>"; if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";} @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")){
	@$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueprice]</font></small>";
	$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
	@$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent;
	}
}

//eof opt
}

if (($valid=="1")&&($details[7]=="ADMIN")){ @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueopt]</font></small>"; }
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
	if (($valid=="1")){
	$admin_functions="<br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=".($ff-1)."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')>
	<input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br>";
	}
	}
if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
@$kwords=@$out[8];
@$foto1=@$out[9];
$kolvos[md5(@$out[3]." ID:".@$out[6])]=@$out[16];
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
@$foto2=@$out[10];
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);

//if (($onsale=="0")||($price==0)): continue; endif;
@$brand_name=@$out[13];

//бренд не указан
if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
unset ($awv1, $awv2);
$wh="";
if ($foto1!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"",str_replace($htpath,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$foto1),"src=")."src=","", stripslashes(@$foto1))),">")," ")));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){

$imagesz = @getimagesize(".$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/$kkd1)." height=".ceil(($imagesz[1])/$kkd1)."";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$foto1=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img". $wh ." ",stripslashes(@$foto1))));


}
$foto1=str_replace("<img ", "<img vspace=3 hspace=10 title=\"$nazv\"",  stripslashes(@$foto1));

@$foto1=str_replace("border=0", "border=0 align=left", @$foto1);
@$kolvo=@$out[16];
$ff+=1;
if ((@$$qw1==@$$qqw1) && (@$$qw2==@$$qqw2)) {
$qty=doubleval($qty);
if($qty!=0){ $shtuk=$lang['pcs'];
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>"; if ($view_basketalert==1) { $kupil.="<script language=\"javascript\">window.open('$htpath/minibasket.php?unifid=$unifid&qty=$qty&speek=$speek','buy','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=540,height=180,left=220,top=200')</script>";} } else { $kupil=""; }}
$link="<a href=\"" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";

$sortby="$nazv";
$novina="";
$ddescription="";
$ppp="";
if ($nazv!="") {
$big="";
$novina=""; if ((@$out[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/",@$out[8])==TRUE) { $novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}
if (($valid=="1")&&($details[7]=="VIP")) { $fo=1; }
$inbasket=doubleval($cart->get_item(md5(@$out[3]." ID:".@$out[6])."|"));
if ($inbasket==0) {$inbasket="";$inb1="";$inb2="";} else {$inb1=$inb0; $inb2=" $vitrin";}
$price=str_replace(",",".",$price);
$ppp=str_replace(",",".",$ppp);
if ($vipold!="") {$spprice="newprice";} else {$spprice="price";}
$lid=md5(@$out[3]." ID:".@$out[6]);
$llid="<a href=\"$htpath/index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {$man=translit(@$out[3])."-".translit(@$out[6]);
$llid="<a href=\"$htpath/index.php?item_id=".$man."\">";
}
}
eval ($evstr);
$files_found += 1;
$s+=1;
}
}



}
//Закрываем базу


$make_col=$cols_of_goods; //
$st=0;
$ddt=0;
reset ($sps);


while (list ($keyz, $stm) = each ($sps)) {
$gt = 0;
if (is_long(($ddt/2)) == "TRUE") {
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
if ($st==$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $spisok.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=5 width=100%><tr>";}
}

if (@file_exists("./admin/search/".$podstava["$r|$sub|"].".txt")) {
$cse=fopen("./admin/search/".$podstava["$r|$sub|"].".txt", "r");
$customsearch=fgets($cse, filesize("./admin/search/".$podstava["$r|$sub|"].".txt"));

fclose($cse);  } else { $customsearch="";  }
$poiskinto="";
if ((!isset($poisk_inlist))||($poisk_inlist==0)) {$poiskinto="";}
if ($query!="") {$queryed="&query=".rawurlencode($query);} else {$queryed="";}
$stat= "<center><small><br>".$lang[206]." <b>$total</b> ".$lang[207]."</font></small></center><br>";

$nextpage="";
$prevpage="";

$ppages="";


$pp="";


$pp="";
if ($numberpages<2) {$ppages=""; $pp="";}
if ($way=="up") {$wup="down"; $wim="<img border=0 title=\"".$lang['up']."\" src=\"".$image_path."/sort_up.png\" align=absmiddle align=absmiddle>";} else { $wup="up"; $wim="<img border=0 title=\"".$lang['down']."\" src=\"".$image_path."/sort_down.png\" align=absmiddle align=absmiddle>";}
$spisok = "<table border=0 width=100% cellpadding=0><tr><td>$poiskinto</td><td align=right>$customsearch</td></tr></table>
<table border=0 width=100% cellpadding=0>
<tr><td valign=top>
<table border=0 cellspacing=5 cellpadding=0 width=100%>
<tr>
$spisok
</tr>
</table>
</td></tr>

</table>

<center><br><small>$pp</small>$ppages</center>\n";
$total-=1;

if ($s==0):$vitrin_content[0]=""; $spisok="<br><br><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"><br><center><b>".@$lang[680]."</b></center><br><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"><br>"; endif;
}
}
$s=0;
?>
