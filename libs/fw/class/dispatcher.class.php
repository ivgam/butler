<?php

class Fw_Dispatcher {

	public static function dispatch($url) {
		$route = Fw_Router::getRoute($url);
		Fw_Register::setRef('current_resource', $route['resource']);
		Fw_Register::setRef('current_task', $route['task']);
		Fw_Register::setRef('current_controller', $route['controller']);
		Fw_Register::setRef('cacheable', $route['cacheable']);
		Fw_Filter::filter($route['params']);
		$params = Fw_Filter::getArray('params');
		$params_string = implode('_', $params);
		$cache_file = CACHE_PATH . DS . $route['controller'] . '_' . $route['task'] . '_' .
				date('d') . '_' . date('H') . '_p_' . $params_string . '.cache';
		if (CACHE_MODE && $route['cacheable'] && file_exists($cache_file)) {
			Request_Helper::updateLastRequest();
			Request_Helper::registerRequest();
			include $cache_file;
			echo '<!-- cache -->';
		} else {
			$controller = new $route['controller'];
			$html = $controller->getResponse($route['resource'], $route['task'], $params);
			if (CACHE_MODE && $route['cacheable']) {
				$handle = fopen($cache_file, 'w');
				fwrite($handle, $html);
				fclose($handle);
			}
			Request_Helper::updateLastRequest();
			Request_Helper::registerRequest();
			echo $html;
		}
		Fw_Register::setRef('end_time', microtime());
		if (DEBUG_MODE) {
			ob_start();
			include LIBS_PATH . DS . 'fw' . DS . 'inc' . DS . 'debugtoolbar.inc.php';
			$debug = ob_get_contents();
			ob_end_clean();
			echo $debug;
		}
	}

}

?>