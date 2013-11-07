<?php
if (!isset($part)) { $part=""; }
if (!preg_match("/^[yesno10_]+$/i",$part)) { $part="";}
//if (!isset($email)) { $email=""; }
//if (!preg_match("/^[a-zA-Z0-9\@\.\_\-]+$/i",$email)) { $email="";}
if (!isset($partnerid)) { $partnerid=""; }
if (!preg_match("/^[a-zA-Z0-9\.-_]+$/i",$partnerid)) { $partnerid="";}
if ((!@$other) || (@$other=="")): $other=""; endif;
if ((!@$email) || (@$email=="")): $email=""; endif;
$arr2=array ("partnerid","email","other");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags($$a);
$$a = substr($$a, 0, 3000);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("\%" , "", $$a);
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
$x0005="";
$formp="";
if (@file_exists("$base_loc/content/x0005.txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/x0005.txt" , "r");
$page_content = @fread($pageopen, @filesize("$base_loc/content/x0005.txt"));
if (preg_match("/==(.*)==/i", $page_content, $output)) {
$page_title=$output[1];
} else {
$page_title = $lang[221];
}
fclose ($pageopen);
$x0005="<div style=\"width:100%; height:300px; overflow:scroll\">".str_replace("==$page_title==", "" , $page_content)."</div><br>";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")): $x0005="<p align=right><b>".$mpz['file'].":</b> x0005<input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/x0005.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>&nbsp;<input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('admin/editor/edit.php?speek=".$speek."&amp;c=x0005&amp;del=x0005','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')></p>".$x0005; endif; }

unset ($page_content, $page_title, $pageopen);
}
if ($x0005=="") { $lang[629]="";  $formp=""; } else {$formp="<P><h4>".$lang[628].":</h4></P>";}
$formp.="$x0005<h4>".$lang[629]."</h4><FORM action=\"$htpath/index.php\" method=post><input type=hidden name=\"action\" value=\"reg_partner\"><input type=hidden name=\"part\" value=\"yes\">
<TABLE cellSpacing=0 cellPadding=3 border=0 width=100%>
<TBODY>
<TR>
<TD vAlign=top><b>*&nbsp;Partner&nbsp;ID:</b></TD>
<TD vAlign=top><INPUT size=30 name=\"partnerid\" value=\"$partnerid\" style=\"width:100%\"><br><small>".$lang[630]." <b>yoursite.com</b></small></TD></TR>
<TR>
<TD vAlign=top><b>*&nbsp;E-mail:</b></TD>
<TD vAlign=top><INPUT size=30 name=\"email\" value=\"$email\" style=\"width:100%\"><br><small>".$lang[631]."</small></TD></TR>
<TR>
<TD vAlign=top><b>*&nbsp;".$lang[85].":</b><br><br><small>max: 3000</small></TD>
<TD vAlign=top><TEXTAREA name=\"other\" rows=20 cols=44 style=\"width:100%\">$other</TEXTAREA><br><small>".$lang[632]."</small></TD></TR>
<tr>
    <td align=\"right\" valign=\"top\"></td>
    <td valign=\"top\"><b>".$lang[83]."<font color=\"#FF0000\">*</font></b> <img src=\"captcha/index.php?id=". session_id()."\" border=0><br><small>".$lang[84]."</small>
           <input type=\"text\" name=\"keystring\"></td>
  </tr>
<TR>
<TD vAlign=top></TD>
<TD vAlign=top><INPUT type=submit value=\"".$lang['sendform']."\"></TD></TR>
</TBODY></TABLE></FORM>";
if ($part=="") {$regp_list = $formp; } else {


$warn="";
$merrs="";
if ((!@$email) || (@$email=="")): $email=""; $merrs.= "<Font color=#b94a48><b>".$lang[70]." E-mail!</b></font><br>"; endif;
if ((!@$partnerid) || (@$partnerid=="")): $partnerid=""; $merrs .= "<Font color=#b94a48><b>".$lang[70]." Partner ID!</b></font><br>"; endif;
if ((!@$other) || (@$other=="")): $other=""; $merrs .= "<Font color=#b94a48><b>".$lang[70]." ".$lang[85]."!</b></font><br>"; endif;

$arr2=array ("partnerid","email","other");
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

if (@file_exists("./admin/partners/".md5($partnerid).".txt")==TRUE): $partnerid=""; $merrs .= "<Font color=#b94a48><b>".$lang[633]."</b></font><br>"; endif;
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
if(preg_match("/http:\/\//i",$partnerid)){ $merrs.=$lang[305];}
if(preg_match("/http:\/\//i",$email)){ $merrs.=$lang[305];}
if(preg_match("/http:\/\//i",$other)){ $merrs.=$lang[305];}
if ($other=="") {$merrs.=$lang[306];}

if(isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] == $_POST['keystring']){
	}else{
		$merrs.= "<br><font color=#b94a48><b>".$lang[146]."</b></font><br><br>";
	}
    unset($_SESSION['captcha_keystring']);



$regp_list="$merrs";
$mail_title=$lang[299];

if($merrs =="") {

$fpartner="./admin/partners/".md5($partnerid).".txt";
$fp=fopen($fpartner,"w");
fputs($fp,"$partnerid\n$email\n\n");
fclose($fp);
unset($fp);

$boundary = uniqid( "");





$emailbody = "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">

<meta name=\"GENERATOR\" content=\"Microsoft FrontPage 4.0\">
<meta name=\"ProgId\" content=\"FrontPage.Editor.Document\">
<title>".$lang[85]."</title>
</head>
<body>
<font face=Verdana size=2><h4>".$lang[85]."</h4>
$regid<br>
$email<br>
$other<br>
".$lang[645]." <a href=\"mailto:$email\">$email</a><br>
<br>
".$lang[353]." $boundary </font>
</body>
</html>";
$regp_list="<b>".$lang[323]."!</b><br><br><b>".$lang[634]."</b>
<br>".$lang[635]."<h4>$htpath/index.php?pid=$partnerid</h4>
".$lang[636]." \"$shop_name\".<br>
<br>".$lang[637]."<br>
<br>".$lang[638]."<br><br><a href=\"$htpath/index.php?page=x0005\">".$lang[639]."</a><br>
<br>".$lang[640]."<br><br>".$lang[641]."<br><br>
<pre>
&lt;b id=\"jsphp\"&gt;&lt;br&gt;Loading ...&lt;/b&gt;
&lt;script&gt;
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&sta=0&pid=$partnerid&catid=&unifid=1&amp;speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
&lt;/script&gt;
&lt;input type=hidden id=\"jsmax\" name=\"js_max\" value=\"0\" /&gt;
&lt;input type=hidden id=\"jscatid\" name=\"js_catid\" value=\"\" /&gt;

&lt;script language=javascript&gt;
function nextfr() {
var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
j.value=(5+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&sta='+j.value+'&pid=$partnerid&catid='+s.value+'&unifid=1&amp;speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr() {
var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
if (Math.round(j.value)&gt;=5) {
j.value=(Math.round(j.value)-5);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&unifid=1&amp;speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}
&lt;/script&gt;
</pre>
".$lang[642]."<br>";
$mail_title=$lang[209];

mail ("$shop_mail","Partner REG From: $partnerid ($email)", $emailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
mail ("$email","Partner REG To: $partnerid ($email)", "<!DOCTYPE html><html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><meta name=\"GENERATOR\" content=\"Microsoft FrontPage 4.0\"><meta name=\"ProgId\" content=\"FrontPage.Editor.Document\"><title>".$lang[85]."</title></head><body>$regid<br>$email<br>$other<br>".$regp_list."".$lang[643]." <a href=\"mailto:$shop_mail\">$shop_mail</a><br><br>".$lang[353]." $boundary </font></body></html>", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
$regp_list.="<br><b>".$lang[644]."</b><br><br><br><br>";
} else {
$regp_list .= $formp;
}
}

?>
