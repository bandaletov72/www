<!DOCTYPE html><html>

<head>
  <title>Temporary Ban</title>
</head>

<body>

<?php
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
if ((!@$_GET['ip']) || (@$_GET['ip']=="")){ echo "No IP!"; exit; }
$_GET['ip']=strtoken($_GET['ip'], " ");
if ((!@$_GET['ip']) || (@$_GET['ip']=="")){ echo "No IP!"; exit; }
if ((!@$_GET['t']) || (@$_GET['t']=="")){ echo "No token!"; exit; }
if (!preg_match("/^[0-9a-z]+$/",$_GET['t'])) { $_GET['t']=""; echo "Bad token!"; exit;}
if ((!@$_GET['n']) || (@$_GET['n']=="")){ $_GET['n']=0; }
if ((!@$_GET['p']) || (@$_GET['p']=="")){ $_GET['p']=0; }

$_GET['n']=doubleval($_GET['n']);
$_GET['p']=doubleval($_GET['p']);
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
//whois
if (md5(@$_GET['ip']."$secret_salt")!=$_GET['t']){ echo "Token Error!"; exit;}

$ip=str_replace("<","",str_replace(">","",strip_tags(trim(stripslashes(@$_GET['ip'])))));
if ($_GET['n']!=100) {
echo "<table border=0 cellspacimg=0 celladding=10><tr><td valign=top><img src=\"../images/banned.png\" border=0></td><td valign=top><h1><font color=#bb0000>$lang[1525]</font></h1><font size=4>IP: ".$ip."</font><br>";
$btime=(time()+60*60*24);
if ($_GET['n']==0) {$tit=$lang[1505]; $btime=(time()+60*60*24); }  //сутки
if ($_GET['n']==1) {$tit=$lang[1502]; $btime=(time()+60*60); } //час
if ($_GET['n']==2) {$tit=$lang[1503]; $btime=(time()+60*60*6); } //6 часов
if ($_GET['n']==3) {$tit=$lang[1504]; $btime=(time()+60*60*12);} //12часов
if ($_GET['n']==4) {$tit=$lang[1506]; $btime=(time()+60*60*24*3);} //3 суток
if ($_GET['n']==5) {$tit=$lang[1507]; $btime=(time()+60*60*24*7);}  //недел€
if ($_GET['n']==6) {$tit=$lang[1508]; $btime=(time()+60*60*24*14);}  //2 недели
if ($_GET['n']==7) {$tit=$lang[1509]; $btime=(time()+60*60*24*30);}  //мес€ц
if ($_GET['n']==8) {$tit=$lang[1510]; $btime=(time()+60*60*24*30*3);} //3 мес€ца
if ($_GET['n']==9) {$tit=$lang[1511]; $btime=(time()+60*60*24*30*6);}  //6 мес€цев
if ($_GET['n']==10) {$tit=$lang[1512]; $btime=(time()+60*60*24*30*12);} //год
if ($_GET['n']==11) {$tit=$lang[1513]; $btime=(time()+60*60*24*30*12*10);} //бессрочно

$banend=date("d.m.Y H:i:s", $btime);
echo "<br>$lang[1526]: $banend<br>$lang[1501]: $tit";
$reason=1515;
if ($_GET['p']==0) {$tit=$lang[1515];  $reason=1515; }
if ($_GET['p']==1) {$tit=$lang[1516];  $reason=1516; }
if ($_GET['p']==2) {$tit=$lang[1517];  $reason=1517; }
if ($_GET['p']==3) {$tit=$lang[1518];  $reason=1518; }
if ($_GET['p']==4) {$tit=$lang[1519];  $reason=1519; }
if ($_GET['p']==5) {$tit=$lang[1520];  $reason=1520; }
if ($_GET['p']==6) {$tit=$lang[1521];  $reason=1521; }
if ($_GET['p']==7) {$tit=$lang[1522];  $reason=1522; }
if ($_GET['p']==8) {$tit=$lang[1523];  $reason=1523; }
if ($_GET['p']==9) {$tit=$lang[1524];  $reason=1524; }

$tmp=explode(".",$ip);
if(is_dir("./bannedip")!=true) { mkdir("./bannedip",0755); }
$ipdir="./bannedip";
reset($tmp);
while(list($key,$val)=each($tmp)) {
if (trim($val!="")){
$ipdir.="/".trim($val);
if(is_dir($ipdir)!=true) { mkdir($ipdir,0755); }
}
}
$ipfile=$ipdir."/"."banned.txt";
$fp=fopen($ipfile,"w");
fputs($fp,$btime."\n".$reason."\n");
fclose($fp);
echo "<br>$lang[1514]: $tit";
} else {
$tmp=explode(".",$ip);
echo "<table border=0 cellspacimg=0 celladding=10><tr><td valign=top><img src=\"../images/freedom.png\" border=0></td><td valign=top><h1><font color=#00bb00>$lang[1529]</font></h1><font size=4>IP: ".$ip."</font><br>";
$ipfile="./bannedip/".implode("/",$tmp)."/banned.txt";
if (file_exists($ipfile)) {
unlink($ipfile);
} else {
echo "<br>File \"$ipfile\" not exist!<br>";
}
}

echo "</td></tr></table>
<div align=center><br><br><button onclick='javascript:self.close()'><font color=#b94a48>X</font>&nbsp;&nbsp;".$lang[428]."</button></div>";

?>

</body>

</html>
