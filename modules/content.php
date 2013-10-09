<?php



//if (file_exists("$base_loc/wiki/".$fir.".car")==TRUE) {
//$fp = fopen ("$base_loc/wiki/".$fir.".car" , "r");
//$reclame=str_replace("mycarousel", "myreclame",str_replace("(carousel)", "(reclame)",str_replace("carousel.", "reclame.",  str_replace("wrap: \'last\'", "wrap: \'circular\'", str_replace("id=\"wrap\"", "id=\"wrap\"",  @fread($fp, @filesize("$base_loc/wiki/".$fir.".car")))))));
//fclose($fp);
//
//}
if ($usetheme==1) {
$wfc="";
if ($view_wikicat==1) {
$wfi=$base_loc."/wiki/$wiki_content".".txt";
if (!file_exists($wfi)) { } else {
$wfp=fopen($wfi,"r");
$wfc=fread($wfp, filesize($wfi));
fclose($wfp);

}
}
if ($wiki_closed==1) {
$wfc=str_replace("//start", "jsallcl();
document.getElementById('viewjsall').innerHTML='".$lang[422]."';
" , $wfc);}
$themecontent=str_replace("[wiki]", "$wfc" , $themecontent);

if ($smod=="shop") {
$themecontent=str_replace("[currency]","$choosecurrency",$themecontent);
if (($action!="zakaz")&&($action!="basket")&&($action!="send")&&($view_bask!=1)&&($tovarov!=0)) {
top($lang[31].":", $print_basket, $style ['right_width'], strtolower($style ['popular']), strtolower($style ['bg_basket']), 5,0,"[main_basket]");
}
}

if (($query=="")&&($unifid=="")&&($item_id=="")&&($catid=="0")&&($action=="x")&&($register!=1)&&($zak=="")){
$themecontent=str_replace("[firstpage]","",  $themecontent);
$themecontent=str_replace("[/firstpage]","",  $themecontent);
$themecontent=str_replace("[contacrform]","",$themecontent);
reset($firstpage);
while (list($firkey,$firval)=each($firstpage)) {
$themecontent=str_replace("[firstpage$firkey]","",  $themecontent);
}

}else {

$themecontent=str_replace("[contacrform]","",$themecontent);
reset ($firstpage);
while (list($firkey,$firval)=each($firstpage)) {
$themecontent=str_replace("[firstpage$firkey]","",  $themecontent);
}
}

require ("./templates/$template/subtemplates.inc");
$themecontent=str_replace("[prod_of_day]","",$themecontent);
$themecontent=str_replace("[currency]","",$themecontent);
$themecontent=str_replace("[top_sales]","",$themecontent);
$themecontent=str_replace("[js_list]","",$themecontent); //js
$themecontent=str_replace("[js_listv]","",$themecontent); //js
$themecontent=str_replace("[jssales]","",$themecontent); //js
$themecontent=str_replace("[js_cartlist]","",$themecontent); //js
$themecontent=str_replace("[footer]","",$themecontent); //support message REQUIRED
$themecontent=str_replace(str_replace(".thtml", "", str_replace("themes/","", $theme_file))."_files",str_replace(".thtml", "", $theme_file)."_files",$themecontent); //list of installed themes (languege themes)
$themecontent=str_replace("[list_themes]","",$themecontent); //list of installed themes (languege themes)
$themecontent=str_replace("[old_basket]","",$themecontent); //old basket
$themecontent=str_replace("[vipskidka]","",$themecontent); //sale message for vip clients
$themecontent=str_replace("[title]","",$themecontent); //title of page
$themecontent=str_replace("[content]","",$themecontent); //main page content
$themecontent=str_replace("[register]","",$themecontent); //register user
$themecontent=str_replace("[auth]","",$themecontent);   //admin functions list
$themecontent=str_replace("[categories]","",$themecontent);  //list of goods categories
$themecontent=str_replace("[tagclouds]","",$themecontent); //tag clouds
$themecontent=str_replace("[vitrina]","",$themecontent); //vitrina
$themecontent=str_replace("[dirs_h]","",$themecontent); //horizontal catigories of goods
$themecontent=str_replace("[main_basket]","",$themecontent); //basket
$themecontent=str_replace("[topics]","",$themecontent);  //messages for users
$themecontent=str_replace("[anounses]","",$themecontent); //anounses
$themecontent=str_replace("[links]","",$themecontent);  //all site content
$themecontent=str_replace("[goodlinks]","",$themecontent);  //all site content
$themecontent=str_replace("[worktime]","",$themecontent); //working time
$themecontent=str_replace("[news]","",$themecontent); //site news
$themecontent=str_replace("[form]","",$themecontent); //start main form required first
$themecontent=str_replace("[gb]","",$themecontent); //search results
$themecontent=str_replace("[content1]","",$themecontent); //main view of goods
$themecontent=str_replace("[minibasket]","",$themecontent); //miniature shop basket
$themecontent=str_replace("[loginout]","",$themecontent); //user login form
$themecontent=str_replace("[viewed]","",$themecontent); //already viewed goods
$themecontent=str_replace("[error]","",$themecontent); //search error messages
$themecontent=str_replace("[warn]","",$themecontent); //info on all pages
$themecontent=str_replace("[x0001]","",$themecontent); //banner on first page
$themecontent=str_replace("[x0002]","",$themecontent); //banner on first page
$themecontent=str_replace("[x0003]","",$themecontent); //info on all pages
$themecontent=str_replace("[x0007]","",$themecontent); //info on all pages
$themecontent=str_replace("[search]","",$themecontent); //banner on first page
$themecontent=str_replace("[gob]","",$themecontent); //advanced search form
$themecontent=str_replace("[lastgoods]","",$themecontent); //last goods table
$themecontent=str_replace("[novelty]","",$themecontent); //last goods table
$themecontent=str_replace("[catid]","",$themecontent); //included html for goods categories
$themecontent=str_replace("[catid2]","",$themecontent); //included html for goods categories
$themecontent=str_replace("[sortmenu]","",$themecontent); //sorting goods menu
$themecontent=str_replace("[basket]","",$themecontent); //full basket interface REQUIRED
$themecontent=str_replace("[specpr]","",$themecontent); //support message REQUIRED
$themecontent=str_replace("[result_mail]","",$themecontent); //result mailing message REQUIRED
$themecontent=str_replace("[support]","",$themecontent); //support message REQUIRED
$themecontent=str_replace("[invisible]","<!-- ",$themecontent); //support message REQUIRED
$themecontent=str_replace("[/invisible]"," -->",$themecontent); //support message REQUIRED
$themecontent=str_replace("[telef]",str_replace(" ", "&nbsp;", "$telef"),$themecontent); //support message REQUIRED
$themecontent=str_replace("[top10]","",$themecontent); //Top10 of goods (due to item view count)
$themecontent=str_replace("[catlinks]","",$themecontent); //Top10 of goods (due to item view count)
$themecontent=str_replace("[flags]","",$themecontent); //Top10 of goods (due to item view count)
$themecontent=str_replace("[basketinlist]","",$themecontent); //tag clouds
$themecontent=str_replace("[brandlist]","",$themecontent); //tag clouds
$themecontent=str_replace("[shop_name]","$shop_logo",$themecontent);
$themecontent=str_replace("[shop_logo]",str_replace("<img ", "<img style=\"border: 0px;\" ",$logotype),$themecontent);
$themecontent=str_replace("[telef]","$telef",$themecontent);
$themecontent=str_replace("[telef]","",$themecontent);
$themecontent=str_replace("[kwrd]","$kwrd",$themecontent);
$themecontent=str_replace("[shop_logo]","",$themecontent);
$themecontent=str_replace("[kwrd]","",$themecontent);
$themecontent=str_replace("[rnd]",rand(0,5),$themecontent);
$themecontent=str_replace("[blog]","",$themecontent);
$themecontent=str_replace("[callback]","",$themecontent);
$themecontent=str_replace("[holidays]","",$themecontent);
if ($page!="") {
$sef=substr($page,0,1);
$sefm=Array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
while (list($sefkey,$sefval)=each($sefm)) {
if ($sefval==$sef) {
$themecontent=str_replace("$sefval"."0001.gif","$sefval"."0001b.gif",$themecontent);
} else {
$themecontent=str_replace("$sefval"."0001.gif","$sefval"."0001a.gif",$themecontent);
}
}
}
$themecontent=str_replace("[rnd]",rand(0,5),$themecontent);
$themecontent=str_replace("[txt_goods]",$lang['all_items'],$themecontent);
$themecontent=str_replace("[txt_seen]",$lang[273],$themecontent);

$themecontent=str_replace("[txt_search]",$lang['search'].":",$themecontent);
$themecontent=str_replace("[txt_about]",str_replace(" ", "&nbsp;", $lang[55]),$themecontent);
$themecontent=str_replace("[rss]","",$themecontent);
$themecontent=str_replace("[txt_chat]",str_replace(" ", "&nbsp;", $lang[1011]),$themecontent);
$themecontent=str_replace("[txt_vacancy]",str_replace(" ", "&nbsp;", $lang[1021]),$themecontent);
if ($view_partner==1) { $themecontent=str_replace("[txt_partnerprogram]",str_replace(" ", "&nbsp;", $lang[627]),$themecontent);}
$themecontent=str_replace("[txt_partnerprogram]","",$themecontent);
$themecontent=str_replace("[txt_news]",$lang[56],$themecontent);
$themecontent=str_replace("[txt_callme]",str_replace(" ", "&nbsp;", $zak_po),$themecontent);
$themecontent=str_replace("[txt_brands]",str_replace(" ", "&nbsp;", $lang[355]),$themecontent);
$themecontent=str_replace("[txt_main]",str_replace(" ", "&nbsp;", $lang['mainsite']),$themecontent);
$themecontent=str_replace("[txt_delivery]",str_replace(" ", "&nbsp;", $lang['delivery']),$themecontent);
$themecontent=str_replace("[txt_cart]",str_replace(" ", "&nbsp;", $lang[31]),$themecontent);
$themecontent=str_replace("[txt_contacts]",str_replace(" ", "&nbsp;", $lang[54]),$themecontent);
$themecontent=str_replace("[txt_checkout]",str_replace(" ", "&nbsp;", $lang[142]),$themecontent);
$themecontent=str_replace("[txt_gallery]",str_replace(" ", "&nbsp;", $lang[738]),$themecontent);
$themecontent=str_replace("[txt_langs]",$lngv,$themecontent);
$themecontent=str_replace("[txt_time]",$currentdate,$themecontent);
$themecontent=str_replace("[txt_main]","",$themecontent);
$themecontent=str_replace("[txt_checkout]","",$themecontent);
$themecontent=str_replace("[txt_delivery]","",$themecontent);
$themecontent=str_replace("[txt_cart]","",$themecontent);
$themecontent=str_replace("[txt_search]","",$themecontent);
$themecontent=str_replace("[txt_about]","",$themecontent);
$themecontent=str_replace("[txt_contacts]","",$themecontent);
$themecontent=str_replace("[txt_langs]","",$themecontent);
$themecontent=str_replace("[txt_time]","",$themecontent);
$themecontent=str_replace("[ext_search]","",$themecontent);
$themecontent=str_replace("[titul]","",$themecontent);
$themecontent=str_replace("[catbut]",$catbut,$themecontent);
$themecontent=str_replace("[catbut2]",$navibutton,$themecontent);
$themecontent=str_replace("[txt_info]",$lang[260],$themecontent);
$themecontent=str_replace("[txt_basket]",$lang[31],$themecontent);
if ($smod!="shop") {
$themecontent=str_replace("[s]","<!-- ",$themecontent);
$themecontent=str_replace("[/s]"," -->",$themecontent);
}
if ($view_forum==1) {
$themecontent=str_replace("[txt_forum]",str_replace(" ", "&nbsp;", $lang[9]),$themecontent);
}
$themecontent=str_replace("[txt_forum]","",$themecontent);
if ($view_price==1) {
$themecontent=str_replace("[txt_price]",str_replace(" ", "&nbsp;", $lang[47]),$themecontent);
}
if ($query!="") {
$themecontent=str_replace("[txt_checkout]","",$themecontent);
$themecontent=str_replace("[dirs_h]","",$themecontent);
$themecontent=str_replace("[rem1]","<!-- ",$themecontent);
$themecontent=str_replace("[rem2]"," -->",$themecontent);
}
if ($action=="gal") {
$themecontent=str_replace("[txt_checkout]","",$themecontent);
$themecontent=str_replace("[dirs_h]","",$themecontent);
$themecontent=str_replace("[rem1]","<!-- ",$themecontent);
$themecontent=str_replace("[rem2]"," -->",$themecontent);
}
if ($page=="") {
$themecontent=str_replace("[txt_checkout]",str_replace(" ", "&nbsp;", $lang[142]),$themecontent);
$themecontent=str_replace("[rem1]","",$themecontent);
$themecontent=str_replace("[rem2]","",$themecontent);
} else {
$themecontent=str_replace("[txt_checkout]","",$themecontent);
$themecontent=str_replace("[dirs_h]","",$themecontent);
$themecontent=str_replace("[rem1]","<!-- ",$themecontent);
$themecontent=str_replace("[rem2]"," -->",$themecontent);
}
$themecontent=str_replace("[speek]","$speek",$themecontent);
$themecontent=str_replace("[speek]","",$themecontent);
$themecontent=str_replace("[txt_cabinet]","<img src=\"$image_path/homepage.png\"> <a href=\"index.php?action=cabinet\">".str_replace(" ", "&nbsp;", $lang[380])."</a>",$themecontent);
$themecontent=str_replace("[txt_price]","",$themecontent);
$themecontent=str_replace("[s]","",$themecontent);
$themecontent=str_replace("[/s]","",$themecontent);
$themecontent=str_replace("[avatara]","",$themecontent);
$themecontent=str_replace("[rnd]","",$themecontent);
$themecontent=str_replace("[wtime]","",$themecontent);
$themecontent=str_replace("[nc10]",str_replace("#","","$nc10"),$themecontent);
$themecontent=str_replace("[nc0]",str_replace("#","","$nc0"),$themecontent);
$themecontent=str_replace("[nc1]",str_replace("#","","$nc1"),$themecontent);
$themecontent=str_replace("[nc2]",str_replace("#","","$nc2"),$themecontent);
$themecontent=str_replace("[nc3]",str_replace("#","","$nc3"),$themecontent);
$themecontent=str_replace("[nc4]",str_replace("#","","$nc4"),$themecontent);
$themecontent=str_replace("[nc5]",str_replace("#","","$nc5"),$themecontent);
$themecontent=str_replace("[nc6]",str_replace("#","","$nc6"),$themecontent);
$themecontent=str_replace("[nc7]",str_replace("#","","$nc7"),$themecontent);
$themecontent=str_replace("[nc8]",str_replace("#","","$nc8"),$themecontent);
$themecontent=str_replace("[nc9]",str_replace("#","", "$nc9"),$themecontent);
$themecontent=str_replace("[classifieds]","",$themecontent);
$themecontent=str_replace("[signbutton]","",$themecontent);
$themecontent=str_replace("[signform]","",$themecontent);
$themecontent=str_replace("[equal]","==",$themecontent);
$themecontent=str_replace("[catcat]","",$themecontent);
$themecontent=str_replace("[online]",$onluser,$themecontent);
$themecontent=str_replace("[lnc10]", str_replace("#", "",lighter($nc10,50)), $themecontent);

$ava_image="";
if (file_exists("./admin/userstat/".$details[1]."/".$details[1].".ava")) {
$ava_image=implode("", file("./admin/userstat/".$details[1]."/".$details[1].".ava"));
}
if ($ava_image!="") {$ava_image="gallery/avatars/$ava_image";} else {
$ava_image="$image_path/logo.png";
}
$themecontent=str_replace("[avatar]","$ava_image",$themecontent);
if (file_exists("./zakazisave/users/".$details[1]."/ring/".date("d",time())."-".date("m",time())."-".date("Y",time()).".txt")){
$themecontent=str_replace("ring.png","ring.gif",$themecontent);
$themecontent=str_replace("[ringhref1]","<a href=index.php?action=viewring&order=".date("d",time())."-".date("m",time())."-".date("Y",time()).">",$themecontent);
$themecontent=str_replace("[ringhref2]","</a>",$themecontent);
$themecontent=str_replace("[ringtit]","Есть запланированные события!",$themecontent);
} else {
$themecontent=str_replace("[ringhref1]","",$themecontent);
$themecontent=str_replace("[ringhref2]","",$themecontent);
$themecontent=str_replace("[ringtit]","Напомнит о запланированных событиях",$themecontent);
}

if (file_exists("$base_loc/wiki/c.car")==TRUE) {
$fp = fopen ("$base_loc/wiki/c.car" , "r");
if ($jstart>32) {$jstart=32;}
$wikislide=str_replace("<div onMouseOver","<div class=shadow onMouseOver",str_replace("</a>", "</a><br><img src=pix.gifwidth=100 height=5><br>", str_replace("border: 1px", "border: 0px", str_replace("[jstart]", ($jstart-1),str_replace (" NEW", " <b><font color=#b94a48>NEW</font></b>", str_replace("border-bottom: #b94a48 1px dashed;", "", @fread($fp, @filesize("$base_loc/wiki/c.car"))))))));
fclose($fp);
$themecontent=str_replace("[content_slide]", "<br>". str_replace("-moz-border-radius: 10px; ","",  $wikislide), $themecontent);
}
//$themecontent=str_replace("[reclame]","$reclame",$themecontent);
$themecontent=str_replace("[username]",$details[3],$themecontent);
if ($mod_rw_enable==1) {
$tems=str_replace(".thtml", "", $theme_file);

$themecontent=str_replace($tems, "../../$tems",$themecontent);
$themecontent=str_replace("images/", "../../images/",$themecontent);
$themecontent=str_replace("$fotobasesmall", "../../$fotobasesmall",$themecontent);
$themecontent=str_replace("$fotobasebig", "../../$fotobasebig",$themecontent);
$themecontent=str_replace("grad.php", "../../grad.php",$themecontent);
$themecontent=str_replace("ok.php", "../../ok.php",$themecontent);
$themecontent=str_replace("src=logo", "src=../../logo.png",$themecontent);
$themecontent=str_replace("src=logo.gif", "src=../../logo.gif",$themecontent);
$themecontent=str_replace("src=logo.jpg", "src=../../logo.jpg",$themecontent);
}
$themecontent=str_replace("[firstpage]","",$themecontent); //miniature shop basket
$themecontent=str_replace("[/firstpage]","",$themecontent); //miniature shop basket
$themecontent=str_replace("[widgets]","",$themecontent); //miniature shop basket

$themecontent=str_replace("[map]","",$themecontent);
echo $themecontent;

}
?>
