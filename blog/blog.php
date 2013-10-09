<?php
$tmp=Array("","","","","","","","","");
if (function_exists('curl_init')) {
$use_curl=1;
}
$social_user="<i class=icon-user></i>";
$social_link1="";
$social_link2="";
$social_gender="male";
$social_net="";
$social_ava="";
$social_other="";
$social_account="";
$blog_list="";


$psocial_net="";
$psocial_other="";
$psocial_gender="";
$psocial_ava="";

if ($register!=1) {
$yok=0;
$mok=0;
if ((!isset($year))||(!preg_match("/^[0-9]+$/",$year))){ $yok=1; $year=date("Y",time()); }  $year=doubleval($year); if (($year>=9999)||($year<=1)) { $year=date("Y",time()); } //checking valid year
if ((!isset($month))||(!preg_match("/^[0-9]+$/",$month))){$mok=1; $month=date("m",time());} $month=doubleval($month); if ($month<=1) { $month=1; } if ($month>=12) { $month=12; }  //checking valid month
if ($start<0) {$start==0;}
$current_blogdate="";
if (($yok==0)&($mok==0)){ $current_blogdate=" <font size=4> / ".str_replace("1","".$lang[537]." ", str_replace("2","".$lang[538]." ",str_replace("3","".$lang[539]." ",str_replace("4","".$lang[540]." ",str_replace("5","".$lang[541]." ",str_replace("6","".$lang[542]." ",str_replace("7","".$lang[543]." ",str_replace("8","".$lang[544]." ",str_replace("9","".$lang[545]." ",str_replace("10","".$lang[546]." ",str_replace("11","".$lang[547]." ",str_replace("12","".$lang[548]." ",$month))))))))))))." $year</font>";}

$now=mktime(0,0,1,$month,1,$year);
$nowd=date("m.Y",$now);
$today=date("d.m.Y",time());












if(isset($_GET['message_date'])) $message_date=$_GET['message_date']; elseif(isset($_POST['message_date'])) $message_date=$_POST['message_date']; else $message_date="";
$message_date=str_replace("%2f","/",str_replace("%2F","/",$message_date));
if (!preg_match("/^[a-z0-9_\/]+$/i",$message_date)) { $message_date="";}
if(get_magic_quotes_gpc()) {
$message_date = stripslashes($message_date);

}
if ($message_date!="") {
$mes0=explode("/",$message_date);
if (is_dir("$fold/$message_date")==TRUE) {
$month=doubleval($mes0[1]);
$year=$mes0[0];
}
}

if(isset($_GET['topic_del'])) $topic_del=$_GET['topic_del']; elseif(isset($_POST['topic_del'])) $topic_del=$_POST['topic_del']; else $topic_del="";
$topic_del=str_replace("%2f","/",str_replace("%2F","/",$topic_del));
if (!preg_match("/^[a-z0-9_\/]+$/i",$topic_del)) { $topic_del="";}
$flood="";
$comments_found=0;
$blog_delc="";

if(isset($_GET['hidecomm'])) $hidecomm=$_GET['hidecomm']; elseif(isset($_POST['hidecomm'])) $hidecomm=$_POST['hidecomm']; else $hidecomm="";
if (!preg_match("/^[no]+$/i",$hidecomm)) { $hidecomm="";}
$hidecomm=substr($hidecomm, 0, 10);
if(isset($_GET['oauth_provider'])) $oauth_provider=$_GET['oauth_provider']; elseif(isset($_POST['oauth_provider'])) $oauth_provider=$_POST['oauth_provider']; else $oauth_provider="";
if (!preg_match("/^[a-z]+$/i",$oauth_provider)) { $oauth_provider="";}
$oauth_provider=substr($oauth_provider, 0, 10);
if(isset($_GET['message'])) $message=$_GET['message']; elseif(isset($_POST['message'])) $message=$_POST['message']; else $message="";
$message=str_replace("%2f","/",str_replace("%2F","/",$message));
if (!preg_match("/^[a-z0-9_\/]+$/i",$message)) { $message="";}
if(isset($_GET['editmessage'])) $editmessage=$_GET['editmessage']; elseif(isset($_POST['editmessage'])) $editmessage=$_POST['editmessage']; else $editmessage="";
$editmessage=str_replace("%2f","/",str_replace("%2F","/",$editmessage));
if (!preg_match("/^[a-z0-9_\/]+$/i",$editmessage)) { $editmessage="";}




if(isset($_GET['tread'])) $tread=$_GET['tread']; elseif(isset($_POST['tread'])) $tread=$_POST['tread']; else $tread="";
if (!preg_match("/^[a-z0-9\.]+$/i",$tread)) { $tread="";}

if(isset($_GET['social_net'])) $social_net=$_GET['social_net']; elseif(isset($_POST['social_net'])) $social_net=$_POST['social_net']; else $social_net="";
if (!preg_match("/^[a-z0-9]+$/i",$social_net)) { $social_net="";}
if(isset($_GET['social_account'])) $social_account=$_GET['social_account']; elseif(isset($_POST['social_account'])) $social_account=$_POST['social_account']; else $social_account="";
if (!preg_match("/^[a-z0-9]+$/i",$social_account)) { $social_account="";}
if(isset($_GET['social_other'])) $social_other=$_GET['social_other']; elseif(isset($_POST['social_other'])) $social_other=$_POST['social_other']; else $social_other="";
if (!preg_match("/^[а-яА-Яa-zA-Z0-9_-]+$/i",$social_other)) { $social_other="";}
if(isset($_GET['social_gender'])) $social_gender=$_GET['social_gender']; elseif(isset($_POST['social_gender'])) $social_gender=$_POST['social_gender']; else $social_gender="";
if (!preg_match("/^[femal]+$/i",$social_gender)) { $social_gender="";}
if(isset($_GET['social_ava'])) $social_ava=$_GET['social_ava']; elseif(isset($_POST['social_ava'])) $social_ava=$_POST['social_ava']; else $social_ava="";
if (!preg_match("/^[a-zAZ0-9\._-]+$/i",$social_ava)) { $social_ava="";}

if(isset($_GET['blog_checkbox'])) $blog_checkbox=$_GET['blog_checkbox']; elseif(isset($_POST['blog_checkbox'])) $blog_checkbox=$_POST['blog_checkbox']; else $blog_checkbox="";
if (!preg_match("/^[a-z0-9\.]+$/i",$blog_checkbox)) { $blog_checkbox="";}
if(isset($_GET['blog_delcom'])) $blog_delcom=$_GET['blog_delcom']; elseif(isset($_POST['blog_delcom'])) $blog_delcom=$_POST['blog_delcom']; else $blog_delcom="";
if (!preg_match("/^[a-z0-9\.]+$/i",$blog_delcom)) { $blog_delcom="";}
if(isset($_GET['exp'])) $exp=$_GET['exp']; elseif(isset($_POST['exp'])) $exp=$_POST['exp']; else $exp="";
if (!preg_match("/^[a-z0-9]+$/i",$exp)) { $exp="";}
$exp=substr($exp, 0, 10);
if(isset($_GET['name'])) $name=$_GET['name']; elseif(isset($_POST['name'])) $name=$_POST['name']; else $name="";
if (!isset($name)){$name="";} $name=trim($name);
$name = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $name); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $name);  $name = str_replace(chr(27), "", $name); $name = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$name))); $name = str_replace(chr(10), "", $name);
$name=substr($name, 0, 80);
if (($name=="")&&($details[1]!="")) {$name=$details[1];}
if(isset($_GET['topic'])) $topic=$_GET['topic']; elseif(isset($_POST['topic'])) $topic=$_POST['topic']; else $topic="";
if (!isset($topic)){$topic="";} $topic=trim($topic);
$topic=substr($topic, 0, 80);
$topic = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $topic); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $topic);  $topic = str_replace(chr(27), "", $topic); $topic = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$topic))); $topic = str_replace(chr(10), "", $topic);

if(isset($_GET['cmntsent'])) $cmntsent=$_GET['cmntsent']; elseif(isset($_POST['cmntsent'])) $cmntsent=$_POST['cmntsent']; else $cmntsent="";

if (!isset($cmntsent)){$cmntsent="";} $cmntsent=trim($cmntsent);
$cmntsent=substr($cmntsent, 0, 2000);$cmntsent = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $cmntsent); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $cmntsent);  $cmntsent = str_replace(chr(27), "", $cmntsent); $cmntsent = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$cmntsent))); $cmntsent = str_replace(chr(10), "[br]", $cmntsent);
if(isset($_GET['blogtags'])) $blogtags=$_GET['blogtags']; elseif(isset($_POST['blogtags'])) $blogtags=$_POST['blogtags']; else $blogtags="";
if (!isset($blogtags)){$blogtags="";}


if(isset($_GET['blogicon'])) $blogicon=$_GET['blogicon']; elseif(isset($_POST['blogicon'])) $blogicon=$_POST['blogicon']; else $blogicon="";
if (!isset($blogicon)){$blogicon="";}
if(isset($_GET['topicdesc'])) $topicdesc=$_GET['topicdesc']; elseif(isset($_POST['topicdesc'])) $topicdesc=$_POST['topicdesc']; else $topicdesc="";
if (!isset($topicdesc)){$topicdesc="";}
if(isset($_GET['newtopic'])) $newtopic=$_GET['newtopic']; elseif(isset($_POST['newtopic'])) $newtopic=$_POST['newtopic']; else $newtopic="";
if (!isset($newtopic)){$newtopic="";}
$newtopic = str_replace(chr(27), "", $newtopic); $newtopic = str_replace(chr(13), "", $newtopic); $newtopic = str_replace(chr(10), "<br>", $newtopic);
if(isset($_GET['tag'])) $tag=$_GET['tag']; elseif(isset($_POST['tag'])) $tag=$_POST['tag']; else $tag="";
if (!isset($tag)){$tag="";} $tag=trim($tag);
$tag=substr($tag, 0, 2000);$tag = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $tag); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $tag);  $tag = str_replace(chr(27), "", $tag); $tag = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$tag))); $tag = str_replace(chr(10), "", $tag);
$tag=substr($tag, 0, 300);
$tread=substr($tread, 0, 300);
$tmp0=Array();
$tmp0=explode("/",$message);
if(get_magic_quotes_gpc()) {
$blogtags = stripslashes($blogtags);
$tag = stripslashes($tag);
$newtopic = stripslashes($newtopic);
$topicdesc = stripslashes($topicdesc);
$blogicon = stripslashes($blogicon);
$cmntsent = stripslashes($cmntsent);
$topic = stripslashes($topic);
$name = stripslashes($name);
$tread = stripslashes($tread);
$message = stripslashes($message);
$topic_del = stripslashes($topic_del);
$social_ava = stripslashes($social_ava);
$social_other = stripslashes($social_other);
$social_gender = stripslashes($social_gender);
$social_net = stripslashes($social_net);
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){

//edit message

if (($editmessage!="")&&($name!="")&&($topic!="")) {
$em0=Array();
$em0=explode("/",$editmessage);
$f1="$fold/list.txt";
$tm=file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$em0[0])&&($m1[1]==$em0[1])&&($m1[2]==$em0[2])&&($m1[3]==$em0[3])) {$tm[$key]="$m1[0]|$m1[1]|$m1[2]|$m1[3]|$m1[4]|$topic|$topicdesc|$blogtags|$blogicon|$blog_checkbox|$social_net|$social_other|$name|$social_ava|$social_gender|||\n";}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="$fold/$em0[0]/list.txt";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$em0[0])&&($m1[1]==$em0[1])&&($m1[2]==$em0[2])&&($m1[3]==$em0[3])) { $tm[$key]="$m1[0]|$m1[1]|$m1[2]|$m1[3]|$m1[4]|$topic|$topicdesc|$blogtags|$blogicon|$blog_checkbox|$social_net|$social_other|$name|$social_ava|$social_gender|||\n";}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="$fold/$em0[0]/$em0[1]/list.txt";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$em0[0])&&($m1[1]==$em0[1])&&($m1[2]==$em0[2])&&($m1[3]==$em0[3])) { $tm[$key]="$m1[0]|$m1[1]|$m1[2]|$m1[3]|$m1[4]|$topic|$topicdesc|$blogtags|$blogicon|$blog_checkbox|$social_net|$social_other|$name|$social_ava|$social_gender|||\n";}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="$fold/$em0[0]/$em0[1]/$em0[2]/list.txt";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$em0[0])&&($m1[1]==$em0[1])&&($m1[2]==$em0[2])&&($m1[3]==$em0[3])) { $tm[$key]="$m1[0]|$m1[1]|$m1[2]|$m1[3]|$m1[4]|$topic|$topicdesc|$blogtags|$blogicon|$blog_checkbox|$social_net|$social_other|$name|$social_ava|$social_gender|||\n"; }
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
unset($fp,$tm,$key,$val,$m1,$f1);
unset($em0);

}


//delete topic
if ($topic_del!="") {
function deleteAll($directory, $empty = false) {
    if(substr($directory,-1) == "/") {
        $directory = substr($directory,0,-1);
    }

    if(!file_exists($directory) || !is_dir($directory)) {
        return false;
    } elseif(!is_readable($directory)) {
        return false;
    } else {
        $directoryHandle = opendir($directory);

        while ($contents = readdir($directoryHandle)) {
            if($contents != '.' && $contents != '..') {
                $path = $directory . "/" . $contents;

                if(is_dir($path)) {
                    deleteAll($path);
                } else {
                    unlink($path);
                }
            }
        }

        closedir($directoryHandle);

        if($empty == false) {
            if(!rmdir($directory)) {
                return false;
            }
        }

        return true;
    }
}
$tmp10=Array();
$tmp10=explode("/",$topic_del);
if (deleteAll("$fold/$tmp10[0]/$tmp10[1]/$tmp10[2]/comments/$tmp10[3]")==false){

$blog_list.="<div class=comm align=center><h4>$lang[747] $fold/$tmp10[0]/$tmp10[1]/$tmp10[2]/comments/$tmp10[3]</h4></div>";

} else {

$blog_list.="<div class=comm align=center><h4>$lang[209]</h4></div>";}
@unlink ("$fold/$tmp10[0]/$tmp10[1]/$tmp10[2]/comments/$tmp10[3]".".cnt");

@unlink ("$fold/$tmp10[0]/$tmp10[1]/$tmp10[2]/$tmp10[3]".".txt");
$f1="$fold/list.txt";
$tm=file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$tmp10[0])&&($m1[1]==$tmp10[1])&&($m1[2]==$tmp10[2])&&($m1[3]==$tmp10[3])) {unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="$fold/$tmp10[0]/list.txt";
if (filesize($f1)==0) {@unlink ("$f1");}
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$tmp10[0])&&($m1[1]==$tmp10[1])&&($m1[2]==$tmp10[2])&&($m1[3]==$tmp10[3])) { unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);
$f1="$fold/$tmp10[0]/$tmp10[1]/list.txt";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$tmp10[0])&&($m1[1]==$tmp10[1])&&($m1[2]==$tmp10[2])&&($m1[3]==$tmp10[3])) { unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="$fold/$tmp10[0]/$tmp10[1]/$tmp10[2]/list.txt";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if(($m1[0]==$tmp10[0])&&($m1[1]==$tmp10[1])&&($m1[2]==$tmp10[2])&&($m1[3]==$tmp10[3])) { unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);


$message_date="$tmp10[0]/$tmp10[1]/$tmp10[2]";
unset($tmp10);
if ($message_date!="") {
$mes0=explode("/",$message_date);
//if (is_dir("$fold/$message_date")==TRUE) {
$month=doubleval($mes0[1]);
$year=$mes0[0];
//}
}
}


//new topic
if (($newtopic!="")&&($topic!="")&&($name!="")) {

//проверяю существуют ли директории, если нет - создаю.
$topictime=time();
$t_year=date("Y",$topictime);
$t_month=date("m",$topictime);
$t_day=date("d",$topictime);
if (is_dir("$fold/$t_year")==FALSE) { mkdir("$fold/$t_year",0755); }
if (is_dir("$fold/$t_year/$t_month")==FALSE) { mkdir("$fold/$t_year/$t_month",0755); }
if (is_dir("$fold/$t_year/$t_month/$t_day")==FALSE) { mkdir("$fold/$t_year/$t_month/$t_day",0755); mkdir("$fold/$t_year/$t_month/$t_day/comments",0755); }

//получаю список топиков на текущую дату
$handle=opendir("$fold/$t_year/$t_month/$t_day");
$max=0;
while (($blogfile = @readdir($handle))!==FALSE) {

if (($blogfile == '.') || ($blogfile == '..')||(substr($blogfile,-4)!=".txt")||($blogfile=="list.txt")) {
continue;
} else {
$i=doubleval($blogfile);
if ($i>$max) {$max=$i;}
}
}
@closedir($handle);
unset ($blogfile,$i);
$max+=1;
if (is_dir("$fold/$t_year/$t_month/$t_day/comments/$max")==FALSE) { mkdir("$fold/$t_year/$t_month/$t_day/comments/$max",0755);  }

$topicfile="$fold/$t_year/$t_month/$t_day/$max.txt";
$fp=fopen($topicfile,"w");
fputs($fp, "$newtopic");
fclose ($fp);
unset ($topicfile,$fp);
$topicfile="$fold/$t_year/$t_month/$t_day/list.txt";
$blogstroke="$t_year|$t_month|$t_day|$max|".date("H:i:s",$topictime)."|$topic|$topicdesc|$blogtags|$blogicon|$blog_checkbox|$social_net|$social_other|$name|$social_ava|$social_gender|||\n";
$fp=fopen($topicfile,"a");
fputs($fp, $blogstroke);
fclose ($fp);
unset ($topicfile,$fp);
$topicfile="$fold/$t_year/$t_month/list.txt";
$fp=fopen($topicfile,"a");
fputs($fp, $blogstroke);
fclose ($fp);
unset ($topicfile,$fp);
$topicfile="$fold/$t_year/list.txt";
$fp=fopen($topicfile,"a");
fputs($fp, $blogstroke);
fclose ($fp);
unset ($topicfile,$fp);
$topicfile="$fold/list.txt";
$fp=fopen($topicfile,"a");
fputs($fp, $blogstroke);
fclose ($fp);
unset ($topicfile,$fp);

unset ($max);
}

//delete comment
if (($blog_delcom!="")&&($message!="")) {

$comdelf="$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/comments/$tmp0[3]/$blog_delcom";
$fp=fopen($comdelf,"w");
fputs($fp, "\n\n\n");
fclose ($fp);
unset ($comdelf,$fp);
}

}}
$calendar="";
require "$fold/calendar.php";


//echo "fb_id=".$_SESSION["fb_id"]."<BR>";
//echo "token=".$_SESSION["token"]."<BR>";
//echo "fbcontent=".$_SESSION["fbcontent"]."<BR>";

//echo "oauth_provider=".$_SESSION["o_provider"];

if ((!@$_SESSION["fb_id"]) || (@$_SESSION["fb_id"]=="")){
//echo "SESSION REG<BR>";
$_SESSION["fb_id"]="";
$_SESSION["fb_email"]="";
$_SESSION["token"]="";
$_SESSION["fbcontent"]="";
$_SESSION["fb_gender"]="";
$_SESSION["fb_prov"]="";
$_SESSION["fb_ava"]="";
$_SESSION["fb_other"]="";
}

//facebook auth
$fb_key="<fb:login-button scope=\"email\" autologoutlink='false' size=\"medium\" background=\"white\" length=\"long\" v=\"2\">Facebook</fb:login-button>";

define('YOUR_APP_ID', '$fb_app_id');
define('YOUR_APP_SECRET', '$fb_app_secret');
//echo $_COOKIE['fbs_' . $app_id];
if (!function_exists('get_facebook_cookie')) {
function get_facebook_cookie($app_id, $app_secret) {
global $_COOKIE;
if (!isset ($_COOKIE['fbs_' . $app_id])) {$_COOKIE['fbs_' . $app_id]="";}
  $args = array();
  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  ksort($args);
  $payload = '';
  foreach ($args as $key => $value) {
    if ($key != 'sig') {
      $payload .= $key . '=' . $value;
    }
  }
  if (!isset ($args['sig'])) {$args['sig']="";}
  if (md5($payload . $app_secret) != $args['sig']) {
    return null;
  }
  return $args;
}
}

if ( !function_exists('json_decode') ){
    function json_decode($content, $assoc=false){
    global $fold;
                require_once "$fold/JSON.php";
                if ( $assoc ){
                    $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        } else {
                    $json = new Services_JSON;
                }
        return $json->decode($content);
    }
}

if ( !function_exists('json_encode') ){
    function json_encode($content){
    global $fold;
                require_once "$fold/JSON.php";
                $json = new Services_JSON;

        return $json->encode($content);
    }
}
if ((!isset($fbcoockie))&&($blog_out!="yes")) {
$fbcookie = get_facebook_cookie($fb_app_id, $fb_app_secret);

}

if ($blog_out=="yes") {

unset($_SESSION["fb_id"]);
unset($_SESSION["token"]);
unset($_SESSION["fbcontent"]);
unset($_SESSION["fb_gender"]);
unset($_SESSION["fb_prov"]);
unset($_SESSION["fb_email"]);
unset($_SESSION["fb_ava"]);
unset($_SESSION["fb_other"]);
unset($fbcookie);
unset($_SESSION['a_token']);
unset($_SESSION['o_token']);
unset($_SESSION['o_token_secret']);
unset($_SESSION["o_provider"]);
unset($_SESSION["fb_name"]);
$_COOKIE['fbs_' . $fb_app_id];
}
if (($oauth_provider=="facebook")||(@$_SESSION["o_provider"]=="facebook"))  {
$_SESSION["o_provider"]="facebook";
}
if (@$_SESSION["fb_id"]=="") {
if ($fbcookie['access_token']!="") {
if ($use_curl==1) {
$req = 'https://graph.facebook.com/me/?access_token=' . $fbcookie['access_token'];
$ch = curl_init($req);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$fbcontent = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$fbcontent=file_get_contents('https://graph.facebook.com/me?access_token='.$fbcookie['access_token']);
}
//echo " FB READING CONTENT, TOKEN: ". $fbcookie['access_token']."<BR>";
$_SESSION["token"]=$fbcookie['access_token'];
$_SESSION["fbcontent"]=$fbcontent;
$fbuser=json_decode($fbcontent);
$_SESSION["fb_id"]=$fbuser->id;
$_SESSION["fb_prov"] = "facebook";
$_SESSION["fb_name"]=@iconv("UTF-8", $codepage, $fbuser->name);
$_SESSION["fb_gender"]=$fbuser->gender;
$_SESSION["fb_link"]="http://www.facebook.com/profile.php?id=".$fbuser->id;
$fbid=$fbuser->id;
$file = "./gallery/avatars/".$fbid.".jpg";
if (file_exists($file)==TRUE) {
//if ($fbimg != file_get_contents("./gallery/avatars/".$fbid.".jpg")) {
//file_put_contents($file, $fbimg);
//}

} else {
if ($use_curl==1) {
$req = "https://graph.facebook.com/".$fbid."/picture";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, TRUE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=@curl_exec($ch);
if ($ifpc!="") {
$real=trim(trim(str_replace("Location:","", str_replace(strtoken($ifpc, "Location:"),"",strtoken($ifpc,".jpg"))).".jpg"));
$req = "$real";
$file = "./gallery/avatars/".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
}
}
if (curl_errno($ch))
//        exit('TWITTER avatar Download failed');
curl_close($ch);
} else {
$fbimg = file_get_contents("https://graph.facebook.com/".$fbid."/picture");
$file = "./gallery/avatars/".$fbid.".jpg";
file_put_contents($file, $fbimg);
}

}
unset ($file,$fbimg);
$_SESSION["fb_ava"]=$fbid.".jpg";
$_SESSION["fb_email"]=$fbuser->email;
$_SESSION["fb_other"]=$fbuser->id;
}
} else {
$fbcontent=$_SESSION["fbcontent"];
//echo " FB READING SESSION, TOKEN: ". $fbcookie['access_token']."<BR>";
$fbuser=json_decode($fbcontent);
}

//echo " FB_ID:".$_SESSION["fb_id"]." TOKEN: ". $_SESSION["token"]."<BR>";
//
if ($enable_tw_auth==1) {
define('CONSUMER_KEY', $tw_consumer_key);
define('CONSUMER_SECRET', $tw_consumer_secret);
//twitter auth

include_once "$fold/twitteroauth.php";

    if(!empty($_SESSION['a_token']) &&
       !empty($_SESSION['o_token']) &&
       !empty($_SESSION['o_token_secret'])
    ) {
$fb_key="";
//Я уже авторизован давно получим пользовательскую инфу
/*
echo "авторизация успешна!<br>fb_prov=";
echo $_SESSION["fb_prov"];
echo "<br>fb_id=";
echo $_SESSION["fb_id"];
echo "<br>fb_name=";
echo $_SESSION["fb_name"];
echo "<br>fb_gender=";
echo $_SESSION["fb_gender"];
echo "<br>fb_ava=";
echo $_SESSION["fb_ava"];
echo "<br>";
*/

    }



if(!empty($_GET['oauth_verifier']) &&
       !empty($_SESSION['o_token']) &&
       !empty($_SESSION['o_token_secret'])
    ) {
    $fb_key="";
//echo "У меня есть \$_GET['oauth_verifier'] \$_SESSION['o_token'] и \$_SESSION['o_token_secret']<br>";
//echo "\$oauth_verifier =".$_GET['oauth_verifier']."<br>";
//echo "\$_SESSION['o_token'] =".$_SESSION['o_token']."<br>";
//echo "\$_SESSION['o_token_secret'] =".$_SESSION['o_token_secret']."<br>";

$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret, $_SESSION['o_token'], $_SESSION['o_token_secret']);
// Save it in a session var
//var_dump($connection);
//echo "<br><br><br>";
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
$tw_content = $connection->get('account/verify_credentials');

//var_dump($tw_content);
//echo "<br><br><br>";
//var_dump($tw_content);
//echo "<br><br><br>";

$_SESSION['a_token'] = $access_token;
//echo "a_token =".$_SESSION['a_token']."<br>";
// Let's get the user's info

$fbuser = $connection->get('account/verify_credentials');
//var_dump($tw_content);
//echo "<br><br><br>";
$fbid=$fbuser->id;
$_SESSION["fb_prov"] = "twitter";
$_SESSION["fb_id"] = $fbid;
$_SESSION["fb_name"]=@iconv("UTF-8", $codepage, $fbuser->name);
$_SESSION["fb_gender"]="male";
$_SESSION["fb_other"]=$fbuser->screen_name;
$_SESSION["fb_link"]="http://twitter.com/#!/".$fbuser->screen_name;

$file = "./gallery/avatars/".$fbid.".jpg";
if (file_exists($file)==TRUE) {
//if ($fbimg != file_get_contents("./gallery/avatars/".$fbid.".jpg")) {
//file_put_contents($file, $fbimg);
//}

} else {
if ($use_curl==1) {
$req = $fbuser->profile_image_url;
$file = "./gallery/avatars/".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
}

if (curl_errno($ch))
        exit("TWITTER Avatar ".$req." Download failed");
curl_close($ch);
} else {
$fbimg = file_get_contents($fbuser->profile_image_url);
$file = "./gallery/avatars/".$fbid.".jpg";
file_put_contents($file, $fbimg);
}

}
unset ($file,$fbimg);
$_SESSION["fb_ava"]=$fbid.".jpg"; ;
$_SESSION["fb_other"]=$fbuser->screen_name;

} else {
if (($oauth_provider=="twitter")||(@$_SESSION["o_provider"]=="twitter")) {
$_SESSION["o_provider"]="twitter";
$fb_key="";
//echo "$oauth_provider"." - ". @$_SESSION["o_provider"]."<br>";
$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret);
//var_dump($connection);

} else {
//echo "SESSION o_token пустой<br>";
$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret);

$temporary_credentials = $connection->getRequestToken("$htpath/index.php?action=blog&oauth_provider=twitter");
//var_dump($temporary_credentials);
$redirect_url = $connection->getAuthorizeURL($temporary_credentials);
$_SESSION['o_token'] = $token = $temporary_credentials['oauth_token'];
//echo "SESSION o_token = ".$temporary_credentials['oauth_token']."<br>";
$_SESSION['o_token_secret'] = $temporary_credentials['oauth_token_secret'];
//echo "SESSION o_token_secret = ".$temporary_credentials['oauth_token_secret']."<br>";
//echo "REDIRECT URL=". $redirect_url ."<a href=$redirect_url>$redirect_url</a><br>";
$twit_key="<br><div style=\"background-image: url('$fold/tw_log.png'); width:89px; height:24px; cursor: pointer; cursor: hand;\" align=center onclick=\"location.href='".$redirect_url."';\"><font color=#ffffff style=\"font-size:11px\"><b><img src=\"$image_path/pix.gif\" height=16 width=16>Twitter</b></font></div>";

}
}
}


//vkontakte
if ($enable_vk_auth==1) {
$vk_key="<div style=\"background-image: url('$image_path/vk_log.png'); width:89px; height:24px; cursor: pointer; cursor: hand;\" align=center onclick=\"location.href='http://api.vk.com/oauth/authorize?client_id=$vk_client_id&redirect_uri=".rawurlencode("$htpath/index.php?action=blog&oauth_provider=vkontakte")."';\"><font color=#ffffff style=\"font-size:9px\"><b><img src=\"$image_path/pix.gif\" height=16 width=22>KOHTAKTE</b></font></div>";
if (($oauth_provider=="vkontakte")||(@$_SESSION["o_provider"]=="vkontakte"))  {
//echo "oauth_provider=$oauth_provider сущ<br>";

$_SESSION["o_provider"]="vkontakte";

if (!empty($_SESSION['vkontakte'])) {
//echo var_dump($_SESSION['vkontakte']);

} else {
//echo "SESSION['vkontakte'] пуст, наполняем<br>";
$code = $_GET['code'];
$secret = $vk_secret;
if (($code!="")&&($secret!="")&&($vk_client_id!="")) {
if ($use_curl==1) {
$req = "https://api.vk.com/oauth/token?client_id=".$vk_client_id."&code=".$code."&client_secret=".$secret;
$ch = curl_init($req);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$resp = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$resp=file_get_contents("https://api.vk.com/oauth/token?client_id=".$vk_client_id."&code=".$code."&client_secret=".$secret);
}
$_SESSION['vkontakte'] = json_decode($resp);
//echo "Получаем SESSION['vkontakte']<br>";
//var_dump($_SESSION['vkontakte']);
//echo "<br>";
//Working with api

$_SESSION["token"]=$_SESSION['vkontakte']->access_token;
$_SESSION["fb_id"]=$_SESSION['vkontakte']->user_id;
$_SESSION["fb_prov"] = "vkontakte";
$_SESSION["fb_other"]=$_SESSION['vkontakte']->user_id;

$fbid=$_SESSION["fb_id"];
if ($use_curl==1) {
$req = "https://api.vkontakte.ru/method/getProfiles?uid=" . $_SESSION['vkontakte']->user_id."&fields=uid,first_name,last_name,sex,country,photo&access_token=" . $_SESSION['vkontakte']->access_token;
$ch = curl_init($req);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$vkcontent = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$vkcontent=file_get_contents("https://api.vkontakte.ru/method/getProfiles?uid=" . $_SESSION['vkontakte']->user_id."&fields=uid,first_name,last_name,sex,country,photo&access_token=" . $_SESSION['vkontakte']->access_token);
}
if (!empty($_SESSION["fb_name"])) {

} else {
$vkcontent=json_decode($vkcontent);
$fbuser1=$vkcontent->response;
$fbuser=$fbuser1[0];
//echo "Получаем fbuser<br>";
//var_dump($fbuser);
//echo "<br>";
$_SESSION["fb_link"]="http://vk.com/id".$fbuser->uid;
$_SESSION["fb_name"]=@iconv("UTF-8", $codepage, $fbuser->first_name." ".$fbuser->last_name);
$_SESSION["fb_gender"]=$fbuser->sex;
if ("".$_SESSION["fb_gender"]=="0") {$_SESSION["fb_gender"]="male";}
if ($use_curl==1) {
$req = $fbuser->photo;
$file = "./gallery/avatars/vk_".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
$_SESSION["fb_ava"]="vk_".$fbid.".jpg";
unset ($_SESSION['vkontakte'],$_SESSION["o_provider"]);
}

if (curl_errno($ch))
//exit("Vkontakte Avatar ".$req." Download failed");
curl_close($ch);
} else {
$fbimg = file_get_contents($fbuser->photo);
$file = "./gallery/avatars/vk_".$fbid.".jpg";
file_put_contents($file, $fbimg);
$_SESSION["fb_ava"]="vk_".$fbid.".jpg";
unset ($_SESSION['vkontakte'],$_SESSION["o_provider"]);
}

}
} else {
//echo "нет возвращаемых code или отсутсвует secret, ОШИБКА АВТОРИЗАЦИИ<br>";
unset ( $_SESSION['vkontakte'],$_SESSION["o_provider"]);
}
}
}
/*
echo "fb_prov=";
echo $_SESSION["fb_prov"];
echo "<br>fb_id=";
echo $_SESSION["fb_id"];
echo "<br>fb_name=";
echo $_SESSION["fb_name"];
echo "<br>fb_gender=";
echo $_SESSION["fb_gender"];
echo "<br>fb_ava=";
echo $_SESSION["fb_ava"];
echo "<br>";
*/
}

if ($enable_vk_auth!=1) {$vk_key="";}
if ($enable_tw_auth!=1) {$twit_key="";}
if ($enable_fb_auth!=1) {$fb_key="";}
if (($enable_vk_auth!=1)&&($enable_tw_auth!=1)&&($enable_fb_auth!=1)) {$lang[939]="";}
//
$blog_list.="<div style=\"overflow:hidden; width:100%;\">
<div style=\"overflow:hidden;\"><table border=0 width=100% cellspacing=0 cellpaddinf=0><tr><td width=100%><a href=\"index.php?action=blog\"><img src=$image_path/home.png align=absmiddle border=0 title=\"".$lang['mainsite']."\"></a> <a href=\"index.php?action=blog\"><font size=4>$lang[909]</font></a>$current_blogdate
</td><td align=right><a href=$htpath/blog/rss.php?message=$message&message_date=$message_date><img src=$image_path/rss.png border=0></a></td><td><img src=$image_path/pix.gif border=0 width=10 height=1></td></tr></table></div><div style=\"float: right; margin-left:10px; margin-bottom:10px;\" align=center>
$calendar<div style=\"width:220px\" align=center>";
$fbid="";
$inname="";
//echo "fbcoockie=".$fbcookie['access_token'];
if ($_SESSION["fb_id"]!="") {
//echo " EXIST:".$_SESSION["fb_id"];
$inname=$_SESSION["fb_name"];
if ($inname!="") {
$name=$inname;
$fbid=$_SESSION["fb_id"];
/*
if ($fbid!="") {
$file = "./gallery/avatars/".$fbid.".jpg";
$psocial_ava=$fbid.".jpg";
if (file_exists($file)==TRUE) {
//if ($fbimg != file_get_contents("./gallery/avatars/".$fbid.".jpg")) {
//file_put_contents($file, $fbimg);
//}

} else {
if ($use_curl==1) {
$req = "https://graph.facebook.com/".$fbid."/picture";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, TRUE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=@curl_exec($ch);
if ($ifpc!="") {
$real=trim(trim(str_replace("Location:","", str_replace(strtoken($ifpc, "Location:"),"",strtoken($ifpc,".jpg"))).".jpg"));
$req = "$real";
$file = "./gallery/avatars/".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
}
}
if (curl_errno($ch))
        exit('Download failed');
curl_close($ch);
} else {
$fbimg = file_get_contents("https://graph.facebook.com/".$fbid."/picture");
$file = "./gallery/avatars/".$fbid.".jpg";
file_put_contents($file, $fbimg);
}

}
unset ($file,$fbimg);
}
*/
$psocial_email=$_SESSION["fb_email"];
$psocial_ava=$_SESSION["fb_ava"];
$psocial_link1="<a href=\"".$_SESSION["fb_link"]."\">";
$psocial_link2="</a>";
$psocial_gender=$_SESSION["fb_gender"];
$psocial_net=$_SESSION["fb_prov"];
$psocial_other=$_SESSION["fb_other"];
$psocial_ico="";
if ($psocial_net=="facebook") {$psocial_ico="<img src=$fold/fb.png align=absmiddle> ";}
if ($psocial_net=="twitter") {$psocial_ico="<img src=$fold/twit.png align=absmiddle> ";}
if ($psocial_net=="vkontakte") {$psocial_ico="<img src=$fold/vk.png align=absmiddle> ";}
if ($psocial_net=="") {$psocial_ico="";}
if ($psocial_net=="") {
$psocial_user="<i class=icon-user></i>";
} else {
$psocial_user="";
}

$blog_list.="<br>"."$psocial_link1<img style=\"margin-right:5px;\" src=\"./gallery/avatars/".$psocial_ava."\" border=0 title=\"$inname\" align=left>$psocial_link2"."<small>$psocial_ico$psocial_user<b>$psocial_link1". $_SESSION["fb_name"] ."$psocial_link2</b></small>
<br><img src=\"$image_path/pix.gif\" border=0 width=100 height=5><br><form method=GET action=$htpath/index.php>
<input type=hidden name=action value=blog>
<input type=hidden name=blog_out value=yes>
<input type=submit value=\"".$lang['exit']."\">
</form>";
} else {
$blog_list.="<br><small>$lang[939]</small><br><br>$fb_key<br>$twit_key<br>$vk_key";
}

} else {
 $blog_list.="<br><small>$lang[939]</small><br><br>$fb_key<br>$twit_key<br>$vk_key";
 }
 $blog_list.="</div><div id=\"fb-root\"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/".strtoken($site_nls,".")."/all.js#xfbml=1&appId=$fb_app_id\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>";
        if ($blog_out=="yes") {
$blog_list.="
<script type=\"text/javascript\">
$(document).ready( function() {
      FB.logout();
} );
</script>
<!-- END switch_facebook_logout -->";

    }
    $blog_list.="</div>";
$fl=1;
//$blog_list.="tread=$tread name=$name comment=$cmntsent mesage=$message";
if (($cmntsent=="")&&($topic!="")) {$cmntsent=$topic; $topic="";}

if (@$_SESSION["last_comm"]==md5($cmntsent.$message.$tread.$topic)) {
$flood="<div align=center><br><font color=#b94a48 size=3><b>".$lang[177]."</b></font><br><br></div>";
}
if ($flood=="") {
if (($name!="")&&($cmntsent!="")&&($message!="")){

//save comment

//$blog_list.="RE: $message/$tread<br>";
//смотрю можно ли делать комменты
unset($list,$tmp);
$blogcomenable=0;
$list=Array();
$listfile="$fold/$tmp0[0]/$tmp0[1]/list.txt";
$list=file($listfile);
while(list($key,$val)=each($list)) {
$tmp=explode("|",$val);
if (($tmp0[0]==$tmp[0])&&($tmp0[1]==$tmp[1])&&($tmp0[2]==$tmp[2])&&($tmp0[3]==$tmp[3])&&($tmp[9]=="YES")) { $blogcomenable=1; }
}
//получаю список комментов всего треда
if ( $blogcomenable==1) {
$handle=opendir("$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/comments/$tmp0[3]");
$count1=strlen($tread);
//echo "count1=$count1 tread=$tread<br>";
$count2=count(explode(".",$tread));
$maxn=0;
while (($blogfile = @readdir($handle))!==FALSE) {
$count3=count(explode(".",$tread));
if ($count1>0) {
//echo "count1>0<br>";
$fl=0;
if (($blogfile == '.') || ($blogfile == '..')) {
continue;
} else {

//echo ($count3+1)." tred=$tread. substr=".substr($blogfile,0,($count1+1))." file=".$blogfile." count=".count(explode(".",$blogfile))."<br>";
if (("$tread."==substr($blogfile,0,($count1+1)))&&(($count3+1)==count(explode(".",$blogfile)))) {
//комменты других уровней
$i=doubleval(substr($blogfile,($count1+1)));
if ($i>$maxn) {$maxn=substr($blogfile,($count1+1));}
//echo "max=".$maxn. " file=" .$blogfile."<br>";

}
}
} else {
//echo "<=0 ".strlen($blogfile)." $blogfile<br>";
if (($blogfile == '.') || ($blogfile == '..')||(strlen($blogfile)!=1)) {
continue;
} else {

//комменты первого уровня
$i=doubleval($blogfile);

if ($i>$maxn) {$maxn=$i;}
//echo $blogfile . " $maxn";

}

}
}
@closedir($handle);
//if (($count1==1)&&($maxn<=2)) {$maxn-=1;}
// writing comment $tread.".".($maxn+1);
if ($fl==0) {$wr=$tread.".".($maxn+1);} else {$wr=($maxn+1);}
$blogfile="$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/comments/$tmp0[3]/$wr";
$blogfilep=fopen($blogfile,"w");
fputs($blogfilep,str_replace("\n"," ", strip_tags(trim(trim($topic))))."\n".str_replace("\n"," ",strip_tags(trim(trim($name))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_net))))."|".strip_tags(trim(trim($social_other)))."|".str_replace("\n"," ",strip_tags(trim(trim($social_ava))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_gender))))."|||\n".str_replace("[br]","<br>", strip_tags(trim(trim($cmntsent))))."\n");
fclose ($blogfilep);
$blogfile="$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/comments/$tmp0[3].cnt";
if (file_exists($blogfile)==TRUE) {
$blogfilep=fopen($blogfile,"r");
$numcom=explode("|",fread ($blogfilep,10));
fclose ($blogfilep);
}
$blogfilep=fopen($blogfile,"w");
fputs($blogfilep,(doubleval(@$numcom[0])+1)."|$tmp0[0]|$tmp0[1]|$tmp0[2]|".date("Y/m/d H:i:s", time())."|".str_replace("\n"," ",strip_tags(trim(trim($name))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_net))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_other))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_ava))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_gender))))."|||\n");
fclose ($blogfilep);
$_SESSION["last_comm"]=md5($cmntsent.$message.$tread.$topic);
unset($cmntsent);
}
}
}

if ($message==""){
$bloglistfile="$fold/list.txt";
$mesex=0;
if ($message_date!="") {
$mes0=explode("/",$message_date);
if (is_dir("$fold/$message_date")==TRUE) {
$bloglistfile="$fold/$mes0[0]/$mes0[1]/$mes0[2]/list.txt";
$mesex=1;
}
}
if ($mesex==0) {
if ($month<10){$cmonth="0".$month;} else { $cmonth="$month"; }
if ($yok==0) {if (($month!="")&&($year!="")&&(file_exists("$fold/$year/$cmonth/list.txt")==TRUE)) {$bloglistfile="$fold/$year/$cmonth/list.txt";}}
}
if (file_exists($bloglistfile)==TRUE) {
$list=array_reverse(file($bloglistfile));
$ff=0;
$fff=0;
while(list($key,$val)=each($list)) {
//echo ($start+$blog_perpage). ">$ff>=$start $val<br>";
//if (($start+$blog_perpage)<=$ff) {continue;}
if ((($start+$blog_perpage)>$ff)&&($ff>=$start)) {

$tmp=explode("|",$val);
//echo $val."<br>";
$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3].txt";
//echo "$start $ff $tmp[3].txt<br>";
$con=$lang[921];
$com=$lang[920];
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$con=@fread($blogfilep,@filesize($cf));
fclose ($blogfilep);
}
$all=$con;

$con=strtoken($con,"[cut]");
$polls="";
$poll_exp="\n";
require "./modules/mod_poll.php";
if (!isset($poll)) {$poll="";}
$con=str_replace("[poll]".$polls."[/poll]","$poll", $con);

if ($all!=$con) {$con.="<br><br>» <a href=\"index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]#cut\">$lang[919]</a>";}
unset ($all);
$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3].cnt";
$cmnts=$lang[920];
$com[0]=0;
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$com=explode("|",@fread($blogfilep,@filesize($cf)));
fclose ($blogfilep);
$social_ico=""; $social_link1="";$social_link2="";
if (($com[6]=="facebook")&&($com[7]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($com[7])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($com[6]=="twitter")&&($com[7]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($com[7])."\">";$social_link2="</a>";}
if (($com[6]=="vkontakte")&&($com[7]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($com[7])."\">";$social_link2="</a>";}
if ((trim($com[8])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($com[8])."\" border=0>$social_link2";} else {$social_ava="";}
if (($com[6]=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

$cmnts="<div><b>".$lang[910].":</b> $com[4] $social_ico$social_user".$social_link1."$com[5]".$social_link2."</div> ";
if ($com[4]=="") {$cmnts="";}
}
$tags="";
$show=0;
$editblog="";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$editblog="<div style=\"float:right;margin-left: 10px;margin-right: 10px;\"><br>
<a href=\"#edit\" onClick=javascript:window.open('$htpath/admin/edit/index.php?speek=$speek&working_file=../."."$fold/$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]".".txt','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=560,left=10,top=10')><font color=#468847>V</font>&nbsp;".$lang[385]."</a>
&nbsp;&nbsp;&nbsp;&nbsp;
<a href=\"index.php?action=blog&topic_del=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"><font color=#b94a48>X</font>&nbsp;".$lang[744]."</a></div>";
if ($tmp[9]=="YES" ) {$blogchecked=" checked";} else {$blogchecked="";}
if (!isset($tmp[14])) {$tmp[14]="";}
$editblog.="<div id=sendcomment_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]><div align=left><br><a href=\"#edit\" onclick=\"javascript:document.getElementById('commentblock_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.display='';document.getElementById('commentblock_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.visibility='visible';document.getElementById('sendcomment_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.display='none';document.getElementById('sendcomment_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.visibility='hidden';\"><font color=#3a87ad>#</font> $lang[862], $lang[864], $lang[861] ...</a></div></div>
<div id=commentblock_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3] style=\"display: none; visibility: hidden;clear:both;\">
<br><div class=round3 align=center>
<form method=POST action=index.php>
<input type=hidden name=tread value=\"\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=social_net value=\"$tmp[10]\">
<input type=hidden name=social_other value=\"$tmp[11]\">
<input type=hidden name=social_gender value=\"$tmp[14]\">
<input type=hidden name=social_ava value=\"$tmp[13]\">
<input type=hidden name=editmessage value=\"$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\">
<table border=0 width=100%><tr><td><table border=0>
<tr><td align=right valign=top><b>".$lang[357].":</b></td><td><input type=text name=name value=\"".$tmp[12]."\" size=20 maxlength=\"80\" style=\"width:100%\"></td><td><font color=#b94a48>*</font></td></tr>
<tr><td align=right valign=top><b>".$lang[862].":</b></td><td><input type=text name=topic value=\"$tmp[5]\" size=20 maxlength=\"80\" style=\"width:100%\"></td><td><font color=#b94a48>*</font></td></tr>
<tr><td align=right valign=top><b>".str_replace(" ","&nbsp;",$lang['short']).":</b></td><td><input type=text name=topicdesc value=\"$tmp[6]\" size=420 maxlength=\"80\" style=\"width:100%\"></td><td></td></tr>
<tr><td align=right valign=top><b>".$lang[864].":</b></td><td><input type=text name=blogtags value=\"$tmp[7]\" size=20 maxlength=\"80\" style=\"width:100%\"><br><small>$lang[863]</small></td><td></td></tr>
<tr><td align=right valign=top><b>".$lang[861].":</b></td><td width=100%><input type=hidden id=\"el_$ff\" size=1 name=\"blogicon\" value=\"".htmlspecialchars($tmp[8])."\"> <input type=button value=\"...\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=$ff','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')>&nbsp;&nbsp;&nbsp;&nbsp;
<b>".$lang[8].":</b> <input type=checkbox$blogchecked name=blog_checkbox value=\"YES\"> - ".$lang[890]." </td><td></td></tr>
</table></td><td><img src=\"$image_path/pix.gif\" id=\"img_$ff\"></td></tr></table><br>
<br><input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('commentblock_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.display='none';document.getElementById('commentblock_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.visibility='hidden';document.getElementById('sendcomment_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.display='';document.getElementById('sendcomment_$tmp[0]_$tmp[1]_$tmp[2]_$tmp[3]').style.visibility='visible';\"> &nbsp; <input type=submit value=\"".$lang['ch']."\"></form></div></div>";




}}
$social_ico=""; $social_link1="";$social_link2="";
if (($tmp[10]=="facebook")&&($tmp[11]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($tmp[11])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($tmp[10]=="twitter")&&($tmp[11]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($tmp[11])."\">";$social_link2="</a>";}
if (($tmp[10]=="vkontakte")&&($tmp[11]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($tmp[11])."\">";$social_link2="</a>";}

if ((trim($tmp[13])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($tmp[13])."\" border=0>$social_link2";} else {$social_ava="";}
if ((trim($tmp[10])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

if ($tag!="") {

if ($tmp[7]!=""){
$t=explode(",",$tmp[7]);
while(list($key1,$val1)=each($t)) {
$val1=trim(trim($val1));
//echo $val1;
$tags.="<a href=\"index.php?action=blog&tag=".rawurlencode($val1)."\">$val1</a>, ";
if ($tag!="") {if ($tag==$val1) { $show=1;$ff+=1;}
}
}
$tags= str_replace(", \n","",$tags."\n");
if ($tag=="") {$show=1;} else { $tags=str_replace("$tag</a>","<b>$tag</b></a>",$tags);}
if ($show==1) {
//поиск по тегам
$blog_list.="<div style=\"overflow:hidden;\"><div class=round2>
<div style=\"float:right;width:160px;\" align=right>$social_ava
<div style=\"margin:5px\">$social_ico$social_user<b>".$social_link1."$tmp[12]".$social_link2."</b></div>
<div style=\"margin:5px\"><small>$tmp[0]/$tmp[1]/$tmp[2] <i>$tmp[4]</i></small></div>
</div>
<a href=\"index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"><h4><font color=$nc3>$tmp[5]</font></h4></a>
<div><i>$tmp[6]</i></div>
<br>
<div>".str_replace("<img", "<img style=\"margin-bottom:10px; margin-right:10px;\" align=left", $tmp[8]).$con."$editblog<br><br></div><div style=\"clear:both;\">";
if (($enable_blog_comments==1)&&($tmp[9]=="YES")) { $blog_list.="<div class=round4 style=\"float:left;width:40px; overflow:hidden; margin: 0px 10px 0px 0px;\" align=center><a href=\"index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]#view_comments\"><font size=4 color=$nc3>$com[0]</font></a></div><div style=\"float:left;margin-right: 10px;\"><form method=GET action=index.php#hidecomm><input type=hidden name=action value=\"blog\"><input type=hidden name=message value=\"$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"><input type=hidden name=hidecomm value=\"no\"><input type=submit value=\"$lang[912]\" style=\"height:30px\"></form></div>"; }

$blog_list.="<div style=\"float:left;\"><small>
<div><b>".$lang[864].":</b> $tags</div>
<div>$cmnts</div></small>
</div></div>
<br><br></div></div>
<div><table border=0><tr><td><iframe src=\"http://www.facebook.com/plugins/like.php?href=".urlencode("$htpath/index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]")."\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; width:450px; height:80px;\"></iframe></td><td valign=top><g:plusone size=\"medium\" href=\"$htpath/index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"></g:plusone></td></tr></table></div>
";
$fff+=1;
}
}
} else {
$ff+=1;
//без поиска по тегам
if ($tmp[7]!=""){
$t=explode(",",$tmp[7]);
while(list($key1,$val1)=each($t)) {
$val1=trim(trim($val1));
$tags.="<a href=\"index.php?action=blog&tag=".rawurlencode($val1)."\">$val1</a>, ";
}
}
$tags= str_replace(", \n","",$tags."\n");
$blog_list.="<div style=\"overflow:hidden;\"><div class=round2>
<div style=\"float:right;width:160px;\" align=right>$social_ava
<div style=\"margin:5px\">$social_ico$social_user<b>".$social_link1."$tmp[12]".$social_link2."</b></div>
<div style=\"margin:5px\"><small>$tmp[0]/$tmp[1]/$tmp[2] <i>$tmp[4]</i></small></div></div>
<a href=\"index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"><h4><font color=$nc3>$tmp[5]</font></h4></a>
<div><i>$tmp[6]</i></div>
<br>
<div>".str_replace("<img", "<img style=\"margin-bottom:10px; margin-right:10px;\" align=left", $tmp[8]).$con."$editblog<br><br></div><div style=\"clear:both;\">";
if (($enable_blog_comments==1)&&($tmp[9]=="YES")) { $blog_list.="<div class=round4 style=\"float:left;width:40px; overflow:hidden; margin: 0px 10px 0px 0px;\" align=center><a href=\"index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]#view_comments\"><font size=4 color=$nc3>$com[0]</font></a></div><div style=\"float:left;margin-right: 10px;\"><form method=GET action=index.php#hidecomm><input type=hidden name=action value=\"blog\"><input type=hidden name=message value=\"$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"><input type=hidden name=hidecomm value=\"no\"><input type=submit value=\"$lang[912]\" style=\"height:30px\"></form></div>"; }

$blog_list.="<div style=\"float:left;\"><small>
<div><b>".$lang[864].":</b> $tags</div>
<div>$cmnts</div></small>
</div></div>
<br><br></div></div>
<div><table border=0><tr><td><iframe src=\"http://www.facebook.com/plugins/like.php?href=".urlencode("$htpath/index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]")."\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; width:450px; height:80px;\"></iframe></td><td valign=top><g:plusone size=\"medium\" href=\"$htpath/index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"></g:plusone></td></tr></table></div>
";
$fff+=1;
}
unset($tmp,$cf,$blogfilep,$con,$com,$cmnts,$t,$tags,$key1,$val1,$show);
} else {
$ff+=1;
}

}
//echo $ff." $blog_perpage>".$fff."? ".count($list);

//$blog_list.="<iframe src=\"http://www.facebook.com/plugins/like.php?href=$htpath/index.php?action=blog\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; width:450px; height:80px\"></iframe>";

if ($blog_perpage<=$fff) {
//echo ($blog_perpage+$start)."<=$fff ". count($list);
if ($yok==0) {
$blog_list.="<div style=\"clear:both; background-color:$nc6; padding:10px\" align=center>&lt;&lt; <a href=\"index.php?action=blog&month=$month&year=$year&start=".($start+$blog_perpage)."&tag=$tag\">$lang[923] $blog_perpage</a> ";
} else {
$blog_list.="<div style=\"clear:both; background-color:$nc6; padding:10px\" align=center>&lt;&lt; <a href=\"index.php?action=blog&start=".($start+$blog_perpage)."&tag=$tag\">$lang[923] $blog_perpage</a> ";
}
if ($start!=0) {
if ($yok==0) {
$blog_list.="&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"index.php?action=blog&month=$month&year=$year&start=".($start-$blog_perpage)."\">$lang[924] $blog_perpage</a> &gt;&gt";
} else {
$blog_list.="&nbsp;&nbsp;&nbsp;&nbsp; <a href=\"index.php?action=blog&start=".($start-$blog_perpage)."\">$lang[924] $blog_perpage</a> &gt;&gt";
}
}
$blog_list.="</div><br><br>";
} else {
$blog_list.="<div  align=center style=\"clear:both; background-color:$nc6; padding:10px\">";
if ($blog_perpage>$fff) {if (($start-$blog_perpage)>=0) {

if ($yok==0) {
$blog_list.="<a href=\"index.php?action=blog&month=$month&year=$year&start=".($start-$blog_perpage)."&tag=$tag\">$lang[924] $blog_perpage</a> &gt;&gt";
} else {
$blog_list.="<a href=\"index.php?action=blog&start=".($start-$blog_perpage)."&tag=$tag\">$lang[924] $blog_perpage</a> &gt;&gt";
}
}}
$blog_list.="</div><br><br>";
}
unset ($key,$val,$list);
} else {
$blog_list.="<div class=round2 style=\"width:97%; overflow: hidden;\">$lang[922]</div>";
}
//add new topic form
$blog_list.="</div>";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
if (!isset($psocial_net)) {$psocial_net="";}
if (!isset($psocial_other)) {$psocial_other="";}
if (!isset($psocial_gender)) {$psocial_gender="";}
if (!isset($psocial_ava )) {$psocial_ava ="";}
if (!isset($imgs)) {$imgs="";}
$blog_list.="<div id=sendcomment><div align=center><input type=button value=\"$lang[916]\" onclick=\"javascript:document.getElementById('commentblock').style.display='';document.getElementById('commentblock').style.visibility='visible';document.getElementById('sendcomment').style.display='none';document.getElementById('sendcomment').style.visibility='hidden';\"></div></div>
<div id=commentblock style=\"display: none; visibility: hidden;\">
<div class=round2><div class=comm><h4>$lang[915]</h4></div><div>
<script type=\"text/javascript\">
function click_bb(aid,Tag) {
var f = '';
if (Tag == 'a') f = ' href=\'' + prompt('$lang[928]:') + '\'';
if (Tag == 'img') f = ' src=\'' + prompt('$lang[926]:') + '\'';

  var Open='<'+Tag+f+'>';
  var Close='</'+Tag+'>';

if (Tag == 'img' || Tag == 'br' || Tag == 'cut' ) Close = '';

  var doc = document.getElementById(aid);
        if (window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) {
                doc.focus();
                sel = document.selection.createRange();
                sel.text = Open+sel.text+Close;
                doc.focus();
    }   else {
                var ss = doc.scrollTop;
                sel1 = doc.value.substr(0, doc.selectionStart);
                sel2 = doc.value.substr(doc.selectionEnd);
                sel = doc.value.substr(doc.selectionStart,
                doc.selectionEnd - doc.selectionStart);
                var text = doc.firstChild;

if (Tag == 'code') {sel = sel.replace(/</g,'&lt;');sel = sel.replace(/>/g,'&gt;');sel = sel.replace(/\\r?\\n|\\r/g,'<br>'); }

                doc.value = sel1 + Open + sel + Close + sel2;
                selPos = Open.length + sel1.length + sel.length + Close.length;
                doc.setSelectionRange(sel1.length, selPos);
                doc.scrollTop = ss;
        }
        return false;
}
jQuery.fn.maxlength = function(options) {
  var settings = jQuery.extend({
    maxChars: 10000, // max chars
    leftChars: \"character left\" //text
  }, options);
  return this.each(function() {
    var me = $(this);
    var l = settings.maxChars;
    me.bind('keydown keypress keyup',function(e) {
      if(me.val().length>settings.maxChars) me.val(me.val().substr(0,settings.maxChars));
      l = settings.maxChars - me.val().length;
      me.next('div').html('".$lang[850].": ' + l);
    });
    me.after('<div class=\"maxlen\">".$lang[850].": ' + settings.maxChars + '</div>');
  });
};
</script>
<script type=\"text/javascript\">
$(document).ready(function(){
  $(\"#textarea\").maxlength();
});
</script>
<br><form method=POST action=index.php id=\"newtopic\">
<input type=hidden name=tread value=\"\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=message value=\"$message\">
<input type=hidden name=social_net value=\"$psocial_net\">
<input type=hidden name=social_other value=\"$psocial_other\">
<input type=hidden name=social_gender value=\"$psocial_gender\">
<input type=hidden name=social_ava value=\"$psocial_ava\">
<table border=0 width=100%><tr><td><table border=0>
<tr><td align=right valign=top><b>".$lang[357].":</b></td><td><input type=text name=name value=\"".$name."\" size=40 maxlength=\"80\" style=\"width:100%\"><font color=#b94a48>*</font></td><td></td></tr>
<tr><td align=right valign=top><b>".$lang[862].":</b></td><td><input type=text name=topic value=\"\" size=40 maxlength=\"80\" style=\"width:100%\"><font color=#b94a48>*</font></td><td></td></tr>
<tr><td align=right valign=top><b>".str_replace(" ","&nbsp;",$lang['short']).":</b></td><td><input type=text name=topicdesc value=\"\" size=40 maxlength=\"80\" style=\"width:100%\"></td><td></td></tr>
<tr><td align=right valign=top><b>".$lang[864].":</b></td><td><input type=text name=blogtags value=\"\" size=40 maxlength=\"80\" style=\"width:100%\"><br><small>$lang[863]</small></td><td></td></tr>
<tr><td align=right valign=top><b>".$lang[861].":</b></td><td width=100%><input type=hidden id=\"el_999999\" size=1 name=\"blogicon\" value=\"".htmlspecialchars($imgs)."\"> <input type=button value=\"...\" onClick=javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=999999','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')>&nbsp;&nbsp;&nbsp;&nbsp;<b>".$lang[8].":</b> <input type=checkbox checked name=blog_checkbox value=\"YES\"> - ".$lang[890]." </td><td></td></tr>
</table></td><td><img src=\"$image_path/pix.gif\" id=\"img_999999\"></td></tr></table>
<textarea id=textarea name=newtopic cols=60 rows=20 style=\"width:97%\" maxlength=\"10000\"></textarea></form><br>
<button onclick=\"click_bb('textarea','a')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></button>&nbsp;
<button onclick=\"click_bb('textarea','img')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></button>&nbsp;
<button onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=4&dest=textarea','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')\" title=\"$lang[938]\"><img src=\"$image_path/picture.png\"></button>&nbsp;
<button onclick=\"click_bb('textarea','b')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></button>&nbsp;
<button onclick=\"click_bb('textarea','i')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></button>&nbsp;
<button onclick=\"click_bb('textarea','u')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></button>&nbsp;
<button onclick=\"click_bb('textarea','sup')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></button>&nbsp;
<button onclick=\"click_bb('textarea','center')\" title=\"$lang[936]\"><img src=\"$image_path/align_center.png\"></button>&nbsp;
<button onclick=\"click_bb('textarea','code')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></button>&nbsp;
<br><b>$lang[917]</b> - $lang[918]</div> </div>

<div align=center>
<input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('commentblock').style.display='none';document.getElementById('commentblock').style.visibility='hidden';document.getElementById('sendcomment').style.display='';document.getElementById('sendcomment').style.visibility='visible';\"> &nbsp; <input type=button onclick=\"document.getElementById('newtopic').submit();\" value=\"$lang[816]\"><br>
</div>
</div>
";
}}



} else {

if (file_exists("$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/list.txt")==TRUE) {
if (!isset($listbl[$message])){$listbl[$message]=file("$fold/$tmp0[0]/$tmp0[1]/$tmp0[2]/list.txt"); } else {reset($listbl[$message]);}
while(list($key,$val)=each($listbl[$message])) {
$tmp=explode("|",$val);
if (($tmp[0]==$tmp0[0])&&($tmp[1]==$tmp0[1])&&($tmp[2]==$tmp0[2])&&($tmp[3]==$tmp0[3])) {
$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3].txt";
$con=$lang[921];
$com=$lang[920];
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$con=@fread($blogfilep,@filesize($cf));
fclose ($blogfilep);
}
$con=str_replace("[cut]","<a name=\"cut\"></a>",$con);
$poll_exp="\n";
require "./modules/mod_poll.php";

$cf="$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3].cnt";
$cmnts=$lang[920];
$com[0]=0;
if (file_exists($cf)){
$blogfilep=@fopen($cf,"r");
$com=explode("|",@fread($blogfilep,@filesize($cf)));
fclose ($blogfilep);
$social_ico=""; $social_link1="";$social_link2="";
if (($com[6]=="facebook")&&($com[7]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($com[7])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($com[6]=="twitter")&&($com[7]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($com[7])."\">";$social_link2="</a>";}
if (($com[6]=="vkontakte")&&($com[7]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($com[7])."\">";$social_link2="</a>";}

if ((trim($com[8])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($com[8])."\" border=0>$social_link2";} else {$social_ava="";}
if ((trim($com[6])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

$cmnts="<div><b>".$lang[910].":</b> $com[4] $social_ico$social_user".$social_link1."$com[5]".$social_link2."</div> ";
if ($com[4]=="") {$cmnts="";}
}
$tags="";
if ($tmp[7]!="") {
$t=explode(",",$tmp[7]);
while(list($key1,$val1)=each($t)) {
$val1=trim(trim($val1));
$tags.="<a href=\"index.php?action=blog&tag=".rawurlencode($val1)."\">$val1</a>, ";
}
}
$tags=str_replace(", \n","",$tags."\n");
$social_ico=""; $social_link1="";$social_link2="";
if (($tmp[10]=="facebook")&&($tmp[11]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($tmp[11])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if (($tmp[10]=="twitter")&&($tmp[11]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($tmp[11])."\">";$social_link2="</a>";}
if (($tmp[10]=="vkontakte")&&($tmp[11]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($tmp[11])."\">";$social_link2="</a>";}

if ((trim($tmp[13])!="")){$social_ava="$social_link1<img src=\"gallery/avatars/".trim($tmp[13])."\" border=0>$social_link2";} else {$social_ava="";}
if ((trim($tmp[10])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

$blog_list.="<div class=round2>
<div style=\"float:right;width:160px;\" align=right>$social_ava
<div> $social_ico$social_user<b>".$social_link1."$tmp[12]".$social_link2."</b></div>
<div style=\"margin:5px\"><small>$tmp[0]/$tmp[1]/$tmp[2] <i>$tmp[4]</i></small></div></div><font color=$nc3><h4>$tmp[5]</h4></font>
<div><i>$tmp[6]</i></div>
<br>
<div>$con</div></div>";
if (($enable_blog_comments==1)&&($tmp[9]=="YES")) { $blog_list.="<div class=round4 style=\"float:left;width:40px; margin: 0px 10px 0px 0px;\" align=center><a href=\"#view_comments\"><font size=4 color=$nc3>$com[0]</font></a></div>";
} else {  $blog_list.=""; }

$blog_list.="<div style=\"float:left;\">
<div><b>".$lang[864].":</b> $tags</div>
<div>$cmnts</div></div><br><br><br>
<div><table border=0><tr><td><iframe src=\"http://www.facebook.com/plugins/like.php?href=".urlencode("$htpath/index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]")."\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; width:450px; height:80px;\"></iframe></td><td valign=top><g:plusone size=\"medium\" href=\"$htpath/index.php?action=blog&message=$tmp[0]/$tmp[1]/$tmp[2]/$tmp[3]\"></g:plusone></td></tr></table></div></div>
";
//show comments
$cmnts="";
if (($enable_blog_comments==1)&&($tmp[9]=="YES")) {
if ($com[0]>0) {

$cmntsents=Array();
$handle=opendir("$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3]");
while (($blogfile = @readdir($handle))!==FALSE) {
if (($blogfile == '.') || ($blogfile == '..')) {
continue;
} else {
$cmntsents[$blogfile]=file("$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3]/".$blogfile);
$dates[$blogfile]=filemtime("$fold/$tmp[0]/$tmp[1]/$tmp[2]/comments/$tmp[3]/".$blogfile);
}
}
@closedir($handle);
ksort($cmntsents);
reset($cmntsents);

while(list($key,$val)=each($cmntsents)) {
$q=explode(".",$key);
$quotes=(10*(count($q)-1))+1;
$color=lighter("#".substr(md5("$htpath.$quotes"),0,6),80);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$blog_delc="  &nbsp;  &nbsp;  <a href=\"index.php?action=blog&exp=$exp&message=$message&blog_delcom=$key#comment_$message/$key\"><font color=#b94a48>X</font> ".$lang[744]."</a>";
}}
if ((trim($val[0])=="")&&(trim($val[1])=="")&&(trim($val[2])=="")) {$cmnts.="<a name=\"comment_$message/$key\"></a>";} else {
$blogreply="<a href=\"#reply\" onclick=\"javascript:document.getElementById('s_$key').style.display='none';document.getElementById('s_$key').style.visibility='hidden';document.getElementById('dd_$key').style.display='';document.getElementById('dd_$key').style.visibility='visible';\">";
$blogreply2="</a>";
$blreply="<a href=\"#reply\" onclick=\"javascript:document.getElementById('s_$key').style.display='';document.getElementById('s_$key').style.visibility='visible';document.getElementById('dd_$key').style.display='none';document.getElementById('dd_$key').style.visibility='hidden';\">";
$blreply2="</a> [+]";
if (trim($val[0])=="") {if (strlen(trim($val[2])<40)) { $val[0]=str_replace("<br>", " ", $val[2]); $blogreply2.=" "; $blreply2="</a>";  $val[2]="";} else {$val[0]=substr(str_replace("<br>", " ",$val[2]),0,40)."... [+]"; }} else {
$val[2]="<br>".$val[2]."<br>"; }
$comments_found+=1;
$tmp=explode("|",$val[1]);
$val[1]=$tmp[0];
$social_ico=""; $social_link1="";$social_link2="";
if ((@$tmp[1]=="facebook")&&(@$tmp[2]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($tmp[2])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if ((@$tmp[1]=="twitter")&&(@$tmp[2]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($tmp[2])."\">";$social_link2="</a>";}
if ((@$tmp[1]=="vkontakte")&&(@$tmp[2]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($tmp[2])."\">";$social_link2="</a>";}

if ((trim(@$tmp[3])!="")){$social_ava="<div style=\"float:left; margin-right:10px; margin-bottom:5px;\">$social_link1<img src=\"gallery/avatars/".trim($tmp[3])."\" border=0 width=25 height=25>$social_link2</div>";} else {$social_ava="";}
if ((trim(@$tmp[1])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

if (($exp=="")&&($quotes>1)) {
$cmnts.="<a name=\"comment_$message/$key\"></a><div style=\"overflow: hidden; width:100%\"><table border=0 width=100%><tr><td><img src=$image_path/pix.gif height=10 width=$quotes></td><td width=100%>
<div id=\"dd_$key\">$social_ava"."$blreply".trim(trim($val[0]))."$blreply2 &nbsp; $social_ico$social_user<b>".$social_link1."$val[1]".$social_link2."</b>$blog_delc</div>
<div id=\"s_$key\" style=\"display:none; vilibility:hidden\">
<div class=round2 style=\"float:left; overflow: hidden; width:97%; border: 1px solid $color; background: ".lighter($color,100).";\">"."$social_ava".""."<div class=comm style=\"float:right; width:160px;background: $color; border: 1px solid ".lighter($color,-50).";\" align=center>".date("Y/m/d H:i:s" , $dates[$key])."</div><div>$blogreply<b><font size=3>".trim(trim($val[0]))."</font></b>$blogreply2 &nbsp; $social_ico$social_user <b>".$social_link1."$val[1]".$social_link2."</b><br>$val[2]
<br><div id=\"d_$key\"><a href=\"#reply\" onclick=\"javascript:document.getElementById('$key').style.display='';document.getElementById('$key').style.visibility='visible';document.getElementById('d_$key').style.display='none';document.getElementById('d_$key').style.visibility='hidden';\">$lang[806]</a>$blog_delc<div style=\"float:right; width:180px;\" align=center><font size=1><a href=\"#comment_$message/$key\">URL</a></font></div></div>
<div id=\"$key\" style=\"display:none; vilibility:hidden\">
<br><form method=POST action=index.php>
<input type=hidden name=tread value=\"$key\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=message value=\"$message\">
<input type=hidden name=social_net value=\"$psocial_net\">
<input type=hidden name=social_other value=\"$psocial_other\">
<input type=hidden name=social_gender value=\"$psocial_gender\">
<input type=hidden name=social_ava value=\"$psocial_ava\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"40\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"40\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:100%\" maxlength=\"1000\"></textarea>
<input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('$key').style.display='none';document.getElementById('$key').style.visibility='hidden';document.getElementById('d_$key').style.display='';document.getElementById('d_$key').style.visibility='visible';\"> &nbsp; <input type=submit value=\"$lang[806]\"></form></div>
</div></div></div>
</td></tr></table></div>";
} else {
$cmnts.="<a name=\"comment_$message/$key\"></a><div style=\"overflow: hidden; width:100%\"><table border=0 width=100%><tr><td><img src=$image_path/pix.gif height=10 width=$quotes></td><td width=100%><div class=round2 style=\"float:left; overflow: hidden; width:97%; border: 1px solid $color; background: ".lighter($color,100).";\">
"."$social_ava"."<div class=comm style=\"float:right; width:160px;background: $color; border: 1px solid ".lighter($color,-50).";\" align=center>".date("Y/m/d H:i:s" , $dates[$key])."</div><div><font size=3><b>$val[0]</b></font> &nbsp; $social_ico$social_user<b>".$social_link1."$val[1]".$social_link2."</b><br>$val[2]
<br><div id=\"d_$key\"><a href=\"#reply\" onclick=\"javascript:document.getElementById('$key').style.display='';document.getElementById('$key').style.visibility='visible';document.getElementById('d_$key').style.display='none';document.getElementById('d_$key').style.visibility='hidden';\">$lang[806]</a>$blog_delc<div style=\"float:right; width:180px;\" align=center><font size=1><a href=\"#comment_$message/$key\">URL</a></font></div></div>
<div id=\"$key\" style=\"display:none; vilibility:hidden\">
<br><form method=POST action=index.php>
<input type=hidden name=tread value=\"$key\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=message value=\"$message\">
<input type=hidden name=social_net value=\"$psocial_net\">
<input type=hidden name=social_other value=\"$psocial_other\">
<input type=hidden name=social_gender value=\"$psocial_gender\">
<input type=hidden name=social_ava value=\"$psocial_ava\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"40\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"40\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:100%\" maxlength=\"1000\"></textarea>
<input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('$key').style.display='none';document.getElementById('$key').style.visibility='hidden';document.getElementById('d_$key').style.display='';document.getElementById('d_$key').style.visibility='visible';\"> &nbsp; <input type=submit value=\"$lang[806]\"></form></div>
</div></div>
</td></tr></table></div>";
}
}
}
}
if ($cmnts=="") {$cmnts="<div>$lang[180]</div>";}
if ($hidecomm=="") {
$blog_list.="<div id=sendcomment style=\"clear:both;\"><div align=center><input type=button value=\"$lang[912]\" onclick=\"javascript:document.getElementById('commentblock').style.display='';document.getElementById('commentblock').style.visibility='visible';document.getElementById('sendcomment').style.display='none';document.getElementById('sendcomment').style.visibility='hidden';\"></div></div>
<div id=commentblock style=\"display: none; visibility: hidden;\">";}
$blog_list.="<a name=\"hidecomm\"></a><div class=round2 style=\"clear:both;\">
<div><b>$lang[912]:</b></div>
<br><form method=POST action=index.php>
<input type=hidden name=social_net value=\"$psocial_net\">
<input type=hidden name=social_other value=\"$psocial_other\">
<input type=hidden name=social_gender value=\"$psocial_gender\">
<input type=hidden name=social_ava value=\"$psocial_ava\">
<input type=hidden name=tread value=\"\">
<input type=hidden name=action value=\"blog\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=message value=\"$message\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"40\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"40\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:97%\" maxlength=\"1000\"></textarea>";
if ($hidecomm=="") {
$blog_list.="<input type=button value=\"$lang[386] \" onclick=\"javascript:document.getElementById('commentblock').style.display='none';document.getElementById('commentblock').style.visibility='hidden';document.getElementById('sendcomment').style.display='';document.getElementById('sendcomment').style.visibility='visible';\"> &nbsp; ";}
$blog_list.="<input type=submit value=\"$lang[806]\"></form>";
if ($hidecomm=="") {$blog_list.="</div>";}

$blog_list.="</div><a name=\"view_comments\"></a> <br>
<div class=comm style=\"overflow: hidden;\">
<table border=0 width=100%><tr><td valign=top>
<font size=3><b>".$lang[8].":</b></font></td><td valign=top align=right><a href=\"index.php?action=blog&message=$message&exp=#view_comments\">";
if ($exp=="") { $blog_list.="<b>"; }
$blog_list.=$lang[913];
if ($exp=="") { $blog_list.="</b>"; }
$blog_list.="</a> | <a href=\"index.php?action=blog&message=$message&exp=yes#view_comments\">";
if ($exp=="yes") { $blog_list.="<b>"; }
$blog_list.=$lang[914];
if ($exp=="yes") { $blog_list.="</b>"; }
$blog_list.="</a></td></tr></table></div>$flood<br>
$cmnts
</div>
</div>";
}
unset($tmp,$cf,$blogfilep,$con,$com,$cmnts,$t,$tags,$key1,$val1,$tmp0,$blogfile,$handle,$cmnts,$q,$listbl);
break;
}
}

unset($key,$val,$list);
}
}
}
?>
