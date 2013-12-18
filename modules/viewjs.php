<?php
$jslistadm="";
$jslist="";
if (($smod=="shop")&&($cartloaded==0)&&($mod!="admin")) {

if ($catidcur=="0") {$jscatid="";} else {$jscatid=$catidcur;}
if ($catidcur=="") {$jscatid="";}
if ($indcur=="") {$indcur="jscur"; $curjs=$_SESSION["$indcur"];}
//echo "catid=\"$catid\" unifid=\"$unifid\"";


$jslist="<div class=\"mousewheel_example\" id=\"mousewheel_example_1\"><b id=\"jsphp".$jscatid."\"></b>
<script language=\"JavaScript\">
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta=".$curjs."&catid=".$jscatid."&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
 </script>
<input type=hidden id=\"jsmax\" name=\"js_max\" value=\"".$curjs."\" />
<input type=hidden id=\"jscatid\" name=\"js_catid\" value=\"".$jscatid."\" />
<script language=\"JavaScript\">
function nextfr".$jscatid."() {
var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr".$jscatid."() {
var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}

jQuery(function($) {
    $('div.mousewheel_example')
        .bind('mousewheel', function(event, delta) {
            var dir = delta > 0 ? 'Up' : 'Down',
                vel = Math.abs(delta);
                if (dir=='Up') {
                var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}

                }

                if (dir=='Down') {
                var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
if ((document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextc.png')&&(document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextcv.png')) {
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}

                }
//            $(this).text(dir + ' at a velocity of ' + vel);
            return false;
        });
});
 </script></div>";
if ($view_js==0){
if ($view_js_onfirstpage==0) {
$jslist="";
} else {
if (($unifid=="")&&("$catid"=="0")) {
}else {
$jslist="";
}
}
} else {
if ($view_js_onfirstpage==0) {
if (($unifid=="")&&("$catid"=="0")) {
$jslist="";
}
}
}
if ($usetheme==1) {
$jslistv="<div class=\"mousewheel_example\" id=\"mousewheel_example_1\"><b id=\"jsphp".$jscatid."\"></b>
<script language=\"JavaScript\">
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta=".$curjs."&catid=".$jscatid."&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
</script>
<input type=hidden id=\"jsmax\" name=\"js_max\" value=\"".$curjs."\" />
<input type=hidden id=\"jscatid\" name=\"js_catid\" value=\"".$jscatid."\" />
<script language=javascript>
function nextfr".$jscatid."() {
var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr".$jscatid."() {
var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}

jQuery(function($) {
    $('div.mousewheel_example')
        .bind('mousewheel', function(event, delta) {
            var dir = delta > 0 ? 'Up' : 'Down',
                vel = Math.abs(delta);
                if (dir=='Up') {
                var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
if (Math.round(j.value)>=1) {
j.value=(Math.round(j.value)-1);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}

                }

                if (dir=='Down') {
                var j=document.getElementById('jsmax');
var s=document.getElementById('jscatid');
if ((document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextc.png')&&(document.getElementById('nextb').src!='".$htpath."/".$image_path."/nonextcv.png')) {
j.value=(1+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/".$scriptprefix."js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}

                }
//            $(this).text(dir + ' at a velocity of ' + vel);
            return false;
        });
});
</script></div>";
}
if (($r!="")&&($sub=="")) {$jslist="";}
if (($unifid=="")&&("$catid"=="0")) {  if ($view_js_onfirstpage==0) {$jslist="";  }
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $oldval="view_js_onfirstpage";$strnum=111; $oldvalue=$$oldval;
if ($$oldval==0) {
$jslist.="<div align=center><font color=#b94a48>".$lang[259]." ".$lang[894]."</font></div>";
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}
$jslist.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center><b>$lang[259]</b>
$modonoff
<br><br>".$lang[888]."</div>"; endif;
}
//if (("$catid"=="0")&&($unifid=="")) {$jslist.="<div align=right>$carat <a href=\"$htpath/index.php?action=allinone\">".$lang[201]."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>";}
}
top("",  "$jslist", $style ['center_width'], $nc0, $nc0, 4,0,"[js_list]");
if ($usetheme==1) {
top("",  "$jslistv", $style ['center_width'], $nc0, $nc0, 4,0,"[js_listv]");
}
}

if (($unifid=="")&&("$catid"=="0")) { } else { if (($r!="")&&($sub=="")) { } else {
if ($interface==1) {
if (($valid=="1")&&($details[7]=="ADMIN")): $jlistadm=""; $oldval="view_js";$strnum=109; $oldvalue=$$oldval;
if ($$oldval==0) {
$jslistadm="<div align=center><font color=#b94a48>".$lang[410].": ".$lang[894]."</font></div>";
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=1"."' value=\"".$lang[890]."\">";
} else {
$modonoff="<input type=button onclick=javascript:location.href='"."index.php?action=vars&mod=admin&chok=ok&en[$strnum]=$oldval&nk[$strnum]=NO&evo[$strnum]=$oldvalue&ev[$strnum]=0"."' value=\"".$lang[889]."\">";
}
$jslistadm.="<div align=center><img src=\"$image_path/handup.png\"></div><div class=round align=center><b>$lang[410]:</b>
$modonoff
<br><br>".$lang[888]."</div>";
topwo("",  "$jslistadm", $style ['center_width'], lighter($nc0,0), lighter($nc0,0), 4,0,"[js_list]");
endif;
}
}
}
?>
