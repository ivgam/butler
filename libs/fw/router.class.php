<?php

class Fw_Router {

	public static function getRoute($url=false) {
		$url = isset($url)?$url:$_SERVER['REQUEST_URI'];		
		$url = str_replace(BASE_URI, '', $url);
		$url = (strpos($url, '?'))?strstr($url, '?', true):$url;
		$parts = explode('/', $url);
		$resource = (isset($parts[0]))?$parts[0]:false;
		$controller = $resource.'_controller';
		$task = (isset($parts[1]))?$parts[1]:false;
		if ((class_exists($controller) && method_exists($controller, $task))
		  ||(file_exists(VIEWS_PATH . DS . $resource . DS . $task . '.php'))
			){
			return 
				array(
						'controller'=>$controller, 
						'task'=>$task,
						'resource'=>$resource,
						'cacheable'=>false,
						'params'=>array('id'=>(isset($parts[2]))?$parts[2]:false)
				);
		}		
		$routes = Fw_Register::getRef('routes');
		foreach ($routes as $route){
			if(preg_match($route['regex'], $url, $matches)){				
				unset($matches[0]);
				$i = 1;
				foreach($route['params'] as $k=>$v){
					$route['params'][$k] = isset($matches[$i])?$matches[$i]:$v;
					$i++;
				}				
				return 
					array(
						'controller'=>$route['controller'], 
						'task'=>$route['task'],
						'resource'=>$route['resource'],
						'cacheable'=>$route['cacheable'],
						'params'=>$route['params']
					);
			}
		}
	}

	public static function getUrl($resource, $task) {				
		$controller = $resource.'_controller';		
		if (class_exists($controller) && method_exists($controller, $task)){			
			return BASE_URI.$resource.'/'.$task.'/';
		}		
		$routes = Fw_Register::getRef('routes');
		foreach ($routes as $route) {
			//CC-> Current Controller
			//SC-> Search Controller
			$cc = strtolower($route['controller']);
			$sc = strtolower($controller).'_controller';
			//CT-> Current Task
			//ST-> Search Task
			$ct = strtolower($route['task']);
			$st = strtolower($task);
			if ($cc == $sc && $ct == $st) {
				return $route['url'];
			}
		}
	}
	
	public static function redirect($resource, $task, $params=array()){
		$querystring = '';
		foreach ($params as $param){
			$querystring .= $param.'/';
		}
		header('Location: '.self::getUrl($resource, $task).$querystring);
		exit();
	}
}

?>