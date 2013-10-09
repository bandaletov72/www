<!DOCTYPE html><html>
<head>
<meta name="expires" content="0"><meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>FTP copy tool</title>
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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");$fold="..";
require ("../templates/$template/css.inc");
echo $css;
echo "</head><body><font face=Verdana>
<table border=0><tr><td width=70% valign=top><h4>Межсерверный обмен файлами</h4>
";
echo "[ <a href=\"ftplocal.php\">Выбрать другой локальный файл</a> ]<br><br>";
if ((!@$local_file) || (@local_file=="")){ $local_file=""; }
if (!preg_match("/^[a-zA-Z0-9_\.-]+$/i",$local_file)) { $local_file=""; }
if ((!@$local_dir) || (@local_dir=="")){ $local_dir=""; }
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$local_dir)) { $local_dir=""; }
if (($local_dir=="")||($local_file=="")) {echo "Вы не указали файл для копирования! <a href=\"ftplocal.php\">Вернитесь</a> и укажите файл для копирования."; exit;}

if ((!@$file) || (@$file=="")){ $file=""; }
if (!preg_match("/^[a-zA-Z0-9_\.-]+$/i",$file)) { $file=""; }
if ((!@$ftp_dir) || (@$ftp_dir=="")){ $ftp_dir=""; }
if (!preg_match("/^[a-z0-9_\.\/-]+$/i",$ftp_dir)) { $ftp_dir=""; }
if ((!@$action) || (@$action=="")){ $action=""; }
if (!preg_match("/^[a-z0-9_\.\/-]+$/i",$action)) { $action=""; }
if ((!@$host) || (@$host=="")){ $host=""; }
if (!preg_match("/^[a-z0-9_\.-]+$/i",$host)) { $host=""; }
if ((!@$ftp_user_name) || (@$ftp_user_name=="")){ $ftp_user_name=""; }
if (!preg_match("/^[a-zA-Z0-9_\.-]+$/i",$ftp_user_name)) { $ftp_user_name=""; }
if ((!@$ftp_user_pass) || (@$ftp_user_pass=="")){ $ftp_user_pass=""; }
if (!preg_match("/^[a-zA-Z0-9_-]+$/i",$ftp_user_pass)) { $ftp_user_pass=""; }

if ((!@$host2) || (@$host2=="")){ $host2=""; }
if (!preg_match("/^[a-zA-Z0-9_\.-]+$/i",$host2)) { $host2=""; }
if ((!@$ftp_user_name2) || (@$ftp_user_name2=="")){ $ftp_user_name2=""; }
if (!preg_match("/^[a-zA-Z0-9_\.-]+$/i",$ftp_user_name2)) { $ftp_user_name2=""; }
if ((!@$ftp_user_pass) || (@$ftp_user_pass2=="")){ $ftp_user_pass2=""; }
if (!preg_match("/^[a-zA-Z0-9_-]+$/i",$ftp_user_pass2)) { $ftp_user_pass2=""; }
if ((!@$from) || (@from=="")){ $from=""; }
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$from)) { $from=""; }
if ((!@$to) || (@$to=="")){ $to=""; }
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$to)) { $to=""; }

if (($action=="save")&&($host!=="")) {
echo "Запись учетной записи для сервера <b>$host</b><br>";
$filename="./ftplist/".$host."_$ftp_user_name.txt";
if (@file_exists($filename)==TRUE){echo "Учетная запись уже существует. Перезаписываю.<br>";}
$filo = fopen ($filename, "w");
if (!$filo) {
echo "<p><font color=#b94a48>Не могу открыть файл <b>$filename</b> для записи.</font><br>\n";
exit;
}
fputs ($filo, $host."\n".$ftp_user_name."\n".$ftp_user_pass);
echo "<font color=#468847>Учетная запись для <b>$host</b> записана.</font><br><br>";
fclose ($filo);
$action="enter";
}
if (($action=="del")&&($host!=="")) {
echo "Удаление учетной записи <b>$ftp_user_name</b> для сервера <b>$host</b><br>";
$filename="./ftplist/".$host."_$ftp_user_name.txt";
@unlink ($filename);
if (@file_exists($filename)==TRUE) {
echo "<p><font color=#b94a48>Не могу удалить файл <b>$filename</b>.</font><br>\n";
} else {
echo "<font color=#468847>Учетная запись <b>ftp_user_name</b> для <b>$host</b> удалена.</font><br><br>";

}
$action="enter";
}

//список учетных записей
$servers="Список сохраненных учетных записей:<br><br>";
$handle=@opendir("./ftplist");
$i=0;
while (($val=@readdir($handle))!==FALSE) {
if (($val==".")||($val=="..")) { continue;} else {
$fcon=file("./ftplist/$val");
$servers.="Сервер:&nbsp;<b>".$fcon[0]."</b><br>Пользователь:&nbsp;<b>".$fcon[1]."</b>&nbsp;&nbsp;[<a href=\"".$_SERVER['PHP_SELF']."?action=enter&host=".$fcon[0]."&ftp_user_name=".$fcon[1]."&ftp_user_pass=".$fcon[2]."&local_dir=$local_dir&local_file=$local_file\">Вход</a>]&nbsp;&nbsp;&nbsp;[<a title=\"Удалить учетную запись\" href=\"".$_SERVER['PHP_SELF']."?action=del&host=".$fcon[0]."&ftp_user_name=".$fcon[1]."&ftp_user_pass=".$fcon[2]."&local_dir=$local_dir&local_file=$local_file\">X</a>]<br><br>\n";
$i+=1;
}
}
if ($i==0) {$servers.="<b>- Нет сохраненных учетных записей!</b><br><br>";}
//конец формирования списка


if (($action=="add")&&($host!=="")&&($file!=="")) {
echo "Задание на копирование файла <b>$file</b><br>";
$filename="./ftpcopy/".$host."@". str_replace("/", "_", $ftp_dir) ."_$file@". str_replace("/", "_", $local_dir) ."_$local_file.txt";
if (@file_exists($filename)==TRUE){echo "Подобное задание на копирование уже существует. Перезаписываю.<br>";}
$filo = fopen ($filename, "w");
if (!$filo) {
echo "<p><font color=#b94a48>Не могу открыть файл <b>$filename</b> для записи.</font><br>\n";
exit;
}
fputs ($filo, "copy\n". $local_dir."/".$local_file."\n".$host."\n".$ftp_user_name."\n".$ftp_user_pass."\n".$ftp_dir."/".$file);
echo "<font color=#468847>Задание копирования локального файла <b>$local_file</b> на сервер $host записано.</font><br><br>";
fclose ($filo);
$action="enter";
}

if (($action=="del_task")&&($host2!=="")&&($to!=="")&&($from!=="")) {
echo "Удаление задания <b>$file</b><br>";
$filename="./ftpcopy/".$host2."@". str_replace("/", "_", $to) ."@". str_replace("/", "_", $from) .".txt";
if (@file_exists($filename)==TRUE) {
@unlink ($filename);
if (@file_exists($filename)==TRUE) {
echo "<p><font color=#b94a48>Не могу удалить файл <b>$filename</b>.</font><br>\n";
} else {
echo "<font color=#468847>Задание для <b>$host</b> удалена.</font><br><br>";
}
} else {
echo "<p><font color=#b94a48>Задание <b>$filename</b> не существует.</font><br>\n";
}
$action="enter";
}
if (($action=="run_task")&&($host2!=="")&&($to!=="")&&($from!=="")) {
echo "<small>Выполнение задания <b>$file</b><br>";
$filename="./ftpcopy/".$host2."@". str_replace("/", "_", $to) ."@". str_replace("/", "_", $from) .".txt";
if (@file_exists($filename)==TRUE) {
$fcon2=file("$filename");
$from2=str_replace("\n", "", $fcon2[1]);
$ext=strtolower(substr("$from2", -4));
$host2=str_replace("\n", "", $fcon2[2]);
$ftp_user_name2=str_replace("\n", "",$fcon2[3]);
$ftp_user_pass2=str_replace("\n", "",$fcon2[4]);
$to2=str_replace("\n", "", $fcon2[5]);
echo "<br>".$fcon2[0]. "from: $from2 to: $to2<br><br>";
$hostip2 = gethostbyname($host2);
$conn_id2 = ftp_connect($hostip2);

// login with username and password
$login_result2 = ftp_login($conn_id2, $ftp_user_name2, $ftp_user_pass2);

// IMPORTANT!!! turn passive mode on
ftp_pasv ( $conn_id2, true );

if ((!$conn_id2) || (!$login_result2)) {
  echo "FTP connection has failed!";
  echo "Attempted to connect to $host2 for user $ftp_user_name2";
  die;
} else {
if (($ext==".txt")||($ext==".htm")||($ext==".inc")||($ext==".php")||($ext=="php4")||($ext=="html")){
//upload a ASCII file
  if (ftp_put($conn_id2, $to2, $from2, FTP_ASCII)) {
   echo "<b>Успешно загружен на $to2 в режиме ASCII!</b><br>";
  } else {
   echo "Проблема загрузки $to2<br>";
  }
}else {
//upload a BINARY file
  if (ftp_put($conn_id2, $to2, $from2, FTP_BINARY)) {
   echo "<b>Успешно загружен на $to2 в режиме BINARY!</b><br>";
  } else {
   echo "Проблема загрузки $to2<br>";
  }
}

  }

  ftp_close($conn_id2);


} else {
echo "<p><font color=#b94a48>Задание <b>$filename</b> не существует.</font><br>\n";
}
echo "</small><br>";
$action="enter";
}


$form= "<table border=0>\n<form class=form-inline action=".$_SERVER['PHP_SELF']." method=GET>\n
<input type=\"hidden\" name=\"ftp_dir\" value=\"$ftp_dir\"><input type=\"hidden\" name=\"action\" value=\"enter\">\n
<input type=\"hidden\" name=\"local_dir\" value=\"$local_dir\"><input type=\"hidden\" name=\"local_file\" value=\"$local_file\">\n
<tr><td>ФТП-хост: </td><td><input type=\"text\" name=\"host\" size=20 value=\"$host\"></td><td><small> <b>например:</b> www.имя.ru</small></td><td></td></tr>\n
<tr><td>".$lang['login'].": </td><td><input type=\"text\" name=\"ftp_user_name\" size=20 value=\"$ftp_user_name\"></td><td><small> </small></td><td></td></tr>\n
<tr><td>".$lang['pass'].": </td><td><input type=\"password\" name=\"ftp_user_pass\" size=20 value=\"$ftp_user_pass\"></td><td><small><input type=\"submit\" class=\"btn btn-primary\" value=\"Вход\"></td><td> </td></tr></table>\n
</form>\n";

if (($action=="enter")&&($host!=="")) {
// setup $host and $file variables for your setup before here...

$hostip = gethostbyname($host);
$conn_id = ftp_connect($hostip);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// IMPORTANT!!! turn passive mode on
ftp_pasv ( $conn_id, true );

if ((!$conn_id) || (!$login_result)) {
  echo "FTP connection has failed!";
  echo "Attempted to connect to $host for user $ftp_user_name";
  die;
} else {
echo $form;
echo "Соединились с $host, пользователь: <b>$ftp_user_name</b><br>";
echo "IP хоста: $hostip<br><br>Теперь выберите место, куда произвести копирование файла <b>$local_file</b>:";
$servers.= "Вы успешно зашли на <b>$host</b>!
<br>Вы можете сохранить учетные данные для дальнейшего использования.
<form class=form-inline action=".$_SERVER['PHP_SELF']." method=GET>\n
<input type=\"hidden\" name=\"ftp_dir\" value=\"$ftp_dir\">\n
<input type=\"hidden\" name=\"action\" value=\"save\">\n
<input type=\"hidden\" name=\"local_dir\" value=\"$local_dir\">\n
<input type=\"hidden\" name=\"local_file\" value=\"$local_file\">\n
<input type=\"hidden\" name=\"host\" size=20 value=\"$host\">\n
<input type=\"hidden\" name=\"ftp_user_name\" value=\"$ftp_user_name\">\n
<input type=\"hidden\" name=\"ftp_user_pass\" value=\"$ftp_user_pass\">
<input type=\"submit\" class=\"btn btn-primary\" value=\"Сохранить\"><br>";


$form="";

  $ftp_list=ftp_nlist($conn_id, "$ftp_dir");
  if ($ftp_dir==""){
  echo "<br>Листинг <b>корневого</b> каталога<br>";
  $root="";
  $rooty="";
  } else {
  echo "<br>Листинг каталога <b>$ftp_dir</b><br>";
  $root_mass=explode ("/", $ftp_dir);
  array_pop($root_mass);
  $rooty=implode ("/", $root_mass);
  $root="<a href=\"".$_SERVER['PHP_SELF']."?ftp_dir=". $rooty ."&action=enter&host=$host&ftp_user_name=$ftp_user_name&ftp_user_pass=$ftp_user_pass&local_dir=$local_dir&local_file=$local_file\">..</a> <small>[ возврат ]</small><br>";
  }
  echo $root;
  $i=0;
while (list ($key, $val) = @each ($ftp_list)) {
$fsize=ftp_size($conn_id, "$val");
if ($fsize==-1) {
$tmp_mass[$i]= "<!-- 0 $val --><tr><td><a href=\"".$_SERVER['PHP_SELF']."?ftp_dir=$val&action=enter&host=$host&ftp_user_name=$ftp_user_name&ftp_user_pass=$ftp_user_pass&local_dir=$local_dir&local_file=$local_file\">".str_replace ("$ftp_dir/", "", $val)."</a></td><td><small>[ <b>DIR</b> ]</small></td><td> </td></tr>\n";
} else {
$tmp_mass[$i]=  "<!-- 1 $val --><tr><td>".str_replace ("$ftp_dir/", "", $val)."</td><td><small><b>". $fsize. "</b> bytes</small></td><td><small>". date ("d-m-Y H:i:s", ftp_mdtm($conn_id, $val))."</small> [<a title=\"Заменить файл ($val) на $local_file\" href=\"".$_SERVER['PHP_SELF']."?action=add&file=".str_replace ("$ftp_dir/", "", $val)."&ftp_dir=$ftp_dir&host=$host&ftp_user_name=$ftp_user_name&ftp_user_pass=$ftp_user_pass&local_dir=$local_dir&local_file=$local_file\">+</a>]</td></tr>\n";
}
$i+=1;
}
  /* upload a file
  if (ftp_put($conn_id, $remote_file, $file, FTP_ASCII)) {
   echo "successfully uploaded $file<br>";
  } else {
   echo "There was a problem while uploading $file<br>";
  }

  */
  // close the connection
  ftp_close($conn_id);

@sort($tmp_mass);
@reset($tmp_mass);
echo "<table border=0>";
while (list ($key, $val) = @each ($tmp_mass)) {
echo $val;
}
echo "</table>";
}
} else {

echo "Вы выбрали локальный файл <b>$local_file</b> для копирования.<br>Теперь Вам требуется выбрать FTP и место куда копировать файл.
<br><br>Введите требуемые поля формы для входа на FTP.$form";
}
unset($fcon, $handle, $val, $i);
//список заданий
$servers.="<br>Список заданий: &nbsp;&nbsp;&nbsp;<small>[<a href=\"#runtask\" onClick=javascript:window.open('ftptask.php','runtask','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>Выполнить все</a>]</small><br><br>";
$handle=@opendir("./ftpcopy");
$i=1;
while (($val=@readdir($handle))!==FALSE) {
if (($val==".")||($val=="..")) { continue;} else {
$fcon=file("./ftpcopy/$val");
$servers.="<li><small><b>Задание $i</b> [<a href=\"".$_SERVER['PHP_SELF']."?action=run_task&host2=".$fcon[2]."&ftp_user_name2=".$fcon[3]."&ftp_user_pass2=".$fcon[4]."&from=".$fcon[1]."&to=".$fcon[5]."&host=$host&ftp_user_name=$ftp_user_name&ftp_user_pass=$ftp_user_pass&local_dir=$local_dir&local_file=$local_file\">Обработать задание</a>]&nbsp;&nbsp;&nbsp;[<a title=\"Удалить задание\" href=\"".$_SERVER['PHP_SELF']."?action=del_task&host2=".$fcon[2]."&from=".$fcon[1]."&to=".$fcon[5]."&ftp_user_name2=".$fcon[3]."&ftp_user_pass2=".$fcon[4]."&local_file=$local_file&host=$host&ftp_user_name=$ftp_user_name&ftp_user_pass=$ftp_user_pass&local_dir=$local_dir&local_file=$local_file\">X</a>]<br>".
str_replace("copy", "Копировать", $fcon[0]). " файл ".$fcon[1]." на сервер ".$fcon[2]." на место ".$fcon[5]."</small></li><br>\n";
$i+=1;
}
}
if ($i==1) {$servers.="<b>- Нет заданий для копирования!</b><br><br>";}
//конец списка заданий
echo "</td><td width=30% valign=top>$servers</td></tr></table>";
?>
<hr size=1><p align=center><small>PHP File Transfer<br>(c) EuroWebcart</small></p></font></body></html>
