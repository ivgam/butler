<?php 
class Message_Controller extends Fw_AdminController{
	public function __construct() {					
		$this->model = 'Message_Model';
		$this->setParams = array(	
				'email' 	=>array('type'=>'default', 'container'=>'post'),
				'content' 	=>array('type'=>'default', 'container'=>'post'),
				'revised' 	=>array('type'=>'default', 'container'=>'post')
		);
		$this->adminParams = array(
				'ID'			=>'id',
				'Email'			=>'email',
				'Created At'	=>'ts_creation',
				'Updated At'	=>'ts_update',
				'Revised'		=>'revised'
		);
		$this->editParams = array(				
				'Email'		=>array('type'=>'text'		, 'name'=>'email'	, 'populate'=>true),
				'Content'	=>array('type'=>'textarea'	, 'name'=>'content'	, 'populate'=>true),
				'Revised'	=>array('type'=>'text'		, 'name'=>'revised'	, 'populate'=>true)
		);
	}
}
?>