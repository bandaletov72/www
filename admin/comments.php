<?php
if ((!@$perpage) || (@$perpage=="")): $perpage=10; endif;
if ((!@$comsort) || (@$comsort=="")): $comsort=""; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$ban) || (@$ban=="")): $ban=""; endif;
if ((!@$razban) || (@$razban=="")): $razban=""; endif;
if ((!@$delcom) || (@$delcom=="")): $delcom=""; endif;
$file="$base_file";
$f=fopen($file,"r");
$vit_qty=0;
$ff=0;
while(!feof($f)) {
$st=fgets($f);
// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
@$curcur=substr(@$out[12],1,3);

if (($curcur=="")||($curcur=="$init_currency")) {
$kurss=$kurs;
} else {
if (isset($currencies[$curcur])) {
if ($curcur=="$valut") {
$kurss=1;
} else {
$kurss=($currencies[$valut]/$currencies[$curcur]);
}
} else {
$kurss=$kurs;
}
}
@$price=@$price*$kurss;

$ueopt=@$opt;
@$opt=round(@$opt*$optkurs);

@$ext_id=@$out[6];
@$description=@$out[7];

$admin_functions="";
$vipold="";

$sales="";
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtok(@$out[8],"%"); $vipold="<font color=#b94a48><strike>".($okr*round(@$price/$okr))."</strike></font>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" align=center style=\"vertical-align: middle\"><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $strto=doubleval($podstavas["$dir|$subdir|"]); $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>";  @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
}

$ppp=($okr*round($price/$okr));

if(@$podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
$unifid_comm=md5(@$out[3]." ID:".@$out[6]);
$price=($okr*round($price/$okr));
$tmpmass_comm["$unifid_comm"]="<a href=\"$htpath/index.php?unifid=$unifid_comm\">$nazv</a> - $vipold<b>$price</b>".$currencies_sign[$_SESSION["user_currency"]]."<br><font color=\"#a0a0a0\">[$dir/$subdir]</font>";

}

$soocomm="";
if ($delcom==1) {

//Список comm//

$handle=opendir('./admin/comments/');
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')|| ($file == 'rate.txt') || ($file == 'votes') || (strlen($file)==1)) {
continue;
} else {
unlink ("./admin/comments/$file" );
$soocomm.="<br><small>$file - <b>Deleted.</b></small>";
}
}
closedir ($handle);
$handle=opendir('./admin/comments/votes/');
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')|| ($file == 'rate.txt') || ($file == 'votes') || (strlen($file)==1)) {
continue;
} else {
unlink ("./admin/comments/votes/$file" );
$soocomm.="<br><small>$file - <b>Deleted.</b></small>";
}
}
closedir ($handle);

}




//Список comm//
$spiscomm="";
$s = 1;
$handle=opendir('./admin/comments/');
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')  || (strlen($file)==1)|| ($file == 'rate.txt') || (substr($file,-5) == '.rate')|| ($file == 'votes')) {
continue;
} else {
$unif=str_replace(".txt", "", "$file");
$commfile=filemtime("./admin/comments/$file");
$datecomm=date("d-m-Y H:i", $commfile);
$ffil=str_replace(".txt", "", $file);
if (strlen($ffil)>5) {
$commstat["$unif"]="<!--  $commfile --><td valign=top><small title=\"\">".@$tmpmass_comm["$unif"]."</small></td><td valign=top width=100><small>" . $datecomm ."</small></td>\n\n";
$indexmass{"$unif"}="<!--  $commfile -->$unif";
} else {
$commstat["$unif"]="<!--  $commfile --><td valign=top><small><a href=$htpath/index.php?page=$ffil>$ffil</a></small></td><td valign=top width=100><small>" . $datecomm ."</small></td>\n\n";
$indexmass{"$unif"}="<!--  $commfile -->$unif";
}
$s+=1;
}
}

closedir ($handle);
if ($s!==1) {
//сортировка по алфавиту//
rsort ($commstat);
reset ($commstat);
rsort ($indexmass);
reset ($indexmass);
}
$c_list="";

$st=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$commstat[($start+$st)]) || (@$commstat[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$commstat[($start+$st)]) || (@$commstat[($start+$st)]=="")): $commstat[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($st/2)) == "TRUE") {
$back=$nc6;
} else {
$back=$style ['table_color1'];
}
$fcommname=strip_tags($indexmass[($start+$st)]);
//if (@file_exists("./admin/comments/".$fcommname.".txt")==TRUE) {
$efc = @fopen ("./admin/comments/".$fcommname.".txt" , "r");
$tmpviewcomm = str_replace("[hr]", "<div class=clear><br></div>", str_replace("[i]", "<i class=muted>", str_replace("[/i]", "</i>", str_replace("[b]", "<b>", str_replace ("[/b]", "</b>", @fread($efc, @filesize("./admin/comments/$fcommname.txt")))))));
@fclose($efc);
$val = "<tr bgcolor=$back><td valign=top><small>".($start+$st+1).".</small></td>". $commstat[($start+$st)]."<td valign=top><small>".str_replace("[vote]","<img src=\"$image_path/vote",str_replace("[/vote]",".png\">" , str_replace("[ip]", "<a href=\"$htpath/index.php?action=userip&ban=ip_", str_replace("[/ip]", "&amp;start=0&amp;perpage=10&ipsort=\">".$lang[186]."</a>", $tmpviewcomm))))."</small></td></tr>";

$c_list .= "$val\n";
//}
$st += 1;
}
$total = count ($commstat)-$gt;

$numberpages = (ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

$statistcomm= "<center><small>".$lang[203]." <b>$numberpages</b> | ".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?action=viewcomm&mod=admin&amp;start=" . ($s*$perpage) . "&amp;perpage=$perpage&comsort=$comsort\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
if ($s==0): $soocomm.="<br><br><b>".$lang[42]."!</b> No comments found."; endif;
$c_list = "$statistcomm<center>$soocomm<small>$pp</small></center><table border=0 width=100%><tr><td valign=top colspan=\"4\"><table width=100% border=0 cellspacing=3 cellpadding=0><tr><td valign=top width=20% align=left><small><a href = \"".$_SERVER['PHP_SELF']."?action=viewcomm&mod=admin&amp;start=0&amp;perpage=$perpage&comsort=comm\"><b>".$lang['file']."</b></a></small></td><td align=right valign=top width=80%><small><a href = \"".$_SERVER['PHP_SELF']."?action=viewcomm&mod=admin&amp;start=0&amp;perpage=$perpage&comsort=date\"><b>".$lang[371]."</b></a> / <a href = \"".$_SERVER['PHP_SELF']."?action=viewcomm&mod=admin&amp;start=0&amp;perpage=$perpage&comsort=\"><b>".$lang[8]."</b></a></small></td></tr></table></td></tr>$c_list</table><hr><br><center><small>$pp</small>
<br>$statistcomm\n
<br><br>»&nbsp;<b><a href=\"$htpath/index.php?action=viewcomm&mod=admin&delcom=1&amp;start=0&amp;perpage=$perpage&comsort=$comsort\">".$lang[185]."</a></b><br><br><br><br></center>\n";
$total-=1;


?>
