<?php
$width=700;
$height=600;
$xx=0;
$w1=599;
$h1=261;
$h2=262;
$h3=263;
$h4=259;
$h5=260;

$h6=560;
$mapsd="<map name=\"map\">";
$lang[516]="OK";
if($details[7]=="ADMIN") {
$otchet2=0;
$oldnedgod="";
$listmas3=Array();
$listmas4=Array();
$otchet2=Array();







$mmet=Array();


$blij="";
$pred="";
//end


$kuroptions="";
$staterr=0;
$otchets=Array();
$otchets2=Array();
$otchet4=Array();
$otchet5=Array();
$closeweek="";
$koluch=2;
$maxdl=200;
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

if (!isset($tracknum)){$tracknum="";} if (!preg_match("/^[а-яА-Яa-zA-Z0-9_\.\?\&\ \%\(\)\/-]+$/i",$tracknum)) { $tracknum="";}
$refr="";
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
$stamptd=explode(".",$outd[6]);
$mktimer=mktime(0,0,1,doubleval($stamptd[1]),doubleval($stamptd[0]),doubleval($stamptd[2]))-$g;
$g+=1;
$listmas3[$mktimer]=$st;
}
@krsort($listmas3);
@reset($listmas3);
unset ($keym, $st);
unset($listmas);
$file="./admin/baskets/list2.txt";
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
$indem=str_replace("Москва_", "", str_replace(" ", "_", @$out[5]));
@$basket_metro=@$mmet[$indem].str_replace("Москва ","", @$out[5]);
@$basket_date=@$out[6];
@$basket_total=($optround*(round((0+@$out[7]*$kurs)/$optround)));
@$basket_del=($optround*(round((0+@$out[8]*$kurs)/$optround)));
@$basket_opl=($optround*(round((0+@$out[9]*$kurs)/$optround)));
@$basket_status=@$out[10];
@$basket_comment=@$out[11];
@$basket_kur=@$out[12];
@$basket_post=trim(str_replace("\n", "", @$out[13]));

$out[14]=trim(str_replace("\n", "", @$out[14]));
$out[15]=trim(str_replace("\n", "", @$out[15]));
if($out[14]==""){$out[14]=$post_track_url;}
if($out[15]==""){$out[15]=$post_track_name;}
$tmpmass=explode("<br>",$basket_date);
@$baskip=$tmpmass[1];
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
$kurstype="text";
$buttype="submit";
$daylater=((date("d", time())+30*date("m", time())+365*date("Y", time()))-$dayofyear);
$mktimer=mktime(0,0,1,doubleval($stampt[1]),doubleval($stampt[0]),doubleval($stampt[2]));
$ned=date("W", $mktimer);
$god=date("Y", $mktimer);
$nedgod="$ned$god";
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
if (!isset($dostwotk[$nedgod])) {$dostwotk[$nedgod]=0;}


$styledd="";
$optionkur="";

$dopoptions="";
if (($basket_status==485)||($basket_status==$lang[485])||($basket_status==$lang[486])||($basket_status==486)) {$dostwotk[$nedgod]+=1;$otchets2[$month]=@$otchets2[$month]+1; $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" bgcolor=\"#FCA7A7\""; $zzz="9999";$otchet5[$month]=@$otchet5[$month]+1; $otchet7[$month]=@$otchet7[$month]+$basket_total;}
if (($basket_status==487)||($basket_status==$lang[487])||($basket_status==516)||($basket_status==$lang[516])) {$otchets[$month]=@$otchets[$month]+1; $dostw11[$nedgod]+=1; $ttl+=1; $pribil=$pribil+($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet10[$month]=@$otchet10[$month]+($optround*(round((0+$out[8]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $totalz+=doubleval($basket_total); $dostw1[$nedgod]+=($optround*(round((0+$out[7]*$kurs)/$optround))); $dostw2[$nedgod]+=($optround*(round((0+$out[8]*$kurs)/$optround))); $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround)));  $dost_opt+=(($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-
($optround*(round((0+$out[9]*$kurs)/$optround)))); $bgk=" bgcolor=\"#B6DBB6\""; $otchet[$month]=@$otchet[$month]+$basket_total; $otchet2[$month]=@$otchet2[$month]+1; $otchet6[$month]=@$otchet6[$month]+1;  }
if (($basket_status==488)||($basket_status==$lang[488])) {$otchets[$month]=@$otchets[$month]+1; $dostw11[$nedgod]+=1; $ttl+=1; $pribil=$pribil+($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet10[$month]=@$otchet10[$month]+($optround*(round((0+$out[8]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $totalz+=doubleval($basket_total); $dostw1[$nedgod]+=($optround*(round((0+$out[7]*$kurs)/$optround))); $dostw2[$nedgod]+=($optround*(round((0+$out[8]*$kurs)/$optround))); $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround)));
 $dost_opt+=(($optround*(round((0+$out[7]*$kurs)/$optround)))-($optround*(round((0+$out[8]*$kurs)/$optround)))-($optround*(round((0+$out[9]*$kurs)/$optround)))); $bgk=" bgcolor=\"#B6DBB6\""; $otchet[$month]=@$otchet[$month]+$basket_total; $otchet2[$month]=@$otchet2[$month]+1; $otchet6[$month]=@$otchet6[$month]+1;  }
if (($basket_status==489)||($basket_status==$lang[489])) { @$dostw1[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet[$month]=@$otchet[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil+=($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" bgcolor=\"#a6cBa6\""; }
if (($basket_status==490)||($basket_status==491)||($basket_status==492)||($basket_status==$lang[493])||($basket_status==$lang[490])||($basket_status==$lang[491])||($basket_status==$lang[492])||($basket_status==$lang[493])) {$bgk=" bgcolor=\"#d2d2d2\""; }
if (($basket_status==494)||($basket_status==495)||($basket_status==496)||($basket_status==497)||($basket_status==498)||($basket_status==499)||($basket_status==500)||($basket_status==$lang[494])||($basket_status==$lang[495])||($basket_status==$lang[496])||($basket_status==$lang[497])||($basket_status==$lang[498])||($basket_status==$lang[499])||($basket_status==$lang[500])) {$otchet9[$month]=@$otchet9[$month]+($optround*(round((0+$out[9]*$kurs)/$optround)));  $dostw9[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround)));  $otchet7[$month]=@$otchet7[$month]+$basket_total; $bgk=" bgcolor=\"#d2aad2\""; }
if (($basket_status==501)||($basket_status==502)||($basket_status==$lang[501])||($basket_status==$lang[502])) {$otchet9[$month]=@$otchet9[$month]+($optround*(round((0+$out[9]*$kurs)/$optround)));  $dostw9[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround)));  $otchet7[$month]=@$otchet7[$month]+$basket_total; $bgk=" bgcolor=\"#FFCC99\""; $dopoptions="<option value=502>".$lang[502]."</option>";}
if (($basket_status==503)||($basket_status==$lang[503])) {$dostwotk[$nedgod]+=1; $otchets2[$month]=@$otchets2[$month]+1; $dostw10[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $bgk=" bgcolor=\"#FFD7D7\""; $otchet5[$month]=@$otchet5[$month]+1; $otchet7[$month]=@$otchet7[$month]+$basket_total;}
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
if (($basket_status==513)||($basket_status==514)||($basket_status==$lang[513])||($basket_status==$lang[514])) {$dostwotk[$nedgod]+=1;$otchets2[$month]=@$otchets2[$month]+1; $dostw3[$nedgod]+=($optround*(round((0+$out[9]*$kurs)/$optround))); $pribil-=($optround*(round((0+$out[9]*$kurs)/$optround))); $otchet11[$month]=@$otchet11[$month]+($optround*(round((0+$out[9]*$kurs)/$optround))); $dost_opt-=($optround*(round((0+$out[9]*$kurs)/$optround)));  $otchet5[$month]=@$otchet5[$month]+1; $otchet7[$month]=@$otchet7[$month]+$basket_total;}
if (($basket_status==510)||($basket_status==511)||($basket_status==509)||($basket_status==$lang[510])||($basket_status==$lang[511])||($basket_status==$lang[509])){$otchets[$month]=@$otchets[$month]+1; $dostw12[$nedgod]+=1; }
if (($basket_status==512)||($basket_status==$lang[512])){$dostw12[$nedgod]+=1; $optionkur=$blij;}
if (($basket_status==506)||($basket_status==507)||($basket_status==505)||($basket_status==508)||($basket_status==$lang[506])||($basket_status==$lang[507])||($basket_status==$lang[505])||($basket_status==$lang[508])){$dostw12[$nedgod]+=1;  $optionkur=$blij;}

$whei=1;
$wheis="";
if (!isset($sort)) {$sort="";}
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

$stat="<br><center><small> ".$lang[558].": <b>$zay</b> |  ".$lang[559].": <b>$ttl </b> ".$lang[561]."";
if(($details[7]=="ADMIN")) {$stat.=", ".$lang[531].": <b>".$totalz."</b>".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[587].": <b>".$pribil."</b>".$currencies_sign[$_SESSION["user_currency"]].""; $stat.="<br>";}
$stat.="<br>";
if(($details[7]=="ADMIN")) {$stat.="<br> ".$lang[560]." [$mnow] : <b>".@$otchet6[$mnow]."</b>, ".$lang[531].": <b>".@$otchet[$mnow]."</b>".$currencies_sign[$_SESSION["user_currency"]]."";}
$stat.="</font></small></center><br>";

$stat_otchet="<br><small>".$lang[583]."</small><br><br>
<table border=0 width=100% cellspacing=2 cellpadding=2><tr bgcolor=".$style ['table_color2']."><td valign=top align=center><b>".$lang[551]."</b></td><td valign=top align=center><b>".$lang[552]."</b></td><td align=center valign=top><b>".$lang[553]."</b></td><td valign=top align=center><b>".$lang[554]."</b></td><td valign=top align=center><b>".$lang[555]."</b></td><td valign=top align=center><b>".$lang[556]."</b></td><td valign=top align=center width=100%><b>".$lang[557].", ".$currencies_sign[$_SESSION["user_currency"]]."</b></td><td valign=top align=center width=100%><small>".$lang[489]."</small></td><td valign=top align=center width=100%><small>".$lang[556]."</small></td></tr>";


$zz=0;
$maz=0;
reset($otchet4);
while (list ($key, $st) = each ($otchet4)) {
$zz+=1;
$maxsize[$key]=ceil(doubleval(@$otchet[$key]))+ceil(doubleval(@$otchet3[$key]))+ceil(doubleval(@$otchet7[$key]))+ceil(doubleval(@$otchet14[$key]))+ceil(doubleval(@$otchet11[$key]))+ceil(doubleval(@$otchet13[$key]));
if ($maz<$maxsize[$key]) {$maz=$maxsize[$key]; $mazsum=@$otchet[$key]; $mazmonth=str_replace("01.","".$lang[537]." ", str_replace("02.","".$lang[538]." ",str_replace("03.","".$lang[539]." ",str_replace("04.","".$lang[540]." ",str_replace("05.","".$lang[541]." ",str_replace("06.","".$lang[542]." ",str_replace("07.","".$lang[543]." ",str_replace("08.","".$lang[544]." ",str_replace("09.","".$lang[545]." ",str_replace("10.","".$lang[546]." ",str_replace("11.","".$lang[547]." ",str_replace("12.","".$lang[548]." ",$key))))))))))));}

}
$zz=0;
$maz=0;
$mazd=0;
reset($otchet4);
while (list ($key, $st) = each ($otchet4)) {
$zz+=1;
$maxsize[$key]=ceil(doubleval(@$otchet[$key]))+ceil(doubleval(@$otchet3[$key]))+ceil(doubleval(@$otchet7[$key]))+ceil(doubleval(@$otchet14[$key]))+ceil(doubleval(@$otchet11[$key]))+ceil(doubleval(@$otchet13[$key]));
$maxsized[$key]=ceil(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]);
if ($maz<$maxsize[$key]) {$maz=$maxsize[$key]; $mazsum=@$otchet[$key]; $mazmonth=str_replace("01.","".$lang[537]." ", str_replace("02.","".$lang[538]." ",str_replace("03.","".$lang[539]." ",str_replace("04.","".$lang[540]." ",str_replace("05.","".$lang[541]." ",str_replace("06.","".$lang[542]." ",str_replace("07.","".$lang[543]." ",str_replace("08.","".$lang[544]." ",str_replace("09.","".$lang[545]." ",str_replace("10.","".$lang[546]." ",str_replace("11.","".$lang[547]." ",str_replace("12.","".$lang[548]." ",$key))))))))))));}
if ($mazd<$maxsized[$key]) {$mazd=$maxsized[$key]; $mazsumd=@$otchet[$key]; $mazmonthd=str_replace("01.","".$lang[537]." ", str_replace("02.","".$lang[538]." ",str_replace("03.","".$lang[539]." ",str_replace("04.","".$lang[540]." ",str_replace("05.","".$lang[541]." ",str_replace("06.","".$lang[542]." ",str_replace("07.","".$lang[543]." ",str_replace("08.","".$lang[544]." ",str_replace("09.","".$lang[545]." ",str_replace("10.","".$lang[546]." ",str_replace("11.","".$lang[547]." ",str_replace("12.","".$lang[548]." ",$key))))))))))));}

}
$zz=0;
$maz2=0;
$maz3=0;
$mazd2=0;
$mazd3=0;
reset ($otchets);
reset ($otchets2);
while (list ($key, $st) = each ($otchets)) {
$maxsize2[$key]=ceil(doubleval(@$otchets[$key]));
$maxsized2[$key]=ceil(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]);
if ($maz2<$maxsize2[$key]) {$maz2=$maxsize2[$key]; }
if ($mazd2<$maxsized2[$key]) {$mazd2=$maxsized2[$key]; }
}
while (list ($key, $st) = each ($otchets2)) {
$maxsize3[$key]=ceil(doubleval(@$otchets2[$key]));
if ($maz3<$maxsize3[$key]) {$maz3=$maxsize3[$key]; }
$maxsized3[$key]=ceil(@$otchets[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]);
if ($mazd3<$maxsized3[$key]) {$mazd3=$maxsized3[$key]; }
}
$plu=1;
$plu2=1;
$plud=1;
$plud2=1;
if ($maz!=0) {$plu=0;}
if ($maz2!=0) {$plu2=0;}
if ($mazd!=0) {$plud=0;}
if ($mazd2!=0) {$plud2=0;}
$delit=$plu+($maz/$maxdl);
$delitd=$plud+($mazd/$maxdl);

$delit2=$plu2+(($maz2+$maz3)/50);
$zz=0;
reset($otchet4);

while (list ($key, $st) = each ($otchet4)) {
$zz+=1;
if (is_long(($zz/2))) {$back=$style ['table_color2']; } else { $back=$style ['table_color1']; }
$tmpgg=explode(".",$key);
$prevy=$tmpgg[0].".".(doubleval($tmpgg[1])-1);
$zzprev=(doubleval(@$otchet3[$prevy])+doubleval(@$otchet[$prevy]));
if ((@$otchet4[$prevy])&&(($zzprev)!=0)) { $procny=ceil((((doubleval(@$otchet3[$key])+doubleval(@$otchet[$key]))*100)/(1+doubleval(@$otchet3[$prevy])+doubleval(@$otchet[$prevy])))-100); if ($procny<1000) { if ($procny>=0) {$procny="<font color=#59945A><b>+".$procny."%</b></font>";} else {$procny="<font color=#CD2C2C><b>".$procny."%</b></font>"; } } else { $procny="";}} else { $procny="";}
if ((@$otchet4[$prevy])&&(($zzprev)!=0)) { $procny2=ceil((((@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key])*100)/(1+@$otchet[$prevy]-@$otchet9[$prevy]-@$otchet10[$prevy]-@$otchet11[$prevy]))-100); if ($procny2<1000) {if ($procny2>=0) {$procny2="<font color=#59945A><b>+".$procny2."%</b></font>";} else {$procny2="<font color=#CD2C2C><b>".$procny2."%</b></font>"; } } else { $procny2="";} } else { $procny2="";}

$stat_otchet.="<tr bgcolor=$back><td align=center>$key</td><td><img title=\"".$lang[575]." ".ceil(doubleval(@$otchets[$key]))."\" style=\"background-color: #39743A\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchets[$key]))/$delit2)."><img style=\"background-color: #CD2C2C\" src=$image_path/pix.gif height=10 title=\"".$lang[503]." ".ceil(doubleval(@$otchets2[$key]))."\" width=".ceil((doubleval(@$otchets2[$key]))/$delit2)."></td><td align=center>".@$otchet2[$key]."</td><td align=center>".doubleval(@$otchet5[$key])."</td><td align=center>".doubleval(@$otchet6[$key])."</td><td><small><b>". ceil(doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]))."</b></small></td><td width=100%>
<img title=\"".$lang[579]." ".$lang[571]." ".ceil(doubleval(@$otchet10[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #316a79\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet10[$key]))/$delit)."><img title=\"".$lang[556]." ".$lang[571]." ".ceil(doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key])) ."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #59945A\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]))/$delit)."><img title=\"".$lang[584]." ".$lang[579]." ".$lang[571]." ".ceil(doubleval(@$otchet13[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #5DC062\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet13[$key]))/$delit)."><img title=\"".$lang[585]." ".$lang[571]." ".ceil(doubleval(@$otchet3[$key]-@$otchet13[$key]-@$otchet14[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #6DD072\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet3[$key]-@$otchet13[$key]-@$otchet14[$key]))/$delit)."><img title=\"".$lang[586]." ".$lang[571]." ".ceil(doubleval(@$otchet14[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #7DE082\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet14[$key]))/$delit)."><img title=\"".$lang[562]." ".$lang[571]." ".ceil(doubleval(@$otchet11[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #b28ab2\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet11[$key]))/$delit)."><img title=\"".$lang[494]." ".$lang[571]." ".ceil(doubleval(@$otchet9[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" style=\"background-color: #d2aad2\" src=$image_path/pix.gif height=10 width=".ceil((doubleval(@$otchet9[$key]))/$delit)."><img  style=\"background-color: #CD2C2C\" src=$image_path/pix.gif height=10 title=\"".$lang[503]." ".$lang[571]." ".ceil(doubleval(@$otchet7[$key]))."".$currencies_sign[$_SESSION["user_currency"]]."\" width=".ceil((doubleval(@$otchet7[$key]))/$delit).">
<small> ".str_replace("01.","<font color=#b94a48><b>NEW YEAR!</b></font> ".$lang[537]." ", str_replace("02.","".$lang[538]." ",str_replace("03.","".$lang[539]." ",str_replace("04.","".$lang[540]." ",str_replace("05.","".$lang[541]." ",str_replace("06.","".$lang[542]." ",str_replace("07.","".$lang[543]." ",str_replace("08.","".$lang[544]." ",str_replace("09.","".$lang[545]." ",str_replace("10.","".$lang[546]." ",str_replace("11.","".$lang[547]." ",str_replace("12.","".$lang[548]." ",$key))))))))))))." <b>
".ceil(doubleval(@$otchet[$key]))."</b></td><td>".@$procny."</td><td>".@$procny2."</td></tr>\n";
$optsize=ceil((doubleval(@$otchet10[$key]))/$delit);
$dohodsize=ceil((doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]))/$delit);
$dohodsized=ceil((doubleval(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]))/$delitd);
$otkazsize=ceil((doubleval(@$otchet7[$key]))/$delit);
$virsize=ceil((doubleval(@$otchet[$key]))/$delit);
$tratsize=ceil((doubleval(@$otchet9[$key]))/$delit);
//echo "\"$key\"";


/*if ($w1!=599) {
imageline($img,$w1,$h3,($w1-20),(263-$otkazsize),$otkazcol);
imageline($img,$w1,$h1,($w1-20),(261-$optsize),$optcol);
imageline($img,$w1,$h2,($w1-20),(262-$dohodsize),$dohodcol);
imageline($img,$w1,$h4,($w1-20),(259-$virsize),$vircol);
imageline($img,$w1,$h5,($w1-20),(260-$tratsize),$tratcol);

imageline($img,$w1,$h6,($w1-20),(560-$dohodsized),$dohodcol);
}
*/
$xx+=10;
if ($xx>=20) {$xx=0;}




//ImageString($img, 1, ($w1-19),(245-$virsize), ceil(@$otchet[$key]), $black2 );
$mapsd.="\n<area shape=\"circle\" coords=\"".($w1-19).",".(259-$virsize).",9\" title=\"".ceil(@$otchet[$key])." ($key)\" href=\"#date_$key\">";
$dohodi=ceil(@$otchet[$key]-@$otchet9[$key]-@$otchet10[$key]-@$otchet11[$key]);
$mapsd.="\n<area shape=\"circle\" coords=\"".($w1-19).",".(261-$optsize).",5\" title=\"".ceil(@$otchet10[$key])." ($key)\" href=\"#date_$key\">";
$mapsd.="\n<area shape=\"circle\" coords=\"".($w1-19).",".(260-$tratsize).",5\" title=\"".ceil(@$otchet9[$key])." ($key)\" href=\"#date_$key\">";

$mapsd.="\n<area shape=\"circle\" coords=\"".($w1-19).",".(262-$dohodsize).",5\" title=\"".$dohodi." ($key)\" href=\"#date_$key\">";

$mapsd.="\n<area shape=\"circle\" coords=\"".($w1-19).",".(560-$dohodsized).",9\" title=\"".$dohodi." ($key)\" href=\"#date_$key\">";


$h1=(261-$optsize);
$h2=(262-$dohodsize);
$h3=(263-$otkazsize);
$h4=(259-$virsize);
$h5=(260-$tratsize);

$h6=(560-$dohodsized);
$w1-=20;
}
$mapsd.="</map>";

$stat_otchet.="</table>";

$s=0;
$pp="";

$neds=date("W", time());
$gods=date("Y", time());
$nedgods="$neds$gods";
$wheis="<font color=#39743A>".$lang[575].": <b>".@$dostw11[$nedgods]."</b></font> | <font color=#b94a48>".$lang[503].": <b>".@$dostwotk[$nedgods]."</b></font> | ".$lang[578].": ".str_replace(",",".",($optround*(round((0+@$dostw2[$nedgods])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[494].": ". str_replace(",",".",($optround*(round((0+@$dostw9[$nedgods])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[562].": ".str_replace(",",".",($optround*(round((0+@$dostw3[$nedgods]+@$dostw10[$nedgods])/$optround))))."".$currencies_sign[$_SESSION["user_currency"]]." (".$lang[576].":".str_replace(",",".",($optround*(round(@$dostw3[$nedgods]/$optround))))." + ".$lang[577].":".str_replace(",",".",($optround*(round(@$dostw10[$nedgods]/$optround)))).")<br>".$lang[489].":
 ".($optround*(round((0+@$dostw1[$nedgods])/$optround)))."".$currencies_sign[$_SESSION["user_currency"]]." | ".$lang[556].":
<b>".str_replace(",",".",($optround*(round((0+@$dostw1[$nedgods]-@$dostw2[$nedgods]-@$dostw3[$nedgods]-@$dostw9[$nedgods])/$optround))))."</b>".$currencies_sign[$_SESSION["user_currency"]]."";

$basket_list="$stat
<br><br><font size=2>".$lang[534].": <b>".date("W", time())."</b> (".date("m.Y", time())."), ". $lang[584] .": <b>".str_replace(",",".",($optround*(round((0+$dostw1[$nedgods]+$dostw4[$nedgods]-$dostw2[$nedgods]-$dostw3[$nedgods]-$dostw5[$nedgods]-$dostw6[$nedgods]-$dostw9[$nedgods])/$optround))))."</b>".$currencies_sign[$_SESSION["user_currency"]]." (".$lang[556].") <br>$wheis</font><br><br>$basket_list";


if(($details[7]=="ADMIN")) {$basket_list.=" ".$lang[572]." ".@$mazmonth." - ".$lang[489].": <b>".@$mazsum."</b> ".$currencies_sign[$_SESSION["user_currency"]]." ";}
$basket_list.="</center>";
if($details[7]=="ADMIN") {
$basket_list.="$stat_otchet\n<br><img src=$htpath/admin/graf.php usemap=\"#map\" border=\"0\" width=\"700\" height=\"600\">$mapsd";}
$total-=1;

//if ($files_found==0): $error = "<font color=$nc2><b>".$lang[588]."</b></font>"; endif;
//if ($s==0): $basket_list.="<b>".$lang[42]."!</b> ".$lang[588].""; endif;

}
?>
