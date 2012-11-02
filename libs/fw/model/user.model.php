<?php

class Fw_User_Model extends Fw_Model {		
	
	public function __construct() {		
		$this->table = 'user';		
		parent::__construct();
	}
	
	public function userExists($username, $pwd){
		$sSQL = <<<SQL
SELECT id, usertype
	FROM {$this->database}.{$this->table}
		WHERE username = '$username'
			AND password = '$pwd'
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetch();
	}
	
	public function getUser($md5_username, $pwd){
		$sSQL = <<<SQL
SELECT id, username, usertype
	FROM {$this->database}.{$this->table}
		WHERE md5(username) = '$md5_username'
			AND password = '$pwd'
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();		
		return $statement->fetch();
	}

}

?>