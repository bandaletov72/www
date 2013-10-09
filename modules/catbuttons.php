<?php
$searchin="";
$oldnc10=$nc10;
$subcat=Array();
$qsubcat=Array();
unset($fcontentsa);
$fcontentsa=file("$base_loc/catid.txt");
$r="";
$sub="";
$ffcat=0;
$catbut="<table border=0 cellpadding=0 cellspacing=0><tr>";
$st=0; $foundcat=0;
$searchinlist="<input type=hidden name=\"catid\" value=\"\">";
$cob2=$nc9;
$searchin22="";

$searchin2=Array();
if ($nav_pos==0) {$nc7=$nc0;$nc8=$nc0;}
$fbk=0;
$podst=Array();
while (list ($line_num, $line) = each ($fcontentsa)) {
$out=explode("|",$line);
if ($out[5]=="") {$out[5]=999999;}
$indx=$out[0];
$podst[$indx]=$out[1]."|".$out[2]."|";
if ($out[1]!=$lang[418]) {
if ($out[2]!="") {
$inxcm=$out[1];
$inxcm2=$out[2];
$mysql_subdirs[$inxcm][$inxcm2]="<!-- $out[5] -->$out[5] ".strtoken($out[2],"(");
$searchin2[]="<!-- $out[0] --><option value=\"".$out[0]."\">".strtoken($out[2],"(")."</option>";
//ALL
if ($out[1]=="All") {
$inxcd=$out[1]." ". $out[2]." ";
$colordirs["$inxcd"]=$out[6];
//echo "\"$inxcd\"=$out[6]<br>";
$logodirs["$inxcd"]=$out[3];

if ($out[6]=="") {
$colb=$oldnc10;
if ("$catid"==$out[0]) {$colb=$nc10;}
} else {
$colb=$out[6];
if ("$catid"==$out[0]) {  $colb=$out[6]; $nc10=$out[6];}
}
//$ffcat-=20;
$searchin="<select name=\"catid\"";
if ($usetheme==0) {$searchin.="[searchstyle]";}
$searchin.=">";

$llgo="<img src=$image_path/pix.gif width=9 height=8 border=0 style=background-color:$colb;>";
if ($fbk<$max_bookmarks) {
if ($mod_rw_enable==0) {
$llink="<a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</b></font></a>";
} else {
$llink="<a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</b></font></a>";
}
} else {
if ($mod_rw_enable==0) {
$llink="<a href=\"$htpath/index.php?catid=".$out[0]."\" class=pull-left>$llgo&nbsp;".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</a>";
} else {
$llink="<a href=\"$htpath/".$out[0]."\" class=pull-left>$llgo&nbsp;".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</a>";
}

}

if ($unifid!="") {
if ($mod_rw_enable==0) {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." ".$out[2]." --><a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</b></font></a><!-- #2".$out[1]." ".$out[2]." -->", $colb, 20, $nc7)."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." ".$out[2]." --><a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</b></font></a><!-- #2".$out[1]." ".$out[2]." -->", $colb, 20,$nc0)."</td>";
} else {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." ".$out[2]." --><a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</b></font></a><!-- #2".$out[1]." ".$out[2]." -->", $colb, 20, $nc7)."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." ".$out[2]." --><a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</b></font></a><!-- #2".$out[1]." ".$out[2]." -->", $colb, 20,$nc0)."</td>";
}

} else {
if ("$catid"==$out[0]) {
//if ($out[3]!="") {$logotype=$out[3];}
$catbut1="<td valign=bottom>".navbut4("<span><img src=images/pix.gif width=1 height=$bheight align=absmiddle>$llink</span>", $colb, 20, $nc7)."</td>";
$catbut2="<td valign=top>".navbut3("<img src=\"$image_path/pix.gif\" width=2 height=8 border=0><br>$llink<br><img src=\"$image_path/pix.gif\" width=2 height=8 border=0>", $colb, 20, $nc0)."</td>";

} else {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." ".$out[2]." -->$llink<!-- #2".$out[1]." ".$out[2]." -->", $colb, 20, $nc7)."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." ".$out[2]." -->$llink<!-- #2".$out[1]." ".$out[2]." -->", $colb, 20,$nc0)."</td>";
}
}

if (@$style['dirs_l']==1) {if ($logodirs["$inxcd"]!="") {$llgo=$logodirs["$inxcd"];}}
if ($fbk>=$max_bookmarks) {
if ($mod_rw_enable==0) {
$overbut="<li><a tabindex=\"-1\" href=\"$htpath/index.php?catid=".$out[0]."\">".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</a></li>";
} else {
$overbut="<li><a tabindex=\"-1\" href=\"$htpath/".$out[0]."\">".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</a></li>";
}


} else { if($replace_navbut==1) {$catbut.=$catbut2; } else {$catbut.=$catbut1; } }
$fbk+=1;


$searchin2[]="<!-- $out[0] --><option value=0>__________________</option><option value=\"".$out[0]."\">".strtoken($out[2],"(").":</option><option value=0></option>";

} else {

//subcategories
$zindex=translit($out[1]);
$qsubcat[$zindex]=@$qsubcat[$zindex]+1;

if ($mod_rw_enable==0) {
$subcat[$zindex]=@$subcat[$zindex]."<li><a tabindex=\"-1\" href=\"$htpath/index.php?catid=".$out[0]."\">".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</a></li>";
} else {
$subcat[$zindex]=@$subcat[$zindex]."<li><a tabindex=\"-1\" href=\"$htpath/".$out[0]."\">".str_replace(" ", "&nbsp;", strtoken(strtoken($out[2],"/"),"("))."</a></li>";
}


}

//END ALL
}else{

$inxcd=$out[1];
$mysql_dirs[$inxcd]="<!-- $out[5] -->$out[5] ".strtoken($out[1],"(");
$colordirs["$inxcd"]=$out[6];
$logodirs["$inxcd"]=$out[3];
if ($out[1]!="All") {
if ($out[6]=="") {
$colb=$oldnc10;
if (substr($catid,0,strlen($out[0]))==$out[0]) {$colb=$nc10;}
} else {
$colb=$out[6];
if (substr($catid,0,strlen($out[0]))==$out[0]) {$colb=$out[6]; $nc10=$out[6];}
}
//$ffcat-=20;
$searchin="<select name=\"catid\"";
if ($usetheme==0) {$searchin.="[searchstyle]";}
$searchin.=">";
$llgo="<img src=$image_path/pix.gif width=9 height=8 border=0 style=background-color:$colb;>";
if ($fbk<$max_bookmarks) {
if ($mod_rw_enable==0) {
$llink="<a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a>";
} else {
$llink="<a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a>";
}
} else {
if ($mod_rw_enable==0) {
$llink="<a href=\"$htpath/index.php?catid=".$out[0]."\">$llgo&nbsp;".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</a>";
} else {
$llink="<a href=\"$htpath/".$out[0]."\">$llgo&nbsp;".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</a>";
}

}
if ($unifid!="") {
if ($use_top_submenu==0) {
if ($mod_rw_enable==0) {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." --><a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20, $nc7)."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." --><a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20,$nc0)."</td>";
} else {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." --><a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20, $nc7)."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." --><a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20,$nc0)."</td>";
}
} else {
if ($mod_rw_enable==0) {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." --><a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20, $nc7,false , "[".$out[0]."]")."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." --><a href=\"$htpath/index.php?catid=".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20,$nc0,false , "[".$out[0]."]")."</td>";
} else {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." --><a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20, $nc7,false , "[".$out[0]."]")."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." --><a href=\"$htpath/".$out[0]."\"><font color=\"$cob2\"><b>".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</b></font></a><!-- #2".$out[1]." -->", $colb, 20,$nc0,false , "[".$out[0]."]")."</td>";
}


}
} else {
if ("$catid"==$out[0]) {
//if ($out[3]!="") {$logotype=$out[3];}
if ($use_top_submenu==0) {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20, $nc7, false )."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20, $nc0, false )."</td>";
} else {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20, $nc7,false , "[".$out[0]."]")."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20,$nc0,false , "[".$out[0]."]")."</td>";
}
} else {
if ($use_top_submenu==0) {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20, $nc7)."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20,$nc0)."</td>";
} else {
$catbut1="<td valign=bottom>".navbut4("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20, $nc7,false , "[".$out[0]."]")."</td>";
$catbut2="<td valign=top>".navbut3("<!-- #1".$out[1]." -->$llink<!-- #2".$out[1]." -->", $colb, 20,$nc0,false , "[".$out[0]."]")."</td>";
}
}
}

if (@$style['dirs_l']==1) {if ($logodirs["$inxcd"]!="") {$llgo=$logodirs["$inxcd"];}}
if ($fbk>=$max_bookmarks) {
if ($mod_rw_enable==0) {
$overbut.="<li class=\"dropdown-submenu\"><a tabindex=\"-1\" href=\"#\">".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</a>[".$out[0]."]</li>";
} else {
$overbut.="<li class=\"dropdown-submenu\"><a tabindex=\"-1\" href=\"#\">".str_replace(" ", "&nbsp;", strtoken(strtoken($out[1],"/"),"("))."</a>[".$out[0]."]</li>";
}

} else
{ if($replace_navbut==1) {$catbut.=$catbut2; } else {$catbut.=$catbut1; } }
$fbk+=1;


$searchin2[]="<!-- $out[0] --><option value=0>__________________</option><option value=\"".$out[0]."\">".strtoken($out[1],"(").":</option><option value=0></option>";
} else {
$mysql_dirs[$inxcd]="<!-- $out[5] -->$out[5] ".strtoken($out[1],"(");
}
}




}
$iind=$out[1]."|".$out[2]."|";
$podstava[$iind]=$out[0];
$podstavas[$iind]=$out[4];
$podstavan[$iind]=$out[5];
$logodirsy[$iind]=$out[3];
if ($out[0]=="$catid"){ if (("$catid"!="0")&&($out[2]!="")) {$searchin.="<option selected value=\"".$catid."\">".strtoken($out[2],"(")."</option><option value=0>__________________</option>";}   if (("$catid"!="0")&&($out[2]=="")) {$searchin.="<option selected value=\"".$catid."\">".strtoken($out[1],"(")."</option><option value=0>__________________</option>";} $r=$out[1]; $sub=$out[2]; $foundcat=1; }

$st+=1;
}
sort($searchin2);
reset($searchin2);
while (list ($line_si, $linesi) = each ($searchin2)) {
$searchin22.= $linesi."\n";
}
$searchin.="<option value=\"\">".$lang[420]." ".str_replace("http://", "", str_replace("www.", "", str_replace($shopdir,"", $htpath)))."</option>";
$searchin.="$searchin22</select>";
if ($poisk_inlist==0) {$searchin=$searchinlist;}
if ($smod!="shop") {$searchin=$searchinlist;}
if ($foundcat==0) { if ($catid!="0") {
if (($action!="interface_off")&&($action!="interface_on")) {
if ($query=="") {
if ($action!="cat") {
$viewpage_title = $lang[1102]."/3";
header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
$error="<div style=\"margin:20px;\"><img src=$image_path/error404.png border=0 align=left hspace=10 title=\"ERROR 404\"><b>".$lang[1103]."</b><br><br>".$lang[1104]. " <b><a href=$htpath/index.php>". $shop_name."</a></b><META HTTP-EQUIV=\"REFRESH\" CONTENT=\"5;URL=$htpath/index.php\"><div class=clearfix></div></div>";
$catid="";
}
}
}
} else {
$catid=0;
}}
$podstava["||"]="_";

reset ($subcat);
while (list ($lk, $lv) = each ($subcat)) {
if ($use_top_submenu==1) {
$catbut=str_replace("[".$lk."]", $lv, $catbut);
$overbut=str_replace("[".$lk."]", "<ul class=\"dropdown-menu\" style=\"align:left;\" align=left>".$lv."</ul>", $overbut);
} else { 
$catbut=str_replace("[".$lk."]", "", $catbut);
$overbut=str_replace("[".$lk."]", "<ul class=\"dropdown-menu\" style=\"align:left;\" align=left>".$lv."</ul>", $overbut);

}
}
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["cookie"]="1";   $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();
require ("./templates/$template/view.inc");
if ($overbut!="") {
if($replace_navbut==1) {
$catbut.="<td valign=bottom>".navbut3("<a href=\"#more\"><font color=\"$cob2\"><b>".$lang[1546]."</b></font></a>", $colb, 20,$nc0,TRUE, $overbut,1)."</td>";
} else {
$catbut.="<td valign=bottom>".navbut4("<a href=\"#more\"><font color=\"$cob2\"><b>".$lang[1546]."</b></font></a>", $colb, 20,$nc0,TRUE, $overbut,1)."</td>";

 }
$overlibloaded=1;
}
$catbut.="</tr></table>";
if ($view_catbut==0) {$catbut=""; }
?>
