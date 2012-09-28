<?php 
class Admin_Controller extends Fw_Controller{
	public function __construct() {
		$this->layout = 'admin';	
	}
	public function config_acl(){
		$acl_raw = parse_ini_file(CONFIG_PATH.DS.'acl.ini', true);
		$controllers_list = array();		
		if(is_dir(CONTROLLERS_PATH) && $handler = opendir(CONTROLLERS_PATH)){
			while (false !== ($entry = readdir($handler))){
				if(	is_file(CONTROLLERS_PATH.DS.$entry) && strpos($entry, '.controller.php')){
					$classname = str_replace('.controller.php', '_controller', $entry);
					$resource = str_replace('.controller.php', '', $entry); 
					$methods = get_class_methods($classname);
					$controllers_list[$resource] = $methods;					
				}
			}			
		}
		Fw_Register::setRef('acl_raw', $acl_raw);
		Fw_Register::setRef('controllers_list', $controllers_list);		
		parent::display('config_acl', true, 'admin');
	}
	public function config_scripts(){		
		parent::display('config_scripts', true, 'admin');
	}
	public function config_configuration(){	
		$config_raw = parse_ini_file(CONFIG_PATH.DS.'configuration.ini', true);		
		Fw_Register::setRef('config_json',json_encode($config_raw));	
		parent::display('config_configuration', true, 'admin');
	}
	public function config_databases(){		
		$databases_raw = parse_ini_file(CONFIG_PATH.DS.'databases.ini', true);		
		Fw_Register::setRef('databases_json',json_encode($databases_raw));
		parent::display('config_databases', true, 'admin');
	}
	public function config_routes(){	
		parent::display('config_routes', true, 'admin');	
	}
	public function config_crud(){
		parent::display('config_crud', true, 'admin');		
	}
	public function ajax(){
		$file = CONFIG_PATH.DS.Fw_Filter::getVar('action', 'default', 'post');
		$file = (is_file($file.'.ini'))?$file.'.ini':$file.'.php';
		$content = Fw_Filter::getVar('content', 'default', 'post');
		if($handler = fopen($file, 'w+')){
			fwrite($handler, $content);
			fclose($handler);
			echo '{"response":"Saved successfully."}';			
		} else {
			echo '{"response":"An error ocurrs when saving the file."}';			
		}
		exit();
	}
}
?>
