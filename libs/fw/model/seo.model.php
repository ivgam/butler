<?php

class Fw_SEO_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'seo';
		parent::__construct();
	}
	
	public function getPage($resource, $task){
		$sSQL = "SELECT * FROM seo WHERE resource = :resource AND task = :task";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':resource', $resource, PDO::PARAM_STR);
		$statement->bindParam(':task', $task, PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
	}

}

?>
