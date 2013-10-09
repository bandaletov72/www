<?php

$warn="";
$merrs="";
if ((!@$email) || (@$email=="")): $email=""; $merrs.= "<Font color=#b94a48><b>".$lang[70]." E-mail!</b></font><br>"; endif;
if ((!@$fio) || (@$fio=="")): $fio=""; $merrs .= "<Font color=#b94a48><b>".$lang[70]." ".$lang[75]."!</b></font><br>"; endif;
if ((!@$other) || (@$other=="")): $other=""; $merrs .= "<Font color=#b94a48><b>".$lang[70]." ".$lang[85]."!</b></font><br>"; endif;

$arr2=array ("fio","email","other");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags($$a);
$$a = substr($$a, 0, 3000);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace("|" , "", $$a);
$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);
$$a = str_replace(chr(10) , "<br>", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
$$a=deny_badwords($$a);
}
//Проверим правильность Email

$bad_symbols= array("\\" . chr(36),"<",">", "\%", "\^", "\*", "\+", "\=", "\ " ,"\|" ,"\," ,"\/" ,"\;" ,"\:" ,"\[" ,"\]" ,"\{" ,"\}" ,"\(" ,"\"" ,"'" ,"\)");
reset ($bad_symbols);
$merror="";
$merror2="";
$merr=$lang[150];
$merr2=$lang[646];
foreach ($bad_symbols as $key => $value) {
if (preg_match("/".$value."/i", $email) == TRUE): $value = str_replace("<" , "&lt;", $value); $value = str_replace(">" , "&gt;", $value); $merror .= ",\"<b>" . substr($value, 1) . "</b>\""; endif;
}
$matches = explode("@", $email);
if (count($matches) == 1): $merror2.=$lang[151]."<br>\n"; endif;
if (((count($matches)-1) >= 2) && (count($matches) !== 1)): $merror2.=$lang[303]. " \"<b>@</b>\" - ".$lang[302].".<br>\n"; endif;
if ($matches[0] == ""): $merror2.=$lang[152]."<br>\n"; endif;
if (substr($matches[0],0,1)=="."): $merror2.="".$lang[338]."<br>\n"; endif;
if (end ($matches) == ""): $merror2.=$lang[153]."<br>\n"; endif;

if (preg_match("/(.*)\@(.*)\.(.*)/i", $email) == FALSE): $merror2.="".$lang[42]." Email.<br>\n"; endif;





if($merror !==""): $merror2.=$lang[300]." " . substr ($merror, 1) . " - ".$lang[154]."<br>\n"; endif;

$email_html = str_replace("<" , "&lt;", $email);
$email_html = str_replace(">" , "&gt;", $email_html);
if($merror2 !==""):  $merrs .= "<p align=left><Font color=#b94a48><b>$merr $email_html</b></font><br><small>$merror2</small></p>"; endif;
if(preg_match("/http:\/\//i",$fio)){ $merrs.=$lang[305];}
if(preg_match("/http:\/\//i",$email)){ $merrs.=$lang[305];}
if(preg_match("/http:\/\//i",$other)){ $merrs.=$lang[305];}
if ($other=="") {$merrs.=$lang[306];}// Антиспам

// Антиспам
if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
	}else{
		$merrs.= "<br><font color=#b94a48><b>".$lang[146]."</b></font><br><br>";
	}
    unset($_SESSION['captcha_keystring']);
// Антиспам

if ($merrs!="") {
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","$merrs"));
$erview.="',{
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false
    });

});
    </script>";
$merrs="$erview";
}
$maillist="$merrs";
$mail_title=$lang[299];

if($merrs =="") {
$boundary = uniqid( "");




/* Конец записи в файл, отправка на почту и вывод файла на экран*/
$ssts="<b><a href=$htpath/index.php?action=view_users&filter=".$details[1].">".$details[1]."</a></b> ".$details[6]." -&gt;".str_replace("|","", @$_SESSION["sfrom"]." / ".@$_SESSION["stag"])." ".$mpz['time'].": " .gmdate("H:i:s", (time()-$_SESSION["stime"]));
$emailbody = "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">

<meta name=\"GENERATOR\" content=\"Microsoft FrontPage 4.0\">
<meta name=\"ProgId\" content=\"FrontPage.Editor.Document\">
<title>".$lang[85]."</title>
</head>
<body>
<font face=Verdana size=2><h4>".$lang[85]."</h4>
$other<br>
".$lang[645]." <a href=\"mailto:$email\">$email</a><br>
<br>$ssts<br>
".$lang[353]." $boundary </font>
</body>
</html>";
$maillist="<b>".$lang[323]."!</b><br><br><font color=#468847><b>".$lang[324]." ". date("d.m.Y (D) H:i") . "</b>!</font><br><br><b>".$lang[325]."</b><br><br>";
$mail_title=$lang[209];

mail ("$shop_mail","From: $fio ($email)", $emailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
} else {
require ("./modules/mailform.php");
$maillist .= $bodytext;
}


?>
