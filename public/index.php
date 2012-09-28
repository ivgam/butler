<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 'On');

//Define paths
define('DS'						, DIRECTORY_SEPARATOR);
define('PUBLIC_PATH'			, dirname(__FILE__));
define('APP_PATH'				, PUBLIC_PATH.DS.'..'.DS.'app');
define('LIBS_PATH'				, PUBLIC_PATH.DS.'..'.DS.'libs');

define('JS_PATH'				, PUBLIC_PATH.DS.'js');
define('CSS_PATH'				, PUBLIC_PATH.DS.'css');
define('IMG_PATH'				, PUBLIC_PATH.DS.'imgs');

define('BASE_URI'				, str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('JS_URI'					, BASE_URI.'js/');
define('CSS_URI'				, BASE_URI.'css/');
define('IMG_URI'				, BASE_URI.'images/');

define('CONTROLLERS_PATH'		, APP_PATH.DS.'controllers');
define('CONFIG_PATH'			, APP_PATH.DS.'config');
define('HELPERS_PATH'			, APP_PATH.DS.'helpers');
define('MODULES_PATH'			, APP_PATH.DS.'modules');
define('LAYOUTS_PATH'			, APP_PATH.DS.'layouts');
define('LOGS_PATH'				, APP_PATH.DS.'logs');
define('MODELS_PATH'			, APP_PATH.DS.'models');
define('VIEWS_PATH'				, APP_PATH.DS.'views');
define('CACHE_PATH'				, APP_PATH.DS.'cache');
define('LIBS_ON'				, 'Fw');

//Include de autoload file and init it
require_once(CONFIG_PATH.DS.'autoloader.php');
Fw_Register::setRef('ini_time', microtime());
//Include de bootstrap file and init the application
require_once(APP_PATH.DS.'bootstrap.php');
$init_errors = new Bootstrap();
Fw_Dispatcher::dispatch($_SERVER['REQUEST_URI']);
?>