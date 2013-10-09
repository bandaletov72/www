<?php
$inbox_list="";
if (isset($_GET['sub'])) { $sub=$_GET['sub']; } elseif(isset($_POST['sub'])) { $sub=$_POST['sub']; } else { $sub=""; }
if (!preg_match('/^[0-9a-z]+$/i',$sub)) { $sub="";}
if (($details[7]!="") &&($details[1]!="")&&($details[1]!="_")&&($details[1]!="guest")&& ("$valid"=="1")) {
$mesfile="./admin/userstat/".$details[1]."/messages/mes.txt";
if (file_exists($mesfile)) {
$tmp2=file($mesfile);
$tmp3=array_reverse($tmp2);
unset ($tmp2);
$inbox_list.="<h4>$lang[1484]:</h4>";
if (count($tmp3)>0) {

$count=0;
while(list($key,$val)=each($tmp3)) {
$tmp=explode("|",trim($val));
$inbox_list.="<table class=round2 style=\"width:100%;\" width=100% border=0 cellpadding=5><tr><td valign=top><img src=$image_path/pix.gif border=0 width=150 height=1><br>".$tmp[12]."<br><b>".$tmp[6]."</b><br>";
if ($details[1]!=$tmp[6]) { $inbox_list.="<a href=\"#Send Private Message\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$tmp[6]."&speek=".$speek."','".md5($tmp[6])."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10')\"><img src=\"$image_path/sm.png\" title=\"".$lang[1075]."\" align=\"absmiddle\" border=\"0\"></a>"; }
$inbox_list.="</td><td valign=top width=100%><div style=\"float:right; margin:5px;\"><font size=5 color=#b94a48>NEW!</font> ".date("d-m-Y H:i:s", $tmp[0])."</div><b>".$tmp[7]."</b> - <i>".$tmp[10]."</i> <br><small>".$tmp[9]." / ".strtoken($tmp[11]," (")."</small><br><br><b>".$tmp[1]."</b><br>".$tmp[2]."</td></tr></table>\n";
$count++;
}
} else {
$inbox_list.="$lang[1483]";
}
if ($sub=="") {
$mesfile2="./admin/userstat/".$details[1]."/messages/arch.txt";
if (file_exists($mesfile2)) {
$fcontm=file($mesfile2);
if (count($fcontm)>40) {
//strip_array
$ccount=0;
$tmpc="";
$tmpc2="";
while(list($key2,$val2)=each ($fcontm)) {
if ($ccount<=20) {
$tmpc.=$val2;
$fcontm2[]=$val2;
} else {
$tmpc2.=$val2;
}
$ccount++;
}
$fcontm=$fcontm2;
$fp=fopen("./admin/userstat/".$details[1]."/messages/".time()."_arch.txt","w");
fputs($fp,$tmpc2);
fclose ($fp);
$fp=fopen("./admin/userstat/".$details[1]."/messages/arch.txt","w");
fputs($fp,$tmpc);
fclose ($fp);

}
} else {
$fcontm=Array();
}

if ($count>0) {
$fp=fopen($mesfile2,"w");
fputs($fp,implode("", $tmp3).implode("", $fcontm));
fclose ($fp);
$fp=fopen($mesfile,"w");
fputs($fp,"");
fclose ($fp);
}

$inbox_list.="<h4>$lang[1485]:</h4>";
if (count($fcontm)>0) {

while(list($key,$val)=each($fcontm)) {
if (trim($val)!="") {
$tmp=explode("|",trim($val));
$inbox_list.="<table class=round2 style=\"width:100%;\" width=100% border=0 cellpadding=5><tr><td valign=top><img src=$image_path/pix.gif border=0 width=150 height=1><br>".$tmp[12]."<br><b>".$tmp[6]."</b><br>";
if ($details[1]!=$tmp[6]) { $inbox_list.="<a href=\"#Send Private Message\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$tmp[6]."&speek=".$speek."','".md5($tmp[6])."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10')\"><img src=\"$image_path/sm.png\" title=\"".$lang[1075]."\" align=\"absmiddle\" border=\"0\"></a>"; }
$inbox_list.="</td><td valign=top width=100%><div style=\"float:right; margin:5px;\">".date("d-m-Y H:i:s", $tmp[0])."</div><b>".$tmp[7]."</b> - <i>".$tmp[10]."</i> <br><small>".$tmp[9]." / ".strtoken($tmp[11]," (")."</small><br><br><b>".$tmp[1]."</b><br>".$tmp[2]."</td></tr></table>\n";
}
}
}

} else {
$mesfile2="./admin/userstat/".$details[1]."/messages/".$sub."_arch.txt";
if (file_exists($mesfile2)) {
$fcontm=file($mesfile2);
while(list($key,$val)=each($fcontm)) {
if (trim($val)!="") {
$tmp=explode("|",trim($val));
$inbox_list.="<table class=round2 style=\"width:100%;\" width=100% border=0 cellpadding=5><tr><td valign=top><img src=$image_path/pix.gif border=0 width=150 height=1><br>".$tmp[12]."<br><b>".$tmp[6]."</b><br>";
if ($details[1]!=$tmp[6]) { $inbox_list.="<a href=\"#Send Private Message\" onclick=\"javascript:window.open('chat.php?ch=main&privat=".$tmp[6]."&speek=".$speek."','".md5($tmp[6])."','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=460,left=10,top=10')\"><img src=\"$image_path/sm.png\" title=\"".$lang[1075]."\" align=\"absmiddle\" border=\"0\"></a>"; }
$inbox_list.="</td><td valign=top width=100%><div style=\"float:right; margin:5px;\">".date("d-m-Y H:i:s", $tmp[0])."</div><b>".$tmp[7]."</b> - <i>".$tmp[10]."</i> <br><small>".$tmp[9]." / ".strtoken($tmp[11]," (")."</small><br><br><b>".$tmp[1]."</b><br>".$tmp[2]."</td></tr></table>\n";
}
}
}
}
$inbox_list.="<div align=center>";
if ($sub=="") {
$inbox_list.=" <button style=\"background:$nc10;\"><font size=3><b>1</b></font></button> ";

} else {
$inbox_list.=" <button onclick=\"javascript:document.location.href='".$htpath."/index.php?action=inbox&sub=';\"><font size=3>1</font></button> ";
}

$handle=opendir("./admin/userstat/".$details[1]."/messages/");
$fcount=2;
while (($f6 = readdir($handle))!==FALSE) {
if (($f6 == '.') || ($f6 == '..') || (substr($f6,-4) != '.txt')|| ($f6 == 'arch.txt')|| ($f6 == 'mes.txt')) {
continue;
} else {

$inutime=str_replace("_arch.txt", "", $f6);
if ($sub==$inutime) {
$inbox_list.=" <button style=\"background:$nc10;\"><font size=3><b>".$fcount."</b></font></button> ";

} else {
$inbox_list.=" <button onclick=\"javascript:document.location.href='".$htpath."/index.php?action=inbox&sub=".$inutime."';\"><font size=3>".$fcount."</font></button> ";
}
$fcount++;
}
}
closedir($handle);
$inbox_list.="</div>";

} else {
$inbox_list=$lang[1483];
}

}
?>
