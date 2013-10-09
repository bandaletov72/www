<?php
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
if(is_dir("./admin/bannedip")!=true) { mkdir("./admin/bannedip",0755); }
$f_rules_link="";
$f_rules_text="";
$fa_adm="";
$fadmins="";
//echo var_dump($details);
unset($f6);
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
$forum_perpage=20;
$antispam_array=Array("2x2=4", "3x3=9", "6-4=2", "10+2=12", "20-10=10");
if (file_exists("./templates/$template/$language/antispam.inc")==TRUE) {
$antispam_array=@file("./templates/$template/$language/antispam.inc");
}
$answer_ok=0;
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
if (@$action!=="forum"){ exit;}
if (@$view_forum==0){ exit;}
//----------------------------------------------------------------------------------------------
//  functionality for smileys
//----------------------------------------------------------------------------------------------

if (array_key_exists("antispam_a".md5(date("d.m.Y")), $_POST)) { $antispam_a=$_POST["antispam_a".md5(date("d.m.Y"))]; } else {$antispam_a="";}
if (!isset($antispam_a)){$antispam_a="";} $antispam_a=toLower(trim(stripslashes($antispam_a))); if (!preg_match("/^[а-яА-ЯёЁa-zA-Z0-9_\.\,\?\:\&\#\;\ \%\/-]+$/i",$antispam_a)) { $antispam_a="";}
if (array_key_exists("antispam_row".md5(date("d.m.Y")), $_POST)) { $antispam_row=$_POST["antispam_row".md5(date("d.m.Y"))]; } else {$antispam_row="";}
if (!isset($antispam_row)){$antispam_row="";} $antispam_row=trim(stripslashes($antispam_row)); if (!preg_match("/^[a-z0-9_]+$/",$antispam_row)) { $antispam_row="";}
if (!isset($fpage)){$fpage=0;} $fpage=doubleval($fpage); if (!preg_match("/^[0-9]+$/",$fpage)) { $fpage=0;}
if (!isset($act)){$act="";} if (!preg_match("/^[0-9a-z]+$/",$act)) { $act="";}
if (!isset($fr)){$fr=1;} $fr=doubleval($fr); if (!preg_match("/^[0-9]+$/",$fr)) { $fr=1;}

if (!isset($me)){$me="";} if (!preg_match("/^[a-z0-9_]+$/",$me)) { $me="";}
if (file_exists("./forum/data/stiky.txt")) {
$tmp_stiky=file ("./forum/data/stiky.txt");
while (list($keyst,$valst)=each($tmp_stiky)) {
$idx=trim($valst);
$stikytreads[$idx]=filemtime("./forum/data/".$idx.".txt");
}
}else{
$stikytreads=Array();
}
//echo $antispam_row;
$f_name="";
$f_desc="";
$f_asp=1;
$f_reg=1;
$f_tre=1;
$f_ico="images/mini_folder.png";
$ffp = array();

$ffp = file("./forum/data/forums.txt");

natcasesort($ffp);
while (list($key,$val)=each($ffp)) {
if (trim($val!="")) {

$out=explode("|", $val);
$idx=$out[1];
$forum_admins[$idx]=explode(",",trim($out[4]));
$fadmins.=trim($out[4]).",";
if ($fr==$out[1]) {
$f_name=$out[2];
$f_desc=$out[3];
$f_rules_text=$out[5];
$f_rules_link=$out[6];
$f_ico=$out[9];
$f_asp=doubleval($out[7]);
$f_adm=array_flip(explode(",",trim($out[4])));
$f_tre=doubleval($out[8]);
$f_reg=doubleval($out[10]);
}
}
}
if ($f_asp==1) {
reset ($antispam_array);
while (list ($as_key, $as_st) = each ($antispam_array)) {
//echo $as_st."<br>";
$antispam_que=strtoken($as_st,"=");
$antispam_ans=trim(str_replace("$antispam_que=", "", $as_st));
$antispam_index=md5(date("d.m.Y").$as_key);
//echo $antispam_index." ".$antispam_row."<br>";
if ($antispam_index==$antispam_row) {

if ($antispam_a==$antispam_ans) {
$answer_ok=1;
//echo "exist $antispam_index<br>$antispam_a = $antispam_ans f_reg=$f_reg answer=$answer_ok<br>";
}
}
}
}
if ($f_reg==1) {

if ($valid!="1") {
$answer_ok=0;
} else {
if ($f_asp==0) {
$answer_ok=1;
}
}

} else {
if ($valid=="1") {

if ($f_asp==0) { $answer_ok=1; }
if (($details[7]=="ADMIN")||($details[7]=="MODER")) { $answer_ok=1;  }

}
}
$rand_st=rand(0, count($antispam_array));
$randoma=@$antispam_array[$rand_st];
$antispam_q=strtoken($randoma,"=");
if (trim($antispam_q=="")) {$randoma=$antispam_array[0]; $antispam_q=strtoken($randoma,"="); $rand_st=0;}

$antispam_answer=trim(str_replace("$antispam_q=", "", $randoma));
if ($antispam_answer=="".doubleval($antispam_answer)) {$antispam_type=$lang[651];} else {$antispam_type="";}

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
        // опция поиска '|s' - включать и переводы строки в шаблон (.+?)
        // prg_replace_callback - потому что надо бы пофиксить кавычки в первой группе:), поэтому вызывается
        //  для каждого совпадения ф-я escaper
 }
function parse_text($face) {
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
        $repto="<div class=img style=\"width:550px; height:auto; overflow:auto;\" title=\"".$lang[139]." $img[0]x$img[1]\"><a rel=forum_group href=$repst><img src=".$repst." border=0></a></div>";
        } else {
        $iheight=round($forum_imgwidth*$img[1]/$img[0]);
        if ($img[1]<=$forum_imgwidth) {
        $repto="<img src=".$repst." title=\"$img[0]x$img[1]\" class=img hspace=10 vspace=10>";

        } else {
        $repto="<div class=img style=\"width:".$forum_imgwidth."px;\" title=\"".$lang[139]." $img[0]x$img[1]\"><a rel=forum_group href=$repst><div style=\"display: block; position: relative; width:".$forum_imgwidth."px;\" align=\"center\"><span style=\"width:100%; position: absolute; top: ".($iheight-38)."px; right: 0px; background-image: url('".$image_path."/50w.png');\"><img src=$image_path/pix.gif width=32 height=32 align=absmiddle hspace=10 vspace=4 border=0><font face=Arial color=$nc5 size=1>$img[0]"."x"."$img[1]</font><img src=$image_path/zoomicon.png align=absmiddle hspace=10 vspace=4 border=0></span></div><img src=".$repst." width=$forum_imgwidth height=$iheight border=0><div style=\"clear: both;\" align=\"center\"></div></a></div>";
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
        $temp = str_replace("[a href='".$url_link."']".$url_text."[/a]","<a href='go.php?".strrev($url_link2)."' target=_blank>".$url_text."</a>", $temp);
        } else {
        $temp = str_replace("[a href='".$url_link."']".$url_text."[/a]","<a href='".$url_link2."'>".$url_text."</a>", $temp);

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



//----------------------------------------------------------------------------------------------
//  list the available topics and print add topic form
//----------------------------------------------------------------------------------------------
function showForums() {
global $forum_admins;
global $image_path;
global $htpath;
global $lang;
global $nc0;
global $nc6;
global $nc10;
global $nc3;
global $details;
global $valid;
global $answer_ok;
global $antispam_type;
global $rand_st;
global $online_users;
$mmax=2000;
if (@$valid=="1"){$mmax=5000;}
$forum_list="";
global $datadir;
global $smileys;
global $antispam_q;
global $forum_name;
global $forum_perpage;
global $fpage;
global $speek;

$n = 0;
$sf="";
if ($valid=="1") {$sf="<div style=\"padding:5px;\"><div style=\"padding:5px;\"><a href=\"$htpath/index.php?action=forum&act=search\"><i class=icon-search title=\"$lang[1077]\" hspace=5></i> </a><span class=lnk><a href=\"$htpath/index.php?action=forum&act=search\">$lang[1077]</a></span></div></div>"; }
$forum_list.="<div align=center class=box><table class=\"table\" border=0 style=\"width:100%;\" cellpadding=15 cellspacing=0 width=100%>
<tbody><tr class=ocat1><td>&nbsp;</td><td align=left><b>".$lang[999]."</b></td><td align=center><b>".$lang[1001]."</b></td><td align=center colspan=2><b>".$lang[1000]."</b></td><td align=right colspan=2>$sf</td></tr>";
$ffp = array();


        $ffp = file($datadir."forums.txt");
        natcasesort($ffp);
        while (list($key,$val)=each($ffp)) {
if (trim($val!="")) {
$out=explode("|", $val);
$lp = array();

if(!is_dir($datadir.$out[1])) { mkdir($datadir.$out[1],0755);
$file=$datadir.$out[1]."/topics.txt";
$ftopn=fopen($file,"w");
fclose($ftopn);
$file=$datadir.$out[1]."/topicsnum.txt";
$ftopn=fopen($file,"w");
fputs($ftopn, "0");
fclose($ftopn);
$file=$datadir.$out[1]."/answers.txt";
$ftopn=fopen($file,"w");
fputs($ftopn, "0");
fclose($ftopn);
$file=$datadir.$out[1]."/lastpost.txt";
$ftopn=fopen($file,"w");
fputs($ftopn, time()."|".$details[1]."|||");
fclose($ftopn);
}

$file=$datadir.$out[1]."/lastpost.txt";
$flp=@fopen($file,"r");
$lp=explode("|", trim(@fread($flp,@filesize($file))));
@fclose($flp);

$topn = 0;
$file=$datadir.$out[1]."/topicsnum.txt";
$ftopn=@fopen($file,"r");
$topn=doubleval(trim(@fread($ftopn,@filesize($file))));

@fclose($ftopn);

$popn = 0;
$file=$datadir.$out[1]."/answers.txt";

$fpopn=@fopen($file,"r");
$popn=doubleval(trim(@fread($fpopn,@filesize($file))));

@fclose($fpopn);
if (!isset($online_users[@$lp[1]])) {$onlinestatus="<i class=icon-user title=Offline></i> "; } else {$onlinestatus="<i class=icon-ok title=Online></i> ";}
$validmoder=0;
$idx=$out[1];
if (@$valid=="1") {
reset ($forum_admins[$idx]);
while (list($k,$v)=each ($forum_admins[$idx])) {
if ($v==$details[1]) {$validmoder=1;}
}
if ($details[7]=="ADMIN"){$validmoder=1;}
if ($details[7]=="MODER"){$validmoder=1;}
}
if ($validmoder==1) {
$forum_list.="<tr class=searchitem style=\"cursor: pointer; cursor: hand; text-decoration: none;\"><td align=left><img src=".$out[9]." border=0></td><td onclick=\"location.href='".$htpath."/index.php?action=forum&fr=".$out[1]."&act=list';\" align=left class=pcont><font size=3><b><a href=index.php?action=forum&fr=".$out[1]."&act=list>".$out[2]."</a></b></font><br><span>".$out[3]."</span></td><td onclick=\"location.href='".$htpath."/index.php?action=forum&fr=".$out[1]."&act=list';\" align=center>".$topn." / ".$popn."</td><td align=left><span>".date("d.m.Y H:i",filemtime($datadir.$out[1]."/topics.txt"))."</span></td><td align=left onclick=\"location.href='".$htpath."/index.php?action=forum&fr=".$out[1]."&act=list';\" style=\"white-space:nowrap;\"><a href=index.php?action=userinfo&usernik=".rawurlencode(@$lp[1]).">$onlinestatus<b>".@$lp[1]."</b></a></td><td onclick=\"location.href='".$htpath."/index.php?action=forum&fr=".$out[1]."&act=list';\" align=left class=pcont><span><a href=index.php?action=forum&fr=".$out[1]."&act=show&nr=".@$lp[3].">".@$lp[2]."</a></span></td><td align=left><button onclick=\"location.href='".$htpath."/index.php?action=forum_admin&fr=".$out[1]."&act=list';\" onmouseover=\"this.style.backgroundColor='$nc10';\" onmouseout=\"this.style.backgroundColor='';\">MOD</button></td></tr>";
} else {
$forum_list.="<tr onclick=\"location.href='".$htpath."/index.php?action=forum&fr=".$out[1]."&act=list';\" class=searchitem style=\"cursor: pointer; cursor: hand; text-decoration: none;\"><td align=left><img src=".$out[9]." border=0></td><td align=left class=pcont><font size=3><b><a href=index.php?action=forum&fr=".$out[1]."&act=list>".$out[2]."</a></b></font><br><span>".$out[3]."</span></td><td align=center>".$topn." / ".$popn."</td><td align=left><span>".date("d.m.Y H:i",filemtime($datadir.$out[1]."/topics.txt"))."</span></td><td align=left style=\"white-space:nowrap;\"><a href=index.php?action=userinfo&usernik=".rawurlencode(@$lp[1]).">$onlinestatus<b>".@$lp[1]."</b></a></td><td align=left colspan=2><span class=lnk><a href=index.php?action=forum&fr=".$out[1]."&act=show&nr=".@$lp[3].">".@$lp[2]."</a></span></td></tr>";
}
}
        }
$forum_list.="</tbody></table></div>";
return $forum_list;
}



function showList() {
global $forum_admins;
global $image_path;
global $htpath;
global $fr;
global $lang;
global $nc0;
global $nc6;
global $nc10;
global $nc3;
global $details;
global $valid;
global $answer_ok;
global $antispam_type;
global $rand_st;
global $online_users;
global $dir_smiles;
global $fpage;
$mmax=2000;
if (@$valid=="1"){ $mmax=5000;}
$forum_list="
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
reset ($dir_smiles);
while (list($skey,$sval)=each($dir_smiles)) {
$forum_list.="if (Tag == ' ".$sval." ') { Open=Tag; Close = ''; } \n";
}
//$forum_list.=" if (Tag == ' :) ' || Tag == ' ;) '  || Tag == ' :d ' || Tag == ' :s ' || Tag == ' (h) ' || Tag == ' :\'( ' || Tag == ' :@ '|| Tag == ' (a) '|| Tag == ' :$ '|| Tag == ' :p '|| Tag == ' (b) ') { Open=Tag; Close = ''; } \n";

$forum_list.="
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
</script>";
global $datadir;
global $smileys;
global $antispam_q;
global $forum_name;
global $forum_perpage;
global $fpage;
global $speek;
$n = 0;
global $f_rules_text;
global $f_rules_link;
global $f_name;
global $f_desc;
global $f_asp;
global $f_reg;
global $f_ico;
global $f_tre;
global $dir_smiles;
global $stikytreads;
$cti="";

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
                        $list[$n][6] = $list[$n][0];
                        $list[$n][5] = "";
                        $list[$n][7] = "";
                        $idx=trim("$fr"."/topic".$file);
                        if (isset($stikytreads[$idx])) { $list[$n][0]=time()+$n; $list[$n][5] = "<i class=\"icon-map-marker\" title=\"".$lang[1491]."\"></i>"; $list[$n][7] = " ";}
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
$sf="";
if ($valid=="1") {$sf="<div style=\"padding:5px;\"><div style=\"padding:5px;\"><a href=\"$htpath/index.php?action=forum&act=search\"><i class=icon-search title=\"$lang[1077]\" hspace=5></i> </a><span class=lnk><a href=\"$htpath/index.php?action=forum&act=search\">$lang[1077]</a></span></div></div>";}
$validmoder=0;
$modbutton="";
$idx=$fr;
if (@$valid=="1") {
reset ($forum_admins[$idx]);
while (list($k,$v)=each ($forum_admins[$idx])) {
if ($v==$details[1]) {$validmoder=1;}
}
if ($details[7]=="ADMIN"){$validmoder=1;}
if ($details[7]=="MODER"){$validmoder=1;}
}
if ($validmoder==1) {
$modbutton="<td align=right><button onclick=\"location.href='".$htpath."/index.php?action=forum_admin&fr=$fr&act=list';\" onmouseover=\"this.style.backgroundColor='$nc10';\" onmouseout=\"this.style.backgroundColor='';\">MOD</button></td>";
}
$forum_list.="<script language=\"javascript\">
        function checkform () {
        var form=document.getElementById('forum_form');
          if (form[\"desc\"].value == \"\") {
            alert(\"".$lang[360]."\");
            form[\"desc\"].focus();
            return false ; }

        if (form[\"nick\"].value == \"\") {
                alert(\"".$lang[361]."\");
            form[\"nick\"].focus();
            return false ; }
          if (form[\"txt\"].value == \"\") {
            alert(\"".$lang[362]."\");
            form[\"txt\"].focus();
            return false ; }
            if (form[\"antispam_a".md5(date("d.m.Y"))."\"].value == \"\") {
            alert(\"".$lang[826]."\");
            form[\"antispam_a".md5(date("d.m.Y"))."\"].focus();
            return false ; }

          form.submit();
          }
        </script><div align=center class=box>
        <table border=0 style=\"width:100%;\" cellpadding=0 cellspacing=0 width=100%>
<tr><td colspan=5 align=left>
    <table class=table2 border=0 width=100% cellpadding=0 cellspacing=0><tr><td align=left class=pcont><a href=\"$htpath/index.php?action=forum\"><i class=icon-chevron-up title=\"".$lang[1002]."\"></i> </a><span class=lnk><a href=\"$htpath/index.php?action=forum\">".$lang[1002]."</a></span></td><td align=right style=\"white-space: nowrap;\" class=pcont>";
    if ($f_rules_link!="") {$forum_list.="<a href=$f_rules_link>$f_rules_text <i class=\"icon-warning-sign\"></i></a>"; }
    $forum_list.="</td></tr></table></td></tr>
        <tr><td colspan=5 align=left><table class=ocat1 border=0 width=100% cellpadding=10><tr><td align=left><img src=\"".$f_ico."\" border=0></td><td width=100% align=left class=pcont><font size=3><b><a href=$htpath/index.php?action=forum&fr=$fr&act=list>$f_name</a></b></font><br><span>$f_desc</span></td><td align=right valign=top width=150><nobr>$sf</nobr><br><img src=\"$image_path/pix.gif\" width=150 height=1></td>$modbutton</tr></table></td></tr>
        ";

$fppages="<center><div class=\"pagination\">
<ul>";
$j=1;
for ($i=0; $i<sizeof($list); $i=($i+$forum_perpage)) {

$link1="";
if ($j==($fpage+1)) {
$link1=" class=\"disabled\"";
}
$fppages.="<li".$link1."><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list&fpage=".($j-1)."\">".$j."</a></li>\n";

$j+=1;
}
$fppages.= "</ul></div></center>";

 if ($j>2) { $forum_list.="<tr><td align=center colspan=5>$fppages</td></tr>"; }
        $forum_list.="</table><table class=table><tr>
          <td width=50% align=left><b>".$lang[364]."</b></td>
          <td align=center><b>".$lang[363]."</b></td>
          <td align=center><b>".$lang[365]."</b></td>
          <td align=center colspan=2><b>".$lang[366]."</b></td></tr>";


if ($fpage>=sizeof($list)) {$fpage=(sizeof($list)-$forum_perpage);}
        for ($i=($fpage*$forum_perpage); $i<($fpage*$forum_perpage+$forum_perpage); $i++) {
        if (!isset($list[$i][3])) {
        } else {
         $tname="";
        if (!file_exists("./forum/forumstat/$fr/t_".$list[$i][3].".txt")) {$tname="";} else {
        $fp=fopen("./forum/forumstat/$fr/t_".$list[$i][3].".txt","r");
$tname=fread($fp,1024);
fclose($fp);}
        $co="";
        if (@$valid=="1"){
        if (!file_exists("./forum/userstat/".$details[1]."/$fr/".$list[$i][3].".txt")) {$co=1; $cti="NEW TOPIC";} else {
        $fp=fopen("./forum/userstat/".$details[1]."/$fr/".$list[$i][3].".txt","r");
$cotime=doubleval(fread($fp,1024));
fclose($fp);
if (doubleval(filemtime("./forum/data/$fr/topic".$list[$i][3].".txt"))!=$cotime) {
$co="icon-star"; $cti="NEW MESSAGES";} else {
$co=""; $cti="";
}
        }
        } else { $co="";}
        $modbutton="";
        $ffpagee="";
        $onkl=" onclick=\"location.href='".$htpath."/index.php?action=forum&fr=$fr&act=show&nr=".$list[$i][3]."';\"";
        $onkl2=" style=\"cursor: pointer; cursor: hand; text-decoration: none;\"";
        if ($list[$i][4]>$forum_perpage) {
        $zz=ceil($list[$i][4]/$forum_perpage);
        $z=0;

        $onkl="";
        $onkl2="";
        $ffpagee="<div class=\"pagination\" style=\"margin-top:5px;margin-bottom:0px;\"><ul>";
        while ($z<$zz) {
        $fftmp[]="<li><a href=\"".$htpath."/index.php?action=forum&fr=$fr&act=show&nr=".$list[$i][3]."&fpage=".$z."\" title=\"".($z+1)."\">".($z+1)."</a></li>\n";
        $z++;
        }
        $ffpagee.=implode("",$fftmp);
        unset ($fftmp);
        }
        $ffpagee.= "</ul></div>";
        if ($validmoder==1) {


                 $forum_list.= "        <tr".$list[$i][7]." class=searchitem".$onkl2.">\n";
                 $forum_list.= "        <td width=50% align=left".$onkl." class=pcont>".$list[$i][5]."
<i class=\"$co\" title=\"$cti\"></i><a href=?action=forum&fr=$fr&act=show&nr=".$list[$i][3]."> ".$list[$i][2]."</a>$ffpagee</td>\n";
if (!isset($online_users[$list[$i][1]])) {$onlinestatus="<i class=icon-user title=Offline></i> "; } else {$onlinestatus="<i class=icon-ok title=Online></i> ";}

                $forum_list.="        <td  onclick=\"location.href='".$htpath."/index.php?action=forum&fr=$fr&act=show&nr=".$list[$i][3]."';\"align=center><a href=index.php?action=userinfo&usernik=".rawurlencode($list[$i][1]).">$onlinestatus<b>".$list[$i][1]."</b></a></td>\n";
                 $modbutton="<td align=right><button onclick=\"location.href='".$htpath."/index.php?action=forum_admin&fr=$fr&act=show&nr=".$list[$i][3]."';\" onmouseover=\"this.style.backgroundColor='$nc10';\" onmouseout=\"this.style.backgroundColor='';\">MOD</button></td>";
if ($tname!="") { $ttname="<b>".$tname."</b> <i class=\"icon-share-alt\"></i><br>"; } else {$ttname=""; }
 $forum_list.= "        <td align=center onclick=\"location.href='".$htpath."/index.php?action=forum&fr=$fr&act=show&nr=".$list[$i][3]."';\">".$list[$i][4]."</td><td align=center><img src=$image_path/pix.gif width=100 height=1 border=0><br><span>".$ttname.date("d.m.Y", $list[$i][6])." ".date("H:i", $list[$i][6])."</span></td>$modbutton</tr>\n\n";


 } else {


                 $forum_list.= "        <tr".$list[$i][7]." class=searchitem".$onkl2. $onkl.">\n";
                 $forum_list.= "        <td width=50% align=left class=pcont>".$list[$i][5]."
<i class=\"$co\" title=\"$cti\"></i> <a href=?action=forum&fr=$fr&act=show&nr=".$list[$i][3].">".$list[$i][2]."</a>$ffpagee</td>\n";
if (!isset($online_users[$list[$i][1]])) {$onlinestatus="<i class=icon-user title=Offline></i> "; } else {$onlinestatus="<i class=icon-ok title=Online></i> ";}

                $forum_list.="        <td align=center><a href=index.php?action=userinfo&usernik=".rawurlencode($list[$i][1]).">$onlinestatus<b>".$list[$i][1]."</b></a></td>\n";
if ($tname!="") { $ttname="<b>".$tname."</b> <i class=\"icon-share-alt\"></i><br>"; } else {$ttname=""; }
                               $forum_list.= "        <td align=center>".$list[$i][4]."</td><td align=center colspan=2><img src=$image_path/pix.gif width=100 height=1 border=0><br><span>".$ttname.date("d.m.Y", $list[$i][6])." ".date("H:i", $list[$i][6])."</span></td></tr>\n\n";


 }


 }
        }
        if (($f_reg==1)&&($valid!="1")) { $forum_list.="</table>";
         if ($j>2) { $forum_list.="$fppages"; }

        $forum_list.=" <br>"; } else {
        if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) { $f_tre=1; }

        if ($f_tre==0) { $forum_list.="</table>"; } else {
$forum_list.="</table><table width=100% border=0><tr><td align=left colspan=5 style=\"white-space: nowrap;\" class=pcont>
        ";
         if ($j>2) { $forum_list.="$fppages"; }

        $forum_list.=" <br>
        <form class=form-inline action=\"$htpath/index.php\" method=\"post\" name=\"form\" id=\"forum_form\">
        <input type=\"hidden\" name=\"action\" value=\"forum\">
        <input type=\"hidden\" name=\"fr\" value=\"$fr\">
        <input type=\"hidden\" name=\"act\" value=\"addt\">
        <input type=\"hidden\" name=\"nr\" value=\"" . ($max+1) ."\">
        ";
    if ($f_rules_link!="") {$forum_list.="<a href=$f_rules_link>$f_rules_text <i class=\"icon-warning-sign\"></i></a>"; }

    $forum_list.="
        <tr><td colspan=5 align=left>
        <table width=100% border=0>
        <tr><td colspan=4 align=left><h4>".$lang[356].":</h4></td></tr>
        <tr><td style=\"vertical-align:middle\" align=left><b>".$lang[357].":</b></td><td colspan=3 align=left><input type=\"text\" name=\"nick\" maxlength=40 value=\"$forum_name\" style=\"width:90%\"></td></tr>
        <tr><td style=\"vertical-align:middle\" align=left><b>".$lang[358].":</b></td><td colspan=3 align=left><input type=\"text\" size=\"55\" name=\"desc\" maxlength=\"80\" style=\"width:90%\"></td></tr>";


               $forum_list.= "<tr><td align=left></td><td colspan=4 align=left>\n";
               reset ($dir_smiles);
               while (list($skey,$sval)=each($dir_smiles)) {
        $forum_list.="<a href=\"#null\"><img src=smileys/".$skey." hspace=2 border=0 onClick=\"click_bb('textarea',' ".$sval." ');\" title=\"".strtoken($sval,".")."\"></a> ";
        }
        /* $forum_list.="

        <a href=\"#null\"><img src=smileys/smile.png hspace=2 border=0 onClick=\"click_bb('textarea',' :) ');\"></a>
        <a href=\"#null\"><img src=smileys/wink.png hspace=2 border=0 onClick=\"click_bb('textarea',' ;)' );\"></a>
        <a href=\"#null\"><img src=smileys/laugh.png hspace=2 border=0 onClick=\"click_bb('textarea',' :d ');\"></a>
        <a href=\"#null\"><img src=smileys/doubt.png hspace=2 border=0 onClick=\"click_bb('textarea',' :s ');\"></a>
        <a href=\"#null\"><img src=smileys/hot.png hspace=2 border=0 onClick=\"click_bb('textarea',' (h) ');\"></a>
        <a href=\"#null\"><img src=smileys/tears.png hspace=2 border=0 onClick=\"click_bb('textarea',' :\'( ');\"></a>
        <a href=\"#null\"><img src=smileys/angry.png hspace=2 border=0 onClick=\"click_bb('textarea',' :@ ');\"></a>
        <a href=\"#null\"><img src=smileys/angel.png hspace=2 border=0 onClick=\"click_bb('textarea',' (a) ');\"></a>
        <a href=\"#null\"><img src=smileys/bloss.png hspace=2 border=0 onClick=\"click_bb('textarea',' :$ ');\"></a>
        <a href=\"#null\"><img src=smileys/tongue.png hspace=2 border=0 onClick=\"click_bb('textarea',' :p ');\"></a>
        <a href=\"#null\"><img src=smileys/beer.png hspace=8 border=0 onClick=\"click_bb('textarea',' (b) ');\"></a>
        ";
        */
                $forum_list.= "</td></tr>\n";
//include ("antispam.php");
 $forum_list.="<tr><td style=\"padding-top:8px\" valign=top align=left>".$lang[85].":<br><br><span>(Max <b>$mmax</b>)</span></td>
        <td colspan=3 align=left><input type=hidden name=\"fpage\" value=$fpage><textarea rows=\"10\" cols=\"50\" name=\"txt\" maxlength=$mmax style=\"width:90%\" id=\"textarea\"></textarea>
        </td></tr>
        <tr><td align=left></td><td colspan=3 align=left>";
if (@$valid=="1"){
if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {
$forum_list.="<input type=\"hidden\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"111\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\">";
 } else {
 if (@$f_asp==0){
 $forum_list.="<input type=\"hidden\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"111\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\">";
 } else {
$forum_list.="<fieldset>
<legend><i>".$lang[826]."</i></legend>
  <br><table border=0 width=100%><tr><td align=right valign=top><b>$lang[796]:</b></td><td valign=top width=100% align=left><i>$antispam_q?</i></td></tr>
  <tr><td align=right valign=top><b>$lang[805]:</b></td><td valign=top align=left><input type=\"text\" style=\"width:90%\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\"><br><span><i>$antispam_type</i></span></td></tr>
  </table><br></fieldset>";
 }
 }
 } else {
 $forum_list.="<fieldset>
<legend><i>".$lang[826]."</i></legend>
  <br><table border=0 width=100%><tr><td align=right valign=top><b>$lang[796]:</b></td><td valign=top width=100% align=left><i>$antispam_q?</i></td></tr>
  <tr><td align=right valign=top><b>$lang[805]:</b></td><td valign=top align=left><input type=\"text\" style=\"width:90%\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\"><br><span><i>$antispam_type</i></span></td></tr>
  </table><br></fieldset>";
 }
 $forum_list.="</form><table border=0><tr><td colspan=2 align=left class=pcont>";
if (@$valid=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) { $forum_list.="<br><span onclick=\"click_bb('textarea','a')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=4&dest=textar','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')\" title=\"$lang[938]\"><img src=\"$image_path/picture.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b', '')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','center','')\" title=\"$lang[936]\"><img src=\"$image_path/align_center.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>&nbsp;
<span onClick=\"javascript:window.open('$htpath/admin/attachments.php?speek=$speek&gtype=4&dest=textar','att','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')\" title=\"$lang[741]: ZIP, RAR, PDF, DOC, XLS\"><img src=\"$image_path/mini_zip.png\"></span>&nbsp;
";} else {
$forum_list.="<br><span onclick=\"click_bb('textarea','a','')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img','')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b','')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>";}
} else {
$forum_list.="<br><span onclick=\"click_bb('textarea','a','')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img','')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b','')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>";
}
$forum_list.="</td></tr>
          </table><p><br><input class=\"btn btn-large btn-primary\" type=\"button\" onclick=\"checkform();\" value=\"".$lang[367]."\"></td>
    </tr></table>
    </td></tr></table></div>

";
}
}
return $forum_list;
}

//----------------------------------------------------------------------------------------------
// show the specified topic list and add answer form
//----------------------------------------------------------------------------------------------

function showTopic($nr) {
global $forum_admins;
global $image_path;
global $htpath;
global $lang;
global $details;
global $valid;
global $antispam_q;
global $answer_ok;
global $antispam_type;
global $rand_st;
global $nc6;
global $nc10;
global $fr;
global $avas;
global $fpage;
global $online_users;
global $dir_smiles;
global $speek;
global $forum_perpage;
$mmax=2000;

if (@$valid=="1"){if ($details[1]!="") {
if (!is_dir("./forum/userstat")) { mkdir("./forum/userstat",0755); }
if (!is_dir("./forum/userstat/".$details[1])) { mkdir("./forum/userstat/".$details[1],0755); }
if (!is_dir("./forum/userstat/".$details[1]."/$fr")) { mkdir("./forum/userstat/".$details[1]."/$fr",0755); }
$fp=fopen("./forum/userstat/".$details[1]."/$fr/$nr.txt","w");
fputs($fp,filemtime("./forum/data/".$fr."/topic".$nr.".txt"));
fclose($fp);
}
$mmax=5000; }

global $nc0;
$forum_list="<script type=\"text/javascript\">
function click_bb(aid,Tag,author) {
var f = '';
if (Tag == 'a') f = ' href=\'' + prompt('$lang[928]:') + '\'';
if (Tag == 'quote') f = '='+ author+ ']' + prompt(author+':') + '[/quote';
if (Tag == 'img') f =']' + prompt('$lang[926]:') + '[/img';

 var Open='['+Tag+f+']';
 var Close='[/'+Tag+']';
if (Tag == 'img' || Tag == 'cut' || Tag == 'quote' ) { Close = ''; }
";
reset ($dir_smiles);
while (list($skey,$sval)=each($dir_smiles)) {
$forum_list.="if (Tag == ' ".$sval." ') { Open=Tag; Close = ''; } \n";
}
//$forum_list.=" if (Tag == ' :) ' || Tag == ' ;) '  || Tag == ' :d ' || Tag == ' :s ' || Tag == ' (h) ' || Tag == ' :\'( ' || Tag == ' :@ '|| Tag == ' (a) '|| Tag == ' :$ '|| Tag == ' :p '|| Tag == ' (b) ') { Open=Tag; Close = ''; } \n";

$forum_list.="
 var doc = document.getElementById(aid);
    if (window.attachEvent && navigator.userAgent.indexOf('Opera') === -1) {
        doc.focus();
        sel = document.selection.createRange();
        sel.text = Open+sel.text+Close;
        doc.focus();
  }  else {
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
</script>";
    global $datadir;
    global $smileys;
    global $forum_name;
    global $nc2;
    global $nc3;
    global $nc4;
    global $nc5;
    global $_COOKIE;
    global $artrnd;
    global $speek;
    global $secret_salt;
    global $poll_ip_enable;
    $n = 0;
global $f_name;
global $f_desc;
global $f_rules_text;
global $f_rules_link;
global $f_asp;
global $f_reg;
global $f_ico;
global $f_adm;
global $me;
$onlinestatus="";
$fppages="";
$fppages="<br><br><center><div align=center><b>$lang[105]:</b> <font size=2>";
$j=1;
  $topic = array();
  if (file_exists($datadir."$fr/topic".$nr.".txt")) {
    $fp = fopen($datadir."$fr/topic".$nr.".txt", "r");
    $description = str_replace("\n","",fgets($fp, 1024));
    while (!feof($fp)) {



        $date = fgets($fp, 1024);
        $usname = fgets($fp, 1024);
        $nickname = strtoken($usname,"|");
        $text = fgets($fp, 9000);
        if ($date && $nickname && $text) {
        if (($n<($fpage*$forum_perpage+$forum_perpage))&&($n>=$fpage*$forum_perpage)) {
            $topic[$n][0] = str_replace("\n","",$date);
            $topic[$n][1] = str_replace("\n","",$nickname);
            $topic[$n][2] = str_replace("\n","",$text);
            $ed[$n][2] = $text;
            $user[$n] = str_replace("\n","",$usname);
            }
            $n++;
        }

    }
  fclose($fp);

$fppages="<center><div class=\"pagination\">
<ul>";
$j=1;
for ($i=0; $i<$n; $i=($i+$forum_perpage)) {

$link1="";
if ($j==($fpage+1)) {
$link1=" class=\"disabled\"";
}
$fppages.="<li".$link1."><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list&fpage=".($j-1)."\">".$j."</a></li>\n";

$j+=1;
}
$fppages.= "</ul></div></center>";
$sf="";
if ($valid=="1") {$sf="<div style=\"padding:5px;\"><div style=\"padding:5px;\"><a href=\"$htpath/index.php?action=forum&act=search\"><i class=icon-search title=\"$lang[1077]\" hspace=5></i> </a><span class=lnk><a href=\"$htpath/index.php?action=forum&act=search\">$lang[1077]</a></span></div></div>"; }
$validmoder=0;
$modbutton="";
$idx=$fr;
if (@$valid=="1") {
reset ($forum_admins[$idx]);
while (list($k,$v)=each ($forum_admins[$idx])) {
if ($v==$details[1]) {$validmoder=1;}
}
if ($details[7]=="ADMIN"){$validmoder=1;}
if ($details[7]=="MODER"){$validmoder=1;}
}
if ($validmoder==1) {
$modbutton="<td align=right><button onclick=\"location.href='".$htpath."/index.php?action=forum_admin&fr=$fr&nr=$nr&act=show';\" onmouseover=\"this.style.backgroundColor='$nc10';\" onmouseout=\"this.style.backgroundColor='';\">MOD</button></td>";
}
$forum_list.="<script language=\"javascript\">
    function checkform () {
    var form=document.getElementById('forum_form');
     if (form[\"nick\"].value == \"\") {
      alert(\"".$lang[361]."\");
      form[\"nick\"].focus();
      return false ; }
    if (form[\"txt\"].value == \"\") {
        alert(\"".$lang[362]."\");
      form[\"txt\"].focus();
      return false ; }
      if (form[\"antispam_a".md5(date("d.m.Y"))."\"].value == \"\") {
      alert(\"".$lang[826]."\");
      form[\"antispam_a".md5(date("d.m.Y"))."\"].focus();
      return false ; }
     document.getElementById('forum_form').submit(); }
    </script><table border=0 class=box style=\"width:100%;\" cellpadding=0 cellspacing=0 width=100%>
<tr><td colspan=7 align=left>
    <table border=0 width=100% cellpadding=8 cellspacing=0><tr><td align=left><a name=top></a><a href=\"$htpath/index.php?action=forum\"><i class=icon-chevron-up title=\"".$lang[1002]."\"></i> </a><span class=lnk><a href=\"$htpath/index.php?action=forum\">".$lang[1002]."</a></span></td><td align=right><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list\"><i class=icon-chevron-left title=\"".$lang['back']."\"></i> </a><span class=lnk><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list\">".$lang['back']."</a></span></td></tr></table></td></tr>
    <tr><td colspan=3 align=left><table class=ocat1 border=0 width=100% cellpadding=5><tr><td align=left><img src=\"".$f_ico."\" border=0 hspace=10></td><td width=100% align=left class=pcont><font size=3><b><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list\">$f_name</a></b></font><br><span>$f_desc</span></td><td align=right valign=top width=150><nobr>$sf</nobr><br><img src=\"$image_path/pix.gif\" width=150 height=1></td>$modbutton</tr>
    <tr><td align=left><b><font size=2>".$lang[368].":&nbsp;</font></b></td><td align=left><h4>$description</h4></td><td align=left>";

    if ($me!="") {$forum_list.="<b>".$lang[85].": #$fr"."-"."$nr"."-"."$me</b>";}
$forum_list.="</td><td style=\"white-space: nowrap;\" align=right class=pcont>";
    if ($f_rules_link!="") {$forum_list.="<a href=$f_rules_link>$f_rules_text <i class=\"icon-warning-sign\"></i></a>"; }
    $forum_list.="</td></tr></table></td></tr>

";
if ($me=="") { $forum_list.="<tr><td align=center colspan=3 align=left>";
         if ($j>2) { $forum_list.="$fppages"; }

        $forum_list.="</td></tr>";  }

        $forum_list.="</table><table class=\"table\" width=100% border=0><tbody>";
    for ($i=($fpage*$forum_perpage); $i < ($fpage*$forum_perpage+$forum_perpage); $i++) {
    if ($i>=$n) { break; }
        if ($i/2 ==round($i/2)) { $forum_list.="<tr bgcolor=".lighter($nc0,-5).">\n"; }
        else { $forum_list.= "<tr bgcolor=".lighter($nc0,10).">\n"; }
        $con=parse_text($topic[$i][2]); $poll_exp="<br>"; require "./modules/mod_poll.php"; $topic[$i][2]=$con;
        //echo $user[$i]."<br>";
        $userdetails=explode("|", $user[$i]."|||||");
        //echo $userdetails[1].$userdetails[2]."$f_adm<br>";

        $senduser="";
        $unum=0;
        if(doubleval($userdetails[1])!=0) {
        $unum=1;

$umd=md5($userdetails[2]);
$udir=substr($umd,0,3);
if (!is_dir("./forum/forumstat")) { mkdir("./forum/forumstat",0755); }
if (!is_dir("./forum/forumstat/users")) { mkdir("./forum/forumstat/users",0755); }
if (!is_dir("./forum/forumstat/users/$udir")) { mkdir("./forum/forumstat/users/$udir",0755); }

$ufile="./forum/forumstat/users/$udir/a_$umd.txt";
if (file_exists($ufile)) {
$fp=fopen($ufile,"r"); $unum=doubleval(fread($fp,1024)); fclose($fp);
}
$unums="<br><font color=#999999>[$unum]</font>";
} else { $unums=""; }
$login=$topic[$i][1];
if ($unum<=1) {$unums=""; }
if(doubleval($userdetails[1])!=0) {
if ($unum>=1) {$unums="<div title=\"".$lang[1001].": $unum\"><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i></div><br>$lang[1063]";
if ($valid=="1") {
$senduser="<br><a href=\"#Send Private Message\" onClick=\"javascript:window.open('chat.php?ch=main&privat=".rawurlencode($login)."&speek=$speek','".md5($login."chat")."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10')\"><img src=\"$image_path/sm.png\" title=\"$lang[1075]\" border=0 align=absmiddle></a> &nbsp; <a href=\"$htpath/index.php?query=forum&f_user=".rawurlencode($login)."&onlyforum=1\"><img src=\"$image_path/sf.png\" border=0 title=\"$lang[1089]\" align=absmiddle></a>";
}
}
if ($unum>=$lang[1064]) {$unums="<div title=\"".$lang[1001].": $unum\"><i class=icon-star></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i></div>$lang[1065]";}
if ($unum>=$lang[1066]) {$unums="<div title=\"".$lang[1001].": $unum\"><i class=icon-star></i><i class=icon-star></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i></div>$lang[1067]";}
if ($unum>=$lang[1068]) {$unums="<div title=\"".$lang[1001].": $unum\"><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i><i class=\"icon-star-empty icon-white\"></i><i class=\"icon-star-empty icon-white\"></i></div>$lang[1069]";}
if ($unum>=$lang[1070]) {$unums="<div title=\"".$lang[1001].": $unum\"><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i><i class=\"icon-star-empty icon-white\"></i></div>$lang[1071]";}
if ($unum>=$lang[1072]) {$unums="<div title=\"".$lang[1001].": $unum\"><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i></div>$lang[1073]";}
if (!isset($online_users[@$userdetails[2]])) {$onlinestatus=""; } else {$onlinestatus="<i class=icon-ok title=Online></i> ";}

 if (count($f_adm)>0) {
 if (isset($f_adm[trim($userdetails[2])])) {
 $unums="<div title=\"".$lang[1001].": $unum\"><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i><i class=icon-star></i></div><font color=#b94a48>$lang[1074]</font>";
 }
 } } else { $unums=$lang[193]; }

 if (isset($f_adm[trim($details[1])])) {
 $fcolor=$nc3;
 $ip=@$userdetails[4];
  $tmp3=explode(".",$ip);
$ftitle="";
$ipfile="./admin/bannedip/".implode("/",$tmp3)."/banned.txt";
if (file_exists($ipfile)) { $fcolor="red"; $ftitle=" title=\"$lang[1525]\"";}

 $unums.="<br><a href=\"#Whois\" onclick=\"javascript:window.open('$htpath/whois.php?t=".md5("$ip"."$htpath"."$secret_salt")."&t2=".md5("$ip"."$htpath"."$secret_salt".@$userdetails[0])."&ip=".rawurlencode($ip)."&n=".rawurlencode(@$userdetails[0])."','".md5("$ip"."$htpath"."$secret_salt")."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=560,left=10,top=10')\"><font color=$fcolor size=1"."$ftitle>".$ip."</font></a><br>
 <i>";
 if (($details[7]=="ADMIN")||($details[7]=="MODER")) { $unums.="<a href=\"$htpath/index.php?action=view_users&userfile=3&usernik=".$userdetails[2]."&usersort=no&filter=&usertype=\">".$userdetails[3]."</a></i>";
 if ($unum>0) { $unums.="<br><a href=\"index.php?nt=forum/forumstat/users/".$udir."&t=a_".$umd."&action=template\"><b>".$lang['edits'].":</b> ".$unum."</a>"; }} else { if (($userdetails[7]=="ADMIN")||($userdetails[7]=="MODER"))  { $unums.=$userdetails[3]; } $unums.="</i>"; }
 }
 $ava_image="";

                $idx=$login;
                if (!isset($avas[$idx])){
if (file_exists("./admin/userstat/$login/$login.ava")==true) {
$afp=fopen("./admin/userstat/$login/$login.ava", "r");
$ava_image=fread($afp,filesize("./admin/userstat/$login/$login.ava"));
fclose ($afp);
$avas[$idx]=$ava_image;
}
} else {
$ava_image=$avas[$idx];
}
if ($ava_image!="") {$ava_image="<br><a href=\"$htpath/index.php?action=userinfo&usernik=".rawurlencode($login)."\"><img src=\"gallery/avatars/$ava_image\" border=0 title=\"$login\" class=img></a><br>";} else {
$ava_image="<br><a href=\"$htpath/index.php?action=userinfo&usernik=".rawurlencode($login)."\"><img src=\"images/default_user.png\" border=0 title=\"$login\" class=img></a><br>";
}
$editbut="";
if ($validmoder==1) {$editbut="<div id=\"button".$nr."_".$i."\"><button type=button class=btn onclick=\"javascript:js".$nr."_".$i."();\" title=\"".$lang['ch']."\"><font color=#468847>V</font>&nbsp;&nbsp;".$lang['edits']."</button> <button type=button class=btn onclick=\"javascript:jss".$nr."_".$i."();\" title=\"".$lang['del']."\"><font color=#b94a48>X</font>&nbsp;&nbsp;".$lang['del']."</button></div>

<div id=\"divv".$nr."_".$i."\" style=\"display:none; visibility:hidden;\">
<form class=form-inline action=\"index.php#me".$i."\" method=\"POST\">
                <input name=\"action\" value=\"forum\" type=\"hidden\">
                <input name=\"fr\" value=\"$fr\" type=\"hidden\">
                <input name=\"fpage\" value=\"$fpage\" type=\"hidden\">
                <input name=\"act\" value=\"change\" type=\"hidden\">
                <input name=\"nr\" value=\"$nr\" type=\"hidden\">
                <input name=\"ans\" value=\"$i\" type=\"hidden\">
	<div class=round2>
                <textarea name=\"edtxt\" style=\"width:100%\" rows=\"10\" cols=\"48\">".str_replace("\\","",stripslashes(str_replace("<br>","\n",$ed[$i][2])))."</textarea>
		<div align=center><br><a href=\"#a\" class=btn onclick=\"javascript:js".$nr."_".$i."();\">".$lang['back']."</a> <input value=\"".$lang['ch']."\" type=\"submit\" class=\"btn btn-primary\">
        </div>
    </div>
</form>
</div>

<div id=\"di".$nr."_".$i."\" style=\"display:none; visibility:hidden;\">
<form class=form-inline action=\"index.php#me".$i."\" method=\"POST\">
                <input name=\"action\" value=\"forum\" type=\"hidden\">
                <input name=\"fr\" value=\"$fr\" type=\"hidden\">
                <input name=\"fpage\" value=\"$fpage\" type=\"hidden\">
                <input name=\"act\" value=\"dela\" type=\"hidden\">
                <input name=\"nr\" value=\"$nr\" type=\"hidden\">
                <input name=\"ans\" value=\"$i\" type=\"hidden\">
	<div class=round2>
		<div align=center><font color=#b94a48><b>$lang[746]</b></font>
    	</div>
		<div align=center><br><input value=\"".$lang['yes']."\" type=\"submit\" class=\"btn btn-primary\">&nbsp;<input class=btn type=button value=\"".$lang['no']."\" onclick=\"javascript:jss".$nr."_".$i."();\">
        </div>
	</div>
</form>
</div>
                <script language=javascript>
                function js".$nr."_".$i."() {
                if ( document.getElementById('button".$nr."_".$i."').style.visibility=='hidden' ) {
                document.getElementById('tx".$nr."_".$i."').style.visibility='visible';
                document.getElementById('tx".$nr."_".$i."').style.display='inline';
                document.getElementById('button".$nr."_".$i."').style.visibility='visible';
                document.getElementById('button".$nr."_".$i."').style.display='inline';
                document.getElementById('divv".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('divv".$nr."_".$i."').style.display='none';
                } else {
                document.getElementById('tx".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('tx".$nr."_".$i."').style.display='none';
                document.getElementById('button".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('button".$nr."_".$i."').style.display='none';
                document.getElementById('divv".$nr."_".$i."').style.visibility='visible';
                document.getElementById('divv".$nr."_".$i."').style.display='inline';
                document.getElementById('di".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('di".$nr."_".$i."').style.display='none';
                }
                }
                function jss".$nr."_".$i."() {
                if ( document.getElementById('button".$nr."_".$i."').style.visibility=='hidden' ) {
                document.getElementById('button".$nr."_".$i."').style.visibility='visible';
                document.getElementById('button".$nr."_".$i."').style.display='inline';
                document.getElementById('di".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('di".$nr."_".$i."').style.display='none';
                document.getElementById('divv".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('divv".$nr."_".$i."').style.display='none';
                } else {
                document.getElementById('button".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('button".$nr."_".$i."').style.display='none';
                document.getElementById('di".$nr."_".$i."').style.visibility='visible';
                document.getElementById('di".$nr."_".$i."').style.display='inline';
                }
                }
                </script>";
                }
if ($login==$details[1]){$senduser="";}
if ($me=="") {
        $forum_list.="<td valign=top width=10% align=middle><a name=\"me$i\"></a><img src=$image_path/pix.gif width=128 height=1 border=0>$ava_image<b class=lnk>$onlinestatus<a href=#null onClick=\"click_bb('textarea','quote','".$topic[$i][1]."');\" title=\"$lang[1039]\">".$topic[$i][1]." <i class=\"icon-share-alt\"></i></a></b><br><span>$unums</span>$senduser</td>\n";
        $unums="";
        $forum_list.= "<td colspan=\"2\" valign=top align=left class=pcont>$editbut<div align=right><span><b>$lang[371]:</b> ".date("d.m.Y", $topic[$i][0])." <b>".date("H:i", $topic[$i][0])."</b></span></div>\n<div id=\"tx".$nr."_".$i."\">".$topic[$i][2]."</div>\n\n<div align=right><span class=lnk><a href=\"$htpath/index.php?action=forum&fr=$fr&act=show&nr=$nr&me=".$i."\" title=\"$lang[106]\">$lang[85] #".$fr."-".$nr."-".$i."</a> <a href=\"#top\"><i class=\"icon-chevron-up\" title=\"$lang[1076]\"></i></a></span></div></td></tr>\n\n";
} else {
if ($me==$i) {
        $forum_list.="<td valign=top width=10% align=middle class=pcont><a name=\"me$i\"></a><img src=$image_path/pix.gif width=128 height=1 border=0>$ava_image<b class=lnk>$onlinestatus<a href=#null onClick=\"click_bb('textarea','quote','".$topic[$i][1]."');\" title=\"$lang[1039]\">".$topic[$i][1]." <i class=\"icon-share-alt\"></i></a></b><br><span>$unums</span>$senduser</td>\n";
        $unums="";
        $forum_list.= "<td colspan=\"2\" valign=top align=left class=pcont>$editbut<div align=right><span><b>$lang[371]:</b> ".date("d.m.Y", $topic[$i][0])." <b>".date("H:i", $topic[$i][0])."</b></span></div>\n<div id=\"tx".$nr."_".$i."\">".$topic[$i][2]."</div>\n\n</td></tr>\n\n";
}
}
    }
$forum_list.= "</table><table border=0 width=100%>";
     if ($me=="") { if ($j>2) { $forum_list.="<tr><td colspan=3 align=left>$fppages</td></tr>"; } }
    if (($f_reg==1)&&($valid!="1")) { $forum_list.="</table>"; } else {
    if ($me=="") {
$forum_list.="<tr><td colspan=3 align=right style=\"white-space: nowrap;\" class=pcont>";
    if ($f_rules_link!="") {$forum_list.="<a href=$f_rules_link>$f_rules_text <i class=\"icon-warning-sign\"></i></a>"; }
    $forum_list.="</td></tr>";
    $forum_list.="<tr><td colspan=3 align=left>

    <form name=\"form\" action=\"$htpath/index.php\" method=\"post\" id=\"forum_form\">
    <input type=\"hidden\" name=\"action\" value=\"forum\">
    <input type=\"hidden\" name=\"fr\" value=\"$fr\">
    <input type=\"hidden\" name=\"act\" value=\"adda\">
    <input type=\"hidden\" name=\"nr\" value=\"$nr\">
    <table width=100% border=0>
    <tr><td align=left><td><td align=left></td></tr>
    <tr><td colspan=3 align=left><h4>".$lang[359].":</h4></td></tr>
    <tr><td style=\"vertical-align:middle\" align=left><b>".$lang[357].":</b></td>
    <td colspan=2 align=left><input type=\"text\" name=\"nick\" value=\"$forum_name\" maxlength=40 style=\"width:90%\"></td></tr>";
        $forum_list.= "    <tr><td align=left></td><td colspan=3 align=left>\n";
        reset ($dir_smiles);
        while (list($skey,$sval)=each($dir_smiles)) {
        $forum_list.="<a href=\"#null\"><img src=smileys/".$skey." hspace=2 border=0 onClick=\"click_bb('textarea',' ".$sval." ');\" title=\"".strtoken($sval,".")."\"></a> ";
        }
    /* $forum_list.="

    <a href=\"#null\"><img src=smileys/smile.png hspace=2 border=0 onClick=\"click_bb('textarea',' :) ','');\"></a>
    <a href=\"#null\"><img src=smileys/wink.png hspace=2 border=0 onClick=\"click_bb('textarea',' ;) ' ,'');\"></a>
    <a href=\"#null\"><img src=smileys/laugh.png hspace=2 border=0 onClick=\"click_bb('textarea',' :d ','');\"></a>
    <a href=\"#null\"><img src=smileys/doubt.png hspace=2 border=0 onClick=\"click_bb('textarea',' :s ','');\"></a>
    <a href=\"#null\"><img src=smileys/hot.png hspace=2 border=0 onClick=\"click_bb('textarea',' (h) ','');\"></a>
    <a href=\"#null\"><img src=smileys/tears.png hspace=2 border=0 onClick=\"click_bb('textarea',' :\'( ','');\"></a>
    <a href=\"#null\"><img src=smileys/angry.png hspace=2 border=0 onClick=\"click_bb('textarea',' :@ ','');\"></a>
    <a href=\"#null\"><img src=smileys/angel.png hspace=2 border=0 onClick=\"click_bb('textarea',' (a) ','');\"></a>
    <a href=\"#null\"><img src=smileys/bloss.png hspace=2 border=0 onClick=\"click_bb('textarea',' :$ ','');\"></a>
    <a href=\"#null\"><img src=smileys/tongue.png hspace=2 border=0 onClick=\"click_bb('textarea',' :p ','');\"></a>
    <a href=\"#null\"><img src=smileys/beer.png hspace=8 border=0 onClick=\"click_bb('textarea',' (b) ','');\"></a>
    ";
    */
        $forum_list.= "    </td></tr>\n";
$forum_list.="    <tr><td style=\"padding-top:8px\" valign=top align=left>".$lang[85].":<br><br><span>(Max <b>$mmax</b>)</span></td>
    <td colspan=2 align=left><input type=hidden name=\"fpage\" value=$fpage><textarea rows=\"10\" cols=\"50\" name=\"txt\" maxlength=$mmax style=\"width:90%\" id=\"textarea\"></textarea>
    </td></tr>
    <tr><td align=left></td><td align=left>";
if (@$valid=="1"){
if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {
$forum_list.="<input type=\"hidden\" style=\"width:90%\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"111\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\">";
 } else {
 if (@$f_asp==0){
 $forum_list.="<input type=\"hidden\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"111\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\">";
} else {
$forum_list.="<fieldset>
<legend><i>".$lang[826]."</i></legend>
  <br><table border=0 width=100%><tr><td align=right valign=top><b>$lang[796]:</b></td><td valign=top width=100% align=left><i>$antispam_q?</i></td></tr>
  <tr><td align=right valign=top><b>$lang[805]:</b></td><td valign=top align=left><input type=\"text\" style=\"width:90%\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\"><br><span><i>$antispam_type</i></span></td></tr>
  </table><br></fieldset>";
  }
 }} else {
 $forum_list.="<fieldset>
<legend><i>".$lang[826]."</i></legend>
  <br><table border=0 width=100%><tr><td align=right valign=top><b>$lang[796]:</b></td><td valign=top width=100% align=left><i>$antispam_q?</i></td></tr>
  <tr><td align=right valign=top><b>$lang[805]:</b></td><td valign=top align=left><input type=\"text\" style=\"width:90%\" name=\"antispam_a".md5(date("d.m.Y"))."\" value=\"\"><input type=hidden name=\"antispam_row".md5(date("d.m.Y"))."\" value=\"".md5(date("d.m.Y").$rand_st)."\"><br><span><i>$antispam_type</i></span></td></tr>
  </table><br></fieldset>";
 }
 $forum_list.="</form><table border=0><tr><td colspan=2 align=left class=pcont>";
if (@$valid=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {$forum_list.="<br><span onclick=\"click_bb('textarea','a')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=4&dest=textar','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')\" title=\"$lang[938]\"><img src=\"$image_path/picture.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b','')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','center','')\" title=\"$lang[936]\"><img src=\"$image_path/align_center.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>&nbsp;
<span onClick=\"javascript:window.open('$htpath/admin/attachments.php?speek=$speek&gtype=4&dest=textar','att','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=700,height=400,left=10,top=10')\" title=\"$lang[741]: ZIP, RAR, PDF, DOC, XLS\"><img src=\"$image_path/mini_zip.png\"></span>";} else {
$forum_list.="<br><span onclick=\"click_bb('textarea','a','')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img','')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b','')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>";
}
} else {
$forum_list.="<br><span onclick=\"click_bb('textarea','a','')\" title=\"$lang[810]\"><img src=\"$image_path/link.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','img','')\" title=\"$lang[925]\"><img src=\"$image_path/thumb.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','b','')\" title=\"$lang[930]\"><img src=\"$image_path/bold.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','i','')\" title=\"$lang[931]\"><img src=\"$image_path/italic.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','u','')\" title=\"$lang[932]\"><img src=\"$image_path/underline.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','sup','')\" title=\"$lang[933]\"><img src=\"$image_path/superscript.png\"></span>&nbsp;
<span onclick=\"click_bb('textarea','code','')\" title=\"$lang[927]\"><img src=\"$image_path/code.png\" title=\"$lang[927]\"></span>&nbsp;
<span onclick=\"click_bb('textarea','q','')\" title=\"$lang[1039]\"><img src=\"$image_path/quote.png\" title=\"$lang[1039]\"></span>";}
$forum_list.="</td></tr></table><p><br><input class=\"btn btn-large btn-primary\" type=\"button\" onclick=\"checkform();\" value=\"".$lang[359]."\"></td>
    </tr></table>
</td></tr></table>

";
} else {
$forum_list.="</table>";

}
}
} else {
   $forum_list="<div class=box style=\"padding:10px\"align=center><h4>".$lang[42]."! $lang[368] ".$lang['not_exists']."!</h4><br><br><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list\"><i class=icon-chevron-left title=\"".$lang['back']."\"></i> </a><span class=lnk><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list\">".$lang['back']."</a></span></div>";
  }
return $forum_list;
}

//----------------------------------------------------------------------------------------------
// function adds a topic from the form to the topic list
//----------------------------------------------------------------------------------------------

function addTopic() {
global $image_path;
global $htpath;
global $lang;
global $details;
global $valid;
global $answer_ok;
global $antispam_type;
global $rand_st;
global $fr;
global $f_name;
global $f_rules_text;
global $f_rules_text;
global $f_desc;
global $f_asp;
global $f_reg;
global $f_ico;
global $f_tre;
global $_SERVER;
global $fpage;
//echo $f_reg." ".$f_asp." ".$answer_ok;
$forum_list="";

if ($f_tre==0) {
if (@$valid=="1"){
if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) { $f_tre=1; $answer_ok=1;}
}
}
if ($f_tre==1) {
if (@$valid=="1"){
$f_tre=1; $answer_ok=1;
} else {
if ($f_reg==1) {
$f_tre=0;
}
}
}

if ($f_tre==0) { return "<div class=box style=\"padding:10px\"><br><font color=#b94a48><b>".$lang['hack']."</b></font><meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"><br><br></div>";}
$mmax=2000;
if (@$valid=="1") { $mmax=5000;}

global $datadir;

$filename = $_POST["nr"];
  $description = $_POST["desc"];
  $nickname = $_POST["nick"];
  $text = $_POST["txt"];
  $ip=getRealIP();
$fr=$_POST["fr"];
$fr=doubleval($fr);
$filename = substr($filename, 0, 80);
$description = substr($description, 0, 80);
$nickname = substr($nickname, 0, 80);
$act=@$act;

$arr2=array ("filename","description","nickname","text","act", "ip");
while (list ($line_num, $a) = each ($arr2)) {
if (@$valid=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {} else { $$a = strip_tags($$a);$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);}} else {$$a = strip_tags($$a);$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);}
$$a = substr($$a, 0, $mmax);
//$$a = wordwrap($$a, 200, " " , 1);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace(chr(10) , "<br>", $$a);
//$$a = str_replace(chr(13) , "", $$a);
//$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
$$a= badwords($$a);
}


// Антиспам

if (@$valid=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) { } else {
if ($answer_ok!=1):
$forum_list= "<div class=box style=\"padding:10px\"><br><font color=#b94a48><b>".$lang[825]."</b></font><meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"><br><br></div>"; return $forum_list; endif;
}} else {
if($answer_ok!=1):
$forum_list= "<div class=box style=\"padding:10px\"><br><font color=#b94a48><b>".$lang[825]."</b></font><meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"><br><br></div>"; return $forum_list; endif;
}

// Антиспам


if (($filename=="")||($description=="")||($nickname=="")||($text=="")){ $forum_list= "<div class=box style=\"padding:10px\"><b><font color=#b94a48>".$lang[211]." ".$lang[369]."</font></b><br><br>
".$lang[334]."<br>
".$lang[335]."<br><br>
    ".$lang[336]."<b><a href=\"$htpath/index.php?action=forum&act=list\">".$lang[247]."</a></b>.<br>
    <meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"></div>"; return $forum_list;

    }

    $tmp5=explode(".",$ip);
$ipfile="./admin/bannedip/".implode("/",$tmp5)."/banned.txt";
if (file_exists($ipfile)) {
$tmp6=file($ipfile);
$bantime=date("d.m.Y H:i:s", trim($tmp6[0]));
if (time()>=trim($tmp6[0])) {
@unlink($ipfile);
} else {
$banreason=@$lang[trim($tmp6[1])];
$forum_list= "<div align=center class=ocat1><br><font color=#b94a48>$lang[1530]</font><br><br><b>$lang[1501]:</b> $bantime <b>$lang[1514]:</b> $banreason<br><br><a class=btn href=\"javascript:history.back();\" style=\"height: 30px;\">".$lang['back']."</a><br><br></div><br>";
return $forum_list;
}
}

  $fp = fopen($datadir."$fr/lastpost.txt", "w");
  fputs($fp, time()."|".stripslashes($nickname)."|".stripslashes($description)."|".stripslashes($filename)."|"."\n");
  fclose($fp);

  $fp = fopen($datadir."$fr/topics.txt", "a");
  fputs($fp, time()."\n");
  fputs($fp, stripslashes($nickname)."\n");
  fputs($fp, stripslashes($description)."\n");
  fputs($fp, stripslashes($filename)."\n");
  fputs($fp, "0\n");
  fclose($fp);

  $fp = fopen($datadir."$fr/topic".$filename.".txt", "w");
  fputs($fp, stripslashes($description)."\n");
  fputs($fp, time()."\n");

  fputs($fp, stripslashes(str_replace("|","",$nickname))."|$valid|".$details[1]."|".$details[3]."|$ip|\n");
  fputs($fp, stripslashes(str_replace("\r", "", str_replace("\n", "", $text)))."\n");
  fclose($fp);

$topn = 0;

$file=$datadir."$fr/topicsnum.txt";
$ftopn=@fopen($file,"r");
$topn=doubleval(trim(@fread($ftopn,@filesize($file))));
@fclose($ftopn);
$ftopn=fopen($file,"w");
fputs($ftopn,($topn+1));
fclose($ftopn);



  $forum_list.= "<div class=box style=\"padding:10px\"><b><font color=#468847>".$lang[332]."</font></b><br><br>
    ".$lang[335]."<br><br>
    ".$lang[336]."<b><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list\">".$lang[247]."</a></b>.<br>
    <meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"></div>";
  return $forum_list;
}

//----------------------------------------------------------------------------------------------
// function adds an answer to the current topic
//----------------------------------------------------------------------------------------------

function addAnswer() {
global $image_path;
global $htpath;
global $lang;
global $nr;
global $details;
global $valid;
global $answer_ok;
global $antispam_type;
global $rand_st;
global $fr;
global $f_name;
global $f_desc;
global $f_rules_text;
global $f_rusel_link;
global $f_rules_link;
global $fpage;
//global $forum_list;
//$forum_list.="<tr><td colspan=3 align=right style=\"white-space: nowrap;\">";
//    if ($f_rules_link!="") {$forum_list.="<a href=$f_rules_link><b><font color=$nc3 size=3>$f_rules_text</font></b> <i class=\"icon-warning-sign\"></i></a>"; }
//    $forum_list.="</td></tr>";

global $f_asp;
global $f_reg;
global $f_ico;
global $_SERVER;
//echo $f_reg." ".$f_asp." ".$answer_ok;
$mmax=2000;
if (@$valid=="1") { $mmax=5000;}
$forum_list="";
global $datadir;
$forum_list="";
if (@$valid=="1"){
if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) { $f_reg=1;$answer_ok=1;}
}
if ($f_reg==0) {
if ($f_asp==1) {
if ($answer_ok!=1) {
return "<div class=box style=\"padding:10px\"><br><font color=#b94a48><b>".$lang[825]."</b></font><meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"><br><br></div>";
}
}
}
if ($f_reg==1) {
if (@$valid!="1"){
return "<div class=box style=\"padding:10px\"><br><font color=#b94a48><b>".$lang['hack']."</b></font><meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"><br><br></div>";
}
}
$number = $_POST["nr"];
$nick = $_POST["nick"];
$text = $_POST["txt"];
$fr=$_POST["fr"];
$ip=getRealIP();
$number = substr($number, 0, 80);
$nick = substr($nick, 0, 80);
$fr=doubleval($fr);

$arr2=array ("number","nick","text", "ip");
while (list ($line_num, $a) = each ($arr2)) {
if (@$valid=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {} else { $$a = strip_tags($$a);$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);}} else {$$a = strip_tags($$a);$$a = str_replace("<" , "&lt;", $$a);
$$a = str_replace(">" , "&gt;", $$a);}
$$a = substr($$a, 0, $mmax);
//$$a = wordwrap($$a, 54, " " , 1);
$$a = str_replace(chr(92) , "", $$a); // strip backslash
$$a = str_replace("^" , "", $$a);
$$a = str_replace(chr(10) , "<br>", $$a);
//$$a = str_replace(chr(13) , "", $$a);
//$$a = str_replace(chr(27) , "", $$a);
$$a = trim($$a);
$$a = stripslashes($$a);
$$a= badwords($$a);
}


// Антиспам


if (@$valid=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) { } else {
if ($answer_ok!=1):
$forum_list= "<div class=box style=\"padding:10px\"><br><font color=#b94a48><b>".$lang[825]."</b></font><meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"><br><br></div>"; return $forum_list; endif;
}} else {
if($answer_ok!=1):
$forum_list= "<div class=box style=\"padding:10px\"><br><font color=#b94a48><b>".$lang[825]."</b></font><meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"><br><br></div>"; return $forum_list; endif;
}

// Антиспам

if (($number=="")||($nick=="")||($text=="")) {$forum_list= "<div class=box style=\"padding:10px\"><b><font color=#b94a48>".$lang[211]." ".$lang[370]."</font></b><br><br>
".$lang[334]."<br>
    ".$lang[335]."<br><br>
    ".$lang[336]."<b><a href=\"$htpath/index.php?action=forum&fr=$fr&act=list\">".$lang[247]."</a></b>.<br>
    <meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=list&fpage=$fpage\"></div>"; return $forum_list;

    }
$tmp5=explode(".",$ip);
$ipfile="./admin/bannedip/".implode("/",$tmp5)."/banned.txt";
if (file_exists($ipfile)) {
$tmp6=file($ipfile);
$bantime=date("d.m.Y H:i:s", trim($tmp6[0]));
if (time()>=trim($tmp6[0])) {
@unlink($ipfile);
} else {
$banreason=@$lang[trim($tmp6[1])];
$forum_list= "<div align=center class=ocat1><br><font color=#b94a48>$lang[1530]</font><br><br><b>$lang[1501]:</b> $bantime <b>$lang[1514]:</b> $banreason<br><br><a class=btn href=\"javascript:history.back();\" style=\"height: 30px;\">".$lang['back']."</a><br><br></div><br>";
return $forum_list;
}
}
    $fp = fopen($datadir."$fr/topic".$number.".txt", "a");
    fputs($fp, time()."\n");
    fputs($fp, stripslashes($nick)."|$valid|".$details[1]."|".$details[3]."|$ip|\n");
    fputs($fp, stripslashes(str_replace("\r", "", str_replace("\n", "", $text)))."\n");
    fclose($fp);
    if (!is_dir("./forum/forumstat/")) { mkdir("./forum/forumstat",0755); }
if (!is_dir("./forum/forumstat/$fr")) { mkdir("./forum/forumstat/$fr",0755); }
$fp=fopen("./forum/forumstat/$fr/t_$nr.txt","w"); fputs($fp,stripslashes($nick)); fclose($fp);
if (!is_dir("./forum/forumstat/users")) { mkdir("./forum/forumstat/users",0755); }
if($valid=="1") {
$umd=md5($details[1]);
$udir=substr($umd,0,3);
if (!is_dir("./forum/forumstat/users/".$udir)) { mkdir("./forum/forumstat/users/".$udir,0755); }
$unum=0;
$ufile="./forum/forumstat/users/$udir/a_$umd.txt";
if (file_exists($ufile)) {
$fp=fopen($ufile,"r"); $unum=doubleval(fread($fp,1024)); fclose($fp);
}
$fp=fopen($ufile,"w"); fputs($fp,($unum+1)); fclose($fp);
}


    $n = 0;
    $list = array();
    $fp = fopen($datadir."$fr/topics.txt", "r");
    while (!feof($fp)) {
        $lastpost = fgets($fp, 1024);
        $nickname = fgets($fp, 1024);
        $description = fgets($fp, 1024);
        $file = fgets($fp, 1024);
        $ans = fgets($fp, 1024);

        if ($lastpost && $nickname && $description && $file && $ans) {

  if (trim($file) == $number) {
  $list[$n][0] = time()."\n";

            } else {
                $list[$n][0] = $lastpost;
            }
            $list[$n][1] = $nickname;
            $list[$n][2] = $description;
            $list[$n][3] = $file;
            if (trim($file) == $number) {
   $list[$n][4] = ($ans+1)."\n";

  $fps = fopen($datadir."$fr/lastpost.txt", "w");
  fputs($fps, time()."|". trim(stripslashes($nick))."|". trim(stripslashes($description))."|". trim(stripslashes($file))."|". "\n");
  fclose($fps);

$popn = 0;
$file=$datadir."$fr/answers.txt";
$fpopn=@fopen($file,"r");
$popn=doubleval(trim(@fread($fpopn,@filesize($file))));
@fclose($fpopn);
$fpopn=fopen($file,"w");
fputs($fpopn,($popn+1));
fclose($fpopn);
            } else {
                $list[$n][4] = $ans;
            }
        }
        $n++;
    }
    fclose($fp);

    $fp = fopen($datadir."$fr/topics.txt", "w");
    for ($i=0; $i<sizeof($list); $i++) {
      fputs($fp, stripslashes($list[$i][0]));
      fputs($fp, stripslashes($list[$i][1]));
      fputs($fp, stripslashes($list[$i][2]));
      fputs($fp, stripslashes($list[$i][3]));
      fputs($fp, stripslashes($list[$i][4]));
    }
    fclose($fp);

    $forum_list.= "<div class=box style=\"padding:10px\"><b><font color=#468847>".$lang[333]."</font></b><br><br>
    ".$lang[335]."<br><br>
    ".$lang[336]."<b><a href=\"$htpath/index.php?action=forum&fr=$fr&act=show&nr=".$number."&fpage=$fpage\">".$lang[247]."</a></b>.<br>
    <meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum&fr=$fr&act=show&nr=".$number."&fpage=$fpage\"></div>";
    return $forum_list;
}


//----------------------------------------------------------------------------------------------
// action select switch
//----------------------------------------------------------------------------------------------

$datadir = "./forum/data/";
$smileys = true;

$username = "admin";
$forum_password = "pass";
$forum_list="";

//changeAnswer
function changeAnswer() {
global $forum_admins;
global $details;
global $valid;
global $image_path;
global $htpath;
global $fr;
global $nr;
global $ans;
global $datadir;
global $edtxt;
global $lang;
global $nc10;
global $act;
$validmoder=0;
$idx=$fr;
if (@$valid=="1") {
reset ($forum_admins[$idx]);
while (list($k,$v)=each ($forum_admins[$idx])) {
if ($v==$details[1]) {$validmoder=1;}
}
if ($details[7]=="ADMIN"){$validadmin=1;}
if ($details[7]=="MODER"){$validadmin=1;}
}
if ($validmoder==1) {
$n = 0;
$topic = array();
        $fp = fopen($datadir."$fr/topic".$nr.".txt", "r");
        $description = str_replace("\n","",fgets($fp, 1024));
        while (!feof($fp)) {
                $date = fgets($fp, 1024);
                $nickname = fgets($fp, 1024);
                $text = fgets($fp, 9000);
                if ($date && $nickname && $text) {
                        $topic[$n][0] = str_replace("\n","",$date);
                        $topic[$n][1] = str_replace("\n","",$nickname);
                        $topic[$n][2] = str_replace("\n","",$text);
                        $n++;
                }
        }
    fclose($fp);
        $fp = fopen($datadir."$fr/topic".$nr.".txt", "w");
        fputs($fp, $description."\n");
        for ($i=0; $i < sizeof($topic); $i++) {
                if ($i == $ans) {
                    fputs($fp, str_replace("\\","",stripslashes($topic[$i][0]))."\n");
                    fputs($fp, str_replace("\\","",stripslashes($topic[$i][1]))."\n");
                    fputs($fp, str_replace("\\","",stripslashes(str_replace("\n","<br>",trim($edtxt))))."\n");
                    } else {
                    fputs($fp, str_replace("\\","",stripslashes($topic[$i][0]))."\n");
                    fputs($fp, str_replace("\\","",stripslashes($topic[$i][1]))."\n");
                    fputs($fp, str_replace("\\","",stripslashes($topic[$i][2]))."\n");
                    }
        }
        fclose($fp);

        $n = 0;
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

        $fp = fopen($datadir."$fr/topics.txt", "w");
        for ($i=0; $i < sizeof($list); $i++) {
            fputs($fp, $list[$i][0]."\n");
            fputs($fp, $list[$i][1]."\n");
            fputs($fp, $list[$i][2]."\n");
            fputs($fp, $list[$i][3]."\n");
                if (trim($list[$i][3]) == $nr) {
                    fputs($fp, trim($list[$i][4])."\n");
                } else {
                    fputs($fp, $list[$i][4]."\n");
                }
        }
    fclose($fp);

        $act="show";
        } else {

     return "<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
}

function delAnswer() {
global $forum_admins;
global $details;
global $valid;
global $nc10;
global $image_path;
global $htpath;
global $fr;
global $nr;
global $ans;
global $datadir;
global $lang;
global $act;

$validmoder=0;
$idx=$fr;
if (@$valid=="1") {
reset ($forum_admins[$idx]);
while (list($k,$v)=each ($forum_admins[$idx])) {
if ($v==$details[1]) {$validmoder=1;}
}
if ($details[7]=="ADMIN"){$validadmin=1;}
if ($details[7]=="MODER"){$validadmin=1;}
}
if ($validmoder==1) {
        $n = 0;
    $topic = array();
        $fp = fopen($datadir."$fr/topic".$nr.".txt", "r");
        $description = str_replace("\n","",fgets($fp, 1024));
        while (!feof($fp)) {
                $date = fgets($fp, 1024);
                $nickname = fgets($fp, 1024);
                $text = fgets($fp, 9000);
                if ($date && $nickname && $text) {
                        $topic[$n][0] = str_replace("\n","",$date);
                        $topic[$n][1] = str_replace("\n","",$nickname);
                        $topic[$n][2] = str_replace("\n","",$text);
                        $n++;
                }
        }
    fclose($fp);

        $fp = fopen($datadir."$fr/topic".$nr.".txt", "w");
        fputs($fp, $description."\n");
        for ($i=0; $i < sizeof($topic); $i++) {
                if ($i != $ans) {
                    fputs($fp, $topic[$i][0]."\n");
                    fputs($fp, $topic[$i][1]."\n");
                    fputs($fp, $topic[$i][2]."\n");
                }
        }
        fclose($fp);

        $n = 0;
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

        $fp = fopen($datadir."$fr/topics.txt", "w");
        for ($i=0; $i < sizeof($list); $i++) {
            fputs($fp, $list[$i][0]."\n");
            fputs($fp, $list[$i][1]."\n");
            fputs($fp, $list[$i][2]."\n");
            fputs($fp, $list[$i][3]."\n");
                if (trim($list[$i][3]) == $nr) {
                $tosave=(doubleval(trim($list[$i][4]))-1);
                if ($tosave<=0) {$tosave=0;}
                    fputs($fp, ($tosave)."\n");
                    $popn = 0;
$file=$datadir."$fr/answers.txt";
$fpopn=@fopen($file,"r");
$popn=doubleval(trim(@fread($fpopn,@filesize($file))));
@fclose($fpopn);
$popn-=1;
$fpopn=fopen($file,"w");
if ($popn<=0) {$popn=0;}
fputs($fpopn,$popn);
fclose($fpopn);
//$file=$datadir."$fr/lastpost.txt";
//$ftopn=fopen($file,"w");
//fputs($ftopn, time()."|".$details[1]."|". trim(stripslashes($description))."|". trim(stripslashes($file))."|");
//fclose($ftopn);


                } else {
                    fputs($fp, $list[$i][4]."\n");
                }
        }
    fclose($fp);
        $aa=($ans-1) ;
        if ($aa<0) { $aa=0; }
        $act="show";
        } else {

     return "<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
}

if  ($act=="change" ) {
changeAnswer();
$act="show";
}
if  ($act=="dela" ) {
delAnswer();
$act="show";
}
switch (@$act) {

    case "";
        $forum_list.=showForums();
        break;
    case "list";
        $forum_list.=showList();
        break;
    case "search";
        if ($valid=="1") { $forum_list.="<div class=\"box\"><div class=\"onav\" align=\"left\">&nbsp;<b><font size=3>$lang[1077]</font></b></div>
        <div class=\"content\" align=\"left\"><form class=form-inline action=index.php method=POST id=\"sf_form\">
        <table border=0 cellspacing=10 width=100%>
        <tr>
        <td valign=top align=left><nobr>$lang[1078]:</nobr></td><td valign=top width=100% align=left><input name=\"query\" type=text value=\"\" style=\"width:90%\" size=64></td>
        </tr>
        <tr>
        <td colspan=2 align=left><b>$lang[1085]:</b></td>
        </tr>
        <tr>
        <td valign=top align=left><nobr>$lang[1079]:</nobr></td><td valign=top width=100% align=left><input name=\"f_user\" type=text value=\"\" style=\"width:90%\" size=64><br>&nbsp;&nbsp;<span>$lang[1086]</span></td>
        </tr>
        <tr>
        <td colspan=2 align=center><button type=button class=btn onclick=\"document.getElementById('sf_form').submit();\"> <img src=$image_path/sf.png border=0 align=absmiddle hspace=5>".$lang['search']."</button></td>
        </tr>
        </table>
        <input type=hidden name=onlyforum value=1>
        </form></div>
<div class=\"clear\"></div></div>";  } else {

$forum_list.="<div class=\"box\"><div align=\"left\">&nbsp;<b><font size=3>$lang[1077]</font></b></div>
        <div class=\"content\" align=\"left\"><h4>$lang[1081]!</h4><br>$lang[1080]<br><br><button class=btn type=button onclick=\"window.location.href='".$htpath."/index.php?register=1';\">$lang[39]</button></div>
<div class=\"clear\"></div></div>"; }
        break;
    case "show";
        $forum_list.=showTopic($nr);
        break;
    case "addt";
        $forum_list.=addTopic();
        break;
    case "adda";
        $forum_list.=addAnswer();
        break;
    }
if (($act=="")||($act=="list")) {
if (isset($online_users)) {
if (count($online_users)>0) {

$forum_list.="<div class=round3 align=left><b>".str_replace("[min_update]","$min_update",$lang[1010])." [".count($online_users)."]:</b><br><br>";
reset($online_users);
while (list($sesk,$sesv)=each($online_users)) {
//echo $sesk." ". $sesv."<br>";
if (($details[7]=="ADMIN")||($details[7]=="MODER")) {
$u_lurl="./admin/userstat/".$sesk."/lastvisit.url";
$u_time="";
$u_url="index.php";
if (file_exists($u_lurl)) {
$fp=fopen($u_lurl,"r");
$u_url=fread($fp,filesize($u_lurl));
fclose($fp);
$u_time=date("H:i:s",filemtime($u_lurl));
}
} else {
$u_time=""; $u_url="chat.php?ch=main&privat=$sesk"; $u_lurl="chat.php?ch=main&privat=$sesk";
}

$sysmes="";
if ($valid=="1") {if (($details[7]=="ADMIN")||($details[7]=="MODER")) { $sysmes="<script type=\"text/javascript\">
function submit_f_".translit($sesk)."(e)
{
	if (e.keyCode == 13)
	{
		document.f_".translit($sesk).".submit();
		return false;
	}
}

</script><form name=\"f_".translit($sesk)."\" method=POST action=\"".request_url()."\"><b>$lang[85]:</b><table border=0 width=100%><tr><td width=97% align=left><input type=hidden name=\"sysmessage_send\" value=1><input type=hidden name=\"sysmessage_user\" value=\"$sesk\"><input type=text name=\"sysmessage\" value=\"\" size=20 style=\"width:90%\" onkeyup=\"submit_f_".translit($sesk)."(event);\"></td><td align=left><input class=btn type=submit value=\"OK\"></td></tr></table></form><br>\n"; }}
if (!isset($online_users[$sesk])) {$onlinestatus="<i class=icon-user title=\"$u_time\"></i> "; } else {$onlinestatus="<i class=icon-ok title=\"$u_time\"></i> ";}

$forum_list.="$onlinestatus<a href=\"$u_url\" target=\"_blank\">$sesk</a>&nbsp;&nbsp;&nbsp;\t$sysmes";
}
$forum_list.="</div>";
}
}
}
$forum_list.="<script type=\"text/javascript\">
		$(document).ready(function() {
        $(\"a[rel=forum_group]\").fancybox({
        'onComplete' : function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
        'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'    : 'none',
        'transitionOut'    : 'none',
		'overlayShow'	:	false,
        'scrolling'		: 'no',
        'padding' : 50
			});

		});
	</script>";
?>
