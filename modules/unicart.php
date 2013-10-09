<?php
if (!isset($days_to_expire_prices)){ $days_to_expire_prices=1; }
if (!isset($addopt)) {$addopt=0;}
$added=0;
if ($mnogo==0) {

if ((!@$unifid) || (@$unifid=="")): $unifid=""; endif;
if ((!@$ctext) || (@$ctext=="")): $ctext=""; endif;
if ((!@$cact) || (@$cact=="")): $cact=""; endif;
if ((!@$del_com) || (@$del_com=="")): $del_com=0; endif;
$cartlist="";
$foundunif=0;
$cart_title="";
$cartlist_total=0;
$file="$base_file";
//echo $unifid;
if ($mancatid=="") {
$file="$base_file";
} else {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) {
if ($admin_speedup==1) {
$file="$base_loc/items/$mancatid.txt";
}
}}
if ($item_speedup==1) {
$file="$base_loc/items/$mancatid.txt";
}
}
if (!@file_exists($file)) {$file="$base_file";}

$sc=0;
$fofid=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$tmpmsf=explode("|",$st);

$tmpfid=md5(@$tmpmsf[3]." ID:".@$tmpmsf[6]);

$sc+=1;
if ($unifid==$tmpfid) {

$fofid=1;
$fid=$sc;
$r=@$tmpmsf[1];
//echo $tmpmsf[4]."<br>";
$sub=@$tmpmsf[2];
$repcatid=@$podstava["$r|$sub|"];
$foundunif=1;

break;
}
}
fclose($f);

if ($fofid==0){$fid=1; $unifid="";}
} else {

if ($mnogo==1) {




$file="$base_file";
$sc=0;
$fofid=0;
$f=fopen($file,"r");
while(!feof($f)) {
$st=fgets($f);
$tmpmsf=explode("|",$st);

$tmpfid=md5(@$tmpmsf[3]." ID:".@$tmpmsf[6]);
$prcur=@$tmpmsf[4];
$sc+=1;
reset ($oldunifids);
while (list ($key_unifids, $st_unifids) = each ($oldunifids)) {

if ($st_unifids==$tmpfid) {
//echo $st_unifids."<br>";
$options="";


$fid=$sc;
$r=@$tmpmsf[1];
$sub=@$tmpmsf[2];
$repcatid=@$podstava["$r|$sub|"];
//$tmpmsf[4]=$okr*(round(($tmpmsf[4]*$kurs)/$okr));
$minproc=0;
if (($podstavas["$r|$sub|"]!="")||(preg_match("/\%/", @$tmpmsf[8])==TRUE)) {

$strtoma=Array();
$strtoma=explode("%",@$tmpmsf[8]);
$strto=@$strtoma[0];
unset($strtoma);

if ((preg_match("/\%/", @$tmpmsf[8])==TRUE)&&(doubleval($strto)>0)) {$minproc=($tmpmsf[4]*(doubleval($strto))/100);} else {$strto=doubleval($podstavas["$r|$sub|"]); $minproc=($tmpmsf[4]*((double)$podstavas["$r|$sub|"])/100);}} else {
if (($valid=="1")&&($details[7]=="VIP")): $minproc=$tmpmsf[4]*$vipprocent; endif;
}




$fi="";
$fi= @str_replace("' border=0>","", str_replace("<img src='", "", str_replace("$htpath", "",  stripslashes(@$tmpmsf[9]))));
if (@file_exists(".$fi")){
$maxw=$style['spec_w'];
$imagesz = @getimagesize(".$fi");
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
$wh="width=".$maxw." height=".$widt;

} else{
$wh="width=".$style['spec_w']." height=".$style['spec_h'];
}
unset($fi);
@$tmpmsf[9]=str_replace("<img ", "<img align=\"left\" title=\"".$tmpmsf[3]."\" $wh ", @$tmpmsf[9]);
@$tmpmsf[9]=str_replace("border=0", "border=1 hspace=3 style=\"border: 1 solid ".$style['nav_col1']."\"", @$tmpmsf[9]);

$tmpmsf[9]=str_replace("width= height= ", "", $tmpmsf[9]);
$error="";
if ($zero_price_incart==0){ if ($tmpmsf[4]==0) {$error=$lang['file'].": <b>".$tmpmsf[3]."</b> ".$lang[222]." E11<br>"; }}
if (substr($tmpmsf[12],0,1)=="0") { $error=$lang['file'].": <b>".$tmpmsf[3]."</b> ".$lang[222]." E12<br>";}

if ($error==""){
$_SESSION["user_basket"]="ok";
if (!isset($tmpmsf[$netweight])) {$tmpmsf[$netweight]=$def_weight;}
if (($tmpmsf[$netweight])=="") {$tmpmsf[$netweight]=$def_weight;}
if (($tmpmsf[$netweight])=="0") {$tmpmsf[$netweight]=$def_weight;}
if (($tmpmsf[$netweight])==0) {$tmpmsf[$netweight]=$def_weight;}

if (!isset($tmpmsf[$box_volume])) {$tmpmsf[$box_volume]=0;}
if (($tmpmsf[$box_volume])=="") {$tmpmsf[$box_volume]=0;}
if (($tmpmsf[$box_volume])=="0") {$tmpmsf[$box_volume]=0;}
if (($tmpmsf[$box_volume])==0) {$tmpmsf[$box_volume]=0;}

$oldoption[$key_unifids]=str_replace("<br><br>","<br>",str_replace("<br><br>","<br>",$oldoption[$key_unifids]));

$cart->add_item($st_unifids."|",$oldqtys[$key_unifids],($tmpmsf[4]-$minproc),@$tmpmsf[3]." ID:".@$tmpmsf[6], $sc, "","", @$tmpmsf[9], @$tmpmsf[5], substr(@$tmpmsf[12],1,3) , $tmpmsf[$netweight], trim($st),$speek, $tmpmsf[$box_volume]);

$added=1;

}
}
if ($added==0) {
$_SESSION["user_basket"]="ok";
@unlink ("./admin/userstat/".@$details[1]."/user.basket");
}
}
unset($tmpmsf,$tmpmsfart,$add_it);
}
fclose($f);




}
}
if ($added==1) {$tit=$lang[209]." - "; $catid=""; $r=""; $sub=""; $action="basket";}

?>
