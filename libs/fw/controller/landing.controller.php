<?php

class Fw_Landing_Controller extends Fw_CrudController {

	public function __construct() {
		$this->model = 'Landing_Model';
		$this->setParams = array(
			'name'			=> array('type' => 'default', 'container' => 'post'),
			'bg_image'		=> array('type' => 'default', 'container' => 'files', 'modifier'=>'upload'),
			'phrase_1'		=> array('type' => 'default', 'container' => 'post'),
			'phrase_2'		=> array('type' => 'default', 'container' => 'post'),
			'phrase_3'		=> array('type' => 'default', 'container' => 'post'),
			'placeholder'	=> array('type' => 'default', 'container' => 'post'),
			'button_text'	=> array('type' => 'default', 'container' => 'post'),
			'button_type'	=> array('type' => 'default', 'container' => 'post'),
		);
		$this->adminParams = array(
			'ID' => 'id',
			'Name' => 'name',
			'Placeholder' => 'placeholder',
			'Button Text' => 'button_text',
			'Button Type' => 'button_type'
		);
		$this->editParams = array(
			'Name'			=> array('type' => 'text'	, 'name' => 'name'			, 'populate' => true),
			'BG Image'		=> array('type' => 'image'	, 'name' => 'bg_image'		, 'populate' => true),
			'Phrase 1'		=> array('type' => 'text'	, 'name' => 'phrase_1'		, 'populate' => true),
			'Phrase 2'		=> array('type' => 'text'	, 'name' => 'phrase_2'		, 'populate' => true),
			'Phrase 3'		=> array('type' => 'text'	, 'name' => 'phrase_3'		, 'populate' => true),
			'Placeholder'	=> array('type' => 'text'	, 'name' => 'placeholder'	, 'populate' => true),
			'Button Text'	=> array('type' => 'text'	, 'name' => 'button_text'	, 'populate' => true),
			'Button Type'	=> array('type' => 'text'	, 'name' => 'button_type'	, 'populate' => true),
		);
	}
	
	public function view(){
		$this->layout = 'landing';
		$campaign_name = Fw_Filter::getVar('campaign_name', 'default', 'params');
		$landing_name = Fw_Filter::getVar('landing_name', 'default', 'params');
		$oLanding = Landing_Helper::getLandingCampaignByName($campaign_name, $landing_name);
		if(!empty($oLanding)){
			Fw_Register::setRef('oLanding', $oLanding);
			$this->display('landing', true);
		}
		else {
			header ('HTTP/1.1 301 Moved Permanently');
			header ('Location: '.BASE_URL);
		}
	}
	
	public function report_day(){
		$this->layout = 'admin';
		$this->display('report_day',true);
	}
	
		
	public function report_month(){
		$this->layout = 'admin';
		$this->display('report_month',true);
	}

}

?>
