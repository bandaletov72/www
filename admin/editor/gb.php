<html>

<?php
if ((!@$pass) || (@$pass=="")): $pass=""; $red=""; $password="";endif;
if ($pass=="rbgbnvjqhfpev"): $red=", редактирование"; $password="&pass=$pass"; endif;

include "header.inc";









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
$line = $lang[221];
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

<br><br><br><div align='center'><font face='Verdana' size='2' color='#000000'><b>служебные функции</b></font><hr noshade color='#0069DD' size='1'></div><div align='center'><font face='Verdana' size='1' color='#000000'><a href='/index.php'><img src=\"admin.gif\" border=0 title=\"Aдмин\">Административный интерфейс</a></font>
</font></div>
<img src='/images/pix.gif ' border='0' width='200' height ='1'></td>
                </tr>
              </table>
              <p>&nbsp;</p>
            </div></td>
          <td width='7' valign='top'>&nbsp;</td>
          <td width='100%' valign='top'> <p align='justify'><font face='Verdana' size='2' color='#000000'>";






//А теперь сама гостевуха//

echo "<h4><b><font color=#0069DD><small>Книга отзывов$red:</small></font></b><hr noshade color='#0069DD' size='1'></h4>";
if ((!@$perpage) || (@$perpage=="")): $perpage=10; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;

$gb = "";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;

$rem1="";
$rem2="";
$rem3="";
$rem4="";
$st=0;
if ($start==0): $rem3="<!--"; $rem4="-->"; endif;


$fcontents2 = file("gb.txt");
while (list ($line_num, $line) = each ($fcontents2)) {
$out=explode("|",$line);
$id = $out[0];
$date = $out[1];
$name = $out[2];
$text = $out[3];
settype ($id, "integer");

/* Для сортировки правильной давай переведем номер из представления 1 в представление 000001*/
$chars= intval(strlen($id));
if ($chars==1): $sortby="00000$id"; endif;
if ($chars==2): $sortby="0000$id"; endif;
if ($chars==3): $sortby="000$id"; endif;
if ($chars==4): $sortby="00$id"; endif;
if ($chars==5): $sortby="0$id"; endif;
if ($chars==6): $sortby="$id"; endif;

settype ($line_num, "integer");
if ($pass=="rbgbnvjqhfpev"): $editpost=" | <a href='gbeditpost.php?pass=$pass&id=$id'>Редактировать</a> | <a href='gbdelpost.php?pass=$pass&id=$id'>Удалить</a>"; endif;
if ($pass==""): $editpost=""; endif;

$files2[$st] = "<!--$sortby--><font color=#0069DD><b>$date</b></font> | Автор: <b>$name</b>$editpost<br>$text<hr noshade color='#0069DD' size='1'>";

$st += 1;
}
if ((!@$files2[0]) || (@$files2[0]=="")): $files2[0]=""; echo "<p><center>Нет ни одной записи!</center><p><hr noshade color='#0069DD' size='1'>";  $rem1="<!--"; $rem2="-->"; include "form.inc"; include "footer.inc"; exit; endif;
//сортировка по алфавиту//

rsort ($files2);

reset ($files2);
$st=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$files2[($start+$st)]) || (@$files2[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$files2[($start+$st)]) || (@$files2[($start+$st)]=="")): $files2[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
$val = $files2[($start+$st)];
$st += 1;
if (is_long(($st/2)) == "TRUE") {
$back="#FFFFFF";
} else {
$back="#F8F8F8";
}
$gb .= "<tr bgcolor='$back'><td align='left' valign='top'><small>$val</small></td></tr>\n";
}
$total = count ($files2)-$gt;

$numberpages = (floor ($total/$perpage))+1;
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;
if ($end == $total): $rem1="<!--"; $rem2="-->"; endif;

$stat= "<center><small>".$lang[203]." <b>$numberpages</b> | ".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b>$rem3 | <a href = 'gb.php?start=$prev&perpage=$perpage$password'>&lt;&lt; Предыдущие $perpage</a>$rem4$rem1 | <a href = 'gb.php?start=$next&perpage=$perpage$password'>Следующие $perpage &gt;&gt;</a>$rem2$rem3 | <a href = 'gb.php?start=0&perpage=$perpage'>В начало</a>$rem4</small><br>";
echo $stat . "<br><table width=100% border='0'>\n";
echo $gb . "</table>" . $stat . "<hr noshade color='#0069DD' size='1'>";

if ($pass==""): include "form.inc"; endif;

echo "<p align='right'><small>&gt;&gt; <a href='gbedit.php'>Редактор гостевой книги</a></small>";

include "footer.inc";
?>

</body>
</html>
