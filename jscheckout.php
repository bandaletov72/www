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
$itemcount=0;
$totalweight=0;
$totalvolume=0;
$full_baskets=Array();
$maxinb=1000;
sleep(1);
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
if(isset($_GET['unifmd'])) $unifmd=$_GET['unifmd']; elseif(isset($_POST['unifmd'])) $unifmd=$_POST['unifmd']; else $unifmd="";
if (!preg_match("/^[0-9a-z]+$/i",$unifmd)) { $unifmd="";}
if(isset($_GET['sw'])) $sw=$_GET['sw']; elseif(isset($_POST['sw'])) $sw=$_POST['sw']; else $sw="";
if (!preg_match("/^[0-9a-z]+$/i",$sw)) { $sw="";}
if(isset($_GET['del'])) $del=$_GET['del']; elseif(isset($_POST['del'])) $del=$_POST['del']; else $del="";
if (!preg_match("/^[0-9a-z]+$/i",$del)) { $del="";}
if(isset($_GET['plus'])) $plus=$_GET['plus']; elseif(isset($_POST['plus'])) $plus=$_POST['plus']; else $plus="";
if (!preg_match("/^[0-9a-z]+$/i",$plus)) { $plus="";}
if(isset($_GET['minus'])) $minus=$_GET['minus']; elseif(isset($_POST['minus'])) $minus=$_POST['minus']; else $minus="";
if (!preg_match("/^[0-9a-z]+$/i",$minus)) { $minus="";}
if(isset($_GET['qt'])) $qt=$_GET['qt']; elseif(isset($_POST['qt'])) $qt=$_POST['qt']; else $qt="";
if (!preg_match("/^[0-9a-z]+$/i",$qt)) { $qt="";}


$cartl=Array();
$fold="."; require ("./templates/lang.inc");

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
if (!isset($_SESSION["maxin"])){ $_SESSION["maxin"]=$maxinb; }
if (!isset($_SESSION["basksw"])){ $_SESSION["basksw"]="on"; }
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
if ($del!="") {
$cart->del_item($del);
}
if ($minus!="") {
$cart->edit_item($minus, doubleval(str_replace(",",".", $qt)));
}
if ($plus!="") {
$cart->edit_item($plus, doubleval(str_replace(",",".", $qt)));
}
$js_spisok = "";
 $items=$cart->get_all();

$fids = $cart->get_fids();
$basket="";
$oform="";
$print_basket="";
$tovarov=0;
$summa=0;




$tovarov = $cart->itemcount; $summa = $cart->total;
//$_SESSION["basksw"]=$sw;
$butonoff="";





$full_basket="<div>$butonoff<a href=$htpath/index.php?action=basket><b>".$lang[35].":</b></a></div><br>";


//$items2=$cart->get_contents($fids);
$summa=0;
$ss=0;
$printmax="";
  foreach($items as $item) {
  $full_baskets[$ss]="";
  $out_c=explode("|", $item['base']);
  $prski="";
  if (($valid=="1")&&($details[7]=="VIP")&&($vipprocent!=0)){ $prski="<br><font color=#b94a48>".$lang[219]." VIP ".($vipprocent*100)."%</font>"; }
  if (!isset($podstavas[$out_c[1]."|".$out_c[2]. "|"])) {$podstavas[$out_c[1]."|".$out_c[2]. "|"]="";}
  if (($podstavas[$out_c[1]."|".$out_c[2]. "|"]!="")||(preg_match("/\%/", @$out_c[8])==TRUE)) {
  $strtoma=Array();
$strtoma=explode("%",@$out_c[8]);
$strto=@$strtoma[0];
unset($strtoma);
  if ((preg_match("/\%/", @$out_c[8])==TRUE)&&(doubleval($strto)>0)) {
  $prski="<br><font color=#b94a48>".$lang[219]." ".doubleval($strto)."%</font>";
  } else {
  $strto=doubleval($podstavas[$out_c[1]."|".$out_c[2]. "|"]);
  $prski="<br><font color=#b94a48>".$lang[219]." ".$podstavas[$out_c[1]."|".$out_c[2]."|"]."%</font>";
  }

  }


//wishlist features
if (preg_match("/^[0-9]+$/",$item['fid'])) {} else {$out_c[9]=$item['fid'];}
$wh="";
if ($out_c[9]!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"",str_replace($htpath,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$out_c[9]),"src=")."src=","", stripslashes(@$out_c[9]))),">")," ")));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){

$imagesz = @getimagesize(".$fi");
if (($imagesz[1]/2)>doubleval($style['hh'])) {
$kkd1= (($imagesz[1]/2)/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/($kkd1*2))." height=".ceil(($imagesz[1])/($kkd1*2))." ";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$out_c[9]=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img". $wh ." ",stripslashes(@$out_c[9]))));


$out_c[9]=str_replace("<img ", "<img border=0 vspace=3 hspace=10 ",  stripslashes(@$out_c[9]));

@$out_c[9]=str_replace("border=0", "border=0 align=left", @$out_c[9]);

} else {
$out_c[9]="";

}
$out_c[9]=str_replace("width= height= ", "", $out_c[9]);
$sqrp="/$out_c[11]";
if (("$out_c[11]"=="0")||($out_c[11]=="")) {$out_c[11]=$lang['pcs'];$sqrp="";}
if (@$out_c[9]==""): $out_c[9]=""; endif;

$lid=md5(@$out_c[3]." ID:".@$out_c[6]);
$llid="<a href=~~~$htpath/index.php?unifid=".$lid."&amp;flag=$speek~~~>";
if ($friendly_url==1) {
if($hidart!=1) {
$man=translit(@$out_c[3])."-".translit(@$out_c[6]);
$llid="<a href=~~~$htpath/index.php?item_id=".$man."~~~>";
}
}
    if (($view_img_minibasket==1)&&(@$out_c[9]!="")) {
    $full_baskets[$ss] .="<table border=0 cellspacing=0 cellpadding=3><tr><td valign=top align=center>$llid".str_replace(" hspace=10","",str_replace(" vspace=3","", @$out_c[9]))."</a></td><td valign=top align=left>";
    } else {
    $full_baskets[$ss] .="<table border=0 cellspacing=0 cellpadding=3><tr><td valign=top align=left>";
    }
    $bdelb="<a class=ml href=#del onclick=baskodel(~~~". md5($item['id']) ."~~~)><i class=icon-remove></i></a>";
    if ($hidart==1) {
    $itid=strtoupper(substr(md5( str_replace(" ID:", "", str_replace(strtoken ($item['info'], " ID:") , "" , $item['info'])).$artrnd), -7));
    $full_baskets[$ss] .= "<div style=~~~display: block; position: relative;~~~><span id=sp". md5($item['id']) ." style=~~~position: absolute; top: 0px;~~~></span></div<$llid".strtoken(strtoken(str_replace(" ID:","^", $item['info']), "^" ),"*")." $itid</a>".$item['options']."";
    } else {
    $full_baskets[$ss] .= "<div style=~~~display: block; position: relative;~~~><span id=sp". md5($item['id']) ." style=~~~position: absolute; top: 0px;~~~></span></div>$llid".strtoken(str_replace(" ID:","^", $item['info']), "^" )."</a>".$item['options']."";
    }
    if (!isset ($mainbaskets[$ss])) { $mainbaskets[$ss] =""; }
    //$mainbaskets[$ss].="<br><li>$llid".strtoken(str_replace(" ID:","^", $item['info']), "^" )."</a>".$item['options']."</li>";
    if (!isset ($wishzak)) { $wishzak =""; }
    if ($wishzak!="") {
    if ($hidart==1) {
    $wishn=strtoken($item['info'],"*"). " $itid";
    } else {
    $wishn=$item['info'];
    }
    if (!isset($wishm[$wishn])){ $wishm[$wishn]="";}
    if (!preg_match("/^[à-ÿÀ-ßa-zA-Z0-9_\.\,\;\?\&\ \%\(\)\/-]+$/i",$wishm[$wishn])) {  $wishm[$wishn]="";}
    if ($wishm[$wishn]!="") {
    $full_baskets[$ss] .= "<b>".$lang[77].":</b> ". $wishm[$wishn];
    }
    }
   // $full_basket .= "<br><b>".$lang['qty']."</b> (".$out_c[11].") <b>:</b> ";
    $minorder=1; $minorder2=2; $minorderblock=""; $minsht=""; $minupak="";
  if (!isset($out_c[$minorderrow])) { } else { $out_c[$minorderrow]=doubleval($out_c[$minorderrow]);
  if (@$out_c[$minorderrow]>=1) {$minorder=@$out_c[$minorderrow]; $minorder2=(@$out_c[$minorderrow]*2); $minorderblock=" readonly=readonly"; $minsht="<br><font color=$nc3>".str_replace("[pcs]",$out_c[11], str_replace("[num]","$minorder", $lang[1005]))."</font>"; $minupak="<br><font color=$nc3>".str_replace("[pcs]",$out_c[11], str_replace("[num]","$minorder", $lang[1006]))."</font>";}
  }

    $full_baskets[$ss] .="<nobr>".$lang['qty'].":<br><a class=btn href=#minus onclick=bminus(~~~". md5($item['id']) ."~~~,".(doubleval($item['qty'])-$minorder).")><i class=icon-minus></i></a><span class=qty>".$item['qty']."</span><a class=btn href=#plus onclick=bplus(~~~". md5($item['id']) ."~~~,".(doubleval($item['qty'])+$minorder).")><i class=icon-plus></i></a>$bdelb</nobr>$minupak<br>";
   // $full_basket .=$item['qty'];

    //$full_basket .= "";
    //if ($use_weight==1) {$full_basket .= "<br><b>".$lang['weight'].":</b> ".$item['weight']."$kg$sqrp<br>";}
    //if ($use_volume==1) {$full_basket .= "<b>".$lang['volume'].":</b> ".$item['volume']."$vol$sqrp<br>";}

    //$full_basket .= "<b>".$lang['price'].":</b> ".($okr*round($item['price']*$kurs/$okr))." ".$currencies_sign[$_SESSION["user_currency"]]."$sqrp $prski<br>";
    //if ($use_weight==1) {$full_basket .= "<br><b>".$lang['subtotalweight'].":</b> ".$item['subtotalweight']."$kg"; }
    //if ($use_volume==1){$full_basket .= "<br><b>".$lang['subtotalvolume'].":</b> ".$item['subtotalvolume']."$vol"; }}
    if ($item['price']>0) {
    $full_baskets[$ss] .= $item['qty']."".$out_c[11]." x ".($okr*round($item['price']*$kurs/$okr))."".$currencies_sign[$_SESSION["user_currency"]]."<br>";
    $full_baskets[$ss] .= "<b>".$item['qty']*($okr*round($item['price']*$kurs/$okr))."".$currencies_sign[$_SESSION["user_currency"]]."</b>";
    }
    $summa+=$item['qty']*($okr*round($item['price']*$kurs/$okr));



    $totalweight+=$item['subtotalweight'];
    $totalvolume+=$item['subtotalvolume'];
    $full_baskets[$ss] .= "</td></tr><tr><td colspan=4><br></td></tr></table>";


  unset ($out_c);
  $ss+=1;
  }
  $fbsk=array_reverse($full_baskets);
  $ss=0;
  while (list($jbkey,$jbval)=each($fbsk)) {
  $full_basket.=$jbval;
  $ss+=1;
  }
$full_basket.="</div>";
$js_spisok ="var jscheckouts=document.getElementById('jscheckout');
";
//$js_spisok="";
//if ($_SESSION["basksw"]=="on") {
if ($tovarov>0) { $js_spisok .="jscheckouts.innerHTML=\"<img src=$image_path/pix.gif height=10 style='width:96%'><div align=left><img src=$image_path/pix.gif height=1 style='width:96%'>".str_replace("~~~","'",str_replace("\"","", str_replace("'","",  $full_basket)))."</div>\";";}
//} else {
//if ($tovarov>0) { $js_spisok .="jscheckouts.innerHTML=\"<img src=$image_path/pix.gif height=10 width=20><div align=center>".$butonoff."</div>\";";}
//}
if (($del!="")||($minus!="")||($plus!="")) {

$js_spisok .="document.getElementById('scart').innerHTML=\"$summa\";\n";
$js_spisok .="document.getElementById('sosk').innerHTML=\"$summa\";\n";

if ($use_weight==1) {$js_spisok .="document.getElementById('jsves').innerHTML=\"$totalweight\";\n";}
if ($use_volume==1) {$js_spisok .="document.getElementById('jsvolume').innerHTML=\"$totalvolume\";\n";}

$js_spisok .="document.getElementById('jscheck').innerHTML=\"$summa\";";
}
if ($tovarov==0) { $js_spisok .="jscheckouts.innerHTML=\"\";\ndocument.location.href=\"$htpath\""; }
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
