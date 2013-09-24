<?php

abstract class Fw_CrudController extends Fw_Controller {

	protected $model;
	protected $setParams = array();
	protected $editParams = array();
	protected $adminParams = array();

	public function admin() {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$oResult = $oModel->getData();
		Fw_Register::setRef('oResult', $oResult['rows']);
		Fw_Register::setRef('count', $oResult['total']);
		Fw_Register::setRef('oParams', $this->adminParams);
		parent::display('admin', true, 'crud');
	}

	public function edit() {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$id = Fw_Filter::getVar('id', 'numeric', 'params');
		$oResult = (isset($id)) ? $oModel->getRow($id) : false;
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('oParams', $this->editParams);
		parent::display('edit', true, 'crud');
	}

	public function add() {
		$this->layout = 'admin';
		Fw_Register::setRef('oParams', $this->editParams);
		parent::display('edit', true, 'crud');
	}

	public function set($redirect = true) {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$row = array();
		$id = Fw_Filter::getVar('id', 'numeric', 'post');
		foreach ($this->setParams as $k => $v) {
			$value = Fw_Filter::getVar($k, $v['type'], $v['container']);
			if (isset($v['modifier'])) {
				switch ($v['modifier']) {
					case 'md5'		: $value = md5($value); break;
					case 'boolean'	: $value = (int)($value != false); break;
					case 'upload'	:
						if(empty($value['name'])){
							$value = false;
							break;
						}
						$resource = Fw_Register::getRef('current_resource');
						if (!is_dir(IMG_PATH . DS . $resource)) {
							mkdir(IMG_PATH . DS . $resource);
						}
						if (is_file(IMG_PATH.DS.$resource.DS.$value['name'])) {
							$aParts = explode('.', $value['name']);
							$aOriginal = $aParts;
							$seed = 0;
							do {
								$pos = max(array(0, count($aParts) - 2));
								$aParts[$pos] = $aOriginal[$pos] . '_' . ++$seed;
								$value['name'] = implode('.', $aParts);
							} while (is_file(IMG_PATH.DS.$resource.DS.$value['name']));
						}
						move_uploaded_file($value["tmp_name"], IMG_PATH.DS.$resource.DS.$value['name']);
						$value = IMG_URI.$resource.'/'.$value['name'];
						break;
					case 'compress'	: break;
					case 'resize'	: break;
				}
			}
			$row[$k] = $value;
		}
		$id = $oModel->setRow($row, $id);
		$oResult = $oModel->getData();
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('oParams', $this->adminParams);
		if (is_numeric($id)) {
			Fw_Register::addMessage("Item $id insert/updates successfully.");
			if ($redirect) {
				Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'edit', array($id));
			} else {
				return $id;
			}
		} else {
			Fw_Register::addMessage("An error ocurred while processing.", 'error');
			if ($redirect) {
				Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'edit', array(0));
			} else {
				return 0;
			}
		}
	}

	public function delete($redirect = true) {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$id = Fw_Filter::getVar('id', 'numeric', 'params');
		$oModel->deleteRow($id);
		$oResult = $oModel->getData();
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('oParams', $this->adminParams);
		Fw_Register::addMessage("Item $id deleted successfully.", 'success');
		if ($redirect) {
			Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'admin');
		} else {
			return $id;
		}
	}

}

?>
