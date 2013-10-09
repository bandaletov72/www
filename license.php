<!DOCTYPE html><html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<title>License Agreement / Terms and Conditions</title>
<STYLE type="text/css">
BODY {  COLOR: #000000; FONT: 9pt Verdana; MARGIN: 5px 5px 10px }
BODY A:link {COLOR: #3d3d3d; TEXT-DECORATION: none}
BODY A:visited {COLOR: #3d3d3d; TEXT-DECORATION: none}
BODY A:hover {COLOR: #3d3d3d; TEXT-DECORATION: underline}
BODY A:active {COLOR: #3d3d3d; TEXT-DECORATION: underline}
small {FONT: 8pt Verdana}
TD {FONT: 9pt Verdana}
TH {FONT: 9pt Verdana}
P {FONT: 9pt Verdana}
SELECT {FONT: 9pt Verdana}
FORM {DISPLAY: inline;}
LABEL {CURSOR: default;}
.normal {FONT-WEIGHT: normal;}
.load {background-image: url('images/ind.gif'); background-repeat: none; background-position: center}
a.menu { color: black; }
.ALERT  { font-size: 12; color: red; font-weight: bold; }
.ROW {  padding: 4px; color:black; font-weight:bold; background-color: #ffffff; }
ol.results {margin:0 40px 0 40px; padding:0 0 0 40px}
ol.results li {margin-bottom:1em; padding:0;}
ol.results div.text {font-size:80%; padding-bottom:0.1em;}
ol.results div.info {font-size:80%; color:#333333; margin-top:0.3em;}
ol.results div.info a {color:#000000;}
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

.round {
    -moz-border-radius: 5px;
    background: #f2f2f2;
    color: #000000;
    border: 1px solid #b5b5b5;
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
    background: #ffffff;
    border: 1px solid #dddddd;
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
    background: #439be9;
    border: 1px solid #075fad;
    margin-left: 0px;
    margin-right: 10px;
    margin-bottom: 4px;
    margin-top: 0px;
    padding : 3px 3px 3px 3px;
    align: center;
}
.price {
color:#000000;
font: 20pt Georgia;
}
.newprice {
color:#000000;
font: 20pt Georgia;
color:#b94a48;
}
.oldprice {
color:#000000;
font: 20pt Georgia;
text-decoration: line-through;
}

.button {
-moz-border-radius: 5px;
    background: #efefef;
    border: 1px solid #ababab;
    cursor: pointer;
    color: #000000;
    padding : 2px 2px 2px 2px;
    background-image: url(grad.php?h=26&w=1&e=dddddd&s=dddddd&d=vertical);

}
input[type="button"] {
-moz-border-radius: 5px;
    background: #efefef;
    border: 1px solid #ababab;
    cursor: pointer;
    color: #000000;
    padding : 2px 2px 2px 2px;
    background-image: url(grad.php?h=26&w=1&e=dddddd&s=dddddd&d=vertical);
}
input[type="submit"] {
-moz-border-radius: 5px;
    background: #efefef;
    border: 1px solid #ababab;
    cursor: pointer;
    color: #000000;
    padding : 2px 2px 2px 2px;
    background-image: url(grad.php?h=26&w=1&e=efefef&s=efefef&d=vertical);
}

</STYLE></head>
<body>
<?php

echo "<div align=center><table border=0 cellpadding=0 width=100% class=round><tr><td style=\"background-image: url('http://www.24ok.ru/banner.png'); background-repeat: no-repeat; background-position: right top\"><h4>Eurowebcart/24OK License Agreement</h4>
Условия использования и лицензионное соглашение<br><br>";
$license="";
$fp=@fopen("./LICENSE.TXT","r");
if (!$fp) { echo ("Not found LICENSE.TXT<br><b>Please read</b> / Пожалуйста прочтите <br><a href=\"http://www.24ok.ru/LICENSE.TXT\">http://www.24ok.ru/LICENSE.TXT</a><br><br><br>"); } else {
$license=str_replace("]","</b><br><small>",str_replace("[","</small><br><b>",str_replace("\n"," ",str_replace("\n\n","<br>",fread($fp,filesize("./LICENSE.TXT"))))));
fclose($fp);
}
echo "<div align=center><center><div align=left style=\"overflow: scroll; width: 98%; height: 400px; background-color: #ffffff; padding:10px;\">$license</div></center></div>
</td></tr></table></div>";
?>
 </body></html>
