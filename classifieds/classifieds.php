<?php
$admform="";
$cl_cont=Array("","","","","","","","","","");
$t=Array("","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","");
$matches=Array();
$matches[0]=Array("");
$html="on"; //on or off
$fds="";
$_SESSION["classifieds"]=md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt);
function getRealIP()
{
   if (!isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {$_SERVER['HTTP_X_FORWARDED_FOR']="";}
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');

            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }

   return $client_ip;

}

$rulez="";
$rulezbutton="";
if (file_exists("./classifieds/base/rules.txt")) {

$fprulf=fopen("./classifieds/base/rules.txt","r");
$rulez=str_replace("\n","<br>", fread($fprulf,filesize("./classifieds/base/rules.txt")));
fclose ($fprulf);
unset($fprulf);
$rulezbutton="<div style=\"float: right; margin: 10px 10px 10px 10px;\"><a class=ocat1 id=\"rules\" title=\"$lang[1537]\" href=\"#open_rules\"><img src=\"images/help.gif\" border=0> <b>$lang[1537]</b></a></div>
<div class=hidden>
<div style=\"width:630px; height: 380px; overflow: auto\" id=\"open_rules\">
<table border=0 width=100%>
<tr><td align=left>$rulez</td></tr>
</table></div>
</div>
<script language=javascript>
<!--
$(document).ready(function() {
$(\"#rules\").fancybox({
'onComplete' : function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'     : 'no',
        'width'     : 640,
        'height'     : 400,
      'padding' : 10
});
});
-->
</script>
";
}

if(isset($_GET['cl_post'])) $cl_post=$_GET['cl_post']; elseif(isset($_POST['cl_post'])) $cl_post=$_POST['cl_post']; else $cl_post="";
if (!preg_match("/^[0-9]+$/",$cl_post)){ $cl_post=""; }

if(isset($_GET['ed_post'])) $ed_post=$_GET['ed_post']; elseif(isset($_POST['ed_post'])) $ed_post=$_POST['ed_post']; else $ed_post="";
if (!preg_match("/^[0-9]+$/",$ed_post)){ $ed_post=""; }

if(isset($_GET['wr_post'])) $wr_post=$_GET['wr_post']; elseif(isset($_POST['wr_post'])) $wr_post=$_POST['wr_post']; else $wr_post="";
if (!preg_match("/^[0-9]+$/",$wr_post)){ $wr_post=""; }

unset($f6);
$cls__delc="";
$handle=opendir('./smileys/');
while (($f6 = readdir($handle))!==FALSE) {
$mtyp=toLower(substr($f6,-3));
if (($mtyp == 'png')||($mtyp == 'gif')) {
if ($mtyp == 'gif') {$smexp=":";} else {$smexp="#";}
//echo strtoken("$f6",".")."<br>";
$dir_smiles[$f6]="$smexp".strtoken("$f6",".")."$smexp";
}
}
closedir($handle);
unset($f6);
natcasesort ($dir_smiles);
$new_w=100;
$new_h=100;
$new_w2=640;
$new_h2=640;
$mmax=3000;
$sclwidth="100%"; //special columns width
$clwidth="46%";
$maximg_size=20971520;
$social_auth="";
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
$cl_list="";

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
$comments_found=0;
$cl_delc="";

if(isset($_GET['level'])) $level=$_GET['level']; elseif(isset($_POST['level'])) $level=$_POST['level']; else $level="";
if(isset($_GET['cl_level'])) $cl_level=$_GET['cl_level']; elseif(isset($_POST['clfile'])) $clfile=$_POST['clfile']; else $clfile="";
if(isset($_GET['cl_key'])) $cl_key=$_GET['cl_key']; elseif(isset($_POST['cl_key'])) $cl_key=$_POST['cl_key']; else $cl_key="";
if(isset($_GET['hidecomm'])) $hidecomm=$_GET['hidecomm']; elseif(isset($_POST['hidecomm'])) $hidecomm=$_POST['hidecomm']; else $hidecomm="";
if (!preg_match("/^[no]+$/i",$hidecomm)) { $hidecomm="";}
$hidecomm=substr($hidecomm, 0, 10);
if(@isset($_GET['oauth_provider'])) { $oauth_provider=$_GET['oauth_provider']; }
if (!@preg_match("/^[a-z]+$/i",$oauth_provider)) { $oauth_provider="";}
$oauth_provider=substr($oauth_provider, 0, 10);
if(isset($_GET['message'])) $message=$_GET['message']; elseif(isset($_POST['message'])) $message=$_POST['message']; else $message="";
$message=str_replace("%2f","/",str_replace("%2F","/",$message));
if (!preg_match("/^[a-z0-9_\/]+$/i",$message)) { $message="";}
if(isset($_GET['editmessage'])) $editmessage=$_GET['editmessage']; elseif(isset($_POST['editmessage'])) $editmessage=$_POST['editmessage']; else $editmessage="";
$editmessage=str_replace("%2f","/",str_replace("%2F","/",$editmessage));
if (!preg_match("/^[a-z0-9_\/]+$/i",$editmessage)) { $editmessage="";}


if(isset($_GET['social_net'])) $social_net=$_GET['social_net']; elseif(isset($_POST['social_net'])) $social_net=$_POST['social_net']; else $social_net="";
if (!preg_match("/^[a-z0-9]+$/i",$social_net)) { $social_net="";}
if(isset($_GET['social_account'])) $social_account=$_GET['social_account']; elseif(isset($_POST['social_account'])) $social_account=$_POST['social_account']; else $social_account="";
if (!preg_match("/^[a-z0-9]+$/i",$social_account)) { $social_account="";}
if(isset($_GET['social_other'])) $social_other=$_GET['social_other']; elseif(isset($_POST['social_other'])) $social_other=$_POST['social_other']; else $social_other="";
if (!preg_match("/^[а-€ј-яa-zA-Z0-9_-]+$/i",$social_other)) { $social_other="";}
if(isset($_GET['social_gender'])) $social_gender=$_GET['social_gender']; elseif(isset($_POST['social_gender'])) $social_gender=$_POST['social_gender']; else $social_gender="";
if (!preg_match("/^[femal]+$/i",$social_gender)) { $social_gender="";}
if(isset($_GET['social_ava'])) $social_ava=$_GET['social_ava']; elseif(isset($_POST['social_ava'])) $social_ava=$_POST['social_ava']; else $social_ava="";
if (!preg_match("/^[a-zAZ0-9\._-]+$/i",$social_ava)) { $social_ava="";}


if(isset($_GET['cl_checkbox'])) $cl_checkbox=$_GET['cl_checkbox']; elseif(isset($_POST['cl_checkbox'])) $cl_checkbox=$_POST['cl_checkbox']; else $cl_checkbox="";
if (!preg_match("/^[a-z0-9\.]+$/i",$cl_checkbox)) { $cl_checkbox="";}
if(isset($_GET['cl_delcom'])) $cl_delcom=$_GET['cl_delcom']; elseif(isset($_POST['cl_delcom'])) $cl_delcom=$_POST['cl_delcom']; else $cl_delcom="";
if (!preg_match("/^[a-z0-9\.]+$/i",$cl_delcom)) { $cl_delcom="";}
if(isset($_GET['blogtags'])) $blogtags=$_GET['blogtags']; elseif(isset($_POST['blogtags'])) $blogtags=$_POST['blogtags']; else $blogtags="";
if (!isset($blogtags)){$blogtags="";}

$cmnts=$lang[920];
$com[0]=0;
$flood="";
$cl_next="";
$cl_prev="";


if(isset($_GET['tread'])) $tread=$_GET['tread']; elseif(isset($_POST['tread'])) $tread=$_POST['tread']; else $tread="";
if (!preg_match("/^[a-z0-9\.]+$/i",$tread)) { $tread="";}
if(isset($_GET['exp'])) $exp=$_GET['exp']; elseif(isset($_POST['exp'])) $exp=$_POST['exp']; else $exp="";
if (!preg_match("/^[a-z0-9]+$/i",$exp)) { $exp="";}
$exp=substr($exp, 0, 10);
if(isset($_GET['name'])) $name=$_GET['name']; elseif(isset($_POST['name'])) $name=$_POST['name']; else $name="";
if (!isset($name)){$name="";} $name=trim($name);
$name = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $name); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $name);  $name = str_replace(chr(27), "", $name); $name = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$name))); $name = str_replace(chr(10), "", $name);
$name=substr($name, 0, 100);
if (($name=="")&&($details[1]!="")) {$name=$details[1];}
if(isset($_GET['topic'])) $topic=$_GET['topic']; elseif(isset($_POST['topic'])) $topic=$_POST['topic']; else $topic="";
if (!isset($topic)){$topic="";} $topic=trim($topic);
$topic=substr($topic, 0, 100);
$topic = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $topic); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $topic);  $topic = str_replace(chr(27), "", $topic); $topic = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$topic))); $topic = str_replace(chr(10), "", $topic);

if(isset($_GET['cmntsent'])) $cmntsent=$_GET['cmntsent']; elseif(isset($_POST['cmntsent'])) $cmntsent=$_POST['cmntsent']; else $cmntsent="";

if (!isset($cmntsent)){$cmntsent="";} $cmntsent=trim($cmntsent);
require "./modules/social_auth.php";
//delete comment
if (($cl_delcom!="")&&($cl_post!="")) {
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {

$comfolder=substr(md5($cl_post),0,3);
$comdelf="./classifieds/comments/$comfolder/$cl_post/$cl_delcom";
$fp=fopen($comdelf,"w");
fputs($fp, "\n\n\n");
fclose ($fp);
unset ($comdelf,$fp);
}
}
}

$cmntsent=substr($cmntsent, 0, 2000);$cmntsent = preg_replace('#(<)([\/]?.*?)(>)#is', '&lt;\2&gt;', $cmntsent); preg_replace('/\:[0-9a-z\:]+\]/si', ']', $cmntsent);  $cmntsent = str_replace(chr(27), "", $cmntsent); $cmntsent = str_replace(chr(13), "", str_replace("[", "(", str_replace("]", ")",$cmntsent))); $cmntsent = str_replace(chr(10), "[br]", $cmntsent);

$tread=substr($tread, 0, 300);
$name=substr($name, 0, 300);
$cl_price=substr(@$cl_price, 0, 100);
$cl_city=substr(@$cl_city, 0, 100);
$cl_email=substr(@$cl_email, 0, 100);
$cl_title=str_replace("  ", " ", str_replace(",", ", ", substr(@$cl_title, 0, 100)));
$cl_description = str_replace("  ", " ", str_replace(",", ", ", @$cl_description));
if(get_magic_quotes_gpc()) {
$cl_title = stripslashes(@$cl_title);
$cl_city = stripslashes(@$cl_city);
$cl_email = stripslashes(@$cl_email);
$cl_description = stripslashes(@$cl_description);
$cl_price = stripslashes(@$cl_price);
$cmntsent = stripslashes(@$cmntsent);
$topic = stripslashes(@$topic);
$tread = stripslashes(@$tread);
$name = stripslashes(@$name);
$social_ava = stripslashes(@$social_ava);
$social_other = stripslashes(@$social_other);
$social_gender = stripslashes(@$social_gender);
$social_net = stripslashes(@$social_net);
}


$fl=1;
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {



//delete post

if ((@$del_post!="")&&(@$level!="")) {
$del_post_time=substr($del_post,0,(strlen($del_post)-3));
$delY=date("Y",doubleval($del_post_time));
$delM=date("m",doubleval($del_post_time));
$delD=date("d",doubleval($del_post_time));
$del_post2="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delM."/".$delD;
@unlink ($del_post2."/$del_post");
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
$comfolder=substr(md5($del_post),0,3);
if (deleteAll("./classifieds/comments/$comfolder/$del_post")==false){

} else {

$cl_list.="<div class=comm align=center><h4>$lang[209]</h4></div>";}
@unlink ("./classifieds/comments/$comfolder/$del_post".".cnt");

$f1="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delM."/".$delD."/"."date.lst";
$tm=file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$del_post) {unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delM."/".$delD.".lst";
if (filesize($f1)==0) {@unlink ("$f1");}
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$del_post) { unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);
$f1="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delY."_".$delM."_".$delD.".lst";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$del_post) { unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="./classifieds/base".rawurldecode($level)."/last10.txt";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$del_post) { unset ($tm[$key]);}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
unset($fp,$tm,$key,$val,$m1,$f1);

}









//edit post

if ((@$ed_post!="")&&(@$level!="")&&(@$wr_post==1)) {
$prc=0;

if(isset($_POST['pex'])) { $pex=$_POST['pex'];
if (is_array($pex)) {
$prc=1;
if (count($pex)<9) {
$cl_list.="<div class=round><h4><font color=#b94a48>ERROR 'pex' count=".count($pex)."! Must be >= 9</font></h4></div>"; $prc=0;}

} else {
$cl_list.="<div class=round><h4><font color=#b94a48>ERROR 'pex' not Array!</font></h4></div>"; $prc=0;}
} else {
$cl_list.="<div class=round><h4><font color=#b94a48>ERROR 'pex' not exists!</font></h4></div>"; $prc=0;}
if ($prc==1) {
reset($pex);
while (list ($pnum, $pval) = each ($pex)) {
$pex[$pnum] = strip_tags($pex[$pnum]);
$pex[$pnum] = str_replace("|" , "", $pex[$pnum]);
$pex[$pnum] = str_replace("<" , "&lt;", $pex[$pnum]);
$pex[$pnum]= str_replace(">" , "&gt;", $pex[$pnum]);
$pex[$pnum] = str_replace(chr(92) , "", @$pex[$pnum]); // strip backslash
$pex[$pnum] = str_replace("^" , "", @$pex[$pnum]);
$pex[$pnum] = str_replace("\n" , " [br]", @$pex[$pnum]);
$pex[$pnum] = str_replace("\r" , " [br]", @$pex[$pnum]);
$pex[$pnum] = str_replace(" [br] [br]" , " [br]", @$pex[$pnum]);
$pex[$pnum] = trim(@$pex[$pnum]);
if(get_magic_quotes_gpc()) { $pex[$pnum] = stripslashes(@$pex[$pnum]);}
$pex[$pnum]= badwords(@$pex[$pnum]);
}
$cl_list.="<div class=round align=center><h4><font color=#468847>".$lang[209]."</font></h4></div>";


$del_post_time=substr($ed_post,0,(strlen($ed_post)-3));
$delY=date("Y",doubleval($del_post_time));
$delM=date("m",doubleval($del_post_time));
$delD=date("d",doubleval($del_post_time));
$del_post2="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delM."/".$delD;
$fp=fopen($del_post2."/$ed_post","w");
fputs($fp, $pex[0]."|".$pex[1]."|".$pex[2]."|".$pex[3]."|".$pex[4]."|".$pex[5]."|".$pex[6]."|\n".$pex[7]."\n".$pex[8]);
fclose($fp);
unset($fp);
$f1="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delM."/".$delD."/"."date.lst";
$tm=file($f1);
$striped=substr(str_replace("[br]", "", $pex[8]),0 , 200);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$ed_post) {$tm[$key]=$del_post_time."|".$delY."|".$delM."|".$delD."|".$ed_post."|".$pex[0]."|".$pex[7]."|".$m[7]."|".$m[8]."|".$m[9]."|".$pex[1]."|".$pex[3]."|".$pex[4]."|".$pex[5]."|".$pex[6]."|".$striped."||\n";}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delM."/".$delD.".lst";
if (filesize($f1)==0) {@unlink("$f1");}
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$ed_post) {$tm[$key]=$del_post_time."|".$delY."|".$delM."|".$delD."|".$ed_post."|".$pex[0]."|".$pex[7]."|".$m[7]."|".$m[8]."|".$m[9]."|".$pex[1]."|".$pex[3]."|".$pex[4]."|".$pex[5]."|".$pex[6]."|".$striped."||\n";}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);
$f1="./classifieds/base".rawurldecode($level)."/"."#".$delY."/".$delY."_".$delM."_".$delD.".lst";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$ed_post) {$tm[$key]=$del_post_time."|".$delY."|".$delM."|".$delD."|".$ed_post."|".$pex[0]."|".$pex[7]."|".$m[7]."|".$m[8]."|".$m[9]."|".$pex[1]."|".$pex[3]."|".$pex[4]."|".$pex[5]."|".$pex[6]."|".$striped."||\n";}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
if (filesize($f1)==0) {@unlink ("$f1");}
unset($fp,$tm,$key,$val,$m1,$f1);

$f1="./classifieds/base".rawurldecode($level)."/last10.txt";
$tm=@file($f1);
while(list($key,$val)=each($tm)) {
$m1=explode("|",$val);
if($m1[4]==$ed_post) {$tm[$key]=$del_post_time."|".$delY."|".$delM."|".$delD."|".$ed_post."|".$pex[0]."|".$pex[7]."|".$m[7]."|".$m[8]."|".$m[9]. "|".$pex[1]."|".$pex[3]."|".$striped."|".$pex[4]."|".$pex[5]."|".$pex[6]."||\n";}
}
$fp=fopen($f1,"w");
fputs($fp,implode("",$tm));
fclose($fp);
unset($fp,$tm,$key,$val,$m1,$f1);

}
}



}}
//$cl_list.="tread=$tread name=$name comment=$cmntsent mesage=$message";
if (($cmntsent=="")&&($topic!="")) {$cmntsent=$topic; $topic="";}

if (@$_SESSION["last_comm"]==md5($cmntsent.$tread.$topic)) {
$flood="<div align=center><br><font color=#b94a48 size=3><b>".$lang[177]."</b></font><br><br><a class=btn href=\"javascript:history.back();\" style=\"height: 30px;\">".$lang['back']."</a><br><br></div><br><br><div class=ocat1><b>$lang[1537]</b></div><div class=ocat1 width=100% style=\"height:200px; overflow: auto;\">$rulez</div>";
}
$rip=getRealIP();
if (($name!="")&&($cmntsent!="")&&($cl_post!="")&&("$valid"=="1")){
$tmp5=explode(".",$rip);
if(is_dir("./admin/bannedip")!=true) { mkdir("./admin/bannedip",0755); }
if(is_dir("./admin/bannedip/temp")!=true) { mkdir("./admin/bannedip/temp",0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()),0755); }
$ipfile="./admin/bannedip/".implode("/",$tmp5)."/banned.txt";
if (file_exists($ipfile)) {
$tmp6=file($ipfile);
$bantime=date("d.m.Y H:i:s", trim($tmp6[0]));
if (time()>=trim($tmp6[0])) {
@unlink($ipfile);
} else {
$banreason=@$lang[trim($tmp6[1])];
$flood="<div align=center class=ocat1><br><font color=#b94a48>$lang[1530]</font><br><br><b>$lang[1501]:</b> $bantime <b>$lang[1514]:</b> $banreason<br><br><a class=btn href=\"javascript:history.back();\" style=\"height: 30px;\">".$lang['back']."</a><br><br></div><br><br><div class=ocat1><b>$lang[1537]</b></div><div class=ocat1 width=100% style=\"height:200px; overflow: auto;\">$rulez</div>";
}
}
}
if ($flood=="") {

//echo "$name<br>$cmntsent<br>$message<br>$cl_post<br>";
if (($name!="")&&($cmntsent!="")&&($cl_post!="")&&("$valid"=="1")){

//save comment
//получаю список комментов всего треда
if ( $enable_cl_comments==1) {
$comfolder=substr(md5($cl_post),0,3);
if(is_dir("$fold/comments")!=true) { mkdir("$fold/comments",0755); }
if(is_dir("$fold/comments/"."$comfolder")!=true) { mkdir("$fold/comments/"."$comfolder",0755); }
if(is_dir("$fold/comments/"."$comfolder"."/"."$cl_post")!=true) { mkdir("$fold/comments/"."$comfolder"."/"."$cl_post",0755); }
$handle=opendir("$fold/comments"."/"."$comfolder"."/"."$cl_post");
$count1=strlen($tread);
//echo "count1=$count1 tread=$tread<br>";
$count2=count(explode(".",$tread));
$maxn=0;
while (($commfile = @readdir($handle))!==FALSE) {
$count3=count(explode(".",$tread));
if ($count1>0) {
//echo "count1>0<br>";
$fl=0;
if (($commfile == '.') || ($commfile == '..')) {
continue;
} else {

//echo ($count3+1)." tred=$tread. substr=".substr($commfile,0,($count1+1))." file=".$commfile." count=".count(explode(".",$commfile))."<br>";
if (("$tread."==substr($commfile,0,($count1+1)))&&(($count3+1)==count(explode(".",$commfile)))) {
//комменты других уровней
$i=doubleval(substr($commfile,($count1+1)));
if ($i>$maxn) {$maxn=substr($commfile,($count1+1));}
//echo "max=".$maxn. " file=" .$commfile."<br>";

}
}
} else {
//echo "<=0 ".strlen($commfile)." $commfile<br>";
if (($commfile == '.') || ($commfile == '..')||(strlen($commfile)!=1)) {
continue;
} else {

//комменты первого уровн€
$i=doubleval($commfile);

if ($i>$maxn) {$maxn=$i;}
//echo $commfile . " $maxn";

}

}
}
@closedir($handle);
//if (($count1==1)&&($maxn<=2)) {$maxn-=1;}
// writing comment $tread.".".($maxn+1);
if ($fl==0) {$wr=$tread.".".($maxn+1);} else {$wr=($maxn+1);}
$commfile="$fold/comments/$comfolder/$cl_post/$wr";
$commfilep=fopen($commfile,"w");
fputs($commfilep,str_replace("\n"," ", strip_tags(trim(trim($topic))))."\n".str_replace("\n"," ",strip_tags(trim(trim($name))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_net))))."|".strip_tags(trim(trim($social_other)))."|".str_replace("\n"," ",strip_tags(trim(trim($social_ava))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_gender))))."|".$details[1]."|".$details[4]."|".$rip."|\n".str_replace("[br]","<br>", strip_tags(trim(trim($cmntsent))))."\n");
fclose ($commfilep);
$commfile="$fold/comments/$comfolder/$cl_post.cnt";
if (file_exists($commfile)==TRUE) {
$commfilep=@fopen($commfile,"r");
$numcom=explode("|",@fread($commfilep,10));
@fclose ($commfilep);
}
$commfilep=fopen($commfile,"w");
$cl_t=time();
fputs($commfilep,(doubleval(@$numcom[0])+1)."|".date("Y",$cl_t)."|".date("m",$cl_t)."|".date("d",$cl_t)."|".date("Y/m/d H:i:s", $cl_t)."|".str_replace("\n"," ",strip_tags(trim(trim($name))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_net))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_other))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_ava))))."|".str_replace("\n"," ",strip_tags(trim(trim($social_gender))))."|".$details[1]."|".$details[4]."|".$rip."|\n");
fclose ($commfilep);
$_SESSION["last_comm"]=md5($cmntsent.$tread.$topic);
unset($cmntsent);
}
}
}

$cl_list.="<script type=\"text/javascript\">
		$(document).ready(function() {
            $(\"a[rel=example_group]\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
        'overlayShow'	:	false,
				'titlePosition' : 'inside',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span><small>".$lang[421]." ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</small></span>';
				}
			});

		});
	</script>";
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {$mmax=3000;}}

function escaper($matches){
        $tmp = preg_replace("/\"/", "%22", $matches[1]);
        return "[a href='"."http://$tmp"."']"."$matches[2]"."[/a]";
 }
function make_url_href($url){
        return preg_replace_callback("|\\[url=http://([^\\]]+?)\\](.+?)\\[/url\\]|s", "escaper", $url);
        // комментарий к регекспу:
        //      группа 1 : ([^\]]+?) - последовательность любых символов кроме ']'
        //      группа 2 : (.+?) - последовательность  любых символов,
        //              квантификатор '+?' - мое обычное решение по уменьшению "жадности" регекспов :)
        // опци€ поиска '|s' - включать и переводы строки в шаблон (.+?)
        // prg_replace_callback - потому что надо бы пофиксить кавычки в первой группе:), поэтому вызываетс€
        //  дл€ каждого совпадени€ ф-€ escaper
 }

function to_html($face,$im) {
global $html;
global $details;
global $valid;
global $lang;
global $dir_smiles;
global $forum_imgwidth;
global $image_path;
global $nc5;
global $nc3;
global $htpath;
$face=trim($face);
$temp="\n".str_replace("script","s c r i p t",str_replace("src","s r c",str_replace("void","v o i d",$face)));
$temp=str_replace("<br>","<br>\n", $temp);
        $temp=preg_replace( "`(( http)+(s)?:(//)|( www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", " [a href='http\\3://\\5\\6\\8\\9']\\5\\6[/a]",$temp);
        $temp=preg_replace( "`((\nhttp)+(s)?:(//)|(\nwww\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "\n[a href='http\\3://\\5\\6\\8\\9']\\5\\6[/a]",$temp);
        //$temp=preg_replace( "`((>http)+(s)?:(//)|(>www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", ">[a href='http\\3://\\5\\6\\8\\9']\\5\\6[/a]",$temp);
        $temp = str_replace("[URL","[url", $temp);
        $temp = str_replace("[/URL]","[/url]", $temp);
        $temp=make_url_href($temp);
        $temp=str_replace("<br>']", "']", $temp);
         $temp=str_replace("/a]\n", "/a]<br>\n", $temp);
        $temp = str_replace("[Q]","[q]", $temp);
        $temp = str_replace("[/Q]","[/q]", $temp);
        $temp = str_replace("[IMG]","[img]", $temp);
        $temp = str_replace("[/IMG]","[/img]", $temp);
        $temp = str_replace("<code>","[code]", $temp);
        $temp = str_replace("</code>","[/code]", $temp);
        $temp = str_replace("[br]","<br>", $temp);
        if ($html=="off") {
        return (strip_tags($face));

        }

 $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[u]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/u]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[u]", "[/u]");
        $repto="<u>".$repst."</u>";
        $temp = str_replace("["."u"."]"."$repst"."["."/u"."]","$repto", $temp);
         $codecounts-=1;
         }}
         $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[i]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/i]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[i]", "[/i]");
        $repto="<i>".$repst."</i>";
        $temp = str_replace("["."i"."]"."$repst"."["."/i"."]","$repto", $temp);
         $codecounts-=1;
         }}

         $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[b]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/b]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[b]", "[/b]");
        $repto="<b>".$repst."</b>";
        $temp = str_replace("["."b"."]"."$repst"."["."/b"."]","$repto", $temp);
         $codecounts-=1;
         }}
         $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[sup]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/sup]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[sup]", "[/sup]");
        $repto="<sup>".$repst."</sup>";
        $temp = str_replace("["."sup"."]"."$repst"."["."/sup"."]","$repto", $temp);
         $codecounts-=1;
         }}

        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[quote=", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/quote]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {

        while ($codecounts>1) {
        $url_link=ExtractString($temp, "[quote=", "]");

        $url_text=ExtractString($temp,"[quote=".$url_link."]","[/quote]");
        $url_link2=$url_link;
        $temp = str_replace("[quote=".$url_link."]".$url_text."[/quote]","<div class=round2 style=\"margin:3px\"><b>".$url_link2.":</b> <font color=\"#000099\">".$url_text."</font></div>", $temp);
        $codecounts-=1;
        }}

        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[q]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/q]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[q]", "[/q]");
        $repto="<div class=round2 style=\"margin:3px\"><font color=\"#000099\">".$repst."</font></div>";
        $temp = str_replace("["."q"."]"."$repst"."["."/q"."]","$repto", $temp);
         $codecounts-=1;
         }}
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[img]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/img]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[img]", "[/img]");
        $img = @getimagesize($repst);

        if (doubleval($img[0])==0) {
        if ($im==1) {
        $repto="<img src=".$repst." border=0 width=36 height=36 class=img>";
        } else {
        $repto="<a rel=forum_group href=$repst><img src=".$repst." border=0 width=250 height=250 class=img></a>";
        }
        } else {
        $iheight=round($forum_imgwidth*$img[1]/$img[0]);
        if ($img[1]<=$forum_imgwidth) {
        if ($im==1) {
        $repto="<img src=".$repst." title=\"$img[0]x$img[1]\" width=36 height=36 class=img>";
        } else {
        $repto="<img src=".$repst." title=\"$img[0]x$img[1]\" width=250 height=250 class=img hspace=10 vspace=10>";
        }

        } else {
        if ($im==1) {
        $repto="<img src=".$repst." width=36 height=36 border=0 title=\"".$lang[139]." $img[0]x$img[1]\" align=left class=img style=\"margin: 2px 10px 2px 2px;\">";
        } else {
        $k=1;

        if ($img[0]>250) {
        $k=round($img[0]/250,6);
        }
        $repto="<a rel=forum_group href=$repst><img src=".$repst." width=".ceil($img[0]/$k)." height=".ceil($img[1]/$k)." border=0 title=\"".$lang[139]." $img[0]x$img[1]\" align=left class=img style=\"margin: 2px 10px 2px 2px;\"></a>";

        }
        }
        }
        //$repto="<img src=".$repst." class=thumb border=0>";

        $temp = str_replace("["."img"."]"."$repst"."["."/img"."]","$repto", $temp);
         $codecounts-=1;
         }}
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[a href='", $temp));

        $codecounts2=count(explode("[/a]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {

        while ($codecounts>1) {

        $url_link=ExtractString($temp, "[a href='", "']");

        //$url_text=ExtractString($temp,"[a href='".$url_link."']","[/a]");
        $url_text = strtoken(str_replace("[a href='".$url_link."']","", str_replace(strtoken ($temp, "[a href='".$url_link."']"),"",$temp)),"[/a]");
        $url_link2=$url_link;
        if (preg_match("/\(/i",$url_link)){ $url_link2=str_replace("(","{",str_replace(")","}",$url_link));} else {

        if (substr($url_link,0,7)!="mailto:") {
        if (substr($url_link,0,6)!="ftp://") {
        if (substr($url_link,0,7)!="http://") {
        $url_link2="http://".$url_link;
        }}}
        }


        $searchh=strtoken(str_replace("http://","",str_replace("www.","",str_replace("ftp://","",$htpath))),"/");
        if (!preg_match("/$searchh/i",$url_link2)) {
        $temp = str_replace("[a href='".$url_link."']".$url_text."[/a]","<a href='go.php?".strrev($url_link2)."' target=_blank><font color=$nc3>".$url_text."</font></a>", $temp);
        } else {
        $temp = str_replace("[a href='".$url_link."']".$url_text."[/a]","<a href='".$url_link2."'><font color=$nc3>".$url_text."</font></a>", $temp);

        }
        $codecounts-=1;
        }}
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[code]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/code]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[code]", "[/code]");
        $repto="<div class=round2 style=\"margin:10px\"><font color=\"#000099\">".$repst."</font></div>";
        if ((substr($repst,0,5)=="&lt;?")&&(substr($repst,-5)=="?&gt;")) {$repto="<div class=round2 style=\"margin:3px\">".highlight_string(str_replace("<br>","\n",str_replace("&lt;","<",str_replace("&gt;",">",$repst))),true)."</div>";}
         $temp = str_replace("["."code"."]"."$repst"."["."/code"."]","$repto", $temp);
         $codecounts-=1;
         }}
        reset ($dir_smiles);
        while (list($skey,$sval)=each($dir_smiles)) {
        $temp = str_replace("$sval","<img src=smileys/".$skey." border=0>", $temp);
        }
        $temp = str_replace(" :)","<img src=smileys/smile.png border=0>", $temp);
        $temp = str_replace(" ;)","<img src=smileys/wink.png border=0>", $temp);
        $temp = str_replace(" :d","<img src=smileys/laugh.png border=0>", $temp);
        $temp = str_replace(" :s","<img src=smileys/doubt.png border=0>", $temp);
        $temp = str_replace(" (h)","<img src=smileys/hot.png border=0>", $temp);
        $temp = str_replace(" :'(","<img src=smileys/tears.png border=0>", $temp);
        $temp = str_replace(" :@","<img src=smileys/angry.png border=0>", $temp);
        $temp = str_replace(" (a)","<img src=smileys/angel.png border=0>", $temp);
        $temp = str_replace(" :$","<img src=smileys/bloss.png border=0>", $temp);
        $temp = str_replace(" :p","<img src=smileys/tongue.png border=0>", $temp);
        $temp = str_replace(" (b )","<img src=smileys/beer.png border=0>", $temp);

        return $temp;
}

//$url=им€ хоста, куда будем заходить

function load_page($url){

$cookies=array();

// им€ хоста, откуда €кобы пришли, некоторые провер€ют

$ref="google.com";

// инициализаци€ cURL

$ch = curl_init($url);

//Ц откуда пришли )

curl_setopt($ch, CURLOPT_REFERER, $ref);

// чтобы выводил заголовки

curl_setopt ($ch, CURLOPT_HEADER, 1);

// чтобы не выводил саму страницу (она не нужна)

curl_setopt ($ch, CURLOPT_NOBODY, 1);

// если ведетс€ проверка HTTP User-agent, то передаем один из возможных допустимых вариантов:

curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; ru; rv:1.9.0.8) Gecko/2009032609 Firefox/3.0.8");

// если провер€тс€ откуда пришел пользователь, то указываем допустимый заголовок HTTP Referer:

curl_setopt ($ch, CURLOPT_REFERER, "http://".$ref."/");

// возвращать результат работы

curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

// не провер€ть SSL сертификат

curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);

// не провер€ть Host SSL сертификата

curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);

// это необходимо, чтобы cURL не высылал заголовок на ожидание

curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Expect:"));

// выполнить запрос

curl_exec ($ch);

$t=curl_multi_getcontent ($ch);

curl_close ($ch);

// получил массив всех заголовков от сервера

$headers = explode("\n", $t);

return $headers;

}


function to_img($temp) {
global $html;
if ($html=="off") { return false; }
global $details;
global $valid;
global $use_curl;
global $new_w;
global $new_h;
global $maximg_size;
global $new_w2;
global $new_h2;
global $htpath;
global $cl_post;
$temp=trim($temp);
        $codecounts=1;
        $codecounts2=1;
        $codecounts=count(explode("[img]", $temp));
//        echo $codecounts;
        $codecounts2=count(explode("[/img]", $temp));
        if (($codecounts>1)&&($codecounts==$codecounts2)) {
        while ($codecounts>1) {
        $repst=ExtractString($temp, "[img]", "[/img]");
        $returned[0]="";
        $returned[1]="";

$ftype="jpg";
$headers=get_headers($repst);
while (list($key,$val)=each($headers)){
if (substr($val,0,14)=="Content-Type: ") {
$sys=str_replace("Content-Type: ", "", trim($val));
if ($sys=="image/png") {$ftype="png";}
if ($sys=="image/gif") {$ftype="gif";}
if ($sys=="image/jpg") {$ftype="jpg";}
if ($sys=="image/jpeg") {$ftype="jpg";}
}
}
if ($use_curl==1) {
$req = $repst;
$ch = curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$img = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$img=file_get_contents($repst);
}
$md=md5("$repst");
//$sys=strtolower(substr($repst,-3));
//if (($sys!="gif")&&($sys!="jpg")&&($sys!="png")) {$sys="jpg";}
if (($img!="")&&(strlen($img)<$maximg_size)) {
$dir1=date("Y",time());
$dir2=substr($md,0,3);
//$cl_list.= "OK. Lets writing classifieds #$cl_file ...<br><br>";
if(is_dir("./thumb")!=true) { mkdir("./thumb",0755); }
if(is_dir("./thumb/"."$dir1")!=true) { mkdir("./thumb/"."$dir1",0755); }
if(is_dir("./thumb/"."$dir1/$dir2")!=true) { mkdir("./thumb/"."$dir1/$dir2",0755); }
$ifp=fopen("./thumb/"."$dir1/$dir2/".$md."."."$ftype","w");
fputs($ifp, $img);
fclose($ifp);

$name="./thumb/"."$dir1/$dir2/".$md."."."$ftype";
$filename="./thumb/"."$dir1/$dir2/tn_".$md."."."$ftype";
if ($ftype=="jpg"){$src_img=imagecreatefromjpeg($name);}
    if ($ftype=="gif"){$src_img=imagecreatefromgif($name);}
	if ($ftype=="png"){$src_img=imagecreatefrompng($name);}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$old_y*($new_h/$old_x);
	}
	if ($old_x < $old_y)
	{
		$thumb_w=$old_x*($new_w/$old_y);
		$thumb_h=$new_h;
	}
	if ($old_x == $old_y)
	{
		$thumb_w=$new_w;
		$thumb_h=$new_h;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
	if ($ftype=="png")
	{
		imagepng($dst_img,$filename);
	}
    if ($ftype=="gif")
	{
		imagegif($dst_img,$filename);
        }
    if ($ftype=="jpg")
	{
		imagejpeg($dst_img,$filename);
	}
	imagedestroy($dst_img);
	imagedestroy($src_img);


$name="./thumb/"."$dir1/$dir2/".$md."."."$ftype";
$filename="./thumb/"."$dir1/$dir2/dl_".$md."."."$ftype";
if ($ftype=="jpg"){$src_img=imagecreatefromjpeg($name);}
    if ($ftype=="gif"){$src_img=imagecreatefromgif($name);}
	if ($ftype=="png"){$src_img=imagecreatefrompng($name);}
	$old_x=imageSX($src_img);
	$old_y=imageSY($src_img);
	if ($old_x > $old_y)
	{
		$thumb_w=$new_w2;
		$thumb_h=$old_y*($new_h2/$old_x);
	}
	if ($old_x < $old_y)
	{
		$thumb_w=$old_x*($new_w2/$old_y);
		$thumb_h=$new_h2;
	}
	if ($old_x == $old_y)
	{
		$thumb_w=$new_w2;
		$thumb_h=$new_h2;
	}
	$dst_img=ImageCreateTrueColor($thumb_w,$thumb_h);
	imagecopyresampled($dst_img,$src_img,0,0,0,0,$thumb_w,$thumb_h,$old_x,$old_y);
	if ($ftype=="png")
	{
		imagepng($dst_img,$filename);
	}
    if ($ftype=="gif")
	{
		imagegif($dst_img,$filename);
        }
    if ($ftype=="jpg")
	{
		imagejpeg($dst_img,$filename);
	}
	imagedestroy($dst_img);
	imagedestroy($src_img);
unlink ($name);
$returned[0]="$htpath/thumb/"."$dir1/$dir2/dl_".$md."."."$ftype";
$returned[1]="$htpath/thumb/"."$dir1/$dir2/tn_".$md."."."$ftype";
} else {
//$returned[0]="$htpath/thumb/"."$dir1/$dir2/".$md."."."$ftype";
$returned[0]="";
$returned[1]="";
}
return $returned;
$codecounts-=1;

}
}
}


$form="";
$years_back=2;
if ($action=="cl_add") {
$rip=getRealIP();
if ($cl_send!=1) {
$cl_list.= "<h1>".$lang[942]."</h1>";
$cl_list.= "<div id=\"jscl\"></div><script language=javascript>
<!--

function choosecl() {
var scriptNode = document.createElement('script');
document.getElementsByTagName('head')[0].appendChild(scriptNode);
scriptNode.language='javascript';
scriptNode.src = '$htpath/classifieds/cl_ajax.php?speek=$speek';
scriptNode.type = 'text/javascript';

}
function choosen(value) {
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/classifieds/cl_ajax.php?speek=$speek'+ '&level=' + value +'&uniq='+ new Date().getTime();
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
choosecl();
-->
</script>";
} else {
$proceed=0;
if ("$valid"=="1") {$proceed=1;} else { $proceed=0; }
if ($cat_only_for_registered==0) { $proceed=1; }
if ((session_id()!="")&&($proceed==1)) {

$arr2=array ("cl_description","cl_price","clfile","rip","level","cl_post","cl_city", "cl_title", "name", "cl_email", "tread", "exp","social_net", "social_other", "social_gender", "social_ava");
while (list ($line_num, $a) = each ($arr2)) {
$$a = strip_tags(@$$a);
$$a = str_replace("|" , "", @$$a);
$$a = str_replace("<" , "&lt;", @$$a);
$$a = str_replace(">" , "&gt;", @$$a);
$$a = substr(@$$a, 0, $mmax);
//$$a = wordwrap($$a, 200, " " , 1);
$$a = str_replace(chr(92) , "", @$$a); // strip backslash
$$a = str_replace("^" , "", @$$a);
$$a = str_replace("\n" , " [br]", @$$a);
$$a = str_replace("\r" , " [br]", @$$a);
$$a = str_replace(" [br] [br]" , " [br]", @$$a);
//$$a = str_replace(chr(13) , "", $$a);
//$$a = str_replace(chr(27) , "", $$a);
$$a = trim(@$$a);
if(get_magic_quotes_gpc()) { $$a = stripslashes(@$$a);}
$$a= badwords(@$$a);
}

if (@$_SESSION["last_comm"]==md5($cl_title)) {
$flood="<div align=center><br><font color=#b94a48 size=3><b>".$lang[1500]."</b></font><br><br><a class=btn href=\"javascript:history.back();\" style=\"height: 30px;\">".$lang['back']."</a><br><br></div><br><br><div class=ocat1><b>$lang[1537]</b></div><div class=ocat1 width=100% style=\"height:200px; overflow: auto;\">$rulez</div>";
}
$tmp5=explode(".",$rip);
if(is_dir("./admin/bannedip")!=true) { mkdir("./admin/bannedip",0755); }
if(is_dir("./admin/bannedip/temp")!=true) { mkdir("./admin/bannedip/temp",0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()),0755); }
$ipfile="./admin/bannedip/".implode("/",$tmp5)."/banned.txt";
if (file_exists($ipfile)) {
$tmp6=file($ipfile);
$bantime=date("d.m.Y H:i:s", trim($tmp6[0]));
if (time()>=trim($tmp6[0])) {
@unlink($ipfile);
} else {
$banreason=@$lang[trim($tmp6[1])];
$flood="<div align=center class=ocat1><br><font color=#b94a48>$lang[1530]</font><br><br><b>$lang[1501]:</b> $bantime <b>$lang[1514]:</b> $banreason<br><br><a class=btn href=\"javascript:history.back();\" style=\"height: 30px;\">".$lang['back']."</a><br><br></div><br><br><div class=ocat1><b>$lang[1537]</b></div><div class=ocat1 width=100% style=\"height:200px; overflow: auto;\">$rulez</div>";
}
}

if (($cl_title!="")&&($cl_description!="")&&($cl_city!="")&&($cl_email!="")&&($cl_price!="")&&($clfile!="")) {
$tmpfileip="./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time())."/". doubleval(@preg_replace("([\D]+)", "", $rip)).".txt";
if ($flood=="") {
if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")||(@$details[7]=="VIP")||(substr(@$details[7],0,3)=="OPT")||(substr(@$details[7],0,3)=="CAT")||(substr(@$details[7],0,2)=="HR")) { } else {
if (!file_exists($tmpfileip)) {
$tfp=fopen($tmpfileip,"w");
fputs($tfp, 1);
fclose($tfp);
unset($tfp);
} else {

$tfp=fopen($tmpfileip,"r");
$tmpipq=doubleval(trim(fread($tfp,1024)));
fclose($tfp);

unset($tfp);
if ($tmpipq>=doubleval($lang[1536])) {
$flood= "<div align=center><br><font color=#b94a48>$lang[1534]</font><br><br><b>$lang[1535]:</b> $lang[1536] <br><br><br><a class=btn href=\"javascript:history.back();\" style=\"height: 30px;\">".$lang['back']."</a><br><br></div><br><br><div class=ocat1><b>$lang[1537]</b></div><div class=ocat1 width=100% style=\"height:200px; overflow: auto;\">$rulez</div>";
} else {
$tfp=fopen($tmpfileip,"w");
fputs($tfp,($tmpipq+1));
fclose($tfp);
unset($tfp);
}
}
}
}
if ($flood==""){
$cl_dir="./classifieds/base$clfile";
if ((is_dir("$cl_dir"))&&(file_exists("$cl_dir/write.txt")==true)) {
$_SESSION["last_comm"]=md5($cl_title);
$cl_time=time();
$cl_file=$cl_time.substr(str_replace("0.","",str_replace("0,","", strtoken(microtime()," "))),0,3);
$dir1=date("Y",$cl_time);
$dir2=date("m",$cl_time);
$dir3=date("d",$cl_time);
//$cl_list.= "OK. Lets writing classifieds #$cl_file ...<br><br>";
if(is_dir("$cl_dir/#"."$dir1")!=true) { mkdir("$cl_dir/#"."$dir1",0755); }
if(is_dir("$cl_dir/#"."$dir1/$dir2")!=true) { mkdir("$cl_dir/#"."$dir1/$dir2",0755); }
if(is_dir("$cl_dir/#"."$dir1/$dir2/$dir3")!=true) { mkdir("$cl_dir/#"."$dir1/$dir2/$dir3",0755); }
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir2/$dir3/".$cl_file, "w");
fputs ($cl_fp, "$cl_title|$details[1]|$details[3]|$details[4]|$cl_city|$cl_email|".$rip."|\n$cl_price\n$cl_description");
fclose ($cl_fp);
$pic="";

$cl_img=Array();
if ($html=="off") {
$cl_img[0]="";
$cl_img[1]="";
} else {
$cl_img=to_img($cl_description);
if ($cl_img[0]!="") {$pic="1";}
}
$striped=strip_tags($cl_description);
if (strlen($striped)>200) {$striped.="...";}
$striped=substr($striped,0,200);
$striped=str_replace("\r", " ",str_replace("\n", " ",$striped));
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir2/$dir3/date.lst", "a");
fputs ($cl_fp, "$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|$cl_city|$cl_email|".$rip."|".$striped."||\n");
fclose ($cl_fp);
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir2/$dir3.lst", "a");
fputs ($cl_fp, "$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|$cl_city|$cl_email|".$rip."|".$striped."||\n");
fclose ($cl_fp);
$cl_fp=fopen("$cl_dir/#"."$dir1/$dir1"."_"."$dir2"."_"."$dir3.lst", "a");
fputs ($cl_fp, "$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|$cl_city|$cl_email|".$rip."|".$striped."||\n");
fclose ($cl_fp);
$cltm="";
if (file_exists("$cl_dir/last10.txt")) {
$cl_fpt=file("$cl_dir/last10.txt");
$z=0;
reset ($cl_fpt);
while(list($tmp1key,$tmp2val)=each($cl_fpt)) {
if ($z<=($cl_perpage-1)) {
if ($z>0) {
$cltm.="$tmp2val";
} else {
if (count($cl_fpt)<$cl_perpage) {
$cltm.="$tmp2val";
}
}
}
$z++;
}
}
$cl_fp=fopen("$cl_dir/last10.txt", "w");
fputs ($cl_fp, $cltm."$cl_time|$dir1|$dir2|$dir3|$cl_file|$cl_title|$cl_price|$pic|$cl_img[0]|$cl_img[1]|".$details[1]."|".$details[4]."|".$striped."|$cl_city|$cl_email|".$rip."|\n");
fclose ($cl_fp);
unset($cltm,$cl_fpt,$tmp1key,$tmp2val);
$cl_list.= "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"1;URL=$htpath/index.php?action=cl&level=".rawurlencode($clfile)."&cl_post=$cl_file\"><br><br>
$lang[946] <b><a href=$htpath/index.php?action=cl&level=".rawurlencode($clfile)."&cl_post=$cl_file>$lang[947]</a></b>";
} else {
$cl_list="<div><font color=#b94a48>$lang[42]. $lang[943]</font></div>";
}
} else {
$cl_list="$flood";
}
} else {
$cl_list="<div><font color=#b94a48>$lang[42]. $lang[944]</font></div>";
}
} else {
$cl_list="<div><font color=#b94a48>$lang[49] $lang[50]</font></div>";
}
}
} else {

if (@is_dir("$fold/base$level")) {
if ((isset($cl_post))&&($cl_post!="")) {
$cl_post_time=substr("".$cl_post,0,(strlen("".$cl_post)-3));
$cl_post2=date("Y/m/d",doubleval($cl_post_time));
$cl_post_time=date("d/m/Y H:i:s",doubleval($cl_post_time));
$postfile="$fold/base$level/#".$cl_post2."/$cl_post";
if (file_exists($postfile)==true) {
$cl_cont=file($postfile);
$utit=strtoken($cl_cont[0], "|");
unset ($tmpex);
$tmpex=explode("|",$cl_cont[0]);
$ucity=@$tmpex[4];
$adm_del="";
$adm_edit="";
$adm_ip="";
$ip="";
$ftitle="";
$fcolor="$nc3";
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {
$ip=strtoken(@$tmpex[6]," ");
if (trim($ip)!="") {
$tmp3=explode(".",$ip);
$ftitle="";
if(is_dir("./admin/bannedip")!=true) { mkdir("./admin/bannedip",0755); }
if(is_dir("./admin/bannedip/temp")!=true) { mkdir("./admin/bannedip/temp",0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()),0755); }
$ipfile="./admin/bannedip/".implode("/",$tmp3)."/banned.txt";
if (file_exists($ipfile)) { $fcolor="red"; $ftitle=" title=\"$lang[1525]\"";}

$adm_ip="<td width=90 valign=top align=right title=\"".$lang['addition']."\"><img src=$image_path/pix.gif width=90 height=1><br><a href=\"#Whois\" onclick=\"javascript:window.open('$htpath/whois.php?t=".md5("$ip"."$htpath"."$secret_salt")."&t2=".md5("$ip"."$htpath"."$secret_salt".$tmpex[5])."&ip=".rawurlencode($ip)."&n=".rawurlencode($tmpex[5])."','".md5("$ip"."$htpath"."$secret_salt")."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=560,left=10,top=10')\"><font color=$fcolor size=1"."$ftitle>".$ip."</font></a></td><td>&nbsp;&nbsp;</td>";
}
$adm_del="<td width=30 valign=top align=right title=\"".$lang[744]."\"><img src=$image_path/pix.gif width=30 height=1><br><a class=btn href=\"$htpath/index.php?action=cl&amp;start=$start&level=".rawurlencode($level)."&del_post=".$cl_post."\"><font color=#b94a48>X</font></a></td>";
$adm_edit="<td width=30 valign=top align=center title=\"".$lang[744]."\"><img src=$image_path/pix.gif width=30 height=1><br><a class=btn href=\"$htpath/index.php?action=cl&amp;start=$start&level=".rawurlencode($level)."&ed_post=".$cl_post."&cl_post=".$cl_post."\"><font color=#468847>".$lang['edits']."</font></a></td><td>&nbsp;&nbsp;</td>";

}
}
$cl_list.="<div class=ocat1 align=left style=\"cursor:pointer; cursor:hand;\" onclick=\"document.location.href='$htpath/index.php?action=cl&level=".rawurlencode($level)."';\">
<a href=\"$htpath/index.php?action=cl&level=".rawurlencode($level)."\"><img src=$image_path/ofb.png border=0 align=absmiddle><font color=$nc3>".$lang['back']."</font></a></div>
<div class=ocat1 style=\"padding: 20px 20px 20px 20px;\">
<table border=0 width=100% cellspacing=0 cellpadding=0><tr>
<td calign=top>
<h4><font color=$nc3>$lang[1499] #$cl_post</font></h4>
</td>
<td align=right valign=top>
$cl_post_time
</td>$adm_ip"."$adm_edit"."$adm_del</tr>
</table>
<h1><font color=$nc10>".wordwrap($ucity, 33, "\n", true)."</font> ".wordwrap($utit, 33, "\n", true)." - ".wordwrap($cl_cont[1], 33, "\n", true)."</h1>$rulezbutton"."<br>";


$uusr=@$tmpex[1];
$umail=@$tmpex[3];
$uprice=$cl_cont[1];
unset ($cl_cont[0],$cl_cont[1]);
$cl_list.=str_replace("[br]", "<br>", str_replace("\r", "<br>",wordwrap(str_replace("\n", "\r",to_html(implode(" <br>",  $cl_cont),0)), 100, "\n", true)));
if (!preg_match("/\@/i",@$tmpex[5])) {

if (@$tmpex[5]!="") {
$utel=" <img src=$image_path/phone.png align=absmiddle><noindex>".wordwrap(@$tmpex[5], 33, "\n", true)."</noindex>";
} else {
$utel="";
}
if (preg_match("/\@/i",@$tmpex[3])) {
$tmpe=$tmpex[3];
preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $tmpex[3], $matches);
if (@$matches[0][0]!="") {$tmpe=@implode(",",@$matches[0]); }
if ($uusr=="") { $uusr=strtoken($tmpex[5],"@"); }
$uusr= "$lang[363]: <i class=icon-user></i><a href=\"#mail\" onclick=\"mto(this, '".strrev(str_replace("\r", "", str_replace("\n", "", "mailto:".$tmpe."?subject=#$cl_post / ".str_replace("_"," ", translit($utit)." - ". translit($uprice)))))."');\">$uusr</a>";
} else {
if ($uusr=="") { $uusr="$lang[363]: <i class=icon-user></i>$lang[193]"; }
}
} else {
$tmpe=$tmpex[5];
preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $tmpex[5], $matches);
if (@$matches[0][0]!="") {$tmpe=@implode(",",@$matches[0]); }
if ($uusr=="") { $uusr=strtoken($tmpex[5],"@"); }
$uusr= "$lang[363]: <i class=icon-user></i><a href=\"#mail\" onclick=\"mto(this, '".strrev(str_replace("\r", "", str_replace("\n", "", "mailto:".$tmpe."?subject=#$cl_post / ".str_replace("_"," ", translit($utit)." - ". translit($uprice)))))."');\">$uusr</a>"; $utel="";

}
if ($valid=="1") {
$cl_list.="<br><br>$uusr <i>$utel</i><br>";
 } else {
$cl_list.="<br><br>$uusr <i>$utel</i><br>";
}
$cl_list.="<div class=clear></div></div><div>";
if ($ed_post!="") {
if ("$valid"=="1") {if (($details[7]=="ADMIN")||($details[8]=="MODER")) {
$admform="";
$cl_list.="<br><br><div class=ocat1><div align=center class=round><h4>".$lang['edits']."</h4></div><form class=form-inline action=index.php method=POST id=\"admform\" id=\"cl_form\">
<input type=hidden name=action value=cl>
<input type=hidden name=level value='".rawurldecode($level)."'>
<input type=hidden name=ed_post value='$cl_post'>
<input type=hidden name=cl_post value='$cl_post'>
<input type=hidden name=start value=$start>
<input type=hidden name=wr_post value=1>
<table border=0 width=100% cellpadding=5 cellspacing=5>
<tr><td align=right><b><nobr>$lang[949]*:</nobr></b></td><td width=80%><input type=text name=pex[0] id=cl_title value='".$tmpex[0]."' size=20 style='width:100%' maxlength=\"200\"></td></tr>
<tr><td align=right><b><nobr>".$lang[76].":</nobr></b></td><td width=80%><input type=text name=pex[1] value='".$tmpex[1]."' size=20 style='width:100%' maxlength=\"200\"></td></tr>
<tr><td align=right><b><nobr>".$lang[75].":</nobr></b></td><td width=80%><input type=text name=pex[2] value='".$tmpex[2]."' size=20 style='width:100%' maxlength=\"200\"></td></tr>
<tr><td align=right><b><nobr>$lang[645]</nobr></b></td><td width=80%><input type=text name=pex[3] value='".$tmpex[3]."' size=20 style='width:100%' maxlength=\"200\"></td></tr>
<tr><td align=right><b><nobr>IP:</nobr></b></td><td width=80%><input type=text name=pex[6] value='".$tmpex[6]."' size=20 style='width:100%' maxlength=\"200\"></td></tr>

<tr><td align=right><b><nobr>$lang[72]*:</nobr></b></td><td width=80%><input type=text name=pex[4] id=cl_city value='".$tmpex[4]."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td align=right><b><nobr>$lang[1498]*:</nobr></b></td><td width=80%><input type=text name=pex[5] id=cl_email value='".$tmpex[5]."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td valign=top align=right><b><nobr>$lang[950]*:</nobr></b></td><td><textarea name=pex[8] cols=20 rows=10 maxlength=$mmax style=\"width:100%\" id=\"textarea\">".str_replace("[br]", "\n",str_replace(" [br]", "\n", implode("[br]",  $cl_cont)))."</textarea></td></tr>
<tr><td align=right><b><nobr>$lang[951]*:</nobr></b></td><td><input type=text name=pex[7] id=cl_price value='".$uprice."' size=20 maxlength=\"100\"></td></tr>
<tr><td colspan=2 align=center><br><a onclick=\"document.getElementById('admform').submit();\" class=ocat1 style=\"padding: 10px; height: 35px; cursor:pointer; cursor:hand;\"><font color=#468847>V&nbsp;&nbsp;</font><font color=$nc5>".$lang['ch']."</font></a></td></tr>
</table></form></div>";
}
}
}

//комменты
$comfolder=substr(md5($cl_post),0,3);
$cf="$fold/comments/$comfolder/$cl_post.cnt";
$cmnts=$lang[920];
$com[0]=0;
if (file_exists($cf)){
$clfilep=@fopen($cf,"r");
$com=explode("|",@fread($clfilep,@filesize($cf)));
fclose ($clfilep);
}
$social_ico="";
$social_user="";

//show comments
$cmnts="";
if (($enable_cl_comments==1)&&(@$cl_count[10]!="NO")) {

if ($com[0]>0) {

$cmntsents=Array();
$handle=opendir("$fold/comments/$comfolder/$cl_post");
while (($cls_file = @readdir($handle))!==FALSE) {
if (($cls_file == '.') || ($cls_file == '..')) {
continue;
} else {

$cmntsents[$cls_file]=file("$fold/comments/$comfolder/$cl_post/".$cls_file);
$dates[$cls_file]=filemtime("$fold/comments/$comfolder/$cl_post/".$cls_file);
}
}
@closedir($handle);
ksort($cmntsents);
reset($cmntsents);

while(list($key,$val)=each($cmntsents)) {
$q=explode(".",$key);
$quotes=(10*(count($q)-1))+1;
$color=lighter("#".substr(md5("$htpath.$quotes"),0,6),80);
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if ("$valid"=="1"){
$cls__delc="  &nbsp;  &nbsp;  <a href=\"index.php?action=cl&level=".rawurlencode($level)."&cl_post=$cl_post&exp=$exp&cl_delcom=$key#comment_$message/$key\"><font color=#b94a48>X</font> ".$lang[744]."</a>";
}
}
if ((trim($val[0])=="")&&(trim($val[1])=="")&&(trim($val[2])=="")) {$cmnts.="<a name=\"comment_$message/$key\"></a>";} else {

if ("$valid"=="1") {$cls_reply="<a href=\"#reply\" onclick=\"javascript:document.getElementById('s_$key').style.display='none';document.getElementById('s_$key').style.visibility='hidden';document.getElementById('dd_$key').style.display='';document.getElementById('dd_$key').style.visibility='visible';\">";
$cls_reply2="</a>";
$blreply="<a href=\"#reply\" onclick=\"javascript:document.getElementById('s_$key').style.display='';document.getElementById('s_$key').style.visibility='visible';document.getElementById('dd_$key').style.display='none';document.getElementById('dd_$key').style.visibility='hidden';\">";
$blreply2="</a> [+]";
} else {
$cls_reply="";
$cls_reply2="";
$blreply="";
$blreply2="";
}
if (trim($val[0])=="") {if (strlen(trim($val[2])<40)) { $val[0]=str_replace("<br>", " ", $val[2]); $cls_reply2.=" "; $blreply2="</a>";  $val[2]="";} else {$val[0]=substr(str_replace("<br>", " ",$val[2]),0,40)."... [+]"; }} else {
$val[2]="<br>".$val[2]."<br>"; }
$comments_found+=1;
$tmp=explode("|",$val[1]);
$val[1]=$tmp[0];
$social_ico=""; $social_link1="";$social_link2="";
if ((@$tmp[1]=="facebook")&&($tmp[2]!="")){$social_ico="<img src=$fold/fb.png align=absmiddle> "; $social_link1="<a href=\"http://www.facebook.com/profile.php?id=".trim($tmp[2])."\">";$social_link2="</a>";} else {$social_link1="";$social_link2="";}
if ((@$tmp[1]=="twitter")&&($tmp[2]!="")){$social_ico="<img src=$fold/twit.png align=absmiddle> "; $social_link1="<a href=\"http://twitter.com/#!/".trim($tmp[2])."\">";$social_link2="</a>";}
if ((@$tmp[1]=="vkontakte")&&($tmp[2]!="")){$social_ico="<img src=$fold/vk.png align=absmiddle> "; $social_link1="<a href=\"http://vk.com/id".trim($tmp[2])."\">";$social_link2="</a>";}

if ((trim(@$tmp[3])!="")){$social_ava="<div style=\"float:left; margin-right:10px; margin-bottom:5px;\">$social_link1<img src=\"gallery/avatars/".trim($tmp[3])."\" border=0 width=25 height=25>$social_link2</div>";} else {$social_ava="";}
if ((trim(@$tmp[1])=="")){$social_user="<i class=icon-user></i>";} else {$social_user="";}

if (($exp=="")&&($quotes>1)) {
$cmnts.="<a name=\"comment_$message/$key\"></a><div style=\"overflow: hidden; width:100%\"><table border=0 width=100%><tr><td><img src=$image_path/pix.gif height=10 width=$quotes></td><td width=100%>
<div id=\"dd_$key\">$social_ava"."$blreply".trim(trim($val[0]))."$blreply2 &nbsp; $social_ico$social_user<b>".$social_link1."$val[1]".$social_link2."</b>$cls__delc</div>
<div id=\"s_$key\" style=\"display:none; vilibility:hidden\">
<div class=cat2 style=\"float:left; overflow: hidden; width:97%; border: 1px solid $color; background: ".lighter($color,100).";\">"."$social_ava".""."<div class=cat2 style=\"float:right; width:160px; background: $color;\" align=center>".date("Y/m/d H:i:s" , $dates[$key])."</div><div>$cls_reply<b><font size=3>".trim(trim($val[0]))."</font></b>$cls_reply2 &nbsp; $social_ico$social_user <b>".$social_link1."$val[1]".$social_link2."</b><br>$val[2]
<br><div id=\"d_$key\">";
if ("$valid"=="1") {$cmnts.="<a href=\"#reply\" onclick=\"javascript:document.getElementById('$key').style.display='';document.getElementById('$key').style.visibility='visible';document.getElementById('d_$key').style.display='none';document.getElementById('d_$key').style.visibility='hidden';\">$lang[806]</a>";
}
$cmnts.="$cls__delc<div style=\"float:right; width:180px;\" align=center><font class=small><a href=\"#comment_$message/$key\">URL</a></font></div></div>
<div id=\"$key\" style=\"display:none; vilibility:hidden\">
";
if ("$valid"=="1") {$cmnts.="<br><form method=POST action=index.php id=\"f_$key\">
<input type=hidden name=level value=\"$level\">
<input type=hidden name=tread value=\"$key\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=action value=\"cl\">
<input type=hidden name=cl_post value=\"$cl_post\">
<input type=hidden name=social_net value=\"".@$psocial_net."\">
<input type=hidden name=social_other value=\"".@$psocial_other."\">
<input type=hidden name=social_gender value=\"".@$psocial_gender."\">
<input type=hidden name=social_ava value=\"".@$psocial_ava."\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"100\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"100\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:100%\" maxlength=\"3000\"></textarea>
<a class=ocat1 onclick=\"javascript:document.getElementById('$key').style.display='none';document.getElementById('$key').style.visibility='hidden';document.getElementById('d_$key').style.display='';document.getElementById('d_$key').style.visibility='visible';\" style=\"height: 30px; cursor:pointer; cursor:hand;\">$lang[386]</a> &nbsp; <a class=ocat1 style=\"height: 30px; cursor:pointer; cursor:hand;\" onclick=\"document.getElementById('f_$key').submit();\">$lang[806]</a><br><br></form></div>
</div></div></div>
";
}
$cmnts.="</td></tr></table></div>";
} else {
$cmnts.="<a name=\"comment_$message/$key\"></a><div style=\"overflow: hidden; width:100%\"><table border=0 width=100%><tr><td><img src=$image_path/pix.gif height=10 width=$quotes></td><td width=100%><div class=cat2 style=\"float:left; overflow: hidden; width:97%; border: 1px solid $color; background: ".lighter($color,100).";\">
"."$social_ava"."<div class=cat2 style=\"float:right; width:160px; background: $color;\" align=center>".date("Y/m/d H:i:s" , $dates[$key])."</div><div><font size=3><b>$val[0]</b></font> &nbsp; $social_ico$social_user<b>".$social_link1."$val[1]".$social_link2."</b><br>$val[2]
<br><div id=\"d_$key\">";
if ("$valid"=="1") {$cmnts.="<a href=\"#reply\" onclick=\"javascript:document.getElementById('$key').style.display='';document.getElementById('$key').style.visibility='visible';document.getElementById('d_$key').style.display='none';document.getElementById('d_$key').style.visibility='hidden';\">$lang[806]</a>"; }
$cmnts.="$cls__delc<div style=\"float:right; width:180px;\" align=center><font class=small><a href=\"#comment_$message/$key\">URL</a></font></div></div>
<div id=\"$key\" style=\"display:none; vilibility:hidden\">
";
if ("$valid"=="1") {$cmnts.="<br><form method=POST action=index.php id=\"f_$key\">
<input type=hidden name=tread value=\"$key\">
<input type=hidden name=level value=\"$level\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=action value=\"cl\">
<input type=hidden name=cl_post value=\"$cl_post\">
<input type=hidden name=social_net value=\"".@$psocial_net."\">
<input type=hidden name=social_other value=\"".@$psocial_other."\">
<input type=hidden name=social_gender value=\"".@$psocial_gender."\">
<input type=hidden name=social_ava value=\"".@$psocial_ava."\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"100\"></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"100\"></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:100%\" maxlength=\"3000\"></textarea>
<a class=ocat1 style=\"height: 30px; cursor:pointer; cursor:hand;\" onclick=\"javascript:document.getElementById('$key').style.display='none';document.getElementById('$key').style.visibility='hidden';document.getElementById('d_$key').style.display='';document.getElementById('d_$key').style.visibility='visible';\">$lang[386]</a> &nbsp; <a class=ocat1 style=\"height: 30px; cursor:pointer; cursor:hand;\" onclick=\"document.getElementById('f_$key').submit();\">$lang[806]<a><br><br></form></div>
</div></div>
";
}
$cmnts.="</td></tr></table></div>";
}
}
}
}

if ($cmnts=="") {if ("$valid"=="1") {$cmnts="<div>$lang[180]</div>";} else {$cmnts="<div>$lang[1533]</div>"; }}
if ($hidecomm=="") {



$cl_list.="<a name=\"view_comments\"></a> <br>
<div class=ocat1 style=\"overflow: hidden;\">
<table border=0 width=100%><tr><td valign=top>
<font size=3><b>".$lang[8].":</b></font></td><td valign=top align=right><a href=\"index.php?action=cl&level=".rawurlencode($level)."&cl_post=$cl_post&exp=#view_comments\">";
if ($exp=="") { $cl_list.="<b>"; }
$cl_list.=$lang[913];
if ($exp=="") { $cl_list.="</b>"; }
$cl_list.="</a> | <a href=\"index.php?action=cl&level=".rawurlencode($level)."&cl_post=$cl_post&exp=yes#view_comments\">";
if ($exp=="yes") { $cl_list.="<b>"; }
$cl_list.=$lang[914];
if ($exp=="yes") { $cl_list.="</b>"; }
$cl_list.="</a></td></tr></table></div><div align=center>$flood
<div align=center><br>$cmnts</div>
</div>
</div>
</div><div class=clear></div>";
}
$cl_list.="<div id=sendcomment style=\"clear:both;\">";
if ("$valid"=="1"){  $cl_list.="<div align=center><br><a class=ocat1 style=\"height:30px; cursor: pointer; cursor: hand;\" onclick=\"javascript:document.getElementById('commentblock').style.display='';document.getElementById('commentblock').style.visibility='visible';document.getElementById('sendcomment').style.display='none';document.getElementById('sendcomment').style.visibility='hidden';\">".$lang[912]."</a></div>";
}

$cl_list.="</div>
<div id=commentblock style=\"display: none; visibility: hidden;\">";
}
if ("$valid"=="1"){  $cl_list.="<a name=\"hidecomm\"></a><div class=cat2 style=\"clear:both;\">
<div><b>$lang[912]:</b></div>
<script language=javascript>
<!--
 function comsubmit () {
if (document.getElementById('comname').value == \"\") {
            alert(\"".$lang[954]." ".$lang[357]."\");
            document.getElementById('comname').focus();
            return false ; }
if (document.getElementById('comtopic').value == \"\") {
            alert(\"".$lang[954]." ".$lang[862]."\");
            document.getElementById('comtopic').focus();
            return false ; }

if (document.getElementById('comtext').value == \"\") {
            alert(\"".$lang[954]." ".$lang[85]."\");
            document.getElementById('comtext').focus();
            return false ; }

document.getElementById('comsu').submit();
 }
-->
</script>
<br><form method=POST action=index.php id=comsu>
<input type=hidden name=tread value=\"\">
<input type=hidden name=social_net value=\"".@$psocial_net."\">
<input type=hidden name=social_other value=\"".@$psocial_other."\">
<input type=hidden name=social_gender value=\"".@$psocial_gender."\">
<input type=hidden name=social_ava value=\"".@$psocial_ava."\">
<input type=hidden name=level value=\"$level\">
<input type=hidden name=exp value=\"$exp\">
<input type=hidden name=action value=\"cl\">
<input type=hidden name=cl_post value=\"$cl_post\">
<table border=0><tr><td>$lang[357]:</td><td><input type=text name=name value=\"$name\" size=40 maxlength=\"100\" id=comname></td></tr>
<tr><td>$lang[862]:</td><td><input type=text name=topic value=\"\" size=40 maxlength=\"100\" id=comtopic></td></tr></table><br>
<textarea name=cmntsent cols=60 rows=5 style=\"width:97%\" maxlength=\"3000\" id=comtext></textarea>";
if ($hidecomm=="") {
$cl_list.="<a class=ocat1 style=\"height:30px; cursor: pointer; cursor: hand;\" onclick=\"javascript:document.getElementById('commentblock').style.display='none';document.getElementById('commentblock').style.visibility='hidden';document.getElementById('sendcomment').style.display='';document.getElementById('sendcomment').style.visibility='visible';\">".$lang[386]."</a> &nbsp; ";}
$cl_list.="<a class=ocat1 style=\"height:30px; cursor: pointer; cursor: hand;\" onclick=\"javascript:comsubmit();\">".$lang[912]."</a></form>";

if ($hidecomm=="") {$cl_list.="</div>";}
}
$cl_list.="</div>";
unset($tmp,$cf,$cls_filep,$con,$com,$cmnts,$t,$tags,$key1,$val1,$tmp0,$cls_file,$handle,$cmnts,$q,$listbl);





} else {
if ($cl_post!="") {
$cl_list="<div align=center><br><font color=#b94a48 size=3>$lang[42]. $lang[948]</font><br></div>";
}
}
}
$handle=@opendir("$fold/base$level");
$max=0;
$cl_dirs="<br><div style=\"width: 100%; float: left; display: block; margin-left: auto;\">";
$fdirs=0;
$fdir=0;
$ydirs=Array(); $choose_txt=$lang[957];
$cll_dirs=Array();
while (($clfile = @readdir($handle))!==FALSE) {

if (($clfile == '.') || ($clfile == '..') || (@is_dir("$fold/base$level/$clfile")!=true)|| (substr(@$clfile,0,1) == '#')||(@$clfile=="description.$speek") ) {
if (substr($clfile,0,1)=='#') { $ydirs[$fdir]=str_replace("#","",$clfile); $fdir+=1;}
if ($clfile=="description.$speek") { $textes = file("$fold/base$level/$clfile"); $choose_txt=trim($textes[0]); $descr_txt=trim($textes[1]); $button_txt=trim($textes[2]);}
continue;
} else {
$cl_icon="";
$cl_idx="";
if (file_exists("$fold/base$level/$clfile/icon.png")==true) {$cl_icon="<img src=$htpath/icon.php?path=".str_replace("%2F", "/",rawurlencode("$level/$clfile/icon.png"))." border=0 align=left style=\"margin: 0px 10px 0px 0px;\">";}
if (file_exists("$fold/base$level/$clfile/icon.gif")==true) {$cl_icon="<img src=$htpath/icon.php?path=".str_replace("%2F", "/",rawurlencode("$level/$clfile/icon.gif"))." border=0 align=left style=\"margin: 0px 10px 0px 0px;\">";}
if (file_exists("$fold/base$level/$clfile/icon.jpg")==true) {$cl_icon="<img src=$htpath/icon.php?path=".str_replace("%2F", "/",rawurlencode("$level/$clfile/icon.jpg"))." border=0 align=left style=\"margin: 0px 10px 0px 0px;\">";}
if (file_exists("$fold/base$level/$clfile.idx")==true) {$cl_idx="<br>".implode("<br>",file("$fold/base$level/$clfile.idx")); }
if (substr($clfile,0,1)=="!") {$dopstyle="border: 1px solid #f00; "; $oclwidth=$sclwidth; } else {$dopstyle="border: 1px solid $nc6; ";$oclwidth=$clwidth;}
$clcontf="$fold/base$level/$clfile/last10.txt";
$clcont="";

if (file_exists($clcontf)) {
$tmp=array_reverse(file($clcontf));
$zz=0;
while (list ($t1,$t2)=each($tmp)) {
$t=explode("|",$t2);
$zz++;
$clcont.="<div class=cat2 onclick=\"document.location.href='$htpath/index.php?action=cl&level=".rawurlencode("$level/$clfile")."&cl_post=".$t[4]."'\" style='cursor: pointer; cursor: hand;' onmouseover=this.style.backgroundColor='$nc6'; onmouseout=this.style.backgroundColor='';><font color=$nc10>".wordwrap(substr(strip_tags($t[13]),0,100), 27, "\n", true)."</font> <a href=\"$htpath/index.php?action=cl&level=".rawurlencode("$level/$clfile")."&cl_post=".$t[4]."\"><b>".wordwrap(substr(strip_tags($t[5]),0,100), 27, "\n", true)."</b></a> - ".wordwrap(substr(strip_tags($t[6]),0,60), 27, "\n", true)."<br><small>".to_html(wordwrap(substr(str_replace("[br]", " ", strip_tags($t[12])),0,200), 100, "\n", true),1)." - <font color=$nc3><noindex><span id=\"z_".$zz."_".md5($level."/".$clfile)."\"></span></noindex></font> - <font class=small><i>".date("d.m.Y H:i", $t[0])."</i></font></small><div class=clear></div>
<script language='javascript'>
rev('z_".$zz."_".md5($level."/".$clfile)."', '".strrev(substr(strip_tags($t[14]),0,60))."');
</script></div>";
}
unset ($t, $t1, $t2);
}
$clform="<div align=center><br><a id=\"t_".md5($level.$clfile)."\" title=\"$lang[956]\" href=\"#cl_form_".md5($level.$clfile)."\" class=\"btn btn-success\"><i class=\"icon-plus icon-white\"></i><font color=white>&nbsp;".$lang[956]."</font></a><br><br></div>";
$cldiv="<div style=\"display:none\"><form class=form-inline action=index.php method=POST name=\"form_".md5($level.$clfile)."\" id=\"cl_form_".md5($level.$clfile)."\">
    <div style=\"width:640px;\"><input type=hidden name=action value=cl_add><input type=hidden name=cl_send value=1><input type=hidden name=clfile value=\"$level/$clfile\"><table border=0 width=100%>
<tr><td align=right><b><nobr>$lang[949]*:</nobr></b></td><td width=80%><input type=text name=cl_title id=cl_title_".md5($level.$clfile)." value='".$clfile."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td align=right><b><nobr>$lang[72]*:</nobr></b></td><td width=80%><input type=text name=cl_city id=cl_city_".md5($level.$clfile)." value='".@$details[17]."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td align=right><b><nobr>$lang[1498]*:</nobr></b></td><td width=80%><input type=text name=cl_email id=cl_email_".md5($level.$clfile)." value='".@$details[4]."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td valign=top align=right><br><b><nobr>$lang[950]*:</nobr></b><br><br>Max: $mmax</td><td><textarea name=cl_description id=cl_description_".md5($level.$clfile)." cols=20 rows=10 maxlength=$mmax style=\"width:100%\"></textarea></td></tr>
<tr><td align=right><b><nobr>$lang[951]*:</nobr></b></td><td><input type=text name=cl_price id=cl_price_".md5($level.$clfile)." value='' size=20 maxlength=\"100\"></td></tr>
<tr><td align=center colspan=2><br><a class=ocat1 style=\"width:30px; cursor: pointer; cursor: hand;\" onclick=\"ch_".md5($level.$clfile)."();\">".$lang['sendform']."</a><br><br></td></tr>
</table></div></form>
</div>
<script language=javascript>
function ch_".md5($level.$clfile)." () {
        var form=document.getElementById('cl_form_".md5($level.$clfile)."');

        if (form[\"cl_title\"].value == \"\") {
             alert(\"".$lang[954]." ".$lang[949]."\");
            form[\"cl_title\"].focus();
            return false ; }
            if (form[\"cl_city\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[72]."\");
            form[\"cl_city\"].focus();
            return false ; }
            if (form[\"cl_email\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[1498]."\");
            form[\"cl_email\"].focus();
            return false ; }
          if (form[\"cl_description\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[950]."\");
            form[\"cl_description\"].focus();
            return false ; }
            if (form[\"cl_price\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[951]."\");
            form[\"cl_price\"].focus();
            return false ; }
            $.ajax({
		type		: \"POST\",
		cache	: false,
		url		: \"/clrefresh.php\",
		data		: $(\"#cl_form_".md5($level.$clfile)."\").serializeArray(),
		success: function(data) {
			$.fancybox(data);
            upd_".md5($level.$clfile)."();
		}
	});
	return false;

}


function upd_".md5($level.$clfile)."() {
$.ajax({
  type: \"POST\",
  url: \"clrefresh.php\",
  data: \"level=".rawurlencode($level)."&clfile=".rawurlencode($clfile)."&amp;speek=$speek&session=$sid\",
  success: function(msg){
    $(document).ready(function() {
	$('#fd_".$fdirs."').animate({
   scrollTop: 0
}, 'slow');
    document.getElementById('fd_".$fdirs."').innerHTML=msg;
        });
  }
});

}

$(document).ready(function() {
$(\"#t_".md5($level.$clfile)."\").fancybox({
'onComplete' : function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
        'scrolling'     : 'no',
      'padding' : 10
});

";

//send form to new window
/*
$cldiv.="$(\"#cl_form_".md5($clfile)."\").bind(\"submit\", function() {


	$.fancybox.showActivity();

	return false;
});

";
*/

//send form to self window
$cldiv.="$(\"#cl_form_".md5($level.$clfile)."\").bind(\"submit\", function() {

	$.fancybox.showActivity();

	$.ajax({
		type		: \"POST\",
		cache	: false,
		url		: \"/clrefresh.php\",
		data		: $(\"#cl_form_".md5($level.$clfile)."\").serializeArray(),
		success: function(data) {
			$.fancybox(data);
		}
	});

	return false;
});";

$cldiv.="
});



--></script>
";
$cll_dirs[$fdirs]= "<!-- $clfile  --><div class=ocat1 style='$dopstyle"."margin:5px; padding:5px 5px 5px 5px; float: left; width: $oclwidth;'><div class=ocat1 style=\"cursor: pointer; cursor: hand;\" onclick=\"document.location.href='$htpath/index.php?action=cl&level=".rawurlencode("$level/$clfile")."'\"><a href=\"$htpath/index.php?action=cl&level=".rawurlencode("$level/$clfile")."\">$cl_icon<font size=3><b>$clfile</b></font>$cl_idx</a><div class=clear></div></div>";
if (trim($clcont)!="") {
$cll_dirs[$fdirs].="<br><div style=\"height: 300px; overflow: auto;\" id=\"fd_$fdirs\">$clcont</div><div class=clear></div>$clform$cldiv</div>";
} else {
$cll_dirs[$fdirs].="<br><div style=\"height: 300px; overflow: hidden;\" id=\"fd_$fdirs\"></div><div class=clear></div>$clform$cldiv</div>";

}
$fds.="
if ((seconds2 ==".(3*$fdirs).")||(seconds2 ==".((3*$fdirs)+20).")||(seconds2 ==".((3*$fdirs)+40).")) {
$.ajax({
  type: \"POST\",
  url: \"clrefresh.php\",
  data: \"level=".rawurlencode($level)."&clfile=".rawurlencode($clfile)."&amp;speek=$speek&session=$sid\",
  success: function(msg){
    $(document).ready(function() {
    document.getElementById('fd_".$fdirs."').innerHTML=msg;

        });
  }
});

}";
$fdirs+=1;
}
}
closedir($handle);
sort($cll_dirs);
$cl_dirs.=implode("\n",$cll_dirs);
$cl_dirs.="</div><div style=\"clear:both;\"></div>";
$cl_dirs="<script language=javascript>

function update2() {
var date2 = new Date();
var seconds2 = date2.getSeconds();
$fds
}


var timerId2;
function clockStart2() {
  if (timerId2) return;

  timerI2d = setInterval(update2, 1000);
  update2();
}

function clockStop2() {
  clearInterval(timerId2);
  timerId2 = null;
}


clockStart2();
$(document).ready(function() { update2(); });
</script>

".$cl_dirs;
$tmplev=explode("/",$level);
$tmpcount=(count($tmplev)-1);
$curlev="".$tmplev[$tmpcount];
unset ($tmplev[$tmpcount]);
$levelup=implode("/",$tmplev);
$uplevel="";
if ($tmpcount>0) {
$uplevel="<div onclick=\"location.href='$htpath/index.php?action=cl&level=".rawurlencode("$levelup")."';\" class=ocat1 style='cursor: pointer; cursor: hand;'><a href=\"$htpath/index.php?action=cl&level=".rawurlencode("$levelup")."\"><img src=$image_path/ofb.png border=0 title=\"".$lang['back_to_higher_level']."\" align=absmiddle><font color=$nc3>".$lang['back']."</font></a></div>";
}
$cl_idx="";
$cl_icon="";
if (file_exists("$fold/base$level/icon.png")==true) {$cl_icon="<img src=$htpath/icon.php?path=".str_replace("%2F", "/",rawurlencode("$level/icon.png"))." border=0 align=left style=\"margin: 0px 10px 0px 0px;\">";}
if (file_exists("$fold/base$level/icon.gif")==true) {$cl_icon="<img src=$htpath/icon.php?path=".str_replace("%2F", "/",rawurlencode("$level/icon.gif"))." border=0 align=left style=\"margin: 0px 10px 0px 0px;\">";}
if (file_exists("$fold/base$level/icon.jpg")==true) {$cl_icon="<img src=$htpath/icon.php?path=".str_replace("%2F", "/",rawurlencode("$level/icon.jpg"))." border=0 align=left style=\"margin: 0px 10px 0px 0px;\">";}

if (file_exists("./classifieds/base".$levelup.$level.".idx")) {
$cl_idx="<font size=2>".implode("<br>", file("./classifieds/base".$levelup.$level.".idx"))."</font>";
}
if ($fdirs>0) {
if ($cl_post=="") {
$cl_list.="$rulezbutton$cl_icon<b><font color=$nc10 size=2>$level</font>$cl_idx</b><br><br><font size=2>$choose_txt</font><div class=clear></div><br>".$uplevel.$cl_dirs."<!--br><br><a class=btn href='$htpath/index.php?action=cl_add'>$lang[955]</a-->";
}
}else{
$cl_dir="./classifieds/base$clfile";
if ((file_exists("$fold/base$level/write.txt")==true)) {
if (file_exists("$fold/base$level/form.txt")) {
//вдруг есть форма добавлени€
$form=file("$fold/base$level/form.txt");
} else {
if ("$valid"=="1") {$proceed=1;} else { $proceed=0; }
if ($cat_only_for_registered==0) { $proceed=1; }
if ((session_id()!="")&&($proceed==1)) {
$form="<br><br><div class=ocat1><form class=form-inline action=index.php method=POST name=\"form\" id=\"cl_form\"><input type=hidden name=action value=cl_add><input type=hidden name=cl_send value=1><input type=hidden name=clfile value='$level'><table border=0 width=100% cellpadding=5 cellspacing=5>
<tr><td align=right><b><nobr>$lang[949]*:</nobr></b></td><td width=80%><input type=text name=cl_title id=cl_title value='".$curlev."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td align=right><b><nobr>$lang[72]*:</nobr></b></td><td width=80%><input type=text name=cl_city id=cl_city value='".@$details[17]."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td align=right><b><nobr>$lang[1498]*:</nobr></b></td><td width=80%><input type=text name=cl_email id=cl_email value='".@$details[4]."' size=20 style='width:100%' maxlength=\"100\"></td></tr>
<tr><td valign=top align=right><b><nobr>$lang[950]*:</nobr></b></td><td><textarea name=cl_description cols=20 rows=10 maxlength=$mmax style=\"width:100%\" id=\"textarea\"></textarea></td></tr>
<tr><td align=right><b><nobr>$lang[951]*:</nobr></b></td><td><input type=text name=cl_price id=cl_price value='' size=20 maxlength=\"100\"></td></tr>
<tr><td colspan=2 align=center><br><a onclick=\"checkform();\" class=ocat1 style=\"padding: 10px; height: 35px; cursor:pointer; cursor:hand;\"><img src=$image_path/pl.png border=0 align=absmiddle><font color=$nc5>".$lang[956]."</font></a></td></tr>
</table></form></div>";
if ($ed_post!="") {
if ("$valid"=="1") {if (($details[7]=="ADMIN")||($details[8]=="MODER")) {
$form=$admform;
}
}
}
} else {
if ($cat_only_for_registered==1) {
$form="<a name=\"addmes\"></a><br><br><b>$lang[956]:</b> <a href=\"$htpath/index.php?register=1\">$lang[49] $lang[50]</a>";

}
}
}
}
if ($cl_post=="") {
$cl_list.="$rulezbutton"."$cl_icon<font size=3><b>".substr($level,1,3000)."</b><br>$cl_idx</font></b><div class=clear></div><br>".$uplevel.$cl_dirs."";
}
}
} else {
$cl_list.="<font color=$nc10>$lang[42]. $lang[952]</font><br><br><div onclick=\"location.href='$htpath/index.php?action=cl&level=';\" class=cat2 style='cursor: pointer; cursor: hand;' onmouseover=this.style.backgroundColor='$nc6'; onmouseout=this.style.backgroundColor='';><a href=\"$htpath/index.php?action=cl&level=\"><font color=$nc10>..<img src=$image_path/ofb.png border=0 title=\"".$lang['back_to_higher_level']."\"></font></a></div><!--br><a class=btn href='$htpath/index.php?action=cl_add'>$lang[955]</a-->";
}
if ((isset($ydirs[0]))&&($cl_post=="")) {
rsort ($ydirs);
reset ($ydirs);
$mdirs=Array();
$fdir=0;
while (list($key,$val)=each($ydirs)) {
if ($years_back>=0) {
$handle=opendir("$fold/base$level/#$val");
while (($lst_file = @readdir($handle))!==FALSE) {
if (substr($lst_file,-4) != '.lst' ) {
continue;
} else {
$mdirs[$fdir]="$fold/base$level/#$val/$lst_file";
$fdir+=1;
}
}
closedir($handle);

}

}
rsort ($mdirs);
reset ($mdirs);
$cl_key=1;
$cl_list.=""; $cl_date="";
while (list($key,$val)=each($mdirs)) {
$cl_c=array_reverse(file($val));
while (list($key2,$val2)=each($cl_c)) {
if ($cl_key<($start+1)) {
$cl_key+=1;
} else {
$cl_cont=explode("|",$val2);
$cl_link="$htpath/index.php?action=cl&level=".rawurlencode($level)."&cl_post=".$cl_cont[4];
if (@$cl_post==@$cl_cont[4]) {$dopstyle="border: 3px solid $nc3; ";} else {$dopstyle="";}
$cl_curd=date("d/m/Y", $cl_cont[0]);
if ($cl_date!=$cl_curd) {
$cl_date=$cl_curd;
$cl_list.="<div align=left><table border=0 cellspacing=10 cellpadding=5><tr><td class=shadow><b>$cl_curd</b></td></tr></table></div>";
}
$pic="";
$cl_thumb="$image_path/picture.png";
if (@$cl_cont[9]!="") {$cl_thumb=@$cl_cont[9]; }
if ($cl_cont[7]==1) {$pic="<img src=$cl_thumb align=absmiddle title=\"$lang[958]\" class=img style=\"margin: 2px 10px 2px 2px;\">";}
$adm_del="";
$adm_ip="";
$adm_edit="";
$ip="";
$ftitle="";
$fcolor="$nc3";
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {
$ip=strtoken(@$cl_cont[14]," ");
if (trim($ip)!="") {
$tmp3=explode(".",$ip);
$ftitle="";
if(is_dir("./admin/bannedip")!=true) { mkdir("./admin/bannedip",0755); }
if(is_dir("./admin/bannedip/temp")!=true) { mkdir("./admin/bannedip/temp",0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time()),0755); }
if(is_dir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()))!=true) { mkdir("./admin/bannedip/temp/".date("Y",time())."/".date("m",time())."/".date("d",time()),0755); }
$ipfile="./admin/bannedip/".implode("/",$tmp3)."/banned.txt";
if (file_exists($ipfile)) { $fcolor="red"; $ftitle=" title=\"$lang[1525]\"";}
$adm_ip="<td width=90 valign=top align=right title=\"".$lang['addition']."\"><img src=$image_path/pix.gif width=90 height=9><br><a href=\"#Whois\" onclick=\"javascript:window.open('$htpath/whois.php?t=".md5("$ip"."$htpath"."$secret_salt")."&ip=".rawurlencode($ip)."&t2=".md5("$ip"."$htpath"."$secret_salt".$cl_cont[13])."&n=".rawurlencode($cl_cont[13])."','".md5("$ip"."$htpath"."$secret_salt")."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=560,left=10,top=10')\"><font color=$fcolor size=1".$ftitle.">".$ip."</font></a></td><td>&nbsp;&nbsp;</td>";
}
$adm_del="<td width=20 valign=top align=right title=\"".$lang[744]."\"><img src=$image_path/pix.gif width=20 height=9><br><a class=btn href=\"$htpath/index.php?action=cl&amp;start=$start&level=".rawurlencode($level)."&del_post=".$cl_cont[4]."\"><font color=#b94a48>X</font></a></td>";
$adm_edit="<td width=30 valign=top align=center title=\"".$lang[744]."\"><img src=$image_path/pix.gif width=20 height=9><br><a class=btn href=\"$htpath/index.php?action=cl&amp;start=$start&level=".rawurlencode($level)."&ed_post=".$cl_cont[4]."&cl_post=".$cl_cont[4]."\"><font color=#468847>".$lang['edits']."</font></a></td><td>&nbsp;&nbsp;</td>";

}
}

unset ($tmpex);
$uusr=@$cl_cont[10];
$cl_cont[11]=str_replace("?"," ",@$cl_cont[11]);
$cl_cont[13]=str_replace("?"," ",@$cl_cont[13]);
$umail=@$cl_cont[11];  $utel="";
if (!preg_match("/\@/i",$umail)) {
if (preg_match("/\@/i",@$cl_cont[13])) {
$tmpe=@$cl_cont[13];
preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", @$cl_cont[13], $matches);
if (isset($matches[0][0])) { if($matches[0][0]!="") {$tmpe=implode(",",$matches[0]); }}
$uusr=strtoken(@$tmpe,"@");
$uusr= "<i class=icon-user></i><a href=\"#mail\" onclick=\"mto(this, '".strrev(str_replace("\r", "", str_replace("\n", "", "mailto:".$tmpe."?subject=#".$cl_cont[4]." / ".str_replace("_"," ", translit($cl_cont[5])." - ". translit(wordwrap($cl_cont[6], 12, "\n", true))))))."');\"><font color=$nc3>$uusr</font></a>";
} else {
if ($uusr=="") { $uusr="<i class=icon-user></i>$lang[193]"; }
}
} else {
$tmpe=@$cl_cont[11];
preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", @$cl_cont[11], $matches);
if (isset($matches[0][0])) { if($matches[0][0]!="") {$tmpe=implode(",",$matches[0]); }}
$uusr=strtoken(@$tmpe,"@");
$uusr= "<i class=icon-user></i><a href=\"#mail\" onclick=\"mto(this, '".strrev(str_replace("\r", "", str_replace("\n", "", "mailto:".$tmpe."?subject=#".$cl_cont[4]." / ".str_replace("_"," ", translit($cl_cont[5])." - ". translit(wordwrap($cl_cont[6], 12, "\n", true))))))."');\"><font color=$nc3>$uusr</font></a>";

}

$tod=date("d.m.Y", $cl_cont[0]);
if ($tod==date("d.m.Y", time())) {$tod="<b>".$lang[114]."</b>";}
$cl_list.="<table border=0 cellspacing=0 cellpadding=0 width=100%><tr><td><div onclick=\"document.location.href='$cl_link'\" class=cat2 style='$dopstyle"." cursor: pointer; cursor:hand; border-bottom: 1px solid $nc6;' onmouseover=this.style.backgroundColor='$nc6'; onmouseout=this.style.backgroundColor='';><table border=0 width=100%><tr><td valign=top width=5>$pic</td><td valign=top width=50><small><font color=".$nc4."><i>".$tod."<br>".date("H:i", $cl_cont[0])."</i></font></small></td><td>&nbsp;&nbsp;</td><td valign=top><font color=$nc10>".wordwrap(@$cl_cont[12], 33, "\n", true)."</font> <a href=$cl_link><b>".wordwrap($cl_cont[5], 33, "\n", true)."</b></a> <br><small>$uusr &nbsp; <font color=$nc3>".wordwrap(@$cl_cont[13], 64, "\n", true)."</font><br>".to_html(wordwrap(substr(str_replace("[br]", " ", strip_tags(@$cl_cont[15])),0,200), 100, "\n", true),1)."</small> </td><td>&nbsp;</td><td>&nbsp;</td><td width=100 align=center valign=top>".wordwrap($cl_cont[6], 27, "\n", true)."</td></tr></table></div><td></td>".$adm_ip."$adm_edit"."$adm_del</tr></table>\n";
$cl_key+=1;

if ($cl_key>($start+$cl_perpage)) { break; }
}
}
unset ($cl_c,$key2,$val2,$cl_link);
if ($cl_key>($start+$cl_perpage)) { break; }

}
}
$mmax=3000;
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {$mmax=3000;}}
if ($form!="") {
if ("$valid"=="1") {$proceed=1;} else { $proceed=0; }
if ($cat_only_for_registered==0) { $proceed=1; }
if ((session_id()!="")&&($proceed==1)) {
$cl_list.="
<script type=\"text/javascript\">
function click_bb(aid,Tag,author) {
var f = '';
if (Tag == 'a') f = ' href=\'' + prompt('$lang[928]:') + '\'';
if (Tag == 'quote') f = '='+ author+ ']' + prompt(author+':') + '[/quote';
if (Tag == 'img') f =']' + prompt('$lang[926]:') + '[/img';

  var Open='['+Tag+f+']';
  var Close='[/'+Tag+']';
if (Tag == 'img' || Tag == 'cut' || Tag == 'quote' ) { Close = ''; }
";
if ($html!="off") {
reset ($dir_smiles);
while (list($skey,$sval)=each($dir_smiles)) {
$cl_list.="if (Tag == ' ".$sval." ') { Open=Tag; Close = ''; } \n";
}
}
//$cl_list.=" if (Tag == ' :) ' || Tag == ' ;) '  || Tag == ' :d ' || Tag == ' :s ' || Tag == ' (h) ' || Tag == ' :\'( ' || Tag == ' :@ '|| Tag == ' (a) '|| Tag == ' :$ '|| Tag == ' :p '|| Tag == ' (b) ') { Open=Tag; Close = ''; } \n";

$cl_list.="
var ss;
  var doc = document.getElementById(aid);
        if (window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) {
                doc.focus();
                sel = document.selection.createRange();
                sel.text = Open+sel.text+Close;
                doc.focus();
    }   else {
    ss=doc.scrollTop;
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
    maxChars: ".$mmax.", // max chars
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
";
        $form=$form."<br><table border=0 width=100%><tr><td valign=top>";
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {
if ($html!="off") { $form.="<span onclick=\"click_bb('textarea','a')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=4&dest=textar','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')\" title=\"$lang[938]\"><img src=\"$image_path/picture.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b', '')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','center','')\" title=\"$lang[936]\"><img src=\"$image_path/align_center.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>";
}
} else {
if ($html!="off") {
$form.="<span onclick=\"click_bb('textarea','a','')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img','')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b','')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>";
}
}
} else {
if ($html!="off") {
$form.="<span onclick=\"click_bb('textarea','a','')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img','')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b','')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>";
}
}
        $form.="</td></tr><tr><td valign=top><br>\n";
if ($html!="off") {
reset ($dir_smiles);
while (list($skey,$sval)=each($dir_smiles)) {
$form.="<a href=\"#null\"><img src=smileys/".$skey." hspace=2 border=0 onClick=\"click_bb('textarea',' ".$sval." ');\" title=\"".strtoken($sval,".")."\"></a> ";
}
        }
                $form.= "</td></tr></table> ";

}
}
$cl_prev="<a class=btn href=\"$htpath/index.php?action=cl&level=".rawurlencode($level)."&amp;start=".($start-$cl_perpage)."\">&lt;&lt; $lang[923] $cl_perpage</a>";
$cl_next="<a class=btn href=\"$htpath/index.php?action=cl&level=".rawurlencode($level)."&amp;start=".($start+$cl_perpage)."\">$lang[924] $cl_perpage &gt;&gt;</a>";
if (($start-$cl_perpage)<0) {$cl_prev=""; }
if (($start+$cl_perpage)>=$cl_key) {$cl_next=""; }
$cl_list.="<br><br><div align=center>$cl_prev $cl_next</div>$form";
}
if ("$valid"=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {$cl_list.="<br><br><br><div align=center><a class=btn href=\"$htpath/index.php?action=cladm&i=".rawurlencode($level)."\">$lang[959]</a></div><br>"; }}
$cl_list.="<br>".$social_auth;
}
$cl_list.="<script type=\"text/javascript\">
		$(document).ready(function() {

            $(\"a[rel=forum_group]\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false
			});

		});
	</script>";
    $cl_list="<script type=\"text/javascript\">
function mto(id,string) {
    var reversedString = \"\";
    var stringLength = string.length - 1;
    for (var i = stringLength; i >= 0; i--) {
        reversedString += string[i];
    }
    document.location.href=''+reversedString;
}
function rev(id,string) {
    var reversedString = \"\";
    var stringLength = string.length - 1;
    for (var i = stringLength; i >= 0; i--) {
        reversedString += string[i];
    }
    document.getElementById(id).innerHTML=''+reversedString;
}
 function checkform () {
        var form=document.getElementById('cl_form');

        if (form[\"cl_title\"].value == \"\") {
            form[\"cl_title\"].focus();
            return false ; }
            if (form[\"cl_city\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[72]."\");
            form[\"cl_city\"].focus();
            return false ; }
            if (form[\"cl_email\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[1498]."\");
            form[\"cl_email\"].focus();
            return false ; }
          if (form[\"cl_description\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[950]."\");
            form[\"cl_description\"].focus();
            return false ; }
            if (form[\"cl_price\"].value == \"\") {
            alert(\"".$lang[954]." ".$lang[951]."\");
            form[\"cl_price\"].focus();
            return false ; }
          form.submit();
          }
</script>
"."<div align=left style=\"padding:0px;\">$cl_list</div>";
?>
