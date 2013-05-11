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
        if ($redirect) {
            Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'edit', array($id));
        } else {
            return $id;
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
            Fw_Router::redirect(Fw_Register::getRef('current_resource'), 'crud');
        } else {
            return $id;
        }
    }

}

?>
