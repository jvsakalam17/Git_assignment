<?php
session_start();
require('conf.php');

spl_autoload_register(function ($class_name) {
	if (file_exists('lib/' . $class_name . '.php')) {
		require('lib/' . $class_name . '.php');
	}
});

$app = new Bootstrap();
