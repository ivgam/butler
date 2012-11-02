<?php

class Fw_Dumper_Controller extends Fw_Controller {

	public function __construct() {
		$this->layout = 'blank';
	}

	public function schema() {
		header('Content-Type: application/sql; charset=utf-8');
		header('Content-Disposition: attachment; filename="schema_'.  date('Y_m_d').'_.sql"');
		$oModel = new Dumper_Model();
		$oModel->dump();
	}

	public function all() {
		header('Content-Type: application/sql; charset=utf-8');
		header('Content-Disposition: attachment; filename="dump_'.  date('Y_m_d').'.sql"');
		$oModel = new Dumper_Model();
		$oModel->dump(true);
	}
}

?>
