<?php
$contactform="
<form action=\"$htpath/index.php\" method=post><input type=hidden name=\"action\" value=\"sendok\">
<table class=table cellspacing=0 cellPadding=3 border=0 width=100%>
<tbody>
<tr>
<td valign=top><small><font color=$nc5 style=\"text-transform: uppercase\">".$lang[74].":</font></small></td>
<td colspan=2 valign=top><input type=text size=30 name=\"fio\" value=\"\" style=\"width:90%\"></td></tr>
<tr>
<td valign=top><small><font color=$nc5 style=\"text-transform: uppercase\">".$lang[85].":</font></small></td>
<td colspan=2 valign=top><textarea name=\"other\" rows=4 cols=44 style=\"width:90%\"></textarea></td></tr>
<tr>
<td valign=top><small><font color=$nc5 style=\"text-transform: uppercase\">E-mail:</font></font></td>
<td colspan=2 valign=top><input type=text size=30 name=\"email\" value=\"\" style=\"width:90%\"></td></tr>
<tr>
    <td align=\"right\" valign=\"top\"><img src=\"captcha/index.php?id=". session_id()."\" border=0></td>
    <td valign=\"top\"><input type=\"text\" name=\"keystring\"><br><small><font color=$nc5>".$lang[83]."</font></small></td><td align=right valign=bottom><input class=\"btn btn-primary btn-large\" type=submit value=\"".$lang['sendform']."\">
           </td>
  </tr>
</tbody></table></form>";
?>
