<?php
if (!isset($days_to_expire_prices)){ $days_to_expire_prices=1; }
$added=0;
$add_query="";
$file=$dbpref."_items_".$speek;
if ($mnogo==0) {
if ((!@$unifid) || (@$unifid=="")): $unifid=""; endif;
if ((!@$ctext) || (@$ctext=="")): $ctext=""; endif;
if ((!@$cact) || (@$cact=="")): $cact=""; endif;
if ((!@$del_com) || (@$del_com=="")): $del_com=0; endif;
$cartlist="";
$foundunif=0;
$cart_title="";
$cartlist_total=0;
$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());

$sc=0;
$fofid=0;
//if ($brand!="") {$add_query.=" AND `brand`='".mysql_real_escape_string(@$brand)."'"; }
if ($view_deleted_goods==0) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {
$add_query.=" AND `on_offer`='1'";
}
}
//echo $mysql_query;
$mysql_query="SELECT * FROM $file WHERE (`unifid`='".mysql_real_escape_string(@$unifid)."' $add_query) LIMIT 1";
//echo $mysql_query;
$result=mysql_query("$mysql_query");

while($row = @mysql_fetch_row($result)) {
$st="";
while(list($k,$v)=each($row)) {
//echo $k."=>".$v."<br>";
if ($k>9) {
$st.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";

}
}

$tmpmsf=explode("|",$st);
$tmpfid=md5(@$tmpmsf[3]." ID:".@$tmpmsf[6]);
$sc+=1;
$fofid=1;
$fid=$sc;
$r=@$tmpmsf[1];
//echo $tmpmsf[4]."<br>";
$sub=@$tmpmsf[2];
$repcatid=@$podstava["$r|$sub|"];
$foundunif=1;


}
//$cart->add_item($st_unifids."|".$options,$oldqtys[$key_unifids],($tmpmsf[4]+$addopt-$minproc),@$tmpmsf[3]." ID:".@$tmpmsf[6], $sc, $options,$optius2, @$tmpmsf[9], @$tmpmsf[5], substr(@$tmpmsf[12],1,3)  , $tmpmsf[$netweight], trim($st),$speek, $tmpmsf[$box_volume]);

mysql_close($mysqldb);


} else {
//add many positions to cart
if ($mnogo==1) {

$mysqldb = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Item list. Error-1 ".mysql_error());

$sc=0;
$fofid=0;
reset ($oldunifids);
$addq="";
while (list ($key_unifids, $st_unifids) = each ($oldunifids)) {
$addq.=" OR `unifid`='".mysql_real_escape_string(@$st_unifids)."'";
}
$add_query.=" WHERE (`unifid`=''".$addq.")";

//echo $mysql_query;
$mysql_query="SELECT * FROM $file"."$add_query";
//echo $mysql_query;
$result=mysql_query("$mysql_query");

while($row = mysql_fetch_row($result)) {
$st="";
while(list($k,$v)=each($row)) {

//echo $k."=>".$v."<br>";
if ($k>9) {
$st.=str_replace("\n","<br>", str_replace("\r", "<br>",str_replace("|", " ", $v)))."|";
}
}
$tmpmsf=explode("|",$st);

$tmpfid=md5(@$tmpmsf[3]." ID:".@$tmpmsf[6]);
$prcur=@$tmpmsf[4];
$sc+=1;
reset ($oldunifids);

while (list ($key_unifids, $st_unifids) = each ($oldunifids)) {
if ($st_unifids==$tmpfid) {

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

if ((preg_match("/\%/", @$tmpmsf[8])==TRUE)&&(doubleval($strto)>0)) {$minproc=($tmpmsf[4]*(doubleval($strto))/100);} else {$minproc=($tmpmsf[4]*((double)$podstavas["$r|$sub|"])/100);}} else {
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

} else {
$wh="width=".$style['spec_w']." height=".$style['spec_h'];
}
unset($fi);
@$tmpmsf[9]=str_replace("<img ", "<img align=\"left\" title=\"".$tmpmsf[3]."\" $wh ", @$tmpmsf[9]);
@$tmpmsf[9]=str_replace("border=0", "border=1 hspace=3 style=\"border: 1 solid ".$style['nav_col1']."\"", @$tmpmsf[9]);

$tmpmsf[9]=str_replace("width= height= ", "", $tmpmsf[9]);
$error="";
if ($zero_price_incart==0){ if ($tmpmsf[4]==0) {$error=$lang['file'].": <b>".$tmpmsf[3]."</b> ".$lang[222]." E9<br>"; }}
if (substr($tmpmsf[12],0,1)=="0") { $error=$lang['file'].": <b>".$tmpmsf[3]."</b> ".$lang[222]." E10<br>";}

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
if (filemtime($nazvolder)<($days_to_expire_prices*24*60*60)) {
$cart->add_item($st_unifids."|",$oldqtys[$key_unifids],($tmpmsf[4]-$minproc),@$tmpmsf[3]." ID:".@$tmpmsf[6], $sc, "","", @$tmpmsf[9], @$tmpmsf[5], substr(@$tmpmsf[12],1,3) , $tmpmsf[$netweight], trim($st),$speek, $tmpmsf[$box_volume]);
if (($okr*round(($oldprice[$key_unifids]*$kurs)/$okr))!=($okr*round((($tmpmsf[4]+$addopt-$minproc)*$kurs)/$okr))) {$error.=$lang['file'].": <b>".$tmpmsf[3]."</b>. ".$lang[294]." ".$lang[295]." <b>".($okr*round(($oldprice[$key_unifids]*$kurs)/$okr))."</b>".$currencies_sign[$_SESSION["user_currency"]].", ".$lang[296]." <b>".($okr*round((($tmpmsf[4]+$addopt-$minproc)*$kurs)/$okr))."</b>".$currencies_sign[$_SESSION["user_currency"]]." ".$lang[297]."<br>";}
} else {
$cart->add_item($st_unifids."|".$oldoption[$key_unifids],$oldqtys[$key_unifids],$oldprice[$key_unifids],@$tmpmsf[3]." ID:".@$tmpmsf[6], $sc, $oldoption[$key_unifids],$oldoption2[$key_unifids], @$tmpmsf[9], @$tmpmsf[5], substr(@$tmpmsf[12],1,3) , $tmpmsf[$netweight], trim($st),$speek, $tmpmsf[$box_volume]);
}
$added=1;

}
}

}
unset($tmpmsf,$tmpmsfart,$add_it);
}
mysql_close($mysqldb);


}
}

if ($added==1) {$tit=$lang[209]." - "; $catid=""; $r=""; $sub=""; $action="basket";}

?>