<?php

/**
 * @author		Iván García Maya
 * @filename	autoloader.php
 * @description	This file define the automatic load of the classes that are
 * necessary to execute the application
 *
 */

/**
 * Load a class when this is necessary in the application
 *
 * @param string $classname
 */
function __autoload($classname) {
	$classname = strtolower($classname);
	preg_match_all('/[a-z]+/', $classname, $matches, PREG_SET_ORDER);
	$count = count($matches);
	$folder = $context = $name = $suffix = '';

	$libs = explode(' ', LIBS_ON);
	foreach ($libs as $lib)
	if ($in = stristr($matches[0][0], $lib))break;
	if (!$in) {
		switch (strtolower($matches[$count - 1][0])) {
			case 'controller':
				$folder = CONTROLLERS_PATH . DS;
				$name = strtolower($matches[0][0]);
				$suffix = '.controller.php';
				break;
			case 'model':
				$folder = MODELS_PATH . DS;
				$name = strtolower($matches[0][0]);
				$suffix = '.model.php';
				break;
			case 'helper':
				$folder = HELPERS_PATH . DS;
				$name = strtolower($matches[0][0]);
				$suffix = '.helper.php';
				break;
			case 'view':
				$folder = VIEWS_PATH . DS;
				$name = strtolower($matches[0][0]);
				$suffix = '.view.php';
				break;
			default:
				$folder = LIBS_PATH . DS;
				$context = getContextPath($matches);
				$name = strtolower($matches[$count - 1][0]);
				$suffix = '.class.php';
				break;
		}
	} else {
		$folder .= LIBS_PATH . DS;
		$context = getContextPath($matches);
		$name .= strtolower($matches[$count - 1][0]);		
		if ($lib == 'Fw') {
			if ($context == 'fw' . DS) {
				$context .= 'class' . DS;
				$suffix .= '.class.php';
			} else if (stristr($classname, 'controller')) {
				$name = str_replace(DS, '', $context);
				$name = str_replace('fw', '', $name);
				$context = 'fw'.DS.'controller'.DS;
				$suffix .= '.controller.php';
			} else if (stristr($classname, 'model')) {				
				$name = str_replace(DS, '', $context);
				$name = str_replace('fw', '', $name);
				$context = 'fw'.DS.'model'.DS; 
				$suffix .= '.model.php';
			}
		}		
	}

	if (file_exists($folder . $context . $name . $suffix)) {
		require_once ( $folder . $context . $name . $suffix );
		return true;
	} else if (file_exists($folder . $lib . DS . $matches[0][0] . '.php')) {
		require_once($folder . $lib . DS . $matches[0][0] . '.php');
		return true;
	}
	return false;
}

function getContextPath($matches) {
	$end = count($matches) - 1;
	$context = '';
	for ($i = 0; $i < $end; $i++) {
		$context .= $matches[$i][0] . DS;
	}
	return $context;
}

?>
