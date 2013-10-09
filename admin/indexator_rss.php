<?php
$nn=0;
$mst=0;
$tosave2="<h1>RSS feeds:</h1>";
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
function toLower($str) {
$str = strtr($str, "ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚÛİŞß",
"àáâãäååæçèêëìíîïğñòóôõö÷øùüúûışÿ");
   return strtolower($str);
}
function toUpper($str) {
$str = strtr($str, "àáâãäååæçèêëìíîïğñòóôõö÷øùüúûışÿ",
"ÀÁÂÃÄÅ¨ÆÇÈÊËÌÍÎÏĞÑÒÓÔÕÖ×ØÙÜÚÛİŞß");
   return strtoupper($str);
}
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
$fold="..";
$rrating="";

$sortas=0;
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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);   require ("../templates/$template/$speek/config.inc");

require ("../modules/translit.php");

echo "
<!DOCTYPE html><html>
<TITLE>INDEXATOR-RSS FEEDS</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body bgcolor=#ffffff>
";
if (!$_GET['sortby']) {
echo "<h1>".$lang['choose']."</h1><form class=form-inline action=\"".$scriptprefix."indexator_rss.php\" method=GET>
<input type=hidden name=\"speek\" value=\"$speek\">
".$lang['sort_by'].": <select name=\"sortby\"><option value=1>".$lang['by_price']."</option>
<option value=2>".$lang['by_name']."</option>
<option value=3>".$lang[419]."</option>
<option value=4>ID</option>
<input type=submit value=\"OK\">
</form>";


} else {
echo "SORTBY: ".$_GET['sortby']."<br>";
if (!file_exists(".$base_loc/catid.txt")) {

$reindex="<h1>STEP 2. WAIT...</h1><meta http-equiv=\"Refresh\" content=\"2; URL=".$scriptprefix."indexator_rss.php?speek=$speek&sortby=".$_GET['sortby']."\">";
} else {
$reindex="<h1>OK</h1><meta http-equiv=\"Refresh\" content=\"2; URL=../index.php?speek=$speek\">";
}
$fcontentsy = @file(".$base_loc/catid.txt");
@reset($fcontentsy);
@natcasesort($fcontentsy);
$tmparrs=@array_reverse($fcontentsy);
unset($fcontentsy);
$fcontentsy=$tmparrs;
unset($tmarrs);
$st=0;
$catid="";
$rating=Array();
while (list ($line_numy, $liney) = @each ($fcontentsy)) {
$st+=1;
if (trim($liney)!="") {
$out=explode("|",trim(str_replace("\n", "",$liney)));

$tmy=$out[0];
$catidy[$tmy]=trim(str_replace("\n", "", @$out[3]));
$catidys[$tmy]=trim(str_replace("\n", "", @$out[4]));
$catidyt[$tmy]=trim(str_replace("\n", "", @$out[5]));
$catidyc[$tmy]=trim(str_replace("\n", "", @$out[6]));
$podstavasa[@$out[1]."|".@$out[2]."|"]=trim(str_replace("\n", "", @$out[5]));
if ($podstavasa[@$out[1]."|".@$out[2]."|"]=="") {$podstavasa[@$out[1]."|".@$out[2]."|"]=(1000-$st); }  else { $sortas=1; }
$sf=$podstavasa[@$out[1]."|".@$out[2]."|"];
$chars=intval(strlen($sf));
if ($chars==1): $sortby="00000$sf"; endif;
if ($chars==2): $sortby="0000$sf"; endif;
if ($chars==3): $sortby="000$sf"; endif;
if ($chars==4): $sortby="00$sf"; endif;
if ($chars==5): $sortby="0$sf"; endif;
if ($chars==6): $sortby="$sf"; endif;
$podstavasa[$out[1]."|".$out[2]."|"]=$sortby;
//echo $out[1]."|".$out[2]."|"."=".$podstavasa[$out[1]."|".$out[2]."|"]."<br>";
$podstavas[$out[1]."|".$out[2]."|"]=$catidys[$tmy];
}
}

$fold="..";
require "../modules/functions.php";
require "../templates/$template/css.inc";



$st=0;
$minibase="";
$file=".$base_file";
$f=fopen($file,"r");
$zf=0;
$rating=Array();
while(!feof($f)) {
echo "\n";

$stun=str_replace(chr(0x01), "", str_replace( chr(0x14), "", trim(trim(fgets($f)))));
if ($stun!="") {

$out=explode("|",$stun);

if ($mod_rw_enable==0) { $unifw="$htpath/index.php?unifid=".md5(@$out[3]." ID:".@$out[6]);  } else { $unifw="$htpath/".md5(@$out[3]." ID:".@$out[6]).".htm";}

if ($friendly_url==1) {
if ($hidart!=1) {

$unifw="?item_id=".str_replace(chr(0x01),"",str_replace( chr(0x14), "", translit(@$out[3])."-".translit(@$out[6])));
if ($mod_rw_enable==0) { $unifw="$htpath/index.php?item_id=".str_replace(chr(0x01),"",str_replace( chr(0x14), "", translit(@$out[3])."-".translit(@$out[6]))); } else { $unifw="$htpath/".str_replace(chr(0x01),"",str_replace( chr(0x14), "", translit(@$out[3])."-".translit(@$out[6]))).".htm";}
}
}


//echo htmlspecialchars($fcontents[$zf])."<br>";






$st+=1;

echo "\n";


if  ((substr(@$out[12])!="0")&&(@$out[12]!="")) {



if ($view_deleted_goods==1) {


@$price=doubleval($out[4]);
//$price=0.01*(round((@$price*$kurs)/0.01));
$pricek=doubleval($out[4]);
$strto2=0;

if ((@$podstavas[$out[1]."|".$out[2]."|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {

$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=doubleval(@$strtoma[0]);
unset($strtoma);

if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) {
	$strto2=$strto;
	$price=0.01*(round((@$price-(@$price*doubleval($strto)/100))/0.01));
$pricek=@$pricek-(@$pricek*(doubleval($strto))/100);
} else { $price=0.01*(round((@$price-(@$price*((double)$podstavas[$out[1]."|".$out[2]."|"])/100))/0.01));
$pricek=@$pricek-(@$pricek*(doubleval($podstavas[$out[1]."|".$out[2]."|"])/100));
$strto2=doubleval($podstavas[$out[1]."|".$out[2]."|"]);
}
} else {
$price=0.01*(round(@$price/0.01));
}


if ($out[1]!=$lang[418]) {
$indx=translit($out[1]."_".$out[2])."_";
$idr[$indx]=$out[1]."/".$out[2];
$img=$out[9];
$imgsrc=str_replace("\"","", str_replace("'","",strtoken(strtoken(str_replace(strtoken(str_replace("\"","", str_replace("'","", str_replace(chr(0x01),"",str_replace( chr(0x14), "", $img))))," src=")." src=","", str_replace(chr(0x01),"",str_replace( chr(0x14), "", $img)))," "),">")));
if (!preg_match("/http:\/\//i",$imgsrc)) { $imgsrc="$htpath/$imgsrc";}
$pr=" - $price".$currencies_sign[$valut];
if ($price==0) { $pr=""; }
if ($_GET['sortby']==1) {$sf=round($price*100);
$chars= intval(strlen($sf));
//echo $chars."<br>";
if ($chars==1): $sortb="00000000000$sf"; endif;
if ($chars==2): $sortb="0000000000$sf"; endif;
if ($chars==3): $sortb="000000000$sf"; endif;
if ($chars==4): $sortb="00000000$sf"; endif;
if ($chars==5): $sortb="0000000$sf"; endif;
if ($chars==6): $sortb="000000$sf"; endif;
if ($chars==7): $sortb="00000$sf"; endif;
if ($chars==8): $sortb="0000$sf"; endif;
if ($chars==9): $sortb="000$sf"; endif;
if ($chars==10):$sortb="00$sf"; endif;
if ($chars==11):$sortb="0$sf"; endif;
}
$naim=str_replace(chr(0x01),"",str_replace( chr(0x14), "", str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",strip_tags($out[3]))))))));
if ($_GET['sortby']==2) {
$sortb=$naim;

}
if ($_GET['sortby']==2) {
$sortb=$out[6];

}
if ($_GET['sortby']==3) {
$sf=$out[0];
$chars= intval(strlen($sortb));
//echo $chars."<br>";
if ($chars==1): $sortb="00000000000$sf"; endif;
if ($chars==2): $sortb="0000000000$sf"; endif;
if ($chars==3): $sortb="000000000$sf"; endif;
if ($chars==4): $sortb="00000000$sf"; endif;
if ($chars==5): $sortb="0000000$sf"; endif;
if ($chars==6): $sortb="000000$sf"; endif;
if ($chars==7): $sortb="00000$sf"; endif;
if ($chars==8): $sortb="0000$sf"; endif;
if ($chars==9): $sortb="000$sf"; endif;
if ($chars==10):$sortb="00$sf"; endif;
if ($chars==11):$sortb="0$sf"; endif;
}
$fcontents[$indx][]="$sortb|      <item>
         <title>".$naim."$pr</title>
         <link>".$unifw."</link>
         <description>&lt;img src=&quot;$imgsrc&quot; alt=&quot;".str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",str_replace(chr(0x01),"",str_replace( chr(0x14), "", strip_tags(str_replace("\"", "", str_replace("'", "",$out[3]))))))))))."&quot; align=left hspace=10 vspace=10 border=0&gt;".str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",str_replace(chr(0x01),"",str_replace( chr(0x14), "", str_replace("[option]","", str_replace("[/option]","", str_replace("[radio]","", str_replace("[/radio]","",str_replace("^"," ",$out[7]))))))))))))."
&lt;br&gt;&lt;p&gt;&lt;a href=&quot;".$unifw."&quot;&gt;".$lang[919]."&lt;/a&gt;&lt;/p&gt;</description>
         <pubDate>".date("D, d M Y H:i:s", time())." GMT</pubDate>
      </item>

";

}



$mst += 1;
} else {
if ((@$out[4]!="0")&&(@$out[4]!=0)) {


@$price=$out[4];

$strto2=0;


if ((@$podstavas[$out[1]."|".$out[2]."|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) {

$strtoma=Array();
$strtoma=explode("%",@$out[8]);
$strto=@$strtoma[0];
unset($strtoma);

if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $strto2=$strto; $price=0.01*(round((@$price-(@$price*(doubleval($strto))/100))/0.01));} else { $price=0.01*(round((@$price-(@$price*((double)$podstavas[$out[1]."|".$out[2]."|"])/100))/0.01)); $strto2=doubleval($podstavas[$out[1]."|".$out[2]."|"]); }
} else {
$price=0.01*(round(@$price/0.01));
}


if ($out[1]!=$lang[418]) {

$indx=translit($out[1]."_".$out[2])."_";
$idr[$indx]=$out[1]."/".$out[2];
$img=$out[9];
$imgsrc=str_replace("\"","", str_replace("'","",strtoken(strtoken(str_replace(strtoken(str_replace("\"","", str_replace("'","", str_replace(chr(0x01),"",str_replace( chr(0x14), "", $img))))," src=")." src=","", str_replace(chr(0x01),"",str_replace( chr(0x14), "", $img)))," "),">")));
if (!preg_match("/http:\/\//i",$imgsrc)) { $imgsrc="$htpath/$imgsrc";}
$pr=" - $price".$currencies_sign[$valut];
if ($price==0) { $pr=""; }
if ($_GET['sortby']==1) {$sf=round($price*100);
$chars= intval(strlen($sf));
//echo $chars."<br>";
if ($chars==1): $sortb="00000000000$sf"; endif;
if ($chars==2): $sortb="0000000000$sf"; endif;
if ($chars==3): $sortb="000000000$sf"; endif;
if ($chars==4): $sortb="00000000$sf"; endif;
if ($chars==5): $sortb="0000000$sf"; endif;
if ($chars==6): $sortb="000000$sf"; endif;
if ($chars==7): $sortb="00000$sf"; endif;
if ($chars==8): $sortb="0000$sf"; endif;
if ($chars==9): $sortb="000$sf"; endif;
if ($chars==10):$sortb="00$sf"; endif;
if ($chars==11):$sortb="0$sf"; endif;
}
$naim=str_replace(chr(0x01),"",str_replace( chr(0x14), "", str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",strip_tags($out[3]))))))));
if ($_GET['sortby']==2) {
$sortb=$naim;

}
if ($_GET['sortby']==2) {
$sortb=$out[6];

}
if ($_GET['sortby']==3) {
$sf=$out[0];
$chars= intval(strlen($sortb));
//echo $chars."<br>";
if ($chars==1): $sortb="00000000000$sf"; endif;
if ($chars==2): $sortb="0000000000$sf"; endif;
if ($chars==3): $sortb="000000000$sf"; endif;
if ($chars==4): $sortb="00000000$sf"; endif;
if ($chars==5): $sortb="0000000$sf"; endif;
if ($chars==6): $sortb="000000$sf"; endif;
if ($chars==7): $sortb="00000$sf"; endif;
if ($chars==8): $sortb="0000$sf"; endif;
if ($chars==9): $sortb="000$sf"; endif;
if ($chars==10):$sortb="00$sf"; endif;
if ($chars==11):$sortb="0$sf"; endif;
}

$fcontents[$indx][]="$sortb|      <item>
         <title>".$naim."$pr</title>
         <link>".$unifw."</link>
         <description>&lt;img src=&quot;$imgsrc&quot; alt=&quot;".str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",str_replace(chr(0x01),"",str_replace( chr(0x14), "", strip_tags(str_replace("\"", "", str_replace("'", "",$out[3]))))))))))."&quot; align=left hspace=10 vspace=10 border=0&gt;".str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",str_replace(chr(0x01),"",str_replace( chr(0x14), "", str_replace("[option]","", str_replace("[/option]","", str_replace("[radio]","", str_replace("[/radio]","",str_replace("^"," ",$out[7]))))))))))))."
&lt;br&gt;&lt;p&gt;&lt;a href=&quot;".$unifw."&quot;&gt;".$lang[919]."&lt;/a&gt;&lt;/p&gt;</description>
         <pubDate>".date("D, d M Y H:i:s", time())." GMT</pubDate>
      </item>

";

}


$mst += 1;

}
}

}
}
}
while(list($key,$val)=each($fcontents)) {
echo "<b>$idr[$key]</b> - ".$key.".rss<br>";
$filerss=$key.".rss";
if (is_dir("../rss")==FALSE) { mkdir("../rss",0755); }

if (@$catidy[$key]!="") { $img=$catidy[$key];} else {$img=$logotype;}
$imgsrc=str_replace("\"","", str_replace("'","",strtoken(strtoken(str_replace(strtoken(str_replace("\"","", str_replace("'","", $img))," src=")." src=","", $img)," "),">")));
if (!preg_match("/http:\/\//i",$imgsrc)) { $imgsrc="$htpath/$imgsrc";}
if ($mod_rw_enable==0) { $catid="$htpath/index.php?catid=$key"; } else { $catid="$htpath/$key";}

$tosave= "<?xml version=\"1.0\" encoding=\"$codepage\"?>
<rss version=\"2.0\">
   <channel>
      <title>".str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",$idr[$key])))))."</title>
      <link>".$catid."</link>
      <description>".str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",$idr[$key])))))."</description>
      <language>".str_replace("_","-", strtolower(strtoken($site_nls,".")))."</language>
      <webMaster>$shop_mail</webMaster>
      <copyright>$htpath</copyright>
      <pubDate>".date("D, d M Y H:i:s", time())." GMT.</pubDate>
      <lastBuildDate>".date("D, d M Y H:i:s", time())." GMT</lastBuildDate>
      <image>
         <title>".str_replace("<","&lt;", str_replace(">","&gt;", str_replace("\"","&quot;",str_replace("'","&quot;", str_replace("&","&amp;",$idr[$key])))))."</title>
         <url>$imgsrc</url>
         <link>".$catid."</link>
      </image>

";
natcasesort($fcontents[$key]);
reset ($fcontents[$key]);
while(list($keyz,$valz)=each($fcontents[$key])) {
$tmpz=explode("|", $valz);
$tosave.= $tmpz[1];
unset($tmpz);
}
$tosave.= "   </channel>
</rss>";
$fp=fopen("../rss/$filerss", "w");
fputs($fp,$tosave);
fclose($fp);
$tosave2.="<img src=$image_path/rss.png border=0 align=absmiddle hspace=10><b><a href=\"$htpath/rss/".$key.".rss\">".$idr[$key]."</b></a><br>";

}
$fp=fopen("../rss/index.php", "w");
fputs($fp,"<!DOCTYPE html><html><TITLE>RSS FEEDS SORT BY ".$_GET['sortby']."</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
</HEAD>
<body bgcolor=#ffffff>".$tosave2."</body></html>");
fclose($fp);
echo "$reindex";
}
?>
</body>
</html>
