<?php
$jslist="";
$jscatid="sales";
if (isset($_SESSION["$jscatid"])) {$curjs=$_SESSION["$jscatid"];} else {$curjs=0;}
$jslist= "<b id=\"jsphp".$jscatid."\"><br><img src=$image_path/ind.gif border=0><br>".$curjs."-".($curjs+$js_max)."</b>
<script>
scriptNode = document.createElement('script');
scriptNode.src = '$htpath/sales.php?sta=".$curjs."&catid=".$jscatid."&unifid=1';
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
scriptNode.src = '$htpath/sales.php?sta='+j.value+'&catid='+s.value+'&unifid=1';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
function prevfr".$jscatid."() {
var j=document.getElementById('jsmax".$jscatid."');
var s=document.getElementById('jscatid".$jscatid."');
if (Math.round(j.value)>=$js_max) {
j.value=(Math.round(j.value)-$js_max);

scriptNode = document.createElement('script');
scriptNode.src = '$htpath/sales.php?sta='+j.value+'&catid='+s.value+'&unifid=1';
scriptNode.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(scriptNode);
}
}
</script>";




?>