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
if ((!@$view) || (@$view=="") || (@$view=="no")): $view=""; endif;
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

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>ПЕРЕСЧЕТ БАЗЫ ЗАКАЗОВ</title><head>";
echo $css;
echo "</head>
<BODY onload=\"javascriprt:self.focus()\" bgcolor=$nc0 link=$nc2 text=$nc5>";
if(isset($_GET['per'])) $per=$_GET['per']; elseif(isset($_POST['per'])) $per=$_POST['per']; else $per=1;
if (!preg_match("/^[0-9\.\,]+$/",$per)) { $per=1;}
if(isset($_GET['per2'])) $per2=$_GET['per2']; elseif(isset($_POST['per2'])) $per2=$_POST['per2']; else $per2=1;
if (!preg_match("/^[0-9\.\,]+$/",$per2)) { $per2=1;}
if(isset($_GET['per3'])) $per3=$_GET['per3']; elseif(isset($_POST['per3'])) $per3=$_POST['per3']; else $per3=1;
if (!preg_match("/^[0-9\.\,]+$/",$per3)) { $per3=1;}
if(isset($_GET['per4'])) $per4=$_GET['per4']; elseif(isset($_POST['per4'])) $per4=$_POST['per4']; else $per4=1;
if (!preg_match("/^[0-9\.\,]+$/",$per4)) { $per4=1;}

if(isset($_GET['rou'])) $rou=$_GET['rou']; elseif(isset($_POST['rou'])) $rou=$_POST['rou']; else $rou=1;
if (!preg_match("/^[0-9\.\,]+$/",$rou)) { $rou=1;}
$rou=doubleval(str_replace(",",".",$rou));
$per=doubleval(str_replace(",",".",$per));
$per2=doubleval(str_replace(",",".",$per2));
$per3=doubleval(str_replace(",",".",$per3));
$per4=doubleval(str_replace(",",".",$per4));
if (($per!=0)&&($per!=1)&&($per2!=0)&&($per2!=1)&&($per3!=0)&&($per3!=1)&&($per4!=0)&&($per4!=1)&&($rou!=0)) {
$g=1;
echo "<h4>Пересчет открытой базы</h4>";
$file="./baskets/list.txt";
$listmas=file($file);
$str="";
while(list ($keysm,$st) =each ($listmas)) {
if ((trim($st)!="")&&(trim($st)!="|")) {
$out=explode("|",$st);
if (strlen($out[0])==32) {echo $out[10]." ".$out[7]." ".$out[8]." ".$out[9]." - ".$out[10]."<br>\n";
if (($out[10]==$lang[493])||($out[10]==493)||($out[10]=="493")) {}else{ $out[9]=$rou*(round(($out[9]*$per4)/$rou)); $str.=implode("|",$out);}
} else {echo "#".$out[0]." ".$out[7]." ".$out[8]." ".$out[9]." - ".$out[10]."<br>\n";
if (($out[10]==$lang[492])||($out[10]==492)||($out[10]=="492")) {}else{$out[9]=$rou*(round(($out[9]*$per3)/$rou)); $out[8]=$rou*(round(($out[8]*$per2)/$rou)); $out[7]=$rou*(round(($out[7]*$per)/$rou)); $str.=implode("|",$out);}
}
$g+=1;
}
}
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs($f3, $str); flock ($f3, LOCK_UN);
fclose($f3);
unset($f3);
echo "<br>ОК";
echo "<h4>Пересчет закрытой базы</h4>";
$file="./baskets/list2.txt";
$listmas=file($file);
$str="";
while(list ($keysm,$st) =each ($listmas)) {if ((trim($st)!="")&&(trim($st)!="|")) {
$out=explode("|",$st);
if (strlen($out[0])==32) {
echo $out[10]." ".$out[7]." ".$out[8]." ".$out[9]." - ".$out[10]."<br>\n";
if (($out[10]==$lang[493])||($out[10]==493)||($out[10]=="493")) {}else{$out[9]=$rou*(round(($out[9]*$per4)/$rou));  $str.=implode("|",$out);}
} else {
echo "#".$out[0]." ".$out[7]." ".$out[8]." ".$out[9]." - ".$out[10]."<br>\n";
if (($out[10]==$lang[492])||($out[10]==492)||($out[10]=="492")) {}else{$out[9]=$rou*(round(($out[9]*$per3)/$rou)); $out[8]=$rou*(round(($out[8]*$per2)/$rou)); $out[7]=$rou*(round(($out[7]*$per)/$rou)); $str.=implode("|",$out);}
}
$g+=1;
}
}
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs($f3, $str); flock ($f3, LOCK_UN);
fclose($f3);
unset($f3);
echo "<br>ОК";
} else {echo "<h1>Пересчет базы заказов</h1>Использование на Ваш собственный страх и риск!<br><br><form class=form-inline action=\"pereschet.php\" method=POST>
Введите коэффициент пересчета цены продажи: <input type=\"text\" name=\"per\" size=10 value=\"$per\"> (разделяйте разряды точкой например. 45.5, 30, 0.33)<br>
Введите коэффициент пересчета оптовой цены: <input type=\"text\" name=\"per2\" size=10 value=\"$per2\"> (разделяйте разряды точкой например. 45.5, 30, 0.33)<br>
Введите коэффициент пересчета цены доставки: <input type=\"text\" name=\"per3\" size=10 value=\"$per3\"> (разделяйте разряды точкой например. 45.5, 30, 0.33)<br>
Введите коэффициент пересчета расходов: <input type=\"text\" name=\"per4\" size=10 value=\"$per4\"> (разделяйте разряды точкой например. 45.5, 30, 0.33)<br>
Округление: <input type=\"text\" name=\"rou\" size=10 value=\"$rou\"> (разделяйте разряды точкой, например 0.01, 0.1, 1, 10, 100)<br><br>
<input type=submit value=\"Пересчитать\"></form>";
}
?>
</body>
</html>
