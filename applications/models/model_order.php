<?php
Class Model_Order extends Model {
	
	private $choose;
	
	function __construct () {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$this->choose = $_POST;
		}
	}

	public function get_data() {
		
		list ($errors, $input) = $this->validate ();

		if ($errors) {
				
			$strErrors = serialize($errors);
			setcookie('errors', $strErrors, time() + 3600);
			header("Location: http://restourant.com/menu");	
			
		} elseif (!$errors && $input) { 
		
			$ordered = $this->database_search ($input);
			$data = $this->process_finish($ordered, $input);
			
			return $data;
			
		}	 
	}
	
	private function validate () {
		
		$errors = [];
		$input = [];
		
		$trimmed = "\t\n\r\0\x0B\x00..\x1F\\s\\-?";
		
 		$input['firstName'] = trim(htmlentities($this->choose['firstName'] ?? ''), $trimmed);
		if (! strlen($input['firstName'])) {
			$errors['firstName'] = 'Введите корректное имя!';
		}

		$input['secondName'] = trim(htmlentities($this->choose['secondName'] ?? ''), $trimmed);
		if (! strlen($input['secondName'])) {
			$errors['secondName'] = 'Введите корректную фамилию!';
		}

		$input['dishes'] = $this->choose['dishes'] ?? array();
		if (count($input['dishes']) < 1) {
			$errors['dishes'] = 'Необходимо выбрать хотя-бы одну сладость!)';
		}

		$input['jams'] = $this->choose['jams'] ?? array();

		$input['drinks'] = $this->choose['drinks'] ?? array();
		
		$input['number'] = trim(htmlentities($this->choose['number'] ?? ''), $trimmed);
			if ($input['number'] == '') {
				$errors['number'] = 'Введите корректный номер телефона';
			}

		$input['delivery'] = $this->choose['delivery'] ?? '';
		if ($input['delivery'] == '') {
				$errors['delivery'] = 'Пожалуйста, выберите способ доставки';
		}

		if ($input['delivery'] == 'yes') {
			
			$input['street'] = trim(htmlentities($this->choose['street'] ?? ''), $trimmed);
			if ($input['street'] == '') {
				$errors['street'] = 'Пожалуйста, корректно введите название улицы';
			}
			$input['house'] = trim(htmlentities($this->choose['house'] ?? ''), $trimmed);
			if ($input['house'] == '') {
				$errors['house'] = 'Пожалуйста, введите номер дома';
			}
			$input['entrance'] = trim(htmlentities($this->choose['entrance'] ?? ''), $trimmed);
			
			$input['apartment'] = trim(htmlentities($this->choose['apartment'] ?? ''), $trimmed);
			if ($input['apartment'] == '') {
				$errors['apartment'] = 'Пожалуйста, введите номер квартиры';
			}
		} 

		return array ($errors, $input);
	}
	
	
	//Метод поиска имени и стоимости заказанных блюд по известному ID
	private function database_search ($choosed) {
		
		require_once 'applications/lib/db.php';
		
		/* Параметры для подключения к бд.
		$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=restourant;charset=utf8';
		$user = 'root';
		$pass = '';
		$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]; */
	
		$meals = new Get_data_db ();
		
		$input = $choosed;


		$selectedDishes = $input['dishes'];
		$selectedDrinks = $input['drinks'];
		$selectedJams = $input['jams'];
		
		
		foreach ($selectedDishes as $key => $value) {	
			$dishes[] = $meals->select_data("SELECT `name`, `cost` FROM `dishes` WHERE `id` ='" . $value . "'");
		}
		
		
		if (!$selectedDrinks == null) {
			foreach ($selectedDrinks as $key => $value) {
				$drinks [] = $meals->select_data("SELECT `name`, `cost` FROM `drinks` WHERE `id` ='" . $value . "'");
			}
		} else {
			$drinks = [];
		}
		
		
		if (!$selectedJams == null) {
			foreach ($selectedJams as $key => $value) {
				$jams [] = $meals->select_data("SELECT `name`, `cost` FROM `jams` WHERE `id` ='" . $value . "'");
			}
		} else {
			$jams = [];
		}
		
		
		$ordered = array_merge($dishes, $jams, $drinks);
		$meals = null;
		
		return ($ordered);
		
	}
	
	
	//Компановка сообщений отправляемого на почту исполнителя и выводимого на экран заказчику, со всей информацией
	private function process_finish ($value, $input) {
		
		$ordered = $value;
		$numArr = count($ordered) - 1;
		
		$meals = [];
		$name = [];
		$sumCost = 0;
		
		//$type - переменная, для распознавания функцией send_mail(), какой будет запрос
		$type = [];
		//Подключение файла с функцией отправки сообщения с заказом диллеру
		require_once 'applications/core/phpmailer/send_mail.php';
		
		
		//Формирование массива с блюдами и подсчет их стоимости 
		for ($t=0; $t <= $numArr; $t++) {
			
			$meals[] = $ordered[$t][0]['name'];
			$sumCost += $ordered[$t][0]['cost'];
			
		}
		
		$name['firstName'] = $input['firstName'];
		$name['secondName'] = $input['secondName'];
		
		if ($input['delivery'] == 'yes' && $input['entrance']) {
			
			$text = "<br> Заказано: <ul><li>" . implode('</li><li>', $meals) .
					"</li></ul>На сумму {$sumCost} грн.<br> 
					Номер телефона: {$input['number']}.<br> 
					Адрес: ул. {$input['street']}, дом {$input['house']},
					кв. {$input['apartment']}, парадная {$input['entrance']}";
			
			$error = send_mail ($name['firstName'], $type, $text, $name['secondName']);
			
			$delivery = "Ваш заказ будет готов и доставлен по адресу: ул. " . $input['street'] . ", " 
						. $input['house'] . ", кв " . $input['apartment'] . ", через N минут.
						Наш оператор свяжется с Вами по телефону через пару минут для уточнения заказа.
						Спасибо, что воспользовались нашими услугами. До встречи и приятного аппетита!";
			
		} 
		if ($input['delivery'] == 'yes' && !$input['entrance']) {
			
			$text = "<br> Заказано: <ul><li>" . implode('</li><li>', $meals) .
					"</li></ul>На сумму {$sumCost} грн.<br> 
					Номер телефона: {$input['number']}.<br> 
					Адрес: ул. {$input['street']}, дом {$input['house']}, 
					кв. {$input['apartment']}. Подъезд не указан (уточнить)";
			
			$error = send_mail ($name['firstName'], $type, $text, $name['secondName']);
			
			$delivery = "Ваш заказ будет готов и доставлен по адресу: ул. " . $input['street'] . ", " 
						. $input['house'] . ", кв " . $input['apartment'] . ", через N минут.
						Наш оператор свяжется с Вами по телефону через пару минут для уточнения заказа.
						Спасибо, что воспользовались нашими услугами. До встречи и приятного аппетита!";
						
		} 
		if ($input['delivery'] == 'no') {
			
			$text = "<br> Заказано: <ul><li>" . implode('</li><li>', $meals) .
					"</li></ul>На сумму {$sumCost} грн.<br> 
					Номер телефона: {$input['number']}.<br> Самовывоз из ресторана.";
				
			$error = send_mail ($name['firstName'], $type, $text, $name['secondName']);
			
			$delivery = "Вы выбрали самовывоз. Ждем Вас по адресу N.
						Заказ будет готов, примерно, через N минут.
						Спасибо, что воспользовались нашими услугами. До встречи и приятного аппетита!";
		}
		
		return array($meals, $sumCost, $name, $delivery, $error);
		
	}
} 