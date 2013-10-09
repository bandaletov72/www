<?php
$ddir="";
$totsize=0;
$archive_cols=1;
$archive_perpage=100;
$findmp3=0;
$ppages="";
$garch="";
$arch="";
$hear="";
$mp3s="";
$jjarch="";
require("./modules/class.id3.php");
if(isset($_GET['isort'])) $isort=$_GET['isort']; elseif(isset($_POST['isort'])) $isort=$_POST['isort']; else $isort="";
if (!preg_match("/^[datenm]+$/i",$isort)) { $isort="date";}
function perms($perms) {
if (($perms & 0xC000) == 0xC000) {
    // Socket
    $info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
    // Symbolic Link
    $info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
    // Regular
    $info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
    // Block special
    $info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
    // Directory
    $info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
    // Character special
    $info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
    // FIFO pipe
    $info = 'p';
} else {
    // Unknown
    $info = 'u';
}

// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));
return $info;
}

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
$make_col=1;
$st=0;
//$next=$start+$perpage;
$curp=1;
$nit=1;
$wim="";
$wup="";
$arch="";
$garch="";
$ddel="";
unset($fileopens);

if(isset($_GET['i'])) $i=$_GET['i']; elseif(isset($_POST['i'])) $i=$_POST['i']; else $i="";
if (isset($i)){
if (!preg_match("/^[-а-яА-ЯёЁa-zA-Z0-9 _():\/]+$/i",$i)) { if ($i!="") {$arch.= "<br><br><font size=2 face=Verdana><p align=center><b>Folder Name Error.</small></font></p><br><br>"; } $i="";}
}
$bdi="/";
if ($i!="") {$bdi="/$i/";} else {$bdi="/";}
$bdi=str_replace("//","/", $bdi);
if ((!@$perpage) || (@$perpage=="")): $perpage=$archive_perpage; endif;
if (!preg_match("/^[0-9_]+$/",$perpage)) { $perpage=$archive_perpage;}
if ($perpage>100) {$perpage=$archive_perpage;}
$perpage=$archive_perpage;
if ((!@$start) || (@$start=="")): $start=0; endif;
if (!preg_match("/^[0-9_]+$/",$start)) { $start=0;}
if ($start>99999) {$start=0;}

if ((substr($i,0,6)=="/users")||(substr($i,0,12)=="/attachments")||(substr($i,0,8)=="/avatars")) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")) { } else { $i=""; $bdi="/";}
} else {  $i=""; $bdi="/";}
}

if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")) {
require("./admin/fileupload-class.php");
if ((!@$del) || (@$del=="")): $del=""; endif;
if ((!@$icoll) || (@$icoll=="")): $icoll=""; endif;
if ((!@$ifile) || (@$ifile=="")): $ifile=""; endif;
if ((!@$deldir) || (@$deldir=="")): $deldir=""; endif;
if ((!@$mkdir) || (@$mkdir=="")): $mkdir=""; endif;
if ((!@$ren) || (@$ren=="")): $ren=""; endif;
if ((!@$newname) || (@$newname=="")): $newname=""; endif;


if ($del!="") {

$garch.= "<b>".$lang[257]."</b> $del <br><br>";

if (!@unlink  ("./archive/".$bdi . $del)) {
$garch.=  "<b>".$lang[252]."</b> $del!<br><br>\n";
} else {
@unlink  ("./archive/".$bdi . $del.".idx");
$garch.=  $lang[209]."<br><br>\n"; }
}
if ($ifile!="") {

$garch.= "<b>$lang[182]</b> OK<br><br>";
$foi="./archive/".$bdi . $ifile.".idx";
$fop=fopen($foi,"w");
fputs($fop,rawurldecode($icoll));
fclose ($fop);
}


if ($deldir!="") {

$garch.= "<b>".$lang[744]."</b> ./archive$i/$deldir <br><br>";

if (deleteAll("./archive$i/$deldir")==false){

$garch.=$lang[747]." <b>\"./archive$i/$deldir\"</b><br><br>\n";

} else {$garch.=$lang[209]."<br><br>\n";}
}


if ($mkdir!="") {

$garch.= "<b>".$lang[749]."</b> ./archive$i/$mkdir <br><br>";

if (mkdir("./archive$i/$mkdir",0755)==false){
if(is_dir("./archive$i/$deldir")) {
$garch.="<b>".$lang[750]."</b><br><br>\n";
} else {
$garch.=$lang[748]." <b>\"./archive$i/$mkdir\"</b><br><br>\n";
}
} else {$garch.=$lang[209]."<br><br>\n";}
}


$newname=rawurldecode(trim(stripslashes(str_replace("\\","",str_replace("/","",$newname)))));
$ren=trim(stripslashes(str_replace("\\","",str_replace("/","",$ren))));
if (!isset($ext)) {$ext="";}
$ext=trim(stripslashes(str_replace("\\","",str_replace("/","",$ext))));
if (($ren!="")&&($newname!="")&&($ext=="")) {
//dir rename
$garch.= "<b>".$lang[390].":</b> $ren -&gt; $newname<br><br>";

if (!@rename("./archive/".$bdi . $ren, "./archive/".$bdi . $newname)) {
if(@is_dir("./archive/".$bdi . $newname)) {
$garch.="<b>".$lang[751]."</b><br><br>\n";
} else {
$garch.=  "<b>".$lang[42]."!</b><br><br>\n";
}
} else {
@rename("./archive/".$bdi . $ren.".idx", "./archive/".$bdi . $newname.".idx");
$garch.=  $lang[209]."<br><br>\n"; }
}
if (($ren!="")&&($newname!="")&&($ext!="")) {

$garch.= "<b>".$lang[390].":</b> $ren -&gt; $newname$ext<br><br>";

if (!@rename("./archive/".$bdi . $ren, "./archive/".$bdi . $newname.$ext)) {
if(@file_exists("./archive/".$bdi . $newname.$ext)) {
$garch.="<b>".$lang[751]."</b><br><br>\n";
} else {
$garch.=  "<b>".$lang[42]."!</b><br><br>\n";
}
} else {
@rename("./archive/".$bdi . $ren.".idx", "./archive/".$bdi . $newname.$ext.".idx");
$garch.=  $lang[209]."<br><br>\n"; }
}
$del="";
        $path = "./archive/".$bdi;
        $upload_file_name = "userfile";
        $acceptable_file_types = "";
        $default_extension = "";
        $mode = 2;
                if (isset($_REQUEST['submitted'])) {

                $my_uploader = new uploader($_POST['language']);


                $my_uploader->max_filesize(10000000);

                $my_uploader->max_image_size(2700, 2700);

                if ($my_uploader->upload($upload_file_name, $acceptable_file_types, $default_extension)) {
                        $my_uploader->save_file($path, $mode);
                }

                if ($my_uploader->error) {
                        $arch.=  $my_uploader->error . "<br><br>\n";

                } else {

                        if(stristr($my_uploader->file['type'], "image")) {
                        $arch.= $my_uploader->file['name'] . " $lang[743] ".str_replace("//","/",str_replace("//","/", "$i"))." !<br>";
            } else {
                        $arch.= $my_uploader->file['name'] . " $lang[743] ".str_replace("//","/",str_replace("//","/", "$i"))." !<br>";

                               // while(!feof($fp)) {
                                        //$line = fgets($fp, 255);
                                        //$arch.=  $line;
                                //}
                               // if ($fp) { fclose($fp); }
                        }
                 }
         }
         //echo $my_uploader->file['type'];
         $ipl="<script type=\"text/javascript\" src=\"uploadify/swfobject.js\"></script>
<script type=\"text/javascript\" src=\"uploadify/jquery.uploadify.v2.1.4.js\"></script>
<script type=\"text/javascript\">
var aos=0;
				$(function() {
				$('#custom_file_upload').uploadify({
  'uploader'       : 'uploadify/uploadify.swf',
  'script'         : 'uploadify/uploadify.php',
  'cancelImg'      : 'uploadify/cancel.png',
  'folder'         : '"."/archive$i"."',
  'multi'          : true,
  'auto'           : true,
  'fileExt'        : '*.jpg;*.jpeg;*.gif;*.png;*.cdr;*.ai;*.pdf;*.zip;*.rar;*.mp3;*.doc;*.avi;*.wmv;*.mpg;*.swf;*.flv;*.7z;*.xls',
  'fileDesc'       : 'Files and Archives (.JPG, .JPEG, .GIF, .PNG, .CDR, .AI, .ZIP, .RAR, .PDF, .MP3, .DOC, .AVI, .WMV, .MPG, .SWF, .FLV, .7z, .XLS)',
  'queueID'        : 'custom-queue',
  'queueSizeLimit' : 30,
  'simUploadLimit' : 3,
  'removeCompleted': false,
'scriptData' : { 'session': '".session_id()."'},
  'onComplete'  : function(event, ID, fileObj, response, data) {
  if (aos<=30) {
            aos+=1;  }  else { window.alert('Max=30'); return; }
    },
  'onSelectOnce'   : function(event,data) {
      $('#status-message').text(data.filesSelected + ' files have been added to the queue.');
    },
  'onAllComplete'  : function(event,data) {
      $('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');
      window.location='$htpath/index.php?action=arch&isort=$isort&i=".str_replace("//","/",str_replace("//","/", "$i"))."';

    }
});			});
				</script>
<div class=\"demo-box\">
        <b><div id=\"status-message\"></div></b><br>

<div id=\"custom-queue\"></div>
<input id=\"custom_file_upload\" type=\"file\" name=\"Filedata\" /></div>
      ";
$garch.="<h4>".$lang[987]."</h4><form enctype=\"multipart/form-data\" action='$htpath/index.php' method=POST>
        <input type='hidden' name=\"i\" value=\"".str_replace("//","/",str_replace("//","/", "$i"))."\">
        <input type='hidden' name=\"submitted\" value=\"true\">
        <input type='hidden' name=\"isort\" value=\"$isort\">
        <input type='hidden' name=\"action\" value=\"arch\">
        <input type='hidden' name=\"perpage\" value=\"$perpage\">
        <input type='hidden' name=\"start\" value=\"$start\">

                ".$lang[741].": <input name='" . $upload_file_name . "' type='file'>
                <input type='hidden' name='language' value='en'>
<input type='submit' value='OK'>
        </form>$ipl

";

        if (isset($acceptable_file_types) && trim($acceptable_file_types)) {
                $garch.= ("<br><small>".$lang[740].": <b>" . str_replace("|", "</b>, <b>", $acceptable_file_types) . "</b></small>\n");
        }
        $garch.="<br><br>
        <form class=form-inline action='$htpath/index.php' method=POST>
        <input type='hidden' name=\"i\" value=\"".str_replace("//","/",str_replace("//","/", "$i"))."\">
        <input type='hidden' name=\"action\" value=\"arch\">
        <input type='hidden' name=\"perpage\" value=\"$perpage\">
        <input type='hidden' name=\"start\" value=\"$start\">
        <input type='hidden' name=\"isort\" value=\"$isort\">
".$lang[749].": <b>/archive$i/</b><input type='text' name=\"mkdir\" value=\"\">
<input type='submit' value='OK'>
        </form><br><br><hr noshade width=100% size=1 color=$nc2><br>";
}
}
if ($fancybox_enable==1) {
//fancybox
$garch.="<script type=\"text/javascript\">
		$(document).ready(function() {
            $(\"a[rel=example_group]\").fancybox({
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
	</script>
<div id=\"content\">";
}
$fileopens[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;

$files_found=0;
$st=0;
$s=0;
$backurl="";
$tmpback=Array();
$tmpback=explode("/", $i);
array_pop($tmpback);
while (list ($keycr, $stcr) = each ($tmpback)) {
}
$backurl=implode("/",$tmpback);
if ($bdi!="/") {
$arch.="<a href=\"$htpath/index.php?action=arch&isort=$isort&i=".rawurlencode($backurl)."\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10></a><a href=\"$htpath/index.php?action=arch&isort=$isort&i=".rawurlencode($backurl)."\"><small><i>".$lang['back_to_higher_level']."</i></small></a><br><br><br>";
}
$arch.="";
$notf=0;
if (!is_dir("./archive".$bdi."")) { $notf=1; } else {
$handle=opendir("./archive".$bdi."");
while (($fileopen = readdir($handle))!==FALSE) {
	$pos = strrpos($fileopen, ".");
	$typ = substr($fileopen, $pos, strlen($fileopen));
$typ= strtolower($typ);
$files_found2 = 0;
$files_found3 = 0;
if ((is_dir("./archive".$bdi."".$fileopen)==TRUE)&&($fileopen!=".")&&($fileopen!="..")) {
if ((strtolower($fileopen)=="icon.png")||(substr($fileopen,-4)==".idx")||(substr($fileopen,0,3)=="tn_")) {continue;} else {
$handle2=opendir("./archive".$bdi."$fileopen/");
while (($fileopend = readdir($handle2))!==FALSE) {
if ((is_dir("./archive".$bdi."$fileopen/$fileopend")==TRUE)&&($fileopend!=".")&&($fileopend!="..")) {$files_found3 += 1;}
if ((is_dir("./archive".$bdi."$fileopen/$fileopend")==FALSE)&&($fileopend!=".")&&($fileopend!="..")) {
if ((strtolower($fileopend)=="icon.png")||(substr($fileopend,-4)==".idx")||(substr($fileopend,0,3)=="tn_")) {continue;} else {
$pos2 = strrpos($fileopend, ".");
$typ2 = substr($fileopend, $pos2, strlen($fileopend));
$typ2= strtolower($typ2);
if (($typ2!=".jpg")&&($typ2!=".jpeg")&&($typ2!=".gif")&&($typ2!=".png")&&($typ2!=".doc")&&($typ2!=".xls")&&($typ2!=".mp3")&&($typ2!=".txt")&&($typ2!=".pdf")&&($typ2!=".html")&&($typ2!=".htm")&&($typ2==".zip")&&($typ2==".7z")&&($typ2==".mov")&&($typ2==".wmv")&&($typ2==".avi")&&($typ2==".flv")&&($typ2==".rar")&&($typ2==".exe")&&($typ2!=".ai")&&($typ2!=".cdr")){
continue;
} else {
if (($fileopend!="icon.png")&&($fileopend!="Thumbs.db")) {
$files_found2 += 1;
}
}
}
}
}
}
closedir ($handle2);
if (@file_exists("./archive".$bdi."$fileopen/icon.png")==TRUE) { $off=$htpath."/archive".str_replace("%2F","/", rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen"))))."/icon.png"; } else { if ($files_found2==0) {$off="$htpath/images/mini_folder.png";} else {$off="$htpath/images/mini_folder.png";}}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")) {
$jsmd=md5(str_replace("//","/",str_replace("//","/", "$i/$fileopen")));
if (!isset($lenn)) {$lenn=20;}
$ddir="<br><form class=form-inline action=\"$htpath/index.php\" method=GET>
<input type=hidden name=\"i\" value=\"".str_replace("//","/",str_replace("//","/",$i))."\">
<input type=hidden name=\"ren\" value=\"".$fileopen."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"isort\" value=\"$isort\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input type='hidden' name=\"ext\" value=\"\">
<input type=text name=\"newname\" size=\"$lenn\" value=\"$fileopen\"><input type=submit class=btn value=\"&gt;&gt;\" title=\"".$lang[390]."\"></form><br><small><b>CHMOD:</b> ".perms(fileperms(str_replace("//","/",str_replace("//","/", "./archive$i/$fileopen"))))."</small><br><br><form class=form-inline action=\"$htpath/index.php\" method=GET id=\"form".$jsmd."\">
<div style=\"display:none; visibility:hidden;\" id='tab".$jsmd."'><script language=javascript><!--
function js".$jsmd."() {
document.getElementById('tab".$jsmd."').style.display = 'inline';
document.getElementById('tab".$jsmd."').style.visibility = \"visible\";
document.getElementById('but".$jsmd."').style.display = \"none\";
document.getElementById('but".$jsmd."').style.visibility = \"hidden\";
}
function del".$jsmd."() {
document.getElementById('but".$jsmd."').style.display = \"inline\";
document.getElementById('but".$jsmd."').style.visibility = \"visible\";
document.getElementById('tab".$jsmd."').style.display = 'none';
document.getElementById('tab".$jsmd."').style.visibility = \"hidden\";
}
--></script>
<font color=#b94a48><b>$lang[745]</b></font><br><br>
<input type=submit value=\"".$lang['yes']."\">&nbsp;&nbsp;&nbsp;<input type=button value=\"".$lang['no']."\" onclick=\"javascript:del".$jsmd."()\"></div>
<input type=hidden name=\"i\" value=\"".$i."\">
<input type=hidden name=\"deldir\" value=\"".strtoken("$fileopen",".")."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"isort\" value=\"$isort\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input style=\"display:inline; visibility:visible;\" id='but".$jsmd."' type=button value=\"&nbsp;&nbsp;X&nbsp;&nbsp;".$lang[744]."\" onclick=\"javascript:js".$jsmd."()\">
</form>";
}}

$hiddir=0;
if ((substr($fileopen,0,5)=="users")||(substr($fileopen,0,11)=="attachments")||(substr($fileopen,0,7)=="avatars")) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
$hiddir=0;
} else {
$hiddir=1;
}
}
if ($hiddir==0) {
$fileopens[$s] = "<!-- 0 -->
<td align='left' valign='top' width=".floor(100/$archive_cols)."%><a href=\"$htpath/index.php?action=arch&isort=$isort&i=".rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen")))."\"><img src=\"".$off."\" align=absmiddle hspace=10 border=0><b>".strtoken("$fileopen",".")."</b></a> [$files_found3/".$files_found2."] $ddir
</td><td valign='top'>".date("d-M-Y H:i:s")."</td>";
$jjarch.="<li><a href=\"$htpath/index.php?action=arch&isort=$isort&i=".rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen")))."\"><img src=\"".$off."\" hspace=10 align=absmiddle border=0><b>".strtoken("$fileopen",".")."</b></a> [$files_found3/".$files_found2."]</li>\n";
$files_found += 1;
$s+=1;
}
} else {
if (($typ!=".jpg")&&($typ!=".jpeg")&&($typ!=".gif")&&($typ!=".png")&&($typ!=".doc")&&($typ!=".xls")&&($typ!=".mp3")&&($typ!=".txt")&&($typ!=".pdf")&&($typ!=".html")&&($typ!=".htm")&&($typ!=".zip")&&($typ!=".7z")&&($typ!=".mov")&&($typ!=".avi")&&($typ!=".wmv")&&($typ!=".flv")&&($typ!=".rar")&&($typ!=".exe")&&($typ!=".ai")&&($typ!=".cdr")){
continue;
} else {
if (($fileopen=="icon.png")&&($details[7]!="ADMIN")) {continue;} else {








//If you wish include link to file
$mpdir="./archive".$bdi;
// lets handle directory


if ((substr($fileopen,0,3)!="tn_")&&(strtolower($fileopen)!="icon.png"))  {
if (($typ==".xls")||($typ==".doc")||($typ==".pdf")||($typ==".mp3")||($typ==".txt")||($typ==".htm")||($typ==".zip")||($typ==".7z")||($typ==".mov")||($typ==".avi")||($typ==".wmv")||($typ==".flv")||($typ==".rar")||($typ==".exe")||($typ==".html")||($typ==".cdr")||($typ==".ai")) {

$fsizep=filesize("$mpdir".str_replace("%20"," ", $fileopen));
$totsize+=$fsizep;
if ($fsizep<=1024) {$fsizem="<b>". floor(filesize("$mpdir".str_replace("%20"," ", $fileopen))/1). "</b> bytes";}
if ($fsizep>1024) {$fsizem="<b>". floor(filesize("$mpdir".str_replace("%20"," ", $fileopen))/1024). "</b> Kb";}
if ($fsizep>1024000) {$fsizem="<b>".(0.01*floor((filesize("$mpdir".str_replace("%20"," ", $fileopen))*100)/1024000)). "</b> Mb";}
if ($fsizep>1024000000) {$fsizem="<b>". (0.01*floor((filesize("$mpdir".str_replace("%20"," ", $fileopen))*100)/1024000000)). "</b> Tb";}
$form1="";
$form2=@$ext;
$ftyname=substr("$fileopen",0,(strlen("$fileopen")-strlen($typ)));
$lenn=strlen($ftyname);
if ($lenn>=20) {$lenn==20;}
$idff="$mpdir".str_replace("%20"," ", "$fileopen").".idx";
$idxf="";
if (file_exists($idff)) {
$idxfo=fopen($idff,"r");
$idxf="<table border=0 width=100% cellpadding=10 cellspacing=0><tr><td valign='top'>".fread($idxfo,filesize($idff))."</td></tr></table>";
fclose($idxfo);
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")) {
$jsmd=md5(str_replace("//","/",str_replace("//","/",$i))."/$fileopen");
$form1="</a><form class=form-inline action=\"$htpath/index.php\" method=GET>
<input type=hidden name=\"i\" value=\"".str_replace("//","/",str_replace("//","/",$i))."\">
<input type=hidden name=\"ren\" value=\"".$fileopen."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"isort\" value=\"$isort\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input type='hidden' name=\"ext\" value=\"$typ\">
<input type=text name=\"newname\" size=\"".$lenn."\" value=\"";
$form2="\"><input type=submit value=\"&gt;&gt;\" title=\"".$lang[390]."\"></form></a><br>";
$ddel="<small><b>CHMOD:</b> ".perms(fileperms(str_replace("//","/",str_replace("//","/", "./archive$i/$fileopen"))))."</small><br><br><form class=form-inline action=\"$htpath/index.php\" method=GET id=\"fform".$jsmd."\">
<div style=\"display:none; visibility:hidden;\" id='ftab".$jsmd."'><script language=javascript><!--
function fjs".$jsmd."() {
document.getElementById('ftab".$jsmd."').style.display = 'inline';
document.getElementById('ftab".$jsmd."').style.visibility = \"visible\";
document.getElementById('fbut".$jsmd."').style.display = \"none\";
document.getElementById('fbut".$jsmd."').style.visibility = \"hidden\";
}
function fdel".$jsmd."() {
document.getElementById('fbut".$jsmd."').style.display = \"inline\";
document.getElementById('fbut".$jsmd."').style.visibility = \"visible\";
document.getElementById('ftab".$jsmd."').style.display = 'none';
document.getElementById('ftab".$jsmd."').style.visibility = \"hidden\";
}
--></script>
<font color=#b94a48><b>$lang[746]</b></font><br><br>
<input type=submit value=\"".$lang['yes']."\">&nbsp;&nbsp;&nbsp;<input type=button value=\"".$lang['no']."\" onclick=\"javascript:fdel".$jsmd."()\"></div>
<input type=hidden name=\"i\" value=\"".str_replace("//","/",str_replace("//","/",$i))."\">
<input type=hidden name=\"del\" value=\"".$fileopen."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"isort\" value=\"$isort\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input style=\"display:inline; visibility:visible;\" id='fbut".$jsmd."' type=button value=\"&nbsp;&nbsp;X&nbsp;&nbsp;".$lang[744]."\" onclick=\"javascript:fjs".$jsmd."()\">
</form><form class=form-inline action=\"$htpath/index.php\" method=POST id=\"ifform".$jsmd."\">
<div style=\"display:none; visibility:hidden;\" id='iftab".$jsmd."'><script language=javascript><!--
function ifjs".$jsmd."() {
document.getElementById('iftab".$jsmd."').style.display = 'inline';
document.getElementById('iftab".$jsmd."').style.visibility = \"visible\";
document.getElementById('ifbut".$jsmd."').style.display = \"none\";
document.getElementById('ifbut".$jsmd."').style.visibility = \"hidden\";
}
function ifdel".$jsmd."() {
document.getElementById('ifbut".$jsmd."').style.display = \"inline\";
document.getElementById('ifbut".$jsmd."').style.visibility = \"visible\";
document.getElementById('iftab".$jsmd."').style.display = 'none';
document.getElementById('iftab".$jsmd."').style.visibility = \"hidden\";
}
--></script>
<input type=button value=\"$lang[8]\" onclick=\"javascript:ifdel".$jsmd."()\"><br><br>
<textarea cols=38 rows=5 name=icoll style=\"width:100%\">".strip_tags($idxf)."</textarea><br>
<input type=submit value=\"OK\"><br><br></div>
<input type=hidden name=\"i\" value=\"".str_replace("//","/",str_replace("//","/",$i))."\">
<input type=hidden name=\"ifile\" value=\"".$fileopen."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"isort\" value=\"$isort\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input style=\"display:inline; visibility:visible;\" id='ifbut".$jsmd."' type=button value=\"&nbsp;&nbsp;X&nbsp;&nbsp;".$lang[8]."\" onclick=\"javascript:ifjs".$jsmd."()\">
</form>
";
}}
if ($typ==".mp3") {
$findmp3+=1;
$mtime=filemtime("./archive".$bdi."$fileopen");  if ($isort=="date") {$sortby=$mtime;  } else { $sortby=" ".$fileopen; }
$mp3s.="$htpath/archive".$bdi.$fileopen.",";
$id3 = new id3("./archive".$bdi."$fileopen");
if (($id3->lengths) !== -1) {
$time=", <b>" . $mpz['time'] . ":</b>&nbsp;" . floor((($id3->lengths)/60)) . "&nbsp;" . $mpz['min'] . "&nbsp;" . floor(60*(round((($id3->lengths)/60) , 2)- (floor((($id3->lengths)/60))))) . "&nbsp;" . $mpz['sec'] . "";
} else {
$time = "";
}
if (($id3->bitrate) !== "") {
$bits=", <b>" . $mpz['bitrate'] . ":</b>&nbsp;" . $id3->bitrate . "&nbsp;Кb/s";
} else {
$bits="";
}
if ((($id3->album) !== "") && (($id3->album) !== "                              ")) {
$album=", <b>" . $mpz['album'] . ":</b>&nbsp;" . $id3->album;
} else {
$album="";
}
if (($id3->genre) !== "") {
$genre=", <b>" . $mpz['genre'] . ":</b>&nbsp;" . $id3->genre;
} else {
$genre="";
}
if (($id3->artists) !== "") {
$artists="<b>" . $mpz['artist'] . ":</b>&nbsp;" . $id3->artists;
} else {
$artists="<b>" . $mpz['track'] . ":</b>&nbsp;" . str_replace(".mp3" , "", $fileopen);
}
if ((($id3->name) !== "") && (($id3->name) !== "                              ")) {
$mpname=", <b>" . $mpz['track'] . ":</b>&nbsp;" . $id3->name;
} else {
$mpname="";
}
$hears="<small><i>\n" . $artists . " \n" . $mpname . " \n"  . $bits . " \n" . $time . " \n" . $album . " \n" . " " . $id3->year . " \n" . $genre . "</i></small>\n";

$fileopens[$s] = "<!-- 0".$sortby." -->
<td align='left' valign='top' width=".floor(100/$archive_cols)."%><a href=\"$htpath/archive".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/",$bdi))).rawurlencode($fileopen))."\" target=\"_blank\"><img src=\"$htpath/images/mini_".str_replace(".","", substr($typ,-3)).".png\" hspace=10 align=absmiddle border=0 title=\"".substr(str_replace("\"","", strip_tags($idxf)),0, 150)."\"></a><a href=\"javascript:play('$htpath/archive".$bdi.$fileopen."')\">Play</a></b>&nbsp;|&nbsp;<b><a href=\"javascript:stop()\">Stop</a></b> $hears <a href=\"$htpath/archive".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/",$bdi))).rawurlencode($fileopen))."\" target=\"_blank\"><b>$form1".$ftyname."$form2</b></a> [$fsizem] $ddel".str_replace("\n","<br>", $idxf)."
</td><td valign='top' style=\"white-space:nowrap;\"><font size=1>".date("d-M-Y H:i:s",$mtime)."</font></td>";
$jjarch.="<li><a href=\"$htpath/archive".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/",$bdi))).rawurlencode($fileopen))."\" target=\"_blank\"><img src=\"$htpath/images/mini_".str_replace(".","", substr($typ,-3)).".png\" hspace=10 align=absmiddle border=0></a><a href=\"javascript:play('$htpath/archive".$bdi.$fileopen."')\">Play</a></b>&nbsp;|&nbsp;<b><a href=\"javascript:stop()\">Stop</a></b> $hears <a href=\"$htpath/archive".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/",$bdi))).rawurlencode($fileopen))."\" target=\"_blank\"><b>$ftyname</b></a> [$fsizem]</li>\n";
} else {
$mtime=filemtime("./archive".$bdi."$fileopen"); if ($isort=="date") {$sortby=$mtime;  } else { $sortby=" ".$fileopen; }
$fileopens[$s] = "<!-- 0".$sortby." -->
<td align='left' valign='top' width=".floor(100/$archive_cols)."%><a href=\"$htpath/archive".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/",$bdi))).rawurlencode($fileopen))."\" target=\"_blank\"><img src=\"$htpath/images/mini_".str_replace(".","", substr($typ,-3)).".png\" hspace=10 align=absmiddle border=0 title=\"".substr(str_replace("\"","", strip_tags($idxf)),0, 150)."\"><b>$form1".$ftyname."$form2</b></a> [$fsizem] $ddel ".str_replace("\n","<br>", $idxf)."</td><td valign='top' style=\"white-space:nowrap;\"><font size=1>".date("d-M-Y H:i:s",$mtime)."</font></td>";
$jjarch.="<li><a href=\"$htpath/archive".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/",$bdi))).rawurlencode($fileopen))."\" target=\"_blank\"><img src=\"$htpath/images/mini_".str_replace(".","", substr($typ,-3)).".png\" border=0><b>".$ftyname."</b></a> [$fsizem]</li>\n";
}
$files_found += 1;
$s+=1;
} else {






if (($typ==".jpg")||($typ==".jpeg")||($typ==".gif")||($typ==".png")) {
$mpdir="./archive".$bdi;
$tn="";

$fsizep=filesize("$mpdir".str_replace("%20"," ", $fileopen));
$totsize+=$fsizep;
if ($fsizep<=1024) {$fsizem="<b>". floor(filesize("$mpdir".str_replace("%20"," ", $fileopen))/1). "</b> bytes";}
if ($fsizep>1024) {$fsizem="<b>". floor(filesize("$mpdir".str_replace("%20"," ", $fileopen))/1024). "</b> Kb";}
if ($fsizep>1024000) {$fsizem="<b>".(0.01*floor((filesize("$mpdir".str_replace("%20"," ", $fileopen))*100)/1024000)). "</b> Mb";}
if ($fsizep>1024000000) {$fsizem="<b>". (0.01*floor((filesize("$mpdir".str_replace("%20"," ", $fileopen))*100)/1024000000)). "</b> Tb";}
$imagesz = getimagesize("./archive".$bdi."$fileopen");
                        $fwidth  = $imagesz[0];
                        $fheight = $imagesz[1];

$maxw=$gallery_maxwidth;
$widt=round($maxw*($imagesz[1]/($imagesz[0]+1)));
if ($widt==0){$widt=$maxw;}
if ($widt>$maxw){$widt=$maxw;}
$zoom="<img src=\"$image_path/bigger.png\" border=0 title=\"".$lang[140]."\" style=\"vertical-align: middle\">";
if (($fwidth<=$maxw)&&($fheight<=$maxw)){$maxw=$fwidth;$widt=$fheight; $zoom="";}

$wh="width=".$maxw." height=".$widt;
if (file_exists( "./archive".$bdi."tn_$fileopen")==TRUE) {
$wh=""; $tn="tn_";
}
$form1="";
$form2="";
$ftyname=substr("$fileopen",0,(strlen("$fileopen")-strlen($typ)));
$lenn=strlen($ftyname);
if ($lenn>=20) {$lenn==20;}
$idff="$mpdir".str_replace("%20"," ", "$fileopen").".idx";
$idxf="";
if (file_exists($idff)) {
$idxfo=fopen($idff,"r");
$idxf="<table border=0 width=100%><tr><td valign='top'>".fread($idxfo,filesize($idff))."</td></tr></table>";
fclose($idxfo);
}
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")) {
$jsmd=md5(str_replace("//","/",str_replace("//","/",$i))."/$fileopen");
$form1="<form class=form-inline action=\"$htpath/index.php\" method=GET>
<input type=hidden name=\"i\" value=\"".str_replace("//","/",str_replace("//","/",$i))."\">
<input type=hidden name=\"ren\" value=\"".$fileopen."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"isort\" value=\"$isort\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input type='hidden' name=\"ext\" value=\"$typ\">
<input type=text name=\"newname\" size=\"$lenn\" value=\"".$ftyname;
$form2="\"><input type=submit value=\"&gt;&gt;\" title=\"".$lang[390]."\"></form><br>";
$ddel="<small><b>CHMOD:</b> ".perms(fileperms(str_replace("//","/",str_replace("//","/", "./archive$i/$fileopen"))))."</small><br><br><form class=form-inline action=\"$htpath/index.php\" method=GET id=\"fform".$jsmd."\">
<div style=\"display:none; visibility:hidden;\" id='ftab".$jsmd."'><script language=javascript><!--
function fjs".$jsmd."() {
document.getElementById('ftab".$jsmd."').style.display = 'inline';
document.getElementById('ftab".$jsmd."').style.visibility = \"visible\";
document.getElementById('fbut".$jsmd."').style.display = \"none\";
document.getElementById('fbut".$jsmd."').style.visibility = \"hidden\";
}
function fdel".$jsmd."() {
document.getElementById('fbut".$jsmd."').style.display = \"inline\";
document.getElementById('fbut".$jsmd."').style.visibility = \"visible\";
document.getElementById('ftab".$jsmd."').style.display = 'none';
document.getElementById('ftab".$jsmd."').style.visibility = \"hidden\";
}
--></script>
<font color=#b94a48><b>$lang[746]</b></font><br><br>
<input type=submit value=\"".$lang['yes']."\">&nbsp;&nbsp;&nbsp;<input type=button value=\"".$lang['no']."\" onclick=\"javascript:fdel".$jsmd."()\"></div>
<input type=hidden name=\"i\" value=\"".str_replace("//","/",str_replace("//","/",$i))."\">
<input type=hidden name=\"del\" value=\"".$fileopen."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"isort\" value=\"$isort\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input style=\"display:inline; visibility:visible;\" id='fbut".$jsmd."' type=button value=\"&nbsp;&nbsp;X&nbsp;&nbsp;".$lang[744]."\" onclick=\"javascript:fjs".$jsmd."()\">
</form><form class=form-inline action=\"$htpath/index.php\" method=POST id=\"ifform".$jsmd."\">
<div style=\"display:none; visibility:hidden;\" id='iftab".$jsmd."'><script language=javascript><!--
function ifjs".$jsmd."() {
document.getElementById('iftab".$jsmd."').style.display = 'inline';
document.getElementById('iftab".$jsmd."').style.visibility = \"visible\";
document.getElementById('ifbut".$jsmd."').style.display = \"none\";
document.getElementById('ifbut".$jsmd."').style.visibility = \"hidden\";
}
function ifdel".$jsmd."() {
document.getElementById('ifbut".$jsmd."').style.display = \"inline\";
document.getElementById('ifbut".$jsmd."').style.visibility = \"visible\";
document.getElementById('iftab".$jsmd."').style.display = 'none';
document.getElementById('iftab".$jsmd."').style.visibility = \"hidden\";
}
--></script>
<input type=button value=\"$lang[8]\" onclick=\"javascript:ifdel".$jsmd."()\"><br><br>
<textarea cols=38 rows=5 name=icoll style=\"width:100%\">".strip_tags($idxf)."</textarea><br>
<input type=submit value=\"OK\">
<input type='hidden' name=\"isort\" value=\"$isort\"><br><br></div>
<input type=hidden name=\"i\" value=\"".str_replace("//","/",str_replace("//","/",$i))."\">
<input type=hidden name=\"ifile\" value=\"".$fileopen."\">
<input type=hidden name=\"action\" value=\"arch\">
<input type='hidden' name=\"perpage\" value=\"$perpage\">
<input type='hidden' name=\"start\" value=\"$start\">
<input style=\"display:inline; visibility:visible;\" id='ifbut".$jsmd."' type=button value=\"".$lang[8]."\" onclick=\"javascript:ifjs".$jsmd."()\">
</form>";
}}
$onkl=" onclick=\"javascript:window.open('$htpath/archive".str_replace("%2F", "/",rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen"))))."','fr$st','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no, width=".($fwidth+20).",height=".($fheight+20)."')\"";
if ($fancybox_enable!=1) {if ($form1=="") {$ftyname="<a href=#zoom$onkl>$ftyname</a>";}}
$mtime=filemtime("./archive".$bdi."$fileopen"); if ($isort=="date") {$sortby=$mtime;  } else { $sortby=" ".$fileopen; }
if ($fancybox_enable==1) {
//fancybox
$fileopens[$s] = "<!-- ".$sortby." -->
<td align='left' valign='top' width=".floor(100/$archive_cols)."%>
<a rel=\"example_group\" href=\"$htpath/archive".str_replace("%2F", "/",rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$fileopen"))))."\" title=\"".substr(str_replace("\"","", strip_tags($idxf)),0, 150)."\"><img border=0 hspace=10 src=\"$htpath/images/mini_".str_replace(".","", substr($typ,-3)).".png\" align=absmiddle border=\"0\" title=\"".substr(str_replace("\"","", strip_tags($idxf)),0, 150)."\">$ftyname</a>$form1$form2$ddel ".str_replace("\n","<br>", $idxf)." [$fsizem]</td><td valign='top' style=\"white-space:nowrap;\"><font size=1>".date("d-M-Y H:i:s",$mtime)."</font></td>";
} else {
$fileopens[$s] = "<!-- ".$sortby." -->
<td align='left' valign='top' width=".floor(100/$archive_cols)."%><a href='#OPEN'$onkl><img src=\"$htpath/images/mini_".str_replace(".","", substr($typ,-3)).".png\" border=\"0\" $wh align=absmiddle title=\"".substr(str_replace("\"","", strip_tags($idxf)),0, 150)."\"></a> <a href=#zoom$onkl>$zoom</a>&nbsp;<a href='#OPEN'$onkl>$ftyname</a>$form1$form2$ddel ".str_replace("\n","<br>", $idxf)." [$fsizem]
</td><td valign='top' style=\"white-space:nowrap;\"><font size=1>".date("d-M-Y H:i:s",$mtime)."</font></td>";
}
$jjarch.="<li><a href='#OPEN'$onkl><img src=\"$htpath/archive".str_replace("%2F", "/", rawurlencode(str_replace("//","/",str_replace("//","/", "$i/$tn$fileopen"))))."\" border=\"0\" $wh></a><br><b>$ftyname</b></li>\n";
$files_found += 1;
$s+=1;
}
}
}
}
}
}
}
closedir ($handle);
}

if ($findmp3>0) {

$hear ="<br><br>
<SCRIPT LANGUAGE='JavaScript'>
<!--

function play (arg) {
window.document.mp3play.SetVariable(\"_root.file\", arg);
window.document.mp3play.GotoFrame(3);
}
function play_juke (arg) {
window.document.mp3play.SetVariable(\"_root.file\", arg);
window.document.mp3play.SetVariable(\"_root.played\", \"Play all files on this page\");
window.document.mp3play.GotoFrame(3);
}
function stop () {
window.document.mp3play.GotoFrame(5);
}
-->
</SCRIPT>

<OBJECT
        CLASSID=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\"
        WIDTH=\"270\"
        HEIGHT=\"27\"
        CODEBASE=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab\"
        ID=\"mp3play\">
        <PARAM NAME=\"MOVIE\" VALUE=\"mp3play_jukebox2.swf\">
        <PARAM NAME=\"PLAY\" VALUE=\"false\">
        <PARAM NAME=\"LOOP\" VALUE=\"false\">
        <PARAM NAME=bgcolor VALUE=#FFFFFF>
        <PARAM NAME=\"QUALITY\" VALUE=\"high\">
        <PARAM NAME=\"SCALE\" VALUE=\"SHOWALL\">


        <EMBED
                NAME=\"mp3play\"
                bgcolor=#FFFFFF
                SRC=\"mp3play_jukebox2.swf\"
                WIDTH=\"270\"
                HEIGHT=\"27\"
                PLAY=\"false\"
                LOOP=\"false\"
                QUALITY=\"high\"
                SCALE=\"SHOWALL\"
                swLiveConnect=\"true\"
                ID=\"mp3play\"
                PLUGINSPAGE=\"http://www.macromedia.com/go/flashplayer/\">
        </EMBED>
</OBJECT><br>";


if ($findmp3>1) {

$hear.="<br>$carat <b><a title=\"$findmpz\" href=\"javascript:play_juke('" . $mp3s. "')\">".$lang[187]."</a></b><br><br>";

}


}
if ((!@$fileopens[0]) || (@$fileopens[0]=="")) {
	$fileopens[0]="";
	//$arch.="<a href=\"$htpath/index.php?action=arch&isort=$isort&i=".rawurlencode($backurl)."\"><img src='$htpath/images/ofb.png' border=0 align=middle hspace=10></a><a href=\"$htpath/index.php?action=arch&isort=$isort&i=".rawurlencode($backurl)."\"><small><i>".$lang['back_to_higher_level']."</i></small></a><br><br><br>";
	} else {
//сортировка по алфавиту//
reset ($fileopens);
if ($isort=="date") { $way="down"; }
$make_col=$archive_cols; //
$st=0;
$ddt=0;
if ($way=="up") {
sort($fileopens);
} else {
natcasesort($fileopens);
$res_tmp=array_reverse($fileopens);
unset($fileopens);
$fileopens=$res_tmp;
unset($res_tmp);
}
reset($fileopens);
$eee=1;
if ($start>$s){$start=(floor($s/$perpage))*$perpage; }
while ($st < $perpage) {
$gt = 0;
if ((!@$fileopens[($start+$st)]) || (@$fileopens[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$fileopens[($start+$st)]) || (@$fileopens[($start+$st)]=="")): $fileopens[($start+$st)]=""; $gt = 1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($st/2)) == "TRUE") {
$back=$nc6;
} else {
$back=$nc0;
}

$val = $fileopens[($start+$st)]; //см выше

$st += 1;

$ddt += 1;
$arch .= "$val\n";
if ($ddt>=$archive_cols) { $eee+=1; $ddt=0; $arch.="</tr></table><table border=0 cellpadding=2 cellspacing=0 width=100%><tr bgcolor=$back>";}
}

$arch.="";
$total = count ($fileopens)-$gt;
$numberpages = (ceil ($total/($perpage+0.000001)));

$startnew=$start+1;

$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;
$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"$htpath/index.php?action=arch&isort=$isort&start=" . ($start+$perpage) . "&i=".rawurlencode($i)."&perpage=$perpage\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"$htpath/index.php?action=arch&isort=$isort&start=0&i=".rawurlencode($i)."&perpage=\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"$htpath/index.php?action=arch&isort=$isort&start=" . ($start-$perpage) . "&i=".rawurlencode($i)."&perpage=$perpage\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
if ($start<=0) { $prevpage="<img src=\"$image_path/noprev.gif\" border=0 title=\"".$lang[163]."\">";}
if (($start+$perpage)>=$s){ $nextpage="<img src=\"$image_path/nonext.gif\" border=0 title=\"".$lang[163]."\">";}


$s=0;
$pp="";
$tt=0;
$ts=0;
$td=0;
if (($start<=0) &&(($start+$perpage)>=$s)){ $lang[104]="";}
while ($s < $numberpages) {
$tt+=1;
if (($tt>(11+round($start/$perpage)))||($tt<(round($start/$perpage)-10))) {if ($tt<(round($start/$perpage)-10)) {$td+=1;} else {$ts+=1;}}  else {
if (($start/$perpage)==$s) {
$curp=($s+1);
if (($s+1)==$numberpages) {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b>";
} else {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b> <img src=\"$image_path/a.gif\"> ";
}
} else {
if (($s+1)==$numberpages) {
$pp.= "<a href = \"$htpath/index.php?action=arch&isort=$isort&start=" . ($s*$perpage) . "&i=".rawurlencode($i)."&perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"$htpath/index.php?action=arch&isort=$isort&start=" . ($s*$perpage) . "&i=".rawurlencode($i)."&perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"$htpath/index.php?action=arch&isort=$isort&start=0&i=".rawurlencode($i)."&perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"$htpath/index.php?action=arch&isort=$isort&start=0&i=".rawurlencode($i)."&perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"$htpath/index.php?action=arch&isort=$isort&start=" . ($perpage*($numberpages-1)) . "&i=".rawurlencode($i)."&perpage=$perpage\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }

}
if ($isort=="date") {$lang['by_date']="<b>".$lang['by_date']."</b>";} else {$lang['by_name']="<b>".$lang['by_name']."</b>";}


if ($fancybox_enable==1) {
//fancybox
$garch.="</div>";
}
$jarch="";
$arch="$garch<center>$ppages<br><div align=right><small>".$lang['sort_by'].": <a href=\"$htpath/index.php?action=arch&isort=name&start=$start&i=".rawurlencode($i)."&perpage=$perpage\">".$lang['by_name']."</a> | <a href=\"$htpath/index.php?action=arch&isort=date&start=$start&i=".rawurlencode($i)."&perpage=$perpage\">".$lang['by_date']."</a></small></div><br>$hear<br></center><table border=0 cellspacing=0 cellpadding=2 width=100%>
<tr>
$arch
</tr>
</table>";
$fsizep=$totsize;
if ($fsizep<=1024) {$fsizem="<b>". floor($fsizep/1). "</b> bytes";}
if ($fsizep>1024) {$fsizem="<b>". floor($fsizep/1024). "</b> Kb";}
if ($fsizep>1024000) {$fsizem="<b>".(0.01*floor($fsizep*100/1024000)). "</b> Mb";}
if ($fsizep>1024000000) {$fsizem="<b>". (0.01*floor($fsizep*100/1024000000)). "</b> Tb";}
$arch.="<center><br>$ppages<br><hr size=1 noshade color=$nc10><div align=right><b>$lang[206]</b> ".$fsizem."</div><br></center>\n";
if ($notf==1) {$arch="ERROR!";}
?>
