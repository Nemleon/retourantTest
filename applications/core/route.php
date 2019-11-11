<?php
Class Route {
	
 	public static function start () {
	
		//Установка контроллера и действия по умолчанию
		$controllerName = 'Menu';
		$actionName = 'index';
	
		//Получение имён контроллера и действия из глобальной переменной
		//routes[0] - пустой
		$routes = explode('/', $_SERVER['REQUEST_URI']);
	
		if (!empty ($routes[1])) {
			$controllerName = $routes[1];
		}
	
		if (!empty ($routes[2])) {
			$actionName = $routes[2];
		}

	
		//Добавление приставки, для использования далее классов
		$modelName = 'Model_' . $controllerName;
		$controllerName = 'Controller_' . $controllerName;
		$actionName = 'action_' . $actionName;
		
		//Подключение файла с классом метода (может и не существовать)
		$modelFile = strtolower($modelName).'.php';
		$modelPath = "applications/models/".$modelFile;
		if(file_exists($modelPath) || $modelPath == '') {
			require_once "applications/models/".$modelFile;
		}
	
		
		//Подключение файла с классом контроллера и перехват
		//неожиданных  ошибок, пропущенных в bootstrap.php
		
		$controllerFile = strtolower($controllerName) . '.php';
		$controllerPath = 'applications/controllers/' . $controllerFile;

		if (file_exists($controllerPath)) {
			try {
			require_once 'applications/controllers/' . $controllerFile;
			} catch (Exception $e) {
				header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
				header("Status: 404 Not Found");
				header('Location:' . $e->getMessage() . '404');
			}
		} else {
			throw new Exception ('http://'.$_SERVER['HTTP_HOST'].'/');
		}
		
		$controller = new $controllerName;
		$action = $actionName;
		
		if (method_exists($controller, $action)) {
			try {
			$controller->$action();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		} else {
			throw new Exception ('Как вообще це произошло?!');
		}
	}

} 