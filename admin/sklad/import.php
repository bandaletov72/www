<?php
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
$ff=0;
$sum=0;
$dd=0;
$file="./import.csv";
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);

// теперь мы обрабатываем очередную строку $st     |||||||

if ($st!=="") {
$out=explode(";",$st);
$out[6]=(double)str_replace("\n", "", str_replace(",", ".",@$out[6]));

if (@$out[4]=="r"){$r=@$out[1];}
if (@$out[4]=="s"){$sub=@$out[1];}

if ((@$out[4]=="r")||(@$out[4]=="s")) { } else {
$opis="";
if (@$out[5]=="") {$nazv=@$out[1]; $kolvo=@$out[4]; $oldr=$r; $oldsub=$sub; $oldprice="no"; $opis="<br>";} else {
$opis.=@$out[1]."<br>";
if ("$r$sub"!==@$oldr.@$oldsub) {$nazv=$out[1]; $kolvo=$out[4]; $opis="";}
if ((@$oldprice!==@$out[6])&&(@$oldprice!=="no")){$nazv=$out[1];$kolvo=$out[4];$opis="";}
$tmpmass ["|".@$r."|".@$sub."|".str_replace("\"", "", $nazv)."|".(1.3*(double)@$out[6])."|".@$out[6]."|".str_replace(" ", "", @$out[0])."|"]= @$opis."||||0|1||||".@$kolvo."|\n";
$oldprice=@$out[6];
$oldart=@$out[0];
$ff+=1;
}}}}
fclose($f);

reset ($tmpmass);
$ff=1;
while (list ($key, $line) = each ($tmpmass)) {
echo $ff.$key.$line;
$ff+=1;
}
?>
