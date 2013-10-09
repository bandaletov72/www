<?php
if(isset($_GET['iagree'])){ $iagree=$_GET['iagree']; }elseif(isset($_POST['iagree'])) {$iagree=$_POST['iagree']; }else {$iagree="";}
if (!preg_match('/^[a-z0-9]+$/i',$iagree)) { $iagree="";}

if ((!isset($_SESSION["explicit_warning"]))||($_SESSION["explicit_warning"]=="")){ $_SESSION["explicit_warning"]="NO"; }
if ($iagree==md5(date("d.m.Y",time()).$secret_salt)){$_SESSION["explicit_warning"]="YES";}
if ($_SESSION["explicit_warning"]=="NO"){
if ($explicit_warning!=0) {
echo "<noindex><div style=\"z-index:99999; top:0px, left:0px; right:0px; width:100%; height:10000px; background-image: url($image_path/pegibg.png); padding:50px; position: absolute;\" align=center><div class=shadow style=\"background:$lang[1060]; padding: 30px; width: 550px\">
<font color=$lang[1059]>
<table width=100% border=0><tr><td valign=top><a href=\"$lang[1055]\"><img src=\"$image_path/$lang[1047]\" title=\"$lang[1042]\" border=0></a></td>
<td width=100% valign=top><font color=#b94a48><font size=6>$lang[1041]</font></font><font color=$lang[1059]><br><b>$lang[1042]:</b><br>";
if ($lang[1050]!="") { echo "$lang[1050]. "; }
if ($lang[1052]!="") { echo "$lang[1052]. "; }
if ($lang[1054]!="") { echo "$lang[1054]. "; }
$urltogo=request_url();
if (!preg_match("/iagree/", $urltogo)) {
if (preg_match("/\&/", $urltogo)) {$urltogo.="&iagree=".md5(date("d.m.Y",time()).$secret_salt);} else {
if (preg_match("/\?/", $urltogo)) {
$urltogo.="&iagree=".md5(date("d.m.Y",time()).$secret_salt);
} else {
$urltogo.="?iagree=".md5(date("d.m.Y",time()).$secret_salt);
}
}
} else {
$urltogo="$htpath/index.php?iagree=".md5(date("d.m.Y",time()).$secret_salt);
}
echo "<br><br>$lang[1043]</font></td>
</tr></table><div align=center><br><font color=\"$lang[1062]\"><b>$lang[1046]</b></font><br><br>
<button class=btn type=button onclick=\"document.location.href='".$urltogo."';\"><font color=#468847>V</font>&nbsp;&nbsp;$lang[1044]</button>
&nbsp;&nbsp;&nbsp;
<button class=btn type=button onclick=\"document.location.href='".$lang[1056]."';\"><font color=#b94a48>X</font>&nbsp;&nbsp;$lang[1045]</button>
</div><br><div align=center><hr size=1 noshade color=\"$lang[1059]\"><table width=100% border=0><tr><td valign=top>";
if ($lang[1050]!="") { echo "<img src=\"$image_path/$lang[1049]\" title=\"$lang[1050]\" border=0>"; }
if ($lang[1052]!="") { echo "<img src=\"$image_path/$lang[1051]\" title=\"$lang[1052]\" border=0>"; }
if ($lang[1054]!="") { echo "<img src=\"$image_path/$lang[1053]\" title=\"$lang[1054]\" border=0>"; }
echo "</td><td valign=top><font color=$lang[1059]><small><b>$lang[1042]:</b> ";
if ($lang[1050]!="") { echo "$lang[1050]. "; }
if ($lang[1052]!="") { echo "$lang[1052]. "; }
if ($lang[1054]!="") { echo "$lang[1054]. "; }
echo "</small></font></td></tr></table></div></font></div></div></noindex>";

}
}
?>
