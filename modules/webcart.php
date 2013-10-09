<?php

@$tit=htmlspecialchars(@$tit);
@$page=htmlspecialchars(@$page);
@$start=htmlspecialchars(@$start);
@$perpage=htmlspecialchars(@$perpage);
@$way=htmlspecialchars(@$way);
@$sorting=htmlspecialchars(@$sorting);

class webcart {
        var $basket_speek = "";
        var $basket_valut = "";
        var $total = 0;
        var $totalweight = 0;
        var $totalvolume = 0;
        var $itemcount = 0;
        var $items = array();
        var $itemprices = array();
        var $itemweights = array();
        var $itemvolumes = array();
        var $itemqtys = array();
        var $itemoptions = array();
        var $itemimg = array();
        var $itemopt = array();
        var $itemoptions2 = array();
        var $itemfids = array();
        var $itembase = array();
       var $itemflag = array();
        var $iteminfo = array();
        var $user_details = array("","","","","","","","USER","","","","","","","","","","","","","","","","","","");
        var $user_where="files";
        function cart() {}

function authorize($logins,$passwords){
//global $au;
global $artrnd;
global $sid;
global $fold;
//if (!preg_match("/^[0-9]+$/", $au)) { $au=0; }
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i", $logins)) {
global $crerror; $crerror .= $lang[37]."<br>";
   return "0";
}
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i", $passwords)) {
global $crerror; $crerror .= $lang[38]."<br>";
   return "0";
}
$valid_return="0";
$file=$fold."/admin/userstat/".$logins.".txt";
if (@file_exists($file)==TRUE) {
$f=fopen($file,"r");
$valid_return="0";

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[1];
@$password=@$out[2];

if ($logins=="$login"){
if (($passwords=="$password")||($passwords==md5("$password".$sid.$artrnd))) {
$this->user_details = $out;
$this->user_where="files";
$valid_return="1";
break;
}
}
}
fclose($f);

} else {
$file=$fold."/admin/db/tmp_users.txt";
if (@file_exists($file)==TRUE) {
$f=fopen($file,"r");
$valid_return="0";

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[1];
@$password=@$out[2];

if (($logins=="$login")&&($passwords=="$password")) {
$this->user_details = $out;
$this->user_where="files";
$valid_return="1";
break;
}
}
fclose($f);
}
if ($valid_return=="0") {
$file=$fold."/admin/db/users.txt";
$f=fopen($file,"r");
$valid_return="0";

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[1];
@$password=@$out[2];

if (($logins=="$login")&&($passwords=="$password")) {
$this->user_details = $out;
$this->user_where="files";
$valid_return= "1";
break;
}
}
fclose($f);
}
}
global $users_db_type;
if ($users_db_type=="mysql") {
global $mysql_server;
global $mysql_db_name;
global $template;
global $speek;
global $mysql_user;
global $mysql_pass;
global $user_fields;
global $users_table_name;
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) { } else {
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) {} else {
mysql_select_db($mysql_db_name);
if (mysql_errno()) {} else {
$mysql_query="SELECT * FROM `".$users_table_name."` WHERE (`login`='".mysql_real_escape_string($logins)."')";
$result=mysql_query("$mysql_query");
while($out = mysql_fetch_row($result))
  {

@$login=@$out[1];
@$password=@$out[2];
if ($login==$logins) {
$this->user_details = $out;
$this->user_where="mysql";
$valid_return= "1";
}
}
}
}
}
mysql_close($mysql_link);
}

if ($valid_return=="0") {
$this->user_details = array ("","guest","","","","","","USER","","","","","","","","","","","");
$this->user_where="";
}
if ($valid_return=="1") {
$fp=fopen("./admin/userstat/".$this->user_details[1]."/lastvisit.time", "w");
fputs ($fp, time());
fclose ($fp);
}
return $valid_return;
}



function ver_login($ver_logins){
if (!preg_match("/^[a-zA-Z0-9_\.\/-]+$/i", $ver_logins)) {
global $crerror; $crerror .= $lang[37]."<br>";
   return FALSE;
}
global $fold;
$valid_return="0";
$file=$fold."/admin/userstat/".$ver_logins.".txt";
if (@file_exists($file)==TRUE) {
$f=fopen($file,"r");
$valid_return="0";

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[1];

if ($ver_logins=="$login") {
$valid_return="1";
break;
}
}
fclose($f);

} else {
$file=$fold."/admin/db/tmp_users.txt";
if (@file_exists($file)==TRUE) {
$f=fopen($file,"r");
$valid_return="0";

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[1];

if ($ver_logins=="$login") {
$valid_return="1";
break;
}
}
fclose($f);
}
if ($valid_return=="0") {
$file=$fold."/admin/db/users.txt";
$f=fopen($file,"r");
$valid_return="0";

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[1];

if ($ver_logins=="$login") {

$valid_return= "1";
break;
}
}
fclose($f);
}
}
global $users_db_type;
if ($users_db_type=="mysql") {
global $mysql_server;
global $mysql_db_name;
global $template;
global $speek;
global $mysql_user;
global $mysql_pass;
global $user_fields;
global $users_table_name;
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) { } else {
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) {} else {
mysql_select_db($mysql_db_name);
if (mysql_errno()) {} else {
$mysql_query="SELECT * FROM `".$users_table_name."` WHERE (`login`='".mysql_real_escape_string($ver_logins)."')";
$result=mysql_query("$mysql_query");
$rows=mysql_num_rows($result);

if ($rows>0) {
$valid_return="1";
}
}
}
}
mysql_close($mysql_link);
}
if ($valid_return=="0") {
return FALSE;
} else {
return TRUE;
}

}

function restore_mail($ver_logins){
global $lang;
global $shop_mail;
global $htpath;
global $codepage;
global $fold;

if (!preg_match("/^[a-zA-Z0-9_@\.\/-]+$/i", $ver_logins)) {
global $crerror; $crerror .= $lang[37]."<br>";
   return FALSE;
}

$valid_return="";
$handle=opendir($fold."/admin/userstat/");
unset($fillez);
$ffl=0;
while (($file = readdir($handle))!==FALSE) {

if ((is_dir($file)==TRUE) ||(substr($file,-4)!=".txt")){
continue;
} else {
$f=fopen($fold."/admin/userstat/".$file,"r");

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[4];
if ($ver_logins=="$login") {
$valid_return="1";

mail ($out[4] ,"PASSWORD From: ". str_replace("http://","",$htpath). " To: $out[4]", $lang['welc']." <b>$out[3]</b>!<br>\n<br>\n".$lang[266]." <a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a><br>\n".$lang[267]." <br>\n<br>\n<b>".$lang['login'].":</b> $out[1]<br>\n <b>".$lang['pass'].":</b> $out[2]<br>\n<br>\n<b>".$lang[211]."</b> ".$lang[268]."<br>\n".$lang[269]."<br>\n<br>\n".$lang[270]."<br>\n<a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a>", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
}
}
fclose($f);

}
}

closedir ($handle);


$file=$fold."/admin/db/tmp_users.txt";
if (@file_exists($file)==TRUE) {
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[4];
if ($ver_logins=="$login") {
$valid_return="1";
mail ($out[4] ,"PASSWORD From: ". str_replace("http://","",$htpath). " To: $out[4]", $lang['welc']." <b>$out[3]</b>!<br>\n<br>\n".$lang[266]." <a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a><br>\n".$lang[267]." <br>\n<br>\n<b>".$lang['login'].":</b> $out[1]<br>\n <b>".$lang['pass'].":</b> $out[2]<br>\n<br>\n<b>".$lang[211]."</b> ".$lang[268]."<br>\n".$lang[269]."<br>\n<br>\n".$lang[270]."<br>\n<a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a>", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
}
}
fclose($f);
}

$file=$fold."/admin/db/users.txt";
$f=fopen($file,"r");

while(!feof($f)) {
$st=fgets($f);


$out=explode("|",$st);

@$login=@$out[4];
if ($ver_logins=="$login") {

$valid_return="1";
mail ($out[4] ,"PASSWORD From: ". str_replace("http://","",$htpath). " To: $out[4]", $lang['welc']." <b>$out[3]</b>!<br>\n<br>\n".$lang[266]." <a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a><br>\n".$lang[267]." <br>\n<br>\n<b>".$lang['login'].":</b> $out[1]<br>\n <b>".$lang['pass'].":</b> $out[2]<br>\n<br>\n<b>".$lang[211]."</b> ".$lang[268]."<br>\n".$lang[269]."<br>\n<br>\n".$lang[270]."<br>\n<a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a>", "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
}
}
fclose($f);

global $users_db_type;
if ($users_db_type=="mysql") {

global $mysql_server;
global $mysql_db_name;
global $template;
global $speek;
global $mysql_user;
global $mysql_pass;
global $user_fields;
global $users_table_name;
$mysql_link = mysql_connect($mysql_server, $mysql_user, $mysql_pass) or die("Could not connect : " . mysql_error());
mysql_select_db("$mysql_db_name");
if (mysql_errno()) { } else {
$mysql_query="CREATE DATABASE IF NOT EXISTS $mysql_db_name";
mysql_query("$mysql_query");
if (mysql_errno()) {} else {
mysql_select_db($mysql_db_name);
if (mysql_errno()) {} else {
$mysql_query="SELECT * FROM `".$users_table_name."` WHERE (`email`='".mysql_real_escape_string($ver_logins)."')";
//echo $query;
$result=mysql_query("$mysql_query");
while($row = mysql_fetch_array($result))
  {
  $msubj="PASSWORD From: ". str_replace("http://","",$htpath). " To: ".$row['email'];
  $mbody= $lang['welc']." <b>".$row['username']."</b>!<br>\n<br>\n".$lang[266]." <a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a><br>\n".$lang[267]." <br>\n<br>\n<b>".$lang['login'].":</b> ".$row['login']."<br>\n <b>".$lang['pass'].":</b> ".$row['password']."<br>\n<br>\n<b>".$lang[211]."</b> ".$lang[268]."<br>\n".$lang[269]."<br>\n<br>\n".$lang[270]."<br>\n<a href=\"".$htpath."\">". str_replace("http://","",$htpath). "</a>";
  //echo "<br><br>$msubj<br>".$mbody."<br><br>";
  mail ($row['email'] ,$msubj, $mbody, "From: $shop_mail\nContent-Type: text/html; charset=$codepage\nContent-Transfer-Encoding: 8bit");
  $valid_return="1";
  }

}
}
}
mysql_close($mysql_link);
}


if ($valid_return=="") {
return "";
} else {
return "1";
}

}


function add_user($stroke,$username,$reg_in_userfile){
global $fold;
if ($reg_in_userfile==1) {
$file=$fold."/admin/userstat/$username.txt";
$f=fopen($file,"w"); flock ($f, LOCK_EX);
fputs($f,$stroke."\n"); flock ($f, LOCK_UN);
fclose($f);
} else {
$file=$fold."/admin/db/tmp_users.txt";
$f=fopen($file,"a"); flock ($f, LOCK_EX);
fputs($f,$stroke."\n"); flock ($f, LOCK_UN);
fclose($f);
}
}

function get_details()
        {
                return $this->user_details;
        }


        function get_fids()
        {
                $items = array();  $s=0;
                foreach($this->items as $tmp_item)
                {
                        $item = FALSE;


                        $items[$s] = $this->itemfids[$tmp_item];
                        $s+=1;
                }
                if ($s==0) { return FALSE;} else {
                return $items;} //wishlist
        }


        function get_contents()
        {
                $items = array();
                foreach($this->items as $tmp_item)
                {
                        $item = FALSE;
                        $item['base'] = $this->itembase[$tmp_item];
                        $item['flag'] = $this->itemflag[$tmp_item];
                        $item['id'] = $tmp_item;
                        $item['fid'] = $this->itemfids[$tmp_item];
                        $item['qty'] = $this->itemqtys[$tmp_item];
                        $item['options'] = $this->itemoptions[$tmp_item];
                        $item['img'] = $this->itemimg[$tmp_item];
                        $item['opt'] = $this->itemopt[$tmp_item];
                        $item['options2'] = $this->itemoptions2[$tmp_item];
                        $item['weight'] = $this->itemweights[$tmp_item];
                        $item['volume'] = $this->itemvolumes[$tmp_item];
                        $item['price'] = $this->itemprices[$tmp_item];
                        $item['info'] = $this->iteminfo[$tmp_item];
                        $item['subtotal'] = $item['qty'] * $item['price'];
                        $item['subtotalweight'] = $item['qty'] * $item['weight'];
                        $item['subtotalvolume'] = $item['qty'] * $item['volume'];
                        $items[] = $item;
                }
                return $items;
        }


        function add_item($itemid, $qty=1, $price = FALSE, $info = FALSE, $fid = FALSE, $options="", $options2="", $item_img="", $item_opt=0, $item_valut="", $weight=FALSE,  $base_row="", $flag="", $volume=FALSE)        {
                // echo "<br>itemid=$itemid<br>";
                global $error;
                global $defvalut;
                global $currencies;
                global $lang;
                global $valid;
                global $valut;
                global $kurs;
                global $okr;
                global $details;
                global $vipprocent;
                global $zero_price_incart;
                if ($this->basket_valut=="") {$this->basket_valut=$defvalut;}

                // if ($this->basket_valut==$item_valut) {



                if(!$price)
                {
                @$price = get_price($itemid,$qty);
                }


                $curcur=$item_valut;

if (($curcur=="")||($curcur==$defvalut)) {
$kurss=1;

} else {
if (isset($currencies[$curcur])) {

$kurss=1/$currencies[$curcur];
} else {

$kurss=$kurs;
}
}


                $okadd=0;
                if ($price>0) { $okadd=1;}
                if ($zero_price_incart==1) {$okadd=1;}
                if ($okadd==1) {
                //echo $price." ".$qty." ".$this->basket_valut.",";
                //if (($valid=="1")&&($details[7]=="VIP")): @$price=(@$price-@$price*$vipprocent);  endif;

                if(!$weight)
                {
                        @$weight = get_weight($itemid,$qty);
                }
                if(!$volume)
                {
                        @$volume = get_volume($itemid,$qty);
                }
                if(!$info)
                {
                        $info = get_info($itemid);
                }
                //echo $this->itemqtys[@$itemid]."<br>";
                if(@$this->itemqtys[@$itemid] > 0)
                {
                        $this->itemqtys[$itemid] = $qty + $this->itemqtys[$itemid];
                        $this->_update_total();
                } else {
                        $this->items[]=$itemid;
                        $this->itemqtys[$itemid] = $qty;
                        $this->itemprices[$itemid] = $price*$kurss;
                        $this->itemweights[$itemid] = $weight;
                        $this->itemvolumes[$itemid] = $volume;
                        $this->itemoptions[$itemid] = "<br>$options";
                        $this->itemopt[$itemid] = $item_opt;
                        $this->itemoptions2[$itemid] = $options2;
                        $this->iteminfo[$itemid] = $info;
                        $this->itemfids[$itemid] = $fid;


                }
                $this->itemimg[$itemid] = $item_img;
                $this->itembase[$itemid] = $base_row;
                $this->itemflag[$itemid] = $flag;
                $this->_update_total();

                return $this->itemqtys[$itemid];
                }
             //   } else {
             //   $error=$lang[313]." <b><a href=\"$htpath/index.php?action=clear\">".$lang[314]."</a></b>.<br>".$this->basket_valut ." - ".$item_valut."<br>".$lang[315]."<br><br>";
              //  }

        }

function get_item($itemid)        {
if (isset($this->itemqtys[$itemid])) {
                return $this->itemqtys[$itemid];
                }
        }

        function edit_item($itemids,$qty)
        {
         foreach($this->items as $item)
                {

                if (md5($item)==$itemids) {$itemid=$item;}
                	}
                if($qty ==0) {
                        $this->del_item($itemids);
                } else {
                        $this->itemqtys[$itemid] = $qty;
                }
                $this->_update_total();
        }


        function get_all()
        {
        	$items = array();
                foreach($this->items as $tmp_item)
                {
                        $item = FALSE;
                        $item['base'] = $this->itembase[$tmp_item];
                        $item['flag'] = $this->itemflag[$tmp_item];
                        $item['id'] = $tmp_item;
                        $item['fid'] = $this->itemfids[$tmp_item];
                        $item['qty'] = $this->itemqtys[$tmp_item];
                        $item['options'] = $this->itemoptions[$tmp_item];
                        $item['img'] = $this->itemimg[$tmp_item];
                        $item['opt'] = $this->itemopt[$tmp_item];
                        $item['options2'] = $this->itemoptions2[$tmp_item];
                        $item['weight'] = $this->itemweights[$tmp_item];
                        $item['volume'] = $this->itemvolumes[$tmp_item];
                        $item['price'] = $this->itemprices[$tmp_item];
                        $item['info'] = $this->iteminfo[$tmp_item];
                        $item['subtotal'] = $item['qty'] * $item['price'];
                        $item['subtotalweight'] = $item['qty'] * $item['weight'];
                        $item['subtotalvolume'] = $item['qty'] * $item['volume'];
                        $items[] = $item;
                }
                return $items;
        }


        function del_item($itemids)
        {
        foreach($this->items as $item)
                {
                if (md5($item)==$itemids) {$itemid=$item;}
                	}

                $ti = array();
                @$this->itemqtys[$itemid] = 0;
                foreach($this->items as $item)
                {
                        if($item != $itemid)
                        {
                                $ti[] = $item;
                        }
                }
                $this->items = $ti;
                $this->_update_total();
        }


        function empty_cart()
        {
        global $defvalut;
        global $fold;
                $this->basket_speek = "";
                $this->basket_valut = $defvalut;
                $this->total = 0;
                $this->totalweight = 0;
                $this->totalvolume = 0;
                $this->itemcount = 0;
                $this->items = array();
                $this->itemprices = array();
                $this->itemweights = array();
                $this->itemvolumes = array();
                $this->itemqtys = array();
                $this->itemoptions = array();
                $this->itemimg = array();
                $this->itemopt = array();
                $this->itemoptions2 = array();
                $this->itemdescs = array();
                $this->itemfids = array();
                $this->itembase = array();
                $this->itemflag = array();
                global $details;
                if (@$details[1]!=""){
                @unlink($fold."/admin/userstat/".@$details[1]."/user.basket");
                }
        }


        function _update_total()

        {
        global $fold;
        global $language;
        global $details;
        global $valut;
        global $kurs;
        global $okr;
        global $items_db_type;
        $bask_tosave="";

                $this->itemcount = 0;
                $this->total = 0;
                $this->totalweight = 0;
                $this->totalvolume= 0;
                if(sizeof($this->items > 0))
                {
                        foreach($this->items as $item) {
                                $this->total = $this->total + (($okr*round($this->itemprices[$item]*$kurs/$okr)) * $this->itemqtys[$item]);
                                $this->totalweight = $this->totalweight + ($this->itemweights[$item] * $this->itemqtys[$item]);
                                $this->totalvolume = $this->totalvolume + ($this->itemvolumes[$item] * $this->itemqtys[$item]);
                                $this->itemcount++;
                        if ($items_db_type=="mysql") {
                        $bask_tosave.=$this->itemqtys[$item]."|".($okr*round($this->itemprices[$item]*$kurs/$okr))."|".$this->itemoptions[$item]."|".$this->itemoptions2[$item]."|".$this->iteminfo[$item]."|".$this->itemfids[$item]."|".$this->itemimg[$item]."|".$this->itemopt[$item]."|".$valut."|$language|".$this->itembase[$item]."|".$this->itemflag[$item]."|\n";
                        } else {
                        $bask_tosave.=$this->itemqtys[$item]."|".$this->itemprices[$item]."|".$this->itemoptions[$item]."|".$this->itemoptions2[$item]."|".$this->iteminfo[$item]."|".$this->itemfids[$item]."|".$this->itemimg[$item]."|".$this->itemopt[$item]."|".$valut."|$language|".$this->itembase[$item]."|".$this->itemflag[$item]."|\n";
                        }
                        }

if ($this->itemcount==0) {
if (@$details[1]!=""){
@unlink($fold."/admin/userstat/".@$details[1]."/user.basket");
}
} else {
if (@$details[1]!=""){
if (is_dir ($fold."/admin/userstat/".@$details[1])==FALSE) {
//первый заказ
mkdir ($fold."/admin/userstat/".@$details[1]);
}

$nazv=$fold."/admin/userstat/".@$details[1]."/user.basket";
$file = fopen ($nazv, "w");flock ($file, LOCK_EX);
if (!$file) {
echo "<p> Error opening file <b>$nazv</b> for write.\n";
exit;
}
fputs ($file, "$bask_tosave");flock ($file, LOCK_UN);
fclose ($file);

}
}

                }
        }

}

function get_walet_total($username) {
if ($username!="") {
$waldir=substr($username,0,3);
$walfile="./admin/walet/$waldir/$username.txt";
if (!file_exists($walfile)) {
return 0;
} else {
$tmp=file($walfile);
if (trim($tmp[1])==md5($username.trim($tmp[0]))) {
return trim($tmp[0]);

} else {
return "Hack attempt!";
}
}
} else {
return 0;
}
}
function get_walet_log($username) {
global $init_currency;
global $lang;
if ($username!="") {
$waldir=substr($username,0,3);
$walfile="./admin/walet/$waldir/$username.txt.log";
if (!file_exists($walfile)) {
return "";
} else {
$tmp=array_reverse(file($walfile));
$ret="<table class=\"table table-striped\"><tbody>";
while(list($key,$val)=each($tmp)) {
$t=explode("|", $val);
if (doubleval($t[1])<0) { $clr="red"; $n=$lang[1590];} else { $clr="green"; $n=$lang[1589];}
$ret.="<tr><td>".date("d.m.Y H:i:s", $t[0])."</td><td><font color=$clr>$n</font></td><td><b><font color=$clr>".$t[1]."</font></b></td><td>$init_currency</td></tr>";
}
$ret.="</tbody></table><hr><div align=right>$lang[1121]: <b>".get_walet_total($username)."</b> $init_currency</div><br><br><br>";
return $ret;
}
} else {
return "";
}
}

function del_walet_log($username) {
global $init_currency;
global $lang;
if ($username!="") {
$waldir=substr($username,0,3);
$walfile="./admin/walet/$waldir/$username.txt.log";
if (!file_exists($walfile)) {
return "";
} else {
if (!unlink($walfile)) { return "<div class=well>Error deleting log file</div>";  } else { return "<div class=well>OK</div>";  }
}
} else {
return "<div class=well>Username empty</div>";
}
}
function add_walet($username, $paymentsum,  $initcurrency) {
global $details;
global $lang;
if ($username!="") {
if(!is_dir("./admin/walet")) { mkdir("./admin/walet",0755);}
$waldir=substr($username,0,3);
if(!is_dir("./admin/walet/$waldir")) { mkdir("./admin/walet/$waldir",0755);}
$walfile="./admin/walet/$waldir/$username.txt";
if (!file_exists($walfile)) {
$walettotal=0;
} else {
$tmp=file($walfile);
if (trim($tmp[1])==md5($username.trim($tmp[0]))) {
$walettotal=doubleval(trim($tmp[0]));
}
}
if (doubleval($paymentsum)>0) {
$walettotal=(doubleval($walettotal)+doubleval($paymentsum));
$fp=fopen ($walfile, "w");
fputs ($fp, "$walettotal\n".md5($username.$walettotal)."\n");
fclose ($fp);
$fp=fopen ($walfile.".log", "a");
fputs ($fp, time()."|".doubleval($paymentsum)."|".md5($username.$walettotal)."|".$details[1]."|".$details[7]."\n");
fclose ($fp);
return "OK";
} else {
return "<div class=\"alert alert-error\"><span class=\"label label-important\">$lang[1149]</span> $lang[1596]</div>";
}
} else {
return "Username empty";
}
}
function rem_walet($username, $paymentsum,  $initcurrency) {
global $details;
global $lang;
if ($username!="") {
if(!is_dir("./admin/walet")) { mkdir("./admin/walet",0755);}
$waldir=substr($username,0,3);
if(!is_dir("./admin/walet/$waldir")) { mkdir("./admin/walet/$waldir",0755);}
$walfile="./admin/walet/$waldir/$username.txt";
if (!file_exists($walfile)) {
$walettotal=0;
} else {
$tmp=file($walfile);
if (trim($tmp[1])==md5($username.trim($tmp[0]))) {
$walettotal=doubleval(trim($tmp[0]));
}
}
if (doubleval($paymentsum)<=0)  { return "<div class=\"alert alert-error\"><span class=\"label label-important\">$lang[1587]</span> $lang[1596]</div>";  }
$walettotal=(doubleval(trim($tmp[0]))-doubleval($paymentsum));
if ($walettotal<0) { return "<div class=\"alert alert-error\"><span class=\"label label-important\">$lang[1587]</span> $lang[1588]</div>";  }
$fp=fopen ($walfile, "w");
fputs ($fp, "$walettotal\n".md5($username.$walettotal)."\n");
fclose ($fp);
$fp=fopen ($walfile.".log", "a");
fputs ($fp, time()."|-".doubleval($paymentsum)."|".md5($username.$walettotal)."|".$details[1]."|".$details[7]."\n");
fclose ($fp);
return "OK";
} else {
return "Username empty";
}
}
?>
