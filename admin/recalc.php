<?php
$errr="";
$towrite="";
if ((!@$rep_dir) || (@$rep_dir=="")): $rep_dir=""; endif;
if ((!@$rep_dirsubdir) || (@$rep_dirsubdir=="")): $rep_dirsubdir=""; endif;
if ((!@$rep_dirsubdir2) || (@$rep_dirsubdir2=="")): $rep_dirsubdir2=""; endif;
if ((!@$koeff) || (@$koeff=="")): $koeff=1; endif;
if ((!@$rep_where) || (@$rep_where=="")): $rep_where=""; endif;

if (!preg_match("/^[0-9_]+$/",$rep_where)) { $rep_where=""; }
if (!preg_match("/^[0-9,.]+$/i",$koeff)) { $koeff=1; $errr="<p><p align=center><font color=#b94a48>".$lang[42]."</font></p>";}
$rep_dirsubdir2 = str_replace("/ " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace(" / " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("/ " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace(" / " , "/", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("  " , " ", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("  " , " ", $rep_dirsubdir2);
$rep_dirsubdir2 = str_replace("  " , " ", $rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$rep_dirsubdir2 = trim($rep_dirsubdir2);
$koeff=str_replace(",",".",$koeff);

$rep_arr=array ("koeff", "rep_where", "rep_dir", "rep_dirsubdir", "rep_dirsubdir2");
while (list ($line_num, $a) = each ($rep_arr)) {
$$a = substr($$a, 0, 200);
$$a = str_replace("|" , " ", $$a);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace(chr(36) , "", $$a);
$$a = str_replace(chr(10) , " ", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
if(get_magic_quotes_gpc()) {$$a = stripslashes($$a);}
}
$koeff=doubleval($koeff);
$replace_list = "";
$s=0;
if (($valid=="1")&&($details[7]=="ADMIN")) {





if ($koeff==0){$koeff=1; echo "No need to recalc with koef 1";}


if (($koeff!=0)&&($koeff!=1)&&($rep_where!="")&&($rep_dirsubdir2!="")) {

$replace_list.="<p align=\"center\"><br><br><br>Multiplicate X <b>$koeff</b><br><br>";
$replace_list.="<table border=0>";




$s_filename="./templates/$template/$speek/custom_cart.inc";
if (@file_exists($s_filename)==TRUE) {
$custom_carts=file("./templates/$template/$speek/custom_cart.inc");
}


$file="$base_file";
$tmpfile="$base_loc/db_index.tmp";
@unlink($tmpfile);
$f=fopen($file,"r");

$tf=0;
$ff=0;
while(!feof($f)) {
$st=str_replace("\n", "", fgets($f));

$st= trim($st);
$out=explode("|",$st);


if (@$out[0]!="") {

if (isset($custom_carts)) {
reset($custom_carts);
while (list ($ss_num, $ss_line) = each ($custom_carts)) {
$sss=explode("|", $ss_line);
if (($ss_line!="")&&(@$sss[0]!="")&&(@$sss[1]!="")){
$nss=17+$ss_num;
if (!isset($out[$nss])) {
$out[$nss]="";
}
$nsm=18+$ss_num;
if (!isset($out[$nsm])) {
$out[$nsm]="";
}
}
}

}

reset ($out);
while (list ($o_num, $o_line) = each ($out)) {
$out[$o_num]=str_replace("\n","",$out[$o_num]);
}
reset($out);

$tf+=1;
$oldprrep=$out[$rep_where];
if ($rep_dirsubdir2=="_") {
$found=0;
if ($out[$rep_where]!=doubleval($out[$rep_where])) { $found=1;
	$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <font color=#b94a48><b>Unable to recalc \"".$out[$rep_where]."\" x $koeff</b></font></small></td></tr>\n";
	}

if ($found==0){
$out[$rep_where]=str_replace(",",".","".round((doubleval($out[$rep_where])*$koeff),2));
$ff+=1;
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <b>$oldprrep</b> => <b>".$out[$rep_where]."</b></small></td></tr>\n";
}
$st=implode("|", $out)."\n";



} else {
$rep_dirsubdir2=str_replace("/", "|",$rep_dirsubdir2);
$tmpds2=$out[1]."|".$out[2];
if ($tmpds2==$rep_dirsubdir2) {


$found=0;
if ($out[$rep_where]!=doubleval($out[$rep_where])) { $found=1;
	$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <font color=#b94a48><b>Unable to recalc \"".$out[$rep_where]."\" x $koeff</b></font></small></td></tr>\n";
	}

if ($found==0){
$out[$rep_where]=str_replace(",",".","".round((doubleval($out[$rep_where])*$koeff),2));
$ff+=1;
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."]: <b>$oldprrep</b> => <b>".$out[$rep_where]."</b></small></td></tr>\n";
}
$st=implode("|", $out)."\n";




}
}

$towrite.=$st."\n";
}

}
$f2=fopen($tmpfile,"w");
fputs ($f2, str_replace("\n\n", "\n", str_replace("\n\n", "\n",$towrite)));
fclose($f2);
fclose($f);
unlink($file);
rename ($tmpfile,$file);


$replace_list.="<tr><td><hr>".$lang[32].": <b>$tf</b><br>".$lang[657].": <b>$ff</b></td></tr></table>";
if ($ff>0):$replace_list.= "<br><br><a href=\"$htpath/admin/".$scriptprefix."indexator.php?speek=$speek\">".$lang[658]."</a>"; endif;
$replace_list.= "</p>";

} else {
$replace_list.= "$errr";
}















$fcontents = file("$base_file");

$allrazdels=$fcontents;
while (list ($line_num, $line) = each ($allrazdels)) {
$out=explode("|",$line);
if (isset($out[1])) {
$tmpsubrazdels[$st] = $out[1]. "|" . $out[2];
}
$st += 1;
}
reset ($tmpsubrazdels);
$tmpsub= array_unique ($tmpsubrazdels);
while (list ($line_num, $line) = each ($tmpsub)) {
$out=explode("|",$line);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
$subr[$ra] .= "$out[1]|";
}

$razdel="";
while (list ($line_num, $line) = each ($subr)) {
$out=explode("|",$line);
while (list ($line_num2, $line2) = each ($out)) {
if ($line2!=""): $razdel .= "<option value=\"$line_num/$line2\">$line_num / $line2</option>\n"; endif;
}
}


//тут форма ввода
//int_code0|dir1|subdir2|name3|price4|opt5|ext_code6|descr7|keywords8|icon9|photo10|vitrina11|onsale12|brand13|attachment14|fulldescr15|stock16|
$replace_list.="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\"><input type=hidden name=\"action\" value=\"recalc\"><input type=hidden name=\"rep_dir\" value=\"\"><input type=hidden name=\"rep_dirsubdir\" value=\"\">
<p align=\"center\"><br><br><b>".$lang[659]."</b><br><small><b>".$lang[211]."</b> ".$lang[660]."<br>".$lang[661]." <a href=\"admin/backup.php?speek=$speek\" target=\"_blank\"><b>BACKUP</b></a></small><br><br>
<table border=0 cellspacing=0 cellpadding=5>
<tr>
<td align=right>Koef. X</td><td><input type=text size=30 name=\"koeff\" value=\"1\"> <i>ex.</i> 1.05</td>
</tr>
<tr>
<td align=right>".$lang[663].":<br><br>".$lang[664].":</td><td>
<select name=\"rep_where\">
<option value=\"\">-------".$lang['choose']."-------</option>
<option value=4>".$lang['price']."</option>
<option value=5>".$lang[148]."</option>
<option value=16>".$lang[670]."</option>
";
//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";
$cc_cart="";
if (@file_exists($c_filename)==TRUE) {
$custom_cart=file("./templates/$template/$speek/custom_cart.inc");
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")){
$ncc=17+$cc_num;
$replace_list.="<option value=$ncc>".@$ccc[0]."</option>\n";
}
}
}
//end

$replace_list.="</select><br><br>
<select name=\"rep_dirsubdir2\"\">
<option value=\"\">-------".$lang['choose']."-------</option>
$razdel
<option value=\"\">----------------------</option>
<option value=\"_\">".$lang[671]."</option>
</select></td>
</tr>
</table>
<br><input type=\"submit\" class=\"btn btn-primary\" value=\"OK\"></form>";





$replace_list.="</p>";
}
?>
