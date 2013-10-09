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
if (!isset($gtype)) {
$gtype=1;
}
if (!isset($dest)) {
$dest="";
}
$fold=".."; require ("../templates/lang.inc");
require ("../modules/translit.php");
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
require ("../templates/$template/css.inc");
$maxw=$gallery_maxwidth-40;

echo "
<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>Gallery</title>
<style fprolloverstyle>A:hover {color: #FF0000}
.di {
text-align: center;
width: ".($maxw+10)."px;
height: ".($maxw+60)."px;
overflow: hidden;
background: $nc0;
padding: 0px 0px 0px 0px;
}
.dim {
text-align: center;
width: ".($maxw-8)."px;
height: ".($maxw+16)."px;
overflow: hidden;
cursor:pointer;
cursor: hand;
padding: 0px 0px 0px 0px;
}
.dit {
text-align: center;
font-size:11px;
width: ".($maxw).";
padding: 0px 0px 0px 0px;
}
</style>
$css
";
if ((!@$dir) || (@$dir=="")): $dir=""; endif;
if ((!@$field_name) || (@$field_name=="")): $field_name=""; endif;
$sdir="";
if ($dir!="") {$sdir=$dir."/";}
$fold="..";

$back=$nc0;
echo "<!-- $gtype-$dest --><SCRIPT language=\"JavaScript1.1\">
<!--
var ww='0';
var hh='0';
function rc(image,x,y) {
	";
if   ($gtype==1) {$fbase=$fotobasesmall; if ($dest=="") {
echo "opener.document.form.foto1.value=\"<img src='$htpath/".$fbase."/".$sdir."\" + image + \"' border=0>\";
opener.document.getElementById('smallimg').src='$htpath/".$fbase."/".$sdir."' + image + '';
";} else {
echo"  opener.document.getElementById('el_".$dest."').value=\"<img src='".$htpath."/$fbase/".$sdir."\" + image + \"' border=0>\";
";}}
if   ($gtype==2) {$fbase=$fotobasebig; if ($dest=="") { echo "opener.document.form.foto2.value+=\"<img src='$htpath/".$fbase."/".$sdir."\" + image + \"' border=0><br>\";
";} else {echo"  opener.document.getElementById('el_".$dest."').value=\"<img src='".$htpath."/$fbase/".$sdir."\" + image + \"' border=0>\";
";} }
if   ($gtype==4) {$fbase="uploads"; if ($dest=="textar") {echo "opener.document.getElementById('textarea').value+=\"[img]".$htpath."/$fbase/".$sdir."\" + image + \"[/img]\\n\";
";} else { echo "opener.document.getElementById('".$dest."').value+=\"<img src='".$htpath."/$fbase/".$sdir."\" + image + \"'>\";
"; }}
if   ($gtype==3) {$fbase="catimg"; echo "opener.document.getElementById('el_".$dest."').value=\"<img src=".$htpath."/catimg/".$sdir."\" + image + \" border=0>\";
opener.document.getElementById('img_".$dest."').src=\"".$htpath."/catimg/\" + image;
  ";}
  if   ($gtype==5) {$fbase=""; echo "
top.tinymce.activeEditor.windowManager.getParams().oninsert(\"".$htpath."/".$sdir."\" + image, 'image', x+'x'+y, x, y);
 }
function myAlert() {
  ";}

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

echo "<b>".$lang[257]."</b> $del<br>
".$lang[438]."";



if (!unlink  ("../$fbase/$sdir" . $del)) {
print ("$del not found!<br>\n");
}
}
$del="";
$make_col=$lastgoods_cols;
$st=0;
if ((!@$perpage) || (@$perpage=="")): $perpage=50; endif;
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


        $acceptable_file_types = "image/gif|image/jpeg|image/pjpeg|image/png";


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
                        echo "<a href='#22' onClick=\"javascript:rc('".  $sdir.$my_uploader->file['name'] . "', '".$my_uploader->file['width']."' , '".$my_uploader->file['height']."')\"><img src=\"" . $path . $my_uploader->file['name'] . "\" width=50 height=50 align='left' border=\"1\" title=\"".$lang[784]."\"></a><br>&lt;-- ".$lang[783]."<br>";
                        print($my_uploader->file['name'] . " - ".$lang[743]." $htpath/$fbase/$sdir <br>");
            } else {

                       echo "<a class=\"btn\" href='#22' onClick=\"javascript:rc('".  $sdir.$my_uploader->file['name'] . "', '".$my_uploader->file['width']."' , '".$my_uploader->file['height']."')\"><font color=3>".$lang[784]."</font><br>" . $my_uploader->file['name'] . "</a><br><br>";


                        }
                 }
         }


echo "<form class=form-inline id=sform enctype='multipart/form-data' action='$htpath/admin/newgal.php' method='POST'>
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
echo "<br><br><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><b>".$lang[786].":</b> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=9&dir=$dir'>9</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=18&dir=$dir'>18</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=30&dir=$dir'>30</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=60&dir=$dir'>60</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=90&dir=$dir'>90</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=900&dir=$dir'>900</a></B>
</small>
";

$handle=opendir("../$fbase/$sdir");
while (($fileopen = readdir($handle))!==FALSE) {
//echo $fileopen." ".is_dir("../$fbase/$sdir".$fileopen)."<br>";
$typ= strtolower(substr($fileopen,-4));
if (($typ!=".jpg")&&($typ!="jpeg")&&($typ!=".gif")&&($typ!=".png")){

if ((is_dir("../$fbase/$sdir".$fileopen)==true)&&($fileopen!=".")&&($fileopen!="..")&&($fileopen!="css")&&($fileopen!="js")&&($fileopen!="admin")&&($fileopen!="templates")&&($fileopen!="blog")&&($fileopen!="chat")&&($fileopen!="classifieds")&&($fileopen!="captcha")&&($fileopen!="userdir")&&($fileopen!="poll")&&($fileopen!="payment_modules")&&($fileopen!="payment_results")&&($fileopen!="modules")&&($fileopen!="widgets")&&($fileopen!="fancybox")&&($fileopen!="comments")&&($fileopen!="forum")&&($fileopen!="gooddesc")&&($fileopen!="uploadify")&&($fileopen!="poll")&&($fileopen!="rss")) {
//if ($dir=="") {
$fileopens[$s] = "<!--0000001 $fileopen-->
<div class=\"pull-left di\"><a href=\"$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$sdir"."$fileopen\">
<div class=\"img dim\" ><img src='../images/of_mini.png"."' border=0><div class=dit>$fileopen</div></div></a></div>";
$files_found += 1;
$s+=1;
//}
}
continue;
} else {
$fff=str_replace("//","/", str_replace("//","/", "../$fbase/$sdir"."$fileopen"));
$size = intval((filesize ($fff))/1024);
$imagesz = getimagesize($fff);
$fwidth  = $imagesz[0];
$fheight = $imagesz[1];
$widt=($maxw-8);
$hei=($maxw-8);
//echo $fwidth."x".$fheight."<br>";
$case=0;
$sty="";
if ($fwidth>=$fheight) {
if ($fheight>$maxw){$widt=($maxw-8); $hei=(round($fheight/($fwidth/$maxw))-8);  $case=1; }
if ($fheight<=$maxw){$widt=($maxw-8); $hei=(round($fheight/($fwidth/$maxw))-8); $case=2;}
} else {
if ($fheight>$maxw){$hei=($maxw-8); $widt=(round($maxw/($fheight/$fwidth))-8);  $case=3; }
if ($fheight<=$maxw){$hei=($maxw-8); $widt=(round($maxw/($fheight/$fwidth))-8);  $case=4; }

}
$zoom="<img src=\"$image_path/zoom.gif\" border=0 title=\"".$lang[140]."\" style=\"vertical-align: middle\">";

$wh="width=".$widt." height=".$hei;
$ftyname=substr("$fileopen",0,(strlen("$fileopen")-strlen($typ)));

$fileopens[$s] = "<!--$fileopen-->
<div class=\"pull-left di\">
<div class=\"img dim\" style=\"margin-bottom: 0px;\" onClick=\"javascript:rc('$fileopen','".$fwidth."' ,'".$fheight."')\" title='$fwidth x $fheight / $size Kb\n".$lang[784]." $fileopen'>
<a href='#".$lang[784]."'><img src='$fff'".$sty." border=0 $wh>
<div class=dit>".$fileopen."</div>
</a>
</div>
<div class=\"dit lnk\" style=\"margin-top: 8px;\">
<a href='$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&del=$fileopen&start=$start&perpage=$perpage&dir=$dir'><i class=icon-remove></i> ".$lang[744]."</a>
</div>
</div>";
$files_found += 1;
$s+=1;
}
}
closedir ($handle);
if ((!@$fileopens[0]) || (@$fileopens[0]=="")) {
	$fileopens[0]="";
	//$gal.="<a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&i=".rawurlencode($backurl)."\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10></a><a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&i=".rawurlencode($backurl)."\"><small><i>".$lang['back_to_higher_level']."</i></small></a><br><br><br>";
	} else {
//сортировка по алфавиту//
reset ($fileopens);
$gal="";

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
if ($ddt>=$gallery_cols) { $eee+=1; $ddt=0;}
}

$total = count ($fileopens)-$gt;
$numberpages = (ceil ($total/($perpage+0.000001)));

$startnew=$start+1;

$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;
if ($dir!="") {
$prevdir="";
$tmps=@explode("/",$dir);
@array_pop($tmps);
$prevdir=@implode("/",@$tmps);
$gal="<div class=\"pull-left di\"><a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=$start&perpage=$perpage&dir=$prevdir\">
<div class=\"img dim\"><div align=center><br><br><img src=\"../images/ofb.png\" border=0><br>".$lang['back']."</div></div></a></div>$gal";
}
$gal.="<div class=clearfix></div>";
$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($start+$perpage) . "&perpage=$perpage&dir=$dir\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=&dir=$dir\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($start-$perpage) . "&perpage=$perpage&dir=$dir\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
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
$pp.= "<a href = \"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($s*$perpage) . "&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($s*$perpage) . "&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($perpage*($numberpages-1)) . "&perpage=$perpage&dir=$dir\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }

}

$gal="<div align=center>$ppages<br><small><b>".$lang[783]."</b><br>".$lang[785]."</small><br></div>
$gal";

$gal.="<div align=center><br>$ppages<br><b>".$lang[783]."</b><br>".$lang[785]."<br></div>\n";
echo $gal;

?></small></font>
<!--end-->
</div>
</body>
</html>
