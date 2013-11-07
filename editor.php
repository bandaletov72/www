<?php
//Редактор THTML
if(isset($_GET['working_file'])) $working_file=$_GET['working_file']; elseif(isset($_POST['working_file'])) $working_file=$_POST['working_file']; else $working_file="";
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$working_file)) { echo "Нельзя..."; exit;}
if ((!@$working_file) || (@$working_file=="")){ echo "Нельзя..."; exit; }
if (substr ("$working_file", -6) !=".thtml") {echo "Нельзя..."; exit;}
$fold="."; require ("./templates/lang.inc");
if(isset($_GET['speek'])) $speek=$_GET['speek']; elseif(isset($_POST['speek'])) $speek=$_POST['speek']; else $speek="";
if (!preg_match("/^[a-zA-Z0-9_]+$/i",$speek)) { $speek="";}
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

require ("./templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("./templates/$template/$speek/config.inc");
require("./modules/webcart.php");
session_cache_limiter ('nocache'); session_name(md5($_SERVER['HTTP_HOST'].$shopdir.$secret_salt)); if (isset($_REQUEST['session'])) { if (!preg_match('/^[a-zA-Z0-9_]+$/i',$_REQUEST['session'])) {session_id($_REQUEST['session']);}}  session_start(); $sid=@session_id(); if ((!isset($_SESSION["user_currency"]))||($_SESSION["user_currency"]=="")){$currency=$init_currency; }

if ((!@$logout) || (@$logout=="")): $logout=""; endif;
if ($logout==1): $_SESSION["user_login"]="";  $_SESSION["user_password"]=""; $_SESSION["user_valid"]="0"; $valid="0"; session_destroy(); endif;

$cart =& $_SESSION['cart'];
if(!is_object($cart)){
$cart = new webcart();
if ((!@$_SESSION["user_valid"]) || (@$_SESSION["user_valid"]=="")): @$_SESSION["user_login"]; @$_SESSION["user_password"]; $_SESSION["user_valid"]=""; endif;
if ($_SESSION["user_valid"]="") {
$_SESSION["user_login"]="";
$_SESSION["user_password"]="";
$_SESSION["user_valid"]="0";
}
}
if (!isset($login)){$login="";}
if (!isset($password)){$password="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$login)) { $login="";}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i",$password)) { $password="";}
if ((!@$login) || (@$login=="")): $login=""; endif;
if ((!@$password) || (@$password=="")): $password=""; endif;
$valid=@$_SESSION["user_valid"];
if ((!@$valid) || (@$valid=="")): $valid="0"; endif;
if (( @$_SESSION["user_login"]!="")&&( @$_SESSION["user_password"]!="")): $login=$_SESSION["user_login"]; $password=$_SESSION["user_password"]; endif;
if (($valid=="0")&&($login!="")&&($password!="")): $valid=$cart->authorize("$login","$password"); endif;
if (($valid=="1")&&($login!="")&&($password!="")): $_SESSION["user_login"]=$login;  $_SESSION["user_password"]=$password; $_SESSION["user_valid"]="1"; endif;
$details = $cart->get_details();
if (($valid=="1")&&($details[7]=="ADMIN")) {

// NOTE: user authentication is only available with Apache Servers.

// change this value to the User Name you want to use:
/*$user_name = "admin";

// change this value to the password you want to use:
$password =  "password";

if  (!isset($_SERVER['PHP_AUTH_USER'])) {
//If empty send header causing dialog box to appear
        header('WWW-Authenticate: Basic realm="Editable Files"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Authorization required.';
        exit;
} else if (($_SERVER['PHP_AUTH_USER'] != $user_name) && ($_SERVER['PHP_AUTH_PW'] != $password)) {
        header('WWW-Authenticate: Basic realm="Editable Files"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Authorization required.';
        exit;
}
 */
// WHAT THIS FILE DOES:
// First we are going to check if we need to perform a save function and if so we will perform one.
// If not we will check if a file has been requested for editing, if one has then we will display the editor.
// Else if nothing has been requested we will display a form where the user can choose a file to edit.

// Note the use of stripslashes for all variables sent through form post and get


// SETUP:

// Change this to the physical file path to the folder containing the documents you want to edit:

$editable_files_directory = "$base_loc/content/";

// Change this to the web path to the folder containing the documents you want to edit:

$editable_files_web_directory = "$base_loc/content/";

// CHECK THAT THESE INCLUDES POINT CORRECTLY:

include_once ('./editor_files/editor_functions.php');
include_once ('./editor_files/config.php');
include_once ('./editor_files/editor_class.php');


// NO NEED TO CHANGE ANYTHING BEYOND HERE -------------------------------------------------------------------

// checks whether to perform a save or not
if ((isset($htmlCode)) && (isset($htmlCode)) && (!isset($return_from_preview))) {

        // Perform Save:

        // put the HTML code in a variable for processing
        $code = stripslashes($htmlCode);

        // break apart excessively long words
        $code = longwordbreak ($code, 400, ' ');

        // remove unwanted tags
        // Uncomment the block of code to remove unwanted tags. You can change the tags that are removed.
        /*
        $code = remove_tags ($code, array(
                'object' => true,
                'embed' => true,
                'applet' => true,
                'script' => true
        ));
        */

        // If we were editing a PHP file convert PHP tags back into PHP tags
        $extension = strrchr(strtolower($working_file),'.');
        if ($extension == '.php') {
                $code = comm2php($code);
        } else
        // If we were editing an ASP file convert ASP tags back into ASP tags
        if ($extension == '.asp' || $extension == '.aspx') {
                $code = comm2asp($code);
        }

        // encode special characters
        $code = fixcharacters($code);

        // encode and protect email addresses
        $code = email_encode($code);

        // open the file
        $writeme=fopen(stripslashes($working_file),"w");

        // write to the file
        // include the save action in an 'if' statement so we can check if it worked:
        if (fputs($writeme, $code)) {
                echo "<p>Спасибо. Ваши изменения были сохранены.</p>
                <p><a href=\"admin/editor/index.php?speek=$speek\">Возврат в панель управления</a></p>";
        } else {
                echo "<p>An error occured while attempting to save changes.</p>
                <p>Check you have permission to modify the 'editable_files' directory</p>
                <p><a href=\"admin/editor/index.php?speek=$speek\">Возврат в панель управления</a></p>";
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

echo "<!DOCTYPE html><html>
<head>
<title>Editor</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$codepage\">";

?>
<script type="text/JavaScript" src="/editor_files/js/dialogEditorShared.js"></script>
<script type="text/JavaScript">
var image_action = true
function openImageWindow() {
        var return_function = "setImage" // must be the name of the function you want to call when an item is chosen. This should be string containing only letters and numbers.
        wp_openDialog('/editor_files/dialog_frame.php?window=image.php&return_function='+return_function, 'modal',730,466)
}
function setImage(iurl, iwidth, iheight, ialign, ialt, iborder, imargin) {
        document.form1.image.value=iurl;
}
function openDocWindow() {
        var return_function = "setDocument" // must be the name of the function you want to call when an item is chosen. This should be string containing only letters and numbers.
        wp_openDialog('/editor_files/dialog_frame.php?window=document.php&return_function='+return_function, 'modal',730,466)
}
function setDocument(iHref,iTarget,iTitle) {
        document.form1.document.value=iHref;
}
</script>
</head>
<body>
<b>Редактирование страницы</b>
<form id="editorForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<!-- begin PHP code for displaying the editor -->
<?php
// start a new wysiwygPro object
if (@file_exists(stripslashes($working_file))==FALSE){echo "Not found!"; exit;}
$editor = new wysiwygPro();

// insert the code into the editor
$editor->set_code($code = implode("", @file(stripslashes($working_file))));

// add a save button to the toolbar:
$editor->set_savebutton('save');

// add a custom cancel button:
$editor->addbutton('Cancel', 'before:print', "document.location.replace('".$_SERVER['PHP_SELF']."')", 'cancel.gif', 22, 22, 'undo');

// add a spacer:
$editor->addspacer('', 'after:cancel');

// uncomment if you want to use XHTML:
//$editor->usexhtml(true, "iso-8859-1", "en");

// dynamically generate links for the hyperlink window
// this is a recursive function for automatically generating links to files and subdirectories!
function build_link_array($directory='', $address='', $level=0, $links=array()) {
        $handle=opendir($directory);
        while (false!==($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                        if (@file_exists($directory.$file) && !is_file($directory.$file)) {
                                $foo = array($level, 'folder', $file);
                                array_push($links, $foo);
                                $links = build_link_array($directory.$file.'/', $address.$file.'/', $level+1, $links );
                        } else {
                                $foo = array($level, $directory.$file, $file);
                                array_push($links, $foo);
                        }
                }
        }
        closedir($handle);
        return $links;
}
$editor->set_links(build_link_array($editable_files_directory, $editable_files_web_directory));

// specify fonts for the font menu
$editor->set_fontmenu('Arial; Arial Black; Times New Roman; Courier New; Georgia; Verdana; Geneva; Tahoma; Wingdings');

// print the editor
$editor->print_editor('100%', 400);

?>
<!-- record which file we are editing so that when we come to save we know what we are saving!!!! -->
<input type="hidden" value="<?php echo $speek; ?>" name="speek">
<input type="hidden" value="<?php echo stripslashes($working_file); ?>" name="working_file">

</form>
</body>
</html>
<?php
ob_end_flush();
// if no actions have been requested and no file has been requested for editing then display a form where the user can select a file to edit:
} else {
?>
<!DOCTYPE html><html>
<head>
<title>Выберите файл для редактирования</title>
<script type="text/javascript">
// this function powers the expanding tree menu
function clickHandler(src) {
        if (document.getElementById('d_'+src.id)) {
                var targetElement = document.getElementById('d_'+src.id);
                if (targetElement.style.display == "none") {
                        targetElement.style.display = "";
                        src.src = 'open.gif';
                } else {
                        var bods = targetElement.getElementsByTagName('TBODY')
                        for (i=0; i>bods.length; i++) {
                                bods[i].style.display = "none";
                        }
                        targetElement.style.display = "none";
                        src.src = 'closed.gif';
                }
        }
}
</script>
<style type="text/css">
#treeBar {
        border-bottom: 1px solid #999999;
        background-color: #cccccc;
        font-weight:400;
}
#treeHolder {
        border: 1px solid #999999;
}
.treeRow {
        border-top: 1px solid #eeeeee;
}
</style>
</head>
<body>

<h4>Choose a file to edit</h4>

<p>Choose a page to edit and then hit the submit button:</p>

<form name="choose" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div id="treeHolder">
<div id="treeBar">&nbsp;Pick&nbsp&nbsp<span style="color:#999999">|</span>&nbsp;Name&nbsp;</div>
<?php
// open the directory
// this is a recursive function that builds the list of files including subfolders so that you can select a file to edit
$fnum = 0;
function build_file_list($file_directory, $web_directory, $level = 1) {
        global $fnum;
        $handle=opendir($file_directory);
        // loop through the files in the directory generating a list of files
        $i=0;
        $padding = $level*38;
        while (false!==($file = readdir($handle))) {
                $extension = strrchr(strtolower($file),'.');
                if ($file != "." && $file != "..") {
                        if (@file_exists($file_directory.$file) && !is_file($file_directory.$file)) {
                                $type = 'folder';
                        } else {
                                $type = 'file';
                        }
                        echo "<div class=\"treeRow\">";
                        if ($type == 'folder') {
                                //
                        //} else if ($extension == '.htm' || $extension == '.html' || $extension == '.php') {
                        } else {
                                echo "<input style=\"margin-right:".($padding-3)."px\" type=\"radio\" value=\"$file_directory$file\" name=\"working_file\">";
                        }
                        if ($type == 'folder') {
                                echo "<img style=\"margin-left:".$padding."px;cursor: pointer; cursor: hand\" id=\"_".preg_replace("/[^A-Za-z0-9]/smi", "", $file_directory.$file)."\" onclick=\"clickHandler(this)\" src=\"closed.gif\" width=\"16\" height=\"16\" align=\"absmiddle\" title=\"\"><img src=\"".WP_WEB_DIRECTORY."images/folder.gif\" width=\"22\" height=\"22\" align=\"absmiddle\" title=\"\">$file";
                        //} else if ($extension == '.htm' || $extension == '.html' || $extension == '.php') {
                        } else {
                                echo "<img src=\"".WP_WEB_DIRECTORY."images/htm_icon.gif\" width=\"22\" height=\"22\" align=\"absmiddle\" title=\"\">$file";
                        }

                        if ($type == 'folder') {
                                echo "<div id=\"d__".preg_replace("/[^A-Za-z0-9]/smi", "", $file_directory.$file)."\" style=\"display:none;\">";
                                build_file_list($file_directory.$file.'/', $web_directory.$file.'/', $level + 1) ;
                                echo "</div>";
                                $fnum ++;
                        }
                        echo "
                        </div>";
                        $i ++;
                }
        }
        closedir($handle);
}
build_file_list($editable_files_directory, $editable_files_web_directory);
echo "
</table></div>
<p><input type=\"submit\" class=\"btn btn-primary\" value=\"Submit\"></p>
</form>
</body>
</html>";
 }
 } else {
echo "Вам следует авторизироваться, чтобы выполнить это действие...";
 }
