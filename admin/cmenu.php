<?php
$perpage=1500;
if ((!@$perpage) || (@$perpage=="")): $perpage=1500; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$l_change) || (@$l_change=="")): $l_change=""; endif;
if ((!@$l_add) || (@$l_add=="")): $l_add=""; endif;
$links_list = "";
if (($valid=="1")&&($details[7]=="ADMIN")&&($l_change!="")) {

$lf=0;
$file="$base_loc/db_cmenu.txt";
$f=fopen($file,"r");
$links_sps="";
while(!feof($f)) {
$st=fgets($f);
if (trim(str_replace("|","", $st))==""): continue; endif;

$out=explode("|",$st);
@$l_id=@$out[0];
@$l_razdel=@$out[1];
@$l_nazv=@$out[2];
@$l_keyw=@$out[3];
@$l_url=@$out[4];
@$l_count=@$out[5];
if (($ch_l_del[$lf]!="")||($ch_l_url[$lf]!="$l_url")||($ch_l_id[$lf]!="$l_id")||($ch_l_razdel[$lf]!="$l_razdel")||($ch_l_nazv[$lf]!="$l_nazv")||($ch_l_keyw[$lf]!="$l_keyw")||($ch_l_count[$lf]!="$l_count")) {
if ($ch_l_del[$lf]!="YES") {
$links_sps.= $ch_l_id[$lf]."|".$ch_l_razdel[$lf]."|".$ch_l_nazv[$lf]."|".$ch_l_keyw[$lf]."|".$ch_l_url[$lf]."|".$ch_l_count[$lf]."|\n";
}
} else {
$links_sps.= "$l_id|$l_razdel|$l_nazv|$l_keyw|$l_url|$l_count|\n";}
$lf+=1;
}


fclose($f);
if(get_magic_quotes_gpc()) {$links_sps = stripslashes($links_sps);}
$f=fopen($file,"w");
fputs ($f, $links_sps);
fclose($f);
}
$n_mes="";
if (($valid=="1")&&($details[7]=="ADMIN")&&($l_change=="")&&($l_add!="")&&($n_nazv!="")&&($n_razdel!="")&&($n_id!="")) {
$file="$base_loc/db_cmenu.txt";
$f=fopen($file,"a");
$temp="$n_id|$n_razdel|$n_nazv|$n_keyw|$n_url|$n_count|\n";
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
fputs ($f, "$temp");
fclose($f);
$n_mes="<font color=#468847><b>".$lang[652]." $n_keyw !</b></font><br><br>";
}
unset ($links_sps, $lf, $out);
$links_sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;
$files_found=0;
$st=0;
$s=0;
$file="$base_loc/db_cmenu.txt";
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);

if (trim(str_replace("|","", $st))==""): continue; endif;

$out=explode("|",$st);
@$l_id=@$out[0];
@$l_razdel=@$out[1];
@$l_nazv=@$out[2];
@$l_keyw=@$out[3];
@$l_url=@$out[4];
@$l_count=@$out[5];
$links_list.="<tr>
<td valign=top>
<small><b>".$lang[430].":</b><br><input type=\"hidden\" name=\"ch_l_id[".$s."]\" value=\"$l_id\"><input type=\"text\" name=\"ch_l_razdel[".$s."]\" size=17 value=\"$l_razdel\" style=\"width:100%\"><input type=\"hidden\" name=\"ch_l_count[".$s."]\" value=\"$l_count\"></small>
</td>
<td valign=top>
<small><b>".$lang[653].":</b><br><input type=\"text\" name=\"ch_l_keyw[$s]\" size=27 value=\"$l_keyw\" style=\"width:100%\"><br><b>".$lang['name'].":</b><br><input type=\"text\" name=\"ch_l_nazv[".$s."]\" size=27 value=\"$l_nazv\" style=\"width:100%\">
<br><b>".$lang[810].":</b><br><input type=\"text\" name=\"ch_l_url[".$s."]\" size=27 value=\"$l_url\" style=\"width:100%\"></small>
</td>
<td align=center>
<input type=\"checkbox\" name=\"ch_l_del[".$s."]\" value=\"YES\">
</td>
</tr><tr><td colspan=3><br></td></tr>\n";
$files_found += 1;
$s+=1;
}


fclose($f);


$stat= "<center>$n_mes<small>";
$s=0;
$pp="";
$addl="<center><p align=center><small><hr noshade size=\"1\"><br><b>".$lang[654]."</b><small><br><br>
<form class=form-inline action=\"index.php\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"view_cmenu\"><input type=\"hidden\" name=\"l_change\" value=\"\"><input type=\"hidden\" name=\"l_add\" value=\"1\">
<input type='hidden' name='n_id' value='00000'>
<table border=0 width=100%>
<tr><td valign=\"top\"><small>
<b>".$lang[430].":</b></small></td><td valign=\"top\" width=80%>
<input type='text' name='n_razdel' size='47' value='".@$n_razdel."' style=\"width:100%\"><input type='hidden' name='n_date' value='". date("Y.m.d") ."'><input type='hidden' name='n_del' value=''><input type='hidden' name='n_count' value='0'><br>
</td></tr>
<tr><td valign=\"top\"><small>
<b>".$lang[653].":</b></small></td><td valign=\"top\">
<input type='text' name='n_keyw' size='47' value='' style=\"width:100%\"><br>
</td></tr>
<tr><td valign=\"top\"><small>
<b>".$lang['name'].":</b></small></td><td valign=\"top\">
<input type='text' name='n_nazv' size='47' value='".@$n_nazv."' style=\"width:100%\"><br>
</td></tr>
<tr><td valign=\"top\"><small>
<b>".$lang[810].":</b></small></td><td valign=\"top\">
<input type='text' name='n_url' size='47' value='".@$n_url."' style=\"width:100%\"><br>
</td></tr>
</table><br>
<input type=\"submit\" class=\"btn btn-primary\" value=\"#&nbsp;&nbsp;".$lang['add']."\"></form></small></p></center><br><br>";
$links_list = "<form class=form-inline action=\"index.php\" method=POST id=\"subm222\">
<input type=\"hidden\" name=\"action\" value=\"view_cmenu\">
<input type=\"hidden\" name=\"l_change\" value=\"1\">
<table border=0 cellspacing=0 cellpadding=1 width=100%>
<tr bgcolor=$nc6>
<td valign=top width=20% align=center><small>".$lang[430]."</small></td>
<td align=center valign=top width=80%><small>".$lang[653]."</small></td>
<td align=center><small>Del</small></td>
</tr>
$links_list
</table><br><br>
<div align=\"center\">
<input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;".$lang['ch']."\"></small></div>
</form>
<br><br>$addl";

if ($files_found==0): $links_list ="$addl"; $error = "<font color=$nc2><b>".$lang[94]."</b></font>"; endif;

?>
