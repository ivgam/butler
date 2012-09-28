<?php
class Page_Controller extends Fw_AdminController {
	public function __construct() {			
		$this->model = 'Page_Model';
		$this->setParams = array(	
				'page'		=>array('type'=>'default', 'container'=>'post'),
				'controller'=>array('type'=>'default', 'container'=>'post'),
				'content' 	=>array('type'=>'default', 'container'=>'post')
		);
		$this->adminParams = array(
				'Page'			=>'page', 				
				'Controller'	=>'controller', 								
		);
		$this->editParams = array(	
				'Page'			=>array('type'=>'text'		, 'name'=>'page'		, 'populate'=>true),				
				'Controller'	=>array('type'=>'select'	, 'name'=>'controller'	, 'populate'=>true,  'table'=>'acl', 'field'=>'subresources', 'where'=>'controller=static'),				
				'Content'		=>array('type'=>'textarea'	, 'name'=>'content'		, 'populate'=>true),
		);
	}

	public function edit() {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$id = Fw_Filter::getVar('id', 'default', 'params');
		$oResult = (isset($id)) ? $oModel->getRow($id) : false;
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('oParams', $this->editParams);
		parent::display('edit', true, 'admin');
	}

	public function set($redirect = true) {
		$this->layout = 'admin';		
		$oModel = new $this->model;
		$row = array();
		$id = Fw_Filter::getVar('id', 'default', 'post');
		foreach ($this->setParams as $k => $v) {
			$value = Fw_Filter::getVar($k, $v['type'], $v['container']);
			if (isset($v['modifier'])) {
				switch ($v['modifier']) {
					case 'md5': $value = md5($value);
						break;
				}
			}
			$row[$k] = $value;
		}
		$id = $oModel->setRow($row, $id);
		$oResult = $oModel->getData();
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('oParams', $this->adminParams);
		Fw_Register::addMessage("Item $id insert/updates successfully.");
		if($redirect){
			Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'edit', array($id));
		} else{
			return $id;
		}
	}

	public function delete($redirect = true) {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$id = Fw_Filter::getVar('id', 'default', 'params');
		$oModel->deleteRow($id);
		$oResult = $oModel->getData();
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('oParams', $this->adminParams);		
		Fw_Register::addMessage("Item $id deleted successfully.", "yellow");
		if ($redirect){
			Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'admin');
		} else {
			return $id;
		}
	}
}
?>