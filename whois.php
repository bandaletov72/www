<!DOCTYPE html><html>

<head>
  <title>Whois</title>
</head>

<body>

<?php
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}

$banip="";
$bancause="";
$banrange="";
$whois="";
$allwhois="";
if ((!@$_GET['ip']) || (@$_GET['ip']=="")){ echo "No IP!"; exit; }
$_GET['ip']=strtoken($_GET['ip'], " ");
if ((!@$_GET['ip']) || (@$_GET['ip']=="")){ echo "No IP!"; exit; }
if ((!@$_GET['t']) || (@$_GET['t']=="")){ echo "No token!"; exit; }
if (!preg_match("/^[0-9a-z]+$/",$_GET['t'])) { $_GET['t']=""; echo "Bad token!"; exit;}
if ((!@$_GET['n']) || (@$_GET['n']=="")){$_GET['n']=""; }
if ((!@$_GET['t']) || (@$_GET['t']=="")){ $_GET['t2']=""; }
if (!preg_match("/^[0-9a-z]+$/",$_GET['t2'])) { $_GET['t2']="";}
$fold=".."; require ("./templates/lang.inc");
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
//whois
if (md5($_GET['ip']."$htpath"."$secret_salt")!=$_GET['t']){ echo "Token not valid!"; exit;}
    $sock = @fsockopen ($ripe_adr,$ripe_port,$errno,$errstr,$ripe_timeout);
    //соединение с сокетом TCP, ожидающим на сервере "whois.ripe.net" на 43 порту.
    //Возвращает дескриптор соединения

    if (!$sock) {
      echo("$errno($errstr)");
      @fclose ($sock);
     exit;
    }
    else {
      fputs ($sock, $_GET['ip']."\r\n");
      //записываем строку из переменной $ip в дескриптор сокета

      while (!feof($sock)) {
      $stroke=fgets ($sock,128);
      if ((substr($stroke,0, 1)=="%")||(substr($stroke,0, 3)=="rem")||($stroke=="\n")){ } else {
      $allwhois.=str_replace("\"", "", str_replace("\'", "", $stroke));
      }
      if ((substr($stroke,0, 1)=="%")||($stroke=="\n")||($stroke=="")||($stroke==" ")||($stroke=="  ")||(substr($stroke,0,5)=="admin")||(substr($stroke,0,6)=="remark")||(substr($stroke,0,4)=="tech")||(substr($stroke,0,6)=="status")||(substr($stroke,0,3)=="mnt")||(substr($stroke,0,6)=="source")||(substr($stroke,0,4)=="org:")||(substr($stroke,0,3)=="nic")||(substr($stroke,0,3)=="abu")||(substr($stroke,0,3)=="ori")||(substr($stroke,0,3)=="des")||(substr($stroke,0,3)=="net")||(substr($stroke,0,3)=="fax")||(substr($stroke,0,3)=="rou")||(substr($stroke,0,12)=="organisation")||(substr($stroke,0,8)=="org-type")||(substr($stroke,0,8)=="org-name")||(substr($stroke,0,4)=="pers")){

        }else {
        if (md5($_GET['ip']."$htpath"."$secret_salt".rawurldecode($_GET['n']))==$_GET['t2']) {
        if (substr($stroke,0, 7)=="inetnum") {
        $banip = str_replace("inetnum:", "", str_replace(" ", "", str_replace(chr(0x9), "", $stroke)));
        }
        }
        $whois.= $stroke;
        }
        //осуществляем чтение из дескриптора сокета
      }
    }
    fclose ($sock);
//закрытие соединения
$iip=str_replace("<","",str_replace(">","",strip_tags(trim(stripslashes($_GET['ip'])))));
if (md5($_GET['ip']."$htpath"."$secret_salt".rawurldecode($_GET['n']))==$_GET['t2']) {
$ips=trim(str_replace("<","",str_replace(">","",strip_tags(trim(stripslashes($_GET['n']))))));
echo "<h4>USER: ".$ips."</h4>IP range: $banip";
$ipimg="<img src=\"$image_path/pegi_violance.png\" border=0>";
$tmp=explode(".",$iip);
$razban="";
$ipfile="./admin/bannedip/".implode("/",$tmp)."/banned.txt";
$bancause="";
if (file_exists($ipfile)) {
$tmp2=file($ipfile);
$bantime=date("d.m.Y H:i:s", trim($tmp2[0]));
$banreason=@$lang[trim($tmp2[1])];
$bancause="<br><font color=#b94a48>$lang[1527]</font> <b>$lang[1501]:</b> $bantime <b>$lang[1514]:</b> $banreason<br>";
$ipimg="<img src=\"$image_path/banned.png\" border=0>";
$razban="<td valign=top align=right><form class=form-inline action=\"$htpath/admin/tempban.php\" method=GET><input type=hidden name=ip value=\"$iip\">
<input type=hidden name=t value=\"".md5($iip.$secret_salt)."\">
<input type=hidden name=n value=100>
<input type=hidden name=p value=0>
<input type=submit type=submit value=\"$lang[1528]\"></form></td>";
}

$banip="<form class=form-inline action=\"$htpath/admin/tempban.php\" method=GET>
<table border=0 cellspacing=0 cellpadding=4 bgcolor=#dedede width=100%>
<td valign=middle>$ipimg</td>
<td valign=top width=100%>
<input type=hidden name=ip value=\"$iip\">
<input type=hidden name=t value=\"".md5($iip.$secret_salt)."\">
<table border=0 width=100% cellspacing=0 cellpadding=6><tr><td><b>$lang[1501]:</b></td><td><select name=n>
<option value=1>$lang[1502]</option>
<option value=2>$lang[1503]</option>
<option value=3>$lang[1504]</option>
<option value=0 selected>$lang[1505]</option>
<option value=4>$lang[1506]</option>
<option value=5>$lang[1507]</option>
<option value=6>$lang[1508]</option>
<option value=7>$lang[1509]</option>
<option value=8>$lang[1510]</option>
<option value=9>$lang[1511]</option>
<option value=10>$lang[1512]</option>
<option value=11>$lang[1513]</option>
</select></td></tr><tr><td><b>$lang[1514]:</b></td><td><select name=p>
<option value=0 selected>$lang[1515]</option>
<option value=1>$lang[1516]</option>
<option value=2>$lang[1517]</option>
<option value=3>$lang[1518]</option>
<option value=4>$lang[1519]</option>
<option value=5>$lang[1520]</option>
<option value=6>$lang[1521]</option>
<option value=7>$lang[1522]</option>
<option value=8>$lang[1523]</option>
<option value=9>$lang[1524]</option>
</select></td></tr>
<tr><td>&nbsp;</td><td><table border=0 cellpadding=0 cellspacing=0><tr><td valign=top><input type=submit type=submit value=\"$lang[186]\"></form></td><td>&nbsp;&nbsp;</td>$razban</tr></table></td></table>

</td>
</tr>
</table>
";
}
echo "<br><font size=4>Current IP: $iip</font>$bancause"."$banip<pre>$whois<hr>$allwhois</pre>";


?>

</body>

</html>
