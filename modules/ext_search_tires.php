<?
$fo=0;
$sst=0;
$db_host     = "comanci.mysql";
$db_user     = "comanci_mysql";
$db_password = "123";
$db_name     = 'comanci_db';

$selerr = '';
$keyws = array();
$search_desc = '';

$trparams = array(
  'r' => array(
    0 => array('Любой', '*'),
    1 => array('R12', 'r12'),
    2 => array('R13', 'r13'),
    3 => array('R14', 'r14'),
    4 => array('R15', 'r15'),
    5 => array('R16', 'r16'),
    6 => array('R17', 'r17'),
    7 => array('R18', 'r18'),
    8 => array('R19', 'r19'),
    9 => array('R20', 'r20'),
    10 => array('R21', 'r21'),
    11 => array('R22', 'r22'),
    12 => array('R24', 'r24')
  ),
  'w' => array(
    0 => array('Любая', '*'),
    1 => array('30', '30'),
    2 => array('31', '31'),
    3 => array('32', '32'),
    4 => array('33', '33'),
    5 => array('34', '34'),
    6 => array('35', '35'),
    7 => array('37', '37'),
    8 => array('39,5', '39,5'),
    9 => array('40', '40'),
    10 => array('135', '135'),
    11 => array('145', '145'),
    12 => array('155', '155'),
    13 => array('165', '165'),
    14 => array('175', '175'),
    15 => array('185', '185'),
    16 => array('195', '195'),
    17 => array('205', '205'),
    18 => array('215', '215'),
    19 => array('225', '225'),
    20 => array('235', '235'),
    21 => array('245', '245'),
    22 => array('255', '255'),
    23 => array('265', '265'),
    24 => array('275', '275'),
    25 => array('285', '285'),
    26 => array('295', '295'),
    20 => array('305', '305'),
    21 => array('315', '315'),
    22 => array('325', '325'),
    20 => array('345', '345')
  ),
  'prf' => array(
    0 => array('Любой', '*'),
    1 => array('9,5', '9,5'),
    2 => array('10,5', '10,5'),
    3 => array('11', '11'),
    4 => array('12,5', '12,5'),
    5 => array('13,5', '13,5'),
    6 => array('14,5', '14,5'),
    7 => array('15,5', '15,5'),
    8 => array('25', '25'),
    9 => array('30', '30'),
    10 => array('35', '35'),
    11 => array('40', '40'),
    12 => array('45', '45'),
    13 => array('50', '50'),
    14 => array('55', '55'),
    15 => array('60', '60'),
    16 => array('65', '65'),
    17 => array('70', '70'),
    18 => array('75', '75'),
    19 => array('80', '80'),
    20 => array('85', '85')
  ),
  'sess' => array(
    0 => array('Любая', '*'),
    1 => array('Летние', 's'),
    2 => array('Зимние','w')
  )
);

function go_home() {
  global $htpath;
  header("Location: $htpath/index.php");
  exit;
}

function SQL($query) {
   global $db_host, $db_user, $db_password, $db_name;

   $dbh = mysql_connect($db_host, $db_user, $db_password);
   mysql_select_db($db_name);

   mysql_query ("SET NAMES `cp1251`");
   $sth = mysql_query($query); #mysql_query $db_name
   mysql_close();
   if (mysql_errno()>0) {

		echo(mysql_errno()." : ".mysql_error()."<BR>\r\n $query<br>");
		die("Error in sql");
		exit;
   }
   return $sth;
}

function test_kw($kw) {

  global $keyws;
  $kwmatch = false;
  $kw = str_replace(',', '.', $kw);
  //r16_6,5_5x112_57,1_33
  if (preg_match('/([0-9.]+)_([0-9.]+)_([0-9.]+x[0-9.]+)_([0-9.]+)_'.
    '([0-9.]+)/i', $kw, $m))
    foreach ($keyws as $key){
      //var_dump($key);
      //var_dump($m);
      if (
        ($key[0] == $m[1]) &&
        //(($key[1]-0.5 <= $m[2]) && ($key[1]+0.5 >= $m[2])) &&
        ($key[1] == $m[2]) &&
        ($key[2] == $m[3]) &&
        ($key[3] <= $m[4]) &&
        (($key[4]-3 <= $m[5]) && ($key[4]+3 >= $m[5]))
      ) {
        $kwmatch = true;
        break;
      }
  }
  return $kwmatch;
}

function get_auto_form() {

  global $selerr;
  global $keyws;
  global $search_desc;
  global $nc2;
  global $extsearch_but;
  global $image_path;
  global $selauto;
  global $model_id;
  global $ven_id;
  global $mark_id;
  global $y_id;

  $vendors = array (
    1 => "Acura",
    2 => "Alfa Romeo",
    3 => "Aston Martin",
    4 => "Audi",
    5 => "Bentley",
    6 => "BMW",
    7 => "Buick",
    8 => "Cadillac",
    9 => "Chery",
    10 => "Chevrolet",
    11 => "Chrysler",
    12 => "Citroen",
    13 => "Daewoo",
    14 => "Daihatsu",
    15 => "Dodge",
    16 => "FAW",
    17 => "Ferrari",
    18 => "Fiat",
    19 => "Ford",
    20 => "Geely",
    21 => "GMC",
    22 => "Great Wall",
    23 => "Honda",
    24 => "Hummer",
    25 => "Hyundai",
    26 => "Infiniti",
    27 => "Isuzu",
    28 => "Jaguar",
    29 => "Jeep",
    30 => "Kia",
    31 => "Lancia",
    32 => "Land Rover",
    33 => "Lexus",
    34 => "Lifan",
    35 => "Lincoln",
    36 => "Lotus",
    37 => "Maserati",
    38 => "Maybach",
    39 => "Mazda",
    40 => "Mercedes",
    41 => "Mercury",
    42 => "MG",
    43 => "Mini",
    44 => "Mitsubishi",
    45 => "Nissan",
    46 => "Opel",
    47 => "Peugeot",
    48 => "Pontiac",
    49 => "Porsche",
    50 => "Renault",
    51 => "Rover",
    52 => "Saab",
    53 => "Saturn",
    54 => "Scion",
    55 => "Seat",
    56 => "Skoda",
    57 => "Smart",
    58 => "Ssang Yong",
    59 => "Subaru",
    60 => "Suzuki",
    61 => "Toyota",
    62 => "Volkswagen",
    63 => "Volvo",
    64 => "ВАЗ",
    65 => "ГАЗ",
    66 => "УАЗ"
  );
  $venopts = '';
  $markopts = '';
  $yopts = '';
  $modopts = '';
  for ($i=0; $i<=@count($vendors); $i++) {
		if (@$vendors[$i] != "")
			$venopts .=  "<option value=\"$i\">".@$vendors[$i]."</option>\r\n";
	}

  if ($selauto == 1)
    if (!empty($model_id)) {

      // заполненение списков
      $markopts = "<option value=\"0\">Выберите марку</option>\r\n";
      $yopts = "<option value=\"0\">Выберите год выпуска</option>\r\n";
      $modopts = '';

      $result = SQL("SELECT MIN(id) as id, car FROM `podbor_shini_i_diski` WHERE vendor = '".$vendors[$ven_id]."' GROUP BY car ORDER BY id ASC") ;
      while($row = mysql_fetch_array($result))
        $markopts .= "<option value=\"{$row['id']}\">{$row['car']}</option>\r\n";

      $result = SQL("
        SELECT MIN(id) as id, year
        FROM `podbor_shini_i_diski`
        WHERE (vendor = '{$vendors[$ven_id]}') AND
          (car = (SELECT car FROM `podbor_shini_i_diski` WHERE id = $model_id))
        GROUP BY year ORDER BY id ASC");
      while($row = mysql_fetch_array($result))
        $yopts .= "<option value=\"{$row['id']}\">{$row['year']}</option>\r\n";

      $result = SQL("
        SELECT id, modification
        FROM `podbor_shini_i_diski`
        WHERE (vendor = '{$vendors[$ven_id]}') AND
          (car = (SELECT car FROM `podbor_shini_i_diski` WHERE id = $model_id))
          AND (year = (SELECT year FROM `podbor_shini_i_diski` WHERE id
          = $model_id))
        ORDER BY id ASC");
      while($row = mysql_fetch_array($result))
        $modopts .= "<option value=\"{$row['id']}\">{$row['modification']}</option>\r\n";

      $venopts = str_replace("value=\"$ven_id\"", "value=\"$ven_id\" selected", $venopts);;
      $markopts = str_replace("value=\"$mark_id\"", "value=\"$mark_id\" selected", $markopts);
      $yopts = str_replace("value=\"$y_id\"", "value=\"$y_id\" selected", $yopts);
      $modopts = str_replace("value=\"$model_id\"", "value=\"$model_id\" selected", $modopts);

      // получить ключевое слово
      $result= SQL("SELECT * FROM `podbor_shini_i_diski` WHERE id = $model_id;");
      if(mysql_num_rows($result))  {
        $row = mysql_fetch_array($result);
        $vendor  = $row['vendor'];
        $car  = $row['car'];
        $year  = $row['year'];
        $modification = $row['modification'];
        $pcd = str_replace(array('*', ','), array('x', '.'), $row['pcd']);
        $diametr = str_replace(',', '.',
          preg_replace('/[^0-9.,]/', '', $row['diametr']));
        $gaika = str_replace(',', '.', $row['gaika']);
        $zavod_diskov = str_replace(',', '.', $row['zavod_diskov']);
        $zamen_diskov = str_replace(',', '.', $row['zamen_diskov']);
        $tuning_diski = str_replace(',', '.', $row['tuning_diski']);

        // "{$m[2]}_{$m[1]}_{$pcd}_{$diametr}_{$m[3]}");
        if (!empty($zavod_diskov)) {
          //$keyw = str_replace('.', ',', "r{$d}_{$w}_{$pcd}_{$co}_{$et}");
          //r16_6,5_5x112_57,1_33
          $zavod_diskov = explode("|", $zavod_diskov);
          $search_desc .= '<div><b>Заводские параметры<br/></b><br/>';
          foreach ($zavod_diskov as $zd)
            if (preg_match(
              '/^\s*([0-9.]+)\s*x\s*([0-9.]+)\s*ET([0-9.]+)\s*$/i',
              $zd, $m)) {
                $keyws[] = array($m[2], $m[1], $pcd, $diametr, $m[3]);
                $search_desc.=
                  "<div style=\"display:inline-block;width:auto;padding:5px\"><b>Радиус</b>: R$m[2]<br/>
                  <b>Ширина</b>: $m[1]<br/>
                  <b>Разболтовка</b>: $pcd<br/>
                  <b>ЦО</b>: $diametr<br/>
                  <b>Вылет</b>: $m[3]<br/><br/></div>";
              }
          $search_desc .= '</div>';
          if (!empty($zamen_diskov)) {
            $zamen_diskov = explode("|", $zamen_diskov);
            $search_desc .= '<div><b>Варианты замены<br/></b><br/>';
            foreach ($zamen_diskov as $zd)
              if (preg_match(
                '/^\s*([0-9.]+)\s*x\s*([0-9.]+)\s*ET([0-9.]+)\s*$/i',
                $zd, $m)) {
                  $keyws[] = array($m[2], $m[1], $pcd, $diametr, $m[3]);
                  $search_desc.=
                    "<div style=\"display:inline-block;width:auto;padding:5px\"><b>Радиус</b>: R$m[2]<br/>
                    <b>Ширина</b>: $m[1]<br/>
                    <b>Разболтовка</b>: $pcd<br/>
                    <b>ЦО</b>: $diametr<br/>
                    <b>Вылет</b>: $m[3]<br/><br/></div>";
                }
            $search_desc .= '</div>';
          }
          if (!empty($tuning_diski)) {
            $tuning_diski = explode("|",  $tuning_diski);
            $search_desc .= '<div><b>Тюнинг<br/></b><br/>';
            foreach ($tuning_diski as $zd)
              if (preg_match(
                '/^\s*([0-9.]+)\s*x\s*([0-9.]+)\s*ET([0-9.]+)\s*$/i',
                $zd, $m)) {
                  $keyws[] = array($m[2], $m[1], $pcd, $diametr, $m[3]);
                  $search_desc.=
                    "<div style=\"display:inline-block;width:auto;padding:5px\"><b>Радиус</b>: R$m[2]<br/>
                    <b>Ширина</b>: $m[1]<br/>
                    <b>Разболтовка</b>: $pcd<br/>
                    <b>ЦО</b>: $diametr<br/>
                    <b>Вылет</b>: $m[3]<br/><br/></div>";
                }
            $search_desc .= '</div>';
          }
        }
        else
          $selerr = 'нет данных по выбранной модели';
      }
    }
    else
      $selerr = 'не полностью выбраны данные для подбора';
  $out = '
    <script type="text/javascript">
      var xajaxRequestUri="esajax.php";
      var xajaxDebug=false;
      var xajaxStatusMessages=false;
      var xajaxWaitCursor=true;
      var xajaxDefinedGet=0;
      var xajaxDefinedPost=1;
      var xajaxLoaded=false;
      function xajax_getmodels(){return xajax.call("getmodels", arguments, 1);}
      function xajax_getmodification(){return xajax.call("getmodification", arguments, 1);}
      function xajax_getyear(){return xajax.call("getyear", arguments, 1);}
      function xajax_list(){return xajax.call("list", arguments, 1);}
    </script>
    <script type="text/javascript" src="js/xajax.js"></script>
    <script type="text/javascript">
      window.setTimeout(function () { if (!xajaxLoaded) { alert("Error: the xajax Javascript file could not be included. Perhaps the URL is incorrect?"); } }, 6000);
    </script>';

  $out .= '
    <form method="GET" action="index.php">
    <input type="hidden" name="action" value="ext_search">
    <input type="hidden" name="selauto" value="1">
    <input type="hidden" name="tires" value="0">
    <table style="color:white" width="100%" height="100%" bgcolor="'.$nc2.'" cellpadding="5" cellspacing="5">
    <tr>
      <td align="left"><small>
        Производитель:
      </small></td>
      <td align="left">
        <select name=auto id=auto size=1 onchange="xajax_getmodels(this.value)" style="width:200px">
          <option value="0">Выберите производителя</option>'.
          $venopts.'
        </select>
      </td>
    </tr>
    <tr>
      <td align="left"><small>
        Марка:
      </small></td>
      <td align="left">
        <select name=models id=models size=1 onchange="xajax_getyear(this.value)" style="width:200px">'.
          $markopts.'
        </select>
      </td>
    </tr>
    <tr>
      <td align="left"><small>
        Год выпуска:
      </small></td>
      <td align="left">
        <select name=year id=year  size=1 onchange="xajax_getmodification(this.value)" style="width:200px">'.
          $yopts.'
        </select>
      </td>
    </tr>
    <tr>
      <td align="left"><small>
        Модификация:
      </small></td>
      <td align="left">
        <select name=modification id=modification  size=1 style="width:200px">'.
          $modopts.'
        </select>
      </td>
    </tr>
    </table>';
  $out .= '<p align="center"><input type="submit" value="'.$extsearch_but.'"></p></form>';
  return $out;
}

function get_tires_form() {
  global $trparams;
  global $nc2;
  global $extsearch_but;
  global $image_path;
  global $tires;
  global $r_id;
  global $w_id;
  global $prf_id;
  global $sess_id;
  global $search_desc;
  $ropts = '';
  $wopts = '';
  $prfopts = '';
  $sessopts = '';
  foreach ($trparams['r'] as $id => $l) {
    $ropts .= "<option value=\"$id\">{$l[0]}</option>\r\n";
  }
  foreach ($trparams['w'] as $id => $l) {
    $wopts .= "<option value=\"$id\">{$l[0]}</option>\r\n";
  }
  foreach ($trparams['prf'] as $id => $l) {
    $prfopts .= "<option value=\"$id\">{$l[0]}</option>\r\n";
  }
  foreach ($trparams['sess'] as $id => $l) {
    $sessopts .= "<option value=\"$id\">{$l[0]}</option>\r\n";
  }
  if ($tires == 1) {
    $ropts = str_replace("value=\"$r_id\"", "value=\"$r_id\" selected", $ropts);
    $wopts = str_replace("value=\"$w_id\"", "value=\"$w_id\" selected", $wopts);
    $prfopts = str_replace("value=\"$prf_id\"", "value=\"$prf_id\" selected", $prfopts);
    $sessopts = str_replace("value=\"$sess_id\"", "value=\"$sess_id\" selected", $sessopts);
    $search_desc .=
      "<b>Радиус</b>: {$trparams['r'][$r_id][0]}<br/>
      <b>Ширина</b>: {$trparams['w'][$w_id][0]}<br/>
      <b>Профиль</b>: {$trparams['prf'][$prf_id][0]}<br/>
      <b>Сезонность</b>: {$trparams['sess'][$sess_id][0]}<br/>";
  }
  $out = '
    <form method="GET" action="index.php">
    <input type="hidden" name="action" value="ext_search">
    <input type="hidden" name="selauto" value="0">
    <input type="hidden" name="tires" value="1">
    <table style="color:white" width="100%" height="100%" bgcolor="'.$nc2.'" cellpadding="5" cellspacing="5">
    <tr>
      <td align="left"><small>
        Радиус:
      </small></td>
      <td align="left">
        <select name="r" id="r" size=1>
          '.$ropts.'
        </select>
      </td>
    </tr>
    <tr>
      <td align="left"><small>
        Ширина:
      </small></td>
      <td align="left">
        <select name="w" id="w" size=1>
          '.$wopts.'
        </select>
      </td>
    </tr>
    <tr>
      <td align="left"><small>
        Профиль:
      </small></td>
      <td align="left">
        <select name="prf" id="prf" size=1>
          '.$prfopts.'
        </select>
      </td>
    </tr>
    <tr>
      <td align="left"><small>
        Сезонность:
      </small></td>
      <td align="left">
        <select name="sess" id="sess" size=1>
          '.$sessopts.'
        </select>
      </td>
    </tr>
    </table>';
  $out .= '<p align="center"><input type="submit" value="'.$extsearch_but.'"></p></form>';
  return $out;
}

$hiddens2="";
if ($query=="") {
/*
//example of ext_search.inc
$allow_ext_search=1;
$extsearch_name="Подбор шин:";
$extsearch_but="Подобрать";
$maxquery_num=5; //Number of merged queryes
$qlue_symbol="_"; //Glue symbol


$q_option0[0] = ("Производитель|1"); //Name|#field in database row
$q_option0[1] = ("Высота|2");
$q_option0[2] = ("Ширина|3");
$q_option0[3] = ("Радиус|4");
$q_option0[4] = ("Сезонность|5");

$q_option1[0] = ("Bridgestone|Bridgestone");
$q_option1[1] = ("Continental|Continental");

$q_option2[0] = ("195|195");
$q_option2[1] = ("185|185");

$q_option3[0] = ("65|65");
$q_option3[1] = ("55|55");

$q_option4[0] = ("R13|13");
$q_option4[1] = ("R14|14");
$q_option4[2] = ("R15|15");
$q_option4[3] = ("R17|17");

$q_option5[0] = ("Зимние|w");
$q_option5[1] = ("Летние|s");
$q_option5[2] = ("Всесезонка|a");

*/



$tires = @$_GET['tires'];
$r_id = isset($_GET['r']) ? $_GET['r'] : 0;
$w_id = isset($_GET['w']) ? $_GET['w'] : 0;
$prf_id = isset($_GET['prf']) ? $_GET['prf'] : 0;
$sess_id = isset($_GET['sess']) ? $_GET['sess'] : 0;
$selauto = @$_GET['selauto'] ;
$model_id = @$_GET['modification'];
$ven_id = @$_GET['auto'];
$mark_id = @$_GET['models'];
$y_id = @$_GET['year'];

if ($selauto && (empty($model_id) || empty($ven_id) || empty($mark_id) ||
  empty($y_id)))
  go_home();

if ($tires && (!isset($trparams['r'][$r_id]) || !isset($trparams['w'][$w_id])
  || !isset($trparams['prf'][$prf_id]) || !isset($trparams['sess'][$sess_id])))
  go_home();

$qs=1;
$params="";
$extsearch_text="";

$param_form = '';

while ($qs<=10) {
$eext="ext$qs";
$extex = isset($$eext);
$ds="q_option$qs";
$ed=0;
if (isset ($$ds)) {
$dds=$$ds;
if (!isset($$eext)) {$$eext="*"; $ed=0;}
if (!eregi('^[1-9\*]+$',$$eext)) { $$eext="*"; $ed=0;}
if ($$eext!="*") {$ed=$$eext;}
$tmpfield=explode("|",$q_option0[$qs]);

if ($selauto)
  $params.='&tires=0&selauto=1&'.
    "auto=$ven_id&models=$mark_id&year=$y_id&modification=$model_id";
elseif (!$tires)
  $params.="&tires=0&selauto=0&ext"."$qs=".rawurlencode($$eext);
else
  $params.='&tires=1&'.
    "r=$r_id&w=$w_id&prf=$prf_id&sess=$sess_id";

$tmpvald=explode("|",$dds[$ed]);

$param_form .= "<tr><td align=\"left\"><small>".$tmpfield[0].":<small></td><td align=\"left\"><select name=\"ext$qs"."\" size=\"1\"><option value=\"".$$eext."\" selected>".str_replace("|","", @$tmpvald[0])."</option><option value=\"*\">*</option>";
if (($$eext==0) ||($$eext=="0")||($$eext=="")) {
$tmpsmass[]="*";
}else {
$tmpsmass[]=str_replace("|","", @$tmpvald[0]);
}
unset($exploded);
while (list ($skey, $sval) = each ($$ds)) {
$tmpval=explode ("|",$sval);
$param_form.="<option value=\"".$skey."\">".str_replace("|","", @$tmpval[0])."</option>";
}
$param_form.="</select></td></tr>";
if ($extex)
  $search_desc.="<b>$tmpfield[0]: </b> $tmpvald[0]<br/>";

unset ($skey, $sval,$tmpval,$tmpfield);

}
$qs+=1;
}

$auto_form = get_auto_form();
$tires_form = get_tires_form();
$extsearch_menu =
  '<table width="100%">
    '.(empty($selerr) ? '' :
    '<tr>
      <td colspan="3" align="left">
        <b>Ошибка:</b> '.$selerr.'<br/>
      </td>
    </tr>').
    '<tr>
      <td width="33%"><img src="'.$image_path.'/a.gif" border=0> литые диски по марке автомобиля</td>
      <td width="33%"><img src="'.$image_path.'/a.gif" border=0> литые диски по параметрам</td>
      <td width="33%"><img src="'.$image_path.'/a.gif" border=0> авто шины по параметрам</td>
    </tr>
    <tr>
      <td height="180">'.$auto_form.'
      </td>
      <td height="180">
        <form method="GET" action="index.php">
          <input type=hidden name="action" value="ext_search">
          <input type="hidden" name="selauto" value="0">
          <input type="hidden" name="tires" value="0">
          <table style="color:white" width="100%" height="100%" bgcolor="'.$nc2.'" cellpadding="3" cellspacing="3">'.
            $param_form.'
          </table>
          <p align="center"><input type="submit" value="'.$extsearch_but.'"></p>'.'
        </form>
      </td>
      <td height="180">'.$tires_form.'
      </td>
    </tr>
  </table>
  <div style="font-size:75%">'.
  $search_desc.
  '</div>';

if (($action=="ext_search")&&($_SESSION["user_module"]=="shop")&&($catid=="")) {
//require ("./templates/$template/view.inc");
$rating=file("./admin/comments/rate.txt");

$nit=1;
$tfind=0;
unset($sps);




//if (($_SERVER['SERVER_NAME']=="localhost")||($_SERVER['SERVER_NAME']=="127.0.0.1")||($_SERVER['SERVER_NAME']=="192.168.19.46")){}else { echo "Sorry! But your host \"" . $_SERVER['SERVER_NAME'] . "\" - is NOT licensed for this script! Contact dpz@bk.ru to buy license for this host."; exit;}
if ((!@$novinka) || (@$novinka=="")): $novinka=""; endif;
if ((!@$sss) || (@$sss=="")): $sss=0; endif;
if ((!@$buy_row) || (@$buy_row=="")): $buy_row=""; endif;
if ((!@$qty) || (@$qty=="")): $qty=0; endif;
if ((!@$perpage) || (@$perpage=="")): $perpage=$goods_perpage; endif;
if (!eregi('^[0-9_]+$',$perpage)) { $perpage=$goods_perpage;}
if ($perpage>100) {$perpage=$goods_perpage;}
if ((!@$start) || (@$start=="")): $start=0; endif;
if ((!@$starts) || (@$starts=="")): $starts=0; endif;
if (!eregi('^[0-9_]+$',$start)) { $start=0;}
if (!eregi('^[0-9_]+$',$starts)) { $starts=0;}
if ($start>99999) {$start=0;}
if ((!@$r) || (@$r=="")): $r=""; endif;
if ((!@$sub) || (@$sub=="")): $sub=""; endif;
//custom card add
$c_filename="./templates/$template/$speek/custom_cart.inc";
$cc_cart="";
$cartl[0]="";
if (file_exists($c_filename)==TRUE) {
$custom_cart=file("./templates/$template/$speek/custom_cart.inc");
while (list ($cc_num, $cc_line) = each ($custom_cart)) {
$ccc=explode("|", $cc_line);
if (($cc_line!="")&&($cc_line!="\n")&&(@$ccc[0]!="")&&(@$ccc[0]!="\n")&&(@$ccc[1]!="")){
$ncc=17+$cc_num;

$cartl[$ncc]=trim(@$ccc[1]);
$cartl2[$ncc]=trim(@$ccc[2]);
}
}
}
$gb="";
$mff=0;
$sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <=0) : $prev=0; endif;

$nexts=$starts+$perpage;
$prevs=$starts-$perpage;
if ($prevs <=0) : $prevs=0; endif;

$vitrina="";
$kupil="";

$files_found=0;
$st=0;
$s=0;
$make_col=$cols_of_goods;



//query template
if ($tires)
  $query_template = $trparams['r'][$r_id][1].
    $qlue_symbol.
    $trparams['w'][$w_id][1].
    $qlue_symbol.
    $trparams['prf'][$prf_id][1].
    $qlue_symbol.
    $trparams['sess'][$sess_id][1];
else
  $query_template = implode($qlue_symbol,$tmpsmass);
$query_template="/". str_replace("*", "(.*)", $query_template). "/i";
unset ($tmpsmass);

$gb = "";
$sps[0]="";
$next=$start+$perpage;
$prev=$start-$perpage;
if ($prev <= 0) : $prev=0; endif;
$vitrina="";
$error="";
$kupil="";

$files_found=0;
$st=0;
$s=0;

//start search
//read database
$file="$base_file";

$f=fopen($file,"r");
$ff=0;

while(!feof($f)) {
$mff+=1;
$st=fgets($f);
$ff+=1;

// теперь мы обрабатываем очередную строку $st
while (list ($keyla, $stla) = each ($langs)) {
if ($speek==$stla){
$st=str_replace("[".$stla."]","", str_replace("[/".$stla."]","", $st));
}else{
$st=str_replace("[".$stla."]","<!--", str_replace("[/".$stla."]","-->", $st));
}
}
if ($hidart==1) {
$ext_id=strtoupper(substr(md5(@$out[6].$artrnd), -7));
$newname=strtoken($out[3],"*");

if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
}else{
$stun=str_replace($out[3], $newname, $stun); $stun=str_replace($out[6], "" , $stun);
}
} else {
$stun=str_replace($out[3], $newname, $stun);
$stun=str_replace($out[6], "" , $stun);
}
} else {
$ext_id=@$out[6];
}

$out=explode("|",$st);
$ddescription="";
@$onsale=substr(@$out[12],0,1);
@$price=@$out[4];
@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
//if (($onsale=="0")||($price==0)||($price<$priceot)||($price>$pricedo)): $ff+=1; continue; endif;
$extfound=0;
/*
@$skwords=explode(" ", @$out[8]." ");
while (list ($qfkey, $qfst) = each ($skwords)) {
$test_data=explode($qlue_symbol, $qfst.$qlue_symbol);
if (count($test_data)==count($q_option0)){$extfound=1; $query_match=$qfst; }
}
*/
$extfound=1;
$query_match=@$out[8];
@$sbrand_name=@$out[13];
if ($extfound==1){
//search
//echo $query_match."<br>";
$matching = false;
if ($selauto)
  $matching = (!preg_match('/^tr.+$/', @$out[0]) && test_kw($query_match));
elseif (!$tires)
  $matching = (!preg_match('/^tr.+$/', @$out[0]) && preg_match($query_template, $query_match));
else
  $matching = (preg_match('/^tr.+$/', @$out[0]) && preg_match($query_template, $query_match));
if ($matching) {
//Find results!
$ddescription="";

$inbasket=0;
$inb1="";
$inb2="";
@$file=@$out[0];
@$dir=@$out[1];
@$subdir=@$out[2];
if (substr($catid,-1)=="_") {
$uslovie_poiska=$podstava["$dir|$subdir|"];
} else {
$uslovie_poiska=$podstava["$dir||"];
}
if ($catid==$uslovie_poiska) {
if ($hidart==1) {
@$ext_id=strtoupper(substr(md5(@$out[6].$artrnd), -7));
@$nazv=strtoken(@$out[3],"*")." ". $out[13] . "";
} else {
@$ext_id=@$out[6];
@$nazv=@$out[3];
}

@$price=@$out[4];
$tax="";
$tax=@$out[$taxcolumn];
if ($tax=="") {$tax=$deftax;}

@$opt=@$out[5];
settype ($price, "double");
settype ($opt, "double");
$ueprice=@$price;
$ueopt=@$opt;
@$curcur=substr(@$out[12],1,3);

if (($curcur=="")||($curcur=="$init_currency")) {
$kurss=$kurs;
} else {
if (isset($currencies[$curcur])) {
if ($curcur=="$valut") {
$kurss=1;
} else {
$kurss=($currencies[$valut]/$currencies[$curcur]);
}
} else {
$kurss=$kurs;
}
}
@$price=@$price*$kurss;

@$opt=round(@$opt*$optkurs);
@$description=@$out[7];
$buy_button_action2=$buy_button_action;
$saofound=0;
$saocount=0;

while ($saocount>=0) {
$sao[$saocount] = ExtractString($description, "[option]", "[/option]");
if ($sao[$saocount]=="") {break; } else {
$subao=explode("#", $sao[$saocount]);
$subaocont="";
$subaoname="";
$saoptions="";
while (list($subaokey,$subaoval)=each($subao)) {
if ($subaokey==0) {$subaoname=$subaoval;} else {
$tmpaoval=explode("^","$subaoval");

if (substr($tmpaoval[1],-1)=="%") {} else {$add_valut=$currencies_sign[$_SESSION["user_currency"]];
if (substr($tmpaoval[1],0,1)=="-") {$add_znak="";} else {$add_znak="+";}
$aapr=($okr*(round(($tmpaoval[1]*$kurss)/$okr)));
$aad="";
if ($aapr>0) {
$aad=" $add_znak".$aapr."$add_valut"; }
$subaocont.="<option value=\"".str_replace ("<br>" , "", $subaoname.": ".$subaoval)."\">".$tmpaoval[0]."$aad</option>\n";
$saoptions.="opt['".str_replace ("<br>" , "", $subaoname.": ".$subaoval)."']=(0$add_znak".($okr*(round(($tmpaoval[1]*$kurss)/$okr))).");\n";
$fo=1;
$view_callback=0;
}
}
}
$fix=strlen(ExtractString("[zz]".str_replace(",", ".", $okr)."/", ".", "/"));

$description=str_replace("[option]".$sao[$saocount]."[/option]", "<script language=javascript>
function ao_".$s."_".$saocount."() {
var oll=document.getElementById('aopr_".$s."_".$saocount."').value;
var oldpr=(0+($okr*Math.round(document.getElementById('aopr_".$s."_".$saocount."').value/$okr)));
var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);
idx=document.getElementById('aoid_".$s."_".$saocount."').value;
opt=new Array();
opt['']=0;
$saoptions
var newpr=(Math.round((0+fixed+opt[idx])/$okr)*$okr);
newpr=newpr.toFixed($fix);
document.getElementById('span".$s."').innerHTML=newpr.toString();
document.getElementById('aopr_".$s."_".$saocount."').value=opt[idx];
}
</script><br><b><input type=hidden id=\"aopr_".$s."_".$saocount."\" value=0><span id=\"aotext_".$saocount."\">".str_replace ("<br>" , "", trim($subaoname)).":</span></b><br><select name=\"ao[".$saocount."]\" id=\"aoid_".$s."_".$saocount."\" onchange=\"javascript:ao_".$s."_".$saocount."()\"><option value=\"\"></option>$subaocont</select>\n", $description);
}
$saocount+=1;
}

if (preg_match("/[radio]/i", $description)) {


$radio_found=0;
$radio_count=$saocount;
while ($radio_count>=0) {
$radio_[$radio_count] = ExtractString($description, "[radio]", "[/radio]");
if ($radio_[$radio_count]=="") {break; } else {
$subradio_=explode("#", $radio_[$radio_count]);
$subradio_cont="";
$subradio_name="";

while (list($subradio_key,$subradio_val)=each($subradio_)) {
if ($subradio_key==0) {$subradio_name=$subradio_val;} else {
$tmpradio_val=explode("^","$subradio_val");

if (substr($tmpradio_val[1],-1)=="%") {} else {$add_valut=$currencies_sign[$_SESSION["user_currency"]];
if (substr($tmpradio_val[1],0,1)=="-") {$add_znak="";} else {$add_znak="+";}
$aaad="\"".str_replace ("<br>" , "", trim($subradio_name)).": ".str_replace ("<br>" , "", trim($tmpradio_val[0]))."^".str_replace ("<br>" , "", trim($tmpradio_val[1]))."\"";
$aapr=($okr*(round(($tmpradio_val[1]*$kurss)/$okr)));
$aad="";
$fix=strlen(ExtractString("[zz]".str_replace(",", ".", $okr)."/", ".", "/"));

if ($aapr>0) {
$aad=" $add_znak".$aapr."$add_valut";}
$subradio_cont.=str_replace ("<img " , "<img ", str_replace ("<br>" , "", trim($tmpradio_val[2])))."<input type=radio value=$aaad name=ao[". $radio_count."] onclick=\"javascript:var oldpr=(0+($okr*Math.round(document.getElementById('radio_pr_".$s."_".$radio_count."').value/$okr)));var fixed=(Math.round((parseFloat(document.getElementById('span".$s."').innerHTML)-oldpr)/$okr)*$okr);var idx=(0$add_znak".($okr*(round(($tmpradio_val[1]*$kurss)/$okr))).");opt=new Array();var newpr=(Math.round((0+fixed+idx)/$okr)*$okr);newpr=newpr.toFixed($fix);document.getElementById('span".$s."').innerHTML=newpr.toString();document.getElementById('radio_pr_".$s."_".$radio_count."').value=idx;\"> ".$tmpradio_val[0]."$aad<br>\n";
$fo=1;
$view_callback=0;
$saocount+=1;
}
}
}
$description=str_replace("[radio]".$radio_[$radio_count]."[/radio]", "<br><b><input type=hidden id=\"radio_pr_".$s."_".$radio_count."\" value=0><span id=\"radio_text_".$radio_count."\">".str_replace ("<br>" , "", trim($subradio_name)).":</span></b><br>$subradio_cont", $description);
}
$radio_count+=1;
}

} else {
$buy_button_action=0;
}
if (preg_match("/\[input/", $description)==TRUE) {
$description=str_replace("[input1]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input2]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[input3]", "<input type=text name=ao[". $radio_count."] value=\"\" size=42 style=\"width:100%\">", $description);
$radio_count+=1;
$description=str_replace("[inputarea]", "<textarea name=ao[". $radio_count."] value=\"\" cols=42 rows=5 style=\"width:100%\"></textarea>", $description);
$fo=1;
}
if (preg_match("/\[upload/", $description)==TRUE) {
require "./templates/$template/upload.inc";
$description=str_replace("[upload]", $upload, $description);
$fo=1;
}
$admin_functions="";
$vipold="";
//OPT
$didx=@$details[7]; $ddidx=@$whsalerprice[$didx]; $ppp=($okr*round(doubleval(@$out[$ddidx])*$kurss/$okr)); $price=@$out[$ddidx]*$kurss;
if ($onlyopt==1) {
if ($valid=="1") { if ((substr($details[7],0,3)=="OPT")||($details[7]=="ADMIN")||($details[7]=="MODER")) { } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;} } else { $lang['prebuy']=$lang[736]; $price=0; $ppp=0;}
}
//Eof OPT
$sales="";
reset($cartl);
if ($view_custom_cart_inlist==1) {
$ddescription.="<div align=center><table border=0 width=100%>";
while (list ($cac_num, $cac_line) = each ($cartl)) {

if (($cac_line!="")&&($cac_line!="\n")&&(trim(@$out[$cac_num])!="")&&($cac_num!=$taxcolumn)&&($cac_num!=$othertaxcolumn)&&($cac_num!=$catdirrow3)&&($cac_num!=$catdirrow4)&&($cac_num!=$metatitlerow)&&($cac_num!=$metadescrow)&&($cac_num!=$metakeyrow)) {
$ddescription.="<tr><td><b>$cac_line: </b></td><td>". @$out[$cac_num] ." ". $cartl2[$cac_num]."</td></tr>\n";
}
}
$ddescription.="</table></div>";
}

if ($zero_price_incart==0){
if (($price==0)||($price=="")){$prem1="<!-- "; $prem2=" -->"; $prbuy="<br><br><font color=\"".$nc5."\"><small><b>".$lang['prebuy']."</b></small></font>";} else {$prem1="";$prem2="";$prbuy=""; }
} else {
if (($price==0)||($price=="")){$prem1=""; $prem2=""; $prbuy=" ";} else {$prem1="";$prem2="";$prbuy=""; }

}
//opt
$strto=0;
if(substr($details[7],0,3)!="OPT") {
if ((@$podstavas["$dir|$subdir|"]!="")||(preg_match("/\%/", @$out[8])==TRUE)) { $strto=strtoken(@$out[8],"%"); $vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>"; if ((preg_match("/\%/", @$out[8])==TRUE)&&(doubleval($strto)>0)) { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center><font color=#000000>SALE<BR><b>-".round($strto)."%</b></font></td></tr></table>"; $ueprice=@$ueprice-(@$ueprice*(doubleval($strto))/100); $price=$okr*(round((@$price-(@$price*(doubleval($strto))/100))/$okr));} else { $sales="<table border=0 cellpadding=0 cellspacing=0 width=53 height=53><tr><td background=\"$image_path/sale.png\" style=\"vertical-align: middle\" align=center>SALE<BR><b>-".$podstavas["$dir|$subdir|"]."%</b></td></tr></table>"; if($podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";} @$ueprice=@$ueprice-(@$ueprice*((double)$podstavas["$dir|$subdir|"])/100); $price=$okr*(round((@$price-(@$price*((double)$podstavas["$dir|$subdir|"])/100))/$okr));} } else {
if (($valid=="1")&&($details[7]=="VIP")){
	//@$description=@$description . "<br><small>(".$lang[149].": <b>".@$price."</b>".$currencies_sign[$_SESSION["user_currency"]].") <font color=\"#a0a0a0\">[$ueprice]</font></small>";
	$vipold="<span class=\"oldprice\">".($okr*round(@$price/$okr))."</span>";
	@$price=$okr*round((@$price-@$price*$vipprocent)/$okr); @$ueprice=@$ueprice-@$ueprice*$vipprocent;
	}
}

//eof opt
}
if (doubleval($strto)==0) {$sales=""; $vipold="";}
if (($valid=="1")&&($details[7]=="ADMIN")){ @$description=@$description . "<br><small>(".$lang[148].": <b>".@$opt."</b>) <font color=\"#a0a0a0\">[ $ueopt ]</font> ART: ".$out[6]."</small>"; }
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
	if (($valid=="1")){
	$admin_functions="<br><small><input type=button value=\"V&nbsp;&nbsp;&nbsp;".$lang['ch']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."edit.php?speek=".$speek."&id=".($ff-1)."&view=no','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=760,height=580,left=10,top=10')> <input type=button value=\"Cc&nbsp;&nbsp;&nbsp;".$lang[137]."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."clone.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')>
	<input type=button value=\"X&nbsp;&nbsp;&nbsp;".$lang['del']."\" onClick=javascript:window.open('$htpath/admin/".$scriptprefix."del.php?speek=".$speek."&id=".($ff-1)."','fr','status=no,scrollbars=yes,menubar=no,resizable=yes,location=no,width=500,height=560,left=10,top=10')></small><br>";
	}
	}
if(@$podstavas["$dir|$subdir|"]<0){$sales=""; $vipold="";}
@$kwords=@$out[8];
@$foto1=@$out[9];
$kolvos[md5(@$out[3]." ID:".@$out[6])]=@$out[16];
if (($varcart<100)&&($varcart!=15)){
if ($foto1=="") {$foto1="<img src=\"$image_path/no_photo.gif\" border=0>";}
}
@$foto2=@$out[10];
@$vitrin=@$out[11];
$sqrp="/$vitrin";
if (("$vitrin"=="0")||($vitrin=="")||($vitrin==$lang['pcs'])) {$vitrin=$lang['pcs']; $sq=0; $sqrp="";} else {$sq=1;}
if (doubleval(@$out[$minorderrow])>=1) {$minorder=doubleval(@$out[$minorderrow]); $minorder2=(doubleval(@$out[$minorderrow])*2); $minorderblock=" readonly=readonly"; $minsht="<br><font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1005]))."</font><br><br>"; $minupak="<br><font color=$nc3>".str_replace("[pcs]","$vitrin", str_replace("[num]","$minorder", $lang[1006]))."</font>";} else {$minorder=1; $minorder2=2; $minorderblock=""; $minsht=""; $minupak="";}
@$onsale=substr(@$out[12],0,1);
if ($view_deleted_goods==0) {if (($price==0)||($price=="0")||($price=="")){if(($details[7]=="ADMIN")||($details[7]=="MODER")){ } else {continue;} }}
if ((doubleval($onsale)==0)||($price<$priceot)||($price>$pricedo)){ continue; }
@$brand_name=@$out[13];
if ($brand!="") { if ($brand_name!="$brand") { continue;} }
//Опции
$optionselect="";
$xz=0;

@$out[8]=@$out[8]." ";
while ($xz<50) {
if (preg_match("/option".$xz." /", @$out[8])==TRUE) {$fo=1; $view_callback=0; $optionselect.=@$optio[($xz-1)];}
$xz+=1;
}
if ($fo==1) {$optionselect="<br><table border=0>$optionselect</table>";}

//end Опции

@$ext_lnk=@$out[14];
$linkfile="";
$hear="";
if (preg_match("/\.mp3/i",$ext_lnk)) {$hear="<br><br><a href=\"$htpath/mp3/$ext_lnk\"><img src=\"$image_path/hear.gif\" title=\"Прослушать Demo MP3\" border=0></a>&nbsp;&nbsp;"; }

@$full_descr=@$out[15];
//@$awv1=explode("http://", @$foto1);
//@$awv2=explode("/", @$awv1[1]);
//@$foto1=str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto1);
//@$awv1=explode("http://", @$foto2);
//@$awv2=explode("/", @$awv1[1]);
//@$foto2=str_replace($awv2[0], str_replace("http://", "", $htpath), @$foto2);
//unset ($awv1, $awv2);

$wh="";
if ($foto1!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
$foto1=str_replace("http://www.", "http://", str_replace("\"","'", $foto1));
@$fi=str_replace($htpat,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$foto1),"src=")."src=","", stripslashes(@$foto1))),">")," "));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){

$imagesz = @getimagesize(".$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/$kkd1)." height=".ceil(($imagesz[1])/$kkd1)."";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];}
}
$foto1=str_replace("'", "", str_replace("\"", "", str_replace("<img ", "<img". $wh ." ",stripslashes(@$foto1))));


}
$foto1=str_replace("<img ", "<img vspace=3 hspace=10 title=\"$nazv\"",  stripslashes(@$foto1));

@$foto1=str_replace("border=0", "border=0 align=left", @$foto1);
$foto1=str_replace("width= height= ", "", $foto1);
@$kolvo=@$out[16];
$lid=md5(@$out[3]." ID:".@$out[6]);
$qty=doubleval($qty);
if($qty!=0){ $shtuk=$vitrin;
if (($s==$buy_row)&&($sss=="")){ $kupleno=1; $kupil="<div align=center><font color=$nc3><b>".$lang['buyes']." $qty $shtuk</b></font></div>";  if ($view_basketalert==1) { $kupil.="<a id=minibasket_"."$unifid href=$htpath/minibasket.php?unifid=$lid&qty=$qty&speek=$speek></a><script type=\"text/javascript\">
        $(document).ready(function() {
           $(\"#minibasket_$lid\").fancybox().trigger('click');

        });
    </script>";}} else { $kupil=""; }}
$link="<a href=\"" . $htpath . "/index.php?view=$file\">" . $nazv . "</a>";
/* Для сортировки правильной давай переведем номер из представления 1 в представление 000001*/
$sortby="";
if ($sorting=="price") {
if ($prbuy!="") {if ($way=="down") {$sf=0;} else {$sf=$maximumprice;}} else {$sf=$price;}
if ($stinfo=="int") { if (@$out[16]==0) {if ($way=="down") {if ($prbuy!="") {$sf=0;}else {$sf=1;}} else {$sf=($maximumprice-$price);}} }
$sf=round($sf*100);
$chars= intval(strlen($sf));
//echo $chars."<br>";
if ($chars==1): $sortby="0000000000$sf"; endif;
if ($chars==2): $sortby="000000000$sf"; endif;
if ($chars==3): $sortby="00000000$sf"; endif;
if ($chars==4): $sortby="0000000$sf"; endif;
if ($chars==5): $sortby="000000$sf"; endif;
if ($chars==6): $sortby="00000$sf"; endif;
if ($chars==7): $sortby="0000$sf"; endif;
if ($chars==8): $sortby="000$sf"; endif;
if ($chars==9): $sortby="00$sf"; endif;
if ($chars==10): $sortby="0$sf"; endif;
if ($chars==11): $sortby="$sf"; endif;
}
if ($sorting=="name") {
$sortby=str_replace("<!--", "", str_replace("-->", "","$nazv"));
}
if ($sorting=="date") {
$chars=intval(strlen($ff));
if ($chars==1) {
$sortby="00000$ff";
}
if ($chars==2) {
$sortby="0000$ff";
}
if ($chars==3) {
$sortby="000$ff";
}
if ($chars==4) {
$sortby="00$ff";
}
if ($chars==5) {
$sortby="0$ff";
}
if ($chars==6) {
$sortby="$ff";
}
}
if ($sorting=="date") {
$chars=intval(strlen($ff));

if ($chars==1) {
$sortby="00000$ff";
}
if ($chars==2) {
$sortby="0000$ff";
}
if ($chars==3) {
$sortby="000$ff";
}
if ($chars==4) {
$sortby="00$ff";
}
if ($chars==5) {
$sortby="0$ff";
}
if ($chars==6) {
$sortby="$ff";
}

}
$rat=doubleval(trim($rating[($mff-1)]));
if ($sorting=="rate") {
$chars=intval(strlen($rating[($mff-1)]));
if ($rat==0) {
if ($way=="up") {
$rat=999999-$mff;
}
}
if ($chars==1) {
$sortby="00000".$rat;
}
if ($chars==2) {
$sortby="0000".$rat;
}
if ($chars==3) {
$sortby="000".$rat;
}
if ($chars==4) {
$sortby="00".$rat;
}
if ($chars==5) {
$sortby="0".$rat;
}
if ($chars==6) {
$sortby="".$rat;
}

}
$voterate="";
if ($view_comments==1) {
if (($rat>=1)&&($rat<=5)) {
$voterate="<br><img src=\"$image_path/vote".$rat.".png\" border=0>";
}
}
if ($nazv!="") {
$big="";
if ($description=="") {
$description="";
}

$novina="";
if ((@$out[8]!="")&&($novinka!="")) {
if (@preg_match("/".$novinka."/",@$out[8])==TRUE) {
$novina="&nbsp;&nbsp;<font color=#b94a48 size=2><b>".$lang[172]."</b></font>";
} else {
$novina="";
}
} else {
$novina="";
}
if (($valid=="1")&&($details[7]=="VIP")) {
$fo=1;
}
$inbasket=doubleval($cart->get_item(md5(@$out[3]." ID:".@$out[6])."|"));
if ($inbasket==0) {
$inbasket="";
$inb1="";
$inb2="";
} else {
$inb1=$inb0;
$inb2=" $vitrin";
}
$price=str_replace(",",".",$price);
$ppp=str_replace(",",".",$ppp);
if ($vipold!="") {
$spprice="newprice";
} else {
$spprice="price";
}
$lid=md5(@$out[3]." ID:".@$out[6]);
$llid="<a href=\"$htpath/index.php?unifid=".$lid."\">";
if ($friendly_url==1) {
if($hidart!=1) {
$man=translit(@$out[3])."-".translit(@$out[6]);
if ($mod_rw_enable==0) {
$llid="<a href=\"$htpath/index.php?item_id=".$man."\">";
}else {
$llid="<a href=\"$htpath/".$man.".htm\">";
}
}
}
$bskalert="";
if ($view_basketalert==1) {
$bskalert="<script language=javascript>
function inb_$lid() {
jQuery(document).ready(function() {
	\$.fancybox (
		'<p><b>$nazv</b> $lang[208]</p><p>".$lang[860]."</p>',
		{
        	'autoDimensions'	: false,
			'width'         	: 450,
			'height'        	: 'auto',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		}
	);
});
}
</script>";
}
if (($price==0)||(doubleval($onsale)!=1)) {$description=strtoken($description,"<input");}
if ($sq==1) {

eval ($evstr2);

} else {

if ($fo==1) {
eval ($evstr2);
} else {
eval ($evstr);
}

}


$files_found +=1;
$tfind=1;
$s+=1;
}
}
}
}
}

fclose($f);


$st=0;
$ddt=0;

reset ($sps);
if ($way=="up") {
sort($sps);
} else {
sort($sps);
$res_tmp=array_reverse($sps);
unset($sps);
$sps=$res_tmp;
unset($res_tmp);
}
reset($sps);

if ($start>$s){$start=(floor($s/$perpage))*$perpage; }
while ($st < $perpage) {


$gt=0;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$sps[($start+$st)]) || (@$sps[($start+$st)]=="")): $sps[($start+$st)]=""; $gt=1; $rem1="<!--"; $rem2="-->"; break; break; endif;
if (is_long(($ddt/2))=="TRUE") {
$back=$nc0;
} else {
$back=$nc6;
}
if ($sps[($start+$st)]!="") {
$strtoma=Array();
$strtoma=explode("|",$sps[($start+$st)]);
$sklname=@$strtoma[1];
//if(($details[7]!="ADMIN")&&($details[7]!="MODER")){
@$strtoma[2]=str_replace("http://www.", "http://", str_replace("\"","'", @$strtoma[2]));
if ($strtoma[2]!="") {
$htpat=str_replace("http://www.", "http://",$htpath);
@$fi=str_replace($htpat,"",strtoken(strtoken(str_replace("'", "", str_replace(strtoken(stripslashes(@$strtoma[2]),"src=")."src=","", stripslashes(@$strtoma[2]))),">")," "));
if (substr($fi,0,1)!="/") { $fi="/$fi";}
$kkd1=$kd1;
if (@file_exists(".$fi")){
$imagesz = @getimagesize(".$fi");
if ( $imagesz[1]>doubleval($style['hh'])) {
$kkd1= ($imagesz[1]/doubleval($style['hh']));
}
$wh=" width=".ceil(($imagesz[0])/$kkd1)." height=".ceil(($imagesz[1])/$kkd1)."";
} else {
if (($style['ww']!="")&&($style['hh']!="")) { $wh=" width=".$style['ww_v']." height=".$style['hh_v'];if ($wh==" width=\"\" height=\"\"") {$wh="";}
}
}
if ($wh==" width= height=") {$wh="";}
if ($wh==" width=0 height=0") {$wh="";}
$strtoma[2]=str_replace("<img ", "<img ". $wh ." ",stripslashes(@$strtoma[2]));

}
//}
$sps[($start+$st)]=str_replace("[foto1]",@$strtoma[2], @$strtoma[0]);
$stoks="";
$val=@$sps[($start+$st)];
if (!isset($stinfo)) { $stinfo=""; }
if ($stinfo=="") {
$val=str_replace("[sklad]","",$val);
//$val.="</td></tr>";
} else {
if ($stinfo=="ext") {
$fnamef="./admin/sklad/stock/$sklname.txt";
if (@file_exists($fnamef)) {
$filef=@fopen ($fnamef, "r");
if ($filef) { $stoks="<small>".str_replace(">", "><br>", fread ($filef, filesize ($fnamef)))."</small>";}
fclose ($filef);
}else {
$stoks="<small><img src=$image_path/stockno.gif><br>".$lang[175]."</small>";
}
$val=str_replace("[sklad]",$stoks,$val);
}
if ($stinfo=="int") {
if (@$kolvos[$sklname]==1) {$stoks= "<img src=$image_path/stock1.gif title=\"".$lang[622]."\">";}
if (@$kolvos[$sklname]>$stock4) {$stoks= "<img src=$image_path/stock1.gif title=\"".$lang[623]."\">";}
if (@$kolvos[$sklname]>=$stock3) {$stoks= "<img src=$image_path/stock3.gif title=\"".$lang[624]."\">";}
if (@$kolvos[$sklname]>=$stock2) {$stoks= "<img src=$image_path/stock3.gif title=\"".$lang[624]."\">";}
if (@$kolvos[$sklname]>=$stock1) {$stoks= "<img src=$image_path/stock5.gif title=\"".$lang[625]."\">";}
if (@$kolvos[$sklname]>=$stock0) {$stoks= "<img src=$image_path/stock5.gif><img src=$image_path/stock5.gif title=\"".$lang[626]."\">";}
if (@$kolvos[$sklname]<=$stock5) {$stoks= "<img src=$image_path/stockno.gif title=\"".$lang[621]."\">";}


if (@$kolvos[$sklname]<=$stock5) {$stoks= "<img src=$image_path/stockno.gif title=\"".$lang[621]."\">";}

$val=str_replace("[sklad]",$stoks,$val);

}


}

}
$st +=1;
$ddt +=1;
$gb .="$val\n";
if ($st==$make_col) { $make_col+=$cols_of_goods; if ($cols_of_goods>1) {$ddt+=1;} $gb.="</tr></table></td></tr><tr><td valign=top><table border=0 cellpadding=0 cellspacing=5 width=100%><tr>";}

}
$total=count ($sps)-$gt;

$numberpages=(ceil ($total/$perpage));
$startnew=$start+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

if ($catid!="") {$queryed="&catid=".rawurlencode($catid);} else {$queryed="";}
$stat= "<center><small><br>".$lang[203]." <b>$numberpages</b> <img src=\"$image_path/a.gif\"> ".$lang[206]." <b>$total</b> ".$lang[207]." <img src=\"$image_path/a.gif\"> ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small></center><br>";

$nextpage="<a href=\"$htpath/index.php?action=ext_search&start=" . ($start+$perpage) . "&perpage=$perpage$params$queryed\"><img src=\"$image_path/next.gif\" title=\"".$lang[162]."\" border=0></a>";
$homee="<a href=\"$htpath/index.php?action=ext_search&start=0&perpage=$perpage$params$queryed\"><!--homee--></a>";
if ($start==0) {$homee="";}
$prevpage=" <a href=\"$htpath/index.php?action=ext_search&start=" . ($start-$perpage) . "&perpage=$perpage$params$queryed\"><img src=\"$image_path/prev.gif\" border=0 title=\"".$lang[163]."\"></a>";
if ($start<=0) { $prevpage="<img src=\"$image_path/noprev.gif\" border=0 title=\"".$lang[163]."\">";}
if (($start+$perpage)>=$s){ $nextpage="<img src=\"$image_path/nonext.gif\" border=0 title=\"".$lang[163]."\">";}

$s=0;
$pp="";
$tt=0;
$ts=0;
$td=0;
if (($start<=0) &&(($start+$perpage)>=$s)){ $lang[104]="";}
while ($s < $numberpages) {
$tt+=1;
if (($tt>(11+round($start/$perpage)))||($tt<(round($start/$perpage)-10))) {if ($tt<(round($start/$perpage)-10)) {$td+=1;} else {$ts+=1;}}  else {
if (($start/$perpage)==$s) {
$curp=($s+1);
if (($s+1)==$numberpages) {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b>";
} else {
$pp.= "<b><font size=2>" . ($s+1) . "</font></b> <img src=\"$image_path/a.gif\"> ";
}
} else {
if (($s+1)==$numberpages) {
$pp.= "<a href = \"$htpath/index.php?action=ext_search&start=" . ($s*$perpage) . "&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a>";
} else {
$pp.= "<a href = \"$htpath/index.php?action=ext_search&start=" . ($s*$perpage) . "&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . ($s+1) . "</font></a> <img src=\"$image_path/a.gif\"> ";
}
}
}
$s+=1;
}
if ($td>0) { if ($td>1) { $pp="<a href = \"$htpath/index.php?action=ext_search&start=0&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> ... <img src=\"$image_path/a.gif\"> $pp"; } else { $pp="<a href = \"$htpath/index.php?action=ext_search&start=0&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">1</font></a> <img src=\"$image_path/a.gif\"> $pp"; } }
if ($ts>0) { if ($ts>1) {$pp.="... <img src=\"$image_path/a.gif\">";} $pp.=" <a href=\"$htpath/index.php?action=ext_search&start=" . ($perpage*($numberpages-1)) . "&perpage=$perpage$params$queryed\"><font size=2 color=$nc2 style=\"border-bottom: 1px dotted;\">" . $numberpages . "</font></a>";}
$ppages="<div align=center><table border=0 cellspacing=4 cellpadding=4><tr><td style=\"vertical-align: middle\">$prevpage</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$pp</td><td style=\"vertical-align: middle\"><img src=\"$image_path/hr.gif\"></td><td valign=middle align=center>$nextpage</td></tr></table></div>";
if ($numberpages<=1) { $ppages=""; }
if (!isset($view_compact)){} else { if($view_compact==1) { $poisks="";} else {$poisks="$ppages";}}

if ($way=="up") {$wup="down"; $wim="<img border=0 title=\"".$lang['up']."\" src=\"".$image_path."/sort_up.gif\" align=absmiddle>";} else { $wup="up"; $wim="<img border=0 title=\"".$lang['down']."\" src=\"".$image_path."/sort_down.gif\" align=absmiddle>";}

$gb_g=$gb;
$gb="<script type=\"text/javascript\" src=\"js/overlib.js\"><!-- overLIB (c) Erik Bosrup --></script><table border=0 width=100% cellpadding=0>
<tr><td valign=top>$ppages";

if ($varcart>=100) {$gb.="<form class=form-inline action=\"index.php\" method=\"POST\">";

$gb.="<input type=\"hidden\" name=\"catid\" value=\"$catid\"><input type=\"hidden\" name=\"query\" value=\"$query\"><input type=\"hidden\" name=\"brand\" value=\"".@$brand."\"><input type=\"hidden\" name=\"sorting\" value=\"$sorting\"><input type=\"hidden\" name=\"way\" value=\"$way\"><input type=\"hidden\" name=\"start\" value=\"$start\"><input type=\"hidden\" name=\"perpage\" value=\"$perpage\"><input type=\"hidden\" name=\"view\" value=\"$view\">";

$gb.="<input type=\"hidden\" name=\"mnogo\" value=\"2\">
<input type=\"hidden\" name=\"action\" value=\"basket\">";}

$gb.="<table border=0 cellspacing=5 cellpadding=0 width=100%>
<tr>
$gb_g
</tr>
</table>";
if ($varcart>=100) {$gb.="<div align=right><input id=\"totals\" type=\"hidden\" value=\"".$cart->total."\">".$lang[35].": <b><font size=3 color=".lighter($nc3,-80)." id=\"sosk\">".$cart->total."</font></b>".$currencies_sign[$_SESSION["user_currency"]]."<img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"50\" height=\"1\"><input type=submit value=\"".$lang['buy']."\"><img border=0 src=\"".$image_path."/pix.gif\" align=\"absmiddle\" width=\"60\" height=\"1\"></div></form>";}
$gb.="</td></tr>

</table>

<center><br>$ppages<br><br><br></center>\n";
//$gb="$stat<center><small>$pp</small></center><table border=0 width=100%>$gb</table><center><small>$pp</small></center><br>$stat\n";
$total-=1;
$tfind=1;
if ($files_found==0): $tfind=0; $gb=""; $error="<noindex><font color=$nc2 size=3><br><img src=\"$image_path/hit.gif\"><b>".$lang[93]."</b></font><br><br></noindex>";  $tit=""; endif;
}


if (($_SESSION["user_module"]=="shop")||($_SESSION["user_module"]=="site")){


if ($query!="") {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")) {

}
}

@rsort($search_results);
@reset($search_results);


//Выдача результатов

$st=0;
$search_results_list="";
while ($st < $perpage) {
$gt=0;
if ((!@$search_results[($starts+$st)]) || (@$search_results[($starts+$st)]=="")): $rem1="<!--"; $rem2="-->"; endif;
if ((!@$search_results[($starts+$st)]) || (@$search_results[($starts+$st)]=="")): $search_results[($starts+$st)]=""; $gt=1; $rem1="<!--"; $rem2="-->"; break; break; endif;

if (@$search_results[($starts+$st)]==""): break; endif;

$search_results_list .="<li value=".($starts+$st+1).">". $search_results[($starts+$st)] . "</li>\n\n\n\n";
$st +=1;
}
$total=count ($search_results)-$gt;

$numberpages=(ceil ($total/$perpage));
$startnew=$starts+1;
$end=$startnew + $perpage - 1 + $gt;
if ($end > $total): $end=$total-1 + $gt; endif;

$stat="<h4><font color=\"".$style['nav_col1']."\">".$lang[309]."</font></h4><small>".$lang[310].": \"<b>$query</b>\" ".$lang[311]." ".$lang[203]." <b>".($total)."</b> | ".$lang[204]." <b>$startnew</b> ".$lang[205]." <b>$end</b></font></small>";
$s=0;
$pp="";
while ($s < $numberpages) {
if (($starts/$perpage)==$s) {
$pp.="<b>" . ($s+1) . "</b> | ";
} else {
$pp.="<a href=\"".$_SERVER['PHP_SELF']."?action=ext_search&starts=" . ($s*$perpage) . "$queryed&sort=$sort&forum=$forum\">" . ($s+1) . "</a> | ";
}
$s+=1;
}
$pp="<br><br>&nbsp;&nbsp;<small>".$lang[105].":&nbsp;$pp</small><br><br>";






$total-=1;
if ($s==0): if ($tfind!=0) {$pp=""; $stat=""; $search_results_list="";} else {$pp=""; $stat=""; $search_results_list="";} endif;
if ($numberpages==1): $pp="<br><br>"; endif;
$gb.="$stat$pp<ol class=results>$search_results_list</ol>$pp";

}
}

if ($total>=0) {$error="";}
if ($error!="") {$gb="<p align=\"center\"><font color=$nc2><b>".$lang[93]."</b></font></p><br>";}
if (($smod!="shop") && ($total<0)) {$gb="<p align=\"center\"><font color=$nc2><b>".$lang[93]."</b></font></p><br>";}
$extsearch_text.=$gb;





}

?>
