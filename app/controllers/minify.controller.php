<?php
	class Minify_Controller extends Fw_Controller{
		public function __construct() {
			$this->layout = 'blank';	
		}
		public function generateAll(){
			$this->generateFrontCss();
			$this->generateBackCss();
			$this->generateFrontJs();
			$this->generateBackJs();
		}
		public function generateFrontCss(){
			Fw_CCC::generateMinifyFrontCss();
		}
		public function generateBackCss(){
			Fw_CCC::generateMinifyBackCss();
		}
		public function generateFrontJs(){
			Fw_CCC::generateMinifyFrontJs();
		}
		public function generateBackJs(){
			Fw_CCC::generateMinifyBackJs();
		}
	}
?>