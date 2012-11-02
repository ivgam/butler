<?php 
class Fw_Rest_Model extends Fw_Model{
	public function __construct() {
		$this->table = Fw_Register::getRef('table');		
		parent::__construct();
	}
	public function rest_gets(){
		$sSQL = "SELECT * FROM {$this->database}.{$this->table}";		
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetchAll();
	}
	public function rest_get($id){					
		$sSQL = "SELECT * FROM {$this->database}.{$this->table} WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam('id', $id);
		$statement->execute();
		return $statement->fetchAll();
	}
	public function rest_search($query){
		$sSQL = "SELECT * FROM {$this->database}.{$this->table} WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam('id', $id);
		$statement->execute();
		return $statement->fetchAll();
	}
	public function rest_add(){
		$request = Slim::getInstance()->request();
		$object = json_decode($request->getBody());
		var_dump($object);		
		$sSQL = "SELECT * FROM {$this->database}.{$this->table} WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam('id', $id);
		$statement->execute();
		return $statement->fetchAll();
	}
	public function rest_update($id){		
		$sSQL = "SELECT * FROM {$this->database}.{$this->table} WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam('id', $id);
		$statement->execute();
		return $statement->fetchAll();
	}
	public function rest_delete($id){			
		$sSQL = "SELECT * FROM {$this->database}.{$this->table} WHERE id = :id";
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam('id', $id);
		$statement->execute();
		return $statement->fetchAll();
	}

}
?>