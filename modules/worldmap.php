<?php
$toch=Array();
$show_bigger_map=1;
$statuses=Array();
$statusfile="./templates/$template/$speek/status.inc";
$usestatus=0;
$lemap="";
if (file_exists($statusfile)) {
$ims = @getimagesize("./images/map.png");
$ims2 = @getimagesize("./images/map2.png");
$ims3 = @getimagesize("./images/ping.png");
$x2=$ims2[0]; $y2=$ims2[1];
$x=$ims[0]; $y=$ims[1];
$x3=$ims3[0]; $y3=$ims3[1];

$usestatus=1;
$statuses=file($statusfile);

//echo $statuses[0].$statuses[1].$statuses[2];
$i20=20;
$i21=21;
$ncc=0;
$cc=file("./templates/$template/$speek/custom_cart.inc");

$dateformat=str_replace("y", "Y", str_replace("dd", "d",str_replace("mm", "m",str_replace("yy", "y", str_replace("yy", "y", $ewc_dateformat)))));

while(list($kc,$kv)=each($cc)) {
$out=explode("|", $kv);
if ($out[3]=="location") {
$ncc=17+$kc;

}

}

$tmp=file($base_file);
$map1=""; $map2=""; $map3="";
$area1=""; $area2=""; $area3=""; $area21="";$area22="";$area23="";
$tarea1=Array(); $tarea2=Array(); $tarea3=Array(); $tarea21=Array(); $tarea22=Array(); $tarea23=Array();
$pin1=""; $pin2=""; $pin3=""; $pin21="";$pin22="";$pin23="";
unset($kc,$kv,$out,$out2);
$jo=0;
while(list($key,$val)=each($tmp)) {
if (trim($val)!="") {
$o=explode("|", $val);
if ($o[1]==$lang[418]){ continue;}
$unfdm=md5(@$o[3]." ID:".@$o[6]);
$curstatus="";
if ($usestatus==1) {
$statusfile="$base_loc/status/".substr($unfdm,0,2)."/".$unfdm."/status.txt";

if (file_exists($statusfile)) {
$sp=file($statusfile);
$curstatus=trim($sp[0]);
}
}
unset($shirota,$dolgota,$dp,$day,$month,$year);
$shd=0;
if ($ncc!=0) {
if (trim($o[$ncc])!="") {$shd=1; }
$tt=explode("<br>", $o[$ncc]);
while(list($kc,$kv)=each($tt)) {
if (trim ($kv)!="") {
$out2=explode(";",$kv);
list($day,$month,$year) = explode(substr($dateformat,1,1),$out2[0]);
$unixtime=mktime(0, 0, 1, (int)$month, (int)$day, (int)$year);
$shirota[$unixtime]=(int)trim($out2[1]);
$dolgota[$unixtime]=(int)trim($out2[2]);
}
}
if ($shd==0) {
$shirota[(time()-1)]=-1;
$dolgota[(time()-1)]=-1;
$shirota[(time()+86400)]=1;
$dolgota[(time()+86400)]=1;
}
@ksort ($shirota);
$sh=-1000;
$do=-1000;
$ls=-1000;
$ld=-1000;
$dp="";
unset($kc,$kv,$tt);
$ttime=time();
//echo $o[3]."<br>";
while(list($kc,$kv)=@each($shirota)) {
//echo "$ttime>$kc ? $shirota[$kc] $dolgota[$kc]<br>";
if ($ttime>$kc) {
$o[$i20]=$kv;
$o[$i21]=$dolgota[$kc];
}
$ls=$kv;
$ld=$dolgota[$kc];
$dp=date($dateformat,$kc);
$ut=$kc;
}
}
if ($dp!="") {
$uut="";
if ($ttime>$ut) {$uut="<b><font color=green>Груз прибыл в порт прибытия (".@$o[39].")</font></b>";} else { $uut="<b>Груз в пути (порт прибытия: ".@$o[39].")</b><br>";}
$dp="Ориентировочная дата прибытия: $dp"."<br>$uut<br>";
}
$lid=md5(@$o[3]." ID:".@$o[6]);
$prprpr="";
$indx=$o[$i20]."_".$o[$i21];
$sdvig=10; //pixels
if (!isset($toch[$indx])) { $toch[$indx]=0; } else { $toch[$indx]+=1;  }
$sdv=$sdvig*$toch[$indx];

if (($curstatus=="")||($curstatus==trim($statuses[0]))) {if (doubleval($o[4])!=0) { $prprpr="<br>"."<span class='label label-success'>".number_format($o[4], 0, ',', ' ')." ".substr($o[12],1)."</span>"; } }
$bst="<b>$curstatus</b><br>$o[3]<br><b>".str_replace("\"", "'",@$o[34])."</b><br>".wordwrap(str_replace("\"", "'",$o[7]), 20, "<br />\n")."$prprpr";
$xcoord=$x/2+$o[$i21]*$x/360-20-$x3/2;
$ycoord=$y/2-$o[$i20]*$y/180-$y3-$sdv;

$xcoord2=$x2/2+$o[$i21]*$x2/360-20*4-$x3/2;
$ycoord2=$y2/2-$o[$i20]*$y2/180-3-$y3-$sdv;
$dpl="right";
if ($o[$i21]>90) { $dpl="left"; }
if ($o[$i20]>50) { $dpl="bottom"; }
if ($o[$i20]<-50) { $dpl="top"; }
if ($curstatus==trim($statuses[2])) {
//проданные
if (trim($o[$i20])!="") {
$tarea1[$jo]="<!-- ".$o[$i21]." --><span style=\"text-align:left; margin:0;position: absolute; left:".$xcoord."px; top:".$ycoord."px;\" class=nowrap><a href=\"index.php?unifid=$lid\"><img style=\"cursor: pointer; cursor: hand; \" src=images/pinrr.png border=0 rel=\"tooltip\" data-placement=\"".$dpl."\" data-original-title=\"".$bst."\" onmouseover=\"this.src='images/pinr.png';ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"this.src='images/pinrr.png';RestorePath();\" align=left></a> ".strtoken($o[3],"/")."</span>";
$tarea21[$jo]="<!-- ".$o[$i21]." --><span style=\"text-align:left; margin:0;position: absolute; left:".$xcoord2."px; top:".$ycoord2."px;\" class=nowrap><a href=\"index.php?unifid=$lid\"><img style=\"cursor: pointer; cursor: hand; \" src=images/pinrr.png border=0 rel=\"tooltip\" data-placement=\"".$dpl."\" data-original-title=\"".$bst."\" onmouseover=\"this.src='images/pinr.png';ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"this.src='images/pinrr.png';RestorePath();\" align=left></a> ".strtoken($o[3],"/")."</span>";
/*
if ($o[$i21]<165) {
$area3.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25-$sdv).", ".round($x+$x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
$area23.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x2+$x2/2+$o[$i21]*$x2/360-7-5-15).", ".round($y2/2-$o[$i20]*$y2/180-$h2+2-25-$sdv).", ".round($x2+$x2/2+$o[$i21]*$x2/360-7+10-21).", ".round($y2/2-$o[$i20]*$y2/180-$h2-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";

}
if ($o[$i21]>165) {
$area3.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h+2-25-$sdv).", ".round($x/2+$o[$i21]*$x/360-7+20-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
$area23.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x2/2+$o[$i21]*$x2/360-7-5-15-$x2).", ".round($y2/2-$o[$i20]*$y2/180-$h2+2-25-$sdv).", ".round($x2/2+$o[$i21]*$x2/360-7+10-21-$x2).", ".round($y2/2-$o[$i20]*$y2/180-$h2-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
}
*/
$map3.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1 onmouseover=\"ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"RestorePath();\"><img src=$image_path/pinrr.png border=0> <b>$o[3] / ".str_replace("\"", "'",@$o[34])."</b></a><br>$curstatus<br><small>$o[7]<br>$dp<br></small></div>";
$jo++;
}
}

if ($curstatus==trim($statuses[1])) {
//в резерве
if (trim($o[$i20])!="") {

$tarea1[$jo]="<!-- ".$o[$i21]." --><span style=\"text-align:left; margin:0; position: absolute; left:".$xcoord."px; top:".$ycoord."px;\" class=nowrap><a href=\"index.php?unifid=$lid\"><img style=\"cursor: pointer; cursor: hand; \" src=images/pinoo.png border=0 rel=\"tooltip\" data-placement=\"".$dpl."\" data-original-title=\"".$bst."\" onmouseover=\"this.src='images/pino.png';ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"this.src='images/pinoo.png';RestorePath();\" align=left></a> ".strtoken($o[3],"/")."</span>";
$tarea21[$jo]="<!-- ".$o[$i21]." --><span style=\"text-align:left; margin:0; position: absolute; left:".$xcoord2."px; top:".$ycoord2."px;\" class=nowrap><a href=\"index.php?unifid=$lid\"><img style=\"cursor: pointer; cursor: hand; \" src=images/pinoo.png border=0 rel=\"tooltip\" data-placement=\"".$dpl."\" data-original-title=\"".$bst."\" onmouseover=\"this.src='images/pino.png';ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"this.src='images/pinoo.png';RestorePath();\" align=left></a> ".strtoken($o[3],"/")."</span>";
/*
if ($o[$i21]<165) { 
$area2.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[$i21]*$x/360-7-5-15).", ".round($y/2-$o[$i20]*$y/180-$h+2-25-$sdv).", ".round($x+$x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
$area22.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x2+$x2/2+$o[$i21]*$x2/360-7-5-21).", ".round($y2/2-$o[$i20]*$y2/180-$h2+2-25-$sdv).", ".round($x2+$x2/2+$o[$i21]*$x2/360-7+10-21).", ".round($y2/2-$o[$i20]*$y2/180-$h2-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";

}
if ($o[$i21]>165) { 
$area2.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h+2-25-$sdv).", ".round($x/2+$o[$i21]*$x/360-7+20-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
$area22.="<!-- ".$o[$i21]." --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x2/2+$o[$i21]*$x2/360-7-5-15-$x2).", ".round($y2/2-$o[$i20]*$y2/180-$h2+2-25-$sdv).", ".round($x2/2+$o[$i21]*$x2/360-7+10-21-$x2).", ".round($y2/2-$o[$i20]*$y2/180-$h2-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
}
*/
$map2.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1 onmouseover=\"ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"RestorePath();\"><img src=$image_path/pinoo.png border=0> <b>$o[3] / ".str_replace("\"", "'",@$o[34])."</b></a><br>$curstatus<br><small>$o[7]<br>$dp<br></small></div>";
$jo++;
}
}
if (($curstatus==trim($statuses[0]))||($curstatus=="")) {
//в продаже
if (trim($o[$i20])!="") {

$tarea1[$jo]="<!-- ".$o[$i21]." --><span style=\"text-align:left; margin:0; position: absolute; left:".$xcoord."px; top:".$ycoord."px;\" class=nowrap><a href=\"index.php?unifid=$lid\"><img style=\"cursor: pointer; cursor: hand; \" src=images/pingg.png border=0 rel=\"tooltip\" data-placement=\"".$dpl."\" data-original-title=\"".$bst."\" onmouseover=\"this.src='images/ping.png';ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"this.src='images/pingg.png';RestorePath();\" align=left></a> ".strtoken($o[3],"/")."</span>";
$tarea21[$jo]="<!-- ".$o[$i21]." --><span style=\"text-align:left; margin:0; position: absolute; left:".$xcoord2."px; top:".$ycoord2."px;\" class=nowrap><a href=\"index.php?unifid=$lid\"><img style=\"cursor: pointer; cursor: hand; \" src=images/pingg.png border=0 rel=\"tooltip\" data-placement=\"".$dpl."\" data-original-title=\"".$bst."\" onmouseover=\"this.src='images/ping.png';ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"this.src='images/pingg.png';RestorePath();\" align=left></a> ".strtoken($o[3],"/")."</span>";
/*
if ($o[$i21]<165) { 
$area1.="<!-- $o[21] --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x+$x/2+$o[$i21]*$x/360-7-5-21).", ".round($y/2-$o[$i20]*$y/180-$h+2-25-$sdv).", ".round($x+$x/2+$o[$i21]*$x/360-7+20-21).", ".round($y/2-$o[$i20]*$y/180-$h-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
$area21.="<!-- $o[21] --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x2+$x2/2+$o[$i21]*$x2/360-7-5-15).", ".round($y2/2-$o[$i20]*$y2/180-$h2+2-25-$sdv).", ".round($x2+$x2/2+$o[$i21]*$x2/360-7+10-21).", ".round($y2/2-$o[$i20]*$y2/180-$h2-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
}
if ($o[$i21]>165) {
$area1.="<!-- $o[21] --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x/2+$o[$i21]*$x/360-7-5-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h+2-25-$sdv).", ".round($x/2+$o[$i21]*$x/360-7+20-21-$x).", ".round($y/2-$o[$i20]*$y/180-$h-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
$area21.="<!-- $o[21] --><area class=jons href=index.php?unifid=$lid shape=\"rect\" coords=\"".round($x2/2+$o[$i21]*$x2/360-7-5-15-$x2).", ".round($y2/2-$o[$i20]*$y2/180-$h2+2-25-$sdv).", ".round($x2/2+$o[$i21]*$x2/360-7+10-21-$x2).", ".round($y2/2-$o[$i20]*$y2/180-$h2-$sdv)."\" rel=\"tooltip\" data-original-title=\"$bst\">";
}
*/

$map1.="<div class=\"pull-left mr mb\"><a href=index.php?unifid=$lid class=cat1 onmouseover=\"ShowPath('".rawurlencode($o[6])."');\" onmouseout=\"RestorePath();\"><img src=$image_path/pingg.png border=0> <b>$o[3] / ".str_replace("\"", "'",@$o[34])."</b></a><br>$curstatus<br><small>$o[7]<br>$dp<br></small></div>";
$jo++;
}
}

}
}

natcasesort($tarea1);
natcasesort($tarea21);
$area1=implode("",$tarea1);
$area21=implode("",$tarea21);

$lemap="";
if ($show_bigger_map==1) {
$lemap.="<style type=\"text/css\">

            #scroller {
			position: relative;
                border: solid 1px $nc10;
                height: ".($y+2)."px;
                width: ".($x+2)."px;
                overflow: hidden;
            }
            .options {
                font-size: 12px;
                margin-bottom: 20px;
            }
            #inner { }
            #inner img {
                display: block;
                max-width: ".$x2."px;
            }

            #controls {
                padding: 10px;
            }
                #controls span {
                cursor: pointer;
                }


        .kinetic-moving-up {
            border-top-color: green !important;
        }
        .kinetic-moving-down {
            border-bottom-color: green !important;
        }
        .kinetic-moving-left {
            border-left-color: green !important;
        }
        .kinetic-moving-right {
            border-right-color: green !important;
        }

        .kinetic-decelerating-up {
            border-top-color: red !important;
        }
        .kinetic-decelerating-down {
            border-bottom-color: red !important;
        }
        .kinetic-decelerating-left {
            border-left-color: red !important;
        }
        .kinetic-decelerating-right {
            border-right-color: red !important;
        }

</style>";

}
$lemap.="
<script language=javascript>
var map='';";
if ($show_bigger_map==1) {
$lemap.="
/*!
    jQuery.kinetic v1.8.2
    Dave Taylor http://the-taylors.org/jquery.kinetic

    The MIT License (MIT)
    Copyright (c) <2011> <Dave Taylor http://the-taylors.org>
*/
/*global define,require */
(function(\$){
	'use strict';

    var DEFAULT_SETTINGS = {
            cursor: 'move',
            decelerate: true,
            triggerHardware: false,
            y: true,
            x: true,
            slowdown: 0.9,
            maxvelocity: 40,
            throttleFPS: 60,
            movingClass: {
                up: 'kinetic-moving-up',
                down: 'kinetic-moving-down',
                left: 'kinetic-moving-left',
                right: 'kinetic-moving-right'
            },
            deceleratingClass: {
                up: 'kinetic-decelerating-up',
                down: 'kinetic-decelerating-down',
                left: 'kinetic-decelerating-left',
                right: 'kinetic-decelerating-right'
            }
        },
        SETTINGS_KEY = 'kinetic-settings',
        ACTIVE_CLASS = 'kinetic-active';
    /**
     * Provides requestAnimationFrame in a cross browser way.
     * http://paulirish.com/2011/requestanimationframe-for-smart-animating/
     */
    if ( !window.requestAnimationFrame ) {

        window.requestAnimationFrame = ( function() {

            return window.webkitRequestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.oRequestAnimationFrame ||
            window.msRequestAnimationFrame ||
            function( /* function FrameRequestCallback */ callback, /* DOMElement Element */ element ) {
                window.setTimeout( callback, 1000 / 60 );
            };

        }());

    }

    // add touch checker to jQuery.support
    \$.support = \$.support || {};
    \$.extend(\$.support, {
        touch: \"ontouchend\" in document
    });
    var selectStart = function() { return false; };

    var decelerateVelocity = function(velocity, slowdown) {
        return Math.floor(Math.abs(velocity)) === 0 ? 0 // is velocity less than 1?
               : velocity * slowdown; // reduce slowdown
    };

    var capVelocity = function(velocity, max) {
        var newVelocity = velocity;
        if (velocity > 0) {
            if (velocity > max) {
                newVelocity = max;
            }
        } else {
            if (velocity < (0 - max)) {
                newVelocity = (0 - max);
            }
        }
        return newVelocity;
    };

    var setMoveClasses = function(settings, classes) {
        this.removeClass(settings.movingClass.up)
            .removeClass(settings.movingClass.down)
            .removeClass(settings.movingClass.left)
            .removeClass(settings.movingClass.right)
            .removeClass(settings.deceleratingClass.up)
            .removeClass(settings.deceleratingClass.down)
            .removeClass(settings.deceleratingClass.left)
            .removeClass(settings.deceleratingClass.right);

        if (settings.velocity > 0) {
            this.addClass(classes.right);
        }
        if (settings.velocity < 0) {
            this.addClass(classes.left);
        }
        if (settings.velocityY > 0) {
            this.addClass(classes.down);
        }
        if (settings.velocityY < 0) {
            this.addClass(classes.up);
        }

    };

    var stop = function(\$scroller, settings) {
        settings.velocity = 0;
        settings.velocityY = 0;
        settings.decelerate = true;
        if (typeof settings.stopped === 'function') {
            settings.stopped.call(\$scroller, settings);
        }
    };

    /** do the actual kinetic movement */
    var move = function(\$scroller, settings) {
        var scroller = \$scroller[0];
        // set scrollLeft
        if (settings.x && scroller.scrollWidth > 0){
            scroller.scrollLeft = settings.scrollLeft = scroller.scrollLeft + settings.velocity;
            if (Math.abs(settings.velocity) > 0) {
                settings.velocity = settings.decelerate ?
                    decelerateVelocity(settings.velocity, settings.slowdown) : settings.velocity;
            }
        } else {
            settings.velocity = 0;
        }

        // set scrollTop
        if (settings.y && scroller.scrollHeight > 0){
            scroller.scrollTop = settings.scrollTop = scroller.scrollTop + settings.velocityY;
            if (Math.abs(settings.velocityY) > 0) {
                settings.velocityY = settings.decelerate ?
                    decelerateVelocity(settings.velocityY, settings.slowdown) : settings.velocityY;
            }
        } else {
            settings.velocityY = 0;
        }

        setMoveClasses.call(\$scroller, settings, settings.deceleratingClass);

        if (typeof settings.moved === 'function') {
            settings.moved.call(\$scroller, settings);
        }

        if (Math.abs(settings.velocity) > 0 || Math.abs(settings.velocityY) > 0) {
            // tick for next movement
            window.requestAnimationFrame(function(){ move(\$scroller, settings); });
        } else {
            stop(\$scroller, settings);
        }
    };

    var callOption = function(method, options) {
        var methodFn = \$.kinetic.callMethods[method],
            args = Array.prototype.slice.call(arguments)
        ;
        if (methodFn) {
            this.each(function(){
                var opts = args.slice(1), settings = \$(this).data(SETTINGS_KEY);
                opts.unshift(settings);
                methodFn.apply(this, opts);
            });
        }
    };

    var attachListeners = function(\$this, settings) {
        var element = \$this[0];
        if (\$.support.touch) {
            \$this.bind('touchstart', settings.events.touchStart)
                .bind('touchend', settings.events.inputEnd)
                .bind('touchmove', settings.events.touchMove)
            ;
        } else {
            \$this
                .mousedown(settings.events.inputDown)
                .mouseup(settings.events.inputEnd)
                .mousemove(settings.events.inputMove)
            ;
        }
        \$this
            .click(settings.events.inputClick)
            .scroll(settings.events.scroll)
            .bind(\"selectstart\", selectStart) // prevent selection when dragging
            .bind('dragstart', settings.events.dragStart);
    };
    var detachListeners = function(\$this, settings) {
        var element = \$this[0];
        if (\$.support.touch) {
            \$this.unbind('touchstart', settings.events.touchStart)
                .unbind('touchend', settings.events.inputEnd)
                .unbind('touchmove', settings.events.touchMove);
        } else {
            \$this
            .unbind('mousedown', settings.events.inputDown)
            .unbind('mouseup', settings.events.inputEnd)
            .unbind('mousemove', settings.events.inputMove)
            .unbind('scroll', settings.events.scroll);
        }
        \$this.unbind('click', settings.events.inputClick)
        .unbind(\"selectstart\", selectStart); // prevent selection when dragging
        \$this.unbind('dragstart', settings.events.dragStart);
    };

    var initElements = function(options) {
        this
        .addClass(ACTIVE_CLASS)
        .each(function(){

            var self = this,
                \$this = \$(this);

            if (\$this.data(SETTINGS_KEY)){
                return;
            }

            var settings = \$.extend({}, DEFAULT_SETTINGS, options),
                xpos,
                prevXPos = false,
                ypos,
                prevYPos = false,
                mouseDown = false,
                scrollLeft,
                scrollTop,
                throttleTimeout = 1000 / settings.throttleFPS,
                lastMove,
                elementFocused
            ;

            settings.velocity = 0;
            settings.velocityY = 0;

            // make sure we reset everything when mouse up
            var resetMouse = function() {
                xpos = false;
                ypos = false;
                mouseDown = false;
            };
            \$(document).mouseup(resetMouse).click(resetMouse);

            var calculateVelocities = function() {
                settings.velocity    = capVelocity(prevXPos - xpos, settings.maxvelocity);
                settings.velocityY   = capVelocity(prevYPos - ypos, settings.maxvelocity);
            };
            var useTarget = function(target) {
                if (\$.isFunction(settings.filterTarget)) {
                    return settings.filterTarget.call(self, target) !== false;
                }
                return true;
            };
            var start = function(clientX, clientY) {
                mouseDown = true;
                settings.velocity = prevXPos = 0;
                settings.velocityY = prevYPos = 0;
                xpos = clientX;
                ypos = clientY;
            };
            var end = function() {
                if (xpos && prevXPos && settings.decelerate === false) {
                    settings.decelerate = true;
                    calculateVelocities();
                    xpos = prevXPos = mouseDown = false;
                    move(\$this, settings);
                }
            };
            var inputmove = function(clientX, clientY) {
                if (!lastMove || new Date() > new Date(lastMove.getTime() + throttleTimeout)) {
                    lastMove = new Date();

                    if (mouseDown && (xpos || ypos)) {
                        if (elementFocused) {
                            \$(elementFocused).blur();
                            elementFocused = null;
                            \$this.focus();
                        }
                        settings.decelerate = false;
                        settings.velocity   = settings.velocityY  = 0;
                        \$this[0].scrollLeft = settings.scrollLeft = settings.x ? \$this[0].scrollLeft - (clientX - xpos) : \$this[0].scrollLeft;
                        \$this[0].scrollTop  = settings.scrollTop  = settings.y ? \$this[0].scrollTop - (clientY - ypos)  : \$this[0].scrollTop;
                        prevXPos = xpos;
                        prevYPos = ypos;
                        xpos = clientX;
                        ypos = clientY;

                        calculateVelocities();
                        setMoveClasses.call(\$this, settings, settings.movingClass);

                        if (typeof settings.moved === 'function') {
                            settings.moved.call(\$this, settings);
                        }
                    }
                }
            };

            // Events
            settings.events = {
                touchStart: function(e){
                    var touch;
                    if (useTarget(e.target)) {
                        touch = e.originalEvent.touches[0];
                        start(touch.clientX, touch.clientY);
                        e.stopPropagation();
                    }
                },
                touchMove: function(e){
                    var touch;
                    if (mouseDown) {
                        touch = e.originalEvent.touches[0];
                        inputmove(touch.clientX, touch.clientY);
                        if (e.preventDefault) {e.preventDefault();}
                    }
                },
                inputDown: function(e){
                    if (useTarget(e.target)) {
                        start(e.clientX, e.clientY);
                        elementFocused = e.target;
                        if (e.target.nodeName === 'IMG'){
                            e.preventDefault();
                        }
                        e.stopPropagation();
                    }
                },
                inputEnd: function(e){
                    end();
                    elementFocused = null;
                    if (e.preventDefault) {e.preventDefault();}
                },
                inputMove: function(e) {
                    if (mouseDown){
                        inputmove(e.clientX, e.clientY);
                        if (e.preventDefault) {e.preventDefault();}
                    }
                },
                scroll: function(e) {
                    if (typeof settings.moved === 'function') {
                        settings.moved.call(\$this, settings);
                    }
                    if (e.preventDefault) {e.preventDefault();}
                },
                inputClick: function(e){
                    if (Math.abs(settings.velocity) > 0) {
                        e.preventDefault();
                        return false;
                    }
                },
                // prevent drag and drop images in ie
                dragStart: function(e) {
                    if (elementFocused) {
                        return false;
                    }
                }
            };

            attachListeners(\$this, settings);
            \$this.data(SETTINGS_KEY, settings)
                .css(\"cursor\", settings.cursor);

            if (settings.triggerHardware) {
                \$this.css({
                    '-webkit-transform': 'translate3d(0,0,0)',
                    '-webkit-perspective': '1000',
                    '-webkit-backface-visibility': 'hidden'
                });
            }
        });
    };

    \$.kinetic = {
        settingsKey: SETTINGS_KEY,
        callMethods: {
            start: function(settings, options){
                var \$this = \$(this);
                settings = \$.extend(settings, options);
                if (settings) {
                    settings.decelerate = false;
                    move(\$this, settings);
                }
            },
            end: function(settings, options){
                var \$this = \$(this);
                if (settings) {
                    settings.decelerate = true;
                }
            },
            stop: function(settings, options){
                var \$this = \$(this);
                stop(\$this, settings);
            },
            detach: function(settings, options) {
                var \$this = \$(this);
                detachListeners(\$this, settings);
                \$this
                .removeClass(ACTIVE_CLASS)
                .css(\"cursor\", \"\");
            },
            attach: function(settings, options) {
                var \$this = \$(this);
                attachListeners(\$this, settings);
                \$this
                .addClass(ACTIVE_CLASS)
                .css(\"cursor\", \"move\");
            }
        }
    };
    \$.fn.kinetic = function(options) {
        if (typeof options === 'string') {
            callOption.apply(this, arguments);
        } else {
            initElements.call(this, options);
        }
        return this;
    };

}(window.jQuery || window.Zepto));
\$.kinetic.callMethods.jumpTo = function(settings, options){
        $(this).kinetic('stop');
                 this.scrollLeft = options.x;
        this.scrollTop = options.y;
         };
";
}
$lemap.="
var chkm=0;
(function(\$){
\$(window).load(function(){
\$(\"[rel=tooltip]\").tooltip({html:true});
";
if ($show_bigger_map==1) {
$lemap.="
$('#scroller').kinetic({ maxvelocity: 30 });
$('#left').click(function(){
$('#scroller').kinetic('start', { velocity: -10 });
});
$('#right').click(function(){
$('#scroller').kinetic('start', { velocity: 10 });
});
$('#end').click(function(){
$('#scroller').kinetic('end');
});
$('#stop').click(function(){
$('#scroller').kinetic('stop');
});
";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="document.getElementById('inner').onclick = function(e) {
 var x = e.offsetX==undefined?e.layerX:e.offsetX;
 var y = e.offsetY==undefined?e.layerY:e.offsetY;
}
document.getElementById('inner').onmousemove = function(e) {
 var x = e.offsetX==undefined?e.layerX:e.offsetX;
 var y = e.offsetY==undefined?e.layerY:e.offsetY;
 document.getElementById('divxy').style.left = x+'px';
 document.getElementById('divxy').style.top = y+'px';
 x=(x-".$x2."/2+20*4)*360/$x2;
 x=x.toFixed(2);
 y=(".$y2."-y-".$y2."/2)*180/$y2;
 y=y.toFixed(2);
 document.getElementById('divxy').innerHTML = y + '<br>' + x ;

}
";
}} }
$lemap.="
setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: 0, y: 0 });
}, 10);
});
})(jQuery);

function RestorePath() {
if (chkm==0) {
document.getElementById('mapp').style.background='url(images/map'+map+'.png)';
}
}
function ShowPath(id) {
if (chkm==0) {
document.getElementById('mapp').src='map.php?rnd=".time()."&id='+id+'&map='+map;
}
}
function zoomin(id) {
map='2';
document.getElementById('mapp').src='images/pix.gif';
document.getElementById('mapp').src='map.php?rnd=".time()."&map='+map;
document.getElementById('mapp').style.background='url(images/map'+map+'.png)';
document.getElementById('zoomin').className='btn ml b1 disabled';
document.getElementById('zoomout').className='btn b1';
setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: ".($x2/2-200).", y: 200 });
}, 10);
document.getElementById('mapp').style.width='".$x2."px';
document.getElementById('mapp').style.height='".$y2."px';
document.getElementById('map1x').className='hidden';
document.getElementById('map2x').className='';
";
if ($show_bigger_map==1) { if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="document.getElementById('biggermap').className='btn ml b1';
document.getElementById('pathmap').className='btn ml b1';
document.getElementById('divxy').className='mr ml label';
"; }}}


$lemap.="
}";
if ($show_bigger_map==1) { if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="
function pathmap() {
if (map=='2') {
if (chkm==0) {
document.getElementById('mapp').src='map3.php?rnd=".time()."&map='+map;
document.getElementById('pathmap').className='btn btn-info ml b1';
chkm=1;
} else {
document.getElementById('mapp').src='map.php?rnd=".time()."&map='+map;
document.getElementById('pathmap').className='btn ml b1';
chkm=0;
setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: ".($x2/2-200).", y: 200 });
}, 10);
}
}
}
function biggermap() {
if (map=='2') {
if (document.getElementById('scroller').style.width!='".$x2."px') {
document.getElementById('scroller').style.width='".$x2."px';
document.getElementById('scroller').style.height='".$y2."px';
document.getElementById('biggermap').className='btn btn-info ml b1';
} else {
document.getElementById('scroller').style.width='".$x."px';
document.getElementById('scroller').style.height='".$y."px';
document.getElementById('biggermap').className='btn ml b1';
setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: ".($x2/2-200).", y: 200 });
}, 10);
}
}
}
";
}}
}
$lemap.="
function zoomout(id) {
";
if ($show_bigger_map==1) { if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="if (map=='2') {
if (document.getElementById('scroller').style.width=='".$x2."px') {
document.getElementById('scroller').style.width='".$x."px';
document.getElementById('scroller').style.height='".$y."px';
document.getElementById('biggermap').className='btn ml b1 disabled';
document.getElementById('pathmap').className='btn ml b1 disabled';
}
document.getElementById('biggermap').className='btn ml b1 disabled';
document.getElementById('pathmap').className='btn ml b1 disabled';
chkm=0;
}
";
}}}
$lemap.="map='';
document.getElementById('mapp').src='map.php?rnd=".time()."&map='+map;
document.getElementById('mapp').style.background='url(images/map'+map+'.png)';
document.getElementById('zoomin').className='btn b1 ml';
document.getElementById('zoomout').className='btn b1 disabled';
document.getElementById('mapp').style.width='".$x."px';
document.getElementById('mapp').style.height='".$y."px';
document.getElementById('map1x').className='';
document.getElementById('map2x').className='hidden';
setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: 0, y: 0 });
}, 10);
";

if ($show_bigger_map==1) { if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="
document.getElementById('divxy').className='mr ml label hidden';
";
}}}
$lemap.="
}
</script><div class=one-edge-shadow>";
$lemap.="<div id=\"scroller\"><div id=inner><img id=mapp style=\"background-image: url('images/map.png');\" src=\"map.php?rnd=".time()."&iw=$x&ih=$y\" border=0>";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $lemap.="<span class=\"mr ml label hidden\" id=divxy style=\"position:absolute; z-index:2001;\"></span>"; } }
if ($show_bigger_map==1) {
$lemap.="<div id=map2x class=\"hidden\">$area21"."$area22"."$area23</div>";
}
$lemap.="<div id=map1x class=\"\">$area1"."$area2"."$area3</div>";
$lemap.="</div></div>
";
if ($show_bigger_map==1) {
$lemap.="<div style=\"padding: 5px; background:$nc10;\"><span class=\"btn b1 disabled\" id=zoomout onclick=\"zoomout();\"><b class=\"icon-zoom-out\"></b></span><span class=\"btn ml b1\" id=zoomin onclick=\"zoomin();\"><b class=\"icon-zoom-in\"></b></span>";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $lemap.="<span class=\"btn ml b1 disabled\" id=biggermap onclick=\"biggermap();\"><b class=\"icon-fullscreen\"></b></span><span class=\"btn ml b1 disabled\" id=pathmap onclick=\"pathmap();\"><b class=\"icon-random\"></b></span>"; }}
$lemap.="</div>";
}
$lemap.="</div><div style=\"height:250px; overflow:auto;\">$map1"."$map2"."$map3<div class=clearfix></div></div>";
if ($fmap==1) {
$page_content=str_replace("[map]", "$lemap", $page_content);
} else {
$themecontent=str_replace("[map]", "$lemap", $themecontent);


}
}

?>
