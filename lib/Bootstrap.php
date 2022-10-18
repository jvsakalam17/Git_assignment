<?php

class Bootstrap
{

	function __construct()
	{
		//break URL and get all parameters
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, "/");
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = explode("/", $url);

		$url[0] = !empty($url[0]) ? $url[0] : 'main';
		$controller_file = MODULES . $url[0] . '/controller.php';

		if (file_exists($controller_file)) {
			require($controller_file);
		} else {
			return false;
		}

		$controller = new $url[0];
		$controller->load_model($url[0]);

		if (!empty($url[1])) {

			if (method_exists($controller, $url[1])) {

				if (count($url) > 1) {

					$params = '';
					for ($i = 1; $i < count($url); $i++) {
						$params = $url[$i] . ',';
					}

					$controller->{$url[1]}(substr($params, 0, strlen($params) - 1));
				} else {
					$controller->{$url[1]}();
				}
			} else {
				$this->error();
				return false;
			}
		} else {
			$controller->index();
		}
	}


	//error
	function error()
	{
		require(MODULES . 'error/controller.php');

		$controller = new Error();
		$controller->index();
		return false;
	}
}
