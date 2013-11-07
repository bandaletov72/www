<?php
if ($secon<time()) {
$_SESSION["search_time"]=time();
$notfound=0;
$queryed="";
$ff=0;
$s=0;
$itemfounds=0;
if(isset($_GET['f_user'])) {$f_user=$_GET['f_user']; }elseif(isset($_POST['f_user'])){ $f_user=$_POST['f_user']; }else {$f_user="";}
if (!preg_match('/^[ёЁа-яА-Яa-zA-Z0-9_\,\.\?\&\#\;\ \%\(\)\/-]+$/i',$f_user)) { $f_user="";}
if (($query=="")&&($f_user!="")) {if ($valid=="1") {$query="forum";}}
$tfind=0;
$itemfounds=0;
$rating=Array();
$spprice="price";
$queries=Array();
$search_results=Array();
$search_results0=Array();
$search_results1=Array();
$search_results2=Array();
$search_results3=Array();
$search_results4=Array();
$query=str_replace("  ", " ",str_replace("  ", " ",str_replace("  ", " ", trim(trim(trim($query))))));
$queries=explode(" ",toLower($query));
while (list($qwke, $kwelin)=each($queries)) {
if ((trim(trim($kwelin))=="")||(strlen(trim(trim($kwelin)))<$minquery)) {
unset ($queries[$qwke]);
}
}
reset($queries);
$count=count($queries);
while (list ($key, $val)=each ($queries)) {
if ($val==""){
array_splice($queries, $key, 1);
}
}
reset($queries);

if (@$queries[0]==""){

$query="";
$error="";
}  else {

$s1=500;
$s2=1000;
$s3=2000;

$fo=0;
$fc=Array();
$pricetax="";

$deftax=100*@$taxes[@$_SESSION["user_currency"]];
$kolvos=Array();

if ($f_user=="") {
$rating=@file("./admin/comments/rate.txt");

$nit=1;

unset($sps);
//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}
if ((!@$novinka) || (@$novinka=="")){
$novinka="";
}
if ((!@$sss) || (@$sss=="")){
$sss=0;
}
if ((!@$buy_row) || (@$buy_row=="")){
$buy_row="";
}
if ((!@$qty) || (@$qty=="")){
$qty=0;
}
if ((!@$perpage) || (@$perpage=="")){
$perpage=$goods_perpage;
}
if (!preg_match("/^[0-9_]+$/",$perpage)) {
$perpage=$goods_perpage;
}
if ($perpage>100) {
$perpage=$goods_perpage;
}
if ((!@$start) || (@$start=="")){
$start=0;
}
if ((!@$starts) || (@$starts=="")){
$starts=0;
}
if (!preg_match("/^[0-9_]+$/",$start)) {
$start=0;
}
if (!preg_match("/^[0-9_]+$/",$starts)) {
$starts=0;
}
if ($start>99999) {
$start=0;
}
if ((!@$r) || (@$r=="")){
$r="";
}
if ((!@$sub) || (@$sub=="")){
$sub="";
}
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
$gb="";
$mff=0;
$sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev<=0) {
$prev=0;
}

$nexts=$starts+$perpage;
$prevs=$starts-$perpage;
if ($prevs<=0) {
$prevs=0;
}

$vitrina="";
$kupil="";

$files_found=0;
$st=0;
$s=0;
$make_col=$cols_of_goods; //

if ($_SESSION["user_module"]=="shop") {

if (("$catid"!="0")&&($catid!="")&&($catid!="_")) {
if (!file_exists("$base_loc/items/$catid.txt")) {
$file="$base_file";
} else {$file="$base_loc/items/$catid.txt";}
} else {
$file="$base_file";
}


if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){$file="$base_file";}}
$f=fopen($file,"r");

$ff=0;

while(!feof($f)) {
$mff+=1;
$st=fgets($f);
$ff+=1;
if (is_long(($st/2))=="TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$st=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $st));
}else{
$st=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $st));
}
}
$out=explode("|",$st);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
} else {
if ($out[1]==$lang[418]) {continue;}
}
if ($hidart==1) {
$ext_id=strtoupper(substr(md5(@$out[6].$artrnd), -7));
$newname=strtoken($out[3],"*");

if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
}else{
$stun=str_replace($out[3], $newname, $stun); $stun=str_replace($out[6], "" , $stun);
}
} else {
$stun=str_replace($out[3], $newname, $stun);
$stun=str_replace($out[6], "" , $stun);
}
} else {
$ext_id=@$out[6];
}
$stun=strip_tags(toLower($st));

$query_string2=join("$uslovie", $queries);

$qwfoun=0;
if ($usl=="OR") {$query_string2=implode("|", $queries); if (count($queries)>1) { $query_string2="($query_string2)"; } } else {$query_string2=implode(".*?", $queries); if (count($queries)>1) { $query_string2="$query_string2"; }}

if (preg_match("/".$query_string2."/i", $stun)==true) {   $qwfoun=1; }

if (($query=="showsales")&&(preg_match("/\%/", @$out[8])==TRUE)) {
$qwfoun=1;
}
if ($qwfoun==1) {
$ddescription="";

$inbasket=0;
$inb1="";
$inb2="";
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
if ($catid=="_") {
$uslovie_poiska="_";
} else {
if (substr($catid,-1)=="_") {
$uslovie_poiska=$podstava["$dir|$subdir|"];
echo $uslovie_poiska;
} else {
$uslovie_poiska=$podstava["$dir||"];
}
}
if ($catid==$uslovie_poiska) {
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


$radio_found=0;
$xxx=0;
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
$fix=strlen(ExtractString("[zz]".str_replace(",", ".", $okr)."/", ".", "/"));

if ($aapr>0) {
$aad=" $add_znak".$aapr."$add_valut";}
//$subradio_cont.=str_replace ("<img " , "<img ", str_replace ("<br>" , "", trim($tmpradio_val[2])))."<input type=radio value=$aaad name=ao[". $radio_count."] onclick=\"javascript:var oldpr=(0+($okr*Math.round(document.getElementById('radio_pr_".$s."_".$radio_count."').value/$okr)));var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);var idx=(0$add_znak".($okr*(round(($tmpradio_val[1]*$kurss)/$okr))).");opt=new Array();var newpr=(Math.round((0+fixed+idx)/$okr)*$okr);newpr=newpr.toFixed($fix);document.getElementById('span".$s."').innerHTML=newpr.toString();document.getElementById('radio_pr_".$s."_".$radio_count."').value=idx;\"> ".$tmpradio_val[0]."$aad<br>\n";
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
if (preg_match("/\[input/", $description)==TRUE) {
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
$description.="<input type=hidden name=\"aosign\" value=\"$curcur\">";
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
if ($zero_price_incart==0){
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><b>".$lang['prebuy']."</b></font>";} else {$prem1="";$prem2="";$prbuy=""; }
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
//@$description=@$description . "<br>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueprice]</font>";
$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
@$price=$okr*round((@$price-@$price*$vipprocent)/$okr);
@$ueprice=@$ueprice-@$ueprice*$vipprocent;
}
}

//eof opt
}
if (doubleval($strto)==0) {$sales=""; $vipold="";}
if (($valid=="1")&&($details[7]=="ADMIN")){ @$description=@$description . "<br>(".$lang[148].": <b>".@$opt."</b>) <font color=\"#a0a0a0\">[ $ueopt ]</font> ART: ".$out[6].""; }
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
	if (($valid=="1")){
	$admin_functions="<br><input type=button class=btn value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=".($ff-1)."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button class=btn value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')>
	<input type=button class=btn value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')><br>";
	}
	}
if(@$podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
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
@$foto1=str_replace("border=0", "border=0 align=left style=\"margin-right: 20px; margin-bottom: 5px;\"", @$foto1);
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
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>";  if ($view_basketalert==1) { $kupil.="<a id=minibasket_"."$unifid href=$htpath/minibasket.php?unifid=$lid&amp;qty=$qty&amp;speek=$speek></a><script type=\"text/javascript\">
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
if ($sorting=="price") {
if ($prbuy!="") {if ($way=="down") {$sf=0;} else {$sf=$maximumprice;}} else {$sf=$price;}
if ($stinfo=="int") { if (@$out[16]==0) {if ($way=="down") {if ($prbuy!="") {$sf=0;}else {$sf=1;}} else {$sf=($maximumprice-$price);}} }
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
if ($chars==1) {
$sortby="00000$ff";
}
if ($chars==2) {
$sortby="0000$ff";
}
if ($chars==3) {
$sortby="000$ff";
}
if ($chars==4) {
$sortby="00$ff";
}
if ($chars==5) {
$sortby="0$ff";
}
if ($chars==6) {
$sortby="$ff";
}
}
if ($sorting=="date") {
$chars=intval(strlen($ff));

if ($chars==1) {
$sortby="00000$ff";
}
if ($chars==2) {
$sortby="0000$ff";
}
if ($chars==3) {
$sortby="000$ff";
}
if ($chars==4) {
$sortby="00$ff";
}
if ($chars==5) {
$sortby="0$ff";
}
if ($chars==6) {
$sortby="$ff";
}

}
$rat=doubleval(trim($rating[($mff-1)]));
if ($sorting=="rate") {
$chars=intval(strlen($rating[($mff-1)]));
if ($rat==0) {
if ($way=="up") {
$rat=999999-$mff;
}
}
if ($chars==1) {
$sortby="00000".$rat;
}
if ($chars==2) {
$sortby="0000".$rat;
}
if ($chars==3) {
$sortby="000".$rat;
}
if ($chars==4) {
$sortby="00".$rat;
}
if ($chars==5) {
$sortby="0".$rat;
}
if ($chars==6) {
$sortby="".$rat;
}

}
$voterate="";
if ($view_comments==1) {
if (($rat>=1)&&($rat<=5)) {
$voterate="<br><img src=\"$image_path/vote".$rat.".png\" border=0>";
}
}
if ($nazv!="") {
$big="";
if ($description=="") {
$description="";
}

$novina="";
if ((@$out[8]!="")&&($novinka!="")) {
if (@preg_match("/".$novinka."/",@$out[8])==TRUE) {
$novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";
} else {
$novina="";
}
} else {
$novina="";
}
if (($valid=="1")&&($details[7]=="VIP")) {
$fo=1;
}
$inbasket=doubleval($cart->get_item(md5(@$out[3]." ID:".@$out[6])."|"));
if ($inbasket==0) {
$inbasket="";
$inb1="";
$inb2="";
} else {
$inb1=$inb0;
$inb2=" $vitrin";
}
$price=str_replace(",",".",$price);
$ppp=str_replace(",",".",$ppp);
if ($vipold!="") {
$spprice="newprice";
} else {
$spprice="price";
}
$lid=md5(@$out[3]." ID:".@$out[6]);
$llid="<a href=\"$htpath/index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {
$man=translit(@$out[3])."-".translit(@$out[6]);
if ($mod_rw_enable==0) {
$llid="<a href=\"$htpath/index.php?item_id=".$man."\">";
}else {
$llid="<a href=\"$htpath/".$man.".htm\">";
}
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
</script>";
}
if (($price==0)||(doubleval($onsale)!=1)) {$description=strtoken($description,"<input");}
if ($sq==1) {

eval ($evstr2);

} else {

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
}
}

if ($files_found>0) {
$itemfounds=1;
} else {
$itemfounds=0;
}

fclose($f);

$sst=0;
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

if ($start>$s){
$start=(floor($s/$perpage))*$perpage;
}
while ($sst < $perpage) {
$gt=0;
if ((!@$sps[($start+$sst)]) || (@$sps[($start+$sst)]=="")) { $rem1="<!--"; $rem2="-->"; }
if ((!@$sps[($start+$sst)]) || (@$sps[($start+$sst)]=="")) { $sps[($start+$sst)]=""; $gt=1; $rem1="<!--"; $rem2="-->"; break; break; }
if (is_long(($ddt/2))=="TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}
$strtoma=Array();
$strtoma=explode("|",$sps[($start+$sst)]);
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
$sps[($start+$sst)]=str_replace("[foto1]",$strtoma[2], $strtoma[0]);
$stoks="";
$val=$sps[($start+$sst)];
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("[sklad]","",$val);
//$val.="</td></tr>";
} else {
if ($stinfo=="ext") {
$fnamef="./admin/sklad/stock/$sklname.txt";
if (@file_exists($fnamef)) {
$filef=@fopen ($fnamef, "r");
if ($filef) { $stoks="".str_replace(">", "><br>", fread ($filef, filesize ($fnamef)))."";}
fclose ($filef);
}else {
$stoks="<img src=$image_path/stockno.gif><br>".$lang[175]."";
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

$val=str_replace("[sklad]",$stoks,$val);

}


}
$sst +=1;
$ddt +=1;
$gb .="$val\n";
if ($sst==$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $gb.="</tr></table></td></tr><tr><td valign=top><table class=table2 border=0 cellpadding=5 cellspacing=10 width=100%><tr>";}

}
$total=count ($sps)-$gt;

$numberpages=(ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total) { $end=$total-1 + $gt; }

if (($catid!="") &&($catid!="_")){$queryed="&catid=".rawurlencode($catid);} else {$queryed="";}
$stat= "<center><br>".$lang[203]." <b>$numberpages</b> ".$lang[206]." <b>$total</b> ".$lang[207]." ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></center><br>";

$nextpage="<a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=" . ($start+$perpage) . "&amp;perpage=$perpage&usl=$usl&brand=$brand\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=0&amp;perpage=&brand=$brand\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=" . ($start-$perpage) . "&amp;perpage=$perpage&usl=$usl&brand=$brand\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
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
$pp.= "<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=0&amp;perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=0&amp;perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"$htpath/index.php?catid=".$podstava["$r|$sub|"]."$queryed&query=".rawurlencode($query)."&amp;start=" . ($perpage*($numberpages-1)) . "&amp;perpage=$perpage&usl=$usl&brand=$brand\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }
if (!isset($view_compact)){} else { if($view_compact==1) { $poisks="";} else {$poisks="$ppages";}}

if ($way=="up") {$wup="down"; $wim="<img border=0 title=\"".$lang['up']."\" src=\"".$image_path."/sort_up.png\" align=absmiddle align=absmiddle>";} else { $wup="up"; $wim="<img border=0 title=\"".$lang['down']."\" src=\"".$image_path."/sort_down.png\" align=absmiddle align=absmiddle>";}

if ($usetheme==0) {
if ($view_goodsprice==1){ if ($view_sort==0) {$sortecho="";} } else { $sortecho=""; }
} else {
if ($view_goodsprice==1){ if ($view_sort!=0) { if ($files_found>1)  { $themecontent=str_replace("[sortmenu]","$sortecho",$themecontent); } $sortecho=""; } else { $sortecho=""; } } else { $sortecho=""; }
}

$gb_g=$gb;
$gb="<table class=table2 border=0 width=100% cellpadding=0 cellspacing=0>
<tr><td valign=top>$sortecho<div><i class=icon-search></i>&nbsp;<font size=2 color=\"".$style['nav_col1']."\">".$lang[141]." \"<b>". $query. "</b>\"</font></div><br>$ppages";

if ($varcart>=100) {
$gb.="<form class=form-inline action=\"index.php\" method=\"POST\">";

$gb.="<input type=\"hidden\" name=\"catid\" value=\"$catid\"><input type=\"hidden\" name=\"query\" value=\"$query\"><input type=\"hidden\" name=\"brand\" value=\"".@$brand."\"><input type=\"hidden\" name=\"sorting\" value=\"$sorting\"><input type=\"hidden\" name=\"way\" value=\"$way\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"view\" value=\"$view\">";

$gb.="<input type=\"hidden\" name=\"mnogo\" value=\"2\">";}

$gb.="<table class=table2 border=0 cellspacing=10 cellpadding=5 width=100%>
<tr>
$gb_g
</tr>
</table>";
if ($varcart>=100) {$gb.="<div align=right><input id=\"totals\" type=\"hidden\" value=\"".$cart->total."\"><img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"50\" height=\"10\"><br><input type=submit value=\"".$lang[255]."\" class=\"regbut\"></div></form>";}
$gb.="</td></tr>

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
</div></center>\n";

$total-=1;
$notfound=0;
if ($files_found==0) { $gb="";
$notfound=1;
}

}
}

if (($_SESSION["user_module"]=="shop")||($_SESSION["user_module"]=="site")){

if ($_SESSION["user_module"]=="site") { $sortecho=""; }
if ($query!="") {
$sort=1;
$forum=0;
if ($onlyforum!=1) {
while (list ($key, $val)=each ($queries)) {
if (($val=="new")||($val=="vds")){
} else {
if (strlen($val)<$minquery) { $error.="<br><br>".$lang[312]."<br><br></ol><br>"; $qb=""; $query=""; break; }
}
if ($val=="") { array_splice($queries, $key, 1); }
}
reset($queries);
if (@$queries[0]=="") { $query=""; $error=""; }

if ($f_user=="") {
$file="./admin/search/search_index.$speek";

if (@file_exists($file)) {

$f=fopen($file,"r");
while(!feof($f)) {
$stun=fgets($f);

$fc=explode(" > "," > ".$stun);

$stun=strip_tags($stun);
if (!isset($fc[5])) {$fc[5]="";}
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
$search_results0[$s]="<!--".$fc[3]."--><div onclick=\"document.location.href='$htpath/index.php?page=".$fc[1]."&amp;speek=$speek';\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">".str_replace("<img ","<img align=left border=0 class=img style=\"margin-top:5px;\" ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a><div>".$fc[5] ." ...</div><div><span style=\"color: $nc2; font-style: oblique;\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">$htpath/index.php?page=".$fc[1]."&amp;speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></div><div class=clearfix></div></div></div>";
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
$search_results0[$s]="<!--".$fc[3]."--><div onclick=\"document.location.href='$htpath/index.php?page=".$fc[1]."&amp;speek=$speek';\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">".str_replace("<img ","<img align=left border=0 class=img style=\"margin-top:5px;\" ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a><div>".$fc[5] ." ...</div><div><span style=\"color: $nc2; font-style: oblique;\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">$htpath/index.php?page=".$fc[1]."&amp;speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></div><div class=clearfix></div></div></div>";
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
$search_results1[$s1]="<!--".$fc[3]."--><div onclick=\"document.location.href='$htpath/index.php?page=".$fc[1]."&amp;speek=$speek';\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">".str_replace("<img ","<img align=left border=0 class=img style=\"margin-top:5px;\" ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a><div>".$fc[5] ." ...</div><div><span style=\"color: $nc2; font-style: oblique;\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">$htpath/index.php?page=".$fc[1]."&amp;speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></div><div class=clearfix></div></div></div>";
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
$search_results2[$s2]="<!--".$fc[3]."--><div onclick=\"document.location.href='$htpath/index.php?page=".$fc[1]."&amp;speek=$speek';\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">".str_replace("<img ","<img align=left border=0 class=img style=\"margin-top:5px;\" ", strtoken(strip_tags($fc[2],"<img>"),"|"))."</a><div>".$fc[5] ." ...</div><div><span style=\"color: $nc2; font-style: oblique;\"><a href=\"$htpath/index.php?page=".$fc[1]."&amp;speek=$speek\">$htpath/index.php?page=".$fc[1]."&amp;speek=$speek</a> (".$fc[4].") ".$fc[3]." </span></div><div class=clearfix></div></div></div>";
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
}
}
unset ($st);


if (file_exists("./cat/catcat.php")==true) {

//В каталоге разрешаем искать только зареганым юзерам
if ($valid=="1") {

reset($queries);
$file="./admin/search/xml_index.$speek";

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
$search_results4[$s3]="<!--$sortby--><a href=\"".$fc[0]."\">".substr(strip_tags($fc[1]),0, 100)."...</a><div>... ".$fc[4]." ...</div><div><span style=\"color: #006600;\" title=\"".$fc[0].".html (".$fc[3].") ".$fc[2]." </span> &#151; <font color=\"$nc2\">$fw ".$lang[308]." <b>" . $ss . "</b></font></div></div>";
$tfind=1;
unset ($fc, $fw1, $fw2, $fw, $val, $key, $matches, $strt);
$s+=1;
$s3+=1;
//if ($s>=$maxresult) {echo "<br><br><b>Слишком много результатов!</b> Уточните поисковый запрос!<br><br></ol><br><br><b>Powered by:</b> EuroWebcart Search 1.0 beta / <b>Programming:</b> EuroWebcart<br><br>$form$footer"; exit; }
}
}
fclose ($f);
}


unset ($st);













}
}
if ($view_forum==1){
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
if ($f_user=="") {
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
$search_results3[$s3]="<!--$sortby--><a href=\"$htpath/".$fc[0]."\">".$fc[1]."</a><div>... ".$fc[4]." ...</div><div><span style=\"color: #006600;\" title=\"".$fc[0].".html (".$fc[3].") ".$fc[2]." </span> &#151; <font color=\"$nc2\">$fw ".$lang[308]." <b>" . $ss . "</b></font></div></div>";
$tfind=1;
unset ($fc, $fw1, $fw2, $fw, $val, $key, $matches, $strt);
$s+=1;
$s3+=1;
//if ($s>=$maxresult) {echo "<br><br><b>Слишком много результатов!</b> Уточните поисковый запрос!<br><br></ol><br><br><b>Powered by:</b> EuroWebcart Search 1.0 beta / <b>Programming:</b> EuroWebcart<br><br>$form$footer"; exit; }
}
} else {

//Указан Юзер f_user
$result=@preg_match_all("/$query_string2/i",toLower($st),$matches);
if ($query=="forum") {$result=true;}
$fc=explode(" > ", $st);
$ufc=explode(" / ", @$fc[1]);
if (($result!=false)) {
reset ($queries);
//Найдем кол-во совпадений
$ss=1;
$sst=0;
$fw1[0]="";
$strt=@$fc[4];
$fc[4]=substr(strrchr(substr(@$fc[4], 0 ,
strpos(@$fc[4],@$matches[0][0])), " ").
strstr(@$fc[4],@$matches[0][0]),0,60);
while (list ($key, $val)=each ($queries)) {
$fw1[$sst]="\"$val\"";
$fc[4]=str_replace("$val", "<b>$val</b>", $fc[4]);
$ss+=substr_count("$strt", $val);
$sst+=1;
}

$fw2=array_unique($fw1);
$fw=implode(" , " , $fw2);
if ($sort==1){ $sortby=@$fc[2];} else {$sortby=$ss;}
if (@$ufc[2]==$f_user) {
$search_results3[$s3]="<!--$sortby--><a href=\"$htpath/".$fc[0]."\">".$fc[1]."</a><div>... ".$fc[4]." ...</div><div><span style=\"color: #006600;\" title=\"".$fc[0].".html (".$fc[3].") ".$fc[2]." </span> &#151; <font color=\"$nc2\">$fw ".$lang[308]." <b>" . $ss . "</b></font></div></div>";
$tfind=1;

}
unset ($fc, $fw1, $fw2, $fw, $val, $key, $matches, $strt);
$s+=1;
$s3+=1;
//if ($s>=$maxresult) {echo "<br><br><b>Слишком много результатов!</b> Уточните поисковый запрос!<br><br></ol><br><br><b>Powered by:</b> EuroWebcart Search 1.0 beta / <b>Programming:</b> EuroWebcart<br><br>$form$footer"; exit; }
}




}
}
fclose ($f);
}


unset ($st);













}
}

if ($f_user=="") {
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
$search_results3[$s3]="<!--$sortby--><a href=\"$htpath/admin/baskets/".$fc[0].".html\">".$fc[1]."</a><div>... ".$fc[4]." ...</div><div><span style=\"color: #006600;\" title=\"".$fc[0].".html (".$fc[3].") ".$fc[2]." </span> &#151; <font color=\"$nc2\">$fw ".$lang[308]." <b>" . $ss . "</b></font></div></div>";
$tfind=1;
unset ($fc, $fw1, $fw2, $fw, $val, $key, $matches, $strt);
$s+=1;
$s3+=1;
//if ($s>=$maxresult) {echo "<br><br><b>Слишком много результатов!</b> Уточните поисковый запрос!<br><br></ol><br><br><b>Powered by:</b> EuroWebcart Search 1.0 beta / <b>Programming:</b> EuroWebcart<br><br>$form$footer"; exit; }
}
}
fclose ($f);
}
unset ($st);













}
}
}
$search_results=array_unique(array_merge($search_results0,$search_results1,$search_results2,$search_results4,$search_results3));
//@rsort($search_results);
@reset($search_results);


//Выдача результатов

$sst=0;
$search_results_list="";
while ($sst < $perpage) {
$gt=0;
if ((!@$search_results[($starts+$sst)]) || (@$search_results[($starts+$sst)]=="")) { $rem1="<!--"; $rem2="-->"; }
if ((!@$search_results[($starts+$sst)]) || (@$search_results[($starts+$sst)]=="")) { $search_results[($starts+$sst)]=""; $gt=1; $rem1="<!--"; $rem2="-->"; break; break; }

if (@$search_results[($starts+$sst)]=="") { break; }

$search_results_list .="<div class=\"lnk searchitem mb\" style=\"cursor:pointer; cirsor:hand; padding:5px;\"><b class=\"pull-left label mr\">".($starts+$sst+1)."</b> ". $search_results[($starts+$sst)] . "<div class=clearfix></div>\n\n\n\n";
$sst +=1;
}
$total=count ($search_results)-$gt;

$numberpages=(ceil ($total/$perpage));
$startnew=$starts+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total) { $end=$total-1 + $gt; }

$stat="<h4>".$lang[309]."</h4>".$lang[310].": \"<b>$query</b>\" ".$lang[206]." <b>".($total)."</b> | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($starts/$perpage)==$s) {
$pp.="<b>" . ($s+1) . "</b> | ";
} else {
$pp.="<a href=\"".$_SERVER['PHP_SELF']."?query=".rawurlencode($query)."$queryed&starts=" . ($s*$perpage) . "&sort=$sort&f_user=$f_user&onlyforum=$onlyforum\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
$pp="<br><br>&nbsp;&nbsp;".$lang[105].":&nbsp;$pp<br><br>";






$total-=1;
if ($s==0){ if ($tfind!=0) { $pp=""; $stat=""; $search_results_list="";} else {
if ($notfound==1) {
$viewpage_title = $lang[1102];
$mod="admin";
$tit=$lang[1102];
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
$gb.="<div style=\"margin:20px;\"><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"ERROR 404\"><b>".$lang[1103]."</b><br><br>".$lang[1104]. " <b><a href=$htpath/index.php>". $shop_name."</a></b><META HTTP-EQUIV=\"REFRESH\" CONTENT=\"5;URL=$htpath/index.php\"><div class=clearfix></div></div>";
$catid="";

}
$pp=""; $stat=""; $search_results_list="";} }
if ($numberpages==1) { $pp="<br><br>"; }
$gb.="<div style=\"margin:20px;\">$stat$pp$search_results_list$pp</div>";



}
}

if ($total>=0) {$error="";}
if ($error!="") {$query="";}
if (($smod!="shop") && ($total<0)) { if ($tfind==0) { $query=""; $tit=""; } }
if (($smod!="shop") && ($total>=0)) {if ($tfind==0) { $query=""; $tit=""; } }
if ($error!="") {$query=""; $tfind=1; $tit="";}
if ($itemfounds>0) {
if ($usetheme==0) {
$gb="<table class=table2 border=0 cellspacing=0 cellpadding=10 width=100%><tr><td valign=top>$gb</td></tr></table>";

}
}
}
} else {

$pp=""; $stat=""; $search_results_list="";
$secount=($secon-time());
$gb="<div class=\"content mu\"><noindex><script>
var secount=$secount;

var secounter=setInterval(timer, 100);
function timer()
{
  secount=secount-0.1;
  if (secount <= -1)
  {
     clearInterval(secounter);
     document.getElementById(\"bar1\").style.width='100%';
     document.getElementById(\"secounter\").innerHTML=0;
     document.location.href=\"index.php?query=".rawurlencode($query)."&usl=".rawurlencode($usl)."&starts=$starts&sort=$sort&f_user=$f_user&onlyforum=$onlyforum\";
     return;
  }

 var proct=100-Math.ceil(secount*100/$sec_between_search);
 document.getElementById(\"bar1\").style.width=proct+'%';
 document.getElementById(\"secounter\").innerHTML=Math.ceil(secount);

}
</script><div class=\"mr ml mu mb\" title=\"".$lang[1615]."\" align=center style=\"width:96%\">
<div class=\"mr\" style=\"margin-bottom:5px;\">".$lang[1615]." ".$lang[1616]." <b id=secounter>".$secount."</b> ".$lang[524]."</div>
<div class=\"ml\">
<div class=\"progress progress-striped active\">
<div class=\"bar\" style=\"width: 1%;\" id=bar1></div>
</div>
</div></noindex></div>";

}
?>
