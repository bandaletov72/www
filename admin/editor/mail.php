<html>
<head>
<?php
$hache_num = array (5,9,12,2,29,23,7,17); #8 чисел от 1-31
echo "<title>Рассылка Email</title>";

echo "<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>" .
"<link rel='stylesheet' href='style.css' type='text/css'>
" .
"</head><BODY background='new/a1.gif' bgcolor='#ECEEF7' background='images/abmback.gif' leftmargin='0' topmargin='0'>" .

"<form class=form-inline action='rename.php' method='POST'>" .

"<TABLE align=left border=0 cellPadding=0 cellSpacing=0 width='95%'>" .
"<TBODY><TR><TD width=20 align='left' valign='bottom'><img border='0' src='images/flashright.gif' width='20' height='64'></TD>" .
"<TD valign='bottom' background='images/flashb.gif'>";

echo "<OBJECT classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
 codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0'
 WIDTH=687 HEIGHT=139>
 <PARAM NAME=movie VALUE='site.swf'> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#ECEEF7> <EMBED src='site.swf' quality=high bgcolor=#ECEEF7  WIDTH=687 HEIGHT=139 TYPE='application/x-shockwave-flash' PLUGINSPAGE='http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash'></EMBED>
</OBJECT>" .
"</TD><TD width=20 valign='bottom' align='right'><img border='0' src='images/flashleft.gif' width='20' height='64'></TD></TR>


<TR>
    <TD background='images/lefttable.gif' width=20>&nbsp;</TD>
    <TD>
      <!--DIV id=DHTLMenu onmouseover=OverDHTML(); style=\"Z-INDEX: 1; POSITION: absolute\" onmouseout=OutDHTML();>
</DIV>
<SCRIPT language=JavaScript src=\"menu.js\"></SCRIPT>&nbsp;&nbsp;</TD-->
    <TD background='images/righttable.gif' width=20>&nbsp;</TD></TR>



<TR><TD background='images/lefttable.gif' width=20>&nbsp;</TD>
<TD><table width='100%' border='0' cellspacing='0' cellpadding='5'>
<tr><td width='200' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='5'>
<tr><td valign='top'> <div align='justify'> <font color='#005ED2' size='2' face='Verdana'>";

$max_incl=5;

$dopo="";
$footer ="<br><hr noshade color='#0069DD' size='1'><br><b>Контактный телефон:</b> (095) 956-63-66<br>
<b>E-mail:</b> <a href='mailto:dpz@bk.ru'>dpz@bk.ru</a>, <a href='mailto:opt@dpz.ru'>opt@dpz.ru</a></font></p></td>
        </tr>
      </table>
    </td>
    <td width='20' background='images/righttable.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='20' background='images/leftbottom.gif'>&nbsp;</td>
    <td background='images/bottom.gif'>
      <div align='right'><font face='Verdana' size='1' color='#FFFFFF'>Copyright
        &copy2003 www.dpz.ru</font></div>
    </td>
    <td width='20' background='images/rightbottom.gif'>&nbsp;</td>
  </tr>
</table>
</body>
</html>";
echo "</td>
                </tr>
  <tr>
                <td>
 </td>
                </tr>
              </table>
</td>


          <td width='7' valign='top'>&nbsp;</td>
          <td width='100%' valign='top'> <p align='justify'><font face='Verdana' size='2' color='#000000'>";

if ((!@$c) || (@$c=="")): echo"Не указан файл для рассылки"; echo $footer; exit; endif;

$newc=$c;
$razd=substr ($c, 0, 1);


//читаем заголовок (заключен в ==Заголовок==) и остальное содержимое файла//
if (@file_exists("../.$base_loc/content/$c.txt")==TRUE){
$fp = fopen ("../.$base_loc/content/$c.txt" , "r");
$all= fread ($fp, filesize ("../.$base_loc/content/$c.txt"));
} else {
$fp =fopen ("../.$base_loc/content/" . $listnews[0] . ".txt" , "r");
$all= fread ($fp, filesize ("../.$base_loc/content/" . $listnews[0] . ".txt"));
$newc=$listnews[0];
}

if (preg_match("/==(.*)==/i", $all, $out)) {
$title=$out[1];
$conte = str_replace ("==$title==", "<!--Вырезал заголовок-->" , $all);
} else {
$title = "";
$conte = $all;
}
fclose ($fp);




//Если был внедрен файл
$titles[0]="";
preg_match_all ("%~~(.*)~~%" , $conte , $matches);
for  ($i=0; $i<count($matches[0]); $i++) {

$fp = fopen ("../.$base_loc/content/" .  $matches[1][$i] , "r");

$ally= fread ($fp, filesize ("../.$base_loc/content/" .  $matches[1][$i]));
$ssila=explode ("." , $matches[1][$i]);
if (preg_match("/==(.*)==/i", $ally, $outy)) {
$titles[$i]=$outy[1];
$ally = str_replace ("==" . $titles[$i] . "==", "<!--Вырезал заголовок статьи--><a name=$i></a><center><font size=2 color=\"#000000\"><b>" . $titles[$i] . "</b></font><hr noshade color='#000000' size='1'></center>" , $ally);
} else {
$titles[$i] = "Без названия";
$ally = "<a name=$i>$i</a>" . $ally;
}
$replace="<!--" .$matches[1][$i] ."-->$ally";
$conte = str_replace ("~~" . $matches[1][$i] . "~~", $replace . "<p align=\"right\"><a href=\"#top\"><img border=\"0\" src=\"http://www.dpz.ru/grey.gif\" width=\"10\" height=\"10\"><font size=\"1\" face=\"Tahoma\">назад</font></a></p><br>" , $conte);
fclose ($fp);
}
//Если был внедрен файл END



//Теперь сформируем список внедренных файлов на одной странице
if ($titles[0]==""){
$listing="";
} else {
$listing="";
reset ($titles);
while (list ($key, $val) = each ($titles)) {
$listing .= "
<img src=\"http://www.dpz.ru/tochred.gif\" border=\"0\" align=\"absbottom\"><a href=\"#$key\"><font face=\"Verdana\" size=\"2\">$val</font><br><br>\n";
}
}

//Теперь сформируем список внедренных файлов на одной странице END

$conten = str_replace ("upimages/", "<img src='upimages/" , $conte);
$conten = str_replace (".jpg-center", ".jpg' border=0 align='center'>" , $conten);
$conten = str_replace (".gif-center", ".gif' border=0 align='center'>" , $conten);
$conten = str_replace (".jpg-left", ".jpg' border=0 align='left'>" , $conten);
$conten = str_replace (".jpg-right", ".jpg' border=0 align='right'>" , $conten);
$conten = str_replace (".gif-left", ".gif' border=0 align='left'>" , $conten);
$conten = str_replace (".gif-right", ".gif' border=0 align='right'>" , $conten);


$sitetitle=$title;






//Выводим содержимое файла//
$tit= "<font face='Verdana' size='2' color='#000000'><b>$sitetitle</b></font><hr noshade color='#f5f5f5' size='2'></p>";
$hed = "<html>
<head><TITLE>стальные двери Крепкий Орешек: продажа, установка, гарантия до 5 лет, интернет-магазин. $title</TITLE>
<META HTTP-EQUIV=\"content-type\" content=\"text/html; charset=Windows-1251\">
<META NAME=\"author\" content=\"EuroWebcart 2004\">
<META name=\"keywords\" content=\"стальные двери металлические железные входные дверные замки вскрытие металическая защитная дверь стальная\">
</head><BODY background='new/a1.gif' leftmargin='0' topmargin='0'>Ссылка на статью на нашем сайте: <a href=\"http://www.dpz.ru/index.php&c=$c\">http://www.dpz.ru/index.php&c=$c</a><br><br>";
$html= $hed.$tit.$listing.$conten;

$file="../base/mail_base.txt";

$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
// теперь мы обрабатываем очередную строку $st
$st=str_replace(" ","",$st);
$st = str_replace(chr(13) , "", $st);
$st = str_replace(chr(27) , "", $st);
$st = str_replace(chr(10) , "", $st);
$st= stripslashes($st);
if ($st ==""): continue; endif;
if ($st =="xxx@yyy.com"): continue; endif;


//Генерация пароля и ссылки для внесения в базу данных
$pass="";
$hache=md5($st);
reset($hache_num);
foreach ($hache_num as $key => $value) {
$pass .= substr($hache, $value, 1);
}

$link="<br><br>Перепечатка данного материала без нашего письменного подтверждения - <b>ЗАПРЕЩЕНА</b>!<br><br>Вы подписаны на получение ежемесячных выпусков и анонсов сайта www.dpz.ru, Вы можете в любое время отписаться от нашей рассылки<br><br>
<small><b>Ссылка для удаления Вашего Email ($st) из базы рассылки:</b><br>
<a href=\"http://www.dpz.ru/unsubscribe.php?email=$st&pass=$pass" . "\">http://www.dpz.ru/unsubscribe.php?email=$st&pass=$pass</a></small><br><br>\n";

$boundary = uniqid( "");
mail ("$st","From: dpz.ru To: $st", "$html$link<br>".$lang[353]." $boundary", "From: info@dpz.ru\nContent-Type: text/html; charset=Windows-1251\nContent-Transfer-Encoding: 8bit");


echo "Отправка статьи на $st - <b>OK</b><br>\n";
}
fclose($f);
echo "<br><br>".$html.$link;
echo $footer;

?>

