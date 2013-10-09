<?php
$filemp="";
$imgs_arr=Array();
$taggs="";
$outc=Array();
$dopwidth=350;
$cvipold="";
$spprice="price";
if (file_exists("./images/".$_SESSION["user_currency"].".png")==TRUE) { $vsygn="<img align=absbottom src=$htpath/$image_path/".$_SESSION["user_currency"].".png>"; } else {$vsygn=$currencies_sign[$_SESSION["user_currency"]]; }
$antispam_array=Array("2x2=4", "3x3=9", "6-4=2", "10+2=12", "20-10=10");
if (file_exists("./templates/$template/$language/antispam.inc")==TRUE) {
$antispam_array=@file("./templates/$template/$language/antispam.inc");
}
$answer_ok=0;


$pricetax="";
$cpricetax="";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
function win_utf8($s){
$s= strtr ($s, array ("а"=>"\xD0\xB0", "А"=>"\xD0\x90","б"=>"\xD0\xB1", "Б"=>"\xD0\x91", "в"=>"\xD0\xB2", "В"=>"\xD0\x92", "г"=>"\xD0\xB3", "Г"=>"\xD0\x93", "д"=>"\xD0\xB4", "Д"=>"\xD0\x94", "е"=>"\xD0\xB5", "Е"=>"\xD0\x95", "ё"=>"\xD1\x91", "Ё"=>"\xD0\x81", "ж"=>"\xD0\xB6", "Ж"=>"\xD0\x96", "з"=>"\xD0\xB7", "З"=>"\xD0\x97", "и"=>"\xD0\xB8", "И"=>"\xD0\x98", "й"=>"\xD0\xB9", "Й"=>"\xD0\x99", "к"=>"\xD0\xBA", "К"=>"\xD0\x9A", "л"=>"\xD0\xBB", "Л"=>"\xD0\x9B", "м"=>"\xD0\xBC", "М"=>"\xD0\x9C", "н"=>"\xD0\xBD", "Н"=>"\xD0\x9D", "о"=>"\xD0\xBE", "О"=>"\xD0\x9E", "п"=>"\xD0\xBF", "П"=>"\xD0\x9F", "р"=>"\xD1\x80", "Р"=>"\xD0\xA0", "с"=>"\xD1\x81", "С"=>"\xD0\xA1", "т"=>"\xD1\x82", "Т"=>"\xD0\xA2", "у"=>"\xD1\x83", "У"=>"\xD0\xA3", "ф"=>"\xD1\x84", "Ф"=>"\xD0\xA4", "х"=>"\xD1\x85", "Х"=>"\xD0\xA5", "ц"=>"\xD1\x86", "Ц"=>"\xD0\xA6", "ч"=>"\xD1\x87", "Ч"=>"\xD0\xA7", "ш"=>"\xD1\x88", "Ш"=>"\xD0\xA8", "щ"=>"\xD1\x89", "Щ"=>"\xD0\xA9", "ъ"=>"\xD1\x8A", "Ъ"=>"\xD0\xAA", "ы"=>"\xD1\x8B", "Ы"=>"\xD0\xAB", "ь"=>"\xD1\x8C", "Ь"=>"\xD0\xAC", "э"=>"\xD1\x8D", "Э"=>"\xD0\xAD", "ю"=>"\xD1\x8E", "Ю"=>"\xD0\xAE", "я"=>"\xD1\x8F", "Я"=>"\xD0\xAF"));
return $s;
}

$nwc10=lighter($nc10,0);
$acscount="";
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
$admin_book="";
$fix=strlen(ExtractString("[zz]".str_replace(",", ".", $okr)."/", ".", "/"));
if ((!@$novinka) || (@$novinka=="")): $novinka=""; endif;
$maxh=96;
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}
if ((!@$fid) || (@$fid=="")): $fid=1; endif;

if ((!@$ctext) || (@$ctext=="")): $ctext=""; endif;
if ((!@$cact) || (@$cact=="")): $cact=""; endif;
if ((!@$del_com) || (@$del_com=="")): $del_com=0; endif;
if (!isset($vote)){$vote="";}
if (!preg_match("/^[0-5]+$/",$vote)) {$vote="";}
$fid-=1;
$cartlist="<table border=0 width=100% cellpadding=3 cellspacing=3><tr><td valign=top width=100%>";
$cart_title="";
$cartlist_total=0;

$add_query="";
$file=$dbpref."_items_".$speek;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());

$sc=0;
if ($view_deleted_goods==0) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {
$add_query.=" AND `on_offer`='1'";
}
}
//echo $mysql_query;
//echo $item_id;
if ($item_id=="") {
$mysql_query="SELECT * FROM $file WHERE (`unifid`='".mysql_real_escape_string(@$unifid)."' $add_query) LIMIT 1";
} else {
$mysql_query="SELECT * FROM $file WHERE (`item_id`='".mysql_real_escape_string(@$item_id)."' $add_query) LIMIT 1";
}
//echo $mysql_query;
$result=mysql_query("$mysql_query");
$datepr="";
while($row = @mysql_fetch_row($result)) {
$st="";
$datepr=$row[3];
while(list($k,$v)=each($row)) {

//echo $k."=>".$v."<br>";
if ($k>9) {
$st.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}
$sc+=1;
reset($langs);
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$st=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $st));
}else{
$st=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $st));
}
}

$outc=explode("|",$st);
if (count($outc)<=9): continue;  endif;
@$file=@$outc[0];

@$dir=@$outc[1];
@$subdir=@$outc[2];
$r=@$dir;
$needcol=@$colordirs["$r"];
if ($needcol!="") {$nwc10=lighter($needcol,0);}
@$nazv=@$outc[3];
@$price=@$outc[4];

$catidcart=$podstava["$dir|$subdir|"];
@$opt=@$outc[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
@$curcur=substr(@$outc[12],1,3);

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
@$opt=round(@$opt*$optkurs);
if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$outc[6].$artrnd), -7));
} else {
@$ext_id=@$outc[6];
}
@$description=@$outc[7];

@$ext_lnk=@$outc[14];

@$full_descr=@$outc[15];
$gdf="./gooddesc/".$outc[6].".txt";
if (file_exists($gdf)==TRUE) {
 if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $full_descr.="<div class=round align=right><b>HTML ". $mpz['file'].":</b> ".$gdf." <input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$gdf."','gdf','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')></div>";}}
$fgd=@fopen($gdf,"r");
$full_descr.=str_replace("<br><br>", "<br>",str_replace("<br><br>", "<br>",str_replace("\n", "<br>",str_replace("\r", "", @fread($fgd, @filesize($gdf))))));
fclose($fgd);
}
if (trim($full_descr)=="") {$dopwidth=1;}else {$full_descr="<br>".$full_descr;}
if ($auto_mark_wiki==1){
$full_descr=wikify($full_descr,"");
$description=wikify($description,"");
}
//additonal item options
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
$aad=" $add_znak".$aapr."$add_valut";}
$subaocont.="<option value=\"".str_replace ("<br>" , "", $subaoname.": ".$subaoval)."\">".$tmpaoval[0]."$aad</option>\n";
$aoptions.="opt['".str_replace ("<br>" , "", $subaoname.": ".$subaoval)."']=(0$add_znak".($okr*(round(($tmpaoval[1]*$kurss)/$okr))).");\n";
$view_callback=0;
}
}
}

$description=str_replace("[option]".$ao[$aocount]."[/option]", "<script language=javascript>
function ao_".$aocount."() {
var oldpr=(0+($okr*Math.round(document.getElementById('aopr_".$aocount."').value/$okr)));
var fixed=(Math.round((parseFloat(document.getElementById('span0').innerHTML)-oldpr)/$okr)*$okr);
idx=document.getElementById('id_".$aocount."').value;
opt=new Array();
opt['']=0;
$aoptions
var newpr=(Math.round((0+fixed+opt[idx])/$okr)*$okr);
newpr=newpr.toFixed($fix);
document.getElementById('span0').innerHTML=newpr.toString();
document.getElementById('aopr_".$aocount."').value=opt[idx];
}
</script><br><b><input type=hidden id=\"aopr_".$aocount."\" value=0><span id=\"aotext_".$aocount."\">".str_replace ("<br>" , "", trim($subaoname)).":</span></b><br><select name=\"ao[".$aocount."]\" id=\"id_".$aocount."\" onchange=\"javascript:ao_".$aocount."()\"><option value=\"\"></option></option>$subaocont</select>\n", $description);
}
$aocount+=1;
}

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
$subradio_cont.=str_replace ("<br>" , "", trim($tmpradio_val[2]))."<input type=radio value=$aaad name=ao[". $radio_count."] onclick=\"javascript:var oldpr=(0+($okr*Math.round(document.getElementById('radio_pr_".$radio_count."').value/$okr)));var fixed=(Math.round((parseFloat(document.getElementById('span0').innerHTML)-oldpr)/$okr)*$okr);var idx=(0$add_znak".($okr*(round(($tmpradio_val[1]*$kurss)/$okr))).");opt=new Array();var newpr=(Math.round((0+fixed+idx)/$okr)*$okr);newpr=newpr.toFixed($fix);document.getElementById('span0').innerHTML=newpr.toString();document.getElementById('radio_pr_".$radio_count."').value=idx;\" id=\"lb_".$s."_".$radio_count."_".$xxx."\"><label for=\"lb_".$s."_".$radio_count."_".$xxx."\">".$tmpradio_val[0]."$aad</label>\n";
$fo=1;
$xxx++;
$view_callback=0;
$aocount+=1;
}
}
}
$description=str_replace("[radio]".$radio_[$radio_count]."[/radio]", "<br><b><input type=hidden id=\"radio_pr_".$radio_count."\" value=0><span id=\"radio_text_".$radio_count."\">".str_replace ("<br>" , "", trim($subradio_name)).":</span></b><br>$subradio_cont", $description);
}
$radio_count+=1;
}



$description=str_replace("[input1]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input2]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input3]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[inputarea]", "<textarea name=ao[". $radio_count."] value=\"\" cols=42 rows=5 style=\"width:100%\"></textarea>", $description);
if (preg_match("/\[upload/", $description)==TRUE) {
require "./templates/$template/upload.inc";
$description=str_replace("[upload]", $upload, $description);
}
@$kolvo=@$outc[16];
$admin_functions="";
$swordma=Array();
$swordma=explode("*",@$outc[8]);
$sword=@$swordma[0];
unset($swordma);
$acs=str_replace("*","",str_replace($sword, "", @$outc[8]));

$accs=Array();
if($acs!="") {
$accs=explode(",", $acs);
}

$vipold="";
$ccat=@$podstava["$dir|$subdir|"];
$unif=md5(@$outc[3]." ID:".@$outc[6]);
$novina=""; if ((@$outc[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/",@$outc[8])==TRUE) { $novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$sklad="";
$stock="";
} else {
if ($stinfo=="ext") {
$fnamef="./admin/sklad/found/$unif.txt";
if (@file_exists($fnamef)) {
$filef = @fopen($fnamef, "r");
if (!$filef) {
$sklad="";
} else {
if ($stinfo=="ext") {
$sklad="<br><br><b>".$lang[173]."</b><br>".@fread($filef, @filesize($fnamef))."<br><br>";
}
}
fclose ($filef);
}
$fnamef="./admin/sklad/stock/$unif.txt";
if (@$outc[4]==0): $fnamef="NO"; endif;
if (@$outc[4]==""): $fnamef="NO"; endif;
if (substr(@$outc[12],0,1)=="0"): $fnamef="NO"; endif;
if (@$outc[12]==""): $fnamef="NO"; endif;
$stock="";
if (@file_exists($fnamef)) {
$filef = @fopen ($fnamef, "r");
if ($filef) { $stock="<br><small><b>".$lang[174]."</b><br><br>".fread ($filef, filesize ($fnamef))."</small>";}
fclose ($filef);
}else {
$stock= "<small><br><b>".$lang[174]."</b><br><br><img src=$image_path/stockno.gif><br>".$lang[175]."</small>";
}
}

if ($stinfo=="int") {
if ($kolvo==1) {$stoks= "<small><img src=$image_path/stock1.gif> ".$lang[622]."</small>";}
if ($kolvo>$stock4) {$stoks= "<small><img src=$image_path/stock1.gif> ".$lang[623]."</small>";}
if ($kolvo>=$stock3) {$stoks= "<small><img src=$image_path/stock3.gif> ".$lang[624]."</small>";}
if ($kolvo>=$stock2) {$stoks= "<small><img src=$image_path/stock3.gif> ".$lang[624]."</small>";}
if ($kolvo>=$stock1) {$stoks= "<small><img src=$image_path/stock5.gif> ".$lang[625]."</small>";}
if ($kolvo>=$stock0) {$stoks= "<small><img src=$image_path/stock5.gif><img src=$image_path/stock5.gif> ".$lang[626]."</small>";}

if ($kolvo<=$stock5) {$stoks= "<small><img src=$image_path/stockno.gif><br>".$lang[621]."</small>";}

$stock= "<small><br><br><b>".$lang[174]."</b><br>".$stoks."<br></small><br>";
}

}
$skl="";
$sales="";@$onsale=substr(@$outc[12],0,1);

if ($view_comments==1) {
if (@file_exists("./admin/comments/votes/$unif.txt")==TRUE) {
$tmpvotef=file("./admin/comments/votes/$unif.txt");
$vcount=doubleval(trim($tmpvotef[1]));
$vlevel=round(doubleval(trim($tmpvotef[0])));
if ($vlevel>0) {
$voting="<br><img src=$image_path/vote".$vlevel.".png border=0>";
}
unset($tmpvotef);
}

}
$strto=0;
//OPT
$didx=@$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$outc[$ddidx])*$kurss/$okr)); $price=@$outc[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
if ($zero_price_incart==0) {
//not sale items with zero price
if (($price==0)||($price=="")||(doubleval($onsale)==0)){$prem1="<!-- "; $prem2=" -->"; $prbuy="<small><b>".$lang['prebuy']."</b></small>";} else {$prem1="";$prem2="";$prbuy=""; }
} else {
//sale items with zero price
if (doubleval($onsale)==0){$prem1="<!-- "; $prem2=" -->"; $prbuy="<small><b>".$lang['prebuy']."</b></small>";} else {$prem1="";$prem2="";$prbuy=""; }
if (($price==0)||($price=="")) { $prbuy="<small><b>".$lang['prebuy']."</b></small>";}
}

//opt
if(substr($details[7],0,3)!="OPT") {
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$outc[8])==TRUE)) {

$strtoma=Array();
$strtoma=explode("%",@$outc[8]);
$strto=@$strtoma[0];
unset($strtoma);
 $vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>"; if ((preg_match("/\%/", @$outc[8])==TRUE)&&(doubleval($strto)>0)) {$sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE
<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";
@$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {

if (($valid=="1")&&($details[7]=="VIP")): $vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span> / <b>".$lang[176]."</b> "; @$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent; endif;
}

if (doubleval($strto)==0) {$sales=""; $vipold="";}
if(($details[7]=="ADMIN")){if (($valid=="1")): @$description=@$description . "<br><small>[".$lang[148].": <b>".@$opt."</b> / ".@$outc[5]."]</small>";  endif; }
$goodofday="";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $skl="<br><b>$ext_id</b> -&gt; $nazv [".$outc[6]."]<br>".$sklad;

$admin_functions = "<br><div align=center><small><button type=\"button\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['ch']."\"><font color=#468847>V</font>&nbsp;<small>".$lang['ch']."</small></button> <button type=\"button\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang[137]."\"><font color=#f89406>Cc</font>&nbsp;<small>".$lang[137]."</small></button> <button type=\"button\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang['del']."\"><font color=$nc3>X</font>&nbsp;<small>".$lang['del']."</small></button><br>".$lang[983]."</small></div>";


$admin_functions.="<div align=center><br><button type=button onClick=javascript:window.open('$htpath/admin/".$scriptprefix."good_of_day.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10') title=\"".$lang[735]."\"><font color=#3a87ad>D</font>&nbsp;<small>".$lang[735]."</small></button></div><br><br>";
}}

}
@$kwords=@$outc[8];
if (($price==0)||(doubleval($onsale)!=1)) {$description=strtoken($description,"<input");}
if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
$price=($okr*round($price/$okr));
@$foto1=@$outc[9];
$imgs_arr=explode("src=", $foto1);
$imgs=str_replace("\"", "", str_replace("'", "", str_replace(">", "", str_replace("<", "",strtoken(strtoken(@$imgs_arr[1],">")," ")))));
$metadesc=htmlspecialchars(substr(strip_tags(str_replace("  "," ",str_replace("  "," ",strtoken(str_replace("<br>"," ",@$outc[7]),"[")))),0,255));
if ($imgs!="") {
if (preg_match("/http:\/\//i",$imgs)==FALSE) {
$imgs="$htpath/$imgs";  $foto1="<img src='".$imgs."' border=0>"; } $fbmeta="<meta property=\"og:title\" content=\"".htmlspecialchars(strip_tags("$shop_name | $dir | $subdir | $nazv - $price".$currencies_sign[$_SESSION["user_currency"]]))."\" />
<meta property=\"og:type\" content=\"product\" />
<meta property=\"og:url\" content=\"$htpath/index.php?unifid=$unifid\" />
<meta property=\"og:image\" content=\"".str_replace("'","",str_replace("\"","",$imgs))."\" />
<meta property=\"og:description\" content=\"".$metadesc."\" />
<meta property=\"fb:admins\" content=\"$fb_admin_id\" />
<meta name=\"description\" content=\"$metadesc\"/>
";
} else {
$fbmeta="<meta property=\"og:title\" content=\"".htmlspecialchars(strip_tags("$shop_name | $dir | $subdir | $nazv - $price".$currencies_sign[$_SESSION["user_currency"]]))."\" />
<meta property=\"og:type\" content=\"product\" />
<meta property=\"og:url\" content=\"$htpath/index.php?page=?unifid=$unifid\" />
<meta property=\"og:image\" content=\"$htpath/logo.png\" />
<meta property=\"og:description\" content=\"".$metadesc."\" />
<meta property=\"fb:admins\" content=\"$fb_admin_id\" />
<meta name=\"description\" content=\"$metadesc\"/>
";
}

@$foto2=@$outc[10];
if ((!isset($use_bigfoto))||($use_bigfoto==0)){$dff=""; } else { $dff=@$foto1; @$foto2=$foto2.@$foto1;}
$fotos=stripslashes($fotos);
$foto2=str_replace("http://www.", "http://", str_replace("\"","'", $foto2));
$fotos=str_replace("http://www.", "http://", $fotos);
$foto1=str_replace("http://www.", "http://", str_replace("\"","'", $foto1));
$htpat=str_replace("http://www.", "http://", $htpath);
if (preg_match("/".str_replace("/","\\/", "$htpat")."/i", $foto2)==FALSE) {if (preg_match("/http:\/\//i", $foto2)==FALSE) {$foto2=str_replace("src='","src='$htpat/",$foto2);}}
if ($foto1=="") {$foto1="<img src=\"".$image_path."/no_photo.gif\" border=0>";}

//$foto1=str_replace("$htpath", @$bad,  stripslashes(@$foto1));


//$foto2=str_replace("$htpath", @$bad,  stripslashes(@$foto2));

@$vitrin=@$outc[11];
$sqr="/$vitrin";
if (($vitrin=="")||("$vitrin"=="0")||($vitrin==$lang['pcs'])) {$vitrin=$lang['pcs']; $sqr="";}
if (doubleval(@$outc[$minorderrow])>=1) {$minorder=doubleval(@$outc[$minorderrow]); $minorder2=(doubleval(@$outc[$minorderrow])*2); $minorderblock=" readonly=readonly"; $minsht="<br><font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1005]))."</font>"; $minupak="<br><font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1006]))."</font>";} else {$minorder=1; $minorder2=2; $minorderblock=""; $minsht=""; $minupak="";}

@$brand_name=@$outc[13];


$linkfile="";
$tax="";
$tax=@$outc[$taxcolumn];
if ($tax=="") {$tax=$deftax;}
if ($tax_function==1) {$pricetax="<small><nobr><font color=$nc2>".$lang[781].": ".($okr*round($price/(1+($tax/100))/$okr))." ".@$currencies_sign[$_SESSION["user_currency"]]."</font></nobr><br><br><nobr>".$lang[782]." $tax%:<br></nobr></small>"; }


//statistic added 11.09.2005 by EuroWebcart
$fname=md5($nazv." ID:".@$outc[6]);
$flood="";
//comments data validate
if (array_key_exists("comments_text".md5(date("d.m.Y")), $_POST)) { $comments_text=$_POST["comments_text".md5(date("d.m.Y"))]; } else {$comments_text="";}
if (array_key_exists("antispam_a".md5(date("d.m.Y")), $_POST)) { $antispam_a=$_POST["antispam_a".md5(date("d.m.Y"))]; } else {$antispam_a="";}
if (!isset($antispam_a)){$antispam_a="";} $antispam_a=toLower(trim(stripslashes($antispam_a))); if (!preg_match("/^[а-яА-ЯёЁa-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$antispam_a)) { $antispam_a="";}
if (array_key_exists("antispam_row".md5(date("d.m.Y")), $_POST)) { $antispam_row=$_POST["antispam_row".md5(date("d.m.Y"))]; } else {$antispam_row="";}
if (!isset($antispam_row)){$antispam_row="";} $antispam_row=trim(stripslashes($antispam_row)); if (!preg_match("/^[a-z0-9_]+$/",$antispam_row)) { $antispam_row="";}


reset ($antispam_array);
while (list ($as_key, $as_st) = each ($antispam_array)) {
$antispam_que=strtoken($as_st,"=");
$antispam_ans=trim(str_replace("$antispam_que=", "", $as_st));
$antispam_index=md5(date("d.m.Y").$as_key);
if ($antispam_index==$antispam_row) {
if ($antispam_a==$antispam_ans) {
$answer_ok=1;
}
}
}
if ((!@$comments_name) || (@$comments_name=="")){ $comments_name=""; } else { $comments_name=substr($comments_name, 0, 50); $comments_name = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $comments_name); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $comments_name); $comments_name = str_replace("|", "", $comments_name);  $comments_name = str_replace(chr(27), "", $comments_name); $comments_name = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$comments_name))); $comments_name=badwords($comments_name);}
if ((!@$comments_text) || (@$comments_text=="")){ $comments_text=""; } else { $comments_text=substr($comments_text, 0, 1000);$comments_text = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $comments_text); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $comments_text); $comments_text = str_replace(chr(10), " ", $comments_text);   $comments_text = str_replace(chr(27), "", $comments_text); $comments_text = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$comments_text))); $comments_text=badwords($comments_text);}
//shield for flood
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {$comments_name="ADMIN";}}
if ($comments_name=="") {
$comments_name=$lang[193];
}
if ($comments_text=="") {
$flood="";
} else {
if ($answer_ok==1) {
if ($_SESSION["user_banned"]==0) {
if (@$_SESSION["last_comm"]==($fid+1)."|" . $comments_text) {
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font color=#b94a48><b>".$lang[177]."</b></font>"));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$flood="$erview";
} else {
if((preg_match("/http:\/\//i",$comments_text))||(preg_match("/http:\/\//i",$comments_name))){
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font color=#b94a48><b>".$lang[178]."</b></font>"));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$flood="$erview";
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {$flood="";}}
if ($flood=="") {

//Add votes
if ($vote!="") {
if (@file_exists("./admin/comments/votes/$fname.txt")==FALSE) {
//vote not exists
$votecount=1;
$votelevel=$vote;
} else {
$tmpvotef=file("./admin/comments/votes/$fname.txt");
$votecount=doubleval(trim($tmpvotef[1]))+1;
$votelevel=round((((doubleval(trim($tmpvotef[1]))*doubleval(trim($tmpvotef[0])))+$vote)/$votecount),5);
}
$df = fopen ("./admin/comments/votes/$fname.txt" , "w"); flock ($df, LOCK_EX);
fputs($df, "$votelevel\n$votecount\n"); flock ($df, LOCK_UN);
fclose($df);
}


$_SESSION["last_comm"]=($fid+1)."|" . $comments_text;
if(get_magic_quotes_gpc()) {$comments_text = stripslashes($comments_text); $comments_name = stripslashes($comments_name);}
$df = fopen ("./admin/comments/$fname.txt" , "a"); flock ($df, LOCK_EX);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){$comments_ip=""; $colred1="[adm]"; $colred2="[/adm]";} else {$colred1=""; $colred2=""; $comments_ip=" [ip]".@$_SERVER['REMOTE_ADDR']."[/ip]";}}else {$colred1=""; $colred2=""; $comments_ip=" [ip]".@$_SERVER['REMOTE_ADDR']."[/ip]";}
fputs($df, trim("\n\n[hr][vote]".$vote."[/vote] $colred1".gmdate("d.m.Y / H:i",(time()))." [b]".htmlspecialchars($comments_name).":[/b]$comments_ip [i] \n\n\n".htmlspecialchars(str_replace("&","[amp]", $comments_text)) ."$colred2"."\n\n\n [/i]\n")); flock ($df, LOCK_UN);
fclose($df);
}
}

}else {
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font color=#b94a48><b>".$lang[179]."</b></font>"));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$flood="$erview";
}

$tmpvotef=file("./admin/comments/votes/$fname.txt");
$vcount=doubleval(trim($tmpvotef[1]));
$vlevel=round(doubleval(trim($tmpvotef[0])));
$voting="<br><img src=\"$image_path/vote".$vlevel.".png\" title=\"".$lang[681]."\" border=0> <b>$vlevel/5</b> [<a title=\"".$lang[682]."\" href=\"#comm\" onclick=\"javascript:commv();\">$vcount</a>]<br>";

} else {
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font color=#b94a48><b>".$lang[825]."</b></font>"));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$flood="";
}
}
//end shield
unset ($df);

if ((!@$_SESSION["fids[". ($fid+1). "]"]) || (@$_SESSION["fids[". ($fid+1). "]"])=="") {


if (@file_exists("./admin/stat/$fname.txt")==TRUE) {
//file exist
$ef = fopen ("./admin/stat/$fname.txt" , "r");
$tmpviews = explode ("|", fread($ef, filesize("./admin/stat/$fname.txt")));
fclose($ef);
settype ($tmpviews[0], "double");
$ef = @fopen ("./admin/stat/$fname.txt" , "w"); @flock ($ef, LOCK_EX);
$tmpviews[0]+=1;
if(get_magic_quotes_gpc()) {$nazv = stripslashes($nazv);}
@fputs($ef, $tmpviews[0]. "|". $nazv ."|" . $price); @flock ($ef, LOCK_UN);
@fclose($ef);
$views=$tmpviews[0]-1;

} else {
//file not exist
if(get_magic_quotes_gpc()) {$nazv = stripslashes($nazv);}
$ef = fopen ("./admin/stat/$fname.txt" , "w");
fputs($ef, "1|". $nazv ."|" . $price);
fclose($ef);
$views=1;
}
$counlen=strlen(@$_SESSION["interest"]);
if ($counlen<5000) {
if ($hidart==1) {$hidnazv=strtoken($nazv,"*")." $brand_name ".strtoupper(substr(md5(@$outc[6].$artrnd),-7)); } else {$hidnazv=$nazv;}
$addinter="<li><small><a href=\"index.php?unifid=" . md5("$nazv"." ID:".@$outc[6]) . "&flag=$speek\"><font color=\"$nc2\">$hidnazv</font></a>";
if ($view_goodsprice==1){
if ($zero_price_incart==0) {
$addinter.="$prem1 - <b>$price</b>".$currencies_sign[$_SESSION["user_currency"]]."$sqr $prem2";
}
}
$addinter.="</small></li>";
@$_SESSION["interest"]=$addinter.$_SESSION["interest"];
}
//session_register("fids[". ($fid+1). "]");
$_SESSION["fids[". ($fid+1). "]"]=$fid+1;
} else {
if (@file_exists("./admin/stat/$fname.txt")==TRUE) {
//file exist
$ef = fopen ("./admin/stat/$fname.txt" , "r");
$tmpviews = explode ("|", fread($ef, filesize("./admin/stat/$fname.txt")));
fclose($ef);
settype ($tmpviews[0], "double");
$views=$tmpviews[0];

} else {
//file not exist
$views=0;
}
}

unset ($ef);
//comments

if ($view_comments==1) {
$comm_book="<br><font color=$nc4>".$lang[180]."</font>";

if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) if (($valid=="1")&&($del_com!=0)){
if (@file_exists("./admin/comments/$fname.txt")==TRUE) {
unlink("./admin/comments/$fname.txt");
unlink("./admin/comments/votes/$fname.txt");
$comm_book="<br><b>".$lang[181]."</b>";
$vcount=0;
$vlevel=0;
$voting="";




}
}}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ if (($valid=="1")&&($ctext=="")&&($cact=="1")){
if (@file_exists("./admin/comments/$fname.txt")==TRUE) {
unlink("./admin/comments/$fname.txt");
unlink("./admin/comments/votes/$fname.txt");
$comm_book="<br><b>".$lang[181]."</b>";
}
}}
$oki=0;
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")&&($ctext!="")&&($cact=="1")){
if (@file_exists("./admin/comments/$fname.txt")==TRUE) {
if(get_magic_quotes_gpc()) {$ctext = stripslashes($ctext);}
$df2 = fopen ("./admin/comments/$fname.txt" , "w"); flock ($df2, LOCK_EX);
fputs($df2, str_replace(chr(10), "[br]", $ctext));
flock ($df2, LOCK_UN);
fclose($df2);
$oki=1;
$comm_book="<br><b>".$lang[182]."</b>";
}
}}

if (@file_exists("./admin/comments/$fname.txt")==TRUE) {
$ef=fopen("./admin/comments/$fname.txt" , "r");
$commread=fread($ef, filesize("./admin/comments/$fname.txt"));
fclose($ef);
$comm_book=str_replace("[adm]","<font color=$nc2>",str_replace("[/adm]","</font>", str_replace("[vote]","<img src=\"$image_path/vote",str_replace("[/vote]",".png\">",str_replace("[hr]", "<div class=clear><br></div>", str_replace("[i]", "<i class=muted>", str_replace("[/i]", "</i>", str_replace("[b]", "<b>", str_replace ("[/b]", "</b>", str_replace ("[br]", "<br>", str_replace("[amp]", "&", $commread)))))))))));
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){$comm_book= str_replace("[ip]", "<a href=\"$htpath/index.php?action=userip&ban=ip_", str_replace("[/ip]", "&start=0&perpage=10&ipsort=\">".$lang[186]."</a>", $comm_book));} else {$comm_book=str_replace("[ip]", "<!-- ", str_replace("[/ip]", " -->", $comm_book));} } else {$comm_book=str_replace("[ip]", "<!-- ", str_replace("[/ip]", " -->", $comm_book));}

//Simple Comments editor    added 16.11.2005
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {
$admin_book="<form class=form-inline action=\"$htpath/index.php\" method=\"post\">
<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"><br><p align=\"center\"><b>".$lang[183]."</b> <small>(".$lang[184].")</small><br><input type=\"hidden\" name=\"unifid\" value=\"". $unifid ."\"><input type=\"hidden\" name=\"item_id\" value=\"". $item_id."\"><input type=\"hidden\" name=\"cact\" value=\"1\"><br>
<textarea rows=\"22\" style=\"width:100%\" name=\"ctext\" cols=\"44\">".str_replace("[br]", "\n", $commread)."</textarea><p align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\"></p></form><form class=form-inline action=\"$htpath/index.php\" method=\"POST\"><p align=\"center\"><input type=\"hidden\" name=\"unifid\" value=\"". $unifid ."\"><input type=\"hidden\" name=\"item_id\" value=\"". $item_id."\"><input type=\"hidden\" name=\"del_com\" value=\"1\"><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[185]."\"></p></form>";
}}
//end comments editor
}
}

//end comments


//end statistic


//If you wish include link to file
$mpdir="mp3/";
$existance=0;
$hear="";
$f_con="";
$findmpz="";
$findtxtz="";

$finddocz="";
if (@$ext_lnk!="") {

if (preg_match("/.\//i",str_replace("%20"," ", $ext_lnk))) {

if (is_dir (str_replace("%20"," ", $ext_lnk))==TRUE) {
// lets handle directory
$existance=1;

$mpdir=str_replace("%20"," ", $ext_lnk);
$handled=opendir($mpdir);

if (substr($filemp,-1)!="/") {$mpdir.="/";}
$ext_lnk="";
$ggg=0;
while (($filemp = readdir($handled))!==FALSE) {


if (strtolower(substr($filemp,-4))==".mp3") {

$ext_ln[$ggg]=str_replace(" ", "%20", $filemp);
$findmpz.=str_replace("%20", " ", $filemp)." \n";
$ggg+=1;
}
if ((strtolower(substr($filemp,-4))==".txt") || (strtolower(substr($filemp,-5))==".html")|| (strtolower(substr($filemp,-4))==".htm")){
$filetx = @fopen($mpdir.$filemp, "r");
if ($filetx) {
$findtxtz.="<br><br><!-- $filemp -->".@fread($filetx, @filesize($mpdir.$filemp))."\n";
}
fclose ($filetx);

}
$mkpdir=$mpdir;
if (substr($mpdir,0,2)=="./") {$mkpdir=substr($mpdir,2,1000);}
//if ((strtolower(substr($filemp,-4))==".jpg")||(strtolower(substr($filemp,-4))==".gif")||(strtolower(substr($filemp,-4))==".png")) {
//$foto2="<img src='"."$htpath/$mkpdir".str_replace("%20", " ", $filemp)."' border=0><br>$foto2\n";
//}

if ((strtolower(substr($filemp,-4))==".xls")||(strtolower(substr($filemp,-4))==".doc")||(strtolower(substr($filemp,-4))==".pdf")) {

$fsizep=filesize("./$mpdir".str_replace("%20"," ", $filemp));
if ($fsizep<=1024) {$fsizem="<b>". floor(filesize("./$mpdir".str_replace("%20"," ", $filemp))/1). "</b> bytes";}
if ($fsizep>1024) {$fsizem="<b>". floor(filesize("./$mpdir".str_replace("%20"," ", $filemp))/1024). "</b> Kb";}
if ($fsizep>1024000) {$fsizem="<b>".(0.01*floor((filesize("./$mpdir".str_replace("%20"," ", $filemp))*100)/1024000)). "</b> Mb";}
if ($fsizep>1024000000) {$fsizem="<b>". (0.01*floor((filesize("./$mpdir".str_replace("%20"," ", $stex))*100)/1024000000)). "</b> Tb";}

$finddocz.="<br><br><!-- $filemp --><b>". strtoupper(substr($filemp,-3)). ":</b> <a href=\"$htpath/$mkpdir".str_replace("%20", " ", $filemp)."\"><img src=\"$image_path/".strtolower(substr($filemp,-3)).".gif\" border=0> $filemp</a> $fsizem\n";
}




}

sort($ext_ln);
$ext_lnk=@implode(" ",$ext_ln);

}
}

if (preg_match("/mp3/i",$ext_lnk)) {
$mp3_mass[0]="";
$mp3_found=0;

require("./modules/class.id3.php");

$hear ="<br><br>
<SCRIPT LANGUAGE='JavaScript'>
<!--

function play (arg) {
window.document.mp3play.SetVariable(\"_root.file\", arg);
window.document.mp3play.GotoFrame(3);
}
function play_juke (arg) {
window.document.mp3play.SetVariable(\"_root.file\", arg);
window.document.mp3play.SetVariable(\"_root.played\", \"Play all files on this page\");
window.document.mp3play.GotoFrame(3);
}
function stop () {
window.document.mp3play.GotoFrame(5);
}
-->
</SCRIPT>

<OBJECT
        CLASSID=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
        WIDTH=\"270\"
        HEIGHT=\"27\"
        CODEBASE=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab\"
        ID=\"mp3play\">
        <PARAM NAME=\"MOVIE\" VALUE=\"mp3play_jukebox2.swf\">
        <PARAM NAME=\"PLAY\" VALUE=\"false\">
        <PARAM NAME=\"LOOP\" VALUE=\"false\">
        <PARAM NAME=bgcolor VALUE=#FFFFFF>
        <PARAM NAME=\"QUALITY\" VALUE=\"high\">
        <PARAM NAME=\"SCALE\" VALUE=\"SHOWALL\">


        <EMBED
                NAME=\"mp3play\"
                bgcolor=#FFFFFF
                SRC=\"mp3play_jukebox2.swf\"
                WIDTH=\"270\"
                HEIGHT=\"27\"
                PLAY=\"false\"
                LOOP=\"false\"
                QUALITY=\"high\"
                SCALE=\"SHOWALL\"
                swLiveConnect=\"true\"
                ID=\"mp3play\"
                PLUGINSPAGE=\"http://www.macromedia.com/go/flashplayer/\">
        </EMBED>
</OBJECT><br>";
}

$tmpex=explode(" ", $ext_lnk);



while (list ($keyex, $stex) = each ($tmpex)) {
if (@$stex!="") {

if (preg_match("/\.mp3/i",$stex)) { if (@file_exists("./$mpdir".str_replace("%20"," ", $stex))==TRUE) { $mp3_mass[$mp3_found]="$htpath/$mpdir$stex,"; $mp3_found+=1;

$mp3file="./$mpdir".str_replace("%20"," ", $stex);
$readfile="$stex";
$id3 = new id3($mp3file);
if (($id3->lengths) !== -1) {
$time=", <b>" . $mpz['time'] . ":</b>&nbsp;" . floor((($id3->lengths)/60)) . "&nbsp;" . $mpz['min'] . "&nbsp;" . floor(60*(round((($id3->lengths)/60) , 2)- (floor((($id3->lengths)/60))))) . "&nbsp;" . $mpz['sec'] . "";
} else {
$time = "";
}
if (($id3->bitrate) !== "") {
$bits=", <b>" . $mpz['bitrate'] . ":</b>&nbsp;" . $id3->bitrate . "&nbsp;Кb/s";
} else {
$bits="";
}
if ((($id3->album) !== "") && (($id3->album) !== "                              ")) {
$album=", <b>" . $mpz['album'] . ":</b>&nbsp;" . $id3->album;
} else {
$album="";
}
if (($id3->genre) !== "") {
$genre=", <b>" . $mpz['genre'] . ":</b>&nbsp;" . $id3->genre;
} else {
$genre="";
}
if (($id3->artists) !== "") {
$artists="<b>" . $mpz['artist'] . ":</b>&nbsp;" . $id3->artists;
} else {
$artists="<b>" . $mpz['track'] . ":</b>&nbsp;" . str_replace(".mp3" , "", $readfile);
}
if ((($id3->name) !== "") && (($id3->name) !== "                              ")) {
$mpname=", <b>" . $mpz['track'] . ":</b>&nbsp;" . $id3->name;
} else {
$mpname="";
}


$fsizep=filesize("./$mpdir".str_replace("%20"," ", $stex));
if ($fsizep<=1024) {$fsizem="<b>". floor(filesize("./$mpdir".str_replace("%20"," ", $stex))/1). "</b> bytes";}
if ($fsizep>1024) {$fsizem="<b>". floor(filesize("./$mpdir".str_replace("%20"," ", $stex))/1024). "</b> Kb";}
if ($fsizep>1024000) {$fsizem="<b>".(0.01*floor((filesize("./$mpdir".str_replace("%20"," ", $stex))*100)/1024000)). "</b> Mb";}
if ($fsizep>1024000000) {$fsizem="<b>". (0.01*floor((filesize("./$mpdir".str_replace("%20"," ", $stex))*100)/1024000000)). "</b> Tb";}


$hear.="<br><div id=\"div".($keyex+1)."\">".($keyex+1).". <a href=\"$htpath/$mpdir$stex\"><img src=\"$image_path/mp.gif\" border=0> <b>".str_replace("%20", " ", $stex)."</b></a> [".$fsizem."] <b><a href=\"javascript:play('$htpath/$mpdir$stex')\">Play</a></b>&nbsp;|&nbsp;<b><a href=\"javascript:stop()\">Stop</a></b><br><small><i>\n" . $artists . " \n" . $mpname . " \n"  . $bits . " \n" . $time . " \n" . $album . " \n" . " " . $id3->year . " \n" . $genre . "</i></small></div>\n";} else { if (($existance==0)&&(strtolower(substr($stex,-4))==".mp3")) { $mp3_mass[$mp3_found]="$htpath/$mpdir$stex,"; $mp3_found+=1; $hear.="<br><div id=\"div".($keyex+1)."\">".($keyex+1).". <b><a href=\"$stex\">".str_replace("%20", " ", $stex)."</a></b> - <b><a href=\"javascript:play('$stex')\">Play</a></b>&nbsp;|&nbsp;<b><a href=\"javascript:stop()\">Stop</a></b></div>";}else {$mp3_found+=1; $hear.="<br><div id=\"div".($keyex+1)."\">".($keyex+1).". <b><a href=\"$stex\">".str_replace("%20", " ", $stex)."</a></b></div>";}} }else {


if (@file_exists("$base_loc/content/".$stex.".txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/".$stex.".txt" , "r");
$page_content = fread($pageopen, filesize("$base_loc/content/".$stex.".txt"));
if (preg_match("/==(.*)==/i", $page_content, $output)) {
$page_title=$output[1];
} else {
$page_title = "";
}
fclose ($pageopen);

$page_content=str_replace("==$page_title==", "" , $page_content);
$f_con.="<br><br><b>".strtoken(strip_tags($page_title),"|")."</b><br><br>$page_content";
if ($stex=="s") {

$handle=opendir('./admin/content/');

while (($file = readdir($handle))!==FALSE) {
if (substr($file,0,1)=="s") {
$fp = fopen ("./admin/content/$file" , "r");

$all= fread ($fp, 300);
if (preg_match("/==(.*)==/i", $all, $out)) {
$line=$out[1];
} else {
$line = "Без заголовка";
}
$line=substr($line, 0 , 82);
fclose ($fp);
$out=explode(".",$file);
$c = $out[0];
if (strlen($c)==1) {
$name="<!--00000--><b><a href='$htpath/index.php?page=$c'><font color=$nc2>$line :</font></a></b><hr color=$nc2 noshade size=1>";
} else {
if ($page==$c) {
$name = "<!--$c--><b><font color=$nc3>»</b>&nbsp;<b>$line</b></font>";
} else {
$name = "<!--$c--><b><font color=$nc4>»</font></b>&nbsp;<a href='$htpath/index.php?page=$c'>$line</a>";
}
}
$f_con.="$name<br>\n";
//echo $name;
} else {
continue;
}
}

closedir ($handle);
}
unset ($output, $page_content, $pageopen);
}
}
}
}

if ((preg_match("/.mp3/i",$ext_lnk))&&($mp3_found>1)) {
$hear.="<br>$carat <b><a title=\"$findmpz\" href=\"javascript:play_juke('" . str_replace(" " , "%20", join ("", $mp3_mass)). "')\">".$lang[187]."</a></b><br><br>";
}
}
//end

@$kolvo=@$outc[16];
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
if (substr_count($keyf2, ".")>=1) {
$tmpfs[$kk]="$keyf2";

$imagesz = @getimagesize("$keyf2");
if (@$imagesz[1]<=200){$imagesz[1]=500;}
if (@$imagesz[0]<=200){$imagesz[0]=500;}
if($imagesz[1]>500){$hiz=540;}else{$hiz=($imagesz[1]+10);}
$tmpiz[$kk]=", width=".($imagesz[0]+40).",height=$hiz";
$tmpiz1[$kk]=$imagesz[0]; $tmpiz2[$kk]=$imagesz[1];
$kk+=1;
} else {
}
}
unset($linef2, $keyf2, $tmpf2, $kk);
$fotos="<img src='".$tmpfs[0]. "' border=0>";
if ($fancybox_enable==1) {
//fancybox
$dopos="<script type=\"text/javascript\">
		$(document).ready(function() {
            $(\"a[rel=example_group]\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
        'overlayShow'	:	false,
				'titlePosition' : 'inside',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span style=\"width:100px\"><small>".$lang[421]." ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</small></span>';
				}
			});

		});
	</script>
<div id=\"content\">
<a rel=\"example_group\" href=\"".$tmpfs[0]."\" title=\"\"><img border=0 alt=\"\" src=\"";

} else {
$dopos="<small><b>".$lang[138].":</b><br><br></small>
<div style=\"overflow: auto; width: 100%; height: [auto];\">
<a href=\"#open\" onclick=\"javascript:window.open('open.php?i=".$tmpfs[0]."', 'fr".$fid."1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no".@$tmpiz[1]."')\"><IMG title=\"".$lang[139]."\" style=\"border: 0 solid ".$style['nav_col1']."\" src='";
}
while (list ($linef2, $keyf2) = each ($tmpfs)) {
if ($linef2>=0) {
$mm+=1;
if (isset($tmpfs[($linef2+1)])){
$mmlink="";
//if ($mm==3) {$mmlink="<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\">"; $mm=0; } else {$mmlink="";}
if ($fancybox_enable==1) {
//fancybox
$izlink="$mmlink <a rel=\"example_group\" href=\"".$tmpfs[($linef2+1)]."\" title=\"\"><img border=0 alt=\"\" src=\"";
} else {
$izlink="$mmlink <a href=\"#open\" onclick=\"javascript:window.open('open.php?i=".$tmpfs[($linef2+1)]."','fr".$fid.($linef2+1)."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no".@$tmpiz[($linef2+1)]."')\"><IMG title=\"".$lang[139]."\" style=\"border: 0 solid ".$style['nav_col1']."\" src='";
}
}else{
$izlink="";
}
$widt=round($tmpiz2[$linef2]*$maxh/($tmpiz1[$linef2]+1),0);
if ($widt==0){$widt=$maxh;}
if ($fancybox_enable==1) {
//fancybox
$dopos.="$keyf2\" height=\"".$widt."\" width=\"".$maxh."\"></a> $izlink";

} else {
$dopos.="$keyf2' border=0 height=\"".$widt."\" width=\"".$maxh."\" vspace=4></a> $izlink";
}
}
}
if ($fancybox_enable==1) {
//fancybox
$dopos.="</div>";

} else {
$dopos.="</div><br><img src=\"$image_path/zoom.gif\" border=0 align=left><small>".$lang[140]."</small><br><br>";
}
if ($mm<=4) {$dopos=str_replace("[auto]", "auto", $dopos); }
} else {
$fotos=$foto2;
}
} else {
$fotos="";
}
$aw113=Array();
if (($foto1=="")&&($foto2=="")): $fotos="<img src=\"".$image_path."/no_photo.gif\" border=0 title=\"".$lang[188]."\" align=left>"; endif;

@$aw113[1]=str_replace("'", "", @$aw113[1]);
@$aw113[1]=str_replace("\"", "", @$aw113[1]);
@$aw114=explode(" ", @$aw113[1]);
$cpath=@$aw114[0];
$fil="$cpath";

if (($cpath!="")&&(@file_exists(".$cpath")==TRUE)) {
$imagesz = @getimagesize(".$cpath");
$fwidth=$imagesz[0];
$fheight=$imagesz[1];
if (($fheight!="")&&($fwidth!="")): $fotos=str_replace("<img ", "<img border=0 width=$fwidth height=$fheight title=\"$fwidth x $fheight\" ", $fotos); endif;

if ($ffa==0) {$aauto=$fheight; $ffa=1; $dopos=str_replace("[auto]", ($aauto-80)."px", $dopos);}
}

unset($aw222,$aw111,$aw113, $cpath, $aw114);

}
mysql_close($mysqldb);
if ($sc>0) {
if (@$outc[$metatitlerow]=="") {
if ($hidart==1) {
$tit=strtoken(@$nazv,"*")." ".$brand_name." - ";
$metat=strtoken(@$nazv,"*");
} else {
$tit=@$nazv." - ";
$metat=@$nazv;
}
} else {
$metat=$outc[$metatitlerow];
$tit=@$outc[$metatitlerow]." - ";
}
$fid+=1;
$tt=0;
$tagg=Array();
$swordma=Array();
$swordma=explode("*",$kwords);
$sword=@$swordma[0];
unset($swordma);
$tagg=explode(",",$sword);
unset($tagg[0]);
$tagg=explode(",",@$outc[$metakeyrow].",".$sword);
unset($tagg[0]);
$smartag="";
while (list ($keyfg, $linefg) = each ($tagg)) {
$tagg[$keyfg]=trim($tagg[$keyfg]);
$smartag.="<a href=\"$htpath/index.php?query=".rawurlencode($tagg[$keyfg])."\">".$tagg[$keyfg]."</a> ";
}
$taggs=implode(", ",$tagg);
if (@$outc[$metakeyrow]!="") {
$taggs=$outc[$metakeyrow].", $taggs";
}
$taggs="
<meta name=\"keywords\" content=\"$taggs\">
";
if (@$outc[$metadescrow]!="") {
$taggs.="
<meta name=\"description\" content=\"".$outc[$metadescrow]."\">
";
}
if ($smartag!="") {$smartag="<br><br><b>".$lang['keyword'].": </b> $smartag<br><br>";}
$pohid=@$outc[3];
$pohid=preg_replace("([\D]+)", "", $pohid);
$coll=substr($pohid,-4,4);



$ms=0;
$cfile="$base_file";
if ($mancatid=="") {
$cfile="$base_file";
} else {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) {
if ($admin_speedup==1) {
$cfile="$base_loc/items/$mancatid.txt";
}
}}
if ($item_speedup==1) {
$cfile="$base_loc/items/$mancatid.txt";
}
}
if (!@file_exists($cfile)) {$cfile="$base_file";}
$cf=fopen($cfile,"r");
$coll_qty=0;
$cff=0;
$coll_list="<div align=center><center><table width=100% border=0 cellpadding=0 cellspacing=0><tr>";
$dopos=str_replace("[auto]", "100%", $dopos);
while(!feof($cf)) {


$cst=fgets($cf);

$cout=explode("|",$cst);






@$cfile=@$cout[0];
@$cdir=@$cout[1];
@$csubdir=@$cout[2];
if ($hidart==0) {
@$cnazv=@$cout[3];
} else {
@$cnazv=strtoken(@$cout[3],"*")."<br>[".$lang[419].": ". strtoupper(substr(md5($cout[6].$artrnd),-7))."]";
}
@$cprice=@$cout[4];

@$copt=@$cout[5];
settype ($cprice, "double");
settype ($copt, "double");
$cueprice=@$cprice;

@$cprice=$okr*(round((@$cprice*$kurss)/$okr));

$cueopt=@$copt;
@$copt=round(@$copt*$optkurs);

@$cext_id=@$cout[6];

@$consale=substr(@$cout[12],0,1);
$cvipold="";
$csales="";

if (($cprice==0)||($cprice=="")){$cprem1="<!-- "; $cprem2=" -->"; $cprbuy="<font color=\"#0d0d0d\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$cprem1="";$cprem2="";$cprbuy=""; }
if ((@$podstavas["$cdir|$csubdir|"]!="")||(preg_match("/\%/", @$cout[8])==TRUE)) {
$cstrto=0;
$strtoma=Array();
$strtoma=explode("%",@$cout[8]);
$cstrto=@$strtoma[0];
unset($strtoma);
 if (@$podstavas["$cdir|$csubdir|"]!="") {$cvipold="<span class=\"oldprice\">".($okr*round(@$cprice/$okr))."</span><b> -".$podstavas["$cdir|$csubdir|"]."%<br></b> ";} else {$cvipold="<span class=\"oldprice\">".($okr*round(@$cprice/$okr))."</span><b> -".round($cstrto)."%<br></b> ";}
if ((preg_match("/\%/", @$cout[8])==TRUE)&&(doubleval($cstrto)>0)) {
$csales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center><font color=#000000>SALE<BR><b>-".round($cstrto)."%</b></font></td></tr></table>";
@$cueprice=@$cueprice-(@$cueprice*(doubleval($cstrto))/100);
$cprice=$okr*(round((@$cprice-(@$cprice*(doubleval($cstrto))/100))/$okr));
} else {
$csales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$cdir|$csubdir|"]."%</b></td></tr></table>";
@$cueprice=@$cueprice-(@$cueprice*((double)$podstavas["$cdir|$csubdir|"])/100); $cprice=$okr*(round((@$cprice-(@$cprice*((double)$podstavas["$cdir|$csubdir|"])/100))/$okr));
}
} else {
if (($valid=="1")&&($details[7]=="VIP")): @$cdescription="<br><small>(".$lang[149].": <b>".@$cprice."</b>".$currencies_sign[$_SESSION["user_currency"]].") </font></small>"; $cvipold="<span class=\"oldprice\">".($okr*round(@$cprice/$okr))."</span>"; @$cprice=$okr*round((@$cprice-@$cprice*$vipprocent)/$okr); @$cueprice=@$cueprice-@$cueprice*$vipprocent;  endif;
}
if (doubleval($cstrto)==0) {$csales=""; $cvipold="";}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")): @$cdescription="<br><small>(".$lang[148].": <b>".@$copt."</b>) <font color=\"#a0a0a0\">[ ".$ueopt." ]</font> ART: ".$out[6]."</small>"; endif;}
if ($cprice>=$currencies_zakaz_menee[$valut]) { if ($view_freedeliveryicon==1) {$freedelivery="<div align=center><small><font color=$nc2><b><img src=\"$image_path/free.png\" border=0 align=absmiddle> ".$lang[563]." ".$lang[166]."</b></font></small><br><br></div>";} else {$freedelivery="";}} else {$freedelivery="";}
@$ckwords=@$cout[8];
@$cfoto1=@$cout[9];
if ($cfoto1=="") {$cfoto1="<img src=\"".$image_path."/no_photo.gif\" border=0>";}

$cfoto1=str_replace("http://www.", "http://", str_replace("\"","'", $cfoto1));
//$cfoto1=str_replace("$htpath", @$bad,  stripslashes(@$cfoto1));

$ccoll=substr(preg_replace("([\D]+)", "", @$cout[3]),-4,4);
if (($consale!="0")&&($consale!="")&&($consale!=0)) {

if ($acs!="") {
reset ($accs);
while (list ($keycs, $linecs) = each ($accs)) {
//echo $cout[6]." ".$cout[6]."==".$linecs."<br>";
if ($cout[6]=="$linecs"){
$ms+=1;
$ctax="";
$ctax=@$cout[$taxcolumn];
if ($ctax=="") {$ctax=$deftax;}
if ($tax_function==1) {$cpricetax="<small><nobr><font color=$nc2>".$lang[781].": ".($okr*round($cprice/(1+($ctax/100))/$okr))." ".@$currencies_sign[$_SESSION["user_currency"]]."</font></nobr><br><br><nobr>".$lang[782]." $tax%:<br></nobr></small>"; }

if ($view_deleted_goods==0) {
if (doubleval($cprice)!=0) {
$aacqty+=1;
$wh=" width=".$style['ww']." height=".$style['hh'];
if (($style['ww']=="")||($style['hh'])=="") {
@$fik= str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$cfoto1))));
if (@file_exists(".$fik")){$imagesz = @getimagesize(".$fik"); $wh=" width=".ceil(($imagesz[0])/$kd1)." height=".ceil(($imagesz[1])/$kd1); }else{$wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$cfoto1=str_replace("<img ", "<img". $wh ." vspace=3 hspace=10 title=\"".str_replace("\"", "", str_replace("\'", "",$cnazv))."\" ",stripslashes(@$cfoto1));
@$cfoto1=str_replace("border=0", "style=\"border: 0px solid ".lighter($nc6,-10).";\" ", @$cfoto1);
$cfoto1=str_replace("width= height= ", "", $cfoto1);
@$cvitrin=@$cout[11];
$csqr="/$cvitrin";
if (($cvitrin=="")||("$cvitrin"=="0")) {$cvitrin=$lang['pcs']; $csqr="";}

$bbut="<img id=\"p_$ms\" src=\"pix.gif\" width=78 height=12 border=0><br><font color=$nc3><b id=\"kup_$ms\"></b><b id=\"pcs_$ms\"></b><b id=\"st_$ms\"></b></font><br>".jbuybutton("<a href=#buy onclick=\"javascript:document.getElementById('p_$ms').src='images/wait.gif';document.getElementById('pcs_$ms').innerHTML=Math.round(document.getElementById('pcs_$ms').innerHTML) + 1;document.getElementById('scart').innerHTML=parseFloat(document.getElementById('scart').innerHTML) + $cprice;document.getElementById('kup_$ms').innerHTML='".$lang['buyes']." ';document.getElementById('st_$ms').innerHTML=' $cvitrin ';document.getElementById('p_$ms').src='".$scriptprefix."ok.php?unifid=".md5(@$cout[3]." ID:".@$cout[6])."&t=".time()."&speek=".$speek."&qty='+document.getElementById('pcs_$ms').innerHTML;\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a>", $nc2,60,$nc0);
if ($cvipold!="") {$cspprice="newprice";} else {$cspprice="price";}
$accsst="<td width=".ceil(100/$acqty)."% valign=top><table border=0 width=100%><tr><td style=\"border: 1px dotted $nwc10;\" valign=bottom align=center><a href=\"$htpath/index.php?unifid=" . md5($cout[3]." ID:".@$cout[6]) . "\">$cfoto1</a><br><small><b><a href=\"$htpath/index.php?catid=".translit(@$cdir."_".@$csubdir."_")."\">$csubdir</b></a><br><a href=\"$htpath/index.php?unifid=" . md5($cout[3]." ID:".@$cout[6]) . "\">$cnazv</a></small><br>$cprbuy$cprem1<br>".$cpricetax.$vsygn.$cvipold."&nbsp;<span class=$cspprice>".str_replace(" ","&nbsp;",str_replace(".00",".-", number_format($cprice,2,".","")))."</span>
<br>$bbut$cprem2<br><br></td></tr></table></td>\n\n";
if ($aacqty<$acqty) {
$accss.=$accsst;
} else {
$aacqty=0;
$accss.=$accsst."</tr><tr><td colspan=$acqty><img src=\"$image_path/pix.gif\" width=1 height=20></td></tr><tr>";
}
}

} else {
$aacqty+=1;
$wh=" width=".$style['ww']." height=".$style['hh'];
if (($style['ww']=="")||($style['hh'])=="") {
@$fik= str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$cfoto1))));
if (@file_exists(".$fik")){$imagesz = @getimagesize(".$fik"); $wh=" width=".ceil(($imagesz[0])/$kd1)." height=".ceil(($imagesz[1])/$kd1); }else{$wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$cfoto1=str_replace("<img ", "<img". $wh ." vspace=3 hspace=10 title=\"".str_replace("\"", "", str_replace("\'", "",$cnazv))."\" ",stripslashes(@$cfoto1));
@$cfoto1=str_replace("border=0", "style=\"border: 0px solid ".lighter($nc6,-10).";\" ", @$cfoto1);
$cfoto1=str_replace("width= height= ", "", $cfoto1);
$bbut="<img id=\"p_$ms\" src=\"pix.gif\" width=78 height=12 border=0><br><font color=$nc3><b id=\"kup_$ms\"></b><b id=\"pcs_$ms\"></b><b id=\"st_$ms\"></b></font><br>".jbuybutton("<a href=#buy onclick=\"javascript:document.getElementById('p_$ms').src='images/wait.gif';document.getElementById('pcs_$ms').innerHTML=Math.round(document.getElementById('pcs_$ms').innerHTML) + 1;document.getElementById('scart').innerHTML=parseFloat(document.getElementById('scart').innerHTML) + $cprice;document.getElementById('kup_$ms').innerHTML='".$lang['buyes']." ';document.getElementById('st_$ms').innerHTML=' $cvitrin ';document.getElementById('p_$ms').src='".$scriptprefix."ok.php?unifid=".md5(@$cout[3]." ID:".@$cout[6])."&t=".time()."&speek=".$speek."&qty='+document.getElementById('pcs_$ms').innerHTML;\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a>", $nc2,60,$nc0);
if ($cvipold!="") {$cspprice="newprice";} else {$cspprice="price";}
$accsst="<td width=".ceil(100/$acqty)."% valign=top align=center style=\"border: 1px dotted $nwc10;\"><a href=\"$htpath/index.php?unifid=" . md5($cout[3]." ID:".@$cout[6]) . "\">$cfoto1</a><br><small><b><a href=\"$htpath/index.php?catid=".translit(@$cdir."_".@$csubdir."_")."\">$csubdir</b></a><br><a href=\"$htpath/index.php?unifid=" . md5($cout[3]." ID:".@$cout[6]) . "\">$cnazv</a></small><br>$cprbuy$cprem1<br>".$cpricetax.$vsygn.$cvipold."&nbsp;<span class=$cspprice>".str_replace(" ","&nbsp;",str_replace(".00",".-", number_format($cprice,2,".","")))."</span>
<br>$bbut$cprem2<br><br></td>\n\n";
if ($aacqty<$acqty) {
$accss.=$accsst;
} else {
$aacqty=0;
$accss.=$accsst."</tr><tr><td colspan=$acqty><img src=\"$image_path/pix.gif\" width=1 height=20></td></tr><tr>";
}
}
}
}
}
$acscount=" [<b>".$ms."</b>]";
if (($ccoll==$coll)&&(@$cout[3]!=$nazv)) {

$coll_qty+=1;
//echo $ccoll." = $coll = $coll_qty<br>";

$fi="";
$fi= @str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$cfoto1))));
if (@file_exists(".$fi")){
$maxw=$style['spec_w'];
$imagesz = @getimagesize(".$fi");
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
$wh="width=".$maxw." height=".$widt;

} else{
$wh="width=".$style['spec_w']." height=".$style['spec_h'];
}
unset($fi);

$uslpok=((double)$cprice+(double)$view_deleted_goods);
if ($phqty>=0) {
if ($uslpok!=0) {
	$ctax="";
$ctax=@$cout[$taxcolumn];
if ($ctax=="") {$ctax=$deftax;}
if ($tax_function==1) {$cpricetax="<small><nobr><font color=$nc2>".$lang[781].": ".($okr*round($cprice/(1+($ctax/100))/$okr))." ".@$currencies_sign[$_SESSION["user_currency"]]."</font></nobr><br><br><nobr>".$lang[782]." $tax%:<br></nobr></small>"; }
if ($hidart==1) {
$cfoto1=str_replace("<img ", "<small><b>".strtoken($cout[3],"*")."</b></small><br><img ". $wh ."hspace=5 vspace=5 ", @$cfoto1);
} else {
$cfoto1=str_replace("<img ", "<small><b>".$cout[3]."</b></small><br><img ". $wh ."hspace=5 vspace=5 title=\"".$cout[1]."/\n".$cout[2]."/\n".@$cout[3]."\"", @$cfoto1);
}




if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) {
if ($cvipold!="") {$cspprice="newprice";} else {$cspprice="price";}
$coll_list.="<td valign=top align=center><a href=\"$htpath/index.php?unifid=" . md5($cout[3]." ID:".@$cout[6]) . "\">$cfoto1</a><br>$cprbuy$cprem1".$cpricetax.$vsygn.$cvipold."&nbsp;<span class=$cspprice>".str_replace(" ","&nbsp;",str_replace(".00",".-", number_format($cprice,2,".","")))."</span>$cprem2</td>\n\n";


} else {

$coll_list.="<td valign=top align=center><a href=\"$htpath/index.php?unifid=" . md5($cout[3]." ID:".@$cout[6]) . "\">$cfoto1</a><br><small></small></td>\n\n";


} } else {

$coll_list.="<td valign=top align=center><a href=\"$htpath/index.php?unifid=" . md5($cout[3]." ID:".@$cout[6]) . "\">$cfoto1</a><br><small></small></td>\n\n";


}

$tt+=1;
if ($tt==2){$tt=0; $coll_list.="</tr><tr><td colspan=2><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"></td></tr></table><table width=100% border=0 cellpadding=0 cellspacing=0><tr>";}
}

}
$phqty-=1;
}
}
}
$coll_list.="</tr></table></center></div>";
fclose($cf);
if ($accss!="") {
	$wodth-=30;
	$men3="<td width=30%><table border=0 width=100% cellpadding=0 cellspacing=0 id=\"otherf\" style=\"background-color: $nc6;cursor: pointer; cursor: hand;\" height=28 onclick=\"javascript:otherv();\">
<tr>
<td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top></td>
<td width=100%>&nbsp;&nbsp;<a href=\"#acessories\" onclick=\"javascript:otherv();\"><font color=$nc5>".$lang[732]."$acscount</font></a>&nbsp;&nbsp;</td>";
if ($view_comments==1) {
$men3.="<td valign=bottom><img src=\"$image_path/pix.gif\" width=2 height=27 border=0 style=\"background-color: $nc0\" align=bottom></td></tr></table></td>";
} else {
$men3.="<td valign=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top></td></tr></table></td>";
}
$accss="<font size=3><b>".$lang[731].":</b></font><br><br><table border=0 cellspacing=5 width=100%><tr>$accss</tr></table><hr style=\"border-style: dashed; border-width: 1px;\" color=\"$nc6\" size=\"1\">";
}
//addded 25.08.2006 same goods
if ($view_same_goods!=0) {
$pohoj="<hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc6\"><b>".$lang[194]."</b><br>
<br>\n\n\n".@$coll_list;
} else {
$pohoj="";
}

if ($coll_qty==0) {$pohoj="";}

//end 25.08.2006




$comments_user=@$_SESSION["user_login"];
if ($comments_user==""): $comments_user=$lang[193]; endif;
if ($view_comments==1) {  $men2="<td width=30%><table border=0 width=100% cellpadding=0 cellspacing=0 id=\"commf\" style=\"background-color: $nc6;cursor: pointer; cursor: hand;\" height=28 onclick=\"javascript:commv();\">
<tr>
<td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top></td>
<td width=100% style=\"white-space: nowrap;\">&nbsp;&nbsp;<a href=\"#comments\" onclick=\"javascript:commv();\"><font color=$nc5>".$lang[200]."&nbsp;[<b>$vcount</b>]</font></a>&nbsp;&nbsp;</td>
<td valign=top style=\"white-space: nowrap;\"><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top></td></tr></table></td>";
$wodth-=30;
} else {
$men2="<td><div id=\"commf\" style=\"background-color: $nc6;cursor: pointer; cursor: hand;\"></div></td>";

}

$rand_st=rand(0, count($antispam_array));
$randoma=$antispam_array[$rand_st];
$antispam_q=strtoken($randoma,"=");
if (trim($antispam_q=="")) {$randoma=$antispam_array[0]; $antispam_q=strtoken($randoma,"="); $rand_st=0;}

$antispam_answer=trim(str_replace("$antispam_q=", "", $randoma));
if ($antispam_answer=="".doubleval($antispam_answer)) {$antispam_type=$lang[651];} else {$antispam_type="";}

$comment_form="<div style=\"-moz-border-radius: 10px; background: $nc6; border: 1px solid $nc6; padding: 10px 10px; text-decoration:none;\"><form class=form-inline action=\"".$_SERVER['PHP_SELF'] . "\" method=\"post\"><input type=hidden name=\"unifid\" value=\"".$unifid."\"><input type=\"hidden\" name=\"item_id\" value=\"". $item_id."\">".$lang[192]."<br><br><table border=0 cellpadding=5 width=100%><tr><td valign=\"top\" align=\"right\"><b>".$lang[74].":</b></td><td><input type=\"text\" name=\"comments_name\" value=\"$comments_user\" size=40 style=\"width:100%\"></td><td valign=top><small>".$lang[190]."</small></td></tr><tr><td valign=\"top\" align=\"right\"><b>".$lang[191]."</b></td><td valign=top><textarea name=\"comments_text".md5(date("d.m.Y"))."\" cols=40 rows=5 style=\"width:100%\"></textarea><br></td><td valign=top><small>".$lang[189]."</small></td></tr><tr><td valign=top align=\"right\">
<b>".$lang[683].":</b></td><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=2>
		<tr>
			<td align=\"center\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote1\" width=\"16\" height=\"17\"></td>
            <td align=\"center\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote2\" width=\"16\" height=\"17\"></td>
			<td align=\"center\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote3\" width=\"16\" height=\"17\"></td>
			<td align=\"center\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote4\" width=\"16\" height=\"17\"></td>
			<td align=\"center\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote5\" width=\"16\" height=\"17\"></td>
            <td valign=top rowspan=2 width=25>&nbsp;</td><td valign=top rowspan=2 width=200><small>".$lang[684]."</small></td>
		</tr>
		<tr>
			<td align=\"left\"><input type=\"radio\" value=\"1\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s0.png';
            document.getElementById('vote3').src='$image_path/s0.png';
            document.getElementById('vote4').src='$image_path/s0.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot1><label for=vot1></label></td>
			<td align=\"left\"><input type=\"radio\" value=\"2\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s0.png';
            document.getElementById('vote4').src='$image_path/s0.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot2><label for=vot2></label></td>
			<td align=\"left\"><input type=\"radio\" value=\"3\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s1.png';
            document.getElementById('vote4').src='$image_path/s0.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot3><label for=vot3></label></td>
			<td align=\"left\"><input type=\"radio\" value=\"4\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s1.png';
            document.getElementById('vote4').src='$image_path/s1.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot4><label for=vot4></label></td>
			<td align=\"left\"><input type=\"radio\" value=\"5\" name=\"vote\" checked onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s1.png';
            document.getElementById('vote4').src='$image_path/s1.png';
            document.getElementById('vote5').src='$image_path/s1.png';
            \" autocomplete=\"off\" id=vot5><label for=vot5></label></td>

	</tr></table><br></td></tr>
    <tr><td>&nbsp;</td><td bgcolor=".lighter($nc6,-10)."><fieldset>
<legend>".$lang[826]."</legend>
    <br><table border=0 width=100%><tr><td align=right valign=top><b>$lang[796]:</b></td><td valign=top width=100%><i>$antispam_q?</i></td></tr>
    <tr><td align=right valign=top><b>$lang[805]:</b></td><td valign=top><input type=\"text\" style=\"width:100%\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\"><br><small><i>$antispam_type</i></small></td></tr>
    </table><br></fieldset>
    </td></tr>
    <tr><td>&nbsp;</td><td align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang['sendform']."\"></td><td>&nbsp;</td></tr></table></form></div>";


if ((!isset($use_bigfoto))||($use_bigfoto==0)){ } else { $dff=@$foto1; @$foto1=@$fotos; $fotos="";}
if ($price>=$currencies_zakaz_menee[$valut]) { if ($view_freedeliveryicon==1) {$freedelivery="<div align=center><small><font color=$nc2><b><img src=\"$image_path/free.png\" border=0 align=absmiddle> ".$lang[563]." ".$lang[166]."</b></font></small><br><br></div>";} else {$freedelivery="";}} else {$freedelivery="";}
$cartlist .= "<!-- ".strtoken($nazv,"*")." --><script language=javascript>
<!--
function fotv() {
if (document.getElementById('div_fotf').style.display == 'none') {

document.getElementById('fotf').style.backgroundColor = '$nwc10';
document.getElementById('div_fotf').style.visibility = 'visible';
document.getElementById('div_fotf').style.display = 'inline';

";
if ($view_comments==1) { $cartlist .="document.getElementById('commf').style.backgroundColor = '$nc6';
document.getElementById('div_commf').style.display = 'none';
document.getElementById('div_commf').style.visibility = 'hidden';

";
}
if ($accss!="") {$cartlist .="document.getElementById('otherf').style.backgroundColor = '$nc6';
document.getElementById('div_otherf').style.display = 'none';
document.getElementById('div_otherf').style.visibility = 'hidden';
";
}
$cartlist .="
}
}
";
if ($view_comments==1) { $cartlist .="
function commv() {
if (document.getElementById('div_commf').style.display == 'none') {

document.getElementById('commf').style.backgroundColor = '$nwc10';
document.getElementById('div_commf').style.visibility = 'visible';
document.getElementById('div_commf').style.display = 'inline';

document.getElementById('fotf').style.backgroundColor = '$nc6';
document.getElementById('div_fotf').style.display = 'none';
document.getElementById('div_fotf').style.visibility = 'hidden';

";
if ($accss!="") {$cartlist .="document.getElementById('otherf').style.backgroundColor = '$nc6';
document.getElementById('div_otherf').style.display = 'none';
document.getElementById('div_otherf').style.visibility = 'hidden';
";
}
$cartlist .="
}
}
";
}
if ($accss!="") {$cartlist .="function otherv() {
if (document.getElementById('div_otherf').style.display == 'none') {

document.getElementById('otherf').style.backgroundColor = '$nwc10';
document.getElementById('div_otherf').style.visibility = 'visible';
document.getElementById('div_otherf').style.display = 'inline';

document.getElementById('fotf').style.backgroundColor = '$nc6';
document.getElementById('div_fotf').style.display = 'none';
document.getElementById('div_fotf').style.visibility = 'hidden';

";
if ($view_comments==1) { $cartlist .="document.getElementById('commf').style.backgroundColor = '$nc6';
document.getElementById('div_commf').style.display = 'none';
document.getElementById('div_commf').style.visibility = 'hidden';
";
}
$cartlist.="
}
}
";
}
$cartlist.="
-->
</script>
<table border=0 cellpadding=0 width=\"100%\"><form name=\"cartlist\" action=\"".$_SERVER['PHP_SELF'] . "\" method=\"$post_method\"><tr><td valign=top><div style=\"float:left\"><div style=\"display: block; position: relative;\" align=\"center\"><span style=\"position: absolute; top: 0pt;\">$sales</span>$foto1<div style=\"clear: both;\" align=\"center\"></div></div><img src=$image_path/pix.gif width=20 height=10 border=0>$freedelivery</div>";
if ($additional_photos_poz==1) {if (trim($dopos)!="") {$cartlist.="<div class=round2 align=center><div align=center style=\"height: auto; overflow: auto; width: 100%;\">$dopos</div></div>";}}
if ($use_bigfoto==0) {$cartlist.="</td></tr><tr><td>&nbsp;</td><td colspan=2 width=100% valign=top align=\"justify\">";}  else {$cartlist.="<br><br>";}
$cartlist.="<div style=\"float:left; width:400px; padding: 0px 10px 0px 10px;\"><img src=$image_path/pix.gif width=100 height=1 border=0><h1>";
if ($hidart==1) {$cartlist.=strtoken($nazv,"*")." $brand_name";} else {$cartlist.=$nazv;}
$cartlist.="</h1>$novina $voting<br><small>$lang[419]: $ext_id</small><br><br>$linkfile<a name=\"cartlist\"></a>";
//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";
$cc_cart="";
$cartlisto="";
if (@file_exists($c_filename)==TRUE) {
$cartlisto .= "<br><table width=100% border=0 cellspacing=0 cellpadding=3>";


$custom_cart1=file("./templates/$template/$speek/custom_cart.inc");
if (@file_exists("./templates/$template/$speek/cc_".$podstava[$outc[1]."|".$outc[2]."|"].".inc")) {
$custom_cart2=file("./templates/$template/$speek/cc_".$podstava[$outc[1]."|".$outc[2]."|"].".inc");
$custom_cart=Array_merge($custom_cart1,$custom_cart2);
} else {
$custom_cart=$custom_cart1;
}
$ncc5=2;
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")&&(substr(@$ccc[0],0,2)!="g:")&&($cc_line!="\n")&&(trim(@$outc[$cc_num])!="")&&($cc_num!=($taxcolumn-17))&&($cc_num!=($othertaxcolumn-17))&&($cc_num!=($catdirrow3-17))&&($cc_num!=($catdirrow4-17))&&($cc_num!=($metatitlerow-17))&&($cc_num!=($metadescrow-17))&&($cc_num!=($metakeyrow-17))) {
$ncc=17+$cc_num;
if ($ncc5==2) {
if (trim(@$outc[$ncc])!="") {$cartlisto .="<tr bgcolor=".lighter($nc0,-10)."><td valign=\"top\"><b>".trim(@$ccc[1]).":</b></td><td valign=\"top\" align=\"justify\">".@$outc[$ncc]." ".trim(@$ccc[2])."</td></tr>"; $ncc5=1;}
} else {
if (trim(@$outc[$ncc])!="") {$cartlisto .="<tr><td><b>".trim(@$ccc[1]).":</b></td><td valign=\"top\" align=\"justify\">".@$outc[$ncc]." ".trim(@$ccc[2])."</td></tr>"; $ncc5=2; }
}
}
}
$cartlisto .= "</table><br>";
}
//end

$optionselect="";
$xz=0;
$fo=0;
@$outc[8]=@$outc[8]." ";
while ($xz<50) {
if (preg_match("/option".$xz." /", @$outc[8])==TRUE) {$fo=1; $view_callback=0; $optionselect.=@$optio[($xz-1)];}
$xz+=1;
}
if ($optionselect!="") {$optionselect="<table border=0>$optionselect</table>";}
$callback="";
if ($view_callback==1) {$callback="<td width=70% valign=top><a class=\"btn btn-warning\" style=\"white-space:nowrap;\" href=#callback onClick=javascript:window.open('$htpath/callback.php?speek=".$speek."&unifid=$unifid','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=770,height=530,left=10,top=10')><i class=\"icon-envelope icon-white\"></i><font color=black> $lang[768]</font></a></td>";}
$cartlist.=str_replace($lang[196].":" , "<b>".$lang[196].":</b>", str_replace($lang[197].":" , "<b>".$lang[197].":</b>",str_replace("[price]", $price, $description)))."
<br><br><table border=0><tr>$callback<td width=50% valign=top><small>$dtoday</small></td></tr></table>
<a name=\"play\"></a>".@$hear."$stock$admin_functions</div><div style=\"clear:both\"></div>";
if ($additional_photos_poz==2) {if (trim($dopos)!="") {$cartlist.="<div class=round2 align=center><div align=center style=\"height: auto; overflow: auto; width: 100%;\">$dopos</div></div>";}}



$lid=md5(@$outc[3]." ID:".@$outc[6]);
if ($kupil!="") {if ($view_basketalert==1) {$kupil.="<a id=minibasket_"."$unifid href=$htpath/".$scriptprefix."minibasket.php?unifid=$lid&qty=$qty&speek=$speek></a><script type=\"text/javascript\">
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
    </script>";}}
$cartlist.="$prem1".str_replace("[id]", "0", str_replace("[pr]", "$price",$optionselect))."$kupil$prem2</td>
";
if ($additional_photos_poz==5) {
if (trim($dopos)!="") { if ($fancybox_enable==1) { $cartlist.="<td valign=top><div class=round2 align=center><small><b>".$lang[138].":</b><br><br></small><div align=center style=\"height: ".($aauto-80)."px; overflow: auto; width: ".($el_width+20)."px;\">$dopos</div><br><img src=\"$image_path/zoom.gif\" border=0 align=left><small>".$lang[140]."</small><br><br></div></td>";} else {$cartlist.="<td valign=top><div class=round2 align=center>$dopos</div></td>";}} }

if ($view_bask!=0) {
if ($view_minibasket_incart==1) {
$jsmbasket=jsbbb("jsbask");
if ($usetheme==0) {$cartlist.="<td valign=top>
$jsmbasket
</td>";
} else {
topwo("", "$jsmbasket", $style ['right_width'], $nc0, $nc0, 5,0,"[main_basket]");
}
}
}
$cartlist.="</tr>
</table>";

//Buy button
if ($additional_photos_poz==3) {if (trim($dopos)!="") {$cartlist.="<div class=round2><div style=\"height: auto; overflow: auto;\">$dopos</div></div>";}}
$cartlist.="$prem1
<table class=round4 style=\"background-color: $nc0; background-image: url('grad.php?h=30&w=10&e=".str_replace("#","",$nc0)."&s=".str_replace("#","",lighter($nc0,-20))."&d=crystal'); background-repeat: repeat-x\" border=0 width=100% cellspacing=5 cellpadding=5><tr>";


if ($price==0) {
if ($zero_price_incart==1){
//item price iz zero
if ($path_to_buy=="add") {$viewcart="viewcart";} else {$viewcart="$path_to_buy";}
$cartlist.="<td width=50%><input type=\"hidden\" name=\"action\" value=\"$path_to_buy\"><input type=\"hidden\" name=\"unifid\" value=\"".md5("$nazv"." ID:".@$outc[6])."\"><input type=\"hidden\" name=\"old_action\" value=\"$viewcart\"><b>".$lang['qty'].":</b> <a class=btn onclick=\"javascript:if(document.getElementById('new_qty').value>$minorder){document.getElementById('new_qty').value-=$minorder;}\"><i class=icon-minus></i></a><input type=\"text\" id=\"new_qty\" name=\"qty\" size=\"2\" value=\"$minorder\" style=\"text-align: center;\"$minorderblock><a class=btn onclick=\"javascript:document.getElementById('new_qty').value-=-$minorder;\"><i class=icon-plus></i></a> ".$vitrin."$minupak</td><td width=50% align=right>$pricetax";
if ($vipold!="") {$spprice="newprice";} else {$spprice="price";}
$cartlist.="<font size=\"4\"><span id=span0 class=hidden>0</span>$prbuy";
$cartlist.="</font></td>";
$cartlist.="<td align=\"right\" title=\"".$lang['prebuy']."\">";
if ($view_buybut==1){
$cartlist.= buybutton("<a href=\"javascript:document.cartlist.submit()\" title=\"".$lang['prebuy']."\"><b><font color=\"#ffffff\">" .$lang['prebuy']. "</font></b></a>", $nc2,60,$nc0);
}
}

} else {
//item price>0
if ($view_goodsprice==1){
if ($path_to_buy=="add") {$viewcart="viewcart";} else {$viewcart="$path_to_buy";}
$cartlist.="<td width=50%><input type=\"hidden\" name=\"action\" value=\"$path_to_buy\"><input type=\"hidden\" name=\"unifid\" value=\"".md5("$nazv"." ID:".@$outc[6])."\"><input type=\"hidden\" name=\"old_action\" value=\"$viewcart\"><b>".$lang['qty'].":</b> <a class=btn onclick=\"javascript:if(document.getElementById('new_qty').value>$minorder){document.getElementById('new_qty').value-=$minorder;}\"><i class=icon-minus></i></a><input type=\"text\" id=\"new_qty\" name=\"qty\" size=\"2\" value=\"$minorder\" style=\"text-align: center;\"$minorderblock><a class=btn onclick=\"javascript:document.getElementById('new_qty').value-=-$minorder;\"><i class=icon-plus></i></a> ".$vitrin."$minupak</td><td width=50% align=right>$pricetax";
if ($vipold!="") {$spprice="newprice";} else {$spprice="price";}
$cartlist.="<font size=\"4\">".$vsygn.$vipold."&nbsp;<span id=span0 class=$spprice>".str_replace(" ","&nbsp;",str_replace(".00",".-", number_format($price,2,".","")))."</span>";
$cartlist.="$sqr</font>$minsht</td>";
$cartlist.="<td align=\"right\">";
if ($view_buybut==1){
$cartlist.= buybutton("<a href=\"javascript:document.cartlist.submit()\" title=\"".$lang['buy']."\"><b><font color=\"#ffffff\">" .$lang['buy']. "</font></b></a>", $nc2,60,$nc0);
}
}
}

$cartlist.="</form></small></td></tr></table>$prem2";
//end buy buttom




$men1="<td width=30%><table border=0 width=100% cellpadding=0 cellspacing=0 id=\"fotf\" style=\"background-color: $nwc10;cursor: pointer; cursor: hand;\" height=28 onclick=\"javascript:fotv();\"><tr><td valign=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top></td><td width=100%>&nbsp;&nbsp;<a href=\"#description\" onclick=\"javascript:fotv();\"><font color=$nc5>".$lang['description']."</font></a>&nbsp;&nbsp;</td>";
$wodth-=30;
//$men1.="<td valign=bottom><img src=\"$image_path/pix.gif\" width=1 height=24 border=0 style=\"background-color: $nc0\" align=bottom><img src=\"$image_path/pix.gif\" width=1 height=26 border=0 style=\"background-color: $nc0\" align=bottom><img src=\"$image_path/pix.gif\" width=2 height=27 border=0 style=\"background-color: $nc0\" align=bottom></td></tr></table></td>";
if ($accss!="") {
$men1.="<td valign=bottom><img src=\"$image_path/pix.gif\" width=2 height=27 border=0 style=\"background-color: $nc0\" align=bottom></td></tr></table></td>";
} else {
		if ($view_comments==1) {
$men1.="<td valign=bottom><img src=\"$image_path/pix.gif\" width=2 height=27 border=0 style=\"background-color: $nc0\" align=bottom></td></tr></table></td>";
		} else {
$men1.="<td valign=top><img src=\"$image_path/pix.gif\" width=2 height=1 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\" align=top><img src=\"$image_path/pix.gif\" width=1 height=4 border=0 style=\"background-color: $nc0\" align=top></td></tr></table></td>";
}
}
$cartlist.="<a name=\"comm\"></a>
";
if ($additional_photos_poz==4) {if (trim($dopos)!="") {$cartlist.="$dopos";}}
$cartlist.="<table border=0 width=100% cellspacing=0 cellpadding=0>
<tr>
<td width=$wodth"."%>&nbsp;&nbsp;</td><td width=10 valign=top align=left background=\"grad.php?h=1&w=10&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc0)."&d=horizontal\"><img src=\"$image_path/pix.gif\" width=10 height=8 border=0 style=\"background-color: $nc0\"><br>
<img src=\"$image_path/pix.gif\" width=5 height=1 border=0 style=\"background-color: $nc0\"><br>
<img src=\"$image_path/pix.gif\" width=1 height=2 border=0 style=\"background-color: $nc0\"></td>
<td width=1><img src=\"$image_path/pix.gif\" width=1 height=1 border=0></td>$men1$men3$men2<td width=10><img src=\"$image_path/pix.gif\" width=10 height=2 border=0></td>
</tr>
<tr>
<td style=\"background-color: $nwc10;\" colspan=7><img src=\"$image_path/pix.gif\" width=3 height=3></td>
</tr><tr><td colspan=7>


<img src=\"$image_path/pix.gif\" width=5 height=20>
<div id=\"div_fotf\"><table border=0 cellspacing=0 cellpadding=2 width=100%>
<tr>
<td valign=top><img src=\"$image_path/pix.gif\" width=$dopwidth height=1 border=0><br>$full_descr ".$finddocz.$findtxtz."<br>$prbuy
</td>
<td width=20 valign=top>&nbsp;</td>
<td valign=top>";
if ($additional_photos_poz==0) {if (trim($dopos)!="") {$cartlist.="$dopos";}}
$cartlist.="</td>
</tr>
</table>
<table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td valign=top><br>$cartlisto<br>$smartag";
$cartlist.= $skl."</small><table border=0 width=100%><tr><td>";
if ($view_social==1) {
$cartlist.= "
<script type=\"text/javascript\" src=\"//yandex.st/share/share.js\" charset=\"utf-8\"></script>
<div class=\"yashare-auto-init\" data-yashareL10n=\"ru\" data-yashareType=\"none\" data-yashareQuickServices=\"facebook,twitter,vkontakte,lj\"></div>
<!--a href=\"http://www.livejournal.com/update.bml?subject=".win_utf8($nazv." ".$price.$currencies_sign[$_SESSION["user_currency"]])."&event=$htpath/index.php?speek=$speek&unifid=" . md5($outc[3]." ID:".@$outc[6]) . "\"><img src=\"images/livejournal.png\" border=0 title=\"-&gt; LiveJournal\"></a>
&nbsp;
<a href=\"http://twitter.com/home/?status=".rawurlencode(win_utf8($nazv." ".$price.$currencies_sign[$_SESSION["user_currency"]]))."%20$htpath/index.php?speek=$speek&unifid=" . md5($outc[3]." ID:".@$outc[6]) . "\"><img src=\"images/twitter.png\" title=\"-&gt; Twitter\" border=0></a>
&nbsp;
<a href=\"http://delicious.com/save?url=$htpath/index.php?speek=$speek&unifid=" . md5($outc[3]." ID:".@$outc[6]) . "&title=".win_utf8($nazv." ".$price.$currencies_sign[$_SESSION["user_currency"]])."&notes=\"><img src=\"images/delicious.png\" title=\"-&gt; Delicious\" border=0></a-->";
}
$cartlist.="&nbsp;
</td>";
if ($view_date_of_goods!=0) {$cartlist.= "\n<td align=right><small><b>".$lang[198]."</b> ".@date("d-m-Y", $datepr)."</small></td>"; }
$cartlist.="<td align=right><a href=\"$htpath/".$scriptprefix."print.php?speek=$speek&unifid=" . md5($outc[3]." ID:".@$outc[6]) . "\" target=\"_blank\"><i class=icon-print></i> </a> <a href=\"$htpath/".$scriptprefix."print.php?speek=$speek&unifid=" . md5($outc[3]." ID:".@$outc[6]) . "\" target=\"_blank\"><b>".$lang[106]."</b></a></td></tr></table>";
$cartlist.="</td>
</tr>
</table>
</div>$flood<div id=\"div_commf\" style=\"display:none; visibility:hidden;\" align=left>";
if ($view_comments==1) {$cartlist.="</b><br>$comm_book<br><br>$comment_form ".@$admin_book."";}

$cartlist.= "</div>
<div id=\"div_otherf\" style=\"display:none; visibility:hiden;\" align=left>";
$cartlist.="<br>$accss";
$cartlist.="</div>
</td></tr></table><TABLE BORDER=0 width=100%><TR><TD>";

if ($smod=="shop") { if ($view_js==1){
$curjs=$_SESSION["jscur"];
if ($ccat!="") {$catidcur=$ccat;} else { $catidcur=$catid;}
if (($catidcur!="")&&($catidcur!="0")) { $indcur=$catidcur;  if (!isset($_SESSION["$indcur"])){ $_SESSION["$indcur"]=0;  }
$curjs=$_SESSION["$indcur"];}

if ($catidcur=="0") {$jscatid="";} else {$jscatid=$catidcur;}
if ($catidcur=="") {$jscatid="";}
if ($indcur=="") {$indcur="jscur"; $curjs=$_SESSION["$indcur"];}
/*
$liis="";
if (!file_exists("$base_loc/items/sales_action_.txt")) { } else {
$liis_tmp=file("$base_loc/items/sales_action_.txt");
while (list ($keyli, $stli) = each ($liis_tmp)) {
$liarr=explode("|",$stli);
//$liarr[9]=str_replace("src=","", strip_tags(str_replace(">","", strtoken(str_replace(strtoken($foto1,"src="),"",str_replace("SRC=", "src=", str_replace("Src=", "src=",$liarr[9])))," "))));
if ($liarr[9]!="") {
$liis.="<li><a href=\"".$liarr[14]."\" title=\"".$liarr[3]."\">".$liarr[9]."</a></li>";
}
}
$cartlist.="<br><br>
<script type=\"text/javascript\" src=\"js/jquery.jcarousel.min.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"images/skin.css\" />

<style type=\"text/css\">

.jcarousel-skin-tango .jcarousel-container-horizontal {
    width: 100%;
}

.jcarousel-skin-tango .jcarousel-clip-horizontal {
    width: 100%;
}

</style>

<script type=\"text/javascript\">

jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel({
        visible: 3
    });
});

</script



<div id=\"wrap\" style=\"width:750px\">
  <div id=\"mycarousel\" class=\"jcarousel-skin-tango\">
    <ul>
      $liis
    </ul>
  </div>
</div><br><br><br>
";
}

*/
$jslist="<br><br><div class=\"mousewheel_example\" id=\"mousewheel_example_1\"><b id=\"jsp".$jscatid."\"><font size=3><b>".$lang[733].":</b></font></b><br><br><b id=\"jsphp".$jscatid."\"><br><img src=$image_path/ind.gif border=0><br>".$_SESSION["$indcur"]."-".(doubleval($_SESSION["$indcur"])+$js_max)."</b>
<script>
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta=".$curjs."&catid=".$jscatid."&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
</script>
<input type=hidden id=\"jsmax".$jscatid."\" name=\"js_max".$jscatid."\" value=\"".$curjs."\" />
<input type=hidden id=\"jscatid".$jscatid."\" name=\"js_catid".$jscatid."\" value=\"".$jscatid."\" />
<script language=javascript>
function nextfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}
jQuery(function($) {
    $('div.mousewheel_example')
        .bind('mousewheel', function(event, delta) {
            var dir = delta > 0 ? 'Up' : 'Down',
                vel = Math.abs(delta);
                if (dir=='Up') {
                var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
                }

                if (dir=='Down') {
                //window.alert('!');
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if ((document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextc.png')&&(document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextcv.png')) {
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
                }
//            $(this).text(dir + ' at a velocity of ' + vel);
            return false;
        });
});

</script></div>
";

$jslistv="<div class=\"mousewheel_example\" id=\"mousewheel_example_1\"><b id=\"jsp".$jscatid."\"></b><b id=\"jsphp".$jscatid."\"><img src=$image_path/ind.gif border=0><br>".$_SESSION["$indcur"]."-".(doubleval($_SESSION["$indcur"])+$js_max)."</b>
<script>
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta=".$curjs."&catid=".$jscatid."&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
</script>
<input type=hidden id=\"jsmax".$jscatid."\" name=\"js_max".$jscatid."\" value=\"".$curjs."\" />
<input type=hidden id=\"jscatid".$jscatid."\" name=\"js_catid".$jscatid."\" value=\"".$jscatid."\" />
<script language=javascript>
function nextfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}
jQuery(function($) {
    $('div.mousewheel_example')
        .bind('mousewheel', function(event, delta) {
            var dir = delta > 0 ? 'Up' : 'Down',
                vel = Math.abs(delta);
                if (dir=='Up') {
                var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
                }

                if (dir=='Down') {
                //window.alert('!');
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if ((document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextc.png')&&(document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextcv.png')) {
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&unifid=$unifid&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
                }
//            $(this).text(dir + ' at a velocity of ' + vel);
            return false;
        });
});

</script></div>
";

if ($use_vert_js_incart==0) {
$cartlist.="$jslist";
}
}}

if ($flood!="") {
$cartlist.="<script language=javascript>
<!--
document.getElementById('commf').style.backgroundColor = '$nwc10';
document.getElementById('div_commf').style.visibility = 'visible';
document.getElementById('div_commf').style.display = 'inline';

document.getElementById('fotf').style.backgroundColor = '$nc6';
document.getElementById('div_fotf').style.display = 'none';
document.getElementById('div_fotf').style.visibility = 'hidden';

document.getElementById('otherf').style.backgroundColor = '$nc6';
document.getElementById('div_otherf').style.display = 'none';
document.getElementById('div_otherf').style.visibility = 'hidden';
-->
</script>";
}
$cartlist.="$pohoj";
if ($view_goods_count!=0) {$cartlist.="<div align=\"right\"><small><b>".$lang[199]."</b> $views</small></div>";}
$cartlist.=@$f_con;

$cartlist.="</td></tr></table></div>\n</td>";

if ($use_vert_js_incart==1) {
$cartlist.="<td valign=top>$jslistv</td>";
}

//$cartlist.="";
$cartlist.="</tr></table>";
if ($mod_rw_enable==1){ $cart_title=str_replace("index.php?catid=", "", str_replace("&amp;brand=", "/", "<small>".$lang[201]."</small> <img src=\"$image_path/a.gif\"> <small><a href=\"$htpath/index.php?catid=".translit("$dir")."\">$dir</a></small> <img src=\"$image_path/a.gif\"> <small><a href=\"$htpath/index.php?catid=".translit("$dir"."_"."$subdir"."_")."\">$subdir</a></small><b>"));
} else {
$cart_title="<small>".$lang[201]."</small> <img src=\"$image_path/a.gif\"> <small><a href=\"$htpath/index.php?catid=".translit("$dir")."\">$dir</a></small> <img src=\"$image_path/a.gif\"> <small><a href=\"$htpath/index.php?catid=".translit("$dir"."_"."$subdir"."_")."\">$subdir</a></small><b>";
}
if (($dir=="")||($subdir=="")) {$cartlist=""; $cart_title=$lang[202]; $tit=$lang[202]." ";}
$cartlist=str_replace("[cartitle]", "<div align=left class=shadow width=100% style=\"background-color:$nc6; width: 100%\"><table border=0 style=\"width: 100%\" cellpadding=5><tr><td><font size=2>$cart_title</font></td></tr></table></div>", $cartlist);
} else {
$cartlist=$lang['file']." ".$lang[222]. "E8";
}
?>
