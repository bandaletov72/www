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
echo "
<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>BACKUP Tool</title>
<style fprolloverstyle>A:hover {color: #FF0000}
</style>
<SCRIPT language=\"JavaScript1.1\">
<!--

function rc() {
  window.opener.location.reload();
  self.close();

}
//-->
</SCRIPT>
$css
</head>
<BODY onload=\"javascript:self.focus()\" bgcolor='#FFFFFF' text='#000000' link='#000000' vlink=\"#333333\" alink=\"#FF0000\">

";
$dnow = date("d.m.Y  H:i:s");
$now = $speek."_".date("Y_m_d__H_i_s");
echo "<small><b>".$lang[602]." $now.bak</b><br>
".$mpz['time'].": <b>$dnow</b></small><br>";
if(!copy(".$base_file", "./backup/" . $now . ".bak")) {
print ("Copy error $now.bak !<br>\n");
}


$st=0;
echo "<font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><br><font face='Verdana, Arial, Helvetica, sans-serif' size='2' color='#000000'><b>".$mpz['file_list'].":</b><br><br></font>";
$handle=opendir('./backup/');
while (($file = readdir($handle))!==FALSE) {
If (($file == '.') || ($file == '..')) {
continue;
} else {
$size = filesize ("./backup/$file");

$files[$st] = "<!--$file-->$file "."[$size b]  <b><a href='restback.php?speek=$speek&rest=$file'>".$lang[322]."</a></b> | <b><a href='delback.php?speek=$speek&amp;del=$file'>".$lang[383]."<a></b><br>\n";
$st += 1;
}
}
closedir ($handle);
if ((!@$files[0]) || (@$files[0]=="")): $files[0]=""; echo $lang[94]."!<br><br><hr><center><b><b>Powered by:</b> <a href='http://www.eurowebcart.com'>Eurowebcart CMS</a> (c) Eurowebcart</small>"; exit; endif;

sort ($files);
reset ($files);
while (list ($key, $val) = each ($files)) {
echo "$val\n";
}


?>
<hr><center><small><b>Powered by:</b> <a href=http://www.eurowebcart.com>EuroWebcart CMS</a> (c) Eurowebcart</small>
<!--end-->
</body>
</html>
