<?php

class Fw_Error_Controller extends Fw_Controller {
	
	public function error() {
		$this->layout = 'error';
		$error_no = Fw_Filter::getVar('id', 'numeric', 'params');			
		switch ($error_no) {
			case 301: $error_message = 'Permision Denied'; break;				
			case 404: 
			default: 	
				$error_no = (empty($error_no))?404:$error_no;
				$error_message = 'Page not Found';				
				break;
		}
		header("HTTP/1.0 $error_no  $error_message");
		Fw_Register::setRef('error_no', $error_no);
		Fw_Register::setRef('error_message', $error_message);
		$this->display('default', true);
	}

}

?>
