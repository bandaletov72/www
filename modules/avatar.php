<?php
$gal="";
$ava_cols=4;
$ext="";
$ddir="";
$findmp3=0;
$ppages="";
$aav="";
$avatars="";
$hear="";
$mp3s="";
$avatarsres="";

require("./modules/class.id3.php");
if(isset($_GET['isort'])) $isort=$_GET['isort']; elseif(isset($_POST['isort'])) $isort=$_POST['isort']; else $isort="";
if (!preg_match("/^[date]+$/i",$isort)) { $isort="";}
if(isset($_GET['avatar_url'])) $avatar_url=$_GET['avatar_url']; elseif(isset($_POST['avatar_url'])) $avatar_url=$_POST['avatar_url']; else $avatar_url="";
if (!preg_match('/^[0-9a-zA-Z\.\%\/\:\+\?\&\#\=_-]+$/i',$avatar_url)) { $avatar_url="";}
$avatar_url=trim(str_replace("http://", "",$avatar_url));
if ($avatar_url!="") {$avatar_url="http://$avatar_url"; }

$maximg_size=1048576;
$new_w=150;
$new_h=150;
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
function up_img($repst) {
global $details;
global $valid;
global $use_curl;
global $new_w;
global $new_h;
global $maximg_size;
global $htpath;
global $secret_salt;
$returned="";
$ftype="";
$headers=get_headers($repst);
reset ($headers);
while (list($key,$val)=each($headers)){

if (substr($val,0,14)=="Content-Type: ") {
$sys=str_replace("Content-Type: ", "", trim($val));
if ($sys=="image/png") {$ftype="png";}
if ($sys=="image/gif") {$ftype="gif";}
if ($sys=="image/jpg") {$ftype="jpg";}
if ($sys=="image/jpeg") {$ftype="jpg";}
}
}
if ($ftype=="") { return ""; }
if ($use_curl==1) {
$req = $repst;
$ch = curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$img = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$img=@file_get_contents($repst);
}
$md=md5($details[1].time()."$secret_salt");
//$sys=strtolower(substr($repst,-3));
//if (($sys!="gif")&&($sys!="jpg")&&($sys!="png")) {$sys="jpg";}
if (($img!="")&&(strlen($img)<$maximg_size)) {
$dir1="avatars";
$dir2=substr($md,0,3);
//$cl_list.= "OK. Lets writing classifieds #$cl_file ...<br><br>";
if(is_dir("./gallery")!=true) { mkdir("./gallery",0755); }
if(is_dir("./gallery/"."$dir1")!=true) { mkdir("./gallery/"."$dir1",0755); }
if(is_dir("./gallery/"."$dir1/$dir2")!=true) { mkdir("./gallery/"."$dir1/$dir2",0755); }
$ifp=fopen("./admin/tmp/".$md."."."$ftype","w");
fputs($ifp, $img);
fclose($ifp);

$name="./admin/tmp/".$md."."."$ftype";
$filename="./gallery/"."$dir1/$dir2/tn_".$md."."."$ftype";
if ($ftype=="jpg"){$src_img=imagecreatefromjpeg($name);}
    if ($ftype=="gif"){$src_img=imagecreatefromgif($name);}
	if ($ftype=="png"){$src_img=imagecreatefrompng($name);}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);


	if ($old_x > $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y)
	{
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
//    if ($old_x<=$new_w) {$thumb_w=$old_x;}
//    if ($old_y<=$new_h) {$thumb_h=$old_y; } else { $thumb_w=$old_x*($new_w/$old_y); $thumb_h=$new_h; }
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
    //сохраняем прозрачность
    imageAlphaBlending($dst_img, false);
    imageSaveAlpha($dst_img, true);

	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
    //резкость
    if(!function_exists('imageconvolution')){
    $sharpenMatrix = array(-1,-1,-1,-1,16,-1,-1,-1,-1);
    } else {
    $sharpenMatrix = array(array( -1, -1, -1 ),
                        array( -1, 16, -1 ),
                        array( -1, -1, -1 ) );
    }
$divisor = 8;
$offset = 0;
//imageconvolution($dst_img, $sharpenMatrix, $divisor, $offset);

	if ($ftype=="png")
	{
		imagepng($dst_img,$filename);
	}
    if ($ftype=="gif")
	{
		imagegif($dst_img,$filename);
        }
    if ($ftype=="jpg")
	{
		imagejpeg($dst_img,$filename);
	}
	imagedestroy($dst_img);
	imagedestroy($src_img);
unlink ($name);
@unlink ("./gallery/"."$dir1/$dir2/tn_".md5($details[1].$secret_salt)."."."$ftype");
rename("./gallery/"."$dir1/$dir2/tn_".$md."."."$ftype", "./gallery/"."$dir1/$dir2/tn_".md5($details[1].$secret_salt)."."."$ftype");
$returned="$dir2/tn_".md5($details[1].$secret_salt)."."."$ftype";
} else {
//$returned[0]="$htpath/thumb/"."$dir1/$dir2/".$md."."."$ftype";
$returned="";
}
return $returned;

}

if (("$valid"=="1")&&($details[1]!="")&&($avatar_url!="")) {
if (function_exists('curl_init')) {
$use_curl=1;
}
$av_img="";
$av_img=up_img($avatar_url);
if ($av_img!="") {
if (is_dir("./admin/userstat/".$details[1])==FALSE) { mkdir("./admin/userstat/".$details[1],0755); }
$afp=fopen("./admin/userstat/".$details[1]."/".$details[1].".ava", "w");
fputs($afp,$av_img);
fclose ($afp);
unset($av_img);
unset($afp);
unset($avatar_url);

$avatarsres="<br><div><h4>$lang[209]</h4><br><a href=\"$htpath/index.php?action=cabinet\">$lang[1118]</a><META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=$htpath/index.php?action=cabinet\"></div>";
} else {
$avatarsres="<br><div><font color=#b94a48><h4>$lang[42]!</h4>Error upload image. Please try another URL.</font><br><br>
<div class=round3 style=\"padding:10px;\"><i>$lang[925]:</i><br>
<form class=form-inline action=index.php method=POST>
<table border=0 width=100%><tr>
<td style=\"white-space:nowrap;\"><b>$lang[926]:</b></td><td width=100%><input type=hidden name=action value=avatar>
<input type=text size=20 style=\"width:100%\" name=\"avatar_url\" value=\"http://\"></td>
<td>
<input type=submit value=\"$lang[1113]\">
</td></tr></table></form><br>
</div></div>";
}
}
if ($avatarsres=="") {
$i="";
$make_col=$lastgoods_cols;
$st=0;
//$next=$start+$perpage;
$curp=1;
$nit=1;
$wim="";
$wup="";
$aav="";
$ddel="";
unset($fileopens);

$bdi="/";
if ((!@$perpage) || (@$perpage=="")): $perpage=100; endif;
if (!preg_match("/^[0-9_]+$/",$perpage)) { $perpage=100;}
if ($perpage>100) {$perpage=100;}
$perpage=100;
if ((!@$start) || (@$start=="")): $start=0; endif;
if (!preg_match("/^[0-9_]+$/",$start)) { $start=0;}
if ($start>99999) {$start=0;}

$fileopens[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;

$files_found=0;
$st=0;
$s=0;
$backurl="";
$tmpback=Array();
$tmpback=explode("/", $i);
array_pop($tmpback);
while (list ($keycr, $stcr) = each ($tmpback)) {
}
$backurl=implode("/",$tmpback);
if ($bdi!="/") {
$avatars.="<a href=\"$htpath/index.php?action=avatar&isort=$isort&i=".rawurlencode($backurl)."\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10></a><a href=\"$htpath/index.php?action=avatar&isort=$isort&i=".rawurlencode($backurl)."\"><small><i>".$lang['back_to_higher_level']."</i></small></a><br><br><br>";
}
$avatars.="";
$notf=0;
if (!is_dir("./gallery/avatars".$bdi."")) { $notf=1; } else {
$handle=opendir("./gallery/avatars".$bdi."");
while (($fileopen = readdir($handle))!==FALSE) {
	$pos = strrpos($fileopen, ".");
	$typ = substr($fileopen, $pos, strlen($fileopen));
//$typ= strtolower($typ);
$files_found2 = 0;
$files_found3 = 0;
if ((is_dir("./gallery/avatars".$bdi."".$fileopen)==TRUE)&&($fileopen!=".")&&($fileopen!="..")) {
if ((strtolower($fileopen)=="icon.png")||(substr($fileopen,-4)==".idx")||(substr($fileopen,0,3)=="tn_")||(is_dir("./gallery/avatars".$bdi."".$fileopen)==TRUE)) {continue;} else {
$handle2=opendir("./gallery/avatars".$bdi."$fileopen/");
while (($fileopend = readdir($handle2))!==FALSE) {
if ((is_dir("./gallery/avatars".$bdi."$fileopen/$fileopend")==TRUE)&&($fileopend!=".")&&($fileopend!="..")) {$files_found3 += 1;}
if ((is_dir("./gallery/avatars".$bdi."$fileopen/$fileopend")==FALSE)&&($fileopend!=".")&&($fileopend!="..")) {
if ((strtolower($fileopend)=="icon.png")||(substr($fileopend,-4)==".idx")||(substr($fileopend,0,3)=="tn_")) {continue;} else {
$pos2 = strrpos($fileopend, ".");
$typ2 = substr($fileopend, $pos2, strlen($fileopend));
//$typ2= strtolower($typ2);
if (($typ2!=".jpg")&&($typ2!=".jpeg")&&($typ2!=".gif")&&($typ2!=".png")&&($typ2!=".PNG")&&($typ2!=".JPG")&&($typ2!=".JPEG")&&($typ2!=".GIF")&&($typ2!=".Png")&&($typ2!=".Jpg")&&($typ2!=".Jpeg")&&($typ2!=".Gif")&&($typ2!=".Png")){
continue;
} else {
if (($fileopend!="icon.png")&&($fileopend!="Thumbs.db")) {
$files_found2 += 1;
}
}
}
}
}
}
closedir ($handle2);
if (@file_exists("./gallery/avatars".$bdi."$fileopen/icon.png")==TRUE) { $off=$htpath."/gallery/avatars".str_replace("%2F","/", rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen"))))."/icon.png"; } else { if ($files_found2==0) {$off="$htpath/images/of.png";} else {$off="$htpath/images/off.png";}}

$fileopens[$s] = "<!-- 0 -->
<td align='left' valign='top' width=".floor(100/$ava_cols)."%><a href=\"$htpath/index.php?action=avatar&isort=$isort&i=".rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen")))."\"><img src=\"".$off."\" border=0></a><br><br><b><a href=\"$htpath/index.php?action=avatar&isort=$isort&i=".rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen")))."\">".strtoken("$fileopen",".")."</a></b> [$files_found3/".$files_found2."]<br>$ddir<br>
</td>";
$files_found += 1;
$s+=1;
} else {
if (($typ!=".jpg")&&($typ!=".jpeg")&&($typ!=".gif")&&($typ!=".png")&&($typ!=".PNG")&&($typ!=".JPG")&&($typ!=".JPEG")&&($typ!=".GIF")&&($typ!=".Png")&&($typ!=".Jpg")&&($typ!=".Jpeg")&&($typ!=".Gif")&&($typ!=".Png")){

continue;
} else {
if (($fileopen=="icon.png")&&($details[7]!="ADMIN")) {continue;} else {








//If you wish include link to file
$mpdir="./gallery/avatars".$bdi;
// lets handle directory


if ((substr($fileopen,0,3)!="tn_")&&(strtolower($fileopen)!="icon.png"))  {







if (($typ==".jpg")||($typ==".jpeg")||($typ==".gif")||($typ==".png")||($typ==".PNG")||($typ==".JPG")||($typ==".JPEG")||($typ==".GIF")||($typ==".Png")||($typ==".Jpg")||($typ==".Jpeg")||($typ==".Gif")||($typ==".Png")){
$tn="";

$size = intval((filesize ("./gallery/avatars".$bdi."$fileopen"))/1024);
$imagesz = getimagesize("./gallery/avatars".$bdi."$fileopen");
                        $fwidth  = $imagesz[0];
                        $fheight = $imagesz[1];

$maxw=$gallery_maxwidth;
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
if ($widt>$maxw){$widt=$maxw;}
$zoom="<img src=\"$image_path/bigger.png\" border=0 title=\"".$lang[140]."\" style=\"vertical-align: middle\">";
if (($fwidth<=$maxw)&&($fheight<=$maxw)){$maxw=$fwidth;$widt=$fheight; $zoom="";}

$wh="width=".$maxw." height=".$widt;
if (file_exists( "./gallery/avatars".$bdi."tn_$fileopen")==TRUE) {
$wh=""; $tn="tn_";
}
$form1="";
$form2="";
$ftyname=substr("$fileopen",0,(strlen("$fileopen")-strlen($typ)));
$lenn=strlen($ftyname);
if ($lenn>=20) {$lenn==20;}
$idff="$mpdir".str_replace("%20"," ", "$fileopen").".idx";
$idxf="";
if (file_exists($idff)) {
$idxfo=fopen($idff,"r");
$idxf="<table border=0 width=100%><tr><td>".fread($idxfo,filesize($idff))."</td></tr></table>";
fclose($idxfo);
}
if ($isort=="date") {$sortby=filemtime("./gallery/avatars".$bdi."$fileopen"); $idate=date("d/m/Y", filemtime("./gallery/avatars".$bdi."$fileopen"));  } else { $sortby=$fileopen; $idate="";}
$fileopens[$s] = "<!-- ".$sortby." -->
<td align='left' valign='top' width=".floor(100/$ava_cols)."%><a href=\"index.php?action=cabinet&ch_avatar=".rawurlencode($ftyname)."&avatar_type=".str_replace(".","", $typ)."\"><img src=\"$htpath/gallery/avatars".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$tn$fileopen"))))."\" border=\"0\" $wh title=\"".substr(str_replace("\"","", strip_tags($idxf)),0, 150)."\"><br>$idate<br>".$ftyname."$form2</a><br>
</td>";
$files_found += 1;
$s+=1;
}

}
}
}
}
}
closedir ($handle);
}

if ((!@$fileopens[0]) || (@$fileopens[0]=="")) {
	$fileopens[0]="";
	//$avatars.="<a href=\"$htpath/index.php?action=avatar&isort=$isort&i=".rawurlencode($backurl)."\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10></a><a href=\"$htpath/index.php?action=avatar&isort=$isort&i=".rawurlencode($backurl)."\"><small><i>".$lang['back_to_higher_level']."</i></small></a><br><br><br>";
	} else {
//сортировка по алфавиту//
reset ($fileopens);

$make_col=$ava_cols; //
$st=0;
$ddt=0;
if ($way=="up") {
sort($fileopens);
} else {
sort($fileopens);
$res_tmp=array_reverse($fileopens);
unset($fileopens);
$fileopens=$res_tmp;
unset($res_tmp);
}
reset($fileopens);
$eee=1;
if ($start>$s){$start=(floor($s/$perpage))*$perpage; }
while ($st < $perpage) {
$gt = 0;
if ((!@$fileopens[($start+$st)]) || (@$fileopens[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$fileopens[($start+$st)]) || (@$fileopens[($start+$st)]=="")): $fileopens[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($eee/2)) == "TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}

$val = $fileopens[($start+$st)]; //см выше

$st += 1;

$ddt += 1;
$gal .= "$val\n";
if ($ddt>=$ava_cols) { $eee+=1; $ddt=0; $gal.="</tr></table><table border=0 cellpadding=0 cellspacing=10 width=100% bordercolor=$back><tr>";}
}

$avatars.="";
$total = count ($fileopens)-$gt;
$numberpages = (ceil ($total/($perpage+0.000001)));

$startnew=$start+1;

$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;
$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"$htpath/index.php?action=avatar&isort=$isort&amp;start=" . ($start+$perpage) . "&amp;perpage=$perpage\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"$htpath/index.php?action=avatar&isort=$isort&amp;start=0&amp;perpage=\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"$htpath/index.php?action=avatar&isort=$isort&amp;start=" . ($start-$perpage) . "&amp;perpage=$perpage\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
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
if (($tt>(11+round($start/$perpage)))||($tt<(round($start/$perpage)-10))) {if ($tt<(round($start/$perpage)-10)) {$td+=1;} else {$ts+=1;}}  else {
if (($start/$perpage)==$s) {
$curp=($s+1);
if (($s+1)==$numberpages) {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b>";
} else {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b> <img src=\"$image_path/a.gif\"> ";
}
} else {
if (($s+1)==$numberpages) {
$pp.= "<a href = \"$htpath/index.php?action=avatar&isort=$isort&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"$htpath/index.php?action=avatar&isort=$isort&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"$htpath/index.php?action=avatar&isort=$isort&amp;start=0&i=".rawurlencode($i)."&amp;perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"$htpath/index.php?action=avatar&isort=$isort&amp;start=0&i=".rawurlencode($i)."&amp;perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"$htpath/index.php?action=avatar&isort=$isort&amp;start=" . ($perpage*($numberpages-1)) . "&amp;perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }

}
if ($isort=="date") {$lang['by_date']="<b>".$lang['by_date']."</b>";} else {$lang['by_name']="<b>".$lang['by_name']."</b>";}

if ($fancybox_enable==1) {
//fancybox
$aav.="</div>";
}
$avatars="<br>
<div class=round3 style=\"padding:10px;\"><i>$lang[925]:</i><br>
<form class=form-inline action=index.php method=POST>
<table border=0 width=100%><tr>
<td style=\"white-space:nowrap;\"><b>$lang[926]:</b></td><td width=100%><input type=hidden name=action value=avatar>
<input type=text size=20 style=\"width:100%\" name=\"avatar_url\" value=\"http://\"></td>
<td>
<input type=submit value=\"$lang[1113]\">
</td></tr></table></form><br>
</div>
$aav<center>$ppages<br><div align=right><small>".$lang['sort_by'].": <a href=\"$htpath/index.php?action=avatar&isort=&amp;start=$start&i=".rawurlencode($i)."&amp;perpage=$perpage\">".$lang['by_name']."</a> | <a href=\"$htpath/index.php?action=avatar&isort=date&amp;start=$start&i=".rawurlencode($i)."&amp;perpage=$perpage\">".$lang['by_date']."</a></small></div>$hear</center><table border=0 cellspacing=10 cellpadding=0 width=100%>
<tr>
$gal
</tr>
</table>";
$avatars.="<center><br>$ppages<br><br>$lang[1128]<br><br></center>\n";
if ($notf==1) {$avatars="ERROR!";}
}
$avatars=$avatarsres.$avatars;
?>
