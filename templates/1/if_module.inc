<?php

if (isset($_GET['usernik'])) { $usernik=$_GET['usernik']; } elseif(isset($_POST['usernik'])) { $usernik=$_POST['usernik']; } else { $usernik=""; }
if (!preg_match('/^[0-9a-zA-Z_-]+$/i',$usernik)) { $usernik="";}

if ($portal==1) {
if (($valid=="1")&&($details[7]!="")) {
//portal mod registered personel only
if ($action=="inbox")  {
require ("./modules/inbox.php");
top("", "$inbox_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="contragent")  {
require ("./modules/contragent.php");
top("", "$kontrag_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="userlist")  {
require ("./modules/userlist.php");
top("", "$user_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="stat_worktime") {
require ("./modules/stat_worktime.php");
top("", "$wttabs", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="stat_orders") {
require ("./modules/stat_orders.php");
top("", "$wttabs", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}

}
}





if ($valid=="1") {
if ($details[7]!="") {
//All registered users only not guests
if ($action=="cabinet") {
require ("./modules/cabinet.php");
top("", "$cabinet", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="avatar") {
require ("./modules/avatar.php");
top("", "<h4>$lang[1125]</h4>$lang[1126]<br>$avatars", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
}
if ($details[7]=="ADMIN") {
//Admins only
if ($action=="colors") {
require ("./admin/colorizer.php");
top("", "<h4>Site Color Editor</h4>$site_colors", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="htaccess") {
require ("./admin/htaccess.php");
top("", "<h4>Admin directory pass</h4>$hta", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="template") {
require ("./admin/edit_template.php");
top("", "<h4>".$lang['edit_templates']."</h4>$template_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
}


if(($details[7]=="ADMIN")||($details[7]=="MODER")){
//Admins and moderators only
if ($action=="folderimg"){
require ("./admin/edit_folderimg.php");
top("", "<h4>Catalogue pics</h4>$folderimg_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="brandimg") {
require ("./admin/edit_brands.php");
top("", "<h4>Brands Images</h4>$brandimg_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="dircolors") {
require ("./admin/edit_dircolors.php");
top("", "<h4>Color bookmarks</h4>$dircolors_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="orderstats") {
require ("./admin/stat.php");
top("", "<h4>$lang[13]</h4>$basket_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="sales") {
require ("./admin/edit_sales.php");
top("", "<h4>Sale</h4>$sales_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="poz") {
require ("./admin/edit_poz.php");
top("", "<h4>Product list order</h4>$sales_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="view_users") {
require ("./admin/users.php");
top("", "<h4>".$lang['adm5']."</h4>$user_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="userip") {
require ("./admin/stat_ip.php");
top("", "<h4>".$lang[13]." IP</h4>$ip_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="viewcomm") {
require ("./admin/comments.php");
top("", "<h4>".$lang[183]."</h4>$c_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="view_cmenu") {
require ("./admin/cmenu.php");
top("", "<h4>".$lang[4]."</h4>$links_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="view_baskets") {
require ("./admin/basket.php");
top("", "<h4>".$lang['adm4']."</h4>$basket_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="replacer") {
require ("./admin/replacer.php");
top("", "<h4>$lang[5]</h4>".@$replace_list, $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="recalc") {
require ("./admin/recalc.php");
top("", "<h4>$lang[869]</h4>".@$replace_list, $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="tags") {
require ("./admin/tag_admin.php");
top("", "<h4>$lang[132]</h4>$tags_admined", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="thtml") {
require ("./admin/list_thtml.php");
top("", "<h4><h4>$lang[136]</h4></h4>$thtml_admined", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="tagindex") {
require ("./admin/tag_index.php");
top("", "<h4>$lang[133]</h4>$tags_admined", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="topindex") {
require ("./admin/top10_index.php");
top("", "<h4>Index Top10:</h4>$items_admined", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}
if ($action=="partners") {
require ("./admin/partner_admin.php");
top("", "$partners_admined", $style ['center_width'], $nc0, $nc0, 4,1,"[content]");
}
if ($action=="view_links") {
require ("./admin/links.php");
top("", "<h4>Links Admin</h4>$links_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}

}
}


//all users include guests actions

if ($action=="price")  {
require ("./modules/inprice.php");
top("", "$inprice", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}

if (($action=="userinfo")&&($usernik!=""))  {
require ("./modules/userinfo.php");
top("", "$userinfo", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}

if ($action=="allnews") {
require ("./modules/allnews.php");
top("", $latestnews, $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}

if ($action=="links") {
require ("./modules/links.php");
top("", "<h4>Links / $search_r</h4>$ulinks_list", $style ['center_width'], $nc0, $nc0, 1,1,"[content]");
}


if ($action=="reg_partner") {
require ("./modules/reg_partner.php");
top("", "$regp_list", $style ['center_width'], $nc0, $nc0, 4,1,"[content]");
}
if ($action=="blog") {
$fold="./blog";
require ("./blog/".$bscriptprefix."blog.php");
top("", "$blog_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}

if (($action=="cl")||($action=="cl_add")) {
$fold="./classifieds";
require ("./classifieds/classifieds.php");
top("", "$cl_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
if ($action=="vacancy") {
require ("./modules/vacancy.php");
top("", "$vacancy_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
}
$catincl=0;
if (($action=="cat")||($action=="cat_index")||($action=="cat_admin")||($action=="cat_search")) {
topwo("", "$cat_list", $style ['center_width'], $nc0, $nc0, 1,0,"[content]");
} else {
if ($cat_on_firstpage!=1) {
if ($catmenu_on_eachpage==1) {
if (file_exists("./cat/catcat.php")==true) {
topwo("", "$printcat", "100%",  $nc0, $nc0 , "noshadow",1, "[catcat]");
}
}
}
}
?>
