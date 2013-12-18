<html>
<head>
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
if ((!@$c) || (@$c=="")): $c="y"; endif;
$sh=substr ($c, 0, 1);
if ($sh=="f"): $sh==""; endif;
$newc=$c;
$razd=substr ($c, 0, 1);

//читаем заголовок (заключен в ==Заголовок==) и остальное содержимое файла//
$fp = fopen ("../.$base_loc/content/$c.txt" , "r");

$all= fread ($fp, filesize ("../.$base_loc/content/$c.txt"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$title=$out[1];
$conte = str_replace ("==$title==", "<!--Вырезал заголовок-->" , $all);
} else {
$title = "";
$conte = $all;
}

$conten = str_replace ("upimages/", "<img src='upimages/" , $conte);
$conten = str_replace (".jpg-center", ".jpg' border=0 align='center'>" , $conten);
$conten = str_replace (".gif-center", ".gif' border=0 align='center'>" , $conten);
$conten = str_replace (".jpg-left", ".jpg' border=0 align='left'>" , $conten);
$conten = str_replace (".jpg-right", ".jpg' border=0 align='right'>" , $conten);
$conten = str_replace (".gif-left", ".gif' border=0 align='left'>" , $conten);
$conten = str_replace (".gif-right", ".gif' border=0 align='right'>" , $conten);


fclose ($fp);

echo "<title>$title</title>";
$sitetitle=$title;


echo "<meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>" .
"<link rel='stylesheet' href='style.css' type='text/css'>" .
"</head><BODY background='new/a1.gif' bgcolor='#ECEEF7' background='images/abmback.gif' leftmargin='0' topmargin='0'>" .
"<TABLE align=left border=0 cellPadding=0 cellSpacing=0 width='95%'>" .
"<TBODY><TR><TD width=20 align='left' valign='bottom'><img border='0' src='images/flashright.gif' width='20' height='64'></TD>" .
"<TD valign='bottom' background='images/flashb.gif'>";

if ((!@$sh) || (@$sh=="")): $sh=""; endif;

echo "<OBJECT classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'
 codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0'
 WIDTH=687 HEIGHT=139>
 <PARAM NAME=movie VALUE='site.swf'> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#ECEEF7> <EMBED src='site.swf' quality=high bgcolor=#ECEEF7  WIDTH=687 HEIGHT=139 TYPE='application/x-shockwave-flash' PLUGINSPAGE='http://www.macromedia.com/shockwave/download/engine.cgi?P1_Prod_Version=ShockwaveFlash'></EMBED>
</OBJECT>" .
"</TD><TD width=20 valign='bottom' align='right'><img border='0' src='images/flashleft.gif' width='20' height='64'></TD></TR>
<TR><TD background='images/lefttable.gif' width=20>&nbsp;</TD>
<TD><table width='100%' border='0' cellspacing='0' cellpadding='5'>
<tr><td width='200' valign='top'><table width='100%' border='0' cellspacing='0' cellpadding='5'>
<tr><td valign='top'> <div align='justify'> <font color='#005ED2' size='2' face='Verdana'>";

//Выведем новости//
$st=0;
echo "<br>
<div align='center'><font face='Verdana' size='2' color='#000000'><b>новости сайта</b></font></div><hr noshade color='#0069DD' size='1'><div align='left'>";
$handle=opendir('news/');
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')) {
continue;
} else {
$fp = fopen ("news/$file" , "r");
$out=explode(".",$file);
$c = $out[0];
$all= fread ($fp, filesize("news/$file"));
if (preg_match("/==(.*)==/i", $all, $out)) {
$title=$out[1];
$news = str_replace ("==$title==", "<!--Вырезал заголовок-->" , $all);
} else {
$title = "";
$news = $all;
}
fclose ($fp);
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || (strlen($cc)==1)) {
continue;
} else {
$name ="$title";
$filesn[$st] = "<!--$file--><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#6699ff'><b>$title</b></font>&nbsp;&nbsp;<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'>$news</font><br><br>\n";
$st += 1;
}
}
}
closedir ($handle);
//сортировка по алфавиту//
arsort ($filesn);
reset ($filesn);
while (list ($key, $val) = each ($filesn)) {
echo "$val\n";
}


$c=$newc;
$st = 0;
//А теперь все материалы сайта кроме подкатегорий//
echo "<br>
<div align='center'><font face='Verdana' size='2' color='#000000'><b>разделы на сайте</b></font></div><hr noshade color='#0069DD' size='1'><div align='left'>
<br>";

$handle=opendir("../.$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..') || ($file == 'config.inc')) {
continue;
} else {
$fp = fopen ("../.$base_loc/content/$file" , "r");

$all= fread ($fp, 1024);
if (preg_match("/==(.*)==/i", $all, $out)) {
$lune=$out[1];
} else {
$lune = $lang[221];
}

fclose ($fp);
$out=explode(".",$file);
$c = $out[0];
if ((strlen($c)==1) && ($c!="z")) {
$files[$st]="<!--$c--><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><img src='./images/open.gif' border='0' align='absmiddle'><a href='./engine.php?c=$c'><b>$lune</b></a></font><br>";
$st += 1;
}
}
}
closedir ($handle);
//сортировка по алфавиту//
asort ($files);
reset ($files);
while (list ($key, $val) = each ($files)) {
echo "$val\n";
}


echo "<img src='images/open.gif' border='0' align='absmiddle'></font></font><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><b><a href='gb.php'>Отзывы и предложения</a></b></font> <font color='#005ED2' size='2' face='Verdana'>

<br><br><br><div align='center'><font face='Verdana' size='2' color='#000000'><b>служебные функции</b></font><hr noshade color='#0069DD' size='1'></div><div align='center'><font face='Verdana' size='1' color='#000000'><a href='/index.php'><img src=\"admin.gif\" border=0 title=\"Aдмин\">Административный интерфейс</a><br><a href='edit.php?speek=".$speek."&c=$newc'>Редактировать страницу</a><br><a href='edit.php?speek=".$speek."&c=$razd&klon=1'>Добавить страницу в этот раздел</a><br><a href='editnews.php?c=a&klon=1'>Добавить новость</a></font>
</font></div>
<img src='/images/pix.gif ' border='0' width='200' height ='1'></td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </div></td>
          <td width='7' valign='top'>&nbsp;</td>
          <td width='100%' valign='top'> <p align='justify'><font face='Verdana' size='2' color='#000000'>";

//Выводим содержимое файла//

echo "<div align='right'><font face='Verdana' size='3' color='#0069DD'><b>$sitetitle</b></font><hr noshade color='#0069DD' size='1'></div>";
echo "$conten";
$c=$newc;

//А тут только ссылки по конкретному разделу//
echo "</div><br><br><div align='left'>";
$st=0;
echo "<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><b>Дополнительные материалы этого раздела:</b><hr noshade color='#0069DD' size='1'>";
$handle=opendir("../.$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..') || ($file == 'config.inc')) {
continue;
} else {
$fp = fopen ("../.$base_loc/content/$file" , "r");

$all= fread ($fp, 1024);
if (preg_match("/==(.*)==/i", $all, $out)) {
$line=$out[1];
} else {
$line = fread ($fp, 1024);
}

fclose ($fp);
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || ((substr($c, 0, 1))!=(substr($cc, 0, 1)))) {
continue;
} else {
if (strlen($cc)==1) {
$name ="<a href='engine.php?c=$cc'>$line</a>";

$files2[$st] = "<!--$file--><img src='images/open.gif' border='0' align='absmiddle'><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><b>$name</b></font><br><br>\n";
$st += 1;
} else {
$name ="$line &nbsp;&nbsp;<a href='engine.php?c=$cc'>&gt;&gt;Подробнее</a>";

$files2[$st] = "<!--$file--><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'>$name</font><br><br>\n";
$st += 1;
}
}
}
}
closedir ($handle);

if (count($files2)== 1): $files2[0]="<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'>В этом разделе дополнительных ссылок нет</font>";  endif;
//сортировка по алфавиту//
asort ($files2);
reset ($files2);
while (list ($key, $val) = each ($files2)) {
echo "$val\n";
}

echo "<br><hr noshade color='#0069DD' size='1'><br>b>Powered by:</b> <a href=\"http://www.eurowebcart.com\">EuroWebcart CMS</a> (c) Eurowebcart</td>
        </tr>
      </table>
    </td>
    <td width='20' background='images/righttable.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='20' background='images/leftbottom.gif'>&nbsp;</td>
    <td background='images/bottom.gif'>
      <div align='right'><font face='Verdana' size='1' color='#ffffFF'>Copyright
        &copy2003 www.dpz.ru</font></div>
    </td>
    <td width='20' background='images/rightbottom.gif'>&nbsp;</td>
  </tr>
</table>
</body>
</html>";
?>

