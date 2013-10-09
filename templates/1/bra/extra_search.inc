<?php
$extsearch_name="";  
//max 10 options;


/*

//Usage:
$allow_ext_search=1; //0-disable ext search
$extsearch_name="Extended Search:"; //Title
$maxquery_num=4; //Number of merged queryes
$qlue_symbol="_"; //Glue symbol
$q_optionNUM[NUM] = ("QueryName|Keyword");

ex.:
$q_option1[0] = ("195|195");
$q_option1[1] = ("185|185");

$q_option2[0] = ("65|65");
$q_option2[1] = ("55|55");

$q_option3[0] = ("R13|13");
$q_option3[1] = ("R14|14");
$q_option3[2] = ("R15|15");
$q_option3[3] = ("R17|17");

$q_option4[0] = ("Winter|w");
$q_option4[1] = ("Summer|s");
$q_option4[2] = ("All Season|a");

global query will search keyword somthing like that: 195_65_14_w, with qlue symbol

*/

/*
$allow_ext_search=0;
$extsearch_name="Подбор шин:";
$extsearch_but="Подобрать";
$maxquery_num=5; //Number of merged queryes
$qlue_symbol="_"; //Glue symbol


$q_option0[] = ("Производитель|1"); //Name|#field in database row
$q_option0[] = ("Высота|2");
$q_option0[] = ("Ширина|3");
$q_option0[] = ("Радиус|4");
$q_option0[] = ("Сезонность|5");

$q_option1[] = ("Bridgestone|Bridgestone");
$q_option1[] = ("Continental|Continental");

$q_option2[] = ("195|195");
$q_option2[] = ("185|185");

$q_option3[] = ("65|65");
$q_option3[] = ("55|55");

$q_option4[] = ("R13|13");
$q_option4[] = ("R14|14");
$q_option4[] = ("R15|15");
$q_option4[] = ("R17|17");

$q_option5[] = ("Зимние|w");
$q_option5[] = ("Летние|s");
$q_option5[] = ("Всесезонка|a");
*/


$allow_ext_search=0;
if ($allow_ext_search==1) {
$extsearch_name="<h4>Alluminium Disk Search:</h4>";
$extsearch_but=" V Search";
$maxquery_num=5; //Number of merged queryes
$qlue_symbol="_"; //Glue symbol

$q_option0[] = ("|");  //dont touch
$q_option0[] = ("Brand|1"); //Name|#field in database row
$q_option0[] = ("Radius|2");
$q_option0[] = ("Width|3");
$q_option0[] = ("Bolt|4");
$q_option0[] = ("Hight|5");

$q_option1[] = ("Any|*"); //dont touch
$q_option1[] = ("Acura|Acura");
$q_option1[] = ("Bentley|Bentley");
$q_option1[] = ("Mazda|Mazda");
$q_option1[] = ("VAZ|VAZ");

$q_option2[] = ("Any|*"); //dont touch
$q_option2[] = ("R13|13");
$q_option2[] = ("R14|14");
$q_option2[] = ("R15|15");
$q_option2[] = ("R16|16");
$q_option2[] = ("R17|17");

$q_option3[] = ("Any|*"); //dont touch
$q_option3[] = ("45|45");
$q_option3[] = ("55|55");

$q_option4[] = ("Any|*"); //dont touch
$q_option4[] = ("4|4");
$q_option4[] = ("5|5");
$q_option4[] = ("5|5");

$q_option5[] = ("Any|*");
$q_option5[] = ("15|15");
$q_option5[] = ("20|20");
$q_option5[] = ("25|25");
}
?>
