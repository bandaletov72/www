<?php
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
$pricetax="";
$valid=0;
$login="";
unset($details);
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");


function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}

//echo "jsphp.innerHTML+='<b>Hello world!</b>';"; exit;
$bu1="";
$bu2="";
if(isset($_GET['type'])) $type=$_GET['type']; elseif(isset($_POST['type'])) $type=$_POST['type']; else $type="";
if (!preg_match("/^[0-9a-z]+$/i",$type)) { $type="";}
if(isset($_GET['sta'])) $sta=$_GET['sta']; elseif(isset($_POST['sta'])) $sta=$_POST['sta']; else $sta=0;
if (!preg_match("/^[0-9]+$/",$sta)) { $sta=0;}
if(isset($_GET['catid'])) $catid=$_GET['catid']; elseif(isset($_POST['catid'])) $catid=$_POST['catid']; else $catid="";
if (!preg_match("/^[a-z0-9_]+$/",$catid)) { $catid="";}
if(isset($_GET['unifid'])) $unifid=$_GET['unifid']; elseif(isset($_POST['unifid'])) $unifid=$_POST['unifid']; else $unifid="";
if (!preg_match("/^[a-z0-9_]+$/",$unifid)) { $unifid="";}
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek'];  else  $speek="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$speek)) { $speek="";}
if(isset($_GET['currency'])) $currency=$_GET['currency']; elseif(isset($_POST['currency'])) $currency=$_POST['currency']; else $currency="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$currency)) { $currency="";}
$priceot=0; $pricedo=999999999;

$cartl=Array();
$fold="."; require ("./templates/lang.inc");

if ($speek=="") {
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require ("./modules/translit.php");
require("./modules/webcart.php");
$oldanguage=$language;
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }
$cart =& $_SESSION['cart'];

if(!is_object($cart)){
$cart = new webcart();
}
if (!ini_get("register_globals")) {
if (version_compare(phpversion(), "4.1.0", "<") === true) {
if (isset($HTTP_SESSION_VARS)) $_SESSION &= $HTTP_SESSION_VARS;
}
if(!empty($_SESSION)) extract($_SESSION, EXTR_SKIP);
}
require ("./templates/$template/css.inc");
if (!isset($_SESSION["jscur"])){ $_SESSION["jscur"]=0; $indcur="jscur";  }

if (!isset($_SESSION["user_currency"])){
if (!isset($currency)) {$currency="";}
if ($currency==""){
reset($currencies);
//session_register ("user_currency");
while (list ($keycr, $stcr) = each ($currencies)) {
$_SESSION["user_currency"]=$keycr;
break;
}


}

if ($currency!=""){
$found_currency=0;
while (list ($keycr, $stcr) = each ($currencies)) {
if ($currency==$keycr){
//session_register ("user_currency");
$_SESSION["user_currency"]="$keycr";
$found_currency=1;
}
}
if ($found_currency==0){
reset($currencies);
//session_register ("user_currency");
while (list ($keycr, $stcr) = each ($currencies)) {
$_SESSION["user_currency"]=$keycr;
break;
}
}
}

} else {

if (isset($currency)){
reset($currencies);
while (list ($keycr, $stcr) = each ($currencies)) {
if ($currency==$keycr){

//session_register ("user_currency");
$_SESSION["user_currency"]="$keycr";
}
}
}
}

$okr=0;

$okr=$currencies_round[$_SESSION["user_currency"]];
if ($okr==0) {$okr=0.01;}
reset ($currencies);
while (list ($keycr, $stcr) = each ($currencies)) {
if (($keycr==$_SESSION["user_currency"])&&($keycr!="")) {
$kurs=$stcr;
$valut=$_SESSION["user_currency"];
}
}
$details = $cart->get_details();
$valid=@$_SESSION["user_valid"];
$valid=substr($valid,0,300); if (!isset($valid)){$valid="";} if (!preg_match("/^[0-9]+$/",$valid)) { $valid="";}
if ($valid==""): $valid="0"; endif;
if ((!@$_COOKIE["user_name"]) || (@$_COOKIE["user_name"]=="")): $_COOKIE["user_name"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["user_name"])) { @$_COOKIE["user_name"]="";}
if ((!@$_COOKIE["user_pass"]) || (@$_COOKIE["user_pass"]=="")): $_COOKIE["user_pass"]=""; endif;
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",@$_COOKIE["user_pass"])) { @$_COOKIE["user_pass"]="";}

if (($_COOKIE["user_name"]!=="")&&($_COOKIE["user_pass"]!=="")&&($valid=="0")) {


$login=$_COOKIE["user_name"];
$password="";
if (@file_exists("./admin/userstat/".$login.".txt")) {
$file="./admin/userstat/".$login.".txt";
} else {
$file="./admin/db/users.txt";
}
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);

// next stroke $st
$out=explode("|",$st);

@$login2=@$out[1];
@$password2=@$out[2];

if (($login=="$login2")&&(md5(substr($artrnd.$password2.$secret_salt, 0, 128))==$_COOKIE["user_pass"])) {
$password=$password2;
break;
}
}
fclose($f);

}


$servername=str_replace("http://", "", str_replace("www.", "", str_replace($_SERVER['SERVER_NAME'], "", $htpath)))."/";
$cookiedir=$servername;
if ($cookiedir=="/") {$cookiedir="";}
if ($cookiedir=="//") {$cookiedir="";}

if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}
$divleft="<div style=\"position: absolute; z-index: 1\"><img src=\"$image_path/left.png\" style=\"filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$image_path/left.png); width:expression(1); height:expression(1);\" /></div>";
$divright="<div style=\"position: relative; right:157px; text-align:right; z-index: 2;\"><img src=\"$image_path/right.png\" style=\"filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=$image_path/right.png); width:expression(1); height:expression(1);\" align=right/></div>";
$deftax=100*@$taxes[@$_SESSION["user_currency"]];

if (file_exists("./images/".$valut.".png")==TRUE) {
$vsygn="<img align=absbottom src=$htpath/images/".$valut.".png>";
} else {$vsygn=$currencies_sign[$valut]; }
$fcontentsa=file("$base_loc/catid.txt");
$r="";
$sub="";
$ffcat=0;
$st=0;
while (list ($line_num, $line) = each ($fcontentsa)) {
$out=explode("|",$line);
$podstava[$out[1]."|".$out[2]."|"]=$out[0];
$podstavas[$out[1]."|".$out[2]."|"]=$out[4];
$st+=1;
}
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
if ((!@$start) || (@$start=="")): $start=0; endif;

if ((!@$sub) || (@$sub=="")): $sub=""; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;


$js_spisok = "";
unset ($sps);
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

//$file="$base_loc/$js.txt";
$titjs="";
if (!file_exists("$base_loc/items/$catid.txt")) {
$file="$base_file";
} else {$file="$base_loc/items/$catid.txt";}
if (($catid=="")||($catid=="_")||($catid=="0")) {$view_deleted_goods=1; $file="$base_loc/novelty.txt"; $titjs="<div class=ocat1 align=center><font size=3>".$lang[259]."</font></div><br>";}
$fmasp=array_reverse(file($file));
$vit_qty=0;
$ff=0;
$str=0;
if ($sta==0)  { $bu1="no"; $ss1="#end"; } else {$bu1=""; $ss1="javascript:prevfr".$catid."()";}
//shuffle($fmasp);
while (list ($keyz, $st) = each ($fmasp)) {

// теперь мы обрабатываем очередную строку $st
reset($langs);
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$st=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $st));
}else{
$st=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $st));
}
}
$out=explode("|",str_replace("\n", "", $st));
$tst=@explode("^",@$out[0]);

@$file=@$tst[1];
unset ($tst);
$ddescription="";
@$dir=@$out[1];
@$subdir=@$out[2];
if (($dir=="")||($subdir=="")) {continue;}
if ($catid!="Sales"){
if (($out[6]=="sale")||($out[6]=="nosale")||($out[1]=="Sales")) { continue; }
}
if ($hidart==1) {
@$nazv=strtoken(@$out[3],"*")."<br>[".$lang[419].": ".strtoupper(substr(md5(@$out[6].$artrnd),-7))."]";
} else {
@$nazv=@$out[3];
}
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
$kurss=(@$currencies[$valut]/@$currencies[$curcur]);
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
//OPT
$didx=$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$out[$ddidx])*$kurss/$okr)); $price=@$out[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
$sales="";
if ($view_goodsprice==0) {$price=0;}
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color='".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
//opt
$strto=0;
if(substr($details[7],0,3)!="OPT") {
if (isset($podstavas["$dir|$subdir|"])) {
if (($podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {
$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=@$strtoma[0];
unset($strtoma);
 $vipold="<span class=oldprice>".($okr*round(@$price/$okr))."</span> ";
 if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) {
 $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td bgcolor=$nc10 background=grad.php?h=58&w=10&e=".str_replace("#","",$nc0)."&s=".str_replace("#","",$nc10)."&d=vertical align=center valign=middle><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));
 } else {
 $strto=doubleval($podstavas["$dir|$subdir|"]);
 $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td bgcolor=$nc10 background=grad.php?h=58&w=10&e=".str_replace("#","",$nc0)."&s=".str_replace("#","",$nc10)."&d=vertical valign=middle align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";
 @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));
 }
 }
 }
}
if (doubleval($strto)==0) {$sales=""; $vipold="";}
$price=$okr*(round(@$price/$okr));
@$kwords=@$out[8];
$optionselect="";
$xz=0;
$fo=0;
$optionselect="";
$novina=""; if ((@$out[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/",@$out[8])==TRUE) { $novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}


@$foto1=@$out[9];
if ($foto1=="") {$foto1="<img src='".$image_path."/no_photo.gif' border=0>";}
@$foto2=@$out[10];
if ($js_carousel_use_big_photo==1) { if ($foto2!="") { $foto1=strtoken($foto2,">").">"; } }
@$vitrin=@$out[11];


reset($cartl);

@$onsale=substr(@$out[12],0,1);
if ($view_deleted_goods!=1) { if (($price==0)||($price=="0")||($price=="")){if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {$ff+=1; continue;} } }
if (($onsale=="0")||($dir==$lang[418])): $ff+=1; continue; endif;

if (trim($st)=="") {continue;}
if (($catid!="")&&($catid!="0")&&($catid!="_"))  {
if (substr($catid,-1)=="_") {
if (isset($podstava["$dir|$subdir|"])) {
if ($podstava["$dir|$subdir|"]!=$catid){
continue;
} else {
$indcur=$catid;
if (!isset($_SESSION["$indcur"])){
$_SESSION["$indcur"]=$sta;
}
$_SESSION["$indcur"]=$sta;
}
}
} else {


if (isset($podstava["$dir||"])) {
if ($podstava["$dir||"]!=$catid){
continue;
} else {
$indcur=$catid;
if (!isset($_SESSION["$indcur"])){
$_SESSION["$indcur"]=$sta;
}
$_SESSION["$indcur"]=$sta;
}
}

}
} else {
$indcur="jscur"; $_SESSION["jscur"]=$sta;
}
$str+=1;
if ($str>($sta+$js_max+1)) { continue; }
if ($str<=$sta) { continue; }

@$brand_name=@$out[13];

if ($brand_name==""):$brand_name=$lang[417]; endif;
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
$linkfile="";
$hear="";
//if (preg_match("/\.mp3/i",$ext_lnk)) {$hear="<br><br><a href='$htpath/mp3/$ext_lnk\"><img src='$image_path/hear.gif\" title='ѕрослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }
unset ($awv1, $awv2);

$wh="";
if ($js_carousel_use_big_photo==0) { if ($foto1!="") {

$htpat=str_replace("http://www.", "http://",$htpath);
$htpat2=$htpat=str_replace("http://", "http://www.",$htpat);
@$fi=str_replace($htpat,"",str_replace($htpath,"",str_replace($htpat2,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$foto1),"src=")."src=","", stripslashes(@$foto1))),">")," "))));

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
}
$foto1=str_replace("<img ", "<img class=img ",$foto1);
//@$foto1.=$sales;
@$kolvo=@$out[16];
$ff+=1;
$qty=doubleval($qty);
$shtuk=$lang['pcs'];
$link="<a href='" . $htpath . "/index.php?view=$file&fid=$ff\">" . $nazv . "</a>";
if ($nazv!="") {
$big="";
if ($description==""):$description=""; endif;
$novina=""; if ((@$out[8]!="")&&($novinka!="")) { if (@preg_match("/".$novinka."/",@$out[8])==TRUE) { $novina="<br><font color=#b94a48 size=2><b>".$lang[172]."</b></font>";} else {$novina="";}} else {$novina="";}
$sortby="";
$unif=md5(@$out[3]." ID:".@$out[6]);
$voting="";
if ($view_comments==1) {
if (@file_exists("./admin/comments/votes/$unif.txt")==TRUE) {
$tmpvotef=file("./admin/comments/votes/$unif.txt");
$vcount=doubleval(trim($tmpvotef[1]));
$vlevel=round(doubleval(trim($tmpvotef[0])));
$voting="<br><img src=$image_path/vote".$vlevel.".png border=0>";
unset($tmpvotef);
}

}
if ($vipold!="") {$spprice="newprice";} else {$spprice="price";}
if ($price==0) {$ppr="";} else {$ppr="<font size=4>$vsygn</font>$vipold&nbsp;<span class=$spprice>".str_replace(" ","&nbsp;",str_replace(".00",".-", number_format($price,2,".","")))."</span>";}
$tax="";
$tax=@$out[$taxcolumn];
if ($tax=="") {$tax=$deftax;}
if ($tax_function==1) {$pricetax="<small><nobr><font color=$nc5>".$lang[781].": ".($okr*round($price/(1+($tax/100))/$okr))." ".@$currencies_sign[$_SESSION["user_currency"]]."</font></nobr><br><br><nobr>".$lang[782]." $tax%:<br></nobr></small>"; if ($price==0) {$pricetax="";}}
$lid=md5(@$out[3]." ID:".@$out[6]);
$llid="<a href=$htpath/index.php?unifid=".$lid.">";
if ($friendly_url==1) {
if($hidart!=1) {
$man=translit(@$out[3])."-".translit(@$out[6]);
if ($mod_rw_enable==0) { $llid="<a href=$htpath/index.php?item_id=".$man.">"; }else {$llid="<a href=$htpath/".$man.".htm>";}
}
}

$clink2="</a>";
if ($type=="v") {
$sps[$s]="<tr><td valign=top align=center width=100%>$llid<small>$nazv$novina</small><br>$foto1$clink2<br>$pricetax<font color=$nc5>$ppr$voting</font><br></td></tr>";
}else{
$sps[$s]="<td [ww] valign=top align=center width=".floor(100/$js_max)."%>$llid<small>$nazv$novina</small><br>$foto1$clink2<br>$pricetax<font color=$nc5>$ppr$voting</font></td><td valign=top>&nbsp;</td>";
}

//if (($foto1!="")&&($view_vitrin!=0)&&($price!=0)): $vitrin_content[$vit_qty] = "$file|$dir|$subdir|$nazv ID:".@$out[6]."|$price|$opt|$description|$foto1|$ff|"; $vit_qty+=1; endif;
$files_found += 1;
$s+=1;
}


}





//«акрываем базу
$make_col=$cols_of_goods;
$st=0;
$ddt=0;
reset ($sps);

$start=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}

$skl1=strtoken($sps[($start+$st)],"|");
$sklname= str_replace($skl1."|", "", $sps[($start+$st)]);
$sps[($start+$st)]=$skl1;
$stoks="";
$val = $sps[($start+$st)]; //см выше
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("width= height= ", "", str_replace("[sklad]","",$val));
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
$val=str_replace("width= height= ", "", str_replace("[sklad]",$stoks,$val));
}
$st += 1;
if ($st<=$js_max) {
$ddt += 1;

$zz+=1;

$js_spisok .= "$val";

}
}
if ($sta==0) {$divleft="";}
if (($sta+$js_max)>=$str) { $bu2="no"; $ss2="#end"; } else {$bu2=""; $ss2="javascript:nextfr".$catid."()";}
if ($files_found==0) {
if (($sta+1)>($sta+$ddt)) {
$js_spisok = "var jsp".$catid."=document.getElementById('jsphp".$catid."'); jsphp".$catid.".innerHTML='$titjs<table width=96% border=0 cellspacing=0 cellpadding=0><tr><td valign=top><br><br><br><a href=$ss1><img src=$image_path/".$bu1."prevc.png border=0></a></td><td align=right valign=top>&nbsp;</td><td width=100% align=center>$lang[921]</td><td valign=top><br><br><br><a href=$ss2><img src=$image_path/".$bu2."nextc.png id=nextb border=0></a></td></tr></table>';";
} else {
$js_spisok = "var jsp".$catid."=document.getElementById('jsphp".$catid."'); jsphp".$catid.".innerHTML='';";
}
} else {
if ($type=="v") {
$js_spisok ="var jsp".$catid."=document.getElementById('jsphp".$catid."');
jsphp".$catid.".innerHTML='".str_replace("'", "", str_replace("\"", "","<table width=96% border=0 cellspacing=0 cellpadding=0><tr><td bgcolor=$nc6><img src=images/pix.gif ></td><td valign=top align=center>$titjs<table border=0 cellspacing=0 cellpadding=0 width=height=100%><tr><td valign=top align=center><img src=images/pix.gif height=1 width=180><br><a href=$ss1><img src=$image_path/".$bu1."prevcv.png border=0></a><br><br></td></tr>$js_spisok<tr><td valign=top align=center><br><a href=$ss2><img src=$image_path/".$bu2."nextcv.png id=nextb border=0></a></td></tr></table></td></tr></table>"))."';";

} else {
$js_spisok = str_replace("[ww]", "width=\"".round((100/($ddt+0.001)), 2)."%\"", "var jsp".$catid."=document.getElementById('jsphp".$catid."');
jsphp".$catid.".innerHTML='".str_replace("'", "", str_replace("\"", "","$titjs<center><table width=90% border=0 cellspacing=0 cellpadding=0><tr><td valign=top><br><br><br><a href=$ss1><img src=$image_path/".$bu1."prevc.png border=0></a></td><td align=right valign=top>&nbsp;</td>$js_spisok<td valign=top><br><br><br><a href=$ss2><img src=$image_path/".$bu2."nextc.png id=nextb border=0></a></td></tr></table></center>"))."';");
}
}
/*
if ($files_found==0): $js_spisok =""; $error = ""; endif;
if ($s==0): $js_spisok=""; endif;

if ($unifid=="") {

if ($str<$js_max) {$js_spisok = "var jsp".$catid."=document.getElementById('jsphp".$catid."');
//var jsps".$catid."=document.getElementById('jsp".$catid."');
jsphp".$catid.".innerHTML='';
//jsps".$catid.".innerHTML='';";}

}
if (($str==1) &&($files_found==1)) {

$js_spisok = "var jsp".$catid."=document.getElementById('jsphp".$catid."');
//var jsps".$catid."=document.getElementById('jsp".$catid."');
jsphp".$catid.".innerHTML='';
//jsps".$catid.".innerHTML='';";
}
*/
$s=0;
echo "$js_spisok";
?>
