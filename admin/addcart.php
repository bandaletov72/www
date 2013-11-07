<?php
set_time_limit(0);
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
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
Error_Reporting(E_ALL & ~E_NOTICE);
if ((!@$tov) || (@$tov=="")): $tov=""; endif;
if ((!@$back) || (@$back=="")): $back=0; endif;
if ((!@$roznc) || (@$roznc=="")): $roznc=""; endif;
if ((!@$optc) || (@$optc=="")): $optc=""; endif;
if ((!@$brandc) || (@$brandc=="")): $brandc=""; endif;
if ((!@$colorc) || (@$colorc=="")): $colorc=""; endif;
if ((!@$razmc) || (@$razmc=="")): $razmc=""; endif;
if ((!@$razz) || (@$razz=="")): $razz="Newitems"; endif;


if ((!@$podrazz) || (@$podrazz=="")): $podrazz=date("d-m-Y"); endif;
if ((!@$per) || (@$per=="")): $per=date("d.m.y"); endif;

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

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
$fold="..";
require ("../templates/$template/css.inc");
echo "<!DOCTYPE html><html>
<TITLE>ADMIN</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
";
if ($view_freedeliveryicon==0) {$dost_naim1=""; $dost_naim2=""; $zakaz_do_stavka=0;} else {$zakaz_do_stavka=$currencies_zakaz_dostav[$valut];}

if ((!@$kws) || (@$kws=="")): $kws=""; endif;
if ((!@$kw1) || (@$kw1=="")): $kw1=$lang[95]; endif;
if ((!@$kw2) || (@$kw2=="")): $kw2=$lang[96]; endif;
if ((!@$psklad) || (@$psklad=="")): $psklad="10"; endif;
if ((!@$pstati) || (@$pstati=="")): $pstati=""; endif;

if ((!@$koeff) || (@$koeff=="")): $koeff=$kprod; endif;
$koeff=str_replace(",",".",str_replace(" ","",$koeff));
echo $css;
$allrazdels = file(".$base_file");
//Теперь получиv список разделов и подразделов
while (list ($line_num, $line) = each ($allrazdels)) {
$out=explode("|",$line);
$razd=@$out[1];
if ($razd!="") {
$subr=@$out[2]. "|". @$out[1];
$subr2=@$out[1]. "|". @$out[2];
$tmp1[$razd] = $razd;
$tmp2[$subr2] = $subr;
}
}
reset ($tmp1);
ksort($tmp2);
reset ($tmp2);
$tmpr1= array_unique ($tmp1);
$tmpr2= array_unique ($tmp2);
$rrr="<option value=\"$razz\">".$razz."</option>";
while (list ($line_num, $line) = each ($tmpr1)) {
$rrr.= "<option value=\"".strtoken("$line","|")."\">".$line."</option>\n";
}
$sss="<option value=\"$per\">".$per."</option>";;
while (list ($line_num, $line) = each ($tmpr2)) {
$sss.= "<option value=\"".strtoken("$line","|")."\">".str_replace("|", " (", $line.")")."</option>\n";
}
//Выведем названия разделов:


echo "<SCRIPT language=\"JavaScript1.1\">
<!--
function zamena() {
document.getElementById(\"podrazz\").value=document.getElementById(\"dirsubdirs\").value;
}
function zamena2() {
document.getElementById(\"razz\").value=document.getElementById(\"dirsubdirs2\").value;
}
function rc(image) {
  opener.document.form.foto1.value=\"<img src='$htpath/".$fotobasesmall."/\" + image + \"' border=0>\";
  window.alert(\"Image \\n\"+ image +\"\\nadded.\");
}
//-->
</SCRIPT>
</head>
<BODY onload=\"javascript:self.focus()\" bgcolor=$nc0 link=$nc3 text=$nc5>
<small><a href=\"".$_SERVER['PHP_SELF']."?per=".date("d.m.y")."&tov=".@$tov."&back=0\"><b>Приход на сегодня</b> (".date("d.m.y").")</a> | <a href=\"".$_SERVER['PHP_SELF']."?per=".date("d.m.y",(time()-($back+1)*86400))."&tov=".@$tov."&back=".($back+1)."\"><b>&lt; Пред.</b> (".date("d.m.y",(time()-($back+1)*86400)).")</a> | <b>Приход на ".date("d.m.y",(time()-($back*86400)))."</b> | <a href=\"".$_SERVER['PHP_SELF']."?per=".date("d.m.y",(time()-($back-1)*86400))."&tov=".@$tov."&back=".($back-1)."\"><b>След. &gt;</b> (".date("d.m.y",(time()-($back-1)*86400)).")</a> | &gt;&gt;<a href=\"".$_SERVER['PHP_SELF']."?per=all&tov=".@$tov."\"><b>За весь период</b></a></small><br>
<form class=form-inline action=\"".$_SERVER['PHP_SELF']."\" method=\"GET\"><input name=\"per\" type=hidden value=\"".@$per."\"><input name=\"back\" type=hidden value=\"".@$back."\"><small>Введите имя товара: </small><input name=\"tov\" type=text size=20 value=\"".@$tov."\"> <small>(в конце имени поставьте пробел)</small><br>
<small>Введите раздел: </small><input id=\"razz\" name=\"razz\" type=text size=20 value=\"".@$razz."\"> &lt;- <select name=\"rep_dirsubdir2\"\" onchange=\"javascript:zamena2()\" id=\"dirsubdirs2\">$rrr</select><br>
<small>Введите подраздел: </small><input id=\"podrazz\" name=\"podrazz\" type=text size=20 value=\"".@$podrazz."\"> &lt;- <select name=\"rep_dirsubdir\"\"  onchange=\"javascript:zamena()\" id=\"dirsubdirs\">$sss</select><br>
<small>Коэффициент Розн./Опт: </small><input name=\"koeff\" type=text size=20 value=\"".@$koeff."\"><br>
<small>Бренд: </small><input name=\"brandc\" type=text size=20 value=\"".@$brandc."\"><br>
<small>Оптовая цена: </small><input name=\"optc\" type=text size=20 value=\"".@$optc."\"> у.е.<br>
<small>Розничная цена: </small><input name=\"roznc\" type=text size=20 value=\"".@$roznc."\"> у.е.<br>
<small>Назв. Описания-1: </small><input name=\"kw1\" type=text size=20 value=\"".@$kw1."\"> Для очистки - ставьте пробел<br>
<small>".@$kw1."</small><input name=\"colorc\" type=text size=20 value=\"".@$colorc."\"><br>
<small>Назв. Описания-2: </small><input name=\"kw2\" type=text size=20 value=\"".@$kw2."\"> Для очистки - ставьте пробел<br>
<small>Размер: </small><input name=\"razmc\" type=text size=20 value=\"".@$razmc."\"><br>
<small>Скидки/Ключевые/опции: </small><input name=\"kws\" type=text size=20 value=\"".@$kws."\"><br>
<small>Ссылки на статьи: </small><input name=\"pstati\" type=text size=20 value=\"".@$pstati."\"><br>
<small>Склад, кол-во: </small><input name=\"psklad\" type=text size=20 value=\"".@$psklad."\"><br>
Введите все данные и нажмите OK <input type=submit value=\"OK\"> - после этого можете заполнять карточки товаров.</form><br><small> ";
if ((!@$del) || (@$del=="")): $del=""; endif;
if ($del!="") {

echo "<b>Был удален файл с именем:</b> $del<br>
<br>Восстановление невозможно<br><br>";

if (!unlink  ("../$fotobasesmall/" . $del)) {
print ("$del not found!<br>\n");
}
}
$del="";
$perpage=10000;
$start=0;
$koeff=(double)$koeff;

$next=$start+$perpage;

require("fileupload-class.php");


        $path = "../$fotobasesmall/";


        $upload_file_name = "userfile";


        $acceptable_file_types = "image/gif|image/jpeg|image/pjpeg";


        $default_extension = "";


        $mode = 2;

        if (isset($_REQUEST['submitted'])) {

                $my_uploader = new uploader($_POST['language']);


                $my_uploader->max_filesize(150000);

                $my_uploader->max_image_size(1500, 1500);

                if ($my_uploader->upload($upload_file_name, $acceptable_file_types, $default_extension)) {
                        $my_uploader->save_file($path, $mode);
                }

                if ($my_uploader->error) {
                        echo $my_uploader->error . "<br><br>\n";

                } else {

                        if(stristr($my_uploader->file['type'], "image")) {
                        echo "<a href='#22' onClick=\"javascript:rc('".  $my_uploader->file['name'] . "')\"><img src=\"" . $path . $my_uploader->file['name'] . "\" align='left' border=\"1\" title=\"Вставить этот файл в окно редактирования\"></a><br>Для вставки фото в окно редактирования просто щелкните на нем.<br><br><br><br>";
                        print($my_uploader->file['name'] . " успешно загружен на сервер!<br>");
            } else {
                        print($my_uploader->file['name'] . " успешно загружен на сервер!<br>");
                                $fp = fopen($path . $my_uploader->file['name'], "r");
                                while(!feof($fp)) {
                                        $line = fgets($fp, 255);
                                        echo $line;
                                }
                                if ($fp) { fclose($fp); }
                        }
                 }
         }


/* echo "<form enctype='multipart/form-data' action='$htpath/admin/forprint.php' method='POST'>
        <input type='hidden' name='submitted' value='true'>
        <input type='hidden' name='perpage' value='$perpage'>
        <input type='hidden' name='start' value='$start'>

                Имя файла: <input name='" . $upload_file_name . "' type='file'>
                <input type='hidden' name='language' value='ru'>
<input type='submit' value='Загрузить'>
        </form>";

        if (isset($acceptable_file_types) && trim($acceptable_file_types)) {
                print("Разрешены к загрузке следующие типы файлов:<br><b>" . str_replace("|", "</b> или <b>", $acceptable_file_types) . "</b>\n");
        }
 */
//Выведем все картинки

require("../templates/$template/for_replace.inc");

$st=0;
$val="<table width='100%'><tr>";
$handle=opendir("../$fotobasesmall/");
while (($fileopen = readdir($handle))!==FALSE) {
If (($fileopen == '.') || ($fileopen == '..')) {
continue;
} else {

$tf=explode (".",substr($fileopen, -6));
$ftype=@$tf[1];


if ($delete_stock_price==1) {
unset ($tf);
$tf=explode ("_",$fileopen);
$tovt=strtoken(@$tf[6],".");

$newff="../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."_r_".@$tf[4]."_".@$tf[5]."_".$tovt."."."$ftype";

if ((@file_exists($newff))&&(@file_exists("../$fotobasebig/$fileopen"))&&(@$tf[3]!="r")&&($tovt!="")) {
unlink($newff);
rename ("../$fotobasebig/$fileopen", $newff);

}
$newff="../$fotobasesmall/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."_r_".@$tf[4]."_".@$tf[5]."_".$tovt."."."$ftype";
if ((@file_exists($newff))&&(@$tf[3]!="r")&&($tovt!="")) {
unlink($newff);
rename ("../$fotobasesmall/$fileopen", $newff);
$fileopen=$newff;
$tf[3]="r";
continue;
}




}

$date=date("d.m.y", filemtime("../$fotobasesmall/$fileopen"));
$fdate=date("y-m-d H-i", filemtime("../$fotobasesmall/$fileopen"));
$ddate=date("H:i d/m/y ", filemtime("../$fotobasesmall/$fileopen"));


$bfound=0;

unset ($tf);
if ($ftype!="") {
$tf=explode ("_",$fileopen);
if (@file_exists("../$fotobasebig/$fileopen")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."1."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."2."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."3."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."4."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."5."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."6."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."7."."$ftype")==TRUE) {
$bfound+=1;  }
if (@file_exists("../$fotobasebig/".@$tf[0]."_".@$tf[1]."_".@$tf[2]."8."."$ftype")==TRUE) {
$bfound+=1;  }
}
if ($bfound==0) {$bfound="<br><b><font color=#b94a48>Больш. фото НЕ найдено</font></b>";} else {$bfound="<br>Найдено больш.фото: <b>$bfound</b> ".$lang['pcs'];}

if ($per!="all") {

if ($date==$per){

$size = intval((filesize ("../$fotobasesmall/$fileopen"))/1024);
$imagesz = getimagesize("../$fotobasesmall/$fileopen");
                        $fwidth  = floor($imagesz[0]/2);
                        $fheight = floor($imagesz[1]/2);
if ($fwidth>80): $fwidth=80; endif;






$parsfile=strtoupper(str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",$fileopen)))));

$filexp=explode("_", @$parsfile);

$vars1=@$filexp[0];
$vars2=@$filexp[2];
$pbrand=@$brarr[strtolower(@$vars1)];
if ($brandc!="") {$pbrand=$brandc;}
$part=@$filexp[0].@$filexp[1].@$filexp[2];
$pcvet=@$pararr[strtolower(@$vars2)];
if ($colorc!="") {$pcvet=$colorc;}
$popt=@$filexp[3];
if (($optc!="")&&($optc!=0)) {$popt=(double)$optc;}
$bg="";
if (substr($popt,0,1)=="R") {  $popt=-1; $bg=" bgcolor=\"#E2EFDA\"";} else {$bg=" bgcolor=\"#f27777\"";}
$prazm=strtolower(@$filexp[4]);
if ($razmc!="") {$prazm=$razmc;}
$opto=(double)@$filexp[3];
if (($optc!="")&&($optc!=0)) {$opto=(double)$optc;}
$prozn=$koeff*$opto;
if (($roznc!="")&&($roznc!=0)) {$prozn=(double)$roznc;}
$pdop=strtolower(@$filexp[5]);
$pdop2=strtolower(@$filexp[5]);
$pna=strtolower(@$filexp[6]);
//if ($pna=="") {$pna=@$tov." $part";}
reset($razmerarr);
reset($razarr);
reset($narr);
while (list ($keyr, $str) = each ($razarr)) {
$pdop=str_replace("$keyr", "$str", $pdop);
}
while (list ($keyr3, $str3) = each ($razmerarr)) {
$prazm=str_replace("$keyr3", "$str3", $prazm);
}
while (list ($keyr2, $str2) = each ($narr)) {
$pna=str_replace("$keyr2", "$str2", $pna);
}

$roznica=($okr*round($prozn*$kurs/$okr));
if ($roznica>=$currencies_zakaz_menee[$valut]){
$prib=($okr*round((($prozn*$kurs-$popt*$optkurs)-$zakaz_do_stavka-45)/$okr));
} else {
$prib=($okr*round((($prozn*$kurs-$popt*$optkurs)-45)/$okr));
}
if ($popt>0){ $bg="";}
$fileopens[$st]= "<!-- $fdate -->
<td align='center' valign='top'$bg><small><a href=\"#22\" onclick=\"javascript:window.open('$htpath/".$fotobasebig."/".$fileopen."','fr2','statusbar=no,menubar=no,toolbar=no,scrollbars=yes,resizable=yes,width=560,height=".@floor((550*$fheight/$fwidth)+20)."');return false;\"><img src='../$fotobasesmall/$fileopen' border=1 width=$fwidth height=$fheight alt='".strtoupper(str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",$fileopen)))))."\n$ddate'></a>
<br><b>";
if ($popt>0) { $fileopens[$st].="<a href=\"#22\" onclick=\"javascript:window.open('addfotocart.php?pbrand=".rawurlencode($pbrand)."&file=".rawurlencode($fileopen)."&part=".rawurlencode($part)."&pcvet=".rawurlencode($pcvet)."&popt=".rawurlencode($popt)."&prozn=".rawurlencode($prozn)."&tov=".rawurlencode(@$pna.@$tov)."&razz=".rawurlencode(@$razz)."&podrazz=".rawurlencode(@$podrazz)."&prazm=".rawurlencode(@$prazm)."&pdop=".rawurlencode(@$pdop2)."&kws=".rawurlencode(@$kws)."&kw1=".rawurlencode(@$kw1)."&kw2=".rawurlencode(@$kw2)."&pstati=".rawurlencode(@$pstati)."&psklad=".rawurlencode(@$psklad)."','fr','statusbar=no,menubar=no,toolbar=no,scrollbars=yes,resizable=yes,width=560,height=500');document.getElementById('r$st').style.backgroundColor='#FFFF66';return false;\"><div id=\"r$st\">Создать ".@$part."</div></a></b><br><br>";}
$fileopens[$st].="Назв: <b>".@$pna.$tov."</b><br>
Брэнд: <b>".@$pbrand."</b><br>
Арт.: <b>".$part."</b><br>
".@$kw1." <b>".$pcvet."</b><br>
Размер: <b>".$prazm."</b><br>
Доп.: <b>".$pdop."</b><br>";

if ($popt>0) { $fileopens[$st].="Опт: <b>\$".$popt."</b> (".($okr*round($popt*$optkurs/$okr))."$valut)<br>
Розн.: <b>\$".$prozn."</b> (".$roznica."$valut)<br>
Розн-Опт-Дост-Проезд=<b>".$prib."</b>$valut<br>";
}
$fileopens[$st].="Дата: <b>".$ddate."</b>$bfound<br><br>
</small></td>";
}
}else {
$size = intval((filesize ("../$fotobasesmall/$fileopen"))/1024);
$imagesz = @getimagesize("../$fotobasesmall/$fileopen");
                        @$fwidth  = floor($imagesz[0]/2);
                        @$fheight = floor($imagesz[1]/2);
if ($fwidth>80): $fwidth=80; endif;
$parsfile=str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",$fileopen))));

$filexp=explode("_", @$parsfile);
$vars1=@$filexp[0];
$vars2=@$filexp[2];
$pbrand=@$brarr[strtolower(@$vars1)];
$part=@$filexp[0].@$filexp[1].@$filexp[2];
$pcvet=@$pararr[strtolower(@$vars2)];
$popt=@$filexp[3];
$bg="";
if (substr($popt,0,1)=="R") { $popt=0; $bg=" bgcolor=\"#E2EFDA\"";}
$prazm=strtolower(@$filexp[4]);
$opto=(double)@$filexp[3];
$prozn=$koeff*$opto;
$pdop=strtolower(@$filexp[5]);
$pdop2=strtolower(@$filexp[5]);
$pna=strtolower(@$filexp[6]);
reset($razarr);
reset($narr);
while (list ($keyr, $str) = each ($razarr)) {
$pdop=str_replace("$keyr", "$str", $pdop);
}
while (list ($keyr2, $str2) = each ($narr)) {
$pna=str_replace("$keyr2", "$str2", $pna);
}

$fileopens[$st] = "<!-- $fdate -->
<td align='center' valign='top'$bg><small><a href=\"#22\" onclick=\"window.open('$htpath/".$fotobasebig."/$fileopen','".str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",str_replace("-", "",$fileopen)))))."','statusbar=no,menubar=no,toolbar=no,scrollbars=yes,resizable=yes,width=560,height=".@floor((550*$fheight/$fwidth+1)+20)."'); return false;\"><img src='../$fotobasesmall/$fileopen' border=1 width=$fwidth height=$fheight alt='".str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",$fileopen))))."\n$ddate'></a>
";
$roznica=($okr*round($prozn*$kurs/$okr));
if ($roznica>=$currencies_zakaz_menee[$valut]){
$prib=($okr*round((($prozn*$kurs-$popt*$optkurs)-$zakaz_do_stavka-45)/$okr));
} else {
$prib=($okr*round((($prozn*$kurs-$popt*$optkurs)-45)/$okr));
}
if ($popt!=0) { $fileopens[$st].="<a href=\"#22\" onclick=\"javascript: document.getElementById('r$st').style.backgroundColor='#FFFF66'; window.open('addfotocart.php?pbrand=".rawurlencode($pbrand)."&file=".rawurlencode($fileopen)."&part=".rawurlencode($part)."&pcvet=".rawurlencode($pcvet)."&popt=".rawurlencode($popt)."&prozn=".rawurlencode($prozn)."&tov=".rawurlencode(@$pna.@$tov)."&razz=".rawurlencode(@$razz)."&podrazz=".rawurlencode(@$podrazz)."&prazm=".rawurlencode(@$prazm)."&pdop=".rawurlencode(@$pdop2)."','".str_replace(".jpg", "", str_replace(".JPG", "", str_replace(".gif", "",str_replace(".GIF", "",str_replace("-", "",$fileopen)))))."','statusbar=no,menubar=no,toolbar=no,scrollbars=yes,resizable=yes,width=560,height=500'); return false;\"><div id=\"r$st\">Создать ".@$part."</div></a></b><br><br>";}
$fileopens[$st].="Назв: <b>".@$pna."</b><br>
Брэнд: <b>".@$pbrand."</b><br>
Арт.: <b>".$part."</b><br>
Цвет: <b>".$pcvet."</b><br>
Размер: <b>".$prazm."</b><br>
Доп.: <b>".$pdop."</b><br>";

if ($popt>0) { $fileopens[$st].="Опт: <b>".$popt."</b><br>
Розн.: <b>".$prozn."</b><br>
Розн-Опт-Дост-Проезд=<b>".$prib."</b>$valut<br>"; }

$fileopens[$st].="Дата: <b>".$ddate."</b>$bfound<br><br>
</small></td>";
}
$st += 1;
}
}
closedir ($handle);
if (count(@$fileopens)==0): echo "Not found!<br><br><hr><center><b><b>Powered by:</b> <a href='http://www.eurowebcart.com'>Eurowebcart CMS</a> (c) Eurowebcart</small>"; exit; endif;
//сортировка по алфавиту//
rsort ($fileopens);
reset ($fileopens);
$total = count ($fileopens);
$numberpages = (floor ($total/$perpage))+1;
$startnew=$start+1;
$end=$startnew + $perpage - 1;
$zt=0;
$pag=0;
$rt=0;
$st=0;
$pp="";

while ($st < $total) {
if (($start/$perpage)==$st) {
$pp.= "<b>" . ($st+1) . "</b> | ";
} else {
if ($total>=($st*$perpage)){
$pp.= "<a href = \"".$_SERVER['PHP_SELF']."?start=" . ($st*$perpage) . "&amp;perpage=$perpage\">" . ($st+1) . "</a> | ";
}
}

$val .= @$fileopens[($start+$st)];
$zt+=1;
if ($zt==6): $rt+=1; if($rt==3){$rt=0; $pag+=1; $razriv="<table width=100%><tr><td><b>$pag.</b></td><td width=100%><hr></td></tr></table><br clear=all style='page-break-before:always'>";} else {$razriv="";} $zt=0; $val.="</tr></table>$razriv<table width=100%><tr>"; endif;
$st += 1;

}



$val.="</tr></table>";

echo "$val";


?>
<!--end-->
</body>
</html>
