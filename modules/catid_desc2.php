<?php
//Выведем описания категорий//
$catid_content2 = "";
$catid_title2 = "";
$desc_file2=$catid;
if (($unifid=="")&&($item_id=="")) {
if ($catid=="_"):$desc_file2="0000"; endif;
if ("$catid"=="0"):$desc_file2="0000"; endif;
}
//If you wish include decription
if (@file_exists("$base_loc/content/z__".@$desc_file2.".txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/z__".@$desc_file2.".txt" , "r");
$catid_content2 = fread($pageopen, filesize("$base_loc/content/z__".@$desc_file2.".txt"));
$con=$catid_content2; $poll_exp="</div>"; require "./modules/mod_poll.php"; $catid_content2=$con;
if (preg_match("/==(.*)==/i", $catid_content2, $output)) {
$catid_title2=$output[1];
} else {
$catid_title2 = "";
}
fclose ($pageopen);
if (($valid=="1")&&($details[7]=="ADMIN")): $catid_content2="<div align=right><span class=\"label\" title=\"".$mpz['file']."\" style=\"height:19px; margin-bottom:10px;\">z__$catid</span> <a class=\"btn\" href=#edit onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../.".$base_loc."/content/z__".@$desc_file2.".txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['edits']."\"><i class=\"icon-edit icon-large\"></i></a>&nbsp;<a class=\"btn\" href=#del onClick=javascript:window.open('admin/editor/edit.php?speek=".$speek."&c=z__".@$desc_file2."&del=z__".@$desc_file2."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') title=\"".$lang['del']."\"><i class=\"icon-remove icon-large\"></i></a></div>".$catid_content2; endif;

$catid_content2=str_replace("==$catid_title2==", "" , $catid_content2);
} else {
if ($desc_file2!="0000") {
if (($valid=="1")&&($details[7]=="ADMIN")){
$catid_title2="$catid"; $catid_content2="<div style=\"width:auto;\" align=center><a href=\"#indexator\" class=\"btn pull-left ml\" onClick=\"javascript:window.open('$htpath/admin/".$scriptprefix."indexator.php?speek=".$speek."','fr2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=520,height=560,left=10,top=10');\" style=\"font-size: 10px;\">".$lang['adm1']."</a><a href=\"#new_description2\" class=\"btn pull-left ml\" onClick=\"javascript:window.open('$htpath/admin/editor/edit.php?speek=$speek&create_file=z__".@$desc_file2."','fr2','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\" style=\"font-size: 10px;\">".$lang[878]."-2</a><a href=\"#additional_cols\" class=\"btn pull-left ml\" onClick=\"javascript:document.location.href='$htpath/index.php?action=template&nt=templates/$template/$speek&t=cc_".@$desc_file."';\" style=\"font-size: 10px;\">".$lang[1532]."</a><div class=clearfix></div></div>";
}
}
}
unset ($pageopen, $output);
//end

?>
