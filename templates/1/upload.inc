<?php
$radio_count+=1;
$mkd=@$details[1];
if ($details[1]!="") {
if (is_dir ("./gallery/users")==FALSE){ @mkdir("./gallery/users", 0755); }

if (is_dir ("./gallery/users/".$details[1])==FALSE) {
@mkdir("./gallery/users/".$details[1], 0755);
}

} else {
if (is_dir ("./gallery/users")==FALSE){ @mkdir("./gallery/users", 0755); }
$mkd="_"; if (is_dir ("./gallery/users/_")==FALSE) {
@mkdir("./gallery/users/_", 0755);
}
}
$upload= "<div id=\"compfiles\"></div>
<script type=\"text/javascript\" src=\"/uploadify/swfobject.js\"></script>
<script type=\"text/javascript\" src=\"/uploadify/jquery.uploadify.v2.1.4.js\"></script>
<script type=\"text/javascript\">
var aos=0;
				\$(function() {
				\$('#custom_file_upload').uploadify({
  'uploader'       : '/uploadify/uploadify.swf',
  'script'         : '/uploadify/uploadify.php',
  'cancelImg'      : '/uploadify/cancel.png',
  'folder'         : '/gallery/users/".$mkd."',
  'multi'          : true,
  'auto'           : true,
  'fileExt'        : '*.jpg;*.gif;*.png;*.cdr;*.ai;*.pdf;*.zip',
  'fileDesc'       : 'Image Files and ZIP-Archives (.JPG, .GIF, .PNG, .CDR, .AI, .ZIP, .PDF)',
  'queueID'        : 'custom-queue',
  'queueSizeLimit' : 3,
  'simUploadLimit' : 3,
  'removeCompleted': false,
  'onComplete'  : function(event, ID, fileObj, response, data) {
  if (aos<=10) {  	var zao='ao'+aos
      document.getElementById(zao).value=response+'^0^';
            aos+=1;  }  else { window.alert('Max=10'); return; }
    },
  'onSelectOnce'   : function(event,data) {
      \$('#status-message').text(data.filesSelected + ' files have been added to the queue.');
    },
  'onAllComplete'  : function(event,data) {
      \$('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');
    }
});			});
				</script>
<div class=\"demo-box\">
        <b><div id=\"status-message\"></div></b><br>
<div id=\"custom-queue\"></div>
<input id=\"custom_file_upload\" type=\"file\" name=\"Filedata\" /></div>
      </div>
      </div>
</div>
<input type=hidden id=ao0 name=\"ao[".($radio_count+1)."]\" value=\"\">
<input type=hidden id=ao1 name=\"ao[".($radio_count+2)."]\" value=\"\">
<input type=hidden id=ao2 name=\"ao[".($radio_count+3)."]\" value=\"\">
<input type=hidden id=ao3 name=\"ao[".($radio_count+4)."]\" value=\"\">
<input type=hidden id=ao4 name=\"ao[".($radio_count+5)."]\" value=\"\">
<input type=hidden id=ao5 name=\"ao[".($radio_count+6)."]\" value=\"\">
<input type=hidden id=ao6 name=\"ao[".($radio_count+7)."]\" value=\"\">
<input type=hidden id=ao7 name=\"ao[".($radio_count+8)."]\" value=\"\">
<input type=hidden id=ao8 name=\"ao[".($radio_count+9)."]\" value=\"\">
<input type=hidden id=ao9 name=\"ao[".($radio_count+10)."]\" value=\"\">
<input type=hidden id=ao10 name=\"ao[".($radio_count+11)."]\" value=\"\">
";
$radio_count+=10
?>
