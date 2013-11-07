<?php
$tmpsubrazdels=Array();
$subr=Array();
$tmpmaxnomer=Array();
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
$vivod="";

$fold=".."; require ("../templates/lang.inc");
if (!isset($speek)) {
$speek=$language;
} else {
$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($speek==$stl){
$found_lang=1;
}
}
if ($found_lang==0){
$speek=$language;
}
}

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
header("Content-type: text/html; charset=$codepage");
$fold="..";
echo "<!DOCTYPE html><html>\n<head>\n";
require ("../templates/$template/css.inc");

echo "$css</head><body>";
$tit="ITEM ADMIN.";
require ("../templates/$template/title.inc");
require("./header.inc");

if ((!@$perpage) || (@$perpage=="")): $perpage=20; endif;
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$view) || (@$view=="")): $view="no"; endif;
if ((!@$sorting) || (@$sorting=="")): $sorting="name"; endif;
if ((!@$way) || (@$way=="")): $way="decr"; endif;
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$sub) || (@$sub=="")): $sub=""; endif;
$next=$start+$perpage;

$st=0;
//$fcontents = file(".$base_file");


$fp = fopen(".$base_file", "r");
//echo ".$base_file";
while(!feof($fp)) {
$line=fgets($fp);
//echo "<br>".$st." ".htmlspecialchars($line);
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
$tmpmaxnomer[$st] = @$out[0];
$tmpsubrazdels[$st] = @$out[1]. "|" . @$out[2];
$st += 1;
//if ($st==10) {exit;}
}
}
fclose ($fp);
//exit;
reset ($tmpsubrazdels);
$tmpsub= array_unique ($tmpsubrazdels);
while (list ($line_num, $line) = each ($tmpsub)) {
$out=explode("|",$line);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
$subr[$ra] .= " / <a href = \"index.php?speek=".$speek."&sub=".rawurlencode($out[1])."&r=".rawurlencode($ra)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=$perpage\">".$out[1]."</a> <a href=\"#del_subdir\" onClick=javascript:window.open('del_subdir.php?speek=".$speek."&sub=".rawurlencode($out[1])."&r=".rawurlencode($ra)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10') title=\"".$lang[442]." $ra/".$out[1]."\"><b><font color=#b94a48>[x]</font></b></a>";
}

$st = 1;
reset ($subr);
asort ($subr);
$razdel="<b><a href='index.php?speek=".$speek."&view=$view&amp;start=0&sorting=$sorting&way=$way&amp;perpage=$perpage&r=&sub='><img src=\"".$image_path."/main_folder.gif\" border=0 align=absbottom> ".$lang[201]."</a></b><br>";
while (list ($line_num, $line) = each ($subr)) {
$razdel .= "<b><a href = \"index.php?speek=".$speek."&sub=&r=$line_num&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=$perpage\"><img src=\"".$image_path."/folder.gif\" border=0 align=absbottom> $line_num</a></b> $line<br>\n";
$st += 1;
}

reset ($tmpmaxnomer);
rsort ($tmpmaxnomer);
$maxnomer= $tmpmaxnomer[0];
//settype ($maxnomer, "integer");
$maxnomer+=1;


$st=0;
$line_num=-1;

$fp = fopen(".$base_file", "r");
//echo ".$base_file";
while(!feof($fp)) {
$line=fgets($fp);
$line_num+=1;
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
$nomer = $out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];
@$foto1="<br>".@$out[9];
@$foto2=@$out[10];
//@$awv1=explode("http://", @$foto1);
//@$awv2=explode("/", @$awv1[1]);

//@$foto1=str_replace("/admin", "", str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto1));
//@$awv1=explode("http://", @$foto2);
//@$awv2=explode("/", @$awv1[1]);

//@$foto2=str_replace("/admin", "", str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto2));
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);
@$cur=substr(@$out[12],1,3);
@$brand_name=@$out[13];
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
@$kolvo=@$out[16];
settype ($price, "double");



if ($sorting=="kod"){
$sortby="$ext_id";
}
if ($sorting=="nomer"){
$chars= intval(strlen($line_num));
if ($chars==1): $sortby="00000$line_num"; endif;
if ($chars==2): $sortby="0000$line_num"; endif;
if ($chars==3): $sortby="000$line_num"; endif;
if ($chars==4): $sortby="00$line_num"; endif;
if ($chars==5): $sortby="0$line_num"; endif;
if ($chars==6): $sortby="$line_num"; endif;
}
if ($sorting=="dir"): $sortby="$dir $nazv"; endif;
if ($sorting=="name"): $sortby="$nazv"; endif;
if ($sorting=="subdir"): $sortby="$subdir $nazv"; endif;
if ($sorting=="price"){

$sortby="$price";
}
settype ($line_num, "integer");
if ($view=="no"): $foto1=""; endif;

$unifid=md5(@$out[3]." ID:".@$out[6]);
if (($vitrin=="")||("$vitrin"=="0")) {$vitrin=$lang['pcs'];}
$table="<td align='left' valign='top'><small><b>[num].</b> <a href='#edit' title=\"".$lang['edits']."\" onClick=javascript:window.open('".$scriptprefix."edit.php?speek=".$speek."&id=$line_num&view=$view','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>$nazv</a></small>$foto1</td>";
if ($view=="yes") {$table.="<td align='left' valign='top'><small>".wordwrap($description,10,"<br>")."</small></td><td align='left' valign='top'><small>".wordwrap($kwords,10,"<br>",1)."</small></td>"; }

$table.="<td align='left' valign='top'><small>$ext_id</small></td>
    <td align='left' valign='top'><small><b>".$cur."</b> $price</small></td>
    <td align='left' valign='top'><small><b>".$cur."</b> $opt</small></td>";

    $table.="<td align='left' valign='top'><small>$vitrin</small></td>
    <td align='left' valign='top'><small>$onsale</small></td>
    <td align='left' valign='top'><small>$brand_name</small></td>
    <td align='left' valign='top'><small>$ext_lnk</small></td>
    <td align='left' valign='top'><small>$kolvo</small></td>
    <td align='left' valign='top'><small><a href='#edit' title=\"".$lang['edits']."\" onClick=\"javascript:window.open('".$scriptprefix."edit.php?speek=".$speek."&id=$line_num&view=$view','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a></small></td>
    <td align='left' valign='top'><small><a href='#del' title='".$lang['del']."' onClick=\"javascript:window.open('del.php?speek=".$speek."&id=$line_num','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></small></td>
    <td align='left' valign='top'><small><a href='#copy' title='".$lang[137]."' onClick=\"javascript:window.open('clone_inadmin.php?speek=".$speek."&id=$line_num&nomer=$maxnomer','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10')\"><i class=\"icon-th-large icon-large\"></i></a></small></td>";
if (($r=="")&& ($sub!="")) {
if ($subdir==$sub) {
$files[$st] = "<!-- $sortby -->$table";
  $st += 1;
}
}
if (($r!="")&& ($sub!="")) {
if (($subdir==$sub)&&($dir==$r)) {
$files[$st] = "<!-- $sortby -->$table";
  $st += 1;
}
}
if (($r!="")&& ($sub=="")) {
if ($dir==$r) {
$files[$st] = "<!-- $sortby -->$table";
  $st += 1;
}
}
if (($r=="")&& ($sub=="")) {
$files[$st] = "<!-- $sortby -->$table";
  $st += 1;
}
}
}


if ((!@$files[0]) || (@$files[0]=="")){

$files[0]=""; echo "$vivod<tr><td align='center' valign='top'></td></tr></table></b></b><br><br><br><center><small>".$lang[430]." <b>$r</b> ".$lang['not_exists']."!</small>";
if (count($tmpsubrazdels)!=0) {echo "<meta http-equiv=\"Refresh\" content=\"1; URL=index.php?speek=$speek\">";}


echo "<div align=center><br><input type=button value=\"N&nbsp;&nbsp;&nbsp;".$lang[875]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."new_item.php?speek=".$speek."','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10')><br><br>$lang[879]<br><b>$lang[876]</b></div>";


echo "<br><br><hr><center><small><b>Powered by:</b> <a href='http://www.eurowebcart.com'>Eurowebcart CMS</a> (c) Eurowebcart</small>"; exit;
}

reset ($files);
if ($way=="decr") {
sort ($files);
} else {
sort ($files);
$result=array_reverse($files);
unset($files);
$files=$result;
unset($result);
}
reset ($files);
$total = count ($files);

$numberpages = (floor ($total/$perpage))+1;
$startnew=$start+1;
$end=$startnew + $perpage - 1;
if ($startnew>$total){ $start=0;}

$vivod="<br><table width=100% border=0><tr><td valign=top><small>".$lang['sort_by'].":
<b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=name&way=$way&amp;perpage=$perpage'>".$lang['name']."</a></b> |
<b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=dir&way=$way&amp;perpage=$perpage'>".$lang[430]."</a></b> |
<b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=subdir&way=$way&amp;perpage=$perpage'>".$lang[431]."</a></b> |
<b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=nomer&way=$way&amp;perpage=$perpage'>".$lang[687]."</a></b> |
<b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=kod&way=$way&amp;perpage=$perpage'>".$lang[419]."</a></b> |
<b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=price&way=$way&amp;perpage=$perpage'>".$lang['price']."</a></b>
</small></td><td valign=top align=right><small><b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=decr&amp;perpage=$perpage'>".$lang['down']."</a></b> | <b><a href ='index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=incr&amp;perpage=$perpage'>".$lang['up']."</a></b></small></td></tr>
<tr><td><small>".$lang['qty'].": <B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=20'>20</a></B> |
<B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=30'>30</a></B> |
<B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=40'>40</a></B> |
<B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=50'>50</a></B> |
<B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=100'>100</a></B> |
<B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=200'>200</a></B> |
<B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=1000'>1000</a></B> |
</small></td><td align=right><small>".$lang[421].":<B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=yes&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=$perpage'>".$lang['yes']."</a></B> | <B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=no&amp;start=$start&sorting=$sorting&way=$way&amp;perpage=$perpage'>".$lang['no']."</a></B></small>
</tr></table><br><small>
$razdel</small>
<p align=center><small>&lt;&lt; <B><a href = 'index.php?speek=".$speek."&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&amp;start=0&sorting=$sorting&way=$way&amp;perpage=$perpage'>".$lang[164]."</a></B></small>
<small> ".$lang[201]." / $r / $sub </small><br><br>";
$resb="<small> <b><a href='backup.php?speek=$speek'>".$lang[3]."</a></b> | <b><a href='restore.php?speek=$speek'>".$lang[322]."</a></b> | <b><a href='addcart.php'>".$lang[2]."</a></b></small>";

$s=0;
$pp="";
while ($s < $perpage) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
if ($total>=($s*$perpage)){
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?speek=".$speek."&amp;start=" . ($s*$perpage) . "&sub=".rawurlencode($sub)."&r=".rawurlencode($r)."&view=$view&sorting=$sorting&way=$way&amp;perpage=$perpage\">" . ($s+1) . "</a> | ";
}
}

$s += 1;

}

$vivod.="<small>$pp</small></p><br>
<table class=table width=100% border=0 cellpadding=5 cellspacing=0>
<tr bgcolor=#d3d3d3>
<td align='left' valign='top'><small><b>".$lang['name']."</b></small></td>";
if ($view=="yes") {$vivod.="   <td align='left' valign='top'><small><b>".$lang['description']."</b></small></td>
    <td align='left' valign='top'><small><b>".$lang['keyword']."</b></small></td>";
    }
$vivod.="<td align='left' valign='top'><small><b>".$lang[419]."</b></small></td>

    <td align='left' valign='top'><small><b>".$lang[149]."</b></small></td>
    <td align='left' valign='top'><small><b>".$lang[148]."</b></small></td>";



$vivod.="    <td align='left' valign='top'><small><b>".$lang[449]."</b></small></td>
    <td align='left' valign='top'><small><b>".$lang[427]."</b></small></td>
    <td align='left' valign='top'><small><b>".$lang[667]."</b></small></td>
    <td align='left' valign='top'><small><b>".$lang[668]."</b></small></td>
    <td align='left' valign='top'><small><b>".$lang[170]."</b></small></td>
    <td align='left' colspan=3 valign='top'><small><b>".$lang[28]."</b></small></td>
</tr>
";
$st=0;
while ($st < $perpage) {
if ((!@$files[($start+$st)]) || (@$files[($start+$st)]=="")): $files[($start+$st)]=""; break; break; endif;
$val = $files[($start+$st)];
$st += 1;
if (is_long(($st/2)) == "TRUE") {
$back="#FFFFFF";
} else {
$back="#F8F8F8";
}
$vivod.= "<tr bgcolor='$back'>".str_replace("[num]", $st, $val)."\n</tr>";
}





echo "$vivod</table>
<center><br><small>$pp<br>".$lang[203]." <b>$numberpages</b><br>".$lang[206]." <b>$total</b> ".$lang[207]." | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></small><br>
<p>
$resb
</p>";
echo "<div align=center><br><input type=button value=\"N&nbsp;&nbsp;&nbsp;".$lang[875]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."new_item.php?speek=".$speek."','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10')><br><br>$lang[879]<br><b>$lang[876]</b></div>";

echo "<p>";
require("./footer.inc");
?>
