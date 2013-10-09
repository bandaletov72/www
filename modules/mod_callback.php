<?php
$expos=0;
if ($valid=="1") { if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
if (file_exists("./templates/$template/".$scriptprefix."admin.inc")) {
require ("./templates/$template/".$scriptprefix."admin.inc");
$widget= "<div class=\"dropdown\"><a href=\"#\" class=shadow data-toggle=\"dropdown\" style=\"background-color: $nc4; position: fixed; top: ".(43+$expos*40)."px; right: -12px; margin-top:0px; width: 40px; height:37px; z-index:".(5000-$expos)."; padding: 0px 0px 0px 6px;\" title=\"$lang[60]\" onmouseover=\"javascript:this.style.width='58px';\" onmouseout=\"javascript:this.style.width='40px';\" id=tipadm><font size=1 color=$nc0><br><span class=nowrap>ADM&nbsp;<i class=\"icon-chevron-down icon-white\"></i></span></font></a><ul id=admmenu style=\"height:490px; width:400px; padding: 10px 10px 10px 10px; overflow:auto; position: fixed; top: 80px; right: -1px; text-align:left; align:left;\" class=\"dropdown-menu pull-right\" role=\"menu\" aria-labelledby=\"dLabel\">";
if ("$catid"=="0") {$scatid=""; }else {$scatid="$catid";}
if ($interface==0) {
$widget.= "<div width=100% align=left>
<a href=\"$htpath/index.php?action=interface_on&start=$start&page=$page&catid=$scatid&item_id=$item_id&unifid=$unifid&query=".rawurlencode($query)."&brand=".rawurlencode($brand)."\" title=\"".$lang[968]."\" class=btn><i class=\"icon-eye-open\"></i><small>".$lang[968]."</small></a><div class=clear></div><br><br>
</div>
";
} else {
$widget.= "<div width=100% align=left>
<a href=\"$htpath/index.php?action=interface_off&start=$start&page=$page&catid=$scatid&item_id=$item_id&unifid=$unifid&query=".rawurlencode($query)."&brand=".rawurlencode($brand)."\" title=\"".$lang[969]."\" class=btn><i class=\"icon-eye-close\"></i><small>".$lang[969]."</small></a><div class=clear></div><br><br>
</div>
";
}
$widget.= "$admin_url</ul></div>";
if ($usetheme==1) {
$themecontent=str_replace("[widgets]", "$widget"."[widgets]",$themecontent);
} else {

echo $widget;
}


$expos+=1;
}
}
}

$_SESSION["callme"]=md5(date("d m y",time()));
$callbackform="<a id=\"tip5\" title=\"$lang[1153]\" href=\"#login_form\"><font color=$nc5><b>".$lang[1153]."</b><br><font size=1>".$lang[1150]."</font></font></a>";
$callbackdiv="<div style=\"display:none\">
	<div style=\"width:450px; height:200px;\"><form id=\"login_form\" method=\"post\" action=\"\">
	    	<p id=\"login_error\"><b>$lang[1157]</b></p>
		<table width=100% border=0 cellpadding=5><tr>
			<td style=\"white-space:nowrap;\"><label for=\"name\">$lang[1155]: </label></td>
			<td width=100%><input type=\"text\" id=\"name\" name=\"name\" size=\"30\" value=\"".$details[3]."\" class=input-xxlarge></td>
		</tr>
		<tr>
			<td style=\"white-space:nowrap;\"><label for=\"tel\">$lang[1154]: </label></td>
			<td width=100%><input type=\"text\" id=\"tel\" name=\"tel\" size=\"30\" value=\"".$details[5]."\" class=input-xxlarge></td>
		</tr>
		<tr>
			<td colspan=2 align=center><input type=\"submit\" class=\"btn btn-primary\" value=\"$lang[1153]\" /></td>
		</tr>
        </table>
		<p>
		    <em><small>$lang[1156]</small></em>
		</p>
	</form></div>
</div>
<script language=javascript>
\$(document).ready(function() {
\$(\"#tip5\").fancybox({
'onComplete' : function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false,
	'onClosed'		: function() {
	    $(\"#login_error\").hide();
	}
});
\$(\"#tip6\").fancybox({
'onComplete' : function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'		: 'no',
        'padding' : 50,
	'titleShow'		: false,
    'overlayShow'	:	false,
	'onClosed'		: function() {
	    $(\"#login_error\").hide();
	}
});
$(\"#login_form\").bind(\"submit\", function() {

	if ($(\"#name\").val().length < 1 || $(\"#tel\").val().length < 1) {
	    $(\"#login_error\").show();
	    $.fancybox.resize();
	    return false;
	}

	$.fancybox.showActivity();

	$.ajax({
		type		: \"POST\",
		cache	: false,
		url		: \"/callme.php\",
		data		: $(this).serializeArray(),
		success: function(data) {
			$.fancybox(data);
		}
	});

	return false;
});
});
</script>";
$cbdiv="";
$skypediv="";
$addiv="";
$admmes="";
if ($callback_enable==1) {
if (preg_match("/Mozilla\/3\.0/i",$_SERVER['HTTP_USER_AGENT'])) {
$cbdiv="<a id=\"tip5\" title=\"$lang[1153]\" href=\"#login_form\"><img src=$image_path/phone2.png border=0 title=\"".$lang[1153]."\" hspace=5></a>$callbackdiv";
if ($skypename!="") {
$skypediv="<script type=\"text/javascript\" src=\"http://download.skype.com/share/skypebuttons/js/skypeCheck.js\"></script>
<a href=\"skype:".$skypename."?call\"><img src=\"http://mystatus.skype.com/mediumicon/".$skypename."?rnd=".time()."\" style=\"border: none;\" width=\"26\" height=\"26\" hspace=5 alt=\"Status\" /></a>";
}
if ($adminname!="") {
if (file_exists("./admin/userstat/$adminname.txt")){
$tmp1=Array();
$tmp1=file("./admin/userstat/$adminname.txt");

$tmp=explode("|",$tmp1[0]);
$adminrealname=$tmp[3];
$adminrealtel="(".$tmp[19].")".$tmp[5];
$adminrealava="";
$adminrealstatus="offline";
$admmes=$lang[1488];
$admcol="red";
if (file_exists("./admin/userstat/$adminname/$adminname.ava")){ $tmp1=file("./admin/userstat/$adminname/$adminname.ava"); $adminrealava="$htpath/gallery/avatars/".$tmp1[0];}
if (file_exists("./admin/userstat/$adminname/lastvisit.time")){ $tmp1=file("./admin/userstat/$adminname/lastvisit.time"); if (time()<=($min_update*60+doubleval(trim($tmp1[0])))) {$adminrealstatus="online"; $admmes=$lang[1487]; $admcol="green"; }}
if ($adminrealstatus=="online") {$abut="<span class=shadow style=\"border: none; width: 26px; height: 26px; -webkit-border-radius: 13px; border-radius: 13px; padding:4px;\"><i class=icon-ok title=\"Online\"></i></span>";} else { $abut="<span class=shadow style=\"border: none; width: 26px; height: 26px; -webkit-border-radius: 13px; border-radius: 13px; padding:4px;\"><i class=icon-remove title=\"Offline\"></i></span>";}

unset($tmp1,$tmp);
$addiv="<a href=\"chat.php?ch=main&privat=".$adminname."&speek=$speek\">$abut</a>";
$expos++;
}
}
} else {

$cbdiv="<div class=shadow align=left style=\"background-image: url('grad.php?h=40&w=1&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc6)."&d=vertical'); position: fixed; width: 54px; height: 40px; overflow:hidden; top: ".(40+$expos*40)."px; right: -20px; z-index:".(1000-$expos)."; padding: 0px; cursor: pointer; cursor: hand;\" href=\"#login_form\" onmouseover=\"javascript:this.style.width='400px';\" onmouseout=\"javascript:this.style.width='54px';\" id=tip6><table border=0 cellspacing=5 cellpadding=5 height=40 width=300><tr><td width=26><img class=shadow src=$image_path/phone2.png border=0 style=\"border: none; width: 26px; height: 26px; -webkit-border-radius: 13px; border-radius: 13px;\" title=\"$lang[1150]\"><td><td style=\"white-space:nowrap;\">$callbackform$callbackdiv</td></tr></table></div>";
$expos+=1;
if ($skypename!="") {

$skypediv="<script type=\"text/javascript\" src=\"http://download.skype.com/share/skypebuttons/js/skypeCheck.js\"></script>
<div class=shadow align=left style=\"background-image: url('grad.php?h=40&w=1&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc6)."&d=vertical'); position: fixed; width: 54px; height: 40px; overflow:hidden; top: ".(40+$expos*40)."px; right: -20px; z-index:".(1000-$expos)."; padding: 0px; cursor: pointer; cursor: hand;\" onmouseover=\"javascript:this.style.width='400px';\" onmouseout=\"javascript:this.style.width='54px';\" onclick=\"location.href='skype:".$skypename."?call';\"><table border=0 cellspacing=5 cellpadding=5 height=40 width=300><tr><td width=26><a href=\"skype:".$skypename."?call\"><img class=shadow src=\"http://mystatus.skype.com/mediumicon/".$skypename."?rnd=".time()."\" style=\"border: none; width: 26px; height: 26px; -webkit-border-radius: 13px; border-radius: 13px;\" width=\"26\" height=\"26\" alt=\"Status\" /></a><td><td style=\"white-space:nowrap;\"><b>$skypename</b><br><font size=1>$lang[1486]</font></td></tr></table></div>";
$expos+=1;
}
if ($adminname!="") {
if (file_exists("./admin/userstat/$adminname.txt")){
$tmp1=Array();
$tmp1=file("./admin/userstat/$adminname.txt");
$tmp=explode("|",$tmp1[0]);
$adminrealname=$tmp[3];
$adminrealtel="(".$tmp[19].")".$tmp[5];
$adminrealava="";
$adminrealstatus="offline";
$admmes=$lang[1488];
$admcol="red";
if (file_exists("./admin/userstat/$adminname/$adminname.ava")){ $tmp1=file("./admin/userstat/$adminname/$adminname.ava"); $adminrealava="$htpath/gallery/avatars/".$tmp1[0];}
if (file_exists("./admin/userstat/$adminname/lastvisit.time")){ $tmp1=file("./admin/userstat/$adminname/lastvisit.time"); if (time()<=($min_update*60+doubleval(trim($tmp1[0])))) {$adminrealstatus="online";$admmes=$lang[1487]; $admcol="green"; }}

unset($tmp1,$tmp);
if ($adminrealstatus=="online") {$abut="<span class=shadow style=\"border: none; width: 26px; height: 26px; -webkit-border-radius: 13px; border-radius: 13px; padding:4px;\"><i class=icon-ok title=\"Online\"></i></span>";} else { $abut="<span class=shadow style=\"border: none; width: 26px; height: 26px; -webkit-border-radius: 13px; border-radius: 13px; padding:4px;\"><i class=icon-remove title=\"Offline\"></i></span>";}
if ($portal==0) {
if ($chat_enable==1) {
if ($adminrealava=="") {$admrava=""; } else { $admrava="<td width=32><img src=\"".$adminrealava."\" style=\"border: none;\" width=\"32\" height=\"32\" title=\"". " ".date("H:i d/m/Y", filemtime("./admin/userstat/$adminname/lastvisit.time"))."\" /></td>"; }
$addiv="<div class=shadow align=left style=\"background-image: url('grad.php?h=40&w=1&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc6)."&d=vertical'); position: fixed; width: 54px; height: 40px; overflow:hidden; top: ".(40+$expos*40)."px; right: -20px; z-index:".(1000-$expos)."; padding: 0px; cursor: pointer; cursor: hand;\" onmouseover=\"javascript:this.style.width='400px';\" onmouseout=\"javascript:this.style.width='54px';\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$adminname."&speek=$speek','chatw','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10');\"><table border=0 cellspacing=5 cellpadding=5 height=40 width=300><tr><td width=26>$abut</td>$admrava<td style=\"white-space:nowrap;\"><b>".$adminrealname."</b><br><font size=1>".$adminrealtel."</font> <font size=1 color=$admcol>$admmes</font></td></tr></table><input type=hidden id=sw1 value=\"\"></div>";
$expos++;
}
} else {
if ($chat_enable==1) {
if ($adminrealava=="") {$admrava=""; } else { $admrava="<td width=32><img src=\"".$adminrealava."\" style=\"border: none;\" width=\"32\" height=\"32\" alt=\"".$adminname."\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$adminname."&speek=$speek','chatw','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10');\"/></td>"; }
$addiv="<div class=shadow align=left style=\"background-image: url('grad.php?h=40&w=1&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc6)."&d=vertical'); background-repeat: repeat-x; background-color: $nc6; position: fixed; width: 54px; height: 40px; overflow:hidden; top: ".(40+$expos*40)."px; right: -20px; z-index:".(1000-$expos)."; padding: 0px; cursor: pointer; cursor: hand;\" onmouseover=\"javascript:this.style.width='400px';this.style.height='400px';\" onmouseout=\"javascript:this.style.width='54px';this.style.height='40px';\"><table border=0 cellspacing=5 cellpadding=5 height=40 width=300><tr><td width=26>$abut</td>$admrava<td style=\"white-space:nowrap;\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$adminname."&speek=$speek','chatw','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10');\"><b>".$adminrealname."</b><br><font size=1>".$adminrealtel."</font> <font size=1 color=$admcol>$admmes</font></td></tr></table><input type=hidden id=sw1 value=\"\"><table border=0 cellpadding=5 width=300><tr><td><small> <b>".str_replace("[min_update]",$min_update, $lang[1010])."</b><small></td></tr><tr><td>
<div id=onlinewindow style=\"width:320px; height:320px; overflow: auto;\"></div></td></table></div>";
$expos++;
}
}
}
}
}
if ($usetheme==0) {
if ($cbdiv!="") {
echo "</td><td>$cbdiv";
}
if ($skypediv!="") {
echo "</td><td>$skypediv";

}
if ($addiv!="") {
echo "</td><td>$addiv";

}
} else {
$themecontent=str_replace("[widgets]","$cbdiv$skypediv$addiv"."[widgets]",$themecontent);

}


}

?>
