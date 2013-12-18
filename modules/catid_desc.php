<?php
$kwo="";
$catid_content = "";
$catid_title = "";
//Выведем описания категорий//
$desc_file=$catid;
if (($unifid=="")&&($item_id=="")) {
if ($catid=="_"):$desc_file="0000"; endif;
if ("$catid"=="0"):$desc_file="0000"; endif;
}
//If you wish include decription
if (@file_exists("$base_loc/content/z_".@$desc_file.".txt")==TRUE) {

$pageopen = fopen ("$base_loc/content/z_".@$desc_file.".txt" , "r");
$catid_content = fread($pageopen, filesize("$base_loc/content/z_".@$desc_file.".txt"));

if (preg_match("/==(.*)==/i", $catid_content, $output)) {
$catid_title=$output[1];
} else {
$catid_title = "";
}
$con=$catid_content; $poll_exp="</div>"; require "./modules/mod_poll.php"; $catid_content=$con;
fclose ($pageopen);



$p_url="";
$p_url=ExtractString($output[1],"[url]","[/url]");
$comm="";
$comm=ExtractString($output[1],"[comm]","[/comm]");
$comms=$comm;
$imgs_arr=@explode("src=", @$output[1]);
$imgs=str_replace("\"", "", str_replace("\'", "", str_replace(">", "", str_replace("<", "",strtoken(strtoken(@$imgs_arr[1],">")," ")))));
unset ($imgs_arr);

$imgs_arr=explode("|", strip_tags(strtoken($output[1],"[")));
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
<meta property=\"og:url\" content=\"$htpath/index.php?catid=$catid\" />
<meta property=\"og:image\" content=\"".str_replace("'","",str_replace("\"","",$imgs))."\" />$metadesc
";
} else {
$fbmeta="$kkwo<meta property=\"og:title\" content=\"".htmlspecialchars(strip_tags("$shop_name | $viewpage_title"))."\" />
<meta property=\"og:type\" content=\"article\" />
<meta property=\"og:url\" content=\"$htpath/index.php?catid=$catid\" />
<meta property=\"og:image\" content=\"$htpath/logo.png\" />$metadesc
";
}
$tag_s=str_replace($p_title.",","",$tag_s);


$carw=ExtractString($catid_content,"[carw]","[/carw]");
$carb=ExtractString($catid_content,"[buttons]","[/buttons]");
$carh=ExtractString($catid_content,"[carh]","[/carh]");
$cara=ExtractString($catid_content,"[auto]","[/auto]");
$carspeed=ExtractString($catid_content,"[speed]","[/speed]");
$carc=ExtractString($catid_content,"[carousel]","[/carousel]");
$catid_content=str_replace("[carousel]".$carc."[/carousel]","[carousel]",$catid_content);
if ($carc!="") {
$newcar=Array();
$newcar=explode("<li>",$carc);
$carc="";
while (list($cark, $carv)=each($newcar)) {

if (preg_match("/<img/i",$carv)) {
$carc.="<li>".$carv;
}
}
if ($carc!="") {

$butscr="";$butc1="";$butc2="";

if ($carb=="yes") {
$butc1="<table border=\"0\" cellpadding=0 cellspacing=0 width=100%><tr><td align=\"center\">
<a class=\"prev\">&nbsp;</a><br><br><br>
</td><td align=\"center\" width=100%>";
$butc2="</td><td align=\"center\">
<a class=\"next\">&nbsp;</a><br><br><br>
</td></tr>
</table>";
$butscr="btnNext: \".next\",
btnPrev: \".prev\",";}
$carc="<style>
#jCarouselLiteDemo .carousel .jCarouselLite {
position: relative;
visibility: hidden;
left: -5000px;
height: $carh"."px;
margin: 0;
padding: 0;
}
#jCarouselLiteDemo .carousel li{
width: $carw"."px;
margin: 5px 5px 5px 5px;
padding: 0;
}
</style>
<script type=\"text/javascript\">
$(document).ready(function(){

$(\".mouseWheel .jCarouselLite\").jCarouselLite({
mouseWheel: false,
$butscr
visible: 1,
scroll: 1,
auto: $cara,
speed: $carspeed
});

});

</script>


<center>
<div id=\"jCarouselLiteDemo\" style=\"width:98%\">
<div class=\"carousel mouseWheel\" style=\"width:100%\">
$butc1
<div class=\"jCarouselLite\" style=\"width:100%\">
    <ul>
".$carc."</ul>
  </div>
$butc2
</div>
</div>
</center>";
}
}

$catid_content=str_replace("[speed]".$carspeed."[/speed]","",str_replace("[auto]".$cara."[/auto]","",str_replace("[buttons]".$carb."[/buttons]","",str_replace("[carousel]","$carc",str_replace("[carw]".$carw."[/carw]","",str_replace("[carh]".$carh."[/carh]","",$catid_content))))));


if (($valid=="1")&&($details[7]=="ADMIN")): $catid_content="<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">z_$catid</span> <a class=\"btn\" href=#edit onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/z_".@$desc_file.".txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=btn href=\"index.php?page=z_$catid\">".$lang[1550]."</a>&nbsp;<a class=\"btn\" href=#del onClick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=z_".@$desc_file."&del=z_".@$desc_file."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>".$catid_content; endif;

$catid_content=str_replace("==$catid_title==", "" , $catid_content);

} else {
if ($desc_file!="0000") {
if (($valid=="1")&&($details[7]=="ADMIN")){
$catid_title="$catid"; $catid_content="<div style=\"width:auto;\" align=center><a href=\"#indexator\" class=\"btn pull-left ml\" onClick=\"javascript:window.open('$htpath/admin/".$scriptprefix."indexator.php?speek=".$speek."','fr2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" style=\"font-size: 10px;\">".$lang['adm1']."</a><a href=\"#new_description\" class=\"btn pull-left ml\" onClick=\"javascript:window.open('$htpath/admin/editor/edit.php?speek=$speek&create_file=z_".@$desc_file."','fr2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\" style=\"font-size: 10px;\">".$lang[878]."</a><a href=\"#additional_cols\" class=\"btn pull-left ml\" onClick=\"javascript:document.location.href='$htpath/index.php?action=template&nt=templates/$template/$speek&t=cc_".@$desc_file."';\" style=\"font-size: 10px;\">".$lang[1532]."</a><div class=clearfix></div></div>";
}
}
}
unset ($pageopen, $output);
//end


require "./modules/x0007.php";
if($usetheme==0) {
if ("$catid_content"."$x0007"!="") { $catid_content=$catid_content."$x0007"; }
}


?>
