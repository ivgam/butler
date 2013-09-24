<?php

class Fw_CCC {

	public static $aFrontJs = array();
	public static $aBackJs = array();
	public static $aFrontCss = array();
	public static $aBackCss = array();

	public static function addFrontJs($resource, $bRaw = false) {
		if ($bRaw) {
			self::$aFrontJs['raw'][md5($resource)] = $resource;
		} else {
			self::$aFrontJs['routes'][$resource] = $resource;
		}
	}

	public static function addBackJs($resource, $bRaw = false) {
		if ($bRaw) {
			self::$aBackJs['raw'][md5($resource)] = $resource;
		} else {
			self::$aBackJs['routes'][$resource] = $resource;
		}
	}

	public static function addFrontCss($resource, $bRaw = false) {
		if ($bRaw) {
			self::$aFrontCss['raw'][md5($resource)] = $resource;
		} else {
			self::$aFrontCss['routes'][$resource] = $resource;
		}
	}

	public static function addBackCss($resource, $bRaw = false) {
		if ($bRaw) {
			self::$aBackCss['raw'][md5($resource)] = $resource;
		} else {
			self::$aBackCss['routes'][$resource] = $resource;
		}
	}

	public static function getAllFrontJs() {
		$minified = false;
		if (MINIFY_JS) {
			$directory = JS_PATH . DS . 'generated' . DS . 'front';
			if (is_dir($directory) && $handler = opendir($directory)) {
				while (false !== ($entry = readdir($handler))) {
					if ($entry != '.' && $entry != '..') {
						preg_match('/.*[.](.*)/', $entry, $matches);
						if ($matches[1] == 'js') {
							echo '<script type="text/javascript" src="' . JS_URI . 'generated/front/' . $entry . '"></script>';
							$minified = true;
						}
					}
				}
			}
		}
		if (!$minified && isset(self::$aFrontJs['routes'])) {
			foreach (self::$aFrontJs['routes'] as $route) {
				echo '<script type="text/javascript" src="' . $route . '"></script>';
			}
		}
		if (isset(self::$aFrontJs['raw'])) {
			foreach (self::$aFrontJs['raw'] as $code) {
				echo $code;
			}
		}
	}

	public static function getAllFrontCss() {
		$minified = false;
		if (MINIFY_CSS) {
			$directory = CSS_PATH . DS . 'generated' . DS . 'front';
			if (is_dir($directory) && $handler = opendir($directory)) {
				while (false !== ($entry = readdir($handler))) {
					if ($entry != '.' && $entry != '..') {
						preg_match('/.*[.](.*)/', $entry, $matches);
						if ($matches[1] == 'css') {
							echo '<link rel="stylesheet" href="' . CSS_URI . 'generated/front/' . $entry . '"/>';
							$minified = true;
						}
					}
				}
			}
		}
		if (!$minified && isset(self::$aFrontCss['routes'])) {
			foreach (self::$aFrontCss['routes'] as $route) {
				echo '<link rel="stylesheet" href="' . $route . '"/>';
			}
		}
		if (isset(self::$aFrontCss['raw'])) {
			foreach (self::$aCss['raw'] as $code) {
				echo $code;
			}
		}
	}

	public static function getAllBackJs() {
		$minified = false;
//		if (MINIFY_JS) {
//			$directory = JS_PATH . DS . 'generated' . DS . 'back';
//			if (is_dir($directory) && $handler = opendir($directory)) {
//				while (false !== ($entry = readdir($handler))) {
//					if ($entry != '.' && $entry != '..') {
//						preg_match('/.*[.](.*)/', $entry, $matches);
//						if ($matches[1] == 'js') {
//							echo '<script type="text/javascript" src="' . JS_URI . 'generated/back/' . $entry . '"></script>';
//							$minified = true;
//						}
//					}
//				}
//			}
//		}
		if (!$minified && isset(self::$aBackJs['routes'])) {
			foreach (self::$aBackJs['routes'] as $route) {
				echo '<script type="text/javascript" src="' . $route . '"></script>';
			}
		}
		if (isset(self::$aFrontJs['raw'])) {
			foreach (self::$aFrontJs['raw'] as $code) {
				echo $code;
			}
		}
	}

	public static function getAllBackCss() {
		$minified = false;
//		if (MINIFY_CSS) {
//			$directory = CSS_PATH . DS . 'generated' . DS . 'back';
//			if (is_dir($directory) && $handler = opendir($directory)) {
//				while (false !== ($entry = readdir($handler))) {
//					if ($entry != '.' && $entry != '..') {
//						preg_match('/.*[.](.*)/', $entry, $matches);
//						if ($matches[1] == 'css') {
//							echo '<link rel="stylesheet" href="' . CSS_URI . 'generated/back/' . $entry . '"/>';
//							$minified = true;
//						}
//					}
//				}
//			}
//		}
		if (!$minified && isset(self::$aBackCss['routes'])) {
			foreach (self::$aBackCss['routes'] as $route) {
				echo '<link rel="stylesheet" href="' . $route . '"/>';
			}
		}
		if (isset(self::$aBackCss['raw'])) {
			foreach (self::$aCss['raw'] as $code) {
				echo $code;
			}
		}
	}

	public static function generateMinifyFrontJs() {
		Fw_ClearDirectory::clear(JS_PATH . DS . 'generated' . DS . 'front');
		include_once LIBS_PATH . DS . 'minify' . DS . 'jsmin.php';
		$handler = fopen(JS_PATH . DS . 'generated' . DS . 'front' . DS . md5(microtime()) . '.js', 'w');
		foreach (self::$aFrontJs['routes'] as $route) {
			$route = str_replace(PUBLIC_URI, '/', $route);
			if (strpos(PUBLIC_PATH, $route) === false) {
				$route = PUBLIC_PATH . $route;
			}
			$route = str_replace('/', '/', $route);
			$route = str_replace('\\', '/', $route);
			$contents = file_get_contents($route);
			fwrite($handler, JSMin::minify(file_get_contents($route)));
		}
		fclose($handler);
	}

	public static function generateMinifyBackJs() {
		Fw_ClearDirectory::clear(JS_PATH . DS . 'generated' . DS . 'back');
		include_once LIBS_PATH . DS . 'minify' . DS . 'jsmin.php';
		$handler = fopen(JS_PATH . DS . 'generated' . DS . 'back' . DS . md5(microtime()) . '.js', 'w');
		foreach (self::$aBackJs['routes'] as $route) {
			$route = str_replace(PUBLIC_URI, '/', $route);
			if (strpos(PUBLIC_PATH, $route) === false) {
				$route = PUBLIC_PATH . $route;
			}
			$route = str_replace('/', '/', $route);
			$route = str_replace('\\', '/', $route);
			$contents = file_get_contents($route);
			fwrite($handler, JSMin::minify(file_get_contents($route)));
		}
		fclose($handler);
	}

	public static function generateMinifyFrontCss() {
		Fw_ClearDirectory::clear(CSS_PATH . DS . 'generated' . DS . 'front');
		$handler = fopen(CSS_PATH . DS . 'generated' . DS . 'front' . DS . md5(microtime()) . '.css', 'w');
		$to_replace = str_replace('\\', '/', PUBLIC_PATH);
		foreach (self::$aFrontCss['routes'] as $route) {
			$route = str_replace(PUBLIC_URI, '/', $route);
			if (strpos(PUBLIC_PATH, $route) === false) {
				$route = PUBLIC_PATH . $route;
			}
			$route = str_replace('/', '/', $route);
			$route = str_replace('\\', '/', $route);
			$contents = file_get_contents($route);
			$route = str_replace(CSS_PATH, CSS_URI, $route);
			preg_match_all('/url\\(\\s*([^\\)\\s]+)\\s*\\)/', $contents, $matches);
			foreach ($matches[1] as $uri) {
				$uri = str_replace('"', '', $uri);
				$uri = str_replace("'", '', $uri);
				$path = preg_replace('/^(.*)\/(.*).css$/', '$1', $route);
				$new_uri = str_replace($to_replace, '', $path . '/' . $uri);
				$contents = str_replace($uri, $new_uri, $contents);
			}

			preg_match_all('/@import\\s+([\'"])(.*?)[\'"]/', $contents, $matches);
			foreach ($matches[1] as $uri) {
				$uri = str_replace('"', '', $uri);
				$uri = str_replace('"', '', $uri);
				$path = preg_replace('/^(.*)\/(.*).css$/', '$1', $route);
				$new_uri = str_replace($to_replace, '', $path . '/' . $uri);
				$contents = str_replace($uri, $new_uri, $contents);
			}

			$contents = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $contents);
			$contents = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $contents);
			fwrite($handler, $contents);
		}
		fclose($handler);
	}

	public static function generateMinifyBackCss() {
		Fw_ClearDirectory::clear(CSS_PATH . DS . 'generated' . DS . 'back');
		$handler = fopen(CSS_PATH . DS . 'generated' . DS . 'back' . DS . md5(microtime()) . '.css', 'w');
		$to_replace = str_replace('\\', '/', PUBLIC_PATH);
		foreach (self::$aBackCss['routes'] as $route) {
			$route = str_replace(PUBLIC_URI, '/', $route);
			if (strpos(PUBLIC_PATH, $route) === false) {
				$route = PUBLIC_PATH . $route;
			}
			$route = str_replace('/', '/', $route);
			$route = str_replace('\\', '/', $route);
			$contents = file_get_contents($route);

			preg_match_all('/url\\(\\s*([^\\)\\s]+)\\s*\\)/', $contents, $matches);
			foreach ($matches[1] as $uri) {
				$uri = str_replace('"', '', $uri);
				$uri = str_replace("'", '', $uri);
				$path = preg_replace('/^(.*)\/(.*).css$/', '$1', $route);
				$new_uri = str_replace($to_replace, '', $path . '/' . $uri);
				$contents = str_replace($uri, $new_uri, $contents);
			}

			preg_match_all('/@import\\s+([\'"])(.*?)[\'"]/', $contents, $matches);
			foreach ($matches[1] as $uri) {
				$uri = str_replace('"', '', $uri);
				$uri = str_replace('"', '', $uri);
				$path = preg_replace('/^(.*)\/(.*).css$/', '$1', $route);
				$new_uri = str_replace($to_replace, '', $path . '/' . $uri);
				$contents = str_replace($uri, $new_uri, $contents);
			}

			$contents = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $contents);
			$contents = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $contents);
			fwrite($handler, $contents);
		}
		fclose($handler);
	}

}

?>