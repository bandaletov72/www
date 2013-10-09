<?php
$way="up";
$ppages="";
$ggal="";
$gal="";
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
require ("../modules/translit.php");
if (!isset($gtype)) {
$gtype=1;
}
if (!isset($dest)) {
$dest="";
}
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
echo "
<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>Attachments</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
";
if ((!@$dir) || (@$dir=="")): $dir=""; endif;
$sdir="";
if ($dir!="") {$sdir=$dir."/";}
$fold="..";
require ("../templates/$template/css.inc");
echo $css;
$back=$nc0;
echo "<!-- $gtype-$dest --><SCRIPT language=\"JavaScript1.1\">
<!--

function rc(image,size) {
	";

if (is_dir("../archive")==FALSE) { mkdir("../archive",0755); }
if (is_dir("../archive/attachments")==FALSE) { mkdir("../archive/attachments",0755); }
$fbase="archive/attachments";

echo "opener.document.getElementById('textarea').value+=\"[a href='".$htpath."/$fbase/".$sdir."\" + image + \"']\" + image + \"[/a] (\"+size+\" kB)\\n\";
";


echo "
  window.alert('".$lang[209]."!!!');

}
(function ($){
        $(function (){
            $('.btn-file').each(function (){
                var self = this;
                $('input[type=file]', this).change(function (){
                    // remove existing file info
                    $(self).next().remove();
                    // get value
                    var value = $(this).val();
                    // get file name
                    var fileName = value.substring(value.lastIndexOf('/')+1);
                    // get file extension
                    var fileExt = fileName.split('.').pop().toLowerCase();
                    // append file info
                    $('<span><i class=\"icon-file icon-' + fileExt + '\"></i> ' + fileName + '</span>').insertAfter(self);
                    document.getElementById('sform').submit();
                });
            });
        });
    })(jQuery);
//-->
</SCRIPT>
</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='$nc0' text='$nc5' link='$nc4' vlink=\"$nc3\" alink=\"$nc2\"><div style=\"margin: 10px;\">
<font face=verdana><small> ";


if ((!@$del) || (@$del=="")): $del=""; endif;

if ($del!="") {

echo "<b>".$lang[257]."</b> $del<br>".$lang[438]."";



if (!unlink  ("../$fbase/$sdir" . $del)) {
print ("$del not found!<br>\n");
}
}
$del="";
$make_col=$lastgoods_cols;
$st=0;
if ((!@$perpage) || (@$perpage=="")): $perpage=$gallery_perpage; endif;
if (!preg_match("/^[0-9_]+$/",$perpage)) { $perpage=$gallery_perpage;}
if ($perpage>1000) {$perpage=$gallery_perpage;}
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

require("fileupload-class.php");


        $path = "../$fbase/$sdir";


        $upload_file_name = "userfile";


        $acceptable_file_types = "image/gif|image/jpeg|image/pjpeg|image/png|application/msword|application/vnd.ms-excel|application/pdf|application/x-zip-compressed|application/rar|audio/mp3|application/zip|application/x-rar-compressed|application/x-zip";


        $default_extension = "";


        $mode = 2;

        if (isset($_REQUEST['submitted'])) {

                $my_uploader = new uploader($_POST['language']);


                $my_uploader->max_filesize(16777216);  //16Mb

                $my_uploader->max_image_size(7500, 7500);

                if ($my_uploader->upload($upload_file_name, $acceptable_file_types, $default_extension)) {
                        $my_uploader->save_file($path, $mode);
                }

                if ($my_uploader->error) {
                        echo $my_uploader->error . "<br><br>\n";

                } else {

                        if(stristr($my_uploader->file['type'], "image")) {
                        echo "<a href='#22' onClick=\"javascript:rc('".  $sdir.$my_uploader->file['name'] . "','".round($my_uploader->file["size"]/1024)."')\"><img src=\"../images/ofb.png\" width=50 height=50 align='left' border=\"0\" title=\"".$lang[784]."\"></a><br>&lt;-- ".$lang[783]."<br>";
                        print($my_uploader->file['name'] . " - ".$lang[743]." $htpath/$fbase/$sdir <br>");
            } else {
                        print($my_uploader->file['name'] . " - ".$lang[743]." $htpath/$fbase/$sdir <br>");
                        echo "<a href='#22' onClick=\"javascript:rc('".  $sdir.$my_uploader->file['name'] . "','".round($my_uploader->file["size"]/1024)."')\"><img src=\"../images/ofb.png\" width=50 height=50 align='left' border=\"0\" title=\"".$lang[784]."\"></a><br>&lt;-- ".$lang[783]."<br><br><br><br>";

                                //$fp = fopen($path . $my_uploader->file['name'], "r");
                                //while(!feof($fp)) {
                                 //$line = fgets($fp, 255);
                                 //echo $line;
                                //}
                                //if ($fp) { fclose($fp); }
                        }
                 }
         }


echo "<form class=form-inline id=sform enctype='multipart/form-data' action='$htpath/admin/attachments.php' method='POST'>
        <input type='hidden' name='submitted' value=\"true\">
        <input type='hidden' name='perpage' value=\"$perpage\">
        <input type='hidden' name='dir' value=\"$dir\">
        <input type='hidden' name='start' value=\"$start\">
        <input type='hidden' name='dest' value=\"$dest\">
        <input type='hidden' name='speek' value=\"$speek\">
        <input type='hidden' name='language' value=\"$speek\">
        <input type='hidden' name='gtype' value=\"$gtype\">
        <div class=\"container\">
            <div class=\"row-fluid\">
                <div class=\"control-group\">
                    <div class=\"controls clearfix\">
                        <span class=\"btn btn-success btn-file\">
                            <i class=\"icon-plus\"></i> <span>".$lang[741]."...</span>
                            <input type=\"file\" name=\"" . $upload_file_name . "\" id=\"image\" />
                        </span>
                    </div>
                </div>
            </div>
        </div>
        </form>";

        if (isset($acceptable_file_types) && trim($acceptable_file_types)) {
                print("".$lang[740].": <b>" . str_replace("|", "</b>, <b>", $acceptable_file_types) . "</b>\n");
        }

//Выведем все картинки



$s=0;
echo "<br><br><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='".$nc5."'><b>".$lang[1557].":</b> <B><a href = '$htpath/admin/attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=9&dir=$dir'>9</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=18&dir=$dir'>18</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=30&dir=$dir'>30</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=60&dir=$dir'>60</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=90&dir=$dir'>90</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=900&dir=$dir'>900</a></B>
</small>
";

$handle=opendir("../$fbase/$sdir");
echo "../$fbase/$sdir";
while (($fileopen = readdir($handle))!==FALSE) {
//echo $fileopen." ".is_dir("../$fbase/$sdir".$fileopen)."<br>";
$typ= strtolower(substr($fileopen,-4));
if (($typ!=".jpg")&&($typ!="jpeg")&&($typ!=".gif")&&($typ!=".png")){

if (($fileopen!=".")&&($fileopen!="..")) {

if (is_dir("../$fbase/$sdir".$fileopen)==true) {
$fileopens[$s] = "<!--zzzzzz $fileopen-->
<td align='center' valign='top' width=".ceil(100/$gallery_cols)."%><small><br><a href=\"$htpath/admin/attach.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$sdir"."$fileopen\"><img src='../images/of_mini.png"."' border=0><br>$fileopen</a>
</small></td>";
$files_found += 1;
$s+=1;
} else {
$size = intval((filesize ("../$fbase/$sdir"."$fileopen"))/1024);
$fileopens[$s] = "<!--$fileopen-->
<td align='center' valign='top' width=".ceil(100/$gallery_cols)."%><small><br><a class=btn href=#insert onClick=\"javascript:rc('$fileopen')\">$lang[784]<br>$fileopen<br>[$size Kb]</a><br>
<a href='$htpath/admin/attach.php?dest=$dest&speek=$speek&gtype=$gtype&del=$fileopen&start=$start&perpage=$perpage&dir=$dir'><font color=#b94a48>X</font> ".$lang[383]."</a><br>
</small></td>";
$files_found += 1;
$s+=1;

}
}
} else {

$size = intval((filesize ("../$fbase/$sdir"."$fileopen"))/1024);
$imagesz = getimagesize("../$fbase/$sdir"."$fileopen");
                        $fwidth  = $imagesz[0];
                        $fheight = $imagesz[1];

$maxw=$gallery_maxwidth;
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
if ($widt>$maxw){$widt=$maxw;}
$zoom="<img src=\"$image_path/zoom.gif\" border=0 title=\"".$lang[140]."\" style=\"vertical-align: middle\">";
if (($fwidth<=$maxw)&&($fheight<=$maxw)){$maxw=$fwidth;$widt=$fheight; $zoom="";}

$wh="width=".$maxw." height=".$widt;
$ftyname=substr("$fileopen",0,(strlen("$fileopen")-strlen($typ)));

$fileopens[$s] = "<!--$fileopen-->
<td align='center' valign='top' width=".ceil(100/$gallery_cols)."%><small><br><a href='#".$lang[784]."' onClick=\"javascript:rc('".$sdir.$fileopen."','".$size."')\" title='".$lang[784]." $fileopen'>".wordwrap($fileopen,20,"\n",1)."</a><br>$fwidth x $fheight / $size Kb<br><a href='#".$lang[784]."' onClick=\"javascript:rc('$fileopen','".$size."')\"><img src='../$fbase/$sdir"."$fileopen' border=0 $wh title='".$lang[784]." $fileopen'></a>
<br>
<a href='$htpath/admin/attachments.php?dest=$dest&speek=$speek&gtype=$gtype&del=$fileopen&start=$start&perpage=$perpage&dir=$dir'><font color=#b94a48>X</font> ".$lang[383]."</a><br></small></td>";
$files_found += 1;
$s+=1;
}
}
closedir ($handle);
if ((!@$fileopens[0]) || (@$fileopens[0]=="")) {
	$fileopens[0]="";
	//$gal.="<a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&i=".rawurlencode($backurl)."\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10></a><a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&i=".rawurlencode($backurl)."\"><small><i>".$lang['back_to_higher_level']."</i></small></a><br><br><br>";
	} else {
//сортировка по алфавиту//
reset ($fileopens);
$gal="<table border=0 cellpadding=5 cellspacing=0 width=100%><tr bgcolor=$back>";

$make_col=$gallery_cols; //
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
$back=lighter($nc0,-5);
}

$val = $fileopens[($start+$st)]; //см выше

$st += 1;

$ddt += 1;
$gal .= "$val\n";
if ($ddt>=$gallery_cols) { $eee+=1; $ddt=0; $gal.="</tr></table><table border=0 cellpadding=5 cellspacing=0 width=100%><tr bgcolor=$back>";}
}

$gal.="</tr></table>";
$total = count ($fileopens)-$gt;
$numberpages = (ceil ($total/($perpage+0.000001)));

$startnew=$start+1;

$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;
$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($start+$perpage) . "&perpage=$perpage&dir=$dir\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=&dir=$dir\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($start-$perpage) . "&perpage=$perpage&dir=$dir\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
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
$pp.= "<a href = \"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($s*$perpage) . "&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($s*$perpage) . "&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($perpage*($numberpages-1)) . "&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }

}

$gal="<div align=center>$ppages<br><small><b>".$lang[783]."</b><br>".$lang[1558]."</small><br></div>
$gal";
if ($dir!="") {
$prevdir="";
$tmps=@explode("/",$dir);
@array_pop($tmps);
$prevdir=@implode("/",@$tmps);
$gal.="<br><div align=center><a href=\"attachments.php?dest=$dest&speek=$speek&gtype=$gtype&start=$start&perpage=$perpage&dir=$prevdir\"><img src=\"../images/ofb.png\" border=0><br>".$lang['back']."</a></div>";}
$gal.="<div align=center><br>$ppages<br><b>".$lang[783]."</b><br>".$lang[1558]."<br></div>\n";
echo $gal;

?></small></font></div>
<!--end-->
</body>
</html>
