<?php

class Controller_connecterr extends Controller {

	function action_index()
	{	
		$this->view->generate('connecterr_view.php', 'template_view.php', $title = 'Оишбка соединения');
	}
}