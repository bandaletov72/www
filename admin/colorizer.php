<?php
function RGB2Hex($rgbcol) {
$rgbcol=str_replace(" ", "",str_replace("rgb", "", str_replace("(", "", str_replace(")", "", $rgbcol))));
$tmprgb=explode(",",$rgbcol);

$hexr= dechex($tmprgb[0]);
if (strlen("$hexr")<2) {$hexr="0".$hexr;}
$hexg= dechex($tmprgb[1]);
if (strlen("$hexg")<2) {$hexg="0".$hexg;}
$hexb= dechex($tmprgb[2]);
if (strlen("$hexb")<2) {$hexb="0".$hexb;}
$hex="#".$hexr.$hexg.$hexb;
return $hex;
}

function repnc($nc){
global $lang;
$torep=Array(
0 => $lang[705],
1 => $lang[706],
2 => $lang[707],
3 => $lang[708],
4 => $lang[709],
5 => $lang[710],
6 => $lang[711],
7 => $lang[712],
8 => $lang[713],
9 => $lang[714],
10 => $lang[715]
);
if (isset($torep[$nc])){return $torep[$nc];} else {return "nc$nc";}
}
if (!isset($do)) {$do="";}
$qcol=10;
if (!isset($qcol)) {$qcol=10;}
$fold=".";
if (($do=="newtheme")&&($action=="colors")) {
$op=0;
$strcol="$tn-$nameoftheme|";
while ($op<=$qcol) {
$opp="nav_col$op";
if (substr($$opp,0,3)=="rgb") {$$opp=RGB2Hex($$opp);}
$strcol.=$$opp."|";
$op+=1;
}
$nnc=fopen("$fold"."/templates/$template/colors"."/themes.txt","a");
fputs($nnc, str_replace("\"", "", str_replace("\\", "" , $strcol))."\n");
fclose ($nnc);
unset ($nnc);
$theme=$tn;
}

if (($do=="savetheme")&&($action=="colors")&&($tn!=0)) {
$op=0;
$strcol="$nameoftheme|";
while ($op<=$qcol) {
$opp="nav_col$op";
if (substr($$opp,0,3)=="rgb") {$$opp=RGB2Hex($$opp);}
$strcol.=$$opp."|";
$op+=1;
}
$themes=file("$fold"."/templates/$template/colors"."/themes.txt");
$themes[($tn-1)]=str_replace("\"", "", str_replace("\\", "" , $strcol))."\n";
$nnc=fopen("$fold"."/templates/$template/colors"."/themes.txt","w");
fputs($nnc, join("",$themes));
fclose ($nnc);
unset ($nnc,$themes);
$theme=$tn;
}

if (($do=="deltheme")&&($action=="colors")&&($tn!=0)) {
$op=0;
$strcol="";
while ($op<=$qcol) {
$opp="nav_col$op";
if (substr($$opp,0,3)=="rgb") {$$opp=RGB2Hex($$opp);}
$strcol.=$$opp."|";
$op+=1;
}
$themes=file("$fold"."/templates/$template/colors"."/themes.txt");
if (isset($themes[($tn-1)])){
$themes[($tn-1)]="";
$nnc=fopen("$fold"."/templates/$template/colors"."/themes.txt","w");
fputs($nnc, join("",$themes));
fclose ($nnc);
unset ($nnc,$themes);
$theme=$tn;
$theme=0;
}
}

if (($do=="save")&&($action=="colors")) {
$op=0;
$strcol="";
while ($op<=$qcol) {
$opp="nav_col$op";
if (substr($$opp,0,3)=="rgb") {$$opp=RGB2Hex($$opp);}
$strcol.=$$opp."|";
$op+=1;
}
$nnc=fopen("$fold"."/templates/$template/colors"."/colors.txt","w");
fputs($nnc, str_replace("\"", "", str_replace("\\", "" , $strcol)));
fclose ($nnc);
unset ($nnc);
echo "<meta http-equiv=\"Refresh\" content=\"0; URL=./admin/".$scriptprefix."indexator.php?speek=$speek\">";
}


$themecolors="";
$qcol=0;
$brbr=1;
$themes=file("$fold"."/templates/$template/colors"."/themes.txt");
while (list ($themkey, $themval) = each ($themes)) {
if (($themval!="")&&($themval!="\n")&&($themval!="\r")) {
$tmpthemmas=explode("|", $themval); $brbr+=1;
if ($brbr==4){$break="<br><br>";$brbr=1;}else {$break="";}

$themecolors .= "&nbsp;<a href=\"$htpath/index.php?action=colors&mod=admin&theme=".($themkey+1)."\" title=\"".$tmpthemmas[0]."\"><b><font color=".$tmpthemmas[6]." style=\"background-color:".$tmpthemmas[1].";\"\">T</font></b><img border=\"0\" src=\"$image_path/pix.gif\" width=\"3\" height=\"13\" style=\"background-color: ".$tmpthemmas[8]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"1\" height=\"13\" style=\"background-color: ".$tmpthemmas[10]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"3\" height=\"13\" style=\"background-color: ".$tmpthemmas[9]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"5\" height=\"13\" style=\"background-color: ".$tmpthemmas[11]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"2\" height=\"13\" style=\"background-color: ".$tmpthemmas[7]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"3\" height=\"13\" style=\"background-color: ".$tmpthemmas[3]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"3\" height=\"13\" style=\"background-color: ".$tmpthemmas[1]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"3\" height=\"13\" style=\"background-color: ".$tmpthemmas[5]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"3\" height=\"13\" style=\"background-color: ".$tmpthemmas[1]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"3\" height=\"13\" style=\"background-color: ".$tmpthemmas[4]."\"><img border=\"0\" src=\"$image_path/pix.gif\" width=\"5\" height=\"13\" style=\"background-color: ".$tmpthemmas[2]."\"></font></a>&nbsp; $break";
$qcol+=1;
}
}
if ($themecolors==""){$themecolors="осярн";}

$op=0;
$nncolors="<script language=javascript>
function selectcolor(arg) {
document.getElementById('color').style.backgroundColor=arg;
document.getElementById('color2').style.backgroundColor=arg;
}
function newtheme(arg) {
document.getElementById('todo').value='newtheme';
document.getElementById('tn').value=arg;
document.colortable.submit();
}
function savetheme(arg) {
document.getElementById('todo').value='savetheme';
document.getElementById('tn').value=$theme;
document.colortable.submit();
}
function deltheme(arg) {
document.getElementById('todo').value='deltheme';
document.getElementById('tn').value=$theme;
document.colortable.submit();
}
function setcolors(arg) {
var newarg='nav_'+arg;
document.getElementById(arg).style.backgroundColor=document.getElementById('color').style.backgroundColor;
document.getElementById(newarg).value=document.getElementById('color').style.backgroundColor;

}
</script>

<table border=0 cellspacing=20 cellpadding=0><tr><td><table border=0><tr><td colspan=2 valign=top><b>".$lang[716].":</b><br><br></td></tr>";
$themename="".$lang[717]." '$theme'";
if ((isset($theme))&&($theme!=0)){
$nnc=file("$fold"."/templates/$template/colors"."/themes.txt");
$colrmas=explode("|", $nnc[($theme-1)]);
$themename=$colrmas[0];
array_shift($colrmas);
$qcol=0;
while (list ($colrkey, $colrval) = each ($colrmas)) {
if (($colrval!="")&&($colrval!="\n")&&($colrval!="\r")) {
if (substr($colrval,0,3)=="rgb") {$colrval=RGB2Hex($colrval);}
$nncolors .= "<tr><td>".repnc("$colrkey").": </td><td><input id=nav_col$colrkey type=text name=\"nav_col$colrkey\" size=7 value=\"". $colrval."\"></td><td><a href=javascript:setcolors('col$colrkey')><img border=\"1\" src=\"$image_path/pix.gif\" width=\"20\" height=\"20\" align=bottom style=\"background-color: ".$colrval ."\" id=\"col$colrkey\"></a></td></tr>";
$qcol+=1;
}
}
}

if (($qcol==0)||($theme==0)) {
$nnc=file("$fold"."/templates/$template/colors"."/colors.txt");
$colrmas=explode("|", $nnc[0]);
$qcol=0;
while (list ($colrkey, $colrval) = each ($colrmas)) {
if (($colrval!="")&&($colrval!="\n")&&($colrval!="\r")) {
if (substr($colrval,0,3)=="rgb") {$colrval=RGB2Hex($colrval);}
$nncolors .= "<tr><td>".repnc("$colrkey").": </td><td><input id=nav_col$colrkey type=text name=\"nav_col$colrkey\" size=7 value=\"". $colrval."\"></td><td><a href=javascript:setcolors('col$colrkey')><img border=\"1\" src=\"$image_path/pix.gif\" width=\"20\" height=\"20\" align=bottom style=\"background-color: ".$colrval ."\" id=\"col$colrkey\"></a></td></tr>";
$qcol+=1;
}
}
}


$nncolors.="<input type=hidden name=\"qcol\" value=$qcol></table></td><td bgcolor=#f1f1f1><img src=\"$image_path/pix.gif\" width=\"1\" height=\"1\"></td><td>&lt;<br>&lt;<br>&lt;<br></td><td valign=top align=center><b>".$lang[722].":</b><br><br><br><img border=\"1\" src=\"$image_path/pix.gif\" width=\"140\" height=\"50\" align=bottom style=\"background-color: #ffffff\" id=\"color\"><br><br><b>".$lang[723].":</b><br><br>$themecolors<br><br><small>".$lang[724]."</small></td></tr></table>";


$site_colors="<p align=center><center>";

$site_colors .= "
<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" name=\"colortable\"><input type=hidden name=\"action\" value=\"colors\">
<input type=hidden name=\"mod\" value=\"admin\"><input type=hidden id=\"todo\" name=\"do\" value=\"save\">
<input type=hidden id=\"tn\" name=\"tn\" value=\"$theme\">
".@$nncolors."<b>".$lang[718].":</b> <input type=text name=nameoftheme value=\"$themename\"><br>
<br><input type=submit value=\"".$lang[719]."\">";
if ($theme!=0){$site_colors .= "<br><br><input onclick=\"javascript:deltheme(".$theme.")\" type=button value=\"".$lang[720]."\"> <input onclick=\"javascript:savetheme(".$theme.")\" type=button value=\"".$lang[721]."\">";}
$site_colors .= "<br><br><input onclick=\"javascript:newtheme(".(count($themes)+1).")\" type=button value=\"".$lang[725]." #".(count($themes)+1)."\"><hr style=\"border-style: dashed; border-width: 1px\" size=\"1\" color=\"$nc2\"><b>".$lang[726]."</b><br><br>
<table border=0><tr><td valign=top align=center>WEB Color<br>";
// function PHP colorizer v.1.0 EuroWebcart
$xstep=16;
$ystep=51;
$zstep=51;
$width=10;
$height=10;
function hexa ($arg) {
if ($arg>255) {$arg=255;}
$arg=dechex($arg);

if (strlen($arg)<=1) {$arg="0".$arg;}
return $arg;
}

//starting WEB 216 color
$xx=0;
$yy=0;
$zz=0;
while ($zz<=255) {
while ($yy<=255) {
while ($xx<=255) {
$site_colors .= "<a href=\"#".hexa(255-$xx). hexa(255-$yy). hexa(255-$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx). hexa(255-$yy). hexa(255-$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx). hexa(255-$yy). hexa(255-$zz)."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$xx=0;
$yy+=$ystep;
}
$yy=0;
$zz+=$zstep;
}
$site_colors .= "</td>\n\n\n\n<td valign=top align=center>RGB Color<br>";

//starting red
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}


//starting green
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx). hexa(255-$xx+$zz).hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx). hexa(255-$xx+$zz).hexa(255-$xx)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx). hexa(255-$xx+$zz).hexa(255-$xx) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}

//starting blue
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx). hexa(255-$xx). hexa(255-$xx+$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx). hexa(255-$xx). hexa(255-$xx+$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx). hexa(255-$xx). hexa(255-$xx+$zz)."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}
$site_colors .= "Greyscale Color<br>";
//starting grey
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx) .hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx+$zz)."')><img title=\"#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx+$zz) ."\" border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx+$zz) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}


$site_colors .= "<br><br>Zoom:</td>\n\n\n\n<td valign=top align=center>CMY Color<br>";


//starting Cyan
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx).hexa(255-$xx+$zz) .hexa(255-$xx+$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx).hexa(255-$xx+$zz) .hexa(255-$xx+$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx).hexa(255-$xx+$zz) .hexa(255-$xx+$zz) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}

//starting Magenta
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx) . hexa(255-$xx+$zz)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx) . hexa(255-$xx+$zz)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx) . hexa(255-$xx+$zz)."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}

//starting Yellow
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$site_colors .= "<a href=\"#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx)."\" onclick=javascript:selectcolor('#".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx)."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".hexa(255-$xx+$zz).hexa(255-$xx+$zz) .hexa(255-$xx) ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}



$site_colors .= "Random Color<br>";

//random color
$blue=0;
while ($blue<=255/$xstep) {
$xx=0;
$zz=0;
while ($xx<=255) {
$zz+=$blue;
$hexa=hexa(255-rand(0,255)).hexa(255-rand(0,255)) .hexa(255-rand(0,255));
$site_colors .= "<a href=\"#".$hexa."\" onclick=javascript:selectcolor('#".$hexa."')><img border=\"0\" src=\"$image_path/pix.gif\" width=\"$width\" height=\"$height\" style=\"background-color: #".$hexa ."\"></a>";
$xx+=$xstep;
}
$site_colors .= "<br>\n";
$blue+=2;
}
$site_colors .= "<br><img border=\"1\" src=\"$image_path/pix.gif\" width=\"160\" height=\"50\" align=bottom style=\"background-color: #ffffff\" id=\"color2\"></td></tr></table></center></form></p>";
?>
