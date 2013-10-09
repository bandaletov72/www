<?php

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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
$fold="..";
require ("../templates/$template/css.inc");

echo "<!DOCTYPE html><html>
<TITLE>Thumb</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
$css
</head>
<BODY bgcolor=$nc0 link=$nc2 text=$nc5>
";

$z=0;
$off="";
if(isset($_GET['imagefolder'])) $imagefolder=$_GET['imagefolder']; elseif(isset($_POST['imagefolder'])) $imagefolder=$_POST['imagefolder']; else $imagefolder="./gallery";
if(isset($_GET['pix'])) $pix=$_GET['pix']; elseif(isset($_POST['pix'])) $pix=$_POST['pix']; else $pix="150";
if(isset($_GET['thumbsfolder'])) $thumbsfolder=$_GET['thumbsfolder']; elseif(isset($_POST['thumbsfolder'])) $thumbsfolder=$_POST['thumbsfolder']; else $thumbsfolder=$imagefolder;
echo "<h4>Thumbnails</h4>$imagefolder -&gt; $thumbsfolder<br><b>Destination size:</b> $pix"."x"."$pix px<br><div class=cat2 style=\"width:90%; height:200px; overflow: auto;\">";
$pics=directory($imagefolder,"jpg,JPG,JPEG,jpeg,png,PNG,gif,GIF");
echo "<br><b>Processing...</b><br>\n";
$pics=ditchtn($pics,"tn_");
if ($pics[0]!="")
{

$zz=Array();
	foreach ($pics as $p)
	{
	
    //create tn_files
    if (($p!="icon.png")&&(substr($p,0,3)!="tn_")) {
	if ((filesize($imagefolder."/".$p)>(1024*1024*1.5))) {
	echo "<font color=#b94a48>$p</font> Too big image to process... Max size = ".(1024*1024*1.5)." bytes<br>";
	} else {
	echo "<font color=#468847>$p</font><br>";
       $zz[$z]=$thumbsfolder."/"."tn_".$p;
		createthumb($imagefolder."/".$p,$thumbsfolder."/"."tn_".$p,$pix,$pix);
        $z++;
        }
		}
	}
    //create thumbs.db file
    @unlink ($imagefolder."/thumbs.db");
    @unlink ($imagefolder."/Thumbs.db");

    if ($z>=1) {
    natcasesort($zz);
    $z=0;
	echo "<br><strong>Create Thumb.db</strong><br>";
    while (list($key,$val)=each($zz)) {
    if ($z<4) {
    $pos=Array();
$pos = explode(".", substr($val,-5));
$typ = @$pos[1];
$typ= ".".strtolower($typ);
    createthumb($val,$thumbsfolder."/"."tn_tn".$key."$typ",round($pix/2),round($pix/2));
    $off.="<img class=img src=\"$htpath/".str_replace("%2f", "/",str_replace("%2F", "/", rawurlencode(str_replace("../", "", $thumbsfolder."/"."tn_tn".$key."$typ"))))."\">";
     }
    $z++;
    }
    $off="<div class=cat2 style=\"width: ".($pix+60)."px\">$off</div>";
    $fp=fopen($imagefolder."/thumbs.db", "w");
    fputs ($fp, $off);
    fclose ($fp);
    }


}
echo "</div><br>$off<div style=\"clear:both\"></div><br>Operation complete. <b>$z</b> thumbnails created<br>";
/*
	Function ditchtn($arr,$thumbname)
	filters out thumbnails
*/
function ditchtn($arr,$thumbname)
{
	foreach ($arr as $item)
	{

		if (!preg_match("/^".$thumbname."/",$item)){$tmparr[]=$item; }
	}
	return $tmparr;
}

/*
	Function createthumb($name,$filename,$new_w,$new_h)
	creates a resized image
	variables:
	$name		Original filename
	$filename	Filename of the resized image
	$new_w		width of resized image
	$new_h		height of resized image
*/
function createthumb($name,$filename,$new_w,$new_h)
{
	$pos=Array();
$pos = explode(".", substr($name,-5));
$typ = @$pos[1];
$typ= ".".strtolower($typ);
    if ($name!="icon.png") {
	if (($typ==".jpg")||($typ==".jpeg")){$src_img=imagecreatefromjpeg($name);}
    if ($typ==".gif"){$src_img=imagecreatefromgif($name);}
	if ($typ==".png"){$src_img=imagecreatefrompng($name);}
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
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
	if ($typ==".png")
	{
    echo $filename." - OK<br>";
		imagepng($dst_img,$filename);
	}
    if ($typ==".gif")
	{
    echo $filename." - OK<br>";
		imagegif($dst_img,$filename);
        }
    if (($typ==".jpg")||($typ==".jpeg"))
	{
    echo $filename." - OK<br>";
		imagejpeg($dst_img,$filename);
	}
   
	imagedestroy($dst_img);
	imagedestroy($src_img);
    }
}

/*
        Function directory($directory,$filters)
        reads the content of $directory, takes the files that apply to $filter
		and returns an array of the filenames.
        You can specify which files to read, for example
        $files = directory(".","jpg,gif");
                gets all jpg and gif files in this directory.
        $files = directory(".","all");
                gets all files.
*/
function directory($dir,$filters)
{
	$handle=opendir($dir);
    echo "<b>Thumbing directory:</b> ".$dir."</b><br><b>Filter:</b >$filters<br><br><b>Found files:</b><br>";
	$files=array();
	if ($filters == "all"){while(($file = readdir($handle))!==false){ if (substr($file,0,3)=="tn_") { unlink($dir."/".$file); echo "$file - deleted<br>\n"; } else { $files[] = $file; } }}
	if ($filters != "all")
	{
		$filters=explode(",",$filters);
		while (($file = readdir($handle))!==false)
		{
            if (substr($file,0,3)=="tn_") { unlink($dir."/".$file); echo "$file - deleted<br>\n"; } else {
			for ($f=0;$f<sizeof($filters);$f++):
				$system=explode(".",substr($file,-5));
				if ($system[1] == $filters[$f]){$files[] = $file; echo $file."<br>";}
			endfor;
		}
        }
	}
	closedir($handle);
	return $files;
}
?>
</body></html>
