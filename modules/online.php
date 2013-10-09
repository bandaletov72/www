<?php
$onluser="";
$saveu=0;
if ($valid=="1") {

if (($details[7]=="ADMIN")||($details[7]=="MODER")) {

if(isset($_GET['sysmessage_send'])) { $sysmessage_send=$_GET['sysmessage_send']; } elseif(isset($_POST['sysmessage_send'])) { $sysmessage_send=$_POST['sysmessage_send']; } else { $sysmessage_send=0; }
if(isset($_GET['sysmessage_user'])) { $sysmessage_user=$_GET['sysmessage_user']; } elseif(isset($_POST['sysmessage_user'])) { $sysmessage_user=$_POST['sysmessage_user']; } else { $sysmessage_user=""; }
if(isset($_GET['sysmessage'])) { $sysmessage=$_GET['sysmessage']; } elseif(isset($_POST['sysmessage'])) { $sysmessage=$_POST['sysmessage']; } else { $sysmessage=""; }
if (($sysmessage!="")&&($sysmessage_user!="")&&($sysmessage_send==1)) {
$u_dir="./admin/userstat/".$sysmessage_user;
if (is_dir($u_dir)==FALSE) { mkdir($u_dir,0755); }
$avafile="./admin/userstat/".$details[1]."/".$details[1].".ava";
$aava="";
if (file_exists($avafile)) {
$fp=fopen($avafile,"r");
$aava="<img src=\"$htpath/gallery/avatars/".fread($fp,filesize($avafile))." hspace=5 align=left border=0\">";
fclose($fp);
}
$u_url=$u_dir."/inbox.txt";
$fp=fopen($u_url,"w");
fputs($fp,"<table border=0><tr><td valign=top>".$aava."</td><td valign=top><img src=$image_path/pix.gif height=1 width=400><br>".$sysmessage."</td></tr></table>");
fclose($fp);

}

}
}
function save_sess($sessf,$sessid,$usersesname,$curutime,$minupdate,$telf,$realnameu,$r181){

$sesf=0;
$ses=Array();
$onlineusers=Array();
$ses=file($sessf);
while (list($sesk,$sesv)=each($ses)) {
$sestmp=Array();
$sestmp=explode("|",$sesv);
if (doubleval($sestmp[0])<($curutime-($minupdate*59))){
//drop user from online users
$ses[$sesk]="";
} else {
//set online status
$onlineusers[$sestmp[1]]=$sestmp[0];
}
if ($sestmp[1]==$usersesname) {
//Yes its me!
$ses[$sesk]=time()."|$usersesname|$sessid|$telf|$realnameu|$r181|\n";
$sesf=1;
}
}
if ($sesf==0) {
$ses[]=time()."|$usersesname|$sessid|$telf|$realnameu|$r181|\n";
}

if ($usersesname!="") {
$onlineusers[$usersesname]=time();
//echo "saving online.txt<br>";

$fp=fopen($sessf,"w");
fputs($fp,implode("",$ses));
fclose ($fp);
}
return $onlineusers;
}



function load_sess($sessf,$sessid,$usersesname,$minupdate){
$sesf=0;
$onlineusers=Array();
$ses=Array();
$ses=file($sessf);
while (list($sesk,$sesv)=each($ses)) {
//echo $sesk." ".$sesv."<br>";
$sestmp=Array();
$sestmp=explode("|",$sesv);
//echo date("H:i",$sestmp[0])." $sestmp[0]<".date("H:i",(time()-($minupdate*60)))." ".(time()-($minupdate*60))."<br>";
//if (doubleval($sestmp[0])>(time()-($minupdate*60))){
$indx=$sestmp[1];
$onlineusers[$indx]=$sestmp[0];
//}
}
return $onlineusers;
}


$online_users=Array();
$firstentr=0;
if (($valid=="1")&&($details[1]!="")&&($details[1]!="guest")){
//echo "valid user detected<br>";
$u_dir="./admin/userstat/".$details[1];
$u_lv=$u_dir."/lastvisit.time";
$cur_utime=time();
if (is_dir($u_dir)==FALSE) { mkdir($u_dir,0755); }
$u_url=$u_dir."/lastvisit.url";
//echo "saving url<br>";
$lastur=request_url();
if ($lastur!="$htpath/message.php") {
$fp=fopen($u_url,"w");
fputs($fp,$lastur);
fclose($fp);
}

if (file_exists($u_lv)==false) {
//echo "saving lastvisit file<br>";
$fp=fopen($u_lv,"w");
fputs($fp,$cur_utime);
$_SESSION["last_visit"]=$cur_utime;
fclose($fp);
} else {
//echo "lastvisit file exists<br>";
if (!isset($_SESSION["last_visit"])) {
//echo "session not exists<br>";
//first entrance
$firstentr=1;
//echo "first enter: loading lastvisit file<br>";
$fp=fopen($u_lv,"r");
$_SESSION["last_visit"]=doubleval(trim(fread($fp,filesize($u_lv))));
fclose($fp);
} else {
//echo "session exists<br>";
//echo "ss=".$_SESSION["last_visit"]."<br>lv+60sec=".($_SESSION["last_visit"]+(1*60))."<br>time=".time()."<br>".$cur_utime;
//echo "Если ".date("H:i:s", $_SESSION["last_visit"])." < ".date("H:i:s", (time()-($min_update*60)))."<br>\n";
if ($_SESSION["last_visit"]<(time()-($min_update*60))){
//echo "writing lastvisit file<br>\n";
$fp=fopen($u_lv,"w");
fputs($fp,time());
fclose($fp);
//echo "apply session time to ".date("H:i:s", time())."<br>";
$_SESSION["last_visit"]=time();
//echo "need to save online.txt<br>";
$saveu=1;
}

}
//echo $firstentr." ".date("H:i:s", $_SESSION["last_visit"])."<".date("H:i:s",($cur_utime-($min_update*60)))."<br>";
$onlf="./admin/online.txt";
$id_session = session_id();
if (!file_exists($onlf)) {
//init
//echo "add stroke to online.txt<br>";
if (@$details[1]!="") {
$fp=fopen($onlf,"w");
fputs($fp,time()."|$details[1]|$id_session|".$details[3]."|(".$details[19].")".$details[5]."|".$details[18]." - ".$details[17]."|\n");
fclose ($fp);
}
} else {
if ($firstentr==1) {
$online_users=save_sess($onlf,$id_session,$details[1],$cur_utime,$min_update,$details[3],"(".$details[19].")".$details[5],$details[18]." - ".$details[17]);
} else {
//second visit
//echo $_SESSION["last_visit"]. "<" .(time()-($min_update*60));
if ($saveu==1){
//echo "session change";
$online_users=save_sess($onlf,$id_session,$details[1],$cur_utime,$min_update,$details[3],"(".$details[19].")".$details[5],$details[18]." - ".$details[17]);
$sasveu=0;
}

}

if (!isset($online_users[$details[1]])) {

$onlf="./admin/online.txt";
$id_session = session_id();
//echo "load sess<br>";
$online_users=load_sess($onlf,$id_session,$details[1],$min_update);
//var_dump($online_users);
if (!isset($online_users[$details[1]])) {
//echo "save sess<br>";
$online_users=save_sess($onlf,$id_session,$details[1],time(),$min_update,$details[3],"(".$details[19].")".$details[5],$details[18]." - ".$details[17]);
//$_SESSION["last_visit"]=$cur_utime;
}
}
}




}
$u_mes="";
/*
$u_mesf="./admin/userstat/".$details[1]."/inbox.txt";
if (file_exists($u_mesf)) {
$fp=fopen($u_mesf,"r");
$u_mes=fread($fp,filesize($u_mesf));
fclose($fp);
}

if ($u_mes!="") {
$u_mes="<div class=round3><a id=\"systems\" href=\"#sysmes\"></a><script type=\"text/javascript\">
        $(document).ready(function() {
        $(\"#systems\").fancybox({
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
           $(\"#systems\").fancybox({
                   'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                           'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false
           }).trigger('click');
        });
    </script><div id=\"sysmes\"><h4>".$lang[85]."</h4>$u_mes</div></div>";
    unlink($u_mesf);
    }
    */
    reset ($online_users);
    $saveu=0;
    //$onluser="<small><b>".str_replace("[min_update]",$min_update, $lang[1010])."</b><small><br><br>";
    while(list($uk,$uv)=each($online_users)) {
    if ($uv<(time()-($min_update*60))){
    $onluser.= "<a name=\"$uk\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$uk."&speek=$speek','chatw','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10');\"><img src=$image_path/offline.png border=0 title=\"Offline\" align=absmiddle>".$uk."</a> <b>".date("H:i:s", $uv)."</b><br>\n";
    } else {
    $onluser.= "<a name=\"$uk\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$uk."&speek=$speek','chatw','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10');\"><img src=$image_path/online.png border=0 title=\"Online\" align=absmiddle>".$uk."</a> <b>".date("H:i:s", $uv)."</b><br>\n";
    }
    }

    /*
if ($saveu==1) {


}
*/
}
?>