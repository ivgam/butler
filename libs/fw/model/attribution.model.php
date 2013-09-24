<?php

class Fw_Attribution_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'attribution';
		parent::__construct();
	}
	
	public function getAllGroupedByUse() {
		$sSQL = "SELECT a.used_for, a.* FROM attribution a WHERE deleted = 0 ORDER BY author ASC";
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll(PDO::FETCH_GROUP);
	}

}

?>
