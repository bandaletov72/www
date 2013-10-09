<?php
$towrite="";
if ((!@$rep_dir) || (@$rep_dir=="")): $rep_dir=""; endif;
if ((!@$rep_dirsubdir) || (@$rep_dirsubdir=="")): $rep_dirsubdir=""; endif;
if ((!@$rep_dirsubdir2) || (@$rep_dirsubdir2=="")): $rep_dirsubdir2=""; endif;
if ((!@$rep_search) || (@$rep_search=="")): $rep_search=""; endif;
if ((!@$rep_replace) || (@$rep_replace=="")): $rep_replace=""; endif;
if ((!@$rep_where) || (@$rep_where=="")): $rep_where=""; endif;
if (!preg_match("/^[0-9_]+$/",$rep_where)) { $rep_where=""; }
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
$vrazdele=0;
if ($rep_dirsubdir2==strtoken($rep_dirsubdir2,"/")."/") { $vrazdele=1;};

$vrazdele2=0;
if ($rep_dirsubdir==strtoken($rep_dirsubdir,"/")."/") { $vrazdele2=1;};

$rep_arr=array ("rep_search", "rep_replace", "rep_where", "rep_dir", "rep_dirsubdir", "rep_dirsubdir2");
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

$replace_list = "";
$s=0;
if (($valid=="1")&&($details[7]=="ADMIN")) {

$replace_list = "To clear any cell data use: <b>any</b> => <b>null</b><br>
To full replace cell data use: <b>any</b> => YOUR_DATA<br>
To partial replace cell data use: YOUR_DATA1 => YOUR_DATA2<br><br>";



if ($rep_search==""){$rep_search="0";}


if (($rep_search!="")&&($rep_where!="")&&($rep_dirsubdir2!="")) {

$replace_list.="<p align=\"center\"><br><br><br>".$lang[655].": <b>\"$rep_search\"</b> =&gt; <b>\"$rep_replace\"</b> v.1<br>".$lang[656]."  - <b>$rep_where</b><br><br>";
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

if ($rep_dirsubdir2=="_") {
if ($rep_where=="_") {
$founds=substr_count($st, $rep_search);
$st=str_replace($rep_search,$rep_replace, $st)."\n";
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 1 : <b>$founds</b></small></td></tr>\n";
}
$ff+=$founds;
} else {
$founds=substr_count($out[$rep_where], $rep_search);

if ($rep_search=="any") {
if ($rep_replace=="null") {
//$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 2-1: <b>NULLED</b></small></td></tr>\n";
$out[$rep_where]="";
$founds=1;
} else {
$out[$rep_where]=$rep_replace;
//$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 2-2: <b>FULL REPLACE</b></small></td></tr>\n";
$founds=1;
}
} else {
$out[$rep_where]=str_replace($rep_search,$rep_replace, $out[$rep_where]);
//$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 2-3: <b>REPLACED</b></small></td></tr>\n";
}
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 3: <b>$founds</b></small></td></tr>\n";

}
$st=implode("|", $out)."\n";
$ff+=$founds;
}
} else {

if ($vrazdele==0) {
$rep_dirsubdir2=str_replace("/", "|",$rep_dirsubdir2);
$tmpds2=$out[1]."|".$out[2];
if ($tmpds2==$rep_dirsubdir2) {

if ($rep_where=="_") {
$founds=substr_count($st, $rep_search);
$st=str_replace($rep_search,$rep_replace, $st)."\n";
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 4: <b>$founds</b></small></td></tr>\n";

}
$ff+=$founds;
} else {


$founds=substr_count($out[$rep_where], $rep_search);
if (($rep_where!=4)&&($rep_where!=5)&&($rep_where!=16)&&($rep_where!=14)&&($rep_where!=13)&&($rep_where!=8)){
$out[$rep_where]=str_replace($rep_search,$rep_replace, $out[$rep_where]);
$st=implode("|", $out)."\n";
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 5: <b>$founds</b></small></td></tr>\n";
}




$ff+=$founds;
} else {
if (($rep_search==$out[$rep_where])||($rep_search=="")||($rep_search=="0")||($rep_search==0)) {
$out[$rep_where]=$rep_replace;
$founds=1;
}
$ff+=$founds;
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 6: <b>$founds</b></small></td></tr>\n";
$st=implode("|", $out)."\n";

}
}


}

}
} else {
//замена без учета подразделов
$rep_dirsubdir2=str_replace("/", "|",$rep_dirsubdir2);
$tmpds2=$out[1]."|";
if ($tmpds2==$rep_dirsubdir2) {

if ($rep_where=="_") {
$founds=substr_count($st, $rep_search);
$st=str_replace($rep_search,$rep_replace, $st)."\n";
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 4: <b>$founds</b></small></td></tr>\n";

}
$ff+=$founds;
} else {


$founds=substr_count($out[$rep_where], $rep_search);
if (($rep_where!=4)&&($rep_where!=5)&&($rep_where!=16)&&($rep_where!=14)&&($rep_where!=13)&&($rep_where!=8)){
$out[$rep_where]=str_replace($rep_search,$rep_replace, $out[$rep_where]);
$st=implode("|", $out)."\n";
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 5: <b>$founds</b></small></td></tr>\n";
}




$ff+=$founds;
} else {
if (($rep_search==$out[$rep_where])||($rep_search=="")||($rep_search=="0")||($rep_search==0)) {
$out[$rep_where]=$rep_replace;
$founds=1;
}
$ff+=$founds;
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] 6: <b>$founds</b></small></td></tr>\n";
$st=implode("|", $out)."\n";

}
}


}

}


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

}








if ($vrazdele2==0) {
if (($rep_dir!="")&&($rep_dirsubdir!="")&&(substr_count($rep_dirsubdir, "/")==1)&&(strlen(strstr($rep_dirsubdir, "/"))>1 )&&(substr_count($rep_dir, "/")==1)&&(strlen(strstr($rep_dir, "/"))>1 )) {

$rep_dirsubdir=str_replace("/", "|",$rep_dirsubdir);
$rep_dir=str_replace("/", "|",$rep_dir);

$replace_list.="<p align=\"center\"><br><br><br>".$lang[655].": <b>\"$rep_dirsubdir\"</b> =&gt; <b>\"$rep_dir\"</b> v.2<br><br>";
$replace_list.="<table border=0>";


$file="$base_file";
$tmpfile="$base_loc/db_index.tmp";
@unlink($tmpfile);
$f=fopen($file,"r");
$f2=fopen($tmpfile,"a");
$tf=0;
$ff=0;
while(!feof($f)) {
$st=fgets($f);
//int_code0|dir1|subdir2|name3|price4|opt5|ext_code6|descr7|keywords8|icon9|photo10|vitrina11|onsale12|brand13|attachment14|fulldescr15|stock16|

$out=explode("|",$st);
if (@$out[0]!="") {
$tf+=1;
$founds=substr_count($st, $rep_dirsubdir);
$st=str_replace($rep_dirsubdir,$rep_dir, $st);
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] : <b>$founds</b></small></td></tr>\n";
}
$ff+=$founds;

fputs($f2, $st);
}

}
fclose($f2);
fclose($f);
unlink($file);
rename ($tmpfile,$file);


$replace_list.="<tr><td><hr>".$lang[32].": <b>$tf</b><br>".$lang[657].": <b>$ff</b></td></tr></table>";
if ($ff>0):$replace_list.= "<br><br>".$lang[658].""; endif;
$replace_list.= "</p>";

}
} else {
echo "$rep_dirsubdir =&gt; $rep_dir ";
if (($rep_dir!="")&&($rep_dirsubdir!="")&&(substr_count($rep_dirsubdir, "/")==1)&&(substr_count($rep_dir, "/")==1)) {

$rep_dirsubdir=str_replace("/", "|",$rep_dirsubdir);
$rep_dir=str_replace("/", "|",$rep_dir);

$replace_list.="<p align=\"center\"><br><br><br>".$lang[655].": <b>\"$rep_dirsubdir\"</b> =&gt; <b>\"$rep_dir\"</b> v.22<br><br>";
$replace_list.="<table border=0>";


$file="$base_file";
$tmpfile="$base_loc/db_index.tmp";
@unlink($tmpfile);
$f=fopen($file,"r");
$f2=fopen($tmpfile,"a");
$tf=0;
$ff=0;
while(!feof($f)) {
$st=fgets($f);
//int_code0|dir1|subdir2|name3|price4|opt5|ext_code6|descr7|keywords8|icon9|photo10|vitrina11|onsale12|brand13|attachment14|fulldescr15|stock16|

$out=explode("|",$st);
if (@$out[0]!="") {
$tf+=1;
$founds=substr_count($st, $rep_dirsubdir);
$st=str_replace("|".$rep_dirsubdir,"|".$rep_dir, $st);
if ($founds!=0){
$replace_list.="<tr><td><small>\"<b>".@$out[3]."</b>\" [id=".$out[0]."] : <b>$founds</b></small></td></tr>\n";
}
$ff+=$founds;

fputs($f2, $st);
}

}
fclose($f2);
fclose($f);
unlink($file);
rename ($tmpfile,$file);


$replace_list.="<tr><td><hr>".$lang[32].": <b>$tf</b><br>".$lang[657].": <b>$ff</b></td></tr></table>";
if ($ff>0):$replace_list.= "<br><br>".$lang[658].""; endif;
$replace_list.= "</p>";

}

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
//if ($line2!="") {
$razdel .= "<option value=\"$line_num/$line2\">$line_num / $line2</option>\n";
//}
}
}


//тут форма ввода
//int_code0|dir1|subdir2|name3|price4|opt5|ext_code6|descr7|keywords8|icon9|photo10|vitrina11|onsale12|brand13|attachment14|fulldescr15|stock16|
$replace_list.="<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" id=\"goitem\"><input type=hidden name=\"action\" value=\"replacer\"><input type=hidden name=\"rep_dir\" value=\"\"><input type=hidden name=\"rep_dirsubdir\" value=\"\">
<p align=\"center\"><br><br><b>".$lang[659]."</b><br><small><b>".$lang[211]."</b> ".$lang[660]."<br>".$lang[661]." <a href=\"admin/backup.php?speek=$speek\" target=\"_blank\"><b>BACKUP</b></a></small><br><br>
<table border=0 cellspacing=0 cellpadding=5>";
if ($rep_dirsubdir2=="") {
$replace_list.="
<tr><td align=right>".$lang[664].":</td><td><select name=\"rep_dirsubdir2\" onchange=\"javascript:document.goitem.submit()\">
<option value=\"".str_replace("|","/",$rep_dirsubdir2)."\">";
if ($rep_dirsubdir2=="_") {
$replace_list.=$lang[671];
} else {
$replace_list.=str_replace("|","/",$rep_dirsubdir2);
}
$replace_list.="</option>
$razdel
<option value=\"_\">----------------------</option>
<option value=\"_\">".$lang[671]."</option>
</select></td>
</tr>";
}
if ($rep_dirsubdir2!="") {
$replace_list.="<tr><td colspan=2 align=center><b>".$lang[664].": ";
if ($rep_dirsubdir2=="_") {
$replace_list.=$lang[671];
} else {
$replace_list.=str_replace("|","/",$rep_dirsubdir2);
}

$replace_list.="</b></td></tr>
<tr>
<td align=right>".$lang[662].":</td><td><input type=hidden name=\"rep_dirsubdir2\" value=\"".str_replace("|","/",$rep_dirsubdir2)."\"><input type=text size=30 name=\"rep_search\" value=\"\"> =&gt; <input type=text size=30 name=\"rep_replace\" value=\"\"></td>
</tr>
<tr>
<td align=right>".$lang[663].":</td><td>
<select name=\"rep_where\">
<option value=\"\">-------".$lang['choose']."-------</option>
<option value=1>".$lang[430]."</option>
<option value=2>".$lang[431]."</option>
<option value=3>".$lang['name']."</option>
<option value=4>".$lang['price']."</option>
<option value=5>".$lang[148]."</option>
<option value=6>".$lang[419]."</option>
<option value=7>".$lang['short']."</option>
<option value=8>".$lang[653]."</option>
<option value=9>".$lang[665]."</option>
<option value=10>".$lang[666]."</option>
<option value=11>".$lang[449]."</option>
<option value=13>".$lang[667]."</option>
<option value=14>".$lang[668]."</option>
<option value=15>".$lang[669]."</option>
<option value=16>".$lang[670]."</option>
";
//custom card add
if (isset($podstava[str_replace("/","|", $rep_dirsubdir2)."|"])) {
$ccfile="cc_".$podstava[str_replace("/","|", $rep_dirsubdir2)."|"].".inc";

$c_filename="./templates/$template/$speek/custom_cart.inc";
$cc_cart="";
if (@file_exists($c_filename)==TRUE) {
$custom_cart1=file("./templates/$template/$speek/custom_cart.inc");
if (@file_exists("./templates/$template/$speek/$ccfile")) {
$custom_cart2=file("./templates/$template/$speek/$ccfile");
$custom_cart=Array_merge($custom_cart1,$custom_cart2);
} else {
$custom_cart=$custom_cart1;
}
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")){
$ncc=17+$cc_num;
$replace_list.="<option value=$ncc>".@$ccc[0]."</option>\n";
}
}
}
}
//end

$replace_list.="<option value=\"\">--------------------------</option>
<option value=\"_\">".$lang[671]."</option>
</select><br><br>
</td>
</tr>";
$replace_list.="</table>
<br><input type=\"submit\" class=\"btn btn-primary\" value=\"OK\"></form>";
} else {
$replace_list.="</table>
<br><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[289]." &gt;&gt;\"></form>";
}






$replace_list.="<hr>
<script language=\"javascript\">
function zamena() {
document.getElementById(\"dirs\").value=document.getElementById(\"dirsubdirs\").value;
}
</script>
<form name=\"zam\" action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\" id=\"formzam\"><input type=hidden name=\"action\" value=\"replacer\"><input type=hidden name=\"rep_where\" value=\"\"><input type=hidden name=\"rep_search\" value=\"\"><input type=hidden name=\"rep_replace\" value=\"\">
<p align=\"center\"><br><br><b>".$lang[672]."</b><br><small><b>".$lang[211]."</b> ".$lang[660]."<br>".$lang[661]." <a href=\"admin/backup.php?speek=$speek\" target=\"_blank\"><b>BACKUP</b></a></small><br><br>
<table border=0 cellspacing=0 cellpadding=5>
<tr>
<td align=right>".$lang[430]."/".$lang[431].":</td><td>
<select name=\"rep_dirsubdir\"\"  onchange=\"javascript:zamena()\" id=\"dirsubdirs\">
<option value=\"\">-------".$lang['choose']."-------</option>
$razdel
</select></td>
</tr>
<tr>
<td align=right>".$lang[673].":</td><td><input type=text size=50 name=\"rep_dir\" value=\"\" id=\"dirs\"><br><small>".$lang[674]."</small></td>
</tr>
</table>
<br><input type=\"submit\" class=\"btn btn-primary\" value=\"OK\"></form>



<br><br><br></p>";

}
?>
