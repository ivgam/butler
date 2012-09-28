<?php

class Fw_Module{
	public static function getModule($name, $params = array()){		
		require_once MODULES_PATH.DS.$name.'.php';
	}
}
?>
