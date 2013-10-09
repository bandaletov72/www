<?php
//настройки qiwi
$QW_ERRORS=Array (
0=>"Операция прошла успешно",
13=>"Сервер занят, повторите запрос позже",
150=>"Ошибка авторизации (неверный логин/пароль)",
210=>"Счет не найден",
215=>"Счет с таким txn-id уже существует",
241=>"Сумма слишком мала",
242=>"Превышена максимальная сумма платежа – 15 000р.",
278=>"Превышение максимального интервала получения списка счетов",
298=>"Агента не существует в системе",
300=>"Неизвестная ошибка",
330=>"Ошибка шифрования",
370=>"Превышено максимальное кол-во одновременно выполняемых запросов",
);

require ("../templates/qiwi.inc");


// Выписываем qiwi счёт для покупателя

        if ($_GET['qiwi_telephone'] != "") {

        require_once('../payment_modules/nusoap.php');

            $client = new nusoap_client("https://mobw.ru/services/ishop", false); // создаем клиента для отправки запроса на QIWI
            $error = $client->getError();

            if ( !empty($error) ) {
            // обрабатываем возможные ошибки и в случае их возникновения откатываем транзакцию в своей системе
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>$error</body></html>";
            exit();
            }

            $client->useHTTPPersistentConnection();

            // Параметры для передачи данных о платеже:
            // login - Ваш ID в системе QIWI
            // password - Ваш пароль
            // user - Телефон покупателя (10 символов, например 916820XXXX)
            // amount - Сумма платежа в рублях
            // comment - Комментарий, который пользователь увидит в своем личном кабинете или платежном автомате
            // txn - Наш внутренний уникальный номер транзакции
            // lifetime - Время жизни платежа до его автоматической отмены
            // alarm - Оповещать ли клиента через СМС или звонком о выписанном счете
            // create - 0 - только для зарегистрированных пользователей QIWI, 1 - для всех
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

            // собственно запрос:
            $result = $client->call('createBill', $params, "https://ishop.qiwi.ru/services/ishop/");

            if ($client->fault) {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>Ошибка авторизации</body></html>";
            exit();
            } else {
            $err = $client->getError();
            if ($err) {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>$err</body></html>";
            exit();
            } else {
            if ($result==0) {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body><h4>Счет на оплату Вам отправлен в QIWI</h4>Смотрите во вкладке СЧЕТА в системе QIWI.<br>Счет <b>#".doubleval($_GET['txn'])."</b> действителен в течении <b>14 дней</b> со дня выставления.<br>Убедительная просьба не откладывать оплату счета. Пополнить свой QIWI кошелек Вы можете в любых QIWI терминалах.<br>".$QW_ERRORS[$result]."<br><b>Пожалуйста! Не обновляйте эту страницу страницу!</b><br><br><a href=\"https://w.qiwi.ru/orders.action\"><button>Перейти в личный кабинет QIWI для оплаты счета</button></a></body></html>";
            exit;
            } else {
            echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>QIWI: Ошибка $result<br><br>
".$QW_ERRORS[$result]."</body></html>";
            exit;

            }
            }
            }

        } else {
        echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=windows-1251\"></head><body>Не указан номер моб. телефона!</body></html>";
        }


?>
