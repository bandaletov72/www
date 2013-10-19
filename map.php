<?
function toUpper($str) {
$str = strtr($str, "абвгдеежзиклмнопрстуфхцчшщьъыэюя",
"АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЪЫЭЮЯ");
return strtoupper($str);
}
if(isset($_GET['id'])) {$id=$_GET['id']; }elseif(isset($_POST['id'])){ $id=$_POST['id']; }else {$id="";}
if (!preg_match('/^[ёЁа-яА-Яa-zA-Z0-9_\,\.\?\&\#\;\ \%\(\)\/-]+$/i',$id)) { $id="";}
$fold="."; require ("./templates/lang.inc");
$speek=$language;
require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require ("./modules/translit.php");
$basedir="./";

$file="images/map.png";
$image = $basedir."".$file;

$pin1="images/pin.png"; //red pin
$pin2="images/pin2.png"; //green pin
$pin3="images/pin3.png"; //orange pin
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

if (strtolower($ext) == "gif") {
if (!$im = @imagecreatefromgif($image)) {
echo "Error opening $image!"; exit;
}
} else if(strtolower($ext) == "jpg") {
if (!$im = @imagecreatefromjpeg($image)) {
echo "Error opening $image!"; exit;
}
} else if(strtolower($ext) == "png") {
if (!$im = @imagecreatefrompng($image)) {
echo "Error opening $image!"; exit;
}
} else {
die;
}

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
imagefilledrectangle( $im, $x/2-21, 0, $x/2-21, $y, $grey );
imagefilledrectangle( $im, $x-21, 0, $x-21, $y, $grey );
//imageTtfText($im, $fontsize-1, 0, $x/2-21+2, 10, $grey,  "./admin/arial.ttf", "0'");
imagestring($im, 2, $x/2-21+2, 10-10, "0'", $grey);
//imageTtfText($im, $fontsize-1, 0, $x-21+2, 10, $grey,  "./admin/arial.ttf", "180'");
imagestring($im, 2, $x-21+2, 10-10, "180'", $grey);

//Владивосток 43° 7’ N	131° 55
//RUSSIA (Murmansk dst)	68° 58’ N	33° 05`’ E
//Moscow dst	55° 46’ N	37° 40’ E
//Новороссийск -44° 39?N, 37° 52? E.
//Находка 42° 47? N , 132° 52? E
//Приморск 60° 20.6?N , 28° 43.0?E
//Новороссийск  -44° 39?N, 37° 52? E.
//rotterdam 51°55’26.71? N, 4°28’52.93? E
$h=imagesy($im3);
$w=imagesx($im3);

//ports

//imagecopy($im, $im3, $x/2+131.55*$x/360-2-21, $y/2-43.7*$y/180-2, 0, 0, $w, $h);
//imagecopy($im, $im3, $x/2+33.05*$x/360-2-21, $y/2-68.58*$y/180-2, 0, 0, $w, $h);
imagecopy($im, $im3, $x/2+37.4*$x/360-2-21, $y/2-55.46*$y/180-2, 0, 0, $w, $h);

//imagecopy($im, $im3, $x/2+132.52*$x/360-2-21, $y/2-42.47*$y/180-2, 0, 0, $w, $h);
imagecopy($im, $im3, $x/2+30*$x/360-2-21, $y/2-60*$y/180-2, 0, 0, $w, $h); //Питер
//imagecopy($im, $im3, $x/2+37.52*$x/360-2-21, $y/2-44.39*$y/180-2, 0, 0, $w, $h);
//imagecopy($im, $im3, $x/2+4.28*$x/360-2-21, $y/2-51.55*$y/180-2, 0, 0, $w, $h);
//imageTtfText($im, $fontsize, 0, $x/2+37.4*$x/360-2-10, $y/2-55.46*$y/180+4, $grey, "./admin/arial.ttf", "Moscow");
imagestring($im, 2, $x/2+37.4*$x/360-2-10, $y/2-55.46*$y/180+4-10, "Moscow", $grey);
//imageTtfText($im, $fontsize, 0, $x/2-21+36, $y-10, $grey, "./admin/arial.ttf", "$htpath");
imagestring($im, 2, $x/2-21+36, $y-10-10, "$htpath", $grey);


//green
$tmp=file($base_file);
unset($kc,$kv,$out,$out2);

$xx=mt_rand(0,$x);
$yy=mt_rand(0,$y);
while(list($key,$val)=each($tmp)) {
if (trim($val)!="") {
$o=explode("|", $val);
$proceed=1;
//echo "$key ". $id . " ". $o[6] ."<br>";
if ($id!="") { if($id!=$o[6]) {$proceed=0; } }
if ($proceed==1) {
if ($ncc!=0) {
$tt=explode("<br>", $o[$ncc]);
unset($shirota,$dolgota,$dp,$day,$month,$year);
while(list($kc,$kv)=each($tt)) {
if (trim ($kv)!="") {
$out2=explode(";",$kv);
list($day,$month,$year) = explode(substr($dateformat,1,1),$out2[0]);
$unixtime=mktime(0, 0, 1, (int)$month, (int)$day, (int)$year);
$shirota[$unixtime]=(int)trim($out2[1]);
$dolgota[$unixtime]=(int)trim($out2[2]);
}
}
ksort ($shirota);
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
imageline ($im,$x/2+$stx*$x/360-21, $y/2-$sty*$y/180, $x/2+$x11*$x/360-21, $y/2-$y11*$y/180, $line_color);
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
//echo "Текущее положение: $o[$i20] $o[$i21]<br>Порт прибытия: $ls $ld<br>Дата прибытия $dateformat: $dp<br><br>";
$o[3]= substr(
str_replace("  "," ",
str_replace("  "," ",
str_replace("_"," ",
str_replace(","," ",
preg_replace("/[^a-zA-Z0-9-\. ]/","",
$o[3]))))),0,45);

$h=imagesy($im2);
$w=imagesx($im2);


if ($o[1]=="Проданные") {
//$rand=rand(-1,1);
$rand=0;

if (trim($o[$i20])!="") {

imagecopy($im, $im1, $rand+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h);
if ($o[$i21]<165) { imagecopy($im, $im1, $rand+$x+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h); }
if ($o[$i21]>165) { imagecopy($im, $im1, $rand+$x/2+$o[$i21]*$x/360-7-21-$x, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h); }

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
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);

if ($o[$i21]<165) {
//imageTtfText($im, $fontsize, 0, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
}
if ($o[$i21]>165) {
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
 }
}
}

if ($o[1]=="В резерве") {
//$rand=rand(-1,1);
$rand=0;
if (trim($o[$i20])!="") {
imagecopy($im, $im4, $rand+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h);
if ($o[$i21]<165) { imagecopy($im, $im4, $rand+$x+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h); }
if ($o[$i21]>165) { imagecopy($im, $im4, $rand+$x/2+$o[$i21]*$x/360-7-21-$x, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h); }

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
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
if ($o[$i21]<165) {
//imageTtfText($im, $fontsize, 0, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
}
if ($o[$i21]>165) {
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf", $o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
 }

}
}
if ($o[1]=="Свободные к продаже") {
//$rand=rand(-1,1);
$rand=0;
if (trim($o[$i20])!="") {
//echo $o[$i20]." ".$o[$i21]."<br>";
//$rand=rand(-1,1);
$rand=0;
imagecopy($im, $im2, $rand+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h);
if ($o[$i21]<165) { imagecopy($im, $im2, $rand+$x+$x/2+$o[$i21]*$x/360-7-21, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h); }
if ($o[$i21]>165) { imagecopy($im, $im2, $rand+$x/2+$o[$i21]*$x/360-7-21-$x, $rand+$y/2-$o[$i20]*$y/180-$h+2, 0, 0, $w, $h); }

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
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
if ($o[$i21]<165) {
//imageTtfText($im, $fontsize, 0, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf",$o[3]);
imagestring($im, 2, $rand+$x+$x/2+$o[$i21]*$x/360+7-28, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
}
if ($o[$i21]>165) {
//imageTtfText($im, $fontsize, 0, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180, $fontclr,  "./admin/arial.ttf",$o[3]);
imagestring($im, 2, $rand+$x/2+$o[$i21]*$x/360+7-28-$x, $rand+$y/2-$o[$i20]*$y/180-10, $o[3],  $fontclr);
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
