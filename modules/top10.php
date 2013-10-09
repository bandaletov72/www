<?php
$top_10="";
unset($sps);  
$brand_name_total=0;
$file=".$base_loc/brand_name.txt";

$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
if (is_long(($brand_name_total/2)) == "TRUE") {
$backgr = $style ['table_color1'];
} else {
$backgr = $style ['table_color1'];
}
// теперь мы обрабатываем очередную строку $st
$out=explode("|",$st);
if (count($out)<=10): continue; endif;
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
@$nazv=@$out[3];
@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);
@$brand_name=@$out[13];
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
@$kolvo=@$out[16];
$top_10 .= "<!-- $nazv --><a href=\"" . $htpath . "/index.php?action=viewcart&cart_id=$file\">$foto1</a><br><small><b><a href=\"" . $htpath . "/index.php?action=viewcart&cart_id=$file\">" . $nazv . "</a></b><br>$description<br>".$lang['price'].": <b>$price</b>$valut</small><br><br>\n";
$brand_name_total+=1;

}

fclose($f);
?>

