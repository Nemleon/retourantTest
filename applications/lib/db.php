<?php
Class Db_connect {

	//Переменные, установленные по умолчанию для входа в БД
	private $dsn;
	private $user;
	private $pass;
	private $options;

	//Получение значений для входа в опеределенные сервер/БД, если их несколько
	function __construct ($dsn = 'mysql:host=127.0.0.1;port=3306;dbname=restourant;charset=utf8',  $user = 'root', $pass = '', $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]) {

		$this->dsn = $dsn;
		$this->user = $user;
		$this->pass = $pass;
		$this->options = $options;

	}

	//Метод подключения к базе данных
	protected function db_connect() {
		require_once 'applications/core/errors_log/errors_log.php';
		try {
			$DBH = new PDO ($this->dsn, $this->user, $this->pass, $this->options);
			set_time_limit(25);
		} catch (PDOException $e) {
			$time = date('Y-m-d H:i:s (T)') . "\n";
			$error = $e . "\r\n";
			write_errors($time, $error);
			header('Location:http://'.$_SERVER['HTTP_HOST'].'/connecterr');
		}
		return $DBH;
	}

}


Class Get_data_db extends Db_connect {

	//Функция выборки значений из базы данных в массив
	//$row -  переменная, передающая функции информацию - с какой таблицы переписывать данные
	public function select_data ($row) {
		$selectData = parent::db_connect()->query($row);
		while ($result = $selectData->fetch()) {
			$array[] = $result;
		}
		$selectData = null;
		return $array;
	}
}