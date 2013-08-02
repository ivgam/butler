<?php

class Fw_SEO_Controller extends Fw_CrudController {

	public function __construct() {
		$this->model = 'SEO_Model';
		$this->setParams = array(
			'resource'=>array('type'=>'default','container'=>'post'),
			'task'=>array('type'=>'default','container'=>'post'),
			'name' => array('type' => 'default', 'container' => 'post'),
			'title' => array('type' => 'default', 'container' => 'post'),
			'robots' => array('type' => 'default', 'container' => 'post'),
			'author' => array('type' => 'default', 'container' => 'post'),
			'canonical' => array('type' => 'default', 'container' => 'post'),
			'description' => array('type' => 'default', 'container' => 'post'),
		);
		$this->adminParams = array(
			'ID' => 'id',
			'Name' => 'name',
			'Title' => 'title',
			'Robots' => 'robots'
		);
		$this->editParams = array(
			'Resource' => array('type' => 'text', 'name' => 'resource', 'populate' => true),
			'Task' => array('type' => 'text', 'name' => 'task', 'populate' => true),
			'Name' => array('type' => 'text', 'name' => 'name', 'populate' => true),
			'Title' => array('type' => 'text', 'name' => 'title', 'populate' => true),
			'Robots' => array('type' => 'text', 'name' => 'robots', 'populate' => true),
			'Author' => array('type' => 'text', 'name' => 'author', 'populate' => true),
			'Canonical' => array('type' => 'text', 'name' => 'canonical', 'populate' => true),
			'Description' => array('type' => 'textarea', 'name' => 'description', 'populate' => true)
		);
	}

}

?>
