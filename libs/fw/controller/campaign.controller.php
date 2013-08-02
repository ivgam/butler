<?php

class Fw_Campaign_Controller extends Fw_CrudController {

	public function __construct() {
		$this->model = 'Campaign_Model';
		$this->setParams = array(
			'name' => array('type' => 'default', 'container' => 'post'),
			'start_time' => array('type' => 'default', 'container' => 'post'),
			'end_time' => array('type' => 'default', 'container' => 'post'),
			'cost' => array('type' => 'default', 'container' => 'post'),
		);
		$this->adminParams = array(
			'ID' => 'id',
			'Name' => 'name',
			'Start Time' => 'start_time',
			'End Time' => 'end_time',
			'Cost' => 'cost'
		);
		$this->editParams = array(
			'Name' => array('type' => 'text', 'name' => 'name', 'populate' => true),
			'Start Time' => array('type' => 'datepicker', 'name' => 'start_time', 'populate' => true),
			'End Time' => array('type' => 'datepicker', 'name' => 'end_time', 'populate' => true),
			'Cost' => array('type' => 'text', 'name' => 'cost', 'populate' => true),
		);
	}

	public function edit() {
		$this->layout = 'admin';
		$oModel = new Campaign_Model();
		$id = Fw_Filter::getVar('id', 'numeric', 'params');
		$oResult = (isset($id)) ? $oModel->getRow($id) : false;
		$aLanding = $oModel->getLandings($id);
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('aLanding', $aLanding);
		Fw_Register::setRef('oParams', $this->editParams);
		parent::display('edit', true);
	}

	public function addLanding() {
		$id_campaign = Fw_Filter::getVar('id_campaign', 'numeric', 'post');
		$id_landing = Fw_Filter::getVar('id_landing', 'numeric', 'post');
		if ($id_landing == 0) {
			Fw_Register::addMessage('Please select a valid landing', 'error');
		} else {
			$oModel = new Campaign_Model();
			$oModel->addLanding($id_campaign, $id_landing);
		}
		header('Location: '.BASE_URI.'campaign/edit/' . $id_campaign);
		exit();
	}

	public function enableLanding() {
		$id_campaign = Fw_Filter::getVar('id_campaign', 'numeric', 'post');
		$id_landing_campaign = Fw_Filter::getVar('id_landing_campaign', 'numeric', 'post');
		$oModel = new Campaign_Model();
		$oModel->enableLanding($id_landing_campaign);
		header('Location: '.BASE_URI.'campaign/edit/' . $id_campaign);
		exit();
	}

	public function disableLanding() {
		$id_campaign = Fw_Filter::getVar('id_campaign', 'numeric', 'post');
		$id_landing_campaign = Fw_Filter::getVar('id_landing_campaign', 'numeric', 'post');
		$oModel = new Campaign_Model();
		$oModel->disableLanding($id_landing_campaign);
		header('Location: '.BASE_URI.'campaign/edit/' . $id_campaign);
		exit();
	}

}

?>
