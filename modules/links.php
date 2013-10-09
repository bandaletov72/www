<?php
$perpage=15;
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$linksub) || (@$linksub=="")): $linksub="index"; endif;
$search_r="¬се";
//в случае если указан номер раздела получаем соответствующее название
$rf=0;
$fcontents = file("$base_loc/link_razdels.txt");
while (list ($line_num, $line) = each ($fcontents)) {
$out=explode("|",$line);
$r_key=$out[0];
$rr_key=$out[1];
$razd_l["r$r_key"] = $out[1];
$razd_ll["$rr_key"] = $r_key;
$rf += 1;
}
$ulinks_list = "";
$links_sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;
$files_found=0;
if ($linksub=="index") {
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
$links_sps[$s]= "<!-- $l_razdel $l_url --><td valign=top><small>$carat <b><a href=\"$l_url\">$l_nazv</a></b> <font color=\"#aaaaaa\">[<a href=\"index.php?action=links&linksub=".@$razd_ll["$l_razdel"]."\"><i><font color=\"#aaaaaa\">$l_razdel</font></i></a>]</font><br><br>$l_html<br><br></small></td><td valign=top align=center><small>$l_knob</small></td>\n\n";
$files_found += 1;
$s+=1;
}

//«акрываем базу
fclose($f);
} else {

$search_r=@$razd_l["r$linksub"] ;
//начинаем свер€ть
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
if (@$l_razdel==$search_r) {
@$l_nazv=@$out[2];
@$l_url=@$out[3];
@$l_knob=@$out[4];
@$l_html=@$out[5];
@$l_date=@$out[6];
@$l_del=@$out[7];
@$l_count=@$out[8];
$links_sps[$s]= "<!-- $l_razdel $l_url --><td valign=top><small>$carat <b><a href=\"$l_url\">$l_nazv</a></b><br><br>$l_html<br><br></small></td><td valign=top align=center><small>$l_knob</small></td>\n\n";
$files_found += 1;
$s+=1;
}

}

//«акрываем базу
fclose($f);

}

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
$ulinks_list .= "$val\n";
}
$total = count ($links_sps)-$gt;

$numberpages = (ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

$stat= "<center><small>".$lang[203]." <b>$numberpages</b> | ".$lang[206]." <b>$total</b> ссылок | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";
//$l_index = fopen ("$base_loc/link_index.txt" , "r");
//$l_cont= (fread ($l_index, filesize ("$base_loc/link_index.txt")));
//fclose ($l_index);
$s=0;
$pp="";
while ($s < $numberpages) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?action=links&linksub=$linksub&start=" . ($s*$perpage) . "&perpage=$perpage\">" . ($s+1) . "</a> | ";
}
$s+=1;
}

$ulinks_list = "<center><small>$pp</small></center><table border=0 cellspacing=0 cellpadding=5 width=100%><tr><td align=left valign=top width=80%><small>Ќазвание</small></td><td align=center valign=top width=20%>&nbsp;</td></tr>$ulinks_list</table><center><small>$pp</small></center>
<br>$stat<br><br>\n\n";
$total-=1;
if ($files_found==0): $ulinks_list =""; $error = "<font color=$nc2><b>Ќе найдено ссылок</b></font>"; endif;
if ($s==0): $ulinks_list="¬ данном разделе ссылки отсутствуют."; endif;
?>
