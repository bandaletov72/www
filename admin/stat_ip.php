<?php

if ((!@$perpage) || (@$perpage=="")): $perpage=10; endif;
if ((!@$ipsort) || (@$ipsort=="")): $ipsort=""; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$ban) || (@$ban=="")): $ban=""; endif;
if ((!@$razban) || (@$razban=="")): $razban=""; endif;
if ((!@$delip) || (@$delip=="")): $delip=""; endif;
$sooip="";
if ($delip==1) {

//Список IP//

$handle=opendir('./admin/stat_ip/');
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')  || (strlen($file)==1)) {
continue;
} else {
unlink ("./admin/stat_ip/$file" );
$sooip.="<br><small>$file - <b>Удален.</b></small>";
}
}
closedir ($handle);

}


function whois($ip) {

if ((!@$ip) || (@$ip=="")){ echo "Не указан IP!"; return; }
global $ripe_adr;
global $ripe_port;
global $ripe_timeout;
//whois
    $sock = @fsockopen ($ripe_adr,$ripe_port,$errno,$errstr,$ripe_timeout);
    //соединение с сокетом TCP, ожидающим на сервере "whois.ripe.net" на 43 порту.
    //Возвращает дескриптор соединения

    if (!$sock) {
      echo("$errno($errstr)");
      @fclose ($sock);
      return;
    }
    else {
      fputs ($sock, $ip."\r\n");
      //записываем строку из переменной $ip в дескриптор сокета
      $whois="";
      while (!feof($sock)) {
      $stroke=fgets ($sock,128);
      if (substr($stroke,0, 8)=="inetnum:"){
      fclose ($sock);
        return str_replace("\n", "", str_replace(" ", "", str_replace("inetnum:","", $stroke)));
        }
        //осуществляем чтение из дескриптора сокета
      }
    }
    fclose ($sock);
    //закрытие соединения
}

function city($ip) {
if ((!@$ip) || (@$ip=="")){ echo "Не указан IP!"; return; }
global $ripe_adr;
global $ripe_port;
global $ripe_timeout;
//whois
    $sock = fsockopen ($ripe_adr,$ripe_port,$errno,$errstr,$ripe_timeout);
    //соединение с сокетом TCP, ожидающим на сервере "whois.ripe.net" на 43 порту.
    //Возвращает дескриптор соединения

    if (!$sock) {
      echo("$errno($errstr)");
      @fclose ($sock);
      return;
    }
    else {
      fputs ($sock, $ip."\r\n");
      //записываем строку из переменной $ip в дескриптор сокета
      $whois="";
      while (!feof($sock)) {
      $stroke=fgets ($sock,128);
      if (substr($stroke,0, 8)=="address:"){
        $whois.=str_replace("\n", "<br>", str_replace("address:","", $stroke));
        }
        //осуществляем чтение из дескриптора сокета
      }
    }
    fclose ($sock);
    if (preg_match("/Moscow/i", $whois)) {$whois="<b>Москва</b>";}
    if (preg_match("/www.iana.org/i", $whois)) {$whois="<b><font color=#468847>Сеть!</font></b>";}
    fclose ($sock);
    return $whois;
    //закрытие соединения
}


$fban="$base_loc/banlist.inc";


//начинаем банить
if (($ban!=="")&&(substr($ban,0,1)=="i")) {
if (substr($ban,0,5)=="proxy") {$sooip="<h4>PROXY не баню!</h4>";} else {
if (@file_exists("$fban")==FALSE){
$f5=fopen($fban,"a");
fputs($f5, "$ban\n");
fclose ($f5);
}
$f3=fopen($fban,"a");
fputs($f3, "$ban\n");
fclose ($f3);
$fcban=file($fban);
$tmpban=array_unique($fcban);
$f4=fopen($fban,"w");
fputs($f4, implode("",$tmpban));
fclose ($f4);
$sooip="<h4>$ban забанен.</h4>";
unset ($tmpban);
}
}

if (($ban!=="")&&(substr($ban,0,1)=="d")) {
if (substr($ban,0,6)=="dproxy") {$sooip="<h4>PROXY не баню!</h4>";} else {
$ban=str_replace("dip_", "", $ban);
//whois
$ban="ip_".whois($ban);
//end whois

if (@file_exists("$fban")==FALSE){
$f5=fopen($fban,"a");
fputs($f5, "$ban\n");
fclose ($f5);
}
$f3=fopen($fban,"a");
fputs($f3, "$ban\n");
fclose ($f3);
$fcban=file($fban);
$tmpban=array_unique($fcban);
$f4=fopen($fban,"w");
fputs($f4, implode("",$tmpban));
fclose ($f4);
$sooip="<h4>Диапазон $ban забанен.</h4>";
unset ($tmpban);
}
}




if (($razban!=="")&&(substr($razban,0,1)=="i")) {
if (@file_exists("$fban")==TRUE){
$fcban=array_unique(file($fban));
while (list ($keyip, $valip) = each ($fcban)) {
if (str_replace("\n","",$valip)=="$razban"){
$fcban[$keyip]="";
}
}
$f4=fopen($fban,"w");
fputs($f4, implode("",$fcban));
fclose ($f4);
$sooip="<h4>$razban бан снят.</h4>";
unset ($tmpban, $keyip, $valip);
}
}

if (($razban!=="")&&(substr($razban,0,1)=="d")) {
$razban=str_replace("dip_", "", $razban);
//whois
$razban="ip_".whois($razban);
//end whois
$fip=0;
if (@file_exists("$fban")==TRUE){
$fcban=array_unique(file($fban));
while (list ($keyip, $valip) = each ($fcban)) {
if (str_replace("\n","",$valip)=="$razban"){
$fip=1;
$fcban[$keyip]="";
}
}
$f4=fopen($fban,"w");
fputs($f4, implode("",$fcban));
fclose ($f4);
if ($fip==1){
$sooip="<h4>Диапазон: $razban бан снят.</h4>";
} else {
$sooip="<h4><font color=$nc2>Диапазон: $razban не забанен!</font></h4>";
}
unset ($tmpban, $keyip, $valip);
}
}





$fcban=array_unique(@file($fban));
$blist=$fcban;

//Список IP//
$spisip="";
$s = 0;
$handle=opendir('./admin/stat_ip/');
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')  || (strlen($file)==1)) {
continue;
} else {
$fp = fopen ("./admin/stat_ip/$file" , "r");
$fnip=str_replace(".htm", "", "$file");
$tmpip=explode("_", $fnip);
if (preg_match("/inktomisearch/i", @$tmpip[2])==FALSE) {
$countip= fread ($fp, filesize("./admin/stat_ip/$file"));
$ip=@$tmpip[1];
if ($ip=="") {}else{
reset($blist);
@reset($fcban);
$banned="";
$knip="<br>»&nbsp;<a href=\"$htpath/index.php?action=userip&ban=".@$tmpip[0]."_".@$tmpip[1]."&amp;start=$start&amp;perpage=$perpage&ipsort=$ipsort\">Забанить IP</a>";
$kdip="<br>»&nbsp;<a href=\"$htpath/index.php?action=userip&ban=d".@$tmpip[0]."_".@$tmpip[1]."&amp;start=$start&amp;perpage=$perpage&ipsort=$ipsort\">Бан диапазона IP</a>";

while (list ($keybl, $stbl) = each ($blist)) {
$stbl=str_replace("ip_","", str_replace("\n","",$stbl));
$tmpdiap=explode ("-", $stbl);
$ip1="".@$tmpdiap[0];
$ip2="".@$tmpdiap[1];
if ($ip2=="") {$ip2=$ip1;}
$iip['start'] = toint($ip1);
$iip['stop'] = toint($ip2);
$iip['actual'] = toint(@$tmpip[1]);
if ($iip['actual'] >= $iip['start'] && $iip['actual'] <= $iip['stop']){
   $banned="<b><font color=$nc2>В диапазоне</font></b>";
   $kdip="<br>»&nbsp;<a href=\"$htpath/index.php?action=userip&razban=d".@$tmpip[0]."_".@$tmpip[1]."&amp;start=$start&amp;perpage=$perpage&ipsort=$ipsort\"><b>Разбанить диапазон IP</b></a>";
}

}





while (list ($keyip, $valip) = @each ($fcban)) {
if (str_replace("\n","",$valip)=="".@$tmpip[0]."_".@$tmpip[1].""){
$banned="<b><font color=$nc2>Banned!</font></b>";
$knip="<br>»&nbsp;<b><a href=\"$htpath/index.php?action=userip&razban=".@$tmpip[0]."_".@$tmpip[1]."&amp;start=$start&amp;perpage=$perpage&ipsort=$ipsort\">Разбанить IP</a></b>";
$kdip="<br>»&nbsp;<a href=\"$htpath/index.php?action=userip&razban=d".@$tmpip[0]."_".@$tmpip[1]."&amp;start=$start&amp;perpage=$perpage&ipsort=$ipsort\"><b>Разбанить диапазон IP</b></a>";
}
}
$dipfile=filemtime("./admin/stat_ip/$file");
$dateip=date("d-m-Y H:i", $dipfile);
if ($ipsort=="") {
$chars= intval(strlen($countip));
if ($chars==1): $sortby="00000000$countip"; endif;
if ($chars==2): $sortby="0000000$countip"; endif;
if ($chars==3): $sortby="000000$countip"; endif;
if ($chars==4): $sortby="00000$countip"; endif;
if ($chars==5): $sortby="0000$countip"; endif;
if ($chars==6): $sortby="000$countip"; endif;
if ($chars==7): $sortby="00$countip"; endif;
if ($chars==8): $sortby="0$countip"; endif;
if ($chars==9): $sortby="$countip"; endif;
if ($banned!=""){$sortby="999999999";}
} else {
if ($ipsort=="date") {
$sortby="$dipfile";
} else {
$sortby="$fnip";
}
}

$ipstat["$fnip"]="<!--  $sortby --><td valign=top><small><b>". @$tmpip[0] . "</b> <a href=\"#whois\" title=\"whois\" onClick=javascript:window.open('admin/whois.php?ip=". @$tmpip[1] . "','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=550,height=560,left=10,top=10')>". @$tmpip[1] . "</a><br>$banned</small></td><td valign=top><small>" . @$tmpip[2] . "$kdip</small></td><td valign=top width=100><small>" . $dateip ."$knip</small></td><td valign=top align=right><small>" . $countip."</small></td>\n\n";
$indexmass{"$fnip"}="<!--  $sortby -->$fnip";
$s+=1;
}

}
fclose ($fp);
}
}
closedir ($handle);
if ($s!==0) {
//сортировка по алфавиту//
rsort ($ipstat);
reset ($ipstat);
rsort ($indexmass);
reset ($indexmass);
}
$ip_list="";

$st=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$ipstat[($start+$st)]) || (@$ipstat[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$ipstat[($start+$st)]) || (@$ipstat[($start+$st)]=="")): $ipstat[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($st/2)) == "TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
$tmpim=explode("_" , $indexmass[($start+$st)]);
$whoisip=@city(@$tmpim[1]);
$val = "<tr bgcolor=$back><td valign=top align=center><small>".($start+$st+1).".</small></td><td valign=top><small>".$whoisip."</small></td>". $ipstat[($start+$st)]."</tr>";
$st += 1;
$ip_list .= "$val\n";
}
$total = count ($ipstat)-$gt;

$numberpages = (ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

$statistip= "<center><small>".$lang[203]." <b>$numberpages</b> | ".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?action=userip&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&ipsort=$ipsort\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
if ($s==0): $sooip.="<b>".$lang[42]."!</b> Пользователи не определены."; endif;
$ip_list = @$userinfo."$statistip<center>$sooip<small>$pp</small></center><table border=0 width=100%><tr><td valign=top colspan=\"4\"><table width=100% border=0 cellspacing=3 cellpadding=0><tr><td valign=top width=20% align=left><small><a href = \"".$_SERVER['PHP_SELF']."?action=userip&amp;start=0&amp;perpage=$perpage&ipsort=ip\"><b>IP</b></a> / WHOIS</small></td><td align=right valign=top width=80%><small><a href = \"".$_SERVER['PHP_SELF']."?action=userip&amp;start=0&amp;perpage=$perpage&ipsort=date\"><b>Дата</b></a> / <a href = \"".$_SERVER['PHP_SELF']."?action=userip&amp;start=0&amp;perpage=$perpage&ipsort=\"><b>Счетчик</b></a></small></td></tr></table></td></tr>$ip_list</table><center><small>$pp</small></center>
<br>$statistip\n
<br><br>Список забаненных адресов: <b><a href=\"$htpath/index.php?action=template&nt=$base_loc&t=banlist\">открыть</a></b><br>
<br><br>»&nbsp;<b><a href=\"$htpath/index.php?action=userip&delip=1&amp;start=0&amp;perpage=$perpage&ipsort=$ipsort\">Очистить IP-статистику</a></b> (баны не снимаются!)<br>
<br><b>Подсказка:</b><br><br>
<b>IP</b> - пользователи, имеющие собственные IP<br>
<b>PROXY</b> - пользователи, которые заходили через PROXY<br>
<b>Ваш IP:</b> ".@$_SESSION["user_ip"]."<br><br>\n";
$total-=1;


?>