<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 'On');
define('ENVIRONMENT'	, 'test');

//Define paths
define('DS'				, DIRECTORY_SEPARATOR);
define('PUBLIC_PATH'	, dirname(__FILE__));
define('APP_PATH'		, PUBLIC_PATH . DS . '..' . DS . 'app');
define('LIBS_PATH'		, PUBLIC_PATH . DS . '..' . DS . 'libs');

define('JS_PATH'		, PUBLIC_PATH . DS . 'javascripts');
define('CSS_PATH'		, PUBLIC_PATH . DS . 'stylesheets');
define('IMG_PATH'		, PUBLIC_PATH . DS . 'images');

define('BASE_URI'		, str_replace('index.php', '', str_replace('public/', '', $_SERVER['SCRIPT_NAME'])));
define('PUBLIC_URI'		, (($_SERVER['SCRIPT_NAME'] != '/index.php')?BASE_URI . 'public/':BASE_URI));
define('JS_URI'			, PUBLIC_URI . 'javascripts/');
define('CSS_URI'		, PUBLIC_URI . 'stylesheets/');
define('IMG_URI'		, PUBLIC_URI . 'images/');

define('CONTROLLERS_PATH'	, APP_PATH . DS . 'controllers');
define('CONFIG_PATH'		, APP_PATH . DS . 'config');
define('HELPERS_PATH'		, APP_PATH . DS . 'helpers');
define('MODULES_PATH'		, APP_PATH . DS . 'modules');
define('LAYOUTS_PATH'		, APP_PATH . DS . 'layouts');
define('LOGS_PATH'			, APP_PATH . DS . 'logs');
define('MODELS_PATH'		, APP_PATH . DS . 'models');
define('VIEWS_PATH'			, APP_PATH . DS . 'views');
define('CACHE_PATH'			, APP_PATH . DS . 'cache');
define('MAIL_ATT_PATH'		, APP_PATH . DS . 'emails'.DS.'attachments');
define('MAIL_TPL_PATH'		, APP_PATH . DS . 'emails'.DS.'templates');
define('MAIL_TXT_PATH'		, APP_PATH . DS . 'emails'.DS.'texts');

define('UPLOAD_PATH'	, PUBLIC_PATH.DS.'tmp');
define('UPLOAD_URI'		, BASE_URI.'tmp');

define('LIBS_ON', 'Fw');

//Include de autoload file and init it
require_once(CONFIG_PATH . DS . 'autoloader.php');
Fw_Register::setRef('ini_time', microtime());
//Include de bootstrap file and init the application
require_once(APP_PATH . DS . 'bootstrap.php');
$init_errors = new Bootstrap();
if(strpos($_SERVER['REQUEST_URI'], 'index.php')){
	header("HTTP/1.1 301 Moved Permanently");
	header("Location: ".BASE_URL);
	exit();
}
Fw_Dispatcher::dispatch($_SERVER['REQUEST_URI']);
?>