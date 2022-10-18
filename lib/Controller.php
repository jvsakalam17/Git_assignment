<?php

class Controller
{

	function __construct()
	{
		$this->view = new View();
	}

	public function load_model($model_name)
	{ //load the models from the models folder according to the called filename
		$file_name = MODULES . $model_name . '/model.php';

		if (file_exists($file_name)) {
			require($file_name);

			$new_model_name = ucwords($model_name) . '_Model';

			$this->model = new $new_model_name();
		}
	}
}
