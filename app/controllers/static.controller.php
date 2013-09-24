<?php

class Static_Controller extends Fw_Static_Controller {
	
	public function wiki(){
		$this->layout = 'wiki';
		$this->display('wiki', true);
	}
	
	public function service(){
		$this->layout = 'landing';
		$this->display('landing', true);
	}
	
}

?>
