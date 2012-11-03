<?php
class Fw_Tools {
		public static function getControllerList(){
		$controllers_list = array();		
		$core_methods = get_class_methods('Fw_Controller');					
		if(is_dir(CONTROLLERS_PATH) && $handler = opendir(CONTROLLERS_PATH)){
			while (false !== ($entry = readdir($handler))){
				if(	is_file(CONTROLLERS_PATH.DS.$entry) && strpos($entry, '.controller.php')){
					$classname = str_replace('.controller.php', '_controller', $entry);
					$resource = str_replace('.controller.php', '', $entry); 
					$methods = get_class_methods($classname);
					$controllers_list[$resource] = array_diff($methods,$core_methods);
				}
			}			
		}
		return $controllers_list;
	}
}
?>
