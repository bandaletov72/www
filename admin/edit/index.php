<?php
if(isset($_GET['working_file'])) $working_file=$_GET['working_file']; elseif(isset($_POST['working_file'])) $working_file=$_POST['working_file']; else unset($working_file);
//if (!preg_match("/^[a-z0-9_\.\/]+$/i",$working_file)) { $working_file="";}

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
   toolbar: \"save cancel | undo redo | cut copy paste searchreplace | code print preview | visualblocks visualchars | charmap inserttime emoticons media | formatselect fontselect fontsizeselect | bold italic underline strikethrough subscript superscript | alignleft aligncenter alignright alignjustify | hr | forecolor backcolor | bullist numlist outdent indent | nonbreaking | table | link image |\",
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
</script>

<!-- win.document.getElementById(field_name).value = 'my browser value'; -->


</head>
<body role=\"application\">
<form method=\"post\" action=\"index.php\">
	<div>
		<div>
		<input type=hidden name='working_file' value='".stripslashes($working_file)."'>
		<input type=hidden name='speek' value='<?php echo $speek; ?>'>
            <div class=\"navbar\">
    <div class=\"navbar-inner\">
    <ul class=\"nav\">
    <li id=ed class=active><a href=\"#\" onclick=\"tinyMCE.get('elm1').show(); document.getElementById('elm1').style.width='99%'; document.getElementById('elm1').style.height='300px'; document.getElementById('ed').className='active'; document.getElementById('ht').className=''; return false;\">".$lang[1613]."</a></li>
    <li id=ht><a href=\"#\" href=\"javascript:;\" onclick=\"tinyMCE.get('elm1').hide(); document.getElementById('elm1').style.width='96%'; document.getElementById('elm1').style.height='385px'; document.getElementById('ht').className='active'; document.getElementById('ed').className='';return false;\">HTML</a></li>
    <li>[err]</li></ul>
    </div>
    <textarea id=\"elm1\" name=\"elm1\" rows=\"15\" cols=\"80\" style=\"width: 99%; height: 300px;\">";

$tiny2="</textarea>
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
        $extension = strrchr(strtolower($working_file),'.');

        $writeme=fopen(stripslashes($working_file),"w");
        if (fputs($writeme, $code)) {
                $err= "<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>".$lang[317]."</div>";
                ob_start();

echo str_replace("[err]", "$err", $tiny1);
$fp=fopen(stripslashes($working_file), "r");
$fc=imagify(fread($fp,filesize(stripslashes($working_file))));
fclose ($fp);
echo $fc;

echo $tiny2;
ob_end_flush();

        } else {
                $err="<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><p>An error occured while attempting to save changes.</p>
                <p>Check you have permission to modify the 'editable_files' directory</p>
                <p><a href=\"../editor/index.php?speek=$speek\">".$lang['back']."</a></p></div>";

ob_start();

echo str_replace("[err]", "$err", $tiny1);
echo imagify($elm1);

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
$fc=fread($fp,filesize(stripslashes($working_file)));
fclose ($fp);
echo imagify($fc);

echo $tiny2;
ob_end_flush();
}
?>
