<?php 
class Comment_Model extends Fw_Model {		
	public function __construct() {		
		$this->table = 'comment';		
		parent::__construct();
	}
}
?>