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

$ppages="";
$ggal="";
$gal="";
$dires=Array();
$fileopens=Array();
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
width: ".($micro_foto_width+12)."px;
height: ".($micro_foto_height+40)."px;
overflow: hidden;
background: $nc0;
padding: 4px 4px 4px 4px;
margin-right:10px;
margin-bottom:10px;
}
.dim {
text-align: center;
height: ".($micro_foto_height+16)."px;
width: ".($micro_foto_width+10)."px;
overflow: hidden;
cursor:pointer;
cursor: hand;
padding: 0px 0px 0px 0px;
}
.dit {
text-align: center;
font-size:11px;
width: ".($micro_foto_width-20)."px;
padding: 0px 0px 0px 0px;
}
.dele {
background: rgba(255,0,0,0.35)
}
</style>
$css
";
if ((!@$dir) || (@$dir=="")): $dir=""; endif;
if ((!@$fsort) ||(@$fsort=="")): $fsort="name"; endif;
if ((!@$fway) ||(@$fway=="")): $fway="up"; endif;
if ((!@$field_name) || (@$field_name=="")): $field_name=""; endif;
$sdir="";
if ($dir!="") {$sdir=$dir."/";}
$fold="..";

$back=$nc0;
echo "<!-- $gtype-$dest --><SCRIPT language=\"JavaScript1.1\">
<!--
var ww='0';
var hh='0';
var cc=0;
function submitform() {
if (cc>0) {
document.getElementById('submitdiv').className='round3 dele';
}
}
function closediv() {

document.getElementById('submitdiv').className='hidden';

}
function chk(id) {
if(document.getElementById('box'+id).checked==true) {
document.getElementById('di'+id).className='pull-left di img thumbnail dele muted';
document.getElementById('submitb').className='btn btn-danger';
;
cc++;
document.getElementById('ss').innerHTML=cc
} else {
document.getElementById('di'+id).className='pull-left di img thumbnail';
cc--;
document.getElementById('ss').innerHTML=cc;
if (cc==0) {
document.getElementById('submitb').className='hidden';
document.getElementById('submitdiv').className='hidden';
}
}
}
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
if   ($gtype==3) {$fbase=""; echo "opener.document.getElementById('el_".$dest."').value=\"<img src=".$htpath."/$fbase/".$sdir."\" + image + \" border=0>\";
opener.document.getElementById('img_".$dest."').src=\"".$htpath."/$fbase/".$sdir."\" + image;
  ";}
  if   ($gtype==99) {$fbase="gallery/backgrounds"; echo "opener.document.getElementById('el_".$dest."').value=\"".$htpath."/$fbase/".$sdir."\" + image;
opener.document.getElementById('main_background').style.backgroundImage=\"url(\"+\"".$htpath."/$fbase/".$sdir."\" + image+\")\";
opener.document.getElementById('main_background').style.backgroundRepeat='repeat repeat';
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

echo "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><strong>".$lang[257]."</strong>";

if (isset($_POST['box'])) {
if (is_array($_POST['box'])) {
while(list($key,$v)=each($_POST['box'])) {

if (!unlink  ("../$fbase/$sdir" . stripslashes(trim($v)))) {
echo "<div class=small>../$fbase/$sdir"."$v - ".$lang[447]."</div>";
} else {
echo "<div class=small>../$fbase/$sdir"."$v - ".$lang[437]."</div>";
}
}
}
}
echo "</div>";
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
                        echo "<a href='#22' onClick=\"javascript:rc('".  $my_uploader->file['name'] . "', '".$my_uploader->file['width']."' , '".$my_uploader->file['height']."')\"><img src=\"" . $path . $my_uploader->file['name'] . "\" width=50 height=50 align='left' border=\"1\" title=\"".$lang[784]."\"></a><br>&lt;-- ".$lang[783]."<br>";
                        print($my_uploader->file['name'] . " - ".$lang[743]." $htpath/$fbase/$sdir <br>");
            } else {

                       echo "<a class=\"btn\" href='#22' onClick=\"javascript:rc('".  $my_uploader->file['name'] . "', '".$my_uploader->file['width']."' , '".$my_uploader->file['height']."')\"><font color=3>".$lang[784]."</font><br>" . $my_uploader->file['name'] . "</a><br><br>";


                        }
                 }
         }


echo "
        <div class=\"pull-right mr\"><button id=submitb class=\"hidden\" onclick=submitform();><i class=\"icon-remove icon-white\"></i> $lang[744] <span id=ss>0</span> ".$lang['pcs']."</button></div><form class=form-inline id=sform enctype='multipart/form-data' action='$htpath/admin/newgal.php' method='POST'>
        <input type='hidden' name='submitted' value=\"true\">
        <input type='hidden' name='perpage' value=\"$perpage\">
        <input type='hidden' name='dir' value=\"$dir\">
        <input type='hidden' name='start' value=\"$start\">
        <input type='hidden' name='fsort' value=\"$fsort\">
        <input type='hidden' name='fway' value=\"$fway\">
        <input type='hidden' name='dest' value=\"$dest\">
        <input type='hidden' name='speek' value=\"$speek\">
        <input type='hidden' name='language' value=\"$speek\">
        <input type='hidden' name='gtype' value=\"$gtype\"><div class=\"container\">
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
        </form><div class=hidden id=submitdiv align=center><h4>$lang[746]</h4><button class=\"btn btn-danger btn-large\" onclick=\"document.getElementById('subform').submit();\">".$lang['yes']."</button> &nbsp;&nbsp;&nbsp; <button class=\"btn btn-large\" onclick=\"closediv();\">".$lang['no']."</button></div>";

        if (isset($acceptable_file_types) && trim($acceptable_file_types)) {
                print("".$lang[740].": <b>" . str_replace("|", "</b>, <b>", $acceptable_file_types) . "</b>\n");
        }

//Выведем все картинки

echo "<form class=form-inline action='$htpath/admin/newgal.php' method='POST' id=subform>
        <input type='hidden' name='perpage' value=\"$perpage\">
        <input type='hidden' name='dir' value=\"$dir\">
        <input type='hidden' name='start' value=\"$start\">
        <input type='hidden' name='fsort' value=\"$fsort\">
        <input type='hidden' name='fway' value=\"$fway\">
        <input type='hidden' name='dest' value=\"$dest\">
        <input type='hidden' name='speek' value=\"$speek\">
        <input type='hidden' name='language' value=\"$speek\">
        <input type='hidden' name='del' value=\"YES\">
        <input type='hidden' name='gtype' value=\"$gtype\">";

$s=0;
$bn1="";  $bn2="";
$bn3=""; $bn4="";
$bn5=""; $bn6="";
$bn7=""; $bn8="";
if ($fsort=="name") { $bn1="<b class=label>";  $bn2="</b>"; $bn3="<a href='$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir&fsort=date&fway=$fway'>";  $bn4="</a>"; } else {  $bn3="<b class=label>";  $bn4="</b>"; $bn1="<a href='$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir&fsort=name&fway=$fway'>";  $bn2="</a>";   }
if ($fway=="up") { $bn5="<b class=label>";  $bn6="</b>"; $bn7="<a href='$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir&fsort=$fsort&fway=down'>";  $bn8="</a>"; } else {  $bn7="<b class=label>";  $bn8="</b>"; $bn5="<a href='$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir&fsort=$fsort&fway=up'>";  $bn6="</a>";   }
echo "<br><font size='2'><b>".$lang['sort_by'].":</b> $bn1".$lang['by_name']."$bn2 | $bn3".$lang['by_date']."$bn4 &nbsp;&nbsp;&nbsp; $bn5".$lang['down']."$bn6 | $bn7".$lang['up']."$bn8<br><b>".$lang[786].":</b> <B><a href='$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=9&dir=$dir&fsort=$fsort&fway=$fway'>9</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=18&dir=$dir&fsort=$fsort&fway=$fway'>18</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=30&dir=$dir&fsort=$fsort&fway=$fway'>30</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=60&dir=$dir&fsort=$fsort&fway=$fway'>60</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=90&dir=$dir&fsort=$fsort&fway=$fway'>90</a></B> <img src=\"$image_path/a.gif\"> <B><a href = '$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=900&dir=$dir&fsort=$fsort&fway=$fway'>900</a></B>
</small>
";

$handle=opendir("../$fbase/$sdir");
while (($fileopen = readdir($handle))!==FALSE) {
//echo $fileopen." ".is_dir("../$fbase/$sdir".$fileopen)."<br>";
$typ= strtolower(substr($fileopen,-4));
if (($typ!=".jpg")&&($typ!="jpeg")&&($typ!=".gif")&&($typ!=".png")){

if ((is_dir("../$fbase/$sdir".$fileopen)==true)&&($fileopen!=".")&&($fileopen!="..")&&($fileopen!="css")&&($fileopen!="js")&&($fileopen!="admin")&&($fileopen!="templates")&&($fileopen!="blog")&&($fileopen!="chat")&&($fileopen!="classifieds")&&($fileopen!="captcha")&&($fileopen!="userdir")&&($fileopen!="poll")&&($fileopen!="payment_modules")&&($fileopen!="payment_results")&&($fileopen!="modules")&&($fileopen!="widgets")&&($fileopen!="fancybox")&&($fileopen!="comments")&&($fileopen!="forum")&&($fileopen!="gooddesc")&&($fileopen!="uploadify")&&($fileopen!="poll")&&($fileopen!="rss")) {
//if ($dir=="") {
if ($fsort=="name") {$sortby=strtolower($fileopen); } else { $sortby=filemtime("../$fbase/$sdir".$fileopen); }
$dires[$s] = "<!--$sortby-->
<div class=\"pull-left di img thumbnail\"><a href=\"$htpath/admin/newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&fsort=$fsort&fway=$fway&dir=$sdir"."$fileopen\">
<div class=\"dim\" ><img src='../images/of_mini.png"."' border=0><div class=dit style=\"width:$micro_foto_width"."px\">$fileopen</div></div></a></div>";
$files_found += 1;
$s+=1;
//}
}
continue;
} else {
$fff=str_replace("//","/", str_replace("//","/", "../$fbase/$sdir"."$fileopen"));
$size = intval((filesize ($fff))/1024);

//echo $fwidth."x".$fheight."<br>";
$sty="";
$zoom="<img src=\"$image_path/zoom.gif\" border=0 title=\"".$lang[140]."\" style=\"vertical-align: middle\">";

$wh="";
$ftyname=substr("$fileopen",0,(strlen("$fileopen")-strlen($typ)));
if ($fsort=="name") {$sortby=strtolower($fileopen); $ssortby=""; } else {
$sortby=filemtime("../$fbase/$sdir".$fileopen);
$dateformat=str_replace("y", "Y", str_replace("dd", "d",str_replace("mm", "m",str_replace("yy", "y", str_replace("yy", "y", $ewc_dateformat)))));
$ssortby=date($dateformat." H:i:s",$sortby); }
$fileopens[$s] = "<!--$sortby-->
<div class=\"pull-left di img thumbnail\" id=di$s>
<div style=\"margin-bottom: 0px; text-align: center;\" >
<a href='#".$lang[784]."' onClick=\"javascript:rc('$fileopen','' ,'')\"><div class=dim><img src='$fff' class=\"span14\" border=0 title='$size Kb\n".$lang[784]." $fileopen\n$ssortby'></div></a>
<div class=clearfix></div>
<span class=\"dit nowrap\"><input autocomplete=\"off\" type=checkbox name=box[$s] id=box$s value='$fileopen' onclick=chk($s);> ".$fileopen."</span>
</div>
</div>";
$files_found += 1;
$s+=1;
}
}
closedir ($handle);
//сортировка по алфавиту//
@reset ($fileopens);
@reset ($dires);
$gal="";

$make_col=$gallery_cols; //
$st=0;
$ddt=0;
if ($fway=="up") {
@sort($dires);
@sort($fileopens);
} else {
@sort($dires);
@sort($fileopens);
$res_tmp=array_reverse($dires);
unset($dires);
$dires=$res_tmp;
unset($res_tmp);
$res_tmp=array_reverse($fileopens);
unset($fileopens);
$fileopens=$res_tmp;
unset($res_tmp);
}
$tmpf2=$fileopens;
unset($fileopens);
$fileopens=@array_merge(@$dires,@$tmpf2);
unset ($tmpf2);
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
$gal="<div class=\"pull-left di\"><a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=$start&perpage=$perpage&dir=$prevdir&fsort=$fsort&fway=$fway\">
<div class=\"img dim\"><div align=center><br><br><img src=\"../images/ofb.png\" border=0><br>".$lang['back']."</div></div></a></div>$gal";
}
$gal.="<div class=clearfix></div>";
$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($start+$perpage) . "&perpage=$perpage&dir=$dir&fsort=$fsort&fway=$fway\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=&dir=$dir&fsort=$fsort&fway=$fway\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($start-$perpage) . "&perpage=$perpage&dir=$dir&fsort=$fsort&fway=$fway\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
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
$pp.= "<a href = \"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($s*$perpage) . "&perpage=$perpage&dir=$dir&fsort=$fsort&fway=$fway\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($s*$perpage) . "&perpage=$perpage&dir=$dir&fsort=$fsort&fway=$fway\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir&fsort=$fsort&fway=$fway\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=0&perpage=$perpage&dir=$dir&fsort=$fsort&fway=$fway\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"newgal.php?dest=$dest&speek=$speek&gtype=$gtype&start=" . ($perpage*($numberpages-1)) . "&perpage=$perpage&dir=$dir&fsort=$fsort&fway=$fway\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }



$gal="<div align=center>$ppages<br><small><b>".$lang[783]."</b><br>".$lang[785]."</small><br></div>
$gal";

$gal.="</form><div align=center><br>$ppages<br><b>".$lang[783]."</b><br>".$lang[785]."<br></div>\n";
echo $gal;
?></small></font>
<!--end-->
</div>
</body>
</html>
