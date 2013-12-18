<?php
$comm="";
$tags_s="";
$tags_ss="";
$ts=time();
$demzal="";
$flashobj="";
$flood="";
$ukwo=0;
$cartlist="";
$voting="";
$tag_s="";
$p_title="";
$tags_ss="";
$html_content="";
$antispam_array=Array("2x2=4", "3x3=9", "6-4=2", "10+2=12", "20-10=10");
if (file_exists("./templates/$template/$language/antispam.inc")==TRUE) {
$antispam_array=@file("./templates/$template/$language/antispam.inc");
}
$answer_ok=0;


$typesclass="";

$files=Array();
$vcount=0;
$vpt="";

if (($action=="viewfile") && ($page!="")) {
if ($friendly_url==1) {if (@file_exists("$base_loc/wiki/$page.man")==TRUE) {
$ptmp = fopen ("$base_loc/wiki/$page.man" , "r");
$page = trim(@fread($ptmp, @filesize("$base_loc/wiki/$page.man")));
fclose($ptmp);
}}
if (@file_exists("$base_loc/content/$page.txt")==TRUE) {
$ts=filemtime("$base_loc/content/$page.txt");
$kwo=""; if (file_exists("./admin/search/kwords/$speek/$page".".txt")==true) { $kwo=implode("",file("./admin/search/kwords/$speek/$page".".txt")); }
$pageopen = fopen ("$base_loc/content/$page.txt" , "r");
$viewpage_content = @fread($pageopen, @filesize("$base_loc/content/$page.txt"));
$viewpage_content2=$viewpage_content;
$outputviewpage1=Array();
$outputviewpage1[1]="";
$outputviewpage1=explode("==",$viewpage_content);
if ($outputviewpage1[1]!="") {
$viewpage_title=trim(strtoken(strtoken(strip_tags(trim($outputviewpage1[1])),"["),"|"));
$vpt=$outputviewpage1[1];
$outputviewpage[1]=$outputviewpage1[1];
unset($outputviewpage1);
} else {
$viewpage_title = $lang[221];
}

fclose ($pageopen);
$html_content=str_replace("==$vpt==", "" , $viewpage_content);
$con=$viewpage_content; $poll_exp="</div>"; require "./modules/mod_poll.php"; $viewpage_content=$con;
$tags_tarr=explode("|", strip_tags(strtoken($outputviewpage[1],"[")));
if (count($tags_tarr)>1) {
if ($tags_tarr[0]==$viewpage_title) {unset($tags_tarr[0]);}
$tags_s=implode(",", $tags_tarr);
} else {
$tags_s="";
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
if ($agree==md5(date("d.m.Y",time()).$artrnd)) {
if(isset($_GET['p_tags'])) $p_tags=$_GET['p_tags']; elseif(isset($_POST['p_tags'])) $p_tags=$_POST['p_tags']; else $p_tags="";
if(isset($_GET['p_comm'])) $p_comm=$_GET['p_comm']; elseif(isset($_POST['p_comm'])) $p_comm=$_POST['p_comm']; else $p_comm="";
if(isset($_GET['p_icon'])) $p_icon=$_GET['p_icon']; elseif(isset($_POST['p_icon'])) $p_icon=$_POST['p_icon']; else $p_icon="";
if(isset($_GET['p_title'])) $p_title=$_GET['p_title']; elseif(isset($_POST['p_title'])) $p_title=$_POST['p_title']; else $p_title="";
if(isset($_GET['p_url'])) $p_url=$_GET['p_url']; elseif(isset($_POST['p_url'])) $p_url=$_POST['p_url']; else $p_url="";
if(isset($_GET['p_coord'])) $p_coord=$_GET['p_coord']; elseif(isset($_POST['p_coord'])) $p_coord=$_POST['p_coord']; else $p_coord="";
//save page with new titles
if(get_magic_quotes_gpc()) {
$p_icon=stripslashes($p_icon);
$p_title=stripslashes($p_title);
$p_comm=stripslashes($p_comm);
$p_url=stripslashes($p_url);
$p_tags=stripslashes($p_tags);
$p_coord=stripslashes($p_coord);
}
$pageopen = fopen ("$base_loc/content/$page.txt" , "w");
if ($p_comm!="") {$p_comm="|[comm]".$p_comm."[/comm]";}
if ($p_coord!="") {$p_coord="[coord]".$p_coord."[/coord]";}
if ($p_url!="") {$p_url="[url]".$p_url."[/url]";}
if (trim(trim($p_tags))!="") {
$p_tags="|".str_replace(",", "|", str_replace("\n","", str_replace("\r","", trim(trim($p_tags)))));
if (substr($p_tags,-1)=="|"){
$p_tags=substr($p_tags,0,(strlen($p_tags)-1));

}
}
if ($p_tags!="") {
$p_tags="|".$p_tags;
}
if (trim(trim($p_title))=="") {
$p_title=$lang[221];
}
$viewpage_content=str_replace("==".$outputviewpage[1]."==","", $viewpage_content2);
$outputviewpage[1]="$p_icon$p_title".str_replace("||","|",str_replace("||","|",str_replace("||","|", $p_tags)))."$p_comm"."$p_url"."$p_coord";
fputs ($pageopen, "==".$outputviewpage[1]."==".$viewpage_content);
fclose ($pageopen);
}}}
$p_url="";
$p_url=ExtractString($outputviewpage[1],"[url]","[/url]");
$p_coord="";
$p_coord=ExtractString($outputviewpage[1],"[coord]","[/coord]");
$comm="";
$comm=ExtractString($outputviewpage[1],"[comm]","[/comm]");
$comms=$comm;
$imgs_arr=@explode("src=", @$outputviewpage[1]);
$imgs=str_replace("\"", "", str_replace("\'", "", str_replace(">", "", str_replace("<", "",strtoken(strtoken(@$imgs_arr[1],">")," ")))));
unset ($imgs_arr);

$imgs_arr=explode("|", strip_tags(strtoken($outputviewpage[1],"[")));
if (count($imgs_arr)>1) {
if ($imgs_arr[0]==$viewpage_title) {unset($imgs_arr[0]);}
$tags_s=implode(",", $imgs_arr);
} else {
$tags_s="";
}
$metadesc="";
if ($tags_s!="") {
if (substr($tags_s,-1)==",") {
$tags_s=substr($tags_s,0,(strlen($tags_s)-1));
}
//$tags_ss=substr("$lang[864]: ".$tags_s,0,150);
if (substr($tags_s,0,255)!="") { $kwo=substr($tags_s,0,1255); }
if ($comm!="") {$tags_ss=substr(strip_tags(str_replace("  "," ",str_replace("  "," ",strtoken(str_replace("<br>"," ",$comm),"[")))),0,1050)." ".substr($tags_ss,0,1050);}
$mdesc=htmlspecialchars(strip_tags(str_replace("  "," ",str_replace("  "," ",strtoken(str_replace("<br>"," ",$tags_ss),"[")))));
$metadesc="
<meta property=\"og:description\" content=\"".$mdesc."\" />
<meta name=\"Keywords\" content=\"$kwo\" />
<meta name=\"Description\" content=\"".$mdesc."\" />";
$ukwo=1;
} else {
if ($comm!="") {$tags_ss=substr(strip_tags(str_replace("  "," ",str_replace("  "," ",strtoken(str_replace("<br>"," ",$comm),"[")))),0,1050);}
if ($tags_ss!="") {
$mdesc=htmlspecialchars($tags_ss);
$metadesc="
<meta property=\"og:description\" content=\"".$mdesc."\" />
<meta name=\"Description\" content=\"".$mdesc."\" />
<meta name=\"Keywords\" content=\"$kwo\" />";
$ukwo=1;
}
}
if ($ukwo==0) {$kkwo="<meta name=\"Keywords\" content=\"$kwo\" />\n"; } else {$kkwo="";}
if ($imgs!="") {
if (preg_match("/http:\/\//i",$imgs)==FALSE) {$imgs="$htpath/$imgs";} $fbmeta="$kkwo<meta property=\"og:title\" content=\"".htmlspecialchars(strip_tags("$shop_name | $viewpage_title"))."\" />
<meta property=\"og:type\" content=\"article\" />
<meta property=\"og:url\" content=\"$htpath/index.php?page=$page\" />
<meta property=\"og:image\" content=\"".str_replace("'","",str_replace("\"","",$imgs))."\" />$metadesc
";
} else {
$fbmeta="$kkwo<meta property=\"og:title\" content=\"".htmlspecialchars(strip_tags("$shop_name | $viewpage_title"))."\" />
<meta property=\"og:type\" content=\"article\" />
<meta property=\"og:url\" content=\"$htpath/index.php?page=$page\" />
<meta property=\"og:image\" content=\"$htpath/logo.png\" />$metadesc
";
}
$tag_s=str_replace($p_title.",","",$tag_s);





$titles=Array();
$matches=Array();
$massti=Array();
$ally="";
$titles[0]="";
$i=0;
preg_match_all ("%~~(.*)~~%" , $viewpage_content , $matches);
for  ($i=0; $i<count($matches[0]); $i++) {
$ftoread="$base_loc/content/" .  $matches[1][$i];
if (file_exists($ftoread)==TRUE) {
$fp = fopen ($ftoread , "r");

$ally= fread ($fp, filesize ($ftoread));
$ssila=explode ("." , $matches[1][$i]);
if (preg_match ("/==(.*)==/", $ally, $outy)) {
$titles[$i]=$outy[1];

$massti=explode("|",$titles[$i]);
if (isset($massti[1])){$titles[$i]=$massti[0]; }

$ally = str_replace ("==" . $outy[1] . "==", "" , $ally);
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $ally="<div class=\"round\" align=right width=93%><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">".$lang[810]." ".$matches[1][$i]."</span> <a class=\"btn\" href=#edit onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/".$matches[1][$i]."','fred','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['ch']."\"><i class=icon-edit></i></a>&nbsp;<a class=\"btn\" href=#del onclick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=".str_replace(".txt", "", $matches[1][$i])."&del=".str_replace(".txt", "",$matches[1][$i])."','fr".$matches[1][$i]."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a>
</div>".$ally; }}
$viewpage_content = str_replace ("~~" . $matches[1][$i] . "~~", $ally , $viewpage_content);
fclose ($fp);
} else {

if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$viewpage_content = str_replace ("~~" . $matches[1][$i] . "~~", "<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">".$lang[810]."</span> ".$matches[1][$i]." <font color=#b94a48>".$lang['not_exists']."</font></div>" , $viewpage_content);
} else {
$viewpage_content = str_replace ("~~" . $matches[1][$i] . "~~", "" , $viewpage_content);
}
} else {
$viewpage_content = str_replace ("~~" . $matches[1][$i] . "~~", "" , $viewpage_content);
}
}
}


$viewpage_content=str_replace("==$vpt==", "" , $viewpage_content);
$viewpage_content=str_replace("[rss]","$rss", $viewpage_content);
$viewpage_title=strip_tags(str_replace("\n","", $viewpage_title));
if (substr($page,0,1)==$wiki_rubric) {
$tmptitr=Array();
$tmptitr=explode("/", $viewpage_title);
$viewpage_title=$tmptitr[0];
$classes=end($tmptitr);
if (trim($classes)!="") {
if (preg_match("/\[/i",$classes)) {
$tmpcl=explode("[",$classes);
while (list ($keycl, $valcl) = @each ($tmpcl)) {
$valcl=substr($valcl,0,-1);
if (trim($valcl)!="") {
$typeclass=strtoken($valcl,":");
$valclass=trim(str_replace($typeclass.":", "", $valcl));
$typesclass.= "<b>$typeclass</b>: <i><a href=\"index.php?query=".rawurlencode(toLower("$typeclass:$valclass"))."&usl=AND\" style=\"border-bottom: #0000FF 1px dashed; text-decoration:none;\">$valclass</a></i>&nbsp;&nbsp;&nbsp;";
}
}
$viewpage_content=$typesclass."<br>".$viewpage_content;
}
}

}

if ($auto_mark_wiki==1){
 $viewpage_content=wikify($viewpage_content,$page);
}
if ($sape_id!="") {

if (is_dir("./$sape_id")) {

$sapec=0;
$sape="";
$sapec = ExtractString($viewpage_content, "[sape]", "[/sape]");
if ($sape_id!="") {
if (!defined('_SAPE_USER')){
define('_SAPE_USER', "$sape_id");
}
require_once("./".$sape_id."/sape.php");
$saped = new SAPE_client();
$sapec = ExtractString($themecontent, "[sape]", "[/sape]");
$sapec2 = ExtractString($themecontent, "[sapeblock]", "[/sapeblock]");
$themecontent=str_replace("[sape]".$sapec."[/sape]",$saped->return_links(),$themecontent);
$themecontent=str_replace("[sapeblock]".$sapec2."[/sapeblock]",$saped->return_block_links(),$themecontent);
}
}
}

if (trim($p_coord)!="") {
require ("./modules/citymap.php");
$viewpage_content=$viewpage_content."<br><br>".$lemap;
} else {
if (preg_match("/\[citymap\]/",$viewpage_content)) {
require ("./modules/citymap.php");
$viewpage_content=str_replace("[citymap]","$lemap", $viewpage_content);
}
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")):
$imgas="";
if ($imgs!="") {$imgas="<img src=\"$imgs\" id=\"img_1\">";$imgs="<img src=\"$imgs\">";} else {$imgas="<img src=\"$image_path/pix.gif\" id=\"img_1\">";}
$purl="";
$purl="<tr><td colspan=3><b>URL:</b><br><input type=text size=20 style=\"width:96%\" name=\"p_url\" value=\"".htmlspecialchars($p_url)."\" placeholder=\"http://\"></td></tr>";
$pcoord="";
$pcoord="<tr><td colspan=3><b>Loc:</b><br><input type=text size=20 style=\"width:96%\" name=\"p_coord\" value=\"".htmlspecialchars($p_coord)."\" placeholder=\"x:y\"></td></tr>";

if (isset($_POST['p_title'])) {
$viewpage_title=trim($_POST['p_title']);
}

if ($_SESSION["do1"]=="") {
$doclass=" style=\"display:block;\"";
$dopbutton="<a href=#other id=\"divbut\" class=\"btn pull-right ml\" onClick=edits()><i class=icon-arrow-up></i> ".$lang[1550]."</a>";
} else {
$dopbutton="<a href=#other id=\"divbut\" class=\"btn pull-right ml\" onClick=edits()><i class=icon-arrow-down></i> ".$lang[1550]."</a>";
$doclass=" style=\"display:none;\"";
}
$viewpage_content="<script language=javascript>
function replaceButtonText(buttonId, text)
{
  if (document.getElementById)
  {
    var button=document.getElementById(buttonId);
    if (button)
    {
      if (button.childNodes[0])
      {
        button.childNodes[0].nodeValue=text;
      }
      else if (button.value)
      {
        button.value=text;
      }
      else //if (button.innerHTML)
      {
        button.innerHTML=text;
      }
    }
  }
}
function edits() {
if (document.getElementById('div_edit').style.display == 'none') {
document.getElementById('div_edit').style.display='block';
document.getElementById('divbut').innerHTML='<i class=icon-arrow-up></i> ".$lang[1550]."';
} else {

document.getElementById('div_edit').style.display='none';
document.getElementById('divbut').innerHTML='<i class=icon-arrow-down></i> ".$lang[1550]."';
}
refreshsess(1);
}
</script>
<div class=form-inline style=\"margin-bottom:10px;\">".$dopbutton."<a href=#del onclick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=$page&del=$page','fr$page','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\" class=\"btn pull-right ml\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a>
<a href=#add_sub class=\"btn pull-right ml\" onClick=\"javascript:window.open('$htpath/admin/editor/edit.php?speek=$speek&c=".substr($page,0,1)."&klon=1','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\" title=\"".$lang[384]."\"><i class=icon-arrow-down></i></a>
<a href=#edit class=\"btn pull-right ml\" onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/$page.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\" title=\"".$lang['ch']."\"><i class=icon-edit></i></a>
<div class=\"pull-left mr\"><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-top:5px;\">$page</span></div>
<div class=clearfix></div>
</div>
<div id=\"div_edit\"".$doclass.">
<div class=img style=\"width:100%;\">
<form method=POST action=index.php class=form-inline><input type=\"hidden\" name=\"page\" value=\"$page\"><input type=\"hidden\" name=\"agree\" value=\"".md5(date("d.m.Y",time()).$artrnd)."\">
<table border=0 cellspacing=5 cellpadding=5 width=100%><tr><td valign=top rowspan=2><table class=table border=0 width=100%>
<tr><td align=right><b>".$lang[862].":</b></td><td width=100% colspan=2><input type=text size=20 style=\"width:96%\" name=\"p_title\" value=\"".htmlspecialchars($viewpage_title)."\"></td></tr>
<tr><td align=right><b>".$lang[861].":</b></td><td width=100%><input type=text id=\"el_1\" size=20 style=\"width:96%\" name=\"p_icon\" value=\"".htmlspecialchars($imgs)."\"></td><td align=right><a class=\"btn btn-success mr nowrap\" onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=1','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10');\" title=\"".$lang[938]."\"><i class=icon-camera></i> ".$lang[421]."</a></td></tr>
<tr><td colspan=3><b>".$lang['short'].":</b><br><input type=text size=20 style=\"width:96%\" name=\"p_comm\" value=\"".htmlspecialchars($comms)."\"></td></tr>
<tr><td colspan=3><b>".$lang[863].":</b><br><input type=text size=20 style=\"width:96%\" name=\"p_tags\" value=\"".htmlspecialchars($tags_s)."\"></td></tr>$purl"."$pcoord</table></td><td valign=top align=right><div class=\"img-polaroid\" style=\"width:150px; height:150px; padding:10px 10px 10px 10px; margin-bottom:20px; cursor:pointer; cursor: hand; overflow:hidden;\" align=center onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=1','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10');\" title=\"".$lang[938]."\">$imgas<div class=muted>$lang[421]</div></div></td></tr><tr><td valign=bottom align=right><input class=\"btn btn-primary btn-large\" type=submit value=\"".$lang[527]."\"></td></tr></table>
</form>


</div>
</div>
<br><div id=\"div_content\" style=\"display:block;\">".$viewpage_content."</div>"; endif;}

$all_links="";
if ($page=="a") {$viewpage_title="";}

/*
$handle=opendir("$base_loc/content/");


while (($file = readdir($handle))!==FALSE) {

If (($file == '.') || ($file == '..') || ($file == 'config.inc')||(substr($file, -4)==".del")||(substr($file,0, 1)=="s")||(substr($file,0, 1)=="x")||(substr($file,0, 1)!=substr($page,0, 1))) {
continue;
} else {
$fp = fopen ("$base_loc/content/$file" , "r");

$all= fread ($fp, 300);
if (preg_match ("/==(.*)==/", $all, $out)) {
$line=$out[1];
} else {
$line = $lang[221];
}
$line=substr($line, 0 , 82);
fclose ($fp);
$out=explode(".",$file);
$c = $out[0];
if (strlen($c)==1) {
$name="<!--00000--><b><a href='$htpath/index.php?page=$c'><font color=$nc2>$line :</font></a></b><hr color=$nc2 noshade size=1>";
} else {
if ($page==$c) {
$name = "<!--$c--><b><font color=$nc3>$carat</b>&nbsp;<b>$line</b></font>";
} else {
$name = "<!--$c--><b><font color=$nc4>$carat</font></b>&nbsp;<a href='$htpath/index.php?page=$c'>$line</a>";
}
}
$files["$c"] = "$name\n";

}
}

closedir ($handle);

@sort ($files);
@reset ($files);
while (list ($key, $val) = @each ($files)) {
$all_links .= "<br>$val\n";
}
$all_links .= "<br><br>\n";
if (strlen($page)==1) {
reset ($files);
while (list ($key, $val) = each ($files)) {
if ((substr($key, 0, 1)==$page)&&($key!=$page)) {
//$razd_links .= "$val<br>\n";
}
}
}

*/


/*
if (substr($page,0,1)==$page) {
if (file_exists("$base_loc/wiki/$page.txt")==TRUE) {
$fp = fopen ("$base_loc/wiki/$page.txt" , "r");
$wiki=fread($fp,filesize("$base_loc/wiki/$page.txt"));
fclose($fp);
$viewpage_content=$viewpage_content.$wiki;
}
} else{
if (substr($page,0,1)==$wiki_rubric) {
if (file_exists("$base_loc/wiki/$wiki_rubric.txt")==TRUE) {
$fp = fopen ("$base_loc/wiki/$wiki_rubric.txt" , "r");
$wiki=fread($fp,filesize("$base_loc/wiki/$wiki_rubric.txt"));
fclose($fp);
$viewpage_content=$viewpage_content."<br>".$wiki;
}
}
}
*/
//$viewpage_content.=$all_links;
$viewpage_content.="<br><br>
<table border=0 width=100% cellpadding=0><tr><td valign=top>";

if (substr($page,0,1)==$page) {$view_comments_site=0;}
$ccom=0;
if (preg_match("/\[comments\]/i",$viewpage_content)==TRUE){$ccom=1;}
if (($view_comments_site==1)||($ccom==1)) {
$unifmd=strip_tags(trim($page));
if (@file_exists("./admin/comments/votes/$unifmd.txt")==TRUE) {
$tmpvotef=file("./admin/comments/votes/$unifmd.txt");
$vcount=doubleval(trim($tmpvotef[1]));
$vlevel=round(doubleval(trim($tmpvotef[0])));
$voting="<div align=right><img src=\"$image_path/vote".$vlevel.".png\" title=\"".$lang[681]."\" border=0> <b>$vlevel/5</b> [<a title=\"".$lang[682]."\" href=\"#comm\" onclick=\"javascript:commv();\">$vcount</a>]</div><br>";
unset($tmpvotef);
}











//comments data validate
if (array_key_exists("comments_text".md5(date("d.m.Y")), $_POST)) { $comments_text=$_POST["comments_text".md5(date("d.m.Y"))]; } else {$comments_text="";}
if (array_key_exists("antispam_a".md5(date("d.m.Y")), $_POST)) { $antispam_a=$_POST["antispam_a".md5(date("d.m.Y"))]; } else {$antispam_a="";}
if (!isset($antispam_a)){$antispam_a="";} $antispam_a=toLower(trim(stripslashes($antispam_a))); if (!preg_match('/^[à-ÿÀ-ß¸¨a-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i',$antispam_a)) { $antispam_a="";}
if (array_key_exists("antispam_row".md5(date("d.m.Y")), $_POST)) { $antispam_row=$_POST["antispam_row".md5(date("d.m.Y"))]; } else {$antispam_row="";}
if (!isset($antispam_row)){$antispam_row="";} $antispam_row=trim(stripslashes($antispam_row)); if (!preg_match('/^[a-z0-9_]+$/i',$antispam_row)) { $antispam_row="";}


reset ($antispam_array);
while (list ($as_key, $as_st) = each ($antispam_array)) {
$antispam_que=strtoken($as_st,"=");
$antispam_ans=trim(str_replace("$antispam_que=", "", $as_st));
$antispam_index=md5(date("d.m.Y").$as_key);
if ($antispam_index==$antispam_row) {
if ($antispam_a==$antispam_ans) {
$answer_ok=1;
}
}
}
if ((!@$comments_name) || (@$comments_name=="")){ $comments_name=""; } else { $comments_name=substr($comments_name, 0, 50); $comments_name = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $comments_name); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $comments_name); $comments_name = str_replace("|", "", $comments_name);  $comments_name = str_replace(chr(27), "", $comments_name); $comments_name = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$comments_name))); $comments_name=badwords($comments_name);}
if ((!@$comments_text) || (@$comments_text=="")){ $comments_text=""; } else { $comments_text=substr($comments_text, 0, 1000);$comments_text = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $comments_text); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $comments_text); $comments_text = str_replace(chr(10), " ", $comments_text);   $comments_text = str_replace(chr(27), "", $comments_text); $comments_text = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$comments_text)));

 $comments_text=badwords($comments_text);}
//shield for flood
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {$comments_name="ADMIN";}}
if ($comments_name=="") {
$comments_name=$lang[193];
}
if ($comments_text=="") {
$flood="";
} else {
if ($answer_ok==1) {
if ($_SESSION["user_banned"]==0) {
if (@$_SESSION["last_comm"]==$unifmd."|" . $comments_text) {
$flood="<br><font color=#b94a48><b>".$lang[177]."</b></font>";
} else {
if((preg_match("/http:\/\//i",$comments_text))||(preg_match("/http:\/\//i",$comments_name))){
$flood="<br><font color=#b94a48><b>".$lang[178]."</b></font>";
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {$flood="";}}
if ($flood=="") {

//Add votes
if ($vote!="") {
if (@file_exists("./admin/comments/votes/$unifmd.txt")==FALSE) {
//vote not exists
$votecount=1;
$votelevel=$vote;
} else {
$tmpvotef=file("./admin/comments/votes/$unifmd.txt");
$votecount=doubleval(trim($tmpvotef[1]))+1;
$votelevel=round((((doubleval(trim($tmpvotef[1]))*doubleval(trim($tmpvotef[0])))+$vote)/$votecount),5);
}
$df = fopen ("./admin/comments/votes/$unifmd.txt" , "w"); flock ($df, LOCK_EX);
fputs($df, "$votelevel\n$votecount\n"); flock ($df, LOCK_UN);
fclose($df);
}


$_SESSION["last_comm"]=$unifmd."|" . $comments_text;
if(get_magic_quotes_gpc()) {$comments_text = stripslashes($comments_text); $comments_name = stripslashes($comments_name);}
$df = fopen ("./admin/comments/$unifmd.txt" , "a"); flock ($df, LOCK_EX);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){$comments_ip=""; $colred1="[adm]"; $colred2="[/adm]";} else {$colred1=""; $colred2=""; $comments_ip=" [ip]".@$_SERVER['REMOTE_ADDR']."[/ip]";}}else {$colred1=""; $colred2=""; $comments_ip=" [ip]".@$_SERVER['REMOTE_ADDR']."[/ip]";}
fputs($df, trim("\n\n[hr][vote]".$vote."[/vote] $colred1".gmdate("d.m.Y / H:i",(time()))." [b]".htmlspecialchars($comments_name).":[/b]$comments_ip [i] \n\n\n".htmlspecialchars(str_replace("&","[amp]", $comments_text)) ."$colred2"."\n\n\n [/i]\n")); flock ($df, LOCK_UN);
fclose($df);
}
}

}else {
$flood="<br><font color=#b94a48><b>".$lang[179]."</b></font>";
}

if (@file_exists("./admin/comments/votes/$unifmd.txt")==TRUE) {
$tmpvotef=file("./admin/comments/votes/$unifmd.txt");
$vcount=doubleval(trim($tmpvotef[1]));
$vlevel=round(doubleval(trim($tmpvotef[0])));
$voting="<div align=right><img src=\"$image_path/vote".$vlevel.".png\" title=\"".$lang[681]."\" border=0> <b>$vlevel/5</b> [<a title=\"".$lang[682]."\" href=\"#comm\" onclick=\"javascript:commv();\">$vcount</a>]</div><br>";
}
} else {
$flood="<br><font color=#b94a48><b>".$lang[825]."</b></font>";
}
}
//end shield
unset ($df);












$comm_book="<br><font color=$nc4>".$lang[180]."</font>";
if (!isset($del_com)) {$del_com=0;}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) if (($valid=="1")&&($del_com!=0)){
if (@file_exists("./admin/comments/$unifmd.txt")==TRUE) {
unlink("./admin/comments/$unifmd.txt");
unlink("./admin/comments/votes/$unifmd.txt");
$comm_book="<br><b>".$lang[181]."</b>";
$vcount=0;
$vlevel=0;
$voting="";




}
}}
if (!isset($ctext)) {$ctext="";}
if (!isset($cact)) {$cact="";}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ if (($valid=="1")&&($ctext=="")&&($cact=="1")){
if (@file_exists("./admin/comments/$unifmd.txt")==TRUE) {
unlink("./admin/comments/$unifmd.txt");
unlink("./admin/comments/votes/$unifmd.txt");
$comm_book="<br><b>".$lang[181]."</b>";
}
}}
$oki=0;
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")&&($ctext!="")&&($cact=="1")){
if (@file_exists("./admin/comments/$unifmd.txt")==TRUE) {
if(get_magic_quotes_gpc()) {$ctext = stripslashes($ctext);}
$df2 = fopen ("./admin/comments/$unifmd.txt" , "w"); flock ($df2, LOCK_EX);
fputs($df2, str_replace("[br]", chr(10), $ctext));
flock ($df2, LOCK_UN);
fclose($df2);
$oki=1;
$comm_book="<br><b>".$lang[182]."</b>";
}
}}

if (@file_exists("./admin/comments/$unifmd.txt")==TRUE) {
$ef=fopen("./admin/comments/$unifmd.txt" , "r");
$commread=fread($ef, filesize("./admin/comments/$unifmd.txt"));
fclose($ef);
//$comm_book=str_replace("[adm]","<font color=$nc2>",str_replace("[/adm]","</font>", str_replace("[vote]","<img src=\"$image_path/vote",str_replace("[/vote]",".png\">",str_replace("[hr]", "<div class=clear><br></div>", str_replace("[i]", "<i class=muted>", str_replace("[/i]", "</i>", str_replace("[b]", "<b>", str_replace ("[/b]", "</b>", str_replace ("[br]", "<br>", str_replace("[amp]", "&", $commread)))))))))));
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){$comm_book= str_replace("[ip]", "<a href=\"$htpath/index.php?action=userip&ban=ip_", str_replace("[/ip]", "&start=0&perpage=10&ipsort=\">".$lang[186]."</a>", $comm_book));} else {$comm_book=str_replace("[ip]", "<!-- ", str_replace("[/ip]", " -->", $comm_book));} } else {$comm_book=str_replace("[ip]", "<!-- ", str_replace("[/ip]", " -->", $comm_book));}

//Simple Comments editor    added 16.11.2005
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {
$admin_book="<form class=form-inline action=\"$htpath/index.php\" method=\"post\">
<br><p align=\"center\"><b>".$lang[183]."</b> <small>(".$lang[184].")</small><br><input type=\"hidden\" name=\"page\" value=\"". $page ."\"><input type=\"hidden\" name=\"cact\" value=\"1\"><br>
<textarea rows=\"22\" style=\"width:90%\" name=\"ctext\" cols=\"44\">".str_replace("[br]", "\n", $commread)."</textarea><p align=\"center\"><input type=\"submit\" class=\"btn btn-primary\" value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\"></p></form><form class=form-inline action=\"$htpath/index.php\" method=\"POST\"><p align=\"center\"><input type=\"hidden\" name=\"page\" value=\"". $page ."\"><input type=\"hidden\" name=\"del_com\" value=\"1\"><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[185]."\"></p></form>";
}}
//end comments editor
}


$comments_user=@$_SESSION["user_login"];
if ($comments_user=="") {$comments_user=$lang[193]; }






$rand_st=rand(0, count($antispam_array));
$randoma=@$antispam_array[$rand_st];
$antispam_q=strtoken($randoma,"=");
if (trim($antispam_q=="")) {$randoma=$antispam_array[0]; $antispam_q=strtoken($randoma,"="); $rand_st=0;}

$antispam_answer=trim(str_replace("$antispam_q=", "", $randoma));
if ($antispam_answer=="".doubleval($antispam_answer)) {$antispam_type=$lang[651];} else {$antispam_type="";}

$comment_form="<div>
<form class=form-inline action=\"".$_SERVER['PHP_SELF'] . "\" method=\"post\"><input type=hidden name=\"page\" value=\"".$page."\">
<h4>".$lang[192]."</h4>
<table border=0 cellpadding=5 width=100%>
<tr><td valign=\"top\" align=\"right\" width:20%><b>".$lang[74].":</b></td><td><input type=\"text\" name=\"comments_name\" value=\"$comments_user\" size=40 style=\"width:90%\"></td><td valign=top style=\"white-space:nowrap\"><small>".$lang[190]."</small></td></tr><tr><td valign=\"top\" align=\"right\"><b>".$lang[191]."</b></td><td valign=top><textarea name=\"comments_text".md5(date("d.m.Y"))."\" cols=40 rows=5 style=\"width:90%\"></textarea><br></td><td valign=top style=\"white-space:nowrap\"><small>".$lang[189]."</small></td></tr><tr><td valign=top align=\"right\">
<b>".$lang[683].":</b></td><td>
<table border=\"0\" cellspacing=\"0\" cellpadding=2>
		<tr>
			<td align=\"left\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote1\" width=\"16\" height=\"17\"></td>
            <td align=\"left\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote2\" width=\"16\" height=\"17\"></td>
			<td align=\"left\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote3\" width=\"16\" height=\"17\"></td>
			<td align=\"left\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote4\" width=\"16\" height=\"17\"></td>
			<td align=\"left\">
			<img border=\"0\" src=\"$image_path/s1.png\" id=\"vote5\" width=\"16\" height=\"17\"></td>
            <td valign=top rowspan=2 width=25>&nbsp;</td><td valign=top rowspan=2><small>".$lang[684]."</small></td>
		</tr>
		<tr>
			<td align=\"left\"><input type=\"radio\" value=\"1\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s0.png';
            document.getElementById('vote3').src='$image_path/s0.png';
            document.getElementById('vote4').src='$image_path/s0.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot1><label for=vot1>1</label></td>
			<td align=\"left\"><input type=\"radio\" value=\"2\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s0.png';
            document.getElementById('vote4').src='$image_path/s0.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot2><label for=vot2>2</label></td>
			<td align=\"left\"><input type=\"radio\" value=\"3\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s1.png';
            document.getElementById('vote4').src='$image_path/s0.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot3><label for=vot3>3</label></td>
			<td align=\"left\"><input type=\"radio\" value=\"4\" name=\"vote\" onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s1.png';
            document.getElementById('vote4').src='$image_path/s1.png';
            document.getElementById('vote5').src='$image_path/s0.png';
            \" autocomplete=\"off\" id=vot4><label for=vot4>4</label></td>
			<td align=\"left\"><input type=\"radio\" value=\"5\" name=\"vote\" checked onClick=\"
            document.getElementById('vote1').src='$image_path/s1.png';
            document.getElementById('vote2').src='$image_path/s1.png';
            document.getElementById('vote3').src='$image_path/s1.png';
            document.getElementById('vote4').src='$image_path/s1.png';
            document.getElementById('vote5').src='$image_path/s1.png';
            \" autocomplete=\"off\" id=vot5><label for=vot5>5</label></td>

	</tr></table></td></tr>
    <tr><td align=right valign=top width=20%><b>$lang[796]:</b></td><td valign=top width=100%><span class=\"label label-warning\">".$lang[826]."</span> <i>$antispam_q?</i></td></tr>
    <tr><td align=right valign=top width=20%>&nbsp;</td><td valign=top><br><input type=\"text\" style=\"width:90%\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"\" style=\"width: 90%\" placeholder=\"$lang[805] "."$antispam_type\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\"></td>
    </tr>
    <tr><td width=20%>&nbsp;</td><td align=\"left\"><br><input type=\"submit\" class=\"btn btn-primary btn-large\" value=\"".$lang['sendform']."\"></td><td>&nbsp;</td></tr></table></form></div>";

$pagejs="<script language=javascript>
<!--

function commv() {
if (document.getElementById('div_commf').style.display == 'none') {

document.getElementById('div_commf').style.visibility = 'visible';
document.getElementById('div_commf').style.display = 'inline';
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/loadcomments.php?unifmd=$unifmd&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);

} else {
document.getElementById('div_commf').style.display = 'none';
document.getElementById('div_commf').style.visibility = 'hidden';
}
}
-->
</script><a name=\"comm\"></a>";

$jslistv="<div id=\"jscomm\"></div><div id=\"jsphpcomm\">loading...</div>
";
if ($ccom==0) {

$viewpage_content.="<a class=\"btn btn-info\" id=\"commf\" onclick=\"javascript:commv();\"><i class=\"icon-comment icon-white\"></i> ".$lang[8].":&nbsp;[$vcount]</a></td></tr></table>";
if (!isset($voting)) {$voting="";}
if($flood!="") {$flood="<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><i class=icon-remove></i></button>$flood<br><br></div>";}
$viewpage_content=$viewpage_content.$voting."$pagejs$flood<div id=\"div_commf\" style=\"display:none; visibility:hidden;\" align=left>
$jslistv<br>$comment_form".@$admin_book."

</div><br>";
} else {
$viewpage_content.="</td></tr></table>";

$viewpage_content=str_replace("[comments]", "<a class=\"btn btn-info\" id=\"commf\" onclick=\"javascript:commv();\"><i class=\"icon-comment icon-white\"></i> ".$lang[8].":&nbsp;[$vcount]</a>$pagejs$flood"."<div id=\"div_commf\" style=\"display:none; visibility:hidden;\" align=left>
$jslistv<br>$comment_form".@$admin_book."

</div><br>",$voting.$viewpage_content);

}

$cartlist.= "</div>";
} else {
$viewpage_content.="</td></tr></table>";
}
$fir=substr($page,0,1);

if (file_exists("$base_loc/wiki/".$fir.".txt")==TRUE) {
$fp = fopen ("$base_loc/wiki/".$fir.".txt" , "r");
$wiki=@fread($fp, @filesize("$base_loc/wiki/".$fir.".txt"));
fclose($fp);
$wimd=substr(toLower(trim(strip_tags(trim($viewpage_title)))),0,1);
if ($wimd!="") {
$wimd=md5($wimd);
if ($fir!=$page) {$wiki=str_replace("//start", "jsallcl();
document.getElementById('div_".$wimd."').style.visibility = 'visible';
document.getElementById('div_".$wimd."').style.display = 'inline';
document.getElementById('divd_".$wimd."').style.backgroundColor = '$nc2';" , $wiki);}
}

if ($wiki_closed==1) {
$wiki=str_replace("//start", "jsallcl();
document.getElementById('viewjsall').innerHTML='".$lang[422]."';
" , $wiki);}
if ($fir==$wiki_rubric) {
$viewpage_content=str_replace("[wiki_all_articles]","", $viewpage_content)."[wiki_all_articles]";
} else {

if (($view_wiki_on_each_pages==1)&&($fir!=$page)) {
$viewpage_content=str_replace("[wiki_all_articles]","", $viewpage_content)."[wiki_all_articles]";
}
}

$viewpage_content=str_replace("[wiki_all_articles]", "<br>".str_replace("decoration:none;\">$viewpage_title</a>","decoration:none; background:$nc2; color:$nc0;\">$viewpage_title</a>", str_replace("padding: 10px 0px;", "padding: 10px 10px;",str_replace("$carat", "",$wiki))), $viewpage_content);
}
if(isset($_GET['jstart'])) $jstart=$_GET['jstart']; elseif(isset($_POST['jstart'])) $jstart=$_POST['jstart']; else $jstart=0;
if (!preg_match('/^[0-9]+$/',$jstart)) { $jstart=0;}
$jstart=($jstart-$gallery_cols+1);
if ($jstart<0) {$jstart=0;}
if (file_exists("$base_loc/wiki/".$fir.".all")==TRUE) {
$fp = fopen ("$base_loc/wiki/".$fir.".all" , "r");
$wikiallart=@fread($fp, @filesize("$base_loc/wiki/".$fir.".all"));
fclose($fp);
if ($page=="c") {
$wikiallart=str_replace("01. ","",str_replace("02. ","",str_replace("03. ","",str_replace("04. ","",str_replace("05. ","",str_replace("06. ","",str_replace("07. ","",str_replace("08. ","",str_replace("09. ","",$wikiallart)))))))));
$wikmass=explode("<!--end-->", $wikiallart);
$wi=1; $wis=10;
$wikiallart="<table border=0 width=100% cellspacing=20 cellpadding=10><tr>";
while (list($wk, $wv)=each($wikmass)) {
if(trim($wv)!="") {
$wikiallart.="<td valign=top width=25%>$wv</td>";
}
$wi+=1;

$wis+=1;
if ($wi>4) {$wikiallart.="</tr><tr>"; $wi=1;}
}
while ($wis>0) {
$wikiallart=str_replace($wis.". ", "",$wikiallart);
$wis-=1;
}
$wikiallart.="</tr></table>";
//$wikiallart=implode("",$wikmass);

$viewpage_content=str_replace("[wiki_list]", str_replace("</div></div><br>","</div></div>", str_replace(" align=left", " ", str_replace("</a><a href","</a><br><br><a href", str_replace("border-bottom: #b94a48 1px dashed;", "", str_replace("border: 1px solid", "border: 0px solid", str_replace("<div", "<div align=center", str_replace("$carat", "<br>",$wikiallart))))))), $viewpage_content);
}
if (($view_wikilist_on_each_pages==1)&&($fir!=$page)) {
$viewpage_content=str_replace("[wiki_list]","", $viewpage_content);
}
$viewpage_content=str_replace("[wiki_list]", "<br>".str_replace("decoration:none;\">$viewpage_title</a>","decoration:none; background:$nc2; color:$nc0;\">$viewpage_title</a>", str_replace("padding: 10px 0px;", "padding: 10px 10px;",str_replace("<img", "<img hspace=10",str_replace("$carat", "<br>",$wikiallart)))), $viewpage_content);
}

if (file_exists("$base_loc/wiki/".$fir.".car")==TRUE) {
$fp = fopen ("$base_loc/wiki/".$fir.".car" , "r");
$wikislide=@fread($fp, @filesize("$base_loc/wiki/".$fir.".car"));
fclose($fp);
if (($view_wikislide_on_each_pages==1)&&($fir!=$page)&&(substr($page,0,1)==$wiki_content)) {
if ($wikislide_poz==1) {
$viewpage_content=str_replace("[wiki_slide]","", $viewpage_content)."[wiki_slide]";
} else {
$viewpage_content="[wiki_slide]".str_replace("[wiki_slide]","", $viewpage_content);

}
}
$viewpage_content=str_replace("[wiki_slide]", "<br>".str_replace("decoration:none;\">$viewpage_title</a>","decoration:none; background:$nc2; color:$nc0;\">$viewpage_title</a>", str_replace("padding: 10px 0px;", "padding: 10px 10px;", str_replace("<img", "<img hspace=10",str_replace("$carat", "<br>", str_replace("start: 0","start: ".$jstart, str_replace("</a><a ","</a><br><a ",$wikislide)))))), $viewpage_content);
}

$viewpage_content=str_replace("[equal]","==", $viewpage_content);
$viewpage_content=str_replace("[ravno]", "==", $viewpage_content);
$viewpage_content=str_replace("[demzal]", "$demzal", $viewpage_content);
$viewpage_content=str_replace("[flashobj]", "$flashobj", $viewpage_content);
$viewpage_content=str_replace("[jstart]","$jstart", $viewpage_content);
if ($tags_s=="") { if (file_exists("./admin/search/tags/$speek/$page.txt")==TRUE) {$viewpage_content.="<br><br><div align=left>$lang[864]: ".implode("",file("./admin/search/tags/$speek/$page.txt"))."</div><br><br>"; } }

if($jstart!=1){$viewpage_content=str_replace("auto: 2,","", $viewpage_content); }
//if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
//$viewpage_content= str_replace("[html_content]","$html_content", $viewpage_content);
//}}
require ("./templates/$template/form.inc");
$viewpage_content=str_replace("[contactform]","$contactform",$viewpage_content);
} else {
$viewpage_content="<img src=$image_path/error404.png border=0 align=left hspace=10 title=\"3.OOPS!\"><b>".$lang[1103]."</b><br><br>".$lang[1104]. " <b><a href=$htpath/index.php>". $shop_name."</a></b><META HTTP-EQUIV=\"REFRESH\" CONTENT=\"5;URL=$htpath/index.php\">";

}
$viewpage_content=str_replace("[back]", "<a class=cat1 href=\"index.php?page=".substr($page,0,1)."\"><img src=\"images/pix.gif\" height=\"1\" width=\"10\" border=\"0\"><img src=\"$image_path/larr.png\" border=0 align=absmiddle>".$lang['back']."</a><img src=\"images/pix.gif\" height=\"1\" width=\"10\" border=\"0\">", $viewpage_content);
$ttt="";
if ($view_social==1) {$ttt="<div class=\"yashare-auto-init pull-right\" data-yashareL10n=\"ru\" data-yashareType=\"none\" data-yashareQuickServices=\"facebook,twitter,vkontakte,lj\"><script type=\"text/javascript\" src=\"//yandex.st/share/share.js\" charset=\"utf-8\"></script></div>";
}
$rmon = array ($lang[115],$lang[116],$lang[117],$lang[118],$lang[119],$lang[120],$lang[121],$lang[122],$lang[123],$lang[124],$lang[125],$lang[126]);
if (($tags_s!="")&&(substr($page,0,1)!=$wiki_rubric)) {
$ttt.="<div class=\"pull-left lnk mr\">";
$fcs=1;
while (list($keyta,$valka)=each($tags_tarr)) {
if (($fcs/2)==floor(($fcs/2))) { $fclt=$nc5;} else {$fclt=$nc4;}
$valka=trim($valka);
if ($valka!="") {
$fcs+=1;
$ttt.="<a href=\"$htpath/index.php?query=".rawurlencode($valka)."\" title=\"$valka\">".toFirst($valka)."</a>, ";
}
}
$ttt=substr($ttt,0,-2);
$ttt.="</div>";
}
if ($comm!="") {$comm="<div class=\"comnts\">$comm</div>\n\n";}
$clnd="";
$clnd2="";
if ($cont_tags_pos=="top") {
$clnd.=$ttt;
}
if ($cont_tags_pos=="bottom") {
$clnd2.="<br>".$ttt;
}
$clnd.="<div class=\"pull-left muted\"><i class=\"icon-calendar\"></i> ".date("d",$ts)." ".$rmon[date("m",$ts)-1]." ".date("Y",$ts)." <i>".date("H:i",$ts)."</i></div>\n\n";
$viewpage_content="<div class=pcont>".str_replace("[cut]", "<a name=\"cut\"></a>", $viewpage_content)."</div>";
if ($ttt!="") {$viewpage_content=$comm.$clnd."<div class=clearfix></div>".$viewpage_content.$clnd2;}



}
?>
