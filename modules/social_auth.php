<?php
$inname="";
$social_auth="";
//Social auth
if ((!@$_SESSION["fb_id"]) || (@$_SESSION["fb_id"]=="")){
//echo "SESSION REG<BR>";
$_SESSION["fb_id"]="";
$_SESSION["fb_email"]="";
$_SESSION["token"]="";
$_SESSION["fbcontent"]="";
$_SESSION["fb_gender"]="";
$_SESSION["fb_prov"]="";
$_SESSION["fb_ava"]="";
$_SESSION["fb_other"]="";
}
if (($enable_vk_auth!=1)&&($enable_tw_auth!=1)&&($enable_fb_auth!=1)) { } else {
//facebook auth
$fb_key="<fb:login-button scope=\"email\" autologoutlink='false' size=\"medium\" background=\"white\" length=\"long\" v=\"2\">Facebook</fb:login-button>";

define('YOUR_APP_ID', '$fb_app_id');
define('YOUR_APP_SECRET', '$fb_app_secret');
//echo $_COOKIE['fbs_' . $app_id];
function get_facebook_cookie($app_id, $app_secret) {
  $args = array();
  parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
  ksort($args);
  $payload = '';
  foreach ($args as $key => $value) {
    if ($key != 'sig') {
      $payload .= $key . '=' . $value;
    }
  }
  if (md5($payload . $app_secret) != $args['sig']) {
    return null;
  }
  return $args;
}


if ( !function_exists('json_decode') ){
    function json_decode($content, $assoc=false){
                require_once "./blog/JSON.php";
                if ( $assoc ){
                    $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
        } else {
                    $json = new Services_JSON;
                }
        return $json->decode($content);
    }
}

if ( !function_exists('json_encode') ){
    function json_encode($content){
                require_once "./blog/JSON.php";
                $json = new Services_JSON;

        return $json->encode($content);
    }
}
if ((!isset($fbcoockie))&&($blog_out!="yes")) {
$fbcookie = get_facebook_cookie($fb_app_id, $fb_app_secret);

}

if ($blog_out=="yes") {

unset($_SESSION["fb_id"]);
unset($_SESSION["token"]);
unset($_SESSION["fbcontent"]);
unset($_SESSION["fb_gender"]);
unset($_SESSION["fb_prov"]);
unset($_SESSION["fb_ava"]);
unset($_SESSION["fb_email"]);
unset($_SESSION["fb_other"]);
unset($fbcookie);
unset($_SESSION['a_token']);
unset($_SESSION['o_token']);
unset($_SESSION['o_token_secret']);
unset($_SESSION["o_provider"]);
unset($_SESSION["fb_name"]);
$_COOKIE['fbs_' . $fb_app_id];
}
if (($oauth_provider=="facebook")||(@$_SESSION["o_provider"]=="facebook"))  {
$_SESSION["o_provider"]="facebook";
}
if (@$_SESSION["fb_id"]=="") {
if ($fbcookie['access_token']!="") {
if ($use_curl==1) {
$req = 'https://graph.facebook.com/me/?access_token=' . $fbcookie['access_token'];
$ch = curl_init($req);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$fbcontent = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$fbcontent=file_get_contents('https://graph.facebook.com/me?access_token='.$fbcookie['access_token']);
}
//echo " FB READING CONTENT, TOKEN: ". $fbcookie['access_token']."<BR>";
$_SESSION["token"]=$fbcookie['access_token'];
$_SESSION["fbcontent"]=$fbcontent;
$fbuser=json_decode($fbcontent);
$_SESSION["fb_id"]=$fbuser->id;
$_SESSION["fb_prov"] = "facebook";
$_SESSION["fb_name"]=@iconv("UTF-8", $codepage, $fbuser->name);
$_SESSION["fb_gender"]=$fbuser->gender;
$_SESSION["fb_link"]="http://www.facebook.com/profile.php?id=".$fbuser->id;
$fbid=$fbuser->id;
$file = "./gallery/avatars/".$fbid.".jpg";
if (file_exists($file)==TRUE) {
//if ($fbimg != file_get_contents("./gallery/avatars/".$fbid.".jpg")) {
//file_put_contents($file, $fbimg);
//}

} else {
if ($use_curl==1) {
$req = "https://graph.facebook.com/".$fbid."/picture";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, TRUE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=@curl_exec($ch);
if ($ifpc!="") {
$real=trim(trim(str_replace("Location:","", str_replace(strtoken($ifpc, "Location:"),"",strtoken($ifpc,".jpg"))).".jpg"));
$req = "$real";
$file = "./gallery/avatars/".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
}
}
if (curl_errno($ch))
//        exit('TWITTER avatar Download failed');
curl_close($ch);
} else {
$fbimg = file_get_contents("https://graph.facebook.com/".$fbid."/picture");
$file = "./gallery/avatars/".$fbid.".jpg";
file_put_contents($file, $fbimg);
}

}
unset ($file,$fbimg);
$_SESSION["fb_ava"]=$fbid.".jpg";
$_SESSION["fb_email"]=$fbuser->email;
$_SESSION["fb_other"]=$fbuser->id;
}
} else {
$fbcontent=$_SESSION["fbcontent"];
//echo " FB READING SESSION, TOKEN: ". $fbcookie['access_token']."<BR>";
$fbuser=json_decode($fbcontent);
}

//echo " FB_ID:".$_SESSION["fb_id"]." TOKEN: ". $_SESSION["token"]."<BR>";
//
if ($enable_tw_auth==1) {
define('CONSUMER_KEY', $tw_consumer_key);
define('CONSUMER_SECRET', $tw_consumer_secret);
//twitter auth

include_once "./blog/twitteroauth.php";

    if(!empty($_SESSION['a_token']) &&
       !empty($_SESSION['o_token']) &&
       !empty($_SESSION['o_token_secret'])
    ) {
$fb_key="";
//Я уже авторизован давно получим пользовательскую инфу
/*
echo "авторизация успешна!<br>fb_prov=";
echo $_SESSION["fb_prov"];
echo "<br>fb_id=";
echo $_SESSION["fb_id"];
echo "<br>fb_name=";
echo $_SESSION["fb_name"];
echo "<br>fb_gender=";
echo $_SESSION["fb_gender"];
echo "<br>fb_ava=";
echo $_SESSION["fb_ava"];
echo "<br>";
*/

    }



if(!empty($_GET['oauth_verifier']) &&
       !empty($_SESSION['o_token']) &&
       !empty($_SESSION['o_token_secret'])
    ) {
    $fb_key="";
//echo "У меня есть \$_GET['oauth_verifier'] \$_SESSION['o_token'] и \$_SESSION['o_token_secret']<br>";
//echo "\$oauth_verifier =".$_GET['oauth_verifier']."<br>";
//echo "\$_SESSION['o_token'] =".$_SESSION['o_token']."<br>";
//echo "\$_SESSION['o_token_secret'] =".$_SESSION['o_token_secret']."<br>";

$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret, $_SESSION['o_token'], $_SESSION['o_token_secret']);
// Save it in a session var
//var_dump($connection);
//echo "<br><br><br>";
$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
$tw_content = $connection->get('account/verify_credentials');

//var_dump($tw_content);
//echo "<br><br><br>";
//var_dump($tw_content);
//echo "<br><br><br>";

$_SESSION['a_token'] = $access_token;
//echo "a_token =".$_SESSION['a_token']."<br>";
// Let's get the user's info

$fbuser = $connection->get('account/verify_credentials');
//var_dump($tw_content);
//echo "<br><br><br>";
$fbid=$fbuser->id;
$_SESSION["fb_prov"] = "twitter";
$_SESSION["fb_id"] = $fbid;
$_SESSION["fb_name"]=@iconv("UTF-8", $codepage, $fbuser->name);
$_SESSION["fb_gender"]="male";
$_SESSION["fb_other"]=$fbuser->screen_name;
$_SESSION["fb_link"]="http://twitter.com/#!/".$fbuser->screen_name;

$file = "./gallery/avatars/".$fbid.".jpg";
if (file_exists($file)==TRUE) {
//if ($fbimg != file_get_contents("./gallery/avatars/".$fbid.".jpg")) {
//file_put_contents($file, $fbimg);
//}

} else {
if ($use_curl==1) {
$req = $fbuser->profile_image_url;
$file = "./gallery/avatars/".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
}

if (curl_errno($ch))
        exit("TWITTER Avatar ".$req." Download failed");
curl_close($ch);
} else {
$fbimg = file_get_contents($fbuser->profile_image_url);
$file = "./gallery/avatars/".$fbid.".jpg";
file_put_contents($file, $fbimg);
}

}
unset ($file,$fbimg);
$_SESSION["fb_ava"]=$fbid.".jpg"; ;
$_SESSION["fb_other"]=$fbuser->screen_name;

} else {
if (($oauth_provider=="twitter")||(@$_SESSION["o_provider"]=="twitter")) {
$_SESSION["o_provider"]="twitter";
$fb_key="";
//echo "$oauth_provider"." - ". @$_SESSION["o_provider"]."<br>";
$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret);
//var_dump($connection);

} else {
//echo "SESSION o_token пустой<br>";
$connection = new TwitterOAuth($tw_consumer_key, $tw_consumer_secret);

$temporary_credentials = $connection->getRequestToken("$htpath/index.php?$backlink&oauth_provider=twitter");
//var_dump($temporary_credentials);
$redirect_url = $connection->getAuthorizeURL($temporary_credentials);
$_SESSION['o_token'] = $token = $temporary_credentials['oauth_token'];
//echo "SESSION o_token = ".$temporary_credentials['oauth_token']."<br>";
$_SESSION['o_token_secret'] = $temporary_credentials['oauth_token_secret'];
//echo "SESSION o_token_secret = ".$temporary_credentials['oauth_token_secret']."<br>";
//echo "REDIRECT URL=". $redirect_url ."<a href=$redirect_url>$redirect_url</a><br>";
$twit_key="<div style=\"background-image: url('$image_path/tw_log.png'); width:89px; height:24px; cursor: pointer; cursor: hand;\" align=center onclick=\"location.href='".$redirect_url."';\"><font color=#ffffff style=\"font-size:11px\"><b><img src=\"$image_path/pix.gif\" height=16 width=16>Twitter</b></font></div>";

}
}
}


//vkontakte
if ($enable_vk_auth==1) {
$vk_key="<div style=\"background-image: url('$image_path/vk_log.png'); width:89px; height:24px; cursor: pointer; cursor: hand;\" align=center onclick=\"location.href='http://api.vk.com/oauth/authorize?client_id=$vk_client_id&redirect_uri=".rawurlencode("$htpath/index.php?$backlink&oauth_provider=vkontakte")."';\"><font color=#ffffff style=\"font-size:9px\"><b><img src=\"$image_path/pix.gif\" height=16 width=22>KOHTAKTE</b></font></div>";
if (($oauth_provider=="vkontakte")||(@$_SESSION["o_provider"]=="vkontakte"))  {
//echo "oauth_provider=$oauth_provider сущ<br>";

$_SESSION["o_provider"]="vkontakte";

if (!empty($_SESSION['vkontakte'])) {
//echo var_dump($_SESSION['vkontakte']);

} else {
//echo "SESSION['vkontakte'] пуст, наполняем<br>";
$code = $_GET['code'];
$secret = $vk_secret;
if (($code!="")&&($secret!="")&&($vk_client_id!="")) {
if ($use_curl==1) {
$req = "https://api.vk.com/oauth/token?client_id=".$vk_client_id."&code=".$code."&client_secret=".$secret;
$ch = curl_init($req);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$resp = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$resp=file_get_contents("https://api.vk.com/oauth/token?client_id=".$vk_client_id."&code=".$code."&client_secret=".$secret);
}
$_SESSION['vkontakte'] = json_decode($resp);
//echo "Получаем SESSION['vkontakte']<br>";
//var_dump($_SESSION['vkontakte']);
//echo "<br>";
//Working with api

$_SESSION["token"]=$_SESSION['vkontakte']->access_token;
$_SESSION["fb_id"]=$_SESSION['vkontakte']->user_id;
$_SESSION["fb_prov"] = "vkontakte";
$_SESSION["fb_other"]=$_SESSION['vkontakte']->user_id;

$fbid=$_SESSION["fb_id"];
if ($use_curl==1) {
$req = "https://api.vkontakte.ru/method/getProfiles?uid=" . $_SESSION['vkontakte']->user_id."&fields=uid,first_name,last_name,sex,country,photo&access_token=" . $_SESSION['vkontakte']->access_token;
$ch = curl_init($req);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$vkcontent = curl_exec($ch);
if (curl_errno($ch))
//        exit('FACEBOOK Avatar Download failed');
curl_close($ch);
} else {
$vkcontent=file_get_contents("https://api.vkontakte.ru/method/getProfiles?uid=" . $_SESSION['vkontakte']->user_id."&fields=uid,first_name,last_name,sex,country,photo,contacts&access_token=" . $_SESSION['vkontakte']->access_token);
}
if (!empty($_SESSION["fb_name"])) {

} else {
$vkcontent=json_decode($vkcontent);
$fbuser1=$vkcontent->response;
$fbuser=$fbuser1[0];
//echo "Получаем fbuser<br>";
//var_dump($fbuser);
//echo "<br>";
$_SESSION["fb_link"]="http://vk.com/id".$fbuser->uid;
$_SESSION["fb_name"]=@iconv("UTF-8", $codepage, $fbuser->first_name." ".$fbuser->last_name);
$_SESSION["fb_gender"]=$fbuser->sex;
if ("".$_SESSION["fb_gender"]=="0") {$_SESSION["fb_gender"]="male";}
if ($use_curl==1) {
$req = $fbuser->photo;
$file = "./gallery/avatars/vk_".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
$_SESSION["fb_ava"]="vk_".$fbid.".jpg";
unset ($_SESSION['vkontakte'],$_SESSION["o_provider"]);
}

if (curl_errno($ch))
//exit("Vkontakte Avatar ".$req." Download failed");
curl_close($ch);
} else {
$fbimg = file_get_contents($fbuser->photo);
$file = "./gallery/avatars/vk_".$fbid.".jpg";
file_put_contents($file, $fbimg);
$_SESSION["fb_ava"]="vk_".$fbid.".jpg";
unset ($_SESSION['vkontakte'],$_SESSION["o_provider"]);
}

}
} else {
//echo "нет возвращаемых code или отсутсвует secret, ОШИБКА АВТОРИЗАЦИИ<br>";
unset ( $_SESSION['vkontakte'],$_SESSION["o_provider"]);
}
}
}
/*
echo "fb_prov=";
echo $_SESSION["fb_prov"];
echo "<br>fb_id=";
echo $_SESSION["fb_id"];
echo "<br>fb_name=";
echo $_SESSION["fb_name"];
echo "<br>fb_gender=";
echo $_SESSION["fb_gender"];
echo "<br>fb_ava=";
echo $_SESSION["fb_ava"];
echo "<br>";
*/
}

if ($enable_vk_auth!=1) {$vk_key="";}
if ($enable_tw_auth!=1) {$twit_key="";}
if ($enable_fb_auth!=1) {$fb_key="";}
if (($enable_vk_auth!=1)&&($enable_tw_auth!=1)&&($enable_fb_auth!=1)) {$lang[939]="";}
//
$social_auth.="<div class=round2 align=center>";
$fbid="";
$inname="";
//echo "fbcoockie=".$fbcookie['access_token'];
if ($_SESSION["fb_id"]!="") {
//echo " EXIST:".$_SESSION["fb_id"];
$inname=$_SESSION["fb_name"];
if ($inname!="") {
$name=$inname;
$fbid=$_SESSION["fb_id"];
/*
if ($fbid!="") {
$file = "./gallery/avatars/".$fbid.".jpg";
$psocial_ava=$fbid.".jpg";
if (file_exists($file)==TRUE) {
//if ($fbimg != file_get_contents("./gallery/avatars/".$fbid.".jpg")) {
//file_put_contents($file, $fbimg);
//}

} else {
if ($use_curl==1) {
$req = "https://graph.facebook.com/".$fbid."/picture";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, TRUE);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=@curl_exec($ch);
if ($ifpc!="") {
$real=trim(trim(str_replace("Location:","", str_replace(strtoken($ifpc, "Location:"),"",strtoken($ifpc,".jpg"))).".jpg"));
$req = "$real";
$file = "./gallery/avatars/".$fbid.".jpg";
$ch = @curl_init($req);
@curl_setopt($ch, CURLOPT_HEADER, false);
@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$ifpc=curl_exec($ch);
if ($ifpc!="") {
$ifp=fopen($file,"w");
fputs($ifp, $ifpc);
fclose($ifp);
}
}
if (curl_errno($ch))
        exit('Download failed');
curl_close($ch);
} else {
$fbimg = file_get_contents("https://graph.facebook.com/".$fbid."/picture");
$file = "./gallery/avatars/".$fbid.".jpg";
file_put_contents($file, $fbimg);
}

}
unset ($file,$fbimg);
}
*/
$psocial_ava=$_SESSION["fb_ava"];
$psocial_email=$_SESSION["fb_email"];
$psocial_link1="<a href=\"".$_SESSION["fb_link"]."\">";
$psocial_link2="</a>";
$psocial_gender=$_SESSION["fb_gender"];
$psocial_net=$_SESSION["fb_prov"];
$psocial_other=$_SESSION["fb_other"];
$psocial_ico="";
if ($psocial_net=="facebook") {$psocial_ico="<img src=$image_path/fb.png align=absmiddle> ";}
if ($psocial_net=="twitter") {$psocial_ico="<img src=$image_path/twit.png align=absmiddle> ";}
if ($psocial_net=="vkontakte") {$psocial_ico="<img src=$image_path/vk.png align=absmiddle> ";}
if ($psocial_net=="") {$psocial_ico="";}
if ($psocial_net=="") {
$psocial_user="<img src=$image_path/user.png align=absmiddle  border=0>";
} else {
$psocial_user="";
}

$social_auth.="<table border=0><tr><td>$psocial_link1<img style=\"margin-right:5px;\" src=\"gallery/avatars/".$psocial_ava."\" border=0 title=\"$inname\" align=left>$psocial_link2</td><td>"."<small>$psocial_ico$psocial_user<b>$psocial_link1". $_SESSION["fb_name"] ."$psocial_link2</b></small>
<br><img src=\"$image_path/pix.gif\" border=0 width=100 height=5><br>$exitform</td></tr></table>";
} else {
$social_auth.="<table border=0 width=100%><tr><td width=33% align=right><b>$lang[939]</b></td><td><table border=0><tr><td>$fb_key</td><td>$twit_key</td><td>$vk_key</td></tr></table></td></tr></table>";
}

} else {
$social_auth.="<table border=0 width=100%><tr><td width=33% align=right><b>$lang[939]</b></td><td><table border=0><tr><td>$fb_key</td><td>$twit_key</td><td>$vk_key</td></tr></table></td></tr></table>";
 }
 $social_auth.="<div id=\"fb-root\"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = \"//connect.facebook.net/".strtoken($site_nls,".")."/all.js#xfbml=1&appId=$fb_app_id\";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>";
        if ($blog_out=="yes") {
$social_auth.="
<script type=\"text/javascript\">
$(document).ready( function() {
      FB.logout();
} );
</script>
<!-- END switch_facebook_logout -->";

    }
    $social_auth.="</div>";

}

?>

