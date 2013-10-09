<?php
if(isset($_POST['us']))  { $us=$_POST['us'];} else { echo "0"; exit; }
if (!preg_match("/^[a-zA-Z0-9_\&\#\;\.\/-]+$/i",$us)) { echo "4"; exit; }

if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek']; else $speek="";
if (!preg_match("/^[a-z0-9_]+$/",$speek)) { $speek="";}

$us = trim($us);

if ($us=="") {echo "0"; } else {
if ((strlen($us)<3)||(strlen($us)>30))  {
echo "0";
} else {
if (strlen($us)<8) { echo "1"; exit;}
if (strlen($us)<12) { echo "2"; exit;}
if (strlen($us)<=30) { echo "3"; exit;}
}
}


?>
