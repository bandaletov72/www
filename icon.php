<?php
$name=str_replace("..","", trim(stripslashes("./classifieds/base".rawurldecode($_GET['path']))));

if (file_exists($name)==true){
$system=explode(".",substr($name,-5));
if (($system[1]=="jpg")||($system[1]=="jpeg")||($system[1]=="gif")||($system[1]=="png")||($system[1]=="JPG")||($system[1]=="Jpg")||($system[1]=="GIF")||($system[1]=="Gif")||($system[1]=="PNG")||($system[1]=="Png")) {
if (($system[1]=="jpg")||($system[1]=="jpeg")||($system[1]=="JPG")||($system[1]=="Jpg")){$src_img=@imagecreatefromjpeg($name);}
    if (($system[1]=="gif")||($system[1]=="GIF")||($system[1]=="Gif")){$src_img=@imagecreatefromgif($name);}
	if (($system[1]=="png")||($system[1]=="PNG")||($system[1]=="Png")){$src_img=@imagecreatefrompng($name);}
	//$old_x=imageSX($src_img);
	//$old_y=imageSY($src_img);

	//$dst_img=ImageCreateTrueColor($old_x,$old_y);
	//imagecopyresampled($dst_img,$src_img,0,0,0,0,$old_x,$old_y,$old_x,$old_y);
    if (function_exists("imagepng")) {
            header("Content-type: image/png");
            @imagepng($src_img);

        }
        elseif (function_exists("imagegif")) {
        header("Content-type: image/gif");
            @imagegif($src_img);
        }
        elseif (function_exists("imagejpeg")) {
        header("Content-type: image/jpeg");
            @imagejpeg($src_img);
        }

        elseif (function_exists("imagewbmp")) {
            header("Content-type: image/vnd.wap.wbmp");
            @imagewbmp($src_img);
        } else {
            die("Doh ! No graphical functions on this server ?");
        }
     }
      }

?>
