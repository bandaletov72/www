<!DOCTYPE html><html>

<head>
  <title>Whois</title>
</head>

<body>

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
if ((!@$ip) || (@$ip=="")){ echo "Ќе ввели IP!"; exit; }
$fold=".."; require ("../templates/lang.inc");
if (!isset($speek)) {
$speek=$language;
} else {
$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($speek==$stl){
$found_lang=1;
}
}
if ($found_lang==0){
$speek=$language;
}
}

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
//whois

    $sock = @fsockopen ($ripe_adr,$ripe_port,$errno,$errstr,$ripe_timeout);
    //соединение с сокетом TCP, ожидающим на сервере "whois.ripe.net" на 43 порту.
    //¬озвращает дескриптор соединени€

    if (!$sock) {
      echo("$errno($errstr)");
      @fclose ($sock);
     exit;
    }
    else {
      fputs ($sock, $ip."\r\n");
      //записываем строку из переменной $ip в дескриптор сокета
      $whois="";
      $allwhois="";
      while (!feof($sock)) {
      $stroke=fgets ($sock,128);
      if ((substr($stroke,0, 1)=="%")||(substr($stroke,0, 3)=="rem")||($stroke=="\n")){ } else {
      $allwhois.=str_replace("\"", "", str_replace("\'", "", $stroke));
      }
      if ((substr($stroke,0, 1)=="%")||($stroke=="\n")||($stroke=="")||($stroke==" ")||($stroke=="  ")||(substr($stroke,0,5)=="admin")||(substr($stroke,0,6)=="remark")||(substr($stroke,0,4)=="tech")||(substr($stroke,0,6)=="status")||(substr($stroke,0,3)=="mnt")||(substr($stroke,0,6)=="source")||(substr($stroke,0,4)=="org:")||(substr($stroke,0,3)=="nic")||(substr($stroke,0,3)=="abu")||(substr($stroke,0,3)=="ori")||(substr($stroke,0,3)=="des")||(substr($stroke,0,3)=="net")||(substr($stroke,0,3)=="fax")||(substr($stroke,0,3)=="rou")||(substr($stroke,0,12)=="organisation")||(substr($stroke,0,8)=="org-type")||(substr($stroke,0,8)=="org-name")||(substr($stroke,0,4)=="pers")){

        }else {
        $whois.= $stroke;
        }
        //осуществл€ем чтение из дескриптора сокета
      }
    }
    fclose ($sock);
    //закрытие соединени€
echo "<h4>$ip</h4><pre>$whois<hr>$allwhois</pre>";
/*

// »спользование:
// $domain = "somedomain.com";
// $whois = new whois;
// $whois->zonelookup($domain);
//
// $whois->FOUND показывает найдена запись или нет
// $whois->ERROR признак возникновени€ ошибки.
//
// ”станавливает переменные
// $whois->ORGANIZATION
// $whois->ORG_HANDLE
// $whois->DOMAIN_NAME
// $whois->TECH
// $whois->ADMIN

// ”станавливает массивы
// $whois->DNS_NAME
// $whois->DNS_IP


class whois {

var $port = 43;
var $MAXLEN = 1024;

// “ип запроса
var $QUERY_TYPE = "domain";
var $DEFAULT_SERVER = "whois.crsnic.net";

//Ќастрока повторных попыток
var $MAX_RETRIES = 3;
var $SLEEP_VAL = 1;
var $RETRY = 0;

var $FOUND = 0; // устанавливаетс€ в 0 если запись не найдена
var $ERROR = 0; // устанавливает признак ошибки
var $DATA_MIN = 8; //минимум данных свидетельствующих о том что сервер работает

var $DATA_COUNT = 0;

//ѕеременные. берутс€ из запроса
var $ORGANIZATION;
var $ORG_HANDLE;
var $ORG_ADDRESS; // массив
var $DOMAIN_NAME;
var $DOMAIN_STATUS;
var $ADMIN; // массив: "name", "nic" и "email"
var $TECH; // массив: "name", "nic" и "email"
var $ZONE; // массив: "name", "nic" и "email"
var $BILLING;
var $UPDATED;
var $CREATED;
var $DNS_NAME=array(); // массив с именами DNS серверов
var $HANDLES;

var $IP="";
//список серверов по зонам
var $SERVER = array(
"com"=>"whois.crsnic.net",
"net"=>"whois.crsnic.net",
"edu"=>"whois.educause.net",
"org"=>"whois.publicinterestregistry.net",
"arpa"=>"whois.arin.net",
"ripe"=>"whois.ripe.net",
"mil"=>"whois.nic.mil",
"coop"=>"whois.nic.coop",
"museum"=>"whois.museum",
"biz"=>"whois.neulevel.biz",
"info"=>"whois.afilias.net",
"name"=>"whois.nic.name",
"gov"=>"whois.nic.gov",
"aero"=>"whois.information.aero",
"ns"=>"whois.internic.net",
"ip"=>"whois.ripe.net",
"ad"=>"whois.ripe.net",
"al"=>"whois.ripe.net",
"am"=>"whois.ripe.net",
"as"=>"whois.gdns.net",
"at"=>"whois.nic.at",
"au"=>"box2.aunic.net",
"az"=>"whois.ripe.net",
"ba"=>"whois.ripe.net",
"be"=>"whois.dns.be",
"bg"=>"whois.ripe.net",
"br"=>"whois.nic.br",
"by"=>"whois.ripe.net",
"ca"=>"eider.cira.ca",
"cc"=>"whois.nic.cc",
"ch"=>"domex.switch.ch",
"ck"=>"whois.ck-nic.org.ck",
"cl"=>"nic.cl",
"cn"=>"whois.cnnic.net.cn",
"cx"=>"whois.nic.cx",
"cy"=>"whois.ripe.net",
"cz"=>"dc1.eunet.cz",
"de"=>"whois.denic.de",
"dk"=>"whois.dk-hostmaster.dk",
"do"=>"ns.nic.do",
"dz"=>"whois.ripe.net",
"ee"=>"whois.ripe.net",
"eg"=>"whois.ripe.net",
"es"=>"whois.ripe.net",
"fi"=>"whois.ripe.net",
"fo"=>"whois.ripe.net",
"fr"=>"winter.nic.fr",
"ga"=>"whois.ripe.net",
"gb"=>"whois.ripe.net",
"ge"=>"whois.ripe.net",
"gl"=>"whois.ripe.net",
"gm"=>"whois.ripe.net",
"gr"=>"whois.ripe.net",
"gs"=>"whois.adamsnames.tc",
"hk"=>"whois.hkdnr.net.hk",
"hr"=>"whois.ripe.net",
"hu"=>"whois.nic.hu",
"id"=>"muara.idnic.net.id",
"ie"=>"whois.domainregistry.ie",
"il"=>"whois.isoc.org.il",
"in"=>"whois.ncst.ernet.in",
"is"=>"horus.isnic.is",
"it"=>"whois.nic.it",
"jo"=>"whois.ripe.net",
"jp"=>"whois.nic.ad.jp",
"kg"=>"whois.domain.kg",
"kh"=>"whois.nic.net.kh",
"kr"=>"whois.krnic.net",
"la"=>"whois.nic.la",
"li"=>"domex.switch.ch",
"lk"=>"arisen.nic.lk",
"lt"=>"ns.litnet.lt",
"lu"=>"whois.dns.lu",
"lv"=>"whois.ripe.net",
"ma"=>"whois.ripe.net",
"mc"=>"whois.ripe.net",
"md"=>"whois.ripe.net",
"mm"=>"whois.nic.mm",
"ms"=>"whois.adamsnames.tc",
"mt"=>"whois.ripe.net",
"mx"=>"whois.nic.mx",
"nl"=>"whois.domain-registry.nl",
"no"=>"ask.norid.no",
"nu"=>"whois.worldnames.net",
"nz"=>"akl-iis.domainz.net.nz",
"pl"=>"nazgul.nask.waw.pl",
"pt"=>"whois.ripe.net",
"ro"=>"whois.rotld.ro",
"ru"=>"whois.ripn.net",
"se"=>"ear.nic-se.se",
"sg"=>"qs.nic.net.sg",
"sh"=>"whois.nic.sh",
"si"=>"whois.arnes.si",
"sk"=>"whois.ripe.net",
"sm"=>"whois.ripe.net",
"st"=>"whois.nic.st",
"su"=>"whois.ripn.net",
"tc"=>"whois.adamsnames.tc",
"tf"=>"whois.adamsnames.tc",
"th"=>"whois.thnic.net",
"tj"=>"whois.nic.tj",
"tn"=>"whois.ripe.net",
"to"=>"whois.tonic.to",
"tr"=>"whois.ripe.net",
"tw"=>"whois.twnic.net",
"tv"=>"whois.nic.tv",
"ua"=>"whois.net.ua",
"uk"=>"whois.nic.uk",
"us"=>"whois.nic.us",
"va"=>"whois.ripe.net",
"vg"=>"whois.adamsnames.tc",
"ws"=>"whois.worldsite.ws",
"yu"=>"whois.ripe.net",
"za"=>"apies.frd.ac.za",
"xn--p1ag"=>"ru.whois.i-dns.net",
"xn--p1ag"=>"ru.whois.i-dns.net",
"xn--j1ae"=>"whois.i-dns.net",
"xn--e1ap"=>"whois.i-dns.net",
"xn--c1av"=>"whois.i-dns.net",
"net.ru"=>"whois.ripn.net",
"org.ru"=>"whois.ripn.net",
"pp.ru"=>"whois.ripn.net",
"spb.ru"=>"whois.relcom.ru",
"msk.ru"=>"whois.relcom.ru",
"ru.net"=>"whois.relcom.ru",
"yes.ru"=>"whois.regtime.net",
"uk.com"=>"whois.centralnic.com",
"uk.net"=>"whois.centralnic.com",
"gb.com"=>"whois.centralnic.com",
"gb.net"=>"whois.centralnic.com",
"eu.com"=>"whois.centralnic.com"
);

var $TLD;
var $RAWINFO;
var $DNSINFO;
//обращение к WHOIS серверу
function connect ($server)
{
while($this->RETRY <= $this->MAX_RETRIES)
{
$ptr=fsockopen($server, $this->port);
if($ptr>0)
{
$this->ERROR=0;
return($ptr);
}else
{
$this->ERROR++;
$this->RETRY++;
sleep($this->SLEEP_VAL);
}
}
}

//ѕолучает данные и загружает их в массив
function rawlookup ($query)
{
$array=array();
$this->FOUND=1;
$query=strtolower(trim($query));
if(strlen($query)<=2)
{
$this->ERROR=1;
return($array);
}
//устанавливаем сервер по умолчанию
$server=$this->DEFAULT_SERVER;
//пытаемс€ переназначить его
if($this->QUERY_TYPE=="domain")
{
preg_match("/.+\.(.+)\.{0,1}/i",$query,$backrefs);
if(isset($backrefs[1]) && strlen($backrefs[1])>0 && isset($this->SERVER[$backrefs[1]]))
{
$this->TLD=$backrefs[1];
$server=$this->SERVER[$this->TLD];
}

}
$ptr=$this->connect($server);
if($ptr)
{
$query .= "\n";
fputs($ptr, $query);
$i=0;
while(!feof($ptr))
{
$array[$i]=fgets($ptr,$this->MAXLEN);
$this->DATA_COUNT+=strlen(trim($array[$i]));
if(preg_match("/No match for/i", $array[$i]) || preg_match("/Not found/i", $array[$i]) || preg_match("/No entries found for/i", $array[$i]))
{
$this->FOUND=0;
break;
}
if(preg_match("/WHOIS database is down/i",$array[$i]) || preg_match("/Please wait a while and try again/i",$array[$i]))
{
$this->ERROR=1;
$this->FOUND=0;
break;
}
$i++;
}
fclose($ptr);
if($this->DATA_COUNT>$this->DATA_MIN && $this->ERROR==0 && $this->FOUND==1)
{
return($array);
}
}
//в случае ошибки возвращаем пустой массив
return (array());
}


// парсинг результатов
function parsezone ($array)
{
$result=array();
if(!isset($array) || !is_array($array) || count($array)<=3)
{
$this->FOUND=0;
return $result;
}
$cnt=count($array);
$rescnt=0;
$i=0;
$isinfo=true;
while($i<$cnt)
{
if(!$isinfo)
{
$str=trim($array[$i]);
$result[$rescnt]=$str;
//»звлекаем настройки DNS
if(preg_match("/NAME SERVER/i", $str) || preg_match("/NSERVER/i", $str))
{
$str=trim(substr($str, strpos($str, ":")+1));
if($pos=strpos($str, " "))
{
$str=substr($str, 0, $pos);
}
if(substr($str, -1)==".")
{
$str=substr($str, 0, -1);
}
$this->DNS_NAME[]=strtolower($str);
}
$rescnt++;
}
if(trim($array[$i])=="" && $isinfo)
{
$isinfo=false;
}
$i++;
}
return $result;
}

function zonelookup ($query)
{
$query=trim($query);
$this->RAWINFO=$this->rawlookup($query);
if($this->FOUND)
{
$this->RAWINFO=$this->parsezone($this->RAWINFO);
}
if($this->FOUND==0)
{
return;
}
if($this->dns_lookup($query))
{
$this->IP=gethostbyname($query);
$this->build_dns($query);
}
}

function build_dns($query)
{
$cnt=0;
// $temp=dns_get_record($query, "NS");
foreach($this->DNS_NAME AS $dns)
{
$this->DNSINFO[$cnt]="NS: ".$dns."\tinternet address = ".gethostbyname($dns);
$cnt++;
}
if(getmxrr($query, $temp))
{
foreach($temp AS $dns)
{
$this->DNSINFO[$cnt]="MX: ".$dns."\tinternet address = ".gethostbyname($dns);
$cnt++;
}
}

}
function dns_lookup($query)
{
return checkdnsrr($query,"ANY");
}


};




if ((!@$ip) || (@$ip=="")){ echo "Ќе ввели IP!"; exit; }
$fold=".."; require ("../templates/lang.inc");
if (!isset($speek)) {
$speek=$language;
} else {
$found_lang=0;
while (list ($keyl, $stl) = each ($langs)) {
if ($speek==$stl){
$found_lang=1;
}
}
if ($found_lang==0){
$speek=$language;
}
}

require ("../templates/$template/$speek/vars.txt"); @setlocale(LC_CTYPE, $site_nls);  require ("../templates/$template/$speek/config.inc");
//whois

if(isset($_GET["ip"]) && strlen($_GET["ip"])>0)
{
$target=gethostbyname($_GET["ip"]);
$whois=new whois();
$whois->zonelookup($target);
if($whois->ERROR==0)
{
if(is_array($whois->RAWINFO) && count($whois->RAWINFO)>7 && $whois->FOUND==1)
{
echo("<p><b>".$target."</b><br>IP: ".$whois->IP."</p><pre>");
foreach($whois->RAWINFO AS $str)
{
echo($str."\n");
}
echo("</pre>");
echo("<p>DNS INFO:</p><pre>");
foreach($whois->DNSINFO AS $str)
{
echo($str."\n");
}
echo("</pre>");
}else
{
echo("<p>".$target." <b>Free</b></p>");
}
}else
{
echo("<p>Requirest is fail</p>");
}
}

*/


?>

</body>

</html>
