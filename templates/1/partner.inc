<?php
//custom partner actions
if ($_SESSION["partner_id"]=="custom") {
//Sample
echo "<!-- QUATRIX Tracking Code Start -->
<script language=\"JavaScript\" type=\"text/javascript\" src=\"http://trc.quatrix.ru/action/?mHwCRmOLybOcOJq&script=1&order=(($nomer))&valuta=((RUR))&price=(($summaout))\"></script>
<noscript><img width=\"1\" height=\"1\" src=\"http://trc.quatrix.ru/action/?mHwCRmOLybOcOJq&script=0&order=(($nomer))&valuta=((RUR))&price=(($summaout))\"></noscript>
<!-- QUATRIX Tracking End -->";
$partner_mail="dpz@bk.ru";
}
?>
