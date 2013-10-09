<?php
$form = "<table border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"4\">
<tr><td><a href=\"$htpath/index.php\"><img border=\"0\" src=\"".$htpath."/logo.png\" title=\"HOME PAGE\"></a></td><td width=100%><h1>$shop_name / EuroWebcart CMS</h1></td><td align=right><a href=\"$htpath/admin/".$scriptprefix."indexator.php?speek=$speek\"><b>".$lang['adm1']."</b></a></td></tr></table>
";
echo "<table align=center border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td bgcolor=\"$nc6\" align=right>$form</td>
   </tr>
</table>";
?>
