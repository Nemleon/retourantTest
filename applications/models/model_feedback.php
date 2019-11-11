<?php
Class Model_Feedback extends Model {

	public function get_data() {
		
		$data = [];
		
		require_once 'applications/core/phpmailer/send_mail.php';
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
			list ($input, $errors) = $this->validate ();
			if ($errors) {
				
				$error = $errors;
				return $error;
				
			} elseif (!$errors && $input) { 
				
				$data = send_mail ($input['name'], $input['email'], $input['text']);
				return $data;

			}	
		}
		return $data;
	}
	
	private function validate () {
		
		$errors = [];
		$inputs = [];
		
		$trimmed = "\t\n\r\0\x0B\x00..\x1F\\s\\-?";
		
		$input['name'] = trim(htmlentities($_POST['name'] ?? ''), $trimmed);
		if (! strlen($input['name'])) {
			$errors['name'] = 'Введите имя!';
		} 
		
		$input['email'] = trim(htmlentities($_POST['email'] ?? ''), $trimmed);
		if (! strlen($input['email'])) {
			$errors['email'] = 'Введите Email!';
		} elseif (!preg_match("/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i", $input['email'])) {
			$errors['email'] = 'Неверный Email!';
		}
		
		$input['text'] = trim(htmlentities($_POST['text'] ?? ''), $trimmed);
		if (! strlen($input['text'])) {
			$errors['text'] = 'Введите сообщение';
		}
		
		return array ($input, $errors);
	}
}