<?php
if (!isset($_SESSION["search_time"])) {
$_SESSION["search_time"]=(time()-$sec_between_search);
}
$secon=($_SESSION["search_time"]+$sec_between_search);
if ($catbut_css_style==1) { $bheight=10; }
if (isset($_GET['item_id'])) { $item_id=$_GET['item_id']; } elseif(isset($_POST['item_id'])) { $item_id=$_POST['item_id']; } else { $item_id=""; }
if (!preg_match('/^[0-9a-zA-Z_-]+$/i',$item_id)) { $item_id="";}
if (
($action=="template")||
($action=="setsales")||
($action=="insales")||
($action=="allbrands")||
($action=="view_cmenu")||
($action=="replacer")||
($action=="recalc")||
($action=="doubles")||
($action=="topindex")||
($action=="dircolors")||
($action=="tagindex")||
($action=="view_users")||
($action=="view_baskets")||
($action=="orderstats")||
($action=="vacancy")||
($action=="clear_h")||
($action=="forum_admin")||
($action=="htaccess")||
($action=="zakaz")||
($action=="send")||
($action=="sendok")||
($action=="basket")||
($action=="edit")||
($action=="addtospec")||
($action=="clear")||
($action=="sendmail")||
($action=="forum")||
($action=="blog")||
($action=="cl")||
($action=="cl_add")||
($action=="reg_partner")||
($action=="price")||
($zak!="")||
($action=="cabinet")||
($action=="sales")||
($action=="folderimg")||
($action=="brandimg")||
($action=="vars")||
($action=="colors")||
($action=="del")||
($action=="cladm")||
($action=="arch")||
($action=="gal")||
($action=="restore")||
($action=="older")||
($action=="allinone")||
($action=="poz")||
($action=="thtml")||
($action=="tags")||
($action=="viewcomm")||
($action=="partners")||
($action=="tag_index")||
($action=="cat_index")||
($action=="cat_admin")||
($action=="cat_search")||
($action=="cat")||
($action=="userinfo")||
($action=="userlist")||
($action=="inbox")||
($action=="contragent")||
($register==1)||
($page!="")||
($sign_in==1)||
($action=="avatar")||
($action=="stat_worktime")
) {
$mod="admin";
if ($page!=""){
if ($view_left_menu_page==1) {
$leftmenu=1;
$links_to_bottom=0;
}
} else {
$leftmenu=0;
if ($affix==1) { $leftmenu=1; $links_to_bottom=0;}
}
} else {
if ($view_left_menu_homepage==0) {
if (($query=="")&&($unifid=="")&&($item_id=="")&&($catid=="0")&&($action=="")){
$leftmenu=0;
if ($affix==1) { $leftmenu=1; $links_to_bottom=0;}
}
} else {
if (($query=="")&&($unifid=="")&&($item_id=="")&&($catid=="0")&&($action=="")){
$incart_menu=1;
$leftmenu=1;
$links_to_bottom=0;
}
}
}
if ($action=="vacancy") {$mod="admin"; $tit=$lang[1021]." - ";}
if ($smod=="site") {$choosecurrency="";}
if ($theme_file!="") {
$leftmenu=1;
$incart_menu=1;
}

if (($view_left_menu_page==0) && ($view_itemsmenu_page==0) &&($page!="")) {$leftmenu=0; $links_to_bottom=1; }
if (("$item_id"!=="")||("$unifid"!="")||("$catid"."0"!="0")) {  if ($view_left_menu_page==0)  {  $links_to_bottom=1; } }
?>
