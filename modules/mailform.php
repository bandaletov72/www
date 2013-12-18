<?php

if ((!@$email) || (@$email=="")): $email=@$details[4]; endif;
if ((!@$fio) || (@$fio=="")): $fio=@$details[1]; endif;
if (@$fio==""): $fio=$lang[193]; endif;
if ((!@$other) || (@$other=="")): $other=""; endif;
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
$x0009="";
if ((@file_exists("$base_loc/content/x0009.txt")==TRUE)) {

if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")): $x0009="<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">x0009</span><br><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/x0009.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>&nbsp;<input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=x0009&del=x0009','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')></div>"; endif;}



if (@file_exists("$base_loc/content/x0009.txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/x0009.txt" , "r");
$x0009 .= @fread($pageopen, @filesize("$base_loc/content/x0009.txt"));
if (preg_match("/==(.*)==/i", $x0009, $output)) {
$x0009_title=$output[1];
$x0009=str_replace("==".$x0009_title."==","",$x0009);
} else {
$x0009_title = $lang[221];
}
fclose ($pageopen);

}
}
$bodytext="$x0009
<P><STRONG>".$lang[307]."</STRONG></P>
<FORM action=\"$htpath/index.php\" method=post><input type=hidden name=\"action\" value=\"sendok\">
<TABLE class=table cellSpacing=0 cellPadding=3 border=0 width=100%>
<TBODY>
<TR>
<TD vAlign=top><b>* ".$lang[74].":</b></TD>
<TD vAlign=top><INPUT type=text size=30 name=\"fio\" value=\"$fio\" style=\"width:90%\"></TD></TR>
<TR>
<TD vAlign=top><b>* E-mail:</b></TD>
<TD vAlign=top><INPUT type=text size=30 name=\"email\" value=\"$email\" style=\"width:90%\"></TD></TR>
<TR>
<TD vAlign=top><b>* ".$lang[85].":</b><br><br><small>max: 3000</small></TD>
<TD vAlign=top><TEXTAREA name=\"other\" rows=10 cols=44 style=\"width:90%\">$other</TEXTAREA></TD></TR>
<tr>
    <td align=\"right\" valign=\"top\"></td>
    <td valign=\"top\"><b>".$lang[83]."<font color=\"#FF0000\">*</font></b> <img src=\"captcha/index.php?id=". session_id()."&rnd=".time()."\" border=0><br><small>".$lang[84]."</small>
           <input type=\"text\" class=input-small name=\"keystring\"></td>
  </tr>
<TR>
<TD vAlign=top></TD>
<TD vAlign=top><input class=\"btn btn-primary btn-large\" type=submit value=\"".$lang['sendform']."\"></TD></TR>
</TBODY></TABLE></FORM>";
?>
