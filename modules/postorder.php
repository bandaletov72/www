<?php
/*
Module after checkout before webcart clearing
You may use this data

Array:
$details(
0 => USERTYPE,
1 => USER_NICKNAME,
2 => USERPASS,
3 => USER_NAME,
4 => USER_EMAIL,
5 => USER_TEL_NUM,
6 => USER_REG_DAATE USER_IP REFFERAL_SITE,
7 => USER_STATUS,
8 => USER_METRO_ST,
9 => USER_STREET_ADR,
10 => USER_HOUSE_NUM,
11 => USER_HOUSE_NUM2,
12 => USER_ENTRANCE_NUM,
13 => USER_DOOR_PHONE_NUM,
14 => USER_FLOOR,
15 => USER_FLAT_NUM,
16 => USER_OTHER_INFO,
17 => USER_CITY,
18 => USER_COUNTRY,
19 => USER_TEL_CODE,
);

useful variables:
$cart->itemcount
$cart->totalweight
$cart->totalvolume
$cart->itemstuks
$cart->total

Usefull functions:
$cart->empty_cart();

Example to read cart:
$items=$cart->get_all();
foreach($items as $item) {
$o=explode("|", $item['base']);
$unifid=md5(@$o[3]." ID:".@$o[6]);
...do something...
}

$item(
'base' => Item base stroke (imploded by | sign)
'qty' => QTY
'weight' => 1 ITEM WEIGHT
'subtotalweight' => ITEM WEIGHT SUBTOTAL
'volume' => 1 IEM VOLUME
'subtotalvolume' => ITEM VOLUME SUBTOTAL
'price' =>  ITEM PRICE

}

$kg - KG
$vol - M3
$lang['pcs'] - PCS
$currencies_sign[$_SESSION["user_currency"]] - CURRENCY

Price calculation example:

$pice=($okr*(round($kurs*$item['price']/$okr)));


Path to DB (DB LOCATION):

$base_loc  (ex. './admin/db/db_eng/')


Item status file:

$tunifid=md5(@$o[3]." ID:".@$o[6]);
$statusfile="$base_loc/status/".substr($tunifid,0,2)."/".$tunifid."/status.txt";


Status array:

$statuses=Array();
$statusfile="./templates/$template/$speek/status.inc";
if (file_exists($statusfile)) {
$statuses=file($statusfile);
}

Example of status.inc:

Free
Reserved
Sold
Status4
Status5
etc...


How to echo some text in main stream example:

$verifylist.="<h2>Status changed!</h2>";

*/


//lets change status to reserved
if ($change_status_to_reserved==1) {
$statuses=Array();
$statusfile="./templates/$template/$speek/status.inc";
if (file_exists($statusfile)) {
$statuses=file($statusfile);
}
$status=$statuses[1]; //0-Free, 1-Reserved, 3-Sold
reset($items);
$echo_message="";
foreach($items as $item) {
$o=explode("|", $item['base']);
$tunifid=md5(@$o[3]." ID:".@$o[6]);
$statusfile="$base_loc/status/".substr($tunifid,0,2)."/".$tunifid."/status.txt";
if(is_dir("$base_loc/status")!=true) { mkdir("$base_loc/status",0755); }
if(is_dir("$base_loc/status/".substr($tunifid,0,2))!=true) { mkdir("$base_loc/status/".substr($tunifid,0,2),0755); }
if(is_dir("$base_loc/status/".substr($tunifid,0,2)."/".$tunifid)!=true) { mkdir("$base_loc/status/".substr($tunifid,0,2)."/".$tunifid,0755); }
$sp=fopen($statusfile,"w");
fputs($sp,$status."\n".$details[1]."\n".$details[3]);
fclose ($sp);
$echo_message.= "$lang[397]: <b>".$status."</b><br>";
$sp=fopen($statusfile.".history.txt","a");
fputs($sp,$status."|".time()."|".$details[1]."|".$details[3]."\n");
fclose ($sp);
}

}
?>
