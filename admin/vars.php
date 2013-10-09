<!DOCTYPE html><html>

<head>
<title>VARS</title>
</head>

<body>

<?php

echo "SERVER_NAME=\"".$_SERVER['SERVER_NAME']."\""; echo "<br>";
echo "realpath=\"".realpath($_SERVER['SCRIPT_NAME'])."\""; echo "<br>";
echo "dirname=\"".dirname($_SERVER['SCRIPT_NAME'])."\""; echo "<br>";
echo "basename=\"".basename($_SERVER['SCRIPT_NAME'])."\""; echo "<br>";
echo "SCRIPT_NAME=\"".$_SERVER['SCRIPT_NAME']."\""; echo "<br>";
echo "SCRIPT_FILENAME=\"".$_SERVER['PATH_TRANSLATED']."\""; echo "<br>";
echo "getcwd=\"".getcwd()."\""; echo "<br>";

?>

</body>

</html>
