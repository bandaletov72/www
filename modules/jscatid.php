<?php
$jslist="";
$jslistv="";
reset($podstava);
$qwe=0;
while (list ($key_js, $jscatid) = each ($podstava)) {
if (isset($_SESSION["$jscatid"])) {$curjs=$_SESSION["$jscatid"];} else {$curjs=0;}
if ((substr($jscatid,-1)=="_")&&($key_js!="||")) {
$tmpkeyjs=explode ("|", $key_js);
if (doubleval($podstavan["".$tmpkeyjs[0]."||"])==0) {$tmpi=99;} else {$tmpi=doubleval($podstavan["".$tmpkeyjs[0]."||"]);}
if (doubleval($podstavan[$key_js])==0) {$tmpi2=99;} else {$tmpi1=doubleval($podstavan[$key_js]);}

$tmpindex=100000*$tmpi+100*$tmpi2+$qwe;
$tmpjslist[$tmpindex]= "$carat <a href=\"$htpath/index.php?catid=$jscatid\">".$tmpkeyjs[0]." / ".$tmpkeyjs[1]."</a><br><br>
<b id=\"jsphp".$jscatid."\"><br><img src=$image_path/ind.gif border=0><br>".$curjs."-".($curjs+$js_max)."</b>
<script>
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&sta=".$curjs."&catid=".$jscatid."&unifid=1&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
</script>
<input type=hidden id=\"jsmax".$jscatid."\" name=\"js_max".$jscatid."\" value=\"".$curjs."\" />
<input type=hidden id=\"jscatid".$jscatid."\" name=\"js_catid".$jscatid."\" value=\"".$jscatid."\" />
<script language=javascript>
function nextfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
j.value=($js_max+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&unifid=1&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if (Math.round(j.value)>=$js_max) {
j.value=(Math.round(j.value)-$js_max);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&sta='+j.value+'&catid='+s.value+'&unifid=1&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}
</script><br><br>";

$tmpjslistv[$tmpindex]= "$carat <a href=\"$htpath/index.php?catid=$jscatid\">".$tmpkeyjs[0]." / ".$tmpkeyjs[1]."</a><br><br>
<b id=\"jsphp".$jscatid."\"><br><img src=$image_path/ind.gif border=0><br>".$curjs."-".($curjs+$js_max)."</b>
<script>
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&type=v&sta=".$curjs."&catid=".$jscatid."&unifid=1&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
</script>
<input type=hidden id=\"jsmax".$jscatid."\" name=\"js_max".$jscatid."\" value=\"".$curjs."\" />
<input type=hidden id=\"jscatid".$jscatid."\" name=\"js_catid".$jscatid."\" value=\"".$jscatid."\" />
<script language=javascript>
function nextfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
j.value=($js_max+Math.round(j.value));
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&unifid=1&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if (Math.round(j.value)>=$js_max) {
j.value=(Math.round(j.value)-$js_max);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/js.php?session=$sid&type=v&sta='+j.value+'&catid='+s.value+'&unifid=1&speek=$speek';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}
</script><br><br>";
$qwe+=1;
}
}
ksort($tmpjslist);
reset($tmpjslist);
ksort($tmpjslistv);
reset($tmpjslistv);
while (list ($key_js, $jscatid) = each ($tmpjslist)) {
$jslist.="$jscatid"."\n";
$jslistv.=$tmpjslistv[$key_js]."\n";
}
?>