<?php
if (version_compare(phpversion(), "4.1.0", "<") === true) {
$_GET &= $HTTP_GET_VARS;
$_POST &= $HTTP_POST_VARS;
$_SERVER &= $HTTP_SERVER_VARS;
$_FILES &= $HTTP_POST_FILES;
$_ENV &= $HTTP_ENV_VARS;

if (isset($HTTP_COOKIE_VARS)) $_COOKIE &= $HTTP_COOKIE_VARS;
}

if (!ini_get("register_globals")) {
extract($_GET, EXTR_SKIP);
extract($_POST, EXTR_SKIP);
extract($_COOKIE, EXTR_SKIP);

}
$curstatus="";
$datepicker="";
$hhh="";
$onsubm="";
//<li><a href=\"#tab2\" data-toggle=\"tab\"><i class=icon-list-alt></i>$lang[1550]</a></li>
$dops1=Array();
$dops2=Array();
$maxdops=9;
if ((!@$view) || (@$view=="") || (@$view=="no")): $view=""; endif;
$fold=".."; require ("../templates/lang.inc");
if (!isset($speek)) {
$speek=$language;
} else {
$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($speek==$stl){
$found_lang=1;
}
}
if ($found_lang==0){
$speek=$language;
}
}
$section1="";
$section2="";
$section3="";
$section4="";
$section5="";
require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
$handle=opendir("../templates/$template/$speek/");
unset($k,$v,$tmp);
while (($file = readdir($handle))!==FALSE) {

if (substr($file,0,14)=="custom_column_") {
$idx=str_replace(".inc", "", str_replace("custom_column_", "",$file));
$idx=doubleval($idx);
$tmp=file("../templates/$template/$speek/$file");
$typehead[$idx]=" data-provide=\"typeahead\" data-items=\"4\" data-source=\"[";
while(list($k,$v)=each($tmp)) {
$typehead[$idx].="&quot;".trim(str_replace("\"","", str_replace("'","",strip_tags($v))))."&quot;,";
}
$typehead[$idx].="&quot;-&quot;]\"";
}
}
closedir($handle);


header("Content-type: text/html; charset=$codepage");
echo "<!DOCTYPE html>
<html>
<head>";
$fold="..";
require ("../templates/$template/css.inc");

echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\"><title>EDITOR</title>";
echo $css;
echo "<link href=\"$htpath/css/datepicker.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />
<script language=javascript>
function resize_textarea(to, id)
{
var orig = 40;
var step = 120;
var textarea = document.getElementById(id);
if (to == 0)
{
var t_height = textarea.style.height.replace('px', '');
if (t_height <= orig) textarea.style.height = orig + 'px';
else
{
var height = parseInt(t_height) - parseInt(step);
textarea.style.height = height + 'px';
}

}
else
{
var t_height = textarea.style.height.replace('px', '');
var height = parseInt(t_height)+parseInt(step);

textarea.style.height = height + 'px';
}
return false;
}
</script>
</head>
<body onload=\"javascriprt:self.focus()\" bgcolor=$nc0 link=$nc2 text=$nc5>
";

if (!isset($id)) { $id=0; }
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$create_file) || (@$create_file=="")): $create_file=""; endif;
if ((!@$klon) || (@$klon=="")): $klon=""; endif;
if ((!@$c) || (@$c=="")): $c=""; endif;
if (($klon == "1")&&($c!="")) {




$st=0;
$lt=0;
$listnews[0]=$c."0000";
$handle=opendir("../.$base_loc/content/");
while (($file = readdir($handle))!==FALSE) {
if (($file == '.') || ($file == '..') || ($file == 'config.inc')) {
continue;
} else {
$out=explode(".",$file);
$cc = $out[0];
if ((substr($file, -4)==".del") || ((substr($file, 0, 1))!==$c)) {
continue;
} else {
if (strlen($cc)!==1) {
$listnews[$lt]=$cc;
$lt+=1;
}
}
}
}
closedir ($handle);
rsort ($listnews);




$nomer=substr($listnews[0], 1);
settype ($nomer, "integer");
$nomer+=1;

$chars=strlen($nomer);
if ($chars==1): $nomer="000$nomer"; endif;
if ($chars==2): $nomer="00$nomer"; endif;
if ($chars==3): $nomer="0$nomer"; endif;
if ($chars==4): echo "<p>".$lang[429]."\n";exit; endif;
$fp = fopen ("../.$base_loc/content/$c$nomer.txt", "w");
if (!$fp) {
echo "<p>".$lang[44]." <b>../.$base_loc/content/$c$nomer.txt</b> ".$lang[45]."\n";
exit;
}
flock ($fp, LOCK_EX);
if ($c=="a") {
$month=date ("d:m:Y");
fwrite ($fp, "==$month==");
} else {
if ($c=="c") {
$curd=date ("d.m.Y");

fwrite ($fp, "==$curd==");
} else {
fwrite ($fp, "==".$lang[430]." $c$nomer==");
}
}
flock ($fp, LOCK_UN);
fclose ($fp);
echo "<p>".$lang[447]." <b>../.$base_loc/content/$c$nomer.txt</b>.<br><br><br>
<a href='./index.php'>".$lang['back']."</a>\n
<meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL='edit/index.php?working_file=?speek=$speek&working_file=../.".$base_loc."/content/$c$nomer.txt'\">";
exit;
}







$st=0;
$fcontents = file(".$base_file");

$allrazdels=$fcontents;
while (list ($line_num, $line) = each ($allrazdels)) {
$out=explode("|",$line);
if (($line!="")&&($line!="\n")) {

$tmpsubrazdels[$st]= @$out[1]. "|" . @$out[2];
$st += 1;
} else {
$tmpsubrazdels[$st]= "|";
$st += 1;
}
}
reset ($tmpsubrazdels);
$tmpsub= array_unique ($tmpsubrazdels);
while (list ($line_num, $line) = each ($tmpsub)) {
$out=explode("|",$line);
$ra=$out[0];
if ((!@$subr[$ra]) || (@$subr[$ra]=="")): $subr[$ra]=""; endif;
$subr[$ra] .= "$out[1]|";
}

$razdel="";
while (list ($line_num, $line) = each ($subr)) {
$out=explode("|",$line);
while (list ($line_num2, $line2) = each ($out)) {
if ($line2!=""): $razdel .= "<option value='$line_num|$line2'>$line_num / $line2</option>\n"; endif;
}
}
$st=0;
$fcontents = file(".$base_file");
$line = @$fcontents[$id];
if (($line!="")&&($line!="\n")) {
$out=explode("|",$line);
@$nazv=@$out[3];
$headersect="<form class=form-inline action='".$scriptprefix."change.php' method='POST' name='form' target='_self' id=\"thisform\"><input type='hidden' name='id' value=$id><input type='hidden' name='speek' value='$speek'>
    <div class=\"tabbable\">
    <ul class=\"nav nav-tabs\">
    <li class=\"active\"><a href=\"#tab1\" data-toggle=\"tab\"><i class=icon-home></i> $lang[1549]</a></li>
    [dops]
    <li><a href=\"#tab3\" data-toggle=\"tab\"><i class=icon-align-left></i> $lang[1551]</a></li>
    <li><a href=\"#tab4\" data-toggle=\"tab\"><i class=icon-picture></i> $lang[1552]</a></li>
    <li><a href=\"#tab5\" data-toggle=\"tab\"><i class=icon-download-alt></i> $lang[1553] <sup>[att_qty]</sup></a></li>
    <li><a href=\"#tab6\" data-toggle=\"tab\"><i class=icon-eye-close></i></a></li>
    </ul>
    <div class=\"tab-content\" style=\"height:450px; overflow:auto;\">
    ";
$namesect="<div class=pull-left><small>".$lang[448]." <b>ID=$id</b></small></div><div class=pull-right><small>$nazv</small></div><div class=clear></div> ";
$section1.= "<div style=\"margin: 0px;\">
    <p>
<table width=100% cellspacing=0 cellpadding=5>
<tr bgcolor=$nc6>
<td align='left' valign='top'><b>".$lang[419]."</b></td>
<td align='left' valign='top'><b>".$lang['price']."</b></td>
<td align='left' valign='top'><b>".$lang[449]."</b></td>
<td align='left' valign='top'><b>";
$section1.=$lang[427];
$section1.="</b></td>
    <td align='left' valign='top'><b>".$lang[355]."</b></td>

    <td rowspan=2 align='right' valign='top'><a class=btn onclick=\"document.location.href='".$scriptprefix."del.php?speek=".$speek."&id=$id'\"><i class=icon-remove></i><br>".$lang[744]."</a>
    </td>
</tr>

";






$nomer = $out[0];
@$dir=@$out[1];
@$subdir=@$out[2];

@$price=@$out[4];
@$opt=@$out[5];
@$ext_id=@$out[6];
@$description=@$out[7];
@$kwords=@$out[8];
@$foto1=@$out[9];
@$foto2=@$out[10];
@$vitrin=@$out[11];
@$onsale=substr(@$out[12],0,1);
@$cur=substr(@$out[12],1,3);
@$brand_name=@$out[13];
@$ext_lnk=@$out[14];
@$full_descr=@$out[15];
@$kolvo=@$out[16];
if (($vitrin=="")|($vitrin=="0")) {$vitrin="";}
settype ($price, "double");
$full_descr = str_replace("<br>", chr(10), $full_descr);
$nazv = str_replace("<br>", chr(10), $nazv);
$kwords = str_replace("<br>", chr(10), $kwords);
$description = str_replace("<br>", chr(10), $description);
$foto=$foto1;
$unifid=md5(@$out[3]." ID:".@$out[6]);
$hist="";
$baseloc_main=str_replace("/db_index.txt", "", $base_file);
$baseloc_speek=substr( $baseloc_main,-3);
$statusfile=".$baseloc_main/status/".substr($unifid,0,2)."/".$unifid."/status.txt.history.txt";
if (file_exists($statusfile)) {
$sp=array_reverse(file($statusfile));;
while (list($kh,$vh)=each($sp)) {
if (trim($vh)!="") {
$h=explode("|", trim($vh));
$hist.=date("d.m.Y H:i:s", $h[1])." ".$h[0]. "<div class=muted>".$h[2]." ". $h[3]."</div>";
}
}
}
unset ($sp);

$statusfile=".$baseloc_main/status/".substr($unifid,0,2)."/".$unifid."/status.txt";
if (file_exists($statusfile)) {
$sp=file($statusfile);
$curstatus=trim($sp[0]);
}
$section1.= "<tr bgcolor='$nc6'>
<td align='left' valign='top' title=\"COLUMN 6\"><input type=hidden name=status id=sstatus value=\"$curstatus\"><input class=input-small type=text name='ext_id' size='20' value='$ext_id' ><input type='hidden' name='nomer' value='$nomer'> </td>
    <td align='left' valign='top' title=\"COLUMN 4\">$price</td>
    <td align='left' valign='top' title=\"COLUMN 11\"><input class=input-mini type=text size='3' name='vitrin' value=\"$vitrin\"".@$typehead[11]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_11#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td>
    <td align='left' valign='top' title=\"COLUMN 12\"><select class=input-mini size='1' name='onsale'><option selected value='$onsale'>".substr($onsale,0,1)."</option><option value='1'>".$lang['yes']."</option><option value='0'>".$lang['no']."</option></select></td>
    <td align='left' valign='top' title=\"COLUMN 13\"><input class=input-small type=text name='brand_name' value='$brand_name' size=20".@$typehead[13]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_13#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td>
    </tr>
    </table>
";
$section4.= "<div class=pull-right style=\"margin:10px;\">";
if ($foto=="") {
$section4.= "<img id=smallimg src=$image_path/pix.gif border=0 class=img-polaroid>";
} else {
$foto=str_replace("<img ","<img style=\"cursor:pointer; cursor: hand;\" onclick=\"var str=document.getElementById('textarea_foto2').value; str=str.replace(/&lt;/g, '<'); str=str.replace(/&gt;/g, '>'); document.getElementById('modal_foto2').innerHTML=str; $('#myModal').modal('show');\" class=img-polaroid id=smallimg ", str_replace("<img src='photos","<img src='$htpath/photos", $foto));
$section4.= $foto;
}
$section4.= "</div>";
$fcontentsac=file(".$base_loc/catid.txt");
$drs="";
$subdrs="";
$subdrsm=Array();
$zfm=0;
while (list ($line_numfc, $linefc) = each ($fcontentsac)) {
if (trim ($linefc)!="") {
$outfc=explode("|",$linefc);
$iindfc=$outfc[1]."|".$outfc[2]."|";
$podstava[$iindfc]=$outfc[0];
if ($outfc[2]=="") {$drsm[$zfm]=$outfc[1]; } else {
$subdrsm[$zfm]=$outfc[2];
$zfm++;
}
}
}
$ddb=array_unique($drsm);
natcasesort($ddb);
reset($ddb);
while (list ($kb,$vb)=each($ddb)) {

$drs.="<li><a href='#' onclick='drs(\"".$vb."\");'>".$vb."</a></li>";
}

$subdb=array_unique($subdrsm);
natcasesort($subdb);
reset($subdb);
while (list ($ksb,$vsb)=each($subdb)) {

$subdrs.="<li><a href='#' onclick='subdrs(\"".$vsb."\");'>".$vsb."</a></li>";
}
unset ($fcontentsac);
$status="";
$clr="";
if (file_exists("../templates/$template/$baseloc_speek/status.inc")) {

$fcontentsac=file("../templates/$template/$baseloc_speek/status.inc");
$lln=0;
while (list ($ln, $linefc) = each ($fcontentsac)) {
if (trim ($linefc)!="") {
if ($lln==0) { $sty=' label-success';}
if ($lln==1) { $sty=' label-warning';}
if ($lln==2) { $sty=' label-important';}
if ($lln==3) { $sty=' label-info';}
if ($lln==4) { $sty=' label-inverse';}
if (trim($linefc)==trim($curstatus)) { $curstatus="<b class=\"label".$sty."\" style=\"font-size:".($main_font_size+4)."pt; padding:8px;\">$curstatus</b>";}
$status.="<li><a href='#' onclick='SetStatus(\"".trim ($linefc)."\",".($lln+1).");'><i class=\"label".$sty."\">&nbsp;</i> ".trim ($linefc)."</a></li>";
$lln++;
}
}
}
if ($status!="") {
$status="<td><ul class=\"nav nav-pills dropup\" style=\"margin:0;\">
<li class=\"dropdown active\">
<a class=\"dropdown-toggle mr ml\" data-toggle=\"dropdown\" href=\"#\">".$lang[397]."<b class=\"caret\"></b></a>
<ul class=\"dropdown-menu\">
<li><a href='#' onclick='SetStatus(\"\",0);'>".$lang[397]." ".$lang[906]."</a></li>
$status
<li class=\"divider\"></li>
<li><a href='$htpath/index.php?action=template&nt=templates/".$template."/".$speek."&t=status#textarea' target=_blank style=\"font-weight:400;\">".$lang[1618]."</a></li>
</ul>
</li>
</ul></td><td><div id=istatus>$curstatus</div></td>";
} else {
$status="<td></td>";
}
$section1.= "<script>
function SetStatus(id,clr) {
var st='';
if (id=='') {
document.getElementById('sstatus').value='na';
} else {
document.getElementById('sstatus').value=id;
}
if (clr==1) { st=' label-success';}
if (clr==2) { st=' label-warning';}
if (clr==3) { st=' label-important';}
if (clr==4) { st=' label-info';}
if (clr==5) { st=' label-inverse';}
document.getElementById('istatus').innerHTML='<b class=\"label'+st+'\" style=\\\"font-size:".($main_font_size+4)."pt; padding:8px; \\\">'+id+'</b>';
}
function drs(id) {
document.getElementById('idir').value=id;
}
function subdrs(id) {
document.getElementById('isubdir').value=id;
}
</script>
<table class=table width=100% cellspacing=0 border=0 cellpadding=2>
<tr>
<td align='right' valign='top'>3. <b>".$lang['name'].":</b></td>
<td align='left' valign='top'><input class=input-large type=text name='nazv' size='60' style=\"width:90%\" value='$nazv'".@$typehead[3]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_3#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td><td>&nbsp;</td>
</tr>
<tr>
<td align='right' valign='top'>1. <b>".$lang[430].":</b></td>
<td align='left' valign='top'><input class=input-large type=text name='dir' id=idir size='60' style=\"width:90%\" value='$dir'".@$typehead[1]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_1#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td><td><ul class=\"nav nav-pills\" style=\"margin:0;\">
<li class=\"dropdown pull-right active\">
<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"><b class=\"caret\"></b></a>
<ul class=\"dropdown-menu\">
$drs
</ul>
</li>
</ul></td>
</tr>
<tr>
<td align='right' valign='top'>2. <b>".$lang[431].":</b></td>
<td align='left' valign='top'><input class=input-large type=text name='subdir' id=isubdir size='60' style=\"width:90%\" value='$subdir'".@$typehead[2]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_2#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td><td><ul class=\"nav nav-pills\" style=\"margin:0;\">
<li class=\"dropdown pull-right active\">
<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"><b class=\"caret\"></b></a>
<ul class=\"dropdown-menu\">
$subdrs
</ul>
</li>
</ul></td>
</tr>
";

//custom card add
$c_filename="../templates/$template/$speek/custom_cart.inc";
$cc_cart="";
if (@file_exists($c_filename)==TRUE) {

$custom_cart1=file("../templates/$template/$speek/custom_cart.inc");
if (@file_exists("../templates/$template/$speek/cc_".$podstava["$dir|$subdir|"].".inc")) {
$custom_cart2=file("../templates/$template/$speek/cc_".$podstava["$dir|$subdir|"].".inc");
$custom_cart=Array_merge($custom_cart1,$custom_cart2);
} else {
$custom_cart=$custom_cart1;
}
$totaldops=0;
$cnums=0;

while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if ((trim($cc_line)!="")&&(@$ccc[0]!="")&&(@$ccc[1]!="")){
$ncc=17+$cc_num;
//echo $ncc. " " .$ccc[0] . " " .@$out[$ncc]."<br>";
if ((@$ccc[0]!="g:attach")&&(@$ccc[0]!="g:aoption")) {
if (trim(@$ccc[3])=="hidden") {
$hhh.="<tr><td align='right' valign='top'>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]."</td>
<td align='left' valign='top'><input class=input-large type=text id=col".$ncc." name='cc[$cc_num]' size='60' value='".@$out[$ncc]."' style=\"width:90%\"".@$typehead[$ncc]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_".$ncc."#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td></tr>";

} else {
$cnums++;
if ($cnums>$maxdops) {$totaldops++; $cnums=0;}
if (trim(@$ccc[3])=="date") {
$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top'>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]."</td>
<td align='left' valign='top'><input class=\"span2\" value=\"".@$out[$ncc]."\" data-date-format=\"$ewc_dateformat\" id=\"dp$ncc\" type=\"text\" name='cc[$cc_num]' placeholder=\"$ewc_dateformat\"> <span class=muted>$ewc_dateformat</span></td></tr>";
$datepicker.="$('#dp$ncc').datepicker({ 'weekStart':".$ewc_startweek." });\n";
} else {
if (trim(@$ccc[3])=="curdate") {
$dateformat=str_replace("y", "Y", str_replace("dd", "d",str_replace("mm", "m",str_replace("yy", "y", str_replace("yy", "y", $ewc_dateformat)))));

$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top'>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]."</td>
<td align='left' valign='top'><input class=\"span2\" value=\"".date($dateformat." H:i", time())."\" type=\"text\" name='cc[$cc_num]' placeholder=\"$ewc_dateformat\"> <span class=muted>$ewc_dateformat</span></td></tr>";

} else {
if ((trim(@$ccc[3])=="location") &&(trim(@$ccc[4])!="")){
///location
unset($tmp);
$strr=str_replace("\"","", str_replace("[","",str_replace("]","",str_replace("'","",str_replace("[curr]","$cur",trim(@$ccc[4]))))));

$tmp=explode(";", $strr);
$str2="";
$qcols=count($tmp);
$tabh="";
$row="<div id=row$ncc"."_nullrow_ style=\"border-bottom: 1px solid $nc6; padding:5px 0px 5px 0px;\">";
while (list ($key, $val) = each ($tmp)) {
if (trim($val)!="") {
$str2.=";";
if ($key==0) {
$tabh.="<div class=\\\"pull-left muted mr\" style=\\\"width:".floor(80/$qcols)."\\\" align=center>$val</div>";
$row.="<input class=\"span2 pull-left mr\" data-date-format=\"$ewc_dateformat\" style=\"width:".floor(70/$qcols)."\" type=text id=inp$ncc"."_nullrow_$key value=\"\" placeholder=\"$ewc_dateformat\">";
} else {
$tabh.="<div class=\\\"pull-left muted mr\" style=\\\"width:".floor(80/$qcols)."%\\\" align=center>$val</div>";
$row.="<input class=\"span2 pull-left mr\" style=\"width:".floor(80/$qcols)."%\" type=text id=inp$ncc"."_nullrow_$key value=\"\" placeholder=\"$val\">";
}
}
}
$tabh.="<div class=clearfix></div>";
$row.="<div class=pull-right style=\"width:".floor(20/$qcols)."%\"><a class=\"btn\" onclick=delrow$ncc(nullrow)><i class=icon-remove></i></a></div><div class=clearfix></div></div>";
$datepicker.="init$ncc();\n";
$onsubm.="checkrow".$ncc."();\n";
$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top' colspan=2>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]." <span id=ta_".$cc_num." class=hidden><textarea id=cc$ncc name='cc[$cc_num]' cols=40 rows=10 style=\"width:100%\" autocomplete=\"off\" onchange=\"document.getElementById('cc".$ncc."').innerHTML=this.value;\">".@$out[$ncc]."</textarea></span><b id=ic_".$cc_num." class=\"icon-eye-open mr ml b1\" onclick=\"if (document.getElementById('ta_".$cc_num."').className=='hidden') { document.getElementById('ta_".$cc_num."').className=''; document.getElementById('ic_".$cc_num."').className='icon-eye-close mr ml b1'; document.getElementById('row".$ncc."').innerHTML=''; } else { document.getElementById('ta_".$cc_num."').className='hidden';document.getElementById('ic_".$cc_num."').className='icon-eye-open mr ml b1'; init".$ncc."();}\"></b><a class=\"pull-right btn btn-success\" style=\"margin-left:10px;\" onclick=\"addrow$ncc();\"><i class=\"icon-plus\"></i> ".$lang['add']."</a><div class=clearfix></div></td></tr>
<tr><td align='left' valign='top' colspan=2>
<script language=javascript>
var nrow".$ncc."=0;
function addrow".$ncc."() {
checkrow".$ncc."();
document.getElementById('cc".$ncc."').innerHTML=document.getElementById('cc".$ncc."').innerHTML+'$str2^<br>';
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
$('#inp".$ncc."_'+nrow".$ncc."+'_0').datepicker({ 'weekStart':".$ewc_startweek." });
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
</script>
<div id=\"row".$ncc."\"></div></td></tr>";

} else {
if ((trim(@$ccc[3])=="kit") &&(trim(@$ccc[4])!="")){
///kit
unset($tmp);
$strr=str_replace("\"","", str_replace("[","",str_replace("]","",str_replace("'","",str_replace("[curr]","$cur",trim(@$ccc[4]))))));
$tmp=explode(";", $strr);
$qcols=count($tmp);
$tabh="";
$str2="";
$row="<div id=row$ncc"."_nullrow_ style=\"border-bottom: 1px solid $nc6; padding:5px 0px 5px 0px;\">";
while (list ($key, $val) = each ($tmp)) {
if (trim($val)!="") {
$str2.=";";
if ($key==0) {
$tabh.="<div class=\\\"pull-left muted\" style=\\\"margin-right:1%; width:40%\\\" align=center>$val</div>";
$row.="<input class=\"span2 pull-left\" style=\"margin-right:1%; width:40%\" type=text id=inp$ncc"."_nullrow_$key value=\"\" onkeyup=\"calc".$ncc."();\" onchange=\"calc".$ncc."();\" placeholder=\"$val\">";

} else {
$tabh.="<div class=\\\"pull-left muted\" style=\\\"margin-right:1%; width:".floor(60/($qcols+1))."%\\\" align=center>$val</div>";
$row.="<input class=\"span2 pull-left\" style=\"margin-right:1%; width:".floor(60/($qcols+1))."%\" type=text id=inp$ncc"."_nullrow_$key value=\"\" onkeyup=\"calc".$ncc."();\" onchange=\"calc".$ncc."();\" placeholder=\"$val\">";
}
}
}
$row.="<a class=\"btn pull-right\" style=\"margin-right:1%; width:".floor(60/($qcols+1))."%\" onclick=delrow$ncc(nullrow)><i class=icon-remove></i></a><div class=clearfix></div></div>";
$datepicker.="init$ncc();\n";
$onsubm.="checkrow".$ncc."();\n";
$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top' colspan=2>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]." <input type=hidden class=span2 id=cc$ncc name='cc[$cc_num]' value=\"".@$out[$ncc]."\"><a class=\"pull-right btn btn-success\" style=\"margin-left:10px;\" onclick=\"addrow$ncc();\"><i class=\"icon-plus\"></i> ".$lang['add']."</a><div class=clearfix></div></td></tr>
<tr><td align='left' valign='top' colspan=2>
<script language=javascript>
var nrow".$ncc."=0;
function addrow".$ncc."() {
checkrow".$ncc."();
document.getElementById('cc".$ncc."').value=document.getElementById('cc".$ncc."').value+'$str2^<br>';
init".$ncc."();
}



function init".$ncc."() {
nrow".$ncc."=0;
document.getElementById('row".$ncc."').innerHTML='';
var z=document.getElementById('cc".$ncc."').value;
var tabh='".$tabh."';
if (z!='') {
var t=z.split('<br>');
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
document.getElementById('cc".$ncc."').value=r;
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
document.getElementById('cc".$ncc."').value=r;
}
}
</script>
<div id=\"row".$ncc."\"></div></td></tr>";

} else {
if ((trim(@$ccc[3])=="kit2") &&(trim(@$ccc[4])!="")){
///kit2
unset($tmp);
$strr=str_replace("\"","", str_replace("[","",str_replace("]","",str_replace("'","",str_replace("[curr]","$cur",trim(@$ccc[4]))))));
$tmp=explode(";", $strr);
$qcols=count($tmp);
$tabh="";
$str2="";
$row="<div id=row$ncc"."_nullrow_ style=\"border-bottom: 1px solid $nc6; padding:5px 0px 5px 0px;\">";
while (list ($key, $val) = each ($tmp)) {
if (trim($val)!="") {
$str2.=";";
if ($key==0) {
$tabh.="<div class=\\\"pull-left muted\" style=\\\"margin-right:1%; width:50%\\\" align=center>$val</div>";
$row.="<input class=\"span2 pull-left\" style=\"margin-right:1%; width:50%\" type=text id=inp$ncc"."_nullrow_$key value=\"\" onkeyup=\"calc".$ncc."();\" onchange=\"calc".$ncc."();\" placeholder=\"$val\">";

} else {
$tabh.="<div class=\\\"pull-left muted\" style=\\\"margin-right:1%; width:".floor(50/($qcols+1))."%\\\" align=center>$val</div>";
$row.="<input class=\"span2 pull-left\" style=\"margin-right:1%; width:".floor(50/($qcols+1))."%\" type=text id=inp$ncc"."_nullrow_$key value=\"\" onkeyup=\"calc".$ncc."();\" onchange=\"calc".$ncc."();\" placeholder=\"$val\">";
}
}
}
$row.="<a class=\"btn pull-right\" onclick=delrow$ncc(nullrow)><i class=icon-remove></i></a><div class=clearfix></div></div>";
$datepicker.="init$ncc();
calc$ncc();\n";
$onsubm.="checkrow".$ncc."();\n";
$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top' colspan=2>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]." <input type=hidden class=span2 id=cc$ncc name='cc[$cc_num]' value=\"".@$out[$ncc]."\"><a class=\"pull-right btn btn-success\" style=\"margin-left:10px;\" onclick=\"addrow$ncc();\"><i class=\"icon-plus\"></i> ".$lang['add']."</a><div class=clearfix></div></td></tr>
<tr><td align='left' valign='top' colspan=2>
<script language=javascript>
var nrow".$ncc."=0;
function addrow".$ncc."() {
checkrow".$ncc."();
document.getElementById('cc".$ncc."').value=document.getElementById('cc".$ncc."').value+'$str2^<br>';
init".$ncc."();
calc".$ncc."()
}



function init".$ncc."() {
nrow".$ncc."=0;
document.getElementById('row".$ncc."').innerHTML='';
var z=document.getElementById('cc".$ncc."').value;
var tabh='".$tabh."';
if (z!='') {
var t=z.split('<br>');
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
}
}
}
}

function calc".$ncc."() {
var sum=0;
var total=0;
var str1='';
var str2='';
var col1=0;
var col2=0;
var sum1=0;
for(var i = 1; i <= nrow".$ncc."; i++) {
if (document.getElementById('inp".$ncc."_'+i+'_'+0)) {
str1=document.getElementById('inp".$ncc."_'+i+'_'+1).value;
str2=document.getElementById('inp".$ncc."_'+i+'_'+2).value;
col1=parseFloat(str1.replace(/\,/g,'.'));
total=Math.round(total+col1*parseFloat(str2.replace(/\,/g,'.')));
sum1=Math.round(sum1+col1);
}
}
if (total!=0) {
document.getElementById('col4').value=total;
}
if (sum1!=0) {
document.getElementById('col17').value=sum1;
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
document.getElementById('cc".$ncc."').value=r;
init".$ncc."();
calc".$ncc."()
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
document.getElementById('cc".$ncc."').value=r;
}
}
</script>
<div id=\"row".$ncc."\"></div></td></tr>";

} else {
if ((trim(@$ccc[3])=="select") &&(trim(@$ccc[4])!="")){
///select
unset($tmp);
$tmp=explode(";", str_replace("\"","", str_replace("[","",str_replace("]","",str_replace("'","",str_replace("[curr]","$cur", trim(@$ccc[4])))))));
natcasesort($tmp);
$selectf="<option>".implode("</option>\n<option>",$tmp)."</option>\n";

$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top'>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]."</td>
<td align='left' valign='top'><select class=input-mini name='cc[$cc_num]'><option selected>".@$out[$ncc]."</option>\n".$selectf."</select></td></tr>";

} else {

if ((trim(@$ccc[3])=="countries") && (@file_exists("../templates/$template/$speek/custom_country.inc")==true)) {
//countries tips
unset($tmp);
$tmpc=file("../templates/$template/$speek/custom_country.inc");
$ii=0;
while (list ($key, $val) = each ($tmpc)) {
if (trim($val)!="") {
$otc=explode("|",$val);
if (trim($otc[1])!=""){
$tmp[$ii]=str_replace("\"","", str_replace("[","",str_replace("]","",str_replace("'","", str_replace("[curr]","$cur",$otc[1])))));
$ii++;
}
}
}
natcasesort($tmp);
$tip="&quot;".implode("&quot;,&quot;",$tmp)."&quot;";

$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top'>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]."</td>
<td align='left' valign='top'><input class=input-large autocomplete=\"off\" type=text id=col".$ncc." name='cc[$cc_num]' value='".@$out[$ncc]."' style=\"width:90%; margin: 0 auto;\" data-provide=\"typeahead\" data-items=\"4\" data-source=\"[".$tip."]\"><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_country#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td></tr>";

} else {
if ((trim(@$ccc[3])=="") &&(trim(@$ccc[4])!="")){
//tips
unset($tmp);
$tmp=explode(";", str_replace("\"","", str_replace("[","",str_replace("]","",str_replace("'","",str_replace("[curr]","$cur",trim(@$ccc[4])))))));
natcasesort($tmp);
$tip="&quot;".implode("&quot;,&quot;",$tmp)."&quot;";

$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top'>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]."</td>
<td align='left' valign='top'><input class=input-large type=text id=col".$ncc." autocomplete=\"off\" name='cc[$cc_num]' value='".@$out[$ncc]."' style=\"width:90%; margin: 0 auto;\" data-provide=\"typeahead\" data-items=\"4\" data-source=\"[".$tip."]\"><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_cart#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td></tr>";

} else {
//all others

$dops2[$totaldops]= @$dops2[$totaldops]."<tr><td align='right' valign='top'>$ncc. <b>".@$ccc[0]."</b>, ".@$ccc[2]."</td>
<td align='left' valign='top'><input class=input-large type=text id=col".$ncc." name='cc[$cc_num]' size='60' value='".@$out[$ncc]."' style=\"width:90%\"".@$typehead[$ncc]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_".$ncc."#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td></tr>";
}
}
}
}
}
}
}
}
}
} else {
if (@$ccc[0]=="g:attach") {
$defaults=$lang[1572];
if ($out[0]=="electron1000") {$defaults=$lang[1571];}
if ($out[0]=="electron1") {$defaults=$lang[1570];}
$att=str_replace("<br>", "\n", @$out[$ncc]);
$att_qty=count(explode("\n",$att))-1;
$headersect=str_replace("[att_qty]",$att_qty, $headersect);
$section5.= "<tr><td>0. <b>$lang[1569]:</b> <select class=input-mini name=\"item_type\"><option value=".@$out[0].">".$defaults."</option><option value=\"00000\">".$lang[1572]."</option><option value=\"electron1\">".$lang[1570]."</option><option value=\"electron1000\">".$lang[1571]."</option></select><br><br>$ncc. <a class=\"btn btn-success\" onClick=\"javascript:window.open('attach.php?speek=$speek&gtype=1&perpage=6','gal1','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\"><i class=icon-download-alt></i> ".$lang[1554]."</a>
</td>
</tr>
<tr>
<td>
<textarea id=\"att_\" name='cc[$cc_num]' size='60' style=\"width:90%\" rows=5 cols=5>".$att."</textarea><br><i>$lang[1564]</i><br><br><div class=muted>$lang[691]:<br>price.doc~12kb~Latest price<br>price.zip~20kb~Latest price in zip format\n</div>
</td></tr>
";
} else {
if (@$out[$ncc]==1) {
$osel=" checked";
} else {
$osel="";
}
$section5.= "<tr><td><input type=\"hidden\" id=chb2 name=\"cc[$cc_num]\" value=\"".@$out[$ncc]."\"><input id=chb type=checkbox name=\"cc[$cc_num]\" value=1".$osel."> $lang[1555]</td></tr>";
}
}
}
}
}
$dtab="";
$kkk="";
reset ($dops2);
while (list($kk,$vv)=each($dops2)) {
if ($kk>0) {$kkk=" ".($kk+1); }
$dtab.="<li><a href=\"#dtab$kk\" data-toggle=\"tab\"><i class=icon-list-alt></i>$lang[1550]".$kkk."</a></li>";
$section2.="<div class=\"tab-pane\" id=\"dtab$kk\">
<div><table class=table width=100% cellspacing=0 border=0 cellpadding=2>";
$section2.=$vv;
$section2.="</table></div>
</div>";
}
//end
if ($section5=="") {
$section5="<div><a href=\"$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_cart\" target=_blank>$lang[1556]</a></div>";
} else {
$section5="<table class=table border=0 width=100% cellpadding=2 cellspacing=0>".$section5."</table>";
}
$section4.= "<table class=table width=100% border=0 cellpadding=2 cellspacing=0><tr>
<td align='left' valign='top' colspan=2>
9. <a class=\"btn btn-success\" onClick=\"javascript:window.open('newgal.php?speek=$speek&gtype=1','gal2','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\"><i class=icon-th></i> ".$lang[444]."</a>
</td></tr>
<tr><td align='left' valign='top' colspan=2><input class=input-large type=text style=\"width:70%;\" name='foto1' size='60' value=\"$foto1\"></td>
</tr>
<tr>
<td align='left' valign='top'><script language=\"javascript\">
<!--
function clear() {

}
-->
</script>
10. <a class=\"btn btn-success\" onClick=\"javascript:window.open('newgal.php?speek=$speek&gtype=2','gal3','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=580,left=10,top=10');\"><i class=icon-th-large></i>  ".$lang[445]."</a> <a class=btn onclick=\"document.getElementById('textarea_foto2').value='';\"><i class=icon-remove title=\"".$lang[446]."\"></i></a>
<a class=\"btn ml\" onclick=\"javascript: var str=document.getElementById('textarea_foto2').value; str=str.replace(/&lt;/g, '<'); str=str.replace(/&gt;/g, '>'); document.getElementById('modal_foto2').innerHTML=str;\" data-toggle=\"modal\" href=\"#myModal\"><i class=icon-picture></i></a>
</td>
<tr><td align='left' width=100% valign='top' colspan=2><textarea id=textarea_foto2 name='foto2' rows='10' style=\"width:70%;\" cols='60'>".str_replace("<br>", chr(10), $foto2)."</textarea><br><br>
<!-- Modal -->
<div style=\"display: none; top:10px; bottom:10px;\" id=\"myModal\" class=\"modal hide\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
<div class=\"modal-header\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
<h3 id=\"myModalLabel\">".$lang[421]."</h3>
</div>
<div class=\"modal-body\">
<p id=modal_foto2></p>
</div>
<div class=\"modal-footer\">
<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">".$lang[1598]."</button>
</div>
</div></td>
</tr>
</table>";

$section3.= "
<table class=table border=0 cellpadding=0 cellspacing=0 width=100%>
<tr>
<td align='left' valign='top'>7. <b>".$lang['short'].":</b></td>
<tr><td align='left' width=100% valign='top' colspan=2><textarea rows='5' id=textarea_desc name='description' style=\"width:90%;\" cols='60'>$description</textarea></td>
</tr>
<tr>
<td align='left' valign='top'>15. <b>".$lang['description'].":</b></td>
<tr><td align='left' width=100% valign='top' colspan='6'><textarea rows='7' name='full_descr' id=textarea_full style=\"width:90%;\" cols='60'>$full_descr</textarea></td>
</tr>
</table>";

$section1.= "
<tr><td align='left' valign='top' colspan=3>14. <b>".$lang['artlink'].":</b><br><input class=input-large type=text name='ext_lnk' size=40 value='$ext_lnk' style=\"width:90%;\"".@$typehead[14]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_14#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td>
</tr>
<tr>
<td align='left' valign='top' colspan=3>8. <b>".$lang['kwrds'].":</b><br><textarea rows='1' id=textarea_kwords name='kwords' style=\"width:90%; height:30px;\" cols='60'".@$typehead[8].">$kwords</textarea><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_8#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a></td>
</tr></table>
<table class=table2>
<tr>
<td>
<b title=\"COLUMN 16\">".$lang['qty'].":</b>
</td>
<td>
<input class=input-mini type=text name='kolvo' size='3' value='$kolvo' title=\"COLUMN 16\"".@$typehead[16]."><a href=$htpath/index.php?action=template&nt=templates/$template/$speek&t=custom_column_16#textarea title=\"".$lang['edits']."\" target=_blank><i class=icon-edit></i></a>
</td>
<td>
<b title=\"COLUMN 5\">".$lang['148'].":</b>
</td>
<td>
<input class=input-mini id=col5 type=text name='opt' size='3' value='$opt' title=\"COLUMN 5\">
</td>
<td>
<b title=\"COLUMN 4\">".$lang['price'].":</b>
</td>
<td>
<input class=input-mini id=col4 type=text name='price' size='3' value='$price' title=\"COLUMN 4\">
</td>
";
if (count($currencies)>1) {
reset($currencies);
$section1.= "<td><select class=input-mini name=cur title=\"+COLUMN 12\"><option>".$cur."</option>";
while (list($keyc,$valc)=each($currencies)) {
$section1.= "<option>$keyc</option>";
}
$section1.= "</select></td>";
}  else {
$section1.= "<td><b>$init_currency</b></td>";

}
$section1.= "</tr></table>
</p></div>";

echo str_replace("[dops]", $dtab, $headersect)."<div>$namesect</div>
<div class=\"tab-pane active\" id=\"tab1\">
$section1
</div>
$section2
<div class=\"tab-pane\" id=\"tab3\">
<div>$section3</div>
</div>
<div class=\"tab-pane\" id=\"tab4\">
<div>$section4</div>
</div>
<div class=\"tab-pane\" id=\"tab5\">
<div>$section5</div>
</div>
<div class=\"tab-pane\" id=\"tab6\">
<div>$hist<table class=table width=100% cellspacing=0 border=0 cellpadding=2>$hhh</table></div>
</div>
</div>
<div class=pull-left><table border=0><tr>$status<td></td></tr></table></div><div class=pull-right><a class=\"btn btn-primary\" style=\"margin-top: 10px; margin-right: 20px;\"  onclick=\"if(\$('#chb').attr('checked') == 'checked') { document.getElementById('chb2').value='1';} else {document.getElementById('chb2').value='';} $onsubm"."document.getElementById('thisform').submit()\"><i class=icon-ok></i> ".$lang['ch']."</a></div>
<div class=clearfix></div>

</div> </form>
<script>
$(document).ready(function() {
".str_replace("days: [\"Sunday\", \"Monday\", \"Tuesday\", \"Wednesday\", \"Thursday\", \"Friday\", \"Saturday\", \"Sunday\"]", "days: [\"".$lang['Sun']."\", \"".$lang['Mon']."\", \"".$lang['Tue']."\", \"".$lang['Wed']."\", \"".$lang['Thu']."\", \"".$lang['Fri']."\", \"".$lang['Sat']."\", \"".$lang['Sun']."\"]",
str_replace("daysShort: [\"Sun\", \"Mon\", \"Tue\", \"Wed\", \"Thu\", \"Fri\", \"Sat\", \"Sun\"]", "daysShort: [\"".$lang[777]."\", \"".$lang[771]."\", \"".$lang[772]."\", \"".$lang[773]."\", \"".$lang[774]."\", \"".$lang[775]."\", \"".$lang[776]."\", \"".$lang[777]."\"]",
str_replace("daysMin: [\"Su\", \"Mo\", \"Tu\", \"We\", \"Th\", \"Fr\", \"Sa\", \"Su\"]", "daysMin: [\"".$lang[777]."\", \"".$lang[771]."\", \"".$lang[772]."\", \"".$lang[773]."\", \"".$lang[774]."\", \"".$lang[775]."\", \"".$lang[776]."\", \"".$lang[777]."\"]",
str_replace("months: [\"January\", \"February\", \"March\", \"April\", \"May\", \"June\", \"July\", \"August\", \"September\", \"October\", \"November\", \"December\"]", "months: [\"".$lang[537]."\", \"".$lang[538]."\", \"".$lang[539]."\", \"".$lang[540]."\", \"".$lang[541]."\", \"".$lang[542]."\", \"".$lang[543]."\", \"".$lang[544]."\", \"".$lang[545]."\", \"".$lang[546]."\", \"".$lang[547]."\", \"".$lang[548]."\"]",
str_replace("monthsShort: [\"Jan\", \"Feb\", \"Mar\", \"Apr\", \"May\", \"Jun\", \"Jul\", \"Aug\", \"Sep\", \"Oct\", \"Nov\", \"Dec\"]", "monthsShort: [\"".substr($lang[537],0,3)."\", \"".substr($lang[538],0,3)."\", \"".substr($lang[539],0,3)."\", \"".substr($lang[540],0,3)."\", \"".substr($lang[541],0,3)."\", \"".substr($lang[542],0,3)."\", \"".substr($lang[543],0,3)."\", \"".substr($lang[544],0,3)."\", \"".substr($lang[545],0,3)."\", \"".substr($lang[546],0,3)."\", \"".substr($lang[547],0,3)."\", \"".substr($lang[548],0,3)."\"]",
implode("", file("../js/bootstrap-datepicker.js")))))))."

$datepicker
});
</script>";
} else {
echo "<div align=center><font face=verdana>".$lang[434]."<br><br><input type='button' value='OK' name='no' onclick=\"javascript:self.close()\"></font></div>";
}
?>

<!--end-->
</body>
</html>
