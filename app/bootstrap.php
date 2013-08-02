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
		$conf = parse_ini_file(CONFIG_PATH . DS . 'configuration.ini', true);
		$conf_array = array();
		foreach ($conf['config'] as $k => $v) {
			$conf_array[$k] = $v;
		}
		foreach ($conf[ENVIRONMENT] as $k => $v) {
			$conf_array[$k] = $v;
		}
		Fw_Register::setRef('config', $conf_array);
	}

	private function init_environment() {
		
		define('COMPANY_NAME'			, Fw_Register::getConfig('fw_name'));
		define('SLOGAN'					, Fw_Register::getConfig('fw_slogan'));
		define('AUTHOR'					, Fw_Register::getConfig('fw_author'));
		define('AUTHOR_EMAIL'			, Fw_Register::getConfig('fw_auhtor_email'));
		define('GOOGLE_ANALYTICS_ID'	, Fw_Register::getConfig('google_analytics_id'));
		define('GOOGLE_ANALYTICS_DOMAIN', Fw_Register::getConfig('google_analytics_domain'));
		
		define('DB_INSTANCE'	, Fw_Register::getConfig('db_instance'));
		define('BASE_URL'		, Fw_Register::getConfig('base_url'));
		define('LOCALE'			, Fw_Register::getConfig('locale'));
		define('SERVICE_MODE'	, Fw_Register::getConfig('service_mode'));
		define('CACHE_MODE'		, Fw_Register::getConfig('cache_mode'));
		define('DEBUG_MODE'		, Fw_Register::getConfig('debug_mode'));
		define('LOG_QUERYS'		, Fw_Register::getConfig('log_querys'));
		define('MINIFY_JS'		, Fw_Register::getConfig('minify_js'));
		define('MINIFY_CSS'		, Fw_Register::getConfig('minify_css'));
		define('ITEMS_PER_PAGE'	, Fw_Register::getConfig('items_per_page'));
		$_REQUEST['p'] = (isset($_REQUEST['p'])) ? (int) $_REQUEST['p'] : 0;
		define('ITEMS_OFFSET', ITEMS_PER_PAGE * max(array(0, ($_REQUEST['p'] - 1))));
	}

	private function init_database() {
		$databases = parse_ini_file(CONFIG_PATH . DS . 'databases.ini', true);
		Fw_Register::setRef('databases', $databases);
	}

	private function init_states() {
		//CONTACT STATES
		define('CONTACT_PENDING', 1);
		define('CONTACT_CLOSED', 2);
		//LANDING CAMPAIGN STATES
		define('LANDING_CAMPAIGN_CREATED', 1);
		define('LANDING_CAMPAIGN_ENABLED', 2);
		define('LANDING_CAMPAIGN_DISABLED', 3);
	}

	private function init_types() {
		//USER TYPES
		define('USER_ADMIN', 1);
		define('USER_GUEST', 2);
	}

	private function init_sizes() {
		$sizes = array(
			'background' => array(2000, 1334),
			'product_slider' => array(770, 514),
			'category_slider' => array(690, 460),
			'product_grid' => array(280, 190),
			'category_grid' => array(267, 178),
			'city_thumb' => array(90, 40),
		);
		Fw_Register::setRef('sizes', $sizes);
	}

	private function init_i18n() {
		$locale = LOCALE;
		$domain = 'messages';
		putenv('LANG=' . $locale);
		setlocale(LC_ALL, $locale);
		bindtextdomain($domain, APP_PATH . DS . 'i18n');
		textdomain($domain);
		bind_textdomain_codeset($domain, 'UTF-8');
	}

	private function init_debug_toolbar() {
		if (DEBUG_MODE) {

			function Fw_ErrorHandler($errno, $errstr, $errfile, $errline) {
				if (!(error_reporting() & $errno)) {
					return;
				}

				switch ($errno) {
					case E_USER_ERROR:
					case E_ERROR:
						Fw_Register::addInRef('error', array('number' => $errno, 'message' => $errstr, 'file' => $errfile, 'line' => $errline));
						exit(1);
						break;

					case E_USER_WARNING:
					case E_WARNING:
						Fw_Register::addInRef('warning', array('number' => $errno, 'message' => $errstr, 'file' => $errfile, 'line' => $errline));
						break;

					case E_USER_NOTICE:
					case E_NOTICE:
						Fw_Register::addInRef('notice', array('number' => $errno, 'message' => $errstr, 'file' => $errfile, 'line' => $errline));
						break;

					default:
						Fw_Register::addInRef('other', array('number' => $errno, 'message' => $errstr, 'file' => $errfile, 'line' => $errline));
						break;
				}

				return true;
			}

			set_error_handler('Fw_ErrorHandler');
		}
	}

	private function init_external_libs() {
		require_once(LIBS_PATH . DS . 'krumo' . DS . 'class.krumo.php');
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

	private function init_scripts_and_styles() {
		include CONFIG_PATH . DS . 'frontscripts.php';
		include CONFIG_PATH . DS . 'backscripts.php';
		include CONFIG_PATH . DS . 'frontstyles.php';
		include CONFIG_PATH . DS . 'backstyles.php';
	}

	private function init_user() {
		if (isset($_COOKIE['user'])) {
			list($md5_username, $pwd) = explode('&&&&', $_COOKIE['user']);
			$oModel = new User_Model();
			$oUser = $oModel->getUser($md5_username, $pwd);
			Fw_Register::setRef('user', $oUser);
		}
		if (isset($_COOKIE['customer'])) {
			list($md5_email, $pwd) = explode('&&&&', $_COOKIE['customer']);
			$oModel = new Customer_Model();
			$oCustomer = $oModel->getCustomer($md5_email, $pwd);
			Fw_Register::setRef('customer', $oCustomer);
		}
	}

	private function init_admin() {
		$oUser = Fw_Register::getRef('user');
		if ($oUser['usertype'] == 'admin') {
			$crud_controllers = array();
			$acl = Fw_Register::getRef('acl');
			foreach ($acl[$oUser['usertype']] as $controller => $access) {
				if (isset($access['all']) && class_exists($controller . '_controller')) {
					if (is_subclass_of($controller . '_controller', 'Fw_CrudController')) {
						$crud_controllers[] = $controller;
					}
				}
			}
			Fw_Register::setRef('crud_controllers', $crud_controllers);
		}
	}

}

?>