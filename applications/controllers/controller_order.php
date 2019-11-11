<?php

class Controller_Order extends Controller {
	
	function __construct(){
		
		$this->model = new Model_Order();
		$this->view = new View();
		
	}

	function action_index() {	
	
		$data = $this->model->get_data();
		$this->view->generate('order_view.php', 'template_view.php', $title = 'Ваш заказ', $data);
		
	}
}