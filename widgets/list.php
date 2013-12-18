<?php
$cityname="Moscow";
$citycode=27612; // Citycode can found here: http://www.eurowebcart.ru/index.php?page=nastroyka_vidjetov_pogodyi_i_zakata_voshoda
$lat = 55.76;    // City Lattitude
$long = 37.62;   // City Longtitude
$offset = 4;     // difference between GMT and local time in hours
$refresh_interval = 3600; // in seconds, 1 hour = 3600 sec
require ("./widgets/weather.inc");
if (function_exists ('date_sunrise')) {
require ("./widgets/sunset.inc");
}
//require ("./widgets/exit.inc");

?>
