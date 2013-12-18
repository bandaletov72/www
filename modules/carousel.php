<?php

$carousel="";
$carfolder="";
if (("$catid"!="")||("$page"!="")) {

if ("$unifid"!="") { }else {
if ("$page"!="") { $carfolder="carousel/$page";  } else {

if (("$catid"!="")&&($mod!="admin")) {$carfolder="carousel/$catid"; } }
if ($carfolder!="") {
if (is_dir("./gallery/".$carfolder)) {
$lgt="<div class=\"pull-left mr logotype\">$logotype</div>";
if ($carousel_logo==0) {$lgt="";}
//carousel
$handle=opendir("./gallery/".$carfolder."/");
$fcf=0;
$carf=Array();
while (($fg = readdir($handle))!==FALSE) {
$mtyp=toLower(substr($fg,-3));
if ((substr($fg,0,3 )!="tn_")&&($fg!="icon.png")) {
if (($mtyp == 'png')||($mtyp == 'gif')||($mtyp == 'jpg')) {
unset($tln);
$tln=@file("./gallery/".$carfolder."/".$fg.".idx");
$link=trim($tln[0]);
$tith1=trim($tln[1]);
$lead=trim($tln[2]);
$button=trim($tln[3]);
$link1="";
$link2="";
if ($link!="") {  if ( $button!="") { $button="<a class=\"btn btn-large btn-primary\" href=\"$link\">".$button."</a>"; } else { $link1="<a href=\"$link\">";  $link2="</a>";  } }
if ($tith1!="") { $tith1="<h1>$tith1</h1>"; }
if ($lead!="") { $lead="<p class=\"lead\">$lead</p>"; }

$carf[$fcf]="<!-- $fg -->$link1<img class=innerimg src=\"images/pix.gif\" alt=\"\" style=\"background:url('gallery/".$carfolder."/".$fg."');\">$link2
<div class=\"container\">$lgt
<div class=\"carousel-caption text-centered\">
$tith1"."$lead"."$button"."</div>
</div>";


$fcf++;
}
}
}
closedir($handle);

if (count($carf)>0) {
$carousel="<div id=\"myCarousel\" class=\"carousel slide\">
<div class=\"carousel-inner\">";
sort($carf);
reset ($carf);
$active="active ";
while(list($k,$v)=each($carf)) {
$carousel.="<div class=\"".$active."item\">$v</div>\n";
$active="";

}

$carousel.="</div>
<a class=\"left carousel-control\" href=\"#myCarousel\" data-slide=\"prev\">‹</a>
<a class=\"right carousel-control\" href=\"#myCarousel\" data-slide=\"next\">›</a>
</div>";
    unset($carf, $v, $fg, $k, $tln);
}

if ($valid=="1") { if (($details[7]=="ADMIN")||($details[7]=="ADMIN")) { $carousel="<div class=dotted style=\"width:100%;\"><a class=btn style=\"margin-bottom:10px; margin-top:20px;\" href=\"index.php?action=gal&isort=&i=%2F".str_replace("/","%2F",$carfolder)."\">CAROUSEL: $lang[1552] </a></div>$carousel";} }

} else {
if ($valid=="1") { if (($details[7]=="ADMIN")||($details[7]=="ADMIN")) { $carousel="<div class=dotted style=\"width:100%;\"><a class=btn style=\"margin-bottom:10px; margin-top:20px;\" href=\"index.php?action=gal&isort=&i=%2F".str_replace("/","%2F",$carfolder)."\">CAROUSEL: $lang[816] </a></div>$carousel";} }
}
}
}
}

?>
