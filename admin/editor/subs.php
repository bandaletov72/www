<?php
include "header.inc";
//�������� ������������ Email
if ((!@$email) || (@$email=="")): $email=""; echo "�� �� ������� Email! ��������� � ������� Email."; include "footer.inc"; exit; endif;
$email = trim($email);
$email = str_replace(chr(13) , "", $email);
$email = str_replace(chr(27) , "", $email);
$email = stripslashes($email);
$bad_symbols= array("\\" . chr(36),"<",">", "\%", "\^", "\*", "\+", "\=", "\ " ,"\|" ,"\," ,"\/" ,"\;" ,"\:" ,"\[" ,"\]" ,"\{" ,"\}" ,"\(" ,"\"" ,"'" ,"\)");

$hache_num = array (5,9,12,2,29,23,7,17); #8 ����� �� 1-31
reset ($bad_symbols);
$error="";
$error2="";
$err=$lang[150];
$err2=$lang[646];
$back="<script Language=\"JavaScript\"><!--
function check(theForm)
{

  if (theForm.email.value == \"\")
  {
    alert(\"���������� ������� ��� Email.\");
    theForm.email.focus();
    return (false);
  }
  return (true);
}
//--></script>
<form method=\"POST\" action=\"".$_SERVER['PHP_SELF'] ."\" onsubmit=\"return check(this)\" name=\"form\">
  <b>���������� ��������� ��� Email:<br><br>
  <input type=\"text\" name=\"email\" size=\"20\" value=\"$email\"> <input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\"  style=\"background-color: #FF0000; font-family: Tahoma; font-size: 8pt; color: #FFFFFF; font-weight: bold; border: 1 solid #000000\">
</form>";
foreach ($bad_symbols as $key => $value) {
if (preg_match("/".$value."/i", $email) == TRUE): $value = str_replace("<" , "&lt;", $value); $value = str_replace(">" , "&gt;", $value); $error .= ",\"<b>" . substr($value, 1) . "</b>\""; endif;
}
$matches = explode("@", $email);
if (count($matches) == 1): $error2.=$lang[151]."<br>\n"; endif;
if (((count($matches)-1) >= 2) && (count($matches) !== 1)): $error2.=$lang[303]. " \"<b>@</b>\" - ".$lang[302].".<br>\n"; endif;
if ($matches[0] == ""): $error2.=$lang[152]."<br>\n"; endif;
if (substr($matches[0],0,1)=="."): $error2.="".$lang[338]."<br>\n"; endif;
if (end ($matches) == ""): $error2.=$lang[153]."<br>\n"; endif;

if (preg_match("/(.*)\@(.*)\.(.*)/i", $email) == FALSE): $error2.="������ � ���������� Email.<br>\n"; endif;
if($error !=""): $error2.=$lang[300]." " . substr ($error, 1) . " - ". $lang[302].".<br>\n"; endif;

$email_html = str_replace("<" , "&lt;", $email);
$email_html = str_replace(">" , "&gt;", $email_html);
if($error2 !==""): echo "<p align=center><Font color=#b94a48><b>$err $email_html</b></font><br><br><b>$err2</b><br><small>$error2 <br><b>$back</b></small></p>";  include "footer.inc"; exit; endif;
$file="./base/mail_base.txt";

$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
// ������ �� ������������ ��������� ������ $st
if ($st=="$email\n"): echo"������ Email ��� ��� ������ � ���� ������ ��������."; include "footer.inc"; fclose($f); exit; endif;
}
fclose($f);
echo "<b>Email:</b> $email<br>\n";
//��������� ������ � ������ ��� �������� � ���� ������
$pass="";
$hache=md5($email);
reset($hache_num);
foreach ($hache_num as $key => $value) {
$pass .= substr($hache, $value, 1);
}

$link="<b>�������!</b> �� ������������� ����������� �� ��������� ����������� �������� � ������� ����� www.dpz.ru<br>
� ���������� �� ������ � ����� ����� ���������� �� ����� ��������<br><br>
<small><b>������ ��� ���������� ������ Email � ���� ��������:</b><br>
<a href=\"" . "http://" . $_SERVER ["HTTP_HOST"]
                . dirname($_SERVER['PHP_SELF']) . "/autorize.php?email=$email&pass=$pass" . "\">" . "http://" . $_SERVER ["HTTP_HOST"]
                . dirname($_SERVER['PHP_SELF']) . "/autorize.php?email=$email&pass=$pass</a></small><br><br>\n";

$boundary = uniqid( "");

$emailbody = "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\">

<meta name=\"GENERATOR\" content=\"Microsoft FrontPage 4.0\">
<meta name=\"ProgId\" content=\"FrontPage.Editor.Document\">
<title>������������� ��������</title>
</head>
<body>
$link
<br>
<br>
".$lang[353]." $boundary
</body>
</html>";
mail ("$email","From: dpz.ru To: $email", $emailbody, "From: info@dpz.ru\nContent-Type: text/html; charset=Windows-1251\nContent-Transfer-Encoding: 8bit");


echo "� ����� ������������ - ��� ���������� ������ �� ���������� Email � �������, ������� ���� ��������, ����� ����������� ���� ����������� � ����� ������ ��������. ��� ������� ��� ����, ����� �� ���� �������, ��� ������ �� ����������� ������ ������ �� ���.";

include "footer.inc";
?>
