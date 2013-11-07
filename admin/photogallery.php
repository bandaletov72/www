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
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>Gallery</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
";
$fold="..";
require ("../templates/$template/css.inc");
echo $css;
echo "<SCRIPT language=\"JavaScript1.1\">
<!--

function rc(image) {
  opener.document.form.foto1.value=\"<img src='$htpath/photogallery/\" + image + \"' border=0>\";
  window.alert(\"Image \\n\"+ image +\"\\nOK!!!\");
}
//-->
</SCRIPT>
</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
<small> ";

if ((!@$del) || (@$del=="")): $del=""; endif;
if ($del!="") {

echo "<b>File deleted:</b> $del<br>
<br>no way to restore<br><br>";

if (!unlink  ("../gallery/" . $del)) {
print ("File $del not found!<br>\n");
}
}
$del="";
if ((!@$perpage) || (@$perpage=="")): $perpage=20; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;


$next=$start+$perpage;
require ("../modules/translit.php");
require("fileupload-class.php");


        $path = "../gallery/";


        $upload_file_name = "userfile";


        $acceptable_file_types = "image/gif|image/jpeg|image/pjpeg";


        $default_extension = "";


        $mode = 2;

        if (isset($_REQUEST['submitted'])) {

                $my_uploader = new uploader($_POST['language']);


                $my_uploader->max_filesize(150000);

                $my_uploader->max_image_size(1500, 1500);

                if ($my_uploader->upload($upload_file_name, $acceptable_file_types, $default_extension)) {
                        $my_uploader->save_file($path, $mode);
                }

                if ($my_uploader->error) {
                        echo $my_uploader->error . "<br><br>\n";

                } else {

                        if(stristr($my_uploader->file['type'], "image")) {
                        echo "<a href='#22' onClick=\"javascript:rc('".  $my_uploader->file['name'] . "')\"><img src=\"" . $path . $my_uploader->file['name'] . "\" width=150 height=150 align='left' border=\"1\" title=\"Вставить этот файл в окно редактирования\"></a><br>Для вставки фото в окно редактирования просто щелкните на нем.<br><br><br><br>";
                        print($my_uploader->file['name'] . " load success!<br>");
            } else {
                        print($my_uploader->file['name'] . " load success!<br>");
                                $fp = fopen($path . $my_uploader->file['name'], "r");
                                while(!feof($fp)) {
                                        $line = fgets($fp, 255);
                                        echo $line;
                                }
                                if ($fp) { fclose($fp); }
                        }
                 }
         }


echo "<form enctype='multipart/form-data' action='$htpath/admin/photogallery.php' method='POST'>
        <input type='hidden' name='submitted' value='true'>
        <input type='hidden' name='perpage' value='$perpage'>
        <input type='hidden' name='start' value='$start'>

                File: <input name='" . $upload_file_name . "' type='file'>
                <input type='hidden' name='language' value='ru'>
<input type='submit' value='OK'>
        </form>";

        if (isset($acceptable_file_types) && trim($acceptable_file_types)) {
                print("Supported types:<br><b>" . str_replace("|", "</b> or <b>", $acceptable_file_types) . "</b>\n");
        }

//Выведем все картинки



$st=0;
echo "<br><br><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><b>$lang[738]:</b>
<br>Per page: <B><a href = '$htpath/admin/photogallery.php?start=0&amp;perpage=20'>20</a></B> | <B><a href = '$htpath/admin/photogallery.php?start=0&amp;perpage=40'>40</a></B> | <B><a href = '$htpath/admin/photogallery.php?start=0&amp;perpage=80'>80</a></B>
&lt;&lt; <B><a href = '$htpath/admin/photogallery.php?start=0&amp;perpage=$perpage'>home</a></B> | <B><a href = '$htpath/admin/photogallery.php?start=$next&amp;perpage=$perpage'next $perpage</a></B> &gt;&gt;</small>
<br><br>";
$val="<table width='100%'>";
$handle=opendir("../gallery/");
while (($fileopen = readdir($handle))!==FALSE) {
$typ= strtolower(substr($fileopen,-4));
if (($typ!=".jpg")&&($typ!="jpeg")&&($typ!=".gif")&&($typ!=".png")){
continue;
} else {
$size = intval((filesize ("../gallery/$fileopen"))/1024);
$imagesz = getimagesize("../gallery/$fileopen");
                        $fwidth  = $imagesz[0];
                        $fheight = $imagesz[1];
$fileopens[$st] = "<!--$fileopen-->
<td align='center' valign='top'><small><br><b>file:</b> $fileopen<br><b>pix:</b> $fwidth x $fheight | <b>size:</b> $size Kb<br><a href='#22' onClick=\"javascript:rc('$fileopen')\"><img src='../gallery/$fileopen' border=1 width=150 height=150></a>
<br>
<a href='$htpath/admin/photogallery.php?del=$fileopen&amp;start=$start&amp;perpage=$perpage'>".$lang[383]."</a><br></small><hr></td>";
$st += 1;
}
}
closedir ($handle);
if ((!@$fileopens[0]) || (@$fileopens[0]=="")): $fileopens[0]=""; echo "Files not found!<br><br><hr><center><b><b>Powered by:</b> <a href='http://www.eurowebcart.com'>Eurowebcart CMS</a> (c) Eurowebcart</small>"; exit; endif;
//сортировка по алфавиту//
sort ($fileopens);
reset ($fileopens);
$total = count ($fileopens);
$numberpages = (floor ($total/$perpage))+1;
$startnew=$start+1;
$end=$startnew + $perpage - 1;
$zt=0;
$st=0;
$pp="";
while ($st < $perpage) {
if (($start/$perpage)==$st) {
$pp.= "<b>" . ($st+1) . "</b> | ";
} else {
if ($total>=($st*$perpage)){
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?start=" . ($st*$perpage) . "&amp;perpage=$perpage\">" . ($st+1) . "</a> | ";
}
}

$val .= @$fileopens[($start+$st)];
$zt+=1;
if ($zt==3): $zt=0; $val.="</tr><tr>"; endif;
$st += 1;

}



$val.="</tr></table>";

echo"<center>$pp<br>$val$pp<br>".$lang[203]." <b>$numberpages</b><br>".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b> | <a href = '$htpath/admin/photogallery.php?start=$next&amp;perpage=$perpage'>Next $perpage &gt;&gt;</a></small><br>
";


?>
<br><br><hr><center><b>Powered by:</b> <a href=http://www.eurowebcart.com>EuroWebcart CMS</a> (c) Eurowebcart</small>
<!--end-->
</body>
</html>
