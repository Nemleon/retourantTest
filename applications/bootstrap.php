<?php

// подключаем файлы ядра
spl_autoload_register(function ($class_name) {
	$file = 'applications/core/' . strtolower($class_name) . '.php';
	if(file_exists($file)){
		require_once $file;
	} else {
		throw new Exception('http://'.$_SERVER['HTTP_HOST'].'/');
	}
});


/* 
Запускаем маршрутизатор. Перехватываем ошибку, если страница не найдена,
и переадресовываем на страницу 404
*/

try {
Route::start();
} catch (Exception $e) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
	header("Status: 404 Not Found");
	header('Location:' . $e->getMessage() . '404');
}