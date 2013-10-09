<?php
//birthday module
$birthday="";
$birthday_t="";
$birthday_f="";
if (file_exists("./admin/birthday.txt")==TRUE) {
$birthday_m= file ("./admin/birthday.txt");
while (list($key,$val)=each ($birthday_m)) {
if (trim($val)!="") {
$tmp=explode("|", $val);
if ($portal==1) { $name=$tmp[1]; } else { $name=$tmp[0];  }
if ($tmp[2]==0) {
$birthday_t.="<a href=\"$htpath/index.php?action=userinfo&usernik=".rawurlencode($tmp[0])."\"><font color=#b94a48><b>$name</b></font></a>, ";
} else {
$birthday_f.="<a href=\"$htpath/index.php?action=userinfo&usernik=".rawurlencode($tmp[0])."\">$name</a> <span title=\"$lang[1493]: ".$tmp[2]."\" style=\"cursor: pointer; cursor: hand;\">[".$tmp[2]."]</span>, ";
}
}
}
if ($birthday_t!="") {
$birthday_t="<b>$lang[1492]:</b><br><br>".substr($birthday_t, 0, (strlen($birthday_t)-2))."<br><br><img src=\"$image_path/birthday.png\" align=left border=0>&nbsp;&nbsp;&nbsp;$lang[1495]<br>&nbsp;&nbsp;&nbsp;$lang[1496]<br><br>";
}
if ($birthday_f!="") {
$birthday_f="<b>$lang[1494]:</b><br><br>".substr($birthday_f, 0, (strlen($birthday_f)-2))."<br>";
}
$birthday=$birthday_t.$birthday_f;

}


?>
