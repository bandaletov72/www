<?php
$widget="";
if ((!isset($_SESSION["exit_box"]))||($_SESSION["exit_box"]=="")){
$widget="<script language=javascript>
var qty=0;
function exit_dialog() {
if (qty==0) {
document.getElementById('exit_dialog').style.visibility='visible';
document.getElementById('exit_dialog').style.display='inline';
}
qty++;
}
function exit_dialog_close() {
$.ajax({
type: \"POST\",
url: \"exit_box.php\",
data: \"read=1&session=$sid\",
success: function(msg){
$(document).ready(function() {
document.getElementById('exit_dialog').style.visibility='hidden';
document.getElementById('exit_dialog').style.display='none';
document.getElementById('exit_dialog_but').style.visibility='hidden';
document.getElementById('exit_dialog_but').style.display='none';
});
}
});
}
</script>";
$widget_close_button="<button type=\"button\" class=\"close\" onclick=\"javascript:exit_dialog_close();\" style=\"font-size: 20pt; margin-left: 10px;\">&times;</button>";

if (@file_exists("$base_loc/content/x0008.txt")==TRUE) {
$pageopen = fopen ("$base_loc/content/x0008.txt" , "r");
$con = @fread($pageopen, @filesize("$base_loc/content/x0008.txt"));
if (preg_match("/==(.*)==/i", $con, $output)) {$x0008_title=$output[1];} else {$x0008_title = $lang[221];}fclose ($pageopen);
$con= str_replace("==$x0008_title==", "" , $con);
$poll_exp="</div>"; require "./modules/mod_poll.php"; $x0008=$con;

unset ($con);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$x0008="<div class=pull-right><a href=\"#edit\" class=btn onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&amp;working_file=../.".$base_loc."/content/x0008.txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=580,left=10,top=10')><i class=icon-edit></i> ".$lang['ch']."</a>&nbsp;<a href=\"#delete\" class=btn onClick=javascript:window.open('admin/editor/edit.php?speek=".$speek."&amp;c=x0008&amp;del=x0008','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=580,left=10,top=10')><i class=icon-remove></i> ".$lang['del']."</a></div>".$x0008;
}
}
unset ($viewpage_content, $x0008_title, $pageopen);

$widget.="<div id=exit_dialog_but style=\"position: fixed; width: 100%; height: 20px; top: 0px; left:0px; z-index:99997;\" onmouseover=\"javascript:exit_dialog();\"></div>
<div class=hidden id=exit_dialog style=\"position: fixed; background: rgba(0,0,0,0.6); width: 100%; height: 100%; top: 0px; left:0px; z-index:99998; vertical-align:middle;\" onclick=\"javascript:exit_dialog_close();\"><table width=100% height=100% border=0 cellspacing=0 cellpadding=30><tr><td valign=middle align=center><div class=shadow align=center style=\"z-index:99999; background: $nc0; color:$nc5; width:50%; padding:20px 20px 20px 20px;\">$widget_close_button"."$x0008</div></td></tr></table></div>";

} else {
$widget.="<div id=exit_dialog_but style=\"position: fixed; width: 100%; height: 20px; top: 0px; left:0px; z-index:99997;\" onmouseover=\"javascript:exit_dialog();\"></div>
<div class=hidden id=exit_dialog style=\"position: fixed; background: rgba(0,0,0,0.6); width: 100%; height: 100%; top: 0px; left:0px; z-index:99998;\" onclick=\"javascript:exit_dialog_close();\"><table width=100% height=100% border=0 cellspacing=0 cellpadding=30><tr><td valign=middle align=center><div class=shadow align=center style=\"z-index:99999; background: $nc0; color:$nc5; vertical-align:middle; width:50%; height:250px; padding:20px 20px 20px 20px;\">$widget_close_button"."<br><br><br><br><br><br>".$lang[1560]."<br><br><a href=\"#a\" class=\"btn\" onclick=\"javascript:window.open('$htpath/admin/editor/edit.php?speek=".$speek."&create_file=x0008','x0008','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=580,left=10,top=10')\" style=\"font-size: 10px;\"><i class=icon-leaf></i> $lang[1561]</a></div></td></tr></table></div>";
}
if ($usetheme==1) {
$themecontent=str_replace("[widgets]", "$widget"."[widgets]",$themecontent);
} else {
echo $widget;
}
}
?>
