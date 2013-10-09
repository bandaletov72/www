<?php
$fbmeta="";
if ($action=="price")  { if ($theme_file!="") { $leftmenu=1;} $tit=$lang[47]." - ".date("d M Y / H:i  ", time()); }
if ($portal==1) {
$lang[471]=$lang[1467];
$lang[472]=$lang[1468];
$lang[473]=$lang[1469];
$lang[474]=$lang[1470];
$lang[72]=$lang[1471];
$lang[167]=$lang[1472];
}


if ($cat!="") { if (substr($action,0,3)!="cat") {$action="cat"; } }
$ptitul="";
$catincl=0;
if (($action=="cat")||($action=="cat_index")||($action=="cat_admin")||($action=="cat_search")) {
$fold="./cat";
$catincl=1;
require ("./cat/mod_cat.php");
} else {
if ($cat_on_firstpage!=1) {
if (file_exists("./cat/catcat.php")==true) {
if ($catmenu_on_eachpage==1) {
require ("./cat/catcat.php");
}
}
}
}
if ($usetheme==1) {
if ($ptitul!=""){
$themecontent=str_replace("[title]","<h1>$ptitul</h1>",$themecontent); //title of page
}
}

?>
