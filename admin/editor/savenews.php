<?php
// Document save script//
// $NMH - document body
   $NMH = trim($NMH);
   $NMH= stripslashes($NMH);
   $s_file = fopen ("./news/$c.txt", "w");
   fwrite ($s_file, "$NMH\n");
   fclose ($s_file);
   if (!$s_file) {
   echo "<div align='center'><font face='tahoma' size='2' color='#b94a48'>���� $c.txt - �� ��������!</font></div>
   <br>";
   }
   else {
   echo "<div align='center'><font face='tahoma' size='2' color='#0000ff'>���� $c.txt - ������� ��������!<br>
   <br>
   
   <a href='./index.php'>���������!</a>
   </font></div>
   <meta HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL='./index.php'\">";
    }
   
?>

