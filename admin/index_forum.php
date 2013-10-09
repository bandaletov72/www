<?php
function ExtractString($str, $start, $end) {
 $str_low = strtolower($str);
 if (strpos($str_low, $start) !== false && strpos($str_low, $end) !== false) {
   $pos1 = strpos($str_low, $start) + strlen($start);
   $pos2 = strpos($str_low, $end) - $pos1;
   return substr($str, $pos1, $pos2);
 }
}
function strtoken($str, $char) {
$strtoma=Array();
$strtoma=explode($char,$str);
return $strtoma[0];
}
$cury=date("Y", time());
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
echo "
<!DOCTYPE html><html>
<TITLE>Forum Index</TITLE>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">
<head>
<meta http-equiv=\"Refresh\" content=\"1; URL=../index.php\">
</HEAD>
<body>
";
$fold="..";
require "../modules/functions.php";
require "../templates/$template/css.inc";
echo $css;

function toLower($str) {
$str = strtr($str, "АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЬЪЫЭЮЯ",
"абвгдеёжзиклмнопрстуфхцчшщьъыэюя");
   return strtolower($str);
}
echo "<h4>Forum Search 1.0 (Programming: EuroWebcart)</h4>";
$st=1;
echo "<br><b>Starting indexing forum for allow search.</b><br><br><ol class=results>";
$datadir="../forum/data/";
$forum_perpage=1000; //last 1000 topics
$forums=file($datadir."forums.txt");
$n=0;
$search_db="";
//$handle=opendir(".$base_loc/content/");
while (list($fkey, $val)=each($forums)) {
$outs=explode("|", $val);
if ((trim($val)=="") |(trim($outs[1])=="")){
continue;
} else {

$fr=$outs[1];
$list = array();
        $fp = fopen($datadir."$fr/topics.txt", "r");
        while (!feof($fp)) {
                $lastpost = fgets($fp, 1024);
                $nickname = fgets($fp, 1024);
                $description = fgets($fp, 1024);
                $file = fgets($fp, 1024);
                $ans = fgets($fp, 1024);
                if ($lastpost && $nickname && $description && $file && $ans) {
                        $list[$n][0] = str_replace("\n","",$lastpost);
                        $list[$n][1] = str_replace("\n","",$nickname);
                        $list[$n][2] = str_replace("\n","",$description);
                        $list[$n][3] = str_replace("\n","",$file);
                        $list[$n][4] = str_replace("\n","",$ans);
                        $n++;
                }
        }
    fclose($fp);
    array_multisort($list);
        $list = array_reverse($list);
 $max = 0;
        for($i=0; $i<sizeof($list); $i++) {
                if ( intval($list[$i][3]) > $max) { $max = intval($list[$i][3]); } }
$j=1;
for ($i=0; $i<sizeof($list); $i=($i+$forum_perpage)) {



$fpage=0;
        for ($i=($fpage*$forum_perpage); $i<($fpage*$forum_perpage+$forum_perpage); $i++) {
        if (!isset($list[$i][3])) {
        } else {
         $tname="N/A";
        $co=0;
$m=0;
 $topic = array();
  if (file_exists($datadir."$fr/topic".$list[$i][3].".txt")) {
    $fp = fopen($datadir."$fr/topic".$list[$i][3].".txt", "r");
    $description = str_replace("\n","",fgets($fp, 1024));
    while (!feof($fp)) {
        $date = fgets($fp, 1024);
        $usname = fgets($fp, 1024);
        $nickname = strtoken($usname,"|");
        $text = fgets($fp, 9000);
        if ($date && $nickname && $text) {
            $topic[$m][0] = str_replace("\n","",$date);
            $topic[$m][1] = str_replace("\n","",$nickname);
            $topic[$m][2] = str_replace("\n","",$text);
            $user[$m] = str_replace("\n","",$usname);
            //echo "$m-$i-".$topic[$m][0]."-".$topic[$m][1]."-".$topic[$m][2]."-".$user[$m] ."<br>";



$date_file=date("Y.m.d",$topic[$m][0]);
//Минимальная длина слова для индексирования
$min_word_length=3;
//Убираем HTML , переносы и ненужные символы
$all=strip_tags($topic[$m][2]);
$them=strtoken(strtoken(strip_tags($list[$i][2]),"|"),"[");
$all=trim($all." $them");
$not_allowed= Array ("\n" , "\r" , "\t" , "\0" , "\x0B" , "\"", "|", "`", "\'" , "^" , "0x36", ",", "<" , ">" , "(", ")", "&nbsp;", "!", ":", ";", "-", "«" , "»", "[", "]");

while (list ($key, $val) = each ($not_allowed)) {
$all=str_replace($val, " " , $all);
}

unset($key, $val);
$all=toLower($all);

$temp2_mass=array_unique(explode(" ", $all));
$index_stroke="";
while (list ($key, $val) = each ($temp2_mass)) {
if (strlen($val)>=$min_word_length){
$index_stroke.="$val ";
}
}
unset($temp2_mass);  //для экономии памяти
// Конец неэкономичной процедуры




//Вычисляем размер файла
$fs=strlen($topic[$m][2]);
if ($fs>=1024): $fsize=round($fs/1024, 2) ." Kb"; endif;
if ($fs<1024): $fsize=$fs ." bytes"; endif;
if ($fs>=1048576): $fsize=round($fs/1048576, 2) ." Mb"; endif;

$line=$them." / #$m / ".$topic[$m][1]."";
$raz="index.php?action=forum&fr=$fr&act=show&nr=".$list[$i][3]."#me$m";
echo "<li value=$st>
<div class=\"title\">
<a href=\"$htpath/index.php?action=forum&fr=$fr&act=show&nr=".$list[$i][3]."#me$m\" target=_blank>$line</a>
</div>
<div class=\"text\">
<b>".$topic[$m][1].":</b> ".substr($index_stroke,0,60)."...</div>
<div class=\"info\">
<span style=\"color: #006600;\"> $file ($fsize) $date_file </span> &#151; <font color=\"#bb0000\">OK</font>
</div>
<div class=\"info\"><nobr><a href=\"$htpath/$raz\" target=_blank>Link</a></nobr></div>
</li>";
$search_db.="$raz > $line > $date_file > $fsize > $index_stroke $them > \n";
$st+=1;
            $m++;
        }
    }
fclose($fp);
}
}
}
}
}
}


echo "</ol>";


$file = fopen ("./search/forum_index.txt", "w");
if (!$file) {
echo "<p> Error writing to <b>./search/forum_index.txt</b>\n";
exit;
}
fputs ($file, "$search_db");
fclose ($file);







echo "</ol><p><b>Success!</b>";

?>
</body>
</html>
