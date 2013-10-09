<!DOCTYPE html><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"><title>GALLERY</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
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
$fold="..";
require ("../templates/$template/css.inc");
echo "<SCRIPT language=\"JavaScript1.1\">
<!--

function rc(image) {
  opener.document.form.foto1.value=\"<img src='$htpath/".$fotobasesmall."/\" + image + \"' border=0>\";
  window.alert(\"Image \\n\"+ image +\"\\nadded.\");
}
//-->
</SCRIPT>
</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
<small> ";

if ((!@$del) || (@$del=="")): $del=""; endif;
if ($del!="") {

echo "<b>Был удален файл с именем:</b> $del<br>
<br>Восстановление невозможно<br><br>";

if (!unlink  ("../$fotobasesmall/" . $del)) {
print ("$del not found!<br>\n");
}
}
$del="";
$perpage=10000;
$start=0;


$next=$start+$perpage;

require("fileupload-class.php");


        $path = "../$fotobasesmall/";


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
                        echo "<a href='#22' onClick=\"javascript:rc('".  $my_uploader->file['name'] . "')\"><img src=\"" . $path . $my_uploader->file['name'] . "\" align='left' border=\"1\" title=\"Вставить этот файл в окно редактирования\"></a><br>Для вставки фото в окно редактирования просто щелкните на нем.<br><br><br><br>";
                        print($my_uploader->file['name'] . " успешно загружен на сервер!<br>");
            } else {
                        print($my_uploader->file['name'] . " успешно загружен на сервер!<br>");
                                $fp = fopen($path . $my_uploader->file['name'], "r");
                                while(!feof($fp)) {
                                        $line = fgets($fp, 255);
                                        echo $line;
                                }
                                if ($fp) { fclose($fp); }
                        }
                 }
         }


/* echo "<form enctype='multipart/form-data' action='$htpath/admin/forprint.php' method='POST'>
        <input type='hidden' name='submitted' value='true'>
        <input type='hidden' name='perpage' value='$perpage'>
        <input type='hidden' name='start' value='$start'>

                Имя файла: <input name='" . $upload_file_name . "' type='file'>
                <input type='hidden' name='language' value='ru'>
<input type='submit' value='Загрузить'>
        </form>";

        if (isset($acceptable_file_types) && trim($acceptable_file_types)) {
                print("Разрешены к загрузке следующие типы файлов:<br><b>" . str_replace("|", "</b> или <b>", $acceptable_file_types) . "</b>\n");
        }
 */
//Выведем все картинки



$st=0;
$val="<table width='100%'><tr>";
$handle=opendir("../$fotobasesmall/");
while (($fileopen = readdir($handle))!==FALSE) {
If (($fileopen == '.') || ($fileopen == '..')) {
continue;
} else {
$size = intval((filesize ("../$fotobasesmall/$fileopen"))/1024);
$imagesz = getimagesize("../$fotobasesmall/$fileopen");
                        $fwidth  = floor($imagesz[0]/2);
                        $fheight = floor($imagesz[1]/2);
if ($fwidth>80): $fwidth=80; endif;
@$fileopens[$st] = "<!--$fileopen-->
<td align='center' valign='top'><small><a href=\"#22\" onclick=\"window.open('http://www.evalux.ru/$fotobasebig/$fileopen','".strtoupper(str_replace(".jpg", "", $fileopen))."','statusbar=no,menubar=no,toolbar=no,scrollbars=yes,resizable=yes,width=560,height=".((550*$fheight/$fwidth)+20)."'); return false;\"><img src='../$fotobasesmall/$fileopen' border=1 width=$fwidth height=$fheight alt='".strtoupper(str_replace(".jpg", "", $fileopen))."'></a>
<br><b>".strtoupper(str_replace(".jpg", "", $fileopen))."</b><br><br>
Длина:_________<br><br>
Высота:_________<br><br>
В.с ручк.:_______<br><br>
Толщ.:__________<br><br>
Осн.отделов:____<br><br>
Карманов:_______<br><br>
Ремень:_________<br><br>
Феньки:_________<br><br>
________________<br>
</small></td>";
$st += 1;
}
}
closedir ($handle);
if ((!@$fileopens[0]) || (@$fileopens[0]=="")): $fileopens[0]=""; echo "Not found!<br><br><hr><center><b><b>Powered by:</b> <a href='http://www.eurowebcart.com'>Eurowebcart CMS</a> (c) Eurowebcart</small>"; exit; endif;
//сортировка по алфавиту//
sort ($fileopens);
reset ($fileopens);
$total = count ($fileopens);
$numberpages = (floor ($total/$perpage))+1;
$startnew=$start+1;
$end=$startnew + $perpage - 1;
$zt=0;
$pag=0;
$rt=0;
$st=0;
$pp="";

while ($st < $total) {
if (($start/$perpage)==$st) {
$pp.= "<b>" . ($st+1) . "</b> | ";
} else {
if ($total>=($st*$perpage)){
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?start=" . ($st*$perpage) . "&perpage=$perpage\">" . ($st+1) . "</a> | ";
}
}

$val .= @$fileopens[($start+$st)];
$zt+=1;
if ($zt==6): $rt+=1; if($rt==3){$rt=0; $pag+=1; $razriv="<table width=100%><tr><td><b>$pag.</b></td><td width=100%><hr></td></tr></table><br clear=all style='page-break-before:always'>";} else {$razriv="";} $zt=0; $val.="</tr></table>$razriv<table width=100%><tr>"; endif;
$st += 1;

}



$val.="</tr></table>";

echo "$val";


?>
<!--end-->
</body>
</html>

