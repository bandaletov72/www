<?php
$callback="";
if ($view_basketalert==1) { $inbscript="inb_[znakdollar]mduni();"; }else {$inbscript="";}
$inminibasket="";
if ($view_bask==1) {$inminibasket="baskv();";}
$frfr="<div align=center><img src=$image_path/free.png border=0 align=absmiddle><small><font color=$nc2><b>".$lang[563]." ".$lang[166]."</b></font></small></div>";
//dont tuch if you unshure !!!
//this php code runs on view.php for viewing good strokes
$dtoday="";
if ($view_deliverytime==1) {
if ((date("H",time())<10)&&(date("D",time())!="Sun")&&(date("D",time())!="Sat")) {$dtoday=$lang[114]." ".$lang[779].". ";}
if (date("H",time())>10) {
if ((date("D",time())!="Sun")&&(date("D",time())!="Sat")&&(date("D",time())!="Fri")) {$dtoday.=$lang[765]." ".$lang[779].". ";} else {
$xx=1;
if (date("D",time())=="Sat") { $xx=2;}
if (date("D",time())=="Fri") { $xx=3;}
$dtoday.=$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[779].". ";
}
} else {
if ((date("D",time())!="Sun")&&(date("D",time())!="Sat")&&(date("D",time())!="Fri")) {$dtoday.=$lang[765]." ".$lang[779].". ";} else {
$xx=1;
if (date("D",time())=="Sat") { $xx=2;}
if (date("D",time())=="Fri") { $xx=3;}
$dtoday.=$lang[771]." ".date("d/m/Y",(time()+($xx*86400)))." ".$lang[779].". ";
}
}
$dtoday="<img src=$image_path/delivery.png align=left border=0><b>".$lang[770]."</b><br>$dtoday";
}


$langpcs="\$vitrin";
$xxx="x";
$descriptionss="\$description";
if (!isset ($varcart)) {$varcart=1;}
$buybut_url="javascript:document.spis\$s.submit()";
$optilist="\".str_replace(\"[id]\",\"\$s\",str_replace(\"[pr]\",\"\$price\",\$optionselect)).\"";
if (!isset($buy_button_action)) {$buy_button_action=0;} if (!preg_match("/^[0-9]+$/",$buy_button_action)) { $buy_button_action=0;}
if (!isset($view_list_dsk)) {$view_list_dsk=1;} if (!preg_match("/^[0-9]+$/",$view_list_dsk)) { $view_list_dsk=1;}
if ($view_list_dsk==0) {$descriptionss="";}
if (!isset($view_list_price)) {$view_list_price=1;} if (!preg_match("/^[0-9]+$/",$view_list_price)) { $view_list_price=1;}
if (!isset($view_list_qty)) {$view_list_qty=1;} if (!preg_match("/^[0-9]+$/",$view_list_qty)) { $view_list_qty=1;}
$valutss=$currencies_sign[$_SESSION["user_currency"]];
if (file_exists("./images/".$valut.".png")==TRUE) { $vsygn="<img align=absbottom src=$htpath/$image_path/".$_SESSION["user_currency"].".png>"; $valutss=""; } else {$vsygn=$currencies_sign[$_SESSION["user_currency"]]; $valutss="";}
$vipoldss="\$vipold";
if ($zero_price_incart==1) {
$pricess="</b>\";
if (\$price>0) {
\$sps[\$s].= \"<font size=3 style=\\\"white-space:nowrap;\\\"><b>$vsygn</b>$vipoldss&nbsp;<span id=\\\"span\$s\\\" class=\\\"\$spprice\\\">\".str_replace(\" \",\"&nbsp;\",str_replace(\".00\",\".-\", number_format((\$okr*round(\$price/\$okr)),2,\".\",\"\"))).\"</span>\";
} else {
\$sps[\$s].= \"<font size=3><span style=\\\"white-space: nowrap\\\"><b><span id=\\\"span\$s\\\" class=\\\"hidden\\\">\".str_replace(\" \",\"&nbsp;\",str_replace(\".00\",\".-\", number_format((\$okr*round(\$price/\$okr)),2,\".\",\"\"))).\"</span><span class=muted>".$lang['prebuy']."</span></b></span>\";
\$minsht=\"\";
\$valutss=\"\";
}
\$sps[\$s].= \"<b>";
} else {
$pricess="</b><font size=3 style=\\\"white-space:nowrap;\\\"><b>$vsygn</b>$vipoldss&nbsp;<span id=\\\"span\$s\\\" class=\\\"\$spprice\\\">\".str_replace(\" \",\"&nbsp;\",str_replace(\".00\",\".-\", number_format((\$okr*round(\$price/\$okr)),2,\".\",\"\"))).\"</span><b>";
}
if ($tax_function==1) {$pricess="<small><nobr><font color=$nc2>".$lang[781].": \".(\$okr*round(\$price/(1+(\$tax/100))/\$okr)).\" $vsygn</font></nobr><br><br><nobr>".$lang[782]." \$tax%:<br><font size=3><b>$vsygn</b></font>$vipoldss</nobr> </small><span id=\\\"span\$s\\\" class=\\\"\$spprice\\\">\".str_replace(\" \",\"&nbsp;\",str_replace(\".00\",\".-\", number_format((\$okr*round(\$price/\$okr)),2,\".\",\"\"))).\"</span>"; $vipoldss="";}
if ($view_buybut==0){ $qtyss=""; $langpcs="\"\""; $xxx=""; } else {

 if ($view_list_qty==1) { $qtyss="<div style=\\\"white-space:nowrap;\\\"><a class=btn onclick=\\\"javascript:if(document.getElementById('new_qty_\".\$s.\"').value>=\$minorder2){document.getElementById('new_qty_\".\$s.\"').value-=\$minorder;}\\\"><i class=icon-minus></i></a><input style=\\\"text-align: center;\\\" id=\\\"new_qty_\".\$s.\"\\\" name=\\\"qty\\\" type=\\\"text\\\" class=input-mini style=\\\"width:30px\\\" value=\\\"\$minorder\\\" size=3\$minorderblock><a class=btn onclick=\\\"javascript:document.getElementById('new_qty_\".\$s.\"').value-=-\$minorder;\\\"><i class=icon-plus></i></a></div>"; } else {$qtyss="<input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"\$minorder\\\" size=1>"; $langpcs="\"\""; $xxx="";}  }

if ($view_list_price==0) {$vipoldss=""; $pricess=""; $valutss="";}

if (!isset($view_options)) {$view_options=1;} if (!preg_match("/^[0-9]+$/",$view_options)) { $buy_button_action=1;}
if ($buy_button_action==1) {$buybut_url="\$htpath/index.php?unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\""; $view_options=0;}
if ($view_options!=1) {$optilist="";}
$spiss="";
if ($goiteminlist==1) {$spiss="#spis\$s";}
$vbt1=""; $vbt2="";
$buybutton=str_replace("[znakdollar]", "\$", str_replace("\"", "\\\"", str_replace("\$", "\\\$",  str_replace("'", "\'", str_replace("\\", "\\\\", buybutton("<a href=\"javascript:document.spis[znakdollar]s.submit()\"><b><font color=\"$nc0\">" .$lang['buy']. "</font></b></a>", $nc2,60,$nc0))))));
if ($view_buybut==0){$buybutton=""; }
if ($varcart==-1) {
$evstr="if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td class=itemdiv width=\".floor(100/\$cols_of_goods).\"% valign=top height=100%><table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">

	<tr>

		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top align=center><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=middle style=\\\"vertical-align: middle\\\" height=100% align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td></tr><tr><td valign=top width=100% align=center>\$llid\" . wordwrap(\$nazv, 20, \"<br>\") . \"</a><br>
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"\$prem1
<small><b><font size=4>$pricess</font></b>\$valutss\$prem2
\$vbt1\$vbt2
\$prbuy</small></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"</table></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}
if ($varcart==1) {
$evstr="if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td width=\".floor(100/\$cols_of_goods).\"% valign=top height=100%><table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">

	<tr>

		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top align=center><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=middle style=\\\"vertical-align: middle\\\" height=100% align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td></tr><tr><td valign=top width=100% align=center><b class=cat1>\$llid\" . wordwrap(\$nazv, 20, \"<br>\") . \"</a></b><br>
</small>
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"\$prem1
<small><b><font size=4>$pricess</font></b>\$valutss\$prem2
\$vbt1\$vbt2
\$prbuy</small></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"</table></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}
if ($varcart==0) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[5].\" ID:\".@\$out[8]);
if (@\$ext_id==0): \$mduni=\"NO\"; endif;
if (@\$ext_id==\"\"): \$mduni=\"NO\"; endif;
if (@\$out[14]==0): \$mduni=\"NO\"; endif;
if (@\$out[14]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" valign=top height=100%><table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">

	<tr>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top align=center\";
\$sps[\$s].= \"><table width=100% border=0 height=100% cellspacing=0 cellpadding=3><tr><td valign=top height=100% align=center><a name=\\\"spis\$s\\\"></a><a href=\\\"$htpath/index.php?catid=\" .@\$podstava[\"\$dir|\$subdir|\"] . \"\\\">\".\"\$foto1</a>
<br><b><a href=\\\"$htpath/index.php?catid=\" .@\$podstava[\"\$dir|\$subdir|\"] . \"\\\">\".\$out[4].\"</a></b>\$minmax<br><br></td></tr></table></td>\";

\$sps[\$s].= \"	</tr></table></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}

if ($varcart==16) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n
<td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table width=100% border=0 cellspacing=3 cellpadding=0><tr><td valign=top align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td><td valign=top width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate
<br><font color=\\\"\".lighter(\$nc6,-80).\"\\\"> <small>[".$lang[419].": \$ext_id]</small></font><br><small>\"; if (\$dir!=\"All\") { \$sps[\$s].=\"<b><a href=\\\"$htpath/index.php?catid=\" . @\$podstava[\"\$dir||\"] . \"\\\"><font color=\$nc3>\$dir</font></a></b> / \"; } \$sps[\$s].=\"<b><a href=\\\"$htpath/index.php?catid=\" .\$podstava[\"\$dir|\$subdir|\"] . \"\\\"><font color=\$nc3>\$subdir</font></a></b><br><b>".$lang['description'].":</b> $descriptionss<div align=center><br>\$ddescription</div><br>$optilist<br><font color=\\\"\".lighter(\$nc6,-80).\"\\\">[<a href=\\\"$htpath/index.php?catid=\" .\$podstava[\"\$dir|\$subdir|\"] . \"&brand=\".rawurlencode(@\$brand_name).\"\\\"><font color=\".lighter(\$nc6,-80).\" title=\\\"".$lang[422]." \$subdir \".@\$brand_name.\"\\\">\$subdir <b>\".@\$brand_name.\"</b></font></a>]</font>\$kupil \".@\$hear.\" \$freedelivery \$admin_functions</small>
</td>\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<td valign=top align=center bgcolor=\\\"".$nc6."\\\">
<img src=\\\"\".\$image_path.\"/pix.gif \\\" width=1 height=1 border=\\\"0\\\">
</td>
<td valign=top align=center>
<img src=\\\"\".\$image_path.\"/pix.gif \\\" width=80 height=1 border=\\\"0\\\"><br>
\$prem1<small><b><font size=3>$pricess</font></b>\$valutss<br>\$prem2</small><br><br>
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\">
<input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$prem1\$vbt1$qtyss
<small> <b>\" . $langpcs . \"</b></small>
<br><br>
$buybutton\$vbt2\$prem2
<br>\$minupak\$minsht
<small><br>[sklad]\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></form></td>\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($varcart==2) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top height=100%>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tl.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/t.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tr.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
	<tr>
		<td height=100% background=\\\"\$image_path/l.gif\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"26\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top><table height=100% width=100% border=0 cellspacing=3 cellpadding=0><tr><td valign=top align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td><td valign=top width=100% height=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate
<br>$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\"</small></td></tr><tr><td colspan=2 valign=bottom>\$freedelivery \$admin_functions [sklad]
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"$optilist<small>\$prem1
<table border=0 width=100% cellspacing=0 cellpadding=3>
<tr><td align=center>$qtyss</td><td><small> <b>\" . $langpcs . \"</b></small></td><td>$xxx</td><td align=center><small><b><font size=4>$pricess</font></b></small></td><td width=100%><small>\$valutss</small><input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 $buybutton\$vbt2</td></tr></table>\$minupak\$minsht\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% background=\\\"\$image_path/r.gif\\\">&nbsp;</td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/bl.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/b.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/br.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($varcart==3) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td bgcolor=\$nc2 width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" height=100% valign=top>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" height=100% width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tl2.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/t2.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tr2.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
	<tr>
		<td height=100% background=\\\"\$image_path/l2.gif\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"26\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top><table height=100% width=100% border=0 cellspacing=3 cellpadding=0><tr><td valign=top align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td><td valign=top width=100% height=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate
<br>$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\"</small></td></tr><tr><td colspan=2 valign=bottom>\$freedelivery \$admin_functions [sklad]
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"$optilist<small>\$prem1
<div class=pull-left>$qtyss</div><div class=pull-left><small> <b>\" . $langpcs . \"</b></small></div><div class=pull-left>$xxx</div><div class=pull-left><small> <b><font size=4>$pricess</font></b></small></div><div class=pull-left><small>\$valutss</small><input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></div><div class=pull-left>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 $buybutton\$vbt2</div><div class=pull-left>\$minupak\$minsht</div>\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td background=\\\"\$image_path/r2.gif\\\" height=100%>&nbsp;</td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/bl2.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/b2.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/br2.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($varcart==4) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td bgcolor=\$nc0 width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" cellspacing=\\\"0\\\" cellpadding=\\\"0\\\" height=100%>
	<tr bgcolor=\$nc2>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tl3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/t3.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tr3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
	<tr bgcolor=\$nc2>
		<td height=100% background=\\\"\$image_path/l3.gif\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"26\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top bgcolor=$nc0>
<table height=100% width=100% border=0 cellspacing=3 cellpadding=0>
<tr><td valign=top align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td><td valign=top rowspan=2 width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate $descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\"</small>
</td></tr><tr><td align=center valign=top height=100%><small><b><font size=4>$pricess</font></b></small><small>\$valutss</small>
</td></tr><tr><td colspan=2>\$freedelivery \$admin_functions
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"$optilist<small>\$prem1
<table border=0 width=100% cellspacing=0 cellpadding=3>
<tr><td width=100% valign=bottom><input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1>[sklad]</td><td valign=bottom><input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 $buybutton\$vbt2</td></tr></table>\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td  height=100% background=\\\"\$image_path/r3.gif\\\">&nbsp;</td>
	</tr>
	<tr bgcolor=\$nc2>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/bl3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/b3.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/br3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($varcart==5) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td bgcolor=\$nc0 width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr bgcolor=$nc2>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tl3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/t3.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tr3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
	<tr bgcolor=$nc2>
		<td height=100% background=\\\"\$image_path/l3.gif\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"26\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top bgcolor=$nc0>
<table height=100% width=100% border=0 cellspacing=3 cellpadding=0>
<tr><td valign=top align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div><p align=left><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate<br><small>\$lang[419]: \$ext_id</small><br><br>$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\"</small></p>
</td></tr><tr><td align=left valign=top height=100%>[sklad]
</td></tr><tr><td colspan=2>\$freedelivery \$admin_functions
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"$optilist<small>\$prem1
<table border=0 width=100% cellspacing=0 cellpadding=3>
<tr><td width=100% align=center><input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1><small><b><font size=4>$pricess</font></b></small><small>\$valutss</small></td><td><input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 $buybutton\$vbt2</td></tr></table>\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% background=\\\"\$image_path/r3.gif\\\">&nbsp;</td>
	</tr>
	<tr bgcolor=$nc2>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/bl3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/b3.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/br3.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($varcart==6) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top height=100%>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tl4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/t4.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tr4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
	<tr>
		<td height=100% background=\\\"\$image_path/l4.gif\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"26\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top><table width=100% height=100% border=0 cellspacing=3 cellpadding=0><tr><td valign=middle align=center height=100%><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td></tr><tr><td valign=top width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate<br>
$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\" \$freedelivery \$admin_functions</small>[sklad]
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<small>\$prem1
<table width=100% border=0 cellspacing=5 cellpadding=3>
<tr><td align=center>$qtyss<small><b>\" . $langpcs . \"</b></small></td><td><small> $xxx </small></td><td align=center><b><font size=4>$pricess</font></b>\$valutss<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td align=right>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1$optilist $buybutton\$vbt2</td></tr></table>\$minupak\$minsht\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% background=\\\"\$image_path/r4.gif\\\">&nbsp;</td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/bl4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/b4.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/br4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($varcart==7) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\"  valign=top height=100%>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tl4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/t4.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tr4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
	<tr>
		<td height=100% background=\\\"\$image_path/l4.gif\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"26\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top align=center><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=middle height=100% align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td></tr><tr><td valign=top width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate<br>
$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\" \$freedelivery \$admin_functions</small>$optilist [sklad]
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<small>\$prem1
<table width=100% border=0 cellspacing=0 cellpadding=10>
<tr><td width=100% align=center valign=bottom><input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1><b><font size=4>$pricess</font></b>\$valutss<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td align=right valign=bottom>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 $buybutton\$vbt2</td></tr></table>\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% background=\\\"\$image_path/r4.gif\\\">&nbsp;</td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/bl4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/b4.gif\\\">&nbsp;</td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/br4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($varcart==8) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top height=100%>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tl4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/t4.gif\\\"> </td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/tr4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
	<tr>
		<td height=100% background=\\\"\$image_path/l4.gif\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"26\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top align=center><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=middle height=100% align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td></tr><tr><td valign=top width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate<br>
$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\" \$freedelivery \$admin_functions</small>[sklad]
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<small>\$prem1
<table width=100% border=0 cellspacing=0 cellpadding=10>
<tr><td width=100% align=center><input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1><b><font size=4>$pricess</font></b>\$valutss<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td align=right valign=bottom>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">\$llid<font color=\$nc3 size=3><b>\".\$lang['addition'].\"</b>&nbsp;$carat</font></a>
\$vbt1\$vbt2</td></tr></table>\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% background=\\\"\$image_path/r4.gif\\\"> </td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/bl4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
		<td width=\\\"100%\\\" background=\\\"\$image_path/b4.gif\\\"> </td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/br4.gif\\\" width=\\\"26\\\" height=\\\"26\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
$evstr2=$evstr;
}
if ($buy_button_action==0)  {
$evstr2="
if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);



\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=center \";
//if (\$kupil!=\"\") {\$sps[\$s].= \" bgcolor=\\\"\".lighter(\$nc3,40).\"\\\"\"; }
\$sps[\$s].= \"><form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\"><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=middle height=100% align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div><br><small>\$lang[419]: \$ext_id<div class=pull-right>[sklad]</div></small>
</td></tr><tr><td align=center valign=top width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate</td></tr><tr><td>
$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\" \$freedelivery \$admin_functions</small>
$optilist<div class=pull-left><small>$dtoday</small></div></td></tr><tr><td height=100% valign=bottom>
\";
\$callback=\"\";
if (\$view_callback==1) { \$callback=\"<a class=\\\"btn btn-warning\\\" style=\\\"white-space:nowrap;\\\" href=#callback onClick=javascript:window.open('\$htpath/callback.php?speek=\".$speek.\"&unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"','frcall','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=770,height=530,left=10,top=10')><i class=\\\"icon-envelope icon-white\\\"></i><font color=black> \$lang[768]</font></a>\";}

if (\$view_goodsprice==1){
\$sps[\$s].= \"\$prem1
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
\$prem2<div class=clear><small>\$minupak\$minsht</small></div><div class=pull-left>\$callback</div><div class=pull-right align=left style=\\\"margin-bottom: 10px; margin-right:10px;\\\"><b><font size=4>$pricess</font></b> <font class=small>\$valutss\$sqrp</font></div><div class=clear></div><!-- hiddens [hiddens] -->\$prem1
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
<div class=pull-left align=center style=\\\"margin-right: 20px;\\\">$qtyss\".str_replace(\"/\",\"\", \$sqrp).\"</div><div class=pull-right>\$vbt1 $buybutton\$vbt2</div><div class=clear></div>\$prem2
<div><small>\$prbuy<div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></div></td></tr>
\";
}
\$sps[\$s].= \"</table></form></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
} else {
$evstr2="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$callback=\"\";
if (\$view_callback==1) { \$callback=\"<a class=\\\"btn btn-warning\\\" style=\\\"white-space:nowrap;\\\" href=#callback onClick=javascript:window.open('\$htpath/callback.php?speek=\".$speek.\"&unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"','frcall','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=770,height=530,left=10,top=10')><i class=\\\"icon-envelope icon-white\\\"></i><font color=black> \$lang[768]</font></a>\";}

\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\"  valign=top align=center \";
//if (\$kupil!=\"\") {\$sps[\$s].= \" bgcolor=\\\"\".lighter(\$nc3,40).\"\\\"\"; }
\$sps[\$s].= \"><form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\"><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=middle height=100% align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div><br><small>\$lang[419]: \$ext_id</small>
</td></tr><tr><td align=center valign=top width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate</td></tr><tr><td>
<br>\".@\$out[15].\"<br>\$kupil \".@\$hear.\" \$freedelivery \$admin_functions</small>
$optilist<br><table border=0><tr>\$callback<td valign=top width=50%><small>$dtoday</small></td></tr></table>></td></tr><tr><td height=100% valign=bottom>
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"\$prem1
<table width=100% border=0 cellspacing=5 cellpadding=5>
<tr><td valign=middle>[sklad]</td><td valign=middle align=center width=100%>$qtyss\".str_replace(\"/\",\"\", \$sqrp).\"</td><td valign=middle><nobr>".$lang[99].": </nobr></td><td valign=middle align=center><nobr><b><font size=4>$pricess\$valutss\$sqrp</font></b></nobr></td><td valign=middle align=right><font class=small></font><input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td align=right valign=middle>
\$prem2<!-- hiddens [hiddens] -->\$prem1
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 <nobr><b><a href=\$htpath/index.php?unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\">".$lang['addition']." »</a></b></nobr>\$vbt2</td></tr></table>\$minupak\$minsht\$prem2
<small>\$prbuy<div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></form></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}


if ($varcart==9) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top height=100%>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td bgcolor=\\\"".$nc6."\\\">
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td bgcolor=\\\"".$nc6."\\\" width=\\\"100%\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td bgcolor=\\\"".$nc6."\\\">
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
	<tr>
		<td height=100% bgcolor=\\\"".$nc6."\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"\$carth\\\"></td>
		\";
\$callback=\"\";
if (\$view_callback==1) { \$callback=\"<a class=\\\"btn btn-warning\\\" style=\\\"white-space:nowrap;\\\" href=#callback onClick=javascript:window.open('\$htpath/callback.php?speek=\".$speek.\"&unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"','frcall','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=770,height=530,left=10,top=10')><i class=\\\"icon-envelope icon-white\\\"></i><font color=black> \$lang[768]</font></a>\";}

\$sps[\$s].= \"<td width=100% valign=top align=center \";
//if (\$kupil!=\"\") {\$sps[\$s].= \" bgcolor=\\\"\".lighter(\$nc3,40).\"\\\"\"; }
\$sps[\$s].= \"><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=middle height=100% align=center><div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td></tr><tr><td align=center valign=top width=100%><b class=cat1>\$llid\" . \$nazv . \"</a></b> \$novina\$voterate</td></tr><tr><td>
$descriptionss<div align=center><br>\$ddescription</div>\$kupil \".@\$hear.\" \$freedelivery \$admin_functions</small>$optilist [sklad]<table border=0><tr>\$callback<td valign=top width=50%><small>$dtoday</small></td></tr></table></td></tr><tr><td height=100% valign=bottom>
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"\$prem1
<table width=100% border=0 cellspacing=2 cellpadding=1>
<tr><td valign=bottom align=center width=100%>$qtyss</td><td valign=bottom align=center><b><font size=4>$pricess</font></b></td><td valign=bottom align=right><font class=small>\$valutss</font><input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td align=right valign=bottom>
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 $buybutton\$vbt2</td></tr></table>\$minupak\$minsht\$prem2
<small>\$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% bgcolor=\\\"".$nc6."\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td width=\\\"100%\\\" bgcolor=\\\"".$nc6."\\\"> </td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}


if ($varcart==10) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby --><td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top height=100%>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td bgcolor=\\\"".$nc6."\\\">
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td bgcolor=\\\"\$nc6\\\" width=\\\"100%\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td bgcolor=\\\"".$nc6."\\\">
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
	<tr>
		<td height=100% bgcolor=\\\"".$nc6."\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top align=center\";


\$sps[\$s].= \"><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=top style=\\\"vertical-align: middle\\\" align=center>

<input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1>
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
<div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div><br><small>\$lang[419]: \$ext_id</small>
</td></tr><tr><td align=center height=100%><b>\"; if (\$dir!=\"All\") { \$sps[\$s].=\"<a href=\\\"$htpath/index.php?catid=\" . @\$podstava[\"\$dir||\"] . \"\\\"><font color=\$nc3>\$dir</font></a> / \"; } \$sps[\$s].=\"<a href=\\\"$htpath/index.php?catid=\" . \$podstava[\"\$dir|\$subdir|\"] . \"\\\"><font color=\$nc3>\$subdir</font></a></b></td></tr><tr><td valign=top width=100% align=center><br><b class=cat1>\$llid\" . wordwrap(\$nazv, 40, \"<br>\") . \"</a></b> \$novina\$voterate<div align=left><small>\$ddescription</small></div>
</small>\$freedelivery \$admin_functions
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"\$kupil<table border=0 width=100%><tr><td valign=middle align=center>\$prem1
<small><b><font size=4>$pricess</font></b>\$valutss

<small>\$prbuy</small></td><td valign=middle align=right>\$vbt1 $buybutton \$vbt2<div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div>\$prem2</td></tr></table></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% bgcolor=\\\"".$nc6."\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td width=\\\"100%\\\" bgcolor=\\\"".$nc6."\\\"> </td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}



if ($varcart==11) {
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby --><td width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top height=100%>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=\\\"0\\\" width=\\\"100%\\\" height=100% cellspacing=\\\"0\\\" cellpadding=\\\"0\\\">
	<tr>
		<td bgcolor=\\\"".$nc6."\\\">
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td bgcolor=\\\"\$nc6\\\" width=\\\"100%\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td bgcolor=\\\"".$nc6."\\\">
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
	<tr>
		<td height=100% bgcolor=\\\"".$nc6."\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"\$carth\\\"></td>
		\";

\$sps[\$s].= \"<td height=100% width=100% valign=top align=center\";


\$sps[\$s].= \"><table border=0 height=100% cellspacing=3 cellpadding=0><tr><td valign=top style=\\\"vertical-align: middle\\\" align=center>

<input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1>
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
<div style=\\\"display: block; position: relative;\\\" align=\\\"center\\\"><a name=\\\"spis\$s\\\"></a><span style=\\\"position: absolute; top: 0pt;\\\">\$sales</span>\$llid\".\"[foto1]</a>
<div style=\\\"clear: both;\\\" align=\\\"center\\\"></div></div>
</td></tr><tr><td align=center height=100%><b>\"; if (\$dir!=\"All\") { \$sps[\$s].=\"<b><a href=\\\"$htpath/index.php?catid=\" . @\$podstava[\"\$dir||\"] . \"\\\"><font color=\$nc3>\$dir</font></a> / \"; } \$sps[\$s].=\"<a href=\\\"$htpath/index.php?catid=\" . \$podstava[\"\$dir|\$subdir|\"] . \"\\\"><font color=\$nc3>\$subdir</font></a></b></td></tr><tr><td valign=top width=100% align=center><br><b class=cat1>\$llid\" . wordwrap(\$nazv, 40, \"<br>\") . \"</a></b> \$novina\$voterate<div align=left><small>\$ddescription</small></div>
</small>
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"\$kupil<table border=0 width=100%><tr><td valign=middle align=center>\$prem1
<small><b><font size=4>$pricess</font></b>\$valutss

<small>\$prbuy</small></td><td valign=middle align=right>\$vbt1 <a href=\\\"$buybut_url\\\"><img src=\\\"\".\$image_path.\"/buy_small.gif\\\" title=\\\"\$nazv - \".\$lang['buy'].\"\\\" border=\\\"0\\\"></a>\$vbt2<div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div>\$prem2</td></tr></table></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"<td height=100% bgcolor=\\\"".$nc6."\\\"><img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
	<tr>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
		<td width=\\\"100%\\\" bgcolor=\\\"".$nc6."\\\"> </td>
		<td>
		<img border=\\\"0\\\" src=\\\"\$image_path/pix.gif \\\" width=\\\"1\\\" height=\\\"1\\\"></td>
	</tr>
</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}
if ($varcart==12) {
$cols_of_goods=1;
$carth=20;
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if (\$foto2!=\"\"): \$big=\"<a href=\\\"#".$lang[138]."\\\" onmouseover=\\\"return overlib('\".str_replace(\"'\",\"\", str_replace(\"\\\"\",\"\",str_replace(\"\\\$\",\"\",str_replace(\"align\",\"halign\",\$foto2)))).\"<br>\$out[7]',  FGCOLOR, '', BGCOLOR, '', WIDTH, 100,  HEIGHT, 100, OFFSETY, 20, CAPTION,'')\\\" onmouseout=\\\"return nd();\\\"><img src=\\\"\".\$image_path.\"/hand.gif\\\" alt=\\\"".$lang[138]." \$nazv\\\" border=\\\"0\\\" align=absbottom><font color=\$nc2><b>".$lang[421]."</b></font></a>\"; endif;
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n
<td valign=top valign=top><form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"GET\\\">
<table width=100% border=0 cellspacing=3 cellpadding=0>
<tr>
<td valign=top><a name=\\\"spis\$s\\\"></a>\".\$ext_id.\"</td><td>&nbsp;</td><td valign=top width=100%><b><a href=\\\"\$htpath/index.php?unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\" onmouseover=\\\"return overlib('<div align=left class=item><b>\".str_replace(\"'\",\"\", str_replace(\"\\\$\",\"\", str_replace(\"\\\"\",\"\",\$nazv))).\"</b><br><table border=0><tr><td valign=top>\".str_replace(\"'\",\"\", str_replace(\"\\\"\",\"\",str_replace(\"align\",\"halign\",\$foto1))).\"</td><td valign=top><img src=\$image_path/pix.gif width=180 height=10 border=0><br><small>\".str_replace(\"\\\$\",\"\\\\\$\",str_replace(\"\\\"\",\"\",str_replace(\"'\",\"\",str_replace(\"[option]\",\"<!--\",str_replace(\"[/option]\",\"-->\",str_replace(\"[radio]\",\"<!--\",str_replace(\"[/radio]\",\"-->\",\$out[7].\"</small><br><br>\$prem1\$vipold<br><small><b>$pricess</b>\$valutss\$prem2\"))))))).\"</small></td></tr></table></div>',FGCOLOR, '', BGCOLOR, '', WIDTH, 100,  HEIGHT, 100, OFFSETY, 20, CAPTION,'')\\\" onmouseout=\\\"return nd();\\\"><font color=\$nc3>\" . \$nazv . \"</font></a></b> \$novina\$voterate</td><td valign=top>\$big\$kupil</td>\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<td valign=top align=center>
<img src=\\\"\".\$image_path.\"/pix.gif \\\" width=140 height=1 border=\\\"0\\\"><br>
\$prem1\$vipold<br><small><b>$pricess</b>\$valutss<br>\$prem2</small></td><td valign=top><img src=\\\"\".\$image_path.\"/pix.gif \\\" width=120 height=1 border=\\\"0\\\"><br>
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"add\\\">
\$prem1\$vbt1<div style=\\\"white-space:nowrap;\\\"><a class=btn onclick=\\\"javascript:if(document.getElementById('new_qty_\$s').value>1){document.getElementById('new_qty_\$s').value-=1;}\\\" align=absmiddle><i class=icon-minus></i></a><input style=\\\"text-align: center; height: 25px;font-size: 13px;\\\" class=input-mini id=\\\"new_qty_\$s\\\" name=\\\"qty\\\" type=\\\"text\\\" value=\\\"1\\\" size=1><a class=btn onclick=\\\"javascript:document.getElementById('new_qty_\$s').value-=-1;\\\" align=absmiddle><i class=icon-plus></i></a></div><div align=center><small><b>\" . \$vitrin . \"</b></small></div>
</td><td valign=top> $buybutton\$vbt2\$prem2
<div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div> \$prbuy</small></td></tr>
\";
}
\$sps[\$s].= \"<tr><td valign=top colspan=8 bgcolor=$nc2><img src=\\\"\".\$image_path.\"/pix.gif \\\" width=1 height=1 border=\\\"0\\\"></td></tr>
</table></form></td>\n\n\";
";
}


// Variants with multiple buys mast be grater then 100
if ($varcart==101) {
$cols_of_goods=1;
$view_baskinlist=0;
$carth=20;
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv height=100% width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=center>\$bskalert
<table width=100% border=0 cellspacing=3 cellpadding=0>
<tr>
<td valign=top width=100%><a name=\\\"spis\$s\\\"></a><b><a href=\\\"\$htpath/index.php?unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\" onmouseover=\\\"return overlib('<table class=round2><tr><td><img src=images/pix.gif height=1 width=500><br>\".str_replace(\"<img \",\"<img align=left hspace=10 \",str_replace(\"'\",\"\", str_replace(\"\\\"\",\"\",str_replace(\"align\",\"halign\",\$foto1)))).\"<b>\".str_replace(\"'\",\"\", str_replace(\"\\\$\",\"\", str_replace(\"\\\"\",\"\",\$nazv))).\"</b><br><small>\".str_replace(\"\\\$\",\"\\\\\$\",str_replace(\"\\\"\",\"\",str_replace(\"'\",\"\",str_replace(\"[option]\",\"<!--\",str_replace(\"[/option]\",\"-->\",str_replace(\"[radio]\",\"<!--\",str_replace(\"[/radio]\",\"-->\",\$out[7].\"</small>\"))))))).\"</small></td></tr></table>',FGCOLOR, '', BGCOLOR, '', WIDTH, 100,  HEIGHT, 100, OFFSETY, 20, CAPTION,'')\\\" onmouseout=\\\"return nd();\\\"><font color=\$nc3>\" . wordwrap(\$nazv, 40, \"<br>\") . \"</font></a></b> \$novina\$voterate<br><small><font color=$nc5 class=muted>[\$lang[419]:&nbsp;\$ext_id]</font></small>
\$admin_functions</td>\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<td valign=top align=center>
<img src=\\\"\".\$image_path.\"/pix.gif \\\" width=140 height=1 border=\\\"0\\\"><br>[sklad]
\$prem1\$vipold<small><b>$pricess</b>\$valutss\$prem2</small></td><td valign=top><img src=\\\"\".\$image_path.\"/pix.gif \\\" width=120 height=1 border=\\\"0\\\"><br>
\$prem1\$vbt1
<input style=\\\"text-align:center; font-size:14pt;\\\" id=\\\"mqty_\$s\\\" name=\\\"mqty[\$ff]\\\" type=\\\"text\\\" value=\\\"0\\\" size=4>
<b>\" . \$vitrin . \"</b></small>
\$vbt2\$prem2
 \$prbuy</small><div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></td></tr>
\";
}
\$sps[\$s].= \"</table></td>\";

\$sps[\$s].= \"\n\n|\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\";
";
}

//java cart
if ($varcart==13) {
$cols_of_goods=$cols_of_goods_in_easy_listing;
if ($view_buybut==0){$jbuybutton=""; } else {$jbuybutton=str_replace("[in]","\".", str_replace("[out]", ".\"", str_replace("[znakdollar]", "\$", str_replace("\"", "\\\"", str_replace("\$", "\\\$", str_replace("\\", "\\\\", jbuybutton("<a href=#buy onclick=\"javascript:document.getElementById('p_[znakdollar]s').src='images/wait.gif';document.getElementById('pcs_[znakdollar]s').innerHTML=Math.round(document.getElementById('pcs_[znakdollar]s').innerHTML) + [znakdollar]minorder;var fixed=(Math.round((parseFloat(document.getElementById('scart').innerHTML)+([znakdollar]minorder*[znakdollar]price))/$okr)*$okr);fixed=fixed.toFixed(2);document.getElementById('scart').innerHTML=fixed.toString();document.getElementById('kup_[znakdollar]s').innerHTML='".$lang['buyes']." '; document.getElementById('st_[znakdollar]s').innerHTML=' [znakdollar]vitrin ';document.getElementById('p_[znakdollar]s').src='".$scriptprefix."ok.php?unifid=[in]md5(@[znakdollar]out[3][out] ID:[in]@[znakdollar]out[6])[out]&t=".time()."&amp;speek=".$speek."&addqty=[znakdollar]minorder&amp;qty='+document.getElementById('pcs_[znakdollar]s').innerHTML; $inbscript".$inminibasket."\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a>", $nc2,60,$nc0)))))));
 }
if($buy_button_action==1) {$jbuybutton="<b class=lnk>\$llid ".$lang['addition']." <i class=icon-chevron-right></i></a></b>";}
//$view_bask=0;
if ($view_buybut==0){$buybutton=""; }
$view_baskinlist=0;
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
if (\$view_buybut==0) { if (\$prem1==\"<!-- \"){ \$vbt1=\"\"; \$vbt2=\"\"; }}
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv height=100% width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=center>
<table border=0 height=100% width=100% cellspacing=0 cellpadding=0><tr><td style=\\\"vertical-align: top\\\" align=center>\$bskalert
<div class=pull-left><a name=\\\"spis\$s\\\"></a>\$llid\".\"[foto1]</a></div>\$big<div class=clearfix></div>
<div class=pull-right align=center>\$sales\".\"[sklad]</div><div><b class=cat1>\$llid\" . wordwrap(\$nazv, 40, \"<br>\") . \"</a></b> \$novina\$voterate<div align=left><small>\$lang[419]: \$ext_id</small></div><hr><small>\$minupak\$minsht</small>\$prbuy\$freedelivery\$admin_functions\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<div align=center><img class=hidden id=\\\"p_\$s\\\" src=\\\"pix.gif\\\" width=78 height=12 border=0><font color=$nc3><b id=\\\"kup_\$s\\\"> \$inb1</b><b id=\\\"pcs_\$s\\\">\$inbasket</b><b id=\\\"st_\$s\\\">\$inb2</b></font><b id=\\\"oform_\$s\\\"></b></div>\$prem1
</td>
</tr>
<tr>
<td valign=bottom>
<div><div align=right style=\\\"margin-bottom: 10px; margin-right:10px;\\\"><b><font size=4>$pricess</font></b>\$valutss</div><div align=right>\$vbt1 $jbuybutton \$vbt2</div></div>\$prem2</td></tr></table>
\";
}
\$sps[\$s].= \"</div><div class=clear></div></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";

$evstr2="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
if (\$view_buybut==0) { if (\$prem1==\"<!-- \"){ \$vbt1=\"\"; \$vbt2=\"\"; }}
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv height=100% width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=center>
<table border=0 height=100% width=100% cellspacing=0 cellpadding=0><tr><td style=\\\"vertical-align: top\\\" align=center>\$bskalert
<div class=pull-left><a name=\\\"spis\$s\\\"></a>\$llid\".\"[foto1]</a></div>\$big<div class=clearfix></div>
<div class=pull-right align=center>\$sales\".\"[sklad]</div><div><b class=cat1>\$llid\" . wordwrap(\$nazv, 40, \"<br>\") . \"</a></b> \$novina\$voterate<div align=left><small>\$lang[419]: \$ext_id</small></div><hr><small>\$minupak\$minsht</small>\$prbuy\$freedelivery\$admin_functions\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<div align=center><img class=hidden id=\\\"p_\$s\\\" src=\\\"pix.gif\\\" width=78 height=12 border=0><font color=$nc3><b id=\\\"kup_\$s\\\"> \$inb1</b><b id=\\\"pcs_\$s\\\">\$inbasket</b><b id=\\\"st_\$s\\\">\$inb2</b></font><b id=\\\"oform_\$s\\\"></b></div>\$prem1
</td>
</tr>
<tr>
<td valign=bottom>
<div><div align=right style=\\\"margin-bottom: 10px; margin-right:10px;\\\"><b><font size=4>$pricess</font></b>\$valutss</div>
<div style=\\\"white-space:nowrap;\\\"><div class=pull-left>\".str_replace(\"<a \", \"<a class=btn \",\$llid).\"<i class=icon-tags></i><br><small>$lang[1547]</small></a></div><div class=pull-right>\$vbt1 $jbuybutton \$vbt2</div><div class=clear></div></div></div>\$prem2</td></tr></table>
\";
}
\$sps[\$s].= \"</div><div class=clear></div></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}

if ($varcart==14) {
if ($view_buybut==0){$jbuybutton=""; } else {$jbuybutton=str_replace("[in]","\".", str_replace("[out]", ".\"", str_replace("[znakdollar]", "\$", str_replace("\"", "\\\"", str_replace("\$", "\\\$", str_replace("\\", "\\\\", jbuybutton("<a href=#buy onclick=\"javascript:document.getElementById('p_[znakdollar]s').src='images/wait.gif';document.getElementById('pcs_[znakdollar]s').innerHTML=Math.round(document.getElementById('pcs_[znakdollar]s').innerHTML) + [znakdollar]minorder;var fixed=(Math.round((parseFloat(document.getElementById('scart').innerHTML)+([znakdollar]minorder*[znakdollar]price))/$okr)*$okr);fixed=fixed.toFixed(2);document.getElementById('scart').innerHTML=fixed.toString();document.getElementById('kup_[znakdollar]s').innerHTML='".$lang['buyes']." ';document.getElementById('oform_[znakdollar]s').innerHTML='';document.getElementById('st_[znakdollar]s').innerHTML=' [znakdollar]vitrin ';document.getElementById('p_[znakdollar]s').src='".$scriptprefix."ok.php?unifid=[in]md5(@[znakdollar]out[3][out] ID:[in]@[znakdollar]out[6])[out]&t=".time()."&amp;speek=".$speek."&addqty=[znakdollar]minorder&amp;qty='+document.getElementById('pcs_[znakdollar]s').innerHTML; $inbscript".$inminibasket."\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a>", $nc2,60,$nc0)))))));
 }
 if($buy_button_action==1) {$jbuybutton="<b class=lnk>\$llid ".$lang['addition']." <i class=icon-chevron-right></i></a></b>";}
//$view_bask=0;
if ($view_buybut==0){$buybutton=""; }
$view_baskinlist=0;
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;



\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv height=100% width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=center>
\$bskalert
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\"><table border=0 height=100% width=100% cellspacing=3 cellpadding=0><tr><td style=\\\"vertical-align: top\\\" align=center>
<input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1>
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
<a name=\\\"spis\$s\\\"></a><div class=pull-right align=center>\$sales\".\"[sklad]</div>\$llid\".\"[foto1]</a>\$big
<b class=cat1>\$llid\" . wordwrap(\$nazv, 40, \"<br>\") . \"</a></b> \$novina\$voterate<div align=left><small>\$lang[419]: \$ext_id</small><hr><div>$descriptionss<br><div style=\\\"margin-top: 5px; margin-bottom: 10px;\\\">\$ddescription</div></div><small>\$minupak\$minsht</small></div>
\$freedelivery \$admin_functions\";
\$callback=\"\";
if (\$view_callback==1) { \$callback=\"<a class=\\\"btn btn-warning\\\" style=\\\"white-space:nowrap;\\\" href=#callback onClick=javascript:window.open('\$htpath/callback.php?speek=\".$speek.\"&unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"','frcall','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=770,height=530,left=10,top=10')><i class=\\\"icon-envelope icon-white\\\"></i><font color=black> \$lang[768]</font></a>\";}

if (\$view_goodsprice==1){
\$sps[\$s].= \"<div align=center><img class=hidden id=\\\"p_\$s\\\" src=\\\"pix.gif\\\" width=78 height=12 border=0><font color=$nc3><b id=\\\"kup_\$s\\\">\$inb1</b><b id=\\\"pcs_\$s\\\">\$inbasket</b><b id=\\\"st_\$s\\\">\$inb2</b></font><b id=\\\"oform_\$s\\\"></b></div>\$prem1
<div class=clear></div><div class=pull-right align=left style=\\\"margin-bottom: 10px; margin-right:10px;\\\"><b><font size=4>$pricess</font></b> <font class=small>\$valutss\$sqrp</font></div><div class=clear></div>
<div class=pull-left>\$callback</div><div class=pull-right>\$vbt1 $jbuybutton \$vbt2</div<\$prem2</td>

    </tr>
\";
}
\$sps[\$s].= \"</table></form></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";







$evstr2="
if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;

\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=center \";
//if (\$kupil!=\"\") {\$sps[\$s].= \" bgcolor=\\\"\".lighter(\$nc3,40).\"\\\"\"; }
\$sps[\$s].= \"><form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=0 height=100% cellspacing=3 cellpadding=0>
<tr>
<td valign=middle align=center>
<a name=\\\"spis\$s\\\"></a><div class=pull-right align=center>\$sales\".\"[sklad]</div>\$llid\".\"[foto1]</a>\$big
<b class=cat1>\$llid\" . wordwrap(\$nazv, 40, \"<br>\") . \"</a></b> \$novina\$voterate<div align=left><small>\$lang[419]: \$ext_id</small><hr><div>$descriptionss<br><div style=\\\"margin-top: 5px; margin-bottom: 10px;\\\">\$ddescription</div></div><small>\$minupak\$minsht</small></div>
\$freedelivery \$admin_functions\";
\$callback=\"\";
if (\$view_callback==1) { \$callback=\"<a class=\\\"btn btn-warning\\\" style=\\\"white-space:nowrap;\\\" href=#callback onClick=javascript:window.open('\$htpath/callback.php?speek=\".$speek.\"&unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"','frcall','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=770,height=530,left=10,top=10')><i class=\\\"icon-envelope icon-white\\\"></i><font color=black> \$lang[768]</font></a>\";}
if (\$view_goodsprice==1){
\$sps[\$s].= \"$optilist<small>$dtoday</small>\$prem1
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
\$prem2<div class=clear><small>\$minupak\$minsht</small></div><div class=pull-left>\$callback</div><div class=pull-right align=left style=\\\"margin-bottom: 10px; margin-right:10px;\\\"><b><font size=4>$pricess</font></b> <font class=small>\$valutss\$sqrp</font></div><div class=clear></div><!-- hiddens [hiddens] -->\$prem1
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
<div class=pull-left align=center style=\\\"margin-right: 20px;\\\">$qtyss\".str_replace(\"/\",\"\", \$sqrp).\"</div><div class=pull-right>\$vbt1 $buybutton\$vbt2</div><div class=clear></div>\$prem2
<div><small>\$prbuy<div align=center><font size=2 color=$nc3><b>\$inb1\$inbasket\$inb2</b></font></div></div></td></tr>
\";
}
\$sps[\$s].= \"</table></form></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}

if ($varcart==15) {
if ($view_buybut==0){$jbuybutton=""; } else {$jbuybutton2=str_replace("[in]","\".", str_replace("[out]", ".\"", str_replace("[znakdollar]", "\$", str_replace("\"", "\\\"", str_replace("\$", "\\\$", str_replace("\\", "\\\\", jbuybutton("<a href=#buy onclick=\"javascript:document.getElementById('p_[znakdollar]s').src='images/wait.gif';document.getElementById('pcs_[znakdollar]s').innerHTML=Math.round(document.getElementById('pcs_[znakdollar]s').innerHTML) + [znakdollar]minorder;var fixed=(Math.round((parseFloat(document.getElementById('scart').innerHTML)+([znakdollar]minorder*[znakdollar]price))/$okr)*$okr);fixed=fixed.toFixed(2);document.getElementById('scart').innerHTML=fixed.toString();document.getElementById('kup_[znakdollar]s').innerHTML='".$lang['buyes']." ';document.getElementById('oform_[znakdollar]s').innerHTML='';document.getElementById('st_[znakdollar]s').innerHTML=' [znakdollar]vitrin ';document.getElementById('p_[znakdollar]s').src='".$scriptprefix."ok.php?unifid=[in]md5(@[znakdollar]out[3][out] ID:[in]@[znakdollar]out[6])[out]&t=".time()."&amp;speek=".$speek."&addqty=[znakdollar]minorder&amp;qty='+document.getElementById('pcs_[znakdollar]s').innerHTML; $inbscript".$inminibasket."\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a>", $nc2,60,$nc0)))))));
 }
 if($buy_button_action==1) {$jbuybutton="<b class=lnk>\$llid ".$lang['addition']." <i class=icon-chevron-right></i></a></b>";}
//$view_bask=0;
if ($view_buybut==0){$buybutton=""; }
$view_baskinlist=0;
$cols_of_goods=1;
$carth=20;
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);

\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv height=100% width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=left>
\$bskalert
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=0 height=100% width=100% cellspacing=3 cellpadding=0><tr>
<td align=left valign=middle width=50%>
<input name=\\\"qty\\\" type=\\\"hidden\\\" value=\\\"1\\\" size=1>
<input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\">
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\"><a name=\\\"spis\$s\\\"></a><b><a name=\\\"spis\$s\\\"></a><a href=\\\"\$htpath/index.php?unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\" onmouseover=\\\"return overlib('<table class=round2><tr><td><img src=images/pix.gif height=1 width=500><br>\".str_replace(\"<img \",\"<img align=left hspace=10 \",str_replace(\"'\",\"\", str_replace(\"\\\"\",\"\",str_replace(\"align\",\"halign\",\$foto1)))).\"<b>\".str_replace(\"'\",\"\", str_replace(\"\\\$\",\"\", str_replace(\"\\\"\",\"\",\$nazv))).\"</b><br><small>\".str_replace(\"\\\$\",\"\\\\\$\",str_replace(\"\\\"\",\"\",str_replace(\"'\",\"\",str_replace(\"[option]\",\"<!--\",str_replace(\"[/option]\",\"-->\",str_replace(\"[radio]\",\"<!--\",str_replace(\"[/radio]\",\"-->\",\$out[7].\"</small>\"))))))).\"</small></td></tr></table>',FGCOLOR, '', BGCOLOR, '', WIDTH, 100,  HEIGHT, 100, OFFSETY, 20, CAPTION,'')\\\" onmouseout=\\\"return nd();\\\"><font color=\$nc3>\" . wordwrap(\$nazv, 40, \"<br>\") . \"</font></a></b> \$novina\$voterate<br><small><font color=$nc5 class=muted>[\$lang[419]:&nbsp;\$ext_id]</font></small> \$admin_functions
</td><td>\$freedelivery</td>
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<td align=left valign=middle><small><img src=\\\"pix.gif\\\" width=120 height=1 border=0><br><font size=2 color=$nc3><b id=\\\"kup_\$s\\\">\$inb1</b><b id=\\\"pcs_\$s\\\">\$inbasket</b><b id=\\\"st_\$s\\\">\$inb2</b></font> <img class=hidden id=\\\"p_\$s\\\" src=\\\"pix.gif\\\" width=78 height=12 border=0></small><b id=\\\"oform_\$s\\\"></b><br>[sklad]</td><td width=50% align=right valign=middle>\$prem1<nobr><b>$pricess</b>\$valutss</nobr></td>

<td valign=bottom><small>\$prbuy</small></td><td valign=middle align=right>\$vbt1 $jbuybutton2 \$vbt2\$prem2</td>
\";
}
\$sps[\$s].= \"</tr></table></form></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";


$evstr2="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);

\$sps[\$s]= \"<!-- \$sortby --><td class=itemdiv width=\\\"\".floor(100/\$cols_of_goods).\"%\\\" style=\\\"width:\".floor(100/\$cols_of_goods).\"%;\\\" valign=top align=left>
<form class=form-inline name=\\\"spis\$s\\\" action=\\\"\$htpath/index.php$spiss\\\" method=\\\"\$post_method\\\">
<table border=0 height=100% cellspacing=3 cellpadding=0>
<tr>
<td align=left width=50% valign=middle>
<a name=\\\"spis\$s\\\"></a>
<b><a name=\\\"spis\$s\\\"></a><a href=\\\"\$htpath/index.php?unifid=\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\" onmouseover=\\\"return overlib('<table class=round2><tr><td><img src=images/pix.gif height=1 width=500><br>\".str_replace(\"<img \",\"<img align=left hspace=10 \",str_replace(\"'\",\"\", str_replace(\"\\\"\",\"\",str_replace(\"align\",\"halign\",\$foto1)))).\"<b>\".str_replace(\"'\",\"\", str_replace(\"\\\$\",\"\", str_replace(\"\\\"\",\"\",\$nazv))).\"</b><br><small>\".str_replace(\"\\\$\",\"\\\\\$\",str_replace(\"\\\"\",\"\",str_replace(\"'\",\"\",str_replace(\"[option]\",\"<!--\",str_replace(\"[/option]\",\"-->\",str_replace(\"[radio]\",\"<!--\",str_replace(\"[/radio]\",\"-->\",\$out[7].\"</small>\"))))))).\"</small></td></tr></table>',FGCOLOR, '', BGCOLOR, '', WIDTH, 100,  HEIGHT, 100, OFFSETY, 20, CAPTION,'')\\\" onmouseout=\\\"return nd();\\\"><font color=\$nc3>\" . wordwrap(\$nazv, 40, \"<br>\") . \"</font></a></b> \$novina\$voterate<br><small><font color=$nc5 class=muted>[\$lang[419]:&nbsp;\$ext_id]</font></small><br>\$minupak \$admin_functions

</td><td>\$freedelivery</td>
<td>
<font color=$nc3><b>\$inb1\$inbasket\$inb2</b></font>\$kupil \".@\$hear.\"$optilist [sklad]</td>\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"\$prem1
<td valign=middle align=center width=100%>
$qtyss\".str_replace(\"/\",\"\", \$sqrp).\"</td>
<td valign=middle align=center><b><font size=4>$pricess</font></font></b>\$valutss\$minsht</td>
<td valign=middle align=right><font class=small>\$sqrp</font><input type=\\\"hidden\\\" name=\\\"buy_row\\\" value=\\\"\$s\\\"><input type=\\\"hidden\\\" name=\\\"usl\\\" value=\\\"\$usl\\\"></td><td>\$prbuy</td>
<td align=right valign=middle>\$bskalert
\$prem2<!-- hiddens [hiddens] -->\$prem1
<input type=\\\"hidden\\\" name=\\\"catid\\\" value=\\\"\$catid\\\">
<input type=\\\"hidden\\\" name=\\\"query\\\" value=\\\"$query\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"brand\\\" value=\\\"\".@\$brand.\"\\\">
<input type=\\\"hidden\\\" name=\\\"sorting\\\" value=\\\"\$sorting\\\">
<input type=\\\"hidden\\\" name=\\\"way\\\" value=\\\"\$way\\\">
<input type=\\\"hidden\\\" name=\\\"start\\\" value=\\\"\$start\\\">
<input type=\\\"hidden\\\" name=\\\"perpage\\\" value=\\\"\$perpage\\\">
<input type=\\\"hidden\\\" name=\\\"view\\\" value=\\\"\$view\\\">
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"\$path_to_buy\\\">
\$vbt1 $buybutton\$vbt2
</td>\$prem2

\";
}
\$sps[\$s].= \"</tr></table></form></td>\";

\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";


}

if ($varcart==1000) {
if ($view_buybut==0){$jbuybutton=""; } else {$buybutton=str_replace("[in]","\".", str_replace("[out]", ".\"", str_replace("[znakdollar]", "\$", str_replace("\"", "\\\"", str_replace("\$", "\\\$", str_replace("\\", "\\\\", jbuybutton("<a href=#buy onclick=\"javascript:document.getElementById('p_[znakdollar]s').src='images/wait.gif';document.getElementById('pcs_[znakdollar]s').innerHTML=Math.round(document.getElementById('pcs_[znakdollar]s').innerHTML) + [znakdollar]minorder;var fixed=(Math.round((parseFloat(document.getElementById('scart').innerHTML)+([znakdollar]minorder*[znakdollar]price))/$okr)*$okr);fixed=fixed.toFixed(2);document.getElementById('scart').innerHTML=fixed.toString();document.getElementById('kup_[znakdollar]s').innerHTML='".$lang['buyes']." ';document.getElementById('oform_[znakdollar]s').innerHTML='';document.getElementById('st_[znakdollar]s').innerHTML=' [znakdollar]vitrin ';document.getElementById('p_[znakdollar]s').src='".$scriptprefix."ok.php?unifid=[in]md5(@[znakdollar]out[3][out] ID:[in]@[znakdollar]out[6])[out]&t=".time()."&amp;speek=".$speek."&addqty=[znakdollar]minorder&amp;qty='+document.getElementById('pcs_[znakdollar]s').innerHTML; $inbscript".$inminibasket."\"><b><font color=#ffffff>".str_replace(" ", "&nbsp;", $lang['buy'])."</font></b></a>", $nc2,60,$nc0)))))));
 }
//$view_bask=0;
if($buy_button_action==1) {$jbuybutton="<b class=lnk>\$llid ".$lang['addition']." <i class=icon-chevron-right></i></a></b>";}
if ($view_buybut==0){$buybutton=""; }
$view_baskinlist=0;
$evstr="if ((\$price>=\$currencies_zakaz_menee[\$valut])&&(\$view_freedeliveryicon==1)) {\$freedelivery=\"$frfr\";} else {\$freedelivery=\"\";}
if ((\$foto2!=\"\")&&(\$big_photos_inlist==1)){ \$big=\"<div class=fts title=\\\"$lang[138]\\\" id=z_\$s onclick=\\\"smf('z_\$s');\\\">\".str_replace(\"<br>\", \"\", str_replace(\"<img \",\"<img class=smf \",\$foto2)).\"</div>\"; }
\$mduni=md5(@\$out[3].\" ID:\".@\$out[6]);
//if (@\$out[4]==0): \$mduni=\"NO\"; endif;
//if (@\$out[4]==\"\"): \$mduni=\"NO\"; endif;
if (substr(@\$out[12],0,1)==\"0\"): \$mduni=\"NO\"; endif;
if (@\$out[12]==\"\"): \$mduni=\"NO\"; endif;
\$foto1=str_replace(\" align=left\", \"\",\$foto1);
\$sps[\$s]= \"\\n\\n\\n<!-- \$sortby -->\\n\\n\\n<td class=img bgcolor=\$nc0 height=100% width=100% valign=top align=center>
<form class=form-inline name=\\\"spis\$s\\\" id=\\\"spis\$s\\\" action=\\\"\$htpath/index.php\\\" method=\\\"\$post_method\\\">
<table border=0 height=100% width=100% cellspacing=3 cellpadding=3><tr><td rowspan=2 style=\\\"vertical-align: top\\\" align=center>
<input type=\\\"hidden\\\" name=\\\"action\\\" value=\\\"add\\\">
<input type=\\\"hidden\\\" name=\\\"unifid\\\" value=\\\"\".md5(@\$out[3].\" ID:\".@\$out[6]).\"\\\">
<input type=\\\"hidden\\\" name=\\\"old_action\\\" value=\\\"viewcart\\\"><div align=left><font size=3 color=$nc2><b>$lang[735]!</b></font></div>
<a name=\\\"spis\$s\\\"></a>\$llid\$fotos</a>
<br><br><b>\$llid<font color=\$nc5 size=3>\" . wordwrap(\$nazv, 40, \"<br>\") . \"</font></a></b> \$novina\$voterate<br><div align=left><small>\$lang[419]: \$ext_id<br>$descriptionss<div align=center><br>\$ddescription</div><br></small></div>
</small>
\";
if (\$view_goodsprice==1){
\$sps[\$s].= \"<img class=hidden id=\\\"p_\$s\\\" src=\\\"pix.gif\\\" width=78 height=12 border=0><br><font color=$nc3><b id=\\\"kup_\$s\\\">\$inb1</b><b id=\\\"pcs_\$s\\\">\$inbasket</b><b id=\\\"st_\$s\\\">\$inb2</b></font><b id=\\\"oform_\$s\\\"></b></td></tr><tr><td height=100%><table width=100% border=0><tr><td valign=middle><small>\$prem1
<table border=0 cellpadding=0 cellspacing=2><tr><td><input type=button value=\\\"-\\\" style=\\\"text-indent: 0; width=10 margin: 0; padding: 0\\\" onclick=\\\"javascript:if(document.getElementById('new_qty_\".\$s.\"').value>=2){document.getElementById('new_qty_\".\$s.\"').value-=1;}\\\"></td><td><input id=\\\"new_qty_\".\$s.\"\\\" name=\\\"qty\\\" type=\\\"text\\\" style=\\\"width:30px\\\" value=\\\"1\\\" size=3></td><td><input type=button style=\\\"text-indent: 0; width=10 margin: 0; padding: 0\\\" value=\\\"+\\\" onclick=\\\"javascript:document.getElementById('new_qty_\".\$s.\"').value-=-1;\\\"></td></tr></table></td><td align=center><b><font size=4>$pricess</font></b>\$valutss

<small>\$prbuy</small></td><td valign=middle align=right>\$vbt1 \".buybutton(\"<a href=\\\"javascript:document.spis\$s.submit()\\\" title=\\\"\".\$lang['buy'].\"\\\">\".\$lang['buy'].\"</a>\",\$nc2,60,\$nc0).\" \$vbt2\$prem2</td></tr></table></td>

    </tr>
\";
}
\$sps[\$s].= \"</table></form></td>\";
\$sps[\$s].= \"\n\n|\$mduni|\$foto1\";
";
}


if (@$mod_rw_enable==1): $evstr=str_replace("index.php?catid=", "", str_replace("&brand=", "/", "$evstr"));  endif;
?>
