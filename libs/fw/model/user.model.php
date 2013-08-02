<?php

class Fw_User_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'user';
		parent::__construct();
	}

	public function userExists($username, $pwd) {
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

	public function getUser($md5_username, $pwd) {
		$sSQL = <<<SQL
SELECT id, username, usertype
FROM {$this->database}.{$this->table}
WHERE md5(username) = :md5_username
AND password = :password
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':md5_username', $md5_username, PDO::PARAM_STR);
		$statement->bindParam(':password', $pwd, PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
	}

	public function getByUsername($username) {
		$sSQL = <<<SQL
SELECT id, username, usertype
FROM {$this->database}.{$this->table}
WHERE username = :username
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':username', $username, PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
	}

}

?>