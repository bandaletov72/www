<?php
$version=Array();
$kkkr="Licensed version";
if (file_exists("./install.php")) {unlink ("./install.php"); }
if (file_exists("./shop.zip")) {unlink ("./shop.zip"); }
$lic_lis="";
require "./templates/defaults.inc";

$cdef2="";
while (list ($kcd2, $vcd2) = each ($c_default2)) {
$cdef2.="<option>$kcd2</option>\n";
}
$lps="<br><div class=round style=\"overflow:hidden;\"><b>$lang[907]:</b><br><br>";
$cdef1="";
while (list ($kcd2, $vcd2) = each ($lpacks)) {
$ex="$lang[906]";
if (file_exists("./templates/$template/$vcd2/vars.txt")==TRUE) {$ex="<b>$lang[905]</b>"; $cdef1.="<option value=\"$vcd2\">$kcd2</option>\n";}
$lps.="<div style=\"width:280px; float:left; display:block; margin-left: auto;\"><img src=\"images/flag_".$vcd2.".png\"> $kcd2 - $ex</div>\n";
}
$lps.="</div>";
if(isset($_GET['inst_path'])) $inst_path=$_GET['inst_path']; elseif(isset($_POST['inst_path'])) $inst_path=$_POST['inst_path']; else $inst_path="$shopdir";
if (!isset($inst_path)){$inst_path="$shopdir";} $inst_path=trim(stripslashes($inst_path)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$inst_path)) { $inst_path="$shopdir";}
if ( $inst_path=="/") {$inst_path="";}

if(isset($_GET['def_users_db_type'])) $def_users_db_type=$_GET['def_users_db_type']; elseif(isset($_POST['def_users_db_type'])) $def_users_db_type=$_POST['def_users_db_type']; else $def_users_db_type="$users_db_type";
if (!isset($def_users_db_type)){$def_users_db_type="$users_db_type";} $def_users_db_type=trim(stripslashes($def_users_db_type)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$def_users_db_type)) { $def_users_db_type="$users_db_type";}

if(isset($_GET['def_users_mode'])) $def_users_mode=$_GET['def_users_mode']; elseif(isset($_POST['def_users_mode'])) $def_users_mode=$_POST['def_users_mode']; else $def_users_mode="$smod";
if (!isset($def_users_mode)){$def_users_mode="$smod";} $def_users_mode=trim(stripslashes($def_users_mode)); if (!preg_match("/^[shopite]+$/i",$def_users_mode)) { $def_users_mode="$smod";}


if(isset($_GET['def_items_db_type'])) $def_items_db_type=$_GET['def_items_db_type']; elseif(isset($_POST['def_items_db_type'])) $def_items_db_type=$_POST['def_items_db']; else $def_items_db_type="$items_db_type";
if (!isset($def_items_db_type)){$def_items_db_type="$items_db_type";} $def_items_db_type=trim(stripslashes($def_items_db_type)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$def_items_db_type)) { $def_items_db_type="$items_db_type";}

if(isset($_GET['def_mysql_server'])) $def_mysql_server=$_GET['def_mysql_server']; elseif(isset($_POST['def_mysql_server'])) $def_mysql_server=$_POST['def_mysql_server']; else $def_mysql_server="$mysql_server";
if (!isset($def_mysql_server)){$def_mysql_server="$mysql_server";} $def_mysql_server=trim(stripslashes($def_mysql_server)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$def_mysql_server)) { $def_mysql_server="$mysql_server";}

if(isset($_GET['def_mysql_user'])) $def_mysql_user=$_GET['def_mysql_user']; elseif(isset($_POST['def_mysql_user'])) $def_mysql_user=$_POST['def_mysql_user']; else $def_mysql_user="$mysql_user";
if (!isset($def_mysql_user)){$def_mysql_user="$mysql_user";} $def_mysql_user=trim(stripslashes($def_mysql_user)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$def_mysql_user)) { $def_mysql_user="$mysql_user";}
if(isset($_GET['def_mysql_pass'])) $def_mysql_pass=$_GET['def_mysql_pass']; elseif(isset($_POST['def_mysql_pass'])) $def_mysql_pass=$_POST['def_mysql_pass']; else $def_mysql_pass="$mysql_pass";
if (!isset($def_mysql_pass)){$def_mysql_pass="";} $def_mysql_pass=trim(stripslashes($def_mysql_pass)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$def_mysql_pass)) { $def_mysql_pass="$mysql_pass";}
//echo "\"$def_mysql_pass\"";
if(isset($_GET['def_mysql_db_name'])) $def_mysql_db_name=$_GET['def_mysql_db_name']; elseif(isset($_POST['def_mysql_db_name'])) $def_mysql_db_name=$_POST['def_mysql_db_name']; else $def_mysql_db_name="$mysql_db_name";
if (!isset($def_mysql_db_name)){$def_mysql_db_name="$mysql_db_name";} $def_mysql_db_name=trim(stripslashes($def_mysql_db_name)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$def_mysql_db_name)) { $def_mysql_db_name="$mysql_db_name";}

if(isset($_GET['def_dbpref'])) $def_dbpref=$_GET['def_dbpref']; elseif(isset($_POST['def_dbpref'])) $def_dbpref=$_POST['def_dbpref']; else $def_dbpref="$dbpref";
if (!isset($def_dbpref)){$def_dbpref="$dbpref";} $def_dbpref=trim(stripslashes($def_dbpref)); if (!preg_match("/^[‡-ˇ¿-ﬂ∏®a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$def_dbpref)) { $def_dbpref="$dbpref";}
//echo "1.".$defl;
if(isset($_GET['defl'])) $defl=$_GET['defl']; elseif(isset($_POST['defl'])) $defl=$_POST['defl']; else $defl="$speek";
if (!isset($defl)){$defl="$speek";} $defl=trim(stripslashes($defl));
//echo " 2.".$defl;
if (!preg_match("/^[a-zA-Z0-9]+$/i",$defl)) { $defl="$speek";}
//echo " 2.".$defl;
if(isset($_GET['defc'])) $defc=$_GET['defc']; elseif(isset($_POST['defc'])) $defc=$_POST['defc']; else $defc="$valut";
if (!isset($defc)){$defc="$valut";} $defc=trim(stripslashes($defc)); if (!preg_match("/^[a-zA-Z0-9_-]+$/i",$defc)) { $defc="$valut";}
if(isset($_GET['defo'])) $defo=$_GET['defo']; elseif(isset($_POST['defo'])) $defo=$_POST['defo']; else $defo="$okr";
if (!isset($defo)){$defo="$okr";} $defo=trim(stripslashes($defo)); if (!preg_match("/^[0-9_.\,]+$/i",$defo)) { $defo="$okr";}

if(isset($_GET['prms'])) $prms=$_GET['prms']; elseif(isset($_POST['prms'])) $prms=$_POST['prms']; else $prms="";
if (!isset($prms)){$prms="$okr";} $prms=trim(stripslashes($prms)); if (!preg_match("/^[0-9a-zA-Z_-]+$/i",$prms)) { $prms="";}
$tzonm=Array("Europe/Moscow");
$tzonm=@file("./templates/$template/timezone.inc");
$tzones="";
while (list ($tzk, $ltzl) = each ($tzonm)) {
if (trim(trim($ltzl))!="") {
$tzones.="^".trim(trim($ltzl));
}
}
$chrsm=Array("Europe/Moscow");
$chrsm=@file("./templates/$template/charsets.inc");
$chrses="";
while (list ($chsk, $chsl) = each ($chrsm)) {
if (trim(trim($chsl))!="") {
$chrses.="^".strtoken(trim(trim($chsl)),"|");
}
}
$vars_lis=Array();
if ((!@$perpages) || (@$perpages=="")){ $perpages=20;}
if (!preg_match("/^[0-9_]+$/",$perpages)) { $perpages=$goods_perpage;}
if ($perpages>100) {$start=0;}
if ((!@$start) || (@$start=="")){ $start=0; }
if ((!@$starts) || (@$starts=="")){ $starts=0; }
if (!preg_match("/^[0-9_]+$/",$start)) { $start=0;}
if (!preg_match("/^[0-9_]+$/",$starts)) { $starts=0;}
if ($start>99999) {$start=0;}



if (!isset($speeks)) {$speeks=$language;}
if (!preg_match("/^[a-zA-Z]+$/i",$speeks)) { $speeks="$language";}
$varfile="./templates/$template/$speeks/vars.txt";

if (!isset($mod)){$mod="";} if (!preg_match("/^[a-zA-Z]+$/i",$mod)) { $mod="";}
if (!isset($chok)){$chok="";} if (!preg_match("/^[a-zA-Z]+$/i",$chok)) { $chok="";}

if (($chok=="ok")&&($mod=="admin")&&(isset($en))&&(isset($ev))&&(isset($evo))&&(isset($nk))) {

$fp = fopen ($varfile , "r");
$vcontent= fread($fp, @filesize($varfile));
fclose ($fp);
$vpar="";
while (list ($thtt, $lineth) = each ($en)) {
//echo $en[$thtt]. " = ".$evo[$thtt]. " -&gt; ".$ev[$thtt]. " ". $nk[$thtt]."<br>";
if(get_magic_quotes_gpc()) {$ev[$thtt] = stripslashes($ev[$thtt]);$evo[$thtt] = stripslashes($evo[$thtt]);}


$errt[$thtt]="";
//if (is_long(substr_count($ev[$thtt], "\"")/2)==FALSE) {$evo[$thtt] = str_replace("\"","\\\"", $evo[$thtt]); $errt[$thtt]="<font color=#b94a48><b>".$lang[42]."! </b></font>"; $vpar=$errt[$thtt];} else {

//$ev[$thtt] = str_replace("\"","", $ev[$thtt]);
//$evo[$thtt] = str_replace("\\\"","", $evo[$thtt]);
//$evo[$thtt] = str_replace("\"","\\\"", $evo[$thtt]);
if ($nk[$thtt]=="YES") {$evo[$thtt]="\"".$evo[$thtt]."\""; $ev[$thtt]="\"".$ev[$thtt]."\""; } else {
$ev[$thtt]=str_replace("\,", "\.", $ev[$thtt]." ");
$ev[$thtt]=str_replace(",", ".", $ev[$thtt]." ");
$ev[$thtt]=doubleval($ev[$thtt]);
$ev[$thtt]=str_replace(",", ".", $ev[$thtt]);

}
if(get_magic_quotes_gpc()) {
if (substr($ev[$thtt],0,1) =="\"") {
$ev[$thtt]=substr($ev[$thtt],1,-1);
$ev[$thtt]="\"".addslashes(stripslashes($ev[$thtt]))."\"";
}
if (substr($evo[$thtt],0,1) =="\"") {
$evo[$thtt]=substr($evo[$thtt],1,-1);
$evo[$thtt]="\"".addslashes(stripslashes($evo[$thtt]))."\"";
}
}
$vcontent=str_replace("\$$lineth=".$evo[$thtt].";", "\$$lineth=".$ev[$thtt].";",$vcontent);
if ($evo[$thtt]!=$ev[$thtt]) {
$vpar.= "\$$lineth=".htmlspecialchars($evo[$thtt])."; -&gt; \$$lineth=".htmlspecialchars($ev[$thtt]).";<br>";
}
//$fcontentt[$thtt]=str_replace("\$theme_file=\"$theme_file\";", "\$theme_file=\"$thtml\";",$lineth);

//}
}
//echo "<br><textarea cols=60 rows=15>$vcontent</textarea>";
//echo "<br><br><br>$vcontent";
$fp=fopen($varfile,"w"); flock ($fp, LOCK_EX);
fputs($fp, "$vcontent"); flock ($fp, LOCK_UN);
fclose ($fp);
top($lang[209], $lang[647]."<BR><BR>$vpar", "100%", strtolower($style ['sale']), strtolower($style ['bg_content']),0, 0, "[content]");
}
$hhelp="";
if (@file_exists("./help/$speek/mainparameters.htm")) {$hhelp="<div align=right><img src=\"$image_path/help.gif\" border=0 title=\"".$lang['46']."\"> <a href=\"#hhelp\" onClick=javascript:window.open('$htpath/help/$speek/mainparameters.htm','hhelp','status=no,scrollbars=yes,menubar=yes,resizable=yes,location=no,width=800,height=580,left=10,top=10')>".$lang['46']." [MAIN]</a></div><br>";}
$fcontents = file("$varfile");
$pcount=0;
unset ($tmp, $tmp2, $key, $val);
while(list($kef,$val)=each($fcontents)) {
if ((trim($val)!="")&&(trim($val)!="<?")&&(trim($val)!="?>")&&(trim($val)!="<?php")) {
$pcount++;
}
}
$tabs= "";



$vars_list="$hhelp<form class=form-inline action=\"index.php\" name=form_dest method=\"POST\">
<input type=hidden name=\"action\" value=\"vars\">
<input type=hidden name=\"perpages\" value=\"$perpages\">
<input type=hidden name=\"mod\" value=\"admin\">
<input type=hidden name=\"chok\" value=\"ok\">
<input type=hidden name=\"prms\" value=\"$prms\">

<table class=\"table table-striped\" width=100% border=0 cellpadding=4 cellspacing=0><tbody>
<tr>
<td align=center><small><b>#</b></small></td>
<td align=center><small><b>".$lang['name']."</b></small></td>
<td align=center colspan=2><small><b>".$lang[648]."</b></small></td>
</tr>";


reset($fcontents);
//sort($fcontents);
$st=1;
$hidd=0;
$next=$start+$perpages;
$prev=$start-$perpages;
if ($prev <=0) { $prev=0; }

$nexts=$starts+$perpages;
$prevs=$starts-$perpages;
if ($prevs <=0) { $prevs=0; }


while (list ($line_num, $line) = each ($fcontents)) {
$line= str_replace("\"", "^",str_replace("\\", "~",str_replace("<?php", "",str_replace("?>", "",$line))));
//top("", $st."'".$line."(".ord($line).")'", "100%", strtolower($style ['sale']), strtolower($style ['bg_content']),0, 0, "[content]");
$param=ExtractString($line, "\$", "=");
if ($param!="") {
$vnazv=ExtractString($line, " //", ": ");
$vznach=ExtractString($line, "=", "; //");
$vopis=str_replace("$vnazv:", "", ExtractString($line, " //", "\n"));
$kavuse="NO"; $strpar=$lang[651]." ";
//if (!isset($errt[$st])) {$errt[$st]="";}

if (substr($vznach,0,1)=="^"){$kavuse="YES"; $strpar="".$lang[650]." "; $vznach=substr($vznach,1,-1);}
$vznachen=str_replace("~", "\\",str_replace("~^", "&quot;", $vznach));
if ($param=="theme_file") {
$vznachold="<input class=input-xlarge type=text name=\"evo[$st]\" value=\"".str_replace("~", "\\",str_replace("~^", "&quot;", $vznach))."\">";
$vznach="<input type=hidden name=\"ev[$st]\" value=\"".str_replace("~", "\\",str_replace("~^", "&quot;", $vznach))."\">";
} else {
if (!isset($errt[$st])) {$errt[$st]="";}
if (($errt[$st]!="")&&(isset($ev[$st]))) {

$errt[$st]="";
$vznachold="<input type=hidden name=\"evo[$st]\" value=\"".str_replace("~", "\\",str_replace("~^", "&quot;", $vznach))."\">";
$vznach="<input id=\"el_$st\" class=input-xlarge type=text name=\"evo[$st]\" size=20 value=\"".str_replace("\"", "&quot;",$ev[$st])."\">";
$vopis="<font color=#b94a48><b>".$lang[42]."!</b> ".$lang[649]."</font><br>$vopis";
} else {
$strle=(ceil((strlen($vznach)/40))+2);
if ($strle>64) {$strle=64;}
if (preg_match("/\n/i", $vznach)){$vznachold="<input type=hidden name=\"evo[$st]\" value=\"".str_replace("~", "\\",str_replace("~^", "&quot;", $vznach))."\">";  $vznach="<textarea name=\"ev[$st]\" cols=40 rows=".$strle.">".str_replace("<br>",chr(10),str_replace("~", "\\",str_replace("~^", "&quot;", $vznach)))."\"</textarea>";
} else {
$vznachold="<input type=hidden name=\"evo[$st]\" value=\"".str_replace("~", "\\",str_replace("~^", "&quot;", $vznach))."\">";
$strle=(strlen($vznach)+2);
if ($strle>64) {$strle=64;}
$vznach="<input class=input-xlarge type=text name=\"ev[$st]\" id=\"el_$st\" size=".$strle." value=\"".str_replace("~", "\\",str_replace("~^", "&quot;", $vznach))."\">";
}
}
}
if ($param=="timezone") {$vopis.=$tzones;}
if ($param=="codepage") {$vopis.=$chrses;}
$gfonts="";
$googlefont="";
if ($param=="main_fontface") { reset ($googlefonts);
if (count($googlefonts)>0) { 
while (list($fontkey, $fontval)=each($googlefonts)) {
if ($main_fontface=="$fontval") { $googlefont=$fontval; }
$gfonts.="<option value=\"$fontval\">Google: $fontval</option>";
}
}}
if (preg_match("/\^/", $vopis)==TRUE) {
$tmpopis=explode("^",$vopis);
$vznach="<select class=input-small name=\"ev[$st]\"><option selected value=\"$vznachen\">$vznachen</option>$gfonts";
unset($tmpopis[0]);
while (list ($line_numop, $lineop) = each ($tmpopis)) {
if ($lineop=="blank") {$lineop="";}
$vznach.="<option value=\"".$lineop."\">".$lineop."</option>";
}
$vznach.="</select>";
unset($tmpopis, $line_numop, $lineop);
}
if (is_long((($st+$hidd)/2)) == FALSE) {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
if ($vnazv=="") {$vnazv=str_replace("_", " ", $param);}
if ($param!="theme_file") {
$hhelp="";
if (@file_exists("./help/$speek/$param.html")) {$hhelp="<b><small><a href=\"#help".($st-$hidd)."\" onClick=javascript:window.open('$htpath/help/$speek/$param.html','help".($st-$hidd)."','status=no,scrollbars=yes,menubar=yes,resizable=yes,location=no,width=800,height=580,left=10,top=10')><img src=\"$image_path/help.gif\" border=0 title=\"".$lang['46']."\">".$lang['46']."</a></small></b>";}
if (!isset($vars_lis[$st])) {$vars_lis[$st]="";}
$vars_lis[$st].="<tr>
<td align=center valign=top><small>".($st-$hidd).".</small></td>
<td valign=top><small><input type=hidden name=\"en[$st]\" value=\"".$param."\"><b>".$vnazv."</b><br>\$$param / $strpar</small><input type=hidden name=\"nk[$st]\" value=\"$kavuse\">";
if ($param=="logotype") { $vars_lis[$st].="<br>".str_replace("<img ", "<img id=\"img_$st\" ", $vznachen); }
if ($param=="main_fontface") { 
$vars_lis[$st].="<table width=100% border=0>";
if ($googlefont!="") { $vars_lis[$st].="<tr><td>$googlefont: </td><td><font style=\"font-family: '".$googlefont."';\">The quick brown fox jumps over the lazy lilly</font></td></tr>"; }
$vars_lis[$st].="<tr><td>Verdana: </td><td><font face=Verdana>The quick brown fox jumps over the lazy lilly</font></td></tr>
<tr><td>Arial: </td><td><font face=Arial>The quick brown fox jumps over the lazy lilly</font></td></tr><tr><td>Arial Black: </td><td><font face=\"Arial Black\">The quick brown fox jumps over the lazy lilly</font></td></tr><tr><td>Tahoma: </td><td><font face=Tahoma>The quick brown fox jumps over the lazy lilly</font></td></tr><tr><td>Georgia: </td><td><font face=Georgia>The quick brown fox jumps over the lazy lilly</font></td></tr><tr><td>Times New Roman: </td><td><font face=\"Times New Roman\">The quick brown fox jumps over the lazy lilly</font></td></tr><tr><td>Courier: </td><td><font face=Courier>The quick brown fox jumps over the lazy lilly</font></td></tr><tr><td>Comic Sans MS: </td><td><font face=\"Comic Sans MS\">The quick brown fox jumps over the lazy lilly</font></td></tr><tr><td>Geneva: </td><td><font face=Geneva>The quick brown fox jumps over the lazy lilly</font></td></tr></table>";}
if ($param=="main_font_size") { $vars_lis[$st].="<font style=\"font: 6pt $main_fontface\">6</font>&nbsp;<font style=\"font: 7pt $main_fontface\">7</font>&nbsp;<font style=\"font: 8pt $main_fontface\">8</font>&nbsp;<font style=\"font: 9pt $main_fontface\">9</font>&nbsp;<font style=\"font: 10pt $main_fontface\">10</font>&nbsp;<font style=\"font: 11pt $main_fontface\">11</font>&nbsp;<font style=\"font: 12pt $main_fontface\">12</font>&nbsp;<font style=\"font: 13pt $main_fontface\">13</font>&nbsp;<font style=\"font: 14pt $main_fontface\">14</font>&nbsp;<font style=\"font: 15pt $main_fontface\">15</font>&nbsp;<font style=\"font: 16pt $main_fontface\">16</font>&nbsp;<font style=\"font: 17pt $main_fontface\">17</font>&nbsp;<font style=\"font: 18pt $main_fontface\">18</font>&nbsp;<font style=\"font: 19pt $main_fontface\">19</font>&nbsp;<font style=\"font: 20pt $main_fontface\">20</font>";}
$vars_lis[$st].="</td>
<td valign=top>".$vznachold.$vznach;
if ($param=="logotype") { $vars_lis[$st].="&nbsp;&nbsp;<a class=\"btn btn-success\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=$st','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')><i class=icon-picture></i> ".$lang['ch']."</a><br>";}
$vars_lis[$st].=" <small>".strtoken($vopis,"^")."&nbsp;</small></td><td>$hhelp</td>
</tr>";

} else {
if (!isset($vars_lis[$st])) {$vars_lis[$st]="";}
$version=@file("./version.txt");
$lic_lis="<table class=\"table table-striped\" width=100% border=0 cellpadding=4 cellspacing=0><tbody>
<tr>
<td valign=top align=right width=30%><a href=\"http://www.eurowebcart.com\"><img src=logo_mini.png border=0 title=\"".$version[0]." ".@$version[1]." ".@$version[2]." / ".@$version[3]." / Max: ".@$version[4]." items\" align=left></a><b>".$lang[832].":</b></td><td valign=top><small>".$version[0]." ".@$version[1]." ".@$version[2]." / ".@$version[3]." / Max: ".@$version[4]." items<br>";
if (@$version[1]==@$version2[1]) {$vars_lis[$st].="<img src=$image_path/secure.gif align=absmiddle>&nbsp;".$lang[833];} else {
if (@$version2[1]!="") {
$lic_lis.="<img src=$image_path/new.gif align=absmiddle>&nbsp;<b>".$lang[834]."!</b>
<script language=javascript>
<!--

function changelog() {
if (document.getElementById('div_chlog').style.display == 'none') {

document.getElementById('div_chlog').style.visibility = 'visible';
document.getElementById('div_chlog').style.display = 'inline';

} else {
document.getElementById('div_chlog').style.display = 'none';
document.getElementById('div_chlog').style.visibility = 'hidden';
}
}
-->
</script>
<a href=#changelog onclick=javascript:changelog()><b>".$lang[835]."</b></a>
</small></td></tr><td colspan=2><img src=pix.gif width=1 height=1><div id=\"div_chlog\" style=\"display:none; visibility:hidden;\"><div style=\"-moz-border-radius: 10px; background: ".lighter($nc6,10)."; border: 1px solid $nc6; padding: 10px 10px; text-decoration:none;\"><small>";

$changelog=Array();
$lic_lis.="<br>";
}
$lic_lis.="<img src=$image_path/help.gif align=absmiddle>&nbsp;". $lang[836]." <b>$phte</b></small></div></div>";
}
$lic_lis.="</td></tr><tr><td valign=top align=right>
<b>".$lang[827].":</b></td>
<td valign=top>".$kkkr."</td>
</tr>";
$lic_lis.="<tr><td valign=top align=right><b>".$lang[828].":</b></td>
<td valign=top>";
$lice_arr=Array();
$lice_arr=file("./templates/license.inc");
$lic_lis.=@$lice_arr[0]."</td>
</tr>
<tr><td valign=top align=right><b>".$lang[843].":</b></td>
<td valign=top>$exptime</td></tr></td></tr>
<tr><td valign=top align=center colspan=2>
<small><i>".$lang[839]."</i></small></td>
</tr></tbody></table>";


$lic_lis.="<br><div style=\"-moz-border-radius: 10px; background: ".lighter($nc6,10)."; border: 1px solid $nc6; padding: 10px 10px; text-decoration:none;\" align=center><font color=#468847><b>$modnotlic</b></font></div>";
$lic_lis.="<br><div align=justify><small><img src=$image_path/help.gif align=absmiddle>&nbsp;$lang[837] <b>$phte</b></small></div><!--hidden-->$vznach<input type=hidden name=\"nk[$st]\" value=\"YES\"><br><small><a href=$htpath/license.php>LICENSE AGREEMENT | À»÷≈Õ«»ŒÕÕŒ≈ —Œ√À¿ÿ≈Õ»≈ | LIZENZVEREINBARUNG | CONTRAT DE LICENCE | À≤÷≈Õ«≤…Õ” ”√Œƒ” | CONTRATTO DI LICENZA</a></small><br></div><div align=left>";
$hidd+=1;
}
$st+=1;
}
}
$oldstyle=0;
$paramfile="./templates/$template/$speek/params1.inc";
$tabfl="./templates/$template/$speek/parameters.inc";
$selprms="";
if (file_exists($tabfl)) {
$tmp=file($tabfl);
$tmp2=explode("|",trim($tmp[0]));
$paramfile="./templates/$template/$speek/".$tmp2[0].".inc";
if (count($tmp)>1) {
$selprms="<ul class=\"nav nav-pills\">
<li class=\"dropdown pull-right\">
<a class=\"dropdown-toggle\" id=\"drop4\" role=\"button\" data-toggle=\"dropdown\" href=\"#\">".$lang['choose']."<b class=\"caret\"></b></a>
<ul id=\"menu1\" class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"drop4\">";
while(list($kef,$val)=each($tmp)) {
$val=trim($val);
$tmp2=explode("|",$val);
$tabf="./templates/$template/$speek/".$tmp2[0].".inc";
if ($prms=="") { $prms=$tmp2[0]; }
if ($prms==$tmp2[0]) { $paramfile="./templates/$template/$speek/".$tmp2[0].".inc"; $tmpok="<i class=icon-ok></i> "; } else {$tmpok="";}
$selprms.="<li><a tabindex=\"-1\" href=\"index.php?action=vars&chok=ok&mod=admin&prms=".$tmp2[0]."\">$tmpok ".$tmp2[1]."</a></li>\n";
}
$selprms.="</ul></li></ul>\n";
}
}
unset ($tmp, $tmp2, $key, $val);
$others=Array();
$kk=1;
while($kk<=$pcount) {
$others[$kk]=$kk;
$kk++;
}
if (file_exists($paramfile)) {
$tmp=file($paramfile);
$tabs1="";
$tabs2="";
$active=" active";
while(list($key,$val)=each($tmp)) {
$val=trim($val);
unset ($tmp2, $tmp3);
if ($val!="") {
$tmp2=explode("|",$val);
$tmp3=explode(",",$tmp2[2]);

$tabs1.="<li class=\"".$active."\"><a href=\"#tab".$key."\" data-toggle=\"tab\">".$tmp2[0]."</a></li>";
$tabs2.="<div class=\"tab-pane".$active."\" id=\"tab".$key."\">$hhelp<h4>".$tmp2[1]."</h4><form class=form-inline action=\"index.php\" name=form_dest method=\"POST\">
<input type=hidden name=\"action\" value=\"vars\">
<input type=hidden name=\"perpages\" value=\"$perpages\">
<input type=hidden name=\"mod\" value=\"admin\">
<input type=hidden name=\"chok\" value=\"ok\">
<input type=hidden name=\"prms\" value=\"$prms\">

<table class=\"table table-striped\" width=100% border=0 cellpadding=4 cellspacing=0><tbody>
<tr>
<td align=center><small><b>#</b></small></td>
<td align=center><small><b>".$lang['name']."</b></small></td>
<td align=center colspan=2><small><b>".$lang[648]."</b></small></td>
</tr>";
unset ($key3, $val3);
$pts="";
while(list($key3,$val3)=each($tmp3)) {

$val3=(doubleval(trim($val3))+1);

if ($val3>1) {
$pts.="$val3,";
if (isset ($vars_lis[$val3])) {
$tabs2.=$vars_lis[$val3];
$others[$val3]=0;
}
}
}
$tabs2.="</tbody></table><p align=center><input type=hidden name=\"start\" value=\"$start\"><input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\"></p></form><!--$pts--></div>";
if ($active!="") {$active="";}
}
}
unset($key3,$val3, $key, $val);
//417
reset ($others);
$tabs1.="<li class=\"".$active."\"><a href=\"#tab999\" data-toggle=\"tab\">".$lang[417]."</a></li>";
$tabs2.="<div class=\"tab-pane\" id=\"tab999\">$hhelp<h4>".$lang[417]."</h4><form class=form-inline action=\"index.php\" name=form_dest method=\"POST\">
<input type=hidden name=\"action\" value=\"vars\">
<input type=hidden name=\"perpages\" value=\"$perpages\">
<input type=hidden name=\"mod\" value=\"admin\">
<input type=hidden name=\"chok\" value=\"ok\">
<input type=hidden name=\"prms\" value=\"$prms\">

<table class=\"table table-striped\" width=100% border=0 cellpadding=4 cellspacing=0><tbody>
<tr>
<td align=center><small><b>#</b></small></td>
<td align=center><small><b>".$lang['name']."</b></small></td>
<td align=center colspan=2><small><b>".$lang[648]."</b></small></td>
</tr>";
while(list($key,$val)=each($others)) {
if ($val!=0) {
if (isset ($vars_lis[$val])) {
$tabs2.=$vars_lis[$val];
}
}

}
$tabs2.="</tbody></table><p align=center><input type=hidden name=\"start\" value=\"$start\"><input type=submit class=\"btn btn-primary btn-large\" value=\"".$lang['ch']."\"></p></form><!--$pts--></div>";

$tabs="<div class=pull-right>$selprms</div><div class=clearfix></div><div class=\"tabbable\">
<ul class=\"nav nav-tabs\">
$tabs1
</ul>
<div class=\"tab-content\" style=\"background:none;\">
$tabs2
</div>
</div>";
} else {
$oldstyle=1;

}
unset ($tmp, $tmp2, $key, $val);
$pagelist="";
reset($vars_lis);
$total=count($vars_lis)-1;
$numberpages=floor($total/$perpages);
$pages=0;
while ($pages<=$numberpages) {
if (($pages*$perpages)==$start) {
$pagelist.="<b>".($pages+1)."</b> | ";
} else {
$pagelist.="<a href=\"$htpath/index.php?speeks=$speek&action=vars&mod=admin&amp;start=".($pages*$perpages)."\">".($pages+1)."</a> | ";
}
$pages+=1;
}
$st=0;

if ($oldstyle==1){
while (list ($vv_num, $vv_line) = each ($vars_lis)) {

if (($vv_num>$start)&&($st<$perpages)) {
//echo $st." $vv_num $start<br>";
$vars_list.="$vv_line\n";
$st+=1;
}

}
if ($perpages<100) {$pagelist.=" <b><a href=$htpath/index.php?speek=$speek&action=vars&mod=admin&amp;start=0&perpages=1000>$lang[422]</a></b>"; } else {
$pagelist.=" <b><a href=$htpath/index.php?speek=$speek&action=vars&mod=admin&amp;start=0&perpages=20>".$lang[734]."</a></b>";
}

$vars_list.="</tbody></table><p align=center><input type=hidden name=\"start\" value=\"$start\"><input class=\"btn btn-primary btn-large\" type=submit value=\"".$lang['ch']."\"></p></form><br><div align=center><b>".$lang[105].":</b> &nbsp; $pagelist &nbsp;  &nbsp;  &nbsp; </div><br><br>";
$vars_list="$tabs<br><div align=center><b>".$lang[105].":</b> &nbsp; $pagelist &nbsp;  &nbsp;  &nbsp; </div><br><br>". $vars_list.$lic_lis;
} else {

$vars_list=$tabs."<br><br>".$lic_lis;

}

//echo "str_replace(\"\$shopdir=\"\";\",\"\$shopdir=\"$inst_path\";\",str_replace(\"'\".$valut.\"'\",\"'\".$defc.\"'\",str_replace(\"\"\".$currencies_sign[$valut].\"\"\",\"\"\".$c_default1[$defc].\"\"\",str_replace(\"\"\".$currencies_name[$defc].\"\"\",\"\"\".$c_default2[$defc].\"\"\",str_replace(\"\$language=\"$speek\";\",\"\$language=\"$defl\";\",str_replace(\"\$okr=$okr;\",\"\$okr=$defo;\",str_replace(\"\$optround=$optround;\",\"\$optround=$defo;\",$con)))))))";


if (($inst_path!="$shopdir")||($def_users_mode!="$smod")||($def_users_db_type!="$users_db_type")||($def_items_db_type!="$items_db_type")||($def_mysql_server!="$mysql_server")||($def_mysql_user!="$mysql_user")||($def_mysql_pass!="$mysql_pass")||($def_mysql_db_name!="$mysql_db_name")||($def_dbpref!="$dbpref")||($defl!="$language")||($defc!="$valut")||($defo!="$okr")) {
//echo "$defl-$language-$deflanguage";
//echo "\"$mysql_pass\" - \"$def_mysql_pass\"";
$config=file("./templates/lang.inc");
$contosave="";
if($def_mysql_pass=="no") {$def_mysql_pass="";}
if (!isset($contusave)) {$contusave="";}
reset ( $lpacks );
$repwhat="";
$repto="";
while (list ($keyl, $vall) = each ($lpacks)) {
if ($vall==$deflanguage) { $repwhat="\"$keyl\" => \"$deflanguage\","; }
if ($vall==$defl) { $repto="\"$keyl\" => \"$defl\","; }
}

reset ($config);
while (list ($line_con, $con) = each ($config)) {
$config[$line_con]=str_replace("\$shopdir=\"$shopdir\";","\$shopdir=\"$inst_path\";",
str_replace("\$smod=\"$smod\";","\$smod=\"$def_users_mode\";",
str_replace("\$users_db_type=\"$users_db_type\";","\$users_db_type=\"$def_users_db_type\";",
str_replace("\$items_db_type=\"$items_db_type\";","\$items_db_type=\"$def_items_db_type\";",
str_replace("\$mysql_server=\"$mysql_server\";","\$mysql_server=\"$def_mysql_server\";",
str_replace("\$mysql_user=\"$mysql_user\";","\$mysql_user=\"$def_mysql_user\";",
str_replace("\$mysql_pass=\"$mysql_pass\";","\$mysql_pass=\"$def_mysql_pass\";",
str_replace("\$mysql_db_name=\"$mysql_db_name\";","\$mysql_db_name=\"$def_mysql_db_name\";",
str_replace("\$dbpref=\"$dbpref\";","\$dbpref=\"$def_dbpref\";",
str_replace("'".$defvalut."'","'".$defc."'",
str_replace("=>\"".$currencies_sign[$defvalut]."\"","=>\"".$c_default1[$defc]."\"",
str_replace("=>\"".$currencies_name[$defvalut]."\"","=>\"".$c_default2[$defc]."\"",
str_replace($repwhat,$repto,
str_replace("\$language=\"$deflanguage\";","\$language=\"$defl\";",
str_replace("\$okr=$defokr;","\$okr=$defo;",str_replace("\$optround=$optround;","\$optround=$defo;",str_replace("\$valut=\"$defvalut\";","\$valut=\"$defc\";",$con)))))))))))))))));
}
$contusave=implode("",$config);
//echo "\$shopdir=\"$shopdir\"; => \$shopdir=\"$inst_path\";";
$_SESSION["user_currency"]=$defc;
//echo "$repwhat => $repto<br>".str_replace("\n", "<br>", $contusave);

$mb_file="./templates/lang.inc";
$vars_list.="<h4>Wait...</h4>";
$mb=fopen($mb_file,"w");
fputs($mb,$contusave);
fclose($mb);

if ($chok=="ko") {
$vars_list.="<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"0;URL=index.php?flag=$defl&action=vars&mod=admin\">";
}
}

$vars_list.="$lps<br><div class=round><form class=form-inline action=index.php autocomplete=\"off\" name=\"defaults\"><input type=hidden name=\"prms\" value=\"$prms\"><input type=hidden name=\"chok\" value=\"ko\"><input type=hidden name=\"mod\" value=\"admin\"><input type=hidden name=\"action\" value=\"vars\">
<table class=\"table table-striped\" width=100% border=0 cellpadding=4 cellspacing=0><tbody>
<tr>
<td><b>".$lang[902].":</b></td>
<td><select class=input-small name=\"defl\"><option selected value=\"$deflanguage\">$deflanguage</option>$cdef1</select></td>
</tr>
<tr>
<td><b>".$lang[903].":</b></td>
<td><select class=input-small name=\"defc\"><option selected value=\"$defvalut\">$defvalut</option>$cdef2</select></td>
</tr>
<tr>
<td><b>".$lang[904].":</b></td>
<td><select class=input-small name=\"defo\"><option selected value=\"$defokr\">$defokr</option><option>0.01</option><option>0.1</option><option>0.5</option><option>1</option><option>10</option><option>100</option><option>1000</option></select></td>
</tr>
<tr>
<td><b>".$lang[739].":</b><br></td>
<td><i>$htpath</i><input class=\"input-xlarge\" name=\"inst_path\" value=\"$inst_path\" id=\"inst\"><i>/index.php</i>
</td>
</tr>";
$vars_list.="<tr><td><b>".$lang[1007].":</b></td>
<td><select class=input-small name=def_users_mode><option selected>$smod</option><option value=\"shop\">SHOP</option><option value=\"site\">SITE</option></select>
</td>
</tr>";
$vars_list.="<tr>
</tbody></table>
<div class=round>
<b>MySQL/$lang[985]</b><br><br>
<table class=\"table table-striped\" width=100% border=0 cellpadding=4 cellspacing=0><tbody>
";

$vars_list.="<tr><td><b>Users DB type:</b></td>
<td><select class=input-small name=def_users_db_type onchange=\"onsel()\" id=sel1><option selected>$users_db_type</option><option value=\"files\">$lang[985]</option><option value=\"mysql\">MySQL</option></select>
</td>
</tr>";

$vars_list.="<tr><td><b>Items DB type:</b></td>
<td><select class=input-small name=\"def_items_db_type\" onchange=\"onsel()\" id=sel2><option selected>$items_db_type</option><option value=\"files\">$lang[985]</option><option value=\"mysql\">MySQL</option></select>
</td>
</tr>
<tr>
<td colspan=2><div id=mysql style=\"display:none; visibility:hidden;\">";
//mysql_server mysql_user mysql_pass mysql_db_name dbpref
$vars_list.="<table border=0><tr>
<td><b>MySQL Server:</b><font color=#b94a48>*</font></td>
<td><input class=\"input-xlarge\" name=\"def_mysql_server\" size=40 value=\"".$mysql_server."\"></td>
</tr>";

$vars_list.="<tr>
<td><b>".$lang['login']." MySQL:</b><font color=#b94a48>*</font></td>
<td><input class=\"input-xlarge\" name=\"def_mysql_user\" size=40 value=\"".$mysql_user."\"></td>
</tr>";

$vars_list.="<tr>
<td><b>".$lang['pass']." MySQL:</b><font color=#b94a48>*</font></td>
<td><input class=\"input-xlarge\" name=\"def_mysql_pass\" id=\"mpass\" size=40 value=\"".$mysql_pass."\"></td>
</tr>";

$vars_list.="<tr>
<td><b>MySQL DB name:</b><font color=#b94a48>*</font></td>
<td><input class=\"input-xlarge\" name=\"def_mysql_db_name\" size=40 value=\"".$mysql_db_name."\"></td>
</tr>";

$vars_list.="<tr>
<td><b>MySQL DB prefix:</b></td>
<td><input class=\"input-xlarge\" name=\"def_dbpref\" size=40 value=\"".$dbpref."\"></td>
</tr>";

$vars_list.="</table></div></td>
</tbody>
</table>

</div>
<script language=javascript>
function submitf() {
if(document.getElementById('inst').value=='') {
document.getElementById('inst').value='/';
}
if(document.getElementById('mpass').value=='') {
document.getElementById('mpass').value='no';
}
defaults.submit();
}
function onsel() {
if ((document.getElementById('sel1').value=='mysql')||(document.getElementById('sel2').value=='mysql')) {
document.getElementById('mysql').style.display='inline';
document.getElementById('mysql').style.visibility='visible';
} else {
document.getElementById('mysql').style.display='none';
document.getElementById('mysql').style.visibility='hidden';
}
}
onsel();
</script>
<div align=center>
<input type=hidden name=stage value=2><input type=button class=\"btn btn-warning btn-large\" value=\"".$lang['ch']."\" onclick=javascript:submitf();></div></form></div><br><div class=round align=center>$lang[884]:<br><br><input type=button value=\"".$lang['adm8']."\"onclick=\"location.href='".$htpath."/index.php?action=template&nt=templates&t=lang"."';\"></div><br><div class=round align=center>$lang[885]:<br><br><input type=button value=\"".$lang['adm9']."\"onclick=location.href='".$htpath."/index.php?action=template&nt=templates/$template/$speek&t=config"."'><br></div>";
if (($users_db_type=="mysql")||($items_db_type=="mysql")) {
$mysql_link = @mysql_connect($mysql_server, $mysql_user, $mysql_pass);
if (mysql_errno()) { echo "<div><font color=#b94a48><h4>MYSQL ERROR: ".mysql_error()."</h4></font></div>"; } else {
//print "MySQL Connected successfully...<br>\n";



# —ÓÁ‰‡ÂÏ ·‡ÁÛ ‰‡ÌÌ˚ı ÂÒÎË ÂÂ Â˘Â ÌÂÚ
$query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
//echo "$query ...<br>\n";
@mysql_query("$query");
if (mysql_errno()){ echo "<div><font color=#b94a48><h4>MYSQL ERROR: ".mysql_error()."</h4></font>$query</div>"; } else {


# ¬˚·Ë‡ÂÏ ·‡ÁÛ ‰‡ÌÌ˚ı
@mysql_select_db("$mysql_db_name");
if (mysql_errno()){echo "<div><font color=#b94a48><h4>MYSQL ERROR: ".mysql_error()."</h4></font></div>";  } else {
# œÓ‰ÍÎ˛˜‡ÂÏÒˇ Í ·‡ÁÂ
$query="CREATE TABLE IF NOT EXISTS `".$dbpref."_users` (";

reset ($user_fields);
$zap="";
while (list($key,$val)=each($user_fields)) {
$query.=$zap."`".mysql_real_escape_string($key)."` $val";
$zap=", ";
}
unset ($key,$val);
$customfile="./templates/$template/$speek/custom_user.inc";
if (!file_exists($customfile)) die ( "ERROR $customfile not exists...");
$custom_fields_arr=file($customfile);
$s=20;
$field=Array();
$types=Array();
$zap =", ";
while (list($key,$val)=each($custom_fields_arr)){
if (trim($val)!="") {
$tmpm=explode("|",$val);
if ((trim($tmpm[0])!="")&&(trim($tmpm[5])!="")) {
$type="TEXT";
$query.=$zap. "`". mysql_real_escape_string(translit($tmpm[0]))."_"."$s"."`"." $type";
$zap=", ";
$indx=translit($tmpm[0])."_".$s;
$user_fields[$indx]=$type;
$s+=1;
}
}
}
unset ($key, $val, $tmpm, $indx, $custom_fields_arr);
$query.=")";
# —ÓÁ‰‡ÂÏ Ú‡·ÎËˆÛ ÂÒÎË ÂÂ Â˘Â ÌÂÚ
//echo "$query ...<br>\n";
@mysql_query("$query");
if (mysql_errno()){ echo "<div><font color=#b94a48>MYSQL ERROR: <h4>".mysql_error()."</h4></font>$query</div>";  } else {


$query="CREATE TABLE IF NOT EXISTS `".$blog_table_name."` (";

reset ($user_fields);
$zap="";
while (list($key,$val)=each($blog_fields)) {
$query.=$zap."`".mysql_real_escape_string($key)."` $val";
$zap=", ";
}
unset ($key,$val);
$query.=")";
# —ÓÁ‰‡ÂÏ Ú‡·ÎËˆÛ ÂÒÎË ÂÂ Â˘Â ÌÂÚ
//echo "$query ...<br>\n";
@mysql_query("$query");
if (mysql_errno()){ echo "<div><font color=#b94a48><h4>MYSQL ERROR: ".mysql_error()."</h4></font>$query</div>";  } else {
@mysql_close($mysql_link);
if (mysql_errno()){ echo "<div><font color=#b94a48><h4>MYSQL ERROR: ".mysql_error()."</h4></font></div>";  } else {
}
}
}
}}}

}
?>
