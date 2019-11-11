<?php
Class Model_Menu extends Model {

	public function get_data() {

		require_once 'applications/lib/db.php';
		
		//Параметры для подключения к бд. При использовании, внести переменные в функцию Get_data_db () по порядку, через зяпятую
		
			/* $dsn = 'mysql:host=127.0.0.1;port=3306;dbname=restourant;charset=utf8';
			$user = 'root';
			$pass = '';
			$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]; */
	
		$meals = new Get_data_db ();

		/*
		Отправление функции select_data() информацию о таблицах.
		Запись полученных значений в предопределённые переменные.
		Отправка данных далее.
		*/
		$drinks = $meals->select_data("SELECT * FROM drinks");
		$dishes = $meals->select_data("SELECT * FROM dishes");
		$jams = $meals->select_data("SELECT * FROM jams");

		$meals = null;

    return array ($dishes, $drinks, $jams);
  }
}