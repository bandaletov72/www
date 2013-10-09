<?php
if (version_compare(phpversion(), "4.1.0", "<") === true) {
$_GET &= $HTTP_GET_VARS;
$_POST &= $HTTP_POST_VARS;
$_SERVER &= $HTTP_SERVER_VARS;
$_FILES &= $HTTP_POST_FILES;
$_ENV &= $HTTP_ENV_VARS;

if (isset($HTTP_COOKIE_VARS)) $_COOKIE &= $HTTP_COOKIE_VARS;
}

if (!ini_get("register_globals")) {
extract($_GET, EXTR_SKIP);
extract($_POST, EXTR_SKIP);
extract($_COOKIE, EXTR_SKIP);

}
if ((!@$perpage) || (@$perpage=="")): $perpage=15; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$l_change) || (@$l_change=="")): $l_change=""; endif;
if ((!@$l_add) || (@$l_add=="")): $l_add=""; endif;
$links_list = "";
if (($valid=="1")&&($details[7]=="ADMIN")&&($l_change!="")) {

$lf=0;
$file="$base_loc/db_links.txt";
$f=fopen($file,"r");
$links_sps="";
while(!feof($f)) {
$st=fgets($f);

// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
@$l_id=@$out[0];
if ($l_id==""): continue; endif;
@$l_razdel=@$out[1];
@$l_nazv=@$out[2];
@$l_url=@$out[3];
@$l_knob=@$out[4];
@$l_html=@$out[5];
@$l_date=@$out[6];
@$l_del=@$out[7];
@$l_count=@$out[8];
if (($ch_l_del[$lf]!="$l_id")||($ch_l_id[$lf]!="$l_id")||($ch_l_razdel[$lf]!="$l_razdel")||($ch_l_nazv[$lf]!="$l_nazv")||($ch_l_url[$lf]!="$l_url")||($ch_l_knob[$lf]!="$l_knob")||($ch_l_html[$lf]!="$l_html")||($ch_l_date[$lf]!="$l_date")||($ch_l_count[$lf]!="$l_count")) {
if ($ch_l_del[$lf]=="") {
$links_sps.= $ch_l_id[$lf]."|".$ch_l_razdel[$lf]."|".$ch_l_nazv[$lf]."|".$ch_l_url[$lf]."|".$ch_l_knob[$lf]."|".$ch_l_html[$lf]."|".$ch_l_date[$lf]."|".$ch_l_del[$lf]."|".$ch_l_count[$lf]."|\n";
}
} else {
$links_sps.= "$l_id|$l_razdel|$l_nazv|$l_url|$l_knob|$l_html|$l_date|$l_del|$l_count|\n";}
$lf+=1;
}

//Закрываем базу
fclose($f);
if(get_magic_quotes_gpc()) {$links_sps = stripslashes($links_sps);}
$f=fopen($file,"w");
fputs ($f, $links_sps);
fclose($f);
}
$n_mes="";
if (($valid=="1")&&($details[7]=="ADMIN")&&($l_change=="")&&($l_add!="")&&($n_date!="")&&($n_html!="")&&($n_nazv!="")&&($n_razdel!="")&&($n_id!="")) {
$file="$base_loc/db_links.txt";
$f=fopen($file,"a");
$temp="$n_id|$n_razdel|$n_nazv|$n_url|$n_knob|$n_html|$n_date||$n_count|\n";
if(get_magic_quotes_gpc()) {$temp = stripslashes($temp);}
fputs ($f, "$temp");
fclose($f);
$n_mes="<font color=#468847><b>Создана новая ссылка $n_url !</b></font><br><br>";
}
unset ($links_sps, $lf, $out);
$links_sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;
$files_found=0;
$st=0;
$s=0;
$file="$base_loc/db_links.txt";
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);

// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
@$l_id=@$out[0];
if ($l_id==""): continue; endif;
@$l_razdel=@$out[1];
@$l_nazv=@$out[2];
@$l_url=@$out[3];
@$l_knob=@$out[4];
@$l_html=@$out[5];
@$l_date=@$out[6];
@$l_del=@$out[7];
@$l_count=@$out[8];
$links_sps[$s]= "<!-- $l_razdel $l_url --><td valign=top><small><b>Раздел:</b><br><input type='hidden' name='ch_l_id[$s]' value='$l_id'><input type='text' name='ch_l_razdel[$s]' size='17' value='$l_razdel'><br>$l_date<input type='hidden' name='ch_l_del[$s]' value='$l_del'><input type='hidden' name='ch_l_count[$s]' value='$l_count'><input type='hidden' name='ch_l_date[$s]' value='$l_date'></small></td><td valign=top><small><b>URL:</b><br><input type='text' name='ch_l_url[$s]' size='27' value='$l_url'><br><b>Название:</b><br><input type='text' name='ch_l_nazv[$s]' size='27' value='$l_nazv'></small></td><td valign=top><small><b>HTML:</b><br><textarea cols=27 rows=5 name='ch_l_html[$s]'>$l_html</textarea></small></td><td valign=top align=right><small><b>Код кнопки:</b><br><textarea cols=27 rows=5 name='ch_l_knob[$s]'>$l_knob</textarea></small></td><td align=center><input type=\"checkbox\" name=\"ch_l_del[$s]\" value=\"ON\"></td>\n\n";
$files_found += 1;
$s+=1;
}

//Закрываем базу
fclose($f);


$st=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$links_sps[($start+$st)]) || (@$links_sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$links_sps[($start+$st)]) || (@$links_sps[($start+$st)]=="")): $links_sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($st/2)) == "TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
$val = "<tr bgcolor=$back>\n\n". $links_sps[($start+$st)]."\n\n</tr>";
$st += 1;
$links_list .= "$val\n";
}
$total = count ($links_sps)-$gt;

$numberpages = (ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

$stat= "<center>$n_mes<small>".$lang[203]." <b>$numberpages</b> | ".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?action=view_links&start=" . ($s*$perpage) . "&perpage=$perpage\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
$addl="<center><p align=center><small><hr noshade size=\"1\"><br><b>Добавление новой ссылки</b><small><br><br>
<form class=form-inline action=\"index.php\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"view_links\"><input type=\"hidden\" name=\"l_change\" value=\"\"><input type=\"hidden\" name=\"l_add\" value=\"1\">
<input type='hidden' name='n_id' value='00000'>
<table border=0 width=100%>
<tr><td valign=\"top\"><small>
<b>Раздел:</b></small></td><td valign=\"top\">
<input type='text' name='n_razdel' size='47' value='".@$n_razdel."'><input type='hidden' name='n_date' value='". date("Y.m.d") ."'><input type='hidden' name='n_del' value=''><input type='hidden' name='n_count' value='0'><br>
</td></tr>
<tr><td valign=\"top\"><small>
<b>URL:</b></small></td><td valign=\"top\">
<input type='text' name='n_url' size='47' value='http://'><br>
</td></tr>
<tr><td valign=\"top\"><small>
<b>Название:</b></small></td><td valign=\"top\">
<input type='text' name='n_nazv' size='47' value='".@$n_nazv."'><br>
</td></tr>
<tr><td valign=\"top\"><small>
<b>HTML код ссылки:</b></small></td><td valign=\"top\">
<textarea cols=47 rows=10 name='n_html'></textarea><br>
</td></tr>
<tr><td valign=\"top\"><small>
<b>HTML код кнопки:</b></small></td><td valign=\"top\">
<textarea cols=47 rows=10 name='n_knob'></textarea>
</td></tr></table><br>
<input type=\"submit\" class=\"btn btn-primary\" value=\"#&nbsp;&nbsp;".$lang['add']."\"></form></small></p></center><br><br>";
$links_list = "$stat<center><small>$pp</small></center><table border=0 cellspacing=0 cellpadding=1 width=100%><form class=form-inline action=\"index.php\" method=POST><input type=\"hidden\" name=\"action\" value=\"view_links\"><input type=\"hidden\" name=\"l_change\" value=\"1\"><tr><td valign=top width=20% align=center><small>Раздел / Дата</small></td><td align=center valign=top width=80%><small>URL / Название</small></td><td align=center><small>HTML</small></td><td align=center><small>Кнопка</small></td><td align=center><small>Del</small></td></tr>$links_list</table><center><small>$pp</small></center>
<br>$stat<center><p align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;".$lang['ch']."\"></form></small></p></center><br><br>
$addl\n\n";
$total-=1;

if ($files_found==0): $links_list ="$addl"; $error = "<font color=$nc2><b>Не найдено ссылок</b></font>"; endif;
if ($s==0): $links_list="<b>Ошибка!</b> Ссылки не определены.<b>$addl"; endif;
?>
