<?php
//format: name|rss_url|pattern|encoding charset from|encoding charset to|
$rssurl= Array(
0=>"Internet news|http://news.yandex.ru/internet.rss|#<item>.*?<title>(.*?)<\/title>.*?<link>(.*?)<\/link>.*?<description>(.*?)<\/description>.*?<pubDate>(.*?)<\/pubDate>.*?<\/item>#si|utf-8|windows-1251|",
1=>"Interesting|http://feeds.feedburner.com/Frenzyshoppernews?format=xml|#<item>.*?<title>(.*?)<\/title>.*?<link>(.*?)<\/link>.*?<description>(.*?)<\/description>.*?<pubDate>(.*?)<\/pubDate>.*?<\/item>#si|utf-8|windows-1251|",
);

//$jg=(($gallery_maxwidth*$gallery_cols)+90)."px"; //width of jquery gallery
$jg="100%"; //width of jquery gallery

if (!isset($_SESSION["partner_id"])) {$_SESSION["partner_id"]="";}
if (!isset($pid)) { $pid=""; }
if (!eregi('^[a-zA-Z0-9\._]+$',$pid)) { $pid="";}
if ($pid!="") {$_SESSION["partner_id"]=$pid;}
//def colors DONT TUCH THIS!
if ((isset($_SESSION["user_czeme"]))&&(substr($_SESSION["user_czeme"],0,1)=="#" )) {
$thnum=doubleval(str_replace("#","", $_SESSION["user_czeme"]));
$nnc=file("$fold"."/templates/$template/colors"."/themes.txt");
if (isset($nnc[$thnum])) {
$colrmas=explode("|", $nnc[$thnum]); $qcol=0; $zemname="#$thnum ".$colrmas[0]; while (list ($colrkey, $colrval) = each ($colrmas)) {if (($colrval!="")&&($colrval!="\n")) { if ($qcol>0) { $opp="nc".($qcol-1); $$opp=$colrval; } $qcol+=1;}}
$nnc=fopen("$fold"."/templates/$template/colors"."/colors.txt","r");$colr=fread ($nnc, filesize("$fold"."/templates/$template/colors"."/colors.txt"));fclose ($nnc);unset ($nnc);$colrmas=explode("|", $colr); $qcol=0; while (list ($colrkey, $colrval) = each ($colrmas)) {if (($colrval!="")&&($colrval!="\n")) {$opp="onc".$qcol; $$opp=$colrval;$qcol+=1;}}
$repp=1;
} else {


$nnc=fopen("$fold"."/templates/$template/colors"."/colors.txt","r");$colr=fread ($nnc, filesize("$fold"."/templates/$template/colors"."/colors.txt"));fclose ($nnc);unset ($nnc);$colrmas=explode("|", $colr); $qcol=0; while (list ($colrkey, $colrval) = each ($colrmas)) {if (($colrval!="")&&($colrval!="\n")) {$opp="nc".$qcol; $$opp=$colrval;$qcol+=1;}}
}
} else {
$nnc=fopen("$fold"."/templates/$template/colors"."/colors.txt","r");$colr=fread ($nnc, filesize("$fold"."/templates/$template/colors"."/colors.txt"));fclose ($nnc);unset ($nnc);$colrmas=explode("|", $colr); $qcol=0; while (list ($colrkey, $colrval) = each ($colrmas)) {if (($colrval!="")&&($colrval!="\n")) {$opp="nc".$qcol; $$opp=$colrval;$qcol+=1;}}
}

$line_height="120%";
$style = array (
'catid_desc'          =>   1,             #default - 1 or enter 0 to disable Category HTML description (located like x****.txt in admin/content folder)
'dirs_l'          =>   $view_dirs_l,             #default - 0 view catalogues images
'dirs_h'          =>   $view_dirs_h,             #default - 0 view catalogues as horizontal
'dirs_v'          =>   $view_dirs_v,             #default - 0 view catalogues as vertical
'dirs_j'          =>   $view_dirs_j,             #default - 0 view catalogues as exploded list
'view_s'          =>  0,             #default - 0 view statii
'cat_h'          =>   40,
'cat_w'          =>   40,
'spec_h'          =>   40,
'spec_w'          =>   40,
'cat_vsp'          =>   1,
'cat_hsp'          =>   1,

'shop_width'          =>   "100%",         #Shop width default is 95%
'cellpadding'         =>   0,             #Cellpadding in the block cells
'tbgcolor'            =>   "$nc0",     #maintable bgcolor

'bordercolor'         =>   "#FAfafa", #image border color

//new

'nav_col1'         =>   "$nc2", #navcol1
'nav_col2'         =>   "$nc4",  #navcol2
'nav_col3'         =>   "$nc3", #navcol1
'nav_col4'         =>   "$nc5", #navcol1
'nav_col5'         =>   "$nc0", #color under header

//end new


'cut_chars'           =>   250,           #Number of chars in the news
'hh'                  =>    150,           #Height of small images
'ww'                  =>    150,           #Width of small images
'hh_v'                =>    "",           #Height of small images
'ww_v'                =>    "",           #Width of small images
'vitrin_columns'      =>    3,            #Number of columns in vitrin
'max_vit_qty'         =>    6,            #Maximum qty jf goods presented on vitrin
'font_face'           =>    $main_fontface,    #Default font face
'font_size1'          =>    $main_font_size."pt",        #Main font size
'font_size2'          =>    "8pt",        #Description font size
'grey'                =>    "#FAfafa",     #grey color and style images dir
'extragrey'           =>    "#FAfafa",     #extragrey color and style images dir
'color1'              =>    "#F4FDF0",     #menu table border color and style images dir
'color2'              =>    "#FAfafa",     #menu table background color
'hr_color'            =>    "$nc4", #horizontal rule line color
'color3'              =>    "#fafafa",     #vertical line color

'error_color'         =>   "$nc5",     #error color

'bg_basket'           =>   "$nc2",  #basket bgcolor
'bg_nav'              =>   "$nc4", #navigation bgcolor

'bg_news'             =>   "$nc0",    #news bgcolor
'bg_anounses'         =>   "$nc0",    #anounses bgcolor

'bg_content'          =>   "$nc0", #content bgcolor
'bg_forum'            =>   "$nc0", #forum bgcolor
'bg_vit'              =>   "$nc0", #vitrina bgcolor

'bg_view'             =>   "$nc0", #goods view bgcolor
'bg_view1'            =>   "$nc0", #goods view bgcolor1
'bg_view2'            =>   "$nc0", #goods view bgcolor2

'bg_user'             =>   "$nc0",  #user window bgcolor
'bg_search'           =>   "$nc0", #search bgcolor
'bg_material'         =>   "$nc0", #links to pages bgcolor
'bg_links'            =>   "$nc0", #links bgcolor
'bg_usermenu'         =>   "$nc0", #usermenu bgcolor
'bg_error'            =>   "$nc0", #error window bgcolor
'bg_time'             =>   "$nc0", #working_time bgcolor
'bg_footer'           =>   "$nc0", #footer bgcolor


'popular'             =>    "$nc4", #Bsket style images dir
'sale'                =>    "$nc4", #Sale vitrina style images dir
'new'                 =>    "$nc4", #New style images diк - все цвета слева

'left_menu'           =>    "$nc1",  #Left_menu bground

'goods'               =>    "$nc2",  #Goods style images dir - все цвета справа
'minimal'             =>    "#d8d8d8",     #Minimal price style images dir
'basket'              =>    "#d9d9d9",     #Basket style images dir
'body_text'           =>    "$nc5",    #Default body text
'body_link'           =>    "$nc4", #Link color (DIR)
'body_hover'          =>    "$nc4",    #Hover link color (DIR)
'body_visited'        =>    "$nc4", #Visited link color (DIR)
'body_active'         =>   "$nc4", #Active link color (DIR)
'file_link'           =>   "$nc4", #Link color (FILE)
'file_hover'          =>    "#ff4444",    #Hover link color (FILE)
'file_visited'        =>   "$nc4", #Visited link color (FILE)
'file_active'         =>    "#ff4444",    #Active link color (FILE)
'body_background'     =>    "$nc0",    #Page background color
'table_color1'        =>    "$nc0",    #table row 1 color
'table_color2'        =>    $nc6,    #table row 2 color
'button_color1'       =>   "$nc4", #button background color
'button_text'         =>    "$nc0",    #button foreground color
'max_image_width'     =>    150,          #Max Image Width in pixels
'max_image_height'    =>    150,          #Max Image Height in pixels
'left_width'          =>    200,          #Left Column Width in pixels
'right_width'         =>    150,          #Right Column Width in pixels
'center_width'        =>    "100%",       #Center column Width in pixels
);

$style_cheat=1; //view ms effects

$css= "<link href=\"$htpath/uploadify/uploadify.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\">
<script type=\"text/javascript\" src=\"$htpath/js/overlib.js\"><!-- overLIB (c) Erik Bosrup --></script>
<script language=\"JavaScript\" type=\"text/javascript\" src=\"$htpath/js/".$scriptprefix."tips.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/js/lib.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/js/jquery-1.4.2.min.js\"></script>

<script type=\"text/javascript\" src=\"$htpath/js/jquery.js\"></script>

<script type=\"text/javascript\" src=\"$htpath/js/jquery.mousewheel.min.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"$htpath/fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />";
if (@$action=="blog") { $css.="<script type=\"text/javascript\" src=\"https://apis.google.com/js/plusone.js\"></script>"; }
$css.="<STYLE type=\"text/css\">
BODY {  COLOR: " . $style ['body_text'] . "; FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "; MARGIN: 5px 5px 10px }
BODY A:link {COLOR: " . $style ['body_link'] . "; TEXT-DECORATION: none}
BODY A:visited {COLOR: " . $style ['body_visited'] . "; TEXT-DECORATION: none}
BODY A:hover {COLOR: " . $style ['body_link'] . "; TEXT-DECORATION: underline}
BODY A:active {COLOR: " . $style ['body_active'] . "; TEXT-DECORATION: underline}
.file a:link {COLOR: " . $style ['file_link'] . "; TEXT-DECORATION: none}
.file a:visited {COLOR: " . $style ['file_visited'] . "; TEXT-DECORATION: none}
.file a:hover { COLOR: " . $style ['file_hover'] . "; TEXT-DECORATION: underline}
.file a:active {COLOR: " . $style ['file_active'] . "; TEXT-DECORATION: underline}
.lk {COLOR: #ffffff; TEXT-DECORATION: none}
.in {
float: left;
align: center;
margin: 10;
padding: 10;
}
.user {
float: left;
align: left;
margin: 5;
padding: 5;
}
.toright {
float: right;
align: center;
margin: 10;
padding: 10;
}
.out {
overflow: scroll;
align: center;
margin: 10;
padding: 10;
width: 100%;
}
small {FONT: " . $style ['font_size2'] . " " . $style ['font_face'] . "}
TD {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "}
TH {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "}
P {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "}
SELECT {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "}
FORM {DISPLAY: inline;}
LABEL {CURSOR: default;}
.normal {FONT-WEIGHT: normal;}
.load {background-image: url('images/ind.gif'); background-repeat: none; background-position: center}
a.menu { color: black; }
.ALERT  { font-size: 12; color: red; font-weight: bold; }
.ROW {  padding: 4px; color:black; font-weight:bold; background-color: $nc0; }
ol.results {margin:0 40px 0 40px; padding:0 0 0 40px}
ol.results li {margin-bottom:1em; padding:0;}
ol.results div.text {font-size:80%; padding-bottom:0.1em;}
ol.results div.info {font-size:80%; color:#333333; margin-top:0.3em;}
ol.results div.info a {color:$nc5;}
ol.results div.info a:visited {color:#800080;}
H1 {
padding : 5px 10px 5px 0px;
margin : 0px 0px 0px 0px;
font-size : 14px;
font-weight : bolder;
line-height: 1.1em;
margin: 0pt;
}
H2 {
line-height: 1.1em;
margin: 0pt;
}
.search_tips {
	text-align: left;
	width: 363px;
	height: 145px;
	margin-top: 20px;
	margin-left: 0px;
	position: absolute;
	z-index: 20;
	border: 1px solid $nc4;
	background-color: $nc0;
	overflow: hidden;
}
.search_tips .stCont {
	width: 458px;
	height: 150px;
	padding: 3px 3px 10px 3px;
	overflow: scroll;
}
.header TABLE.search .sField,
.header TABLE.search .sFieldActive {
	border: 1px solid $nc4;
	height: 22px;
	width: 465px;
	font-family: Verdana;
	font-size: 13px;
	color: $nc6;
	margin-bottom: 4px;
}

.round {
    -moz-border-radius: 5px;
    background: $nc6;
    color: $nc5;
    border: 1px solid ".lighter($nc6,-40).";
    margin-left: 0px;
    margin-right: 0px;
    margin-bottom: 5px;
    margin-top: 5px;
    width: 90%;
    padding : 10px 10px 10px 10px;
    align: center;
}
.round2 {
    -moz-border-radius: 5px;
    background: $nc0;
    border: 1px solid $nc6;
    margin-left: 0px;
    margin-right: 10px;
    margin-bottom: 4px;
    margin-top: 0px;
    padding : 3px 3px 3px 3px;
    align: center;
    overflow:hidden;
    padding: 10px;
}
.comm {
    -moz-border-radius: 5px;
    background: ".lighter($nc3,60).";
    border: 1px solid $nc3;
    margin-left: 0px;
    margin-right: 10px;
    margin-bottom: 4px;
    margin-top: 0px;
    padding : 3px 3px 3px 3px;
    align: center;
}
.price {
color:$nc5;
font: 20pt Georgia;
}
.newprice {
color:$nc5;
font: 20pt Georgia;
color:#b94a48;
}
.oldprice {
color:$nc5;
font: 20pt Georgia;
text-decoration: line-through;
}

.button {
-moz-border-radius: 5px;
    background: $nc2;
    border: 1px solid ".lighter($nc6,-50).";
    cursor: pointer;
    color: $nc5;
    padding : 2px 2px 2px 2px;
    background-image: url(grad.php?h=26&w=1&e=".str_replace("#", "", $nc6)."&s=".str_replace("#", "",$nc6)."&d=vertical);

}
input[type=\"button\"] {
-moz-border-radius: 5px;
    background: $nc2;
    border: 1px solid ".lighter($nc6,-50).";
    cursor: pointer;
    color: $nc5;
    padding : 2px 2px 2px 2px;
    background-image: url(grad.php?h=26&w=1&e=".str_replace("#", "", $nc6)."&s=".str_replace("#", "",$nc6)."&d=vertical);
}
input[type=\"submit\"] {
-moz-border-radius: 5px;
    background: $nc2;
    border: 1px solid ".lighter($nc6,-50).";
    cursor: pointer;
    color: $nc5;
    padding : 2px 2px 2px 2px;
    background-image: url(grad.php?h=26&w=1&e=".str_replace("#", "", $nc2)."&s=".str_replace("#", "",$nc2)."&d=vertical);
}
    #jCarouselLiteDemo .carousel a.prev, #jCarouselLiteDemo .carousel a.next {
        display: block;
        width: 48px;
        margin: 10px 10px 10px 10px;
        height: 143px;
        text-decoration: none;
        background: url(\"$image_path/prevc.png\") left 60px no-repeat;
    }
        #jCarouselLiteDemo .carousel a.next {
        margin: 10px 10px 10px 10px;
            background: url(\"$image_path/nextc.png\") right 60px no-repeat;
        }
            #jCarouselLiteDemo .carousel a.next:hover {

            }
            #jCarouselLiteDemo .carousel a.prev:hover {

            }
            #jCarouselLiteDemo .carousel a:hover, #jCarouselLiteDemo .carousel a:active {

            }






#jCarouselLiteDemo .carousel .jCarouselLite {
position: relative;
visibility: hidden;
left: -5000px;
height: ".$jh."px;
margin: 0;
padding: 0;
}


#jCarouselLiteDemo .carousel li{
width: 195px;
margin: 5px 5px 5px 5px;
padding: 0;
}
";
$css.= "
</STYLE>";

//blog table name in db
$blog_table_name="$dbpref"."_blog";
$blog_fields=Array(
"year" => "TEXT",
"month" => "TEXT",
"day" => "TEXT",
"enum" => "TEXT",
"date" => "TEXT",
"topic" => "TEXT",
"description" => "TEXT",
"tags" => "TEXT",
"icon" => "TEXT",
"allow_comments" => "TEXT",
"allow_anon_comments" => "TEXT",
"closed" => "TEXT",
"author" => "TEXT",
"reserved1" => "TEXT",
"reserved2" => "TEXT",
"reserved3" => "TEXT"
);
//users table name in db
$users_table_name="$dbpref"."_users";
$user_fields=Array(
"user_type" => "TEXT",
"login" => "TEXT",
"password" => "TEXT",
"username" => "TEXT",
"email" => "TEXT",
"tel" => "TEXT",
"date" => "TEXT",
"status" => "TEXT",
"metro" => "TEXT",
"street" => "TEXT",
"house" => "TEXT",
"building" => "TEXT",
"entrance" => "TEXT",
"doorcode" => "TEXT",
"office_num" => "TEXT",
"flat_num" => "TEXT",
"other_info" => "TEXT",
"city" => "TEXT",
"country" => "TEXT",
"telcode" => "TEXT",
);
$item_fields=Array(
"unifid" => "TEXT",
"item_id" => "TEXT",
"enum" => "TEXT",
"date" => "TEXT",
"votes_count" => "TEXT",
"votes_level" => "TEXT",
"comment" => "TEXT",
"counter" => "TEXT",
"ext_stock" => "TEXT",
"hidart" => "TEXT",
"id" => "TEXT",
"dir" => "TEXT",
"subdir" => "TEXT",
"item_name" => "TEXT",
"price" => "INT",
"ws_price" => "INT",
"code" => "TEXT",
"description" => "TEXT",
"keywords" => "TEXT",
"img_small" => "TEXT",
"img_big" => "TEXT",
"values" => "TEXT",
"on_offer" => "TEXT",
"brand" => "TEXT",
"attachments" => "TEXT",
"full_descr" => "TEXT",
"stock" => "INT",
);
$order_fields=Array(
"order_num" => "TEXT",
"order_link" => "TEXT",
"email" => "TEXT",
"username" => "TEXT",
"adress" => "TEXT",
"metro" => "TEXT",
"info" => "TEXT",
"total" => "TEXT",
"ws_total" => "TEXT",
"delivery_total" => "TEXT",
"status" => "TEXT",
"nickname" => "TEXT",
"col_12" => "TEXT",
"col_13" => "TEXT",
"col_14" => "TEXT",
"col_15" => "TEXT",
"col_16" => "TEXT",
);
$tags_fields=Array(
"count" => "TEXT",
"keyword" => "TEXT",
"link" => "TEXT",
);

function add_tmp_user($user, $regcode, $str, $fold) {
$ret="";
global $users_db_type;
global $lang;
if ($users_db_type=="files") {
if (is_dir("$fold"."./admin/tmp")==FALSE) { mkdir("$fold"."./admin/tmp",0755); }
$fpur=fopen("$fold./admin/tmp/$regcode.txt", "w");
fputs ($fpur,$str);
fclose ($fpur);
}
if ($users_db_type=="mysql") {
global $mysql_server;
global $mysql_db_name;
global $mysql_user;
global $mysql_pass;
global $users_table_name;
global $user_fields;
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Error-1 ".mysql_error());
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) die("Add tmp user. Error-2 ".mysql_error());
mysql_select_db($mysql_db_name);
if (mysql_errno()) die("Add tmp user. Error-3 ".mysql_error());
//$mysql_query="DROP TABLE IF EXISTS `tmp_".$users_table_name."`";
//mysql_query("$mysql_query");
$mysql_query="CREATE TABLE IF NOT EXISTS `tmp_".$users_table_name."` (`user` TEXT, `regcode` TEXT, `str` TEXT)";
mysql_query("$mysql_query");
if (mysql_errno()) die("Add tmp user. Error-4 ".mysql_error());
$mysql_query="SELECT * FROM `tmp_".$users_table_name."` WHERE (`user`='".mysql_real_escape_string($user)."')";
$result=mysql_query("$mysql_query");
if (mysql_errno()) die("Add tmp user. Error-5 ".mysql_error());
$rows=mysql_num_rows($result);
if ($rows>0) {
$mysql_query="DELETE FROM `tmp_".$users_table_name."` WHERE `user`='".mysql_real_escape_string($user)."'";
mysql_query("$mysql_query");
if (mysql_errno()) die("Add tmp user. Error-6 ".mysql_error());
}
$mysql_query="INSERT INTO `tmp_".$users_table_name."` SET `user`='".mysql_real_escape_string($user)."',`regcode`='".mysql_real_escape_string($regcode)."',`str`='".mysql_real_escape_string($str)."'";
mysql_query("$mysql_query");
if (mysql_errno()) die("Add tmp user. Error-7 ".mysql_error());

mysql_close($mysql_link);
}
}
function are_reg_exist ($regcode, $fold) {
global $users_db_type;
global $lang;
$ret=0;
if ($users_db_type=="files"){
if (($regcode!="")&&(@file_exists("$fold./admin/tmp/$regcode.txt"))) {$ret=1;}
}
if ($users_db_type=="mysql") {
//mysql funct are user reg exist
global $mysql_server;
global $mysql_db_name;
global $mysql_user;
global $mysql_pass;
global $users_table_name;
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Are reg exist. Error-1 ".mysql_error());
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) die("Are reg exist. Error-2 ".mysql_error());
mysql_select_db($mysql_db_name);
if (mysql_errno()) die("Are reg exist. Error-3 ".mysql_error());
//$mysql_query="DROP TABLE IF EXISTS `tmp_".$users_table_name."`";
//mysql_query("$mysql_query");
$mysql_query="CREATE TABLE IF NOT EXISTS `tmp_".$users_table_name."` (`user` TEXT, `regcode` TEXT, `str` TEXT)";
mysql_query("$mysql_query");
if (mysql_errno()) die("Are reg exist. Error-4 ".mysql_error());
$mysql_query="SELECT * FROM `tmp_".$users_table_name."` WHERE (`regcode`='".mysql_real_escape_string($regcode)."')";
$result=mysql_query("$mysql_query");
if (mysql_errno()) die("Are reg exist. Error-5 ".mysql_error());
$rows=mysql_num_rows($result);
if ($rows>0) {
$ret=1;
if (mysql_errno()) die("Are reg exist. Error-6 ".mysql_error());
}
mysql_close($mysql_link);
}
return $ret;
}







function save_user($strts, $where, $fold) {
$error="";
global $users_db_type;
global $reg_in_userfile;
global $users_db_type;
global $lang;
if ($where=="files"){
$file = fopen ($fold."./admin/userstat/".$reg_log.".txt", "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> ".$lang[44]." <b>".$fold."./admin/userstat/".$reg_log.".txt</b> ".$lang[45]."\n";
exit;
}
fputs ($file, "$strts");flock ($file, LOCK_UN);
fclose ($file);
}
if ($where=="mysql") {
//echo $strts;
//mysql funct are user reg exist
global $mysql_server;
global $mysql_db_name;
global $template;
global $speek;
global $details;
global $mysql_user;
global $mysql_pass;
global $user_fields;
global $users_table_name;

$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Save user. Error-1 ".mysql_error());
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) die("Save user. Error-2 ".mysql_error());
mysql_select_db($mysql_db_name);
if (mysql_errno()) die("Save user. Error-3 ".mysql_error());
//$mysql_query="DROP TABLE IF EXISTS `tmp_".$users_table_name."`";
//mysql_query("$mysql_query");

$out1=explode("|",$strts);

@$fio=@$out1[3];
@$email=@$out1[4];
@$tel=@$out1[5];
@$metro=@$out1[8];
@$street=@$out1[9];
@$house=@$out1[10];
@$korp=@$out1[11];
@$pod=@$out1[12];
@$domophone=@$out1[13];
@$ofice=@$out1[14];
@$flat=@$out1[15];
@$other=@$out1[16];
@$gorod=@$out1[17];
@$country=@$out1[18];
@$telcode=@$out1[19];

//"`password`='".mysql_real_escape_string($user_pass2)."',".
$q1="`username`='".mysql_real_escape_string($fio)."',".
"`email`='".mysql_real_escape_string($email)."',".
"`tel`='".mysql_real_escape_string($tel)."',".
//"`status`='".mysql_real_escape_string($user_status2)."',".
"`metro`='".mysql_real_escape_string($metro)."',".
"`street`='".mysql_real_escape_string($street)."',".
"`house`='".mysql_real_escape_string($house)."',".
"`building`='".mysql_real_escape_string($korp)."',".
"`entrance`='".mysql_real_escape_string($pod)."',".
"`doorcode`='".mysql_real_escape_string($domophone)."',".
"`office_num`='".mysql_real_escape_string($ofice)."',".
"`flat_num`='".mysql_real_escape_string($flat)."',".
"`other_info`='".mysql_real_escape_string($other)."',".
"`city`='".mysql_real_escape_string($gorod)."',".
"`country`='".mysql_real_escape_string($country)."',".
"`telcode`='".mysql_real_escape_string($telcode)."'";

$fuserm=20;
if (@file_exists($fold."./templates/$template/$speek/custom_user.inc")==TRUE) {

$user_arr=file ($fold."./templates/$template/$speek/custom_user.inc");
reset ($user_arr);

while (list ($user_num, $user_line) = each ($user_arr)) {

$user_line=trim(str_replace("\n", "", $user_line));

if ($user_line!="") {

$user_mass=explode("|", $user_line);
if ($out1[$fuserm]) {
//echo "$user_num, $user_line<br>";
if(get_magic_quotes_gpc()) {@$out1[$fuserm] = stripslashes(@$out1[$fuserm]);}
$q1.=",`". mysql_real_escape_string(translit($user_mass[0]))."_".($fuserm)."`='".@$out1[$fuserm]."'";
}
$fuserm+=1;
}
}
}


$mysql_query="UPDATE `".$users_table_name."` SET $q1 WHERE `login`='".mysql_real_escape_string(@$out1[1])."' AND `password`='".@$details[2]."' LIMIT 1";
//echo $mysql_query;
$result=mysql_query("$mysql_query");
if (mysql_errno()) {
$error= "$lang[42] MySQL-".mysql_errno()."";
}  else {
$error= "$lang[209]";
$change_nik="";
$user_nik=$user_log2;
}
mysql_close($mysql_link);
}
return $error;
}




function reg_new_user($regcod, $fold) {
$ret="";
global $cart;
global $users_db_type;
global $reg_in_userfile;
global $users_db_type;
global $lang;
$ret=0;
if ($users_db_type=="files"){
$user_tmp=file("./admin/tmp/$regcod.txt");
$user_tmp[0]=str_replace("\n","",$user_tmp[0]);
$userstr=explode("|",$user_tmp[0]);

if (($userstr[0]!="")&& ($userstr[1]!="")&& ($userstr[2]!="")&& ($userstr[3]!="")&& ($userstr[7]=="USER")&& ($userstr[4]!="")) {
$ver_n = $cart->ver_login(trim($userstr[1]));
if ($ver_n==FALSE) {
unlink ("./admin/tmp/$regcod.txt");
$cart->add_user(trim($user_tmp[0]), trim($userstr[1]), $reg_in_userfile);
$message=$lang['welc'].", ". $userstr[3]. "!";
$reglink="<div align=center><center><div class=round2><font size=2 color=$nc3><b>$message</b></font><br><br><form id=\"verify_ok\" action=\"$htpath/index.php\" method=\"POST\">
<input type=hidden name=logout value=1>
<table border=0><tr>
<td><b>".$lang['login'].":</b></td><td><input type=text size=15 name=login value=\"".$userstr[1]."\"></td>
</tr><tr>
<td><b>".$lang['pass'].":</b></td><td><input type=password size=15 name=password value=\"".$userstr[2]."\"></td>
</tr>
</table>
<br><input type=submit value=\"".$lang[940]."\" style=\"width: 300px;\"></form><br><br><font color=$nc3>".$lang[263]."</font></div></center></div><br>";
$ret="$reglink";
} else {
$ret= "<a id=\"errors\" href=\"#errormes\"></a><script type=\"text/javascript\">
        $(document).ready(function() {
        $(\"#errors\").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic'
			});
           $(\"#errors\").fancybox().trigger('click');
        });
    </script><div id=errormes><div class=round2><font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b><br><br>".$lang[264]."<br><br></div></div>";
}
} else {
$ret= "<a id=\"errors\" href=\"#errormes\"></a><script type=\"text/javascript\">
        $(document).ready(function() {
        $(\"#errors\").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic'
			});
           $(\"#errors\").fancybox().trigger('click');
        });
    </script><div id=errormes><div class=round2><font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b><br><br></div></div>";
}
}
if ($users_db_type=="mysql") {
//mysql funct are user reg exist
global $mysql_server;
global $mysql_db_name;
global $template;
global $speek;
global $mysql_user;
global $mysql_pass;
global $user_fields;
global $users_table_name;
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) die( "Reg new user. Error-1 ".mysql_error());
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) die("Reg new user. Error-2 ".mysql_error());
mysql_select_db($mysql_db_name);
if (mysql_errno()) die("Reg new user. Error-3 ".mysql_error());
//$mysql_query="DROP TABLE IF EXISTS `tmp_".$users_table_name."`";
//mysql_query("$mysql_query");
$mysql_query="CREATE TABLE IF NOT EXISTS `tmp_".$users_table_name."` (`user` TEXT, `regcode` TEXT, `str` TEXT)";

mysql_query("$mysql_query");
if (mysql_errno()) die("Reg new user. Error-4 ".mysql_error());
$mysql_query="SELECT * FROM `tmp_".$users_table_name."` WHERE (`regcode`='".mysql_real_escape_string($regcod)."')";
$result=mysql_query("$mysql_query");
$strk=Array();
$strks="";
while($row = mysql_fetch_array($result))
  {
  $strks=$row['str'];
  }
  $strk=explode("|",$strks);
  if ($strks=="") {
  $ret= "<a id=\"errors\" href=\"#errormes\"></a><script type=\"text/javascript\">
        $(document).ready(function() {
        $(\"#errors\").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic'
			});
           $(\"#errors\").fancybox().trigger('click');
        });
    </script><div id=errormes><div class=round2><font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b><br><br>".$lang[264]."<br><br></div></div>";
  } else {
if (mysql_errno()) die("Reg new user. Error-5 ".mysql_error());
$rows=mysql_num_rows($result);
if ($rows>0) {
$mysql_query2="INSERT INTO `".$users_table_name."` SET ";
if (mysql_errno()) die("Reg new user. Error-6 ".mysql_error());
$mysql_query="CREATE TABLE IF NOT EXISTS `".$users_table_name."` (";
reset ($user_fields);
$zap="";
$d=0;

while (list($key,$val)=each($user_fields)) {
$mysql_query.=$zap."`".mysql_real_escape_string($key)."` $val";
$mysql_query2.=$zap."`". mysql_real_escape_string($key)."`"."='".mysql_real_escape_string(@$strk[$d])."'";
$zap=", ";
$d+=1;
}
unset ($key,$val);
$customfile=$fold."./templates/$template/$speek/custom_user.inc";
if (!file_exists($customfile)) die ( "ERROR $customfile not exists...");
$custom_fields_arr=file($customfile);
$s=20;
$field=Array();
$types=Array();
$zap =", ";
while (list($key,$val)=each($custom_fields_arr)){
if (trim($val)!="") {
$tmpm=explode("|",$val);
if ((trim($tmpm[0])!="")&&(trim($tmpm[5])!="")) {
$type="TEXT";
$mysql_query.=$zap. "`". mysql_real_escape_string(translit($tmpm[0]))."_"."$s"."`"." $type";
$mysql_query2.=$zap."`". mysql_real_escape_string(translit($tmpm[0]))."_"."$s"."`"."='".mysql_real_escape_string(@$strk[$s])."'";
$zap=", ";
$indx=translit($tmpm[0])."_".$s;
$user_fields[$indx]=$type;
$s+=1;
$d+=1;
}
}
}
unset ($key, $val, $tmpm, $indx, $custom_fields_arr);
$mysql_query.=")";
//echo $mysql_query;
mysql_query("$mysql_query");
if (mysql_errno()) die("Reg new user. Error-7 ".mysql_error());
$mysql_query3="SELECT * FROM `".$users_table_name."` WHERE (`login`='".mysql_real_escape_string(@$strk[1])."')";
$result=mysql_query("$mysql_query3");
if (mysql_errno()) die("Reg new user. Error-8 ".mysql_error());
$rows3=mysql_num_rows($result);
if ($rows3>0) {
$ret= "<div class=round2><a id=\"errors\" href=\"#errormes\"></a><script type=\"text/javascript\">
        $(document).ready(function() {
        $(\"#errors\").fancybox({
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic'
			});
           $(\"#errors\").fancybox().trigger('click');
        });
    </script><div id=errormes><font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b><br><br>".$lang[264]."<br><br><div></div>";
} else {

//echo " ".$mysql_query2;
mysql_query("$mysql_query2");
if (mysql_errno()) die("Reg new user. Error-9 ".mysql_error());
$mysql_query="DELETE FROM `tmp_".$users_table_name."` WHERE `regcode`='".mysql_real_escape_string($regcod)."'";
mysql_query("$mysql_query");
if (mysql_errno()) die("Reg new user. Error-10 ".mysql_error());
$reglink="<br><div align=center><center><div class=round2><font size=2 color=$nc3><b>$message</b></font><br><br><form id=\"verify_ok\" action=\"$htpath/index.php\" method=\"POST\">
<input type=hidden name=logout value=1>
<table border=0><tr>
<td><b>".$lang['login'].":</b></td><td><input type=text size=15 name=login value=\"".$strk[1]."\"></td>
</tr><tr>
<td><b>".$lang['pass'].":</b></td><td><input type=password size=15 name=password value=\"".$strk[2]."\"></td>
</tr>
</table>
<br><input type=submit value=\"".$lang[940]."\" style=\"width: 300px;\"></form><br><br><font color=$nc3>".$lang[263]."</font></div></center></div><br>";
$ret="$reglink";
}
}
}
mysql_close($mysql_link);
}
return $ret;
}

function get_databases()
{
   $ret = array();
   $r = mysql_query("SHOW DATABASES");
   if (mysql_num_rows($r)>0)
    while($row = mysql_fetch_array($r, MYSQL_NUM))
        $ret[] = $row[0];
   return $ret;
}
function get_database_tables()
{
   $ret = array();
   $r = mysql_query("SHOW TABLES");
   if (mysql_num_rows($r)>0)
    while($row = mysql_fetch_array($r, MYSQL_NUM))
        $ret[] = $row[0];
   return $ret;
}

//check if table exists or no
function table_exists($mysql_table) {
global $mysql_server;
global $mysql_db_name;
global $template;
global $speek;
global $mysql_user;
global $mysql_pass;

$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) { mysql_close($mysql_link); return false;}
$r=get_database_tables();
while (list($key,$val)=each($r)) {
if ("`$val`"==$mysql_table) {  mysql_close($mysql_link); return false; }
}
mysql_close($mysql_link); return false;
}
?>
