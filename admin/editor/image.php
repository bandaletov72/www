<?php

$abspath="../upimages";
$webpath="../upimages";

if ($action=="del") {
unlink("$file");
}


if ($action=="upload") {

$image_tmp = $_FILES['inpFile']['tmp_name'];
$fname = $_FILES['inpFile']['name'];
if ($fname!='') {

move_uploaded_file($image_tmp, "$abspath/$chdirname/$fname");
}

}

$dir_list.="<option value=\"\" $selected>./</option>";
$img_dir=opendir($abspath);
while($dir=readdir($img_dir)) {
if ($dir != ".." and $dir != "." and !is_file($abspath."/".$dir)) {
$selected='';

if ($dir=="$chdirname") {
$selected='selected';
}
$dir_list.="<option value=\"$dir\" $selected>$dir</option>";
}

}

if ($chdirname!='') {
$abspath=$abspath."/".$chdirname;
$webpath=$webpath."/"."$chdirname";
} 


$img_dir=opendir($abspath);
while($file=readdir($img_dir)) {


if ($file != ".." and $file != "." and is_file($abspath."/".$file)) {
$this_size =  filesize($abspath."/".$file);
$this_size=formatsize($this_size);

$pathsel="$webpath"."/"."$file";
$pathdel="$abspath"."/"."$file";
$files_list_bit.="<tr bgcolor=Gainsboro>";
$files_list_bit.="<td valign=top>".$file."</td>";
$files_list_bit.="<td valign=top>".$this_size."</td>";
$files_list_bit.="<td valign=top style=\"cursor:hand;\" onclick=\"selectImage('$pathsel')\"><u><font color=#3a87ad>select</font></u></td>";
$files_list_bit.="<td valign=top style=\"cursor:hand;\" onclick=\"deleteImage('$pathdel')\"><u><font color=#3a87ad>del</font></u></td></tr>";

}}

$files_list="<table border=0 cellpadding=3 cellspacing=0 width=300>$files_list_bit</table>";

?>

<html>
<head>
	<title>Insert/Update Image</title>
	<style>
	BODY
		{
		FONT-FAMILY: Verdana;FONT-SIZE: xx-small;
		}
	TABLE
		{
	    FONT-SIZE: xx-small;
	    FONT-FAMILY: Tahoma
		}
	INPUT
		{
		font:8pt verdana,arial,sans-serif;
		}
	select
		{
		height: 22px; 
		top:2;
		font:8pt verdana,arial,sans-serif
		}	
	.bar 
		{
		BORDER-TOP: #99ccff 1px solid; BACKGROUND: #336699; WIDTH: 100%; BORDER-BOTTOM: #000000 1px solid; HEIGHT: 20px
		}		
	</style>
</head>
<BODY background='new/a1.gif' onload="checkImage()" link=Blue vlink=MediumSlateBlue alink=MediumSlateBlue leftmargin=5 rightmargin=5 topmargin=5 bottommargin=5 bgcolor=Gainsboro>



	<table border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td valign=top>
		<!-- Content -->

		<table border=0 cellpadding=3 cellspacing=3 align=center>
		<tr>
		<td align=center style="BORDER-TOP: #336699 1px solid;BORDER-LEFT: #336699 1px solid;BORDER-RIGHT: #336699 1px solid;BORDER-BOTTOM: #336699 1px solid;" bgcolor=White>
				<div id="divImg" style="overflow:auto;width:150;height:170"></div>
		</td>  
  		<td valign=top>
				<form method=post action=image.php id=form2 name=form2>
						<table border=0 height=30 cellpadding=0 cellspacing=0><tr>
						<td><b>Select folder&nbsp;:&nbsp;</b></td>
						<td>
						<select id=catid name=chdirname onchange="form2.submit()">
						<?php echo $dir_list?>
						</select> 
						</td></tr></table>
				</form>
				
				<table border=0 cellpadding=0 cellspacing=0 width=320>
				<tr><td>
				<div class="bar" style="padding-left: 5px;">
				<font size="2" face="tahoma" color="white"><b>File Name</b></font>
				</div>
				</td></tr>
				</table>
				
				<div style="overflow:auto;height:120;width:320;BORDER-LEFT: #316AC5 1px solid;BORDER-RIGHT: LightSteelblue 1px solid;BORDER-BOTTOM: LightSteelblue 1px solid;">
				<?php echo $files_list?>
				</div>

				<FORM METHOD="Post" ENCTYPE="multipart/form-data" ACTION="image.php?action=upload" ID="form1" name="form1">
				Upload Image : <br>
				<INPUT type="file" id="inpFile" name=inpFile size=22 style="font:8pt verdana,arial,sans-serif"><br>
				<input name="chdirname" ID="chdirname" type=hidden>
				<INPUT TYPE="button" value="Upload" onclick="chdirname.value=form2.chdirname.value;form1.submit()">
				</FORM>		
				
		</td>						
		</tr>
		<tr>
		<td colspan=2>
				
				<hr noshade color='#0069DD' size='1'>	
				<table border=0 width=340 cellpadding=0 cellspacing=1>
				<tr>
						<td>Image source : </td>
						<td colspan=3>
						<INPUT type="text" id="inpImgURL" name=inpImgURL size=39>
						<!--<font color=#b94a48>(you can type your own image path here)</font>-->
						</td>		
				</tr>					
				<tr>
						<td>Alternate text : </td>
						<td colspan=3><INPUT type="text" id="inpImgAlt" name=inpImgAlt size=39></td>		
				</tr>				
				<tr>
						<td>Alignment : </td>
						<td>
						<select ID="inpImgAlign" NAME="inpImgAlign">
								<option value="" selected>&lt;Not Set&gt;</option>
								<option value="absBottom">absBottom</option>
								<option value="absMiddle">absMiddle</option>
								<option value="baseline">baseline</option>
								<option value="bottom">bottom</option>
								<option value="left">left</option>
								<option value="middle">middle</option>
								<option value="right">right</option>
								<option value="textTop">textTop</option>
								<option value="top">top</option>						
						</select>
						</td>
						<td>Image border :</td>
						<td><select id=inpImgBorder name=inpImgBorder>							<option value=0>0</option>
							<option value=1>1</option>
							<option value=2>2</option>
							<option value=3>3</option>
							<option value=4>4</option>
							<option value=5>5</option>
						</select>
						</td>					
				</tr>
				<tr>
						<td>Width :</td>
						<td><INPUT type="text" ID="inpImgWidth" NAME="inpImgWidth" size=2></td>
						<td>Horizontal Spacing :</td>
						<td><INPUT type="text" ID="inpHSpace" NAME="inpHSpace" size=2></td>
				</tr>				
				<tr>
						<td>Height :</td>
						<td><INPUT type="text" ID="inpImgHeight" NAME="inpImgHeight" size=2></td>
						<td>Vertical Spacing :</td>
						<td><INPUT type="text" ID="inpVSpace" NAME="inpVSpace" size=2></td>
				</tr>
				</table>

		</td>
		</tr>
		<tr>
		<td align=center colspan=2>
				<table cellpadding=0 cellspacing=0 align=center><tr>
				<td><INPUT type="button" value="Cancel" onclick="self.close();" style="height: 22px;font:8pt verdana,arial,sans-serif" ID="Button1" NAME="Button1"></td>
				<td>
				<span id="btnImgInsert" style="display:none">
				<INPUT type="button" value="Insert" onclick="InsertImage();self.close();" style="height: 22px;font:8pt verdana,arial,sans-serif" ID="Button2" NAME="Button2">
				</span>
				<span id="btnImgUpdate" style="display:none">
				<INPUT type="button" value="Update" onclick="UpdateImage();self.close();" style="height: 22px;font:8pt verdana,arial,sans-serif" ID="Button3" NAME="Button3">
				</span>				
				</td>
				</tr></table>
		</td>
		</tr>
		</table>

		<!-- /Content -->
		<br>
	</td>
	</tr>
	</table>



<script language="JavaScript">
function deleteImage(sURL)
	{
	if (confirm("Delete this document ?") == true) 
		{
		window.navigate("image.php?action=del&file="+sURL+"&chdirname="+form2.chdirname.value);
		}
	}
function selectImage(sURL)
	{
	inpImgURL.value = sURL;
	
	divImg.style.visibility = "hidden"
	divImg.innerHTML = "<img id='idImg' src='" + sURL + "'>";
	

	var width = idImg.width
	var height = idImg.height 
	var resizedWidth = 150;
	var resizedHeight = 170;

	var Ratio1 = resizedWidth/resizedHeight;
	var Ratio2 = width/height;

	if(Ratio2 > Ratio1)
		{
		if(width*1>resizedWidth*1)
			idImg.width=resizedWidth;
		else
			idImg.width=width;
		}
	else
		{
		if(height*1>resizedHeight*1)
			idImg.height=resizedHeight;
		else
			idImg.height=height;
		}
	
	divImg.style.visibility = "visible"
	}

/***************************************************
	If you'd like to use your own Image Library :
	- use InsertImage() method to insert image
		Params : url,alt,align,border,width,height,hspace,vspace
	- use UpdateImage() method to update image
		Params : url,alt,align,border,width,height,hspace,vspace
	- use these methods to get selected image properties :
		imgSrc()
		imgAlt()
		imgAlign()
		imgBorder()
		imgWidth()
		imgHeight()
		imgHspace()
		imgVspace()
		
	Sample uses :
		window.opener.obj1.InsertImage(...[params]...)
		window.opener.obj1.UpdateImage(...[params]...)
		inpImgURL.value = window.opener.obj1.imgSrc()
	
	Note: obj1 is the editor object.
	We use window.opener since we access the object from the new opened window.
	If we implement more than 1 editor, we need to get first the current 
	active editor. This can be done using :
	
		oName=window.opener.oUtil.oName // return "obj1" (for example)
		obj = eval("window.opener."+oName) //get the editor object
		
	then we can use :
		obj.InsertImage(...[params]...)
		obj.UpdateImage(...[params]...)
		inpImgURL.value = obj.imgSrc()
		
***************************************************/	
function checkImage()
	{
	oName=window.opener.oUtil.oName
	obj = eval("window.opener."+oName)
	
	if (obj.imgSrc()!="") selectImage(obj.imgSrc())//preview image
	inpImgURL.value = obj.imgSrc()
	inpImgAlt.value = obj.imgAlt()
	inpImgAlign.value = obj.imgAlign()
	inpImgBorder.value = obj.imgBorder()
	inpImgWidth.value = obj.imgWidth()
	inpImgHeight.value = obj.imgHeight()
	inpHSpace.value = obj.imgHspace()
	inpVSpace.value = obj.imgVspace()

	if (obj.imgSrc()!="") //If image is selected 
		btnImgUpdate.style.display="block";
	else
		btnImgInsert.style.display="block";
	}
function UpdateImage()
	{
	oName=window.opener.oUtil.oName
	eval("window.opener."+oName).UpdateImage(inpImgURL.value,inpImgAlt.value,inpImgAlign.value,inpImgBorder.value,inpImgWidth.value,inpImgHeight.value,inpHSpace.value,inpVSpace.value);	
	}
function InsertImage()
	{
	oName=window.opener.oUtil.oName
	eval("window.opener."+oName).InsertImage(inpImgURL.value,inpImgAlt.value,inpImgAlign.value,inpImgBorder.value,inpImgWidth.value,inpImgHeight.value,inpHSpace.value,inpVSpace.value);
	}	
/***************************************************/
</script>
<input type=text style="display:none;" id="inpActiveEditor" name="inpActiveEditor" contentEditable=true>
</body>
</html>
