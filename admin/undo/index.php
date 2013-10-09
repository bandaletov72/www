<?php
if(isset($_GET['del'])) $del=$_GET['del']; elseif(isset($_POST['del'])) $del=$_POST['del']; else $del="";
if(isset($_GET['rest'])) $rest=$_GET['rest']; elseif(isset($_POST['rest'])) $rest=$_POST['rest']; else $rest="";
if ($del!="") {
@unlink("./backups/$del.undo");
@unlink("./backups/$del");
}
if ($rest!="") {
$filetorest="./backups/".$rest.".undo";
$fpm=file($filetorest);
$dest=trim(trim("../.".$fpm[0]));

$timest=time();
copy("$dest" , "./backups/AUTOBACKUP.".$timest);
$fp = fopen ("./backups/AUTOBACKUP.".$timest.".undo" , "w"); flock ($fp, LOCK_EX);
fputs($fp, $fpm[0]);
flock ($fp, LOCK_UN);
fclose($fp);
copy("./backups/".$rest , $dest);
if (!file_exists($dest)) {
echo "DESTINATION FILE $dest NOT EXIST!<br>";
}
//@unlink("./backups/$del");
}
$s=0;
$handle=opendir("./backups/");
while (($file = readdir($handle))!==FALSE) {
if (($file == '.') || ($file == '..')||(substr($file,-5)==".undo")) {
continue;
} else {
$date=date("d/m/y H:i:s", filemtime("./backups/$file"));
echo "$date $file <b><a href='index.php?rest=$file'>UNDO</a></b> | <a href='index.php?del=$file'>DELETE</a> | <a href='$htpath/admin/undo/view.php?file=$file' target=_blank>VIEW</a><br>\n";
$s+=1;
}
}
closedir ($handle);
if ($s==0) { echo "NO BACKUPS!";}
?>
