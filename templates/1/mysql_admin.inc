<?php
$shabl="";
$shabl2="";
$shabl.="<li><a href=\"index.php?action=template&nt=templates/$template/$speek&t=config\">
".$lang['adm9']." [$speek]</a></li>";
$shabl2.="<li><a href=\"index.php?speeks=$speek&action=vars&mod=admin\">
".$lang[135]." [$speek]</a> </li>";

$moderem1="<!-- ";$moderem2=" -->";
if (($details[7]=="ADMIN")&&($valid=="1")) {$moderem1="";$moderem2="";}
$admin_url="<b>MYSQL BASE</b> / Some functions switched OFF<br><table border=0 cellpadding=5 cellspacing=0><tr><td><b>
".$lang[1].":</b><br><li><a href=\"admin/".$scriptprefix."indexator.php?speek=$speek\">
".$lang['adm1']."</a></li><li><a href=\"admin/index_content.php?speek=$speek\">
".$lang['adm11']."</a></li>
<li><a href=\"admin/index_rss.php\" target=\"_blank\">
".$lang[870]."</a></li>";
if ($smod=="shop") {
$admin_url.="<!--li><a href=\"admin/index.php?speek=$speek\">
".$lang['adm2']."</a></li--><!--li><a href=\"admin/addcart.php?speek=$speek\" target=\"_blank\">
".$lang[2]."</a></li--><!--li><a href=\"admin/backup.php?speek=$speek\" target=\"_blank\">
".$lang[3]."</a></li--><!--li><a href=\"admin/restore.php?speek=$speek\" target=\"_blank\">
".$lang[322]."</a></li-->";
}
$admin_url.="<li><a href=\"admin/editor/index.php?speek=$speek\">
".$lang['adm3']."</a></li>";
if ($smod=="shop") {$admin_url.="<li><a href=\"index.php?action=view_cmenu\">
".$lang[4]."</a></li>$moderem1<!--li><a href=\"index.php?action=replacer\">
".$lang[5]."</a></li--><!--li><a href=\"index.php?action=recalc\">
".$lang[869]."</a></li-->$moderem2<li><a href=\"index.php?action=folderimg\">
".$lang[6]."</a></li><li><a href=\"index.php?action=brandimg&mod=admin\">
".$lang[868]."</a></li><li><a href=\"index.php?action=sales&mod=admin\">
".$lang[128]."</a></li><li><a href=\"index.php?action=poz&mod=admin\">
".$lang[282]."</a></li>$moderem1<!--li><a href=\"admin/del_notused_photos.php?speek=$speek\">
".$lang[129]."</a></li--><!--li><a href=\"index.php?action=doubles\">
".$lang[130]."</a></li--><!--li><a href=\"index.php?action=topindex\">
".$lang[131]."</a></li--><li><a href=\"index.php?action=dircolors\">
".$lang[521]."</a></li>
<li><a href=\"index.php?action=template&nt=robots\">
".$lang['edits']." robots.txt</a></li>
<li><a href=\"index.php?action=template&nt=htaccess\">
".$lang['edits']." .htaccess</a></li>
<li><a href=\"#kvit\" onClick=javascript:window.open('admin/currency_parser.php?speek=$speek','frc','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10')>
Parse currencies</a></li>";
}
$admin_url.="<br><br><b>
".$lang[171].":</b> <br><li><a href=\"index.php?action=tags&mod=admin\">
".$lang[132]."</a></li>$moderem2<li><a href=\"index.php?action=tagindex\">
".$lang[133]."</a></li>";

if ($smod=="shop") { $admin_url.="<br><br><b>
".$lang[7].":</b>"; }

$admin_url.="<br><li><a href=\"index.php?action=view_users\">
".$lang['adm5']."</a></li>";

if ($smod=="shop") {
$admin_url.="<li><a href=\"index.php?action=view_baskets\">
".$lang['adm4']."</a></li>$moderem1<li><a href=\"index.php?action=orderstats&mod=admin\">
".$lang[13]."</a></li>$moderem2";
}
$admin_url.="<li><a href=\"index.php?action=viewcomm&mod=admin\">
".$lang[8]."</a></li>";
if ($view_forum==1) { $admin_url.="<br><br><b>
".$lang[9].":</b><br><li><a href=\"index.php?action=forum_admin\">
".$lang['adm6']."</a></li><li><a href=\"index.php?action=template&nt=forums\">
".$lang[1003]."</a></li>"; }

$admin_url.="<br><br>$moderem1<b>
".$lang[10].":</b><br>$shabl2<li><a href=\"index.php?action=colors&mod=admin\">
".$lang[11]."</a></li><li><a href=\"index.php?action=template&nt=templates&t=lang\">
".$lang['adm8']."</a></li>$shabl<li><a href=\"index.php?action=template&nt=templates/$template\">
".$lang['adm7']."</a></li>";
if ($smod=="shop") {
$admin_url.="<li><a href=\"#kvit\" onClick=javascript:window.open('admin/edit/index.php?speek=$speek&working_file=../../templates/$template/$speek/ticket.inc','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>
".$lang[134]."</a></li>
<li><a href=\"#kvit\" onClick=javascript:window.open('admin/edit/index.php?speek=$speek&working_file=../../templates/$template/$speek/invoice.inc','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>
".$lang[871]."</a></li>";
}
$admin_url.="<li><a href=\"index.php?action=thtml&mod=admin\">
".$lang[136]."</a></li><br><br><b>
".$lang[12].":</b><br><li><a href=\"index.php?action=htaccess\">
".$lang['adm10']."</a></li>";
if (!@file_exists("./admin/.htpasswd")) {$admin_url.="<div align=center><img src=$image_path/handup.png border=0><br><font color=#b94a48>".$lang['pass'].": <b>$lang[906]</b>!!!</font></div><br>";}
$admin_url.="<li><a href=\"index.php?zapros=".md5($_SERVER['SERVER_NAME'])."\">
".$lang[57]."</a></li><li><a href=\"index.php?action=template&nt=templates&t=license\">
".$lang[283]."</a></li><br><br>$moderem2";
if ($show_statip==1) {
$admin_url.="<b>
".$lang[13].":</b> <br><li><a href=\"index.php?action=userip\">
".$lang[13]." IP</a></li><li><a href=\"index.php?action=template&nt=$base_loc&t=banlist\">
".$lang[14]." IP</a></li><li><a href=\"index.php?action=userip&delip=1&start=0&perpage=10&ipsort=\">
".$lang[15]."</a></li><br><br>";
}
if ($smod=="shop") {
if ($stinfo=="ext") {
$admin_url.="<b>
".$lang[170].":</b> <br><!--li><a href=\"admin/sklad/index_base.php?speek=$speek\" target=\"_blank\">
".$lang[16]."</a></li-->";
if ($stinfo!="int") {
$admin_url.="<!--li><a href=\"admin/sklad/analitic.php?speek=$speek\" target=\"_blank\">
".$lang[17]."</a></li><li><a href=\"admin/sklad/index.php?speek=$speek\" target=\"_blank\">
".$lang[18]."</a></li-->";
}
$admin_url.="<br><br>";
}
}
$admin_url.="$moderem1<b>
".$lang[19].":</b> <br><li><a href=\"index.php?action=partners&mod=admin\">
".$lang[872]."</a></li><li><a href=\"#obmen\" onClick=javascript:window.open('admin/obmen.php?speek=$speek','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=560,left=10,top=10')>
".$lang[20]."</a></li><li><a href=\"#htmlcode\" onClick=javascript:window.open('admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/s0001.txt','fr2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>
".$lang[21]."</a></li><li><a href=\"#obmen\" onClick=javascript:window.open('admin/gen_editor.php?speek=$speek','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=560,left=10,top=10')>
".$lang[22]."</a></li><li><a href=\"#obmen\" onClick=javascript:window.open('admin/generator.php?speek=$speek','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=560,left=10,top=10')>
".$lang[23]."</a></li>$moderem2<br><br><b>
".$lang[24].":</b> <br>$moderem1<li><a href=\"#obmen\" onClick=javascript:window.open('admin/ftplocal.php?speek=$speek','fr3','status=yes,scrollbars=yes,menubar=yes,resizable=yes,location=yes,width=800,height=560,left=10,top=10')>
".$lang[25]."</a></li>$moderem2<li><a href=\"#htmlcode\" onClick=javascript:window.open('admin/ftptask.php?speek=$speek','fr4','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>
".$lang[26]."</a></li>";
if ($smod=="shop") {
if ($stinfo=="ext") {
$admin_url.="$moderem1<!--li><a href=\"#htmlcode\" onClick=javascript:window.open('admin/sklad/import_sklad.php?speek=$speek','fr4','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>
".$lang[27]."</a></li-->$moderem2";
}
}
if ($view_avatara==1) {
$admin_url.="<br><br><b>
".$lang[414].":</b> <br><li><a href=\"#avatara\" onClick=javascript:window.open('admin/avatara/index.php?speek=$speek','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=560,left=10,top=10')>
".$lang[412]."</a></li>
<li><a href=\"#avatara\" onClick=javascript:window.open('admin/avatara/qadm.php?speek=$speek','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=560,left=10,top=10')>
".$lang[415]."</a></li>
<li><a href=\"#avatara\" onClick=javascript:window.open('admin/avatara/q.php?speek=$speek','fr1','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=560,left=10,top=10')>
".$lang[416]."</a></li>";
}
if ($smod=="shop") {
$admin_url.="$moderem1<br><br><b>
".$lang[28].":</b> <br><!--li><a href=\"#clear_base\" onClick=javascript:window.open('admin/clearbase.php?speek=$speek','fr3','status=yes,scrollbars=yes,menubar=yes,resizable=yes,location=yes,width=500,height=560,left=10,top=10')>
".$lang[29]."</a></li-->
<!--li><a href=\"#photo_renamer\" onClick=javascript:window.open('admin/photo_renamer.php?speek=$speek','fr3','status=yes,scrollbars=yes,menubar=yes,resizable=yes,location=yes,width=500,height=560,left=10,top=10')>
".$lang[854]."</a></li-->
<!--li><a href=\"#photo_thumb\" onClick=javascript:window.open('admin/photo_thumb.php?speek=$speek','fr3','status=yes,scrollbars=yes,menubar=yes,resizable=yes,location=yes,width=500,height=560,left=10,top=10')>
".$lang[865]."</a></li-->
<!--li><a href=\"#watermark\" onClick=javascript:window.open('admin/watermark.php?speek=$speek','fr3','status=yes,scrollbars=yes,menubar=yes,resizable=yes,location=yes,width=400,height=380,left=10,top=10')>
".$lang[853]."</a></li-->
<li><a href=\"#MySQL\" onClick=javascript:window.open('admin/mysql_migrate.php?speek=$speek','fri2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=550,height=400,left=10,top=10')>Migrate Files-&gt;MySQL</a><br>
<div class=round>Please note all saved info in `".$dbpref."_items`, `".$dbpref."_users` will be <b>deleted</b>!</div></li>
$moderem2
<br><br><b>

".$lang[873].":</b><br><li><a href=\"#MySQL\" onClick=javascript:window.open('admin/mysql_create_base.php?speek=$speek','fri2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=550,height=400,left=10,top=10')>$lang[3] (Files-&gt;MySQL)</a></li>
<li><a href=\"$base_file\">TXT</a></li>
<li><a href=\"yml.php?speek=$speek&currency=$valut&token=".md5($secret_salt.$htpath)."\">Yandex YML</a></li>
<li><a href=\"mgxml.php?speek=$speek&currency=$valut&token=".md5($secret_salt.$htpath)."\">Market GID</a></li>
<li><a href=\"gxml.php?speek=$speek&currency=$valut&token=".md5($secret_salt.$htpath)."\">Google XML</a></li>
<li><a href=\"cesxml.php?speek=$speek&currency=$valut&token=".md5($secret_salt.$htpath)."\">CesXML</a></li>$moderem1<br><br><b>
".$lang[874].":</b>
<li><a href=\"#MySQL IMPORT from ANY table\" onClick=javascript:window.open('admin/mysql_import.php?speek=$speek','imp2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=550,height=400,left=10,top=10')>Any MySQL Table-&gt;FileDB</a></li>
<li><a href=\"#MySQL_import\" onClick=javascript:window.open('admin/mysql_import_base.php?speek=$speek','fri3','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=550,height=400,left=10,top=10')>$lang[322] (MySQL-&gt;Files)</a></li>
<li><a href=\"#TXT_import\" onClick=javascript:window.open('admin/import.php?speek=$speek','fri','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>TXT-file</a></li>
<li><a href=\"#YML_import\" onClick=javascript:window.open('admin/yml_import.php?speek=$speek','fri2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>YML-URL</a></li>
<li><a href=\"#XML_import\" onClick=javascript:window.open('admin/xml_import.php?speek=$speek','fri3','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')>XML-URL</a></li>$moderem2";
}
$admin_url.="<br><img src=images/pix.gif height=1 width=180></td></tr></table>";
?>
