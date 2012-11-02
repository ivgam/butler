<?php

class Bootstrap {

	public function __construct() {
		$methods = get_class_methods($this);
		foreach ($methods as $method) {
			if (strpos($method, 'init_') === 0) {
				$this->$method();
			}
		}
	}

	private function init_app() {		
		define('CACHE_MODE', false);
		define('DEBUG_MODE', false);
		define('LOG_QUERYS', false);
		define('MINIFY_JS', false);
		define('MINIFY_CSS', false);
		define('ENVIRONMENT', 'test');
		
		$conf = parse_ini_file(CONFIG_PATH . DS . 'configuration.ini', true);
		$conf_array = array();
		foreach ($conf['config'] as $k => $v)		{$conf_array[$k] = $v;}
		foreach ($conf[ENVIRONMENT] as $k => $v){$conf_array[$k] = $v;}
		Fw_Register::setRef('config', $conf_array);		

		if (isset($_COOKIE['user'])) {
			list($md5_username, $pwd) = explode('&&&&', $_COOKIE['user']);
			$oModel = new User_Model();
			$oUser = $oModel->getUser($md5_username, $pwd);	
			Fw_Register::setRef('user', $oUser);		
		}
	}

	private function init_i18n(){
		$locale = 'es_ES';
		$domain = 'messages';
		putenv('LANG='.$locale);
		setlocale(LC_ALL, $locale);		
		bindtextdomain($domain, APP_PATH.DS.'i18n');
		textdomain($domain);
		bind_textdomain_codeset($domain, 'UTF-8');	
	}

	private function init_debug_toolbar(){
		if(DEBUG_MODE){
			function Fw_ErrorHandler($errno, $errstr, $errfile, $errline)
			{
			    if (!(error_reporting() & $errno)) {
			        return;
			    }

			    switch ($errno) {
			    case E_USER_ERROR:
			    case E_ERROR:		    	
			    	Fw_Register::addInRef('error', array('number'=>$errno, 'message'=>$errstr,'file'=>$errfile,'line'=>$errline));		        
			        exit(1);
			        break;

			    case E_USER_WARNING:
			    case E_WARNING:		    	
			        Fw_Register::addInRef('warning', array('number'=>$errno, 'message'=>$errstr,'file'=>$errfile,'line'=>$errline));
			        break;

			    case E_USER_NOTICE:
			    case E_NOTICE:		   		
			        Fw_Register::addInRef('notice', array('number'=>$errno, 'message'=>$errstr,'file'=>$errfile,'line'=>$errline));
			        break;

			    default:		    	
			        Fw_Register::addInRef('other', array('number'=>$errno, 'message'=>$errstr,'file'=>$errfile,'line'=>$errline));
			        break;
			    }
			    
			    return true;
			}
			set_error_handler('Fw_ErrorHandler');
		}
	}


	private function init_external_libs(){
		require_once(LIBS_PATH.DS.'krumo'.DS.'class.krumo.php');
	}

	private function init_routes() {
		require_once CONFIG_PATH . DS . 'routes.php';
		Fw_Register::setRef('routes', $routes);
	}

	private function init_acl() {
		$acl = parse_ini_file(CONFIG_PATH . DS . 'acl.ini', true);
		$chain = Fw_Acl::parseAcl($acl);
		Fw_Register::setRef('acl', $chain);
	}

	private function init_database() {
		$oDb = Fw_Db::getInstance('local');		
	}
	
	private function init_admin(){
		$oUser = Fw_Register::getRef('user');
		if($oUser['usertype'] == 'admin'){
			$crud_controllers = array();
			$acl = Fw_Register::getRef('acl');
			foreach($acl[$oUser['usertype']] as $controller=>$access){
				if(isset($access['all']) && class_exists($controller.'_controller')){
					if(is_subclass_of($controller.'_controller','Fw_CrudController')){
						$crud_controllers[] = $controller;
					}
				}
			}
			Fw_Register::setRef('crud_controllers', $crud_controllers);
		}
	}
	private function init_scripts_and_styles(){
		include CONFIG_PATH.DS.'frontscripts.php';
		include CONFIG_PATH.DS.'backscripts.php';
		include CONFIG_PATH.DS.'frontstyles.php';
		include CONFIG_PATH.DS.'backstyles.php';
	}

}

?>