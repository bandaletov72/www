<?php
$zoomfirst="";
$show_bigger_map=1;
$h=0;
$h2=0;
$tmp=file("$base_loc/citymap.txt");
natcasesort($tmp);
reset($tmp);
$map1=""; $map2=""; $map3="";
$area0="<span style=\"margin:0; cursor: pointer; cursor: hand; position: absolute; left:10px; top:10px; z-index=3001; font-size:8px;\"><a href=$htpath><img id=jons_0 src=logo_mini.png border=0><br><b style=\"background:$nc0;\">".str_replace("http://","", str_replace("www.","",$htpath))."</b></a></span>"; $area1=""; $area2=""; $area3=""; $area21="";$area22="";$area23="";
unset($kc,$kv,$out,$out2);
$ims = @getimagesize("./images/citymap.png");
$ims2 = @getimagesize("./images/citymap2.png");
$ims3 = @getimagesize("./images/pin2.png");
$x3=$ims3[0]; $y3=$ims3[1];
$x2=$ims2[0]; $y2=$ims2[1];
$x=$ims[0]; $y=$ims[1];
$tarea1=Array();
$tarea21=Array();
$jumpto="\$('#scroller').kinetic('jumpTo', { x: ".ceil($x2/2.8).", y: ".ceil($y2/2.4)." });";$jo=0;
while(list($key,$val)=each($tmp)) {
if (trim($val)!="") {
$o=explode("|", trim($val));

$coms="";
if (trim(@$o[4])!="") { $coms="<br>".$o[4]."<br><br>"; }
if ($opage==$o[1]) {
$zoomfirst="zoomin();";
$jumpto="setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: ".ceil((($o[2]*$x2/$x)-$x3/2-3)-$x/2).", y: ".ceil(($o[3]*$y2/$y)-$y3-10-$y/2)." });
}, 10);";
$tarea1[$jo]="<!-- $o[3] --><img id=jons".$jo." src=images/pinoo.png border=0 style=\"margin:0;cursor: pointer; cursor: hand; position: absolute; left:".ceil($o[2]-$x3/2-5)."px; top:".ceil($o[3]-$y3-11)."px;\" rel=\"tooltip\" data-original-title=\"".$o[0]."\">";
$tarea21[$jo]="<!-- $o[3] --><img id=jjons".$jo." src=images/pinoo.png border=0 style=\"margin:0; cursor: pointer; cursor: hand; position: absolute; left:".ceil(($o[2]*$x2/$x)-$x3/2-3)."px; top:".ceil(($o[3]*$y2/$y)-$y3-10)."px;\" rel=\"tooltip\" data-original-title=\"".$o[0]."\">";
$map1.="<div class=\"mr mb\"><a href=\"index.php?page=$o[1]\" class=mr><img src=$image_path/pinoo.png border=0 class=mr<b>$o[0]</b></a><font class=small>  $coms</font></div>";
} else {
$tarea1[$jo]="<!-- $o[3] --><img id=jons".$jo." onclick=\"location.href='index.php?page=$o[1]';\" src=images/pinrr.png border=0 style=\"margin:0;cursor: pointer; cursor: hand; position: absolute; left:".ceil($o[2]-$x3/2-5)."px; top:".ceil($o[3]-$y3-11)."px;\" rel=\"tooltip\" data-original-title=\"".$o[0]."\" onmouseover=\"this.src='images/pinr.png';\" onmouseout=\"this.src='images/pinrr.png';\">";
$tarea21[$jo]="<!-- $o[3] --><img id=jjons".$jo." onclick=\"location.href='index.php?page=$o[1]';\" src=images/pinrr.png border=0 style=\"margin:0;cursor: pointer; cursor: hand; position: absolute; left:".ceil(($o[2]*$x2/$x)-$x3/2-3)."px; top:".ceil(($o[3]*$y2/$y)-$y3-10)."px;\" rel=\"tooltip\" data-original-title=\"".$o[0]."\" onmouseover=\"this.src='images/pinr.png';\" onmouseout=\"this.src='images/pinrr.png';\">";
$map1.="<div class=\"mr mb\"><a href=\"index.php?page=$o[1]\" class=mr><img src=$image_path/pinrr.png border=0 class=mr><b>$o[0]</b></a><font class=small>  $coms</font></div>";
}



$jo++;
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
                height: ".$y."px;
                width: ".$x."px;
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
            border-top-color: $nc10 !important;
        }
        .kinetic-moving-down {
            border-bottom-color: $nc10 !important;
        }
        .kinetic-moving-left {
            border-left-color: $nc10 !important;
        }
        .kinetic-moving-right {
            border-right-color: $nc10 !important;
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
var map='';
var kx=".(round(100*$x/$x2)/100).";
var ky=".(round(100*$y/$y2)/100).";";
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
            cursor: '',
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
                .css(\"cursor\", \"\");
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
var xx=0;
var yy=0;
var chkm=0;
(function(\$){
\$(window).load(function(){
\$(\"[rel=tooltip]\").tooltip({html:true,placement:'bottom'});
zoomout();
";
if ($show_bigger_map==1) {
$lemap.="
$('#scroller').kinetic();
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
document.getElementById('mapp').onclick = function(e) {
 var x = e.offsetX==undefined?e.layerX:e.offsetX;
 var y = e.offsetY==undefined?e.layerY:e.offsetY;
}
document.getElementById('mapp').onmousemove = function(e) {
 var x = e.offsetX==undefined?e.layerX:e.offsetX;
 var y = e.offsetY==undefined?e.layerY:e.offsetY;
 ";
 if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.=" document.getElementById('divxy').style.left = x+'px';
 document.getElementById('divxy').style.top = y+'px';
 ";
 }}
$lemap.=" x=x.toFixed(2);
 y=y.toFixed(2);
 xx=(x/kx-x).toFixed(2);
  yy=(y/ky-y).toFixed(2);
  ";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="
 if (map=='') {

 document.getElementById('divxy').innerHTML = x + ':' + y ;
  } else {
  document.getElementById('divxy').innerHTML = (x*kx).toFixed(2) + ':' + (y*ky).toFixed(2);
  }
";
}}
$lemap.="
}
";
}
$lemap.="

document.getElementById('mapp').style.cursor='-webkit-zoom-in';
document.getElementById('mapp').style.cursor='-moz-zoom-in';
$zoomfirst
$jumpto
});
})(jQuery);
function clickmap(x,y) {
if (map=='') {
zoomin();
}
}
function zoomin(x,y) {
map='2';
document.getElementById('mapp').style.background='url(images/citymap'+map+'.png)';
document.getElementById('zoomin').className='btn ml b1 disabled';
document.getElementById('zoomout').className='btn b1';
document.getElementById('mapp').style.width='".$x2."px';
document.getElementById('mapp').style.height='".$y2."px';
document.getElementById('mapp').style.cursor='move';
document.getElementById('map1x').className='hidden';
document.getElementById('map2x').className='';
";
if ($show_bigger_map==1) { if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="document.getElementById('biggermap').className='btn ml b1';
document.getElementById('divxy').className='mr ml label';
"; }}}


$lemap.="
setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: xx, y: yy });
}, 10);
}";
if ($show_bigger_map==1) { if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="
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
\$('#scroller').kinetic('jumpTo', { x: 0, y: 0 });
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
if ($show_bigger_map==1) {
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="if (map=='2') {
if (document.getElementById('scroller').style.width=='".$x2."px') {
document.getElementById('scroller').style.width='".$x."px';
document.getElementById('scroller').style.height='".$y."px';
document.getElementById('biggermap').className='btn ml b1 disabled';
}
document.getElementById('biggermap').className='btn ml b1 disabled';
}
";
}}}
$lemap.="map='';
document.getElementById('mapp').style.background='url(images/citymap'+map+'.png)';
document.getElementById('mapp').style.cursor='';
document.getElementById('zoomin').className='btn b1 ml';
document.getElementById('zoomout').className='btn b1 disabled';
document.getElementById('map2x').className='hidden';
document.getElementById('map1x').className='';
chkm=0;
document.getElementById('mapp').style.top='0px';
document.getElementById('mapp').style.left='0px';
document.getElementById('mapp').style.width='".$x."px';
document.getElementById('mapp').style.height='".$y."px';
document.getElementById('mapp').style.cursor='-webkit-zoom-in';
document.getElementById('mapp').style.cursor='-moz-zoom-in';
setTimeout(function(){
\$('#scroller').kinetic('jumpTo', { x: 0, y: 0 });
}, 10);
";

if ($show_bigger_map==1) { if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){
$lemap.="
document.getElementById('divxy').className='mr ml label';
";
}}}
$lemap.="
}
</script><div class=\"box2 pull-left\"><div id=\"scroller\">$area0<div id=inner onclick=clickmap();><img id=mapp style=\"background-image: url('images/citymap.png'); width:".$x."px; height:".$y."px;\" src=\"images/pix.gif\" border=0>";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $lemap.="<span class=\"mr ml label hidden\" id=divxy style=\"position:absolute; z-index:2001;\"></span>"; } }

if ($show_bigger_map==1) {
$lemap.="<div id=map2x class=\"hidden\">$area21"."$area22"."$area23</div>";
}
$lemap.="<div id=map1x class=\"\">$area1"."$area2"."$area3</div>
</div></div>
";
if ($show_bigger_map==1) {
$lemap.="<div style=\"padding: 5px; background:$nc10; width:".($x-8)."px\"><span class=\"btn b1 disabled\" id=zoomout onclick=\"zoomout();\"><b class=\"icon-zoom-out\"></b></span><span class=\"btn ml b1\" id=zoomin onclick=\"zoomin();\"><b class=\"icon-zoom-in\"></b></span>";
if(($details[7]=="ADMIN")||($details[7]=="MODER")){if (($valid=="1")){ $lemap.="<span class=\"btn ml b1 disabled\" id=biggermap onclick=\"biggermap();\"><b class=\"icon-fullscreen\"></b></span>"; }}
$lemap.="</div>";
}
$lemap.="</div></div><div class=\"pull-left ml\"><div class=\"mb razd\" style=\"width: 200px;\" align=center><font class=small>$lang[1619]:</font></div><div class=\"ml box5\" style=\"height:".($y-15)."px; overflow:auto; width: 200px; border-bottom: $nc10 dotted 1px;\">$map1"."$map2"."$map3</div></div><div class=clearfix></div>";
?>
