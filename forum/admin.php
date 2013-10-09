<?php
$ffp = array();
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

$validadmin=0;





$fadmins="";
$edtxt = @$_POST["edtxt"];
if (!isset($fr)){$fr=1;} $fr=doubleval($fr); if (!preg_match("/^[0-9]+$/",$fr)) { $fr=1;}
$ffp = file("./forum/data/forums.txt");
while (list($key,$val)=each($ffp)) {
if (trim($val!="")) {
$out=explode("|", $val);
$idx=$out[1];
$forum_admins[$idx]=explode(",",trim($out[4]));
$fadmins.=trim($out[4]).",";
}

}
$tmp=array_flip(explode(",",$fadmins));
$idx=$details[1];
if (isset($tmp[$idx])) {$validadmin=1;} else {$validadmin=0;}
if ((@$valid=="1")&&(@$details[7]=="ADMIN")){$validadmin=1;}
if ((@$valid=="1")&&(@$details[7]=="MODER")){$validadmin=1;}
if (($details[1]=="") ||($details[1]=="guest")) {$validadmin=0;}
if ($validadmin==0) {
$action="";
$forum_list="<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
} else {

$forum_status="MODERATOR";

function logForm() {
global $image_path;
global $htpath;
global $lang;
global $forum_pass;
global $forum_name;
global $fr;

return "<table border=0 cellpadding=2 cellspacing=0 width=100%>
<tr><form class=form-inline action='$htpath/index.php' method=post name=logfrm>
<input type=\"hidden\" name=\"action\" value=\"forum_admin\">
<input type=\"hidden\" name=\"fr\" value=\"$fr\">
<input type=\"hidden\" name=\"act\" value=\"login\"><td class=row colspan=2></td><td class=row>".$lang[375]."</td></tr>
<tr><td colspan=3>&nbsp;</td></tr>
<tr><td width=15%></td><td>".$lang['login'].":</td>
<td><input type=text value=\"$forum_name\" name='us' style=\"width:200\"></td></tr>
<tr><td width=15%></td><td>".$lang['pass'].":</td>
<td><input type=password value=\"$forum_pass\" name='pa' style=\"width:200\"></td></tr>
<tr><td colspan=2></td>
<td><a href=\"javascript:document.logfrm.submit()\">".$lang[375]."</a> | <a href=\"$htpath/index.php?action=forum&fr=$fr\">".$lang[379]."</a></td>
</tr></form></table>";

}

function logIn() {
global $forum_admins;
global $image_path;
global $htpath;
global $lang;
global $fr;
        global $username;
        global $forum_password;
        $forum_list="";

        if($_POST['us'] == $username && $_POST['pa'] == $forum_password){
                $_SESSION["ingelogd"] = 1;
                $forum_list .= "OK!<meta http-equiv=refresh content=\"0 URL=$htpath/index.php?action=forum_admin&act=list&fr=$fr\">";
        } else {
                $forum_list .= "<meta http-equiv=refresh content=\"2 URL=$htpath/index.php?action=forum_admin&fr=$fr&act=list\">";
                $forum_list .= "<span class=alert>".$lang[377]."</span>"; }
                return $forum_list;}

function logOut() {
global $forum_admins;
global $image_path;
global $htpath;
global $lang;
$_SESSION["ingelogd"] = 0;
       return "OK!<meta http-equiv=refresh content=\"0 URL=$htpath/index.php?action=forum\">"; }


//----------------------------------------------------------------------------------------------
//  list the available topics and print add topic form
//----------------------------------------------------------------------------------------------
if (file_exists("./forum/data/stiky.txt")) {
$tmp_stiky=file ("./forum/data/stiky.txt");
while (list($keyst,$valst)=each($tmp_stiky)) {
$idx=trim($valst);
$stikytreads[$idx]=$idx;
}
}else{
$stikytreads=Array();
}

function showForums() {
global $forum_admins;
global $ffp;
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
global $fr;
$mmax=3000;
if (@$valid=="1"){ if ((@$details[7]=="ADMIN")||(@$details[7]=="MODER")) {$mmax=30000;}}
$forum_list="";
global $datadir;
global $smileys;
global $antispam_q;
global $forum_name;
global $forum_perpage;
global $fpage;
global $speek;
$n = 0;

$forum_list.="<br><div align=center class=shadow><table border=0 cellpadding=15 cellspacing=0 width=100%>
<tr style=\"background: $nc3 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($nc3,20))."&e=".str_replace("#","",$nc3).") repeat-x;\"><td colspan=2><font color=$nc0>".$lang[999]."</font></td><td align=center><small><font color=$nc0>".$lang[1001]."</font></small></td><td colspan=3><small><font color=$nc0>".$lang[1000]."</font></small></td></tr>";

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
reset ($forum_admins);
$idx=$out[1];
$ffadm=implode(", ", $forum_admins[$idx]);
reset ($forum_admins[$idx]);
$validmoder=0;
if (@$valid=="1") {
while (list($k,$v)=each ($forum_admins[$idx])) {
if ($v==$details[1]) {$validmoder=1;}
}
if ($details[7]=="ADMIN"){$validadmin=1;}
if ($details[7]=="MODER"){$validadmin=1;}
}
if ($validmoder==1) {
$forum_list.="<tr onclick=\"location.href='".$htpath."/index.php?action=forum_admin&fr=".$out[1]."&act=list';\" onmouseover=\"this.style.backgroundColor='$nc6';\" onmouseout=\"this.style.backgroundColor='';\" style=\"cursor: pointer; cursor: hand; text-decoration: none;\"><td><img src=".$out[9]." border=0></td><td><font size=3><b><a href=index.php?action=forum_admin&fr=".$out[1]."&act=list>".$out[2]."</a></b></font><br><small>".$out[3]."<br><b>$lang[1074]:</b> $ffadm</small></td><td align=center>".$topn." / ".$popn."</td><td><small>".date("d.m.Y H:i",filemtime($datadir.$out[1]."/topics.txt"))."</small></td><td><small><b>".@$lp[1]."</b></small></td><td><small><a href=index.php?action=forum_admin&fr=".$out[1]."&act=show&nr=".@$lp[3].">".@$lp[2]."</a></small></td></tr>";
}  else {
$forum_list.="<tr><td><img src=".$out[9]." border=0></td><td><font size=3><b>".$out[2]."</b></font><br><small>".$out[3]."<br><b>$lang[1074]:</b> $ffadm<br><font color=$nc10>$lang[265]</font></small></td><td align=center>".$topn." / ".$popn."</td><td><small>".date("d.m.Y H:i",filemtime($datadir.$out[1]."/topics.txt"))."</small></td><td><small><b>".@$lp[1]."</b></small></td><td><small>".@$lp[2]."</small></td></tr>";


}

}
        }
$forum_list.="</table>";
return $forum_list;
}





function showList() {
global $forum_admins;
global $details;
global $valid;
global $image_path;
global $htpath;
global $lang;
global $fr;
global $nc3;
global $nc0;
global $nc6;
global $nc10;
global $datadir;
global $stikytreads;

$forum_list="";
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
$f_name="";
$f_desc="";
$f_ico="images/mini_folder.png";
$ffp = array();
        $ffp = file($datadir."forums.txt");
        natcasesort($ffp);
        while (list($key,$val)=each($ffp)) {
if (trim($val!="")) {
$out=explode("|", $val);
if ($fr==$out[1]) {
$f_name=$out[2];
$f_desc=$out[3];
$f_ico=$out[9];
}
}
}
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
                        if (isset($stikytreads[$idx])) { $list[$n][0]=time()+$n; $list[$n][5] = "<img src=$image_path/sticky.png align=absmiddle title=\"".$lang[1491]."\">"; $list[$n][7] = " class=sticky";}
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
$forum_list.="<br><div class=shadow align=center>
        <table border=0 cellpadding=15 cellspacing=0 width=100%>
          <tr style=\"background: $nc3 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($nc3,20))."&e=".str_replace("#","",$nc3).") repeat-x;\"><td align=left colspan=5><table border=0 width=100% height=25><tr><td><a href=\"$htpath/index.php?action=forum_admin\"><img src='$htpath/images/mini_folder.png' border=0 align=absmiddle hspace=10 vspace=10 title=\"".$lang[1002]."\"></a><a href=\"$htpath/index.php?action=forum_admin\"><font color=$nc0>".$lang[1002]."</font></a></td></tr></table></td></tr>
        <tr><td colspan=5><table border=0 width=100% cellpadding=10><tr><td align=left><img src=\"".$f_ico."\" border=0></td><td width=100% align=left><font size=3><b><a href=\"$htpath/index.php?action=forum_admin&fr=$fr&act=list\">$f_name</a></b></font><br><small>$f_desc</small></td></tr></table></td></tr>
        <tr style=\"background: $nc6 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($nc6,20))."&e=".str_replace("#","",$nc6).") repeat-x;\"><td class=row>".$lang[364]."</td>
          <td class=row width=18%>".$lang[363]."</td>
          <td class=row width=8%>".$lang[365]."</td>
          <td class=row width=22% align=center>".$lang[371]."</td>
          <td class=row width=16% align=center>".$lang[372]."</td></tr>

";
        for ($i=0; $i < sizeof($list); $i++) {
                if ($i/2 == round($i/2)) { $forum_list.= "<tr".$list[$i][7].">\n"; }
                else { $forum_list.= "        <tr".$list[$i][7]." bgcolor=#f5f5f5>\n"; }
                $forum_list.= "        <td>".$list[$i][5]."<a href=$htpath/index.php?action=forum_admin&fr=$fr&act=show&nr=".$list[$i][3].">".$list[$i][2]."</td>\n";
                $forum_list.="        <td>".$list[$i][1]."</td>\n";

                $forum_list.= "        <td align=center> ".$list[$i][4]."</td><td align=center><small>".date("d.m.Y H:i", $list[$i][0])."</small></td>\n";
                $forum_list.= "        <td align=center style=\"white-space:nowrap;\"><small>";
                $idx="$fr"."/topic".$list[$i][3];
                if (isset ($stikytreads[$idx])) {
                $forum_list.= "        <a href=$htpath/index.php?action=forum_admin&fr=$fr&act=unstiky&nr=".$list[$i][3]."><b>".$lang[1490]."</b></a> | ";
                } else {
                $forum_list.= "        <a href=$htpath/index.php?action=forum_admin&fr=$fr&act=stiky&nr=".$list[$i][3].">".$lang[1489]."</a> | ";
                }
                $forum_list.= "        <a href=$htpath/index.php?action=forum_admin&fr=$fr&act=delt&nr=".$list[$i][3].">".$lang['del']."</a></small></td></tr>\n\n";
        }
        $forum_list.= "</table>";

        }else {
         $forum_list="<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
         }
        return $forum_list;

}

//----------------------------------------------------------------------------------------------
//  show the specified topic list and add answer form
//----------------------------------------------------------------------------------------------

function showTopic($nr) {
global $forum_admins;
global $details;
global $valid;
global $image_path;
global $htpath;
global $lang;
global $fr;
global $nc3;
global $nc0;
global $nc6;
global $nc10;
global $datadir;
$forum_list="";
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
    $ed = array();
    if (file_exists($datadir."$fr/topic".$nr.".txt")) {
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
                        $ed[$n] = str_replace("<br>","\n",$text);
                        $n++;
                }
        }
    fclose($fp);
$f_name="";
$f_desc="";
$f_ico="images/mini_folder.png";
$ffp = array();
        $ffp = file($datadir."forums.txt");
        natcasesort($ffp);
        while (list($key,$val)=each($ffp)) {
if (trim($val!="")) {
$out=explode("|", $val);
if ($fr==$out[1]) {
$f_name=$out[2];
$f_desc=$out[3];
$f_ico=$out[9];
}
}
}
        $forum_list.= "<br><div class=shadow align=center><table border=0 cellpadding=15 cellspacing=0 width=100%>
        <tr style=\"background: $nc3 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($nc3,20))."&e=".str_replace("#","",$nc3).") repeat-x;\"><td align=left colspan=4><table border=0 width=100% height=25><tr><td><a href=\"$htpath/index.php?action=forum_admin\"><img src='$htpath/images/mini_folder.png' border=0 align=absmiddle hspace=10 vspace=10 title=\"".$lang[1002]."\"></a><a href=\"$htpath/index.php?action=forum_admin\"><font color=$nc0>".$lang[1002]."</font></a></td></tr></table></td></tr>
        <tr><td colspan=4><table border=0 width=100% cellpadding=0><tr><td align=left><img src=\"".$f_ico."\" border=0></td><td width=100% align=left><font size=3><b><a href=\"$htpath/index.php?action=forum_admin&fr=$fr&act=list\">$f_name</a></b></font><br><small>$f_desc</small></td></tr></table></td></tr>
        ";
          $forum_list.= "<tr class=box  style=\"background: $nc6 url(grad.php?h=50&w=20&s=".str_replace("#","",lighter($nc6,20))."&e=".str_replace("#","",$nc6).") repeat-x;\"><td class=row width=50% colspan=2>".$lang[368].": <b>".$description."</b></td>";
        $forum_list.= "<td class=row width=16% align=center><a href=\"$htpath/index.php?action=forum_admin&fr=$fr&act=list\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10 title=\"".$lang['back']."\"></a><a href=\"$htpath/index.php?action=forum_admin&fr=$fr&act=list\">".$lang['back']."</a></td></tr>";

        for ($i=0; $i < sizeof($topic); $i++) {
                if ($i/2 ==round($i/2)) { $forum_list.= "        <tr class=body>\n"; }
                else { $forum_list.= "        <tr bgcolor=#f5f5f5 class=body>\n"; }
                $forum_list.= "        <td valign=top><img src=$image_path/pix.gif width=150 height=1 border=0><br><i>".str_replace("|","<br>",$topic[$i][1])."</i><br><small>".date("d.m.Y H:i", $topic[$i][0])."</small></td>\n";
                $forum_list.= "        <td valign=top width=100%><div id=\"tx".$nr."_".$i."\">".$topic[$i][2]."</div>
                <div id=\"div".$nr."_".$i."\" style=\"display:none; visibility:hidden;\">
                <form class=form-inline action=\"$htpath/index.php\" method=POST>
                <input type=hidden name=\"action\" value=\"forum_admin\">
                <input type=\"hidden\" name=\"fr\" value=\"$fr\">
                <input type=hidden name=\"act\" value=\"change\">
                <input type=hidden name=\"nr\" value=\"$nr\">
                <input type=hidden name=\"ans\" value=\"$i\">
                <textarea name=\"edtxt\" style=\"width:100%\" rows=10 cols=48>".str_replace("\\","",stripslashes($ed[$i]))."</textarea>
                <input type=submit value=\"".$lang['ch']."\"></form>
                </div>
                </td><script language=javascript>
                function js".$nr."_".$i."() {
                if ( document.getElementById('tx".$nr."_".$i."').style.visibility=='hidden') {
                document.getElementById('tx".$nr."_".$i."').style.visibility='visible';
                document.getElementById('tx".$nr."_".$i."').style.display='inline';
                document.getElementById('div".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('div".$nr."_".$i."').style.display='none';
                } else {
                document.getElementById('tx".$nr."_".$i."').style.visibility='hidden';
                document.getElementById('tx".$nr."_".$i."').style.display='none';
                document.getElementById('div".$nr."_".$i."').style.visibility='visible';
                document.getElementById('div".$nr."_".$i."').style.display='inline';
                }
                }
                </script>\n";
                $forum_list.= "<td valign=top align=center><img src=$image_path/pix.gif width=150 height=1 border=0><br>";
                if ($i >= 0) { $forum_list.= " <small><a href=#change onclick=\"javascript:js".$nr."_".$i."()\">".$lang['ch']."</a> | <a href=$htpath/index.php?action=forum_admin&act=dela&fr=$fr&nr=".$nr."&ans=".$i.">".$lang['del']."</a></small>";
                 } else {
                 $forum_list.= "";
                 }
                $forum_list.= "</td></tr>\n";
        }
       $forum_list.= "</table>";
       } else {
     $forum_list="<div class=box style=\"padding:10px\" align=center><h4>".$lang[42]."! $lang[368] ".$lang['not_exists']."!</h4><br><br><a href=\"$htpath/index.php?action=forum_admin&act=list&fr=$fr\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10 title=\"".$lang['back']."\"></a><a href=\"$htpath/index.php?action=forum_admin&fr=$fr&act=list\">".$lang['back']."</a></div>";
    }
    } else {

     $forum_list="<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
       return $forum_list;
       }


//----------------------------------------------------------------------------------------------
//  function deletes a topic from the form to the topic list
//----------------------------------------------------------------------------------------------


function delTopic() {
global $forum_admins;
global $details;
global $valid;
global $image_path;
global $htpath;
global $fr;
global $nr;
global $datadir;
global $lang;
global $nc10;
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
                if (trim($list[$i][3]) != $nr) {
                    fputs($fp, $list[$i][0]."\n");
                    fputs($fp, $list[$i][1]."\n");
                    fputs($fp, $list[$i][2]."\n");
                    fputs($fp, $list[$i][3]."\n");
                    fputs($fp, $list[$i][4]."\n");
                }
        }
    fclose($fp);
    $popn = 0;
$file=$datadir."$fr/topicsnum.txt";
$fpopn=@fopen($file,"r");
$popn=doubleval(trim(@fread($fpopn,@filesize($file))));
@fclose($fpopn);
$fpopn=fopen($file,"w");
$popn-=1;
if ($popn<=0) {$popn=0;}
fputs($fpopn,$popn);
fclose($fpopn);
if(!is_dir($datadir."deleted")) { mkdir($datadir."deleted",0755);}
if(!is_dir($datadir."deleted/$fr")) { mkdir($datadir."deleted/$fr",0755);  }
copy ($datadir."$fr/topic".$nr.".txt", $datadir."deleted/$fr/topic".$nr.".txt");
unlink( $datadir."$fr/topic".$nr.".txt" );
        return "OK!<meta http-equiv=refresh content=\"0 URL=$htpath/index.php?action=forum_admin&act=list&fr=$fr\">";
        } else {

     return "<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
}




//----------------------------------------------------------------------------------------------
//  function sticky topic
//----------------------------------------------------------------------------------------------


function stikyTopic() {
global $forum_admins;
global $details;
global $valid;
global $image_path;
global $htpath;
global $fr;
global $nr;
global $datadir;
global $lang;
global $nc10;
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
if (file_exists("./forum/data/stiky.txt")) {
$tmp_stiky=file ("./forum/data/stiky.txt");
while (list($keyst,$valst)=each($tmp_stiky)) {
$idx=trim($valst);
$stikytreads[$idx]=$idx;
}
}else{
$stikytreads=Array();
}
$idx="$fr"."/topic".$nr;
$stikytreads[$idx]=filemtime("./forum/data/".$idx.".txt");
reset ($stikytreads);
$stikytreadstosave="";
while (list($keyst1,$valst1)=each($stikytreads)) {
$stikytreadstosave.="$keyst1\n";
}
$fp = fopen("./forum/data/stiky.txt", "w");
        fputs($fp, $stikytreadstosave);
        fclose($fp);
        return "OK!<meta http-equiv=refresh content=\"0 URL=$htpath/index.php?action=forum_admin&act=list&fr=$fr\">";
        } else {

     return "<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
}



//----------------------------------------------------------------------------------------------
//  function unsticky topic
//----------------------------------------------------------------------------------------------


function unstikyTopic() {
global $forum_admins;
global $details;
global $valid;
global $image_path;
global $htpath;
global $fr;
global $nr;
global $datadir;
global $lang;
global $nc10;
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
if (file_exists("./forum/data/stiky.txt")) {
$tmp_stiky=file ("./forum/data/stiky.txt");
while (list($keyst,$valst)=each($tmp_stiky)) {
$idx=trim($valst);
$stikytreads[$idx]=$idx;
}
}else{
$stikytreads=Array();
}
$idx="$fr"."/topic".$nr;
$stikytreads[$idx]=filemtime("./forum/data/".$idx.".txt");
reset ($stikytreads);
$stikytreadstosave="";
while (list($keyst1,$valst1)=each($stikytreads)) {
if ($keyst1!=$idx) {
$stikytreadstosave.="$keyst1\n";
}
}
$fp = fopen("./forum/data/stiky.txt", "w");
        fputs($fp, $stikytreadstosave);
        fclose($fp);

        return "OK!<meta http-equiv=refresh content=\"0 URL=$htpath/index.php?action=forum_admin&act=list&fr=$fr\">";
        } else {

     return "<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
}

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

        return "OK!<meta http-equiv=refresh content=\"0 URL=$htpath/index.php?action=forum_admin&act=show&nr=".$nr."&fr=$fr\">";
        } else {

     return "<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
}



//----------------------------------------------------------------------------------------------
//  function deletes an answer to the current topic
//----------------------------------------------------------------------------------------------

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

        return "OK!<meta http-equiv=refresh content=\"0 URL=$htpath/index.php?action=forum_admin&fr=$fr&act=show&nr=".$nr."\">";
        } else {

     return "<div class=round align=center><div class=content><font color=$nc10>$lang[265]</font></div></div>";
    }
}


//----------------------------------------------------------------------------------------------
//  action select switch
//----------------------------------------------------------------------------------------------

$datadir = "./forum/data/";
$smileys = true;

$username = "admin";
$forum_password = "pass";
$forum_list="";
global $forum_status;
if(@$forum_status == "MODERATOR" ) {
if(@$act == "login" ) {
        $forum_list.=logForm();
} else {
        switch (@$act) {
                case "";
                        $forum_list.=showForums();
                        break;
                case "list";
                        $forum_list.=showList();
                        break;
                case "change";
                        $forum_list.=changeAnswer();
                        break;
                case "show";
                        $forum_list.=showTopic($nr);
                        break;
                case "delt";
                        $forum_list.=delTopic();
                        break;
                case "stiky";
                        $forum_list.=stikyTopic();
                        break;
                case "unstiky";
                        $forum_list.=unstikyTopic();
                        break;
                case "dela";
                        $forum_list.=delAnswer();
                        break;
                case "login";
                        $forum_list.=logIn();
                        break;
                case "logout";
                        $forum_list.=logOut();
                        break;
        }
        if (@$act != "login") { $forum_list.= "<div class=shadow><div class=content align=center><b>» <a href=$htpath/index.php?action=forum_admin&act=logout>".$lang[379]."</a></b></div></div></div></div>"; }
}
} else {
$forum_list.=logForm();
}
if ($forum_list==""): $forum_list=$lang[265]; endif;
}
?>
