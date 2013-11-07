<?php 
require "./modules/x0007.php";
topwo("", $x0007, $style ['center_width'], $nc0, $nc0, 4,0,"[x0007]");
if (($action!="forum")&&($action!="sendmail")) {

//if ($mod!="admin"){
if (@file_exists("$base_loc/content/x0003.txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/x0003.txt" , "r");
$page_content = @fread($pageopen, @filesize("$base_loc/content/x0003.txt"));
if (preg_match("/==(.*)==/i", $page_content, $output)) {$page_title=$output[1];} else {$page_title = $lang[221];}fclose ($pageopen);
$x0003= str_replace("==$page_title==", "" , $page_content);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$x0003="<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">x0003</span> <a class=\"btn\" href=#edit onClick=\"javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/x0003.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=\"btn\" href=#del onClick=\"javascript:window.open('admin/editor/edit.php?speek=".$speek."&amp;c=x0003&amp;del=x0003','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>".$x0003;
}
}
unset ($page_content, $page_title, $pageopen);

}
//}
}

?>
