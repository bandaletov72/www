<?php
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Expires: Mon, 29 Jul 1985 05:00:00 GMT'); // Прошлое время
header('Pragma: no-cache');
header('Content-Type: text/plain'); // просто текстовый файл
if(isset($_GET['file'])) $file=$_GET['file']; elseif(isset($_POST['file'])) $file=$_POST['file']; else $file="";
$file="./backups/$file";
if (!file_exists($file)) {
echo "ERROR! $file NOT EXIST!";
} else {
$fp=fopen($file,"r");
$content=fread($fp,filesize($file));
echo $content;
fclose ($fp);
}
?>
