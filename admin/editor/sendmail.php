<?php


if ((!@$for) || (@$for=="")): $for=""; endif;
if ((!@$mes0) || (@$mes0=="")): $mes0=""; endif;
if ((!@$mes1) || (@$mes1=="")): $mes1="��������� �������!\n�� ���� ���� ���������� � ����������� ����� ����� � ����������!\n"; endif;
if ((!@$mes2) || (@$mes2=="")): $mes2="����� ��������, ������� � ����� ������������, �������� � ������� ������������, ����� ���� �������� ����� ���� ��� ��������.\n
� ����� ���� �� ����������� ��� ��� ����� ����������� � ����� �������� ����� ������, ��������� ������� ������� � �� �������� ������ � ������� ��� ����� ��������.   "; endif;
if ((!@$mes4) || (@$mes4=="")): $mes4=""; endif;
if ((!@$mes5) || (@$mes5=="")): $mes5="������� �.�"; endif;


echo "<p><font color='#000000' size='3'><b>������������ �������� ������:</b></font><hr><font color='#000000' size='2'>";
$fcontents = file("../shop2/zakazi/list.txt");
while (list ($line_num, $line) = each ($fcontents)) {
$out=explode("|",$line);
$nomer = $out[0];
$link = $out[1];
$milo = $out[2];
$fio = $out[3];
$tel = $out[4];
$metro = $out[5];
$now = $out[6];
$del = $out[15];
$got = $out[16];
$master = $out[18];
list($ddd, $mmm, $yyy, $ttt) = sscanf($now , "%d.%d.%d %s");



$boundary = uniqid( "");
$headers =  "From: info@dpz.ru\n
Content-Type: text/html;\n
charset=\"Windows-1251\"\n
Content-Transfer-Encoding: 7bit\n";
$emailbody = "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">

<meta name=\"GENERATOR\" content=\"Microsoft FrontPage 4.0\">
<meta name=\"ProgId\" content=\"FrontPage.Editor.Document\">
<title>$fio! �� ������� ���������� ��������!</title>
</head>
<body>
<div align=\"center\">
<center><font size=\"2\" face=\"Tahoma\"><b>$fio!</b><br>��� ������ ���������� ��������!</font><br>
<table border=\"0\">
<tr>
<td width=\"100%\">
<IFRAME SRC=\"http://www.dpz.ru/mail/card_ss.php?for=$fio&mes0=$mes0&mes1=$mes1&mes2=$mes2%20%20%20&mes4=$mes4&mes5=$mes5\" framespacing=\"0\" marginwidth=\"0\" marginhight=\"0\" frameborder=\"0\" scrolling=\"NO\" resize=\"NO\" HSPACE=0 VSPACE=0 WIDTH=540 HEIGHT=380>
</iframe></td>
</tr>
<tr>
<td width=\"100%\">
  <p align=\"center\"><font size=\"1\" face=\"Tahoma\">���� �� ������ ������� ��������������� ��������, ���� �� ������ �� ������ - ����� <a href=\"http://www.dpz.ru/mail/card_ss.php?for=$fio&mes0=$mes0&mes1=$mes1&mes2=$mes2%20%20%20&mes4=$mes4&mes5=$mes5\">������� �����</a>!</font></p>
</td>
</tr>
</table></center>
</div>
</body>
</html>";
@mail ("$milo","$fio! ��� ������ ���������� ��������!", $emailbody, "From: info@dpz.ru\nContent-Type: text/html; charset=Windows-1251\nContent-Transfer-Encoding: 8bit");
echo "$fio, <b>$milo</b> - OK<br>";
}
echo "</font><br><font color='#000000' size='3'><b>�������� �� �������� ��������� �� E-mail ������� ���������</b></font><hr><p>";


?>

