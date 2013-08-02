<?php

class Fw_Contact_Controller extends Fw_CrudController {

	public function __construct() {
		$this->model = 'Contact_Model';
		$this->adminParams = array(
			'ID' => 'id',
			'Name' => 'name',
			'Email' => 'email',
			'Subject' => 'subject',
			'Status' => 'state_name'
		);
		$this->editParams = array(
			'Status' => array('type' => 'select', 'name' => 'id_state', 'table' => 'contact_state', 'field' => 'name', 'populate' => true),
			'Name' => array('type' => 'text', 'name' => 'name', 'populate' => true, 'readonly' => true),
			'Email' => array('type' => 'text', 'name' => 'email', 'populate' => true, 'readonly' => true),
			'Subject' => array('type' => 'text', 'name' => 'subject', 'populate' => true, 'readonly' => true),
			'Comment' => array('type' => 'textarea', 'name' => 'comment', 'populate' => true, 'readonly' => true),
		);
		$this->setParams = array(
			'id_state' => array('type' => 'default', 'container' => 'post'),
			'name' => array('type' => 'default', 'container' => 'post'),
			'email' => array('type' => 'default', 'container' => 'post'),
			'subject' => array('type' => 'default', 'container' => 'post'),
			'comment' => array('type' => 'default', 'container' => 'post')
		);
	}

	public function edit() {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$id = Fw_Filter::getVar('id', 'numeric', 'params');
		$oResult = (isset($id)) ? $oModel->getRow($id) : false;
		$aReplies = $oModel->getReplies($id);
		Fw_Register::setRef('oResult', $oResult);
		Fw_Register::setRef('aReplies', $aReplies);
		Fw_Register::setRef('oParams', $this->editParams);
		parent::display('edit', true, 'contact');
	}

	public function admin() {
		$this->layout = 'admin';
		$oModel = new $this->model;
		$oResult = $oModel->getData();
		Fw_Register::setRef('oResult', $oResult['rows']);
		Fw_Register::setRef('count', $oResult['total']);
		Fw_Register::setRef('oParams', $this->adminParams);
		parent::display('admin', true, 'contact');
	}

	public function send() {
		$oModel = new Contact_Model();
		$errors = $oModel->setRow(
				array(
					'name' => Fw_Filter::getVar('contact_name', 'default', 'post'),
					'email' => Fw_Filter::getVar('contact_email', 'default', 'post'),
					'subject' => Fw_Filter::getVar('contact_subject', 'default', 'post'),
					'comment' => Fw_Filter::getVar('contact_comment', 'default', 'post'),
				)
		);
		if (is_numeric($errors)) {
			Fw_Register::addMessage('Information received correctly. We will contact you shortly');
			$body = file_get_contents(MAIL_TXT_PATH . DS . 'customer_contact_create.php');
			$body = str_replace('#CUSTOMER#', Fw_Filter::getVar('contact_name', 'default', 'post'), $body);
			Mail_Helper::sendTemplate(
				'We receive your email', array(
					array(
						'email' => Fw_Filter::getVar('contact_email', 'default', 'post'),
						'name' => Fw_Filter::getVar('contact_name', 'default', 'post')
					),
				), 
				'transactional_basic', 
				array(
					'TITLE' => 'We receive your email',
					'SUBJECT' => 'We receive your email',
					'BODY' => $body
				)
			);
			$body = file_get_contents(MAIL_TXT_PATH . DS . 'fw_contact_create.php');
			Mail_Helper::sendTemplate(
				'We receive a question', 
				array(
					array(
						'email' => Fw_Register::getConfig('fw_email'),
						'name' => Fw_Register::getConfig('fw_name'),
					),
				), 'transactional_basic', 
				array(
					'TITLE' => 'We receive a question', 
					'SUBJECT' => 'We receive a question', 
					'BODY' => $body
				)
			);
			header('Location: ' . BASE_URI);
			exit();
		}
		Fw_Register::setRef('form_errors', $errors);
		$this->display('contact', true, 'static');
	}

	public function reply() {
		$id = Fw_Filter::getVar('id', 'default', 'post');
		$oModel = new Contact_Model();
		$oContact = $oModel->getRow($id);
		$oModel = new ContactReply_Model();
		$errors = $oModel->setRow(
				array(
					'id_contact' => $id,
					'reply_text' => Fw_Filter::getVar('reply_text', 'default', 'post')
				)
		);
		if (is_numeric($errors)) {
			Mail_Helper::sendTemplate(
				'Customer Support Case #'.$id, array(
					array(
						'email' => $oContact['email'],
						'name' => $oContact['name']
					),
				), 
				'transactional_basic', 
				array(
					'TITLE' => 'Customer Support Case #'.$id,
					'SUBJECT' => 'Customer Support Case #'.$id,
					'BODY' => Fw_Filter::getVar('reply_text', 'default', 'post')
				)
			);
			Fw_Register::addMessage('Mail sended successfully.');
		}
		header('Location: ' . BASE_URI.'contact/edit/'.$id);
		exit();
	}

}

?>
