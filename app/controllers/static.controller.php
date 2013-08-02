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
	
	public function sitemap(){
		$this->layout = 'blank';
		$this->display('sitemap', true);
	}
	
	public function feed(){
		$this->layout = 'blank';
		$this->display('feed', true);
	}
	
	public function map(){
		$this->display('map', true);
	}
}

?>
