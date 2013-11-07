<?
ini_set('memory_limit', '64M');
$toch=Array();
function toUpper($str) {
$str = strtr($str, "àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ",
"ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß");
return strtoupper($str);
}
if(isset($_GET['map'])) {$map=$_GET['map']; }elseif(isset($_POST['map'])){ $map=$_POST['map']; }else {$map="";}
if (!preg_match('/^[0-9]+$/i',$map)) { $map="";}
$razn=1;
if ($map==2) {$razn=4; }
if(isset($_GET['mid'])) {$mid=$_GET['mid']; }elseif(isset($_POST['mid'])){ $mid=$_POST['mid']; }else {$mid="";}
if (!preg_match('/^[0-9-]+$/i',$mid)) { $mid="";}
if(isset($_GET['id'])) {$id=$_GET['id']; }elseif(isset($_POST['id'])){ $id=$_POST['id']; }else {$id="";}
if (!preg_match('/^[¸¨à-ÿÀ-ßa-zA-Z0-9_\,\.\?\&\#\;\ \%\(\)\/-]+$/i',$id)) { $id="";}
$fold="."; require ("./templates/lang.inc");
$speek=$language;
require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require ("./modules/translit.php");
$basedir="./";
$statuses=Array();
$statusfile="./templates/$template/$speek/status.inc";
if (file_exists($statusfile)) {
$statuses=file($statusfile);
}
$file="images/map".$map.".png";
$image = $basedir."".$file;
if (!file_exists($image)) { echo "No map found!"; exit;}
$imagesz = @getimagesize($image);

$pin1="images/pinrr.png"; //red pin
$pin2="images/pingg.png"; //green pin
$pin3="images/pinoo.png"; //orange pin
$city="images/city.png"; //city pin
$i20=20;
$i21=21;
$ncc=0;
$cc=file("./templates/$template/$speek/custom_cart.inc");

$dateformat=str_replace("y", "Y", str_replace("dd", "d",str_replace("mm", "m",str_replace("yy", "y", str_replace("yy", "y", $ewc_dateformat)))));

while(list($kc,$kv)=each($cc)) {
if (trim ($kv!="")) {
$out=explode("|", $kv);
if (isset ($out[3])) {
if ($out[3]=="location") {
$ncc=17+$kc;
}
}
}
}

$im1 = @imagecreatefrompng($basedir."".$pin1);
$im2 = @imagecreatefrompng($basedir."".$pin2);
$im4 = @imagecreatefrompng($basedir."".$pin3);
$im3 = @imagecreatefrompng($basedir."".$city);

$ext = substr($image, -3);

if (!$im = @imagecreatetruecolor($imagesz[0], $imagesz[1])) {
echo "Error opening $image!"; exit;
}
$transparent = imagecolorallocatealpha($im, 0, 0, 0, 127);
imagefill($im, 0, 0, $transparent);
imagesavealpha($im, true);

imageAlphaBlending($im1,1); //pin1
imageAlphaBlending($im2,1); //pin2
imageAlphaBlending($im3,1); //pin
imageAlphaBlending($im4,1); //pin
imageAlphaBlending($im,1); //map

imagesavealpha($im1,1);
imagesavealpha($im2,1);
imagesavealpha($im3,1);
imagesavealpha($im4,1);
imagesavealpha($im,1);
$x=imagesx($im);
$y=imagesy($im);
$white=imagecolorallocate($im, 0xff, 0xff, 0xff);
$grey=imagecolorallocate($im, 0xff, 0xff, 0xff);
$fontsize=8;
imagefilledrectangle( $im, 0, $y/2, $x, $y/2, $grey );
imagefilledrectangle( $im, $x/2-21*$razn, 0, $x/2-21*$razn, $y, $grey );
imagefilledrectangle( $im, $x-21*$razn, 0, $x-21*$razn, $y, $grey );
//imageTtfText($im, $fontsize-1, 0, $x/2-21+2, 10, $grey,  "./admin/arial.ttf", "0'");
imagestring($im, 2, $x/2-21*$razn+2, 0, "0'", $grey);
//imageTtfText($im, $fontsize-1, 0, $x-21+2, 10, $grey,  "./admin/arial.ttf", "180'");
imagestring($im, 2, $x-21*$razn+2, 0, "180'", $grey);

//Âëàäèâîñòîê 43° 7’ N	131° 55
//RUSSIA (Murmansk dst)	68° 58’ N	33° 05`’ E
//Moscow dst	55° 46’ N	37° 40’ E
//Íîâîðîññèéñê -44° 39?N, 37° 52? E.
//Íàõîäêà 42° 47? N , 132° 52? E
//Ïðèìîðñê 60° 20.6?N , 28° 43.0?E
//Íîâîðîññèéñê  -44° 39?N, 37° 52? E.
//rotterdam 51°55’26.71? N, 4°28’52.93? E
$h=imagesy($im3);
$w=imagesx($im3);

//ports

//imagecopy($im, $im3, $x/2+131.55*$x/360-2-21, $y/2-43.7*$y/180-2, 0, 0, $w, $h);
//imagecopy($im, $im3, $x/2+33.05*$x/360-2-21, $y/2-68.58*$y/180-2, 0, 0, $w, $h);
imagecopy($im, $im3, $x/2+37.4*$x/360-2-21*$razn, $y/2-55.46*$y/180-2, 0, 0, $w, $h);

//imagecopy($im, $im3, $x/2+132.52*$x/360-2-21, $y/2-42.47*$y/180-2, 0, 0, $w, $h);
imagecopy($im, $im3, $x/2+30*$x/360-2-21*$razn, $y/2-60*$y/180-2, 0, 0, $w, $h); //Ïèòåð
//imagecopy($im, $im3, $x/2+37.52*$x/360-2-21, $y/2-44.39*$y/180-2, 0, 0, $w, $h);
//imagecopy($im, $im3, $x/2+4.28*$x/360-2-21, $y/2-51.55*$y/180-2, 0, 0, $w, $h);
//imageTtfText($im, $fontsize, 0, $x/2+37.4*$x/360-2-10, $y/2-55.46*$y/180+4, $grey, "./admin/arial.ttf", "Moscow");
imagestring($im, 2, $x/2+37.4*$x/360-2+10-21*$razn, $y/2-55.46*$y/180+4-10, "Moscow", $grey);
//imageTtfText($im, $fontsize, 0, $x/2-21+36, $y-10, $grey, "./admin/arial.ttf", "$htpath");
imagestring($im, 2, $x/2-21*$razn+36, $y-10-10, "$htpath", $grey);


//green
$tmp=file($base_file);
unset($kc,$kv,$out,$out2);

$xx=mt_rand(0,$x);
$yy=mt_rand(0,$y);
while(list($key,$val)=each($tmp)) {
if (trim($val)!="") {
$o=explode("|", $val);
if ($o[1]==$lang[418]){ continue;}
$unifid=md5(@$o[3]." ID:".@$o[6]);
$statusfile="$base_loc/status/".substr($unifid,0,2)."/".$unifid."/status.txt";
$curstatus="";
if (file_exists($statusfile)) {
$sp=file($statusfile);
$curstatus=trim($sp[0]);
}
//echo "$curstatus $statuses[0] $statuses[1] $statuses[2]<br>";
$proceed=1;
//echo "$key ". $id . " ". $o[6] ."<br>";
if ($id!="") { if($id!=$o[6]) {$proceed=0; } }
if ($proceed==1) {
$shd=0;
if ($ncc!=0) {
$tt=explode("<br>", $o[$ncc]);
unset($shirota,$dolgota,$dp,$day,$month,$year);
if (trim($o[$ncc])!="") {$shd=1; }
while(list($kc,$kv)=each($tt)) {
if (trim ($kv)!="") {
$out2=explode(";",$kv);
list($day,$month,$year) = explode(substr($dateformat,1,1),$out2[0]);
$unixtime=mktime(0, 0, 1, (int)$month, (int)$day, (int)$year);
$shirota[$unixtime]=floatval(str_replace(",",".", trim($out2[1])));
$dolgota[$unixtime]=floatval(str_replace(",",".", trim($out2[2])));
}
}
if ($shd==0) {
$shirota[(time()-1)]=-1;
$dolgota[(time()-1)]=-1;
$shirota[(time()+86400)]=1;
$dolgota[(time()+86400)]=1;
}
@ksort ($shirota);
$sh=-1000;
$do=-1000;
$ls=-1000;
$ld=-1000;
$dp="";
unset($kc,$kv,$tt);
$ttime=time();
//echo $o[3]."<br>";
$line_color = ImageColorAllocate ($im, 233, 14, 91);
$strt=0;
while(list($kc,$kv)=each($shirota)) {
if ($id!="") {
if ($strt==0) {$sty=$shirota[$kc]; $stx=$dolgota[$kc];
//imagecopy($im, $im3, $x/2+$stx*$x/360-2-21, $y/2-$sty*$y/180-2, 0, 0, $w, $h);
} else {
$y11=$shirota[$kc];
$x11=$dolgota[$kc];
//echo "$stx , $sty -&gt; $x11 , $y11<br>";
imageline ($im,$x/2+$stx*$x/360-21*$razn, $y/2-$sty*$y/180, $x/2+$x11*$x/360-21*$razn, $y/2-$y11*$y/180, $line_color);
imageline ($im,$x/2+$stx*$x/360-21*$razn+1, $y/2-$sty*$y/180, $x/2+$x11*$x/360-21*$razn+1, $y/2-$y11*$y/180, $line_color);
$stx=$x11; $sty=$y11;
}
$strt++;
}
//echo "$ttime>$kc ? $shirota[$kc] $dolgota[$kc]<br>";
if ($ttime>$kc) {
$o[$i20]=$kv;
$o[$i21]=$dolgota[$kc];
}
$ls=$kv;
$ld=$dolgota[$kc];
$dp=date($dateformat,$kc);

}
}
//echo "Òåêóùåå ïîëîæåíèå: $o[$i20] $o[$i21]<br>Ïîðò ïðèáûòèÿ: $ls $ld<br>Äàòà ïðèáûòèÿ $dateformat: $dp<br><br>";
$o[3]= substr(
str_replace("  "," ",
str_replace("  "," ",
str_replace("_"," ",
str_replace(","," ",
preg_replace("/[^a-zA-Z0-9-\. ]/","",
$o[3]))))),0,45);

$h=imagesy($im2);
$w=imagesx($im2);
$rand=0;
$indx=$o[$i20]."_".$o[$i21];
$sdvig=10; //pixels
if (!isset($toch[$indx])) { $toch[$indx]=0; } else { $toch[$indx]+=1;  }
$sdv=$sdvig*$toch[$indx];
//if ($id!="") { $sdv=0; }

if ($mid!="") {
if ($curstatus==trim($statuses[2])) {

$rand=0;

if (trim($o[$i20])!="") {

imagecopy($im, $im1, $rand+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h);
if ($o[$i21]<165) { imagecopy($im, $im1, $rand+$x+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h); }
if ($o[$i21]>165) { imagecopy($im, $im1, $rand+$x/2+$o[$i21]*$x/360-7-21-$x, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h); }

//$colofont="af0f0f";
$colofont="000000";
$fontsize=8;
$rrr= (hexdec ("0x" . substr($colofont,0,2)));
$ggg=(hexdec ("0x" . substr($colofont,2,2)));
$bbb=(hexdec ("0x" . substr($colofont,4,2)));
$fontclr=imagecolorallocate($im, $rrr, $ggg, $bbb);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+8, $y/2-$o[$i20]*$y/180, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+6, $y/2-$o[$i20]*$y/180, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+7, $y/2-$o[$i20]*$y/180-1, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+7, $y/2-$o[$i20]*$y/180+1, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);

if ($o[$i21]<165) {
//imageTtfText($im, $fontsize, 0, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
}
if ($o[$i21]>165) {
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
 }
}
}

if ($curstatus==trim($statuses[1])) {
$rand=rand(0,0);
//$rand=0;
if (trim($o[$i20])!="") {
imagecopy($im, $im4, $rand+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h);
if ($o[$i21]<165) { imagecopy($im, $im4, $rand+$x+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h); }
if ($o[$i21]>165) { imagecopy($im, $im4, $rand+$x/2+$o[$i21]*$x/360-7-21-$x, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h); }

//$colofont="ef6633";
$colofont="000000";
$fontsize=8;
$rrr= (hexdec ("0x" . substr($colofont,0,2)));
$ggg=(hexdec ("0x" . substr($colofont,2,2)));
$bbb=(hexdec ("0x" . substr($colofont,4,2)));
$fontclr=imagecolorallocate($im, $rrr, $ggg, $bbb);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+8, $y/2-$o[$i20]*$y/180, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+6, $y/2-$o[$i20]*$y/180, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+7, $y/2-$o[$i20]*$y/180-1, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+7, $y/2-$o[$i20]*$y/180+1, $white,  "arial.ttf",$o[3]);

//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf",$o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
if ($o[$i21]<165) {
//imageTtfText($im, $fontsize, 0, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
}
if ($o[$i21]>165) {
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
 }

}
}
if (($curstatus==trim($statuses[0]))||($curstatus=="")) {
$rand=rand(0,0);
//$rand=0;
if (trim($o[$i20])!="") {
//echo $o[$i20]." ".$o[$i21]."<br>";
//$rand=rand(-1,1);
$rand=0;
imagecopy($im, $im2, $rand+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h);
if ($o[$i21]<165) { imagecopy($im, $im2, $rand+$x+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h); }
if ($o[$i21]>165) { imagecopy($im, $im2, $rand+$x/2+$o[$i21]*$x/360-7-21-$x, $rand+$y/2-$o[$i20]*$y/180-$h+2-$sdv, 0, 0, $w, $h); }

//$colofont="1f5b1f";
$colofont="000000";
$rrr= (hexdec ("0x" . substr($colofont,0,2)));
$ggg=(hexdec ("0x" . substr($colofont,2,2)));
$bbb=(hexdec ("0x" . substr($colofont,4,2)));
$fontclr=imagecolorallocate($im, $rrr, $ggg, $bbb);
$o[3]=str_replace("\"","",$o[3]);
$o[3]=str_replace("quot","",$o[3]);
$o[3]=str_replace("/","",$o[3]);
$o[3]=str_replace("&nbsp;"," ",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+8, $y/2-$o[$i20]*$y/180, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+6, $y/2-$o[$i20]*$y/180, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+7, $y/2-$o[$i20]*$y/180-1, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $x/2+$o[$i21]*$x/360+7, $y/2-$o[$i20]*$y/180+1, $white,  "arial.ttf",$o[3]);
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
if ($o[$i21]<165) {
//imageTtfText($im, $fontsize, 0, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf",$o[3]);
imagestring($im, 2, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
}
if ($o[$i21]>165) {
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf",$o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180-10-$sdv, $o[3],  $fontclr);
}

}
}
}
}
}
}

$last_modified = gmdate('D, d M Y H:i:00 T', filemtime ($image));
//imageTtfText($im, 7, 0, 4, 10, $grey,  "./admin/arial.ttf", date("d/m/Y H:i", time()));
imagestring($im, 2, 4, 10-10, date("d/m/Y H:i", time()), $grey);

header("Last-Modified: $last_modified");
if (strtolower($ext) == "gif") {
header("Content-Type: image/gif");
imagegif($im);
}
else if(strtolower($ext) == "jpg") {
header("Content-Type: image/jpeg");
imagejpeg($im,NULL,99);
} else if(strtolower($ext) == "png") {
header("Content-Type: image/png");
imagepng($im,NULL,9);
}

imagedestroy($im);
imagedestroy($im1);
imagedestroy($im2);
imagedestroy($im3);
imagedestroy($im4);
?>
