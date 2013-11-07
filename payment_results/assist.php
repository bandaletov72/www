<?php
$style = array (
'shop_width'          =>   "95%",         #Shop width default is 95%
'cellpadding'         =>   0,             #Cellpadding in the block cells
'tbgcolor'            =>   "#8d7799",     #maintable bgcolor

'bordercolor'         =>   "#343666",     #image borer color
'catid_desc'          =>   1,             #default - 1 or enter 0 to disable Category HTML description (located like x****.txt in admin/content folder)

'cut_chars'           =>   250,           #Number of chars in the news
'hh'                  =>    63,           #Height of small images
'ww'                  =>    63,           #Width of small images
'vitrin_columns'      =>    5,            #Number of columns in vitrin
'max_vit_qty'         =>    5,            #Maximum qty jf goods presented on vitrin
'font_face'           =>    "verdana",    #Default font face
'font_size1'          =>    "9pt",        #Main font size
'font_size2'          =>    "8pt",        #Description font size
'grey'                =>    "#6b4e7c",    #grey color and style images dir
'extragrey'           =>    "#343666",    #extragrey color and style images dir
'color1'              =>    "#3a75c4",    #menu table border color and style images dir
'color2'              =>    "#D2E4F6",    #menu table background color
'hr_color'            =>    "#b396b8",    #horizontal rule line color
'color3'              =>    "#b4b4b4",    #vertical line color

'error_color'         =>   "#b94a48",     #error color

'bg_nav'              =>   "#55466e",     #navigation bgcolor

'bg_news'             =>   "#c5adc9",     #news bgcolor
'bg_anounses'         =>   "#c5adc9",     #anounses bgcolor

'bg_content'          =>   "#E3DAE8",     #content bgcolor
'bg_forum'            =>   "#d4d4d4",     #forum bgcolor
'bg_vit'              =>   "#dcd3ed",     #vitrina bgcolor

'bg_view'             =>   "#E3DAE8",     #goods view bgcolor
'bg_view1'            =>   "#dcd3ed",     #goods view bgcolor1
'bg_view2'            =>   "#E3DAE8",     #goods view bgcolor2

'bg_user'             =>   "#E3DAE8",     #user window bgcolor
'bg_search'           =>   "#E3DAE8",     #search bgcolor
'bg_material'         =>   "#E3DAE8",     #links to pages bgcolor
'bg_links'            =>   "#E3DAE8",     #links bgcolor
'bg_usermenu'         =>   "#E3DAE8",     #usermenu bgcolor
'bg_error'            =>   "#ffd4d4",     #error window bgcolor
'bg_time'             =>   "#E3DAE8",     #working_time bgcolor
'bg_footer'           =>   "#E3DAE8",     #footer bgcolor


'popular'             =>    "#343666",    #Popular style images dir
'sale'                =>    "#6b4e7c",    #Sale vitrina style images dir
'new'                 =>    "#343666",    #New style images dir

'left_menu'           =>    "#dcd3ed",    #Left_menu bground

'goods'               =>    "#6b4e7c",    #Goods style images dir
'minimal'             =>    "#c33c3c",    #Minimal price style images dir
'basket'              =>    "#3a75c4",    #Basket style images dir
'body_text'           =>    "#000000",    #Default body text
'body_link'           =>    "#000000",    #Link color (DIR)
'body_hover'          =>    "#FF4400",    #Hover link color (DIR)
'body_visited'        =>    "#0B0B0B",    #Visited link color (DIR)
'body_active'         =>    "#ff4400",    #Active link color (DIR)
'file_link'           =>    "#000000",    #Link color (FILE)
'file_hover'          =>    "#ff4400",    #Hover link color (FILE)
'file_visited'        =>    "#800080",    #Visited link color (FILE)
'file_active'         =>    "#ff4400",    #Active link color (FILE)
'body_background'     =>    "#8c62a6",    #Page background color
'table_color1'        =>    "#FFFFFF",    #table row 1 color
'table_color2'        =>    "#F8F8F8",    #table row 2 color
'button_color1'       =>    "#8f9a73",    #button background color
'button_text'         =>    "#dddddd",    #button foreground color
'max_image_width'     =>    150,          #Max Image Width in pixels
'max_image_height'    =>    150,          #Max Image Height in pixels
'left_width'          =>    160,          #Left Column Width in pixels
'right_width'         =>    170,          #Right Column Width in pixels
'center_width'        =>    "100%",       #Center column Width in pixels
);

$css ="\n\nh1{font-weight:400;font-size:18px;margin-top:0 px;margin-bottom:0px;}
h2{font-size:14px;font-weight:400;margin-bottom:0px}


BODY {
        COLOR: #000000; FONT: 9pt verdana; MARGIN: 5px 5px 10px
}
BODY A:link {
        COLOR: #000000; TEXT-DECORATION: none
}
BODY A:visited {
        COLOR: #0B0B0B; TEXT-DECORATION: none
}
BODY A:hover {
        COLOR: #000000; TEXT-DECORATION: underline
}
BODY A:active {
        COLOR: #ff4400; TEXT-DECORATION: underline
}

.file A:link {
        COLOR: #000000; TEXT-DECORATION: none
}
.file A:visited {
        COLOR: #800080; TEXT-DECORATION: none
}
.file A:hover {
        COLOR: #ff4400; TEXT-DECORATION: underline
}
.file A:active {
        COLOR: #ff4400; TEXT-DECORATION: underline
}

small {
        FONT: 8pt verdana
}
TD {
        FONT: 9pt verdana
}
TH {
        FONT: 9pt verdana
}
P {
        FONT: 9pt verdana
}
LI {
        FONT: 9pt verdana
}

SELECT {
        FONT: 9pt verdana
}

FORM {
        DISPLAY: inline;
}
LABEL {
        CURSOR: default;
}
.normal {
        FONT-WEIGHT: normal;
}
a.menu { color: black; }
SELECT, option, textarea, input {   FONT-FAMILY:verdana,arial;color:#000000; background-color:#eeeeee  }
a:link,a:visited,a:active {text-decoration:none; color:#990000; font-weight:plain;}
a:hover {text-decoration:none; color:#660000; font-weight: plain;}
.bottom { vertical-align: bottom }
.top { vertical-align: top }
.poster { FONT-SIZE: 2pt }

.ALERT  { font-size: 12; color: red; font-weight:400; }
.ROW {  padding: 4px; color:black; font-weight:400; background-color: #e0e0e0; }

/*ol.results {margin:0 40px 1.7em 40px; padding:0 0 0 40px}*/
ol.results {margin:0 40px 0 40px; padding:0 0 0 40px}

ol.results li {margin-bottom:1em; padding:0;}
ol.results div.text {font-size:80%; padding-bottom:0.1em;}
ol.results div.info {font-size:80%; color:#333333; margin-top:0.3em;}
ol.results div.info a {color:#000000;}
ol.results div.info a:visited {color:#800080;}
";
$hedy="<META NAME=\"Last-Modified\" CONTENT=\"$llast\">
<style>
h1{font-weight:400;font-size:18px;margin-top:0 px;margin-bottom:0px;}
h2{font-size:14px;font-weight:400;margin-bottom:0px}
$css
</style>";
$conten="<font face=verdana><div align=left><br>";
$conten2="<font face=verdana><div align=center><small>";
$error="";
if(isset($_GET['plat'])) $plat=$_GET['plat']; elseif(isset($_POST['plat'])) $plat=$_POST['plat']; else $plat=0;
if (!preg_match("/^[0-9]+$/",$plat)) { $plat=0;}
if(isset($_GET['ok'])) $ok=$_GET['ok']; elseif(isset($_POST['ok'])) $ok=$_POST['ok']; else $ok=0;
if (!preg_match("/^[0-9]+$/",$ok)) { $ok=0;}

if ($ok==1) {echo"<div align=center><h4>Оплата договора</h4><font color=#468847>Транзакция прошла успешно</font><br><br><b>Просьба не оплачивать повторно!</b><br><br>Благодарим за своевременную оплату наших услуг</div>"; exit;}
if ($ok==2) {echo"<div align=center><h4>Оплата договора</h4><font color=#b94a48>Транзакция закончилась неудачей</font><br><br>Свяжитесь с нашим оператором для прояснения этой ситуации</div>"; exit;}

if(isset($_GET['sum'])) { $sum=$_GET['sum'];} elseif (isset($_POST['sum'])) { $sum=$_POST['sum'];} else { $sum=0; $error.="Вы не указали сумму к оплате<br>";}
if (!preg_match("/^[0-9\.,]+$/i",$sum)) { $sum=0; $error.="В сумме к оплате указывайте только цифры и точку<br>";}
$sum=str_replace(",",".", $sum);
if(isset($_GET['order'])) { $order=$_GET['order']; } elseif(isset($_POST['order'])) { $order=$_POST['order']; } else { $order="";  $error.="Не указан номер договора<br>";}
if (!preg_match("/^[a-zA-Zа-яА-Я0-9_]+$/i",$order)) { $order=""; $error.="В номере договора - указывайте только русские или английские буквы и цифры<br>";}
$order=preg_replace("([\D]+)", "", preg_replace("/\(.*\)/U", "", str_replace("-","",  $order)));
if ($order=="") { $error.="Номер договора неправильный<br>";}
if ($plat==0) { $error="";} else {$error=$error."<br>";}
$form1="<div align=center><h4>Оплата договора</h4><font color=#b94a48>$error</font><FORM ACTION=\"assist.php\" METHOD=\"POST\">
<INPUT TYPE=\"HIDDEN\" NAME=\"plat\" VALUE=1>
<!-- Фамилия Имя Отчество: <INPUT TYPE=\"text\" size=10 NAME=\"name\" VALUE=\"\"><br>
Ваш E-mail: <INPUT TYPE=\"text\" size=10 NAME=\"email\" VALUE=\"\"><br -->
<table border=0 cellpadding=10>
<tr>
<td>Введите номер договора<font color=#b94a48>*</font>:</td>
<td><INPUT TYPE=\"text\" size=10 NAME=\"order\" VALUE=\"\"></td>
</tr>
<tr>
<td>Перечисляемая сумма в рублях<font color=#b94a48>*</font>:</td>
<td><INPUT TYPE=\"text\" NAME=\"sum\" size=10 VALUE=\"\"></td>
</tr>
<tr>
<td colspan=2 align=center>
<br><INPUT TYPE=\"SUBMIT\" NAME=\"Submit\" VALUE=\"Далее &gt;&gt;\">
</FORM></td>
</tr></table>
</div>";
$exist=0;
$dog="<font color=#3a87ad>Договор с таким номером не найден, возможно он еще не введен в базу данных.<br>Заведение занимает 1-2 дня. Вы хотите оплатить все равно?</font><br><br>";
if (($plat==0)||($sum==0)||($order=="")) {$conten.= $form1;
} else {$bdfile="./file.txt";
$fcont=@file($bdfile);
if (isset($fcont[0])) {
while (list ($line_num, $line)=@each ($fcont)) {
unset ($temp);
$line=trim(str_replace("\n", "", str_replace("\r", "", $line)));
$temp=explode("|", $line);
$text="";
if ($temp[0]!="") {
$nums=preg_replace("([\D]+)", "", preg_replace("/\(.*\)/U", "", str_replace("-","",  $temp[0])));
if ($nums==$order) { $exist=1; $order=$temp[0]; $dog="<font color=#468847>Найден договор <b>".$temp[0]."</b>, заключен <b>".$temp[3]."</b>, на сумму <b>".$temp[36]. "</b> руб.</font><br><br>"; break;}
}
}
}
$form2="<div align=center><h4>Подтверждение</h4>$dog"."Проверьте правильнось введенных данных, после чего можете нажимать кнопку ОПЛАТИТЬ.<br><br>
<FORM ACTION=\"https://test.assist.ru/shops/purchase.cfm\" METHOD=\"POST\"><b>Ваши данные:</b><br><table border=0 cellpadding=10>
<tr>
<td>Договор:</td>
<td><b>$order</b></td>
</tr>
<tr>
<td>Сумма к оплате:</td>
<td><b><INPUT TYPE=\"text\" size=10 NAME=\"Subtotal_P\" VALUE=\"$sum\"></b> руб.</td>
</tr>
<tr>
<td align=right>
<INPUT TYPE=\"HIDDEN\" NAME=\"Shop_IDP\" VALUE=\"356255\">
<INPUT TYPE=\"HIDDEN\" NAME=\"Order_IDP\" VALUE=\"$order\">
<INPUT TYPE=\"HIDDEN\" NAME=\"Currency\" VALUE=\"RUR\">
<INPUT TYPE=\"HIDDEN\" NAME=\"Comment\" VALUE=\"check\">
<INPUT TYPE=\"HIDDEN\" NAME=\"WebMoneyPayment\" VALUE=\"1\">
<INPUT TYPE=\"HIDDEN\" NAME=\"PayCashPayment\" VALUE=\"1\">
<INPUT TYPE=\"HIDDEN\" NAME=\"EPortPayment\" VALUE=\"1\">
<INPUT TYPE=\"HIDDEN\" NAME=\"DemoResult\" VALUE=\"AS000\">
<INPUT TYPE=\"button\" onclick=\"history.go(-1)\" VALUE=\"&lt;&lt; Назад\">
</td><td align=left><INPUT TYPE=\"SUBMIT\" NAME=\"Submit\" VALUE=\"Оплатить\">
</FORM></td></tr></table>
</div>";
$conten.= $form2;
}
$conten.= "<br><div align=center><img src=\"visa.gif\"> <img src=\"mc.gif\"><br><img src=\"assist.gif\"></div>";
if (@file_exists("./creator/content/s0007.txt")==TRUE){
$fpcs = fopen ("./creator/content/s0007.txt" , "r");
$cats= fread ($fpcs, filesize ("./creator/content/s0007.txt"));
fclose($fpcs);
}
$mainf="q0015";

if (@file_exists("./creator/content/".$mainf.".txt")==TRUE){
$fpc = fopen ("./creator/content/".$mainf.".txt" , "r");
$cat= fread ($fpc, filesize ("./creator/content/".$mainf.".txt"));

if (preg_match("/==(.*)==/i", $cat, $outc)) {
$cattitle=$outc[1];
$catcont = str_replace ("==$cattitle==", "" , $cat);
} else {
$cattitle = "";
$catcont = $cat;
}
fclose ($fpc);
}
$conten.="$form";
$conten=str_replace("[content]", "", str_replace("[content]", $conten2."</small></font></div>", str_replace("[content1]", "", str_replace("[content1]", $conten."<!-- $zadan -->",  str_replace("</title>"," - Статус заказа</title>", str_replace("</head>","$hedy </head>",  str_replace("[menu]", $cats, $catcont)))))));
$conten= str_replace("[jssales]", "<b id=\"jsphpsales\"><br><img src=$image_path/ind.gif border=0><br>0-3</b>
<script>
scriptNode = document.createElement('script');
scriptNode.src = 'http://www.dpz.ru/shop/sales.php?sta=0&catid=sales&unifid=1';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
</script>
<input type=hidden id=\"jsmaxsales\" name=\"js_maxsales\" value=\"0\" />
<input type=hidden id=\"jscatidsales\" name=\"js_catidsales\" value=\"sales\" />
<script language=javascript>
function nextfrsales() {
var j=document.getElementById('jsmaxsales');
var s=document.getElementById('jscatidsales');
j.value=(3+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = 'http://www.dpz.ru/shop/sales.php?sta='+j.value+'&catid='+s.value+'&unifid=1';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfrsales() {
var j=document.getElementById('jsmaxsales');
var s=document.getElementById('jscatidsales');
if (Math.round(j.value)>=3) {
j.value=(Math.round(j.value)-3);

scriptNode = document.createElement('script');
scriptNode.src = 'http://www.dpz.ru/shop/sales.php?sta='+j.value+'&catid='+s.value+'&unifid=1';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}
</script>",  $conten);
echo $conten."</div></font>";
?>

</body>

</html>