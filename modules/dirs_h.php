<?php
//Выведем категории//
$dirs_h_content = "";
$dirs_h_title = "";
//If you wish include decription
if ((@file_exists("$base_loc/dirs_h.txt")==TRUE)) {
$pageopen = fopen ("$base_loc/dirs_h.txt" , "r");
if ($repcatid!="") {
$dirs_h_content= str_replace("$repcatid\" style=\"color:".$style['nav_col2']."\"", "$repcatid\" style=\"color:".$style['nav_col1'].";font: bold\"", (fread($pageopen, filesize("$base_loc/dirs_h.txt"))));
} else {
$dirs_h_content =fread($pageopen, filesize("$base_loc/dirs_h.txt"));
}
fclose ($pageopen);
}
unset ($pageopen, $output);
//end

?>
