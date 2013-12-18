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
$fold="../.."; require ("../../templates/lang.inc");
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

require ("../../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../../templates/$template/$speek/config.inc");

$fold="../..";
require ("../../templates/$template/css.inc");
echo" <html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"><title>Галерея картинок</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>$css
<SCRIPT language=\"JavaScript1.1\">
<!--

function rc(image) {
  opener.document.form.img.value=\"<img src='$htpath/uploads/\" + image + \"' align='left'>\";

}
//-->
</SCRIPT>
</head>
<BODY background='new/a1.gif' onload=\"javascript:self.focus()\" text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">
<small>
";

if ((!@$del) || (@$del=="")): $del=""; endif;
if ($del!="") {

echo "<b>Был удален файл с именем:</b> $del<br>
<br>Восстановление невозможно<br><br>";

if (!unlink  ("../../uploads/" . $del)) {
print ("$del not found!<br>\n");
}
}
$del="";
if ((!@$perpage) || (@$perpage=="")): $perpage=20; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;


$next=$start+$perpage;

require("fileupload-class.php");


        $path = "../../uploads/";


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
                        echo "<a href=\"javascript:window.opener.obj1.InsertImage('$htpath/uploads/" .$my_uploader->file['name']. "','',document.forms[1].palign.value,'0','','','10','10')\"><img src=\"" . $path . $my_uploader->file['name'] . "\" width=150 height=150 align='left' border=\"1\" title=\"Вставить этот файл в окно редактирования\"></a><br>Для вставки фото в окно редактирования просто щелкните на нем.<br><br><br><br>";
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


echo "<form enctype='multipart/form-data' action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
        <input type='hidden' name='submitted' value='true'>
        <input type='hidden' name='perpage' value='$perpage'>
        <input type='hidden' name='start' value='$start'>

                Имя файла: <input name='" . $upload_file_name . "' type='file'>
                <input type='hidden' name='language' value='ru'>
<input type='submit' value='Загрузить'>
        </form><form>Расположение текста с рисунком: <select name=\"palign\" size=\"1\"><option selected value=\"left\">Справа от рисунка</option><option value=\"right\">Слева от рисунка</option><option value=\"center\">Посередине</option></select></form>";

        if (isset($acceptable_file_types) && trim($acceptable_file_types)) {
                print("Разрешены к загрузке следующие типы файлов:<br><b>" . str_replace("|", "</b> или <b>", $acceptable_file_types) . "</b>\n");
        }

//Выведем все картинки

$kav = chr(34);
$kavjavascript = chr(34) . "javascript";
$kavuploads = chr(34) . "uploads";

$st=0;
echo "<br><br><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><b>Список картинок:</b>
<br>Количество картинок на странице: <B><a href = '" . $_SERVER['PHP_SELF'] . "?start=0&perpage=20'>20</a></B> | <B><a href = '" . $_SERVER['PHP_SELF'] . "?start=0&perpage=40'>40</a></B> | <B><a href = '" . $_SERVER['PHP_SELF'] . "?start=0&perpage=80'>80</a></B>
&lt;&lt; <B><a href = '" . $_SERVER['PHP_SELF'] . "?start=0&perpage=$perpage'>в начало</a></B> | <B><a href = '" . $_SERVER['PHP_SELF'] . "?start=$next&perpage=$perpage'>следующие $perpage</a></B> &gt;&gt;</small>
<br><br>
<table width='100%'>
";
$handle=opendir('../../uploads/');
while (($fileopen = readdir($handle))!==FALSE) {
If (($fileopen == '.') || ($fileopen == '..')) {
continue;
} else {
$size = intval((filesize ("../../uploads/$fileopen"))/1024);
$imagesz = getimagesize("../../uploads/$fileopen");
                        $fwidth  = $imagesz[0];
                        $fheight = $imagesz[1];
$fileopens[$st] = "<!--$fileopen-->
<td align='center' valign='top'><small><br><b>file:</b> $fileopen<br><b>pix:</b> $fwidth x $fheight | <b>size:</b> $size Kb<br><a href=\"javascript:window.opener.obj1.InsertImage('$htpath/uploads/$fileopen','Image',document.forms[1].palign.value,'0','','','10','10')\"><img src='../../uploads/$fileopen' border=1 width=150 height=150 alt='Вставить фото $fileopen ($size Kb) в окно редактирования'></a>
<br>
<a href='" . $_SERVER['PHP_SELF'] . "?del=$fileopen&start=$start&perpage=$perpage'>".$lang['del']."</a><br></small><hr noshade color='#0069DD' size='1'></td>";
$st += 1;
}
}
closedir ($handle);
if ((!@$fileopens[0]) || (@$fileopens[0]=="")): $fileopens[0]=""; echo "Not found!<br><br><hr noshade color='#0069DD' size='1'><center>b>Powered by:</b> <a href=http://www.eurowebcart.com>EuroWebcart CMS</a> (c) Eurowebcart</small>"; exit; endif;
//сортировка по алфавиту//
sort ($fileopens);
reset ($fileopens);
$total = count ($fileopens);
$numberpages = (floor ($total/$perpage))+1;
$startnew=$start+1;
$end=$startnew + $perpage - 1;
$zt=0;
$st=0;
while ($st < $perpage) {
if ((!@$fileopens[($start+$st)]) || (@$fileopens[($start+$st)]=="")): $fileopens[($start+$st)]=""; break; break; endif;
if ((!@$fileopens[($start+$st+3)]) || (@$fileopens[($start+$st+3)]=="")): $fileopens[($start+$st+3)]=""; endif;
if ((!@$fileopens[($start+$st+2)]) || (@$fileopens[($start+$st+2)]=="")): $fileopens[($start+$st+2)]=""; endif;
if ((!@$fileopens[($start+$st+1)]) || (@$fileopens[($start+$st+1)]=="")): $fileopens[($start+$st+1)]=""; endif;
$val = $fileopens[($start+$st)] . $fileopens[($start+$st+1)] . $fileopens[($start+$st+2)] . $fileopens[($start+$st+3)];
$zt += 1;
$st += 4;
if (is_long(($zt/2)) == "TRUE") {
$back="#FFFFFF";
} else {
$back="#F8F8F8";
}
echo "<tr bgcolor='$back'>$val\n</tr>";
}



echo "</table>
<center><br>".$lang[203]." <b>$numberpages</b><br>".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b> | <a href = '" . $_SERVER['PHP_SELF'] . "?start=$next&perpage=$perpage'>NEXT $perpage &gt;&gt;</a></small><br>
";


?>
<br><br><hr noshade color='#0069DD' size='1'><center>b>Powered by:</b> <a href=http://www.eurowebcart.com>EuroWebcart CMS</a> (c) Eurowebcart</small>
<!--end-->
</body>
</html>

