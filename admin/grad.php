<?php

/* Usage :
 *
 * require_once('/path/to/gd-gradient-fill.php');
 * $image = new gd_gradient_fill($width,$height,$direction,$startcolor,$endcolor,$step);
 */

class gd_gradient_fill {

    // Constructor. Creates, fills and returns an image
    function gd_gradient_fill($w,$h,$d,$s,$e,$step=0) {
        $this->width = $w;
        $this->height = $h;
        $this->direction = $d;
        $this->startcolor = $s;
        $this->endcolor = $e;
        $this->step = intval(abs($step));

        // Attempt to create a blank image in true colors, or a new palette based image if this fails
        if (function_exists('imagecreatetruecolor')) {
            $this->image = imagecreatetruecolor($this->width,$this->height);
        } elseif (function_exists('imagecreate')) {
            $this->image = imagecreate($this->width,$this->height);
        } else {
            die('Unable to create an image');
        }

        // Fill it
        $this->fill($this->image,$this->direction,$this->startcolor,$this->endcolor);

        // Show it
        $this->display($this->image);

        // Return it
        return $this->image;
    }


    // Displays the image with a portable function that works with any file type
    // depending on your server software configuration
    function display ($im) {
        if (function_exists("imagejpeg")) {
        @header("Content-type: image/jpeg");
            @imagejpeg($im);

        }
        elseif (function_exists("imagegif")) {
        header("Content-type: image/gif");
            imagegif($im);
        }
        elseif (function_exists("imagepng")) {
            header("Content-type: image/png");
            imagepng($im);
        }

        elseif (function_exists("imagewbmp")) {
            header("Content-type: image/vnd.wap.wbmp");
            imagewbmp($im);
        } else {
            die("Doh ! No graphical functions on this server ?");
        }
        return true;
    }

    // The main function that draws the gradient
    function fill($im,$direction,$start,$end) {

        switch($direction) {
            case 'horizontal':
                $line_numbers = imagesx($im);
                $line_width = imagesy($im);
                list($r1,$g1,$b1) = $this->hex2rgb($start);
                list($r2,$g2,$b2) = $this->hex2rgb($end);
                break;
            case 'crystal':
                $line_numbers = imagesy($im);
                $line_width = imagesx($im);
                list($r1,$g1,$b1) = $this->hex2rgb($start);
                list($r2,$g2,$b2) = $this->hex2rgb($end);
                break;
            case 'vertical':
               $line_numbers = round(imagesy($im)*1);
                $line_width = imagesx($im);
                list($r1,$g1,$b1) = $this->hex2rgb($start);
                list($r2,$g2,$b2) = $this->hex2rgb($end);
                $r3=$r1+40; if ($r3>255) {$r3=255; }
                $g3=$g1+40; if ($g3>255) {$g3=255; }
                $b3=$b1+40; if ($b3>255) {$b3=255; }
                break;
            case 'ellipse':
                $width = imagesx($im);
                $height = imagesy($im);
                $rh=$height>$width?1:$width/$height;
                $rw=$width>$height?1:$height/$width;
                $line_numbers = min($width,$height);
                $center_x = $width/2;
                $center_y = $height/2;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                imagefill($im, 0, 0, imagecolorallocate( $im, $r1, $g1, $b1 ));
                break;
            case 'ellipse2':
                $width = imagesx($im);
                $height = imagesy($im);
                $rh=$height>$width?1:$width/$height;
                $rw=$width>$height?1:$height/$width;
                $line_numbers = sqrt(pow($width,2)+pow($height,2));
                $center_x = $width/2;
                $center_y = $height/2;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                break;
            case 'circle':
                $width = imagesx($im);
                $height = imagesy($im);
                $line_numbers = sqrt(pow($width,2)+pow($height,2));
                $center_x = $width/2;
                $center_y = $height/2;
                $rh = $rw = 1;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                break;
            case 'circle2':
                $width = imagesx($im);
                $height = imagesy($im);
                $line_numbers = min($width,$height);
                $center_x = $width/2;
                $center_y = $height/2;
                $rh = $rw = 1;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                imagefill($im, 0, 0, imagecolorallocate( $im, $r1, $g1, $b1 ));
                break;
            case 'square':
            case 'rectangle':
                $width = imagesx($im);
                $height = imagesy($im);
                $line_numbers = max($width,$height)/2;
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                break;
            case 'diamond':
                list($r1,$g1,$b1) = $this->hex2rgb($end);
                list($r2,$g2,$b2) = $this->hex2rgb($start);
                $width = imagesx($im);
                $height = imagesy($im);
                $rh=$height>$width?1:$width/$height;
                $rw=$width>$height?1:$height/$width;
                $line_numbers = min($width,$height);
                break;
            default:
        }

        for ( $i = 0; $i < $line_numbers; $i=$i+1+$this->step ) {
            // old values :
            $old_r=@$r;
            $old_g=@$g;
            $old_b=@$b;
            // new values :
            $r = ( $r2 - $r1 != 0 ) ? intval( $r1 + ( $r2 - $r1 ) * ( $i / $line_numbers ) ): $r1;
            $g = ( $g2 - $g1 != 0 ) ? intval( $g1 + ( $g2 - $g1 ) * ( $i / $line_numbers ) ): $g1;
            $b = ( $b2 - $b1 != 0 ) ? intval( $b1 + ( $b2 - $b1 ) * ( $i / $line_numbers ) ): $b1;
            // new values :
            $r3 = ( $r1 - @$r3 != 0 ) ? intval( @$r3 + ( @$r1 - @$r3 ) * ( $i / $line_numbers ) ): @$r3;
            $g3 = ( $g1 - @$g3 != 0 ) ? intval( @$g3 + ( $g1 - @$g3 ) * ( $i / $line_numbers ) ): @$g3;
            $b3 = ( $b1 - @$b3 != 0 ) ? intval( @$b3 + ( $b1 - @$b3 ) * ( $i / $line_numbers ) ): @$b3;
            // if new values are really new ones, allocate a new color, otherwise reuse previous color.
            // There's a "feature" in imagecolorallocate that makes this function
            // always returns '-1' after 255 colors have been allocated in an image that was created with
            // imagecreate (everything works fine with imagecreatetruecolor)
            if ( "$old_r,$old_g,$old_b" != "$r,$g,$b")
                $fill = imagecolorallocate( $im, $r, $g, $b );
                $fill2 = imagecolorallocate( $im, $r3, $g3, $b3 );
            switch($direction) {
                case 'crystal':
                    imagefilledrectangle($im, 0, $i, $line_width, $i+$this->step, $fill);
                    break;
                case 'vertical':
                if ($i<($line_numbers*0.4)) {
                imagefilledrectangle($im, 0, $i, $line_width, $i+$this->step, $fill2);
                } else {
                imagefilledrectangle($im, 0, $i, $line_width, $i+$this->step, $fill);
                }
                break;
                case 'horizontal':
                    imagefilledrectangle( $im, $i, 0, $i+$this->step, $line_width, $fill );
                    break;
                case 'ellipse':
                case 'ellipse2':
                case 'circle':
                case 'circle2':
                    imagefilledellipse ($im,$center_x, $center_y, ($line_numbers-$i)*$rh, ($line_numbers-$i)*$rw,$fill);
                    break;
                case 'square':
                case 'rectangle':
                    imagefilledrectangle ($im,$i*$width/$height,$i*$height/$width,$width-($i*$width/$height), $height-($i*$height/$width),$fill);
                    break;
                case 'diamond':
                    imagefilledpolygon($im, array (
                        $width/2, $i*$rw-0.5*$height,
                        $i*$rh-0.5*$width, $height/2,
                        $width/2,1.5*$height-$i*$rw,
                        1.5*$width-$i*$rh, $height/2 ), 4, $fill);
                    break;
                default:
            }
        }
    }

    // #ff00ff -> array(255,0,255) or #f0f -> array(255,0,255)
    function hex2rgb($color) {
        $color = str_replace('#','',$color);
        $s = strlen($color) / 3;
        $rgb[]=hexdec(str_repeat(substr($color,0,$s),2/$s));
        $rgb[]=hexdec(str_repeat(substr($color,$s,$s),2/$s));
        $rgb[]=hexdec(str_repeat(substr($color,2*$s,$s),2/$s));
        return $rgb;
    }
}
if (!isset($_GET['w'])){$_GET['w']=100;} if (!preg_match("/^[a-zA-Z0-9]+$/i",$_GET['w'])) { $_GET['w']=100;}
if (!isset($_GET['h'])){$_GET['h']=100;} if (!preg_match("/^[a-zA-Z0-9]+$/i",$_GET['h'])) { $_GET['h']=100;}
if (!isset($_GET['d'])){$_GET['d']="vertical";} if (!preg_match("/^[a-zA-Z0-9]+$/i",$_GET['d'])) { $_GET['d']="vertical";}
if (!isset($_GET['s'])){$_GET['s']="ccc";} $_GET['s']=str_replace("#","",$_GET['s']); if (!preg_match("/^[a-zA-Z0-9]+$/i",$_GET['s'])) { $_GET['s']="ccc";}
if (!isset($_GET['e'])){$_GET['e']="fff";} $_GET['e']=str_replace("#","",$_GET['e']);if (!preg_match("/^[a-zA-Z0-9]+$/i",$_GET['e'])) { $_GET['e']="fff";}
$image = new gd_gradient_fill($_GET['w'],$_GET['h'],$_GET['d'],$_GET['s'],$_GET['e'],1);
@header("Content-type: image/jpeg");
@imagejpeg($image);

?>
