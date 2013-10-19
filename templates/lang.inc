<?php
$u_mes="";
unset($details);
$details=array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");

error_reporting(0); //switch off error reporting to prevent undefined vars detection
//error_reporting(E_ALL); //switch on error reporting to detet bugs
$shopdir=""; //Store Directory: Specify a directory of shops on the main directory, or leave blank if the shop is located in the main directory ex. /shop
$htpath=$_SERVER['SERVER_NAME'].$shopdir; //URL of index.php ex. $htpath="http://".$_SERVER['SERVER_NAME']."/shop";
//if (substr($htpath, 0, 4)!="www."){ $htpath= "www.".$htpath;} //add www support
$htpath="http://". $htpath;
$image_path="$htpath/images"; //image_path
$langs  =   Array(
"–усский" => "rus",
);
$valut="RUR"; //what currency you specified in the item database
$init_currency=$valut; //specify what currency to use when you first enter the site or leave it alone
if (!isset($_SESSION['user_currency'])) {$_SESSION['user_currency']=$init_currency;}
$days_to_expire_prices=1;
$okr=1; //def round
$kurs=1; //default currency exchange rate

$optkurs=1; //Wholesaler currency rate

$optround=1; //Wholesaler currency round

$view_currency_select_button=0; //View or not currencies select button for users

//other currencies and its rate
$currencies= Array(
'RUR'=>$kurs,
);

$currencies_round= Array(
'RUR'=>$okr,
);
$currencies_sign= Array(
//Very important! Please specify different signs.
'RUR'=>" руб.",
);
//currensies names in option list
$currencies_name= Array(
'RUR'=>"RUR",
);
//default minimal free delivery order sum
$currencies_zakaz_menee= Array(
'RUR'=>1000,
);
//option minimal order
$minimal_order_not_available=0; // Enable or not orders less then some sum 0-enable 1-disable
$currencies_minimal_order= Array(
'RUR'=>0,
);
//price of delivery if order less then minimal order sum
$currencies_zakaz_dostav= Array(
'RUR'=>200,
);
//taxes NDS
$taxes= Array(
'RUR'=>0.18,
);
//taxes NSP
$othertaxes= Array(
'RUR'=>0.05,
);
//column in database with price for users with status
$whsalerprice=Array(
'ADMIN'=>4,
'MODER'=>4,
'USER'=>4,
'DIRECTOR'=>4,
'HR'=>4,
//'TEAM'=>4,
//'EMPLOYEE'=>4,
'VIP'=>4,
'OPT'=>5,
'OPT1'=>5,
'OPT2'=>5,
//'CAT1'=>4,
//'CAT2'=>4,
//'CAT3'=>4,


);

$onlyopt=0; //only wholesalers view price and BUY button (only users with OPT status)
$taxcolumn=19; //column in database for custom item tax (NDS), default taxes see in lang.inc
$othertaxcolumn=19; //column in database for custom item othertax (NSP), default othertaxes see in lang.inc
$catdirrow3=20;  //col number for 3 level directory
$catdirrow4=21; //col number for 3 level directory
$metatitlerow=22; //col number for meta title
$metadescrow=23; //col number for meta description
$metakeyrow=24; //col number for meta keywords
$minorderrow=25; //col number for minimal order qty
$tax_function=0; //use or not incl.Tax function

//remember defaults

$defzakaz_menee=$currencies_zakaz_menee[$valut];
$defzakaz_dostav=$currencies_zakaz_dostav[$valut];

$defokr=$currencies_round[$valut];
$defvalut=$valut;
$defkurs=$kurs;

//Stock information
$stock0=20; //very many
$stock1=10; //many
$stock2=5; //average
$stock3=3; //little
$stock4=1; //only one
$stock5=0; //out of stock

$language="rus"; #Default language
$deflanguage=$language;
$template=1; #number of design template
$smods=Array("site","shop"); #available modules
$smod="site"; #Default script module
//testing GD
$gd=0; if (function_exists('imagecreatetruecolor')) {$gd=1;} elseif (function_exists('imagecreate')) {$gd=2;} else {$gd=0;}
// ending GD
if (!isset($fold)) {$fold=".";}
$fold=trim($fold);
//additional type of cart variant
$ltypes= array(2=>13, 3=>15);

//$carat="ї";
$carat="Ы";   //default carat
$carat2="ї";

function lighter ($arg1, $arg2) {
$rrr=(hexdec ("0x" . substr($arg1,1,2)));
$ggg=(hexdec ("0x" . substr($arg1,3,2)));
$bbb=(hexdec ("0x" . substr($arg1,5,2)));
$rrr+=round($rrr*$arg2/100);
$ggg+=round($ggg*$arg2/100);
$bbb+=round($bbb*$arg2/100);
if ($rrr>255) {$rrr=255;}if ($rrr<0) {$rrr=0;}
$rrr=dechex($rrr);
if (strlen($rrr)<=1) {$rrr="0".$rrr;}
if ($bbb>255) {$bbb=255;}
if ($bbb<0) {$bbb=0;}
$bbb=dechex($bbb);
if (strlen($bbb)<=1) {$bbb="0".$bbb;}
if ($ggg>255) {$ggg=255;}
if ($ggg<0) {$ggg=0;}
$ggg=dechex($ggg);
if (strlen($ggg)<=1) {$ggg="0".$ggg;} return "#$rrr$ggg$bbb";}

//uncomment this strokes to use external currencies rate
//if (file_exists("./admin/kurs.txt")) { require ("./admin/kurs.txt"); }
//if (file_exists("../admin/kurs.txt")) { require ("../admin/kurs.txt"); }

//MySQL settings
$users_db_type="files"; //files or mysql
$items_db_type="files"; //files or mysql
$blog_db_type="files"; //files or mysql
$mysql_server="localhost"; //MySQL DB server (for future development)
$mysql_user="root"; //MySQL DB user (for future development)
$mysql_pass=""; //MySQL DB pass (for future development)
$mysql_db_name="test"; //MySQL DB name  (for future development)
 //prefix of php_scripts
if ($items_db_type=="mysql") {$scriptprefix="mysql_";} else { $scriptprefix=""; }
if ($blog_db_type=="mysql") {$bscriptprefix="mysql_";} else { $bscriptprefix=""; }
//MySQL table prefix, please change if you do not want any XSS injections test
$dbpref="ewc";
//MySQL backup table prefix, please note if dbpref equal backup_dbpref - main tables will be dropped when backup
$backup_dbpref="backup_ewc3";
$secret_salt="ttrgh7hh775admwjghjyuh5"; //hash salt, please enter some to security your cookies
$sape_id="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$secret_salt="GpaDxcwN7MjAvH9PWlzJbgSTK328rBty0qOERLZ01dfeFuUIXCYio465snmQVhk"; //hash salt, please enter 50-100 random chars 0-9a-zA-Z to security your cookies
$hache_salt="UIlzrBOtyu2vbXCVPA890qwNTK34567hjkERLZdfeFGpasnmQ01WgSDxcHJYioM"; //50-100 random chars 0-9a-zA-Z
$fbmeta="";
$affix=1;
$affix_ofset=100;
$bootstrap_theme=""; //leave blank for light theme or for dark design may use -night
//$bootstrap_theme="-night"; //for dark designs only
?>
