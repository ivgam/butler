<?php

class Fw_ContactReply_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'contact_reply';
		parent::__construct();
	}

	public function validate($aValues) {
		$errors = array();
		$errors["Reply Text"] = Validator_Helper::required($aValues['reply_text']);
		return array_keys(array_diff_key($errors, array_filter($errors)));
	}
	
}

?>
