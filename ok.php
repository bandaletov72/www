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
$error="";
$valid=0;
$mancatid="";
unset($details);
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");

function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}


$rets=0;
$fold="."; require ("./templates/lang.inc");
if(isset($_GET['mnogo'])) $mnogo=$_GET['mnogo']; elseif(isset($_POST['mnogo'])) $mnogo=$_POST['mnogo']; else $mnogo=0;
if (!preg_match("/^[0-9_]+$/",$mnogo)) { $mnogo=0;}
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek']; else $speek=$language;
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$speek)) { $speek=$language;}

if(isset($_GET['qty'])) $qty=$_GET['qty']; elseif(isset($_POST['qty'])) $qty=$_POST['qty']; else $qty=0;
if (!preg_match("/^[0-9_]+$/",$qty)) { $qty=0;}
if(isset($_GET['addqty'])) $addqty=$_GET['addqty']; elseif(isset($_POST['addqty'])) $addqty=$_POST['addqty']; else $addqty=0;
if (!preg_match("/^[0-9_]+$/",$addqty)) { $addqty=0;}

if(isset($_GET['unifid'])) $unifid=$_GET['unifid']; elseif(isset($_POST['unifid'])) $unifid=$_POST['unifid']; else $unifid="";
if (!preg_match("/^[a-z0-9_]+$/",$unifid)) { $unifid="";}
/* Usage :
 *
 * require_once('/path/to/gd-gradient-fill.php');
 * $image = new gd_gradient_fill($width,$height,$direction,$startcolor,$endcolor,$step);
 */


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
require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("./templates/$template/$speek/config.inc");
require ("./templates/$template/css.inc");
require ("./modules/functions.php");

if(isset($_GET['catid'])) $catid=$_GET['catid']; elseif(isset($_POST['catid'])) $catid=$_POST['catid']; else $catid="_";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$catid)) { $catid="_";}
$valid=0;
$options="";

$optio=Array();
$op_mass=Array();
$op_line="";
$op_num="";
$optionreg=Array();
$optiontitle=Array();

$optfile="./templates/$template/$speek/custom_options.inc";
if (@file_exists($optfile)) {
$optionmass=file($optfile);
while (list ($op_num, $op_line) = each ($optionmass)) {
$op_mass=explode("|",$op_line);
if (isset($op_mass[0],$op_mass[1],$op_mass[2],$op_mass[3])) {
$optiontitle[$op_num]=$op_mass[2];
$optio[$op_num]="<tr><td><b>".$op_mass[1]."</b></td><td><select name=option"."[".$op_num."]>\n<option value=\""."\">----</option>\n";
while (list ($ops_num, $ops_line) = each ($op_mass)) {
if ($ops_line!="\n") {
$optionreg[$op_num."_".($ops_num-2)]=$ops_line;
$ops_plus="";
$opnazv=strtoken($ops_line,"^");
$oplus=str_replace("^","",str_replace($opnazv,"", $ops_line));
$optionprice[$op_num."_".($ops_num-2)]="";
if ($oplus!="") {
if (preg_match("/\%/",$oplus)) {
$optionprice[$op_num."_".($ops_num-2)]="$oplus";
if (preg_match("/-/",$oplus)) {
$ops_plus=" ".$oplus;
} else {
$ops_plus=" +".$oplus;
}
} else {
$optionprice[$op_num."_".($ops_num-2)]="".$okr*(round(($oplus*$kurs)/$okr));
if (preg_match("/-/",$oplus)) {
$ops_plus=" ".$okr*(round(($oplus*$kurs)/$okr)).$valut;
} else {
$ops_plus=" +".$okr*(round(($oplus*$kurs)/$okr)).$valut;
}

}
$optionreg[$op_num."_".($ops_num-2)]=$opnazv.$ops_plus;
} else {
$optionreg[$op_num."_".($ops_num-2)]=$ops_line;
}
if ($ops_num>2){
$optio[$op_num].="<option value=\"".($ops_num-2)."\">".$opnazv."$ops_plus</option>\n";
}
}
}
$optio[$op_num].="</select></td></tr>\n";
}
unset($op_mass);
}
}
unset($op_num,$op_line,$optionmass);



$fcontentsa = file("$base_loc/catid.txt");

$r="";
$sub="";
$st=0; $foundcat=0;
while (list ($line_num, $line) = each ($fcontentsa)) {
$out=explode("|",$line);
$podstava[$out[1]."|".$out[2]."|"]=$out[0];
$podstavas[$out[1]."|".$out[2]."|"]=$out[4];
if ($out[0]=="$catid"): $r=$out[1]; $sub=$out[2]; $foundcat=1; endif;
$st+=1;
}
if ($foundcat==0) {$catid=0; }
$podstava["||"]="_";
  function hex2rgb($color) {
        $color = str_replace('#','',$color);
        $s = strlen($color) / 3;
        $rgb[]=hexdec(str_repeat(substr($color,0,$s),2/$s));
        $rgb[]=hexdec(str_repeat(substr($color,$s,$s),2/$s));
        $rgb[]=hexdec(str_repeat(substr($color,2*$s,$s),2/$s));
        return $rgb;
    }
class gd_buy {

     // #ff00ff -> array(255,0,255) or #f0f -> array(255,0,255)

    // Constructor. Creates, fills and returns an image
    function gd_buy($w,$qty,$col,$back,$rret) {
        $this->buy = "$w";
        $this->pcs = doubleval($qty);
        $cols = hex2rgb($col);
        $backs = hex2rgb($back);

        // Attempt to create a blank image in true colors, or a new palette based image if this fails
        if (function_exists('imagecreatetruecolor')) {
            $this->image = imagecreatetruecolor(78,12);
        } elseif (function_exists('imagecreate')) {            $this->image = imagecreate(78,12);
        } else {
            die('Unable to create an image');
        }
        $im=$this->image;

        $bg = ImageColorAllocate($im, $backs[0], $backs[1],$backs[2]);
        ImageFilledRectangle ($im,0,0,100,20,$bg);
        $text_color = ImageColorAllocate( $im, $cols[0], $cols[1],$cols[2]);
        ImageString( $im, 5, 30, -2, "OK", $text_color );

        $this->display($this->image);

        // Return it
        return $this->image;
    }


    // Displays the image with a portable function that works with any file type
    // depending on your server software configuration
    function display ($im) {
        if (function_exists("imagejpeg")) {
        header("Content-type: image/jpeg");
            imagejpeg($im);

        }
        elseif (function_exists("imagegif")) {
        header("Content-type: image/gif");
            imagegif($im);
        }
        elseif (function_exists("imagepng")) {
            header("Content-type: image/png");
            imagepng($im);
        }

        elseif (function_exists("imagewbmp")) {
            header("Content-type: image/vnd.wap.wbmp");
            imagewbmp($im);
        } else {
            die("Doh ! No graphical functions on this server ?");
        }
        return true;
    }



}



require("./modules/webcart.php");

$oldanguage=$language;

session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

$cart =& $_SESSION['cart'];
if(!is_object($cart)){
$cart = new webcart();
}

if (($qty!=0)&&($unifid!="")){
if($addqty>0) {$qty=$addqty;} else { $qty=1;}

$add_it=Array();
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


$login="";
if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")){
$valid=$cart->authorize("$login","$password"); SetCookie("user_name", substr($login, 0, 40), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']); SetCookie("user_pass", md5(substr($artrnd.$password.$secret_salt, 0, 128)), time()+1003600,$cookiedir,$_SERVER['SERVER_NAME']);

}

require "./modules/unicart.php";


$add_it[0]=$fid;
//$out_cart=get_info($add_it);

//$out_c=explode("|",$out_cart[$fid]);
$out_c=$tmpmsf;
@$curcur=substr(@$out_c[12],1,3);

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
//var_dump($out_c);
//OPT
$didx=$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$out_c[$ddidx])/$okr)); $price=@$out_c[$ddidx]*$kurss;
//echo $didx." ".$price;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
//$price=$okr*(round(($price*$defkurs)/$okr));
if(substr($details[7],0,3)!="OPT") {
if (($podstavas["$r|$sub|"]!="")||(preg_match("/\%/", @$out_c[8])==TRUE)) {
$strtoma=Array();
$strtoma=explode("%",@$out_c[8]);
$strto=@$strtoma[0];
unset($strtoma);
 if ((preg_match("/\%/", @$out_c[8])==TRUE)&&(doubleval($strto)>0)) {
 	$price=$price-$price*(doubleval($strto))/100;
 	} else {$strto=doubleval($podstavas["$r|$sub|"]);  $price=$price-$price*((double)$podstavas["$r|$sub|"]/100);
 	}
    }
if (($valid=="1")&&($details[7]=="VIP")): $price=$price-$price*$vipprocent; endif;
}

$optius2="";
if (!isset($option)) {$option=Array();}
if (is_array($option)) {
while (list ($o_num, $o_line) = each ($option)) {
$optius2.="&option".rawurlencode("[").$o_num.rawurlencode("]")."=$o_line";
if (!isset($option[$o_num])){$option[$o_num]="";}
if (!preg_match("/^[0-9]+$/",$option[$o_num])) { $option[$o_num]="";}
$option[$o_num]=doubleval(substr($option[$o_num],0,2));
if ($option[$o_num]>0) {
if ((isset($optiontitle[$o_num]))&&(isset($optionreg[$o_num."_".$o_line]))) {
if ($option[$o_num]!=""){
$options.="<b>".$optiontitle[$o_num]."</b> ".$optionreg[$o_num."_".$o_line]."<br>";
if ((isset($optionprice[$o_num."_".$o_line]))&&(@$optionprice[$o_num."_".$o_line])!="") {
if (preg_match("/\%/",$optionprice[$o_num."_".$o_line])) { $optionprice[$o_num."_".$o_line]=$okr*(round((($price*doubleval($optionprice[$o_num."_".$o_line]))/100)/$okr)); }
$price+=$optionprice[$o_num."_".$o_line];
}
}
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
@$out_c[9]=str_replace("<img ", "<img align=\"left\" title=\"".$out_c[3]."\" $wh ", @$out_c[9]);
//@$out_c[9]=str_replace("border=0", "border=1 hspace=3 style=\"border: 1 solid ".$style['nav_col1']."\"", @$out_c[9]);
$out_c[9]=str_replace("width= height= ", "", $out_c[9]);
if (substr(@$out_c[12],0,1)=="0") {
$catid=""; $error.=$lang['file'].": ".$lang[222]." E7<br>";
} else {
$_SESSION["user_basket"]="ok";
if (!isset($out_c[$netweight])) {$out_c[$netweight]=$def_weight;}
if ($out_c[$netweight]=="") {$out_c[$netweight]=$def_weight;}
if ($out_c[$netweight]=="0") {$out_c[$netweight]=$def_weight;}
if ($out_c[$netweight]==0) {$out_c[$netweight]=$def_weight;}
if (!isset($out_c[$box_volume])) {$out_c[$box_volume]=0;}
if ($out_c[$box_volume]=="") {$out_c[$box_volume]=0;}
if ($out_c[$box_volume]=="0") {$out_c[$box_volume]=0;}
if ($out_c[$box_volume]==0) {$out_c[$box_volume]=0;}
$cart->add_item($unifid."|".$options,$qty,($price/$kurss),@$out_c[3]." ID:".@$out_c[6], $fid, $options, $optius2, $out_c[9], $okr*(round(($optkurs*$out_c[5])/$okr)), substr(@$out_c[12],1,3) , $out_c[$netweight], trim(implode("|",$tmpmsf)),$speek,$out_c[$box_volume]);
unset($out_c,$tmpmsf,$add_it);

}
}

if (isset($_GET['unifid'])&&(isset($_GET['qty']))) {
$image = new gd_buy($_GET['unifid'],$_GET['qty'],$nc5,$nc0,$rets);
}
//header("Content-type: image/jpeg");
//imagejpeg($image);

?>
