<!DOCTYPE html><html>

<head>
  <title>Subscribe Mail</title>
</head>

<body>

<?php

if (is_dir("./admin/obmen_data/subscribe")==FALSE) { mkdir("./admin/obmen_data/subscribe",0755); }
require "./templates/lang.inc";
if(isset($_GET['code'])) $code=$_GET['code']; elseif(isset($_POST['code'])) $code=$_POST['code']; else $code="";
if (!preg_match("/^[0-9a-z]+$/i",$code)) { $code="";}
if(isset($_GET['mail'])) $mail=$_GET['mail']; elseif(isset($_POST['mail'])) $mail=$_POST['mail']; else $mail="";
if (!preg_match("/^[0-9a-zA-Z\@\.-_]+$/i",$mail)) { $mail="";}
if (md5($secret_salt.strtolower($mail))==$code) { $fp=fopen("./admin/obmen_data/subscribe/".strtolower($mail).".txt","w"); fclose($fp);
echo "<h1>OK</h1>";
unlink ("./admin/obmen_data/unsubscribe/$code.txt"); } else {
echo "<h1>ERROR</h1>Subscribe code not valid! Please contact site administrtor.";
}

?>

</body>

</html>