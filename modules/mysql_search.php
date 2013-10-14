<?php
$tfind=0;
$add_query="";
$itemfounds=0;
$rating=Array();
$spprice="price";
$queries=Array();
$search_results=Array();
$search_results0=Array();
$search_results1=Array();
$search_results2=Array();
$search_results3=Array();
$query=str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ", trim(trim(trim($query))))));
$queries=explode(" ",toLower($query));
while (list($qwke, $kwelin)=each($queries)) {
if ((trim(trim($kwelin))=="")||(strlen(trim(trim($kwelin)))<3)) {  unset ($queries[$qwke]);}
}
reset($queries);
$count=count($queries);
while (list ($key, $val)=each ($queries)) {

if ($val==""){ array_splice($queries, $key, 1); }
}
reset($queries);
if (@$queries[0]==""){
$query="";
$error="";
} else {
$s1=500;
$s2=1000;
$s3=2000;

$fo=0;
$fc=Array();
$pricetax="";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];
$kolvos=Array();

$nit=1;
unset($sps);
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}
if ((!@$novinka) || (@$novinka=="")){$novinka="";}
if ((!@$sss) || (@$sss=="")){ $sss=0; }
if ((!@$buy_row) || (@$buy_row=="")){ $buy_row=""; }
if ((!@$qty) || (@$qty=="")){ $qty=0; }
if ((!@$perpage) || (@$perpage=="")){ $perpage=$goods_perpage;}
if (!preg_match("/^[0-9_]+$/",$perpage)) { $perpage=$goods_perpage;}
if ($perpage>100) {$perpage=$goods_perpage;}
if ((!@$start) || (@$start=="")){ $start=0; }
if ((!@$starts) || (@$starts=="")){ $starts=0; }
if (!preg_match("/^[0-9_]+$/",$start)) { $start=0;}
if (!preg_match("/^[0-9_]+$/",$starts)) { $starts=0;}
if ($start>99999) {$start=0;}
if ((!@$r) || (@$r=="")){ $r=""; }
if ((!@$sub) || (@$sub=="")){ $sub=""; }
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
$gb="";
$mff=0;
$sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <=0) { $prev=0; }

$nexts=$starts+$perpage;
$prevs=$starts-$perpage;
if ($prevs <=0) { $prevs=0; }

$vitrina="";
$kupil="";

$files_found=0;
$sst=0;
$s=0;
$make_col=$cols_of_goods;
if ($_SESSION["user_module"]=="shop") {
$file=$dbpref."_items_".$speek;



$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
//echo "select db $mysql_db_name<br>";
if (mysql_errno()) die( "Item list. Error-1 "
//.mysql_error()
);
$h=explode("|", @$podst[$catid]);
if (doubleval($priceot)!=0) { $add_query.= " AND `price`>".doubleval($priceot)." ";}
if (doubleval($pricedo)!=999999999) {$add_query= " AND `price`<".doubleval($pricedo);}
if ($brand!="") {$add_query.=" AND `brand`='".mysql_real_escape_string(@$brand)."'"; }
if ($view_deleted_goods==0) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {
$add_query.=" AND `on_offer`='1'";
}
}
if (("$catid"!="0")&&($catid!="")&&($catid!="_")) {
$searchinsubdirs=" AND `dir`='".mysql_real_escape_string(@$h[0])."' AND `subdir`='".mysql_real_escape_string(@$h[1])."'";
} else {
$searchinsubdirs="";
}
//echo $catid;
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
reset($item_fields);
$zap="";
$add_query2="";
if ($query=="showsales") {$add_query2="`keywords` LIKE '%\%%'";} else {
while(list($sek,$sev)=each($item_fields)) {
reset ($queries);
$maxqueres=5;
while (list($qwke, $kwelin)=each($queries)) {
if (($sev=="TEXT")&&($maxqueres>0)) {
$maxqueres-=1;
$add_query2.=$zap." `$sek` LIKE '%".mysql_real_escape_string($kwelin)."%'";
//$zap=" ".mysql_real_escape_string($usl);
$zap=" OR";
}
}
}
}
if (($add_query=="")&&($searchinsubdirs=="")) {
$add_query1="WHERE ($add_query2)";
} else {
$add_query1="WHERE ($add_query2"."$add_query"."$searchinsubdirs)";
}
$mysql_query="SELECT * FROM $file $add_query1";
//echo "$mysql_query<br>";
$result=mysql_query("$mysql_query");
if (mysql_errno()) die( "No items found. Error-2 "
//.mysql_error()
);
$total=mysql_num_rows($result);
//echo "total=".$total."<br>$mysql_query<br>";
$mysql_query="SELECT * FROM $file $add_query1"."$orderby"."$orderway LIMIT ".mysql_real_escape_string($start).",".mysql_real_escape_string($perpage);

//echo $mysql_query;
$result=mysql_query("$mysql_query");
if (mysql_errno()) die( "Item list. Error-3 "
//.mysql_error()
);
while($row = @mysql_fetch_row($result)) {
$st="";
while(list($k,$v)=@each($row)) {

//echo $k."=>".$v."<br>";
if ($k>9) {

$st.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}
$mff+=1;
$ff+=1;
if (is_long(($sst/2))=="TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
// теперь мы обрабатываем очередную строку $streset($langs);
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$st=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $st));
}else{
$st=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $st));
}
}
$out=explode("|",$st);

if ($hidart==1) {
$ext_id=strtoupper(substr(md5(@$out[6].$artrnd), -7));
$newname=strtoken($out[3],"*");

if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ }else{$stun=str_replace($out[3], $newname, $stun); $stun=str_replace($out[6], "" , $stun);  }} else { $stun=str_replace($out[3], $newname, $stun); $stun=str_replace($out[6], "" , $stun);}
} else {
$ext_id=@$out[6];
}

$qwfoun=1;

$ddescription="";

$inbasket=0;
$inb1="";
$inb2="";
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];

if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$out[6].$artrnd), -7));
@$nazv=strtoken(@$out[3],"*")." ". $out[13] . "";
} else {
@$ext_id=@$out[6];
@$nazv=@$out[3];
}

@$price=@$out[4];
$tax="";
$tax=@$out[$taxcolumn];
if ($tax=="") {$tax=$deftax;}

@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
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

@$opt=round(@$opt*$optkurs);
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
$fix=strlen(ExtractString("[zz]".str_replace(",", ".", $okr)."/", ".", "/"));
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
</script>$radiooi<b><input type=hidden id=\"aopr_".$s."_".$saocount."\" value=0><span id=\"aotext_".$saocount."\">".str_replace ("<br>" , "", trim($subaoname)).":</span></b> <select name=\"ao[".$saocount."]\" id=\"aoid_".$s."_".$saocount."\" onchange=\"javascript:ao_".$s."_".$saocount."()\"><option value=\"\"></option>$subaocont</select></div>\n", $description);
}
$saocount+=1;
}

if (preg_match("/[radio]/i", $description)) {

$xxx=0;
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
$fix=strlen(ExtractString("[zz]".str_replace(",", ".", $okr)."/", ".", "/"));
//$subradio_cont.=str_replace ("<img " , "<img ", str_replace ("<br>" , "", trim($tmpradio_val[2])))."<input type=radio value=$aaad name=ao[". $radio_count."] onclick=\"javascript:var oldpr=(0+($okr*Math.round(document.getElementById('radio_pr_".$s."_".$radio_count."').value/$okr)));var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);var idx=(0$add_znak".($okr*(round(($tmpradio_val[1]*$kurs)/$okr))).");opt=new Array();var newpr=(Math.round((0+fixed+idx)/$okr)*$okr);newpr=newpr.toFixed($fix);document.getElementById('span".$s."').innerHTML=newpr.toString();document.getElementById('radio_pr_".$s."_".$radio_count."').value=idx;\"> ".$tmpradio_val[0]."$aad<br>\n";
$subradio_cont.=$radiodiv.str_replace ("<img " , "<img align=absmiddle style=\"margin: 0px 0px 0px 0px;\" ", str_replace ("<br>" , "", trim($tmpradio_val[2])))."<input type=radio value=$aaad id=\"ao_". $radio_count."_".$xxx."_$s\" name=ao[". $radio_count."] onclick=\"javascript:var oldpr=(0+($okr*Math.round(document.getElementById('radio_pr_".$s."_".$radio_count."').value/$okr)));var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);var idx=(0$add_znak".($okr*(round(($tmpradio_val[1]*$kurss)/$okr))).");opt=new Array();var newpr=(Math.round((0+fixed+idx)/$okr)*$okr);newpr=newpr.toFixed($fix);document.getElementById('span".$s."').innerHTML=newpr.toString();document.getElementById('radio_pr_".$s."_".$radio_count."').value=idx;\"><label for=\"ao_".$radio_count."_".$xxx."_$s\">".$tmpradio_val[0]."$aad</label>$radioo\n";
$fo=1;
$xxx++;
$view_callback=0;
$saocount+=1;
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

if (($cac_line!="")&&($cac_line!="\n")&&(trim(@$out[$cac_num])!="")&&($cac_num!=$taxcolumn)&&($cac_num!=$othertaxcolumn)&&($cac_num!=$catdirrow3)&&($cac_num!=$catdirrow4)&&($cac_num!=$metatitlerow)&&($cac_num!=$metadescrow)&&($cac_num!=$metakeyrow)) {
$ddescription.="<tr><td><b>$cac_line: </b></td><td>". @$out[$cac_num] ." ". $cartl2[$cac_num]."</td></tr>\n";
}
}
$ddescription.="</table></div>";
}

if ($zero_price_incart==0){
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
} else {
if (($price==0)||($price=="")){$prem1=""; $prem2=""; $prbuy=" ";} else {$prem1="";$prem2="";$prbuy=""; }

}

//opt
$strto=0;
if(substr($details[7],0,3)!="OPT") {
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>"; if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";} @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")){
	//@$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueprice]</font></small>";
	$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
	@$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent;
	}
}

//eof opt
}
if (doubleval($strto)==0) {$sales=""; $vipold="";}
if (($valid=="1")&&($details[7]=="ADMIN")){ @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>) <font color=\"#a0a0a0\">[$ueopt]</font> ART: ".$out[6]."</small>"; }
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
	if (($valid=="1")){
	$admin_functions="<br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')>
	<input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&unifid=".$row[0]."&item_id=".$row[1]."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br>";
	}
	}
if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
@$kwords=@$out[8];
@$foto1=@$out[9];
$kolvos[md5(@$out[3]." ID:".@$out[6])]=@$out[16];
if (($varcart>=100)||($varcart==15)) {
$foto1=str_replace("<img ", "<img vspace=3 hspace=10 ",  stripslashes(@$foto1));
} else {
if ($hidart==1) {
$foto1=str_replace("<img ", "<img vspace=3 title='".str_replace("\"", "", str_replace("\'", "",strtoken($out[3],"*")))."' ",  stripslashes(@$foto1));
} else {
$foto1=str_replace("<img ", "<img vspace=3 title='".str_replace("\"", "", str_replace("\'", "",$out[3]))."' ",  stripslashes(@$foto1));
}
}
@$foto2=@$out[10];
@$vitrin=@$out[11];
$sqrp="/$vitrin";
if (("$vitrin"=="0")||($vitrin=="")||($vitrin==$lang['pcs'])) {$vitrin=$lang['pcs']; $sq=0; $sqrp="";} else {$sq=1;}
if (doubleval(@$out[$minorderrow])>=1) {$minorder=doubleval(@$out[$minorderrow]); $minorder2=(doubleval(@$out[$minorderrow])*2); $minorderblock=" readonly=readonly"; $minsht="<br><font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1005]))."</font><br><br>"; $minupak="<br><font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1006]))."</font>";} else {$minorder=1; $minorder2=2; $minorderblock=""; $minsht=""; $minupak="";}

@$onsale=substr(@$out[12],0,1);
if ($view_deleted_goods==0) {if (($price==0)||($price=="0")||($price=="")){if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {continue;} }}
if ((doubleval($onsale)==0)||($price<$priceot)||($price>$pricedo)){ continue; }
@$brand_name=@$out[13];
if ($brand!="") { if ($brand_name!="$brand") { continue;} }
//Опции
$optionselect="";
$xz=0;

@$out[8]=@$out[8]." ";
while ($xz<50) {
if (preg_match("/option".$xz." /", @$out[8])==TRUE) {$fo=1; $view_callback=0; $optionselect.=@$optio[($xz-1)];}
$xz+=1;
}
if ($fo==1) {$optionselect="<br><table border=0>$optionselect</table>";}

//end Опции

@$ext_lnk=@$out[14];
$linkfile="";
$hear="";
if (preg_match("/\.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"Прослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }

@$full_descr=@$out[15];
//@$awv1=explode("http://", @$foto1);
//@$awv2=explode("/", @$awv1[1]);
//@$foto1=str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto1);
//@$awv1=explode("http://", @$foto2);
//@$awv2=explode("/", @$awv1[1]);
//@$foto2=str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto2);
//unset ($awv1, $awv2);

$wh="";

$foto1=str_replace("<img ", "<img vspace=3 hspace=10 title=\"$nazv\"",  stripslashes(@$foto1));

@$foto1=str_replace("border=0", "border=0 align=left", @$foto1);

@$kolvo=@$out[16];
$lid=md5(@$out[3]." ID:".@$out[6]);
$qty=doubleval($qty);
if($qty!=0){ $shtuk=$vitrin;
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>";  if ($view_basketalert==1) { $kupil.="<a id=minibasket_"."$unifid href=$htpath/".$scriptprefix."minibasket.php?unifid=$lid&qty=$qty&speek=$speek></a><script type=\"text/javascript\">
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
    </script>";}} else { $kupil=""; }}
$link="<a href=\"" . $htpath . "/index.php?view=$file\">" . $nazv . "</a>";
/* Для сортировки правильной давай переведем номер из представления 1 в представление 000001*/
$sortby="";

$rat=0;
if ($view_comments==1) {

if (@file_exists("./admin/comments/votes/$lid.txt")==TRUE) {
$tmpvotef=file("./admin/comments/votes/$lid.txt");
$rat=round(doubleval(trim($tmpvotef[0])));
unset($tmpvotef);
}
}
$voterate="";
if ($view_comments==1) {if (($rat>=1)&&($rat<=5)) {$voterate="<br><img src=\"$image_path/vote".$rat.".png\" border=0>";}}
if ($nazv!="") {
$big="";
if ($description=="") {$description=""; }

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
eval ($evstr);
}
}


$files_found +=1;
$tfind=1;
$s+=1;

}

}
if ($files_found>0) {$itemfounds=1;} else {$itemfounds=0;}

mysql_close($mysqldb);
$sst=0;
$ddt=0;

reset ($sps);


if ($start>$total){$start=(floor($total/$perpage))*$perpage; }
while ($sst < $perpage) {
$gt = 0;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}
if (!isset($sps[$sst])) {$sps[$sst]="";}
$strtoma=Array();
$strtoma=explode("|",$sps[$st]);
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
$sps[$sst]=str_replace("[foto1]",$strtoma[2], $strtoma[0]);
$stoks="";
$val=$sps[$sst];
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
if (!isset($kolvos[$sklname])) {$kolvos[$sklname]=0;}
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
$sst +=1;
$ddt +=1;
$gb .="$val\n";
if ($sst==$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $gb.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=5 width=100%><tr>";}

}

$numberpages=(ceil ($total/$perpage+0.000001));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total) { $end=$total-1 + $gt; }

if (($catid!="")&&($catid!="_")) {$queryed="&catid=".rawurlencode($catid);} else {$queryed="";}
$sstat= "<center><small><br>".$lang[203]." <b>$numberpages</b> ".$lang[206]." <b>$total</b> ".$lang[207]." ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=" . ($start+$perpage) . "&perpage=$perpage&usl=$usl&brand=$brand\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=0&perpage=&brand=$brand\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=" . ($start-$perpage) . "&perpage=$perpage&usl=$usl&brand=$brand\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
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
if (($tt>(11+round($start/$perpage)))||($tt<(round($start/$perpage)-10))) {
	if ($tt<(round($start/$perpage)-10)) {
		$td+=1;
		} else {
			$ts+=1;
			}
			} else {
if (($start/$perpage)==$s) {
$curp=($s+1);
if (($s+1)==$numberpages) {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b>";
} else {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b> <img src=\"$image_path/a.gif\"> ";
}
} else {
if (($s+1)==$numberpages) {
$pp.= "<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=" . ($s*$perpage) . "&perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=" . ($s*$perpage) . "&perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=0&perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=0&perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&start=" . ($perpage*($numberpages-1)) . "&perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }
if (!isset($view_compact)){} else { if($view_compact==1) { $poisks="";} else {$poisks="$ppages";}}
if ($usetheme==0) {
if ($view_goodsprice==1){ if ($view_sort==0) { $sortecho=""; }} else {$sortecho="";}
} else {
if ($view_goodsprice==1){ if ($view_sort!=0) { $themecontent=str_replace("[sortmenu]","$sortecho",$themecontent); $sortecho="";}else {$sortecho="";}} else {$sortecho="";}
}
if ($way=="up") {$wup="down"; $wim="<img border=0 title=\"".$lang['up']."\" src=\"".$image_path."/sort_up.png\" align=absmiddle align=absmiddle>";} else { $wup="up"; $wim="<img border=0 title=\"".$lang['down']."\" src=\"".$image_path."/sort_down.png\" align=absmiddle align=absmiddle>";}

if ($usetheme==0) {
if ($view_goodsprice==1){ if ($view_sort==0) {$sortecho="";} } else { $sortecho=""; }
} else {
if ($view_goodsprice==1){ if ($view_sort!=0) { $themecontent=str_replace("[sortmenu]","$sortecho",$themecontent); $sortecho=""; } else { $sortecho=""; } } else { $sortecho=""; }
}

$gb_g=$gb;
$gb="<table border=0 width=100% cellpadding=0>
<tr><td valign=top>$sortecho&nbsp;&nbsp;&nbsp;<img src=\"$image_path/info.gif\"><font size=2 color=\"".$style['nav_col1']."\">".$lang[141]." \"<b>". $query. "</b>\"</font>$ppages";

if ($varcart>=100) {$gb.="<form class=form-inline action=\"index.php\" method=\"POST\">";

$gb.="<input type=\"hidden\" name=\"catid\" value=\"$catid\"><input type=\"hidden\" name=\"query\" value=\"$query\"><input type=\"hidden\" name=\"brand\" value=\"".@$brand."\"><input type=\"hidden\" name=\"sorting\" value=\"$sorting\"><input type=\"hidden\" name=\"way\" value=\"$way\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"view\" value=\"$view\">";

$gb.="<input type=\"hidden\" name=\"mnogo\" value=\"2\">";}

$gb.="<table border=0 cellspacing=5 cellpadding=0 width=100%>
<tr>
$gb_g
</tr>
</table>";
if ($varcart>=100) {$gb.="<div align=right><input id=\"totals\" type=\"hidden\" value=\"".$cart->total."\"><img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"50\" height=\"10\"><br><input type=submit value=\"".$lang[255]."\" class=\"regbut\"></div></form>";}
$gb.="</td></tr>

</table>

<center><br>$ppages<br><br><br></center>\n";
//$gb="$stat<center><small>$pp</small></center><table border=0 width=100%>$gb</table><center><small>$pp</small></center><br>$stat\n";
$total-=1;
if ($files_found==0) { $gb="";
$viewpage_title = $lang[1102];
$mod="admin";
$tit=$lang[1102];
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
$error="<div style=\"margin:20px;\"><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"ERROR 404\"><b>".$lang[1103]."</b><br><br>".$lang[1104]. " <b><a href=$htpath/index.php>". $shop_name."</a></b><META HTTP-EQUIV=\"REFRESH\" CONTENT=\"5;URL=$htpath/index.php\"><div class=clearfix></div></div>";
}

}

if (($_SESSION["user_module"]=="shop")||($_SESSION["user_module"]=="site")){


if ($query!="") {
$sort=1;
$forum=0;

while (list ($key, $val)=each ($queries)) {
if (($val=="new")||($val=="vds")){
} else {
if (strlen($val)<$minquery) { $error.="<br><br>".$lang[312]."<br><br></ol><br>"; $qb=""; $query=""; break; }
}
if ($val=="") { array_splice($queries, $key, 1); }
}
reset($queries);
if (@$queries[0]=="") { $query=""; $error=""; }


$file="./admin/search/search_index.$speek";

if (@file_exists($file)) {

$f=fopen($file,"r");
while(!feof($f)) {
$stun=fgets($f);

$fc=explode(" > "," > ".$stun);

$stun=strip_tags($stun);
if (!isset($fc[5])) { $fc[5]=""; }
$fc[5]=substr(strip_tags($fc[5]),0,300);
reset($queries);
$scount=0;
$stun=toLower($stun);
if ($usl=="AND") {
while (list ($keyq, $lineq) = each ($queries)) {
if (preg_match("/$lineq/i",toLower($stun))) {
$fc[5]=str_replace("$lineq", "<b>$lineq</b>", $fc[5]);
$scount+=1; }
//echo "$scount=$count $fc[2]<br>\n";

if ($scount==$count) {
$ff+=1;
if ($ff<=100) {
//echo "<div onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc6';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?page=".$fc[1]."\">$ff.&nbsp;".strtoken($fc[2],"/")."</a></div>";
$search_results0[$s]="<!--".$fc[3]."--><font size=2><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">".str_replace("<img ","<img align=left border=0 hspace=10 ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a></font><div><small>".$fc[5] ." ...</small></div><div><small><span style=\"color: $nc2;\"><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">$htpath/index.php?page=".$fc[1]."&speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></small></div><div style=\"clear: both\"></div></div><br>";
$tfind=1;
$s+=1;

}
}
}
}
$scount=0;
if ($usl=="OR") {
while (list ($keyq, $lineq) = each ($queries)) {
if (@preg_match("/$lineq/i",toLower($stun))) {
$scount+=1; $ff+=1;
if ($scount==1) {
if ($ff<=100) {
//echo "<div onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc6';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?page=".$fc[1]."\">$ff.&nbsp;".strtoken($fc[2],"/")."</a></div>";
$search_results0[$s]="<!--".$fc[3]."--><font size=2><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">".str_replace("<img ","<img align=left border=0 hspace=10 ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a></font><div><small>".$fc[5] ." ...</small></div><div><small><span style=\"color: $nc2;\"><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">$htpath/index.php?page=".$fc[1]."&speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></small></div><div style=\"clear: both\"></div></div><br>";
$tfind=1;
$s+=1;
}
}
}
//echo "$scount=$count $fc[2]<br>\n";

}

}

$scount=0;
if ($usl=="ORAND") {

reset($queries);
while (list ($keyq, $lineq) = each ($queries)) {

if (preg_match("/$lineq/i",toLower($stun))) {

$fc[5]=str_replace("$lineq", "<b>$lineq</b>", $fc[5]);
$scount+=1;
}
//echo "$scount=$count $fc[2]<br>\n";

if ($scount==$count) {
$ff+=1;
if ($ff<=100) {
//echo "<div onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc6';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?page=".$fc[1]."\">$ff.&nbsp;".strtoken($fc[2],"/")."</a></div>";
$search_results1[$s1]="<!--".$fc[3]."--><font size=2><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">".str_replace("<img ","<img align=left border=0 hspace=10 ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a></font><div><small>".$fc[5] ." ...</small></div><div><small><span style=\"color: $nc2;\"><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">$htpath/index.php?page=".$fc[1]."&speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></small></div><div style=\"clear: both\"></div></div><br>";
$tfind=1;
$s+=1;
$s1+=1;

}
}
}
reset($queries);
while (list ($keyq, $lineq) = each ($queries)) {
if (preg_match("/$lineq/i",toLower($stun))) {
$scount+=1; $ff+=1;
if ($scount>=1) {
if ($ff<=100) {
//echo "<div onmouseout=\"this.style.backgroundColor='transparent';\" onmouseover=\"this.style.backgroundColor='$nc6';\" style=\"cursor: pointer; background-color: transparent;\"><a href=\"index.php?page=".$fc[1]."\">$ff.&nbsp;".strtoken($fc[2],"/")."</a></div>";
$search_results2[$s2]="<!--".$fc[3]."--><font size=2><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">".str_replace("<img ","<img align=left border=0 hspace=10 ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a></font><div><small>".$fc[5] ." ...</small></div><div><small><span style=\"color: $nc2;\"><a href=\"$htpath/index.php?page=".$fc[1]."&speek=$speek\">$htpath/index.php?page=".$fc[1]."&speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></small></div><div style=\"clear: both\"></div></div><br>";
$tfind=1;
//echo $s2." ".$scount." ".$search_results2[$s2];
$s+=1;
$s2+=1;
}
}
}
//echo "$scount=$count $fc[2]<br>\n";

}

}



}

fclose($f);
}
unset ($st);

//Сортировка

if($view_forum==1){
	if ($valid=="1") {
//админу выдаем поиск в заказах

reset($queries);
$file="./admin/search/forum_index.txt";


if (@file_exists($file)) {
$f=fopen($file,"r");
$ff=0;
while(!feof($f)) {
$st=fgets($f);
$ff+=1;
$query_string2=join("$uslovie", $queries);
$result=@preg_match_all("/$query_string2/i",toLower($st),$matches);
if ($result!=FALSE) {
$fc=explode(" > ", $st);
reset ($queries);
//Найдем кол-во совпадений
$ss=0;
$sst=0;
$fw1[0]="";
$strt=$fc[4];
$fc[4]=substr(strrchr(substr($fc[4], 0 ,
strpos($fc[4],$matches[0][0])), " ").
strstr($fc[4],$matches[0][0]),0,60);
while (list ($key, $val)=each ($queries)) {
$fw1[$sst]="\"$val\"";
$fc[4]=str_replace("$val", "<b>$val</b>", $fc[4]);
$ss+=substr_count("$strt", $val);
$sst+=1;
}

$fw2=array_unique($fw1);
$fw=implode(" , " , $fw2);
if ($sort==1){ $sortby=$fc[2];} else {$sortby=$ss;}
$search_results3[$s3]="<!--$sortby--><a href=\"$htpath/".$fc[0]."\">".$fc[1]."</a><div>... ".$fc[4]." ...</div><div><span style=\"color: #006600;\" title=\"".$fc[0].".html (".$fc[3].") ".$fc[2]." </span> &#151; <font color=\"#bb0000\">$fw ".$lang[308]." <b>" . $ss . "</b></font></div></div>";
$tfind=1;
unset ($fc, $fw1, $fw2, $fw, $val, $key, $matches, $strt);
$s+=1;
$s3+=1;
//if ($s>=$maxresult) {echo "<br><br><b>Слишком много результатов!</b> Уточните поисковый запрос!<br><br></ol><br><br><small><b>Powered by:</b> EuroWebcart Search 1.0 beta / <b>Programming:</b> EuroWebcart</small><br><br>$form$footer"; exit; }
}
}
fclose ($f);
}
unset ($st);













}
}


if(($details[7]=="ADMIN")||($details[7]=="MODER")){
	if (($valid=="1")) {
//админу выдаем поиск в заказах

reset($queries);
$file="./admin/search/baskets_index.txt";


if (@file_exists($file)) {
$f=fopen($file,"r");
$ff=0;
while(!feof($f)) {
$st=fgets($f);
$ff+=1;
// теперь мы обрабатываем очередную строку $st
$query_string2=join("$uslovie", $queries);
$result=@preg_match_all("/$query_string2/i",toLower($st),$matches);
if ($result!=FALSE) {
$fc=explode(" > ", $st);
reset ($queries);
//Найдем кол-во совпадений
$ss=0;
$sst=0;
$fw1[0]="";
$strt=$fc[4];
$fc[4]=substr(strrchr(substr($fc[4], 0 ,
strpos($fc[4],$matches[0][0])), " ").
strstr($fc[4],$matches[0][0]),0,60);
while (list ($key, $val)=each ($queries)) {
$fw1[$sst]="\"$val\"";
$fc[4]=str_replace("$val", "<b>$val</b>", $fc[4]);
$ss+=substr_count("$strt", $val);
$sst+=1;
}

$fw2=array_unique($fw1);
$fw=implode(" , " , $fw2);
if ($sort==1){ $sortby=$fc[2];} else {$sortby=$ss;}
$search_results3[$s3]="<!--$sortby--><a href=\"$htpath/admin/baskets/".$fc[0].".html\">".$fc[1]."</A><div>... ".$fc[4]." ...</div><div><span style=\"color: #006600;\" title=\"".$fc[0].".html (".$fc[3].") ".$fc[2]." </span> &#151; <font color=\"#bb0000\">$fw ".$lang[308]." <b>" . $ss . "</b></font></div></div>";
$tfind=1;
unset ($fc, $fw1, $fw2, $fw, $val, $key, $matches, $strt);
$s+=1;
$s3+=1;
//if ($s>=$maxresult) {echo "<br><br><b>Слишком много результатов!</b> Уточните поисковый запрос!<br><br></ol><br><br><small><b>Powered by:</b> EuroWebcart Search 1.0 beta / <b>Programming:</b> EuroWebcart</small><br><br>$form$footer"; exit; }
}
}
fclose ($f);
}
unset ($st);













}
}
$search_results=array_unique(array_merge($search_results0,$search_results1,$search_results2,$search_results3));
//@rsort($search_results);
@reset($search_results);


//Выдача результатов

$st=0;
$search_results_list="";
while ($st < $perpage) {
$gt=0;
if ((!@$search_results[($starts+$st)]) || (@$search_results[($starts+$st)]=="")) { $rem1="<!--"; $rem2="-->"; }
if ((!@$search_results[($starts+$st)]) || (@$search_results[($starts+$st)]=="")) { $search_results[($starts+$st)]=""; $gt=1; $rem1="<!--"; $rem2="-->"; break; break; }

if (@$search_results[($starts+$st)]=="") { break; }

$search_results_list .="<div class=round2><b>".($starts+$st+1).".</b>". $search_results[($starts+$st)] . "\n\n\n\n";
$st +=1;
}
$total=count ($search_results)-$gt;

$numberpages=(ceil ($total/$perpage));
$startnew=$starts+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total) { $end=$total-1 + $gt; }

$stat="<h4><font color=\"".$style['nav_col1']."\">".$lang[309]."</font></h4><small>".$lang[310].": \"<b>$query</b>\" ".$lang[206]." <b>".($total)."</b> | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($starts/$perpage)==$s) {
$pp.="<b>" . ($s+1) . "</b> | ";
} else {
$pp.="<a href=\"".$_SERVER['PHP_SELF']."?query=".rawurlencode($query)."$queryed&starts=" . ($s*$perpage) . "&sort=$sort&forum=$forum\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
$pp="<br><br>&nbsp;&nbsp;<small>".$lang[105].":&nbsp;$pp</small><br><br>";






$total-=1;
if ($s==0){ if ($tfind!=0) {$pp=""; $stat=""; $search_results_list="";} else {$pp=""; $stat=""; $search_results_list="";} }
if ($numberpages==1) { $pp="<br><br>"; }
$gb.="$stat$pp$search_results_list$pp";

}
}

if ($total>=0) {$error="";}
if ($error!="") {$query="";}
if (($smod!="shop") && ($total<0)) { if ($tfind==0) { $query=""; $tit=""; } }
if (($smod!="shop") && ($total>=0)) {if ($tfind==0) { $query=""; $tit=""; } }
if ($error!="") {$query=""; $tfind=1; $tit="";}
if ($itemfounds>0) {
if ($usetheme==0) {
$gb="<table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td valign=top>$gb</td><td valign=top>";
$gb.=jsbbb("jsbask");
$gb.= "</td></tr></table>";} else {
topwo("", jsbbb("jsbask"), $style ['right_width'], $nc0, $nc0, 5,0,"[main_basket]");
}
}
}

?>
