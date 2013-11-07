<?php
$widget="";
if (function_exists( 'simplexml_load_file' )) {
function getweather($city_id) {
// id города Москва  27612

    $data_file="http://export.yandex.ru/weather-ng/forecasts/$city_id.xml"; // адрес xml файла
    if (function_exists( 'simplexml_load_file' )) {
    $xml = simplexml_load_file($data_file); // раскладываем xml на массив

    $city=$xml->fact->station;
    $tempr=$xml->fact->temperature;
    $pic=$xml->fact->image;
    $typet=$xml->fact->weather_type;
    if ($tempr>0) {$tempr="+".$tempr."&deg;";} else {$tempr=$tempr."&deg;";}
    if (($city!="")&&($tempr!="")) {
    $fp=fopen ("./admin/weather.txt","w");
    fputs($fp,

    $city."\n".
    $tempr."\n".
    $pic."\n".
    $typet."\n");

    fclose($fp);
    }

    }

}


if (!file_exists("./admin/weather.txt")) {
getweather($citycode); //Moscow Russia
} else {
if ((filemtime("./admin/weather.txt")+$refresh_interval)<time()){
getweather($citycode);
}
$weather_array=file("./admin/weather.txt");

if ( extension_loaded('mb_string') ) {
       $weather_array[1] = mb_convert_encoding($weather_array[1], $codepage, "UTF-8");
       $weather_array[2] = mb_convert_encoding($weather_array[2], $codepage, "UTF-8");
       $weather_array[3] = mb_convert_encoding($weather_array[3], $codepage, "UTF-8");
       $weather_array[4] = mb_convert_encoding($weather_array[4], $codepage, "UTF-8");
   } elseif ( extension_loaded('iconv') ) {
       $weather_array[1] = @iconv("UTF-8", $codepage, $weather_array[1]);
       $weather_array[2] = @iconv("UTF-8", $codepage, $weather_array[2]);
       $weather_array[3] = @iconv("UTF-8", $codepage, $weather_array[3]);
       $weather_array[4] = @iconv("UTF-8", $codepage, $weather_array[4]);
   }
if ($usetheme==1) {
$themecontent=str_replace("[weather_temp]", "<b><font size=3>".$weather_array[1]."</font></b><sup>o</sup>C",$themecontent);
$themecontent=str_replace("[weather_ico]", "<img src=\"http://img.yandex.net/i/wiz".$weather_array[2].".png\" alt=\"".$weather_array[3]."\" title=\"".$weather_array[3]."\">",$themecontent);
$themecontent=str_replace("[weather_city]", "<a href=\"go.php?".strrev("http://pogoda.yandex.ru")."\">".$lang['citys']."</a>",$themecontent);
$themecontent=str_replace("[weather_type]", $weather_array[3],$themecontent);
}
$widget= "<div class=shadow align=left style=\"background-image: url('grad.php?h=".(40+$popr)."&w=1&e=".str_replace("#","",$nc6)."&s=".str_replace("#","",$nc6)."&d=vertical'); background-repeat: repeat-x; background-color: $nc6; position: fixed; width: ".(54+$popr)."px; height: ".(40+$popr). "px; overflow:hidden; top: ".((40+$popr)+$expos*(40+$popr))."px; right: -20px; z-index:".(1000-$expos)."; padding: 0px; cursor: pointer; cursor: hand;\" onmouseover=\"javascript:this.style.width='400px';\" onmouseout=\"javascript:this.style.width='".(54+$popr)."px';\"><table border=0 cellspacing=5 cellpadding=5 style=\"height:35px;\"><tr><td valign=top align=center>
<img src=\"$image_path/pix.gif\" align=absmiddle width=26 height=8><br><font class=small><b>".$weather_array[1]."</b></font></td><td>
<img src=\"http://img.yandex.net/i/wiz".$weather_array[2].".png\" alt=\"".$weather_array[3]."\" title=\"".$weather_array[3]."\" align=absmiddle></td><td><a href=\"go.php?".strrev("http://pogoda.yandex.ru")."\"><font class=small>".$lang['citys']."</font></a></td><td style=\"white-space:nowrap;\">
<font class=small>$weather_array[3]</font></td><td><font color=#468847 size=1>".date("H:i", filemtime("./admin/weather.txt"))."</font></td></tr></table></div>";
if ($usetheme==1) {
$themecontent=str_replace("[widgets]", "$widget"."[widgets]",$themecontent);
} else {

echo $widget;
}



}
$expos+=1;
}
?>
