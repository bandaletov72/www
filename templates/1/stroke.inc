<?php
###### STROKE INFO (maybe for kurs, date) #######
$rmon = array ($lang[115],$lang[116],$lang[117],$lang[118],$lang[119],$lang[120],$lang[121],$lang[122],$lang[123],$lang[124],$lang[125],$lang[126]);
$ts=time();

echo "<table border=\"0\" cellspacing=\"0\" cellpadding=\"2\" width=\"100%\"><tr>

<td align=\"center\" valign=\"top\">&nbsp;&nbsp;<small>".date("d",$ts).' '.$rmon[date("m",$ts)-1].' '.date("Y",$ts).', '. date("H:i:s",$ts)."</small>  </td></tr></table>";
//echo "<table border=0 cellpadding=0 cellspacing=0 width=100%><tr><td><img src=\"".$image_path."/pix.gif\" border=\"0\" height=\"".$pix_blocks."\" width=\"10\"></td><td width=100%><img src=\"".$image_path."/shadow.gif\" border=\"0\" height=\"".$pix_blocks."\" width=\"100%\"></td></tr></table>";
?>