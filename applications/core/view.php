<?php

class View {

	function generate($contentView, $templateView, $title = 'Пожирашки у Михашки', $data = null, $errors = null)
	{

		include 'applications/views/' . $templateView;
		
	}
}
