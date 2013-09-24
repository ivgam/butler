<?php

class Fw_Attribution_Controller extends Fw_CrudController {

	public function __construct() {
		$this->model = 'Attribution_Model';
		$this->setParams = array(
			'url' => array('type' => 'default', 'container' => 'post'),
			'author' => array('type' => 'default', 'container' => 'post'),
			'used_for' => array('type' => 'default', 'container' => 'post')
		);
		$this->adminParams = array(
			'ID' => 'id',
			'Author' => 'author',
			'URL' => 'url',
			'Used for' => 'used_for'
		);
		$this->editParams = array(
			'Author' => array('type' => 'text', 'name' => 'author', 'populate' => true),
			'Used For' => array('type' => 'text', 'name' => 'used_for', 'populate' => true),
			'URL' => array('type' => 'text', 'name' => 'url', 'populate' => true),
		);
	}
	
	public function view(){
		$this->layout = 'default';
		$oModel = new Attribution_Model();
		Fw_Register::setRef('aAttribution', $oModel->getAllGroupedByUse());
		$this->display('default', true);
	}

}

?>