<?php
$big_photos_inlist=1; //Show big photos in items list
$map_functions=0; //Use map.php functions
$minify_big=0;
$full_wiki_repl=0; //Advanced slow wiki replace function
$basket_img="<i class=icon-shopping-cart></i><br><small>$lang[1548]</small>"; //input option style
$css_style=1; //0-old or 1-new
$more_css_style=1; //0 or 1-more css effects
$radiooi="<div class=customdiv>"; //input option style
if ($affix==1) { $shop_width="100%"; $leftmenu=1; $links_to_bottom=0;  }
//radio options style
if ($radiooptions==0) {
$radioos="<div>";
$radiodiv="<div>";
$radioo="</div><br><br><span class=clear></span>";
$radiooe="";

} else {
$radioos="<div>";
$radiodiv="<div style=\"float: left; margin-right:10px;\">";
$radioo="</div>";
$radiooe="<br><br><br><br><span class=clear></span>";
}

function request_url()
{
$result = '';
$default_port = 80;
if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
$result .= 'https://';
$default_port = 443;
} else {
$result .= 'http://';
}
$result .= $_SERVER['SERVER_NAME'];
if ($_SERVER['SERVER_PORT'] != $default_port) {
$result .= ':'.$_SERVER['SERVER_PORT'];
}
$result .= $_SERVER['REQUEST_URI'];
return $result;
}

//format: name|rss_url|pattern|encoding charset from|encoding charset to|
$rssurl= Array(
0=>"Internet news|http://news.yandex.ru/internet.rss|#<item>.*?<title>(.*?)<\/title>.*?<link>(.*?)<\/link>.*?<description>(.*?)<\/description>.*?<pubDate>(.*?)<\/pubDate>.*?<\/item>#si|utf-8|windows-1251|",
1=>"Хабрановости|http://habrahabr.ru/rss|#<item>.*?<title>(.*?)<\/title>.*?<link>(.*?)<\/link>.*?<description>(.*?)<\/description>.*?<pubDate>(.*?)<\/pubDate>.*?<\/item>#si|utf-8|windows-1251|",
);

//$jg=(($gallery_maxwidth*$gallery_cols)+90)."px"; //width of jquery gallery
$jg="100%"; //width of jquery gallery
$metat="";
if (!isset($_SESSION["partner_id"])) {$_SESSION["partner_id"]="";}
if (!isset($pid)) { $pid=""; }
if (!preg_match("/^[a-zA-Z0-9\._]+$/i",$pid)) { $pid="";}
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
'catid_desc'=>1, #default - 1 or enter 0 to disable Category HTML description (located like x****.txt in admin/content folder)
'dirs_l'=>$view_dirs_l, #default - 0 view catalogues images
'dirs_h'=>$view_dirs_h, #default - 0 view catalogues as horizontal
'dirs_v'=>$view_dirs_v, #default - 0 view catalogues as vertical
'dirs_j'=>$view_dirs_j, #default - 0 view catalogues as exploded list
'view_s'=>0, #default - 0 view statii
'cat_h'=>40,
'cat_w'=>40,
'spec_h'=>40,
'spec_w'=>40,
'cat_vsp'=>1,
'cat_hsp'=>1,

'shop_width'=>"$shop_width", #Shop width default is 95%
'cellpadding' =>0, #Cellpadding in the block cells
'tbgcolor'=>"$nc0", #maintable bgcolor

'bordercolor' =>"#FAfafa", #image border color

//new

'nav_col1' =>"$nc2", #navcol1
'nav_col2' =>"$nc4",#navcol2
'nav_col3' =>"$nc3", #navcol1
'nav_col4' =>"$nc5", #navcol1
'nav_col5' =>"$nc0", #color under header

//end new


'cut_chars'=>250,#Number of chars in the news
'hh'=>$small_foto_height,#Height of small images
'ww'=>$small_foto_width,#Width of small images
'hh_v'=>$micro_foto_height,#Height of small images
'ww_v'=>$micro_foto_width,#Width of small images
'vitrin_columns'=>3,#Number of columns in vitrin
'max_vit_qty' =>6,#Maximum qty jf goods presented on vitrin
'font_face'=>$main_fontface,#Default font face
'font_size1'=>$main_font_size."pt",#Main font size
'font_size2'=>"8pt",#Description font size
'grey'=>"#FAfafa", #grey color and style images dir
'extragrey'=>"#FAfafa", #extragrey color and style images dir
'color1'=>"#F4FDF0", #menu table border color and style images dir
'color2'=>"#FAfafa", #menu table background color
'hr_color'=>"$nc4", #horizontal rule line color
'color3'=>"#fafafa", #vertical line color

'error_color' =>"$nc5", #error color

'bg_basket'=>"$nc1",#basket bgcolor
'bg_nav'=>"$nc4", #navigation bgcolor

'bg_news' =>"$nc0",#news bgcolor
'bg_anounses' =>"$nc0",#anounses bgcolor

'bg_content'=>"$nc0", #content bgcolor
'bg_forum'=>"$nc0", #forum bgcolor
'bg_vit'=>"$nc0", #vitrina bgcolor

'bg_view' =>"$nc0", #goods view bgcolor
'bg_view1'=>"$nc0", #goods view bgcolor1
'bg_view2'=>"$nc0", #goods view bgcolor2

'bg_user' =>"$nc0",#user window bgcolor
'bg_search'=>"$nc0", #search bgcolor
'bg_material' =>"$nc0", #links to pages bgcolor
'bg_links'=>"$nc0", #links bgcolor
'bg_usermenu' =>"$nc0", #usermenu bgcolor
'bg_error'=>"$nc0", #error window bgcolor
'bg_time' =>"$nc0", #working_time bgcolor
'bg_footer'=>"$nc0", #footer bgcolor


'popular' =>"$nc4", #Bsket style images dir
'sale'=>"$nc4", #Sale vitrina style images dir
'new' =>"$nc4", #New style images diк - все цвета слева

'left_menu'=>"$nc1",#Left_menu bground

'goods'=>"$nc3",#Goods style images dir - все цвета справа
'minimal' =>"#d8d8d8", #Minimal price style images dir
'basket'=>"#d9d9d9", #Basket style images dir
'body_text'=>"$nc5",#Default body text
'body_link'=>"$nc4", #Link color (DIR)
'body_hover'=>"$nc4",#Hover link color (DIR)
'body_visited'=>"$nc4", #Visited link color (DIR)
'body_active' =>"$nc4", #Active link color (DIR)
'file_link'=>"$nc4", #Link color (FILE)
'file_hover'=>"#ff4444",#Hover link color (FILE)
'file_visited'=>"$nc4", #Visited link color (FILE)
'file_active' =>"#ff4444",#Active link color (FILE)
'body_background' =>"$nc0",#Page background color
'table_color1'=>"$nc0",#table row 1 color
'table_color2'=>$nc6,#table row 2 color
'button_color1'=>"$nc4", #button background color
'button_text' =>"$nc0",#button foreground color
'max_image_width' =>$small_foto_width,#Max Image Width in pixels
'max_image_height'=>$small_foto_height,#Max Image Height in pixels
'left_width'=>"21%",#Left Column Width in px or %
'right_width' =>220,#Right Column Width in pixels
'center_width'=>"100%",#Center column Width in pixels
);

$style_cheat=1; //view ms effects

$css= "<link href=\"$htpath/uploadify/uploadify.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />
<script type=\"text/javascript\" src=\"$htpath/js/overlib.js\"><!-- overLIB (c) Erik Bosrup --></script>
<script language=\"JavaScript\" type=\"text/javascript\" src=\"$htpath/js/".$scriptprefix."tips.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/js/lib.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/js/jquery-1.8.2.min.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/js/bootstrap.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/js/jquery.js\"></script>";
if ($affix==1) {
$css.="
<script type=\"text/javascript\" src=\"$htpath/js/stickyMojo.js\"></script>
<link href=\"css/jquery.mCustomScrollbar.css\" rel=\"stylesheet\" type=\"text/css\" />
<script src=\"js/jquery.mCustomScrollbar.min.js\"></script>
";
}
$css.="
<script type=\"text/javascript\" src=\"$htpath/js/jquery.mousewheel.min.js\"></script>
<script type=\"text/javascript\" src=\"$htpath/fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"$htpath/fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
<link href=\"$htpath/css/bootstrap".$bootstrap_theme.".css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />
<link href=\"$htpath/css/prettify.css\" rel=\"stylesheet\">";
if (@$action=="blog") { $css.="<script type=\"text/javascript\" src=\"https://apis.google.com/js/plusone.js\"></script>"; }

if ($flush_css==0){
$css.= "<STYLE type=\"text/css\">";
}

$cssflush="";
if ($css_style==1) {
$cssflush.="
body{
position: relative;
font: " . $style ['font_size1'] . "/140% " . $style ['font_face'] . ",Arial, Helvetica, Geneva, sans-serif;
color: $nc5;
font-weight: lighter;
margin: 0;
padding: 0;
background: $nc0;
text-align:left;
}

input[type=search] {
	-webkit-appearance: textfield;
	-webkit-box-sizing: content-box;
	font-family: inherit;
	font-size: 80%;
    background: #000000;
    background-color: #000000;
    height: 20px;
    background: #000000 url(images/sf.png) no-repeat 9px center;
    border: solid 1px #333333;
    padding: 4px 4px 4px 32px;
    width: 55px;

    -webkit-border-radius: 10em;
    -moz-border-radius: 10em;
    border-radius: 10em;

    -webkit-transition: all .5s;
    -moz-transition: all .5s;
    transition: all .5s;
    margin-bottom:0px;
}
input::-webkit-search-decoration,
input::-webkit-search-cancel-button {
	display: none;
}
input[type=search]:focus {
	width: 130px;
	background-color: #fff;
	border-color: $nc10;

	-webkit-box-shadow: 0 0 5px rgba(109,207,246,.5);
	-moz-box-shadow: 0 0 5px rgba(109,207,246,.5);
	box-shadow: 0 0 5px rgba(109,207,246,.5);
}
";
if ($affix==1) {
$cssflush.="
#main {
        width:78%;
        height:auto; /*can be anything, just should make sure it is taller than the sidebar*/
        float: right;
}
#sidebar {
        width: ".$style['left_width'].";
        min-height: 500px;
        max-height: 500px;
        overflow: auto;
        margin: 0px 0px 0px 0px; /*controls the cutoff of the top and bottom limitations*/
        float: left; /* float right for a right aligned sidebar */

}
#sidebar_inner {
        width: 80%;
}
#footer {
        width: 1020;
        clear:both;
        margin-top: 100px;
}
#wrapper {
        width: 1020; /* MUST HAVE WIDTH SET, should be the sidebar width + main width */
        margin-left: auto;
        margin-right: auto;
}

";

}
$cssflush.="
.b1{
cursor: pointer; cursor: hand; font-weight: bold; white-space:nowrap;
}
.b2{
display:none; visibility:hidden; white-space:nowrap;
}
.obox{
margin: 10px 10px 0 0;
border-radius: 12px;
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to($nc6), color-stop(3%, $nc0), color-stop(12%, $nc0), color-stop(90%, $nc0));
background-image: -webkit-linear-gradient(top, $nc0, $nc0 3%, $nc0 12%, $nc0 90%, $nc6);
background-image: -moz-linear-gradient(top, $nc0, $nc0 3%, $nc0 12%, $nc0 90%, $nc6);
background-image: -o-linear-gradient(top, $nc0, $nc0 3%, $nc0 12%, $nc0 90%, $nc6);
background-image: -ms-linear-gradient(top, $nc0, $nc0 3%, $nc0 12%, $nc0 90%, $nc6);
background-image: linear-gradient(to bottom, $nc0, $nc0 3%, $nc0 12%, $nc0 90%, $nc6);
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
margin-bottom: 10px;
}
.box{
margin: 10px 10px 0 0;
margin-bottom: 10px;
}
.obox2{
margin: 10px 10px 0 0;
border-radius: 12px;
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to($nc6), color-stop(3%, $nc0), color-stop(12%, $nc6), color-stop(90%, $nc0));
background-image: -webkit-linear-gradient(top, $nc0, $nc0 3%, $nc6 12%, $nc0 90%, $nc6);
background-image: -moz-linear-gradient(top, $nc0, $nc0 3%, $nc6 12%, $nc0 90%, $nc6);
background-image: -o-linear-gradient(top, $nc0, $nc0 3%, $nc6 12%, $nc0 90%, $nc6);
background-image: -ms-linear-gradient(top, $nc0, $nc0 3%, $nc6 12%, $nc0 90%, $nc6);
background-image: linear-gradient(to bottom, $nc0, $nc0 3%, $nc6 12%, $nc0 90%, $nc6);
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
margin-bottom: 10px;

}
.titlediv{
margin-top:20px;
margin-left:10px;
margin-bottom:0px;
width:96%;
font-size:".($main_font_size+6)."pt;
line-height: 1em;
}
::-webkit-scrollbar {
width: 3px;
height: 3px ;
}
::-webkit-scrollbar-track {
background: $nc0;
-webkit-box-shadow: inset 1px 1px 2px $nc0;
border: 0px solid #000000;
border-radius: 0px;
}
::-webkit-scrollbar-thumb {
background: $nc6;
-webkit-box-shadow: inset 1px 1px 2px rgba(50, 50, 50, 0.3);
border-radius: 0px;
}
::-webkit-scrollbar-thumb:hover {
background: $nc6;
}
::-webkit-scrollbar-thumb:active {
background: $nc0;
-webkit-box-shadow: inset 1px 1px 2px rgba(50, 50, 50, 0.3);
}
::-webkit-scrollbar-button {
  background-color: $nc6;
  background-repeat:no-repeat;
  width:3px;
  height:3px
}

.box3{
";
if ($affix==1) {
$cssflush.="
}
.affixbox {
background-color:$nc1;
background:$nc1;
margin-bottom: 0px;
margin-top: 0px;
margin-right: 0px;
padding:5px 5px 5px 5px;
width:100%;
overflow: scroll;
overflow-x: hidden;
}";
} else {
$cssflush.="
border-top-right-radius: 6px;
border-top-left-radius: 6px;
border-bottom-right-radius: 6px;
border-bottom-left-radius: 6px;
background-color:$nc1;
background:$nc1;
margin-bottom: 0px;
margin-top: 10px;
padding:5px 5px 5px 5px;
}";
}


$cssflush.=".box4{
";
if ($affix==1) {
$cssflush.="
padding:5px 5px 5px 5px;
";
}else {
$cssflush.="
border-top-right-radius: 6px;
border-top-left-radius: 6px;
border-bottom-right-radius: 6px;
border-bottom-left-radius: 6px;
background-color:$nc6;
background:$nc6;
padding:5px 5px 5px 5px;
";
}
$cssflush.="

margin-bottom: 0px;
margin-top: 10px;


}

.box5{
border-top-right-radius: 6px;
border-top-left-radius: 6px;
border-bottom-right-radius: 6px;
border-bottom-left-radius: 6px;
background-color:$nc0;
background:$nc0;
margin-bottom: 0px;
margin-top: 10px;

padding:5px 5px 5px 5px;

}


.box2{
border-top-right-radius: 5px;
border-top-left-radius: 5px;
border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;
margin: 10px 10px 0 0;
background-color:".lighter($nc6,10).";
background:".lighter($nc6,10).";
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to(".lighter($nc6,10)."));
background-image: -webkit-linear-gradient(top, $nc0, ".lighter($nc6,10).");
background-image: -moz-linear-gradient(top, $nc0, ".lighter($nc6,10).");
background-image: -o-linear-gradient(top, $nc0, ".lighter($nc6,10).");
background-image: -ms-linear-gradient(top, $nc0, ".lighter($nc6,10).");
background-image: linear-gradient(to bottom, $nc0, ".lighter($nc6,10).");
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
margin-bottom: 10px;

}

.fts{
width:".(ceil($micro_foto_width/2)+20)."px;
padding:5px 5px 5px 5px;
height: ".(ceil($small_foto_height)-5)."px;
overflow:hidden;
float:left;
margin: 5px 10px 10px 0px;

cursor:pointer;
cursor:hand;
}
.fts .smf{
width:".ceil($micro_foto_width/2)."px;
height:".ceil($micro_foto_height/2)."px;
margin-bottom:4px;
-webkit-box-shadow: 0 0px 3px ".$nc6.";
-moz-box-shadow:0 0px 3px ".$nc6.";
box-shadow:0 0px 3px ".$nc6.";
}
.fts .smf:hover{
width:".ceil($micro_foto_width/2)."px;
height:".ceil($micro_foto_height/2)."px;
margin-bottom:4px;
 -webkit-box-shadow: 0 0px 5px ".$nc10.";
-moz-box-shadow:0 0px 5px ".$nc10.";
box-shadow:0 0px 5px ".$nc10.";
}
.img:hover{
 -webkit-box-shadow: 0 0px 5px ".$nc10.";
-moz-box-shadow:0 0px 5px ".$nc10.";
box-shadow:0 0px 5px ".$nc10.";
}
.itemdiv:hover{
-webkit-box-shadow: 0 0px 16px ".$nc10.";
-moz-box-shadow:0 0px 16px ".$nc10.";
box-shadow:0 0px 16px ".$nc10.";
}

//bootstrap table fix
.table2 {
  width: 100%;
  margin-bottom: 0px;
}

.table2 th,
.table2 td {
  padding: 8px;
  line-height: 20px;
  text-align: left;
  vertical-align: top;
  border-top: none;
}
.onav{
color: $nc5;
border-top-right-radius: 5px;
border-top-left-radius: 5px;
border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;
clear: both;
height: 20px;
padding: 10px 20px 10px 20px;
}
.onav2{
color: $nc5;
border-top-right-radius: 5px;
border-top-left-radius: 5px;
border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;
clear: both;
height: 20px;
padding: 12px 20px 10px 20px;
}

.onav ul li{
float: left;
padding: 0 10px;
margin: 0 10px 0 0;
color: #fff;
font-weight: bold;
height: 25px;
line-height: 25px;
font-size: 13px;
cursor: pointer;

-webkit-box-shadow: 0 -1px 1px ".lighter($nc6,-50).";
-moz-box-shadow:0 -1px 1px ".lighter($nc6,-50).";
box-shadow:0 1px -1px ".lighter($nc6,-50).";
text-shadow: #000000 0 -1px 1px;
}
nav ul li:hover{
background-color: #ccc;
box-shadow: 0 -1px 1px #fff;
-webkit-box-shadow: 0 -1px 1px #fff;
-moz-box-shadow: 0 -1px 1px #fff;
color: ".lighter($nc6,-50).";
text-shadow: #fff 0 1px 1px;
}
.navig {
background: $nc10;
border: 1px solid ".lighter($nc6,-30).";
color: $nc5;
padding : 0px 0px 0px 0px;
background-image: url(grad.php?h=46&w=1&e=[lnc10]&s=[nc10]&d=vertical);
-webkit-box-shadow: 0 0px 5px ".lighter($nc6,-20).";
-moz-box-shadow:0 0px 5px ".lighter($nc6,-20).";
box-shadow: 0 0px 5px ".lighter($nc6,-20).";

}
.shadow {
padding: 0px 0px 0px 0px;
margin: 0px 0px 0px 0px;
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.19), inset 0 0 5px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.19), inset 0 0 5px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.19), inset 0 0 5px $nc0;
}
.itemdiv {
font-face: Arial;
margin: 0px 0px 0px 0px;
padding: 10px 10px 10px 10px;
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.19), inset 0 0 5px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.19), inset 0 0 5px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.19), inset 0 0 5px $nc0;
}


.content{
padding: 0px 10px 0px 10px;
}
.pcont a:link {COLOR: $nc3; TEXT-DECORATION: none; border-bottom: 1px dotted $nc2;}
.pcont a:visited {COLOR:$nc3; TEXT-DECORATION: none; border-bottom: 1px dotted $nc2;}
.pcont a:hover {COLOR: $nc4; TEXT-DECORATION:  none; border-bottom: 1px dotted $nc4; }
.pcont a:active {COLOR: $nc5; TEXT-DECORATION:  none; border-bottom: 1px dotted $nc3;}
.pcont img{border: 0;}

.comnts{
font-weight: lighter;
font-style: oblique;
margin-bottom:10px;
margin-top:10px;
}
.tagdiv{
font-weight: lighter;
font-style: oblique;
font-face: Arial;
margin-bottom:10px;
margin-top:10px;
}
.clear{
clear: both;
}

.navi2 {
-webkit-box-shadow: -2px 3px 5px rgba(255,255,255,0.31), inset 4px -3px 7px rgba(0,0,0,0.11);
-moz-box-shadow: -2px 3px 5px rgba(255,255,255,0.31), inset 4px -3px 7px rgba(0,0,0,0.11);
box-shadow: -2px 3px 5px rgba(255,255,255,0.31), inset 4px -3px 7px rgba(0,0,0,0.11);
}

.navi4 {
padding: 3px 3px 3px 3px;
border-bottom-right-radius: 0px;
border-bottom-left-radius: 0px;
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;

}
.onavi4 {
align: center;
padding: 6px 12px 6px 12px;
margin-right: -2px;
border-top-right-radius: 5px;
border-top-left-radius: 5px;
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;

}
.onavi4d {
padding: 3px 3px 3px 3px;

}
.onavi4d:hover {
padding: 3px 3px 3px 3px;
background: rgba(255,255,255,0.22);
}
.onavi4:hover {
align: center;
height: ".$bheight."px;
padding: 6px 12px 6px 12px;
margin-right: -2px;
border-top-right-radius: 5px;
border-top-left-radius: 5px;
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.55), inset 0 1px 0 $nc0;
background: rgba(255,255,255,0.22);
}
";
$css_width="95%";
} else {
$css_width=$style['shop_width'];
$cssflush.="BODY {color: $nc5; FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "; MARGIN: 5px 5px 10px }
";
}
$cssflush.="
.loading{
background: #ffffff;
padding: 10px;
color: #555555;
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
margin: 10px 0px 10px 0px;
}
.footer {background-color: $nc5; color: $nc0; padding:20px; }
.footer a:link {COLOR: $nc0; TEXT-DECORATION: none}
.footer a:visited {COLOR:$nc0; TEXT-DECORATION: none}
.footer a:hover {COLOR: $nc0; TEXT-DECORATION: underline}
.footer a:active {COLOR: $nc0; TEXT-DECORATION: underline}
.bottom_links { background-color: ".$nc1."; background-image: url(grad.php?h=20&w=1&e=".str_replace("#", "", $nc1)."&s=".str_replace("#", "", lighter($nc1,-5))."&d=crystal); background-repeat:repeat-x; color: $nc0; }
.hvr a:link {COLOR: $nc9; TEXT-DECORATION: none}
.hvr a:visited {COLOR:$nc9; TEXT-DECORATION: none}
.hvr a:hover {COLOR: $nc2; TEXT-DECORATION: underline; background-color: ".$nc5.";}
.hvr a:active {COLOR: $nc2; TEXT-DECORATION: underline}

.nohvr a:link {COLOR: $nc0; TEXT-DECORATION: none}
.nohvr a:visited {COLOR:$nc0; TEXT-DECORATION: none}
.nohvr a:hover {COLOR: $nc0; TEXT-DECORATION:  none}
.nohvr a:active {COLOR: $nc0; TEXT-DECORATION:  none}

.basketfont a:link {COLOR: $nc3; TEXT-DECORATION: none}
.basketfont a:visited {COLOR:$nc3; TEXT-DECORATION: none}
.basketfont a:hover {COLOR: $nc3; TEXT-DECORATION:  none; border-bottom: 2px dotted $nc3;}
.basketfont a:active {COLOR: $nc3; TEXT-DECORATION:  none}

.regfont a:link {COLOR: $nc5; TEXT-DECORATION: none}
.regfont a:visited {COLOR:$nc5; TEXT-DECORATION: none}
.regfont a:hover {COLOR: $nc2; TEXT-DECORATION:  none}
.regfont a:active {COLOR: $nc5; TEXT-DECORATION:  none}

.onav2 a:link {COLOR: $nc0; TEXT-DECORATION: none}
.onav2 a:visited {COLOR:$nc0; TEXT-DECORATION: none}
.onav2 a:hover {COLOR: $nc2; TEXT-DECORATION: underline}
.onav2 a:active {COLOR: $nc2; TEXT-DECORATION: underline}
.panel {
background-color:".lighter($nc6,10).";
background:".lighter($nc6,10).";
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to($nc6));
background-image: -webkit-linear-gradient(top, $nc0, $nc6);
background-image: -moz-linear-gradient(top, $nc0, $nc6);
background-image: -o-linear-gradient(top, $nc0, $nc6);
background-image: -ms-linear-gradient(top, $nc0, $nc6);
background-image: linear-gradient(to bottom, $nc0, $nc6);
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;


}
.navbar .divider-vertical {
  height: 40px;
  margin: 0 9px;
  border-right: 1px solid ".lighter($nc0,10).";
  border-left: 1px solid ".lighter($nc6,-10).";
}
.navbar .divider-vertical2 {
  height: 40px;
  margin: 0 9px;
  border-right: 1px solid ".lighter($nc5,10).";
  border-left: 1px solid ".lighter($nc5,-10).";
}



.nav-tabs {
  border-bottom: 1px solid $nc6;
  margin-bottom: 0px;
}
.lnk a:link {COLOR: $nc3; TEXT-DECORATION: none; border-bottom: 1px dotted $nc2;}
.lnk a:visited {COLOR:$nc3; TEXT-DECORATION: none; border-bottom: 1px dotted $nc2;}
.lnk a:hover {COLOR: $nc4; TEXT-DECORATION:  none; border-bottom: 1px dotted $nc4;}
.lnk a:active {COLOR: $nc5; TEXT-DECORATION:  none; border-bottom: 1px dotted $nc5;}


.nav-tabs > li > a:hover,
.nav-tabs > li > a:focus {
  border-color: $nc6 $nc6 $nc6;
  margin-bottom: 0px;
}

.nav-tabs > .active > a,
.nav-tabs > .active > a:hover,
.nav-tabs > .active > a:focus {
  color: $nc0;
  cursor: default;
  background-color: $nc3;
  border: 1px solid $nc3;
  border-bottom-color: transparent;
  margin-bottom: 0px;
}

.tab-content {
  padding:20px;
  margin-top: 0px;
  -webkit-border-radius: 2px;
-moz-border-radius: 2px;
border-radius: 2px;
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to($nc6));
background-image: -webkit-linear-gradient(top, $nc0, $nc6);
background-image: -moz-linear-gradient(top, $nc0, $nc6);
background-image: -o-linear-gradient(top, $nc0, $nc6);
background-image: -ms-linear-gradient(top, $nc0, $nc6);
background-image: linear-gradient(to bottom, $nc0, $nc6);
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
}

.mr {
margin-right: 10px;
}
.ml {
margin-left: 10px;
}
.mu {
margin-top: 20px;
}
.mb {
margin-bottom: 10px;
}
.pr {
padding-right: 5%;
padding-left: 2%;
}

.hr {
background-color: ".lighter($nc1,-10).";
border-bottom: 1px solid ".lighter($nc1,10).";
height: 2px;
margin: 10px 0;
width: 100%;
}
.hr2 {
background-color: ".lighter($nc1,-10).";
border-bottom: 1px solid ".lighter($nc1,10).";
height: 2px;
margin: 10px 0;
width: 100%;
}
.carousel .item {-webkit-transition: opacity 3s; -moz-transition: opacity 3s; -ms-transition: opacity 3s; -o-transition: opacity 3s; transition: opacity 3s;}
.carousel .active.left {left:0;opacity:0;z-index:2;}
.carousel .next {left:0;opacity:1;z-index:1;}
* {
margin: 0px 0px 0px 0px;

}


body:not(#Foo) label
  {padding:2px 5px 10px 30px;}

body:not(#Foo) input[type=radio]
  {display:none;}

body:not(#Foo) input[type=radio] + label
  {background:url('".$image_path."/radio0.png') no-repeat 0px 0px;}

body:not(#Foo) input[type=radio]:checked + label
  {background:url(".$image_path."/radio1.png) no-repeat 0px 0px;}

.toright{
float: right;
}

.nowrap{
white-space: nowrap;
}

.hidden {
display: none;
visibility: hidden;
}
.navi a{
text-decoration: none;
padding: 5px 1px 5px 1px;
}

.customdiv {
padding: 5px 0px 5px 0px;
border-bottom: solid 1px $nc6;

}

.navi a:hover{
background: ".lighter($nc6,5).";
text-decoration: none;
padding: 5px 1px 5px 1px;
-webkit-box-shadow: 0 0px 10px ".lighter($nc6,-40).";
-moz-box-shadow:0 0px 10px ".lighter($nc6,-40).";
box-shadow: 0 0px 10px ".lighter($nc6,-40).";
}
.onavi a{
text-decoration: none;
padding: 5px 1px 5px 1px;
}
.onavi a:hover{
background: ".lighter($nc6,5).";
text-decoration: none;
padding: 5px 1px 5px 1px;
-webkit-box-shadow: 0 0px 10px ".lighter($nc6,-40).";
-moz-box-shadow:0 0px 10px ".lighter($nc6,-40).";
box-shadow: 0 0px 10px ".lighter($nc6,-40).";
}

.tip{
padding: 5px 5px 5px 5px;
}

.round3{
padding: 10px 10px 10px 10px;
margin: 0px 0px 0px 0px;
}
.round4{
width: 97%;
margin: 10px 10px 10px 0px;
background: ".lighter($nc0,-10)." 135px 2px ;
padding: 5px 10px;
top: 9px;
border: none;


}
.sticky {
background: ".lighter($nc0,-10)." 135px 2px ;
background-image: url(grad.php?h=400&w=1&e=".str_replace("#", "", $nc0)."&s=".str_replace("#", "", $nc0)."&d=vertical);
}
.img{
margin: 10px 10px 10px 10px;
-webkit-box-shadow: 0 0px 3px ".lighter($nc6,-20).";
-moz-box-shadow:0 0px 3px ".lighter($nc6,-20).";
box-shadow:0 0px 3px ".lighter($nc6,-20).";
}

BODY A:link {COLOR: " . $style ['body_link'] . "; TEXT-DECORATION: none}
BODY A:visited {COLOR: " . $style ['body_visited'] . "; TEXT-DECORATION: none}
BODY A:hover {COLOR: " . $style ['body_link'] . "; TEXT-DECORATION: none; }
BODY A:active {COLOR: " . $style ['body_active'] . "; TEXT-DECORATION: none}

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
}
.out {
overflow: scroll;
align: center;
margin: 10;
padding: 10;
width: 100%;
}

TD {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "; align: left; }
TH {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "; align: left; }
P {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "; align: left; }
SELECT {FONT: " . $style ['font_size1'] . " " . $style ['font_face'] . "}
FORM {DISPLAY: inline;}
LABEL {CURSOR: default;}
.normal {FONT-WEIGHT: normal;}
.load {background-image: url('images/ind.gif'); background-repeat: none; background-position: center}
a.menu { color: black; }
H1 {
margin : 0px 0px 0px 0px;
font-size : ".($main_font_size+6)."pt;
line-height: 1em;
}
H2 {
line-height: 1.1em;
margin: 0pt;
}
.search_tips {
text-align: left;
padding: 3px 3px 10px 3px;
height: 150px;
margin-top: 11px;
margin-left: 2px;
margin-right: 40px;
position: absolute;
z-index: 15;
background-color: $nc0;
overflow: hidden;
-webkit-box-shadow: 0 0 4px rgba(0,0,0,0.5);
-moz-box-shadow: 0 0 4px rgba(0,0,0,0.5);
box-shadow: 0 0 4px rgba(0,0,0,0.5);
}
.search_tips .stCont {
width: auto;
height: 100%;
padding: 3px 3px 10px 3px;
overflow: auto;
}


.ocat1 {
margin: 10px 0px 10px 0px; padding: 10px;
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to($nc6));
background-image: -webkit-linear-gradient(top, $nc0, $nc6);
background-image: -moz-linear-gradient(top, $nc0, $nc6);
background-image: -o-linear-gradient(top, $nc0, $nc6);
background-image: -ms-linear-gradient(top, $nc0, $nc6);
background-image: linear-gradient(to bottom, $nc0, $nc6);
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;

}
.cat1 {
font-size: ".($main_font_size+2)."pt;
border-bottom: $nc6 1px dotted;

}

.ccat1 {
font-size: ".($main_font_size+2)."pt;
padding: 5px 5px 5px 5px;
margin: 10px 0px 0px 0px;
border-bottom: $nc6 1px dotted;

}

.lcat1{
color: $nc9;
font-size: ".($main_font_size+1)."pt;
padding: 5px 5px 5px 5px;
cursor: pointer;
cursor:hand;
}
.lcat1 a:link{
color: $nc9;
}
.lcat1 a:visited{
color: $nc9;
}

.lcat1:hover{
font-size: ".($main_font_size+1)."pt;
color: $nc0;
padding: 5px 5px 5px 5px;
background: $nc3;
}
.lcat1:hover a{
font-size: ".($main_font_size+1)."pt;
color: $nc0;
}

.searchitem{
padding: 5px 5px 5px 5px;
cursor: pointer;
cursor:hand;
}
.searchitem a:link{
color: $nc3;
}
.searchitem a:visited{
color: $nc3;
}
.searchitem:hover{
padding: 5px 5px 5px 5px;
background: $nc6;
}
.searchitem:hover a{
color: $nc3;
}
.searchitem:hover a:hover{
color: $nc4;
}

.brand{
font-size: ".($main_font_size+1)."pt;
padding: 5px 5px 5px 5px;
cursor: pointer;
cursor:hand;
}
.brand a:link{
color: $nc2;
}
.brand a:visited{
color: $nc2;
}
.brand:hover{
font-size: ".($main_font_size+1)."pt;
color: $nc2;
padding: 5px 5px 5px 5px;
background: $nc3;
}
.brand:hover a{
font-size: ".($main_font_size+1)."pt;
color: $nc2;
background: ".$nc3.";
border-bottom: 1px $nc2 dotted;
}

.cat1:hover {
font-size: ".($main_font_size+2)."pt;
color: $nc0;
background: #[nc10];
border-bottom: $nc6 1px solid;

}
.cat1:hover a{
font-size: ".($main_font_size+2)."pt;
color: $nc0;
background: #[nc10];
border-bottom: $nc6 1px solid;

}
.cat1 a:hover {
font-size: ".($main_font_size+2)."pt;
color: $nc0;
background: #[nc10];
border-bottom: $nc6 1px solid;

}
.cat1 a:active {
font-size: ".($main_font_size+2)."pt;
color: $nc0;
background: #[nc10];
border-bottom: $nc6 1px solid;

}

.submenuitem {
padding: 5px 5px 5px 5px;
margin: 10px 0px 0px 0px;
border-bottom: $nc6 1px dotted;
cursor:pointer;
cursor:hand;
}
.submenuitem:hover {
background: $nc6;
padding: 5px 5px 5px 5px;
margin: 10px 0px 0px 0px;
border-bottom: $nc6 1px solid;
cursor:pointer;
cursor:hand;

}

.underlined {
padding: 5px 5px 5px 5px;
margin: 10px 0px 0px 0px;
border-bottom: $nc2 1px solid;

}

.cat3 {
border: 2px solid $nc6;
padding: 5px 5px 5px 5px;
margin: 5px 5px 5px 5px;
margin: 10px 0px 0px 0px;
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to(".lighter($nc6,-10)."), color-stop(3%, $nc0), color-stop(12%, ".lighter($nc6,-10)."), color-stop(90%, $nc0));
background-image: -webkit-linear-gradient(top, $nc0, $nc0 3%, ".lighter($nc6,-10)." 12%, $nc0 90%, ".lighter($nc6,-10).");
background-image: -moz-linear-gradient(top, $nc0, $nc0 3%, ".lighter($nc6,-10)." 12%, $nc0 90%, ".lighter($nc6,-10).");
background-image: -o-linear-gradient(top, $nc0, $nc0 3%, ".lighter($nc6,-10)." 12%, $nc0 90%, ".lighter($nc6,-10).");
background-image: -ms-linear-gradient(top, $nc0, $nc0 3%, ".lighter($nc6,-10)." 12%, $nc0 90%, ".lighter($nc6,-10).");
background-image: linear-gradient(to bottom, $nc0, $nc0 3%, ".lighter($nc6,-10)." 12%, $nc0 90%, ".lighter($nc6,-10).");
-webkit-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
-moz-box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;
box-shadow: 0 1px 5px rgba(0,0,0,0.29), inset 0 0 7px $nc0;

}

.cat2 {
padding: 5px 5px 5px 5px;
margin: 0px 0px 0px 0px;

}
.categories {
background-image: -webkit-gradient(linear, center top, center bottom, from($nc0), to(".lighter($nc1,20)."), color-stop(0%, $nc0), color-stop(0%, $nc0), color-stop(100%, ".lighter($nc1,20)."));
background-image: -webkit-linear-gradient(top, $nc0, $nc0 0%, $nc0 0%, ".lighter($nc1,20)." 100%, ".lighter($nc1,20).");
background-image: -moz-linear-gradient(top, $nc0, $nc0 0%, $nc0 0%, ".lighter($nc1,20)." 100%, ".lighter($nc1,20).");
background-image: -o-linear-gradient(top, $nc0, $nc0 0%, $nc0 0%, ".lighter($nc1,20)." 100%, ".lighter($nc1,20).");
background-image: -ms-linear-gradient(top, $nc0, $nc0 0%, $nc0 0%, ".lighter($nc1,20)." 100%, ".lighter($nc1,20).");
background-image: linear-gradient(to bottom, $nc0, $nc0 0%, $nc0 0%, ".lighter($nc1,20)." 100%, ".lighter($nc1,20).");

padding: 1px 5px 1px 5px;
margin: 5px 1px 1px 1px;
}
.oround {

padding: 5px 5px 5px 5px;
margin: 5px 5px 5px 5px;
background: ".lighter($nc6,5).";
-webkit-box-shadow: 0 0px 5px ".lighter($nc6,-40).";
-moz-box-shadow:0 0px 5px ".lighter($nc6,-40).";
box-shadow: 0 0px 5px ".lighter($nc6,-40).";
}
.round {
padding: 5px 5px 5px 5px;
margin: 5px 5px 5px 5px;
}
.round2 {
margin: 10px 10px 10px 10px;
padding: 10px 10px;
width: auto;
background: $nc0;
border: none;
}
.oround2 {
margin: 10px 10px 10px 10px;
padding: 10px 10px;
width: auto;
background: $nc0;
border: none;
-webkit-box-shadow: 0 0px 15px ".lighter($nc6,-20).";
-moz-box-shadow:0 0px 15px ".lighter($nc6,-20).";
box-shadow: 0 0px 15px ".lighter($nc6,-20).";
}
.comm {
margin: 0px 5px;
padding: 5px 5px;
width: auto;
background: ".lighter($nc0,-10).";
box-shadow: 0 -1px 1px ".lighter($nc6,0).";
-moz-box-shadow: 0 -1px 1px ".lighter($nc6,0).";
-webkit-box-shadow: 0 -1px 1px ".lighter($nc6,0).";
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

hr {
  -moz-border-bottom-colors: none;
  -moz-border-image: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  border-color: $nc6 -moz-use-text-color $nc6;
  border-style: solid none;
  border-width: 2px 0;
  margin: 6px 0;
}
#jCarouselLiteDemo .carousel a.prev, #jCarouselLiteDemo .carousel a.next {
display: block;
width: 20px;
margin: 10px 10px 10px 10px;
height: 143px;
text-decoration: none;
cursor: pointer;
cursor: hand;
background: url(\"$image_path/prevc.png\") left 70px no-repeat;
}
#jCarouselLiteDemo .carousel a.next {
background: url(\"$image_path/nextc.png\") left 70px no-repeat;
}
#jCarouselLiteDemo .carousel a.next:hover {
background: url(\"$image_path/nextc.png\") left 72px no-repeat;
}
#jCarouselLiteDemo .carousel a.prev:hover {
background: url(\"$image_path/prevc.png\") left 72px no-repeat;
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
.regbut {
height: 50 px;
background: #005403;
background-image: url(grad.php?h=55&w=1&e=005403&s=2de810&d=crystal);
padding: 13px 26px;
-webkit-border-radius: 6px;
-moz-border-radius: 6px;
border-radius: 6px;
-webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
-moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
box-shadow: rgba(0,0,0,1) 0 1px 0;
text-shadow: rgba(0,0,0,.4) 0 1px 0;
font-size: 19px;
text-decoration: none;
vertical-align: middle;
color: #ffffff;
cursor: pointer;
cursor: hand;
}
.regbut:hover {
border-top-color: #18a10b;
background-image: url(grad.php?h=75&w=1&e=005403&s=2de810&d=crystal);
background: #18a10b;
color: #ffffff;
}
.regbut:active {
background-image: url(grad.php?h=75&w=1&e=005403&s=2de810&d=crystal);
border-top-color: #265c1b;
background: #265c1b;
}

.carousel-caption {
  position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 15px;
  background: $nc10;
  background: rgba(".hexdec(substr($nc10,1,2)).", ".hexdec(substr($nc10,3,2)).", ".hexdec(substr($nc10,5,2)).", 0.55);
}
 .dow {
 font-weight: bold;
    border-top: 1px solid $nc10 !important;
    color:$nc10;
}


#fb_xdm_frame_http, #fb_xdm_frame_https { display:none; border:none; }

.btn-file { position: relative; overflow: hidden; margin-right: 4px; }
.btn-file input { position: absolute; top: 0; right: 0; margin: 0; opacity: 0; filter: alpha(opacity=0);
transform: translate(-300px, 0) scale(4); font-size: 23px; direction: ltr; cursor: pointer; }
/* Fix for IE 7: */
* + html .btn-file { padding: 2px 15px; margin: 1px 0 0 0; }
ul.scroll-menu {
    position: relative;
    width: 100%;
    max-height:".($max_subs*25)."px;
    margin: 0;
    border-left: none;
    border-right: none;
    border-top: none;
    border-bottom: none;
    display: block !important;
    overflow-y: auto;
    overflow-x: auto;
    top: 0 !important;
    left: 0 !important;
    -webkit-overflow-scrolling: touch;
    -moz-overflow-scrolling: touch;
    -ms-overflow-scrolling: touch;
    -o-overflow-scrolling: touch;
    overflow-scrolling: touch;
    -webkit-border-radius: 0 !important;
    -moz-border-radius: 0 !important;
    -ms-border-radius: 0 !important;
    -o-border-radius: 0 !important;
    border-radius: 0 !important;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    -ms-box-shadow: none;
    -o-box-shadow: none;
    box-shadow: none;
}
ul.scroll-menu-2x {
    max-height: 230px;
}

::-webkit-scrollbar
{
  width: 12px;  /* for vertical scrollbars */
  height: 12px; /* for horizontal scrollbars */
}

::-webkit-scrollbar-track
{
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb
{
  background: rgba(0, 0, 0, 0.5);
}
";

if ($flush_css==1){
$css.="<link href=\"$htpath/style.css\" rel=\"stylesheet\" type=\"text/css\" media=\"screen\" />";
} else {
$css.= "$cssflush
</STYLE>";
}










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
global $reg_log;
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
global $user_log2;

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
}else {
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
global $nc3;
global $htpath;
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
$message=$lang['welc']."!";
$reglink="<div align=center><center><div><font size=2 color=$nc3><b>$message</b></font><br><br><form id=\"verify_ok\" action=\"$htpath/index.php\" method=\"POST\">
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
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b><br><br>".$lang[264]));
$erview.="',{
'transitionIn': 'none',
'transitionOut': 'none',
'scrolling'	no',
'padding' : 50,
tleShow'false,
'overlayShow'false
});

});
</script>";
$ret= "$erview";
}
} else {
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b>"));
$erview.="',{
'transitionIn': 'none',
'transitionOut': 'none',
'scrolling'	no',
'padding' : 50,
tleShow'false,
'overlayShow'false
});

});
</script>";
$ret= "$erview";
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
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b><br><br>".$lang[264]));
$erview.="',{
'transitionIn': 'none',
'transitionOut': 'none',
'scrolling'	no',
'padding' : 50,
tleShow'false,
'overlayShow'false
});

});
</script>";
$ret="$erview" ;
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
$erview="<script type=\"text/javascript\">
$(window).load(function()
{
$.fancybox('";



$erview.=str_replace("\"","", str_replace("'","","<font size=4 color=#b94a48>".$lang[261]."</font><br><br><b>".$lang[42]."!</b><br><br>".$lang[264]));
$erview.="',{
'transitionIn': 'none',
'transitionOut': 'none',
'scrolling'	no',
'padding' : 50,
tleShow'false,
'overlayShow'false
});

});
</script>";
$ret= "$erview";
} else {

//echo " ".$mysql_query2;
mysql_query("$mysql_query2");
if (mysql_errno()) die("Reg new user. Error-9 ".mysql_error());
$mysql_query="DELETE FROM `tmp_".$users_table_name."` WHERE `regcode`='".mysql_real_escape_string($regcod)."'";
mysql_query("$mysql_query");
if (mysql_errno()) die("Reg new user. Error-10 ".mysql_error());
$message=$lang['welc']."!";
$reglink="<br><div align=center><center><div><font size=2 color=$nc3><b>$message</b></font><br><br><form id=\"verify_ok\" action=\"$htpath/index.php\" method=\"POST\">
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
if ("`$val`"==$mysql_table) {mysql_close($mysql_link); return false; }
}
mysql_close($mysql_link); return false;
}
?>
