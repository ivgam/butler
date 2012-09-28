<?php 
class Category_Controller extends Fw_AdminController{
	public function __construct() {					
		$this->model = 'Category_Model';
		$this->setParams = array(
				'name' 	=>array('type'=>'default', 'container'=>'post'),
				'parent' 	=>array('type'=>'default', 'container'=>'post')
		);
		$this->adminParams = array(
				'ID'			=>'id',
				'Name'			=>'name',
				'Parent'		=>'parent',				
				'Created At'	=>'ts_creation',
				'Updated At'	=>'ts_update',				
		);
		$this->editParams = array(				
				'Name'		=>array('type'=>'text'	, 'name'=>'name'	, 'populate'=>true),
				'Parent'	=>array('type'=>'select', 'name'=>'parent'	, 'table'=>'category', 'field'=>'name')
		);
	}
}
?>