<?php

class Controller_Menu extends Controller {
	
	function __construct(){
		
		$this->model = new Model_Menu();
		$this->view = new View();
		
	}

	function action_index() {

		$errors = [];
		
			if (isset ($_COOKIE['errors'])) {
				
				$strErrors = $_COOKIE['errors'];
				
				$errors = unserialize($strErrors);
				
				setcookie('errors', '', time() - 3600);
				
			}

		$data = $this->model->get_data();
		$this->view->generate('menu_view.php', 'template_view.php', $title = 'Пожирашки у Михашки', $data, $errors);
		
	}
}