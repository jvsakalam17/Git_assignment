<?php

/**
 * Configuration file. 
 * ** WARNING ** 
 *  Editing this file will cause system errors.
 * 	Please avoid editing this file directly. Use the .env file instead.
 * 
 */

parseAndDefineEnvfile();
setEnvironment();
// paths
define('LIB', 'lib/');
define('MODULES', 'pages/');
define('CONFIG', 'conf/');
define('TEMPLATE', 'tpl/default/');
define('TEMPLATE_MOBILE', 'tpl/mobile/');
define('PUBLIC_DIR', 'public/');
define('JS_DIR', PUBLIC_DIR . 'js/');
define('CSS_DIR', PUBLIC_DIR . 'css/');
define('IMAGES', PUBLIC_DIR . 'images/');
define('MEDIA', PUBLIC_DIR . 'media/');
define('PDF_FONTS', PUBLIC_DIR . 'pdf_fonts/');
define('STATIC_CONTENTS', PUBLIC_DIR . 'static_contents/');
define('LOGOS', PUBLIC_DIR . 'logos/');
define('BANNER', PUBLIC_DIR . 'banner/');

// default parameters
define('NO_DATA', "-- Keine Angaben --");
define('NO_INFO', "---");
define('NO_DATA_HTML', '<span style="color:#b1b1b1">' . NO_DATA . '</span>');
define('KB', 1024);
define('MB', 1048576);
define('MAX_FILEUPLOAD', 10);

/**
 * Parse and constant define the env file
 * 
 * @return void 
 */
function parseAndDefineEnvfile()
{
	$handle = fopen(".env", "r");
	if ($handle) {
		while (($line = fgets($handle)) !== false) {
			$config = explode("=", $line, 2);
			$key = "";
			$val = "";
			if (!isset($config[0]) || !isset($config[1])) {
				continue;
			}
			$key = $config[0];
			$val = $config[1];
			define(trim(strtoupper($key)), trim($val));
		}
		fclose($handle);
	} else {
		die("Error opening env file.");
	}
}

/**
 * Set the application environment errors logging
 * 
 * @return void 
 */
function setEnvironment()
{
	switch (APP_ENV) {
		case 'production':
			error_reporting(0);
			break;
		case 'staging':
			error_reporting(0);
			break;
		case 'testing':
			ini_set('display_startup_errors', 1);
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
			break;
		case 'local':
			error_reporting(0);
			break;
		case 'development':
			ini_set('display_startup_errors', 1);
			ini_set('display_errors', 1);
			error_reporting(E_ALL);
			break;
		default:
			break;
	}
}
