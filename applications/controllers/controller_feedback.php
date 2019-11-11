<?php

class Controller_Feedback extends Controller {
	
	function __construct(){
		
		$this->model = new Model_Feedback();
		$this->view = new View();
		
	}
	
	function action_index()
	{	
		$var = $this->model->get_data();
		
		if (is_array ($var)) {
			$data = [];
			$errors = $var;
		} else {
			$data = $var;
			$errors = [];
		}
		$this->view->generate('feedback_view.php', 'template_view.php', $title = 'Обратная связь', $data, $errors);
	}
}