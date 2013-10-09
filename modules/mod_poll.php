<?php
$id=0;
$adm_poll="";
$pollbut="";
//echo @$_SERVER['REMOTE_ADDR']."!=".@$_SERVER['SERVER_ADDR'];
$inmname=$details[1];
if ($details[1]=="") {$inmname="guest";}
//poll module
//Copyright (c)2011-2012, Eurowebcart.com
$polls="";
$ptype=0;
$pfir="[poll]";
$polls=ExtractString($con,"[poll]","[/poll]");
if ($polls!="") {$ptype=1; $pfir="[poll]";}
if ($ptype!=1) {
$polls=ExtractString($con,"[poll type=","[/poll]");
if ($polls!="") {$ptype=doubleval(substr($polls,0,1)); }
$polls=substr($polls,2,strlen($polls));
$pfir="[poll type=".$ptype."]";
}
if ($polls!="") {
if (preg_match("/<br>/i",$polls)) { $poll_exp="<br>"; }
if (preg_match("/<\/div>/i",$polls)) { $poll_exp="</div>"; }
if ($poll_exp!="\n") {$polls_t=str_replace("$poll_exp","\n",$polls);} else {$polls_t=$polls; }
//echo $polls;
if ($polls_t!="") {
$polls_t=strip_tags($polls_t);
$poll_m=explode("\n", $polls_t);

$poll_name="";
$poll="";
$polln=0;
$pollkk=0;
$total_r=0;
$poll_r=Array();
$fancyb="";
$vote_vars=0;
$polltosave="";
while (list($pollk,$pollv)=each($poll_m)) {
$pollv=trim($pollv);

if (($pollv!="")&&($pollv!="\n")) {
//echo "$pollk=".$pollv."<br>";
if ($poll_name=="") {
$poll_name=$pollv;
$polln=$pollk;
if(is_dir("./poll")!=true) { mkdir("./poll",0755); }
$polldir=substr(md5($poll_name),0,3);
if(is_dir("./poll/".$polldir)!=true) { mkdir("./poll/".$polldir,0755); }
if(is_dir("./poll/".$polldir."/".md5($poll_name))!=true) { mkdir("./poll/".$polldir."/".md5($poll_name),0755); }
$poll_f="./poll/".$polldir."/".md5($poll_name).".txt";
$pollcl="";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$adm_poll="<br><a id=polladm_".md5($poll_name)." href=$htpath/admin/polladm.php?poll=".md5($poll_name)."&dir=$polldir&action=close&speek=".$speek."><button title=\"$lang[990]\" type=button class=btn>$lang[990]</button></a>  <a href=$htpath/index.php?nt=poll/$polldir&t=".md5($poll_name)."&action=template&speek=".$speek."><button title=\"$lang[980]\" type=button class=btn><font color=#b94a48>".$lang['edits']."</font></button></a>";
$adm_poll.="<script type=\"text/javascript\">
        $(document).ready(function() {
$(\"#polladm_".md5($poll_name)."\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false,
  'onClosed': function() {
    parent.location.reload(true);
  }
});
        });
    </script><br><br>";
}
}
if (file_exists("./poll/".$polldir."/".md5($poll_name)."/closed.txt")) {
$pollcl= "<br>$lang[977]: ".date("d/m/Y H:i:s");
if(($details[7]=="ADMIN")||($details[7]=="MODER")){
if (($valid=="1")){
$adm_poll="<br><a id=polladm_".md5($poll_name)." href=$htpath/admin/polladm.php?poll=".md5($poll_name)."&dir=$polldir&action=open&speek=".$speek."><button title=\"$lang[991]\" type=button class=btn>$lang[991]</button></a> <a href=$htpath/index.php?nt=poll/$polldir&t=".md5($poll_name)."&action=template&speek=".$speek."><button title=\"$lang[980]\" type=button class=btn><font color=#b94a48>".$lang['edits']."</font></button></a>";
$adm_poll.="<script type=\"text/javascript\">
        $(document).ready(function() {
$(\"#polladm_".md5($poll_name)."\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false,
  'onClosed': function() {
    parent.location.reload(true);
  }
});
        });
    </script><br><br>";
}
}
}
//echo "\"'".$details[1]."' '".$inmname."'\"<br>";
//echo "\"".$_COOKIE[$details[1]."".md5($poll_name)]."\"<br>";
//echo "\"".$_SESSION[md5($poll_name)."".$inmname]."\"<br>";
//if ((@$_COOKIE[$inmname."".md5($poll_name)]==md5(substr($artrnd.$secret_salt, 0, 128)))||($_SESSION[md5($poll_name)."".$inmname]==1)) {
if (@$_COOKIE[$inmname."".md5($poll_name)]==md5(substr($artrnd.$secret_salt, 0, 128))) {
$pollcl= "<br>$lang[976]";
}
if ($poll_ip_enable==1) {

if (file_exists("./poll/".$polldir."/".md5($poll_name)."/".@$_SERVER['REMOTE_ADDR'].".txt")) {
if (($poll_ip_hours*3600)>(time()-filemtime("./poll/".$polldir."/".md5($poll_name)."/".@$_SERVER['REMOTE_ADDR'].".txt"))) {
$pollcl= "<br>$lang[976] IP ".$lang['exists'].".";
}
}
}
if (file_exists($poll_f)==true){
$poll_r=file($poll_f);
$max_poll=0;
while (list($pollrk,$pollrv)=each($poll_r)) {
$poll_v=doubleval(trim($pollrv));
if ($poll_v>$max_poll){$max_poll=$poll_v;}
$total_r+=doubleval(trim($pollrv));

}
}
} else {
$polltosave.="0"."\n";
}
if ($polln!=$pollk) {
$pollr="";
if ((@$poll_r[$pollkk])&&(@$poll_r[$pollkk]!="")) {
$poll_proc=round((100*doubleval($poll_r[$pollkk]))/($max_poll+0.0001));
$poll_prec=round((1000*doubleval($poll_r[$pollkk]))/($total_r+0.0001))/10;
$cstyle="";
if ($poll_prec<100) { $cstyle=" progress-striped"; }
if ($poll_prec<75) { $cstyle=" progress-success progress-striped"; }
if ($poll_prec<50) { $cstyle=" progress-warning progress-striped"; }
if ($poll_prec<25) { $cstyle=" progress-danger progress-striped"; }
if ($ptype==1) {


if ($pollcl=="") {$pollbut="<td><a id=poll_".md5($poll_name)."_".$pollkk." href=poll.php?poll=".md5($poll_name)."&vote=".$pollkk."&ssid=".session_id()."&user=".$inmname."&speek=".$speek."><button title=\"$lang[974]\" type=button class=btn><img src=$image_path/voting.png></button></a></td>";}
$pollr="<tr>$pollbut<td valign=middle width=100%><div class=\"progress".$cstyle."\"><div class=bar style=\"width:".$poll_prec."%;\"></div></div><div class=clearfix></div></td><td><small>".doubleval(@$poll_r[$pollkk])."</small></td><td><small>/</small></td><td><nobr><small><b>".$poll_prec."</b>%</small></td></tr>\n";
if ($pollcl=="") {
$fancyb.="
$(\"#poll_".md5($poll_name)."_$pollkk"."\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false,
  'onClosed': function() {
    parent.location.reload(true);
  }
});
            ";}
}

if ($ptype==2) {
if ($pollcl=="") {
$id++;
$pollr="<td colspan=4><input type=radio name=vote value=$pollkk id=pollid_$id><label for=pollid_$id>".($pollkk+1).". $pollv</label></td>";
} else {
$pollr="<td colspan=4 align=left>".($pollkk+1).". $pollv</td></tr><tr><td valign=middle width=100%><div class=\"progress".$cstyle."\"><div class=bar style=\"width:".$poll_prec."%;\"></div></div><div class=clearfix></div></td><td><small>".doubleval(@$poll_r[$pollkk])."</small></td><td><small>/</small></td><td><nobr><small><b>".$poll_prec."</b>%</small></td></tr>\n";

            }
}

if ($ptype==3) {
if ($pollcl=="") {
$pollr="<td><table class=table2 cellspacing=0 cellpadding=0 border=0><tr><td width=20 align=left>".($pollkk+1).".</td><td><a id=poll_".md5($poll_name)."_".$pollkk." href=poll.php?poll=".md5($poll_name)."&vote=".$pollkk."&ssid=".session_id()."&user=".$inmname."><b><font color=$nc3 title=\"$lang[974]\">$pollv</font></b></a></td></tr></table></td>";
$fancyb.="
$(\"#poll_".md5($poll_name)."_$pollkk"."\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false,
  'onClosed': function() {
    parent.location.reload(true);
  }
});
            ";

} else {
$pollr="<td colspan=4 align=left>".($pollkk+1).". $pollv</td></tr><tr><td valign=middle width=100%><div class=\"progress".$cstyle."\"><div class=bar style=\"width:".$poll_prec."%;\"></div></div><div class=clearfix></div></td><td><small>".doubleval(@$poll_r[$pollkk])."</small></td><td><small>/</small></td><td><nobr><small><b>".$poll_prec."</b>%</small></td></tr>\n";

}
}
if ($ptype==4) {
if ($pollcl=="") {
$pollr="<td><table class=table2 cellspacing=0 cellpadding=0 border=0><tr><td><a id=poll_".md5($poll_name)."_".$pollkk." href=poll.php?poll=".md5($poll_name)."&vote=".$pollkk."&ssid=".session_id()."&user=".$inmname."><button type=button class=btn title=\"$lang[974]\">".($pollkk+1).". <b>$pollv</b></button></a></td></tr></table></td>";
$fancyb.="
$(\"#poll_".md5($poll_name)."_$pollkk"."\").fancybox({
        'onComplete'	:	function() {\$(\"#fancybox-wrap\").unbind('mousewheel.fb');} ,
                'hideOnOverlayClick' : true,
        'hideOnContentClick' : true,
        'transitionIn'	:	'none',
        'transitionOut'	:	'none',
        'scrolling'		:	'no',
        'padding'		:	50,
	    'titleShow'		:	false,
        'overlayShow'	:	false,
  'onClosed': function() {
    parent.location.reload(true);
  }
});
            ";

} else {
$pollr="<td colspan=4 align=left>".($pollkk+1).". $pollv</td><tr><tr><td valign=middle width=100%><div class=\"progress".$cstyle."\"><div class=bar style=\"width:".$poll_prec."%;\"></div></div><div class=clearfix></div></td><td><small>".doubleval(@$poll_r[$pollkk])."</small></td><td><small>/</small></td><td><nobr><small><b>".$poll_prec."</b>%</small></td></tr>\n";

}
}
}
if ($ptype==1) {
$poll.="<tr><td colspan=4 align=left>".($pollkk+1).". $pollv</td></tr>".$pollr."\n";
}
if (($ptype==2)||($ptype==3)||($ptype==4)) {
$poll.="<tr>$pollr</tr>\n";
}
$pollkk+=1;
}
}

}
if ($pollcl=="") {

if ($ptype==1) {$fancyb="<script type=\"text/javascript\">
        $(document).ready(function() {
            $fancyb

        });
    </script>";  }

    if ($ptype==2) {

// parent.location.reload(true);

$fancyb.="<script type=\"text/javascript\">
        $(document).ready(function() {


         $(\"#login_form_".md5($poll_name)."\").bind(\"submit\", function() {
    $.ajax({
        type        : \"POST\",
        cache       : false,
        url         : \"/poll.php\",
        data        : $(this).serializeArray(),
        success: function(data) {

            $.fancybox(data);
            ";


$fancyb.=" parent.location.reload(true); ";
$fancyb.="
        }
    });
    return false;
});


 });
    </script>
    ";
$poll="<form class=form-inline action=poll.php method=POST id=\"login_form_".md5($poll_name)."\"><input type=hidden name=speek value=\"$speek\"><input type=hidden name=reload value=\"yes\"><input type=hidden name=poll value=\"".md5($poll_name)."\"><input type=hidden name=poll value=\"".md5($poll_name)."\"><input type=hidden name=ssid value=\"".session_id()."\"><input type=hidden name=user value=\"".$inmname."\">$poll<tr><td><input id=\"login_but_".md5($poll_name)."\" type=submit value=\"".$lang[975]."\"></td></tr></form>\n";
}


if (($ptype==3)||($ptype==4)) {$fancyb="<script type=\"text/javascript\">
        $(document).ready(function() {
            $fancyb

        });
    </script>";  }


    }
$poll="<br><!-- ".session_id()." ".md5($poll_name)."-->$fancyb<table class=table2 cellspacing=0 cellpadding=0 border=0 style=\"float: left; width:70%;\"><tr><td colspan=4><font size=3><b>$poll_name</b></font><br></td></tr>\n$poll<tr><td colspan=4>".$lang[970].": <b>$total_r</b></td></tr></table><div style=\"clear:both;\"></div>$adm_poll$pollcl<br>";

$con=str_replace("$pfir".$polls."[/poll]","$poll", $con);

if ($poll_name!="") {
//echo "poll_name=".$poll_name."<br>";
$polldir=substr(md5($poll_name),0,3);
if ((file_exists("./poll/".$polldir."/".md5($poll_name).".txt")==false)&&($polltosave!="")){
$fp=fopen("./poll/".$polldir."/".md5($poll_name).".txt","w");
fputs($fp,"$polltosave");
fclose($fp);
}
}

}
}

?>
