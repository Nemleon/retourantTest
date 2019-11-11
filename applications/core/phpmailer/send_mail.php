<?php
function send_mail ($nameOf, $typeOf, $textOf, $secondNameOf = []) {
	// Файлы phpmailer
	require_once 'applications/core/phpmailer/PHPMailer.php';
	require_once 'applications/core/phpmailer/SMTP.php';
	require_once 'applications/core/phpmailer/Exception.php';
	require_once 'applications/core/errors_log/errors_log.php';

	// Переменные, которые отправляет пользователь
	$name = $nameOf;

	//В переменной $type передается название почты отправителя фидбека в функцию.
	//Если переменная была передана пустой (null) - значит это заказ
	if ($typeOf) {
		$type = $typeOf;
	} else {
		$type = 'Заказ';
	}

	$secondName = $secondNameOf;

	$text = $textOf;

	$mail = new PHPMailer\PHPMailer\PHPMailer();

	try {
		if ($type == 'Заказ') {
			$data = [];
		} elseif ($type == $typeOf) {
			$data = "Сообщение отправлено! Спасибо за отзыв, {$name}!)";
		}
		$mail->isSMTP();
		$mail->CharSet = "UTF-8";
		$mail->SMTPAuth   = true;

		// Настройки вашей почты
		$mail->Host       = 'smtp.gmail.com'; // SMTP сервера GMAIL
		$mail->Username   = ''; // Логин на почте
		$mail->Password   = ''; // Пароль на почте
		$mail->SMTPSecure = 'ssl';
		$mail->Port       = 465;
		$mail->setFrom(''); // Адрес самой почты и имя отправителя

		// Получатель письма
		$mail->addAddress('');  
		//$mail->addAddress('youremail@gmail.com');

		// Само письмо

		$mail->isHTML(true);
		if ($type == 'Заказ') {
			$mail->Subject = $type;
			$mail->Body    = "<b>Имя заказчика:</b> {$name} {$secondName} <br>
							 <b>Информация:</b><br>{$text}";

		} elseif ($type == $typeOf) {
			$mail->Subject = "Отзыв";
			$mail->Body    = "<b>Имя:</b> {$name} <br>
							 <b>Отправитель:</b> {$type}<br><br>
							 <b>Сообщение:</b><br>{$text}";
		}
		// Проверяем отравленность сообщения
		if ($mail->send()) {
			return $data;
		} else {
			if ($type == 'Заказ') {
				throw new Exception ("Произошла ошибка в системе. В данный момент невозможно принять заказ через сайт. Мы уже решаем проблему!");
			} elseif ($type == $typeOf) {
				throw new Exception ("Сообщение не было отправлено: проблемы с сервисом. Попробуйте позже, решение проблемы в процессе!");
			}
		}
	} catch (Exception $e) {
		$time = date('Y-m-d H:i:s (T)') . "\n";
		$error = $mail->ErrorInfo;
		write_errors($time, $error);
		$data = $e->getMessage();
		return $data;
	}

}
