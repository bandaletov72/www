<?php
function crypt_apr1_md5($plainpasswd) {
    $salt = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz0123456789"), 0, 8);
    $len = strlen($plainpasswd);
    $text = $plainpasswd.'$apr1$'.$salt;
    $bin = pack("H32", md5($plainpasswd.$salt.$plainpasswd));
    for($i = $len; $i > 0; $i -= 16) { $text .= substr($bin, 0, min(16, $i)); }
    for($i = $len; $i > 0; $i >>= 1) { $text .= ($i & 1) ? chr(0) : $plainpasswd{0}; }
    $bin = pack("H32", md5($text));
    for($i = 0; $i < 1000; $i++) {
        $new = ($i & 1) ? $plainpasswd : $bin;
        if ($i % 3) $new .= $salt;
        if ($i % 7) $new .= $plainpasswd;
        $new .= ($i & 1) ? $bin : $plainpasswd;
        $bin = pack("H32", md5($new));
    }
    for ($i = 0; $i < 5; $i++) {
        $k = $i + 6;
        $j = $i + 12;
        if ($j == 16) $j = 5;
        $tmp = $bin[$i].$bin[$k].$bin[$j].@$tmp;
    }
    $tmp = chr(0).chr(0).$bin[11].@$tmp;
    $tmp = strtr(strrev(substr(base64_encode($tmp), 2)),
    "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/",
    "./0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz");
    return "$"."apr1"."$".$salt."$".$tmp;
}
$hta=$lang[42]."!";
if (($valid=="1")&&($details[7]=="ADMIN")){
$hta="<center><div align=\"center\">";
if ( isset($htuser) && isset($htpass1) &&(@$htuser!="")&&(@$htpass1!=""))
{
if( $htpass1 == $htpass2 )
  {
$htaccess = "AuthType Basic\nAuthName \"$htpath Admin\"\nAuthUserFile ". $_SERVER['DOCUMENT_ROOT'].str_replace("http://".$_SERVER['SERVER_NAME'],"",$htpath)."/admin/.htpasswd\nrequire valid-user";
$htaccess2 = "AuthType Basic\nAuthName \"$htpath Admin\"\nAuthUserFile ". $_SERVER['DOCUMENT_ROOT'].str_replace("http://".$_SERVER['SERVER_NAME'],"",$htpath)."/gallery/users/.htpasswd\nrequire valid-user";
if (preg_match("/\:\//i",$_SERVER['DOCUMENT_ROOT'])) {
//Windows system
$hta.="<br>Windows system<br><br>";
$htpasswd = "$htuser:".crypt_apr1_md5($htpass1);
$htpasswd2 = "$htuser:".crypt_apr1_md5($htpass1);
} else {
//Unix system
$hta.="<br>Unix system<br>";

if ((substr(phpversion(),0,3) == "5.3")||(substr(phpversion(),0,3) == "5.4")) {
$hta.="PHP 5.3 or higher<br><br>";
$htpasswd = "$htuser:".crypt($htpass1, base64_encode($htpass1));
$htpasswd2 = "$htuser:".crypt($htpass1, base64_encode($htpass1));
}else {
$hta.="PHP 5.2 or less<br><br>";
$htpasswd = "$htuser:".crypt($htpass1, base64_encode(CRYPT_STD_DES));
$htpasswd2 = "$htuser:".crypt($htpass1, base64_encode(CRYPT_STD_DES));
}
}
$file=fopen("./admin/.htaccess", "w");
fputs($file, $htaccess);
fclose($file);
$file=fopen("./admin/.htpasswd", "w");
fputs($file, $htpasswd);
fclose($file);

$file=fopen("./gallery/users/.htaccess", "w");
fputs($file, $htaccess2);
fclose($file);
$file=fopen("./gallery/users/.htpasswd", "w");
fputs($file, $htpasswd2);
fclose($file);


       $hta.= "<b>".$lang[727]."</b><br><br>".$lang[728]." :<br><br>";
       $hta.= "<small>".nl2br(htmlspecialchars($htaccess))."</small>";
       $hta.= "<br><br>".$lang[729]." :<br><br>";
       $hta.= "<small>".nl2br($htpasswd)."</small><br><br>";
  }  else {
      $hta.= "<b>".$lang[298]."</b><br><br>";
}
} else {
      $hta.= "<b>".$lang[730].":</b><br><br>";
}





$hta.="<form method=\"POST\" action=\"index.php\">
     <input type=\"hidden\" name=\"action\" value=\"htaccess\">
  <table border=\"0\">
    <tr>
      <td width=\"50%\">".$lang['login'].": </td>
      <td width=\"50%\"><input type=\"text\" name=\"htuser\" size=\"20\" value=\"".@$htuser."\"></td>
    </tr>
    <tr>
      <td width=\"50%\">".$lang['pass'].": </td>
      <td width=\"50%\"><input type=\"password\" name=\"htpass1\" size=\"20\" value=\"".@$htpass1."\"></td>
    </tr>
    <tr>
      <td width=\"50%\">".$lang[112].": </td>
      <td width=\"50%\"><input type=\"password\" name=\"htpass2\" size=\"20\" value=\"".@$htpass2."\"></td>
    </tr>
    <tr>

      <td width=\"50%\" colspan=\"2\" align=\"center\"><br><br><input type=\"submit\" class=\"btn btn-primary\" value=\"".$lang[527]."\"><br><br></td>
    </tr>
  </table></form><br><table border=0><tr><td>
";

$hta.= "PHP: ". phpversion()."<br>";
if (@CRYPT_STD_DES == 1) {
    $hta.= 'CRYPT_STD_DES =1<br>';
}  else {
 $hta.= 'CRYPT_STD_DES =0<br>';
}

if (@CRYPT_EXT_DES == 1) {
    $hta.= 'CRYPT_EXT_DES =1<br>';
}  else {
$hta.= 'CRYPT_EXT_DES =0<br>';
}

if (@CRYPT_MD5 == 1) {
    $hta.= 'CRYPT_MD5 =1<br>';
}  else {
$hta.= 'CRYPT_MD5 =0<br>';
}

if (@CRYPT_BLOWFISH == 1) {
    $hta.= 'CRYPT_BLOWFISH =1<br>';
}  else {
$hta.= 'CRYPT_BLOWFISH =0<br>';
}

if (@CRYPT_SHA256 == 1) {
    $hta.= 'CRYPT_SHA256 =1<br>';
}  else {
$hta.= 'CRYPT_SHA256 =0<br>';
}

if (@CRYPT_SHA512 == 1) {
    $hta.= 'SHA-512 =1<br>';
} else {
$hta.= 'SHA-512 =1<br>';
}
$hta.="</td></tr></table></div></center><br><br><br>";
}
?>
