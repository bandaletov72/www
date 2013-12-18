<?php
$setsales="";
$sale_content="";
$datepicker="";
$onsubm="";
$hidden="hidden";
$ssfile="$base_loc/set_sales.txt";
$salearr=Array();
if (isset($_REQUEST['setsales'])) {
$reqw=trim(strip_tags($_REQUEST['setsales'],"<br>"));
$salearr=explode("<br>",$reqw);
$btmp=Array();
$k=0;
while (list($key,$val)=each($salearr)) {
if (trim($val)!="") {
$tmp=explode(";",$val);
$sf=$tmp[1];
$chars=intval(strlen($sf));
$sortby="0";
if ($chars==1){ $sortby="00000000$sf"; }
if ($chars==2){ $sortby="0000000$sf"; }
if ($chars==3){ $sortby="000000$sf"; }
if ($chars==4){ $sortby="00000$sf"; }
if ($chars==5){ $sortby="0000$sf"; }
if ($chars==6){ $sortby="000$sf"; }
if ($chars==7){ $sortby="00$sf"; }
if ($chars==8){ $sortby="0$sf"; }
if ($chars==9){ $sortby="$sf"; }
$btmp[$k]=$sortby." |$val<br>";
$k++;
}
}
unset ($tmp, $key,$val);
natcasesort($btmp);
reset ($btmp);
$reqw="";
while (list($key,$val)=each($btmp)) {
$tmp=explode("|",$val);
$reqw=$tmp[1].$reqw;
}
$fp=fopen($ssfile,"w");
fputs($fp,$reqw);
fclose($fp);
$setsales.="<script language=javascript>
$(document).ready(function() {
$('#MD4').modal('show');
});

</script>
<div class=\"modal hide\" id=\"MD4\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"MD4Label\" aria-hidden=\"true\">
<div class=\"modal-body\">$lang[1635]<a href=\"#\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</a> </div>
</div>";
}

if (file_exists($ssfile)) {
$fp=fopen($ssfile,"r");
$fsz=filesize($ssfile);
$sale_content=fread($fp,$fsz);
fclose($fp);
if ($fsz>0) {$hidden=""; }
}
$ncc=1;
$cc_num=1;
unset($tmp);
reset ($whsalerprice);
$whoptions="<option value=\"\">$lang[1639]</option>";
while (list($kw,$vw)=each($whsalerprice)) {
$whoptions.="<option>$kw</option>";

}
$str2="";
$tabh="";
$row="<div id=row$ncc"."_nullrow_ style=\"border-bottom: 1px solid $nc6; padding:5px 0px 5px 0px;\">";
$key=0;
$row.="<table class=table2><tr><td width=16%><input autocomplete=\"off\" class=\"span2\" type=text id=inp$ncc"."_nullrow_$key value=\"\" placeholder=\"$lang[1627]\"></td>";
$tabh.="<table class=table2><tr><td width=16% class=small>$lang[1627]</td>";

$key++;
$str2.=";";
$row.="<td width=12%><input autocomplete=\"off\" class=\"span1\" type=text id=inp$ncc"."_nullrow_$key value=\"\" title=\"$lang[1628]\" placeholder=\"$init_currency\"></td>";
$tabh.="<td width=8% class=small>$lang[1628]</td>";
$key++;
$str2.=";";
$row.="<td width=12%><input autocomplete=\"off\" class=\"span1\" type=text id=inp$ncc"."_nullrow_$key value=\"\" title=\"$lang[1629]\" placeholder=\"$lang[1634]\"></td>";
$tabh.="<td width=8% class=small>$lang[1629]</td>";
$key++;
$str2.=";";
$row.="<td width=17%><input autocomplete=\"off\" class=\"span2\" data-date-format=\"$ewc_dateformat\" type=text id=inp$ncc"."_nullrow_$key value=\"\" placeholder=\"$ewc_dateformat\"></td>";
$tabh.="<td width=16% class=small>$lang[1630]</td>";
$key++;
$str2.=";";
$row.="<td width=17%><input autocomplete=\"off\" class=\"span2\" data-date-format=\"$ewc_dateformat\" type=text id=inp$ncc"."_nullrow_$key value=\"\" placeholder=\"$ewc_dateformat\"></td>";
$tabh.="<td width=16% class=small>$lang[1631]</td>";
$key++;
$str2.=";";
$row.="<td width=17%><select class=span2 id=inp$ncc"."_nullrow_$key>$whoptions</td>";
$tabh.="<td width=16% class=small>$lang[1636]</td>";
$key++;
$str2.=";";
$row.="<td width=17%><select class=span2 id=inp$ncc"."_nullrow_$key><option value=0></option><option value=1>$lang[1624]</option><option value=2>$lang[1633]</option></td>";
$tabh.="<td width=15% class=small>$lang[1632]</td><td width=10%>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr></table>";
$key++;
$str2.=";";
$qcols=$key;
$row.="<td><a class=\"btn\" onclick=delrow$ncc(nullrow)><i class=icon-remove></i></a></td></tr></table></div>";
$datepicker.="init$ncc();\n";
$onsubm.="checkrow".$ncc."();\n";
$setsales.="<span id=ta_".$cc_num." class=hidden>
<form class=\"form-inline\" action=\"index.php\" method=\"POST\" name=\"form\" target=\"_self\" id=\"thisform\">
<input type=\"hidden\" name=\"action\" value=\"setsales\">
<textarea id=cc$ncc name=\"setsales\" cols=40 rows=10 style=\"width:100%\" autocomplete=\"off\" onchange=\"document.getElementById('cc".$ncc."').innerHTML=this.value;\">".$sale_content."</textarea></form></span><!--b id=ic_".$cc_num." class=\"icon-eye-open mr ml b1\" onclick=\"if (document.getElementById('ta_".$cc_num."').className=='hidden') { document.getElementById('ta_".$cc_num."').className=''; document.getElementById('ic_".$cc_num."').className='icon-eye-close mr ml b1'; document.getElementById('row".$ncc."').innerHTML=''; } else { document.getElementById('ta_".$cc_num."').className='hidden';document.getElementById('ic_".$cc_num."').className='icon-eye-open mr ml b1'; init".$ncc."();}\"></b-->
<script language=javascript>
var nrow".$ncc."=0;
function addrow".$ncc."() {
checkrow".$ncc."();
document.getElementById('sendb').className='';
document.getElementById('cc".$ncc."').innerHTML=document.getElementById('cc".$ncc."').innerHTML+'$str2<br>';
init".$ncc."();
}



function init".$ncc."() {
nrow".$ncc."=0;
document.getElementById('row".$ncc."').innerHTML='';
var z=document.getElementById('cc".$ncc."').innerHTML;
var tabh='".$tabh."';
if (z!='') {
var t=z.split('&lt;br&gt;');
for(var i = 0; i < t.length; i++) {
if (t[i]!='') {
nrow".$ncc."++;
var str='".str_replace("\"", "\\\"", $row)."';
str=str.replace(/nullrow/g,nrow".$ncc.");
if (i>0) {tabh='';}
document.getElementById('row".$ncc."').innerHTML=tabh+document.getElementById('row".$ncc."').innerHTML+str;

}
}
nrow".$ncc."=0;
for(var i = 0; i < t.length; i++) {
if (t[i]!='') {
nrow".$ncc."++;
var tt=t[i].split(';');
for(var j = 0; j < $qcols; j++) {
if (document.getElementById('inp".$ncc."_'+nrow".$ncc."+'_'+j)) {
document.getElementById('inp".$ncc."_'+nrow".$ncc."+'_'+j).value=tt[j];
}
}
$('#inp".$ncc."_'+nrow".$ncc."+'_3').datepicker({ 'weekStart':".$ewc_startweek." });
$('#inp".$ncc."_'+nrow".$ncc."+'_4').datepicker({ 'weekStart':".$ewc_startweek." });
}
}
}
}

function delrow".$ncc."(drow) {
var r='';
for(var i = 1; i <= nrow".$ncc."; i++) {
var c='';
for(var j = 0; j < $qcols; j++) {
if (document.getElementById('inp".$ncc."_'+i+'_'+j)) {
var v=document.getElementById('inp".$ncc."_'+i+'_'+j).value;
c=c+v+';';
}
}
if (i!=drow) {
r=r+c+'<br>';
}
}
document.getElementById('cc".$ncc."').innerHTML=r;
init".$ncc."();
}

function checkrow".$ncc."() {
var r='';
for(var i = 1; i <= nrow".$ncc."; i++) {
var c='';
for(var j = 0; j < $qcols; j++) {
if (document.getElementById('inp".$ncc."_'+i+'_'+j)) {
var v=document.getElementById('inp".$ncc."_'+i+'_'+j).value;
c=c+v+';';
}
}
r=r+c+'<br>';
document.getElementById('cc".$ncc."').innerHTML=r;
}
}

$(document).ready(function() {
".str_replace("days: [\"Sunday\", \"Monday\", \"Tuesday\", \"Wednesday\", \"Thursday\", \"Friday\", \"Saturday\", \"Sunday\"]", "days: [\"".$lang['Sun']."\", \"".$lang['Mon']."\", \"".$lang['Tue']."\", \"".$lang['Wed']."\", \"".$lang['Thu']."\", \"".$lang['Fri']."\", \"".$lang['Sat']."\", \"".$lang['Sun']."\"]",
str_replace("daysShort: [\"Sun\", \"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]", "daysShort: [\"".$lang[777]."\", \"".$lang[771]."\", \"".$lang[772]."\", \"".$lang[773]."\", \"".$lang[774]."\", \"".$lang[775]."\", \"".$lang[776]."\", \"".$lang[777]."\"]",
str_replace("daysMin: [\"Su\", \"Mo\", \"Tu\", \"We\", \"Th\", \"Fr\", \"Sa\", \"Su\"]", "daysMin: [\"".$lang[777]."\", \"".$lang[771]."\", \"".$lang[772]."\", \"".$lang[773]."\", \"".$lang[774]."\", \"".$lang[775]."\", \"".$lang[776]."\", \"".$lang[777]."\"]",
str_replace("months: [\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\", \"August\", \"September\", \"October\", \"November\", \"December\"]", "months: [\"".$lang[537]."\", \"".$lang[538]."\", \"".$lang[539]."\", \"".$lang[540]."\", \"".$lang[541]."\", \"".$lang[542]."\", \"".$lang[543]."\", \"".$lang[544]."\", \"".$lang[545]."\", \"".$lang[546]."\", \"".$lang[547]."\", \"".$lang[548]."\"]",
str_replace("monthsShort: [\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"]", "monthsShort: [\"".substr($lang[537],0,3)."\", \"".substr($lang[538],0,3)."\", \"".substr($lang[539],0,3)."\", \"".substr($lang[540],0,3)."\", \"".substr($lang[541],0,3)."\", \"".substr($lang[542],0,3)."\", \"".substr($lang[543],0,3)."\", \"".substr($lang[544],0,3)."\", \"".substr($lang[545],0,3)."\", \"".substr($lang[546],0,3)."\", \"".substr($lang[547],0,3)."\", \"".substr($lang[548],0,3)."\"]",
implode("", file("./js/bootstrap-datepicker.js")))))))."

$datepicker
});

</script><div id=\"row".$ncc."\"></div>
<br><a class=\"btn btn-success pull-left\" onclick=\"addrow$ncc();\"><i class=\"icon-plus icon-white\"></i> ".$lang['add']."</a><div class=\"muted pull-right\">$lang[1642]</div><div class=clearfix></div><br>
<div id=sendb class=\"$hidden\" align=center><a class=\"btn btn-primary btn-large\" style=\"margin-top: 10px; margin-right: 20px;\" onclick=\"$onsubm"."document.getElementById('thisform').submit()\"><i class=icon-ok></i> ".$lang[527]."</a></div>";

?>
