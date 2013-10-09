<?php
$file="./db_index.txt";
$f=fopen($file,"r");
$st="";
$st2="";
$sf=0;
while(!feof($f)) {
$st=fgets($f);


while ($sf<9999) {
$chars= intval(strlen($sf));
if ($chars==1): $sortby="0000$sf"; endif;
if ($chars==2): $sortby="000$sf"; endif;
if ($chars==3): $sortby="00$sf"; endif;
if ($chars==4): $sortby="0$sf"; endif;
$st=str_replace("$sortby|", "\n00000|", $st);
$sf+=1;
echo $sortby. "<br>";
}
$st2.=$st;


}
fclose($f);
$f=fopen($file,"w");
fputs($f, str_replace("\n\n", "\n", $st2));
fclose($f);

?>
