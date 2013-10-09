<?php
set_time_limit(0);
function win2uni($s)
  {
    $s = convert_cyr_string($s,'w','i'); // ïðåîáðàçîâàíèå win1251 -> iso8859-5
    // ïðåîáðàçîâàíèå iso8859-5 -> unicode:
    for ($result='', $i=0; $i<strlen($s); $i++) {
      $charcode = ord($s[$i]);
      $result .= ($charcode>175)?"&#".(1040+($charcode-176)).";":$s[$i];
    }
    return $result;
  }
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÛÝÞß",
"àáâãäååæçèêëìíîïðñòóôõö÷øùüúûýþÿ");
   return strtolower($str);
}
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
$fold="..";
$rrating="";

$sortas=0;
$fold=".."; require ("../templates/lang.inc");

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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("../templates/$template/$speek/config.inc");
require ("../modules/translit.php");
require ("../templates/$template/css.inc");
echo "<!DOCTYPE html><html>
<TITLE>WATERMARK</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body>";
echo "$css<table border=0 width=100%><tr><td align=center><h1> ".$lang[853]."</h1>";
if ((!@$ok) || (@$ok=="")){ $ok=0; }
if ((!@$only_new) || (@$only_new=="")){ $only_new=1; }
if ((!@$watermark) || (@$watermark=="")){ $watermark=""; }
if (!preg_match("/^[0-9_]+$/",$ok)) { $ok=0;}
if (!preg_match("/^[0-9_]+$/",$only_new)) { $only_new=1;}
if ((!@$fontsize) || (@$fontsize=="")){ $fontsize=9; }
if ((!@$fontcolor) || (@$fontcolor=="")){ $fontcolor="000000"; }
if ((!@$bgcolor) || (@$bgcolor=="")){ $bgcolor="ffffff"; }
if (!preg_match("/^[0-9\.]+$/i",$fontsize)) { $fontsize=9;}
if (!preg_match("/^[a-zA-Z0-9\#]+$/i",$fontcolor)) { $fontcolor="000000";}
if (!preg_match("/^[a-zA-Z0-9\#-]+$/i",$bgcolor)) { $bgcolor="ffffff";}
if ((!@$_POST['ypos']) || (@$_POST['ypos']=="")){ $_POST['ypos']="bottom"; }
if ((!@$_POST['xpos']) || (@$_POST['xpos']=="")){ $_POST['xpos']="right"; }
if ((!@$_POST['fsize']) || (@$_POST['fsize']=="")){ $_POST['fsize']=2; }
if ((!@$_POST['fill']) || (@$_POST['fill']=="")){ $_POST['fill']="no"; }
if ((!@$_POST['sharp']) || (@$_POST['sharp']=="")){ $_POST['sharp']="no"; }
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_POST['ypos'])) { $_POST['ypos']="bottom";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_POST['xpos'])) { $_POST['xpos']="right";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_POST['fill'])) { $_POST['fill']="no";}
if (!preg_match("/^[a-zA-Z0-9#-]+$/i",$_POST['sharp'])) { $_POST['sharp']="no";}
if (!preg_match("/^[0-9\.,]+$/i",$_POST['fsize'])) { $_POST['fsize']=2;}
if (extension_loaded('iconv')) {$watermark=iconv($codepage, "UTF-8", $watermark);} else {
    if (extension_loaded('mb_string')) {
    $watermark=mb_convert_encoding($watermark, $codepage, "UTF-8");
    }
    }
if(!function_exists('imageconvolution')){
function imageconvolution($src, $filter, $filter_div, $offset){
    if ($src==NULL) {
        return 0;
    }

    $sx = imagesx($src);
    $sy = imagesy($src);
    $srcback = ImageCreateTrueColor ($sx, $sy);
    ImageCopy($srcback, $src,0,0,0,0,$sx,$sy);

    if($srcback==NULL){
        return 0;
    }

    for ($y=0; $y<$sy; ++$y){
        for($x=0; $x<$sx; ++$x){
            $new_r = $new_g = $new_b = 0;
            $alpha = imagecolorat($srcback, $pxl[0], $pxl[1]);
            $new_a = $alpha >> 24;

            for ($j=0; $j<3; ++$j) {
                $yv = min(max($y - 1 + $j, 0), $sy - 1);
                for ($i=0; $i<3; ++$i) {
                        $pxl = array(min(max($x - 1 + $i, 0), $sx - 1), $yv);
                    $rgb = imagecolorat($srcback, $pxl[0], $pxl[1]);
                    $new_r += (($rgb >> 16) & 0xFF) * $filter[$j][$i];
                    $new_g += (($rgb >> 8) & 0xFF) * $filter[$j][$i];
                    $new_b += ($rgb & 0xFF) * $filter[$j][$i];
                }
            }

            $new_r = ($new_r/$filter_div)+$offset;
            $new_g = ($new_g/$filter_div)+$offset;
            $new_b = ($new_b/$filter_div)+$offset;

            $new_r = ($new_r > 255)? 255 : (($new_r < 0)? 0:$new_r);
            $new_g = ($new_g > 255)? 255 : (($new_g < 0)? 0:$new_g);
            $new_b = ($new_b > 255)? 255 : (($new_b < 0)? 0:$new_b);

            $new_pxl = ImageColorAllocateAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
            if ($new_pxl == -1) {
                $new_pxl = ImageColorClosestAlpha($src, (int)$new_r, (int)$new_g, (int)$new_b, $new_a);
            }
            if (($y >= 0) && ($y < $sy)) {
                imagesetpixel($src, $x, $y, $new_pxl);
            }
        }
    }
    imagedestroy($srcback);
    return 1;
}
}
function watermark($name,$filename,$colofont, $colofont2,$mark, $gfsize, $gfill, $gxpos,$gypos, $gsharp, $usettf)
{
//echo "$filename<br>\n";
$colofont=trim(trim(str_replace("#","",$colofont)));
$rrr= (hexdec ("0x" . substr($colofont,0,2)));
$ggg=(hexdec ("0x" . substr($colofont,2,2)));
$bbb=(hexdec ("0x" . substr($colofont,4,2)));
$colofont2=trim(trim(str_replace("#","",$colofont2)));
$rrr2= (hexdec ("0x" . substr($colofont2,0,2)));
$ggg2=(hexdec ("0x" . substr($colofont2,2,2)));
$bbb2=(hexdec ("0x" . substr($colofont2,4,2)));



	$system=explode(".",substr($name,-5));
	if (preg_match("/jpg|jpeg/",$system[1])){$src_img=imagecreatefromjpeg($name);}
    if (preg_match("/gif/",$system[1])){$src_img=imagecreatefromgif($name);}
	if (preg_match("/png/",$system[1])){$src_img=imagecreatefrompng($name);}

	$w=imageSX($src_img);
	$h=imageSY($src_img);
    $fontclr=imagecolorallocate($src_img, $rrr, $ggg, $bbb);
    $fontclr2=imagecolorallocate($src_img, $rrr2, $ggg2, $bbb2);
    $razm=round(doubleval(strlen($mark)*doubleval($gfsize)*1.5+doubleval($gfsize)*10+10));
    //echo "<font color=#b94a48>$razm</font></br>";
    if ($gsharp=="yes") {
$divisor = 8;
$offset = 0;
if(!function_exists('imageconvolution')){
    $sharpenMatrix = array(-1,-1,-1,-1,16,-1,-1,-1,-1);
    } else {
    $sharpenMatrix = array(array( -1, -1, -1 ),
                        array( -1, 16, -1 ),
                        array( -1, -1, -1 ) );
    }
imageconvolution($src_img, $sharpenMatrix, $divisor, $offset);
}
    if ($usettf==1) {
    //ttf font exists
    $fontsize=(6+$gfsize);
    $coord = imagettfbbox($fontsize, 0,"arial.ttf",$mark );
    $text_width = $coord[2] - $coord[0];
    $text_height = $coord[1]- $coord[7];

    if ($gypos=="top") {$h=(12+round(doubleval($gfsize)));} else { if ($gypos=="bottom") {$h=($h-round(doubleval($gfsize/4))); } else {$h=round(doubleval(12+($h/2)+doubleval($gfsize/4))); }}
    if ($gxpos=="left") {$w=(12+$text_width);} else { if ($gxpos=="right") { } else {$w=round((12+$w+$text_width)/2); }}
    if ($gfill=="yes") {
    ImageFilledRectangle ($src_img,($w-12-$text_width),($h-$text_height-round($text_height/10)-6),($w-8+12),($h+round($text_height/10)),$fontclr2);
    }
//echo "<small>$name, $filename, $colofont, $colofont2, MARK=$mark, FSIZE=$gfsize, FILL=$gfill, XPOS=$gxpos, YPOS=$gypos, SHARP=$gsharp, USE_TTF=$usettf</small><br>\n";

    //$mark=$text_width."x".$text_height;
    //echo "<small>$gfsize,$w, $h, $razm, $mark</small><br>";

   //echo $mark;
    imageTtfText($src_img, $fontsize, 0, ($w-4-$text_width), ($h-4), $fontclr2, "arial.ttf", $mark);
    imageTtfText($src_img, $fontsize, 0, ($w-6-$text_width), ($h-4), $fontclr2, "arial.ttf", $mark);
    imageTtfText($src_img, $fontsize, 0, ($w-5-$text_width), ($h-3), $fontclr2, "arial.ttf", $mark);
    imageTtfText($src_img, $fontsize, 0, ($w-5-$text_width), ($h-5), $fontclr2, "arial.ttf", $mark);
    imageTtfText($src_img, $fontsize, 0, ($w-5-$text_width), ($h-4), $fontclr,  "arial.ttf", $mark);
    } else {
    //no ttf font
    $fontsize=$gfsize;
    //echo "<small>$gfsize,$w, $h, $razm, $mark</small><br>";
    ImageString($src_img, $gfsize, ($w-4-$razm), ($h-14-doubleval($gfsize)), $mark, $fontclr2);
    ImageString($src_img, $gfsize, ($w-6-$razm), ($h-14-doubleval($gfsize)), $mark, $fontclr2);
    ImageString($src_img, $gfsize, ($w-5-$razm), ($h-13-doubleval($gfsize)), $mark, $fontclr2);
    ImageString($src_img, $gfsize, ($w-5-$razm), ($h-15-doubleval($gfsize)), $mark, $fontclr2);
	ImageString($src_img, $gfsize, ($w-5-$razm), ($h-14-doubleval($gfsize)), $mark, $fontclr);
    }


	if (preg_match("/png/i",$system[1]))
	{
    echo $filename." - OK<br>";
		imagepng($src_img,$filename);
	}
    if (preg_match("/gif/i",$system[1]))
	{
    echo $filename." - OK<br>";
		imagegif($src_img,$filename);
        }
    if (preg_match("/jpg/i",$system[1]))
	{
    echo $filename." - OK<br>";
		imagejpeg($src_img,$filename);
	}
    if (preg_match("/jpeg/i",$system[1]))
	{
    echo $filename." - OK<br>";
		imagejpeg($src_img,$filename);
	}
	imagedestroy($src_img);
}
$ct="<script language=\"javascript\">
function mark[id](arg) {
//var x=document.getElementById(arg).style.backgroundColor;
document.getElementById('[id]').value=arg;
preview();
}
function preview() {
var arg1=document.getElementById('colr').value;
var arg2=document.getElementById('bg').value;
var arg3=document.getElementById('wmark').value;
var arg4=document.getElementById('fsize').value;
var arg5=document.getElementById('ypos').value;
var arg6=document.getElementById('xpos').value;
var arg7=document.getElementById('fill').value;
var arg9=document.getElementById('sharp').value;
var curtime = new Date();
var arg8=curtime.getTime();
document.getElementById('test').src=\"testwm.php?fontcolor=\"+arg1+\"&bgcolor=\"+arg2+\"&watermark=\"+arg3+\"&fsize=\"+arg4+\"&ypos=\"+arg5+\"&xpos=\"+arg6+\"&fill=\"+arg7+\"&sharp=\"+arg9+\"&time=\"+arg8;
}
</script>
<table border=0 cellpadding=0 cellspacing=5><tr>
<td id=\"[id]id11\" style=\"background-color: #ffffff;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#ffffff")."\")></a></td>
<td id=\"[id]id12\" style=\"background-color: #000000;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#000000")."\")></a></td>
<td id=\"[id]id13\" style=\"background-color: #800000;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#800000")."\")></a></td>
<td id=\"[id]id14\" style=\"background-color: #008000;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#008000")."\")></a></td>
<td id=\"[id]id15\" style=\"background-color: #000080;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#000080")."\")></a></td>
<td id=\"[id]id116\" style=\"background-color: #808000;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#808000")."\")></a></td>
<td id=\"[id]id17\" style=\"background-color: #008080;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#008080")."\")></a></td>
<td id=\"[id]id21\" style=\"background-color: #b0b0b0;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#b0b0b0")."\")></a></td>
<td id=\"[id]id18\" style=\"background-color: #808080;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#808080")."\")></a></td>
<td id=\"[id]id19\" style=\"background-color: #404040;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#404040")."\")></a></td>
<td id=\"[id]id20\" style=\"background-color: #202020;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","#202020")."\")></a></td></tr><tr>
<td id=\"[id]id0\" style=\"background-color: $nc0;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc0")."\")></a></td>
<td id=\"[id]id1\" style=\"background-color: $nc1;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc1")."\")></a></td>
<td id=\"[id]id2\" style=\"background-color: $nc2;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc2")."\")></a></td>
<td id=\"[id]id3\" style=\"background-color: $nc3;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc3")."\")></a></td>
<td id=\"[id]id4\" style=\"background-color: $nc4;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc4")."\")></a></td>
<td id=\"[id]id5\" style=\"background-color: $nc5;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc5")."\")></a></td>
<td id=\"[id]id6\" style=\"background-color: $nc6;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc6")."\")></a></td>
<td id=\"[id]id7\" style=\"background-color: $nc7;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc7")."\")></a></td>
<td id=\"[id]id8\" style=\"background-color: $nc8;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc8")."\")></a></td>
<td id=\"[id]id9\" style=\"background-color: $nc9;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc9")."\")></a></td>
<td id=\"[id]id10\" style=\"background-color: $nc10;\">
<a href=#mark><img src=$image_path/pix.gif style=\"border: 1px solid #aaaaaa\"width=16 height=16 onclick=javascript:mark[id](\"".str_replace("#","","$nc10")."\")></a></td>
</tr></table>";
$form="<form class=form-inline action=watermark.php method=post>
<input type=hidden value=1 name=ok>
<input type=hidden value=$speek name=speek>
<table border=0><tr><td valign=top align=center><img src=\"$htpath/admin/testwm.php?fontcolor=000000&bgcolor=ffffff&watermark=".rawurlencode(strtoken(str_replace("http://", "", str_replace("www.", "", $htpath)), "/"))."\" id=\"test\" border=0 align=absmiddle vspace=4 hspace=4><br><input type=button value=\"Test\" onclick=\"javascript:preview();\" style=\"width:100%;\"><br>
</td><td width=100% valign=top>
<table border=0 width=100% cellpadding=5 cellspacing=0><tr bgcolor=$nc6><td>$lang[855]:</td><td><input id=\"wmark\" type=text size=10 value=\"".strtoken(str_replace("http://", "", str_replace("www.", "", $htpath)), "/")."\" name=\"watermark\" style=\"width:100%\"></td></tr>
<tr bgcolor=$nc6><td colspan=2>SIZE: <select id=\"fsize\" name=\"fsize\" onchange=\"javascript:preview();\">";
if (file_exists("./arial.ttf")==true) {
$form.="<option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option>";
} else {
$form.="<option>1</option><option selected>2</option><option>3</option><option>4</option><option>5</option>";
}
$form.="</select></td></tr>
<tr bgcolor=$nc6>
<td>YPOS: <select onchange=\"javascript:preview();\" id=\"ypos\" name=\"ypos\"><option selected>bottom</option><option>top</option><option>center</option></select>
</td><td>XPOS: <select onchange=\"javascript:preview();\" id=\"xpos\" name=\"xpos\"><option selected>right</option><option>left</option><option>center</option></select></td></tr>
<tr bgcolor=$nc6><td>FILL: <select onchange=\"javascript:preview();\" id=\"fill\" name=\"fill\"><option selected>no</option><option>yes</option></select>
</td><td>SHARP: <select onchange=\"javascript:preview();\" id=\"sharp\" name=\"sharp\"><option selected>no</option><option>yes</option></select></td></tr>
</table>
</td></tr></table>
<table border=0 width=100% cellpadding=5 cellspacing=0><tr><td valign=top>$lang[856]:</td><td><input id=\"colr\" type=text size=10 value=\"000000\" name=fontcolor style=\"width:100%\">".str_replace("background-color: #ffffff;border: 5px solid #ffffff;", "background-color: #ffffff; border: 5px solid #008000;",str_replace("[id]","colr",$ct))."</td></tr>
<tr bgcolor=$nc6><td valign=top>$lang[857]:</td><td><input id=\"bg\" type=text size=10 value=\"ffffff\" name=bgcolor style=\"width:100%\">".str_replace("background-color: #000000;border: 5px solid #ffffff;", "background-color: #000000; border: 5px solid #008000;",str_replace("[id]","bg",$ct))."</td></tr>
<tr><td>&nbsp;</td><td valign=top><small><!--fieldset><legend><input type=checkbox size=10 value=\"YES\" name=resize> Resize<br></legend>
Small photos: W:<input type=text size=5 value=\"150\" name=sw> x H:<input type=text size=5 value=\"150\" name=sh><br>
Large photos: W:<input type=text size=5 value=\"550\" name=lw> x H:<input type=text size=5 value=\"550\" name=lh><br>
</fieldset-->
<input type=\"radio\" value=1 checked name=\"only_new\" id=onew><label for=onew>".$lang[858]."</label>
<input type=\"radio\" value=2 name=\"only_new\" id=onew2><label for=onew2>".$lang[859]."</label></small><br><br></td></tr>
<tr><td colspan=2><div align=center><input type=submit value=\"OK\"></div></td></tr>
</table>
</form>";

if ($ok==1) {
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}


$fold="..";
require "../modules/functions.php";

echo $css;
$usett=0;
if (file_exists("./arial.ttf")==true) {

$usett=1;

}

$st=0;
$base="";
$minibase="";
$file=".$base_file";
$f=fopen($file,"r");
$zf=0;
$rating=Array();
$curt=time();
while(!feof($f)) {
echo "\n";

//echo "$stun";
$stun=fgets($f);
if (trim($stun!="")) {
$out=explode("|",$stun);

$inifid=md5(@$out[3]." ID:".@$out[6]);
@$foto1=@$out[9];
@$foto2=@$out[10];

if (trim ($foto1)!="") {
$fotomass1=explode("src='",@$foto1);
while (list ($key1, $val1) = each ($fotomass1)) {

if ($key1>0 ) {
$dest=strtoken($val1,"'");  ;
$ren[$dest]=str_replace("../../","../",str_replace("$htpath/","../","../".$dest));
//echo $ren[$dest]."<br>";
}
}
while (list ($k, $v) = each ($ren)) {
if ($k!=$v) {
$tmpdir=explode ("/", $v);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($file.$curt);
$tmptype=explode(".", $file);
$type=array_pop($tmptype);
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
if ($only_new==2) {
$fgp=fopen("$dir/$file.mark", "w");
fclose($fgp);
watermark( "$dir/$file", "$dir/$file", $fontcolor,$bgcolor, $watermark,$_POST['fsize'], $_POST['fill'], $_POST['xpos'],$_POST['ypos'],$_POST['sharp'],$usett);
} else {
if (file_exists("$dir/$file.mark")==TRUE) {
//echo "<b>$file - MARKED</b><br>";
} else {
$fgp=fopen("$dir/$file.mark", "w");
fclose($fgp);
watermark( "$dir/$file", "$dir/$file", $fontcolor,$bgcolor, $watermark,$_POST['fsize'], $_POST['fill'], $_POST['xpos'],$_POST['ypos'],$_POST['sharp'],$usett);
}
}
//echo "Watermark: $dir/$file -> $dir/$target.$type<br>REPLACE: $k -> $htpath/$realdir/$target.$type<br><br>\n";
//@rename ( "$dir/$target.$type", "$dir/$file");
}
}
unset($ren, $tmpdir, $k, $v, $count, $dir, $target, $tmptype, $type, $realdir);
}
if (trim ($foto2)!="") {
$fotomass2=explode("src='",@$foto2);
while (list ($key, $val) = each ($fotomass2)) {
if ($key>0 ) {
$dest=strtoken($val,"'");
$ren[$dest]=str_replace("../../","../",str_replace("$htpath/","../","../".strtoken($val,"'")));
}
}
while (list ($k, $v) = each ($ren)) {
if ($k!=$v) {
$tmpdir=explode ("/", $v);
$count=count($tmpdir)-1;
$file= $tmpdir[$count];
array_pop($tmpdir);
$dir=implode("/",$tmpdir);
$target=md5($file.$curt);
$tmptype=explode(".", $file);
$type=array_pop($tmptype);
array_shift($tmpdir);
$realdir=implode("/",$tmpdir);
if ($only_new==2) {
$fgp=fopen("$dir/$file.mark", "w");
fclose($fgp);
watermark( "$dir/$file", "$dir/$file", $fontcolor,$bgcolor, $watermark,$_POST['fsize'], $_POST['fill'], $_POST['xpos'],$_POST['ypos'],$_POST['sharp'],$usett);
} else {
if (file_exists("$dir/$file.mark")==TRUE) {
//echo "<b>$file - MARKED</b><br>";
} else {
$fgp=fopen("$dir/$file.mark", "w");
fclose($fgp);
watermark( "$dir/$file", "$dir/$file", $fontcolor,$bgcolor, $watermark,$_POST['fsize'], $_POST['fill'], $_POST['xpos'],$_POST['ypos'],$_POST['sharp'],$usett);
}
}
//@rename ( "$dir/$target.$type", "$dir/$file");
//echo "RENAME: $dir/$file -> $dir/$target.$type<br>REPLACE: $k -> $htpath/$realdir/$target.$type<br><br>\n";
//$stun=str_replace("$k","$htpath/$realdir/$target.$type",$stun);
}
}
unset($ren, $tmpdir, $k, $v, $count, $dir, $target, $tmptype, $type, $realdir);
}

unset($out,$tmpft1,$tmpft2,$key,$val);
}
$base.=$stun;
}
fclose($f);
//echo "<pre>$base</pre>";
$file=".$base_file";
$f=fopen($file,"w");
fputs($f,$base);
echo "<h1>OK</h1>";
} else {
echo $form;
}
?>
</td></tr></table></body>
</html>
