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
$custom_cart="";
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
require ("../templates/$template/css.inc");
require ("../modules/translit.php");
echo "<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>EDIT</title>
$css
<SCRIPT language=\"JavaScript1.1\">
<!--

function rc() {
  window.opener.location.reload();
  self.close();

}
//-->
</SCRIPT>
</head>
<BODY onload=\"javascript:self.focus()\"><br><div class=\"mr ml\">
";
if (!isset($_POST['id'])) { $id=0; } else {$id=$_POST['id'];}
if (isset($_POST['cc'])) { $cc=$_POST['cc'];}

if (isset ($cc)) {
ksort($cc);
while (list ($line_numcc, $acc) = each ($cc)) {
//echo (17+$line_numcc)." =&gt; $acc<br>\n";
$cc[$line_numcc]=str_replace(chr(10) , "<br>", $cc[$line_numcc]);
$cc[$line_numcc] = str_replace(chr(13) , "", $cc[$line_numcc]);
$cc[$line_numcc] = str_replace(chr(27) , "", $cc[$line_numcc]);
$cc[$line_numcc] = trim($cc[$line_numcc]);
$cc[$line_numcc] = stripslashes($cc[$line_numcc]);
}
reset ($cc);
}

$arr=array ("nazv", "description", "kwords", "item_type", "dir", "subdir", "full_descr", "price", "opt", "foto1", "foto2" , "vitrin" , "onsale", "brand_name", "ext_lnk", "kolvo");
while (list ($line_num, $a) = each ($arr)) {
$$a = str_replace(chr(10) , "<br>", $$a);
$$a = str_replace(chr(13) , "", $$a);
$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);

}
echo "<b>ID=$id</b><br>
<br>$nazv<br><br>
";
settype ($id, "integer");
$st=0;
$fcontents = file(".$base_file");
$line=$fcontents[$id];
$out=explode("|",$line);
$tnomer = $out[0];
@$tdir=@$out[1];
@$tsubdir=@$out[2];
$catid=translit("$tdir $tsubdir ");
$catid2=translit("$tdir");
@$tnazv=@$out[3];
@$tprice=@$out[4];
@$topt=@$out[5];
@$text_id=@$out[6];
@$tdescription=@$out[7];
@$tkwords=@$out[8];
@$tfoto1=@$out[9];
@$tfoto2=@$out[10];
@$tvitrin=@$out[11];
@$tonsale=substr(@$out[12],0,1);
@$tbrand_name=@$out[13];
@$text_lnk=@$out[14];
@$tfull_descr=@$out[15];
@$tkolvo=@$out[16];
$nochange = "";
if (isset ($cc)) {
while (list ($kcc, $lcc) = each ($cc)) {
$ncc=17+$kcc;
$tcc=@$out[$ncc];
$custom_cart.="$lcc|";
}
}

$stroket = "$item_type|$dir|$subdir|$nazv|$price|$opt|$ext_id|$description|$kwords|$foto1|$foto2|$vitrin|$onsale".@$cur."|$brand_name|$ext_lnk|$full_descr|$kolvo|".@$custom_cart."\n";
$stroket2 = $_POST['id']."|$dir|$subdir|$nazv|$price|$opt|$ext_id|$description|$kwords|$foto1|$foto2|$vitrin|$onsale".@$cur."|$brand_name|$ext_lnk|$full_descr|$kolvo|".@$custom_cart."\n";
$fcontents [$id]=$stroket;
echo "<pre>LOG:<br>".$lang['edits']." DB - <b>".$lang[209]."</b><br>";
$html = implode ("", $fcontents);
$file = fopen (".$base_file", "w");
if (!$file) {
echo "<p> File is write protect: <b>.$base_file</b>\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, "$html");flock ($file, LOCK_UN);
fclose ($file);
unset ($fcontents,$html,$file);
if ($admin_speedup==1) {
echo "Admin speedup - <font color=green>".$lang['yes']."</font><br>";
if ($catid==translit("$dir $subdir ")) {
//no change dir and subdir
echo "$lang[835]: $lang[430] ($lang[431]) - ".$lang['no']."<br>";
$fcontents = file(".$base_loc/items/$catid.txt");
while (list ($key,$val)=each ($fcontents)) {

$out=explode("|",$val);
if ((trim($line)!="")&&(trim($line)!="\n")&&(trim($out[0])!="")){
if ($out[0]==$id) {
echo $lang['edits']." SubDB - <b>".$lang[209]."</b><br>";
$fcontents[$key]=$stroket2;

}
}
}
if (trim($html)=="") {
unlink (".$base_loc/items/$catid.txt");
} else {
$html = implode ("", $fcontents);
$file = fopen (".$base_loc/items/$catid.txt", "w");
if (!$file) {
echo "<p> File is write protect: <b>.$base_loc/items/$catid.txt</b>\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, "$html");flock ($file, LOCK_UN);
fclose ($file);
}
} else {
//change dir or subdir
//echo "Category or SubCategory changed - ".$lang['yes']."<br>";
//delete stroke from items db
echo $lang['del']." - <b>".$lang[209]."</b><br>";
$fcontents = file(".$base_loc/items/$catid.txt");
while (list ($key,$val)=each ($fcontents)) {

$out=explode("|",$val);
if ((trim($line)!="")&&(trim($line)!="\n")&&(trim($out[0])!="")){
if ($out[0]==$id) {
$fcontents[$key]="";

}
}
}
$html = implode ("", $fcontents);
if (trim($html)=="") {
unlink (".$base_loc/items/$catid.txt");
$fcontents = file(".$base_loc/catid.txt");
$foundd=0;
$founds=0;
while (list ($key,$val)=each ($fcontents)) {

$out=explode("|",$val);
if ((trim($line)!="")&&(trim($line)!="\n")&&(trim($out[0])!="")){
if (($out[0]==$catid)||($out[0]==$catid2)) {
unset($fcontents[$key]);
}
}
}
$fp = fopen (".$base_loc/catid.txt", "w");
fputs ($fp, implode("",$fcontents));
fclose($fp);
} else {
$file = fopen (".$base_loc/items/$catid.txt", "w");
if (!$file) {
echo "<div><font color=red>File is write protect: <b>.$base_loc/items/$catid.txt</b></font></div>\n";
exit;
}
flock ($file, LOCK_EX); fputs ($file, "$html");flock ($file, LOCK_UN);
fclose ($file);
}
unset ($fcontents);
//add stoke to new db
echo $lang['add']." - <b>".$lang[209]."</b><br>";
$file=".$base_loc/items/".translit("$dir $subdir ").".txt";
$fp=fopen($file,"a");
fputs($fp, $stroket2);
fclose($fp);
unset ($fcontents,$html,$file);
//add to catid.txt
$fcontents = file(".$base_loc/catid.txt");
$foundd=0;
$founds=0;
while (list ($key,$val)=each ($fcontents)) {

$out=explode("|",$val);
if ((trim($line)!="")&&(trim($line)!="\n")&&(trim($out[0])!="")){
if ($out[0]==translit("$dir $subdir ")) {
$founds=1;
}
if ($out[0]==translit("$dir")) {
$foundd=1;
}
}
}
$file=".$base_loc/catid.txt";
$fp=fopen($file,"a");
if ($foundd==0) {
echo $lang['add'].": $lang[430] - <b>".$lang[209]."</b><br>";
fputs($fp, translit("$dir")."|$dir||||||||\n");
}
echo $lang['add'].": $lang[431] - <b>".$lang[209]."</b><br>";
if ($founds==0) {
fputs($fp, translit("$dir $subdir ")."|$dir|$subdir|||||||\n");
}
fclose($fp);
if (($founds==0)||($foundd==0)) { echo "<b><font color=blue>$lang[658]</font></b><br>"; }
}
}

echo "<b>".$lang[704]."</b></pre><div align=center><button type=\"button\" class=\"btn btn-large btn-primary\" name=\"no\" onclick=\"javascript:rc()\">".$lang[428]."</button></div></div>";
?><!--end-->
</body>
</html>
