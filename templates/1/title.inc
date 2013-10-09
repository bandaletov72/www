<?php
$_GET['ptitul']="";
$_POST['ptitul']="";
if (!isset($ptitul)){ $ptitul="";}
if (!isset($action)) {$action="";}
if ((!@$codepage) || (@$codepage=="")): $codepage="windows-1251"; endif;
if ($action=="blog") {
if(isset($_GET['message'])) $message=$_GET['message']; elseif(isset($_POST['message'])) $message=$_POST['message']; else $message="";
$message=str_replace("%2f","/",str_replace("%2F","/",$message));
if (!preg_match("/^[a-z0-9_\/]+$/i",$message)) { $message="";}
if(isset($_GET['message_date'])) $message_date=$_GET['message_date']; elseif(isset($_POST['message_date'])) $message_date=$_POST['message_date']; else $message_date="";
$message_date=str_replace("%2f","/",str_replace("%2F","/",$message_date));
if (!preg_match("/^[a-z0-9_\/]+$/i",$message_date)) { $message_date="";}

$tit=$lang[908]." - ";
if ($message_date!="") {$tit.=$message_date." - "; }
$fold="./blog";
$listbl=Array();

if ($message!="") {
$tmp0=Array();
$tmp0=explode("/",$message);

if (file_exists("$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/list.txt")==TRUE) {
$listbl[$message]=file("$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/list.txt");
while(list($key,$val)=each($listbl[$message])) {
$tmp=explode("|",$val);
if (($tmp[0]==$tmp0[0])&&($tmp[1]==$tmp0[1])&&($tmp[2]==$tmp0[2])&&($tmp[3]==$tmp0[3])) {
$tit=$tmp[5]." - " . $tit ."$tmp0[0]/$tmp0[1]/$tmp0[2]";
if ($tmp[8]!="") {
$imgs_arr=explode("src=", $tmp[8]);
$imgs=str_replace("\"", "", str_replace("'", "", str_replace(">", "", str_replace("<", "",strtoken(strtoken($imgs_arr[1],">")," ")))));
if (substr($imgs,0,5)!="http:") {if (substr($imgs,0,1)!="/") { $imgs="$htpath/$imgs"; } else {$imgs="$htpath$imgs";} }
} else {
$imgs="$htpath/logo.png";
}
if ($tmp[6]!="") {
$metadesc=htmlspecialchars($tmp[6]);
} else {
$metadesc=$tmp[4];
}
if ($tmp[7]!="") {
$metakw="
<meta name=\"description\" content=\"$metadesc\"/>";
} else {
$metakw="";
}
$fbmeta="<meta property=\"og:title\" content=\"".$tmp[5]." | " . $lang[909] ." | $tmp0[0]/$tmp0[1]/$tmp0[2]\" />
<meta property=\"og:type\" content=\"article\" />
<meta property=\"og:url\" content=\"$htpath/index.php?action=blog&message=$tmp0[0]/$tmp0[1]/$tmp0[2]/$tmp0[3]\" />
<meta property=\"og:image\" content=\"".str_replace("'","",str_replace("\"","",$imgs))."\" />
<meta property=\"og:description\" content=\"".$metadesc."\" />
<meta property=\"fb:admins\" content=\"$fb_admin_id\" />
<meta name=\"description\" content=\"$metadesc\"/>$metakw";
$tit.=" -";
}


}
unset ($tmp,$key,$val,$tmp0);
}
} else {
$metadesc="$kwrd";
$fbmeta="<meta property=\"og:title\" content=\"$lang[909]\" />
<meta property=\"og:type\" content=\"blog\" />
<meta property=\"og:url\" content=\"$htpath/index.php?action=blog\" />
<meta property=\"og:image\" content=\"$htpath/$image_path/home.png\" />
<meta property=\"og:description\" content=\"".$metadesc."\" />
<meta property=\"fb:admins\" content=\"$fb_admin_id\" />
<meta name=\"description\" content=\"$metadesc\"/>";
}
}
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\" />\n";

if (!isset($action)) {$action="";}
if (!preg_match("/^[a-z0-9_]+$/",$action)) { $action="";}
if (!isset($module)) {$module="";}
if (!isset($nr)) {$nr="";}
if (!preg_match("/^[a-z0-9_]+$/",$nr)) { $nr="";}

if (!preg_match("/^[a-z0-9_]+$/",$module)) { $module="";}

if (!isset($viewpage_title)) {$viewpage_title="";}
$tit2=@$tit;;
if (isset($sub)&&($sub!="")): $tit.=" ".$sub . " - "; endif;
if (isset($r)&&($r!="")): $tit.=" " . $r . " - "; endif;

if (isset($brand)&&($brand!="")&&($brand!="nobrand")): $tit.=$brand." - "; endif;
if (isset($module)&&($module!="")) {if ($module=="shop") {$tit=$lang['webshop']. " -";}}

if (isset($action)&&($action!="")) {
if ($action=="allnews") {$tit=$lang[56]. " -";}
if ($action=="forum")  {
$tit=$lang[9]. " -";
if (($nr!="")&&($fr!="")) {
if (($act=="show")||($act=="list")||($act=="")) {
if (@file_exists("./forum/data/$fr/topic".$nr.".txt")) {
$frmp = fopen("./forum/data/$fr/topic".$nr.".txt", "r");
$tit = htmlspecialchars(str_replace("\n","",fgets($frmp, 1024))) . " - ". $lang[9] . " - ";
fclose($frmp);
}
} else {
$tit = $lang[9]. " - Please Wait -";
}
}
}
if ($action=="sendmail") {$tit=$lang[54]. " -";}
}

if ((isset($viewpage_title))&&($viewpage_title!="")) {$tit=$viewpage_title. " - ";}
if (!isset ($tit)) {$tit="";}
if ($ptitul!="") {$tit=htmlspecialchars(rawurldecode(strip_tags($ptitul))). " - " . $tit;}

if ($metat!="") {
echo "<title>$metat</title>";
}  else {
if ($viewpage_title!="") {
echo "<title>".substr($tit, 0, strlen($tit)-3)."</title>";
} else {
echo "<title>".$tit." $shop_name</title>";
}
}

if (!isset($unifid)) {$unifid="";}
if (!isset($page)) {$page="";}
if (($page!="")||($unifid!="")||($fbmeta!="")) {
echo "\n".@$fbmeta."\n";
}
if (($action=="blog")&&($fbmeta!="")) {
echo "\n".@$fbmeta."\n";
}
if (!isset($unifid)) {$unifid="";}
if ($unifid!=""){$tit="» ". $tit2;}

?>
