<?php
require ("./modules/birthday.php");
require ("./modules/mod_birthday.php");
$viewsite=1;
if ($portal==1) {if ("$valid"!="1") {  if (($register!=1)&&($action!="restore"))  { $authtype=1; } }}
if ($header_type>=2) {
if ($usetheme==1) {
$signbutton="<a href=\"index.php?sign_in=1\"><small><i class=\"icon-chevron-right\"></i>&nbsp;".$lang[940]."</small></a>";
} else {
$signbutton="<li class=f1><a href=\"index.php?sign_in=1\"><small><i class=\"icon-chevron-right\"></i>&nbsp;".$lang[940]."</small></a></li>";
}

} else {
$signbutton="<span class=regfont><a href=\"index.php?sign_in=1\"><i class=\"icon-chevron-right\"></i>&nbsp;<font style=\"border-bottom: 2px dotted;\">".$lang[940]."</font></a></span>";
}
$a_err="";

if ($valid=="0"){
if (!isset($au)) {$au=0;}
if ($action=="send") {$taction="zakaz";} else {$taction=$action;}

if ($au==1) { $_SESSION["auth_times"]+=1; $sign_in=1; $a_err="</td></tr><tr><td colspan=5 align=center><nobr><a href=\"index.php?action=restore\"><font color=#b94a48 size=1 style=\"border-bottom: 2px #b94a48 dotted;\">".$lang[110]."</font></a></nobr></tr><tr><td colspan=5 align=center><small>$lang[1082]: ".($lang[1084]-doubleval($_SESSION["auth_times"]))."</small>"; if (($lang[1084]-doubleval($_SESSION["auth_times"]))<=0) {$a_err="</td></tr><tr><td colspan=5 align=center><nobr><a href=\"index.php?action=restore\"><font color=#b94a48 size=1 style=\"border-bottom: 2px #b94a48 dotted;\">".$lang[110]."</font></a></nobr></tr><tr><td colspan=5 align=center><small><b>$lang[1083]!</b></small>";}}
if ($css_style==1) {
if ($authtype==1) {
$auth="<script type=\"text/javascript\">
function submit_auth(e)
{
	if (e.keyCode == 13)
	{
		document.ok.submit();
		return false;
	}
}

</script><form name=\"ok\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\"><table border=0 cellspacing=0 cellpadding=2 width=150><tr><td align=right><nobr><small><b>".$lang['login'].":</b></small></nobr></td>
<td colspan=2><input type=hidden name=\"au\" value=1><input type=hidden name=\"action\" value=\"$taction\"><input type=hidden name=\"query\" value=\"$query\"><input type=hidden name=\"page\" value=\"$page\"><input type=hidden name=\"logout\" value=\"1\">
<input type=text size=\"12\" name=\"login\" value=\"$login\" onkeyup=\"submit_auth(event);\"><input type=hidden name=\"catid\" value=\"$catid\"><input type=hidden name=\"unifid\" value=\"$unifid\"></td>
<td>&nbsp;</td></tr><tr><td align=right><nobr><small><b>".$lang['pass'].":</b></small></nobr></td>
<td align=left><input type=password size=\"12\" name=\"password\" value=\"$password\" onkeyup=\"submit_auth(event);\">
<td><td><i class=\"icon-chevron-right\" id=\"subm\" title=\"OK\" style=\"cursor: pointer; cursor: hand\" onclick=\"document.ok.submit();\"></i>$a_err</td>
</tr></table></form>";
}
if ($authtype==2) {
$auth="<form name=\"ok\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
<table border=0 cellspacing=2 cellpadding=0 width=150>
<tr>
<td align=right><nobr><small><b>".$lang['login'].":</b></small></nobr>
</td>
<td><input type=hidden name=\"au\" value=1><input type=hidden name=\"action\" value=\"$taction\"><input type=hidden name=\"query\" value=\"$query\"><input type=hidden name=\"page\" value=\"$page\"><input type=hidden name=\"logout\" value=\"1\">
<input style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=25&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" type=text size=\"12\" name=\"login\" value=\"$login\"><input type=hidden name=\"catid\" value=\"$catid\"><input type=hidden name=\"unifid\" value=\"$unifid\">
</td>
<td><img src=\"".$image_path."/pix.gif\" border=0 width=10 height=15>
</td>
<td align=right><nobr><small><b>".$lang['pass'].":</b></small></nobr>
</td>
<td align=left><nobr><input style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=25&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" type=password size=\"6\" name=\"password\" value=\"$password\">
<input type=submit id=\"subm\" style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; font-size: 7pt; background-image: url('grad.php?h=25&w=1&e=".str_replace("#","",lighter($nc0,-20))."&s=".str_replace("#","",$nc0)."&d=vertical'); background-repeat: repeat-x\" value=\"OK\">$a_err</nobr>
</td>
</tr>
</table>
</form>";
}
if ($authtype==3) {
$auth="$signbutton";
if ($header_type>=2) {
$enter="$enter$signbutton";
} else {
$enter="$enter&nbsp;&nbsp;$signbutton";
}
}

} else {

if ($authtype==1) {
$auth="<form name=\"ok\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\"><table border=0 cellspacing=2 cellpadding=0 width=150>
<tr><td align=right><nobr><small><b>".$lang['login'].":</b></small></nobr></td>
<td colspan=2><input type=hidden name=\"au\" value=1><input type=hidden name=\"action\" value=\"$taction\"><input type=hidden name=\"query\" value=\"$query\"><input type=hidden name=\"page\" value=\"$page\"><input type=hidden name=\"logout\" value=\"1\">
<input style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=20&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" type=text size=\"12\" name=\"login\" value=\"$login\"><input type=hidden name=\"catid\" value=\"$catid\"><input type=hidden name=\"unifid\" value=\"$unifid\"></td>
</tr><tr><td align=right><nobr><small><b>".$lang['pass'].":</b></small></nobr></td>
<td align=left><nobr><input style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=20&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" type=password size=\"6\" name=\"password\" value=\"$password\">
<input type=submit id=\"subm\" style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; font-size: 7pt; background-image: url('grad.php?h=25&w=1&e=".str_replace("#","",lighter($nc0,-20))."&s=".str_replace("#","",$nc0)."&d=vertical'); background-repeat: repeat-x\" value=\"OK\"></nobr>$a_err</td>
</tr></table></form>";
}
if ($authtype==1) {
$auth="<form name=\"ok\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\"><table border=0 cellspacing=2 cellpadding=0 width=150>
<tr><td align=right><nobr><small><b>".$lang['login'].":</b></small></nobr></td>
<td><input type=hidden name=\"au\" value=1><input type=hidden name=\"action\" value=\"$taction\"><input type=hidden name=\"query\" value=\"$query\"><input type=hidden name=\"page\" value=\"$page\"><input type=hidden name=\"logout\" value=\"1\">
<input style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=20&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" type=text size=\"12\" name=\"login\" value=\"$login\"><input type=hidden name=\"catid\" value=\"$catid\"><input type=hidden name=\"unifid\" value=\"$unifid\"></td>
<td><img src=\"".$image_path."/pix.gif\" border=0 width=10 height=15></td><td align=right><nobr><small><b>".$lang['pass'].":</b></small></nobr></td>
<td align=left><nobr><input style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; height:20px; font-size: 8pt; background-color: ".lighter($nc0,-10)."; background-image: url('grad.php?h=20&w=1&e=".str_replace("#","",lighter($nc0,0))."&s=".str_replace("#","",lighter($nc0,-10))."&d=crystal'); background-repeat: repeat-x\" type=password size=\"6\" name=\"password\" value=\"$password\">
<input type=submit id=\"subm\" style=\"color: $nc5; border: 1px solid ".lighter($nc0,-20)."; padding: 2px; font-size: 7pt; background-image: url('grad.php?h=25&w=1&e=".str_replace("#","",lighter($nc0,-20))."&s=".str_replace("#","",$nc0)."&d=vertical'); background-repeat: repeat-x\" value=\"OK\">$a_err</nobr></td>
</tr></table></form><br>";
}
if ($authtype==3) {
$auth="$signbutton";
if ($header_type>=2) {
$enter="$enter$signbutton";
} else {
$enter="$enter&nbsp;&nbsp;$signbutton";
}
}

}

$loginout=$auth;
}else {
if ($authtype==3) {
$auth="$signbutton";
if ($header_type>=2) {
if ($usetheme==1) {
$enter="<span style=\"white-space: nowrap;\" class=regfont><a href=\"index.php?action=cabinet\" title=\"$lang[380]\"><i class=\"icon-user\"></i>&nbsp;<b>".$details[1]."</b></a>&nbsp;&nbsp;&nbsp;$enter</span>";

}else {
$enter="<li class=\"f1 active\"><a href=\"index.php?action=cabinet\" title=\"$lang[380]\"><small>".$details[1]."</small></a></li>$enter";
}
} else {
$enter="<span style=\"white-space: nowrap;\" class=regfont><a href=\"index.php?action=cabinet\" title=\"$lang[380]\"><i class=\"icon-user\"></i>&nbsp;<b>".$details[1]."</b></a>&nbsp;&nbsp;&nbsp;$enter</span>";
}
}
$loginout="<table border=0><tr><td colspan=2><span style=\"white-space: nowrap;\" class=regfont><a href=\"index.php?action=cabinet\"><i class=icon-home></i><b>&nbsp;".str_replace(" ", "&nbsp;", $lang[380])."</b></a></span></td></tr></table>";
if ($header_type>=2) {
if ($usetheme==1) {$signbutton="<a href=\"index.php?logout=1\" class=nowrap><small><i class=\" icon-share\"></i>&nbsp;".$lang['exit']."</small></a>";  } else {
$signbutton="<li class=f1><a href=\"index.php?logout=1\"><small><i class=\" icon-share\"></i>&nbsp;".$lang['exit']."</small></a></li>";
}
} else {
$signbutton="<a href=\"index.php?logout=1\"><i class=\" icon-share\"></i><font color=$nc2>&nbsp;".$lang['exit']."</font></a>";
}
}
$loginout="<table border=0 cellpadding=5 cellspacing=0 style=\"background-image: url($image_path/50w.png);
border-top-left-radius: 10px;
border-top-right-radius: 10px;
border-bottom-right-radius: 10px;
border-bottom-left-radius: 10px;\"><tr><td>$loginout</td></tr></table>";
if($sign_in==1) {$auth=""; $signbutton=""; $loginout="";}

if ($usetheme==1) {
topwo("", "$signbutton", "100%",  $nc0, $nc0 , "noshadow",1, "[signbutton]");
}


$signin="<script type=\"text/javascript\">
function submit_auth(e)
{
	if (e.keyCode == 13)
	{
		document.signin.submit();
		return false;
	}
}

</script><div><table border=0 width=100% cellspacing=10 cellpadding=0><tr>
<td width=50% valign=top valign=bottom align=center>
<b>".$lang[464]."</b><br><br>

<form name=\"signin\" action=\"".$_SERVER['PHP_SELF']."\" id=signin method=\"POST\">
<input type=hidden name=\"au\" value=1>

<table border=0 cellpadding=5 cellspacing=0>
<tr>
<td align=center>
<input type=hidden name=\"logout\" value=\"1\">
<div class=\"input-prepend\">
    <span class=\"add-on\"><i class=\"icon-user\"></i></span><input class=\"span2\" id=\"prependedInput\" size=\"16\" type=\"text\" name=login value=\"$login\" placeholder=\"".$lang['login']."\">
    </div>
</td>
</tr>
<tr>
<td align=center>
<div class=\"input-prepend\">
    <span class=\"add-on\"><i class=\"icon-eye-open\"></i></span><input class=\"span2\" id=\"prependedInput\" size=\"16\" type=\"password\" name=password value=\"$password\" placeholder=\"".$lang['pass']."\">
    </div>
$a_err
</td>
<tr>
<td align=center><a href=\"#sign\" class=\"btn btn-large btn-primary\" id=\"subm\" onclick=\"document.getElementById('signin').submit();\"><i class=\"icon-ok icon-white\"></i><font color=white>&nbsp;".$lang[940]."</a><br><br><i><a href=\"$htpath/index.php?action=restore\" style=\"border-bottom: 2px $nc3 dotted;\">".str_replace(" ", "&nbsp;", $lang[86])."</a></i></td>
</tr>
</table></form>
</td>
<td width=1 bgcolor=\"".$nc6."\"><img src=\"$image_path/pix.gif\" border=0 width=1 height=1></td>
<td width=50% valign=bottom align=center>
<b>".$lang[467]."</b><br><br>
<table border=0 cellpadding=5 cellspacing=0>
<tr><td>
<a href=\"index.php?register=1\" class=\"btn btn-large btn-success\" href=\"#register\"><i class=\"icon-user icon-white\"></i>&nbsp;<font color=white>".str_replace(" ", "&nbsp;", $lang[39])."</font></a>
<br><br><br>
</td></tr></table>
</td>
</tr></table><br><br><br><div class=\"well\" style=\"padding:20px;\">".$lang['regtext']."</div></div>";
if ($portal==1) {if ("$valid"!="1") { $viewsite=0; if (($register!=1)&&($action!="restore")) {  $signin=""; echo "<div align=center><table width=350 height=100% border=0><tr><td align=center>"; top("<font size=2>$lang[939]</font>", "<div align=center><script type=\"text/javascript\">
function submit_auth(e)
{
	if (e.keyCode == 13)
	{
		document.ok.submit();
		return false;
	}
}

</script><form name=\"ok\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" id=regf><table border=0 cellspacing=0 cellpadding=8 width=100%><tr><td align=right valign=middle><nobr><small><b>".$lang['login'].":</b></small></nobr></td>
<td colspan=2 valign=middle><input type=hidden name=\"au\" value=1><input type=hidden name=\"action\" value=\"$taction\"><input type=hidden name=\"query\" value=\"$query\"><input type=hidden name=\"page\" value=\"$page\"><input type=hidden name=\"logout\" value=\"1\">
<input type=text size=\"12\" name=\"login\" value=\"$login\" onkeyup=\"submit_auth(event);\" style=\"width:200px;margin: 0px 0px 0px 0px;\"><input type=hidden name=\"catid\" value=\"$catid\"><input type=hidden name=\"unifid\" value=\"$unifid\"></td>
<td>&nbsp;</td></tr><tr><td align=right valign=middle><nobr><small><b>".$lang['pass'].":</b></small></nobr></td>
<td align=left valign=middle><input type=password size=\"12\" name=\"password\" value=\"$password\" onkeyup=\"submit_auth(event);\" style=\"width:200px;margin: 0px 0px 0px 0px;\">
<td><td valign=middle><img src=$image_path/enter.png id=\"subm\" title=\"OK\" style=\"cursor: pointer; cursor: hand\" onclick=\"document.ok.submit();\" hspace=10>".str_replace(" align=left", " align=\"center\"", $a_err)."</td>
</tr></table></form>$enter</div>", "100%",  $nc3, $nc0 , "noshadow",1, "[content]");   echo "</td></tr></table></div>"; exit; }
}
}


?>
