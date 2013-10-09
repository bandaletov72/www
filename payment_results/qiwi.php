<?php
//��������� qiwi
$QW_ERRORS=Array (
0=>"�������� ������ �������",
13=>"������ �����, ��������� ������ �����",
150=>"������ ����������� (�������� �����/������)",
210=>"���� �� ������",
215=>"���� � ����� txn-id ��� ����������",
241=>"����� ������� ����",
242=>"��������� ������������ ����� ������� � 15 000�.",
278=>"���������� ������������� ��������� ��������� ������ ������",
298=>"������ �� ���������� � �������",
300=>"����������� ������",
330=>"������ ����������",
370=>"��������� ������������ ���-�� ������������ ����������� ��������",
);

require ("../templates/qiwi.inc");


// ���������� qiwi ���� ��� ����������

        if ($_GET['qiwi_telephone'] != "") {

        require_once('../payment_modules/nusoap.php');

            $client = new nusoap_client("https://mobw.ru/services/ishop", false); // ������� ������� ��� �������� ������� �� QIWI
            $error = $client->getError();

            if ( !empty($error) ) {
            // ������������ ��������� ������ � � ������ �� ������������� ���������� ���������� � ����� �������
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>$error</body></html>";
            exit();
            }

            $client->useHTTPPersistentConnection();

            // ��������� ��� �������� ������ � �������:
            // login - ��� ID � ������� QIWI
            // password - ��� ������
            // user - ������� ���������� (10 ��������, �������� 916820XXXX)
            // amount - ����� ������� � ������
            // comment - �����������, ������� ������������ ������ � ����� ������ �������� ��� ��������� ��������
            // txn - ��� ���������� ���������� ����� ����������
            // lifetime - ����� ����� ������� �� ��� �������������� ������
            // alarm - ��������� �� ������� ����� ��� ��� ������� � ���������� �����
            // create - 0 - ������ ��� ������������������ ������������� QIWI, 1 - ��� ����
            $params = array(
            'login' => $QIWI_ID,
            'password' => $QIWI_SECRET_KEY,
            'user' => $_GET['qiwi_telephone'],
            'amount' => number_format($_GET['total'],0,'',''),
            'comment' => rawurldecode($_GET['comment']),
            'txn' => $_GET['txn'],
            'lifetime' => date("d.m.Y H:i:s", strtotime("+2 weeks")),
            'alarm' => 1,
            'create' => 1
            );

            // ���������� ������:
            $result = $client->call('createBill', $params, "https://ishop.qiwi.ru/services/ishop/");

            if ($client->fault) {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>������ �����������</body></html>";
            exit();
            } else {
            $err = $client->getError();
            if ($err) {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>$err</body></html>";
            exit();
            } else {
            if ($result==0) {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body><h4>���� �� ������ ��� ��������� � QIWI</h4>�������� �� ������� ����� � ������� QIWI.<br>���� <b>#".doubleval($_GET['txn'])."</b> ������������ � ������� <b>14 ����</b> �� ��� �����������.<br>������������ ������� �� ����������� ������ �����. ��������� ���� QIWI ������� �� ������ � ����� QIWI ����������.<br>".$QW_ERRORS[$result]."<br><b>����������! �� ���������� ��� �������� ��������!</b><br><br><a href=\"https://w.qiwi.ru/orders.action\"><button>������� � ������ ������� QIWI ��� ������ �����</button></a></body></html>";
            exit;
            } else {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>QIWI: ������ $result<br><br>
".$QW_ERRORS[$result]."</body></html>";
            exit;

            }
            }
            }

        } else {
        echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>�� ������ ����� ���. ��������!</body></html>";
        }


?>
