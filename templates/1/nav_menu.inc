<?php
$active="";
if (!isset($lang[1008])) {$lang[1008]="";}
###### TOP NAVIGATE MENU (maybe for banners) #######
$rmon = array ($lang[115],$lang[116],$lang[117],$lang[118],$lang[119],$lang[120],$lang[121],$lang[122],$lang[123],$lang[124],$lang[125],$lang[126]);
$ts=time();
$currentdate="<div id=\"clock\" style=\"white-space: nowrap;  margin-left:10px; margin-top: 10px; font-size: 80%;\"><span>". date("d",$ts)." ".$rmon[date("m",$ts)-1]." ".date("Y",$ts)."</span><span id=\"clock_h\" class=hidden>". date("H",$ts)."</span><span class=hidden>:</span><span id=\"clock_m\" class=hidden>".date("i",$ts)."</span>";
if (($valid=="1")&&($details[7]!="")) {
$currentdate.="<a id=message_box href=\"$htpath/message.php?session=$sid\"></a>";
}
$currentdate.="<input type=hidden id=viewmessage value=\"\"></div><script language=javascript><!--

var timerId;
";
if (($valid=="1")&&($details[7]!="")) {
$currentdate.="function showmessage() {


";

if ($portal==1) {
$currentdate.="

\$.ajax({
  type: \"POST\",
  url: \"chat.php\",
  data: \"ch=main&speek=rus&privat=".$details[1]."&read=2&session=$sid\",
  success: function(msg){
    $(document).ready(function() {
    document.getElementById('onlinewindow').innerHTML=msg;
        });


  }
});

";
}
$currentdate.="var viewmes = document.getElementById('viewmessage').value;

\$.ajax({
  type: \"POST\",
  url: \"message.php\",
  data: \"read=1&session=$sid&session=$sid\",
  success: function(msg){
    if ((msg!=viewmes)&&(msg!='')) {
    document.getElementById('viewmessage').value=msg;

         \$(\"#message_box\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'transitionIn'	:	'none',
        'width'         : 680,
        'height'        : 550,
        'transitionOut'	:	'none',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false
 }).trigger('click');


    }

  }
});
}

";
}

$currentdate.="
function update() {
  var date = new Date();
  var seconds = date.getSeconds();
  ";
if (($valid=="1")&&($details[7]!="")) {
$currentdate.="  if ((seconds ==".rand(1, 30).")||(seconds ==".rand(31, 50).")) { showmessage(); }";
}
$currentdate.="
}





function clockStart() {
  if (timerId) return;
  timerId=self.setInterval(function(){update()},500);
}

function clockStop() {
  clearInterval(timerId);
  timerId = null;
}

clockStart(); ";
if (($valid=="1")&&($details[7]!="")) {
$currentdate.="
$(document).ready(function() { showmessage(); })
";
}
$currentdate.="
--></script>";
$lev0="";$rlev="";


//TWITTER BOOTSTAP
$strback=" background=\"grad.php?h=30&w=1&e=".str_replace("#","",lighter($nc6,-10))."&s=".str_replace("#","",$nc6)."&d=vertical\"";

if ($r!="") {$nccol=$nc3; $lev0=2; $rlev="<li><a href=\"$htpath/index.php?catid=" .@$podstava["$r||"]. "\"><b><font color=\"$nc0\">".str_replace(" ", " ", $r)."</font></b></a></li>";
} else {$nccol=$nc4;}
 if (($view_buybut==0)||($view_goodsprice==0)) {$topmenu="<table width=\"".$style['right_width']."\" border=0><tr><td><img src=\"$image_path/pix.gif\" border=0 height=1 width=\"".$style['right_width']."\"></td></tr></table>";} else {
if ($header_type<2) {
if ($action=="basket") { $active=" class=active"; }
if ($action=="clear") { $active=" class=active"; }
$topmenu="<li class=divider-vertical></li><li$active>$korz</li>";
} else {
$topmenu="";
}
$active="";
if ($smod=="shop") {
if ("$valid"=="1") {
if ($details[1]!="") {
if ($user_wallet_enable==1) {

if ($action=="cabinet") { $active=" class=active"; }
$topmenu.="<li class=divider-vertical></li><li$active><a href=\"index.php?action=cabinet&sub=transaction\" title=\"$lang[1122]\"><small>$lang[1121]: <b>".get_walet_total(md5($details[1]).md5(strrev($details[1])))."</b> $init_currency</small></a></li>";
$active="";
}
}
}
}
$active="";
if ($action=="zakaz") { $active=" class=active"; }
if ($action=="send") { $active=" class=active"; }
if ($tovarov>0) {
$topmenu.="<li class=divider-vertical></li><li$active><a href=\"index.php?action=zakaz&flag=".$cart->basket_speek."\"><i class=icon-ok></i> ".$lang[59]."</a></li>";}
}
$active="";
$navmenu = "<li>$currentdate</li><li class=divider-vertical></li>";
$navmenup="";
$proce=0;
if ($view_blog==1) {$proce+=1; }
if ($view_classifieds==1) {$proce+=1; }
$proce+=1;
if ($view_forum==1) {$proce+=1; }
if ($chat_enable==1) {$proce+=1; }
if ($smod=="shop") {
if ($view_price==1) {$proce+=1; }
}
if ($view_gallery==1) {$proce+=1; }
if ($view_archive==1) {$proce+=1; }

if ($view_partner==1){$proce+=1; }
if ($view_vacancy==1) {$proce+=1; }
if ($rss_button==1) {$proce+=1; }
if ($cat_button==1) {$proce+=1; }

$procewidth=floor(100/$proce);
if ($view_navbut==1) {
if ($view_blog==1) {
if ($action=="blog") { $active=" class=active"; }

$navmenup.="<li$active><a href=\"index.php?action=blog\">".str_replace(" ","&nbsp;", $lang[908])."</a></li>";
$active="";
}
if ($view_classifieds==1) {
$navmenup.="<li><a href=\"index.php?action=cl\">".str_replace(" ","&nbsp;", $lang[941])."</a></li>";
}
if ($action=="sendmail") { $active=" class=active"; }
if ($action=="sendok") { $active=" class=active"; }

$navmenup.= "<li$active><a href=\"index.php?action=sendmail\">".str_replace(" ","&nbsp;", $lang[54])."</a></li>";
$active="";

if ($view_forum==1) {
if ($action=="forum") { $active=" class=active"; }

$navmenup.= "<li$active><a href=\"index.php?action=forum\">".str_replace(" ","&nbsp;", $lang[9])."</a></li>";
$active="";
}
if ($chat_enable==1) {$navmenup.= "<li><a href=\"#chat\" onClick=\"javascript:window.open('chat.php?speek=$speek','chatw','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10')\">".str_replace(" ","&nbsp;", $lang[1011])."</a></li>";}

if ($smod=="shop") {
if ($action=="price") { $active=" class=active"; }
if ($view_price==1) {$navmenup.= "<li$active><a href=\"index.php?action=price\">".str_replace(" ","&nbsp;", $lang[47])."</a></li>";}
$active="";
}
if ($view_gallery==1) {
if ($action=="gal") { $active=" class=active"; }

$navmenup.= "<li$active><a href=\"index.php?action=gal\">".str_replace(" ","&nbsp;", $lang[738])."</a></li>";
$active="";
}
if ($view_archive==1) {
if ($action=="arch") { $active=" class=active"; }

$navmenup.= "<li$active><a href=\"index.php?action=arch\">".str_replace(" ","&nbsp;", $lang[985])."</a></li>";
$active="";
}

if ($view_partner==1) {
if ($action=="reg_partner") { $active=" class=active"; }

$navmenup.= "<li$active><a href=\"$htpath/index.php?speek=$speek&action=reg_partner\">".str_replace(" ","&nbsp;", $lang[627])."</a></li>";
$active="";
}
 if ($view_vacancy==1) {
 if ($action=="vacancy") { $active=" class=active"; }

 $navmenup.= "<li$active><a href=\"$htpath/index.php?speek=$speek&action=vacancy\">".str_replace(" ","&nbsp;", $lang[1021])."</a></li>";
 $active="";
 }
if ($smod=="shop") {
if ($rss_button==1) {$navmenup.= "<li><a href=\"$htpath/rss/index.php\">RSS</a></li>";}
if ($show_sales_table==1) { if ($action=="insales") { $active=" class=active"; }  $navmenup.= "<li$active><a href=\"$htpath/index.php?speek=$speek&action=insales\"><span class=\"label label-important\">".$lang[1640]."!</span></a></li>"; $active="";}
}
if ($cat_button==1) {
if ($action=="cat") { $active=" class=active"; }

$navmenup.= "<li$active><a href=\"$htpath/index.php?action=cat\">$lang[1105]</a></li>";
$active="";
}
$active="";
if ($smod=="site") {
if ("$valid"=="1") {
if ($details[1]!="") {
if ($user_wallet_enable==1) {

if ($action=="cabinet") { $active=" class=active"; }
$navmenup.="<li class=divider-vertical></li><li$active><a href=\"index.php?action=cabinet&sub=transaction\" title=\"$lang[1122]\"><small>$lang[1121]: <b>".get_walet_total(md5($details[1]).md5(strrev($details[1])))."</b> $init_currency</small></a></li>";
$active="";
}
}
}
}
 }
if ($view_catbut==1) {
if ($replace_navbut==1) {
$navmenup=$catbut;
}
}

$navmenu.= "$navmenup";




if (($header_type==2)||($header_type==3)) { if ($lngv!="") { $navmenu.= "<li class=divider-vertical></li><li style=\"margin-top: 4px;\">".$lngv."</li>"; }}





if  ($allow_search==1) {
if (($header_type>=2)&&($usetheme==0)) {
 if ($query=="") { $lquery=""; } else { $lquery=$query; }
 $searchmenu="<form class=\"navbar-search\" method=\"get\" id=\"header_searcH_form\" name=\"header_searcH_form\" action=\"$htpath/index.php\"><script type=\"text/javascript\"><!--
function setWidth () {
document.getElementById('search_tips_cont').style.width=(0+document.getElementById('search_input').clientWidth*4)+'px';
document.getElementById('search_tips').style.width=(0+document.getElementById('search_input').clientWidth*4+3)+'px';
}
function submit_search1(e)
{
    if (e.keyCode == 13)
    {
        document.location.href=\"index.php?query=\"+document.getElementById('search_input').value+\"&usl=\"+document.getElementById('search_usl').value;
        return false;
    }
}
-->
</script>
<input class=\"ml\" value=\"".$lquery."\" name=\"query\" id=\"search_input\" onkeyup=\"submit_search1(event); get_search_tips(this, '".$speek."');setWidth();\" onfocus=\"setWidth();\" onblur=\"setWidth();\" onchange=\"setWidth();\" type=\"search\" autocomplete=\"off\" placeholder=\"".$lang['search']."...\" style=\"margin-right: 10px;\">
<input type=hidden id=search_usl value=AND><input type=hidden name=usl value=$usl>
<div id=\"search_tips\" class=\"search_tips\" style=\"display: none; margin-top:0px; right: 0px;\" onmouseout=\"hide_search_tips();setWidth();\" onmouseover=\"show_search_tips();setWidth();\">
<div style=\"height: 138px; padding: 3px 3px 10px 3px; overflow: auto;\" id=\"search_tips_cont\"></div>
</div></form>";

} else {
$searchmenu="<form method=\"get\" id=\"header_searcH_form\" name=\"header_searcH_form\" action=\"$htpath/index.php\"><table border=0 cellpadding=0 cellspacing=0 width=100%><tr>";
if ($usetheme==0) {$searchmenu.="<td><img src=$image_path/pix.gif height=1 width=1></td>";}
$searchmenu.="<td style=\"vertical-align: middle\" align=right>$searchin";
if (($poisk_inlist==1)&&($smod=="shop")) {
$searchmenu.="<br><img src=\"$image_path/pix.gif\" width=\"100\" height=1 border=0>";
}
if ((!isset($lang[988]))||($lang[988]=="")) {$lang[988]="OR";}
if ((!isset($lang[989]))||($lang[989]=="")) {$lang[989]="AND";}
if ($query=="") { $lquery=""; } else { $lquery=$query; }
$searchmenu.="</td><td style=\"vertical-align: middle\"><form class=\"navbar-search\" method=\"get\" id=\"header_searcH_form\" name=\"header_searcH_form\" action=\"$htpath/index.php\"><script type=\"text/javascript\"><!--
function setWidth () {
document.getElementById('search_tips_cont').style.width=(0+document.getElementById('search_input').clientWidth*4)+'px';
document.getElementById('search_tips').style.width=(0+document.getElementById('search_input').clientWidth*4+3)+'px';
}
function submit_search1(e)
{
    if (e.keyCode == 13)
    {
        document.location.href=\"index.php?query=\"+document.getElementById('search_input').value+\"&usl=\"+document.getElementById('search_usl').value;
        return false;
    }
}
-->
</script>
<input class=\"ml\" value=\"".$lquery."\" name=\"query\" id=\"search_input\" onkeyup=\"submit_search1(event); get_search_tips(this, '".$speek."');setWidth();\" onfocus=\"setWidth();\" onblur=\"setWidth();\" onchange=\"setWidth();\" type=\"search\" autocomplete=\"off\" placeholder=\"".$lang['search']."...\" style=\"margin-right: 10px;\">
";
if ($advanced_search==1) {
$searchmenu.="</td><td><input type=hidden id=search_usl value=AND><input type=radio name=usl value=OR onclick=\"document.getElementById('search_usl').value=='OR';\"></td><td><font class=small>$lang[988]</font></td><td><input type=radio name=usl checked value=AND onclick=\"document.getElementById('search_usl').value=='OR';\"></td><td><font class=small>$lang[989]</font>
<div id=\"search_tips\" class=\"search_tips\" style=\"display: none; margin-top:0px; right: 0px;\" onmouseout=\"hide_search_tips();setWidth();\" onmouseover=\"show_search_tips();setWidth();\">
<div style=\"height: 138px; padding: 3px 3px 10px 3px; overflow: auto;\" id=\"search_tips_cont\"></div>
</div></form></td></tr></table></form>";
 } else {
$searchmenu.="<input type=hidden id=search_usl value=AND><input type=hidden name=usl value=$usl>
<div id=\"search_tips\" class=\"search_tips\" style=\"display: none; margin-top:0px; right: 0px;\" onmouseout=\"hide_search_tips();setWidth();\" onmouseover=\"show_search_tips();setWidth();\">
<div style=\"height: 138px; padding: 3px 3px 10px 3px; overflow: auto;\" id=\"search_tips_cont\"></div>
</div></form></td></tr></table>";
}
}
}else {
$searchmenu="";
}


$usermenu1="
<table bgcolor=\"".$style["nav_col3"]."\" align=center width=\"100%\" bgcolor=\"".$style["nav_col3"]."\" border=0 cellspacing=0 cellpadding=3>
<tr>
<td align=center background=\"grad.php?h=28&w=1&e=".str_replace("#","",lighter($nc4,-40))."&s=".str_replace("#","",$nc4)."&d=vertical\"><font color=\"$nc0\">
<b>".$lang['welc']."!</b> ".$lang[49]." <b><a href=\"index.php?register=1\"><font color=\"$nc0\">".$lang[50]."</font></a></b> ".$lang[52].".
</font></td>
</tr>
</table>";

$usermenu2="<table width=\"100%\" bgcolor=\"".$style["nav_col3"]."\" align=\"center\" border=0 cellspacing=0 cellpadding=3>
<tr>
<td align=center background=\"grad.php?h=28&w=1&e=".str_replace("#","",lighter($nc4,-40))."&s=".str_replace("#","",$nc4)."&d=vertical\"><font color=\"$nc0\">
".$lang['welc']." <b>". @$details[3]. "</b>! ".$lang['thnk']." ".$lang['yourstat']." \"<b>". @$details[7]. "</b>\"</font></td></tr></table>";
?>
