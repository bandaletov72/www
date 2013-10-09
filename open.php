<!DOCTYPE html><html><head>
<meta name="allow-search" content="no">
<meta name="robots" content="noindex">
<meta name="expires" content="0">
<title>View</title></head><body topmargin=0><noindex>

<?php
if(isset($_GET['i'])) $i=$_GET['i']; elseif(isset($_POST['i'])) $i=$_POST['i']; else $i="";
if (isset($i)){
if (!preg_match("/^[-а-яА-ЯёЁa-zA-Z0-9\ _\(\)\:\\\.\/]+$/i",$i)) { echo "<br><br><font size=2 face=Verdana><p align=center><b>This image dont want to be displayed due to unsuffient filename!<br>Имя этой картинки содержит запрещенные символы!</b><br><br><small>Please call domain administrator.<br>Пожалуйста, обратитесь к администратору домена.</small></font></p>"; exit;}
echo "<a href=\"#close\" onclick=\"javascript:window.close()\"><img src=\"$i\" border=0 title=\"CLOSE WINDOW\"></a>";
} else {
echo "<br><br><font size=2 face=Verdana><p align=center>No image!</p></font>";
}


?>
</noindex>
</body>
</html>
