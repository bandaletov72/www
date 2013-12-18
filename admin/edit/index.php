<?php
function ExtractString($str, $start, $end) {
$str_low = $str;
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

if(isset($_GET['working_file'])) $working_file=$_GET['working_file']; elseif(isset($_POST['working_file'])) $working_file=$_POST['working_file']; else unset($working_file);
//if (!preg_match("/^[a-z0-9_\.\/]+$/i",$working_file)) { $working_file="";}
$vpt="";
$adm="";
$fold="../.."; require ("../../templates/lang.inc");
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek']; else $speek="";
if (!preg_match("/^[a-z0-9A-Z_]+$/i",$speek)) { $speek="";}
if ($speek=="") {
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

require ("../../templates/$template/$language/vars.txt"); @setlocale(LC_CTYPE, $site_nls);
require ("../../templates/$template/$language/config.inc");
require ("../../templates/$template/css.inc");
function GetHeaders($ffc) {
global $adm;
global $lang;
global $vpt;
global $image_path;
global $speek;
global $htpath;
$out[1]="";
$out=explode("==",$ffc);
if (@$out[1]!="") {
$ptitle=trim(strtoken(strtoken(strip_tags(trim($out[1])),"["),"|"));
$vpt=$out[1];
unset($out);
} else {
$ptitle = "";
}
$p_url="";
$p_url=ExtractString($vpt,"[url]","[/url]");
$p_coord="";
$p_coord=ExtractString($vpt,"[coord]","[/coord]");
$comm="";
$comm=ExtractString($vpt,"[comm]","[/comm]");
$comms=$comm;
$imgs_arr=@explode("src=", $vpt);
$imgs=str_replace("\"", "", str_replace("\'", "", str_replace(">", "", str_replace("<", "",strtoken(strtoken(@$imgs_arr[1],">")," ")))));
unset ($imgs_arr);

$imgs_arr=explode("|", strip_tags(strtoken($vpt,"[")));
if (count($imgs_arr)>1) {
if ($imgs_arr[0]==$ptitle) {unset($imgs_arr[0]);}
$tags_s=implode(",", $imgs_arr);
} else {
$tags_s="";
}
$imgas="";
if ($imgs!="") {$imgas="<img src=\"$imgs\" id=\"img_1\">";$imgs="<img src=\"$imgs\">";} else {$imgas="<img src=\"$image_path/pix.gif\" id=\"img_1\">";}

$ffc=str_replace("==$vpt==", "", $ffc);

$adm= "<table border=0 class=table2 cellspacing=5 cellpadding=5 width=100% style=\"margin-bottom: 0;\">
<tr>
<td valign=top>
<table class=table border=0 width=100% style=\"margin-bottom: 0;\">
<tr>
<td align=right><b>".$lang[862].":</b></td>
<td width=100% colspan=2><input type=text size=20 style=\"width:96%\" name=\"p_title\" value=\"".htmlspecialchars($ptitle)."\"></td>
</tr>
<tr>
<td align=right><b>".$lang[861].":</b></td>
<td width=100%><input type=text id=\"el_1\" size=20 style=\"width:96%\" name=\"p_icon\" value=\"".htmlspecialchars($imgs)."\"></td>
<td align=right><a class=\"btn btn-success mr nowrap\" onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=1','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10');\" title=\"".$lang[938]."\"><i class=icon-camera></i> ".$lang[421]."</a></td>
</tr>
<tr>
<td colspan=3><b>".$lang['short'].":</b><br><input type=text size=20 style=\"width:96%\" name=\"p_comm\" value=\"".htmlspecialchars($comms)."\"></td>
</tr>
<tr>
<td colspan=3><b>".$lang[863].":</b><br><input type=text size=20 style=\"width:96%\" name=\"p_tags\" value=\"".htmlspecialchars($tags_s)."\"></td>
</tr>
</table>
</td>
<td valign=top align=right>
<div class=\"img-polaroid\" style=\"width:150px; height:150px; padding:10px 10px 10px 10px; margin-bottom:20px; cursor:pointer; cursor: hand; overflow:hidden;\" align=center onClick=\"javascript:window.open('$htpath/admin/newgal.php?speek=$speek&gtype=3&dest=1','gal','status=yes,scrollbars=yes,menubar=no,resizable=yes,location=no,width=800,height=400,left=10,top=10');\" title=\"".$lang[938]."\">$imgas<div class=muted>$lang[421]</div></div>
</td>
</tr>
<tr>
<td colspan=2><b>URL:</b> <input type=text size=20 style=\"width:85%\" name=\"p_url\" value=\"".htmlspecialchars($p_url)."\" placeholder=\"http://\"></td>
</tr>
<tr>
<td colspan=2><b>Loc:</b> <input type=text size=20 style=\"width:85%\" name=\"p_coord\" value=\"".htmlspecialchars($p_coord)."\" placeholder=\"x:y\"></td>
</tr>
</table>
";


return $ffc;

}
function imagify($img) {
global $htpath;
$str="abcdefghijklmnopqrstuvwxyz1234567890_";

$img=str_replace("src=\"http://", "src=\"-http://", $img);
$img=str_replace("src=\'http://", "src=\'-http://", $img);
$img=str_replace("src=http://", "src=-http://", $img);
$img=str_replace("src=\"https://", "src=\"-https://", $img);
$img=str_replace("src=\'https://", "src=\'-https://", $img);
$img=str_replace("src=https://", "src=-https://", $img);
$img=str_replace("src=\"file://", "src=\"-file://", $img);
$img=str_replace("src=\'file://", "src=\'-file://", $img);
$img=str_replace("src=file://", "src=-file://", $img);


$img=str_replace(" title=\"\"", "", $img);
$img=str_replace(" alt=\"\"", "", $img);
$img=str_replace(" title=''", "", $img);
$img=str_replace(" alt=''", "", $img);
$img=str_replace(" title= ", "", $img);
$img=str_replace(" alt= ", "", $img);
for($i=0; $i<strlen($str); $i++) {
$b=substr($str,$i,1);
$img=str_replace("src=\"$b", "src=\"../../$b", $img);
$img=str_replace("src=\'$b", "src=\'../../$b", $img);
//$img=str_replace("src=$b", "src=../../$b", $img);
}
$img=str_replace("src=\"-http://","src=\"http://",  $img);
$img=str_replace("src=\'-http://","src=\'http://",  $img);
$img=str_replace("src=-http://", "src=http://", $img);
$img=str_replace("src=\"-https://","src=\"https://",  $img);
$img=str_replace("src=\'-https://","src=\'https://",  $img);
$img=str_replace("src=^-https://","src=https://",  $img);
$img=str_replace("src=\"-file://","src=\"file://",  $img);
$img=str_replace("src=\'-file://","src=\'file://",  $img);
$img=str_replace("src=-file://","src=file://",  $img);
return ($img);
}
$editable_files_directory = "../.$base_loc/content/";
$err="";
$tl="en";
if ($speek=='rus') { $tl="ru";}
if ($speek=='ger') { $tl="de";}
if ($speek=='uam') { $tl="uk";}
if ($speek=='bra') { $tl="pt_BR";}
if ($speek=='lat') { $tl="lv";}
if ($speek=='ces') { $tl="cs";}
$dateformat=str_replace("Y", "%Y",str_replace("y", "Y", str_replace("dd", "d",str_replace("mm", "%m",str_replace("yy", "y", str_replace("yyyy", "yy", $ewc_dateformat))))));
$tiny1="<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<title>HTML Editor</title>
<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />
$css
<script type=\"text/javascript\" src=\"../../js/tiny_mce/tinymce.min.js\"></script>
<script>
tinymce.init({
    selector: \"textarea#elm1\",
    theme: \"modern\",
    width: \"99%\",
    height: 300,
    language : '".$tl."',
    plugins: [
    \"advlist autolink link image lists charmap print preview hr anchor pagebreak charmap\",
    \"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking\",
    \"save table contextmenu directionality emoticons template paste textcolor\" ],
   content_css: \"css/content.css\",
   image_advtab: true,
   toolbar: \"save cancel | undo redo | cut copy paste searchreplace | code print preview | visualblocks visualchars | charmap inserttime emoticons media | formatselect fontselect fontsizeselect | bold italic underline strikethrough subscript superscript | alignleft aligncenter alignright alignjustify | hr | forecolor backcolor | bullist numlist outdent indent | nonbreaking | table | link image | cutb\",
   setup: function(editor) {
            editor.addButton('cutb', {
            title: '".$lang[918]."',
                text: '[cut]',
                icon: false,
                onclick: function() {
                 editor.insertContent('[cut]');
                 }
            });
        },

   insertdatetime_dateformat: \"".$dateformat."\",
   insertdatetime_timeformat: \"%H:%M:%S\",
style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ],
    file_browser_callback: function(field_name, url, type, win) {
        tinymce.activeEditor.windowManager.open({
            title: \"My file browser\",
            url: \"../newgal.php?gtype=5\",
            width: 760,
            height: 500
        }, {
            oninsert: function(url,w,h) {
                win.document.getElementById(field_name).value = url;
                top.tinymce.activeEditor.windowManager.close();
            }
        });
    }
});


function func_zg () {
if (document.getElementById('ed').className=='active') {
var text = tinyMCE.activeEditor.getContent();
tinyMCE.get('elm1').hide();
} else {
tinyMCE.get('elm1').show();
tinyMCE.get('elm1').hide();
var text = tinyMCE.activeEditor.getContent();
}
document.getElementById('elm1').innerHTML=text;
document.getElementById('zag').className='mr ml';
document.getElementById('vid').className='hidden';
document.getElementById('sub').className='';
document.getElementById('elm1').className='hidden';
document.getElementById('zg').className='active';
document.getElementById('ht').className='';
document.getElementById('vi').className='';
document.getElementById('ed').className='';
return false;
}
function func_ed () {
var text = document.getElementById('elm1').innerHTML;
document.getElementById('zag').className='hidden';
document.getElementById('vid').className='hidden';
document.getElementById('sub').className='hidden';
document.getElementById('elm1').className='';
tinyMCE.get('elm1').show();
document.getElementById('elm1').innerHTML=text;
document.getElementById('vid').innerHTML=text;
document.getElementById('elm1').style.width='99%';
document.getElementById('elm1').style.height='300px';
document.getElementById('ed').className='active';
document.getElementById('vi').className='';
document.getElementById('zg').className='';
document.getElementById('ht').className='';
return false;
}
function func_ht () {
if (document.getElementById('ed').className=='active') {
var text = tinyMCE.activeEditor.getContent();
tinyMCE.get('elm1').hide();
} else {
tinyMCE.get('elm1').show();
tinyMCE.get('elm1').hide();
var text = tinyMCE.activeEditor.getContent();
}
document.getElementById('elm1').innerHTML=text;
document.getElementById('zag').className='hidden';
document.getElementById('vid').className='hidden';
document.getElementById('sub').className='';
document.getElementById('elm1').className='';
document.getElementById('elm1').style.width='96%';
document.getElementById('elm1').style.height='385px';
document.getElementById('ht').className='active';
document.getElementById('zg').className='';
document.getElementById('vi').className='';
document.getElementById('ed').className='';
return false;
}
function func_vi () {
if (document.getElementById('ed').className=='active') {
var text = tinyMCE.activeEditor.getContent();
tinyMCE.get('elm1').hide();
} else {
tinyMCE.get('elm1').show();
tinyMCE.get('elm1').hide();
var text = tinyMCE.activeEditor.getContent();
}
document.getElementById('vid').innerHTML=text;
document.getElementById('zag').className='hidden';
document.getElementById('vid').className='mr ml';

document.getElementById('sub').className='';
document.getElementById('elm1').className='hidden';
document.getElementById('vi').className='active';
document.getElementById('zg').className='';
document.getElementById('ht').className='';
document.getElementById('ed').className='';
return false;
}

function SaveCont () {
tinyMCE.get('elm1').show();
document.getElementById('forma').submit();
}
</script>

<!-- win.document.getElementById(field_name).value = 'my browser value'; -->


</head>
<body role=\"application\">
<form method=\"post\" id=forma action=\"index.php\">
	<div>
		<div>
		<input type=hidden name='working_file' value='".stripslashes($working_file)."'>
		<input type=hidden name='speek' value='".$speek."'>
            <div class=\"navbar\">
    <div class=\"navbar-inner\">
    <ul class=\"nav\">
    <li><a href=\"../editor/index.php\" ><b class=icon-chevron-left></b> CMS</a></li>
    <li id=zg><a href=\"#\" onclick=\"javascript: func_zg();\">".$lang[862]."</a></li>
    <li id=ed class=active><a href=\"#\" onclick=\"javascript: func_ed();\">".$lang[1613]."</a></li>
    <li id=ht><a href=\"#\" onclick=\"javascript: func_ht();\">HTML</a></li>
    <li id=vi><a href=\"#\" onclick=\"javascript: func_vi();\"><i class=icon-eye-open></i></a></li>

    <li>[err]</li></ul>
    </div>
    <textarea id=\"elm1\" name=\"elm1\" rows=\"15\" cols=\"80\" style=\"width: 99%; height: 300px;\">";

$tiny2="</textarea>
<div id=zag class=hidden>[zagolovok]</div>
<div id=vid class=hidden></div><div style=\"margin-left: 20px; margin-right: 20px;\"><div class=\"pull-left\" style=\"width:40%;\"><input type=text class=\"input-xlarge\" style=\"width:96%; margin-top:5px;\" name=\"reason\" value=\"\" placeholder=\"".$lang[1653]."\"></div><div class=\"small pull-right\" style=\"width:58%;\">".$lang[1654]."</div><div class=clearfix></div></div>
<div align=center id=sub class=hidden><input class=\"btn btn-primary btn-large\" onclick=SaveCont(); value=\"".$lang[527]."\"></div>
    </div>

		</div>
		<!--a class=btn href=\"javascript:;\" onclick=\"alert(tinyMCE.get('elm1').getContent());return false;\">[Get contents]</a>
		<a class=btn href=\"javascript:;\" onclick=\"alert(tinyMCE.get('elm1').selection.getContent());return false;\">[Get selected HTML]</a>
		<a class=btn href=\"javascript:;\" onclick=\"alert(tinyMCE.get('elm1').selection.getContent({format : 'text'}));return false;\">[Get selected text]</a-->

	</div>
</form>

<script type=\"text/javascript\">
if (document.location.protocol == 'file:') {
	alert(\"The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.\");
}
</script>
</body>
</html>";
if(isset($_GET['elm1'])) $elm1=$_GET['elm1']; elseif(isset($_POST['elm1'])) $elm1=$_POST['elm1']; else unset($elm1);
if (isset($elm1)) {
$code = str_replace("../../", "", stripslashes($elm1));
/*
        $code = remove_tags ($code, array(
                'object' => true,
                'embed' => true,
                'applet' => true,
                'script' => true
        ));
*/

if(isset($_GET['p_tags'])) $p_tags=$_GET['p_tags']; elseif(isset($_POST['p_tags'])) $p_tags=$_POST['p_tags']; else $p_tags="";
if(isset($_GET['p_comm'])) $p_comm=$_GET['p_comm']; elseif(isset($_POST['p_comm'])) $p_comm=$_POST['p_comm']; else $p_comm="";
if(isset($_GET['p_icon'])) $p_icon=$_GET['p_icon']; elseif(isset($_POST['p_icon'])) $p_icon=$_POST['p_icon']; else $p_icon="";
if(isset($_GET['p_title'])) $p_title=$_GET['p_title']; elseif(isset($_POST['p_title'])) $p_title=$_POST['p_title']; else $p_title="";
if(isset($_GET['p_url'])) $p_url=$_GET['p_url']; elseif(isset($_POST['p_url'])) $p_url=$_POST['p_url']; else $p_url="";
if(isset($_GET['p_coord'])) $p_coord=$_GET['p_coord']; elseif(isset($_POST['p_coord'])) $p_coord=$_POST['p_coord']; else $p_coord="";
if(isset($_GET['reason'])) $reason=$_GET['reason']; elseif(isset($_POST['reason'])) $reason=$_POST['reason']; else $reason="";
//save page with new titles
if(get_magic_quotes_gpc()) {
$p_icon=stripslashes($p_icon);
$p_title=stripslashes($p_title);
$p_comm=stripslashes($p_comm);
$p_url=stripslashes($p_url);
$p_tags=stripslashes($p_tags);
$p_coord=stripslashes($p_coord);
$reason=stripslashes($reason);
}

//save reason
if (trim($reason)!="") {
require "../../modules/translit.php";
$last_events_file="../.$base_loc/last_events.txt";
$last_events=Array();
if (file_exists($last_events_file)) {
$last_events=file($last_events_file);
if (count($last_events)>=$qty_last_events) {
$last_events=array_shift($last_events);
}
}
$w_arr=explode("/",$working_file);
if (($friendly_url==0)||($p_title=="")) {
$w_page=str_replace(".txt", "", array_pop($w_arr));
} else {
$w_page=translit($p_title);
}
if ($mod_rw_enable==1) {
$w_page="$w_page".".html";
} else {
$w_page="index.php?page=$w_page";
}
$fp=fopen($last_events_file,"w");
fputs($fp, implode("",$last_events).time()."|$w_page|$reason|$p_title|$p_icon|".strtoken(str_replace("\n","",str_replace("\r", "",substr(strip_tags($code),0,1000))),"[cut]")."\n");
fclose ($fp);
}
//end

if ($p_comm!="") {$p_comm="|[comm]".$p_comm."[/comm]";}
if ($p_coord!="") {$p_coord="[coord]".$p_coord."[/coord]";}
if ($p_url!="") {$p_url="[url]".$p_url."[/url]";}
if (trim(trim($p_tags))!="") {
$p_tags="|".str_replace(",", "|", str_replace("\n","", str_replace("\r","", trim(trim($p_tags)))));
if (substr($p_tags,-1)=="|"){
$p_tags=substr($p_tags,0,(strlen($p_tags)-1));

}
}
if ($p_tags!="") {
$p_tags="|".$p_tags;
}
if (trim(trim($p_title))=="") {
$p_title="";
}

$PHeders="$p_icon$p_title".str_replace("||","|",str_replace("||","|",str_replace("||","|", $p_tags)))."$p_comm"."$p_url"."$p_coord";

$extension = strrchr(strtolower($working_file),'.');

$writeme=fopen(stripslashes($working_file),"w");
if ($PHeders!="") { $PHeders="==".$PHeders."=="; }
if (fputs($writeme, $PHeders.$code)) {
$err= "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>".$lang[317]."</div>";
ob_start();

echo str_replace("[err]", "$err", $tiny1);
$fp=fopen(stripslashes($working_file), "r");
$fc=imagify(fread($fp,filesize(stripslashes($working_file))));
fclose ($fp);

$fc=GetHeaders($fc);

echo $fc;

$tiny2=str_replace("[zagolovok]", "$adm", $tiny2);
//$tiny2=str_replace("[prosmotr]", "$fc", $tiny2);

echo $tiny2;
ob_end_flush();

} else {
$err="<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><p>An error occured while attempting to save changes.</p>
<p>Check you have permission to modify the 'editable_files' directory</p>
<p><a href=\"../editor/index.php?speek=$speek\">".$lang['back']."</a></p></div>";

ob_start();

echo str_replace("[err]", "$err", $tiny1);

$elm1=GetHeaders(imagify($elm1));

echo $fc;

$tiny2=str_replace("[zagolovok]", "$adm", $tiny2);
//$tiny2=str_replace("[prosmotr]", "$fc", $tiny2);

echo $tiny2;
ob_end_flush();


}

// close the file
fclose($writeme);

// if no actions were requested but a file has been requested for editing then generate the editor:
} else if (isset($working_file)) {

// -----------------------------------------------------
// Generate the editor page:
// -----------------------------------------------------

// note the use of 'ob_start();' and 'ob_end_flush();' and also note the onSubmit event handler on the form tag.

ob_start();

echo str_replace("[err]", "", $tiny1);
$fp=fopen(stripslashes($working_file), "r");
$fc=imagify(fread($fp,filesize(stripslashes($working_file))));
fclose ($fp);

$fc=GetHeaders($fc);

echo $fc;
$tiny2=str_replace("[zagolovok]", "$adm", $tiny2);
//$tiny2=str_replace("[prosmotr]", "$fc", $tiny2);
echo $tiny2;
ob_end_flush();
}
?>
