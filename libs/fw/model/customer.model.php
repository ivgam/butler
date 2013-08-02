<?php

class Fw_Customer_Model extends Fw_Model {

	public function __construct() {
		$this->table = 'customer';
		parent::__construct();
	}

	public function validate($values) {
		$errors = array();
		$errors["Email"] = Validator_Helper::required($values['email']);
		$errors["Password"] = Validator_Helper::required($values['password']);
		$errors["Password"] &= Validator_Helper::length($values['password'], 5, 50);
		return array_keys(array_diff_key($errors, array_filter($errors)));
	}

	public function insert($values) {
		$values['seed'] = Random_Helper::getSeed();
		return parent::insert($values);
	}

	public function confirm($id_customer, $seed) {
		$sSQL = <<<SQL
SELECT COUNT(*) 
	FROM {$this->database}.{$this->table}
	WHERE id = :id
	AND seed = :seed
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':id', $id_customer, PDO::PARAM_INT);
		$statement->bindParam(':seed', $seed, PDO::PARAM_INT);
		$statement->execute();
		$count = $statement->fetchColumn();
		if ($count > 0) {
			$oCustomer = $this->getRow($id_customer);
			$this->setRow(
					array(
				'email' => $oCustomer['email'],
				'password' => $oCustomer['password'],
				'confirmed' => 1,
					), $id_customer
			);
			Fw_Register::addMessage('Account confirmed successfully', 'success');
			return true;
		} else {
			Fw_Register::addMessage('Account confirmation error', 'error');
			return false;
		}
	}

	public function customerExists($email, $pwd) {
		$sSQL = <<<SQL
SELECT id
FROM {$this->database}.{$this->table}
WHERE email = :email
AND password = :password
AND confirmed = 1
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->bindParam(':password', $pwd, PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
	}
	
	public function isEmailRegistered($email){
		$sSQL = <<<SQL
SELECT *
FROM {$this->database}.{$this->table}
WHERE email = :email
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->bindParam(':email', $email, PDO::PARAM_STR);
		$statement->execute();
		return $statement->fetch();
	}

	public function getCustomer($md5_email, $pwd) {
		$sSQL = <<<SQL
SELECT *
FROM {$this->database}.{$this->table}
WHERE md5(email) = '$md5_email'
AND password = '$pwd'
AND confirmed = 1
SQL;
		$statement = $this->oDb->prepare($sSQL);
		$statement->execute();
		return $statement->fetch();
	}

}

?>
