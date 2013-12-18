<?php
$lang[516]="OK";
if (!isset($listing)) {$listing=1;}
$otchet2=0;
$oldnedgod="";
$listmas3=Array();
$listmas4=Array();
$otchet2=Array();
$otchet25=Array();
$posts="<select class=input-small name=\"postpost\">[def]";
if (isset($delivery_metode)) {
while (list ($srrnum, $srrline) = each ($delivery_metode)) {
if (($srrline!="")&&($srrline!="\n")) {
$srmasss=explode("|",$srrline);
if(@$srmasss[5]=="post") {
$posts.="<option value=\"".$srmasss[0]."\">".$srmasss[0]."</option>";
$postindex=$srmasss[0];
$posturl[$postindex]=$srmasss[4];
}
unset ($srmasss);
}
}
reset ($delivery_metode);
$posts.="</select>";
}







$mmet=Array();


$metroarr=file("./templates/$template/$speek/custom_metro.inc");
while (list ($keymet, $stmet) = each ($metroarr)) {
$tempmet=explode("|",$stmet);
$indm=substr(str_replace(" ", "_", strtoken($tempmet[1],"(")),0,-1);
$mmet[$indm]="<img width=10 height=10 src=\"$htpath/pix.gif\" style=\"background-color: $tempmet[0]\">&nbsp;";
}


$blij="";
$bld=0;
while ($bld<=30) {
$styless="";
if ($bld==0) {$styless=" style=\"border: 3px solid #ff6666\"";}
if (date("w", (time()+($bld*86400)))==6) {$styless=" style=\"background-color: #FFCCCC\"";}
if (date("w", (time()+($bld*86400)))==0) {$styless=" style=\"background-color: #FFBBBB\"";}

$blij.="<option$styless>".date("d.m.y", (time()+($bld*86400)))."</option>\n";
$bld+=1;
}

$pred="";
$bld=5;
while ($bld>=0) {
$styless="";
if ($bld==0) {$styless=" style=\"border: 3px solid #ff6666\"";}
if (date("w", (time()-($bld*86400)))==6) {$styless=" style=\"background-color: #FFCCCC\"";}
if (date("w", (time()-($bld*86400)))==0) {$styless=" style=\"background-color: #FFBBBB\"";}

$pred.="<option$styless>".date("d.m.Y", (time()-($bld*86400)))."</option>\n";
$bld-=1;
}

$bld=1;
while ($bld<=31) {
$styless="";
if ($bld==0) {$styless=" style=\"border: 3px solid #ff6666\"";}
if (date("w", (time()+($bld*86400)))==6) {$styless=" style=\"background-color: #FFCCCC\"";}
if (date("w", (time()+($bld*86400)))==0) {$styless=" style=\"background-color: #FFBBBB\"";}

$pred.="<option$styless>".date("d.m.Y", (time()+($bld*86400)))."</option>\n";
$bld+=1;
}
//end


$kuroptions="";
while (list ($keykur, $stkur) = each ($kur)) {

$kuroptions.="<option style=\"background-color: $stkur;\">$keykur</option>";

}
$staterr=0;
$otchets=Array();
$otchets2=Array();
$otchet4=Array();
$otchet5=Array();
$dopp="";
if ($details[7]=="ADMIN") {
$dopp="<option value=516>OK</option>";}
if (!isset($closeweek)){$closeweek="";} if (!preg_match("/^[0-9a-fA-F]+$/i",$closeweek)) { $closeweek="";}
if (($closeweek!="")&&($details[7]=="ADMIN")) {

$staterr=1;
top("", "<br><br>".$lang[600]." ".$lang[599]." $closeweek", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
$file="./admin/baskets/list.txt";
if (!copy($file, $file.".ned")) {
echo "".$lang[601].""; exit;
}
top("", "<br><br>".$lang[602]."", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");


$file="./admin/baskets/list.txt.ned";
$listmas=file($file);

while(list ($keysm,$st) =each ($listmas)) {
$outd=explode("|",$st);
$stamptd=explode(".",$outd[6]);
$mktimer=mktime(0,0,1,doubleval($stamptd[1]),doubleval($stamptd[0]),doubleval($stamptd[2]))-$g;
$g+=1;
$listmas3[$mktimer]=$st;
}
krsort($listmas3);
reset($listmas3);
unset ($keym, $st);
unset($listmas);
if ($listing==2) { $file="./null.txt"; } else {
$file="./admin/baskets/list2.txt"; }
if (@file_exists($file)) {

$listmas=file($file);

while(list ($keysm,$st) =each ($listmas)) {
$outd=explode("|",$st);
$stamptd=explode(".",$outd[6]);
$mktimer=mktime(0,0,1,doubleval($stamptd[1]),doubleval($stamptd[0]),doubleval($stamptd[2]))-$g;
$g+=1;
$listmas4[$mktimer]=$st;
}
krsort($listmas4);
reset($listmas4);
unset ($keym, $st);

//$listmas2=array_merge($listmas3, $listmas4);

unset($listmas);
}

$notclosedw="";
$closedw="";
$curwr="notclosedw";
while(list ($keysm,$st) =each ($listmas3)) {
$out=explode("|",$st);
if ($out[0]==$closeweek) {
$curwr="closedw";
}
$$curwr.=$st;

}


$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs($f3, $closedw.@implode("", @$listmas4)); flock ($f3, LOCK_UN);
fclose($f3);
unset($f3);

$file="./admin/baskets/list.txt.old";
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs($f3, $notclosedw); flock ($f3, LOCK_UN);
fclose($f3);
unset($f3);

if (!copy($file, "./admin/baskets/list.txt")) {
echo "".$lang[601].""; exit;
}

top("", "<br><br>".$lang[604]."<br><br>» <a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&sort=".@$sort."&start=".@$start."&listing=".@$listing."&filter=".@$filter."\"><b>".$lang['back']."</b></a><META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=".$_SERVER['PHP_SELF']. "?action=view_baskets&sort=".@$sort."&start=".@$start."&listing=".@$listing."&filter=".@$filter."\">", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
unset($listmas3,$listmas4);
}

$koluch=2;
$maxdl=300;
$oldned=date("W", time());
if (!isset($filter)) {$filter="";}
$mnow=date("m.Y", time());
$curstamptw=date("w", time());
$curstamptd=date("d", time());
$curstamptm=date("m", time());
$curstampty=date("y", time());
if ($curstamptw==0) {$curstamptw=7;}
$ddd=$curstamptw-1;
$ddd2=$ddd+7;

$prognoz_week=0;
$prognoz_week2=0;
$dost_week2=0;
$dost_week=0;
$totalz=0;
$totald=0;
$totalo=0;
$totalnd=0;
$totalno=0;
$ttl=0;
$pribil=0;
$zay=0;
$perpage=80;

if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$refreshrate) || (@$refreshrate=="")): $refreshrate=""; endif;
if (!isset($refreshrate)){$refreshrate="";} if (!preg_match("/^[0-9]+$/",$refreshrate)) { $refreshrate="";}
if ((!@$savebaskets) || (@$savebaskets=="")): $savebaskets=""; endif;
if (!isset($savebaskets)){$savebaskets="";} if (!preg_match("/^[0-9]+$/",$savebaskets)) { $savebaskets="";}


if ($savebaskets!="") {
$staterr=1;
$file="./admin/baskets/list.txt";
if (!copy($file, $file.".bak")) {
echo "".$lang[601].""; exit;
}
top("", "".$lang[602]."", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");

}
if (!isset($tracknum)){$tracknum="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\?\&\ \%\(\)\/-]+$/i",$tracknum)) { $tracknum="";}

if (!isset($change_status)){$change_status="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\?\&\ \%\(\)\/-]+$/i",$change_status)) { $change_status="";}
if (!isset($change_kur)){$change_kur="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\?\&\ \%\(\)\/-]+$/i",$change_kur)) { $change_kur="";}
if (!isset($add_post)){$add_post=0;} if (!preg_match("/^[0-9]+$/",$add_post)) { $add_post=0;}
if (!isset($add_nakl)){$add_nakl=0;} if (!preg_match("/^[0-9]+$/",$add_nakl)) { $add_nakl=0;}
if (!isset($datum)){$datum="";} if (!preg_match("/^[0-9\.]+$/i",$datum)) { $datum="";}
if (!isset($olddatum)){$olddatum="";} if (!preg_match("/^[0-9\.]+$/i",$olddatum)) { $olddatum="";}
if (!isset($change_name)){$change_name=0;} if (!preg_match("/^[0-9]+$/",$change_name)) { $change_name=0;}
$new_fio=trim(stripslashes(str_replace("<", "", str_replace(">", "", str_replace("\"", "", str_replace("'","",str_replace("\n","[br]",str_replace("\r","",@$new_fio))))))));
$new_info=trim(stripslashes(str_replace("<", "", str_replace(">", "", str_replace("\"", "", str_replace("'","",str_replace("\n","[br]",str_replace("\r","",@$new_info))))))));
$old_fio=trim(stripslashes(str_replace("<", "", str_replace(">", "", str_replace("\"", "", str_replace("'","",str_replace("\n","[br]",str_replace("\r","",@$old_fio))))))));
$old_info=trim(stripslashes(str_replace("<", "", str_replace(">", "", str_replace("\"", "", str_replace("'","",str_replace("\n","[br]",str_replace("\r","",@$old_info))))))));
if (!isset($change_price)){$change_price="";} if (!preg_match("/^[0-9a-fA-F]+$/i",$change_price)) { $change_price="";}
if (!isset($change_order)){$change_order="";} if (!preg_match("/^[0-9a-fA-F]+$/i",$change_order)) { $change_order="";}
if (!isset($change_order2)){$change_order2="";} if (!preg_match("/^[0-9a-fA-Fx]+$/i",$change_order2)) { $change_order2="";}
if (!isset($old_basket_total)){$old_basket_total=0;} if (!preg_match("/^[0-9_\.-]+$/i",$old_basket_total)) { $old_basket_total=0;}

if (!isset($new_basket_total)){$new_basket_total=0;} if (!preg_match("/^[0-9_\.-]+$/i",$new_basket_total)) { $new_basket_total=0;}

if (!isset($old_basket_opt)){$old_basket_opt=0;} if (!preg_match("/^[0-9_\.-]+$/i",$old_basket_opt)) { $old_basket_opt=0;}
if (!isset($new_basket_opt)){$new_basket_opt=0;} if (!preg_match("/^[0-9_\.-]+$/i",$new_basket_opt)) { $new_basket_opt=0;}
if (!isset($old_basket_dostav)){$old_basket_dostav=0;} if (!preg_match("/^[0-9_\.-]+$/i",$old_basket_dostav)) { $old_basket_dostav=0;}
if (!isset($new_basket_dostav)){$new_basket_dostav=0;} if (!preg_match("/^[0-9_\.-]+$/i",$new_basket_dostav)) { $new_basket_dostav=0;}




if(($details[7]=="ADMIN")||($details[7]=="MODER")){

if (($valid=="1")&&($change_order!="")&&($change_name!=0)) {
$js= "<br><br>".@$details[1]." ".$lang[605].": $old_fio -&gt; $new_fio; $old_info -&gt; $new_info; ".$lang[217].": $old_basket_dostav -&gt; $new_basket_dostav;<br><br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","", fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($order_id1==$change_order){

if ($new_fio!=$old_fio) {$out1[7]=$new_fio;}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ if ($new_info!=$old_info) {$out1[8]=$new_info;}}
if (($new_basket_dostav!=$old_basket_dostav)&&($kurs==$defkurs)) {$out1[9]=str_replace(",",".",(0.01*round($new_basket_dostav/($kurs*0.01))));}

$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$out1[10]."|".$out1[11]."|".trim(@$out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);

if (($new_fio!=$old_fio)||($new_info!=$old_info)||($basket_dostav!=$old_basket_dostav)) {
$file = "./admin/orderstatus/".$change_order.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n$js\n"); flock ($f3, LOCK_UN);
fclose($f3);
}

}


if (($valid=="1")&&($change_order2!="")&&($change_name!=0)&&($listing==2)) {
$js= "<br><br>".@$details[1]." ".$lang[606].": $old_fio -&gt; $new_fio; $old_info -&gt; $new_info; ".$lang[217].": $old_basket_dostav -&gt; $new_basket_dostav;<br><br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list2.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","", fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($change_order2=="x".$order_id1){

if ($new_fio!=$old_fio) {$out1[7]=$new_fio;}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ if ($new_info!=$old_info) {$out1[8]=$new_info;}}
if (($new_basket_dostav!=$old_basket_dostav)&&($kurs==$defkurs)) {$out1[9]=str_replace(",",".",(0.01*round($new_basket_dostav/($kurs*0.01))));}

$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$out1[10]."|".$out1[11]."|".trim(@$out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);

if (($new_fio!=$old_fio)||($new_info!=$old_info)||($basket_dostav!=$old_basket_dostav)) {
$file = "./admin/orderstatus/".$change_order2.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n$js\n"); flock ($f3, LOCK_UN);
fclose($f3);
}

}


}


if(($details[7]=="ADMIN")||($details[7]=="MODER")){
$postlink="";
if (($valid=="1")&&($change_order!="")&&($add_post!=0)&&($tracknum!="")&&($postpost!="")) {

$file="./admin/baskets/list.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","",fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($order_id1==$change_order){
if (($tracknum!=trim($out1[13]))||($postpost!=$out1[15])) {

$postlink="<a href=\"". str_replace("[tracknum]", $tracknum, str_replace("[ordernum]",$out1[0], str_replace("[useremail]", $out1[2], $posturl[rawurldecode($postpost)])))."\">". str_replace("[tracknum]", $tracknum, str_replace("[ordernum]",$out1[0], str_replace("[useremail]", $out1[2], $postpost)))."</a>";
$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$out1[10]."|".$out1[11]."|".trim($out1[12])."|".$tracknum."|".$posturl[rawurldecode($postpost)]."|".$postpost."|\n";
$js= "<br><br>".$lang[244]." #$change_order, ".@$details[1]." ".$lang[607]." [ ".$postpost." #"."$tracknum ]<br>".$lang[608].":</b><br><br>
$postlink [".$lang[609].": <b>$tracknum</b>]<br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}

if ($mail_status==1) {
if ($out1[2]!="") {

$boundary = uniqid("");
$emailbody="<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>".$lang[244]." #".$out1[0]." </title>
</head>
<body>
".$lang['welc']." <b>". $out1[3]."</b>!<br><br>
".$lang[244]." #".$out1[0].": ".$lang[610]." <b>$tracknum</b><br><br><b>
".$lang[608].":</b><br><br>
$postlink [".$lang[609].": <b>$tracknum</b>]
<br><br>
".$lang[590].": ". date ("d-m-Y H:i", time()). "<br><br>
<hr>$shop_name<br><a href=\"$htpath\">". str_replace("http://","",$htpath). "</a><br>
$telef
<br><br>
".$lang[353]." $boundary</font>
</body>
</html>";
@mail ($out1[2],"Order Notice #".$out1[0]." From: ". str_replace("http://","",$htpath). " To: ".$out1[2], $emailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");


}
}
} else {
top("<font color=#b94a48>".$lang[241]."</font>", "
<font size=3>".$lang[529]." ".$lang[549]." <b>\"".$lang['adm4']."\"</b><br>".$lang[609]." \"$tracknum\" ".$lang[593]."!<br>".$lang[592]." ".$lang[550]." ".$lang[594]." ......</font><META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']. "?action=view_baskets&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">", $style ['center_width'], strtolower($style ['bg_error']), strtolower($style ['bg_view']), 5,0, "[content]");
$staterr=1;



break;
}
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
if ($staterr==0) {
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);


$file = "./admin/orderstatus/".$change_order.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n".date("d.m.y H:i", time())." - ".$lang[610].": $tracknum<br>".$lang[608].":</b><br><br>
$postlink [".$lang[609].": <b>$tracknum</b>]<br>\n"); flock ($f3, LOCK_UN);
fclose($f3);
}






}
}


if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")&&($change_order!="")&&($add_nakl!=0)) {

$js= "<br><br>".$lang[244]." #$change_order, ".@$details[1]." ".$lang[605]."<br><br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","",fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($order_id1==$change_order){

$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$out1[10]."|".$out1[11]."|".trim($out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n".md5(time())."|"."|"."|".$out1[3]."|"."|"."|".$out1[6]."|||0|494|". @$details[1]."|".trim(@$out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);


$file = "./admin/orderstatus/".md5(time()).".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n".date("d.m.y H:i", time())." - ".$lang[605]."<br>\n"); flock ($f3, LOCK_UN);
fclose($f3);


}
}




if(($details[7]=="ADMIN")||($details[7]=="MODER")){

if (($valid=="1")&&($change_order!="")&&($change_status!="")) {
$js= "<br><br>".$lang[589]." - <b>".@$lang[$change_status]."</b> (".@$details[1].")<br><br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","", fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($order_id1==$change_order){
if ($change_status!=$out1[10]) {




//.........................
if (($mail_status==1)&&($change_status!=8)&&($change_status!=494)&&($change_status!=495)&&($change_status!=496)&&($change_status!=497)&&($change_status!=498)&&($change_status!=499)&&($change_status!=500)&&($change_status!=501)&&($change_status!=502)&&($change_status!=503)&&($change_status!=515)&&($change_status!=516)) {
if ($out1[2]!="") {
$boundary = uniqid("");
$emailbody="<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>".$lang[244]." #".$out1[0]." </title>
</head>
<body>
".$lang['welc']." <b>". $out1[3]."</b>!<br><br>
".$lang[589].":<br><br>
".$lang[244]." #".$out1[0].": <b>".@$lang[$change_status]."</b>
<br><br>
".$lang[590].": ". date ("d-m-Y H:i", time()). "<br><br>
<hr>$shop_name<br><a href=\"$htpath\">". str_replace("http://","",$htpath). "</a><br>
$telef
<br><br>
".$lang[353]." $boundary</font>
</body>
</html>";
@mail ($out1[2],"Order Notice #".$out1[0]." From: ". str_replace("http://","",$htpath). " To: ".$out1[2], $emailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
}
}
//........................



if ($change_status!=8) {
$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$change_status."|".$out1[11]."|".trim(@$out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|0|".$change_status."|".$out1[11]."|".trim(@$out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
}
} else {
top("<font color=#b94a48>".$lang[241]."</font>", "
<font size=3>".$lang[529]." ".$lang[549]." <b>\"".$lang['adm4']."\"</b><br>".$lang[589]." \"".@$lang[$change_status]."\" ".$lang[593]."!<br>".$lang[592]." ".$lang[550]." ".$lang[594]." ......</font><META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']. "?action=view_baskets&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">", $style ['center_width'], strtolower($style ['bg_error']), strtolower($style ['bg_view']), 5,0, "[content]");
$staterr=1;
break;
}
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
if ($staterr==0) {
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);

unset ($f3);
$file = "./admin/orderstatus/".$change_order.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n".date("d.m.y H:i", time())." - ".@$lang[$change_status]."<br>\n"); flock ($f3, LOCK_UN);
fclose($f3);
}

}



if (($valid=="1")&&($change_order2!="")&&($change_status!="")&&($listing==2)) {
$js= "<br><br>".$lang[589]." - <b>".@$lang[$change_status]."</b> (".@$details[1].")<br><br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list2.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","", fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($change_order2=="x".$order_id1){
if ($change_status!=$out1[10]) {

$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$change_status."|".$out1[11]."|".trim(@$out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
top("<font color=#b94a48>".$lang[241]."</font>", "
<font size=3>".$lang[529]." ".$lang[549]." <b>\"".$lang['adm4']."\"</b><br>".$lang[589]." \"".@$lang[$change_status]."\" ".$lang[593]."!<br>".$lang[592]." ".$lang[550]." ".$lang[594]." ......</font><META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']. "?action=view_baskets&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">", $style ['center_width'], strtolower($style ['bg_error']), strtolower($style ['bg_view']), 5,0, "[content]");
$staterr=1;
break;
}
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
if ($staterr==0) {
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);

unset ($f3);
$file = "./admin/orderstatus/".$change_order2.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n".date("d.m.y H:i", time())." - ".@$lang[$change_status]."<br>\n"); flock ($f3, LOCK_UN);
fclose($f3);
}

}


}


if(($details[7]=="ADMIN")||($details[7]=="MODER")){

if (($valid=="1")&&($change_order!="")&&($change_kur!="")) {
$js= "<br><br>".$lang[562]." - <b>$change_kur</b> (".@$details[1].")<br><br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","", fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($order_id1==$change_order){
if ($change_kur!=trim($out1[12])) {

$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$out1[10]."|".$out1[11]."|".trim($change_kur)."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
top("<font color=#b94a48>".$lang[241]."</font>", "
<font size=3>".$lang[529]." ".$lang[549]." <b>\"".$lang['adm4']."\"</b><br> \"$change_kur\" ".$lang[593]."!<br>".$lang[592]." ".$lang[550]." ".$lang[594]." ......</font><META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']. "?action=view_baskets&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">", $style ['center_width'], strtolower($style ['bg_error']), strtolower($style ['bg_view']), 5,0, "[content]");
$staterr=1;
break;
}
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
if ($staterr==0) {
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);

unset ($f3);
$file = "./admin/orderstatus/".$change_order.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n".date("d.m.y H:i", time())." - ".$lang[591]." ". $change_kur. "<br>\n"); flock ($f3, LOCK_UN);
fclose($f3);
}

}

if (($valid=="1")&&($change_order2!="")&&($change_kur!="")&&($listing==2)) {
$js= "<br><br>".$lang[591]." - <b>$change_kur</b> (".@$details[1].")<br><br>";
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list2.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","", fgets($f3));

$out1=explode("|",$st3);

@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($change_order2=="x".$order_id1){

if ($change_kur!=trim($out1[12])) {

$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$out1[10]."|".$out1[11]."|".trim($change_kur)."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
top("<font color=#b94a48>".$lang[241]."</font>", "
<font size=3>".$lang[529]." ".$lang[549]." <b>\"".$lang['adm4']."\"</b><br>".$lang[562]." \"$change_kur\" ".$lang[593]."!<br>".$lang[592]." ".$lang[550]." ".$lang[594]." ......</font><META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=".$_SERVER['PHP_SELF']. "?action=view_baskets&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">", $style ['center_width'], strtolower($style ['bg_error']), strtolower($style ['bg_view']), 5,0, "[content]");
$staterr=1;
break;
}
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
if ($staterr==0) {
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);

unset ($f3);
$file = "./admin/orderstatus/".$change_order2.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n".date("d.m.y H:i", time())." - ".$lang[562].": ". $change_kur. "<br>\n"); flock ($f3, LOCK_UN);
fclose($f3);
}

}

}


$flv="";
$flashring="";
if ($refreshrate!="") {$flashring="<OBJECT classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" WIDTH=18 HEIGHT=18>
<PARAM NAME=movie VALUE=\"ring.swf\"> <PARAM NAME=menu VALUE=false> <PARAM NAME=quality VALUE=high> <PARAM NAME=bgcolor VALUE=#FFFFFF><EMBED src=\"ring.swf\" menu=false quality=high bgcolor=#FFFFFF WIDTH=18 HEIGHT=18 TYPE=\"application/x-shockwave-flash\" PLUGINSPAGE=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\"></EMBED>
</OBJECT>";}

if ($details[7]=="ADMIN") { $savebase="<br><br>".$lang[526].": <a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&savebaskets=1&refreshrate=$refreshrate&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">".$lang[527]."</a> ".$lang[528]." "; } else {$savebase="";}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
$js="";
if (($valid=="1")&&($change_order!="")&&($change_price!="")) {
if ($olddatum!=$datum) { if ((substr_count($datum,"." )==2)&&($datum!="")) {$js.= "<br><br>".$lang[598]." ".$lang[596]." $olddatum ".$lang[597]." $datum</b> (".@$details[1].")<br><br>"; } else {$js.="<br><br>".$lang[611]." (".@$details[1].")";}}
if (($new_basket_total!=$old_basket_total)&&($kurs==$defkurs)) {$js= "<br><br><b><strike>$old_basket_total</strike> $new_basket_total  ".$currencies_sign[$_SESSION["user_currency"]]."</b> (".@$details[1].")<br><br>";}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){ if (($new_basket_opt!=$old_basket_opt)&&($kurs==$defkurs)) {$js.= "<br><br>".$lang[148].": <b><strike>$old_basket_opt</strike> $new_basket_opt".$currencies_sign[$_SESSION["user_currency"]]."</b> (".@$details[1].")<br><br>";}}
if (($new_basket_dostav!=$old_basket_dostav)&&($kurs==$defkurs)) {$js.= "<br><br>".$lang[595].": <b><strike>$old_basket_dostav</strike> $new_basket_dostav ".$currencies_sign[$_SESSION["user_currency"]]."</b> (".@$details[1].")<br><br>";}
if ($usetheme==0) {
echo $js;
} else {
top("", "$js", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]");
}
$file="./admin/baskets/list.txt";


$f3=fopen($file,"r");
$f_save="";
while(!feof($f3)) {
$st3=str_replace("\n","", fgets($f3));

$out1=explode("|",$st3);
@$order_id1=@$out1[0];
if ($order_id1==""): continue; endif;
if ($order_id1==$change_order){

if (($new_basket_total!=$old_basket_total)&&($kurs==$defkurs)) {$out1[7]=str_replace(",",".",(0.01*round($new_basket_total/($kurs*0.01))));}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){   if ($olddatum!=$datum) { if ((substr_count($datum,"." )==2)&&($datum!="")) {$out1[6]=str_replace("$olddatum","$datum", $out1[6]);  }}
if (($new_basket_opt!=$old_basket_opt)&&($kurs==$defkurs)) {$out1[8]=str_replace(",",".",(0.01*round($new_basket_opt/($kurs*0.01))));}}
if (($new_basket_dostav!=$old_basket_dostav)&&($kurs==$defkurs)) {$out1[9]=str_replace(",",".", (0.01*round($new_basket_dostav/($kurs*0.01))));}



//.........................
if ($mail_status==1) {
if ($olddatum!=$datum) {
if ($out1[2]!="") {
$boundary = uniqid("");
$emailbody="<!DOCTYPE html><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<title>".$lang[244]." #".$out1[0]." </title>
</head>
<body>
".$lang['welc']." <b>". $out1[3]."</b>!<br><br>
".$lang[589].":<br><br>
".$lang[244]." #".$out1[0].": <b>".$lang[598]." ".$lang[596]." $olddatum ".$lang[597]." $datum</b>
<br><br>
".$lang[590].": ". date ("d-m-Y H:i", time()). "<br><br>
<hr>$shop_name<br><a href=\"$htpath\">". str_replace("http://","",$htpath). "</a><br>
$telef
<br><br>
".$lang[353]." $boundary</font>
</body>
</html>";
@mail ($out1[2],"Order Notice #".$out1[0]." From: ". str_replace("http://","",$htpath). " To: ".$out1[2], $emailbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
echo $emailbody;
}
}
}
//........................





$f_save .=$out1[0]."|".$out1[1]."|".$out1[2]."|".$out1[3]."|".$out1[4]."|".$out1[5]."|".$out1[6]."|".$out1[7]."|".$out1[8]."|".$out1[9]."|".$out1[10]."|".$out1[11]."|".trim(@$out1[12])."|".trim(@$out1[13])."|".$out1[14]."|".$out1[15]."|\n";
} else {
$f_save .=$st3."\n";
}
}


fclose($f3);
$f3=fopen($file,"w"); flock ($f3, LOCK_EX);
fputs ($f3, $f_save); flock ($f3, LOCK_UN);
fclose($f3);

if (($new_basket_total!=$old_basket_total)&&($kurs==$defkurs)) {
$file = "./admin/orderstatus/".$change_order.".txt";
$f3=fopen($file,"a"); flock ($f3, LOCK_EX);
fputs ($f3, "\n".date("d.m.y H:i", time())." - <strike>$old_basket_total</strike> $new_basket_total ".$currencies_sign[$_SESSION["user_currency"]]."<br>\n"); flock ($f3, LOCK_UN);
fclose($f3);
}

}
}


if ($staterr==0) {
$refr="";
if ($refreshrate!="") {$refr="<META HTTP-EQUIV=\"Refresh\" CONTENT=\"$refreshrate;URL=".$_SERVER['PHP_SELF']. "?action=view_baskets&refreshrate=".$refreshrate."&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">";}

if ($change_order=="") {top("", "<h4>".$lang[522]."</h4>".$refr."<font color=$nc5 size=2>".$lang[523].": <b><a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&refreshrate=30&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">30 ".$lang[524]."</a> | <a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&refreshrate=60&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">1 ".$lang[525]."</a> | <a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&refreshrate=300&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">5 ".$lang[525]."</a> | <a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&refreshrate=600&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">10 ".$lang[525]."</a> | <a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&refreshrate=1800&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">30 ".$lang[525]."</a> | <a href=\"".$_SERVER['PHP_SELF']. "?action=view_baskets&refreshrate=&sort=".@$sort."&listing=".@$listing."&filter=".@$filter."\">".$lang['undo']."</a></b>$savebase</font>".$lang[529]." ".$lang[549]." <b>\"".$lang['adm4']."\"</b> ".$lang[550]."", $style ['center_width'], strtolower($style ['bg_content']), strtolower($style ['bg_view']), "noshadow",0, "[content]"); }
$basket_list = "";
$basket_sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;
$files_found=0;
$st=0;
$s=0;
$dost_opt=0;
$dost_dost=0;
$dost_week=0;





$g=0;











$file="./admin/baskets/list.txt";
$listmas=file($file);

while(list ($keysm,$st) =each ($listmas)) {
$outd=explode("|",$st);
$stamptd=explode(".",@$outd[6]);
$mktimer=mktime(0,0,1,doubleval(@$stamptd[1]),doubleval(@$stamptd[0]),doubleval(@$stamptd[2]))-$g;
$g+=1;
$listmas3[$mktimer]=$st;
}
@krsort($listmas3);
@reset($listmas3);
unset ($keym, $st);
unset($listmas);
if ($listing==2) { $file="./admin/baskets/list2.txt"; } else {$file="./null.txt"; }
if ((@file_exists($file))&&(filesize($file)!=0)) {

$listmas=file($file);

while(list ($keysm,$st) =each ($listmas)) {
if (trim($st)!="") {
$outd=explode("|",$st);
$stamptd=explode(".",@$outd[6]);
$mktimer=mktime(0,0,1,doubleval(@$stamptd[1]),doubleval(@$stamptd[0]),doubleval(@$stamptd[2]))-$g;
$g+=1;
echo "\n";
$listmas4[$mktimer]="x".$st;
}
@krsort($listmas4);
@reset($listmas4);
unset ($keym, $st);
$listmas2=array_merge($listmas3,
 $listmas4);
}
} else {
$listmas2=$listmas3;
}


unset($listmas3,$listmas4);
unset($listmas);


while(list ($keysm,$st)=@each ($listmas2)) {

$out=explode("|",str_replace("\n","", $st));
@$basket_id=@$out[0];
$post_track="";
if ((trim($basket_id)=="")||(trim($basket_id)=="\n")||(trim($basket_id)=="x")) {} else {
@$basket_link=@$out[1];
@$basket_email=@$out[2];
@$basket_fio=@$out[3];
@$basket_tel=wordwrap(@$out[4],200,"\n");
if(substr(@$out[5],0,1)==" ") {  $out[5]=trim(substr($out[5],1,strlen($out[5]))); }
$indem=str_replace("Москва_", "", str_replace(" ", "_", @$out[5]));
if (!isset($lang['citys'])) {} else {$indem=str_replace(@$lang['citys']."_","",$indem); @$out[5]=str_replace(@$lang['citys']."_","",@$out[5]);}
@$basket_metro=trim(@$mmet[$indem].str_replace("Москва ","", @$out[5]));

@$basket_date=@$out[6];
@$basket_total=($optround*(round((0+@$out[7]*$kurs)/$optround)));
@$basket_del=($optround*(round((0+@$out[8]*$kurs)/$optround)));
@$basket_opl=($optround*(round((0+@$out[9]*$kurs)/$optround)));
@$basket_status=@$out[10];
@$basket_comment=@$out[11];
@$basket_kur=trim(@$out[12]);
@$basket_post=trim(str_replace("\n", "", @$out[13]));

$out[14]=trim(str_replace("\n", "", @$out[14]));
$out[15]=trim(str_replace("\n", "", @$out[15]));
$posts2=str_replace("[def]","<option value=\"".@$out[15]."\">".@$out[15]."</option>", $posts);
if($out[14]==""){$out[14]=$post_track_url;}
if($out[15]==""){$out[15]=$post_track_name;}
$tmpmass=explode("<br>",$basket_date);
@$baskip=$tmpmass[1];
@$basktags=$tmpmass[3];
unset ($tmpmass);
$tmpmass=explode(".",$basket_date);
$month=strtoken($tmpmass[1].".".$tmpmass[2]," ");

$bgk=""; $zzz="";
$otchet4[$month]=@$otchet4[$month]+$basket_total;
$stylebb=""; $styleaa="";
$stampt=explode(".",$out[6]);
$dayofyear=(doubleval($stampt[0])+30*(doubleval($stampt[1]))+365*(doubleval($stampt[2])));
$dates=$stampt[0].".".$stampt[1].".".doubleval($stampt[2]);
$ipis=strtoken(wordwrap(str_replace($dates,"", $out[6]), 15, "\n", 1),"\n");
$optus="";
if(($details[7]=="ADMIN")||($details[7]=="MODER")) { $optus=($optround*(round((0+$out[8]*$kurs)/$optround))); $dateform="<input type=\"hidden\" name=\"olddatum\" value=\"".$dates."\"><select class=input-small name=\"datum\" onchange=\"javascript:document.subm_$s.submit()\"><option selected>$dates</option>".str_replace(">$dates"," style=\"background-color: #99FF99\">$dates", $pred)."</select>"; } else { $dateform="$dates"."<input type=\"hidden\" name=\"olddatum\" value=\"".$dates."\"><input type=\"hidden\" name=\"datum\" value=\"".$dates."\">"; }
if($kurs==$defkurs) {$formtext="text";} else {$formtext="hidden";}
$kurstype="text";
$buttype="submit";
if ($kurs!=$defkurs) {$kurstype="hidden";$buttype="hidden";}
$daylater=((date("d", time())+30*date("m", time())+365*date("Y", time()))-$dayofyear);
$mktimer=mktime(0,0,1,doubleval($stampt[1]),doubleval($stampt[0]),doubleval($stampt[2]));
$ned=date("W", $mktimer);
$god=date("Y", $mktimer);
$nedgod="$ned$god";
$kkur=trim($out[12]);
if (!isset($dostw1[$nedgod])) {$dostw1[$nedgod]=0;}
if (!isset($dostw2[$nedgod])) {$dostw2[$nedgod]=0;}
if (!isset($dostw3[$nedgod])) {$dostw3[$nedgod]=0;}
if (!isset($dostw4[$nedgod])) {$dostw4[$nedgod]=0;}
if (!isset($dostw5[$nedgod])) {$dostw5[$nedgod]=0;}
if (!isset($dostw6[$nedgod])) {$dostw6[$nedgod]=0;}
if (!isset($dostw9[$nedgod])) {$dostw9[$nedgod]=0;}
if (!isset($dostw10[$nedgod])) {$dostw10[$nedgod]=0;}
if (!isset($dostw11[$nedgod])) {$dostw11[$nedgod]=0;}
if (!isset($dostw12[$nedgod])) {$dostw12[$nedgod]=0;}
if (!isset($dostw13[$nedgod])) {$dostw13[$nedgod]=0;}
if (!isset($dostw25[$nedgod])) {$dostw25[$nedgod]=0;}  //оплата товара
if (!isset($dostw26[$nedgod][$kkur])) {$dostw26[$nedgod][$kkur]=0;}  //выручка курьера
if (!isset($dostw27[$nedgod][$kkur])) {$dostw27[$nedgod][$kkur]=0;}  //за доставку курьеру
if (!isset($dostw28[$nedgod][$kkur])) {$dostw28[$nedgod][$kkur]=0;}  //расходы курьера
$stylezz=" style=\"background-color: ".@$kur[$basket_kur].";\"";
$styledd="";
if ($change_order==$basket_id){ if (($change_price!="")||($change_name!="")) {$stylebb=" style=\"border: 3px solid #99CC00\"";} if ($change_status!="") {$styleaa=" style=\"border: 3px solid #99CC00\"";}}
if ($change_order==$basket_id){ if ($change_kur!="") {$stylezz=" style=\"border: 3px solid #99CC00; background-color: ".@$kur[$basket_kur].";\"";}}
$optionkur="";
$bgk=" bgcolor=\"#FFffff\"";
$dopoptions="";
//Отказать привез брак
if (($basket_status==485)||($basket_status==$lang[485])||($basket_status==$lang[486])||($basket_status==486)) {
$dostw27[$nedgod][$kkur]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchets2[$month]=@$otchets2[$month]+1; $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" bgcolor=\"#FCA7A7\""; $zzz="9999";$otchet5[$month]=@$otchet5[$month]+1; $otchet7[$month]=@$otchet7[$month]+$basket_total;}
//доставлен OK
if (($basket_status==487)||($basket_status==$lang[487])||($basket_status==516)) {
$dostw26[$nedgod][$kkur]+=($optround*(round((0+$out[7]*$kurs)/$optround)));
$dostw27[$nedgod][$kkur]+=($optround*(round((0+$out[9]*$kurs)/$optround)));
$otchets[$month]=@$otchets[$month]+1; $dostw11[$nedgod]+=1; $ttl+=1; $pribil=$pribil+($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet10[$month]=@$otchet10[$month]+($optround*(round((0+$out[8]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $totalz+=doubleval($basket_total); $dostw1[$nedgod]+=($optround*(round((0+$out[7]*$kurs)/$optround))); $dostw2[$nedgod]+=($optround*(round((0+$out[8]*$kurs)/$optround))); $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround)));
$dost_opt+=(($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-($optround*(round((0+$out[9]*$kurs)/$optround)))); $bgk=" bgcolor=\"#B6DBB6\""; $otchet[$month]=@$otchet[$month]+$basket_total; $otchet2[$month]=@$otchet2[$month]+1; $otchet6[$month]=@$otchet6[$month]+1;  }
//OK
if ($basket_status==516) {
$bgk=" bgcolor=\"#86ab86\"";}
//получен почта
if (($basket_status==488)||($basket_status==$lang[488])) {
$dostw26[$nedgod][$kkur]+=($optround*(round((0+$out[7]*$kurs)/$optround)));
$dostw27[$nedgod][$kkur]+=($optround*(round((0+$out[9]*$kurs)/$optround)));
$otchets[$month]=@$otchets[$month]+1; $dostw11[$nedgod]+=1; $ttl+=1; $pribil=$pribil+($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet10[$month]=@$otchet10[$month]+($optround*(round((0+$out[8]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $totalz+=doubleval($basket_total); $dostw1[$nedgod]+=($optround*(round((0+$out[7]*$kurs)/$optround))); $dostw2[$nedgod]+=($optround*(round((0+$out[8]*$kurs)/$optround))); $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround)));
$dost_opt+=(($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-($optround*(round((0+$out[9]*$kurs)/$optround)))); $bgk=" bgcolor=\"#B6DBB6\""; $otchet[$month]=@$otchet[$month]+$basket_total; $otchet2[$month]=@$otchet2[$month]+1; $otchet6[$month]=@$otchet6[$month]+1;  }
//выручка
if (($basket_status==489)||($basket_status==$lang[489])) { @$dostw1[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet[$month]=@$otchet[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil+=($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" bgcolor=\"#a6cBa6\""; }
//нет на складе
if (($basket_status==490)||($basket_status==491)||($basket_status==492)||($basket_status==$lang[493])||($basket_status==$lang[490])||($basket_status==$lang[491])||($basket_status==$lang[492])||($basket_status==$lang[493])) {$bgk=" bgcolor=\"#d2d2d2\""; }
//расходы
if (($basket_status==8)||($basket_status==494)||($basket_status==495)||($basket_status==496)||($basket_status==497)||($basket_status==498)||($basket_status==499)||($basket_status==500)||($basket_status==$lang[494])||($basket_status==$lang[8])||($basket_status==$lang[495])||($basket_status==$lang[496])||($basket_status==$lang[497])||($basket_status==$lang[498])||($basket_status==$lang[499])||($basket_status==$lang[500])) {
if (strtoken($out[8],":")=="Orderdate") {$flv=$flashring;}
$dostw28[$nedgod][$kkur]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet9[$month]=@$otchet9[$month]+($optround*(round((0+$out[9]*$kurs)/$optround)));  $dostw9[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround)));  $otchet7[$month]=@$otchet7[$month]+$basket_total; $bgk=" bgcolor=\"#d2aad2\""; }
//закупка
if (($basket_status==501)||($basket_status==502)||($basket_status==$lang[501])||($basket_status==$lang[502])) {$otchet9[$month]=@$otchet9[$month]+($optround*(round((0+$out[9]*$kurs)/$optround)));  $dostw9[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround)));  $otchet7[$month]=@$otchet7[$month]+$basket_total; $bgk=" bgcolor=\"#FFCC99\""; $dopoptions="<option value=502>".$lang[502]."</option>";}
//отказ
if (($basket_status==503)||($basket_status==$lang[503])) {
$otchets2[$month]=@$otchets2[$month]+1; $dostw10[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" bgcolor=\"#FFD7D7\""; $otchet5[$month]=@$otchet5[$month]+1; $otchet7[$month]=@$otchet7[$month]+$basket_total;}
//заявка
if (($basket_status==504)||($basket_status==505)||($basket_status==506)||($basket_status==507)||($basket_status==508)||($basket_status==509)||($basket_status==510)||($basket_status==511)||($basket_status==512)||($basket_status==$lang[504])||($basket_status==$lang[505])||($basket_status==$lang[506])||($basket_status==$lang[507])||($basket_status==$lang[508])||($basket_status==$lang[509])||($basket_status==$lang[510])||($basket_status==$lang[511])||($basket_status==$lang[512])){
$zay+=1;
$dostw4[$nedgod]+=($optround*(round((0+$out[7]*$kurs)/$optround)));
$dostw5[$nedgod]+=($optround*(round((0+$out[8]*$kurs)/$optround)));
$dostw6[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround)));
$otchet14[$month]=@$otchet14[$month]+($optround*(round((0+$out[9]*$kurs)/$optround)));
$otchet13[$month]=@$otchet13[$month]+($optround*(round((0+$out[8]*$kurs)/$optround)));
$otchet3[$month]=@$otchet3[$month]+$basket_total;
$otchet2[$month]=@$otchet2[$month]+1;
}

//возврат
if (($basket_status==513)||($basket_status==514)||($basket_status==$lang[513])||($basket_status==$lang[514])) {
$dostw27[$nedgod][$kkur]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchets2[$month]=@$otchets2[$month]+1; $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" bgcolor=\"#FCA7A7\""; $otchet5[$month]=@$otchet5[$month]+1; $otchet7[$month]=@$otchet7[$month]+$basket_total;}
//доставляется
if (($basket_status==510)||($basket_status==511)||($basket_status==509)||($basket_status==$lang[510])||($basket_status==$lang[511])||($basket_status==$lang[509])){$otchets[$month]=@$otchets[$month]+1; $dostw12[$nedgod]+=1; $styledd=" style=\"background-color: #B6DBB6;\""; }
//отложен
if (($basket_status==512)||($basket_status==$lang[512])){$dostw12[$nedgod]+=1; $styledd=" style=\"background-color: #FFe7e7;\""; $optionkur=$blij;}
//Заявка
if (($basket_status==504)||($basket_status==$lang[504])){$bgk=" style=\"background-color: #FFFF99;\"";$flv=$flashring;}
//расчет за товар
if ($basket_status==515){  $dostw25[$nedgod]=$dostw25[$nedgod]+($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet25[$month]=@$otchet25[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" style=\"background-color: #99ff99;\"";}
//отправлен почта
if (($basket_status==509)||($basket_status==505)||($basket_status==488)||($basket_status==$lang[509])||($basket_status==$lang[505])||($basket_status==$lang[488])){
$dostw27[$nedgod][$kkur]+=($optround*(round((0+$out[9]*$kurs)/$optround)));
$post_track.="<div align=left>"; if ($basket_post!="") { $post_track.="Track Link: <a href=\"". str_replace("[tracknum]", $basket_post, str_replace("[ordernum]",$out[0], str_replace("[useremail]", $out[2], $out[14])))."\"><font color=#000080>".$out[15]."</font></a> "; }
$post_track.="<form class=form-inline action=\"index.php\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=hidden name=\"add_post\" value=1><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><br>Track #: <input type=text class=input-small name=\"tracknum\" size=10 value=\"$basket_post\">$posts2<input class=\"btn btn-primary\" type=submit value=\"V\" title=\"".$lang[612]."\"></form></div>";
 }else {$post_track="";}
//обрабатывается
if (($basket_status==506)||($basket_status==507)||($basket_status==505)||($basket_status==508)||($basket_status==$lang[506])||($basket_status==$lang[507])||($basket_status==$lang[505])||($basket_status==$lang[508])){$dostw12[$nedgod]+=1; $styledd=" style=\"background-color: #e6ffe6;\""; $optionkur=$blij;}

$whei=1;
$wheis="";
if($ned!=$oldned) {  $wheis="<img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=100% height=4>";
if($details[7]=="ADMIN") {
	$razopt=(0-($optround*(round((0+@$dostw2[$oldnedgod])/$optround)))+($optround*(round((0+@$dostw25[$oldnedgod])/$optround))));
	$fst="";
	if ($razopt>=0) {$fst=" style=\"color: #FFFFFF; background-color: #008000\"";} else {$fst=" style=\"color: #FFFFFF; background-color: #800000\"";}
$viruchil="";
reset ($kur);
while (list ($keye, $ste) = each ($kur)) {
if ((@$dostw26[$oldnedgod][$keye]!=0)||(@$dostw28[$oldnedgod][$keye]!=0)) {
	if (($keye!="")&&($keye!="-")) {
$viruchil.= "<tr><td><img src=\"$image_path/pix.gif\" style=\"background-color: $ste\" width=10 height=10>&nbsp;</td><td><b>$keye</b>&nbsp;</td><td>".$dostw26[$oldnedgod][$keye]."(".$lang[489].")</td><td>-".$dostw27[$oldnedgod][$keye]."(".$lang[563].")</td><td>-</td><td>".$dostw28[$oldnedgod][$keye]."(".$lang[494].")</td><td>=</td><td><b>".($dostw26[$oldnedgod][$keye]-$dostw27[$oldnedgod][$keye]-$dostw28[$oldnedgod][$keye])."</b>".$currencies_sign[$_SESSION["user_currency"]]."</td></tr>\n";
}
}

}
if ($viruchil!="") {
$wheis.="<table border=0>$viruchil</table>";
}
$wheis.="<br><b>".$lang[575].": ".@$dostw11[$oldnedgod]."</b> | ".$lang[578].": ".str_replace(",",".",($optround*(round((0+@$dostw2[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." / <font$fst>".str_replace(",",".",$razopt)."</font> | ".$lang[494].": ". str_replace(",",".",($optround*(round((0+@$dostw9[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[562].": ".str_replace(",",".",($optround*(round((0+@$dostw3[$oldnedgod]+@$dostw10[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." (".$lang[576].":".str_replace(",",".",($optround*(round(@$dostw3[$oldnedgod]/$optround))))." + ".$lang[577].":".str_replace(",",".",($optround*(round(@$dostw10[$oldnedgod]/$optround)))).") | ".$lang[489].":
 ".($optround*(round((0+@$dostw1[$oldnedgod])/$optround)))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[556].":
<b>".str_replace(",",".",($optround*(round((0+@$dostw1[$oldnedgod]-@$dostw2[$oldnedgod]-@$dostw3[$oldnedgod]-@$dostw9[$oldnedgod])/$optround))))."</b>".$currencies_sign[$_SESSION["user_currency"]]."<br>";


if((@$dostw4[$oldnedgod]>0)||(@$dostw5[$oldnedgod]>0)||(@$dostw6[$oldnedgod]>0)) {
	$razopt=(0-($optround*(round((0+$dostw2[$oldnedgod]+$dostw5[$oldnedgod])/$optround)))+($optround*(round((0+@$dostw25[$oldnedgod])/$optround))));
	$fst="";
	if ($razopt>=0) {$fst=" style=\"color: #FFFFFF; background-color: #008000\"";} else {$fst=" style=\"color: #FFFFFF; background-color: #800000\"";}
$wheis.="<b>".$lang[584].": ".($dostw11[$oldnedgod]+$dostw12[$oldnedgod])."</b> | ".$lang[578].": ".str_replace(",",".",($optround*(round((0+$dostw2[$oldnedgod]+$dostw5[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." / <font$fst>".str_replace(",",".",$razopt)."</font> | ".$lang[494].": ".str_replace(",",".",($optround*(round((0+$dostw9[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[562].": ".str_replace(",",".",($optround*round((0+$dostw3[$oldnedgod]+$dostw6[$oldnedgod]+$dostw10[$oldnedgod])/$optround)))." | ".$lang[489].": ".($optround*(round((0+$dostw1[$oldnedgod]+$dostw4[$oldnedgod])/$optround)))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[556].": <b>
".str_replace(",",".",($optround*(round((0+$dostw1[$oldnedgod]+$dostw4[$oldnedgod]-$dostw2[$oldnedgod]-$dostw3[$oldnedgod]-$dostw5[$oldnedgod]-$dostw6[$oldnedgod]-$dostw9[$oldnedgod])/$optround))))."</b>".$currencies_sign[$_SESSION["user_currency"]]."<br>";
}
}
$wheis.="<br><br><table width=100% border=0><tr><td><div align=left>".$lang[619].": <b>$ned</b> (".$stampt[1].".".doubleval($stampt[2]).")</div></td><td><div align=right>";

if (substr($basket_id,0,1)=="x") {$wheis.="<font color=$nc3>".$lang[613]."</font></div></td></tr></table>"; } else { if($details[7]=="ADMIN") {$wheis.="<form class=form-inline action=\"index.php\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"closeweek\" value=\"$out[0]\"><input class=\"btn btn-primary\" type=submit value=\" ".$lang[614]." $ned   (".$stampt[1].".".doubleval($stampt[2]).")\" title=\"".$lang[615]."\"></form></div></td></tr></table>";} else{$wheis.="</div></td></tr></table>";}}}


if (($basket_status==8)||($basket_status==502)||($basket_status==515)||($basket_status==489)||($basket_status==494)||($basket_status==493)||($basket_status==495)||($basket_status==496)||($basket_status==497)||($basket_status==498)||($basket_status==499)||($basket_status==500)||($basket_status==501)||($basket_status==$lang[502])||($basket_status==$lang[489])||($basket_status==$lang[8])||($basket_status==$lang[494])||($basket_status==$lang[493])||($basket_status==$lang[495])||($basket_status==$lang[496])||($basket_status==$lang[497])||($basket_status==$lang[498])||($basket_status==$lang[499])||($basket_status==$lang[500])||($basket_status==$lang[501])) {


if (substr($basket_id,0,1)=="x") {
//закупка
if (($basket_status==501)||($basket_status==502)||($basket_status==489)||($basket_status==$lang[501])||($basket_status==$lang[502])||($basket_status==$lang[489])) {
$basket_sps[$s]= "<!-- $mktimer --><tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td colspan=10 valign=top".$bgk."><small><font color=$nc5><a name=f$basket_id></a><form class=form-inline action=\"index.php#f$basket_id\" method=\"POST\">
".$lang[75].":<input type=hidden name=\"change_name\" value=1><input type=hidden name=\"old_fio\" value=\"".$out[7]."\">
<input type=text class=input-small size=20 name=\"new_fio\" value=\"".$out[7]."\"></font></small>&nbsp;&nbsp;
".$lang[580].":<small><input type=hidden name=\"old_info\" value=\"".$out[8]."\">
<input type=text class=input-small size=40 name=\"new_info\" value=\"".$out[8]."\"></small><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"></td><td valign=top".$bgk."><input type=hidden name=\"old_basket_dostav\" value=".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."><input type=$kurstype class=input-small size=4 name=\"new_basket_dostav\" value=".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."></td><td valign=top".$bgk."><input type=\"hidden\" name=\"change_order2\" value=\"$basket_id\">
</td><td valign=top".$bgk."><input class=btn type=$buttype"."$stylebb value=\"»\"></form></td><td valign=top align=center".$bgk."><form name=\"forma$s\" action=\"index.php#f$basket_id\" method=\"POST\"><small><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order2\" value=\"$basket_id\"><select class=input-small name=\"change_status\" onchange=\"javascript:document.forma$s.submit()\"$styleaa><option selected value=\"$basket_status\">".@$lang[$basket_status]."</option>
<option value=8>".$lang[8]."</option><option value=494>".$lang[494]."</option><option value=489>".$lang[489]."</option><option value=501>".$lang[501]."</option>$dopoptions<option></option><option value=515>".$lang[515]."</option><option></option><option value=493>".$lang[493]."</option></select>&nbsp;&nbsp;</form></small></td>
<td valign=top".$bgk."><input class=\"btn btn-inverse\" type=button value=\"i\" onClick=\"javascript:window.open('$htpath/admin/orderstatus/$basket_id.txt','fr$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang[532]."\"></td><td valign=top".$bgk.">&nbsp;</td>
<td align=center valign=top".$bgk."><form name=\"formak$s\" action=\"index.php#f$basket_id\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order2\" value=\"$basket_id\"><select class=input-small name=\"change_kur\" onchange=\"javascript:document.formak$s.submit()\"$stylezz><option selected style=\"background-color: ".@$kur[$basket_kur].";\">".@$basket_kur."</option>$kuroptions$optionkur</select></form>
</td></tr>\n\n";
} else {
if (($basket_status==8)||($basket_status==$lang[8])) {

$basket_sps[$s]= "<!-- $mktimer --><tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td colspan=10 valign=top".$bgk."><small><font color=$nc5>
<small>".str_replace("[br]",chr(10),$out[8])."</small></td><td valign=top".$bgk.">&nbsp;
</td><td valign=top".$bgk.">&nbsp;</td><td valign=top".$bgk.">&nbsp;</td><td valign=top align=center".$bgk.">".@$lang[$basket_status]."&nbsp;&nbsp;</small></td><td valign=top".$bgk.">&nbsp;</td><td align=right valign=top".$bgk."><input class=\"btn btn-inverse\" type=button value=\"i\" onClick=\"javascript:window.open('$htpath/admin/orderstatus/".str_replace("x","", $basket_id).".txt','fr$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang[616]."\"></td><td align=center valign=middle".$bgk." style=\"background-color: ".@$kur[$basket_kur].";\">&nbsp;<small>".@$basket_kur."</small>&nbsp;</td></tr>\n\n";
} else {
$basket_sps[$s]= "<!-- $mktimer --><tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td colspan=10 valign=top".$bgk."><small><font color=$nc5>
".$lang[75].": <b>$out[7]</b></font></small>&nbsp;&nbsp;
".$lang[580].": <small><b>".$out[8]."</b></small></td><td valign=top".$bgk.">&nbsp;<small><b>".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."</b></small>
</td><td valign=top".$bgk.">&nbsp;</td><td valign=top".$bgk.">&nbsp;</td><td valign=top align=center".$bgk.">".@$lang[$basket_status]."&nbsp;&nbsp;</small></td><td valign=top".$bgk.">&nbsp;</td><td align=right valign=top".$bgk."><input class=\"btn btn-inverse\" type=button value=\"i\" onClick=\"javascript:window.open('$htpath/admin/orderstatus/".str_replace("x","", $basket_id).".txt','fr$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang[616]."\"></td><td align=center valign=middle".$bgk." style=\"background-color: ".@$kur[$basket_kur].";\">&nbsp;<small>".@$basket_kur."</small>&nbsp;</td></tr>\n\n";

}
}
} else {
	if (($basket_status==8)||($basket_status==$lang[8])) {
$basket_sps[$s]= "<!-- $mktimer --><tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td colspan=12 valign=top".$bgk."><font class=small color=$nc5><small><a name=f$basket_id></a><form class=form-inline action=\"index.php#f$basket_id\" method=\"POST\">
<input type=hidden name=\"change_name\" value=1><input type=hidden name=\"old_fio\" value=\"".$out[7]."\">
<input type=hidden size=15 name=\"new_fio\" value=\"".$out[7]."\">
<input type=hidden name=\"old_info\" value=\"".$out[8]."\">
<textarea cols=30 rows=2 style=\"width:100%; background-color: #d2aad2;\" name=\"new_info\">".str_replace("[br]"," ".chr(10),wordwrap($out[8], 48, " ",1) )."</textarea></small></font><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"></td><td valign=top".$bgk."><input type=hidden name=\"old_basket_dostav\" value=0><input type=hidden name=\"new_basket_dostav\" value=0>
<input type=\"hidden\" name=\"change_order\" value=\"$basket_id\">
<input class=btn type=$buttype"."$stylebb value=\"»\"></form></td><td valign=top align=center".$bgk."><form name=\"forma$s\" action=\"index.php#f$basket_id\" method=\"POST\"><small><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><select class=input-small name=\"change_status\" onchange=\"javascript:document.forma$s.submit()\"$styleaa><option selected value=\"$basket_status\">".@$lang[$basket_status]."</option>
<option value=8>".$lang[8]."</option><option value=494>".$lang[494]."</option><option value=496>".$lang[496]."</option><option value=497>".$lang[497]."</option><option value=498>".$lang[498]."</option><option value=500>".$lang[500]."</option><option value=499>".$lang[499]."</option><option value=495>".$lang[495]."</option><option value=489>".$lang[489]."</option><option value=501>".$lang[501]."</option>$dopoptions<option></option><option value=515>".$lang[515]."</option><option></option><option value=493>".$lang[493]."</option></select>&nbsp;&nbsp;</form></small></td>
<td valign=top".$bgk."><input class=\"btn btn-inverse\" type=button value=\"i\" onClick=\"javascript:window.open('$htpath/admin/orderstatus/$basket_id.txt','fr$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang[616]."\"></td><td valign=top".$bgk."><form class=form-inline action=\"index.php#f$basket_id\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=hidden name=\"add_nakl\" value=1><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><input class=\"btn btn-info\" type=submit value=\"+\" title=\"".$lang[617]."\"></form></td>
<td align=center valign=top".$bgk."><form name=\"formak$s\" action=\"index.php#f$basket_id\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><select class=input-small name=\"change_kur\" onchange=\"javascript:document.formak$s.submit()\"$stylezz><option selected style=\"background-color: ".@$kur[$basket_kur].";\">".@$basket_kur."</option>$kuroptions$optionkur</select></form>
</td></tr>\n\n";
		} else {
$basket_sps[$s]= "<!-- $mktimer --><tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td colspan=11 valign=top".$bgk."><font class=small color=$nc5><small><a name=f$basket_id></a><form class=form-inline action=\"index.php#f$basket_id\" method=\"POST\">
".$lang[75].":<input type=hidden name=\"change_name\" value=1><input type=hidden name=\"old_fio\" value=\"".$out[7]."\">
<input type=text class=input-small size=15 name=\"new_fio\" value=\"".$out[7]."\"></small>&nbsp;&nbsp;
<small>".$lang[580].":<input type=hidden name=\"old_info\" value=\"".$out[8]."\">
<input type=text class=input-small size=30 name=\"new_info\" value=\"".$out[8]."\"></small></font><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"></td><td valign=top".$bgk."><input type=hidden name=\"old_basket_dostav\" value=".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."><input type=$kurstype class=input-small size=4 name=\"new_basket_dostav\" value=".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\">
</td><td valign=top".$bgk."><input class=btn type=$buttype"."$stylebb value=\"»\"></form></td><td valign=top align=center".$bgk."><form name=\"forma$s\" action=\"index.php#f$basket_id\" method=\"POST\"><small><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><select class=input-small name=\"change_status\" onchange=\"javascript:document.forma$s.submit()\"$styleaa><option selected value=\"$basket_status\">".@$lang[$basket_status]."</option>
<option value=8>".$lang[8]."</option><option value=494>".$lang[494]."</option><option value=496>".$lang[496]."</option><option value=497>".$lang[497]."</option><option value=498>".$lang[498]."</option><option value=500>".$lang[500]."</option><option value=499>".$lang[499]."</option><option value=495>".$lang[495]."</option><option value=489>".$lang[489]."</option><option value=501>".$lang[501]."</option>$dopoptions<option></option><option value=515>".$lang[515]."</option><option></option><option value=493>".$lang[493]."</option></select>&nbsp;&nbsp;</form></small></td>
<td valign=top".$bgk."><input class=\"btn btn-inverse\" type=button value=\"i\" onClick=\"javascript:window.open('$htpath/admin/orderstatus/$basket_id.txt','fr$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang[616]."\"></td><td valign=top".$bgk."><form class=form-inline action=\"index.php#f$basket_id\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=hidden name=\"add_nakl\" value=1><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><input class=\"btn btn-info\" type=submit value=\"+\" title=\"".$lang[617]."\"></form></td>
<td align=center valign=top".$bgk."><form name=\"formak$s\" action=\"index.php#f$basket_id\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><select class=input-small name=\"change_kur\" onchange=\"javascript:document.formak$s.submit()\"$stylezz><option selected style=\"background-color: ".@$kur[$basket_kur].";\">".@$basket_kur."</option>$kuroptions$optionkur</select></form>
</td></tr>\n\n";
}
}




} else {
if (substr($basket_id,0,1)=="x") {
$basket_sps[$s]= "<!-- $mktimer --><tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td valign=top".$bgk."><small><a name=f$basket_id></a><a href=\"./admin/invoices/inv_".str_replace("x","", $basket_id).".html\"><b><font color=#000080>#".str_replace("x","", $basket_id)."</font></b></a></small></td><td valign=top".$bgk."><img src=\"$image_path/pix.gif\" height=20 width=3></td><td colspan=5 width=100% valign=top".$bgk."><small><a href=\"".str_replace("/admin/baskets","$htpath/admin/baskets",$basket_link)."\"><font color=#000080>$basket_fio</font></a></small></td><td valign=top".$bgk."><!-- input type=button onClick=javascript:window.open('$htpath/admin/edit/index.php?working_file=".str_replace("/admin/baskets", "../baskets", $basket_link)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') value=\"»\" title=\"".$lang['edits']."\"--></td><td valign=top".$bgk."><small>$dates</small></td><td valign=top align=center".$bgk.">
&nbsp;<b>$optus</b></td><td align=center valign=top".$bgk.">&nbsp;<b>".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."</b></td><td valign=top".$bgk.">&nbsp;<b>".($optround*(round($basket_total/$optround)))."</b>
</td><td valign=top".$bgk.">&nbsp;</td><td valign=top align=center".$bgk."><small>".@$lang[$basket_status]."</small>&nbsp;</td><td valign=top".$bgk.">&nbsp;</td><td valign=top".$bgk." align=right><input class=\"btn btn-inverse\" type=button value=\"i\" onClick=\"javascript:window.open('$htpath/admin/orderstatus/".str_replace("x","", $basket_id).".txt','fr$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang[532]."\"></td><td align=center valign=middle".$bgk." style=\"background-color: ".@$kur[$basket_kur].";\">&nbsp;<small>".@$basket_kur."</small>&nbsp;</td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td width=100% colspan=13 align=left".$bgk.">&nbsp;&nbsp;";
if ( file_exists("./admin/kvit/".str_replace("x","", $basket_id).".html")==TRUE) { $basket_sps[$s].="<small><a href=\"./admin/kvit/".str_replace("x","", $basket_id).".html\"><font color=#000080>".$lang[620]." ".str_replace("x","", $basket_id)."</font></a></small>"; }
$basket_sps[$s].=" [<a href=\"#sendkvit\" onClick=javascript:window.open('$htpath/admin/sendkvit.php?kvit=".str_replace("x","", $basket_id)."&mail=".$out[2]."&name=".rawurlencode($out[3])."&adr=".rawurlencode(strip_tags(str_replace("<br>", " ", $out[4])))."&sum=".($optround*(round($basket_total/$optround)))."','frm$basket_id','status=yes,scrollbars=yes,menubar=yes,resizable=yes,location=yes,width=600,height=600,left=10,top=10')><font color=#000080>".$lang['sendform']."</font></a>] / <small>$basket_metro</small> / <small>".str_replace("<br>", " ", $basket_tel)."<br>&nbsp;&nbsp;&nbsp;".$basktags."</small><td width=100% colspan=4 align=right".$bgk."><font class=small>$post_track"."IP: <a href=\"#WHOIS\" onClick=javascript:window.open('$htpath/admin/whois.php?ip=$baskip','wh$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')><b><font color=#000080>$baskip</font></b></a> [$ipis ]</font></td></tr>\n\n";
} else {
$basket_sps[$s]= "<!-- $mktimer --><tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td valign=top".$bgk."><small><a name=f$basket_id></a><a href=\"./admin/invoices/inv_$basket_id.html\"><b><font color=#000080>#$basket_id</font></b></a></small></td><td valign=top".$bgk."><input class=btn type=button onClick=javascript:window.open('$htpath/admin/edit/index.php?working_file=../invoices/inv_$basket_id.html','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') value=\"»\" title=\"".$lang['edits']."\"></td><td width=100% colspan=5 valign=top".$bgk."><small><a href=\"".str_replace("/admin/baskets","$htpath/admin/baskets",$basket_link)."\"><font color=#000080>$basket_fio</font></a></small></td><td valign=top".$bgk."><input class=btn type=button onClick=javascript:window.open('$htpath/admin/edit/index.php?working_file=".str_replace("/admin/baskets", "../baskets", $basket_link)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10') value=\"»\" title=\"".$lang['edits']."\"></td><td valign=top".$bgk.">
<form class=form-inline action=\"index.php#f$basket_id\" id=\"subm_$s\" name=\"subm_$s\" method=\"POST\"><small>$dateform</small></td><td valign=top align=center".$bgk."><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\">
<input type=hidden name=\"change_price\" value=1><input type=hidden name=\"old_basket_opt\" value=".str_replace(",",".",($optround*(round($out[8]*$kurs/$optround))))."><input type=$formtext class=input-small size=4 name=\"new_basket_opt\" value=".str_replace(",",".",($optround*(round($out[8]*$kurs/$optround))))."></td><td valign=top".$bgk."><input type=hidden name=\"old_basket_dostav\" value=".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."><input type=$kurstype class=input-small size=4 name=\"new_basket_dostav\" value=".str_replace(",",".",($optround*(round($out[9]*$kurs/$optround))))."></td><td valign=top".$bgk."><input type=hidden name=\"old_basket_total\" value=".($optround*(round($basket_total/$optround)))."><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><input type=$kurstype class=input-small size=4 name=\"new_basket_total\" value=".($optround*(round($basket_total/$optround))).">
</td><td valign=top".$bgk."><input class=btn type=$buttype"."$stylebb value=\"»\"></form></td><td valign=top align=right".$bgk."><form name=\"forma$s\" action=\"index.php#f$basket_id\" method=\"POST\"><small><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><select class=input-small name=\"change_status\" onchange=\"javascript:document.forma$s.submit()\"$styleaa$styledd><option selected value=\"$basket_status\">".@$lang[$basket_status]."</option>
$dopp<option value=506>".$lang[506]."</option><option value=507>".$lang[507]."</option><option value=508>".$lang[508]."</option><option value=511>".$lang[511]."</option><option value=510>".$lang[510]."</option><option value=513>".$lang[513]."</option><option value=503>".$lang[503]."</option><option value=486>".$lang[486]."</option><option value=491>".$lang[491]."</option><option value=490>".$lang[490]."</option><option value=487>".$lang[487]."</option><option></option><option value=505>".$lang[505]."</option><option value=509>".$lang[509]."</option><option value=514>".$lang[514]."</option><option value=488>".$lang[488]."</option><option></option><option value=492>".$lang[492]."</option><option value=512>".$lang[512]."</option><option value=485>".$lang[485]."</option></select></form>
</small></td><td valign=top".$bgk."><input class=\"btn btn-inverse\" type=button value=\"i\" onClick=\"javascript:window.open('$htpath/admin/orderstatus/$basket_id.txt','fr$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10')\" title=\"".$lang[532]."\"></td><td valign=top".$bgk."><form class=form-inline action=\"index.php#f$basket_id\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=hidden name=\"add_nakl\" value=1><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><input class=\"btn btn-info\" type=submit value=\"+\" title=\"".$lang[617]."\"></form></td>
<td align=center valign=top".$bgk."><form name=\"formak$s\" action=\"index.php#f$basket_id\" method=\"POST\"><input type=\"hidden\" name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"filter\" value=\"$filter\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=\"hidden\" name=\"sort\" value=\"".@$sort."\"><input type=\"hidden\" name=\"change_order\" value=\"$basket_id\"><select class=input-small name=\"change_kur\" onchange=\"javascript:document.formak$s.submit()\"$stylezz><option selected style=\"background-color: ".@$kur[$basket_kur].";\">".@$basket_kur."</option>$kuroptions$optionkur</select></form>
</td></tr>
<tr style=\"color: #000000\"><td bgcolor=\"#".substr(md5($ned),0,6)."\">&nbsp;&nbsp;</td><td width=100% colspan=13 align=left".$bgk.">&nbsp;&nbsp;";
if ( file_exists("./admin/kvit/".str_replace("x","", $basket_id).".html")==TRUE) { $basket_sps[$s].="<small><a href=\"./admin/kvit/".str_replace("x","", $basket_id).".html\"><font color=#000080>".$lang[620]." ".str_replace("x","", $basket_id)."</font></a></small>"; }
$basket_sps[$s].=" [<a href=\"#sendkvit\" onClick=javascript:window.open('$htpath/admin/sendkvit.php?kvit=".str_replace("x","", $basket_id)."&mail=".$out[2]."&name=".rawurlencode($out[3])."&adr=".rawurlencode(strip_tags(str_replace("<br>", " ", $out[4])))."&sum=".($optround*(round($basket_total/$optround)))."','frm$basket_id','status=yes,scrollbars=yes,menubar=yes,resizable=yes,location=yes,width=600,height=600,left=10,top=10')><font color=#000080>".$lang['sendform']."</font></a>] / <small>$basket_metro</small> / <small>".str_replace("<br>", " ", $basket_tel)."<br>&nbsp;&nbsp;&nbsp;".$basktags."</small><td width=100% colspan=4 align=right".$bgk."><font class=small>$post_track"."IP: <a href=\"#WHOIS\" onClick=javascript:window.open('$htpath/admin/whois.php?ip=$baskip','wh$basket_id','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')><b><font color=#000080>$baskip</font></b></a> [$ipis ]</font></td></tr>\n\n";
}

}
if ($filter!=""){
if (!preg_match("/$filter/i", $st)) { unset ($basket_sps[$s]);}
}
if (!isset($sort)) {$sort="";}
if ($sort=="status") {
//отказать
if (($basket_status!=485)&&($basket_status!=$lang[485])) {
unset ($basket_sps[$s]);
}
}
if ($sort=="zakupka") {
//закупка
if (($basket_status!=501)&&($basket_status!=489)&&($basket_status!=$lang[501])&&($basket_status!=$lang[489])) {
unset ($basket_sps[$s]);
}
}
if ($filter=="") { if ($sort=="dels") {} else { if (($sort!="status")&&($sort!="zakupka")) {if (($basket_status==492)||($basket_status==493)||($basket_status==$lang[492])||($basket_status==$lang[493])) { unset ($basket_sps[$s]);}}}}
if (isset($basket_sps[$s])) { $files_found += 1; $s+=1; $oldned=$ned; $oldgod=$god; $oldnedgod="$oldned$oldgod";}



}
}



//sort ($basket_sps);
//reset ($basket_sps);
$st=0;
while ($st < $perpage) {
$gt = 0;
if ((!@$basket_sps[($start+$st)]) || (@$basket_sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$basket_sps[($start+$st)]) || (@$basket_sps[($start+$st)]=="")): $basket_sps[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($st/2)) == "TRUE") {
$back=$style ['table_color2'];
} else {
$back=$style ['table_color1'];
}
$val = $basket_sps[($start+$st)];
$st += 1;
$basket_list .= "$val\n";
}
$total = count ($basket_sps)-$gt;

$numberpages = (ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;


if ($end > $total): $end=$total-1 + $gt; endif;

$stat="<br><center><small>".$lang[203]." <b>$numberpages</b>| ".$lang[558].": <b>$zay</b> |  ".$lang[559].": <b>$ttl </b> ".$lang[561]."";
if(($details[7]=="ADMIN")) {$stat.=", ".$lang[531].": <b>".$totalz."</b>".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[587].": <b>".$pribil."</b>".$currencies_sign[$_SESSION["user_currency"]]."";  $stat.="<br>";}
$stat.="".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b>";
if(($details[7]=="ADMIN")) {$stat.="<br> ".$lang[560]." [$mnow] : <b>".doubleval(@$otchet6[$mnow])."</b>, ".$lang[531].": <b>".($optround*round((0+@$otchet[$mnow])/$optround))."</b>".$currencies_sign[$_SESSION["user_currency"]]."";}
$stat.="</font></small></center><br>";

$stat_otchet="<br>".$lang[581]."=$filter<br><b>".$lang[582].":</b><br><small>".$lang[583]."</small><br><br>
<table border=0 width=100% cellspacing=2 cellpadding=2><tr bgcolor=".$style ['table_color2']."><td valign=top align=center><b>".$lang[551]."</b></td><td valign=top align=center><b>".$lang[552]."</b></td><td align=center valign=top><b>".$lang[553]."</b></td><td valign=top align=center><b>".$lang[554]."</b></td><td valign=top align=center><b>".$lang[555]."</b></td><td valign=top align=center><b>".$lang[556]."</b></td><td valign=top align=center width=100%><b>".$lang[557]."</b></td></tr>";


$zz=0;
$maz=0;
reset($otchet4);
$mazsum=0;
while (list ($key, $st) = each ($otchet4)) {
$zz+=1;
$maxsize[$key]=ceil(doubleval(@$otchet[$key]))+ceil(doubleval(@$otchet3[$key]))+ceil(doubleval(@$otchet7[$key]))+ceil(doubleval(@$otchet14[$key]))+ceil(doubleval(@$otchet11[$key]))+ceil(doubleval(@$otchet13[$key]));
if ($maz<$maxsize[$key]) {$maz=$maxsize[$key]; $mazsum=@$otchet[$key]; $mazmonth=str_replace("01.","".$lang[537]." ", str_replace("02.","".$lang[538]." ",str_replace("03.","".$lang[539]." ",str_replace("04.","".$lang[540]." ",str_replace("05.","".$lang[541]." ",str_replace("06.","".$lang[542]." ",str_replace("07.","".$lang[543]." ",str_replace("08.","".$lang[544]." ",str_replace("09.","".$lang[545]." ",str_replace("10.","".$lang[546]." ",str_replace("11.","".$lang[547]." ",str_replace("12.","".$lang[548]." ",$key))))))))))));}

}
$zz=0;
$maz2=0;
$maz3=0;
reset ($otchets);
reset ($otchets2);
while (list ($key, $st) = each ($otchets)) {
$maxsize2[$key]=ceil(doubleval(@$otchets[$key]));
if ($maz2<$maxsize2[$key]) {$maz2=$maxsize2[$key]; }
}
while (list ($key, $st) = each ($otchets2)) {
$maxsize3[$key]=ceil(doubleval(@$otchets2[$key]));
if ($maz3<$maxsize3[$key]) {$maz3=$maxsize3[$key]; }
}
$plu=1;
$plu2=1;
if ($maz!=0) {$plu=0;}
if ($maz2!=0) {$plu2=0;}
$delit=$plu+($maz/$maxdl);

$delit2=$plu2+(($maz2+$maz3)/100);
$zz=0;
reset($otchet4);

while (list ($key, $st) = each ($otchet4)) {
$zz+=1;
if (is_long(($zz/2))) {$back=$style ['table_color2']; } else { $back=$style ['table_color1']; }
$tmpgg=explode(".",$key);
$prevy=$tmpgg[0].".".(doubleval($tmpgg[1])-1);
$zzprev=(doubleval(@$otchet3[$prevy])+doubleval(@$otchet[$prevy]));
if ((@$otchet4[$prevy])&&(($zzprev)!=0)) { $procny=ceil((((doubleval(@$otchet3[$key])+doubleval(@$otchet[$key]))*100)/(doubleval(@$otchet3[$prevy])+doubleval(@$otchet[$prevy])))-100)."%"; if ($procny>=0) {$procny="<font color=#59945A><b>+".$procny."</b></font>";} else {$procny="<font color=#CD2C2C><b>".$procny."</b></font>"; } } else { $procny="";}

$stat_otchet.="<tr bgcolor=$back><td align=center>$key</td><td><img title=\"".$lang[575]." ".ceil(doubleval(@$otchets[$key]))."\" style=\"background-color: #39743A\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchets[$key]))/$delit2)."><img style=\"background-color: #CD2C2C\" src=$image_path/pix.gif height=10 title=\"".$lang[503]." ".ceil(doubleval(@$otchets2[$key]))."\" width=".ceil((doubleval(@$otchets2[$key]))/$delit2)."></td><td align=center>".@$otchet2[$key]."</td><td align=center>".doubleval(@$otchet5[$key])."</td><td align=center>".doubleval(@$otchet6[$key])."</td><td><small><b>". ceil(doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]))."</b></small></td><td width=100%>
<img title=\"".$lang[579]." ".$lang[571]." ".ceil(doubleval(@$otchet10[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #39743A\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet10[$key]))/$delit)."><img title=\"".$lang[556]." ".$lang[571]." ".ceil(doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key])) ."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #59945A\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]))/$delit)."><img title=\"".$lang[584]." ".$lang[579]." ".$lang[571]." ".ceil(doubleval(@$otchet13[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #5DC062\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet13[$key]))/$delit)."><img title=\"".$lang[585]." ".$lang[571]." ".ceil(doubleval(@$otchet3[$key]-@$otchet13[$key]-@$otchet14[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #6DD072\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet3[$key]-@$otchet13[$key]-@$otchet14[$key]))/$delit)."><img title=\"".$lang[586]." ".$lang[571]." ".ceil(doubleval(@$otchet14[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #7DE082\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet14[$key]))/$delit)."><img title=\"".$lang[562]." ".$lang[571]." ".ceil(doubleval(@$otchet11[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #b28ab2\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet11[$key]))/$delit)."><img title=\"".$lang[494]." ".$lang[571]." ".ceil(doubleval(@$otchet9[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #d2aad2\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet9[$key]))/$delit)."><img  style=\"background-color: #CD2C2C\" src=$image_path/pix.gif height=10 title=\"".$lang[503]." ".$lang[571]." ".ceil(doubleval(@$otchet7[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" width=".ceil((doubleval(@$otchet7[$key]))/$delit).">
<small> ".str_replace("01.","<font color=#b94a48><b>NEW YEAR!</b></font> ".$lang[537]." ", str_replace("02.","".$lang[538]." ",str_replace("03.","".$lang[539]." ",str_replace("04.","".$lang[540]." ",str_replace("05.","".$lang[541]." ",str_replace("06.","".$lang[542]." ",str_replace("07.","".$lang[543]." ",str_replace("08.","".$lang[544]." ",str_replace("09.","".$lang[545]." ",str_replace("10.","".$lang[546]." ",str_replace("11.","".$lang[547]." ",str_replace("12.","".$lang[548]." ",$key))))))))))))." <b>
".ceil(doubleval(@$otchet3[$key])+doubleval(@$otchet[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."</b> ".@$procny."</small></td></tr>\n";
}


$stat_otchet.="</table>";

$s=0;
$pp="";
while ($s < $numberpages) {
if (($start/$perpage)==$s) {
$pp.= "<b>" . ($s+1) . "</b> | ";
} else {
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?action=view_baskets&start=" . ($s*$perpage) . "&perpage=$perpage&sort=$sort&listing=".@$listing."&filter=$filter\">" . ($s+1) . "</a> | ";
}
$s+=1;
}

if(($details[7]=="ADMIN")) {$optpricen="<small><b>".$lang[578]."</b></small>";} else {$optpricen="";}
$basket_list="<noindex>$stat<center><form class=form-inline action=\"index.php?action=view_baskets&start=$start&perpage=$perpage&sort=dels\" method=GET>".$lang[574].":<input name=filter type=text class=input-small size=20 value=\"".@$filter."\"><input class=\"btn btn-primary\" type=submit value=\"OK\"><input type=hidden name=\"action\" value=\"$action\"><input type=\"hidden\" name=\"listing\" value=\"$listing\"><input type=hidden name=\"start\" value=\"$start\"><input type=hidden name=\"perpage\" value=\"$perpage\"><input type=hidden name=\"sort\" value=\"".@$sort."\"></form><br><br><small>$pp</small></center><table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td valign=top colspan=\"18\"><br><table width=100% border=0 cellspacing=3 cellpadding=0><tr><td valign=top width=20% align=left></td><td align=right valign=top width=80%><small>
<a href=\"index.php?action=view_baskets&sort=&listing=1&filter=$filter\">".$lang['adm4']."</a> / <a href=\"index.php?action=view_baskets&sort=&filter=$filter&listing=2\">".$lang[536]."</a> / <a href=\"index.php?action=view_baskets&sort=status&listing=".@$listing."&filter=$filter\">".$lang[618]."</a> / <a href=\"index.php?action=view_baskets&sort=dels&listing=".@$listing."&filter=$filter\">".$lang[493]."</a> / <a href=\"index.php?action=view_baskets&sort=zakupka&listing=".@$listing."&filter=$filter\">".$lang[501]."</a></small></td></tr></table></td></tr><tr bgcolor=$nc6>
<td colspan=3 align=center valign=top style=\"border:1px solid $nc0\"><small><b>#</b></small></td>
<td align=center colspan=6 valign=top style=\"border:1px solid $nc0\"><small><b>".$lang[75].", ".$lang[73].",".$lang[72]."</b></small></td>
<td align=center valign=top style=\"border:1px solid $nc0\"><small><b>".$lang[371]."</b></small></td>
<td align=center valign=top style=\"border:1px solid $nc0\">$optpricen</td>
<td align=center valign=top style=\"border:1px solid $nc0\"><small><b>".$lang[530]."</b></small></td>
<td align=center valign=top style=\"border:1px solid $nc0\"><small><b>".$lang[531]."</b></small></td>
<td align=center colspan=4 valign=top style=\"border:1px solid $nc0\"><small><b>".$lang[397].", ".$lang[532]."</b></small></td>
<td align=center colspan=4 valign=top style=\"border:1px solid $nc0\"><small><b>".$lang[533]."</b></small></td>
</tr><tr><td></td><td colspan=16><br><br> ".$lang[534].": <b>".date("W", time())."</b> (".date("m.Y", time()).")</td></tr>$basket_list";

if ($end==$total) {$wheis="<img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=100% height=4>"; if($details[7]=="ADMIN") {
	$razopt=(0-($optround*(round((0+$dostw2[$oldnedgod])/$optround)))+($optround*(round((0+@$dostw25[$oldnedgod])/$optround))));
	$fst="";
	if ($razopt>=0) {$fst=" style=\"color: #FFFFFF; background-color: #008000\"";} else {$fst=" style=\"color: #FFFFFF; background-color: #800000\"";}

$viruchil="";
reset ($kur);
while (list ($keye, $ste) = each ($kur)) {
if ((@$dostw26[$oldnedgod][$keye]!=0)||(@$dostw28[$oldnedgod][$keye]!=0)) {
	if (($keye!="")&&($keye!="-")) {
$viruchil.= "<tr><td><img src=\"$image_path/pix.gif\" style=\"background-color: $ste\" width=10 height=10>&nbsp;</td><td><b>$keye</b>&nbsp;</td><td>".$dostw26[$oldnedgod][$keye]."(".$lang[489].")</td><td>-".@$dostw27[$oldnedgod][$keye]."(".$lang[563].")</td><td>-</td><td>".@$dostw28[$oldnedgod][$keye]."(".$lang[494].")</td><td>=</td><td><b>".(@$dostw26[$oldnedgod][$keye]-@$dostw27[$oldnedgod][$keye]-@$dostw28[$oldnedgod][$keye])."</b>".$currencies_sign[$_SESSION["user_currency"]]."</td></tr>\n";
}
}

}
if ($viruchil!="") {
$wheis.="<table border=0>$viruchil</table>";
}
	$wheis.="<br><b>".$lang[575].": ".@$dostw11[$oldnedgod]."</b> | ".$lang[578].": ".
str_replace(",",".",($optround*(round((0+@$dostw2[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." / <font$fst>".str_replace(",",".",$razopt)."</font> | ".$lang[494].": ".
str_replace(",",".",($optround*(round((0+@$dostw9[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[562].": ".
str_replace(",",".",($optround*(round((0+@$dostw3[$oldnedgod]+@$dostw10[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." (".$lang[576].":".
str_replace(",",".",($optround*(round(@$dostw3[$oldnedgod]/$optround))))." + ".$lang[577].":". str_replace(",",".",($optround*(round(@$dostw10[$oldnedgod])/$optround))).") | ".$lang[489].": ".($optround*(round((0+@$dostw1[$oldnedgod])/$optround)))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[556].": <b>".str_replace(",",".",($optround*(round((0+@$dostw1[$oldnedgod]-@$dostw2[$oldnedgod]-@$dostw3[$oldnedgod]-@$dostw9[$oldnedgod])/$optround))))."</b>".$currencies_sign[$_SESSION["user_currency"]]."<br>";
if((@$dostw4[$oldnedgod]>0)||(@$dostw5[$oldnedgod]>0)||(@$dostw6[$oldnedgod]>0)) {
	$razopt=(0-($optround*(round((0+$dostw2[$oldnedgod]+$dostw5[$oldnedgod])/$optround)))+($optround*(round((0+@$dostw25[$oldnedgod])/$optround))));
	$fst="";
	if ($razopt>=0) {$fst=" style=\"color: #FFFFFF; background-color: #008000\"";} else {$fst=" style=\"color: #FFFFFF; background-color: #800000\"";}
	$wheis.="<b>".$lang[584].": ".(@$dostw11[$oldnedgod]+@$dostw12[$oldnedgod])."</b> | ".$lang[578].": ".str_replace(",",".",($optround*(round((0+$dostw2[$oldnedgod]+$dostw5[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." / <font$fst>".str_replace(",",".",$razopt)."</font> | ".$lang[494].": ".str_replace(",",".",($optround*(round((0+@$dostw9[$oldnedgod])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[562].": ".str_replace(",",".",($optround*round((0+@$dostw3[$oldnedgod]+@$dostw6[$oldnedgod]+@$dostw10[$oldnedgod])/$optround)))." | ".$lang[489].": ".($optround*(round((0+@$dostw1[$oldnedgod]+@$dostw4[$oldnedgod])/$optround)))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[556].":
<b>".str_replace(",",".",($optround*(round((0+$dostw1[$oldnedgod]+$dostw4[$oldnedgod]-$dostw2[$oldnedgod]-$dostw3[$oldnedgod]-$dostw5[$oldnedgod]-$dostw6[$oldnedgod]-$dostw9[$oldnedgod])/$optround))))."</b>".$currencies_sign[$_SESSION["user_currency"]]."<br>"; }}
$basket_list.= "<tr><td valign=top><img src=\"$image_path/pix.gif\" style=\"background-color: #".substr(md5($oldned),0,6)."\" width=10 height=4></td><td width=100% colspan=17 align=right>$wheis<br><img src=\"$image_path/pix.gif\" style=\"background-color: #cccccc\" width=100% height=1><br><img src=\"$image_path/pix.gif\" style=\"background-color: #ffffff\" width=100% height=3></td></tr>";
}
$basket_list.="</table><table cellspacing=5 border=0><tr><td colspan=2><b>".$lang[564].":</b></td></tr>
<tr>
<td><b>".$lang[504]."</b> - ".$lang[565]."<br>
<b>".$lang[506]."</b> - ".$lang[535]."<br>
<b>".$lang[508]."</b> - ".$lang[535]."<br>
<b>".$lang[510]."</b> - ".$lang[535]."<br>
<b>".$lang[512]."</b> - ".$lang[535]."<br>
</td><td>
<b>".$lang[503]."</b> - ".$lang[562]."+".$lang[563]." (".$lang[566].")<br>
<b>".$lang[513]."</b> - ".$lang[562]."+".$lang[563].", ".$lang[568]."-".$lang[563]."<br>
<b>".$lang[485]."</b> - ".$lang[562]."+".$lang[563]." (".$lang[567]."), ".$lang[568]."-".$lang[563]."<br>
<b>".$lang[487]."</b> - ".$lang[562]."+".$lang[563].", ".$lang[489]."-".$lang[563]."<br>
<b>".$lang[492]."</b> - ".$lang[569]."<br>
<b>".$lang[494]."</b> (".$lang[570].") - ".$lang[568]."-".$lang[494]."</td></tr></table>

$flv

<br><center><small>$pp</small><br><img src=\"$htpath/$metrofile\"><br>$stat";
//if(($details[7]=="ADMIN")) {$basket_list.=" ".$lang[572]." ".@$mazmonth." - ".$lang[489].": <b>$mazsum</b> ".$currencies_sign[$_SESSION["user_currency"]]." ";}
$basket_list.="</center></noindex>";
if(($details[7]=="ADMIN")&&($listing==2)) {
$basket_list.="$stat_otchet\n";}
$total-=1;

if ($files_found==0): $error = "<font color=$nc2><b>".$lang[588]."</b></font>"; endif;
if ($s==0): $basket_list.="<b>".$lang[42]."!</b> ".$lang[588].""; endif;
}

?>
